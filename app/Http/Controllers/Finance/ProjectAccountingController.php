<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\LandBank;
use App\Models\LandBankUnit;
use App\Models\Booking;
use App\Models\Spk;
use App\Models\SpkTermin;
use App\Models\Invoice;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProjectAccountingController extends Controller
{
    protected function authorizeFinanceAccess()
    {
        $user = auth()->user();
        if (!$user) {
            abort(403, 'Unauthorized');
        }
        $posName = strtolower($user->position->name ?? '');
        $divName = strtolower($user->division->name ?? '');
        $isAllowed = ($user->position_id == 1 || $user->position_id == 5 || str_contains($posName, 'kepala') || str_contains($posName, 'admin') || str_contains($posName, 'keuangan') || str_contains($divName, 'keuangan') || str_contains($posName, 'finance') || str_contains($divName, 'finance'));

        if (!$isAllowed) {
            abort(403, 'Akses ditolak. Modul Keuangan hanya dapat diakses oleh Bagian Keuangan, Kepala Marketing, dan Administrator.');
        }
    }

    /**
     * Halaman Utama Project Accounting, Penelusuran HPP & Arus Kas Proyek
     */
    public function index(Request $request)
    {
        $this->authorizeFinanceAccess();

        $landBankId = $request->get('land_bank_id');
        $unitId = $request->get('unit_id');
        $statusUnit = $request->get('status_unit');
        $search = $request->get('search');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        // 1. List Projects & Units for Filters
        $projects = LandBank::withCount('units')->orderBy('name', 'asc')->get();
        $unitsList = LandBankUnit::when($landBankId, fn($q) => $q->where('land_bank_id', $landBankId))
            ->orderBy('block', 'asc')
            ->orderBy('unit_number', 'asc')
            ->get();

        // 2. Query Units with Financial Relations
        $unitsQuery = LandBankUnit::with([
            'landBank.infrastructures',
            'landBank.expenses',
            'progress.items',
            'rabs',
            'complaints',
            'activeBooking.customer',
            'activeBooking.payments',
            'activeBooking.akad',
            'kprDisbursements',
        ]);

        if ($landBankId) {
            $unitsQuery->where('land_bank_id', $landBankId);
        }

        if ($unitId) {
            $unitsQuery->where('id', $unitId);
        }

        if ($statusUnit && $statusUnit !== 'all') {
            $unitsQuery->where('status', $statusUnit);
        }

        if ($search) {
            $unitsQuery->where(function($q) use ($search) {
                $q->where('unit_name', 'like', "%{$search}%")
                  ->orWhere('unit_code', 'like', "%{$search}%")
                  ->orWhere('block', 'like', "%{$search}%")
                  ->orWhere('type', 'like', "%{$search}%")
                  ->orWhereHas('activeBooking.customer', function($cq) use ($search) {
                      $cq->where('full_name', 'like', "%{$search}%")
                         ->orWhere('phone', 'like', "%{$search}%");
                  });
            });
        }

        $units = $unitsQuery->get();

        // Ambil data SPK yang berelasi
        $spkList = Spk::with(['termins', 'landBank', 'unit'])
            ->when($landBankId, fn($q) => $q->where('land_bank_id', $landBankId))
            ->get();

        // 3. Kalkulasi HPP & Keuangan per Unit
        $unitFinancials = $units->map(function ($u) use ($spkList, $units) {
            $booking = $u->activeBooking;
            $customerName = $booking?->customer?->full_name ?? '-';
            $bookingCode = $booking?->booking_code ?? '-';

            // Pendapatan / Harga Jual
            $hargaJual = (float) ($booking->harga_kesepakatan ?? $u->price ?? 0);

            // Realisasi Uang Masuk dari Konsumen & Bank
            $uangMasukKonsumen = 0;
            if ($booking) {
                // UTJ
                $uangMasukKonsumen += (float) ($booking->utj ?? 0);
                // Payments (DP / Angsuran Cash)
                if ($booking->payments) {
                    $uangMasukKonsumen += (float) $booking->payments->where('payment_type', '!=', 'kpr_cair')->sum('amount');
                }
            }

            // Realisasi Pencairan Dana KPR dari Bank
            $totalCairKpr = (float) $u->kprDisbursements->sum('nominal_cair');
            $uangMasukKonsumen += $totalCairKpr;

            // Fallback legacy jika belum input di disbursement tapi akad sudah selesai
            if ($totalCairKpr == 0 && $booking && $booking->akad && $booking->akad->status === 'selesai' && ($booking->purchase_type === 'kpr' || $booking->kprApplication)) {
                $nilaiKpr = (float) ($booking->kprApplication->realisasi_nominal ?? ($hargaJual - ($booking->dp ?? 0)));
                if ($nilaiKpr > 0 && $uangMasukKonsumen < $hargaJual) {
                    $uangMasukKonsumen += $nilaiKpr;
                }
            }

            // A. Alokasi Biaya Pengadaan Tanah (Land Cost Allocation)
            $totalLuasLahan = (float) ($u->landBank->area ?? 0);
            $hargaBeliLahan = (float) ($u->landBank->acquisition_price ?? 0);
            $luasUnit = (float) ($u->area ?? $u->land_area ?? 60);
            $unitCount = max(1, $u->landBank?->units_count ?? $u->landBank?->units()->count() ?: 1);
            
            $biayaTanahUnit = 0;
            if ($totalLuasLahan > 0 && $hargaBeliLahan > 0) {
                $biayaTanahUnit = ($luasUnit / $totalLuasLahan) * $hargaBeliLahan;
            } elseif ($hargaBeliLahan > 0) {
                $biayaTanahUnit = $hargaBeliLahan / $unitCount;
            }

            // B. Alokasi Biaya Pembangunan Jalan & Infrastruktur Kawasan (Infrastructure & Site Development)
            $totalInfraExpense = 0;
            if ($u->landBank) {
                $expenseSum = (float) $u->landBank->expenses->sum('total_amount');
                if ($expenseSum > 0) {
                    $totalInfraExpense = $expenseSum;
                } else {
                    $totalInfraExpense = (float) $u->landBank->infrastructures->sum('cost_estimate');
                }
            }
            $biayaInfraUnit = round($totalInfraExpense / $unitCount, 2);

            // C. Rincian & Total Biaya Perizinan (Permits & Legalities)
            $biayaPerizinan = 0;
            if ($u->progress && $u->progress->items && $u->progress->items->count() > 0) {
                $biayaPerizinan = (float) $u->progress->items->where('kategori', 'perizinan')->sum('total');
            }

            // D. Biaya Konstruksi Bangunan Rumah (Building Construction)
            $unitSpk = null;
            if (!empty($u->no_spk)) {
                $unitSpk = $spkList->firstWhere('no_spk', $u->no_spk);
            }
            if (!$unitSpk) {
                $unitSpk = $spkList->firstWhere('land_bank_unit_id', $u->id);
            }

            $biayaSpkKontrak = 0;
            $realisasiBayarSpk = 0;

            if ($unitSpk) {
                // Periksa jumlah unit yang memakai SPK ini di proyek ini
                $unitsInSpkCount = $units->where('no_spk', $unitSpk->no_spk)->count();
                if ($unitsInSpkCount > 1) {
                    $biayaSpkKontrak = round((float) ($unitSpk->nilai_kontrak ?? 0) / $unitsInSpkCount, 2);
                    $totalLunas = $unitSpk->termins ? (float) $unitSpk->termins->where('status_bayar', 'lunas')->sum('nominal') : 0;
                    $realisasiBayarSpk = $totalLunas > 0 ? round($totalLunas / $unitsInSpkCount, 2) : 0;
                } else {
                    $biayaSpkKontrak = (float) ($unitSpk->nilai_kontrak ?? 0);
                    $realisasiBayarSpk = $unitSpk->termins ? (float) $unitSpk->termins->where('status_bayar', 'lunas')->sum('nominal') : 0;
                }
            }
            
            $biayaRumahRab = 0;
            if ($u->progress && $u->progress->items && $u->progress->items->count() > 0) {
                $biayaRumahRab = (float) $u->progress->items->where('kategori', '!=', 'perizinan')->sum('total');
            } elseif ($u->progress && $u->progress->total_anggaran > 0) {
                $biayaRumahRab = max(0, (float) $u->progress->total_anggaran - $biayaPerizinan);
            } elseif ($u->rabs) {
                $biayaRumahRab = (float) $u->rabs->sum('total_biaya');
            }

            $biayaRumah = $biayaSpkKontrak > 0 ? $biayaSpkKontrak : $biayaRumahRab;

            // E. Biaya Servis & Klaim Garansi
            $biayaServis = (float) ($u->complaints ? $u->complaints->sum('biaya_perbaikan') : 0);

            // Total HPP Komitmen & Realisasi (Gabungan Komprehensif)
            $totalHppKomitmen = $biayaTanahUnit + $biayaInfraUnit + $biayaPerizinan + $biayaRumah + $biayaServis;
            
            $realisasiRumah = $realisasiBayarSpk > 0 ? $realisasiBayarSpk : ($u->construction_progress === 'selesai' ? $biayaRumah : 0);
            $totalHppRealisasi = $biayaTanahUnit + $biayaInfraUnit + $biayaPerizinan + $realisasiRumah + $biayaServis;

            // Gross Profit & Margin
            $grossProfit = $hargaJual > 0 ? ($hargaJual - $totalHppKomitmen) : 0;
            $marginPersen = ($hargaJual > 0 && $totalHppKomitmen > 0) ? round(($grossProfit / $hargaJual) * 100, 1) : 0;

            // Cashflow Net Unit
            $netCashflowUnit = $uangMasukKonsumen - $totalHppRealisasi;

            return (object) [
                'unit'                 => $u,
                'project_name'         => $u->landBank->name ?? 'Tanah Induk',
                'block_code'           => 'Blok ' . ($u->unit_code ?? $u->block . '-' . $u->unit_number),
                'unit_name'            => $u->unit_name ?? ('Unit ' . $u->unit_code),
                'type'                 => $u->type ?? 'Standar',
                'status'               => $u->status ?? 'available',
                'customer_name'        => $customerName,
                'booking_code'         => $bookingCode,
                'booking'              => $booking,
                'harga_jual'           => $hargaJual,
                'uang_masuk_konsumen'  => $uangMasukKonsumen,
                'piutang_konsumen'     => max(0, $hargaJual - $uangMasukKonsumen),
                'biaya_tanah'          => $biayaTanahUnit,
                'biaya_infrastruktur'  => $biayaInfraUnit,
                'biaya_perizinan'      => $biayaPerizinan,
                'biaya_rumah'          => $biayaRumah,
                'spk'                  => $unitSpk,
                'biaya_spk_kontrak'    => $biayaSpkKontrak,
                'realisasi_bayar_spk'  => $realisasiBayarSpk,
                'utang_spk_kontraktor' => max(0, $biayaSpkKontrak - $realisasiBayarSpk),
                'biaya_rab'            => $biayaRumahRab + $biayaPerizinan,
                'biaya_servis'         => $biayaServis,
                'total_hpp_komitmen'   => $totalHppKomitmen,
                'total_hpp_realisasi'  => $totalHppRealisasi,
                'gross_profit'         => $grossProfit,
                'margin_persen'        => $marginPersen,
                'net_cashflow'         => $netCashflowUnit,
            ];
        });

        // 4. Executive Summary KPI
        $summary = [
            'total_units_count'       => $unitFinancials->count(),
            'total_units_sold'        => $unitFinancials->whereIn('status', ['sold', 'booked'])->count(),
            'total_revenue_potential' => $unitFinancials->whereIn('status', ['sold', 'booked'])->sum('harga_jual'),
            'total_cash_inflow'       => $unitFinancials->sum('uang_masuk_konsumen'),
            'total_biaya_tanah'       => $unitFinancials->sum('biaya_tanah'),
            'total_biaya_infrastruktur'=> $unitFinancials->sum('biaya_infrastruktur'),
            'total_biaya_perizinan'   => $unitFinancials->sum('biaya_perizinan'),
            'total_biaya_rumah'       => $unitFinancials->sum('biaya_rumah'),
            'total_hpp_project'       => $unitFinancials->sum('total_hpp_komitmen'),
            'total_cash_outflow'      => $unitFinancials->sum('total_hpp_realisasi'),
            'total_gross_profit'      => $unitFinancials->whereIn('status', ['sold', 'booked'])->sum('gross_profit'),
            'total_piutang'           => $unitFinancials->whereIn('status', ['sold', 'booked'])->sum('piutang_konsumen'),
            'total_utang_kontraktor'  => $unitFinancials->sum('utang_spk_kontraktor'),
        ];

        if ($summary['total_revenue_potential'] > 0) {
            $summary['avg_margin_persen'] = round(($summary['total_gross_profit'] / $summary['total_revenue_potential']) * 100, 1);
        } else {
            $summary['avg_margin_persen'] = 0;
        }
        // 5. Jurnal Transaksi dialihkan ke Buku Jurnal Umum (keuangan.jurnal.index)
        $journalEntries = collect();

        return view('keuangan.project_accounting.index', compact(
            'projects',
            'unitsList',
            'unitFinancials',
            'summary',
            'journalEntries',
            'spkList',
            'landBankId',
            'unitId',
            'statusUnit',
            'search',
            'startDate',
            'endDate'
        ));
    }

    /**
     * Cetak Laporan Project Accounting & HPP Matrix (A4 Printable Format)
     */
    public function cetak(Request $request)
    {
        $landBankId = $request->get('land_bank_id');
        $unitId = $request->get('unit_id');

        $project = $landBankId ? LandBank::find($landBankId) : null;
        $unit = $unitId ? LandBankUnit::with(['landBank', 'activeBooking.customer', 'rabs', 'complaints'])->find($unitId) : null;

        // Ambil data unit financials
        $reqClone = Request::create('/keuangan/project-accounting', 'GET', $request->all());
        $indexData = $this->index($reqClone)->getData();

        return view('keuangan.project_accounting.cetak', array_merge((array)$indexData, [
            'selectedProject' => $project,
            'selectedUnit'    => $unit
        ]));
    }
}
