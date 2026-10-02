@extends('layouts.partial.app')

@section('title', 'Daftar Customer KPR Terverifikasi - Property Management App')

@section('content')
<style>
/* ===== COMPACT TABLE CARD PERSIS DAFTAR USER KPR ===== */
.card.compact-table-card,
.compact-table-card {
    background: #ffffff !important;
    border: 1px solid #e2e8f0 !important;
    border-radius: 8px !important;
    box-shadow: none !important;
    overflow: hidden;
    margin-bottom: 1.5rem;
}

.compact-table-card .card-body {
    padding: 0.85rem 1.25rem 1.25rem 1.25rem !important;
    background: #ffffff !important;
}

.filter-card {
    background: #ffffff;
    border-radius: 0;
    padding: 0;
    margin-top: 0 !important;
    margin-bottom: 0.85rem !important;
    border: none;
}
.filter-card form {
    margin-bottom: 0 !important;
}

/* Search Input Group in Filter */
.search-input-group {
    display: flex !important;
    flex-wrap: nowrap !important;
    align-items: stretch !important;
    width: 100% !important;
    height: 38px !important;
}

.search-input-group .form-control {
    height: 38px !important;
    min-height: 38px !important;
    border-top-left-radius: 6px !important;
    border-bottom-left-radius: 6px !important;
    border-top-right-radius: 0 !important;
    border-bottom-right-radius: 0 !important;
    border: 1.5px solid #e2e8f0 !important;
    border-right: none !important;
    font-size: 0.88rem !important;
    padding: 0.45rem 0.85rem !important;
    margin: 0 !important;
    flex: 1 1 auto;
}

.search-input-group .btn-search-submit {
    height: 38px !important;
    min-height: 38px !important;
    border-top-left-radius: 0 !important;
    border-bottom-left-radius: 0 !important;
    border-top-right-radius: 6px !important;
    border-bottom-right-radius: 6px !important;
    padding: 0 0.95rem !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    box-shadow: none !important;
    border: none !important;
    font-size: 1.15rem !important;
    background: #9a55ff !important;
    color: #ffffff !important;
    margin: 0 !important;
    flex-shrink: 0;
    transition: opacity 0.2s;
}
.search-input-group .btn-search-submit:hover {
    opacity: 0.9;
}

.search-input-group:focus-within .form-control {
    border-color: #9a55ff !important;
    box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.12) !important;
}

/* SELECT2 ENHANCEMENTS */
.select2-container--bootstrap-5 .select2-selection {
    border: 1.5px solid #e2e8f0 !important;
    border-radius: 6px !important;
    min-height: 38px !important;
    height: 38px !important;
    padding: 0.35rem 0.75rem !important;
    font-family: inherit !important;
    background-color: #ffffff !important;
}

.select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
    color: #2c2e3f !important;
    font-size: 0.88rem !important;
    font-weight: 600 !important;
    line-height: 24px !important;
    padding-left: 0 !important;
}

.select2-container--bootstrap-5 .select2-selection--single .select2-selection__arrow {
    height: 36px !important;
    right: 8px !important;
}

.select2-container--bootstrap-5 .select2-selection:hover,
.select2-container--bootstrap-5.select2-container--focus .select2-selection,
.select2-container--bootstrap-5.select2-container--open .select2-selection {
    border-color: #9a55ff !important;
    box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.12) !important;
}

.select2-container--bootstrap-5 .select2-dropdown {
    border-color: #e2e8f0 !important;
    border-radius: 6px !important;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08) !important;
}

/* TABLE UNIT PERSIS DAFTAR USER KPR */
.table-unit {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 0;
}
.table-unit thead th {
    background: #f8fafc !important;
    color: #475569 !important;
    font-weight: 700 !important;
    font-size: 0.76rem !important;
    text-transform: uppercase !important;
    letter-spacing: 0.05em !important;
    border-bottom: 2px solid #e2e8f0 !important;
    padding: 0.75rem 0.75rem !important;
    vertical-align: middle;
    white-space: nowrap;
}
.table-unit thead th.sortable {
    cursor: pointer;
    user-select: none;
}
.table-unit thead th.sortable:hover {
    color: #9a55ff !important;
}
.table-unit thead th.active-sort {
    color: #9a55ff !important;
}
.table-unit thead th i {
    font-size: 0.82rem;
    margin-left: 3px;
    opacity: 0.6;
}
.table-unit thead th:hover i,
.table-unit thead th.active-sort i {
    opacity: 1;
}

.table-unit tbody td {
    padding: 0.75rem 0.75rem !important;
    vertical-align: middle;
    font-size: 0.85rem;
    border-bottom: 1px solid #f1f5f9 !important;
    color: #334155;
}
.table-unit tbody tr:hover {
    background-color: #f8fafc !important;
}

/* User Avatar Box */
.user-avatar-box {
    width: 34px;
    height: 34px;
    border-radius: 6px;
    background-color: #f3e8ff;
    color: #9333ea;
    font-weight: 700;
    font-size: 0.85rem;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

/* Clean Badges 6px Radius */
.badge-clean {
    border-radius: 6px !important;
    padding: 0.35rem 0.65rem !important;
    font-size: 0.75rem !important;
    font-weight: 600 !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 0.35rem !important;
    white-space: nowrap !important;
    line-height: 1.3 !important;
    border: 1px solid transparent;
}
.badge-clean.status-approved {
    background: #ecfdf5 !important;
    color: #059669 !important;
    border-color: #a7f3d0 !important;
}
.badge-clean.status-survey {
    background: #e0f2fe !important;
    color: #0284c7 !important;
    border-color: #bae6fd !important;
}
.badge-clean.status-akad {
    background: #f5f3ff !important;
    color: #7c3aed !important;
    border-color: #ddd6fe !important;
}
.badge-clean.status-default {
    background: #f8fafc !important;
    color: #475569 !important;
    border-color: #e2e8f0 !important;
}

/* PROGRESS BAR (PERSIS CATALOG UNIT) */
.progress-wrapper {
    min-width: 130px;
    max-width: 160px;
    margin: 0 auto;
}

.progress-row {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.progress-wrapper .progress,
.progress-row .progress {
    flex: 1;
    height: 8px;
    border-radius: 4px;
    background: #edf0f5;
    overflow: hidden;
    margin-bottom: 0;
}

.progress-bar-custom {
    height: 100%;
    border-radius: 4px;
    transition: width 0.4s ease;
}

.progress-green {
    background-color: #10b981 !important;
}

.progress-dark-green {
    background-color: #059669 !important;
}

.progress-percent {
    min-width: 36px;
    text-align: right;
    font-size: 0.78rem;
    font-weight: 700;
    color: #64748b;
}

/* Action Button Proses Akad */
.btn-proses-akad {
    background-color: #f59e0b !important;
    border: 1px solid #d97706 !important;
    color: #ffffff !important;
    font-weight: 700 !important;
    font-size: 0.78rem !important;
    border-radius: 6px !important;
    padding: 0.4rem 0.85rem !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 0.35rem !important;
    text-decoration: none !important;
    box-shadow: 0 1px 3px rgba(245, 158, 11, 0.25) !important;
    transition: all 0.2s ease;
}
.btn-proses-akad:hover {
    background-color: #d97706 !important;
    color: #ffffff !important;
    transform: translateY(-1px);
    box-shadow: 0 3px 8px rgba(245, 158, 11, 0.35) !important;
}

/* Pagination */
.pagination { margin: 0; gap: 3px; }
.page-item .page-link {
    border: 1px solid #e2e8f0;
    padding: 0.35rem 0.7rem;
    font-size: 0.78rem;
    color: #64748b;
    background-color: #ffffff;
    border-radius: 6px !important;
    min-width: 32px;
    text-align: center;
    text-decoration: none;
    font-weight: 600;
}
.page-item.active .page-link {
    background: #9a55ff !important;
    border-color: #9a55ff !important;
    color: #ffffff !important;
    box-shadow: none !important;
}
.pagination-info {
    font-size: 0.82rem;
    color: #64748b;
    font-weight: 500;
}
</style>

<div class="container-fluid px-2 px-md-4 py-3">

    <!-- Page Title & Subtitle (Persis Daftar User KPR) -->
    <div class="row align-items-center mb-4">
        <div class="col">
            <h2 class="text-dark mb-1 fw-bold" style="font-size: 1.55rem; letter-spacing: -0.02em;">
                Daftar User KPR Terverifikasi
            </h2>
            <p class="text-muted mb-0" style="font-size: 0.88rem;">
                Persiapan & Pemrosesan Akad KPR Konsumen
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card compact-table-card">
                <div class="card-header bg-white d-flex align-items-center gap-2 py-2.5 px-3 px-md-4" style="border-bottom: 1px solid #e2e8f0 !important;">
                    <div style="width: 32px; height: 32px; border-radius: 6px; background-color: #f3e8ff; color: #9333ea; display: inline-flex; align-items: center; justify-content: center; font-size: 1.15rem; flex-shrink: 0;">
                        <i class="mdi mdi-account-group"></i>
                    </div>
                    <span style="font-size: 0.95rem; font-weight: 700; color: #0f172a;">Data Customer KPR Terverifikasi</span>
                </div>

                <div class="card-body">
                    <!-- Filter Section -->
                    <div class="filter-card mb-3">
                        <form method="GET" action="{{ route('customer.kpr.survey') }}" id="filterForm">
                            <!-- FILTER DESKTOP -->
                            <div class="filter-row-desktop d-none d-md-block">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                    <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                        <!-- Search Input -->
                                        <div style="min-width: 220px; max-width: 280px; flex: 1;">
                                            <div class="input-group search-input-group">
                                                <input type="text" name="search" value="{{ request('search') }}"
                                                    class="form-control" placeholder="Cari nama user...">
                                                <button class="btn btn-search-submit" 
                                                    type="submit" title="Cari">
                                                    <i class="mdi mdi-magnify"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Filter Status Dropdown -->
                                        <div style="width: 190px;">
                                            <select name="status" class="form-control select2" id="statusSelect" style="width: 100%;">
                                                <option value="">Semua Status</option>
                                                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Terverifikasi</option>
                                                <option value="survey" {{ request('status') == 'survey' ? 'selected' : '' }}>Survey</option>
                                                <option value="akad" {{ request('status') == 'akad' ? 'selected' : '' }}>Akad</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Right Side: Limit Dropdown + Filter & Reset Buttons -->
                                    <div class="d-flex align-items-center gap-2 ms-auto">
                                        <div style="width: 90px;">
                                            <select name="per_page" class="form-control select2" id="perPageSelect" style="width: 100%;">
                                                <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                                <option value="15" {{ request('per_page', 15) == 15 ? 'selected' : '' }}>15</option>
                                                <option value="25" {{ request('per_page', 25) == 25 ? 'selected' : '' }}>25</option>
                                            </select>
                                        </div>
                                        <button type="submit"
                                            class="btn d-inline-flex align-items-center justify-content-center text-white"
                                            id="filterBtn" title="Filter" onclick="showFilterLoading()"
                                            style="width: 38px; height: 38px; border-radius: 6px; background: #9a55ff !important; border: 1px solid #9a55ff !important;">
                                            <i class="mdi mdi-filter"></i>
                                        </button>
                                        <a href="{{ route('customer.kpr.survey') }}"
                                            class="btn d-inline-flex align-items-center justify-content-center text-white"
                                            title="Reset" onclick="showResetLoading(event)"
                                            style="width: 38px; height: 38px; border-radius: 6px; background: #64748b !important; border: 1px solid #64748b !important; text-decoration: none;">
                                            <i class="mdi mdi-refresh"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- FILTER MOBILE -->
                            <div class="d-block d-md-none">
                                <div class="row g-2">
                                    <div class="col-12 mb-2">
                                        <div class="input-group search-input-group">
                                            <input type="text" name="search_mobile"
                                                value="{{ request('search') }}" class="form-control"
                                                placeholder="Cari nama user..." id="searchMobile">
                                            <button class="btn btn-search-submit" 
                                                type="submit" title="Cari">
                                                <i class="mdi mdi-magnify"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <select name="status_mobile" class="form-control select2-mobile" id="statusSelectMobile" style="width: 100%;">
                                            <option value="">Semua Status</option>
                                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Terverifikasi</option>
                                            <option value="survey" {{ request('status') == 'survey' ? 'selected' : '' }}>Survey</option>
                                            <option value="akad" {{ request('status') == 'akad' ? 'selected' : '' }}>Akad</option>
                                        </select>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <select name="per_page_mobile" class="form-control select2-mobile" id="perPageSelectMobile" style="width: 100%;">
                                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                            <option value="15" {{ request('per_page', 15) == 15 ? 'selected' : '' }}>15</option>
                                            <option value="25" {{ request('per_page', 25) == 25 ? 'selected' : '' }}>25</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <button type="submit"
                                            class="btn text-white w-100 d-inline-flex align-items-center justify-content-center"
                                            id="filterBtnMobile" title="Filter"
                                            onclick="showFilterLoading()" style="height: 38px; border-radius: 6px; background: #9a55ff !important; border: 1px solid #9a55ff !important;">
                                            <i class="mdi mdi-filter me-1"></i>Filter
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('customer.kpr.survey') }}"
                                            class="btn text-white w-100 d-inline-flex align-items-center justify-content-center"
                                            title="Reset" onclick="showResetLoading(event)" style="height: 38px; border-radius: 6px; background: #64748b !important; border: 1px solid #64748b !important; text-decoration: none;">
                                            <i class="mdi mdi-refresh me-1"></i>Reset
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Table Responsive -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle table-unit mb-0" id="unitTable">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 50px;">No</th>
                                    <th class="sortable {{ in_array(request('sort'), ['name_asc', 'name_desc']) ? 'active-sort' : '' }}" data-field="name" data-direction="{{ request('sort', 'latest') == 'name_asc' ? 'asc' : 'desc' }}">
                                        Nama User
                                        <i class="mdi {{ request('sort') == 'name_asc' ? 'mdi-arrow-up' : (request('sort') == 'name_desc' ? 'mdi-arrow-down' : 'mdi-swap-vertical') }}"></i>
                                    </th>
                                    <th class="sortable {{ in_array(request('sort'), ['unit_asc', 'unit_desc']) ? 'active-sort' : '' }}" data-field="unit" data-direction="{{ request('sort', 'latest') == 'unit_asc' ? 'asc' : 'desc' }}">
                                        Nama - Unit
                                        <i class="mdi {{ request('sort') == 'unit_asc' ? 'mdi-arrow-up' : (request('sort') == 'unit_desc' ? 'mdi-arrow-down' : 'mdi-swap-vertical') }}"></i>
                                    </th>
                                    <th>Jenis & Tipe</th>
                                    <th>Bank</th>
                                    <th class="text-center">Status Bangunan</th>
                                    <th class="text-center">Status KPR</th>
                                    <th class="text-center">Tanggal Verifikasi</th>
                                    <th class="text-center" style="min-width: 130px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($kprApplications as $index => $application)
                                    @php
                                        $fullName = trim($application->customer->full_name ?? '-');
                                        $nameParts = array_values(array_filter(explode(' ', $fullName)));
                                        $initials = (count($nameParts) > 0) ? strtoupper(substr($nameParts[0], 0, 1)) . (isset($nameParts[1]) ? strtoupper(substr($nameParts[1], 0, 1)) : '') : '--';

                                        $progStatus = strtolower($application->unit->construction_progress ?? 'belum_mulai');
                                        $progPercent = $application->unit->construction_progress_percentage ?? 0;
                                        $statusTextMap = [
                                            'belum_mulai' => 'Belum Mulai',
                                            'pondasi'     => 'Pondasi',
                                            'dinding'     => 'Dinding',
                                            'atap'        => 'Atap',
                                            'finishing'   => 'Finishing',
                                            'selesai'     => 'Selesai 100%',
                                        ];
                                        $statusLabel = $statusTextMap[$progStatus] ?? ucfirst($progStatus);
                                        
                                        $badgeProgColor = match($progStatus) {
                                            'selesai' => 'background:#dcfce7; color:#15803d; border:1px solid #86efac;',
                                            'finishing' => 'background:#e0e7ff; color:#4338ca; border:1px solid #c7d2fe;',
                                            'atap', 'dinding' => 'background:#fef3c7; color:#b45309; border:1px solid #fde68a;',
                                            'pondasi' => 'background:#ffedd5; color:#c2410c; border:1px solid #fed7aa;',
                                            default => 'background:#f1f5f9; color:#64748b; border:1px solid #e2e8f0;',
                                        };

                                        $isUnitSoldOut = in_array(strtolower($application->unit->status ?? ''), ['sold', 'soldout']) || in_array(strtolower($application->status ?? ''), ['akad', 'completed', 'sold', 'done']);
                                    @endphp
                                    <tr>
                                        <td class="text-center fw-bold text-muted" style="font-size: 0.82rem;">
                                            {{ $loop->iteration + (($kprApplications->currentPage() - 1) * $kprApplications->perPage()) }}
                                        </td>
                                        <td>
                                            <span class="fw-bold text-dark" style="font-size: 0.88rem;">
                                                {{ $application->customer->full_name ?? '-' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-1.5">
                                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">{{ $application->unit->unit_name ?? '-' }}</span>
                                                <span class="badge bg-light text-dark border fw-bold px-1.5 py-0.5" style="font-size: 0.72rem; border-radius: 4px;">{{ $application->unit->unit_code ?? '-' }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            @php
                                                $jenis = strtolower($application->unit->jenis ?? '');
                                                $tipe = $application->unit->type ?? '-';
                                            @endphp
                                            @if ($jenis == 'subsidi')
                                                <span class="badge" style="background-color: #ecfdf5; color: #059669; border: 1px solid #a7f3d0; border-radius: 6px; font-weight: 600; font-size: 0.75rem;">
                                                    <i class="mdi mdi-home-assistant me-1"></i>Subsidi - {{ $tipe }}
                                                </span>
                                            @elseif ($jenis == 'komersil')
                                                <span class="badge" style="background-color: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe; border-radius: 6px; font-weight: 600; font-size: 0.75rem;">
                                                    <i class="mdi mdi-office-building me-1"></i>Komersil - {{ $tipe }}
                                                </span>
                                            @else
                                                <span class="badge" style="background-color: #f8fafc; color: #475569; border: 1px solid #e2e8f0; border-radius: 6px; font-weight: 600; font-size: 0.75rem;">
                                                    <i class="mdi mdi-help-circle-outline me-1"></i>{{ ($jenis ?: '-') . ' - ' . $tipe }}
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="fw-bold text-dark" style="font-size: 0.85rem;">
                                                {{ $application->bank->bank_name ?? '-' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="progress-wrapper" title="{{ $statusLabel }} ({{ $progPercent }}%)">
                                                <div class="progress-row">
                                                    <div class="progress">
                                                        <div class="progress-bar-custom {{ $progPercent >= 100 ? 'progress-dark-green' : 'progress-green' }}"
                                                            style="width: {{ $progPercent }}%;"></div>
                                                    </div>
                                                    <div class="progress-percent">{{ $progPercent }}%</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            @if ($isUnitSoldOut)
                                                <span class="badge-clean status-akad">
                                                    <i class="mdi mdi-home-lock"></i>Sold Out
                                                </span>
                                            @elseif ($application->status === 'approved' || $application->status === 'dokumen')
                                                <span class="badge-clean status-approved">
                                                    <i class="mdi mdi-check-circle-outline"></i>Terverifikasi
                                                </span>
                                            @elseif ($application->status === 'survey')
                                                <span class="badge-clean status-survey">
                                                    <i class="mdi mdi-map-marker-check-outline"></i>Survey
                                                </span>
                                            @else
                                                <span class="badge-clean status-default">
                                                    <i class="mdi mdi-progress-question"></i>{{ ucfirst($application->status ?? '-') }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="d-inline-flex align-items-center text-muted" style="font-size: 0.82rem;">
                                                <i class="mdi mdi-calendar-month-outline me-1"></i>
                                                <span>{{ optional($application->updated_at)->format('d M Y') ?? '-' }}</span>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center align-items-center">
                                                @if ($isUnitSoldOut)
                                                    <button type="button" class="btn btn-sm d-inline-flex align-items-center justify-content-center px-2.5 py-1.5" disabled style="background: #f5f3ff; color: #7c3aed; border: 1px solid #ddd6fe; font-weight: 600; border-radius: 6px; font-size: 0.78rem; gap: 4px; cursor: not-allowed;">
                                                        <i class="mdi mdi-home-lock"></i>Sold Out
                                                    </button>
                                                @else
                                                    <a href="{{ route('kpr.approve', $application->booking_id ?? $application->id) }}" class="btn-proses-akad" title="Proses Akad KPR" onclick="showProcessLoading(event)">
                                                        <i class="mdi mdi-handshake-outline"></i>
                                                        <span>Proses Akad</span>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted py-4">Tidak ada data user KPR terverifikasi</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Section -->
                    @if(($kprApplications->total() ?? 0) > 0)
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-3 pt-2">
                            <div class="pagination-info mb-2 mb-sm-0">
                                Menampilkan {{ $kprApplications->firstItem() ?? 1 }} - {{ $kprApplications->lastItem() ?? 1 }} dari {{ $kprApplications->total() }} data
                            </div>
                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                    @if ($kprApplications->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link"><i class="mdi mdi-chevron-left"></i></span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $kprApplications->previousPageUrl() }}" onclick="showPaginationLoading(event)"><i class="mdi mdi-chevron-left"></i></a>
                                        </li>
                                    @endif

                                    @foreach ($kprApplications->getUrlRange(1, $kprApplications->lastPage()) as $page => $url)
                                        <li class="page-item {{ $kprApplications->currentPage() == $page ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}" onclick="showPaginationLoading(event)">{{ $page }}</a>
                                        </li>
                                    @endforeach

                                    @if ($kprApplications->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $kprApplications->nextPageUrl() }}" onclick="showPaginationLoading(event)"><i class="mdi mdi-chevron-right"></i></a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <span class="page-link"><i class="mdi mdi-chevron-right"></i></span>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    $('#statusSelect').select2({ theme: 'bootstrap-5', placeholder: 'Semua Status', allowClear: true, width: '100%', minimumResultsForSearch: Infinity });
    $('#perPageSelect').select2({ theme: 'bootstrap-5', placeholder: '10', allowClear: false, width: '100%', minimumResultsForSearch: Infinity });
    $('#statusSelectMobile').select2({ theme: 'bootstrap-5', placeholder: 'Semua Status', allowClear: true, width: '100%', minimumResultsForSearch: Infinity });
    $('#perPageSelectMobile').select2({ theme: 'bootstrap-5', placeholder: '10', allowClear: false, width: '100%', minimumResultsForSearch: Infinity });

    $('input[name="search"]').on('input', function() { $('#searchMobile').val($(this).val()); });
    $('#searchMobile').on('input', function() { $('input[name="search"]').val($(this).val()); });

    $('.sortable').click(function(event) {
        event.preventDefault();
        let field = $(this).data('field');
        let currentDirection = $(this).data('direction');
        let newDirection = currentDirection === 'asc' ? 'desc' : 'asc';
        let sortParam = field + '_' + newDirection;

        Swal.fire({ title: 'Memuat...', html: 'Sedang mengurutkan data', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } });

        let url = new URL(window.location.href);
        url.searchParams.set('sort', sortParam);
        url.searchParams.set('page', 1);
        window.location.href = url.toString();
    });
});

function showPaginationLoading(event) { event.preventDefault(); Swal.fire({ title: 'Memuat...', html: 'Sedang memuat halaman', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } }); window.location.href = event.currentTarget.href; }
function showFilterLoading() { Swal.fire({ title: 'Memuat...', html: 'Sedang memfilter data', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } }); }
function showResetLoading(event) { event.preventDefault(); Swal.fire({ title: 'Memuat...', html: 'Sedang mereset filter', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } }); window.location.href = event.currentTarget.href; }
function showProcessLoading(event) { event.preventDefault(); Swal.fire({ title: 'Memuat...', html: 'Sedang memproses...', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } }); window.location.href = event.currentTarget.href; }
</script>

@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        timer: 2500,
        showConfirmButton: false
    });
</script>
@endif

@if (session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: "{{ session('error') }}",
        confirmButtonColor: '#9a55ff'
    });
</script>
@endif
@endpush
