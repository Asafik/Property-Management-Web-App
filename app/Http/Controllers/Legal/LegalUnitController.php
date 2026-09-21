<?php

namespace App\Http\Controllers\Legal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use App\Models\LandBank;

class LegalUnitController extends Controller
{
    /**
     * Halaman Utama: Monitoring Unit Legalitas (Dummy Data In-Memory persis Proyek Unit).
     */
    public function index(Request $request)
    {
        $allUnits = $this->getDummyUnits();

        $filteredUnits = $allUnits;

        // Filter Berdasarkan Tanah / Proyek Asal
        if ($request->filled('land_bank_id') && $request->land_bank_id !== 'all') {
            $filteredUnits = $filteredUnits->where('land_bank_id', (int) $request->land_bank_id);
        }

        // Filter Berdasarkan Status Penjualan
        if ($request->filled('status') && $request->status !== 'all') {
            $filteredUnits = $filteredUnits->where('status', $request->status);
        }

        // Filter Berdasarkan Status Legalitas
        if ($request->filled('legal_status') && $request->legal_status !== 'all') {
            $filteredUnits = $filteredUnits->where('legal_status_key', $request->legal_status);
        }

        // Filter Berdasarkan Jenis (Subsidi / Komersil)
        if ($request->filled('jenis') && $request->jenis !== 'all') {
            $filteredUnits = $filteredUnits->where('jenis', $request->jenis);
        }

        // Filter Pencarian (Kode Unit / Blok / Nama / Sertifikat)
        if ($request->filled('search')) {
            $keyword = strtolower(trim($request->search));
            $filteredUnits = $filteredUnits->filter(function ($item) use ($keyword) {
                return str_contains(strtolower($item->unit_code), $keyword) ||
                       str_contains(strtolower($item->block), $keyword) ||
                       str_contains(strtolower($item->unit_number), $keyword) ||
                       str_contains(strtolower($item->unit_name), $keyword) ||
                       str_contains(strtolower($item->no_sertifikat), $keyword) ||
                       str_contains(strtolower($item->landBank->name ?? ''), $keyword);
            });
        }

        // KPI Ringkasan
        $totalUnit = $allUnits->count();
        $totalLegalSelesai = $allUnits->where('legal_status_key', 'selesai')->count();
        $totalProsesLegal = $allUnits->whereIn('legal_status_key', ['bpn', 'notaris'])->count();
        $totalSold = $allUnits->whereIn('status', ['sold', 'terjual'])->count();

        // Dropdown List Tanah / Proyek Asal
        $realLands = LandBank::select('id', 'name')->get();
        if ($realLands->isNotEmpty()) {
            $landBanks = $realLands;
        } else {
            $landBanks = collect([
                (object)['id' => 1, 'name' => 'Perumahan Jember Indah'],
                (object)['id' => 2, 'name' => 'Graha Harmoni Kaliwates'],
            ]);
        }

        // Pagination In-Memory
        $currentPage = Paginator::resolveCurrentPage() ?: 1;
        $perPage = (int) $request->input('per_page', 10);
        if (!in_array($perPage, [10, 25, 50, 100])) {
            $perPage = 10;
        }

        $currentPageItems = $filteredUnits->slice(($currentPage - 1) * $perPage, $perPage)->values();
        
        $units = new LengthAwarePaginator(
            $currentPageItems,
            $filteredUnits->count(),
            $perPage,
            $currentPage,
            ['path' => Paginator::resolveCurrentPath(), 'query' => $request->query()]
        );

        return view('legal_unit.index', compact(
            'units',
            'landBanks',
            'totalUnit',
            'totalLegalSelesai',
            'totalProsesLegal',
            'totalSold'
        ));
    }

    /**
     * Data Dummy Unit Legalitas (In-Memory)
     */
    private function getDummyUnits()
    {
        return collect([
            (object)[
                'id' => 1,
                'land_bank_id' => 1,
                'landBank' => (object)[
                    'id' => 1,
                    'name' => 'Perumahan Jember Indah',
                ],
                'unit_code' => 'A-01',
                'block' => 'A',
                'unit_number' => '01',
                'unit_name' => 'Tipe 36/72 Standar',
                'type' => '36/72',
                'jenis' => 'subsidi',
                'area' => 72,
                'building_area' => 36,
                'status' => 'available',
                'legal_status_key' => 'selesai',
                'legal_status_label' => 'SHM Terbit',
                'legal_progress_percentage' => 100,
                'no_sertifikat' => 'SHM No. 04821/Kaliwates',
                'no_pbb' => '35.09.010.004-0021.0',
                'no_pbg' => 'SK-PBG-3509-2024-0012',
                'status_pajak' => 'Lunas 2026',
            ],
            (object)[
                'id' => 2,
                'land_bank_id' => 1,
                'landBank' => (object)[
                    'id' => 1,
                    'name' => 'Perumahan Jember Indah',
                ],
                'unit_code' => 'A-02',
                'block' => 'A',
                'unit_number' => '02',
                'unit_name' => 'Tipe 36/72 Standar',
                'type' => '36/72',
                'jenis' => 'subsidi',
                'area' => 72,
                'building_area' => 36,
                'status' => 'booking',
                'legal_status_key' => 'bpn',
                'legal_status_label' => 'Proses Pecah BPN',
                'legal_progress_percentage' => 70,
                'no_sertifikat' => 'Proses BPN (Berkas Masuk)',
                'no_pbb' => '35.09.010.004-0022.0',
                'no_pbg' => 'SK-PBG-3509-2024-0013',
                'status_pajak' => 'Lunas 2026',
            ],
            (object)[
                'id' => 3,
                'land_bank_id' => 1,
                'landBank' => (object)[
                    'id' => 1,
                    'name' => 'Perumahan Jember Indah',
                ],
                'unit_code' => 'A-03',
                'block' => 'A',
                'unit_number' => '03',
                'unit_name' => 'Tipe 36/72 Standar',
                'type' => '36/72',
                'jenis' => 'subsidi',
                'area' => 72,
                'building_area' => 36,
                'status' => 'sold',
                'legal_status_key' => 'selesai',
                'legal_status_label' => 'SHM Atas Nama Pembeli',
                'legal_progress_percentage' => 100,
                'no_sertifikat' => 'SHM No. 04823/Kaliwates',
                'no_pbb' => '35.09.010.004-0023.0',
                'no_pbg' => 'SK-PBG-3509-2024-0014',
                'status_pajak' => 'Lunas 2026',
            ],
            (object)[
                'id' => 4,
                'land_bank_id' => 1,
                'landBank' => (object)[
                    'id' => 1,
                    'name' => 'Perumahan Jember Indah',
                ],
                'unit_code' => 'B-01',
                'block' => 'B',
                'unit_number' => '01',
                'unit_name' => 'Tipe 45/90 Komersil',
                'type' => '45/90',
                'jenis' => 'komersil',
                'area' => 90,
                'building_area' => 45,
                'status' => 'available',
                'legal_status_key' => 'selesai',
                'legal_status_label' => 'SHM Terbit',
                'legal_progress_percentage' => 100,
                'no_sertifikat' => 'SHM No. 04830/Kaliwates',
                'no_pbb' => '35.09.010.004-0024.0',
                'no_pbg' => 'SK-PBG-3509-2024-0015',
                'status_pajak' => 'Lunas 2026',
            ],
            (object)[
                'id' => 5,
                'land_bank_id' => 1,
                'landBank' => (object)[
                    'id' => 1,
                    'name' => 'Perumahan Jember Indah',
                ],
                'unit_code' => 'B-02',
                'block' => 'B',
                'unit_number' => '02',
                'unit_name' => 'Tipe 45/90 Komersil',
                'type' => '45/90',
                'jenis' => 'komersil',
                'area' => 90,
                'building_area' => 45,
                'status' => 'available',
                'legal_status_key' => 'notaris',
                'legal_status_label' => 'Validasi Notaris',
                'legal_progress_percentage' => 40,
                'no_sertifikat' => 'Draft Akta / Notaris',
                'no_pbb' => '35.09.010.004-0025.0',
                'no_pbg' => 'SK-PBG-3509-2024-0016',
                'status_pajak' => 'Lunas 2026',
            ],
            (object)[
                'id' => 6,
                'land_bank_id' => 1,
                'landBank' => (object)[
                    'id' => 1,
                    'name' => 'Perumahan Jember Indah',
                ],
                'unit_code' => 'B-03',
                'block' => 'B',
                'unit_number' => '03',
                'unit_name' => 'Tipe 45/105 Hook',
                'type' => '45/105',
                'jenis' => 'komersil',
                'area' => 105,
                'building_area' => 45,
                'status' => 'booking',
                'legal_status_key' => 'bpn',
                'legal_status_label' => 'Proses Pengukuran BPN',
                'legal_progress_percentage' => 60,
                'no_sertifikat' => 'Plotting Gambar Ukur BPN',
                'no_pbb' => '35.09.010.004-0026.0',
                'no_pbg' => 'SK-PBG-3509-2024-0017',
                'status_pajak' => 'Lunas 2026',
            ],
            (object)[
                'id' => 7,
                'land_bank_id' => 2,
                'landBank' => (object)[
                    'id' => 2,
                    'name' => 'Graha Harmoni Kaliwates',
                ],
                'unit_code' => 'H-01',
                'block' => 'H',
                'unit_number' => '01',
                'unit_name' => 'Tipe 36/60 Minimalis',
                'type' => '36/60',
                'jenis' => 'subsidi',
                'area' => 60,
                'building_area' => 36,
                'status' => 'available',
                'legal_status_key' => 'persiapan',
                'legal_status_label' => 'Persiapan Berkas',
                'legal_progress_percentage' => 25,
                'no_sertifikat' => 'Induk Belum Dipecah',
                'no_pbb' => 'Dalam Pengajuan',
                'no_pbg' => 'Dalam Pengajuan',
                'status_pajak' => 'Menunggu Verifikasi',
            ],
            (object)[
                'id' => 8,
                'land_bank_id' => 2,
                'landBank' => (object)[
                    'id' => 2,
                    'name' => 'Graha Harmoni Kaliwates',
                ],
                'unit_code' => 'H-02',
                'block' => 'H',
                'unit_number' => '02',
                'unit_name' => 'Tipe 36/60 Minimalis',
                'type' => '36/60',
                'jenis' => 'subsidi',
                'area' => 60,
                'building_area' => 36,
                'status' => 'available',
                'legal_status_key' => 'persiapan',
                'legal_status_label' => 'Persiapan Berkas',
                'legal_progress_percentage' => 20,
                'no_sertifikat' => 'Induk Belum Dipecah',
                'no_pbb' => 'Dalam Pengajuan',
                'no_pbg' => 'Dalam Pengajuan',
                'status_pajak' => 'Menunggu Verifikasi',
            ],
            (object)[
                'id' => 9,
                'land_bank_id' => 2,
                'landBank' => (object)[
                    'id' => 2,
                    'name' => 'Graha Harmoni Kaliwates',
                ],
                'unit_code' => 'H-03',
                'block' => 'H',
                'unit_number' => '03',
                'unit_name' => 'Tipe 36/60 Minimalis',
                'type' => '36/60',
                'jenis' => 'subsidi',
                'area' => 60,
                'building_area' => 36,
                'status' => 'sold',
                'legal_status_key' => 'selesai',
                'legal_status_label' => 'SHM Terbit',
                'legal_progress_percentage' => 100,
                'no_sertifikat' => 'SHM No. 05112/Kaliwates',
                'no_pbb' => '35.09.010.005-0012.0',
                'no_pbg' => 'SK-PBG-3509-2024-0030',
                'status_pajak' => 'Lunas 2026',
            ],
            (object)[
                'id' => 10,
                'land_bank_id' => 2,
                'landBank' => (object)[
                    'id' => 2,
                    'name' => 'Graha Harmoni Kaliwates',
                ],
                'unit_code' => 'H-04',
                'block' => 'H',
                'unit_number' => '04',
                'unit_name' => 'Tipe 36/60 Minimalis',
                'type' => '36/60',
                'jenis' => 'subsidi',
                'area' => 60,
                'building_area' => 36,
                'status' => 'booking',
                'legal_status_key' => 'bpn',
                'legal_status_label' => 'Proses Pecah BPN',
                'legal_progress_percentage' => 75,
                'no_sertifikat' => 'Proses BPN (Verifikasi Akhir)',
                'no_pbb' => '35.09.010.005-0013.0',
                'no_pbg' => 'SK-PBG-3509-2024-0031',
                'status_pajak' => 'Lunas 2026',
            ],
        ]);
    }
}
