@extends('layouts.partial.app')

@section('title', 'Deadline RAB - Property Management App')

@section('content')
    <style>
        /* ===== CSS SAMA PERSIS DENGAN HALAMAN MASTER DATA PT ===== */
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
        }

        .btn-outline-warning:hover {
            background: linear-gradient(135deg, #ffc107, #ffdb6d);
            color: #2c2e3f;
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

        .btn-outline-success {
            background: transparent;
            border: 1px solid #28a745;
            color: #28a745;
            padding: 0.4rem 0.75rem;
        }

        .btn-outline-success:hover {
            background: linear-gradient(135deg, #28a745, #5cb85c);
            color: #ffffff;
            border-color: transparent;
        }

        .btn-outline-purple {
            background: transparent;
            border: 1px solid #9a55ff;
            color: #9a55ff;
            padding: 0.35rem 0.7rem;
            font-size: 0.8rem;
            border-radius: 6px;
        }

        .btn-outline-purple:hover {
            background: linear-gradient(135deg, #9a55ff, #b47aff);
            color: #ffffff;
            border-color: transparent;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(154, 85, 255, 0.2);
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

        .badge-gradient-primary {
            background: linear-gradient(135deg, #9a55ff, #da8cff);
            color: #ffffff;
        }

        .badge-gradient-secondary {
            background: linear-gradient(135deg, #6c757d, #868e96);
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

        /* Progress bar styling */
        .progress {
            height: 6px;
            border-radius: 3px;
            background-color: #e9ecef;
            margin: 0.5rem 0;
        }

        .progress-bar {
            background: linear-gradient(to right, #da8cff, #9a55ff);
            border-radius: 3px;
        }

        .progress-bar-success {
            background: linear-gradient(135deg, #28a745, #5cb85c);
        }

        .progress-bar-warning {
            background: linear-gradient(135deg, #ffc107, #ffdb6d);
        }

        .progress-bar-danger {
            background: linear-gradient(135deg, #dc3545, #e4606d);
        }

        /* Pagination styling */
        .pagination {
            margin: 0;
            gap: 3px;
        }

        .page-item .page-link {
            border: 1px solid #e9ecef;
            padding: 0.4rem 0.8rem;
            font-size: 0.8rem;
            color: #6c7383;
            background-color: #ffffff;
            border-radius: 6px !important;
            transition: all 0.2s ease;
            min-width: 36px;
            text-align: center;
        }

        @media (min-width: 576px) {
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

        /* Aksi button styling */
        .aksi-buttons {
            display: flex;
            gap: 0.3rem;
            flex-wrap: wrap;
            justify-content: center;
        }

        .aksi-buttons .btn-sm {
            padding: 0.35rem 0.8rem;
            font-size: 0.8rem;
            white-space: nowrap;
        }

        /* Unit badge styling */
        .unit-badge-cluster {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.25rem 0.7rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .unit-badge-cluster i {
            font-size: 0.8rem;
        }

        .unit-cluster-mawar {
            background: linear-gradient(135deg, #fce4e4, #f8d7da);
            color: #dc3545;
            border: 1px solid rgba(220, 53, 69, 0.2);
        }

        .unit-cluster-melati {
            background: linear-gradient(135deg, #e3f2fd, #d1e9ff);
            color: #0d6efd;
            border: 1px solid rgba(13, 110, 253, 0.2);
        }

        .unit-cluster-kenanga {
            background: linear-gradient(135deg, #f3e5f5, #e9d5f0);
            color: #9a55ff;
            border: 1px solid rgba(154, 85, 255, 0.2);
        }

        .unit-cluster-cempaka {
            background: linear-gradient(135deg, #e8f5e9, #d4edda);
            color: #28a745;
            border: 1px solid rgba(40, 167, 69, 0.2);
        }

        .unit-cluster-anggrek {
            background: linear-gradient(135deg, #fff3e0, #ffe0b2);
            color: #fd7e14;
            border: 1px solid rgba(253, 126, 20, 0.2);
        }

        .unit-number {
            font-weight: 600;
            color: #2c2e3f;
            font-size: 0.9rem;
            text-align: center;
        }

        /* Unit container untuk center */
        .unit-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        /* Modal styling */
        .modal-content {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        }

        .modal-header {
            background: linear-gradient(135deg, #f9f7ff, #f2ecff);
            border-bottom: 1px solid #e9ecef;
            padding: 1rem 1.5rem;
        }

        .modal-title {
            color: #9a55ff;
            font-weight: 600;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .modal-footer {
            border-top: 1px solid #e9ecef;
            padding: 1rem 1.5rem;
        }

        /* Modal table styling */
        .modal-table {
            margin-bottom: 0;
        }

        .modal-table th {
            background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
            color: #9a55ff;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e9ecef;
            padding: 0.8rem 0.5rem;
        }

        .modal-table td {
            vertical-align: middle;
            padding: 0.8rem 0.5rem;
            border-bottom: 1px solid #e9ecef;
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
    </style>

    <div class="container-fluid p-2 p-sm-3 p-md-4">
        <!-- Header Dashboard -->
        <div class="row mb-3 mb-sm-3 mb-md-4">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="text-dark mb-1">
                                <i class="mdi mdi-clock-alert-outline me-2" style="color: #9a55ff;"></i>
                                Deadline RAB per Unit
                            </h3>
                            <p class="text-muted mb-0">
                                <i class="mdi mdi-information-outline me-1"></i>
                                Monitor deadline setiap tahapan pekerjaan per unit
                            </p>
                        </div>
                        <div class="d-none d-sm-block">
                            <i class="mdi mdi-clock-alert-outline" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Deadline per Unit -->
        <div class="row mt-2 mt-sm-2 mt-md-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2">
                        <h5 class="card-title mb-0">
                            <i class="mdi mdi-format-list-bulleted me-2 text-primary"></i>
                            Deadline per Unit
                        </h5>
                    </div>

                    <div class="card-body">
                        <!-- Filter Section -->
                        <div class="filter-card mb-4">
                            <div class="card-body">
                                <h6 class="card-title mb-3" style="font-size: 1rem;">
                                    <i class="mdi mdi-filter-outline me-1" style="color: #9a55ff;"></i>
                                    Filter Unit
                                </h6>

                                <!-- FILTER UNTUK MOBILE -->
                                <div class="d-block d-md-none">
                                    <form method="GET" action="">
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">
                                                <i class="mdi mdi-magnify me-1" style="color: #9a55ff;"></i>
                                                Cari Unit
                                            </label>
                                            <input type="text" class="form-control" name="search"
                                                placeholder="Cari unit..." style="height: 45px;">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">
                                                <i class="mdi mdi-flag me-1" style="color: #9a55ff;"></i>Cluster
                                            </label>
                                            <select class="form-control" name="cluster" style="height: 45px;">
                                                <option value="">Semua Cluster</option>
                                                <option value="mawar">Cluster Mawar</option>
                                                <option value="melati">Cluster Melati</option>
                                                <option value="kenanga">Cluster Kenanga</option>
                                                <option value="cempaka">Cluster Cempaka</option>
                                                <option value="anggrek">Cluster Anggrek</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">
                                                <i class="mdi mdi-counter me-1" style="color: #9a55ff;"></i>Tampil per Halaman
                                            </label>
                                            <select class="form-control" name="per_page" style="height: 45px;">
                                                <option value="10">10</option>
                                                <option value="15">15</option>
                                                <option value="25">25</option>
                                            </select>
                                        </div>

                                        <div class="row g-2">
                                            <div class="col-6">
                                                <button type="button"
                                                    class="btn btn-gradient-primary w-100 py-2 d-flex align-items-center justify-content-center">
                                                    <i class="mdi mdi-filter me-1"></i> Filter
                                                </button>
                                            </div>
                                            <div class="col-6">
                                                <a href="#"
                                                    class="btn btn-gradient-secondary w-100 py-2 d-flex align-items-center justify-content-center">
                                                    <i class="mdi mdi-refresh me-1"></i> Reset
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- FILTER UNTUK TABLET & DESKTOP -->
                                <div class="d-none d-md-block">
                                    <form method="GET" action="">
                                        <div class="row g-2 align-items-end">
                                            <div class="col-md-4">
                                                <label class="form-label">
                                                    <i class="mdi mdi-magnify me-1" style="color: #9a55ff;"></i>
                                                    Cari Unit
                                                </label>
                                                <input type="text" class="form-control" name="search"
                                                    placeholder="Nama unit...">
                                            </div>

                                            <div class="col-md-2">
                                                <label class="form-label">
                                                    <i class="mdi mdi-flag me-1" style="color: #9a55ff;"></i>Cluster
                                                </label>
                                                <select class="form-control" name="cluster">
                                                    <option value="">Semua</option>
                                                    <option value="mawar">Cluster Mawar</option>
                                                    <option value="melati">Cluster Melati</option>
                                                    <option value="kenanga">Cluster Kenanga</option>
                                                    <option value="cempaka">Cluster Cempaka</option>
                                                    <option value="anggrek">Cluster Anggrek</option>
                                                </select>
                                            </div>

                                            <div class="col-md-3">
                                                <label class="form-label">
                                                    <i class="mdi mdi-counter me-1" style="color: #9a55ff;"></i>Tampil per Halaman
                                                </label>
                                                <select class="form-control" name="per_page">
                                                    <option value="10">10</option>
                                                    <option value="15">15</option>
                                                    <option value="25">25</option>
                                                </select>
                                            </div>

                                            <div class="col-md-2">
                                                <label class="form-label invisible">Filter</label>
                                                <button type="button"
                                                    class="btn btn-gradient-primary w-100 d-flex align-items-center justify-content-center">
                                                    <i class="mdi mdi-filter me-1"></i> Filter
                                                </button>
                                            </div>

                                            <div class="col-md-1">
                                                <label class="form-label invisible">Reset</label>
                                                <a href="#"
                                                    class="btn btn-gradient-secondary w-100 d-flex align-items-center justify-content-center btn-icon-only"
                                                    title="Reset">
                                                    <i class="mdi mdi-refresh"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Info Summary -->
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="d-flex flex-wrap gap-2">
                                    <span class="badge bg-info">On Track: 3</span>
                                    <span class="badge bg-warning">Mendekati Deadline: 2</span>
                                    <span class="badge bg-danger">Terlambat: 1</span>
                                    <span class="badge bg-success">Selesai: 2</span>
                                </div>
                            </div>
                        </div>

                        <!-- TABEL DATA UNIT -->
                        <div class="table-responsive">
                            <table class="table table-hover align-middle" id="tableUnit">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="5%">No</th>
                                        <th class="text-center" width="15%">Unit</th>
                                        <th width="15%">Progress Keseluruhan</th>
                                        <th width="12%">Target Mulai</th>
                                        <th width="12%">Target Selesai</th>
                                        <th width="8%">Durasi</th>
                                        <th width="10%">Sisa Waktu</th>
                                        <th width="13%">Status</th>
                                        <th class="text-center" width="10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Unit 1 - Cluster Mawar - Blok A.1 -->
                                    <tr>
                                        <td class="text-center fw-bold">1</td>
                                        <td class="text-center">
                                            <div class="unit-container">
                                                <span class="unit-number">A.1</span>
                                                <span class="unit-badge-cluster unit-cluster-mawar">
                                                    <i class="mdi mdi-flower-outline"></i> Cluster Mawar
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="progress" style="height: 6px;">
                                                <div class="progress-bar bg-success" style="width: 92%"></div>
                                            </div>
                                            <small class="fw-bold">92%</small>
                                            <br>
                                            <small class="text-muted">(11/12 item selesai)</small>
                                        </td>
                                        <td>01 Mar 2024</td>
                                        <td>20 Jun 2024</td>
                                        <td>112 hari</td>
                                        <td>
                                            <span class="fw-bold">H-15</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-info badge-gradient-info">On Track</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="aksi-buttons">
                                                <button type="button"
                                                        class="btn btn-outline-warning btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editDeadlineModal">
                                                    <i class="mdi mdi-pencil-outline"></i>
                                                </button>
                                                <button type="button"
                                                        class="btn btn-outline-success btn-sm btn-view-detail"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#detailUnitModal"
                                                        data-unit="A.1"
                                                        data-cluster="Cluster Mawar">
                                                    <i class="mdi mdi-eye-outline"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Unit 2 - Cluster Melati - Blok B.2 -->
                                    <tr>
                                        <td class="text-center fw-bold">2</td>
                                        <td class="text-center">
                                            <div class="unit-container">
                                                <span class="unit-number">B.2</span>
                                                <span class="unit-badge-cluster unit-cluster-melati">
                                                    <i class="mdi mdi-flower-outline"></i> Cluster Melati
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="progress" style="height: 6px;">
                                                <div class="progress-bar bg-success" style="width: 100%"></div>
                                            </div>
                                            <small class="fw-bold">100%</small>
                                            <br>
                                            <small class="text-muted">(12/12 item selesai)</small>
                                        </td>
                                        <td>01 Mar 2024</td>
                                        <td>15 Mei 2024</td>
                                        <td>76 hari</td>
                                        <td>
                                            <span class="fw-bold text-success">Selesai</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-success badge-gradient-success">Selesai</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="aksi-buttons">
                                                <button type="button"
                                                        class="btn btn-outline-warning btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editDeadlineModal">
                                                    <i class="mdi mdi-pencil-outline"></i>
                                                </button>
                                                <button type="button"
                                                        class="btn btn-outline-success btn-sm btn-view-detail"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#detailUnitModal"
                                                        data-unit="B.2"
                                                        data-cluster="Cluster Melati">
                                                    <i class="mdi mdi-eye-outline"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Unit 3 - Cluster Kenanga - Blok C.1 -->
                                    <tr>
                                        <td class="text-center fw-bold">3</td>
                                        <td class="text-center">
                                            <div class="unit-container">
                                                <span class="unit-number">C.1</span>
                                                <span class="unit-badge-cluster unit-cluster-kenanga">
                                                    <i class="mdi mdi-flower-outline"></i> Cluster Kenanga
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="progress" style="height: 6px;">
                                                <div class="progress-bar bg-warning" style="width: 65%"></div>
                                            </div>
                                            <small class="fw-bold">65%</small>
                                            <br>
                                            <small class="text-muted">(8/12 item selesai)</small>
                                        </td>
                                        <td>15 Mar 2024</td>
                                        <td>30 Jun 2024</td>
                                        <td>108 hari</td>
                                        <td>
                                            <span class="fw-bold text-warning">H-5</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-warning badge-gradient-warning">Mendekati Deadline</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="aksi-buttons">
                                                <button type="button"
                                                        class="btn btn-outline-warning btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editDeadlineModal">
                                                    <i class="mdi mdi-pencil-outline"></i>
                                                </button>
                                                <button type="button"
                                                        class="btn btn-outline-success btn-sm btn-view-detail"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#detailUnitModal"
                                                        data-unit="C.1"
                                                        data-cluster="Cluster Kenanga">
                                                    <i class="mdi mdi-eye-outline"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Unit 4 - Cluster Cempaka - Blok D.2 -->
                                    <tr>
                                        <td class="text-center fw-bold">4</td>
                                        <td class="text-center">
                                            <div class="unit-container">
                                                <span class="unit-number">D.2</span>
                                                <span class="unit-badge-cluster unit-cluster-cempaka">
                                                    <i class="mdi mdi-flower-outline"></i> Cluster Cempaka
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="progress" style="height: 6px;">
                                                <div class="progress-bar bg-primary" style="width: 45%"></div>
                                            </div>
                                            <small class="fw-bold">45%</small>
                                            <br>
                                            <small class="text-muted">(5/12 item selesai)</small>
                                        </td>
                                        <td>01 Apr 2024</td>
                                        <td>15 Jul 2024</td>
                                        <td>106 hari</td>
                                        <td>
                                            <span class="fw-bold">H-20</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-info badge-gradient-info">On Track</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="aksi-buttons">
                                                <button type="button"
                                                        class="btn btn-outline-warning btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editDeadlineModal">
                                                    <i class="mdi mdi-pencil-outline"></i>
                                                </button>
                                                <button type="button"
                                                        class="btn btn-outline-success btn-sm btn-view-detail"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#detailUnitModal"
                                                        data-unit="D.2"
                                                        data-cluster="Cluster Cempaka">
                                                    <i class="mdi mdi-eye-outline"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Unit 5 - Cluster Anggrek - Blok E.1 -->
                                    <tr>
                                        <td class="text-center fw-bold">5</td>
                                        <td class="text-center">
                                            <div class="unit-container">
                                                <span class="unit-number">E.1</span>
                                                <span class="unit-badge-cluster unit-cluster-anggrek">
                                                    <i class="mdi mdi-flower-outline"></i> Cluster Anggrek
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="progress" style="height: 6px;">
                                                <div class="progress-bar bg-danger" style="width: 30%"></div>
                                            </div>
                                            <small class="fw-bold">30%</small>
                                            <br>
                                            <small class="text-muted">(4/12 item selesai)</small>
                                        </td>
                                        <td>01 Feb 2024</td>
                                        <td>30 Mei 2024</td>
                                        <td>120 hari</td>
                                        <td>
                                            <span class="text-danger fw-bold">Lewat 5 hari</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-danger badge-gradient-danger">Terlambat</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="aksi-buttons">
                                                <button type="button"
                                                        class="btn btn-outline-warning btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editDeadlineModal">
                                                    <i class="mdi mdi-pencil-outline"></i>
                                                </button>
                                                <button type="button"
                                                        class="btn btn-outline-success btn-sm btn-view-detail"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#detailUnitModal"
                                                        data-unit="E.1"
                                                        data-cluster="Cluster Anggrek">
                                                    <i class="mdi mdi-eye-outline"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Unit 6 - Cluster Mawar - Blok A.3 -->
                                    <tr>
                                        <td class="text-center fw-bold">6</td>
                                        <td class="text-center">
                                            <div class="unit-container">
                                                <span class="unit-number">A.3</span>
                                                <span class="unit-badge-cluster unit-cluster-mawar">
                                                    <i class="mdi mdi-flower-outline"></i> Cluster Mawar
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="progress" style="height: 6px;">
                                                <div class="progress-bar bg-success" style="width: 100%"></div>
                                            </div>
                                            <small class="fw-bold">100%</small>
                                            <br>
                                            <small class="text-muted">(12/12 item selesai)</small>
                                        </td>
                                        <td>01 Mar 2024</td>
                                        <td>10 Jun 2024</td>
                                        <td>102 hari</td>
                                        <td>
                                            <span class="fw-bold text-success">Selesai</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-success badge-gradient-success">Selesai</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="aksi-buttons">
                                                <button type="button"
                                                        class="btn btn-outline-warning btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editDeadlineModal">
                                                    <i class="mdi mdi-pencil-outline"></i>
                                                </button>
                                                <button type="button"
                                                        class="btn btn-outline-success btn-sm btn-view-detail"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#detailUnitModal"
                                                        data-unit="A.3"
                                                        data-cluster="Cluster Mawar">
                                                    <i class="mdi mdi-eye-outline"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Unit 7 - Cluster Melati - Blok B.4 -->
                                    <tr>
                                        <td class="text-center fw-bold">7</td>
                                        <td class="text-center">
                                            <div class="unit-container">
                                                <span class="unit-number">B.4</span>
                                                <span class="unit-badge-cluster unit-cluster-melati">
                                                    <i class="mdi mdi-flower-outline"></i> Cluster Melati
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="progress" style="height: 6px;">
                                                <div class="progress-bar bg-primary" style="width: 75%"></div>
                                            </div>
                                            <small class="fw-bold">75%</small>
                                            <br>
                                            <small class="text-muted">(9/12 item selesai)</small>
                                        </td>
                                        <td>15 Mar 2024</td>
                                        <td>15 Jul 2024</td>
                                        <td>123 hari</td>
                                        <td>
                                            <span class="fw-bold">H-25</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-info badge-gradient-info">On Track</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="aksi-buttons">
                                                <button type="button"
                                                        class="btn btn-outline-warning btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editDeadlineModal">
                                                    <i class="mdi mdi-pencil-outline"></i>
                                                </button>
                                                <button type="button"
                                                        class="btn btn-outline-success btn-sm btn-view-detail"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#detailUnitModal"
                                                        data-unit="B.4"
                                                        data-cluster="Cluster Melati">
                                                    <i class="mdi mdi-eye-outline"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Unit 8 - Cluster Kenanga - Blok C.3 -->
                                    <tr>
                                        <td class="text-center fw-bold">8</td>
                                        <td class="text-center">
                                            <div class="unit-container">
                                                <span class="unit-number">C.3</span>
                                                <span class="unit-badge-cluster unit-cluster-kenanga">
                                                    <i class="mdi mdi-flower-outline"></i> Cluster Kenanga
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="progress" style="height: 6px;">
                                                <div class="progress-bar bg-primary" style="width: 55%"></div>
                                            </div>
                                            <small class="fw-bold">55%</small>
                                            <br>
                                            <small class="text-muted">(7/12 item selesai)</small>
                                        </td>
                                        <td>01 Apr 2024</td>
                                        <td>30 Jul 2024</td>
                                        <td>121 hari</td>
                                        <td>
                                            <span class="fw-bold">H-30</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-info badge-gradient-info">On Track</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="aksi-buttons">
                                                <button type="button"
                                                        class="btn btn-outline-warning btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editDeadlineModal">
                                                    <i class="mdi mdi-pencil-outline"></i>
                                                </button>
                                                <button type="button"
                                                        class="btn btn-outline-success btn-sm btn-view-detail"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#detailUnitModal"
                                                        data-unit="C.3"
                                                        data-cluster="Cluster Kenanga">
                                                    <i class="mdi mdi-eye-outline"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination UI -->
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                            <div class="pagination-info mb-2 mb-sm-0">
                                <i class="mdi mdi-information-outline me-1 text-primary"></i>
                                Menampilkan
                                <span class="fw-bold">1</span>
                                -
                                <span class="fw-bold">8</span>
                                dari
                                <span class="fw-bold">8</span>
                                unit
                            </div>

                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0" style="gap: 2px;">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" aria-label="Previous">
                                            <i class="mdi mdi-chevron-left"></i>
                                        </a>
                                    </li>

                                    <li class="page-item active">
                                        <a class="page-link" href="#">1</a>
                                    </li>

                                    <li class="page-item disabled">
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

        <!-- Modal Detail Unit -->
        <div class="modal fade" id="detailUnitModal" tabindex="-1" aria-labelledby="detailUnitModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailUnitModalLabel">
                            <i class="mdi mdi-home-outline me-2" style="color: #9a55ff;"></i>
                            Detail Pekerjaan Unit <span id="detailUnitNumber"></span> - <span id="detailUnitCluster"></span>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table modal-table">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="25%">Pekerjaan</th>
                                        <th width="10%">Progress</th>
                                        <th width="12%">Target Mulai</th>
                                        <th width="12%">Target Selesai</th>
                                        <th width="8%">Durasi</th>
                                        <th width="10%">Sisa Waktu</th>
                                        <th width="10%">Status</th>
                                        <th class="text-center" width="8%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Pekerjaan Pondasi -->
                                    <tr>
                                        <td class="text-center fw-bold">1</td>
                                        <td class="fw-bold">Pekerjaan Pondasi</td>
                                        <td>
                                            <div class="progress" style="height: 6px;">
                                                <div class="progress-bar bg-success" style="width: 100%"></div>
                                            </div>
                                            <small class="fw-bold">100%</small>
                                        </td>
                                        <td>01 Mar 2024</td>
                                        <td>15 Mar 2024</td>
                                        <td>15 hari</td>
                                        <td>
                                            <span class="fw-bold text-success">Selesai</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-success badge-gradient-success">Selesai</span>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-outline-warning btn-sm">
                                                <i class="mdi mdi-pencil-outline"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- Pekerjaan Struktur -->
                                    <tr>
                                        <td class="text-center fw-bold">2</td>
                                        <td class="fw-bold">Pekerjaan Struktur</td>
                                        <td>
                                            <div class="progress" style="height: 6px;">
                                                <div class="progress-bar bg-success" style="width: 100%"></div>
                                            </div>
                                            <small class="fw-bold">100%</small>
                                        </td>
                                        <td>16 Mar 2024</td>
                                        <td>30 Apr 2024</td>
                                        <td>46 hari</td>
                                        <td>
                                            <span class="fw-bold text-success">Selesai</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-success badge-gradient-success">Selesai</span>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-outline-warning btn-sm">
                                                <i class="mdi mdi-pencil-outline"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- Pekerjaan Dinding -->
                                    <tr>
                                        <td class="text-center fw-bold">3</td>
                                        <td class="fw-bold">Pekerjaan Dinding</td>
                                        <td>
                                            <div class="progress" style="height: 6px;">
                                                <div class="progress-bar bg-success" style="width: 100%"></div>
                                            </div>
                                            <small class="fw-bold">100%</small>
                                        </td>
                                        <td>01 Apr 2024</td>
                                        <td>15 Mei 2024</td>
                                        <td>45 hari</td>
                                        <td>
                                            <span class="fw-bold text-success">Selesai</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-success badge-gradient-success">Selesai</span>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-outline-warning btn-sm">
                                                <i class="mdi mdi-pencil-outline"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- Pekerjaan Atap -->
                                    <tr>
                                        <td class="text-center fw-bold">4</td>
                                        <td class="fw-bold">Pekerjaan Atap</td>
                                        <td>
                                            <div class="progress" style="height: 6px;">
                                                <div class="progress-bar bg-success" style="width: 100%"></div>
                                            </div>
                                            <small class="fw-bold">100%</small>
                                        </td>
                                        <td>16 Apr 2024</td>
                                        <td>10 Mei 2024</td>
                                        <td>25 hari</td>
                                        <td>
                                            <span class="fw-bold text-success">Selesai</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-success badge-gradient-success">Selesai</span>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-outline-warning btn-sm">
                                                <i class="mdi mdi-pencil-outline"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- Instalasi Listrik -->
                                    <tr>
                                        <td class="text-center fw-bold">5</td>
                                        <td class="fw-bold">Instalasi Listrik</td>
                                        <td>
                                            <div class="progress" style="height: 6px;">
                                                <div class="progress-bar bg-success" style="width: 100%"></div>
                                            </div>
                                            <small class="fw-bold">100%</small>
                                        </td>
                                        <td>20 Apr 2024</td>
                                        <td>05 Mei 2024</td>
                                        <td>16 hari</td>
                                        <td>
                                            <span class="fw-bold text-success">Selesai</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-success badge-gradient-success">Selesai</span>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-outline-warning btn-sm">
                                                <i class="mdi mdi-pencil-outline"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- Pekerjaan Plafon -->
                                    <tr>
                                        <td class="text-center fw-bold">6</td>
                                        <td class="fw-bold">Pekerjaan Plafon</td>
                                        <td>
                                            <div class="progress" style="height: 6px;">
                                                <div class="progress-bar bg-success" style="width: 80%"></div>
                                            </div>
                                            <small class="fw-bold">80%</small>
                                        </td>
                                        <td>25 Mar 2024</td>
                                        <td>20 Jun 2024</td>
                                        <td>88 hari</td>
                                        <td>
                                            <span class="fw-bold">H-10</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-info badge-gradient-info">On Track</span>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-outline-warning btn-sm">
                                                <i class="mdi mdi-pencil-outline"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- Pekerjaan Finishing -->
                                    <tr>
                                        <td class="text-center fw-bold">7</td>
                                        <td class="fw-bold">Pekerjaan Finishing</td>
                                        <td>
                                            <div class="progress" style="height: 6px;">
                                                <div class="progress-bar bg-primary" style="width: 60%"></div>
                                            </div>
                                            <small class="fw-bold">60%</small>
                                        </td>
                                        <td>21 Apr 2024</td>
                                        <td>15 Jul 2024</td>
                                        <td>86 hari</td>
                                        <td>
                                            <span class="fw-bold">H-25</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-info badge-gradient-info">On Track</span>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-outline-warning btn-sm">
                                                <i class="mdi mdi-pencil-outline"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- Pekerjaan Landscape -->
                                    <tr>
                                        <td class="text-center fw-bold">8</td>
                                        <td class="fw-bold">Pekerjaan Landscape</td>
                                        <td>
                                            <div class="progress" style="height: 6px;">
                                                <div class="progress-bar bg-primary" style="width: 40%"></div>
                                            </div>
                                            <small class="fw-bold">40%</small>
                                        </td>
                                        <td>06 Mei 2024</td>
                                        <td>30 Jul 2024</td>
                                        <td>86 hari</td>
                                        <td>
                                            <span class="fw-bold">H-30</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-info badge-gradient-info">On Track</span>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-outline-warning btn-sm">
                                                <i class="mdi mdi-pencil-outline"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">
                            <i class="mdi mdi-close me-1"></i> Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit Deadline -->
        <div class="modal fade" id="editDeadlineModal" tabindex="-1" aria-labelledby="editDeadlineModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="formEditDeadline" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="editDeadlineModalLabel">
                                <i class="mdi mdi-clock-edit-outline me-2" style="color: #9a55ff;"></i>
                                Edit Deadline Pekerjaan
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="kategori" id="editKategori" value="">

                            <div class="mb-3">
                                <label class="form-label">Tahapan Pekerjaan</label>
                                <input type="text" class="form-control" id="editKategoriDisplay" readonly disabled>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Target Mulai</label>
                                    <input type="date" class="form-control" name="target_mulai" id="editTargetMulai" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Target Selesai</label>
                                    <input type="date" class="form-control" name="target_selesai" id="editTargetSelesai" required>
                                </div>
                            </div>

                            <div class="alert alert-info py-2" id="durasiInfo" style="font-size: 0.9rem;">
                                <i class="mdi mdi-information-outline me-1"></i>
                                Durasi: <span id="durasiText">0 hari</span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">
                                <i class="mdi mdi-close me-1"></i> Batal
                            </button>
                            <button type="button" class="btn btn-gradient-primary">
                                <i class="mdi mdi-content-save me-1"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi Bawah -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="d-flex flex-column flex-sm-row justify-content-start gap-2">
                            <a href="#" class="btn btn-gradient-secondary">
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
            // Handle view detail button click
            $('.btn-view-detail').on('click', function() {
                let unit = $(this).data('unit');
                let cluster = $(this).data('cluster');

                $('#detailUnitNumber').text(unit);
                $('#detailUnitCluster').text(cluster);
            });

            // Handle edit button click
            $('.btn-outline-warning').on('click', function() {
                // Cek apakah ini tombol edit di modal detail atau di tabel utama
                if ($(this).closest('#detailUnitModal').length) {
                    // Ini tombol edit di modal detail
                    let row = $(this).closest('tr');
                    let pekerjaan = row.find('td:eq(1)').text().trim();
                    let targetMulai = row.find('td:eq(3)').text().trim();
                    let targetSelesai = row.find('td:eq(4)').text().trim();

                    // Konversi format tanggal
                    let mulaiParts = targetMulai.split(' ');
                    let selesaiParts = targetSelesai.split(' ');

                    let bulanMapping = {
                        'Jan': '01', 'Feb': '02', 'Mar': '03', 'Apr': '04', 'Mei': '05', 'Jun': '06',
                        'Jul': '07', 'Agu': '08', 'Sep': '09', 'Okt': '10', 'Nov': '11', 'Des': '12'
                    };

                    let mulaiFormat = '';
                    let selesaiFormat = '';

                    if (mulaiParts.length === 3) {
                        let hari = mulaiParts[0].padStart(2, '0');
                        let bulan = bulanMapping[mulaiParts[1]] || '01';
                        let tahun = mulaiParts[2];
                        mulaiFormat = `${tahun}-${bulan}-${hari}`;
                    }

                    if (selesaiParts.length === 3) {
                        let hari = selesaiParts[0].padStart(2, '0');
                        let bulan = bulanMapping[selesaiParts[1]] || '01';
                        let tahun = selesaiParts[2];
                        selesaiFormat = `${tahun}-${bulan}-${hari}`;
                    }

                    $('#editKategori').val(pekerjaan.toLowerCase().replace(/ /g, '_'));
                    $('#editKategoriDisplay').val(pekerjaan);
                    $('#editTargetMulai').val(mulaiFormat);
                    $('#editTargetSelesai').val(selesaiFormat);

                    hitungDurasi();

                    // Tutup modal detail
                    $('#detailUnitModal').modal('hide');

                    // Buka modal edit setelah delay
                    setTimeout(function() {
                        $('#editDeadlineModal').modal('show');
                    }, 500);

                } else {
                    // Ini tombol edit di tabel utama
                    let row = $(this).closest('tr');
                    let unit = row.find('.unit-number').text();
                    let cluster = row.find('.unit-badge-cluster').text().trim();

                    $('#editKategori').val('unit_' + unit.replace('.', '_'));
                    $('#editKategoriDisplay').val('Unit ' + unit + ' - ' + cluster);
                    $('#editTargetMulai').val('');
                    $('#editTargetSelesai').val('');

                    hitungDurasi();

                    $('#editDeadlineModal').modal('show');
                }
            });

            // Hitung durasi saat tanggal berubah
            $('#editTargetMulai, #editTargetSelesai').on('change', function() {
                hitungDurasi();
            });

            function hitungDurasi() {
                let mulai = $('#editTargetMulai').val();
                let selesai = $('#editTargetSelesai').val();

                if (mulai && selesai) {
                    let date1 = new Date(mulai);
                    let date2 = new Date(selesai);
                    let diffTime = Math.abs(date2 - date1);
                    let diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;

                    $('#durasiText').text(diffDays + ' hari');
                } else {
                    $('#durasiText').text('0 hari');
                }
            }
        });
    </script>
@endpush
