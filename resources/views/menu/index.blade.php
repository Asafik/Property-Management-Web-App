@extends('layouts.partial.app')

@section('title', 'Role & Permission - Property Management App')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-clean.css') }}?v={{ time() }}">
    <style>
        /* ===== ROLE & PERMISSION STYLES (PERSIS KATALOG UNIT) ===== */
        .btn-outline-primary {
            background: transparent;
            border: 1px solid #9a55ff;
            color: #9a55ff;
            padding: 0.35rem 0.65rem;
            border-radius: 6px;
            font-size: 0.78rem;
            font-weight: 600;
            transition: all 0.2s ease;
        }
        .btn-outline-primary:hover {
            background: #9a55ff;
            color: #ffffff;
            border-color: #9a55ff;
        }

        .btn-outline-secondary {
            background: transparent;
            border: 1px solid #94a3b8;
            color: #64748b;
            padding: 0.35rem 0.65rem;
            border-radius: 6px;
            font-size: 0.78rem;
            font-weight: 600;
            transition: all 0.2s ease;
        }
        .btn-outline-secondary:hover {
            background: #64748b;
            color: #ffffff;
            border-color: #64748b;
        }

        /* Solid Buttons - 1 Warna, Tanpa Gradient */
        .btn-gradient-primary {
            background: #9a55ff !important;
            border-color: #9a55ff !important;
            color: #ffffff !important;
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
        }
        .btn-gradient-secondary:hover {
            background: #475569 !important;
            border-color: #475569 !important;
            color: #ffffff !important;
        }

        .btn-icon-only {
            width: 38px;
            height: 38px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
        }
        .btn-icon-only i {
            font-size: 1.15rem;
            margin: 0;
        }

        /* Card Compact Persis Catalog Unit */
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
            box-shadow: none !important;
        }

        /* Table Styling Persis Catalog Unit */
        .table-permission {
            width: 100% !important;
            margin-bottom: 0;
            border-collapse: collapse;
        }
        .table-permission thead th {
            background: #f8fafc !important;
            color: #4b5563 !important;
            font-weight: 700;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e2e8f0 !important;
            padding: 0.8rem 0.65rem !important;
            vertical-align: middle;
            white-space: nowrap;
        }
        .table-permission tbody td {
            padding: 0.8rem 0.65rem !important;
            vertical-align: middle;
            font-size: 0.83rem;
            border-bottom: 1px solid #f1f5f9;
            color: #1e293b;
        }
        .table-permission tbody tr:hover {
            background-color: #faf8ff !important;
        }

        /* Action Button Persis Catalog Unit */
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

        /* Position Checkbox Card in Modal */
        .position-check-card {
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 0.6rem 0.75rem;
            background: #ffffff;
            transition: all 0.15s ease;
            cursor: pointer;
            user-select: none;
        }
        .position-check-card:hover {
            border-color: #9a55ff;
            background: #faf8ff;
        }
        .position-check-card.checked {
            border-color: #9a55ff;
            background: #f5f0ff;
        }

        /* Badge Custom */
        .badge-pos {
            background: #ecfdf5;
            color: #059669;
            border: 1px solid #a7f3d0;
            font-weight: 600;
            font-size: 0.75rem;
            padding: 0.28rem 0.55rem;
            border-radius: 5px;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }
        .badge-parent {
            background: #e0f2fe;
            color: #0284c7;
            border: 1px solid #bae6fd;
            font-weight: 600;
            font-size: 0.75rem;
            padding: 0.28rem 0.55rem;
            border-radius: 5px;
            display: inline-flex;
            align-items: center;
        }
        .badge-main {
            background: #f3e8ff;
            color: #9333ea;
            border: 1px solid #e9d5ff;
            font-weight: 600;
            font-size: 0.75rem;
            padding: 0.28rem 0.55rem;
            border-radius: 5px;
            display: inline-flex;
            align-items: center;
        }
    </style>
@endpush

@section('content')

<div class="container-fluid px-2 px-md-4 py-3">

    <!-- Alert Notifikasi Flash -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 mb-3" role="alert" style="border-radius: 8px;">
            <i class="mdi mdi-check-circle fs-5"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Page Title & Subtitle (Persis Catalog Unit - Tanpa Card Banner) -->
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
        <div>
            <h2 class="text-dark mb-1 fw-bold" style="font-size: 1.55rem; letter-spacing: -0.02em;">
                Role & Permission
            </h2>
            <p class="text-muted mb-0" style="font-size: 0.88rem;">
                Kelola pemetaan hak akses dan perizinan menu sistem per posisi jabatan
            </p>
        </div>
    </div>


    <!-- Tabel Data Hak Akses Menu (Compact Table Card Persis Catalog Unit) -->
    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card compact-table-card">
                <!-- Header Card Persis Catalog Unit -->
                <div class="card-header bg-white d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center py-2.5 px-3 px-md-4 gap-2" style="border-bottom: 1px solid #e2e8f0 !important;">
                    <div class="d-flex align-items-center gap-2">
                        <div style="width: 32px; height: 32px; border-radius: 6px; background-color: #f3e8ff; color: #9333ea; display: inline-flex; align-items: center; justify-content: center; font-size: 1.15rem; flex-shrink: 0;">
                            <i class="mdi mdi-shield-key-outline"></i>
                        </div>
                        <span style="font-size: 0.95rem; font-weight: 700; color: #0f172a;">Daftar Hak Akses Menu</span>
                    </div>
                </div>

                <div class="card-body p-3 p-md-4">
                    <!-- Filter Section Persis Catalog Unit -->
                    <div class="filter-card mb-3">
                        <!-- Desktop Version -->
                        <div class="filter-row-desktop d-none d-lg-block">
                            <form id="filterForm" method="GET" action="{{ route('master.data.menu') }}" onsubmit="return showFilterLoading()">
                                <div class="row g-2 align-items-center w-100 m-0">
                                    <!-- Search Input -->
                                    <div class="col-lg-4 p-0 pe-2">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" id="searchInput"
                                                placeholder="Cari nama menu atau route..."
                                                value="{{ request('search') }}"
                                                style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none; height: 38px;">
                                            <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                type="submit" title="Cari"
                                                style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 6px !important; border-bottom-right-radius: 6px !important; height: 38px; box-shadow: none;">
                                                <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Filter Menu Induk (Parent) -->
                                    <div class="col-lg-3 p-0 pe-2">
                                        <select class="form-control" name="parent_id" style="height: 38px; border-radius: 6px;">
                                            <option value="">Semua Kategori (Induk)</option>
                                            <option value="main" {{ request('parent_id') == 'main' ? 'selected' : '' }}>Menu Utama (Tanpa Induk)</option>
                                            @foreach ($parentMenus as $parent)
                                                <option value="{{ $parent->id }}" {{ request('parent_id') == $parent->id ? 'selected' : '' }}>
                                                    {{ $parent->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Filter Posisi / Jabatan -->
                                    <div class="col-lg-3 p-0 pe-2">
                                        <select class="form-control" name="position_id" style="height: 38px; border-radius: 6px;">
                                            <option value="">Semua Posisi / Jabatan</option>
                                            @foreach ($positions as $pos)
                                                <option value="{{ $pos->id }}" {{ request('position_id') == $pos->id ? 'selected' : '' }}>
                                                    {{ $pos->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Per Page & Action Buttons -->
                                    <div class="col-lg-2 p-0 d-flex align-items-center justify-content-end gap-2 ms-auto">
                                        <div style="width: 95px;">
                                            <select class="form-control" name="per_page" id="perPageSelect" style="height: 38px; border-radius: 6px;">
                                                <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 data</option>
                                                <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15 data</option>
                                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 data</option>
                                                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 data</option>
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-gradient-primary btn-icon-only" title="Filter">
                                            <i class="mdi mdi-filter"></i>
                                        </button>
                                        <a href="{{ route('master.data.menu') }}" class="btn btn-gradient-secondary btn-icon-only" title="Reset" onclick="showResetLoading(event)">
                                            <i class="mdi mdi-refresh"></i>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Mobile Version -->
                        <div class="filter-row-mobile d-block d-lg-none">
                            <form method="GET" action="{{ route('master.data.menu') }}" onsubmit="return showFilterLoading()">
                                <div class="row g-2">
                                    <div class="col-12 mb-2">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" id="searchInputMobile"
                                                placeholder="Cari nama menu atau route..."
                                                value="{{ request('search') }}"
                                                style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none; height: 38px;">
                                            <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                type="submit" title="Cari"
                                                style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 6px !important; border-bottom-right-radius: 6px !important; height: 38px; box-shadow: none;">
                                                <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <select class="form-control" name="parent_id" style="height: 38px; border-radius: 6px;">
                                            <option value="">Semua Kategori (Induk)</option>
                                            <option value="main" {{ request('parent_id') == 'main' ? 'selected' : '' }}>Menu Utama (Tanpa Induk)</option>
                                            @foreach ($parentMenus as $parent)
                                                <option value="{{ $parent->id }}" {{ request('parent_id') == $parent->id ? 'selected' : '' }}>
                                                    {{ $parent->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <select class="form-control" name="position_id" style="height: 38px; border-radius: 6px;">
                                            <option value="">Semua Posisi / Jabatan</option>
                                            @foreach ($positions as $pos)
                                                <option value="{{ $pos->id }}" {{ request('position_id') == $pos->id ? 'selected' : '' }}>
                                                    {{ $pos->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <select class="form-control" name="per_page" style="height: 38px; border-radius: 6px;">
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
                                        <a href="{{ route('master.data.menu') }}" class="btn btn-gradient-secondary w-100 d-flex align-items-center justify-content-center gap-1" onclick="showResetLoading(event)" style="height: 38px; border-radius: 6px;">
                                            <i class="mdi mdi-refresh"></i> Reset
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Tabel Data Menu & Permission -->
                    <div class="table-responsive" style="border-radius: 8px;">
                        <table class="table table-permission align-middle">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 50px;">NO</th>
                                    <th>NAMA MENU</th>
                                    <th>ROUTE / URL</th>
                                    <th>MENU INDUK (PARENT)</th>
                                    <th>POSISI / HAK AKSES</th>
                                    <th class="text-center" style="width: 75px;">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($menus as $index => $item)
                                    <tr>
                                        <td class="text-center fw-bold" style="color: #64748b;">
                                            {{ method_exists($menus, 'firstItem') ? $menus->firstItem() + $index : $index + 1 }}
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div style="width: 30px; height: 30px; border-radius: 6px; background-color: #f3e8ff; color: #9a55ff; display: inline-flex; align-items: center; justify-content: center; font-size: 1.05rem; flex-shrink: 0;">
                                                    <i class="mdi {{ $item->icon ?: 'mdi-menu' }}"></i>
                                                </div>
                                                <span class="fw-bold text-dark" style="font-size: 0.88rem;">{{ $item->name }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($item->route)
                                                <code style="padding: 3px 8px; border-radius: 5px; background: #f1f5f9; color: #6366f1; border: 1px solid #e2e8f0; font-size: 0.78rem; font-weight: 600;">
                                                    {{ $item->route }}
                                                </code>
                                            @else
                                                <span class="text-muted" style="font-size: 0.8rem; font-style: italic;">(Header / Dropdown)</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->parent)
                                                <span class="badge-parent">
                                                    <i class="mdi mdi-file-tree me-1"></i>{{ $item->parent->name }}
                                                </span>
                                            @else
                                                <span class="badge-main">
                                                    <i class="mdi mdi-home-outline me-1"></i>Menu Utama
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-1">
                                                @forelse($item->positions as $pos)
                                                    <span class="badge-pos">
                                                        {{ $pos->name }}
                                                    </span>
                                                @empty
                                                    <span class="text-muted small">
                                                        <i class="mdi mdi-lock-outline me-1"></i>Belum ada akses
                                                    </span>
                                                @endforelse
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn-action edit"
                                                data-bs-toggle="modal"
                                                data-bs-target="#accessMenuModal"
                                                title="Ubah Hak Akses Posisi"
                                                onclick="editAksesMenu('{{ $item->id }}', '{{ addslashes($item->name) }}', {{ json_encode($item->positions->pluck('id')->toArray()) }})">
                                                <i class="mdi mdi-key-variant"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-5">
                                            <i class="mdi mdi-information-outline me-2 fs-5"></i>Tidak ada data menu ditemukan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Persis Catalog Unit -->
                    @if ($menus instanceof \Illuminate\Pagination\LengthAwarePaginator && $menus->total() > 0)
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                            <div class="pagination-info mb-2 mb-sm-0 text-muted" style="font-size: 0.82rem;">
                                Menampilkan {{ $menus->firstItem() ?? 0 }} - {{ $menus->lastItem() ?? 0 }} dari {{ $menus->total() }} data
                            </div>

                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                    <li class="page-item {{ $menus->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $menus->previousPageUrl() }}" {{ !$menus->onFirstPage() ? 'onclick=showPaginationLoading(event)' : '' }}>
                                            <i class="mdi mdi-chevron-left"></i>
                                        </a>
                                    </li>

                                    @for($page = 1; $page <= $menus->lastPage(); $page++)
                                        <li class="page-item {{ $page == $menus->currentPage() ? 'active' : '' }}">
                                            @if($page == $menus->currentPage())
                                                <span class="page-link" style="background-color: #9a55ff; border-color: #9a55ff; color: #fff;">{{ $page }}</span>
                                            @else
                                                <a class="page-link" href="{{ $menus->appends(request()->query())->url($page) }}" onclick="showPaginationLoading(event)">{{ $page }}</a>
                                            @endif
                                        </li>
                                    @endfor

                                    <li class="page-item {{ $menus->hasMorePages() ? '' : 'disabled' }}">
                                        <a class="page-link" href="{{ $menus->nextPageUrl() }}" {{ $menus->hasMorePages() ? 'onclick=showPaginationLoading(event)' : '' }}>
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

<!-- Modal Hak Akses Menu Modern Persis Catalog Unit (Lebar Pas & Rapi) -->
<div class="modal fade" id="accessMenuModal" tabindex="-1" aria-labelledby="accessMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 520px;">
        <div class="modal-content border-0 shadow" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header py-3 px-4 bg-white" style="border-bottom: 1px solid #e2e8f0;">
                <div class="d-flex align-items-center gap-2">
                    <div style="width: 32px; height: 32px; border-radius: 6px; background-color: #f3e8ff; color: #9a55ff; display: inline-flex; align-items: center; justify-content: center; font-size: 1.15rem;">
                        <i class="mdi mdi-shield-key-outline"></i>
                    </div>
                    <h5 class="modal-title fw-bold mb-0" id="accessMenuModalLabel" style="color: #0f172a; font-size: 1.05rem;">
                        Pengaturan Hak Akses Menu
                    </h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('menu.store_positions') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <input type="hidden" name="menu_id" id="access_menu_id">

                    <!-- Nama Menu Field -->
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color: #0f172a; font-size: 0.88rem;">Nama Menu</label>
                        <input type="text" class="form-control bg-light" id="access_menu_name" readonly style="border-radius: 6px; font-weight: 600; color: #334155; height: 38px;">
                    </div>

                    <!-- Checklist Posisi Jabatan Grid -->
                    <div class="mb-2">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label class="form-label fw-bold mb-0" style="color: #0f172a; font-size: 0.85rem;">
                                Posisi / Jabatan yang Diberikan Izin:
                            </label>
                            <div class="d-flex gap-1">
                                <button type="button" class="btn btn-outline-primary" style="padding: 2px 8px; font-size: 0.74rem;" onclick="selectAllPositions()">
                                    <i class="mdi mdi-checkbox-multiple-marked-outline me-1"></i>Pilih Semua
                                </button>
                                <button type="button" class="btn btn-outline-secondary" style="padding: 2px 8px; font-size: 0.74rem;" onclick="deselectAllPositions()">
                                    <i class="mdi mdi-checkbox-multiple-blank-outline me-1"></i>Hapus Semua
                                </button>
                            </div>
                        </div>

                        <!-- Checkbox Container Grid (2 Kolom Rapi) -->
                        <div style="max-height: 270px; overflow-y: auto; padding: 10px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px;">
                            <div class="row g-2" id="positionChecklistContainer">
                                @foreach ($positions as $pos)
                                    <div class="col-12 col-sm-6">
                                        <label class="position-check-card d-flex align-items-center gap-2 mb-0" for="pos_chk_{{ $pos->id }}">
                                            <input type="checkbox" name="position_ids[]" value="{{ $pos->id }}" id="pos_chk_{{ $pos->id }}" class="pos-checkbox form-check-input mt-0" style="width: 17px; height: 17px; accent-color: #9a55ff; cursor: pointer;" onchange="updateCardCheckState(this)">
                                            <span class="fw-semibold text-dark" style="font-size: 0.82rem;">{{ $pos->name }}</span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <small class="text-muted mt-2 d-block" style="font-size: 0.75rem;">
                            <i class="mdi mdi-information-outline me-1 text-primary"></i>Centang jabatan yang diperbolehkan mengakses menu ini.
                        </small>
                    </div>
                </div>

                <div class="modal-footer bg-light border-top py-3 px-4">
                    <button type="button" class="btn btn-outline-secondary px-3" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-gradient-primary px-4" style="height: 38px; border-radius: 6px; font-weight: 600;">
                        <i class="mdi mdi-content-save me-1"></i>Simpan Perubahan
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

function showFilterLoading() {
    Swal.fire({
        title: 'Memuat...',
        html: 'Sedang memfilter data menu',
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

function updateCardCheckState(checkbox) {
    const card = checkbox.closest('.position-check-card');
    if (card) {
        if (checkbox.checked) {
            card.classList.add('checked');
        } else {
            card.classList.remove('checked');
        }
    }
}

function selectAllPositions() {
    document.querySelectorAll('.pos-checkbox').forEach(chk => {
        chk.checked = true;
        updateCardCheckState(chk);
    });
}

function deselectAllPositions() {
    document.querySelectorAll('.pos-checkbox').forEach(chk => {
        chk.checked = false;
        updateCardCheckState(chk);
    });
}

function editAksesMenu(id, name, positionIds) {
    document.getElementById('access_menu_id').value = id;
    document.getElementById('access_menu_name').value = name;

    const checkboxes = document.querySelectorAll('.pos-checkbox');
    checkboxes.forEach(chk => {
        const val = parseInt(chk.value);
        if (positionIds && positionIds.includes(val)) {
            chk.checked = true;
        } else {
            chk.checked = false;
        }
        updateCardCheckState(chk);
    });
}
</script>
@endpush
