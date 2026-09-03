@extends('layouts.partial.app')

@section('title', 'Analisa KPR Komersil - Property Management App')

@push('styles')
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endpush

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
    padding: 0.75rem;
}
@media (min-width: 576px) { .card-header { padding: 1rem; } }
@media (min-width: 768px) { .card-header { padding: 1.2rem; } }

.card-body {
    padding: 0.85rem 1rem !important;
}

.card-title {
    font-size: 0.95rem;
    font-weight: 700;
    color: #9a55ff;
    margin-bottom: 0;
}
@media (min-width: 576px) { .card-title { font-size: 1.05rem; } }
@media (min-width: 768px) { .card-title { font-size: 1.15rem; } }

/* FILTER SECTION (DASHBOARD STYLE) */
.filter-card {
    background: transparent;
    padding: 0;
    margin-bottom: 1.25rem !important;
    border: none;
}

.form-control, .form-select {
    border: 1px solid #ebedf2;
    border-radius: 6px;
    padding: 0.45rem 0.85rem;
    font-size: 0.875rem;
    transition: all 0.2s ease;
    background-color: #ffffff;
    color: #3b3f5c;
    height: 38px;
}
.form-control:focus, .form-select:focus {
    border-color: #bfa5fa;
    box-shadow: 0 0 0 0.2rem rgba(154, 85, 255, 0.12);
    outline: none;
}

.btn {
    font-size: 0.85rem;
    padding: 0.6rem 1rem;
    border-radius: 6px;
    font-weight: 600;
    transition: all 0.3s ease;
    font-family: 'Nunito', sans-serif;
    border: none;
}
.btn:hover {
    transform: translateY(-2px);
}

.btn-gradient-primary {
    background: linear-gradient(to right, #da8cff, #9a55ff) !important;
    color: #ffffff !important;
}
.btn-gradient-secondary {
    background: #6c757d !important;
    color: #ffffff !important;
}
.btn-gradient-info {
    background: linear-gradient(135deg, #00cfe8, #1e9ff2) !important;
    color: #ffffff !important;
    box-shadow: 0 3px 8px rgba(0, 207, 232, 0.25);
}
.btn-gradient-success {
    background: linear-gradient(135deg, #28c76f, #48da89) !important;
    color: #ffffff !important;
    box-shadow: 0 3px 8px rgba(40, 199, 111, 0.25);
}
.btn-gradient-warning {
    background: linear-gradient(135deg, #ffb822, #ff9f43) !important;
    color: #ffffff !important;
    box-shadow: 0 3px 8px rgba(255, 184, 34, 0.25);
}

.btn-icon-only {
    width: 38px;
    height: 38px;
    padding: 0 !important;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 6px;
    flex-shrink: 0;
}
.btn-icon-only i {
    font-size: 1.15rem;
    margin: 0 !important;
}

.btn-action {
    height: 34px;
    width: 34px;
    padding: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    transition: all 0.3s ease;
    cursor: pointer;
    font-size: 0.95rem;
    color: #ffffff !important;
    border: none !important;
    text-decoration: none;
}
.btn-action:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 12px rgba(0, 0, 0, 0.15);
}

/* SELECT2 THEME ALIGNMENT (DASHBOARD STYLE) */
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
    font-weight: 500 !important;
}
.select2-container--bootstrap-5 .select2-selection--single .select2-selection__arrow {
    height: 36px !important;
    right: 8px !important;
}
.select2-container--bootstrap-5.select2-container--focus .select2-selection,
.select2-container--bootstrap-5.select2-container--open .select2-selection {
    border-color: #bfa5fa !important;
    box-shadow: 0 0 0 0.2rem rgba(154, 85, 255, 0.12) !important;
}

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
    background-color: #f6f1ff !important;
    color: #792fe0 !important;
}
.select2-container--bootstrap-5 .select2-results__option[aria-selected="true"],
.select2-container--bootstrap-5 .select2-results__option--selected {
    background-color: #eee4ff !important;
    color: #6b21a8 !important;
    font-weight: 600 !important;
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

.table-responsive {
    overflow-x: auto;
    overflow-y: hidden !important;
    -webkit-overflow-scrolling: touch;
    border-radius: 8px;
    margin-bottom: 0.5rem;
    max-height: unset !important;
    scrollbar-width: thin;
    scrollbar-color: #9a55ff #f0f0f0;
}

.table {
    width: 100%;
    min-width: 1200px;
    border-collapse: collapse;
    margin-bottom: 0;
}

.table thead th {
    background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
    color: #9a55ff;
    font-weight: 700;
    font-size: 0.82rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 2px solid #e9ecef;
    padding: 0.9rem 0.75rem;
    white-space: nowrap;
}

.table tbody td {
    vertical-align: middle;
    font-size: 0.9rem;
    padding: 0.95rem 0.75rem;
    border-bottom: 1px solid #e9ecef;
    color: #2c2e3f;
    white-space: nowrap;
}

.table tbody tr:hover {
    background-color: #f8f9fa;
}

.customer-avatar {
    width: 36px;
    height: 36px;
    min-width: 36px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #da8cff, #9a55ff);
    color: #fff;
    font-size: 0.82rem;
    font-weight: 700;
    text-transform: uppercase;
    box-shadow: 0 4px 10px rgba(154, 85, 255, 0.25);
}

.customer-name {
    font-weight: 700;
    color: #2c2e3f;
    font-size: 0.9rem;
}

.unit-info {
    display: flex;
    align-items: center;
    gap: 0.45rem;
    font-weight: 600;
    color: #2c2e3f;
}
.unit-info i {
    color: #9a55ff;
    font-size: 1.1rem;
}

.bank-info {
    display: flex;
    align-items: center;
    gap: 0.45rem;
    font-weight: 700;
    color: #2c2e3f;
}
.bank-info i {
    color: #17a2b8;
    font-size: 1.05rem;
}

.price-text {
    font-weight: 700;
    color: #28a745;
}

.appraisal-text {
    font-weight: 700;
    color: #17a2b8;
}

.badge-percentage {
    display: inline-block;
    padding: 0.35rem 0.75rem;
    border-radius: 20px;
    font-weight: 700;
    font-size: 0.8rem;
    color: #fff;
    background: linear-gradient(135deg, #36d1dc, #5b86e5);
}

.badge-recommendation {
    display: inline-block;
    padding: 0.35rem 0.8rem;
    border-radius: 20px;
    font-weight: 700;
    font-size: 0.8rem;
    color: #fff;
}

.badge-layak {
    background: linear-gradient(135deg, #28c76f, #48da89) !important;
    color: #ffffff !important;
}

.badge-dipertimbangkan {
    background: linear-gradient(135deg, #ffb822, #ff9f43) !important;
    color: #ffffff !important;
}

.badge-tidak-layak {
    background: linear-gradient(135deg, #ea5455, #ff7976) !important;
    color: #ffffff !important;
}

.badge-review {
    background: linear-gradient(135deg, #00cfe8, #1e9ff2) !important;
    color: #ffffff !important;
}

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
    font-weight: 500;
}

.text-dark-title {
    font-size: 1.3rem !important;
    font-weight: 700;
    color: #2c2e3f !important;
    margin-bottom: 0.25rem !important;
}
@media (min-width: 576px) { .text-dark-title { font-size: 1.5rem !important; } }
@media (min-width: 768px) { .text-dark-title { font-size: 1.6rem !important; } }

.mdi {
    vertical-align: middle;
}
</style>

<div class="container-fluid p-2 p-sm-3 p-md-4">

    <!-- Header Card -->
    <div class="row mb-3 mb-sm-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="text-dark mb-1">
                            <i class="mdi mdi-bank me-2" style="color: #9a55ff;"></i>Analisa KPR Komersil
                        </h4>
                        <p class="text-muted mb-0">
                            Data analisa kelayakan KPR untuk unit komersil
                        </p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-home-account" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Card -->
    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-format-list-bulleted me-2"></i>Data Customer KPR Komersil
                    </h5>
                </div>

                <div class="card-body">
                    <!-- FILTER SECTION (DASHBOARD STYLE) -->
                    <div class="filter-card mb-3">
                        <form id="filterForm" method="GET" action="{{ route('analisa.kpr.komersil') }}">
                            <!-- DESKTOP & TABLET VERSION -->
                            <div class="filter-row-desktop d-none d-md-block">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                    <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">

                                        <!-- Search Input Group -->
                                        <div style="min-width: 220px; max-width: 320px; flex: 1;">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="search"
                                                    placeholder="Cari customer / unit..." value="{{ request('search', $search ?? '') }}"
                                                    style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none; height: 38px;">
                                                <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                    type="submit" title="Cari"
                                                    style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                    <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Bank Dropdown - SELECT2 -->
                                        <div style="min-width: 200px; max-width: 280px;">
                                            <select class="form-control select2" name="bank" id="bankSelect" style="width: 100%;">
                                                <option value="">Semua Bank</option>
                                                @foreach ($banks as $bank)
                                                    <option value="{{ $bank->id }}"
                                                        {{ (string) request('bank', $bankId ?? '') === (string) $bank->id ? 'selected' : '' }}>
                                                        {{ $bank->bank_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>

                                    <!-- Right Side: Limit Dropdown + Filter & Reset Buttons -->
                                    <div class="d-flex align-items-center gap-2 ms-auto">
                                        <div style="width: 90px;">
                                            <select class="form-control select2" name="per_page" id="perPageSelect" style="width: 100%;">
                                                <option value="10" {{ (int) request('per_page', $perPage ?? 10) === 10 ? 'selected' : '' }}>10</option>
                                                <option value="15" {{ (int) request('per_page', $perPage ?? 10) === 15 ? 'selected' : '' }}>15</option>
                                                <option value="25" {{ (int) request('per_page', $perPage ?? 10) === 25 ? 'selected' : '' }}>25</option>
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-gradient-primary btn-icon-only" title="Filter" onclick="showFilterLoading()">
                                            <i class="mdi mdi-filter"></i>
                                        </button>

                                        <a href="{{ route('analisa.kpr.komersil') }}" class="btn btn-gradient-secondary btn-icon-only" title="Reset" onclick="showResetLoading(event)">
                                            <i class="mdi mdi-refresh"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- MOBILE VERSION -->
                            <div class="filter-row-mobile d-block d-md-none">
                                <div class="row g-2">
                                    <div class="col-12 mb-2">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search"
                                                placeholder="Cari customer / unit..." value="{{ request('search', $search ?? '') }}"
                                                style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none; height: 38px;">
                                            <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                type="submit" title="Cari"
                                                style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <select class="form-control select2-mobile" name="bank" id="bankSelectMobile" style="width: 100%;">
                                            <option value="">Semua Bank</option>
                                            @foreach ($banks as $bank)
                                                <option value="{{ $bank->id }}"
                                                    {{ (string) request('bank', $bankId ?? '') === (string) $bank->id ? 'selected' : '' }}>
                                                    {{ $bank->bank_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <div class="d-flex align-items-center gap-2">
                                            <div style="flex: 1;">
                                                <select class="form-control select2-mobile" name="per_page" id="perPageSelectMobile" style="width: 100%;">
                                                    <option value="10" {{ (int) request('per_page', $perPage ?? 10) === 10 ? 'selected' : '' }}>10 / hal</option>
                                                    <option value="15" {{ (int) request('per_page', $perPage ?? 10) === 15 ? 'selected' : '' }}>15 / hal</option>
                                                    <option value="25" {{ (int) request('per_page', $perPage ?? 10) === 25 ? 'selected' : '' }}>25 / hal</option>
                                                </select>
                                            </div>

                                            <button type="submit" class="btn btn-gradient-primary btn-icon-only" title="Filter" onclick="showFilterLoading()">
                                                <i class="mdi mdi-filter"></i>
                                            </button>

                                            <a href="{{ route('analisa.kpr.komersil') }}" class="btn btn-gradient-secondary btn-icon-only" title="Reset" onclick="showResetLoading(event)">
                                                <i class="mdi mdi-refresh"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 50px;">NO</th>
                                    <th class="sortable" data-field="name"
                                        data-direction="{{ request('sortField') == 'name' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        NAMA CUSTOMER
                                        @if (request('sortField') == 'name')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable" data-field="unit"
                                        data-direction="{{ request('sortField') == 'unit' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        UNIT
                                        @if (request('sortField') == 'unit')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable" data-field="bank"
                                        data-direction="{{ request('sortField') == 'bank' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        BANK
                                        @if (request('sortField') == 'bank')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable" data-field="price"
                                        data-direction="{{ request('sortField') == 'price' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        HARGA UNIT
                                        @if (request('sortField') == 'price')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable" data-field="appraisal"
                                        data-direction="{{ request('sortField') == 'appraisal' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        APPRAISAL
                                        @if (request('sortField') == 'appraisal')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th>PERSENTASE</th>
                                    <th>REKOMENDASI</th>
                                    <th class="text-center" style="width: 130px;">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($applications as $app)
                                    @php
                                        $customerName = $app->customer->full_name ?? '-';
                                        $nameParts = preg_split('/\s+/', trim($customerName));
                                        $initialOne = isset($nameParts[0][0]) ? strtoupper($nameParts[0][0]) : 'N';
                                        $initialTwo = isset($nameParts[1][0])
                                            ? strtoupper($nameParts[1][0])
                                            : (isset($nameParts[0][1])
                                                ? strtoupper($nameParts[0][1])
                                                : 'A');
                                        $customerInitial = $initialOne . $initialTwo;

                                        $unitName = trim(
                                            ($app->unit->unit_name ?? '-') .
                                                (isset($app->unit->type) && $app->unit->type
                                                    ? ' - ' . $app->unit->type
                                                    : ''),
                                        );
                                        $bankName = $app->bank->bank_name ?? '-';
                                        $unitPrice = $app->unit->price ?? 0;
                                        $appraisal = $app->appraisal_value ?? 0;
                                        $percentage = isset($app->persentase_kelayakan)
                                            ? rtrim(
                                                    rtrim(
                                                        number_format(
                                                            (float) $app->persentase_kelayakan,
                                                            2,
                                                            '.',
                                                            '',
                                                        ),
                                                        '0',
                                                    ),
                                                    '.',
                                                ) . '%'
                                            : '-';
                                        $recommendation = $app->rekomendasi ?? '-';

                                        $recommendationClass = 'badge-review';
                                        if ($recommendation === 'Layak') {
                                            $recommendationClass = 'badge-layak';
                                        } elseif ($recommendation === 'Dipertimbangkan') {
                                            $recommendationClass = 'badge-dipertimbangkan';
                                        } elseif ($recommendation === 'Tidak Layak') {
                                            $recommendationClass = 'badge-tidak-layak';
                                        } elseif ($recommendation === 'Review') {
                                            $recommendationClass = 'badge-review';
                                        }
                                    @endphp
                                    <tr>
                                        <td class="fw-bold text-center">
                                            {{ ($applications->currentPage() - 1) * $applications->perPage() + $loop->iteration }}
                                        </td>

                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="customer-avatar">
                                                    {{ $customerInitial }}
                                                </div>
                                                <div class="customer-name">
                                                    {{ $customerName }}
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="unit-info">
                                                <i class="mdi mdi-home-city-outline"></i>
                                                <span>{{ $unitName }}</span>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="bank-info">
                                                <i class="mdi mdi-bank"></i>
                                                <span>{{ $bankName }}</span>
                                            </div>
                                        </td>

                                        <td>
                                            <span class="price-text">
                                                Rp {{ number_format($unitPrice, 0, ',', '.') }}
                                            </span>
                                        </td>

                                        <td>
                                            <span class="appraisal-text">
                                                Rp {{ number_format($appraisal, 0, ',', '.') }}
                                            </span>
                                        </td>

                                        <td>
                                            <span class="badge-percentage">
                                                {{ $percentage }}
                                            </span>
                                        </td>

                                        <td>
                                            <span class="badge-recommendation {{ $recommendationClass }}">
                                                {{ $recommendation }}
                                            </span>
                                        </td>

                                        <td class="text-center">
                                            <div class="d-flex align-items-center justify-content-center gap-1">
                                                @if (isset($app->unit->land_bank_id, $app->unit->id))
                                                    @php
                                                        $isUnitSoldOrDone = in_array(strtolower($app->unit->status ?? ''), ['sold', 'soldout']) || strtolower($app->unit->construction_progress ?? '') === 'selesai';
                                                    @endphp
                                                    @if($isUnitSoldOrDone)
                                                        <button class="btn btn-secondary btn-action" disabled title="Pembangunan Selesai / Unit Sold Out" style="opacity: 0.55; cursor: not-allowed;">
                                                            <i class="mdi mdi-home-lock"></i>
                                                        </button>
                                                    @else
                                                        <a href="{{ route('properti.progress', ['land_bank_id' => $app->unit->land_bank_id, 'unit_id' => $app->unit->id]) }}"
                                                            class="btn btn-gradient-info btn-action" title="Progress Pembangunan">
                                                            <i class="mdi mdi-home-edit"></i>
                                                        </a>
                                                    @endif
                                                @endif

                                                @if (($app->unit->construction_progress ?? null) == 'selesai')
                                                    <a href="{{ route('kpr.survey', $app->id) }}"
                                                        class="btn btn-gradient-success btn-action" title="Isi Survey Lapangan">
                                                        <i class="mdi mdi-clipboard-check-outline"></i>
                                                    </a>

                                                    @if ($app->status === 'survey')
                                                        <a href="{{ route('kpr.pecahlegal', $app->id) }}"
                                                            class="btn btn-gradient-warning btn-action"
                                                            title="Dokumen Persiapan">
                                                            <i class="mdi mdi-folder-file-outline"></i>
                                                        </a>
                                                    @endif
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted py-4">
                                            <i class="mdi mdi-information-outline fs-4 d-block mb-1 text-muted"></i>
                                            Tidak ada data analisa KPR komersil
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if ($applications instanceof \Illuminate\Pagination\LengthAwarePaginator && $applications->total() > 0)
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4 pt-2 border-top">
                            <div class="pagination-info mb-2 mb-sm-0">
                                Menampilkan {{ $applications->firstItem() }} - {{ $applications->lastItem() }} dari
                                {{ $applications->total() }} data
                            </div>
                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                    {{-- Previous Page Link --}}
                                    @if ($applications->onFirstPage())
                                        <li class="page-item disabled" aria-disabled="true">
                                            <span class="page-link" aria-label="Previous">
                                                <i class="mdi mdi-chevron-left"></i>
                                            </span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link"
                                                href="{{ $applications->appends(request()->query())->previousPageUrl() }}"
                                                rel="prev" aria-label="Previous"
                                                onclick="showPaginationLoading(event)">
                                                <i class="mdi mdi-chevron-left"></i>
                                            </a>
                                        </li>
                                    @endif

                                    {{-- Pagination Elements --}}
                                    @foreach ($applications->getUrlRange(max(1, $applications->currentPage() - 2), min($applications->lastPage(), $applications->currentPage() + 2)) as $page => $url)
                                        @if ($page == $applications->currentPage())
                                            <li class="page-item active" aria-current="page">
                                                <span class="page-link">{{ $page }}</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link"
                                                    href="{{ $applications->appends(request()->query())->url($page) }}"
                                                    onclick="showPaginationLoading(event)">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach

                                    {{-- Next Page Link --}}
                                    @if ($applications->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link"
                                                href="{{ $applications->appends(request()->query())->nextPageUrl() }}"
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
@endsection

@push('scripts')
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            // Inisialisasi Select2 Dashboard Style
            $('#bankSelect, #bankSelectMobile').select2({
                theme: 'bootstrap-5',
                placeholder: 'Semua Bank',
                allowClear: true,
                width: '100%'
            });

            $('#perPageSelect, #perPageSelectMobile').select2({
                theme: 'bootstrap-5',
                minimumResultsForSearch: Infinity,
                width: '100%'
            });

            // Auto-submit saat ganti per_page atau bank
            $('#perPageSelect, #bankSelect').on('change', function() {
                $('#filterForm').submit();
            });

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
