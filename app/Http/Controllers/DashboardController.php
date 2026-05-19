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
        $perPage = $request->get('perPage', 10);

        $query = LandBank::with([
            'companyProfile',
        ]);

        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%");
        }

        if ($request->filled('perusahaan')) {
            $query->whereHas('companyProfile', function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->perusahaan}%");
            });
        }

        if ($request->filled('type')) {
            $query->where('zoning', $request->type);
        }

        // Filter status berdasarkan status unit
        if ($request->filled('status')) {
            $query->whereHas('units', function ($q) use ($request) {
                $q->where('status', $request->status);
            });
        }

        $sortField = $request->get('sortField', 'created_at');
        $sortDirection = $request->get('sortDirection', 'desc');

        $validSortFields = [
            'name',
            'zoning',
            'status',
            'acquisition_price',
            'created_at',
        ];

        if (in_array($sortField, $validSortFields)) {
            $query->orderBy($sortField, $sortDirection);
        } else {
            $query->latest();
        }

        $landBank = $query->paginate($perPage)->withQueryString();

        $landBank->getCollection()->transform(function ($lb) use ($request) {
            $unitQuery = $lb->units()
                ->with([
                    'activeBooking.customer',
                    'progress',
                ]);

            // Unit yang tampil ikut filter status
            if ($request->filled('status')) {
                $unitQuery->where('status', $request->status);
            }

            $lb->paginated_units = $unitQuery
                ->paginate(5, ['*'], 'unit_page_' . $lb->id)
                ->withQueryString();

            return $lb;
        });

        $filterOptions = [
            'perusahaan' => LandBank::with('companyProfile')
                ->get()
                ->pluck('companyProfile.name')
                ->unique()
                ->filter()
                ->values(),

            'types' => LandBank::distinct()
                ->pluck('zoning')
                ->filter()
                ->values(),

            'statuses' => [
                'ready',
                'booked',
                'sold',
                'draft',
            ],
        ];

        $totalProperty = LandBank::count();
        $totalCustomer = Customer::count();
        $totalPayments = Payment::count();
        $totalUnit = \App\Models\LandBankUnit::count();

        $notifications = auth()->user()->unreadNotifications;
        $countNotif = $notifications->count();

        $employee = auth()->user();
        $positionId = $employee->position_id ?? null;

        $menus = \App\Models\Menu::with('children')
            ->whereNull('parent_id')
            ->whereHas('positions', function ($q) use ($positionId) {
                $q->where('position_id', $positionId);
            })
            ->orderBy('order')
            ->get();

        return view('dashboard', compact(
            'totalProperty',
            'totalCustomer',
            'totalPayments',
            'totalUnit',
            'landBank',
            'notifications',
            'countNotif',
            'filterOptions',
            'menus'
        ));
    }
    public function refresh()
    {
        $data = LandBank::with('companyProfile', 'units')->get();

        return response()->json($data);
    }

    public function show($id)
    {
        $item = LandBank::with([
            'companyProfile',
            'units.activeBooking.customer',
        ])->findOrFail($id);

        return response()->json($item);
    }
}
