@extends('layouts.partial.app')

@section('title', 'Dokumen Izin - Property Management App')

@section('content')
<style>
/* ===== SEMUA CSS SAMA PERSIS DENGAN HALAMAN PROMO ===== */
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

/* ===== FILE UPLOAD MODERN STYLING ===== */
.file-upload-modern {
    position: relative;
    width: 100%;
    margin-bottom: 1rem;
}

.file-upload-modern input[type="file"] {
    position: absolute;
    opacity: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
    z-index: 2;
}

.file-upload-label {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    gap: 8px;
    padding: 1.5rem 1rem;
    background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
    border: 2px dashed #d0d4db;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
}

@media (min-width: 576px) {
    .file-upload-label {
        flex-direction: row;
        text-align: left;
        gap: 12px;
        padding: 1rem 1.5rem;
    }
}

.file-upload-modern:hover .file-upload-label {
    border-color: #9a55ff;
    background: linear-gradient(135deg, #f1f0ff, #f8f9fa);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(154, 85, 255, 0.1);
}

.file-upload-label i {
    font-size: 2rem;
    color: #9a55ff;
    background: rgba(154, 85, 255, 0.1);
    padding: 12px;
    border-radius: 50%;
}

.file-upload-info {
    flex: 1;
}

.file-upload-info span {
    display: block;
    font-weight: 600;
    color: #2c2e3f;
    font-size: 0.9rem;
    margin-bottom: 4px;
}

.file-upload-info small {
    color: #6c7383;
    font-size: 0.75rem;
    display: block;
}

.file-upload-size {
    font-size: 0.8rem;
    color: #9a55ff;
    font-weight: 600;
    background: rgba(154, 85, 255, 0.1);
    padding: 6px 12px;
    border-radius: 20px;
    white-space: nowrap;
}

/* Dokumen Card */
.dokumen-card {
    border: 1px solid #e9ecef;
    border-radius: 12px;
    padding: 1.25rem;
    margin-bottom: 1rem;
    background: white;
    transition: all 0.3s ease;
}

.dokumen-card:hover {
    border-color: #9a55ff;
    box-shadow: 0 4px 12px rgba(154, 85, 255, 0.1);
}

.dokumen-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1rem;
}

.dokumen-icon {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, #f9f7ff, #f2ecff);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.dokumen-icon i {
    font-size: 24px;
    color: #9a55ff;
}

.dokumen-title {
    flex: 1;
}

.dokumen-title h6 {
    font-size: 1rem;
    font-weight: 600;
    color: #2c2e3f;
    margin-bottom: 0.25rem;
}

.dokumen-title p {
    font-size: 0.8rem;
    color: #6c7383;
    margin-bottom: 0;
}

.dokumen-title .required {
    color: #dc3545;
    margin-left: 4px;
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
                            <i class="mdi mdi-file-document-multiple me-2" style="color: #9a55ff;"></i>
                            Dokumen Izin
                        </h3>
                        <p class="text-muted mb-0">
                            <i class="mdi mdi-information-outline me-1"></i>
                            Kelola dokumen perizinan proyek seperti IMB, AMDAL, Izin Cut and Fill, dll
                        </p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-file-document" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Data Dokumen Izin -->
    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                    <h5 class="card-title mb-2 mb-md-0">
                        <i class="mdi mdi-format-list-bulleted me-2 text-primary"></i>
                        Daftar Dokumen Izin
                    </h5>
                    <div class="d-flex gap-2">
                        <button class="btn btn-sm btn-gradient-primary" onclick="$('#modalUploadDokumen').modal('show')">
                            <i class="mdi mdi-upload me-1"></i><span class="d-none d-sm-inline">Upload Dokumen</span>
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
                                        <i class="mdi mdi-magnify me-1"></i>Cari Dokumen
                                    </label>
                                    <input type="text" class="form-control" placeholder="Cari nama dokumen...">
                                </div>

                                <div class="row g-2">
                                    <div class="col-6">
                                        <label class="form-label">
                                            <i class="mdi mdi-shape-outline me-1"></i>Jenis Izin
                                        </label>
                                        <select class="form-control">
                                            <option value="">Semua</option>
                                            <option value="imb">IMB</option>
                                            <option value="amdal">AMDAL</option>
                                            <option value="cutfill">Izin Cut and Fill</option>
                                            <option value="lokasi">Izin Lokasi</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">
                                            <i class="mdi mdi-flag me-1"></i>Status
                                        </label>
                                        <select class="form-control">
                                            <option value="">Semua</option>
                                            <option value="lengkap">Lengkap</option>
                                            <option value="proses">Diproses</option>
                                            <option value="kurang">Kurang</option>
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
                                    <div class="col-md-4">
                                        <label class="form-label">
                                            <i class="mdi mdi-magnify me-1"></i>Cari Dokumen
                                        </label>
                                        <input type="text" class="form-control" placeholder="Cari nama dokumen...">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">
                                            <i class="mdi mdi-shape-outline me-1"></i>Jenis Izin
                                        </label>
                                        <select class="form-control">
                                            <option value="">Semua</option>
                                            <option value="imb">IMB</option>
                                            <option value="amdal">AMDAL</option>
                                            <option value="cutfill">Izin Cut and Fill</option>
                                            <option value="lokasi">Izin Lokasi</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">
                                            <i class="mdi mdi-flag me-1"></i>Status
                                        </label>
                                        <select class="form-control">
                                            <option value="">Semua</option>
                                            <option value="lengkap">Lengkap</option>
                                            <option value="proses">Diproses</option>
                                            <option value="kurang">Kurang</option>
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

                    <!-- Tabel Dokumen Izin -->
                    <div class="table-responsive">
                        <table class="table table-hover" id="tableDokumen" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center"><i class="mdi mdi-counter me-1"></i>No</th>
                                    <th><i class="mdi mdi-file-document me-1"></i>Nama Dokumen</th>
                                    <th><i class="mdi mdi-shape-outline me-1"></i>Jenis Izin</th>
                                    <th><i class="mdi mdi-domain me-1"></i>Instansi Penerbit</th>
                                    <th><i class="mdi mdi-calendar me-1"></i>Tanggal Terbit</th>
                                    <th><i class="mdi mdi-calendar-clock me-1"></i>Masa Berlaku</th>
                                    <th><i class="mdi mdi-flag me-1"></i>Status</th>
                                    <th class="text-center"><i class="mdi mdi-cog me-1"></i>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Dokumen 1 - IMB -->
                                <tr>
                                    <td class="text-center fw-bold">1</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-domain text-primary me-2" style="font-size: 1rem;"></i>
                                            <span class="fw-bold">Izin Mendirikan Bangunan (IMB)</span>
                                        </div>
                                        <small class="text-muted">No. 648/123/IMB/DPMPTSP/2025</small>
                                    </td>
                                    <td>IMB</td>
                                    <td>DPMPTSP Jakarta Selatan</td>
                                    <td>15 Jan 2025</td>
                                    <td>15 Jan 2045</td>
                                    <td><span class="badge badge-gradient-success"><i class="mdi mdi-check-circle me-1"></i>Lengkap</span></td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <button class="btn btn-outline-primary btn-sm" title="Lihat">
                                                <i class="mdi mdi-eye"></i>
                                            </button>
                                            <button class="btn btn-outline-info btn-sm" title="Download">
                                                <i class="mdi mdi-download"></i>
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

                                <!-- Dokumen 2 - AMDAL -->
                                <tr>
                                    <td class="text-center fw-bold">2</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-leaf text-primary me-2" style="font-size: 1rem;"></i>
                                            <span class="fw-bold">AMDAL / UKL-UPL</span>
                                        </div>
                                        <small class="text-muted">No. 660/456/AMDAL/DLH/2025</small>
                                    </td>
                                    <td>AMDAL</td>
                                    <td>Dinas Lingkungan Hidup</td>
                                    <td>20 Feb 2025</td>
                                    <td>-</td>
                                    <td><span class="badge badge-gradient-success"><i class="mdi mdi-check-circle me-1"></i>Lengkap</span></td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <button class="btn btn-outline-primary btn-sm" title="Lihat">
                                                <i class="mdi mdi-eye"></i>
                                            </button>
                                            <button class="btn btn-outline-info btn-sm" title="Download">
                                                <i class="mdi mdi-download"></i>
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

                                <!-- Dokumen 3 - Izin Cut and Fill -->
                                <tr>
                                    <td class="text-center fw-bold">3</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-tools text-primary me-2" style="font-size: 1rem;"></i>
                                            <span class="fw-bold">Izin Cut and Fill / Pematangan Lahan</span>
                                        </div>
                                        <small class="text-muted">No. 503/789/IZIN-CF/DPUPR/2025</small>
                                    </td>
                                    <td>Izin Cut and Fill</td>
                                    <td>Dinas PUPR</td>
                                    <td>10 Mar 2025</td>
                                    <td>10 Mar 2026</td>
                                    <td><span class="badge badge-gradient-warning"><i class="mdi mdi-clock-outline me-1"></i>Diproses</span></td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <button class="btn btn-outline-primary btn-sm" title="Lihat">
                                                <i class="mdi mdi-eye"></i>
                                            </button>
                                            <button class="btn btn-outline-info btn-sm" title="Download">
                                                <i class="mdi mdi-download"></i>
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

                                <!-- Dokumen 4 - Izin Lokasi -->
                                <tr>
                                    <td class="text-center fw-bold">4</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-map-marker text-primary me-2" style="font-size: 1rem;"></i>
                                            <span class="fw-bold">Izin Lokasi / Izin Prinsip</span>
                                        </div>
                                        <small class="text-muted">No. 590/234/IZIN-LOK/BKPM/2024</small>
                                    </td>
                                    <td>Izin Lokasi</td>
                                    <td>BKPM / DPMPTSP</td>
                                    <td>05 Des 2024</td>
                                    <td>05 Des 2026</td>
                                    <td><span class="badge badge-gradient-success"><i class="mdi mdi-check-circle me-1"></i>Lengkap</span></td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <button class="btn btn-outline-primary btn-sm" title="Lihat">
                                                <i class="mdi mdi-eye"></i>
                                            </button>
                                            <button class="btn btn-outline-info btn-sm" title="Download">
                                                <i class="mdi mdi-download"></i>
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

                                <!-- Dokumen 5 - Rekomendasi Teknis -->
                                <tr>
                                    <td class="text-center fw-bold">5</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-file-check text-primary me-2" style="font-size: 1rem;"></i>
                                            <span class="fw-bold">Rekomendasi Teknis Cut and Fill</span>
                                        </div>
                                        <small class="text-muted">No. 650/123/REK/DPUPR/2025</small>
                                    </td>
                                    <td>Rekomendasi Teknis</td>
                                    <td>Dinas PUPR</td>
                                                                        <td>Dinas PUPR</td>
                                    <td>22 Mar 2025</td>
                                    <td>-</td>
                                    <td><span class="badge badge-gradient-warning"><i class="mdi mdi-clock-outline me-1"></i>Diproses</span></td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <button class="btn btn-outline-primary btn-sm" title="Lihat">
                                                <i class="mdi mdi-eye"></i>
                                            </button>
                                            <button class="btn btn-outline-info btn-sm" title="Download">
                                                <i class="mdi mdi-download"></i>
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

                                <!-- Dokumen 6 - Izin Pematangan Lahan -->
                                <tr>
                                    <td class="text-center fw-bold">6</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-earth text-primary me-2" style="font-size: 1rem;"></i>
                                            <span class="fw-bold">Izin Pematangan Lahan</span>
                                        </div>
                                        <small class="text-muted">No. 503/567/IPL/DPMPTSP/2025</small>
                                    </td>
                                    <td>Izin Pematangan Lahan</td>
                                    <td>DPMPTSP</td>
                                    <td>01 Apr 2025</td>
                                    <td>01 Apr 2027</td>
                                    <td><span class="badge badge-gradient-info"><i class="mdi mdi-progress-clock me-1"></i>Kurang</span></td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <button class="btn btn-outline-primary btn-sm" title="Lihat">
                                                <i class="mdi mdi-eye"></i>
                                            </button>
                                            <button class="btn btn-outline-info btn-sm" title="Download">
                                                <i class="mdi mdi-download"></i>
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

                                <!-- Dokumen 7 - Persetujuan Bangunan Gedung -->
                                <tr>
                                    <td class="text-center fw-bold">7</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-office-building text-primary me-2" style="font-size: 1rem;"></i>
                                            <span class="fw-bold">Persetujuan Bangunan Gedung (PBG)</span>
                                        </div>
                                        <small class="text-muted">No. 648/890/PBG/DPMPTSP/2025</small>
                                    </td>
                                    <td>PBG</td>
                                    <td>DPMPTSP</td>
                                    <td>12 Apr 2025</td>
                                    <td>-</td>
                                    <td><span class="badge badge-gradient-success"><i class="mdi mdi-check-circle me-1"></i>Lengkap</span></td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <button class="btn btn-outline-primary btn-sm" title="Lihat">
                                                <i class="mdi mdi-eye"></i>
                                            </button>
                                            <button class="btn btn-outline-info btn-sm" title="Download">
                                                <i class="mdi mdi-download"></i>
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

                                <!-- Dokumen 8 - Sertifikat Laik Fungsi -->
                                <tr>
                                    <td class="text-center fw-bold">8</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-certificate text-primary me-2" style="font-size: 1rem;"></i>
                                            <span class="fw-bold">Sertifikat Laik Fungsi (SLF)</span>
                                        </div>
                                        <small class="text-muted">No. 648/1234/SLF/DPMPTSP/2025</small>
                                    </td>
                                    <td>SLF</td>
                                    <td>DPMPTSP</td>
                                    <td>20 Mei 2025</td>
                                    <td>20 Mei 2030</td>
                                    <td><span class="badge badge-gradient-warning"><i class="mdi mdi-clock-outline me-1"></i>Diproses</span></td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <button class="btn btn-outline-primary btn-sm" title="Lihat">
                                                <i class="mdi mdi-eye"></i>
                                            </button>
                                            <button class="btn btn-outline-info btn-sm" title="Download">
                                                <i class="mdi mdi-download"></i>
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

                                <!-- Dokumen 9 - Izin Gangguan -->
                                <tr>
                                    <td class="text-center fw-bold">9</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-alert-circle text-primary me-2" style="font-size: 1rem;"></i>
                                            <span class="fw-bold">Izin Gangguan (HO)</span>
                                        </div>
                                        <small class="text-muted">No. 503/5678/HO/DPMPTSP/2024</small>
                                    </td>
                                    <td>HO</td>
                                    <td>DPMPTSP</td>
                                    <td>10 Nov 2024</td>
                                    <td>10 Nov 2026</td>
                                    <td><span class="badge badge-gradient-success"><i class="mdi mdi-check-circle me-1"></i>Lengkap</span></td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <button class="btn btn-outline-primary btn-sm" title="Lihat">
                                                <i class="mdi mdi-eye"></i>
                                            </button>
                                            <button class="btn btn-outline-info btn-sm" title="Download">
                                                <i class="mdi mdi-download"></i>
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
                            Menampilkan 1 - 9 dari 9 data
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
                        <button class="btn btn-gradient-info" onclick="$('#modalInformasiIzin').modal('show')">
                            <i class="mdi mdi-information-outline me-1"></i>Info Jenis Izin
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL UPLOAD DOKUMEN IZIN -->
<div class="modal fade" id="modalUploadDokumen" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="mdi mdi-upload me-2" style="color: #9a55ff;"></i>
                    Upload Dokumen Izin
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <!-- Jenis Izin -->
                    <div class="modal-form-group">
                        <label><i class="mdi mdi-shape-outline me-1 text-primary"></i>Jenis Izin <span class="text-danger">*</span></label>
                        <select class="modal-form-control" required>
                            <option value="">-- Pilih Jenis Izin --</option>
                            <option value="imb">Izin Mendirikan Bangunan (IMB)</option>
                            <option value="pbg">Persetujuan Bangunan Gedung (PBG)</option>
                            <option value="amdal">AMDAL / UKL-UPL</option>
                            <option value="cutfill">Izin Cut and Fill</option>
                            <option value="lokasi">Izin Lokasi / Izin Prinsip</option>
                            <option value="ho">Izin Gangguan (HO)</option>
                            <option value="slf">Sertifikat Laik Fungsi (SLF)</option>
                        </select>
                    </div>

                    <!-- Nama Dokumen -->
                    <div class="modal-form-group">
                        <label><i class="mdi mdi-file-document me-1 text-primary"></i>Nama Dokumen <span class="text-danger">*</span></label>
                        <input type="text" class="modal-form-control" placeholder="Contoh: IMB Cluster Emerald" required>
                    </div>

                    <!-- Nomor Dokumen -->
                    <div class="modal-form-group">
                        <label><i class="mdi mdi-counter me-1 text-primary"></i>Nomor Dokumen</label>
                        <input type="text" class="modal-form-control" placeholder="Contoh: 648/123/IMB/DPMPTSP/2025">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <!-- Instansi Penerbit -->
                            <div class="modal-form-group">
                                <label><i class="mdi mdi-domain me-1 text-primary"></i>Instansi Penerbit</label>
                                <input type="text" class="modal-form-control" placeholder="Contoh: DPMPTSP Jakarta">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- Tanggal Terbit -->
                            <div class="modal-form-group">
                                <label><i class="mdi mdi-calendar me-1 text-primary"></i>Tanggal Terbit</label>
                                <input type="date" class="modal-form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <!-- Masa Berlaku -->
                            <div class="modal-form-group">
                                <label><i class="mdi mdi-calendar-clock me-1 text-primary"></i>Masa Berlaku</label>
                                <input type="date" class="modal-form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- Status -->
                            <div class="modal-form-group">
                                <label><i class="mdi mdi-flag me-1 text-primary"></i>Status</label>
                                <select class="modal-form-control">
                                    <option value="lengkap">Lengkap</option>
                                    <option value="proses">Diproses</option>
                                    <option value="kurang">Kurang</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Keterangan -->
                    <div class="modal-form-group">
                        <label><i class="mdi mdi-note-text me-1 text-primary"></i>Keterangan</label>
                        <textarea class="modal-form-control" rows="3" placeholder="Tambahkan keterangan jika diperlukan..."></textarea>
                    </div>

                    <!-- Upload File -->
                    <div class="modal-form-group">
                        <label><i class="mdi mdi-file-pdf me-1 text-primary"></i>Upload File Dokumen</label>
                        <div class="file-upload-modern">
                            <input type="file" id="fileDokumen" accept=".pdf,.jpg,.jpeg,.png">
                            <div class="file-upload-label" id="fileUploadLabel">
                                <i class="mdi mdi-cloud-upload"></i>
                                <div class="file-upload-info">
                                    <span id="fileName">Pilih file dokumen</span>
                                    <small>Format: PDF, JPG, PNG (Max 5MB)</small>
                                </div>
                                <span class="file-upload-size" id="fileSize"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">
                    <i class="mdi mdi-close me-1"></i>Batal
                </button>
                <button type="button" class="btn btn-gradient-primary">
                    <i class="mdi mdi-upload me-1"></i>Upload Dokumen
                </button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL INFORMASI JENIS IZIN -->
<div class="modal fade" id="modalInformasiIzin" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="mdi mdi-information-outline me-2" style="color: #9a55ff;"></i>
                    Informasi Jenis Izin Proyek
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="list-group">
                    <div class="list-group-item border-0 ps-0">
                        <h6 class="fw-bold text-primary mb-1"><i class="mdi mdi-domain me-2"></i>IMB / PBG</h6>
                        <p class="text-muted small mb-0">Izin Mendirikan Bangunan / Persetujuan Bangunan Gedung untuk konstruksi properti.</p>
                    </div>
                    <div class="list-group-item border-0 ps-0">
                        <h6 class="fw-bold text-primary mb-1"><i class="mdi mdi-leaf me-2"></i>AMDAL / UKL-UPL</h6>
                        <p class="text-muted small mb-0">Analisis dampak lingkungan untuk proyek pengembangan kawasan.</p>
                    </div>
                    <div class="list-group-item border-0 ps-0">
                        <h6 class="fw-bold text-primary mb-1"><i class="mdi mdi-tools me-2"></i>Izin Cut and Fill</h6>
                        <p class="text-muted small mb-0">Izin untuk kegiatan pemotongan dan penimbunan tanah / pematangan lahan.</p>
                    </div>
                    <div class="list-group-item border-0 ps-0">
                        <h6 class="fw-bold text-primary mb-1"><i class="mdi mdi-map-marker me-2"></i>Izin Lokasi</h6>
                        <p class="text-muted small mb-0">Izin prinsip untuk penggunaan lahan bagi kegiatan usaha/proyek.</p>
                    </div>
                    <div class="list-group-item border-0 ps-0">
                        <h6 class="fw-bold text-primary mb-1"><i class="mdi mdi-certificate me-2"></i>Sertifikat Laik Fungsi (SLF)</h6>
                        <p class="text-muted small mb-0">Sertifikat yang menyatakan bangunan sudah layak fungsi dan aman.</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-gradient-primary" data-bs-dismiss="modal">
                    <i class="mdi mdi-check me-1"></i>Mengerti
                </button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL PREVIEW DOKUMEN -->
<div class="modal fade" id="modalPreviewDokumen" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="mdi mdi-file-eye me-2" style="color: #9a55ff;"></i>
                    Preview Dokumen
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-4">
                <i class="mdi mdi-file-pdf" style="font-size: 64px; color: #dc3545;"></i>
                <h6 class="mt-3">IMB_Cluster_Emerald.pdf</h6>
                <p class="text-muted small">Ukuran: 2.4 MB</p>
                <div class="border rounded p-3 bg-light mt-3">
                    <p class="mb-0 text-muted">Preview dokumen akan ditampilkan di sini</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">
                    <i class="mdi mdi-close me-1"></i>Tutup
                </button>
                <button type="button" class="btn btn-gradient-info">
                    <i class="mdi mdi-download me-1"></i>Download
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
    let hasData = $('#tableDokumen tbody tr').length > 0;

    if ($.fn.DataTable.isDataTable('#tableDokumen')) {
        $('#tableDokumen').DataTable().destroy();
    }

    if (hasData) {
        let table = $('#tableDokumen').DataTable({
            responsive: true,
            paging: false,
            info: false,
            searching: false,
            lengthChange: false,
            ordering: true,
            language: {
                emptyTable: "Data dokumen izin belum tersedia",
                zeroRecords: "Data tidak ditemukan",
            },
            columnDefs: [
                { targets: 0, orderable: false },
                { targets: 7, orderable: false }
            ]
        });
    }

    // FILE UPLOAD HANDLER
    $('#fileDokumen').on('change', function() {
        const file = this.files[0];
        const $label = $('#fileUploadLabel');
        const $fileName = $('#fileName');
        const $fileSize = $('#fileSize');

        if (file) {
            $fileName.text(file.name.length > 40 ? file.name.substring(0, 40) + '...' : file.name);

            if (file.size < 1024 * 1024) {
                $fileSize.text((file.size / 1024).toFixed(1) + ' KB');
            } else {
                $fileSize.text((file.size / (1024 * 1024)).toFixed(1) + ' MB');
            }

            $label.addClass('border-success');
        } else {
            $fileName.text('Pilih file dokumen');
            $fileSize.text('');
            $label.removeClass('border-success');
        }
    });

    // PREVIEW DOKUMEN
    $(document).on('click', '.btn-outline-primary', function() {
        $('#modalPreviewDokumen').modal('show');
    });

    // DELETE DOKUMEN
    $(document).on('click', '.btn-outline-danger', function() {
        Swal.fire({
            title: 'Hapus Dokumen?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
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
                    text: 'Dokumen berhasil dihapus.',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    // location.reload();
                });
            }
        });
    });

    // EDIT DOKUMEN
    $(document).on('click', '.btn-outline-warning', function() {
        Swal.fire({
            title: 'Edit Dokumen',
            text: 'Fitur edit akan segera tersedia',
            icon: 'info',
            confirmButtonColor: '#3085d6'
        });
    });

    // DOWNLOAD DOKUMEN
    $(document).on('click', '.btn-outline-info', function() {
        Swal.fire({
            title: 'Download Dokumen',
            text: 'Memulai download dokumen...',
            icon: 'success',
            showConfirmButton: false,
            timer: 1500
        });
    });

    // RESET FORM SAAT MODAL DITUTUP
    $('#modalUploadDokumen, #modalPreviewDokumen, #modalInformasiIzin').on('hidden.bs.modal', function() {
        $(this).find('form')[0]?.reset();
        $('#fileName').text('Pilih file dokumen');
        $('#fileSize').text('');
        $('#fileUploadLabel').removeClass('border-success');
    });
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
