<?php

namespace App\Http\Controllers;

use App\Models\DocumentTypes;
use App\Models\pra_landbank_documents;
use App\Models\LandBankDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class DocumentTypeController extends Controller
{
    /**
     * Display a listing of document types.
     */
    public function index(Request $request)
    {
        $query = DocumentTypes::query();

        // Search by name or code
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%");
            });
        }

        // Filter by has_expiry
        if ($request->filled('has_expiry')) {
            if ($request->has_expiry === 'yes') {
                $query->where('has_expiry', true);
            } elseif ($request->has_expiry === 'no') {
                $query->where('has_expiry', false);
            }
        }

        // Sorting
        $sortField = $request->get('sortField', 'name');
        $sortDirection = $request->get('sortDirection', 'asc');
        $validSorts = ['name', 'code', 'has_expiry', 'created_at'];

        if (in_array($sortField, $validSorts)) {
            $query->orderBy($sortField, $sortDirection);
        } else {
            $query->orderBy('name', 'asc');
        }

        $perPage = $request->input('per_page', 10);
        $documentTypes = $query->paginate($perPage)->withQueryString();

        return view('master_data.jenis_dokumen.index', compact('documentTypes'));
    }

    /**
     * Store a newly created document type in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'code' => 'nullable|string|max:100|unique:document_types,code',
            ]);

            // Auto-generate code if empty
            $code = $request->filled('code') 
                ? strtoupper(Str::slug($request->code, '_')) 
                : strtoupper(Str::slug($request->name, '_'));

            // Ensure unique code
            $baseCode = $code;
            $count = 1;
            while (DocumentTypes::where('code', $code)->exists()) {
                $code = "{$baseCode}_{$count}";
                $count++;
            }

            DocumentTypes::create([
                'name'       => $request->name,
                'code'       => $code,
                'has_expiry' => $request->has('has_expiry') && $request->has_expiry == '1',
            ]);

            return redirect()->back()->with('success', 'Jenis Dokumen berhasil ditambahkan!');
        } catch (\Throwable $e) {
            Log::error('Gagal menambahkan jenis dokumen', [
                'user_id'       => auth()->id(),
                'request'       => $request->all(),
                'error_message' => $e->getMessage()
            ]);

            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified document type.
     */
    public function edit($id)
    {
        $documentType = DocumentTypes::findOrFail($id);
        return response()->json($documentType);
    }

    /**
     * Update the specified document type in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $documentType = DocumentTypes::findOrFail($id);

            $request->validate([
                'name' => 'required|string|max:255',
                'code' => 'nullable|string|max:100|unique:document_types,code,' . $id,
            ]);

            $code = $request->filled('code') 
                ? strtoupper(Str::slug($request->code, '_')) 
                : $documentType->code;

            $documentType->update([
                'name'       => $request->name,
                'code'       => $code,
                'has_expiry' => $request->has('has_expiry') && $request->has_expiry == '1',
            ]);

            return redirect()->back()->with('success', 'Jenis Dokumen berhasil diperbarui!');
        } catch (\Throwable $e) {
            Log::error('Gagal memperbarui jenis dokumen', [
                'id'            => $id,
                'request'       => $request->all(),
                'error_message' => $e->getMessage()
            ]);

            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified document type from storage.
     */
    public function destroy($id)
    {
        try {
            $documentType = DocumentTypes::findOrFail($id);

            // Check if document type is used in Pra Landbank or Landbank
            $usedInPra = pra_landbank_documents::where('document_type_id', $id)->count();
            $usedInLand = LandBankDocument::where('document_type_id', $id)->count();

            if ($usedInPra > 0 || $usedInLand > 0) {
                return redirect()->back()->with('error', 'Jenis dokumen tidak dapat dihapus karena sedang digunakan oleh data Pra Landbank atau Landbank.');
            }

            $documentType->delete();

            return redirect()->back()->with('success', 'Jenis Dokumen berhasil dihapus!');
        } catch (\Throwable $e) {
            Log::error('Gagal menghapus jenis dokumen', [
                'id'            => $id,
                'error_message' => $e->getMessage()
            ]);

            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }
}
