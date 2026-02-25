@extends('layouts.partial.app')

@section('title', 'Semua Properti - Property Management App')

@section('content')
    <style>
        /* ===== MODERN STYLING UNTUK HALAMAN SEMUA PROPERTI ===== */

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

        .action-text-verify {
            background: linear-gradient(135deg, #28a745, #5cb85c);
            color: white;
        }

        .action-text-verify:hover {
            background: linear-gradient(135deg, #218838, #4cae4c);
            color: white;
            text-decoration: none;
        }

        .action-text-verified {
            background: #6c757d;
            color: white;
        }

        .action-text-rejected {
            background: #dc3545;
            color: white;
        }

        .action-text-none {
            background: #e9ecef;
            color: #6c7383;
        }

        /* DataTables Custom Styling */
        .dataTables_filter,
        .dataTables_length,
        .dataTables_paginate,
        .dataTables_info {
            display: none !important;
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

        /* Equal width columns */
        .equal-cols {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -0.25rem;
        }

        .equal-cols>[class*="col-"] {
            padding: 0 0.25rem;
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
                                <i class="mdi mdi-home-group me-2" style="color: #9a55ff;"></i>
                                Semua Properti Proyek
                            </h4>
                            <p class="mb-0 text-muted small">
                                <i class="mdi mdi-information-outline me-1"></i>
                                Daftar seluruh properti yang terdaftar dalam sistem
                            </p>
                        </div>
                        <div class="d-none d-sm-block">
                            <i class="mdi mdi-home-city" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
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
                            Daftar Semua Properti Proyek
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
                                                        placeholder="Cari PT atau Properti...">
                                                </div>
                                            </div>

                                            <!-- Baris 2: Kategori & Legalitas -->
                                            <div class="row filter-row">
                                                <div class="col-6">
                                                    <label class="form-label">
                                                        <i class="mdi mdi-shape-outline me-1"></i>Kategori
                                                    </label>
                                                    <select name="kategori" class="form-control">
                                                        <option value="">Semua Kategori</option>
                                                        @foreach ($categories as $kategori)
                                                            <option value="{{ $kategori }}"
                                                                {{ request('kategori') == $kategori ? 'selected' : '' }}>
                                                                {{ $kategori }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label">
                                                        <i class="mdi mdi-gavel me-1"></i>Legalitas
                                                    </label>
                                                    <select id="filterLegalitasMobile" class="form-control">
                                                        <option value="">Semua Legalitas</option>
                                                        <option value="terverifikasi">Terverifikasi</option>
                                                        <option value="Pending">Pending</option>
                                                        <option value="revisi">Revisi</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Baris 3: Pembangunan & Tampil -->
                                            <div class="row filter-row">
                                                <div class="col-6">
                                                    <label class="form-label">
                                                        <i class="mdi mdi-hammer me-1"></i>Pembangunan
                                                    </label>
                                                    <select id="filterPembangunanMobile" class="form-control">
                                                        <option value="">Semua Pembangunan</option>
                                                        <option value="Selesai">Selesai</option>
                                                        <option value="progress">Progress</option>
                                                        <option value="Belum">Belum</option>
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
                                            <form method="GET" action="{{ route('properti-all') }}">
                                                <div class="row g-2 align-items-end filter-row">

                                                    <!-- Search - placeholder diubah -->
                                                    <div class="col-md-3">
                                                        <label class="form-label">
                                                            <i class="mdi mdi-magnify me-1"></i>Pencarian
                                                        </label>
                                                        <input type="text" name="search"
                                                            value="{{ request('search') }}" class="form-control"
                                                            placeholder="Cari PT atau Properti...">
                                                    </div>

                                                    <!-- Kategori -->
                                                    <div class="col-md-2">
                                                        <label class="form-label">
                                                            <i class="mdi mdi-shape-outline me-1"></i>Kategori
                                                        </label>
                                                        <select name="kategori" class="form-control">
                                                            <option value="">Semua Kategori</option>
                                                            @foreach ($categories as $kategori)
                                                                <option value="{{ $kategori }}"
                                                                    {{ request('kategori') == $kategori ? 'selected' : '' }}>
                                                                    {{ $kategori }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <!-- Legalitas -->
                                                    <div class="col-md-2">
                                                        <label class="form-label">
                                                            <i class="mdi mdi-gavel me-1"></i>Legalitas
                                                        </label>
                                                        <select name="legalitas" class="form-control">
                                                            <option value="">Semua Legalitas</option>
                                                            <option value="terverifikasi"
                                                                {{ request('legalitas') == 'terverifikasi' ? 'selected' : '' }}>
                                                                Terverifikasi</option>
                                                            <option value="Pending"
                                                                {{ request('legalitas') == 'Pending' ? 'selected' : '' }}>
                                                                Pending</option>
                                                            <option value="revisi"
                                                                {{ request('legalitas') == 'revisi' ? 'selected' : '' }}>
                                                                Revisi</option>
                                                        </select>
                                                    </div>

                                                    <!-- Pembangunan -->
                                                    <div class="col-md-2">
                                                        <label class="form-label">
                                                            <i class="mdi mdi-hammer me-1"></i>Pembangunan
                                                        </label>
                                                        <select name="pembangunan" class="form-control">
                                                            <option value="">Semua Pembangunan</option>
                                                            <option value="Selesai"
                                                                {{ request('pembangunan') == 'Selesai' ? 'selected' : '' }}>
                                                                Selesai</option>
                                                            <option value="progress"
                                                                {{ request('pembangunan') == 'progress' ? 'selected' : '' }}>
                                                                Progress</option>
                                                            <option value="Belum"
                                                                {{ request('pembangunan') == 'Belum' ? 'selected' : '' }}>
                                                                Belum</option>
                                                        </select>
                                                    </div>

                                                    <!-- Show -->
                                                    <div class="col-md-1">
                                                        <label class="form-label">
                                                            <i class="mdi mdi-counter me-1"></i>Tampil
                                                        </label>
                                                        <select name="show" class="form-control">
                                                            <option value="10"
                                                                {{ request('show') == 10 ? 'selected' : '' }}>10</option>
                                                            <option value="25"
                                                                {{ request('show') == 25 ? 'selected' : '' }}>25</option>
                                                            <option value="50"
                                                                {{ request('show') == 50 ? 'selected' : '' }}>50</option>
                                                            <option value="100"
                                                                {{ request('show') == 100 ? 'selected' : '' }}>100</option>
                                                        </select>
                                                    </div>

                                                    <!-- Filter Button -->
                                                    <div class="col-md-1">
                                                        <button type="submit" class="btn btn-gradient-primary w-100">
                                                            <i class="mdi mdi-filter-outline"></i>
                                                        </button>
                                                    </div>

                                                    <!-- Reset Button -->
                                                    <div class="col-md-1">
                                                        <a href="{{ route('properti-all') }}" class="btn btn-gradient-secondary w-100">
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
                            <table id="tableProperti" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center"><i class="mdi mdi-counter"></i> NO</th>
                                        <th><i class="mdi mdi-domain"></i> NAMA PERUSAHAAN</th>
                                        <th><i class="mdi mdi-home-variant"></i> NAMA PROPERTI</th>
                                        <th><i class="mdi mdi-shape-outline"></i> KATEGORI</th>
                                        <th class="d-none d-md-table-cell"><i class="mdi mdi-map-marker"></i> LOKASI</th>
                                        <th><i class="mdi mdi-currency-usd"></i> HARGA BELI</th>
                                        <th><i class="mdi mdi-gavel"></i> LEGALITAS</th>
                                        <th><i class="mdi mdi-hammer"></i> PEMBANGUNAN</th>
                                        <th class="text-center"><i class="mdi mdi-file-document"></i> DOKUMEN</th>
                                        <th class="text-center"><i class="mdi mdi-cog"></i> AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($landBanks as $index => $item)
                                        <tr>
                                            <td class="text-center fw-bold">
                                                <span class="badge bg-light text-dark">{{ $landBanks->firstItem() + $index }}</span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-domain text-primary me-2"></i>
                                                    <span class="fw-medium">{{ $item->companyProfile->name ?? '-' }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-home-variant text-primary me-2"></i>
                                                    <span class="fw-bold">{{ Str::limit($item->name, 25) }}</span>
                                                </div>
                                                <small class="text-muted d-block d-md-none">
                                                    <i class="mdi mdi-map-marker me-1"></i>{{ Str::limit($item->address ?? '-', 15) }}
                                                </small>
                                            </td>

                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-shape-outline text-info me-2"></i>
                                                    <span>{{ $item->zoning ?? 'Tanah' }}</span>
                                                </div>
                                            </td>

                                            <td class="d-none d-md-table-cell">
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-map-marker text-danger me-2"></i>
                                                    <span>{{ Str::limit($item->address ?? '-', 20) }}</span>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-currency-usd text-success me-2"></i>
                                                    <span class="fw-bold text-success">Rp {{ number_format($item->acquisition_price, 0, ',', '.') }}</span>
                                                </div>
                                            </td>

                                            <td>
                                                @if ($item->legal_status == 'terverifikasi')
                                                    <span class="badge badge-gradient-success"><i class="mdi mdi-check-circle me-1"></i>Terverifikasi</span>
                                                @elseif ($item->legal_status == 'Pending')
                                                    <span class="badge badge-gradient-warning"><i class="mdi mdi-clock-outline me-1"></i>Pending</span>
                                                @else
                                                    <span class="badge badge-gradient-danger"><i class="mdi mdi-close-circle me-1"></i>Revisi</span>
                                                @endif
                                            </td>

                                            <td>
                                                @if ($item->development_status == 'Selesai')
                                                    <span class="badge badge-gradient-success"><i class="mdi mdi-check-circle me-1"></i>Selesai</span>
                                                @elseif ($item->development_status == 'progress')
                                                    <span class="badge badge-gradient-warning"><i class="mdi mdi-progress-clock me-1"></i>Progress</span>
                                                @else
                                                    <span class="badge badge-gradient-danger"><i class="mdi mdi-close-circle me-1"></i>Belum</span>
                                                @endif
                                            </td>

                                            <td class="text-center">
                                                <button type="button" class="btn btn-gradient-info btn-sm"
                                                    data-bs-toggle="modal" data-bs-target="#modalDokumen{{ $item->id }}">
                                                    <i class="mdi mdi-file-document"></i>
                                                    <span class="badge bg-white text-dark ms-1">{{ $item->documents->count() }}</span>
                                                </button>
                                            </td>

                                            <td class="text-center">
                                                @if ($item->documents->count() == 0)
                                                    <span class="action-text action-text-none"><i class="mdi mdi-cancel me-1"></i>No Data</span>
                                                @elseif($item->documents->contains('status', 'ditolak'))
                                                    <span class="action-text action-text-rejected"><i class="mdi mdi-close-circle me-1"></i>Ditolak</span>
                                                @elseif($item->documents->every(fn($d) => $d->status == 'terverifikasi'))
                                                    <span class="action-text action-text-verified"><i class="mdi mdi-check-circle me-1"></i>Sudah Verif</span>
                                                @else
                                                    <a href="{{ route('properti.verifikasi', $item->id) }}"
                                                        class="action-text action-text-verify"><i class="mdi mdi-account-check me-1"></i>Verifikasi</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-center py-4">
                                                <i class="mdi mdi-information-outline me-2"></i>
                                                Belum ada data properti
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination Laravel -->
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-3">
                            <div class="pagination-info mb-2 mb-sm-0">
                                <i class="mdi mdi-information-outline me-1"></i>
                                Menampilkan {{ $landBanks->firstItem() ?? 0 }} - {{ $landBanks->lastItem() ?? 0 }} dari
                                {{ $landBanks->total() }} data
                            </div>
                            <div class="d-flex justify-content-center">
                                {{ $landBanks->links('pagination::bootstrap-5') }}
                            </div>
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

    <!-- MODALS -->
    @foreach ($landBanks as $item)
        <div class="modal fade" id="modalDokumen{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="mdi mdi-file-document me-2" style="color: #9a55ff;"></i>
                            Dokumen - {{ $item->name }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if ($item->documents->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm">
                                    <thead class="table-light">
                                        <tr>
                                            <th><i class="mdi mdi-counter me-1"></i> Nomor Dokumen</th>
                                            <th><i class="mdi mdi-file-outline me-1"></i> Tipe</th>
                                            <th><i class="mdi mdi-chart-arc me-1"></i> Status</th>
                                            <th><i class="mdi mdi-eye me-1"></i> Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($item->documents as $doc)
                                            <tr>
                                                <td>{{ $doc->document_number }}</td>
                                                <td>
                                                    <i class="mdi mdi-file-{{ $doc->type == 'sertifikat' ? 'certificate' : 'document' }} text-primary me-1"></i>
                                                    {{ ucfirst($doc->type) }}
                                                </td>
                                                <td>
                                                    @if ($doc->status == 'pending')
                                                        <span class="badge badge-gradient-warning"><i class="mdi mdi-clock-outline me-1"></i>Pending</span>
                                                    @elseif($doc->status == 'ditolak')
                                                        <span class="badge badge-gradient-danger"><i class="mdi mdi-close-circle me-1"></i>Ditolak</span>
                                                    @elseif($doc->status == 'terverifikasi')
                                                        <span class="badge badge-gradient-success"><i class="mdi mdi-check-circle me-1"></i>Terverifikasi</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank"
                                                        class="btn btn-gradient-primary btn-sm">
                                                        <i class="mdi mdi-eye me-1"></i>Lihat
                                                    </a>
                                                </td>
                                            </tr>
                                            @if ($doc->status === 'ditolak' && !empty($doc->catatan_admin))
                                                <tr>
                                                    <td colspan="4">
                                                        <div
                                                            class="border-start border-4 border-danger ps-3 py-2 bg-light text-danger small">
                                                            <i class="mdi mdi-alert-circle me-1"></i>
                                                            <strong>Alasan:</strong> {{ $doc->catatan_admin }}
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center text-muted py-4">
                                <i class="mdi mdi-file-document-outline" style="font-size: 3rem; opacity: 0.3;"></i>
                                <p class="mt-2">Tidak ada dokumen.</p>
                            </div>
                        @endif
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
        $(document).ready(function() {

            // CEK APAKAH TABEL MEMILIKI DATA
            let hasData = false;
            $('#tableProperti tbody tr').each(function() {
                let rowText = $(this).text();
                if (rowText && !rowText.includes('Belum ada data properti')) {
                    hasData = true;
                }
            });

            // Hancurkan instance DataTables jika sudah ada
            if ($.fn.DataTable.isDataTable('#tableProperti')) {
                $('#tableProperti').DataTable().destroy();
            }

            // HANYA inisialisasi DataTables JIKA ADA DATA
            if (hasData) {
                // Inisialisasi DataTables
                let table = $('#tableProperti').DataTable({
                    responsive: true,
                    paging: false,
                    info: false,
                    searching: false,
                    lengthChange: false,
                    ordering: true,
                    language: {
                        emptyTable: `
                            <div class="text-center text-muted py-5">
                                <i class="mdi mdi-home-outline" style="font-size: 3rem; opacity: 0.3;"></i>
                                <p class="mt-3">
                                    <i class="mdi mdi-information-outline me-2"></i>
                                    Data belum tersedia
                                </p>
                            </div>
                        `,
                        zeroRecords: "Data tidak ditemukan",
                    },
                    columnDefs: [
                        { orderable: false, targets: [0] }, // Kolom No
                        { orderable: false, targets: [8] }, // Kolom Dokumen
                        { orderable: false, targets: [9] }  // Kolom Aksi
                    ]
                });
            }

            // Konfirmasi SweetAlert sebelum verifikasi
            $('.action-text-verify').on('click', function(e) {
                e.preventDefault();
                let link = $(this).attr('href');

                Swal.fire({
                    title: 'Verifikasi Properti?',
                    text: "Properti akan ditandai sebagai sudah diverifikasi.",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Verifikasi',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = link;
                    }
                });
            });

            // Filter functionality untuk mobile
            $('#filterDataMobile').on('click', function() {
                // Implementasi filter mobile bisa ditambahkan di sini
                alert('Fitur filter mobile sedang dalam pengembangan');
            });

            $('#resetFilterMobile').on('click', function() {
                window.location.href = "{{ route('properti-all') }}";
            });

        });
    </script>
@endpush
