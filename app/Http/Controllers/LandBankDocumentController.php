<?php

namespace App\Http\Controllers;

use App\Models\DocumentTypes;
use Illuminate\Http\Request;

class LandBankDocumentController extends Controller
{
    public function index()
    {
        $documentTypes = DocumentTypes::all();
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

        return back()->with('success', 'Master document created');
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

        return back()->with('success', 'Master document updated');
    }

    public function destroy($id)
    {
        $documentType = DocumentTypes::findOrFail($id);
        $documentType->delete();

        return back()->with('success', 'Master document deleted');
    }
}
