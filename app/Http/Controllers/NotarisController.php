<?php

namespace App\Http\Controllers;

use App\Models\Notaris;
use Illuminate\Http\Request;

class NotarisController extends Controller
{
    /**
     * Tampilkan daftar Master Data Notaris.
     */
    public function index(Request $request)
    {
        $query = Notaris::query();

        // Filter pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_notaris', 'like', "%{$search}%")
                  ->orWhere('wilayah_kerja', 'like', "%{$search}%")
                  ->orWhere('alamat_kantor', 'like', "%{$search}%")
                  ->orWhere('telepon', 'like', "%{$search}%")
                  ->orWhere('nama_kontak_person', 'like', "%{$search}%");
            });
        }

        // Filter status aktif/nonaktif
        if ($request->filled('status')) {
            $query->where('is_active', $request->status);
        }

        // Sorting
        $sortField = $request->get('sortField', 'created_at');
        $sortDirection = $request->get('sortDirection', 'desc');

        $validSortFields = ['nama_notaris', 'no_sk', 'telepon', 'is_active', 'created_at'];

        if (in_array($sortField, $validSortFields)) {
            $query->orderBy($sortField, $sortDirection);
        } else {
            $query->latest();
        }

        // Pagination
        $perPage = $request->input('per_page', 10);
        $notarisList = $query->paginate($perPage)->withQueryString();

        return view('master_data.notaris.index', compact('notarisList'));
    }

    /**
     * Simpan data Notaris baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_notaris' => 'required|string|max:255',
            'no_sk' => 'nullable|string|max:255',
            'wilayah_kerja' => 'nullable|string|max:255',
            'alamat_kantor' => 'nullable|string',
            'telepon' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'nama_kontak_person' => 'nullable|string|max:255',
            'nama_bank' => 'nullable|string|max:100',
            'nomor_rekening' => 'nullable|string|max:50',
            'atas_nama_rekening' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);

        Notaris::create($validated);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Data Notaris berhasil ditambahkan!'
            ]);
        }

        return redirect()->route('notaris.index')->with('success', 'Data Notaris berhasil ditambahkan!');
    }

    /**
     * Ambil data spesifik Notaris (untuk detail / AJAX modal).
     */
    public function show($id)
    {
        $notaris = Notaris::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $notaris
        ]);
    }

    /**
     * Ambil data spesifik Notaris (untuk edit modal).
     */
    public function edit($id)
    {
        $notaris = Notaris::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $notaris
        ]);
    }

    /**
     * Update data Notaris.
     */
    public function update(Request $request, $id)
    {
        $notaris = Notaris::findOrFail($id);

        $validated = $request->validate([
            'nama_notaris' => 'required|string|max:255',
            'no_sk' => 'nullable|string|max:255',
            'wilayah_kerja' => 'nullable|string|max:255',
            'alamat_kantor' => 'nullable|string',
            'telepon' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'nama_kontak_person' => 'nullable|string|max:255',
            'nama_bank' => 'nullable|string|max:100',
            'nomor_rekening' => 'nullable|string|max:50',
            'atas_nama_rekening' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);

        $notaris->update($validated);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Data Notaris berhasil diperbarui!'
            ]);
        }

        return redirect()->route('notaris.index')->with('success', 'Data Notaris berhasil diperbarui!');
    }

    /**
     * Hapus data Notaris.
     */
    public function destroy($id)
    {
        $notaris = Notaris::findOrFail($id);
        $notaris->delete();

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Data Notaris berhasil dihapus!'
            ]);
        }

        return redirect()->route('notaris.index')->with('success', 'Data Notaris berhasil dihapus!');
    }

    /**
     * Toggle status aktif/nonaktif.
     */
    public function toggleStatus($id)
    {
        $notaris = Notaris::findOrFail($id);
        $notaris->is_active = !$notaris->is_active;
        $notaris->save();

        return response()->json([
            'success' => true,
            'is_active' => $notaris->is_active,
            'message' => 'Status Notaris berhasil diubah menjadi ' . ($notaris->is_active ? 'Aktif' : 'Nonaktif') . '!'
        ]);
    }
}
