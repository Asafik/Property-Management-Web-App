@extends('layouts.partial.app')

@section('title', 'Master Data Bank - Property Management App')

@section('content')
<style>
/* ===== SEMUA CSS SAMA PERSIS DENGAN HALAMAN DASHBOARD ===== */
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

/* Modal Styling */
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

/* Badge dengan icon */
.badge i {
    font-size: 0.8rem;
    margin-right: 4px;
}

/* Hover effect untuk icon aksi */
.btn-outline-primary:hover,
.btn-outline-success:hover,
.btn-outline-warning:hover,
.btn-outline-danger:hover,
.btn-outline-info:hover {
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
.dataTables_filter,
.dataTables_length,
.dataTables_paginate,
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

/* Form group untuk modal */
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
</style>

<div class="container-fluid p-2 p-sm-3 p-md-4">
    <!-- Header Dashboard -->
    <div class="row mb-3 mb-sm-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="text-dark mb-1">
                            <i class="mdi mdi-bank me-2" style="color: #9a55ff;"></i>
                            Master Data Bank
                        </h3>
                        <p class="text-muted mb-0">
                            <i class="mdi mdi-information-outline me-1"></i>
                            Kelola data bank untuk keperluan transaksi dan pembayaran
                        </p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-bank" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Data Bank -->
    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                    <h5 class="card-title mb-2 mb-md-0">
                        <i class="mdi mdi-format-list-bulleted me-2 text-primary"></i>
                        Daftar Bank
                    </h5>
                    <div class="d-flex gap-2">
                        <button class="btn btn-sm btn-gradient-primary" onclick="$('#modalTambahBank').modal('show')">
                            <i class="mdi mdi-plus me-1"></i><span class="d-none d-sm-inline">Tambah Bank</span>
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
                                        <i class="mdi mdi-magnify me-1"></i>Cari Bank
                                    </label>
                                    <input type="text" class="form-control" placeholder="Cari nama bank...">
                                </div>

                                <div class="row g-2">
                                    <div class="col-6">
                                        <label class="form-label">
                                            <i class="mdi mdi-flag me-1"></i>Status
                                        </label>
                                        <select class="form-control">
                                            <option value="">Semua</option>
                                            <option value="aktif">Aktif</option>
                                            <option value="nonaktif">Non-Aktif</option>
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
                                    <div class="col-12 d-flex align-items-end">
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
                                            <i class="mdi mdi-magnify me-1"></i>Cari Bank
                                        </label>
                                        <input type="text" class="form-control" placeholder="Cari nama bank...">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">
                                            <i class="mdi mdi-flag me-1"></i>Status
                                        </label>
                                        <select class="form-control">
                                            <option value="">Semua</option>
                                            <option value="aktif">Aktif</option>
                                            <option value="nonaktif">Non-Aktif</option>
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
                                        <label class="form-label" style="visibility: hidden;">Reset</label>
                                        <button type="button" class="btn btn-gradient-secondary w-100">
                                            <i class="mdi mdi-refresh me-1"></i> Reset
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel Bank -->
                    <div class="table-responsive">
                        <table class="table table-hover" id="tableBank" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center"><i class="mdi mdi-counter me-1"></i>No</th>
                                    <th><i class="mdi mdi-bank me-1"></i>Nama Bank</th>
                                    <th><i class="mdi mdi-credit-card me-1"></i>Kode Bank</th>
                                    <th><i class="mdi mdi-phone me-1"></i>No. Telepon</th>
                                    <th><i class="mdi mdi-web me-1"></i>Website</th>
                                    <th><i class="mdi mdi-map-marker me-1"></i>Alamat</th>
                                    <th><i class="mdi mdi-flag me-1"></i>Status</th>
                                    <th class="text-center"><i class="mdi mdi-cog me-1"></i>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center fw-bold">1</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-bank text-primary me-2" style="font-size: 1rem;"></i>
                                            <span class="fw-bold">Bank Central Asia (BCA)</span>
                                        </div>
                                    </td>
                                    <td>BCA</td>
                                    <td>(021) 23588-888</td>
                                    <td>www.bca.co.id</td>
                                    <td>Jl. Sudirman No. 1, Jakarta Pusat</td>
                                    <td>
                                        <span class="badge badge-gradient-success">
                                            <i class="mdi mdi-check-circle me-1"></i>Aktif
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <button class="btn btn-outline-primary btn-sm" title="Detail">
                                                <i class="mdi mdi-eye"></i>
                                            </button>
                                            <button class="btn btn-outline-warning btn-sm" title="Edit">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                            <button class="btn btn-outline-danger btn-sm" title="Nonaktifkan">
                                                <i class="mdi mdi-close-circle"></i>
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
                            Menampilkan 1 - 1 dari 1 data
                        </div>
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0" style="gap: 2px;">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-label="Previous">
                                        <i class="mdi mdi-chevron-left"></i>
                                    </a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item disabled">
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

<!-- MODAL TAMBAH BANK -->
<div class="modal fade" id="modalTambahBank" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="mdi mdi-bank-plus me-2" style="color: #9a55ff;"></i>
                    Tambah Bank Baru
                </h5>
                <button type="button" class="btn-close" onclick="$('#modalTambahBank').modal('hide')" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-bank me-1"></i>Nama Bank
                                </label>
                                <input type="text" class="modal-form-control" placeholder="Contoh: Bank Central Asia">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-credit-card me-1"></i>Kode Bank
                                </label>
                                <input type="text" class="modal-form-control" placeholder="Contoh: BCA">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-phone me-1"></i>No. Telepon
                                </label>
                                <input type="text" class="modal-form-control" placeholder="Contoh: (021) 23588-888">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-web me-1"></i>Website
                                </label>
                                <input type="text" class="modal-form-control" placeholder="Contoh: www.bca.co.id">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-email me-1"></i>Email
                                </label>
                                <input type="email" class="modal-form-control" placeholder="Contoh: cs@bank.co.id">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-map-marker me-1"></i>Alamat
                                </label>
                                <textarea class="modal-form-control" rows="3" placeholder="Alamat lengkap bank..."></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-city me-1"></i>Kota
                                </label>
                                <input type="text" class="modal-form-control" placeholder="Contoh: Jakarta Pusat">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-flag me-1"></i>Status
                                </label>
                                <select class="modal-form-control">
                                    <option value="aktif">Aktif</option>
                                    <option value="nonaktif">Non-Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-gradient-secondary" onclick="$('#modalTambahBank').modal('hide')">
                    <i class="mdi mdi-close me-1"></i>Batal
                </button>
                <button type="button" class="btn btn-gradient-primary" onclick="alert('Bank berhasil ditambahkan!'); $('#modalTambahBank').modal('hide')">
                    <i class="mdi mdi-check me-1"></i>Simpan
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
    // Inisialisasi DataTables - hanya untuk sorting
    let table = $('#tableBank').DataTable({
        responsive: true,
        paging: false,
        info: false,
        searching: false,
        lengthChange: false,
        ordering: true,
        language: {
            emptyTable: "Data bank belum tersedia",
            zeroRecords: "Data tidak ditemukan",
        },
        columnDefs: [
            { orderable: false, targets: [7] }
        ]
    });

    // Tooltips
    $('[data-toggle="tooltip"]').tooltip();
});

function exportTable(type) {
    const msg = type === 'excel' ? 'Excel' : 'PDF';
    Swal.fire({
        icon: 'info',
        title: 'Export ' + msg,
        text: 'Fitur export sedang dalam pengembangan',
        timer: 2000,
        showConfirmButton: false
    });
}
</script>
@endpush
