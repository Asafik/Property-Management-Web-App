@extends('layouts.partial.app')

@section('title', 'Semua Properti - Property Management App')

@section('content')
<style>
/* ===== MODERN STYLING UNTUK HALAMAN SEMUA PROPERTI ===== */

/* ===== CARD STYLING - PAKAI BAWAAN BOOTSTRAP ===== */
.card {
    transition: all 0.3s ease;
    margin-bottom: 1rem;
}

.card:hover {
    box-shadow: 0 8px 25px rgba(154, 85, 255, 0.1) !important;
}

.card-header {
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

/* ===== FILTER SECTION - COMPACT ===== */
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

/* BUTTON FILTER RESET - WARNA ABU-ABU */
.btn-filter-reset {
    background: #6c757d !important;
    color: #ffffff !important;
    border: none;
}

.btn-filter-reset:hover {
    background: #5a6268 !important;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

/* Gradient Buttons */
.btn-gradient-secondary {
    background: #6c757d !important;
    color: #ffffff !important;
}

.btn-gradient-secondary:hover {
    background: #5a6268 !important;
}

.btn-gradient-info {
    background: linear-gradient(135deg, #17a2b8, #5bc0de) !important;
    color: #ffffff !important;
}

.btn-gradient-success {
    background: linear-gradient(135deg, #28a745, #5cb85c) !important;
    color: #ffffff !important;
}

.btn-gradient-warning {
    background: linear-gradient(135deg, #ffc107, #ffdb6d) !important;
    color: #2c2e3f !important;
}

.btn-gradient-danger {
    background: linear-gradient(135deg, #dc3545, #e4606d) !important;
    color: #ffffff !important;
}

.btn-gradient-primary {
    background: linear-gradient(to right, #da8cff, #9a55ff) !important;
    color: #ffffff !important;
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

@media (min-width: 768px) {
    .badge {
        padding: 0.35rem 0.6rem;
        font-size: 0.7rem;
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

.badge-gradient-info {
    background: linear-gradient(135deg, #17a2b8, #5bc0de);
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

/* Kolom No - lebih rapat */
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

/* Icon dalam tabel */
.table tbody td i {
    font-size: 0.9rem;
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

@media (min-width: 576px) {
    .page-item .page-link {
        padding: 0.4rem 0.8rem;
        font-size: 0.75rem;
    }
}

@media (min-width: 768px) {
    .page-item .page-link {
        padding: 0.5rem 1rem;
        font-size: 0.8rem;
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

/* Typography */
h3.text-dark,
h4.text-dark {
    font-size: 1.1rem !important;
    font-weight: 700;
    color: #2c2e3f !important;
    margin-bottom: 0.25rem !important;
}

@media (min-width: 576px) {
    h3.text-dark,
    h4.text-dark {
        font-size: 1.2rem !important;
    }
}

@media (min-width: 768px) {
    h3.text-dark,
    h4.text-dark {
        font-size: 1.3rem !important;
    }
}

@media (min-width: 992px) {
    h3.text-dark,
    h4.text-dark {
        font-size: 1.5rem !important;
    }
}

/* Modal Styling */
.modal-content {
    border: none;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.modal-header {
    background: linear-gradient(135deg, #ffffff, #f8f9fa);
    border-bottom: 1px solid #e9ecef;
    padding: 1rem;
    border-radius: 16px 16px 0 0;
}

.modal-title {
    font-size: 1rem;
    font-weight: 700;
    color: #9a55ff;
}

.modal-body {
    padding: 1.2rem;
}

.modal-footer {
    border-top: 1px solid #e9ecef;
    padding: 1rem;
    border-radius: 0 0 16px 16px;
}

/* Border styling */
.border-start.border-4 {
    border-left-width: 4px !important;
}

.border-start.border-4.border-danger {
    border-left-color: #dc3545 !important;
}

.bg-light {
    background-color: #f8f9fc !important;
}

.text-danger {
    color: #dc3545 !important;
}

/* Responsive spacing */
.mb-2 {
    margin-bottom: 0.5rem !important;
}

.mt-2 {
    margin-top: 0.5rem !important;
}

.g-2 {
    gap: 0.3rem !important;
}

@media (min-width: 576px) {
    .g-2 {
        gap: 0.5rem !important;
    }
}

/* Better touch targets for mobile */
input, select, textarea, button {
    font-size: 16px !important;
}

/* Grid spacing */
.row.g-2 {
    margin-right: -0.15rem;
    margin-left: -0.15rem;
}

.row.g-2 > [class*="col-"] {
    padding-right: 0.15rem;
    padding-left: 0.15rem;
}

@media (min-width: 576px) {
    .row.g-2 {
        margin-right: -0.25rem;
        margin-left: -0.25rem;
    }

    .row.g-2 > [class*="col-"] {
        padding-right: 0.25rem;
        padding-left: 0.25rem;
    }
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

/* Badge dengan icon */
.badge i {
    font-size: 0.7rem;
    margin-right: 2px;
}

/* ===== ACTION BUTTONS DENGAN TEXT ===== */
.action-text {
    display: inline-block;
    padding: 0.25rem 0.5rem;
    font-size: 0.7rem;
    font-weight: 600;
    border-radius: 4px;
    text-decoration: none;
    white-space: nowrap;
}

.action-text-verify {
    background: linear-gradient(135deg, #28a745, #5cb85c);
    color: white;
}

.action-text-verify:hover {
    background: linear-gradient(135deg, #218838, #4cae4c);
    color: white;
    text-decoration: none;
}

.action-text-verified {
    background: #6c757d;
    color: white;
}

.action-text-rejected {
    background: #dc3545;
    color: white;
}

.action-text-none {
    background: #e9ecef;
    color: #6c7383;
}

/* Hover effect untuk action text */
.action-text-verify:hover,
.action-text-verified:hover,
.action-text-rejected:hover,
.action-text-none:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}
</style>

<div class="container-fluid p-2 p-sm-3 p-md-4">
    <!-- Header Card Terpisah -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-1 fw-bold text-dark">
                            Semua Properti
                        </h4>
                        <p class="mb-0 text-muted small">
                            Daftar seluruh properti yang terdaftar dalam sistem
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel dengan Filter UI -->
    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white">
                    <h4 class="card-title">Daftar Semua Properti</h4>
                </div>
                <div class="card-body">
                    <!-- Filter Section - COMPACT -->
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
                                            <label class="form-label">Pencarian</label>
                                            <input type="text" class="form-control" placeholder="Cari...">
                                        </div>

                                        <div class="row g-1">
                                            <div class="col-6">
                                                <label class="form-label">Kategori</label>
                                                <select class="form-control">
                                                    <option value="">Semua</option>
                                                    <option value="Rumah">Rumah</option>
                                                    <option value="Apartemen">Apartemen</option>
                                                    <option value="Ruko">Ruko</option>
                                                    <option value="Tanah">Tanah</option>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">Lokasi</label>
                                                <select class="form-control">
                                                    <option value="">Semua</option>
                                                    <option value="Jakarta">Jakarta</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row g-1 mt-1">
                                            <div class="col-6">
                                                <label class="form-label">Tampil</label>
                                                <select class="form-control">
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                </select>
                                            </div>
                                            <div class="col-6 d-flex align-items-end">
                                                <button type="button" class="btn btn-filter-reset w-100">
                                                    <i class="mdi mdi-refresh"></i> Reset
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- FILTER UNTUK TABLET & DESKTOP -->
                                    <div class="d-none d-md-block">
                                        <div class="row g-1">
                                            <div class="col-md-4">
                                                <label class="form-label">Pencarian</label>
                                                <input type="text" class="form-control" placeholder="Cari nama properti...">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Kategori</label>
                                                <select class="form-control">
                                                    <option value="">Semua</option>
                                                    <option value="Rumah">Rumah</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Lokasi</label>
                                                <select class="form-control">
                                                    <option value="">Semua</option>
                                                    <option value="Jakarta">Jakarta</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Tampil</label>
                                                <select class="form-control">
                                                    <option value="10">10</option>
                                                </select>
                                            </div>
                                            <div class="col-md-1 d-flex align-items-end">
                                                <button type="button" class="btn btn-filter-reset w-100">
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
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center"><i class="mdi mdi-counter me-1"></i>No</th>
                                    <th><i class="mdi mdi-home me-1"></i>Nama Properti</th>
                                    <th><i class="mdi mdi-shape-outline me-1"></i>Kategori</th>
                                    <th class="d-none d-md-table-cell"><i class="mdi mdi-map-marker me-1"></i>Lokasi</th>
                                    <th><i class="mdi mdi-currency-usd me-1"></i>Harga Beli</th>
                                    <th><i class="mdi mdi-gavel me-1"></i>Legalitas</th>
                                    <th><i class="mdi mdi-hammer me-1"></i>Pembangunan</th>
                                    <th class="text-center"><i class="mdi mdi-file-document me-1"></i>Dokumen</th>
                                    <th class="text-center"><i class="mdi mdi-cog me-1"></i>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($landBanks as $index => $item)
                                    <tr>
                                        <td class="text-center fw-bold">{{ $landBanks->firstItem() + $index }}</td>

                                        {{-- NAMA PROPERTI --}}
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-home text-primary me-1" style="font-size: 0.9rem;"></i>
                                                <span class="fw-bold">{{ Str::limit($item->name, 25) }}</span>
                                            </div>
                                        </td>

                                        {{-- KATEGORI --}}
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-shape-outline text-info me-1" style="font-size: 0.9rem;"></i>
                                                <span>{{ $item->zoning ?? 'Tanah' }}</span>
                                            </div>
                                        </td>

                                        {{-- LOKASI --}}
                                        <td class="d-none d-md-table-cell">
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-map-marker text-danger me-1" style="font-size: 0.9rem;"></i>
                                                <span>{{ Str::limit($item->address ?? '-', 20) }}</span>
                                            </div>
                                        </td>

                                        {{-- HARGA BELI --}}
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-currency-usd text-success me-1" style="font-size: 0.9rem;"></i>
                                                <span class="text-nowrap">Rp {{ number_format($item->acquisition_price, 0, ',', '.') }}</span>
                                            </div>
                                        </td>

                                        {{-- STATUS LEGALITAS --}}
                                        <td>
                                            @if ($item->legal_status == 'terverifikasi')
                                                <span class="badge badge-gradient-success">
                                                    <i class="mdi mdi-check-circle me-1"></i>Terverifikasi
                                                </span>
                                            @elseif ($item->legal_status == 'Pending')
                                                <span class="badge badge-gradient-warning">
                                                    <i class="mdi mdi-clock me-1"></i>Pending
                                                </span>
                                            @else
                                                <span class="badge badge-gradient-danger">
                                                    <i class="mdi mdi-close-circle me-1"></i>Revisi
                                                </span>
                                            @endif
                                        </td>

                                        {{-- STATUS PEMBANGUNAN --}}
                                        <td>
                                            @if ($item->development_status == 'Selesai')
                                                <span class="badge badge-gradient-success">
                                                    <i class="mdi mdi-check me-1"></i>Selesai
                                                </span>
                                            @elseif ($item->development_status == 'progress')
                                                <span class="badge badge-gradient-warning">
                                                    <i class="mdi mdi-progress-clock me-1"></i>Progress
                                                </span>
                                            @else
                                                <span class="badge badge-gradient-danger">
                                                    <i class="mdi mdi-close me-1"></i>Belum
                                                </span>
                                            @endif
                                        </td>

                                        {{-- DOKUMEN --}}
                                        <td class="text-center">
                                            <button type="button" class="btn btn-gradient-info btn-sm" data-bs-toggle="modal" data-bs-target="#documentModal{{ $item->id }}" title="Lihat Dokumen">
                                                <i class="mdi mdi-file-document"></i>
                                                <span class="badge bg-light text-dark ms-1">{{ $item->documents->count() }}</span>
                                            </button>

                                            <!-- Modal Dokumen -->
                                            <div class="modal fade" id="documentModal{{ $item->id }}" tabindex="-1" aria-labelledby="documentModalLabel{{ $item->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="documentModalLabel{{ $item->id }}">
                                                                Dokumen - {{ $item->name }}
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @if ($item->documents->count() > 0)
                                                                <div class="table-responsive">
                                                                    <table class="table table-bordered table-sm align-middle">
                                                                        <thead class="table-light">
                                                                            <tr>
                                                                                <th>Nomer Dokumen</th>
                                                                                <th>Tipe</th>
                                                                                <th>Status</th>
                                                                                <th width="100">Aksi</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($item->documents as $doc)
                                                                                <tr>
                                                                                    <td>{{ $doc->document_number }} -- {{ $doc->landbank->ownership_status ?? '-' }} / {{ $doc->landbank->certificate_owner ?? '-' }}</td>
                                                                                    <td>{{ $doc->type }}</td>
                                                                                    <td>
                                                                                        @if ($doc->status == 'pending')
                                                                                            <span class="badge badge-gradient-warning">Pending</span>
                                                                                        @elseif($doc->status == 'ditolak')
                                                                                            <span class="badge badge-gradient-danger">Ditolak</span>
                                                                                        @elseif($doc->status == 'terverifikasi')
                                                                                            <span class="badge badge-gradient-success">Terverifikasi</span>
                                                                                        @else
                                                                                            <span class="badge bg-secondary">{{ ucfirst($doc->status) }}</span>
                                                                                        @endif
                                                                                    </td>
                                                                                    <td>
                                                                                        <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" class="btn btn-gradient-primary btn-sm">
                                                                                            Lihat
                                                                                        </a>
                                                                                    </td>
                                                                                </tr>
                                                                                @if ($doc->status === 'ditolak' && !empty($doc->catatan_admin))
                                                                                    <tr>
                                                                                        <td colspan="4">
                                                                                            <div class="border-start border-4 border-danger ps-3 py-2 bg-light text-danger small">
                                                                                                <strong>Alasan Ditolak:</strong> {{ $doc->catatan_admin }}
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endif
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            @else
                                                                <div class="text-center text-muted py-3">
                                                                    <i class="mdi mdi-information-outline me-2"></i>
                                                                    Tidak ada dokumen.
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">
                                                                Tutup
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        {{-- AKSI DENGAN TEXT --}}
                                        <td class="text-center">
                                            @if($item->documents->first() && $item->documents->first()->status == 'pending')
                                                <a href="{{ route('properti.verifikasi', $item->id) }}" class="action-text action-text-verify">
                                                    <i class="mdi mdi-check-decagram me-1"></i>Verifikasi
                                                </a>
                                            @elseif($item->documents->first() && $item->documents->first()->status == 'terverifikasi')
                                                <span class="action-text action-text-verified">
                                                    <i class="mdi mdi-check me-1"></i>Sudah Verif
                                                </span>
                                            @elseif($item->documents->first() && $item->documents->first()->status == 'ditolak')
                                                <span class="action-text action-text-rejected">
                                                    <i class="mdi mdi-close me-1"></i>Ditolak
                                                </span>
                                            @else
                                                <span class="action-text action-text-none">
                                                    <i class="mdi mdi-minus me-1"></i>No Data
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted py-4">
                                            <i class="mdi mdi-information-outline me-2"></i>
                                            Data belum tersedia
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-3">
                        <div class="text-muted small mb-2 mb-sm-0">
                            <i class="mdi mdi-information-outline me-1"></i>
                            Menampilkan {{ $landBanks->firstItem() }} - {{ $landBanks->lastItem() }} dari {{ $landBanks->total() }} data
                        </div>
                        <div class="d-flex justify-content-center">
                            {{ $landBanks->links() }}
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
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi tooltip
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });
</script>
@endpush
