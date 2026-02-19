@extends('layouts.partial.app')

@section('title', 'Semua Kavling - Property Management App')

@section('content')
<style>
/* ===== SEMUA CSS SAMA PERSIS DENGAN HALAMAN PROPERTI ===== */
.card {
    transition: all 0.3s ease;
    margin-bottom: 1rem;
}

.card:hover {
    box-shadow: 0 8px 25px rgba(154, 85, 255, 0.1) !important;
}

.card-header {
    background: linear-gradient(135deg, #ffffff, #f8f9fa);
    border-bottom: 1px solid #e9ecef;
    padding: 0.75rem;
}

@media (min-width: 576px) {
    .card-header {
        padding: 1rem;
    }
}

@media (min-width: 768px) {
    .card-header {
        padding: 1.2rem;
    }
}

.card-body {
    padding: 0.75rem;
}

@media (min-width: 576px) {
    .card-body {
        padding: 1rem;
    }
}

@media (min-width: 768px) {
    .card-body {
        padding: 1.2rem;
    }
}

/* Card Title */
.card-title {
    font-size: 0.9rem;
    font-weight: 600;
    color: #9a55ff;
    margin-bottom: 0;
}

@media (min-width: 576px) {
    .card-title {
        font-size: 1rem;
    }
}

@media (min-width: 768px) {
    .card-title {
        font-size: 1.1rem;
    }
}

/* ===== FILTER SECTION - SAMA PERSIS DENGAN PROPERTI ===== */
.filter-card {
    background: linear-gradient(135deg, #f9f7ff, #f2ecff);
    border-radius: 12px;
    padding: 1rem;
    margin-bottom: 1.25rem;
}

.filter-card .card-body {
    padding: 1rem !important;
}

.filter-card .form-label {
    font-size: 0.85rem;
    font-weight: 600;
    color: #9a55ff !important;
    margin-bottom: 0.4rem;
    letter-spacing: 0.3px;
}

.filter-card .form-control,
.filter-card .form-select {
    padding: 0.5rem 0.75rem;
    font-size: 0.9rem;
    border-radius: 8px;
    height: auto;
    min-height: 40px;
    border: 1px solid #e0e4e9;
}

.filter-card .btn {
    padding: 0.5rem 0.75rem;
    font-size: 0.85rem;
    min-height: 40px;
    border-radius: 8px;
    font-weight: 600;
}

/* Form Controls */
.form-control, .form-select {
    border: 1px solid #e9ecef;
    border-radius: 8px;
    padding: 0.6rem 0.8rem;
    font-size: 0.9rem;
    transition: all 0.2s ease;
    background-color: #ffffff;
    color: #2c2e3f;
    height: auto;
}

@media (min-width: 576px) {
    .form-control, .form-select {
        padding: 0.7rem 1rem;
        font-size: 0.95rem;
        border-radius: 10px;
    }
}

.form-control:focus, .form-select:focus {
    border-color: #9a55ff;
    box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.1);
    outline: none;
}

/* Form Label */
.form-label {
    font-size: 0.85rem;
    font-weight: 600;
    color: #9a55ff !important;
    margin-bottom: 0.3rem;
    letter-spacing: 0.3px;
    font-family: 'Nunito', sans-serif;
}

/* Button Styling */
.btn {
    font-size: 0.85rem;
    padding: 0.6rem 1rem;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
    font-family: 'Nunito', sans-serif;
    border: none;
}

@media (min-width: 576px) {
    .btn {
        font-size: 0.9rem;
        padding: 0.7rem 1.2rem;
        border-radius: 10px;
    }
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.btn-sm {
    padding: 0.35rem 0.7rem;
    font-size: 0.8rem;
    border-radius: 6px;
}

.btn-gradient-secondary {
    background: #6c757d !important;
    color: #ffffff !important;
}

.btn-gradient-secondary:hover {
    background: #5a6268 !important;
}

.btn-gradient-info {
    background: linear-gradient(135deg, #17a2b8, #5bc0de) !important;
    color: #ffffff !important;
}

.btn-gradient-success {
    background: linear-gradient(135deg, #28a745, #5cb85c) !important;
    color: #ffffff !important;
}

.btn-gradient-warning {
    background: linear-gradient(135deg, #ffc107, #ffdb6d) !important;
    color: #2c2e3f !important;
}

.btn-gradient-danger {
    background: linear-gradient(135deg, #dc3545, #e4606d) !important;
    color: #ffffff !important;
}

.btn-gradient-primary {
    background: linear-gradient(to right, #da8cff, #9a55ff) !important;
    color: #ffffff !important;
}

/* Outline Buttons - untuk icon aksi */
.btn-outline-primary {
    background: transparent;
    border: 1px solid #9a55ff;
    color: #9a55ff;
    padding: 0.4rem 0.75rem;
}

.btn-outline-primary:hover {
    background: linear-gradient(to right, #da8cff, #9a55ff);
    color: #ffffff;
    border-color: transparent;
}

/* Badge Styling */
.badge {
    padding: 0.35rem 0.6rem;
    font-size: 0.75rem;
    font-weight: 600;
    border-radius: 30px;
    display: inline-block;
    white-space: nowrap;
}

@media (min-width: 576px) {
    .badge {
        padding: 0.4rem 0.75rem;
        font-size: 0.8rem;
    }
}

@media (min-width: 768px) {
    .badge {
        padding: 0.45rem 0.8rem;
        font-size: 0.85rem;
    }
}

.badge-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.7rem;
}

.badge-gradient-success {
    background: linear-gradient(135deg, #28a745, #5cb85c);
    color: #ffffff;
}

.badge-gradient-warning {
    background: linear-gradient(135deg, #ffc107, #ffdb6d);
    color: #2c2e3f;
}

.badge-gradient-danger {
    background: linear-gradient(135deg, #dc3545, #e4606d);
    color: #ffffff;
}

.badge-gradient-info {
    background: linear-gradient(135deg, #17a2b8, #5bc0de);
    color: #ffffff;
}

/* ===== TABLE STYLING ===== */
.table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    border-radius: 8px;
    margin-bottom: 0.5rem;
}

.table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 0;
}

.table thead th {
    background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
    color: #9a55ff;
    font-weight: 600;
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 2px solid #e9ecef;
    padding: 0.8rem 0.5rem;
    white-space: nowrap;
}

@media (min-width: 576px) {
    .table thead th {
        font-size: 0.85rem;
        padding: 0.9rem 0.6rem;
    }
}

@media (min-width: 768px) {
    .table thead th {
        font-size: 0.9rem;
        padding: 1rem 0.75rem;
    }
}

/* Kolom No - lebih rapat */
.table thead th:first-child {
    padding-left: 0.75rem;
    width: 60px;
}

.table tbody td:first-child {
    padding-left: 0.75rem;
    font-weight: 500;
    width: 60px;
}

.table tbody td {
    vertical-align: middle;
    font-size: 0.85rem;
    padding: 0.8rem 0.5rem;
    border-bottom: 1px solid #e9ecef;
    color: #2c2e3f;
}

@media (min-width: 576px) {
    .table tbody td {
        font-size: 0.9rem;
        padding: 0.9rem 0.6rem;
    }
}

@media (min-width: 768px) {
    .table tbody td {
        font-size: 0.95rem;
        padding: 1rem 0.75rem;
    }
}

.table tbody tr:hover {
    background-color: #f8f9fa;
}

/* Nama properti - lebih rapat dengan nomor */
.table tbody td:nth-child(2) {
    padding-left: 0.3rem;
}

.table tbody td .d-flex.align-items-center {
    gap: 0.5rem;
}

/* Icon dalam tabel */
.table tbody td i {
    font-size: 1rem;
}

/* Text colors */
.text-primary { color: #9a55ff !important; }
.text-info { color: #17a2b8 !important; }
.text-danger { color: #dc3545 !important; }
.text-success { color: #28a745 !important; }
.text-warning { color: #ffc107 !important; }
.fw-bold { font-weight: 600 !important; }
.text-muted { color: #a5b3cb !important; }

/* ===== PAGINATION STYLING - DIPERKECIL ===== */
.pagination {
    margin: 0;
    gap: 3px;
}

.page-item .page-link {
    border: 1px solid #e9ecef;
    padding: 0.35rem 0.7rem;
    font-size: 0.75rem;
    color: #6c7383;
    background-color: #ffffff;
    border-radius: 6px !important;
    transition: all 0.2s ease;
    min-width: 32px;
    text-align: center;
}

@media (min-width: 576px) {
    .page-item .page-link {
        padding: 0.4rem 0.8rem;
        font-size: 0.8rem;
        min-width: 36px;
    }
}

@media (min-width: 768px) {
    .page-item .page-link {
        padding: 0.45rem 0.9rem;
        font-size: 0.85rem;
        min-width: 40px;
    }
}

.page-item.active .page-link {
    background: linear-gradient(to right, #da8cff, #9a55ff);
    border-color: transparent;
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(154, 85, 255, 0.3);
}

.page-item .page-link:hover {
    background-color: #f8f9fa;
    border-color: #9a55ff;
    color: #9a55ff;
    transform: translateY(-1px);
}

/* Info text pagination */
.pagination-info {
    font-size: 0.8rem;
    color: #6c7383;
}

@media (min-width: 576px) {
    .pagination-info {
        font-size: 0.85rem;
    }
}

@media (min-width: 768px) {
    .pagination-info {
        font-size: 0.9rem;
    }
}

/* Typography */
h3.text-dark,
h4.text-dark {
    font-size: 1.3rem !important;
    font-weight: 700;
    color: #2c2e3f !important;
    margin-bottom: 0.5rem !important;
}

@media (min-width: 576px) {
    h3.text-dark,
    h4.text-dark {
        font-size: 1.5rem !important;
    }
}

@media (min-width: 768px) {
    h3.text-dark,
    h4.text-dark {
        font-size: 1.7rem !important;
    }
}

/* Tooltip styling */
[data-bs-toggle="tooltip"] {
    cursor: pointer;
}

/* Badge dengan icon */
.badge i {
    font-size: 0.8rem;
    margin-right: 4px;
}

/* Hover effect untuk icon aksi */
.btn-outline-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

/* Responsive untuk mobile */
@media (max-width: 576px) {
    .table thead th {
        font-size: 0.75rem;
        padding: 0.6rem 0.3rem;
    }

    .table tbody td {
        font-size: 0.8rem;
        padding: 0.6rem 0.3rem;
    }

    .filter-card {
        padding: 0.75rem;
    }

    .filter-card .form-label {
        font-size: 0.8rem;
    }

    .filter-card .form-control,
    .filter-card .form-select,
    .filter-card .btn {
        font-size: 0.8rem;
        min-height: 38px;
    }

    h3.text-dark,
    h4.text-dark {
        font-size: 1.2rem !important;
    }
}

/* DataTables Custom Styling - Sembunyikan elemen yang tidak diinginkan */
.dataTables_filter {
    display: none !important;
}

.dataTables_length {
    display: none !important;
}

.dataTables_paginate {
    display: none !important;
}

.dataTables_info {
    display: none !important;
}

/* Tetap tampilkan sorting indicator */
.sorting, .sorting_asc, .sorting_desc {
    cursor: pointer;
}

/* Icon styling */
.mdi {
    vertical-align: middle;
}

/* Styling untuk tombol reset icon-only */
.btn-icon-only {
    width: 40px;
    padding: 0.5rem 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.btn-icon-only i {
    font-size: 1.2rem;
    margin: 0;
}
</style>

<div class="container-fluid p-2 p-sm-3 p-md-4">
    <!-- Header Dashboard - CARD TERPISAH -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-1 fw-bold text-dark">
                            <i class="mdi mdi-terrain me-2" style="color: #9a55ff;"></i>
                            Semua Tanah / LandBank Terverifikasi Dokument
                        </h4>
                        <p class="mb-0 text-muted small">
                            <i class="mdi mdi-information-outline me-1"></i>
                            Daftar tanah yang sudah terverifikasi dokumen legalnya
                        </p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-terrain" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel dengan Filter UI -->
    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center">
                    <h4 class="card-title">
                        <i class="mdi mdi-format-list-bulleted me-2"></i>
                        Daftar Tanah / LandBank Terverifikasi Terbaru
                    </h4>
                </div>
                <div class="card-body">
                    <!-- Filter Section - SAMA PERSIS DENGAN PROPERTI -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="filter-card">
                                <div class="card-body">
                                    <h6 class="card-title mb-3" style="font-size: 1rem;">
                                        <i class="mdi mdi-filter-outline me-1"></i>Filter Data
                                    </h6>

                                    <!-- FILTER UNTUK MOBILE -->
                                    <div class="d-block d-md-none">
                                        <div class="mb-3">
                                            <label class="form-label">
                                                <i class="mdi mdi-magnify me-1"></i>Pencarian
                                            </label>
                                            <input type="text" id="searchInputMobile" class="form-control" placeholder="Cari nama properti...">
                                        </div>

                                        <div class="row g-2">
                                            <div class="col-6">
                                                <label class="form-label">
                                                    <i class="mdi mdi-shape-outline me-1"></i>Type
                                                </label>
                                                <select id="filterTypeMobile" class="form-control">
                                                    <option value="">Semua</option>
                                                    <option value="Rumah">Rumah</option>
                                                    <option value="Apartemen">Apartemen</option>
                                                    <option value="Ruko">Ruko</option>
                                                    <option value="Tanah">Tanah</option>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">
                                                    <i class="mdi mdi-map-marker me-1"></i>Lokasi
                                                </label>
                                                <select id="filterLokasiMobile" class="form-control">
                                                    <option value="">Semua</option>
                                                    <option value="Jakarta">Jakarta</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row g-2 mt-2">
                                            <div class="col-6">
                                                <label class="form-label">
                                                    <i class="mdi mdi-counter me-1"></i>Tampil
                                                </label>
                                                <select id="showDataMobile" class="form-control">
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select>
                                            </div>
                                            <div class="col-6 d-flex align-items-end">
                                                <button type="button" id="resetFilterMobile" class="btn btn-gradient-secondary w-100">
                                                    <i class="mdi mdi-refresh me-1"></i> Reset
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- FILTER UNTUK TABLET & DESKTOP - SAMA PERSIS DENGAN PROPERTI -->
                                    <div class="d-none d-md-block">
                                        <div class="row g-2 align-items-end">
                                            <div class="col-md-3">
                                                <label class="form-label">
                                                    <i class="mdi mdi-magnify me-1"></i>Pencarian
                                                </label>
                                                <input type="text" id="searchInput" class="form-control" placeholder="Cari nama properti...">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">
                                                    <i class="mdi mdi-shape-outline me-1"></i>Type
                                                </label>
                                                <select id="filterType" class="form-control">
                                                    <option value="">Semua</option>
                                                    <option value="Rumah">Rumah</option>
                                                    <option value="Apartemen">Apartemen</option>
                                                    <option value="Ruko">Ruko</option>
                                                    <option value="Tanah">Tanah</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">
                                                    <i class="mdi mdi-map-marker me-1"></i>Lokasi
                                                </label>
                                                <select id="filterLokasi" class="form-control">
                                                    <option value="">Semua</option>
                                                    <option value="Jakarta">Jakarta</option>
                                                </select>
                                            </div>
                                            <div class="col-md-1">
                                                <label class="form-label">
                                                    <i class="mdi mdi-counter me-1"></i>Tampil
                                                </label>
                                                <select id="showData" class="form-control">
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select>
                                            </div>
                                            <div class="col-md-1">
                                                <label class="form-label" style="visibility: hidden;">Reset</label>
                                                <button type="button" id="resetFilter" class="btn btn-gradient-secondary w-100 btn-icon-only" title="Reset Filter">
                                                    <i class="mdi mdi-refresh"></i>
                                                </button>
                                            </div>
                                            <div class="col-md-3">
                                                <!-- Kolom kosong untuk menjaga keseimbangan -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel Data -->
                    <div class="table-responsive">
                        <table id="tableKavling" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center"><i class="mdi mdi-counter me-1"></i>No</th>
                                    <th><i class="mdi mdi-home me-1"></i>Nama Properti</th>
                                    <th><i class="mdi mdi-shape-outline me-1"></i>Type</th>
                                    <th class="d-none d-md-table-cell"><i class="mdi mdi-map-marker me-1"></i>Lokasi</th>
                                    <th><i class="mdi mdi-currency-usd me-1"></i>Harga</th>
                                    <th><i class="mdi mdi-ruler-square me-1"></i>Luas</th>
                                    <th><i class="mdi mdi-chart-arc me-1"></i>Status</th>
                                    <th class="text-center"><i class="mdi mdi-cog me-1"></i>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lands as $i => $land)
                                    @php
                                        $totalUnitArea = $land->units->sum('area');
                                        $remainingArea = $land->area - $totalUnitArea;
                                    @endphp
                                    <tr>
                                        <td class="text-center fw-bold">
                                            <span class="badge bg-light text-dark">{{ $i + $lands->firstItem() }}</span>
                                        </td>

                                        {{-- NAMA PROPERTI --}}
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-home-variant text-primary me-2" style="font-size: 1rem;"></i>
                                                <span class="fw-bold">{{ Str::limit($land->name ?? '-', 25) }}</span>
                                            </div>
                                            <small class="text-muted d-block d-md-none">
                                                <i class="mdi mdi-map-marker me-1"></i>{{ Str::limit($land->address ?? '-', 15) }}
                                            </small>
                                        </td>

                                        {{-- TYPE --}}
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if(($land->zoning ?? 'Tanah') == 'Rumah')
                                                    <i class="mdi mdi-home-city text-info me-2" style="font-size: 1rem;"></i>
                                                @elseif(($land->zoning ?? 'Tanah') == 'Apartemen')
                                                    <i class="mdi mdi-office-building text-info me-2" style="font-size: 1rem;"></i>
                                                @elseif(($land->zoning ?? 'Tanah') == 'Ruko')
                                                    <i class="mdi mdi-store text-info me-2" style="font-size: 1rem;"></i>
                                                @elseif(($land->zoning ?? 'Tanah') == 'Tanah')
                                                    <i class="mdi mdi-terrain text-info me-2" style="font-size: 1rem;"></i>
                                                @else
                                                    <i class="mdi mdi-shape-outline text-info me-2" style="font-size: 1rem;"></i>
                                                @endif
                                                <span>{{ $land->zoning ?? 'Tanah' }}</span>
                                            </div>
                                        </td>

                                        {{-- LOKASI --}}
                                        <td class="d-none d-md-table-cell">
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-map-marker text-danger me-2" style="font-size: 1rem;"></i>
                                                <span>{{ Str::limit($land->address ?? '-', 20) }}</span>
                                            </div>
                                        </td>

                                        {{-- HARGA --}}
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-currency-usd text-success me-2" style="font-size: 1rem;"></i>
                                                <span class="text-nowrap fw-bold text-success">Rp {{ number_format($land->acquisition_price ?? 0, 0, ',', '.') }}</span>
                                            </div>
                                        </td>

                                        {{-- LUAS TANAH --}}
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-ruler-square text-warning me-2" style="font-size: 1rem;"></i>
                                                <div>
                                                    <span class="text-nowrap">{{ number_format($land->area ?? 0, 0, ',', '.') }} m²</span>
                                                    <small class="text-muted d-block">
                                                        <i class="mdi mdi-information-outline me-1"></i>
                                                        Sisa: {{ number_format($remainingArea, 0, ',', '.') }} m²
                                                    </small>
                                                </div>
                                            </div>
                                        </td>

                                        {{-- STATUS --}}
                                        <td>
                                            @if ($land->status == 'sold')
                                                <span class="badge badge-gradient-danger">
                                                    <i class="mdi mdi-cash me-1"></i>Terjual
                                                </span>
                                            @elseif($land->status == 'booking')
                                                <span class="badge badge-gradient-warning">
                                                    <i class="mdi mdi-calendar-clock me-1"></i>Booking
                                                </span>
                                            @else
                                                <span class="badge badge-gradient-success">
                                                    <i class="mdi mdi-check-circle me-1"></i>Tersedia
                                                </span>
                                            @endif
                                        </td>

                                        {{-- AKSI --}}
                                        <td class="text-center">
                                            <a href="{{ route('properti.buatKavling', ['land_bank_id' => $land->id]) }}"
                                               class="btn btn-outline-primary btn-sm"
                                               data-bs-toggle="tooltip"
                                               title="Buat Kavling">
                                                <i class="mdi mdi-pencil-ruler"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination UI - DIPERKECIL -->
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-3">
                        <div class="pagination-info mb-2 mb-sm-0">
                            <i class="mdi mdi-information-outline me-1"></i>
                            Menampilkan {{ $lands->firstItem() ?? 0 }}-{{ $lands->lastItem() ?? 0 }} dari {{ $lands->total() }} data
                        </div>
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0" style="gap: 2px;">
                                <li class="page-item {{ $lands->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $lands->previousPageUrl() }}" tabindex="-1" aria-label="Previous" {{ $lands->onFirstPage() ? 'aria-disabled=true' : '' }}>
                                        <i class="mdi mdi-chevron-left"></i>
                                    </a>
                                </li>

                                @for($i = 1; $i <= $lands->lastPage(); $i++)
                                    <li class="page-item {{ $i == $lands->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $lands->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor

                                <li class="page-item {{ $lands->hasMorePages() ? '' : 'disabled' }}">
                                    <a class="page-link" href="{{ $lands->nextPageUrl() }}" aria-label="Next" {{ $lands->hasMorePages() ? '' : 'aria-disabled=true' }}>
                                        <i class="mdi mdi-chevron-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Inisialisasi tooltip Bootstrap
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    // Inisialisasi DataTables - hanya untuk sorting
    let table = $('#tableKavling').DataTable({
        responsive: true,
        paging: false,        // MATIKAN pagination DataTables
        info: false,          // MATIKAN info DataTables
        searching: false,     // MATIKAN search bawaan
        lengthChange: false,  // MATIKAN length change
        ordering: true,       // AKTIFKAN sorting saja
        language: {
            emptyTable: `
                <div class="text-center text-muted py-5">
                    <i class="mdi mdi-terrain" style="font-size: 3rem; opacity: 0.3;"></i>
                    <p class="mt-3">
                        <i class="mdi mdi-information-outline me-2"></i>
                        Belum ada properti terverifikasi
                    </p>
                </div>
            `,
            zeroRecords: "Data tidak ditemukan",
        },
        columnDefs: [
            { orderable: false, targets: [0, 7] } // Non-aktifkan sorting untuk kolom No dan Aksi
        ]
    });
});
</script>
@endpush
