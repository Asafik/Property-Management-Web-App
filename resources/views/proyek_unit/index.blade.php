@extends('layouts.partial.app')

@section('title', 'Daftar Unit Proyek Kawasan - Property Management App')

@section('content')

<style>
    /* Styling Persis Dashboard Monitoring Bersih & Elegan */
    .stat-card-clean {
        background: #ffffff;
        border-radius: 16px;
        padding: 20px;
        border: 1px solid #f1f5f9;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);
        display: flex;
        align-items: center;
        gap: 16px;
    }
    .stat-icon-box {
        width: 52px;
        height: 52px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 24px;
        font-weight: 700;
        flex-shrink: 0;
    }
    .table-container-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #f1f5f9;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.03);
        padding: 24px;
    }
    .filter-select {
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        padding: 7px 14px;
        font-size: 0.88rem;
        color: #334155;
        background-color: #ffffff;
        outline: none;
    }
    .filter-select:focus {
        border-color: #5046e5;
        box-shadow: 0 0 0 2px rgba(80, 70, 229, 0.15);
    }
    .monitoring-table thead th {
        font-size: 0.82rem;
        font-weight: 600;
        color: #1e293b;
        border-bottom: 1px solid #f1f5f9;
        padding: 14px 16px;
        background: transparent;
    }
    .monitoring-table tbody td {
        font-size: 0.86rem;
        color: #1e293b;
        border-bottom: 1px solid #f8fafc;
        padding: 16px;
        vertical-align: middle;
    }
</style>

<div class="container-fluid px-2 px-md-4 py-3">

    <!-- Page Title & Subtitle -->
    <div class="mb-4">
        <h2 class="text-dark mb-1 fw-bold" style="font-size: 1.55rem; letter-spacing: -0.02em;">
            Daftar Unit Proyek Kawasan
        </h2>
        <p class="text-muted mb-0" style="font-size: 0.88rem;">
            Monitoring ketersediaan unit kavling, progres fisik bangunan, dan identitas tanah asal proyek.
        </p>
    </div>

    <!-- 4 KPI Metrics Card -->
    <div class="row g-3 mb-4">
        <!-- Card 1: Total Unit -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card-clean">
                <div class="stat-icon-box" style="background-color: #5b50e6;">
                    <i class="mdi mdi-home-city-outline" style="font-size: 26px;"></i>
                </div>
                <div>
                    <div class="text-muted" style="font-size: 0.82rem; font-weight: 500;">Total Unit Kavling</div>
                    <div class="fw-bold text-dark mt-0" style="font-size: 1.75rem; line-height: 1.2;">{{ $totalUnit }}</div>
                </div>
            </div>
        </div>

        <!-- Card 2: Tersedia -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card-clean">
                <div class="stat-icon-box" style="background-color: #00a96e;">
                    <i class="mdi mdi-checkbox-marked-circle-outline" style="font-size: 26px;"></i>
                </div>
                <div>
                    <div class="text-muted" style="font-size: 0.82rem; font-weight: 500;">Unit Tersedia</div>
                    <div class="fw-bold text-dark mt-0" style="font-size: 1.75rem; line-height: 1.2;">{{ $totalAvailable }}</div>
                </div>
            </div>
        </div>

        <!-- Card 3: Booking -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card-clean">
                <div class="stat-icon-box" style="background-color: #f59e0b;">
                    <i class="mdi mdi-clock-outline" style="font-size: 26px;"></i>
                </div>
                <div>
                    <div class="text-muted" style="font-size: 0.82rem; font-weight: 500;">Unit Ter-Booking</div>
                    <div class="fw-bold text-dark mt-0" style="font-size: 1.75rem; line-height: 1.2;">{{ $totalBooking }}</div>
                </div>
            </div>
        </div>

        <!-- Card 4: Terjual -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card-clean">
                <div class="stat-icon-box" style="background-color: #e54861;">
                    <i class="mdi mdi-cash-check" style="font-size: 26px;"></i>
                </div>
                <div>
                    <div class="text-muted" style="font-size: 0.82rem; font-weight: 500;">Unit Terjual (Sold)</div>
                    <div class="fw-bold text-dark mt-0" style="font-size: 1.75rem; line-height: 1.2;">{{ $totalSold }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Container: Table & Filters -->
    <div class="table-container-card">
        
        <!-- Filter Toolbar Form -->
        <form id="filterForm" method="GET" action="{{ route('proyek.unit.index') }}">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
                
                <!-- Left: Proyek / Tanah Asal & Status Filter -->
                <div class="d-flex flex-wrap align-items-center gap-3">
                    
                    <!-- Proyek / Tanah Asal Dropdown -->
                    <div class="d-flex align-items-center gap-2">
                        <label class="mb-0 text-dark fw-medium" style="font-size: 0.88rem; white-space: nowrap;">
                            Tanah / Proyek Asal:
                        </label>
                        <select name="land_bank_id" class="filter-select" onchange="document.getElementById('filterForm').submit()">
                            <option value="all">Semua Tanah Proyek</option>
                            @foreach($landBanks as $lb)
                                <option value="{{ $lb->id }}" {{ request('land_bank_id') == $lb->id ? 'selected' : '' }}>
                                    {{ $lb->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Status Dropdown -->
                    <div class="d-flex align-items-center gap-2">
                        <label class="mb-0 text-dark fw-medium" style="font-size: 0.88rem; white-space: nowrap;">Status Unit:</label>
                        <select name="status" class="filter-select" onchange="document.getElementById('filterForm').submit()" style="min-width: 120px;">
                            <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Semua Status</option>
                            <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Available</option>
                            <option value="booking" {{ request('status') == 'booking' ? 'selected' : '' }}>Booking</option>
                            <option value="sold" {{ request('status') == 'sold' ? 'selected' : '' }}>Terjual (Sold)</option>
                        </select>
                    </div>

                    <!-- Jenis Dropdown -->
                    <div class="d-flex align-items-center gap-2">
                        <label class="mb-0 text-dark fw-medium" style="font-size: 0.88rem; white-space: nowrap;">Jenis:</label>
                        <select name="jenis" class="filter-select" onchange="document.getElementById('filterForm').submit()" style="min-width: 110px;">
                            <option value="all" {{ request('jenis') == 'all' ? 'selected' : '' }}>Semua</option>
                            <option value="subsidi" {{ request('jenis') == 'subsidi' ? 'selected' : '' }}>Subsidi</option>
                            <option value="komersil" {{ request('jenis') == 'komersil' ? 'selected' : '' }}>Komersil</option>
                        </select>
                    </div>

                </div>

                <!-- Right: Search Box -->
                <div class="d-flex align-items-center gap-2">
                    <div class="input-group" style="max-width: 250px;">
                        <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari kode unit / blok..." value="{{ request('search') }}" style="border-radius: 8px 0 0 8px; font-size: 0.85rem;">
                        <button class="btn btn-sm btn-primary" type="submit" style="border-radius: 0 8px 8px 0; background-color: #5046e5; border-color: #5046e5;">
                            <i class="mdi mdi-magnify"></i>
                        </button>
                    </div>
                    @if(request()->hasAny(['land_bank_id', 'status', 'jenis', 'search']))
                        <a href="{{ route('proyek.unit.index') }}" class="btn btn-sm btn-light border" title="Reset Filter">
                            <i class="mdi mdi-refresh"></i>
                        </a>
                    @endif
                </div>

            </div>
        </form>

        <!-- Table: Daftar Unit Proyek -->
        <div class="table-responsive">
            <table class="table align-middle monitoring-table mb-0">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Kode / Unit</th>
                        <th>Tanah / Proyek Asal</th>
                        <th>Tipe / Dimensi</th>
                        <th>Jenis</th>
                        <th style="width: 160px;">Progres Bangunan</th>
                        <th style="width: 110px;">Status</th>
                        <th class="text-center" style="width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($units as $index => $u)
                        @php
                            $st = strtolower($u->status ?? 'available');
                            if ($st == 'available' || $st == 'tersedia') {
                                $stBadgeBg = '#dcfce7';
                                $stBadgeColor = '#15803d';
                                $stLabel = 'Available';
                            } elseif ($st == 'booking') {
                                $stBadgeBg = '#fef3c7';
                                $stBadgeColor = '#b45309';
                                $stLabel = 'Booking';
                            } elseif ($st == 'sold' || $st == 'terjual') {
                                $stBadgeBg = '#fee2e2';
                                $stBadgeColor = '#b91c1c';
                                $stLabel = 'Sold';
                            } else {
                                $stBadgeBg = '#f1f5f9';
                                $stBadgeColor = '#475569';
                                $stLabel = ucfirst($st);
                            }

                            // Progress Bangunan
                            $progPct = $u->construction_progress_percentage ?? 0;
                            $progText = ucwords(str_replace('_', ' ', $u->construction_progress ?? 'Belum Mulai'));
                        @endphp
                        <tr>
                            <td class="fw-bold">{{ $units->firstItem() + $index }}</td>
                            <td>
                                <!-- KODE / UNIT -->
                                <div class="fw-bold text-dark fs-6 font-monospace">
                                    {{ $u->unit_code ?: ($u->block . '-' . $u->unit_number) }}
                                </div>
                                <small class="text-muted">{{ $u->unit_name ?: ('Blok ' . $u->block . ' No. ' . $u->unit_number) }}</small>
                            </td>
                            <td>
                                <!-- TANAH / PROYEK ASAL -->
                                <span class="badge py-1.5 px-2.5" 
                                      style="background-color: #ede9fe; color: #6d28d9; font-size: 0.82rem; font-weight: 700; border-radius: 6px; border: 1px solid #ddd6fe;">
                                    {{ $u->landBank->name ?? 'Tanah Proyek' }}
                                </span>
                            </td>
                            <td>
                                <div class="fw-bold text-dark">{{ $u->type ? 'Tipe ' . $u->type : '-' }}</div>
                                <small class="text-muted font-monospace" style="font-size: 0.78rem;">
                                    LB: {{ $u->building_area ?? '-' }}m² | LT: {{ $u->area ?? '-' }}m²
                                </small>
                            </td>
                            <td>
                                @if(strtolower($u->jenis) == 'subsidi')
                                    <span class="badge py-1 px-2" style="background-color: #e0f2fe; color: #0369a1; font-size: 0.78rem; font-weight: 600; border-radius: 6px;">
                                        Subsidi
                                    </span>
                                @else
                                    <span class="badge py-1 px-2" style="background-color: #fef3c7; color: #92400e; font-size: 0.78rem; font-weight: 600; border-radius: 6px;">
                                        Komersil
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <small class="text-muted fw-semibold" style="font-size: 0.75rem;">{{ $progText }}</small>
                                    <span class="fw-bold" style="font-size: 0.75rem; color: #334155;">{{ $progPct }}%</span>
                                </div>
                                <div style="width: 100%; height: 7px; background-color: #e2e8f0; border-radius: 9999px; overflow: hidden;">
                                    <div style="width: {{ $progPct }}%; height: 100%; background-color: {{ $progPct == 100 ? '#10b981' : '#3b82f6' }}; border-radius: 9999px;"></div>
                                </div>
                            </td>
                            <td>
                                <span class="badge rounded-pill" style="background-color: {{ $stBadgeBg }}; color: {{ $stBadgeColor }}; font-weight: 600; padding: 5px 12px; font-size: 0.78rem;">
                                    {{ $stLabel }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('cetak.rab', $u->id) }}" class="btn btn-sm text-white fw-semibold d-inline-flex align-items-center gap-1.5 px-3 py-1.5 shadow-sm text-decoration-none" style="background-color: #5046e5; border-radius: 6px; font-size: 0.82rem;" title="Kelola Unit">
                                    <i class="mdi mdi-tools"></i>
                                    <span>Kelola</span>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                <i class="mdi mdi-home-alert-outline me-2" style="font-size: 1.5rem;"></i>
                                Tidak ada data unit kavling yang sesuai dengan filter.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4 d-flex justify-content-between align-items-center">
            <small class="text-muted">
                Menampilkan {{ $units->firstItem() ?? 0 }} - {{ $units->lastItem() ?? 0 }} dari {{ $units->total() }} unit
            </small>
            <div>
                {{ $units->links('pagination::bootstrap-5') }}
            </div>
        </div>

    </div>

</div>

@endsection
