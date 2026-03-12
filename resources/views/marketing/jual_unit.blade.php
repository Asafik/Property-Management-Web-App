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

        /* Denah Styling */
        .denah-container {
            background: linear-gradient(135deg, #f9f7ff, #f2ecff);
            border-radius: 16px;
            padding: 2rem;
            min-height: 400px;
        }

        .unit-box {
            position: relative;
            min-width: 70px;
            display: inline-block;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            color: white;
            transition: all 0.2s ease;
        }

        .unit-box:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .type-badge-small {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #000;
            color: #fff;
            font-size: 9px;
            padding: 2px 5px;
            border-radius: 50%;
            font-weight: bold;
        }

        .legend-box {
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 12px;
            color: white;
        }

        /* ===== FILE UPLOAD MODERN STYLING ===== */
        .file-upload-modern {
            position: relative;
            width: 100%;
        }

        .file-upload-modern input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
            z-index: 2;
        }

        .file-upload-modern .file-label-modern {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            gap: 6px;
            padding: 1rem 0.6rem;
            background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
            border: 2px dashed #d0d4db;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            min-height: 100px;
        }

        @media (min-width: 576px) {
            .file-upload-modern .file-label-modern {
                flex-direction: row;
                text-align: left;
                gap: 8px;
                padding: 0.75rem 1rem;
                min-height: auto;
            }
        }

        .file-upload-modern:hover .file-label-modern {
            border-color: #9a55ff;
            background: linear-gradient(135deg, #f1f0ff, #f8f9fa);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(154, 85, 255, 0.1);
        }

        .file-upload-modern .file-label-modern i {
            font-size: 1.6rem;
            color: #9a55ff;
            background: rgba(154, 85, 255, 0.1);
            padding: 8px;
            border-radius: 50%;
        }

        .file-upload-modern .file-label-modern .file-info-modern {
            flex: 1;
            width: 100%;
        }

        .file-upload-modern .file-label-modern .file-info-modern span {
            display: block;
            font-weight: 600;
            color: #2c2e3f;
            font-size: 0.8rem;
            word-break: break-word;
        }

        .file-upload-modern .file-label-modern .file-info-modern small {
            color: #6c7383;
            font-size: 0.65rem;
            display: block;
            margin-top: 2px;
        }

        .file-upload-modern .file-label-modern .file-size {
            font-size: 0.7rem;
            color: #9a55ff;
            font-weight: 600;
            background: rgba(154, 85, 255, 0.1);
            padding: 4px 10px;
            border-radius: 20px;
            white-space: nowrap;
            margin-top: 5px;
        }

        @media (min-width: 576px) {
            .file-upload-modern .file-label-modern .file-size {
                margin-top: 0;
            }
        }

        .file-upload-modern .file-label-modern.file-selected {
            border-color: #28a745;
            background: linear-gradient(135deg, #f0fff4, #e6f7e6);
        }

        /* ===== SITEPLAN STYLING - RESPONSIVE ===== */
        .siteplan-scroll-container {
            width: 100%;
            overflow-x: auto;
            overflow-y: auto;
            border: 2px solid #9a55ff;
            border-radius: 12px;
            background: #f8f9fa;
            max-height: 700px;
        }

        #siteplanCanvas {
            display: block;
            border-radius: 8px;
            cursor: pointer;
        }

        .btn-save-position {
            background: linear-gradient(135deg, #28a745, #5cb85c);
            color: white;
            border: none;
            padding: 10px 25px;
            font-weight: 600;
            border-radius: 8px;
            margin-top: 15px;
            transition: all 0.3s ease;
        }

        .btn-save-position:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
        }

        /* ===== MODAL DETAIL SEDERHANA ===== */
        .modal-detail-simple {
            font-family: 'Nunito', sans-serif;
        }

        .modal-detail-simple .modal-header {
            background: #9a55ff;
            color: white;
            border-bottom: none;
        }

        .modal-detail-simple .modal-body p {
            margin-bottom: 12px;
            padding: 8px 12px;
            background: #f8f9fa;
            border-radius: 6px;
            border-left: 3px solid #9a55ff;
        }

        .modal-detail-simple strong {
            color: #9a55ff;
            width: 80px;
            display: inline-block;
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

                        <!-- Toggle View - TABLE SEBAGAI DEFAULT -->
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
                                <button type="button" class="btn btn-outline-primary" id="btnSitePlandView"
                                    onclick="switchView('sitepland')">
                                    <i class="mdi mdi-floor-plan me-1"></i>
                                    <span class="d-none d-sm-inline">Siteplan</span>
                                </button>
                            </div>
                        </div>

                        <!-- TABLE VIEW - TAMPIL (DEFAULT) -->
                        <div id="tableView" style="display: block;">
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
                                                <td style="min-width:180px;">
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

                                                        $barWidth = $status === 'belum_mulai' ? 100 : $progress;
                                                    @endphp

                                                    <div class="progress rounded-pill"
                                                        style="height:22px; background:#f1f1f1;">
                                                        <div class="progress-bar
                                                            d-flex align-items-center justify-content-center
                                                            fw-semibold text-white
                                                            @if ($status === 'belum_mulai') bg-danger
                                                            @elseif($progress < 100) bg-warning
                                                            @else bg-success @endif"
                                                            role="progressbar"
                                                            style="width: {{ $barWidth }}%; transition: .5s;"
                                                            aria-valuenow="{{ $progress }}" aria-valuemin="0"
                                                            aria-valuemax="100">

                                                            @if ($status === 'belum_mulai')
                                                                Belum mulai pembangunan
                                                            @else
                                                                {{ $progress }}%
                                                            @endif

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
                                                        <button class="btn btn-outline-primary btn-sm btnDetailUnit"
                                                            data-bs-toggle="modal" data-bs-target="#detailUnitModal"
                                                            data-unit="{{ $unit->unit_code }}"
                                                            data-block="{{ $unit->block }}"
                                                            data-type="{{ $unit->type }}"
                                                            data-address="{{ $unit->landBank->address }}"
                                                            data-area="{{ $unit->area }}"
                                                            data-building="{{ $unit->building_area }}"
                                                            data-price="{{ $unit->price }}"
                                                            data-direction="{{ $unit->facing }}"
                                                            data-status="{{ $unit->status }}"
                                                            data-construction="{{ $unit->construction_progress }}"
                                                            data-customer="{{ $unit->activeBooking->customer->full_name ?? '-' }}"
                                                            data-sales="{{ $unit->activeBooking->sales->name ?? '-' }}"
                                                            data-booking_date="{{ $unit->activeBooking->booking_date ?? '-' }}"
                                                            data-booking_fee="{{ $unit->activeBooking->booking_fee ?? '-' }}"
                                                            data-booking_status="{{ $unit->activeBooking->status ?? '-' }}"
                                                            title="Detail">

                                                            <i class="mdi mdi-eye"></i>
                                                        </button>
                                                        @if (auth()->user()->position_id != 5)
                                                            <button onclick="openCustomerModal({{ $unit->id }})"
                                                                class="btn btn-outline-danger btn-sm"
                                                                title="Tambah Customer">
                                                                <i class="mdi mdi-account-plus"></i>
                                                            </button>

                                                            <button class="btn btn-outline-info btn-sm bukaModal"
                                                                data-unit="{{ $unit->id }}" title="Pilih Agency">
                                                                <i class="mdi mdi-office-building"></i>
                                                            </button>
                                                        @endif
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

                        <!-- GRID VIEW (Katalog) - SEMBUNYI -->
                        <div id="gridView" style="display: none;">
                            <div class="row g-3">
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
                        </div>

                        <!-- DENAH VIEW - SEMBUNYI -->
                        <div id="denahView" style="display: none;">
                            <div class="denah-container">
                                <div style="display:flex; flex-wrap:wrap; justify-content:center; gap:10px;">
                                    @php
                                        // Kelompokkan unit berdasarkan proyek (landBank)
                                        $unitsByProject = $units->groupBy(function ($item) {
                                            return $item->landBank->name ?? 'Tanpa Proyek';
                                        });
                                    @endphp

                                    @foreach ($unitsByProject as $projectName => $projectUnits)
                                        @php
                                            // Kelompokkan unit per proyek berdasarkan blok
                                            $blokKavlings = [];
                                            foreach ($projectUnits as $unit) {
                                                $blok = explode('.', $unit->unit_code)[0];
                                                $blokKavlings[$blok][] = $unit;
                                            }
                                            $allBloks = array_keys($blokKavlings);
                                        @endphp

                                        <div
                                            style="margin-bottom: 25px; width:100%; border-bottom: 1px dashed #9a55ff; padding-bottom: 15px;">
                                            <h6 class="text-primary mb-3">
                                                <i class="mdi mdi-office-building me-2"></i>
                                                Proyek: {{ $projectName }}
                                            </h6>

                                            @foreach ($allBloks as $blok)
                                                <div style="margin-bottom:15px; width:100%;">
                                                    @php
                                                        $typesInBlok = collect($blokKavlings[$blok])
                                                            ->pluck('type')
                                                            ->unique()
                                                            ->values()
                                                            ->toArray();

                                                        $typeLetters = [];

                                                        foreach ($typesInBlok as $type) {
                                                            if ($type == 'subsidi') {
                                                                $typeLetters[] = 'S';
                                                            } elseif ($type == 'komersil') {
                                                                $typeLetters[] = 'K';
                                                            }
                                                        }

                                                        $labelType = implode(' & ', $typeLetters);
                                                    @endphp

                                                    <strong style="font-size: 14px;">
                                                        Blok {{ $blok }} - {{ $labelType }}
                                                        <small class="text-muted ms-2">({{ count($blokKavlings[$blok]) }}
                                                            unit)</small>
                                                    </strong>

                                                    <div
                                                        style="display:flex; flex-wrap:wrap; gap:8px; justify-content:flex-start; margin-top:8px;">

                                                        @php
                                                            $numbers = [];
                                                            foreach ($blokKavlings[$blok] as $unit) {
                                                                $num = (int) explode('.', $unit->unit_code)[1];
                                                                $numbers[] = $num;
                                                            }
                                                            $maxNum = max($numbers);
                                                        @endphp

                                                        @for ($i = 1; $i <= $maxNum; $i++)
                                                            @php
                                                                $unitFound = collect($blokKavlings[$blok])->firstWhere(
                                                                    'unit_code',
                                                                    $blok . '.' . $i,
                                                                );

                                                                $bgColor = '#6c757d'; // abu-abu untuk belum ada
                                                                $icon = 'close';
                                                                $borderStyle = 'none';
                                                                $extraStyle = '';
                                                                $typeBadge = '';
                                                                $statusText = 'Belum Tersedia';

                                                                if ($unitFound) {
                                                                    $statusText = ucfirst($unitFound->status);

                                                                    // WARNA BERDASARKAN STATUS
                                                                    switch ($unitFound->status) {
                                                                        case 'sold':
                                                                            $bgColor = '#dc3545'; // merah
                                                                            $icon = 'check';
                                                                            break;

                                                                        case 'booked':
                                                                            $bgColor = '#ffc107'; // kuning
                                                                            $icon = 'clock';
                                                                            break;

                                                                        case 'draft':
                                                                            $bgColor = '#343a40'; // hitam
                                                                            $icon = 'pencil';
                                                                            break;

                                                                        case 'ready':
                                                                            if ($unitFound->type == 'subsidi') {
                                                                                $bgColor = '#28a745'; // hijau
                                                                                $typeBadge = 'S';
                                                                            } else {
                                                                                $bgColor = '#0d6efd'; // biru
                                                                                $typeBadge = 'K';
                                                                            }
                                                                            $icon = 'home';
                                                                            break;
                                                                    }

                                                                    // BORDER BERDASARKAN PROGRESS
                                                                    switch ($unitFound->construction_progress) {
                                                                        case 'belum_mulai':
                                                                            $borderStyle = '2px dashed #000';
                                                                            $extraStyle =
                                                                                'background-image: repeating-linear-gradient(45deg, rgba(255,255,255,0.2), rgba(255,255,255,0.2) 5px, transparent 5px, transparent 10px);';
                                                                            break;

                                                                        case 'pondasi':
                                                                            $borderStyle = '2px solid #000';
                                                                            break;

                                                                        case 'dinding':
                                                                            $borderStyle = '3px solid #000';
                                                                            break;

                                                                        case 'atap':
                                                                            $borderStyle = '3px double #000';
                                                                            break;

                                                                        case 'finishing':
                                                                            $borderStyle = '3px groove #000';
                                                                            break;

                                                                        case 'selesai':
                                                                            $borderStyle = '3px solid #155724';
                                                                            break;
                                                                    }
                                                                }
                                                            @endphp

                                                            <span class="unit-box"
                                                                style="
                                                                        background-color: var(--unit-bg, {{ $bgColor }});
                                                                        border: {{ $borderStyle }};
                                                                        {{ $extraStyle }}
                                                                    "
                                                                data-status="{{ $unitFound->status ?? 'unavailable' }}"
                                                                data-type="{{ $unitFound->type ?? '' }}"
                                                                title="{{ $unitFound ? 'Blok: ' . $unitFound->unit_code . ' - Status: ' . $statusText . ' - Progress: ' . ($unitFound->construction_progress ?? 'belum_mulai') : 'Unit ' . $blok . '.' . $i . ' belum tersedia' }}">

                                                                @if ($typeBadge)
                                                                    <span
                                                                        class="type-badge-small">{{ $typeBadge }}</span>
                                                                @endif

                                                                <i class="mdi mdi-{{ $icon }} me-1"></i>
                                                                {{ $blok . '.' . $i }}
                                                            </span>
                                                        @endfor
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>

                                <!-- LEGEND -->
                                <div class="mt-5 pt-3 border-top">
                                    <h6 class="mb-3">Keterangan:</h6>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h6 class="small fw-bold">Status Penjualan:</h6>
                                            <div class="d-flex flex-wrap gap-2 mb-3">
                                                <span class="legend-box bg-danger">Sold</span>
                                                <span class="legend-box bg-warning text-dark">Booked</span>
                                                <span class="legend-box bg-dark">Draft</span>
                                                <span class="legend-box bg-success">Ready - Subsidi</span>
                                                <span class="legend-box bg-primary">Ready - Komersil</span>
                                                <span class="legend-box" style="background-color:#6c757d;">Belum
                                                    Tersedia</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="small fw-bold">Progress Pembangunan (Border):</h6>
                                            <div class="d-flex flex-wrap gap-2 mb-3">
                                                <span
                                                    style="border:2px dashed #000; padding:4px 8px; background:#f8f9fa;">Belum
                                                    Mulai</span>
                                                <span
                                                    style="border:2px solid #000; padding:4px 8px; background:#f8f9fa;">Pondasi</span>
                                                <span
                                                    style="border:3px solid #000; padding:4px 8px; background:#f8f9fa;">Dinding</span>
                                                <span
                                                    style="border:3px double #000; padding:4px 8px; background:#f8f9fa;">Atap</span>
                                                <span
                                                    style="border:3px groove #000; padding:4px 8px; background:#f8f9fa;">Finishing</span>
                                                <span
                                                    style="border:3px solid #155724; padding:4px 8px; background:#f8f9fa;">Selesai</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="small fw-bold">Tipe Unit:</h6>
                                            <div class="d-flex gap-2">
                                                <span class="badge bg-success">S = Subsidi</span>
                                                <span class="badge bg-primary">K = Komersil</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SITEPLAN VIEW - SEMBUNYI -->
                        <div id="sitePlandView" style="display: none;">
                            <div class="denah-container" style="padding: 1rem;">
                                <div class="siteplan-scroll-container">
                                    <canvas id="siteplanCanvas"></canvas>
                                </div>

                                <!-- Tombol Simpan Posisi Unit - HANYA DI TAB SITEPLAN -->
                                <div class="mt-4 text-center">
                                    <button type="button" class="btn btn-save-position" onclick="savePosition()">
                                        <i class="mdi mdi-content-save me-2"></i>
                                        Simpan Posisi Unit
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- MODAL DETAIL SEDERHANA -->
                        <div class="modal fade" id="myModal" tabindex="-1">
                            <div class="modal-dialog modal-sm modal-dialog-centered">
                                <div class="modal-content modal-detail-simple">
                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            <i class="mdi mdi-home-circle me-2"></i>
                                            Detail Unit
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>
                                            <strong>Unit Code:</strong>
                                            <span class="unit-code">-</span>
                                        </p>
                                        <p>
                                            <strong>Status:</strong>
                                            <span class="unit-status">-</span>
                                        </p>
                                        <p>
                                            <strong>Posisi:</strong>
                                            <span class="unit-pos">-</span>
                                        </p>
                                        <p>
                                            <strong>Ukuran:</strong>
                                            <span class="unit-size">-</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Detail Unit Lengkap (untuk tombol detail) -->
                        <div class="modal fade" id="detailUnitModal" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            <i class="mdi mdi-home-circle me-2" style="color: #9a55ff;"></i>
                                            Detail Unit Lengkap
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>Kode Unit</th>
                                                <td id="m_unit"></td>
                                            </tr>
                                            <tr>
                                                <th>Blok</th>
                                                <td id="m_block"></td>
                                            </tr>
                                            <tr>
                                                <th>Tipe</th>
                                                <td id="m_type"></td>
                                            </tr>
                                            <tr>
                                                <th>Alamat</th>
                                                <td id="m_address"></td>
                                            </tr>
                                            <tr>
                                                <th>Luas Tanah</th>
                                                <td id="m_area"></td>
                                            </tr>
                                            <tr>
                                                <th>Luas Bangunan</th>
                                                <td id="m_building"></td>
                                            </tr>
                                            <tr>
                                                <th>Harga</th>
                                                <td id="m_price"></td>
                                            </tr>
                                            <tr>
                                                <th>Arah Hadap</th>
                                                <td id="m_direction"></td>
                                            </tr>
                                            <tr>
                                                <th>Status</th>
                                                <td id="m_status"></td>
                                            </tr>
                                            <tr>
                                                <th>Status Pembangunan</th>
                                                <td id="m_construction"></td>
                                            </tr>
                                        </table>
                                        <h5 class="mt-3">Detail Booking</h5>
                                        <table class="table table-bordered">
                                            <tr>
                                                <th width="30%">Customer</th>
                                                <td id="m_customer"></td>
                                            </tr>
                                            <tr>
                                                <th>Sales / Agency</th>
                                                <td id="m_sales"></td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal Booking</th>
                                                <td id="m_booking_date"></td>
                                            </tr>
                                            <tr>
                                                <th>Booking Fee</th>
                                                <td id="m_booking_fee"></td>
                                            </tr>
                                            <tr>
                                                <th>Status Booking</th>
                                                <td id="m_booking_status"></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pagination dengan styling yang sama -->
                        @if ($units->count() > 0)
                            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-3">
                                <div class="pagination-info mb-2 mb-sm-0">
                                    <i class="mdi mdi-information-outline me-1"></i>
                                    Menampilkan {{ $units->firstItem() }} - {{ $units->lastItem() }}
                                    dari {{ $units->total() }} data
                                </div>
                                <nav aria-label="Page navigation">
                                    <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0"
                                        style="gap: 2px;">
                                        {{-- Previous Page Link --}}
                                        @if ($units->onFirstPage())
                                            <li class="page-item disabled">
                                                <span class="page-link" aria-label="Previous">
                                                    <i class="mdi mdi-chevron-left"></i>
                                                </span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $units->previousPageUrl() }}"
                                                    aria-label="Previous">
                                                    <i class="mdi mdi-chevron-left"></i>
                                                </a>
                                            </li>
                                        @endif

                                        {{-- Page Links --}}
                                        @foreach ($units->getUrlRange(1, $units->lastPage()) as $page => $url)
                                            <li class="page-item {{ $units->currentPage() == $page ? 'active' : '' }}">
                                                <a class="page-link"
                                                    href="{{ $url }}">{{ $page }}</a>
                                            </li>
                                        @endforeach

                                        {{-- Next Page Link --}}
                                        @if ($units->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $units->nextPageUrl() }}"
                                                    aria-label="Next">
                                                    <i class="mdi mdi-chevron-right"></i>
                                                </a>
                                            </li>
                                        @else
                                            <li class="page-item disabled">
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
                    <!-- Booking Fee Section dengan MODERN FILE UPLOAD -->
                    <div class="card mb-3 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="row">
                                <!-- Booking Fee -->
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">
                                        <i class="mdi mdi-cash-multiple text-primary me-1"></i>
                                        Booking Fee <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white">Rp</span>
                                        <input type="text" class="form-control" id="booking_fee" name="booking_fee"
                                            placeholder="Masukkan booking fee" autocomplete="off">
                                    </div>
                                    <small class="text-muted">Nominal booking fee yang dibayar customer</small>
                                </div>

                                <!-- Upload Bukti Transfer MODERN -->
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">
                                        <i class="mdi mdi-cloud-upload text-primary me-1"></i>
                                        Upload Bukti Transfer <span class="text-danger">*</span>
                                    </label>
                                    <div class="file-upload-modern">
                                        <input type="file" id="bukti_transfer" name="bukti_transfer"
                                            accept=".jpg,.jpeg,.png,.pdf">
                                        <div class="file-label-modern" id="buktiLabel">
                                            <i class="mdi mdi-cloud-upload"></i>
                                            <div class="file-info-modern">
                                                <span id="buktiFileName">Upload Bukti Transfer</span>
                                                <small>Format: JPG, PNG, PDF (Max 2MB)</small>
                                            </div>
                                            <span class="file-size" id="buktiFileSize"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12">
                                    <small class="text-muted">
                                        <i class="mdi mdi-information-outline me-1"></i>
                                        Pilih customer lalu klik metode pembayaran (Cash/KPR)
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
                        <table class="table table-bordered align-middle mb-0" id="customerTable">
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
                                                    <i class="mdi mdi-cash me-1"></i>Cash Keras
                                                </button>
                                                <button type="button" class="btn btn-sm btn-info pilihCustomer"
                                                    data-id="{{ $c->id }}" data-type="cash-tempo"
                                                    style="padding: 0.25rem 0.75rem; font-size: 0.75rem;">
                                                    <i class="mdi mdi-cash-multiple me-1"></i>Cash Tempo
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.0/fabric.min.js"></script>

    <script>
        // ========== DETAIL MODAL HANDLER (untuk tombol detail) ==========
        const detailModal = document.getElementById('detailUnitModal')
        if (detailModal) {
            detailModal.addEventListener('show.bs.modal', function(event) {
                let button = event.relatedTarget

                document.getElementById('m_unit').innerText = button.getAttribute('data-unit')
                document.getElementById('m_block').innerText = button.getAttribute('data-block')
                document.getElementById('m_type').innerText = button.getAttribute('data-type')
                document.getElementById('m_address').innerText = button.getAttribute('data-address')
                document.getElementById('m_area').innerText = button.getAttribute('data-area') + ' m²'
                document.getElementById('m_building').innerText = button.getAttribute('data-building') + ' m²'
                document.getElementById('m_price').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(button.getAttribute('data-price'))
                document.getElementById('m_direction').innerText = button.getAttribute('data-direction')
                document.getElementById('m_status').innerText = button.getAttribute('data-status')
                document.getElementById('m_construction').innerText = button.getAttribute('data-construction')
                document.getElementById('m_customer').innerText = button.getAttribute('data-customer')
                document.getElementById('m_sales').innerText = button.getAttribute('data-sales')
                document.getElementById('m_booking_date').innerText = button.getAttribute('data-booking_date')
                document.getElementById('m_booking_fee').innerText = button.getAttribute('data-booking_fee')
                document.getElementById('m_booking_status').innerText = button.getAttribute('data-booking_status')
            })
        }

        // ========== SITEPLAN CANVAS - SATU SCRIPT ==========
        const canvas = new fabric.Canvas('siteplanCanvas');
        const siteplanImage = "{{ asset('storage/siteplan.jpg') }}";

        // Load background image
        fabric.Image.fromURL(siteplanImage, function(img) {
            // Set canvas size sesuai ukuran asli gambar
            canvas.setWidth(img.width);
            canvas.setHeight(img.height);

            canvas.setBackgroundImage(img, function() {
                // Load unit dari database dengan posisi absolut
                @foreach ($unitsForSvg as $unit)
                    const rect{{ $unit->id }} = new fabric.Rect({
                        left: {{ $unit->pos_x ?? 100 }},
                        top: {{ $unit->pos_y ?? 100 }},
                        width: {{ $unit->width ?? 80 }},
                        height: {{ $unit->height ?? 60 }},
                        fill: getColor("{{ $unit->status }}", "{{ $unit->type }}"),
                        opacity: 0.6,
                        stroke: 'black',
                        strokeWidth: 1,
                        hasControls: true,
                        hasBorders: true,
                        lockRotation: true
                    });

                    rect{{ $unit->id }}.unitId = "{{ $unit->id }}";
                    rect{{ $unit->id }}.unitCode = "{{ $unit->unit_code }}";
                    rect{{ $unit->id }}.status = "{{ $unit->status }}";

                    canvas.add(rect{{ $unit->id }});
                @endforeach

                canvas.renderAll();
            }, {
                originX: 'left',
                originY: 'top'
            });
        });

        // Fungsi untuk menentukan warna berdasarkan status dan tipe
        function getColor(status, type) {
            if (type === "komersil" && status === "ready") return "#2675BB";
            if (status === "ready") return "#CE2A2E";
            if (status === "booked") return "#FFD700";
            if (status === "sold") return "#FA2800";
            return "gray";
        }

        // ========== DOUBLE CLICK HANDLER UNTUK DETAIL SEDERHANA ==========
        canvas.on('mouse:dblclick', function(e) {
            if (e.target && e.target.unitId) {
                // Isi modal dengan data unit
                document.querySelector('#myModal .unit-code').textContent = e.target.unitCode || '-';
                document.querySelector('#myModal .unit-status').textContent = e.target.status || '-';
                document.querySelector('#myModal .unit-pos').textContent = `X: ${Math.round(e.target.left)}, Y: ${Math.round(e.target.top)}`;
                document.querySelector('#myModal .unit-size').textContent = `W: ${Math.round(e.target.getScaledWidth())}, H: ${Math.round(e.target.getScaledHeight())}`;

                // Tampilkan modal
                const modal = new bootstrap.Modal(document.getElementById('myModal'));
                modal.show();
            }
        });

        // ========== SAVE POSITION FUNCTION ==========
        function savePosition() {
            let units = [];

            canvas.getObjects().forEach(function(obj) {
                if (obj.unitId) {
                    units.push({
                        id: obj.unitId,
                        pos_x: Math.round(obj.left),
                        pos_y: Math.round(obj.top),
                        width: Math.round(obj.getScaledWidth()),
                        height: Math.round(obj.getScaledHeight())
                    });
                }
            });

            fetch("{{ route('unit.save.position') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ units: units })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Posisi unit berhasil disimpan',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Terjadi kesalahan saat menyimpan posisi'
                });
            });
        }

        // ========== SWITCH VIEW FUNCTION ==========
        function switchView(view) {
            // sembunyikan semua
            document.getElementById('tableView').style.display = 'none';
            document.getElementById('gridView').style.display = 'none';
            document.getElementById('denahView').style.display = 'none';
            document.getElementById('sitePlandView').style.display = 'none';

            // reset active button
            document.querySelectorAll('.btn-group .btn').forEach(btn => {
                btn.classList.remove('active');
            });

            // tampilkan sesuai pilihan
            if (view === 'table') {
                document.getElementById('tableView').style.display = 'block';
                document.getElementById('btnTableView').classList.add('active');
            } else if (view === 'grid') {
                document.getElementById('gridView').style.display = 'block';
                document.getElementById('btnGridView').classList.add('active');
            } else if (view === 'denah') {
                document.getElementById('denahView').style.display = 'block';
                document.getElementById('btnDenahView').classList.add('active');
            } else if (view === 'sitepland') {
                document.getElementById('sitePlandView').style.display = 'block';
                document.getElementById('btnSitePlandView').classList.add('active');
            }
        }

        // ========== HAPUS DEFAULT VIEW KE SITEPLAN ==========
        // document.addEventListener('DOMContentLoaded', function() {
        //     switchView('sitepland');
        // });

        // ========== SISANYA TETAP SAMA PERSIS ==========
        $(document).ready(function() {
            // CEK APAKAH TABEL MEMILIKI DATA (bukan baris kosong)
            let hasData = false;
            $('#unitTable tbody tr').each(function() {
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
                        },
                        {
                            targets: 14,
                            orderable: false
                        }
                    ]
                });
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

            // FILE UPLOAD HANDLER - Modern styling
            $('#bukti_transfer').on('change', function() {
                const file = this.files[0];
                const $label = $('#buktiLabel');
                const $fileName = $('#buktiFileName');
                const $fileSize = $('#buktiFileSize');

                if (file) {
                    $fileName.text(file.name.length > 30 ? file.name.substring(0, 30) + '...' : file.name);

                    if (file.size < 1024 * 1024) {
                        $fileSize.text((file.size / 1024).toFixed(1) + ' KB');
                    } else {
                        $fileSize.text((file.size / (1024 * 1024)).toFixed(1) + ' MB');
                    }

                    $label.addClass('file-selected');
                } else {
                    $fileName.text('Upload Bukti Transfer');
                    $fileSize.text('');
                    $label.removeClass('file-selected');
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
                $('#bukti_transfer').val('');
                $('#buktiFileName').text('Upload Bukti Transfer');
                $('#buktiFileSize').text('');
                $('#buktiLabel').removeClass('file-selected');
                $('#modalCustomer').modal('show');
            };

            // PILIH CUSTOMER - DENGAN VALIDASI FILE
            $(document).on('click', '.pilihCustomer', function() {
                let customerId = $(this).data('id');
                let purchaseType = $(this).data('type');
                let unitId = $('#modalCustomer').attr('data-unit-id');
                let bookingFee = $('#booking_fee').val().replace(/\./g, '');
                let buktiTransfer = $('#bukti_transfer')[0].files[0];

                if (!unitId) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Unit belum dipilih!'
                    });
                    return;
                }

                if (!bookingFee || parseInt(bookingFee) <= 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Booking Fee Kosong',
                        text: 'Booking fee harus diisi dan lebih dari 0!'
                    });
                    return;
                }

                if (!buktiTransfer) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Bukti Transfer Kosong',
                        text: 'Bukti transfer wajib diupload!'
                    });
                    return;
                }

                if (buktiTransfer.size > 2 * 1024 * 1024) {
                    Swal.fire({
                        icon: 'error',
                        title: 'File Terlalu Besar',
                        text: 'Ukuran file maksimal 2MB!'
                    });
                    return;
                }

                const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'application/pdf'];
                if (!allowedTypes.includes(buktiTransfer.type)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Tipe File Tidak Didukung',
                        text: 'Format file harus JPG, PNG, atau PDF!'
                    });
                    return;
                }

                Swal.fire({
                    title: 'Yakin pilih customer ini?',
                    html: `
                        <p class="mb-1">Jenis: <b>${purchaseType.toUpperCase()}</b></p>
                        <p>Booking Fee: <b>Rp ${new Intl.NumberFormat('id-ID').format(bookingFee)}</b></p>
                        <p class="small text-muted mt-2">File: ${buktiTransfer.name}</p>
                    `,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Simpan!',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let formData = new FormData();
                        formData.append('_token', '{{ csrf_token() }}');
                        formData.append('customer_id', customerId);
                        formData.append('purchase_type', purchaseType);
                        formData.append('booking_fee', bookingFee);
                        formData.append('bukti_transfer', buktiTransfer);

                        let actionUrl = "{{ route('set.customer', ':unitId') }}".replace(':unitId', unitId);

                        Swal.fire({
                            title: 'Memproses...',
                            text: 'Harap tunggu',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        $.ajax({
                            url: actionUrl,
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                $('#modalCustomer').modal('hide');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: response.message || 'Customer berhasil dipilih',
                                    timer: 1500,
                                    showConfirmButton: false
                                }).then(() => location.reload());
                            },
                            error: function(xhr) {
                                let errorMsg = 'Terjadi kesalahan';
                                if (xhr.responseJSON && xhr.responseJSON.message)
                                    errorMsg = xhr.responseJSON.message;
                                else if (xhr.responseJSON && xhr.responseJSON.errors)
                                    errorMsg = Object.values(xhr.responseJSON.errors).join('\n');

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: errorMsg
                                });
                            }
                        });
                    }
                });
            });

            // AGENCY MODAL
            $(document).on('click', '.bukaModal', function() {
                let unitId = $(this).data('unit');
                $('#formAgency').attr('action', "{{ url('marketing/set-agency') }}/" + unitId);
                $('#modalAgency').data('unit', unitId);
                $('#sales_id').val('');
                $('#agent_fee_modal').val('');
                $('#modalAgency').modal('show');
            });

            $(document).on('click', '.pilihAgency', function() {
                let salesId = $(this).data('id');
                let agentFee = $('#agent_fee_modal').val().replace(/\./g, '');

                if (!agentFee || parseInt(agentFee) <= 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Agent fee wajib diisi dan lebih dari 0!'
                    });
                    return;
                }

                let unitId = $('#modalAgency').data('unit');

                Swal.fire({
                    title: 'Yakin pilih agency ini?',
                    html: `Agent Fee: <b>Rp ${new Intl.NumberFormat('id-ID').format(agentFee)}</b>`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Pilih!',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let formData = new FormData();
                        formData.append('_token', '{{ csrf_token() }}');
                        formData.append('sales_id', salesId);
                        formData.append('agent_fee', agentFee);

                        let actionUrl = "{{ url('marketing/set-agency') }}/" + unitId;

                        $.ajax({
                            url: actionUrl,
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                $('#modalAgency').modal('hide');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: 'Agency berhasil dipilih',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(() => {
                                    location.reload();
                                });
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: xhr.responseJSON?.message || 'Terjadi kesalahan'
                                });
                            }
                        });
                    }
                });
            });

            // Reset form saat modal ditutup
            $('#modalCustomer, #modalAgency').on('hidden.bs.modal', function() {
                $('#booking_fee, #agent_fee_modal').val('');
                $('#bukti_transfer').val('');
                $('#buktiFileName').text('Upload Bukti Transfer');
                $('#buktiFileSize').text('');
                $('#buktiLabel').removeClass('file-selected');
            });

            $('#searchCustomer').on('keyup', function() {
                const searchTerm = $(this).val().toLowerCase();

                $('#customerTable tbody tr').each(function() {
                    const rowText = $(this).text().toLowerCase();
                    $(this).toggle(rowText.indexOf(searchTerm) > -1);
                });
            });
        });

        // ========== SESSION FLASH MESSAGES ==========
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "{{ session('error') }}",
                confirmButtonColor: '#d33'
            });
        @endif

        @if ($errors->any())
            Swal.fire({
                icon: 'warning',
                title: 'Validasi Gagal',
                html: `{!! implode('<br>', $errors->all()) !!}`
            });
        @endif
    </script>
@endpush
