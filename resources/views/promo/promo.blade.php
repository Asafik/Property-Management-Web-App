@extends('layouts.partial.app')

@section('title', 'Manajemen Promo - Property Management App')

@section('content')

<style>
/* ====== CSS ====== */
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
.card-title { font-size: 0.9rem; font-weight: 600; color: #9a55ff; margin-bottom: 0; }
@media (min-width: 576px) { .card-title { font-size: 1rem; } }
@media (min-width: 768px) { .card-title { font-size: 1.1rem; } }

/* Filter Card */
.filter-card {
    background: linear-gradient(135deg, #f9f7ff, #f2ecff);
    border-radius: 12px; padding: 1rem; margin-bottom: 1.25rem; border: none;
}
.filter-card .form-label {
    font-size: 0.85rem; font-weight: 600; color: #9a55ff !important;
    margin-bottom: 0.4rem; letter-spacing: 0.3px;
}
.filter-card .form-control,
.filter-card .form-select {
    padding: 0.5rem 0.75rem; font-size: 0.9rem;
    border-radius: 8px; height: auto; min-height: 40px; border: 1px solid #e0e4e9;
}

/* Form Controls */
.form-control, .form-select {
    border: 1px solid #e9ecef; border-radius: 8px; padding: 0.6rem 0.8rem;
    font-size: 0.9rem; transition: all 0.2s ease; background-color: #ffffff;
    color: #2c2e3f; height: auto;
}
@media (min-width: 576px) { .form-control, .form-select { padding: 0.7rem 1rem; font-size: 0.95rem; border-radius: 10px; } }
.form-control:focus, .form-select:focus {
    border-color: #9a55ff; box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.1); outline: none;
}
.form-label {
    font-size: 0.85rem; font-weight: 600; color: #9a55ff !important;
    margin-bottom: 0.3rem; letter-spacing: 0.3px; font-family: 'Nunito', sans-serif;
}

/* Input Group */
.input-group-text {
    background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
    border: 1px solid #e9ecef;
    border-radius: 8px 0 0 8px;
    color: #6c7383;
    font-weight: 500;
}
.input-group .form-control {
    border-radius: 0 8px 8px 0;
    border-left: none;
}
.input-group .form-control:focus {
    border-left: none;
}

/* Buttons */
.btn {
    font-size: 0.85rem; padding: 0.6rem 1rem; border-radius: 8px;
    font-weight: 600; transition: all 0.3s ease; font-family: 'Nunito', sans-serif; border: none;
}
@media (min-width: 576px) { .btn { font-size: 0.9rem; padding: 0.7rem 1.2rem; border-radius: 10px; } }
.btn:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
.btn-sm { padding: 0.35rem 0.7rem; font-size: 0.8rem; border-radius: 6px; }
.btn-gradient-primary   { background: linear-gradient(to right, #da8cff, #9a55ff) !important; color: #ffffff !important; }
.btn-gradient-secondary { background: #6c757d !important; color: #ffffff !important; }
.btn-gradient-secondary:hover { background: #5a6268 !important; }

/* Action Buttons */
.btn-action {
    width: 36px;
    height: 36px;
    padding: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    margin: 0 3px;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}
.btn-action i {
    font-size: 1.1rem;
}
.btn-action.edit {
    background: linear-gradient(135deg, #ffc107, #ffdb6d);
    color: #2c2e3f;
}
.btn-action.edit:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(255, 193, 7, 0.4);
}
.btn-action.delete {
    background: linear-gradient(135deg, #dc3545, #e4606d);
    color: white;
}
.btn-action.delete:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(220, 53, 69, 0.4);
}

.btn-icon-only {
    width: 40px; height: 40px; padding: 0;
    display: flex; align-items: center; justify-content: center; border-radius: 8px;
}
.btn-icon-only i { font-size: 1.2rem; margin: 0; }
.btn-icon-only-mobile {
    width: 100%; height: 40px; padding: 0;
    display: flex; align-items: center; justify-content: center; border-radius: 8px;
}
.btn-icon-only-mobile i { font-size: 1.2rem; margin: 0; }

/* Table Responsive dengan Scrollbar */
.table-responsive {
    overflow-x: auto;
    overflow-y: auto;
    -webkit-overflow-scrolling: touch;
    border-radius: 8px;
    margin-bottom: 0.5rem;
    max-height: 500px;
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

.table { width: 100%; border-collapse: collapse; margin-bottom: 0; }
.table thead th {
    background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
    color: #9a55ff; font-weight: 600; font-size: 0.8rem;
    text-transform: uppercase; letter-spacing: 0.5px;
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
.table thead th.active-sort {
    color: #7a3fcc;
}
.table thead th.active-sort i {
    opacity: 1;
    color: #7a3fcc;
}
@media (min-width: 576px) { .table thead th { font-size: 0.85rem; padding: 0.9rem 0.6rem; } }
@media (min-width: 768px) { .table thead th { font-size: 0.9rem; padding: 1rem 0.75rem; } }
.table thead th:first-child { padding-left: 0.5rem; width: 40px; text-align: center; cursor: default; }
.table thead th:first-child:hover { color: #9a55ff; }
.table tbody td:first-child { padding-left: 0.5rem; font-weight: 500; width: 40px; text-align: center; }
.table tbody td {
    vertical-align: middle; font-size: 0.85rem; padding: 0.8rem 0.5rem;
    border-bottom: 1px solid #e9ecef; color: #2c2e3f;
    white-space: nowrap;
}
@media (min-width: 576px) { .table tbody td { font-size: 0.9rem; padding: 0.9rem 0.6rem; } }
@media (min-width: 768px) { .table tbody td { font-size: 0.95rem; padding: 1rem 0.75rem; } }
.table tbody tr:hover { background-color: #f8f9fa; }

/* Status badge */
.status-badge {
    padding: 0.3rem 0.8rem;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.85rem;
    display: inline-block;
}
.status-badge.aktif {
    background: linear-gradient(135deg, #28a745, #5cb85c);
    color: #fff;
}
.status-badge.tidak_aktif {
    background: linear-gradient(135deg, #dc3545, #e4606d);
    color: #fff;
}
.status-badge i {
    margin-right: 4px;
    font-size: 0.9rem;
}

/* Kategori Badge */
.kategori-badge {
    padding: 0.3rem 0.8rem;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.85rem;
    display: inline-block;
}
.kategori-badge.promo {
    background: rgba(40, 167, 69, 0.1);
    border: 1px solid rgba(40, 167, 69, 0.3);
    color: #28a745;
}
.kategori-badge.biaya {
    background: rgba(220, 53, 69, 0.1);
    border: 1px solid rgba(220, 53, 69, 0.3);
    color: #dc3545;
}
.kategori-badge.fasilitas {
    background: rgba(23, 162, 184, 0.1);
    border: 1px solid rgba(23, 162, 184, 0.3);
    color: #17a2b8;
}
.kategori-badge i {
    margin-right: 4px;
    font-size: 0.9rem;
}

/* Tipe Badge */
.tipe-badge {
    padding: 0.2rem 0.6rem;
    border-radius: 12px;
    font-weight: 500;
    font-size: 0.75rem;
    display: inline-block;
}
.tipe-badge.persen {
    background: rgba(154, 85, 255, 0.1);
    border: 1px solid rgba(154, 85, 255, 0.3);
    color: #9a55ff;
}
.tipe-badge.nominal {
    background: rgba(255, 193, 7, 0.1);
    border: 1px solid rgba(255, 193, 7, 0.3);
    color: #ffc107;
}

/* Berlaku Badge */
.berlaku-badge {
    padding: 0.2rem 0.6rem;
    border-radius: 12px;
    font-weight: 500;
    font-size: 0.75rem;
    display: inline-block;
}
.berlaku-badge.selalu {
    background: rgba(40, 167, 69, 0.1);
    border: 1px solid rgba(40, 167, 69, 0.3);
    color: #28a745;
}
.berlaku-badge.periode {
    background: rgba(255, 193, 7, 0.1);
    border: 1px solid rgba(255, 193, 7, 0.3);
    color: #ffc107;
}

/* Empty State */
.empty-state {
    padding: 3rem 1rem;
    text-align: center;
    color: #a5b3cb;
}
.empty-state i {
    font-size: 4rem;
    margin-bottom: 1rem;
    opacity: 0.3;
}
.empty-state p {
    font-size: 1rem;
    margin-bottom: 0.5rem;
}
.empty-state small {
    font-size: 0.85rem;
}

/* Pagination */
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
    cursor: pointer;
    text-decoration: none;
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

/* Modal */
.modal-content {
    border: none;
    border-radius: 16px;
}
.modal-header {
    background: linear-gradient(135deg, #da8cff, #9a55ff);
    color: white;
    border-radius: 16px 16px 0 0;
    padding: 1rem 1.5rem;
}
.modal-header .btn-close {
    filter: brightness(0) invert(1);
}
.modal-title {
    font-weight: 600;
    font-size: 1.1rem;
}
.modal-body {
    padding: 1.5rem;
}
.modal-footer {
    border-top: 1px solid #e9ecef;
    padding: 1rem 1.5rem;
}

/* Modal Medium - Lebih kecil */
.modal-dialog.modal-medium {
    max-width: 500px;
    margin: 1.75rem auto;
}

/* Text colors */
.text-primary  { color: #9a55ff !important; }
.text-info     { color: #17a2b8 !important; }
.text-danger   { color: #dc3545 !important; }
.text-success  { color: #28a745 !important; }
.text-warning  { color: #ffc107 !important; }
.fw-bold       { font-weight: 600 !important; }
.text-muted    { color: #a5b3cb !important; }

h3.text-dark { font-size: 1.3rem !important; font-weight: 700; color: #2c2e3f !important; margin-bottom: 0.5rem !important; }
@media (min-width: 576px) { h3.text-dark { font-size: 1.5rem !important; } }
@media (min-width: 768px) { h3.text-dark { font-size: 1.7rem !important; } }

.mdi { vertical-align: middle; }

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
.filter-row-mobile  { display: none; }
@media (max-width: 767px) {
    .filter-row-desktop { display: none; }
    .filter-row-mobile  { display: block; margin-top: 1rem; }
}
</style>

<div class="container-fluid p-2 p-sm-3 p-md-4">

    <!-- Header -->
    <div class="row mb-3 mb-sm-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="text-dark mb-1">
                            <i class="mdi mdi-tag-multiple me-2" style="color: #9a55ff;"></i>Manajemen Promo
                        </h3>
                        <p class="text-muted mb-0">
                            Kelola promo, diskon, biaya tambahan, dan fasilitas
                        </p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-tag-multiple" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Data Promo -->
    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-filter-outline me-2"></i>Daftar Promo
                    </h5>
                    <button class="btn btn-gradient-primary" style="padding: 0.6rem 1.2rem; font-size: 0.9rem;" onclick="openModal('tambah')">
                        <i class="mdi mdi-plus me-1"></i>Tambah Promo
                    </button>
                </div>

                <div class="card-body">
                    <!-- FILTER SECTION -->
                    <div class="filter-card mb-4">
                        <div class="card-body">

                            <!-- DESKTOP VERSION -->
                            <div class="filter-row-desktop">
                                <div class="filter-text">
                                    <i class="mdi mdi-filter-outline"></i>
                                    <span>Filter data promo</span>
                                </div>
                                <form id="filterForm" method="GET" action="{{ route('promo.index') }}">
                                    <div class="row g-2 align-items-end w-100">

                                        <!-- Search -->
                                        <div class="col-md-3">
                                            <label class="form-label">Cari</label>
                                            <input type="text" class="form-control" name="search" id="searchInput" placeholder="Nama promo..." value="{{ request('search') }}">
                                        </div>

                                        <!-- Kategori Filter -->
                                        <div class="col-md-2">
                                            <label class="form-label">Kategori</label>
                                            <select class="form-control" name="category" id="kategoriSelect">
                                                <option value="">Semua</option>
                                                <option value="promo" {{ request('category') == 'promo' ? 'selected' : '' }}>Promo</option>
                                                <option value="biaya" {{ request('category') == 'biaya' ? 'selected' : '' }}>Biaya Tambahan</option>
                                                <option value="fasilitas" {{ request('category') == 'fasilitas' ? 'selected' : '' }}>Fasilitas</option>
                                            </select>
                                        </div>

                                        <!-- Type Filter -->
                                        <div class="col-md-2">
                                            <label class="form-label">Tipe</label>
                                            <select class="form-control" name="type" id="typeSelect">
                                                <option value="">Semua</option>
                                                <option value="persen" {{ request('type') == 'persen' ? 'selected' : '' }}>Persentase</option>
                                                <option value="nominal" {{ request('type') == 'nominal' ? 'selected' : '' }}>Nominal</option>
                                            </select>
                                        </div>

                                        <!-- Status -->
                                        <div class="col-md-2">
                                            <label class="form-label">Status</label>
                                            <select class="form-control" name="status" id="statusSelect">
                                                <option value="">Semua</option>
                                                <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                                <option value="tidak_aktif" {{ request('status') == 'tidak_aktif' ? 'selected' : '' }}>Nonaktif</option>
                                            </select>
                                        </div>

                                        <!-- Tampil -->
                                        <div class="col-md-1">
                                            <label class="form-label">Tampil</label>
                                            <select class="form-control" name="per_page" id="perPageSelect">
                                                <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                                <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
                                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                            </select>
                                        </div>

                                        <!-- Tombol Filter + Reset -->
                                        <div class="col-md-2">
                                            <label class="form-label invisible d-none d-md-block">Aksi</label>
                                            <div class="d-flex gap-2">
                                                <button type="submit" class="btn btn-gradient-primary btn-icon-only flex-fill" id="filterBtn" title="Filter" onclick="showFilterLoading()">
                                                    <i class="mdi mdi-filter"></i>
                                                </button>
                                                <a href="{{ route('promo.index') }}" class="btn btn-gradient-secondary btn-icon-only flex-fill" title="Reset" onclick="showResetLoading(event)">
                                                    <i class="mdi mdi-refresh"></i>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>

                            <!-- MOBILE VERSION -->
                            <div class="filter-row-mobile">
                                <div class="filter-text mb-2">
                                    <i class="mdi mdi-filter-outline"></i>
                                    <span>Filter data promo</span>
                                </div>
                                <form method="GET" action="{{ route('promo.index') }}">
                                    <div class="row g-2">
                                        <div class="col-12 mb-2">
                                            <label class="form-label">Cari</label>
                                            <input type="text" class="form-control" name="search" id="searchInputMobile" placeholder="Nama promo..." value="{{ request('search') }}">
                                        </div>
                                        <div class="col-12 mb-2">
                                            <label class="form-label">Kategori</label>
                                            <select class="form-control" name="category" id="kategoriSelectMobile">
                                                <option value="">Semua</option>
                                                <option value="promo" {{ request('category') == 'promo' ? 'selected' : '' }}>Promo</option>
                                                <option value="biaya" {{ request('category') == 'biaya' ? 'selected' : '' }}>Biaya Tambahan</option>
                                                <option value="fasilitas" {{ request('category') == 'fasilitas' ? 'selected' : '' }}>Fasilitas</option>
                                            </select>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <label class="form-label">Tipe</label>
                                            <select class="form-control" name="type" id="typeSelectMobile">
                                                <option value="">Semua</option>
                                                <option value="persen" {{ request('type') == 'persen' ? 'selected' : '' }}>Persentase</option>
                                                <option value="nominal" {{ request('type') == 'nominal' ? 'selected' : '' }}>Nominal</option>
                                            </select>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <label class="form-label">Status</label>
                                            <select class="form-control" name="status" id="statusSelectMobile">
                                                <option value="">Semua</option>
                                                <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                                <option value="tidak_aktif" {{ request('status') == 'tidak_aktif' ? 'selected' : '' }}>Nonaktif</option>
                                            </select>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <label class="form-label">Tampil</label>
                                            <select class="form-control" name="per_page" id="perPageSelectMobile">
                                                <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                                <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
                                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <button type="submit" class="btn btn-gradient-primary btn-icon-only-mobile w-100" id="filterBtnMobile" title="Filter" onclick="showFilterLoading()">
                                                <i class="mdi mdi-filter"></i> Filter
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <a href="{{ route('promo.index') }}" class="btn btn-gradient-secondary btn-icon-only-mobile w-100" title="Reset" onclick="showResetLoading(event)">
                                                <i class="mdi mdi-refresh"></i> Reset
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>

                    <!-- TABEL DATA PROMO -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="sortable" data-field="name" data-direction="{{ request('sortField') == 'name' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Nama Promo
                                        @if(request('sortField') == 'name')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable" data-field="category" data-direction="{{ request('sortField') == 'category' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Kategori
                                        @if(request('sortField') == 'category')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable" data-field="type" data-direction="{{ request('sortField') == 'type' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Tipe
                                        @if(request('sortField') == 'type')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable" data-field="value" data-direction="{{ request('sortField') == 'value' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Nilai
                                        @if(request('sortField') == 'value')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable" data-field="validity_period" data-direction="{{ request('sortField') == 'validity_period' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Berlaku
                                        @if(request('sortField') == 'validity_period')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable" data-field="start_date" data-direction="{{ request('sortField') == 'start_date' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Periode
                                        @if(request('sortField') == 'start_date')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable" data-field="status" data-direction="{{ request('sortField') == 'status' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Status
                                        @if(request('sortField') == 'status')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($promo as $index => $item)
                                <tr>
                                    <td class="text-center fw-bold">{{ $promo->firstItem() + $index }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-tag text-primary me-2" style="font-size: 1.2rem;"></i>
                                            <span class="fw-bold">{{ $item->name }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        @if($item->category == 'promo')
                                            <span class="kategori-badge promo">
                                                <i class="mdi mdi-sale"></i> Promo
                                            </span>
                                        @elseif($item->category == 'biaya')
                                            <span class="kategori-badge biaya">
                                                <i class="mdi mdi-cash-plus"></i> Biaya Tambahan
                                            </span>
                                        @else
                                            <span class="kategori-badge fasilitas">
                                                <i class="mdi mdi-home"></i> Fasilitas
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->type == 'persen')
                                            <span class="tipe-badge persen">
                                                <i class="mdi mdi-percent"></i> Persentase
                                            </span>
                                        @else
                                            <span class="tipe-badge nominal">
                                                <i class="mdi mdi-currency-usd"></i> Nominal
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->type == 'persen')
                                            <span class="fw-bold text-success">{{ $item->value }}%</span>
                                        @else
                                            <span class="fw-bold text-danger">Rp {{ number_format($item->value, 0, ',', '.') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->validity_period == 'selalu')
                                            <span class="berlaku-badge selalu">
                                                <i class="mdi mdi-check"></i> Selalu
                                            </span>
                                        @else
                                            <span class="berlaku-badge periode">
                                                <i class="mdi mdi-calendar"></i> Periode
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->validity_period == 'periode')
                                            <small class="text-muted">
                                                {{ Carbon\Carbon::parse($item->start_date)->format('d/m/Y') }} - {{ Carbon\Carbon::parse($item->end_date)->format('d/m/Y') }}
                                            </small>
                                        @else
                                            <small class="text-muted">-</small>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->status == 'aktif')
                                            <span class="status-badge aktif">
                                                <i class="mdi mdi-check-circle"></i> Aktif
                                            </span>
                                        @else
                                            <span class="status-badge tidak_aktif">
                                                <i class="mdi mdi-close-circle"></i> Nonaktif
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <button class="btn-action edit me-1" title="Edit" onclick="openModal('edit', {{ $item->id }})">
                                            <i class="mdi mdi-pencil"></i>
                                        </button>
                                        <button class="btn-action delete" title="Hapus" onclick="confirmDelete({{ $item->id }})">
                                            <i class="mdi mdi-delete"></i>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center">
                                        <div class="empty-state">
                                            <i class="mdi mdi-tag-remove"></i>
                                            <p>Belum ada data promo</p>
                                            <small>Klik tombol "Tambah Promo" untuk menambahkan data</small>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- PAGINATION -->
                    @if ($promo instanceof \Illuminate\Pagination\LengthAwarePaginator && $promo->total() > 0)
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                        <div class="pagination-info mb-2 mb-sm-0">
                            Menampilkan {{ $promo->firstItem() }} - {{ $promo->lastItem() }} dari {{ $promo->total() }} data
                        </div>
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                {{-- Previous Page Link --}}
                                @if ($promo->onFirstPage())
                                    <li class="page-item disabled" aria-disabled="true">
                                        <span class="page-link" aria-label="Previous">
                                            <i class="mdi mdi-chevron-left"></i>
                                        </span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $promo->appends(request()->query())->previousPageUrl() }}" rel="prev" aria-label="Previous" onclick="showPaginationLoading(event)">
                                            <i class="mdi mdi-chevron-left"></i>
                                        </a>
                                    </li>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach ($promo->getUrlRange(max(1, $promo->currentPage() - 2), min($promo->lastPage(), $promo->currentPage() + 2)) as $page => $url)
                                    @if ($page == $promo->currentPage())
                                        <li class="page-item active" aria-current="page">
                                            <span class="page-link">{{ $page }}</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $promo->appends(request()->query())->url($page) }}" onclick="showPaginationLoading(event)">{{ $page }}</a>
                                        </li>
                                    @endif
                                @endforeach

                                {{-- Next Page Link --}}
                                @if ($promo->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $promo->appends(request()->query())->nextPageUrl() }}" rel="next" aria-label="Next" onclick="showPaginationLoading(event)">
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

<!-- MODAL TAMBAH/EDIT PROMO -->
<div class="modal fade" id="modalPromo" tabindex="-1" aria-labelledby="modalPromoLabel" aria-hidden="true">
    <div class="modal-dialog modal-medium modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPromoLabel">
                    <i class="mdi mdi-plus-circle me-2" id="modalIcon"></i>
                    <span id="modalTitle">Tambah Promo</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formPromo" method="POST" action="{{ route('promo.store') }}">
                @csrf
                <input type="hidden" name="_method" id="methodField" value="POST">
                <input type="hidden" id="promoId" name="id">
                <div class="modal-body">
                    <!-- Nama Promo -->
                    <div class="mb-3">
                        <label class="form-label">Nama Promo <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" id="namaPromo" placeholder="Contoh: Diskon Early Bird" value="{{ old('name') }}" required>
                    </div>

                    <!-- Kategori -->
                    <div class="mb-3">
                        <label class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select class="form-control" name="category" id="kategori" onchange="ubahKategori()" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="promo">Promo</option>
                            <option value="biaya">Biaya Tambahan</option>
                            <option value="fasilitas">Fasilitas</option>
                        </select>
                    </div>

                    <!-- Tipe dan Nilai -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tipe <span class="text-danger">*</span></label>
                            <select class="form-control" name="type" id="tipe" onchange="ubahTipe()" required>
                                <option value="">-- Pilih Tipe --</option>
                                <option value="persen">Persentase (%)</option>
                                <option value="nominal">Nominal (Rp)</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" id="labelNilai">Nilai <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text" id="iconNilai">#</span>
                                <input type="text" class="form-control" name="value" id="nilai" placeholder="0" value="{{ old('value') }}" required>
                            </div>
                        </div>
                    </div>

                    <!-- Berlaku -->
                    <div class="mb-3">
                        <label class="form-label">Berlaku <span class="text-danger">*</span></label>
                        <select class="form-control" name="validity_period" id="berlaku" onchange="ubahBerlaku()" required>
                            <option value="">-- Pilih --</option>
                            <option value="selalu">Selalu</option>
                            <option value="periode">Periode Tertentu</option>
                        </select>
                    </div>

                    <!-- Periode (muncul jika pilih periode) -->
                    <div class="row" id="periodeContainer" style="display: none;">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="start_date" id="tanggalMulai" value="{{ old('start_date') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Berakhir <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="end_date" id="tanggalBerakhir" value="{{ old('end_date') }}">
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="aktif">Aktif</option>
                            <option value="tidak_aktif">Nonaktif</option>
                        </select>
                    </div>

                    <!-- Keterangan (Description) -->
                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea class="form-control" name="description" id="keterangan" rows="2" placeholder="Deskripsi promo...">{{ old('description') }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">
                        <i class="mdi mdi-close me-1"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-gradient-primary" id="submitBtn" onclick="showSubmitLoading()">
                        <i class="mdi mdi-content-save me-1" id="btnIcon"></i>
                        <span id="btnText">Simpan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    // Sorting functionality
    $('.sortable').click(function() {
        let field = $(this).data('field');
        let direction = $(this).data('direction');

        // Tampilkan loading
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

    // Notifikasi sukses dari session
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'OK',
            confirmButtonColor: '#9a55ff',
            timerProgressBar: true,
            didOpen: () => {
                const timer = Swal.getPopup().querySelector("b");
                if (timer) {
                    timer.style.width = "100%";
                }
            }
        });
    @endif

    // Notifikasi error dari session
    @if (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}',
            confirmButtonColor: '#dc3545'
        });
    @endif
});

// Fungsi loading untuk filter
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

// Fungsi loading untuk reset
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

// Fungsi loading untuk pagination
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

// Fungsi loading untuk submit form
function showSubmitLoading() {
    Swal.fire({
        title: 'Mohon tunggu...',
        html: 'Sedang menyimpan data',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    return true;
}

// Fungsi ubah kategori
function ubahKategori() {
    // Kosongkan
}

// Fungsi ubah tipe
function ubahTipe() {
    let tipe = document.getElementById('tipe').value;
    let iconNilai = document.getElementById('iconNilai');
    let labelNilai = document.getElementById('labelNilai');

    if (tipe === 'persen') {
        iconNilai.innerHTML = '%';
        labelNilai.innerHTML = 'Nilai <span class="text-danger">*</span>';
    } else if (tipe === 'nominal') {
        iconNilai.innerHTML = 'Rp';
        labelNilai.innerHTML = 'Nilai <span class="text-danger">*</span>';
    } else {
        iconNilai.innerHTML = '#';
    }
}

// Fungsi ubah berlaku
function ubahBerlaku() {
    let berlaku = document.getElementById('berlaku').value;
    let periodeContainer = document.getElementById('periodeContainer');

    if (berlaku === 'periode') {
        periodeContainer.style.display = 'flex';
        document.getElementById('tanggalMulai').required = true;
        document.getElementById('tanggalBerakhir').required = true;
    } else {
        periodeContainer.style.display = 'none';
        document.getElementById('tanggalMulai').required = false;
        document.getElementById('tanggalBerakhir').required = false;
    }
}

// Buka Modal untuk Tambah atau Edit
function openModal(type, id = null) {
    if (type === 'tambah') {
        // Reset form
        $('#formPromo')[0].reset();
        $('#promoId').val('');
        $('#methodField').val('POST');
        $('#formPromo').attr('action', '{{ route("promo.store") }}');

        // Reset UI
        document.getElementById('periodeContainer').style.display = 'none';
        document.getElementById('iconNilai').innerHTML = '#';

        // Ubah title dan icon
        $('#modalTitle').text('Tambah Promo');
        $('#modalIcon').removeClass('mdi-pencil-circle').addClass('mdi-plus-circle');
        $('#btnText').text('Simpan');
        $('#btnIcon').removeClass('mdi-pencil').addClass('mdi-content-save');

        $('#modalPromo').modal('show');
    } else {
        // Tampilkan loading saat mengambil data
        Swal.fire({
            title: 'Mohon tunggu...',
            html: 'Sedang mengambil data promo',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // Ambil data promo via AJAX
        $.get('{{ url("master-data-promo/get") }}/' + id, function(response) {
            Swal.close(); // Tutup loading

            if (response.success) {
                let data = response.data;

                $('#promoId').val(data.id);
                $('#namaPromo').val(data.name);
                $('#kategori').val(data.category);
                $('#tipe').val(data.type);

                if (data.type === 'nominal') {
                    $('#nilai').val(new Intl.NumberFormat('id-ID').format(data.value));
                } else {
                    $('#nilai').val(data.value);
                }

                $('#berlaku').val(data.validity_period);

                if (data.validity_period === 'periode') {
                    $('#tanggalMulai').val(data.start_date);
                    $('#tanggalBerakhir').val(data.end_date);
                }

                $('#status').val(data.status);
                $('#keterangan').val(data.description);

                // Update UI
                ubahTipe();
                ubahBerlaku();

                // Ubah title dan icon
                $('#modalTitle').text('Edit Promo');
                $('#modalIcon').removeClass('mdi-plus-circle').addClass('mdi-pencil-circle');
                $('#btnText').text('Update');
                $('#btnIcon').removeClass('mdi-content-save').addClass('mdi-pencil');

                // Ubah action form untuk update
                $('#methodField').val('PUT');
                $('#formPromo').attr('action', '{{ url("master-data-promo") }}/' + id);

                $('#modalPromo').modal('show');
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: response.message || 'Gagal mengambil data promo',
                    confirmButtonColor: '#dc3545'
                });
            }
        }).fail(function() {
            Swal.close();
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Gagal mengambil data promo',
                confirmButtonColor: '#dc3545'
            });
        });
    }
}

// Fungsi Konfirmasi Hapus dengan Loading
function confirmDelete(id) {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Tampilkan loading sebelum submit
            Swal.fire({
                title: 'Menghapus...',
                html: 'Sedang menghapus data promo',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Buat form delete dan submit setelah loading ditampilkan
            setTimeout(() => {
                let form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ url("master-data-promo") }}/' + id;

                let csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}';

                let methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';

                form.appendChild(csrfInput);
                form.appendChild(methodInput);

                document.body.appendChild(form);
                form.submit();
            }, 100);
        }
    });
}
</script>
@endpush
