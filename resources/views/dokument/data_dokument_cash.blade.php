@extends('layouts.partial.app')

@section('title', 'Pengecekan Dokumen Cash Legal - Property Management App')

@section('content')

    <style>
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
            padding: 0.9rem 1rem;
        }

        .card-body {
            padding: 1rem;
        }

        .card-title {
            font-size: 1rem;
            font-weight: 600;
            color: #9a55ff;
            margin-bottom: 0;
        }

        h3.text-dark {
            font-size: 1.5rem !important;
            font-weight: 700;
            color: #2c2e3f !important;
            margin-bottom: 0.5rem !important;
        }

        .text-primary {
            color: #9a55ff !important;
        }

        .text-muted {
            color: #a5b3cb !important;
        }

        .fw-bold {
            font-weight: 600 !important;
        }

        /* STAT CARD */
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
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(154, 85, 255, 0.12);
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

        .stat-card .stat-icon.total {
            background: linear-gradient(135deg, #667eea, #764ba2);
        }

        .stat-card .stat-icon.aktif {
            background: linear-gradient(135deg, #43e97b, #38f9d7);
        }

        .stat-card .stat-icon.cash {
            background: linear-gradient(135deg, #f093fb, #f5576c);
        }

        .stat-card .stat-icon.kpr {
            background: linear-gradient(135deg, #4facfe, #00f2fe);
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
        }

        .stat-card .stat-content p {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* FILTER */
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

        .form-control,
        .form-select {
            border: 1px solid #e9ecef;
            border-radius: 10px;
            padding: 0.7rem 1rem;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            background-color: #ffffff;
            color: #2c2e3f;
            height: auto;
            min-height: 42px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #9a55ff;
            box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.1);
            outline: none;
        }

        /* BUTTON */
        .btn {
            font-size: 0.9rem;
            padding: 0.7rem 1.2rem;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
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

        /* ACTION BUTTON TABLE */
        .btn-action-outline-purple {
            height: 31px;
            min-width: 78px;
            padding: 0 0.75rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.35rem;
            border-radius: 0.25rem;
            border: 1px solid #9a55ff;
            background: #fff;
            color: #9a55ff;
            font-size: 0.8rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.25s ease;
            white-space: nowrap;
        }

        .btn-action-outline-purple i {
            font-size: 0.95rem;
        }

        .btn-action-outline-purple:hover {
            background: #9a55ff;
            color: #fff;
            border-color: #9a55ff;
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.2);
        }

        .action-cell {
            min-width: 150px;
        }

        .action-group {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            flex-wrap: nowrap;
        }

        .action-group .btn-sm {
            height: 31px;
            min-width: 36px;
            padding: 0 0.65rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .action-group .btn-sm i {
            font-size: 0.95rem;
            line-height: 1;
        }

        /* TABLE */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            border-radius: 8px;
            margin-bottom: 0.5rem;
            scrollbar-width: thin;
            scrollbar-color: #9a55ff #f0f0f0;
        }

        .table-responsive::-webkit-scrollbar {
            width: 8px;
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
            background: #7a3fcc;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0;
        }

        .table thead th {
            background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
            color: #9a55ff;
            font-weight: 700;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            border-bottom: 2px solid #e9ecef;
            padding: 1rem 0.75rem;
            white-space: nowrap;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .table tbody td {
            vertical-align: middle;
            font-size: 0.92rem;
            padding: 1rem 0.75rem;
            border-bottom: 1px solid #e9ecef;
            color: #2c2e3f;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        /* INFO CELL */
        .info-inline {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .info-icon {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f3e8ff, #efe2ff);
            color: #9a55ff;
            border: 1px solid #eadbff;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .initial-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #da8cff, #9a55ff);
            color: #fff;
            font-weight: 700;
            font-size: 0.9rem;
            flex-shrink: 0;
        }

        /* BADGE */
        .badge-kelengkapan {
            padding: 0.45rem 0.9rem;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.8rem;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
        }

        .badge-lengkap {
            background: linear-gradient(135deg, #28c76f, #48da89);
            color: #fff;
        }

        .badge-kurang {
            background: linear-gradient(135deg, #ff9f43, #ffbe76);
            color: #fff;
        }

        .badge-status {
            padding: 0.45rem 0.9rem;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.8rem;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
        }

        .status-pending {
            background: linear-gradient(135deg, #ffc107, #ffda6a);
            color: #2c2e3f;
        }

        .status-siap-pecah {
            background: linear-gradient(135deg, #28c76f, #48da89);
            color: #fff;
        }

        .status-revisi {
            background: linear-gradient(135deg, #ea5455, #f07b7c);
            color: #fff;
        }

        .status-lainnya {
            background: linear-gradient(135deg, #6c757d, #9aa0a6);
            color: #fff;
        }

        .status-komersil {
            background: linear-gradient(135deg, #9a55ff, #c78dff);
            color: #fff;
        }

        .status-subsidi {
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            color: #fff;
        }

        /* PAGINATION */
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
            text-decoration: none;
        }

        .page-item.active .page-link {
            background: linear-gradient(to right, #da8cff, #9a55ff);
            border-color: transparent;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.3);
        }

        .pagination-info {
            font-size: 0.85rem;
            color: #6c7383;
        }

        /* MODAL */
        .modal-content {
            border: none;
            border-radius: 18px;
            overflow: hidden;
        }

        .modal-header {
            background: linear-gradient(135deg, #da8cff, #9a55ff);
            color: white;
            border-bottom: none;
        }

        .modal-header .btn-close {
            filter: brightness(0) invert(1);
        }

        .modal-title {
            font-weight: 700;
        }

        .detail-box {
            background: #f8f9fc;
            border-radius: 12px;
            padding: 1rem;
            border: 1px solid #ececf3;
            height: 100%;
        }

        .detail-label {
            font-size: 0.78rem;
            color: #8a92a6;
            margin-bottom: 0.2rem;
        }

        .detail-value {
            font-size: 0.95rem;
            font-weight: 600;
            color: #2c2e3f;
            word-break: break-word;
        }

        /* MODAL TABLE ACTION */
        .btn-action-purple {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.45rem 0.9rem;
            border-radius: 10px;
            border: 1.5px solid #9a55ff;
            background: #fff;
            color: #9a55ff;
            font-size: 0.82rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.25s ease;
        }

        .btn-action-purple i {
            font-size: 1rem;
        }

        .btn-action-purple:hover {
            background: linear-gradient(135deg, #da8cff, #9a55ff);
            color: #fff;
            border-color: #9a55ff;
            box-shadow: 0 6px 18px rgba(154, 85, 255, 0.22);
            transform: translateY(-2px);
        }

        .doc-name-inline {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
        }

        .doc-file-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f3e8ff, #efe2ff);
            color: #9a55ff;
            font-size: 1.1rem;
            border: 1px solid #eadbff;
            flex-shrink: 0;
        }

        .col-no-small {
            width: 55px;
            min-width: 55px;
            max-width: 55px;
            text-align: center;
        }

        /* RESPONSIVE */
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

            .table thead th,
            .table tbody td {
                font-size: 0.85rem;
                padding: 0.85rem 0.55rem;
            }

            .action-cell {
                min-width: 135px;
            }

            .action-group {
                gap: 4px;
            }

            .btn-action-outline-purple {
                min-width: 72px;
                padding: 0 0.55rem;
                font-size: 0.78rem;
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

        .filter-row-desktop {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .filter-row-desktop .filter-text {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #9a55ff;
            font-weight: 600;
            font-size: 0.95rem;
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

        .table thead th.sortable {
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .table thead th.sortable:hover {
            color: #7a3fcc;
        }

        .table thead th i {
            font-size: 0.8rem;
            margin-left: 4px;
            opacity: 0.5;
        }

        /* ===== MODERN FILE UPLOAD STYLING ===== */
        .properti-file-upload-modern {
            position: relative;
            width: 100%;
        }

        .properti-file-upload-modern input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
            z-index: 2;
        }

        .properti-file-upload-modern .properti-file-label-modern {
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
            .properti-file-upload-modern .properti-file-label-modern {
                flex-direction: row;
                text-align: left;
                gap: 8px;
                padding: 0.75rem 1rem;
                min-height: auto;
            }
        }

        .properti-file-upload-modern:hover .properti-file-label-modern {
            border-color: #9a55ff;
            background: linear-gradient(135deg, #f1f0ff, #f8f9fa);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(154, 85, 255, 0.1);
        }

        .properti-file-upload-modern .properti-file-label-modern i {
            font-size: 1.6rem;
            color: #9a55ff;
            background: rgba(154, 85, 255, 0.1);
            padding: 8px;
            border-radius: 50%;
        }

        .properti-file-upload-modern .properti-file-label-modern .properti-file-info-modern {
            flex: 1;
            width: 100%;
        }

        .properti-file-upload-modern .properti-file-label-modern .properti-file-info-modern span {
            display: block;
            font-weight: 600;
            color: #2c2e3f;
            font-size: 0.8rem;
            word-break: break-word;
        }

        .properti-file-upload-modern .properti-file-label-modern .properti-file-info-modern small {
            color: #6c7383;
            font-size: 0.65rem;
            display: block;
            margin-top: 2px;
        }

        .properti-file-upload-modern .properti-file-label-modern .properti-file-size {
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
            .properti-file-upload-modern .properti-file-label-modern .properti-file-size {
                margin-top: 0;
            }
        }
    </style>

    <div class="container-fluid p-2 p-sm-3 p-md-4">

        <div class="row mb-3 mb-md-4">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="text-dark mb-1">
                                <i class="mdi mdi-file-document-check-outline me-2" style="color: #9a55ff;"></i>
                                Pengecekan Dokumen Cash Legal
                            </h3>
                            <p class="text-muted mb-0">
                                Cek kelengkapan dokumen legal per booking
                            </p>
                        </div>
                        <div class="d-none d-sm-block">
                            <i class="mdi mdi-folder-search-outline"
                                style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- CARD SUMMARY --}}
        <div class="row g-3 mb-4">
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-icon total">
                        <i class="mdi mdi-bookmark-multiple-outline"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ $totalBooking }}</h3>
                        <p>Total Booking</p>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-icon aktif">
                        <i class="mdi mdi-check-circle-outline"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ $lengkap }}</h3>
                        <p>Lengkap</p>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-icon cash">
                        <i class="mdi mdi-alert-circle-outline"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ $kurang }}</h3>
                        <p>Kurang</p>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-icon kpr">
                        <i class="mdi mdi-file-refresh-outline"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ $revisi }}</h3>
                        <p>Perlu Revisi</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- TABLE --}}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center gap-2 flex-wrap">
                        <h5 class="card-title mb-0">
                            <i class="mdi mdi-format-list-bulleted me-2"></i>Daftar Pengecekan Dokumen
                        </h5>
                    </div>

                    <div class="card-body">
                        <div class="filter-card mb-4">
                            <div class="card-body">
                                <!-- DESKTOP VERSION -->
                                <div class="filter-row-desktop">
                                    <div class="filter-text">
                                        <i class="mdi mdi-filter-outline"></i>
                                        <span>Filter data pengecekan</span>
                                    </div>
                                    <form id="filterForm" method="GET" action="{{ route(Route::currentRouteName()) }}">
                                        <div class="row g-2 align-items-end w-100">
                                            <!-- Search -->
                                            <div class="col-md-3">
                                                <label class="form-label">Cari Nama / ID</label>
                                                <input type="text" class="form-control" name="search" id="searchInput"
                                                    placeholder="Nama customer / ID booking..."
                                                    value="{{ request('search') }}">
                                            </div>

                                            <!-- Kelengkapan -->
                                            <div class="col-md-2">
                                                <label class="form-label">Kelengkapan</label>
                                                <select class="form-control" name="kelengkapan" id="kelengkapanSelect">
                                                    <option value="">Semua</option>
                                                    <option value="lengkap"
                                                        {{ request('kelengkapan') == 'lengkap' ? 'selected' : '' }}>Lengkap
                                                    </option>
                                                    <option value="belum_lengkap"
                                                        {{ request('kelengkapan') == 'belum_lengkap' ? 'selected' : '' }}>
                                                        Belum Lengkap</option>
                                                </select>
                                            </div>

                                            <!-- Status -->
                                            <div class="col-md-2">
                                                <label class="form-label">Status</label>
                                                <select class="form-control" name="status" id="statusSelect">
                                                    <option value="">Semua Status</option>
                                                    <option value="siap_pecah"
                                                        {{ request('status') == 'siap_pecah' ? 'selected' : '' }}>Siap Pecah
                                                        Legal Unit</option>
                                                    <option value="revisi"
                                                        {{ request('status') == 'revisi' ? 'selected' : '' }}>Perlu Revisi
                                                    </option>
                                                </select>
                                            </div>

                                            <!-- Jenis -->
                                            <div class="col-md-2">
                                                <label class="form-label">Jenis</label>
                                                <select class="form-control" name="jenis" id="jenisSelect">
                                                    <option value="">Semua</option>
                                                    <option value="komersil"
                                                        {{ request('jenis') == 'komersil' ? 'selected' : '' }}>Komersil
                                                    </option>
                                                    <option value="subsidi"
                                                        {{ request('jenis') == 'subsidi' ? 'selected' : '' }}>Subsidi
                                                    </option>
                                                </select>
                                            </div>

                                            <!-- Tampil -->
                                            <div class="col-md-1">
                                                <label class="form-label">Tampil</label>
                                                <select class="form-control" name="per_page" id="perPageSelect">
                                                    <option value="10"
                                                        {{ request('per_page') == '10' ? 'selected' : '' }}>10</option>
                                                    <option value="15"
                                                        {{ request('per_page') == '15' ? 'selected' : '' }}>15</option>
                                                    <option value="25"
                                                        {{ request('per_page') == '25' ? 'selected' : '' }}>25</option>
                                                </select>
                                            </div>

                                            <!-- Tombol Filter + Reset -->
                                            <div class="col-md-2">
                                                <label class="form-label invisible d-none d-md-block">Aksi</label>
                                                <div class="d-flex gap-2">
                                                    <button type="submit"
                                                        class="btn btn-gradient-primary btn-icon-only flex-fill"
                                                        id="filterBtn" title="Filter" onclick="showFilterLoading()">
                                                        <i class="mdi mdi-filter"></i>
                                                    </button>
                                                    <a href="{{ request()->url() }}"
                                                        class="btn btn-gradient-secondary btn-icon-only flex-fill"
                                                        title="Reset" onclick="showResetLoading(event)">
                                                        <i class="mdi mdi-refresh"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- MOBILE VERSION -->
                                <div class="filter-row-mobile">
                                    <div class="filter-text mb-2">
                                        <i class="mdi mdi-filter-outline"></i>
                                        <span>Filter data pengecekan</span>
                                    </div>
                                    <form method="GET" action="{{ route(Route::currentRouteName()) }}">
                                        <div class="row g-2">
                                            <div class="col-12 mb-2">
                                                <label class="form-label">Cari Nama / ID</label>
                                                <input type="text" class="form-control" name="search"
                                                    id="searchInputMobile" placeholder="Nama customer / ID booking..."
                                                    value="{{ request('search') }}">
                                            </div>
                                            <div class="col-12 mb-2">
                                                <label class="form-label">Kelengkapan</label>
                                                <select class="form-control" name="kelengkapan">
                                                    <option value="">Semua</option>
                                                    <option value="lengkap"
                                                        {{ request('kelengkapan') == 'lengkap' ? 'selected' : '' }}>Lengkap
                                                    </option>
                                                    <option value="belum_lengkap"
                                                        {{ request('kelengkapan') == 'belum_lengkap' ? 'selected' : '' }}>
                                                        Belum Lengkap</option>
                                                </select>
                                            </div>
                                            <div class="col-12 mb-2">
                                                <label class="form-label">Status</label>
                                                <select class="form-control" name="status">
                                                    <option value="">Semua Status</option>
                                                    <option value="siap_pecah"
                                                        {{ request('status') == 'siap_pecah' ? 'selected' : '' }}>Siap
                                                        Pecah Legal Unit</option>
                                                    <option value="revisi"
                                                        {{ request('status') == 'revisi' ? 'selected' : '' }}>Perlu Revisi
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-12 mb-2">
                                                <label class="form-label">Jenis</label>
                                                <select class="form-control" name="jenis">
                                                    <option value="">Semua</option>
                                                    <option value="komersil"
                                                        {{ request('jenis') == 'komersil' ? 'selected' : '' }}>Komersil
                                                    </option>
                                                    <option value="subsidi"
                                                        {{ request('jenis') == 'subsidi' ? 'selected' : '' }}>Subsidi
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-12 mb-2">
                                                <label class="form-label">Tampil</label>
                                                <select class="form-control" name="per_page">
                                                    <option value="10"
                                                        {{ request('per_page') == '10' ? 'selected' : '' }}>10</option>
                                                    <option value="15"
                                                        {{ request('per_page') == '15' ? 'selected' : '' }}>15</option>
                                                    <option value="25"
                                                        {{ request('per_page') == '25' ? 'selected' : '' }}>25</option>
                                                </select>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <div class="d-flex gap-2">
                                                    <button type="submit"
                                                        class="btn btn-gradient-primary btn-icon-only-mobile flex-fill"
                                                        title="Filter" onclick="showFilterLoading()">
                                                        <i class="mdi mdi-filter"></i>
                                                    </button>
                                                    <a href="{{ request()->url() }}"
                                                        class="btn btn-gradient-secondary btn-icon-only-mobile flex-fill"
                                                        title="Reset" onclick="showResetLoading(event)">
                                                        <i class="mdi mdi-refresh"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="sortable" data-field="booking_code"
                                            data-direction="{{ request('sortField') == 'booking_code' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                            ID Booking
                                            @if (request('sortField') == 'booking_code')
                                                <i
                                                    class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                            @else
                                                <i class="mdi mdi-swap-vertical"></i>
                                            @endif
                                        </th>
                                        <th class="sortable" data-field="name"
                                            data-direction="{{ request('sortField') == 'name' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                            Nama Customer
                                            @if (request('sortField') == 'name')
                                                <i
                                                    class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                            @else
                                                <i class="mdi mdi-swap-vertical"></i>
                                            @endif
                                        </th>
                                        <th class="sortable" data-field="unit"
                                            data-direction="{{ request('sortField') == 'unit' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                            Unit
                                            @if (request('sortField') == 'unit')
                                                <i
                                                    class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                            @else
                                                <i class="mdi mdi-swap-vertical"></i>
                                            @endif
                                        </th>
                                        <th>Jenis</th>
                                        <th>Kelengkapan</th>
                                        <th>Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($bookings as $booking)
                                        @php
                                            $requiredDocs = $documents->where('required', true)->count();
                                            $uploadedDocs = $booking->documentUploads
                                                ->whereIn(
                                                    'document_id',
                                                    $documents->where('required', true)->pluck('id'),
                                                )
                                                ->count();

                                            $isLengkap = $uploadedDocs >= $requiredDocs && $requiredDocs > 0;

                                            $customerName = $booking->customer->full_name ?? '-';
                                            $nameParts = explode(' ', trim($customerName));
                                            $initials = strtoupper(
                                                substr($nameParts[0] ?? '', 0, 1) . substr($nameParts[1] ?? '', 0, 1),
                                            );
                                            if (trim($initials) == '') {
                                                $initials = 'NA';
                                            }

                                            $jenisUnit = strtolower(trim($booking->unit->jenis ?? ''));
                                            $modalId = 'detailDokumenModal' . $booking->id;
                                        @endphp
                                        <tr>
                                            <td class="text-center fw-bold">
                                                {{ method_exists($bookings, 'firstItem') ? $bookings->firstItem() + $loop->index : $loop->iteration }}
                                            </td>
                                            <td>
                                                <div class="info-inline">
                                                    <span class="info-icon">
                                                        <i class="mdi mdi-bookmark-outline"></i>
                                                    </span>
                                                    <span class="fw-bold text-primary">{{ $booking->booking_code }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="info-inline">
                                                    <span class="initial-avatar">{{ $initials }}</span>
                                                    <span class="fw-bold">{{ $customerName }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="info-inline">
                                                    <span class="info-icon">
                                                        <i class="mdi mdi-home-city-outline"></i>
                                                    </span>
                                                    <span>
                                                        {{ $booking->unit->unit_name ?? '-' }}
                                                        @if (!empty($booking->unit->type))
                                                            <br>
                                                            <small
                                                                class="text-muted d-inline-flex align-items-center gap-1">
                                                                <i class="mdi mdi-floor-plan"></i>
                                                                {{ $booking->unit->type }}
                                                            </small>
                                                        @endif
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                @if ($jenisUnit == 'komersil' || $jenisUnit == 'komersial')
                                                    <span class="badge-status status-komersil">
                                                        <i class="mdi mdi-storefront-outline"></i>
                                                        Komersil
                                                    </span>
                                                @elseif ($jenisUnit == 'subsidi')
                                                    <span class="badge-status status-subsidi">
                                                        <i class="mdi mdi-home-percent-outline"></i>
                                                        Subsidi
                                                    </span>
                                                @else
                                                    <span class="badge-status status-lainnya">
                                                        <i class="mdi mdi-shape-outline"></i>
                                                        {{ $booking->unit->jenis ?? '-' }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($isLengkap)
                                                    <span class="badge-kelengkapan badge-lengkap">
                                                        <i class="mdi mdi-check-circle-outline"></i>
                                                        Lengkap
                                                    </span>
                                                @else
                                                    <span class="badge-kelengkapan badge-kurang">
                                                        <i class="mdi mdi-alert-circle-outline"></i>
                                                        {{ $uploadedDocs }}/{{ $requiredDocs }} Kurang
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($isLengkap)
                                                    <span class="badge-status status-siap-pecah">
                                                        <i class="mdi mdi-check-decagram-outline"></i>
                                                        Siap Pecah Legal Unit
                                                    </span>
                                                @else
                                                    <span class="badge-status status-pending">
                                                        <i class="mdi mdi-timer-sand"></i>
                                                        Pending
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-center action-cell">
                                                <div class="action-group">
                                                    <button type="button" class="btn-action-outline-purple"
                                                        title="Detail" data-bs-toggle="modal"
                                                        data-bs-target="#{{ $modalId }}">
                                                        <i class="mdi mdi-eye-outline"></i>
                                                        Lihat
                                                    </button>

                                                    @if ($isLengkap)
                                                        {{-- Jika Metode Pembayaran adalah KPR --}}
                                                        @if (strtolower($booking->purchase_type) == 'kpr')
                                                            <a href="{{ route('kpr.approve', $booking->id) }}"
                                                                class="btn btn-warning btn-sm"
                                                                title="Proses Persetujuan KPR">
                                                                <i class="mdi mdi-clipboard-check"></i>
                                                            </a>

                                                            {{-- Jika Metode Pembayaran adalah Cash atau Cash Tempo --}}
                                                        @elseif(in_array(strtolower($booking->purchase_type), ['cash', 'cash_tempo']))
                                                            <a href="{{ route('akad.cash', $booking->id) }}"
                                                                class="btn btn-success btn-sm" title="Proses Akad Cash">
                                                                <i class="mdi mdi-file-sign"></i>
                                                            </a>
                                                        @endif
                                                    @else
                                                        {{-- Jika Dokumen Belum Lengkap (Tombol Abu-abu/Disabled) --}}
                                                        <button class="btn btn-secondary btn-sm" disabled
                                                            title="Dokumen belum lengkap">
                                                            <i class="mdi mdi-file-sign"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center text-muted py-4">Tidak ada data booking
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if ($bookings instanceof \Illuminate\Pagination\LengthAwarePaginator && $bookings->total() > 0)
                            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                                <div class="pagination-info mb-2 mb-sm-0">
                                    Menampilkan {{ $bookings->firstItem() }} - {{ $bookings->lastItem() }} dari
                                    {{ $bookings->total() }} data
                                </div>
                                <nav aria-label="Page navigation">
                                    <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                        {{-- Previous Page Link --}}
                                        @if ($bookings->onFirstPage())
                                            <li class="page-item disabled" aria-disabled="true">
                                                <span class="page-link" aria-label="Previous">
                                                    <i class="mdi mdi-chevron-left"></i>
                                                </span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link"
                                                    href="{{ $bookings->appends(request()->query())->previousPageUrl() }}"
                                                    rel="prev" aria-label="Previous"
                                                    onclick="showPaginationLoading(event)">
                                                    <i class="mdi mdi-chevron-left"></i>
                                                </a>
                                            </li>
                                        @endif

                                        {{-- Pagination Elements --}}
                                        @foreach ($bookings->getUrlRange(max(1, $bookings->currentPage() - 2), min($bookings->lastPage(), $bookings->currentPage() + 2)) as $page => $url)
                                            @if ($page == $bookings->currentPage())
                                                <li class="page-item active" aria-current="page">
                                                    <span class="page-link">{{ $page }}</span>
                                                </li>
                                            @else
                                                <li class="page-item">
                                                    <a class="page-link"
                                                        href="{{ $bookings->appends(request()->query())->url($page) }}"
                                                        onclick="showPaginationLoading(event)">{{ $page }}</a>
                                                </li>
                                            @endif
                                        @endforeach

                                        {{-- Next Page Link --}}
                                        @if ($bookings->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link"
                                                    href="{{ $bookings->appends(request()->query())->nextPageUrl() }}"
                                                    rel="next" aria-label="Next"
                                                    onclick="showPaginationLoading(event)">
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

    {{-- MODAL DETAIL PER BOOKING --}}
    @foreach ($bookings as $booking)
        @php
            $requiredDocs = $documents->where('required', true)->count();
            $uploadedDocs = $booking->documentUploads
                ->whereIn('document_id', $documents->where('required', true)->pluck('id'))
                ->count();

            $isLengkap = $uploadedDocs >= $requiredDocs && $requiredDocs > 0;

            $customerName = $booking->customer->full_name ?? '-';
            $unitName = $booking->unit->unit_name ?? '-';
            $modalId = 'detailDokumenModal' . $booking->id;
            $statusText = $isLengkap ? 'Siap Pecah Legal Unit' : 'Pending';
        @endphp

        <div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="mdi mdi-file-document-outline me-2"></i>Detail Dokumen Booking
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row g-3 mb-4">
                            <div class="col-md-3">
                                <div class="detail-box">
                                    <div class="detail-label">ID Booking</div>
                                    <div class="detail-value">{{ $booking->booking_code }}</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="detail-box">
                                    <div class="detail-label">Nama Customer</div>
                                    <div class="detail-value">{{ $customerName }}</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="detail-box">
                                    <div class="detail-label">Unit</div>
                                    <div class="detail-value">{{ $unitName }}</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="detail-box">
                                    <div class="detail-label">Status</div>
                                    <div class="detail-value">{{ $statusText }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-sm border-0 mb-0">
                            <div class="card-header">
                                <h6 class="mb-0 text-primary">
                                    <i class="mdi mdi-clipboard-text-outline me-2"></i>Daftar Dokumen
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive" style="max-height: unset;">
                                    <table class="table table-hover align-middle mb-0">
                                        <thead>
                                            <tr>
                                                <th class="col-no-small">No</th>
                                                <th>Nama Dokumen</th>
                                                <th class="text-end">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $bookingUploads = $booking->documentUploads->keyBy('document_id');
                                            @endphp

                                            @forelse ($documents as $doc)
                                                @php
                                                    $uploadedFile = $bookingUploads->get($doc->id);
                                                @endphp
                                                <tr>
                                                    <td class="col-no-small fw-bold">{{ $loop->iteration }}</td>
                                                    <td>
                                                        <div class="doc-name-inline">
                                                            <span class="doc-file-icon">
                                                                <i class="mdi mdi-file-document-outline"></i>
                                                            </span>
                                                            <span>{{ $doc->name }}</span>
                                                        </div>
                                                    </td>
                                                    <td class="text-end">
                                                        @if ($uploadedFile && !empty($uploadedFile->file_path))
                                                            <a href="{{ asset('storage/' . $uploadedFile->file_path) }}"
                                                                target="_blank" class="btn-action-purple">
                                                                <i class="mdi mdi-eye-outline"></i>
                                                                Lihat
                                                            </a>
                                                        @else
                                                            <div class="d-flex flex-column gap-1 mt-1 text-end">
                                                                <span class="text-danger small fw-bold mb-1"
                                                                    style="font-size: 0.75rem;"><i
                                                                        class="mdi mdi-alert-circle-outline"></i> Belum
                                                                    Upload</span>
                                                                <div
                                                                    class="d-flex align-items-stretch justify-content-end gap-2">
                                                                    <div class="properti-file-upload-modern text-start"
                                                                        style="width: 240px;">
                                                                        <input type="file"
                                                                            accept=".pdf,.jpg,.jpeg,.png">
                                                                        <div class="properti-file-label-modern m-0 h-100 flex-row text-start"
                                                                            style="padding: 0.4rem 0.6rem; min-height: 42px; justify-content: flex-start; border-radius: 10px;">
                                                                            <i class="mdi mdi-cloud-upload-outline"
                                                                                style="font-size: 1.3rem; padding: 4px; margin-right: 4px; min-width: 30px; text-align: center;"></i>
                                                                            <div class="properti-file-info-modern"
                                                                                style="line-height: 1.2;">
                                                                                <span
                                                                                    style="font-size: 0.75rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 110px;">Pilih
                                                                                    File</span>
                                                                                <small style="font-size: 0.6rem;">Format:
                                                                                    PDF/JPG/PNG</small>
                                                                            </div>
                                                                            <span class="properti-file-size"
                                                                                style="font-size: 0.65rem; padding: 2px 6px; margin: 0 0 0 auto;"></span>
                                                                        </div>
                                                                    </div>
                                                                    <button type="button"
                                                                        class="btn btn-sm btn-gradient-primary text-nowrap d-flex align-items-center justify-content-center"
                                                                        style="padding: 0 1rem; border-radius: 10px; height: auto;">
                                                                        <i class="mdi mdi-upload me-1"></i> Upload
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="text-center text-muted py-4">
                                                        Belum ada dokumen yang bisa ditampilkan
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">
                            <i class="mdi mdi-close me-1"></i>Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // File upload modern preview
            document.querySelectorAll('.properti-file-upload-modern input[type="file"]').forEach(input => {
                input.addEventListener('change', function(e) {
                    const fileName = e.target.files[0]?.name;
                    const fileSize = e.target.files[0]?.size;
                    const label = this.closest('.properti-file-upload-modern').querySelector(
                        '.properti-file-info-modern span');
                    const sizeSpan = this.closest('.properti-file-upload-modern').querySelector(
                        '.properti-file-size');

                    if (fileName) {
                        label.textContent = fileName.length > 30 ? fileName.substring(0, 30) +
                            '...' : fileName;
                        if (fileSize) {
                            const sizeInMB = (fileSize / (1024 * 1024)).toFixed(2);
                            sizeSpan.textContent = sizeInMB + ' MB';
                        }
                    } else {
                        label.textContent = 'Pilih File';
                        sizeSpan.textContent = '';
                    }
                });
            });
        });

        $(document).ready(function() {
            // Sorting functionality
            $('.sortable').click(function() {
                let field = $(this).data('field');
                let direction = $(this).data('direction');

                Swal.fire({
                    title: 'Memuat...',
                    html: 'Sedang mengurutkan data',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                let url = new URL(window.location.href);
                url.searchParams.set('sortField', field);
                url.searchParams.set('sortDirection', direction);
                url.searchParams.set('page', 1);

                window.location.href = url.toString();
            });
        });

        function showFilterLoading() {
            Swal.fire({
                title: 'Memuat...',
                html: 'Sedang memfilter data',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            return true;
        }

        function showResetLoading(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Memuat...',
                html: 'Mengembalikan data awal',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            window.location.href = event.currentTarget.href;
        }

        function showPaginationLoading(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Memuat...',
                html: 'Berpindah halaman',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            window.location.href = event.currentTarget.href;
        }
    </script>
@endpush
