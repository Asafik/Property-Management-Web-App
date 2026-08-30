@extends('layouts.partial.app')

@section('title', 'Dashboard - Property Management App')

@section('content')


    <style>
        .header-card {
            background: #ffffff;
            border-radius: 8px !important;
            border: none !important;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04);
            margin-bottom: 0;
        }

        /* ===== MODAL DETAIL UNIT LENGKAP STYLES (MIRRORING TIMELINE PEMBAYARAN) ===== */
        .modal-detail-unit .modal-header {
            background: linear-gradient(135deg, #da8cff, #9a55ff);
            color: white;
            border-radius: 16px 16px 0 0;
            padding: 1rem 1.5rem;
            border: none;
        }

        .modal-detail-unit .modal-title {
            color: #ffffff;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .modal-detail-unit .modal-header .btn-close {
            filter: brightness(0) invert(1);
            opacity: 0.8;
        }

        .modal-detail-unit .modal-header .btn-close:hover {
            opacity: 1;
        }

        .modal-detail-unit .modal-content {
            border: none;
            border-radius: 16px;
        }

        .modal-detail-unit .modal-body {
            padding: 1.5rem;
            background: #ffffff;
        }

        .timeline-detail-card {
            background: linear-gradient(135deg, #faf7ff, #f4efff);
            border: 1px solid #eadcff;
            border-radius: 14px;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .timeline-detail-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: #9a55ff;
            margin-bottom: 0.85rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .timeline-detail-item {
            background: #ffffff;
            border: 1px solid #efe6ff;
            border-radius: 10px;
            padding: 0.75rem 0.85rem;
            height: 100%;
            transition: all 0.3s ease;
        }

        .timeline-detail-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.1);
            border-color: #9a55ff;
        }

        .timeline-detail-label {
            font-size: 0.75rem;
            color: #8b8fa3;
            margin-bottom: 0.2rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.35rem;
        }

        .timeline-detail-value {
            font-size: 0.92rem;
            color: #2c2e3f;
            font-weight: 700;
        }

        .timeline-detail-value.price {
            color: #28a745;
            font-weight: 800;
        }

        /* Unit card styling */
        .unit-card {
            background: #ffffff;
            border: 1px solid #efe6ff;
            border-radius: 10px;
            padding: 1rem;
            height: 100%;
            transition: all 0.3s ease;
        }

        .unit-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.1);
            border-color: #9a55ff;
        }

        .unit-name {
            font-size: 0.95rem;
            font-weight: 700;
            color: #2c2e3f;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .unit-info {
            font-size: 0.82rem;
            color: #6c7383;
            margin-bottom: 0.3rem;
        }

        .unit-info i {
            font-size: 0.9rem;
            color: #9a55ff;
            margin-right: 0.3rem;
        }

        .unit-status {
            margin-top: 0.5rem;
        }

        .progress-wrapper {
            flex: 1;
            max-width: 150px;
        }

        .progress-row {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .progress {
            height: 8px;
            border-radius: 10px;
            background: #f0f0f0;
            overflow: hidden;
            flex: 1;
        }

        .progress-bar-custom {
            height: 100%;
            border-radius: 10px;
            transition: width 0.6s ease;
        }

        .progress.active {
            background: linear-gradient(135deg, #28c76f, #48da89);
        }

        .progress.process {
            background: linear-gradient(135deg, #ffc107, #ffdb6d);
        }

        .progress-percent {
            font-size: 0.75rem;
            font-weight: 700;
            color: #6c7383;
            min-width: 35px;
            text-align: right;
        }

        /* Badge styles dari jual_unit.blade.php */
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

        .badge-gradient-success {
            background: linear-gradient(135deg, #28a745, #5cb85c);
            color: #ffffff;
        }

        .badge-gradient-primary {
            background: linear-gradient(to right, #da8cff, #9a55ff) !important;
            color: #ffffff !important;
        }

        .badge-gradient-secondary {
            background: #6c757d !important;
            color: #ffffff !important;
        }

        /* Customer info styles */
        .customer-info {
            display: flex;
            align-items: center;
            gap: 0.65rem;
        }

        .customer-initial {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, #da8cff, #9a55ff);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: 700;
            flex-shrink: 0;
            box-shadow: 0 4px 10px rgba(154, 85, 255, 0.2);
        }

        .progress-green {
            background: linear-gradient(to right, #28a745, #5dd17a);
        }

        .progress-dark-green {
            background: linear-gradient(to right, #198754, #31b87a);
        }

        /* ===== OPTIMASI LEBAR & PADDING (DESKTOP, TABLET & MOBILE) ===== */
        .content-wrapper {
            padding: 1.25rem 1rem !important;
        }

        .card-body {
            padding: 0.85rem 1rem !important;
        }

        .filter-card {
            padding: 0.85rem 1rem !important;
            margin-bottom: 1rem !important;
        }

        .table-responsive {
            width: 100% !important;
            margin-bottom: 0 !important;
        }

        .table {
            width: 100% !important;
            margin-bottom: 0 !important;
        }

        /* Mode Tablet (iPad / 768px - 1024px) */
        @media (max-width: 1024px) {
            .content-wrapper {
                padding: 1.15rem 0.85rem !important;
            }
            .container-fluid {
                padding-left: 0.25rem !important;
                padding-right: 0.25rem !important;
            }
        }

        /* Mode HP / Mobile */
        @media (max-width: 576px) {
            .content-wrapper {
                padding: 0.85rem 0.65rem !important;
            }
            .container-fluid {
                padding-left: 0.25rem !important;
                padding-right: 0.25rem !important;
            }
        /* Select2 Theme Alignment */
        .select2-container--bootstrap-5 .select2-selection {
            min-height: 38px !important;
            height: 38px !important;
            padding: 0.375rem 0.75rem !important;
            display: flex !important;
            align-items: center !important;
            border-color: #ebedf2 !important;
            border-radius: 6px !important;
            font-size: 0.875rem !important;
            background-color: #ffffff !important;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        .select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
            line-height: 1.5 !important;
            padding-left: 0 !important;
            color: #3b3f5c !important;
        }
        .select2-container--bootstrap-5.select2-container--focus .select2-selection,
        .select2-container--bootstrap-5.select2-container--open .select2-selection {
            border-color: #bfa5fa !important;
            box-shadow: 0 0 0 0.2rem rgba(154, 85, 255, 0.12) !important;
        }

        /* Select2 Dropdown Options Soft Hover & Active */
        .select2-container--bootstrap-5 .select2-dropdown {
            border: 1px solid #e2e8f0 !important;
            border-radius: 8px !important;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08) !important;
            overflow: hidden !important;
            z-index: 1050 !important;
        }
        .select2-container--bootstrap-5 .select2-results__option {
            padding: 0.45rem 0.85rem !important;
            font-size: 0.85rem !important;
            color: #3b3f5c !important;
            transition: background-color 0.15s ease, color 0.15s ease;
        }
        /* Hover / Highlighted (Soft Pastel Tint) */
        .select2-container--bootstrap-5 .select2-results__option--highlighted,
        .select2-container--bootstrap-5 .select2-results__option--highlighted.select2-results__option--selectable {
            background-color: #f6f1ff !important;
            color: #792fe0 !important;
        }
        /* Active / Selected (Soft Purple Tint) */
        .select2-container--bootstrap-5 .select2-results__option[aria-selected="true"],
        .select2-container--bootstrap-5 .select2-results__option--selected {
            background-color: #eee4ff !important;
            color: #6b21a8 !important;
            font-weight: 600 !important;
        }
        .select2-container--bootstrap-5 .select2-results__option--selected.select2-results__option--highlighted {
            background-color: #e4d3fe !important;
            color: #581c87 !important;
        }
    </style>

    <div class="container-fluid px-1 px-sm-2 px-md-3 py-2 py-md-3">

        <!-- Header Dashboard Card Banner -->
        <div class="row mb-3 mb-md-4">
            <div class="col-12">
                <div class="card shadow-sm border-0 header-card">
                    <div class="card-body p-4 p-md-4 py-4 py-md-4 d-flex justify-content-between align-items-center" style="min-height: 105px;">
                        <div>
                            <h3 class="text-dark mb-1 fw-bold" style="font-size: 1.35rem;">
                                Dashboard
                            </h3>
                            <p class="text-muted mb-0" style="font-size: 0.9rem;">
                                Selamat datang di Dashboard Property Management
                            </p>
                        </div>
                        <div class="d-none d-sm-block pe-2">
                            <i class="mdi mdi-home-analytics" style="font-size: 3rem; color: #9a55ff; opacity: 0.25;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistic Cards - Data dari controller -->
        <div class="row g-3 mb-4">
            <div class="col-12 col-sm-6 col-md-4 col-lg">
                <div class="card shadow-sm border-0 h-100 mb-0" style="border-left: 4px solid #9a55ff !important;">
                    <div class="card-body d-flex justify-content-between align-items-center p-3">
                        <div>
                            <h4 class="text-dark mb-1 fw-bold">{{ $totalProperty }}</h4>
                            <p class="text-muted mb-0" style="font-size: 0.85rem;">Total Proyek</p>
                        </div>
                        <div class="d-none d-sm-block">
                            <i class="mdi mdi-city" style="font-size: 2.2rem; color: #9a55ff; opacity: 0.25;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg">
                <div class="card shadow-sm border-0 h-100 mb-0" style="border-left: 4px solid #0d6efd !important;">
                    <div class="card-body d-flex justify-content-between align-items-center p-3">
                        <div>
                            <h4 class="text-dark mb-1 fw-bold">{{ $totalUnit }}</h4>
                            <p class="text-muted mb-0" style="font-size: 0.85rem;">Total Unit</p>
                        </div>
                        <div class="d-none d-sm-block">
                            <i class="mdi mdi-home-city" style="font-size: 2.2rem; color: #0d6efd; opacity: 0.25;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg">
                <div class="card shadow-sm border-0 h-100 mb-0" style="border-left: 4px solid #6f42c1 !important;">
                    <div class="card-body d-flex justify-content-between align-items-center p-3">
                        <div>
                            <h4 class="text-dark mb-1 fw-bold">{{ $totalPayments }}</h4>
                            <p class="text-muted mb-0" style="font-size: 0.85rem;">Total Transaksi</p>
                        </div>
                        <div class="d-none d-sm-block">
                            <i class="mdi mdi-swap-horizontal" style="font-size: 2.2rem; color: #6f42c1; opacity: 0.25;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg">
                <div class="card shadow-sm border-0 h-100 mb-0" style="border-left: 4px solid #28a745 !important; background: linear-gradient(135deg, #ffffff 0%, #f4fdf6 100%);">
                    <div class="card-body d-flex justify-content-between align-items-center p-3">
                        <div>
                            <h4 class="text-success mb-1 fw-bold" style="font-size: 1.05rem;">Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</h4>
                            <p class="text-muted mb-0" style="font-size: 0.85rem;">Total Pendapatan</p>
                        </div>
                        <div class="d-none d-sm-block">
                            <i class="mdi mdi-cash-check" style="font-size: 2.2rem; color: #28a745; opacity: 0.3;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg">
                <div class="card shadow-sm border-0 h-100 mb-0" style="border-left: 4px solid #ea580c !important; background: linear-gradient(135deg, #ffffff 0%, #fff7ed 100%);">
                    <div class="card-body d-flex justify-content-between align-items-center p-3">
                        <div>
                            <h4 class="text-danger mb-1 fw-bold" style="color: #ea580c !important; font-size: 1.05rem;">Rp {{ number_format($totalPiutang ?? 0, 0, ',', '.') }}</h4>
                            <p class="text-muted mb-0" style="font-size: 0.85rem;">Total Piutang</p>
                        </div>
                        <div class="d-none d-sm-block">
                            <i class="mdi mdi-cash-clock" style="font-size: 2.2rem; color: #ea580c; opacity: 0.3;"></i>
                        </div>
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
                        <div class="filter-card mb-3">

                            <!-- DESKTOP & TABLET VERSION -->
                            <div class="filter-row-desktop d-none d-md-block">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                    <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">

                                        <!-- Search -->
                                        <div style="min-width: 200px; max-width: 260px; flex: 1;">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="searchInput"
                                                    placeholder="Nama proyek..." value="{{ request('search') }}"
                                                    style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                                <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                    type="button" id="searchSubmitBtn" title="Cari"
                                                    style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                    <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Perusahaan - SELECT2 -->
                                        <div style="min-width: 250px; max-width: 340px;">
                                            <select class="form-control select2" id="perusahaanSelect" style="width: 100%;">
                                                <option value="">Semua Perusahaan</option>
                                                @foreach ($filterOptions['perusahaan'] ?? [] as $company)
                                                    <option value="{{ $company }}"
                                                        {{ request('perusahaan') == $company ? 'selected' : '' }}>
                                                        {{ $company }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Status - SELECT2 NO SEARCH -->
                                        <div style="width: 150px;">
                                            <select class="form-control select2" id="statusSelect" style="width: 100%;">
                                                <option value="">Semua Status</option>
                                                <option value="ready"
                                                    {{ request('status') == 'ready' ? 'selected' : '' }}>Tersedia</option>
                                                <option value="sold" {{ request('status') == 'sold' ? 'selected' : '' }}>
                                                    Terjual</option>
                                                <option value="pending"
                                                    {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                            </select>
                                        </div>

                                    </div>

                                    <!-- Right Side: Limit Dropdown + Filter & Reset Buttons -->
                                    <div class="d-flex align-items-center gap-2 ms-auto">
                                        <div style="width: 90px;">
                                            <select class="form-control select2" id="perPageSelect" style="width: 100%;">
                                                <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                                                <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25</option>
                                                <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
                                                <option value="100" {{ request('perPage') == 100 ? 'selected' : '' }}>100</option>
                                            </select>
                                        </div>
                                        <button type="button" class="btn btn-gradient-primary btn-icon-only" id="filterBtn" title="Filter">
                                            <i class="mdi mdi-filter"></i>
                                        </button>
                                        <button type="button" class="btn btn-gradient-secondary btn-icon-only" id="refreshBTN" title="Reset">
                                            <i class="mdi mdi-refresh"></i>
                                        </button>
                                    </div>

                                </div>
                            </div>

                            <!-- MOBILE VERSION -->
                            <div class="filter-row-mobile d-block d-md-none">
                                <div class="row g-2">
                                    <div class="col-12 mb-2">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="searchInputMobile"
                                                placeholder="Nama proyek..." value="{{ request('search') }}"
                                                style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                            <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                type="button" id="searchSubmitBtnMobile" title="Cari"
                                                style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
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
                                        <select class="form-control select2-mobile" id="statusSelectMobile" style="width: 100%;">
                                            <option value="">Semua Status</option>
                                            <option value="ready"
                                                {{ request('status') == 'ready' ? 'selected' : '' }}>Tersedia</option>
                                            <option value="sold"
                                                {{ request('status') == 'sold' ? 'selected' : '' }}>Terjual</option>
                                            <option value="pending"
                                                {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                        </select>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <select class="form-control select2-mobile" id="perPageSelectMobile" style="width: 100%;">
                                            <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                                            <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25</option>
                                            <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
                                            <option value="100" {{ request('perPage') == 100 ? 'selected' : '' }}>100</option>
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
                                            Kategori
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
                                        <tr class="land-row" data-target="unit-row-{{ $item->id }}"
                                            style="cursor:pointer;">
                                            <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-city text-primary me-2"
                                                        style="font-size: 1.2rem;"></i>
                                                    <span class="fw-bold">{{ $item->name ?? '-' }}</span>
                                                </div>
                                            </td>
                                            <td>{{ $item->companyProfile->name ?? '-' }}</td>
                                            <td>
                                                <span class="type-badge">
                                                    <i class="mdi mdi-home"></i> {{ $item->zoning ?? '-' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="d-inline-flex align-items-center gap-1" title="{{ $item->address ?? '-' }}">
                                                    <i class="mdi mdi-map-marker text-danger"></i>
                                                    <span>{{ Str::limit($item->address ?? '-', 28) }}</span>
                                                </span>
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
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="text-price">
                                                Rp {{ number_format($item->acquisition_price ?? 0, 0, ',', '.') }}
                                            </td>
                                            <td>
                                                <span class="unit-badge">{{ $item->units->count() }} Unit</span>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-outline-purple btn-sm toggle-unit">
                                                    <i class="mdi mdi-chevron-down"></i> Unit
                                                </button>
                                            </td>
                                        </tr>

                                        <tr id="unit-row-{{ $item->id }}" class="unit-detail-row"
                                            style="display:none;">
                                            <td colspan="9">
                                                <div class="p-4 rounded"
                                                    style="background:#ffffff; border:1px solid #efe6ff; box-shadow: 0 4px 20px rgba(154,85,255,0.04);">
                                                    <h6 class="fw-bold mb-4 text-center" style="color: #2c2e3f; font-size: 0.95rem;">
                                                        <i class="mdi mdi-home-city text-primary me-1" style="color: #9a55ff !important;"></i>
                                                        Landbank Unit - {{ $item->name ?? '-' }}
                                                    </h6>

                                                    @if ($item->units && $item->units->count() > 0)
                                                        <div class="table-responsive" style="border-radius: 8px; border: 1px solid #efe6ff;">
                                                            <table class="table table-bordered align-middle mb-0 text-center" style="border-color: #efe6ff;">
                                                                <thead style="background: #faf7ff;">
                                                                    <tr>
                                                                        <th class="text-center" style="color: #9a55ff; font-weight: 700; font-size: 0.8rem; letter-spacing: 0.5px; border-color: #efe6ff; padding: 12px 8px;">NO</th>
                                                                        <th class="text-center" style="color: #9a55ff; font-weight: 700; font-size: 0.8rem; letter-spacing: 0.5px; border-color: #efe6ff; padding: 12px 8px;">NAMA UNIT</th>
                                                                        <th class="text-center" style="color: #9a55ff; font-weight: 700; font-size: 0.8rem; letter-spacing: 0.5px; border-color: #efe6ff; padding: 12px 8px;">BLOK</th>
                                                                        <th class="text-center" style="color: #9a55ff; font-weight: 700; font-size: 0.8rem; letter-spacing: 0.5px; border-color: #efe6ff; padding: 12px 8px;">NO UNIT</th>
                                                                        <th class="text-center" style="color: #9a55ff; font-weight: 700; font-size: 0.8rem; letter-spacing: 0.5px; border-color: #efe6ff; padding: 12px 8px;">LUAS TANAH</th>
                                                                        <th class="text-center" style="color: #9a55ff; font-weight: 700; font-size: 0.8rem; letter-spacing: 0.5px; border-color: #efe6ff; padding: 12px 8px;">LUAS BANGUNAN</th>
                                                                        <th class="text-center" style="color: #9a55ff; font-weight: 700; font-size: 0.8rem; letter-spacing: 0.5px; border-color: #efe6ff; padding: 12px 8px;">HARGA</th>
                                                                        <th class="text-center" style="color: #9a55ff; font-weight: 700; font-size: 0.8rem; letter-spacing: 0.5px; border-color: #efe6ff; padding: 12px 8px;">STATUS</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($item->units as $unit)
                                                                        <tr>
                                                                            <td class="text-center" style="border-color: #efe6ff; padding: 10px 8px; color: #495057;">{{ $loop->iteration }}</td>
                                                                            <td class="text-center" style="border-color: #efe6ff; padding: 10px 8px; color: #495057; font-weight: 500;">{{ $unit->name ?? ($unit->unit_name ?? '-') }}</td>
                                                                            <td class="text-center" style="border-color: #efe6ff; padding: 10px 8px; color: #495057;">{{ $unit->block ?? ($unit->blok ?? '-') }}</td>
                                                                            <td class="text-center" style="border-color: #efe6ff; padding: 10px 8px; color: #495057;">{{ $unit->unit_number ?? ($unit->unit_code ?? '-') }}</td>
                                                                            <td class="text-center" style="border-color: #efe6ff; padding: 10px 8px; color: #495057;">
                                                                                {{ $unit->area ?? ($unit->luas_tanah ?? '-') }}
                                                                                @if ($unit->area ?? ($unit->luas_tanah ?? null))
                                                                                    m²
                                                                                @endif
                                                                            </td>
                                                                            <td class="text-center" style="border-color: #efe6ff; padding: 10px 8px; color: #495057;">
                                                                                {{ $unit->building_area ?? ($unit->luas_bangunan ?? '-') }}
                                                                                @if ($unit->building_area ?? ($unit->luas_bangunan ?? null))
                                                                                    m²
                                                                                @endif
                                                                            </td>
                                                                            <td class="text-center" style="border-color: #efe6ff; padding: 10px 8px; color: #495057; font-weight: 600;">
                                                                                Rp {{ number_format($unit->price ?? ($unit->harga ?? 0), 0, ',', '.') }}
                                                                            </td>
                                                                            <td class="text-center" style="border-color: #efe6ff; padding: 10px 8px;">
                                                                                @php
                                                                                    $status = strtolower($unit->status ?? '');
                                                                                @endphp
                                                                                @if ($status == 'booked')
                                                                                    <span class="badge" style="background-color: #ffd857; color: #5d4300; font-weight: 700; border-radius: 30px; padding: 6px 16px; font-size: 0.75rem; box-shadow: 0 2px 4px rgba(255,216,87,0.2);">
                                                                                        Booking
                                                                                    </span>
                                                                                @elseif ($status == 'sold')
                                                                                    <span class="badge bg-danger text-white" style="font-weight: 700; border-radius: 30px; padding: 6px 16px; font-size: 0.75rem;">
                                                                                        Terjual
                                                                                    </span>
                                                                                @elseif ($status == 'draft' || $status == 'ready' || $status == 'tersedia')
                                                                                    <span class="badge bg-success text-white" style="font-weight: 700; border-radius: 30px; padding: 6px 16px; font-size: 0.75rem;">
                                                                                        Tersedia
                                                                                    </span>
                                                                                @else
                                                                                    <span class="badge bg-secondary text-white" style="font-weight: 700; border-radius: 30px; padding: 6px 16px; font-size: 0.75rem;">
                                                                                        {{ ucfirst($unit->status ?? '-') }}
                                                                                    </span>
                                                                                @endif
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    @else
                                                        <div class="text-muted text-center py-3">
                                                            Belum ada unit untuk tanah induk ini.
                                                        </div>
                                                    @endif
                                                </div>
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
            // Init Select2 Perusahaan (With Search)
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

            // Init Select2 Status (Tanpa Search Input)
            $('#statusSelect, #statusSelectMobile').select2({
                theme: 'bootstrap-5',
                minimumResultsForSearch: Infinity,
                width: '100%'
            });

            // Init Select2 Limit Data (Tanpa Search Input)
            $('#perPageSelect, #perPageSelectMobile').select2({
                theme: 'bootstrap-5',
                minimumResultsForSearch: Infinity,
                width: '100%'
            });

            // Sorting
            $('.sortable').click(function() {
                let field = $(this).data('field');
                let direction = $(this).data('direction');

                let url = new URL(window.location.href);
                url.searchParams.set('sortField', field);
                url.searchParams.set('sortDirection', direction);
                url.searchParams.set('page', 1);

                window.location.href = url.toString();
            });

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

                url.searchParams.set('perPage', perPage || 10);
                url.searchParams.set('page', 1);

                window.location.href = url.toString();
            }

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

            $('#searchSubmitBtn, #searchSubmitBtnMobile, #filterBtn, #filterBtnMobile').click(applyFilter);
            $('#resetBtn, #resetBtnMobile, #refreshBTN').click(resetFilter);

            $('#searchInput, #searchInputMobile').keypress(function(e) {
                if (e.which == 13) applyFilter();
            });

            // Toggle dropdown unit di table
            $('.toggle-unit').on('click', function(e) {
                e.stopPropagation();

                let button = $(this);
                let row = button.closest('tr');
                let targetId = row.data('target');
                let target = $('#' + targetId);
                let icon = button.find('i');

                if (target.length === 0) return;

                target.toggle();

                if (target.is(':visible')) {
                    icon.removeClass('mdi-chevron-down').addClass('mdi-chevron-up');
                } else {
                    icon.removeClass('mdi-chevron-up').addClass('mdi-chevron-down');
                }
            });

            // Klik baris juga bisa buka unit
            $('.land-row').on('click', function(e) {
                if ($(e.target).closest('button, a, select, input').length) return;

                $(this).find('.toggle-unit').trigger('click');
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
                    timerProgressBar: true
                });
            @endif
        });
    </script>
    <script>
        $(document).ready(function() {
            // Remove old query-based modal opener
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
                            <button type="button" class="btn btn-outline-purple btn-sm toggle-unit">
                                <i class="mdi mdi-chevron-down"></i> Unit
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
