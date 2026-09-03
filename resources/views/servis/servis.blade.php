@extends('layouts.partial.app')

@section('title', 'Modul Complaint & Layanan Purnajual - Property Management App')

@section('content')

@php
    if (!function_exists('resolveFileUrlServis')) {
        function resolveFileUrlServis($path) {
            if (empty($path)) return '#';
            $path = str_replace('\\', '/', $path);
            if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
                return $path;
            }
            $clean = ltrim($path, '/');
            if (file_exists(public_path($clean))) return asset($clean);
            if (file_exists(public_path('uploads/' . $clean))) return asset('uploads/' . $clean);
            if (file_exists(public_path('storage/' . $clean))) return asset('storage/' . $clean);
            if (file_exists(storage_path('app/public/' . $clean))) return asset('storage/' . $clean);
            if (str_starts_with($clean, 'uploads/') || str_starts_with($clean, 'storage/')) return asset($clean);
            return asset('uploads/' . $clean);
        }
    }
@endphp

<style>
    .servis-page .card {
        border-radius: 12px;
        border: 1px solid #edf2f9;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.03);
    }

    .servis-header-card {
        background: #ffffff;
        border-radius: 14px;
        border: 1px solid #edf2f9;
    }

    .servis-stat-card {
        border-radius: 12px;
        border: 1px solid #edf2f9;
        background: #ffffff;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .servis-stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
    }

    /* Filter Card Styling (Identik Master Data Bank) */
    .filter-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 0.85rem 1rem;
    }

    .filter-card .form-control,
    .filter-card .form-select {
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-size: 0.85rem;
        height: 38px;
        background-color: #ffffff;
    }

    .filter-card .form-control:focus,
    .filter-card .form-select:focus {
        border-color: #9a55ff;
        box-shadow: 0 0 0 2px rgba(154, 85, 255, 0.15);
    }

    .btn-icon-only {
        width: 38px;
        height: 38px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        border-radius: 6px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.06);
    }

    .btn-icon-only i {
        font-size: 1.15rem;
        line-height: 1;
    }

    /* Table Styling */
    .servis-table {
        width: 100%;
        margin-bottom: 0;
        border-collapse: separate;
        border-spacing: 0;
    }

    .servis-table thead th {
        background-color: #faf8ff !important;
        color: #6c7383 !important;
        font-size: 0.76rem !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
        border-top: none !important;
        border-bottom: 1.5px solid #edf2f7 !important;
        padding: 0.85rem 1rem !important;
        vertical-align: middle !important;
        white-space: nowrap;
    }

    .servis-table tbody td {
        padding: 0.85rem 1rem !important;
        vertical-align: middle !important;
        font-size: 0.88rem !important;
        border-bottom: 1px solid #f1f3f7 !important;
        color: #2c2e3f;
    }

    .servis-table tbody tr {
        transition: background-color 0.2s ease;
    }

    .servis-table tbody tr:hover {
        background-color: #faf7ff !important;
    }

    .badge-ticket {
        background: #f3e8ff;
        color: #7e22ce;
        font-weight: 700;
        border: 1px solid #e9d5ff;
        border-radius: 6px;
        padding: 0.32rem 0.6rem;
        font-size: 0.8rem;
        font-family: 'SFMono-Regular', Menlo, Monaco, Consolas, monospace;
        display: inline-block;
    }

    .badge-category {
        background: #ede9fe;
        color: #6d28d9;
        font-weight: 700;
        border-radius: 6px;
        padding: 0.22rem 0.55rem;
        font-size: 0.72rem;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        display: inline-block;
    }

    .badge-priority {
        padding: 0.3rem 0.75rem;
        border-radius: 20px;
        font-size: 0.74rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
    }

    .badge-priority.darurat {
        background: #fee2e2;
        color: #dc2626;
        border: 1px solid #fecaca;
    }

    .badge-priority.tinggi {
        background: #fef3c7;
        color: #d97706;
        border: 1px solid #fde68a;
    }

    .badge-priority.sedang {
        background: #e0f2fe;
        color: #0284c7;
        border: 1px solid #bae6fd;
    }

    .badge-priority.rendah {
        background: #f1f5f9;
        color: #64748b;
        border: 1px solid #e2e8f0;
    }

    .badge-status-pills {
        padding: 0.32rem 0.8rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
    }

    .badge-status-pills.selesai {
        background: #ecfdf5;
        color: #059669;
        border: 1px solid #a7f3d0;
    }

    .badge-status-pills.diproses {
        background: #eff6ff;
        color: #2563eb;
        border: 1px solid #bfdbfe;
    }

    .badge-status-pills.pengecekan {
        background: #f0fdfa;
        color: #0d9488;
        border: 1px solid #99f6e4;
    }

    .badge-status-pills.diajukan {
        background: #fff7ed;
        color: #ea580c;
        border: 1px solid #fed7aa;
    }

    .badge-status-pills.ditolak {
        background: #fef2f2;
        color: #ef4444;
        border: 1px solid #fecaca;
    }

    /* Action Buttons (Identik Master Data Bank) */
    .btn-action {
        width: 32px;
        height: 32px;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        transition: all 0.2s;
        cursor: pointer;
        padding: 0;
    }

    .btn-action.view {
        background: rgba(13, 202, 240, 0.15);
        color: #0dcaf0;
    }

    .btn-action.view:hover {
        background: #0dcaf0;
        color: #fff;
    }

    .btn-action.edit {
        background: rgba(255, 193, 7, 0.15);
        color: #ffc107;
    }

    .btn-action.edit:hover {
        background: #ffc107;
        color: #000;
    }

    .btn-action.delete {
        background: rgba(220, 53, 69, 0.15);
        color: #dc3545;
    }

    .btn-action.delete:hover {
        background: #dc3545;
        color: #fff;
    }

    /* Unit Grouped Complaint Card Styles */
    .unit-complaint-card {
        border-radius: 14px;
        overflow: hidden;
        border: 1.5px solid #edf2f9 !important;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.03);
        transition: all 0.25s ease;
        background: #ffffff;
    }

    .unit-complaint-card:hover {
        box-shadow: 0 8px 24px rgba(154, 85, 255, 0.08);
        border-color: #dfd2f7 !important;
    }

    .unit-card-header {
        background: #faf8ff !important;
        border-bottom: 1.5px solid #ede8fc !important;
        padding: 1rem 1.25rem;
    }

    .servis-subtable thead th {
        background-color: #f8fafc !important;
        color: #64748b !important;
        font-size: 0.76rem !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
        border-top: none !important;
        border-bottom: 1.5px solid #edf2f7 !important;
        padding: 0.75rem 1rem !important;
        vertical-align: middle !important;
        white-space: nowrap;
    }

    .servis-subtable tbody td {
        padding: 0.8rem 1rem !important;
        vertical-align: middle !important;
        font-size: 0.88rem !important;
        border-bottom: 1px solid #f1f5f9 !important;
        color: #2c2e3f;
    }

    .servis-subtable tbody tr:last-child td {
        border-bottom: none !important;
    }

    .servis-subtable tbody tr:hover {
        background-color: #faf7ff !important;
    }

    /* Compact Modern Modal */
    .modal-custom-compact {
        max-width: 540px !important;
        margin: 1.75rem auto;
    }

    @media (max-width: 575.98px) {
        .modal-custom-compact {
            max-width: 95% !important;
            margin: 0.75rem auto;
        }
    }

    /* Modal Form Controls Perfect Spacing & Centering */
    .modal-custom-compact .form-group {
        margin-bottom: 0.95rem;
    }

    .modal-custom-compact .form-label {
        display: block;
        margin-bottom: 0.35rem;
        font-size: 0.84rem;
        font-weight: 600;
        color: #374151;
    }

    .modal-custom-compact .form-control,
    .modal-custom-compact .form-select {
        height: 42px !important;
        line-height: 40px !important;
        padding: 0 0.85rem !important;
        font-size: 0.88rem !important;
        border: 1px solid #d1d5db !important;
        border-radius: 7px !important;
        background-color: #ffffff !important;
        color: #1f2937 !important;
    }

    .modal-custom-compact textarea.form-control {
        height: auto !important;
        min-height: 75px !important;
        line-height: 1.45 !important;
        padding: 0.55rem 0.85rem !important;
    }

    .modal-custom-compact .form-control:focus,
    .modal-custom-compact .form-select:focus {
        border-color: #9a55ff !important;
        box-shadow: 0 0 0 2px rgba(154, 85, 255, 0.15) !important;
    }

    /* Select2 Modal Integration */
    .modal-custom-compact .select2-container--bootstrap-5 .select2-selection {
        height: 42px !important;
        min-height: 42px !important;
        border-color: #d1d5db !important;
        border-radius: 7px !important;
        display: flex !important;
        align-items: center !important;
        padding: 0 0.85rem !important;
    }

    .modal-custom-compact .select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
        padding-left: 0 !important;
        line-height: 40px !important;
        color: #1f2937 !important;
    }

    .select2-container--bootstrap-5.select2-container--focus .select2-selection,
    .select2-container--bootstrap-5.select2-container--open .select2-selection {
        border-color: #9a55ff !important;
        box-shadow: 0 0 0 2px rgba(154, 85, 255, 0.15) !important;
    }

    .select2-dropdown {
        border-color: #e2e8f0 !important;
        border-radius: 8px !important;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12) !important;
        z-index: 1065 !important;
    }

    /* FILE UPLOADS (Matched with Survey & Transaksi Modules) */
    .transaksi-file-upload {
        position: relative;
        width: 100%;
    }

    .transaksi-file-upload input[type="file"] {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
        z-index: 2;
    }

    .transaksi-file-label {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1rem;
        background: #ffffff;
        border: 1.5px dashed #cbd5e1;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .transaksi-file-upload:hover .transaksi-file-label {
        border-color: #9a55ff;
        background: #fbf9ff;
    }

    .transaksi-file-upload.has-file .transaksi-file-label {
        border-color: #10b981;
        border-style: solid;
        background: #f0fdf4;
    }

    .transaksi-file-upload.has-file .transaksi-file-label i {
        color: #10b981 !important;
    }

    .transaksi-file-label i {
        font-size: 1.5rem;
        color: #9a55ff;
    }

    .transaksi-file-info {
        min-width: 0;
        flex: 1;
        overflow: hidden;
    }

    .transaksi-file-info span {
        display: block;
        font-size: 0.85rem;
        font-weight: 700;
        color: #2c2e3f;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .transaksi-file-info small {
        display: block;
        font-size: 0.75rem;
        color: #8b8fa3;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>

<div class="container-fluid servis-page px-1 px-sm-2 px-md-3 py-2 py-md-3">

    <!-- Header Card Banner -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 servis-header-card">
                <div class="card-body p-3 p-md-4 d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="text-dark mb-1 fw-bold" style="font-size: 1.25rem;">
                            Service & Keluhan Pasca Serah Terima (Complaint)
                        </h4>
                        <p class="text-muted mb-0" style="font-size: 0.88rem;">
                            Kelola pengajuan keluhan customer, tindak lanjut perbaikan garansi, dan lacak progress penyelesaiannya.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Notifikasi -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="mdi mdi-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <i class="mdi mdi-alert-circle me-1"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Statistik Cards -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100 servis-stat-card">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small text-uppercase fw-bold" style="font-size: 0.73rem;">Total Keluhan</span>
                        <h3 class="fw-bold mb-0 mt-1 text-dark">{{ $stats['total'] ?? 0 }}</h3>
                    </div>
                    <div class="p-2.5 rounded-3" style="background: #f3e8ff; color: #9a55ff;">
                        <i class="mdi mdi-ticket-outline fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100 servis-stat-card">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small text-uppercase fw-bold" style="font-size: 0.73rem;">Menunggu Respon</span>
                        <h3 class="fw-bold mb-0 mt-1 text-warning">{{ $stats['diajukan'] ?? 0 }}</h3>
                    </div>
                    <div class="p-2.5 rounded-3" style="background: #fff7ed; color: #ea580c;">
                        <i class="mdi mdi-clock-outline fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100 servis-stat-card">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small text-uppercase fw-bold" style="font-size: 0.73rem;">Dalam Pengerjaan</span>
                        <h3 class="fw-bold mb-0 mt-1 text-primary">{{ $stats['diproses'] ?? 0 }}</h3>
                    </div>
                    <div class="p-2.5 rounded-3" style="background: #eff6ff; color: #2563eb;">
                        <i class="mdi mdi-progress-wrench fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100 servis-stat-card">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small text-uppercase fw-bold" style="font-size: 0.73rem;">Tuntas Selesai</span>
                        <h3 class="fw-bold mb-0 mt-1 text-success">{{ $stats['selesai'] ?? 0 }}</h3>
                    </div>
                    <div class="p-2.5 rounded-3" style="background: #ecfdf5; color: #059669;">
                        <i class="mdi mdi-check-circle-outline fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Card Content -->
    <div class="row mt-2">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2 py-3 border-bottom">
                    <h5 class="card-title mb-0 fw-bold" style="color: #2c2e3f;">
                        <i class="mdi mdi-format-list-bulleted me-2 text-primary"></i>Daftar Pengajuan Keluhan / Garansi
                    </h5>
                    <button type="button" class="btn btn-sm btn-gradient-primary d-flex align-items-center gap-1 shadow-sm px-3" onclick="openTambahComplaintModal()">
                        <i class="mdi mdi-plus-circle" style="font-size: 1rem;"></i>
                        <span>Tambah Keluhan</span>
                    </button>
                </div>

                <div class="card-body p-3 p-md-4">
                    <!-- Filter Section (Identik Style Master Data Bank) -->
                    <div class="filter-card mb-3">
                        <!-- Desktop Version -->
                        <div class="filter-row-desktop d-none d-md-block">
                            <form id="filterForm" method="GET" action="{{ route('servis') }}" onsubmit="return showFilterLoading()">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                    <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                        <!-- Search Input with Joined Search Button -->
                                        <div style="min-width: 260px; max-width: 340px; flex: 1;">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="search" id="searchInput"
                                                    placeholder="Cari no tiket / customer / unit..."
                                                    value="{{ request('search') }}"
                                                    style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                                <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                    type="submit" title="Cari"
                                                    style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                    <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Status Filter -->
                                        <div style="width: 155px;">
                                            <select class="form-control" name="status" id="statusSelect">
                                                <option value="">Semua Status</option>
                                                <option value="diajukan" {{ request('status') == 'diajukan' ? 'selected' : '' }}>Diajukan</option>
                                                <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                                <option value="pengecekan" {{ request('status') == 'pengecekan' ? 'selected' : '' }}>Pengecekan</option>
                                                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                                <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                            </select>
                                        </div>

                                        <!-- Kategori Filter -->
                                        <div style="width: 180px;">
                                            <select class="form-control" name="kategori" id="kategoriSelect">
                                                <option value="">Semua Kategori</option>
                                                <option value="kebocoran" {{ request('kategori') == 'kebocoran' ? 'selected' : '' }}>Kebocoran</option>
                                                <option value="kelistrikan" {{ request('kategori') == 'kelistrikan' ? 'selected' : '' }}>Kelistrikan</option>
                                                <option value="sanitasi_pipa" {{ request('kategori') == 'sanitasi_pipa' ? 'selected' : '' }}>Sanitasi / Pipa</option>
                                                <option value="pintu_jendela" {{ request('kategori') == 'pintu_jendela' ? 'selected' : '' }}>Pintu / Jendela</option>
                                                <option value="struktur_dinding" {{ request('kategori') == 'struktur_dinding' ? 'selected' : '' }}>Struktur / Dinding</option>
                                                <option value="finishing_cat" {{ request('kategori') == 'finishing_cat' ? 'selected' : '' }}>Finishing / Cat</option>
                                                <option value="lainnya" {{ request('kategori') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
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
                                        <a href="{{ route('servis') }}" class="btn btn-gradient-secondary btn-icon-only" title="Reset" onclick="showResetLoading(event)">
                                            <i class="mdi mdi-refresh"></i>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Mobile Version -->
                        <div class="filter-row-mobile d-block d-md-none">
                            <form method="GET" action="{{ route('servis') }}" onsubmit="return showFilterLoading()">
                                <div class="row g-2">
                                    <div class="col-12 mb-2">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" id="searchInputMobile"
                                                placeholder="Cari no tiket / customer / unit..."
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
                                        <select class="form-control" name="status" id="statusSelectMobile">
                                            <option value="">Semua Status</option>
                                            <option value="diajukan" {{ request('status') == 'diajukan' ? 'selected' : '' }}>Diajukan</option>
                                            <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                            <option value="pengecekan" {{ request('status') == 'pengecekan' ? 'selected' : '' }}>Pengecekan</option>
                                            <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                            <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                        </select>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <select class="form-control" name="kategori" id="kategoriSelectMobile">
                                            <option value="">Semua Kategori</option>
                                            <option value="kebocoran" {{ request('kategori') == 'kebocoran' ? 'selected' : '' }}>Kebocoran</option>
                                            <option value="kelistrikan" {{ request('kategori') == 'kelistrikan' ? 'selected' : '' }}>Kelistrikan</option>
                                            <option value="sanitasi_pipa" {{ request('kategori') == 'sanitasi_pipa' ? 'selected' : '' }}>Sanitasi / Pipa</option>
                                            <option value="pintu_jendela" {{ request('kategori') == 'pintu_jendela' ? 'selected' : '' }}>Pintu / Jendela</option>
                                            <option value="struktur_dinding" {{ request('kategori') == 'struktur_dinding' ? 'selected' : '' }}>Struktur / Dinding</option>
                                            <option value="finishing_cat" {{ request('kategori') == 'finishing_cat' ? 'selected' : '' }}>Finishing / Cat</option>
                                            <option value="lainnya" {{ request('kategori') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
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
                                        <a href="{{ route('servis') }}" class="btn btn-gradient-secondary w-100 d-flex align-items-center justify-content-center gap-1" onclick="showResetLoading(event)">
                                            <i class="mdi mdi-refresh"></i> Reset
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Daftar Keluhan Dikelompokkan Per Unit / Rumah -->
                    <div class="d-flex flex-column gap-3">
                        @forelse ($unitBookings as $ub)
                            @php
                                $unitComplaints = $ub->complaints ?? collect([]);
                                $uTotal = $unitComplaints->count();
                                $uDiajukan = $unitComplaints->where('status', 'diajukan')->count();
                                $uDiproses = $unitComplaints->whereIn('status', ['diproses', 'pengecekan'])->count();
                                $uSelesai = $unitComplaints->where('status', 'selesai')->count();
                            @endphp
                            <div class="card unit-complaint-card border-0">
                                <div class="unit-card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="rounded-circle text-white d-flex align-items-center justify-content-center shadow-sm" style="width: 40px; height: 40px; background: linear-gradient(135deg, #da8cff, #9a55ff); flex-shrink: 0;">
                                            <i class="mdi mdi-home-outline fs-4"></i>
                                        </div>
                                        <div>
                                            <div class="d-flex align-items-center gap-2 flex-wrap mb-0.5">
                                                <h6 class="fw-bold text-dark mb-0 fs-6">{{ $ub->unit->unit_name ?? '-' }}</h6>
                                                <span class="badge" style="background: #e9d5ff; color: #6b21a8; font-weight: 700; font-size: 0.76rem;">
                                                    Blok {{ $ub->unit->unit_code ?? '-' }}
                                                </span>
                                                <span class="badge" style="background: #f3e8ff; color: #7e22ce; font-weight: 700; font-size: 0.76rem; border: 1px solid #e9d5ff;">
                                                    <i class="mdi mdi-layers-outline me-0.5"></i> {{ $uTotal }} Keluhan Terdaftar
                                                </span>
                                                @if($uDiajukan > 0)
                                                    <span class="badge" style="background: #fff7ed; color: #c2410c; font-size: 0.72rem; border: 1px solid #ffedd5;">
                                                        {{ $uDiajukan }} Diajukan
                                                    </span>
                                                @endif
                                                @if($uDiproses > 0)
                                                    <span class="badge" style="background: #eff6ff; color: #1d4ed8; font-size: 0.72rem; border: 1px solid #dbeafe;">
                                                        {{ $uDiproses }} Diproses
                                                    </span>
                                                @endif
                                                @if($uSelesai > 0)
                                                    <span class="badge" style="background: #f0fdf4; color: #15803d; font-size: 0.72rem; border: 1px solid #dcfce7;">
                                                        {{ $uSelesai }} Selesai
                                                    </span>
                                                @endif
                                            </div>
                                            <small class="text-muted">
                                                Konsumen: <strong class="text-dark">{{ $ub->customer->full_name ?? '-' }}</strong> ({{ $ub->customer->phone ?? '-' }})
                                                @if($ub->booking_code)
                                                    | Booking: <span class="badge-ticket py-0 px-1" style="font-size: 0.72rem;">#{{ $ub->booking_code }}</span>
                                                @endif
                                            </small>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        <button type="button" class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1 rounded-pill px-3 fw-bold shadow-sm" onclick="openTambahComplaintForUnit({{ $ub->id }})">
                                            <i class="mdi mdi-plus-circle-outline"></i> + Tambah Keluhan Unit Ini
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table servis-subtable table-hover align-middle mb-0">
                                            <thead>
                                                <tr>
                                                    <th style="width: 140px;">No. Tiket</th>
                                                    <th style="width: 110px;">Tgl Pengajuan</th>
                                                    <th>Kategori & Detail Keluhan</th>
                                                    <th class="text-center" style="width: 100px;">Prioritas</th>
                                                    <th class="text-center" style="width: 120px;">Status Progress</th>
                                                    <th style="width: 120px;">Foto / Bukti</th>
                                                    <th style="width: 180px;">Petugas / Biaya</th>
                                                    <th class="text-center" style="width: 120px;">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($unitComplaints as $c)
                                                    <tr>
                                                        <td>
                                                            <span class="badge-ticket">{{ $c->ticket_number }}</span>
                                                        </td>
                                                        <td>
                                                            <small class="text-muted fw-semibold">{{ $c->tanggal_pengajuan ? $c->tanggal_pengajuan->format('d M Y') : '-' }}</small>
                                                        </td>
                                                        <td>
                                                            <span class="badge-category mb-1">
                                                                {{ str_replace('_', ' ', $c->kategori) }}
                                                            </span>
                                                            <div class="fw-bold text-dark" style="font-size: 0.88rem;">{{ $c->judul_keluhan }}</div>
                                                            <small class="text-muted text-wrap d-block" style="max-width: 320px; line-height: 1.35;">{{ Str::limit($c->deskripsi, 100) }}</small>
                                                        </td>
                                                        <td class="text-center">
                                                            <span class="badge-priority {{ strtolower($c->prioritas) }}">
                                                                {{ $c->prioritas }}
                                                            </span>
                                                        </td>
                                                        <td class="text-center">
                                                            <span class="badge-status-pills {{ strtolower($c->status) }}">
                                                                {{ $c->status }}
                                                            </span>
                                                            @if($c->status == 'selesai' && $c->tanggal_selesai)
                                                                <small class="d-block text-success mt-1" style="font-size: 0.72rem; font-weight: 600;">
                                                                    {{ $c->tanggal_selesai->format('d M Y') }}
                                                                </small>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="d-inline-flex flex-column gap-1 align-items-start">
                                                                @if($c->foto_keluhan)
                                                                    <a href="{{ resolveFileUrl($c->foto_keluhan) }}" target="_blank" class="badge-foto-bukti foto-awal text-decoration-none">
                                                                        <i class="mdi mdi-image-outline me-1"></i> Foto Awal
                                                                    </a>
                                                                @endif
                                                                @if($c->foto_penyelesaian)
                                                                    <a href="{{ resolveFileUrl($c->foto_penyelesaian) }}" target="_blank" class="badge-foto-bukti foto-selesai text-decoration-none">
                                                                        <i class="mdi mdi-check-all me-1"></i> Foto Selesai
                                                                    </a>
                                                                @endif
                                                                @if(!$c->foto_keluhan && !$c->foto_penyelesaian)
                                                                    <span class="text-muted small fst-italic">Tanpa Foto</span>
                                                                @endif
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <small class="fw-bold text-dark d-block">{{ $c->petugas_penanggung_jawab ?? 'Belum Ditugaskan' }}</small>
                                                            @if($c->biaya_perbaikan > 0)
                                                                <small class="text-danger fw-bold d-block mt-0.5" style="font-size: 0.75rem;">Biaya: Rp {{ number_format($c->biaya_perbaikan, 0, ',', '.') }}</small>
                                                            @else
                                                                <small class="text-success fw-semibold d-block mt-0.5" style="font-size: 0.75rem;">Garansi (Rp 0)</small>
                                                            @endif
                                                            @if($c->catatan_perbaikan)
                                                                <small class="text-muted d-block text-truncate mt-0.5" style="max-width: 170px;" title="{{ $c->catatan_perbaikan }}">"{{ $c->catatan_perbaikan }}"</small>
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="d-inline-flex align-items-center gap-1">
                                                                <button class="btn-action view" title="Lihat Detail Keluhan"
                                                                    data-complaint="{{ base64_encode(json_encode($c)) }}"
                                                                    onclick="handleDetailServisClick(this)">
                                                                    <i class="mdi mdi-eye"></i>
                                                                </button>
                                                                <button class="btn-action edit" title="Update Progress Penanganan"
                                                                    data-complaint="{{ base64_encode(json_encode($c)) }}"
                                                                    onclick="handleUpdateServisClick(this)">
                                                                    <i class="mdi mdi-pencil"></i>
                                                                </button>
                                                                <button class="btn-action delete" title="Hapus Keluhan"
                                                                    onclick="confirmDeleteComplaint({{ $c->id }})">
                                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="8" class="text-center text-muted py-3">
                                                            Tidak ada keluhan aktif pada unit ini.
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="card bg-white border-0 shadow-sm p-5 text-center" style="border-radius: 14px;">
                                <div class="mb-2">
                                    <i class="mdi mdi-check-circle-outline text-success" style="font-size: 3.5rem;"></i>
                                </div>
                                <h5 class="fw-bold text-dark mb-1">Tidak Ada Data Keluhan / Komplain</h5>
                                <p class="text-muted small mb-3">Semua unit properti dalam kondisi baik atau tidak sesuai filter pencarian.</p>
                                <div>
                                    <button type="button" class="btn btn-sm btn-gradient-primary px-4 fw-bold shadow-sm" onclick="openTambahComplaintModal()">
                                        <i class="mdi mdi-plus-circle"></i> Tambah Pengajuan Baru
                                    </button>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $unitBookings->withQueryString()->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

<!-- MODAL: TAMBAH PENGAJUAN KELUHAN (MULTI-KELUHAN) -->
<div class="modal fade" id="modalTambahComplaint" tabindex="-1" role="dialog" aria-labelledby="modalTambahComplaintLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
            <div class="modal-header bg-white border-bottom py-3 px-4 d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="modal-title fw-bold text-dark mb-0" id="modalTambahComplaintLabel" style="font-size: 1.05rem;">
                        <i class="mdi mdi-alert-circle-outline text-primary me-1"></i> Form Pengajuan Keluhan / Garansi Baru
                    </h5>
                    <small class="text-muted" style="font-size: 0.78rem;">Pilih unit properti dan catat satu atau beberapa kendala sekaligus untuk penanganan teknisi</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('complaints.store') }}" method="POST" enctype="multipart/form-data" id="formServisTambahComplaint">
                @csrf
                <div class="modal-body p-3 p-md-4" style="background: #f8fafc; max-height: 75vh; overflow-y: auto;">
                    <div class="form-group mb-3 bg-white p-3 rounded-3 border" style="border-color: #ede8fc !important;">
                        <label class="form-label fw-bold small text-dark mb-1">Pilih Unit & Konsumen <span class="text-danger">*</span></label>
                        <select class="form-select" name="booking_id" id="selectBookingId" required style="width: 100%;">
                            <option value="">-- Cari / Pilih Unit & Konsumen --</option>
                            @foreach($soldBookings as $sb)
                                <option value="{{ $sb->id }}">
                                    {{ $sb->unit->unit_name ?? '-' }} (Blok {{ $sb->unit->unit_code ?? '-' }}) - {{ $sb->customer->full_name ?? '-' }} [Kode: {{ $sb->booking_code }}]
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Container Dynamic Repeater Keluhan -->
                    <div id="servisComplaintItemsContainer" class="d-flex flex-column gap-3">
                        <!-- Item #1 -->
                        <div class="complaint-item-card p-3 bg-white rounded-3 border" style="border: 1.5px solid #ede8fc !important;" data-index="0">
                            <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                                <span class="fw-bold text-dark item-number-label" style="font-size: 0.9rem;">
                                    <i class="mdi mdi-numeric-1-circle text-primary me-1 fs-5 align-middle"></i> Keluhan #1
                                </span>
                                <button type="button" class="btn btn-sm btn-outline-danger btn-remove-item d-none" onclick="removeServisComplaintItem(this)" style="font-size: 0.75rem; padding: 0.2rem 0.5rem;">
                                    <i class="mdi mdi-trash-can-outline"></i> Hapus Keluhan Ini
                                </button>
                            </div>
                            <div class="row g-2">
                                <div class="col-md-6 mb-2">
                                    <label class="form-label small fw-bold text-dark mb-1">Kategori Keluhan <span class="text-danger">*</span></label>
                                    <select class="form-control form-select" name="items[0][kategori]" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        <option value="kebocoran">Kebocoran Atap / Talang / Dinding</option>
                                        <option value="kelistrikan">Kelistrikan, Stopkontak & Lampu</option>
                                        <option value="sanitasi_pipa">Sanitasi, Saluran Air & Kran</option>
                                        <option value="pintu_jendela">Pintu, Jendela, Kunci & Kusen</option>
                                        <option value="struktur_dinding">Retak Dinding / Plesteran</option>
                                        <option value="finishing_cat">Cat Mengelupas / Keramik Pecah</option>
                                        <option value="lainnya">Lainnya / Masalah Umum</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="form-label small fw-bold text-dark mb-1">Tingkat Prioritas <span class="text-danger">*</span></label>
                                    <select class="form-control form-select" name="items[0][prioritas]" required>
                                        <option value="rendah">Rendah (Penyelesaian santai)</option>
                                        <option value="sedang" selected>Sedang (Standar perbaikan)</option>
                                        <option value="tinggi">Tinggi (Perlu segera ditangani)</option>
                                        <option value="darurat">Darurat / Emergency (Segera hari ini)</option>
                                    </select>
                                </div>
                                <div class="col-12 mb-2">
                                    <label class="form-label small fw-bold text-dark mb-1">Judul Keluhan <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="items[0][judul_keluhan]" placeholder="Contoh: Kran kamar mandi bocor" required>
                                </div>
                                <div class="col-12 mb-2">
                                    <label class="form-label small fw-bold text-dark mb-1">Deskripsi Keluhan <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="items[0][deskripsi]" rows="2" placeholder="Tuliskan rincian kendala..." required></textarea>
                                </div>
                                <div class="col-12 mb-1">
                                    <label class="form-label small fw-bold text-dark mb-1">Foto Bukti (Opsional)</label>
                                    <input type="file" name="items[0][foto_keluhan]" accept="image/*,application/pdf" class="form-control">
                                    <small class="text-muted d-block mt-1" style="font-size: 0.72rem;">Format: JPG, PNG, WEBP, PDF (Maks. 5MB)</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Tambah Item Keluhan Baru -->
                    <div class="mt-3 text-center">
                        <button type="button" class="btn btn-outline-primary btn-sm px-4 rounded-pill fw-bold shadow-sm" onclick="addServisComplaintItem()" style="border-width: 1.5px;">
                            <i class="mdi mdi-plus-circle-outline me-1"></i> + Tambah Keluhan Lainnya Untuk Unit Ini
                        </button>
                    </div>
                </div>
                <div class="modal-footer bg-white border-top py-2.5 px-4 d-flex justify-content-between align-items-center">
                    <span class="small text-muted" id="lblServisItemCount">Total: <strong>1 keluhan</strong></span>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-sm btn-light border px-3" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-sm btn-gradient-primary px-4 fw-bold shadow-sm" id="btnSubmitServisComplaints">
                            <i class="mdi mdi-send me-1"></i> Simpan Keluhan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL: UPDATE PROGRESS -->
<div class="modal fade" id="modalUpdateServis" tabindex="-1" role="dialog" aria-labelledby="modalUpdateServisLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-custom-compact" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
            <div class="modal-header bg-white border-bottom py-3 px-4 d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="modal-title fw-bold text-dark mb-0" id="modalUpdateServisLabel" style="font-size: 1.05rem;">
                        Update Progress Penanganan Keluhan
                    </h5>
                    <small class="text-muted" style="font-size: 0.78rem;">Perbarui status pengerjaan, teknisi pelaksana, dan hasil perbaikan</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formUpdateServis" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body p-3 p-md-4" style="background: #f8fafc;">
                    <div class="card bg-white border shadow-sm mb-3" style="border-color: #e9edf4 !important;">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="badge-ticket" id="servisUpdateTicket">-</span>
                                <span class="badge bg-warning text-dark text-uppercase fw-bold" id="servisUpdatePrioritas" style="font-size: 0.72rem;">-</span>
                            </div>
                            <h6 class="fw-bold text-dark mb-1 mt-2" id="servisUpdateJudul" style="font-size: 0.92rem;">-</h6>
                            <p class="text-muted small mb-0" id="servisUpdateDeskripsi">-</p>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label fw-bold small text-dark mb-1">Status Progress <span class="text-danger">*</span></label>
                        <select class="form-select" name="status" id="servisSelectStatus" required>
                            <option value="diajukan">Diajukan</option>
                            <option value="diproses">Diproses</option>
                            <option value="pengecekan">Pengecekan</option>
                            <option value="selesai">Selesai</option>
                            <option value="ditolak">Ditolak</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label fw-bold small text-dark mb-1">Teknisi / Penanggung Jawab</label>
                        <input type="text" class="form-control" name="petugas_penanggung_jawab" id="servisInputPetugas" placeholder="Nama teknisi / petugas...">
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label fw-bold small text-dark mb-1">Catatan Tindak Lanjut</label>
                        <textarea class="form-control" name="catatan_perbaikan" id="servisInputCatatan" rows="3" placeholder="Tindakan atau hasil perbaikan..."></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label fw-bold small text-dark mb-1">Biaya Perbaikan (Rp)</label>
                        <input type="number" class="form-control" name="biaya_perbaikan" id="servisInputBiaya" placeholder="0 (Gratis garansi jika 0)">
                    </div>

                    <div class="form-group mb-0">
                        <label class="form-label fw-bold small text-dark mb-1">Foto Hasil Perbaikan (Opsional)</label>
                        <div class="transaksi-file-upload">
                            <input type="file" name="foto_penyelesaian" accept="image/*,application/pdf" class="survey-file-input">
                            <div class="transaksi-file-label">
                                <i class="mdi mdi-cloud-upload-outline"></i>
                                <div class="transaksi-file-info">
                                    <span>Pilih Foto Hasil Perbaikan</span>
                                    <small>Format: JPG, PNG, PDF (Maks. 5MB)</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-white border-top py-2.5 px-4 d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-sm btn-light border px-3" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-sm btn-gradient-primary px-4 fw-bold">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL: DETAIL KELUHAN -->
<div class="modal fade" id="modalDetailServis" tabindex="-1" role="dialog" aria-labelledby="modalDetailServisLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-custom-compact" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
            <div class="modal-header d-flex justify-content-between align-items-center" style="background: #ffffff; border-bottom: 1.5px solid #edf2f7; padding: 1.1rem 1.4rem;">
                <div>
                    <h5 class="modal-title fw-bold text-dark mb-0" id="modalDetailServisLabel" style="font-size: 1.05rem;">
                        Detail Informasi Keluhan
                    </h5>
                    <small class="text-muted" style="font-size: 0.78rem;">Rincian pengajuan keluhan dan rekam jejak penanganan garansi</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3 p-md-4" style="background: #f8fafc;">
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <div class="p-3 bg-white rounded-3 border h-100" style="border-color: #e9edf4 !important;">
                            <span class="text-muted small d-block mb-1 fw-semibold">No. Tiket</span>
                            <div class="mb-2">
                                <span class="badge-ticket" id="detTicket">-</span>
                            </div>
                            <span class="text-muted small d-block fw-semibold">Unit Properti</span>
                            <span class="fw-bold text-dark d-block" id="detUnit">-</span>
                            <span class="text-muted small d-block mt-2 fw-semibold">Konsumen</span>
                            <span class="fw-bold text-dark d-block" id="detCustomer">-</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 bg-white rounded-3 border h-100" style="border-color: #e9edf4 !important;">
                            <span class="text-muted small d-block fw-semibold">Kategori & Prioritas</span>
                            <div class="d-flex gap-2 my-1.5">
                                <span class="badge-category" id="detKategori">-</span>
                                <span class="badge bg-warning text-dark text-uppercase fw-bold" id="detPrioritas" style="font-size: 0.72rem;">-</span>
                            </div>
                            <span class="text-muted small d-block mt-2 fw-semibold">Status Penanganan</span>
                            <div class="my-1">
                                <span class="badge-status-pills" id="detStatus">-</span>
                            </div>
                            <span class="text-muted small d-block mt-2 fw-semibold">Teknisi / Penanggung Jawab</span>
                            <span class="fw-bold text-dark d-block" id="detPetugas">-</span>
                        </div>
                    </div>
                </div>

                <div class="p-3 bg-white rounded-3 border mb-3" style="border-color: #e9edf4 !important;">
                    <label class="fw-bold text-muted mb-1 small text-uppercase" style="font-size: 0.72rem; letter-spacing: 0.5px;">Judul & Deskripsi Keluhan</label>
                    <h6 class="fw-bold text-dark mb-1" id="detJudul" style="font-size: 0.95rem;">-</h6>
                    <p class="mb-0 text-secondary" id="detDeskripsi" style="font-size: 0.88rem;">-</p>
                </div>

                <div class="p-3 bg-white rounded-3 border mb-3" style="border-color: #e9edf4 !important;">
                    <label class="fw-bold text-muted mb-1 small text-uppercase" style="font-size: 0.72rem; letter-spacing: 0.5px;">Catatan Perbaikan & Tindak Lanjut</label>
                    <p class="mb-0 text-dark" id="detCatatan" style="font-size: 0.88rem;">-</p>
                </div>

                <div class="row g-2" id="boxBuktiFoto">
                    <!-- Foto links injected here -->
                </div>
            </div>
            <div class="modal-footer bg-white border-top py-2.5 px-4 d-flex justify-content-end">
                <button type="button" class="btn btn-sm btn-secondary px-4" data-bs-dismiss="modal" style="border-radius: 8px;">Tutup</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function showFilterLoading() {
    return true;
}

function showResetLoading(e) {
    return true;
}

function initSelect2Booking() {
    if (window.jQuery && $.fn.select2) {
        $('#selectBookingId').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#modalTambahComplaint'),
            placeholder: '-- Pilih Unit / Konsumen --',
            allowClear: true,
            width: '100%'
        });
    }
}

$(document).ready(function() {
    initSelect2Booking();

    $('#modalTambahComplaint').on('shown.bs.modal', function() {
        initSelect2Booking();
    });

    $(document).on('change', '.transaksi-file-upload input[type="file"]', function(e) {
        const file = e.target.files[0];
        const $container = $(this).closest('.transaksi-file-upload');
        
        if (file) {
            const sizeInMB = (file.size / (1024 * 1024)).toFixed(2);
            $container.addClass('has-file');
            $container.find('.transaksi-file-info span').text(file.name);
            $container.find('.transaksi-file-info small').text(sizeInMB + ' MB (Siap upload)');
        } else {
            $container.removeClass('has-file');
            $container.find('.transaksi-file-info span').text('Upload Foto / Dokumen');
            $container.find('.transaksi-file-info small').text('Format: JPG, PNG, PDF (Maks. 5MB)');
        }
    });
});

var servisItemCounter = 1;

function openTambahComplaintModal() {
    if (window.jQuery && typeof $('#modalTambahComplaint').modal === 'function') {
        $('#modalTambahComplaint').modal('show');
    } else if (window.bootstrap && bootstrap.Modal) {
        var modal = new bootstrap.Modal(document.getElementById('modalTambahComplaint'));
        modal.show();
    }
    setTimeout(initSelect2Booking, 150);
}

function openTambahComplaintForUnit(bookingId) {
    openTambahComplaintModal();
    setTimeout(function() {
        if (window.jQuery && $('#selectBookingId').length) {
            $('#selectBookingId').val(bookingId).trigger('change');
        } else {
            var el = document.getElementById('selectBookingId');
            if (el) el.value = bookingId;
        }
    }, 250);
}

function addServisComplaintItem() {
    var container = document.getElementById('servisComplaintItemsContainer');
    var index = servisItemCounter++;
    var html = `
        <div class="complaint-item-card p-3 bg-white rounded-3 border" style="border: 1.5px solid #ede8fc !important;" data-index="${index}">
            <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                <span class="fw-bold text-dark item-number-label" style="font-size: 0.9rem;">
                    <i class="mdi mdi-numeric-${index + 1}-circle text-primary me-1 fs-5 align-middle"></i> Keluhan #${index + 1}
                </span>
                <button type="button" class="btn btn-sm btn-outline-danger btn-remove-item" onclick="removeServisComplaintItem(this)" style="font-size: 0.75rem; padding: 0.2rem 0.5rem;">
                    <i class="mdi mdi-trash-can-outline"></i> Hapus Keluhan Ini
                </button>
            </div>
            <div class="row g-2">
                <div class="col-md-6 mb-2">
                    <label class="form-label small fw-bold text-dark mb-1">Kategori Keluhan <span class="text-danger">*</span></label>
                    <select class="form-control form-select" name="items[${index}][kategori]" required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="kebocoran">Kebocoran Atap / Talang / Dinding</option>
                        <option value="kelistrikan">Kelistrikan, Stopkontak & Lampu</option>
                        <option value="sanitasi_pipa">Sanitasi, Saluran Air & Kran</option>
                        <option value="pintu_jendela">Pintu, Jendela, Kunci & Kusen</option>
                        <option value="struktur_dinding">Retak Dinding / Plesteran</option>
                        <option value="finishing_cat">Cat Mengelupas / Keramik Pecah</option>
                        <option value="lainnya">Lainnya / Masalah Umum</option>
                    </select>
                </div>
                <div class="col-md-6 mb-2">
                    <label class="form-label small fw-bold text-dark mb-1">Tingkat Prioritas <span class="text-danger">*</span></label>
                    <select class="form-control form-select" name="items[${index}][prioritas]" required>
                        <option value="rendah">Rendah (Penyelesaian santai)</option>
                        <option value="sedang" selected>Sedang (Standar perbaikan)</option>
                        <option value="tinggi">Tinggi (Perlu segera ditangani)</option>
                        <option value="darurat">Darurat / Emergency (Segera hari ini)</option>
                    </select>
                </div>
                <div class="col-12 mb-2">
                    <label class="form-label small fw-bold text-dark mb-1">Judul Keluhan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="items[${index}][judul_keluhan]" placeholder="Contoh: Lampu teras mati / saklar rusak" required>
                </div>
                <div class="col-12 mb-2">
                    <label class="form-label small fw-bold text-dark mb-1">Deskripsi Keluhan <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="items[${index}][deskripsi]" rows="2" placeholder="Tuliskan rincian kendala..." required></textarea>
                </div>
                <div class="col-12 mb-1">
                    <label class="form-label small fw-bold text-dark mb-1">Foto Bukti (Opsional)</label>
                    <input type="file" name="items[${index}][foto_keluhan]" accept="image/*,application/pdf" class="form-control">
                    <small class="text-muted d-block mt-1" style="font-size: 0.72rem;">Format: JPG, PNG, WEBP, PDF (Maks. 5MB)</small>
                </div>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
    updateServisItemNumbers();
}

function removeServisComplaintItem(btn) {
    var card = btn.closest('.complaint-item-card');
    if (card) {
        card.remove();
        updateServisItemNumbers();
    }
}

function updateServisItemNumbers() {
    var cards = document.querySelectorAll('#servisComplaintItemsContainer .complaint-item-card');
    cards.forEach(function(card, idx) {
        var label = card.querySelector('.item-number-label');
        if (label) {
            label.innerHTML = `<i class="mdi mdi-numeric-${idx + 1}-circle text-primary me-1 fs-5 align-middle"></i> Keluhan #${idx + 1}`;
        }
        var removeBtn = card.querySelector('.btn-remove-item');
        if (removeBtn) {
            if (cards.length > 1) {
                removeBtn.classList.remove('d-none');
            } else {
                removeBtn.classList.add('d-none');
            }
        }
    });

    var countLabel = document.getElementById('lblServisItemCount');
    if (countLabel) {
        countLabel.innerHTML = `Total: <strong>${cards.length} keluhan</strong>`;
    }

    var submitBtn = document.getElementById('btnSubmitServisComplaints');
    if (submitBtn) {
        submitBtn.innerHTML = `<i class="mdi mdi-send me-1"></i> Simpan (${cards.length}) Keluhan`;
    }
}

function handleUpdateServisClick(btn) {
    try {
        var base64Data = btn.getAttribute('data-complaint');
        var jsonStr = decodeURIComponent(escape(window.atob(base64Data)));
        var complaint = JSON.parse(jsonStr);
        openUpdateServisModal(complaint);
    } catch(e) {
        console.error('Error parsing complaint data', e);
    }
}

function handleDetailServisClick(btn) {
    try {
        var base64Data = btn.getAttribute('data-complaint');
        var jsonStr = decodeURIComponent(escape(window.atob(base64Data)));
        var complaint = JSON.parse(jsonStr);
        openDetailServisModal(complaint);
    } catch(e) {
        console.error('Error parsing complaint data', e);
    }
}

function confirmDeleteComplaint(id) {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "Data pengajuan keluhan ini akan dihapus permanen dari sistem!",
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
                html: 'Sedang menghapus data keluhan',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            setTimeout(() => {
                let form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ url("/complaints") }}/' + id;

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

function openUpdateServisModal(c) {
    var form = document.getElementById('formUpdateServis');
    if (form) {
        form.action = '{{ url('/complaints') }}/' + c.id + '/update';
    }

    if (document.getElementById('servisUpdateTicket')) document.getElementById('servisUpdateTicket').innerText = c.ticket_number || '-';
    if (document.getElementById('servisUpdatePrioritas')) document.getElementById('servisUpdatePrioritas').innerText = (c.prioritas || 'SEDANG').toUpperCase();
    if (document.getElementById('servisUpdateJudul')) document.getElementById('servisUpdateJudul').innerText = c.judul_keluhan || '-';
    if (document.getElementById('servisUpdateDeskripsi')) document.getElementById('servisUpdateDeskripsi').innerText = c.deskripsi || '-';

    if (document.getElementById('servisSelectStatus')) document.getElementById('servisSelectStatus').value = c.status || 'diajukan';
    if (document.getElementById('servisInputPetugas')) document.getElementById('servisInputPetugas').value = c.petugas_penanggung_jawab || '';
    if (document.getElementById('servisInputCatatan')) document.getElementById('servisInputCatatan').value = c.catatan_perbaikan || '';
    if (document.getElementById('servisInputBiaya')) document.getElementById('servisInputBiaya').value = c.biaya_perbaikan || 0;

    if (window.jQuery && typeof $('#modalUpdateServis').modal === 'function') {
        $('#modalUpdateServis').modal('show');
    } else if (window.bootstrap && bootstrap.Modal) {
        var modal = new bootstrap.Modal(document.getElementById('modalUpdateServis'));
        modal.show();
    }
}

function openDetailServisModal(c) {
    if (document.getElementById('detTicket')) document.getElementById('detTicket').innerText = c.ticket_number || '-';
    if (document.getElementById('detUnit')) document.getElementById('detUnit').innerText = (c.unit ? c.unit.unit_name + ' (Blok ' + c.unit.unit_code + ')' : '-');
    if (document.getElementById('detCustomer')) document.getElementById('detCustomer').innerText = (c.customer ? c.customer.full_name + ' (' + (c.customer.phone || '-') + ')' : '-');
    if (document.getElementById('detKategori')) document.getElementById('detKategori').innerText = (c.kategori || '-').replace('_', ' ');
    if (document.getElementById('detPrioritas')) document.getElementById('detPrioritas').innerText = (c.prioritas || 'SEDANG').toUpperCase();
    
    var statusEl = document.getElementById('detStatus');
    if (statusEl) {
        var statusStr = (c.status || '-').toLowerCase();
        statusEl.className = 'badge-status-pills ' + statusStr;
        statusEl.innerText = statusStr.toUpperCase();
    }

    if (document.getElementById('detPetugas')) document.getElementById('detPetugas').innerText = (c.petugas_penanggung_jawab || 'Belum Ditugaskan');
    if (document.getElementById('detJudul')) document.getElementById('detJudul').innerText = c.judul_keluhan || '-';
    if (document.getElementById('detDeskripsi')) document.getElementById('detDeskripsi').innerText = c.deskripsi || '-';
    if (document.getElementById('detCatatan')) document.getElementById('detCatatan').innerText = c.catatan_perbaikan || 'Belum ada catatan perbaikan dari teknisi.';

    var box = document.getElementById('boxBuktiFoto');
    if (box) {
        box.innerHTML = '';
        if (c.foto_keluhan) {
            box.innerHTML += `
                <div class="col-6">
                    <a href="/${c.foto_keluhan}" target="_blank" class="btn btn-sm btn-outline-danger w-100 d-flex align-items-center justify-content-center gap-1" style="border-radius: 8px; font-weight: 600;">
                        Foto Bukti Keluhan Awal
                    </a>
                </div>
            `;
        }
        if (c.foto_penyelesaian) {
            box.innerHTML += `
                <div class="col-6">
                    <a href="/${c.foto_penyelesaian}" target="_blank" class="btn btn-sm btn-outline-success w-100 d-flex align-items-center justify-content-center gap-1" style="border-radius: 8px; font-weight: 600;">
                        Foto Bukti Hasil Perbaikan
                    </a>
                </div>
            `;
        }
    }

    if (window.jQuery && typeof $('#modalDetailServis').modal === 'function') {
        $('#modalDetailServis').modal('show');
    } else if (window.bootstrap && bootstrap.Modal) {
        var modal = new bootstrap.Modal(document.getElementById('modalDetailServis'));
        modal.show();
    }
}
</script>
@endpush
