<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LandBank;
use App\Models\LandBankUnit;
use Illuminate\Support\Facades\DB;

class UnitMarketingController extends Controller
{
    /**
     * Halaman Unit Marketing: Menampilkan data unit riil dari database (kavling hasil bentukan Legal),
     * di mana Marketing berwenang menentukan & mengubah Harga Jual (price).
     */
    public function index(Request $request)
    {
        $query = LandBankUnit::with(['landBank']);

        // Filter Berdasarkan Tanah / Proyek Asal
        if ($request->filled('land_bank_id') && $request->land_bank_id !== 'all') {
            $query->where('land_bank_id', (int) $request->land_bank_id);
        }

        // Filter Berdasarkan Status
        if ($request->filled('status') && $request->status !== 'all') {
            if ($request->status === 'ready') {
                $query->whereIn('status', ['ready', 'tersedia'])->whereNotNull('price')->where('price', '>', 0);
            } elseif ($request->status === 'draft') {
                $query->where(function($q) {
                    $q->where('status', 'draft')
                      ->orWhereNull('price')
                      ->orWhere('price', '<=', 0);
                })->whereNotIn('status', ['booked', 'booking', 'sold', 'terjual']);
            } else {
                $query->where('status', $request->status);
            }
        }

        // Filter Berdasarkan Status Harga (Sudah Diset / Belum Diset)
        if ($request->filled('status_harga') && $request->status_harga !== 'all') {
            if ($request->status_harga === 'belum') {
                $query->where(function($q) {
                    $q->whereNull('price')->orWhere('price', '<=', 0);
                });
            } elseif ($request->status_harga === 'sudah') {
                $query->where('price', '>', 0);
            }
        }

        // Filter Berdasarkan Jenis (Subsidi / Komersil)
        if ($request->filled('jenis') && $request->jenis !== 'all') {
            $query->where('jenis', $request->jenis);
        }

        // Filter Pencarian
        if ($request->filled('search')) {
            $keyword = trim($request->search);
            $query->where(function ($q) use ($keyword) {
                $q->where('unit_code', 'like', "%{$keyword}%")
                    ->orWhere('block', 'like', "%{$keyword}%")
                    ->orWhere('unit_number', 'like', "%{$keyword}%")
                    ->orWhere('unit_name', 'like', "%{$keyword}%")
                    ->orWhereHas('landBank', function ($lq) use ($keyword) {
                        $lq->where('name', 'like', "%{$keyword}%");
                    });
            });
        }

        // KPI Ringkasan Data Riil
        $allUnits = LandBankUnit::all();
        $totalUnit = $allUnits->count();
        $totalHargaBelumSet = $allUnits->filter(function($u) {
            return empty($u->price) || $u->price <= 0;
        })->count();
        $totalHargaSudahSet = $allUnits->filter(function($u) {
            return !empty($u->price) && $u->price > 0;
        })->count();
        $totalAvailable = $allUnits->filter(function($u) {
            return in_array($u->status, ['ready', 'tersedia']) && !empty($u->price) && $u->price > 0;
        })->count();
        $totalBooking = $allUnits->where('status', 'booked')->count();
        $totalSold = $allUnits->whereIn('status', ['sold', 'terjual'])->count();

        // Dropdown List Tanah / Proyek Asal
        $landBanks = LandBank::select('id', 'name')->orderBy('name')->get();

        // Paginasi
        $perPage = (int) $request->input('per_page', 10);
        if (!in_array($perPage, [10, 25, 50, 100])) {
            $perPage = 10;
        }

        $units = $query->orderBy('land_bank_id')
            ->orderBy('block')
            ->orderBy('unit_number')
            ->paginate($perPage)
            ->withQueryString();

        return view('marketing.unit.index', compact(
            'units',
            'landBanks',
            'totalUnit',
            'totalHargaBelumSet',
            'totalHargaSudahSet',
            'totalAvailable',
            'totalBooking',
            'totalSold'
        ));
    }

    /**
     * Update Harga Jual Unit oleh Marketing
     */
    public function updatePrice(Request $request, $id)
    {
        // Bersihkan formatting rupiah (titik/koma/spasi) jika dikirim dalam format angka berpemisah
        if ($request->has('price')) {
            $rawPrice = preg_replace('/[^0-9]/', '', (string) $request->price);
            $request->merge(['price' => $rawPrice]);
        }

        $request->validate([
            'price' => 'required|numeric|min:0',
            'status' => 'nullable|string',
        ]);

        $unit = LandBankUnit::findOrFail($id);
        $unit->price = $request->price;
        
        // Jika harga belum diset atau 0, status harus draft
        if (empty($unit->price) || (float)$unit->price <= 0) {
            if (!in_array($unit->status, ['booked', 'booking', 'sold', 'terjual'])) {
                $unit->status = 'draft';
            }
        } elseif ($request->filled('status')) {
            $unit->status = $request->status;
        } elseif (empty($unit->status) || $unit->status === 'draft') {
            $unit->status = 'ready'; // Otomatis siap pasarkan saat harga sudah ditentukan > 0
        }

        $unit->save();

        return redirect()->back()->with('success', "Harga Jual Unit {$unit->unit_code} berhasil diperbarui menjadi Rp " . number_format($unit->price, 0, ',', '.'));
    }
}
