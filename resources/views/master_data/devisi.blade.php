@extends('layouts.partial.app')

@section('title', 'Master Data Divisi - Property Management App')

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

/* Badge Jumlah Karyawan - Biru Muda Transparan */
.badge-employee {
    background: rgba(13, 110, 253, 0.1);
    border: 1px solid rgba(13, 110, 253, 0.3);
    color: #0d6efd;
    padding: 0.3rem 0.8rem;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.85rem;
    display: inline-block;
}
.badge-employee i {
    margin-right: 4px;
    font-size: 0.9rem;
    color: #0d6efd;
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
                            <i class="mdi mdi-account-group me-2" style="color: #9a55ff;"></i>Master Data Divisi
                        </h3>
                        <p class="text-muted mb-0">
                            Kelola data divisi untuk struktur organisasi perusahaan
                        </p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-account-group" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Data Divisi -->
    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-filter-outline me-2"></i>Daftar Divisi
                    </h5>
                    <button class="btn btn-gradient-primary" style="padding: 0.6rem 1.2rem; font-size: 0.9rem;" onclick="openModal('tambah')">
                        <i class="mdi mdi-plus me-1"></i>Tambah Divisi
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
                                    <span>Filter data divisi</span>
                                </div>
                                <form id="filterForm" method="GET" action="{{ route('master.data.division.index') }}">
                                    <div class="row g-2 align-items-end w-100">

                                        <!-- Search -->
                                        <div class="col-md-8">
                                            <label class="form-label">Cari</label>
                                            <input type="text" class="form-control" name="search" id="searchInput" placeholder="Nama divisi..." value="{{ request('search') }}">
                                        </div>

                                        <!-- Tampil -->
                                        <div class="col-md-2">
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
                                                <a href="{{ route('master.data.division.index') }}" class="btn btn-gradient-secondary btn-icon-only flex-fill" title="Reset" onclick="showResetLoading(event)">
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
                                    <span>Filter data divisi</span>
                                </div>
                                <form method="GET" action="{{ route('master.data.division.index') }}">
                                    <div class="row g-2">
                                        <div class="col-12 mb-2">
                                            <label class="form-label">Cari</label>
                                            <input type="text" class="form-control" name="search" id="searchInputMobile" placeholder="Nama divisi..." value="{{ request('search') }}">
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
                                            <a href="{{ route('master.data.division.index') }}" class="btn btn-gradient-secondary btn-icon-only-mobile w-100" title="Reset" onclick="showResetLoading(event)">
                                                <i class="mdi mdi-refresh"></i> Reset
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>

                    <!-- TABEL DATA DIVISI -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="sortable" data-field="name" data-direction="{{ request('sortField') == 'name' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Nama Divisi
                                        @if(request('sortField') == 'name')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable" data-field="employees_count" data-direction="{{ request('sortField') == 'employees_count' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Jml Karyawan
                                        @if(request('sortField') == 'employees_count')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="text-center">Aksi</th>
                                   </tr>
                            </thead>
                            <tbody>
                                @forelse ($division as $index => $item)
                                 <tr>
                                    <td class="text-center fw-bold">{{ $division->firstItem() + $index }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-account-group text-primary me-2" style="font-size: 1.2rem;"></i>
                                            <span class="fw-bold">{{ $item->name }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge-employee">
                                        {{ $item->employees_count }} Karyawan
                                        </span>
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
                                    <td colspan="4" class="text-center">
                                        <div class="empty-state">
                                            <i class="mdi mdi-account-group-remove"></i>
                                            <p>Belum ada data divisi</p>
                                            <small>Klik tombol "Tambah Divisi" untuk menambahkan data</small>
                                        </div>
                                    </td>
                                 </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- PAGINATION -->
                    @if ($division instanceof \Illuminate\Pagination\LengthAwarePaginator && $division->total() > 0)
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                        <div class="pagination-info mb-2 mb-sm-0">
                            Menampilkan {{ $division->firstItem() }} - {{ $division->lastItem() }} dari {{ $division->total() }} data
                        </div>
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                {{-- Previous Page Link --}}
                                @if ($division->onFirstPage())
                                    <li class="page-item disabled" aria-disabled="true">
                                        <span class="page-link" aria-label="Previous">
                                            <i class="mdi mdi-chevron-left"></i>
                                        </span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $division->appends(request()->query())->previousPageUrl() }}" rel="prev" aria-label="Previous" onclick="showPaginationLoading(event)">
                                            <i class="mdi mdi-chevron-left"></i>
                                        </a>
                                    </li>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach ($division->getUrlRange(max(1, $division->currentPage() - 2), min($division->lastPage(), $division->currentPage() + 2)) as $page => $url)
                                    @if ($page == $division->currentPage())
                                        <li class="page-item active" aria-current="page">
                                            <span class="page-link">{{ $page }}</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $division->appends(request()->query())->url($page) }}" onclick="showPaginationLoading(event)">{{ $page }}</a>
                                        </li>
                                    @endif
                                @endforeach

                                {{-- Next Page Link --}}
                                @if ($division->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $division->appends(request()->query())->nextPageUrl() }}" rel="next" aria-label="Next" onclick="showPaginationLoading(event)">
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

<!-- MODAL TAMBAH/EDIT DIVISI -->
<div class="modal fade" id="modalDivisi" tabindex="-1" aria-labelledby="modalDivisiLabel" aria-hidden="true">
    <div class="modal-dialog modal-medium modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDivisiLabel">
                    <i class="mdi mdi-plus-circle me-2" id="modalIcon"></i>
                    <span id="modalTitle">Tambah Divisi</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formDivisi" method="POST" action="{{ route('master.data.division.store') }}">
                @csrf
                <input type="hidden" name="_method" id="methodField" value="POST">
                <input type="hidden" id="divisiId" name="id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Divisi <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" id="namaDivisi" placeholder="Contoh: Divisi Operasional" value="{{ old('name') }}" required>
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

// Buka Modal untuk Tambah atau Edit
function openModal(type, id = null) {
    if (type === 'tambah') {
        // Reset form
        $('#formDivisi')[0].reset();
        $('#divisiId').val('');
        $('#methodField').val('POST');
        $('#formDivisi').attr('action', '{{ route("master.data.division.store") }}');

        // Ubah title dan icon
        $('#modalTitle').text('Tambah Divisi');
        $('#modalIcon').removeClass('mdi-pencil-circle').addClass('mdi-plus-circle');
        $('#btnText').text('Simpan');
        $('#btnIcon').removeClass('mdi-pencil').addClass('mdi-content-save');

        $('#modalDivisi').modal('show');
    } else {
        // Tampilkan loading saat mengambil data
        Swal.fire({
            title: 'Mohon tunggu...',
            html: 'Sedang mengambil data divisi',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // Ambil data divisi via AJAX - URL sesuai route yang ada
        // Karena tidak ada route GET untuk edit, kita perlu buat route baru atau gunakan route show
        // Untuk sementara, kita gunakan route yang sama dengan index dan ambil data dari variabel
        // Atau lebih baik buat route GET untuk edit di web.php

        // Alternatif: ambil data dari array yang sudah ada di halaman
        setTimeout(() => {
            Swal.close();

            // Cari data dari tabel yang sudah ada (data dari $division)
            let data = null;
            @foreach ($division as $item)
                if ({{ $item->id }} == id) {
                    data = { id: {{ $item->id }}, name: '{{ $item->name }}' };
                }
            @endforeach

            if (data) {
                $('#divisiId').val(data.id);
                $('#namaDivisi').val(data.name);

                $('#methodField').val('PUT');
                $('#formDivisi').attr('action', '{{ url("master-data/division/update") }}/' + id);

                // Ubah title dan icon
                $('#modalTitle').text('Edit Divisi');
                $('#modalIcon').removeClass('mdi-plus-circle').addClass('mdi-pencil-circle');
                $('#btnText').text('Update');
                $('#btnIcon').removeClass('mdi-content-save').addClass('mdi-pencil');

                $('#modalDivisi').modal('show');
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Data divisi tidak ditemukan',
                    confirmButtonColor: '#dc3545'
                });
            }
        }, 500);
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
                html: 'Sedang menghapus data divisi',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Buat form delete dan submit setelah loading ditampilkan
            setTimeout(() => {
                let form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ url("master-data/division") }}/' + id;

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
