@extends('layouts.partial.app')

@section('title', 'Daftar Customer KPR Terverifikasi - Property Management App')

@section('content')
<style>
/* ===== GLOBAL COMPACT & MODERN THEME (SOLID COLORS & 6PX BORDER-RADIUS) ===== */
.compact-table-card {
    border: 1px solid #e2e8f0 !important;
    border-radius: 6px !important;
    box-shadow: 0 1px 3px rgba(0,0,0,0.02) !important;
    background: #ffffff;
    overflow: hidden;
}

.compact-table-card .card-header {
    background-color: #ffffff !important;
    border-bottom: 1px solid #e2e8f0 !important;
    padding: 0.85rem 1rem !important;
}

.compact-table-card .card-body {
    padding: 1rem !important;
}

/* Filter Card */
.filter-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 0.75rem 1rem;
    margin-bottom: 1rem;
}

/* Search Input Group in Filter */
.search-input-group {
    display: flex !important;
    flex-wrap: nowrap !important;
    align-items: stretch !important;
    width: 100% !important;
    height: 36px !important;
}

.search-input-group .form-control {
    height: 36px !important;
    min-height: 36px !important;
    border-top-left-radius: 6px !important;
    border-bottom-left-radius: 6px !important;
    border-top-right-radius: 0 !important;
    border-bottom-right-radius: 0 !important;
    border: 1.5px solid #e2e8f0 !important;
    border-right: none !important;
    font-size: 0.85rem !important;
    padding: 0.4rem 0.75rem !important;
    margin: 0 !important;
    flex: 1 1 auto;
    background-color: #ffffff;
    color: #334155;
}

.search-input-group .form-control:focus {
    border-color: #9a55ff !important;
    box-shadow: none !important;
}

.search-input-group .btn-search-submit {
    height: 36px !important;
    min-height: 36px !important;
    border-top-left-radius: 0 !important;
    border-bottom-left-radius: 0 !important;
    border-top-right-radius: 6px !important;
    border-bottom-right-radius: 6px !important;
    padding: 0 0.85rem !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    box-shadow: none !important;
    border: none !important;
    font-size: 1.1rem !important;
    background-color: #9a55ff !important;
    color: #ffffff !important;
    margin: 0 !important;
    flex-shrink: 0;
    transition: background-color 0.2s ease;
}

.search-input-group .btn-search-submit:hover {
    background-color: #8937f5 !important;
}

/* SELECT2 ENHANCEMENTS */
.select2-container--bootstrap-5 .select2-selection {
    border: 1.5px solid #e2e8f0 !important;
    border-radius: 6px !important;
    min-height: 36px !important;
    height: 36px !important;
    padding: 0.25rem 0.65rem !important;
    font-family: inherit !important;
    background-color: #ffffff !important;
}

.select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
    color: #334155 !important;
    font-size: 0.85rem !important;
    font-weight: 500 !important;
    line-height: 26px !important;
    padding-left: 0 !important;
}

.select2-container--bootstrap-5 .select2-selection--single .select2-selection__arrow {
    height: 34px !important;
    right: 8px !important;
}

.select2-container--bootstrap-5 .select2-selection:hover,
.select2-container--bootstrap-5.select2-container--focus .select2-selection,
.select2-container--bootstrap-5.select2-container--open .select2-selection {
    border-color: #9a55ff !important;
    box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.1) !important;
}

.select2-container--bootstrap-5 .select2-dropdown {
    border-color: #e2e8f0 !important;
    border-radius: 6px !important;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08) !important;
}

.select2-container--bootstrap-5 .select2-results__option {
    padding: 0.45rem 0.75rem !important;
    font-size: 0.85rem !important;
    font-weight: 500 !important;
}

.select2-container--bootstrap-5 .select2-results__option--selected {
    background-color: #f3e8ff !important;
    color: #9333ea !important;
}

.select2-container--bootstrap-5 .select2-results__option--highlighted {
    background-color: #9a55ff !important;
    color: #ffffff !important;
}

/* BUTTONS SOLID */
.btn-icon-square {
    width: 36px !important;
    height: 36px !important;
    padding: 0 !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    border-radius: 6px !important;
    font-size: 1rem !important;
    flex-shrink: 0;
    border: none !important;
    transition: all 0.2s ease;
}

.btn-solid-primary {
    background-color: #9a55ff !important;
    color: #ffffff !important;
}
.btn-solid-primary:hover {
    background-color: #8937f5 !important;
    color: #ffffff !important;
}

.btn-solid-secondary {
    background-color: #64748b !important;
    color: #ffffff !important;
}
.btn-solid-secondary:hover {
    background-color: #475569 !important;
    color: #ffffff !important;
}

/* TABLE MODERN STYLING */
.table-unit {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 0;
}

.table-unit thead th {
    background-color: #f8fafc !important;
    color: #475569 !important;
    font-size: 0.72rem !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.05em;
    border-bottom: 1px solid #e2e8f0 !important;
    border-top: none !important;
    padding: 0.65rem 0.75rem !important;
    white-space: nowrap;
    vertical-align: middle;
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
    background-color: #9a55ff !important;
}

.progress-dark-green {
    background-color: #10b981 !important;
}

.progress-percent {
    min-width: 36px;
    text-align: right;
    font-size: 0.78rem;
    font-weight: 700;
    color: #64748b;
}

/* BADGES SOLID & 6PX BORDER-RADIUS */
.badge-clean {
    border-radius: 6px !important;
    padding: 0.32rem 0.6rem !important;
    font-size: 0.74rem !important;
    font-weight: 600 !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 0.35rem !important;
    white-space: nowrap !important;
    line-height: 1.3 !important;
    border: 1px solid transparent;
}

.badge-clean.status-approved {
    background-color: #ecfdf5 !important;
    color: #059669 !important;
    border-color: #a7f3d0 !important;
}

.badge-clean.status-survey {
    background-color: #f0f9ff !important;
    color: #0284c7 !important;
    border-color: #bae6fd !important;
}

.badge-clean.status-akad {
    background-color: #f5f3ff !important;
    color: #7c3aed !important;
    border-color: #ddd6fe !important;
}

.badge-clean.status-default {
    background-color: #f8fafc !important;
    color: #475569 !important;
    border-color: #e2e8f0 !important;
}

/* ACTION BUTTONS */
.btn-action-clean {
    height: 32px;
    padding: 0 0.85rem;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 6px !important;
    transition: all 0.2s ease;
    cursor: pointer;
    font-size: 0.78rem;
    font-weight: 600;
    gap: 0.35rem;
    border: none !important;
    text-decoration: none;
    white-space: nowrap;
}

.btn-action-survey {
    background-color: #0284c7 !important;
    color: #ffffff !important;
}
.btn-action-survey:hover {
    background-color: #0369a1 !important;
    color: #ffffff !important;
}

.btn-action-akad {
    background-color: #16a34a !important;
    color: #ffffff !important;
}
.btn-action-akad:hover {
    background-color: #15803d !important;
    color: #ffffff !important;
}

/* PAGINATION MODERN */
.pagination { margin: 0; gap: 3px; }
.page-item .page-link {
    border: 1px solid #e2e8f0;
    color: #475569;
    font-weight: 600;
    padding: 0.35rem 0.7rem;
    font-size: 0.8rem;
    border-radius: 6px !important;
    transition: all 0.15s ease;
}
.page-item.active .page-link {
    background-color: #9a55ff !important;
    border-color: #9a55ff !important;
    color: #ffffff !important;
}
.page-item .page-link:hover {
    background-color: #f3e8ff;
    color: #9a55ff;
    border-color: #d8b4fe;
}
</style>

<div class="container-fluid px-2 px-md-4 py-3">

    <!-- Page Title & Subtitle (Clean Modern Typography) -->
    <div class="row align-items-center mb-4">
        <div class="col">
            <h2 class="text-dark mb-1 fw-bold" style="font-size: 1.55rem; letter-spacing: -0.02em;">
                Daftar Customer KPR Terverifikasi
            </h2>
            <p class="text-muted mb-0" style="font-size: 0.88rem;">
                Kelola User KPR yang telah terverifikasi dokumennya untuk lanjut ke tahapan survey dan akad
            </p>
        </div>
    </div>

    <!-- MAIN TABLE CARD -->
    <div class="row">
        <div class="col-12">
            <div class="card compact-table-card">
                <div class="card-header bg-white d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <h6 class="mb-0 fw-bold text-dark d-flex align-items-center" style="font-size: 0.95rem;">
                        <i class="mdi mdi-format-list-bulleted me-2 text-primary"></i>Data Customer KPR Terverifikasi
                    </h6>
                </div>

                <div class="card-body">

                    <!-- Filter Section -->
                    <div class="filter-card">
                        <form method="GET" action="{{ route('kpr.customer-verified') }}" id="filterForm">
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

                                        <!-- Filter Bank Dropdown -->
                                        <div style="width: 170px;">
                                            <select name="bank_name" class="form-control select2" id="bankSelect" style="width: 100%;">
                                                <option value="">Semua Bank</option>
                                                @foreach($banks ?? [] as $bank)
                                                    <option value="{{ $bank->bank_name }}" {{ request('bank_name') == $bank->bank_name ? 'selected' : '' }}>
                                                        {{ $bank->bank_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Filter Status Dropdown -->
                                        <div style="width: 170px;">
                                            <select name="status" class="form-control select2" id="statusSelect" style="width: 100%;">
                                                <option value="">Semua Status</option>
                                                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Terverifikasi</option>
                                                <option value="survey" {{ request('status') == 'survey' ? 'selected' : '' }}>Lanjut Survey</option>
                                                <option value="akad" {{ request('status') == 'akad' ? 'selected' : '' }}>Siap Akad</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Right Side: Limit Dropdown + Filter & Reset Buttons -->
                                    <div class="d-flex align-items-center gap-2 ms-auto">
                                        <div style="width: 85px;">
                                            <select name="per_page" class="form-control select2" id="perPageSelect" style="width: 100%;">
                                                <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                                <option value="25" {{ request('per_page', 10) == 25 ? 'selected' : '' }}>25</option>
                                                <option value="50" {{ request('per_page', 10) == 50 ? 'selected' : '' }}>50</option>
                                            </select>
                                        </div>
                                        <button type="submit"
                                            class="btn-icon-square btn-solid-primary"
                                            id="filterBtn" title="Filter" onclick="showFilterLoading()">
                                            <i class="mdi mdi-filter"></i>
                                        </button>
                                        <a href="{{ route('kpr.customer-verified') }}"
                                            class="btn-icon-square btn-solid-secondary text-white"
                                            title="Reset" onclick="showResetLoading(event)">
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
                                        <select name="bank_name_mobile" class="form-control select2-mobile" id="bankSelectMobile" style="width: 100%;">
                                            <option value="">Semua Bank</option>
                                            @foreach($banks ?? [] as $bank)
                                                <option value="{{ $bank->bank_name }}" {{ request('bank_name') == $bank->bank_name ? 'selected' : '' }}>
                                                    {{ $bank->bank_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <select name="per_page_mobile" class="form-control select2-mobile" id="perPageSelectMobile" style="width: 100%;">
                                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                            <option value="25" {{ request('per_page', 10) == 25 ? 'selected' : '' }}>25</option>
                                            <option value="50" {{ request('per_page', 10) == 50 ? 'selected' : '' }}>50</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <button type="submit"
                                            class="btn btn-solid-primary w-100 d-inline-flex align-items-center justify-content-center"
                                            id="filterBtnMobile" title="Filter"
                                            onclick="showFilterLoading()" style="height: 36px; border-radius: 6px;">
                                            <i class="mdi mdi-filter me-1"></i>Filter
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('kpr.customer-verified') }}"
                                            class="btn btn-solid-secondary w-100 d-inline-flex align-items-center justify-content-center"
                                            title="Reset" onclick="showResetLoading(event)" style="height: 36px; border-radius: 6px; text-decoration: none;">
                                            <i class="mdi mdi-refresh me-1"></i>Reset
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- TABLE CONTENT -->
                    <div class="table-responsive">
                        <table class="table-unit align-middle">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 50px;">NO</th>
                                    <th>NAMA USER</th>
                                    <th>NAMA - UNIT</th>
                                    <th>JENIS & TIPE</th>
                                    <th>BANK</th>
                                    <th class="text-center">STATUS BANGUNAN</th>
                                    <th class="text-center">STATUS KPR</th>
                                    <th class="text-center">TANGGAL VERIFIKASI</th>
                                    <th class="text-center" style="width: 130px;">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($kprApplications as $index => $application)
                                    @php
                                        $fullName = trim($application->customer->full_name ?? '-');
                                        $nameParts = array_values(array_filter(explode(' ', $fullName)));
                                        $initials = (count($nameParts) > 0) ? strtoupper(substr($nameParts[0], 0, 1)) . (isset($nameParts[1]) ? strtoupper(substr($nameParts[1], 0, 1)) : '') : '--';
                                        $unitType = strtolower($application->unit->type ?? '');
                                        $status = strtolower($application->status ?? '');

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
                                        
                                        $badgeProgStyle = match($progStatus) {
                                            'selesai' => 'background-color: #ecfdf5; color: #059669; border: 1px solid #a7f3d0;',
                                            'finishing' => 'background-color: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe;',
                                            'atap', 'dinding' => 'background-color: #fffbeb; color: #d97706; border: 1px solid #fde68a;',
                                            'pondasi' => 'background-color: #fff7ed; color: #ea580c; border: 1px solid #ffedd5;',
                                            default => 'background-color: #f8fafc; color: #64748b; border: 1px solid #e2e8f0;',
                                        };

                                        $barColor = match($progStatus) {
                                            'selesai' => 'bg-success',
                                            'finishing' => 'bg-primary',
                                            'atap', 'dinding' => 'bg-warning',
                                            'pondasi' => 'bg-warning',
                                            default => 'bg-secondary',
                                        };
                                    @endphp
                                    <tr>
                                        <td class="text-center fw-bold" style="color: #64748b;">
                                            {{ $kprApplications->firstItem() + $index }}
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
                                                $isSubsidi = ($jenis === 'subsidi');
                                            @endphp
                                            <span class="badge-clean" style="{{ $isSubsidi ? 'background-color: #ecfdf5; color: #059669; border: 1px solid #a7f3d0;' : 'background-color: #f8fafc; color: #475569; border: 1px solid #cbd5e1;' }}">
                                                <i class="mdi {{ $isSubsidi ? 'mdi-home-assistant' : 'mdi-office-building' }}"></i>
                                                {{ ucfirst($jenis) }} - {{ $application->unit->type ?? '-' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-1.5">
                                                <i class="mdi mdi-bank text-primary" style="font-size: 1rem;"></i>
                                                <span class="fw-bold text-dark" style="font-size: 0.86rem;">{{ $application->bank->bank_name ?? '-' }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="progress-wrapper">
                                                <div class="progress-row">
                                                    <div class="progress">
                                                        <div class="progress-bar-custom {{ $progPercent == 100 ? 'progress-dark-green' : 'progress-green' }}"
                                                            style="width: {{ $progPercent }}%;"></div>
                                                    </div>
                                                    <div class="progress-percent">{{ $progPercent }}%</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            @php
                                                $isUnitSoldOut = in_array(strtolower($application->unit->status ?? ''), ['sold', 'soldout']) || in_array(strtolower($status ?? ''), ['akad', 'completed', 'sold', 'done']);
                                            @endphp
                                            @if ($isUnitSoldOut)
                                                <span class="badge-clean status-akad">
                                                    <i class="mdi mdi-home-lock"></i> Sold Out
                                                </span>
                                            @elseif ($status === 'approved' || $status === 'dokumen' || $status === 'analisa')
                                                <span class="badge-clean status-approved">
                                                    <i class="mdi mdi-check-circle-outline"></i> Terverifikasi
                                                </span>
                                            @elseif ($status === 'survey')
                                                <span class="badge-clean status-survey">
                                                    <i class="mdi mdi-map-marker-check-outline"></i> Survey
                                                </span>
                                            @else
                                                <span class="badge-clean status-default">
                                                    <i class="mdi mdi-progress-question"></i> {{ ucfirst($status ?? '-') }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <span class="text-muted" style="font-size: 0.83rem;">
                                                <i class="mdi mdi-calendar-month-outline me-1"></i>{{ optional($application->updated_at)->format('d M Y') ?? '-' }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            @php
                                                $isSubsidi = strtolower($application->unit->jenis ?? '') === 'subsidi';
                                                $isDevDone = $progStatus === 'selesai' || $progPercent === 100;
                                                $canSurveySubsidi = !$isSubsidi || $isDevDone;
                                            @endphp

                                            @if($isUnitSoldOut)
                                                <button type="button" class="btn btn-sm d-inline-flex align-items-center justify-content-center px-2.5 py-1" disabled title="Unit telah Akad / Sold Out" style="background: #f5f3ff; color: #7c3aed; border: 1px solid #ddd6fe; font-weight: 600; border-radius: 6px; font-size: 0.78rem; cursor: not-allowed;">
                                                    <i class="mdi mdi-home-lock me-1"></i>Sold Out
                                                </button>
                                            @elseif(strtolower($application->unit->jenis ?? '') === 'komersil')
                                                @if($status === 'survey')
                                                    <a href="{{ route('kpr.survey', $application->id) }}" class="btn-action-clean btn-action-survey" onclick="showProcessLoading(event)">
                                                        <i class="mdi mdi-home-search-outline"></i> Lanjut Survey
                                                    </a>
                                                @else
                                                    <a href="{{ route('kpr.akad', $application->id) }}" class="btn-action-clean btn-action-akad" onclick="showProcessLoading(event)">
                                                        <i class="mdi mdi-handshake-outline"></i> Lanjut ke Akad
                                                    </a>
                                                @endif
                                            @else
                                                @if($status === 'akad')
                                                    <a href="{{ route('kpr.akad', $application->id) }}" class="btn-action-clean btn-action-akad" onclick="showProcessLoading(event)">
                                                        <i class="mdi mdi-handshake-outline"></i> Lanjut ke Akad
                                                    </a>
                                                @elseif(!$canSurveySubsidi)
                                                    <button type="button" class="btn btn-sm d-inline-flex align-items-center justify-content-center px-2 py-1" disabled title="Unit Subsidi: Survey baru dapat dilakukan setelah pembangunan fisik unit selesai 100% (Status: {{ $statusLabel }})." style="background: #fffbeb; color: #b45309; border: 1px solid #fde68a; font-weight: 600; border-radius: 6px; font-size: 0.76rem; cursor: not-allowed;">
                                                        <i class="mdi mdi-lock-outline me-1"></i>Fisik Belum 100%
                                                    </button>
                                                @else
                                                    <a href="{{ route('kpr.survey', $application->id) }}" class="btn-action-clean btn-action-survey" onclick="showProcessLoading(event)">
                                                        <i class="mdi mdi-home-search-outline"></i> Lanjut Survey
                                                    </a>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted py-4">Tidak ada data customer KPR terverifikasi</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- PAGINATION -->
                    @if(($kprApplications->total() ?? 0) > 0)
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-3 pt-2">
                            <div class="pagination-info mb-2 mb-sm-0 text-muted" style="font-size: 0.85rem;">
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
    $('#bankSelect').select2({ theme: 'bootstrap-5', placeholder: 'Semua Bank', allowClear: true, width: '100%', minimumResultsForSearch: Infinity });
    $('#statusSelect').select2({ theme: 'bootstrap-5', placeholder: 'Semua Status', allowClear: true, width: '100%', minimumResultsForSearch: Infinity });
    $('#perPageSelect').select2({ theme: 'bootstrap-5', placeholder: '10', allowClear: false, width: '100%', minimumResultsForSearch: Infinity });
    $('#bankSelectMobile').select2({ theme: 'bootstrap-5', placeholder: 'Semua Bank', allowClear: true, width: '100%', minimumResultsForSearch: Infinity });
    $('#perPageSelectMobile').select2({ theme: 'bootstrap-5', placeholder: '10', allowClear: false, width: '100%', minimumResultsForSearch: Infinity });

    // Sync search input
    $('input[name="search"]').on('input', function() { $('#searchMobile').val($(this).val()); });
    $('#searchMobile').on('input', function() { $('input[name="search"]').val($(this).val()); });

    // Auto submit on per_page change
    $('#perPageSelect').on('change', function() {
        $('#filterForm').submit();
    });
});

function showPaginationLoading(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Memuat...',
        html: 'Sedang memuat halaman',
        allowOutsideClick: false,
        didOpen: () => { Swal.showLoading(); }
    });
    window.location.href = event.currentTarget.href;
}

function showFilterLoading() {
    Swal.fire({
        title: 'Memuat...',
        html: 'Sedang memfilter data',
        allowOutsideClick: false,
        didOpen: () => { Swal.showLoading(); }
    });
}

function showResetLoading(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Memuat...',
        html: 'Sedang mereset filter',
        allowOutsideClick: false,
        didOpen: () => { Swal.showLoading(); }
    });
    window.location.href = event.currentTarget.href;
}

function showProcessLoading(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Memuat...',
        html: 'Sedang memproses...',
        allowOutsideClick: false,
        didOpen: () => { Swal.showLoading(); }
    });
    window.location.href = event.currentTarget.href;
}
</script>
@endpush
