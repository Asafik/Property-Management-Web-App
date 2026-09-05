@extends('layouts.partial.app')

@section('title', 'Daftar Customer KPR Terverifikasi - Property Management App')

@section('content')
<style>
.card {
    transition: all 0.3s ease;
    margin-bottom: 1rem;
    border: none !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
}
.card:hover { box-shadow: 0 8px 25px rgba(154, 85, 255, 0.1) !important; }

.card-header {
    background: linear-gradient(135deg, #ffffff, #f8f9fa);
    border-bottom: 1px solid #e9ecef;
    padding: 0.75rem;
}
@media (min-width: 576px) { .card-header { padding: 1rem; } }
@media (min-width: 768px) { .card-header { padding: 1.2rem; } }

.card-body { padding: 0.75rem; }
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

.filter-card {
    background: #ffffff;
    border-radius: 12px;
    padding: 0;
    margin-bottom: 1.25rem;
    border: none;
}

.search-input-group {
    display: flex !important;
    flex-wrap: nowrap !important;
    align-items: stretch !important;
    width: 100% !important;
    height: 38px !important;
}

.search-input-group .form-control {
    height: 38px !important;
    min-height: 38px !important;
    border-top-left-radius: 8px !important;
    border-bottom-left-radius: 8px !important;
    border-top-right-radius: 0 !important;
    border-bottom-right-radius: 0 !important;
    border: 1.5px solid #e2e8f0 !important;
    border-right: none !important;
    font-size: 0.88rem !important;
    padding: 0.45rem 0.85rem !important;
    margin: 0 !important;
    flex: 1 1 auto;
}

.search-input-group .btn-search-submit {
    height: 38px !important;
    min-height: 38px !important;
    border-top-left-radius: 0 !important;
    border-bottom-left-radius: 0 !important;
    border-top-right-radius: 8px !important;
    border-bottom-right-radius: 8px !important;
    padding: 0 0.95rem !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    box-shadow: none !important;
    border: none !important;
    font-size: 1.15rem !important;
    color: #ffffff !important;
    margin: 0 !important;
    flex-shrink: 0;
}

.search-input-group:focus-within .form-control {
    border-color: #9a55ff !important;
    box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.15) !important;
}

.select2-container--bootstrap-5 .select2-selection {
    border: 1.5px solid #e2e8f0 !important;
    border-radius: 8px !important;
    min-height: 38px !important;
    height: 38px !important;
    padding: 0.35rem 0.75rem !important;
    font-family: inherit !important;
    background-color: #ffffff !important;
}

.select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
    color: #2c2e3f !important;
    font-size: 0.88rem !important;
    font-weight: 600 !important;
    line-height: 24px !important;
    padding-left: 0 !important;
}

.select2-container--bootstrap-5 .select2-selection--single .select2-selection__arrow {
    height: 36px !important;
    right: 8px !important;
}

.select2-container--bootstrap-5 .select2-selection:hover,
.select2-container--bootstrap-5.select2-container--focus .select2-selection,
.select2-container--bootstrap-5.select2-container--open .select2-selection {
    border-color: #9a55ff !important;
    box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.12) !important;
}

.select2-container--bootstrap-5 .select2-dropdown {
    border-color: #e2e8f0 !important;
    border-radius: 8px !important;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08) !important;
}

.select2-container--bootstrap-5 .select2-results__option {
    padding: 0.55rem 0.8rem !important;
    font-size: 0.86rem !important;
    font-weight: 600 !important;
}

.select2-container--bootstrap-5 .select2-results__option--selected {
    background-color: #f3e8ff !important;
    color: #7e22ce !important;
}

.select2-container--bootstrap-5 .select2-results__option--highlighted {
    background: #9a55ff !important;
    color: #ffffff !important;
}

.form-control, .form-select {
    border: 1px solid #e9ecef;
    border-radius: 8px;
    padding: 0.6rem 0.8rem;
    font-size: 0.9rem;
    transition: all 0.2s ease;
    background-color: #ffffff;
    color: #2c2e3f;
}
.form-control:focus, .form-select:focus {
    border-color: #9a55ff;
    box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.1);
    outline: none;
}
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
}

.btn-gradient-primary {
    background: linear-gradient(to right, #da8cff, #9a55ff) !important;
    color: #ffffff !important;
}
.btn-gradient-secondary {
    background: #6c757d !important;
    color: #ffffff !important;
}
.btn-icon-only {
    width: 40px;
    height: 40px;
    padding: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    flex-shrink: 0;
}

.btn-gradient-warning {
    background: linear-gradient(135deg, #ffb822, #ff9f43) !important;
    color: #ffffff !important;
    border: none !important;
    box-shadow: 0 4px 10px rgba(255, 184, 34, 0.25) !important;
    width: auto !important;
    min-width: fit-content !important;
    height: auto !important;
    min-height: 34px !important;
    padding: 0.45rem 1rem !important;
    font-size: 0.82rem !important;
    font-weight: 700 !important;
    white-space: nowrap !important;
    border-radius: 8px !important;
    text-decoration: none !important;
}
.btn-gradient-warning:hover {
    background: linear-gradient(135deg, #ffaa00, #ff8c00) !important;
    color: #ffffff !important;
    box-shadow: 0 6px 15px rgba(255, 184, 34, 0.35) !important;
    transform: translateY(-2px);
}

.table thead th {
    background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
    color: #9a55ff;
    font-weight: 700;
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 2px solid #edf2f9;
    padding: 0.9rem 0.75rem;
    white-space: nowrap;
}
.table tbody td {
    padding: 0.85rem 0.75rem;
    vertical-align: middle;
    border-bottom: 1px solid #f2f4f8;
    color: #2c2e3f;
    font-size: 0.88rem;
}
.table tbody tr { transition: all 0.2s ease; }
.table tbody tr:hover { background-color: #faf8ff; }

.customer-avatar {
    width: 38px;
    height: 38px;
    border-radius: 10px;
    background: linear-gradient(135deg, #da8cff, #9a55ff);
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.85rem;
    font-weight: 700;
    text-transform: uppercase;
    box-shadow: 0 4px 12px rgba(154, 85, 255, 0.18);
    flex-shrink: 0;
}

.badge-status {
    padding: 0.45rem 0.85rem;
    border-radius: 20px;
    font-weight: 700;
    font-size: 0.76rem;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    letter-spacing: 0.3px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
}
.badge-verified {
    background: linear-gradient(135deg, #28c76f, #1fa75a) !important;
    color: #ffffff !important;
    box-shadow: 0 2px 8px rgba(40, 199, 111, 0.3) !important;
}
.badge-survey {
    background: linear-gradient(135deg, #00cfe8, #1e9ff2) !important;
    color: #ffffff !important;
    box-shadow: 0 2px 8px rgba(0, 207, 232, 0.3) !important;
}
.badge-akad {
    background: linear-gradient(135deg, #da8cff, #9a55ff) !important;
    color: #ffffff !important;
    box-shadow: 0 2px 8px rgba(154, 85, 255, 0.3) !important;
}
.badge-default {
    background: linear-gradient(135deg, #82868b, #6c757d) !important;
    color: #ffffff !important;
}

.badge-gradient-primary {
    background: linear-gradient(to right, #da8cff, #9a55ff) !important;
    color: #fff;
    font-weight: 600;
    font-size: 0.75rem;
    padding: 0.4rem 0.7rem;
    border-radius: 6px;
    display: inline-flex;
    align-items: center;
}
.badge-gradient-success {
    background: linear-gradient(to right, #84d9d2, #07cdae) !important;
    color: #fff;
    font-weight: 600;
    font-size: 0.75rem;
    padding: 0.4rem 0.7rem;
    border-radius: 6px;
    display: inline-flex;
    align-items: center;
}
.badge-gradient-secondary {
    background: linear-gradient(to right, #e0e0e0, #bdbdbd) !important;
    color: #424242;
    font-weight: 600;
    font-size: 0.75rem;
    padding: 0.4rem 0.7rem;
    border-radius: 6px;
    display: inline-flex;
    align-items: center;
}

.pagination { margin-bottom: 0; gap: 5px; }
.page-item .page-link {
    border-radius: 8px !important;
    border: 1px solid #e9ecef;
    color: #2c2e3f;
    font-weight: 600;
    padding: 0.5rem 0.85rem;
    font-size: 0.85rem;
    transition: all 0.2s ease;
}
.page-item.active .page-link {
    background: linear-gradient(to right, #da8cff, #9a55ff) !important;
    border-color: #9a55ff;
    color: #ffffff;
    box-shadow: 0 4px 10px rgba(154, 85, 255, 0.25);
}
.page-item .page-link:hover {
    background-color: #f3e8ff;
    color: #9a55ff;
    border-color: #da8cff;
}
</style>

<div class="container-fluid p-2 p-sm-3 p-md-4">

    <div class="row mb-3 mb-sm-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="text-dark mb-1">
                            <i class="mdi mdi-bank me-2" style="color: #9a55ff;"></i>Daftar User KPR Terverifikasi
                        </h4>
                        <p class="text-muted mb-0">
                            Persiapan & Pemrosesan Akad KPR Konsumen
                        </p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-home-account" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-format-list-bulleted me-2"></i>Data Customer KPR Terverifikasi
                    </h5>
                </div>

                <div class="card-body">

                    <div class="filter-card mb-3">
                        <form method="GET" action="{{ route('customer.kpr.survey') }}" id="filterForm">
                            <div class="filter-row-desktop d-none d-md-block">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                    <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                        <div style="min-width: 220px; max-width: 280px; flex: 1;">
                                            <div class="input-group search-input-group">
                                                <input type="text" name="search" value="{{ request('search') }}"
                                                    class="form-control" placeholder="Cari nama user...">
                                                <button class="btn btn-gradient-primary btn-search-submit" 
                                                    type="submit" title="Cari">
                                                    <i class="mdi mdi-magnify"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div style="width: 170px;">
                                            <select name="status" class="form-control select2" id="statusSelect" style="width: 100%;">
                                                <option value="">Semua Status</option>
                                                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Terverifikasi</option>
                                                <option value="survey" {{ request('status') == 'survey' ? 'selected' : '' }}>Survey</option>
                                                <option value="akad" {{ request('status') == 'akad' ? 'selected' : '' }}>Akad</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center gap-2 ms-auto">
                                        <div style="width: 90px;">
                                            <select name="per_page" class="form-control select2" id="perPageSelect" style="width: 100%;">
                                                <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                                <option value="15" {{ request('per_page', 15) == 15 ? 'selected' : '' }}>15</option>
                                                <option value="25" {{ request('per_page', 25) == 25 ? 'selected' : '' }}>25</option>
                                            </select>
                                        </div>
                                        <button type="submit"
                                            class="btn btn-gradient-primary btn-icon-only"
                                            id="filterBtn" title="Filter" onclick="showFilterLoading()">
                                            <i class="mdi mdi-filter"></i>
                                        </button>
                                        <a href="{{ route('customer.kpr.survey') }}"
                                            class="btn btn-gradient-secondary btn-icon-only"
                                            title="Reset" onclick="showResetLoading(event)">
                                            <i class="mdi mdi-refresh"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="d-block d-md-none">
                                <div class="row g-2">
                                    <div class="col-12 mb-2">
                                        <div class="input-group search-input-group">
                                            <input type="text" name="search_mobile"
                                                value="{{ request('search') }}" class="form-control"
                                                placeholder="Cari nama user..." id="searchMobile">
                                            <button class="btn btn-gradient-primary btn-search-submit" 
                                                type="submit" title="Cari">
                                                <i class="mdi mdi-magnify"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <select name="status_mobile" class="form-control select2-mobile" id="statusSelectMobile" style="width: 100%;">
                                            <option value="">Semua Status</option>
                                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Terverifikasi</option>
                                            <option value="survey" {{ request('status') == 'survey' ? 'selected' : '' }}>Survey</option>
                                            <option value="akad" {{ request('status') == 'akad' ? 'selected' : '' }}>Akad</option>
                                        </select>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <select name="per_page_mobile" class="form-control select2-mobile" id="perPageSelectMobile" style="width: 100%;">
                                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                            <option value="15" {{ request('per_page', 15) == 15 ? 'selected' : '' }}>15</option>
                                            <option value="25" {{ request('per_page', 25) == 25 ? 'selected' : '' }}>25</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <button type="submit"
                                            class="btn btn-gradient-primary w-100 d-inline-flex align-items-center justify-content-center"
                                            id="filterBtnMobile" title="Filter"
                                            onclick="showFilterLoading()" style="height: 38px;">
                                            <i class="mdi mdi-filter me-1"></i>Filter
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('customer.kpr.survey') }}"
                                            class="btn btn-gradient-secondary w-100 d-inline-flex align-items-center justify-content-center"
                                            title="Reset" onclick="showResetLoading(event)" style="height: 38px; text-decoration: none;">
                                            <i class="mdi mdi-refresh me-1"></i>Reset
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="sortable" data-field="name" data-direction="{{ request('sort', 'latest') == 'name_asc' ? 'asc' : 'desc' }}" style="cursor:pointer;">
                                        Nama User
                                        <i class="mdi {{ request('sort') == 'name_asc' ? 'mdi-sort-alphabetical-ascending' : (request('sort') == 'name_desc' ? 'mdi-sort-alphabetical-descending' : 'mdi-sort') }}"></i>
                                    </th>
                                    <th class="sortable" data-field="unit" data-direction="{{ request('sort', 'latest') == 'unit_asc' ? 'asc' : 'desc' }}" style="cursor:pointer;">
                                        Nama - Unit
                                        <i class="mdi {{ request('sort') == 'unit_asc' ? 'mdi-sort-alphabetical-ascending' : (request('sort') == 'unit_desc' ? 'mdi-sort-alphabetical-descending' : 'mdi-sort') }}"></i>
                                    </th>
                                    <th>Jenis & Tipe</th>
                                    <th>Bank</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Tanggal Verifikasi</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($kprApplications as $index => $application)
                                    @php
                                        $fullName = trim($application->customer->full_name ?? '-');
                                        $nameParts = array_values(array_filter(explode(' ', $fullName)));
                                        $initials = (count($nameParts) > 0) ? strtoupper(substr($nameParts[0], 0, 1)) . (isset($nameParts[1]) ? strtoupper(substr($nameParts[1], 0, 1)) : '') : '--';
                                    @endphp
                                    <tr>
                                        <td class="text-center fw-bold">{{ $kprApplications->firstItem() + $index }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="customer-avatar me-2">{{ $initials }}</div>
                                                <span class="fw-bold">{{ $application->customer->full_name ?? '-' }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="unit-info">
                                                <span class="unit-name fw-bold">
                                                    <i class="mdi mdi-home-outline text-primary me-1"></i>
                                                    {{ $application->unit->unit_name ?? '-' }} - {{ $application->unit->unit_code ?? '-' }}
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            @php
                                                $jenis = strtolower($application->unit->jenis ?? '');
                                                $badgeClass = $jenis == 'subsidi' ? 'badge-gradient-success' : 'badge-gradient-primary';
                                                $icon = $jenis == 'subsidi' ? 'mdi-home-assistant' : 'mdi-office-building';
                                            @endphp
                                            <span class="badge {{ $badgeClass }}">
                                                <i class="mdi {{ $icon }} me-1"></i>
                                                {{ ucfirst($jenis) }} - {{ $application->unit->type ?? '-' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-bank-outline text-primary me-2" style="font-size: 1.1rem;"></i>
                                                <span class="fw-bold">{{ $application->bank->bank_name ?? '-' }}</span>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            @php
                                                $isUnitSoldOut = in_array(strtolower($application->unit->status ?? ''), ['sold', 'soldout']) || in_array(strtolower($application->status ?? ''), ['akad', 'completed', 'sold', 'done']);
                                            @endphp
                                            @if ($isUnitSoldOut)
                                                <span class="badge-status badge-akad" style="background: linear-gradient(135deg, #7c3aed, #4f46e5); color: #fff;">
                                                    <i class="mdi mdi-home-lock me-1"></i>Sold Out
                                                </span>
                                            @elseif ($application->status === 'approved' || $application->status === 'dokumen')
                                                <span class="badge-status badge-verified">
                                                    <i class="mdi mdi-check-circle-outline me-1"></i>Terverifikasi
                                                </span>
                                            @elseif ($application->status === 'survey')
                                                <span class="badge-status badge-survey">
                                                    <i class="mdi mdi-map-marker-check-outline me-1"></i>Survey
                                                </span>
                                            @else
                                                <span class="badge-status badge-default">
                                                    <i class="mdi mdi-progress-question me-1"></i>{{ ucfirst($application->status ?? '-') }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="d-inline-flex align-items-center">
                                                <i class="mdi mdi-calendar-month-outline text-muted me-1" style="font-size: 1rem;"></i>
                                                <span>{{ optional($application->updated_at)->format('d M Y') ?? '-' }}</span>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center align-items-center">
                                                @if ($isUnitSoldOut)
                                                    <button type="button" class="btn btn-sm d-inline-flex align-items-center justify-content-center px-3 py-1.5" disabled title="Unit telah Akad / Sold Out" style="background: #f5f3ff; color: #7c3aed; border: 1.5px solid #8b5cf6; font-weight: 700; border-radius: 8px; min-height: 34px; cursor: not-allowed; box-shadow: 0 2px 6px rgba(139, 92, 246, 0.12);">
                                                        <i class="mdi mdi-home-lock me-1.5" style="font-size: 1.05rem; color: #7c3aed;"></i>Sold Out
                                                    </button>
                                                @else
                                                    <a href="{{ route('kpr.approve', $application->booking_id ?? $application->id) }}" class="btn btn-gradient-warning btn-sm d-inline-flex align-items-center justify-content-center px-3 py-1.5" title="Proses Akad KPR" onclick="showProcessLoading(event)" style="font-weight: 700; border-radius: 8px; border: 1.5px solid #d97706; box-shadow: 0 2px 8px rgba(245, 158, 11, 0.25); min-height: 34px; text-decoration: none;">
                                                        <i class="mdi mdi-handshake-outline me-1.5" style="font-size: 1.05rem;"></i>Proses Akad
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-4">Tidak ada data user KPR terverifikasi</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if(($kprApplications->total() ?? 0) > 0)
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                            <div class="pagination-info mb-2 mb-sm-0 text-muted" style="font-size: 0.85rem;">
                                Menampilkan {{ $kprApplications->firstItem() ?? 1 }} - {{ $kprApplications->lastItem() ?? 1 }} dari {{ $kprApplications->total() }} data
                            </div>
                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                    @if ($kprApplications->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link"><i class="mdi mdi-chevron-left"></i></span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $kprApplications->previousPageUrl() }}" onclick="showPaginationLoading(event)"><i class="mdi mdi-chevron-left"></i></a>
                                        </li>
                                    @endif

                                    @foreach ($kprApplications->getUrlRange(1, $kprApplications->lastPage()) as $page => $url)
                                        <li class="page-item {{ $kprApplications->currentPage() == $page ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}" onclick="showPaginationLoading(event)">{{ $page }}</a>
                                        </li>
                                    @endforeach

                                    @if ($kprApplications->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $kprApplications->nextPageUrl() }}" onclick="showPaginationLoading(event)"><i class="mdi mdi-chevron-right"></i></a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <span class="page-link"><i class="mdi mdi-chevron-right"></i></span>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    $('#statusSelect').select2({ theme: 'bootstrap-5', placeholder: 'Semua Status', allowClear: true, width: '100%', minimumResultsForSearch: Infinity });
    $('#perPageSelect').select2({ theme: 'bootstrap-5', placeholder: '10', allowClear: false, width: '100%', minimumResultsForSearch: Infinity });
    $('#statusSelectMobile').select2({ theme: 'bootstrap-5', placeholder: 'Semua Status', allowClear: true, width: '100%', minimumResultsForSearch: Infinity });
    $('#perPageSelectMobile').select2({ theme: 'bootstrap-5', placeholder: '10', allowClear: false, width: '100%', minimumResultsForSearch: Infinity });

    $('input[name="search"]').on('input', function() { $('#searchMobile').val($(this).val()); });
    $('#searchMobile').on('input', function() { $('input[name="search"]').val($(this).val()); });

    $('.sortable').click(function(event) {
        event.preventDefault();
        let field = $(this).data('field');
        let currentDirection = $(this).data('direction');
        let newDirection = currentDirection === 'asc' ? 'desc' : 'asc';
        let sortParam = field + '_' + newDirection;

        Swal.fire({ title: 'Memuat...', html: 'Sedang mengurutkan data', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } });

        let url = new URL(window.location.href);
        url.searchParams.set('sort', sortParam);
        url.searchParams.set('page', 1);
        window.location.href = url.toString();
    });
});

function showPaginationLoading(event) { event.preventDefault(); Swal.fire({ title: 'Memuat...', html: 'Sedang memuat halaman', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } }); window.location.href = event.currentTarget.href; }
function showFilterLoading() { Swal.fire({ title: 'Memuat...', html: 'Sedang memfilter data', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } }); }
function showResetLoading(event) { event.preventDefault(); Swal.fire({ title: 'Memuat...', html: 'Sedang mereset filter', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } }); window.location.href = event.currentTarget.href; }
function showProcessLoading(event) { event.preventDefault(); Swal.fire({ title: 'Memuat...', html: 'Sedang memproses...', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } }); window.location.href = event.currentTarget.href; }
</script>

@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        timer: 2500,
        showConfirmButton: false
    });
</script>
@endif

@if (session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: "{{ session('error') }}",
        confirmButtonColor: '#9a55ff'
    });
</script>
@endif
@endpush
