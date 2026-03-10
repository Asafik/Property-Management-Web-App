@extends('layouts.partial.app')

@section('title', 'Semua Pra Tanah - Property Management App')

@section('content')
    <style>
        /* ===== MODERN STYLING UNTUK HALAMAN SEMUA PRA TANAH ===== */

        /* ===== CARD STYLING - PAKAI BAWAAN BOOTSTRAP ===== */
        .card {
            transition: all 0.3s ease;
            margin-bottom: 1rem;
        }

        .card:hover {
            box-shadow: 0 8px 25px rgba(154, 85, 255, 0.1) !important;
        }

        .card-header {
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

        /* Gradient Buttons */
        .btn-gradient-secondary {
            background: #6c757d !important;
            color: #ffffff !important;
        }

        .btn-gradient-secondary:hover {
            background: #5a6268 !important;
        }

        .btn-gradient-primary {
            background: linear-gradient(to right, #da8cff, #9a55ff) !important;
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

        .btn-gradient-success {
            background: linear-gradient(135deg, #28a745, #5cb85c) !important;
            color: #ffffff !important;
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

        /* Pagination info */
        .pagination-info {
            font-size: 0.8rem;
            color: #6c7383;
        }

        /* ===== ACTION BUTTONS DENGAN TEXT ===== */
        .action-text {
            display: inline-block;
            padding: 0.35rem 0.7rem;
            font-size: 0.8rem;
            font-weight: 600;
            border-radius: 6px;
            text-decoration: none;
            white-space: nowrap;
        }

        .action-text-primary {
            background: linear-gradient(135deg, #9a55ff, #da8cff);
            color: white;
        }

        .action-text-primary:hover {
            background: linear-gradient(135deg, #8a45e6, #c77cff);
            color: white;
            text-decoration: none;
        }

        .action-text-success {
            background: linear-gradient(135deg, #28a745, #5cb85c);
            color: white;
        }

        .action-text-warning {
            background: linear-gradient(135deg, #ffc107, #ffdb6d);
            color: #2c2e3f;
        }

        .action-text-danger {
            background: linear-gradient(135deg, #dc3545, #e4606d);
            color: white;
        }

        .action-text-info {
            background: linear-gradient(135deg, #17a2b8, #5bc0de);
            color: white;
        }

        .action-text-secondary {
            background: #6c757d;
            color: white;
        }

        /* DataTables Custom Styling */
        .dataTables_filter,
        .dataTables_length,
        .dataTables_paginate,
        .dataTables_info {
            display: none !important;
        }

        /* ===== SELECT2 CUSTOM STYLING AGAR SESUAI DENGAN FORM ===== */
        .select2-container--bootstrap-5 .select2-selection {
            border: 1px solid #e9ecef !important;
            border-radius: 8px !important;
            padding: 0.5rem 0.8rem !important;
            min-height: 40px !important;
            font-family: 'Nunito', sans-serif !important;
            background-color: #ffffff !important;
        }

        .select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
            color: #2c2e3f !important;
            font-size: 0.9rem !important;
            line-height: 1.5 !important;
            padding-left: 0 !important;
        }

        .select2-container--bootstrap-5 .select2-selection--single .select2-selection__arrow {
            height: 38px !important;
            right: 10px !important;
        }

        .select2-container--bootstrap-5 .select2-selection--single .select2-selection__arrow b {
            border-color: #9a55ff transparent transparent transparent !important;
        }

        .select2-container--bootstrap-5 .select2-selection:hover {
            border-color: #9a55ff !important;
        }

        .select2-container--bootstrap-5.select2-container--focus .select2-selection,
        .select2-container--bootstrap-5.select2-container--open .select2-selection {
            border-color: #9a55ff !important;
            box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.1) !important;
            outline: none !important;
        }

        .select2-container--bootstrap-5 .select2-dropdown {
            border-color: #e9ecef !important;
            border-radius: 8px !important;
            overflow: hidden !important;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important;
        }

        .select2-container--bootstrap-5 .select2-results__option {
            padding: 0.6rem 0.8rem !important;
            font-size: 0.9rem !important;
            font-family: 'Nunito', sans-serif !important;
        }

        .select2-container--bootstrap-5 .select2-results__option--selected {
            background-color: #9a55ff !important;
            color: white !important;
        }

        .select2-container--bootstrap-5 .select2-results__option--highlighted {
            background: linear-gradient(135deg, #da8cff, #9a55ff) !important;
            color: white !important;
        }

        .select2-container--bootstrap-5 .select2-search--dropdown .select2-search__field {
            border: 1px solid #e9ecef !important;
            border-radius: 8px !important;
            padding: 0.5rem !important;
            font-family: 'Nunito', sans-serif !important;
            margin: 0.5rem !important;
            width: calc(100% - 1rem) !important;
        }

        .select2-container--bootstrap-5 .select2-search--dropdown .select2-search__field:focus {
            border-color: #9a55ff !important;
            box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.1) !important;
            outline: none !important;
        }

        .select2-container--bootstrap-5 .select2-selection--single .select2-selection__placeholder {
            color: #a5b3cb !important;
        }

        /* Paksa hanya 5 item yang tampil di Select2 */
        .select2-limited-items .select2-results__options {
            max-height: 200px !important;
            overflow-y: auto !important;
        }

        /* Styling scrollbar */
        .select2-limited-items .select2-results__options::-webkit-scrollbar {
            width: 6px;
        }

        .select2-limited-items .select2-results__options::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .select2-limited-items .select2-results__options::-webkit-scrollbar-thumb {
            background: #9a55ff;
            border-radius: 10px;
        }

        .select2-limited-items .select2-results__options::-webkit-scrollbar-thumb:hover {
            background: #7a3fcc;
        }

        /* Status indicator */
        .status-indicator {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-right: 5px;
        }

        .status-indicator.success {
            background: #28a745;
            box-shadow: 0 0 0 2px rgba(40, 167, 69, 0.2);
        }

        .status-indicator.warning {
            background: #ffc107;
            box-shadow: 0 0 0 2px rgba(255, 193, 7, 0.2);
        }

        .status-indicator.danger {
            background: #dc3545;
            box-shadow: 0 0 0 2px rgba(220, 53, 69, 0.2);
        }

        .status-indicator.primary {
            background: #9a55ff;
            box-shadow: 0 0 0 2px rgba(154, 85, 255, 0.2);
        }

        .status-indicator.secondary {
            background: #6c757d;
            box-shadow: 0 0 0 2px rgba(108, 117, 125, 0.2);
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

            h4.text-dark {
                font-size: 1.2rem !important;
            }
        }

        /* Icon styling */
        .mdi {
            vertical-align: middle;
        }

        /* Styling untuk button filter dan reset */
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
    </style>


    <div class="container-fluid p-2 p-sm-3 p-md-4">
        <!-- Header Card -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-1 fw-bold text-dark">
                                <i class="mdi mdi-hand-holding me-2" style="color: #9a55ff;"></i>
                                Semua Pra Tanah / Pra Landbank
                            </h4>
                            <p class="mb-0 text-muted small">
                                <i class="mdi mdi-information-outline me-1"></i>
                                Daftar seluruh tanah dalam tahap pra-pelepasan (penawaran/negosiasi)
                            </p>
                        </div>
                        <div class="d-none d-sm-block">
                            <i class="mdi mdi-hand-holding" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel -->
        <div class="row mt-2 mt-sm-2 mt-md-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-white">
                        <h4 class="card-title">
                            <i class="mdi mdi-format-list-bulleted me-2"></i>
                            Daftar Semua Pra Tanah
                        </h4>
                    </div>
                    <div class="card-body">
                        <!-- Filter Section -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="filter-card">
                                    <div class="card-body">
                                        <h6 class="card-title mb-3" style="font-size: 1rem;">
                                            <i class="mdi mdi-filter-outline me-1"></i>Filter Data
                                        </h6>

                                        <!-- FILTER UNTUK MOBILE -->
                                        <div class="d-block d-md-none">
                                            <!-- Baris 1: Pencarian -->
                                            <div class="row filter-row">
                                                <div class="col-12">
                                                    <label class="form-label">
                                                        <i class="mdi mdi-magnify me-1"></i>Pencarian
                                                    </label>
                                                    <input type="text" id="searchInputMobile" class="form-control"
                                                        placeholder="Cari nama tanah atau lokasi...">
                                                </div>
                                            </div>

                                            <!-- BARIS FILTER STATUS NEGOSIASI (MOBILE) -->
                                            <div class="row filter-row">
                                                <div class="col-12">
                                                    <label class="form-label">
                                                        <i class="mdi mdi-handshake me-1"></i>Status Negosiasi
                                                    </label>
                                                    <select name="negotiation_status" id="filterNegosiasiMobile" class="form-control select2-mobile">
                                                        <option value="">Semua Status</option>
                                                        <option value="negotiation">Masih Negosiasi</option>
                                                        <option value="almost_deal">Hampir Deal</option>
                                                        <option value="deal">Sudah Deal</option>
                                                        <option value="cancel">Batal</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Baris 2: Status Tanah & Survey -->
                                            <div class="row filter-row">
                                                <div class="col-6">
                                                    <label class="form-label">
                                                        <i class="mdi mdi-clipboard-check me-1"></i>Status Tanah
                                                    </label>
                                                    <select name="land_status" id="filterStatusTanahMobile" class="form-control">
                                                        <option value="">Semua</option>
                                                        <option value="clear">Clear & Clean</option>
                                                        <option value="checking">Dalam Pengecekan</option>
                                                        <option value="problem">Bermasalah</option>
                                                    </select>
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label">
                                                        <i class="mdi mdi-search-web me-1"></i>Survey
                                                    </label>
                                                    <select name="survey_result" id="filterSurveyMobile" class="form-control">
                                                        <option value="">Semua</option>
                                                        <option value="belum">Belum Survey</option>
                                                        <option value="sesuai">Sudah Survey</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Baris 3: Tampil -->
                                            <div class="row filter-row">
                                                <div class="col-6">
                                                    <label class="form-label">
                                                        <i class="mdi mdi-counter me-1"></i>Tampil
                                                    </label>
                                                    <select name="show" id="showDataMobile" class="form-control">
                                                        <option value="10">10</option>
                                                        <option value="25">25</option>
                                                        <option value="50">50</option>
                                                        <option value="100">100</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Baris 4: Button Filter & Reset -->
                                            <div class="row filter-row">
                                                <div class="col-6">
                                                    <button type="button" id="filterDataMobile"
                                                        class="btn btn-gradient-primary btn-filter-reset">
                                                        <i class="mdi mdi-filter-outline"></i> Filter
                                                    </button>
                                                </div>
                                                <div class="col-6">
                                                    <button type="button" id="resetFilterMobile"
                                                        class="btn btn-gradient-secondary btn-filter-reset">
                                                        <i class="mdi mdi-refresh"></i> Reset
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- FILTER UNTUK TABLET & DESKTOP -->
                                        <div class="d-none d-md-block">
                                            <form method="GET" action="#" id="filterForm">
                                                <div class="row g-2 align-items-end filter-row">

                                                    <!-- Search -->
                                                    <div class="col-md-3">
                                                        <label class="form-label">
                                                            <i class="mdi mdi-magnify me-1"></i>Pencarian
                                                        </label>
                                                        <input type="text" name="search" class="form-control"
                                                            placeholder="Cari nama tanah atau lokasi...">
                                                    </div>

                                                    <!-- FILTER STATUS NEGOSIASI -->
                                                    <div class="col-md-2">
                                                        <label class="form-label">
                                                            <i class="mdi mdi-handshake me-1"></i>Status Negosiasi
                                                        </label>
                                                        <select name="negotiation_status" id="filterCompany" class="form-control select2-desktop">
                                                            <option value="">Semua Status</option>
                                                            <option value="negotiation">Masih Negosiasi</option>
                                                            <option value="almost_deal">Hampir Deal</option>
                                                            <option value="deal">Sudah Deal</option>
                                                            <option value="cancel">Batal</option>
                                                        </select>
                                                    </div>

                                                    <!-- Status Tanah -->
                                                    <div class="col-md-2">
                                                        <label class="form-label">
                                                            <i class="mdi mdi-clipboard-check me-1"></i>Status Tanah
                                                        </label>
                                                        <select name="land_status" class="form-control">
                                                            <option value="">Semua</option>
                                                            <option value="clear">Clear & Clean</option>
                                                            <option value="checking">Dalam Pengecekan</option>
                                                            <option value="problem">Bermasalah</option>
                                                        </select>
                                                    </div>

                                                    <!-- Survey -->
                                                    <div class="col-md-2">
                                                        <label class="form-label">
                                                            <i class="mdi mdi-search-web me-1"></i>Survey
                                                        </label>
                                                        <select name="survey_result" class="form-control">
                                                            <option value="">Semua</option>
                                                            <option value="belum">Belum Survey</option>
                                                            <option value="sesuai">Sudah Survey</option>
                                                        </select>
                                                    </div>

                                                    <!-- Show -->
                                                    <div class="col-md-1">
                                                        <label class="form-label">
                                                            <i class="mdi mdi-counter me-1"></i>Tampil
                                                        </label>
                                                        <select name="show" class="form-control">
                                                            <option value="10">10</option>
                                                            <option value="25">25</option>
                                                            <option value="50">50</option>
                                                            <option value="100">100</option>
                                                        </select>
                                                    </div>

                                                    <!-- Filter Button -->
                                                    <div class="col-md-1">
                                                        <button type="button" onclick="alert('Filter demo UI')" class="btn btn-gradient-primary w-100">
                                                            <i class="mdi mdi-filter-outline"></i>
                                                        </button>
                                                    </div>

                                                    <!-- Reset Button -->
                                                    <div class="col-md-1">
                                                        <a href="#" onclick="window.location.reload()" class="btn btn-gradient-secondary w-100">
                                                            <i class="mdi mdi-refresh"></i>
                                                        </a>
                                                    </div>

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tabel Data DENGAN ICON DI SEMUA KOLOM -->
                        <div class="table-responsive">
                            <table id="tablePraTanah" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center"><i class="mdi mdi-counter"></i> NO</th>
                                        <th><i class="mdi mdi-home-variant"></i> NAMA TANAH</th>
                                        <th><i class="mdi mdi-account-tie"></i> MAKELAR</th>
                                        <th><i class="mdi mdi-map-marker"></i> LOKASI</th>
                                        <th><i class="mdi mdi-currency-usd"></i> NEGOSIASI</th>
                                        <th><i class="mdi mdi-handshake"></i> STATUS NEGO</th>
                                        <th><i class="mdi mdi-clipboard-check"></i> STATUS TANAH</th>
                                        <th><i class="mdi mdi-search-web"></i> SURVEY</th>
                                        <th class="text-center"><i class="mdi mdi-cog"></i> AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data 1 -->
                                    <tr>
                                        <td class="text-center fw-bold">
                                            <span class="badge bg-light text-dark">1</span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-home-variant text-primary me-2"></i>
                                                <span class="fw-bold">Tanah Griya Asri</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-account-tie text-info me-2"></i>
                                                <span>Bpk. Ahmad (Makelar Properti)</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-map-marker text-danger me-2"></i>
                                                <span>Jl. Mawar No. 123, Jember</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-currency-usd text-success me-2"></i>
                                                <span class="fw-bold">Rp 1,8 M</span>
                                            </div>
                                            <small class="text-muted">Dari Rp 2 M</small>
                                        </td>
                                        <td>
                                            <span class="badge badge-gradient-warning"><i class="mdi mdi-clock-outline me-1"></i>Masih Negosiasi</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-gradient-warning"><i class="mdi mdi-alert me-1"></i>Dalam Pengecekan</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-gradient-danger"><i class="mdi mdi-close-circle me-1"></i>Belum Survey</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-1">
                                                <a href="#" class="btn btn-gradient-info btn-sm" title="Lihat Detail">
                                                    <i class="mdi mdi-eye"></i>
                                                </a>
                                                <a href="#" class="btn btn-gradient-warning btn-sm" title="Edit">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-3">
                            <div class="pagination-info mb-2 mb-sm-0">
                                <i class="mdi mdi-information-outline me-1"></i>
                                Menampilkan 1 - 6 dari 6 data
                            </div>
                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0" style="gap: 2px;">
                                    <li class="page-item disabled">
                                        <span class="page-link" aria-label="Previous">
                                            <i class="mdi mdi-chevron-left"></i>
                                        </span>
                                    </li>
                                    <li class="page-item active">
                                        <a class="page-link" href="#">1</a>
                                    </li>
                                    <li class="page-item disabled">
                                        <span class="page-link" aria-label="Next">
                                            <i class="mdi mdi-chevron-right"></i>
                                        </span>
                                    </li>
                                </ul>
                            </nav>
                        </div>

                        <!-- Tombol Tambah Data -->
                        <div class="mt-3 text-end">
                            <a href="#" class="btn btn-gradient-primary">
                                <i class="mdi mdi-plus me-1"></i>Tambah Pra Tanah
                            </a>
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

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // ===========================================
            // 1. SELECT2 UNTUK FILTER
            // ===========================================
            $('.select2-desktop').select2({
                theme: 'bootstrap-5',
                width: '100%',
                placeholder: 'Semua Status',
                allowClear: true,
                minimumResultsForSearch: 0,
                dropdownCssClass: 'select2-limited-items',
                language: {
                    noResults: function() {
                        return "Data tidak ditemukan";
                    },
                    searching: function() {
                        return "Mencari...";
                    }
                }
            });

            $('.select2-mobile').select2({
                theme: 'bootstrap-5',
                width: '100%',
                placeholder: 'Semua Status',
                allowClear: true,
                minimumResultsForSearch: 0,
                dropdownCssClass: 'select2-limited-items',
                dropdownParent: $('.select2-mobile').parent(),
                language: {
                    noResults: function() {
                        return "Data tidak ditemukan";
                    },
                    searching: function() {
                        return "Mencari...";
                    }
                }
            });

            // ===========================================
            // 2. FILTER MOBILE (demo)
            // ===========================================
            $('#filterDataMobile').on('click', function() {
                alert('Filter akan diterapkan (demo UI)');
            });

            $('#resetFilterMobile').on('click', function() {
                window.location.reload();
            });

            // ===========================================
            // 3. DATATABLES (optional - untuk sorting)
            // ===========================================
            $('#tablePraTanah').DataTable({
                paging: false,
                info: false,
                searching: false,
                lengthChange: false,
                ordering: true,
                language: {
                    emptyTable: "Tidak ada data tersedia",
                    zeroRecords: "Data tidak ditemukan",
                },
                columnDefs: [
                    { orderable: false, targets: [0] }, // Kolom No
                    { orderable: false, targets: [8] }  // Kolom Aksi
                ]
            });
        });
    </script>
@endpush
