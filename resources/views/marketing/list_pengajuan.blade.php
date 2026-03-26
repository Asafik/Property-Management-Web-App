@extends('layouts.partial.app')

@section('title', 'Customer Booking - Properti Management')

@section('content')

    <style>
        /* ===== SEMUA CSS SAMA PERSIS DENGAN HALAMAN MARKETING JUAL UNIT ===== */
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
            white-space: nowrap;
        }

        .filter-card .form-control,
        .filter-card .form-select {
            padding: 0.5rem 0.75rem;
            font-size: 0.9rem;
            border-radius: 8px;
            height: 40px;
            border: 1px solid #e0e4e9;
            width: 100%;
        }

        .filter-card .btn {
            padding: 0.5rem 0.75rem;
            font-size: 0.85rem;
            height: 40px;
            border-radius: 8px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
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
            height: 40px;
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
        }

        .btn-xs {
            padding: 0.25rem 0.5rem;
            font-size: 0.7rem;
            border-radius: 4px;
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

        /* Outline Buttons - SAMA PERSIS DENGAN MARKETING JUAL UNIT */
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

        .badge.badge-info {
            background: linear-gradient(135deg, #17a2b8, #5bc0de) !important;
            color: #ffffff;
        }

        .badge.badge-success {
            background: linear-gradient(135deg, #28a745, #5cb85c) !important;
            color: #ffffff;
        }

        .badge.badge-warning {
            background: linear-gradient(135deg, #ffc107, #ffdb6d) !important;
            color: #2c2e3f;
        }

        .badge.badge-danger {
            background: linear-gradient(135deg, #dc3545, #e4606d) !important;
            color: #ffffff;
        }

        .badge.badge-primary {
            background: linear-gradient(135deg, #9a55ff, #da8cff) !important;
            color: #ffffff;
        }

        .badge.badge-secondary {
            background: linear-gradient(135deg, #6c757d, #a5b3cb) !important;
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

        .table thead th i {
            margin-right: 5px;
            font-size: 0.9rem;
            color: #9a55ff;
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

        .table tbody td i {
            margin-right: 5px;
            font-size: 1rem;
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

        /* Progress bar styling */
        .progress {
            background-color: #e9ecef;
            border-radius: 10px;
            height: 6px;
        }

        .progress-bar {
            border-radius: 10px;
        }

        .progress-bar.bg-info {
            background: linear-gradient(135deg, #17a2b8, #5bc0de) !important;
        }

        .progress-bar.bg-success {
            background: linear-gradient(135deg, #28a745, #5cb85c) !important;
        }

        .progress-bar.bg-warning {
            background: linear-gradient(135deg, #ffc107, #ffdb6d) !important;
        }

        .progress-bar.bg-danger {
            background: linear-gradient(135deg, #dc3545, #e4606d) !important;
        }

        .progress-bar.bg-primary {
            background: linear-gradient(135deg, #9a55ff, #da8cff) !important;
        }

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
                height: 38px;
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

        /* Styling untuk tombol filter dan reset */
        .btn-filter-reset {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            width: 100%;
            height: 40px;
        }

        .btn-filter-reset i {
            font-size: 1rem;
        }

        /* Row filter spacing */
        .filter-row {
            margin-bottom: 0.5rem;
        }

        .filter-row:last-child {
            margin-bottom: 0;
        }

        /* Kolom filter dengan padding minimal */
        .filter-col {
            padding-left: 3px;
            padding-right: 3px;
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
                                Customer / User Booking
                            </h3>
                            <p class="text-muted mb-0">
                                <i class="mdi mdi-information-outline me-1"></i>
                                Customer / User semua pengajuan KPR dan Cash
                            </p>
                        </div>
                        <div class="d-none d-sm-block">
                            <i class="mdi mdi-account-multiple"
                                style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Row Statistik -->
        <div class="row g-2 g-sm-2 g-md-3 mb-4">
            <div class="col-6 col-sm-6 col-md-6 col-lg-3 mb-2 mb-sm-2 mb-md-3">
                <div class="card bg-gradient-primary card-img-holder text-white h-100">
                    <div class="card-body p-2 p-sm-2 p-md-3">
                        <img src="{{ asset('admin/assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                            alt="circle-image" />
                        <h4 class="font-weight-normal mb-2 mb-sm-2 mb-md-3 small fs-6 fs-sm-6 fs-md-5">
                            Total Pengajuan
                            <i class="mdi mdi-file-document float-end" style="font-size: 1.2rem;"></i>
                        </h4>
                        <h2 class="mb-2 mb-sm-2 mb-md-4 fs-5 fs-sm-5 fs-md-2">{{ $totalPengajuan }}</h2>
                        <h6 class="card-text small">Semua pengajuan</h6>
                    </div>
                </div>
            </div>

            <div class="col-6 col-sm-6 col-md-6 col-lg-3 mb-2 mb-sm-2 mb-md-3">
                <div class="card bg-gradient-info card-img-holder text-white h-100">
                    <div class="card-body p-2 p-sm-2 p-md-3">
                        <img src="{{ asset('admin/assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                            alt="circle-image" />
                        <h4 class="font-weight-normal mb-2 mb-sm-2 mb-md-3 small fs-6 fs-sm-6 fs-md-5">
                            KPR Diproses
                            <i class="mdi mdi-bank float-end" style="font-size: 1.2rem;"></i>
                        </h4>
                        <h2 class="mb-2 mb-sm-2 mb-md-4 fs-5 fs-sm-5 fs-md-2">{{ $totalKpr ?? 15 }}</h2>
                        <h6 class="card-text small">Dalam proses</h6>
                    </div>
                </div>
            </div>

            <div class="col-6 col-sm-6 col-md-6 col-lg-3 mb-2 mb-sm-2 mb-md-3">
                <div class="card bg-gradient-success card-img-holder text-white h-100">
                    <div class="card-body p-2 p-sm-2 p-md-3">
                        <img src="{{ asset('admin/assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                            alt="circle-image" />
                        <h4 class="font-weight-normal mb-2 mb-sm-2 mb-md-3 small fs-6 fs-sm-6 fs-md-5">
                            Cash
                            <i class="mdi mdi-cash float-end" style="font-size: 1.2rem;"></i>
                        </h4>
                        <h2 class="mb-2 mb-sm-2 mb-md-4 fs-5 fs-sm-5 fs-md-2">{{ $totalCash ?? 9 }}</h2>
                        <h6 class="card-text small">Pembayaran tunai</h6>
                    </div>
                </div>
            </div>

            <div class="col-6 col-sm-6 col-md-6 col-lg-3 mb-2 mb-sm-2 mb-md-3">
                <div class="card bg-gradient-warning card-img-holder text-white h-100">
                    <div class="card-body p-2 p-sm-2 p-md-3">
                        <img src="{{ asset('admin/assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                            alt="circle-image" />
                        <h4 class="font-weight-normal mb-2 mb-sm-2 mb-md-3 small fs-6 fs-sm-6 fs-md-5">
                            Cair / Lunas
                            <i class="mdi mdi-check-circle float-end" style="font-size: 1.2rem;"></i>
                        </h4>
                        <h2 class="mb-2 mb-sm-2 mb-md-4 fs-5 fs-sm-5 fs-md-2">{{ $totalLunas ?? 12 }}</h2>
                        <h6 class="card-text small">Selesai</h6>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel List Pengajuan (dengan filter di dalamnya) -->
        <div class="row mt-2 mt-sm-2 mt-md-3">
            <div class="col-12">
                <div class="card">
                    <div
                        class="card-header bg-white d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                        <h5 class="card-title mb-2 mb-md-0">
                            <i class="mdi mdi-format-list-bulleted me-2 text-primary"></i>
                            Daftar Pengajuan
                        </h5>
                        <div class="d-flex gap-2">
                            <button class="btn btn-sm btn-gradient-success" onclick="alert('Export Excel')">
                                <i class="mdi mdi-file-excel me-1"></i><span class="d-none d-sm-inline">Excel</span>
                            </button>
                            <button class="btn btn-sm btn-gradient-danger" onclick="alert('Export PDF')">
                                <i class="mdi mdi-file-pdf me-1"></i><span class="d-none d-sm-inline">PDF</span>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Filter Section - SEJAJAR SEPERTI MARKETING JUAL UNIT -->
                        <div class="filter-card">
                            <div class="card-body">
                                <h6 class="card-title mb-3" style="font-size: 1rem;">
                                    <i class="mdi mdi-filter-outline me-1"></i>Filter Data
                                </h6>

                                <!-- FILTER UNTUK MOBILE -->
                                <div class="d-block d-md-none">
                                    <form method="GET" action="{{ url('marketing/list-pengajuan') }}">
                                        <!-- Baris 1: Pencarian -->
                                        <div class="row filter-row">
                                            <div class="col-12">
                                                <label class="form-label">
                                                    <i class="mdi mdi-magnify me-1"></i>Pencarian
                                                </label>
                                                <input type="text" name="search" class="form-control"
                                                    value="{{ request('search') }}"
                                                    placeholder="Cari customer, no booking, unit...">
                                            </div>
                                        </div>

                                        <!-- Baris 2: Status & Metode -->
                                        <div class="row filter-row">
                                            <div class="col-6">
                                                <label class="form-label">
                                                    <i class="mdi mdi-chart-arc me-1"></i>Status
                                                </label>
                                                <select name="status" class="form-control">
                                                    <option value="">Semua Status</option>
                                                    <option value="draft"
                                                        {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                                    <option value="pengajuan"
                                                        {{ request('status') == 'pengajuan' ? 'selected' : '' }}>Pengajuan
                                                    </option>
                                                    <option value="verifikasi"
                                                        {{ request('status') == 'verifikasi' ? 'selected' : '' }}>
                                                        Verifikasi</option>
                                                    <option value="survey"
                                                        {{ request('status') == 'survey' ? 'selected' : '' }}>Survey
                                                    </option>
                                                    <option value="akad"
                                                        {{ request('status') == 'akad' ? 'selected' : '' }}>Akad</option>
                                                    <option value="cair"
                                                        {{ request('status') == 'cair' ? 'selected' : '' }}>Cair</option>
                                                    <option value="lunas"
                                                        {{ request('status') == 'lunas' ? 'selected' : '' }}>Lunas</option>
                                                    <option value="ditolak"
                                                        {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">
                                                    <i class="mdi mdi-cash-multiple me-1"></i>Metode
                                                </label>
                                                <select name="metode" class="form-control">
                                                    <option value="">Semua Metode</option>
                                                    <option value="kpr"
                                                        {{ request('metode') == 'kpr' ? 'selected' : '' }}>KPR</option>
                                                    <option value="cash"
                                                        {{ request('metode') == 'cash' ? 'selected' : '' }}>Cash</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Baris 3: Marketing & Tampil -->
                                        <div class="row filter-row">
                                            <div class="col-6">
                                                <label class="form-label">
                                                    <i class="mdi mdi-account-tie me-1"></i>Marketing
                                                </label>
                                                <select name="marketing_id" class="form-control">
                                                    <option value="">Semua Marketing</option>
                                                    @foreach ($marketing as $m)
                                                        <option value="{{ $m->id }}"
                                                            {{ request('employee_id') == $m->id ? 'selected' : '' }}>
                                                            {{ $m->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">
                                                    <i class="mdi mdi-counter me-1"></i>Tampil
                                                </label>
                                                <select name="per_page" class="form-control">
                                                    <option value="10"
                                                        {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                                    <option value="25"
                                                        {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                                    <option value="50"
                                                        {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                                    <option value="100"
                                                        {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Baris 4: Button Filter & Reset -->
                                        <div class="row filter-row">
                                            <div class="col-6">
                                                <button type="submit"
                                                    class="btn btn-gradient-primary w-100 btn-filter-reset">
                                                    <i class="mdi mdi-filter-outline"></i> Filter
                                                </button>
                                            </div>
                                            <div class="col-6">
                                                <a href="{{ url('marketing/list-pengajuan') }}"
                                                    class="btn btn-gradient-secondary w-100 btn-filter-reset">
                                                    <i class="mdi mdi-refresh"></i> Reset
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- FILTER UNTUK TABLET & DESKTOP - SEJAJAR -->
                                <div class="d-none d-md-block">
                                    <form method="GET" action="{{ url('marketing/list-pengajuan') }}">
                                        <div class="row g-1 align-items-end">
                                            <!-- Pencarian (lebih besar) -->
                                            <div class="col-md-3 filter-col">
                                                <label class="form-label">
                                                    <i class="mdi mdi-magnify me-1"></i>Pencarian
                                                </label>
                                                <input type="text" name="search" class="form-control"
                                                    value="{{ request('search') }}"
                                                    placeholder="Cari customer, no booking, unit...">
                                            </div>

                                            <!-- Status -->
                                            <div class="col-md-2 filter-col">
                                                <label class="form-label">
                                                    <i class="mdi mdi-chart-arc me-1"></i>Status
                                                </label>
                                                <select name="status" class="form-control">
                                                    <option value="">Semua Status</option>
                                                    <option value="draft"
                                                        {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                                    <option value="pengajuan"
                                                        {{ request('status') == 'pengajuan' ? 'selected' : '' }}>Pengajuan
                                                    </option>
                                                    <option value="verifikasi"
                                                        {{ request('status') == 'verifikasi' ? 'selected' : '' }}>
                                                        Verifikasi</option>
                                                    <option value="survey"
                                                        {{ request('status') == 'survey' ? 'selected' : '' }}>Survey
                                                    </option>
                                                    <option value="akad"
                                                        {{ request('status') == 'akad' ? 'selected' : '' }}>Akad</option>
                                                    <option value="cair"
                                                        {{ request('status') == 'cair' ? 'selected' : '' }}>Cair</option>
                                                    <option value="lunas"
                                                        {{ request('status') == 'lunas' ? 'selected' : '' }}>Lunas</option>
                                                    <option value="ditolak"
                                                        {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak
                                                    </option>
                                                </select>
                                            </div>

                                            <!-- Metode (diperkecil) -->
                                            <div class="col-md-1 filter-col">
                                                <label class="form-label">
                                                    <i class="mdi mdi-cash-multiple me-1"></i>Metode
                                                </label>
                                                <select name="metode" class="form-control">
                                                    <option value="">Semua</option>
                                                    <option value="kpr"
                                                        {{ request('metode') == 'kpr' ? 'selected' : '' }}>KPR</option>
                                                    <option value="cash"
                                                        {{ request('metode') == 'cash' ? 'selected' : '' }}>Cash</option>
                                                </select>
                                            </div>

                                            <!-- Marketing (diperkecil) -->
                                            <div class="col-md-2 filter-col">
                                                <label class="form-label">
                                                    <i class="mdi mdi-account-tie me-1"></i>Marketing
                                                </label>
                                                <select name="marketing_id" class="form-control">
                                                    <option value="">Semua Marketing</option>
                                                    @foreach ($marketing as $m)
                                                        <option value="{{ $m->id }}"
                                                            {{ request('employee_id') == $m->id ? 'selected' : '' }}>
                                                            {{ $m->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Tampil (diperkecil) -->
                                            <div class="col-md-1 filter-col">
                                                <label class="form-label">
                                                    <i class="mdi mdi-counter me-1"></i>Tampil
                                                </label>
                                                <select name="per_page" class="form-control">
                                                    <option value="10"
                                                        {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                                    <option value="25"
                                                        {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                                    <option value="50"
                                                        {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                                    <option value="100"
                                                        {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                                                </select>
                                            </div>

                                            <!-- Button Filter -->
                                            <div class="col-md-1 filter-col">
                                                <label class="form-label" style="visibility: hidden;">Filter</label>
                                                <button type="submit"
                                                    class="btn btn-gradient-primary w-100 btn-filter-reset"
                                                    title="Filter">
                                                    <i class="mdi mdi-filter-outline"></i>
                                                </button>
                                            </div>

                                            <!-- Button Reset -->
                                            <div class="col-md-1 filter-col">
                                                <label class="form-label" style="visibility: hidden;">Reset</label>
                                                <a href="{{ url('marketing/list-pengajuan') }}"
                                                    class="btn btn-gradient-secondary w-100 btn-filter-reset"
                                                    title="Reset">
                                                    <i class="mdi mdi-refresh"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Tabel DENGAN ICON DI SEMUA KOLOM -->
                        <div class="table-responsive">
                            @php
                                $highlightBooking = request('booking_id');
                            @endphp

                            <style>
                                .highlight-row {
                                    animation: highlightFade 2s ease;
                                }

                                @keyframes highlightFade {
                                    0% {
                                        background-color: #fff3cd;
                                    }

                                    100% {
                                        background-color: inherit;
                                    }
                                }
                            </style>

                            <table class="table table-hover" id="tableMarketing" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center"><i class="mdi mdi-counter"></i> No</th>
                                        <th><i class="mdi mdi-ticket"></i> Booking ID</th>
                                        <th><i class="mdi mdi-account"></i> Customer</th>
                                        <th><i class="mdi mdi-home"></i> Unit</th>
                                        <th><i class="mdi mdi-cash-multiple"></i> Metode</th>
                                        <th><i class="mdi mdi-chart-arc"></i> Status</th>
                                        <th><i class="mdi mdi-progress-clock"></i> Progress</th>
                                        <th><i class="mdi mdi-account-tie"></i> Marketing</th>
                                        <th class="text-center"><i class="mdi mdi-cog"></i> Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($bookings as $booking)

                                        <tr class="{{ $highlightBooking == $booking->id ? 'table-warning highlight-row' : '' }}"
                                            id="booking-{{ $booking->id }}">

                                            <td class="text-center fw-bold">{{ $loop->iteration }}</td>

                                            <td>
                                                <i class="mdi mdi-ticket text-primary me-1"></i>
                                                <span class="fw-medium small">{{ $booking->booking_code }}</span>
                                            </td>

                                            <td class="small">
                                                <i class="mdi mdi-account text-info me-1"></i>
                                                {{ $booking->customer->full_name ?? '-' }}
                                            </td>

                                            <td class="small">
                                                <i class="mdi mdi-home text-warning me-1"></i>
                                                {{ $booking->unit->block ?? '' }} {{ $booking->unit->unit_number ?? '' }}
                                            </td>

                                            <td>
                                                @if ($booking->purchase_type == 'kpr')
                                                    <span class="badge badge-info badge-sm">
                                                        <i class="mdi mdi-bank me-1"></i>KPR
                                                    </span>
                                                @elseif ($booking->purchase_type == 'cash')
                                                    <span class="badge badge-success badge-sm">
                                                        <i class="mdi mdi-cash me-1"></i>Cash
                                                    </span>
                                                @elseif ($booking->purchase_type == 'cash_tempo')
                                                    <span class="badge badge-warning badge-sm">
                                                        <i class="mdi mdi-calendar-clock me-1"></i>Cash Tempo
                                                    </span>
                                                @endif
                                            </td>

                                            <td>
                                                @switch($booking->status)
                                                    @case('active')
                                                        <span class="badge badge-warning badge-sm">
                                                            <i class="mdi mdi-clock-outline me-1"></i>Active
                                                        </span>
                                                    @break

                                                    @case('akad')
                                                        <span class="badge badge-primary badge-sm">
                                                            <i class="mdi mdi-handshake me-1"></i>Akad
                                                        </span>
                                                    @break

                                                    @case('cash_process')
                                                        <span class="badge badge-success badge-sm">
                                                            <i class="mdi mdi-check-circle me-1"></i>Lunas
                                                        </span>
                                                    @break

                                                    @case('lanjut_kpr')
                                                        <span class="badge badge-info badge-sm">
                                                            <i class="mdi mdi-arrow-right-bold me-1"></i>Lanjut KPR
                                                        </span>
                                                    @break

                                                    @case('legal_done')
                                                        <span class="badge badge-secondary badge-sm">
                                                            <i class="mdi mdi-file-document-check-outline me-1"></i>Legal Done
                                                        </span>
                                                    @break

                                                    @case('completed')
                                                        <span class="badge badge-dark badge-sm">
                                                            <i class="mdi mdi-flag-checkered me-1"></i>Completed
                                                        </span>
                                                    @break

                                                    @case('cancelled')
                                                        <span class="badge badge-danger badge-sm">
                                                            <i class="mdi mdi-close-circle me-1"></i>Ditolak
                                                        </span>
                                                    @break

                                                    @default
                                                        <span class="badge badge-secondary badge-sm">
                                                            <i
                                                                class="mdi mdi-information-outline me-1"></i>{{ ucfirst($booking->status) }}
                                                        </span>
                                                @endswitch
                                            </td>

                                            <td>

                                                @php
                                                    $progress = match ($booking->status) {
                                                        'active' => 25,
                                                        'survey' => 40,
                                                        'lanjut_kpr' => 50,
                                                        'cash_process' => 60,
                                                        'akad' => 80,
                                                        'completed' => 100,
                                                        'cancelled' => 0,
                                                        default => 10,
                                                    };
                                                @endphp

                                                <div class="d-flex align-items-center gap-2">

                                                    <div class="progress w-100" style="height:6px;">
                                                        <div class="progress-bar" style="width: {{ $progress }}%">
                                                        </div>
                                                    </div>

                                                    <span class="small">{{ $progress }}%</span>

                                                </div>

                                            </td>

                                            <td class="small">
                                                <i class="mdi mdi-account-tie text-primary me-1"></i>
                                                {{ $booking->sales->name ?? '-' }}
                                            </td>

                                            <td class="text-center">

                                                <div
                                                    class="d-flex justify-content-center align-items-center gap-2 flex-wrap">

                                                    @if ($booking->status === 'completed')
                                                        <a href="{{ route('unit.selesai', $booking->id) }}"
                                                            class="btn btn-success btn-sm" title="Unit Selesai">
                                                            <i class="mdi mdi-check-decagram"></i>
                                                        </a>
                                                    @else
                                                        @if ($booking->purchase_type == 'kpr')
                                                            @if (!$booking->kprApplication || $booking->kprApplication->status != 'pengajuan')
                                                                <a href="{{ route('pengajuan.show', $booking->id) }}"
                                                                    class="btn btn-outline-primary btn-sm"
                                                                    title="Proses KPR">
                                                                    <i class="mdi mdi-bank"></i>
                                                                </a>
                                                            @endif
                                                        @endif

                                                        @if ($booking->purchase_type == 'cash')
                                                            <a href="{{ route('marketing.cash', $booking->id) }}"
                                                                class="btn btn-outline-success btn-sm"
                                                                title="Proses Cash">
                                                                <i class="mdi mdi-cash"></i>
                                                            </a>
                                                        @endif

                                                        @if ($booking->purchase_type == 'cash_tempo')
                                                            <a href="{{ route('marketing.cash_tempo', $booking->id) }}"
                                                                class="btn btn-outline-warning btn-sm"
                                                                title="Proses Cash Tempo">
                                                                <i class="mdi mdi-calendar-clock"></i>
                                                            </a>
                                                        @endif
                                                    @endif

                                                    <a href="#" class="btn btn-outline-info btn-sm" title="Detail">
                                                        <i class="mdi mdi-eye"></i>
                                                    </a>

                                                    <a href="#" class="btn btn-outline-warning btn-sm"
                                                        title="Edit">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </a>

                                                    <form action="#" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" class="btn btn-outline-danger btn-sm"
                                                            title="Hapus">

                                                            <i class="mdi mdi-delete"></i>

                                                        </button>

                                                    </form>

                                                </div>

                                            </td>

                                        </tr>

                                    @endforeach
                                </tbody>

                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-3">
                            <div class="pagination-info mb-2 mb-sm-0">
                                <i class="mdi mdi-information-outline me-1"></i>
                                Menampilkan {{ $bookings->firstItem() ?? 0 }} - {{ $bookings->lastItem() ?? 0 }} dari
                                {{ $bookings->total() }} data
                            </div>
                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0"
                                    style="gap: 2px;">
                                    {{-- Previous Page Link --}}
                                    <li class="page-item {{ $bookings->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $bookings->previousPageUrl() }}" tabindex="-1"
                                            aria-label="Previous">
                                            <i class="mdi mdi-chevron-left"></i>
                                        </a>
                                    </li>

                                    {{-- Page Links --}}
                                    @for ($i = 1; $i <= $bookings->lastPage(); $i++)
                                        <li class="page-item {{ $i == $bookings->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $bookings->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor

                                    {{-- Next Page Link --}}
                                    <li class="page-item {{ $bookings->hasMorePages() ? '' : 'disabled' }}">
                                        <a class="page-link" href="{{ $bookings->nextPageUrl() }}" aria-label="Next">
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

.stat-card .stat-icon.proyek {
    background: linear-gradient(135deg, #667eea, #764ba2);
}
.stat-card .stat-icon.unit {
    background: linear-gradient(135deg, #f093fb, #f5576c);
}
.stat-card .stat-icon.transaksi {
    background: linear-gradient(135deg, #4facfe, #00f2fe);
}
.stat-card .stat-icon.pendapatan {
    background: linear-gradient(135deg, #43e97b, #38f9d7);
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
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.stat-card .stat-content p {
    font-size: 0.9rem;
    color: #6c757d;
    margin-bottom: 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.filter-card {
    background: linear-gradient(135deg, #f9f7ff, #f2ecff);
    border-radius: 12px;
    padding: 1rem;
    margin-bottom: 1.25rem;
    border: none;
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
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
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
    background: linear-gradient(135deg, #28a745, #6bdc8b) !important;
    color: #fff !important;
}

.btn-gradient-danger {
    background: linear-gradient(135deg, #dc3545, #e4606d) !important;
    color: #fff !important;
}

.table-responsive {
    overflow-x: auto;
    overflow-y: hidden;
    -webkit-overflow-scrolling: touch;
    border-radius: 8px;
    margin-bottom: 0.5rem;
    scrollbar-width: thin;
    scrollbar-color: #9a55ff #f0f0f0;
}

.table-responsive::-webkit-scrollbar {
    width: 8px;
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

.table-responsive::-webkit-scrollbar-corner {
    background: #f0f0f0;
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

.table thead th:first-child {
    width: 40px;
    text-align: center;
}

.table tbody td:first-child {
    font-weight: 500;
    width: 40px;
    text-align: center;
}

.table tbody td {
    vertical-align: middle;
    font-size: 0.85rem;
    padding: 0.8rem 0.5rem;
    border-bottom: 1px solid #e9ecef;
    color: #2c2e3f;
    white-space: nowrap;
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

.booking-id {
    display: inline-flex;
    align-items: center;
    gap: 0.45rem;
    color: #9a55ff;
    font-weight: 700;
}

.booking-id i {
    font-size: 1rem;
}

.customer-info {
    display: flex;
    align-items: center;
    gap: 0.65rem;
}

.customer-initial {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: linear-gradient(135deg, #da8cff, #9a55ff);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.9rem;
    font-weight: 700;
    flex-shrink: 0;
    box-shadow: 0 4px 10px rgba(154, 85, 255, 0.2);
}

.customer-name {
    font-weight: 600;
    color: #2c2e3f;
}

.badge-method,
.badge-status {
    padding: 0.35rem 0.8rem;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.82rem;
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
}

.badge-method.kpr {
    background: linear-gradient(135deg, #17a2b8, #56c6d8);
    color: #fff;
}

.badge-method.cash {
    background: linear-gradient(135deg, #28a745, #6bdc8b);
    color: #fff;
}

.badge-method.cash-tempo {
    background: linear-gradient(135deg, #ffb347, #ffcc33);
    color: #fff;
}

.badge-status.booking {
    background: #eef1f5;
    color: #6c7383;
}

.badge-status.diproses {
    background: #fff4db;
    color: #b78103;
}

.badge-status.aktif {
    background: #dff5e8;
    color: #1d7f47;
}

.badge-status.review {
    background: #e7f0ff;
    color: #3366cc;
}

.badge-status.pending {
    background: #fce8e8;
    color: #d9534f;
}

.badge-status.complete {
    background: linear-gradient(135deg, #43e97b, #38f9d7);
    color: #ffffff;
}

.agent-sales {
    display: flex;
    align-items: center;
    gap: 0.45rem;
    font-weight: 600;
    color: #495057;
}

.agent-sales i {
    font-size: 1.1rem;
    color: #9a55ff;
}

.progress-wrapper {
    min-width: 160px;
    display: flex;
    align-items: center;
    gap: 0.65rem;
}

.progress-label {
    font-size: 0.8rem;
    font-weight: 700;
    color: #6c7383;
    margin-bottom: 0;
    min-width: 42px;
    text-align: right;
    flex-shrink: 0;
}

.custom-progress {
    flex: 1;
    height: 10px;
    background: #eceff3;
    border-radius: 999px;
    overflow: hidden;
    position: relative;
}

.custom-progress-bar {
    height: 100%;
    border-radius: 999px;
    background: linear-gradient(90deg, #da8cff, #9a55ff);
    transition: width 0.3s ease;
}

.custom-progress-bar.complete {
    background: linear-gradient(90deg, #43e97b, #38f9d7);
}

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
    text-decoration: none;
}

.btn-action i {
    font-size: 1.1rem;
}

.btn-action.method-kpr {
    background: linear-gradient(135deg, #17a2b8, #56c6d8);
    color: #fff;
}

.btn-action.method-kpr:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(23, 162, 184, 0.35);
}

.btn-action.method-cash {
    background: linear-gradient(135deg, #28a745, #6bdc8b);
    color: #fff;
}

.btn-action.method-cash:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(40, 167, 69, 0.35);
}

.btn-action.method-cash-tempo {
    background: linear-gradient(135deg, #ffb347, #ffcc33);
    color: #fff;
}

.btn-action.method-cash-tempo:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(255, 179, 71, 0.35);
}

.btn-action.method-complete {
    background: linear-gradient(135deg, #43e97b, #38f9d7);
    color: #fff;
}

.btn-action.method-complete:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(67, 233, 123, 0.35);
}

.btn-action.view {
    background: linear-gradient(135deg, #da8cff, #9a55ff);
    color: #fff;
}

.btn-action.view:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(154, 85, 255, 0.35);
}

.btn-action.edit {
    background: linear-gradient(135deg, #ffc107, #ffdb6d);
    color: #2c2e3f;
}

.btn-action.edit:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(255, 193, 7, 0.35);
}

.btn-action.delete {
    background: linear-gradient(135deg, #dc3545, #e4606d);
    color: #fff;
}

.btn-action.delete:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(220, 53, 69, 0.35);
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
    text-decoration: none;
}

.page-item.active .page-link {
    background: linear-gradient(to right, #da8cff, #9a55ff);
    border-color: transparent;
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(154, 85, 255, 0.3);
}

.pagination-info {
    font-size: 0.8rem;
    color: #6c7383;
}

.text-primary {
    color: #9a55ff !important;
}

.text-muted {
    color: #a5b3cb !important;
}

.fw-bold {
    font-weight: 600 !important;
}

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

.mdi {
    vertical-align: middle;
}

.table thead th.sortable {
    cursor: pointer;
    transition: all 0.2s ease;
}
.table thead th.sortable:hover {
    color: #7a3fcc;
}
.table thead th.sortable i {
    font-size: 0.8rem;
    margin-left: 4px;
    opacity: 0.5;
}
.table thead th.active-sort {
    color: #7a3fcc;
}
.table thead th.active-sort i {
    opacity: 1;
    color: #7a3fcc;
}

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

.filter-tampil-col {
    flex: 0 0 90px;
    max-width: 90px;
}

.filter-action-col {
    flex: 0 0 128px;
    max-width: 128px;
}

@media (max-width: 767px) {
    .filter-row-desktop { display: none; }
    .filter-row-mobile  { display: block; margin-top: 1rem; }
}

.btn-icon-only {
    width: 58px;
    height: 44px;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
}
.btn-icon-only i {
    font-size: 1.25rem;
    margin: 0;
}
.btn-icon-only-mobile {
    width: 100%;
    height: 44px;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
}
.btn-icon-only-mobile i {
    font-size: 1.2rem;
    margin: 0;
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

    .progress-wrapper {
        min-width: 130px;
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
</style>

<div class="container-fluid p-2 p-sm-3 p-md-4">

    <div class="row mb-3 mb-sm-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="text-dark mb-1">
                            <i class="mdi mdi-home-city-outline me-2" style="color: #9a55ff;"></i>Customer Booking
                        </h3>
                        <p class="text-muted mb-0">
                            Monitoring semua pengajuan KPR dan Cash
                        </p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-clipboard-text-search-outline" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon proyek">
                    <i class="mdi mdi-file-document-multiple-outline"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $totalPengajuan ?? $bookings->total() ?? $bookings->count() }}</h3>
                    <p>Total Pengajuan</p>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon unit">
                    <i class="mdi mdi-bank-outline"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $totalKpr ?? 0 }}</h3>
                    <p>KPR Diproses</p>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon transaksi">
                    <i class="mdi mdi-cash-multiple"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $totalCash ?? 0 }}</h3>
                    <p>Cash / Tempo</p>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon pendapatan">
                    <i class="mdi mdi-check-decagram-outline"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $totalLunas ?? 0 }}</h3>
                    <p>Complete</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-format-list-bulleted me-2"></i>Daftar Pengajuan
                    </h5>

                    <div class="d-flex flex-wrap gap-2">
                        <button type="button" class="btn btn-gradient-success" onclick="handleImport()">
                            <i class="mdi mdi-upload me-1"></i>Import
                        </button>
                        <button type="button" class="btn btn-gradient-primary" onclick="handleExport()">
                            <i class="mdi mdi-download me-1"></i>Export
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="filter-card mb-4">
                        <div class="card-body">
                            <!-- DESKTOP VERSION -->
                            <div class="filter-row-desktop">
                                <div class="filter-text">
                                    <i class="mdi mdi-filter-outline"></i>
                                    <span>Filter data pengajuan</span>
                                </div>
                                <form id="filterForm" method="GET" action="{{ url('marketing/list-pengajuan') }}">
                                    <div class="row g-2 align-items-end w-100">
                                        <div class="col-md-3">
                                            <label class="form-label">Search</label>
                                            <input type="text" class="form-control" name="search" id="searchInput" placeholder="ID / Nama / Unit" value="{{ request('search') }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Status</label>
                                            <select class="form-control" name="status">
                                                <option value="">Semua</option>
                                                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                                <option value="pengajuan" {{ request('status') == 'pengajuan' ? 'selected' : '' }}>Pengajuan</option>
                                                <option value="verifikasi" {{ request('status') == 'verifikasi' ? 'selected' : '' }}>Verifikasi</option>
                                                <option value="survey" {{ request('status') == 'survey' ? 'selected' : '' }}>Survey</option>
                                                <option value="lanjut_kpr" {{ request('status') == 'lanjut_kpr' ? 'selected' : '' }}>Lanjut KPR</option>
                                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                                                <option value="akad" {{ request('status') == 'akad' ? 'selected' : '' }}>Akad</option>
                                                <option value="cash_process" {{ request('status') == 'cash_process' ? 'selected' : '' }}>Cash Process</option>
                                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Complete</option>
                                                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Ditolak</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Metode</label>
                                            <select class="form-control" name="metode">
                                                <option value="">Semua</option>
                                                <option value="kpr" {{ request('metode') == 'kpr' ? 'selected' : '' }}>KPR</option>
                                                <option value="cash" {{ request('metode') == 'cash' ? 'selected' : '' }}>Cash</option>
                                                <option value="cash_tempo" {{ request('metode') == 'cash_tempo' ? 'selected' : '' }}>Cash Tempo</option>
                                            </select>
                                        </div>

                                        <div class="col-md-auto filter-tampil-col">
                                            <label class="form-label">Tampil</label>
                                            <select class="form-control" name="per_page">
                                                <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                                <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
                                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                            </select>
                                        </div>

                                        <div class="col-md-auto filter-action-col">
                                            <div class="d-flex gap-2">
                                                <button type="submit" class="btn btn-gradient-primary btn-icon-only flex-fill" title="Filter" onclick="showFilterLoading()">
                                                    <i class="mdi mdi-filter"></i>
                                                </button>
                                                <a href="{{ url('marketing/list-pengajuan') }}" class="btn btn-gradient-secondary btn-icon-only flex-fill" title="Reset" onclick="showResetLoading(event)">
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
                                    <span>Filter data pengajuan</span>
                                </div>
                                <form method="GET" action="{{ url('marketing/list-pengajuan') }}">
                                    <div class="row g-2">
                                        <div class="col-12 mb-2">
                                            <label class="form-label">Search</label>
                                            <input type="text" class="form-control" name="search" placeholder="ID Booking / Nama / Unit" value="{{ request('search') }}">
                                        </div>
                                        <div class="col-12 mb-2">
                                            <label class="form-label">Status</label>
                                            <select class="form-control" name="status">
                                                <option value="">Semua</option>
                                                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                                <option value="pengajuan" {{ request('status') == 'pengajuan' ? 'selected' : '' }}>Pengajuan</option>
                                                <option value="verifikasi" {{ request('status') == 'verifikasi' ? 'selected' : '' }}>Verifikasi</option>
                                                <option value="survey" {{ request('status') == 'survey' ? 'selected' : '' }}>Survey</option>
                                                <option value="lanjut_kpr" {{ request('status') == 'lanjut_kpr' ? 'selected' : '' }}>Lanjut KPR</option>
                                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                                                <option value="akad" {{ request('status') == 'akad' ? 'selected' : '' }}>Akad</option>
                                                <option value="cash_process" {{ request('status') == 'cash_process' ? 'selected' : '' }}>Cash Process</option>
                                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Complete</option>
                                                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Ditolak</option>
                                            </select>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <label class="form-label">Metode</label>
                                            <select class="form-control" name="metode">
                                                <option value="">Semua</option>
                                                <option value="kpr" {{ request('metode') == 'kpr' ? 'selected' : '' }}>KPR</option>
                                                <option value="cash" {{ request('metode') == 'cash' ? 'selected' : '' }}>Cash</option>
                                                <option value="cash_tempo" {{ request('metode') == 'cash_tempo' ? 'selected' : '' }}>Cash Tempo</option>
                                            </select>
                                        </div>

                                        <div class="col-12 mb-2">
                                            <label class="form-label">Tampil</label>
                                            <select class="form-control" name="per_page">
                                                <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                                <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
                                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                            </select>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <div class="d-flex gap-2">
                                                <button type="submit" class="btn btn-gradient-primary btn-icon-only-mobile flex-fill" title="Filter" onclick="showFilterLoading()">
                                                    <i class="mdi mdi-filter"></i>
                                                </button>
                                                <a href="{{ url('marketing/list-pengajuan') }}" class="btn btn-gradient-secondary btn-icon-only-mobile flex-fill" title="Reset" onclick="showResetLoading(event)">
                                                    <i class="mdi mdi-refresh"></i>
                                                </a>
                                            </div>
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
                                    <th class="text-center">No</th>
                                    <th class="sortable {{ request('sort') == 'id_booking' ? 'active-sort' : '' }}" data-field="id_booking" data-direction="{{ request('sort') == 'id_booking' ? (request('direction') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        ID Booking
                                        @if(request('sort') == 'id_booking')
                                            <i class="mdi mdi-{{ request('direction') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable {{ request('sort') == 'name' ? 'active-sort' : '' }}" data-field="name" data-direction="{{ request('sort') == 'name' ? (request('direction') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Customer
                                        @if(request('sort') == 'name')
                                            <i class="mdi mdi-{{ request('direction') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th>Unit</th>
                                    <th class="sortable {{ request('sort') == 'purchase_type' ? 'active-sort' : '' }}" data-field="purchase_type" data-direction="{{ request('sort') == 'purchase_type' ? (request('direction') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Metode
                                        @if(request('sort') == 'purchase_type')
                                            <i class="mdi mdi-{{ request('direction') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable {{ request('sort') == 'status' ? 'active-sort' : '' }}" data-field="status" data-direction="{{ request('sort') == 'status' ? (request('direction') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Status
                                        @if(request('sort') == 'status')
                                            <i class="mdi mdi-{{ request('direction') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th>Progress</th>
                                    <th>Agent / Sales</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($bookings as $index => $booking)
                                    @php
                                        $customerName = $booking->customer->full_name ?? '-';

                                        $initials = '';
                                        foreach (explode(' ', trim($customerName)) as $word) {
                                            if ($word !== '') {
                                                $initials .= strtoupper(substr($word, 0, 1));
                                            }
                                        }
                                        $initials = substr($initials ?: 'C', 0, 2);

                                        $progress = match ($booking->status) {
                                            'draft' => 10,
                                            'pengajuan' => 20,
                                            'verifikasi' => 35,
                                            'survey' => 40,
                                            'lanjut_kpr' => 50,
                                            'active' => 25,
                                            'cash_process' => 60,
                                            'akad' => 80,
                                            'completed', 'lunas' => 100,
                                            'cancelled' => 0,
                                            default => 15,
                                        };

                                        $displayStatus = $progress == 100 ? 'Complete' : match ($booking->status) {
                                            'draft' => 'Draft',
                                            'pengajuan' => 'Pengajuan',
                                            'verifikasi' => 'Verifikasi',
                                            'survey' => 'Survey',
                                            'lanjut_kpr' => 'Lanjut KPR',
                                            'active' => 'Aktif',
                                            'akad' => 'Akad',
                                            'cash_process' => 'Cash Process',
                                            'lunas' => 'Lunas',
                                            'cancelled' => 'Ditolak',
                                            default => ucfirst($booking->status),
                                        };

                                        $statusClass = $progress == 100 ? 'complete' : match ($booking->status) {
                                            'draft' => 'booking',
                                            'pengajuan' => 'diproses',
                                            'verifikasi' => 'review',
                                            'survey' => 'review',
                                            'lanjut_kpr' => 'diproses',
                                            'active' => 'aktif',
                                            'akad' => 'review',
                                            'cash_process' => 'aktif',
                                            'cancelled' => 'pending',
                                            default => 'booking',
                                        };

                                        $methodClass = str_replace('_', '-', strtolower($booking->purchase_type ?? ''));
                                    @endphp

                                    <tr id="booking-{{ $booking->id }}">
                                        <td class="text-center fw-bold">
                                            {{ ($bookings->firstItem() ?? 1) + $index }}
                                        </td>

                                        <td>
                                            <span class="booking-id">
                                                <i class="mdi mdi-clipboard-check-outline"></i>
                                                {{ $booking->booking_code }}
                                            </span>
                                        </td>

                                        <td>
                                            <div class="customer-info">
                                                <div class="customer-initial">{{ $initials }}</div>
                                                <span class="customer-name">{{ $customerName }}</span>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-home-outline text-primary me-2" style="font-size: 1.1rem;"></i>
                                                <span class="fw-bold">
                                                    {{ $booking->unit->block ?? '' }} {{ $booking->unit->unit_number ?? '' }}
                                                </span>
                                            </div>
                                        </td>

                                        <td>
                                            <span class="badge-method {{ $methodClass }}">
                                                @if ($booking->purchase_type === 'kpr')
                                                    <i class="mdi mdi-bank"></i> KPR
                                                @elseif ($booking->purchase_type === 'cash')
                                                    <i class="mdi mdi-cash"></i> Cash
                                                @elseif ($booking->purchase_type === 'cash_tempo')
                                                    <i class="mdi mdi-calendar-clock"></i> Cash Tempo
                                                @else
                                                    <i class="mdi mdi-cash-multiple"></i> -
                                                @endif
                                            </span>
                                        </td>

                                        <td>
                                            <span class="badge-status {{ $statusClass }}">
                                                @if ($displayStatus === 'Draft')
                                                    <i class="mdi mdi-file-document-outline"></i>
                                                @elseif ($displayStatus === 'Pengajuan')
                                                    <i class="mdi mdi-send-outline"></i>
                                                @elseif ($displayStatus === 'Verifikasi')
                                                    <i class="mdi mdi-check-decagram-outline"></i>
                                                @elseif ($displayStatus === 'Survey')
                                                    <i class="mdi mdi-map-marker-check-outline"></i>
                                                @elseif ($displayStatus === 'Lanjut KPR')
                                                    <i class="mdi mdi-bank-transfer-out"></i>
                                                @elseif ($displayStatus === 'Aktif')
                                                    <i class="mdi mdi-progress-clock"></i>
                                                @elseif ($displayStatus === 'Akad')
                                                    <i class="mdi mdi-handshake-outline"></i>
                                                @elseif ($displayStatus === 'Cash Process')
                                                    <i class="mdi mdi-cash-sync"></i>
                                                @elseif ($displayStatus === 'Lunas' || $displayStatus === 'Complete')
                                                    <i class="mdi mdi-check-circle"></i>
                                                @elseif ($displayStatus === 'Ditolak')
                                                    <i class="mdi mdi-close-circle-outline"></i>
                                                @else
                                                    <i class="mdi mdi-information-outline"></i>
                                                @endif
                                                {{ $displayStatus }}
                                            </span>
                                        </td>

                                        <td>
                                            <div class="progress-wrapper">
                                                <div class="custom-progress">
                                                    <div class="custom-progress-bar {{ $progress == 100 ? 'complete' : '' }}" style="width: {{ $progress }}%;"></div>
                                                </div>
                                                <div class="progress-label">{{ $progress }}%</div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="agent-sales">
                                                <i class="mdi mdi-account-tie"></i>
                                                <span>{{ $booking->sales->name ?? '-' }}</span>
                                            </div>
                                        </td>

                                        <td class="text-center">
                                            @if ($progress == 100)
                                                <a href="{{ route('unit.selesai', $booking->id) }}"
                                                   class="btn-action method-complete me-1"
                                                   title="Selesai">
                                                    <i class="mdi mdi-check-bold"></i>
                                                </a>
                                            @else
                                                @if ($booking->purchase_type === 'kpr')
                                                    @if (!$booking->kprApplication || $booking->kprApplication->status != 'pengajuan')
                                                        <a href="{{ route('pengajuan.show', $booking->id) }}"
                                                           class="btn-action method-kpr me-1"
                                                           title="Proses KPR">
                                                            <i class="mdi mdi-bank"></i>
                                                        </a>
                                                    @endif
                                                @elseif ($booking->purchase_type === 'cash')
                                                    <a href="{{ route('marketing.cash', $booking->id) }}"
                                                       class="btn-action method-cash me-1"
                                                       title="Proses Cash">
                                                        <i class="mdi mdi-cash"></i>
                                                    </a>
                                                @elseif ($booking->purchase_type === 'cash_tempo')
                                                    <a href="{{ route('marketing.cash_tempo', $booking->id) }}"
                                                       class="btn-action method-cash-tempo me-1"
                                                       title="Proses Cash Tempo">
                                                        <i class="mdi mdi-calendar-clock"></i>
                                                    </a>
                                                @endif
                                            @endif

                                            <a href="#" class="btn-action view me-1" title="Detail">
                                                <i class="mdi mdi-eye"></i>
                                            </a>

                                            <a href="#" class="btn-action edit me-1" title="Edit">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>

                                            <form action="#" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action delete" title="Hapus">
                                                    <i class="mdi mdi-delete"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted py-4">
                                            Tidak ada data pengajuan
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($bookings instanceof \Illuminate\Pagination\LengthAwarePaginator && $bookings->total() > 0)
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                        <div class="pagination-info mb-2 mb-sm-0">
                            Menampilkan {{ $bookings->firstItem() }} - {{ $bookings->lastItem() }} dari {{ $bookings->total() }} data
                        </div>
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                @if ($bookings->onFirstPage())
                                    <li class="page-item disabled" aria-disabled="true">
                                        <span class="page-link" aria-label="Previous">
                                            <i class="mdi mdi-chevron-left"></i>
                                        </span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $bookings->appends(request()->query())->previousPageUrl() }}" rel="prev" aria-label="Previous" onclick="showPaginationLoading(event)">
                                            <i class="mdi mdi-chevron-left"></i>
                                        </a>
                                    </li>
                                @endif

                                @foreach ($bookings->getUrlRange(max(1, $bookings->currentPage() - 2), min($bookings->lastPage(), $bookings->currentPage() + 2)) as $page => $url)
                                    @if ($page == $bookings->currentPage())
                                        <li class="page-item active" aria-current="page">
                                            <span class="page-link">{{ $page }}</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $bookings->appends(request()->query())->url($page) }}" onclick="showPaginationLoading(event)">{{ $page }}</a>
                                        </li>
                                    @endif
                                @endforeach

                                @if ($bookings->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $bookings->appends(request()->query())->nextPageUrl() }}" rel="next" aria-label="Next" onclick="showPaginationLoading(event)">
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

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
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
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const bookingId = "{{ request('booking_id') }}";

            if (bookingId) {

                const row = document.getElementById("booking-" + bookingId);

                if (row) {

                    setTimeout(function() {

                        row.scrollIntoView({
                            behavior: "smooth",
                            block: "center"
                        });

                    }, 500);

                }

            }

        });
    </script>

        let url = new URL(window.location.href);
        url.searchParams.set('sort', field);
        url.searchParams.set('direction', direction);
        url.searchParams.set('page', 1);

        window.location.href = url.toString();
    });
});

function showFilterLoading() {
    Swal.fire({
        title: 'Memuat...',
        html: 'Sedang memfilter data',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    return true;
}

function showResetLoading(event) {
    event.preventDefault();
    let url = event.currentTarget.href;

    Swal.fire({
        title: 'Memuat...',
        html: 'Sedang mereset filter',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    window.location.href = url;
}

function showPaginationLoading(event) {
    if(event.currentTarget.closest('.disabled') || event.currentTarget.closest('.active')) return;

    Swal.fire({
        title: 'Memuat...',
        html: 'Sedang memuat data halaman',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
}

function handleExport() {
    Swal.fire({
        icon: 'success',
        title: 'Export Berhasil',
        text: 'Export data Customer Booking berhasil dijalankan.',
        confirmButtonColor: '#9a55ff'
    });
}

function handleImport() {
    Swal.fire({
        icon: 'success',
        title: 'Import Berhasil',
        text: 'Import data Customer Booking berhasil dijalankan.',
        confirmButtonColor: '#9a55ff'
    });
}
</script>
@endpush
