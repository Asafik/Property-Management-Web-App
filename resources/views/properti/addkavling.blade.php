@extends('layouts.partial.app')

@section('title', 'Buat Kavling - Property Management App')

@push('styles')
<style>
/* Status Badges & Action Buttons */
.badge-kavling-status {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 0.32rem 0.75rem;
    border-radius: 30px;
    font-size: 0.75rem;
    font-weight: 600;
    line-height: 1.2;
    white-space: nowrap;
}

.badge-kavling-status.status-draft {
    background: #343a40;
    color: #ffffff;
    border: 1px solid #23272b;
    box-shadow: 0 2px 4px rgba(52, 58, 64, 0.2);
}

.badge-kavling-status.status-sold {
    background: rgba(255, 87, 87, 0.15);
    color: #ff5757;
    border: 1px solid rgba(255, 87, 87, 0.3);
}

.badge-kavling-status.status-booked {
    background: rgba(255, 184, 0, 0.15);
    color: #d97706;
    border: 1px solid rgba(255, 184, 0, 0.3);
}

.badge-kavling-status.status-ready-subsidi {
    background: rgba(0, 201, 167, 0.15);
    color: #00897b;
    border: 1px solid rgba(0, 201, 167, 0.3);
}

.badge-kavling-status.status-ready-komersil {
    background: rgba(132, 94, 194, 0.15);
    color: #845ec2;
    border: 1px solid rgba(132, 94, 194, 0.3);
}

.btn-action {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border-radius: 8px;
    border: none;
    transition: all 0.2s ease;
    text-decoration: none;
    cursor: pointer;
    font-size: 0.95rem;
}

.btn-action-edit {
    background: linear-gradient(135deg, #36d1dc, #5b86e5);
    color: #ffffff !important;
    box-shadow: 0 2px 4px rgba(54, 209, 220, 0.25);
}

.btn-action-edit:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(54, 209, 220, 0.4);
    color: #ffffff !important;
}

.btn-action-view {
    background: linear-gradient(135deg, #da8cff, #9a55ff);
    color: #ffffff !important;
    box-shadow: 0 2px 4px rgba(154, 85, 255, 0.25);
}

.btn-action-view:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(154, 85, 255, 0.4);
    color: #ffffff !important;
}

.btn-action-delete {
    background: linear-gradient(135deg, #ff416c, #ff4b2b);
    color: #ffffff !important;
    box-shadow: 0 2px 4px rgba(255, 65, 108, 0.25);
}

.btn-action-delete:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(255, 65, 108, 0.4);
    color: #ffffff !important;
}

.btn-gradient-info {
    background: linear-gradient(to right, #36d1dc, #5b86e5) !important;
    color: #ffffff !important;
    border: none !important;
    box-shadow: 0 2px 5px rgba(54, 209, 220, 0.3) !important;
    transition: all 0.2s ease;
}

.btn-gradient-info:hover {
    background: linear-gradient(to right, #2abec9, #4974d0) !important;
    color: #ffffff !important;
    transform: translateY(-1px);
    box-shadow: 0 4px 10px rgba(54, 209, 220, 0.45) !important;
}

/* Custom styling untuk Denah Kavling & Modal Tabs */
.denah-container {
    background-color: #f8f9fa;
    padding: 1.25rem;
    border-radius: 12px;
    border: 1px solid #e9ecef;
}

.denah-unit-box {
    color: #ffffff;
    padding: 6px 10px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 700;
    position: relative;
    min-width: 58px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    transition: transform 0.2s ease;
}

.denah-unit-box:hover {
    transform: translateY(-2px);
}

.denah-type-badge {
    position: absolute;
    top: -6px;
    right: -6px;
    background: #1e1e2d;
    color: #ffffff;
    font-size: 8px;
    padding: 1px 4px;
    border-radius: 50%;
    border: 1px solid #ffffff;
}

.modal-tabs-wrapper {
    background: #f6f9ff;
    border-radius: 10px;
    padding: 5px;
    margin-bottom: 1.25rem;
    border: 1px solid #e9ecef;
}

.modal-tabs {
    display: flex;
    gap: 6px;
    list-style: none;
    padding: 0;
    margin: 0;
}

.modal-tab-link {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    font-size: 0.85rem;
    font-weight: 600;
    color: #6c757d;
    background: transparent;
    border: none;
    border-radius: 8px;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.2s ease;
}

.modal-tab-link:hover {
    color: #9a55ff;
    background: rgba(154, 85, 255, 0.08);
}

.modal-tab-link.active {
    color: #9a55ff;
    background: #ffffff;
    box-shadow: 0 2px 8px rgba(154, 85, 255, 0.15);
}

.modal-tab-pane {
    display: none;
}

.modal-tab-pane.active {
    display: block;
    animation: fadeInTab 0.3s ease;
}

@keyframes fadeInTab {
    from { opacity: 0; transform: translateY(6px); }
    to { opacity: 1; transform: translateY(0); }
}

.upload-dropzone-box {
    border: 2px dashed #d9dce2;
    border-radius: 12px;
    padding: 1.25rem 1rem;
    background: #fafbfc;
    text-align: center;
    transition: all 0.3s ease;
    cursor: pointer;
    position: relative;
}

.upload-dropzone-box:hover {
    border-color: #9a55ff;
    background: #fbf9ff;
}

.upload-dropzone-box input[type="file"] {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
    z-index: 5;
}

/* Interactive Siteplan Styles */
.siteplan-viewer-wrapper {
    background: #f8fafc;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    overflow: hidden;
    position: relative;
}
.siteplan-toolbar {
    background: #ffffff;
    border-bottom: 1px solid #eef2f6;
    padding: 0.5rem 0.75rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
}
.siteplan-viewport {
    height: 420px;
    overflow: auto;
    position: relative;
    background: #0f172a;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: grab;
    user-select: none;
}
.siteplan-viewport:active {
    cursor: grabbing;
}
.siteplan-img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    transition: transform 0.2s ease-out;
    transform-origin: center center;
}
.siteplan-tab-btn {
    border: 1.5px solid transparent;
    padding: 0.35rem 0.85rem;
    font-size: 0.82rem;
    font-weight: 600;
    border-radius: 20px;
    background: #f1f5f9;
    color: #64748b;
    cursor: pointer;
    transition: all 0.2s ease;
}
.siteplan-tab-btn:hover {
    background: #e2e8f0;
    color: #334155;
}
.siteplan-tab-btn.active {
    background: #9a55ff;
    color: #ffffff;
    border-color: #9a55ff;
    box-shadow: 0 2px 8px rgba(154, 85, 255, 0.25);
}
</style>
@endpush

@section('content')

<div class="container-fluid px-1 px-sm-2 px-md-3 py-2 py-md-3">

    <!-- Header Card Banner -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 header-card">
                <div class="card-body p-4 p-md-4 py-4 py-md-4 d-flex flex-wrap justify-content-between align-items-center gap-3" style="min-height: 105px;">
                    <div>
                        <h3 class="text-dark mb-1 fw-bold" style="font-size: 1.35rem;">
                            Buat Kavling / Master Unit
                        </h3>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">
                            Kelola dan pecah unit kavling dari tanah induk yang telah terverifikasi
                        </p>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <a href="{{ route('properti-all') }}" class="btn btn-sm btn-gradient-secondary d-flex align-items-center gap-1 btn-back shadow-sm px-3 py-2">
                            <i class="mdi mdi-arrow-left" style="font-size: 1rem;"></i>
                            <span>Kembali</span>
                        </a>
                        <div class="d-none d-md-block pe-2">
                            <i class="mdi mdi-pencil-ruler" style="font-size: 3rem; color: #9a55ff; opacity: 0.25;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Alert Section --}}
    @if (session('success'))
        <div class="alert alert-success border-0 shadow-sm d-flex align-items-center gap-2 mb-3 py-2 px-3" style="border-radius: 8px;">
            <i class="mdi mdi-check-circle" style="font-size: 1.25rem;"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger border-0 shadow-sm d-flex align-items-center gap-2 mb-3 py-2 px-3" style="border-radius: 8px;">
            <i class="mdi mdi-alert-circle" style="font-size: 1.25rem;"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <!-- Card 1: Informasi Tanah Induk -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex align-items-center gap-2">
                    <span class="badge bg-primary bg-opacity-10 text-primary p-2 rounded-3">
                        <i class="mdi mdi-office-building" style="font-size: 1.1rem;"></i>
                    </span>
                    <h5 class="card-title mb-0 fw-bold text-dark">Informasi Tanah Induk</h5>
                </div>
                <div class="card-body p-3 p-md-4">
                    <div class="row g-3">
                        <div class="col-sm-6 col-md-3">
                            <small class="text-muted d-block mb-1">
                                <i class="mdi mdi-home-outline me-1 text-primary"></i>Nama Tanah / Proyek
                            </small>
                            <h6 class="fw-bold text-dark mb-0">{{ $land->name ?? '-' }}</h6>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <small class="text-muted d-block mb-1">
                                <i class="mdi mdi-ruler-square me-1 text-primary"></i>Luas Total Tanah
                            </small>
                            <h6 class="fw-bold text-dark mb-0">{{ number_format($land->area ?? 0, 0, ',', '.') }} m²</h6>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <small class="text-muted d-block mb-1">
                                <i class="mdi mdi-chart-arc me-1 text-primary"></i>Sisa Luas Belum Dikavling
                            </small>
                            <h6 class="fw-bold text-primary mb-0">
                                {{ number_format($land->remaining_area ?? ($land->area ?? 0), 0, ',', '.') }} m²
                            </h6>
                        </div>

                        <div class="col-sm-6 col-md-3">
                            <small class="text-muted d-block mb-1">
                                <i class="mdi mdi-gavel me-1 text-primary"></i>Status Legal
                            </small>
                            @if ($land->legal_status == 'verified')
                                <span class="badge badge-success px-3 py-1">
                                    <i class="mdi mdi-check-circle me-1"></i>Terverifikasi
                                </span>
                            @else
                                <span class="badge badge-warning px-3 py-1">
                                    <i class="mdi mdi-clock-outline me-1"></i>{{ ucfirst($land->legal_status ?? 'Pending') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <hr class="my-3" style="border-top: 1px dashed #e9ecef;">

                    <div class="row">
                        <div class="col-12">
                            <small class="text-muted d-block mb-1">
                                <i class="mdi mdi-map-marker-outline me-1 text-danger"></i>Alamat & Lokasi
                            </small>
                            <p class="text-dark mb-0 fw-semibold" style="font-size: 0.88rem;">
                                <i class="mdi mdi-map-marker text-danger me-1"></i>
                                {{ $land->address ?? '-' }},
                                Kel. {{ $land->village ?? '-' }},
                                Kec. {{ $land->district ?? '-' }},
                                {{ $land->city ?? '-' }},
                                {{ $land->province ?? '-' }}
                                {{ $land->postal_code ? '(' . $land->postal_code . ')' : '' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 2: Daftar Unit Kavling -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2">
                    <div class="d-flex align-items-center gap-2">
                        <h5 class="card-title mb-0">
                            <i class="mdi mdi-format-list-bulleted me-2"></i>Daftar Unit Kavling
                        </h5>
                    </div>

                    <div class="d-flex align-items-center gap-2">
                        <button type="button" class="btn btn-sm btn-gradient-info d-flex align-items-center gap-1 shadow-sm text-white" data-bs-toggle="modal" data-bs-target="#modalSpkUnit">
                            <i class="mdi mdi-file-document-edit text-white" style="font-size: 1rem;"></i>
                            <span class="text-white">Atur / Terbitkan SPK</span>
                        </button>

                        <button type="button" class="btn btn-sm btn-gradient-primary d-flex align-items-center gap-1 shadow-sm text-white" data-bs-toggle="modal" data-bs-target="#tambahUnitModal">
                            <i class="mdi mdi-plus-circle text-white" style="font-size: 1rem;"></i>
                            <span class="text-white">Tambah Unit Kavling</span>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Filter Section (Standard Sesuai Halaman Lain) -->
                    <div class="filter-card mb-3">
                        <!-- Desktop Version -->
                        <div class="filter-row-desktop d-none d-md-block">
                            <form id="filterForm" method="GET" action="{{ url()->current() }}" onsubmit="return showFilterLoading()">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                    <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                        <!-- Search Input -->
                                        <div style="min-width: 220px; max-width: 280px; flex: 1;">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="search" id="searchInput"
                                                    placeholder="Cari blok / unit / nama..."
                                                    value="{{ request('search') }}"
                                                    style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                                <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                    type="submit" title="Cari"
                                                    style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                    <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Type Filter -->
                                        <div style="width: 140px;">
                                            <select class="form-control" name="type" id="filterType">
                                                <option value="">Semua Type</option>
                                                @foreach ($land->units->pluck('type')->unique() as $type)
                                                    @if ($type)
                                                        <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Posisi Filter -->
                                        <div style="width: 140px;">
                                            <select class="form-control" name="position" id="filterPosisi">
                                                <option value="">Semua Posisi</option>
                                                @foreach ($land->units->pluck('position')->unique() as $position)
                                                    @if ($position)
                                                        <option value="{{ $position }}" {{ request('position') == $position ? 'selected' : '' }}>{{ $position }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Hadap Filter -->
                                        <div style="width: 140px;">
                                            <select class="form-control" name="facing" id="filterHadap">
                                                <option value="">Semua Hadap</option>
                                                @foreach ($land->units->pluck('facing')->unique() as $facing)
                                                    @if ($facing)
                                                        <option value="{{ $facing }}" {{ request('facing') == $facing ? 'selected' : '' }}>{{ $facing }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Right Limit & Buttons (Mentok Kanan) -->
                                    <div class="d-flex align-items-center gap-2 ms-auto">
                                        <div style="width: 110px;">
                                            <select class="form-control" name="per_page" id="perPageSelect">
                                                <option value="5" {{ request('per_page', 5) == 5 ? 'selected' : '' }}>5 data</option>
                                                <option value="10" {{ request('per_page', 5) == 10 ? 'selected' : '' }}>10 data</option>
                                                <option value="15" {{ request('per_page', 5) == 15 ? 'selected' : '' }}>15 data</option>
                                                <option value="25" {{ request('per_page', 5) == 25 ? 'selected' : '' }}>25 data</option>
                                                <option value="50" {{ request('per_page', 5) == 50 ? 'selected' : '' }}>50 data</option>
                                                <option value="100" {{ request('per_page', 5) == 100 ? 'selected' : '' }}>100 data</option>
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-gradient-primary btn-icon-only" title="Filter">
                                            <i class="mdi mdi-filter"></i>
                                        </button>
                                        <a href="{{ url()->current() }}" class="btn btn-gradient-secondary btn-icon-only" title="Reset" onclick="showResetLoading(event)">
                                            <i class="mdi mdi-refresh"></i>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Mobile Version -->
                        <div class="filter-row-mobile d-block d-md-none">
                            <form method="GET" action="{{ url()->current() }}" onsubmit="return showFilterLoading()">
                                <div class="row g-2">
                                    <div class="col-12 mb-2">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" id="searchInputMobile"
                                                placeholder="Cari blok / unit..."
                                                value="{{ request('search') }}"
                                                style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                            <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                type="submit" title="Cari"
                                                style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <select class="form-control" name="type" id="filterTypeMobile">
                                            <option value="">Semua Type</option>
                                            @foreach ($land->units->pluck('type')->unique() as $type)
                                                @if ($type)
                                                    <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <select class="form-control" name="position" id="filterPosisiMobile">
                                            <option value="">Semua Posisi</option>
                                            @foreach ($land->units->pluck('position')->unique() as $position)
                                                @if ($position)
                                                    <option value="{{ $position }}" {{ request('position') == $position ? 'selected' : '' }}>{{ $position }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <select class="form-control" name="facing" id="filterHadapMobile">
                                            <option value="">Semua Hadap</option>
                                            @foreach ($land->units->pluck('facing')->unique() as $facing)
                                                @if ($facing)
                                                    <option value="{{ $facing }}" {{ request('facing') == $facing ? 'selected' : '' }}>{{ $facing }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <select class="form-control" name="per_page" id="perPageMobile">
                                            <option value="5" {{ request('per_page', 5) == 5 ? 'selected' : '' }}>5 data</option>
                                            <option value="10" {{ request('per_page', 5) == 10 ? 'selected' : '' }}>10 data</option>
                                            <option value="15" {{ request('per_page', 5) == 15 ? 'selected' : '' }}>15 data</option>
                                            <option value="25" {{ request('per_page', 5) == 25 ? 'selected' : '' }}>25 data</option>
                                            <option value="50" {{ request('per_page', 5) == 50 ? 'selected' : '' }}>50 data</option>
                                            <option value="100" {{ request('per_page', 5) == 100 ? 'selected' : '' }}>100 data</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-gradient-primary btn-icon-only-mobile w-100" title="Filter">
                                            <i class="mdi mdi-filter me-1"></i> Filter
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ url()->current() }}" class="btn btn-gradient-secondary btn-icon-only-mobile w-100" title="Reset" onclick="showResetLoading(event)">
                                            <i class="mdi mdi-refresh me-1"></i> Reset
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>                     <!-- Table Data Kavling -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" style="min-width: 1200px;">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 50px;">No</th>
                                    <th>Nama - Unit</th>
                                    <th>Luas Tanah</th>
                                    <th>Luas Bangunan</th>
                                    <th>Jenis & Tipe</th>
                                    <th>Harga</th>
                                    <th>Harga IJB</th>
                                    <th>Harga AJB</th>
                                    <th>Hadap</th>
                                    <th>Posisi</th>
                                    <th class="text-center" style="width: 140px;">SPK / Dokumen</th>
                                    <th class="text-center" style="width: 110px;">Status</th>
                                    <th class="text-center" style="width: 130px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($units as $i => $unit)
                                    <tr>
                                        <td class="text-center fw-bold text-muted">{{ $units->firstItem() + $i }}</td>

                                        <td>
                                            @php
                                                $blok = $unit->block ?? (explode('.', $unit->unit_code)[0] ?? '-');
                                                $nomor = $unit->unit_number ?? (explode('.', $unit->unit_code)[1] ?? '-');
                                                $kodeTampil = $unit->unit_code ?? ($blok . '.' . $nomor);
                                            @endphp
                                            <div class="d-flex align-items-center gap-2">
                                                <i class="mdi mdi-home-outline text-primary" style="font-size: 1.1rem;"></i>
                                                <div>
                                                    <span class="fw-bold text-dark d-block">{{ $unit->unit_name ?? '-' }}</span>
                                                    <small class="text-muted">Kode: {{ $kodeTampil }}</small>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <span class="badge bg-light text-dark border">
                                                <i class="mdi mdi-ruler-square text-warning me-1"></i>{{ number_format($unit->area, 0, ',', '.') }} m²
                                            </span>
                                        </td>

                                        <td>
                                            <span class="badge bg-light text-dark border">
                                                <i class="mdi mdi-home-floor-0 text-info me-1"></i>{{ number_format($unit->building_area ?? 0, 0, ',', '.') }} m²
                                            </span>
                                        </td>

                                        <td>
                                            @if (($unit->jenis ?? $unit->type) == 'subsidi')
                                                <span class="badge badge-success">
                                                    <i class="mdi mdi-home-assistant me-1"></i>Subsidi - {{ $unit->type ?: '-' }}
                                                </span>
                                            @else
                                                <span class="badge badge-primary">
                                                    <i class="mdi mdi-office-building me-1"></i>Komersil - {{ $unit->type ?: '-' }}
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            <span class="fw-bold text-success">
                                                Rp {{ number_format($unit->price ?? 0, 0, ',', '.') }}
                                            </span>
                                        </td>

                                        <td>
                                            <span class="fw-bold text-success">
                                                Rp {{ number_format($unit->ijb_price ?? 0, 0, ',', '.') }}
                                            </span>
                                        </td>

                                        <td>
                                            <span class="fw-bold text-success">
                                                Rp {{ number_format($unit->ajb_price ?? 0, 0, ',', '.') }}
                                            </span>
                                        </td>

                                        <td>
                                            <span class="badge bg-light text-muted border">
                                                <i class="mdi mdi-compass-outline text-primary me-1"></i>{{ $unit->facing ?? '-' }}
                                            </span>
                                        </td>

                                        <td>
                                            <span class="badge bg-light text-muted border">
                                                <i class="mdi mdi-map-marker-outline text-primary me-1"></i>{{ $unit->position ?? '-' }}
                                            </span>
                                        </td>

                                        <td class="text-center">
                                            @if ($unit->no_spk)
                                                @php
                                                    $spkDocUrl = null;
                                                    if (!empty($unit->dokumen_spk)) {
                                                        $cleanSpk = ltrim($unit->dokumen_spk, '/');
                                                        $spkDocUrl = asset(str_starts_with($cleanSpk, 'uploads/') ? $cleanSpk : 'uploads/' . $cleanSpk);
                                                    }
                                                @endphp

                                                @if ($spkDocUrl)
                                                    <a href="{{ $spkDocUrl }}" target="_blank" class="btn btn-xs btn-outline-primary py-1 px-2 d-inline-flex align-items-center gap-1 shadow-sm rounded-pill text-decoration-none" title="Buka berkas PDF SPK {{ $unit->no_spk }} (Kontraktor: {{ $unit->kontraktor ?? '-' }})">
                                                        <i class="mdi mdi-file-pdf text-danger fs-6"></i>
                                                        <span class="fw-bold">{{ $unit->no_spk }}</span>
                                                        <i class="mdi mdi-open-in-new" style="font-size: 10px;"></i>
                                                    </a>
                                                @else
                                                    <span class="badge bg-light text-dark border py-1 px-2 d-inline-flex align-items-center gap-1" title="Kontraktor: {{ $unit->kontraktor ?? '-' }} (Belum ada berkas PDF)">
                                                        <i class="mdi mdi-file-document-outline text-primary"></i>
                                                        <span>{{ $unit->no_spk }}</span>
                                                    </span>
                                                @endif

                                                @if($unit->kontraktor)
                                                    <small class="text-muted d-block mt-1 text-truncate" style="max-width: 130px; font-size: 10px; margin: 0 auto;" title="Kontraktor: {{ $unit->kontraktor }}">
                                                        {{ $unit->kontraktor }}
                                                    </small>
                                                @endif
                                            @else
                                                <span class="text-muted small">-</span>
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            @php
                                                $st = strtolower($unit->status ?? 'ready');
                                                $isSubsidi = ($unit->jenis ?? $unit->type) == 'subsidi';
                                            @endphp
                                            @if ($st == 'sold' || $st == 'terjual')
                                                <span class="badge-kavling-status status-sold">
                                                    <i class="mdi mdi-close-circle-outline"></i>Sold
                                                </span>
                                            @elseif($st == 'booked' || $st == 'booking')
                                                <span class="badge-kavling-status status-booked">
                                                    <i class="mdi mdi-calendar-clock"></i>Booked
                                                </span>
                                            @elseif($st == 'draft')
                                                <span class="badge-kavling-status status-draft">
                                                    <i class="mdi mdi-pencil-outline"></i>Draft
                                                </span>
                                            @else
                                                @if($isSubsidi)
                                                    <span class="badge-kavling-status status-ready-subsidi">
                                                        <i class="mdi mdi-check-circle-outline"></i>Ready (Subsidi)
                                                    </span>
                                                @else
                                                    <span class="badge-kavling-status status-ready-komersil">
                                                        <i class="mdi mdi-check-circle-outline"></i>Ready (Komersil)
                                                    </span>
                                                @endif
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            <div class="d-flex justify-content-center align-items-center gap-1">
                                                <button type="button" class="btn-action btn-action-edit" data-bs-toggle="modal" data-bs-target="#editUnitModal{{ $unit->id }}" title="Edit">
                                                    <i class="mdi mdi-pencil"></i>
                                                </button>

                                                <a href="{{ route('properti.progress', ['land_bank_id' => $unit->land_bank_id, 'unit_id' => $unit->id]) }}" class="btn-action btn-action-view" title="Progress Unit">
                                                    <i class="mdi mdi-progress-check"></i>
                                                </a>

                                                <form action="{{ route('properti.kavling.destroy', ['unit' => $unit->id]) }}" method="POST" class="d-inline delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn-action btn-action-delete" type="button" onclick="confirmDelete(this, '{{ $unit->unit_code }}')" title="Hapus">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </form>
                                            </div>

                                            <!-- Modal Edit Unit -->
                                            <div class="modal fade modal-custom" id="editUnitModal{{ $unit->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">
                                                                <i class="mdi mdi-pencil-circle me-2"></i>Edit Unit Kavling - {{ $unit->unit_code }}
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body text-start p-4">
                                                            <form action="{{ route('properti.kavling.update', ['unit' => $unit->id]) }}" method="POST" id="formEditUnitManual{{ $unit->id }}" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                
                                                                <div class="row g-3">
                                                                    <div class="col-md-3">
                                                                        <label class="form-label fw-bold small">Blok / Kode</label>
                                                                        <input type="text" name="block" class="form-control" value="{{ $unit->block }}" placeholder="Contoh: A" required>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <label class="form-label fw-bold small">No. Unit</label>
                                                                        <input type="text" name="unit_number" class="form-control" value="{{ $unit->unit_number }}" placeholder="1" required>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <label class="form-label fw-bold small">Jenis Unit</label>
                                                                        <select name="jenis" class="form-control" required>
                                                                            <option value="">-- Pilih Jenis --</option>
                                                                            <option value="subsidi" {{ ($unit->jenis ?? $unit->type) == 'subsidi' ? 'selected' : '' }}>Subsidi</option>
                                                                            <option value="komersil" {{ ($unit->jenis ?? $unit->type) == 'komersil' ? 'selected' : '' }}>Komersil</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <label class="form-label fw-bold small">Type</label>
                                                                        <input type="text" name="type" class="form-control" value="{{ $unit->type }}" placeholder="36/60" required>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <label class="form-label fw-bold small">Nama Unit</label>
                                                                        <input type="text" name="unit_name" class="form-control" value="{{ $unit->unit_name }}" placeholder="Cluster A">
                                                                    </div>

                                                                    <div class="col-md-3">
                                                                        <label class="form-label fw-bold small">Luas Tanah (m²)</label>
                                                                        <input type="number" name="area" class="form-control" value="{{ $unit->area }}" placeholder="60" min="1" step="any" required>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <label class="form-label fw-bold small">Luas Bangunan (m²)</label>
                                                                        <input type="number" name="building_area" class="form-control" value="{{ $unit->building_area }}" placeholder="36" min="1" step="any" required>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <label class="form-label fw-bold small">Harga Unit (Rp)</label>
                                                                        <input type="text" name="price" class="form-control price-format" value="{{ number_format($unit->price ?? 0, 0, ',', '.') }}" placeholder="150.000.000">
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <label class="form-label fw-bold small">Harga IJB (Rp)</label>
                                                                        <input type="text" name="ijb_price" class="form-control price-format" value="{{ number_format($unit->ijb_price ?? 0, 0, ',', '.') }}" placeholder="150.000.000">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label class="form-label fw-bold small">Harga AJB (Rp)</label>
                                                                        <input type="text" name="ajb_price" class="form-control price-format" value="{{ number_format($unit->ajb_price ?? 0, 0, ',', '.') }}" placeholder="150.000.000">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label class="form-label fw-bold small">Hadap</label>
                                                                        <select name="facing" class="form-control">
                                                                            <option value="Utara" {{ $unit->facing == 'Utara' ? 'selected' : '' }}>Utara</option>
                                                                            <option value="Selatan" {{ $unit->facing == 'Selatan' ? 'selected' : '' }}>Selatan</option>
                                                                            <option value="Timur" {{ $unit->facing == 'Timur' ? 'selected' : '' }}>Timur</option>
                                                                            <option value="Barat" {{ $unit->facing == 'Barat' ? 'selected' : '' }}>Barat</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label class="form-label fw-bold small">Posisi</label>
                                                                        <select name="position" class="form-control">
                                                                            <option value="Hook" {{ $unit->position == 'Hook' ? 'selected' : '' }}>Hook</option>
                                                                            <option value="Tengah" {{ $unit->position == 'Tengah' ? 'selected' : '' }}>Tengah</option>
                                                                            <option value="Sudut" {{ $unit->position == 'Sudut' ? 'selected' : '' }}>Sudut</option>
                                                                        </select>
                                                                    </div>

                                                                    <div class="col-12">
                                                                        <label class="form-label fw-bold small">Keterangan Tambahan</label>
                                                                        <input type="text" name="description" class="form-control" value="{{ $unit->description }}" placeholder="Opsional">
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-sm btn-gradient-secondary" data-bs-dismiss="modal">
                                                                <i class="mdi mdi-close me-1"></i>Batal
                                                            </button>
                                                            <button type="submit" form="formEditUnitManual{{ $unit->id }}" class="btn btn-sm btn-gradient-primary">
                                                                <i class="mdi mdi-content-save me-1"></i>Simpan Perubahan
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="12" class="text-center text-muted py-4">
                                            <i class="mdi mdi-alert-circle-outline d-block mb-1" style="font-size: 2rem; color: #da8cff;"></i>
                                            Belum ada data unit kavling untuk tanah induk ini.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if ($units->hasPages())
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                            <div class="pagination-info mb-2 mb-sm-0">
                                Menampilkan {{ $units->firstItem() }} - {{ $units->lastItem() }} dari {{ $units->total() }} data
                            </div>
                            <div>
                                {{ $units->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Card 3 & 4: Ringkasan & Denah Kavling -->
    <div class="row g-3">
        <!-- Ringkasan Kavling -->
        <div class="col-lg-5">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white d-flex align-items-center gap-2">
                    <span class="badge bg-primary bg-opacity-10 text-primary p-2 rounded-3">
                        <i class="mdi mdi-chart-pie" style="font-size: 1.1rem;"></i>
                    </span>
                    <h5 class="card-title mb-0 fw-bold text-dark">Ringkasan Kavling</h5>
                </div>
                <div class="card-body p-3 p-md-4">
                    @php
                        $totalUnits = $land->units->count();
                        $totalArea = $land->units->sum('area');
                        $sisaLuas = max(0, $land->remaining_area ?? ($land->area - $totalArea));
                        $totalNilai = $land->units->sum('price');

                        $mapProgress = [
                            'belum_mulai' => 0,
                            'pondasi' => 20,
                            'dinding' => 40,
                            'atap' => 60,
                            'finishing' => 80,
                            'selesai' => 100,
                        ];

                        $unitProgress = $land->units->map(function ($u) use ($mapProgress) {
                            $st = strtolower($u->construction_progress ?? 'belum_mulai');
                            return $mapProgress[$st] ?? 0;
                        });

                        $progressPercent = $unitProgress->count() > 0 ? $unitProgress->avg() : 0;
                    @endphp

                    <div class="row g-3">
                        <div class="col-6">
                            <div class="p-3 bg-light rounded-3">
                                <small class="text-muted d-block mb-1"><i class="mdi mdi-counter me-1 text-primary"></i>Total Unit</small>
                                <h4 class="fw-bold text-dark mb-0">{{ $totalUnits }} Unit</h4>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 bg-light rounded-3">
                                <small class="text-muted d-block mb-1"><i class="mdi mdi-ruler-square me-1 text-primary"></i>Total Luas Unit</small>
                                <h4 class="fw-bold text-dark mb-0">{{ number_format($totalArea, 0, ',', '.') }} m²</h4>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 bg-light rounded-3">
                                <small class="text-muted d-block mb-1"><i class="mdi mdi-chart-arc me-1 text-primary"></i>Sisa Luas Tanah</small>
                                <h4 class="fw-bold text-primary mb-0">{{ number_format($sisaLuas, 0, ',', '.') }} m²</h4>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 bg-light rounded-3">
                                <small class="text-muted d-block mb-1"><i class="mdi mdi-currency-usd me-1 text-success"></i>Nilai Total Unit</small>
                                <h4 class="fw-bold text-success mb-0" style="font-size: 1rem;">Rp {{ number_format($totalNilai, 0, ',', '.') }}</h4>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <small class="fw-bold text-dark"><i class="mdi mdi-progress-clock me-1 text-primary"></i>Progress Pembangunan</small>
                            <small class="fw-bold text-primary">{{ number_format($progressPercent, 0) }}%</small>
                        </div>
                        <div class="progress" style="height: 10px; border-radius: 6px;">
                            <div class="progress-bar bg-gradient-primary" role="progressbar" style="width: {{ $progressPercent }}%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Denah Kavling -->
        <div class="col-lg-7">
            <div class="card shadow-sm border-0 h-100">
                @php
                    $hasDenah = !empty($land->denah);
                    $denahUrl = null;
                    $isPdf = false;
                    $denahFileName = null;
                    if ($hasDenah) {
                        $cleanPath = ltrim($land->denah, '/');
                        if (str_starts_with($cleanPath, 'uploads/')) {
                            $denahUrl = asset($cleanPath);
                        } elseif (file_exists(public_path('uploads/' . $cleanPath))) {
                            $denahUrl = asset('uploads/' . $cleanPath);
                        } elseif (file_exists(public_path('storage/' . $cleanPath))) {
                            $denahUrl = asset('storage/' . $cleanPath);
                        } elseif (file_exists(public_path($cleanPath))) {
                            $denahUrl = asset($cleanPath);
                        } else {
                            $denahUrl = asset('uploads/' . $cleanPath);
                        }
                        $denahFileName = basename($cleanPath);
                        $ext = strtolower(pathinfo($cleanPath, PATHINFO_EXTENSION));
                        $isPdf = ($ext === 'pdf');
                    }
                @endphp

                <div class="card-header bg-white d-flex flex-wrap align-items-center justify-content-between gap-2 py-3">
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-primary bg-opacity-10 text-primary p-2 rounded-3">
                            <i class="mdi mdi-map" style="font-size: 1.1rem;"></i>
                        </span>
                        <div>
                            <h5 class="card-title mb-0 fw-bold text-dark">Denah Kavling Interaktif</h5>
                            <small class="text-muted">Siteplan resmi tanah dari Pasca Land Bank & visualisasi blok</small>
                        </div>
                    </div>
                    
                    <!-- Tab Switcher Header (Siteplan vs Matriks Blok) -->
                    <div class="d-flex align-items-center gap-1 bg-light p-1 rounded-pill border">
                        <button type="button" class="siteplan-tab-btn {{ $hasDenah ? 'active' : '' }}" id="btnTabSiteplan" onclick="switchSiteplanView('siteplan')">
                            <i class="mdi mdi-image-area me-1"></i>Siteplan Asli
                        </button>
                        <button type="button" class="siteplan-tab-btn {{ !$hasDenah ? 'active' : '' }}" id="btnTabMatriks" onclick="switchSiteplanView('matriks')">
                            <i class="mdi mdi-grid-large me-1"></i>Matriks Unit
                        </button>
                    </div>
                </div>

                <div class="card-body p-3 p-md-4">
                    <!-- VIEW 1: SITEPLAN ASLI (DARI PASCA LAND BANK) -->
                    <div id="viewSiteplanContainer" class="{{ $hasDenah ? '' : 'd-none' }}">
                        @if ($hasDenah)
                            <div class="siteplan-viewer-wrapper">
                                <!-- Toolbar Kontrol Zoom & Aksi -->
                                <div class="siteplan-toolbar">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge bg-soft-primary text-primary px-2 py-1 rounded-pill small fw-bold">
                                            <i class="mdi mdi-check-circle me-1"></i>Siteplan Terunggah
                                        </span>
                                        <span class="small text-muted text-truncate d-none d-sm-inline" style="max-width: 180px;" title="{{ $denahFileName }}">
                                            {{ $denahFileName }}
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center gap-1">
                                        @if(!$isPdf)
                                            <button type="button" class="btn btn-sm btn-outline-secondary p-1 px-2 rounded-2" onclick="zoomSiteplan(0.2)" title="Perbesar (Zoom In)">
                                                <i class="mdi mdi-magnify-plus-outline"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-secondary p-1 px-2 rounded-2" onclick="zoomSiteplan(-0.2)" title="Perkecil (Zoom Out)">
                                                <i class="mdi mdi-magnify-minus-outline"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-secondary p-1 px-2 rounded-2" onclick="resetSiteplanZoom()" title="Reset Ukuran">
                                                <i class="mdi mdi-restore"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-primary p-1 px-2 rounded-2" onclick="openSiteplanLightbox()" title="Lihat Layar Penuh">
                                                <i class="mdi mdi-fullscreen"></i>
                                            </button>
                                        @endif
                                        <a href="{{ $denahUrl }}" target="_blank" download class="btn btn-sm btn-gradient-primary p-1 px-2 rounded-2" title="Unduh Berkas Asli">
                                            <i class="mdi mdi-download"></i>
                                        </a>
                                    </div>
                                </div>

                                <!-- Viewport Display -->
                                @if ($isPdf)
                                    <div class="p-4 text-center bg-light" style="min-height: 380px;">
                                        <i class="mdi mdi-file-pdf-box text-danger" style="font-size: 4rem;"></i>
                                        <h6 class="fw-bold text-dark mt-2 mb-1">Dokumen Siteplan format PDF</h6>
                                        <p class="small text-muted mb-3">{{ $denahFileName }}</p>
                                        <a href="{{ $denahUrl }}" target="_blank" class="btn btn-sm btn-gradient-primary px-3 rounded-pill shadow-sm">
                                            <i class="mdi mdi-open-in-new me-1"></i>Buka & Lihat Berkas PDF Penuh
                                        </a>
                                    </div>
                                @else
                                    <div class="siteplan-viewport" id="siteplanViewport" title="Gunakan tombol kontrol di atas untuk memperbesar/memperkecil">
                                        <img src="{{ $denahUrl }}" alt="Siteplan {{ $land->name }}" class="siteplan-img" id="siteplanImageElement" draggable="false">
                                    </div>
                                    <div class="p-2 px-3 bg-light border-top d-flex justify-content-between align-items-center small text-muted">
                                        <span><i class="mdi mdi-cursor-move me-1"></i>Tips: Gunakan tombol zoom atau buka layar penuh</span>
                                        <a href="{{ route('properti.edit', $land->id) }}" class="text-primary text-decoration-none fw-bold small">
                                            <i class="mdi mdi-pencil-box-outline me-1"></i>Ganti Siteplan
                                        </a>
                                    </div>
                                @endif
                            </div>
                        @else
                            <!-- Empty State jika belum upload di pasca land bank -->
                            <div class="p-4 text-center bg-light rounded-4 border" style="border-style: dashed !important; border-width: 2px !important;">
                                <div class="mb-2">
                                    <span class="p-3 bg-white rounded-circle shadow-sm d-inline-flex align-items-center justify-content-center text-primary" style="width: 60px; height: 60px;">
                                        <i class="mdi mdi-map-marker-question-outline fs-2"></i>
                                    </span>
                                </div>
                                <h6 class="fw-bold text-dark mb-1">Berkas Siteplan / Denah Belum Diunggah</h6>
                                <p class="small text-muted mb-3" style="max-width: 440px; margin: 0 auto;">
                                    Belum ada berkas siteplan yang dilampirkan untuk properti lahan ini di Pasca Land Bank. Anda dapat mengunggah denah gambar/PDF sekarang.
                                </p>
                                <a href="{{ route('properti.edit', $land->id) }}" class="btn btn-sm btn-gradient-primary px-3 rounded-pill shadow-sm">
                                    <i class="mdi mdi-upload me-1"></i>Upload Denah / Siteplan di Edit Properti
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- VIEW 2: MATRIKS GRID UNIT (KAVLING BLOK) -->
                    <div id="viewMatriksContainer" class="{{ !$hasDenah ? '' : 'd-none' }}">
                        <div class="denah-container">
                            @php
                                $allUnits = $land->units;
                                $blokKavlings = [];
                                foreach ($allUnits as $unit) {
                                    $blok = explode('.', $unit->unit_code)[0] ?? 'A';
                                    $blokKavlings[$blok][] = $unit;
                                }
                                $allBloks = array_keys($blokKavlings);
                            @endphp

                            @forelse ($allBloks as $blok)
                                <div class="mb-3 text-center">
                                    <h6 class="fw-bold text-dark mb-2">Blok {{ $blok }}</h6>
                                    <div class="d-flex flex-wrap gap-2 justify-content-center">
                                        @php
                                            $numbers = [];
                                            foreach ($blokKavlings[$blok] as $u) {
                                                $num = (int) (explode('.', $u->unit_code)[1] ?? 0);
                                                $numbers[] = $num;
                                            }
                                            $maxNum = count($numbers) ? max($numbers) : 0;
                                        @endphp

                                        @for ($i = 1; $i <= $maxNum; $i++)
                                            @php
                                                $uFound = collect($blokKavlings[$blok])->firstWhere('unit_code', $blok . '.' . $i);
                                                $bgColor = '#6c757d';
                                                $icon = 'close';
                                                $borderStyle = 'none';
                                                $typeBadge = '';

                                                if ($uFound) {
                                                    switch ($uFound->status) {
                                                        case 'sold': $bgColor = '#dc3545'; $icon = 'check'; break;
                                                        case 'booked': $bgColor = '#ffc107'; $icon = 'clock'; break;
                                                        case 'draft': $bgColor = '#343a40'; $icon = 'pencil'; break;
                                                        case 'ready':
                                                            if ($uFound->type == 'subsidi') {
                                                                $bgColor = '#28a745';
                                                                $typeBadge = 'S';
                                                            } else {
                                                                $bgColor = '#0d6efd';
                                                                $typeBadge = 'K';
                                                            }
                                                            $icon = 'home';
                                                            break;
                                                    }

                                                    switch ($uFound->construction_progress) {
                                                        case 'belum_mulai': $borderStyle = '2px dashed #000'; break;
                                                        case 'pondasi': $borderStyle = '2px solid #000'; break;
                                                        case 'dinding': $borderStyle = '3px solid #000'; break;
                                                        case 'atap': $borderStyle = '3px double #000'; break;
                                                        case 'finishing': $borderStyle = '3px groove #000'; break;
                                                        case 'selesai': $borderStyle = '3px solid #155724'; break;
                                                    }
                                                }
                                            @endphp

                                            <span class="denah-unit-box" style="background-color: {{ $bgColor }}; border: {{ $borderStyle }};">
                                                @if ($typeBadge)
                                                    <small class="denah-type-badge">{{ $typeBadge }}</small>
                                                @endif
                                                <i class="mdi mdi-{{ $icon }} me-1"></i>{{ $blok . '.' . $i }}
                                            </span>
                                        @endfor
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted text-center mb-0">Belum ada data kavling untuk divisualisasikan.</p>
                            @endforelse

                            <hr class="my-3">

                            <!-- Legend Status -->
                            <div class="small">
                                <h6 class="fw-bold text-dark mb-2" style="font-size: 0.8rem;">Status Penjualan:</h6>
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="badge bg-danger">Sold</span>
                                    <span class="badge bg-warning text-dark">Booked</span>
                                    <span class="badge bg-dark">Draft</span>
                                    <span class="badge bg-success">Ready (Subsidi)</span>
                                    <span class="badge bg-primary">Ready (Komersil)</span>
                                </div>

                                <h6 class="fw-bold text-dark mb-2" style="font-size: 0.8rem;">Tipe Unit:</h6>
                                <div class="d-flex gap-2">
                                    <span class="badge bg-success">S = Subsidi</span>
                                    <span class="badge bg-primary">K = Komersil</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Unit -->
    <div class="modal fade modal-custom" id="tambahUnitModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="mdi mdi-plus-circle me-2"></i>Tambah Unit Kavling Baru
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <!-- Tab Switcher -->
                    <div class="modal-tabs-wrapper">
                        <ul class="modal-tabs">
                            <li>
                                <a class="modal-tab-link active" data-modal-tab="manual">
                                    <i class="mdi mdi-pencil"></i>
                                    <span>Manual Satu per Satu</span>
                                </a>
                            </li>
                            <li>
                                <a class="modal-tab-link" data-modal-tab="import">
                                    <i class="mdi mdi-file-excel"></i>
                                    <span>Import File Excel</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Pane Manual -->
                    <div class="modal-tab-pane active" id="modal-manual-pane">
                        <form action="{{ route('properti.storeKavling', $land->id) }}" method="POST" id="formTambahUnitManual" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label class="form-label fw-bold small">Blok / Kode <span class="text-danger">*</span></label>
                                    <input type="text" name="block" class="form-control" placeholder="Contoh: A" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label fw-bold small">Nomor <span class="text-danger">*</span></label>
                                    <input type="text" name="unit_number" class="form-control" placeholder="1" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold small">Jenis Unit <span class="text-danger">*</span></label>
                                    <select name="jenis" class="form-control" required>
                                        <option value="">-- Pilih Jenis --</option>
                                        <option value="subsidi">Subsidi</option>
                                        <option value="komersil">Komersil</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label fw-bold small">Type <span class="text-danger">*</span></label>
                                    <input type="text" name="type" class="form-control" placeholder="36/60" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label fw-bold small">Nama Unit</label>
                                    <input type="text" name="unit_name" class="form-control" placeholder="Cluster A">
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label fw-bold small">Luas Tanah (m²) <span class="text-danger">*</span></label>
                                    <input type="number" name="area" class="form-control" placeholder="60" min="1" step="any" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold small">Luas Bangunan (m²) <span class="text-danger">*</span></label>
                                    <input type="number" name="building_area" class="form-control" placeholder="36" min="1" step="any" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold small">Harga (Rp) <span class="text-danger">*</span></label>
                                    <input type="text" name="price" class="form-control price-format" placeholder="150.000.000" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold small">Harga IJB (Rp)</label>
                                    <input type="text" name="ijb_price" class="form-control price-format" placeholder="150.000.000">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold small">Harga AJB (Rp)</label>
                                    <input type="text" name="ajb_price" class="form-control price-format" placeholder="150.000.000">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold small">Hadap</label>
                                    <select name="facing" class="form-control">
                                        <option value="Utara">Utara</option>
                                        <option value="Selatan">Selatan</option>
                                        <option value="Timur">Timur</option>
                                        <option value="Barat">Barat</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold small">Posisi</label>
                                    <select name="position" class="form-control">
                                        <option value="Hook">Hook</option>
                                        <option value="Tengah" selected>Tengah</option>
                                        <option value="Sudut">Sudut</option>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-bold small">Keterangan Tambahan</label>
                                    <input type="text" name="description" class="form-control" placeholder="Catatan tambahan (opsional)">
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Pane Import -->
                    <div class="modal-tab-pane" id="modal-import-pane">
                        <div class="text-center py-3">
                            <div class="d-inline-flex p-3 rounded-circle bg-success bg-opacity-10 text-success mb-3">
                                <i class="mdi mdi-file-excel" style="font-size: 2.5rem;"></i>
                            </div>
                            <h5 class="fw-bold text-dark mb-1">Import Unit Kavling dari Excel</h5>
                            <p class="text-muted small mb-3">Unduh template file Excel, lengkapi data unit, lalu unggah kembali file tersebut.</p>

                            <div class="mb-4">
                                <a href="{{ route('kavling.template') }}" class="btn btn-sm btn-outline-success px-3">
                                    <i class="mdi mdi-download me-1"></i>Unduh Template Kavling (.xlsx)
                                </a>
                            </div>

                            <form action="{{ route('kavling.import', $land->id) }}" method="POST" enctype="multipart/form-data" id="formImportExcelModal">
                                @csrf
                                <div class="upload-dropzone-box">
                                    <input type="file" id="uploadExcelModal" name="file" accept=".xlsx,.xls" required>
                                    <i class="mdi mdi-cloud-upload-outline text-primary d-block mb-2" style="font-size: 2rem;"></i>
                                    <span class="fw-bold text-dark d-block" id="fileNameModal">Pilih atau Drag & Drop file Excel di sini</span>
                                    <small class="text-muted">Format didukung: .xlsx, .xls (Maksimal 5MB)</small>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-gradient-secondary" data-bs-dismiss="modal">
                        <i class="mdi mdi-close me-1"></i>Batal
                    </button>
                    
                    <button type="submit" form="formTambahUnitManual" id="btnSubmitManual" class="btn btn-sm btn-gradient-primary">
                        <i class="mdi mdi-content-save me-1"></i>Simpan Unit
                    </button>

                    <button type="submit" form="formImportExcelModal" id="btnSubmitImport" class="btn btn-sm btn-gradient-success d-none">
                        <i class="mdi mdi-upload me-1"></i>Import File Excel
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modal Lightbox Siteplan Fullscreen -->
<div class="modal fade" id="modalSiteplanLightbox" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-bottom py-3">
                <h5 class="modal-title fw-bold text-dark d-flex align-items-center gap-2">
                    <i class="mdi mdi-image-area text-primary fs-4"></i>
                    <span>Siteplan Proyek: {{ $land->name }}</span>
                </h5>
                <div class="d-flex align-items-center gap-2">
                    @if($hasDenah)
                        <a href="{{ $denahUrl }}" target="_blank" download class="btn btn-sm btn-outline-primary rounded-pill px-3">
                            <i class="mdi mdi-download me-1"></i>Unduh Asli
                        </a>
                    @endif
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body p-0 text-center bg-dark" style="min-height: 500px; display: flex; align-items: center; justify-content: center; overflow: auto;">
                @if($hasDenah && !$isPdf)
                    <img src="{{ $denahUrl }}" alt="Siteplan {{ $land->name }}" class="img-fluid" style="max-height: 80vh; object-fit: contain;">
                @endif
            </div>
            <div class="modal-footer border-top py-2 px-3 justify-content-between bg-light">
                <span class="small text-muted">Berkas resmi denah lahan Pasca Land Bank</span>
                <button type="button" class="btn btn-secondary btn-sm rounded-pill px-3" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL: ATUR / TERBITKAN SPK KE MULTI-UNIT KAVLING -->
<div class="modal fade" id="modalSpkUnit" tabindex="-1" aria-labelledby="modalSpkUnitLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-bottom py-3">
                <div class="d-flex align-items-center gap-2">
                    <div class="d-inline-flex p-2 rounded-3 bg-primary bg-opacity-10 text-primary">
                        <i class="mdi mdi-file-document-edit-outline fs-4"></i>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold text-dark mb-0" id="modalSpkUnitLabel">Atur & Terbitkan SPK Unit Kavling</h5>
                        <small class="text-muted">Terapkan 1 nomor SPK kontraktor untuk beberapa unit kavling sekaligus</small>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">
                <form id="formAssignSpkModal" action="{{ route('properti.kavling.assignSpk', $land->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-dark">Nomor SPK <span class="text-danger">*</span></label>
                            <input type="text" name="no_spk" class="form-control" placeholder="Contoh: SPK/2026/KAV/001" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-dark">Nama Kontraktor / Pelaksana <span class="text-danger">*</span></label>
                            <input type="text" name="kontraktor" class="form-control" placeholder="Contoh: PT. Maju Konstruksi Nusantara" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-dark">Upload Berkas SPK (PDF, Opsional)</label>
                            <input type="file" name="dokumen_spk" class="form-control" accept=".pdf">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-dark">Keterangan / Scope Pekerjaan</label>
                            <input type="text" name="description" class="form-control" placeholder="Catatan lingkup pekerjaan (opsional)">
                        </div>
                    </div>

                    <!-- Pilih Multi-Unit Kavling -->
                    <div class="border rounded-3 p-3 bg-light">
                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3 pb-2 border-bottom">
                            <div>
                                <h6 class="fw-bold text-dark mb-0">Pilih Unit Kavling yang Termasuk SPK Ini <span class="text-danger">*</span></h6>
                                <small class="text-muted" id="spkUnitCounter">0 unit kavling dipilih</small>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <button type="button" class="btn btn-xs btn-outline-primary px-2 py-1" id="btnSelectAllSpkUnits" style="font-size: 11px;">
                                    <i class="mdi mdi-checkbox-multiple-marked-outline me-1"></i>Pilih Semua
                                </button>
                                <button type="button" class="btn btn-xs btn-outline-secondary px-2 py-1" id="btnUnselectAllSpkUnits" style="font-size: 11px;">
                                    <i class="mdi mdi-checkbox-multiple-blank-outline me-1"></i>Hapus Pilihan
                                </button>
                            </div>
                        </div>

                        <!-- Search Unit di Modal -->
                        <div class="mb-3">
                            <div class="input-group input-group-sm">
                                <span class="input-group-text bg-white border-end-0"><i class="mdi mdi-magnify text-muted"></i></span>
                                <input type="text" class="form-control border-start-0" id="filterSpkUnitSearch" placeholder="Cari kode unit / nama / tipe...">
                            </div>
                        </div>

                        <!-- Daftar Unit Checkbox List -->
                        <div class="spk-unit-selection-grid" style="max-height: 260px; overflow-y: auto; padding-right: 5px;">
                            <div class="row g-2" id="spkUnitListContainer">
                                @forelse ($land->units as $u)
                                    @php
                                        $uBlok = $u->block ?? (explode('.', $u->unit_code)[0] ?? '-');
                                        $uNomor = $u->unit_number ?? (explode('.', $u->unit_code)[1] ?? '-');
                                        $uKode = $u->unit_code ?? ($uBlok . '.' . $uNomor);
                                    @endphp
                                    <div class="col-md-4 col-sm-6 spk-unit-item-col" data-code="{{ strtolower($uKode) }}" data-name="{{ strtolower($u->unit_name ?? '') }}" data-type="{{ strtolower($u->type ?? '') }}">
                                        <label class="d-flex align-items-start gap-2 p-2 rounded-3 border bg-white h-100 shadow-sm spk-unit-card" style="cursor: pointer;">
                                            <input type="checkbox" name="unit_ids[]" value="{{ $u->id }}" class="form-check-input mt-1 spk-unit-checkbox">
                                            <div class="flex-grow-1" style="font-size: 12px; line-height: 1.3;">
                                                <div class="fw-bold text-dark d-flex justify-content-between align-items-center">
                                                    <span>{{ $uKode }}</span>
                                                    <span class="badge bg-light text-muted border py-0 px-1" style="font-size: 10px;">{{ $u->type }}</span>
                                                </div>
                                                <div class="text-muted small text-truncate" style="max-width: 130px;">{{ $u->unit_name ?: 'Unit' }}</div>
                                                @if($u->no_spk)
                                                    <div class="text-primary mt-1" style="font-size: 10px;" title="SPK saat ini: {{ $u->no_spk }}">
                                                        <i class="mdi mdi-file-document-outline me-1"></i>{{ $u->no_spk }}
                                                    </div>
                                                @else
                                                    <div class="text-muted mt-1" style="font-size: 10px;">
                                                        <i class="mdi mdi-alert-circle-outline me-1 text-warning"></i>Belum ada SPK
                                                    </div>
                                                @endif
                                            </div>
                                        </label>
                                    </div>
                                @empty
                                    <div class="col-12 text-center py-4 text-muted">
                                        <i class="mdi mdi-home-alert-outline fs-3 d-block mb-1"></i>
                                        Belum ada unit kavling yang dibuat untuk lahan ini. Tambahkan unit kavling terlebih dahulu.
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer border-top py-2 px-3">
                <button type="button" class="btn btn-sm btn-gradient-secondary" data-bs-dismiss="modal">
                    <i class="mdi mdi-close me-1"></i>Batal
                </button>
                <button type="submit" form="formAssignSpkModal" class="btn btn-sm btn-gradient-primary">
                    <i class="mdi mdi-check-all me-1"></i>Terapkan & Terbitkan SPK
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// Switch Siteplan vs Matriks Grid View
function switchSiteplanView(view) {
    if (view === 'siteplan') {
        $('#btnTabSiteplan').addClass('active');
        $('#btnTabMatriks').removeClass('active');
        $('#viewSiteplanContainer').removeClass('d-none');
        $('#viewMatriksContainer').addClass('d-none');
    } else {
        $('#btnTabMatriks').addClass('active');
        $('#btnTabSiteplan').removeClass('active');
        $('#viewMatriksContainer').removeClass('d-none');
        $('#viewSiteplanContainer').addClass('d-none');
    }
}

// Zoom Interactive Engine for Siteplan Image
let currentZoom = 1.0;
function zoomSiteplan(delta) {
    const img = document.getElementById('siteplanImageElement');
    if (!img) return;
    currentZoom = Math.max(0.5, Math.min(3.5, currentZoom + delta));
    img.style.transform = `scale(${currentZoom})`;
}

function resetSiteplanZoom() {
    const img = document.getElementById('siteplanImageElement');
    if (!img) return;
    currentZoom = 1.0;
    img.style.transform = 'scale(1)';
}

function openSiteplanLightbox() {
    $('#modalSiteplanLightbox').modal('show');
}

function showFilterLoading() {
    Swal.fire({
        title: 'Memuat...',
        text: 'Memfilter data unit kavling',
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
    });
    return true;
}

function showResetLoading(e) {
    e.preventDefault();
    Swal.fire({
        title: 'Mereset...',
        text: 'Mengembalikan filter ke default',
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
    });
    window.location.href = "{{ url()->current() }}";
}

$(document).ready(function() {
    // Auto-submit saat ganti opsi limit/filter
    $('#perPageSelect, #filterType, #filterPosisi, #filterHadap').on('change', function() {
        $('#filterForm').submit();
    });

    // Tab switching modal
    $('.modal-tab-link').on('click', function(e) {
        e.preventDefault();
        $('.modal-tab-link').removeClass('active');
        $(this).addClass('active');

        var target = $(this).data('modal-tab');
        $('.modal-tab-pane').removeClass('active');

        if (target === 'manual') {
            $('#modal-manual-pane').addClass('active');
            $('#btnSubmitManual').removeClass('d-none');
            $('#btnSubmitImport').addClass('d-none');
        } else {
            $('#modal-import-pane').addClass('active');
            $('#btnSubmitManual').addClass('d-none');
            $('#btnSubmitImport').removeClass('d-none');
        }
    });

    // File change Excel
    $('#uploadExcelModal').on('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            if (file.size > 5 * 1024 * 1024) {
                Swal.fire('Error', 'Ukuran file maksimal 5MB!', 'error');
                $(this).val('');
                $('#fileNameModal').text('Pilih atau Drag & Drop file Excel di sini');
                return;
            }
            $('#fileNameModal').text(file.name);
        } else {
            $('#fileNameModal').text('Pilih atau Drag & Drop file Excel di sini');
        }
    });

    // Price formatting
    $(document).on('keyup', '.price-format', function() {
        let val = $(this).val().replace(/\D/g, '');
        if (val) {
            $(this).val(new Intl.NumberFormat('id-ID').format(val));
        }
    });

    // Submit form manual
    $('#formTambahUnitManual').on('submit', function(e) {
        e.preventDefault();
        $('.price-format').each(function() {
            let val = $(this).val().replace(/\./g, '');
            $(this).val(val);
        });
        Swal.fire({
            title: 'Memuat...',
            text: 'Sedang menyimpan unit kavling',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });
        this.submit();
    });

    // Submit form edit
    $(document).on('submit', '[id^="formEditUnitManual"]', function(e) {
        e.preventDefault();
        $(this).find('.price-format').each(function() {
            let val = $(this).val().replace(/\./g, '');
            $(this).val(val);
        });
        Swal.fire({
            title: 'Memuat...',
            text: 'Sedang menyimpan perubahan unit',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });
        this.submit();
    });

    // Submit import
    $('#formImportExcelModal').on('submit', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Mengimpor Data...',
            text: 'Sedang memproses file Excel',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });
        this.submit();
    });

    // SPK Unit Multi-Select Controls
    function updateSpkUnitCounter() {
        const count = $('.spk-unit-checkbox:checked').length;
        $('#spkUnitCounter').text(count + ' unit kavling dipilih');
    }

    $(document).on('change', '.spk-unit-checkbox', function() {
        updateSpkUnitCounter();
        if ($(this).is(':checked')) {
            $(this).closest('.spk-unit-card').addClass('border-primary bg-primary bg-opacity-10');
        } else {
            $(this).closest('.spk-unit-card').removeClass('border-primary bg-primary bg-opacity-10');
        }
    });

    $('#btnSelectAllSpkUnits').on('click', function() {
        $('.spk-unit-item-col:visible .spk-unit-checkbox').prop('checked', true).trigger('change');
    });

    $('#btnUnselectAllSpkUnits').on('click', function() {
        $('.spk-unit-checkbox').prop('checked', false).trigger('change');
    });

    $('#filterSpkUnitSearch').on('keyup', function() {
        const q = $(this).val().toLowerCase();
        $('.spk-unit-item-col').each(function() {
            const code = $(this).data('code') || '';
            const name = $(this).data('name') || '';
            const type = $(this).data('type') || '';
            if (code.includes(q) || name.includes(q) || type.includes(q)) {
                $(this).removeClass('d-none');
            } else {
                $(this).addClass('d-none');
            }
        });
    });

    // Submit Form SPK
    $('#formAssignSpkModal').on('submit', function(e) {
        const selectedCount = $('.spk-unit-checkbox:checked').length;
        if (selectedCount === 0) {
            e.preventDefault();
            Swal.fire('Peringatan', 'Silakan pilih minimal 1 unit kavling yang akan dihubungkan dengan SPK ini!', 'warning');
            return false;
        }

        Swal.fire({
            title: 'Menerbitkan SPK...',
            text: 'Menghubungkan nomor SPK ke unit-unit terpilih',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });
    });
});

// Konfirmasi Hapus SweetAlert
function confirmDelete(btn, code) {
    Swal.fire({
        title: 'Hapus Unit ' + code + '?',
        text: 'Data unit kavling yang dihapus tidak dapat dikembalikan.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            btn.closest('form').submit();
        }
    });
}
</script>
@endpush
