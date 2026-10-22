<?php

namespace App\Http\Controllers;

use App\Models\DocumentTypes;
use Illuminate\Http\Request;

class LandBankDocumentController extends Controller
{
    public function index(Request $request)
    {
        $query = DocumentTypes::query();

        // Filter search by name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }

        // Filter by has_expiry (yes/no)
        if ($request->filled('has_expiry')) {
            if ($request->has_expiry === 'yes') {
                $query->where('has_expiry', true);
            } elseif ($request->has_expiry === 'no') {
                $query->where('has_expiry', false);
            }
        }

        // Filter by category
        if ($request->filled('category')) {
            $cat = $request->category;
            $query->whereJsonContains('applicable_categories', $cat);
        }

        // Jumlah tampil per halaman (default 15, opsi: 10, 15, 25)
        $perPage = $request->input('per_page', 15);

        // Ambil data dengan pagination + sort by name
        $documentTypes = $query->orderBy('id', 'asc')
            ->paginate($perPage)
            ->withQueryString();

        return view('dokument.dokument', compact('documentTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required|unique:document_types,code',
            'applicable_categories' => 'nullable|array'
        ]);

        DocumentTypes::create([
            'name' => $request->name,
            'code' => $request->code,
            'has_expiry' => $request->has_expiry ?? false,
            'applicable_categories' => $request->input('applicable_categories', []),
        ]);

        return back()->with('success', 'Master Dokumen berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $documentType = DocumentTypes::findOrFail($id);
        return response()->json($documentType);
    }

    public function update(Request $request, $id)
    {
        $documentType = DocumentTypes::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'code' => 'required|unique:document_types,code,' . $id,
            'applicable_categories' => 'nullable|array'
        ]);

        $documentType->update([
            'name' => $request->name,
            'code' => $request->code,
            'has_expiry' => $request->has_expiry ?? false,
            'applicable_categories' => $request->input('applicable_categories', []),
        ]);

        return back()->with('success', 'Master Dokumen berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $documentType = DocumentTypes::findOrFail($id);
        $documentType->delete();

        return back()->with('success', 'Dokumen Pasca LandBank Berhasil');
    }
}