@extends('layouts.partial.app')

@section('title', 'Data User / Customer - Property Management App')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-clean.css') }}?v={{ time() }}">
@endpush

@section('content')
<style>
    /* Card Compact Persis Catalog Unit */
    .compact-table-card {
        background: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 8px !important;
        box-shadow: none !important;
        transition: border-color 0.2s ease;
        overflow: hidden;
    }
    .compact-table-card:hover {
        border-color: #cbd5e1 !important;
        box-shadow: none !important;
    }

    /* Filter Card Modern (Persis Catalog Unit) */
    .filter-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 0.75rem 1rem;
    }

    .form-control, .form-select, select.form-control {
        border: 1px solid #e2e8f0;
        border-radius: 6px !important;
        padding: 0.55rem 0.8rem;
        font-size: 0.85rem;
        color: #1e293b;
        background-color: #ffffff;
        height: auto;
        min-height: 38px;
        transition: all 0.2s ease;
    }

    .form-control:focus, .form-select:focus, select.form-control:focus {
        border-color: #9a55ff !important;
        box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.15) !important;
        outline: none;
    }

    /* Solid Buttons - 1 Warna, Tanpa Gradient Persis Catalog Unit */
    .btn-gradient-primary {
        background: #7c3aed !important;
        border-color: #7c3aed !important;
        color: #ffffff !important;
        border-radius: 6px;
    }
    .btn-gradient-primary:hover {
        background: #6d28d9 !important;
        border-color: #6d28d9 !important;
        color: #ffffff !important;
    }

    .btn-gradient-secondary {
        background: #64748b !important;
        border-color: #64748b !important;
        color: #ffffff !important;
        border-radius: 6px;
    }
    .btn-gradient-secondary:hover {
        background: #475569 !important;
        border-color: #475569 !important;
        color: #ffffff !important;
    }

    .btn-gradient-success {
        background: #10b981 !important;
        border-color: #10b981 !important;
        color: #ffffff !important;
        border-radius: 6px;
    }
    .btn-gradient-success:hover {
        background: #059669 !important;
        border-color: #059669 !important;
        color: #ffffff !important;
    }

    .btn-gradient-danger {
        background: #ef4444 !important;
        border-color: #ef4444 !important;
        color: #ffffff !important;
        border-radius: 6px;
    }
    .btn-gradient-danger:hover {
        background: #dc2626 !important;
        border-color: #dc2626 !important;
        color: #ffffff !important;
    }

    .btn-icon-only {
        width: 38px;
        height: 38px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        flex-shrink: 0;
    }

    .btn-icon-only i {
        font-size: 1.15rem;
    }

    .btn-icon-only-mobile {
        height: 38px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
    }

    .btn-icon-only-mobile i {
        font-size: 1.15rem;
    }

    /* Table Styles Persis Catalog Unit */
    .table thead th {
        background: #f8fafc !important;
        color: #475569 !important;
        font-weight: 700;
        font-size: 0.78rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0.85rem 0.85rem;
        border-bottom: 1px solid #e2e8f0;
        white-space: nowrap;
    }

    .table tbody td {
        padding: 0.85rem 0.85rem;
        font-size: 0.88rem;
        color: #334155;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .table-hover tbody tr:hover {
        background-color: #f8fafc;
    }

    .avatar-circle {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.78rem;
        color: white;
        background: linear-gradient(135deg, #da8cff, #9a55ff);
        flex-shrink: 0;
        margin-right: 0.5rem;
    }

    /* Tombol Aksi Persis (Jangan Diubah Sesuai Instruksi User) */
    .btn-action {
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        margin: 0 2px;
        transition: all 0.2s ease;
        border: none;
        cursor: pointer;
        color: #ffffff !important;
    }

    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    .btn-action.edit {
        background: linear-gradient(135deg, #6366f1, #4f46e5);
    }

    .btn-action.delete {
        background: linear-gradient(135deg, #ef4444, #dc2626);
    }

    .modal-content {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.12);
    }

    .modal-header {
        background: #7c3aed !important;
        color: white !important;
        padding: 1.1rem 1.5rem;
        border-bottom: none;
    }

    .modal-header .btn-close {
        filter: brightness(0) invert(1);
    }

    .modal-title {
        font-weight: 700;
        font-size: 1.1rem;
        color: #ffffff !important;
    }

    .modal-body {
        padding: 1.5rem;
        background: #ffffff;
    }

    .modal-footer {
        background: #fafbfe;
        border-top: 1px solid #edf2f9;
        padding: 1rem 1.5rem;
    }

    .sortable {
        cursor: pointer;
        user-select: none;
    }
    .sortable:hover {
        color: #7c3aed !important;
    }

    /* Select2 Theme Alignment */
    .select2-container--bootstrap-5 .select2-selection {
        min-height: 38px !important;
        height: 38px !important;
        padding: 0.375rem 0.75rem !important;
        display: flex !important;
        align-items: center !important;
        border-color: #e2e8f0 !important;
        border-radius: 6px !important;
        font-size: 0.85rem !important;
        background-color: #ffffff !important;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    .select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
        line-height: 1.5 !important;
        padding-left: 0 !important;
        color: #1e293b !important;
    }
    .select2-container--bootstrap-5.select2-container--focus .select2-selection,
    .select2-container--bootstrap-5.select2-container--open .select2-selection {
        border-color: #7c3aed !important;
        box-shadow: 0 0 0 0.2rem rgba(124, 58, 237, 0.15) !important;
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
    .select2-container--bootstrap-5 .select2-results__option--highlighted,
    .select2-container--bootstrap-5 .select2-results__option--highlighted.select2-results__option--selectable {
        background-color: #f3e8ff !important;
        color: #7c3aed !important;
    }
    .select2-container--bootstrap-5 .select2-results__option[aria-selected="true"],
    .select2-container--bootstrap-5 .select2-results__option--selected {
        background-color: #ede9fe !important;
        color: #6d28d9 !important;
        font-weight: 600 !important;
    }
</style>

<div class="container-fluid p-2 p-sm-3 p-md-4">

    <!-- Header Title (Persis Catalog Unit) -->
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
        <div>
            <h2 class="text-dark mb-1 fw-bold" style="font-size: 1.55rem; letter-spacing: -0.02em;">
                Data User / Customer
            </h2>
            <p class="text-muted mb-0" style="font-size: 0.88rem;">
                Kelola data pembeli dan pemilik unit properti
            </p>
        </div>
    </div>

    <!-- 4 KPI Metrics Card Grid (Persis Catalog Unit) -->
    <div class="dash-kpi-grid mb-4">
        <!-- Card 1: Total Customer (Ungu) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon purple">
                    <i class="mdi mdi-account-group"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Total User / Customer</div>
                    <div class="dash-kpi-val">{{ $totalCustomer ?? 0 }}</div>
                    <div class="dash-kpi-sub">Seluruh Pembeli Terdaftar</div>
                </div>
            </div>
        </div>

        <!-- Card 2: Lengkap (Hijau) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon green">
                    <i class="mdi mdi-account-check"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Data Lengkap</div>
                    <div class="dash-kpi-val">{{ $customerLengkap ?? 0 }}</div>
                    <div class="dash-kpi-sub">Siap Transaksi & Booking</div>
                </div>
            </div>
        </div>

        <!-- Card 3: Belum Lengkap (Amber / Kuning) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon amber">
                    <i class="mdi mdi-account-alert"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Belum Lengkap</div>
                    <div class="dash-kpi-val">{{ $customerBelumLengkap ?? 0 }}</div>
                    <div class="dash-kpi-sub">Perlu Dilengkapi NIK/KTP</div>
                </div>
            </div>
        </div>

        <!-- Card 4: Aktif Booking (Biru) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon blue">
                    <i class="mdi mdi-home-account"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Aktif Booking Unit</div>
                    <div class="dash-kpi-val">{{ $customerBooking ?? 0 }}</div>
                    <div class="dash-kpi-sub">Memiliki Unit Properti</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Data (Card Compact Meniru Persis Catalog Unit) -->
    <div class="row">
        <div class="col-12">
            <div class="card compact-table-card">
                <div class="card-header bg-white d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center py-2.5 px-3 px-md-4 gap-2" style="border-bottom: 1px solid #e2e8f0 !important;">
                    <div class="d-flex align-items-center gap-2">
                        <div style="width: 32px; height: 32px; border-radius: 6px; background-color: #f3e8ff; color: #9333ea; display: inline-flex; align-items: center; justify-content: center; font-size: 1.15rem; flex-shrink: 0;">
                            <i class="mdi mdi-format-list-bulleted"></i>
                        </div>
                        <span style="font-size: 0.95rem; font-weight: 700; color: #0f172a;">Daftar User</span>
                    </div>
                    <div class="d-flex flex-wrap align-items-center gap-2">
                        <button class="btn btn-sm d-inline-flex align-items-center gap-1 px-3 text-white fw-semibold" style="height: 32px; border-radius: 6px; background-color: #10b981; border: 1px solid #10b981;" onclick="$('#modalImportCustomer').modal('show')">
                            <i class="mdi mdi-file-excel"></i>
                            <span>Import</span>
                        </button>
                        <button class="btn btn-sm d-inline-flex align-items-center gap-1 px-3 text-white fw-semibold" style="height: 32px; border-radius: 6px; background-color: #ef4444; border: 1px solid #ef4444;" onclick="$('#modalExportCustomer').modal('show')">
                            <i class="mdi mdi-file-pdf"></i>
                            <span>Export</span>
                        </button>
                        <a href="{{ route('customer.create') }}" class="btn btn-sm d-inline-flex align-items-center gap-1 px-3 text-white fw-semibold" style="height: 32px; border-radius: 6px; background-color: #7c3aed; border: 1px solid #7c3aed;">
                            <i class="mdi mdi-account-plus"></i>
                            <span>Tambah User Baru</span>
                        </a>
                    </div>
                </div>

                <div class="card-body p-3 p-md-4">
                    <!-- Filter Section Persis Catalog Unit -->
                    <div class="filter-card mb-3">

                        <!-- DESKTOP & TABLET VERSION -->
                        <div class="filter-row-desktop d-none d-md-block">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">

                                    <!-- Search -->
                                    <div style="min-width: 200px; max-width: 280px; flex: 1;">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="searchInput"
                                                placeholder="Nama user / customer ID..." value="{{ request('search') }}"
                                                style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                            <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                type="button" id="searchSubmitBtn" title="Cari"
                                                style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Pekerjaan -->
                                    <div style="min-width: 200px; max-width: 260px;">
                                        <select class="form-control select2" id="pekerjaanSelect" style="width: 100%;">
                                            <option value="">Semua Pekerjaan</option>
                                            <option value="PNS" {{ request('pekerjaan') == 'PNS' ? 'selected' : '' }}>PNS</option>
                                            <option value="Karyawan Swasta" {{ request('pekerjaan') == 'Karyawan Swasta' ? 'selected' : '' }}>Karyawan Swasta</option>
                                            <option value="Wiraswasta" {{ request('pekerjaan') == 'Wiraswasta' ? 'selected' : '' }}>Wiraswasta</option>
                                            <option value="Ibu Rumah Tangga" {{ request('pekerjaan') == 'Ibu Rumah Tangga' ? 'selected' : '' }}>Ibu Rumah Tangga</option>
                                            <option value="Pensiunan" {{ request('pekerjaan') == 'Pensiunan' ? 'selected' : '' }}>Pensiunan</option>
                                            <option value="Lainnya" {{ request('pekerjaan') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                        </select>
                                    </div>

                                </div>

                                <!-- Right Side: Limit Dropdown + Filter & Reset Buttons -->
                                <div class="d-flex align-items-center gap-2 ms-auto">
                                    <div style="width: 90px;">
                                        <select class="form-control select2" id="perPageSelect" style="width: 100%;">
                                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
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
                                            placeholder="Nama user / customer ID..." value="{{ request('search') }}"
                                            style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                        <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                            type="button" id="searchSubmitBtnMobile" title="Cari"
                                            style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                            <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 mb-2">
                                    <select class="form-control select2-mobile" id="pekerjaanSelectMobile" style="width: 100%;">
                                        <option value="">Semua Pekerjaan</option>
                                        <option value="PNS" {{ request('pekerjaan') == 'PNS' ? 'selected' : '' }}>PNS</option>
                                        <option value="Karyawan Swasta" {{ request('pekerjaan') == 'Karyawan Swasta' ? 'selected' : '' }}>Karyawan Swasta</option>
                                        <option value="Wiraswasta" {{ request('pekerjaan') == 'Wiraswasta' ? 'selected' : '' }}>Wiraswasta</option>
                                        <option value="Ibu Rumah Tangga" {{ request('pekerjaan') == 'Ibu Rumah Tangga' ? 'selected' : '' }}>Ibu Rumah Tangga</option>
                                        <option value="Pensiunan" {{ request('pekerjaan') == 'Pensiunan' ? 'selected' : '' }}>Pensiunan</option>
                                        <option value="Lainnya" {{ request('pekerjaan') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                </div>
                                <div class="col-12 mb-2">
                                    <select class="form-control select2-mobile" id="perPageSelectMobile" style="width: 100%;">
                                        <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-gradient-primary btn-icon-only-mobile w-100" id="filterBtnMobile" title="Filter">
                                        <i class="mdi mdi-filter"></i>
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-gradient-secondary btn-icon-only-mobile w-100" id="refreshBTNMobile" title="Reset">
                                        <i class="mdi mdi-refresh"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Table Responsive -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 50px; min-width: 50px; max-width: 60px;">No</th>
                                    <th class="sortable" style="min-width: 160px;" data-field="customer_id" data-direction="{{ request('sortField') == 'customer_id' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        ID Customer
                                        @if(request('sortField') == 'customer_id')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable" style="min-width: 190px;" data-field="full_name" data-direction="{{ request('sortField') == 'full_name' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Nama User
                                        @if(request('sortField') == 'full_name')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th style="min-width: 140px;">Status Data</th>
                                    <th class="sortable" style="min-width: 180px;" data-field="email" data-direction="{{ request('sortField') == 'email' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Email
                                        @if(request('sortField') == 'email')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable" style="min-width: 140px;" data-field="job_status" data-direction="{{ request('sortField') == 'job_status' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Pekerjaan
                                        @if(request('sortField') == 'job_status')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable" style="min-width: 150px;" data-field="phone" data-direction="{{ request('sortField') == 'phone' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Nomor HP
                                        @if(request('sortField') == 'phone')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="text-center" style="width: 100px; min-width: 100px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($customers as $index => $customer)
                                    <tr>
                                        <td class="text-center fw-bold" style="width: 50px;">{{ $customers->firstItem() + $index }}</td>
                                        <td class="fw-bold text-dark">
                                            {{ $customer->customer_id ?? '-' }}
                                        </td>
                                        <td>
                                            <span class="fw-bold text-dark">{{ $customer->full_name }}</span>
                                        </td>
                                        <td>
                                            @if($customer->is_lengkap)
                                                <span class="badge" style="background: #e6f9f0; color: #00875a; border: 1px solid #b3eccf; font-weight: 600; font-size: 0.78rem; padding: 5px 10px; border-radius: 6px;">
                                                    <i class="mdi mdi-check-circle me-1"></i>Lengkap
                                                </span>
                                            @else
                                                <a href="{{ route('customer.edit', $customer->id) }}" class="badge text-decoration-none" style="background: #fff8e6; color: #b45309; border: 1px solid #fde68a; font-weight: 600; font-size: 0.78rem; padding: 5px 10px; border-radius: 6px; display: inline-flex; align-items: center; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#fef3c7'; this.style.transform='translateY(-1px)';" onmouseout="this.style.background='#fff8e6'; this.style.transform='none';" title="Data belum lengkap. Klik untuk melengkapi data">
                                                    <i class="mdi mdi-alert-circle me-1"></i>Belum Lengkap <i class="mdi mdi-pencil-box-outline ms-1" style="font-size: 0.85rem;"></i>
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @if($customer->email)
                                                <div class="d-flex align-items-center gap-1">
                                                    <i class="mdi mdi-email-outline text-primary" style="font-size: 1.1rem;"></i>
                                                    <span>{{ $customer->email }}</span>
                                                </div>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($customer->job_status)
                                                <span class="badge" style="background: #f4efff; color: #7e22ce; border: 1px solid #e9d5ff;">
                                                    {{ $customer->job_status }}
                                                </span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($customer->phone)
                                                <div class="d-flex align-items-center gap-1">
                                                    <i class="mdi mdi-whatsapp text-success" style="font-size: 1.1rem;"></i>
                                                    <span>{{ $customer->phone }}</span>
                                                </div>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('customer.edit', $customer->id) }}" class="btn-action edit" title="Edit Data User">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            <button type="button" class="btn-action delete" title="Hapus User" onclick="deleteCustomer({{ $customer->id }}, '{{ addslashes($customer->full_name) }}')">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-5">
                                            <i class="mdi mdi-account-off-outline" style="font-size: 3rem; color: #9a55ff; opacity: 0.3;"></i>
                                            <p class="mt-2 mb-0 fw-bold">Tidak ada data customer yang tersedia.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- PAGINATION - COMPACT PERSIS CATALOG UNIT -->
                    @if ($customers instanceof \Illuminate\Pagination\LengthAwarePaginator && $customers->total() > 0)
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-3 pt-2">
                            <div class="pagination-info mb-2 mb-sm-0 text-muted small">
                                Menampilkan {{ $customers->firstItem() }} - {{ $customers->lastItem() }} dari {{ $customers->total() }} data user
                            </div>
                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                    {{-- Previous Page Link --}}
                                    @if ($customers->onFirstPage())
                                        <li class="page-item disabled" aria-disabled="true">
                                            <span class="page-link" aria-label="Previous">
                                                <i class="mdi mdi-chevron-left"></i>
                                            </span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $customers->appends(request()->query())->previousPageUrl() }}" rel="prev" aria-label="Previous">
                                                <i class="mdi mdi-chevron-left"></i>
                                            </a>
                                        </li>
                                    @endif

                                    {{-- Pagination Elements --}}
                                    @foreach ($customers->getUrlRange(max(1, $customers->currentPage() - 2), min($customers->lastPage(), $customers->currentPage() + 2)) as $page => $url)
                                        @if ($page == $customers->currentPage())
                                            <li class="page-item active" aria-current="page">
                                                <span class="page-link" style="background-color: #7c3aed; border-color: #7c3aed;">{{ $page }}</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach

                                    {{-- Next Page Link --}}
                                    @if ($customers->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $customers->appends(request()->query())->nextPageUrl() }}" rel="next" aria-label="Next">
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

<!-- MODAL IMPORT CUSTOMER -->
<div class="modal fade" id="modalImportCustomer" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="mdi mdi-import me-2"></i>Import Data User
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <i class="mdi mdi-file-excel" style="font-size: 54px; color: #28a745;"></i>
                    <h6 class="mt-3 fw-bold">Import dari file Excel</h6>
                    <p class="text-muted small">Download template terlebih dahulu untuk memudahkan import data</p>
                </div>

                <div class="d-flex gap-2 mb-4">
                    <a href="#" class="btn btn-outline-success w-50">
                        <i class="mdi mdi-download me-1"></i>Download Template
                    </a>
                    <a href="#" class="btn btn-outline-info w-50">
                        <i class="mdi mdi-eye me-1"></i>Lihat Contoh
                    </a>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold"><i class="mdi mdi-file-upload me-1 text-primary"></i>Upload File Excel</label>
                    <input type="file" class="form-control" accept=".xlsx,.xls,.csv">
                    <small class="text-muted">Format: .xlsx, .xls, .csv (Max 5MB)</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">
                    <i class="mdi mdi-close me-1"></i>Batal
                </button>
                <button type="button" class="btn btn-gradient-success">
                    <i class="mdi mdi-import me-1"></i>Import Data
                </button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL EXPORT CUSTOMER -->
<div class="modal fade" id="modalExportCustomer" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="mdi mdi-export me-2"></i>Export Data User
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <i class="mdi mdi-file-download" style="font-size: 54px; color: #9a55ff;"></i>
                    <h6 class="mt-3 fw-bold">Pilih format export</h6>
                </div>

                <div class="d-flex gap-3 justify-content-center">
                    <button class="btn btn-outline-success p-3" style="width: 90px; border-radius: 12px;">
                        <i class="mdi mdi-file-excel" style="font-size: 28px;"></i>
                        <span class="d-block small mt-1">Excel</span>
                    </button>
                    <button class="btn btn-outline-danger p-3" style="width: 90px; border-radius: 12px;">
                        <i class="mdi mdi-file-pdf" style="font-size: 28px;"></i>
                        <span class="d-block small mt-1">PDF</span>
                    </button>
                    <button class="btn btn-outline-primary p-3" style="width: 90px; border-radius: 12px;">
                        <i class="mdi mdi-file-delimited" style="font-size: 28px;"></i>
                        <span class="d-block small mt-1">CSV</span>
                    </button>
                </div>

                <hr class="my-4">

                <div class="mb-3">
                    <label class="form-label fw-bold"><i class="mdi mdi-filter-outline me-1 text-primary"></i>Filter Data yang Diexport</label>
                    <select class="form-control">
                        <option value="semua">Semua User</option>
                        <option value="aktif">User Aktif</option>
                        <option value="pending">User Pending</option>
                        <option value="kpr">Pembeli KPR</option>
                        <option value="cash">Pembeli Cash</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">
                    <i class="mdi mdi-close me-1"></i>Batal
                </button>
                <button type="button" class="btn btn-gradient-primary">
                    <i class="mdi mdi-export me-1"></i>Export Data
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Filter Function - Mirroring Dashboard
function executeFilter(isMobile = false) {
    const search = isMobile 
        ? document.getElementById('searchInputMobile').value 
        : document.getElementById('searchInput').value;
    
    const pekerjaan = isMobile 
        ? document.getElementById('pekerjaanSelectMobile').value 
        : document.getElementById('pekerjaanSelect').value;
    
    const perPage = isMobile 
        ? document.getElementById('perPageSelectMobile').value 
        : document.getElementById('perPageSelect').value;

    let url = new URL(window.location.origin + window.location.pathname);
    
    if (search.trim()) url.searchParams.set('search', search.trim());
    if (pekerjaan) url.searchParams.set('pekerjaan', pekerjaan);
    if (perPage) url.searchParams.set('per_page', perPage);

    // Maintain sorting if present
    const currentUrl = new URL(window.location.href);
    if (currentUrl.searchParams.get('sortField')) {
        url.searchParams.set('sortField', currentUrl.searchParams.get('sortField'));
    }
    if (currentUrl.searchParams.get('sortDirection')) {
        url.searchParams.set('sortDirection', currentUrl.searchParams.get('sortDirection'));
    }

    window.location.href = url.toString();
}

function resetAllFilters() {
    window.location.href = "{{ route('customer.data') }}";
}

$(document).ready(function() {
    // Init Select2 Filters (Without Search Input)
    $('#pekerjaanSelect, #pekerjaanSelectMobile, #perPageSelect, #perPageSelectMobile').select2({
        theme: 'bootstrap-5',
        minimumResultsForSearch: Infinity,
        width: '100%'
    });
});

document.addEventListener('DOMContentLoaded', function() {
    // 1. Sorting
    document.querySelectorAll('.sortable').forEach(function(th) {
        th.addEventListener('click', function() {
            let field = this.dataset.field;
            let direction = this.dataset.direction;

            let url = new URL(window.location.href);
            url.searchParams.set('sortField', field);
            url.searchParams.set('sortDirection', direction);
            url.searchParams.set('page', 1);

            window.location.href = url.toString();
        });
    });

    // 2. Desktop Filter Buttons
    const filterBtn = document.getElementById('filterBtn');
    const refreshBTN = document.getElementById('refreshBTN');
    const searchSubmitBtn = document.getElementById('searchSubmitBtn');
    const searchInput = document.getElementById('searchInput');

    if (filterBtn) filterBtn.addEventListener('click', () => executeFilter(false));
    if (searchSubmitBtn) searchSubmitBtn.addEventListener('click', () => executeFilter(false));
    if (refreshBTN) refreshBTN.addEventListener('click', resetAllFilters);
    if (searchInput) {
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') executeFilter(false);
        });
    }

    // 3. Mobile Filter Buttons
    const filterBtnMobile = document.getElementById('filterBtnMobile');
    const refreshBTNMobile = document.getElementById('refreshBTNMobile');
    const searchSubmitBtnMobile = document.getElementById('searchSubmitBtnMobile');
    const searchInputMobile = document.getElementById('searchInputMobile');

    if (filterBtnMobile) filterBtnMobile.addEventListener('click', () => executeFilter(true));
    if (searchSubmitBtnMobile) searchSubmitBtnMobile.addEventListener('click', () => executeFilter(true));
    if (refreshBTNMobile) refreshBTNMobile.addEventListener('click', resetAllFilters);
    if (searchInputMobile) {
        searchInputMobile.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') executeFilter(true);
        });
    }

    // 4. Session Flash Alerts
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            timer: 3000,
            timerProgressBar: true,
            confirmButtonText: 'OK',
            confirmButtonColor: '#9a55ff'
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: "{{ session('error') }}",
            confirmButtonColor: '#9a55ff',
            confirmButtonText: 'OK'
        });
    @endif
});

function deleteCustomer(id, name) {
    Swal.fire({
        title: 'Hapus User?',
        html: `Apakah Anda yakin ingin menghapus user <b>${name}</b>?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Menghapus...',
                allowOutsideClick: false,
                didOpen: () => { Swal.showLoading(); }
            });

            $.ajax({
                url: "/customer/" + id + "/destroy",
                type: 'DELETE',
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'User berhasil dihapus',
                        confirmButtonColor: '#9a55ff',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function(xhr) {
                    let errorMsg = 'Terjadi kesalahan saat menghapus data.';
                    if (xhr.responseJSON && xhr.responseJSON.error) {
                        errorMsg = xhr.responseJSON.error;
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: errorMsg,
                        confirmButtonColor: '#9a55ff'
                    });
                }
            });
        }
    });
}
</script>
@endpush
