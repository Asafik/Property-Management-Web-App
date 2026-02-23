<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LandBank; // Pastikan model ini ada

class LokasiController extends Controller
{
    public function index(Request $request)
    {
        $query = LandBank::with('units');

        // 🔎 Search nama properti
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // 🏷️ Filter kategori
        if ($request->filled('kategori')) {
            $query->where('zoning', $request->kategori);
        }

        // 📄 Jumlah tampil
        $perPage = $request->tampil ?? 10;

        $landBanks = $query->paginate($perPage)->withQueryString();

        // Data lokasi untuk map
        $locations = $landBanks->map(function ($lb) {
            return [
                'name' => $lb->name,
                'address' => $lb->address,
                'lat' => $lb->lat,
                'lng' => $lb->lng,
                'zoning' => $lb->zoning,
                'acquisition_price' => $lb->acquisition_price,
                'status' => $lb->status,
            ];
        });

        // Statistik
        $totalLandBanks = $landBanks->total();

        $totalReady = $landBanks->sum(function ($lb) {
            return $lb->units->where('status', 'ready')->count();
        });

        $totalBooked = $landBanks->sum(function ($lb) {
            return $lb->units->where('status', 'booked')->count();
        });

        $totalSold = $landBanks->sum(function ($lb) {
            return $lb->units->where('status', 'sold')->count();
        });
        $zonings = LandBank::whereNotNull('zoning')
            ->where('zoning', '!=', '')
            ->distinct()
            ->orderBy('zoning')
            ->pluck('zoning');

        return view('lokasi.lokasi', compact(
            'locations',
            'landBanks',
            'totalLandBanks',
            'totalReady',
            'totalBooked',
            'totalSold',
            'zonings'
        ));
    }
    public function lokasiData()
    {
        // Ambil semua data land_bank
        $locations = LandBank::select('name', 'address', 'lat', 'lng', 'zoning', 'acquisition_price', 'status')->get();

        // Ubah key supaya JS tidak error
        $locations = $locations->map(function ($loc) {
            return [
                'name' => $loc->name,
                'address' => $loc->address,
                'lat' => $loc->lat,
                'lng' => $loc->lng,
                'category' => $loc->zoning, // disesuaikan
                'price' => $loc->acquisition_price,
                'status' => $loc->status,
            ];
        });

        return response()->json($locations);
    }
}
