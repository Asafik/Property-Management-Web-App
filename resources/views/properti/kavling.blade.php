@extends('layouts.partial.app')

@section('title', 'Semua Tanah / LandBank Terverifikasi Dokument - Property Management App')

@section('content')

<style>
.card {
    transition: all 0.3s ease;
    margin-bottom: 1rem;
    border: none !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
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
    .card-header { padding: 1rem; }
}
@media (min-width: 768px) {
    .card-header { padding: 1.2rem; }
}

.card-body { padding: 0.75rem; }
@media (min-width: 576px) {
    .card-body { padding: 1rem; }
}
@media (min-width: 768px) {
    .card-body { padding: 1.2rem; }
}

.card-title {
    font-size: 0.9rem;
    font-weight: 600;
    color: #9a55ff;
    margin-bottom: 0;
}
@media (min-width: 576px) {
    .card-title { font-size: 1rem; }
}
@media (min-width: 768px) {
    .card-title { font-size: 1.1rem; }
}

.filter-card {
    background: linear-gradient(135deg, #f9f7ff, #f2ecff);
    border-radius: 12px;
    padding: 1rem;
    margin-bottom: 1.25rem;
    border: none;
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
    min-height: 40px;
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
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
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

.btn-outline-primary {
    background: transparent;
    border: 1px solid #9a55ff;
    color: #9a55ff;
    padding: 0.4rem 0.75rem;
}
.btn-outline-primary:hover {
    background: linear-gradient(to right, #da8cff, #9a55ff);
    color: #ffffff;
    border-color: transparent;
}

.btn-sm {
    padding: 0.35rem 0.7rem;
    font-size: 0.8rem;
    border-radius: 6px;
    height: 32px;
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

.table thead th:first-child, .table thead th.action-cell, .table thead th.no-sort {
    cursor: default;
}
.table thead th:first-child:hover, .table thead th.action-cell:hover, .table thead th.no-sort:hover {
    color: #9a55ff;
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
    white-space: nowrap;
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

.category-text {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    font-weight: 600;
    color: #2c2e3f;
}

.location-cell {
    max-width: 220px;
}

.location-text {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    max-width: 100%;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.location-text .location-label {
    display: inline-block;
    max-width: 180px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
@media (max-width: 767px) {
    .location-text .location-label {
        max-width: 130px;
    }
}

.badge-status {
    padding: 0.35rem 0.8rem;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.82rem;
    display: inline-block;
    color: #fff;
}
.badge-status.available {
    background: linear-gradient(135deg, #28a745, #5fd17a);
}
.badge-status.booking {
    background: linear-gradient(135deg, #ffc107, #ffdb6d);
    color: #2c2e3f;
}
.badge-status.sold {
    background: linear-gradient(135deg, #dc3545, #e4606d);
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

.text-primary { color: #9a55ff !important; }
.text-success { color: #28a745 !important; }
.text-info { color: #17a2b8 !important; }
.text-danger { color: #dc3545 !important; }
.text-muted { color: #a5b3cb !important; }
.fw-bold { font-weight: 600 !important; }

h3.text-dark {
    font-size: 1.3rem !important;
    font-weight: 700;
    color: #2c2e3f !important;
    margin-bottom: 0.5rem !important;
}
@media (min-width: 576px) {
    h3.text-dark { font-size: 1.5rem !important; }
}
@media (min-width: 768px) {
    h3.text-dark { font-size: 1.7rem !important; }
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
    .filter-row-desktop { display: none; }
    .filter-row-mobile { display: block; margin-top: 1rem; }
}
</style>

<div class="container-fluid p-2 p-sm-3 p-md-4">

    <div class="row mb-3 mb-sm-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="text-dark mb-1">
                            <i class="mdi mdi-home-city-outline me-2" style="color: #9a55ff;"></i>
                            Semua Tanah / LandBank Terverifikasi Dokument
                        </h3>
                        <p class="text-muted mb-0">
                            Daftar tanah yang sudah terverifikasi dokumen legalnya
                        </p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-map-marker-radius" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
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
                        <i class="mdi mdi-format-list-bulleted me-2"></i>Daftar Tanah / LandBank Terverifikasi Terbaru
                    </h5>
                </div>

                <div class="card-body">
                    <div class="filter-card mb-4">
                        <div class="card-body p-0">

                            <div class="filter-row-desktop">
                                <div class="filter-text">
                                    <i class="mdi mdi-filter-outline"></i>
                                    <span>Filter data tanah / landbank</span>
                                </div>

                                <form method="GET" action="{{ route('kavling.index') }}">
                                    <div class="row g-2 align-items-end w-100">
                                        <div class="col-md-3">
                                            <label class="form-label">Search</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                name="search"
                                                id="searchInput"
                                                value="{{ request('search') }}"
                                                placeholder="Cari properti ....."
                                            >
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Kategori</label>
                                            <select class="form-control" name="type" id="categorySelect">
                                                <option value="">Semua Kategori</option>
                                                @foreach($types as $type)
                                                    <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>
                                                        {{ $type }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Status</label>
                                            <select class="form-control" name="status" id="statusSelect">
                                                <option value="">Semua Status</option>
                                                <option value="sold" {{ request('status') == 'sold' ? 'selected' : '' }}>Terjual</option>
                                                <option value="booking" {{ request('status') == 'booking' ? 'selected' : '' }}>Booking</option>
                                                <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Tersedia</option>
                                            </select>
                                        </div>

                                        <div class="col-md-1">
                                            <label class="form-label">Tampil</label>
                                            <select class="form-control" name="per_page" id="showSelect">
                                                <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                                <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label invisible d-none d-md-block">Aksi</label>
                                            <div class="d-flex gap-2">
                                                <button type="submit" class="btn btn-gradient-primary btn-icon-only flex-fill" title="Filter" onclick="showFilterLoading()">
                                                    <i class="mdi mdi-filter"></i>
                                                </button>
                                                <a href="{{ route('kavling.index') }}" class="btn btn-gradient-secondary btn-icon-only flex-fill" title="Reset" onclick="showResetLoading(event)">
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
                                    <span>Filter data tanah / landbank</span>
                                </div>

                                <form method="GET" action="{{ route('kavling.index') }}">
                                    <div class="row g-2">
                                        <div class="col-12 mb-2">
                                            <label class="form-label">Search</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                name="search"
                                                id="searchInputMobile"
                                                value="{{ request('search') }}"
                                                placeholder="Cari nama properti / lokasi..."
                                            >
                                        </div>

                                        <div class="col-12 mb-2">
                                            <label class="form-label">Kategori</label>
                                            <select class="form-control" name="type" id="categorySelectMobile">
                                                <option value="">Semua Kategori</option>
                                                @foreach($types as $type)
                                                    <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>
                                                        {{ $type }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-12 mb-2">
                                            <label class="form-label">Status</label>
                                            <select class="form-control" name="status" id="statusSelectMobile">
                                                <option value="">Semua Status</option>
                                                <option value="sold" {{ request('status') == 'sold' ? 'selected' : '' }}>Terjual</option>
                                                <option value="booking" {{ request('status') == 'booking' ? 'selected' : '' }}>Booking</option>
                                                <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Tersedia</option>
                                            </select>
                                        </div>

                                        <div class="col-12 mb-2">
                                            <label class="form-label">Tampil</label>
                                            <select class="form-control" name="per_page" id="showSelectMobile">
                                                <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                                <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                                            </select>
                                        </div>

                                        <div class="col-6">
                                            <button type="submit" class="btn btn-gradient-primary btn-icon-only-mobile w-100" onclick="showFilterLoading()">
                                                <i class="mdi mdi-filter"></i> Filter
                                            </button>
                                        </div>

                                        <div class="col-6">
                                            <a href="{{ route('kavling.index') }}" class="btn btn-gradient-secondary btn-icon-only-mobile w-100" onclick="showResetLoading(event)">
                                                <i class="mdi mdi-refresh"></i> Reset
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
                                    <th class="sortable {{ request('sort') == 'name' ? 'active-sort' : '' }}" data-field="name" data-direction="{{ request('sort') == 'name' ? (request('direction') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Nama Properti
                                        @if(request('sort') == 'name')
                                            <i class="mdi mdi-{{ request('direction') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable {{ request('sort') == 'zoning' ? 'active-sort' : '' }}" data-field="zoning" data-direction="{{ request('sort') == 'zoning' ? (request('direction') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Kategori
                                        @if(request('sort') == 'zoning')
                                            <i class="mdi mdi-{{ request('direction') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="no-sort">Lokasi</th>
                                    <th class="sortable {{ request('sort') == 'acquisition_price' ? 'active-sort' : '' }}" data-field="acquisition_price" data-direction="{{ request('sort') == 'acquisition_price' ? (request('direction') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Harga
                                        @if(request('sort') == 'acquisition_price')
                                            <i class="mdi mdi-{{ request('direction') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable {{ request('sort') == 'area' ? 'active-sort' : '' }}" data-field="area" data-direction="{{ request('sort') == 'area' ? (request('direction') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Luas Tanah
                                        @if(request('sort') == 'area')
                                            <i class="mdi mdi-{{ request('direction') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="no-sort">Sisa Tanah</th>
                                    <th class="sortable {{ request('sort') == 'status' ? 'active-sort' : '' }}" data-field="status" data-direction="{{ request('sort') == 'status' ? (request('direction') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Status
                                        @if(request('sort') == 'status')
                                            <i class="mdi mdi-{{ request('direction') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="text-center action-cell">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($lands as $index => $land)
                                    @php
                                        $totalUnitArea = $land->units->sum('area');
                                        $remainingArea = ($land->area ?? 0) - $totalUnitArea;
                                    @endphp
                                    <tr>
                                        <td class="text-center fw-bold">{{ $index + $lands->firstItem() }}</td>

                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-home-city text-primary me-2" style="font-size: 1.2rem;"></i>
                                                <span class="fw-bold">{{ $land->name ?? '-' }}</span>
                                            </div>
                                        </td>

                                        <td>
                                            <span class="category-text">
                                                @if(($land->zoning ?? 'Tanah') == 'Rumah')
                                                    <i class="mdi mdi-home-city text-primary"></i>
                                                @elseif(($land->zoning ?? 'Tanah') == 'Apartemen')
                                                    <i class="mdi mdi-office-building text-primary"></i>
                                                @elseif(($land->zoning ?? 'Tanah') == 'Ruko')
                                                    <i class="mdi mdi-store text-primary"></i>
                                                @elseif(($land->zoning ?? 'Tanah') == 'Tanah')
                                                    <i class="mdi mdi-terrain text-primary"></i>
                                                @else
                                                    <i class="mdi mdi-shape-outline text-primary"></i>
                                                @endif
                                                {{ $land->zoning ?? 'Tanah' }}
                                            </span>
                                        </td>

                                        <td class="location-cell">
                                            <span class="location-text" title="{{ $land->address ?? '-' }}">
                                                <i class="mdi mdi-map-marker text-danger"></i>
                                                <span class="location-label">{{ $land->address ?? '-' }}</span>
                                            </span>
                                        </td>

                                        <td class="fw-bold text-success">
                                            Rp {{ number_format($land->acquisition_price ?? 0, 0, ',', '.') }}
                                        </td>

                                        <td>{{ number_format($land->area ?? 0, 0, ',', '.') }} m²</td>
                                        <td>{{ number_format($remainingArea, 0, ',', '.') }} m²</td>

                                        <td>
                                            @if ($land->status == 'sold')
                                                <span class="badge-status sold">
                                                    <i class="mdi mdi-close-circle-outline me-1"></i>Terjual
                                                </span>
                                            @elseif($land->status == 'booking')
                                                <span class="badge-status booking">
                                                    <i class="mdi mdi-calendar-clock me-1"></i>Booking
                                                </span>
                                            @else
                                                <span class="badge-status available">
                                                    <i class="mdi mdi-check-circle-outline me-1"></i>Tersedia
                                                </span>
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            <a href="{{ route('properti.buatKavling', ['land_bank_id' => $land->id]) }}"
                                               class="btn btn-outline-primary btn-sm"
                                               data-bs-toggle="tooltip"
                                               title="Buat Kavling">
                                                <i class="mdi mdi-pencil-ruler"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted py-4">
                                            Tidak ada data tanah / landbank terverifikasi
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                        <div class="pagination-info mb-2 mb-sm-0">
                            Menampilkan {{ $lands->firstItem() ?? 0 }} - {{ $lands->lastItem() ?? 0 }} dari {{ $lands->total() }} data
                        </div>

                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                <li class="page-item {{ $lands->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $lands->previousPageUrl() }}" {{ !$lands->onFirstPage() ? 'onclick=showPaginationLoading(event)' : '' }}>
                                        <i class="mdi mdi-chevron-left"></i>
                                    </a>
                                </li>

                                @for($page = 1; $page <= $lands->lastPage(); $page++)
                                    <li class="page-item {{ $page == $lands->currentPage() ? 'active' : '' }}">
                                        @if($page == $lands->currentPage())
                                            <span class="page-link">{{ $page }}</span>
                                        @else
                                            <a class="page-link" href="{{ $lands->appends(request()->query())->url($page) }}" onclick="showPaginationLoading(event)">{{ $page }}</a>
                                        @endif
                                    </li>
                                @endfor

                                <li class="page-item {{ $lands->hasMorePages() ? '' : 'disabled' }}">
                                    <a class="page-link" href="{{ $lands->nextPageUrl() }}" {{ $lands->hasMorePages() ? 'onclick=showPaginationLoading(event)' : '' }}>
                                        <i class="mdi mdi-chevron-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

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
            url.searchParams.set('sort', field);
            url.searchParams.set('direction', direction);
            url.searchParams.set('page', 1);

            window.location.href = url.toString();
        });
    });
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
    if (event.currentTarget.parentElement.classList.contains('disabled')) return;
    event.preventDefault();
    Swal.fire({
        title: 'Memuat...',
        html: 'Sedang memuat halaman',
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
    });
    window.location.href = event.currentTarget.href;
}
</script>
@endpush
