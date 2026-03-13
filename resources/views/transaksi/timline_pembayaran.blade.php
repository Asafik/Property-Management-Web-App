@extends('layouts.partial.app')

@section('title', 'Timeline Pembayaran - Property Management App')

@section('content')
<style>
    /* ===== STYLING SAMA PERSIS DENGAN HALAMAN SEBELUMNYA ===== */
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
        height: 32px;
        width: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-gradient-primary {
        background: linear-gradient(to right, #da8cff, #9a55ff) !important;
        color: #ffffff !important;
    }

    .btn-gradient-secondary {
        background: #6c757d !important;
        color: #ffffff !important;
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
    .btn-outline-info {
        background: transparent;
        border: 1px solid #17a2b8;
        color: #17a2b8;
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-outline-info:hover {
        background: linear-gradient(135deg, #17a2b8, #5bc0de);
        color: #ffffff;
        border-color: transparent;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(23, 162, 184, 0.3);
    }

    .btn-outline-warning {
        background: transparent;
        border: 1px solid #ffc107;
        color: #ffc107;
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-outline-warning:hover {
        background: linear-gradient(135deg, #ffc107, #ffdb6d);
        color: #2c2e3f;
        border-color: transparent;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(255, 193, 7, 0.3);
    }

    .btn-outline-danger {
        background: transparent;
        border: 1px solid #dc3545;
        color: #dc3545;
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-outline-danger:hover {
        background: linear-gradient(135deg, #dc3545, #e4606d);
        color: #ffffff;
        border-color: transparent;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
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

    .badge-gradient-dark {
        background: linear-gradient(135deg, #343a40, #495057);
        color: #ffffff;
    }

    .badge-gradient-primary {
        background: linear-gradient(135deg, #9a55ff, #da8cff);
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

    /* Kolom No diperkecil */
    .table thead th:first-child {
        padding-left: 0.75rem;
        width: 5%;
        text-align: center;
    }

    .table tbody td:first-child {
        padding-left: 0.75rem;
        font-weight: 500;
        width: 5%;
        text-align: center;
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

    .table tbody td .d-flex.align-items-center {
        gap: 0.5rem;
    }

    /* ===== ACTION BUTTONS ===== */
    .action-buttons {
        position: relative;
        z-index: 10;
        display: flex;
        justify-content: center;
        gap: 5px;
    }

    /* Status Indicators untuk Timeline */
    .status-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 6px;
    }

    .status-dot.success { background: #28a745; }
    .status-dot.warning { background: #ffc107; }
    .status-dot.danger { background: #dc3545; }
    .status-dot.dark { background: #343a40; }
    .status-dot.primary { background: #9a55ff; }

    /* Timeline Detail */
    .timeline-detail-item {
        display: flex;
        align-items: center;
        padding: 0.75rem;
        border-bottom: 1px solid #e9ecef;
        transition: all 0.2s ease;
    }

    .timeline-detail-item:hover {
        background: #f8f9fa;
    }

    .timeline-detail-item:last-child {
        border-bottom: none;
    }

    .timeline-date {
        min-width: 120px;
        font-weight: 600;
    }

    .timeline-status {
        min-width: 120px;
    }

    .timeline-denda {
        color: #dc3545;
        font-weight: 600;
        min-width: 100px;
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

    .modal-form-group {
        margin-bottom: 1rem;
    }

    .modal-form-group label {
        font-size: 0.85rem;
        font-weight: 600;
        color: #9a55ff !important;
        margin-bottom: 0.3rem;
        display: block;
    }

    .modal-form-control {
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: 0.6rem 0.8rem;
        font-size: 0.9rem;
        width: 100%;
    }

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

    /* Pagination */
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
        min-width: 32px;
        text-align: center;
    }

    .page-item.active .page-link {
        background: linear-gradient(to right, #da8cff, #9a55ff);
        border-color: transparent;
        color: #ffffff;
    }

    .pagination-info {
        font-size: 0.8rem;
        color: #6c7383;
    }

    /* Responsive */
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

        h3.text-dark {
            font-size: 1.2rem !important;
        }

        .btn-sm {
            width: 28px;
            height: 28px;
        }

        .btn-outline-info,
        .btn-outline-warning,
        .btn-outline-danger {
            width: 28px;
            height: 28px;
        }
    }

    .mdi {
        vertical-align: middle;
    }

    /* DataTables Custom Styling */
    .dataTables_filter,
    .dataTables_length,
    .dataTables_paginate,
    .dataTables_info {
        display: none !important;
    }

    .dataTables_wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .table {
        width: 100% !important;
        margin-bottom: 0;
    }

    @media (max-width: 768px) {
        .dataTables_wrapper .table {
            width: 100% !important;
        }
    }
</style>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">

<div class="container-fluid p-2 p-sm-3 p-md-4">
    <!-- Header Dashboard -->
    <div class="row mb-3 mb-sm-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="text-dark mb-1">
                            <i class="mdi mdi-timeline-clock me-2" style="color: #9a55ff;"></i>
                            Timeline Pembayaran Cash Tempo
                        </h3>
                        <p class="text-muted mb-0">
                            <i class="mdi mdi-information-outline me-1"></i>
                            Kelola data tenor dan timeline pembayaran
                        </p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-timeline-clock" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Data Tenor -->
    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-format-list-bulleted me-2 text-primary"></i>
                        Daftar Tenor Pembayaran
                    </h5>
                    <div class="ms-auto">
                        <button class="btn btn-gradient-primary" style="padding: 8px 20px; font-size: 0.95rem; white-space: nowrap;" onclick="$('#modalCreate').modal('show')">
                            <i class="mdi mdi-plus me-1"></i>
                            <span>Tambah Tenor</span>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <!-- FILTER SECTION -->
                    <div class="filter-card mb-4">
                        <div class="card-body">
                            <h6 class="card-title mb-3" style="font-size: 1rem;">
                                <i class="mdi mdi-filter-outline me-1" style="color: #9a55ff;"></i>
                                Filter Data Tenor
                            </h6>

                            <!-- MOBILE VERSION -->
                            <div class="d-block d-md-none">
                                <form method="GET" action="#" id="filterFormMobile">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">
                                            <i class="mdi mdi-magnify me-1" style="color: #9a55ff;"></i>
                                            Cari Tenor
                                        </label>
                                        <input type="text" class="form-control" placeholder="Cari tenor..." style="height: 45px;">
                                    </div>

                                    <div class="row g-2">
                                        <div class="col-6">
                                            <button type="button" class="btn btn-gradient-primary w-100 py-2 d-flex align-items-center justify-content-center">
                                                <i class="mdi mdi-filter me-1"></i> Filter
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <button type="button" class="btn btn-gradient-secondary w-100 py-2 d-flex align-items-center justify-content-center">
                                                <i class="mdi mdi-refresh me-1"></i> Reset
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- DESKTOP VERSION -->
                            <div class="d-none d-md-block">
                                <form method="GET" action="#" id="filterFormDesktop">
                                    <div class="row g-2 align-items-end">
                                        <div class="col-md-4">
                                            <label class="form-label">
                                                <i class="mdi mdi-magnify me-1" style="color: #9a55ff;"></i>
                                                Cari Tenor
                                            </label>
                                            <input type="text" class="form-control" placeholder="Cari tenor...">
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label">
                                                <i class="mdi mdi-counter me-1" style="color: #9a55ff;"></i>
                                                Tampil
                                            </label>
                                            <select class="form-control">
                                                <option>10</option>
                                                <option>15</option>
                                                <option>25</option>
                                                <option>50</option>
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label invisible">Filter</label>
                                            <button type="button" class="btn btn-gradient-primary w-100 d-flex align-items-center justify-content-center">
                                                <i class="mdi mdi-filter me-1"></i>
                                            </button>
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label invisible">Reset</label>
                                            <button type="button" class="btn btn-gradient-secondary w-100 d-flex align-items-center justify-content-center">
                                                <i class="mdi mdi-refresh me-1"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- TABEL DATA -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle" id="tableTenor" data-use-datatables="true">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Tenor</th>
                                    <th>Total Bulan</th>
                                    <th>Jatuh Tempo</th>
                                    <th>Denda Keterlambatan</th>
                                    <th>Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data 1 - Lunas (Hijau) -->
                                <tr>
                                    <td class="text-center fw-bold">1</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-calendar-clock text-primary me-2" style="font-size: 1.2rem;"></i>
                                            <span class="fw-bold">3 Tahun</span>
                                        </div>
                                    </td>
                                    <td>36 Bulan</td>
                                    <td>Setiap tanggal 7</td>
                                    <td><span class="badge bg-light text-dark">1% per bulan</span></td>
                                    <td><span class="badge badge-gradient-success"><i class="mdi mdi-check-circle me-1"></i>Lunas</span></td>
                                    <td class="text-center">
                                        <div class="action-buttons">
                                            <button class="btn btn-outline-info btn-sm" title="Detail Timeline" onclick="$('#modalLunas').modal('show')">
                                                <i class="mdi mdi-eye"></i>
                                            </button>
                                            <button class="btn btn-outline-warning btn-sm" title="Edit">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                            <button class="btn btn-outline-danger btn-sm btn-delete" title="Hapus">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Data 2 - Warning (Kuning) -->
                                <tr>
                                    <td class="text-center fw-bold">2</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-calendar-clock text-primary me-2" style="font-size: 1.2rem;"></i>
                                            <span class="fw-bold">5 Tahun</span>
                                        </div>
                                    </td>
                                    <td>60 Bulan</td>
                                    <td>Setiap tanggal 7</td>
                                    <td><span class="badge bg-light text-dark">1% per bulan</span></td>
                                    <td><span class="badge badge-gradient-warning"><i class="mdi mdi-clock-outline me-1"></i>Warning</span></td>
                                    <td class="text-center">
                                        <div class="action-buttons">
                                            <button class="btn btn-outline-info btn-sm" title="Detail Timeline" onclick="$('#modalWarning').modal('show')">
                                                <i class="mdi mdi-eye"></i>
                                            </button>
                                            <button class="btn btn-outline-warning btn-sm" title="Edit">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                            <button class="btn btn-outline-danger btn-sm btn-delete" title="Hapus">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Data 3 - Saatnya Bayar (Merah Biasa) -->
                                <tr>
                                    <td class="text-center fw-bold">3</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-calendar-clock text-primary me-2" style="font-size: 1.2rem;"></i>
                                            <span class="fw-bold">2 Tahun</span>
                                        </div>
                                    </td>
                                    <td>24 Bulan</td>
                                    <td>Setiap tanggal 7</td>
                                    <td><span class="badge bg-light text-dark">1% per bulan</span></td>
                                    <td><span class="badge badge-gradient-danger"><i class="mdi mdi-alert-circle me-1"></i>Saatnya Bayar</span></td>
                                    <td class="text-center">
                                        <div class="action-buttons">
                                            <button class="btn btn-outline-info btn-sm" title="Detail Timeline" onclick="$('#modalMerahBiasa').modal('show')">
                                                <i class="mdi mdi-eye"></i>
                                            </button>
                                            <button class="btn btn-outline-warning btn-sm" title="Edit">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                            <button class="btn btn-outline-danger btn-sm btn-delete" title="Hapus">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Data 4 - Denda 1% (Merah Tua) -->
                                <tr>
                                    <td class="text-center fw-bold">4</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-calendar-clock text-primary me-2" style="font-size: 1.2rem;"></i>
                                            <span class="fw-bold">10 Tahun</span>
                                        </div>
                                    </td>
                                    <td>120 Bulan</td>
                                    <td>Setiap tanggal 7</td>
                                    <td><span class="badge bg-light text-dark">1% per bulan</span></td>
                                    <td><span class="badge badge-gradient-danger"><i class="mdi mdi-alert-octagon me-1"></i>Denda 1%</span></td>
                                    <td class="text-center">
                                        <div class="action-buttons">
                                            <button class="btn btn-outline-info btn-sm" title="Detail Timeline" onclick="$('#modalDenda1').modal('show')">
                                                <i class="mdi mdi-eye"></i>
                                            </button>
                                            <button class="btn btn-outline-warning btn-sm" title="Edit">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                            <button class="btn btn-outline-danger btn-sm btn-delete" title="Hapus">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Data 5 - Denda 2% (Merah Tua) -->
                                <tr>
                                    <td class="text-center fw-bold">5</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-calendar-clock text-primary me-2" style="font-size: 1.2rem;"></i>
                                            <span class="fw-bold">8 Tahun</span>
                                        </div>
                                    </td>
                                    <td>96 Bulan</td>
                                    <td>Setiap tanggal 7</td>
                                    <td><span class="badge bg-light text-dark">1% per bulan</span></td>
                                    <td><span class="badge badge-gradient-danger"><i class="mdi mdi-alert-octagon me-1"></i>Denda 2%</span></td>
                                    <td class="text-center">
                                        <div class="action-buttons">
                                            <button class="btn btn-outline-info btn-sm" title="Detail Timeline" onclick="$('#modalDenda2').modal('show')">
                                                <i class="mdi mdi-eye"></i>
                                            </button>
                                            <button class="btn btn-outline-warning btn-sm" title="Edit">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                            <button class="btn btn-outline-danger btn-sm btn-delete" title="Hapus">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Data 6 - Denda 3% (Merah Tua) -->
                                <tr>
                                    <td class="text-center fw-bold">6</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-calendar-clock text-primary me-2" style="font-size: 1.2rem;"></i>
                                            <span class="fw-bold">15 Tahun</span>
                                        </div>
                                    </td>
                                    <td>180 Bulan</td>
                                    <td>Setiap tanggal 7</td>
                                    <td><span class="badge bg-light text-dark">1% per bulan</span></td>
                                    <td><span class="badge badge-gradient-danger"><i class="mdi mdi-alert-octagon me-1"></i>Denda 3%</span></td>
                                    <td class="text-center">
                                        <div class="action-buttons">
                                            <button class="btn btn-outline-info btn-sm" title="Detail Timeline" onclick="$('#modalDenda3').modal('show')">
                                                <i class="mdi mdi-eye"></i>
                                            </button>
                                            <button class="btn btn-outline-warning btn-sm" title="Edit">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                            <button class="btn btn-outline-danger btn-sm btn-delete" title="Hapus">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Data 7 - Denda 5% (Hitam) -->
                                <tr>
                                    <td class="text-center fw-bold">7</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-calendar-clock text-primary me-2" style="font-size: 1.2rem;"></i>
                                            <span class="fw-bold">20 Tahun</span>
                                        </div>
                                    </td>
                                    <td>240 Bulan</td>
                                    <td>Setiap tanggal 7</td>
                                    <td><span class="badge bg-light text-dark">1% per bulan</span></td>
                                    <td><span class="badge badge-gradient-dark"><i class="mdi mdi-alert-circle-outline me-1"></i>Denda 5%</span></td>
                                    <td class="text-center">
                                        <div class="action-buttons">
                                            <button class="btn btn-outline-info btn-sm" title="Detail Timeline" onclick="$('#modalHitam').modal('show')">
                                                <i class="mdi mdi-eye"></i>
                                            </button>
                                            <button class="btn btn-outline-warning btn-sm" title="Edit">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                            <button class="btn btn-outline-danger btn-sm btn-delete" title="Hapus">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- PAGINATION -->
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                        <div class="pagination-info mb-2 mb-sm-0">
                            <i class="mdi mdi-information-outline me-1 text-primary"></i>
                            Menampilkan 1 - 7 dari 7 data tenor
                        </div>

                        <nav>
                            <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0" style="gap: 2px;">
                                <li class="page-item disabled">
                                    <span class="page-link"><i class="mdi mdi-chevron-left"></i></span>
                                </li>
                                <li class="page-item active">
                                    <span class="page-link">1</span>
                                </li>
                                <li class="page-item disabled">
                                    <span class="page-link"><i class="mdi mdi-chevron-right"></i></span>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tombol Kembali -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-3">
                    <a href="#" class="btn btn-gradient-secondary btn-back">
                        <i class="mdi mdi-arrow-left me-1"></i> Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL CREATE - Tambah Tenor Baru dengan Denda Keterlambatan -->
<div class="modal fade" id="modalCreate" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="mdi mdi-plus-circle me-2" style="color: #9a55ff;"></i>
                    Tambah Tenor Baru
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="modal-form-group">
                        <label><i class="mdi mdi-calendar-clock me-1" style="color: #9a55ff;"></i>Jangka Waktu (Tenor) <span class="text-danger">*</span></label>
                        <select class="modal-form-control">
                            <option value="">-- Pilih Tenor --</option>
                            <option>1 Tahun (12 bulan)</option>
                            <option>2 Tahun (24 bulan)</option>
                            <option>3 Tahun (36 bulan)</option>
                            <option>5 Tahun (60 bulan)</option>
                            <option>8 Tahun (96 bulan)</option>
                            <option>10 Tahun (120 bulan)</option>
                            <option>15 Tahun (180 bulan)</option>
                            <option>20 Tahun (240 bulan)</option>
                        </select>
                    </div>

                    <div class="modal-form-group">
                        <label><i class="mdi mdi-calendar-today me-1" style="color: #9a55ff;"></i>Jatuh Tempo Setiap Tanggal <span class="text-danger">*</span></label>
                        <input type="number" class="modal-form-control" min="1" max="31" value="7" placeholder="Contoh: 7">
                        <small class="text-muted">Masukkan angka 1-31 (contoh: 7 berarti setiap tanggal 7)</small>
                    </div>

                    <div class="modal-form-group">
                        <label><i class="mdi mdi-cash me-1" style="color: #9a55ff;"></i>Angsuran per Bulan (Rp) <span class="text-danger">*</span></label>
                        <input type="text" class="modal-form-control" placeholder="Rp 5.000.000">
                    </div>

                    <!-- Denda Keterlambatan -->
                    <div class="modal-form-group">
                        <label><i class="mdi mdi-alert-circle-outline me-1" style="color: #9a55ff;"></i>Denda Keterlambatan (%)</label>
                        <div class="input-group">
                            <input type="number" class="modal-form-control" placeholder="Contoh: 1" min="0" max="100" step="0.1" value="1">
                            <span class="input-group-text" style="background: linear-gradient(135deg, #f8f9fa, #e9ecef); border: 1px solid #e9ecef; border-radius: 0 8px 8px 0;">%</span>
                        </div>
                        <small class="text-muted">Persentase denda per bulan keterlambatan (contoh: 1% per bulan)</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-gradient-primary btn-save-create">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL DETAIL - LUNAS (Hijau) -->
<div class="modal fade" id="modalLunas" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="mdi mdi-history me-2" style="color: #9a55ff;"></i>
                    Timeline Pembayaran - Tenor 3 Tahun (Lunas)
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <span class="badge badge-gradient-success mb-2"><i class="mdi mdi-check-circle me-1"></i>Status: Lunas</span>
                    <p class="small text-muted">Jatuh tempo setiap tanggal 7 | Angsuran Rp 5.000.000/bulan | Denda 1% per bulan</p>
                </div>

                <div class="timeline-detail">
                    <div class="timeline-detail-item">
                        <span class="timeline-date"><span class="status-dot success"></span> 5 Maret 2026</span>
                        <span class="timeline-status"><span class="badge badge-gradient-success"><i class="mdi mdi-check-circle me-1"></i>Lunas</span></span>
                        <span class="timeline-denda">Rp 5.000.000</span>
                    </div>
                    <div class="timeline-detail-item">
                        <span class="timeline-date"><span class="status-dot success"></span> 3 Februari 2026</span>
                        <span class="timeline-status"><span class="badge badge-gradient-success"><i class="mdi mdi-check-circle me-1"></i>Lunas</span></span>
                        <span class="timeline-denda">Rp 5.000.000</span>
                    </div>
                    <div class="timeline-detail-item">
                        <span class="timeline-date"><span class="status-dot success"></span> 28 Januari 2026</span>
                        <span class="timeline-status"><span class="badge badge-gradient-success"><i class="mdi mdi-check-circle me-1"></i>Lunas</span></span>
                        <span class="timeline-denda">Rp 5.000.000</span>
                    </div>
                    <div class="timeline-detail-item">
                        <span class="timeline-date"><span class="status-dot success"></span> 20 Desember 2025</span>
                        <span class="timeline-status"><span class="badge badge-gradient-success"><i class="mdi mdi-check-circle me-1"></i>Lunas</span></span>
                        <span class="timeline-denda">Rp 5.000.000</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL DETAIL - WARNING (Kuning) -->
<div class="modal fade" id="modalWarning" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="mdi mdi-history me-2" style="color: #9a55ff;"></i>
                    Timeline Pembayaran - Tenor 5 Tahun (Warning)
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <span class="badge badge-gradient-warning mb-2"><i class="mdi mdi-clock-outline me-1"></i>Status: Warning</span>
                    <p class="small text-muted">Jatuh tempo setiap tanggal 7 | Angsuran Rp 5.000.000/bulan | Denda 1% per bulan</p>
                </div>

                <div class="timeline-detail">
                    <div class="timeline-detail-item">
                        <span class="timeline-date"><span class="status-dot warning"></span> 3 Maret 2026</span>
                        <span class="timeline-status"><span class="badge badge-gradient-warning"><i class="mdi mdi-clock-outline me-1"></i>Belum Bayar</span></span>
                        <span class="timeline-denda">Rp 0</span>
                    </div>
                    <div class="timeline-detail-item">
                        <span class="timeline-date"><span class="status-dot success"></span> 5 Februari 2026</span>
                        <span class="timeline-status"><span class="badge badge-gradient-success"><i class="mdi mdi-check-circle me-1"></i>Lunas</span></span>
                        <span class="timeline-denda">Rp 5.000.000</span>
                    </div>
                    <div class="timeline-detail-item">
                        <span class="timeline-date"><span class="status-dot success"></span> 2 Januari 2026</span>
                        <span class="timeline-status"><span class="badge badge-gradient-success"><i class="mdi mdi-check-circle me-1"></i>Lunas</span></span>
                        <span class="timeline-denda">Rp 5.000.000</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL DETAIL - SAATNYA BAYAR (Merah Biasa) -->
<div class="modal fade" id="modalMerahBiasa" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="mdi mdi-history me-2" style="color: #9a55ff;"></i>
                    Timeline Pembayaran - Tenor 2 Tahun (Saatnya Bayar)
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <span class="badge badge-gradient-danger mb-2"><i class="mdi mdi-alert-circle me-1"></i>Status: Saatnya Bayar</span>
                    <p class="small text-muted">Jatuh tempo setiap tanggal 7 | Angsuran Rp 5.000.000/bulan | Denda 1% per bulan</p>
                </div>

                <div class="timeline-detail">
                    <div class="timeline-detail-item">
                        <span class="timeline-date"><span class="status-dot danger"></span> 7 Maret 2026</span>
                        <span class="timeline-status"><span class="badge badge-gradient-danger"><i class="mdi mdi-alert-circle me-1"></i>Jatuh Tempo</span></span>
                        <span class="timeline-denda">Rp 5.000.000</span>
                    </div>
                    <div class="timeline-detail-item">
                        <span class="timeline-date"><span class="status-dot success"></span> 5 Februari 2026</span>
                        <span class="timeline-status"><span class="badge badge-gradient-success"><i class="mdi mdi-check-circle me-1"></i>Lunas</span></span>
                        <span class="timeline-denda">Rp 5.000.000</span>
                    </div>
                    <div class="timeline-detail-item">
                        <span class="timeline-date"><span class="status-dot success"></span> 3 Januari 2026</span>
                        <span class="timeline-status"><span class="badge badge-gradient-success"><i class="mdi mdi-check-circle me-1"></i>Lunas</span></span>
                        <span class="timeline-denda">Rp 5.000.000</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL DETAIL - DENDA 1% (Merah Tua) -->
<div class="modal fade" id="modalDenda1" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="mdi mdi-history me-2" style="color: #9a55ff;"></i>
                    Timeline Pembayaran - Tenor 10 Tahun (Denda 1%)
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <span class="badge badge-gradient-danger mb-2"><i class="mdi mdi-alert-octagon me-1"></i>Status: Denda 1%</span>
                    <p class="small text-muted">Jatuh tempo setiap tanggal 7 | Angsuran Rp 5.000.000/bulan | Denda 1% per bulan</p>
                </div>

                <div class="timeline-detail">
                    <div class="timeline-detail-item">
                        <span class="timeline-date"><span class="status-dot danger"></span> 10 Maret 2026</span>
                        <span class="timeline-status"><span class="badge badge-gradient-danger"><i class="mdi mdi-alert-octagon me-1"></i>Denda 1%</span></span>
                        <span class="timeline-denda">Rp 5.000.000 + Rp 50.000</span>
                    </div>
                    <div class="timeline-detail-item">
                        <span class="timeline-date"><span class="status-dot success"></span> 5 Februari 2026</span>
                        <span class="timeline-status"><span class="badge badge-gradient-success"><i class="mdi mdi-check-circle me-1"></i>Lunas</span></span>
                        <span class="timeline-denda">Rp 5.000.000</span>
                    </div>
                    <div class="timeline-detail-item">
                        <span class="timeline-date"><span class="status-dot warning"></span> 3 Januari 2026</span>
                        <span class="timeline-status"><span class="badge badge-gradient-warning"><i class="mdi mdi-clock-outline me-1"></i>Warning</span></span>
                        <span class="timeline-denda">Rp 0</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL DETAIL - DENDA 2% (Merah Tua) -->
<div class="modal fade" id="modalDenda2" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="mdi mdi-history me-2" style="color: #9a55ff;"></i>
                    Timeline Pembayaran - Tenor 8 Tahun (Denda 2%)
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <span class="badge badge-gradient-danger mb-2"><i class="mdi mdi-alert-octagon me-1"></i>Status: Denda 2%</span>
                    <p class="small text-muted">Jatuh tempo setiap tanggal 7 | Angsuran Rp 5.000.000/bulan | Denda 1% per bulan</p>
                </div>

                <div class="timeline-detail">
                    <div class="timeline-detail-item">
                        <span class="timeline-date"><span class="status-dot danger"></span> 18 Maret 2026</span>
                        <span class="timeline-status"><span class="badge badge-gradient-danger"><i class="mdi mdi-alert-octagon me-1"></i>Denda 2%</span></span>
                        <span class="timeline-denda">Rp 5.000.000 + Rp 100.000</span>
                    </div>
                    <div class="timeline-detail-item">
                        <span class="timeline-date"><span class="status-dot success"></span> 5 Februari 2026</span>
                        <span class="timeline-status"><span class="badge badge-gradient-success"><i class="mdi mdi-check-circle me-1"></i>Lunas</span></span>
                        <span class="timeline-denda">Rp 5.000.000</span>
                    </div>
                    <div class="timeline-detail-item">
                        <span class="timeline-date"><span class="status-dot warning"></span> 3 Januari 2026</span>
                        <span class="timeline-status"><span class="badge badge-gradient-warning"><i class="mdi mdi-clock-outline me-1"></i>Warning</span></span>
                        <span class="timeline-denda">Rp 0</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL DETAIL - DENDA 3% (Merah Tua) -->
<div class="modal fade" id="modalDenda3" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="mdi mdi-history me-2" style="color: #9a55ff;"></i>
                    Timeline Pembayaran - Tenor 15 Tahun (Denda 3%)
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <span class="badge badge-gradient-danger mb-2"><i class="mdi mdi-alert-octagon me-1"></i>Status: Denda 3%</span>
                    <p class="small text-muted">Jatuh tempo setiap tanggal 7 | Angsuran Rp 5.000.000/bulan | Denda 1% per bulan</p>
                </div>

                <div class="timeline-detail">
                    <div class="timeline-detail-item">
                        <span class="timeline-date"><span class="status-dot danger"></span> 25 Maret 2026</span>
                        <span class="timeline-status"><span class="badge badge-gradient-danger"><i class="mdi mdi-alert-octagon me-1"></i>Denda 3%</span></span>
                        <span class="timeline-denda">Rp 5.000.000 + Rp 150.000</span>
                    </div>
                    <div class="timeline-detail-item">
                        <span class="timeline-date"><span class="status-dot success"></span> 5 Februari 2026</span>
                        <span class="timeline-status"><span class="badge badge-gradient-success"><i class="mdi mdi-check-circle me-1"></i>Lunas</span></span>
                        <span class="timeline-denda">Rp 5.000.000</span>
                    </div>
                    <div class="timeline-detail-item">
                        <span class="timeline-date"><span class="status-dot warning"></span> 3 Januari 2026</span>
                        <span class="timeline-status"><span class="badge badge-gradient-warning"><i class="mdi mdi-clock-outline me-1"></i>Warning</span></span>
                        <span class="timeline-denda">Rp 0</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL DETAIL - HITAM (Denda 5%) -->
<div class="modal fade" id="modalHitam" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="mdi mdi-history me-2" style="color: #9a55ff;"></i>
                    Timeline Pembayaran - Tenor 20 Tahun (Denda 5%)
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <span class="badge badge-gradient-dark mb-2"><i class="mdi mdi-alert-circle-outline me-1"></i>Status: Denda 5%</span>
                    <p class="small text-muted">Jatuh tempo setiap tanggal 7 | Angsuran Rp 5.000.000/bulan | Denda 1% per bulan</p>
                </div>

                <div class="timeline-detail">
                    <div class="timeline-detail-item">
                        <span class="timeline-date"><span class="status-dot dark"></span> 5 April 2026</span>
                        <span class="timeline-status"><span class="badge badge-gradient-dark"><i class="mdi mdi-alert-circle-outline me-1"></i>Denda 5%</span></span>
                        <span class="timeline-denda">Rp 5.000.000 + Rp 250.000</span>
                    </div>
                    <div class="timeline-detail-item">
                        <span class="timeline-date"><span class="status-dot success"></span> 5 Februari 2026</span>
                        <span class="timeline-status"><span class="badge badge-gradient-success"><i class="mdi mdi-check-circle me-1"></i>Lunas</span></span>
                        <span class="timeline-denda">Rp 5.000.000</span>
                    </div>
                    <div class="timeline-detail-item">
                        <span class="timeline-date"><span class="status-dot warning"></span> 3 Januari 2026</span>
                        <span class="timeline-status"><span class="badge badge-gradient-warning"><i class="mdi mdi-clock-outline me-1"></i>Warning</span></span>
                        <span class="timeline-denda">Rp 0</span>
                    </div>
                    <div class="timeline-detail-item">
                        <span class="timeline-date"><span class="status-dot dark"></span> 15 Desember 2025</span>
                        <span class="timeline-status"><span class="badge badge-gradient-dark"><i class="mdi mdi-alert-circle-outline me-1"></i>Denda 5%</span></span>
                        <span class="timeline-denda">Rp 5.000.000 + Rp 250.000</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    // Inisialisasi DataTables karena ada data (data-use-datatables="true")
    const tableElement = document.getElementById('tableTenor');
    if (tableElement && tableElement.getAttribute('data-use-datatables') === 'true') {
        if ($.fn.DataTable.isDataTable('#tableTenor')) {
            $('#tableTenor').DataTable().destroy();
        }

        $('#tableTenor').DataTable({
            responsive: true,
            ordering: true,
            paging: false,
            info: false,
            searching: false,
            lengthChange: false,
            destroy: true,
            language: {
                emptyTable: "Data tenor belum tersedia",
                zeroRecords: "Data tidak ditemukan",
            },
            columnDefs: [
                { orderable: false, targets: [0, 6] } // Kolom No dan Aksi tidak bisa diurutkan
            ],
            autoWidth: false,
            deferRender: true
        });
    }

    function showLoading(message = 'Mohon tunggu sebentar') {
        Swal.fire({
            title: 'Memuat...',
            text: message,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
    }

    // Filter
    $('.btn-gradient-primary.w-100, .btn-filter').on('click', function(e) {
        e.preventDefault();
        showLoading('Menyaring data...');
        setTimeout(() => {
            Swal.close();
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Filter diterapkan',
                timer: 1500,
                showConfirmButton: false
            });
        }, 1000);
    });

    // Reset
    $('.btn-gradient-secondary.w-100, .btn-reset').on('click', function(e) {
        e.preventDefault();
        showLoading('Mereset filter...');
        setTimeout(() => {
            Swal.close();
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Filter direset',
                timer: 1500,
                showConfirmButton: false
            });
        }, 1000);
    });

    // Save Create
    $('.btn-save-create').on('click', function() {
        showLoading('Menyimpan data...');
        setTimeout(() => {
            Swal.close();
            $('#modalCreate').modal('hide');
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data tenor berhasil ditambahkan',
                timer: 2000,
                timerProgressBar: true,
                showConfirmButton: true,
                confirmButtonText: 'OK'
            });
        }, 1500);
    });

    // Delete
    $('.btn-delete').on('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Hapus Data?',
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                showLoading('Menghapus data...');
                setTimeout(() => {
                    Swal.close();
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Data berhasil dihapus',
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: true,
                        confirmButtonText: 'OK'
                    });
                }, 1000);
            }
        });
    });

    // Back button
    $('.btn-back').on('click', function(e) {
        e.preventDefault();
        showLoading('Kembali ke dashboard...');
        setTimeout(() => {
            Swal.close();
            window.location.href = '#';
        }, 1000);
    });

    // Format Rupiah untuk input angsuran
    $('input[placeholder*="Rp"]').on('input', function() {
        let value = this.value.replace(/\D/g, '');
        if (value) {
            value = parseInt(value).toLocaleString('id-ID');
            this.value = value;
        }
    });
});
</script>
@endpush
