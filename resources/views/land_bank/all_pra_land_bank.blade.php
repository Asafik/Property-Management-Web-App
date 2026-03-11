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

        .btn-outline-info {
            background: transparent;
            border: 1px solid #17a2b8;
            color: #17a2b8;
            padding: 0.4rem 0.75rem;
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

        /* ===== ACTION BUTTONS ===== */
        .action-buttons {
            position: relative;
            z-index: 10;
            display: flex;
            justify-content: center;
            gap: 5px;
        }

        .btn-outline-warning, .btn-outline-info {
            position: relative;
            z-index: 15;
            pointer-events: auto !important;
            cursor: pointer !important;
            padding: 0.35rem 0.7rem;
            font-size: 0.8rem;
            border-radius: 6px;
            border: 1px solid;
            background: transparent;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
        }

        .btn-outline-warning {
            border-color: #ffc107;
            color: #ffc107;
        }

        .btn-outline-warning:hover {
            background: linear-gradient(135deg, #ffc107, #ffdb6d);
            color: #2c2e3f;
            border-color: transparent;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(255, 193, 7, 0.3);
        }

        .btn-outline-info {
            border-color: #17a2b8;
            color: #17a2b8;
        }

        .btn-outline-info:hover {
            background: linear-gradient(135deg, #17a2b8, #5bc0de);
            color: #ffffff;
            border-color: transparent;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(23, 162, 184, 0.3);
        }

        .btn-outline-warning i, .btn-outline-info i {
            margin: 0;
            font-size: 1rem;
        }

        /* Count badge */
        .count-badge {
            background-color: rgba(154, 85, 255, 0.1);
            color: #9a55ff;
            padding: 0.2rem 0.6rem;
            border-radius: 30px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-left: 8px;
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

        /* DataTables wrapper styling */
        .dataTables_wrapper {
            width: 100%;
            overflow-x: auto;
        }

        /* Pastikan tabel tetap terlihat */
        .table {
            width: 100% !important;
            margin-bottom: 0;
        }

        /* Fix untuk DataTables di mobile */
        @media (max-width: 768px) {
            .dataTables_wrapper .table {
                width: 100% !important;
            }
        }

        /* Info text */
        .info-text {
            color: #6c7383;
            font-size: 0.8rem;
            margin-left: 5px;
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
                                <span class="count-badge">{{ $praLandBank->total() ?? 0 }} Data</span>
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
                        <h4 class="card-title mb-0">
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
                                                    <select id="filterNegosiasiMobile" class="form-control">
                                                        <option value="">Semua Status</option>
                                                        <option value="negotiation">Masih Negosiasi</option>
                                                        <option value="almost_deal">Hampir Deal</option>
                                                        <option value="deal">Sudah Deal</option>
                                                        <option value="cancel">Batal</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Baris 3: Tampil -->
                                            <div class="row filter-row">
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
                                            <form method="GET" action="#" id="filterForm">
                                                <div class="row g-2 align-items-end filter-row">

                                                    <!-- Search -->
                                                    <div class="col-md-4">
                                                        <label class="form-label">
                                                            <i class="mdi mdi-magnify me-1"></i>Pencarian
                                                        </label>
                                                        <input type="text" name="search" class="form-control"
                                                            placeholder="Cari nama tanah atau lokasi...">
                                                    </div>

                                                    <!-- FILTER STATUS NEGOSIASI -->
                                                    <div class="col-md-3">
                                                        <label class="form-label">
                                                            <i class="mdi mdi-handshake me-1"></i>Status Negosiasi
                                                        </label>
                                                        <select name="negotiation_status" class="form-control">
                                                            <option value="">Semua Status</option>
                                                            <option value="negotiation">Masih Negosiasi</option>
                                                            <option value="almost_deal">Hampir Deal</option>
                                                            <option value="deal">Sudah Deal</option>
                                                            <option value="cancel">Batal</option>
                                                        </select>
                                                    </div>

                                                    <!-- Show -->
                                                    <div class="col-md-2">
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

                                                    <!-- Filter Button (Icon Only) -->
                                                    <div class="col-md-2">
                                                        <button type="button" onclick="alert('Filter demo UI')"
                                                            class="btn btn-gradient-primary w-100">
                                                            <i class="mdi mdi-filter-outline"></i>
                                                        </button>
                                                    </div>

                                                    <!-- Reset Button (Icon Only) -->
                                                    <div class="col-md-1">
                                                        <a href="#" onclick="window.location.reload()"
                                                            class="btn btn-gradient-secondary w-100">
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

                        <!-- Tabel Data -->
                        <div class="table-responsive">
                            <table id="tablePraTanah" class="table table-hover align-middle" style="width:100%" {{ $praLandBank->count() > 0 ? 'data-use-datatables=true' : '' }}>
                                <thead>
                                    <tr>
                                        <th class="text-center" width="5%"><i class="mdi mdi-counter"></i> NO</th>
                                        <th width="20%"><i class="mdi mdi-home-variant"></i> NAMA TANAH</th>
                                        <th width="15%"><i class="mdi mdi-account-tie"></i> MAKELAR</th>
                                        <th width="25%"><i class="mdi mdi-map-marker"></i> LOKASI</th>
                                        <th width="15%"><i class="mdi mdi-currency-usd"></i> HARGA NEGOSIASI</th>
                                        <th width="10%"><i class="mdi mdi-handshake"></i> STATUS</th>
                                        <th class="text-center" width="10%"><i class="mdi mdi-cog"></i> AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($praLandBank ?? [] as $item)
                                        <tr>
                                            <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-home-variant text-primary me-2" style="font-size: 1.2rem;"></i>
                                                    <span class="fw-bold">{{ $item->land_name ?? '-' }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-account-tie text-info me-2" style="font-size: 1.2rem;"></i>
                                                    <span>{{ $item->land_source ?? '-' }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-map-marker text-danger me-2" style="font-size: 1.2rem;"></i>
                                                    <span>{{ Str::limit($item->address ?? '-', 30) }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-currency-usd text-success me-2" style="font-size: 1.2rem;"></i>
                                                    <span class="fw-bold">
                                                        Rp {{ number_format($item->estimated_price ?? 0, 0, ',', '.') }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                @if(($item->negotiation_status ?? '') == 'deal')
                                                    <span class="badge badge-gradient-success"><i class="mdi mdi-check-circle me-1"></i>Sudah Deal</span>
                                                @elseif(($item->negotiation_status ?? '') == 'almost_deal')
                                                    <span class="badge badge-gradient-info"><i class="mdi mdi-check me-1"></i>Hampir Deal</span>
                                                @elseif(($item->negotiation_status ?? '') == 'cancel')
                                                    <span class="badge badge-gradient-danger"><i class="mdi mdi-close-circle me-1"></i>Batal</span>
                                                @else
                                                    <span class="badge badge-gradient-warning"><i class="mdi mdi-clock-outline me-1"></i>Masih Negosiasi</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="action-buttons">
                                                    <!-- BUTTON EYE (INFO) -->
                                                    <button class="btn btn-outline-info btn-sm" title="Lihat Detail">
                                                        <i class="mdi mdi-eye"></i>
                                                    </button>
                                                    <!-- BUTTON EDIT (WARNING) -->
                                                    <button class="btn btn-outline-warning btn-sm" title="Edit">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-5">
                                                <i class="mdi mdi-hand-holding" style="font-size: 3rem; opacity: 0.3;"></i>
                                                <p class="mt-2 mb-0">Tidak ada data pra tanah yang tersedia.</p>
                                                <p class="text-muted small">Silahkan tambahkan data pra tanah baru.</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if($praLandBank->count() > 0)
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-3">
                            <div class="pagination-info mb-2 mb-sm-0">
                                <i class="mdi mdi-information-outline me-1 text-primary"></i>
                                Menampilkan <span class="fw-bold">{{ $praLandBank->firstItem() }}</span> -
                                <span class="fw-bold">{{ $praLandBank->lastItem() }}</span> dari
                                <span class="fw-bold">{{ $praLandBank->total() }}</span> data
                            </div>
                            <nav aria-label="Page navigation">
                                {{ $praLandBank->onEachSide(1)->links('pagination::bootstrap-5') }}
                            </nav>
                        </div>
                        @endif
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

    <script>
        $(document).ready(function() {
            // ===========================================
            // 1. FILTER MOBILE (demo)
            // ===========================================
            $('#filterDataMobile').on('click', function() {
                alert('Filter akan diterapkan (demo UI)');
            });

            $('#resetFilterMobile').on('click', function() {
                window.location.reload();
            });

            // ===========================================
            // 2. DATATABLES RESPONSIVE - HANYA JIKA ADA DATA
            // ===========================================
            @if($praLandBank->count() > 0)
                // Hancurkan instance DataTables jika sudah ada
                if ($.fn.DataTable.isDataTable('#tablePraTanah')) {
                    $('#tablePraTanah').DataTable().destroy();
                }

                // Inisialisasi DataTables Responsive
                $('#tablePraTanah').DataTable({
                    paging: false,
                    info: false,
                    searching: false,
                    lengthChange: false,
                    ordering: true,
                    responsive: true,
                    language: {
                        emptyTable: "Tidak ada data tersedia",
                        zeroRecords: "Data tidak ditemukan",
                    },
                    columnDefs: [
                        {
                            targets: [0, 6], // Kolom No dan Aksi
                            orderable: false
                        }
                    ],
                    autoWidth: false,
                    deferRender: true
                });
            @endif
        });
    </script>
@endpush
