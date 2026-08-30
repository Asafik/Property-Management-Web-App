<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\LandBank;
use App\Models\Payment;
use App\Models\PraLandbank;
use App\Models\pra_landbank_documents;
use App\Models\DocumentTypes;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $isLegal = $user && (
            $user->division_id == 2 || 
            ($user->position && str_contains(strtolower($user->position->name), 'legal')) ||
            ($user->division && str_contains(strtolower($user->division->name), 'legal'))
        );

        if ($isLegal) {
            return $this->legalDashboard($request);
        }

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

        // Total Pendapatan dari seluruh transaksi pembayaran unit
        $totalPendapatan = (float) Payment::sum('amount');

        // Total Piutang dari Transaksi Pembelian Pra Land Bank (ERP Pengadaan Lahan yang Belum Lunas)
        $totalPiutang = (float) \App\Models\PraLandbankPayment::where('status', 'belum')->sum('amount');

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
            'totalPendapatan',
            'totalPiutang',
            'landBank',
            'notifications',
            'countNotif',
            'filterOptions',
            'menus'
        ));
    }
    public function legalDashboard(Request $request)
    {
        $perPage = $request->get('perPage', 10);
        $search = $request->get('search');

        $totalPraTanah = PraLandbank::count();
        $totalPraTanahFase1 = PraLandbank::where('status', 'fase1')->count();
        $totalPraTanahFase2 = PraLandbank::where('status', 'fase2')->count();
        $totalPraTanahFase3 = PraLandbank::where('status', 'fase3')->count();
        $totalApprovedTanah = PraLandbank::where('status', 'approved')->count();
        $totalRejectedTanah = PraLandbank::where('status', 'rejected')->count();

        $totalPendingDocs = pra_landbank_documents::where('status', 'pending')
            ->whereNotNull('file_path')
            ->count();
        
        $totalVerifiedDocs = pra_landbank_documents::where('status', 'verified')->count();
        
        $totalPascaLandBank = LandBank::count();
        $totalLuasPasca = (float) LandBank::sum('area');
        $totalLuasPra = (float) PraLandbank::sum('area');
        $totalLuasLahan = (float) (PraLandbank::where('status', 'approved')->sum('area') + $totalLuasPasca);

        // Metrik Kavling & Unit Legalitas
        $totalKavling = \App\Models\LandBankUnit::count();
        $totalKavlingAvailable = \App\Models\LandBankUnit::where('status', 'available')->count();
        $totalKavlingSold = \App\Models\LandBankUnit::whereIn('status', ['booking', 'sold'])->count();

        // Metrik Master Lokasi
        $totalLokasi = LandBank::whereNotNull('lat')->whereNotNull('lng')->count();
        if ($totalLokasi === 0) {
            $totalLokasi = $totalPascaLandBank;
        }

        // Antrean Validasi Dokumen (Grouped per Lahan / Pra Land Bank)
        $pendingLandbanks = PraLandbank::whereHas('documents', function($q) {
                $q->where('status', 'pending');
            })
            ->with(['documents.documentType'])
            ->latest()
            ->take(10)
            ->get();

        $pendingDocuments = pra_landbank_documents::with(['praLandbank', 'documentType'])
            ->where('status', 'pending')
            ->whereNotNull('file_path')
            ->latest()
            ->take(8)
            ->get();

        // Query Daftar Pra Land Bank
        $status = $request->get('status');
        $praLandbanksQuery = PraLandbank::with(['documents.documentType']);
        if (!empty($search)) {
            $praLandbanksQuery->where(function($q) use ($search) {
                $q->where('land_name', 'like', "%{$search}%")
                  ->orWhere('owner_name', 'like', "%{$search}%")
                  ->orWhere('certificate_owner', 'like', "%{$search}%")
                  ->orWhere('land_owner', 'like', "%{$search}%");
            });
        }

        if (!empty($status) && $status !== 'all') {
            if (in_array($status, ['fase1', 'fase2', 'fase3', 'approved', 'rejected'])) {
                $praLandbanksQuery->where('status', $status);
            } elseif ($status === 'pending_doc') {
                $praLandbanksQuery->whereHas('documents', function($q) {
                    $q->where('status', 'pending')->whereNotNull('file_path');
                });
            } elseif (in_array($status, ['clear', 'checking', 'problem'])) {
                $praLandbanksQuery->where('legal_status', $status);
            }
        }

        $praLandbanks = $praLandbanksQuery->latest()->paginate($perPage)->withQueryString();

        // Legal Status Distribution
        $legalStatusCounts = [
            'clear' => PraLandbank::where('legal_status', 'clear')->count(),
            'checking' => PraLandbank::where('legal_status', 'checking')->count(),
            'problem' => PraLandbank::where('legal_status', 'problem')->count(),
        ];

        // Ownership Status Distribution
        $ownershipCounts = [
            'SHM' => PraLandbank::where('ownership_status', 'SHM')->count(),
            'HGB' => PraLandbank::where('ownership_status', 'HGB')->count(),
            'Girik' => PraLandbank::where('ownership_status', 'Girik')->count(),
            'Petok D' => PraLandbank::where('ownership_status', 'Petok D')->count(),
            'AJB' => PraLandbank::where('ownership_status', 'AJB')->count(),
            'Lainnya' => PraLandbank::whereNotIn('ownership_status', ['SHM', 'HGB', 'Girik', 'Petok D', 'AJB'])->count(),
        ];

        return view('dashboard_legal', compact(
            'totalPraTanah',
            'totalPraTanahFase1',
            'totalPraTanahFase2',
            'totalPraTanahFase3',
            'totalApprovedTanah',
            'totalRejectedTanah',
            'totalPendingDocs',
            'totalVerifiedDocs',
            'totalPascaLandBank',
            'totalLuasLahan',
            'totalLuasPasca',
            'totalLuasPra',
            'totalKavling',
            'totalKavlingAvailable',
            'totalKavlingSold',
            'totalLokasi',
            'pendingLandbanks',
            'pendingDocuments',
            'praLandbanks',
            'legalStatusCounts',
            'ownershipCounts'
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
