@extends('layouts.partial.app')

@section('title', 'Data Pengguna - Property Management App')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-clean.css') }}?v={{ time() }}">
    <style>
        /* Styling Table Persis Catalog Unit (jual_unit) */
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
        }

        .table-pengguna {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0;
        }
        .table-pengguna thead th {
            background: linear-gradient(135deg, #f8f9fa, #f1f3f5) !important;
            color: #9a55ff !important;
            font-weight: 700;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e9ecef !important;
            padding: 0.85rem 0.75rem !important;
            vertical-align: middle;
            white-space: nowrap;
        }
        .table-pengguna thead th.sortable {
            cursor: pointer;
            user-select: none;
            transition: all 0.2s ease;
        }
        .table-pengguna thead th.sortable:hover {
            color: #7a3fcc !important;
            background: #f1f5f9 !important;
        }
        .table-pengguna thead th.sortable i {
            font-size: 0.85rem;
            margin-left: 4px;
            opacity: 0.7;
        }
        .table-pengguna tbody td {
            vertical-align: middle;
            font-size: 0.85rem;
            padding: 0.85rem 0.75rem !important;
            border-bottom: 1px solid #f1f5f9;
            color: #2c2e3f;
            white-space: nowrap;
        }
        .table-pengguna tbody tr:hover {
            background-color: #f8fafc;
        }

        /* Solid Buttons - 1 Warna, Tanpa Gradient (Persis Catalog Unit) */
        .btn-gradient-primary {
            background: #9a55ff !important;
            border-color: #9a55ff !important;
            color: #ffffff !important;
            box-shadow: none !important;
        }
        .btn-gradient-primary:hover {
            background: #8b3df5 !important;
            border-color: #8b3df5 !important;
            color: #ffffff !important;
        }
        .btn-gradient-secondary {
            background: #64748b !important;
            border-color: #64748b !important;
            color: #ffffff !important;
            box-shadow: none !important;
        }
        .btn-gradient-secondary:hover {
            background: #475569 !important;
            border-color: #475569 !important;
            color: #ffffff !important;
        }

        /* Action Buttons Kotak Solid (Persis Catalog Unit) */
        .btn-action {
            width: 34px;
            height: 34px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            margin: 0 2px;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
            text-decoration: none !important;
        }
        .btn-action i {
            font-size: 1rem;
        }
        .btn-action.edit {
            background: #f59e0b;
            color: #ffffff;
        }
        .btn-action.edit:hover {
            background: #d97706;
            color: #ffffff;
            transform: translateY(-1px);
        }
        .btn-action.delete {
            background: #ef4444;
            color: #ffffff;
        }
        .btn-action.delete:hover {
            background: #dc2626;
            color: #ffffff;
            transform: translateY(-1px);
        }
        .filter-row-box {
            background: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            padding: 0.9rem 1.15rem;
        }
    </style>
@endpush

@section('content')

<div class="container-fluid px-2 px-md-4 py-3">

    <!-- Flash Alert Notifikasi -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 mb-3" role="alert" style="border-radius: 8px;">
            <i class="mdi mdi-check-circle fs-5"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2 mb-3" role="alert" style="border-radius: 8px;">
            <i class="mdi mdi-alert-circle fs-5"></i>
            <div>{{ session('error') }}</div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Page Title & Subtitle (Clean Modern Persis Catalog Unit) -->
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
        <div>
            <h2 class="text-dark mb-1 fw-bold" style="font-size: 1.55rem; letter-spacing: -0.02em;">
                Data Pengguna
            </h2>
            <p class="text-muted mb-0" style="font-size: 0.88rem;">
                Kelola data seluruh pengguna sistem, staf, dan sales agent
            </p>
        </div>
    </div>

    <!-- Main Container: Table & Filters (Card Meniru Persis Catalog Unit) -->
    <div class="row">
        <div class="col-12">
            <div class="card compact-table-card shadow-sm border-0">
                <!-- Card Header: Title di kiri, Button Tambah di kanan MENTOK (Persis instruksi user) -->
                <div class="card-header bg-white d-flex flex-wrap justify-content-between align-items-center py-2.5 px-3 px-md-4 gap-2" style="border-bottom: 1px solid #e2e8f0 !important;">
                    <div class="d-flex align-items-center gap-2">
                        <div style="width: 32px; height: 32px; border-radius: 6px; background-color: #f3e8ff; color: #9333ea; display: inline-flex; align-items: center; justify-content: center; font-size: 1.15rem; flex-shrink: 0;">
                            <i class="mdi mdi-format-list-bulleted"></i>
                        </div>
                        <span style="font-size: 0.95rem; font-weight: 700; color: #0f172a;">Daftar Pengguna Sistem</span>
                    </div>

                    <!-- Button Tambah Taruh Kanannya Daftar Pengguna Sistem Mentok Kanan -->
                    <div class="d-flex align-items-center gap-2 ms-auto">
                        <a href="{{ route('agency.create') }}" class="btn btn-sm btn-gradient-primary d-inline-flex align-items-center gap-1.5 shadow-sm fw-semibold px-3 py-2" style="border-radius: 6px; font-size: 0.85rem; height: 36px;">
                            <i class="mdi mdi-plus-circle" style="font-size: 1rem;"></i>
                            <span>Tambah Pengguna</span>
                        </a>
                    </div>
                </div>

                <div class="card-body p-0">
                    <!-- Search & Filter Toolbar (Persis Catalog Unit) -->
                    <div class="filter-row-box">
                        <!-- Desktop Version -->
                        <div class="d-none d-md-block">
                            <form id="filterForm" action="{{ route('agency.index') }}" method="GET" onsubmit="return showFilterLoading()">
                                @if(request('sortField'))
                                    <input type="hidden" name="sortField" value="{{ request('sortField') }}">
                                @endif
                                @if(request('sortDirection'))
                                    <input type="hidden" name="sortDirection" value="{{ request('sortDirection') }}">
                                @endif

                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 w-100">
                                    <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                        <!-- Search Input Group -->
                                        <div style="min-width: 250px; max-width: 360px; flex: 1;">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="search" id="searchInput"
                                                    placeholder="Cari nama atau username..."
                                                    value="{{ request('search') }}"
                                                    style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none; height: 38px; font-size: 0.85rem;">
                                                <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                    type="submit" title="Cari"
                                                    style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 6px !important; border-bottom-right-radius: 6px !important; height: 38px;">
                                                    <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Filter Divisi Dropdown -->
                                        @if(isset($divisions) && $divisions->count() > 0)
                                            <div style="min-width: 180px;">
                                                <select name="division_id" class="form-control" style="height: 38px; font-size: 0.85rem;" onchange="document.getElementById('filterForm').submit()">
                                                    <option value="all">Semua Divisi</option>
                                                    @foreach($divisions as $div)
                                                        <option value="{{ $div->id }}" {{ request('division_id') == $div->id ? 'selected' : '' }}>
                                                            {{ $div->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Right Toolbar: Limit & Filter/Reset Action Buttons -->
                                    <div class="d-flex align-items-center gap-2 ms-auto">
                                        <div style="width: 110px;">
                                            <select class="form-control" name="per_page" id="perPageSelect" style="height: 38px; font-size: 0.85rem;" onchange="document.getElementById('filterForm').submit()">
                                                <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 data</option>
                                                <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15 data</option>
                                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 data</option>
                                                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 data</option>
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-gradient-primary d-inline-flex align-items-center justify-content-center" style="width: 38px; height: 38px; border-radius: 6px; padding: 0;" title="Filter">
                                            <i class="mdi mdi-filter" style="font-size: 1rem;"></i>
                                        </button>
                                        <a href="{{ route('agency.index') }}" class="btn btn-gradient-secondary d-inline-flex align-items-center justify-content-center" style="width: 38px; height: 38px; border-radius: 6px; padding: 0;" title="Reset Filter" onclick="showResetLoading(event)">
                                            <i class="mdi mdi-refresh" style="font-size: 1rem;"></i>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Mobile Version -->
                        <div class="d-block d-md-none">
                            <form action="{{ route('agency.index') }}" method="GET" onsubmit="return showFilterLoading()">
                                <div class="row g-2">
                                    <div class="col-12">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" id="searchInputMobile"
                                                placeholder="Cari nama atau username..."
                                                value="{{ request('search') }}"
                                                style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none; height: 38px; font-size: 0.85rem;">
                                            <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                type="submit" title="Cari"
                                                style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 6px !important; border-bottom-right-radius: 6px !important; height: 38px;">
                                                <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                            </button>
                                        </div>
                                    </div>

                                    @if(isset($divisions) && $divisions->count() > 0)
                                        <div class="col-12">
                                            <select name="division_id" class="form-control" style="height: 38px; font-size: 0.85rem;">
                                                <option value="all">Semua Divisi</option>
                                                @foreach($divisions as $div)
                                                    <option value="{{ $div->id }}" {{ request('division_id') == $div->id ? 'selected' : '' }}>
                                                        {{ $div->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif

                                    <div class="col-12">
                                        <select class="form-control" name="per_page" id="perPageSelectMobile" style="height: 38px; font-size: 0.85rem;">
                                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 data</option>
                                            <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15 data</option>
                                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 data</option>
                                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 data</option>
                                        </select>
                                    </div>

                                    <div class="col-6">
                                        <button type="submit" class="btn btn-gradient-primary w-100 d-flex align-items-center justify-content-center gap-1" style="height: 38px; border-radius: 6px;">
                                            <i class="mdi mdi-filter"></i> Filter
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('agency.index') }}" class="btn btn-gradient-secondary w-100 d-flex align-items-center justify-content-center gap-1" style="height: 38px; border-radius: 6px;" onclick="showResetLoading(event)">
                                            <i class="mdi mdi-refresh"></i> Reset
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Clean Table Data Pengguna (Persis Catalog Unit) -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle table-pengguna mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 50px;">NO</th>
                                    <th class="sortable" data-field="name" data-direction="{{ request('sortField') == 'name' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        NAMA PENGGUNA
                                        @if(request('sortField') == 'name')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable" data-field="username" data-direction="{{ request('sortField') == 'username' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        USERNAME
                                        @if(request('sortField') == 'username')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable" data-field="phone" data-direction="{{ request('sortField') == 'phone' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        NO. TELEPON
                                        @if(request('sortField') == 'phone')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable" data-field="address" data-direction="{{ request('sortField') == 'address' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        ALAMAT
                                        @if(request('sortField') == 'address')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="text-center" style="width: 110px;">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($employees as $index => $user)
                                    <tr>
                                        <td class="text-center fw-bold text-muted">{{ $employees->firstItem() + $index }}</td>
                                        <td>
                                            <span class="fw-bold text-dark" style="font-size: 0.88rem;">{{ $user->name ?? '-' }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark fw-semibold px-2 py-1 border" style="font-size: 0.8rem; border-radius: 6px;">
                                                <i class="mdi mdi-account-circle-outline me-1" style="color: #9a55ff;"></i>{{ $user->username }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="d-inline-flex align-items-center gap-1.5 text-success fw-medium">
                                                <i class="mdi mdi-phone" style="font-size: 0.95rem;"></i>
                                                <span>{{ $user->phone ?: '-' }}</span>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="d-inline-flex align-items-center gap-1.5 text-muted" title="{{ $user->address }}">
                                                <i class="mdi mdi-map-marker" style="color: #ef4444; font-size: 0.95rem;"></i>
                                                <span>{{ Str::limit($user->address ?: '-', 40) }}</span>
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-inline-flex align-items-center gap-1">
                                                <a href="{{ route('agency.edit', $user->id) }}" class="btn-action edit" title="Edit Data Pengguna">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>
                                                <form id="delete-form-{{ $user->id }}" action="{{ route('agency.destroy', $user->id) }}" method="POST" class="d-none">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <button type="button" class="btn-action delete" title="Hapus Pengguna" onclick="confirmDelete({{ $user->id }})">
                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-5">
                                            <i class="mdi mdi-account-off-outline d-block mb-2" style="font-size: 2.2rem; color: #cbd5e1;"></i>
                                            <div class="fw-semibold">Tidak ada data pengguna ditemukan.</div>
                                            <small class="text-muted">Coba ubah kata kunci pencarian atau filter yang dipilih.</small>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination (Persis Catalog Unit) -->
                    @if ($employees instanceof \Illuminate\Pagination\LengthAwarePaginator && $employees->total() > 0)
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center p-3 px-md-4 border-top bg-white">
                        <div class="pagination-info mb-2 mb-sm-0 text-muted" style="font-size: 0.82rem;">
                            Menampilkan {{ $employees->firstItem() ?? 0 }} - {{ $employees->lastItem() ?? 0 }} dari {{ $employees->total() }} data
                        </div>
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                <li class="page-item {{ $employees->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $employees->previousPageUrl() }}" {{ !$employees->onFirstPage() ? 'onclick=showPaginationLoading(event)' : '' }}>
                                        <i class="mdi mdi-chevron-left"></i>
                                    </a>
                                </li>

                                @for($page = 1; $page <= $employees->lastPage(); $page++)
                                    <li class="page-item {{ $page == $employees->currentPage() ? 'active' : '' }}">
                                        @if($page == $employees->currentPage())
                                            <span class="page-link" style="background-color: #9a55ff; border-color: #9a55ff; color: #fff;">{{ $page }}</span>
                                        @else
                                            <a class="page-link" href="{{ $employees->appends(request()->query())->url($page) }}" onclick="showPaginationLoading(event)">{{ $page }}</a>
                                        @endif
                                    </li>
                                @endfor

                                <li class="page-item {{ $employees->hasMorePages() ? '' : 'disabled' }}">
                                    <a class="page-link" href="{{ $employees->nextPageUrl() }}" {{ $employees->hasMorePages() ? 'onclick=showPaginationLoading(event)' : '' }}>
                                        <i class="mdi mdi-chevron-right"></i>
                                    </a>
                                </li>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
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

@if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        timer: 2500,
        showConfirmButton: true,
        confirmButtonColor: '#9a55ff',
        timerProgressBar: true
    });
@endif

@if(session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: '{{ session('error') }}',
        confirmButtonColor: '#dc3545'
    });
@endif

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
        html: 'Sedang mereset filter',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    window.location.href = event.currentTarget.href;
}

function showPaginationLoading(event) {
    if (event.currentTarget.parentElement.classList.contains('disabled')) return;
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

function confirmDelete(id) {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: 'Data pengguna ini akan dihapus permanen!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Memuat...',
                html: 'Sedang menghapus data',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>
@endpush
