@extends('layouts.partial.app')

@section('title', 'Data Tamu / Prospek - Property Management App')

@section('content')
<style>
/* ===== SEMUA CSS SAMA PERSIS DENGAN HALAMAN SEBELUMNYA ===== */
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

.bg-gradient-warning {
    background: linear-gradient(135deg, #ffc107, #ffdb6d) !important;
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

.btn-outline-info {
    background: transparent;
    border: 1px solid #17a2b8;
    color: #17a2b8;
    padding: 0.4rem 0.75rem;
}

.btn-outline-info:hover {
    background: linear-gradient(135deg, #17a2b8, #5bc0de);
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

/* Status Prospek Badge */
.badge-hot {
    background: linear-gradient(135deg, #dc3545, #e4606d);
    color: white;
}

.badge-warm {
    background: linear-gradient(135deg, #ffc107, #ffdb6d);
    color: #2c2e3f;
}

.badge-cold {
    background: linear-gradient(135deg, #6c757d, #a5b3cb);
    color: white;
}

/* ===== AVATAR STYLING ===== */
.avatar-circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 16px;
    color: white;
    background: linear-gradient(135deg, #da8cff, #9a55ff);
    flex-shrink: 0;
}

@media (min-width: 576px) {
    .avatar-circle {
        width: 45px;
        height: 45px;
        font-size: 18px;
    }
}

.avatar-sm {
    width: 32px;
    height: 32px;
    font-size: 14px;
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

/* ===== MODAL STYLING ===== */
.modal-content {
    border: none;
    border-radius: 20px;
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    overflow: hidden;
}

.modal-header {
    background: linear-gradient(135deg, #f9f7ff, #f2ecff);
    border-bottom: 1px solid rgba(154, 85, 255, 0.1);
    padding: 1.2rem 1.5rem;
    border-radius: 20px 20px 0 0;
}

.modal-title {
    font-size: 1.2rem;
    font-weight: 700;
    color: #9a55ff;
    display: flex;
    align-items: center;
    gap: 8px;
}

.modal-title i {
    font-size: 1.4rem;
}

.modal-body {
    padding: 1.8rem 1.5rem;
    background: #ffffff;
}

.modal-footer {
    border-top: 1px solid #e9ecef;
    padding: 1.2rem 1.5rem;
    border-radius: 0 0 20px 20px;
    background: #f8f9fa;
}

.modal-form-group {
    margin-bottom: 1.5rem;
}

.modal-form-group label {
    font-size: 0.9rem;
    font-weight: 600;
    color: #9a55ff !important;
    margin-bottom: 0.5rem;
    letter-spacing: 0.3px;
    font-family: 'Nunito', sans-serif;
    display: flex;
    align-items: center;
    gap: 6px;
}

.modal-form-group label i {
    font-size: 1.1rem;
}

.modal-form-control {
    border: 1px solid #e9ecef;
    border-radius: 12px;
    padding: 0.8rem 1rem;
    font-size: 0.95rem;
    transition: all 0.2s ease;
    background-color: #ffffff;
    color: #2c2e3f;
    width: 100%;
}

.modal-form-control:focus {
    border-color: #9a55ff;
    box-shadow: 0 0 0 4px rgba(154, 85, 255, 0.1);
    outline: none;
}

.modal-form-control[readonly] {
    background-color: #f8f9fa;
    border-color: #e9ecef;
    color: #6c757d;
}

.modal .btn-close {
    background: transparent;
    opacity: 0.7;
    transition: all 0.2s ease;
    padding: 0.5rem;
    border-radius: 8px;
}

.modal .btn-close:hover {
    opacity: 1;
    background: rgba(154, 85, 255, 0.1);
    transform: rotate(90deg);
}

/* Modal divider */
.modal-divider {
    height: 1px;
    background: linear-gradient(to right, transparent, #9a55ff, transparent);
    margin: 1.5rem 0;
    opacity: 0.2;
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

    .modal-header {
        padding: 1rem;
    }

    .modal-body {
        padding: 1.2rem;
    }

    .modal-footer {
        padding: 1rem;
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
                            <i class="mdi mdi-account-multiple me-2" style="color: #9a55ff;"></i>
                            Data Tamu / Prospek
                        </h3>
                        <p class="text-muted mb-0">
                            <i class="mdi mdi-information-outline me-1"></i>
                            Kelola data pengunjung dan calon pembeli unit properti
                        </p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-account-group" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                    </div>
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
                        Total Tamu
                        <i class="mdi mdi-account-group float-end" style="font-size: 1.2rem;"></i>
                    </h4>
                    <h2 class="mb-2 mb-sm-2 mb-md-4 fs-5 fs-sm-5 fs-md-2">156</h2>
                    <h6 class="card-text small">Semua tamu</h6>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-6 col-md-6 col-lg-3 mb-2 mb-sm-2 mb-md-3">
            <div class="card bg-gradient-danger card-img-holder text-white h-100">
                <div class="card-body p-2 p-sm-2 p-md-3">
                    <img src="{{ asset('admin/assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-2 mb-sm-2 mb-md-3 small fs-6 fs-sm-6 fs-md-5">
                        Hot Prospek
                        <i class="mdi mdi-fire float-end" style="font-size: 1.2rem;"></i>
                    </h4>
                    <h2 class="mb-2 mb-sm-2 mb-md-4 fs-5 fs-sm-5 fs-md-2">42</h2>
                    <h6 class="card-text small">Siap beli</h6>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-6 col-md-6 col-lg-3 mb-2 mb-sm-2 mb-md-3">
            <div class="card bg-gradient-warning card-img-holder text-white h-100">
                <div class="card-body p-2 p-sm-2 p-md-3">
                    <img src="{{ asset('admin/assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-2 mb-sm-2 mb-md-3 small fs-6 fs-sm-6 fs-md-5">
                        Kunjungan Hari Ini
                        <i class="mdi mdi-calendar-today float-end" style="font-size: 1.2rem;"></i>
                    </h4>
                    <h2 class="mb-2 mb-sm-2 mb-md-4 fs-5 fs-sm-5 fs-md-2">12</h2>
                    <h6 class="card-text small">+3 dari kemarin</h6>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-6 col-md-6 col-lg-3 mb-2 mb-sm-2 mb-md-3">
            <div class="card bg-gradient-info card-img-holder text-white h-100">
                <div class="card-body p-2 p-sm-2 p-md-3">
                    <img src="{{ asset('admin/assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-2 mb-sm-2 mb-md-3 small fs-6 fs-sm-6 fs-md-5">
                        Follow Up Hari Ini
                        <i class="mdi mdi-phone-log float-end" style="font-size: 1.2rem;"></i>
                    </h4>
                    <h2 class="mb-2 mb-sm-2 mb-md-4 fs-5 fs-sm-5 fs-md-2">8</h2>
                    <h6 class="card-text small">Belum dilakukan</h6>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Data Tamu -->
    <div class="row mt-4 mt-sm-4 mt-md-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                    <h5 class="card-title mb-2 mb-md-0">
                        <i class="mdi mdi-format-list-bulleted me-2 text-primary"></i>
                        Daftar Tamu / Prospek
                    </h5>
                    <div class="d-flex gap-2">
                        <button class="btn btn-sm btn-gradient-success" onclick="$('#modalImportTamu').modal('show')">
                            <i class="mdi mdi-import me-1"></i><span class="d-none d-sm-inline">Import</span>
                        </button>
                        <button class="btn btn-sm btn-gradient-danger" onclick="$('#modalExportTamu').modal('show')">
                            <i class="mdi mdi-export me-1"></i><span class="d-none d-sm-inline">Export</span>
                        </button>
                        <button class="btn btn-sm btn-gradient-primary" onclick="$('#modalTambahTamu').modal('show')">
                            <i class="mdi mdi-plus me-1"></i><span class="d-none d-sm-inline">Tambah Tamu</span>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Filter Section -->
                    <div class="filter-card">
                        <div class="card-body">
                            <h6 class="card-title mb-3" style="font-size: 1rem;">
                                <i class="mdi mdi-filter-outline me-1"></i>Filter Data Tamu
                            </h6>

                            <!-- FILTER UNTUK MOBILE -->
                            <div class="d-block d-md-none">
                                <div class="mb-3">
                                    <label class="form-label">
                                        <i class="mdi mdi-magnify me-1"></i>Cari Tamu
                                    </label>
                                    <input type="text" class="form-control" placeholder="Cari nama, no. HP...">
                                </div>

                                <div class="row g-2">
                                    <div class="col-6">
                                        <label class="form-label">
                                            <i class="mdi mdi-source-branch me-1"></i>Sumber Info
                                        </label>
                                        <select class="form-control">
                                            <option value="">Semua</option>
                                            <option value="instagram">Instagram</option>
                                            <option value="facebook">Facebook</option>
                                            <option value="iklan">Iklan</option>
                                            <option value="referensi">Referensi</option>
                                            <option value="walk-in">Walk-in</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">
                                            <i class="mdi mdi-chart-arc me-1"></i>Status Prospek
                                        </label>
                                        <select class="form-control">
                                            <option value="">Semua</option>
                                            <option value="hot">Hot</option>
                                            <option value="warm">Warm</option>
                                            <option value="cold">Cold</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row g-2 mt-2">
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
                                    <div class="col-6 d-flex align-items-end">
                                        <button type="button" class="btn btn-gradient-secondary w-100">
                                            <i class="mdi mdi-refresh me-1"></i> Reset
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- FILTER UNTUK TABLET & DESKTOP -->
                            <div class="d-none d-md-block">
                                <div class="row g-2 align-items-end">
                                    <div class="col-md-3">
                                        <label class="form-label">
                                            <i class="mdi mdi-magnify me-1"></i>Cari Tamu
                                        </label>
                                        <input type="text" class="form-control" placeholder="Nama, No. HP...">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">
                                            <i class="mdi mdi-source-branch me-1"></i>Sumber Info
                                        </label>
                                        <select class="form-control">
                                            <option value="">Semua</option>
                                            <option value="instagram">Instagram</option>
                                            <option value="facebook">Facebook</option>
                                            <option value="iklan">Iklan</option>
                                            <option value="referensi">Referensi</option>
                                            <option value="walk-in">Walk-in</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">
                                            <i class="mdi mdi-chart-arc me-1"></i>Status Prospek
                                        </label>
                                        <select class="form-control">
                                            <option value="">Semua</option>
                                            <option value="hot">Hot</option>
                                            <option value="warm">Warm</option>
                                            <option value="cold">Cold</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">
                                            <i class="mdi mdi-account-tie me-1"></i>Agent
                                        </label>
                                        <select class="form-control">
                                            <option value="">Semua</option>
                                            <option value="1">Ahmad Fauzi</option>
                                            <option value="2">Siti Aminah</option>
                                            <option value="3">Budi Santoso</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1">
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
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-gradient-primary w-100">
                                            <i class="mdi mdi-filter"></i>
                                        </button>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-gradient-secondary w-100" title="Reset">
                                            <i class="mdi mdi-refresh"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel Tamu -->
                    <div class="table-responsive">
                        <table class="table table-hover" id="tableTamu" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center"><i class="mdi mdi-counter me-1"></i>No</th>
                                    <th><i class="mdi mdi-account me-1"></i>Nama Tamu</th>
                                    <th><i class="mdi mdi-phone me-1"></i>Kontak</th>
                                    <th><i class="mdi mdi-source-branch me-1"></i>Sumber Info</th>
                                    <th><i class="mdi mdi-home-group me-1"></i>Minat Unit</th>
                                    <th><i class="mdi mdi-account-tie me-1"></i>Agent</th>
                                    <th><i class="mdi mdi-chart-arc me-1"></i>Status</th>
                                    <th><i class="mdi mdi-calendar-clock me-1"></i>Follow Up</th>
                                    <th class="text-center"><i class="mdi mdi-cog me-1"></i>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Tamu 1 - Hot Prospek -->
                                <tr>
                                    <td class="text-center fw-bold">1</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle avatar-sm me-2">
                                                AS
                                            </div>
                                            <div>
                                                <span class="fw-bold">Ahmad Syarif</span>
                                                <small class="text-muted d-block"><i class="mdi mdi-email-outline me-1" style="font-size: 10px;"></i>ahmad.s@email.com</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <i class="mdi mdi-whatsapp text-success me-1"></i>0812-3456-7890
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark">
                                            <i class="mdi mdi-instagram me-1"></i>Instagram
                                        </span>
                                    </td>
                                    <td>
                                        <span class="fw-bold">Tipe 36/72</span>
                                        <small class="text-muted d-block">Cluster Emerald</small>
                                    </td>
                                    <td>
                                        <i class="mdi mdi-account-tie text-primary me-1"></i>Ahmad Fauzi
                                    </td>
                                    <td>
                                        <span class="badge badge-hot"><i class="mdi mdi-fire me-1"></i>Hot</span>
                                    </td>
                                    <td>
                                        <small class="d-block"><i class="mdi mdi-calendar me-1"></i>Besok, 10:00</small>
                                        <small class="text-muted"><i class="mdi mdi-phone-outline me-1"></i>Telepon</small>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <button class="btn btn-outline-info btn-sm" title="Follow Up" onclick="$('#modalFollowUp').modal('show')">
                                                <i class="mdi mdi-phone-log"></i>
                                            </button>
                                            <button class="btn btn-outline-success btn-sm" title="Konversi ke Customer">
                                                <i class="mdi mdi-account-convert"></i>
                                            </button>
                                            <button class="btn btn-outline-warning btn-sm" title="Edit" onclick="$('#modalEditTamu').modal('show')">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                            <button class="btn btn-outline-danger btn-sm" title="Hapus" onclick="confirmDelete()">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Tamu 2 - Warm Prospek -->
                                <tr>
                                    <td class="text-center fw-bold">2</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle avatar-sm me-2" style="background: linear-gradient(135deg, #ff6b6b, #ee5253);">
                                                RN
                                            </div>
                                            <div>
                                                <span class="fw-bold">Rina Nugraha</span>
                                                <small class="text-muted d-block"><i class="mdi mdi-email-outline me-1" style="font-size: 10px;"></i>rina.n@email.com</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <i class="mdi mdi-whatsapp text-success me-1"></i>0856-7890-1234
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark">
                                            <i class="mdi mdi-facebook me-1"></i>Facebook
                                        </span>
                                    </td>
                                    <td>
                                        <span class="fw-bold">Tipe 45/90</span>
                                        <small class="text-muted d-block">Cluster Sapphire</small>
                                    </td>
                                    <td>
                                        <i class="mdi mdi-account-tie text-primary me-1"></i>Siti Aminah
                                    </td>
                                    <td>
                                        <span class="badge badge-warm"><i class="mdi mdi-weather-sunny me-1"></i>Warm</span>
                                    </td>
                                    <td>
                                        <small class="d-block"><i class="mdi mdi-calendar me-1"></i>3 hari lagi</small>
                                        <small class="text-muted"><i class="mdi mdi-whatsapp me-1"></i>WA</small>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <button class="btn btn-outline-info btn-sm" title="Follow Up">
                                                <i class="mdi mdi-phone-log"></i>
                                            </button>
                                            <button class="btn btn-outline-success btn-sm" title="Konversi ke Customer">
                                                <i class="mdi mdi-account-convert"></i>
                                            </button>
                                            <button class="btn btn-outline-warning btn-sm" title="Edit">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                            <button class="btn btn-outline-danger btn-sm" title="Hapus">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Tamu 3 - Cold Prospek -->
                                <tr>
                                    <td class="text-center fw-bold">3</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle avatar-sm me-2" style="background: linear-gradient(135deg, #48dbfb, #0abde3);">
                                                BP
                                            </div>
                                            <div>
                                                <span class="fw-bold">Budi Pratama</span>
                                                <small class="text-muted d-block"><i class="mdi mdi-email-outline me-1" style="font-size: 10px;"></i>budi.p@email.com</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <i class="mdi mdi-phone text-primary me-1"></i>0813-4567-8901
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark">
                                            <i class="mdi mdi-web me-1"></i>Iklan Online
                                        </span>
                                    </td>
                                    <td>
                                        <span class="fw-bold">Tipe 60/120</span>
                                        <small class="text-muted d-block">Cluster Ruby</small>
                                    </td>
                                    <td>
                                        <i class="mdi mdi-account-tie text-primary me-1"></i>Budi Santoso
                                    </td>
                                    <td>
                                        <span class="badge badge-cold"><i class="mdi mdi-snowflake me-1"></i>Cold</span>
                                    </td>
                                    <td>
                                        <small class="d-block"><i class="mdi mdi-calendar me-1"></i>Minggu depan</small>
                                        <small class="text-muted"><i class="mdi mdi-email me-1"></i>Email</small>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <button class="btn btn-outline-info btn-sm" title="Follow Up">
                                                <i class="mdi mdi-phone-log"></i>
                                            </button>
                                            <button class="btn btn-outline-success btn-sm" title="Konversi ke Customer">
                                                <i class="mdi mdi-account-convert"></i>
                                            </button>
                                            <button class="btn btn-outline-warning btn-sm" title="Edit">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                            <button class="btn btn-outline-danger btn-sm" title="Hapus">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Tamu 4 - Walk-in -->
                                <tr>
                                    <td class="text-center fw-bold">4</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle avatar-sm me-2" style="background: linear-gradient(135deg, #feca57, #ff9f43);">
                                                DS
                                            </div>
                                            <div>
                                                <span class="fw-bold">Dewi Sartika</span>
                                                <small class="text-muted d-block"><i class="mdi mdi-email-outline me-1" style="font-size: 10px;"></i>dewi.s@email.com</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <i class="mdi mdi-whatsapp text-success me-1"></i>0821-6789-0123
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark">
                                            <i class="mdi mdi-store me-1"></i>Walk-in
                                        </span>
                                    </td>
                                    <td>
                                        <span class="fw-bold">Tipe 36/72</span>
                                        <small class="text-muted d-block">Cluster Emerald</small>
                                    </td>
                                    <td>
                                        <i class="mdi mdi-account-tie text-primary me-1"></i>Ahmad Fauzi
                                    </td>
                                    <td>
                                        <span class="badge badge-warm"><i class="mdi mdi-weather-sunny me-1"></i>Warm</span>
                                    </td>
                                    <td>
                                        <small class="d-block"><i class="mdi mdi-calendar me-1"></i>Hari ini</small>
                                        <small class="text-muted"><i class="mdi mdi-phone-outline me-1"></i>Telepon</small>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <button class="btn btn-outline-info btn-sm" title="Follow Up">
                                                <i class="mdi mdi-phone-log"></i>
                                            </button>
                                            <button class="btn btn-outline-success btn-sm" title="Konversi ke Customer">
                                                <i class="mdi mdi-account-convert"></i>
                                            </button>
                                            <button class="btn btn-outline-warning btn-sm" title="Edit">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                            <button class="btn btn-outline-danger btn-sm" title="Hapus">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Tamu 5 - Referensi -->
                                <tr>
                                    <td class="text-center fw-bold">5</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle avatar-sm me-2" style="background: linear-gradient(135deg, #ff9ff3, #f368e0);">
                                                MH
                                            </div>
                                            <div>
                                                <span class="fw-bold">Muhammad Hakim</span>
                                                <small class="text-muted d-block"><i class="mdi mdi-email-outline me-1" style="font-size: 10px;"></i>m.hakim@email.com</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <i class="mdi mdi-whatsapp text-success me-1"></i>0857-8901-2345
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark">
                                            <i class="mdi mdi-account-multiple me-1"></i>Referensi
                                        </span>
                                    </td>
                                    <td>
                                        <span class="fw-bold">Tipe 45/90</span>
                                        <small class="text-muted d-block">Cluster Sapphire</small>
                                    </td>
                                    <td>
                                        <i class="mdi mdi-account-tie text-primary me-1"></i>Siti Aminah
                                    </td>
                                    <td>
                                        <span class="badge badge-hot"><i class="mdi mdi-fire me-1"></i>Hot</span>
                                    </td>
                                    <td>
                                        <small class="d-block"><i class="mdi mdi-calendar me-1"></i>2 hari lagi</small>
                                        <small class="text-muted"><i class="mdi mdi-whatsapp me-1"></i>WA</small>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <button class="btn btn-outline-info btn-sm" title="Follow Up">
                                                <i class="mdi mdi-phone-log"></i>
                                            </button>
                                            <button class="btn btn-outline-success btn-sm" title="Konversi ke Customer">
                                                <i class="mdi mdi-account-convert"></i>
                                            </button>
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

                    <!-- Pagination -->
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-3">
                        <div class="pagination-info mb-2 mb-sm-0">
                            <i class="mdi mdi-information-outline me-1"></i>
                            Menampilkan 1 - 5 dari 156 data
                        </div>
                        <div>
                            <nav>
                                <ul class="pagination">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1"><i class="mdi mdi-chevron-left"></i></a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#"><i class="mdi mdi-chevron-right"></i></a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
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
                    <div class="d-flex flex-wrap gap-2">
                        <a href="dashboard" class="btn btn-gradient-secondary">
                            <i class="mdi mdi-arrow-left me-1"></i>Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL TAMBAH TAMU -->
<div class="modal fade" id="modalTambahTamu" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="mdi mdi-account-plus"></i>
                    Tambah Tamu Baru
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label><i class="mdi mdi-account text-primary"></i>Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="modal-form-control" placeholder="Contoh: Ahmad Syarif" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label><i class="mdi mdi-phone text-primary"></i>No. HP <span class="text-danger">*</span></label>
                                <input type="text" class="modal-form-control" placeholder="Contoh: 081234567890" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label><i class="mdi mdi-email text-primary"></i>Email</label>
                                <input type="email" class="modal-form-control" placeholder="Contoh: email@domain.com">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label><i class="mdi mdi-source-branch text-primary"></i>Sumber Informasi</label>
                                <select class="modal-form-control">
                                    <option value="">-- Pilih Sumber --</option>
                                    <option value="instagram">Instagram</option>
                                    <option value="facebook">Facebook</option>
                                    <option value="tiktok">TikTok</option>
                                    <option value="iklan">Iklan Online</option>
                                    <option value="referensi">Referensi</option>
                                    <option value="walk-in">Walk-in</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label><i class="mdi mdi-account-tie text-primary"></i>Agent</label>
                                <select class="modal-form-control">
                                    <option value="">-- Pilih Agent --</option>
                                    <option value="1">Ahmad Fauzi</option>
                                    <option value="2">Siti Aminah</option>
                                    <option value="3">Budi Santoso</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label><i class="mdi mdi-chart-arc text-primary"></i>Status Prospek</label>
                                <select class="modal-form-control">
                                    <option value="hot">Hot</option>
                                    <option value="warm" selected>Warm</option>
                                    <option value="cold">Cold</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label><i class="mdi mdi-office-building text-primary"></i>Proyek Minat</label>
                                <select class="modal-form-control">
                                    <option value="">-- Pilih Proyek --</option>
                                    <option value="emerald">Cluster Emerald</option>
                                    <option value="sapphire">Cluster Sapphire</option>
                                    <option value="ruby">Cluster Ruby</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label><i class="mdi mdi-home-group text-primary"></i>Tipe Unit</label>
                                <select class="modal-form-control">
                                    <option value="">-- Pilih Tipe --</option>
                                    <option value="36/72">Tipe 36/72</option>
                                    <option value="45/90">Tipe 45/90</option>
                                    <option value="60/120">Tipe 60/120</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-form-group">
                        <label><i class="mdi mdi-currency-usd text-primary"></i>Budget (Rp)</label>
                        <input type="text" class="modal-form-control" placeholder="Contoh: 500.000.000">
                    </div>

                    <div class="modal-form-group">
                        <label><i class="mdi mdi-note-text text-primary"></i>Catatan</label>
                        <textarea class="modal-form-control" rows="2" placeholder="Tambahkan catatan tentang tamu..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">
                    <i class="mdi mdi-close me-1"></i>Batal
                </button>
                <button type="button" class="btn btn-gradient-primary">
                    <i class="mdi mdi-content-save me-1"></i>Simpan Tamu
                </button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL EDIT TAMU -->
<div class="modal fade" id="modalEditTamu" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="mdi mdi-account-edit"></i>
                    Edit Data Tamu
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label><i class="mdi mdi-account text-primary"></i>Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="modal-form-control" value="Ahmad Syarif" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label><i class="mdi mdi-phone text-primary"></i>No. HP <span class="text-danger">*</span></label>
                                <input type="text" class="modal-form-control" value="0812-3456-7890" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label><i class="mdi mdi-email text-primary"></i>Email</label>
                                <input type="email" class="modal-form-control" value="ahmad.s@email.com">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label><i class="mdi mdi-source-branch text-primary"></i>Sumber Informasi</label>
                                <select class="modal-form-control">
                                    <option value="instagram" selected>Instagram</option>
                                    <option value="facebook">Facebook</option>
                                    <option value="tiktok">TikTok</option>
                                    <option value="iklan">Iklan Online</option>
                                    <option value="referensi">Referensi</option>
                                    <option value="walk-in">Walk-in</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label><i class="mdi mdi-account-tie text-primary"></i>Agent</label>
                                <select class="modal-form-control">
                                    <option value="1" selected>Ahmad Fauzi</option>
                                    <option value="2">Siti Aminah</option>
                                    <option value="3">Budi Santoso</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label><i class="mdi mdi-chart-arc text-primary"></i>Status Prospek</label>
                                <select class="modal-form-control">
                                    <option value="hot" selected>Hot</option>
                                    <option value="warm">Warm</option>
                                    <option value="cold">Cold</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label><i class="mdi mdi-office-building text-primary"></i>Proyek Minat</label>
                                <select class="modal-form-control">
                                    <option value="emerald" selected>Cluster Emerald</option>
                                    <option value="sapphire">Cluster Sapphire</option>
                                    <option value="ruby">Cluster Ruby</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label><i class="mdi mdi-home-group text-primary"></i>Tipe Unit</label>
                                <select class="modal-form-control">
                                    <option value="36/72" selected>Tipe 36/72</option>
                                    <option value="45/90">Tipe 45/90</option>
                                    <option value="60/120">Tipe 60/120</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-form-group">
                        <label><i class="mdi mdi-currency-usd text-primary"></i>Budget (Rp)</label>
                        <input type="text" class="modal-form-control" value="500.000.000">
                    </div>

                    <div class="modal-form-group">
                        <label><i class="mdi mdi-note-text text-primary"></i>Catatan</label>
                        <textarea class="modal-form-control" rows="2">Tertarik dengan unit hook, akan survey lokasi</textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">
                    <i class="mdi mdi-close me-1"></i>Batal
                </button>
                <button type="button" class="btn btn-gradient-primary">
                    <i class="mdi mdi-content-save me-1"></i>Update Data
                </button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL FOLLOW UP -->
<div class="modal fade" id="modalFollowUp" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="mdi mdi-phone-log"></i>
                    Follow Up Tamu
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="modal-form-group">
                        <label><i class="mdi mdi-account text-primary"></i>Nama Tamu</label>
                        <input type="text" class="modal-form-control" value="Ahmad Syarif" readonly>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label><i class="mdi mdi-calendar text-primary"></i>Tanggal Follow Up</label>
                                <input type="date" class="modal-form-control" value="2025-02-27">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label><i class="mdi mdi-clock text-primary"></i>Jam</label>
                                <input type="time" class="modal-form-control" value="10:00">
                            </div>
                        </div>
                    </div>

                    <div class="modal-form-group">
                        <label><i class="mdi mdi-phone-outline text-primary"></i>Metode Follow Up</label>
                        <select class="modal-form-control">
                            <option value="telepon">Telepon</option>
                            <option value="whatsapp">WhatsApp</option>
                            <option value="email">Email</option>
                            <option value="sms">SMS</option>
                        </select>
                    </div>

                    <div class="modal-form-group">
                        <label><i class="mdi mdi-note-text text-primary"></i>Catatan Follow Up</label>
                        <textarea class="modal-form-control" rows="3" placeholder="Hasil follow up..."></textarea>
                    </div>

                    <div class="modal-divider"></div>

                    <div class="modal-form-group">
                        <label><i class="mdi mdi-calendar-clock text-primary"></i>Jadwal Follow Up Berikutnya</label>
                        <input type="date" class="modal-form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">
                    <i class="mdi mdi-close me-1"></i>Batal
                </button>
                <button type="button" class="btn btn-gradient-primary">
                    <i class="mdi mdi-content-save me-1"></i>Simpan Follow Up
                </button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL IMPORT TAMU -->
<div class="modal fade" id="modalImportTamu" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="mdi mdi-import"></i>
                    Import Data Tamu
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <i class="mdi mdi-file-excel" style="font-size: 64px; color: #28a745;"></i>
                    <h6 class="mt-3">Import dari file Excel</h6>
                    <p class="text-muted small">Download template terlebih dahulu untuk memudahkan import data</p>
                </div>

                <div class="d-flex gap-2 mb-4">
                    <a href="#" class="btn btn-outline-success w-50">
                        <i class="mdi mdi-download me-1"></i>Download Template
                    </a>
                    <a href="#" class="btn btn-outline-info w-50">
                        <i class="mdi mdi-eye me-1"></i>Lihat Contoh
                    </a>
                </div>

                <div class="modal-form-group">
                    <label><i class="mdi mdi-file-upload text-primary"></i>Upload File Excel</label>
                    <input type="file" class="modal-form-control" accept=".xlsx,.xls,.csv">
                    <small class="text-muted">Format: .xlsx, .xls, .csv (Max 5MB)</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">
                    <i class="mdi mdi-close me-1"></i>Batal
                </button>
                <button type="button" class="btn btn-gradient-success">
                    <i class="mdi mdi-import me-1"></i>Import Data
                </button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL EXPORT TAMU -->
<div class="modal fade" id="modalExportTamu" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="mdi mdi-export"></i>
                    Export Data Tamu
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <i class="mdi mdi-file-download" style="font-size: 64px; color: #9a55ff;"></i>
                    <h6 class="mt-3">Pilih format export</h6>
                </div>

                <div class="d-flex gap-3 justify-content-center">
                    <button class="btn btn-outline-success p-3" style="width: 100px;">
                        <i class="mdi mdi-file-excel" style="font-size: 32px;"></i>
                        <span class="d-block small mt-2">Excel</span>
                    </button>
                    <button class="btn btn-outline-danger p-3" style="width: 100px;">
                        <i class="mdi mdi-file-pdf" style="font-size: 32px;"></i>
                        <span class="d-block small mt-2">PDF</span>
                    </button>
                    <button class="btn btn-outline-primary p-3" style="width: 100px;">
                        <i class="mdi mdi-file-delimited" style="font-size: 32px;"></i>
                        <span class="d-block small mt-2">CSV</span>
                    </button>
                </div>

                <hr class="my-4">

                <div class="modal-form-group">
                    <label><i class="mdi mdi-filter-outline text-primary"></i>Filter Data yang Diexport</label>
                    <select class="modal-form-control">
                        <option value="semua">Semua Tamu</option>
                        <option value="hot">Hot Prospek</option>
                        <option value="warm">Warm Prospek</option>
                        <option value="cold">Cold Prospek</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">
                    <i class="mdi mdi-close me-1"></i>Batal
                </button>
                <button type="button" class="btn btn-gradient-primary">
                    <i class="mdi mdi-export me-1"></i>Export Data
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // CEK TABEL DATA
    let hasData = $('#tableTamu tbody tr').length > 0;

    if ($.fn.DataTable.isDataTable('#tableTamu')) {
        $('#tableTamu').DataTable().destroy();
    }

    if (hasData) {
        let table = $('#tableTamu').DataTable({
            responsive: true,
            paging: false,
            info: false,
            searching: false,
            lengthChange: false,
            ordering: true,
            language: {
                emptyTable: "Data tamu belum tersedia",
                zeroRecords: "Data tidak ditemukan",
            },
            columnDefs: [
                { targets: 0, orderable: false },
                { targets: 8, orderable: false }
            ]
        });
    }

    // DELETE CONFIRMATION
    window.confirmDelete = function() {
        if (confirm('Apakah Anda yakin ingin menghapus data tamu ini?')) {
            alert('Data tamu berhasil dihapus (demo)');
        }
    };
});
</script>
@endpush
