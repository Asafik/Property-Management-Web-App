@extends('layouts.partial.app')

@section('title', 'Dashboard - Property Management App')

@section('content')
    <style>
        /* ===== SEMUA CSS SAMA PERSIS DENGAN HALAMAN KAVLING ===== */
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

        /* Badge dengan icon */
        .badge i {
            font-size: 0.8rem;
            margin-right: 4px;
        }

        /* Hover effect untuk icon aksi */
        .btn-outline-primary:hover {
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
        .dataTables_filter {
            display: none !important;
        }

        .dataTables_length {
            display: none !important;
        }

        .dataTables_paginate {
            display: none !important;
        }

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
    </style>

    <div class="container-fluid p-2 p-sm-3 p-md-4">
        <!-- Header Dashboard -->
        <div class="row mb-3 mb-sm-3 mb-md-4">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h3 class="text-dark mb-1">
                            <i class="mdi mdi-view-dashboard me-2" style="color: #9a55ff;"></i>
                            Dashboard
                        </h3>
                        <p class="text-muted mb-0">
                            <i class="mdi mdi-information-outline me-1"></i>
                            Selamat datang di dashboard manajemen properti
                        </p>
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
                        class="card-header bg-white d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center">
                        <h4 class="card-title">
                            <i class="mdi mdi-format-list-bulleted me-2"></i>
                            Daftar Properti Terbaru
                        </h4>
                    </div>
                    <div class="card-body">
                        <!-- Filter Section - DIPERBESAR -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="filter-card">
                                    <div class="card-body">
                                        <h6 class="card-title mb-3" style="font-size: 1rem;">
                                            <i class="mdi mdi-filter-outline me-1"></i>Filter Data
                                        </h6>

                                        <!-- FILTER UNTUK MOBILE -->
                                        <div class="d-block d-md-none">
                                            <div class="mb-3">
                                                <label class="form-label">
                                                    <i class="mdi mdi-magnify me-1"></i>Pencarian
                                                </label>
                                                <input type="text" id="searchInputMobile" class="form-control"
                                                    placeholder="Cari nama properti...">
                                            </div>

                                            <div class="row g-2">
                                                <div class="col-6">
                                                    <label class="form-label">
                                                        <i class="mdi mdi-shape-outline me-1"></i>Type
                                                    </label>
                                                    <select id="filterTypeMobile" class="form-control">
                                                        <option value="">Semua</option>
                                                        <option value="Rumah">Rumah</option>
                                                        <option value="Apartemen">Apartemen</option>
                                                        <option value="Ruko">Ruko</option>
                                                        <option value="Tanah">Tanah</option>
                                                    </select>
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label">
                                                        <i class="mdi mdi-map-marker me-1"></i>Lokasi
                                                    </label>
                                                    <select id="filterLokasiMobile" class="form-control">
                                                        <option value="">Semua</option>
                                                        <option value="Jakarta">Jakarta</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row g-2 mt-2">
                                                <div class="col-6">
                                                    <label class="form-label">
                                                        <i class="mdi mdi-counter me-1"></i>Tampil
                                                    </label>
                                                    <select id="showDataMobile" class="form-control">
                                                        <option value="10">10</option>
                                                        <option value="25">25</option>
                                                        <option value="50">50</option>
                                                        <option value="100">100</option>
                                                    </select>
                                                </div>
                                                <div class="col-6">
                                                    <button type="button" id="filterDataMobile"
                                                        class="btn btn-gradient-primary w-100" style="margin-top: 24px;">
                                                        <i class="mdi mdi-filter-outline me-1"></i> Filter
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-12">
                                                    <button type="button" id="resetFilterMobile"
                                                        class="btn btn-gradient-secondary w-100">
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
                                                        <i class="mdi mdi-magnify me-1"></i>Pencarian
                                                    </label>
                                                    <input type="text" id="searchInput" class="form-control"
                                                        placeholder="Cari nama properti...">
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">
                                                        <i class="mdi mdi-shape-outline me-1"></i>Type
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
                                                        <i class="mdi mdi-map-marker me-1"></i>Lokasi
                                                    </label>
                                                    <select id="filterLokasi" class="form-control">
                                                        <option value="">Semua</option>
                                                        <option value="Jakarta">Jakarta</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">
                                                        <i class="mdi mdi-counter me-1"></i>Tampil
                                                    </label>
                                                    <select id="showData" class="form-control">
                                                        <option value="10">10</option>
                                                        <option value="25">25</option>
                                                        <option value="50">50</option>
                                                        <option value="100">100</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-1">
                                                    <button type="button" id="filterData"
                                                        class="btn btn-gradient-primary w-100" title="Filter Data">
                                                        <i class="mdi mdi-filter-outline"></i>
                                                    </button>
                                                </div>
                                                <div class="col-md-1">
                                                    <button type="button" id="resetFilter"
                                                        class="btn btn-gradient-secondary w-100" title="Reset Filter">
                                                        <i class="mdi mdi-refresh"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tabel Data - 1 Data Saja -->
                        <div class="table-responsive">
                            <table id="tableDashboard" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center"><i class="mdi mdi-counter me-1"></i>No</th>
                                        <th><i class="mdi mdi-home me-1"></i>Nama Proyek / Tanah Induk</th>
                                        <th><i class="mdi mdi-domain me-1"></i>Nama Perusahaan</th>
                                        <th><i class="mdi mdi-shape-outline me-1"></i>Tipe</th>
                                        <th class="d-none d-md-table-cell"><i class="mdi mdi-map-marker me-1"></i>Lokasi
                                        </th>
                                        <th><i class="mdi mdi-currency-usd me-1"></i>Harga di peroleh</th>
                                        <th><i class="mdi mdi-calendar-clock me-1"></i>Status</th>
                                        <th class="text-center"><i class="mdi mdi-cog me-1"></i>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($landBank as $item)
                                        <tr>
                                            {{-- Nomor --}}
                                            <td class="text-center fw-bold">
                                                <span class="badge bg-light text-dark">
                                                    {{ $loop->iteration }}
                                                </span>
                                            </td>

                                            {{-- Nama Project --}}
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
                                            {{-- Tipe --}}
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-home-city text-info me-2"
                                                        style="font-size: 1rem;"></i>
                                                    <span>{{ $item->zoning ?? '-' }}</span>
                                                </div>
                                            </td>

                                            {{-- Lokasi (Desktop) --}}
                                            <td class="d-none d-md-table-cell">
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-map-marker text-danger me-2"
                                                        style="font-size: 1rem;"></i>
                                                    <span>{{ $item->address ?? '-' }}</span>
                                                </div>
                                            </td>

                                            {{-- Harga --}}
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-currency-usd text-success me-2"
                                                        style="font-size: 1rem;"></i>
                                                    <span class="text-nowrap fw-bold text-success">
                                                        Rp {{ number_format($item->acquisition_price ?? 0, 0, ',', '.') }}
                                                    </span>
                                                </div>
                                            </td>

                                            {{-- Status --}}
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

                                            {{-- Action --}}
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="javascript:void(0)"
                                                        class="btn btn-outline-primary btn-sm btn-detail"
                                                        data-bs-toggle="modal" data-bs-target="#modalDetailLandbank"
                                                        data-name="{{ $item->name }}"
                                                        data-company="{{ $item->companyProfile->name ?? '-' }}"
                                                        data-zoning="{{ $item->zoning ?? '-' }}"
                                                        data-address="{{ $item->address ?? '-' }}"
                                                        data-price="{{ number_format($item->acquisition_price ?? 0, 0, ',', '.') }}"
                                                        data-status="{{ ucfirst($item->status) }}"
                                                        data-units='@json($item->units_detail)'>
                                                        <i class="mdi mdi-eye"></i>
                                                    </a>
                                                    <a href="" class="btn btn-outline-primary btn-sm"
                                                        data-bs-toggle="tooltip" title="Edit">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination UI - DIPERKECIL SEPERTI HALAMAN PROPERTI -->
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

        <!-- Info Tambahan untuk Mobile -->
        <div class="text-muted small mt-2 d-block d-sm-none">
            <i class="mdi mdi-information-outline me-1"></i>
            Geser untuk melihat konten lainnya
        </div>
    </div>
@endsection
<!-- Modal Detail Landbank -->
<div class="modal fade" id="modalDetailLandbank" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow">

            <!-- HEADER -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="mdi mdi-eye me-2"></i>Detail Landbank
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <!-- BODY -->
            <div class="modal-body">

                <!-- INFORMASI UTAMA -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="text-muted small">Nama Proyek</label>
                                <h6 id="detailName" class="fw-bold mb-0"></h6>
                            </div>

                            <div class="col-md-6">
                                <label class="text-muted small">Perusahaan</label>
                                <h6 id="detailCompany" class="fw-bold mb-0"></h6>
                            </div>

                            <div class="col-md-6">
                                <label class="text-muted small">Tipe / Zoning</label>
                                <h6 id="detailZoning" class="mb-0"></h6>
                            </div>

                            <div class="col-md-6">
                                <label class="text-muted small">Status</label>
                                <h6 id="detailStatus" class="mb-0"></h6>
                            </div>

                            <div class="col-12">
                                <label class="text-muted small">Lokasi</label>
                                <p id="detailAddress" class="mb-0"></p>
                            </div>

                            <div class="col-12">
                                <label class="text-muted small">Harga Perolehan</label>
                                <h5 class="text-success fw-bold mb-0">
                                    Rp <span id="detailPrice"></span>
                                </h5>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- PROGRESS + BOOKING PER UNIT -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-light fw-bold">
                        <i class="mdi mdi-view-list me-2 text-success"></i>
                        Detail Unit & Progress
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0" id="tableUnitsModal">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Unit</th>
                                        <th>Progress Stage</th>
                                        <th>Progress (%)</th>
                                        <th>Booking</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="unitsModalBody">
                                    <!-- Isi otomatis via JS -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

            <!-- FOOTER -->
            <div class="modal-footer">
                <button class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                    Tutup
                </button>
            </div>

        </div>
    </div>
</div>
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.btn-detail');

            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    // Basic Data LandBank
                    document.getElementById('detailName').innerText = this.dataset.name;
                    document.getElementById('detailCompany').innerText = this.dataset.company;
                    document.getElementById('detailZoning').innerText = this.dataset.zoning;
                    document.getElementById('detailAddress').innerText = this.dataset.address;
                    document.getElementById('detailPrice').innerText = this.dataset.price;
                    document.getElementById('detailStatus').innerText = this.dataset.status;

                    // Parse units JSON
                    const units = JSON.parse(this.dataset.units || '[]');

                    let html = '';
                    if (units.length > 0) {
                        units.forEach((unit, index) => {
                            let statusLabelMap = {
                                'active': 'Aktif',
                                'cancelled': 'Dibatalkan',
                                'cash_process': 'Proses Cash',
                                'akad': 'Akad',
                                'legal_done': 'Legal Selesai',
                                'completed': 'Selesai',
                                'lanjut_kpr': 'Melanjutkan KPR' // jangan tampilkan
                            };

                            html += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${unit.unit_name}</td>
                                <td>${unit.progress?.stage ?? '-'}</td>
                                <td>
                                    <div class="progress" style="height:8px;">
                                        <div class="progress-bar bg-success" style="width:${unit.progress?.percentage ?? 0}%"></div>
                                    </div>
                                    <small>${unit.progress?.percentage ?? 0}%</small>
                                </td>
                                <td>${unit.booking?.customer_name ?? '-'}</td>
                                <td>${statusLabelMap[unit.booking?.status] ?? '-'}</td>
                            </tr>
                            `;
                        });
                    } else {
                        html = `
                    <tr>
                        <td colspan="6" class="text-center text-muted">Belum ada unit</td>
                    </tr>
                `;
                    }

                    document.getElementById('unitsModalBody').innerHTML = html;
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Inisialisasi DataTables - hanya untuk sorting
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
                    targets: [0, 6]
                }]
            });
        });
    </script>
@endpush
