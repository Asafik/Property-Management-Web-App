@extends('layouts.partial.app')

@section('title', 'Timeline Pembayaran Cash Tempo - Property Management App')

@section('content')

<style>
/* =========================================================
   TIMELINE PEMBAYARAN CASH TEMPO STYLES
   ========================================================= */

.card {
    border-radius: 14px !important;
    border: none !important;
    box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04);
    background: #ffffff;
    transition: all 0.3s ease;
    margin-bottom: 1.5rem;
}

.card:hover {
    box-shadow: 0 8px 25px rgba(154, 85, 255, 0.08) !important;
}

.header-card {
    background: #ffffff;
    border-radius: 14px !important;
    border: none !important;
    box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04);
}

.card-title {
    font-size: 1.05rem;
    font-weight: 700;
    color: #2c2e3f;
    margin-bottom: 0;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.card-title i {
    color: #9a55ff;
    font-size: 1.25rem;
}

/* FILTER CARD (STANDAR CICILAN / KPR) */
.filter-card {
    background: linear-gradient(135deg, #faf7ff, #f3ebff);
    border-radius: 12px;
    padding: 1rem;
    margin-bottom: 1.25rem;
    border: 1px solid #ede4ff;
}

.search-input-group {
    border-radius: 8px;
    overflow: hidden;
}

.search-input-group .form-control {
    border-right: none;
    border-radius: 8px 0 0 8px !important;
    border: 1px solid #e9ecef;
    font-size: 0.9rem;
    height: 40px;
}

.search-input-group .btn-search-submit {
    border-radius: 0 8px 8px 0 !important;
    padding: 0 14px;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* SELECT2 BOOTSTRAP-5 STYLING */
.select2-container--bootstrap-5 .select2-selection {
    border: 1px solid #e9ecef !important;
    border-radius: 8px !important;
    padding: 0.4rem 0.8rem !important;
    min-height: 40px !important;
    height: 40px !important;
    font-family: 'Nunito', sans-serif !important;
    background-color: #ffffff !important;
}

.select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
    color: #2c2e3f !important;
    font-size: 0.88rem !important;
    line-height: 24px !important;
    padding-left: 0 !important;
    font-weight: 600;
}

.select2-container--bootstrap-5 .select2-selection--single .select2-selection__arrow {
    height: 38px !important;
    right: 8px !important;
}

.select2-container--bootstrap-5 .select2-selection:hover,
.select2-container--bootstrap-5.select2-container--focus .select2-selection,
.select2-container--bootstrap-5.select2-container--open .select2-selection {
    border-color: #9a55ff !important;
    box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.12) !important;
}

.select2-container--bootstrap-5 .select2-dropdown {
    border-color: #e9ecef !important;
    border-radius: 8px !important;
    overflow: hidden !important;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08) !important;
}

.select2-container--bootstrap-5 .select2-results__option {
    padding: 0.55rem 0.85rem !important;
    font-size: 0.86rem !important;
    font-weight: 600 !important;
}

.select2-container--bootstrap-5 .select2-results__option--selected {
    background-color: #f3e8ff !important;
    color: #7e22ce !important;
}

.select2-container--bootstrap-5 .select2-results__option--highlighted {
    background: linear-gradient(135deg, #da8cff, #9a55ff) !important;
    color: #ffffff !important;
}

/* BUTTONS */
.btn-gradient-primary {
    background: linear-gradient(to right, #da8cff, #9a55ff) !important;
    color: #ffffff !important;
    border: none !important;
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.25s ease;
}

.btn-gradient-primary:hover {
    transform: translateY(-2px);
    color: #ffffff !important;
}

.btn-gradient-secondary {
    background: #6c757d !important;
    color: #ffffff !important;
    border: none !important;
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.25s ease;
}

.btn-gradient-secondary:hover {
    transform: translateY(-2px);
    color: #ffffff !important;
}

.btn-icon-only {
    width: 40px;
    height: 40px;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    flex-shrink: 0;
}

.btn-icon-only i {
    font-size: 1.15rem;
}

/* ACTION BUTTONS */
.action-group {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
}

.btn-action {
    width: 36px;
    height: 36px;
    padding: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    transition: all 0.25s ease;
    border: none;
    cursor: pointer;
}

.btn-action i {
    font-size: 1.1rem;
}

.btn-action.document {
    background: linear-gradient(135deg, #06b6d4, #0891b2);
    color: #fff;
}

.btn-action.document:hover {
    transform: translateY(-2px);
    color: #fff;
}

.btn-action.view {
    background: linear-gradient(135deg, #da8cff, #9a55ff);
    color: #fff;
}

.btn-action.view:hover {
    transform: translateY(-2px);
    color: #fff;
}

.btn-action.delete {
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: #fff;
}

.btn-action.delete:hover {
    transform: translateY(-2px);
    color: #fff;
}

/* TABLE STYLING */
.table-responsive {
    overflow-x: auto;
    border-radius: 10px;
    border: 1px solid #f1f3f7;
    margin-bottom: 0.5rem;
}

.table {
    width: 100%;
    margin-bottom: 0;
    font-size: 0.9rem;
}

.table thead th {
    background: linear-gradient(135deg, #f8f9fa, #f1f3f5) !important;
    color: #475569 !important;
    font-weight: 700;
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 2px solid #e2e8f0;
    padding: 0.85rem 0.75rem;
    white-space: nowrap;
}

.table tbody td {
    vertical-align: middle;
    padding: 0.85rem 0.75rem;
    border-bottom: 1px solid #f1f5f9;
    color: #2c2e3f;
    white-space: nowrap;
}

.table tbody tr:hover {
    background-color: #fbf9ff;
}

.name-wrap {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.name-initial {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    background: linear-gradient(135deg, #da8cff, #9a55ff);
    color: #fff;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.85rem;
    flex-shrink: 0;
    box-shadow: 0 2px 8px rgba(154, 85, 255, 0.25);
}

.name-info {
    display: flex;
    flex-direction: column;
}

.name-title {
    font-weight: 700;
    color: #1e293b;
    font-size: 0.92rem;
}

.info-chip {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    padding: 0.35rem 0.75rem;
    border-radius: 8px;
    font-size: 0.8rem;
    font-weight: 700;
}

.info-chip.tenor {
    background: #f4ecff;
    color: #9a55ff;
    border: 1px solid #e9d5ff;
}

.info-chip.penalty {
    background: #fef2f2;
    color: #dc2626;
    border: 1px solid #fecaca;
}

.badge-status {
    padding: 0.4rem 0.85rem;
    border-radius: 8px;
    font-weight: 700;
    font-size: 0.78rem;
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
}

.badge-status.active {
    background: linear-gradient(135deg, #28c76f, #48da89);
    color: #fff;
}

.badge-status.inactive {
    background: #64748b;
    color: #fff;
}

.badge-status.process {
    background: linear-gradient(135deg, #f59e0b, #fbbf24);
    color: #ffffff;
}

/* PAGINATION */
.pagination {
    margin: 0;
    gap: 4px;
}

.page-item .page-link {
    border: 1.5px solid #e2e8f0;
    padding: 0.4rem 0.75rem;
    font-size: 0.82rem;
    color: #64748b;
    background-color: #ffffff;
    border-radius: 8px !important;
    font-weight: 700;
    transition: all 0.2s ease;
}

.page-item.active .page-link {
    background: linear-gradient(135deg, #da8cff, #9a55ff) !important;
    border-color: transparent !important;
    color: #ffffff !important;
    box-shadow: 0 4px 12px rgba(154, 85, 255, 0.3);
}

/* MODAL STYLING */
.modal-content {
    border: none;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.modal-header {
    background: #ffffff;
    color: #1e293b;
    padding: 1.1rem 1.5rem;
    border-bottom: 1px solid #f1f5f9;
}

.modal-header .btn-close {
    filter: none;
    opacity: 0.6;
}

.modal-header .btn-close:hover {
    opacity: 1;
}

.modal-title {
    font-weight: 700;
    font-size: 1.05rem;
    color: #1e293b;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.modal-title i {
    color: #9a55ff;
    font-size: 1.25rem;
}

.modal-body {
    padding: 1.5rem;
}

.modal-scroll-body {
    max-height: 75vh;
    overflow-y: auto;
}

.timeline-detail-card {
    background: linear-gradient(135deg, #faf7ff, #f4efff);
    border: 1.5px solid #eadcff;
    border-radius: 14px;
    padding: 1.25rem;
    margin-bottom: 1.25rem;
}

.timeline-detail-title {
    font-size: 0.95rem;
    font-weight: 700;
    color: #9a55ff;
    margin-bottom: 0.85rem;
}

.timeline-detail-item {
    background: #ffffff;
    border: 1px solid #efe6ff;
    border-radius: 10px;
    padding: 0.75rem 0.85rem;
    height: 100%;
}

.timeline-detail-label {
    font-size: 0.75rem;
    color: #8b8fa3;
    margin-bottom: 0.2rem;
    font-weight: 600;
}

.timeline-detail-value {
    font-size: 0.92rem;
    color: #2c2e3f;
    font-weight: 700;
}

.timeline-detail-value.price {
    color: #28c76f;
    font-weight: 800;
}

.total-paid {
    color: #28c76f !important;
    font-weight: 800 !important;
}

.btn-eye-purple {
    height: 34px;
    padding: 0 12px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    transition: all 0.25s ease;
    cursor: pointer;
    font-size: 0.82rem;
    font-weight: 700;
    gap: 0.35rem;
    background: #f4ecff;
    color: #9a55ff;
    border: 1px solid #e9d5ff;
    text-decoration: none !important;
}

.btn-eye-purple:hover {
    background: #9a55ff;
    color: #ffffff;
    border-color: #9a55ff;
}

.badge-payment-status {
    padding: 0.4rem 0.85rem;
    border-radius: 8px;
    font-weight: 700;
    font-size: 0.78rem;
    display: inline-block;
}

.badge-payment-status.active {
    background: linear-gradient(135deg, #28c76f, #48da89);
    color: #ffffff;
}

.badge-payment-status.pending {
    background: linear-gradient(135deg, #f59e0b, #fbbf24);
    color: #ffffff;
}

.badge-payment-status.late {
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: #ffffff;
}

.modern-file-upload {
    position: relative;
    width: 100%;
}

.modern-file-upload input[type="file"] {
    position: absolute;
    opacity: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
    z-index: 2;
}

.modern-file-upload .file-label {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1rem;
    background: #ffffff;
    border: 1.5px dashed #cbd5e1;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.2s ease;
}

.modern-file-upload:hover .file-label {
    border-color: #9a55ff;
    background: #fbf9ff;
}

.modern-file-upload .file-label i {
    font-size: 1.5rem;
    color: #9a55ff;
}

.modern-file-upload .file-label .file-info span {
    display: block;
    font-weight: 700;
    color: #2c2e3f;
    font-size: 0.85rem;
}

.modern-file-upload .file-label .file-info small {
    color: #8b8fa3;
    font-size: 0.75rem;
    display: block;
}
</style>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />

<div class="container-fluid p-2 p-sm-3 p-md-4">
    <!-- Header Card Banner -->
    <div class="row mb-3 mb-sm-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 header-card">
                <div class="card-body p-3 p-md-4 d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="text-dark mb-1 fw-bold">
                            <i class="mdi mdi-calendar-clock me-2" style="color: #9a55ff;"></i>Timeline Pembayaran Cash Tempo
                        </h4>
                        <p class="text-muted mb-0" style="font-size: 0.88rem;">
                            Kelola data tenor, jadwal jatuh tempo, dan riwayat pembayaran cicilan cash tempo
                        </p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-home-account" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Card Container -->
    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white d-flex flex-wrap justify-content-between align-items-center gap-2 p-3 p-md-4 border-0">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-format-list-bulleted me-2"></i>Daftar Tenor Pembayaran
                    </h5>
                    <button class="btn btn-gradient-primary d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#modalCreatePayment">
                        <i class="mdi mdi-plus-circle-outline"></i>
                        <span>Tambah Pembayaran</span>
                    </button>
                </div>

                <div class="card-body">
                    <!-- Filter Section (Sama Persis seperti Cicilan / KPR) -->
                    <div class="filter-card mb-3">
                        <form method="GET" action="{{ route('cash-tempo.timeline') }}" id="filterForm">
                            <!-- FILTER DESKTOP -->
                            <div class="filter-row-desktop d-none d-md-block">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                    <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                        <!-- Search Input -->
                                        <div style="min-width: 220px; max-width: 280px; flex: 1;">
                                            <div class="input-group search-input-group">
                                                <input type="text" name="search" value="{{ request('search') }}"
                                                    class="form-control" placeholder="Cari nama customer...">
                                                <button class="btn btn-gradient-primary btn-search-submit" 
                                                    type="submit" title="Cari">
                                                    <i class="mdi mdi-magnify"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Filter Sort Dropdown -->
                                        <div style="width: 180px;">
                                            <select name="sort" class="form-control select2" id="sortSelect" style="width: 100%;">
                                                <option value="latest" {{ request('sort', 'latest') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                                                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama (A - Z)</option>
                                                <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama (Z - A)</option>
                                                <option value="tenor_asc" {{ request('sort') == 'tenor_asc' ? 'selected' : '' }}>Tenor Terpendek</option>
                                                <option value="tenor_desc" {{ request('sort') == 'tenor_desc' ? 'selected' : '' }}>Tenor Terpanjang</option>
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
                                            class="btn btn-gradient-primary btn-icon-only"
                                            id="filterBtn" title="Filter">
                                            <i class="mdi mdi-filter"></i>
                                        </button>
                                        <a href="{{ route('cash-tempo.timeline') }}"
                                            class="btn btn-gradient-secondary btn-icon-only btn-reset-filter"
                                            title="Reset">
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
                                                placeholder="Cari nama customer..." id="searchMobile">
                                            <button class="btn btn-gradient-primary btn-search-submit"
                                                type="submit" title="Cari">
                                                <i class="mdi mdi-magnify"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <select name="sort_mobile" class="form-control select2" id="sortMobile" style="width: 100%;">
                                            <option value="latest" {{ request('sort', 'latest') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                                            <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama (A - Z)</option>
                                            <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama (Z - A)</option>
                                            <option value="tenor_asc" {{ request('sort') == 'tenor_asc' ? 'selected' : '' }}>Tenor Terpendek</option>
                                            <option value="tenor_desc" {{ request('sort') == 'tenor_desc' ? 'selected' : '' }}>Tenor Terpanjang</option>
                                        </select>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <div class="d-flex align-items-center gap-2">
                                            <div style="flex: 1;">
                                                <select name="per_page_mobile" class="form-control select2" id="perPageMobile" style="width: 100%;">
                                                    <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 / hal</option>
                                                    <option value="15" {{ request('per_page', 15) == 15 ? 'selected' : '' }}>15 / hal</option>
                                                    <option value="25" {{ request('per_page', 25) == 25 ? 'selected' : '' }}>25 / hal</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-gradient-primary btn-icon-only" title="Filter">
                                                <i class="mdi mdi-filter"></i>
                                            </button>
                                            <a href="{{ route('cash-tempo.timeline') }}" class="btn btn-gradient-secondary btn-icon-only btn-reset-filter" title="Reset">
                                                <i class="mdi mdi-refresh"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Table Data -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 50px;">NO</th>
                                    <th>ID BOOKING</th>
                                    <th>
                                        <a href="{{ route('cash-tempo.timeline', array_merge(request()->query(), ['sort' => request('sort') == 'name_asc' ? 'name_desc' : 'name_asc'])) }}" class="text-decoration-none text-dark fw-bold btn-sort-link">
                                            NAMA CUSTOMER
                                            @if(request('sort') == 'name_asc')
                                                <i class="mdi mdi-arrow-up text-primary"></i>
                                            @elseif(request('sort') == 'name_desc')
                                                <i class="mdi mdi-arrow-down text-primary"></i>
                                            @else
                                                <i class="mdi mdi-swap-vertical text-muted"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>
                                        <a href="{{ route('cash-tempo.timeline', array_merge(request()->query(), ['sort' => request('sort') == 'tenor_asc' ? 'tenor_desc' : 'tenor_asc'])) }}" class="text-decoration-none text-dark fw-bold btn-sort-link">
                                            TENOR
                                            @if(request('sort') == 'tenor_asc')
                                                <i class="mdi mdi-arrow-up text-primary"></i>
                                            @elseif(request('sort') == 'tenor_desc')
                                                <i class="mdi mdi-arrow-down text-primary"></i>
                                            @else
                                                <i class="mdi mdi-swap-vertical text-muted"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>JATUH TEMPO</th>
                                    <th>DENDA KETERLAMBATAN</th>
                                    <th>STATUS</th>
                                    <th class="text-center" style="width: 120px;">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tenors as $index => $tenor)
                                    @php
                                        $customerName = $tenor->booking->customer->full_name ?? '-';
                                        $customerId = $tenor->booking->customer->id ?? ($tenor->booking->customer_id ?? '-');
                                        $bookingCode = $tenor->booking->booking_code ?? ('BOOK-' . str_pad($tenor->booking_id, 4, '0', STR_PAD_LEFT));

                                        $words = collect(explode(' ', trim($customerName)))->filter();
                                        $initial = $words->count() >= 2
                                            ? strtoupper(substr($words->first(), 0, 1) . substr($words->last(), 0, 1))
                                            : strtoupper(substr($customerName, 0, 2));

                                        $tahun = floor(($tenor->tenor_bulan ?? 0) / 12);
                                        $tenorText = $tahun > 0 ? $tahun . ' Tahun' : (($tenor->tenor_bulan ?? 0) . ' Bulan');

                                        $statusClass = match($tenor->status) {
                                            'lunas' => 'active',
                                            'process' => 'process',
                                            default => 'inactive',
                                        };

                                        $statusIcon = match($tenor->status) {
                                            'lunas' => 'mdi-check-circle-outline',
                                            'process' => 'mdi-timer-sand',
                                            default => 'mdi-close-circle-outline',
                                        };

                                        $statusText = match($tenor->status) {
                                            'lunas' => 'Lunas',
                                            'process' => 'Berjalan',
                                            default => ucfirst($tenor->status ?? '-'),
                                        };

                                        $installments = $tenor->installments ?? collect();
                                        $typeUnit = $tenor->booking->unit->type ?? '-';
                                        $jenisUnit = $tenor->booking->unit->jenis ?? '-';
                                        $jatuhTempoDay = \Carbon\Carbon::parse($tenor->tanggal_mulai_angsuran)->format('d');
                                        $angsuranNominal = $tenor->tenor_bulan > 0 ? ($tenor->sisa_pembayaran / $tenor->tenor_bulan) : 0;

                                        $installmentData = $installments->values()->map(function ($item, $key) use ($tenor) {
                                            $jatuhTempo = \Carbon\Carbon::parse($item->jatuh_tempo);
                                            $isLate = $item->status != 'paid' && $jatuhTempo->lt(now());
                                            $denda = $isLate ? (($item->nominal_angsuran ?? 0) * (($tenor->denda_persen ?? 0) / 100)) : 0;

                                            return [
                                                'no' => $key + 1,
                                                'tanggal' => $jatuhTempo->translatedFormat('d F Y'),
                                                'nominal' => 'Rp ' . number_format($item->nominal_angsuran ?? 0, 0, ',', '.'),
                                                'status' => $item->status == 'paid' ? 'Lunas' : ($isLate ? 'Terlambat' : 'Pending'),
                                                'denda' => $item->status == 'paid' ? '-' : ($isLate ? 'Rp ' . number_format($denda, 0, ',', '.') : '-'),
                                                'bukti' => !empty($item->bukti_pembayaran),
                                                'bukti_url' => !empty($item->bukti_pembayaran) ? asset('storage/' . $item->bukti_pembayaran) : null,
                                                'total' => $item->status == 'paid'
                                                    ? 'Rp ' . number_format($item->nominal_angsuran ?? 0, 0, ',', '.')
                                                    : '-',
                                            ];
                                        })->toArray();
                                    @endphp

                                    <tr>
                                        <td class="text-center fw-bold">
                                            {{ $tenors->firstItem() + $index }}
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark fw-bold border" style="font-size: 0.8rem; padding: 0.35rem 0.65rem; border-radius: 6px;">
                                                <i class="mdi mdi-ticket-outline text-primary me-1"></i>{{ $bookingCode }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="name-wrap">
                                                <span class="name-initial">{{ $initial }}</span>
                                                <div class="name-info">
                                                    <span class="name-title">{{ $customerName }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="info-chip tenor">
                                                <i class="mdi mdi-calendar-range"></i>
                                                {{ $tenorText }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-muted">
                                                <i class="mdi mdi-calendar-alert me-1 text-primary"></i>
                                                Setiap Tanggal {{ $jatuhTempoDay }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="info-chip penalty">
                                                <i class="mdi mdi-percent-outline"></i>
                                                {{ $tenor->denda_persen }}% per bulan
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge-status {{ $statusClass }}">
                                                <i class="mdi {{ $statusIcon }}"></i>
                                                {{ $statusText }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="action-group">
                                                @if($tenor->status == 'lunas')
                                                    <a href="{{ route('document.user.persiapan-legal') }}" class="btn-action document" title="Dokumen Legalitas">
                                                        <i class="mdi mdi-file-document-outline"></i>
                                                    </a>
                                                @endif

                                                <button
                                                    class="btn-action view btn-detail-timeline"
                                                    title="Lihat Timeline & Angsuran"
                                                    type="button"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalDetailTimeline"
                                                    data-name="{{ $customerName }}"
                                                    data-booking-id="{{ $bookingCode }}"
                                                    data-status="{{ $statusText }}"
                                                    data-type-unit="{{ $typeUnit }}"
                                                    data-jenis-unit="{{ $jenisUnit }}"
                                                    data-jatuh-tempo="Setiap tanggal {{ $jatuhTempoDay }}"
                                                    data-angsuran="Rp {{ number_format($angsuranNominal, 0, ',', '.') }}"
                                                    data-denda="{{ $tenor->denda_persen }}% per bulan"
                                                    data-installments='@json($installmentData)'>
                                                    <i class="mdi mdi-eye-outline"></i>
                                                </button>

                                                <button class="btn-action delete btn-delete-tenor" title="Hapus Data" type="button" data-id="{{ $tenor->id }}">
                                                    <i class="mdi mdi-delete-outline"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-4">
                                            <i class="mdi mdi-information-outline me-1"></i>Tidak ada data tenor pembayaran
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($tenors->count() > 0)
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                            <div class="text-muted small mb-2 mb-sm-0">
                                Menampilkan {{ $tenors->firstItem() }} - {{ $tenors->lastItem() }} dari {{ $tenors->total() }} data
                            </div>
                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                    @if ($tenors->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link"><i class="mdi mdi-chevron-left"></i></span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link btn-page-link" href="{{ $tenors->previousPageUrl() }}"><i class="mdi mdi-chevron-left"></i></a>
                                        </li>
                                    @endif

                                    @foreach ($tenors->getUrlRange(1, $tenors->lastPage()) as $page => $url)
                                        <li class="page-item {{ $tenors->currentPage() == $page ? 'active' : '' }}">
                                            <a class="page-link btn-page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach

                                    @if ($tenors->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link btn-page-link" href="{{ $tenors->nextPageUrl() }}"><i class="mdi mdi-chevron-right"></i></a>
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

<!-- Modal Tambah Pembayaran Angsuran -->
<div class="modal fade" id="modalCreatePayment" tabindex="-1" aria-labelledby="modalCreatePaymentLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreatePaymentLabel">
                    <i class="mdi mdi-cash-plus me-2"></i>Tambah Pembayaran Angsuran
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="formCreatePayment" method="POST" action="{{ route('cash-tempo.storePayment') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body modal-scroll-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color: #2c2e3f;">Customer / Unit <span class="text-danger">*</span></label>
                        <select class="form-control" name="cash_tempo_id" id="selectTenor" required style="width: 100%;">
                            <option value="">-- Pilih Customer / Unit --</option>
                            @foreach ($tenors as $tempo)
                                <option value="{{ $tempo->id }}">
                                    {{ $tempo->booking->customer->full_name ?? '-' }} - Unit {{ $tempo->booking->unit->unit_name ?? '-' }} (Tenor: {{ $tempo->tenor_bulan }} bulan)
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color: #2c2e3f;">Pilih Angsuran <span class="text-danger">*</span></label>
                        <select class="form-control" name="installment_id" id="selectCashTempo" required style="width: 100%;">
                            <option value="">-- Pilih Customer Terlebih Dahulu --</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color: #2c2e3f;">Nominal Angsuran</label>
                        <input type="text" class="form-control total-paid" name="nominal_angsuran_display" id="nominalAngsuranDisplay" placeholder="Rp 0" readonly style="border-radius: 8px; border: 1px solid #e9ecef; height: 40px; background: #f8fafc; font-weight: 800; font-size: 0.95rem; color: #28c76f !important;">
                        <input type="hidden" name="nominal_angsuran" id="nominalAngsuran" value="0">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color: #2c2e3f;">Status Pembayaran</label>
                        <select class="form-control" name="status" id="modalStatusSelect" required style="width: 100%;">
                            <option value="paid" selected>Lunas</option>
                        </select>
                    </div>

                    <div class="mb-0">
                        <label class="form-label fw-bold" style="color: #2c2e3f;">Upload Bukti Pembayaran <span class="text-danger">*</span></label>
                        <div class="modern-file-upload">
                            <input type="file" id="buktiPembayaran" name="bukti_pembayaran" accept="image/*,application/pdf" required>
                            <div class="file-label">
                                <i class="mdi mdi-cloud-upload"></i>
                                <div class="file-info">
                                    <span id="fileName">Upload Bukti Pembayaran</span>
                                    <small>Format: JPG, PNG, PDF (Max: 2MB)</small>
                                </div>
                                <span class="file-size" id="fileSize" style="display:none;"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">
                        <i class="mdi mdi-close me-1"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-gradient-primary btn-save-payment">
                        <i class="mdi mdi-content-save me-1"></i>Simpan Pembayaran
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Detail Timeline -->
<div class="modal fade" id="modalDetailTimeline" tabindex="-1" aria-labelledby="modalDetailTimelineLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailTimelineLabel">
                    <i class="mdi mdi-calendar-clock me-2"></i>Detail Timeline & Jadwal Angsuran
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body modal-scroll-body">
                <div class="timeline-detail-card">
                    <div class="timeline-detail-title">
                        <i class="mdi mdi-information-outline me-1"></i>Informasi Customer & Skema Tenor
                    </div>

                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="timeline-detail-item">
                                <div class="timeline-detail-label">Nama Customer</div>
                                <div class="timeline-detail-value" id="detailName">-</div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="timeline-detail-item">
                                <div class="timeline-detail-label">Booking ID</div>
                                <div class="timeline-detail-value" id="detailBookingId">-</div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="timeline-detail-item">
                                <div class="timeline-detail-label">Status</div>
                                <div class="timeline-detail-value" id="detailStatus">-</div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="timeline-detail-item">
                                <div class="timeline-detail-label">Tipe Unit</div>
                                <div class="timeline-detail-value" id="detailTypeUnit">-</div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="timeline-detail-item">
                                <div class="timeline-detail-label">Jenis Pembelian</div>
                                <div class="timeline-detail-value" id="detailJenisUnit">-</div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="timeline-detail-item">
                                <div class="timeline-detail-label">Jatuh Tempo</div>
                                <div class="timeline-detail-value" id="detailJatuhTempo">-</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="timeline-detail-item">
                                <div class="timeline-detail-label">Estimasi Angsuran / Bulan</div>
                                <div class="timeline-detail-value price" id="detailAngsuran">-</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="timeline-detail-item">
                                <div class="timeline-detail-label">Denda Keterlambatan</div>
                                <div class="timeline-detail-value text-danger" id="detailDenda">-</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">NO</th>
                                <th>TANGGAL JATUH TEMPO</th>
                                <th>NOMINAL ANGSURAN</th>
                                <th>STATUS</th>
                                <th>DENDA</th>
                                <th class="text-center">BUKTI PEMBAYARAN</th>
                                <th>TOTAL BAYAR</th>
                            </tr>
                        </thead>
                        <tbody id="timelineTableBody"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function showLoading(message = 'Mohon tunggu sebentar...') {
    Swal.fire({
        title: 'Memuat Data...',
        html: message,
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
}

function renderStatusBadge(status) {
    const s = (status || '').toLowerCase();

    if (s === 'lunas' || s === 'aktif' || s === 'paid') {
        return `<span class="badge-payment-status active"><i class="mdi mdi-check-circle-outline me-1"></i>${status}</span>`;
    }
    if (s === 'pending' || s === 'belum bayar') {
        return `<span class="badge-payment-status pending"><i class="mdi mdi-timer-sand me-1"></i>${status}</span>`;
    }
    if (s === 'terlambat' || s === 'late') {
        return `<span class="badge-payment-status late"><i class="mdi mdi-alert-circle-outline me-1"></i>${status}</span>`;
    }

    return `<span class="badge-payment-status pending">${status}</span>`;
}

$(document).ready(function () {
    // Inisialisasi Select2 Filter Persis Cicilan / KPR
    $('#sortSelect, #perPageSelect, #sortMobile, #perPageMobile').select2({
        theme: 'bootstrap-5',
        minimumResultsForSearch: Infinity,
        width: '100%'
    });

    // Inisialisasi Select2 di dalam Modal Create Payment
    $('#selectTenor').select2({
        theme: 'bootstrap-5',
        placeholder: '-- Pilih Customer / Unit --',
        allowClear: true,
        width: '100%',
        dropdownParent: $('#modalCreatePayment')
    });

    $('#selectCashTempo').select2({
        theme: 'bootstrap-5',
        placeholder: '-- Pilih Angsuran --',
        width: '100%',
        minimumResultsForSearch: Infinity,
        dropdownParent: $('#modalCreatePayment')
    });

    $('#modalStatusSelect').select2({
        theme: 'bootstrap-5',
        width: '100%',
        minimumResultsForSearch: Infinity,
        dropdownParent: $('#modalCreatePayment')
    });

    // Tutup & Bersihkan Select2 saat modal ditutup
    $('#modalCreatePayment').on('hidden.bs.modal', function () {
        $('#selectTenor').select2('close');
        $('#selectCashTempo').select2('close');
        $('#modalStatusSelect').select2('close');
        $('.select2-container--open').removeClass('select2-container--open');
    });

    const filterForm = document.getElementById('filterForm');
    if (filterForm) {
        filterForm.addEventListener('submit', function () {
            if (window.innerWidth < 768) {
                var searchMobile = $('input[name="search_mobile"]').val();
                if (searchMobile !== undefined) {
                    $('input[name="search"]').val(searchMobile);
                }
                var sortMobile = $('#sortMobile').val();
                if (sortMobile !== undefined) {
                    $('#sortSelect').val(sortMobile);
                }
                var perPageMobile = $('#perPageMobile').val();
                if (perPageMobile !== undefined) {
                    $('#perPageSelect').val(perPageMobile);
                }
            }
            showLoading('Sedang memfilter data...');
        });
    }

    document.querySelectorAll('.btn-reset-filter').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            showLoading('Sedang mereset filter...');
            window.location.href = this.href;
        });
    });

    document.querySelectorAll('.btn-page-link, .btn-sort-link').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            showLoading('Sedang memuat data...');
            window.location.href = this.href;
        });
    });

    document.querySelectorAll('.btn-detail-timeline').forEach(button => {
        button.addEventListener('click', function () {
            document.getElementById('detailName').textContent = this.dataset.name || '-';
            document.getElementById('detailBookingId').textContent = this.dataset.bookingId || '-';
            document.getElementById('detailStatus').textContent = this.dataset.status || '-';
            document.getElementById('detailTypeUnit').textContent = this.dataset.typeUnit || '-';
            document.getElementById('detailJenisUnit').textContent = this.dataset.jenisUnit || '-';
            document.getElementById('detailJatuhTempo').textContent = this.dataset.jatuhTempo || '-';
            document.getElementById('detailAngsuran').textContent = this.dataset.angsuran || '-';
            document.getElementById('detailDenda').textContent = this.dataset.denda || '-';

            const tbody = document.getElementById('timelineTableBody');
            tbody.innerHTML = '';

            let installments = [];
            try {
                installments = JSON.parse(this.dataset.installments || '[]');
            } catch (e) {
                installments = [];
            }

            if (Array.isArray(installments) && installments.length > 0) {
                installments.forEach((item) => {
                    tbody.insertAdjacentHTML('beforeend', `
                        <tr>
                            <td class="text-center fw-bold">${item.no}</td>
                            <td>${item.tanggal}</td>
                            <td class="total-paid">${item.nominal}</td>
                            <td>${renderStatusBadge(item.status)}</td>
                            <td>${item.denda}</td>
                            <td class="text-center">
                                ${item.bukti && item.bukti_url
                                    ? `<a href="${item.bukti_url}" target="_blank" class="btn-eye-purple">
                                            <i class="mdi mdi-eye-outline"></i>Lihat
                                       </a>`
                                    : '-'
                                }
                            </td>
                            <td class="total-paid">${item.total}</td>
                        </tr>
                    `);
                });
            } else {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            Belum ada data jadwal angsuran
                        </td>
                    </tr>
                `;
            }
        });
    });

    // Data semua installment yang belum lunas
    const allInstallments = [
        @foreach ($tenors as $tempo)
            @foreach ($tempo->installments as $installment)
                @if ($installment->status != 'paid')
                    {
                        id: {{ $installment->id }},
                        tenor_id: {{ $tempo->id }},
                        iteration: {{ $loop->iteration }},
                        jatuh_tempo: '{{ \Carbon\Carbon::parse($installment->jatuh_tempo)->translatedFormat('d F Y') }}',
                        nominal: {{ $installment->nominal_angsuran ?? 0 }}
                    },
                @endif
            @endforeach
        @endforeach
    ];

    function updateInstallments(tenorId) {
        const select = $('#selectCashTempo');
        select.empty();

        if (!tenorId) {
            select.append('<option value="">-- Pilih Customer Terlebih Dahulu --</option>');
            select.val('').trigger('change.select2');
            $('#nominalAngsuranDisplay').val('');
            $('#nominalAngsuran').val(0);
            return;
        }

        const filtered = allInstallments.filter(item => String(item.tenor_id) === String(tenorId));

        if (filtered.length === 0) {
            select.append('<option value="">-- Semua Angsuran Sudah Lunas --</option>');
            select.val('').trigger('change.select2');
        } else {
            select.append('<option value="">-- Pilih Angsuran --</option>');
            filtered.forEach(item => {
                const formattedNominal = 'Rp ' + Number(item.nominal).toLocaleString('id-ID');
                select.append(`<option value="${item.id}" data-nominal="${item.nominal}">Angsuran ke-${item.iteration} - Jatuh tempo ${item.jatuh_tempo} (${formattedNominal})</option>`);
            });
            select.val('').trigger('change.select2');
        }

        $('#nominalAngsuranDisplay').val('');
        $('#nominalAngsuran').val(0);
    }

    $('#selectTenor').on('change select2:select select2:clear', function () {
        const tenorId = $(this).val();
        updateInstallments(tenorId);
    });

    $('#selectCashTempo').on('change select2:select', function () {
        const selectedOption = $(this).find('option:selected');
        const nominal = parseFloat(selectedOption.data('nominal')) || 0;
        $('#nominalAngsuran').val(nominal);
        $('#nominalAngsuranDisplay').val(nominal ? 'Rp ' + Number(nominal).toLocaleString('id-ID') : '');
    });

    const buktiPembayaran = document.getElementById('buktiPembayaran');
    if (buktiPembayaran) {
        buktiPembayaran.addEventListener('change', function(e) {
            const file = e.target.files[0];
            const fileName = document.getElementById('fileName');
            const fileSize = document.getElementById('fileSize');

            if (file) {
                fileName.textContent = file.name.length > 30 ? file.name.substring(0, 30) + '...' : file.name;
                fileSize.textContent = (file.size / (1024 * 1024)).toFixed(2) + ' MB';
                fileSize.style.display = 'inline-block';
            } else {
                fileName.textContent = 'Upload Bukti Pembayaran';
                fileSize.textContent = '';
                fileSize.style.display = 'none';
            }
        });
    }

    const formCreatePayment = document.getElementById('formCreatePayment');
    if (formCreatePayment) {
        formCreatePayment.addEventListener('submit', function (e) {
            e.preventDefault();

            const form = this;
            const formData = new FormData(form);
            const submitBtn = form.querySelector('.btn-save-payment');

            showLoading('Sedang menyimpan pembayaran...');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="mdi mdi-loading mdi-spin me-1"></i>Menyimpan...';

            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                }
            })
            .then(async response => {
                const data = await response.json().catch(() => ({}));
                if (!response.ok) throw new Error(data.message || 'Terjadi kesalahan');
                return data;
            })
            .then(() => {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Pembayaran angsuran berhasil disimpan',
                    confirmButtonColor: '#9a55ff'
                }).then(() => window.location.reload());
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: error.message || 'Terjadi kesalahan sistem',
                    confirmButtonColor: '#dc3545'
                });
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="mdi mdi-content-save me-1"></i>Simpan Pembayaran';
            });
        });
    }

    document.querySelectorAll('.btn-delete-tenor').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: 'Data tenor pembayaran yang dihapus tidak dapat dikembalikan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus Data',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    showLoading('Sedang menghapus data...');
                    setTimeout(() => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data tenor ID ' + id + ' berhasil dihapus',
                            confirmButtonColor: '#9a55ff'
                        });
                    }, 600);
                }
            });
        });
    });

    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            confirmButtonColor: '#9a55ff'
        });
    @endif

    @if ($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: "{{ $errors->first() }}",
            confirmButtonColor: '#dc3545'
        });
    @endif
});
</script>
@endpush
