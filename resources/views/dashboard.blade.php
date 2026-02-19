@extends('layouts.partial.app')

@section('title', 'Dashboard - Property Management App')

@section('content')
<style>
/* ===== SEMUA CSS SAMA PERSIS DENGAN HALAMAN KAVLING ===== */
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

/* ===== STATISTICS CARDS ===== */
.bg-gradient-primary {
    background: linear-gradient(135deg, #da8cff, #9a55ff) !important;
}

.bg-gradient-info {
    background: linear-gradient(135deg, #6a82fb, #4e6aff) !important;
}

.bg-gradient-success {
    background: linear-gradient(135deg, #28a745, #5cb85c) !important;
}

.bg-gradient-danger {
    background: linear-gradient(135deg, #dc3545, #e4606d) !important;
}

.card-img-holder {
    position: relative;
    overflow: hidden;
}

.card-img-absolute {
    position: absolute;
    right: 0;
    bottom: 0;
    opacity: 0.3;
    width: 80px;
    height: auto;
}

/* ===== FILTER SECTION - DIPERBESAR ===== */
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

.btn-gradient-primary {
    background: linear-gradient(to right, #da8cff, #9a55ff) !important;
    color: #ffffff !important;
}

.btn-gradient-secondary {
    background: #6c757d !important;
    color: #ffffff !important;
}

.btn-gradient-secondary:hover {
    background: #5a6268 !important;
}

/* Outline Buttons */
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

/* Kolom No lebih rapat */
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
h3.text-dark {
    font-size: 1.3rem !important;
    font-weight: 700;
    color: #2c2e3f !important;
    margin-bottom: 0.5rem !important;
}

@media (min-width: 576px) {
    h3.text-dark {
        font-size: 1.5rem !important;
    }
}

@media (min-width: 768px) {
    h3.text-dark {
        font-size: 1.7rem !important;
    }
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

    h3.text-dark {
        font-size: 1.2rem !important;
    }
}

/* DataTables Custom Styling */
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

/* Sorting indicator */
.sorting, .sorting_asc, .sorting_desc {
    cursor: pointer;
}

/* Icon styling */
.mdi {
    vertical-align: middle;
}
</style>

<div class="container-fluid p-2 p-sm-3 p-md-4">
    <!-- Header Dashboard -->
    <div class="row mb-3 mb-sm-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h3 class="text-dark mb-1">
                        <i class="mdi mdi-view-dashboard me-2" style="color: #9a55ff;"></i>
                        Dashboard
                    </h3>
                    <p class="text-muted mb-0">
                        <i class="mdi mdi-information-outline me-1"></i>
                        Selamat datang di dashboard manajemen properti
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-2 g-sm-2 g-md-3">
        <!-- Mobile: 2 cards per row, Tablet: 2 cards per row, Desktop: 4 cards per row -->
        <div class="col-6 col-sm-6 col-md-6 col-lg-3 mb-2 mb-sm-2 mb-md-3">
            <div class="card bg-gradient-primary card-img-holder text-white h-100">
                <div class="card-body p-2 p-sm-2 p-md-3">
                    <img src="{{ asset('admin/assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-2 mb-sm-2 mb-md-3 small fs-6 fs-sm-6 fs-md-5">
                        Total Properti
                        <i class="mdi mdi-office-building float-end" style="font-size: 1.2rem;"></i>
                    </h4>
                    <h2 class="mb-2 mb-sm-2 mb-md-4 fs-5 fs-sm-5 fs-md-2">156</h2>
                    <h6 class="card-text small">+12%</h6>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-6 col-md-6 col-lg-3 mb-2 mb-sm-2 mb-md-3">
            <div class="card bg-gradient-info card-img-holder text-white h-100">
                <div class="card-body p-2 p-sm-2 p-md-3">
                    <img src="{{ asset('admin/assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-2 mb-sm-2 mb-md-3 small fs-6 fs-sm-6 fs-md-5">
                        Total Customer
                        <i class="mdi mdi-account-group float-end" style="font-size: 1.2rem;"></i>
                    </h4>
                    <h2 class="mb-2 mb-sm-2 mb-md-4 fs-5 fs-sm-5 fs-md-2">892</h2>
                    <h6 class="card-text small">+5%</h6>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-6 col-md-6 col-lg-3 mb-2 mb-sm-2 mb-md-3">
            <div class="card bg-gradient-success card-img-holder text-white h-100">
                <div class="card-body p-2 p-sm-2 p-md-3">
                    <img src="{{ asset('admin/assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-2 mb-sm-2 mb-md-3 small fs-6 fs-sm-6 fs-md-5">
                        Transaksi
                        <i class="mdi mdi-cash-multiple float-end" style="font-size: 1.2rem;"></i>
                    </h4>
                    <h2 class="mb-2 mb-sm-2 mb-md-4 fs-5 fs-sm-5 fs-md-2">45</h2>
                    <h6 class="card-text small">Bulan ini</h6>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-6 col-md-6 col-lg-3 mb-2 mb-sm-2 mb-md-3">
            <div class="card bg-gradient-danger card-img-holder text-white h-100">
                <div class="card-body p-2 p-sm-2 p-md-3">
                    <img src="{{ asset('admin/assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-2 mb-sm-2 mb-md-3 small fs-6 fs-sm-6 fs-md-5">
                        Pendapatan
                        <i class="mdi mdi-currency-usd float-end" style="font-size: 1.2rem;"></i>
                    </h4>
                    <h2 class="mb-2 mb-sm-2 mb-md-4 fs-5 fs-sm-5 fs-md-2">Rp 2,5 M</h2>
                    <h6 class="card-text small">+18%</h6>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Data -->
    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center">
                    <h4 class="card-title">
                        <i class="mdi mdi-format-list-bulleted me-2"></i>
                        Daftar Properti Terbaru
                    </h4>
                </div>
                <div class="card-body">
                    <!-- Filter Section - DIPERBESAR -->
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
                                                    <i class="mdi mdi-shape-outline me-1"></i>Kategori
                                                </label>
                                                <select id="filterKategoriMobile" class="form-control">
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

                                    <!-- FILTER UNTUK TABLET & DESKTOP -->
                                    <div class="d-none d-md-block">
                                        <div class="row g-2 align-items-end">
                                            <div class="col-md-4">
                                                <label class="form-label">
                                                    <i class="mdi mdi-magnify me-1"></i>Pencarian
                                                </label>
                                                <input type="text" id="searchInput" class="form-control" placeholder="Cari nama properti...">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">
                                                    <i class="mdi mdi-shape-outline me-1"></i>Kategori
                                                </label>
                                                <select id="filterKategori" class="form-control">
                                                    <option value="">Semua</option>
                                                    <option value="Rumah">Rumah</option>
                                                    <option value="Apartemen">Apartemen</option>
                                                    <option value="Ruko">Ruko</option>
                                                    <option value="Tanah">Tanah</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">
                                                    <i class="mdi mdi-map-marker me-1"></i>Lokasi
                                                </label>
                                                <select id="filterLokasi" class="form-control">
                                                    <option value="">Semua</option>
                                                    <option value="Jakarta">Jakarta</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
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
                                                <button type="button" id="resetFilter" class="btn btn-gradient-secondary w-100" title="Reset Filter">
                                                    <i class="mdi mdi-refresh me-1"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel Data - 1 Data Saja -->
                    <div class="table-responsive">
                        <table id="tableDashboard" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center"><i class="mdi mdi-counter me-1"></i>No</th>
                                    <th><i class="mdi mdi-home me-1"></i>Nama Properti</th>
                                    <th><i class="mdi mdi-shape-outline me-1"></i>Tipe</th>
                                    <th class="d-none d-md-table-cell"><i class="mdi mdi-map-marker me-1"></i>Lokasi</th>
                                    <th><i class="mdi mdi-currency-usd me-1"></i>Harga</th>
                                    <th><i class="mdi mdi-calendar-clock me-1"></i>Status</th>
                                    <th class="text-center"><i class="mdi mdi-cog me-1"></i>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center fw-bold">
                                        <span class="badge bg-light text-dark">1</span>
                                    </td>

                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-home-variant text-primary me-2" style="font-size: 1rem;"></i>
                                            <span class="fw-bold">Griya Permata</span>
                                        </div>
                                        <small class="text-muted d-block d-md-none">
                                            <i class="mdi mdi-map-marker me-1"></i>Jakarta Selatan
                                        </small>
                                    </td>

                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-home-city text-info me-2" style="font-size: 1rem;"></i>
                                            <span>Rumah</span>
                                        </div>
                                    </td>

                                    <td class="d-none d-md-table-cell">
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-map-marker text-danger me-2" style="font-size: 1rem;"></i>
                                            <span>Jakarta Selatan</span>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-currency-usd text-success me-2" style="font-size: 1rem;"></i>
                                            <span class="text-nowrap fw-bold text-success">Rp 1.200.000.000</span>
                                        </div>
                                    </td>

                                    <td>
                                        <span class="badge badge-gradient-success">
                                            <i class="mdi mdi-check-circle me-1"></i>Tersedia
                                        </span>
                                    </td>

                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="#" class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip" title="Detail">
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                            <a href="#" class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip" title="Edit">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination UI - DIPERKECIL SEPERTI HALAMAN PROPERTI -->
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-3">
                        <div class="pagination-info mb-2 mb-sm-0">
                            <i class="mdi mdi-information-outline me-1"></i>
                            Menampilkan 1 dari 156 data
                        </div>
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0" style="gap: 2px;">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-label="Previous">
                                        <i class="mdi mdi-chevron-left"></i>
                                    </a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">4</a></li>
                                <li class="page-item"><a class="page-link" href="#">5</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
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

    <!-- Info Tambahan untuk Mobile -->
    <div class="text-muted small mt-2 d-block d-sm-none">
        <i class="mdi mdi-information-outline me-1"></i>
        Geser untuk melihat konten lainnya
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Inisialisasi DataTables - hanya untuk sorting
    let table = $('#tableDashboard').DataTable({
        responsive: true,
        paging: false,
        info: false,
        searching: false,
        lengthChange: false,
        ordering: true,
        language: {
            emptyTable: "Data kosong",
            zeroRecords: "Data tidak ditemukan",
        },
        columnDefs: [
            { orderable: false, targets: [0, 6] }
        ]
    });
});
</script>
@endpush
