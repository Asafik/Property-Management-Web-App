<?php

namespace App\Http\Controllers;

use App\Models\DocumentTypes;
use Illuminate\Http\Request;

use App\Models\DocumenType;
class LandBankDocumentController extends Controller
{
    //
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
}
