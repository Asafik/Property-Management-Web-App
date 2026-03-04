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

        /* Deadline specific styling */
        .deadline-info {
            display: flex;
            flex-direction: column;
            gap: 0.2rem;
        }

        .deadline-date {
            font-weight: 600;
            color: #2c2e3f;
        }

        .deadline-countdown {
            font-size: 0.75rem;
            padding: 0.2rem 0.5rem;
            border-radius: 20px;
            display: inline-block;
            width: fit-content;
        }

        .deadline-countdown.danger {
            background: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            border: 1px solid rgba(220, 53, 69, 0.2);
        }

        .deadline-countdown.warning {
            background: rgba(255, 193, 7, 0.1);
            color: #ffc107;
            border: 1px solid rgba(255, 193, 7, 0.2);
        }

        .deadline-countdown.success {
            background: rgba(40, 167, 69, 0.1);
            color: #28a745;
            border: 1px solid rgba(40, 167, 69, 0.2);
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
                                <i class="mdi mdi-clock-alert me-2" style="color: #9a55ff;"></i>
                                Deadline RAB per Pekerjaan
                            </h3>
                            <p class="text-muted mb-0">
                                <i class="mdi mdi-information-outline me-1"></i>
                                Monitor deadline setiap tahapan pekerjaan pembangunan
                            </p>
                        </div>
                        <div class="d-none d-sm-block">
                            <i class="mdi mdi-clock-alert" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Deadline per Pekerjaan -->
        <div class="row mt-2 mt-sm-2 mt-md-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2">
                        <h5 class="card-title mb-0">
                            <i class="mdi mdi-format-list-bulleted me-2 text-primary"></i>
                            Deadline per Tahapan Pekerjaan
                        </h5>
                    </div>

                    <div class="card-body">
                        <!-- Filter Section -->
                        <div class="filter-card mb-4">
                            <div class="card-body">
                                <h6 class="card-title mb-3" style="font-size: 1rem;">
                                    <i class="mdi mdi-filter-outline me-1" style="color: #9a55ff;"></i>
                                    Filter Deadline
                                </h6>

                                <!-- FILTER UNTUK MOBILE -->
                                <div class="d-block d-md-none">
                                    <form method="GET" action="">
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">
                                                <i class="mdi mdi-magnify me-1" style="color: #9a55ff;"></i>
                                                Cari Pekerjaan
                                            </label>
                                            <input type="text" class="form-control" name="search"
                                                placeholder="Cari pekerjaan..." style="height: 45px;">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">
                                                <i class="mdi mdi-flag me-1" style="color: #9a55ff;"></i>Status
                                            </label>
                                            <select class="form-control" name="status" style="height: 45px;">
                                                <option value="">Semua</option>
                                                <option value="on-time">On Time</option>
                                                <option value="warning">H-7 / H-3</option>
                                                <option value="danger">Overdue / H-1</option>
                                                <option value="success">Selesai</option>
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
                                                    Cari Pekerjaan
                                                </label>
                                                <input type="text" class="form-control" name="search"
                                                    placeholder="Nama pekerjaan...">
                                            </div>

                                            <div class="col-md-2">
                                                <label class="form-label">
                                                    <i class="mdi mdi-flag me-1" style="color: #9a55ff;"></i>Status
                                                </label>
                                                <select class="form-control" name="status">
                                                    <option value="">Semua</option>
                                                    <option value="on-time">On Time</option>
                                                    <option value="warning">H-7 / H-3</option>
                                                    <option value="danger">Overdue / H-1</option>
                                                    <option value="success">Selesai</option>
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

                        <!-- TABEL DATA DEADLINE PER PEKERJAAN -->
                        <div class="table-responsive">
                            <table class="table table-hover align-middle" id="tableDeadline">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="5%">No</th>
                                        <th width="20%">Tahapan Pekerjaan</th>
                                        <th width="10%">Progress</th>
                                        <th width="12%">Target Mulai</th>
                                        <th width="12%">Target Selesai</th>
                                        <th width="8%">Durasi</th>
                                        <th width="10%">Sisa Waktu</th>
                                        <th width="10%">Status</th>
                                        <th class="text-center" width="13%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data 1 - Pekerjaan Pondasi -->
                                    <tr>
                                        <td class="text-center fw-bold">1</td>
                                        <td class="fw-bold text-uppercase">
                                            Pekerjaan Pondasi
                                            <br>
                                            <small class="text-muted">8 item</small>
                                        </td>
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
                                            <div class="aksi-buttons">
                                                <button type="button"
                                                        class="btn btn-outline-warning btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editDeadlineModal"
                                                        data-kategori="pondasi"
                                                        data-mulai="2024-03-01"
                                                        data-selesai="2024-03-15">
                                                    <i class="mdi mdi-pencil"></i>
                                                    <span class="d-none d-sm-inline ms-1">Edit</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Data 2 - Pekerjaan Struktur -->
                                    <tr>
                                        <td class="text-center fw-bold">2</td>
                                        <td class="fw-bold text-uppercase">
                                            Pekerjaan Struktur
                                            <br>
                                            <small class="text-muted">12 item</small>
                                        </td>
                                        <td>
                                            <div class="progress" style="height: 6px;">
                                                <div class="progress-bar bg-primary" style="width: 75%"></div>
                                            </div>
                                            <small class="fw-bold">75%</small>
                                        </td>
                                        <td>16 Mar 2024</td>
                                        <td>30 Apr 2024</td>
                                        <td>46 hari</td>
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
                                                        data-bs-target="#editDeadlineModal"
                                                        data-kategori="struktur"
                                                        data-mulai="2024-03-16"
                                                        data-selesai="2024-04-30">
                                                    <i class="mdi mdi-pencil"></i>
                                                    <span class="d-none d-sm-inline ms-1">Edit</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Data 3 - Pekerjaan Dinding -->
                                    <tr>
                                        <td class="text-center fw-bold">3</td>
                                        <td class="fw-bold text-uppercase">
                                            Pekerjaan Dinding
                                            <br>
                                            <small class="text-muted">10 item</small>
                                        </td>
                                        <td>
                                            <div class="progress" style="height: 6px;">
                                                <div class="progress-bar bg-primary" style="width: 60%"></div>
                                            </div>
                                            <small class="fw-bold">60%</small>
                                        </td>
                                        <td>01 Apr 2024</td>
                                        <td>15 Mei 2024</td>
                                        <td>45 hari</td>
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
                                                        data-bs-target="#editDeadlineModal"
                                                        data-kategori="dinding"
                                                        data-mulai="2024-04-01"
                                                        data-selesai="2024-05-15">
                                                    <i class="mdi mdi-pencil"></i>
                                                    <span class="d-none d-sm-inline ms-1">Edit</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Data 4 - Pekerjaan Atap -->
                                    <tr>
                                        <td class="text-center fw-bold">4</td>
                                        <td class="fw-bold text-uppercase">
                                            Pekerjaan Atap
                                            <br>
                                            <small class="text-muted">6 item</small>
                                        </td>
                                        <td>
                                            <div class="progress" style="height: 6px;">
                                                <div class="progress-bar bg-warning" style="width: 40%"></div>
                                            </div>
                                            <small class="fw-bold">40%</small>
                                        </td>
                                        <td>16 Apr 2024</td>
                                        <td>10 Mei 2024</td>
                                        <td>25 hari</td>
                                        <td>
                                            <span class="fw-bold text-warning">H-3</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-warning badge-gradient-warning">Mendekati Deadline</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="aksi-buttons">
                                                <button type="button"
                                                        class="btn btn-outline-warning btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editDeadlineModal"
                                                        data-kategori="atap"
                                                        data-mulai="2024-04-16"
                                                        data-selesai="2024-05-10">
                                                    <i class="mdi mdi-pencil"></i>
                                                    <span class="d-none d-sm-inline ms-1">Edit</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Data 5 - Pekerjaan Instalasi Listrik -->
                                    <tr>
                                        <td class="text-center fw-bold">5</td>
                                        <td class="fw-bold text-uppercase">
                                            Instalasi Listrik
                                            <br>
                                            <small class="text-muted">5 item</small>
                                        </td>
                                        <td>
                                            <div class="progress" style="height: 6px;">
                                                <div class="progress-bar bg-warning" style="width: 30%"></div>
                                            </div>
                                            <small class="fw-bold">30%</small>
                                        </td>
                                        <td>20 Apr 2024</td>
                                        <td>05 Mei 2024</td>
                                        <td>16 hari</td>
                                        <td>
                                            <span class="fw-bold text-warning">H-2</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-warning badge-gradient-warning">Mendekati Deadline</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="aksi-buttons">
                                                <button type="button"
                                                        class="btn btn-outline-warning btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editDeadlineModal"
                                                        data-kategori="listrik"
                                                        data-mulai="2024-04-20"
                                                        data-selesai="2024-05-05">
                                                    <i class="mdi mdi-pencil"></i>
                                                    <span class="d-none d-sm-inline ms-1">Edit</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Data 6 - Pekerjaan Plafon -->
                                    <tr>
                                        <td class="text-center fw-bold">6</td>
                                        <td class="fw-bold text-uppercase">
                                            Pekerjaan Plafon
                                            <br>
                                            <small class="text-muted">4 item</small>
                                        </td>
                                        <td>
                                            <div class="progress" style="height: 6px;">
                                                <div class="progress-bar bg-danger" style="width: 25%"></div>
                                            </div>
                                            <small class="fw-bold">25%</small>
                                        </td>
                                        <td>25 Mar 2024</td>
                                        <td>20 Apr 2024</td>
                                        <td>27 hari</td>
                                        <td>
                                            <span class="text-danger fw-bold">Lewat 4 hari</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-danger badge-gradient-danger">Terlambat</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="aksi-buttons">
                                                <button type="button"
                                                        class="btn btn-outline-warning btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editDeadlineModal"
                                                        data-kategori="plafon"
                                                        data-mulai="2024-03-25"
                                                        data-selesai="2024-04-20">
                                                    <i class="mdi mdi-pencil"></i>
                                                    <span class="d-none d-sm-inline ms-1">Edit</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Data 7 - Pekerjaan Finishing -->
                                    <tr>
                                        <td class="text-center fw-bold">7</td>
                                        <td class="fw-bold text-uppercase">
                                            Pekerjaan Finishing
                                            <br>
                                            <small class="text-muted">9 item</small>
                                        </td>
                                        <td>
                                            <div class="progress" style="height: 6px;">
                                                <div class="progress-bar bg-success" style="width: 100%"></div>
                                            </div>
                                            <small class="fw-bold">100%</small>
                                        </td>
                                        <td>21 Apr 2024</td>
                                        <td>05 Mei 2024</td>
                                        <td>15 hari</td>
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
                                                        data-bs-target="#editDeadlineModal"
                                                        data-kategori="finishing"
                                                        data-mulai="2024-04-21"
                                                        data-selesai="2024-05-05">
                                                    <i class="mdi mdi-pencil"></i>
                                                    <span class="d-none d-sm-inline ms-1">Edit</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Data 8 - Pekerjaan Landscape -->
                                    <tr>
                                        <td class="text-center fw-bold">8</td>
                                        <td class="fw-bold text-uppercase">
                                            Pekerjaan Landscape
                                            <br>
                                            <small class="text-muted">6 item</small>
                                        </td>
                                        <td>
                                            <div class="progress" style="height: 6px;">
                                                <div class="progress-bar bg-info" style="width: 10%"></div>
                                            </div>
                                            <small class="fw-bold">10%</small>
                                        </td>
                                        <td>06 Mei 2024</td>
                                        <td>20 Jun 2024</td>
                                        <td>46 hari</td>
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
                                                        data-bs-target="#editDeadlineModal"
                                                        data-kategori="landscape"
                                                        data-mulai="2024-05-06"
                                                        data-selesai="2024-06-20">
                                                    <i class="mdi mdi-pencil"></i>
                                                    <span class="d-none d-sm-inline ms-1">Edit</span>
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
                                tahapan pekerjaan
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

        <!-- Modal Edit Deadline -->
        <div class="modal fade" id="editDeadlineModal" tabindex="-1" aria-labelledby="editDeadlineModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="formEditDeadline" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="editDeadlineModalLabel">
                                <i class="mdi mdi-clock-edit me-2" style="color: #9a55ff;"></i>
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
            // Handle edit button click
            $('.btn-outline-warning').on('click', function() {
                let kategori = $(this).data('kategori');
                let mulai = $(this).data('mulai');
                let selesai = $(this).data('selesai');

                // Format kategori untuk display
                let kategoriDisplay = '';
                if (kategori === 'pondasi') kategoriDisplay = 'Pekerjaan Pondasi';
                else if (kategori === 'struktur') kategoriDisplay = 'Pekerjaan Struktur';
                else if (kategori === 'dinding') kategoriDisplay = 'Pekerjaan Dinding';
                else if (kategori === 'atap') kategoriDisplay = 'Pekerjaan Atap';
                else if (kategori === 'listrik') kategoriDisplay = 'Instalasi Listrik';
                else if (kategori === 'plafon') kategoriDisplay = 'Pekerjaan Plafon';
                else if (kategori === 'finishing') kategoriDisplay = 'Pekerjaan Finishing';
                else if (kategori === 'landscape') kategoriDisplay = 'Pekerjaan Landscape';
                else kategoriDisplay = kategori.charAt(0).toUpperCase() + kategori.slice(1);

                $('#editKategori').val(kategori);
                $('#editKategoriDisplay').val(kategoriDisplay);
                $('#editTargetMulai').val(mulai);
                $('#editTargetSelesai').val(selesai);

                hitungDurasi();
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

            // Demo alert untuk notifikasi
            $('.btn-gradient-primary').on('click', function() {
                if ($(this).closest('.modal-footer').length) {
                    // Ini adalah tombol simpan di modal
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Data deadline berhasil disimpan',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    $('#editDeadlineModal').modal('hide');
                }
            });

            // Demo alert untuk filter
            $('.btn-gradient-primary:contains("Filter")').on('click', function() {
                Swal.fire({
                    icon: 'info',
                    title: 'Demo',
                    text: 'Filter akan diterapkan',
                    timer: 1500,
                    showConfirmButton: false
                });
            });
        });
    </script>
@endpush
