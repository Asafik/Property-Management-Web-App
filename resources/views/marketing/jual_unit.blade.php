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

        /* ===== FILTER SECTION - UKURAN NORMAL ===== */
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

        /* ===== TABLE STYLING - UKURAN NORMAL ===== */
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

        .table tbody tr:hover {
            background-color: #f8f9fa;
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

        /* ===== GRID VIEW CARD STYLING ===== */
        .grid-card {
            border: 1px solid #e0e4e9 !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
        }

        .grid-card:hover {
            border-color: #9a55ff !important;
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.15) !important;
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

        /* Button group styling */
        .btn-group .btn-outline-primary {
            border: 1px solid #9a55ff;
        }

        .btn-group .btn-outline-primary.active {
            background: linear-gradient(to right, #da8cff, #9a55ff);
            color: #ffffff;
        }

        /* Kolom filter dengan padding minimal */
        .filter-col {
            padding-left: 3px;
            padding-right: 3px;
        }

        /* Membuat select lebih pendek secara visual */
        select.form-control {
            background-position: right 0.5rem center;
            padding-right: 1.5rem;
        }

        /* Progress Bar Styling */
        .progress {
            height: 22px;
            border-radius: 11px;
            background-color: #e9ecef;
        }

        .progress-bar {
            border-radius: 11px;
            font-size: 0.7rem;
            font-weight: 600;
            line-height: 22px;
        }

        .bg-danger {
            background: linear-gradient(135deg, #dc3545, #e4606d) !important;
        }

        .bg-warning {
            background: linear-gradient(135deg, #ffc107, #ffdb6d) !important;
            color: #2c2e3f !important;
        }

        .bg-success {
            background: linear-gradient(135deg, #28a745, #5cb85c) !important;
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
                            <p class="text-muted mb-0 small">
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

        <!-- Tabel Data -->
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
                            <a href="{{ route('marketing.jual-unit.export.excel') }}"
                                class="btn btn-sm btn-gradient-success">
                                <i class="mdi mdi-export me-1"></i>
                                <span class="d-none d-sm-inline">Excel</span>
                            </a>
                            <a href="{{ route('marketing.jual-unit.export.pdf') }}" class="btn btn-sm btn-gradient-danger">
                                <i class="mdi mdi-file-pdf me-1"></i>
                                <span class="d-none d-sm-inline">PDF</span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Filter Section - SEJAJAR DENGAN SELECT DIPERKECIL -->
                        <div class="filter-card">
                            <div class="card-body">
                                <h6 class="card-title mb-3" style="font-size: 1rem;">
                                    <i class="mdi mdi-filter-outline me-1"></i>Filter Data
                                </h6>

                                <form method="GET" action="{{ route('marketing.jual-unit') }}">
                                    <!-- FILTER DESKTOP - SEJAJAR DENGAN KOLOM KECIL -->
                                    <div class="d-none d-md-block">
                                        <div class="row g-1 align-items-end">
                                            <!-- Cari Unit (lebih besar) -->
                                            <div class="col-md-2 filter-col">
                                                <label class="form-label">
                                                    <i class="mdi mdi-magnify me-1"></i>Cari Unit
                                                </label>
                                                <input type="text" name="search" value="{{ request('search') }}"
                                                    class="form-control" placeholder="Cari...">
                                            </div>

                                            <!-- Proyek -->
                                            <div class="col-md-2 filter-col">
                                                <label class="form-label">
                                                    <i class="mdi mdi-home me-1"></i>Proyek
                                                </label>
                                                <select name="project" class="form-control">
                                                    <option value="">Semua</option>
                                                    @foreach ($projects as $project)
                                                        <option value="{{ $project->name }}"
                                                            {{ request('project') == $project->name ? 'selected' : '' }}>
                                                            {{ $project->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <!-- Tipe Unit (diperkecil) -->
                                            <div class="col-md-1 filter-col">

                                                <label class="form-label">
                                                    <i class="mdi mdi-home-modern me-1"></i>Tipe
                                                </label>
                                                <select name="type" class="form-control">
                                                    <option value="">Semua</option>
                                                    @foreach ($types as $type)
                                                        <option value="{{ $type }}"
                                                            {{ request('type') == $type ? 'selected' : '' }}>
                                                            {{ $type }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Status (diperkecil) -->
                                            <div class="col-md-1 filter-col">
                                                <label class="form-label">
                                                    <i class="mdi mdi-chart-arc me-1"></i>Status
                                                </label>
                                                <select name="status" class="form-control">
                                                    <option value="">Semua</option>
                                                    <option value="draft"
                                                        {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                                    <option value="ready"
                                                        {{ request('status') == 'ready' ? 'selected' : '' }}>Ready</option>
                                                    <option value="booked"
                                                        {{ request('status') == 'booked' ? 'selected' : '' }}>Booked
                                                    </option>
                                                    <option value="sold"
                                                        {{ request('status') == 'sold' ? 'selected' : '' }}>Sold</option>
                                                </select>
                                            </div>

                                            <!-- Harga -->
                                            <div class="col-md-2 filter-col">
                                                <label class="form-label">
                                                    <i class="mdi mdi-currency-usd me-1"></i>Harga
                                                </label>
                                                <select name="price" class="form-control">
                                                    <option value="">Semua</option>
                                                    <option value="<500"
                                                        {{ request('price') == '<500' ? 'selected' : '' }}>&lt; 500 Jt
                                                    </option>
                                                    <option value="500-1000"
                                                        {{ request('price') == '500-1000' ? 'selected' : '' }}>500 Jt - 1 M
                                                    </option>
                                                    <option value=">1000"
                                                        {{ request('price') == '>1000' ? 'selected' : '' }}>&gt; 1 M
                                                    </option>
                                                </select>
                                            </div>

                                            <!-- Tampil (diperkecil) -->
                                            <div class="col-md-1 filter-col">
                                                <label class="form-label">
                                                    <i class="mdi mdi-counter me-1"></i>Tampil
                                                </label>
                                                <select name="perPage" class="form-control">
                                                    <option value="10"
                                                        {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                                                    <option value="25"
                                                        {{ request('perPage') == 25 ? 'selected' : '' }}>25</option>
                                                    <option value="50"
                                                        {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
                                                    <option value="100"
                                                        {{ request('perPage') == 100 ? 'selected' : '' }}>100</option>
                                                </select>
                                            </div>

                                            <!-- Button Filter -->
                                            <div class="col-md-1 filter-col">
                                                <label class="form-label" style="visibility: hidden;">Filter</label>
                                                <button type="submit"
                                                    class="btn btn-gradient-primary w-100 btn-filter-reset"
                                                    title="Filter">
                                                    <i class="mdi mdi-filter"></i>
                                                </button>
                                            </div>

                                            <!-- Button Reset -->
                                            <div class="col-md-1 filter-col">
                                                <label class="form-label" style="visibility: hidden;">Reset</label>
                                                <a href="{{ route('marketing.jual-unit') }}"
                                                    class="btn btn-gradient-secondary w-100 btn-filter-reset"
                                                    title="Reset">
                                                    <i class="mdi mdi-refresh"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- FILTER MOBILE -->
                                    <div class="d-block d-md-none">
                                        <!-- Baris 1: Cari Unit -->
                                        <div class="row filter-row g-1">
                                            <div class="col-12">
                                                <label class="form-label">
                                                    <i class="mdi mdi-magnify me-1"></i>Cari Unit
                                                </label>
                                                <input type="text" name="search" value="{{ request('search') }}"
                                                    class="form-control" placeholder="Cari...">
                                            </div>
                                        </div>

                                        <!-- Baris 2: Proyek & Tipe -->
                                        <div class="row filter-row g-1">
                                            <div class="col-6">
                                                <label class="form-label">
                                                    <i class="mdi mdi-home me-1"></i>Proyek
                                                </label>
                                                <select name="project" class="form-control">
                                                    <option value="">Semua</option>
                                                    @foreach ($projects as $project)
                                                        <option value="{{ $project->name }}"
                                                            {{ request('project') == $project->name ? 'selected' : '' }}>
                                                            {{ $project->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">
                                                    <i class="mdi mdi-home-modern me-1"></i>Tipe
                                                </label>
                                                <select name="type" class="form-control">
                                                    <option value="">Semua</option>
                                                    @foreach ($types as $type)
                                                        <option value="{{ $type }}"
                                                            {{ request('type') == $type ? 'selected' : '' }}>
                                                            {{ $type }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Baris 3: Status & Harga -->
                                        <div class="row filter-row g-1">
                                            <div class="col-6">
                                                <label class="form-label">
                                                    <i class="mdi mdi-chart-arc me-1"></i>Status
                                                </label>
                                                <select name="status" class="form-control">
                                                    <option value="">Semua</option>
                                                    <option value="draft"
                                                        {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                                    <option value="ready"
                                                        {{ request('status') == 'ready' ? 'selected' : '' }}>Ready</option>
                                                    <option value="booked"
                                                        {{ request('status') == 'booked' ? 'selected' : '' }}>Booked
                                                    </option>
                                                    <option value="sold"
                                                        {{ request('status') == 'sold' ? 'selected' : '' }}>Sold</option>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">
                                                    <i class="mdi mdi-currency-usd me-1"></i>Harga
                                                </label>
                                                <select name="price" class="form-control">
                                                    <option value="">Semua</option>
                                                    <option value="<500"
                                                        {{ request('price') == '<500' ? 'selected' : '' }}>&lt; 500 Jt
                                                    </option>
                                                    <option value="500-1000"
                                                        {{ request('price') == '500-1000' ? 'selected' : '' }}>500 Jt - 1 M
                                                    </option>
                                                    <option value=">1000"
                                                        {{ request('price') == '>1000' ? 'selected' : '' }}>&gt; 1 M
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Baris 4: Tampil & Button -->
                                        <div class="row filter-row g-1">
                                            <div class="col-4">
                                                <label class="form-label">
                                                    <i class="mdi mdi-counter me-1"></i>Tampil
                                                </label>
                                                <select name="perPage" class="form-control">
                                                    <option value="10"
                                                        {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                                                    <option value="25"
                                                        {{ request('perPage') == 25 ? 'selected' : '' }}>25</option>
                                                    <option value="50"
                                                        {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
                                                    <option value="100"
                                                        {{ request('perPage') == 100 ? 'selected' : '' }}>100</option>
                                                </select>
                                            </div>
                                            <div class="col-4">
                                                <label class="form-label" style="visibility: hidden;">Filter</label>
                                                <button type="submit"
                                                    class="btn btn-gradient-primary w-100 btn-filter-reset">
                                                    <i class="mdi mdi-filter"></i>
                                                </button>
                                            </div>
                                            <div class="col-4">
                                                <label class="form-label" style="visibility: hidden;">Reset</label>
                                                <a href="{{ route('marketing.jual-unit') }}"
                                                    class="btn btn-gradient-secondary w-100 btn-filter-reset">
                                                    <i class="mdi mdi-refresh"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Toggle View -->
                        <div class="d-flex justify-content-end mb-3">
                            <div class="btn-group btn-group-sm" role="group">

                                <button type="button" class="btn btn-outline-primary active" id="btnTableView"
                                    onclick="switchView('table')">
                                    <i class="mdi mdi-view-list me-1"></i>
                                    <span class="d-none d-sm-inline">Table</span>
                                </button>

                                <button type="button" class="btn btn-outline-primary" id="btnGridView"
                                    onclick="switchView('grid')">
                                    <i class="mdi mdi-view-grid me-1"></i>
                                    <span class="d-none d-sm-inline">Grid</span>
                                </button>

                                <button type="button" class="btn btn-outline-primary" id="btnDenahView"
                                    onclick="switchView('denah')">
                                    <i class="mdi mdi-floor-plan me-1"></i>
                                    <span class="d-none d-sm-inline">Denah Unit</span>
                                </button>

                                <button type="button" class="btn btn-outline-primary" id="btnLandMapView"
                                    onclick="switchView('landmap')">
                                    <i class="mdi mdi-map me-1"></i>
                                    <span class="d-none d-sm-inline">Site Plan</span>
                                </button>

                            </div>
                        </div>

                        <!-- TABLE VIEW DENGAN ICON DI SEMUA KOLOM -->
                        <div id="tableView">
                            <div class="table-responsive">
                                <table class="table table-hover" id="unitTable" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center"><i class="mdi mdi-counter"></i> No</th>
                                            <th><i class="mdi mdi-home-variant"></i> Blok</th>
                                            <th><i class="mdi mdi-office-building"></i> Proyek</th>
                                            <th><i class="mdi mdi-shape-outline"></i> Tipe</th>
                                            <th class="d-none d-md-table-cell"><i class="mdi mdi-map-marker"></i> Lokasi
                                            </th>
                                            <th><i class="mdi mdi-ruler-square"></i> Luas Tanah</th>
                                            <th><i class="mdi mdi-domain"></i> Luas Bangunan</th>
                                            <th><i class="mdi mdi-currency-usd"></i> Harga</th>
                                            <th><i class="mdi mdi-compass"></i> Hadap</th>
                                            <th><i class="mdi mdi-chart-arc"></i> Status</th>
                                            <th><i class="mdi mdi-hammer"></i> Status Pembangunan</th>
                                            <th><i class="mdi mdi-account-tie"></i> Agent</th>
                                            <th><i class="mdi mdi-cash"></i> Fee Agent</th>
                                            <th><i class="mdi mdi-account"></i> Customer</th>
                                            <th class="text-center"><i class="mdi mdi-cog"></i> Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($units as $index => $unit)
                                            <tr>
                                                <td class="text-center fw-bold">{{ $units->firstItem() + $index }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="mdi mdi-home-variant text-primary me-2"></i>
                                                        <span>{{ $unit->unit_code }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <i class="mdi mdi-office-building text-info me-1"></i>
                                                    {{ $unit->landBank->name ?? '-' }}
                                                </td>
                                                <td>
                                                    <i class="mdi mdi-shape-outline text-secondary me-1"></i>
                                                    {{ $unit->type ?? '-' }}
                                                </td>
                                                <td class="d-none d-md-table-cell">
                                                    <i class="mdi mdi-map-marker text-danger me-1"></i>
                                                    {{ Str::limit($unit->landBank->address ?? '-', 15) }}
                                                </td>
                                                <td>
                                                    <i class="mdi mdi-ruler-square text-warning me-1"></i>
                                                    {{ $unit->area ?? '-' }} m²
                                                </td>
                                                <td>
                                                    <i class="mdi mdi-domain text-secondary me-1"></i>
                                                    {{ $unit->building_area ?? '-' }} m²
                                                </td>
                                                <td>
                                                    <i class="mdi mdi-currency-usd text-success me-1"></i>
                                                    Rp {{ number_format($unit->price ?? 0, 0, ',', '.') }}
                                                </td>
                                                <td>
                                                    <i class="mdi mdi-compass text-info me-1"></i>
                                                    {{ $unit->facing ?? '-' }}
                                                </td>
                                                <td>
                                                    @if ($unit->status == 'ready' || $unit->status == 'tersedia')
                                                        <span class="badge badge-gradient-success"><i
                                                                class="mdi mdi-check-circle me-1"></i>Tersedia</span>
                                                    @elseif($unit->status == 'sold')
                                                        <span class="badge badge-gradient-danger"><i
                                                                class="mdi mdi-cash-check me-1"></i>Terjual</span>
                                                    @else
                                                        <span class="badge badge-gradient-warning"><i
                                                                class="mdi mdi-clock-outline me-1"></i>{{ ucfirst($unit->status) }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @php
                                                        $status = $unit->construction_progress;
                                                        $progressMap = [
                                                            'belum_mulai' => 0,
                                                            'pondasi' => 20,
                                                            'dinding' => 40,
                                                            'atap' => 60,
                                                            'finishing' => 80,
                                                            'selesai' => 100,
                                                        ];
                                                        $progress = $progressMap[$status] ?? 0;
                                                    @endphp
                                                    <div class="progress" style="height: 22px;">
                                                        <div class="progress-bar progress-bar-striped progress-bar-animated
                                                            @if ($progress <= 20) bg-danger
                                                            @elseif($progress < 100) bg-warning
                                                            @else bg-success @endif"
                                                            role="progressbar" style="width: {{ $progress }}%;"
                                                            aria-valuenow="{{ $progress }}" aria-valuemin="0"
                                                            aria-valuemax="100">
                                                            <i
                                                                class="mdi mdi-{{ $progress <= 20 ? 'alert' : ($progress < 100 ? 'progress-clock' : 'check-circle') }} me-1"></i>
                                                            {{ ucfirst(str_replace('_', ' ', $status ?? 'belum_mulai')) }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <i class="mdi mdi-account-tie text-primary me-1"></i>
                                                    {{ $unit->activeBooking->sales->name ?? '-' }}
                                                </td>
                                                <td>
                                                    <i class="mdi mdi-cash text-success me-1"></i>
                                                    Rp
                                                    {{ number_format($unit->activeBooking->agent_fee ?? 0, 0, ',', '.') }}
                                                </td>
                                                <td>
                                                    <i class="mdi mdi-account text-info me-1"></i>
                                                    {{ $unit->activeBooking->customer->full_name ?? '-' }}
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center gap-1">
                                                        <button class="btn btn-outline-primary btn-sm" title="Detail">
                                                            <i class="mdi mdi-eye"></i>
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
                                                <td colspan="15" class="text-center text-muted py-4">
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
                                                        class="badge badge-gradient-success position-absolute top-0 end-0 m-2"><i
                                                            class="mdi mdi-check-circle me-1"></i>Tersedia</span>
                                                @elseif($unit->status == 'sold')
                                                    <span
                                                        class="badge badge-gradient-danger position-absolute top-0 end-0 m-2"><i
                                                            class="mdi mdi-cash-check me-1"></i>Terjual</span>
                                                @else
                                                    <span
                                                        class="badge badge-gradient-warning position-absolute top-0 end-0 m-2"><i
                                                            class="mdi mdi-clock-outline me-1"></i>{{ ucfirst($unit->status) }}</span>
                                                @endif
                                                <div class="text-center bg-light py-3 py-md-4 rounded">
                                                    <i class="mdi mdi-home-outline"
                                                        style="font-size: 36px; color: #9a55ff;"></i>
                                                </div>
                                            </div>
                                            <h6 class="mt-2 fw-bold"><i
                                                    class="mdi mdi-home-variant text-primary me-1"></i>{{ $unit->unit_code }}
                                            </h6>
                                            <p class="text-muted small mb-1"><i
                                                    class="mdi mdi-office-building me-1"></i>{{ $unit->landBank->name ?? '-' }}
                                            </p>
                                            <p class="small mb-1"><i
                                                    class="mdi mdi-ruler-square me-1"></i>{{ $unit->building_area ?? ($unit->area ?? '-') }}
                                                m² | <i class="mdi mdi-currency-usd me-1"></i>Rp
                                                {{ number_format($unit->price ?? 0, 0, ',', '.') }}</p>
                                            <div class="d-flex justify-content-between align-items-center mt-2">
                                                <small class="text-muted">
                                                    <i
                                                        class="mdi mdi-account-tie me-1"></i>{{ optional(optional($unit->activeBooking)->sales)->name ?? '-' }}
                                                </small>
                                                <button class="btn btn-outline-danger btn-sm"
                                                    onclick="openCustomerModal({{ $unit->id }})">
                                                    <i class="mdi mdi-account-plus"></i>
                                                </button>
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

                        <!-- Pagination -->
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-3">
                            <div class="pagination-info mb-2 mb-sm-0">
                                <i class="mdi mdi-information-outline me-1"></i>
                                Menampilkan {{ $units->firstItem() }} - {{ $units->lastItem() }}
                                dari {{ $units->total() }} data
                            </div>
                            <div>
                                {{ $units->links('pagination::bootstrap-5') }}
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Booking Fee Section -->
                    <div class="card mb-3 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="row">
                                <!-- Booking Fee -->
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Booking Fee</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white">Rp</span>
                                        <input type="text" class="form-control" id="booking_fee" name="booking_fee"
                                            placeholder="Masukkan booking fee" autocomplete="off">
                                    </div>
                                </div>

                                <!-- Upload Bukti Transfer -->
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Upload Bukti Transfer</label>
                                    <div class="input-group">
                                        <input type="file" name="bukti_transfer" class="form-control"
                                            id="bukti_transfer" required>
                                        <span class="input-group-text bg-white">
                                            <i class="mdi mdi-cloud-upload text-primary"></i>
                                        </span>
                                    </div>
                                    <small class="text-muted">
                                        Format: JPG, PNG, PDF (Max 2MB)
                                    </small>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12">
                                    <small class="text-muted">
                                        <i class="mdi mdi-information-outline me-1"></i>
                                        Pilih customer lalu klik metode pembayaran
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Search & Filter Card -->
                    <div class="card mb-3 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="row">
                                <!-- Search -->
                                <div class="col-md-8">
                                    <label class="form-label fw-bold">
                                        <i class="mdi mdi-magnify text-primary me-1"></i>
                                        Cari Customer
                                    </label>
                                    <input type="text" id="searchCustomer" class="form-control"
                                        placeholder="Cari nama, ID, atau no. HP customer...">
                                </div>

                                <!-- Filter Pekerjaan -->
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">
                                        <i class="mdi mdi-briefcase text-primary me-1"></i>
                                        Filter Pekerjaan
                                    </label>
                                    <select class="form-control" id="filterPekerjaan">
                                        <option value="">Semua Pekerjaan</option>
                                        @php
                                            $uniqueJobs = collect($customers)->pluck('job_status')->unique()->filter();
                                        @endphp
                                        @foreach ($uniqueJobs as $job)
                                            <option value="{{ $job }}">{{ $job }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Info Total Customer -->
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted small">
                            <i class="mdi mdi-account-multiple me-1"></i>
                            Total: {{ count($customers) }} customer
                        </span>
                        <span class="badge badge-gradient-info">
                            <i class="mdi mdi-information-outline me-1"></i>
                            Klik tombol Cash/KPR untuk memilih
                        </span>
                    </div>

                    <!-- Table Customer dengan Scroll (TANPA HOVER) -->
                    <div class="table-responsive"
                        style="max-height: 350px; overflow-y: auto; border: 1px solid #e9ecef; border-radius: 8px;">
                        <table class="table table-bordered align-middle mb-0">
                            <thead class="table-light" style="position: sticky; top: 0; background: white; z-index: 5;">
                                <tr>
                                    <th class="text-center" style="width: 50px;"><i class="mdi mdi-counter me-1"></i>No
                                    </th>
                                    <th><i class="mdi mdi-card-account-details me-1"></i> ID Customer</th>
                                    <th><i class="mdi mdi-account me-1"></i> Nama</th>
                                    <th><i class="mdi mdi-phone me-1"></i> No HP</th>
                                    <th><i class="mdi mdi-briefcase me-1"></i> Pekerjaan</th>
                                    <th class="text-center" style="width: 160px;"><i class="mdi mdi-cog me-1"></i> Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($customers as $c)
                                    <tr>
                                        <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                                        <td>
                                            <span class="badge bg-light text-dark">{{ $c->customer_id ?? '-' }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2"
                                                    style="width: 32px; height: 32px; font-size: 12px; background: linear-gradient(135deg, #da8cff, #9a55ff) !important;">
                                                    {{ strtoupper(substr($c->full_name ?? 'C', 0, 1)) }}
                                                </div>
                                                <span class="fw-medium">{{ $c->full_name ?? '-' }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <i class="mdi mdi-whatsapp text-success me-1"></i>
                                            {{ $c->phone ?? '-' }}
                                        </td>
                                        <td>
                                            @if ($c->job_status)
                                                <span class="badge bg-light text-dark">
                                                    <i class="mdi mdi-briefcase-outline me-1"></i>
                                                    {{ $c->job_status === 'Lainnya' ? ($c->job_status_lainnya ?: '-') : $c->job_status }}
                                                </span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex gap-1 justify-content-center">
                                                <button type="button" class="btn btn-sm btn-success pilihCustomer"
                                                    data-id="{{ $c->id }}" data-type="cash"
                                                    style="padding: 0.25rem 0.75rem; font-size: 0.75rem;">
                                                    <i class="mdi mdi-cash me-1"></i>Cash
                                                </button>
                                                <button type="button" class="btn btn-sm btn-primary pilihCustomer"
                                                    data-id="{{ $c->id }}" data-type="kpr"
                                                    style="padding: 0.25rem 0.75rem; font-size: 0.75rem;">
                                                    <i class="mdi mdi-bank me-1"></i>KPR
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <i class="mdi mdi-account-off" style="font-size: 2rem; opacity: 0.3;"></i>
                                            <p class="mt-2 text-muted">Tidak ada data customer</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Footer Info -->
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    <i class="mdi mdi-information-outline me-1"></i>
                                    Tabel dapat di-scroll untuk melihat lebih banyak data
                                </small>
                                <small class="text-muted">
                                    <i class="mdi mdi-arrow-down me-1"></i>
                                    {{ count($customers) }} data
                                </small>
                            </div>
                        </div>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- Card untuk Agent Fee & Search (JADI SATU) -->
                    <div class="card mb-3 border-0 shadow-sm">
                        <div class="card-body">
                            <form id="formAgency" method="POST">
                                @csrf
                                <input type="hidden" name="sales_id" id="sales_id">

                                <div class="row">
                                    <!-- Agent Fee Input -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">
                                            <i class="mdi mdi-cash text-primary me-1"></i>
                                            Agent Fee
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white">Rp</span>
                                            <input type="text" class="form-control" name="agent_fee"
                                                id="agent_fee_modal" placeholder="Masukkan agent fee" autocomplete="off">
                                        </div>
                                        <small class="text-muted">
                                            <i class="mdi mdi-information-outline me-1"></i>
                                            Masukkan nominal fee untuk agency yang dipilih
                                        </small>
                                    </div>

                                    <!-- Search Agency -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">
                                            <i class="mdi mdi-magnify text-primary me-1"></i>
                                            Cari Agency
                                        </label>
                                        <div class="position-relative">
                                            <i class="mdi mdi-magnify position-absolute"
                                                style="left: 12px; top: 10px; color: #9a55ff; z-index: 10;"></i>
                                            <input type="text" id="searchAgency" class="form-control"
                                                placeholder="Cari nama agency..." style="padding-left: 40px;">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Info Total Agency -->
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted small">
                            <i class="mdi mdi-office-building me-1"></i>
                            Total: {{ count($agencies) }} agency
                        </span>
                        <span class="badge badge-gradient-info">
                            <i class="mdi mdi-information-outline me-1"></i>
                            Klik tombol Pilih untuk memilih agency
                        </span>
                    </div>

                    <!-- Table Agency dengan Scroll -->
                    <div class="table-responsive"
                        style="max-height: 400px; overflow-y: auto; border: 1px solid #e9ecef; border-radius: 8px;">
                        <table class="table table-bordered align-middle mb-0">
                            <thead class="table-light" style="position: sticky; top: 0; background: white; z-index: 5;">
                                <tr>
                                    <th class="text-center" style="width: 50px;"><i class="mdi mdi-counter me-1"></i> No
                                    </th>
                                    <th><i class="mdi mdi-office-building me-1"></i> Nama Agency</th>
                                    <th><i class="mdi mdi-phone me-1"></i> No HP</th>
                                    <th><i class="mdi mdi-map-marker me-1"></i> Alamat</th>
                                    <th class="text-center" style="width: 120px;"><i class="mdi mdi-cog me-1"></i> Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($agencies as $a)
                                    <tr>
                                        <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2"
                                                    style="width: 32px; height: 32px; font-size: 12px; background: linear-gradient(135deg, #da8cff, #9a55ff) !important;">
                                                    {{ strtoupper(substr($a->name ?? 'A', 0, 1)) }}
                                                </div>
                                                <span class="fw-medium">{{ $a->name }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <i class="mdi mdi-phone text-success me-1"></i>
                                            {{ $a->phone }}
                                        </td>
                                        <td>
                                            <i class="mdi mdi-map-marker text-danger me-1"></i>
                                            {{ $a->address }}
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-gradient-success pilihAgency"
                                                data-id="{{ $a->id }}"
                                                style="border-radius: 20px; padding: 0.25rem 1rem;">
                                                <i class="mdi mdi-check me-1"></i>Pilih
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4">
                                            <i class="mdi mdi-office-building-off"
                                                style="font-size: 2rem; opacity: 0.3;"></i>
                                            <p class="mt-2 text-muted">Tidak ada data agency</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Footer Info -->
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    <i class="mdi mdi-information-outline me-1"></i>
                                    Tabel dapat di-scroll untuk melihat lebih banyak data
                                </small>
                                <small class="text-muted">
                                    <i class="mdi mdi-arrow-down me-1"></i>
                                    {{ count($agencies) }} data
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form tersembunyi untuk submit customer -->
    <form id="formBooking" method="POST" enctype="multipart/form-data" style="display: none;">
        @csrf
        <input type="hidden" name="customer_id" id="customer_id">
        <input type="hidden" name="purchase_type" id="purchase_type">
        <input type="hidden" name="booking_fee" id="booking_fee_hidden">
        <input type="file" name="bukti_transfer" id="bukti_transfer_hidden">
    </form>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            // CEK APAKAH TABEL MEMILIKI DATA (bukan baris kosong)
            let hasData = false;
            $('#unitTable tbody tr').each(function() {
                // Jika baris memiliki lebih dari 1 kolom ATAU tidak memiliki colspan
                if ($(this).find('td').length > 1 || $(this).find('td[colspan]').length === 0) {
                    hasData = true;
                }
            });

            // Hancurkan instance DataTables jika sudah ada
            if ($.fn.DataTable.isDataTable('#unitTable')) {
                $('#unitTable').DataTable().destroy();
            }

            // HANYA inisialisasi DataTables JIKA ADA DATA
            if (hasData) {
                console.log('Data ditemukan, menginisialisasi DataTables');
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
                            targets: 0,
                            orderable: false
                        }, // Kolom No
                        {
                            targets: 14,
                            orderable: false
                        } // Kolom Aksi (index ke-14)
                    ]
                });
            } else {
                console.log('Tabel kosong, DataTables tidak diinisialisasi');
            }

            // Format Rupiah untuk booking fee dan agent fee
            $('#booking_fee, #agent_fee_modal').on('input', function() {
                let value = $(this).val().replace(/[^0-9]/g, '');
                if (value) {
                    $(this).val(new Intl.NumberFormat('id-ID').format(value));
                } else {
                    $(this).val('');
                }
            });

            // OPEN CUSTOMER MODAL
            window.openCustomerModal = function(unitId) {
                if (!unitId) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Unit tidak valid!'
                    });
                    return;
                }
                $('#modalCustomer').attr('data-unit-id', unitId);
                $('#booking_fee').val('');
                $('#modalCustomer').modal('show');
            };

            // PILIH CUSTOMER
            $(document).on('click', '.pilihCustomer', function() {
                let customerId = $(this).data('id');
                let purchaseType = $(this).data('type');
                let unitId = $('#modalCustomer').attr('data-unit-id');
                let bookingFee = $('#booking_fee').val().replace(/\./g, '');

                if (!unitId) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Unit belum dipilih!'
                    });
                    return;
                }

                if (!bookingFee || bookingFee <= 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Booking Fee Kosong',
                        text: 'Booking fee harus diisi dan lebih dari 0!'
                    });
                    return;
                }

                Swal.fire({
                    title: 'Yakin pilih customer ini?',
                    html: `
                        <p class="mb-1">Jenis: <b>${purchaseType.toUpperCase()}</b></p>
                        <p>Booking Fee: <b>Rp ${new Intl.NumberFormat('id-ID').format(bookingFee)}</b></p>
                    `,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Simpan!',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let actionUrlTemplate = "{{ route('set.customer', ':unitId') }}";
                        let actionUrl = actionUrlTemplate.replace(':unitId', unitId);

                        let form = $('#formBooking');

                        form.attr('action', actionUrl);
                        $('#customer_id').val(customerId);
                        $('#purchase_type').val(purchaseType);
                        $('#booking_fee_hidden').val(bookingFee);

                        form.submit();

                        form.append(
                            `<input type="hidden" name="_token" value="{{ csrf_token() }}">`);
                        form.append(
                            `<input type="hidden" name="customer_id" value="${customerId}">`);
                        form.append(
                            `<input type="hidden" name="purchase_type" value="${purchaseType}">`
                        );
                        form.append(
                            `<input type="hidden" name="booking_fee" value="${bookingFee}">`);

                        $('body').append(form);
                        form.submit();
                    }
                });
            });

            // AGENCY MODAL
            $(document).on('click', '.bukaModal', function() {
                let unitId = $(this).data('unit');
                let url = "{{ url('marketing/set-agency') }}/" + unitId;

                $('#formAgency').attr('action', url);
                $('#sales_id').val('');
                $('#agent_fee_modal').val('');
                $('#modalAgency').modal('show');
            });

            $(document).on('click', '.pilihAgency', function() {
                let salesId = $(this).data('id');
                let agentFee = $('#agent_fee_modal').val().replace(/\./g, '');

                if (!agentFee) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Agent fee wajib diisi!'
                    });
                    return;
                }

                $('#sales_id').val(salesId);
                $('#formAgency').append(`<input type="hidden" name="agent_fee" value="${agentFee}">`);
                $('#formAgency').submit();
            });
        });

        function switchView(view) {

            // sembunyikan semua
            document.getElementById('tableView').style.display = 'none';
            document.getElementById('gridView').style.display = 'none';
            document.getElementById('denahView').style.display = 'none';
            document.getElementById('landmapView').style.display = 'none';

            // reset active button
            document.querySelectorAll('.btn-group .btn').forEach(btn => {
                btn.classList.remove('active');
            });

            // tampilkan sesuai pilihan
            if (view === 'table') {
                document.getElementById('tableView').style.display = 'block';
                document.getElementById('btnTableView').classList.add('active');
            }

            if (view === 'grid') {
                document.getElementById('gridView').style.display = 'block';
                document.getElementById('btnGridView').classList.add('active');
            }

            if (view === 'denah') {
                document.getElementById('denahView').style.display = 'block';
                document.getElementById('btnDenahView').classList.add('active');
            }

            if (view === 'landmap') {
                document.getElementById('landmapView').style.display = 'block';
                document.getElementById('btnLandMapView').classList.add('active');
            }
        }
    </script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "{{ session('error') }}",
                confirmButtonColor: '#d33'
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Validasi Gagal',
                html: `{!! implode('<br>', $errors->all()) !!}`
            });
        </script>
    @endif
@endpush
