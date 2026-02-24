@extends('layouts.partial.app')

@section('title', 'Manajemen Promo - Property Management App')

@section('content')
<style>
/* ===== SEMUA CSS SAMA PERSIS DENGAN HALAMAN BANK ===== */
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

/* ===== FILTER SECTION ===== */
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

.btn-gradient-success {
    background: linear-gradient(135deg, #28a745, #5cb85c) !important;
    color: #ffffff !important;
}

.btn-gradient-danger {
    background: linear-gradient(135deg, #dc3545, #e4606d) !important;
    color: #ffffff !important;
}

.btn-gradient-warning {
    background: linear-gradient(135deg, #ffc107, #ffdb6d) !important;
    color: #2c2e3f !important;
}

.btn-gradient-info {
    background: linear-gradient(135deg, #17a2b8, #5bc0de) !important;
    color: #ffffff !important;
}

/* Outline Buttons */
.btn-outline-warning {
    background: transparent;
    border: 1px solid #ffc107;
    color: #ffc107;
    padding: 0.4rem 0.75rem;
}

.btn-outline-warning:hover {
    background: linear-gradient(135deg, #ffc107, #ffdb6d);
    color: #2c2e3f;
    border-color: transparent;
}

.btn-outline-danger {
    background: transparent;
    border: 1px solid #dc3545;
    color: #dc3545;
    padding: 0.4rem 0.75rem;
}

.btn-outline-danger:hover {
    background: linear-gradient(135deg, #dc3545, #e4606d);
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

.badge-gradient-info {
    background: linear-gradient(135deg, #17a2b8, #5bc0de);
    color: #ffffff;
}

.badge-gradient-primary {
    background: linear-gradient(135deg, #9a55ff, #da8cff);
    color: #ffffff;
}

.badge-gradient-secondary {
    background: linear-gradient(135deg, #6c757d, #a5b3cb);
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

/* ===== PAGINATION STYLING ===== */
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

/* ===== MODAL STYLING ===== */
.modal-content {
    border: none;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.modal-header {
    background: linear-gradient(135deg, #ffffff, #f8f9fa);
    border-bottom: 1px solid #e9ecef;
    padding: 1rem;
    border-radius: 16px 16px 0 0;
}

.modal-title {
    font-size: 1rem;
    font-weight: 700;
    color: #9a55ff;
}

.modal-body {
    padding: 1.2rem;
}

.modal-footer {
    border-top: 1px solid #e9ecef;
    padding: 1rem;
    border-radius: 0 0 16px 16px;
}

.modal-form-group {
    margin-bottom: 1rem;
}

.modal-form-group label {
    font-size: 0.85rem;
    font-weight: 600;
    color: #9a55ff !important;
    margin-bottom: 0.3rem;
    letter-spacing: 0.3px;
    font-family: 'Nunito', sans-serif;
    display: block;
}

.modal-form-control {
    border: 1px solid #e9ecef;
    border-radius: 8px;
    padding: 0.6rem 0.8rem;
    font-size: 0.9rem;
    transition: all 0.2s ease;
    background-color: #ffffff;
    color: #2c2e3f;
    width: 100%;
}

.modal-form-control:focus {
    border-color: #9a55ff;
    box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.1);
    outline: none;
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

/* ===== RESPONSIVE ===== */
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
}

/* DataTables Custom Styling */
.dataTables_filter,
.dataTables_length,
.dataTables_paginate,
.dataTables_info {
    display: none !important;
}

.sorting, .sorting_asc, .sorting_desc {
    cursor: pointer;
}

.mdi {
    vertical-align: middle;
}
</style>

<div class="container-fluid p-2 p-sm-3 p-md-4">
    <!-- Header Dashboard -->
    <div class="row mb-3 mb-sm-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="text-dark mb-1">
                            <i class="mdi mdi-tag-multiple me-2" style="color: #9a55ff;"></i>
                            Manajemen Promo & Biaya Tambahan
                        </h3>
                        <p class="text-muted mb-0">
                            <i class="mdi mdi-information-outline me-1"></i>
                            Kelola promo, diskon, dan biaya tambahan seperti PPN, kanopi, pagar, dll
                        </p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-percent" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Data Promo -->
    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                    <h5 class="card-title mb-2 mb-md-0">
                        <i class="mdi mdi-format-list-bulleted me-2 text-primary"></i>
                        Daftar Promo & Biaya Tambahan
                    </h5>
                    <div class="d-flex gap-2">
                        <button class="btn btn-sm btn-gradient-primary" onclick="$('#modalTambahPromo').modal('show')">
                            <i class="mdi mdi-plus me-1"></i><span class="d-none d-sm-inline">Tambah Promo</span>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Filter Section -->
                    <div class="filter-card">
                        <div class="card-body">
                            <h6 class="card-title mb-3" style="font-size: 1rem;">
                                <i class="mdi mdi-filter-outline me-1"></i>Filter Data
                            </h6>

                            <!-- FILTER UNTUK MOBILE -->
                            <div class="d-block d-md-none">
                                <div class="mb-3">
                                    <label class="form-label">
                                        <i class="mdi mdi-magnify me-1"></i>Cari Promo
                                    </label>
                                    <input type="text" class="form-control" placeholder="Cari nama promo...">
                                </div>

                                <div class="row g-2">
                                    <div class="col-6">
                                        <label class="form-label">
                                            <i class="mdi mdi-shape-outline me-1"></i>Kategori
                                        </label>
                                        <select class="form-control">
                                            <option value="">Semua</option>
                                            <option value="promo">Promo Diskon</option>
                                            <option value="biaya">Biaya Tambahan</option>
                                            <option value="fasilitas">Fasilitas</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">
                                            <i class="mdi mdi-counter me-1"></i>Tampil
                                        </label>
                                        <select class="form-control">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row g-2 mt-2">
                                    <div class="col-6">
                                        <button type="button" class="btn btn-gradient-primary w-100">
                                            <i class="mdi mdi-filter me-1"></i> Filter
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-gradient-secondary w-100">
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
                                            <i class="mdi mdi-magnify me-1"></i>Cari Promo
                                        </label>
                                        <input type="text" class="form-control" placeholder="Cari nama promo...">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">
                                            <i class="mdi mdi-shape-outline me-1"></i>Kategori
                                        </label>
                                        <select class="form-control">
                                            <option value="">Semua</option>
                                            <option value="promo">Promo Diskon</option>
                                            <option value="biaya">Biaya Tambahan</option>
                                            <option value="fasilitas">Fasilitas</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">
                                            <i class="mdi mdi-counter me-1"></i>Tampil
                                        </label>
                                        <select class="form-control">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-gradient-primary w-100">
                                            <i class="mdi mdi-filter me-1"></i> Filter
                                        </button>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-gradient-secondary w-100 btn-icon-only" title="Reset">
                                            <i class="mdi mdi-refresh"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel Promo -->
                    <div class="table-responsive">
                        <table class="table table-hover" id="tablePromo" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center"><i class="mdi mdi-counter me-1"></i>No</th>
                                    <th><i class="mdi mdi-tag me-1"></i>Nama Promo</th>
                                    <th><i class="mdi mdi-shape-outline me-1"></i>Kategori</th>
                                    <th><i class="mdi mdi-calculator me-1"></i>Tipe</th>
                                    <th><i class="mdi mdi-currency-usd me-1"></i>Nilai</th>
                                    <th><i class="mdi mdi-calendar me-1"></i>Berlaku</th>
                                    <th><i class="mdi mdi-flag me-1"></i>Status</th>
                                    <th class="text-center"><i class="mdi mdi-cog me-1"></i>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- PROMO DISKON -->
                                <tr>
                                    <td class="text-center fw-bold">1</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-sale text-primary me-2" style="font-size: 1rem;"></i>
                                            <span class="fw-bold">Diskon 10% Early Bird</span>
                                        </div>
                                    </td>
                                    <td>Promo Diskon</td>
                                    <td>Persentase</td>
                                    <td>10%</td>
                                    <td>01-31 Mar 2026</td>
                                    <td><span class="badge badge-gradient-success"><i class="mdi mdi-check-circle me-1"></i>Aktif</span></td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <button class="btn btn-outline-warning btn-sm" title="Edit">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                            <button class="btn btn-outline-danger btn-sm" title="Hapus">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-center fw-bold">2</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-gift text-primary me-2" style="font-size: 1rem;"></i>
                                            <span class="fw-bold">Diskon Spesial Lebaran</span>
                                        </div>
                                    </td>
                                    <td>Promo Diskon</td>
                                    <td>Persentase</td>
                                    <td>15%</td>
                                    <td>01-30 Apr 2026</td>
                                    <td><span class="badge badge-gradient-warning"><i class="mdi mdi-clock-outline me-1"></i>Akan Datang</span></td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <button class="btn btn-outline-warning btn-sm" title="Edit">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                            <button class="btn btn-outline-danger btn-sm" title="Hapus">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-center fw-bold">3</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-cash-multiple text-primary me-2" style="font-size: 1rem;"></i>
                                            <span class="fw-bold">Cashback 5 Juta</span>
                                        </div>
                                    </td>
                                    <td>Promo Diskon</td>
                                    <td>Nominal</td>
                                    <td>Rp 5.000.000</td>
                                    <td>01 Feb - 31 Mar 2026</td>
                                    <td><span class="badge badge-gradient-success"><i class="mdi mdi-check-circle me-1"></i>Aktif</span></td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <button class="btn btn-outline-warning btn-sm" title="Edit">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                            <button class="btn btn-outline-danger btn-sm" title="Hapus">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- BIAYA TAMBAHAN -->
                                <tr>
                                    <td class="text-center fw-bold">4</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-cash-plus text-primary me-2" style="font-size: 1rem;"></i>
                                            <span class="fw-bold">PPN (Pajak Pertambahan Nilai)</span>
                                        </div>
                                    </td>
                                    <td>Biaya Tambahan</td>
                                    <td>Persentase</td>
                                    <td>11%</td>
                                    <td>Selalu</td>
                                    <td><span class="badge badge-gradient-success"><i class="mdi mdi-check-circle me-1"></i>Aktif</span></td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <button class="btn btn-outline-warning btn-sm" title="Edit">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                            <button class="btn btn-outline-danger btn-sm" title="Hapus">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-center fw-bold">5</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-cash text-primary me-2" style="font-size: 1rem;"></i>
                                            <span class="fw-bold">Biaya Administrasi</span>
                                        </div>
                                    </td>
                                    <td>Biaya Tambahan</td>
                                    <td>Nominal</td>
                                    <td>Rp 500.000</td>
                                    <td>Selalu</td>
                                    <td><span class="badge badge-gradient-success"><i class="mdi mdi-check-circle me-1"></i>Aktif</span></td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <button class="btn btn-outline-warning btn-sm" title="Edit">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                            <button class="btn btn-outline-danger btn-sm" title="Hapus">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-center fw-bold">6</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-file-document text-primary me-2" style="font-size: 1rem;"></i>
                                            <span class="fw-bold">Biaya Notaris</span>
                                        </div>
                                    </td>
                                    <td>Biaya Tambahan</td>
                                    <td>Nominal</td>
                                    <td>Rp 3.500.000</td>
                                    <td>Selalu</td>
                                    <td><span class="badge badge-gradient-success"><i class="mdi mdi-check-circle me-1"></i>Aktif</span></td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <button class="btn btn-outline-warning btn-sm" title="Edit">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                            <button class="btn btn-outline-danger btn-sm" title="Hapus">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-center fw-bold">7</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-home text-primary me-2" style="font-size: 1rem;"></i>
                                            <span class="fw-bold">Biaya Balik Nama</span>
                                        </div>
                                    </td>
                                    <td>Biaya Tambahan</td>
                                    <td>Nominal</td>
                                    <td>Rp 2.500.000</td>
                                    <td>Selalu</td>
                                    <td><span class="badge badge-gradient-warning"><i class="mdi mdi-clock-outline me-1"></i>Non-Aktif</span></td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <button class="btn btn-outline-warning btn-sm" title="Edit">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                            <button class="btn btn-outline-danger btn-sm" title="Hapus">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- FASILITAS TAMBAHAN -->
                                <tr>
                                    <td class="text-center fw-bold">8</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-fence text-primary me-2" style="font-size: 1rem;"></i>
                                            <span class="fw-bold">Pagar Depan Minimalis</span>
                                        </div>
                                    </td>
                                    <td>Fasilitas</td>
                                    <td>Nominal</td>
                                    <td>Rp 5.000.000</td>
                                    <td>Selalu</td>
                                    <td><span class="badge badge-gradient-success"><i class="mdi mdi-check-circle me-1"></i>Aktif</span></td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <button class="btn btn-outline-warning btn-sm" title="Edit">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                            <button class="btn btn-outline-danger btn-sm" title="Hapus">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-center fw-bold">9</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-weather-sunny text-primary me-2" style="font-size: 1rem;"></i>
                                            <span class="fw-bold">Kanopi Baja Ringan</span>
                                        </div>
                                    </td>
                                    <td>Fasilitas</td>
                                    <td>Nominal</td>
                                    <td>Rp 7.500.000</td>
                                    <td>Selalu</td>
                                    <td><span class="badge badge-gradient-success"><i class="mdi mdi-check-circle me-1"></i>Aktif</span></td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <button class="btn btn-outline-warning btn-sm" title="Edit">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                            <button class="btn btn-outline-danger btn-sm" title="Hapus">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-center fw-bold">10</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-floor-plan text-primary me-2" style="font-size: 1rem;"></i>
                                            <span class="fw-bold">Keramik Tambahan</span>
                                        </div>
                                    </td>
                                    <td>Fasilitas</td>
                                    <td>Nominal</td>
                                    <td>Rp 3.500.000</td>
                                    <td>Selalu</td>
                                    <td><span class="badge badge-gradient-success"><i class="mdi mdi-check-circle me-1"></i>Aktif</span></td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <button class="btn btn-outline-warning btn-sm" title="Edit">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                            <button class="btn btn-outline-danger btn-sm" title="Hapus">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-center fw-bold">11</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-washing-machine text-primary me-2" style="font-size: 1rem;"></i>
                                            <span class="fw-bold">Instalasi Listrik Tambahan</span>
                                        </div>
                                    </td>
                                    <td>Fasilitas</td>
                                    <td>Nominal</td>
                                    <td>Rp 2.500.000</td>
                                    <td>Selalu</td>
                                    <td><span class="badge badge-gradient-success"><i class="mdi mdi-check-circle me-1"></i>Aktif</span></td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <button class="btn btn-outline-warning btn-sm" title="Edit">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                            <button class="btn btn-outline-danger btn-sm" title="Hapus">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-center fw-bold">12</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-water text-primary me-2" style="font-size: 1rem;"></i>
                                            <span class="fw-bold">Instalasi Air Tambahan</span>
                                        </div>
                                    </td>
                                    <td>Fasilitas</td>
                                    <td>Nominal</td>
                                    <td>Rp 1.800.000</td>
                                    <td>Selalu</td>
                                    <td><span class="badge badge-gradient-success"><i class="mdi mdi-check-circle me-1"></i>Aktif</span></td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <button class="btn btn-outline-warning btn-sm" title="Edit">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                            <button class="btn btn-outline-danger btn-sm" title="Hapus">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-center fw-bold">13</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-door text-primary me-2" style="font-size: 1rem;"></i>
                                            <span class="fw-bold">Pintu Tambahan</span>
                                        </div>
                                    </td>
                                    <td>Fasilitas</td>
                                    <td>Nominal</td>
                                    <td>Rp 2.200.000</td>
                                    <td>Selalu</td>
                                    <td><span class="badge badge-gradient-success"><i class="mdi mdi-check-circle me-1"></i>Aktif</span></td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <button class="btn btn-outline-warning btn-sm" title="Edit">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                            <button class="btn btn-outline-danger btn-sm" title="Hapus">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-center fw-bold">14</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-lamp text-primary me-2" style="font-size: 1rem;"></i>
                                            <span class="fw-bold">Lampu Taman</span>
                                        </div>
                                    </td>
                                    <td>Fasilitas</td>
                                    <td>Nominal</td>
                                    <td>Rp 1.200.000</td>
                                    <td>Selalu</td>
                                    <td><span class="badge badge-gradient-warning"><i class="mdi mdi-clock-outline me-1"></i>Non-Aktif</span></td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <button class="btn btn-outline-warning btn-sm" title="Edit">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                            <button class="btn btn-outline-danger btn-sm" title="Hapus">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination UI -->
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-3">
                        <div class="pagination-info mb-2 mb-sm-0">
                            <i class="mdi mdi-information-outline me-1"></i>
                            Menampilkan 1 - 14 dari 14 data
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

    <!-- Tombol Aksi Bawah -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-3">
                    <div class="d-flex flex-column flex-sm-row justify-content-start">
                        <a href="{{ route('dashboard') }}" class="btn btn-gradient-secondary">
                            <i class="mdi mdi-arrow-left me-1"></i>Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL TAMBAH PROMO -->
<div class="modal fade" id="modalTambahPromo" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="mdi mdi-tag-plus me-2" style="color: #9a55ff;"></i>
                    Tambah Promo / Biaya Baru
                </h5>
                <button type="button" class="btn-close" onclick="$('#modalTambahPromo').modal('hide')" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-tag me-1"></i>Nama Promo
                                </label>
                                <input type="text" name="nama_promo" class="modal-form-control" placeholder="Contoh: Diskon Early Bird">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-shape-outline me-1"></i>Kategori
                                </label>
                                <select class="modal-form-control" name="kategori">
                                    <option value="promo">Promo Diskon</option>
                                    <option value="biaya">Biaya Tambahan</option>
                                    <option value="fasilitas">Fasilitas</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-calculator me-1"></i>Tipe
                                </label>
                                <select class="modal-form-control" name="tipe" id="tipePromo">
                                    <option value="persen">Persentase (%)</option>
                                    <option value="nominal">Nominal (Rp)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-currency-usd me-1"></i>Nilai
                                </label>
                                <input type="text" name="nilai" class="modal-form-control" id="nilaiPromo" placeholder="Contoh: 10 atau 500000">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-calendar me-1"></i>Berlaku
                                </label>
                                <select class="modal-form-control" name="berlaku" id="berlaku">
                                    <option value="selalu">Selalu</option>
                                    <option value="periode">Periode Tertentu</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="periodeContainer" style="display: none;">
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-calendar-start me-1"></i>Tanggal Mulai
                                </label>
                                <input type="date" name="tanggal_mulai" class="modal-form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-calendar-end me-1"></i>Tanggal Berakhir
                                </label>
                                <input type="date" name="tanggal_berakhir" class="modal-form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-note-text me-1"></i>Keterangan
                                </label>
                                <textarea name="keterangan" class="modal-form-control" rows="3" placeholder="Deskripsi promo..."></textarea>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-gradient-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- MODAL EDIT PROMO -->
<div class="modal fade" id="modalEditPromo" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="mdi mdi-pencil me-2" style="color: #9a55ff;"></i>
                    Edit Promo
                </h5>
                <button type="button" class="btn-close" onclick="$('#modalEditPromo').modal('hide')" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-tag me-1"></i>Nama Promo
                                </label>
                                <input type="text" name="nama_promo" class="modal-form-control" value="Diskon 10% Early Bird">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-shape-outline me-1"></i>Kategori
                                </label>
                                <select class="modal-form-control" name="kategori">
                                    <option value="promo" selected>Promo Diskon</option>
                                    <option value="biaya">Biaya Tambahan</option>
                                    <option value="fasilitas">Fasilitas</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-calculator me-1"></i>Tipe
                                </label>
                                <select class="modal-form-control" name="tipe">
                                    <option value="persen" selected>Persentase (%)</option>
                                    <option value="nominal">Nominal (Rp)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-currency-usd me-1"></i>Nilai
                                </label>
                                <input type="text" name="nilai" class="modal-form-control" value="10">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-calendar me-1"></i>Berlaku
                                </label>
                                <select class="modal-form-control" name="berlaku">
                                    <option value="selalu">Selalu</option>
                                    <option value="periode" selected>Periode Tertentu</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-calendar-start me-1"></i>Tanggal Mulai
                                </label>
                                <input type="date" name="tanggal_mulai" class="modal-form-control" value="2026-03-01">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-calendar-end me-1"></i>Tanggal Berakhir
                                </label>
                                <input type="date" name="tanggal_berakhir" class="modal-form-control" value="2026-03-31">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-note-text me-1"></i>Keterangan
                                </label>
                                <textarea name="keterangan" class="modal-form-control" rows="3">Diskon khusus untuk pembelian early bird</textarea>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-gradient-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    // Inisialisasi DataTables - hanya untuk sorting
    let table = $('#tablePromo').DataTable({
        responsive: true,
        paging: false,
        info: false,
        searching: false,
        lengthChange: false,
        ordering: true,
        language: {
            emptyTable: "Data promo belum tersedia",
            zeroRecords: "Data tidak ditemukan",
        },
        columnDefs: [
            { orderable: false, targets: [7] }
        ]
    });

    // Toggle periode berdasarkan pilihan
    $('#berlaku').change(function() {
        if ($(this).val() === 'periode') {
            $('#periodeContainer').show();
        } else {
            $('#periodeContainer').hide();
        }
    });

    // Format Rupiah untuk input nilai jika tipe nominal
    $('#tipePromo').change(function() {
        let nilaiInput = $('#nilaiPromo');
        if ($(this).val() === 'nominal') {
            nilaiInput.attr('placeholder', 'Contoh: 500000');
        } else {
            nilaiInput.attr('placeholder', 'Contoh: 10');
        }
    });

    // Format Rupiah on input (hanya untuk modal)
    $('#nilaiPromo').on('input', function() {
        if ($('#tipePromo').val() === 'nominal') {
            let nilai = this.value.replace(/\D/g, '');
            if (nilai) {
                let rupiah = new Intl.NumberFormat('id-ID').format(nilai);
                this.value = rupiah;
            }
        }
    });

    // Handle edit button click (demo)
    $('.btn-outline-warning').click(function() {
        let row = $(this).closest('tr');
        let namaPromo = row.find('td:eq(1) span.fw-bold').text();

        Swal.fire({
            title: 'Edit Promo',
            text: 'Fitur edit untuk "' + namaPromo + '" akan segera tersedia',
            icon: 'info',
            timer: 2000,
            showConfirmButton: false
        });
    });

    // Handle delete button click (demo)
    $('.btn-outline-danger').click(function() {
        let row = $(this).closest('tr');
        let namaPromo = row.find('td:eq(1) span.fw-bold').text();

        Swal.fire({
            title: 'Hapus Promo?',
            text: "Promo " + namaPromo + " akan dihapus",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Promo telah dihapus.',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });
            }
        });
    });
});
</script>
@endpush
@endsection
