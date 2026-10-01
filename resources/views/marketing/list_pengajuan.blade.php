@extends('layouts.partial.app')

@section('title', 'Customer Booking - Properti Management')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-clean.css') }}?v={{ time() }}">
@endpush

@section('content')

    <style>
        /* ===== COMPACT TABLE CARD PERSIS CATALOG UNIT / PERIZINAN ===== */
        .compact-table-card {
            background: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 8px !important;
            box-shadow: none !important;
            transition: border-color 0.2s ease;
            overflow: hidden;
        }
        .compact-table-card:hover {
            border-color: #cbd5e1 !important;
            box-shadow: none !important;
        }

        .booking-id {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            color: #9a55ff;
            font-weight: 700;
            font-size: 0.85rem;
        }

        .booking-id i {
            font-size: 1.05rem;
        }

        /* Badge Styling - Solid 1 Warna, Tanpa Gradient, 6px Border Radius */
        .badge, 
        .table .badge,
        .table tbody td .badge,
        .badge-method, 
        .badge-status,
        .badge-gradient-success, 
        .badge-gradient-primary, 
        .badge-gradient-secondary {
            border-radius: 6px !important;
            padding: 0.35rem 0.65rem !important;
            font-size: 0.76rem !important;
            font-weight: 700 !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 0.35rem !important;
            white-space: nowrap !important;
            line-height: 1.3 !important;
        }

        .badge-gradient-success {
            background: #10b981 !important;
            background-image: none !important;
            color: #ffffff !important;
        }

        .badge-gradient-primary {
            background: #0284c7 !important;
            background-image: none !important;
            color: #ffffff !important;
        }

        .badge-gradient-secondary {
            background: #64748b !important;
            background-image: none !important;
            color: #ffffff !important;
        }

        /* Badge Method */
        .badge-method {
            background-image: none !important;
        }

        .badge-method.kpr {
            background: #0284c7 !important;
            color: #ffffff !important;
        }

        .badge-method.cash {
            background: #10b981 !important;
            color: #ffffff !important;
        }

        .badge-method.cash-tempo {
            background: #f59e0b !important;
            color: #ffffff !important;
        }

        /* Badge Soft (Status) */
        .badge-status {
            background-image: none !important;
        }

        .badge-status.booking,
        .badge-status.draft {
            background: #f1f5f9 !important;
            color: #475569 !important;
            border: 1px solid #cbd5e1 !important;
        }

        .badge-status.diproses,
        .badge-status.review {
            background: #eff6ff !important;
            color: #1d4ed8 !important;
            border: 1px solid #bfdbfe !important;
        }

        .badge-status.aktif {
            background: #ecfdf5 !important;
            color: #059669 !important;
            border: 1px solid #a7f3d0 !important;
        }

        .badge-status.pending {
            background: #fef2f2 !important;
            color: #dc2626 !important;
            border: 1px solid #fecaca !important;
        }

        .badge-status.complete {
            background: #f0fdf4 !important;
            color: #15803d !important;
            border: 1px solid #bbf7d0 !important;
        }

        /* Progress Bar (Sesuai Catalog Unit) */
        .progress-wrapper {
            min-width: 140px;
        }

        .progress-row {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .progress {
            flex: 1;
            height: 8px;
            border-radius: 4px;
            background: #edf0f5;
            overflow: hidden;
            margin-bottom: 0;
        }

        .progress-bar-custom {
            height: 100%;
            border-radius: 4px;
            transition: width 0.4s ease;
        }

        .progress-green {
            background: #9a55ff;
        }

        .progress-dark-green {
            background: #10b981;
        }

        .progress-percent {
            min-width: 36px;
            text-align: right;
            font-size: 0.78rem;
            font-weight: 700;
            color: #64748b;
        }

        /* Action Buttons (Solid 1 Warna, 6px Border Radius) */
        .btn-action {
            width: 32px;
            height: 32px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            margin: 0 2px;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .btn-action.method-kpr {
            background: #0284c7;
            color: #fff;
        }

        .btn-action.method-cash {
            background: #10b981;
            color: #fff;
        }

        .btn-action.method-cash-tempo {
            background: #f59e0b;
            color: #fff;
        }

        .btn-action.method-complete {
            background: #059669;
            color: #fff;
        }

        .btn-action.delete {
            background: #ef4444;
            color: #fff;
        }

        .btn-action:hover {
            opacity: 0.88;
            transform: translateY(-1px);
        }

        /* Table Sesuai Catalog Unit */
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0;
        }

        .table thead th {
            background: #f8fafc;
            color: #9a55ff;
            font-weight: 700;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e2e8f0;
            padding: 0.85rem 0.65rem;
            white-space: nowrap;
        }

        .table thead th i {
            font-size: 0.82rem;
            margin-left: 3px;
        }

        .table thead th.active-sort {
            color: #7a3fcc;
        }

        .table tbody td {
            vertical-align: middle;
            font-size: 0.85rem;
            padding: 0.8rem 0.65rem;
            border-bottom: 1px solid #f1f5f9;
            color: #2c2e3f;
            white-space: nowrap;
        }

        .table tbody tr:hover td {
            background-color: #fcfaff;
        }

        /* Select2 Theme Alignment */
        .select2-container--bootstrap-5 .select2-selection {
            min-height: 38px !important;
            height: 38px !important;
            padding: 0.375rem 0.75rem !important;
            display: flex !important;
            align-items: center !important;
            border-color: #ebedf2 !important;
            border-radius: 6px !important;
            font-size: 0.875rem !important;
            background-color: #ffffff !important;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        .select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
            line-height: 1.5 !important;
            padding-left: 0 !important;
            color: #3b3f5c !important;
        }
        .select2-container--bootstrap-5.select2-container--focus .select2-selection,
        .select2-container--bootstrap-5.select2-container--open .select2-selection {
            border-color: #bfa5fa !important;
            box-shadow: 0 0 0 0.2rem rgba(154, 85, 255, 0.12) !important;
        }

        /* Select2 Dropdown Options Soft Hover & Active */
        .select2-container--bootstrap-5 .select2-dropdown {
            border: 1px solid #e2e8f0 !important;
            border-radius: 8px !important;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08) !important;
            overflow: hidden !important;
            z-index: 1050 !important;
        }
        .select2-container--bootstrap-5 .select2-results__option {
            padding: 0.45rem 0.85rem !important;
            font-size: 0.85rem !important;
            color: #3b3f5c !important;
            transition: background-color 0.15s ease, color 0.15s ease;
        }
        /* Hover / Highlighted (Soft Pastel Tint) */
        .select2-container--bootstrap-5 .select2-results__option--highlighted,
        .select2-container--bootstrap-5 .select2-results__option--highlighted.select2-results__option--selectable {
            background-color: #f6f1ff !important;
            color: #792fe0 !important;
        }
        /* Active / Selected (Soft Purple Tint) */
        .select2-container--bootstrap-5 .select2-results__option[aria-selected="true"],
        .select2-container--bootstrap-5 .select2-results__option--selected {
            background-color: #eee4ff !important;
            color: #6b21a8 !important;
            font-weight: 600 !important;
        }
        .select2-container--bootstrap-5 .select2-results__option--selected.select2-results__option--highlighted {
            background-color: #e4d3fe !important;
            color: #581c87 !important;
        }
    </style>

    <div class="container-fluid px-2 px-md-4 py-3">

        <!-- Page Title & Subtitle (Tanpa Card Persis Catalog Unit / Perizinan) -->
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
            <div>
                <h2 class="text-dark mb-1 fw-bold" style="font-size: 1.55rem; letter-spacing: -0.02em;">
                    Customer Booking
                </h2>
                <p class="text-muted mb-0" style="font-size: 0.88rem;">
                    Monitoring semua pengajuan KPR dan Cash
                </p>
            </div>
        </div>

        <!-- 4 KPI Metrics Card Grid (UI Card Sesuai Catalog Unit - 1 Warna Solid, Tanpa Gradient) -->
        <div class="dash-kpi-grid mb-4">
            <!-- Card 1: Total Pengajuan (Ungu Solid) -->
            <div class="dash-kpi-card">
                <div class="dash-kpi-left">
                    <div class="dash-kpi-icon purple">
                        <i class="mdi mdi-file-document-multiple-outline"></i>
                    </div>
                    <div class="dash-kpi-info">
                        <div class="dash-kpi-label">Total Pengajuan</div>
                        <div class="dash-kpi-val">{{ $totalPengajuan ?? ($bookings->total() ?? $bookings->count()) }}</div>
                        <div class="dash-kpi-sub">Seluruh Booking Masuk</div>
                    </div>
                </div>
            </div>

            <!-- Card 2: KPR Diproses (Biru Solid) -->
            <div class="dash-kpi-card">
                <div class="dash-kpi-left">
                    <div class="dash-kpi-icon blue">
                        <i class="mdi mdi-bank-outline"></i>
                    </div>
                    <div class="dash-kpi-info">
                        <div class="dash-kpi-label">KPR Diproses</div>
                        <div class="dash-kpi-val">{{ $totalKpr ?? 0 }}</div>
                        <div class="dash-kpi-sub">Pengajuan Bank KPR</div>
                    </div>
                </div>
            </div>

            <!-- Card 3: Cash / Tempo (Amber / Kuning Solid) -->
            <div class="dash-kpi-card">
                <div class="dash-kpi-left">
                    <div class="dash-kpi-icon amber">
                        <i class="mdi mdi-cash-multiple"></i>
                    </div>
                    <div class="dash-kpi-info">
                        <div class="dash-kpi-label">Cash / Tempo</div>
                        <div class="dash-kpi-val">{{ $totalCash ?? 0 }}</div>
                        <div class="dash-kpi-sub">Pembelian Tunai</div>
                    </div>
                </div>
            </div>

            <!-- Card 4: Complete (Hijau Solid) -->
            <div class="dash-kpi-card">
                <div class="dash-kpi-left">
                    <div class="dash-kpi-icon green">
                        <i class="mdi mdi-check-decagram-outline"></i>
                    </div>
                    <div class="dash-kpi-info">
                        <div class="dash-kpi-label">Complete</div>
                        <div class="dash-kpi-val">{{ $totalLunas ?? 0 }}</div>
                        <div class="dash-kpi-sub">Transaksi Selesai</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-2 mt-sm-2 mt-md-3">
            <div class="col-12">
                <div class="card compact-table-card" style="background: #ffffff !important; border: 1px solid #e2e8f0 !important; border-radius: 8px !important; box-shadow: none !important;">
                    <div class="card-header bg-white d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center py-2.5 px-3 px-md-4 gap-2" style="border-bottom: 1px solid #e2e8f0 !important;">
                        <div class="d-flex align-items-center gap-2">
                            <div style="width: 32px; height: 32px; border-radius: 6px; background-color: #f3e8ff; color: #9333ea; display: inline-flex; align-items: center; justify-content: center; font-size: 1.15rem; flex-shrink: 0;">
                                <i class="mdi mdi-format-list-bulleted"></i>
                            </div>
                            <span style="font-size: 0.95rem; font-weight: 700; color: #0f172a;">Daftar Pengajuan</span>
                        </div>

                        <div class="d-flex flex-wrap align-items-center gap-2">
                            <button type="button" class="btn btn-sm d-inline-flex align-items-center gap-1 px-3 text-white fw-semibold" style="height: 32px; border-radius: 6px; background-color: #10b981; border: 1px solid #10b981;" onclick="handleImport()">
                                <i class="mdi mdi-upload"></i>
                                <span>Import</span>
                            </button>
                            <button type="button" class="btn btn-sm d-inline-flex align-items-center gap-1 px-3 text-white fw-semibold" style="height: 32px; border-radius: 6px; background-color: #9a55ff; border: 1px solid #9a55ff;" onclick="handleExport()">
                                <i class="mdi mdi-download"></i>
                                <span>Export</span>
                            </button>
                        </div>
                    </div>

                    <div class="card-body p-3 p-md-4">
                        <!-- Filter Section -->
                        <div class="filter-card mb-3">
                            <!-- DESKTOP VERSION -->
                            <div class="filter-row-desktop d-none d-md-block">
                                <form id="filterForm" method="GET" action="{{ url('marketing/list-pengajuan') }}">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                        <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                            <!-- Search Input -->
                                            <div style="min-width: 220px; max-width: 280px; flex: 1;">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="search" id="searchInput"
                                                        placeholder="Cari ID, nama, unit..." value="{{ request('search') }}"
                                                        style="border-top-left-radius: 6px !important; border-bottom-left-radius: 6px !important; border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none; height: 38px;">
                                                    <button class="btn d-flex align-items-center justify-content-center px-3" 
                                                        type="submit" title="Cari"
                                                        style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 6px !important; border-bottom-right-radius: 6px !important; height: 38px; box-shadow: none; background: #9a55ff !important; border: 1px solid #9a55ff !important; color: #fff;">
                                                        <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Status Dropdown -->
                                            <div style="width: 160px;">
                                                <select class="form-control select2" name="status" id="statusSelect" style="width: 100%;">
                                                    <option value="">Semua Status</option>
                                                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                                    <option value="pengajuan" {{ request('status') == 'pengajuan' ? 'selected' : '' }}>Pengajuan</option>
                                                    <option value="verifikasi" {{ request('status') == 'verifikasi' ? 'selected' : '' }}>Verifikasi</option>
                                                    <option value="survey" {{ request('status') == 'survey' ? 'selected' : '' }}>Survey</option>
                                                    <option value="lanjut_kpr" {{ request('status') == 'lanjut_kpr' ? 'selected' : '' }}>Lanjut KPR</option>
                                                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                                                    <option value="akad" {{ request('status') == 'akad' ? 'selected' : '' }}>Akad</option>
                                                    <option value="cash_process" {{ request('status') == 'cash_process' ? 'selected' : '' }}>Cash Process</option>
                                                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Complete</option>
                                                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Ditolak</option>
                                                </select>
                                            </div>

                                            <!-- Metode Dropdown -->
                                            <div style="width: 160px;">
                                                <select class="form-control select2" name="metode" id="metodeSelect" style="width: 100%;">
                                                    <option value="">Semua Metode</option>
                                                    <option value="kpr" {{ request('metode') == 'kpr' ? 'selected' : '' }}>KPR</option>
                                                    <option value="cash" {{ request('metode') == 'cash' ? 'selected' : '' }}>Cash</option>
                                                    <option value="cash_tempo" {{ request('metode') == 'cash_tempo' ? 'selected' : '' }}>Cash Tempo</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Right Side: Limit Dropdown + Filter & Reset Buttons -->
                                        <div class="d-flex align-items-center gap-2 ms-auto">
                                            <div style="width: 90px;">
                                                <select class="form-control select2" name="per_page" id="perPageSelect" style="width: 100%;">
                                                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                                    <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
                                                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn d-inline-flex align-items-center justify-content-center text-white"
                                                title="Filter" onclick="showFilterLoading()"
                                                style="width: 38px; height: 38px; border-radius: 6px; background: #9a55ff !important; border: 1px solid #9a55ff !important;">
                                                <i class="mdi mdi-filter"></i>
                                            </button>
                                            <a href="{{ url('marketing/list-pengajuan') }}" class="btn d-inline-flex align-items-center justify-content-center text-white"
                                                title="Reset" onclick="showResetLoading(event)"
                                                style="width: 38px; height: 38px; border-radius: 6px; background: #64748b !important; border: 1px solid #64748b !important;">
                                                <i class="mdi mdi-refresh"></i>
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- MOBILE VERSION -->
                            <div class="filter-row-mobile d-block d-md-none">
                                <form method="GET" action="{{ url('marketing/list-pengajuan') }}" id="filterFormMobile">
                                    <div class="row g-2">
                                        <div class="col-12 mb-2">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="search"
                                                    placeholder="Cari ID, nama, unit..." value="{{ request('search') }}"
                                                    style="border-top-left-radius: 6px !important; border-bottom-left-radius: 6px !important; border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none; height: 38px;">
                                                <button class="btn d-flex align-items-center justify-content-center px-3" 
                                                    type="submit" title="Cari"
                                                    style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 6px !important; border-bottom-right-radius: 6px !important; height: 38px; box-shadow: none; background: #9a55ff !important; border: 1px solid #9a55ff !important; color: #fff;">
                                                    <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <select class="form-control select2-mobile" name="status" id="statusSelectMobile" style="width: 100%;">
                                                <option value="">Semua Status</option>
                                                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                                <option value="pengajuan" {{ request('status') == 'pengajuan' ? 'selected' : '' }}>Pengajuan</option>
                                                <option value="verifikasi" {{ request('status') == 'verifikasi' ? 'selected' : '' }}>Verifikasi</option>
                                                <option value="survey" {{ request('status') == 'survey' ? 'selected' : '' }}>Survey</option>
                                                <option value="lanjut_kpr" {{ request('status') == 'lanjut_kpr' ? 'selected' : '' }}>Lanjut KPR</option>
                                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                                                <option value="akad" {{ request('status') == 'akad' ? 'selected' : '' }}>Akad</option>
                                                <option value="cash_process" {{ request('status') == 'cash_process' ? 'selected' : '' }}>Cash Process</option>
                                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Complete</option>
                                                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Ditolak</option>
                                            </select>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <select class="form-control select2-mobile" name="metode" id="metodeSelectMobile" style="width: 100%;">
                                                <option value="">Semua Metode</option>
                                                <option value="kpr" {{ request('metode') == 'kpr' ? 'selected' : '' }}>KPR</option>
                                                <option value="cash" {{ request('metode') == 'cash' ? 'selected' : '' }}>Cash</option>
                                                <option value="cash_tempo" {{ request('metode') == 'cash_tempo' ? 'selected' : '' }}>Cash Tempo</option>
                                            </select>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <select class="form-control select2-mobile" name="per_page" id="perPageSelectMobile" style="width: 100%;">
                                                <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                                <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
                                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                            </select>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <div class="d-flex gap-2">
                                                <button type="submit" class="btn d-inline-flex align-items-center justify-content-center text-white flex-fill"
                                                    title="Filter" onclick="showFilterLoading()"
                                                    style="height: 38px; border-radius: 6px; background: #9a55ff !important; border: 1px solid #9a55ff !important;">
                                                    <i class="mdi mdi-filter"></i>
                                                </button>
                                                <a href="{{ url('marketing/list-pengajuan') }}" class="btn d-inline-flex align-items-center justify-content-center text-white flex-fill"
                                                    title="Reset" onclick="showResetLoading(event)"
                                                    style="height: 38px; border-radius: 6px; background: #64748b !important; border: 1px solid #64748b !important;">
                                                    <i class="mdi mdi-refresh"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="sortable {{ request('sort') == 'id_booking' ? 'active-sort' : '' }}"
                                            data-field="id_booking"
                                            data-direction="{{ request('sort') == 'id_booking' ? (request('direction') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                            ID Booking
                                            @if (request('sort') == 'id_booking')
                                                <i
                                                    class="mdi mdi-{{ request('direction') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                            @else
                                                <i class="mdi mdi-swap-vertical"></i>
                                            @endif
                                        </th>
                                        <th class="sortable {{ request('sort') == 'name' ? 'active-sort' : '' }}"
                                            data-field="name"
                                            data-direction="{{ request('sort') == 'name' ? (request('direction') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                            Customer
                                            @if (request('sort') == 'name')
                                                <i
                                                    class="mdi mdi-{{ request('direction') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                            @else
                                                <i class="mdi mdi-swap-vertical"></i>
                                            @endif
                                        </th>
                                        <th>Nama - Unit</th>
                                        <th>Jenis & Tipe</th>
                                        <th class="sortable {{ request('sort') == 'purchase_type' ? 'active-sort' : '' }}"
                                            data-field="purchase_type"
                                            data-direction="{{ request('sort') == 'purchase_type' ? (request('direction') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                            Metode
                                            @if (request('sort') == 'purchase_type')
                                                <i
                                                    class="mdi mdi-{{ request('direction') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                            @else
                                                <i class="mdi mdi-swap-vertical"></i>
                                            @endif
                                        </th>
                                        <th class="sortable {{ request('sort') == 'status' ? 'active-sort' : '' }}"
                                            data-field="status"
                                            data-direction="{{ request('sort') == 'status' ? (request('direction') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                            Status
                                            @if (request('sort') == 'status')
                                                <i
                                                    class="mdi mdi-{{ request('direction') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                            @else
                                                <i class="mdi mdi-swap-vertical"></i>
                                            @endif
                                        </th>
                                        <th>Progress</th>
                                        <th>Agent / Sales</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($bookings as $index => $booking)
                                        @php
                                            $customerName = $booking->customer->full_name ?? '-';

                                            $progress = match ($booking->status) {
                                                'draft' => 10,
                                                'pengajuan' => 20,
                                                'verifikasi' => 35,
                                                'survey' => 40,
                                                'lanjut_kpr' => 50,
                                                'active' => 25,
                                                'cash_process' => 60,
                                                'akad' => 80,
                                                'completed', 'lunas' => 100,
                                                'cancelled' => 0,
                                                default => 15,
                                            };

                                            $displayStatus =
                                                $progress == 100
                                                    ? 'Complete'
                                                    : match ($booking->status) {
                                                        'draft' => 'Draft',
                                                        'pengajuan' => 'Pengajuan',
                                                        'verifikasi' => 'Verifikasi',
                                                        'survey' => 'Survey',
                                                        'lanjut_kpr' => 'Lanjut KPR',
                                                        'active' => 'Aktif',
                                                        'akad' => 'Akad',
                                                        'cash_process' => 'Cash Process',
                                                        'lunas' => 'Lunas',
                                                        'cancelled' => 'Ditolak',
                                                        default => ucfirst($booking->status),
                                                    };

                                            $statusClass =
                                                $progress == 100
                                                    ? 'complete'
                                                    : match ($booking->status) {
                                                        'draft' => 'booking',
                                                        'pengajuan' => 'diproses',
                                                        'verifikasi' => 'review',
                                                        'survey' => 'review',
                                                        'lanjut_kpr' => 'diproses',
                                                        'active' => 'aktif',
                                                        'akad' => 'review',
                                                        'cash_process' => 'aktif',
                                                        'cancelled' => 'pending',
                                                        default => 'booking',
                                                    };

                                            $methodClass = str_replace(
                                                '_',
                                                '-',
                                                strtolower($booking->purchase_type ?? ''),
                                            );
                                        @endphp

                                        <tr id="booking-{{ $booking->id }}"
                                            class="{{ request('booking_id') == $booking->id ? 'table-warning' : '' }}">
                                            <td class="text-center fw-bold">
                                                {{ ($bookings->firstItem() ?? 1) + $index }}
                                            </td>

                                            <td>
                                                <span class="booking-id">
                                                    <i class="mdi mdi-clipboard-check-outline"></i>
                                                    {{ $booking->booking_code }}
                                                </span>
                                            </td>

                                            <td>
                                                <span class="fw-bold text-dark">{{ $customerName }}</span>
                                            </td>

                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-home-outline text-primary me-2"
                                                        style="font-size: 1.1rem;"></i>
                                                    <span class="fw-bold">
                                                        {{ $booking->unit->unit_name ?? '-' }} -
                                                        {{ $booking->unit->unit_code ?? ($booking->unit->block ?? '') . ' ' . ($booking->unit->unit_number ?? '') }}
                                                    </span>
                                                </div>
                                            </td>

                                            <td>
                                                @php
                                                    $jenis = $booking->unit->jenis ?? '';
                                                    $tipe = $booking->unit->type ?? '-';
                                                @endphp
                                                @if (strtolower($jenis) == 'subsidi')
                                                    <span class="badge badge-gradient-success">
                                                        <i class="mdi mdi-home-assistant me-1"></i>{{ $jenis }} -
                                                        {{ $tipe }}
                                                    </span>
                                                @elseif(strtolower($jenis) == 'komersil')
                                                    <span class="badge badge-gradient-primary">
                                                        <i class="mdi mdi-office-building me-1"></i>{{ $jenis }} -
                                                        {{ $tipe }}
                                                    </span>
                                                @else
                                                    <span class="badge badge-gradient-secondary">
                                                        <i
                                                            class="mdi mdi-help-circle-outline me-1"></i>{{ ($jenis ?: '-') . ' - ' . $tipe }}
                                                    </span>
                                                @endif
                                            </td>

                                            <td>
                                                <span class="badge-method {{ $methodClass }}">
                                                    @if ($booking->purchase_type === 'kpr')
                                                        <i class="mdi mdi-bank"></i> KPR
                                                    @elseif ($booking->purchase_type === 'cash')
                                                        <i class="mdi mdi-cash"></i> Cash
                                                    @elseif ($booking->purchase_type === 'cash_tempo')
                                                        <i class="mdi mdi-calendar-clock"></i> Cash Tempo
                                                    @else
                                                        <i class="mdi mdi-cash-multiple"></i> -
                                                    @endif
                                                </span>
                                            </td>

                                            <td>
                                                <span class="badge-status {{ $statusClass }}">
                                                    @if ($displayStatus === 'Draft')
                                                        <i class="mdi mdi-file-document-outline"></i>
                                                    @elseif ($displayStatus === 'Pengajuan')
                                                        <i class="mdi mdi-send-outline"></i>
                                                    @elseif ($displayStatus === 'Verifikasi')
                                                        <i class="mdi mdi-check-decagram-outline"></i>
                                                    @elseif ($displayStatus === 'Survey')
                                                        <i class="mdi mdi-map-marker-check-outline"></i>
                                                    @elseif ($displayStatus === 'Lanjut KPR')
                                                        <i class="mdi mdi-bank-transfer-out"></i>
                                                    @elseif ($displayStatus === 'Aktif')
                                                        <i class="mdi mdi-progress-clock"></i>
                                                    @elseif ($displayStatus === 'Akad')
                                                        <i class="mdi mdi-handshake-outline"></i>
                                                    @elseif ($displayStatus === 'Cash Process')
                                                        <i class="mdi mdi-cash-sync"></i>
                                                    @elseif ($displayStatus === 'Lunas' || $displayStatus === 'Complete')
                                                        <i class="mdi mdi-check-circle"></i>
                                                    @elseif ($displayStatus === 'Ditolak')
                                                        <i class="mdi mdi-close-circle-outline"></i>
                                                    @else
                                                        <i class="mdi mdi-information-outline"></i>
                                                    @endif
                                                    {{ $displayStatus }}
                                                </span>
                                            </td>

                                            <td>
                                                <div class="progress-wrapper">
                                                    <div class="progress-row">
                                                        <div class="progress">
                                                            <div class="progress-bar-custom {{ $progress == 100 ? 'progress-dark-green' : 'progress-green' }}"
                                                                style="width: {{ $progress }}%;"></div>
                                                        </div>
                                                        <div class="progress-percent">{{ $progress }}%</div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                @if ($booking->sales)
                                                    <span class="fw-semibold text-dark">{{ $booking->sales->name }}</span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>

                                            <td class="text-center">
                                                @if ($progress == 100)
                                                    <a href="{{ route('unit.selesai', $booking->id) }}"
                                                        class="btn-action method-complete me-1" title="Selesai">
                                                        <i class="mdi mdi-check-bold"></i>
                                                    </a>
                                                @else
                                                    @if ($booking->purchase_type === 'kpr')
                                                        @if (!$booking->kprApplication || $booking->kprApplication->status != 'pengajuan')
                                                            <a href="{{ route('pengajuan.show', $booking->id) }}"
                                                                class="btn-action method-kpr me-1" title="Proses KPR">
                                                                <i class="mdi mdi-bank"></i>
                                                            </a>
                                                        @endif
                                                    @elseif ($booking->purchase_type === 'cash')
                                                        <a href="{{ route('marketing.cash', $booking->id) }}"
                                                            class="btn-action method-cash me-1" title="Proses Cash">
                                                            <i class="mdi mdi-cash"></i>
                                                        </a>
                                                    @elseif ($booking->purchase_type === 'cash_tempo')
                                                        <a href="{{ route('marketing.cash_tempo', $booking->id) }}"
                                                            class="btn-action method-cash-tempo me-1"
                                                            title="Proses Cash Tempo">
                                                            <i class="mdi mdi-calendar-clock"></i>
                                                        </a>
                                                    @endif
                                                @endif
                                                <form action="{{ route('pengajuan.destroy', $booking->id) }}"
                                                    method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-action delete" title="Hapus"
                                                        onclick="return confirm('Yakin mau hapus data ini?')">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center text-muted py-4">
                                                Tidak ada data pengajuan
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if ($bookings instanceof \Illuminate\Pagination\LengthAwarePaginator && $bookings->total() > 0)
                            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                                <div class="pagination-info mb-2 mb-sm-0">
                                    Menampilkan {{ $bookings->firstItem() }} - {{ $bookings->lastItem() }} dari
                                    {{ $bookings->total() }} data
                                </div>
                                <nav aria-label="Page navigation">
                                    <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                        @if ($bookings->onFirstPage())
                                            <li class="page-item disabled" aria-disabled="true">
                                                <span class="page-link" aria-label="Previous">
                                                    <i class="mdi mdi-chevron-left"></i>
                                                </span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link"
                                                    href="{{ $bookings->appends(request()->query())->previousPageUrl() }}"
                                                    rel="prev" aria-label="Previous"
                                                    onclick="showPaginationLoading(event)">
                                                    <i class="mdi mdi-chevron-left"></i>
                                                </a>
                                            </li>
                                        @endif

                                        @foreach ($bookings->getUrlRange(max(1, $bookings->currentPage() - 2), min($bookings->lastPage(), $bookings->currentPage() + 2)) as $page => $url)
                                            @if ($page == $bookings->currentPage())
                                                <li class="page-item active" aria-current="page">
                                                    <span class="page-link">{{ $page }}</span>
                                                </li>
                                            @else
                                                <li class="page-item">
                                                    <a class="page-link"
                                                        href="{{ $bookings->appends(request()->query())->url($page) }}"
                                                        onclick="showPaginationLoading(event)">{{ $page }}</a>
                                                </li>
                                            @endif
                                        @endforeach

                                        @if ($bookings->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link"
                                                    href="{{ $bookings->appends(request()->query())->nextPageUrl() }}"
                                                    rel="next" aria-label="Next"
                                                    onclick="showPaginationLoading(event)">
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

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // Init Select2 Filter (Without Search Box)
            $('#statusSelect, #metodeSelect, #perPageSelect, #statusSelectMobile, #metodeSelectMobile, #perPageSelectMobile').select2({
                theme: 'bootstrap-5',
                minimumResultsForSearch: Infinity,
                width: '100%'
            });

            $('.sortable').click(function() {
                let field = $(this).data('field');
                let direction = $(this).data('direction');

                Swal.fire({
                    title: 'Memuat...',
                    html: 'Sedang mengurutkan data',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                let url = new URL(window.location.href);
                url.searchParams.set('sort', field);
                url.searchParams.set('direction', direction);
                url.searchParams.set('page', 1);

                window.location.href = url.toString();
            });
        });

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
            let url = event.currentTarget.href;

            Swal.fire({
                title: 'Memuat...',
                html: 'Sedang mereset filter',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            window.location.href = url;
        }

        function showPaginationLoading(event) {
            if (event.currentTarget.closest('.disabled') || event.currentTarget.closest('.active')) return;

            Swal.fire({
                title: 'Memuat...',
                html: 'Sedang memuat data halaman',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        }

        function handleExport() {
            Swal.fire({
                icon: 'success',
                title: 'Export Berhasil',
                text: 'Export data Customer Booking berhasil dijalankan.',
                confirmButtonColor: '#9a55ff'
            });
        }

        function handleImport() {
            Swal.fire({
                icon: 'success',
                title: 'Import Berhasil',
                text: 'Import data Customer Booking berhasil dijalankan.',
                confirmButtonColor: '#9a55ff'
            });
        }
    </script>
@endpush
