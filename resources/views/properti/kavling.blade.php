@extends('layouts.partial.app')

@section('title', 'Semua Kavling - Property Management App')

@section('content')
<style>

.card {
    transition: all 0.3s ease;
    margin-bottom: 1rem;
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

/* Card Title */
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

/* ===== FILTER SECTION - DIPERKECIL ===== */
.filter-card {
    background: linear-gradient(135deg, #f9f7ff, #f2ecff);
    border-radius: 10px;
    padding: 0.5rem;
    margin-bottom: 0.75rem;
}

.filter-card .card-body {
    padding: 0.5rem !important;
}

.filter-card .form-label {
    font-size: 0.65rem;
    margin-bottom: 0.1rem;
}

.filter-card .form-control,
.filter-card .form-select {
    padding: 0.25rem 0.4rem;
    font-size: 0.7rem;
    border-radius: 6px;
    height: auto;
    min-height: 28px;
}

.filter-card .btn {
    padding: 0.2rem 0.4rem;
    font-size: 0.65rem;
    min-height: 28px;
}

/* Form Controls */
.form-control, .form-select {
    border: 1px solid #e9ecef;
    border-radius: 8px;
    padding: 0.4rem 0.6rem;
    font-size: 0.75rem;
    transition: all 0.2s ease;
    background-color: #ffffff;
    color: #2c2e3f;
    height: auto;
}

@media (min-width: 576px) {
    .form-control, .form-select {
        padding: 0.5rem 0.75rem;
        font-size: 0.8rem;
        border-radius: 10px;
    }
}

.form-control:focus, .form-select:focus {
    border-color: #9a55ff;
    box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.1);
    outline: none;
}

/* Form Label */
.form-label {
    font-size: 0.7rem;
    font-weight: 600;
    color: #9a55ff !important;
    margin-bottom: 0.2rem;
    letter-spacing: 0.3px;
    font-family: 'Nunito', sans-serif;
}

/* Button Styling */
.btn {
    font-size: 0.7rem;
    padding: 0.35rem 0.6rem;
    border-radius: 6px;
    font-weight: 600;
    transition: all 0.3s ease;
    font-family: 'Nunito', sans-serif;
    border: none;
}

@media (min-width: 576px) {
    .btn {
        font-size: 0.75rem;
        padding: 0.4rem 0.75rem;
        border-radius: 8px;
    }
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.btn-sm {
    padding: 0.2rem 0.4rem;
    font-size: 0.65rem;
    border-radius: 4px;
}

.btn-gradient-secondary {
    background: #6c757d !important;
    color: #ffffff !important;
}

.btn-gradient-secondary:hover {
    background: #5a6268 !important;
}

/* Outline Buttons - untuk icon aksi */
.btn-outline-primary {
    background: transparent;
    border: 1px solid #9a55ff;
    color: #9a55ff;
    padding: 0.25rem 0.5rem;
}

.btn-outline-primary:hover {
    background: linear-gradient(to right, #da8cff, #9a55ff);
    color: #ffffff;
    border-color: transparent;
}

/* Badge Styling */
.badge {
    padding: 0.25rem 0.4rem;
    font-size: 0.6rem;
    font-weight: 600;
    border-radius: 30px;
    display: inline-block;
    white-space: nowrap;
}

@media (min-width: 576px) {
    .badge {
        padding: 0.3rem 0.5rem;
        font-size: 0.65rem;
    }
}

.badge-sm {
    padding: 0.2rem 0.3rem;
    font-size: 0.55rem;
}

.badge-gradient-success {
    background: linear-gradient(135deg, #28a745, #5cb85c);
    color: #ffffff;
}

.badge-gradient-warning {
    background: linear-gradient(135deg, #ffc107, #ffdb6d);
    color: #2c2e3f;
}

.badge-gradient-danger {
    background: linear-gradient(135deg, #dc3545, #e4606d);
    color: #ffffff;
}

/* ===== TABLE STYLING ===== */
.table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    border-radius: 8px;
    margin-bottom: 0.5rem;
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
    font-size: 0.7rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 2px solid #e9ecef;
    padding: 0.6rem 0.25rem;
    white-space: nowrap;
}

@media (min-width: 576px) {
    .table thead th {
        font-size: 0.75rem;
        padding: 0.7rem 0.4rem;
    }
}

@media (min-width: 768px) {
    .table thead th {
        font-size: 0.8rem;
        padding: 0.8rem 0.5rem;
    }
}

/* Kolom No dan Nama Properti lebih rapat */
.table thead th:first-child {
    padding-left: 0.5rem;
    width: 45px;
}

.table tbody td:first-child {
    padding-left: 0.5rem;
    font-weight: 500;
    width: 45px;
}

.table tbody td {
    vertical-align: middle;
    font-size: 0.75rem;
    padding: 0.6rem 0.25rem;
    border-bottom: 1px solid #e9ecef;
    color: #2c2e3f;
}

@media (min-width: 576px) {
    .table tbody td {
        font-size: 0.8rem;
        padding: 0.7rem 0.4rem;
    }
}

@media (min-width: 768px) {
    .table tbody td {
        font-size: 0.85rem;
        padding: 0.8rem 0.5rem;
    }
}

.table tbody tr:hover {
    background-color: #f8f9fa;
}

/* Nama properti - lebih rapat dengan nomor */
.table tbody td:nth-child(2) {
    padding-left: 0.15rem;
}

.table tbody td .d-flex.align-items-center {
    gap: 0.25rem;
}

/* Kolom luas dengan teks lebih kecil untuk sisa */
.table tbody td .text-muted {
    font-size: 0.6rem;
}

/* Text colors */
.text-primary { color: #9a55ff !important; }
.text-info { color: #17a2b8 !important; }
.text-danger { color: #dc3545 !important; }
.text-success { color: #28a745 !important; }
.text-warning { color: #ffc107 !important; }
.fw-bold { font-weight: 600 !important; }
.text-muted { color: #a5b3cb !important; }

/* Pagination Styling */
.pagination {
    margin: 0;
    gap: 2px;
}

.page-item .page-link {
    border: 1px solid #e9ecef;
    padding: 0.3rem 0.6rem;
    font-size: 0.7rem;
    color: #6c7383;
    background-color: #ffffff;
    border-radius: 6px !important;
    transition: all 0.2s ease;
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

/* Typography */
h3.text-dark {
    font-size: 1.1rem !important;
    font-weight: 700;
    color: #2c2e3f !important;
    margin-bottom: 0.25rem !important;
}

@media (min-width: 576px) {
    h3.text-dark {
        font-size: 1.2rem !important;
    }
}

@media (min-width: 768px) {
    h3.text-dark {
        font-size: 1.3rem !important;
    }
}

/* Tooltip styling */
[data-bs-toggle="tooltip"] {
    cursor: pointer;
}

/* Badge dengan icon */
.badge i {
    font-size: 0.7rem;
    margin-right: 2px;
}

/* Hover effect untuk icon aksi */
.btn-outline-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

/* Responsive untuk mobile */
@media (max-width: 576px) {
    .table thead th {
        font-size: 0.65rem;
        padding: 0.5rem 0.2rem;
    }

    .table tbody td {
        font-size: 0.7rem;
        padding: 0.5rem 0.2rem;
    }

    .table tbody td .text-muted {
        font-size: 0.55rem;
    }

    .filter-card .form-label {
        font-size: 0.6rem;
    }

    .filter-card .form-control,
    .filter-card .form-select,
    .filter-card .btn {
        font-size: 0.6rem;
        min-height: 26px;
    }
}

/* DataTables Custom Styling - Sembunyikan elemen yang tidak diinginkan */
.dataTables_filter {
    display: none !important;
}

.dataTables_length {
    display: none !important;
}

.dataTables_paginate {
    display: none !important;
}

.dataTables_info {
    display: none !important;
}

/* Tetap tampilkan sorting indicator */
.sorting, .sorting_asc, .sorting_desc {
    cursor: pointer;
}

/* Icon styling */
.mdi {
    vertical-align: middle;
}
</style>

<div class="container-fluid p-2 p-sm-3 p-md-4">
    <!-- Header Dashboard - CARD TERPISAH -->
    <div class="row mb-3 mb-sm-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h3 class="text-dark mb-1">
                        <i class="mdi mdi-terrain me-2" style="color: #9a55ff;"></i>
                        Semua Tanah / LandBank Terverifikasi Dokument
                    </h3>
                    <p class="text-muted mb-0">
                        <i class="mdi mdi-information-outline me-1"></i>
                        Daftar tanah yang sudah terverifikasi dokumen legalnya
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel dengan Filter UI -->
    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center">
                    <h4 class="card-title">
                        <i class="mdi mdi-format-list-bulleted me-2"></i>
                        Daftar Tanah / LandBank Terverifikasi Terbaru
                    </h4>
                </div>
                <div class="card-body">
                    <!-- Filter Section - DIPERKECIL -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="filter-card">
                                <div class="card-body">
                                    <h6 class="card-title mb-2" style="font-size: 0.8rem;">
                                        <i class="mdi mdi-filter-outline me-1"></i>Filter Data
                                    </h6>

                                    <!-- FILTER UNTUK MOBILE -->
                                    <div class="d-block d-md-none">
                                        <div class="mb-2">
                                            <label class="form-label">
                                                <i class="mdi mdi-magnify me-1"></i>Pencarian
                                            </label>
                                            <input type="text" id="searchInputMobile" class="form-control" placeholder="Cari...">
                                        </div>

                                        <div class="row g-1">
                                            <div class="col-6">
                                                <label class="form-label">
                                                    <i class="mdi mdi-shape-outline me-1"></i>Kategori
                                                </label>
                                                <select id="filterKategoriMobile" class="form-control">
                                                    <option value="">Semua</option>
                                                    <option value="Rumah">Rumah</option>
                                                    <option value="Apartemen">Apartemen</option>
                                                    <option value="Ruko">Ruko</option>
                                                    <option value="Tanah">Tanah</option>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">
                                                    <i class="mdi mdi-map-marker me-1"></i>Lokasi
                                                </label>
                                                <select id="filterLokasiMobile" class="form-control">
                                                    <option value="">Semua</option>
                                                    <option value="Jakarta">Jakarta</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row g-1 mt-1">
                                            <div class="col-6">
                                                <label class="form-label">
                                                    <i class="mdi mdi-counter me-1"></i>Tampil
                                                </label>
                                                <select id="showDataMobile" class="form-control">
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select>
                                            </div>
                                            <div class="col-6 d-flex align-items-end">
                                                <button type="button" id="resetFilterMobile" class="btn btn-gradient-secondary w-100">
                                                    <i class="mdi mdi-refresh me-1"></i> Reset
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- FILTER UNTUK TABLET & DESKTOP -->
                                    <div class="d-none d-md-block">
                                        <div class="row g-1">
                                            <div class="col-md-4">
                                                <label class="form-label">
                                                    <i class="mdi mdi-magnify me-1"></i>Pencarian
                                                </label>
                                                <input type="text" id="searchInput" class="form-control" placeholder="Cari nama properti...">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">
                                                    <i class="mdi mdi-shape-outline me-1"></i>Kategori
                                                </label>
                                                <select id="filterKategori" class="form-control">
                                                    <option value="">Semua</option>
                                                    <option value="Rumah">Rumah</option>
                                                    <option value="Apartemen">Apartemen</option>
                                                    <option value="Ruko">Ruko</option>
                                                    <option value="Tanah">Tanah</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">
                                                    <i class="mdi mdi-map-marker me-1"></i>Lokasi
                                                </label>
                                                <select id="filterLokasi" class="form-control">
                                                    <option value="">Semua</option>
                                                    <option value="Jakarta">Jakarta</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">
                                                    <i class="mdi mdi-counter me-1"></i>Tampil
                                                </label>
                                                <select id="showData" class="form-control">
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select>
                                            </div>
                                            <div class="col-md-1 d-flex align-items-end">
                                                <button type="button" id="resetFilter" class="btn btn-gradient-secondary w-100" title="Reset Filter">
                                                    <i class="mdi mdi-refresh"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel Data -->
                    <div class="table-responsive">
                        <table id="tableKavling" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center"><i class="mdi mdi-counter me-1"></i>No</th>
                                    <th><i class="mdi mdi-home me-1"></i>Nama Properti</th>
                                    <th><i class="mdi mdi-shape-outline me-1"></i>Tipe</th>
                                    <th class="d-none d-md-table-cell"><i class="mdi mdi-map-marker me-1"></i>Lokasi</th>
                                    <th><i class="mdi mdi-currency-usd me-1"></i>Harga</th>
                                    <th><i class="mdi mdi-ruler-square me-1"></i>Luas</th>
                                    <th><i class="mdi mdi-chart-arc me-1"></i>Status</th>
                                    <th class="text-center"><i class="mdi mdi-cog me-1"></i>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($lands as $i => $land)
                                    @php
                                        $totalUnitArea = $land->units->sum('area');
                                        $remainingArea = $land->area - $totalUnitArea;
                                    @endphp
                                    <tr>
                                        <td class="text-center fw-bold">
                                            <span class="badge bg-light text-dark">{{ $i + $lands->firstItem() }}</span>
                                        </td>

                                        {{-- NAMA PROPERTI (rapat dengan nomor) --}}
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-home-variant text-primary me-1" style="font-size: 0.9rem;"></i>
                                                <span class="fw-bold">{{ Str::limit($land->name ?? '-', 20) }}</span>
                                            </div>
                                            <small class="text-muted d-block d-md-none">
                                                <i class="mdi mdi-map-marker me-1"></i>{{ Str::limit($land->address ?? '-', 15) }}
                                            </small>
                                        </td>

                                        {{-- TIPE --}}
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if(($land->zoning ?? 'Tanah') == 'Rumah')
                                                    <i class="mdi mdi-home-city text-info me-1" style="font-size: 0.9rem;"></i>
                                                @elseif(($land->zoning ?? 'Tanah') == 'Apartemen')
                                                    <i class="mdi mdi-office-building text-info me-1" style="font-size: 0.9rem;"></i>
                                                @elseif(($land->zoning ?? 'Tanah') == 'Ruko')
                                                    <i class="mdi mdi-store text-info me-1" style="font-size: 0.9rem;"></i>
                                                @elseif(($land->zoning ?? 'Tanah') == 'Tanah')
                                                    <i class="mdi mdi-terrain text-info me-1" style="font-size: 0.9rem;"></i>
                                                @else
                                                    <i class="mdi mdi-shape-outline text-info me-1" style="font-size: 0.9rem;"></i>
                                                @endif
                                                <span>{{ $land->zoning ?? 'Tanah' }}</span>
                                            </div>
                                        </td>

                                        {{-- LOKASI --}}
                                        <td class="d-none d-md-table-cell">
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-map-marker text-danger me-1" style="font-size: 0.9rem;"></i>
                                                <span>{{ Str::limit($land->address ?? '-', 15) }}</span>
                                            </div>
                                        </td>

                                        {{-- HARGA --}}
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-currency-usd text-success me-1" style="font-size: 0.9rem;"></i>
                                                <span class="text-nowrap fw-bold text-success">Rp {{ number_format($land->acquisition_price ?? 0, 0, ',', '.') }}</span>
                                            </div>
                                        </td>

                                        {{-- LUAS TANAH (Gabungan) --}}
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-ruler-square text-warning me-1" style="font-size: 0.9rem;"></i>
                                                <div>
                                                    <span class="text-nowrap">{{ number_format($land->area ?? 0, 0, ',', '.') }} m²</span>
                                                    <small class="text-muted d-block">
                                                        <i class="mdi mdi-information-outline me-1"></i>
                                                        Sisa: {{ number_format($remainingArea, 0, ',', '.') }} m²
                                                    </small>
                                                </div>
                                            </div>
                                        </td>

                                        {{-- STATUS --}}
                                        <td>
                                            @if ($land->status == 'sold')
                                                <span class="badge badge-gradient-danger">
                                                    <i class="mdi mdi-cash me-1"></i>Terjual
                                                </span>
                                            @elseif($land->status == 'booking')
                                                <span class="badge badge-gradient-warning">
                                                    <i class="mdi mdi-calendar-clock me-1"></i>Booking
                                                </span>
                                            @else
                                                <span class="badge badge-gradient-success">
                                                    <i class="mdi mdi-check-circle me-1"></i>Tersedia
                                                </span>
                                            @endif
                                        </td>

                                        {{-- AKSI (Hanya Buat Kavling) --}}
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
                                        <td colspan="8" class="text-center text-muted py-5">
                                            <i class="mdi mdi-terrain" style="font-size: 3rem; opacity: 0.3;"></i>
                                            <p class="mt-3">
                                                <i class="mdi mdi-information-outline me-2"></i>
                                                Belum ada properti terverifikasi
                                            </p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Laravel -->
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-3">
                        <div class="text-muted small mb-2 mb-sm-0">
                            <i class="mdi mdi-information-outline me-1"></i>
                            Menampilkan {{ $lands->firstItem() }} - {{ $lands->lastItem() }} dari {{ $lands->total() }} data
                        </div>
                        <div class="d-flex justify-content-center">
                            {{ $lands->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Inisialisasi DataTables - hanya untuk sorting
    let table = $('#tableKavling').DataTable({
        responsive: true,
        paging: false,        // MATIKAN pagination DataTables
        info: false,          // MATIKAN info DataTables
        searching: false,     // MATIKAN search bawaan
        lengthChange: false,  // MATIKAN length change
        ordering: true,       // AKTIFKAN sorting saja
        language: {
            emptyTable: "Data kosong",
            zeroRecords: "Data tidak ditemukan",
        },
        columnDefs: [
            { orderable: false, targets: [0, 7] } // Non-aktifkan sorting untuk kolom No dan Aksi
        ]
    });

    // Inisialisasi tooltip Bootstrap
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
});
</script>
@endpush
