<?php

namespace App\Http\Controllers\Legal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LandBank;
use App\Models\LandBankUnit;

class LegalUnitController extends Controller
{
    /**
     * Halaman Utama: Monitoring Unit Legalitas (Membaca langsung dari Database Riil LandBankUnit).
     */
    public function index(Request $request)
    {
        $query = LandBankUnit::with(['landBank']);

        // Filter Berdasarkan Tanah / Proyek Asal
        if ($request->filled('land_bank_id') && $request->land_bank_id !== 'all') {
            $query->where('land_bank_id', (int) $request->land_bank_id);
        }

        // Filter Berdasarkan Status Penjualan
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Filter Berdasarkan Status Legalitas
        if ($request->filled('legal_status') && $request->legal_status !== 'all') {
            $ls = $request->legal_status;
            if ($ls === 'selesai') {
                $query->where('status', 'sold');
            } elseif ($ls === 'bpn') {
                $query->where('status', 'booked');
            } elseif ($ls === 'notaris') {
                $query->where('status', 'ready');
            } elseif ($ls === 'persiapan') {
                $query->where('status', 'draft');
            }
        }

        // Filter Berdasarkan Jenis (Subsidi / Komersil)
        if ($request->filled('jenis') && $request->jenis !== 'all') {
            $query->where('jenis', $request->jenis);
        }

        // Filter Pencarian (Kode Unit / Blok / Nomor / Nama / Proyek)
        if ($request->filled('search')) {
            $keyword = trim($request->search);
            $query->where(function ($q) use ($keyword) {
                $q->where('unit_code', 'like', "%{$keyword}%")
                    ->orWhere('block', 'like', "%{$keyword}%")
                    ->orWhere('unit_number', 'like', "%{$keyword}%")
                    ->orWhere('unit_name', 'like', "%{$keyword}%")
                    ->orWhereHas('landBank', function ($lq) use ($keyword) {
                        $lq->where('name', 'like', "%{$keyword}%")
                           ->orWhere('district', 'like', "%{$keyword}%")
                           ->orWhere('city', 'like', "%{$keyword}%");
                    });
            });
        }

        // KPI Ringkasan dari Keseluruhan Unit
        $allUnits = LandBankUnit::all();
        $totalUnit = $allUnits->count();
        $totalLegalSelesai = $allUnits->where('status', 'sold')->count();
        $totalProsesLegal = $allUnits->whereIn('status', ['booked', 'ready'])->count();
        $totalSold = $allUnits->whereIn('status', ['sold', 'terjual'])->count();

        // Dropdown List Tanah / Proyek Asal dari Database Riil
        $landBanks = LandBank::select('id', 'name')->orderBy('name')->get();

        // Paginasi Database Riil
        $perPage = (int) $request->input('per_page', 10);
        if (!in_array($perPage, [10, 25, 50, 100])) {
            $perPage = 10;
        }

        $units = $query->orderBy('land_bank_id')
            ->orderBy('block')
            ->orderBy('unit_number')
            ->paginate($perPage)
            ->withQueryString();

        return view('legal_unit.index', compact(
            'units',
            'landBanks',
            'totalUnit',
            'totalLegalSelesai',
            'totalProsesLegal',
            'totalSold'
        ));
    }
}
