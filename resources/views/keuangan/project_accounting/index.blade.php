@extends('layouts.partial.app')

@section('title', 'Project Accounting & HPP - Sistem Keuangan ERP')

@push('styles')
<style>
    /* Card & Banner Styling */
    .header-card {
        border-radius: 12px;
        border: none;
        background: #ffffff;
    }

    /* KPI Summary Cards */
    .kpi-card {
        border-radius: 12px;
        border: 1px solid #edf2f7;
        background: #ffffff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        transition: all 0.25s ease;
        overflow: hidden;
    }
    .kpi-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
    }
    .kpi-icon-wrap {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }

    /* Filter Card (Matching Master Data Bank) */
    .filter-card {
        background: #f8fafc;
        border: 1px solid #edf2f7;
        border-radius: 10px;
        padding: 0.85rem 1rem;
    }

    .filter-card .form-control,
    .filter-card .form-select {
        border: 1px solid #d1d5db;
        border-radius: 6px;
        height: 38px;
        font-size: 0.85rem;
        background-color: #ffffff;
    }

    .filter-card .form-control:focus,
    .filter-card .form-select:focus {
        border-color: #9a55ff;
        box-shadow: 0 0 0 2px rgba(154, 85, 255, 0.15);
    }

    /* Action Buttons */
    .btn-action {
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        border: none;
        font-size: 0.95rem;
        transition: all 0.2s ease;
        text-decoration: none;
        cursor: pointer;
    }

    .btn-action.view {
        background: #ede9fe;
        color: #7c3aed;
    }

    .btn-action.view:hover {
        background: #7c3aed;
        color: #ffffff;
        transform: translateY(-2px);
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

    /* Prominent Cetak Laporan ERP Button */
    .btn-cetak-laporan {
        background: #ffffff;
        color: #7c3aed;
        border: 1.5px solid #7c3aed;
        border-radius: 8px;
        padding: 0.45rem 1rem;
        font-weight: 700;
        font-size: 0.85rem;
        height: 36px;
        transition: all 0.2s ease;
        text-decoration: none !important;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-cetak-laporan:hover {
        background: #7c3aed;
        color: #ffffff !important;
        border-color: #7c3aed;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(124, 58, 237, 0.25);
    }

    /* Tabs Styling */
    .erp-tab-btn {
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.86rem;
        padding: 8px 16px;
        color: #64748b;
        border: 1px solid transparent;
        background: transparent;
        transition: all 0.2s ease;
    }
    .erp-tab-btn:hover {
        color: #9a55ff;
        background: #f8fafc;
    }
    .erp-tab-btn.active {
        color: #ffffff !important;
        background: linear-gradient(to right, #da8cff, #9a55ff) !important;
        box-shadow: 0 4px 12px rgba(154, 85, 255, 0.25);
    }

    /* Table ERP Styling */
    .table-erp th {
        background-color: #f8fafc;
        color: #334155;
        font-weight: 800;
        font-size: 0.82rem;
        letter-spacing: 0.3px;
        border-bottom: 2px solid #e2e8f0;
        white-space: nowrap;
        padding: 0.75rem 0.85rem;
    }
    .table-erp td {
        vertical-align: middle;
        font-size: 0.85rem;
        padding: 0.75rem 0.85rem;
    }

    /* Select2 Integration */
    .select2-container--bootstrap-5 .select2-selection {
        border-color: #d1d5db !important;
        border-radius: 6px !important;
        min-height: 38px !important;
        height: 38px !important;
        font-size: 0.85rem !important;
        display: flex !important;
        align-items: center !important;
        padding: 0 0.75rem !important;
        background-color: #ffffff !important;
    }

    .select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
        padding-left: 0 !important;
        line-height: 38px !important;
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
        z-index: 99999 !important;
    }

    .select2-results__option--highlighted {
        background-color: #f3e8ff !important;
        color: #7e22ce !important;
    }

    /* Badges */
    .badge-pill-soft {
        padding: 3px 8px;
        border-radius: 5px;
        font-weight: 700;
        font-size: 0.74rem;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
    }
    .badge-soft-success { background: #ecfdf5; color: #059669; border: 1px solid #a7f3d0; }
    .badge-soft-primary { background: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe; }
    .badge-soft-warning { background: #fffbeb; color: #d97706; border: 1px solid #fde68a; }
    .badge-soft-danger { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }
    .badge-soft-info { background: #ecfeff; color: #0891b2; border: 1px solid #a5f3fc; }
    .badge-soft-secondary { background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1; }

    .progress-thin {
        height: 6px;
        border-radius: 3px;
        background-color: #e2e8f0;
    }

    /* Mobile & Tablet Responsive Optimizations */
    @media (max-width: 767.98px) {
        .nav-pills-mobile-scroll {
            display: flex !important;
            flex-wrap: nowrap !important;
            overflow-x: auto !important;
            -webkit-overflow-scrolling: touch;
            padding-bottom: 2px;
            gap: 6px !important;
        }
        .nav-pills-mobile-scroll::-webkit-scrollbar {
            display: none;
        }
        .nav-pills-mobile-scroll .nav-item {
            flex: 0 0 auto;
        }
        .erp-tab-btn {
            font-size: 0.78rem !important;
            padding: 6px 12px !important;
            white-space: nowrap !important;
        }
    }

    @media (max-width: 575.98px) {
        .header-card .card-body {
            padding: 0.85rem !important;
        }
        .header-card .btn-cetak-laporan,
        .header-card .btn-gradient-primary {
            flex: 1;
            text-align: center;
            justify-content: center;
            font-size: 0.8rem !important;
            padding: 0.35rem 0.5rem !important;
        }
        .stat-card-body {
            padding: 0.75rem 0.65rem !important;
        }
        .stat-card-title {
            font-size: 0.95rem !important;
        }
        .stat-card-label {
            font-size: 0.74rem !important;
        }
        .stat-card-sub {
            font-size: 0.68rem !important;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-1 px-sm-2 px-md-3 py-2 py-md-3">

    <!-- Header Card Banner -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 header-card">
                <div class="card-body p-3 p-md-4 py-3 py-md-4 d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3" style="min-height: 100px;">
                    <div>
                        <h3 class="text-dark mb-1 fw-bold" style="font-size: 1.35rem;">
                            Project Accounting & HPP Ledger
                        </h3>
                        <p class="text-muted mb-0" style="font-size: 0.88rem;">
                            ERP Penelusuran Biaya Proyek, Rincian HPP Kavling, SPK Kontraktor, RAB, dan Laba Rugi Real-Time
                        </p>
                    </div>
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <a href="{{ route('finance.kpr-disbursement.index') }}" class="btn btn-sm btn-gradient-primary shadow-sm" style="border-radius: 8px; font-weight: 700; padding: 0.5rem 1rem;">
                            <i class="mdi mdi-bank-transfer me-1"></i><span>Pencairan Dana KPR</span>
                        </a>
                        <a href="{{ route('keuangan.project-accounting.cetak', request()->all()) }}" target="_blank" class="btn btn-sm btn-cetak-laporan shadow-sm">
                            <span>Cetak Laporan ERP</span>
                        </a>
                        <a href="{{ route('keuangan.master-invoice.index') }}" class="btn btn-sm btn-gradient-primary shadow-sm px-3 py-2" style="border-radius: 8px; font-weight: 700; font-size: 0.85rem; height: 36px; display: inline-flex; align-items: center;">
                            <span>Master Invoice</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistic Cards (Sesuai Desain Master Invoice & Dashboard) -->
    <div class="row g-2 g-md-3 mb-3 mb-md-4">
        <!-- 1. Total Revenue -->
        <div class="col-6 col-md-4 col-xl-2">
            <div class="card shadow-sm border-0 h-100 mb-0" style="border-radius: 8px;">
                <div class="card-body stat-card-body d-flex justify-content-between align-items-center p-3">
                    <div>
                        <h4 class="text-dark mb-1 fw-bold stat-card-title" style="font-size: 1.08rem;">Rp {{ number_format($summary['total_revenue_potential'], 0, ',', '.') }}</h4>
                        <p class="text-muted mb-0 stat-card-label" style="font-size: 0.82rem;">Total Revenue</p>
                        <small class="text-muted stat-card-sub" style="font-size: 0.74rem;">{{ $summary['total_units_sold'] }}/{{ $summary['total_units_count'] }} Terjual</small>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-cash-multiple" style="font-size: 2.2rem; color: #9a55ff; opacity: 0.25;"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. Kas Masuk (Inflow) -->
        <div class="col-6 col-md-4 col-xl-2">
            <div class="card shadow-sm border-0 h-100 mb-0" style="border-radius: 8px;">
                <div class="card-body stat-card-body d-flex justify-content-between align-items-center p-3">
                    <div>
                        <h4 class="text-success mb-1 fw-bold stat-card-title" style="font-size: 1.08rem;">Rp {{ number_format($summary['total_cash_inflow'], 0, ',', '.') }}</h4>
                        <p class="text-muted mb-0 stat-card-label" style="font-size: 0.82rem;">Kas Masuk</p>
                        <small class="text-success fw-semibold stat-card-sub" style="font-size: 0.74rem;">Realisasi Bayar</small>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-cash-check" style="font-size: 2.2rem; color: #28a745; opacity: 0.3;"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. Total HPP Proyek -->
        <div class="col-6 col-md-4 col-xl-2">
            <div class="card shadow-sm border-0 h-100 mb-0" style="border-radius: 8px;">
                <div class="card-body stat-card-body d-flex justify-content-between align-items-center p-3">
                    <div>
                        <h4 class="text-dark mb-1 fw-bold stat-card-title" style="font-size: 1.08rem;">Rp {{ number_format($summary['total_hpp_project'], 0, ',', '.') }}</h4>
                        <p class="text-muted mb-0 stat-card-label" style="font-size: 0.82rem;">Total HPP</p>
                        <small class="text-muted stat-card-sub" style="font-size: 0.74rem;">Lahan + SPK + RAB</small>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-calculator" style="font-size: 2.2rem; color: #f59e0b; opacity: 0.25;"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4. Kas Keluar (Outflow) -->
        <div class="col-6 col-md-4 col-xl-2">
            <div class="card shadow-sm border-0 h-100 mb-0" style="border-radius: 8px;">
                <div class="card-body stat-card-body d-flex justify-content-between align-items-center p-3">
                    <div>
                        <h4 class="text-danger mb-1 fw-bold stat-card-title" style="font-size: 1.08rem;">Rp {{ number_format($summary['total_cash_outflow'], 0, ',', '.') }}</h4>
                        <p class="text-muted mb-0 stat-card-label" style="font-size: 0.82rem;">Kas Keluar</p>
                        <small class="text-danger stat-card-sub" style="font-size: 0.74rem;">Realisasi SPK & Lahan</small>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-cash-clock" style="font-size: 2.2rem; color: #ea580c; opacity: 0.3;"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- 5. Proyeksi Laba Kotor -->
        <div class="col-6 col-md-4 col-xl-2">
            <div class="card shadow-sm border-0 h-100 mb-0" style="border-radius: 8px;">
                <div class="card-body stat-card-body d-flex justify-content-between align-items-center p-3">
                    <div>
                        <h4 class="text-primary mb-1 fw-bold stat-card-title" style="font-size: 1.08rem;">Rp {{ number_format($summary['total_gross_profit'], 0, ',', '.') }}</h4>
                        <p class="text-muted mb-0 stat-card-label" style="font-size: 0.82rem;">Laba Kotor</p>
                        <small class="text-success fw-bold stat-card-sub" style="font-size: 0.74rem;">Margin: {{ $summary['avg_margin_persen'] }}%</small>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-chart-line-variant" style="font-size: 2.2rem; color: #0d6efd; opacity: 0.25;"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- 6. Status Piutang & Utang -->
        <div class="col-6 col-md-4 col-xl-2">
            <div class="card shadow-sm border-0 h-100 mb-0" style="border-radius: 8px;">
                <div class="card-body stat-card-body d-flex justify-content-between align-items-center p-3">
                    <div>
                        <h4 class="text-danger mb-1 fw-bold stat-card-title" style="font-size: 1.05rem;">Rp {{ number_format($summary['total_piutang'], 0, ',', '.') }}</h4>
                        <p class="text-muted mb-0 stat-card-label" style="font-size: 0.82rem;">Piutang Konsumen</p>
                        <small class="text-warning fw-semibold stat-card-sub" style="font-size: 0.74rem;">Utang: Rp {{ number_format($summary['total_utang_kontraktor'], 0, ',', '.') }}</small>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-scale-balance" style="font-size: 2.2rem; color: #06b6d4; opacity: 0.25;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Card & Filter Section -->
    <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px; overflow: hidden;">
        <div class="card-body p-3 p-md-4">
            <!-- Filter Section (Matching Master Data Bank) -->
            <div class="filter-card mb-3">
                <!-- Desktop Version -->
                <div class="filter-row-desktop d-none d-md-block">
                    <form id="filterForm" method="GET" action="{{ route('keuangan.project-accounting.index') }}" onsubmit="return showFilterLoading()">
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                            <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                <!-- Search Input -->
                                <div style="min-width: 200px; max-width: 260px; flex: 1;">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search" id="searchInput"
                                            placeholder="Cari kavling, konsumen..."
                                            value="{{ $search }}"
                                            style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                        <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                            type="submit" title="Cari"
                                            style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                            <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Land Bank / Proyek Filter -->
                                <div style="min-width: 200px; max-width: 250px; flex: 1;">
                                    <select class="form-select select2-filter" name="land_bank_id" id="landBankSelect" style="width: 100%;">
                                        <option value="">Semua Project (Land Bank)</option>
                                        @foreach($projects as $p)
                                            <option value="{{ $p->id }}" {{ $landBankId == $p->id ? 'selected' : '' }}>
                                                {{ $p->name }} ({{ $p->units_count }} Unit)
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Unit Filter -->
                                <div style="min-width: 180px; max-width: 230px; flex: 1;">
                                    <select class="form-select select2-filter" name="unit_id" id="unitSelect" style="width: 100%;">
                                        <option value="">Semua Unit</option>
                                        @foreach($unitsList as $u)
                                            <option value="{{ $u->id }}" {{ $unitId == $u->id ? 'selected' : '' }}>
                                                Blok {{ $u->unit_code ?? $u->block . '-' . $u->unit_number }} - {{ $u->unit_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Status Unit Filter -->
                                <div style="width: 145px;">
                                    <select class="form-select" name="status_unit" id="statusUnitSelect">
                                        <option value="all">Semua Status</option>
                                        <option value="sold" {{ $statusUnit == 'sold' ? 'selected' : '' }}>Terjual (Sold)</option>
                                        <option value="booked" {{ $statusUnit == 'booked' ? 'selected' : '' }}>Booking Aktif</option>
                                        <option value="available" {{ $statusUnit == 'available' ? 'selected' : '' }}>Tersedia (Ready)</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Right Buttons -->
                            <div class="d-flex align-items-center gap-2 ms-auto">
                                <button type="submit" class="btn btn-gradient-primary btn-icon-only" title="Filter">
                                    <i class="mdi mdi-filter"></i>
                                </button>
                                <a href="{{ route('keuangan.project-accounting.index') }}" class="btn btn-gradient-secondary btn-icon-only" title="Reset" onclick="showResetLoading(event)">
                                    <i class="mdi mdi-refresh"></i>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Mobile Version -->
                <div class="filter-row-mobile d-block d-md-none">
                    <form method="GET" action="{{ route('keuangan.project-accounting.index') }}" onsubmit="return showFilterLoading()">
                        <div class="row g-2">
                            <div class="col-12 mb-2">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" id="searchInputMobile"
                                        placeholder="Cari kavling, konsumen..."
                                        value="{{ $search }}"
                                        style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                    <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                        type="submit" title="Cari"
                                        style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                        <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="col-12 mb-2">
                                <select class="form-select select2-filter" name="land_bank_id" id="landBankSelectMobile" style="width: 100%;">
                                    <option value="">Semua Project (Land Bank)</option>
                                    @foreach($projects as $p)
                                        <option value="{{ $p->id }}" {{ $landBankId == $p->id ? 'selected' : '' }}>
                                            {{ $p->name }} ({{ $p->units_count }} Unit)
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 mb-2">
                                <select class="form-select select2-filter" name="unit_id" id="unitSelectMobile" style="width: 100%;">
                                    <option value="">Semua Unit</option>
                                    @foreach($unitsList as $u)
                                        <option value="{{ $u->id }}" {{ $unitId == $u->id ? 'selected' : '' }}>
                                            Blok {{ $u->unit_code ?? $u->block . '-' . $u->unit_number }} - {{ $u->unit_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 mb-2">
                                <select class="form-select" name="status_unit" id="statusUnitSelectMobile">
                                    <option value="all">Semua Status Unit</option>
                                    <option value="sold" {{ $statusUnit == 'sold' ? 'selected' : '' }}>Terjual (Sold)</option>
                                    <option value="booked" {{ $statusUnit == 'booked' ? 'selected' : '' }}>Booking Aktif</option>
                                    <option value="available" {{ $statusUnit == 'available' ? 'selected' : '' }}>Tersedia (Ready)</option>
                                </select>
                            </div>

                            <div class="col-6">
                                <button type="submit" class="btn btn-gradient-primary w-100 d-flex align-items-center justify-content-center gap-1" style="height: 38px;">
                                    <i class="mdi mdi-filter"></i> Filter
                                </button>
                            </div>
                            <div class="col-6">
                                <a href="{{ route('keuangan.project-accounting.index') }}" class="btn btn-gradient-secondary w-100 d-flex align-items-center justify-content-center gap-1" style="height: 38px;" onclick="showResetLoading(event)">
                                    <i class="mdi mdi-refresh"></i> Reset
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Multi-Tab Section -->
            <div class="border rounded-3 overflow-hidden bg-white mt-3">
                <div class="bg-light border-bottom p-2 px-3">
                    <ul class="nav nav-pills gap-1 gap-md-2 nav-pills-mobile-scroll" id="erpTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link erp-tab-btn active" id="hpp-tab" data-toggle="pill" data-bs-toggle="pill" data-target="#hppTabPane" data-bs-target="#hppTabPane" type="button" role="tab">
                                1. Matriks HPP & Laba Rugi Kavling
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link erp-tab-btn" id="spk-rab-tab" data-toggle="pill" data-bs-toggle="pill" data-target="#spkRabTabPane" data-bs-target="#spkRabTabPane" type="button" role="tab">
                                2. SPK vs RAB Variance Analysis
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link erp-tab-btn" id="journal-tab" data-toggle="pill" data-bs-toggle="pill" data-target="#journalTabPane" data-bs-target="#journalTabPane" type="button" role="tab">
                                3. Buku Jurnal Transaksi ERP
                            </button>
                        </li>
                    </ul>
                </div>

                <div class="tab-content" id="erpTabContent">

                    <!-- TAB 1: MATRIKS HPP & LABA RUGI PER KAVLING -->
                    <div class="tab-pane fade show active p-0" id="hppTabPane" role="tabpanel">
                        <div class="p-3 bg-light border-bottom d-flex flex-wrap justify-content-between align-items-center gap-2">
                            <small class="text-muted">
                                <strong>Struktur HPP Terpadu:</strong> Total HPP menggabungkan <span class="badge bg-white text-dark border">1. Biaya Tanah</span> + <span class="badge bg-white text-dark border">2. Jalan & Infrastruktur</span> + <span class="badge bg-white text-dark border">3. Perizinan & Legalitas</span> + <span class="badge bg-white text-dark border">4. Konstruksi Bangunan Rumah</span> + <span class="badge bg-white text-dark border">5. Servis Garansi</span>.
                            </small>
                            <span class="badge bg-primary text-white">{{ $unitFinancials->count() }} Kavling Terdata</span>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-erp align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>PROJECT & KAVLING</th>
                                        <th>KONSUMEN</th>
                                        <th class="text-center">STATUS</th>
                                        <th class="text-end">HARGA JUAL (REVENUE)</th>
                                        <th class="text-end">BIAYA TANAH</th>
                                        <th class="text-end">INFRASTRUKTUR / JALAN</th>
                                        <th class="text-end">BIAYA PERIZINAN</th>
                                        <th class="text-end">KONSTRUKSI RUMAH</th>
                                        <th class="text-end" style="background:#fef2f2; color:#dc2626;">TOTAL HPP GABUNGAN</th>
                                        <th class="text-end" style="background:#f8fafc;">GROSS PROFIT</th>
                                        <th class="text-center">MARGIN</th>
                                        <th class="text-end">KAS MASUK KONSUMEN</th>
                                        <th class="text-center">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($unitFinancials as $uf)
                                        <tr>
                                            <td>
                                                <div class="fw-bold text-dark">{{ $uf->unit_name }}</div>
                                                <small class="text-primary font-monospace fw-bold">{{ $uf->block_code }}</small>
                                                <small class="text-muted d-block" style="font-size: 0.74rem;">{{ $uf->project_name }}</small>
                                            </td>
                                            <td>
                                                <div class="fw-semibold text-dark">{{ $uf->customer_name }}</div>
                                                @if($uf->booking_code !== '-')
                                                    <small class="text-muted d-block font-monospace" style="font-size: 0.7rem;">{{ $uf->booking_code }}</small>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($uf->status === 'sold')
                                                    <span class="badge badge-pill-soft badge-soft-success">TERJUAL</span>
                                                @elseif($uf->status === 'booked')
                                                    <span class="badge badge-pill-soft badge-soft-primary">BOOKING</span>
                                                @else
                                                    <span class="badge badge-pill-soft badge-soft-secondary">AVAILABLE</span>
                                                @endif
                                            </td>
                                            <td class="text-end fw-bold font-monospace text-dark">
                                                Rp {{ number_format($uf->harga_jual, 0, ',', '.') }}
                                            </td>
                                            <td class="text-end font-monospace text-muted">
                                                Rp {{ number_format($uf->biaya_tanah, 0, ',', '.') }}
                                            </td>
                                            <td class="text-end font-monospace text-muted">
                                                <span>Rp {{ number_format($uf->biaya_infrastruktur, 0, ',', '.') }}</span>
                                                <small class="d-block text-muted" style="font-size: 0.68rem;">Alokasi Jalan</small>
                                            </td>
                                            <td class="text-end font-monospace text-info fw-semibold">
                                                Rp {{ number_format($uf->biaya_perizinan, 0, ',', '.') }}
                                            </td>
                                            <td class="text-end font-monospace">
                                                <span class="text-dark fw-semibold">Rp {{ number_format($uf->biaya_rumah, 0, ',', '.') }}</span>
                                                @if($uf->spk)
                                                    <small class="d-block text-muted" style="font-size: 0.7rem;">SPK: {{ $uf->spk->no_spk }}</small>
                                                @endif
                                            </td>
                                            <td class="text-end fw-bold font-monospace text-danger" style="background:#fef2f2;">
                                                Rp {{ number_format($uf->total_hpp_komitmen, 0, ',', '.') }}
                                            </td>
                                            <td class="text-end fw-bold font-monospace {{ $uf->gross_profit >= 0 ? 'text-success' : 'text-danger' }}" style="background:#f8fafc;">
                                                Rp {{ number_format($uf->gross_profit, 0, ',', '.') }}
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-pill-soft {{ $uf->margin_persen >= 20 ? 'badge-soft-success' : ($uf->margin_persen > 0 ? 'badge-soft-warning' : 'badge-soft-danger') }}">
                                                    {{ $uf->margin_persen }}%
                                                </span>
                                            </td>
                                            <td class="text-end font-monospace">
                                                <span class="text-success fw-bold">Rp {{ number_format($uf->uang_masuk_konsumen, 0, ',', '.') }}</span>
                                                @if($uf->piutang_konsumen > 0)
                                                    <small class="d-block text-danger" style="font-size: 0.7rem;">Sisa: Rp {{ number_format($uf->piutang_konsumen, 0, ',', '.') }}</small>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn-action view" title="Lihat Detail Biaya & HPP"
                                                    onclick="openDetailUnitModal({{ json_encode($uf) }})">
                                                    <i class="mdi mdi-eye"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="13" class="text-center py-4 text-muted">
                                                Tidak ada data kavling / unit yang sesuai dengan filter pencarian.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- TAB 2: SPK VS RAB VARIANCE ANALYSIS -->
                    <div class="tab-pane fade p-0" id="spkRabTabPane" role="tabpanel">
                        <div class="p-3 bg-light border-bottom">
                            <small class="text-muted">
                                <strong>Analisis Varian Anggaran Konstruksi (RAB vs SPK):</strong> Membandingkan Rencana Anggaran Biaya (RAB) dengan Nilai Kontrak SPK Pemborong dan Realisasi Termin yang telah dibayarkan.
                            </small>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-erp align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>NOMOR SPK & PEKERJAAN</th>
                                        <th>PROJECT / UNIT</th>
                                        <th>KONTRAKTOR / PEMBORONG</th>
                                        <th class="text-end">RAB ACUAN</th>
                                        <th class="text-end">NILAI KONTRAK SPK</th>
                                        <th class="text-end">REALISASI TERMIN</th>
                                        <th class="text-end">SISA KEWAJIBAN UTANG</th>
                                        <th class="text-center">PROGRESS FISIK</th>
                                        <th class="text-center">STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($spkList as $spk)
                                        @php
                                            $paidTermin = $spk->termins ? $spk->termins->where('status_bayar', 'lunas')->sum('nominal') : 0;
                                            $sisaUtang = max(0, $spk->nilai_kontrak - $paidTermin);
                                            $rabUnit = $spk->unit && $spk->unit->rabs ? $spk->unit->rabs->sum('total_biaya') : 0;
                                        @endphp
                                        <tr>
                                            <td>
                                                <span class="badge bg-light text-dark border font-monospace mb-1">{{ $spk->no_spk }}</span>
                                                <div class="fw-bold text-dark">{{ $spk->nama_pekerjaan }}</div>
                                                <small class="text-muted">{{ $spk->jenis_spk ?? 'Konstruksi Bangunan' }}</small>
                                            </td>
                                            <td>
                                                <div class="fw-semibold text-dark">{{ $spk->landBank->name ?? '-' }}</div>
                                                <small class="text-primary font-monospace">{{ $spk->unit ? 'Blok ' . $spk->unit->unit_code : 'Fasilitas Umum' }}</small>
                                            </td>
                                            <td>
                                                <div class="fw-semibold text-dark">{{ $spk->kontraktor_nama }}</div>
                                                <small class="text-muted">{{ $spk->kontraktor_telepon ?? '-' }}</small>
                                            </td>
                                            <td class="text-end font-monospace text-muted">
                                                Rp {{ number_format($rabUnit > 0 ? $rabUnit : $spk->nilai_kontrak, 0, ',', '.') }}
                                            </td>
                                            <td class="text-end font-monospace fw-bold text-dark">
                                                Rp {{ number_format($spk->nilai_kontrak, 0, ',', '.') }}
                                            </td>
                                            <td class="text-end font-monospace text-success fw-bold">
                                                Rp {{ number_format($paidTermin, 0, ',', '.') }}
                                            </td>
                                            <td class="text-end font-monospace text-danger fw-bold">
                                                Rp {{ number_format($sisaUtang, 0, ',', '.') }}
                                            </td>
                                            <td class="text-center" style="width: 140px;">
                                                <div class="d-flex justify-content-between small text-muted mb-1">
                                                    <span>Fisik</span>
                                                    <strong>{{ $spk->progress ?? 0 }}%</strong>
                                                </div>
                                                <div class="progress progress-thin">
                                                    <div class="progress-bar bg-success" style="width: {{ $spk->progress ?? 0 }}%;"></div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-pill-soft {{ $spk->status == 'selesai' ? 'badge-soft-success' : 'badge-soft-primary' }}">
                                                    {{ strtoupper($spk->status ?? 'BERJALAN') }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center py-4 text-muted">
                                                Belum ada data kontrak SPK kontraktor pada project yang dipilih.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- TAB 3: BUKU JURNAL TRANSAKSI ERP (AUDIT TRAIL) -->
                    <div class="tab-pane fade p-0" id="journalTabPane" role="tabpanel">
                        <div class="d-flex justify-content-between align-items-center p-3 bg-light border-bottom">
                            <h6 class="fw-bold text-dark mb-0" style="font-size: 0.92rem;">
                                Kronologi Arus Kas & Jurnal Mutasi Proyek
                            </h6>
                            <span class="badge bg-white text-dark border">{{ $journalEntries->count() }} Entri Transaksi Terdaftar</span>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-erp align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>TANGGAL TRANSAKSI</th>
                                        <th>NO. REFERENSI / REF ID</th>
                                        <th>KATEGORI & KETERANGAN</th>
                                        <th>PROJECT / UNIT</th>
                                        <th>TIPE MUTASI</th>
                                        <th class="text-end">DEBIT (KAS MASUK)</th>
                                        <th class="text-end">KREDIT (KAS KELUAR)</th>
                                        <th class="text-center">STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($journalEntries as $je)
                                        <tr>
                                            <td>
                                                <small class="fw-bold text-dark">{{ $je->date ? $je->date->format('d/m/Y') : '-' }}</small>
                                                <small class="text-muted d-block" style="font-size: 0.72rem;">{{ $je->date ? $je->date->format('H:i') : '' }} WIB</small>
                                            </td>
                                            <td>
                                                <span class="badge bg-light text-dark border font-monospace">{{ $je->ref_no }}</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-pill-soft badge-soft-primary mb-1 text-uppercase" style="font-size: 0.68rem;">{{ $je->category }}</span>
                                                <div class="text-dark small text-wrap" style="max-width: 320px;">{{ $je->description }}</div>
                                            </td>
                                            <td>
                                                <div class="fw-semibold text-dark">{{ $je->project }}</div>
                                                <small class="text-muted font-monospace">{{ $je->unit }}</small>
                                            </td>
                                            <td>
                                                <span class="badge badge-pill-soft {{ $je->type === 'KAS MASUK' ? 'badge-soft-success' : 'badge-soft-danger' }}">
                                                    {{ $je->type }}
                                                </span>
                                            </td>
                                            <td class="text-end font-monospace fw-bold text-success">
                                                {{ $je->debit > 0 ? 'Rp ' . number_format($je->debit, 0, ',', '.') : '-' }}
                                            </td>
                                            <td class="text-end font-monospace fw-bold text-danger">
                                                {{ $je->kredit > 0 ? 'Rp ' . number_format($je->kredit, 0, ',', '.') : '-' }}
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-pill-soft badge-soft-info">{{ $je->status }}</span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-4 text-muted">
                                                Tidak ada riwayat jurnal transaksi ERP yang tercatat.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL: DETAIL FINANCIAL DRILL DOWN PER KAVLING (Clean White Modal) -->
<div class="modal fade" id="modalDetailUnitFin" tabindex="-1" role="dialog" aria-labelledby="modalDetailUnitFinLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
            <div class="modal-header bg-white border-bottom py-3 px-4 d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="modal-title fw-bold text-dark mb-0" id="modalDetailUnitFinLabel" style="font-size: 1.05rem;">
                        Kartu Biaya & HPP Unit Kavling
                    </h5>
                    <small class="text-muted" style="font-size: 0.78rem;">Rincian komponen HPP komitmen, realisasi bayar, dan arus kas unit</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3 p-md-4" style="background: #f8fafc;">
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <div class="p-3 bg-white rounded-3 border h-100 shadow-sm">
                            <span class="text-muted small d-block" style="font-size: 0.74rem;">Project & Kavling</span>
                            <h5 class="fw-bold text-primary mb-1 mt-1" id="mUnitName">-</h5>
                            <span class="badge bg-light text-dark border font-monospace" id="mBlockCode">-</span>
                            <span class="text-muted small d-block mt-3" style="font-size: 0.74rem;">Konsumen / Pembeli</span>
                            <strong class="text-dark d-block mt-0.5" id="mCustomer">-</strong>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 bg-white rounded-3 border h-100 shadow-sm">
                            <span class="text-muted small d-block" style="font-size: 0.74rem;">Harga Jual Unit (Omset)</span>
                            <h4 class="fw-bold text-dark font-monospace mb-1 mt-1" id="mHargaJual">-</h4>
                            <span class="text-muted small d-block mt-3" style="font-size: 0.74rem;">Gross Profit & Margin</span>
                            <h5 class="fw-bold text-success font-monospace mb-0 mt-0.5" id="mProfit">-</h5>
                        </div>
                    </div>
                </div>

                <h6 class="fw-bold text-dark mb-2" style="font-size: 0.92rem;">Rincian 5 Komponen HPP Kavling:</h6>
                <div class="table-responsive mb-3 bg-white rounded-3 border shadow-sm">
                    <table class="table table-bordered table-sm mb-0">
                        <thead class="table-light">
                            <tr style="background: #f8fafc;">
                                <th>Komponen Biaya</th>
                                <th class="text-end">Estimasi / Anggaran</th>
                                <th class="text-end">Realisasi Bayar</th>
                                <th>Keterangan Alokasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="badge bg-light text-dark border me-1">1</span> Alokasi Pengadaan Lahan (Tanah Dasar)</td>
                                <td class="text-end font-monospace" id="mBiayaTanah">-</td>
                                <td class="text-end font-monospace" id="mBiayaTanahReal">-</td>
                                <td class="text-success small">Pro-rata Luas / Unit</td>
                            </tr>
                            <tr>
                                <td><span class="badge bg-light text-dark border me-1">2</span> Alokasi Jalan & Infrastruktur Kawasan</td>
                                <td class="text-end font-monospace" id="mBiayaInfra">-</td>
                                <td class="text-end font-monospace" id="mBiayaInfraReal">-</td>
                                <td class="text-muted small">Cut & Fill, Paving, Drainase</td>
                            </tr>
                            <tr>
                                <td><span class="badge bg-light text-dark border me-1">3</span> Rincian Biaya Perizinan & Legalitas</td>
                                <td class="text-end font-monospace text-info fw-bold" id="mBiayaPerizinan">-</td>
                                <td class="text-end font-monospace text-info fw-bold" id="mBiayaPerizinanReal">-</td>
                                <td class="text-info small">PBG, Sertifikat, Notaris</td>
                            </tr>
                            <tr>
                                <td><span class="badge bg-light text-dark border me-1">4</span> Biaya Konstruksi Bangunan Rumah (Fisik)</td>
                                <td class="text-end font-monospace text-dark fw-semibold" id="mBiayaRumah">-</td>
                                <td class="text-end font-monospace text-danger fw-bold" id="mBiayaRumahReal">-</td>
                                <td class="small" id="mRumahKet">SPK / RAP Unit</td>
                            </tr>
                            <tr>
                                <td><span class="badge bg-light text-dark border me-1">5</span> Biaya Servis & Garansi Pasca Serah Terima</td>
                                <td class="text-end font-monospace" id="mBiayaServis">-</td>
                                <td class="text-end font-monospace text-danger" id="mBiayaServisReal">-</td>
                                <td class="small text-muted">Pemeliharaan</td>
                            </tr>
                            <tr class="table-light fw-bold">
                                <td class="text-danger">TOTAL HPP UNIT KAVLING (GABUNGAN)</td>
                                <td class="text-end font-monospace text-danger fs-6" id="mTotalHppKomitmen">-</td>
                                <td class="text-end font-monospace text-danger fs-6" id="mTotalHppReal">-</td>
                                <td class="text-danger small">Akumulasi 1 s/d 5</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="p-3 bg-white rounded-3 border shadow-sm">
                    <div class="row text-center">
                        <div class="col-4">
                            <span class="text-muted small d-block" style="font-size: 0.74rem;">Uang Masuk Konsumen</span>
                            <strong class="text-success font-monospace" id="mUangMasuk">-</strong>
                        </div>
                        <div class="col-4 border-start border-end">
                            <span class="text-muted small d-block" style="font-size: 0.74rem;">Sisa Piutang Konsumen</span>
                            <strong class="text-danger font-monospace" id="mPiutang">-</strong>
                        </div>
                        <div class="col-4">
                            <span class="text-muted small d-block" style="font-size: 0.74rem;">Net Cashflow Unit</span>
                            <strong class="text-primary font-monospace" id="mNetCashflow">-</strong>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-white border-top py-2.5 px-4 d-flex justify-content-end">
                <button type="button" class="btn btn-sm btn-light border px-4" data-bs-dismiss="modal" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function formatRupiah(num) {
        return 'Rp ' + Number(num || 0).toLocaleString('id-ID');
    }

    function showFilterLoading() {
        Swal.fire({
            title: 'Memuat...',
            html: 'Sedang memfilter data akuntansi',
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

    function openDetailUnitModal(uf) {
        document.getElementById('mUnitName').innerText = uf.unit_name || '-';
        document.getElementById('mBlockCode').innerText = uf.block_code || '-';
        document.getElementById('mCustomer').innerText = uf.customer_name || '-';
        document.getElementById('mHargaJual').innerText = formatRupiah(uf.harga_jual);
        document.getElementById('mProfit').innerText = formatRupiah(uf.gross_profit) + ' (' + uf.margin_persen + '%)';

        document.getElementById('mBiayaTanah').innerText = formatRupiah(uf.biaya_tanah);
        document.getElementById('mBiayaTanahReal').innerText = formatRupiah(uf.biaya_tanah);

        document.getElementById('mBiayaInfra').innerText = formatRupiah(uf.biaya_infrastruktur);
        document.getElementById('mBiayaInfraReal').innerText = formatRupiah(uf.biaya_infrastruktur);

        document.getElementById('mBiayaPerizinan').innerText = formatRupiah(uf.biaya_perizinan);
        document.getElementById('mBiayaPerizinanReal').innerText = formatRupiah(uf.biaya_perizinan);

        document.getElementById('mBiayaRumah').innerText = formatRupiah(uf.biaya_rumah);
        document.getElementById('mBiayaRumahReal').innerText = formatRupiah(uf.realisasi_bayar_spk > 0 ? uf.realisasi_bayar_spk : (uf.status === 'ready' || uf.unit?.construction_progress === 'selesai' ? uf.biaya_rumah : 0));
        document.getElementById('mRumahKet').innerText = uf.spk ? ('SPK: ' + uf.spk.no_spk) : 'RAP Bangunan Unit';

        document.getElementById('mBiayaServis').innerText = formatRupiah(uf.biaya_servis);
        document.getElementById('mBiayaServisReal').innerText = formatRupiah(uf.biaya_servis);

        document.getElementById('mTotalHppKomitmen').innerText = formatRupiah(uf.total_hpp_komitmen);
        document.getElementById('mTotalHppReal').innerText = formatRupiah(uf.total_hpp_realisasi);

        document.getElementById('mUangMasuk').innerText = formatRupiah(uf.uang_masuk_konsumen);
        document.getElementById('mPiutang').innerText = formatRupiah(uf.piutang_konsumen);
        document.getElementById('mNetCashflow').innerText = formatRupiah(uf.net_cashflow);

        if (window.jQuery && typeof $('#modalDetailUnitFin').modal === 'function') {
            $('#modalDetailUnitFin').modal('show');
        } else if (window.bootstrap && bootstrap.Modal) {
            var modal = new bootstrap.Modal(document.getElementById('modalDetailUnitFin'));
            modal.show();
        }
    }

    $(document).ready(function() {
        if (window.jQuery && $.fn.select2) {
            $('.select2-filter').select2({
                theme: 'bootstrap-5',
                placeholder: function() {
                    return $(this).find('option:first').text();
                },
                allowClear: true,
                width: '100%'
            });
        }
    });
</script>
@endpush
