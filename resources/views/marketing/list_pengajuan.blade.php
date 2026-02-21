@extends('layouts.partial.app')

@section('title', 'Dashboard Marketing - Properti Management')

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

        /* Circle icon dalam statistik */
        .bg-gradient-primary .rounded-circle,
        .bg-gradient-info .rounded-circle,
        .bg-gradient-success .rounded-circle,
        .bg-gradient-warning .rounded-circle,
        .bg-gradient-secondary .rounded-circle {
            background: rgba(255, 255, 255, 0.2) !important;
            backdrop-filter: blur(2px);
        }

        /* ===== FILTER SECTION - SAMA PERSIS DENGAN MARKETING JUAL UNIT ===== */
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

        /* Input group styling */
        .input-group-text {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border: 1px solid #e9ecef;
            border-right: none;
            border-radius: 8px 0 0 8px;
            color: #9a55ff;
        }

        .input-group .form-control {
            border-left: none;
            border-radius: 0 8px 8px 0;
        }

        .input-group .form-control:focus {
            border-left: none;
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

        /* Typography */
        h3.text-dark,
        h4.text-dark {
            font-size: 1.3rem !important;
            font-weight: 700;
            color: #2c2e3f !important;
            margin-bottom: 0.5rem !important;
        }

        @media (min-width: 576px) {

            h3.text-dark,
            h4.text-dark {
                font-size: 1.5rem !important;
            }
        }

        @media (min-width: 768px) {

            h3.text-dark,
            h4.text-dark {
                font-size: 1.7rem !important;
            }
        }

        /* Badge dengan icon */
        .badge i {
            font-size: 0.8rem;
            margin-right: 4px;
        }

        /* Hover effect untuk icon aksi */
        .btn:hover {
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

            h3.text-dark,
            h4.text-dark {
                font-size: 1.2rem !important;
            }

            .grid-margin {
                margin-bottom: 0.5rem;
            }
        }

        /* Gap utility */
        .gap-1 {
            gap: 0.25rem;
        }

        .gap-2 {
            gap: 0.5rem;
        }

        .gap-3 {
            gap: 1rem;
        }

        /* Font sizes */
        .fs-5 {
            font-size: 1.1rem;
        }

        .fs-6 {
            font-size: 0.95rem;
        }

        @media (min-width: 768px) {
            .fs-md-3 {
                font-size: 1.5rem;
            }

            .fs-md-4 {
                font-size: 1.3rem;
            }

            .fs-md-5 {
                font-size: 1.2rem;
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
    </style>

    <div class="container-fluid p-2 p-sm-3 p-md-4">
        <!-- Header Dashboard -->
        <div class="row mb-3 mb-sm-3 mb-md-4">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="text-dark mb-1">
                                <i class="mdi mdi-chart-line me-2" style="color: #9a55ff;"></i>
                                Dashboard Marketing
                            </h3>
                            <p class="text-muted mb-0">
                                <i class="mdi mdi-information-outline me-1"></i>
                                Monitoring semua pengajuan KPR dan Cash
                            </p>
                        </div>
                        <div class="d-none d-sm-block">
                            <span class="text-muted small">Senin, 16 Februari 2026</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row mt-3 mt-md-4 g-2 g-md-3">
            <div class="col-6 col-md-3 grid-margin stretch-card">
                <div class="card shadow-sm h-100">
                    <div class="card-body p-2 p-md-3">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-gradient rounded-circle p-2 p-md-3 me-2 me-md-3">
                                <i class="mdi mdi-file-document text-white"
                                    style="font-size: 1.2rem; font-size: clamp(1rem, 3vw, 1.5rem);"></i>
                            </div>
                            <div class="overflow-hidden">
                                <h3 class="mb-0 fs-5 fs-md-3">{{ $totalPengajuan }}</h3>
                                <small class="text-muted text-truncate d-block"
                                    style="font-size: clamp(0.7rem, 2vw, 0.85rem);">Total Pengajuan</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-md-6 col-lg-3 mb-2 mb-sm-2 mb-md-3">
                <div class="card bg-gradient-info card-img-holder text-white h-100">
                    <div class="card-body p-2 p-sm-2 p-md-3 d-flex align-items-center">
                        <div class="rounded-circle p-2 p-md-3 me-2 me-md-3" style="background: rgba(255,255,255,0.2);">
                            <i class="mdi mdi-bank" style="font-size: clamp(1rem, 3vw, 1.5rem);"></i>
                        </div>
                        <div>
                            <h2 class="mb-0 fs-5 fs-md-3">15</h2>
                            <small class="text-white opacity-75" style="font-size: clamp(0.7rem, 2vw, 0.85rem);">KPR
                                Diproses</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-md-6 col-lg-3 mb-2 mb-sm-2 mb-md-3">
                <div class="card bg-gradient-success card-img-holder text-white h-100">
                    <div class="card-body p-2 p-sm-2 p-md-3 d-flex align-items-center">
                        <div class="rounded-circle p-2 p-md-3 me-2 me-md-3" style="background: rgba(255,255,255,0.2);">
                            <i class="mdi mdi-cash" style="font-size: clamp(1rem, 3vw, 1.5rem);"></i>
                        </div>
                        <div>
                            <h2 class="mb-0 fs-5 fs-md-3">9</h2>
                            <small class="text-white opacity-75"
                                style="font-size: clamp(0.7rem, 2vw, 0.85rem);">Cash</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-md-6 col-lg-3 mb-2 mb-sm-2 mb-md-3">
                <div class="card bg-gradient-warning card-img-holder text-white h-100">
                    <div class="card-body p-2 p-sm-2 p-md-3 d-flex align-items-center">
                        <div class="rounded-circle p-2 p-md-3 me-2 me-md-3" style="background: rgba(255,255,255,0.2);">
                            <i class="mdi mdi-check-circle" style="font-size: clamp(1rem, 3vw, 1.5rem);"></i>
                        </div>
                        <div>
                            <h2 class="mb-0 fs-5 fs-md-3">12</h2>
                            <small class="text-white opacity-75" style="font-size: clamp(0.7rem, 2vw, 0.85rem);">Cair /
                                Lunas</small>
                        </div>
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
                        <!-- Filter Section - SAMA PERSIS DENGAN MARKETING JUAL UNIT -->
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
                                        <input type="text" class="form-control"
                                            placeholder="Cari customer, no booking, unit...">
                                    </div>

                                    <div class="row g-2">
                                        <div class="col-6">
                                            <label class="form-label">
                                                <i class="mdi mdi-chart-arc me-1"></i>Status
                                            </label>
                                            <select class="form-control">
                                                <option value="">Semua Status</option>
                                                <option>Draft</option>
                                                <option>Pengajuan</option>
                                                <option>Verifikasi</option>
                                                <option>Survey</option>
                                                <option>Akad</option>
                                                <option>Cair</option>
                                                <option>Lunas</option>
                                                <option>Ditolak</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">
                                                <i class="mdi mdi-cash-multiple me-1"></i>Metode
                                            </label>
                                            <select class="form-control">
                                                <option value="">Semua Metode</option>
                                                <option>KPR</option>
                                                <option>Cash</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row g-2 mt-2">
                                        <div class="col-6">
                                            <label class="form-label">
                                                <i class="mdi mdi-account-tie me-1"></i>Marketing
                                            </label>
                                            <select class="form-control">
                                                <option value="">Semua Marketing</option>
                                                <option>Ahmad Rizki</option>
                                                <option>Rina Wijaya</option>
                                                <option>Budi Hartono</option>
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

                                <!-- FILTER UNTUK TABLET & DESKTOP - SAMA PERSIS DENGAN MARKETING JUAL UNIT -->
                                <div class="d-none d-md-block">
                                    <div class="row g-2 align-items-end">
                                        <div class="col-md-4">
                                            <label class="form-label">
                                                <i class="mdi mdi-magnify me-1"></i>Pencarian
                                            </label>
                                            <input type="text" class="form-control"
                                                placeholder="Cari customer, no booking, unit...">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">
                                                <i class="mdi mdi-chart-arc me-1"></i>Status
                                            </label>
                                            <select class="form-control">
                                                <option value="">Semua Status</option>
                                                <option>Draft</option>
                                                <option>Pengajuan</option>
                                                <option>Verifikasi</option>
                                                <option>Survey</option>
                                                <option>Akad</option>
                                                <option>Cair</option>
                                                <option>Lunas</option>
                                                <option>Ditolak</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">
                                                <i class="mdi mdi-cash-multiple me-1"></i>Metode
                                            </label>
                                            <select class="form-control">
                                                <option value="">Semua Metode</option>
                                                <option>KPR</option>
                                                <option>Cash</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">
                                                <i class="mdi mdi-account-tie me-1"></i>Marketing
                                            </label>
                                            <select class="form-control">
                                                <option value="">Semua Marketing</option>
                                                <option>Ahmad Rizki</option>
                                                <option>Rina Wijaya</option>
                                                <option>Budi Hartono</option>
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

                        <!-- Tabel -->
                        <div class="table-responsive">
                            <table class="table table-hover" id="tableMarketing" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center"><i class="mdi mdi-counter me-1"></i>No</th>
                                        <th><i class="mdi mdi-ticket me-1"></i>Booking ID</th>
                                        <th><i class="mdi mdi-account me-1"></i>Customer</th>
                                        <th><i class="mdi mdi-home me-1"></i>Unit</th>
                                        <th><i class="mdi mdi-cash-multiple me-1"></i>Metode</th>
                                        <th><i class="mdi mdi-chart-arc me-1"></i>Status</th>
                                        <th><i class="mdi mdi-progress-clock me-1"></i>Progress</th>
                                        <th><i class="mdi mdi-account-tie me-1"></i>Marketing</th>
                                        <th class="text-center"><i class="mdi mdi-cog me-1"></i>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bookings as $booking)
                                        <tr>
                                            <td class="text-center fw-bold">{{ $loop->iteration }}</td>

                                            <td>
                                                <span class="fw-medium small">
                                                    {{ $booking->booking_code }}
                                                </span>
                                            </td>

                                            <td class="small">
                                                {{ $booking->customer->full_name ?? '-' }}
                                            </td>

                                            <td class="small">
                                                {{ $booking->unit->block ?? '' }}
                                                {{ $booking->unit->unit_number ?? '' }}
                                            </td>

                                            <td>
                                                @if ($booking->purchase_type == 'kpr')
                                                    <span class="badge badge-info badge-sm">KPR</span>
                                                @else
                                                    <span class="badge badge-success badge-sm">Cash</span>
                                                @endif
                                            </td>

                                            <td>
                                                @switch($booking->status)
                                                    @case('active')
                                                        <span class="badge badge-warning badge-sm">Active</span>
                                                    @break

                                                    @case('akad')
                                                        <span class="badge badge-primary badge-sm">Akad</span>
                                                    @break

                                                    @case('lunas')
                                                        <span class="badge badge-success badge-sm">Lunas</span>
                                                    @break

                                                    @case('ditolak')
                                                        <span class="badge badge-danger badge-sm">Ditolak</span>
                                                    @break

                                                    @default
                                                        <span class="badge badge-secondary badge-sm">
                                                            {{ ucfirst($booking->status) }}
                                                        </span>
                                                @endswitch
                                            </td>

                                            <td>
                                                @php
                                                    $progress = match ($booking->status) {
                                                        'active' => 25,
                                                        'survey' => 40,
                                                        'akad' => 80,
                                                        'lunas' => 100,
                                                        default => 10,
                                                    };
                                                @endphp

                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="progress w-100" style="height: 6px;">
                                                        <div class="progress-bar" style="width: {{ $progress }}%">
                                                        </div>
                                                    </div>
                                                    <span class="small">{{ $progress }}%</span>
                                                </div>
                                            </td>

                                            <td class="small">
                                                {{ $booking->sales->name ?? '-' }}
                                            </td>

                                            <td class="text-center">
                                                @if ($booking->purchase_type == 'kpr')
                                                    <a href="{{ route('pengajuan.show', $booking->id) }}"
                                                        class="btn btn-xs btn-gradient-primary" title="Proses KPR">
                                                        <i class="mdi mdi-bank"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ route('cash.show', $booking->id) }}"
                                                        class="btn btn-xs btn-gradient-success" title="Proses Cash">
                                                        <i class="mdi mdi-cash"></i>
                                                    </a>
                                                @endif
                                                <div class="d-flex justify-content-center gap-1">
                                                    <a href="#" class="btn btn-xs btn-gradient-info"
                                                        title="Detail">
                                                        <i class="mdi mdi-eye"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-xs btn-gradient-warning"
                                                        title="Edit">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </a>
                                                    <form action="#" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-xs btn-gradient-danger"
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

                        <!-- Pagination UI - DIPERKECIL -->
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-3">
                            <div class="pagination-info mb-2 mb-sm-0">
                                <i class="mdi mdi-information-outline me-1"></i>
                                Menampilkan 1 - 7 dari 24 data
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
                            <a href="{{ route('dashboard') }}" class="btn btn-gradient-secondary">
                                <i class="mdi mdi-arrow-left me-1"></i>Kembali ke Dashboard
                            </a>
                        </div>
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
            let table = $('#tableMarketing').DataTable({
                responsive: true,
                paging: false,
                info: false,
                searching: false,
                lengthChange: false,
                ordering: true,
                language: {
                    emptyTable: "Data pengajuan belum tersedia",
                    zeroRecords: "Data tidak ditemukan",
                },
                columnDefs: [{
                    orderable: false,
                    targets: [8]
                }]
            });
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
@endpush
