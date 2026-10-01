@extends('layouts.partial.app')

@section('title', 'Daftar User KPR - Property Management App')

@section('content')
<style>
/* ===== COMPACT TABLE CARD PERSIS CATALOG UNIT / LIST PENGAJUAN ===== */
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

/* TABLE UNIT PERSIS CATALOG UNIT */
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

/* User & Sales Avatars */
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

.sales-avatar-box {
    width: 28px;
    height: 28px;
    border-radius: 6px;
    background-color: #e0e7ff;
    color: #4338ca;
    font-size: 0.75rem;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

/* Badge Solid & Soft 6px Radius */
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
    background: #f3e8ff !important;
    color: #9333ea !important;
    border-color: #d8b4fe !important;
}
.badge-clean.status-menunggu {
    background: #eff6ff !important;
    color: #2563eb !important;
    border-color: #bfdbfe !important;
}
.badge-clean.status-revisi {
    background: #fffbeb !important;
    color: #d97706 !important;
    border-color: #fde68a !important;
}
.badge-clean.status-rejected {
    background: #fef2f2 !important;
    color: #dc2626 !important;
    border-color: #fecaca !important;
}
.badge-clean.status-booking {
    background: #f8fafc !important;
    color: #475569 !important;
    border-color: #e2e8f0 !important;
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

.modal-content {
    border: none;
    border-radius: 16px;
}
.modal-header {
    background: linear-gradient(135deg, #da8cff, #9a55ff);
    color: white;
    border-radius: 16px 16px 0 0;
    padding: 1rem 1.5rem;
}
.modal-header .btn-close {
    filter: brightness(0) invert(1);
}
.modal-title {
    font-weight: 600;
    font-size: 1.1rem;
}
.modal-body {
    padding: 1.5rem;
}

.btn-eye-purple {
    height: 36px;
    padding: 0 14px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    transition: all 0.3s ease;
    cursor: pointer;
    font-size: 0.82rem;
    font-weight: 600;
    gap: 0.35rem;
    background: transparent;
    color: #9a55ff;
    border: 1.5px solid #9a55ff;
    text-decoration: none !important;
}
.btn-eye-purple i {
    font-size: 1rem;
    margin: 0 !important;
}
.btn-eye-purple:hover,
.btn-eye-purple:focus,
.btn-eye-purple:active {
    background: #9a55ff;
    color: #ffffff;
    border-color: #9a55ff;
    box-shadow: 0 5px 15px rgba(154, 85, 255, 0.25);
    transform: translateY(-2px);
    text-decoration: none !important;
}

.document-name {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.document-action-cell {
    text-align: right;
}
.btnApproveKpr:hover {
    background-color: #059669 !important;
    border-color: #059669 !important;
    color: #ffffff !important;
}

/* ===== MODERN FILE UPLOAD STYLING ===== */
.properti-file-upload-modern {
    position: relative;
    width: 100%;
}

.properti-file-upload-modern input[type="file"] {
    position: absolute;
    opacity: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
    z-index: 2;
}

.properti-file-upload-modern .properti-file-label-modern {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    gap: 6px;
    padding: 1rem 0.6rem;
    background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
    border: 2px dashed #d0d4db;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    min-height: 100px;
}

@media (min-width: 576px) {
    .properti-file-upload-modern .properti-file-label-modern {
        flex-direction: row;
        text-align: left;
        gap: 8px;
        padding: 0.75rem 1rem;
        min-height: auto;
    }
}

.properti-file-upload-modern:hover .properti-file-label-modern {
    border-color: #9a55ff;
    background: linear-gradient(135deg, #f1f0ff, #f8f9fa);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(154, 85, 255, 0.1);
}

.properti-file-upload-modern .properti-file-label-modern i {
    font-size: 1.6rem;
    color: #9a55ff;
    background: rgba(154, 85, 255, 0.1);
    padding: 8px;
    border-radius: 50%;
}

.properti-file-upload-modern .properti-file-label-modern .properti-file-info-modern {
    flex: 1;
    width: 100%;
}

.properti-file-upload-modern .properti-file-label-modern .properti-file-info-modern span {
    display: block;
    font-weight: 600;
    color: #2c2e3f;
    font-size: 0.8rem;
    word-break: break-word;
}

.properti-file-upload-modern .properti-file-label-modern .properti-file-info-modern small {
    color: #6c7383;
    font-size: 0.65rem;
    display: block;
    margin-top: 2px;
}

.properti-file-upload-modern .properti-file-label-modern .properti-file-size {
    font-size: 0.7rem;
    color: #9a55ff;
    font-weight: 600;
    background: rgba(154, 85, 255, 0.1);
    padding: 4px 10px;
    border-radius: 20px;
    white-space: nowrap;
    margin-top: 5px;
}

@media (min-width: 576px) {
    .properti-file-upload-modern .properti-file-label-modern .properti-file-size {
        margin-top: 0;
    }
}
</style>

<div class="container-fluid px-2 px-md-4 py-3">

    <!-- Page Title & Subtitle (Persis Catalog Unit & List Pengajuan) -->
    <div class="row align-items-center mb-4">
        <div class="col">
            <h2 class="text-dark mb-1 fw-bold" style="font-size: 1.55rem; letter-spacing: -0.02em;">
                Daftar User KPR
            </h2>
            <p class="text-muted mb-0" style="font-size: 0.88rem;">
                Kelola dan verifikasi berkas pengajuan KPR nasabah per unit dan status progres
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
                    <span style="font-size: 0.95rem; font-weight: 700; color: #0f172a;">Data User KPR</span>
                </div>

                <div class="card-body">
                    <!-- Filter Section -->
                    <div class="filter-card mb-3">
                        <form method="GET" action="{{ route('customer.kpr') }}" id="filterForm">
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
                                                <option value="booking" {{ request('status') == 'booking' ? 'selected' : '' }}>Booking</option>
                                                <option value="proses" {{ in_array(request('status'), ['proses', 'menunggu']) ? 'selected' : '' }}>Menunggu Verifikasi</option>
                                                <option value="revisi" {{ request('status') == 'revisi' ? 'selected' : '' }}>Perlu Revisi</option>
                                                <option value="survey" {{ request('status') == 'survey' ? 'selected' : '' }}>Survey</option>
                                                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
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
                                        <a href="{{ route('customer.kpr') }}"
                                            class="btn d-inline-flex align-items-center justify-content-center text-white"
                                            title="Reset" onclick="showResetLoading(event)"
                                            style="width: 38px; height: 38px; border-radius: 6px; background: #64748b !important; border: 1px solid #64748b !important;">
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
                                            <option value="booking" {{ request('status') == 'booking' ? 'selected' : '' }}>Booking</option>
                                            <option value="proses" {{ in_array(request('status'), ['proses', 'menunggu']) ? 'selected' : '' }}>Menunggu Verifikasi</option>
                                            <option value="revisi" {{ request('status') == 'revisi' ? 'selected' : '' }}>Perlu Revisi</option>
                                            <option value="survey" {{ request('status') == 'survey' ? 'selected' : '' }}>Survey</option>
                                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
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
                                        <a href="{{ route('customer.kpr') }}"
                                            class="btn text-white w-100 d-inline-flex align-items-center justify-content-center"
                                            title="Reset" onclick="showResetLoading(event)" style="height: 38px; border-radius: 6px; background: #64748b !important; border: 1px solid #64748b !important; text-decoration: none;">
                                            <i class="mdi mdi-refresh me-1"></i>Reset
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle table-unit mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 50px;">No</th>
                                    <th class="sortable {{ in_array(request('sort'), ['name_asc', 'name_desc']) ? 'active-sort' : '' }}" data-field="name" data-direction="{{ request('sort', 'latest') == 'name_asc' ? 'asc' : 'desc' }}">
                                        Customer
                                        <i class="mdi {{ request('sort') == 'name_asc' ? 'mdi-arrow-up' : (request('sort') == 'name_desc' ? 'mdi-arrow-down' : 'mdi-swap-vertical') }}"></i>
                                    </th>
                                    <th class="sortable {{ in_array(request('sort'), ['unit_asc', 'unit_desc']) ? 'active-sort' : '' }}" data-field="unit" data-direction="{{ request('sort', 'latest') == 'unit_asc' ? 'asc' : 'desc' }}">
                                        Nama - Unit
                                        <i class="mdi {{ request('sort') == 'unit_asc' ? 'mdi-arrow-up' : (request('sort') == 'unit_desc' ? 'mdi-arrow-down' : 'mdi-swap-vertical') }}"></i>
                                    </th>
                                    <th>Jenis & Tipe</th>
                                    <th>Harga</th>
                                    <th>Sales / Agent</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Tanggal Booking</th>
                                    <th class="text-center" style="min-width: 130px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bookings ?? [] as $booking)
                                    @php
                                        $uploadedDocs = $booking->kprApplication?->documents ?? collect();
                                        $totalUploaded = $uploadedDocs->count();
                                        $approvedDocsCount = $uploadedDocs->where('status', 'disetujui')->count();
                                        $revisiDocsCount   = $uploadedDocs->where('status', 'revisi')->count();
                                        $rejectedDocsCount = $uploadedDocs->where('status', 'ditolak')->count();
                                        $pendingDocsCount  = $uploadedDocs->where('status', 'pending')->count();

                                        $requiredTypes = [
                                            'ktp', 'kk', 'slip_gaji', 'rekening_koran',
                                            'npwp', 'sku', 'surat_nikah', 'ktp_pasangan'
                                        ];

                                        $uploadedStandardCount = $uploadedDocs->whereIn('type', $requiredTypes)->count();

                                        $customerName = $booking->customer->full_name ?? '-';
                                        $kprStatus = strtolower($booking->kprApplication?->status ?? '');
                                    @endphp
                                    <tr>
                                        <td class="text-center fw-bold text-muted" style="font-size: 0.82rem;">
                                            {{ $loop->iteration + (($bookings->currentPage() - 1) * $bookings->perPage()) }}
                                        </td>
                                        <td>
                                            <span class="fw-bold text-dark" style="font-size: 0.88rem;">
                                                {{ $customerName }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-1.5">
                                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">{{ $booking->unit->unit_name ?? '-' }}</span>
                                                <span class="badge bg-light text-dark border fw-bold px-1.5 py-0.5" style="font-size: 0.72rem; border-radius: 4px;">{{ $booking->unit->unit_code ?? '-' }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            @php
                                                $jenis = $booking->unit->jenis ?? '';
                                                $tipe = $booking->unit->type ?? '-';
                                            @endphp
                                            @if (strtolower($jenis) == 'subsidi')
                                                <span class="badge" style="background-color: #ecfdf5; color: #059669; border: 1px solid #a7f3d0; border-radius: 6px; font-weight: 600; font-size: 0.75rem;">
                                                    <i class="mdi mdi-home-assistant me-1"></i>{{ $jenis }} - {{ $tipe }}
                                                </span>
                                            @elseif(strtolower($jenis) == 'komersil')
                                                <span class="badge" style="background-color: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe; border-radius: 6px; font-weight: 600; font-size: 0.75rem;">
                                                    <i class="mdi mdi-office-building me-1"></i>{{ $jenis }} - {{ $tipe }}
                                                </span>
                                            @else
                                                <span class="badge" style="background-color: #f8fafc; color: #475569; border: 1px solid #e2e8f0; border-radius: 6px; font-weight: 600; font-size: 0.75rem;">
                                                    <i class="mdi mdi-help-circle-outline me-1"></i>{{ ($jenis ?: '-') . ' - ' . $tipe }}
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="fw-bold text-dark" style="font-family: monospace; font-size: 0.88rem;">
                                                Rp {{ number_format($booking->unit->price ?? 0, 0, ',', '.') }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($booking->sales)
                                                <span class="fw-semibold text-dark" style="font-size: 0.85rem;">
                                                    {{ $booking->sales->name }}
                                                </span>
                                            @else
                                                <span class="text-muted" style="font-size: 0.85rem;">-</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($kprStatus === 'approved')
                                                <span class="badge-clean status-approved">
                                                    <i class="mdi mdi-check-decagram"></i> Approved
                                                </span>
                                            @elseif ($kprStatus === 'survey')
                                                <span class="badge-clean status-survey">
                                                    <i class="mdi mdi-account-search"></i> Survey
                                                </span>
                                            @elseif ($kprStatus === 'rejected')
                                                <span class="badge-clean status-rejected">
                                                    <i class="mdi mdi-close-octagon"></i> Ditolak
                                                </span>
                                            @elseif ($revisiDocsCount > 0)
                                                <span class="badge-clean status-revisi">
                                                    <i class="mdi mdi-alert-circle"></i> Perlu Revisi ({{ $revisiDocsCount }})
                                                </span>
                                            @elseif ($rejectedDocsCount > 0)
                                                <span class="badge-clean status-rejected">
                                                    <i class="mdi mdi-close-circle"></i> Dokumen Ditolak
                                                </span>
                                            @elseif ($totalUploaded > 0 && $approvedDocsCount === $totalUploaded)
                                                <span class="badge-clean status-approved">
                                                    <i class="mdi mdi-check-circle"></i> Dokumen Disetujui
                                                </span>
                                            @elseif ($booking->kprApplication)
                                                <span class="badge-clean status-menunggu">
                                                    <i class="mdi mdi-clock-outline"></i> Menunggu Verifikasi
                                                </span>
                                            @else
                                                <span class="badge-clean status-booking">
                                                    Belum Pengajuan
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <span class="text-dark d-inline-flex align-items-center" style="font-size: 0.84rem;">
                                                <i class="mdi mdi-calendar-blank-outline text-muted me-1"></i>
                                                {{ \Carbon\Carbon::parse($booking->created_at)->format('d M Y') }}
                                            </span>
                                        </td>

                                        <td class="text-center">
                                            <div class="d-flex justify-content-center align-items-center">
                                                @php
                                                    $currentUser = auth()->user();
                                                    $posName = strtolower($currentUser->position->name ?? '');
                                                    $isKepalaMarketing = str_contains($posName, 'kepala') || ($currentUser->position_id ?? null) == 1 || str_contains($posName, 'admin') || str_contains($posName, 'direktur');

                                                    $isAlreadyApproved = in_array(strtolower($booking->status ?? ''), ['completed', 'sold', 'lunas', 'akad_selesai'])
                                                        || ($booking->kprApplication && in_array(strtolower($booking->kprApplication->status ?? ''), ['approved', 'survey', 'akad', 'completed', 'lunas', 'analisa']));
                                                @endphp

                                                @if($isAlreadyApproved)
                                                    <a href="{{ route('transaksi.kpr.approve', $booking->id) }}" 
                                                       class="btn btn-sm d-inline-flex align-items-center justify-content-center gap-1 px-3 text-white fw-semibold" 
                                                       style="height: 32px; border-radius: 6px; background-color: #059669; border: 1px solid #059669;"
                                                       title="Detail Selesai">
                                                        <i class="mdi mdi-check-all"></i>
                                                        <span>Selesai</span>
                                                    </a>
                                                @elseif($isKepalaMarketing)
                                                    <a href="{{ route('transaksi.kpr.approve', $booking->id) }}"
                                                       class="btn btn-sm d-inline-flex align-items-center justify-content-center gap-1 px-3 text-white fw-semibold btnApproveKpr"
                                                       style="height: 32px; border-radius: 6px; background-color: #10b981; border: 1px solid #10b981;"
                                                       title="Verifikasi Dokumen & Pengajuan KPR">
                                                        <i class="mdi mdi-clipboard-check-outline"></i>
                                                        <span>Verifikasi</span>
                                                    </a>
                                                @else
                                                    {{-- Staff Marketing Role --}}
                                                    @if($revisiDocsCount > 0 || $rejectedDocsCount > 0)
                                                        <a href="{{ route('transaksi.kpr.approve', $booking->id) }}"
                                                           class="btn btn-sm d-inline-flex align-items-center justify-content-center gap-1 px-3 text-white fw-semibold"
                                                           style="height: 32px; border-radius: 6px; background-color: #f59e0b; border: 1px solid #f59e0b;"
                                                           title="Perbaiki Dokumen">
                                                            <i class="mdi mdi-pencil-box-multiple"></i>
                                                            <span>Perbaiki ({{ $revisiDocsCount + $rejectedDocsCount }})</span>
                                                        </a>
                                                    @else
                                                        <a href="{{ route('transaksi.kpr.approve', $booking->id) }}"
                                                           class="btn btn-sm d-inline-flex align-items-center justify-content-center gap-1 px-3 fw-semibold"
                                                           style="height: 32px; border-radius: 6px; background-color: #f3e8ff; color: #9a55ff; border: 1px solid #d8b4fe;"
                                                           title="Lihat Progress & Detail Validasi KPR">
                                                            <i class="mdi mdi-eye-outline"></i>
                                                            <span>Lihat</span>
                                                        </a>
                                                    @endif
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted py-4">
                                            <i class="mdi mdi-account-off-outline me-1" style="font-size: 1.25rem;"></i>
                                            Tidak ada data user KPR
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if(($bookings->count() ?? 0) > 0)
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                            <div class="pagination-info mb-2 mb-sm-0">
                                Menampilkan {{ $bookings->firstItem() }} - {{ $bookings->lastItem() }} dari {{ $bookings->total() }} data
                            </div>
                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                    @if ($bookings->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link"><i class="mdi mdi-chevron-left"></i></span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $bookings->previousPageUrl() }}" onclick="showPaginationLoading(event)"><i class="mdi mdi-chevron-left"></i></a>
                                        </li>
                                    @endif

                                    @foreach ($bookings->getUrlRange(1, $bookings->lastPage()) as $page => $url)
                                        <li class="page-item {{ $bookings->currentPage() == $page ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}" onclick="showPaginationLoading(event)">{{ $page }}</a>
                                        </li>
                                    @endforeach

                                    @if ($bookings->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $bookings->nextPageUrl() }}" onclick="showPaginationLoading(event)"><i class="mdi mdi-chevron-right"></i></a>
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
<script>
$(document).ready(function() {
    // Inisialisasi Select2
    $('#statusSelect').select2({
        theme: 'bootstrap-5',
        placeholder: 'Semua Status',
        allowClear: true,
        width: '100%',
        minimumResultsForSearch: Infinity
    });

    $('#perPageSelect').select2({
        theme: 'bootstrap-5',
        placeholder: '10',
        allowClear: false,
        width: '100%',
        minimumResultsForSearch: Infinity
    });

    $('#statusSelectMobile').select2({
        theme: 'bootstrap-5',
        placeholder: 'Semua Status',
        allowClear: true,
        width: '100%',
        minimumResultsForSearch: Infinity
    });

    $('#perPageSelectMobile').select2({
        theme: 'bootstrap-5',
        placeholder: '10',
        allowClear: false,
        width: '100%',
        minimumResultsForSearch: Infinity
    });

    // Search input sync between desktop and mobile
    $('input[name="search"]').on('input', function() {
        $('#searchMobile').val($(this).val());
    });
    $('#searchMobile').on('input', function() {
        $('input[name="search"]').val($(this).val());
    });

    $('.sortable').click(function() {
        let field = $(this).data('field');
        let direction = $(this).data('direction');

        Swal.fire({
            title: 'Memuat...',
            html: 'Sedang mengurutkan data',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        let url = new URL(window.location.href);
        url.searchParams.set('sort', field + '_' + direction);
        url.searchParams.set('page', 1);

        window.location.href = url.toString();
    });

    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            timer: 2000,
            showConfirmButton: false
        });
    @endif

    @if (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: "{{ session('error') }}",
            timer: 2000,
            showConfirmButton: false
        });
    @endif
});

function showPaginationLoading(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Memuat...',
        html: 'Sedang memuat halaman',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    window.location.href = event.currentTarget.href;
}

function showFilterLoading() {
    Swal.fire({
        title: 'Memuat...',
        html: 'Sedang memfilter data',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
}

function showResetLoading(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Memuat...',
        html: 'Sedang mereset filter',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    window.location.href = event.currentTarget.href;
}
</script>
@endpush
