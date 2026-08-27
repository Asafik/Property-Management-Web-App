@extends('layouts.partial.app')

@section('title', 'Manajemen Promo - Property Management App')

@section('content')

<div class="container-fluid px-1 px-sm-2 px-md-3 py-2 py-md-3">

    <!-- Header Card Banner -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 header-card">
                <div class="card-body p-4 p-md-4 py-4 py-md-4 d-flex justify-content-between align-items-center" style="min-height: 105px;">
                    <div>
                        <h3 class="text-dark mb-1 fw-bold" style="font-size: 1.35rem;">
                            Manajemen Promo
                        </h3>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">
                            Kelola master data promo diskon, biaya tambahan, dan fasilitas unit
                        </p>
                    </div>
                    <div class="d-none d-sm-block pe-2">
                        <i class="mdi mdi-tag-multiple-outline" style="font-size: 3rem; color: #9a55ff; opacity: 0.25;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-format-list-bulleted me-2"></i>Daftar Master Promo
                    </h5>
                    <button type="button" class="btn btn-sm btn-gradient-primary d-flex align-items-center gap-1 shadow-sm" onclick="openModal('tambah')">
                        <i class="mdi mdi-plus-circle" style="font-size: 1rem;"></i>
                        <span>Tambah Promo</span>
                    </button>
                </div>

                <div class="card-body">
                    <!-- Filter Section -->
                    <div class="filter-card mb-3">
                        <!-- Desktop Version -->
                        <div class="filter-row-desktop d-none d-md-block">
                            <form id="filterForm" method="GET" action="{{ route('promo.index') }}" onsubmit="return showFilterLoading()">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                    <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                        <!-- Search -->
                                        <div style="min-width: 200px; max-width: 260px; flex: 1;">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="search" id="searchInput"
                                                    placeholder="Cari nama promo..."
                                                    value="{{ request('search') }}"
                                                    style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                                <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                    type="submit" title="Cari"
                                                    style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                    <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Kategori -->
                                        <div style="width: 155px;">
                                            <select class="form-control" name="category" id="categorySelect">
                                                <option value="">Semua Kategori</option>
                                                <option value="promo" {{ request('category') == 'promo' ? 'selected' : '' }}>Promo</option>
                                                <option value="biaya" {{ request('category') == 'biaya' ? 'selected' : '' }}>Biaya Tambahan</option>
                                                <option value="fasilitas" {{ request('category') == 'fasilitas' ? 'selected' : '' }}>Fasilitas</option>
                                            </select>
                                        </div>

                                        <!-- Tipe -->
                                        <div style="width: 140px;">
                                            <select class="form-control" name="type" id="typeSelect">
                                                <option value="">Semua Tipe</option>
                                                <option value="persen" {{ request('type') == 'persen' ? 'selected' : '' }}>Persentase</option>
                                                <option value="nominal" {{ request('type') == 'nominal' ? 'selected' : '' }}>Nominal</option>
                                            </select>
                                        </div>

                                        <!-- Status -->
                                        <div style="width: 135px;">
                                            <select class="form-control" name="status" id="statusSelect">
                                                <option value="">Semua Status</option>
                                                <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                                <option value="tidak_aktif" {{ request('status') == 'tidak_aktif' ? 'selected' : '' }}>Nonaktif</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Right Limit & Buttons -->
                                    <div class="d-flex align-items-center gap-2 ms-auto">
                                        <div style="width: 110px;">
                                            <select class="form-control" name="per_page" id="perPageSelect">
                                                <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 data</option>
                                                <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15 data</option>
                                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 data</option>
                                                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 data</option>
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-gradient-primary btn-icon-only" title="Filter">
                                            <i class="mdi mdi-filter"></i>
                                        </button>
                                        <a href="{{ route('promo.index') }}" class="btn btn-gradient-secondary btn-icon-only" title="Reset" onclick="showResetLoading(event)">
                                            <i class="mdi mdi-refresh"></i>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Mobile Version -->
                        <div class="filter-row-mobile d-block d-md-none">
                            <form method="GET" action="{{ route('promo.index') }}" onsubmit="return showFilterLoading()">
                                <div class="row g-2">
                                    <div class="col-12 mb-2">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" id="searchInputMobile"
                                                placeholder="Cari nama promo..."
                                                value="{{ request('search') }}"
                                                style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                            <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                type="submit" title="Cari"
                                                style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <select class="form-control" name="category" id="kategoriSelectMobile">
                                            <option value="">Semua Kategori</option>
                                            <option value="promo" {{ request('category') == 'promo' ? 'selected' : '' }}>Promo</option>
                                            <option value="biaya" {{ request('category') == 'biaya' ? 'selected' : '' }}>Biaya Tambahan</option>
                                            <option value="fasilitas" {{ request('category') == 'fasilitas' ? 'selected' : '' }}>Fasilitas</option>
                                        </select>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <select class="form-control" name="type" id="typeSelectMobile">
                                            <option value="">Semua Tipe</option>
                                            <option value="persen" {{ request('type') == 'persen' ? 'selected' : '' }}>Persentase</option>
                                            <option value="nominal" {{ request('type') == 'nominal' ? 'selected' : '' }}>Nominal</option>
                                        </select>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <select class="form-control" name="status" id="statusSelectMobile">
                                            <option value="">Semua Status</option>
                                            <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                            <option value="tidak_aktif" {{ request('status') == 'tidak_aktif' ? 'selected' : '' }}>Nonaktif</option>
                                        </select>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <select class="form-control" name="per_page" id="perPageSelectMobile">
                                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 data</option>
                                            <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15 data</option>
                                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 data</option>
                                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 data</option>
                                        </select>
                                    </div>

                                    <div class="col-6">
                                        <button type="submit" class="btn btn-gradient-primary w-100 d-flex align-items-center justify-content-center gap-1">
                                            <i class="mdi mdi-filter"></i> Filter
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('promo.index') }}" class="btn btn-gradient-secondary w-100 d-flex align-items-center justify-content-center gap-1" onclick="showResetLoading(event)">
                                            <i class="mdi mdi-refresh"></i> Reset
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Tabel Data Promo -->
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
                                    <th>Periode</th>
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
                                                <i class="mdi mdi-tag-outline text-primary me-2" style="font-size: 1.2rem;"></i>
                                                <span class="fw-bold">{{ $item->name }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            @if($item->category == 'promo')
                                                <span class="badge-category" style="background: rgba(154, 85, 255, 0.1); color: #9a55ff; border-color: rgba(154, 85, 255, 0.2);">
                                                    <i class="mdi mdi-sale me-1"></i>Promo
                                                </span>
                                            @elseif($item->category == 'biaya')
                                                <span class="badge-category" style="background: rgba(255, 193, 7, 0.15); color: #b78103; border-color: rgba(255, 193, 7, 0.3);">
                                                    <i class="mdi mdi-cash-plus me-1"></i>Biaya Tambahan
                                                </span>
                                            @else
                                                <span class="badge-category" style="background: rgba(23, 162, 184, 0.1); color: #17a2b8; border-color: rgba(23, 162, 184, 0.2);">
                                                    <i class="mdi mdi-home-outline me-1"></i>Fasilitas
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->type == 'persen')
                                                <span class="badge bg-light text-dark fw-semibold px-2 py-1 border" style="font-size: 0.78rem;">
                                                    <i class="mdi mdi-percent me-1 text-primary"></i>Persentase
                                                </span>
                                            @else
                                                <span class="badge bg-light text-dark fw-semibold px-2 py-1 border" style="font-size: 0.78rem;">
                                                    <i class="mdi mdi-currency-usd me-1 text-success"></i>Nominal
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->type == 'persen')
                                                <span class="fw-bold text-success" style="font-size: 0.92rem;">{{ $item->value }}%</span>
                                            @else
                                                <span class="fw-bold text-dark" style="font-size: 0.92rem;">Rp {{ number_format($item->value, 0, ',', '.') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->validity_period == 'selalu')
                                                <span class="badge bg-light text-dark fw-semibold px-2 py-1 border" style="font-size: 0.78rem;">
                                                    <i class="mdi mdi-check-all text-success me-1"></i>Selalu
                                                </span>
                                            @else
                                                <span class="badge bg-light text-dark fw-semibold px-2 py-1 border" style="font-size: 0.78rem;">
                                                    <i class="mdi mdi-calendar-range text-primary me-1"></i>Periode
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->validity_period == 'periode')
                                                <span class="d-inline-flex align-items-center gap-1 text-muted" style="font-size: 0.78rem;">
                                                    <i class="mdi mdi-calendar-clock text-primary"></i>
                                                    <span>{{ Carbon\Carbon::parse($item->start_date)->format('d/m/Y') }} - {{ Carbon\Carbon::parse($item->end_date)->format('d/m/Y') }}</span>
                                                </span>
                                            @else
                                                <span class="text-muted" style="font-size: 0.8rem;">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->status == 'aktif')
                                                <span class="status-badge aktif">
                                                    <i class="mdi mdi-check-circle"></i> Aktif
                                                </span>
                                            @else
                                                <span class="status-badge nonaktif">
                                                    <i class="mdi mdi-close-circle"></i> Nonaktif
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="d-inline-flex align-items-center gap-1">
                                                <button class="btn-action edit" title="Edit Promo" onclick="openModal('edit', {{ $item->id }})">
                                                    <i class="mdi mdi-pencil"></i>
                                                </button>
                                                <button class="btn-action delete" title="Hapus Promo" onclick="confirmDelete({{ $item->id }})">
                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted py-4">
                                            <i class="mdi mdi-tag-off-outline me-2" style="font-size: 1.5rem;"></i>
                                            Belum ada data promo yang tersedia.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if ($promo instanceof \Illuminate\Pagination\LengthAwarePaginator && $promo->total() > 0)
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                            <div class="pagination-info mb-2 mb-sm-0 text-muted" style="font-size: 0.82rem;">
                                Menampilkan {{ $promo->firstItem() }} - {{ $promo->lastItem() }} dari {{ $promo->total() }} data
                            </div>
                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                    <li class="page-item {{ $promo->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $promo->previousPageUrl() }}" {{ !$promo->onFirstPage() ? 'onclick=showPaginationLoading(event)' : '' }}>
                                            <i class="mdi mdi-chevron-left"></i>
                                        </a>
                                    </li>

                                    @for($page = 1; $page <= $promo->lastPage(); $page++)
                                        <li class="page-item {{ $page == $promo->currentPage() ? 'active' : '' }}">
                                            @if($page == $promo->currentPage())
                                                <span class="page-link">{{ $page }}</span>
                                            @else
                                                <a class="page-link" href="{{ $promo->appends(request()->query())->url($page) }}" onclick="showPaginationLoading(event)">{{ $page }}</a>
                                            @endif
                                        </li>
                                    @endfor

                                    <li class="page-item {{ $promo->hasMorePages() ? '' : 'disabled' }}">
                                        <a class="page-link" href="{{ $promo->nextPageUrl() }}" {{ $promo->hasMorePages() ? 'onclick=showPaginationLoading(event)' : '' }}>
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

<!-- Modal Tambah/Edit Promo -->
<div class="modal fade" id="modalPromo" tabindex="-1" aria-labelledby="modalPromoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-white border-bottom">
                <h5 class="modal-title fw-bold" id="modalPromoLabel" style="color: #2c2e3f;">
                    <i class="mdi mdi-plus-circle me-2" id="modalIcon" style="color: #9a55ff;"></i>
                    <span id="modalTitle">Tambah Promo</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formPromo" method="POST" action="{{ route('promo.store') }}">
                @csrf
                <input type="hidden" name="_method" id="methodField" value="POST">
                <input type="hidden" id="promoId" name="id">

                <div class="modal-body p-4">
                    <!-- Nama Promo -->
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color: #2c2e3f;">Nama Promo <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" id="namaPromo" placeholder="Contoh: Diskon Early Bird" value="{{ old('name') }}" required>
                    </div>

                    <!-- Kategori -->
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color: #2c2e3f;">Kategori <span class="text-danger">*</span></label>
                        <select class="form-control" name="category" id="kategori" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="promo">Promo</option>
                            <option value="biaya">Biaya Tambahan</option>
                            <option value="fasilitas">Fasilitas</option>
                        </select>
                    </div>

                    <!-- Tipe dan Nilai -->
                    <div class="row g-2">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold" style="color: #2c2e3f;">Tipe <span class="text-danger">*</span></label>
                            <select class="form-control" name="type" id="tipe" onchange="ubahTipe()" required>
                                <option value="">-- Pilih Tipe --</option>
                                <option value="persen">Persentase (%)</option>
                                <option value="nominal">Nominal (Rp)</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold" style="color: #2c2e3f;" id="labelNilai">Nilai <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border fw-bold text-primary" id="iconNilai" style="border-radius: 8px 0 0 8px;">#</span>
                                <input type="text" class="form-control" name="value" id="nilai" placeholder="0" value="{{ old('value') }}" required style="border-radius: 0 8px 8px 0;">
                            </div>
                        </div>
                    </div>

                    <!-- Berlaku -->
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color: #2c2e3f;">Masa Berlaku <span class="text-danger">*</span></label>
                        <select class="form-control" name="validity_period" id="berlaku" onchange="ubahBerlaku()" required>
                            <option value="">-- Pilih Masa Berlaku --</option>
                            <option value="selalu">Selalu Aktif</option>
                            <option value="periode">Periode Tertentu</option>
                        </select>
                    </div>

                    <!-- Periode Container -->
                    <div class="row g-2 p-3 bg-light rounded-3 mb-3 border" id="periodeContainer" style="display: none;">
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-dark" style="font-size: 0.82rem;">Tanggal Mulai <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="start_date" id="tanggalMulai" value="{{ old('start_date') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-dark" style="font-size: 0.82rem;">Tanggal Berakhir <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="end_date" id="tanggalBerakhir" value="{{ old('end_date') }}">
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color: #2c2e3f;">Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="aktif">Aktif</option>
                            <option value="tidak_aktif">Nonaktif</option>
                        </select>
                    </div>

                    <!-- Keterangan -->
                    <div class="mb-0">
                        <label class="form-label fw-bold" style="color: #2c2e3f;">Keterangan / Deskripsi</label>
                        <textarea class="form-control" name="description" id="keterangan" rows="2" placeholder="Tuliskan keterangan promo...">{{ old('description') }}</textarea>
                    </div>
                </div>

                <div class="modal-footer bg-light border-top">
                    <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-gradient-primary btn-sm px-4" id="submitBtn" onclick="showSubmitLoading()">
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

    @if (session('success'))
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

function ubahTipe() {
    let tipe = document.getElementById('tipe').value;
    let iconNilai = document.getElementById('iconNilai');
    let labelNilai = document.getElementById('labelNilai');

    if (tipe === 'persen') {
        iconNilai.innerHTML = '%';
        labelNilai.innerHTML = 'Nilai (%) <span class="text-danger">*</span>';
    } else if (tipe === 'nominal') {
        iconNilai.innerHTML = 'Rp';
        labelNilai.innerHTML = 'Nilai (Rp) <span class="text-danger">*</span>';
    } else {
        iconNilai.innerHTML = '#';
    }
}

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

function openModal(type, id = null) {
    if (type === 'tambah') {
        $('#formPromo')[0].reset();
        $('#promoId').val('');
        $('#methodField').val('POST');
        $('#formPromo').attr('action', '{{ route("promo.store") }}');

        document.getElementById('periodeContainer').style.display = 'none';
        document.getElementById('iconNilai').innerHTML = '#';

        $('#modalTitle').text('Tambah Promo');
        $('#modalIcon').removeClass('mdi-pencil').addClass('mdi-plus-circle');
        $('#btnText').text('Simpan');
        $('#btnIcon').removeClass('mdi-pencil').addClass('mdi-content-save');

        $('#modalPromo').modal('show');
    } else {
        Swal.fire({
            title: 'Mohon tunggu...',
            html: 'Sedang mengambil data promo',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        $.get('{{ url("master-data-promo/get") }}/' + id, function(response) {
            Swal.close();

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

                ubahTipe();
                ubahBerlaku();

                $('#modalTitle').text('Edit Promo');
                $('#modalIcon').removeClass('mdi-plus-circle').addClass('mdi-pencil');
                $('#btnText').text('Update');
                $('#btnIcon').removeClass('mdi-content-save').addClass('mdi-pencil');

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

function confirmDelete(id) {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "Data promo ini akan dihapus permanen!",
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
                html: 'Sedang menghapus data promo',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

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
