@extends('layouts.partial.app')

@section('title', 'Marketing Jual Unit - Property Management App')

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

        /* ===== GRID VIEW CARD STYLING ===== */
        .grid-card {
            border: 1px solid #e0e4e9 !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
        }

        .grid-card:hover {
            border-color: #9a55ff !important;
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.15) !important;
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
    </style>

    <div class="container-fluid p-2 p-sm-3 p-md-4">
        <!-- Header Dashboard -->
        <div class="row mb-3 mb-sm-3 mb-md-4">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="text-dark mb-1">
                                <i class="mdi mdi-home-group me-2" style="color: #9a55ff;"></i>
                                Marketing Jual Unit
                            </h3>
                            <p class="text-muted mb-0">
                                <i class="mdi mdi-information-outline me-1"></i>
                                Kelola unit-unit yang siap dipasarkan ke customer
                            </p>
                        </div>
                        <div class="d-none d-sm-block">
                            <i class="mdi mdi-home-group" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row g-2 g-sm-2 g-md-3 mb-4">
            <div class="col-6 col-sm-6 col-md-6 col-lg-3 mb-2 mb-sm-2 mb-md-3">
                <div class="card bg-gradient-primary card-img-holder text-white h-100">
                    <div class="card-body p-2 p-sm-2 p-md-3">
                        <img src="{{ asset('admin/assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                            alt="circle-image" />
                        <h4 class="font-weight-normal mb-2 mb-sm-2 mb-md-3 small fs-6 fs-sm-6 fs-md-5">
                            Total Unit
                            <i class="mdi mdi-home-group float-end" style="font-size: 1.2rem;"></i>
                        </h4>
                        <h2 class="mb-2 mb-sm-2 mb-md-4 fs-5 fs-sm-5 fs-md-2">{{ $totalUnits }}</h2>
                        <h6 class="card-text small">Semua unit</h6>
                    </div>
                </div>
            </div>

            <div class="col-6 col-sm-6 col-md-6 col-lg-3 mb-2 mb-sm-2 mb-md-3">
                <div class="card bg-gradient-success card-img-holder text-white h-100">
                    <div class="card-body p-2 p-sm-2 p-md-3">
                        <img src="{{ asset('admin/assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                            alt="circle-image" />
                        <h4 class="font-weight-normal mb-2 mb-sm-2 mb-md-3 small fs-6 fs-sm-6 fs-md-5">
                            Tersedia
                            <i class="mdi mdi-check-circle float-end" style="font-size: 1.2rem;"></i>
                        </h4>
                        <h2 class="mb-2 mb-sm-2 mb-md-4 fs-5 fs-sm-5 fs-md-2">{{ $totalTersedia }}</h2>
                        <h6 class="card-text small">Siap dijual</h6>
                    </div>
                </div>
            </div>

            <div class="col-6 col-sm-6 col-md-6 col-lg-3 mb-2 mb-sm-2 mb-md-3">
                <div class="card bg-gradient-warning card-img-holder text-white h-100">
                    <div class="card-body p-2 p-sm-2 p-md-3">
                        <img src="{{ asset('admin/assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                            alt="circle-image" />
                        <h4 class="font-weight-normal mb-2 mb-sm-2 mb-md-3 small fs-6 fs-sm-6 fs-md-5">
                            Booking
                            <i class="mdi mdi-clock float-end" style="font-size: 1.2rem;"></i>
                        </h4>
                        <h2 class="mb-2 mb-sm-2 mb-md-4 fs-5 fs-sm-5 fs-md-2">{{ $totalBooking }}</h2>
                        <h6 class="card-text small">Dalam proses</h6>
                    </div>
                </div>
            </div>

            <div class="col-6 col-sm-6 col-md-6 col-lg-3 mb-2 mb-sm-2 mb-md-3">
                <div class="card bg-gradient-danger card-img-holder text-white h-100">
                    <div class="card-body p-2 p-sm-2 p-md-3">
                        <img src="{{ asset('admin/assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                            alt="circle-image" />
                        <h4 class="font-weight-normal mb-2 mb-sm-2 mb-md-3 small fs-6 fs-sm-6 fs-md-5">
                            Terjual
                            <i class="mdi mdi-cash-check float-end" style="font-size: 1.2rem;"></i>
                        </h4>
                        <h2 class="mb-2 mb-sm-2 mb-md-4 fs-5 fs-sm-5 fs-md-2">{{ $totalSold }}</h2>
                        <h6 class="card-text small">Sudah laku</h6>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Data (dengan filter di dalamnya) -->
        <div class="row mt-2 mt-sm-2 mt-md-3">
            <div class="col-12">
                <div class="card">
                    <div
                        class="card-header bg-white d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                        <h5 class="card-title mb-2 mb-md-0">
                            <i class="mdi mdi-format-list-bulleted me-2 text-primary"></i>
                            Daftar Unit Kavling
                        </h5>
                        <div class="d-flex gap-2">
                            <button class="btn btn-sm btn-gradient-success" onclick="alert('Export Excel')">
                                <i class="mdi mdi-export me-1"></i><span class="d-none d-sm-inline">Excel</span>
                            </button>
                            <button class="btn btn-sm btn-gradient-danger" onclick="alert('Export PDF')">
                                <i class="mdi mdi-file-pdf me-1"></i><span class="d-none d-sm-inline">PDF</span>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Filter Section - DIPERBESAR (LANGSUNG DI DALAM CARD TABLE) -->
                        <div class="filter-card">
                            <div class="card-body">
                                <h6 class="card-title mb-3" style="font-size: 1rem;">
                                    <i class="mdi mdi-filter-outline me-1"></i>Filter Data
                                </h6>

                                <!-- FILTER UNTUK MOBILE -->
                                <div class="d-block d-md-none">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            <i class="mdi mdi-magnify me-1"></i>Cari Unit
                                        </label>
                                        <input type="text" class="form-control" placeholder="Cari blok, lokasi...">
                                    </div>

                                    <div class="row g-2">
                                        <div class="col-6">
                                            <label class="form-label">
                                                <i class="mdi mdi-home me-1"></i>Proyek
                                            </label>
                                            <select class="form-control">
                                                <option value="">Semua</option>
                                                <option value="Green Lake City">Green Lake City</option>
                                                <option value="Grand Wisata">Grand Wisata</option>
                                                <option value="Citra Garden">Citra Garden</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">
                                                <i class="mdi mdi-chart-arc me-1"></i>Status
                                            </label>
                                            <select class="form-control">
                                                <option value="">Semua</option>
                                                <option value="Tersedia">Tersedia</option>
                                                <option value="Booking">Booking</option>
                                                <option value="Terjual">Terjual</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row g-2 mt-2">
                                        <div class="col-6">
                                            <label class="form-label">
                                                <i class="mdi mdi-currency-usd me-1"></i>Harga
                                            </label>
                                            <select class="form-control">
                                                <option value="">Semua</option>
                                                <option value="<500">&#60; Rp 500 Jt</option>
                                                <option value="500-1000">Rp 500 Jt - 1 M</option>
                                                <option value=">1000">&#62; Rp 1 M</option>
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
                                                <i class="mdi mdi-magnify me-1"></i>Cari Unit
                                            </label>
                                            <input type="text" class="form-control"
                                                placeholder="Cari blok, lokasi...">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">
                                                <i class="mdi mdi-home me-1"></i>Proyek
                                            </label>
                                            <select class="form-control">
                                                <option value="">Semua</option>
                                                <option value="Green Lake City">Green Lake City</option>
                                                <option value="Grand Wisata">Grand Wisata</option>
                                                <option value="Citra Garden">Citra Garden</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">
                                                <i class="mdi mdi-chart-arc me-1"></i>Status
                                            </label>
                                            <select class="form-control">
                                                <option value="">Semua</option>
                                                <option value="Tersedia">Tersedia</option>
                                                <option value="Booking">Booking</option>
                                                <option value="Terjual">Terjual</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">
                                                <i class="mdi mdi-currency-usd me-1"></i>Harga
                                            </label>
                                            <select class="form-control">
                                                <option value="">Semua</option>
                                                <option value="<500">&#60; Rp 500 Jt</option>
                                                <option value="500-1000">Rp 500 Jt - 1 M</option>
                                                <option value=">1000">&#62; Rp 1 M</option>
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
                                            <label class="form-label" style="visibility: hidden;">Reset</label>
                                            <button type="button" class="btn btn-gradient-secondary w-100 btn-icon-only"
                                                title="Reset Filter">
                                                <i class="mdi mdi-refresh"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Toggle View -->
                        <div class="d-flex justify-content-end mb-3">
                            <div class="btn-group btn-group-sm" role="group">
                                <button type="button" class="btn btn-outline-primary active" id="btnTableView"
                                    onclick="switchView('table')">
                                    <i class="mdi mdi-view-list me-1"></i><span class="d-none d-sm-inline">Table</span>
                                </button>
                                <button type="button" class="btn btn-outline-primary" id="btnGridView"
                                    onclick="switchView('grid')">
                                    <i class="mdi mdi-view-grid me-1"></i><span class="d-none d-sm-inline">Grid</span>
                                </button>
                            </div>
                        </div>

                        <!-- TABLE VIEW -->
                        <div id="tableView">
                            <div class="table-responsive">
                                <table class="table table-hover" id="unitTable" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center"><i class="mdi mdi-counter me-1"></i>No</th>
                                            <th><i class="mdi mdi-home me-1"></i>Blok</th>
                                            <th><i class="mdi mdi-home-group me-1"></i>Proyek</th>
                                            <th class="d-none d-md-table-cell"><i
                                                    class="mdi mdi-map-marker me-1"></i>Lokasi</th>
                                            <th><i class="mdi mdi-arrow-expand me-1"></i>Luas</th>
                                            <th><i class="mdi mdi-currency-usd me-1"></i>Harga</th>
                                            <th><i class="mdi mdi-compass me-1"></i>Hadap</th>
                                            <th><i class="mdi mdi-chart-arc me-1"></i>Status</th>
                                            <th><i class="mdi mdi-account-tie me-1"></i>Agent</th>
                                            <th><i class="mdi mdi-account me-1"></i>Customer</th>
                                            <th class="text-center"><i class="mdi mdi-cog me-1"></i>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($units as $index => $unit)
                                            <tr>
                                                <td class="text-center fw-bold">{{ $index + 1 }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="mdi mdi-home-variant text-primary me-2"
                                                            style="font-size: 1rem;"></i>
                                                        <span class="fw-bold">{{ $unit->unit_code }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="mdi mdi-home-city text-info me-2"
                                                            style="font-size: 1rem;"></i>
                                                        {{ $unit->landBank->name ?? '-' }}
                                                    </div>
                                                </td>
                                                <td class="d-none d-md-table-cell">
                                                    <div class="d-flex align-items-center">
                                                        <i class="mdi mdi-map-marker text-danger me-2"
                                                            style="font-size: 1rem;"></i>
                                                        {{ Str::limit($unit->landBank->address ?? '-', 20) }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="mdi mdi-ruler-square text-warning me-2"
                                                            style="font-size: 1rem;"></i>
                                                        {{ $unit->building_area ?? ($unit->area ?? '-') }} m²
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="mdi mdi-currency-usd text-success me-2"
                                                            style="font-size: 1rem;"></i>
                                                        <span class="text-nowrap fw-bold text-success">Rp
                                                            {{ number_format($unit->price ?? 0, 0, ',', '.') }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="mdi mdi-compass text-info me-2"
                                                            style="font-size: 1rem;"></i>
                                                        {{ $unit->facing ?? '-' }}
                                                    </div>
                                                </td>
                                                <td>
                                                    @if ($unit->status == 'ready' || $unit->status == 'tersedia')
                                                        <span class="badge badge-gradient-success">
                                                            <i class="mdi mdi-check-circle me-1"></i>Tersedia
                                                        </span>
                                                    @elseif($unit->status == 'sold')
                                                        <span class="badge badge-gradient-danger">
                                                            <i class="mdi mdi-cash me-1"></i>Terjual
                                                        </span>
                                                    @else
                                                        <span class="badge badge-gradient-warning">
                                                            <i
                                                                class="mdi mdi-clock-outline me-1"></i>{{ ucfirst($unit->status) }}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="mdi mdi-account-tie text-primary me-2"
                                                            style="font-size: 1rem;"></i>
                                                        {{ $unit->agency->name ?? '-' }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="mdi mdi-account text-success me-2"
                                                            style="font-size: 1rem;"></i>
                                                        {{ $unit->customer->full_name ?? '-' }}
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center gap-1">
                                                        <button class="btn btn-outline-primary btn-sm" title="Detail">
                                                            <i class="mdi mdi-eye"></i>
                                                        </button>
                                                        <button class="btn btn-outline-warning btn-sm" title="Edit">
                                                            <i class="mdi mdi-pencil"></i>
                                                        </button>
                                                        <button onclick="openCustomerModal({{ $unit->id }})"
                                                            class="btn btn-outline-danger btn-sm" title="Tambah Customer">
                                                            <i class="mdi mdi-account-plus"></i>
                                                        </button>
                                                        <button class="btn btn-outline-info btn-sm bukaModal"
                                                            data-unit="{{ $unit->id }}" title="Pilih Agency">
                                                            <i class="mdi mdi-office-building"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="11" class="text-center text-muted py-4">
                                                    <i class="mdi mdi-home-outline"
                                                        style="font-size: 2rem; opacity: 0.3;"></i>
                                                    <p class="mt-2">Data unit belum tersedia</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- GRID VIEW (Katalog) -->
                        <div id="gridView" class="row g-3" style="display: none;">
                            @forelse ($units as $unit)
                                <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                                    <div class="card grid-card h-100">
                                        <div class="card-body p-3">
                                            <div class="position-relative">
                                                @if ($unit->status == 'ready' || $unit->status == 'tersedia')
                                                    <span
                                                        class="badge badge-gradient-success position-absolute top-0 end-0 m-2">Tersedia</span>
                                                @elseif($unit->status == 'sold')
                                                    <span
                                                        class="badge badge-gradient-danger position-absolute top-0 end-0 m-2">Terjual</span>
                                                @else
                                                    <span
                                                        class="badge badge-gradient-warning position-absolute top-0 end-0 m-2">{{ ucfirst($unit->status) }}</span>
                                                @endif
                                                <div class="text-center bg-light py-3 py-md-4 rounded">
                                                    <i class="mdi mdi-home-outline"
                                                        style="font-size: 36px; color: #9a55ff;"></i>
                                                </div>
                                            </div>
                                            <h5 class="mt-2 fs-6">{{ $unit->unit_code }} -
                                                {{ $unit->landBank->name ?? '-' }}</h5>
                                            <p class="text-muted small mb-1">
                                                <i
                                                    class="mdi mdi-map-marker me-1"></i>{{ Str::limit($unit->landBank->address ?? '-', 20) }}
                                            </p>
                                            <p class="small mb-1">
                                                <i
                                                    class="mdi mdi-arrow-expand me-1"></i>{{ $unit->building_area ?? ($unit->area ?? '-') }}
                                                m² | Hadap {{ $unit->facing ?? '-' }}
                                            </p>
                                            <h5 class="text-primary mt-2">Rp
                                                {{ number_format($unit->price ?? 0, 0, ',', '.') }}</h5>

                                            <div class="d-flex align-items-center mt-2 p-2 bg-light rounded small">
                                                <i class="mdi mdi-account-tie text-primary me-2"></i>
                                                <span class="text-muted">Agent: {{ $unit->agency->name ?? '-' }}</span>
                                            </div>

                                            <div class="d-flex justify-content-between align-items-center mt-3">
                                                <small class="text-muted">
                                                    @if ($unit->customer)
                                                        <i
                                                            class="mdi mdi-account me-1"></i>{{ $unit->customer->full_name ?? '-' }}
                                                    @else
                                                        <i class="mdi mdi-account-outline me-1"></i>Belum ada customer
                                                    @endif
                                                </small>
                                                <div class="btn-group btn-group-sm">
                                                    <button class="btn btn-outline-primary"
                                                        onclick="alert('Detail unit')">
                                                        <i class="mdi mdi-eye"></i>
                                                    </button>
                                                    @if ($unit->status == 'sold')
                                                        <button class="btn btn-outline-secondary" disabled>
                                                            <i class="mdi mdi-lock"></i>
                                                        </button>
                                                    @else
                                                        <button class="btn btn-outline-danger"
                                                            onclick="$('#modalCustomer').modal('show')">
                                                            <i class="mdi mdi-account-plus"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="text-center text-muted py-5">
                                        <i class="mdi mdi-home-outline" style="font-size: 3rem; opacity: 0.3;"></i>
                                        <p class="mt-3">Belum ada unit tersedia</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-3">
                            <div class="pagination-info mb-2 mb-sm-0">
                                <i class="mdi mdi-information-outline me-1"></i>
                                Menampilkan 1 dari 156 data
                            </div>
                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0"
                                    style="gap: 2px;">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1" aria-label="Previous">
                                            <i class="mdi mdi-chevron-left"></i>
                                        </a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                                    <li class="page-item"><a class="page-link" href="#">5</a></li>
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
                            <a href="{{ route('properti-all') }}" class="btn btn-gradient-secondary">
                                <i class="mdi mdi-arrow-left me-1"></i>Kembali ke Kavling
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL CUSTOMER -->
    <div class="modal fade" id="modalCustomer" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="mdi mdi-account-multiple me-2" style="color: #9a55ff;"></i>
                        Data Customer
                    </h5>
                    <button type="button" class="btn-close" onclick="$('#modalCustomer').modal('hide')"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>ID Customer</th>
                                    <th>Nama</th>
                                    <th>No HP</th>
                                    <th>Pekerjaan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $c)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $c->customer_id ?? '-' }}</td>
                                        <td>{{ $c->full_name ?? '-' }}</td>
                                        <td>{{ $c->phone ?? '-' }}</td>
                                        <td>{{ $c->job_status ?? '-' }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-gradient-success pilihCustomer"
                                                data-id="{{ $c->id }}">
                                                <i class="mdi mdi-check me-1"></i>Pilih
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL AGENCY -->
    <div class="modal fade" id="modalAgency" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="mdi mdi-office-building me-2" style="color: #9a55ff;"></i>
                        Pilih Agency
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formAgency" method="POST">
                        @csrf
                        <input type="hidden" name="employee_id" id="employee_id">
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Agency</th>
                                    <th>No HP</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($agencies as $a)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $a->name }}</td>
                                        <td>{{ $a->phone }}</td>
                                        <td>{{ $a->address }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-gradient-success pilihAgency"
                                                data-id="{{ $a->id }}">
                                                <i class="mdi mdi-check me-1"></i>Pilih
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
            // Inisialisasi DataTables - hanya untuk sorting
            let table = $('#unitTable').DataTable({
                responsive: true,
                paging: false,
                info: false,
                searching: false,
                lengthChange: false,
                ordering: true,
                language: {
                    emptyTable: "Data unit belum tersedia",
                    zeroRecords: "Data tidak ditemukan",
                },
                columnDefs: [{
                    orderable: false,
                    targets: [0, 10]
                }]
            });

            // Tooltips
            $('[data-toggle="tooltip"]').tooltip();

            window.openCustomerModal = function(unitId) {

                if (!unitId) {
                    alert('Unit tidak valid!');
                    return;
                }

                $('#modalCustomer').attr('data-unit-id', unitId);
                $('#modalCustomer').modal('show');
            };

            $(document).on('click', '.pilihCustomer', function() {

                let customerId = $(this).data('id');
                let unitId = $('#modalCustomer').attr('data-unit-id');

                if (!unitId) {
                    alert('Unit belum dipilih!');
                    return;
                }

                let actionUrlTemplate = "{{ route('set.customer', ':unitId') }}";
                let actionUrl = actionUrlTemplate.replace(':unitId', unitId);

                let form = $('<form>', {
                    method: 'POST',
                    action: actionUrl
                });

                form.append(`<input type="hidden" name="_token" value="{{ csrf_token() }}">`);
                form.append(`<input type="hidden" name="customer_id" value="${customerId}">`);

                $('body').append(form);
                form.submit();
            });
            // Agency modal
            let selectedUnit = null;

            $(document).on('click', '.bukaModal', function() {
                let unitId = $(this).data('unit');
                let url = "{{ url('marketing/set-agency') }}/" + unitId;
                $('#formAgency').attr('action', url);
                $('#modalAgency').modal('show');
            });

            $(document).on('click', '.pilihAgency', function() {
                let employeeId = $(this).data('id');
                $('#employee_id').val(employeeId);
                $('#formAgency').submit();
            });
        });

        function switchView(view) {
            if (view === 'table') {
                $('#tableView').show();
                $('#gridView').hide();
                $('#btnTableView').addClass('active');
                $('#btnGridView').removeClass('active');
            } else {
                $('#tableView').hide();
                $('#gridView').show();
                $('#btnGridView').addClass('active');
                $('#btnTableView').removeClass('active');
            }
        }

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
