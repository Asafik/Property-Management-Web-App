<?php

namespace App\Http\Controllers;

use App\Models\MasterSkemaKpr;
use App\Models\Banks;
use Illuminate\Http\Request;

class MasterSkemaKprController extends Controller
{
    /**
     * Tampilkan data master skema KPR
     */
    public function index(Request $request)
    {
        $query = MasterSkemaKpr::with('bank');

        // Filter Bank
        if ($request->filled('bank_id')) {
            $query->where('bank_id', $request->bank_id);
        }

        // Filter Tenor
        if ($request->filled('tenor')) {
            $query->where('tenor', $request->tenor);
        }

        // Filter Produk
        if ($request->filled('produk_kpr')) {
            $query->where('produk_kpr', $request->produk_kpr);
        }

        // Search kata kunci
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_skema', 'like', "%{$search}%")
                  ->orWhere('periode_tahun', 'like', "%{$search}%")
                  ->orWhereHas('bank', function ($bq) use ($search) {
                      $bq->where('bank_name', 'like', "%{$search}%");
                  });
            });
        }

        $perPage = $request->input('per_page', 15);
        $skemas = $query->orderBy('bank_id', 'asc')
                        ->orderBy('tenor', 'asc')
                        ->orderBy('id', 'asc')
                        ->paginate($perPage)
                        ->withQueryString();

        $banks = Banks::where('is_active', true)->orderBy('bank_name', 'asc')->get();

        return view('master.skema_kpr.index', compact('skemas', 'banks'));
    }

    /**
     * Halaman form tambah skema KPR baru
     */
    public function create()
    {
        $banks = Banks::where('is_active', true)->orderBy('bank_name', 'asc')->get();
        return view('master.skema_kpr.create', compact('banks'));
    }

    /**
     * Simpan skema KPR baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'bank_id'            => 'required|exists:banks,id',
            'produk_kpr'         => 'required|string|max:50',
            'nama_skema'         => 'nullable|string|max:255',
            'tenor'              => 'required|integer|min:1',
            'bunga'              => 'required|numeric|min:0',
            'periode_tahun'      => 'required|string|max:100',
            'angsuran_per_bulan' => 'required|numeric|min:0',
            'keterangan'         => 'nullable|string',
            'is_active'          => 'nullable|boolean',
        ]);

        MasterSkemaKpr::create([
            'bank_id'            => $request->bank_id,
            'produk_kpr'         => $request->produk_kpr,
            'nama_skema'         => $request->nama_skema,
            'tenor'              => $request->tenor,
            'bunga'              => $request->bunga,
            'periode_tahun'      => $request->periode_tahun,
            'angsuran_per_bulan' => $request->angsuran_per_bulan,
            'keterangan'         => $request->keterangan,
            'is_active'          => $request->has('is_active') ? (bool)$request->is_active : true,
        ]);

        return redirect()->route('master.skema-kpr.index')->with('success', 'Skema angsuran KPR berhasil ditambahkan.');
    }

    /**
     * Halaman edit skema KPR (atau JSON jika request AJAX)
     */
    public function edit(Request $request, $id)
    {
        $skema = MasterSkemaKpr::with('bank')->findOrFail($id);
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json($skema);
        }
        $banks = Banks::where('is_active', true)->orderBy('bank_name', 'asc')->get();
        return view('master.skema_kpr.edit', compact('skema', 'banks'));
    }

    /**
     * Update data skema KPR
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'bank_id'            => 'required|exists:banks,id',
            'produk_kpr'         => 'required|string|max:50',
            'nama_skema'         => 'nullable|string|max:255',
            'tenor'              => 'required|integer|min:1',
            'bunga'              => 'required|numeric|min:0',
            'periode_tahun'      => 'required|string|max:100',
            'angsuran_per_bulan' => 'required|numeric|min:0',
            'keterangan'         => 'nullable|string',
            'is_active'          => 'nullable|boolean',
        ]);

        $skema = MasterSkemaKpr::findOrFail($id);
        $skema->update([
            'bank_id'            => $request->bank_id,
            'produk_kpr'         => $request->produk_kpr,
            'nama_skema'         => $request->nama_skema,
            'tenor'              => $request->tenor,
            'bunga'              => $request->bunga,
            'periode_tahun'      => $request->periode_tahun,
            'angsuran_per_bulan' => $request->angsuran_per_bulan,
            'keterangan'         => $request->keterangan,
            'is_active'          => $request->has('is_active') ? (bool)$request->is_active : true,
        ]);

        return redirect()->route('master.skema-kpr.index')->with('success', 'Skema angsuran KPR berhasil diperbarui.');
    }

    /**
     * Hapus data skema KPR
     */
    public function destroy($id)
    {
        try {
            $skema = MasterSkemaKpr::findOrFail($id);
            $skema->delete();
            return redirect()->route('master.skema-kpr.index')->with('success', 'Skema angsuran KPR berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('master.skema-kpr.index')->with('error', 'Gagal menghapus skema KPR: ' . $e->getMessage());
        }
    }

    /**
     * API AJAX untuk mengambil skema KPR berdasarkan Bank, Tenor, dan Produk
     */
    public function getSkemaAjax(Request $request)
    {
        $bankId    = $request->get('bank_id');
        $tenor     = $request->get('tenor');
        $produkKpr = $request->get('produk_kpr');

        if (!$bankId || !$tenor) {
            return response()->json([
                'success' => false,
                'data'    => [],
                'message' => 'Parameter bank_id dan tenor wajib diisi.'
            ]);
        }

        $query = MasterSkemaKpr::where('bank_id', $bankId)
            ->where('tenor', $tenor)
            ->where('is_active', true);

        if ($produkKpr) {
            $query->where('produk_kpr', $produkKpr);
        }

        $skemas = $query->orderBy('id', 'asc')->get();

        // Jika tidak ditemukan dengan produk spesifik, fallback cari tanpa filter produk
        if ($skemas->isEmpty() && $produkKpr) {
            $skemas = MasterSkemaKpr::where('bank_id', $bankId)
                ->where('tenor', $tenor)
                ->where('is_active', true)
                ->orderBy('id', 'asc')
                ->get();
        }

        return response()->json([
            'success' => true,
            'data'    => $skemas,
            'count'   => $skemas->count(),
        ]);
    }
}
