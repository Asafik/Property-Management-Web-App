@extends('layouts.partial.app')

@section('title', 'Buat Kavling - Property Management App')

@section('content')
    <style>
        /* Custom Tab Styling - BootstrapDash style */
        .add-custom-tabs-wrapper {
            background: #f6f9ff;
            border-radius: 8px;
            padding: 6px;
            margin-bottom: 25px;
            border: 1px solid #e9ecef;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .add-custom-tabs {
            display: flex;
            flex-wrap: nowrap;
            gap: 4px;
            list-style: none;
            padding: 0;
            margin: 0;
            min-width: min-content;
        }

        .add-custom-tab-item {
            flex: 0 0 auto;
        }

        .add-custom-tab-link {
            display: flex;
            align-items: center;
            padding: 10px 16px;
            font-size: 0.85rem;
            font-weight: 500;
            color: #6c7383;
            background: transparent;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            transition: all 0.2s ease;
            white-space: nowrap;
            gap: 6px;
            font-family: 'Nunito', sans-serif;
        }

        .add-custom-tab-link i {
            font-size: 1rem;
            color: #a5b3cb;
            transition: all 0.2s ease;
        }

        .add-custom-tab-link:hover {
            color: #9a55ff;
            background: #ffffff;
            box-shadow: 0 2px 5px rgba(154, 85, 255, 0.1);
        }

        .add-custom-tab-link:hover i {
            color: #9a55ff;
        }

        .add-custom-tab-link.active {
            color: #9a55ff;
            background: #ffffff;
            box-shadow: 0 2px 8px rgba(154, 85, 255, 0.15);
            font-weight: 600;
        }

        .add-custom-tab-link.active i {
            color: #9a55ff;
        }

        /* Tab Content Animation */
        .add-custom-tab-pane {
            display: none;
        }

        .add-custom-tab-pane.active {
            display: block;
            animation: addFadeIn 0.3s ease;
        }

        @keyframes addFadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ===== MODERN FORM STYLING UNTUK SEMUA TAB ===== */
        .kavling-form-group {
            margin-bottom: 1rem;
        }

        .kavling-form-group label {
            font-size: 0.8rem;
            font-weight: 600;
            color: #9a55ff !important;
            margin-bottom: 0.3rem;
            letter-spacing: 0.3px;
            font-family: 'Nunito', sans-serif;
            display: block;
        }

        .kavling-form-control {
            border: 1px solid #e9ecef;
            border-radius: 10px;
            padding: 0.7rem 0.8rem;
            font-size: 0.85rem;
            transition: all 0.2s ease;
            background-color: #ffffff;
            color: #2c2e3f;
            width: 100%;
            font-family: 'Nunito', sans-serif;
        }

        .kavling-form-control:focus {
            border-color: #9a55ff;
            box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.1);
            outline: none;
        }

        select.kavling-form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%239a55ff' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 12px;
            padding-right: 2rem;
        }

        /* ===== MODERN BUTTON STYLING UNTUK SEMUA TAB ===== */
        .kavling-btn {
            font-size: 0.8rem;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            font-family: 'Nunito', sans-serif;
            display: inline-block;
            text-decoration: none;
            cursor: pointer;
            border: none;
            width: 100%;
            text-align: center;
        }

        @media (min-width: 576px) {
            .kavling-btn {
                width: auto;
                padding: 0.5rem 1.2rem;
            }
        }

        .kavling-btn-primary {
            background: linear-gradient(to right, #da8cff, #9a55ff);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.3);
        }

        .kavling-btn-primary:hover {
            background: linear-gradient(to right, #c77cff, #8a45e6);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(154, 85, 255, 0.4);
        }

        .kavling-btn-outline-primary {
            background: transparent;
            border: 1px solid #9a55ff;
            color: #9a55ff;
        }

        .kavling-btn-outline-primary:hover {
            background: linear-gradient(135deg, #9a55ff, #da8cff);
            color: #ffffff;
            border-color: transparent;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.3);
        }

        .kavling-btn-outline-success {
            background: transparent;
            border: 1px solid #28a745;
            color: #28a745;
        }

        .kavling-btn-outline-success:hover {
            background: linear-gradient(135deg, #28a745, #5cb85c);
            color: #ffffff;
            border-color: transparent;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
        }

        .kavling-btn-light {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            color: #2c2e3f;
        }

        .kavling-btn-light:hover {
            background: #e9ecef;
            transform: translateY(-2px);
        }

        .kavling-btn-secondary {
            background: linear-gradient(135deg, #f0f2f5, #e4e6ea);
            border: 1px solid #e9ecef;
            color: #2c2e3f;
        }

        .kavling-btn-secondary:hover {
            background: linear-gradient(135deg, #e4e6ea, #d8dce2);
            transform: translateY(-2px);
            color: #2c2e3f;
        }

        .kavling-btn-success {
            background: linear-gradient(135deg, #28a745, #5cb85c);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
        }

        .kavling-btn-success:hover {
            background: linear-gradient(135deg, #218838, #4cae4c);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(40, 167, 69, 0.4);
        }

        /* ===== MODERN FILE UPLOAD STYLING ===== */
        .kavling-file-upload-modern {
            position: relative;
            width: 100%;
        }

        .kavling-file-upload-modern input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
            z-index: 2;
        }

        .kavling-file-upload-modern .kavling-file-label-modern {
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
            .kavling-file-upload-modern .kavling-file-label-modern {
                flex-direction: row;
                text-align: left;
                gap: 8px;
                padding: 0.75rem 1rem;
                min-height: auto;
            }
        }

        .kavling-file-upload-modern:hover .kavling-file-label-modern {
            border-color: #9a55ff;
            background: linear-gradient(135deg, #f1f0ff, #f8f9fa);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(154, 85, 255, 0.1);
        }

        .kavling-file-upload-modern .kavling-file-label-modern i {
            font-size: 1.6rem;
            color: #9a55ff;
            background: rgba(154, 85, 255, 0.1);
            padding: 8px;
            border-radius: 50%;
        }

        .kavling-file-upload-modern .kavling-file-label-modern .kavling-file-info-modern {
            flex: 1;
            width: 100%;
        }

        .kavling-file-upload-modern .kavling-file-label-modern .kavling-file-info-modern span {
            display: block;
            font-weight: 600;
            color: #2c2e3f;
            font-size: 0.8rem;
            word-break: break-word;
        }

        .kavling-file-upload-modern .kavling-file-label-modern .kavling-file-info-modern small {
            color: #6c7383;
            font-size: 0.65rem;
            display: block;
            margin-top: 2px;
        }

        .kavling-file-upload-modern .kavling-file-label-modern .kavling-file-size {
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
            .kavling-file-upload-modern .kavling-file-label-modern .kavling-file-size {
                margin-top: 0;
            }
        }

        /* Text muted */
        .kavling-text-muted {
            color: #a5b3cb !important;
            font-size: 0.7rem;
            display: block;
            margin-top: 0.2rem;
        }

        /* ===== FILTER SECTION - SAMA PERSIS DENGAN PROPERTI ===== */
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

        /* ===== CARD STYLING - PAKAI BAWAAN BOOTSTRAP ===== */
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

        /* Kolom No - lebih rapat */
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

        .badge.badge-success {
            background: linear-gradient(135deg, #28a745, #5cb85c) !important;
            color: #ffffff;
        }

        .badge.badge-warning {
            background: linear-gradient(135deg, #ffc107, #ffdb6d) !important;
            color: #2c2e3f;
        }

        .badge.badge-primary {
            background: linear-gradient(135deg, #9a55ff, #da8cff) !important;
            color: #ffffff;
        }

        .badge.badge-info {
            background: linear-gradient(135deg, #17a2b8, #5bc0de) !important;
            color: #ffffff;
        }

        /* Action buttons styling */
        .btn-outline-primary,
        .btn-outline-info,
        .btn-outline-danger {
            border: 1px solid;
            padding: 0.4rem 0.75rem;
            font-size: 0.8rem;
        }

        .btn-outline-primary {
            border-color: #9a55ff;
            color: #9a55ff;
        }

        .btn-outline-primary:hover {
            background: linear-gradient(to right, #da8cff, #9a55ff);
            color: white;
        }

        .btn-outline-info {
            border-color: #17a2b8;
            color: #17a2b8;
        }

        .btn-outline-info:hover {
            background: linear-gradient(135deg, #17a2b8, #5bc0de);
            color: white;
        }

        .btn-outline-danger {
            border-color: #dc3545;
            color: #dc3545;
        }

        .btn-outline-danger:hover {
            background: linear-gradient(135deg, #dc3545, #e4606d);
            color: white;
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
        }

        /* DataTables Custom Styling - Sembunyikan elemen yang tidak diinginkan */
        .dataTables_filter,
        .dataTables_length,
        .dataTables_paginate,
        .dataTables_info {
            display: none !important;
        }

        /* Tetap tampilkan sorting indicator */
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
    </style>

    <div class="container-fluid p-4">
        <!-- Header - CARD TERPISAH -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-1 fw-bold text-dark">
                                <i class="mdi mdi-pencil-ruler me-2" style="color: #9a55ff;"></i>
                                Buat Kavling / Master Unit
                            </h4>
                            <p class="mb-0 text-muted small">
                                <i class="mdi mdi-information-outline me-1"></i>
                                Buat unit-unit kavling dari tanah yang sudah diverifikasi
                            </p>
                        </div>
                        <div class="d-none d-sm-block">
                            <i class="mdi mdi-pencil-ruler" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Info Tanah Induk -->
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">
                            <i class="mdi mdi-office-building text-primary me-2"></i>
                            Informasi Tanah Induk
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            {{-- Nama Tanah / Proyek --}}
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="text-muted small">
                                        <i class="mdi mdi-home me-1"></i>Nama Tanah / Proyek
                                    </label>
                                    <p class="fw-bold">{{ $land->name ?? '-' }}</p>
                                </div>
                            </div>

                            {{-- Luas Total Tanah --}}
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="text-muted small">
                                        <i class="mdi mdi-ruler-square me-1"></i>Luas Total Tanah
                                    </label>
                                    <p class="fw-bold">{{ number_format($land->area ?? 0, 0, ',', '.') }} m²</p>
                                </div>
                            </div>

                            {{-- Sisa Luas Belum Dikavling --}}
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="text-muted small">
                                        <i class="mdi mdi-chart-arc me-1"></i>Sisa Luas Belum Dikavling
                                    </label>
                                    <p class="fw-bold text-primary">
                                        {{ number_format($land->remaining_area ?? ($land->area ?? 0), 0, ',', '.') }} m²
                                    </p>
                                </div>
                            </div>

                            {{-- Status Legal --}}
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="text-muted small">
                                        <i class="mdi mdi-gavel me-1"></i>Status Legal
                                    </label>
                                    @if ($land->legal_status == 'terverifikasi')
                                        <p class="fw-bold"><span class="badge badge-success"><i
                                                    class="mdi mdi-check-circle me-1"></i>Terverifikasi</span></p>
                                    @else
                                        <p class="fw-bold"><span class="badge badge-warning"><i
                                                    class="mdi mdi-clock-outline me-1"></i>{{ ucfirst($land->legal_status) ?? '-' }}</span>
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Lokasi --}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-2">
                                    <label class="text-muted small">
                                        <i class="mdi mdi-map-marker me-1"></i>Lokasi
                                    </label>
                                    <p class="fw-bold">
                                        <i class="mdi mdi-map-marker text-danger me-1"></i>
                                        {{ $land->address ?? '-' }},
                                        Kel. {{ $land->village ?? '-' }},
                                        Kec. {{ $land->district ?? '-' }},
                                        {{ $land->city ?? '-' }},
                                        {{ $land->province ?? '-' }}
                                        {{ $land->postal_code ?? '' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Progress Steps -->
        <div class="row">
            <div class="col-12 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <span class="text-success"><i class="mdi mdi-check-circle me-1"></i>Input Tanah</span>
                            <span class="text-success"><i class="mdi mdi-check-circle me-1"></i>Verifikasi Legal</span>
                            <span class="text-primary"><i class="mdi mdi-progress-clock me-1"></i>Buat Kavling</span>
                            <span class="text-muted"><i class="mdi mdi-circle-outline me-1"></i>Siap Jual</span>
                        </div>
                        <div class="progress mt-2" style="height: 6px;">
                            <div class="progress-bar bg-success" style="width: 50%"></div>
                            <div class="progress-bar bg-primary" style="width: 25%"></div>
                        </div>
                        <p class="text-muted small mt-2">
                            <i class="mdi mdi-information-outline me-1"></i>
                            Tahap 3 dari 4: Buat Kavling / Master Unit
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pilihan Metode Pembuatan Kavling -->
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">
                            <i class="mdi mdi-tools me-2 text-primary"></i>
                            Metode Pembuatan Kavling
                        </h5>
                    </div>
                    <div class="card-body">
                        <!-- Custom Tabs -->
                        <div class="add-custom-tabs-wrapper overflow-auto mb-3">
                            <ul class="add-custom-tabs" id="myTab" role="tablist">
                                <li class="add-custom-tab-item">
                                    <a class="add-custom-tab-link active" id="manual-tab" data-toggle="tab"
                                        href="#manual" role="tab" aria-controls="manual" aria-selected="true">
                                        <i class="mdi mdi-pencil"></i>
                                        <span>Manual Satu per Satu</span>
                                    </a>
                                </li>

                                <li class="add-custom-tab-item">
                                    <a class="add-custom-tab-link" id="import-tab" data-toggle="tab" href="#import"
                                        role="tab" aria-controls="import" aria-selected="false">
                                        <i class="mdi mdi-import"></i>
                                        <span>Import Excel</span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <!-- Tab Content -->
                        <div class="tab-content mt-3 mt-md-4" id="myTabContent">
                            <!-- TAB MANUAL -->
                            <div class="add-custom-tab-pane active" id="manual" role="tabpanel"
                                aria-labelledby="manual-tab">
                                <form action="{{ route('properti.storeKavling', $land->id) }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="kavling-form-group">
                                                <label>Blok / No. Unit</label>
                                                <input type="text" name="block" class="kavling-form-control"
                                                    placeholder="Contoh: A">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="kavling-form-group">
                                                <label>Nomor Unit</label>
                                                <input type="text" name="unit_number" class="kavling-form-control"
                                                    placeholder="1">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="kavling-form-group">
                                                <label>Type Unit</label>
                                                <select name="type" class="kavling-form-control">
                                                    <option value="">-- Pilih Type --</option>
                                                    <option value="subsidi">Subsidi</option>
                                                    <option value="komersil">Komersil</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="kavling-form-group">
                                                <label>Nama Unit</label>
                                                <input type="text" name="unit_name" class="kavling-form-control"
                                                    placeholder="Cluster Mawar">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="kavling-form-group">
                                                <label>Luas (m²)</label>
                                                <input type="number" name="area" class="kavling-form-control"
                                                    placeholder="200">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="kavling-form-group">
                                                <label>Luas Bangunan(m²)</label>
                                                <input type="number" name="building_area" class="kavling-form-control"
                                                    placeholder="200">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="kavling-form-group">
                                                <label>Harga (Rp)</label>
                                                <input type="text" name="price" class="kavling-form-control"
                                                    placeholder="500.000.000">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="kavling-form-group">
                                                <label>Harga IJB (Rp)</label>
                                                <input type="text" name="ijb_price" class="kavling-form-control"
                                                    placeholder="500.000.000">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="kavling-form-group">
                                                <label>Harga AJB (Rp)</label>
                                                <input type="text" name="ajb_price" class="kavling-form-control"
                                                    placeholder="500.000.000">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="kavling-form-group">
                                                <label>Hadap</label>
                                                <select name="facing" class="kavling-form-control">
                                                    <option>Utara</option>
                                                    <option>Selatan</option>
                                                    <option>Timur</option>
                                                    <option>Barat</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="kavling-form-group">
                                                <label>Posisi</label>
                                                <select name="position" class="kavling-form-control">
                                                    <option>Hook</option>
                                                    <option>Tengah</option>
                                                    <option>Sudut</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <div class="kavling-form-group">
                                                <label>Keterangan</label>
                                                <input type="text" name="description" class="kavling-form-control"
                                                    placeholder="Opsional">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <button type="submit" class="kavling-btn kavling-btn-primary">
                                                <i class="mdi mdi-plus me-1"></i>Tambah Unit ke Daftar
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- TAB IMPORT EXCEL -->
                            <div class="add-custom-tab-pane" id="import" role="tabpanel"
                                aria-labelledby="import-tab">
                                <div class="text-center py-4">
                                    <i class="mdi mdi-file-excel text-success" style="font-size: 48px;"></i>
                                    <h5 class="mt-3">Import Data Kavling dari Excel</h5>
                                    <p class="text-muted">
                                        <i class="mdi mdi-information-outline me-1"></i>
                                        Download template Excel, isi data unit, lalu upload kembali
                                    </p>

                                    <div class="row justify-content-center">
                                        <div class="col-md-6">
                                            <div class="kavling-form-group">
                                                <label>Download Template</label>
                                                <div>
                                                    <a href="{{ route('kavling.template') }}"
                                                        class="kavling-btn kavling-btn-outline-success">
                                                        <i class="mdi mdi-download me-1"></i>Template Kavling.xlsx
                                                    </a>
                                                </div>
                                            </div>
                                            <form action="{{ route('kavling.import', $land->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf


                                                <div class="kavling-form-group">
                                                    <label>Upload File Excel</label>

                                                    <div class="kavling-file-upload-modern position-relative">

                                                        <!-- Input Asli (Hidden) -->
                                                        <input type="file" id="uploadExcel" name="file"
                                                            accept=".xlsx,.xls" required
                                                            style="opacity:0; position:absolute; inset:0; cursor:pointer;">

                                                        <!-- UI Custom -->
                                                        <div
                                                            class="kavling-file-label-modern text-center p-4 border rounded">
                                                            <i class="mdi mdi-cloud-upload" style="font-size:32px;"></i>
                                                            <div class="kavling-file-info-modern mt-2">
                                                                <span id="fileName">Upload File Excel</span>
                                                                <small class="d-block text-muted">
                                                                    Format: .xlsx, .xls (Max 5MB)
                                                                </small>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <button class="kavling-btn kavling-btn-primary" type="submit"
                                                    id="importButton" disabled>
                                                    <i class="mdi mdi-import me-1"></i>Import Data
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Unit yang Akan Dibuat - FOKUS BAGIAN TABEL DENGAN FILTER -->
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">
                            <i class="mdi mdi-format-list-bulleted me-2 text-primary"></i>
                            Daftar Unit Kavling
                        </h5>
                        <span class="badge badge-primary"><i class="mdi mdi-counter me-1"></i>{{ $land->units->count() }}
                            unit</span>
                    </div>
                    <div class="card-body">
                        <!-- FILTER SECTION - SAMA PERSIS SEPERTI SEBELUMNYA -->
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
                                                        placeholder="Cari blok/unit...">
                                                </div>
                                            </div>

                                            <!-- Baris 2: Type & Posisi -->
                                            <div class="row filter-row">
                                                <div class="col-6">
                                                    <label class="form-label">
                                                        <i class="mdi mdi-shape-outline me-1"></i>Type
                                                    </label>
                                                    <select id="filterTypeMobile" class="form-control">
                                                        <option value="">Semua</option>
                                                        @foreach ($land->units->pluck('type')->unique() as $type)
                                                            @if ($type)
                                                                <option value="{{ $type }}">{{ $type }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label">
                                                        <i class="mdi mdi-map-marker me-1"></i>Posisi
                                                    </label>
                                                    <select id="filterPosisiMobile" class="form-control">
                                                        <option value="">Semua</option>
                                                        @foreach ($land->units->pluck('position')->unique() as $position)
                                                            @if ($position)
                                                                <option value="{{ $position }}">{{ $position }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Baris 3: Hadap & Tampil -->
                                            <div class="row filter-row">
                                                <div class="col-6">
                                                    <label class="form-label">
                                                        <i class="mdi mdi-compass me-1"></i>Hadap
                                                    </label>
                                                    <select id="filterHadapMobile" class="form-control">
                                                        <option value="">Semua</option>
                                                        @foreach ($land->units->pluck('facing')->unique() as $facing)
                                                            @if ($facing)
                                                                <option value="{{ $facing }}">{{ $facing }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
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
                                            <div class="row g-2 align-items-end filter-row">
                                                <div class="col-md-3">
                                                    <label class="form-label">
                                                        <i class="mdi mdi-magnify me-1"></i>Pencarian
                                                    </label>
                                                    <input type="text" id="searchInput" class="form-control"
                                                        placeholder="Cari blok/unit...">
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">
                                                        <i class="mdi mdi-shape-outline me-1"></i>Type
                                                    </label>
                                                    <select id="filterType" class="form-control">
                                                        <option value="">Semua</option>
                                                        @foreach ($land->units->pluck('type')->unique() as $type)
                                                            @if ($type)
                                                                <option value="{{ $type }}">{{ $type }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">
                                                        <i class="mdi mdi-map-marker me-1"></i>Posisi
                                                    </label>
                                                    <select id="filterPosisi" class="form-control">
                                                        <option value="">Semua</option>
                                                        @foreach ($land->units->pluck('position')->unique() as $position)
                                                            @if ($position)
                                                                <option value="{{ $position }}">{{ $position }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">
                                                        <i class="mdi mdi-compass me-1"></i>Hadap
                                                    </label>
                                                    <select id="filterHadap" class="form-control">
                                                        <option value="">Semua</option>
                                                        @foreach ($land->units->pluck('facing')->unique() as $facing)
                                                            @if ($facing)
                                                                <option value="{{ $facing }}">{{ $facing }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-1">
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
                                                    <label class="form-label" style="visibility: hidden;">Filter</label>
                                                    <button type="button" id="filterData"
                                                        class="btn btn-gradient-primary w-100 btn-filter-reset">
                                                        <i class="mdi mdi-filter-outline"></i>
                                                    </button>
                                                </div>
                                                <div class="col-md-1">
                                                    <label class="form-label" style="visibility: hidden;">Reset</label>
                                                    <button type="button" id="resetFilter"
                                                        class="btn btn-gradient-secondary w-100 btn-filter-reset">
                                                        <i class="mdi mdi-refresh"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tabel Data dengan Icon LENGKAP - KOLOM DIGABUNG -->
                        <div class="table-responsive">
                            <table id="tableKavling" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center"><i class="mdi mdi-counter me-1"></i>No</th>
                                        <th><i class="mdi mdi-home me-1"></i>Unit</th> {{-- GABUNGAN Blok + No Unit --}}
                                        <th><i class="mdi mdi-format-list-bulleted me-1"></i>Tipe / Nama</th>
                                        {{-- GABUNGAN Type + Nama Unit --}}
                                        <th><i class="mdi mdi-ruler-square me-1"></i>Luas Tanah</th>
                                        <th><i class="mdi mdi-domain me-1"></i>Luas Bangunan</th>
                                        <th><i class="mdi mdi-currency-usd me-1"></i>Harga</th>
                                        <th><i class="mdi mdi-file-document me-1"></i>Harga IJB</th>
                                        <th><i class="mdi mdi-file-document me-1"></i>Harga AJB</th>
                                        <th><i class="mdi mdi-compass me-1"></i>Hadap / Posisi</th> {{-- GABUNGAN Hadap + Posisi --}}
                                        <th class="text-center"><i class="mdi mdi-cog me-1"></i>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($units as $i => $unit)
                                        <tr>
                                            <td class="text-center fw-bold">
                                                <span
                                                    class="badge bg-light text-dark">{{ $units->firstItem() + $i }}</span>
                                            </td>

                                            {{-- GABUNGAN 1: BLOK + NO UNIT (contoh: A.1) --}}
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-home text-primary me-2"></i>
                                                    <span class="fw-bold">
                                                        @php
                                                            $blok =
                                                                $unit->block ??
                                                                (explode('.', $unit->unit_code)[0] ?? '-');
                                                            $nomor =
                                                                $unit->unit_number ??
                                                                (explode('.', $unit->unit_code)[1] ?? '-');
                                                        @endphp
                                                        {{ $blok }}.{{ $nomor }}
                                                    </span>
                                                </div>
                                            </td>

                                            <td>
                                                <div style="display: flex; flex-direction: column;">
                                                    <span style="font-weight: 600; color: #2c2e3f;">
                                                        <i class="mdi mdi-home-city text-primary me-1"
                                                            style="font-size: 0.8rem;"></i>
                                                        {{ $unit->unit_name ?? '-' }}
                                                    </span>
                                                    <span style="font-size: 0.9rem; color: #6c757d; margin-top: 2px;">
                                                        <i class="mdi mdi-format-list-bulleted text-info me-1"
                                                            style="font-size: 0.7rem;"></i>
                                                        {{ ucfirst($unit->type ?? '-') }}
                                                    </span>
                                                </div>
                                            </td>
                                            {{-- LUAS TANAH --}}
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-ruler-square text-warning me-2"></i>
                                                    <span>{{ number_format($unit->area, 0, ',', '.') }} m²</span>
                                                </div>
                                            </td>

                                            {{-- LUAS BANGUNAN --}}
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-domain text-secondary me-2"></i>
                                                    <span>{{ number_format($unit->building_area ?? 0, 0, ',', '.') }}
                                                        m²</span>
                                                </div>
                                            </td>

                                            {{-- HARGA --}}
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-currency-usd text-success me-2"></i>
                                                    <span>Rp {{ number_format($unit->price ?? 0, 0, ',', '.') }}</span>
                                                </div>
                                            </td>

                                            {{-- HARGA IJB --}}
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-file-document text-info me-2"></i>
                                                    <span>Rp {{ number_format($unit->ijb_price ?? 0, 0, ',', '.') }}</span>
                                                </div>
                                            </td>

                                            {{-- HARGA AJB --}}
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-file-document text-primary me-2"></i>
                                                    <span>Rp {{ number_format($unit->ajb_price ?? 0, 0, ',', '.') }}</span>
                                                </div>
                                            </td>

                                            {{-- GABUNGAN 3: HADAP + POSISI --}}
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-compass text-info me-2"></i>
                                                    <span>
                                                        @if ($unit->facing || $unit->position)
                                                            {{ $unit->facing ?? '-' }} / {{ $unit->position ?? '-' }}
                                                        @else
                                                            -
                                                        @endif
                                                    </span>
                                                </div>
                                            </td>

                                            {{-- AKSI --}}
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ route('properti.kavling.edit', ['unit' => $unit->id]) }}"
                                                        class="btn btn-outline-primary btn-sm" title="Edit">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </a>

                                                    <a href="{{ route('properti.progress', ['land_bank_id' => $unit->land_bank_id]) }}"
                                                        class="btn btn-outline-info btn-sm" title="Update Progress">
                                                        <i class="mdi mdi-progress-clock"></i>
                                                    </a>

                                                    <form
                                                        action="{{ route('properti.kavling.destroy', ['unit' => $unit->id]) }}"
                                                        method="POST" style="display:inline-block;"
                                                        onsubmit="return confirm('Hapus unit {{ $unit->unit_code }}?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-outline-danger btn-sm" title="Hapus">
                                                            <i class="mdi mdi-delete"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-center py-4">
                                                <i class="mdi mdi-information-outline me-2"></i>
                                                Belum ada unit kavling
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
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

        <!-- Ringkasan -->
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card bg-light">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="mdi mdi-chart-pie me-2" style="color: #9a55ff;"></i>
                            Ringkasan Kavling
                        </h5>
                        @php
                            $totalUnits = $land->units->count();
                            $totalArea = $land->units->sum('area');
                            $sisaLuas = max(0, $land->remaining_area ?? $land->area - $totalArea);
                            $totalNilai = $land->units->sum('price');

                            $map = [
                                'belum_mulai' => 0,
                                'pondasi' => 20,
                                'dinding' => 40,
                                'atap' => 60,
                                'finishing' => 80,
                                'selesai' => 100,
                            ];

                            $unitProgress = $land->units->map(function ($unit) use ($map) {
                                $status = strtolower($unit->construction_progress ?? 'belum_mulai');
                                return $map[$status] ?? 0;
                            });

                            $progressPercent = $unitProgress->count() > 0 ? $unitProgress->avg() : 0;
                        @endphp

                        <div class="row">
                            <div class="col-6">
                                <p class="text-muted mb-1"><i class="mdi mdi-counter me-1"></i>Total Unit</p>
                                <h4>{{ $totalUnits }} unit</h4>
                            </div>
                            <div class="col-6">
                                <p class="text-muted mb-1"><i class="mdi mdi-ruler-square me-1"></i>Total Luas</p>
                                <h4>{{ number_format($totalArea, 0, ',', '.') }} m²</h4>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-6">
                                <p class="text-muted mb-1"><i class="mdi mdi-chart-arc me-1"></i>Sisa Luas Tanah</p>
                                <h4>{{ number_format($sisaLuas, 0, ',', '.') }} m²</h4>
                            </div>
                            <div class="col-6">
                                <p class="text-muted mb-1"><i class="mdi mdi-currency-usd me-1"></i>Nilai Total</p>
                                <h4>Rp {{ number_format($totalNilai, 0, ',', '.') }}</h4>
                            </div>
                        </div>

                        <div class="mt-4">
                            <p class="text-muted mb-1"><i class="mdi mdi-progress-clock me-1"></i>Progress Pembangunan</p>
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar"
                                    style="width: {{ $progressPercent }}%;" aria-valuenow="{{ $progressPercent }}"
                                    aria-valuemin="0" aria-valuemax="100">
                                    {{ number_format($progressPercent, 0) }}%
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Denah Sederhana Dinamis -->
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">
                            <i class="mdi mdi-map me-2 text-primary"></i>
                            Denah Kavling
                        </h5>
                    </div>

                    <div class="card-body text-center">
                        <div style="background-color:#f8f9fa; padding:20px; border-radius:8px;">

                            <div style="display:flex; flex-wrap:wrap; justify-content:center; gap:10px;">

                                @php
                                    $allUnits = $land->units;

                                    $blokKavlings = [];
                                    foreach ($allUnits as $unit) {
                                        $blok = explode('.', $unit->unit_code)[0];
                                        $blokKavlings[$blok][] = $unit;
                                    }

                                    $allBloks = array_keys($blokKavlings);
                                @endphp

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

                                        <strong>
                                            Blok {{ $blok }} - {{ $labelType }}
                                        </strong>

                                        <div
                                            style="display:flex; flex-wrap:wrap; gap:6px; justify-content:center; margin-top:6px;">

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

                                                    $bgColor = '#6c757d';
                                                    $icon = 'close';
                                                    $borderStyle = 'none';
                                                    $extraStyle = '';
                                                    $typeBadge = '';
                                                    if ($unitFound) {
                                                        // =========================
                                                        // WARNA BERDASARKAN STATUS
                                                        // =========================
                                                        switch ($unitFound->status) {
                                                            case 'sold':
                                                                $bgColor = '#dc3545';
                                                                $icon = 'check';
                                                                break;

                                                            case 'booked':
                                                                $bgColor = '#ffc107';
                                                                $icon = 'clock';
                                                                break;

                                                            case 'draft':
                                                                $bgColor = '#343a40';
                                                                $icon = 'pencil';
                                                                break;

                                                            case 'ready':
                                                                if ($unitFound->type == 'subsidi') {
                                                                    $bgColor = '#28a745';
                                                                    $typeBadge = 'S';
                                                                } else {
                                                                    $bgColor = '#0d6efd';
                                                                    $typeBadge = 'K';
                                                                }
                                                                $icon = 'home';
                                                                break;
                                                        }

                                                        // =========================
                                                        // BORDER SELALU IKUT PROGRESS
                                                        // =========================
                                                        switch ($unitFound->construction_progress) {
                                                            case 'belum_mulai':
                                                                $borderStyle = '2px dashed #000';
                                                                $extraStyle = 'background-image: repeating-linear-gradient(
                                                                45deg,
                                                                rgba(255,255,255,0.2),
                                                                rgba(255,255,255,0.2) 5px,
                                                                transparent 5px,
                                                                transparent 10px
                                                            );';
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

                                                <span
                                                    style="
                                        background-color: {{ $bgColor }};
                                        color:white;
                                        padding:6px 10px;
                                        border-radius:4px;
                                        font-size:12px;
                                        border: {{ $borderStyle }};
                                        {{ $extraStyle }}
                                        position:relative;
                                        min-width:60px;
                                        display:inline-block;
                                    ">

                                                    @if ($typeBadge)
                                                        <small
                                                            style="
                                                position:absolute;
                                                top:-6px;
                                                right:-6px;
                                                background:#000;
                                                color:#fff;
                                                font-size:9px;
                                                padding:2px 4px;
                                                border-radius:50%;
                                            ">
                                                            {{ $typeBadge }}
                                                        </small>
                                                    @endif

                                                    <i class="mdi mdi-{{ $icon }} me-1"></i>
                                                    {{ $blok . '.' . $i }}
                                                </span>
                                            @endfor

                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- LEGEND -->
                            <div class="mt-4 text-start">

                                <h6>Status Penjualan:</h6>
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="badge bg-danger">Sold</span>
                                    <span class="badge bg-warning text-dark">Booked</span>
                                    <span class="badge bg-dark">Draft</span>
                                    <span class="badge bg-success">Ready - Subsidi</span>
                                    <span class="badge bg-primary">Ready - Komersil</span>
                                </div>

                                <h6>Progress Pembangunan (Border):</h6>
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span style="border:2px dashed #000; padding:4px 8px;">Belum Mulai</span>
                                    <span style="border:2px solid #000; padding:4px 8px;">Pondasi</span>
                                    <span style="border:3px solid #000; padding:4px 8px;">Dinding</span>
                                    <span style="border:3px double #000; padding:4px 8px;">Atap</span>
                                    <span style="border:3px groove #000; padding:4px 8px;">Finishing</span>
                                    <span style="border:3px solid #155724; padding:4px 8px;">Selesai</span>
                                </div>

                                <h6>Tipe Unit:</h6>
                                <div class="d-flex gap-2">
                                    <span class="badge bg-success">S = Subsidi</span>
                                    <span class="badge bg-primary">K = Komersil</span>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ url('/properti/verifikasi-legal') }}" class="kavling-btn kavling-btn-light me-2">
                                <i class="mdi mdi-arrow-left me-1"></i>Kembali
                            </a>
                            <button class="kavling-btn kavling-btn-secondary"
                                onclick="alert('Draft kavling berhasil disimpan')">
                                <i class="mdi mdi-content-save me-1"></i>Simpan Draft
                            </button>
                        </div>
                        <div class="d-flex flex-wrap gap-2">
                            <button class="kavling-btn kavling-btn-success" onclick="alert('Kavling berhasil disimpan.')">
                                <i class="mdi mdi-check-circle me-1"></i>Simpan Kavling
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('uploadExcel').addEventListener('change', function(e) {

            const file = e.target.files[0];
            const button = document.getElementById('importButton');
            const fileNameSpan = document.getElementById('fileName');

            if (!file) {
                button.disabled = true;
                fileNameSpan.innerText = "Upload File Excel";
                return;
            }

            // Validasi size max 5MB
            if (file.size > 5 * 1024 * 1024) {
                alert("File maksimal 5MB!");
                e.target.value = "";
                button.disabled = true;
                fileNameSpan.innerText = "Upload File Excel";
                return;
            }

            fileNameSpan.innerText = file.name;
            button.disabled = false;
        });
    </script>
    <script>
        $(document).ready(function() {
            // Simple Tab Functionality
            $('.add-custom-tab-link').on('click', function(e) {
                e.preventDefault();

                $('.add-custom-tab-link').removeClass('active');
                $('.add-custom-tab-pane').removeClass('active');

                $(this).addClass('active');
                var target = $(this).attr('href');
                $(target).addClass('active');
            });

            // CEK APAKAH TABEL MEMILIKI DATA
            let hasData = false;
            $('#tableKavling tbody tr').each(function() {
                let rowText = $(this).text();
                if (rowText && !rowText.includes('Belum ada unit kavling')) {
                    hasData = true;
                }
            });

            // Hancurkan instance DataTables jika sudah ada
            if ($.fn.DataTable.isDataTable('#tableKavling')) {
                $('#tableKavling').DataTable().destroy();
            }

            // HANYA inisialisasi DataTables JIKA ADA DATA
            if (hasData) {
                console.log('Data ditemukan, menginisialisasi DataTables');
                let table = $('#tableKavling').DataTable({
                    responsive: true,
                    paging: false,
                    info: false,
                    searching: false,
                    lengthChange: false,
                    ordering: true,
                    language: {
                        emptyTable: "Belum ada unit kavling",
                        zeroRecords: "Data tidak ditemukan",
                    },
                    columnDefs: [{
                            targets: 0,
                            orderable: false
                        }, // Kolom No
                        {
                            targets: 9,
                            orderable: false
                        } // Kolom Aksi (index ke-9)
                    ]
                });
            } else {
                console.log('Tabel kosong, DataTables tidak diinisialisasi');
            }

            // ===== FORMAT RUPIAH UNTUK INPUT HARGA =====
            // Format tampilan Rupiah saat mengetik
            $('input[name="price"], input[name="ijb_price"], input[name="ajb_price"]').on('keyup', function() {
                let nilai = this.value.replace(/\D/g, '');
                if (nilai) {
                    // Batasi panjang karakter untuk block (misal block max 5)
                    let fieldName = $(this).attr('name');
                    if (fieldName === 'block' && nilai.length > 5) {
                        // Block max 5 karakter
                        this.value = this.value.substring(0, 5);
                        return;
                    }

                    let rupiah = new Intl.NumberFormat('id-ID').format(nilai);
                    this.value = rupiah;
                }
            });

            // Sebelum form disubmit, ubah format Rupiah ke angka biasa
            $('form').on('submit', function() {
                $('input[name="price"], input[name="ijb_price"], input[name="ajb_price"]').each(function() {
                    let nilai = $(this).val().replace(/\./g, ''); // Hapus semua titik
                    $(this).val(nilai); // Set ke angka asli (misal 5000000)
                });

                // Debug: lihat nilai yang dikirim
                console.log('Form submitted dengan nilai:');
                console.log('price:', $('input[name="price"]').val());
                console.log('ijb_price:', $('input[name="ijb_price"]').val());
                console.log('ajb_price:', $('input[name="ajb_price"]').val());

                return true; // Lanjutkan submit
            });

            // Validasi block field (max 5 karakter)
            $('input[name="block"]').on('keyup', function() {
                let nilai = $(this).val();
                if (nilai.length > 5) {
                    $(this).val(nilai.substring(0, 5));
                    alert('Blok maksimal 5 karakter');
                }
            });

            // Filter functionality (placeholder)
            $('#filterData, #filterDataMobile').on('click', function() {
                alert('Fitur filter sedang dalam pengembangan');
            });

            $('#resetFilter, #resetFilterMobile').on('click', function() {
                $('#searchInput, #searchInputMobile').val('');
                $('#filterType, #filterTypeMobile').val('');
                $('#filterPosisi, #filterPosisiMobile').val('');
                $('#filterHadap, #filterHadapMobile').val('');
                location.reload();
            });
        });
    </script>
@endpush
