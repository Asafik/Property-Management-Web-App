@extends('layouts.partial.app')

@section('title', 'Master Data Posisi - Property Management App')

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

.card-title { font-size: 0.9rem; font-weight: 600; color: #9a55ff; margin-bottom: 0; }
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
.filter-card .form-control,
.filter-card .form-select {
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
.btn-gradient-primary   { background: linear-gradient(to right, #da8cff, #9a55ff) !important; color: #ffffff !important; }
.btn-gradient-secondary { background: #6c757d !important; color: #ffffff !important; }
.btn-gradient-secondary:hover { background: #5a6268 !important; }

.btn-action {
    width: 36px;
    height: 36px;
    padding: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    margin-left: 6px;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}
.btn-action i { font-size: 1.1rem; }
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
    width: 40px;
    height: 40px;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
}
.btn-icon-only i { font-size: 1.2rem; margin: 0; }

.btn-icon-only-mobile {
    width: 100%;
    height: 40px;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
}
.btn-icon-only-mobile i { font-size: 1.2rem; margin: 0; }

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
.table thead th.active-sort {
    color: #7a3fcc;
}
.table thead th.active-sort i {
    opacity: 1;
    color: #7a3fcc;
}
@media (min-width: 576px) { .table thead th { font-size: 0.85rem; padding: 0.9rem 0.6rem; } }
@media (min-width: 768px) { .table thead th { font-size: 0.9rem; padding: 1rem 0.75rem; } }

.table thead th:first-child, .table thead th.action-cell { cursor: default; }
.table thead th:first-child:hover, .table thead th.action-cell:hover { color: #9a55ff; }
.table tbody td:first-child { padding-left: 0.5rem; font-weight: 500; width: 60px; text-align: center; }
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

.badge-division {
    padding: 0.35rem 0.8rem;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.82rem;
    display: inline-block;
    background: linear-gradient(135deg, #17a2b8, #56c6d8);
    color: #fff;
}

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
@media (min-width: 576px) { .pagination-info { font-size: 0.85rem; } }
@media (min-width: 768px) { .pagination-info { font-size: 0.9rem; } }

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

.text-primary  { color: #9a55ff !important; }
.text-danger   { color: #dc3545 !important; }
.text-muted    { color: #a5b3cb !important; }
.fw-bold       { font-weight: 600 !important; }

h3.text-dark {
    font-size: 1.3rem !important;
    font-weight: 700;
    color: #2c2e3f !important;
    margin-bottom: 0.5rem !important;
}
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
.action-cell {
    text-align: right !important;
    min-width: 120px;
}
</style>

<div class="container-fluid p-2 p-sm-3 p-md-4">

    <div class="row mb-3 mb-sm-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="text-dark mb-1">
                            <i class="mdi mdi-briefcase-account me-2" style="color: #9a55ff;"></i>Master Data Posisi
                        </h3>
                        <p class="text-muted mb-0">Kelola data posisi/jabatan untuk setiap divisi</p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-briefcase-account" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-format-list-bulleted me-2"></i>Daftar Posisi
                    </h5>
                    <button class="btn btn-gradient-primary" style="padding: 0.6rem 1.2rem; font-size: 0.9rem;" onclick="openModal()">
                        <i class="mdi mdi-plus me-1"></i>Tambah Posisi
                    </button>
                </div>

                <div class="card-body">

                    <div class="filter-card mb-4">
                        <div class="card-body">

                            <div class="filter-row-desktop">
                                <div class="filter-text">
                                    <i class="mdi mdi-filter-outline"></i>
                                    <span>Filter data posisi</span>
                                </div>

                                <form id="filterForm" method="GET" action="{{ route('master.data.posisi') }}">
                                    <div class="row g-2 align-items-end w-100">
                                        <div class="col-md-5">
                                            <label class="form-label">Cari Posisi</label>
                                            <input type="text" class="form-control" name="search" placeholder="Nama posisi..." value="{{ request('search') }}">
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Divisi</label>
                                            <select class="form-control" name="division_id">
                                                <option value="">Semua Divisi</option>
                                                @foreach ($divisions as $division)
                                                    <option value="{{ $division->id }}" {{ request('division_id') == $division->id ? 'selected' : '' }}>
                                                        {{ $division->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-1">
                                            <label class="form-label">Tampil</label>
                                            <select class="form-control" name="per_page">
                                                <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                                <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
                                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label invisible d-none d-md-block">Aksi</label>
                                            <div class="d-flex gap-2">
                                                <button type="submit" class="btn btn-gradient-primary btn-icon-only flex-fill" title="Filter" onclick="showFilterLoading()">
                                                    <i class="mdi mdi-filter"></i>
                                                </button>
                                                <a href="{{ route('master.data.posisi') }}" class="btn btn-gradient-secondary btn-icon-only flex-fill" title="Reset" onclick="showResetLoading(event)">
                                                    <i class="mdi mdi-refresh"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="filter-row-mobile">
                                <div class="filter-text mb-2">
                                    <i class="mdi mdi-filter-outline"></i>
                                    <span>Filter data posisi</span>
                                </div>

                                <form method="GET" action="{{ route('master.data.posisi') }}">
                                    <div class="row g-2">
                                        <div class="col-12 mb-2">
                                            <label class="form-label">Cari Posisi</label>
                                            <input type="text" class="form-control" name="search" placeholder="Nama posisi..." value="{{ request('search') }}">
                                        </div>
                                        <div class="col-12 mb-2">
                                            <label class="form-label">Divisi</label>
                                            <select class="form-control" name="division_id">
                                                <option value="">Semua Divisi</option>
                                                @foreach ($divisions as $division)
                                                    <option value="{{ $division->id }}" {{ request('division_id') == $division->id ? 'selected' : '' }}>
                                                        {{ $division->name }}
                                                    </option>
                                                @endforeach
                                            </select>
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
                                            <button type="submit" class="btn btn-gradient-primary btn-icon-only-mobile w-100" onclick="showFilterLoading()">
                                                <i class="mdi mdi-filter"></i> Filter
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <a href="{{ route('master.data.posisi') }}" class="btn btn-gradient-secondary btn-icon-only-mobile w-100" onclick="showResetLoading(event)">
                                                <i class="mdi mdi-refresh"></i> Reset
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger mb-3">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="sortable {{ request('sortField') == 'name' ? 'active-sort' : '' }}" data-field="name" data-direction="{{ request('sortField') == 'name' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Nama Posisi
                                        @if(request('sortField') == 'name')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable {{ request('sortField') == 'division_id' ? 'active-sort' : '' }}" data-field="division_id" data-direction="{{ request('sortField') == 'division_id' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Divisi
                                        @if(request('sortField') == 'division_id')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="action-cell">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($positions as $index => $position)
                                    <tr>
                                        <td class="text-center fw-bold">{{ $positions->firstItem() + $index }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-briefcase text-primary me-2" style="font-size: 1.2rem;"></i>
                                                <span class="fw-bold">{{ $position->name }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge-division">
                                                <i class="mdi mdi-domain me-1"></i>{{ $position->division->name ?? '-' }}
                                            </span>
                                        </td>
                                        <td class="action-cell">
                                            <button
                                                type="button"
                                                class="btn-action edit"
                                                title="Edit"
                                                data-id="{{ $position->id }}"
                                                data-division-id="{{ $position->division_id }}"
                                                data-name="{{ $position->name }}"
                                                onclick="openEditModal(this)">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>

                                            <button
                                                type="button"
                                                class="btn-action delete"
                                                title="Hapus"
                                                onclick="confirmDelete('{{ $position->id }}')">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">
                                            Tidak ada data posisi
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($positions instanceof \Illuminate\Pagination\LengthAwarePaginator && $positions->total() > 0)
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                            <div class="pagination-info mb-2 mb-sm-0">
                                Menampilkan {{ $positions->firstItem() }} - {{ $positions->lastItem() }} dari {{ $positions->total() }} data
                            </div>

                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                    @if ($positions->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link"><i class="mdi mdi-chevron-left"></i></span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $positions->previousPageUrl() }}" onclick="showPaginationLoading(event)">
                                                <i class="mdi mdi-chevron-left"></i>
                                            </a>
                                        </li>
                                    @endif

                                    @foreach ($positions->getUrlRange(max(1, $positions->currentPage() - 2), min($positions->lastPage(), $positions->currentPage() + 2)) as $page => $url)
                                        @if ($page == $positions->currentPage())
                                            <li class="page-item active">
                                                <span class="page-link">{{ $page }}</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $url }}" onclick="showPaginationLoading(event)">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach

                                    @if ($positions->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $positions->nextPageUrl() }}" onclick="showPaginationLoading(event)">
                                                <i class="mdi mdi-chevron-right"></i>
                                            </a>
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

<div class="modal fade" id="modalPosition" tabindex="-1" aria-labelledby="modalPositionLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPositionLabel">
                    <i class="mdi mdi-plus-circle me-2" id="modalIcon"></i>
                    <span id="modalTitle">Tambah Posisi</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="formPosition" method="POST" onsubmit="return submitForm(event)">
                @csrf
                <input type="hidden" name="_method" id="methodField" value="POST">

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Pilih Divisi <span class="text-danger">*</span></label>
                        <select class="form-control" name="division_id" id="divisionId" required>
                            <option value="">Pilih Divisi</option>
                            @foreach ($divisions as $division)
                                <option value="{{ $division->id }}">{{ $division->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Posisi <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" id="positionName" placeholder="Contoh: Staff HRD" required>
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

<form id="deleteForm" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.sortable').forEach(item => {
        item.addEventListener('click', function() {
            let field = this.getAttribute('data-field');
            let direction = this.getAttribute('data-direction');

            Swal.fire({
                title: 'Memuat...',
                html: 'Sedang mengurutkan data',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });

            let url = new URL(window.location.href);
            url.searchParams.set('sortField', field);
            url.searchParams.set('sortDirection', direction);
            url.searchParams.set('page', 1);

            window.location.href = url.toString();
        });
    });

    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            timer: 2000,
            showConfirmButton: true,
            confirmButtonColor: '#9a55ff',
            timerProgressBar: true
        });
    @endif

    @if (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}',
            confirmButtonColor: '#dc3545'
        });
    @endif
});

function showFilterLoading() {
    Swal.fire({
        title: 'Memuat...',
        html: 'Sedang memfilter data',
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
    });
    return true;
}

function showResetLoading(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Memuat...',
        html: 'Sedang mereset filter',
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
    });
    window.location.href = event.currentTarget.href;
}

function showPaginationLoading(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Memuat...',
        html: 'Sedang memuat halaman',
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
    });
    window.location.href = event.currentTarget.href;
}

function submitForm(event) {
    event.preventDefault();

    Swal.fire({
        title: 'Mohon tunggu...',
        html: 'Sedang menyimpan data',
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
    });

    setTimeout(() => {
        document.getElementById('formPosition').submit();
    }, 100);

    return false;
}

function openModal() {
    const form = document.getElementById('formPosition');
    form.reset();

    document.getElementById('methodField').value = 'POST';
    form.action = '{{ route("master.data.posisi.store") }}';

    document.getElementById('modalTitle').textContent = 'Tambah Posisi';
    document.getElementById('modalIcon').className = 'mdi mdi-plus-circle me-2';
    document.getElementById('btnText').textContent = 'Simpan';
    document.getElementById('btnIcon').className = 'mdi mdi-content-save me-1';

    const modal = new bootstrap.Modal(document.getElementById('modalPosition'));
    modal.show();
}

function openEditModal(button) {
    Swal.fire({
        title: 'Memuat...',
        html: 'Sedang mengambil data posisi',
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
    });

    setTimeout(() => {
        const id = button.getAttribute('data-id');
        const divisionId = button.getAttribute('data-division-id');
        const name = button.getAttribute('data-name');

        const form = document.getElementById('formPosition');
        form.reset();

        document.getElementById('methodField').value = 'PUT';
        form.action = '{{ url("/master-data/posisi/update") }}/' + id;

        document.getElementById('divisionId').value = divisionId;
        document.getElementById('positionName').value = name;

        document.getElementById('modalTitle').textContent = 'Edit Posisi';
        document.getElementById('modalIcon').className = 'mdi mdi-pencil-circle me-2';
        document.getElementById('btnText').textContent = 'Update';
        document.getElementById('btnIcon').className = 'mdi mdi-pencil me-1';

        Swal.close();

        const modal = new bootstrap.Modal(document.getElementById('modalPosition'));
        modal.show();
    }, 300);
}

function confirmDelete(id) {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: 'Data yang dihapus tidak dapat dikembalikan!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Menghapus...',
                html: 'Sedang menghapus data',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });

            setTimeout(() => {
                const form = document.getElementById('deleteForm');
                form.action = '{{ url("/master-data/posisi") }}/' + id;
                form.submit();
            }, 100);
        }
    });
}
</script>
@endpush
