@extends('layouts.partial.app')

@section('title', 'Semua Properti Proyek')

@section('content')

@php
    function sortIcon($column) {
        if (request('sort_by') !== $column) return 'mdi-swap-vertical text-muted';
        return request('sort_order', 'asc') === 'desc' ? 'mdi-arrow-down text-primary fw-bold' : 'mdi-arrow-up text-primary fw-bold';
    }
@endphp

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
.filter-card .form-control, .filter-card .form-select {
    padding: 0.5rem 0.75rem;
    font-size: 0.9rem;
    border-radius: 8px;
    height: auto;
    min-height: 40px;
    border: 1px solid #e0e4e9;
}
.form-control, .form-select {
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
    .form-control, .form-select {
        padding: 0.7rem 1rem;
        font-size: 0.95rem;
        border-radius: 10px;
    }
}
.form-control:focus, .form-select:focus {
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
    .btn { font-size: 0.9rem; padding: 0.7rem 1.2rem; border-radius: 10px; }
}
.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}
.btn-gradient-primary { background: linear-gradient(to right, #da8cff, #9a55ff) !important; color: #ffffff !important; }
.btn-gradient-secondary { background: #6c757d !important; color: #ffffff !important; }
.btn-gradient-secondary:hover { background: #5a6268 !important; }

/* Tombol eye dengan warna purple */
.btn-outline-purple {
    background: transparent;
    border: 2px solid #9a55ff !important;
    color: #9a55ff;
    padding: 0.35rem 0.9rem;
    font-size: 0.8rem;
    border-radius: 20px;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
    text-decoration: none;
}
.btn-outline-purple:hover {
    background: #9a55ff;
    color: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(154, 85, 255, 0.3);
}
.btn-outline-purple i {
    font-size: 1rem;
}

.table-responsive {
    overflow-x: auto;
    overflow-y: visible;
    -webkit-overflow-scrolling: touch;
    border-radius: 8px;
    margin-bottom: 0.5rem;
    scrollbar-width: thin;
    scrollbar-color: #9a55ff #f0f0f0;
}
.table-responsive::-webkit-scrollbar { height: 8px; }
.table-responsive::-webkit-scrollbar-track { background: #f0f0f0; border-radius: 10px; }
.table-responsive::-webkit-scrollbar-thumb { background: #9a55ff; border-radius: 10px; }
.table-responsive::-webkit-scrollbar-thumb:hover { background: #7a3fcc; }

.table { width: 100%; border-collapse: collapse; margin-bottom: 0; }
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
}
@media (min-width: 576px) { .table thead th { font-size: 0.85rem; padding: 0.9rem 0.6rem; } }
@media (min-width: 768px) { .table thead th { font-size: 0.9rem; padding: 1rem 0.75rem; } }

.table thead th:first-child { padding-left: 0.5rem; width: 40px; text-align: center; }
.table tbody td:first-child { padding-left: 0.5rem; font-weight: 500; width: 40px; text-align: center; }

.table tbody td {
    vertical-align: middle;
    font-size: 0.85rem;
    padding: 0.8rem 0.5rem;
    border-bottom: 1px solid #e9ecef;
    color: #2c2e3f;
    white-space: nowrap;
}
@media (min-width: 576px) { .table tbody td { font-size: 0.9rem; padding: 0.9rem 0.6rem; } }
@media (min-width: 768px) { .table tbody td { font-size: 0.95rem; padding: 1rem 0.75rem; } }
.table tbody tr:hover { background-color: #f8f9fa; }

.company-info, .property-info, .location-info { display: flex; align-items: center; gap: 0.45rem; min-width: 0; }
.company-info i, .property-info i, .location-info i { flex-shrink: 0; }

.location-text {
    display: inline-block;
    max-width: 145px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    vertical-align: bottom;
}
@media (min-width: 768px) { .location-text { max-width: 170px; } }

.badge-category {
    padding: 0.42rem 0.85rem;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.82rem;
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    background: linear-gradient(135deg, #da8cff, #9a55ff);
    color: #fff;
}

.badge-legalitas-verified { padding: 0.35rem 0.8rem; border-radius: 20px; font-weight: 600; font-size: 0.82rem; display: inline-block; background: linear-gradient(135deg, #28a745, #5cb85c); color: #fff; }
.badge-legalitas-pending { padding: 0.35rem 0.8rem; border-radius: 20px; font-weight: 600; font-size: 0.82rem; display: inline-block; background: linear-gradient(135deg, #ffc107, #ffdb6d); color: #2c2e3f; }
.badge-legalitas-rejected { padding: 0.35rem 0.8rem; border-radius: 20px; font-weight: 600; font-size: 0.82rem; display: inline-block; background: linear-gradient(135deg, #dc3545, #e4606d); color: #fff; }

.badge-development-selesai { padding: 0.35rem 0.8rem; border-radius: 20px; font-weight: 600; font-size: 0.82rem; display: inline-block; background: linear-gradient(135deg, #28a745, #5dd879); color: #fff; }
.badge-development-progress { padding: 0.35rem 0.8rem; border-radius: 20px; font-weight: 600; font-size: 0.82rem; display: inline-block; background: linear-gradient(135deg, #ffc107, #ffdb6d); color: #2c2e3f; }
.badge-development-belum { padding: 0.35rem 0.8rem; border-radius: 20px; font-weight: 600; font-size: 0.82rem; display: inline-block; background: linear-gradient(135deg, #dc3545, #e4606d); color: #fff; }

.document-trigger {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    font-weight: 700;
    color: #6f42c1;
    background: rgba(111, 66, 193, 0.08);
    padding: 0.45rem 0.85rem;
    border-radius: 20px;
    white-space: nowrap;
    cursor: pointer;
    border: none;
    transition: all 0.25s ease;
}
.document-trigger:hover { background: rgba(111, 66, 193, 0.14); transform: translateY(-1px); }
.document-trigger i { font-size: 1.1rem; }

.pagination { margin: 0; gap: 3px; }
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
.page-item .page-link:hover {
    background-color: #f8f9fa;
    border-color: #9a55ff;
    color: #9a55ff;
    transform: translateY(-1px);
}
.pagination-info { font-size: 0.8rem; color: #6c7383; }

.text-primary { color: #9a55ff !important; }
.text-info { color: #17a2b8 !important; }
.text-danger { color: #dc3545 !important; }
.text-muted { color: #a5b3cb !important; }
.text-success-custom { color: #198754 !important; }
.fw-bold { font-weight: 600 !important; }

h3.text-dark {
    font-size: 1.3rem !important;
    font-weight: 700;
    color: #2c2e3f !important;
    margin-bottom: 0.5rem !important;
}
@media (min-width: 576px) { h3.text-dark { font-size: 1.5rem !important; } }
@media (min-width: 768px) { h3.text-dark { font-size: 1.7rem !important; } }

.mdi { vertical-align: middle; }

.filter-row-desktop { display: flex; flex-direction: column; gap: 1rem; }
.filter-row-desktop .filter-text { display: flex; align-items: center; gap: 0.5rem; color: #9a55ff; font-weight: 600; font-size: 0.95rem; }
.filter-row-mobile { display: none; }

.modal-content { border: none; border-radius: 18px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.12); }
.modal-header { background: linear-gradient(135deg, #da8cff, #9a55ff); color: #fff; border-bottom: none; padding: 1rem 1.25rem; }
.modal-title { font-weight: 700; font-size: 1rem; }
.modal-header .btn-close { filter: brightness(0) invert(1); }
.modal-body { padding: 1.25rem; }


@media (max-width: 767px) {
    .filter-row-desktop { display: none; }
    .filter-row-mobile { display: block; margin-top: 1rem; }
    .location-text { max-width: 120px; }
}

.select2-container--bootstrap-5 .select2-selection {
    border: 1px solid #e9ecef !important;
    border-radius: 8px !important;
    padding: 0.5rem 0.8rem !important;
    min-height: 40px !important;
    font-family: 'Nunito', sans-serif !important;
    background-color: #ffffff !important;
}
.select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
    color: #2c2e3f !important;
    font-size: 0.9rem !important;
    line-height: 1.5 !important;
    padding-left: 0 !important;
}
.select2-container--bootstrap-5 .select2-selection--single .select2-selection__arrow {
    height: 38px !important;
    right: 10px !important;
}
.select2-container--bootstrap-5 .select2-selection--single .select2-selection__arrow b {
    border-color: #9a55ff transparent transparent transparent !important;
}
.select2-container--bootstrap-5 .select2-selection:hover { border-color: #9a55ff !important; }
.select2-container--bootstrap-5.select2-container--focus .select2-selection,
.select2-container--bootstrap-5.select2-container--open .select2-selection {
    border-color: #9a55ff !important;
    box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.1) !important;
    outline: none !important;
}
.select2-container--bootstrap-5 .select2-dropdown {
    border-color: #e9ecef !important;
    border-radius: 8px !important;
    overflow: hidden !important;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important;
}
.select2-container--bootstrap-5 .select2-results__option {
    padding: 0.6rem 0.8rem !important;
    font-size: 0.9rem !important;
    font-family: 'Nunito', sans-serif !important;
}
.select2-container--bootstrap-5 .select2-results__option--selected {
    background-color: #9a55ff !important;
    color: white !important;
}
.select2-container--bootstrap-5 .select2-results__option--highlighted {
    background: linear-gradient(135deg, #da8cff, #9a55ff) !important;
    color: white !important;
}
.select2-container--bootstrap-5 .select2-search--dropdown .select2-search__field {
    border: 1px solid #e9ecef !important;
    border-radius: 8px !important;
    padding: 0.5rem !important;
    font-family: 'Nunito', sans-serif !important;
    margin: 0.5rem !important;
    width: calc(100% - 1rem) !important;
}
.select2-container--bootstrap-5 .select2-search--dropdown .select2-search__field:focus {
    border-color: #9a55ff !important;
    box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.1) !important;
    outline: none !important;
}
.select2-limited-items .select2-results__options {
    max-height: 200px !important;
    overflow-y: auto !important;
}
.select2-limited-items .select2-results__options::-webkit-scrollbar { width: 6px; }
.select2-limited-items .select2-results__options::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 10px; }
.select2-limited-items .select2-results__options::-webkit-scrollbar-thumb { background: #9a55ff; border-radius: 10px; }
.select2-limited-items .select2-results__options::-webkit-scrollbar-thumb:hover { background: #7a3fcc; }

.action-text {
    display: inline-block;
    padding: 0.45rem 0.85rem;
    font-size: 0.8rem;
    font-weight: 600;
    border-radius: 20px;
    text-decoration: none;
    white-space: nowrap;
    transition: all 0.25s ease;
    cursor: pointer;
    border: none;
}
.action-text-verify { background: linear-gradient(135deg, #198754, #4dd48a) !important; color: white !important; }
.action-text-verify:hover { box-shadow: 0 5px 15px rgba(25, 135, 84, 0.35); color: white !important; transform: translateY(-1px); }
.action-text-verified { background: rgba(25, 135, 84, 0.1); color: #198754; }
.action-text-rejected { background: rgba(220, 53, 69, 0.1); color: #dc3545; }
.action-text-none { background: rgba(165, 179, 203, 0.1); color: #a5b3cb; }

.sort-th {
    cursor: pointer;
    transition: background-color 0.2s;
}
.sort-th:hover {
    background-color: #f8f5ff;
}
</style>

<div class="container-fluid p-2 p-sm-3 p-md-4">
    <div class="row mb-3 mb-sm-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="text-dark mb-1">
                            <i class="mdi mdi-home-city-outline me-2" style="color: #9a55ff;"></i>Semua Properti Proyek
                        </h3>
                        <p class="text-muted mb-0">Daftar seluruh properti yang terdaftar dalam sistem</p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-home-city-outline" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2">
                    <h5 class="card-title mb-0"><i class="mdi mdi-format-list-bulleted me-2"></i>Daftar Properti</h5>
                </div>

                <div class="card-body">
                    <div class="filter-card mb-4">
                        <div class="card-body">
                            <form id="filterForm" method="GET" action="{{ route('properti-all') }}">
                                <input type="hidden" name="sort_by" id="sort_by" value="{{ request('sort_by') }}">
                                <input type="hidden" name="sort_order" id="sort_order" value="{{ request('sort_order', 'asc') }}">

                                <div class="filter-row-desktop">
                                    <div class="filter-text">
                                        <i class="mdi mdi-filter-outline"></i><span>Filter data properti</span>
                                    </div>

                                    <div class="row g-2 align-items-end w-100">
                                        <div class="col-md-2">
                                            <label class="form-label">Cari</label>
                                            <input type="text" class="form-control" name="search" id="searchInput" placeholder="Nama Properti..." value="{{ request('search') }}">
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label">Perusahaan</label>
                                            <select name="company_profile_id" id="filterCompany" class="form-control select2-desktop">
                                                <option value="">Semua Perusahaan</option>
                                                @foreach ($companies as $company)
                                                    <option value="{{ $company->id }}" {{ request('company_profile_id') == $company->id ? 'selected' : '' }}>
                                                        {{ $company->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label">Kategori</label>
                                            <select name="kategori" class="form-control">
                                                <option value="">Semua Kategori</option>
                                                @foreach ($categories as $cat)
                                                    <option value="{{ $cat }}" {{ request('kategori') == $cat ? 'selected' : '' }}>
                                                        {{ $cat }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label">Legalitas</label>
                                            <select name="legalitas" class="form-control">
                                                <option value="">Semua Legalitas</option>
                                                <option value="verified" {{ request('legalitas') == 'verified' ? 'selected' : '' }}>Terverifikasi</option>
                                                <option value="pending" {{ request('legalitas') == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="rejected" {{ request('legalitas') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label">Pembangunan</label>
                                            <select name="pembangunan" class="form-control">
                                                <option value="">Semua Status</option>
                                                <option value="Selesai" {{ request('pembangunan') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                                <option value="progress" {{ request('pembangunan') == 'progress' ? 'selected' : '' }}>Progress</option>
                                                <option value="Belum" {{ request('pembangunan') == 'Belum' ? 'selected' : '' }}>Belum</option>
                                            </select>
                                        </div>

                                        <div class="col-md-1">
                                            <label class="form-label">Tampil</label>
                                            <select class="form-control" name="show" id="showSelect">
                                                <option value="10" {{ request('show') == 10 ? 'selected' : '' }}>10</option>
                                                <option value="25" {{ request('show') == 25 ? 'selected' : '' }}>25</option>
                                                <option value="50" {{ request('show') == 50 ? 'selected' : '' }}>50</option>
                                                <option value="100" {{ request('show') == 100 ? 'selected' : '' }}>100</option>
                                            </select>
                                        </div>

                                        <div class="col-md-1">
                                            <label class="form-label invisible d-none d-md-block">Aksi</label>
                                            <div class="d-flex gap-2">
                                                <button type="submit" class="btn btn-gradient-primary flex-fill" title="Filter">
                                                    <i class="mdi mdi-filter"></i>
                                                </button>
                                                <a href="{{ route('properti-all') }}" class="btn btn-gradient-secondary flex-fill btn-reset" title="Reset">
                                                    <i class="mdi mdi-refresh"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="filter-row-mobile">
                                    <div class="row g-2">
                                        <div class="col-12">
                                            <label class="form-label">Cari</label>
                                            <input type="text" class="form-control" id="searchInputMobile" placeholder="Nama Properti..." value="{{ request('search') }}">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Perusahaan</label>
                                            <select name="company_profile_id" id="filterCompanyMobile" class="form-control select2-mobile">
                                                <option value="">Semua Perusahaan</option>
                                                @foreach ($companies as $company)
                                                    <option value="{{ $company->id }}" {{ request('company_profile_id') == $company->id ? 'selected' : '' }}>
                                                        {{ $company->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">Kategori</label>
                                            <select name="kategori" class="form-control">
                                                <option value="">Semua Kategori</option>
                                                @foreach ($categories as $cat)
                                                    <option value="{{ $cat }}" {{ request('kategori') == $cat ? 'selected' : '' }}>
                                                        {{ $cat }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">Legalitas</label>
                                            <select name="legalitas" class="form-control">
                                                <option value="">Semua</option>
                                                <option value="verified" {{ request('legalitas') == 'verified' ? 'selected' : '' }}>Terverifikasi</option>
                                                <option value="pending" {{ request('legalitas') == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="rejected" {{ request('legalitas') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">Pembangunan</label>
                                            <select name="pembangunan" class="form-control">
                                                <option value="">Semua</option>
                                                <option value="Selesai" {{ request('pembangunan') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                                <option value="progress" {{ request('pembangunan') == 'progress' ? 'selected' : '' }}>Progress</option>
                                                <option value="Belum" {{ request('pembangunan') == 'Belum' ? 'selected' : '' }}>Belum</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">Tampil</label>
                                            <select class="form-control" name="show" id="showSelectMobile">
                                                <option value="10" {{ request('show') == 10 ? 'selected' : '' }}>10</option>
                                                <option value="25" {{ request('show') == 25 ? 'selected' : '' }}>25</option>
                                                <option value="50" {{ request('show') == 50 ? 'selected' : '' }}>50</option>
                                                <option value="100" {{ request('show') == 100 ? 'selected' : '' }}>100</option>
                                            </select>
                                        </div>
                                        <div class="col-6 mt-3">
                                            <button type="submit" class="btn btn-gradient-primary w-100">
                                                <i class="mdi mdi-filter me-1"></i>
                                            </button>
                                        </div>
                                        <div class="col-6 mt-3">
                                            <a href="{{ route('properti-all') }}" class="btn btn-gradient-secondary w-100 text-center text-decoration-none btn-reset">
                                                <i class="mdi mdi-refresh me-1"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                    <th class="text-center">No</th>
                                    <th class="sort-th" onclick="handleSort('company_profile_id')">Nama Properti <i class="mdi {{ sortIcon('company_profile_id') }}"></i></th>
                                    <th class="sort-th" onclick="handleSort('name')">Nama Perusahaan <i class="mdi {{ sortIcon('name') }}"></i></th>
                                    <th class="sort-th" onclick="handleSort('zoning')">Kategori <i class="mdi {{ sortIcon('zoning') }}"></i></th>
                                    <th class="d-none d-md-table-cell sort-th" onclick="handleSort('address')">Lokasi <i class="mdi {{ sortIcon('address') }}"></i></th>
                                    <th class="sort-th" onclick="handleSort('acquisition_price')">Harga Beli <i class="mdi {{ sortIcon('acquisition_price') }}"></i></th>
                                    <th class="sort-th" onclick="handleSort('legal_status')">Legalitas <i class="mdi {{ sortIcon('legal_status') }}"></i></th>
                                    <th class="sort-th" onclick="handleSort('development_status')">Pembangunan <i class="mdi {{ sortIcon('development_status') }}"></i></th>
                                    <th class="text-center">Dokumen</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($landBanks as $index => $item)
                                    <tr>
                                        <td class="text-center fw-bold">{{ $landBanks->firstItem() + $index }}</td>
                                        <td>
                                            <div class="property-info">
                                                <i class="mdi mdi-home-city text-primary" style="font-size: 1.2rem;"></i>
                                                <span class="fw-bold">{{ Str::limit($item->name, 25) }}</span>
                                            </div>
                                            <small class="text-muted d-block d-md-none mt-1"><i class="mdi mdi-map-marker me-1"></i>{{ Str::limit($item->address ?? '-', 15) }}</small>
                                        </td>
                                        <td>
                                            <div class="company-info">
                                                <i class="mdi mdi-domain text-primary" style="font-size: 1.15rem;"></i>
                                                <span class="fw-bold">{{ $item->companyProfile->name ?? '-' }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge-category"><i class="mdi mdi-shape-outline"></i>{{ $item->zoning ?? 'Tanah' }}</span>
                                        </td>
                                        <td class="d-none d-md-table-cell">
                                            <div class="location-info">
                                                <i class="mdi mdi-map-marker text-danger" style="font-size: 1.15rem;"></i>
                                                <span class="location-text" title="{{ $item->address ?? '-' }}">{{ Str::limit($item->address ?? '-', 20) }}</span>
                                            </div>
                                        </td>
                                        <td class="fw-bold text-success-custom">
                                            <i class="mdi mdi-currency-usd text-success me-1"></i>Rp {{ number_format($item->acquisition_price, 0, ',', '.') }}
                                        </td>
                                        <td>
                                            @if ($item->legal_status == 'verified')
                                                <span class="badge-legalitas-verified"><i class="mdi mdi-check-circle me-1"></i>Terverifikasi</span>
                                            @elseif ($item->legal_status == 'pending')
                                                <span class="badge-legalitas-pending"><i class="mdi mdi-clock-outline me-1"></i>Pending</span>
                                            @else
                                                <span class="badge-legalitas-rejected"><i class="mdi mdi-close-circle me-1"></i>Revisi</span>
                                            @endif
                                                                                  </td>
                                        <td>
                                            @if ($item->development_status == 'Selesai')
                                                <span class="badge-development-selesai"><i class="mdi mdi-check-circle me-1"></i>Selesai</span>
                                            @elseif ($item->development_status == 'progress')
                                                <span class="badge-development-progress"><i class="mdi mdi-progress-clock me-1"></i>Progress</span>
                                            @else
                                                <span class="badge-development-belum"><i class="mdi mdi-close-circle me-1"></i>Belum</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="document-trigger" data-bs-toggle="modal" data-bs-target="#modalDokumen{{ $item->id }}">
                                                <i class="mdi mdi-file-document-multiple-outline"></i>{{ $item->documents->count() }}
                                            </button>
                                        </td>
                                        <td class="text-center">
                                            @if ($item->documents->count() == 0)
                                                <span class="action-text action-text-verified"><i class="mdi mdi-check-circle me-1"></i>Sudah Verifikasi</span>
                                            @elseif($item->documents->contains('status', 'rejected'))
                                                <span class="action-text action-text-rejected"><i class="mdi mdi-close-circle me-1"></i>Ditolak</span>
                                            @elseif($item->documents->every(fn($d) => $d->status == 'verified'))
                                                <span class="action-text action-text-verified"><i class="mdi mdi-check-circle me-1"></i>Sudah Verifikasi</span>
                                            @else
                                                <a href="{{ route('properti.verifikasi', $item->id) }}" class="action-text action-text-verify btn-verifikasi">
                                                    <i class="mdi mdi-check-decagram me-1"></i>Verifikasi
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center text-muted py-4">
                                            <i class="mdi mdi-information-outline me-2"></i> Belum ada data properti
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($landBanks->count() > 0)
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                        <div class="pagination-info mb-2 mb-sm-0">
                            Menampilkan {{ $landBanks->firstItem() }} - {{ $landBanks->lastItem() }} dari {{ $landBanks->total() }} data
                        </div>
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                @if($landBanks->onFirstPage())
                                    <li class="page-item disabled"><span class="page-link"><i class="mdi mdi-chevron-left"></i></span></li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link prev-next-btn" href="{{ $landBanks->previousPageUrl() }}">
                                            <i class="mdi mdi-chevron-left"></i>
                                        </a>
                                    </li>
                                @endif

                                @foreach ($landBanks->getUrlRange(1, $landBanks->lastPage()) as $page => $url)
                                    <li class="page-item {{ $landBanks->currentPage() == $page ? 'active' : '' }}">
                                        <a class="page-link {{ $landBanks->currentPage() == $page ? '' : 'page-click' }}" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach

                                @if($landBanks->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link prev-next-btn" href="{{ $landBanks->nextPageUrl() }}">
                                            <i class="mdi mdi-chevron-right"></i>
                                        </a>
                                    </li>
                                @else
                                    <li class="page-item disabled"><span class="page-link"><i class="mdi mdi-chevron-right"></i></span></li>
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

@foreach ($landBanks as $item)
<div class="modal fade" id="modalDokumen{{ $item->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="mdi mdi-file-document-multiple-outline me-2"></i>Detail Dokumen Properti</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- DAFTAR DOKUMEN -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-light fw-bold">
                        <i class="mdi mdi-file-document-outline me-2 text-primary"></i>
                        Daftar Dokumen
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive" style="max-height: unset;">
                            @if ($item->documents->count() > 0)
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th width="5%" class="text-center">No</th>
                                        <th width="25%">Nomor Dokumen</th>
                                        <th>Nama Dokumen</th>
                                        <th width="15%" class="text-center">Status</th>
                                        <th width="12%" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($item->documents as $idx => $doc)
                                    <tr>
                                        <td class="text-center">{{ $idx + 1 }}</td>
                                        <td class="fw-bold">{{ $doc->document_number ?? '-' }}</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <i class="mdi mdi-file-{{ $doc->type == 'sertifikat' ? 'certificate' : 'document' }}-outline text-primary" style="font-size: 1.2rem;"></i>
                                                <span>{{ $doc->documentType->name ?? '-' }}</span>
                                            </div>
                                            @if ($doc->status === 'rejected' && !empty($doc->catatan_admin))
                                                <div class="text-danger small mt-1">
                                                    <i class="mdi mdi-alert-circle me-1"></i>Alasan: {{ $doc->catatan_admin }}
                                                </div>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($doc->status == 'pending')
                                                <span class="badge rounded-pill bg-warning text-dark px-3 py-2"><i class="mdi mdi-clock-outline me-1"></i>Pending</span>
                                            @elseif($doc->status == 'rejected')
                                                <span class="badge rounded-pill bg-danger px-3 py-2"><i class="mdi mdi-close-circle me-1"></i>Ditolak</span>
                                            @elseif($doc->status == 'verified')
                                                <span class="badge rounded-pill bg-success px-3 py-2"><i class="mdi mdi-check-circle me-1"></i>Terverifikasi</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" class="btn-outline-purple px-3 py-1" title="Lihat">
                                                <i class="mdi mdi-eye m-0"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <div class="text-center text-muted py-5">
                                <i class="mdi mdi-file-document-outline" style="font-size: 3rem; opacity: 0.3;"></i>
                                <p class="mt-2 mb-0">Tidak ada dokumen.</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                    <i class="mdi mdi-close me-1"></i>Tutup
                </button>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection

@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
function showLoading(message = 'Memproses data...') {
    Swal.fire({
        title: message,
        text: 'Mohon tunggu sebentar',
        allowOutsideClick: false,
        allowEscapeKey: false,
        showConfirmButton: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
}

function handleSort(column) {
    let currentSort = $('#sort_by').val();
    let currentOrder = $('#sort_order').val();
    let newOrder = 'asc';

    if (currentSort === column) {
        newOrder = currentOrder === 'asc' ? 'desc' : 'asc';
    }

    $('#sort_by').val(column);
    $('#sort_order').val(newOrder);
    
    showLoading('Mengurutkan data...');
    $('#filterForm').submit();
}

$(document).ready(function () {
    // Handle pagination clicks
    $('.page-click, .prev-next-btn').on('click', function(e) {
        e.preventDefault();
        let url = $(this).attr('href');
        if (url) {
            showLoading('Memindahkan halaman...');
            window.location.href = url;
        }
    });

    // Handle reset button
    $('.btn-reset').on('click', function(e) {
        e.preventDefault();
        showLoading('Mereset data...');
        window.location.href = $(this).attr('href');
    });

    // Handle show per page changes
    $('#showSelect, #showSelectMobile').on('change', function() {
        showLoading('Mengubah jumlah data...');
        $('#filterForm').submit();
    });

    // Handle form submission for filter and search
    $('#filterForm').on('submit', function(e) {
        // Get search values from both inputs
        let searchDesktop = $('#searchInput').val();
        let searchMobile = $('#searchInputMobile').val();
        
        // Use the non-empty search value
        let searchValue = searchDesktop || searchMobile;
        
        // Set the search input value to the combined value
        if (searchValue) {
            $('#searchInput').val(searchValue);
            $('#searchInputMobile').val(searchValue);
        } else {
            // If empty, remove the search parameter
            $('#searchInput').val('');
            $('#searchInputMobile').val('');
        }
        
        // Show loading based on action
        let searchTerm = searchValue ? searchValue.trim() : '';
        if (searchTerm !== '') {
            showLoading('Mencari data...');
        } else {
            showLoading('Menyaring data...');
        }
        
        // Let the form submit normally
        return true;
    });

    // Sync search inputs between desktop and mobile
    $('#searchInput').on('input', function() {
        $('#searchInputMobile').val($(this).val());
    });
    
    $('#searchInputMobile').on('input', function() {
        $('#searchInput').val($(this).val());
    });

    // Initialize Select2 for desktop
    $('#filterCompany').select2({
        theme: 'bootstrap-5',
        width: '100%',
        placeholder: 'Semua Perusahaan',
        allowClear: true,
        minimumResultsForSearch: 0,
        dropdownCssClass: 'select2-limited-items',
        language: {
            noResults: function() { return "Perusahaan tidak ditemukan"; },
            searching: function() { return "Mencari..."; }
        }
    });

    // Initialize Select2 for mobile
    $('#filterCompanyMobile').select2({
        theme: 'bootstrap-5',
        width: '100%',
        placeholder: 'Semua Perusahaan',
        allowClear: true,
        minimumResultsForSearch: 0,
        dropdownCssClass: 'select2-limited-items',
        dropdownParent: $('#filterCompanyMobile').parent(),
        language: {
            noResults: function() { return "Perusahaan tidak ditemukan"; },
            searching: function() { return "Mencari..."; }
        }
    });

    // Sync Select2 between desktop and mobile
    $('#filterCompany').on('change', function() {
        $('#filterCompanyMobile').val($(this).val()).trigger('change');
    });
    
    $('#filterCompanyMobile').on('change', function() {
        $('#filterCompany').val($(this).val()).trigger('change');
    });

    // Handle verification button
    $('.btn-verifikasi').on('click', function(e) {
        e.preventDefault();
        let link = $(this).attr('href');

        Swal.fire({
            title: 'Verifikasi Properti?',
            text: "Properti akan ditandai sebagai sudah diverifikasi.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#198754',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Verifikasi',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                showLoading('Memverifikasi properti...');
                window.location.href = link;
            }
        });
    });
});
</script>
@endpush