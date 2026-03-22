@extends('layouts.partial.app')

@section('title', 'Master Dokumen Pasca landBank - Property Management App')

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
    overflow-y: visible;
    -webkit-overflow-scrolling: touch;
    border-radius: 8px;
    margin-bottom: 0.5rem;
    scrollbar-width: thin;
    scrollbar-color: #9a55ff #f0f0f0;
}
.table-responsive::-webkit-scrollbar {
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

/* Status badge / Bagde */
.badge {
    padding: 0.35rem 0.6rem;
    font-size: 0.75rem;
    font-weight: 600;
    border-radius: 30px;
    display: inline-block;
    white-space: nowrap;
}
.badge i {
    font-size: 0.8rem;
    margin-right: 4px;
}
.badge-gradient-success {
    background: linear-gradient(135deg, #28a745, #5cb85c);
    color: #ffffff;
}
.badge-gradient-warning {
    background: linear-gradient(135deg, #ffc107, #ffdb6d);
    color: #2c2e3f;
}
.badge-gradient-secondary {
    background: #6c757d;
    color: #ffffff;
}
.status-badge {
    padding: 0.3rem 0.8rem;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.85rem;
    display: inline-block;
}
.status-badge.aktif {
    background: linear-gradient(135deg, #ffc107, #ffdb6d);
    color: #2c2e3f;
}
.status-badge.nonaktif {
    background: linear-gradient(135deg, #6c757d, #5a6268);
    color: #fff;
}
.status-badge i {
    margin-right: 4px;
    font-size: 0.9rem;
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

/* Form group untuk modal (dari dokument.blade.php aslinya untuk konsistensi) */
.modal-form-group {
    margin-bottom: 1rem;
}
.modal-form-group label {
    font-size: 0.85rem;
    font-weight: 600;
    color: #9a55ff !important;
    margin-bottom: 0.3rem;
    letter-spacing: 0.3px;
    font-family: 'Nunito', sans-serif;
    display: block;
}
.modal-form-control {
    border: 1px solid #e9ecef;
    border-radius: 8px;
    padding: 0.6rem 0.8rem;
    font-size: 0.9rem;
    transition: all 0.2s ease;
    background-color: #ffffff;
    color: #2c2e3f;
    width: 100%;
}
.modal-form-control:focus {
    border-color: #9a55ff;
    box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.1);
    outline: none;
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
                            <i class="mdi mdi-file-document-multiple me-2" style="color: #9a55ff;"></i>Master Dokumen Pasca landBank
                        </h3>
                        <p class="text-muted mb-0">
                            Kelola master dokumen untuk keperluan transaksi dan perizinan
                        </p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-file-document" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Data Dokumen -->
    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-filter-outline me-2"></i>Daftar Dokumen
                    </h5>
                    <button class="btn btn-gradient-primary" style="padding: 0.6rem 1.2rem; font-size: 0.9rem;" onclick="openModal('tambah')">
                        <i class="mdi mdi-plus me-1"></i>Tambah Dokumen
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
                                    <span>Filter data dokumen</span>
                                </div>
                                <form id="filterForm" method="GET" action="{{ route('dokument.index') }}">
                                    <div class="row g-2 align-items-end w-100">

                                        <!-- Search -->
                                        <div class="col-md-6">
                                            <label class="form-label">Cari Dokumen</label>
                                            <input type="text" class="form-control" name="search" id="searchInput" placeholder="Nama dokumen..." value="{{ request('search') }}">
                                        </div>

                                        <!-- Masa Berlaku -->
                                        <div class="col-md-3">
                                            <label class="form-label">Masa Berlaku</label>
                                            <select class="form-control" name="has_expiry" id="hasExpirySelect">
                                                <option value="">Semua</option>
                                                <option value="yes" {{ request('has_expiry') == 'yes' ? 'selected' : '' }}>Ya</option>
                                                <option value="no" {{ request('has_expiry') == 'no' ? 'selected' : '' }}>Tidak</option>
                                            </select>
                                        </div>

                                        <!-- Tampil - Hanya 10, 15, 25 -->
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
                                                <a href="{{ route('dokument.index') }}" class="btn btn-gradient-secondary btn-icon-only flex-fill" title="Reset" onclick="showResetLoading(event)">
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
                                    <span>Filter data dokumen</span>
                                </div>
                                <form method="GET" action="{{ route('dokument.index') }}">
                                    <div class="row g-2">
                                        <div class="col-12 mb-2">
                                            <label class="form-label">Cari Dokumen</label>
                                            <input type="text" class="form-control" name="search" id="searchInputMobile" placeholder="Nama dokumen..." value="{{ request('search') }}">
                                        </div>
                                        <div class="col-12 mb-2">
                                            <label class="form-label">Masa Berlaku</label>
                                            <select class="form-control" name="has_expiry" id="hasExpirySelectMobile">
                                                <option value="">Semua</option>
                                                <option value="yes" {{ request('has_expiry') == 'yes' ? 'selected' : '' }}>Ya</option>
                                                <option value="no" {{ request('has_expiry') == 'no' ? 'selected' : '' }}>Tidak</option>
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
                                        <div class="col-12 mt-2">
                                            <div class="d-flex gap-2">
                                                <button type="submit" class="btn btn-gradient-primary btn-icon-only flex-fill" id="filterBtnMobile" title="Filter" onclick="showFilterLoading()">
                                                    <i class="mdi mdi-filter"></i>
                                                </button>
                                                <a href="{{ route('dokument.index') }}" class="btn btn-gradient-secondary btn-icon-only flex-fill" title="Reset" onclick="showResetLoading(event)">
                                                    <i class="mdi mdi-refresh"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>

                    <!-- TABEL DATA DOKUMEN DENGAN SCROLLBAR -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="sortable" data-field="name" data-direction="{{ request('sortField') == 'name' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Nama Dokumen
                                        @if(request('sortField') == 'name')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable" data-field="code" data-direction="{{ request('sortField') == 'code' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Kode Dokumen
                                        @if(request('sortField') == 'code')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable" data-field="has_expiry" data-direction="{{ request('sortField') == 'has_expiry' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Masa Berlaku
                                        @if(request('sortField') == 'has_expiry')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($documentTypes as $index => $item)
                                <tr>
                                    <td class="text-center fw-bold">{{ $documentTypes->firstItem() + $index }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-file-document text-primary me-2" style="font-size: 1.2rem;"></i>
                                            <span class="fw-bold">{{ $item->name }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-medium text-dark">{{ $item->code }}</span>
                                    </td>
                                    <td>
                                        @if ($item->has_expiry)
                                            <span class="status-badge aktif">
                                                <i class="mdi mdi-calendar-clock"></i> Ya
                                            </span>
                                        @else
                                            <span class="status-badge nonaktif">
                                                <i class="mdi mdi-calendar-remove"></i> Tidak
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
                                    <td colspan="5" class="text-center text-muted py-5">
                                        <i class="mdi mdi-file-document-off" style="font-size: 3rem; opacity: 0.3;"></i>
                                        <p class="mt-2 mb-0">Tidak ada data dokumen yang tersedia.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- PAGINATION -->
                    @if ($documentTypes instanceof \Illuminate\Pagination\LengthAwarePaginator && $documentTypes->total() > 0)
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                        <div class="pagination-info mb-2 mb-sm-0">
                            Menampilkan {{ $documentTypes->firstItem() }} - {{ $documentTypes->lastItem() }} dari {{ $documentTypes->total() }} data
                        </div>
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                {{-- Previous Page Link --}}
                                @if ($documentTypes->onFirstPage())
                                    <li class="page-item disabled" aria-disabled="true">
                                        <span class="page-link" aria-label="Previous">
                                            <i class="mdi mdi-chevron-left"></i>
                                        </span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $documentTypes->appends(request()->query())->previousPageUrl() }}" rel="prev" aria-label="Previous" onclick="showPaginationLoading(event)">
                                            <i class="mdi mdi-chevron-left"></i>
                                        </a>
                                    </li>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach ($documentTypes->getUrlRange(max(1, $documentTypes->currentPage() - 2), min($documentTypes->lastPage(), $documentTypes->currentPage() + 2)) as $page => $url)
                                    @if ($page == $documentTypes->currentPage())
                                        <li class="page-item active" aria-current="page">
                                            <span class="page-link">{{ $page }}</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $documentTypes->appends(request()->query())->url($page) }}" onclick="showPaginationLoading(event)">{{ $page }}</a>
                                        </li>
                                    @endif
                                @endforeach

                                {{-- Next Page Link --}}
                                @if ($documentTypes->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $documentTypes->appends(request()->query())->nextPageUrl() }}" rel="next" aria-label="Next" onclick="showPaginationLoading(event)">
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

<!-- MODAL TAMBAH/EDIT DOKUMEN -->
<div class="modal fade" id="modalDokumen" tabindex="-1" aria-labelledby="modalDokumenLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDokumenLabel">
                    <i class="mdi mdi-file-document-plus-outline me-2" id="modalIcon"></i>
                    <span id="modalTitle">Tambah Dokumen</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formDokumen" method="POST" onsubmit="return submitForm(event)">
                @csrf
                <input type="hidden" name="_method" id="methodField" value="POST">
                
                <div class="modal-body">
                    <div class="modal-form-group mb-3">
                        <label>
                            <i class="mdi mdi-file-document me-1"></i>Nama Dokumen <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="name" id="namaDokumen" class="modal-form-control" placeholder="Contoh: IMB, SHM, dll" required>
                    </div>

                    <div class="modal-form-group mb-3">
                        <label>
                            <i class="mdi mdi-code-tags me-1"></i>Kode Dokumen <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="code" id="kodeDokumen" class="modal-form-control" placeholder="Contoh: IMB" required>
                        <small class="text-muted mt-1 d-block">
                            <i class="mdi mdi-information-outline me-1"></i>
                            Gunakan kode unik (huruf besar tanpa spasi)
                        </small>
                    </div>

                    <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded mt-3">
                        <div>
                            <span class="fw-bold d-block">Memiliki Masa Berlaku</span>
                            <small class="text-muted">
                                Centang jika dokumen memiliki tanggal kadaluarsa
                            </small>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="has_expiry" value="1" id="hasExpiryCheckbox" style="cursor: pointer; width: 40px; height: 20px;">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">
                        <i class="mdi mdi-close me-1"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-gradient-primary" id="submitBtn">
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
            timerProgressBar: true
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
    
    // Validasi error
    @if($errors->any())
        Swal.fire({
            icon: 'warning',
            title: 'Validasi Gagal',
            html: `
                <ul style="text-align: left; margin-top: 10px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            `,
            confirmButtonColor: '#9a55ff'
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

// Fungsi submit form dengan loading
function submitForm(event) {
    event.preventDefault();

    // Tampilkan loading
    Swal.fire({
        title: 'Mohon tunggu...',
        html: 'Sedang menyimpan data',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    // Submit form setelah loading ditampilkan
    setTimeout(() => {
        document.getElementById('formDokumen').submit();
    }, 100);

    return false;
}

// Buka Modal untuk Tambah atau Edit
function openModal(type, id = null) {
    if (type === 'tambah') {
        // Reset form
        $('#formDokumen')[0].reset();
        $('#methodField').val('POST');
        $('#formDokumen').attr('action', '{{ route("document-types.store") }}');

        // Ubah title dan icon
        $('#modalTitle').text('Tambah Dokumen');
        $('#modalIcon').removeClass('mdi-pencil').addClass('mdi-file-document-plus-outline');
        $('#btnText').text('Simpan');
        $('#btnIcon').removeClass('mdi-pencil').addClass('mdi-content-save');

        // Reset checkbox
        $('#hasExpiryCheckbox').prop('checked', false);

        $('#modalDokumen').modal('show');
    } else {
        // Tampilkan loading saat mengambil data
        Swal.fire({
            title: 'Mohon tunggu...',
            html: 'Sedang mengambil data dokumen',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // Ambil data dokumen via AJAX
        $.get('{{ url("dokument") }}/' + id + '/edit', function(data) {
            Swal.close(); // Tutup loading

            $('#namaDokumen').val(data.name);
            $('#kodeDokumen').val(data.code);
            $('#hasExpiryCheckbox').prop('checked', data.has_expiry == 1);

            $('#methodField').val('PUT');
            $('#formDokumen').attr('action', '{{ url("dokument") }}/' + id + '/update');

            // Ubah title dan icon
            $('#modalTitle').text('Edit Dokumen');
            $('#modalIcon').removeClass('mdi-file-document-plus-outline').addClass('mdi-pencil');
            $('#btnText').text('Update');
            $('#btnIcon').removeClass('mdi-content-save').addClass('mdi-pencil');

            $('#modalDokumen').modal('show');
        }).fail(function() {
            Swal.close();
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Gagal mengambil data dokumen',
                confirmButtonColor: '#dc3545'
            });
        });
    }
}

// Fungsi Konfirmasi Hapus
function confirmDelete(id) {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            return new Promise((resolve) => {
                // Tampilkan loading manual
                Swal.fire({
                    title: 'Menghapus...',
                    html: 'Sedang menghapus data',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Buat form delete dan submit
                setTimeout(() => {
                    let form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '{{ url("dokument") }}/' + id + '/delete';

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

                    resolve();
                }, 100);
            });
        }
    });
}
</script>
@endpush
