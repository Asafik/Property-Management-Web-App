@extends('layouts.partial.app')

@section('title', 'Marketing Jual Unit - Property Management App')

@section('content')
    <style>
        /* ===== CSS DARI UI KEDUA (TETAP) ===== */
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
        @media (min-width: 576px) { .card-header { padding: 1rem; } }
        @media (min-width: 768px) { .card-header { padding: 1.2rem; } }
        .card-body {
            padding: 0.75rem;
        }
        @media (min-width: 576px) { .card-body { padding: 1rem; } }
        @media (min-width: 768px) { .card-body { padding: 1.2rem; } }
        .card-title {
            font-size: 0.9rem;
            font-weight: 600;
            color: #9a55ff;
            margin-bottom: 0;
        }
        @media (min-width: 576px) { .card-title { font-size: 1rem; } }
        @media (min-width: 768px) { .card-title { font-size: 1.1rem; } }

        /* ===== STATISTICS CARDS ===== */
        .stat-card {
            background: linear-gradient(135deg, #ffffff, #f8f9fa);
            border-radius: 16px;
            padding: 1.2rem;
            height: 100%;
            display: flex;
            align-items: center;
            gap: 1rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            border: none;
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
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
        .stat-card .stat-icon.total-unit { background: linear-gradient(135deg, #667eea, #764ba2); }
        .stat-card .stat-icon.tersedia { background: linear-gradient(135deg, #43e97b, #38f9d7); }
        .stat-card .stat-icon.booking { background: linear-gradient(135deg, #f6d365, #fda085); }
        .stat-card .stat-icon.terjual { background: linear-gradient(135deg, #f093fb, #f5576c); }
        .stat-card .stat-content { flex: 1; min-width: 0; }
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
        }
        @media (max-width: 768px) {
            .stat-card { padding: 1rem; gap: 0.75rem; }
            .stat-card .stat-icon { width: 45px; height: 45px; font-size: 1.4rem; }
            .stat-card .stat-content h3 { font-size: 1.3rem; }
            .stat-card .stat-content p { font-size: 0.75rem; }
        }

        /* ===== FILTER SECTION ===== */
        .filter-card {
            background: linear-gradient(135deg, #f9f7ff, #f2ecff);
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.25rem;
        }
        .filter-card .card-body { padding: 1rem !important; }
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
        .form-control, .form-select {
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 0.6rem 0.8rem;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            background-color: #ffffff;
            color: #2c2e3f;
            height: 40px;
        }
        .form-control:focus, .form-select:focus {
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
        }

        /* Button Styling */
        .btn {
            font-size: 0.85rem;
            padding: 0.6rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
        }
        .btn:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1); }
        .btn-sm { padding: 0.35rem 0.7rem; font-size: 0.8rem; border-radius: 6px; height: 32px; }
        .btn-gradient-primary { background: linear-gradient(to right, #da8cff, #9a55ff) !important; color: #ffffff !important; }
        .btn-gradient-secondary { background: #6c757d !important; color: #ffffff !important; }
        .btn-gradient-success { background: linear-gradient(135deg, #28a745, #5cb85c) !important; color: #ffffff !important; }
        .btn-gradient-danger { background: linear-gradient(135deg, #dc3545, #e4606d) !important; color: #ffffff !important; }
        .btn-gradient-info { background: linear-gradient(135deg, #17a2b8, #5bc0de) !important; color: #ffffff !important; }
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
        @media (min-width: 576px) { .badge { padding: 0.4rem 0.75rem; font-size: 0.8rem; } }
        .badge-gradient-success { background: linear-gradient(135deg, #28a745, #5cb85c); color: #ffffff; }
        .badge-gradient-warning { background: linear-gradient(135deg, #ffc107, #ffdb6d); color: #2c2e3f; }
        .badge-gradient-danger { background: linear-gradient(135deg, #dc3545, #e4606d); color: #ffffff; }

        /* ===== CSS DARI UI PERTAMA (UNTUK TABEL) ===== */
        .badge-soft {
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.78rem;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
        }
        .badge-available-subsidi {
            background: #28a745;
            color: #ffffff;
        }
        .badge-available-komersil {
            background: #0d6efd;
            color: #ffffff;
        }
        .badge-booking {
            background: #ffc107;
            color: #2c2e3f;
        }
        .badge-sold {
            background: #dc3545;
            color: #ffffff;
        }
        .badge-draft {
            background: #6c757d;
            color: #ffffff;
        }
        .price-text { color: #28a745 !important; font-weight: 700; }
        .fee-text { color: #28a745 !important; font-weight: 700; }
        .progress-wrapper { min-width: 200px; }
        .progress-row {
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }
        .progress {
            flex: 1;
            height: 10px;
            border-radius: 20px;
            background: #edf0f5;
            overflow: hidden;
        }
        .progress-percent {
            min-width: 42px;
            text-align: right;
            font-size: 0.78rem;
            font-weight: 700;
            color: #6c7383;
        }
        .progress-bar-custom {
            height: 100%;
            border-radius: 20px;
        }
        .progress-green { background: linear-gradient(to right, #28a745, #5dd17a); }
        .progress-dark-green { background: linear-gradient(to right, #198754, #31b87a); }
        .icon-text {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
        }
        .icon-text i { font-size: 1rem; color: #9a55ff; }
        .btn-action {
            width: 36px;
            height: 36px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            margin: 0 2px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }
        .btn-action i { font-size: 1rem; }
        .btn-action.view { background: linear-gradient(to right, #da8cff, #9a55ff); color: #fff; }
        .btn-action.customer { background: linear-gradient(135deg, #28a745, #5dd17a); color: #fff; }
        .btn-action.agent { background: linear-gradient(135deg, #ffc107, #ffdb6d); color: #2c2e3f; }
        .action-group {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.25rem;
        }

        /* ===== TABLE STYLING DARI UI PERTAMA ===== */
        .table-responsive {
            overflow-x: auto;
            overflow-y: hidden;
            -webkit-overflow-scrolling: touch;
            border-radius: 8px;
            margin-bottom: 0.5rem;
            scrollbar-width: thin;
            scrollbar-color: #9a55ff #f0f0f0;
        }
        .table-responsive::-webkit-scrollbar { width: 8px; height: 8px; }
        .table-responsive::-webkit-scrollbar-track { background: #f0f0f0; border-radius: 10px; }
        .table-responsive::-webkit-scrollbar-thumb { background: #9a55ff; border-radius: 10px; }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0;
            min-width: 1200px;
        }
        .table thead th {
            background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
            color: #9a55ff;
            font-weight: 700;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e9ecef;
            padding: 0.85rem 0.55rem;
            white-space: nowrap;
        }
        .table thead th:first-child,
        .table tbody td:first-child {
            width: 55px;
            text-align: center;
        }
        .table tbody td {
            vertical-align: middle;
            font-size: 0.88rem;
            padding: 0.85rem 0.55rem;
            border-bottom: 1px solid #e9ecef;
            color: #2c2e3f;
            white-space: nowrap;
        }
        .table tbody tr:hover { background-color: #f8f9fa; }

        /* ===== CSS LAINNYA DARI UI KEDUA ===== */
        .text-primary { color: #9a55ff !important; }
        .text-info { color: #17a2b8 !important; }
        .text-danger { color: #dc3545 !important; }
        .text-success { color: #28a745 !important; }
        .fw-bold { font-weight: 600 !important; }
        .text-muted { color: #a5b3cb !important; }
        h3.text-dark {
            font-size: 1.3rem !important;
            font-weight: 700;
            color: #2c2e3f !important;
            margin-bottom: 0.5rem !important;
        }
        @media (max-width: 576px) {
            .table thead th { font-size: 0.75rem; padding: 0.6rem 0.3rem; }
            .table tbody td { font-size: 0.8rem; padding: 0.6rem 0.3rem; }
            h3.text-dark { font-size: 1.2rem !important; }
        }
        .filter-text {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #9a55ff;
            font-weight: 700;
            font-size: 0.95rem;
            margin-bottom: 1rem;
        }
        .btn-icon-only {
            width: 42px;
            height: 42px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
        }
        .btn-icon-only i { font-size: 1.1rem; margin: 0; }
        .invisible { visibility: hidden; }
        .filter-col { padding-left: 3px; padding-right: 3px; }
        .filter-row { margin-bottom: 0.5rem; }
        .filter-row:last-child { margin-bottom: 0; }
        .btn-filter-reset {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            width: 100%;
            height: 40px;
        }

        /* Grid View */
        .grid-card {
            border: 1px solid #e0e4e9 !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
        }
        .grid-card:hover {
            border-color: #9a55ff !important;
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.15) !important;
        }

        /* Pagination */
        .pagination { margin: 0; gap: 3px; }
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
        .pagination-info { font-size: 0.8rem; color: #6c7383; }

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
        .unit-box:hover { transform: translateY(-2px); box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); }
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
        .legend-box { padding: 6px 12px; border-radius: 4px; font-size: 12px; color: white; }

        /* File Upload */
        .file-upload-modern { position: relative; width: 100%; }
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
        }
        .file-upload-modern .file-label-modern i {
            font-size: 1.6rem;
            color: #9a55ff;
            background: rgba(154, 85, 255, 0.1);
            padding: 8px;
            border-radius: 50%;
        }
        .file-upload-modern .file-label-modern.file-selected {
            border-color: #28a745;
            background: linear-gradient(135deg, #f0fff4, #e6f7e6);
        }

        /* Siteplan */
        .siteplan-scroll-container {
            width: 100%;
            overflow-x: auto;
            overflow-y: auto;
            border: 2px solid #9a55ff;
            border-radius: 12px;
            background: #f8f9fa;
            max-height: 700px;
        }
        #siteplanCanvas { display: block; border-radius: 8px; cursor: pointer; }
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
        .btn-save-position:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3); }

        /* Modal Detail Sederhana */
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
        .mdi { vertical-align: middle; }
        .btn-group .btn-outline-primary.active {
            background: linear-gradient(to right, #da8cff, #9a55ff);
            color: #ffffff;
        }

        /* Area badges */
        .info-badge-icon {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.38rem 0.75rem;
            border-radius: 999px;
            font-weight: 600;
            font-size: 0.82rem;
            white-space: nowrap;
        }
        .info-badge-icon i {
            font-size: 0.95rem;
        }
        .land-badge {
            background: linear-gradient(135deg, #fff8e1, #ffefb3);
            color: #9a6700;
        }
        .building-badge {
            background: linear-gradient(135deg, #eef2ff, #dbe4ff);
            color: #4c63d2;
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
        <div class="row g-3 mb-4">
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-icon total-unit"><i class="mdi mdi-home-group"></i></div>
                    <div class="stat-content">
                        <h3>{{ $totalUnits }}</h3>
                        <p>Total Unit</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-icon tersedia"><i class="mdi mdi-check-circle-outline"></i></div>
                    <div class="stat-content">
                        <h3>{{ $totalTersedia }}</h3>
                        <p>Tersedia</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-icon booking"><i class="mdi mdi-bookmark-check-outline"></i></div>
                    <div class="stat-content">
                        <h3>{{ $totalBooking }}</h3>
                        <p>Booking</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-icon terjual"><i class="mdi mdi-cash-check"></i></div>
                    <div class="stat-content">
                        <h3>{{ $totalSold }}</h3>
                        <p>Terjual</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Data -->
        <div class="row mt-2 mt-sm-2 mt-md-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-white d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                        <h5 class="card-title mb-2 mb-md-0">
                            <i class="mdi mdi-format-list-bulleted me-2 text-primary"></i>
                            Daftar Unit Kavling
                        </h5>
                        <div class="d-flex gap-2">
                            <a href="{{ route('marketing.jual-unit.export.excel') }}" class="btn btn-sm btn-gradient-success">
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
                        <!-- Filter Section -->
                        <div class="filter-card mb-4">
                            <div class="card-body">
                                <div class="filter-text">
                                    <i class="mdi mdi-filter-outline"></i>
                                    <span>Filter data</span>
                                </div>
                                <form method="GET" action="{{ route('marketing.jual-unit') }}" id="filterForm">
                                    <!-- FILTER DESKTOP -->
                                    <div class="d-none d-md-block">
                                        <div class="row g-2 align-items-end w-100">
                                            <div class="col-md-3 filter-col">
                                                <label class="form-label"><i class="mdi mdi-magnify me-1"></i>Cari Unit</label>
                                                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari block/unit, customer, agent...">
                                            </div>
                                            <div class="col-md-2 filter-col">
                                                <label class="form-label"><i class="mdi mdi-home me-1"></i>Proyek</label>
                                                <select name="project" class="form-control">
                                                    <option value="">Semua Proyek</option>
                                                    @foreach ($projects as $project)
                                                        <option value="{{ $project->name }}" {{ request('project') == $project->name ? 'selected' : '' }}>{{ $project->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-2 filter-col">
                                                <label class="form-label"><i class="mdi mdi-home-modern me-1"></i>Tipe</label>
                                                <select name="type" class="form-control">
                                                    <option value="">Semua Type</option>
                                                    @foreach ($types as $type)
                                                        <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-2 filter-col">
                                                <label class="form-label"><i class="mdi mdi-chart-arc me-1"></i>Status</label>
                                                <select name="status" class="form-control">
                                                    <option value="">Semua Status</option>
                                                    <option value="ready" {{ request('status') == 'ready' ? 'selected' : '' }}>Tersedia</option>
                                                    <option value="booked" {{ request('status') == 'booked' ? 'selected' : '' }}>Booking</option>
                                                    <option value="sold" {{ request('status') == 'sold' ? 'selected' : '' }}>Terjual</option>
                                                </select>
                                            </div>
                                            <div class="col-md-1 filter-col">
                                                <label class="form-label"><i class="mdi mdi-counter me-1"></i>Tampil</label>
                                                <select name="perPage" class="form-control">
                                                    <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                                                    <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25</option>
                                                    <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
                                                    <option value="100" {{ request('perPage') == 100 ? 'selected' : '' }}>100</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2 filter-col">
                                                <label class="form-label invisible d-none d-md-block">Aksi</label>
                                                <div class="d-flex gap-2">
                                                    <button type="submit" class="btn btn-gradient-primary btn-icon-only flex-fill" id="filterBtn" title="Filter" onclick="showFilterLoading()">
                                                        <i class="mdi mdi-filter"></i>
                                                    </button>
                                                    <a href="{{ route('marketing.jual-unit') }}" class="btn btn-gradient-secondary btn-icon-only flex-fill" title="Reset" onclick="showResetLoading(event)">
                                                        <i class="mdi mdi-refresh"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- FILTER MOBILE -->
                                    <div class="d-block d-md-none">
                                        <div class="row filter-row g-1">
                                            <div class="col-12">
                                                <label class="form-label"><i class="mdi mdi-magnify me-1"></i>Cari Unit</label>
                                                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari...">
                                            </div>
                                        </div>
                                        <div class="row filter-row g-1">
                                            <div class="col-6">
                                                <label class="form-label"><i class="mdi mdi-home me-1"></i>Proyek</label>
                                                <select name="project" class="form-control">
                                                    <option value="">Semua</option>
                                                    @foreach ($projects as $project)
                                                        <option value="{{ $project->name }}" {{ request('project') == $project->name ? 'selected' : '' }}>{{ $project->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label"><i class="mdi mdi-home-modern me-1"></i>Tipe</label>
                                                <select name="type" class="form-control">
                                                    <option value="">Semua</option>
                                                    @foreach ($types as $type)
                                                        <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row filter-row g-1">
                                            <div class="col-6">
                                                <label class="form-label"><i class="mdi mdi-chart-arc me-1"></i>Status</label>
                                                <select name="status" class="form-control">
                                                    <option value="">Semua</option>
                                                    <option value="ready" {{ request('status') == 'ready' ? 'selected' : '' }}>Tersedia</option>
                                                    <option value="booked" {{ request('status') == 'booked' ? 'selected' : '' }}>Booking</option>
                                                    <option value="sold" {{ request('status') == 'sold' ? 'selected' : '' }}>Terjual</option>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label"><i class="mdi mdi-counter me-1"></i>Tampil</label>
                                                <select name="perPage" class="form-control">
                                                    <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                                                    <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25</option>
                                                    <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
                                                    <option value="100" {{ request('perPage') == 100 ? 'selected' : '' }}>100</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row filter-row g-1">
                                            <div class="col-12 mt-2">
                                                <div class="d-flex gap-2">
                                                    <button type="submit" class="btn btn-gradient-primary btn-icon-only flex-fill" id="filterBtnMobile" title="Filter" onclick="showFilterLoading()">
                                                        <i class="mdi mdi-filter"></i>
                                                    </button>
                                                    <a href="{{ route('marketing.jual-unit') }}" class="btn btn-gradient-secondary btn-icon-only flex-fill" title="Reset" onclick="showResetLoading(event)">
                                                        <i class="mdi mdi-refresh"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Toggle View -->
                        <div class="d-flex justify-content-end mb-3">
                            <div class="btn-group btn-group-sm" role="group">
                                <button type="button" class="btn btn-outline-primary active" id="btnTableView" onclick="switchView('table')"><i class="mdi mdi-view-list me-1"></i><span class="d-none d-sm-inline">Table</span></button>
                                <button type="button" class="btn btn-outline-primary" id="btnGridView" onclick="switchView('grid')"><i class="mdi mdi-view-grid me-1"></i><span class="d-none d-sm-inline">Grid</span></button>
                                <button type="button" class="btn btn-outline-primary" id="btnDenahView" onclick="switchView('denah')"><i class="mdi mdi-floor-plan me-1"></i><span class="d-none d-sm-inline">Denah Unit</span></button>
                                <button type="button" class="btn btn-outline-primary" id="btnSitePlandView" onclick="switchView('sitepland')"><i class="mdi mdi-floor-plan me-1"></i><span class="d-none d-sm-inline">Siteplan</span></button>
                            </div>
                        </div>

                        <!-- ========== TABLE VIEW DENGAN STYLE UI PERTAMA ========== -->
                        <div id="tableView" style="display: block;">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Block/Unit</th>
                                            <th>Proyek</th>
                                            <th>Tipe</th>
                                            <th class="d-none d-md-table-cell">Lokasi</th>
                                            <th>Luas Tanah</th>
                                            <th>Luas Bangunan</th>
                                            <th>Harga</th>
                                            <th>Hadap</th>
                                            <th>Status</th>
                                            <th>Status Pembangunan / Progres</th>
                                            <th>Agent</th>
                                            <th>Fee Agent</th>
                                            <th>Customer</th>
                                            <th>Booking Fee</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($units as $index => $unit)
                                        @php
                                            // Mapping status untuk badge soft
                                            $statusBadge = '';
                                            $statusIcon = '';
                                            $statusText = ucfirst($unit->status);
                                            if ($unit->status == 'ready' || $unit->status == 'tersedia') {
                                                if (strtolower($unit->type) == 'subsidi') {
                                                    $statusBadge = 'badge-available-subsidi';
                                                } else {
                                                    $statusBadge = 'badge-available-komersil';
                                                }
                                                $statusIcon = 'mdi-check-circle-outline';
                                                $statusText = 'Tersedia';
                                            } elseif ($unit->status == 'sold') {
                                                $statusBadge = 'badge-sold';
                                                $statusIcon = 'mdi-cash-check';
                                                $statusText = 'Terjual';
                                            } elseif ($unit->status == 'booked') {
                                                $statusBadge = 'badge-booking';
                                                $statusIcon = 'mdi-bookmark-check-outline';
                                                $statusText = 'Booking';
                                            } elseif (strtolower($unit->status) == 'draft' || strtolower($unit->status) == 'draff') {
                                                $statusBadge = 'badge-draft';
                                                $statusIcon = 'mdi-file-document-edit-outline';
                                                $statusText = 'Draft';
                                            } else {
                                                $statusBadge = 'badge-soft';
                                                $statusIcon = 'mdi-information-outline';
                                            }

                                            // Progress mapping
                                            $progressMap = [
                                                'belum_mulai' => 0,
                                                'pondasi' => 20,
                                                'dinding' => 40,
                                                'atap' => 60,
                                                'finishing' => 80,
                                                'selesai' => 100,
                                            ];
                                            $progress = $progressMap[$unit->construction_progress] ?? 0;
                                            $progressClass = $progress < 100 ? 'progress-green' : 'progress-dark-green';
                                        @endphp
                                        <tr>
                                            <td class="fw-bold text-center">{{ $units->firstItem() + $index }}</td>
                                            <td>
                                                <span class="icon-text">
                                                    <i class="mdi mdi-home-outline"></i>
                                                    <span class="fw-bold">{{ $unit->unit_code }}</span>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="icon-text">
                                                    <i class="mdi mdi-office-building"></i>
                                                    <span class="fw-bold">{{ $unit->landBank->name ?? '-' }}</span>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="icon-text">
                                                    <i class="mdi mdi-floor-plan"></i>
                                                    <span>{{ $unit->type ?? '-' }}</span>
                                                </span>
                                            </td>
                                            <td class="d-none d-md-table-cell">
                                                <span class="icon-text">
                                                    <i class="mdi mdi-map-marker-outline"></i>
                                                    <span>{{ Str::limit($unit->landBank->address ?? '-', 20) }}</span>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="info-badge-icon land-badge">
                                                    <i class="mdi mdi-arrow-expand-all"></i>{{ $unit->area ?? '-' }} m²
                                                </span>
                                            </td>
                                            <td>
                                                <span class="info-badge-icon building-badge">
                                                    <i class="mdi mdi-home-floor-1"></i>{{ $unit->building_area ?? '-' }} m²
                                                </span>
                                            </td>
                                            <td class="price-text">Rp {{ number_format($unit->price ?? 0, 0, ',', '.') }}</td>
                                            <td><i class="mdi mdi-compass-outline text-primary me-1"></i>{{ $unit->facing ?? '-' }}</td>
                                            <td>
                                                <span class="badge-soft {{ $statusBadge }}">
                                                    <i class="mdi {{ $statusIcon }}"></i>{{ $statusText }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="progress-wrapper">
                                                    <div class="progress-row">
                                                        <div class="progress">
                                                            <div class="progress-bar-custom {{ $progressClass }}" style="width: {{ $progress }}%;"></div>
                                                        </div>
                                                        <div class="progress-percent">{{ $progress }}%</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <i class="mdi mdi-account-tie text-primary me-1"></i>
                                                {{ $unit->activeBooking->sales->name ?? '-' }}
                                            </td>
                                            <td class="fee-text">
                                                Rp {{ number_format($unit->activeBooking->agent_fee ?? 0, 0, ',', '.') }}
                                            </td>
                                            <td>
                                                <i class="mdi mdi-account-outline text-primary me-1"></i>
                                                {{ $unit->activeBooking->customer->full_name ?? '-' }}
                                            </td>
                                            <td class="fee-text">
                                                Rp {{ number_format($unit->activeBooking->booking_fee ?? 0, 0, ',', '.') }}
                                            </td>
                                            <td class="text-center">
                                                <div class="action-group">
                                                    <button class="btn-action view" title="Detail"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#detailUnitModal"
                                                        data-unit="{{ $unit->unit_code }}"
                                                        data-block="{{ $unit->block }}"
                                                        data-type="{{ $unit->type }}"
                                                        data-address="{{ $unit->landBank->address ?? '-' }}"
                                                        data-area="{{ $unit->area }}"
                                                        data-building="{{ $unit->building_area }}"
                                                        data-price="{{ $unit->price }}"
                                                        data-direction="{{ $unit->facing }}"
                                                        data-status="{{ $statusText }}"
                                                        data-construction="{{ $unit->construction_progress }}"
                                                        data-customer="{{ $unit->activeBooking->customer->full_name ?? '-' }}"
                                                        data-sales="{{ $unit->activeBooking->sales->name ?? '-' }}"
                                                        data-booking_date="{{ $unit->activeBooking->booking_date ?? '-' }}"
                                                        data-booking_fee="{{ $unit->activeBooking->booking_fee ?? '-' }}"
                                                        data-booking_status="{{ $unit->activeBooking->status ?? '-' }}">
                                                        <i class="mdi mdi-eye"></i>
                                                    </button>
                                                    @if (auth()->user()->position_id != 4)
                                                        <button class="btn-action customer" title="Pilih Customer" onclick="openCustomerModal({{ $unit->id }})">
                                                            <i class="mdi mdi-account-plus"></i>
                                                        </button>
                                                        <button class="btn-action agent" title="Pilih Agent" onclick="openAgentModal({{ $unit->id }})">
                                                            <i class="mdi mdi-account-search"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="16" class="text-center text-muted py-4">
                                                <i class="mdi mdi-home-outline" style="font-size: 2rem; opacity: 0.3;"></i>
                                                <p class="mt-2">Data unit belum tersedia</p>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- GRID VIEW -->
                        <div id="gridView" style="display: none;">
                            <div class="row g-3">
                                @forelse ($units as $unit)
                                    <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                                        <div class="card grid-card h-100">
                                            <div class="card-body p-3">
                                                <div class="position-relative">
                                                    @if ($unit->status == 'ready' || $unit->status == 'tersedia')
                                                        <span class="badge badge-gradient-success position-absolute top-0 end-0 m-2"><i class="mdi mdi-check-circle me-1"></i>Tersedia</span>
                                                    @elseif($unit->status == 'sold')
                                                        <span class="badge badge-gradient-danger position-absolute top-0 end-0 m-2"><i class="mdi mdi-cash-check me-1"></i>Terjual</span>
                                                    @else
                                                        <span class="badge badge-gradient-warning position-absolute top-0 end-0 m-2"><i class="mdi mdi-clock-outline me-1"></i>{{ ucfirst($unit->status) }}</span>
                                                    @endif
                                                    <div class="text-center bg-light py-3 py-md-4 rounded">
                                                        <i class="mdi mdi-home-outline" style="font-size: 36px; color: #9a55ff;"></i>
                                                    </div>
                                                </div>
                                                <h6 class="mt-2 fw-bold"><i class="mdi mdi-home-variant text-primary me-1"></i>{{ $unit->unit_code }}</h6>
                                                <p class="text-muted small mb-1"><i class="mdi mdi-office-building me-1"></i>{{ $unit->landBank->name ?? '-' }}</p>
                                                <p class="small mb-1"><i class="mdi mdi-ruler-square me-1"></i>{{ $unit->building_area ?? ($unit->area ?? '-') }} m² | <i class="mdi mdi-currency-usd me-1"></i>Rp {{ number_format($unit->price ?? 0, 0, ',', '.') }}</p>
                                                <div class="d-flex justify-content-between align-items-center mt-2">
                                                    <small class="text-muted"><i class="mdi mdi-account-tie me-1"></i>{{ optional(optional($unit->activeBooking)->sales)->name ?? '-' }}</small>
                                                    <button class="btn btn-outline-danger btn-sm" onclick="openCustomerModal({{ $unit->id }})"><i class="mdi mdi-account-plus"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12"><div class="text-center text-muted py-5"><i class="mdi mdi-home-outline" style="font-size: 3rem; opacity: 0.3;"></i><p class="mt-3">Belum ada unit tersedia</p></div></div>
                                @endforelse
                            </div>
                        </div>

                        <!-- DENAH VIEW -->
                        <div id="denahView" style="display: none;">
                            <div class="denah-container">
                                <div style="display:flex; flex-wrap:wrap; justify-content:center; gap:10px;">
                                    @php
                                        $unitsByProject = $units->groupBy(function ($item) { return $item->landBank->name ?? 'Tanpa Proyek'; });
                                    @endphp
                                    @foreach ($unitsByProject as $projectName => $projectUnits)
                                        @php
                                            $blokKavlings = [];
                                            foreach ($projectUnits as $unit) {
                                                $blok = explode('.', $unit->unit_code)[0];
                                                $blokKavlings[$blok][] = $unit;
                                            }
                                            $allBloks = array_keys($blokKavlings);
                                        @endphp
                                        <div style="margin-bottom: 25px; width:100%; border-bottom: 1px dashed #9a55ff; padding-bottom: 15px;">
                                            <h6 class="text-primary mb-3"><i class="mdi mdi-office-building me-2"></i>Proyek: {{ $projectName }}</h6>
                                            @foreach ($allBloks as $blok)
                                                <div style="margin-bottom:15px; width:100%;">
                                                    @php
                                                        $typesInBlok = collect($blokKavlings[$blok])->pluck('type')->unique()->values()->toArray();
                                                        $typeLetters = [];
                                                        foreach ($typesInBlok as $type) {
                                                            if ($type == 'subsidi') $typeLetters[] = 'S';
                                                            elseif ($type == 'komersil') $typeLetters[] = 'K';
                                                        }
                                                        $labelType = implode(' & ', $typeLetters);
                                                    @endphp
                                                    <strong style="font-size: 14px;">Blok {{ $blok }} - {{ $labelType }} <small class="text-muted ms-2">({{ count($blokKavlings[$blok]) }} unit)</small></strong>
                                                    <div style="display:flex; flex-wrap:wrap; gap:8px; justify-content:flex-start; margin-top:8px;">
                                                        @php
                                                            $numbers = [];
                                                            foreach ($blokKavlings[$blok] as $unit) { $numbers[] = (int) explode('.', $unit->unit_code)[1]; }
                                                            $maxNum = max($numbers);
                                                        @endphp
                                                        @for ($i = 1; $i <= $maxNum; $i++)
                                                            @php
                                                                $unitFound = collect($blokKavlings[$blok])->firstWhere('unit_code', $blok . '.' . $i);
                                                                $bgColor = '#6c757d';
                                                                $icon = 'close';
                                                                $borderStyle = 'none';
                                                                $extraStyle = '';
                                                                $typeBadge = '';
                                                                if ($unitFound) {
                                                                    switch ($unitFound->status) {
                                                                        case 'sold': $bgColor = '#dc3545'; $icon = 'check'; break;
                                                                        case 'booked': $bgColor = '#ffc107'; $icon = 'clock'; break;
                                                                        case 'ready':
                                                                            if ($unitFound->type == 'subsidi') { $bgColor = '#28a745'; $typeBadge = 'S'; }
                                                                            else { $bgColor = '#0d6efd'; $typeBadge = 'K'; }
                                                                            $icon = 'home'; break;
                                                                    }
                                                                    switch ($unitFound->construction_progress) {
                                                                        case 'belum_mulai': $borderStyle = '2px dashed #000'; $extraStyle = 'background-image: repeating-linear-gradient(45deg, rgba(255,255,255,0.2), rgba(255,255,255,0.2) 5px, transparent 5px, transparent 10px);'; break;
                                                                        case 'pondasi': $borderStyle = '2px solid #000'; break;
                                                                        case 'dinding': $borderStyle = '3px solid #000'; break;
                                                                        case 'atap': $borderStyle = '3px double #000'; break;
                                                                        case 'finishing': $borderStyle = '3px groove #000'; break;
                                                                        case 'selesai': $borderStyle = '3px solid #155724'; break;
                                                                    }
                                                                }
                                                            @endphp
                                                            <span class="unit-box" style="background-color: {{ $bgColor }}; border: {{ $borderStyle }}; {{ $extraStyle }}" title="{{ $unitFound ? $unitFound->unit_code . ' - ' . ucfirst($unitFound->status) : 'Unit ' . $blok . '.' . $i . ' belum tersedia' }}">
                                                                @if ($typeBadge)<span class="type-badge-small">{{ $typeBadge }}</span>@endif
                                                                <i class="mdi mdi-{{ $icon }} me-1"></i>{{ $blok . '.' . $i }}
                                                            </span>
                                                        @endfor
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mt-5 pt-3 border-top">
                                    <h6 class="mb-3">Keterangan:</h6>
                                    <div class="row">
                                        <div class="col-md-4"><h6 class="small fw-bold">Status Penjualan:</h6><div class="d-flex flex-wrap gap-2 mb-3"><span class="legend-box bg-danger">Sold</span><span class="legend-box bg-warning text-dark">Booked</span><span class="legend-box bg-success">Ready - Subsidi</span><span class="legend-box bg-primary">Ready - Komersil</span><span class="legend-box" style="background-color:#6c757d;">Belum Tersedia</span></div></div>
                                        <div class="col-md-4"><h6 class="small fw-bold">Progress Pembangunan (Border):</h6><div class="d-flex flex-wrap gap-2 mb-3"><span style="border:2px dashed #000; padding:4px 8px; background:#f8f9fa;">Belum Mulai</span><span style="border:2px solid #000; padding:4px 8px; background:#f8f9fa;">Pondasi</span><span style="border:3px solid #000; padding:4px 8px; background:#f8f9fa;">Dinding</span><span style="border:3px double #000; padding:4px 8px; background:#f8f9fa;">Atap</span><span style="border:3px groove #000; padding:4px 8px; background:#f8f9fa;">Finishing</span><span style="border:3px solid #155724; padding:4px 8px; background:#f8f9fa;">Selesai</span></div></div>
                                        <div class="col-md-4"><h6 class="small fw-bold">Tipe Unit:</h6><div class="d-flex gap-2"><span class="badge bg-success">S = Subsidi</span><span class="badge bg-primary">K = Komersil</span></div></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SITEPLAN VIEW -->
                        <div id="sitePlandView" style="display: none;">
                            <div class="denah-container" style="padding: 1rem;">
                                <div class="siteplan-scroll-container">
                                    <canvas id="siteplanCanvas"></canvas>
                                </div>
                                <div class="mt-4 text-center">
                                    <button type="button" class="btn btn-save-position" onclick="savePosition()"><i class="mdi mdi-content-save me-2"></i>Simpan Posisi Unit</button>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Detail Unit Lengkap -->
                        <div class="modal fade" id="detailUnitModal" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"><i class="mdi mdi-home-circle me-2" style="color: #9a55ff;"></i>Detail Unit Lengkap</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-bordered">
                                            <tr><th>Kode Unit</th><td id="m_unit"></td></tr>
                                            <tr><th>Blok</th><td id="m_block"></td></tr>
                                            <tr><th>Tipe</th><td id="m_type"></td></tr>
                                            <tr><th>Alamat</th><td id="m_address"></td></tr>
                                            <tr><th>Luas Tanah</th><td id="m_area"></td></tr>
                                            <tr><th>Luas Bangunan</th><td id="m_building"></td></tr>
                                            <tr><th>Harga</th><td id="m_price"></td></tr>
                                            <tr><th>Arah Hadap</th><td id="m_direction"></td></tr>
                                            <tr><th>Status</th><td id="m_status"></td></tr>
                                            <tr><th>Status Pembangunan</th><td id="m_construction"></td></tr>
                                        </table>
                                        <h5 class="mt-3">Detail Booking</h5>
                                        <table class="table table-bordered">
                                            <tr><th width="30%">Customer</th><td id="m_customer"></td></tr>
                                            <tr><th>Sales / Agency</th><td id="m_sales"></td></tr>
                                            <tr><th>Tanggal Booking</th><td id="m_booking_date"></td></tr>
                                            <tr><th>Booking Fee</th><td id="m_booking_fee"></td></tr>
                                            <tr><th>Status Booking</th><td id="m_booking_status"></td></tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Detail Sederhana untuk Siteplan -->
                        <div class="modal fade" id="myModal" tabindex="-1">
                            <div class="modal-dialog modal-sm modal-dialog-centered">
                                <div class="modal-content modal-detail-simple">
                                    <div class="modal-header"><h5 class="modal-title"><i class="mdi mdi-home-circle me-2"></i>Detail Unit</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                                    <div class="modal-body">
                                        <p><strong>Unit Code:</strong><span class="unit-code">-</span></p>
                                        <p><strong>Status:</strong><span class="unit-status">-</span></p>
                                        <p><strong>Posisi:</strong><span class="unit-pos">-</span></p>
                                        <p><strong>Ukuran:</strong><span class="unit-size">-</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pagination -->
                        @if ($units->count() > 0)
                            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-3">
                                <div class="pagination-info mb-2 mb-sm-0"><i class="mdi mdi-information-outline me-1"></i>Menampilkan {{ $units->firstItem() }} - {{ $units->lastItem() }} dari {{ $units->total() }} data</div>
                                <nav aria-label="Page navigation">
                                    <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0" style="gap: 2px;">
                                        @if ($units->onFirstPage())<li class="page-item disabled"><span class="page-link"><i class="mdi mdi-chevron-left"></i></span></li>
                                        @else<li class="page-item"><a class="page-link" href="{{ $units->previousPageUrl() }}"><i class="mdi mdi-chevron-left"></i></a></li>@endif
                                        @foreach ($units->getUrlRange(1, $units->lastPage()) as $page => $url)
                                            <li class="page-item {{ $units->currentPage() == $page ? 'active' : '' }}"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                        @endforeach
                                        @if ($units->hasMorePages())<li class="page-item"><a class="page-link" href="{{ $units->nextPageUrl() }}"><i class="mdi mdi-chevron-right"></i></a></li>
                                        @else<li class="page-item disabled"><span class="page-link"><i class="mdi mdi-chevron-right"></i></span></li>@endif
                                    </ul>
                                </nav>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    <!-- MODAL CUSTOMER -->
    <div class="modal fade" id="modalCustomer" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header"><h5 class="modal-title"><i class="mdi mdi-account-multiple me-2" style="color: #9a55ff;"></i>Data Customer</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                    <div class="card mb-3 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold"><i class="mdi mdi-cash-multiple text-primary me-1"></i>Booking Fee <span class="text-danger">*</span></label>
                                    <div class="input-group"><span class="input-group-text bg-white">Rp</span><input type="text" class="form-control" id="booking_fee" name="booking_fee" placeholder="Masukkan booking fee" autocomplete="off"></div>
                                    <small class="text-muted">Nominal booking fee yang dibayar customer</small>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold"><i class="mdi mdi-cloud-upload text-primary me-1"></i>Upload Bukti Transfer <span class="text-danger">*</span></label>
                                    <div class="file-upload-modern">
                                        <input type="file" id="bukti_transfer" name="bukti_transfer" accept=".jpg,.jpeg,.png,.pdf">
                                        <div class="file-label-modern" id="buktiLabel">
                                            <i class="mdi mdi-cloud-upload"></i>
                                            <div class="file-info-modern"><span id="buktiFileName">Upload Bukti Transfer</span><small>Format: JPG, PNG, PDF (Max 2MB)</small></div>
                                            <span class="file-size" id="buktiFileSize"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2"><div class="col-12"><small class="text-muted"><i class="mdi mdi-information-outline me-1"></i>Pilih customer lalu klik metode pembayaran (Cash/KPR)</small></div></div>
                        </div>
                    </div>
                    <div class="card mb-3 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8"><label class="form-label fw-bold"><i class="mdi mdi-magnify text-primary me-1"></i>Cari Customer</label><input type="text" id="searchCustomer" class="form-control" placeholder="Cari nama, ID, atau no. HP customer..."></div>
                                <div class="col-md-4"><label class="form-label fw-bold"><i class="mdi mdi-briefcase text-primary me-1"></i>Filter Pekerjaan</label><select class="form-control" id="filterPekerjaan"><option value="">Semua Pekerjaan</option>@php $uniqueJobs = collect($customers)->pluck('job_status')->unique()->filter(); @endphp @foreach ($uniqueJobs as $job)<option value="{{ $job }}">{{ $job }}</option>@endforeach</select></div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2"><span class="text-muted small"><i class="mdi mdi-account-multiple me-1"></i>Total: {{ count($customers) }} customer</span><span class="badge badge-gradient-info"><i class="mdi mdi-information-outline me-1"></i>Klik tombol Cash/KPR untuk memilih</span></div>
                    <div class="table-responsive" style="max-height: 350px; overflow-y: auto; border: 1px solid #e9ecef; border-radius: 8px;">
                        <table class="table table-bordered align-middle mb-0" id="customerTable">
                            <thead class="table-light" style="position: sticky; top: 0; background: white; z-index: 5;"><tr><th class="text-center" style="width: 50px;">No</th><th>ID Customer</th><th>Nama</th><th>No HP</th><th>Pekerjaan</th><th class="text-center" style="width: 160px;">Aksi</th></tr></thead>
                            <tbody>
                                @forelse ($customers as $c)
                                <tr><td class="text-center fw-bold">{{ $loop->iteration }}</td><td><span class="badge bg-light text-dark">{{ $c->customer_id ?? '-' }}</span></td><td><div class="d-flex align-items-center"><div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px; font-size: 12px; background: linear-gradient(135deg, #da8cff, #9a55ff) !important;">{{ strtoupper(substr($c->full_name ?? 'C', 0, 1)) }}</div><span class="fw-medium">{{ $c->full_name ?? '-' }}</span></div></td><td><i class="mdi mdi-whatsapp text-success me-1"></i>{{ $c->phone ?? '-' }}</td><td>@if($c->job_status)<span class="badge bg-light text-dark"><i class="mdi mdi-briefcase-outline me-1"></i>{{ $c->job_status === 'Lainnya' ? ($c->job_status_lainnya ?: '-') : $c->job_status }}</span>@else<span class="text-muted">-</span>@endif</td><td class="text-center"><div class="d-flex gap-1 justify-content-center"><button type="button" class="btn btn-sm btn-success pilihCustomer" data-id="{{ $c->id }}" data-type="cash" style="padding: 0.25rem 0.75rem;"><i class="mdi mdi-cash me-1"></i>Cash Keras</button><button type="button" class="btn btn-sm btn-info pilihCustomer" data-id="{{ $c->id }}" data-type="cash_tempo" style="padding: 0.25rem 0.75rem;"><i class="mdi mdi-cash-multiple me-1"></i>Cash Tempo</button><button type="button" class="btn btn-sm btn-primary pilihCustomer" data-id="{{ $c->id }}" data-type="kpr" style="padding: 0.25rem 0.75rem;"><i class="mdi mdi-bank me-1"></i>KPR</button></div></td></tr>
                                @empty
                                <tr><td colspan="6" class="text-center py-4"><i class="mdi mdi-account-off" style="font-size: 2rem; opacity: 0.3;"></i><p class="mt-2 text-muted">Tidak ada data customer</p></td></tr>
                                @endforelse
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
                <div class="modal-header"><h5 class="modal-title"><i class="mdi mdi-office-building me-2" style="color: #9a55ff;"></i>Pilih Agency</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                    <div class="card mb-3 border-0 shadow-sm">
                        <div class="card-body">
                            <form id="formAgency" method="POST">@csrf<input type="hidden" name="sales_id" id="sales_id">
                                <div class="row">
                                    <div class="col-md-6"><label class="form-label fw-bold"><i class="mdi mdi-cash text-primary me-1"></i>Agent Fee</label><div class="input-group"><span class="input-group-text bg-white">Rp</span><input type="text" class="form-control" name="agent_fee" id="agent_fee_modal" placeholder="Masukkan agent fee" autocomplete="off"></div><small class="text-muted"><i class="mdi mdi-information-outline me-1"></i>Masukkan nominal fee untuk agency yang dipilih</small></div>
                                    <div class="col-md-6"><label class="form-label fw-bold"><i class="mdi mdi-magnify text-primary me-1"></i>Cari Agency</label><div class="position-relative"><i class="mdi mdi-magnify position-absolute" style="left: 12px; top: 10px; color: #9a55ff; z-index: 10;"></i><input type="text" id="searchAgency" class="form-control" placeholder="Cari nama agency..." style="padding-left: 40px;"></div></div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2"><span class="text-muted small"><i class="mdi mdi-office-building me-1"></i>Total: {{ count($agencies) }} agency</span><span class="badge badge-gradient-info"><i class="mdi mdi-information-outline me-1"></i>Klik tombol Pilih untuk memilih agency</span></div>
                    <div class="table-responsive" style="max-height: 400px; overflow-y: auto; border: 1px solid #e9ecef; border-radius: 8px;">
                        <table class="table table-bordered align-middle mb-0">
                            <thead class="table-light" style="position: sticky; top: 0; background: white; z-index: 5;"><tr><th class="text-center" style="width: 50px;">No</th><th>Nama Agency</th><th>No HP</th><th>Alamat</th><th class="text-center" style="width: 120px;">Aksi</th></tr></thead>
                            <tbody>
                                @forelse ($agencies as $a)
                                <tr><td class="text-center fw-bold">{{ $loop->iteration }}</td><td><div class="d-flex align-items-center"><div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px; font-size: 12px; background: linear-gradient(135deg, #da8cff, #9a55ff) !important;">{{ strtoupper(substr($a->name ?? 'A', 0, 1)) }}</div><span class="fw-medium">{{ $a->name }}</span></div></td><td><i class="mdi mdi-phone text-success me-1"></i>{{ $a->phone }} </div>
                                                                </div>
                                                                </td>
                                                                <td><i class="mdi mdi-map-marker text-danger me-1"></i>{{ $a->address }}</td>
                                                                <td class="text-center">
                                                                    <button type="button" class="btn btn-sm btn-gradient-success pilihAgency" data-id="{{ $a->id }}" style="border-radius: 20px; padding: 0.25rem 1rem;"><i class="mdi mdi-check me-1"></i>Pilih</button>
                                                                </td>
                                                            </tr>
                                                            @empty
                                                                <tr><td colspan="5" class="text-center py-4"><i class="mdi mdi-office-building-off" style="font-size: 2rem; opacity: 0.3;"></i><p class="mt-2 text-muted">Tidak ada data agency</p></td></tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
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
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.0/fabric.min.js"></script>

                                <script>
                                    // ========== DETAIL MODAL HANDLER ==========
                                    const detailModal = document.getElementById('detailUnitModal');
                                    if (detailModal) {
                                        detailModal.addEventListener('show.bs.modal', function(event) {
                                            let button = event.relatedTarget;
                                            document.getElementById('m_unit').innerText = button.getAttribute('data-unit');
                                            document.getElementById('m_block').innerText = button.getAttribute('data-block');
                                            document.getElementById('m_type').innerText = button.getAttribute('data-type');
                                            document.getElementById('m_address').innerText = button.getAttribute('data-address');
                                            document.getElementById('m_area').innerText = button.getAttribute('data-area') + ' m²';
                                            document.getElementById('m_building').innerText = button.getAttribute('data-building') + ' m²';
                                            document.getElementById('m_price').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(button.getAttribute('data-price'));
                                            document.getElementById('m_direction').innerText = button.getAttribute('data-direction');
                                            document.getElementById('m_status').innerText = button.getAttribute('data-status');
                                            document.getElementById('m_construction').innerText = button.getAttribute('data-construction');
                                            document.getElementById('m_customer').innerText = button.getAttribute('data-customer');
                                            document.getElementById('m_sales').innerText = button.getAttribute('data-sales');
                                            document.getElementById('m_booking_date').innerText = button.getAttribute('data-booking_date');
                                            document.getElementById('m_booking_fee').innerText = button.getAttribute('data-booking_fee');
                                            document.getElementById('m_booking_status').innerText = button.getAttribute('data-booking_status');
                                        });
                                    }

                                    // ========== SITEPLAN CANVAS ==========
                                    const canvas = new fabric.Canvas('siteplanCanvas');
                                    const siteplanImage = "{{ asset('images/siteplan.jpeg') }}";

                                    fabric.Image.fromURL(siteplanImage, function(img) {
                                        canvas.setWidth(img.width);
                                        canvas.setHeight(img.height);
                                        canvas.setBackgroundImage(img, function() {
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
                                        }, { originX: 'left', originY: 'top' });
                                    });

                                    function getColor(status, type) {
                                        if (type === "komersil" && status === "ready") return "#2675BB";
                                        if (status === "ready") return "#CE2A2E";
                                        if (status === "booked") return "#FFD700";
                                        if (status === "sold") return "#FA2800";
                                        return "gray";
                                    }

                                    canvas.on('mouse:dblclick', function(e) {
                                        if (e.target && e.target.unitId) {
                                            document.querySelector('#myModal .unit-code').textContent = e.target.unitCode || '-';
                                            document.querySelector('#myModal .unit-status').textContent = e.target.status || '-';
                                            document.querySelector('#myModal .unit-pos').textContent = `X: ${Math.round(e.target.left)}, Y: ${Math.round(e.target.top)}`;
                                            document.querySelector('#myModal .unit-size').textContent = `W: ${Math.round(e.target.getScaledWidth())}, H: ${Math.round(e.target.getScaledHeight())}`;
                                            const modal = new bootstrap.Modal(document.getElementById('myModal'));
                                            modal.show();
                                        }
                                    });

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
                                            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                                            body: JSON.stringify({ units: units })
                                        })
                                        .then(res => res.json())
                                        .then(data => {
                                            if (data.success) {
                                                Swal.fire({ icon: 'success', title: 'Berhasil', text: 'Posisi unit berhasil disimpan', showConfirmButton: false, timer: 1500 });
                                            }
                                        })
                                        .catch(error => {
                                            Swal.fire({ icon: 'error', title: 'Gagal', text: 'Terjadi kesalahan saat menyimpan posisi' });
                                        });
                                    }

                                    // ========== SWITCH VIEW FUNCTION ==========
                                    function switchView(view) {
                                        document.getElementById('tableView').style.display = 'none';
                                        document.getElementById('gridView').style.display = 'none';
                                        document.getElementById('denahView').style.display = 'none';
                                        document.getElementById('sitePlandView').style.display = 'none';
                                        document.querySelectorAll('.btn-group .btn').forEach(btn => btn.classList.remove('active'));
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

                                    // ========== OPEN CUSTOMER MODAL ==========
                                    window.openCustomerModal = function(unitId) {
                                        if (!unitId) {
                                            Swal.fire({ icon: 'error', title: 'Error', text: 'Unit tidak valid!' });
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

                                    // ========== OPEN AGENCY MODAL ==========
                                    window.openAgentModal = function(unitId) {
                                        if (!unitId) {
                                            Swal.fire({ icon: 'error', title: 'Error', text: 'Unit tidak valid!' });
                                            return;
                                        }
                                        $('#modalAgency').data('unit', unitId);
                                        $('#formAgency').attr('action', "{{ url('marketing/set-agency') }}/" + unitId);
                                        $('#sales_id').val('');
                                        $('#agent_fee_modal').val('');
                                        $('#modalAgency').modal('show');
                                    };

                                    $(document).ready(function() {
                                        // Format Rupiah
                                        $('#booking_fee, #agent_fee_modal').on('input', function() {
                                            let value = $(this).val().replace(/[^0-9]/g, '');
                                            if (value) $(this).val(new Intl.NumberFormat('id-ID').format(value));
                                            else $(this).val('');
                                        });

                                        // File upload handler
                                        $('#bukti_transfer').on('change', function() {
                                            const file = this.files[0];
                                            const $label = $('#buktiLabel');
                                            const $fileName = $('#buktiFileName');
                                            const $fileSize = $('#buktiFileSize');
                                            if (file) {
                                                $fileName.text(file.name.length > 30 ? file.name.substring(0, 30) + '...' : file.name);
                                                if (file.size < 1024 * 1024) $fileSize.text((file.size / 1024).toFixed(1) + ' KB');
                                                else $fileSize.text((file.size / (1024 * 1024)).toFixed(1) + ' MB');
                                                $label.addClass('file-selected');
                                            } else {
                                                $fileName.text('Upload Bukti Transfer');
                                                $fileSize.text('');
                                                $label.removeClass('file-selected');
                                            }
                                        });

                                        // Pilih Customer
                                        $(document).on('click', '.pilihCustomer', function() {
                                            let customerId = $(this).data('id');
                                            let purchaseType = $(this).data('type');
                                            let unitId = $('#modalCustomer').attr('data-unit-id');
                                            let bookingFee = $('#booking_fee').val().replace(/\./g, '');
                                            let buktiTransfer = $('#bukti_transfer')[0].files[0];

                                            if (!unitId) {
                                                Swal.fire({ icon: 'error', title: 'Oops...', text: 'Unit belum dipilih!' });
                                                return;
                                            }
                                            if (!bookingFee || parseInt(bookingFee) <= 0) {
                                                Swal.fire({ icon: 'warning', title: 'Booking Fee Kosong', text: 'Booking fee harus diisi dan lebih dari 0!' });
                                                return;
                                            }
                                            if (!buktiTransfer) {
                                                Swal.fire({ icon: 'warning', title: 'Bukti Transfer Kosong', text: 'Bukti transfer wajib diupload!' });
                                                return;
                                            }
                                            if (buktiTransfer.size > 2 * 1024 * 1024) {
                                                Swal.fire({ icon: 'error', title: 'File Terlalu Besar', text: 'Ukuran file maksimal 2MB!' });
                                                return;
                                            }
                                            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'application/pdf'];
                                            if (!allowedTypes.includes(buktiTransfer.type)) {
                                                Swal.fire({ icon: 'error', title: 'Tipe File Tidak Didukung', text: 'Format file harus JPG, PNG, atau PDF!' });
                                                return;
                                            }

                                            Swal.fire({
                                                title: 'Yakin pilih customer ini?',
                                                html: `<p class="mb-1">Jenis: <b>${purchaseType.toUpperCase()}</b></p><p>Booking Fee: <b>Rp ${new Intl.NumberFormat('id-ID').format(bookingFee)}</b></p><p class="small text-muted mt-2">File: ${buktiTransfer.name}</p>`,
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

                                                    Swal.fire({ title: 'Memproses...', text: 'Harap tunggu', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } });

                                                    $.ajax({
                                                        url: actionUrl,
                                                        type: 'POST',
                                                        data: formData,
                                                        processData: false,
                                                        contentType: false,
                                                        success: function(response) {
                                                            $('#modalCustomer').modal('hide');
                                                            Swal.fire({ icon: 'success', title: 'Berhasil!', text: response.message || 'Customer berhasil dipilih', timer: 1500, showConfirmButton: false }).then(() => location.reload());
                                                        },
                                                        error: function(xhr) {
                                                            let errorMsg = 'Terjadi kesalahan';
                                                            if (xhr.responseJSON && xhr.responseJSON.message) errorMsg = xhr.responseJSON.message;
                                                            else if (xhr.responseJSON && xhr.responseJSON.errors) errorMsg = Object.values(xhr.responseJSON.errors).join('\n');
                                                            Swal.fire({ icon: 'error', title: 'Gagal', text: errorMsg });
                                                        }
                                                    });
                                                }
                                            });
                                        });

                                        // Pilih Agency
                                        $(document).on('click', '.pilihAgency', function() {
                                            let salesId = $(this).data('id');
                                            let agentFee = $('#agent_fee_modal').val().replace(/\./g, '');
                                            if (!agentFee || parseInt(agentFee) <= 0) {
                                                Swal.fire({ icon: 'warning', title: 'Oops...', text: 'Agent fee wajib diisi dan lebih dari 0!' });
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
                                                            Swal.fire({ icon: 'success', title: 'Berhasil', text: 'Agency berhasil dipilih', showConfirmButton: false, timer: 1500 }).then(() => location.reload());
                                                        },
                                                        error: function(xhr) {
                                                            Swal.fire({ icon: 'error', title: 'Gagal', text: xhr.responseJSON?.message || 'Terjadi kesalahan' });
                                                        }
                                                    });
                                                }
                                            });
                                        });

                                        // Search dan Filter
                                        $('#searchCustomer').on('keyup', function() {
                                            const searchTerm = $(this).val().toLowerCase();
                                            $('#customerTable tbody tr').each(function() {
                                                $(this).toggle($(this).text().toLowerCase().indexOf(searchTerm) > -1);
                                            });
                                        });

                                        $('#filterPekerjaan').on('change', function() {
                                            const job = $(this).val();
                                            if (!job) $('#customerTable tbody tr').show();
                                            else {
                                                $('#customerTable tbody tr').each(function() {
                                                    const jobText = $(this).find('td:eq(4)').text().trim();
                                                    $(this).toggle(jobText === job);
                                                });
                                            }
                                        });

                                        $('#searchAgency').on('keyup', function() {
                                            const searchTerm = $(this).val().toLowerCase();
                                            $('#modalAgency .table tbody tr').each(function() {
                                                $(this).toggle($(this).text().toLowerCase().indexOf(searchTerm) > -1);
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
                                    });

                                    // ========== SESSION FLASH MESSAGES ==========
                                    @if (session('success'))
                                        Swal.fire({ icon: 'success', title: 'Berhasil', text: "{{ session('success') }}", showConfirmButton: false, timer: 2000 });
                                    @endif
                                    @if (session('error'))
                                        Swal.fire({ icon: 'error', title: 'Oops...', text: "{{ session('error') }}", confirmButtonColor: '#d33' });
                                    @endif
                                    @if ($errors->any())
                                        Swal.fire({ icon: 'warning', title: 'Validasi Gagal', html: `{!! implode('<br>', $errors->all()) !!}` });
                                    @endif

                                    // Fungsi loading untuk filter
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

                                    // Fungsi loading untuk reset
                                    function showResetLoading(event) {
                                        event.preventDefault();
                                        let url = event.currentTarget.href;
                                        Swal.fire({
                                            title: 'Memuat...',
                                            html: 'Sedang mereset data',
                                            allowOutsideClick: false,
                                            didOpen: () => {
                                                Swal.showLoading();
                                            }
                                        });
                                        window.location.href = url;
                                    }
                                </script>
                            @endpush
