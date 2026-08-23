@extends('layouts.partial.app')

@section('title', 'Buat Kavling - Property Management App')

@push('styles')
<style>
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
</style>
@endpush

@section('content')

<div class="container-fluid px-1 px-sm-2 px-md-3 py-2 py-md-3">

    <!-- Header Halaman (Tanpa Card Box) -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 px-1">
                <div>
                    <h3 class="text-dark mb-1 fw-bold">
                        <i class="mdi mdi-pencil-ruler me-2" style="color: #9a55ff;"></i>Buat Kavling / Master Unit
                    </h3>
                    <p class="text-muted mb-0">Kelola dan pecah unit kavling dari tanah induk yang telah terverifikasi</p>
                </div>
                <!-- Tombol Kembali mentok kanan -->
                <a href="{{ route('properti-all') }}" class="btn btn-sm btn-gradient-secondary d-flex align-items-center gap-1 btn-back shadow-sm px-3 py-2">
                    <i class="mdi mdi-arrow-left" style="font-size: 1rem;"></i>
                    <span>Kembali</span>
                </a>
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

                    <button type="button" class="btn btn-sm btn-gradient-primary d-flex align-items-center gap-1 shadow-sm" data-bs-toggle="modal" data-bs-target="#tambahUnitModal">
                        <i class="mdi mdi-plus-circle" style="font-size: 1rem;"></i>
                        <span>Tambah Unit Kavling</span>
                    </button>
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
                                                <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 data</option>
                                                <option value="25" {{ request('per_page', 25) == 25 ? 'selected' : '' }}>25 data</option>
                                                <option value="50" {{ request('per_page', 50) == 50 ? 'selected' : '' }}>50 data</option>
                                                <option value="100" {{ request('per_page', 100) == 100 ? 'selected' : '' }}>100 data</option>
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
                                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 data</option>
                                            <option value="25" {{ request('per_page', 25) == 25 ? 'selected' : '' }}>25 data</option>
                                            <option value="50" {{ request('per_page', 50) == 50 ? 'selected' : '' }}>50 data</option>
                                            <option value="100" {{ request('per_page', 100) == 100 ? 'selected' : '' }}>100 data</option>
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
                    </div>

                    <!-- Table Data Kavling -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" style="min-width: 1100px;">
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
                                            <div class="d-flex justify-content-center align-items-center gap-1">
                                                <button type="button" class="btn-action btn-action-edit" data-bs-toggle="modal" data-bs-target="#editUnitModal{{ $unit->id }}" title="Edit">
                                                    <i class="mdi mdi-pencil"></i>
                                                </button>

                                                <a href="{{ route('properti.progress', ['land_bank_id' => $unit->land_bank_id]) }}" class="btn-action btn-action-view" title="Progress Unit">
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
                                                                    <div class="col-md-3">
                                                                        <label class="form-label fw-bold small">Harga AJB (Rp)</label>
                                                                        <input type="text" name="ajb_price" class="form-control price-format" value="{{ number_format($unit->ajb_price ?? 0, 0, ',', '.') }}" placeholder="150.000.000">
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <label class="form-label fw-bold small">Hadap</label>
                                                                        <select name="facing" class="form-control">
                                                                            <option value="Utara" {{ $unit->facing == 'Utara' ? 'selected' : '' }}>Utara</option>
                                                                            <option value="Selatan" {{ $unit->facing == 'Selatan' ? 'selected' : '' }}>Selatan</option>
                                                                            <option value="Timur" {{ $unit->facing == 'Timur' ? 'selected' : '' }}>Timur</option>
                                                                            <option value="Barat" {{ $unit->facing == 'Barat' ? 'selected' : '' }}>Barat</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <label class="form-label fw-bold small">Posisi</label>
                                                                        <select name="position" class="form-control">
                                                                            <option value="Hook" {{ $unit->position == 'Hook' ? 'selected' : '' }}>Hook</option>
                                                                            <option value="Tengah" {{ $unit->position == 'Tengah' ? 'selected' : '' }}>Tengah</option>
                                                                            <option value="Sudut" {{ $unit->position == 'Sudut' ? 'selected' : '' }}>Sudut</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <label class="form-label fw-bold small">No. SPK</label>
                                                                        <input type="text" name="no_spk" class="form-control" value="{{ $unit->no_spk }}" placeholder="SPK/001/2026">
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <label class="form-label fw-bold small">Kontraktor</label>
                                                                        <input type="text" name="kontraktor" class="form-control" value="{{ $unit->kontraktor }}" placeholder="Nama Kontraktor">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="form-label fw-bold small">Upload SPK Baru (PDF)</label>
                                                                        <input type="file" name="dokumen_spk" class="form-control" accept=".pdf">
                                                                    </div>

                                                                    <div class="col-12">
                                                                        <label class="form-label fw-bold small">Keterangan Tambahan</label>
                                                                        <input type="text" name="description" class="form-control" value="{{ $unit->description }}" placeholder="Opsional">
                                                                    </div>
                                                                </div>

                                                                @if ($unit->dokumen_spk)
                                                                    <div class="mt-3 p-3 rounded-3 bg-light border d-flex justify-content-between align-items-center">
                                                                        <div class="d-flex align-items-center gap-2">
                                                                            <i class="mdi mdi-file-pdf text-danger" style="font-size: 1.5rem;"></i>
                                                                            <div>
                                                                                <span class="fw-bold small text-dark d-block">{{ basename($unit->dokumen_spk) }}</span>
                                                                                <small class="text-muted">Dokumen SPK terunggah</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex gap-1">
                                                                            <a href="{{ asset($unit->dokumen_spk) }}" target="_blank" class="btn btn-sm btn-outline-primary px-2 py-1">
                                                                                <i class="mdi mdi-eye me-1"></i>Lihat
                                                                            </a>
                                                                            <a href="{{ asset($unit->dokumen_spk) }}" download class="btn btn-sm btn-outline-success px-2 py-1">
                                                                                <i class="mdi mdi-download me-1"></i>Unduh
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                @endif
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
                                        <td colspan="11" class="text-center text-muted py-4">
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
                <div class="card-header bg-white d-flex align-items-center gap-2">
                    <span class="badge bg-primary bg-opacity-10 text-primary p-2 rounded-3">
                        <i class="mdi mdi-map" style="font-size: 1.1rem;"></i>
                    </span>
                    <h5 class="card-title mb-0 fw-bold text-dark">Denah Kavling Interaktif</h5>
                </div>

                <div class="card-body p-3 p-md-4">
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
                                <div class="col-md-3">
                                    <label class="form-label fw-bold small">Harga AJB (Rp)</label>
                                    <input type="text" name="ajb_price" class="form-control price-format" placeholder="150.000.000">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold small">Hadap</label>
                                    <select name="facing" class="form-control">
                                        <option value="Utara">Utara</option>
                                        <option value="Selatan">Selatan</option>
                                        <option value="Timur">Timur</option>
                                        <option value="Barat">Barat</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold small">Posisi</label>
                                    <select name="position" class="form-control">
                                        <option value="Hook">Hook</option>
                                        <option value="Tengah" selected>Tengah</option>
                                        <option value="Sudut">Sudut</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold small">No SPK</label>
                                    <input type="text" name="no_spk" class="form-control" placeholder="SPK/001/2026">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold small">Kontraktor</label>
                                    <input type="text" name="kontraktor" class="form-control" placeholder="Nama Kontraktor">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small">Upload SPK (PDF)</label>
                                    <input type="file" name="dokumen_spk" class="form-control" accept=".pdf">
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-bold small">Keterangan</label>
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

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
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
