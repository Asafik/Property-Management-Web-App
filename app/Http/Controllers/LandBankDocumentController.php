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

        // Jumlah tampil per halaman (default 10, opsi: 10, 15, 25)
        $perPage = $request->input('per_page', 10);

        // Ambil data dengan pagination + sort by name
        $documentTypes = $query->orderBy('name', 'asc')
            ->paginate($perPage)
            ->withQueryString();

        return view('dokument.dokument', compact('documentTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required|unique:document_types,code'
        ]);

        DocumentTypes::create([
            'name' => $request->name,
            'code' => $request->code,
            'has_expiry' => $request->has_expiry ?? false,
        ]);

        return back()->with('success', 'Dokumen Pasca LandBank Berhasil');
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
        ]);

        $documentType->update([
            'name' => $request->name,
            'code' => $request->code,
            'has_expiry' => $request->has_expiry ?? false,
        ]);

        return back()->with('success', 'Dokumen Pasca LandBank Berhasil');
    }

    public function destroy($id)
    {
        $documentType = DocumentTypes::findOrFail($id);
        $documentType->delete();

        return back()->with('success', 'Dokumen Pasca LandBank Berhasil');
    }
}