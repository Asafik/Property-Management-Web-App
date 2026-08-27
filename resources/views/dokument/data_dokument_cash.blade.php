@extends('layouts.partial.app')

@section('title', 'Data User Persiapan Pecah Legal - Property Management App')

@section('content')

<style>
/* =========================================================
   DATA DOKUMEN CASH / LEGAL PECAH MODAL STYLES
   ========================================================= */

/* Modal Content & Header */
.modal-content {
    border: none;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 12px 36px rgba(0, 0, 0, 0.12);
}

.modal-header {
    background: #ffffff;
    padding: 1.1rem 1.5rem;
    border-bottom: 1px solid #f1f5f9;
}

.modal-header .modal-title {
    font-size: 1.05rem;
    font-weight: 700;
    color: #1e293b;
}

/* Modal Summary Cards */
.modal-summary-box {
    background: linear-gradient(135deg, #faf7ff, #f4efff);
    border: 1.5px solid #eadcff;
    border-radius: 12px;
    padding: 0.75rem 1rem;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.modal-summary-box .summary-label {
    font-size: 0.72rem;
    color: #8b8fa3;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 2px;
}

.modal-summary-box .summary-value {
    font-size: 0.92rem;
    font-weight: 800;
    color: #2c2e3f;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* Modal Table Styling */
.modal-doc-table thead th {
    background: linear-gradient(135deg, #f8f9fa, #f1f3f5) !important;
    color: #475569 !important;
    font-weight: 700;
    font-size: 0.78rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 2px solid #e2e8f0;
    padding: 0.75rem 0.85rem;
    white-space: nowrap;
}

.modal-doc-table tbody td {
    vertical-align: middle;
    padding: 0.75rem 0.85rem;
    border-bottom: 1px solid #f1f5f9;
}

.modal-doc-table tbody tr:hover {
    background-color: #fbf9ff;
}

/* Doc Item & Icon */
.doc-icon-box {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    background: linear-gradient(135deg, #f4ecff, #ede1ff);
    color: #9a55ff;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 1.15rem;
    flex-shrink: 0;
}

.badge-doc-req {
    font-size: 0.7rem;
    font-weight: 700;
    padding: 0.15rem 0.45rem;
    border-radius: 4px;
    display: inline-flex;
    align-items: center;
    gap: 2px;
}

.badge-doc-req.wajib {
    background: #fef2f2;
    color: #dc2626;
    border: 1px solid #fecaca;
}

.badge-doc-req.opsional {
    background: #f8fafc;
    color: #64748b;
    border: 1px solid #e2e8f0;
}

/* Status Badges */
.badge-doc-status {
    padding: 0.35rem 0.65rem;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    white-space: nowrap;
}

.badge-doc-status.uploaded {
    background: #eefcf3;
    color: #15803d;
    border: 1px solid #bbf7d0;
}

.badge-doc-status.missing {
    background: #fffbeb;
    color: #b45309;
    border: 1px solid #fde68a;
}

.badge-doc-status.optional {
    background: #f8fafc;
    color: #64748b;
    border: 1px solid #e2e8f0;
}

/* Upload Inline Widget */
.upload-inline-form {
    display: inline-flex;
    align-items: center;
    justify-content: flex-end;
    gap: 0.4rem;
    margin: 0;
    width: 100%;
}

.upload-file-btn-wrapper {
    position: relative;
    max-width: 220px;
    flex: 1;
}

.upload-file-btn-wrapper input[type="file"] {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
    z-index: 2;
}

.doc-file-label {
    display: flex;
    align-items: center;
    gap: 0.4rem;
    padding: 0.38rem 0.75rem;
    background: #ffffff;
    border: 1.5px dashed #cbd5e1;
    border-radius: 8px;
    font-size: 0.78rem;
    font-weight: 600;
    color: #64748b;
    cursor: pointer;
    transition: all 0.2s ease;
    margin: 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.upload-file-btn-wrapper:hover .doc-file-label {
    border-color: #9a55ff;
    background: #fbf9ff;
    color: #9a55ff;
}

.doc-file-label i {
    font-size: 1rem;
    color: #9a55ff;
}

.btn-upload-submit {
    background: linear-gradient(135deg, #da8cff, #9a55ff);
    color: #ffffff;
    border: none;
    padding: 0.4rem 0.85rem;
    border-radius: 8px;
    font-size: 0.78rem;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    transition: all 0.2s ease;
    box-shadow: 0 2px 6px rgba(154, 85, 255, 0.25);
    white-space: nowrap;
    cursor: pointer;
}

.btn-upload-submit:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(154, 85, 255, 0.35);
    color: #ffffff;
}

.btn-doc-view {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    padding: 0.38rem 0.85rem;
    background: #f4ecff;
    color: #9a55ff;
    border: 1px solid #e9d5ff;
    border-radius: 8px;
    font-size: 0.8rem;
    font-weight: 700;
    text-decoration: none !important;
    transition: all 0.2s ease;
}

.btn-doc-view:hover {
    background: #9a55ff;
    color: #ffffff;
    border-color: #9a55ff;
    transform: translateY(-1px);
}
</style>

<div class="container-fluid px-1 px-sm-2 px-md-3 py-2 py-md-3">

    <!-- Header Card Banner -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 header-card">
                <div class="card-body p-4 p-md-4 py-4 py-md-4 d-flex justify-content-between align-items-center" style="min-height: 105px;">
                    <div>
                        <h3 class="text-dark mb-1 fw-bold" style="font-size: 1.35rem;">
                            Data User Persiapan Pecah Legal
                        </h3>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">
                            Pengecekan kelengkapan dokumen legal persiapan pecah unit per booking
                        </p>
                    </div>
                    <div class="d-none d-sm-block pe-2">
                        <i class="mdi mdi-file-document-check-outline" style="font-size: 3rem; color: #9a55ff; opacity: 0.25;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistic Cards (Sesuai Desain Dashboard) -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card shadow-sm border-0 h-100 mb-0">
                <div class="card-body d-flex justify-content-between align-items-center p-3">
                    <div>
                        <h3 class="text-dark mb-1 fw-bold">{{ $totalBooking }}</h3>
                        <p class="text-muted mb-0">Total Booking</p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-bookmark-multiple-outline" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card shadow-sm border-0 h-100 mb-0">
                <div class="card-body d-flex justify-content-between align-items-center p-3">
                    <div>
                        <h3 class="text-dark mb-1 fw-bold">{{ $lengkap }}</h3>
                        <p class="text-muted mb-0">Dokumen Lengkap</p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-check-circle-outline" style="font-size: 2.5rem; color: #28a745; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card shadow-sm border-0 h-100 mb-0">
                <div class="card-body d-flex justify-content-between align-items-center p-3">
                    <div>
                        <h3 class="text-dark mb-1 fw-bold">{{ $kurang }}</h3>
                        <p class="text-muted mb-0">Dokumen Kurang</p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-alert-circle-outline" style="font-size: 2.5rem; color: #ffc107; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card shadow-sm border-0 h-100 mb-0">
                <div class="card-body d-flex justify-content-between align-items-center p-3">
                    <div>
                        <h3 class="text-dark mb-1 fw-bold">{{ $revisi }}</h3>
                        <p class="text-muted mb-0">Perlu Revisi</p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-file-refresh-outline" style="font-size: 2.5rem; color: #dc3545; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table & Filter Card -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex justify-content-between align-items-center gap-2 flex-wrap">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-format-list-bulleted me-2"></i>Daftar Pengecekan Dokumen
                    </h5>
                </div>

                <div class="card-body">
                    <!-- Filter Section -->
                    <div class="filter-card mb-3">
                        <!-- Desktop Version -->
                        <div class="filter-row-desktop d-none d-md-block">
                            <form id="filterForm" method="GET" action="{{ route(Route::currentRouteName()) }}" onsubmit="return showFilterLoading()">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                    <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                        <!-- Search -->
                                        <div style="min-width: 200px; max-width: 260px; flex: 1;">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="search" id="searchInput"
                                                    placeholder="Cari Customer / ID..."
                                                    value="{{ request('search') }}"
                                                    style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                                <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                    type="submit" title="Cari"
                                                    style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                    <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Kelengkapan -->
                                        <div style="width: 155px;">
                                            <select class="form-control" name="kelengkapan" id="kelengkapanSelect">
                                                <option value="">Semua Dokumen</option>
                                                <option value="lengkap" {{ request('kelengkapan') == 'lengkap' ? 'selected' : '' }}>Lengkap</option>
                                                <option value="belum_lengkap" {{ request('kelengkapan') == 'belum_lengkap' ? 'selected' : '' }}>Belum Lengkap</option>
                                            </select>
                                        </div>

                                        <!-- Status -->
                                        <div style="width: 165px;">
                                            <select class="form-control" name="status" id="statusSelect">
                                                <option value="">Semua Status</option>
                                                <option value="siap_pecah" {{ request('status') == 'siap_pecah' ? 'selected' : '' }}>Siap Pecah Legal</option>
                                                <option value="revisi" {{ request('status') == 'revisi' ? 'selected' : '' }}>Perlu Revisi</option>
                                            </select>
                                        </div>

                                        <!-- Jenis -->
                                        <div style="width: 140px;">
                                            <select class="form-control" name="jenis" id="jenisSelect">
                                                <option value="">Semua Jenis</option>
                                                <option value="komersil" {{ request('jenis') == 'komersil' ? 'selected' : '' }}>Komersil</option>
                                                <option value="subsidi" {{ request('jenis') == 'subsidi' ? 'selected' : '' }}>Subsidi</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Right Limit & Action Buttons -->
                                    <div class="d-flex align-items-center gap-2 ms-auto">
                                        <div style="width: 110px;">
                                            <select class="form-control" name="per_page" id="perPageSelect">
                                                <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 data</option>
                                                <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15 data</option>
                                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 data</option>
                                                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 data</option>
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-gradient-primary btn-icon-only" title="Filter">
                                            <i class="mdi mdi-filter"></i>
                                        </button>
                                        <a href="{{ request()->url() }}" class="btn btn-gradient-secondary btn-icon-only" title="Reset" onclick="showResetLoading(event)">
                                            <i class="mdi mdi-refresh"></i>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Mobile Version -->
                        <div class="filter-row-mobile d-block d-md-none">
                            <form method="GET" action="{{ route(Route::currentRouteName()) }}" onsubmit="return showFilterLoading()">
                                <div class="row g-2">
                                    <div class="col-12 mb-2">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" id="searchInputMobile"
                                                placeholder="Cari Customer / ID..."
                                                value="{{ request('search') }}"
                                                style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                            <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                type="submit" title="Cari"
                                                style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <select class="form-control" name="kelengkapan">
                                            <option value="">Semua Dokumen</option>
                                            <option value="lengkap" {{ request('kelengkapan') == 'lengkap' ? 'selected' : '' }}>Lengkap</option>
                                            <option value="belum_lengkap" {{ request('kelengkapan') == 'belum_lengkap' ? 'selected' : '' }}>Belum Lengkap</option>
                                        </select>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <select class="form-control" name="status">
                                            <option value="">Semua Status</option>
                                            <option value="siap_pecah" {{ request('status') == 'siap_pecah' ? 'selected' : '' }}>Siap Pecah Legal</option>
                                            <option value="revisi" {{ request('status') == 'revisi' ? 'selected' : '' }}>Perlu Revisi</option>
                                        </select>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <select class="form-control" name="jenis">
                                            <option value="">Semua Jenis</option>
                                            <option value="komersil" {{ request('jenis') == 'komersil' ? 'selected' : '' }}>Komersil</option>
                                            <option value="subsidi" {{ request('jenis') == 'subsidi' ? 'selected' : '' }}>Subsidi</option>
                                        </select>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <select class="form-control" name="per_page">
                                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 data</option>
                                            <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15 data</option>
                                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 data</option>
                                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 data</option>
                                        </select>
                                    </div>

                                    <div class="col-6">
                                        <button type="submit" class="btn btn-gradient-primary w-100 d-flex align-items-center justify-content-center gap-1">
                                            <i class="mdi mdi-filter"></i> Filter
                                        </button>
                                    </div>

                                    <div class="col-6">
                                        <a href="{{ request()->url() }}" class="btn btn-gradient-secondary w-100 d-flex align-items-center justify-content-center gap-1" onclick="showResetLoading(event)">
                                            <i class="mdi mdi-refresh"></i> Reset
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Data Table -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="sortable" data-field="booking_code" data-direction="{{ request('sortField') == 'booking_code' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        ID Booking
                                        @if (request('sortField') == 'booking_code')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable" data-field="name" data-direction="{{ request('sortField') == 'name' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Nama Customer
                                        @if (request('sortField') == 'name')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable" data-field="unit" data-direction="{{ request('sortField') == 'unit' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Unit Properti
                                        @if (request('sortField') == 'unit')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th>Jenis - Tipe</th>
                                    <th>Kelengkapan</th>
                                    <th>Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($bookings as $booking)
                                    @php
                                        $requiredDocs = $documents->where('required', true)->count();
                                        $uploadedDocs = $booking->documentUploads
                                            ->whereIn('document_id', $documents->where('required', true)->pluck('id'))
                                            ->count();

                                        $isLengkap = $uploadedDocs >= $requiredDocs && $requiredDocs > 0;

                                        $customerName = $booking->customer->full_name ?? '-';
                                        $nameParts = explode(' ', trim($customerName));
                                        $initials = strtoupper(substr($nameParts[0] ?? '', 0, 1) . substr($nameParts[1] ?? '', 0, 1));
                                        if (trim($initials) == '') {
                                            $initials = 'CU';
                                        }

                                        $jenisUnit = strtolower(trim($booking->unit->jenis ?? ''));
                                        $modalId = 'detailDokumenModal' . $booking->id;
                                    @endphp
                                    <tr>
                                        <td class="text-center fw-bold">
                                            {{ method_exists($bookings, 'firstItem') ? $bookings->firstItem() + $loop->index : $loop->iteration }}
                                        </td>
                                        <td>
                                            <div class="info-inline">
                                                <span class="info-icon">
                                                    <i class="mdi mdi-bookmark-outline"></i>
                                                </span>
                                                <span class="fw-bold text-primary">{{ $booking->booking_code }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="info-inline">
                                                <span class="initial-avatar">{{ $initials }}</span>
                                                <span class="fw-bold">{{ $customerName }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="info-inline align-items-start">
                                                <span class="info-icon mt-1">
                                                    <i class="mdi mdi-home-city-outline"></i>
                                                </span>
                                                <div>
                                                    <span class="fw-bold d-block">{{ $booking->unit->unit_name ?? '-' }}</span>
                                                    <small class="text-muted">{{ $booking->unit->block ?? '' }} {{ $booking->unit->unit_number ?? '' }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge-category">
                                                <i class="mdi mdi-shape-outline"></i>
                                                {{ ucfirst($booking->unit->jenis ?? 'Unit') }} - {{ $booking->unit->type ?? '-' }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($isLengkap)
                                                <span class="badge-status available">
                                                    <i class="mdi mdi-check-circle me-1"></i>Lengkap
                                                </span>
                                            @else
                                                <span class="badge-status booking">
                                                    <i class="mdi mdi-alert-circle-outline me-1"></i>{{ $uploadedDocs }}/{{ $requiredDocs }} Kurang
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($isLengkap)
                                                <span class="badge-status available">
                                                    <i class="mdi mdi-check-decagram-outline me-1"></i>Siap Pecah Legal
                                                </span>
                                            @else
                                                <span class="badge bg-light text-muted fw-semibold px-2 py-1 border" style="font-size: 0.78rem;">
                                                    <i class="mdi mdi-timer-sand me-1"></i>Pending
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="d-inline-flex align-items-center gap-1">
                                                <!-- Detail View Modal Button -->
                                                <button type="button" class="btn-action fase2"
                                                    title="Lihat Detail Dokumen" data-bs-toggle="modal"
                                                    data-bs-target="#{{ $modalId }}">
                                                    <i class="mdi mdi-eye-outline"></i>
                                                </button>

                                                @if ($isLengkap)
                                                    @if (strtolower($booking->purchase_type) == 'kpr')
                                                        <a href="{{ route('kpr.approve', $booking->id) }}"
                                                            class="btn-action edit"
                                                            title="Proses Persetujuan KPR">
                                                            <i class="mdi mdi-clipboard-check"></i>
                                                        </a>
                                                    @elseif(in_array(strtolower($booking->purchase_type), ['cash', 'cash_tempo']))
                                                        <a href="{{ route('akad.cash', $booking->id) }}"
                                                            class="btn-action fase1" title="Proses Akad Cash">
                                                            <i class="mdi mdi-file-sign"></i>
                                                        </a>
                                                    @endif
                                                @else
                                                    <button class="btn-action" disabled style="opacity: 0.4; cursor: not-allowed; background: #e9ecef; color: #6c7383;"
                                                        title="Dokumen belum lengkap">
                                                        <i class="mdi mdi-file-sign"></i>
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-4">
                                            <i class="mdi mdi-information-outline me-2"></i>Tidak ada data booking ditemukan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if ($bookings instanceof \Illuminate\Pagination\LengthAwarePaginator && $bookings->total() > 0)
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                            <div class="pagination-info mb-2 mb-sm-0 text-muted" style="font-size: 0.82rem;">
                                Menampilkan {{ $bookings->firstItem() }} - {{ $bookings->lastItem() }} dari {{ $bookings->total() }} data
                            </div>
                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                    <li class="page-item {{ $bookings->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $bookings->previousPageUrl() }}" {{ !$bookings->onFirstPage() ? 'onclick=showPaginationLoading(event)' : '' }}>
                                            <i class="mdi mdi-chevron-left"></i>
                                        </a>
                                    </li>

                                    @for($page = 1; $page <= $bookings->lastPage(); $page++)
                                        <li class="page-item {{ $page == $bookings->currentPage() ? 'active' : '' }}">
                                            @if($page == $bookings->currentPage())
                                                <span class="page-link">{{ $page }}</span>
                                            @else
                                                <a class="page-link" href="{{ $bookings->appends(request()->query())->url($page) }}" onclick="showPaginationLoading(event)">{{ $page }}</a>
                                            @endif
                                        </li>
                                    @endfor

                                    <li class="page-item {{ $bookings->hasMorePages() ? '' : 'disabled' }}">
                                        <a class="page-link" href="{{ $bookings->nextPageUrl() }}" {{ $bookings->hasMorePages() ? 'onclick=showPaginationLoading(event)' : '' }}>
                                            <i class="mdi mdi-chevron-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modal Detail Dokumen Per Booking -->
@foreach ($bookings as $booking)
    @php
        $requiredDocs = $documents->where('required', true)->count();
        $uploadedDocs = $booking->documentUploads
            ->whereIn('document_id', $documents->where('required', true)->pluck('id'))
            ->count();

        $isLengkap = $uploadedDocs >= $requiredDocs && $requiredDocs > 0;
        $customerName = $booking->customer->full_name ?? '-';
        $unitName = $booking->unit->unit_name ?? '-';
        $modalId = 'detailDokumenModal' . $booking->id;
        $statusText = $isLengkap ? 'Siap Pecah Legal Unit' : 'Pending';
    @endphp

    <div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-white border-bottom">
                    <h5 class="modal-title fw-bold" style="color: #1e293b;">
                        <i class="mdi mdi-file-document-outline me-2" style="color: #9a55ff;"></i>Detail Dokumen Booking
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-3 p-md-4">
                    <!-- Detail Summary Box -->
                    <div class="row g-2 mb-3">
                        <div class="col-6 col-md-3">
                            <div class="modal-summary-box">
                                <span class="summary-label">ID Booking</span>
                                <span class="summary-value text-primary">{{ $booking->booking_code }}</span>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="modal-summary-box">
                                <span class="summary-label">Nama Customer</span>
                                <span class="summary-value">{{ $customerName }}</span>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="modal-summary-box">
                                <span class="summary-label">Unit Properti</span>
                                <span class="summary-value">{{ $unitName }}</span>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="modal-summary-box">
                                <span class="summary-label">Status Legal</span>
                                <span class="summary-value {{ $isLengkap ? 'text-success' : 'text-warning' }}">
                                    <i class="mdi {{ $isLengkap ? 'mdi-check-circle' : 'mdi-clock-outline' }} me-1"></i>{{ $statusText }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Document Table -->
                    <div class="card shadow-sm border-0 mb-0">
                        <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center py-2 px-3">
                            <h6 class="mb-0 fw-bold" style="color: #9a55ff; font-size: 0.9rem;">
                                <i class="mdi mdi-clipboard-text-outline me-2"></i>Daftar Dokumen Persyaratan
                            </h6>
                            <span class="badge bg-light text-dark fw-bold border">
                                {{ $uploadedDocs }} / {{ $requiredDocs }} Wajib Terunggah
                            </span>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0 modal-doc-table">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 50px;">No</th>
                                            <th>Nama Dokumen</th>
                                            <th class="text-center" style="width: 120px;">Status</th>
                                            <th class="text-end" style="width: 320px;">Aksi Upload / File</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $bookingUploads = $booking->documentUploads->keyBy('document_id');
                                        @endphp

                                        @forelse ($documents as $doc)
                                            @php
                                                $uploadedFile = $bookingUploads->get($doc->id);
                                                $hasFile = $uploadedFile && !empty($uploadedFile->file_path);
                                            @endphp
                                            <tr>
                                                <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="doc-icon-box">
                                                            <i class="mdi mdi-file-document-outline"></i>
                                                        </span>
                                                        <div>
                                                            <span class="fw-bold d-block text-dark" style="font-size: 0.88rem;">{{ $doc->name }}</span>
                                                            @if($doc->required)
                                                                <span class="badge-doc-req wajib"><i class="mdi mdi-asterisk" style="font-size: 0.6rem;"></i> Wajib</span>
                                                            @else
                                                                <span class="badge-doc-req opsional">Opsional</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    @if ($hasFile)
                                                        <span class="badge-doc-status uploaded">
                                                            <i class="mdi mdi-check-circle me-1"></i>Tersedia
                                                        </span>
                                                    @elseif ($doc->required)
                                                        <span class="badge-doc-status missing">
                                                            <i class="mdi mdi-alert-circle-outline me-1"></i>Belum Ada
                                                        </span>
                                                    @else
                                                        <span class="badge-doc-status optional">
                                                            <i class="mdi mdi-minus-circle-outline me-1"></i>Opsional
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="text-end">
                                                    @if ($hasFile)
                                                        <div class="d-inline-flex align-items-center justify-content-end gap-2">
                                                            <a href="{{ asset('storage/' . $uploadedFile->file_path) }}"
                                                                target="_blank" class="btn-doc-view">
                                                                <i class="mdi mdi-eye-outline"></i>Lihat Dokumen
                                                            </a>
                                                        </div>
                                                    @else
                                                        <form action="{{ route('document.upload') }}" 
                                                            method="POST" 
                                                            enctype="multipart/form-data"
                                                            class="upload-inline-form">
                                                            @csrf
                                                            <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                                                            <input type="hidden" name="document_id" value="{{ $doc->id }}">

                                                            <div class="upload-file-btn-wrapper">
                                                                <input type="file" name="file" accept=".pdf,.jpg,.jpeg,.png" required class="doc-file-input" id="file_{{ $booking->id }}_{{ $doc->id }}">
                                                                <label for="file_{{ $booking->id }}_{{ $doc->id }}" class="doc-file-label">
                                                                    <i class="mdi mdi-paperclip"></i>
                                                                    <span class="file-chosen-text">Pilih File...</span>
                                                                </label>
                                                            </div>

                                                            <button type="submit" class="btn-upload-submit">
                                                                <i class="mdi mdi-upload"></i>Upload
                                                            </button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center text-muted py-4">
                                                    Belum ada dokumen yang bisa ditampilkan
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light border-top py-2 px-3">
                    <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
@endforeach

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Modern file upload preview
    document.querySelectorAll('.doc-file-input').forEach(input => {
        input.addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name;
            const labelSpan = this.closest('.upload-file-btn-wrapper').querySelector('.file-chosen-text');
            if (fileName && labelSpan) {
                labelSpan.textContent = fileName.length > 18 ? fileName.substring(0, 18) + '...' : fileName;
                labelSpan.style.color = '#9a55ff';
                labelSpan.style.fontWeight = '700';
            }
        });
    });
});

$(document).ready(function() {
    // Sorting functionality
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
        url.searchParams.set('sortField', field);
        url.searchParams.set('sortDirection', direction);
        url.searchParams.set('page', 1);

        window.location.href = url.toString();
    });

    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'OK',
            confirmButtonColor: '#9a55ff',
            timerProgressBar: true
        });
    @endif

    @if (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}',
            confirmButtonColor: '#dc3545'
        });
    @endif
});

function showFilterLoading() {
    Swal.fire({
        title: 'Memuat...',
        html: 'Sedang memfilter data',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    return true;
}

function showResetLoading(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Memuat...',
        html: 'Mengembalikan data awal',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    window.location.href = event.currentTarget.href;
}

function showPaginationLoading(event) {
    if (event.currentTarget.parentElement.classList.contains('disabled')) return;
    event.preventDefault();
    Swal.fire({
        title: 'Memuat...',
        html: 'Berpindah halaman',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    window.location.href = event.currentTarget.href;
}
</script>
@endpush
