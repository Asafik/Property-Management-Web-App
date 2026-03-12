@extends('layouts.partial.app')

@section('title', 'Master Data Posisi - Property Management App')

@section('content')

<style>
    /* ===== SEMUA CSS SAMA PERSIS DENGAN HALAMAN DIVISI ===== */
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
    .form-control,
    .form-select {
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

        .form-control,
        .form-select {
            padding: 0.7rem 1rem;
            font-size: 0.95rem;
            border-radius: 10px;
        }
    }

    .form-control:focus,
    .form-select:focus {
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
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
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
    .text-primary {
        color: #9a55ff !important;
    }

    .text-info {
        color: #17a2b8 !important;
    }

    .text-danger {
        color: #dc3545 !important;
    }

    .text-success {
        color: #28a745 !important;
    }

    .text-warning {
        color: #ffc107 !important;
    }

    .fw-bold {
        font-weight: 600 !important;
    }

    .text-muted {
        color: #a5b3cb !important;
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

    /* Modal Styling */
    .modal-content {
        border: none;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
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
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Fix untuk tombol aksi di mobile */
    .action-buttons {
        position: relative;
        z-index: 10;
    }

    .btn-outline-warning, .btn-outline-danger {
        position: relative;
        z-index: 15;
        pointer-events: auto !important;
        cursor: pointer !important;
    }

    /* DataTables wrapper styling */
    .dataTables_wrapper {
        width: 100%;
        overflow-x: auto;
    }

    /* Pastikan tabel tetap terlihat */
    .table {
        width: 100% !important;
        margin-bottom: 0;
    }

    /* Fix untuk DataTables di mobile */
    @media (max-width: 768px) {
        .dataTables_wrapper .table {
            width: 100% !important;
        }
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
    .sorting,
    .sorting_asc,
    .sorting_desc {
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
</style>

<div class="container-fluid p-2 p-sm-3 p-md-4">
    <!-- Header Dashboard -->
    <div class="row mb-3 mb-sm-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="text-dark mb-1">
                            <i class="mdi mdi-badge-account-horizontal me-2" style="color: #9a55ff;"></i>
                            Master Data Posisi
                        </h3>
                        <p class="text-muted mb-0">
                            <i class="mdi mdi-information-outline me-1"></i>
                            Kelola data posisi/jabatan untuk setiap divisi
                        </p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-badge-account-horizontal" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Data Posisi -->
    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-format-list-bulleted me-2 text-primary"></i>
                        Daftar Posisi
                    </h5>
                    <div class="ms-auto">
                        <button class="btn btn-gradient-primary" style="padding: 8px 20px; font-size: 0.95rem; white-space: nowrap;" onclick="$('#modalTambahPosisi').modal('show')">
                            <i class="mdi mdi-plus me-1"></i>
                            <span>Tambah Posisi</span>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <!-- FILTER SECTION -->
                    <div class="filter-card mb-4">
                        <div class="card-body">
                            <h6 class="card-title mb-3" style="font-size: 1rem;">
                                <i class="mdi mdi-filter-outline me-1" style="color: #9a55ff;"></i>
                                Filter Data Posisi
                            </h6>

                            <!-- MOBILE VERSION -->
                            <div class="d-block d-md-none">
                                <form method="GET" action="{{ route('master.data.posisi') }}" id="filterFormMobile">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">
                                            <i class="mdi mdi-magnify me-1" style="color: #9a55ff;"></i>
                                            Cari Posisi
                                        </label>
                                        <input type="text" class="form-control" name="search" value="{{ request('search') }}"
                                            placeholder="Cari nama posisi..." style="height: 45px;">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">
                                            <i class="mdi mdi-sitemap me-1" style="color: #9a55ff;"></i>Divisi
                                        </label>
                                        <select class="form-control" name="division_id" style="height: 45px;">
                                            <option value="">Semua Divisi</option>
                                            @foreach($divisions as $division)
                                                <option value="{{ $division->id }}" {{ request('division_id') == $division->id ? 'selected' : '' }}>{{ $division->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">
                                            <i class="mdi mdi-counter me-1" style="color: #9a55ff;"></i>Tampil per Halaman
                                        </label>
                                        <select class="form-control" name="per_page" style="height: 45px;">
                                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                            <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
                                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                        </select>
                                    </div>

                                    <div class="row g-2">
                                        <div class="col-6">
                                            <button type="submit" class="btn btn-gradient-primary w-100 py-2 d-flex align-items-center justify-content-center">
                                                <i class="mdi mdi-filter me-1"></i> Filter
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <a href="{{ route('master.data.posisi') }}" class="btn btn-gradient-secondary w-100 py-2 d-flex align-items-center justify-content-center">
                                                <i class="mdi mdi-refresh me-1"></i> Reset
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- DESKTOP VERSION -->
                            <div class="d-none d-md-block">
                                <form method="GET" action="{{ route('master.data.posisi') }}" id="filterFormDesktop">
                                    <div class="row g-2 align-items-end">
                                        <div class="col-md-4">
                                            <label class="form-label">
                                                <i class="mdi mdi-magnify me-1" style="color: #9a55ff;"></i>
                                                Cari Posisi
                                            </label>
                                            <input type="text" class="form-control" name="search" value="{{ request('search') }}"
                                                placeholder="Cari nama posisi...">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">
                                                <i class="mdi mdi-sitemap me-1" style="color: #9a55ff;"></i>Divisi
                                            </label>
                                            <select class="form-control" name="division_id">
                                                <option value="">Semua Divisi</option>
                                                @foreach($divisions as $division)
                                                    <option value="{{ $division->id }}" {{ request('division_id') == $division->id ? 'selected' : '' }}>{{ $division->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label">
                                                <i class="mdi mdi-counter me-1" style="color: #9a55ff;"></i>Tampil
                                            </label>
                                            <select class="form-control" name="per_page">
                                                <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                                <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
                                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                            </select>
                                        </div>

                                        <div class="col-md-1">
                                            <label class="form-label invisible">Filter</label>
                                            <button type="submit" class="btn btn-gradient-primary w-100 d-flex align-items-center justify-content-center">
                                                <i class="mdi mdi-filter me-1"></i>
                                            </button>
                                        </div>

                                        <div class="col-md-1">
                                            <label class="form-label invisible">Reset</label>
                                            <a href="{{ route('master.data.posisi') }}" class="btn btn-gradient-secondary w-100 d-flex align-items-center justify-content-center" title="Reset">
                                                <i class="mdi mdi-refresh me-1"></i>
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Error Display -->
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show mb-3">
                            <i class="mdi mdi-alert-circle me-2"></i>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- TABEL DATA -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle" id="tablePosisi">
                            <thead>
                                <tr>
                                    <th class="text-center" width="5%">No</th>
                                    <th width="35%">Nama Posisi</th>
                                    <th width="40%">Divisi</th>
                                    <th class="text-center" width="20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($positions as $item)
                                <tr>
                                    <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-badge-account-horizontal text-primary me-2" style="font-size: 1.2rem;"></i>
                                            <span class="fw-bold">{{ $item->name }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge badge-gradient-info">
                                            <i class="mdi mdi-sitemap me-1"></i>
                                            {{ $item->division->name ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1 action-buttons">
                                            <button class="btn btn-outline-warning btn-sm btnEdit" title="Edit"
                                                data-id="{{ $item->id }}"
                                                data-name="{{ $item->name }}"
                                                data-division="{{ $item->division_id }}">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                            <form action="{{ route('master.data.posisi.delete', $item->id) }}" method="POST" class="d-inline formDelete">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-outline-danger btn-sm btnDelete" title="Hapus" data-name="{{ $item->name }}">
                                                    <i class="mdi mdi-delete"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-5">
                                        <i class="mdi mdi-badge-account-horizontal-off" style="font-size: 3rem; opacity: 0.3;"></i>
                                        <p class="mt-2 mb-0">Tidak ada data posisi yang tersedia.</p>
                                        <p class="text-muted small">Silahkan tambahkan data posisi baru.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- PAGINATION SECTION -->
                    @if($positions->count() > 0)
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                        <div class="pagination-info mb-2 mb-sm-0">
                            <i class="mdi mdi-information-outline me-1 text-primary"></i>
                            Menampilkan
                            <span class="fw-bold">{{ $positions->firstItem() }}</span>
                            -
                            <span class="fw-bold">{{ $positions->lastItem() }}</span>
                            dari
                            <span class="fw-bold">{{ $positions->total() }}</span>
                            data posisi
                        </div>

                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0" style="gap: 2px;">
                                @if($positions->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link" aria-label="Previous">
                                            <i class="mdi mdi-chevron-left"></i>
                                        </span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $positions->previousPageUrl() }}" aria-label="Previous">
                                            <i class="mdi mdi-chevron-left"></i>
                                        </a>
                                    </li>
                                @endif

                                @foreach ($positions->getUrlRange(1, $positions->lastPage()) as $page => $url)
                                    <li class="page-item {{ $positions->currentPage() == $page ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach

                                @if($positions->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $positions->nextPageUrl() }}" aria-label="Next">
                                            <i class="mdi mdi-chevron-right"></i>
                                        </a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <span class="page-link" aria-label="Next">
                                            <i class="mdi mdi-chevron-right"></i>
                                        </span>
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

    <!-- Tombol Kembali -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-3">
                    <div class="d-flex flex-column flex-sm-row justify-content-start">
                        <a href="{{ route('dashboard') }}" class="btn btn-gradient-secondary">
                            <i class="mdi mdi-arrow-left me-1"></i>
                            Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL TAMBAH POSISI -->
<div class="modal fade" id="modalTambahPosisi" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="mdi mdi-badge-account-horizontal-plus me-2" style="color: #9a55ff;"></i>
                    Tambah Posisi Baru
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('master.data.posisi.store') }}" method="POST" id="formTambahPosisi">
                    @csrf
                    <div class="modal-form-group">
                        <label>
                            <i class="mdi mdi-sitemap me-1"></i>Divisi <span class="text-danger">*</span>
                        </label>
                        <select name="division_id" class="modal-form-control" required>
                            <option value="">Pilih Divisi</option>
                            @foreach($divisions as $division)
                                <option value="{{ $division->id }}">{{ $division->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="modal-form-group mt-3">
                        <label>
                            <i class="mdi mdi-badge-account-horizontal me-1"></i>Nama Posisi <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="name" class="modal-form-control" placeholder="Contoh: Manager Keuangan" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="formTambahPosisi" class="btn btn-gradient-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL EDIT POSISI -->
<div class="modal fade" id="modalEditPosisi" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="mdi mdi-pencil me-2" style="color: #9a55ff;"></i>
                    Edit Posisi
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="formEditPosisi">
                    @csrf
                    @method('PUT')
                    <div class="modal-form-group">
                        <label>
                            <i class="mdi mdi-sitemap me-1"></i>Divisi <span class="text-danger">*</span>
                        </label>
                        <select name="division_id" id="editDivisi" class="modal-form-control" required>
                            <option value="">Pilih Divisi</option>
                            @foreach($divisions as $division)
                                <option value="{{ $division->id }}">{{ $division->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="modal-form-group mt-3">
                        <label>
                            <i class="mdi mdi-badge-account-horizontal me-1"></i>Nama Posisi <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="name" id="editNama" class="modal-form-control" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="formEditPosisi" class="btn btn-gradient-primary">Update</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    // ===== HANDLE FORM TAMBAH POSISI =====
    $('#formTambahPosisi').on('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Menyimpan...',
            text: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        this.submit();
    });

    // ===== HANDLE EDIT BUTTON CLICK =====
    $(document).on('click', '.btnEdit', function() {
        let id = $(this).data('id');
        let name = $(this).data('name');
        let division = $(this).data('division');

        $('#editNama').val(name);
        $('#editDivisi').val(division);
        $('#formEditPosisi').attr('action', '/master-data/posisi/update/' + id);
        $('#modalEditPosisi').modal('show');
    });

    // ===== HANDLE FORM EDIT POSISI =====
    $('#formEditPosisi').on('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Menyimpan...',
            text: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        this.submit();
    });

    // ===== HANDLE DELETE BUTTON CLICK =====
    $(document).on('click', '.btnDelete', function() {
        let form = $(this).closest('.formDelete');
        let name = $(this).data('name');

        Swal.fire({
            title: 'Hapus Posisi?',
            text: "Posisi " + name + " akan dihapus",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Menghapus...',
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                form.submit();
            }
        });
    });

    // Filter form submit with loading
    $('#filterFormMobile, #filterFormDesktop').on('submit', function() {
        Swal.fire({
            title: 'Memuat...',
            text: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
    });

    // Reset button with loading
    $('a[href="{{ route('master.data.posisi') }}"]').on('click', function(e) {
        e.preventDefault();
        let href = $(this).attr('href');

        Swal.fire({
            title: 'Memuat...',
            text: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        window.location.href = href;
    });
});

// Sweet Alert untuk session success
@if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        timer: 3000,
        timerProgressBar: true,
        confirmButtonText: 'OK',
        confirmButtonColor: '#9a55ff'
    });
@endif

// Sweet Alert untuk session error
@if(session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: "{{ session('error') }}",
        confirmButtonColor: '#9a55ff',
        confirmButtonText: 'OK'
    });
@endif
</script>
@endpush
