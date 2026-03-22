@extends('layouts.partial.app')

@section('title', 'Dashboard - Property Management App')

@section('content')


    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Select2 Bootstrap5 Theme -->
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css"
        rel="stylesheet" />

    <style>
        /* ====== CSS ====== */
        .card {
            transition: all 0.3s ease;
            margin-bottom: 1rem;
            border: none !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
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
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
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

        /* ===== SELECT2 CUSTOM STYLING ===== */
        .select2-container--bootstrap-5 .select2-selection {
            border: 1px solid #e9ecef !important;
            border-radius: 10px !important;
            padding: 0.5rem 0.8rem !important;
            min-height: 42px !important;
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
            height: 40px !important;
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
            border-radius: 10px !important;
            overflow: hidden !important;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1) !important;
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

        /* Tombol eye dengan warna purple */
        .btn-outline-purple {
            background: transparent;
            border: 2px solid #9a55ff !important;
            color: #9a55ff;
            padding: 0.35rem 0.9rem;
            font-size: 0.8rem;
            border-radius: 20px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
        }

        .btn-outline-purple:hover {
            background: #9a55ff;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(154, 85, 255, 0.3);
        }

        .btn-outline-purple i {
            font-size: 1rem;
        }

        .btn-icon-only {
            width: 40px;
            height: 40px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
        }

        .btn-icon-only i {
            font-size: 1.2rem;
            margin: 0;
        }

        .btn-icon-only-mobile {
            width: 100%;
            height: 40px;
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

        /* Status badge gradient */
        .status-badge-gradient {
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
            display: inline-block;
        }

        .status-badge-gradient.success {
            background: linear-gradient(135deg, #28a745, #5cb85c);
            color: #fff;
        }

        .status-badge-gradient.danger {
            background: linear-gradient(135deg, #dc3545, #e4606d);
            color: #fff;
        }

        .status-badge-gradient.warning {
            background: linear-gradient(135deg, #ffc107, #ffdb6d);
            color: #2c2e3f;
        }

        .status-badge-gradient i {
            margin-right: 4px;
            font-size: 0.9rem;
        }

        /* Type badge - 1 warna saja untuk semua */
        .type-badge {
            background: linear-gradient(135deg, #9a55ff, #da8cff);
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
            display: inline-block;
        }

        .type-badge i {
            margin-right: 4px;
            font-size: 0.9rem;
        }

        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            border-radius: 8px;
            margin-bottom: 0.5rem;
            scrollbar-width: thin;
            scrollbar-color: #9a55ff #f0f0f0;
        }

        .table-responsive::-webkit-scrollbar {
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
            background: #7b3fcc;
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
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .table thead th:hover {
            color: #7a3fcc;
        }

        .table thead th i {
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
            padding-left: 0.5rem;
            width: 40px;
            text-align: center;
            cursor: default;
        }

        .table thead th:first-child:hover {
            color: #9a55ff;
        }

        .table tbody td:first-child {
            padding-left: 0.5rem;
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

        .text-price {
            color: #28a745 !important;
            font-weight: 600;
        }

        /* CSS Truncation untuk Lokasi */
        .location-wrapper {
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .location-text {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* Responsive truncation */
        @media (max-width: 1200px) {
            .location-wrapper {
                max-width: 180px;
            }
        }

        @media (max-width: 992px) {
            .location-wrapper {
                max-width: 150px;
            }
        }

        @media (max-width: 768px) {
            .location-wrapper {
                max-width: 120px;
            }
        }

        @media (max-width: 576px) {
            .location-wrapper {
                max-width: 100px;
            }
        }

        /* Unit badge */
        .unit-badge {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            color: #1976d2;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
            display: inline-block;
        }

        .table tbody td i {
            font-size: 1rem;
        }

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

        .dataTables_filter,
        .dataTables_length,
        .dataTables_paginate,
        .dataTables_info {
            display: none !important;
        }

        .mdi {
            vertical-align: middle;
        }

        /* PAGINATION - UKURAN NORMAL */
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
            cursor: pointer;
            text-decoration: none;
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

        .page-item.disabled .page-link {
            background-color: #f8f9fa;
            color: #a5b3cb;
            pointer-events: none;
            cursor: not-allowed;
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

        .filter-row-desktop {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-end;
            gap: 0.5rem;
        }

        .filter-row-mobile {
            display: none;
        }

        @media (max-width: 767px) {
            .filter-row-desktop {
                display: none;
            }

            .filter-row-mobile {
                display: block;
                margin-top: 1rem;
            }
        }

        /* Sort icons */
        .sort-icon {
            font-size: 0.8rem;
            margin-left: 4px;
            opacity: 0.3;
            transition: all 0.2s ease;
        }

        th:hover .sort-icon {
            opacity: 0.6;
        }

        th.active-sort .sort-icon {
            opacity: 1;
            color: #7a3fcc;
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
                                <i class="mdi mdi-view-dashboard me-2" style="color: #9a55ff;"></i>Dashboard
                            </h3>
                            <p class="text-muted mb-0">
                                Selamat datang di Dashboard Property Management
                            </p>
                        </div>
                        <div class="d-none d-sm-block">
                            <i class="mdi mdi-view-dashboard" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistic Cards - Data dari controller -->
        <div class="row g-3 mb-4">
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-icon proyek"><i class="mdi mdi-city"></i></div>
                    <div class="stat-content">
                        <h3>{{ $totalProperty }}</h3>
                        <p>Total Proyek</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-icon unit"><i class="mdi mdi-home-city"></i></div>
                    <div class="stat-content">
                        <h3>{{ $totalUnit }}</h3>
                        <p>Total Unit</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-icon transaksi"><i class="mdi mdi-swap-horizontal"></i></div>
                    <div class="stat-content">
                        <h3>{{ $totalPayments }}</h3>
                        <p>Total Transaksi</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-icon pendapatan"><i class="mdi mdi-cash-multiple"></i></div>
                    <div class="stat-content">
                        <h3>Rp 0</h3>
                        <p>Pendapatan</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Data Proyek -->
        <div class="row mt-2 mt-sm-2 mt-md-3">
            <div class="col-12">
                <div class="card">
                    <div
                        class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2">
                        <h5 class="card-title mb-0">
                            Daftar Proyek / Tanah Induk
                        </h5>
                    </div>

                    <div class="card-body">
                        <!-- FILTER SECTION -->
                        <div class="filter-card mb-4">
                            <div class="card-body">

                                <!-- DESKTOP VERSION -->
                                <div class="filter-row-desktop">
                                    <div class="row g-2 align-items-end w-100">

                                        <!-- Search -->
                                        <div class="col-md-3">
                                            <label class="form-label">Cari</label>
                                            <input type="text" class="form-control" id="searchInput"
                                                placeholder="Nama proyek..." value="{{ request('search') }}">
                                        </div>

                                        <!-- Perusahaan - SELECT2 -->
                                        <div class="col-md-3">
                                            <label class="form-label">Perusahaan</label>
                                            <select class="form-control select2" id="perusahaanSelect" style="width: 100%;">
                                                <option value="">Semua Perusahaan</option>
                                                @foreach ($filterOptions['perusahaan'] ?? [] as $company)
                                                    <option value="{{ $company }}"
                                                        {{ request('perusahaan') == $company ? 'selected' : '' }}>
                                                        {{ $company }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Type -->
                                        <div class="col-md-2">
                                            <label class="form-label">Type</label>
                                            <select class="form-control" id="typeSelect">
                                                <option value="">Semua Type</option>
                                                @foreach ($filterOptions['types'] ?? [] as $type)
                                                    <option value="{{ $type }}"
                                                        {{ request('type') == $type ? 'selected' : '' }}>{{ $type }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Status -->
                                        <div class="col-md-1">
                                            <label class="form-label">Status</label>
                                            <select class="form-control" id="statusSelect">
                                                <option value="">Semua</option>
                                                <option value="ready"
                                                    {{ request('status') == 'ready' ? 'selected' : '' }}>Tersedia</option>
                                                <option value="sold" {{ request('status') == 'sold' ? 'selected' : '' }}>
                                                    Terjual</option>
                                                <option value="pending"
                                                    {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                            </select>
                                        </div>

                                        <!-- Tampil -->
                                        <div class="col-md-1">
                                            <label class="form-label">Tampil</label>
                                            <select class="form-control" id="perPageSelect">
                                                <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10
                                                </option>
                                                <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25
                                                </option>
                                                <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50
                                                </option>
                                                <option value="100" {{ request('perPage') == 100 ? 'selected' : '' }}>
                                                    100</option>
                                            </select>
                                        </div>

                                        <!-- Tombol Filter + Reset dalam 1 kolom -->
                                        <div class="col-md-2">
                                            <label class="form-label invisible d-none d-md-block">Aksi</label>
                                            <div class="d-flex gap-2">
                                                <button type="button"
                                                    class="btn btn-gradient-primary btn-icon-only flex-fill" id="filterBtn"
                                                    title="Filter">
                                                    <i class="mdi mdi-filter"></i>
                                                </button>
                                                <button type="button"
                                                    class="btn btn-gradient-secondary btn-icon-only flex-fill"
                                                    id="refreshBTN" title="Reset">
                                                    <i class="mdi mdi-refresh"></i>
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <!-- MOBILE VERSION -->
                                <div class="filter-row-mobile">
                                    <div class="row g-2">
                                        <div class="col-12 mb-2">
                                            <label class="form-label">Cari</label>
                                            <input type="text" class="form-control" id="searchInputMobile"
                                                placeholder="Nama proyek..." value="{{ request('search') }}">
                                        </div>
                                        <div class="col-12 mb-2">
                                            <label class="form-label">Perusahaan</label>
                                            <select class="form-control select2-mobile" id="perusahaanSelectMobile"
                                                style="width: 100%;">
                                                <option value="">Semua Perusahaan</option>
                                                @foreach ($filterOptions['perusahaan'] ?? [] as $company)
                                                    <option value="{{ $company }}"
                                                        {{ request('perusahaan') == $company ? 'selected' : '' }}>
                                                        {{ $company }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <label class="form-label">Type</label>
                                            <select class="form-control" id="typeSelectMobile">
                                                <option value="">Semua Type</option>
                                                @foreach ($filterOptions['types'] ?? [] as $type)
                                                    <option value="{{ $type }}"
                                                        {{ request('type') == $type ? 'selected' : '' }}>
                                                        {{ $type }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <label class="form-label">Status</label>
                                            <select class="form-control" id="statusSelectMobile">
                                                <option value="">Semua</option>
                                                <option value="ready"
                                                    {{ request('status') == 'ready' ? 'selected' : '' }}>Tersedia</option>
                                                <option value="sold"
                                                    {{ request('status') == 'sold' ? 'selected' : '' }}>Terjual</option>
                                                <option value="pending"
                                                    {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                            </select>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <label class="form-label">Tampil</label>
                                            <select class="form-control" id="perPageSelectMobile">
                                                <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10
                                                </option>
                                                <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25
                                                </option>
                                                <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50
                                                </option>
                                                <option value="100" {{ request('perPage') == 100 ? 'selected' : '' }}>
                                                    100</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <button type="button"
                                                class="btn btn-gradient-primary btn-icon-only-mobile w-100"
                                                id="filterBtnMobile" title="Filter">
                                                <i class="mdi mdi-filter"></i>
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <button type="button"
                                                class="btn btn-gradient-secondary btn-icon-only-mobile w-100"
                                                id="resetBtnMobile" title="Reset">
                                                <i class="mdi mdi-refresh"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- TABEL DATA DENGAN DATA DARI DATABASE -->
                        <div class="table-responsive">
                            <table class="table table-hover align-middle" id="proyekTable">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="sortable" data-field="name"
                                            data-direction="{{ request('sortField') == 'name' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                            Proyek / Tanah Induk
                                            @if (request('sortField') == 'name')
                                                <i
                                                    class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }} sort-icon"></i>
                                            @else
                                                <i class="mdi mdi-swap-vertical sort-icon"></i>
                                            @endif
                                        </th>
                                        <th>Nama Perusahaan</th>
                                        <th class="sortable" data-field="zoning"
                                            data-direction="{{ request('sortField') == 'zoning' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                            Type
                                            @if (request('sortField') == 'zoning')
                                                <i
                                                    class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }} sort-icon"></i>
                                            @else
                                                <i class="mdi mdi-swap-vertical sort-icon"></i>
                                            @endif
                                        </th>
                                        <th>Lokasi</th>
                                        <th class="sortable" data-field="legal_status"
                                            data-direction="{{ request('sortField') == 'legal_status' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                            Status Legal
                                            @if (request('sortField') == 'legal_status')
                                                <i
                                                    class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }} sort-icon"></i>
                                            @else
                                                <i class="mdi mdi-swap-vertical sort-icon"></i>
                                            @endif
                                        </th>
                                        <th class="sortable" data-field="acquisition_price"
                                            data-direction="{{ request('sortField') == 'acquisition_price' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                            Harga Diperoleh
                                            @if (request('sortField') == 'acquisition_price')
                                                <i
                                                    class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }} sort-icon"></i>
                                            @else
                                                <i class="mdi mdi-swap-vertical sort-icon"></i>
                                            @endif
                                        </th>
                                        <th>Unit</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($landBank as $item)
                                        <tr>
                                            <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-city text-primary me-2"
                                                        style="font-size: 1.2rem;"></i>
                                                    <span class="fw-bold">{{ $item->name ?? '-' }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-domain text-primary me-2"
                                                        style="font-size: 1.2rem;"></i>
                                                    <span>{{ $item->companyProfile->name ?? '-' }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="type-badge">
                                                    <i class="mdi mdi-home"></i> {{ $item->zoning ?? '-' }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center location-wrapper">
                                                    <i class="mdi mdi-map-marker text-primary me-2"
                                                        style="font-size: 1.2rem; flex-shrink: 0;"></i>
                                                    <span class="location-text" title="{{ $item->address ?? '-' }}">
                                                        {{ $item->address ?? '-' }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                @if ($item->legal_status == 'verified')
                                                    <span class="status-badge-gradient success">
                                                        <i class="mdi mdi-check-circle"></i> Terverifikasi
                                                    </span>
                                                @elseif($item->legal_status == 'Pending')
                                                    <span class="status-badge-gradient warning">
                                                        <i class="mdi mdi-clock"></i> Pending
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-price">
                                                Rp {{ number_format($item->acquisition_price ?? 0, 0, ',', '.') }}
                                            </td>
                                            <td>
                                                <span class="unit-badge">{{ $item->units->count() }} Unit</span>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ request()->fullUrlWithQuery(['detail' => $item->id]) }}"
                                                    class="btn btn-outline-purple btn-sm">
                                                    <i class="mdi mdi-eye"></i> Lihat
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center text-muted py-4">
                                                Tidak ada data
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- PAGINATION - UKURAN NORMAL -->
                        @if ($landBank instanceof \Illuminate\Pagination\LengthAwarePaginator && $landBank->total() > 0)
                            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                                <div class="pagination-info mb-2 mb-sm-0">
                                    Menampilkan {{ $landBank->firstItem() }} - {{ $landBank->lastItem() }} dari
                                    {{ $landBank->total() }} data
                                </div>
                                <nav aria-label="Page navigation">
                                    <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                        {{-- Previous Page Link --}}
                                        @if ($landBank->onFirstPage())
                                            <li class="page-item disabled" aria-disabled="true">
                                                <span class="page-link" aria-label="Previous">
                                                    <i class="mdi mdi-chevron-left"></i>
                                                </span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link"
                                                    href="{{ $landBank->appends(request()->query())->previousPageUrl() }}"
                                                    rel="prev" aria-label="Previous">
                                                    <i class="mdi mdi-chevron-left"></i>
                                                </a>
                                            </li>
                                        @endif

                                        {{-- Pagination Elements --}}
                                        @foreach ($landBank->getUrlRange(max(1, $landBank->currentPage() - 2), min($landBank->lastPage(), $landBank->currentPage() + 2)) as $page => $url)
                                            @if ($page == $landBank->currentPage())
                                                <li class="page-item active" aria-current="page">
                                                    <span class="page-link">{{ $page }}</span>
                                                </li>
                                            @else
                                                <li class="page-item">
                                                    <a class="page-link"
                                                        href="{{ $landBank->appends(request()->query())->url($page) }}">{{ $page }}</a>
                                                </li>
                                            @endif
                                        @endforeach

                                        {{-- Next Page Link --}}
                                        @if ($landBank->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link"
                                                    href="{{ $landBank->appends(request()->query())->nextPageUrl() }}"
                                                    rel="next" aria-label="Next">
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

    <!-- MODAL DETAIL UNTUK SETIAP ITEM -->
    @foreach ($landBank as $item)
        <div class="modal fade" id="modalDetailLandbank{{ $item->id }}" tabindex="-1"
            aria-labelledby="modalDetailLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header"
                        style="background: linear-gradient(135deg, #da8cff, #9a55ff); color: white;">
                        <h5 class="modal-title" id="modalDetailLabel{{ $item->id }}">
                            <i class="mdi mdi-eye me-2"></i>Detail Landbank
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- INFORMASI UTAMA -->
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="text-muted small">Nama Proyek</label>
                                        <h6 class="fw-bold mb-0">{{ $item->name }}</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-muted small">Perusahaan</label>
                                        <h6 class="fw-bold mb-0">{{ $item->companyProfile->name ?? '-' }}</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-muted small">Tipe / Zoning</label>
                                        <h6 class="mb-0">{{ $item->zoning ?? '-' }}</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-muted small">Status</label><br>
                                        @if ($item->status == 'ready')
                                            <span class="status-badge-gradient success">Tersedia</span>
                                        @elseif($item->status == 'sold')
                                            <span class="status-badge-gradient danger">Terjual</span>
                                        @else
                                            <span
                                                class="status-badge-gradient warning">{{ ucfirst($item->status ?? '-') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-12">
                                        <label class="text-muted small">Lokasi</label>
                                        <p class="mb-0">{{ $item->address }}</p>
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
                                Detail Unit
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Unit</th>
                                                <th>Type Unit</th>
                                                <th>Proses Pembangunan</th>
                                                <th>Booking</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           @forelse ($units ?? [] as $unit)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $unit->unit_name ?? ($unit->unit_number ?? '-') }}</td>
                                                    <td>{{ $unit->type ?? '-' }}</td>
                                                    <td>
                                                        @if ($unit->construction_progress)
                                                            @switch($unit->construction_progress)
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
                                                                    <span class="badge bg-dark text-white">Finishing</span>
                                                                @break

                                                                @case('selesai')
                                                                    <span class="badge bg-success">Selesai</span>
                                                                @break

                                                                @default
                                                                    <span
                                                                        class="badge bg-secondary">{{ ucfirst($unit->construction_progress) }}</span>
                                                            @endswitch
                                                        @else
                                                            <span class="badge bg-secondary">-</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($unit->activeBooking && $unit->activeBooking->customer)
                                                            {{ $unit->activeBooking->customer->full_name }}
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($unit->status == 'tersedia')
                                                            <span class="badge bg-success">Tersedia</span>
                                                        @elseif($unit->status == 'terjual' || $unit->status == 'sold')
                                                            <span class="badge"
                                                                style="background: #dc3545; color: white;">
                                                                <i class="mdi mdi-cancel me-1"></i>Terjual/Sold
                                                            </span>
                                                        @elseif($unit->status == 'dipesan' || $unit->status == 'booked')
                                                            <span class="badge"
                                                                style="background: #ffc107; color: #2c2e3f;">
                                                                <i class="mdi mdi-clock me-1"></i>Dipesan/Booked
                                                            </span>
                                                        @else
                                                            <span
                                                                class="badge bg-secondary">{{ $unit->status ?? '-' }}</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="6" class="text-center text-muted py-4">
                                                            Tidak ada data unit
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                        <div class="p-3">
                                            {{ $units?->appends(request()->query())->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                                <i class="mdi mdi-close me-1"></i>Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    @endsection

    @push('scripts')
        <!-- Select2 JS -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <!-- Select2 Bootstrap5 Theme -->
        <script src="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.js">
        </script>
        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            $(document).ready(function() {
                // Init Select2
                $('#perusahaanSelect, #perusahaanSelectMobile').select2({
                    theme: 'bootstrap-5',
                    placeholder: '-- Pilih Perusahaan --',
                    allowClear: true,
                    width: '100%',
                    dropdownCssClass: 'select2-limited-items',
                    language: {
                        noResults: function() {
                            return "Perusahaan tidak ditemukan";
                        },
                        searching: function() {
                            return "Mencari...";
                        }
                    }
                });

                // Sorting functionality
                $('.sortable').click(function() {
                    let field = $(this).data('field');
                    let direction = $(this).data('direction');

                    let url = new URL(window.location.href);
                    url.searchParams.set('sortField', field);
                    url.searchParams.set('sortDirection', direction);
                    url.searchParams.set('page', 1); // Reset ke halaman 1

                    window.location.href = url.toString();
                });

                // Fungsi filter - redirect dengan parameter
                function applyFilter() {
                    let search = $('#searchInput').val() || $('#searchInputMobile').val();
                    let perusahaan = $('#perusahaanSelect').val() || $('#perusahaanSelectMobile').val();
                    let type = $('#typeSelect').val() || $('#typeSelectMobile').val();
                    let status = $('#statusSelect').val() || $('#statusSelectMobile').val();
                    let perPage = $('#perPageSelect').val() || $('#perPageSelectMobile').val();

                    let url = new URL(window.location.href);

                    if (search) url.searchParams.set('search', search);
                    else url.searchParams.delete('search');

                    if (perusahaan) url.searchParams.set('perusahaan', perusahaan);
                    else url.searchParams.delete('perusahaan');

                    if (type) url.searchParams.set('type', type);
                    else url.searchParams.delete('type');

                    if (status) url.searchParams.set('status', status);
                    else url.searchParams.delete('status');

                    url.searchParams.set('perPage', perPage);
                    url.searchParams.set('page', 1); // Reset ke halaman 1

                    window.location.href = url.toString();
                }

                // Fungsi reset filter
                function resetFilter() {
                    let url = new URL(window.location.href);
                    url.searchParams.delete('search');
                    url.searchParams.delete('perusahaan');
                    url.searchParams.delete('type');
                    url.searchParams.delete('status');
                    url.searchParams.set('perPage', '10');
                    url.searchParams.set('page', 1);
                    window.location.href = url.toString();
                }

                // Event listeners
                $('#filterBtn, #filterBtnMobile').click(applyFilter);
                $('#resetBtn, #resetBtnMobile').click(resetFilter);

                // Enter key pada search input
                $('#searchInput, #searchInputMobile').keypress(function(e) {
                    if (e.which == 13) applyFilter();
                });

                @if (session('success'))
                    Swal.fire({
                        icon: 'success',
                        title: 'Login Berhasil!',
                        html: 'Selamat datang, <strong>{{ auth()->user()->name }}</strong>',
                        timer: 3000,
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#9a55ff',
                        timerProgressBar: true,
                        didOpen: () => {
                            const timer = Swal.getPopup().querySelector("b");
                            if (timer) {
                                timer.style.width = "100%";
                            }
                        }
                    });
                @endif
            });

            function lihatDetail(id) {
                console.log('Lihat detail ID: ' + id);
            }
        </script>
        <script>
            $(document).ready(function() {
                const detailId = new URLSearchParams(window.location.search).get('detail');

                if (detailId) {
                    $('#modalDetailLandbank' + detailId).modal('show');
                }
            });
        </script>
        <script>
            $('#refreshBTN').click(function() {

                // 🔥 TAMPILKAN LOADING
                Swal.fire({
                    title: 'Memuat data...',
                    html: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: '/proyek/refresh',
                    type: 'GET',
                    success: function(res) {
                        let tbody = '';

                        res.forEach((item, index) => {

                            let company = item.company_profile?.name ?? '-';
                            let units = item.units ? item.units.length : 0;

                            let statusBadge = '';
                            if (item.status === 'ready') {
                                statusBadge = `
                        <span class="status-badge-gradient success">
                            <i class="mdi mdi-check-circle"></i> Tersedia
                        </span>`;
                            } else if (item.status === 'sold') {
                                statusBadge = `
                        <span class="status-badge-gradient danger">
                            <i class="mdi mdi-close-circle"></i> Terjual
                        </span>`;
                            } else {
                                statusBadge = `
                        <span class="status-badge-gradient warning">
                            <i class="mdi mdi-clock"></i> ${item.status ?? '-'}
                        </span>`;
                            }

                            tbody += `
                    <tr>
                        <td class="text-center fw-bold">${index + 1}</td>

                        <td>
                            <div class="d-flex align-items-center">
                                <i class="mdi mdi-city text-primary me-2"></i>
                                <span class="fw-bold">${item.name ?? '-'}</span>
                            </div>
                        </td>

                        <td>
                            <div class="d-flex align-items-center">
                                <i class="mdi mdi-domain text-primary me-2"></i>
                                <span>${company}</span>
                            </div>
                        </td>

                        <td>
                            <span class="type-badge">
                                <i class="mdi mdi-home"></i> ${item.zoning ?? '-'}
                            </span>
                        </td>

                        <td>
                            <div class="d-flex align-items-center">
                                <i class="mdi mdi-map-marker text-primary me-2"></i>
                                <span>${item.address ?? '-'}</span>
                            </div>
                        </td>

                        <td>${statusBadge}</td>

                        <td class="text-price">
                            Rp ${Number(item.acquisition_price ?? 0).toLocaleString('id-ID')}
                        </td>

                        <td>
                            <span class="unit-badge">${units} Unit</span>
                        </td>

                        <td class="text-center">
                            <button class="btn btn-outline-purple btn-sm"
                                onclick="lihatDetail(${item.id})">
                                <i class="mdi mdi-eye"></i> Lihat
                            </button>
                        </td>
                    </tr>
                `;
                        });

                        $('#proyekTable tbody').html(tbody);

                        // ✅ TUTUP LOADING
                        Swal.close();
                    },
                    error: function(err) {
                        Swal.close();

                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Tidak dapat memuat data'
                        });

                        console.error('Gagal refresh:', err);
                    }
                });
            });
        </script>
    @endpush
