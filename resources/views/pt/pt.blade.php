@extends('layouts.partial.app')

@section('title', 'Master Data PT - Property Management App')

@section('content')
    <style>
        /* ===== SEMUA CSS SAMA PERSIS DENGAN HALAMAN BANK ===== */
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

        /* ===== MODAL STYLING ===== */
        .modal-content {
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            background: linear-gradient(135deg, #ffffff, #f8f9fa);
            border-bottom: 1px solid #e9ecef;
            padding: 1rem;
            border-radius: 16px 16px 0 0;
        }

        .modal-title {
            font-size: 1rem;
            font-weight: 700;
            color: #9a55ff;
        }

        .modal-body {
            padding: 1.2rem;
        }

        .modal-footer {
            border-top: 1px solid #e9ecef;
            padding: 1rem;
            border-radius: 0 0 16px 16px;
        }

        .modal-form-group {
            margin-bottom: 1rem;
        }

        .modal-form-group label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #9a55ff !important;
            margin-bottom: 0.3rem;
            letter-spacing: 0.3px;
            font-family: 'Nunito', sans-serif;
            display: block;
        }

        .modal-form-control {
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 0.6rem 0.8rem;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            background-color: #ffffff;
            color: #2c2e3f;
            width: 100%;
        }

        .modal-form-control:focus {
            border-color: #9a55ff;
            box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.1);
            outline: none;
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
                                <i class="mdi mdi-domain me-2" style="color: #9a55ff;"></i>
                                Master Data PT
                            </h3>
                            <p class="text-muted mb-0">
                                <i class="mdi mdi-information-outline me-1"></i>
                                Kelola data perusahaan (PT) untuk keperluan administrasi
                            </p>
                        </div>
                        <div class="d-none d-sm-block">
                            <i class="mdi mdi-domain" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Data PT -->
        <div class="row mt-2 mt-sm-2 mt-md-3">
            <div class="col-12">
                <div class="card">
                    <div
                        class="card-header bg-white d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                        <h5 class="card-title mb-2 mb-md-0">
                            <i class="mdi mdi-format-list-bulleted me-2 text-primary"></i>
                            Daftar Perusahaan (PT)
                        </h5>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-sm btn-gradient-primary" data-bs-toggle="modal"
                                data-bs-target="#modalTambahPT">
                                <i class="mdi mdi-plus me-1"></i><span class="d-none d-sm-inline">Tambah PT</span>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Filter Section -->
                        <div class="filter-card">
                            <div class="card-body">
                                <h6 class="card-title mb-3" style="font-size: 1rem;">
                                    <i class="mdi mdi-filter-outline me-1"></i>Filter Data
                                </h6>

                                <!-- FILTER UNTUK MOBILE -->
                                <div class="d-block d-md-none">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            <i class="mdi mdi-magnify me-1"></i>Cari PT
                                        </label>
                                        <input type="text" class="form-control" placeholder="Cari nama PT...">
                                    </div>

                                    <div class="row g-2">
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
                                        <div class="col-6">
                                            <button type="button" class="btn btn-gradient-primary w-100">
                                                <i class="mdi mdi-filter me-1"></i> Filter
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <button type="button" class="btn btn-gradient-secondary w-100">
                                                <i class="mdi mdi-refresh me-1"></i> Reset
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- FILTER UNTUK TABLET & DESKTOP -->
                                <div class="d-none d-md-block">
                                    <div class="row g-2 align-items-end">
                                        <div class="col-md-5">
                                            <label class="form-label">
                                                <i class="mdi mdi-magnify me-1"></i>Cari PT
                                            </label>
                                            <input type="text" class="form-control" placeholder="Cari nama PT...">
                                        </div>
                                        <div class="col-md-2">
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
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-gradient-primary w-100">
                                                <i class="mdi mdi-filter me-1"></i> Filter
                                            </button>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-gradient-secondary w-100 btn-icon-only"
                                                title="Reset">
                                                <i class="mdi mdi-refresh"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tabel PT -->
                        <div class="table-responsive">

                            <table class="table table-hover" id="tablePT" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center"><i class="mdi mdi-counter me-1"></i>No</th>
                                        <th><i class="mdi mdi-domain me-1"></i>Nama PT</th>
                                        <th><i class="mdi mdi-map-marker me-1"></i>Alamat</th>
                                        <th><i class="mdi mdi-phone me-1"></i>No. HP</th>
                                        <th class="text=center"><i class="mdi mdi-file-document me-1"></i>Jumlah Project
                                        </th>
                                        <th class="text-center"><i class="mdi mdi-cog me-1"></i>Aksi</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($companies as $item)
                                        <tr>
                                            <td class="text-center fw-bold">{{ $loop->iteration }}</td>

                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-domain text-primary me-2"></i>
                                                    <span class="fw-bold">{{ $item->name }}</span>
                                                </div>
                                            </td>

                                            <td>{{ $item->address }}</td>
                                            <td>{{ $item->phone }}</td>

                                            {{-- Kolom Jumlah Project --}}
                                            <td class="text-center">
                                                <span class="badge bg-success">
                                                    {{ $item->land_banks_count }} Project
                                                </span>
                                            </td>

                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-1">
                                                    <button type="button" class="btn btn-outline-warning btn-sm btnEdit"
                                                        title="Edit" data-bs-toggle="modal"
                                                        data-bs-target="#modalEditPT" data-id="{{ $item->id }}"
                                                        data-name="{{ $item->name }}"
                                                        data-address="{{ $item->address }}"
                                                        data-phone="{{ $item->phone }}">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </button>
                                                    <form action="{{ route('company-profile.destroy', $item->id) }}"
                                                        method="POST" class="formDelete">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="button"
                                                            class="btn btn-outline-danger btn-sm btnDelete"
                                                            data-name="{{ $item->name }}">
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

                        <!-- Pagination UI -->
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-3">
                            <div class="pagination-info mb-2 mb-sm-0">
                                <i class="mdi mdi-information-outline me-1"></i>
                                Menampilkan 1 - 5 dari 5 data
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

    <!-- MODAL TAMBAH PT -->
    <div class="modal fade" id="modalTambahPT" tabindex="-1" aria-labelledby="modalTambahPTLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahPTLabel">
                        <i class="mdi mdi-domain-plus me-2" style="color: #9a55ff;"></i>
                        Tambah PT Baru
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formTambahPT" action="{{ route('company-profile.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="modal-form-group">
                                    <label>
                                        <i class="mdi mdi-domain me-1"></i>Nama PT
                                    </label>
                                    <input type="text" name="name" class="modal-form-control"
                                        placeholder="Contoh: PT Properti Management">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="modal-form-group">
                                    <label>
                                        <i class="mdi mdi-map-marker me-1"></i>Alamat
                                    </label>
                                    <textarea name="address" class="modal-form-control" rows="3" placeholder="Alamat lengkap PT..."></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="modal-form-group">
                                    <label>
                                        <i class="mdi mdi-phone me-1"></i>No. HP
                                    </label>
                                    <input type="text" name="phone" class="modal-form-control"
                                        placeholder="Contoh: 081234567890">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" form="formTambahPT" class="btn btn-gradient-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL EDIT PT -->
  <div class="modal fade" id="modalEditPT" tabindex="-1" aria-labelledby="modalEditPTLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalEditPTLabel">
                    <i class="mdi mdi-pencil me-2" style="color: #9a55ff;"></i>
                    Edit PT
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form id="formEditPT" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-12">
                            <div class="modal-form-group">
                                <label>Nama PT</label>
                                <input type="text" name="name" id="editName"
                                    class="modal-form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="modal-form-group">
                                <label>Alamat</label>
                                <textarea name="address" id="editAddress"
                                    class="modal-form-control" rows="3"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="modal-form-group">
                                <label>No. HP</label>
                                <input type="text" name="phone" id="editPhone"
                                    class="modal-form-control">
                            </div>
                        </div>
                    </div>

                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-gradient-secondary"
                    data-bs-dismiss="modal">Batal</button>

                <button type="submit" form="formEditPT"
                    class="btn btn-gradient-primary">
                    Update
                </button>
            </div>

        </div>
    </div>
</div>

    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function() {

                document.querySelectorAll('.btnDelete').forEach(button => {

                    button.addEventListener('click', function() {

                        let form = this.closest('.formDelete');
                        let companyName = this.getAttribute('data-name');

                        Swal.fire({
                            title: 'Yakin mau hapus?',
                            text: " " + companyName + " akan dihapus!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: 'Ya, hapus!',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });

                    });

                });

            });
        </script>
        <script>
            $(document).ready(function() {
                // Inisialisasi DataTables - hanya untuk sorting
                let table = $('#tablePT').DataTable({
                    responsive: true,
                    paging: false,
                    info: false,
                    searching: false,
                    lengthChange: false,
                    ordering: true,
                    language: {
                        emptyTable: "Data PT belum tersedia",
                        zeroRecords: "Data tidak ditemukan",
                    },
                    columnDefs: [{
                            orderable: false,
                            targets: [4]
                        } // Non-aktifkan sorting untuk kolom Aksi
                    ]
                });
            });
        </script>
        <script>
document.addEventListener("DOMContentLoaded", function () {

    const editButtons = document.querySelectorAll('.btnEdit');

    editButtons.forEach(button => {

        button.addEventListener('click', function () {

            let id = this.getAttribute('data-id');
            let name = this.getAttribute('data-name');
            let address = this.getAttribute('data-address');
            let phone = this.getAttribute('data-phone');

            document.getElementById('editName').value = name;
            document.getElementById('editAddress').value = address;
            document.getElementById('editPhone').value = phone;

            // Set action form dynamically
            document.getElementById('formEditPT').action =
                `/dashboard-pt/${id}`;
        });

    });

});
</script>
        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                });
            </script>
        @endif

        @if (session('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "{{ session('error') }}",
                });
            </script>
        @endif
    @endpush
@endsection
