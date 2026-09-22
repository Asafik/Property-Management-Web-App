<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\LandBank;
use App\Models\Payment;
use App\Models\PraLandbank;
use App\Models\pra_landbank_documents;
use App\Models\DocumentTypes;
use App\Models\LandBankUnit;
use App\Models\Booking;
use App\Models\MarketingTask;
use App\Models\Employee;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $posName = strtolower($user?->position?->name ?? '');
        $divName = strtolower($user?->division?->name ?? '');

        $isLegal = $user && (
            $user->division_id == 2 || 
            str_contains($posName, 'legal') ||
            str_contains($divName, 'legal')
        );

        if ($isLegal) {
            return $this->legalDashboard($request);
        }

        $isMarketing = $user && (
            $user->division_id == 1 ||
            str_contains($posName, 'marketing') ||
            str_contains($divName, 'marketing')
        );

        if ($isMarketing) {
            $isKepalaMarketing = str_contains($posName, 'kepala') || $user->position_id == 1;
            return $this->marketingDashboard($request, $isKepalaMarketing);
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

        // 1. Total Tagihan / Piutang dari Transaksi Pembelian Pra Land Bank yang Belum Lunas
        $piutangPraLandbank = (float) \App\Models\PraLandbankPayment::where('status', 'belum')->sum('amount');

        // 2. Total Tagihan / Piutang Belanja Bahan & Jasa Infrastruktur Pengolahan Lahan Pasca yang Belum Lunas
        $piutangInfrastruktur = (float) \App\Models\LandBankInfrastructureExpense::where('payment_status', '!=', 'Lunas')->sum('total_amount');

        // Akumulasi Total Piutang di Card Dashboard Admin
        $totalPiutang = $piutangPraLandbank + $piutangInfrastruktur;

        $notifications = auth()->user()->unreadNotifications;
        $countNotif = $notifications->count();

        $employee = auth()->user();
        $positionId = $employee->position_id ?? null;

        $menus = \App\Models\Menu::with('children')
            ->whereNull('parent_id')
            ->where(function ($q) use ($positionId) {
                $q->whereHas('positions', function ($query) use ($positionId) {
                    $query->where('position_id', $positionId);
                })
                ->orWhereHas('children', function ($cq) use ($positionId) {
                    $cq->whereHas('positions', function ($query) use ($positionId) {
                        $query->where('position_id', $positionId);
                    });
                });
            })
            ->orderBy('order')
            ->get();

        // 1. Proyek Terbaru (5 proyek yang sedang dikelola)
        $recentProjects = LandBank::with(['companyProfile', 'units'])->latest()->take(5)->get();

        // 2. Status Unit (Real Metrik Kavling & Unit)
        $unitReady   = LandBankUnit::whereIn('status', ['ready', 'tersedia', 'available'])->count();
        $unitBooking = LandBankUnit::whereIn('status', ['booked', 'booking'])->count();
        $unitSold    = LandBankUnit::whereIn('status', ['sold', 'terjual'])->count();
        $unitKpr     = Booking::where('purchase_type', 'kpr')->count();
        $totalAllUnits = LandBankUnit::count();

        $unitStats = [
            'total'       => $totalAllUnits,
            'ready'       => $unitReady,
            'booking'     => $unitBooking,
            'sold'        => $unitSold,
            'kpr'         => $unitKpr,
            'ready_pct'   => $totalAllUnits > 0 ? round(($unitReady / $totalAllUnits) * 100, 1) : 0,
            'booking_pct' => $totalAllUnits > 0 ? round(($unitBooking / $totalAllUnits) * 100, 1) : 0,
            'sold_pct'    => $totalAllUnits > 0 ? round(($unitSold / $totalAllUnits) * 100, 1) : 0,
            'kpr_pct'     => $totalAllUnits > 0 ? round(($unitKpr / $totalAllUnits) * 100, 1) : 0,
        ];

        // 3. Status Perizinan (Ringkasan perizinan proyek dari Master Dokumen & PerizinanTask)
        $masterDocs = \App\Models\MasterDokumenPerizinan::orderBy('urutan', 'asc')->take(5)->get();
        $allTasks   = \App\Models\PerizinanTask::all();

        $perizinanSummary = [
            'total'    => $allTasks->count() > 0 ? $allTasks->count() : \App\Models\MasterDokumenPerizinan::count(),
            'selesai'  => $allTasks->whereIn('status', ['Selesai', 'Terbit'])->count(),
            'berjalan' => $allTasks->whereIn('status', ['Dalam Proses', 'Proses', 'Menunggu'])->count(),
            'tertunda' => $allTasks->whereIn('status', ['Terkendala', 'Tertunda', 'Revisi'])->count(),
        ];

        $perizinanRows = $masterDocs->map(function ($doc) use ($allTasks) {
            $tasks = $allTasks->where('master_dokumen_id', $doc->id);
            $total = $tasks->count();
            $selesai = $tasks->whereIn('status', ['Selesai', 'Terbit'])->count();
            $berjalan = $tasks->whereIn('status', ['Dalam Proses', 'Proses', 'Menunggu'])->count();
            $tertunda = $tasks->whereIn('status', ['Terkendala', 'Tertunda', 'Revisi'])->count();

            if ($total === 0) {
                $total = LandBank::count();
                $berjalan = $total;
            }

            $shortName = match($doc->kode_dokumen) {
                'POIN-07' => 'PERTEK',
                'POIN-08' => 'PETA BIDANG',
                'POIN-09' => 'PKKPR',
                'POIN-10' => 'PBG (IMB)',
                'POIN-11', 'POIN-12' => 'SK HGB',
                'POIN-13', 'POIN-14', 'POIN-15' => 'PBB & BPHTB',
                'POIN-16', 'POIN-17' => 'HGB Induk',
                'POIN-18', 'POIN-19' => 'Pemecahan Sertipikat',
                default => preg_replace('/^.*?-\s*/', '', $doc->nama_dokumen)
            };
            if (strlen($shortName) > 25) {
                $shortName = substr($shortName, 0, 22) . '...';
            }

            return [
                'id'       => $doc->id,
                'nama'     => $shortName,
                'total'    => $total,
                'selesai'  => $selesai,
                'berjalan' => $berjalan,
                'tertunda' => $tertunda,
            ];
        });

        // 4. Progres Pembangunan (Berbasis Unit)
        $recentUnitProgress = LandBankUnit::with('landBank')
            ->latest()
            ->take(5)
            ->get();

        // 5. Tugas Tim Terbaru
        $recentTeamTasks = \App\Models\PerizinanTask::with(['employee.division', 'employee.position'])
            ->latest('last_activity_at')
            ->latest('created_at')
            ->take(5)
            ->get();

        // 6. Ringkasan Penjualan & Keuangan
        $salesVolume = (float) LandBankUnit::whereIn('status', ['sold', 'terjual'])->sum('price');
        $uangDiterima = $totalPendapatan;
        $totalPengeluaran = (float) (
            \App\Models\PraLandbankPayment::where('status', 'lunas')->sum('amount') +
            \App\Models\LandBankInfrastructureExpense::where('payment_status', 'Lunas')->sum('total_amount') +
            (float) LandBank::sum('acquisition_price')
        );
        $saldoKeuangan = $uangDiterima - $totalPengeluaran;

        $financeSummary = [
            'unit_terjual'      => $unitSold,
            'nilai_penjualan'   => $salesVolume,
            'uang_diterima'     => $uangDiterima,
            'piutang'           => $totalPiutang,
            'total_pengeluaran' => $totalPengeluaran,
            'saldo_keuangan'    => $saldoKeuangan,
        ];

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
            'menus',
            'recentProjects',
            'unitStats',
            'perizinanSummary',
            'perizinanRows',
            'recentUnitProgress',
            'recentTeamTasks',
            'financeSummary'
        ));
    }
    public function legalDashboard(Request $request)
    {
        $user = auth()->user();
        $positionName = strtolower($user->position->name ?? '');
        $isStaffLegal = str_contains($positionName, 'staff') && str_contains($positionName, 'legal');

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

        // Metrik Khusus Staff Legal
        $totalPraTanahStaffActive = PraLandbank::whereIn('status', ['fase1', 'fase2'])->count();

        // Prospek Lahan yang Butuh Kelengkapan Berkas / Upload Berkas oleh Staff Legal
        $incompleteLands = PraLandbank::whereIn('status', ['fase1', 'fase2'])
            ->with(['documents.documentType'])
            ->latest()
            ->take(10)
            ->get();

        // Antrean Validasi Dokumen (Grouped per Lahan / Pra Land Bank) untuk Kepala Legal
        $pendingLandbanks = PraLandbank::whereHas('documents', function($q) {
                $q->where('status', 'pending')->whereNotNull('file_path');
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
            } elseif ($status === 'incomplete_doc') {
                $praLandbanksQuery->whereIn('status', ['fase1', 'fase2']);
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

        // Master Document Types
        $documentTypes = DocumentTypes::all();

        return view('dashboard_legal', compact(
            'isStaffLegal',
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
            'totalPraTanahStaffActive',
            'incompleteLands',
            'pendingLandbanks',
            'pendingDocuments',
            'praLandbanks',
            'legalStatusCounts',
            'ownershipCounts',
            'documentTypes'
        ));
    }

    public function marketingDashboard(Request $request, bool $isKepalaMarketing)
    {
        $user = auth()->user();

        // 1. UNIT METRICS
        $totalUnits = LandBankUnit::count();
        $readyUnits = LandBankUnit::whereIn('status', ['ready', 'tersedia'])->count();
        $readySubsidi = LandBankUnit::whereIn('status', ['ready', 'tersedia'])
            ->where(function($q) {
                $q->where('jenis', 'subsidi')->orWhere('type', 'subsidi');
            })->count();
        $readyKomersil = LandBankUnit::whereIn('status', ['ready', 'tersedia'])
            ->where(function($q) {
                $q->where('jenis', 'komersil')->orWhere('type', 'komersil');
            })->count();
        $bookedUnits = LandBankUnit::where('status', 'booked')->count();
        $soldUnits = LandBankUnit::where('status', 'sold')->count();

        // 2. TRANSACTION & BOOKING METRICS
        $totalBookings = Booking::count();
        $activeBookings = Booking::whereIn('status', ['pending', 'proses', 'aktif', 'approved'])->count();
        $kprBookings = Booking::where('purchase_type', 'kpr')->count();
        $cashBookings = Booking::where('purchase_type', 'cash')->count();
        $tempoBookings = Booking::where(function($q) {
            $q->where('purchase_type', 'cash_tempo')->orWhere('purchase_type', 'tempo');
        })->count();

        $totalBookingFee = (float) Booking::sum('booking_fee');
        $totalAgentFee = (float) Booking::where(function($q) {
            $q->whereHas('unit', fn($uq) => $uq->whereIn('status', ['sold', 'soldout']))
              ->orWhereIn('status', ['completed', 'sold', 'lunas']);
        })->sum('agent_fee');
        $totalSalesVolume = (float) Booking::with('unit')->get()->sum(function($b) {
            return $b->unit->price ?? 0;
        });

        // 3. RECENT TRANSACTIONS / BOOKINGS
        $recentBookings = Booking::with(['customer', 'unit.landBank', 'sales'])
            ->when(!$isKepalaMarketing, function($q) use ($user) {
                $q->where('sales_id', $user->id);
            })
            ->latest()
            ->take(10)
            ->get();

        // 4. PROJECT / LAND BANK BREAKDOWN DENGAN PAGINASI
        $projects = LandBank::with(['units.activeBooking'])
            ->latest()
            ->paginate(4, ['*'], 'project_page')
            ->withQueryString();

        $projects->getCollection()->transform(function($lb) {
            $units = $lb->units;
            $ready = $units->whereIn('status', ['ready', 'tersedia'])->count();
            $booked = $units->where('status', 'booked')->count();
            $sold = $units->where('status', 'sold')->count();
            $salesNominal = $units->where('status', 'sold')->sum('price');
            return (object) [
                'id' => $lb->id,
                'name' => $lb->name,
                'address' => $lb->address,
                'total_units' => $units->count(),
                'ready_units' => $ready,
                'booked_units' => $booked,
                'sold_units' => $sold,
                'sales_nominal' => $salesNominal,
            ];
        });

        // 5. KEPALA MARKETING SPECIFIC DATA
        $salesTeam = [];
        $salesLeaderboard = [];
        $allMarketingTasks = [];
        $totalTasks = 0;
        $completedTasks = 0;
        $pendingTasks = 0;

        if ($isKepalaMarketing) {
            $salesLeaderboard = Employee::where('division_id', 1)
                ->withCount(['bookings as total_bookings' => function($q) {
                    $q->where(function($bq) {
                        $bq->whereHas('unit', fn($uq) => $uq->whereIn('status', ['sold', 'soldout']))
                           ->orWhereIn('status', ['completed', 'sold', 'lunas']);
                    });
                }])
                ->withSum(['bookings as total_fee' => function($q) {
                    $q->where(function($bq) {
                        $bq->whereHas('unit', fn($uq) => $uq->whereIn('status', ['sold', 'soldout']))
                           ->orWhereIn('status', ['completed', 'sold', 'lunas']);
                    });
                }], 'agent_fee')
                ->orderByDesc('total_fee')
                ->take(5)
                ->get();

            $salesTeam = Employee::where('division_id', 1)
                ->withCount(['bookings as total_bookings', 'marketingTasks as total_tasks'])
                ->get();

            $allMarketingTasks = MarketingTask::with('employee')->latest()->take(8)->get();
            $totalTasks = MarketingTask::count();
            $completedTasks = MarketingTask::where('status', 'selesai')->count();
            $pendingTasks = MarketingTask::where('status', '!=', 'selesai')->count();
        }

        // 6. STAFF MARKETING SPECIFIC DATA
        $myTotalBookings = 0;
        $mySoldUnits = 0;
        $myActiveBookings = 0;
        $myTotalFee = 0;
        $myTotalCustomers = 0;
        $myTasks = [];
        $myPendingTasks = 0;

        if (!$isKepalaMarketing) {
            $myBookingsQuery = Booking::where('sales_id', $user->id);
            $myTotalBookings = (clone $myBookingsQuery)->count();
            $mySoldUnits = (clone $myBookingsQuery)->where(function($q) {
                $q->whereHas('unit', fn($uq) => $uq->whereIn('status', ['sold', 'soldout']))
                  ->orWhereIn('status', ['completed', 'sold', 'lunas']);
            })->count();
            $myActiveBookings = (clone $myBookingsQuery)->whereIn('status', ['pending', 'proses', 'aktif', 'approved'])->count();
            $myTotalFee = (float) (clone $myBookingsQuery)->where(function($q) {
                $q->whereHas('unit', fn($uq) => $uq->whereIn('status', ['sold', 'soldout']))
                  ->orWhereIn('status', ['completed', 'sold', 'lunas']);
            })->sum('agent_fee');
            $myTotalCustomers = (clone $myBookingsQuery)->distinct('customer_id')->count('customer_id');

            $myTasks = MarketingTask::where('employee_id', $user->id)->latest()->take(10)->get();
            $myPendingTasks = MarketingTask::where('employee_id', $user->id)->where('status', '!=', 'selesai')->count();
        }

        return view('dashboard_marketing', compact(
            'isKepalaMarketing',
            'totalUnits',
            'readyUnits',
            'readySubsidi',
            'readyKomersil',
            'bookedUnits',
            'soldUnits',
            'totalBookings',
            'activeBookings',
            'kprBookings',
            'cashBookings',
            'tempoBookings',
            'totalBookingFee',
            'totalAgentFee',
            'totalSalesVolume',
            'recentBookings',
            'projects',
            'salesTeam',
            'salesLeaderboard',
            'allMarketingTasks',
            'totalTasks',
            'completedTasks',
            'pendingTasks',
            'myTotalBookings',
            'mySoldUnits',
            'myActiveBookings',
            'myTotalFee',
            'myTotalCustomers',
            'myTasks',
            'myPendingTasks'
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
