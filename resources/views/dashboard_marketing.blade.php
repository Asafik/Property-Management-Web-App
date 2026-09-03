@extends('layouts.partial.app')

@section('title', $isKepalaMarketing ? 'Dashboard Kepala Marketing - Property Management' : 'Dashboard Staff Marketing - Property Management')

@section('content')
<div class="container-fluid px-2 px-md-4 py-3">

    <!-- ========================================================================= -->
    <!-- HEADER BANNER: MARKETING DASHBOARD -->
    <!-- ========================================================================= -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #ffffff 0%, #faf5ff 100%); border-left: 5px solid #9a55ff !important; border-radius: 16px;">
                <div class="card-body p-3 p-md-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center shadow-sm"
                            style="width: 52px; height: 52px; background: linear-gradient(135deg, #da8cff, #9a55ff); color: #ffffff;">
                            <i class="mdi {{ $isKepalaMarketing ? 'mdi-shield-star' : 'mdi-account-tie' }} fs-3"></i>
                        </div>
                        <div>
                            <div class="d-flex align-items-center gap-2 mb-0.5">
                                <h4 class="fw-bold text-dark mb-0" style="font-size: 1.35rem;">
                                    Selamat Datang, {{ auth()->user()->name ?? 'Tim Marketing' }}!
                                </h4>
                                @if($isKepalaMarketing)
                                    <span class="badge bg-primary text-white" style="font-size: 0.76rem; border-radius: 6px; padding: 4px 8px;">
                                        <i class="mdi mdi-crown me-1"></i>Kepala Marketing
                                    </span>
                                @else
                                    <span class="badge bg-info text-white" style="font-size: 0.76rem; border-radius: 6px; padding: 4px 8px;">
                                        <i class="mdi mdi-badge-account me-1"></i>Staff Marketing
                                    </span>
                                @endif
                            </div>
                            <p class="text-muted mb-0 small">
                                {{ $isKepalaMarketing 
                                    ? 'Pantau performa penjualan, pipeline booking, aktivitas sales agent, dan perolehan komisi marketing' 
                                    : 'Kelola target penjualan pribadi, tugas harian, status booking customer, dan cek ketersediaan unit' }}
                            </p>
                        </div>
                    </div>

                    <!-- Action Shortcut Buttons -->
                    <div class="d-flex flex-wrap align-items-center gap-2">
                        <a href="{{ route('marketing.jual-unit') }}" class="btn btn-sm btn-gradient-primary d-inline-flex align-items-center gap-1.5 px-3 py-2 shadow-sm" style="border-radius: 8px; font-weight: 600;">
                            <i class="mdi mdi-view-grid-plus"></i>
                            <span>Catalog Unit</span>
                        </a>
                        <a href="{{ route('marketing.list_pengajuan') }}" class="btn btn-sm btn-outline-primary d-inline-flex align-items-center gap-1.5 px-3 py-2" style="border-radius: 8px; font-weight: 600;">
                            <i class="mdi mdi-book-check"></i>
                            <span>Daftar Booking</span>
                        </a>
                        @if($isKepalaMarketing)
                            <a href="{{ route('marketing.commission-rules.index') }}" class="btn btn-sm btn-outline-info d-inline-flex align-items-center gap-1.5 px-3 py-2" style="border-radius: 8px; font-weight: 600;">
                                <i class="mdi mdi-cash-cog"></i>
                                <span>Master Fee Agency</span>
                            </a>
                            <a href="{{ route('agency.index') }}" class="btn btn-sm btn-light border d-inline-flex align-items-center gap-1.5 px-3 py-2" style="border-radius: 8px; font-weight: 600;">
                                <i class="mdi mdi-account-group"></i>
                                <span>Tim Sales</span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- METRIC STATS CARDS -->
    <!-- ========================================================================= -->
    @if($isKepalaMarketing)
        <!-- STATS KEPALA MARKETING (EXECUTIVE OVERVIEW) -->
        <div class="row g-3 mb-4">
            <!-- Card 1: Unit Tersedia -->
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm p-3 h-100 position-relative overflow-hidden" style="border-radius: 14px; background: #ffffff; border-left: 4px solid #10b981 !important;">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <span class="text-muted small fw-semibold d-block">Unit Tersedia (Ready)</span>
                            <h3 class="fw-bold text-success mb-1 mt-1">{{ $readyUnits }} <span class="fs-6 text-muted fw-normal">/ {{ $totalUnits }} Unit</span></h3>
                            <div class="d-flex gap-1 mt-2">
                                <span class="badge" style="background: #e0f2fe; color: #0284c7; font-size: 0.72rem; font-weight: 700; border-radius: 4px;">Komersil: {{ $readyKomersil }}</span>
                                <span class="badge" style="background: #dcfce7; color: #15803d; font-size: 0.72rem; font-weight: 700; border-radius: 4px;">Subsidi: {{ $readySubsidi }}</span>
                            </div>
                        </div>
                        <div class="rounded-circle p-2.5 d-flex align-items-center justify-content-center" style="background: rgba(16, 185, 129, 0.12); color: #10b981; width: 44px; height: 44px;">
                            <i class="mdi mdi-home-circle fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 2: Booking Aktif -->
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm p-3 h-100 position-relative overflow-hidden" style="border-radius: 14px; background: #ffffff; border-left: 4px solid #f59e0b !important;">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <span class="text-muted small fw-semibold d-block">Total Booking Aktif</span>
                            <h3 class="fw-bold text-dark mb-1 mt-1">{{ $activeBookings }} <span class="fs-6 text-muted fw-normal">Transaksi</span></h3>
                            <div class="d-flex flex-wrap gap-1 mt-2">
                                <span class="badge bg-light text-dark border" style="font-size: 0.72rem;">KPR: {{ $kprBookings }}</span>
                                <span class="badge bg-light text-dark border" style="font-size: 0.72rem;">Cash: {{ $cashBookings }}</span>
                                <span class="badge bg-light text-dark border" style="font-size: 0.72rem;">Tempo: {{ $tempoBookings }}</span>
                            </div>
                        </div>
                        <div class="rounded-circle p-2.5 d-flex align-items-center justify-content-center" style="background: rgba(245, 158, 11, 0.12); color: #f59e0b; width: 44px; height: 44px;">
                            <i class="mdi mdi-bookmark-check fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 3: Unit Terjual (Sold) -->
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm p-3 h-100 position-relative overflow-hidden" style="border-radius: 14px; background: #ffffff; border-left: 4px solid #6366f1 !important;">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <span class="text-muted small fw-semibold d-block">Unit Terjual (Sold)</span>
                            <h3 class="fw-bold text-primary mb-1 mt-1">{{ $soldUnits }} <span class="fs-6 text-muted fw-normal">Unit Terjual</span></h3>
                            <div class="mt-2">
                                <small class="text-muted" style="font-size: 0.74rem;">
                                    Booking Fee: <strong class="text-dark">Rp {{ number_format($totalBookingFee, 0, ',', '.') }}</strong>
                                </small>
                            </div>
                        </div>
                        <div class="rounded-circle p-2.5 d-flex align-items-center justify-content-center" style="background: rgba(99, 102, 241, 0.12); color: #6366f1; width: 44px; height: 44px;">
                            <i class="mdi mdi-cash-check fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 4: Total Estimasi Fee Agency -->
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm p-3 h-100 position-relative overflow-hidden" style="border-radius: 14px; background: #ffffff; border-left: 4px solid #9a55ff !important;">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <span class="text-muted small fw-semibold d-block">Total Komisi / Fee Agent</span>
                            <h3 class="fw-bold text-purple mb-1 mt-1" style="color: #9a55ff;">Rp {{ number_format($totalAgentFee, 0, ',', '.') }}</h3>
                            <div class="mt-2">
                                <small class="text-muted" style="font-size: 0.74rem;">
                                    <i class="mdi mdi-account-group me-1 text-primary"></i>{{ count($salesTeam) }} Sales & Staff Aktif
                                </small>
                            </div>
                        </div>
                        <div class="rounded-circle p-2.5 d-flex align-items-center justify-content-center" style="background: rgba(154, 85, 255, 0.12); color: #9a55ff; width: 44px; height: 44px;">
                            <i class="mdi mdi-cash-multiple fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- STATS STAFF MARKETING (PERSONAL PERFORMANCE) -->
        <div class="row g-3 mb-4">
            <!-- Card 1: My Sold Units -->
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 14px; background: #ffffff; border-left: 4px solid #10b981 !important;">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <span class="text-muted small fw-semibold d-block">Unit Saya Terjual</span>
                            <h3 class="fw-bold text-success mb-0 mt-1">{{ $mySoldUnits }} <span class="fs-6 text-muted fw-normal">Unit</span></h3>
                            <small class="text-muted mt-2 d-block" style="font-size: 0.75rem;">Total Transaksi: {{ $myTotalBookings }}</small>
                        </div>
                        <div class="rounded-circle p-2.5 d-flex align-items-center justify-content-center" style="background: rgba(16, 185, 129, 0.12); color: #10b981; width: 44px; height: 44px;">
                            <i class="mdi mdi-trophy-award fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 2: My Active Bookings -->
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 14px; background: #ffffff; border-left: 4px solid #f59e0b !important;">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <span class="text-muted small fw-semibold d-block">Booking Aktif Saya</span>
                            <h3 class="fw-bold text-dark mb-0 mt-1">{{ $myActiveBookings }} <span class="fs-6 text-muted fw-normal">Customer</span></h3>
                            <small class="text-muted mt-2 d-block" style="font-size: 0.75rem;">Sedang dalam proses berkas/KPR</small>
                        </div>
                        <div class="rounded-circle p-2.5 d-flex align-items-center justify-content-center" style="background: rgba(245, 158, 11, 0.12); color: #f59e0b; width: 44px; height: 44px;">
                            <i class="mdi mdi-account-clock fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 3: My Earned Fee -->
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 14px; background: #ffffff; border-left: 4px solid #9a55ff !important;">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <span class="text-muted small fw-semibold d-block">Total Komisi / Fee Saya</span>
                            <h3 class="fw-bold text-purple mb-0 mt-1" style="color: #9a55ff;">Rp {{ number_format($myTotalFee, 0, ',', '.') }}</h3>
                            <small class="text-muted mt-2 d-block" style="font-size: 0.75rem;">Dari total {{ $mySoldUnits }} unit closing (Sold Out)</small>
                        </div>
                        <div class="rounded-circle p-2.5 d-flex align-items-center justify-content-center" style="background: rgba(154, 85, 255, 0.12); color: #9a55ff; width: 44px; height: 44px;">
                            <i class="mdi mdi-cash-plus fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 4: My Tasks -->
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 14px; background: #ffffff; border-left: 4px solid #3b82f6 !important;">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <span class="text-muted small fw-semibold d-block">Tugas Marketing Saya</span>
                            <h3 class="fw-bold text-primary mb-0 mt-1">{{ $myPendingTasks }} <span class="fs-6 text-muted fw-normal">Tugas Aktif</span></h3>
                            <small class="text-muted mt-2 d-block" style="font-size: 0.75rem;">Total tugas: {{ count($myTasks) }}</small>
                        </div>
                        <div class="rounded-circle p-2.5 d-flex align-items-center justify-content-center" style="background: rgba(59, 130, 246, 0.12); color: #3b82f6; width: 44px; height: 44px;">
                            <i class="mdi mdi-clipboard-check-outline fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- ========================================================================= -->
    <!-- SECTION 2: LEADERBOARD / TASKS & PROJECT MONITORING -->
    <!-- ========================================================================= -->
    <div class="row g-3 mb-4">
        @if($isKepalaMarketing)
            <!-- LEADERBOARD TOP SALES (FOR KEPALA MARKETING) -->
            <div class="col-12 col-lg-5">
                <div class="card border-0 shadow-sm h-100" style="border-radius: 14px; background: #ffffff;">
                    <div class="card-header bg-white py-3 px-4 border-bottom d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold text-dark mb-0" style="font-size: 1rem;">
                            <i class="mdi mdi-trophy text-warning me-1.5 fs-5"></i>Leaderboard Tim Sales & Agency
                        </h5>
                        <a href="{{ route('agency.index') }}" class="small text-primary fw-bold text-decoration-none">Lihat Semua</a>
                    </div>
                    <div class="card-body p-3">
                        <div class="list-group list-group-flush">
                            @forelse($salesLeaderboard as $idx => $sales)
                                <div class="list-group-item px-2 py-2.5 d-flex align-items-center justify-content-between border-0 rounded-3 mb-1" style="background: {{ $idx == 0 ? '#faf5ff' : '#f8fafc' }};">
                                    <div class="d-flex align-items-center gap-2.5">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold"
                                            style="width: 32px; height: 32px; font-size: 0.82rem; background: {{ $idx == 0 ? '#fbbf24' : ($idx == 1 ? '#94a3b8' : ($idx == 2 ? '#b45309' : '#e2e8f0')) }}; color: {{ $idx < 3 ? '#ffffff' : '#475569' }};">
                                            {{ $idx + 1 }}
                                        </div>
                                        <div>
                                            <span class="fw-bold text-dark d-block" style="font-size: 0.88rem;">{{ $sales->name }}</span>
                                            <small class="text-muted" style="font-size: 0.75rem;">{{ $sales->phone ?? '-' }}</small>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge bg-primary text-white" style="font-size: 0.75rem; border-radius: 6px;">{{ $sales->total_bookings }} Closing</span>
                                        <small class="text-success d-block fw-bold mt-0.5" style="font-size: 0.76rem;">Rp {{ number_format($sales->total_fee ?? 0, 0, ',', '.') }}</small>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-4 text-muted">
                                    <i class="mdi mdi-account-off-outline fs-2 d-block mb-1 opacity-50"></i>
                                    Belum ada data perolehan sales
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- MONITORING TUGAS MARKETING (FOR KEPALA MARKETING) -->
            <div class="col-12 col-lg-7">
                <div class="card border-0 shadow-sm h-100" style="border-radius: 14px; background: #ffffff;">
                    <div class="card-header bg-white py-3 px-4 border-bottom d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-2">
                            <h5 class="fw-bold text-dark mb-0" style="font-size: 1rem;">
                                <i class="mdi mdi-clipboard-list-outline text-primary me-1.5 fs-5"></i>Monitoring Penugasan Staf Marketing
                            </h5>
                            <span class="badge bg-success bg-opacity-10 text-success px-2 py-0.5" style="font-size: 0.72rem;">{{ $completedTasks }}/{{ $totalTasks }} Selesai</span>
                        </div>
                        @if(Route::has('master.data.tugas-staff-marketing'))
                            <a href="{{ route('master.data.tugas-staff-marketing') }}" class="small text-primary fw-bold text-decoration-none">Kelola Tugas</a>
                        @endif
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0" style="font-size: 0.85rem;">
                                <thead class="table-light">
                                    <tr style="background: #f8fafc;">
                                        <th class="py-2.5 px-3" style="color: #475569; font-weight: 700;">Nama Tugas</th>
                                        <th class="py-2.5" style="color: #475569; font-weight: 700;">Staf Ditugaskan</th>
                                        <th class="py-2.5" style="color: #475569; font-weight: 700;">Deadline</th>
                                        <th class="py-2.5 text-center" style="color: #475569; font-weight: 700;">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($allMarketingTasks as $task)
                                        <tr>
                                            <td class="px-3">
                                                <span class="fw-bold text-dark d-block">{{ $task->nama_tugas ?? '-' }}</span>
                                                <small class="text-muted">{{ Str::limit($task->deskripsi ?? '', 40) }}</small>
                                            </td>
                                            <td>
                                                <span class="badge bg-light text-dark border px-2 py-1">
                                                    <i class="mdi mdi-account me-1 text-primary"></i>{{ $task->employee->name ?? '-' }}
                                                </span>
                                            </td>
                                            <td>
                                                <small class="text-muted"><i class="mdi mdi-calendar-clock me-1"></i>{{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('d M Y') : '-' }}</small>
                                            </td>
                                            <td class="text-center">
                                                @if(strtolower($task->status ?? '') === 'selesai')
                                                    <span class="badge" style="background: #10b981; color: #fff; font-size: 0.72rem; padding: 4px 8px; border-radius: 6px;">Selesai</span>
                                                @else
                                                    <span class="badge" style="background: #f59e0b; color: #fff; font-size: 0.72rem; padding: 4px 8px; border-radius: 6px;">Proses</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-4 text-muted">Belum ada tugas marketing yang dibuat.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- TUGAS SAYA (FOR STAFF MARKETING) -->
            <div class="col-12 col-lg-6">
                <div class="card border-0 shadow-sm h-100" style="border-radius: 14px; background: #ffffff;">
                    <div class="card-header bg-white py-3 px-4 border-bottom d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold text-dark mb-0" style="font-size: 1rem;">
                            <i class="mdi mdi-checkbox-marked-circle-outline text-primary me-1.5 fs-5"></i>Tugas & Aktivitas Harian Saya
                        </h5>
                        <span class="badge bg-primary text-white" style="font-size: 0.75rem;">{{ $myPendingTasks }} Pending</span>
                    </div>
                    <div class="card-body p-3">
                        <div class="list-group list-group-flush">
                            @forelse($myTasks as $task)
                                <div class="list-group-item px-3 py-2.5 mb-2 border rounded-3 d-flex align-items-start justify-content-between" style="background: #f8fafc;">
                                    <div>
                                        <h6 class="fw-bold text-dark mb-1" style="font-size: 0.9rem;">{{ $task->nama_tugas ?? '-' }}</h6>
                                        <p class="text-muted small mb-1">{{ $task->deskripsi ?? 'Tidak ada catatan' }}</p>
                                        <small class="text-muted" style="font-size: 0.74rem;">
                                            <i class="mdi mdi-clock-outline me-1"></i>Deadline: {{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('d M Y') : '-' }}
                                        </small>
                                    </div>
                                    <div>
                                        @if(strtolower($task->status ?? '') === 'selesai')
                                            <span class="badge" style="background: #10b981; color: #fff; font-size: 0.72rem; padding: 4px 8px; border-radius: 6px;">Selesai</span>
                                        @else
                                            <span class="badge" style="background: #f59e0b; color: #fff; font-size: 0.72rem; padding: 4px 8px; border-radius: 6px;">Perlu Dikerjakan</span>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-4 text-muted">
                                    <i class="mdi mdi-check-all fs-2 d-block mb-1 text-success opacity-75"></i>
                                    Tidak ada tugas pending saat ini. Kerja bagus!
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAST UNIT AVAILABILITY CHECKER (FOR STAFF MARKETING) -->
            <div class="col-12 col-lg-6">
                <div class="card border-0 shadow-sm h-100" style="border-radius: 14px; background: #ffffff;">
                    <div class="card-header bg-white py-3 px-4 border-bottom d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold text-dark mb-0" style="font-size: 1rem;">
                            <i class="mdi mdi-home-search text-success me-1.5 fs-5"></i>Ketersediaan Unit Kavling per Proyek
                        </h5>
                        <a href="{{ route('marketing.jual-unit') }}" class="small text-primary fw-bold text-decoration-none">Buka Catalog Unit</a>
                    </div>
                    <div class="card-body p-3">
                        <div class="row g-2">
                            @foreach($projects as $prj)
                                <div class="col-12 col-sm-6">
                                    <div class="p-3 rounded-3 border" style="background: #f8fafc;">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h6 class="fw-bold text-dark mb-0" style="font-size: 0.88rem;">{{ $prj->name }}</h6>
                                            <span class="badge bg-success text-white" style="font-size: 0.72rem;">{{ $prj->ready_units }} Tersedia</span>
                                        </div>
                                        <div class="d-flex justify-content-between small text-muted pt-1 border-top" style="font-size: 0.75rem;">
                                            <span>Booked: <strong>{{ $prj->booked_units }}</strong></span>
                                            <span>Sold: <strong>{{ $prj->sold_units }}</strong></span>
                                            <span>Total: <strong>{{ $prj->total_units }}</strong></span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @if($projects->hasPages())
                        <div class="card-footer bg-white border-top py-2.5 px-3 d-flex flex-wrap justify-content-between align-items-center gap-2">
                            <small class="text-muted" style="font-size: 0.75rem;">
                                Proyek {{ $projects->firstItem() }}-{{ $projects->lastItem() }} dari {{ $projects->total() }}
                            </small>
                            <div class="pagination-wrapper">
                                {{ $projects->appends(request()->except('project_page'))->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>

    <!-- ========================================================================= -->
    <!-- SECTION 3: RECENT BOOKINGS TABLE & PROJECT BREAKDOWN -->
    <!-- ========================================================================= -->
    <div class="row g-3">
        <!-- TABEL TRANSAKSI & BOOKING TERKINI -->
        <div class="col-12 col-xl-8">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 14px; background: #ffffff;">
                <div class="card-header bg-white py-3 px-4 border-bottom d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold text-dark mb-0" style="font-size: 1rem;">
                        <i class="mdi mdi-history text-primary me-1.5 fs-5"></i>
                        {{ $isKepalaMarketing ? 'Daftar Transaksi & Booking Terkini' : 'Daftar Transaksi Booking Saya' }}
                    </h5>
                    <a href="{{ route('marketing.list_pengajuan') }}" class="small text-primary fw-bold text-decoration-none">Lihat Semua</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" style="font-size: 0.85rem;">
                            <thead class="table-light">
                                <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                                    <th class="py-3 px-3" style="color: #334155; font-weight: 800;">Customer</th>
                                    <th class="py-3" style="color: #334155; font-weight: 800;">Unit / Proyek</th>
                                    <th class="py-3" style="color: #334155; font-weight: 800;">Tipe Bayar</th>
                                    <th class="py-3" style="color: #334155; font-weight: 800;">Sales / Agency</th>
                                    <th class="py-3" style="color: #334155; font-weight: 800;">Booking Fee</th>
                                    <th class="py-3 text-center" style="color: #334155; font-weight: 800;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentBookings as $b)
                                    <tr>
                                        <td class="px-3">
                                            <span class="fw-bold text-dark d-block" style="font-size: 0.9rem;">{{ $b->customer->full_name ?? ($b->customer->name ?? '-') }}</span>
                                            <small class="text-muted" style="font-size: 0.75rem;">{{ $b->booking_date ? \Carbon\Carbon::parse($b->booking_date)->format('d M Y') : '-' }}</small>
                                        </td>
                                        <td>
                                            <span class="badge" style="background: #e0f2fe; color: #0284c7; font-weight: 700; border: 1px solid #bae6fd;">
                                                Unit {{ $b->unit->unit_code ?? ($b->unit->block . '.' . $b->unit->unit_number) }}
                                            </span>
                                            <small class="text-muted d-block mt-0.5" style="font-size: 0.74rem;">{{ $b->unit->landBank->name ?? '-' }}</small>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark border px-2 py-1" style="font-size: 0.74rem;">
                                                {{ strtoupper(str_replace('_', ' ', $b->purchase_type ?? 'KPR')) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="fw-semibold text-dark d-block small">{{ $b->sales->name ?? '-' }}</span>
                                            @if($b->agent_fee > 0)
                                                <small class="text-purple fw-bold" style="color: #9a55ff; font-size: 0.74rem;">Fee: Rp {{ number_format($b->agent_fee, 0, ',', '.') }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="fw-bold text-success" style="font-size: 0.88rem;">Rp {{ number_format($b->booking_fee ?? 0, 0, ',', '.') }}</span>
                                        </td>
                                        <td class="text-center">
                                            @php
                                                $st = strtolower($b->status ?? 'pending');
                                                $badgeStyle = 'background: #f59e0b; color: #ffffff;';
                                                if(in_array($st, ['approved', 'aktif', 'acc', 'selesai'])) $badgeStyle = 'background: #10b981; color: #ffffff;';
                                                elseif(in_array($st, ['rejected', 'batal', 'rijected'])) $badgeStyle = 'background: #ef4444; color: #ffffff;';
                                            @endphp
                                            <span class="badge" style="{{ $badgeStyle }} font-size: 0.72rem; padding: 4px 8px; border-radius: 6px;">
                                                {{ ucfirst($b->status ?? 'Pending') }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-muted">
                                            <i class="mdi mdi-information-outline fs-2 d-block mb-1 opacity-50"></i>
                                            Belum ada data booking terbaru.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- RINGKASAN MARKETING PER PROYEK -->
        <div class="col-12 col-xl-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 14px; background: #ffffff;">
                <div class="card-header bg-white py-3 px-4 border-bottom">
                    <h5 class="fw-bold text-dark mb-0" style="font-size: 1rem;">
                        <i class="mdi mdi-domain text-primary me-1.5 fs-5"></i>Progres Penjualan per Proyek
                    </h5>
                </div>
                <div class="card-body p-3">
                    <div class="d-flex flex-column gap-2.5">
                        @forelse($projects as $p)
                            @php
                                $percentSold = $p->total_units > 0 ? round(($p->sold_units / $p->total_units) * 100) : 0;
                            @endphp
                            <div class="p-3 rounded-3 border" style="background: #f8fafc;">
                                <div class="d-flex justify-content-between align-items-center mb-1.5">
                                    <span class="fw-bold text-dark" style="font-size: 0.9rem;">{{ $p->name }}</span>
                                    <span class="badge bg-primary bg-opacity-10 text-primary fw-bold" style="font-size: 0.74rem;">{{ $percentSold }}% Terjual</span>
                                </div>
                                <div class="progress mb-2" style="height: 6px; border-radius: 10px;">
                                    <div class="progress-bar bg-gradient-primary" role="progressbar" style="width: {{ $percentSold }}%;" aria-valuenow="{{ $percentSold }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="d-flex justify-content-between small text-muted pt-1" style="font-size: 0.76rem;">
                                    <span>Tersedia: <strong class="text-success">{{ $p->ready_units }}</strong></span>
                                    <span>Booking: <strong class="text-warning">{{ $p->booked_units }}</strong></span>
                                    <span>Sold: <strong class="text-primary">{{ $p->sold_units }}</strong></span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-4 text-muted">Belum ada proyek terdaftar.</div>
                        @endforelse
                    </div>
                </div>
                @if($projects->hasPages())
                    <div class="card-footer bg-white border-top py-2.5 px-3 d-flex flex-wrap justify-content-between align-items-center gap-2">
                        <small class="text-muted" style="font-size: 0.75rem;">
                            Menampilkan {{ $projects->firstItem() }}-{{ $projects->lastItem() }} dari {{ $projects->total() }} Proyek
                        </small>
                        <div class="pagination-wrapper">
                            {{ $projects->appends(request()->except('project_page'))->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>

<style>
    .pagination {
        margin-bottom: 0 !important;
        gap: 3px;
    }
    .page-item .page-link {
        font-size: 0.74rem !important;
        padding: 3px 8px !important;
        border-radius: 6px !important;
        color: #475569 !important;
        border: 1px solid #cbd5e1 !important;
    }
    .page-item.active .page-link {
        background: linear-gradient(135deg, #da8cff, #9a55ff) !important;
        border-color: #9a55ff !important;
        color: #ffffff !important;
        font-weight: bold;
    }
    .page-item.disabled .page-link {
        opacity: 0.5;
        border-color: #e2e8f0 !important;
    }
</style>
@endsection
