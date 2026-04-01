@extends('layouts.partial.app')

@section('title', 'Data Customer - Property Management App')

@section('content')
<style>
    .card {
        transition: all 0.3s ease;
        margin-bottom: 1rem;
        border: none !important;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
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

    /* ===== STAT CARD BARU ===== */
    .stat-card {
        background: linear-gradient(135deg, #ffffff, #f8f9fa);
        border-radius: 16px;
        padding: 1.2rem;
        height: 100%;
        display: flex;
        align-items: center;
        gap: 1rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        border: none;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(154, 85, 255, 0.12);
    }

    .stat-card .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        color: white;
        flex-shrink: 0;
    }

    .stat-card .stat-icon.total {
        background: linear-gradient(135deg, #667eea, #764ba2);
    }

    .stat-card .stat-icon.aktif {
        background: linear-gradient(135deg, #43e97b, #38f9d7);
    }

    .stat-card .stat-icon.cash {
        background: linear-gradient(135deg, #f093fb, #f5576c);
    }

    .stat-card .stat-icon.kpr {
        background: linear-gradient(135deg, #4facfe, #00f2fe);
    }

    .stat-card .stat-content {
        flex: 1;
        min-width: 0;
    }

    .stat-card .stat-content h3 {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 0.2rem;
        color: #2c2e3f;
        line-height: 1.2;
    }

    .stat-card .stat-content p {
        font-size: 0.9rem;
        color: #6c757d;
        margin-bottom: 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    @media (max-width: 768px) {
        .stat-card {
            padding: 1rem;
            gap: 0.75rem;
        }

        .stat-card .stat-icon {
            width: 45px;
            height: 45px;
            font-size: 1.4rem;
        }

        .stat-card .stat-content h3 {
            font-size: 1.3rem;
        }

        .stat-card .stat-content p {
            font-size: 0.75rem;
        }
    }

    @media (max-width: 576px) {
        .stat-card {
            padding: 0.75rem;
            gap: 0.5rem;
        }

        .stat-card .stat-icon {
            width: 40px;
            height: 40px;
            font-size: 1.2rem;
        }

        .stat-card .stat-content h3 {
            font-size: 1.1rem;
        }

        .stat-card .stat-content p {
            font-size: 0.7rem;
        }
    }

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

    .form-label {
        font-size: 0.85rem;
        font-weight: 600;
        color: #9a55ff !important;
        margin-bottom: 0.3rem;
        letter-spacing: 0.3px;
        font-family: 'Nunito', sans-serif;
    }

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
        position: relative;
        z-index: 15;
        pointer-events: auto !important;
        cursor: pointer !important;
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
        position: relative;
        z-index: 15;
        pointer-events: auto !important;
        cursor: pointer !important;
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

    .table-responsive {
        overflow-x: auto;
        overflow-y: visible;
        -webkit-overflow-scrolling: touch;
        border-radius: 8px;
        margin-bottom: 0.5rem;
        scrollbar-width: thin;
        scrollbar-color: #9a55ff #f0f0f0;
    }
    .table-responsive::-webkit-scrollbar {
        height: 8px;
    }
    .table-responsive::-webkit-scrollbar-track {
        background: #f0f0f0;
        border-radius: 10px;
    }
    .table-responsive::-webkit-scrollbar-thumb {
        background: #9a55ff;
        border-radius: 10px;
    }
    .table-responsive::-webkit-scrollbar-thumb:hover {
        background: #7a3fcc;
    }

    .table { width: 100%; border-collapse: collapse; margin-bottom: 0; }
    .table thead th {
        background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
        color: #9a55ff; font-weight: 600; font-size: 0.8rem;
        text-transform: uppercase; letter-spacing: 0.5px;
        border-bottom: 2px solid #e9ecef;
        padding: 0.8rem 0.5rem;
        white-space: nowrap;
        position: sticky;
        top: 0;
        z-index: 10;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .table thead th:hover {
        color: #7a3fcc;
    }
    .table thead th i {
        font-size: 0.8rem;
        margin-left: 4px;
        opacity: 0.5;
    }
    @media (min-width: 576px) { .table thead th { font-size: 0.85rem; padding: 0.9rem 0.6rem; } }
    @media (min-width: 768px) { .table thead th { font-size: 0.9rem; padding: 1rem 0.75rem; } }
    .table thead th:first-child { padding-left: 0.5rem; text-align: center; }
    .table tbody td:first-child { padding-left: 0.5rem; font-weight: 500; text-align: center; }
    .table tbody td {
        vertical-align: middle; font-size: 0.85rem; padding: 0.8rem 0.5rem;
        border-bottom: 1px solid #e9ecef; color: #2c2e3f;
        white-space: nowrap;
    }
    @media (min-width: 576px) { .table tbody td { font-size: 0.9rem; padding: 0.9rem 0.6rem; } }
    @media (min-width: 768px) { .table tbody td { font-size: 0.95rem; padding: 1rem 0.75rem; } }

    .table tbody tr:hover { background-color: #f8f9fa; }

    .pagination { margin: 0; gap: 3px; }
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
        cursor: pointer;
        text-decoration: none;
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
    .pagination-info { font-size: 0.8rem; color: #6c7383; }

    @media (max-width: 576px) {
        .table thead th { font-size: 0.75rem; padding: 0.6rem 0.3rem; }
        .table tbody td { font-size: 0.8rem; padding: 0.6rem 0.3rem; }
        .filter-card { padding: 0.75rem; }
        .filter-card .form-label { font-size: 0.8rem; }
        .filter-card .form-control, .filter-card .form-select, .filter-card .btn {
            font-size: 0.8rem; min-height: 38px;
        }
    }

    .dataTables_filter, .dataTables_length, .dataTables_paginate, .dataTables_info {
        display: none !important;
    }
    .sorting, .sorting_asc, .sorting_desc { cursor: pointer; }
    .mdi { vertical-align: middle; }

    h3.text-dark { font-size: 1.3rem !important; font-weight: 700; color: #2c2e3f !important; margin-bottom: 0.5rem !important; }
    @media (min-width: 576px) { h3.text-dark { font-size: 1.5rem !important; } }
    @media (min-width: 768px) { h3.text-dark { font-size: 1.7rem !important; } }

    /* ====== CSS ACTION BUTTONS DARI DATA BANK ====== */
    .btn-action {
        width: 36px;
        height: 36px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        margin: 0 3px;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }
    .btn-action i {
        font-size: 1.1rem;
    }
    .btn-action.edit {
        background: linear-gradient(135deg, #ffc107, #ffdb6d);
        color: #2c2e3f;
    }
    .btn-action.edit:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(255, 193, 7, 0.4);
    }
    .btn-action.delete {
        background: linear-gradient(135deg, #dc3545, #e4606d);
        color: white;
    }
    .btn-action.delete:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(220, 53, 69, 0.4);
    }

    .btn-icon-only {
        width: 40px; height: 40px; padding: 0;
        display: flex; align-items: center; justify-content: center; border-radius: 8px;
    }
    .btn-icon-only i { font-size: 1.2rem; margin: 0; }
    .btn-icon-only-mobile {
        width: 100%; height: 40px; padding: 0;
        display: flex; align-items: center; justify-content: center; border-radius: 8px;
    }
    .btn-icon-only-mobile i { font-size: 1.2rem; margin: 0; }

    /* ====== CSS FILTER ====== */
    .filter-card { border: none; }
    .filter-row-desktop {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    .filter-row-desktop .filter-text {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #9a55ff;
        font-weight: 600;
        font-size: 0.95rem;
    }
    .filter-row-mobile  { display: none; }
    @media (max-width: 767px) {
        .filter-row-desktop { display: none; }
        .filter-row-mobile  { display: block; margin-top: 1rem; }
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
                            Data User
                        </h3>
                        <p class="text-muted mb-0">
                            <i class="mdi mdi-information-outline me-1"></i>
                            Kelola data User / pembeli unit properti
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
            <div class="stat-card">
                <div class="stat-icon total">
                    <i class="mdi mdi-account-group"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $totalCustomer ?? 0 }}</h3>
                    <p>Total User</p>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon aktif">
                    <i class="mdi mdi-account-check"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $customerAktif ?? 0 }}</h3>
                    <p>User Aktif</p>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon cash">
                    <i class="mdi mdi-cash-multiple"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $customerCash ?? 0 }}</h3>
                    <p>Pembeli Cash</p>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon kpr">
                    <i class="mdi mdi-bank"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $customerKpr ?? 0 }}</h3>
                    <p>Pembeli KPR</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Data Customer -->
    <div class="row mt-4 mt-sm-4 mt-md-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-format-list-bulleted me-2 text-primary"></i>
                        Daftar User
                    </h5>
                    <div class="d-flex gap-2">
                        <button class="btn btn-gradient-success" style="padding: 0.6rem 1.2rem; font-size: 0.9rem;" onclick="$('#modalImportCustomer').modal('show')">
                            <i class="mdi mdi-import me-1"></i><span class="d-none d-sm-inline">Import</span>
                        </button>
                        <button class="btn btn-gradient-danger" style="padding: 0.6rem 1.2rem; font-size: 0.9rem;" onclick="$('#modalExportCustomer').modal('show')">
                            <i class="mdi mdi-export me-1"></i><span class="d-none d-sm-inline">Export</span>
                        </button>
                        <a href="{{ route('customer.create') }}" class="btn btn-gradient-primary" style="padding: 0.6rem 1.2rem; font-size: 0.9rem;">
                            <i class="mdi mdi-account-multiple-plus-outline"></i><span class="d-none d-sm-inline"> Tambah User Baru</span>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Filter Section -->
                    <div class="filter-card mb-4">
                        <div class="card-body">
                            <!-- DESKTOP VERSION -->
                            <div class="filter-row-desktop">
                                <div class="filter-text">
                                    <i class="mdi mdi-filter-outline"></i>
                                    <span>Filter data customer</span>
                                </div>
                                <form method="GET" action="{{ route('customer.data') }}">
                                    <div class="row g-2 align-items-end w-100">
                                        <div class="col-md-3">
                                            <label class="form-label">Cari User</label>
                                            <input type="text" class="form-control" name="search" placeholder="Nama, ID..." value="{{ request('search') }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Pekerjaan</label>
                                            <select class="form-control" name="pekerjaan">
                                                <option value="">Semua</option>
                                                <option value="PNS" {{ request('pekerjaan') == 'PNS' ? 'selected' : '' }}>PNS</option>
                                                <option value="Karyawan Swasta" {{ request('pekerjaan') == 'Karyawan Swasta' ? 'selected' : '' }}>Karyawan Swasta</option>
                                                <option value="Wiraswasta" {{ request('pekerjaan') == 'Wiraswasta' ? 'selected' : '' }}>Wiraswasta</option>
                                                <option value="Ibu Rumah Tangga" {{ request('pekerjaan') == 'Ibu Rumah Tangga' ? 'selected' : '' }}>Ibu Rumah Tangga</option>
                                                <option value="Pensiunan" {{ request('pekerjaan') == 'Pensiunan' ? 'selected' : '' }}>Pensiunan</option>
                                                <option value="Lainnya" {{ request('pekerjaan') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">Tampil</label>
                                            <select class="form-control" name="per_page">
                                                <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                                <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label invisible d-none d-md-block">Aksi</label>
                                            <div class="d-flex gap-2">
                                                <button type="submit" class="btn btn-gradient-primary btn-icon-only flex-fill" title="Filter" onclick="showFilterLoading()">
                                                    <i class="mdi mdi-filter"></i>
                                                </button>
                                                <a href="{{ route('customer.data') }}" class="btn btn-gradient-secondary btn-icon-only flex-fill" title="Reset" onclick="showResetLoading(event)">
                                                    <i class="mdi mdi-refresh"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- MOBILE VERSION -->
                            <div class="filter-row-mobile">
                                <div class="filter-text mb-2">
                                    <i class="mdi mdi-filter-outline"></i>
                                    <span>Filter data customer</span>
                                </div>
                                <form method="GET" action="{{ route('customer.data') }}">
                                    <div class="row g-2">
                                        <div class="col-12 mb-2">
                                            <label class="form-label">Cari User</label>
                                            <input type="text" class="form-control" name="search" placeholder="Nama, ID..." value="{{ request('search') }}">
                                        </div>
                                        <div class="col-12 mb-2">
                                            <label class="form-label">Pekerjaan</label>
                                            <select class="form-control" name="pekerjaan">
                                                <option value="">Semua</option>
                                                <option value="PNS" {{ request('pekerjaan') == 'PNS' ? 'selected' : '' }}>PNS</option>
                                                <option value="Karyawan Swasta" {{ request('pekerjaan') == 'Karyawan Swasta' ? 'selected' : '' }}>Karyawan Swasta</option>
                                                <option value="Wiraswasta" {{ request('pekerjaan') == 'Wiraswasta' ? 'selected' : '' }}>Wiraswasta</option>
                                                <option value="Ibu Rumah Tangga" {{ request('pekerjaan') == 'Ibu Rumah Tangga' ? 'selected' : '' }}>Ibu Rumah Tangga</option>
                                                <option value="Pensiunan" {{ request('pekerjaan') == 'Pensiunan' ? 'selected' : '' }}>Pensiunan</option>
                                                <option value="Lainnya" {{ request('pekerjaan') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <label class="form-label">Tampil</label>
                                            <select class="form-control" name="per_page">
                                                <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                                <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <button type="submit" class="btn btn-gradient-primary btn-icon-only-mobile w-100" title="Filter" onclick="showFilterLoading()">
                                                <i class="mdi mdi-filter"></i> Filter
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <a href="{{ route('customer.data') }}" class="btn btn-gradient-secondary btn-icon-only-mobile w-100" title="Reset" onclick="showResetLoading(event)">
                                                <i class="mdi mdi-refresh"></i> Reset
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th class="text-center" width="5%">No</th>
                                    <th class="sortable" width="25%" data-field="full_name" data-direction="{{ request('sortField') == 'full_name' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Nama User
                                        @if(request('sortField') == 'full_name')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable" width="20%" data-field="email" data-direction="{{ request('sortField') == 'email' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Email
                                        @if(request('sortField') == 'email')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable" width="15%" data-field="job_status" data-direction="{{ request('sortField') == 'job_status' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Pekerjaan
                                        @if(request('sortField') == 'job_status')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable" width="15%" data-field="phone" data-direction="{{ request('sortField') == 'phone' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Nomor Hp
                                        @if(request('sortField') == 'phone')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="text-center" width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($customers as $customer)
                                <tr>
                                    <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle avatar-sm me-2">
                                                {{ strtoupper(substr(trim($customer->full_name), 0, 2)) }}
                                            </div>
                                            <span class="fw-bold">{{ $customer->full_name }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        @if($customer->email)
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="mdi mdi-email-outline text-primary" style="font-size: 1.2rem;"></i>
                                            <span>{{ $customer->email }}</span>
                                        </div>
                                        @else
                                        <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($customer->job_status)
                                        <span class="badge bg-light text-dark">{{ $customer->job_status }}</span>
                                        @else
                                        <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($customer->phone)
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="mdi mdi-whatsapp text-success" style="font-size: 1.2rem;"></i>
                                            <span>{{ $customer->phone }}</span>
                                        </div>
                                        @else
                                        <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('customer.edit', $customer->id) }}" class="btn-action edit me-1" title="Edit">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>
                                        <button class="btn-action delete" title="Hapus"
                                            onclick="deleteCustomer({{ $customer->id }}, '{{ $customer->full_name }}')">
                                            <i class="mdi mdi-delete"></i>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-5">
                                        <i class="mdi mdi-account-off" style="font-size: 3rem; opacity: 0.3;"></i>
                                        <p class="mt-2 mb-0">Tidak ada data customer yang tersedia.</p>
                                        <p class="text-muted small">Silahkan tambahkan data customer baru.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- PAGINATION -->
                    @if ($customers instanceof \Illuminate\Pagination\LengthAwarePaginator && $customers->total() > 0)
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                        <div class="pagination-info mb-2 mb-sm-0">
                            Menampilkan {{ $customers->firstItem() }} - {{ $customers->lastItem() }} dari {{ $customers->total() }} data
                        </div>
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                {{-- Previous Page Link --}}
                                @if ($customers->onFirstPage())
                                    <li class="page-item disabled" aria-disabled="true">
                                        <span class="page-link" aria-label="Previous">
                                            <i class="mdi mdi-chevron-left"></i>
                                        </span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $customers->appends(request()->query())->previousPageUrl() }}" rel="prev" aria-label="Previous" onclick="showPaginationLoading(event)">
                                            <i class="mdi mdi-chevron-left"></i>
                                        </a>
                                    </li>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach ($customers->getUrlRange(max(1, $customers->currentPage() - 2), min($customers->lastPage(), $customers->currentPage() + 2)) as $page => $url)
                                    @if ($page == $customers->currentPage())
                                        <li class="page-item active" aria-current="page">
                                            <span class="page-link">{{ $page }}</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $customers->appends(request()->query())->url($page) }}" onclick="showPaginationLoading(event)">{{ $page }}</a>
                                        </li>
                                    @endif
                                @endforeach

                                {{-- Next Page Link --}}
                                @if ($customers->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $customers->appends(request()->query())->nextPageUrl() }}" rel="next" aria-label="Next" onclick="showPaginationLoading(event)">
                                            <i class="mdi mdi-chevron-right"></i>
                                        </a>
                                    </li>
                                @else
                                    <li class="page-item disabled" aria-disabled="true">
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
</div>

<!-- MODAL IMPORT CUSTOMER -->
<div class="modal fade" id="modalImportCustomer" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="mdi mdi-import me-2" style="color: #9a55ff;"></i>
                    Import Data User
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

<!-- MODAL EXPORT CUSTOMER -->
<div class="modal fade" id="modalExportCustomer" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="mdi mdi-export me-2" style="color: #9a55ff;"></i>
                    Export Data User
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
                        <option value="semua">Semua User</option>
                        <option value="aktif">User Aktif</option>
                        <option value="pending">User Pending</option>
                        <option value="kpr">Pembeli KPR</option>
                        <option value="cash">Pembeli Cash</option>
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
    // 1. Fungsi Sorting (Mengurutkan Data)
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

    // 2. Handle Submit Filter Form (Desktop & Mobile)
    $('#filterFormMobile, #filterFormDesktop, form').on('submit', function() {
        // Cek jika ini form pencarian/filter, tampilkan loading
        if($(this).attr('method')?.toUpperCase() === 'GET') {
            showFilterLoading();
        }
    });

    // 3. Handle klik link navigasi/breadcumb ke data customer
    $('a[href="{{ route('customer.data') }}"]').on('click', function(e) {
        if (!$(this).hasClass('page-link')) { // Supaya tidak tabrakan dengan pagination
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
        }
    });

    // 4. Inisialisasi Session Flash Messages (SweetAlert)
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

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: "{{ session('error') }}",
            confirmButtonColor: '#9a55ff',
            confirmButtonText: 'OK'
        });
    @endif
});

function deleteCustomer(id, name) {
    Swal.fire({
        title: 'Hapus User?',
        html: `Apakah Anda yakin ingin menghapus user <strong>${name}</strong>?`,
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
                allowOutsideClick: false,
                didOpen: () => { Swal.showLoading(); }
            });

            $.ajax({
                // PERBAIKAN URL DI SINI
                url: "/customer/" + id + "/destroy",
                type: 'DELETE',
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'User berhasil dihapus',
                        confirmButtonColor: '#9a55ff',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function(xhr) {
                    // Jika controller mengirim error (misal: relasi masih ada)
                    let errorMsg = 'Terjadi kesalahan saat menghapus data.';
                    if (xhr.responseJSON && xhr.responseJSON.error) {
                        errorMsg = xhr.responseJSON.error;
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: errorMsg,
                        confirmButtonColor: '#9a55ff'
                    });
                }
            });
        }
    });
}

// 6. Fungsi loading untuk pagination (Klik nomor halaman)
function showPaginationLoading(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Memuat...',
        html: 'Sedang memuat halaman',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    window.location.href = event.currentTarget.href;
}

// 7. Fungsi loading untuk filter
function showFilterLoading() {
    Swal.fire({
        title: 'Memuat...',
        html: 'Sedang memfilter data',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
}

// 8. Fungsi loading untuk reset filter
function showResetLoading(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Memuat...',
        html: 'Sedang mereset filter',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    window.location.href = event.currentTarget.href;
}
</script>
@endpush
