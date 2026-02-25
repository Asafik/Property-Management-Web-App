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

        .table tbody td {
            vertical-align: middle;
            font-size: 0.85rem;
            padding: 0.8rem 0.5rem;
            border-bottom: 1px solid #e9ecef;
            color: #2c2e3f;
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
                                                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                                    <option value="ready" {{ request('status') == 'ready' ? 'selected' : '' }}>Ready</option>
                                                    <option value="booked" {{ request('status') == 'booked' ? 'selected' : '' }}>Booked</option>
                                                    <option value="sold" {{ request('status') == 'sold' ? 'selected' : '' }}>Sold</option>
                                                </select>
                                            </div>

                                            <!-- Harga -->
                                            <div class="col-md-2 filter-col">
                                                <label class="form-label">
                                                    <i class="mdi mdi-currency-usd me-1"></i>Harga
                                                </label>
                                                <select name="price" class="form-control">
                                                    <option value="">Semua</option>
                                                    <option value="<500" {{ request('price') == '<500' ? 'selected' : '' }}>&lt; 500 Jt</option>
                                                    <option value="500-1000" {{ request('price') == '500-1000' ? 'selected' : '' }}>500 Jt - 1 M</option>
                                                    <option value=">1000" {{ request('price') == '>1000' ? 'selected' : '' }}>&gt; 1 M</option>
                                                </select>
                                            </div>

                                            <!-- Tampil (diperkecil) -->
                                            <div class="col-md-1 filter-col">
                                                <label class="form-label">
                                                    <i class="mdi mdi-counter me-1"></i>Tampil
                                                </label>
                                                <select name="perPage" class="form-control">
                                                    <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                                                    <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25</option>
                                                    <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
                                                    <option value="100" {{ request('perPage') == 100 ? 'selected' : '' }}>100</option>
                                                </select>
                                            </div>

                                            <!-- Button Filter -->
                                            <div class="col-md-1 filter-col">
                                                <label class="form-label" style="visibility: hidden;">Filter</label>
                                                <button type="submit" class="btn btn-gradient-primary w-100 btn-filter-reset" title="Filter">
                                                    <i class="mdi mdi-filter"></i>
                                                </button>
                                            </div>

                                            <!-- Button Reset -->
                                            <div class="col-md-1 filter-col">
                                                <label class="form-label" style="visibility: hidden;">Reset</label>
                                                <a href="{{ route('marketing.jual-unit') }}" class="btn btn-gradient-secondary w-100 btn-filter-reset" title="Reset">
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
                                                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                                    <option value="ready" {{ request('status') == 'ready' ? 'selected' : '' }}>Ready</option>
                                                    <option value="booked" {{ request('status') == 'booked' ? 'selected' : '' }}>Booked</option>
                                                    <option value="sold" {{ request('status') == 'sold' ? 'selected' : '' }}>Sold</option>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">
                                                    <i class="mdi mdi-currency-usd me-1"></i>Harga
                                                </label>
                                                <select name="price" class="form-control">
                                                    <option value="">Semua</option>
                                                    <option value="<500" {{ request('price') == '<500' ? 'selected' : '' }}>&lt; 500 Jt</option>
                                                    <option value="500-1000" {{ request('price') == '500-1000' ? 'selected' : '' }}>500 Jt - 1 M</option>
                                                    <option value=">1000" {{ request('price') == '>1000' ? 'selected' : '' }}>&gt; 1 M</option>
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
                                                    <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                                                    <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25</option>
                                                    <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
                                                    <option value="100" {{ request('perPage') == 100 ? 'selected' : '' }}>100</option>
                                                </select>
                                            </div>
                                            <div class="col-4">
                                                <label class="form-label" style="visibility: hidden;">Filter</label>
                                                <button type="submit" class="btn btn-gradient-primary w-100 btn-filter-reset">
                                                    <i class="mdi mdi-filter"></i>
                                                </button>
                                            </div>
                                            <div class="col-4">
                                                <label class="form-label" style="visibility: hidden;">Reset</label>
                                                <a href="{{ route('marketing.jual-unit') }}" class="btn btn-gradient-secondary w-100 btn-filter-reset">
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
                                            <th class="text-center">No</th>
                                            <th>Blok</th>
                                            <th>Proyek</th>
                                            <th>Tipe</th>
                                            <th class="d-none d-md-table-cell">Lokasi</th>
                                            <th>Luas Tanah</th>
                                            <th>Luas Bangunan</th>
                                            <th>Harga</th>
                                            <th>Hadap</th>
                                            <th>Status</th>
                                            <th>Agent</th>
                                            <th>Fee Agent</th>
                                            <th>Customer</th>
                                            <th class="text-center">Aksi</th>
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
                                                <td>{{ $unit->landBank->name ?? '-' }}</td>
                                                <td>{{ $unit->type ?? '-' }}</td>
                                                <td class="d-none d-md-table-cell">{{ Str::limit($unit->landBank->address ?? '-', 15) }}</td>
                                                <td>{{ $unit->area ?? '-' }} m²</td>
                                                <td>{{ $unit->building_area ?? '-' }} m²</td>
                                                <td>Rp {{ number_format($unit->price ?? 0, 0, ',', '.') }}</td>
                                                <td>{{ $unit->facing ?? '-' }}</td>
                                                <td>
                                                    @if ($unit->status == 'ready' || $unit->status == 'tersedia')
                                                        <span class="badge badge-gradient-success">Tersedia</span>
                                                    @elseif($unit->status == 'sold')
                                                        <span class="badge badge-gradient-danger">Terjual</span>
                                                    @else
                                                        <span class="badge badge-gradient-warning">{{ ucfirst($unit->status) }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $unit->activeBooking->sales->name ?? '-' }}</td>
                                                <td>Rp {{ number_format($unit->activeBooking->agent_fee ?? 0, 0, ',', '.') }}</td>
                                                <td>{{ $unit->activeBooking->customer->full_name ?? '-' }}</td>
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
                                                <td colspan="14" class="text-center text-muted py-4">
                                                    <i class="mdi mdi-home-outline" style="font-size: 2rem; opacity: 0.3;"></i>
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
                                                    <span class="badge badge-gradient-success position-absolute top-0 end-0 m-2">Tersedia</span>
                                                @elseif($unit->status == 'sold')
                                                    <span class="badge badge-gradient-danger position-absolute top-0 end-0 m-2">Terjual</span>
                                                @else
                                                    <span class="badge badge-gradient-warning position-absolute top-0 end-0 m-2">{{ ucfirst($unit->status) }}</span>
                                                @endif
                                                <div class="text-center bg-light py-3 py-md-4 rounded">
                                                    <i class="mdi mdi-home-outline" style="font-size: 36px; color: #9a55ff;"></i>
                                                </div>
                                            </div>
                                            <h6 class="mt-2 fw-bold">{{ $unit->unit_code }}</h6>
                                            <p class="text-muted small mb-1">{{ $unit->landBank->name ?? '-' }}</p>
                                            <p class="small mb-1">{{ $unit->building_area ?? $unit->area ?? '-' }} m² | Rp {{ number_format($unit->price ?? 0, 0, ',', '.') }}</p>
                                            <div class="d-flex justify-content-between align-items-center mt-2">
                                                <small class="text-muted">
                                                    <i class="mdi mdi-account-tie me-1"></i>{{ optional(optional($unit->activeBooking)->sales)->name ?? '-' }}
                                                </small>
                                                <button class="btn btn-outline-danger btn-sm" onclick="openCustomerModal({{ $unit->id }})">
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
                                    <input type="text" class="form-control" id="booking_fee" name="booking_fee"
                                        placeholder="Masukkan booking fee" autocomplete="off">
                                </div>


                                <!-- Upload Bukti Transfer -->
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Upload Bukti Transfer</label>
                                    <form id="formBooking" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <input type="hidden" name="customer_id" id="customer_id">
                                        <input type="hidden" name="purchase_type" id="purchase_type">
                                        <input type="hidden" name="booking_fee" id="booking_fee_hidden">

                                        <input type="file" name="bukti_transfer" class="form-control" required>
                                    </form>
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

                    <!-- Table Customer -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>ID Customer</th>
                                    <th>Nama</th>
                                    <th>No HP</th>
                                    <th>Pekerjaan</th>
                                    <th width="160">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $c)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $c->customer_id ?? '-' }}</td>
                                        <td>{{ $c->full_name ?? '-' }}</td>
                                        <td>{{ $c->phone ?? '-' }}</td>
                                        <td>
                                            {{ $c->job_status === 'Lainnya' ? ($c->job_status_lainnya ?: '-') : ($c->job_status ?: '-') }}
                                        </td>
                                        <td>
                                            <div class="d-flex gap-1">
                                                <button type="button" class="btn btn-sm btn-success pilihCustomer"
                                                    data-id="{{ $c->id }}" data-type="cash">
                                                    Cash
                                                </button>
                                                <button type="button" class="btn btn-sm btn-primary pilihCustomer"
                                                    data-id="{{ $c->id }}" data-type="kpr">
                                                    KPR
                                                </button>
                                            </div>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formAgency" method="POST">
                        @csrf
                        <input type="hidden" name="sales_id" id="sales_id">

                        <!-- Agent Fee Input -->
                        <div class="card mb-3 border-0 shadow-sm">
                            <div class="card-body">
                                <label class="form-label fw-bold">Agent Fee</label>
                                <input type="text" class="form-control" name="agent_fee" id="agent_fee_modal"
                                    placeholder="Masukkan agent fee" autocomplete="off">
                                <small class="text-muted">
                                    Masukkan nominal fee untuk agency yang dipilih
                                </small>
                            </div>
                        </div>
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
                                                Pilih
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
            // DataTables Unit
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
                    targets: [0, 13]
                }]
            });

            // Format Rupiah untuk booking fee
            $('#booking_fee, #agent_fee_modal').on('input', function() {
                let value = $(this).val().replace(/[^0-9]/g, '');
                if (value) {
                    $(this).val(new Intl.NumberFormat('id-ID').format(value));
                }
            });

            // OPEN CUSTOMER MODAL
            window.openCustomerModal = function(unitId) {
                if (!unitId) {
                    alert('Unit tidak valid!');
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

                        form.append(`<input type="hidden" name="_token" value="{{ csrf_token() }}">`);
                        form.append(`<input type="hidden" name="customer_id" value="${customerId}">`);
                        form.append(`<input type="hidden" name="purchase_type" value="${purchaseType}">`);
                        form.append(`<input type="hidden" name="booking_fee" value="${bookingFee}">`);

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

        // SWITCH VIEW
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