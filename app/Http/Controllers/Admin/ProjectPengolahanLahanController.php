<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use App\Models\LandBank;
use App\Models\PraLandbank;
use Illuminate\Http\Request;

class ProjectPengolahanLahanController extends Controller
{
    /**
     * Halaman Utama: Monitoring Pengolahan Lahan Proyek (Daftar Proyek Kawasan).
     */
    public function index(Request $request)
    {
        $allProjects = $this->getProjectsList();
        $projects = clone $allProjects;

        // Filter Search
        $search = $request->get('search');
        if (!empty($search)) {
            $searchLower = strtolower(trim($search));
            $projects = $projects->filter(function ($item) use ($searchLower) {
                return str_contains(strtolower($item['nama'] ?? ''), $searchLower)
                    || str_contains(strtolower($item['pt'] ?? ''), $searchLower)
                    || str_contains(strtolower($item['lokasi'] ?? ''), $searchLower)
                    || str_contains(strtolower($item['ownership_status'] ?? ''), $searchLower);
            });
        }

        // Filter Proyek
        $proyekId = $request->get('proyek_id');
        if (!empty($proyekId) && $proyekId !== 'all') {
            $projects = $projects->where('id', (int) $proyekId);
        }

        // Filter Status
        $filterStatus = $request->get('status');
        if (!empty($filterStatus) && $filterStatus !== 'all') {
            $projects = $projects->where('status', $filterStatus);
        }

        // KPI Metrics (dihitung dari keseluruhan data)
        $totalProyek = $allProjects->count();
        $totalSelesai = $allProjects->where('status', 'Selesai')->count();
        $dalamProses = $allProjects->where('status', 'Berjalan')->count();
        $tertunda = $allProjects->where('status', 'Tertunda')->count();

        return view('pengolahan_lahan.index', compact(
            'projects',
            'allProjects',
            'proyekId',
            'filterStatus',
            'search',
            'totalProyek',
            'totalSelesai',
            'dalamProses',
            'tertunda'
        ));
    }

    /**
     * Koleksi Data Proyek Kawasan untuk Monitoring Pengolahan Lahan:
     * Mengambil tanah yang sudah DEAL DIBELI / Masuk Fase 3 Pra-Pembangunan
     * (baik skema pembayaran cash maupun termin), serta seluruh kawasan di LandBank.
     */
    private function getProjectsList()
    {
        $projects = collect();

        // 1. Ambil data dari PraLandbank yang berstatus 'approved', 'fase3',
        // atau sudah deal harga/pembayaran (cash maupun termin)
        try {
            $approvedPraLands = PraLandbank::where('status', 'approved')
                ->orWhere('status', 'fase3')
                ->orWhereNotNull('deal_price')
                ->orWhereIn('payment_method', ['cash', 'termin'])
                ->get();

            foreach ($approvedPraLands as $pra) {
                // Pastikan terhubung dengan LandBank agar modul Pengolahan Lahan bisa mengelola infrastruktur
                $landBank = null;
                if ($pra->land_bank_id) {
                    $landBank = LandBank::find($pra->land_bank_id);
                }
                if (!$landBank) {
                    $landBank = LandBank::where('name', $pra->land_name)->first();
                }
                if (!$landBank) {
                    $companyId = $pra->company_profile_id ?? (CompanyProfile::first()->id ?? null);
                    $landBank = LandBank::create([
                        'name'               => $pra->land_name,
                        'company_profile_id' => $companyId,
                        'area'               => $pra->area ?? 0,
                        'remaining_area'     => $pra->area ?? 0,
                        'acquisition_price'  => $pra->deal_price ?: ($pra->estimated_price ?: 0),
                        'acquisition_date'   => now()->toDateString(),
                        'address'            => $pra->address,
                        'village'            => $pra->village,
                        'district'           => $pra->district,
                        'city'               => $pra->city,
                        'province'           => $pra->province,
                        'ownership_status'   => $pra->ownership_status ?: 'SHGB Induk',
                        'status'             => 'active',
                        'legal_status'       => 'verified',
                        'development_status' => 'Belum'
                    ]);
                    $landBank->initializeDefaultInfrastructures();
                }

                if ($pra->land_bank_id != $landBank->id) {
                    $pra->update(['land_bank_id' => $landBank->id]);
                }

                // Inisialisasi item infrastruktur jika kosong
                if ($landBank->infrastructures()->count() === 0) {
                    $landBank->initializeDefaultInfrastructures();
                }

                // Hitung progress fisik infrastruktur
                $progress = (int) $landBank->overall_infrastructure_progress;

                // Tentukan tahapan aktif berdasarkan progress fase 1, 2, 3
                $p1 = $landBank->getPhaseProgress(1);
                $p2 = $landBank->getPhaseProgress(2);
                $p3 = $landBank->getPhaseProgress(3);

                if ($p1 < 100) {
                    $faseAktif = 'Fase 1: Cut & Fill & Pemadatan';
                } elseif ($p2 < 100) {
                    $faseAktif = 'Fase 2: Drainase & Jalan Kawasan';
                } elseif ($p3 < 100) {
                    $faseAktif = 'Fase 3: Utilitas & Fasilitas';
                } else {
                    $faseAktif = 'Selesai 100%';
                }

                // Tentukan Status (Selesai, Berjalan, Tertunda)
                $status = 'Berjalan';
                if ($progress >= 100 || in_array(strtolower($landBank->development_status), ['selesai', 'done'])) {
                    $status = 'Selesai';
                } elseif (in_array(strtolower($landBank->development_status), ['tertunda', 'kendala', 'pending'])) {
                    $status = 'Tertunda';
                }

                $lokasi = $landBank->district ? ($landBank->district . ', ' . ($landBank->city ?: 'Jember')) : ($landBank->city ?: ($pra->city ?? ($pra->district ?? ($pra->address ?: 'Jember'))));
                $ptName = $landBank->companyProfile->name ?? ($pra->companyProfile->name ?? 'PT Graha Cipta Sejahtera');
                $area = $landBank->area ?: ($pra->area ?: 0);
                $targetSelesai = $landBank->created_at ? $landBank->created_at->addMonths(6)->translatedFormat('d M Y') : '30 Des 2026';

                $projects->push([
                    'id'               => $landBank->id,
                    'pra_id'           => $pra->id,
                    'nama'             => $landBank->name ?: $pra->land_name,
                    'pt'               => $ptName,
                    'lokasi'           => $lokasi,
                    'luas'             => number_format($area, 0, ',', '.') . ' m²',
                    'ownership_status' => $landBank->ownership_status ?: ($pra->ownership_status ?: 'SHGB Induk'),
                    'payment_method'   => $pra->payment_method ? ucwords($pra->payment_method) : 'Cash / Termin',
                    'target_selesai'   => $targetSelesai,
                    'progress'         => $progress,
                    'fase_aktif'       => $faseAktif,
                    'status'           => $status,
                    'anggaran_total'   => 'Rp ' . number_format($landBank->acquisition_price ?? 0, 0, ',', '.'),
                    'realisasi_biaya'  => 'Rp ' . number_format($landBank->total_infrastructure_expense ?? 0, 0, ',', '.'),
                ]);
            }
        } catch (\Throwable $e) {
            \Log::error('Error fetching PraLandbank in pengolahan lahan: ' . $e->getMessage());
        }

        // 2. Ambil juga dari LandBank jika ada data yang belum ter-cover
        try {
            $dbLands = LandBank::with(['companyProfile', 'infrastructures'])->get();
            foreach ($dbLands as $dbl) {
                if (!$projects->contains('id', $dbl->id) && !$projects->contains('nama', $dbl->name)) {
                    if ($dbl->infrastructures->isEmpty()) {
                        $dbl->initializeDefaultInfrastructures();
                        $dbl->load('infrastructures');
                    }

                    $progress = (int) $dbl->overall_infrastructure_progress;

                    $p1 = $dbl->getPhaseProgress(1);
                    $p2 = $dbl->getPhaseProgress(2);
                    $p3 = $dbl->getPhaseProgress(3);

                    if ($p1 < 100) {
                        $faseAktif = 'Fase 1: Cut & Fill & Pemadatan';
                    } elseif ($p2 < 100) {
                        $faseAktif = 'Fase 2: Drainase & Jalan Kawasan';
                    } elseif ($p3 < 100) {
                        $faseAktif = 'Fase 3: Utilitas & Fasilitas';
                    } else {
                        $faseAktif = 'Selesai 100%';
                    }

                    $status = 'Berjalan';
                    if ($progress >= 100 || in_array(strtolower($dbl->development_status), ['selesai', 'done'])) {
                        $status = 'Selesai';
                    } elseif (in_array(strtolower($dbl->development_status), ['tertunda', 'kendala', 'pending'])) {
                        $status = 'Tertunda';
                    }

                    $lokasi = $dbl->district ? ($dbl->district . ', ' . ($dbl->city ?: 'Jember')) : ($dbl->city ?: ($dbl->address ?: 'Kaliwates, Jember'));
                    $ptName = $dbl->companyProfile->name ?? 'PT Graha Cipta Sejahtera';
                    $targetSelesai = $dbl->created_at ? $dbl->created_at->addMonths(6)->translatedFormat('d M Y') : '30 Des 2026';

                    $projects->push([
                        'id'               => $dbl->id,
                        'pra_id'           => null,
                        'nama'             => $dbl->name,
                        'pt'               => $ptName,
                        'lokasi'           => $lokasi,
                        'luas'             => number_format($dbl->area ?? 0, 0, ',', '.') . ' m²',
                        'ownership_status' => $dbl->ownership_status ?: 'SHGB Induk',
                        'payment_method'   => 'Cash / Termin',
                        'target_selesai'   => $targetSelesai,
                        'progress'         => $progress,
                        'fase_aktif'       => $faseAktif,
                        'status'           => $status,
                        'anggaran_total'   => 'Rp ' . number_format($dbl->acquisition_price ?? 0, 0, ',', '.'),
                        'realisasi_biaya'  => 'Rp ' . number_format($dbl->total_infrastructure_expense ?? 0, 0, ',', '.'),
                    ]);
                }
            }
        } catch (\Throwable $e) {
            \Log::error('Error fetching LandBank in pengolahan lahan: ' . $e->getMessage());
        }

        return $projects;
    }
}
