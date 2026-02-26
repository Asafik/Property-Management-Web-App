@extends('layouts.partial.app')

@section('title', 'Data Tamu / Prospek - Property Management App')

@section('content')
<style>
/* ===== SEMUA CSS SAMA PERSIS DENGAN HALAMAN CUSTOMER ===== */
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

.btn-outline-success {
    background: transparent;
    border: 1px solid #28a745;
    color: #28a745;
    padding: 0.4rem 0.75rem;
}

.btn-outline-success:hover {
    background: linear-gradient(135deg, #28a745, #5cb85c);
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

.badge-gradient-primary {
    background: linear-gradient(135deg, #9a55ff, #da8cff);
    color: #ffffff;
}

.badge-gradient-secondary {
    background: linear-gradient(135deg, #6c757d, #a5b3cb);
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

/* ===== MODAL STYLING - SAMA PERSIS CUSTOMER ===== */
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

.modal-form-control[readonly] {
    background-color: #f8f9fa;
    border-color: #e9ecef;
    color: #6c757d;
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

/* Status Badge */
.status-aktif {
    background: linear-gradient(135deg, #28a745, #5cb85c);
    color: white;
}

.status-tidak-aktif {
    background: linear-gradient(135deg, #dc3545, #e4606d);
    color: white;
}

.status-pending {
    background: linear-gradient(135deg, #ffc107, #ffdb6d);
    color: #2c2e3f;
}

/* Card Stats */
.stats-card {
    background: linear-gradient(135deg, #f9f7ff, #f2ecff);
    border: none;
    border-radius: 12px;
    padding: 1rem;
    text-align: center;
}

.stats-card .stats-icon {
    width: 48px;
    height: 48px;
    background: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 0.75rem;
}

.stats-card .stats-icon i {
    font-size: 24px;
    color: #9a55ff;
}

.stats-card .stats-label {
    font-size: 0.85rem;
    color: #6c7383;
    margin-bottom: 0.25rem;
}

.stats-card .stats-value {
    font-size: 1.5rem;
    font-weight: 700;
    color: #2c2e3f;
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
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="stats-card">
                <div class="stats-icon">
                    <i class="mdi mdi-account-multiple"></i>
                </div>
                <div class="stats-label">Total Tamu</div>
                <div class="stats-value">156</div>
                <small class="text-muted">Semua tamu</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stats-card">
                <div class="stats-icon">
                    <i class="mdi mdi-fire"></i>
                </div>
                <div class="stats-label">Hot Prospek</div>
                <div class="stats-value">42</div>
                <small class="text-muted">Siap beli</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stats-card">
                <div class="stats-icon">
                    <i class="mdi mdi-calendar-today"></i>
                </div>
                <div class="stats-label">Kunjungan Hari Ini</div>
                <div class="stats-value">12</div>
                <small class="text-muted">+3 dari kemarin</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stats-card">
                <div class="stats-icon">
                    <i class="mdi mdi-phone-log"></i>
                </div>
                <div class="stats-label">Follow Up Hari Ini</div>
                <div class="stats-value">8</div>
                <small class="text-muted">Belum dilakukan</small>
            </div>
        </div>
    </div>

    <!-- Tabel Data Tamu -->
    <div class="row mt-2 mt-sm-2 mt-md-3">
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
                                                <small class="text-muted d-block">ahmad.s@email.com</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>0812-3456-7890</td>
                                    <td>
                                        <span class="badge bg-light text-dark">
                                            <i class="mdi mdi-instagram me-1"></i>Instagram
                                        </span>
                                    </td>
                                    <td>
                                        Tipe 36/72
                                        <small class="text-muted d-block">Cluster Emerald</small>
                                    </td>
                                    <td><i class="mdi mdi-account-tie text-primary me-1"></i>Ahmad Fauzi</td>
                                    <td><span class="badge badge-hot"><i class="mdi mdi-fire me-1"></i>Hot</span></td>
                                    <td>
                                        <small>Besok, 10:00</small>
                                        <small class="text-muted d-block"><i class="mdi mdi-phone-outline me-1"></i>Telepon</small>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <button class="btn btn-outline-primary btn-sm" title="Lihat Detail" onclick="$('#modalDetailTamu').modal('show')">
                                                <i class="mdi mdi-eye"></i>
                                            </button>
                                            <button class="btn btn-outline-success btn-sm" title="Konversi ke Customer">
                                                <i class="mdi mdi-account-convert"></i>
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
                                                <small class="text-muted d-block">rina.n@email.com</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>0856-7890-1234</td>
                                    <td>
                                        <span class="badge bg-light text-dark">
                                            <i class="mdi mdi-facebook me-1"></i>Facebook
                                        </span>
                                    </td>
                                    <td>
                                        Tipe 45/90
                                        <small class="text-muted d-block">Cluster Sapphire</small>
                                    </td>
                                    <td><i class="mdi mdi-account-tie text-primary me-1"></i>Siti Aminah</td>
                                    <td><span class="badge badge-warm"><i class="mdi mdi-weather-sunny me-1"></i>Warm</span></td>
                                    <td>
                                        <small>3 hari lagi</small>
                                        <small class="text-muted d-block"><i class="mdi mdi-whatsapp me-1"></i>WA</small>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <button class="btn btn-outline-primary btn-sm" title="Lihat Detail">
                                                <i class="mdi mdi-eye"></i>
                                            </button>
                                            <button class="btn btn-outline-success btn-sm" title="Konversi ke Customer">
                                                <i class="mdi mdi-account-convert"></i>
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
                                                <small class="text-muted d-block">budi.p@email.com</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>0813-4567-8901</td>
                                    <td>
                                        <span class="badge bg-light text-dark">
                                            <i class="mdi mdi-web me-1"></i>Iklan Online
                                        </span>
                                    </td>
                                    <td>
                                        Tipe 60/120
                                        <small class="text-muted d-block">Cluster Ruby</small>
                                    </td>
                                    <td><i class="mdi mdi-account-tie text-primary me-1"></i>Budi Santoso</td>
                                    <td><span class="badge badge-cold"><i class="mdi mdi-snowflake me-1"></i>Cold</span></td>
                                    <td>
                                        <small>Minggu depan</small>
                                        <small class="text-muted d-block"><i class="mdi mdi-email me-1"></i>Email</small>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <button class="btn btn-outline-primary btn-sm" title="Lihat Detail">
                                                <i class="mdi mdi-eye"></i>
                                            </button>
                                            <button class="btn btn-outline-success btn-sm" title="Konversi ke Customer">
                                                <i class="mdi mdi-account-convert"></i>
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
                                                <small class="text-muted d-block">dewi.s@email.com</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>0821-6789-0123</td>
                                    <td>
                                        <span class="badge bg-light text-dark">
                                            <i class="mdi mdi-store me-1"></i>Walk-in
                                        </span>
                                    </td>
                                    <td>
                                        Tipe 36/72
                                        <small class="text-muted d-block">Cluster Emerald</small>
                                    </td>
                                    <td><i class="mdi mdi-account-tie text-primary me-1"></i>Ahmad Fauzi</td>
                                    <td><span class="badge badge-warm"><i class="mdi mdi-weather-sunny me-1"></i>Warm</span></td>
                                    <td>
                                        <small>Hari ini</small>
                                        <small class="text-muted d-block"><i class="mdi mdi-phone-outline me-1"></i>Telepon</small>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <button class="btn btn-outline-primary btn-sm" title="Lihat Detail">
                                                <i class="mdi mdi-eye"></i>
                                            </button>
                                            <button class="btn btn-outline-success btn-sm" title="Konversi ke Customer">
                                                <i class="mdi mdi-account-convert"></i>
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
                                                <small class="text-muted d-block">m.hakim@email.com</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>0857-8901-2345</td>
                                    <td>
                                        <span class="badge bg-light text-dark">
                                            <i class="mdi mdi-account-multiple me-1"></i>Referensi
                                        </span>
                                    </td>
                                    <td>
                                        Tipe 45/90
                                        <small class="text-muted d-block">Cluster Sapphire</small>
                                    </td>
                                    <td><i class="mdi mdi-account-tie text-primary me-1"></i>Siti Aminah</td>
                                    <td><span class="badge badge-hot"><i class="mdi mdi-fire me-1"></i>Hot</span></td>
                                    <td>
                                        <small>2 hari lagi</small>
                                        <small class="text-muted d-block"><i class="mdi mdi-whatsapp me-1"></i>WA</small>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <button class="btn btn-outline-primary btn-sm" title="Lihat Detail">
                                                <i class="mdi mdi-eye"></i>
                                            </button>
                                            <button class="btn btn-outline-success btn-sm" title="Konversi ke Customer">
                                                <i class="mdi mdi-account-convert"></i>
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
                        <a href="{{ route('dashboard') }}" class="btn btn-gradient-secondary">
                            <i class="mdi mdi-arrow-left me-1"></i>Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL DETAIL TAMU - SAMA PERSIS DENGAN CUSTOMER -->
<div class="modal fade" id="modalDetailTamu" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="mdi mdi-account-details me-2" style="color: #9a55ff;"></i>
                    Detail Tamu
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <div class="avatar-circle mx-auto mb-3" style="width: 80px; height: 80px; font-size: 32px;">
                        AS
                    </div>
                    <h5 class="fw-bold mb-1">Ahmad Syarif</h5>
                    <span class="badge badge-hot"><i class="mdi mdi-fire me-1"></i>Hot Prospek</span>
                </div>

                <div class="list-group">
                    <div class="list-group-item border-0 ps-0 d-flex">
                        <i class="mdi mdi-phone me-3 text-primary" style="font-size: 20px;"></i>
                        <div>
                            <small class="text-muted d-block">No. HP</small>
                            <span class="fw-bold">0812-3456-7890</span>
                        </div>
                    </div>
                    <div class="list-group-item border-0 ps-0 d-flex">
                        <i class="mdi mdi-email me-3 text-primary" style="font-size: 20px;"></i>
                        <div>
                            <small class="text-muted d-block">Email</small>
                            <span class="fw-bold">ahmad.s@email.com</span>
                        </div>
                    </div>
                    <div class="list-group-item border-0 ps-0 d-flex">
                        <i class="mdi mdi-source-branch me-3 text-primary" style="font-size: 20px;"></i>
                        <div>
                            <small class="text-muted d-block">Sumber Informasi</small>
                            <span class="fw-bold">Instagram</span>
                        </div>
                    </div>
                    <div class="list-group-item border-0 ps-0 d-flex">
                        <i class="mdi mdi-account-tie me-3 text-primary" style="font-size: 20px;"></i>
                        <div>
                            <small class="text-muted d-block">Agent</small>
                            <span class="fw-bold">Ahmad Fauzi</span>
                        </div>
                    </div>
                    <div class="list-group-item border-0 ps-0 d-flex">
                        <i class="mdi mdi-home-group me-3 text-primary" style="font-size: 20px;"></i>
                        <div>
                            <small class="text-muted d-block">Minat Unit</small>
                            <span class="fw-bold">Tipe 36/72 - Cluster Emerald</span>
                        </div>
                    </div>
                    <div class="list-group-item border-0 ps-0 d-flex">
                        <i class="mdi mdi-currency-usd me-3 text-primary" style="font-size: 20px;"></i>
                        <div>
                            <small class="text-muted d-block">Budget</small>
                            <span class="fw-bold">Rp 500.000.000</span>
                        </div>
                    </div>
                    <div class="list-group-item border-0 ps-0 d-flex">
                        <i class="mdi mdi-calendar me-3 text-primary" style="font-size: 20px;"></i>
                        <div>
                            <small class="text-muted d-block">Tanggal Kunjungan</small>
                            <span class="fw-bold">25 Februari 2025</span>
                        </div>
                    </div>
                    <div class="list-group-item border-0 ps-0 d-flex">
                        <i class="mdi mdi-note-text me-3 text-primary" style="font-size: 20px;"></i>
                        <div>
                            <small class="text-muted d-block">Catatan</small>
                            <span class="fw-bold">Tertarik dengan unit hook, akan survey lokasi</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">
                    <i class="mdi mdi-close me-1"></i>Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL IMPORT TAMU - SAMA PERSIS DENGAN CUSTOMER -->
<div class="modal fade" id="modalImportTamu" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="mdi mdi-import me-2" style="color: #9a55ff;"></i>
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
                    <label><i class="mdi mdi-file-upload me-1 text-primary"></i>Upload File Excel</label>
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

<!-- MODAL EXPORT TAMU - SAMA PERSIS DENGAN CUSTOMER -->
<div class="modal fade" id="modalExportTamu" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="mdi mdi-export me-2" style="color: #9a55ff;"></i>
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
                    <label><i class="mdi mdi-filter-outline me-1 text-primary"></i>Filter Data yang Diexport</label>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        Swal.fire({
            title: 'Hapus Tamu?',
            text: "Data tamu yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    icon: 'success',
                    title: 'Terhapus!',
                    text: 'Data tamu berhasil dihapus.',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    };
});

// SWAL SESSION
@if (session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: "{{ session('success') }}",
        showConfirmButton: false,
        timer: 2000
    });
@endif

@if (session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: "{{ session('error') }}",
        confirmButtonColor: '#d33'
    });
@endif

@if ($errors->any())
    Swal.fire({
        icon: 'warning',
        title: 'Validasi Gagal',
        html: `{!! implode('<br>', $errors->all()) !!}`
    });
@endif
</script>
@endpush
