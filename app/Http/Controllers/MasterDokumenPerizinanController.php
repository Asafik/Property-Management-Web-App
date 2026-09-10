<?php

namespace App\Http\Controllers;

use App\Models\MasterDokumenPerizinan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MasterDokumenPerizinanController extends Controller
{
    /**
     * Tampilkan halaman Master Dokumen Perizinan
     */
    public function index(Request $request)
    {
        $query = MasterDokumenPerizinan::query();

        // Filter Search
        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('nama_dokumen', 'like', "%{$search}%")
                  ->orWhere('kode_dokumen', 'like', "%{$search}%")
                  ->orWhere('instansi_terkait', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        // Filter Kategori
        if ($request->filled('kategori') && $request->kategori !== 'all') {
            $query->where('kategori', $request->kategori);
        }

        // Filter Status
        if ($request->filled('is_active') && $request->is_active !== 'all') {
            $query->where('is_active', $request->is_active === '1');
        }

        $perPage = (int) $request->input('per_page', 15);
        $perPage = in_array($perPage, [10, 15, 25, 50, 100]) ? $perPage : 15;

        $documents = $query->orderBy('urutan', 'asc')
                           ->orderBy('nama_dokumen', 'asc')
                           ->paginate($perPage)
                           ->withQueryString();

        $categories = MasterDokumenPerizinan::getCategories();
        $stats = [
            'total'    => MasterDokumenPerizinan::count(),
            'active'   => MasterDokumenPerizinan::where('is_active', true)->count(),
            'required' => MasterDokumenPerizinan::where('is_required', true)->count(),
        ];

        return view('master_data.dokumen_perizinan.index', compact(
            'documents',
            'categories',
            'stats'
        ));
    }

    /**
     * Ambil data dokumen perizinan untuk Edit modal (JSON)
     */
    public function edit($id)
    {
        $dokumen = MasterDokumenPerizinan::findOrFail($id);
        return response()->json($dokumen);
    }

    /**
     * Simpan Dokumen Perizinan Baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_dokumen'     => 'required|string|max:50|unique:master_dokumen_perizinans,kode_dokumen',
            'nama_dokumen'     => 'required|string|max:255',
            'kategori'         => 'required|string|max:100',
            'instansi_terkait' => 'nullable|string|max:255',
            'estimasi_hari'    => 'nullable|integer|min:0',
            'estimasi_biaya'   => 'nullable|string',
            'syarat_dokumen'   => 'nullable|string',
            'deskripsi'        => 'nullable|string',
            'urutan'           => 'nullable|integer|min:0',
        ]);

        try {
            $cleanBiaya = $request->filled('estimasi_biaya') ? (int) preg_replace('/[^0-9]/', '', $request->estimasi_biaya) : 0;

            $dokumen = MasterDokumenPerizinan::create([
                'kode_dokumen'     => strtoupper(trim($request->kode_dokumen)),
                'nama_dokumen'     => trim($request->nama_dokumen),
                'kategori'         => $request->kategori,
                'instansi_terkait' => $request->instansi_terkait ? trim($request->instansi_terkait) : null,
                'estimasi_hari'    => $request->estimasi_hari ? (int) $request->estimasi_hari : null,
                'estimasi_biaya'   => $cleanBiaya,
                'syarat_dokumen'   => $request->syarat_dokumen ? trim($request->syarat_dokumen) : null,
                'deskripsi'        => $request->deskripsi ? trim($request->deskripsi) : null,
                'urutan'           => $request->urutan ? (int) $request->urutan : 0,
                'is_active'        => $request->has('is_active') ? true : ($request->input('is_active', '1') == '1'),
                'is_required'      => $request->has('is_required'),
            ]);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Dokumen Perizinan baru berhasil ditambahkan ke Master Data!',
                    'data'    => $dokumen
                ]);
            }

            return redirect()->route('master.dokumen-perizinan.index')
                ->with('success', 'Dokumen Perizinan baru berhasil ditambahkan!');
        } catch (\Exception $e) {
            Log::error('Error store Master Dokumen Perizinan: ' . $e->getMessage());

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menyimpan dokumen: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }

    /**
     * Update Dokumen Perizinan
     */
    public function update(Request $request, $id)
    {
        $dokumen = MasterDokumenPerizinan::findOrFail($id);

        $request->validate([
            'kode_dokumen'     => 'required|string|max:50|unique:master_dokumen_perizinans,kode_dokumen,' . $dokumen->id,
            'nama_dokumen'     => 'required|string|max:255',
            'kategori'         => 'required|string|max:100',
            'instansi_terkait' => 'nullable|string|max:255',
            'estimasi_hari'    => 'nullable|integer|min:0',
            'estimasi_biaya'   => 'nullable|string',
            'syarat_dokumen'   => 'nullable|string',
            'deskripsi'        => 'nullable|string',
            'urutan'           => 'nullable|integer|min:0',
        ]);

        try {
            $cleanBiaya = $request->filled('estimasi_biaya') ? (int) preg_replace('/[^0-9]/', '', $request->estimasi_biaya) : 0;

            $dokumen->update([
                'kode_dokumen'     => strtoupper(trim($request->kode_dokumen)),
                'nama_dokumen'     => trim($request->nama_dokumen),
                'kategori'         => $request->kategori,
                'instansi_terkait' => $request->instansi_terkait ? trim($request->instansi_terkait) : null,
                'estimasi_hari'    => $request->estimasi_hari ? (int) $request->estimasi_hari : null,
                'estimasi_biaya'   => $cleanBiaya,
                'syarat_dokumen'   => $request->syarat_dokumen ? trim($request->syarat_dokumen) : null,
                'deskripsi'        => $request->deskripsi ? trim($request->deskripsi) : null,
                'urutan'           => $request->urutan ? (int) $request->urutan : 0,
                'is_active'        => $request->has('is_active') ? true : ($request->input('is_active', '1') == '1'),
                'is_required'      => $request->has('is_required'),
            ]);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data Dokumen Perizinan berhasil diperbarui!',
                    'data'    => $dokumen
                ]);
            }

            return redirect()->route('master.dokumen-perizinan.index')
                ->with('success', 'Data Dokumen Perizinan berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error('Error update Master Dokumen Perizinan: ' . $e->getMessage());

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal memperbarui data: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }
    }

    /**
     * Hapus Dokumen Perizinan
     */
    public function destroy(Request $request, $id)
    {
        try {
            $dokumen = MasterDokumenPerizinan::findOrFail($id);
            $nama = $dokumen->nama_dokumen;
            $dokumen->delete();

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => "Dokumen perizinan '{$nama}' berhasil dihapus!"
                ]);
            }

            return redirect()->route('master.dokumen-perizinan.index')
                ->with('success', "Dokumen perizinan '{$nama}' berhasil dihapus!");
        } catch (\Exception $e) {
            Log::error('Error delete Master Dokumen Perizinan: ' . $e->getMessage());

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menghapus data: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()->with('error', 'Gagal menghapus data.');
        }
    }

    /**
     * Toggle Status Aktif / Non-Aktif
     */
    public function toggleStatus(Request $request, $id)
    {
        try {
            $dokumen = MasterDokumenPerizinan::findOrFail($id);
            $dokumen->is_active = !$dokumen->is_active;
            $dokumen->save();

            return response()->json([
                'success'   => true,
                'message'   => 'Status dokumen perizinan berhasil diubah!',
                'is_active' => $dokumen->is_active
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengubah status: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * API Endpoint: Ambil daftar master perizinan aktif (untuk modal picker di Fase 4)
     */
    public function apiList(Request $request)
    {
        $query = MasterDokumenPerizinan::active();

        if ($request->filled('kategori') && $request->kategori !== 'all') {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('nama_dokumen', 'like', "%{$search}%")
                  ->orWhere('kode_dokumen', 'like', "%{$search}%")
                  ->orWhere('instansi_terkait', 'like', "%{$search}%");
            });
        }

        $items = $query->get();

        return response()->json([
            'success' => true,
            'data'    => $items
        ]);
    }
}
