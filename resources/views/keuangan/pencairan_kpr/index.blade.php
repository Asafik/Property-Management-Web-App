@extends('layouts.partial.app')

@section('title', 'Pencairan Dana KPR (Disbursement) - Property Management App')

@section('content')
<style>
    .header-card {
        background: #ffffff;
        border-radius: 8px !important;
        border: none !important;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04);
        margin-bottom: 0;
    }

    .filter-card {
        background: #ffffff;
        padding: 0.85rem 1rem !important;
        margin-bottom: 1rem !important;
    }

    /* Select2 & Input Theme Alignment */
    .form-control, .form-select {
        border-color: #ebedf2 !important;
        font-size: 0.875rem !important;
        border-radius: 6px !important;
    }
    .form-control:focus, .form-select:focus {
        border-color: #bfa5fa !important;
        box-shadow: 0 0 0 0.2rem rgba(154, 85, 255, 0.12) !important;
    }

    /* Responsive Table & Scroll Styling */
    .table-responsive {
        overflow-x: auto !important;
        -webkit-overflow-scrolling: touch !important;
        width: 100% !important;
        margin-bottom: 0 !important;
    }

    .table thead th {
        color: #3b3f5c;
        font-weight: 700;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        background: #f8f9fa;
        border-bottom: 2px solid #e9ecef;
        padding: 0.75rem 0.85rem;
        white-space: nowrap;
    }

    .table tbody td {
        padding: 0.75rem 0.85rem;
        vertical-align: middle;
        border-bottom: 1px solid #f2f4f8;
        font-size: 0.88rem;
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

    .badge-status-pill {
        font-size: 11px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 5px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-flex;
        align-items: center;
    }

    .badge-status-lunas {
        background: #dcfce7;
        color: #15803d;
        border: 1px solid #bbf7d0;
    }

    .badge-status-partial {
        background: #fef9c3;
        color: #a16207;
        border: 1px solid #fef08a;
    }

    .badge-status-pending {
        background: #fee2e2;
        color: #b91c1c;
        border: 1px solid #fecaca;
    }

    /* Action Buttons Standard */
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

    /* ===== MODERN FILE UPLOAD STYLING (PERSIS TAMBAH PROPERTI) ===== */
    .properti-file-upload-modern {
        position: relative;
        width: 100%;
    }

    .properti-file-upload-modern input[type="file"] {
        position: absolute;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
        z-index: 2;
        top: 0;
        left: 0;
    }

    .properti-file-upload-modern .properti-file-label-modern {
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 12px;
        padding: 0.65rem 0.9rem;
        background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
        border: 2px dashed #d0d4db;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-bottom: 0;
    }

    .properti-file-upload-modern:hover .properti-file-label-modern {
        border-color: #9a55ff;
        background: linear-gradient(135deg, #f1f0ff, #f8f9fa);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(154, 85, 255, 0.1);
    }

    .properti-file-upload-modern.is-uploaded .properti-file-label-modern {
        border: 2px dashed #28a745;
        background: linear-gradient(135deg, #f2faf4, #f9fdfa);
    }

    .properti-file-upload-modern.is-uploaded:hover .properti-file-label-modern {
        border-color: #1e7e34;
        background: linear-gradient(135deg, #e7f7ec, #f2faf4);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(40, 167, 69, 0.15);
    }

    .properti-file-upload-modern .properti-file-label-modern i {
        font-size: 1.4rem;
        color: #9a55ff;
        background: rgba(154, 85, 255, 0.1);
        padding: 6px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        flex-shrink: 0;
    }

    .properti-file-upload-modern .properti-file-info-modern {
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .properti-file-upload-modern .properti-file-label-modern .file-title-text {
        font-size: 0.84rem;
        font-weight: 600;
        color: #2c2e3f;
    }

    .properti-file-upload-modern .properti-file-label-modern .file-sub-text {
        font-size: 0.72rem;
        color: #6c757d;
    }

    .properti-file-upload-modern .properti-file-label-modern .properti-file-size {
        font-size: 0.75rem;
        font-weight: 700;
        color: #9a55ff;
    }

    /* Responsive Breakpoints & Utilities */
    .table-kpr {
        min-width: 1020px;
    }

    @media (max-width: 767.98px) {
        .header-title-text {
            font-size: 1.15rem !important;
        }
        .header-desc-text {
            font-size: 0.8rem !important;
        }
        .stat-value-text {
            font-size: 1.05rem !important;
        }
        .filter-card {
            padding: 0.75rem !important;
        }
        .modal-dialog {
            margin: 0.6rem auto !important;
            max-width: calc(100% - 1.2rem) !important;
        }
        .modal-header {
            padding: 0.85rem 1rem !important;
        }
        .modal-body {
            padding: 1rem !important;
        }
        .modal-footer {
            padding: 0.75rem 1rem !important;
        }
        .properti-file-upload-modern .properti-file-label-modern {
            padding: 0.55rem 0.75rem;
            gap: 8px;
        }
        .properti-file-upload-modern .properti-file-label-modern i {
            width: 32px;
            height: 32px;
            font-size: 1.2rem;
            padding: 4px;
        }
    }

    @media (min-width: 768px) and (max-width: 991.98px) {
        .stat-value-text {
            font-size: 1.1rem !important;
        }
        .filter-row-desktop .d-flex {
            gap: 8px !important;
        }
    }
</style>

<div class="container-fluid px-1 px-sm-2 px-md-3 py-2 py-md-3">

    <!-- Header Banner -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 header-card" style="background: linear-gradient(135deg, #ffffff 0%, #f7f5ff 100%); border-radius: 14px;">
                <div class="card-body p-3 p-md-4 d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="text-dark mb-1 fw-bold header-title-text" style="font-size: 1.35rem;">
                            Pencairan Dana KPR (KPR Disbursement)
                        </h3>
                        <p class="text-muted mb-0 header-desc-text" style="font-size: 0.88rem;">
                            Monitoring & pencatatan realisasi transfer dana plafon KPR dari pihak Bank ke rekening Developer
                        </p>
                    </div>
                    <div class="d-none d-sm-block pe-2">
                        <i class="mdi mdi-bank-check" style="font-size: 3.2rem; color: #9a55ff; opacity: 0.25;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistic Cards (Sesuai Desain Dashboard) -->
    <div class="row g-2 g-md-3 mb-3 mb-md-4">
        <!-- Total Plafon KPR (Piutang) -->
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
            <div class="card shadow-sm border-0 h-100 mb-0">
                <div class="card-body d-flex justify-content-between align-items-center p-3">
                    <div>
                        <h4 class="text-dark mb-1 fw-bold stat-value-text" style="font-size: 1.15rem;">Rp {{ number_format($totalPlafonKpr, 0, ',', '.') }}</h4>
                        <p class="text-muted mb-0" style="font-size: 0.85rem;">Total Plafon KPR (Piutang)</p>
                        <small class="text-muted" style="font-size: 0.78rem;">Dari {{ $totalUnitKpr }} unit skema KPR</small>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-cash-multiple" style="font-size: 2.2rem; color: #9a55ff; opacity: 0.25;"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Dana KPR Sudah Dicairkan -->
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
            <div class="card shadow-sm border-0 h-100 mb-0">
                <div class="card-body d-flex justify-content-between align-items-center p-3">
                    <div>
                        <h4 class="text-success mb-1 fw-bold stat-value-text" style="font-size: 1.15rem;">Rp {{ number_format($totalDanaCair, 0, ',', '.') }}</h4>
                        <p class="text-muted mb-0" style="font-size: 0.85rem;">Dana KPR Sudah Dicairkan</p>
                        <small class="text-success fw-semibold" style="font-size: 0.78rem;">
                            <i class="mdi mdi-check-circle me-1"></i>Realisasi Kas Masuk Bank
                        </small>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-cash-check" style="font-size: 2.2rem; color: #28a745; opacity: 0.3;"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sisa Dana Belum Cair -->
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
            <div class="card shadow-sm border-0 h-100 mb-0">
                <div class="card-body d-flex justify-content-between align-items-center p-3">
                    <div>
                        <h4 class="text-danger mb-1 fw-bold stat-value-text" style="color: #ea580c !important; font-size: 1.15rem;">Rp {{ number_format($totalSisaPiutang, 0, ',', '.') }}</h4>
                        <p class="text-muted mb-0" style="font-size: 0.85rem;">Sisa Dana Belum Cair</p>
                        <small class="text-danger" style="font-size: 0.78rem;">Menunggu transfer dari Bank</small>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-cash-clock" style="font-size: 2.2rem; color: #ea580c; opacity: 0.3;"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Persentase Realisasi Kas -->
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
            @php
                $pctTotal = $totalPlafonKpr > 0 ? round(($totalDanaCair / $totalPlafonKpr) * 100) : 0;
            @endphp
            <div class="card shadow-sm border-0 h-100 mb-0">
                <div class="card-body d-flex justify-content-between align-items-center p-3">
                    <div class="w-100 pe-2">
                        <h4 class="text-primary mb-1 fw-bold stat-value-text" style="font-size: 1.15rem;">{{ $pctTotal }}%</h4>
                        <p class="text-muted mb-1" style="font-size: 0.85rem;">Persentase Realisasi Kas</p>
                        <div class="progress mb-1" style="height: 5px; border-radius: 4px;">
                            <div class="progress-bar bg-gradient-primary" style="width: {{ $pctTotal }}%;"></div>
                        </div>
                        <small class="text-muted" style="font-size: 0.78rem;">Dari Total Plafon KPR</small>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-chart-donut" style="font-size: 2.2rem; color: #0d6efd; opacity: 0.25;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Notifikasi Alert -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="mdi mdi-check-circle me-1"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="mdi mdi-alert-circle me-1"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Tabel Data Pencairan KPR -->
    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2 py-3 px-3 px-md-4">
                    <h5 class="card-title mb-0" style="font-size: 1rem;">
                        <i class="mdi mdi-format-list-bulleted me-2 text-primary"></i>Daftar Unit KPR & Status Pencairan Bank
                    </h5>
                    <span class="text-muted small">Total <strong>{{ $unitsData->total() }}</strong> Unit Terdata</span>
                </div>

                <div class="card-body p-2.5 p-md-4">
                    <!-- FILTER SECTION (PERSIS DASHBOARD & MASTER BANK) -->
                    <div class="filter-card mb-3">
                        <!-- DESKTOP & TABLET VERSION -->
                        <div class="filter-row-desktop d-none d-md-block">
                            <form method="GET" action="{{ route('finance.kpr-disbursement.index') }}" id="filterForm">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                    <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                        <!-- Search Input -->
                                        <div style="min-width: 200px; max-width: 280px; flex: 1;">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="search" id="searchInput"
                                                    placeholder="Cari kavling, unit, konsumen..." value="{{ request('search') }}"
                                                    style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none; height: 38px;">
                                                <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                    type="submit" id="searchSubmitBtn" title="Cari"
                                                    style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                    <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Project / Land Bank Select -->
                                        <div style="min-width: 180px; max-width: 260px;">
                                            <select name="land_bank_id" class="form-select" onchange="this.form.submit()" style="height: 38px;">
                                                <option value="">Semua Project (Land Bank)</option>
                                                @foreach($projects as $p)
                                                    <option value="{{ $p->id }}" {{ request('land_bank_id') == $p->id ? 'selected' : '' }}>
                                                        {{ $p->name }} ({{ $p->units_count }} Unit)
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Status Pencairan Select -->
                                        <div style="min-width: 170px; max-width: 220px;">
                                            <select name="status_pencairan" class="form-select" onchange="this.form.submit()" style="height: 38px;">
                                                <option value="all">Semua Status Pencairan</option>
                                                <option value="belum_cair" {{ request('status_pencairan') == 'belum_cair' ? 'selected' : '' }}>Belum Cair (0%)</option>
                                                <option value="termin" {{ request('status_pencairan') == 'termin' ? 'selected' : '' }}>Cair Sebagian (Termin)</option>
                                                <option value="lunas" {{ request('status_pencairan') == 'lunas' ? 'selected' : '' }}>Lunas / Selesai (100%)</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Right Action Buttons (Filter, Reset & Per Page persis Bank) -->
                                    <div class="d-flex align-items-center gap-2 ms-auto">
                                        <div style="width: 105px;">
                                            <select class="form-select" name="per_page" id="perPageSelect" onchange="this.form.submit()" style="height: 38px;">
                                                <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 data</option>
                                                <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15 data</option>
                                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 data</option>
                                                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 data</option>
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-gradient-primary btn-icon-only" title="Filter Data">
                                             <i class="mdi mdi-filter" style="font-size: 1.15rem; color: #ffffff;"></i>
                                        </button>
                                        <a href="{{ route('finance.kpr-disbursement.index') }}" class="btn btn-gradient-secondary btn-icon-only" title="Reset Filter">
                                            <i class="mdi mdi-refresh" style="font-size: 1.15rem; color: #ffffff;"></i>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- MOBILE VERSION -->
                        <div class="filter-row-mobile d-block d-md-none">
                            <form method="GET" action="{{ route('finance.kpr-disbursement.index') }}" id="filterFormMobile">
                                <div class="row g-2">
                                    <div class="col-12">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search"
                                                placeholder="Cari kavling, unit, konsumen..." value="{{ request('search') }}"
                                                style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none; height: 38px;">
                                            <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                type="submit" style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px;">
                                                <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <select name="land_bank_id" class="form-select" onchange="this.form.submit()" style="height: 38px;">
                                            <option value="">Semua Project (Land Bank)</option>
                                            @foreach($projects as $p)
                                                <option value="{{ $p->id }}" {{ request('land_bank_id') == $p->id ? 'selected' : '' }}>
                                                    {{ $p->name }} ({{ $p->units_count }} Unit)
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <select name="status_pencairan" class="form-select" onchange="this.form.submit()" style="height: 38px;">
                                            <option value="all">Semua Status Pencairan</option>
                                            <option value="belum_cair" {{ request('status_pencairan') == 'belum_cair' ? 'selected' : '' }}>Belum Cair (0%)</option>
                                            <option value="termin" {{ request('status_pencairan') == 'termin' ? 'selected' : '' }}>Cair Sebagian (Termin)</option>
                                            <option value="lunas" {{ request('status_pencairan') == 'lunas' ? 'selected' : '' }}>Lunas / Selesai (100%)</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <select name="per_page" class="form-select" onchange="this.form.submit()" style="height: 38px;">
                                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 data per halaman</option>
                                            <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15 data per halaman</option>
                                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 data per halaman</option>
                                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 data per halaman</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-gradient-primary w-100 d-flex align-items-center justify-content-center gap-1" style="height: 38px;" title="Filter">
                                            <i class="mdi mdi-filter"></i> Filter
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('finance.kpr-disbursement.index') }}" class="btn btn-gradient-secondary w-100 d-flex align-items-center justify-content-center gap-1" style="height: 38px;" title="Reset">
                                            <i class="mdi mdi-refresh"></i> Reset
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- TABEL DATA -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 table-kpr">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 50px;">NO</th>
                                    <th>KAVLING / UNIT</th>
                                    <th>KONSUMEN</th>
                                    <th>BANK PENYALUR</th>
                                    <th class="text-end">HARGA & DP</th>
                                    <th class="text-end">PLAFON KPR</th>
                                    <th class="text-end">REALISASI CAIR</th>
                                    <th class="text-end">SISA PIUTANG</th>
                                    <th class="text-center">STATUS</th>
                                    <th class="text-center" style="width: 150px;">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($unitsData as $idx => $row)
                                    <tr>
                                        <td class="text-center fw-bold text-muted">{{ $unitsData->firstItem() + $idx }}</td>
                                        <td>
                                            <div class="fw-bold text-dark" style="font-size: 0.9rem;">
                                                {{ $row->unit->unit_name ?? 'Unit ' . $row->unit->unit_code }}
                                            </div>
                                            <small class="text-muted d-block" style="font-size: 11px;">
                                                <i class="mdi mdi-home-outline text-primary me-1"></i>Kode: <strong class="font-monospace text-primary">{{ $row->unit->unit_code }}</strong> | Tipe: {{ $row->unit->type }}
                                            </small>
                                            <small class="text-muted d-block" style="font-size: 11px;">
                                                <i class="mdi mdi-map-marker-outline me-1"></i>{{ $row->unit->landBank->name ?? '-' }}
                                            </small>
                                        </td>
                                        <td>
                                            <div class="fw-semibold text-dark" style="font-size: 0.88rem;">
                                                {{ $row->customer->full_name ?? '-' }}
                                            </div>
                                            @if($row->customer?->phone)
                                                <small class="text-muted d-block" style="font-size: 11px;">
                                                    <i class="mdi mdi-phone-outline me-1"></i>{{ $row->customer->phone }}
                                                </small>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="fw-bold text-primary" style="font-size: 0.88rem;">
                                                <i class="mdi mdi-bank-outline me-1"></i>{{ $row->bankName }}
                                            </div>
                                            @if($row->kprApp?->bank?->number)
                                                <small class="text-muted d-block" style="font-size: 11px;">
                                                    Rek: {{ $row->kprApp->bank->number }}
                                                </small>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <div class="fw-bold text-dark font-monospace" style="font-size: 0.9rem;">
                                                Rp {{ number_format($row->hargaJual, 0, ',', '.') }}
                                            </div>
                                            <small class="text-success font-monospace d-block" style="font-size: 11px; font-weight: 600;">
                                                DP: Rp {{ number_format($row->dpKonsumen, 0, ',', '.') }}
                                            </small>
                                        </td>
                                        <td class="text-end font-monospace fw-bold text-primary" style="font-size: 0.9rem;">
                                            Rp {{ number_format($row->plafonKpr, 0, ',', '.') }}
                                        </td>
                                        <td class="text-end">
                                            <div class="fw-bold text-success font-monospace" style="font-size: 0.88rem;">
                                                Rp {{ number_format($row->totalCair, 0, ',', '.') }}
                                            </div>
                                            <div class="progress mt-1" style="height: 4px;" title="{{ $row->persenCair }}% Terealisasi">
                                                <div class="progress-bar bg-success" style="width: {{ $row->persenCair }}%;"></div>
                                            </div>
                                            <small class="text-muted" style="font-size: 10.5px;">{{ $row->persenCair }}% terealisasi</small>
                                        </td>
                                        <td class="text-end font-monospace fw-bold {{ $row->sisaCair > 0 ? 'text-warning' : 'text-muted' }}" style="font-size: 0.88rem;">
                                            Rp {{ number_format($row->sisaCair, 0, ',', '.') }}
                                        </td>
                                        <td class="text-center">
                                            @if($row->statusPencairan === 'lunas')
                                                <span class="badge-status-pill badge-status-lunas">
                                                    <i class="mdi mdi-check-circle-outline me-1"></i>Lunas
                                                </span>
                                            @elseif($row->statusPencairan === 'termin')
                                                <span class="badge-status-pill badge-status-partial">
                                                    <i class="mdi mdi-clock-outline me-1"></i>Sebagian
                                                </span>
                                            @else
                                                <span class="badge-status-pill badge-status-pending">
                                                    <i class="mdi mdi-alert-circle-outline me-1"></i>Belum Cair
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="d-inline-flex gap-1 align-items-center">
                                                @if($row->sisaCair > 0)
                                                    <button type="button" class="btn btn-sm btn-gradient-success btn-open-disburse d-inline-flex align-items-center px-2.5 py-1.5 shadow-sm"
                                                        data-unit-id="{{ $row->unit->id }}"
                                                        data-unit-title="{{ ($row->unit->unit_name ?? $row->unit->unit_code) . ' - ' . ($row->customer->full_name ?? '-') }}"
                                                        data-plafon="{{ $row->plafonKpr }}"
                                                        data-total-cair="{{ $row->totalCair }}"
                                                        data-sisa-cair="{{ $row->sisaCair }}"
                                                        data-bank-name="{{ $row->bankName }}"
                                                        data-termin-count="{{ count($row->disbursements ?? []) + 1 }}"
                                                        title="Input Pencairan Dana Bank" style="border-radius: 6px; font-size: 0.78rem; font-weight: 700; height: 32px;">
                                                        <i class="mdi mdi-plus-circle me-1"></i>Cairkan
                                                    </button>
                                                @else
                                                    <button type="button" class="btn btn-sm btn-light border text-success d-inline-flex align-items-center px-2.5 py-1.5" disabled style="border-radius: 6px; font-size: 0.78rem; font-weight: 700; opacity: 0.85; height: 32px;">
                                                        <i class="mdi mdi-check-circle me-1"></i>Selesai
                                                    </button>
                                                @endif

                                                <button type="button" class="btn-action view btn-open-history"
                                                    data-unit-title="{{ ($row->unit->unit_name ?? $row->unit->unit_code) . ' - ' . ($row->customer->full_name ?? '-') }}"
                                                    data-history="{{ base64_encode(json_encode($row->disbursements ?? [])) }}"
                                                    title="Lihat Riwayat Pencairan">
                                                    <i class="mdi mdi-history"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center py-5">
                                            <div class="text-muted">
                                                <i class="mdi mdi-bank-transfer fs-1 d-block mb-2 text-secondary"></i>
                                                <h6 class="fw-bold mb-1">Belum Ada Unit Skema KPR</h6>
                                                <p class="mb-0 text-muted" style="font-size: 0.85rem;">Unit yang menggunakan metode pembayaran KPR akan otomatis tercatat di sini.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- PAGINATION - PERSIS DASHBOARD & MASTER INVOICE -->
                    @if ($unitsData instanceof \Illuminate\Pagination\LengthAwarePaginator && $unitsData->total() > 0)
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                            <div class="pagination-info mb-2 mb-sm-0 text-muted" style="font-size: 0.85rem;">
                                Menampilkan {{ $unitsData->firstItem() }} - {{ $unitsData->lastItem() }} dari
                                {{ $unitsData->total() }} data
                            </div>
                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                    {{-- Previous Page Link --}}
                                    @if ($unitsData->onFirstPage())
                                        <li class="page-item disabled" aria-disabled="true">
                                            <span class="page-link" aria-label="Previous">
                                                <i class="mdi mdi-chevron-left"></i>
                                            </span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link"
                                                href="{{ $unitsData->appends(request()->query())->previousPageUrl() }}"
                                                rel="prev" aria-label="Previous">
                                                <i class="mdi mdi-chevron-left"></i>
                                            </a>
                                        </li>
                                    @endif

                                    {{-- Pagination Elements --}}
                                    @foreach ($unitsData->getUrlRange(max(1, $unitsData->currentPage() - 2), min($unitsData->lastPage(), $unitsData->currentPage() + 2)) as $page => $url)
                                        @if ($page == $unitsData->currentPage())
                                            <li class="page-item active" aria-current="page">
                                                <span class="page-link">{{ $page }}</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link"
                                                    href="{{ $unitsData->appends(request()->query())->url($page) }}">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach

                                    {{-- Next Page Link --}}
                                    @if ($unitsData->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link"
                                                href="{{ $unitsData->appends(request()->query())->nextPageUrl() }}"
                                                rel="next" aria-label="Next">
                                                <i class="mdi mdi-chevron-right"></i>
                                            </a>
                                        </li>
                                    @else
                                        <li class="page-item disabled" aria-disabled="true">
                                            <span class="page-link" aria-label="Next">
                                                <i class="mdi mdi-chevron-right"></i>
                                            </span>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>

<!-- MODAL: INPUT PENCAIRAN KPR BARU -->
<div class="modal fade" id="modalDisbursement" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 560px;">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 14px; overflow: hidden;">
            <div class="modal-header bg-white border-bottom py-3 px-4">
                <div>
                    <h5 class="modal-title fw-bold text-dark mb-0" id="modalDisbursementTitle" style="font-size: 1.05rem;">Catat Pencairan Dana KPR</h5>
                    <small class="text-primary fw-semibold" id="modalDisbursementSubtitle">-</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formDisbursement" method="POST" action="{{ route('finance.kpr-disbursement.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="land_bank_unit_id" id="disburse_unit_id">

                <div class="modal-body p-3 p-md-4 bg-light">
                    <!-- Info Box Ringkas -->
                    <div class="p-2.5 px-3 bg-white border rounded-3 mb-3">
                        <div class="row g-2 text-center text-sm-start">
                            <div class="col-4">
                                <small class="text-muted d-block" style="font-size: 11px;">Plafon KPR</small>
                                <span class="fw-bold font-monospace text-primary" style="font-size: 0.9rem;" id="info_plafon_kpr">Rp 0</span>
                            </div>
                            <div class="col-4">
                                <small class="text-muted d-block" style="font-size: 11px;">Sudah Cair</small>
                                <span class="fw-bold font-monospace text-success" style="font-size: 0.9rem;" id="info_total_cair">Rp 0</span>
                            </div>
                            <div class="col-4">
                                <small class="text-muted d-block" style="font-size: 11px;">Sisa Piutang</small>
                                <span class="fw-bold font-monospace text-warning" style="font-size: 0.9rem;" id="info_sisa_cair">Rp 0</span>
                            </div>
                        </div>
                    </div>

                    <div class="row g-2.5 mb-2.5">
                        <div class="col-12">
                            <label class="form-label small fw-bold text-dark mb-1">Nama Termin Pencairan <span class="text-danger">*</span></label>
                            <input type="text" name="nama_termin" id="disburse_nama_termin" class="form-control form-control-sm" placeholder="Contoh: Pencairan 100% Penuh / Termin 1 - Pondasi" required>
                        </div>
                    </div>

                    <div class="row g-2.5 mb-2.5">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-dark mb-1">Tanggal Dana Masuk <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_cair" id="disburse_tanggal" class="form-control form-control-sm" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-dark mb-1">Nominal Pencairan Masuk (Rp) <span class="text-danger">*</span></label>
                            <input type="number" name="nominal_cair" id="disburse_nominal" class="form-control form-control-sm font-monospace text-end fw-bold text-success" placeholder="0" required>
                        </div>
                    </div>

                    <div class="row g-2.5 mb-2.5">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-dark mb-1">Bank Penyalur KPR</label>
                            <input type="text" name="bank_penyalur" id="disburse_bank_penyalur" class="form-control form-control-sm" placeholder="Contoh: Bank BCA / Bank BTN">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-dark mb-1">Rekening Tujuan Developer</label>
                            <input type="text" name="rekening_tujuan" id="disburse_rekening_tujuan" class="form-control form-control-sm" placeholder="Contoh: Rek. Operasional PT">
                        </div>
                    </div>

                    <div class="row g-2.5 mb-2.5">
                        <div class="col-12">
                            <label class="form-label small fw-bold text-dark mb-1">No. Referensi Bank / SP2D</label>
                            <input type="text" name="no_referensi_bank" id="disburse_ref" class="form-control form-control-sm font-monospace" placeholder="Nomor referensi mutasi bank">
                        </div>
                    </div>

                    <div class="mb-2.5">
                        <label class="form-label small fw-bold text-dark mb-1">Upload Bukti Transfer / Rekening Koran</label>
                        <div class="properti-file-upload-modern" id="container_bukti_transfer">
                            <input type="file" name="bukti_transfer" id="upload_bukti_transfer" accept=".pdf,.jpg,.jpeg,.png">
                            <label for="upload_bukti_transfer" class="properti-file-label-modern">
                                <i class="mdi mdi-cloud-upload"></i>
                                <div class="properti-file-info-modern">
                                    <span class="file-title-text">Upload Bukti Transfer Bank</span>
                                    <span class="file-sub-text">Format: PDF, JPG, PNG (Maks: 10MB)</span>
                                </div>
                                <span class="properti-file-size d-none"></span>
                            </label>
                        </div>
                    </div>

                    <div class="mb-0">
                        <label class="form-label small fw-bold text-dark mb-1">Catatan Tambahan</label>
                        <textarea name="catatan" class="form-control form-control-sm" rows="2" placeholder="Catatan opsional mengenai pencairan KPR..."></textarea>
                    </div>
                </div>

                <div class="modal-footer bg-white border-top py-2.5 px-4 d-flex justify-content-end">
                    <button type="button" class="btn btn-sm btn-light border px-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-gradient-success px-4 fw-semibold" id="btnSubmitDisburse">
                        <i class="mdi mdi-check-circle me-1"></i>Simpan Pencairan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL: RIWAYAT PENCAIRAN PER UNIT -->
<div class="modal fade" id="modalHistory" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 640px;">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 14px; overflow: hidden;">
            <div class="modal-header bg-white border-bottom py-3 px-4">
                <div>
                    <h5 class="modal-title fw-bold text-dark mb-0" style="font-size: 1.05rem;">Riwayat Realisasi Pencairan KPR</h5>
                    <small class="text-primary fw-semibold" id="modalHistorySubtitle">-</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 bg-light">
                <div class="table-responsive bg-white rounded-3 border">
                    <table class="table table-hover align-middle mb-0" style="font-size: 0.85rem;">
                        <thead class="table-light">
                            <tr>
                                <th>TERMIN</th>
                                <th>TGL CAIR</th>
                                <th class="text-end">NOMINAL CAIR</th>
                                <th>BANK & REF</th>
                                <th>BUKTI</th>
                                <th class="text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody id="historyTableBody">
                            <!-- Populated via JS -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer bg-white border-top py-2.5 px-4 d-flex justify-content-end">
                <button type="button" class="btn btn-sm btn-light border px-4" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function formatRupiah(num) {
        return 'Rp ' + (num || 0).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    // Modern File Upload Interaction (sama persis Tambah Properti)
    function resetBuktiTransferUpload() {
        const fileInput = document.getElementById('upload_bukti_transfer');
        if (fileInput) fileInput.value = '';
        const container = document.getElementById('container_bukti_transfer');
        if (container) {
            container.classList.remove('is-uploaded');
            const label = container.querySelector('.file-title-text');
            const subText = container.querySelector('.file-sub-text');
            const sizeSpan = container.querySelector('.properti-file-size');
            const icon = container.querySelector('.properti-file-label-modern i');

            if (label) {
                label.textContent = 'Upload Bukti Transfer Bank';
                label.className = 'file-title-text';
            }
            if (subText) subText.textContent = 'Format: PDF, JPG, PNG (Maks: 10MB)';
            if (sizeSpan) {
                sizeSpan.textContent = '';
                sizeSpan.classList.add('d-none');
            }
            if (icon) {
                icon.className = 'mdi mdi-cloud-upload';
                icon.style.cssText = '';
            }
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('upload_bukti_transfer');
        if (fileInput) {
            fileInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                const container = this.closest('.properti-file-upload-modern');
                if (!container) return;
                const label = container.querySelector('.file-title-text');
                const subText = container.querySelector('.file-sub-text');
                const sizeSpan = container.querySelector('.properti-file-size');
                const icon = container.querySelector('.properti-file-label-modern i');

                if (file) {
                    const fileName = file.name;
                    const fileSize = file.size;
                    container.classList.add('is-uploaded');
                    if (label) {
                        label.textContent = fileName.length > 30 ? fileName.substring(0, 30) + '...' : fileName;
                        label.className = 'file-title-text text-success fw-bold';
                    }
                    if (subText) subText.textContent = 'File bukti transfer siap diunggah';
                    
                    if (fileSize && sizeSpan) {
                        const sizeInMB = (fileSize / (1024 * 1024)).toFixed(2);
                        sizeSpan.textContent = sizeInMB + ' MB';
                        sizeSpan.classList.remove('d-none');
                    }
                    
                    if (icon) {
                        icon.className = 'mdi mdi-file-check text-success';
                        icon.style.cssText = 'color: #28a745 !important; background: rgba(40, 167, 69, 0.1) !important;';
                    }
                } else {
                    resetBuktiTransferUpload();
                }
            });
        }
    });

    $(document).on('click', '.btn-open-disburse', function() {
        let el = $(this);
        let unitId = el.data('unit-id');
        let title = el.data('unit-title');
        let plafon = parseFloat(el.data('plafon')) || 0;
        let totalCair = parseFloat(el.data('total-cair')) || 0;
        let sisaCair = parseFloat(el.data('sisa-cair')) || 0;
        let bankName = el.data('bank-name');
        let terminCount = parseInt(el.data('termin-count')) || 1;

        resetBuktiTransferUpload();

        $('#disburse_unit_id').val(unitId);
        $('#modalDisbursementSubtitle').text(title);
        $('#info_plafon_kpr').text(formatRupiah(plafon));
        $('#info_total_cair').text(formatRupiah(totalCair));
        $('#info_sisa_cair').text(formatRupiah(sisaCair));
        $('#disburse_nominal').val(sisaCair);
        $('#disburse_bank_penyalur').val(bankName);

        if (totalCair === 0) {
            $('#disburse_nama_termin').val('Pencairan Plafon KPR (100% Penuh)');
        } else {
            $('#disburse_nama_termin').val('Pencairan Termin Ke-' + terminCount);
        }

        let modalEl = document.getElementById('modalDisbursement');
        if (window.bootstrap && bootstrap.Modal) {
            let bsModal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
            bsModal.show();
        } else {
            $('#modalDisbursement').modal('show');
        }
    });

    $(document).on('click', '.btn-open-history', function() {
        let el = $(this);
        let title = el.data('unit-title');
        let base64History = el.data('history');
        let disbursements = [];
        try {
            disbursements = JSON.parse(atob(base64History)) || [];
        } catch(e) {
            disbursements = [];
        }

        $('#modalHistorySubtitle').text(title);
        let tbody = document.getElementById('historyTableBody');
        tbody.innerHTML = '';

        if (!disbursements || disbursements.length === 0) {
            tbody.innerHTML = '<tr><td colspan="6" class="text-center py-4 text-muted">Belum ada catatan pencairan dana KPR untuk unit ini.</td></tr>';
        } else {
            disbursements.forEach(function(d) {
                let buktiHtml = d.bukti_transfer 
                    ? `<a href="/${d.bukti_transfer}" target="_blank" class="badge bg-primary text-white text-decoration-none"><i class="mdi mdi-file-document me-1"></i>Lihat Bukti</a>`
                    : '<span class="text-muted">-</span>';

                let row = `
                    <tr>
                        <td class="fw-bold text-dark">${d.nama_termin || ('Termin ' + d.termin_ke)}</td>
                        <td>${d.tanggal_cair}</td>
                        <td class="text-end font-monospace fw-bold text-success">${formatRupiah(d.nominal_cair)}</td>
                        <td>
                            <span class="d-block fw-semibold">${d.bank_penyalur || '-'}</span>
                            <small class="text-muted font-monospace">${d.no_referensi_bank || ''}</small>
                        </td>
                        <td>${buktiHtml}</td>
                        <td class="text-center">
                            <form action="/keuangan/pencairan-kpr/${d.id}" method="POST" class="d-inline form-delete-disburse">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="button" class="btn btn-xs btn-link text-danger p-0 btn-delete-disburse" title="Hapus Catatan Ini">
                                    <i class="mdi mdi-trash-can-outline font-size-16"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                `;
                tbody.innerHTML += row;
            });
        }

        let modalEl = document.getElementById('modalHistory');
        if (window.bootstrap && bootstrap.Modal) {
            let bsModal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
            bsModal.show();
        } else {
            $('#modalHistory').modal('show');
        }
    });

    $(document).on('click', '.btn-delete-disburse', function(e) {
        e.preventDefault();
        let form = $(this).closest('form');
        Swal.fire({
            title: 'Hapus Catatan Pencairan Ini?',
            text: 'Nominal pencairan akan ditarik kembali dari perhitungan kas proyek!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
</script>
@endpush
