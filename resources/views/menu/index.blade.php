@extends('layouts.partial.app')

@section('title', 'Master Data Menu')

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

        @media (min-width: 576px) {
            .card-header {
                padding: 1rem;
            }
        }

        @media (min-width: 768px) {
            .card-header {
                padding: 1.2rem;
            }
        }

        .card-body {
            padding: 0.75rem;
        }

        @media (min-width: 576px) {
            .card-body {
                padding: 1rem;
            }
        }

        @media (min-width: 768px) {
            .card-body {
                padding: 1.2rem;
            }
        }

        .card-title {
            font-size: 0.9rem;
            font-weight: 600;
            color: #9a55ff;
            margin-bottom: 0;
        }

        @media (min-width: 576px) {
            .card-title {
                font-size: 1rem;
            }
        }

        @media (min-width: 768px) {
            .card-title {
                font-size: 1.1rem;
            }
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
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
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
            font-size: 1.05rem;
        }

        .btn-action.edit {
            background: linear-gradient(135deg, #ffc107, #ffdb6d);
            color: #2c2e3f;
        }

        .btn-action.edit:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(255, 193, 7, 0.4);
        }

        .btn-action.setting {
            background: linear-gradient(135deg, #17a2b8, #56c6d8);
            color: #fff;
        }

        .btn-action.setting:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(23, 162, 184, 0.35);
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

        .btn-icon-only i {
            font-size: 1.2rem;
            margin: 0;
        }

        .btn-icon-only-mobile {
            width: 100%;
            height: 40px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
        }

        .btn-icon-only-mobile i {
            font-size: 1.2rem;
            margin: 0;
        }

        .table-responsive {
            overflow-x: auto;
            overflow-y: hidden;
            -webkit-overflow-scrolling: touch;
            border-radius: 8px;
            margin-bottom: 0.5rem;
            max-height: unset;
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

        .badge-parent {
            padding: 0.35rem 0.8rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.82rem;
            display: inline-block;
            background: linear-gradient(135deg, #17a2b8, #56c6d8);
            color: #fff;
        }

        .badge-position {
            padding: 0.35rem 0.8rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.82rem;
            display: inline-block;
            background: linear-gradient(135deg, #28a745, #5fd17a);
            color: #fff;
            margin: 2px 4px 2px 0;
        }

        .route-text {
            font-family: monospace;
            font-size: 0.85rem;
            color: #6f42c1;
            background: #f8f5ff;
            padding: 0.3rem 0.6rem;
            border-radius: 8px;
            display: inline-block;
            word-break: break-all;
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

        .text-primary {
            color: #9a55ff !important;
        }

        .text-danger {
            color: #dc3545 !important;
        }

        .text-muted {
            color: #a5b3cb !important;
        }

        .fw-bold {
            font-weight: 600 !important;
        }

        h3.text-dark {
            font-size: 1.3rem !important;
            font-weight: 700;
            color: #2c2e3f !important;
            margin-bottom: 0.5rem !important;
        }

        @media (min-width: 576px) {
            h3.text-dark {
                font-size: 1.5rem !important;
            }
        }

        @media (min-width: 768px) {
            h3.text-dark {
                font-size: 1.7rem !important;
            }
        }

        .mdi {
            vertical-align: middle;
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

        .filter-row-mobile {
            display: none;
        }

        @media (max-width: 767px) {
            .filter-row-desktop {
                display: none;
            }

            .filter-row-mobile {
                display: block;
                margin-top: 1rem;
            }
        }
    </style>

    <div class="container-fluid p-2 p-sm-3 p-md-4">

        <div class="row mb-3 mb-sm-3 mb-md-4">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="text-dark mb-1">
                                <i class="mdi mdi-view-dashboard me-2" style="color: #9a55ff;"></i>Master Data Menu
                            </h3>
                            <p class="text-muted mb-0">
                                Kelola daftar semua menu aplikasi
                            </p>
                        </div>
                        <div class="d-none d-sm-block">
                            <i class="mdi mdi-view-grid-plus" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-2 mt-sm-2 mt-md-3">
            <div class="col-12">
                <div class="card">
                    <div
                        class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2">
                        <h5 class="card-title mb-0">
                            <i class="mdi mdi-format-list-bulleted-square me-2"></i>Daftar Semua Menu
                        </h5>
                    </div>

                    <div class="card-body">
                        <div class="filter-card mb-4">
                            <div class="card-body">

                                <div class="filter-row-desktop">
                                    <div class="filter-text">
                                        <i class="mdi mdi-filter-outline"></i>
                                        <span>Filter data menu</span>
                                    </div>

                                    <form id="filterForm" method="GET" action="{{ url()->current() }}">
                                        <div class="row g-2 align-items-end w-100">
                                            <div class="col-md-5">
                                                <label class="form-label">Search</label>
                                                <input type="text" class="form-control" name="search" id="searchInput"
                                                    placeholder="Cari nama menu / route..." value="{{ request('search') }}">
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label">Filter Tampil</label>
                                                <select class="form-control" name="per_page" id="perPageSelect">
                                                    <option value="10"
                                                        {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                                    <option value="15"
                                                        {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
                                                    <option value="25"
                                                        {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                                </select>
                                            </div>

                                            <div class="col-md-3">
                                                <label class="form-label invisible d-none d-md-block">Aksi</label>
                                                <div class="d-flex gap-2">
                                                    <button type="submit"
                                                        class="btn btn-gradient-primary btn-icon-only flex-fill"
                                                        title="Filter">
                                                        <i class="mdi mdi-filter"></i>
                                                    </button>
                                                    <a href="{{ url()->current() }}"
                                                        class="btn btn-gradient-secondary btn-icon-only flex-fill"
                                                        title="Reset">
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
                                        <span>Filter data menu</span>
                                    </div>

                                    <form method="GET" action="{{ url()->current() }}">
                                        <div class="row g-2">
                                            <div class="col-12 mb-2">
                                                <label class="form-label">Search</label>
                                                <input type="text" class="form-control" name="search"
                                                    placeholder="Cari nama menu / route..." value="{{ request('search') }}">
                                            </div>

                                            <div class="col-12 mb-2">
                                                <label class="form-label">Filter Tampil</label>
                                                <select class="form-control" name="per_page">
                                                    <option value="10"
                                                        {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                                    <option value="15"
                                                        {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
                                                    <option value="25"
                                                        {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                                </select>
                                            </div>

                                            <div class="col-6">
                                                <button type="submit"
                                                    class="btn btn-gradient-primary btn-icon-only-mobile w-100"
                                                    title="Filter">
                                                    <i class="mdi mdi-filter"></i>
                                                </button>
                                            </div>
                                            <div class="col-6">
                                                <a href="{{ url()->current() }}"
                                                    class="btn btn-gradient-secondary btn-icon-only-mobile w-100"
                                                    title="Reset">
                                                    <i class="mdi mdi-refresh"></i>
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
                                        <th>Nama Menu</th>
                                        <th>Route/Link</th>
                                        <th>Menu Induk (Parent)</th>
                                        <th>Posisi (Hak Akses)</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($menus as $index => $item)
                                        <tr>
                                            <td class="text-center fw-bold">
                                                {{ method_exists($menus, 'firstItem') ? $menus->firstItem() + $index : $index + 1 }}
                                            </td>

                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if ($item->icon)
                                                        <i class="mdi {{ $item->icon }} text-primary me-2"
                                                            style="font-size: 1.2rem;"></i>
                                                    @else
                                                        <i class="mdi mdi-menu text-primary me-2"
                                                            style="font-size: 1.2rem;"></i>
                                                    @endif
                                                    <span class="fw-bold">{{ $item->name }}</span>
                                                </div>
                                            </td>

                                            <td>
                                                @if ($item->route)
                                                    <span class="route-text">{{ $item->route }}</span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>

                                            <td>
                                                @if ($item->parent)
                                                    <span class="badge-parent">
                                                        <i class="mdi mdi-file-tree me-1"></i>{{ $item->parent->name }}
                                                    </span>
                                                @else
                                                    <span class="badge-parent">
                                                        <i class="mdi mdi-home-outline me-1"></i>Menu Utama
                                                    </span>
                                                @endif
                                            </td>

                                            <td>
                                                @forelse($item->positions as $pos)
                                                    <span class="badge-position">{{ $pos->name }}</span>
                                                @empty
                                                    <span class="text-danger small">Belum ada akses</span>
                                                @endforelse
                                            </td>

                                            <td class="text-center">
                                                <button type="button" class="btn-action edit" title="Edit UI"
                                                    onclick="openEditModal(
                                                    '{{ $item->id }}',
                                                    '{{ addslashes($item->name) }}',
                                                    '{{ addslashes($item->route ?? '') }}'
                                                )">
                                                    <i class="mdi mdi-pencil"></i>
                                                </button>

                                                <button type="button" class="btn-action setting" title="Pengaturan UI"
                                                    onclick="openAccessModal(
                                                    '{{ $item->id }}',
                                                    '{{ addslashes($item->name) }}'
                                                )">
                                                    <i class="mdi mdi-cog-outline"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted py-4">
                                                Tidak ada data menu
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                            <div class="pagination-info mb-2 mb-sm-0">
                                @if (method_exists($menus, 'total'))
                                    Menampilkan {{ $menus->firstItem() ?? 0 }} - {{ $menus->lastItem() ?? 0 }} dari
                                    {{ $menus->total() }} data
                                @else
                                    Menampilkan 1 - {{ count($menus) }} dari {{ count($menus) }} data
                                @endif
                            </div>

                            @if (method_exists($menus, 'links'))
                                <div>
                                    {{ $menus->appends(request()->query())->links() }}
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="editMenuModal" tabindex="-1" aria-labelledby="editMenuModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editMenuModalLabel">
                        <i class="mdi mdi-pencil-circle me-2"></i>Edit Menu UI
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form onsubmit="return submitEditMenu(event)">
                    <div class="modal-body">
                        <input type="hidden" id="edit_menu_id">

                        <div class="mb-3">
                            <label class="form-label">Nama Menu</label>
                            <input type="text" class="form-control" id="edit_menu_name" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Route / Link</label>
                            <input type="text" class="form-control" id="edit_menu_route">
                        </div>

                        <small class="text-muted">Modal ini masih simulasi UI, belum tersimpan ke database.</small>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">
                            <i class="mdi mdi-close me-1"></i>Batal
                        </button>
                        <button type="submit" class="btn btn-gradient-primary">
                            <i class="mdi mdi-content-save me-1"></i>Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="accessMenuModal" tabindex="-1" aria-labelledby="accessMenuModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="accessMenuModalLabel">
                        <i class="mdi mdi-cog-outline me-2"></i>Pengaturan Menu UI
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('menu.store_positions') }}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <input type="hidden" name="menu_id" id="access_menu_id">

                        <div class="mb-3">
                            <label class="form-label">Nama Menu</label>
                            <input type="text" class="form-control" id="access_menu_name" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Posisi / Hak Akses</label>

                            <select class="form-control" name="position_ids[]" id="access_position" multiple required>
                                {{-- Looping data posisi dari database --}}
                                @foreach ($positions as $pos)
                                    <option value="{{ $pos->id }}">{{ $pos->name }}</option>
                                @endforeach
                            </select>
                            <small class="text-info mt-1 d-block">
                                <i class="mdi mdi-information-outline"></i> Tahan tombol Ctrl (Windows) / Cmd (Mac) untuk
                                memilih lebih dari 1 posisi.
                            </small>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">
                            <i class="mdi mdi-close me-1"></i>Batal
                        </button>
                        <button type="submit" class="btn btn-gradient-primary">
                            <i class="mdi mdi-content-save me-1"></i>Simpan Ke Database
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function openEditModal(id, name, route) {
            document.getElementById('edit_menu_id').value = id;
            document.getElementById('edit_menu_name').value = name;
            document.getElementById('edit_menu_route').value = route;

            const modal = new bootstrap.Modal(document.getElementById('editMenuModal'));
            modal.show();
        }

        function submitEditMenu(event) {
            event.preventDefault();

            const modalEl = document.getElementById('editMenuModal');
            const modalInstance = bootstrap.Modal.getInstance(modalEl);
            if (modalInstance) modalInstance.hide();

            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Simulasi edit menu berhasil dijalankan.',
                confirmButtonColor: '#9a55ff'
            });

            return false;
        }

        function openAccessModal(id, name) {
            document.getElementById('access_menu_id').value = id;
            document.getElementById('access_menu_name').value = name;
            document.getElementById('access_position').value = '';

            const modal = new bootstrap.Modal(document.getElementById('accessMenuModal'));
            modal.show();
        }

        function submitAccessMenu(event) {
            event.preventDefault();

            const modalEl = document.getElementById('accessMenuModal');
            const modalInstance = bootstrap.Modal.getInstance(modalEl);
            if (modalInstance) modalInstance.hide();

            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Simulasi pengaturan menu berhasil dijalankan.',
                confirmButtonColor: '#9a55ff'
            });

            return false;
        }
    </script>
@endpush
