<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class ProjectUnitController extends Controller
{
    /**
     * Halaman Utama: Daftar Unit Proyek Kawasan (Dummy Data In-Memory).
     * Menampilkan daftar unit dan nama tanah / proyek asal unit tersebut.
     */
    public function index(Request $request)
    {
        $allUnits = $this->getDummyUnits();

        $filteredUnits = $allUnits;

        // Filter Berdasarkan Tanah / Proyek Asal
        if ($request->filled('land_bank_id') && $request->land_bank_id !== 'all') {
            $filteredUnits = $filteredUnits->where('land_bank_id', (int) $request->land_bank_id);
        }

        // Filter Berdasarkan Status
        if ($request->filled('status') && $request->status !== 'all') {
            $filteredUnits = $filteredUnits->where('status', $request->status);
        }

        // Filter Berdasarkan Jenis (Subsidi / Komersil)
        if ($request->filled('jenis') && $request->jenis !== 'all') {
            $filteredUnits = $filteredUnits->where('jenis', $request->jenis);
        }

        // Filter Pencarian (Kode Unit / Blok / Nama)
        if ($request->filled('search')) {
            $keyword = strtolower(trim($request->search));
            $filteredUnits = $filteredUnits->filter(function ($item) use ($keyword) {
                return str_contains(strtolower($item->unit_code), $keyword) ||
                       str_contains(strtolower($item->block), $keyword) ||
                       str_contains(strtolower($item->unit_number), $keyword) ||
                       str_contains(strtolower($item->unit_name), $keyword) ||
                       str_contains(strtolower($item->landBank->name ?? ''), $keyword);
            });
        }

        // KPI Ringkasan
        $totalUnit = $allUnits->count();
        $totalAvailable = $allUnits->where('status', 'available')->count();
        $totalBooking = $allUnits->where('status', 'booking')->count();
        $totalSold = $allUnits->whereIn('status', ['sold', 'terjual'])->count();

        // Dropdown List Tanah / Proyek Asal
        $landBanks = collect([
            (object)['id' => 1, 'name' => 'Perumahan Jember Indah'],
            (object)['id' => 2, 'name' => 'Graha Harmoni Kaliwates'],
        ]);

        // Pagination In-Memory
        $currentPage = Paginator::resolveCurrentPage() ?: 1;
        $perPage = 10;
        $currentPageItems = $filteredUnits->slice(($currentPage - 1) * $perPage, $perPage)->values();
        
        $units = new LengthAwarePaginator(
            $currentPageItems,
            $filteredUnits->count(),
            $perPage,
            $currentPage,
            ['path' => Paginator::resolveCurrentPath(), 'query' => $request->query()]
        );

        return view('proyek_unit.index', compact(
            'units',
            'landBanks',
            'totalUnit',
            'totalAvailable',
            'totalBooking',
            'totalSold'
        ));
    }

    /**
     * Data Dummy Unit Kavling Proyek
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
                    'city' => 'Kaliwates, Jember',
                ],
                'unit_code' => 'A-01',
                'block' => 'A',
                'unit_number' => '01',
                'unit_name' => 'Tipe 36/72 Standar',
                'type' => '36/72',
                'jenis' => 'subsidi',
                'area' => 72,
                'building_area' => 36,
                'price' => 168000000,
                'status' => 'available',
                'construction_progress' => 'Finishing',
                'construction_progress_percentage' => 85,
            ],
            (object)[
                'id' => 2,
                'land_bank_id' => 1,
                'landBank' => (object)[
                    'id' => 1,
                    'name' => 'Perumahan Jember Indah',
                    'city' => 'Kaliwates, Jember',
                ],
                'unit_code' => 'A-02',
                'block' => 'A',
                'unit_number' => '02',
                'unit_name' => 'Tipe 36/72 Standar',
                'type' => '36/72',
                'jenis' => 'subsidi',
                'area' => 72,
                'building_area' => 36,
                'price' => 168000000,
                'status' => 'booking',
                'construction_progress' => 'Dinding & Plester',
                'construction_progress_percentage' => 50,
            ],
            (object)[
                'id' => 3,
                'land_bank_id' => 1,
                'landBank' => (object)[
                    'id' => 1,
                    'name' => 'Perumahan Jember Indah',
                    'city' => 'Kaliwates, Jember',
                ],
                'unit_code' => 'A-03',
                'block' => 'A',
                'unit_number' => '03',
                'unit_name' => 'Tipe 36/72 Standar',
                'type' => '36/72',
                'jenis' => 'subsidi',
                'area' => 72,
                'building_area' => 36,
                'price' => 168000000,
                'status' => 'sold',
                'construction_progress' => 'Selesai 100%',
                'construction_progress_percentage' => 100,
            ],
            (object)[
                'id' => 4,
                'land_bank_id' => 1,
                'landBank' => (object)[
                    'id' => 1,
                    'name' => 'Perumahan Jember Indah',
                    'city' => 'Kaliwates, Jember',
                ],
                'unit_code' => 'B-01',
                'block' => 'B',
                'unit_number' => '01',
                'unit_name' => 'Tipe 45/90 Komersil',
                'type' => '45/90',
                'jenis' => 'komersil',
                'area' => 90,
                'building_area' => 45,
                'price' => 285000000,
                'status' => 'available',
                'construction_progress' => 'Pondasi & Struktur',
                'construction_progress_percentage' => 25,
            ],
            (object)[
                'id' => 5,
                'land_bank_id' => 1,
                'landBank' => (object)[
                    'id' => 1,
                    'name' => 'Perumahan Jember Indah',
                    'city' => 'Kaliwates, Jember',
                ],
                'unit_code' => 'B-02',
                'block' => 'B',
                'unit_number' => '02',
                'unit_name' => 'Tipe 45/90 Komersil',
                'type' => '45/90',
                'jenis' => 'komersil',
                'area' => 90,
                'building_area' => 45,
                'price' => 285000000,
                'status' => 'available',
                'construction_progress' => 'Belum Mulai',
                'construction_progress_percentage' => 0,
            ],
            (object)[
                'id' => 6,
                'land_bank_id' => 1,
                'landBank' => (object)[
                    'id' => 1,
                    'name' => 'Perumahan Jember Indah',
                    'city' => 'Kaliwates, Jember',
                ],
                'unit_code' => 'B-03',
                'block' => 'B',
                'unit_number' => '03',
                'unit_name' => 'Tipe 45/105 Hook',
                'type' => '45/105',
                'jenis' => 'komersil',
                'area' => 105,
                'building_area' => 45,
                'price' => 315000000,
                'status' => 'booking',
                'construction_progress' => 'Rangka Atap',
                'construction_progress_percentage' => 70,
            ],
            (object)[
                'id' => 7,
                'land_bank_id' => 2,
                'landBank' => (object)[
                    'id' => 2,
                    'name' => 'Graha Harmoni Kaliwates',
                    'city' => 'Kaliwates, Jember',
                ],
                'unit_code' => 'H-01',
                'block' => 'H',
                'unit_number' => '01',
                'unit_name' => 'Tipe 36/60 Minimalis',
                'type' => '36/60',
                'jenis' => 'subsidi',
                'area' => 60,
                'building_area' => 36,
                'price' => 165000000,
                'status' => 'available',
                'construction_progress' => 'Pondasi',
                'construction_progress_percentage' => 15,
            ],
            (object)[
                'id' => 8,
                'land_bank_id' => 2,
                'landBank' => (object)[
                    'id' => 2,
                    'name' => 'Graha Harmoni Kaliwates',
                    'city' => 'Kaliwates, Jember',
                ],
                'unit_code' => 'H-02',
                'block' => 'H',
                'unit_number' => '02',
                'unit_name' => 'Tipe 36/60 Minimalis',
                'type' => '36/60',
                'jenis' => 'subsidi',
                'area' => 60,
                'building_area' => 36,
                'price' => 165000000,
                'status' => 'available',
                'construction_progress' => 'Belum Mulai',
                'construction_progress_percentage' => 0,
            ],
            (object)[
                'id' => 9,
                'land_bank_id' => 2,
                'landBank' => (object)[
                    'id' => 2,
                    'name' => 'Graha Harmoni Kaliwates',
                    'city' => 'Kaliwates, Jember',
                ],
                'unit_code' => 'H-03',
                'block' => 'H',
                'unit_number' => '03',
                'unit_name' => 'Tipe 36/60 Minimalis',
                'type' => '36/60',
                'jenis' => 'subsidi',
                'area' => 60,
                'building_area' => 36,
                'price' => 165000000,
                'status' => 'sold',
                'construction_progress' => 'Finishing',
                'construction_progress_percentage' => 90,
            ],
            (object)[
                'id' => 10,
                'land_bank_id' => 2,
                'landBank' => (object)[
                    'id' => 2,
                    'name' => 'Graha Harmoni Kaliwates',
                    'city' => 'Kaliwates, Jember',
                ],
                'unit_code' => 'K-01',
                'block' => 'K',
                'unit_number' => '01',
                'unit_name' => 'Tipe 54/120 Premium',
                'type' => '54/120',
                'jenis' => 'komersil',
                'area' => 120,
                'building_area' => 54,
                'price' => 450000000,
                'status' => 'available',
                'construction_progress' => 'Pondasi',
                'construction_progress_percentage' => 20,
            ],
        ]);
    }
}
