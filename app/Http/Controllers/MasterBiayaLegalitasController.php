<?php

namespace App\Http\Controllers;

use App\Models\MasterBiayaLegalitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MasterBiayaLegalitasController extends Controller
{
    /**
     * Tampilkan halaman Master Biaya Legalitas & Admin
     */
    public function index(Request $request)
    {
        $query = MasterBiayaLegalitas::query();

        // Filter Search
        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('nama_biaya', 'like', "%{$search}%")
                  ->orWhere('kode_biaya', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        // Filter Kategori
        if ($request->filled('kategori') && $request->kategori !== 'all') {
            $query->where('kategori', $request->kategori);
        }

        // Filter Tipe Perhitungan
        if ($request->filled('tipe_perhitungan') && $request->tipe_perhitungan !== 'all') {
            $query->where('tipe_perhitungan', $request->tipe_perhitungan);
        }

        // Filter Status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('is_active', $request->status === '1');
        }

        // Filter Sifat Baku / Standar
        if ($request->filled('is_standard') && $request->is_standard !== 'all') {
            $query->where('is_standard', $request->is_standard === '1');
        }

        $perPage = (int) $request->input('per_page', 15);
        $perPage = in_array($perPage, [10, 15, 25, 50, 100]) ? $perPage : 15;

        // Sort
        $sortField = $request->input('sortField', 'urutan');
        $sortDirection = $request->input('sortDirection', 'asc');
        $allowedSorts = ['kode_biaya', 'nama_biaya', 'kategori', 'tipe_perhitungan', 'nominal_standar', 'urutan', 'is_active'];
        if (!in_array($sortField, $allowedSorts)) {
            $sortField = 'urutan';
        }
        if (!in_array(strtolower($sortDirection), ['asc', 'desc'])) {
            $sortDirection = 'asc';
        }

        $biayas = $query->orderBy($sortField, $sortDirection)
                        ->orderBy('nama_biaya', 'asc')
                        ->paginate($perPage)
                        ->withQueryString();

        $categories = MasterBiayaLegalitas::getCategories();
        $pihakPenanggung = MasterBiayaLegalitas::getPihakPenanggung();

        $stats = [
            'total'    => MasterBiayaLegalitas::count(),
            'active'   => MasterBiayaLegalitas::where('is_active', true)->count(),
            'standard' => MasterBiayaLegalitas::where('is_standard', true)->count(),
            'custom'   => MasterBiayaLegalitas::where('is_standard', false)->count(),
        ];

        return view('master_data.biaya_legalitas.index', compact(
            'biayas',
            'categories',
            'pihakPenanggung',
            'stats'
        ));
    }

    /**
     * Ambil data item untuk modal edit (JSON)
     */
    public function edit($id)
    {
        $biaya = MasterBiayaLegalitas::findOrFail($id);
        return response()->json($biaya);
    }

    /**
     * Simpan Biaya Legalitas Baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_biaya'        => 'required|string|max:50|unique:master_biaya_legalitas,kode_biaya',
            'nama_biaya'        => 'required|string|max:255',
            'kategori'          => 'required|string|max:100',
            'tipe_perhitungan'  => 'required|in:nominal_tetap,persentase,fleksibel',
            'nominal_standar'   => 'nullable|string',
            'persentase_standar'=> 'nullable|numeric|min:0|max:100',
            'pihak_penanggung'  => 'required|string|max:50',
            'deskripsi'         => 'nullable|string',
            'urutan'            => 'nullable|integer|min:0',
        ]);

        try {
            $cleanNominal = $request->filled('nominal_standar') 
                ? (int) preg_replace('/[^0-9]/', '', $request->nominal_standar) 
                : null;

            MasterBiayaLegalitas::create([
                'kode_biaya'        => strtoupper(trim($request->kode_biaya)),
                'nama_biaya'        => trim($request->nama_biaya),
                'kategori'          => $request->kategori,
                'tipe_perhitungan'  => $request->tipe_perhitungan,
                'nominal_standar'   => $cleanNominal,
                'persentase_standar'=> $request->filled('persentase_standar') ? (float) $request->persentase_standar : null,
                'pihak_penanggung'  => $request->pihak_penanggung ?? 'perusahaan',
                'deskripsi'         => $request->deskripsi ? trim($request->deskripsi) : null,
                'urutan'            => $request->urutan ? (int) $request->urutan : 0,
                'is_standard'       => $request->boolean('is_standard', false),
                'is_required'       => $request->boolean('is_required', false),
                'is_active'         => $request->boolean('is_active', true),
            ]);

            return redirect()->route('master.biaya-legalitas.index')
                             ->with('success', 'Master Biaya Legalitas & Admin berhasil ditambahkan!');
        } catch (\Exception $e) {
            Log::error('Error store Master Biaya Legalitas: ' . $e->getMessage());
            return redirect()->back()
                             ->withInput()
                             ->with('error', 'Gagal menambahkan data: ' . $e->getMessage());
        }
    }

    /**
     * Update Biaya Legalitas
     */
    public function update(Request $request, $id)
    {
        $biaya = MasterBiayaLegalitas::findOrFail($id);

        $request->validate([
            'kode_biaya'        => 'required|string|max:50|unique:master_biaya_legalitas,kode_biaya,' . $id,
            'nama_biaya'        => 'required|string|max:255',
            'kategori'          => 'required|string|max:100',
            'tipe_perhitungan'  => 'required|in:nominal_tetap,persentase,fleksibel',
            'nominal_standar'   => 'nullable|string',
            'persentase_standar'=> 'nullable|numeric|min:0|max:100',
            'pihak_penanggung'  => 'required|string|max:50',
            'deskripsi'         => 'nullable|string',
            'urutan'            => 'nullable|integer|min:0',
        ]);

        try {
            $cleanNominal = $request->filled('nominal_standar') 
                ? (int) preg_replace('/[^0-9]/', '', $request->nominal_standar) 
                : null;

            $biaya->update([
                'kode_biaya'        => strtoupper(trim($request->kode_biaya)),
                'nama_biaya'        => trim($request->nama_biaya),
                'kategori'          => $request->kategori,
                'tipe_perhitungan'  => $request->tipe_perhitungan,
                'nominal_standar'   => $cleanNominal,
                'persentase_standar'=> $request->filled('persentase_standar') ? (float) $request->persentase_standar : null,
                'pihak_penanggung'  => $request->pihak_penanggung ?? 'perusahaan',
                'deskripsi'         => $request->deskripsi ? trim($request->deskripsi) : null,
                'urutan'            => $request->urutan ? (int) $request->urutan : 0,
                'is_standard'       => $request->boolean('is_standard', false),
                'is_required'       => $request->boolean('is_required', false),
                'is_active'         => $request->boolean('is_active', true),
            ]);

            return redirect()->route('master.biaya-legalitas.index')
                             ->with('success', 'Master Biaya Legalitas & Admin berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error('Error update Master Biaya Legalitas: ' . $e->getMessage());
            return redirect()->back()
                             ->withInput()
                             ->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    /**
     * Hapus Biaya Legalitas
     */
    public function destroy($id)
    {
        try {
            $biaya = MasterBiayaLegalitas::findOrFail($id);
            $biaya->delete();

            if (request()->ajax() || request()->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data master biaya berhasil dihapus.'
                ]);
            }

            return redirect()->route('master.biaya-legalitas.index')
                             ->with('success', 'Data master biaya berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Error delete Master Biaya Legalitas: ' . $e->getMessage());
            if (request()->ajax() || request()->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menghapus data: ' . $e->getMessage()
                ], 500);
            }
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    /**
     * Toggle status aktif/nonaktif via Ajax
     */
    public function toggleStatus($id)
    {
        try {
            $biaya = MasterBiayaLegalitas::findOrFail($id);
            $biaya->is_active = !$biaya->is_active;
            $biaya->save();

            return response()->json([
                'success'   => true,
                'is_active' => $biaya->is_active,
                'message'   => 'Status berhasil diubah menjadi ' . ($biaya->is_active ? 'Aktif' : 'Nonaktif') . '.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengubah status: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * API list untuk dropdown / picker di Pra Land Bank
     */
    public function apiList()
    {
        $items = MasterBiayaLegalitas::active()->get();
        return response()->json($items);
    }
}
