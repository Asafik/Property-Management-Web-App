@extends('layouts.partial.app')

@section('title', 'Data User / Customer - Property Management App')

@section('content')
<style>
    .card {
        border-radius: 12px !important;
        border: none !important;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .stat-card-custom {
        border-radius: 12px;
        border: none;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        transition: all 0.2s ease;
    }

    .stat-card-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(154, 85, 255, 0.12);
    }

    .filter-card {
        padding: 0.85rem 1rem !important;
        margin-bottom: 1rem !important;
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.03);
    }

    .form-control, .form-select, select.form-control {
        border: 1px solid #e9ecef;
        border-radius: 8px !important;
        padding: 0.6rem 0.8rem;
        font-size: 0.88rem;
        color: #2c2e3f;
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

    .btn-gradient-primary {
        background: linear-gradient(to right, #da8cff, #9a55ff) !important;
        color: #ffffff !important;
        border: none;
    }

    .btn-gradient-secondary {
        background: #6c757d !important;
        color: #ffffff !important;
        border: none;
    }

    .btn-gradient-success {
        background: linear-gradient(135deg, #28a745, #5cb85c) !important;
        color: #ffffff !important;
        border: none;
    }

    .btn-gradient-danger {
        background: linear-gradient(135deg, #dc3545, #e4606d) !important;
        color: #ffffff !important;
        border: none;
    }

    .btn-icon-only {
        width: 38px;
        height: 38px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
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
        border-radius: 8px;
    }

    .btn-icon-only-mobile i {
        font-size: 1.15rem;
    }

    .table thead th {
        background: #f8f9fc !important;
        color: #4b49ac !important;
        font-weight: 700;
        font-size: 0.82rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 1rem 0.85rem;
        border-bottom: 2px solid #edf2f9;
        white-space: nowrap;
    }

    .table tbody td {
        padding: 0.9rem 0.85rem;
        font-size: 0.88rem;
        color: #2c2e3f;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .table-hover tbody tr:hover {
        background-color: #fcfaff;
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
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }

    .modal-header {
        background: linear-gradient(135deg, #da8cff, #9a55ff) !important;
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
        color: #9a55ff !important;
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

<div class="container-fluid p-2 p-sm-3 p-md-4">

    <!-- Header Judul (Tanpa Card Box) -->
    <div class="row mb-3 mb-sm-3 mb-md-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center px-1">
                <div>
                    <h3 class="text-dark mb-1 fw-bold">
                        <i class="mdi mdi-account-multiple me-2" style="color: #9a55ff;"></i>Data User / Customer
                    </h3>
                    <p class="text-muted mb-0">Kelola data pembeli dan pemilik unit properti</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistic Cards - Style Dashboard -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card stat-card-custom shadow-sm border-0 h-100 mb-0">
                <div class="card-body d-flex justify-content-between align-items-center p-3">
                    <div>
                        <h3 class="text-dark mb-1 fw-bold">{{ $totalCustomer ?? 0 }}</h3>
                        <p class="text-muted mb-0">Total User / Customer</p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-account-group" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card stat-card-custom shadow-sm border-0 h-100 mb-0">
                <div class="card-body d-flex justify-content-between align-items-center p-3">
                    <div>
                        <h3 class="text-dark mb-1 fw-bold">{{ $customerAktif ?? 0 }}</h3>
                        <p class="text-muted mb-0">User / Customer Aktif</p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-account-check" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card stat-card-custom shadow-sm border-0 h-100 mb-0">
                <div class="card-body d-flex justify-content-between align-items-center p-3">
                    <div>
                        <h3 class="text-dark mb-1 fw-bold">{{ $customerCash ?? 0 }}</h3>
                        <p class="text-muted mb-0">Pembeli Cash</p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-cash-multiple" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card stat-card-custom shadow-sm border-0 h-100 mb-0">
                <div class="card-body d-flex justify-content-between align-items-center p-3">
                    <div>
                        <h3 class="text-dark mb-1 fw-bold">{{ $customerKpr ?? 0 }}</h3>
                        <p class="text-muted mb-0">Pembeli KPR</p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-bank" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Data Customer & Filter -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-3 p-3">
                    <h5 class="card-title mb-0 fw-bold">
                        <i class="mdi mdi-format-list-bulleted me-2 text-primary"></i>Daftar User
                    </h5>
                    <div class="d-flex flex-wrap gap-2">
                        <button class="btn btn-gradient-success d-inline-flex align-items-center gap-1" onclick="$('#modalImportCustomer').modal('show')">
                            <i class="mdi mdi-import"></i> <span class="d-none d-sm-inline">Import</span>
                        </button>
                        <button class="btn btn-gradient-danger d-inline-flex align-items-center gap-1" onclick="$('#modalExportCustomer').modal('show')">
                            <i class="mdi mdi-export"></i> <span class="d-none d-sm-inline">Export</span>
                        </button>
                        <a href="{{ route('customer.create') }}" class="btn btn-gradient-primary d-inline-flex align-items-center gap-1">
                            <i class="mdi mdi-account-multiple-plus-outline"></i> <span>Tambah User Baru</span>
                        </a>
                    </div>
                </div>

                <div class="card-body p-3">
                    <!-- FILTER SECTION (PERSIS DASHBOARD) -->
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
                                    <th class="sortable" style="min-width: 200px;" data-field="full_name" data-direction="{{ request('sortField') == 'full_name' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Nama User
                                        @if(request('sortField') == 'full_name')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
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
                                    @php
                                        $initials = collect(explode(' ', trim($customer->full_name)))
                                            ->filter()
                                            ->take(2)
                                            ->map(fn($w) => strtoupper(substr($w, 0, 1)))
                                            ->implode('');
                                    @endphp
                                    <tr>
                                        <td class="text-center fw-bold" style="width: 50px;">{{ $customers->firstItem() + $index }}</td>
                                        <td class="fw-bold text-dark">
                                            {{ $customer->customer_id ?? '-' }}
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-circle">{{ $initials ?: 'US' }}</div>
                                                <div class="fw-bold text-dark">{{ $customer->full_name }}</div>
                                            </div>
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
                                        <td colspan="7" class="text-center text-muted py-5">
                                            <i class="mdi mdi-account-off-outline" style="font-size: 3rem; color: #9a55ff; opacity: 0.3;"></i>
                                            <p class="mt-2 mb-0 fw-bold">Tidak ada data customer yang tersedia.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- PAGINATION -->
                    @if ($customers instanceof \Illuminate\Pagination\LengthAwarePaginator && $customers->total() > 0)
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                            <div class="pagination-info mb-2 mb-sm-0 text-muted small">
                                Menampilkan {{ $customers->firstItem() }} - {{ $customers->lastItem() }} dari {{ $customers->total() }} data user
                            </div>
                            <nav aria-label="Page navigation">
                                {{ $customers->appends(request()->query())->links('pagination::bootstrap-4') }}
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
