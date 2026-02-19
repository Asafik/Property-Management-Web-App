@extends('layouts.partial.app')

@section('title', 'Buat Kavling - Property Management App')

@section('content')
<style>
/* Custom Tab Styling - BootstrapDash style */
.add-custom-tabs-wrapper {
    background: #f6f9ff;
    border-radius: 8px;
    padding: 6px;
    margin-bottom: 25px;
    border: 1px solid #e9ecef;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

.add-custom-tabs {
    display: flex;
    flex-wrap: nowrap;
    gap: 4px;
    list-style: none;
    padding: 0;
    margin: 0;
    min-width: min-content;
}

.add-custom-tab-item {
    flex: 0 0 auto;
}

.add-custom-tab-link {
    display: flex;
    align-items: center;
    padding: 10px 16px;
    font-size: 0.85rem;
    font-weight: 500;
    color: #6c7383;
    background: transparent;
    border: none;
    border-radius: 6px;
    text-decoration: none;
    transition: all 0.2s ease;
    white-space: nowrap;
    gap: 6px;
    font-family: 'Nunito', sans-serif;
}

.add-custom-tab-link i {
    font-size: 1rem;
    color: #a5b3cb;
    transition: all 0.2s ease;
}

.add-custom-tab-link:hover {
    color: #9a55ff;
    background: #ffffff;
    box-shadow: 0 2px 5px rgba(154, 85, 255, 0.1);
}

.add-custom-tab-link:hover i {
    color: #9a55ff;
}

.add-custom-tab-link.active {
    color: #9a55ff;
    background: #ffffff;
    box-shadow: 0 2px 8px rgba(154, 85, 255, 0.15);
    font-weight: 600;
}

.add-custom-tab-link.active i {
    color: #9a55ff;
}

/* Tab Content Animation */
.add-custom-tab-pane {
    display: none;
}

.add-custom-tab-pane.active {
    display: block;
    animation: addFadeIn 0.3s ease;
}

@keyframes addFadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* ===== MODERN FORM STYLING UNTUK SEMUA TAB ===== */
.kavling-form-group {
    margin-bottom: 1rem;
}

.kavling-form-group label {
    font-size: 0.8rem;
    font-weight: 600;
    color: #9a55ff !important;
    margin-bottom: 0.3rem;
    letter-spacing: 0.3px;
    font-family: 'Nunito', sans-serif;
    display: block;
}

.kavling-form-control {
    border: 1px solid #e9ecef;
    border-radius: 10px;
    padding: 0.7rem 0.8rem;
    font-size: 0.85rem;
    transition: all 0.2s ease;
    background-color: #ffffff;
    color: #2c2e3f;
    width: 100%;
    font-family: 'Nunito', sans-serif;
}

.kavling-form-control:focus {
    border-color: #9a55ff;
    box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.1);
    outline: none;
}

select.kavling-form-control {
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%239a55ff' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 0.75rem center;
    background-size: 12px;
    padding-right: 2rem;
}

/* ===== MODERN BUTTON STYLING UNTUK SEMUA TAB ===== */
.kavling-btn {
    font-size: 0.8rem;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
    font-family: 'Nunito', sans-serif;
    display: inline-block;
    text-decoration: none;
    cursor: pointer;
    border: none;
    width: 100%;
    text-align: center;
}

@media (min-width: 576px) {
    .kavling-btn {
        width: auto;
        padding: 0.5rem 1.2rem;
    }
}

.kavling-btn-primary {
    background: linear-gradient(to right, #da8cff, #9a55ff);
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(154, 85, 255, 0.3);
}

.kavling-btn-primary:hover {
    background: linear-gradient(to right, #c77cff, #8a45e6);
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(154, 85, 255, 0.4);
}

.kavling-btn-outline-primary {
    background: transparent;
    border: 1px solid #9a55ff;
    color: #9a55ff;
}

.kavling-btn-outline-primary:hover {
    background: linear-gradient(135deg, #9a55ff, #da8cff);
    color: #ffffff;
    border-color: transparent;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(154, 85, 255, 0.3);
}

.kavling-btn-outline-success {
    background: transparent;
    border: 1px solid #28a745;
    color: #28a745;
}

.kavling-btn-outline-success:hover {
    background: linear-gradient(135deg, #28a745, #5cb85c);
    color: #ffffff;
    border-color: transparent;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
}

.kavling-btn-light {
    background: #f8f9fa;
    border: 1px solid #e9ecef;
    color: #2c2e3f;
}

.kavling-btn-light:hover {
    background: #e9ecef;
    transform: translateY(-2px);
}

.kavling-btn-secondary {
    background: linear-gradient(135deg, #f0f2f5, #e4e6ea);
    border: 1px solid #e9ecef;
    color: #2c2e3f;
}

.kavling-btn-secondary:hover {
    background: linear-gradient(135deg, #e4e6ea, #d8dce2);
    transform: translateY(-2px);
    color: #2c2e3f;
}

.kavling-btn-success {
    background: linear-gradient(135deg, #28a745, #5cb85c);
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
}

.kavling-btn-success:hover {
    background: linear-gradient(135deg, #218838, #4cae4c);
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(40, 167, 69, 0.4);
}

/* ===== MODERN FILE UPLOAD STYLING ===== */
.kavling-file-upload-modern {
    position: relative;
    width: 100%;
}

.kavling-file-upload-modern input[type="file"] {
    position: absolute;
    opacity: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
    z-index: 2;
}

.kavling-file-upload-modern .kavling-file-label-modern {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    gap: 6px;
    padding: 1rem 0.6rem;
    background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
    border: 2px dashed #d0d4db;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    min-height: 100px;
}

@media (min-width: 576px) {
    .kavling-file-upload-modern .kavling-file-label-modern {
        flex-direction: row;
        text-align: left;
        gap: 8px;
        padding: 0.75rem 1rem;
        min-height: auto;
    }
}

.kavling-file-upload-modern:hover .kavling-file-label-modern {
    border-color: #9a55ff;
    background: linear-gradient(135deg, #f1f0ff, #f8f9fa);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(154, 85, 255, 0.1);
}

.kavling-file-upload-modern .kavling-file-label-modern i {
    font-size: 1.6rem;
    color: #9a55ff;
    background: rgba(154, 85, 255, 0.1);
    padding: 8px;
    border-radius: 50%;
}

.kavling-file-upload-modern .kavling-file-label-modern .kavling-file-info-modern {
    flex: 1;
    width: 100%;
}

.kavling-file-upload-modern .kavling-file-label-modern .kavling-file-info-modern span {
    display: block;
    font-weight: 600;
    color: #2c2e3f;
    font-size: 0.8rem;
    word-break: break-word;
}

.kavling-file-upload-modern .kavling-file-label-modern .kavling-file-info-modern small {
    color: #6c7383;
    font-size: 0.65rem;
    display: block;
    margin-top: 2px;
}

.kavling-file-upload-modern .kavling-file-label-modern .kavling-file-size {
    font-size: 0.7rem;
    color: #9a55ff;
    font-weight: 600;
    background: rgba(154, 85, 255, 0.1);
    padding: 4px 10px;
    border-radius: 20px;
    white-space: nowrap;
    margin-top: 5px;
}

@media (min-width: 576px) {
    .kavling-file-upload-modern .kavling-file-label-modern .kavling-file-size {
        margin-top: 0;
    }
}

/* Text muted */
.kavling-text-muted {
    color: #a5b3cb !important;
    font-size: 0.7rem;
    display: block;
    margin-top: 0.2rem;
}

/* ===== FILTER SECTION STYLING ===== */
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

/* ===== CARD STYLING - PAKAI BAWAAN BOOTSTRAP ===== */
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

.badge.badge-success {
    background: linear-gradient(135deg, #28a745, #5cb85c) !important;
    color: #ffffff;
}

.badge.badge-warning {
    background: linear-gradient(135deg, #ffc107, #ffdb6d) !important;
    color: #2c2e3f;
}

.badge.badge-primary {
    background: linear-gradient(135deg, #9a55ff, #da8cff) !important;
    color: #ffffff;
}

.badge.badge-info {
    background: linear-gradient(135deg, #17a2b8, #5bc0de) !important;
    color: #ffffff;
}

/* Action buttons styling */
.btn-outline-primary,
.btn-outline-info,
.btn-outline-danger {
    border: 1px solid;
    padding: 0.25rem 0.5rem;
    font-size: 0.65rem;
}

.btn-outline-primary {
    border-color: #9a55ff;
    color: #9a55ff;
}

.btn-outline-primary:hover {
    background: linear-gradient(to right, #da8cff, #9a55ff);
    color: white;
}

.btn-outline-info {
    border-color: #17a2b8;
    color: #17a2b8;
}

.btn-outline-info:hover {
    background: linear-gradient(135deg, #17a2b8, #5bc0de);
    color: white;
}

.btn-outline-danger {
    border-color: #dc3545;
    color: #dc3545;
}

.btn-outline-danger:hover {
    background: linear-gradient(135deg, #dc3545, #e4606d);
    color: white;
}

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

    .btn-outline-primary,
    .btn-outline-info,
    .btn-outline-danger {
        padding: 0.2rem 0.3rem;
        font-size: 0.6rem;
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

<div class="container-fluid p-4">
    <!-- Header - CARD TERPISAH -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h3 class="text-dark fw-bold mb-1">
                        <i class="mdi mdi-pencil-ruler me-2" style="color: #9a55ff;"></i>
                        Buat Kavling / Master Unit
                    </h3>
                    <p class="text-muted mb-0">
                        <i class="mdi mdi-information-outline me-1"></i>
                        Buat unit-unit kavling dari tanah yang sudah diverifikasi
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Tanah Induk -->
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-office-building text-primary me-2"></i>
                        Informasi Tanah Induk
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        {{-- Nama Tanah / Proyek --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="text-muted small">
                                    <i class="mdi mdi-home me-1"></i>Nama Tanah / Proyek
                                </label>
                                <p class="fw-bold">{{ $land->name ?? '-' }}</p>
                            </div>
                        </div>

                        {{-- Luas Total Tanah --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="text-muted small">
                                    <i class="mdi mdi-ruler-square me-1"></i>Luas Total Tanah
                                </label>
                                <p class="fw-bold">{{ number_format($land->area ?? 0, 0, ',', '.') }} m²</p>
                            </div>
                        </div>

                        {{-- Sisa Luas Belum Dikavling --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="text-muted small">
                                    <i class="mdi mdi-chart-arc me-1"></i>Sisa Luas Belum Dikavling
                                </label>
                                <p class="fw-bold text-primary">
                                    {{ number_format($land->remaining_area ?? ($land->area ?? 0), 0, ',', '.') }} m²
                                </p>
                            </div>
                        </div>

                        {{-- Status Legal --}}
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="text-muted small">
                                    <i class="mdi mdi-gavel me-1"></i>Status Legal
                                </label>
                                @if ($land->legal_status == 'terverifikasi')
                                    <p class="fw-bold"><span class="badge badge-success"><i class="mdi mdi-check-circle me-1"></i>Terverifikasi</span></p>
                                @else
                                    <p class="fw-bold"><span class="badge badge-warning"><i class="mdi mdi-clock-outline me-1"></i>{{ ucfirst($land->legal_status) ?? '-' }}</span></p>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Lokasi --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-2">
                                <label class="text-muted small">
                                    <i class="mdi mdi-map-marker me-1"></i>Lokasi
                                </label>
                                <p class="fw-bold">
                                    <i class="mdi mdi-map-marker text-danger me-1"></i>
                                    {{ $land->address ?? '-' }},
                                    Kel. {{ $land->village ?? '-' }},
                                    Kec. {{ $land->district ?? '-' }},
                                    {{ $land->city ?? '-' }},
                                    {{ $land->province ?? '-' }}
                                    {{ $land->postal_code ?? '' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Progress Steps -->
    <div class="row">
        <div class="col-12 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <span class="text-success"><i class="mdi mdi-check-circle me-1"></i>Input Tanah</span>
                        <span class="text-success"><i class="mdi mdi-check-circle me-1"></i>Verifikasi Legal</span>
                        <span class="text-primary"><i class="mdi mdi-progress-clock me-1"></i>Buat Kavling</span>
                        <span class="text-muted"><i class="mdi mdi-circle-outline me-1"></i>Siap Jual</span>
                    </div>
                    <div class="progress mt-2" style="height: 6px;">
                        <div class="progress-bar bg-success" style="width: 50%"></div>
                        <div class="progress-bar bg-primary" style="width: 25%"></div>
                    </div>
                    <p class="text-muted small mt-2">
                        <i class="mdi mdi-information-outline me-1"></i>
                        Tahap 3 dari 4: Buat Kavling / Master Unit
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Pilihan Metode Pembuatan Kavling -->
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-tools me-2 text-primary"></i>
                        Metode Pembuatan Kavling
                    </h5>
                </div>
                <div class="card-body">
                    <!-- Custom Tabs -->
                    <div class="add-custom-tabs-wrapper overflow-auto mb-3">
                        <ul class="add-custom-tabs" id="myTab" role="tablist">
                            <li class="add-custom-tab-item">
                                <a class="add-custom-tab-link active" id="manual-tab" data-toggle="tab" href="#manual" role="tab" aria-controls="manual" aria-selected="true">
                                    <i class="mdi mdi-pencil"></i>
                                    <span>Manual Satu per Satu</span>
                                </a>
                            </li>
                            <li class="add-custom-tab-item">
                                <a class="add-custom-tab-link" id="generate-tab" data-toggle="tab" href="#generate" role="tab" aria-controls="generate" aria-selected="false">
                                    <i class="mdi mdi-auto-fix"></i>
                                    <span>Generate Otomatis</span>
                                </a>
                            </li>
                            <li class="add-custom-tab-item">
                                <a class="add-custom-tab-link" id="import-tab" data-toggle="tab" href="#import" role="tab" aria-controls="import" aria-selected="false">
                                    <i class="mdi mdi-import"></i>
                                    <span>Import Excel</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Tab Content -->
                    <div class="tab-content mt-3 mt-md-4" id="myTabContent">
                        <!-- TAB MANUAL -->
                        <div class="add-custom-tab-pane active" id="manual" role="tabpanel" aria-labelledby="manual-tab">
                            <form action="{{ route('properti.storeKavling', $land->id) }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="kavling-form-group">
                                            <label>Blok / No. Unit</label>
                                            <input type="text" name="block" class="kavling-form-control" placeholder="Contoh: A">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="kavling-form-group">
                                            <label>Nomor Unit</label>
                                            <input type="text" name="unit_number" class="kavling-form-control" placeholder="1">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="kavling-form-group">
                                            <label>Type Unit</label>
                                            <input type="text" name="type" class="kavling-form-control" placeholder="Cluster Ijen">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="kavling-form-group">
                                            <label>Luas (m²)</label>
                                            <input type="number" name="area" class="kavling-form-control" placeholder="200">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="kavling-form-group">
                                            <label>Luas Bangunan(m²)</label>
                                            <input type="number" name="building_area" class="kavling-form-control" placeholder="200">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="kavling-form-group">
                                            <label>Harga (Rp)</label>
                                            <input type="text" name="price" class="kavling-form-control" placeholder="500.000.000">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="kavling-form-group">
                                            <label>Hadap</label>
                                            <select name="facing" class="kavling-form-control">
                                                <option>Utara</option>
                                                <option>Selatan</option>
                                                <option>Timur</option>
                                                <option>Barat</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="kavling-form-group">
                                            <label>Posisi</label>
                                            <select name="position" class="kavling-form-control">
                                                <option>Hook</option>
                                                <option>Tengah</option>
                                                <option>Sudut</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <div class="kavling-form-group">
                                            <label>Keterangan</label>
                                            <input type="text" name="description" class="kavling-form-control" placeholder="Opsional">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <button type="submit" class="kavling-btn kavling-btn-primary">
                                            <i class="mdi mdi-plus me-1"></i>Tambah Unit ke Daftar
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- TAB GENERATE OTOMATIS -->
                        <div class="add-custom-tab-pane" id="generate" role="tabpanel" aria-labelledby="generate-tab">
                            <form action="{{ route('properti.generateKavling', $land->id) }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="kavling-form-group">
                                            <label>Jumlah Unit</label>
                                            <input type="number" name="jumlah_unit" class="kavling-form-control" value="10">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="kavling-form-group">
                                            <label>Luas per Unit (m²)</label>
                                            <input type="number" name="area_per_unit" class="kavling-form-control" value="200">
                                        </div>
                                    </div>
                                     <div class="col-md-3">
                                        <div class="kavling-form-group">
                                            <label>Luas Bangunan(m²)</label>
                                            <input type="number" name="building_area_unit" class="kavling-form-control" placeholder="200">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="kavling-form-group">
                                            <label>Harga per Unit (Rp)</label>
                                            <input type="text" name="price_per_unit" class="kavling-form-control" value="500.000.000">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="kavling-form-group">
                                            <label>Prefix Blok</label>
                                            <input type="text" name="prefix_block" class="kavling-form-control" value="A">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-3">
                                        <div class="kavling-form-group">
                                            <label>Nomor Awal</label>
                                            <input type="number" name="start_number" class="kavling-form-control" value="1">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="kavling-form-group">
                                            <label>Hadap Default</label>
                                            <select name="default_facing" class="kavling-form-control">
                                                <option>Utara</option>
                                                <option>Selatan</option>
                                                <option>Timur</option>
                                                <option>Barat</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="kavling-form-group">
                                            <label>Posisi Default</label>
                                            <select name="default_position" class="kavling-form-control">
                                                <option>Tengah</option>
                                                <option>Hook</option>
                                                <option>Sudut</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 d-flex align-items-end">
                                        <div class="kavling-form-group w-100">
                                            <button type="submit" class="kavling-btn kavling-btn-primary w-100">
                                                <i class="mdi mdi-auto-fix me-1"></i>Generate Unit
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="alert alert-info mt-3">
                                <i class="mdi mdi-information-outline me-2"></i>
                                Total luas yang akan digunakan: <strong>{{ number_format($land->area_used ?? 0, 0, ',', '.') }} m²</strong> dari
                                {{ number_format($land->area ?? 0, 0, ',', '.') }} m²
                            </div>
                        </div>

                        <!-- TAB IMPORT EXCEL -->
                        <div class="add-custom-tab-pane" id="import" role="tabpanel" aria-labelledby="import-tab">
                            <div class="text-center py-4">
                                <i class="mdi mdi-file-excel text-success" style="font-size: 48px;"></i>
                                <h5 class="mt-3">Import Data Kavling dari Excel</h5>
                                <p class="text-muted">
                                    <i class="mdi mdi-information-outline me-1"></i>
                                    Download template Excel, isi data unit, lalu upload kembali
                                </p>

                                <div class="row justify-content-center">
                                    <div class="col-md-6">
                                        <div class="kavling-form-group">
                                            <label>Download Template</label>
                                            <div>
                                                <button class="kavling-btn kavling-btn-outline-success" onclick="alert('Download template excel')">
                                                    <i class="mdi mdi-download me-1"></i>Template Kavling.xlsx
                                                </button>
                                            </div>
                                        </div>

                                        <div class="kavling-form-group">
                                            <label>Upload File Excel</label>
                                            <div class="kavling-file-upload-modern">
                                                <input type="file" id="uploadExcel" name="uploadExcel" accept=".xlsx,.xls">
                                                <div class="kavling-file-label-modern">
                                                    <i class="mdi mdi-cloud-upload"></i>
                                                    <div class="kavling-file-info-modern">
                                                        <span>Upload File Excel</span>
                                                        <small>Format: .xlsx, .xls (Max 5MB)</small>
                                                    </div>
                                                    <span class="kavling-file-size"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <button class="kavling-btn kavling-btn-primary" onclick="alert('Data berhasil diimport')">
                                            <i class="mdi mdi-import me-1"></i>Import Data
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Unit yang Akan Dibuat -->
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-format-list-bulleted me-2 text-primary"></i>
                        Daftar Unit Kavling
                    </h5>
                    <span class="badge badge-primary"><i class="mdi mdi-counter me-1"></i>{{ $land->units->count() }} unit</span>
                </div>
                <div class="card-body">
                    <!-- Filter Section -->
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
                                            <input type="text" id="searchInputMobile" class="form-control" placeholder="Cari blok/unit...">
                                        </div>

                                        <div class="row g-1">
                                            <div class="col-6">
                                                <label class="form-label">
                                                    <i class="mdi mdi-shape-outline me-1"></i>Type
                                                </label>
                                                <select id="filterTypeMobile" class="form-control">
                                                    <option value="">Semua</option>
                                                    <option value="Cluster Ijen">Cluster Ijen</option>
                                                    <option value="Cluster Bromo">Cluster Bromo</option>
                                                    <option value="Cluster Rinjani">Cluster Rinjani</option>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">
                                                    <i class="mdi mdi-counter me-1"></i>Tampil
                                                </label>
                                                <select id="showDataMobile" class="form-control">
                                                    <option value="5">5</option>
                                                    <option value="10" selected>10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row g-1 mt-1">
                                            <div class="col-12 d-flex align-items-end">
                                                <button type="button" id="resetFilterMobile" class="btn btn-gradient-secondary w-100">
                                                    <i class="mdi mdi-refresh me-1"></i> Reset Filter
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
                                                <input type="text" id="searchInput" class="form-control" placeholder="Cari blok/unit...">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">
                                                    <i class="mdi mdi-shape-outline me-1"></i>Type
                                                </label>
                                                <select id="filterType" class="form-control">
                                                    <option value="">Semua</option>
                                                    <option value="Cluster Ijen">Cluster Ijen</option>
                                                    <option value="Cluster Bromo">Cluster Bromo</option>
                                                    <option value="Cluster Rinjani">Cluster Rinjani</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">
                                                    <i class="mdi mdi-counter me-1"></i>Tampil
                                                </label>
                                                <select id="showData" class="form-control">
                                                    <option value="5">5</option>
                                                    <option value="10" selected>10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2 d-flex align-items-end">
                                                <button type="button" id="resetFilter" class="btn btn-gradient-secondary w-100">
                                                    <i class="mdi mdi-refresh me-1"></i> Reset
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
                                    <th><i class="mdi mdi-home me-1"></i>Blok / No</th>
                                    <th><i class="mdi mdi-ruler-square me-1"></i>Luas Tanah</th>
                                    <th><i class="mdi mdi-domain me-1"></i>Luas Bangunan</th>
                                    <th><i class="mdi mdi-format-list-bulleted me-1"></i>Type</th>
                                    <th><i class="mdi mdi-currency-usd me-1"></i>Harga</th>
                                    <th><i class="mdi mdi-compass me-1"></i>Hadap</th>
                                    <th><i class="mdi mdi-map-marker me-1"></i>Posisi</th>
                                    <th class="text-center"><i class="mdi mdi-cog me-1"></i>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($land->units as $i => $unit)
                                    <tr>
                                        <td class="text-center fw-bold">{{ $i + 1 }}</td>

                                        {{-- BLOK / NO --}}
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-home text-primary me-1" style="font-size: 0.9rem;"></i>
                                                <span class="fw-bold">{{ $unit->unit_code }}</span>
                                            </div>
                                        </td>

                                        {{-- LUAS TANAH --}}
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-ruler-square text-warning me-1" style="font-size: 0.9rem;"></i>
                                                <span class="text-nowrap">{{ number_format($unit->area, 0, ',', '.') }} m²</span>
                                            </div>
                                        </td>

                                        {{-- LUAS BANGUNAN --}}
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-domain text-secondary me-1" style="font-size: 0.9rem;"></i>
                                                <span class="text-nowrap">{{ number_format($unit->building_area ?? 0, 0, ',', '.') }} m²</span>
                                            </div>
                                        </td>

                                        {{-- TYPE --}}
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-format-list-bulleted text-info me-1" style="font-size: 0.9rem;"></i>
                                                <span>{{ $unit->type ?? '-' }}</span>
                                            </div>
                                        </td>

                                        {{-- HARGA --}}
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-currency-usd text-success me-1" style="font-size: 0.9rem;"></i>
                                                <span class="text-nowrap">Rp {{ number_format($unit->price ?? 0, 0, ',', '.') }}</span>
                                            </div>
                                        </td>

                                        {{-- HADAP --}}
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-compass text-info me-1" style="font-size: 0.9rem;"></i>
                                                <span>{{ $unit->facing ?? '-' }}</span>
                                            </div>
                                        </td>

                                        {{-- POSISI --}}
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-map-marker text-danger me-1" style="font-size: 0.9rem;"></i>
                                                <span>{{ $unit->position ?? '-' }}</span>
                                            </div>
                                        </td>

                                        {{-- AKSI --}}
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-1">
                                                <a href="{{ route('properti.kavling.edit', ['unit' => $unit->id]) }}"
                                                   class="btn btn-outline-primary btn-sm" title="Edit">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>

                                                <a href="{{ route('properti.progress', ['land_bank_id' => $unit->land_bank_id]) }}"
                                                   class="btn btn-outline-info btn-sm" title="Update Progress">
                                                    <i class="mdi mdi-progress-clock"></i>
                                                </a>

                                                <form action="{{ route('properti.kavling.destroy', ['unit' => $unit->id]) }}"
                                                      method="POST" style="display:inline-block;"
                                                      onsubmit="return confirm('Hapus unit {{ $unit->unit_code }}?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-outline-danger btn-sm" title="Hapus">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted py-4">
                                            <i class="mdi mdi-information-outline me-2"></i>
                                            Belum ada unit kavling
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination UI -->
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-3">
                        <div class="text-muted small mb-2 mb-sm-0">
                            <i class="mdi mdi-information-outline me-1"></i>
                            Menampilkan 1-{{ $land->units->count() }} dari {{ $land->units->count() }} data
                        </div>
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">Previus</a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                @if($land->units->count() > 10)
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                                @endif
                                <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Ringkasan -->
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card bg-light">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="mdi mdi-chart-pie me-2" style="color: #9a55ff;"></i>
                        Ringkasan Kavling
                    </h5>
                    @php
                        $totalUnits = $land->units->count();
                        $totalArea = $land->units->sum('area');
                        $sisaLuas = max(0, $land->remaining_area ?? $land->area - $totalArea);
                        $totalNilai = $land->units->sum('price');

                        $map = [
                            'belum_mulai' => 0,
                            'pondasi'     => 20,
                            'dinding'     => 40,
                            'atap'        => 60,
                            'finishing'   => 80,
                            'selesai'     => 100
                        ];

                        $unitProgress = $land->units->map(function($unit) use ($map) {
                            $status = strtolower($unit->construction_progress ?? 'belum_mulai');
                            return $map[$status] ?? 0;
                        });

                        $progressPercent = $unitProgress->count() > 0 ? $unitProgress->avg() : 0;
                    @endphp

                    <div class="row">
                        <div class="col-6">
                            <p class="text-muted mb-1"><i class="mdi mdi-counter me-1"></i>Total Unit</p>
                            <h4>{{ $totalUnits }} unit</h4>
                        </div>
                        <div class="col-6">
                            <p class="text-muted mb-1"><i class="mdi mdi-ruler-square me-1"></i>Total Luas</p>
                            <h4>{{ number_format($totalArea, 0, ',', '.') }} m²</h4>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-6">
                            <p class="text-muted mb-1"><i class="mdi mdi-chart-arc me-1"></i>Sisa Luas Tanah</p>
                            <h4>{{ number_format($sisaLuas, 0, ',', '.') }} m²</h4>
                        </div>
                        <div class="col-6">
                            <p class="text-muted mb-1"><i class="mdi mdi-currency-usd me-1"></i>Nilai Total</p>
                            <h4>Rp {{ number_format($totalNilai, 0, ',', '.') }}</h4>
                        </div>
                    </div>

                    <div class="mt-4">
                        <p class="text-muted mb-1"><i class="mdi mdi-progress-clock me-1"></i>Progress Pembangunan</p>
                        <div class="progress">
                            <div class="progress-bar bg-success"
                                role="progressbar"
                                style="width: {{ $progressPercent }}%;"
                                aria-valuenow="{{ $progressPercent }}"
                                aria-valuemin="0"
                                aria-valuemax="100">
                                {{ number_format($progressPercent, 0) }}%
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Denah Sederhana Dinamis -->
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-map me-2 text-primary"></i>
                        Denah Kavling
                    </h5>
                </div>
                <div class="card-body text-center">
                    <div style="background-color: #f8f9fa; padding: 20px; border-radius: 8px;">
                        <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 10px;">
                            @php
                                $allUnits = $land->units;
                                $blokKavlings = [];
                                foreach ($allUnits as $unit) {
                                    $blok = explode('.', $unit->unit_code)[0];
                                    $blokKavlings[$blok][] = $unit->unit_code;
                                }
                                $allBloks = array_keys($blokKavlings);
                            @endphp

                            @foreach ($allBloks as $blok)
                                <div style="margin-bottom: 10px; width: 100%;">
                                    <strong><i class="mdi mdi-format-columns me-1"></i>{{ $blok }}</strong>
                                    <div style="display: flex; flex-wrap: wrap; gap: 5px; justify-content: center; margin-top: 5px;">
                                        @php
                                            $numbers = [];
                                            foreach ($blokKavlings[$blok] as $kav) {
                                                $num = (int)explode('.', $kav)[1];
                                                $numbers[] = $num;
                                            }
                                            $maxNum = max($numbers);
                                        @endphp

                                        @for ($i = 1; $i <= $maxNum; $i++)
                                            @php
                                                $kavCode = $blok . '.' . $i;
                                                $exists = in_array($kavCode, $blokKavlings[$blok]);
                                            @endphp
                                            <span
                                                style="background-color: {{ $exists ? '#28a745' : '#6c757d' }}; color: white; padding: 5px 10px; border-radius: 4px;">
                                                <i class="mdi mdi-{{ $exists ? 'check' : 'close' }} me-1"></i>
                                                {{ $kavCode }}
                                            </span>
                                        @endfor
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <p class="text-muted mt-3 mb-0">
                            <i class="mdi mdi-information-outline me-1"></i>
                            Preview posisi kavling
                        </p>
                        <small class="text-muted">
                            <span class="badge badge-success me-1"><i class="mdi mdi-check"></i> Hijau</span> = sudah dibuat,
                            <span class="badge bg-secondary me-1"><i class="mdi mdi-close"></i> Abu</span> = belum dibuat
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tombol Aksi -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ url('/properti/verifikasi-legal') }}" class="kavling-btn kavling-btn-light me-2">
                            <i class="mdi mdi-arrow-left me-1"></i>Kembali
                        </a>
                        <button class="kavling-btn kavling-btn-secondary" onclick="alert('Draft kavling berhasil disimpan')">
                            <i class="mdi mdi-content-save me-1"></i>Simpan Draft
                        </button>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <button class="kavling-btn kavling-btn-success"
                            onclick="alert('Kavling berhasil disimpan.')">
                            <i class="mdi mdi-check-circle me-1"></i>Simpan Kavling
                        </button>
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
    // Simple Tab Functionality
    $('.add-custom-tab-link').on('click', function(e) {
        e.preventDefault();

        $('.add-custom-tab-link').removeClass('active');
        $('.add-custom-tab-pane').removeClass('active');

        $(this).addClass('active');
        var target = $(this).attr('href');
        $(target).addClass('active');
    });

    // Inisialisasi DataTables - hanya untuk sorting
    let table = $('#tableKavling').DataTable({
        responsive: true,
        paging: false,        // Matikan pagination DataTables
        info: false,           // Matikan info
        searching: false,      // Matikan search bawaan
        lengthChange: false,   // Matikan length change
        ordering: true,        // Aktifkan sorting saja
        language: {
            emptyTable: "Belum ada unit kavling",
            zeroRecords: "Data tidak ditemukan",
        },
        columnDefs: [
            { orderable: false, targets: [0, 8] } // Non-aktifkan sorting untuk kolom No dan Aksi
        ]
    });

    // Fungsi filter manual
    function filterData() {
        let searchTerm = '';
        let typeFilter = '';

        // Deteksi versi filter yang aktif
        if ($('#searchInputMobile').is(':visible')) {
            searchTerm = $('#searchInputMobile').val().toLowerCase();
            typeFilter = $('#filterTypeMobile').val().toLowerCase();
        } else {
            searchTerm = $('#searchInput').val().toLowerCase();
            typeFilter = $('#filterType').val().toLowerCase();
        }

        // Filter menggunakan DataTables
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                let row = table.row(dataIndex).data();
                let blok = data[1] ? data[1].toLowerCase() : '';
                let type = data[4] ? data[4].toLowerCase() : '';

                let matchSearch = searchTerm === '' || blok.includes(searchTerm);
                let matchType = typeFilter === '' || type.includes(typeFilter);

                return matchSearch && matchType;
            }
        );

        table.draw();
        $.fn.dataTable.ext.search.pop();
    }

    // Event listener untuk filter
    $('#searchInput, #searchInputMobile').on('keyup', filterData);
    $('#filterType, #filterTypeMobile').on('change', filterData);

    // Fungsi reset filter
    function resetFilters() {
        if ($('#searchInputMobile').is(':visible')) {
            $('#searchInputMobile').val('');
            $('#filterTypeMobile').val('');
        } else {
            $('#searchInput').val('');
            $('#filterType').val('');
        }

        $.fn.dataTable.ext.search.pop();
        table.search('').columns().search('').draw();
    }

    // Event listener untuk reset
    $('#resetFilter, #resetFilterMobile').click(resetFilters);

    // Fungsi untuk mengubah jumlah baris (UI only)
    $('#showData, #showDataMobile').change(function() {
        let rowCount = $(this).val();
        alert('Mengubah tampilan menjadi ' + rowCount + ' data per halaman (demo)');
    });

    // Format Rupiah untuk input harga
    $('input[name="price"], input[name="price_per_unit"]').on('keyup', function() {
        let nilai = this.value.replace(/\D/g, '');
        if (nilai) {
            let rupiah = new Intl.NumberFormat('id-ID').format(nilai);
            this.value = rupiah;
        }
    });
});
</script>
@endpush
