@extends('layouts.partial.app')

@section('title', 'Dashboard - Property Management App')

@section('content')
    <!-- CRITICAL CSS - INLINE AGAR CEPAT -->
    <style>
        /* Critical CSS - Minimal untuk tampilan awal */
        .card {
            transition: all 0.3s ease;
            margin-bottom: 1rem;
        }

        .card-header {
            background: linear-gradient(135deg, #ffffff, #f8f9fa);
            border-bottom: 1px solid #e9ecef;
            padding: 0.75rem;
        }

        .card-body {
            padding: 0.75rem;
        }

        @media (min-width: 576px) {
            .card-header {
                padding: 1rem;
            }

            .card-body {
                padding: 1rem;
            }
        }

        @media (min-width: 768px) {
            .card-header {
                padding: 1.2rem;
            }

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

        /* Statistics Cards */
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

        /* Filter Card */
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

        /* Buttons */
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

        /* Table */
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
            background: #fff;
            border-radius: 6px !important;
            min-width: 32px;
            text-align: center;
            transition: all 0.2s ease;
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

        /* Badge */
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
            color: #fff;
        }

        .badge-gradient-warning {
            background: linear-gradient(135deg, #ffc107, #ffdb6d);
            color: #2c2e3f;
        }

        .badge-gradient-danger {
            background: linear-gradient(135deg, #dc3545, #e4606d);
            color: #fff;
        }

        .badge-gradient-info {
            background: linear-gradient(135deg, #17a2b8, #5bc0de);
            color: #fff;
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

        @media (max-width: 576px) {
            h3.text-dark {
                font-size: 1.2rem !important;
            }
        }

        /* Button icon-only untuk reset */
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

        /* Loading indicator untuk non-critical CSS */
        .css-loaded .card:hover,
        .css-loaded .btn:hover,
        .css-loaded .page-item .page-link:hover,
        .css-loaded .table tbody tr:hover {
            transition: all 0.3s ease;
        }

        /* DataTables Custom Styling */
        .dataTables_filter,
        .dataTables_length,
        .dataTables_paginate,
        .dataTables_info {
            display: none !important;
        }

        .mdi {
            vertical-align: middle;
        }
    </style>

    <!-- NON-CRITICAL CSS - LOAD ASYNC -->
    <link rel="preload" href="{{ asset('css/dashboard-non-critical.css') }}" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="{{ asset('css/dashboard-non-critical.css') }}">
    </noscript>

    <!-- HTML CONTENT - TANPA UBAH LAYOUT -->
    <div class="container-fluid p-2 p-sm-3 p-md-4">
        <!-- Header Dashboard -->
        <div class="row mb-3 mb-sm-3 mb-md-4">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="text-dark mb-1">
                                <i class="mdi mdi-view-dashboard me-2" style="color: #9a55ff;"></i>
                                Dashboard
                            </h3>
                            <p class="text-muted mb-0">
                                <i class="mdi mdi-information-outline me-1"></i>
                                Selamat datang di dashboard manajemen properti
                            </p>
                        </div>
                        <div class="d-none d-sm-block">
                            <i class="mdi mdi-view-dashboard" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-3">
            <!-- Total Proyek -->
            <div class="col">
                <div class="card bg-gradient-primary card-img-holder text-white h-100 shadow-sm">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <img src="{{ asset('admin/assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                            alt="circle-image" />
                        <div>
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="mb-0 fw-normal" style="min-height:40px;">
                                    Total Proyek / Tanah Induk
                                </h6>
                                <i class="mdi mdi-office-building" style="font-size:1.3rem;"></i>
                            </div>
                            <h2 class="fw-bold mb-0">
                                {{ $totalProperty }}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Unit -->
            <div class="col">
                <div class="card bg-gradient-warning card-img-holder text-white h-100 shadow-sm">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <img src="{{ asset('admin/assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                            alt="circle-image" />
                        <div>
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="mb-0 fw-normal" style="min-height:40px;">
                                    Total Unit
                                </h6>
                                <i class="mdi mdi-home-city" style="font-size:1.3rem;"></i>
                            </div>
                            <h2 class="fw-bold mb-0">
                                {{ $totalUnit }}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Customer -->
            <div class="col">
                <div class="card bg-gradient-info card-img-holder text-white h-100 shadow-sm">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <img src="{{ asset('admin/assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                            alt="circle-image" />
                        <div>
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="mb-0 fw-normal" style="min-height:40px;">
                                    Total Customer
                                </h6>
                                <i class="mdi mdi-account-group" style="font-size:1.3rem;"></i>
                            </div>
                            <h2 class="fw-bold mb-0">
                                {{ $totalCustomer }}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transaksi -->
            <div class="col">
                <div class="card bg-gradient-success card-img-holder text-white h-100 shadow-sm">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <img src="{{ asset('admin/assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                            alt="circle-image" />
                        <div>
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="mb-0 fw-normal" style="min-height:40px;">
                                    Transaksi
                                </h6>
                                <i class="mdi mdi-cash-multiple" style="font-size:1.3rem;"></i>
                            </div>
                            <h2 class="fw-bold mb-0">
                                {{ $totalPayments }}
                            </h2>
                            <small class="opacity-75">Bulan ini</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pendapatan -->
            <div class="col">
                <div class="card bg-gradient-danger card-img-holder text-white h-100 shadow-sm">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <img src="{{ asset('admin/assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                            alt="circle-image" />
                        <div>
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="mb-0 fw-normal" style="min-height:40px;">
                                    Pendapatan
                                </h6>
                                <i class="mdi mdi-currency-usd" style="font-size:1.3rem;"></i>
                            </div>
                            <h2 class="fw-bold mb-0">
                                Rp 0
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Data -->
        <div class="row mt-2 mt-sm-2 mt-md-3">
            <div class="col-12">
                <div class="card">
                    <div
                        class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2">
                        <h5 class="card-title mb-0">
                            <i class="mdi mdi-format-list-bulleted me-2 text-primary"></i>
                            Daftar Properti Terbaru
                        </h5>
                    </div>

                    <div class="card-body">
                        <!-- FILTER SECTION - SAMA PERSIS DENGAN HALAMAN PT (TAPI PAKAI JAVASCRIPT) -->
                        <div class="filter-card mb-4">
                            <div class="card-body">
                                <h6 class="card-title mb-3" style="font-size: 1rem;">
                                    <i class="mdi mdi-filter-outline me-1" style="color: #9a55ff;"></i>
                                    Filter Data Properti
                                </h6>

                                <!-- FILTER UNTUK MOBILE -->
                                <div class="d-block d-md-none">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">
                                            <i class="mdi mdi-magnify me-1" style="color: #9a55ff;"></i>
                                            Pencarian
                                        </label>
                                        <input type="text" id="searchInputMobile" class="form-control"
                                            placeholder="Cari nama properti..." style="height: 45px;">
                                    </div>

                                    <div class="row g-2">
                                        <div class="col-6">
                                            <label class="form-label fw-semibold">
                                                <i class="mdi mdi-shape-outline me-1" style="color: #9a55ff;"></i>
                                                Type
                                            </label>
                                            <select id="filterTypeMobile" class="form-control" style="height: 45px;">
                                                <option value="">Semua</option>
                                                <option value="Rumah">Rumah</option>
                                                <option value="Apartemen">Apartemen</option>
                                                <option value="Ruko">Ruko</option>
                                                <option value="Tanah">Tanah</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label fw-semibold">
                                                <i class="mdi mdi-map-marker me-1" style="color: #9a55ff;"></i>
                                                Lokasi
                                            </label>
                                            <select id="filterLokasiMobile" class="form-control" style="height: 45px;">
                                                <option value="">Semua</option>
                                                <option value="Jakarta">Jakarta</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row g-2 mt-2">
                                        <div class="col-6">
                                            <button type="button" id="filterDataMobile"
                                                class="btn btn-gradient-primary w-100 py-2 d-flex align-items-center justify-content-center">
                                                <i class="mdi mdi-filter me-1"></i> Filter
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <button type="button" id="resetFilterMobile"
                                                class="btn btn-gradient-secondary w-100 py-2 d-flex align-items-center justify-content-center">
                                                <i class="mdi mdi-refresh me-1"></i> Reset
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- FILTER UNTUK TABLET & DESKTOP -->
                                <div class="d-none d-md-block">
                                    <div class="row g-2 align-items-end">
                                        <div class="col-md-3">
                                            <label class="form-label">
                                                <i class="mdi mdi-magnify me-1" style="color: #9a55ff;"></i>
                                                Pencarian
                                            </label>
                                            <input type="text" id="searchInput" class="form-control"
                                                placeholder="Cari nama properti...">
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label">
                                                <i class="mdi mdi-shape-outline me-1" style="color: #9a55ff;"></i>
                                                Type
                                            </label>
                                            <select id="filterType" class="form-control">
                                                <option value="">Semua</option>
                                                <option value="Rumah">Rumah</option>
                                                <option value="Apartemen">Apartemen</option>
                                                <option value="Ruko">Ruko</option>
                                                <option value="Tanah">Tanah</option>
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label">
                                                <i class="mdi mdi-map-marker me-1" style="color: #9a55ff;"></i>
                                                Lokasi
                                            </label>
                                            <select id="filterLokasi" class="form-control">
                                                <option value="">Semua</option>
                                                <option value="Jakarta">Jakarta</option>
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label invisible">Filter</label>
                                            <button type="button" id="filterData"
                                                class="btn btn-gradient-primary w-100 d-flex align-items-center justify-content-center">
                                                <i class="mdi mdi-filter me-1"></i> Filter
                                            </button>
                                        </div>

                                        <div class="col-md-1">
                                            <label class="form-label invisible">Reset</label>
                                            <button type="button" id="resetFilter"
                                                class="btn btn-gradient-secondary w-100 d-flex align-items-center justify-content-center btn-icon-only"
                                                title="Reset">
                                                <i class="mdi mdi-refresh"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tabel Data -->
                        <div class="table-responsive">
                            <table id="tableDashboard" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="5%">No</th>
                                        <th width="20%">Nama Proyek / Tanah Induk</th>
                                        <th width="15%">Nama Perusahaan</th>
                                        <th width="10%">Tipe</th>
                                        <th width="20%" class="d-none d-md-table-cell">Lokasi</th>
                                        <th width="15%">Harga di peroleh</th>
                                        <th width="10%">Status</th>
                                        <th width="15%">Unit</th>
                                        <th width="15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($landBank as $item)
                                        <tr>
                                            <td class="text-center fw-bold">
                                                <span class="badge bg-light text-dark">
                                                    {{ $loop->iteration }}
                                                </span>
                                            </td>

                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-home-variant text-primary me-2"
                                                        style="font-size: 1rem;"></i>
                                                    <span class="fw-bold">{{ $item->name ?? '-' }}</span>
                                                </div>
                                                <small class="text-muted d-block d-md-none">
                                                    <i class="mdi mdi-map-marker me-1"></i> {{ $item->unit->type ?? '-' }}
                                                </small>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-domain-variant text-primary me-2"
                                                        style="font-size: 1rem;"></i>
                                                    <span class="fw-bold">{{ $item->companyProfile->name ?? '-' }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-home-city text-info me-2"
                                                        style="font-size: 1rem;"></i>
                                                    <span>{{ $item->zoning ?? '-' }}</span>
                                                </div>
                                            </td>

                                            <td class="d-none d-md-table-cell">
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-map-marker text-danger me-2"
                                                        style="font-size: 1rem;"></i>
                                                    <span>{{ $item->address ?? '-' }}</span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-currency-usd text-success me-2"
                                                        style="font-size: 1rem;"></i>
                                                    <span class="text-nowrap fw-bold text-success">
                                                        Rp {{ number_format($item->acquisition_price ?? 0, 0, ',', '.') }}
                                                    </span>
                                                </div>
                                            </td>

                                            <td>
                                                @if ($item->status == 'ready')
                                                    <span class="badge badge-gradient-success">
                                                        <i class="mdi mdi-check-circle me-1"></i>Tersedia
                                                    </span>
                                                @elseif($item->status == 'sold')
                                                    <span class="badge badge-gradient-danger">
                                                        <i class="mdi mdi-close-circle me-1"></i>Terjual
                                                    </span>
                                                @else
                                                    <span class="badge badge-gradient-warning">
                                                        <i class="mdi mdi-clock me-1"></i>{{ ucfirst($item->status) }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex flex-wrap gap-1">
                                                    @if (!empty($item->units_detail))
                                                        @foreach ($item->units_detail as $unit)
                                                            <span class="badge bg-info text-white">
                                                                {{ $unit['unit_code'] ?? '-' }} /
                                                                {{ $unit['type'] ?? '-' }} /
                                                                {{ $unit['unit_name'] ?? '-' }}
                                                            </span>
                                                        @endforeach
                                                    @else
                                                        <span class="text-muted">Belum ada unit</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <button class="btn btn-outline-info btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#modalDetailLandbank{{ $item->id }}">
                                                    <i class="mdi mdi-eye"></i>
                                                </button>
                                            </td>


                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination UI - TETAP PAKAI PAGINATION YANG SUDAH ADA -->
                        {{-- <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-3">
                            <div class="pagination-info mb-2 mb-sm-0">
                                <i class="mdi mdi-information-outline me-1"></i>
                                Menampilkan {{ $landBank->count() }} dari {{ $landBank->total() }} data
                            </div>
                            <nav aria-label="Page navigation">
                                {{ $landBank->links() }}
                            </nav>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>

        <!-- Info Tambahan untuk Mobile -->
        <div class="text-muted small mt-2 d-block d-sm-none">
            <i class="mdi mdi-information-outline me-1"></i>
            Geser untuk melihat konten lainnya
        </div>
    </div>

    @foreach ($landBank as $item)
        <div class="modal fade" id="modalDetailLandbank{{ $item->id }}" tabindex="-1">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content border-0 shadow">

                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">
                            <i class="mdi mdi-eye me-2"></i>Detail Landbank
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <!-- INFORMASI UTAMA -->
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body">
                                <div class="row g-3">

                                    <div class="col-md-6">
                                        <label class="text-muted small">Nama Proyek</label>
                                        <h6 class="fw-bold mb-0">
                                            {{ $item->name }}
                                        </h6>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="text-muted small">Perusahaan</label>
                                        <h6 class="fw-bold mb-0">
                                            {{ $item->companyProfile->name ?? '-' }}
                                        </h6>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="text-muted small">Tipe / Zoning</label>
                                        <h6 class="mb-0">
                                            {{ $item->zoning }}
                                        </h6>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="text-muted small">Status</label>
                                        <span class="badge bg-success">
                                            {{ $item->status }}
                                        </span>
                                    </div>

                                    <div class="col-12">
                                        <label class="text-muted small">Lokasi</label>
                                        <p class="mb-0">
                                            {{ $item->address }}
                                        </p>
                                    </div>

                                    <div class="col-12">
                                        <label class="text-muted small">Harga Perolehan</label>
                                        <h5 class="text-success fw-bold mb-0">
                                            Rp {{ number_format($item->acquisition_price, 0, ',', '.') }}
                                        </h5>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- DETAIL UNIT -->
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-light fw-bold">
                                <i class="mdi mdi-view-list me-2 text-success"></i>
                                Detail Unit & Progress
                            </div>

                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Unit</th>
                                                <th>Type Unit</th>
                                                <th>Progress Pembangunan</th>
                                                <th>Booking</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>

                                        @foreach ($landBank as $landBank)
                                            <tbody>
                                                @foreach ($landBank->units as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>

                                                        <td>{{ $item->unit_name ?? '-' }}</td>

                                                        <td>{{ $item->type }}</td>

                                                        <td>
                                                            @switch($item->construction_progress)
                                                                @case('belum_mulai')
                                                                    <span class="badge bg-secondary">Belum Mulai</span>
                                                                @break

                                                                @case('pondasi')
                                                                    <span class="badge bg-info">Pondasi</span>
                                                                @break

                                                                @case('dinding')
                                                                    <span class="badge bg-primary">Dinding</span>
                                                                @break

                                                                @case('atap')
                                                                    <span class="badge bg-warning text-dark">Atap</span>
                                                                @break

                                                                @case('finishing')
                                                                    <span class="badge bg-dark">Finishing</span>
                                                                @break

                                                                @case('selesai')
                                                                    <span class="badge bg-success">Selesai</span>
                                                                @break

                                                                @default
                                                                    <span class="badge bg-light text-dark">-</span>
                                                            @endswitch
                                                        </td>
                                                        <td>
                                                            @if ($item->activeBooking && $item->activeBooking->customer)
                                                                <span class="badge bg-success">
                                                                    {{ $item->activeBooking->customer->full_name }}
                                                                </span>
                                                            @else
                                                                <span class="badge bg-secondary">
                                                                    Belum Booking
                                                                </span>
                                                            @endif
                                                        </td>

                                                        <td>
                                                            <span class="badge bg-info">
                                                                {{ $item->status }}
                                                            </span>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        @endforeach

                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                            Tutup
                        </button>
                    </div>

                </div>
            </div>
        </div>
    @endforeach
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal',
                text: '{{ session('error') }}'
            });
        </script>
    @endif
    <script>
        $(document).ready(function() {
            let table = $('#tableDashboard').DataTable({
                responsive: true,
                paging: false,
                info: false,
                searching: false,
                lengthChange: false,
                ordering: true,
                language: {
                    emptyTable: "Data kosong",
                    zeroRecords: "Data tidak ditemukan",
                },
                columnDefs: [{
                    orderable: false,
                    targets: [0, 7]
                }]
            });

            // Filter functionality
            function filterTable() {
                let searchValue = $('#searchInput').val().toLowerCase() || $('#searchInputMobile').val()
                    .toLowerCase();
                let typeValue = $('#filterType').val() || $('#filterTypeMobile').val();
                let locationValue = $('#filterLokasi').val() || $('#filterLokasiMobile').val();

                table.rows().every(function() {
                    let row = this.data();
                    let rowNode = this.node();
                    let show = true;

                    // Search filter
                    if (searchValue) {
                        let rowText = '';
                        for (let i = 1; i <= 2; i++) {
                            rowText += row[i] ? row[i].toLowerCase() : '';
                        }
                        if (!rowText.includes(searchValue)) {
                            show = false;
                        }
                    }

                    // Type filter
                    if (show && typeValue) {
                        let type = $(rowNode).find('td:eq(3) span').text();
                        if (type.toLowerCase() !== typeValue.toLowerCase()) {
                            show = false;
                        }
                    }

                    // Location filter
                    if (show && locationValue) {
                        let location = $(rowNode).find('td:eq(4) span').text();
                        if (location.toLowerCase() !== locationValue.toLowerCase()) {
                            show = false;
                        }
                    }

                    if (show) {
                        $(rowNode).show();
                    } else {
                        $(rowNode).hide();
                    }
                });

                // Update info
                let visibleCount = table.rows(':visible').count();
                $('.pagination-info').html(
                    `<i class="mdi mdi-information-outline me-1"></i>Menampilkan ${visibleCount} dari ${table.rows().count()} data`
                );
            }

            function resetFilter() {
                $('#searchInput, #searchInputMobile').val('');
                $('#filterType, #filterTypeMobile').val('');
                $('#filterLokasi, #filterLokasiMobile').val('');

                table.rows().show();
                $('.pagination-info').html(
                    `<i class="mdi mdi-information-outline me-1"></i>Menampilkan ${table.rows().count()} dari ${table.rows().count()} data`
                );
            }

            // Desktop filter
            $('#filterData').click(filterTable);
            $('#resetFilter').click(resetFilter);

            // Mobile filter
            $('#filterDataMobile').click(filterTable);
            $('#resetFilterMobile').click(resetFilter);

            // Enter key on search input
            $('#searchInput, #searchInputMobile').keypress(function(e) {
                if (e.which == 13) {
                    filterTable();
                }
            });
        });
    </script>
@endpush
