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

        .status-dot.success {
            background: #28a745;
        }

        .status-dot.warning {
            background: #ffc107;
        }

        .status-dot.danger {
            background: #dc3545;
        }

        .status-dot.dark {
            background: #343a40;
        }

        .status-dot.primary {
            background: #9a55ff;
        }

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

        /* ===== TABEL TIMELINE PEMBAYARAN ===== */
        .table-timeline-pembayaran {
            font-size: 0.85rem;
        }

        .table-timeline-pembayaran thead th {
            background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
            color: #9a55ff;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e9ecef;
            padding: 0.75rem 0.5rem;
            white-space: nowrap;
        }

        .table-timeline-pembayaran tbody td {
            vertical-align: middle;
            padding: 0.75rem 0.5rem;
            border-bottom: 1px solid #e9ecef;
        }

        .table-timeline-pembayaran tbody tr:hover {
            background-color: #f8f9fa;
        }

        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: 30px;
            font-size: 0.7rem;
            font-weight: 600;
        }

        .status-badge.paid {
            background: linear-gradient(135deg, #28a745, #5cb85c);
            color: white;
        }

        .status-badge.unpaid {
            background: linear-gradient(135deg, #ffc107, #ffdb6d);
            color: #2c2e3f;
        }

        .status-badge.late {
            background: linear-gradient(135deg, #dc3545, #e4606d);
            color: white;
        }

        .denda-badge {
            color: #dc3545;
            font-weight: 600;
            font-size: 0.8rem;
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
                    <div
                        class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2">
                        <h5 class="card-title mb-0">
                            <i class="mdi mdi-format-list-bulleted me-2 text-primary"></i>
                            Daftar Tenor Pembayaran
                        </h5>
                        <div class="ms-auto">
                            <button class="btn btn-gradient-primary"
                                style="padding: 8px 20px; font-size: 0.95rem; white-space: nowrap;"
                                onclick="$('#modalCreatePayment').modal('show')">
                                <i class="mdi mdi-plus me-1"></i>
                                <span>Tambah Pembayaran</span>
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
                                            <input type="text" class="form-control" placeholder="Cari tenor..."
                                                style="height: 45px;">
                                        </div>

                                        <div class="row g-2">
                                            <div class="col-6">
                                                <button type="button"
                                                    class="btn btn-gradient-primary w-100 py-2 d-flex align-items-center justify-content-center">
                                                    <i class="mdi mdi-filter me-1"></i> Filter
                                                </button>
                                            </div>
                                            <div class="col-6">
                                                <button type="button"
                                                    class="btn btn-gradient-secondary w-100 py-2 d-flex align-items-center justify-content-center">
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
                                                <button type="button"
                                                    class="btn btn-gradient-primary w-100 d-flex align-items-center justify-content-center">
                                                    <i class="mdi mdi-filter me-1"></i>
                                                </button>
                                            </div>

                                            <div class="col-md-2">
                                                <label class="form-label invisible">Reset</label>
                                                <button type="button"
                                                    class="btn btn-gradient-secondary w-100 d-flex align-items-center justify-content-center">
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
                                        <th>User</th>
                                        <th>Tenor</th>
                                        <th>Total Bulan</th>
                                        <th>Jatuh Tempo</th>
                                        <th>Denda Keterlambatan</th>
                                        <th>Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($tenors as $index => $tenor)
                                        @php
                                            $tahun = floor($tenor->tenor_bulan / 12);
                                            $statusColor = match ($tenor->status) {
                                                'done' => 'success',
                                                'process' => 'warning',
                                                'cancel' => 'danger',
                                                default => 'secondary',
                                            };
                                        @endphp

                                        <tr>
                                            <td class="text-center fw-bold">
                                                {{ $index + 1 }}
                                            </td>

                                            <td>
                                                {{ $tenor->booking->customer->full_name ?? '-' }}
                                            </td>

                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-calendar-clock text-primary me-2"
                                                        style="font-size: 1.2rem;"></i>

                                                    <span class="fw-bold">
                                                        {{ $tahun > 0 ? $tahun . ' Tahun' : '-' }}
                                                    </span>
                                                </div>
                                            </td>

                                            <td>
                                                {{ $tenor->tenor_bulan }} Bulan
                                            </td>

                                            <td>
                                                Setiap tanggal
                                                {{ \Carbon\Carbon::parse($tenor->tanggal_mulai_angsuran)->format('d') }}
                                            </td>

                                            <td>
                                                <span class="badge bg-light text-dark">
                                                    {{ $tenor->denda_persen }}% per bulan
                                                </span>
                                            </td>

                                            <td>
                                                <span class="badge badge-gradient-{{ $statusColor }}">
                                                    @if ($tenor->status == 'done')
                                                        <i class="mdi mdi-check-circle me-1"></i> Lunas
                                                    @elseif($tenor->status == 'process')
                                                        <i class="mdi mdi-timer-sand me-1"></i> Berjalan
                                                    @else
                                                        {{ ucfirst($tenor->status) }}
                                                    @endif
                                                </span>
                                            </td>

                                            <td class="text-center">
                                                <div class="action-buttons">
                                                    <a href="javascript:void(0)"
                                                        class="btn btn-outline-info btn-sm btn-detail-tenor"
                                                        data-id="{{ $tenor->id }}" title="Detail Timeline">
                                                        <i class="mdi mdi-eye"></i>
                                                    </a>

                                                    <a href="javascript:void(0)"
                                                        class="btn btn-outline-warning btn-sm btn-edit-tenor"
                                                        data-id="{{ $tenor->id }}"
                                                        data-tenor="{{ $tenor->tenor_bulan }}"
                                                        data-denda="{{ $tenor->denda_persen }}"
                                                        data-metode="{{ $tenor->metode_pembayaran }}" title="Edit">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </a>

                                                    <button class="btn btn-outline-danger btn-sm btn-delete"
                                                        data-id="{{ $tenor->id }}" title="Hapus">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center text-muted">
                                                Data tenor belum tersedia
                                            </td>
                                        </tr>
                                    @endforelse
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
                                <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0"
                                    style="gap: 2px;">
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

    <!-- MODAL CREATE - Tambah Pembayaran Angsuran -->
    <div class="modal fade" id="modalCreatePayment" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="mdi mdi-cash-check me-2" style="color: #9a55ff;"></i>
                        Tambah Pembayaran Angsuran
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formCreatePayment" method="POST" action="{{ route('cash-tempo.storePayment') }}"
                        enctype="multipart/form-data">
                        @csrf

                        <!-- Pilih Customer / Unit -->
                        <div class="modal-form-group">
                            <label><i class="mdi mdi-account-multiple me-1" style="color: #9a55ff;"></i>Customer <span
                                    class="text-danger">*</span></label>
                            <select class="modal-form-control" name="cash_tempo_id" id="selectCashTempo" required>
                                <option value="">-- Pilih Customer / Unit --</option>
                                @foreach ($tenors as $tempo)
                                    <option value="{{ $tempo->id }}"
                                        data-nominal="{{ $tempo->installments->first()->nominal_angsuran ?? '-' }}">
                                        {{ $tempo->booking->customer->full_name ?? '-' }} - Unit
                                        {{ $tempo->booking->unit->unit_name ?? '-' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Nominal Angsuran -->
                        <div class="modal-form-group">
                            <label><i class="mdi mdi-cash-multiple me-1" style="color: #9a55ff;"></i>Nominal
                                Angsuran</label>
                            <input type="text" class="modal-form-control" name="nominal_angsuran"
                                id="nominalAngsuran" readonly value="-">
                        </div>

                        <!-- Status Pembayaran -->
                        <div class="modal-form-group">
                            <label><i class="mdi mdi-checkbox-marked-circle-outline me-1"
                                    style="color: #9a55ff;"></i>Status Pembayaran</label>
                            <select class="modal-form-control" name="status" required>
                                <option value="paid" selected>Lunas</option>
                            </select>
                        </div>

                        <!-- Upload Bukti Pembayaran -->
                        <div class="modal-form-group">
                            <label><i class="mdi mdi-file-upload-outline me-1" style="color: #9a55ff;"></i>Bukti
                                Pembayaran</label>
                            <input type="file" class="modal-form-control" name="bukti_pembayaran"
                                accept="image/*,application/pdf" required>
                            <small class="text-muted">Upload bukti pembayaran (format: jpg, png, pdf)</small>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-gradient-secondary"
                                data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-gradient-primary btn-save-payment">Simpan
                                Pembayaran</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL TIMELINE PEMBAYARAN - DIUBAH MENJADI TABEL -->
    <div class="modal fade" id="modalTimeline" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="mdi mdi-history me-2" style="color:#9a55ff"></i>
                        Timeline Pembayaran
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <span id="statusTenor" class="mb-2"></span>
                        <p class="small text-muted mt-2" id="infoTenor"></p>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-timeline-pembayaran table-hover align-middle w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Jatuh Tempo</th>
                                    <th>Nominal Angsuran</th>
                                    <th>Status</th>
                                    <th>Denda</th>
                                    <th>Total Dibayar</th>
                                </tr>
                            </thead>
                            <tbody id="timelineInstallmentTable">
                                <!-- Akan diisi oleh JavaScript -->
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3 p-3 bg-light rounded" id="ringkasanPembayaran" style="display: none;">
                        <div class="row">
                            <div class="col-md-4">
                                <small class="text-muted d-block">Total Angsuran</small>
                                <span class="fw-bold" id="totalAngsuran">Rp 0</span>
                            </div>
                            <div class="col-md-4">
                                <small class="text-muted d-block">Sudah Dibayar</small>
                                <span class="fw-bold text-success" id="sudahDibayar">Rp 0</span>
                            </div>
                            <div class="col-md-4">
                                <small class="text-muted d-block">Sisa Angsuran</small>
                                <span class="fw-bold text-primary" id="sisaAngsuran">Rp 0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL EDIT TENOR -->
    <div class="modal fade" id="modalEditTenor" tabindex="-1">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="mdi mdi-pencil me-2 text-warning"></i>
                        Edit Cash Tempo
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('cash-tempo.update') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit_id">

                        <div class="mb-3">
                            <label>Tenor Bulan</label>
                            <input type="number" class="form-control" name="tenor_bulan" id="edit_tenor">
                        </div>

                        <div class="mb-3">
                            <label>Denda (%)</label>
                            <input type="number" class="form-control" name="denda_persen" id="edit_denda">
                        </div>

                        <div class="mb-3">
                            <label>Metode Pembayaran</label>
                            <select class="form-control" name="metode_pembayaran" id="edit_metode">
                                <option value="transfer">Transfer</option>
                                <option value="cash">Cash</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-gradient-primary">Simpan Perubahan</button>
                    </div>
                </form>
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
            // Inisialisasi DataTables
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
                    columnDefs: [{
                            orderable: false,
                            targets: [0, 7]
                        }
                    ],
                    autoWidth: false,
                    deferRender: true
                });
            }

            // Fungsi loading
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

            // Format Rupiah
            function formatRupiah(angka) {
                if (!angka) return 'Rp 0';
                return 'Rp ' + Number(angka).toLocaleString('id-ID');
            }

            // Format Tanggal
            function formatTanggal(tanggal) {
                let d = new Date(tanggal);
                return d.toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                });
            }

            // Select Cash Tempo
            $('#selectCashTempo').on('change', function() {
                let selected = $(this).find(':selected');
                let nominal = selected.data('nominal') || 0;
                $('#nominalAngsuran').val(nominal.toLocaleString('id-ID'));
            });

            // Detail Tenor - Tampilkan Timeline dalam bentuk TABEL
            $(document).on('click', '.btn-detail-tenor', function() {
                let id = $(this).data('id');

                $('#timelineInstallmentTable').html('<tr><td colspan="6" class="text-center">Loading...</td></tr>');

                $.get('/cash-tempo/timeline/' + id, function(data) {
                    let statusBadge = '';

                    if (data.status == 'done') {
                        statusBadge = '<span class="badge badge-gradient-success"><i class="mdi mdi-check-circle"></i> Lunas</span>';
                    } else {
                        statusBadge = '<span class="badge badge-gradient-warning"><i class="mdi mdi-timer-sand"></i> Berjalan</span>';
                    }

                    $('#statusTenor').html(statusBadge);

                    $('#infoTenor').html(
                        'Jatuh tempo setiap tanggal ' +
                        new Date(data.tanggal_mulai_angsuran).getDate() +
                        ' | Angsuran ' + formatRupiah(data.sisa_pembayaran / data.tenor_bulan) +
                        ' | Denda ' + data.denda_persen + '% per bulan'
                    );

                    let html = '';
                    let totalDibayar = 0;
                    let totalDenda = 0;

                    data.installments.forEach(function(row, index) {
                        let statusClass = '';
                        let statusText = '';
                        let dendaText = '';

                        if (row.status == 'paid') {
                            statusClass = 'paid';
                            statusText = '<span class="status-badge paid"><i class="mdi mdi-check-circle"></i> Lunas</span>';
                            dendaText = '-';
                            totalDibayar += row.nominal_angsuran;
                        } else {
                            // Cek apakah sudah melewati jatuh tempo
                            let jatuhTempo = new Date(row.jatuh_tempo);
                            let sekarang = new Date();

                            if (jatuhTempo < sekarang) {
                                statusClass = 'late';
                                let denda = row.nominal_angsuran * (data.denda_persen / 100);
                                dendaText = formatRupiah(denda);
                                totalDenda += denda;
                                statusText = '<span class="status-badge late"><i class="mdi mdi-alert"></i> Terlambat</span>';
                            } else {
                                statusClass = 'unpaid';
                                statusText = '<span class="status-badge unpaid"><i class="mdi mdi-clock-outline"></i> Belum Bayar</span>';
                                dendaText = '-';
                            }
                        }

                        html += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${formatTanggal(row.jatuh_tempo)}</td>
                                <td class="fw-bold">${formatRupiah(row.nominal_angsuran)}</td>
                                <td>${statusText}</td>
                                <td class="${row.status != 'paid' && new Date(row.jatuh_tempo) < new Date() ? 'denda-badge' : ''}">${dendaText}</td>
                                <td class="fw-bold">${row.status == 'paid' ? formatRupiah(row.nominal_angsuran) : '-'}</td>
                            </tr>
                        `;
                    });

                    $('#timelineInstallmentTable').html(html);

                    // Tampilkan ringkasan
                    $('#totalAngsuran').text(formatRupiah(data.sisa_pembayaran));
                    $('#sudahDibayar').text(formatRupiah(totalDibayar));
                    $('#sisaAngsuran').text(formatRupiah(data.sisa_pembayaran - totalDibayar));
                    $('#ringkasanPembayaran').show();

                    $('#modalTimeline').modal('show');
                });
            });

            // Edit Tenor
            $(document).on('click', '.btn-edit-tenor', function() {
                let id = $(this).data('id');
                let tenor = $(this).data('tenor');
                let denda = $(this).data('denda');
                let metode = $(this).data('metode');

                $('#edit_id').val(id);
                $('#edit_tenor').val(tenor);
                $('#edit_denda').val(denda);
                $('#edit_metode').val(metode);

                $('#modalEditTenor').modal('show');
            });

            // Submit Form Create Payment
            $('#formCreatePayment').on('submit', function(e) {
                e.preventDefault();

                let formData = new FormData(this);

                $.ajax({
                    url: '/cash-tempo/payments',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Pembayaran berhasil disimpan',
                            timer: 2000,
                            timerProgressBar: true,
                            showConfirmButton: true,
                            confirmButtonText: 'OK'
                        }).then(() => {
                            $('#modalCreatePayment').modal('hide');
                            location.reload();
                        });
                    },
                    error: function(err) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan, coba lagi.',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });

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
