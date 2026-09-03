<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\LandBank;
use App\Models\LandBankUnit;
use App\Models\Booking;
use App\Models\KprApplication;
use App\Models\KprDisbursement;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class KprDisbursementController extends Controller
{
    protected function authorizeFinanceAccess()
    {
        $user = auth()->user();
        if (!$user) {
            abort(403, 'Unauthorized');
        }
        $posName = strtolower($user->position->name ?? '');
        $isAllowed = ($user->position_id == 1 || $user->position_id == 5 || str_contains($posName, 'kepala') || str_contains($posName, 'admin') || str_contains($posName, 'kpr') || str_contains($posName, 'legal'));

        if (!$isAllowed) {
            abort(403, 'Akses ditolak. Menu ini hanya dapat diakses oleh Bagian Keuangan dan Administrator.');
        }
    }

    public function index(Request $request)
    {
        $this->authorizeFinanceAccess();

        $landBankId = $request->get('land_bank_id');
        $unitId     = $request->get('unit_id');
        $statusCair = $request->get('status_pencairan');
        $search     = $request->get('search');

        $projects = LandBank::withCount('units')->orderBy('name', 'asc')->get();

        // Query Unit yang Pembayarannya KPR
        $unitsQuery = LandBankUnit::with([
            'landBank',
            'activeBooking.customer',
            'activeBooking.sales',
            'activeBooking.payments',
            'activeBooking.kprApplication.bank',
            'kprDisbursements.creator',
        ])
        ->where(function ($q) {
            $q->whereHas('activeBooking', function ($bq) {
                $bq->where('payment_method', 'kpr')
                   ->orWhereHas('kprApplication');
            })
            ->orWhereHas('kprDisbursements');
        });

        if ($landBankId) {
            $unitsQuery->where('land_bank_id', $landBankId);
        }

        if ($unitId) {
            $unitsQuery->where('id', $unitId);
        }

        if ($search) {
            $unitsQuery->where(function ($q) use ($search) {
                $q->where('unit_name', 'like', "%{$search}%")
                  ->orWhere('unit_code', 'like', "%{$search}%")
                  ->orWhere('block', 'like', "%{$search}%")
                  ->orWhereHas('activeBooking.customer', function ($cq) use ($search) {
                      $cq->where('full_name', 'like', "%{$search}%")
                         ->orWhere('phone', 'like', "%{$search}%");
                  });
            });
        }

        $allKprUnits = $unitsQuery->get();

        // Olah data finansial KPR per unit
        $unitsData = $allKprUnits->map(function ($u) {
            $booking = $u->activeBooking;
            $kprApp  = $booking?->kprApplication;
            $customer = $booking?->customer;
            $sales    = $booking?->sales;

            $hargaJual = (float) ($booking->harga_kesepakatan ?? $u->price ?? 0);

            // DP Masuk dari Konsumen
            $dpKonsumen = 0;
            if ($booking) {
                $dpKonsumen += (float) ($booking->utj ?? 0);
                if ($booking->payments) {
                    $dpKonsumen += (float) $booking->payments->where('status', 'verified')->sum('amount');
                    if ($dpKonsumen == 0) {
                        $dpKonsumen += (float) $booking->payments->sum('amount');
                    }
                }
                if ($dpKonsumen == 0 && ($booking->dp ?? 0) > 0) {
                    $dpKonsumen = (float) $booking->dp;
                }
            }

            // Plafon KPR (Piutang Bank)
            $plafonKpr = (float) ($kprApp->jumlah_pinjaman ?? max(0, $hargaJual - $dpKonsumen));

            // Total Pencairan yang sudah diterima dari Bank
            $totalCair = (float) $u->kprDisbursements->sum('nominal_cair');
            $sisaCair  = max(0, $plafonKpr - $totalCair);
            $persenCair = $plafonKpr > 0 ? min(100, round(($totalCair / $plafonKpr) * 100)) : 0;

            // Status Pencairan
            if ($totalCair >= $plafonKpr && $plafonKpr > 0) {
                $statusPencairan = 'lunas';
                $statusLabel = 'Lunas / Cair 100%';
                $badgeClass = 'bg-success';
            } elseif ($totalCair > 0) {
                $statusPencairan = 'termin';
                $statusLabel = 'Cair Sebagian (' . $persenCair . '%)';
                $badgeClass = 'bg-warning text-dark';
            } else {
                $statusPencairan = 'belum_cair';
                $statusLabel = 'Belum Cair (0%)';
                $badgeClass = 'bg-danger';
            }

            return (object) [
                'unit'             => $u,
                'booking'          => $booking,
                'kprApp'           => $kprApp,
                'customer'         => $customer,
                'sales'            => $sales,
                'bankName'         => $kprApp?->bank?->bank_name ?? 'Bank Penyalur KPR',
                'hargaJual'        => $hargaJual,
                'dpKonsumen'       => $dpKonsumen,
                'plafonKpr'        => $plafonKpr,
                'totalCair'        => $totalCair,
                'sisaCair'         => $sisaCair,
                'persenCair'       => $persenCair,
                'statusPencairan'  => $statusPencairan,
                'statusLabel'      => $statusLabel,
                'badgeClass'       => $badgeClass,
                'disbursements'    => $u->kprDisbursements,
            ];
        });

        // Filter status jika dipilih
        if ($statusCair && $statusCair !== 'all') {
            $unitsData = $unitsData->where('statusPencairan', $statusCair);
        }

        // Metrik Ringkasan KPI
        $totalPlafonKpr = $unitsData->sum('plafonKpr');
        $totalDanaCair  = $unitsData->sum('totalCair');
        $totalSisaPiutang = $unitsData->sum('sisaCair');
        $totalUnitKpr   = $unitsData->count();

        return view('keuangan.pencairan_kpr.index', compact(
            'projects',
            'unitsData',
            'totalPlafonKpr',
            'totalDanaCair',
            'totalSisaPiutang',
            'totalUnitKpr'
        ));
    }

    public function store(Request $request)
    {
        $this->authorizeFinanceAccess();

        $request->validate([
            'land_bank_unit_id' => 'required|exists:land_bank_units,id',
            'nominal_cair'      => 'required|numeric|min:1',
            'tanggal_cair'      => 'required|date',
            'nama_termin'       => 'required|string|max:100',
            'bank_penyalur'     => 'nullable|string|max:100',
            'rekening_tujuan'   => 'nullable|string|max:100',
            'no_referensi_bank' => 'nullable|string|max:100',
            'bukti_transfer'    => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf|max:10240',
            'catatan'           => 'nullable|string',
        ]);

        $unit = LandBankUnit::with('activeBooking.kprApplication')->findOrFail($request->land_bank_unit_id);
        $booking = $unit->activeBooking;
        $kprApp  = $booking?->kprApplication;

        $buktiPath = null;
        if ($request->hasFile('bukti_transfer')) {
            $file = $request->file('bukti_transfer');
            $filename = time() . '_kpr_cair_' . preg_replace('/[^A-Za-z0-9\._-]/', '', $file->getClientOriginalName());
            $destination = public_path('uploads/kpr/disbursement');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $file->move($destination, $filename);
            $buktiPath = 'uploads/kpr/disbursement/' . $filename;
        }

        $terminKe = ($unit->kprDisbursements()->count() + 1);

        DB::beginTransaction();
        try {
            $disbursement = KprDisbursement::create([
                'kpr_application_id' => $kprApp?->id,
                'land_bank_unit_id'  => $unit->id,
                'booking_id'         => $booking?->id,
                'termin_ke'          => $terminKe,
                'nama_termin'        => $request->nama_termin,
                'nominal_cair'       => $request->nominal_cair,
                'tanggal_cair'       => $request->tanggal_cair,
                'bank_penyalur'      => $request->bank_penyalur ?? ($kprApp?->bank?->bank_name ?? 'Bank KPR'),
                'rekening_tujuan'    => $request->rekening_tujuan ?? 'Rekening Operasional Developer',
                'no_referensi_bank'  => $request->no_referensi_bank,
                'bukti_transfer'     => $buktiPath,
                'catatan'            => $request->catatan,
                'created_by'         => Auth::id(),
            ]);

            // Catat juga ke payment/kas masuk jika booking tersedia
            if ($booking) {
                Payment::create([
                    'booking_id'     => $booking->id,
                    'payment_type'   => 'kpr_cair',
                    'amount'         => $request->nominal_cair,
                    'payment_date'   => $request->tanggal_cair,
                    'proof_document' => $buktiPath,
                    'status'         => 'verified',
                    'notes'          => 'Pencairan Dana KPR dari ' . ($request->bank_penyalur ?? 'Bank') . ' (' . $request->nama_termin . ')',
                ]);
            }

            DB::commit();

            return redirect()->back()->with('success', "Pencairan Dana KPR sebesar Rp " . number_format($request->nominal_cair, 0, ',', '.') . " berhasil dicatat dan masuk ke kas proyek!");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', "Gagal mencatat pencairan KPR: " . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $this->authorizeFinanceAccess();

        $disbursement = KprDisbursement::findOrFail($id);
        $disbursement->delete();

        return redirect()->back()->with('success', 'Catatan pencairan KPR berhasil dihapus.');
    }
}
