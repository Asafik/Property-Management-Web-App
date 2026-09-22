<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use App\Models\LandBank;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Halaman Utama Menu Proyek:
     * Manajemen Profil Proyek Kawasan & Dokumen Legalitas.
     */
    public function index(Request $request)
    {
        $query = LandBank::with(['companyProfile', 'documents.documentType', 'infrastructures', 'units']);

        // Filter Pencarian
        if ($request->filled('search')) {
            $keyword = trim($request->search);
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                    ->orWhere('address', 'like', "%{$keyword}%")
                    ->orWhere('city', 'like', "%{$keyword}%")
                    ->orWhere('district', 'like', "%{$keyword}%")
                    ->orWhere('ownership_status', 'like', "%{$keyword}%")
                    ->orWhereHas('companyProfile', function ($cq) use ($keyword) {
                        $cq->where('name', 'like', "%{$keyword}%");
                    });
            });
        }

        // Filter PT / Mitra Pengembang
        if ($request->filled('company_profile_id') && $request->company_profile_id !== 'all') {
            $query->where('company_profile_id', $request->company_profile_id);
        }

        // Filter Legal Status
        if ($request->filled('legal_status') && $request->legal_status !== 'all') {
            $query->where('legal_status', $request->legal_status);
        }

        // Ambil semua data untuk KPI sebelum paginasi
        $allProjects = LandBank::with(['companyProfile', 'documents'])->get();

        // Hitung KPI
        $totalProjects = $allProjects->count();
        $totalLengkap = $allProjects->filter(fn($p) => $p->isProfileComplete())->count();
        $totalBelumLengkap = $totalProjects - $totalLengkap;
        
        // Dokumen terverifikasi
        $totalVerifiedDocs = 0;
        foreach ($allProjects as $p) {
            $totalVerifiedDocs += $p->merged_documents->where('status', 'verified')->count();
        }

        // Urutan Default: Nama Proyek ASC atau Terbaru
        $sortBy = $request->get('sort_by', 'latest');
        if ($sortBy === 'name_asc') {
            $query->orderBy('name', 'asc');
        } elseif ($sortBy === 'name_desc') {
            $query->orderBy('name', 'desc');
        } else {
            $query->latest();
        }

        // Filter Kelengkapan Profil (Collection Filter setelah query atau via condition)
        $filterProfil = $request->get('profil_status', 'all');
        if ($filterProfil === 'lengkap') {
            $query->whereNotNull('company_profile_id')
                ->whereNotNull('name')
                ->where('name', '!=', '')
                ->whereNotNull('area')
                ->where('area', '>', 0)
                ->whereNotNull('address')
                ->where('address', '!=', '')
                ->whereNotNull('denah')
                ->where('denah', '!=', '');
        } elseif ($filterProfil === 'belum') {
            $query->where(function ($q) {
                $q->whereNull('company_profile_id')
                    ->orWhereNull('name')
                    ->orWhere('name', '')
                    ->orWhereNull('area')
                    ->orWhere('area', '<=', 0)
                    ->orWhereNull('address')
                    ->orWhere('address', '')
                    ->orWhereNull('denah')
                    ->orWhere('denah', '');
            });
        }

        $perPage = (int) $request->get('show', 10);
        if (!in_array($perPage, [10, 25, 50, 100])) {
            $perPage = 10;
        }

        $projects = $query->paginate($perPage)->withQueryString();
        $companies = CompanyProfile::orderBy('name')->get();

        return view('proyek.index', compact(
            'projects',
            'companies',
            'totalProjects',
            'totalLengkap',
            'totalBelumLengkap',
            'totalVerifiedDocs'
        ));
    }
}
