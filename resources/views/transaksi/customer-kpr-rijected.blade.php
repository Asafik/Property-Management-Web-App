
@extends('layouts.partial.app')

@section('title', 'Daftar Customer KPR Terverifikasi - Demo UI')

@section('content')

<style>
.card {
    transition: all 0.3s ease;
    margin-bottom: 1rem;
    border: none !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
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
    .card-header { padding: 1rem; }
}
@media (min-width: 768px) {
    .card-header { padding: 1.2rem; }
}

.card-body {
    padding: 0.75rem;
}
@media (min-width: 576px) {
    .card-body { padding: 1rem; }
}
@media (min-width: 768px) {
    .card-body { padding: 1.2rem; }
}

.card-title {
    font-size: 0.9rem;
    font-weight: 600;
    color: #9a55ff;
    margin-bottom: 0;
}
@media (min-width: 576px) {
    .card-title { font-size: 1rem; }
}
@media (min-width: 768px) {
    .card-title { font-size: 1.1rem; }
}

.filter-card {
    background: linear-gradient(135deg, #f9f7ff, #f2ecff);
    border-radius: 12px;
    padding: 1rem;
    margin-bottom: 1.25rem;
    border: none;
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

.filter-row-desktop {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}
.filter-row-desktop .filter-text {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #9a55ff;
    font-weight: 600;
    font-size: 0.95rem;
}
.filter-row-mobile { display: none; }

@media (max-width: 767px) {
    .filter-row-desktop { display: none; }
    .filter-row-mobile { display: block; margin-top: 1rem; }
}

.btn-icon-only {
    width: 40px;
    height: 40px;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
}

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
.form-label {
    font-size: 0.85rem;
    font-weight: 600;
    color: #9a55ff !important;
    margin-bottom: 0.3rem;
    letter-spacing: 0.3px;
    font-family: 'Nunito', sans-serif;
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
@media (min-width: 576px) {
    .btn {
        font-size: 0.9rem;
        padding: 0.7rem 1.2rem;
        border-radius: 10px;
    }
}
.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
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

.btn-action {
    height: 36px;
    padding: 0 14px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    transition: all 0.3s ease;
    cursor: pointer;
    font-size: 0.82rem;
    font-weight: 600;
    gap: 0.35rem;
    background: transparent;
    color: #9a55ff;
    border: 1.5px solid #9a55ff;
    text-decoration: none;
}
.btn-action i {
    font-size: 1rem;
}
.btn-action:hover {
    background: #9a55ff;
    color: #ffffff;
    box-shadow: 0 5px 15px rgba(154, 85, 255, 0.25);
    transform: translateY(-2px);
}

.btn-action-warning {
    background: transparent !important;
    color: #2c2e3f !important;
    border: 1.5px solid #ffb822 !important;
}
.btn-action-warning i {
    color: #2c2e3f !important;
}
.btn-action-warning:hover {
    background: #ffb822 !important;
    color: #2c2e3f !important;
    box-shadow: 0 5px 15px rgba(255, 184, 34, 0.25) !important;
}
.btn-action-warning:hover i {
    color: #2c2e3f !important;
}

.table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    border-radius: 8px;
    margin-bottom: 0.5rem;
    scrollbar-width: thin;
    scrollbar-color: #9a55ff #f0f0f0;
}
.table-responsive::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}
.table-responsive::-webkit-scrollbar-track {
    background: #f0f0f0;
    border-radius: 10px;
}
.table-responsive::-webkit-scrollbar-thumb {
    background: #9a55ff;
    border-radius: 10px;
}
.table-responsive::-webkit-scrollbar-thumb:hover {
    background: #7a3fcc;
}
.table-responsive::-webkit-scrollbar-corner {
    background: #f0f0f0;
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
    position: sticky;
    top: 0;
    z-index: 10;
    cursor: pointer;
    transition: all 0.2s ease;
}
.table thead th:hover {
    color: #7a3fcc;
}
.table thead th i {
    font-size: 0.8rem;
    margin-left: 4px;
    opacity: 0.5;
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

.table thead th:first-child {
    padding-left: 0.5rem;
    width: 40px;
    text-align: center;
}
.table tbody td:first-child {
    padding-left: 0.5rem;
    font-weight: 500;
    width: 40px;
    text-align: center;
}
.table tbody td {
    vertical-align: middle;
    font-size: 0.85rem;
    padding: 0.8rem 0.5rem;
    border-bottom: 1px solid #e9ecef;
    color: #2c2e3f;
    white-space: nowrap;
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

.badge-status {
    padding: 0.35rem 0.8rem;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.82rem;
    display: inline-block;
    color: #fff;
}
.badge-verified {
    background: linear-gradient(135deg, #28a745, #48c774);
}
.badge-survey {
    background: linear-gradient(135deg, #ffc107, #ffdb6d);
    color: #2c2e3f;
}
.badge-akad {
    background: linear-gradient(135deg, #9a55ff, #b47aff);
}

.badge {
    padding: 0.35rem 0.6rem;
    font-size: 0.75rem;
    font-weight: 600;
    border-radius: 30px;
    display: inline-block;
    white-space: nowrap;
}
@media (min-width: 576px) { .badge { padding: 0.4rem 0.75rem; font-size: 0.8rem; } }
.badge-gradient-success { background: linear-gradient(135deg, #28a745, #5cb85c); color: #ffffff; border:none; }
.badge-gradient-primary { background: linear-gradient(to right, #da8cff, #9a55ff) !important; color: #ffffff !important; border:none; }
.badge-gradient-secondary { background: #6c757d !important; color: #ffffff !important; border:none; }

.badge-default {
    background: linear-gradient(135deg, #6c757d, #868e96);
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
    transition: all 0.2s ease;
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
    font-size: 0.8rem;
    color: #6c7383;
}

.text-primary { color: #9a55ff !important; }
.text-muted { color: #a5b3cb !important; }
.fw-bold { font-weight: 600 !important; }

h3.text-dark {
    font-size: 1.3rem !important;
    font-weight: 700;
    color: #2c2e3f !important;
    margin-bottom: 0.5rem !important;
}
@media (min-width: 576px) {
    h3.text-dark { font-size: 1.5rem !important; }
}
@media (min-width: 768px) {
    h3.text-dark { font-size: 1.7rem !important; }
}

.mdi {
    vertical-align: middle;
}

.unit-info {
    display: flex;
    flex-direction: column;
    gap: 0.3rem;
}
.unit-name {
    font-weight: 600;
    color: #2c2e3f;
    font-size: 0.95rem;
}
.unit-details {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    align-items: center;
}
.unit-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
    padding: 0.2rem 0.6rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 500;
}
.unit-badge i {
    font-size: 0.7rem;
}
.unit-badge.type {
    background: linear-gradient(135deg, #f2ecff, #e6d9ff);
    color: #9a55ff;
}

.customer-avatar {
    width: 38px;
    height: 38px;
    min-width: 38px;
    border-radius: 50%;
    background: linear-gradient(135deg, #da8cff, #9a55ff);
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.85rem;
    font-weight: 700;
    text-transform: uppercase;
    box-shadow: 0 4px 12px rgba(154, 85, 255, 0.18);
}
</style>

<div class="container-fluid p-2 p-sm-3 p-md-4">

    <div class="row mb-3 mb-sm-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="text-dark mb-1">
                            <i class="mdi mdi-file-document-check-outline me-2" style="color: #9a55ff;"></i>Daftar User KPR Persiapan Pecah Legal Unit
                        </h3>
                        <p class="text-muted mb-0">
                           Persiapan Pecah Legal Unit
                        </p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-account-check-outline" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
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

                    <div class="filter-card mb-4">
                        <div class="card-body">
                            <div class="filter-row-desktop">
                                <div class="filter-text">
                                    <i class="mdi mdi-filter-outline"></i>
                                    <span>Filter data user KPR Terverifikasi</span>
                                </div>

                                <form method="GET" action="{{ route('customer.kpr.survey') }}">
                                    <div class="row g-2 align-items-end w-100">
                                        <div class="col-md-8">
                                            <label class="form-label">Search</label>
                                            <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Cari nama user...">
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label">Tampil</label>
                                            <select class="form-control" name="per_page">
                                                <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                                <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
                                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                            </select>
                                        </div>

                                        <div class="col-md-1">
                                            <button type="submit" class="btn btn-gradient-primary btn-icon-only w-100" title="Filter" onclick="showFilterLoading()">
                                                <i class="mdi mdi-filter"></i>
                                            </button>
                                        </div>

                                        <div class="col-md-1">
                                            <a href="{{ route('customer.kpr.survey') }}" class="btn btn-gradient-secondary btn-icon-only w-100" title="Reset" style="text-decoration:none;" onclick="showResetLoading(event)">
                                                <i class="mdi mdi-refresh"></i>
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="filter-row-mobile">
                                <div class="filter-text mb-2">
                                    <i class="mdi mdi-filter-outline"></i>
                                    <span>Filter data user KPR Terverifikasi</span>
                                </div>

                                <form method="GET" action="{{ route('customer.kpr.survey') }}">
                                    <div class="row g-2">
                                        <div class="col-12 mb-2">
                                            <label class="form-label">Search</label>
                                            <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Cari nama user...">
                                        </div>

                                        <div class="col-12 mb-2">
                                            <label class="form-label">Tampil</label>
                                            <select class="form-control" name="per_page">
                                                <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                                <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
                                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                            </select>
                                        </div>

                                        <div class="col-6">
                                            <button type="submit" class="btn btn-gradient-primary w-100" onclick="showFilterLoading()">
                                                <i class="mdi mdi-filter me-1"></i>Filter
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <a href="{{ route('customer.kpr.survey') }}" class="btn btn-gradient-secondary w-100" style="text-decoration:none;" onclick="showResetLoading(event)">
                                                <i class="mdi mdi-refresh me-1"></i>Reset
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
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
                                    <th>Status</th>
                                    <th>Tanggal Verifikasi</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($kprApplications as $index => $application)
                                    @php
                                        $fullName = trim($application->customer->full_name ?? '-');
                                        $nameParts = array_values(array_filter(explode(' ', $fullName)));
                                        $initials = '';

                                        if ($fullName !== '-' && count($nameParts) > 0) {
                                            $initials .= strtoupper(substr($nameParts[0], 0, 1));
                                            if (count($nameParts) > 1) {
                                                $initials .= strtoupper(substr($nameParts[count($nameParts) - 1], 0, 1));
                                            } else {
                                                $initials .= strtoupper(substr($nameParts[0], 1, 1));
                                            }
                                        } else {
                                            $initials = '--';
                                        }
                                    @endphp

                                    <tr>
                                        <td class="text-center fw-bold">
                                            {{ $kprApplications->firstItem() + $index }}
                                        </td>

                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="customer-avatar me-2">
                                                    {{ $initials }}
                                                </div>
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
                                                $tipe = $application->unit->type ?? '-';
                                                $badgeClass = $jenis == 'subsidi' ? 'badge-gradient-success' : ($jenis == 'komersil' ? 'badge-gradient-primary' : 'badge-gradient-secondary');
                                                $icon = $jenis == 'subsidi' ? 'mdi-home-assistant' : ($jenis == 'komersil' ? 'mdi-office-building' : 'mdi-help-circle-outline');
                                            @endphp
                                            <span class="badge {{ $badgeClass }}">
                                                <i class="mdi {{ $icon }} me-1"></i>
                                                {{ ucfirst($jenis ?: '-') }} - {{ $tipe }}
                                            </span>
                                        </td>



                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-bank-outline text-primary me-2" style="font-size: 1.1rem;"></i>
                                                <span class="fw-bold">{{ $application->bank->bank_name ?? '-' }}</span>
                                            </div>
                                        </td>

                                        <td>
                                            @if ($application->status === 'dokumen')
                                                <span class="badge-status badge-verified">
                                                    <i class="mdi mdi-check-circle-outline me-1"></i>Terverifikasi
                                                </span>
                                            @elseif ($application->status === 'survey')
                                                <span class="badge-status badge-survey">
                                                    <i class="mdi mdi-map-marker-check-outline me-1"></i>Survey
                                                </span>
                                            @elseif ($application->status === 'akad')
                                                <span class="badge-status badge-akad">
                                                    <i class="mdi mdi-handshake-outline me-1"></i>Akad
                                                </span>
                                            @else
                                                <span class="badge-status badge-default">
                                                    <i class="mdi mdi-progress-question me-1"></i>{{ ucfirst($application->status ?? '-') }}
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-calendar-month-outline text-muted me-2" style="font-size: 1rem;"></i>
                                                <span>{{ optional($application->updated_at)->format('d M Y') ?? '-' }}</span>
                                            </div>
                                        </td>

                                        <td class="text-center">
                                            @if (($application->unit->jenis ?? null) === 'subsidi')
                                                <a
                                                    href="{{ route('kpr.pecahlegal', $application->id) }}"
                                                    class="btn-action btn-action-warning"
                                                    title="Persiapan Pecah Legal Unit"
                                                    onclick="showProcessLoading(event)"
                                                >
                                                    <i class="mdi mdi-file-document-edit-outline"></i>
                                                    Persiapan Pecah Legal
                                                </a>
                                            @elseif (($application->unit->jenis ?? null) === 'komersil')
                                                @if ($application->status === 'survey')
                                                    <a
                                                        href="{{ route('kpr.survey', $application->id) }}"
                                                        class="btn-action"
                                                        title="Lanjut Survey"
                                                        onclick="showProcessLoading(event)"
                                                    >
                                                        <i class="mdi mdi-arrow-right-bold-circle-outline"></i>
                                                        Lanjut Survey
                                                    </a>
                                                @else
                                                    <a
                                                        href="{{ route('kpr.akad', $application->id) }}"
                                                        class="btn-action"
                                                        title="Lanjut Akad"
                                                        onclick="showProcessLoading(event)"
                                                    >
                                                        <i class="mdi mdi-handshake-outline"></i>
                                                        Lanjut Akad
                                                    </a>
                                                @endif
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-4">
                                            Tidak ada data customer KPR terverifikasi
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if(($kprApplications->count() ?? 0) > 0)
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                            <div class="pagination-info mb-2 mb-sm-0">
                                Menampilkan {{ $kprApplications->firstItem() ?? 0 }} - {{ $kprApplications->lastItem() ?? 0 }} dari {{ $kprApplications->total() }} data
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
function showPaginationLoading(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Memuat...',
        html: 'Sedang memuat halaman',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    window.location.href = event.currentTarget.href;
}

function showFilterLoading() {
    Swal.fire({
        title: 'Memuat...',
        html: 'Sedang memfilter data',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
}

function showResetLoading(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Memuat...',
        html: 'Sedang mereset filter',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    window.location.href = event.currentTarget.href;
}

function showProcessLoading(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Memuat...',
        html: 'Sedang memproses...',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    window.location.href = event.currentTarget.href;
}

$(document).ready(function() {
    $('.sortable').click(function(event) {
        event.preventDefault();
        let field = $(this).data('field');
        let currentDirection = $(this).data('direction');
        let newDirection = currentDirection === 'asc' ? 'desc' : 'asc';
        let sortParam = field + '_' + newDirection;

        Swal.fire({
            title: 'Memuat...',
            html: 'Sedang mengurutkan data',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        let url = new URL(window.location.href);
        url.searchParams.set('sort', sortParam);
        window.location.href = url.toString();
    });
});
</script>
@endpush
