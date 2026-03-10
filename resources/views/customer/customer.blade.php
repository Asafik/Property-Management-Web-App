@extends('layouts.partial.app')

@section('title', 'Data Customer - Property Management App')

@section('content')
    <style>
        /* ===== SEMUA CSS SAMA PERSIS DENGAN HALAMAN SEBELUMNYA ===== */
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

        .btn-outline-warning {
            background: transparent;
            border: 1px solid #ffc107;
            color: #ffc107;
            padding: 0.4rem 0.75rem;
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

        /* ===== AVATAR STYLING ===== */
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

        /* ===== RESPONSIVE ===== */
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
        }

        /* DataTables Custom Styling */
        .dataTables_filter,
        .dataTables_length,
        .dataTables_paginate,
        .dataTables_info {
            display: none !important;
        }

        .sorting,
        .sorting_asc,
        .sorting_desc {
            cursor: pointer;
        }

        .mdi {
            vertical-align: middle;
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
                                Data Customer
                            </h3>
                            <p class="text-muted mb-0">
                                <i class="mdi mdi-information-outline me-1"></i>
                                Kelola data customer / pembeli unit properti
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
        <div class="row g-2 g-sm-2 g-md-3">
            <!-- Mobile: 2 cards per row, Tablet: 2 cards per row, Desktop: 4 cards per row -->
            <div class="col-6 col-sm-6 col-md-6 col-lg-3 mb-2 mb-sm-2 mb-md-3">
                <div class="card bg-gradient-primary card-img-holder text-white h-100">
                    <div class="card-body p-2 p-sm-2 p-md-3">
                        <img src="{{ asset('admin/assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                            alt="circle-image" />
                        <h4 class="font-weight-normal mb-2 mb-sm-2 mb-md-3 small fs-6 fs-sm-6 fs-md-5">
                            Total Customer
                            <i class="mdi mdi-account-group float-end" style="font-size: 1.2rem;"></i>
                        </h4>
                        <h2 class="mb-2 mb-sm-2 mb-md-4 fs-5 fs-sm-5 fs-md-2">{{ $totalCustomer }}</h2>
                        <h6 class="card-text small">Semua customer</h6>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-md-6 col-lg-3 mb-2 mb-sm-2 mb-md-3">
                <div class="card bg-gradient-success card-img-holder text-white h-100">
                    <div class="card-body p-2 p-sm-2 p-md-3">
                        <img src="{{ asset('admin/assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                            alt="circle-image" />
                        <h4 class="font-weight-normal mb-2 mb-sm-2 mb-md-3 small fs-6 fs-sm-6 fs-md-5">
                            Customer Aktif
                            <i class="mdi mdi-account-check float-end" style="font-size: 1.2rem;"></i>
                        </h4>
                        <h2 class="mb-2 mb-sm-2 mb-md-4 fs-5 fs-sm-5 fs-md-2">187</h2>
                        <h6 class="card-text small">75% dari total</h6>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-md-6 col-lg-3 mb-2 mb-sm-2 mb-md-3">
                <div class="card bg-gradient-warning card-img-holder text-white h-100">
                    <div class="card-body p-2 p-sm-2 p-md-3">
                        <img src="{{ asset('admin/assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                            alt="circle-image" />
                        <h4 class="font-weight-normal mb-2 mb-sm-2 mb-md-3 small fs-6 fs-sm-6 fs-md-5">
                            Pembeli Cash
                            <i class="mdi mdi-cash-multiple float-end" style="font-size: 1.2rem;"></i>
                        </h4>
                        <h2 class="mb-2 mb-sm-2 mb-md-4 fs-5 fs-sm-5 fs-md-2">98</h2>
                        <h6 class="card-text small">39.5%</h6>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-md-6 col-lg-3 mb-2 mb-sm-2 mb-md-3">
                <div class="card bg-gradient-info card-img-holder text-white h-100">
                    <div class="card-body p-2 p-sm-2 p-md-3">
                        <img src="{{ asset('admin/assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                            alt="circle-image" />
                        <h4 class="font-weight-normal mb-2 mb-sm-2 mb-md-3 small fs-6 fs-sm-6 fs-md-5">
                            Pembeli KPR
                            <i class="mdi mdi-bank float-end" style="font-size: 1.2rem;"></i>
                        </h4>
                        <h2 class="mb-2 mb-sm-2 mb-md-4 fs-5 fs-sm-5 fs-md-2">150</h2>
                        <h6 class="card-text small">60.5%</h6>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Data Customer -->
        <div class="row mt-4 mt-sm-4 mt-md-4">
            <div class="col-12">
                <div class="card">
                    <div
                        class="card-header bg-white d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                        <h5 class="card-title mb-2 mb-md-0">
                            <i class="mdi mdi-format-list-bulleted me-2 text-primary"></i>
                            Daftar Customer
                        </h5>
                        <div class="d-flex gap-2">
                            <button class="btn btn-sm btn-gradient-success"
                                onclick="$('#modalImportCustomer').modal('show')">
                                <i class="mdi mdi-import me-1"></i><span class="d-none d-sm-inline">Import</span>
                            </button>
                            <button class="btn btn-sm btn-gradient-danger"
                                onclick="$('#modalExportCustomer').modal('show')">
                                <i class="mdi mdi-export me-1"></i><span class="d-none d-sm-inline">Export</span>
                            </button>
                            <button onclick="window.location='{{ route('customer.tambah_customer') }}'"
                                class="btn btn-sm btn-gradient-primary">
                                <i class="mdi mdi-account-multiple-plus-outline"></i> Tambah User
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Filter Section -->
                        <div class="filter-card">
                            <div class="card-body">
                                <h6 class="card-title mb-3" style="font-size: 1rem;">
                                    <i class="mdi mdi-filter-outline me-1"></i>Filter Data Customer
                                </h6>

                                <!-- FILTER UNTUK MOBILE -->
                                <div class="d-block d-md-none">
                                    <form method="GET" action="{{ route('customer.data') }}">
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">
                                                <i class="mdi mdi-magnify me-1" style="color: #9a55ff;"></i>Cari Customer
                                            </label>
                                            <input type="text" name="search" class="form-control"
                                                value="{{ request('search') }}" placeholder="Cari nama, ID..."
                                                style="height: 45px;">
                                        </div>

                                        <div class="row g-2">
                                            <div class="col-6">
                                                <label class="form-label fw-semibold">
                                                    <i class="mdi mdi-briefcase me-1" style="color: #9a55ff;"></i>Pekerjaan
                                                </label>
                                                <select name="pekerjaan" class="form-control">
                                                    <option value="">Semua</option>
                                                    <option value="PNS"
                                                        {{ request('pekerjaan') == 'PNS' ? 'selected' : '' }}>PNS</option>
                                                    <option value="Karyawan Swasta"
                                                        {{ request('pekerjaan') == 'Karyawan Swasta' ? 'selected' : '' }}>
                                                        Karyawan Swasta</option>
                                                    <option value="Wiraswasta"
                                                        {{ request('pekerjaan') == 'Wiraswasta' ? 'selected' : '' }}>
                                                        Wiraswasta</option>
                                                    <option value="Ibu Rumah Tangga"
                                                        {{ request('pekerjaan') == 'Ibu Rumah Tangga' ? 'selected' : '' }}>
                                                        Ibu Rumah Tangga</option>
                                                    <option value="Pensiunan"
                                                        {{ request('pekerjaan') == 'Pensiunan' ? 'selected' : '' }}>
                                                        Pensiunan</option>
                                                    <option value="Lainnya"
                                                        {{ request('pekerjaan') == 'Lainnya' ? 'selected' : '' }}>Lainnya
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row g-2 mt-2">
                                            <div class="col-6">
                                                <label class="form-label fw-semibold">
                                                    <i class="mdi mdi-counter me-1" style="color: #9a55ff;"></i>Tampil
                                                </label>
                                                <select name="per_page" class="form-control" style="height: 45px;">
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
                                            <div class="col-6 d-flex align-items-end">
                                                <button type="submit"
                                                    class="btn btn-gradient-primary w-100 py-2 d-flex align-items-center justify-content-center">
                                                    <i class="mdi mdi-filter me-1"></i> Filter
                                                </button>
                                            </div>
                                        </div>

                                        <div class="row g-2 mt-2">
                                            <div class="col-12">
                                                <a href="{{ route('customer.data') }}"
                                                    class="btn btn-gradient-secondary w-100 py-2 d-flex align-items-center justify-content-center">
                                                    <i class="mdi mdi-refresh me-1"></i> Reset
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- FILTER UNTUK TABLET & DESKTOP -->
                                <div class="d-none d-md-block">
                                    <form method="GET" action="{{ route('customer.data') }}">
                                        <div class="row g-2 align-items-end">
                                            <div class="col-md-3">
                                                <label class="form-label">
                                                    <i class="mdi mdi-magnify me-1" style="color: #9a55ff;"></i>Cari
                                                    Customer
                                                </label>
                                                <input type="text" name="search" class="form-control"
                                                    value="{{ request('search') }}" placeholder="Nama, ID...">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">
                                                    <i class="mdi mdi-briefcase me-1"
                                                        style="color: #9a55ff;"></i>Pekerjaan
                                                </label>
                                                <select name="pekerjaan" class="form-control">
                                                    <option value="">Semua</option>
                                                    <option value="PNS"
                                                        {{ request('pekerjaan') == 'PNS' ? 'selected' : '' }}>PNS</option>
                                                    <option value="Karyawan Swasta"
                                                        {{ request('pekerjaan') == 'Karyawan Swasta' ? 'selected' : '' }}>
                                                        Karyawan Swasta</option>
                                                    <option value="Wiraswasta"
                                                        {{ request('pekerjaan') == 'Wiraswasta' ? 'selected' : '' }}>
                                                        Wiraswasta</option>
                                                    <option value="Ibu Rumah Tangga"
                                                        {{ request('pekerjaan') == 'Ibu Rumah Tangga' ? 'selected' : '' }}>
                                                        Ibu Rumah Tangga</option>
                                                    <option value="Pensiunan"
                                                        {{ request('pekerjaan') == 'Pensiunan' ? 'selected' : '' }}>
                                                        Pensiunan</option>
                                                    <option value="Lainnya"
                                                        {{ request('pekerjaan') == 'Lainnya' ? 'selected' : '' }}>Lainnya
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">
                                                    <i class="mdi mdi-counter me-1" style="color: #9a55ff;"></i>Tampil
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
                                            <div class="col-md-1">
                                                <label class="form-label invisible">Filter</label>
                                                <button type="submit"
                                                    class="btn btn-gradient-primary w-100 d-flex align-items-center justify-content-center">
                                                    <i class="mdi mdi-filter"></i>
                                                </button>
                                            </div>
                                            <div class="col-md-1">
                                                <label class="form-label invisible">Reset</label>
                                                <a href="{{ route('customer.data') }}"
                                                    class="btn btn-gradient-secondary w-100 d-flex align-items-center justify-content-center"
                                                    title="Reset">
                                                    <i class="mdi mdi-refresh"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover" id="tableCustomer" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center"><i class="mdi mdi-counter me-1"></i>No</th>
                                        <th><i class="mdi mdi-card-account-details me-1"></i>ID Customer</th>
                                        <th><i class="mdi mdi-account me-1"></i>Nama Customer</th>
                                        <th><i class="mdi mdi-phone me-1"></i>No. HP</th>
                                        <th><i class="mdi mdi-briefcase me-1"></i>Pekerjaan</th>
                                        <th class="text-center"><i class="mdi mdi-cog me-1"></i>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customers as $customer)
                                        <tr>
                                            <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <i class="mdi mdi-card-account-details text-primary"
                                                        style="font-size: 1.2rem;" title="ID Customer"></i>
                                                    <span>{{ $customer->customer_id }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-circle avatar-sm me-2">
                                                        {{ strtoupper(substr($customer->full_name, 0, 2)) }}
                                                    </div>
                                                    <div>
                                                        <span class="fw-bold">{{ $customer->full_name }}</span>
                                                        <small class="text-muted d-block">{{ $customer->email }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <i class="mdi mdi-whatsapp text-success" style="font-size: 1.2rem;"
                                                        title="WhatsApp"></i>
                                                    <span>{{ $customer->phone }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge bg-light text-dark">{{ $customer->job_status ?? '-' }}</span>
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-1">
                                                    <button class="btn btn-outline-warning btn-sm" title="Edit">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </button>
                                                    <button class="btn btn-outline-danger btn-sm" title="Hapus">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
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
                                Menampilkan {{ $customers->firstItem() ?? 0 }} - {{ $customers->lastItem() ?? 0 }} dari
                                {{ $customers->total() }} data
                            </div>
                            <div>
                                <nav>
                                    <ul class="pagination">
                                        {{-- Previous Page Link --}}
                                        @if ($customers->onFirstPage())
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#" tabindex="-1"><i
                                                        class="mdi mdi-chevron-left"></i></a>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $customers->previousPageUrl() }}"><i
                                                        class="mdi mdi-chevron-left"></i></a>
                                            </li>
                                        @endif

                                        {{-- Page Links --}}
                                        @for ($i = 1; $i <= $customers->lastPage(); $i++)
                                            <li class="page-item {{ $i == $customers->currentPage() ? 'active' : '' }}">
                                                <a class="page-link"
                                                    href="{{ $customers->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endfor

                                        {{-- Next Page Link --}}
                                        @if ($customers->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $customers->nextPageUrl() }}"><i
                                                        class="mdi mdi-chevron-right"></i></a>
                                            </li>
                                        @else
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#"><i
                                                        class="mdi mdi-chevron-right"></i></a>
                                            </li>
                                        @endif
                                    </ul>
                                </nav>
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
                        <div class="d-flex flex-wrap gap-2">
                            <a href="dashboard" class="btn btn-gradient-secondary">
                                <i class="mdi mdi-arrow-left me-1"></i>Kembali ke Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL EDIT CUSTOMER -->
    <div class="modal fade" id="modalEditCustomer" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="mdi mdi-account-edit me-2" style="color: #9a55ff;"></i>
                        Edit Data Customer
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Nama Lengkap -->
                                <div class="modal-form-group">
                                    <label><i class="mdi mdi-account me-1 text-primary"></i>Nama Lengkap <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="modal-form-control" value="Budi Santoso" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- ID Customer -->
                                <div class="modal-form-group">
                                    <label><i class="mdi mdi-card-account-details me-1 text-primary"></i>ID
                                        Customer</label>
                                    <input type="text" class="modal-form-control" value="CUST-2025-001" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <!-- No. HP -->
                                <div class="modal-form-group">
                                    <label><i class="mdi mdi-phone me-1 text-primary"></i>No. HP <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="modal-form-control" value="0812-3456-7890" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Email -->
                                <div class="modal-form-group">
                                    <label><i class="mdi mdi-email me-1 text-primary"></i>Email</label>
                                    <input type="email" class="modal-form-control" value="budi.s@email.com">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <!-- Pekerjaan -->
                                <div class="modal-form-group">
                                    <label><i class="mdi mdi-briefcase me-1 text-primary"></i>Pekerjaan</label>
                                    <select class="modal-form-control">
                                        <option value="">-- Pilih Pekerjaan --</option>
                                        <option value="Karyawan Swasta" selected>Karyawan Swasta</option>
                                        <option value="PNS">PNS</option>
                                        <option value="Wirausaha">Wirausaha</option>
                                        <option value="Profesional">Profesional</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Status -->
                                <div class="modal-form-group">
                                    <label><i class="mdi mdi-flag me-1 text-primary"></i>Status</label>
                                    <select class="modal-form-control">
                                        <option value="aktif" selected>Aktif</option>
                                        <option value="tidak_aktif">Tidak Aktif</option>
                                        <option value="pending">Pending</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Alamat -->
                        <div class="modal-form-group">
                            <label><i class="mdi mdi-home me-1 text-primary"></i>Alamat Lengkap</label>
                            <textarea class="modal-form-control" rows="2">Jl. Sudirman No. 123, Jakarta</textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">
                        <i class="mdi mdi-close me-1"></i>Batal
                    </button>
                    <button type="button" class="btn btn-gradient-primary">
                        <i class="mdi mdi-content-save me-1"></i>Update Data
                    </button>
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
                        Import Data Customer
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
                        Export Data Customer
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
                            <option value="semua">Semua Customer</option>
                            <option value="aktif">Customer Aktif</option>
                            <option value="pending">Customer Pending</option>
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
            // CEK TABEL DATA
            let hasData = $('#tableCustomer tbody tr').length > 0;

            if ($.fn.DataTable.isDataTable('#tableCustomer')) {
                $('#tableCustomer').DataTable().destroy();
            }

            if (hasData) {
                let table = $('#tableCustomer').DataTable({
                    responsive: true,
                    paging: false,
                    info: false,
                    searching: false,
                    lengthChange: false,
                    ordering: true,
                    language: {
                        emptyTable: "Data customer belum tersedia",
                        zeroRecords: "Data tidak ditemukan",
                    },
                    columnDefs: [{
                            targets: 0,
                            orderable: false
                        }, // Kolom No
                        {
                            targets: 5,
                            orderable: false
                        } // Kolom Aksi (index 5)
                    ]
                });
            }

            // DELETE CONFIRMATION
            window.confirmDelete = function() {
                if (confirm('Apakah Anda yakin ingin menghapus customer ini?')) {
                    alert('Customer berhasil dihapus (demo)');
                }
            };
        });
    </script>
@endpush
