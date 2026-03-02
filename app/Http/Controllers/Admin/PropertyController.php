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



public function kavlingindex(Request $request)
{
    $query = LandBank::where('legal_status', 'verified');

    // Filter search by name
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where('name', 'like', "%{$search}%");
    }

    // Filter by type (zoning)
    if ($request->filled('type')) {
        $query->where('zoning', $request->type);
    }

    // Filter by location (city)
    if ($request->filled('location')) {
        $query->where('city', 'like', "%{$request->location}%");
    }

    // Filter by status
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // Jumlah tampil per halaman (default 10, opsi: 10, 25, 50, 100)
    $perPage = $request->input('per_page', 10);

    // Ambil data dengan pagination
    $lands = $query->latest()->paginate($perPage)->withQueryString();

    // Untuk filter dropdown (opsional, bisa diambil dari database)
    $types = LandBank::where('legal_status', 'verified')
                ->whereNotNull('zoning')
                ->distinct()
                ->orderBy('zoning')
                ->pluck('zoning');

    $locations = LandBank::where('legal_status', 'verified')
                ->whereNotNull('city')
                ->distinct()
                ->orderBy('city')
                ->pluck('city');

    return view('properti.kavling', compact('lands', 'types', 'locations'));
}

}
