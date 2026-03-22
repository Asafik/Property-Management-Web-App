<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\LandBank;
use App\Models\Payment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Default per page
        $perPage = $request->get('perPage', 10);

        // Build query dengan relasi
        $query = LandBank::with([
            'companyProfile',
            'units.activeBooking.customer',
            'units.progress',
        ]);

        // Search filter - hanya berdasarkan nama proyek/tanah
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }

        // Filter by perusahaan
        if ($request->filled('perusahaan')) {
            $query->whereHas('companyProfile', function($q) use ($request) {
                $q->where('name', 'like', "%{$request->perusahaan}%");
            });
        }

        // Filter by type (zoning)
        if ($request->filled('type')) {
            $query->where('zoning', $request->type);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Sorting
        $sortField = $request->get('sortField', 'created_at');
        $sortDirection = $request->get('sortDirection', 'desc');

        // Kolom yang valid untuk sorting
        $validSortFields = ['name', 'zoning', 'status', 'acquisition_price', 'created_at'];

        if (in_array($sortField, $validSortFields)) {
            $query->orderBy($sortField, $sortDirection);
        } else {
            $query->latest(); // Default sorting
        }

        // Get data dengan pagination
        $landBank = $query->paginate($perPage)->withQueryString();

        // Transform data untuk units_detail
        $landBank->getCollection()->transform(function($lb) {
            $lb->units_detail = $lb->units->map(function ($unit) {
                return [
                    'type' => $unit->type ?? '-',
                    'unit_code' => $unit->unit_code ?? '-',
                    'unit_name' => $unit->unit_name ?? $unit->unit_number ?? '-',
                    'construction_progress' => $unit->construction_progress ? [
                        'stage'      => $unit->construction_progress->stage ?? '-',
                        'percentage' => $unit->construction_progress->percentage ?? 0,
                    ] : null,
                    'booking' => $unit->activeBooking ? [
                        'customer_name' => optional($unit->activeBooking->customer)->full_name ?? 'Customer',
                        'status'        => $unit->activeBooking->status ?? '-',
                    ] : null,
                ];
            });
            return $lb;
        });

        // Get unique values untuk dropdown filter
        $filterOptions = [
            'perusahaan' => LandBank::with('companyProfile')
                ->get()
                ->pluck('companyProfile.name')
                ->unique()
                ->filter()
                ->values(),
            'types' => LandBank::distinct()->pluck('zoning')->filter()->values(),
            'statuses' => ['ready', 'sold', 'pending']
        ];

        // Statistics
        $totalProperty = LandBank::count();
        $totalCustomer = Customer::count();
        $totalPayments = Payment::count();
        $totalUnit = \App\Models\LandBankUnit::count();

        // Notifications
        $notifications = auth()->user()->unreadNotifications;
        $countNotif = $notifications->count();

        return view('dashboard', compact(
            'totalProperty',
            'totalCustomer',
            'totalPayments',
            'totalUnit',
            'landBank',
            'notifications',
            'countNotif',
            'filterOptions'
        ));
    }
}
