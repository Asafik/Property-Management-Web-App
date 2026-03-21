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

    // Sort - only by name
    $sortBy = $request->sort_by;
    $sortOrder = $request->sort_order ?? 'asc';

    if ($sortBy === 'name') {
        $query->orderBy('name', $sortOrder);
    } else {
        // Default sorting by latest (or you can set default to name)
        $query->latest();
    }

    // Show per page
    $show = $request->show ?? 10;

    $landBanks = $query->paginate($show);

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

    // Filter Search Nama
    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    // Filter Type (zoning)
    if ($request->filled('type')) {
        $query->where('zoning', $request->type);
    }

    // Filter Status
    if ($request->filled('status')) {
        if ($request->status == 'sold') {
            $query->where('status', 'sold');
        } elseif ($request->status == 'booking') {
            $query->where('status', 'booking');
        } elseif ($request->status == 'available') {
            $query->whereNotIn('status', ['sold', 'booking']);
        }
    }

    // Sort
    $allowedSorts = ['name', 'zoning', 'acquisition_price', 'area', 'status', 'created_at'];
    $sort = $request->input('sort', 'created_at');
    $direction = $request->input('direction', 'desc');

    if (!in_array($sort, $allowedSorts)) {
        $sort = 'created_at';
    }

    if (!in_array($direction, ['asc', 'desc'])) {
        $direction = 'desc';
    }

    $query->orderBy($sort, $direction);

    // Show per page - UPDATED to 10, 15, 20
    $perPage = (int) $request->input('per_page', 10);
    if (!in_array($perPage, [10, 15, 20])) {
        $perPage = 10;
    }

    $lands = $query->paginate($perPage)->withQueryString();

    // Untuk dropdown filter
    $types = LandBank::where('legal_status', 'verified')
        ->whereNotNull('zoning')
        ->distinct()
        ->orderBy('zoning')
        ->pluck('zoning');

    return view('properti.kavling', compact('lands', 'types'));
}
}
