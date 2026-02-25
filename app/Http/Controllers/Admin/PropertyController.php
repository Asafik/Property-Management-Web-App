<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandBank;
use App\Models\CompanyProfile;
use App\Models\LandBankUnit;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    //
public function index(Request $request)
{
    $query = LandBank::with('companyProfile');

    // Filter Search Nama
    if ($request->search) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    // Filter Company
    if ($request->company_profile_id) {
        $query->where('company_profile_id', $request->company_profile_id);
    }

    // Filter Kategori
    if ($request->kategori) {
        $query->where('zoning', $request->kategori);
    }

    // Filter Legalitas
    if ($request->legalitas) {
        $query->where('legal_status', $request->legalitas);
    }

    // Filter Pembangunan
    if ($request->pembangunan) {
        $query->where('development_status', $request->pembangunan);
    }

    // Show per page
    $show = $request->show ?? 10;

    $landBanks = $query->latest()->paginate($show);

    $companies = CompanyProfile::orderBy('name')->get();
    $categories = \App\Models\LandBank::select('zoning')
    ->whereNotNull('zoning')
    ->distinct()
    ->orderBy('zoning')
    ->pluck('zoning');
    return view('properti.index', compact('landBanks', 'companies', 'categories'));
}
public function kavlingindex()
{
    $lands = LandBank::where('legal_status', 'terverifikasi')
                ->latest()
                ->paginate(10);

    return view('properti.kavling', compact('lands'));
}

}
