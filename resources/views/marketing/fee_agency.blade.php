@extends('layouts.partial.app')

@section('title', 'Master Aturan Fee Agency - Property Management App')

@section('content')
<style>
    /* Card & Banner Styling */
    .header-card {
        border-radius: 12px;
        border: none;
        background: #ffffff;
    }

    /* Filter Card */
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

    /* Action Buttons (Matching Data Bank) */
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

    .btn-action.edit {
        background: #f3e8ff;
        color: #7e22ce;
    }

    .btn-action.edit:hover {
        background: #7e22ce;
        color: #ffffff;
        transform: translateY(-2px);
    }

    .btn-action.delete {
        background: #fee2e2;
        color: #dc2626;
    }

    .btn-action.delete:hover {
        background: #dc2626;
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

    /* Prominent Catalog Unit Button */
    .btn-catalog-unit {
        background: #ffffff;
        color: #6366f1;
        border: 1.5px solid #6366f1;
        border-radius: 8px;
        padding: 0.45rem 1rem;
        font-weight: 700;
        font-size: 0.85rem;
        transition: all 0.2s ease;
        text-decoration: none !important;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
    }

    .btn-catalog-unit:hover {
        background: #6366f1;
        color: #ffffff !important;
        border-color: #6366f1;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.25);
    }

    /* Modal Form Controls Perfect Spacing & Centering */
    .modal-custom-compact {
        max-width: 520px !important;
        margin: 1.75rem auto;
    }

    @media (max-width: 575.98px) {
        .modal-custom-compact {
            max-width: 95% !important;
            margin: 0.75rem auto;
        }
    }

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

    .modal-custom-compact .input-group .form-control {
        border-top-left-radius: 0 !important;
        border-bottom-left-radius: 0 !important;
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

    /* Select2 Modal & Filter Integration */
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

    .modal-custom-compact .select2-container--bootstrap-5 .select2-selection {
        min-height: 42px !important;
        height: 42px !important;
        border-radius: 7px !important;
        font-size: 0.88rem !important;
    }

    .select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
        padding-left: 0 !important;
        line-height: 38px !important;
        color: #1f2937 !important;
    }

    .modal-custom-compact .select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
        line-height: 40px !important;
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
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.3rem 0.65rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
    }

    .status-badge.aktif {
        background: #ecfdf5;
        color: #059669;
        border: 1px solid #a7f3d0;
    }

    .status-badge.nonaktif {
        background: #fef2f2;
        color: #dc2626;
        border: 1px solid #fecaca;
    }
</style>

<div class="container-fluid px-1 px-sm-2 px-md-3 py-2 py-md-3">

    <!-- Header Card Banner -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 header-card">
                <div class="card-body p-3 p-md-4 py-3 py-md-4 d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3" style="min-height: 100px;">
                    <div>
                        <h3 class="text-dark mb-1 fw-bold" style="font-size: 1.35rem;">
                            Master Aturan Fee Agency / Komisi
                        </h3>
                        <p class="text-muted mb-0" style="font-size: 0.88rem;">
                            Kelola aturan dan formula perhitungan komisi otomatis bagi agency & marketing untuk penjualan unit kavling
                        </p>
                    </div>
                    <div class="d-none d-lg-block pe-2">
                        <i class="mdi mdi-cash-multiple" style="font-size: 3rem; color: #9a55ff; opacity: 0.25;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 4 Stats Cards -->
    <div class="row g-2 g-md-3 mb-3 mb-md-4">
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 12px; background: #ffffff;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-semibold d-block" style="font-size: 0.78rem;">Total Aturan</span>
                        <h4 class="fw-bold text-dark mb-0 mt-1" id="stat_total">{{ $totalRules }}</h4>
                    </div>
                    <div class="rounded-circle bg-secondary bg-opacity-10 p-2 text-secondary d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                        <i class="mdi mdi-format-list-bulleted fs-5"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 12px; background: #ffffff;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-semibold d-block" style="font-size: 0.78rem;">Aturan Aktif</span>
                        <h4 class="fw-bold text-success mb-0 mt-1" id="stat_active">{{ $activeRules }}</h4>
                    </div>
                    <div class="rounded-circle bg-success bg-opacity-10 p-2 text-success d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                        <i class="mdi mdi-check-circle fs-5"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 12px; background: #ffffff;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-semibold d-block" style="font-size: 0.78rem;">Skema Komersil</span>
                        <h4 class="fw-bold text-primary mb-0 mt-1">{{ $komersilRules }}</h4>
                    </div>
                    <div class="rounded-circle bg-primary bg-opacity-10 p-2 text-primary d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                        <i class="mdi mdi-office-building fs-5"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 12px; background: #ffffff;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-semibold d-block" style="font-size: 0.78rem;">Skema Subsidi</span>
                        <h4 class="fw-bold text-info mb-0 mt-1">{{ $subsidiRules }}</h4>
                    </div>
                    <div class="rounded-circle bg-info bg-opacity-10 p-2 text-info d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                        <i class="mdi mdi-home-heart fs-5"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Table Card -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0" style="border-radius: 12px; overflow: hidden;">
                <div class="card-header bg-white d-flex justify-content-between align-items-center flex-wrap gap-2 py-3 px-3 px-md-4">
                    <h5 class="card-title mb-0 fw-bold text-nowrap" style="font-size: 1.05rem; color: #2c2e3f;">
                        Daftar Aturan Komisi
                    </h5>
                    <div class="d-flex align-items-center gap-2 flex-wrap ms-auto">
                        <a href="{{ route('marketing.jual-unit') }}" class="btn btn-sm btn-catalog-unit shadow-sm" title="Buka Halaman Catalog Unit">
                            <i class="mdi mdi-home-city-outline fs-6"></i>
                            <span>Buka Catalog Unit</span>
                        </a>
                        <button type="button" class="btn btn-sm btn-gradient-primary d-inline-flex align-items-center gap-1.5 shadow-sm px-3 py-2" onclick="openModalRule('tambah')" style="border-radius: 8px; font-weight: 700; font-size: 0.85rem;">
                            <i class="mdi mdi-plus-circle" style="font-size: 1rem;"></i>
                            <span>Tambah Aturan</span>
                        </button>
                    </div>
                </div>

                <div class="card-body p-3 p-md-4">
                    <!-- Filter Section (Matching Master Data Bank with Live Search Select2) -->
                    <div class="filter-card mb-3">
                        <!-- Desktop Version -->
                        <div class="filter-row-desktop d-none d-md-block">
                            <form id="filterForm" method="GET" action="{{ route('marketing.commission-rules.index') }}" onsubmit="return showFilterLoading()">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                    <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                        <!-- Search Input -->
                                        <div style="min-width: 220px; max-width: 300px; flex: 1;">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="search" id="searchInput"
                                                    placeholder="Cari nama aturan..."
                                                    value="{{ request('search') }}"
                                                    style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                                <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                    type="submit" title="Cari"
                                                    style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                    <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Target Type Filter -->
                                        <div style="width: 145px;">
                                            <select class="form-select" name="target_type" id="targetTypeSelect">
                                                <option value="">Semua Jenis</option>
                                                <option value="komersil" {{ request('target_type') == 'komersil' ? 'selected' : '' }}>Komersil</option>
                                                <option value="subsidi" {{ request('target_type') == 'subsidi' ? 'selected' : '' }}>Subsidi</option>
                                                <option value="all" {{ request('target_type') == 'all' ? 'selected' : '' }}>Semua Unit</option>
                                            </select>
                                        </div>

                                        <!-- Land Bank / Proyek Filter (Live Search Select2) -->
                                        <div style="min-width: 200px; max-width: 260px; flex: 1;">
                                            <select class="form-select select2-filter-project" name="land_bank_id" id="landBankSelect" style="width: 100%;">
                                                <option value="">Semua Proyek</option>
                                                @foreach ($projects as $prj)
                                                    <option value="{{ $prj->id }}" {{ request('land_bank_id') == $prj->id ? 'selected' : '' }}>{{ $prj->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Right Buttons -->
                                    <div class="d-flex align-items-center gap-2 ms-auto">
                                        <button type="submit" class="btn btn-gradient-primary btn-icon-only" title="Filter">
                                            <i class="mdi mdi-filter"></i>
                                        </button>
                                        <a href="{{ route('marketing.commission-rules.index') }}" class="btn btn-gradient-secondary btn-icon-only" title="Reset" onclick="showResetLoading(event)">
                                            <i class="mdi mdi-refresh"></i>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Mobile Version -->
                        <div class="filter-row-mobile d-block d-md-none">
                            <form method="GET" action="{{ route('marketing.commission-rules.index') }}" onsubmit="return showFilterLoading()">
                                <div class="row g-2">
                                    <div class="col-12 mb-2">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" id="searchInputMobile"
                                                placeholder="Cari nama aturan..."
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
                                        <select class="form-select" name="target_type" id="targetTypeSelectMobile">
                                            <option value="">Semua Jenis Unit</option>
                                            <option value="komersil" {{ request('target_type') == 'komersil' ? 'selected' : '' }}>Komersil</option>
                                            <option value="subsidi" {{ request('target_type') == 'subsidi' ? 'selected' : '' }}>Subsidi</option>
                                            <option value="all" {{ request('target_type') == 'all' ? 'selected' : '' }}>Semua Unit</option>
                                        </select>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <select class="form-select select2-filter-project" name="land_bank_id" id="landBankSelectMobile" style="width: 100%;">
                                            <option value="">Semua Proyek</option>
                                            @foreach ($projects as $prj)
                                                <option value="{{ $prj->id }}" {{ request('land_bank_id') == $prj->id ? 'selected' : '' }}>{{ $prj->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-6">
                                        <button type="submit" class="btn btn-gradient-primary w-100 d-flex align-items-center justify-content-center gap-1" style="height: 38px;">
                                            <i class="mdi mdi-filter"></i> Filter
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('marketing.commission-rules.index') }}" class="btn btn-gradient-secondary w-100 d-flex align-items-center justify-content-center gap-1" style="height: 38px;" onclick="showResetLoading(event)">
                                            <i class="mdi mdi-refresh"></i> Reset
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Tabel Data Aturan Komisi -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                                    <th class="text-center" style="width: 50px; color: #334155; font-weight: 800; font-size: 0.82rem;">NO</th>
                                    <th style="color: #334155; font-weight: 800; font-size: 0.82rem;">NAMA ATURAN & DESKRIPSI</th>
                                    <th style="color: #334155; font-weight: 800; font-size: 0.82rem;">TARGET PROYEK</th>
                                    <th style="color: #334155; font-weight: 800; font-size: 0.82rem;">TARGET UNIT</th>
                                    <th style="color: #334155; font-weight: 800; font-size: 0.82rem;">SKEMA KOMISI</th>
                                    <th class="text-center" style="width: 100px; color: #334155; font-weight: 800; font-size: 0.82rem;">STATUS</th>
                                    <th class="text-center" style="width: 100px; color: #334155; font-weight: 800; font-size: 0.82rem;">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($commissionRules as $rule)
                                    <tr id="page_rule_row_{{ $rule->id }}">
                                        <td class="text-center fw-bold text-muted" style="font-size: 0.85rem;">{{ $loop->iteration }}</td>
                                        <td>
                                            <span class="fw-bold text-dark d-block" style="font-size: 0.92rem;">{{ $rule->name }}</span>
                                            @if($rule->description)
                                                <small class="text-muted" style="font-size: 0.78rem;">{{ $rule->description }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            @if($rule->land_bank_id)
                                                <span class="badge" style="background: #e0f2fe !important; color: #0369a1 !important; border: 1px solid #bae6fd; font-weight: 700; font-size: 0.78rem; padding: 4px 8px; border-radius: 6px;">
                                                    <i class="mdi mdi-office-building me-1"></i>{{ $rule->landBank->name ?? '-' }}
                                                </span>
                                            @else
                                                <span class="badge" style="background: #f1f5f9 !important; color: #475569 !important; border: 1px solid #cbd5e1; font-weight: 700; font-size: 0.78rem; padding: 4px 8px; border-radius: 6px;">
                                                    <i class="mdi mdi-earth me-1"></i>Semua Proyek
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($rule->target_type === 'komersil')
                                                <span class="badge" style="background: #ede9fe !important; color: #6d28d9 !important; border: 1px solid #ddd6fe; font-weight: 700; font-size: 0.78rem; padding: 4px 8px; border-radius: 6px;">Komersil</span>
                                            @elseif($rule->target_type === 'subsidi')
                                                <span class="badge" style="background: #ecfdf5 !important; color: #047857 !important; border: 1px solid #a7f3d0; font-weight: 700; font-size: 0.78rem; padding: 4px 8px; border-radius: 6px;">Subsidi</span>
                                            @else
                                                <span class="badge" style="background: #f1f5f9 !important; color: #334155 !important; border: 1px solid #cbd5e1; font-weight: 700; font-size: 0.78rem; padding: 4px 8px; border-radius: 6px;">Semua Unit</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($rule->calculation_type === 'percentage')
                                                <span class="fw-bold text-primary" style="font-size: 0.92rem;">{{ floatval($rule->value) }}%</span>
                                                <small class="text-muted d-block" style="font-size: 0.74rem;">dari Harga Jual</small>
                                            @else
                                                <span class="fw-bold text-success" style="font-size: 0.92rem;">Rp {{ number_format($rule->value, 0, ',', '.') }}</span>
                                                <small class="text-muted d-block" style="font-size: 0.74rem;">Nominal Flat per Unit</small>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-switch d-inline-block m-0">
                                                <input class="form-check-input switch-page-rule-status" type="checkbox" role="switch"
                                                    data-id="{{ $rule->id }}" {{ $rule->is_active ? 'checked' : '' }} style="cursor: pointer; width: 36px; height: 18px;">
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-inline-flex align-items-center gap-1">
                                                <button type="button" class="btn-action edit" title="Edit Aturan" onclick="openModalRule('edit', {{ $rule->id }})">
                                                    <i class="mdi mdi-pencil"></i>
                                                </button>
                                                <button type="button" class="btn-action delete" title="Hapus Aturan" onclick="confirmDeleteRule({{ $rule->id }})">
                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">
                                            <i class="mdi mdi-cash-off me-2" style="font-size: 1.5rem;"></i>
                                            Belum ada aturan komisi yang terdaftar.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>

                <!-- Live Simulator Footer Box (Fully Responsive) -->
                <div class="card-footer bg-light p-3 p-md-4 border-top">
                    <div class="row align-items-center g-3">
                        <div class="col-12 col-lg-4">
                            <div class="d-flex align-items-center gap-2">
                                <div class="rounded-circle bg-success bg-opacity-10 p-2 text-success d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                    <i class="mdi mdi-calculator fs-5"></i>
                                </div>
                                <div>
                                    <span class="fw-bold text-dark d-block small">Simulasi Kalkulator Komisi Live</span>
                                    <small class="text-muted" style="font-size: 0.74rem;">Uji coba perhitungan komisi sesuai formula aturan</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="input-group">
                                <span class="input-group-text bg-white small">Rp</span>
                                <input type="text" class="form-control rupiah-format" id="page_sim_price" value="200.000.000" placeholder="200.000.000" style="height: 38px; font-size: 0.88rem;">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-2">
                            <select class="form-select" id="page_sim_jenis" style="height: 38px; font-size: 0.88rem;">
                                <option value="komersil">Komersil</option>
                                <option value="subsidi">Subsidi</option>
                            </select>
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="p-2 px-3 rounded-3 bg-white border text-center text-lg-end">
                                <small class="text-muted d-block" style="font-size: 0.72rem;">Hasil Komisi:</small>
                                <span class="fw-bold text-success" id="page_sim_result" style="font-size: 1.05rem;">Rp 5.000.000</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modal Tambah / Edit Aturan Komisi (Matching Master Data Bank with Select2 Search) -->
<div class="modal fade" id="modalRule" tabindex="-1" aria-labelledby="modalRuleLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-custom-compact">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
            <div class="modal-header bg-white border-bottom py-3 px-4 d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="modal-title fw-bold text-dark mb-0" id="modalRuleLabel" style="font-size: 1.05rem;">
                        <i class="mdi mdi-plus-circle me-2" id="modalRuleIcon" style="color: #9a55ff;"></i>
                        <span id="modalRuleTitle">Tambah Aturan Komisi</span>
                    </h5>
                    <small class="text-muted" style="font-size: 0.78rem;">Tentukan target unit, proyek, dan metode perhitungan fee komisi</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formMasterCommissionRule">
                @csrf
                <input type="hidden" id="m_rule_id" name="rule_id" value="">

                <div class="modal-body p-3 p-md-4" style="background: #f8fafc;">
                    <!-- Nama Aturan -->
                    <div class="form-group mb-3">
                        <label class="form-label fw-bold small text-dark mb-1">Nama Aturan Komisi <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="m_rule_name" name="name" placeholder="Contoh: Komisi Komersil 2.5%" required>
                    </div>

                    <!-- Target Proyek (Live Search Select2) -->
                    <div class="form-group mb-3">
                        <label class="form-label fw-bold small text-dark mb-1">Target Proyek</label>
                        <select class="form-select" id="m_rule_land_bank_id" name="land_bank_id" style="width: 100%;">
                            <option value="">-- Berlaku untuk Semua Proyek --</option>
                            @foreach ($projects as $prj)
                                <option value="{{ $prj->id }}">{{ $prj->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Target Jenis Unit -->
                    <div class="form-group mb-3">
                        <label class="form-label fw-bold small text-dark mb-1">Target Jenis Unit <span class="text-danger">*</span></label>
                        <select class="form-select" id="m_rule_target_type" name="target_type" required>
                            <option value="all">Semua Jenis Unit</option>
                            <option value="komersil">Khusus Komersil</option>
                            <option value="subsidi">Khusus Subsidi</option>
                        </select>
                    </div>

                    <!-- Metode Komisi -->
                    <div class="form-group mb-3">
                        <label class="form-label fw-bold small text-dark mb-1">Metode Komisi <span class="text-danger">*</span></label>
                        <select class="form-select" id="m_rule_calculation_type" name="calculation_type" required>
                            <option value="percentage">Persentase (% dari Harga Jual)</option>
                            <option value="fixed">Nominal Tetap (Flat Rp per Unit)</option>
                        </select>
                    </div>

                    <!-- Nilai Komisi -->
                    <div class="form-group mb-3">
                        <label class="form-label fw-bold small text-dark mb-1" id="m_rule_value_label">Nilai Komisi (%) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text fw-bold text-primary" id="m_rule_value_prefix" style="height: 42px; font-size: 0.88rem;">%</span>
                            <input type="number" step="any" min="0" class="form-control" id="m_rule_value" name="value" placeholder="Contoh: 2.5" required>
                        </div>
                    </div>

                    <!-- Keterangan -->
                    <div class="form-group mb-0">
                        <label class="form-label fw-bold small text-dark mb-1">Deskripsi / Keterangan</label>
                        <textarea class="form-control" id="m_rule_description" name="description" rows="2" placeholder="Catatan aturan komisi (opsional)"></textarea>
                    </div>
                </div>

                <div class="modal-footer bg-white border-top py-2.5 px-4 d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-sm btn-light border px-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-gradient-primary px-4 fw-bold" id="btnSubmitModalRule">
                        <i class="mdi mdi-content-save me-1" id="btnIconModalRule"></i><span id="btnTextModalRule">Simpan Aturan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Inisialisasi Data Aturan Komisi
    window.commissionRules = @json($commissionRules);

    // Fungsi Hitung Komisi Agent Otomatis Client-side
    window.calculateAgentFee = function(price, jenis, landBankId) {
        const unitPrice = parseFloat(String(price).replace(/[^0-9.]/g, '')) || 0;
        const cleanJenis = String(jenis || 'komersil').toLowerCase().trim();
        const rules = window.commissionRules || [];

        // Filter aturan yang aktif
        const activeRules = rules.filter(r => r.is_active == 1 || r.is_active === true);

        let matched = null;

        // 1. Coba aturan spesifik proyek & spesifik jenis
        matched = activeRules.find(r => {
            if (r.land_bank_id && r.land_bank_id == landBankId && r.target_type === cleanJenis) {
                if (r.min_price && unitPrice < parseFloat(r.min_price)) return false;
                if (r.max_price && unitPrice > parseFloat(r.max_price)) return false;
                return true;
            }
            return false;
        });

        // 2. Coba aturan spesifik proyek & target all
        if (!matched) {
            matched = activeRules.find(r => {
                if (r.land_bank_id && r.land_bank_id == landBankId && r.target_type === 'all') {
                    if (r.min_price && unitPrice < parseFloat(r.min_price)) return false;
                    if (r.max_price && unitPrice > parseFloat(r.max_price)) return false;
                    return true;
                }
                return false;
            });
        }

        // 3. Coba aturan global spesifik jenis
        if (!matched) {
            matched = activeRules.find(r => {
                if (!r.land_bank_id && r.target_type === cleanJenis) {
                    if (r.min_price && unitPrice < parseFloat(r.min_price)) return false;
                    if (r.max_price && unitPrice > parseFloat(r.max_price)) return false;
                    return true;
                }
                return false;
            });
        }

        // 4. Coba aturan global target all
        if (!matched) {
            matched = activeRules.find(r => {
                if (!r.land_bank_id && r.target_type === 'all') {
                    if (r.min_price && unitPrice < parseFloat(r.min_price)) return false;
                    if (r.max_price && unitPrice > parseFloat(r.max_price)) return false;
                    return true;
                }
                return false;
            });
        }

        if (!matched) {
            if (cleanJenis === 'subsidi') {
                return { fee: 3500000, ruleName: 'Default Subsidi Flat', formula: 'Nominal Flat Rp 3.500.000' };
            } else {
                const calculated = Math.round((unitPrice * 2.5) / 100);
                return { fee: calculated, ruleName: 'Default Komersil (2.5%)', formula: '2.5% dari Harga Jual (Rp ' + new Intl.NumberFormat('id-ID').format(calculated) + ')' };
            }
        }

        let fee = 0;
        const val = parseFloat(matched.value) || 0;
        if (matched.calculation_type === 'percentage') {
            fee = Math.round((unitPrice * val) / 100);
        } else {
            fee = Math.round(val);
        }

        return { fee: fee, ruleName: matched.name, ruleId: matched.id };
    };

    function initSelect2Elements() {
        if (window.jQuery && $.fn.select2) {
            // Modal Select2
            $('#m_rule_land_bank_id').select2({
                theme: 'bootstrap-5',
                dropdownParent: $('#modalRule'),
                placeholder: '-- Berlaku untuk Semua Proyek --',
                allowClear: true,
                width: '100%'
            });

            // Filter Desktop Select2
            $('#landBankSelect').select2({
                theme: 'bootstrap-5',
                placeholder: 'Semua Proyek',
                allowClear: true,
                width: '100%'
            });

            // Filter Mobile Select2
            $('#landBankSelectMobile').select2({
                theme: 'bootstrap-5',
                placeholder: 'Semua Proyek',
                allowClear: true,
                width: '100%'
            });
        }
    }

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

    function openModalRule(type, id = null) {
        if (type === 'tambah') {
            $('#formMasterCommissionRule')[0].reset();
            $('#m_rule_id').val('');
            $('#m_rule_land_bank_id').val('').trigger('change');
            $('#m_rule_calculation_type').val('percentage').trigger('change');
            $('#modalRuleTitle').text('Tambah Aturan Komisi');
            $('#modalRuleIcon').removeClass('mdi-pencil').addClass('mdi-plus-circle');
            $('#btnTextModalRule').text('Simpan Aturan');
            $('#btnIconModalRule').removeClass('mdi-pencil').addClass('mdi-content-save');
            $('#modalRule').modal('show');
        } else {
            let rule = window.commissionRules.find(r => r.id == id);
            if (!rule) {
                Swal.fire({ icon: 'error', title: 'Gagal', text: 'Data aturan tidak ditemukan' });
                return;
            }

            $('#m_rule_id').val(rule.id);
            $('#m_rule_name').val(rule.name);
            $('#m_rule_land_bank_id').val(rule.land_bank_id || '').trigger('change');
            $('#m_rule_target_type').val(rule.target_type);
            $('#m_rule_calculation_type').val(rule.calculation_type).trigger('change');
            $('#m_rule_value').val(parseFloat(rule.value));
            $('#m_rule_description').val(rule.description || '');

            $('#modalRuleTitle').text('Edit Aturan Komisi');
            $('#modalRuleIcon').removeClass('mdi-plus-circle').addClass('mdi-pencil');
            $('#btnTextModalRule').text('Update Aturan');
            $('#btnIconModalRule').removeClass('mdi-content-save').addClass('mdi-pencil');
            $('#modalRule').modal('show');
        }
    }

    function confirmDeleteRule(id) {
        Swal.fire({
            title: 'Hapus Aturan Komisi?',
            text: 'Aturan ini akan dihapus dan tidak digunakan lagi untuk perhitungan otomatis komisi!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ url('marketing/commission-rules') }}/" + id,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function(res) {
                        $('#page_rule_row_' + id).fadeOut(300, function() { $(this).remove(); });
                        window.commissionRules = window.commissionRules.filter(r => r.id != id);
                        $('#stat_total').text(window.commissionRules.length);
                        let activeCount = window.commissionRules.filter(r => r.is_active == 1 || r.is_active === true).length;
                        $('#stat_active').text(activeCount);

                        Swal.fire({
                            icon: 'success',
                            title: 'Terhapus!',
                            text: res.message || 'Aturan komisi berhasil dihapus',
                            timer: 1500,
                            showConfirmButton: false
                        });
                    },
                    error: function() {
                        Swal.fire({ icon: 'error', title: 'Gagal', text: 'Gagal menghapus aturan komisi' });
                    }
                });
            }
        });
    }

    $(document).ready(function() {
        initSelect2Elements();

        $('#modalRule').on('shown.bs.modal', function() {
            initSelect2Elements();
        });

        // Toggle prefix % vs Rp
        $('#m_rule_calculation_type').on('change', function() {
            const val = $(this).val();
            if (val === 'percentage') {
                $('#m_rule_value_label').html('Nilai Komisi (%) <span class="text-danger">*</span>');
                $('#m_rule_value_prefix').text('%');
                $('#m_rule_value').attr('placeholder', 'Contoh: 2.5');
            } else {
                $('#m_rule_value_label').html('Nilai Komisi Flat (Rp) <span class="text-danger">*</span>');
                $('#m_rule_value_prefix').text('Rp');
                $('#m_rule_value').attr('placeholder', 'Contoh: 4000000');
            }
        });

        // Submit Form Modal (AJAX)
        $('#formMasterCommissionRule').on('submit', function(e) {
            e.preventDefault();
            let ruleId = $('#m_rule_id').val();
            let isEdit = !!ruleId;
            let url = isEdit 
                ? "{{ url('marketing/commission-rules') }}/" + ruleId
                : "{{ route('marketing.commission-rules.store') }}";
            let method = isEdit ? 'PUT' : 'POST';

            let data = {
                _token: '{{ csrf_token() }}',
                name: $('#m_rule_name').val(),
                land_bank_id: $('#m_rule_land_bank_id').val() || null,
                target_type: $('#m_rule_target_type').val(),
                calculation_type: $('#m_rule_calculation_type').val(),
                value: $('#m_rule_value').val(),
                description: $('#m_rule_description').val()
            };

            let $btn = $('#btnSubmitModalRule');
            let origHtml = $btn.html();
            $btn.prop('disabled', true).html('<i class="mdi mdi-loading mdi-spin me-1"></i>Menyimpan...');

            $.ajax({
                url: url,
                type: method,
                data: data,
                success: function(res) {
                    $btn.prop('disabled', false).html(origHtml);
                    if (res.success) {
                        $('#modalRule').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: res.message || 'Aturan komisi berhasil disimpan',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => location.reload());
                    }
                },
                error: function(xhr) {
                    $btn.prop('disabled', false).html(origHtml);
                    let errMsg = 'Terjadi kesalahan saat menyimpan aturan';
                    if (xhr.responseJSON && xhr.responseJSON.message) errMsg = xhr.responseJSON.message;
                    else if (xhr.responseJSON && xhr.responseJSON.errors) errMsg = Object.values(xhr.responseJSON.errors).join('\n');
                    Swal.fire({ icon: 'error', title: 'Gagal', text: errMsg });
                }
            });
        });

        // Toggle Switch Status Aktif / Non-Aktif
        $(document).on('change', '.switch-page-rule-status', function() {
            let id = $(this).data('id');

            $.ajax({
                url: "{{ url('marketing/commission-rules') }}/" + id + "/toggle",
                type: 'POST',
                data: { _token: '{{ csrf_token() }}' },
                success: function(res) {
                    let found = window.commissionRules.find(r => r.id == id);
                    if (found) found.is_active = res.is_active;

                    let activeCount = window.commissionRules.filter(r => r.is_active == 1 || r.is_active === true).length;
                    $('#stat_active').text(activeCount);

                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: res.message || 'Status aturan berhasil diubah',
                        showConfirmButton: false,
                        timer: 1500
                    });
                },
                error: function() {
                    Swal.fire({ icon: 'error', title: 'Gagal', text: 'Gagal mengubah status aturan komisi' });
                }
            });
        });

        // Live Simulator Keyup / Change
        $('#page_sim_price, #page_sim_jenis').on('input change keyup', function() {
            let rawPrice = $('#page_sim_price').val().replace(/\./g, '').replace(/,/g, '').trim();
            let p = parseFloat(rawPrice) || 0;
            let j = $('#page_sim_jenis').val();
            let calc = window.calculateAgentFee(p, j, null);
            $('#page_sim_result').text('Rp ' + new Intl.NumberFormat('id-ID').format(calc.fee));
        });

        // Format Rupiah Input
        $('.rupiah-format').on('input', function() {
            let value = $(this).val().replace(/[^0-9]/g, '');
            if (value) $(this).val(new Intl.NumberFormat('id-ID').format(value));
            else $(this).val('');
        });
    });
</script>
@endpush
