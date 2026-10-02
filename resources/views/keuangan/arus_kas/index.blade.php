@extends('layouts.partial.app')

@section('title', 'Laporan Arus Kas (Cash Flow) - Sistem Keuangan ERP')

@push('styles')
<style>
    /* Card Dasar Konsisten */
    .ak-card {
        border-radius: 6px !important;
        border: 1px solid #e2e8f0 !important;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04) !important;
        background: #ffffff;
    }

    /* 4 KPI Cards (Persis Dashboard) */
    .dash-kpi-card {
        background: #ffffff;
        border: 1px solid #e2e8f0 !important;
        border-radius: 6px !important;
        padding: 1rem 1.15rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04) !important;
        transition: all 0.2s ease;
        height: 100%;
    }
    .dash-kpi-card:hover {
        border-color: #cbd5e1 !important;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.06) !important;
    }
    .dash-kpi-left {
        display: flex;
        align-items: center;
        gap: 0.85rem;
        min-width: 0;
    }
    .dash-kpi-icon {
        width: 48px;
        height: 48px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        flex-shrink: 0;
    }
    .dash-kpi-icon.purple { background-color: #f3e8ff; color: #9333ea; }
    .dash-kpi-icon.blue { background-color: #e0f2fe; color: #0284c7; }
    .dash-kpi-icon.green { background-color: #dcfce7; color: #16a34a; }
    .dash-kpi-icon.rose { background-color: #ffe4e6; color: #e11d48; }

    .dash-kpi-info {
        min-width: 0;
    }
    .dash-kpi-label {
        font-size: 0.78rem;
        font-weight: 600;
        color: #64748b;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .dash-kpi-val {
        font-size: 1.25rem;
        font-weight: 800;
        color: #0f172a;
        line-height: 1.2;
        margin-top: 2px;
        letter-spacing: -0.02em;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .dash-kpi-sub {
        font-size: 0.72rem;
        color: #94a3b8;
        margin-top: 3px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Compact Table Card persis Catalog Unit */
    .card.compact-table-card,
    .compact-table-card {
        background: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 6px !important;
        box-shadow: none !important;
        transition: border-color 0.2s ease;
        overflow: hidden;
    }
    .card.compact-table-card:hover,
    .compact-table-card:hover {
        border-color: #cbd5e1 !important;
        box-shadow: none !important;
    }
    .compact-table-card .card-body,
    .card.compact-table-card .card-body {
        padding: 0.85rem 1.25rem !important;
        background: #ffffff !important;
    }

    .filter-card {
        margin-top: 0 !important;
        margin-bottom: 0.85rem !important;
    }
    .filter-card .form-control,
    .filter-card .form-select {
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        font-size: 0.85rem;
    }
    .filter-card .form-control:focus,
    .filter-card .form-select:focus {
        border-color: #9a55ff;
        box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.12);
    }

    /* Action Filter / Reset Buttons persis Catalog Unit */
    .btn-icon-only {
        width: 38px !important;
        height: 38px !important;
        min-width: 38px !important;
        min-height: 38px !important;
        padding: 0 !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        border-radius: 6px !important;
        transition: all 0.2s ease;
        box-shadow: none !important;
    }
    .btn-icon-only i {
        font-size: 1.15rem !important;
        margin: 0 !important;
        line-height: 1 !important;
    }
    .btn-gradient-primary {
        background: #9a55ff !important;
        border: 1px solid #9a55ff !important;
        color: #ffffff !important;
    }
    .btn-gradient-primary:hover {
        background: #8b3df5 !important;
        border-color: #8b3df5 !important;
        color: #ffffff !important;
        transform: translateY(-1px);
    }
    .btn-gradient-secondary {
        background: #64748b !important;
        border: 1px solid #64748b !important;
        color: #ffffff !important;
    }
    .btn-gradient-secondary:hover {
        background: #475569 !important;
        border-color: #475569 !important;
        color: #ffffff !important;
        transform: translateY(-1px);
    }

    /* Preset Period Pills */
    .preset-pill {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 10px;
        font-size: 0.76rem;
        font-weight: 600;
        border-radius: 6px;
        border: 1px solid #cbd5e1;
        background: #ffffff;
        color: #475569;
        cursor: pointer;
        transition: all 0.2s ease;
        line-height: 1.3;
        text-decoration: none;
    }
    .preset-pill:hover {
        background: #f1f5f9;
        border-color: #94a3b8;
        color: #0f172a;
        transform: translateY(-1px);
    }
    .preset-pill.active {
        background: #f3e8ff !important;
        border-color: #c084fc !important;
        color: #7c3aed !important;
        font-weight: 700 !important;
        box-shadow: 0 1px 3px rgba(154, 85, 255, 0.15);
    }

    /* Statement Section */
    .statement-section {
        background: #ffffff;
        border-radius: 6px !important;
        border: 1px solid #e2e8f0 !important;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04) !important;
        overflow: hidden;
        margin-bottom: 1.25rem;
    }
    .statement-header {
        background: #f8fafc;
        padding: 0.85rem 1.25rem;
        font-weight: 700;
        font-size: 0.95rem;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .statement-row {
        padding: 0.65rem 1.25rem;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.88rem;
    }
    .statement-row:hover {
        background: #fbfcfe;
    }
    .statement-subtotal {
        padding: 0.85rem 1.25rem;
        background: #f8fafc;
        font-weight: 700;
        font-size: 0.92rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px dashed #cbd5e1;
    }

    /* Buttons Tanpa Gradien (Solid Colors) */
    .btn-solid-green {
        background: #10b981 !important;
        border: 1px solid #10b981 !important;
        color: #ffffff !important;
        font-weight: 600;
        border-radius: 6px !important;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: all 0.2s ease;
    }
    .btn-solid-green:hover {
        background: #059669 !important;
        border-color: #059669 !important;
        color: #ffffff !important;
    }

    .btn-solid-red {
        background: #ef4444 !important;
        border: 1px solid #ef4444 !important;
        color: #ffffff !important;
        font-weight: 600;
        border-radius: 6px !important;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: all 0.2s ease;
    }
    .btn-solid-red:hover {
        background: #dc2626 !important;
        border-color: #dc2626 !important;
        color: #ffffff !important;
    }

    .btn-outline-neutral {
        background: #ffffff !important;
        border: 1.5px solid #cbd5e1 !important;
        color: #475569 !important;
        font-weight: 600;
        border-radius: 6px !important;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: all 0.2s ease;
    }
    .btn-outline-neutral:hover {
        background: #f8fafc !important;
        color: #1e293b !important;
    }

    .btn-solid-purple {
        background: #9a55ff !important;
        border: 1px solid #9a55ff !important;
        color: #ffffff !important;
        font-weight: 600;
        border-radius: 6px !important;
    }
    .btn-solid-purple:hover {
        background: #8435f5 !important;
        border-color: #8435f5 !important;
        color: #ffffff !important;
    }

    /* Tabs */
    .nav-pills {
        gap: 10px !important;
    }
    .nav-pills .nav-link {
        border-radius: 6px !important;
        font-weight: 600;
        font-size: 0.88rem;
        padding: 0.6rem 1.15rem;
        border: 1px solid transparent;
        transition: all 0.2s ease;
    }
    .nav-pills .nav-link.active {
        background-color: #9a55ff !important;
        color: #ffffff !important;
        border-color: #9a55ff !important;
        box-shadow: 0 2px 6px rgba(154, 85, 255, 0.25);
    }
    .nav-pills .nav-link:not(.active) {
        background-color: #ffffff;
        border-color: #e2e8f0;
        color: #475569 !important;
    }
    .nav-pills .nav-link:not(.active):hover {
        background-color: #f8fafc;
        border-color: #cbd5e1;
        color: #0f172a !important;
    }

    .badge-soft {
        border-radius: 4px;
        font-weight: 600;
        padding: 4px 8px;
        font-size: 0.74rem;
    }
    .badge-soft-success {
        background: #e6f9ed;
        color: #10b981;
        border: 1px solid #bbf7d0;
    }
    .badge-soft-danger {
        background: #fef2f2;
        color: #ef4444;
        border: 1px solid #fecaca;
    }
    .badge-soft-primary {
        background: #eef2ff;
        color: #6366f1;
        border: 1px solid #c7d2fe;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-3 py-2">
    {{-- Header Banner --}}
    <div class="card ak-card mb-3">
        <div class="card-body p-3">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <div>
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <span class="text-muted" style="font-size: 0.8rem;"><i class="mdi mdi-calendar me-1"></i>{{ date('d M Y', strtotime($startDate)) }} s/d {{ date('d M Y', strtotime($endDate)) }}</span>
                    </div>
                    <h4 class="mb-0 fw-bold text-dark">Laporan Arus Kas (Cash Flow)</h4>
                    <p class="text-muted mb-0 small">Memantau likuiditas kas masuk, kas keluar proyek, dan saldo kas rill perusahaan.</p>
                </div>
                <div class="d-flex flex-wrap align-items-center gap-2">
                    {{-- Tombol BKM (Halaman Sendiri) --}}
                    <a href="{{ route('keuangan.arus-kas.create', ['type' => 'BKM']) }}" class="btn btn-solid-green btn-sm px-3 py-2 shadow-sm">
                        <i class="mdi mdi-plus"></i> Kas Masuk (BKM)
                    </a>

                    {{-- Tombol BKK (Halaman Sendiri) --}}
                    <a href="{{ route('keuangan.arus-kas.create', ['type' => 'BKK']) }}" class="btn btn-solid-red btn-sm px-3 py-2 shadow-sm">
                        <i class="mdi mdi-plus"></i> Kas Keluar (BKK)
                    </a>

                    {{-- Tombol Cetak --}}
                    <a href="{{ route('keuangan.arus-kas.cetak', request()->query()) }}" target="_blank" class="btn btn-outline-neutral btn-sm px-3 py-2">
                        <i class="mdi mdi-printer"></i> Cetak Arus Kas
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Flash Notifications --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" style="border-radius: 6px;" role="alert">
            <i class="mdi mdi-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" style="border-radius: 6px;" role="alert">
            <i class="mdi mdi-alert-circle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- 4 KPI Cards (Persis Style Dashboard) --}}
    <div class="row g-3 mb-3">
        <!-- 1. Saldo Awal Kas (Purple) -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="dash-kpi-card">
                <div class="dash-kpi-left">
                    <div class="dash-kpi-icon purple">
                        <i class="mdi mdi-wallet-outline"></i>
                    </div>
                    <div class="dash-kpi-info">
                        <div class="dash-kpi-label">Saldo Awal Kas</div>
                        <div class="dash-kpi-val">Rp {{ number_format($report['saldo_awal'], 0, ',', '.') }}</div>
                        <div class="dash-kpi-sub">Sebelum {{ date('d M Y', strtotime($startDate)) }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. Total Kas Masuk (Green) -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="dash-kpi-card">
                <div class="dash-kpi-left">
                    <div class="dash-kpi-icon green">
                        <i class="mdi mdi-arrow-down-bold"></i>
                    </div>
                    <div class="dash-kpi-info">
                        <div class="dash-kpi-label">Total Kas Masuk (Inflow)</div>
                        <div class="dash-kpi-val" style="color: #16a34a;">+ Rp {{ number_format($report['total_inflow'], 0, ',', '.') }}</div>
                        <div class="dash-kpi-sub"><span class="badge badge-soft-success">Penerimaan Dana</span></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. Total Kas Keluar (Rose) -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="dash-kpi-card">
                <div class="dash-kpi-left">
                    <div class="dash-kpi-icon rose">
                        <i class="mdi mdi-arrow-up-bold"></i>
                    </div>
                    <div class="dash-kpi-info">
                        <div class="dash-kpi-label">Total Kas Keluar (Outflow)</div>
                        <div class="dash-kpi-val" style="color: #e11d48;">- Rp {{ number_format($report['total_outflow'], 0, ',', '.') }}</div>
                        <div class="dash-kpi-sub"><span class="badge badge-soft-danger">Pengeluaran Kas/Bank</span></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4. Saldo Kas Akhir (Blue) -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="dash-kpi-card">
                <div class="dash-kpi-left">
                    <div class="dash-kpi-icon blue">
                        <i class="mdi mdi-safe"></i>
                    </div>
                    <div class="dash-kpi-info">
                        <div class="dash-kpi-label">Saldo Kas Akhir</div>
                        <div class="dash-kpi-val" style="color: #0284c7;">Rp {{ number_format($report['saldo_akhir'], 0, ',', '.') }}</div>
                        <div class="dash-kpi-sub">
                            <span class="badge badge-soft-primary">
                                Net: {{ $report['net_cash_flow'] >= 0 ? '+' : '' }}Rp {{ number_format($report['net_cash_flow'], 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter Panel (Persis Catalog Unit) --}}
    <div class="card compact-table-card filter-card mb-3">
        <div class="card-body">
            <form method="GET" action="{{ route('keuangan.arus-kas.index') }}" id="filterForm">
                <input type="hidden" name="tab" value="{{ $tab }}">
                <div class="d-flex flex-wrap align-items-end justify-content-between gap-2 w-100">
                    <div class="d-flex flex-wrap align-items-end gap-2 flex-grow-1">
                        <!-- Mulai Tanggal -->
                        <div style="min-width: 160px; flex: 1;">
                            <label class="form-label small fw-semibold text-secondary mb-1" style="font-size: 0.78rem;">Mulai Tanggal</label>
                            <input type="date" name="start_date" class="form-control" value="{{ $startDate }}" style="height: 38px;">
                        </div>

                        <!-- Sampai Tanggal -->
                        <div style="min-width: 160px; flex: 1;">
                            <label class="form-label small fw-semibold text-secondary mb-1" style="font-size: 0.78rem;">Sampai Tanggal</label>
                            <input type="date" name="end_date" class="form-control" value="{{ $endDate }}" style="height: 38px;">
                        </div>

                        <!-- Filter Proyek / Landbank -->
                        <div style="min-width: 230px; flex: 2;">
                            <label class="form-label small fw-semibold text-secondary mb-1" style="font-size: 0.78rem;">Filter Proyek / Landbank</label>
                            <select name="land_bank_id" class="form-select" onchange="document.getElementById('filterForm').submit()" style="height: 38px;">
                                <option value="">Semua Proyek (Konsolidasi)</option>
                                @foreach($landBanks as $lb)
                                    <option value="{{ $lb->id }}" {{ $landBankId == $lb->id ? 'selected' : '' }}>
                                        {{ $lb->nama_land_bank }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Action Filter / Reset Buttons (Sama Persis Catalog Unit) -->
                    <div class="d-flex align-items-center gap-2 ms-auto mt-2 mt-md-0">
                        <button type="submit" class="btn btn-gradient-primary btn-icon-only" title="Terapkan Filter">
                            <i class="mdi mdi-filter"></i>
                        </button>
                        <a href="{{ route('keuangan.arus-kas.index') }}" class="btn btn-gradient-secondary btn-icon-only" title="Reset Filter">
                            <i class="mdi mdi-refresh"></i>
                        </a>
                    </div>
                </div>

                <!-- Preset Periode -->
                @php
                    $isThisMonth = ($startDate === date('Y-m-01') && $endDate === date('Y-m-t'));
                    $isYtd = ($startDate === date('Y-01-01') && $endDate === date('Y-m-t'));
                    $isAll = ($startDate === '2020-01-01' && $endDate === date('Y-12-31'));
                @endphp
                <div class="d-flex align-items-center gap-2 mt-3 pt-2 border-top flex-wrap">
                    <span class="fw-semibold text-secondary d-inline-flex align-items-center me-1" style="font-size: 0.76rem;">
                        <i class="mdi mdi-clock-fast me-1 text-primary"></i> Preset Periode:
                    </span>
                    <button type="button" class="preset-pill {{ $isThisMonth ? 'active' : '' }}" onclick="setPreset('this_month')">
                        <i class="mdi mdi-calendar-today"></i> Bulan Ini
                    </button>
                    <button type="button" class="preset-pill {{ $isYtd ? 'active' : '' }}" onclick="setPreset('ytd')">
                        <i class="mdi mdi-calendar-range"></i> Tahun Berjalan (YTD)
                    </button>
                    <button type="button" class="preset-pill {{ $isAll ? 'active' : '' }}" onclick="setPreset('all')">
                        <i class="mdi mdi-calendar-multiselect"></i> Semua Transaksi
                    </button>
                    <span class="ms-auto text-muted small d-inline-flex align-items-center" style="font-size: 0.74rem;">
                        <i class="mdi mdi-calendar-check text-success me-1"></i> Periode aktif: <strong class="text-dark ms-1">{{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }}</strong> &nbsp;s/d&nbsp; <strong class="text-dark ms-1">{{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}</strong>
                    </span>
                </div>
            </form>
        </div>
    </div>

    {{-- Nav Tabs --}}
    <ul class="nav nav-pills gap-2 mb-3" id="cashFlowTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link {{ $tab === 'statement' ? 'active fw-bold' : 'text-dark' }}" href="{{ route('keuangan.arus-kas.index', array_merge(request()->query(), ['tab' => 'statement'])) }}">
                <i class="mdi mdi-file-chart me-1"></i> Format Laporan Arus Kas
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link {{ $tab === 'list' ? 'active fw-bold' : 'text-dark' }}" href="{{ route('keuangan.arus-kas.index', array_merge(request()->query(), ['tab' => 'list'])) }}">
                <i class="mdi mdi-format-list-bulleted me-1"></i> Mutasi Kas Harian (Buku Kas)
            </a>
        </li>
    </ul>

    @if($tab === 'statement')
        {{-- TAB 1: FORMAT LAPORAN ARUS KAS --}}
        <div class="row">
            <div class="col-lg-12">
                {{-- 1. Aktivitas Operasi --}}
                <div class="statement-section">
                    <div class="statement-header text-primary">
                        <span><i class="mdi mdi-briefcase-outline me-2"></i>I. ARUS KAS DARI AKTIVITAS OPERASI</span>
                        <span>Nominal (Rp)</span>
                    </div>

                    {{-- Inflows Operasi --}}
                    <div class="bg-light px-3 py-1 small fw-bold text-success border-bottom">
                        <i class="mdi mdi-plus-circle me-1"></i> Arus Kas Masuk (Penerimaan Operasional):
                    </div>
                    @forelse($report['operating_inflows'] as $item)
                        <div class="statement-row">
                            <div class="ps-3">
                                <span class="fw-semibold text-dark">{{ $item->description }}</span>
                                <div class="text-muted small" style="font-size: 0.74rem;">
                                    {{ $item->entry_date->format('d/m/Y') }} &bull; {{ $item->entry_number }} &bull; {{ $item->party_name ?? '-' }}
                                    @if($item->landBank) <span class="badge bg-light text-primary border ms-1">{{ $item->landBank->nama_land_bank }}</span> @endif
                                </div>
                            </div>
                            <span class="fw-bold text-success">+ {{ number_format($item->total_amount, 0, ',', '.') }}</span>
                        </div>
                    @empty
                        <div class="statement-row text-muted small ps-4">Tidak ada penerimaan kas operasional pada periode ini.</div>
                    @endforelse

                    {{-- Outflows Operasi --}}
                    <div class="bg-light px-3 py-1 small fw-bold text-danger border-bottom mt-2">
                        <i class="mdi mdi-minus-circle me-1"></i> Arus Kas Keluar (Beban & Pengeluaran Operasional):
                    </div>
                    @forelse($report['operating_outflows'] as $item)
                        <div class="statement-row">
                            <div class="ps-3">
                                <span class="fw-semibold text-dark">{{ $item->description }}</span>
                                <div class="text-muted small" style="font-size: 0.74rem;">
                                    {{ $item->entry_date->format('d/m/Y') }} &bull; {{ $item->entry_number }} &bull; {{ $item->party_name ?? '-' }}
                                    @if($item->landBank) <span class="badge bg-light text-primary border ms-1">{{ $item->landBank->nama_land_bank }}</span> @endif
                                </div>
                            </div>
                            <span class="fw-bold text-danger">- {{ number_format($item->total_amount, 0, ',', '.') }}</span>
                        </div>
                    @empty
                        <div class="statement-row text-muted small ps-4">Tidak ada pengeluaran kas operasional pada periode ini.</div>
                    @endforelse

                    <div class="statement-subtotal {{ $report['net_operating'] >= 0 ? 'text-success' : 'text-danger' }}">
                        <span>Arus Kas Bersih dari Aktivitas Operasi</span>
                        <span class="fs-6">{{ $report['net_operating'] >= 0 ? '+' : '' }}Rp {{ number_format($report['net_operating'], 0, ',', '.') }}</span>
                    </div>
                </div>

                {{-- 2. Aktivitas Investasi & Proyek --}}
                <div class="statement-section">
                    <div class="statement-header text-info">
                        <span><i class="mdi mdi-home-analytics me-2"></i>II. ARUS KAS DARI AKTIVITAS INVESTASI & PENGEMBANGAN PROYEK</span>
                        <span>Nominal (Rp)</span>
                    </div>

                    {{-- Inflow Investasi --}}
                    @if($report['investing_inflows']->isNotEmpty())
                        <div class="bg-light px-3 py-1 small fw-bold text-success border-bottom">
                            <i class="mdi mdi-plus-circle me-1"></i> Penerimaan Investasi / Penjualan Aset:
                        </div>
                        @foreach($report['investing_inflows'] as $item)
                            <div class="statement-row">
                                <div class="ps-3">
                                    <span class="fw-semibold text-dark">{{ $item->description }}</span>
                                    <div class="text-muted small" style="font-size: 0.74rem;">{{ $item->entry_date->format('d/m/Y') }} &bull; {{ $item->entry_number }}</div>
                                </div>
                                <span class="fw-bold text-success">+ {{ number_format($item->total_amount, 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                    @endif

                    {{-- Outflows Investasi --}}
                    <div class="bg-light px-3 py-1 small fw-bold text-danger border-bottom">
                        <i class="mdi mdi-minus-circle me-1"></i> Pengeluaran Investasi (Tanah, Konstruksi Unit SPK, & Infrastruktur):
                    </div>
                    @forelse($report['investing_outflows'] as $item)
                        <div class="statement-row">
                            <div class="ps-3">
                                <span class="fw-semibold text-dark">{{ $item->description }}</span>
                                <div class="text-muted small" style="font-size: 0.74rem;">
                                    {{ $item->entry_date->format('d/m/Y') }} &bull; {{ $item->entry_number }} &bull; {{ $item->party_name ?? '-' }}
                                    @if($item->landBank) <span class="badge bg-light text-primary border ms-1">{{ $item->landBank->nama_land_bank }}</span> @endif
                                </div>
                            </div>
                            <span class="fw-bold text-danger">- {{ number_format($item->total_amount, 0, ',', '.') }}</span>
                        </div>
                    @empty
                        <div class="statement-row text-muted small ps-4">Tidak ada pengeluaran investasi / proyek pada periode ini.</div>
                    @endforelse

                    <div class="statement-subtotal {{ $report['net_investing'] >= 0 ? 'text-success' : 'text-danger' }}">
                        <span>Arus Kas Bersih dari Aktivitas Investasi & Proyek</span>
                        <span class="fs-6">{{ $report['net_investing'] >= 0 ? '+' : '' }}Rp {{ number_format($report['net_investing'], 0, ',', '.') }}</span>
                    </div>
                </div>

                {{-- 3. Aktivitas Pendanaan --}}
                <div class="statement-section">
                    <div class="statement-header text-warning text-dark">
                        <span><i class="mdi mdi-bank me-2"></i>III. ARUS KAS DARI AKTIVITAS PENDANAAN</span>
                        <span>Nominal (Rp)</span>
                    </div>

                    {{-- Inflows Pendanaan --}}
                    <div class="bg-light px-3 py-1 small fw-bold text-success border-bottom">
                        <i class="mdi mdi-plus-circle me-1"></i> Penerimaan Pencairan KPR Bank / Setoran Modal:
                    </div>
                    @forelse($report['financing_inflows'] as $item)
                        <div class="statement-row">
                            <div class="ps-3">
                                <span class="fw-semibold text-dark">{{ $item->description }}</span>
                                <div class="text-muted small" style="font-size: 0.74rem;">
                                    {{ $item->entry_date->format('d/m/Y') }} &bull; {{ $item->entry_number }} &bull; {{ $item->party_name ?? '-' }}
                                </div>
                            </div>
                            <span class="fw-bold text-success">+ {{ number_format($item->total_amount, 0, ',', '.') }}</span>
                        </div>
                    @empty
                        <div class="statement-row text-muted small ps-4">Tidak ada penerimaan pendanaan pada periode ini.</div>
                    @endforelse

                    {{-- Outflows Pendanaan --}}
                    @if($report['financing_outflows']->isNotEmpty())
                        <div class="bg-light px-3 py-1 small fw-bold text-danger border-bottom mt-2">
                            <i class="mdi mdi-minus-circle me-1"></i> Pembayaran Pinjaman / Prive:
                        </div>
                        @foreach($report['financing_outflows'] as $item)
                            <div class="statement-row">
                                <div class="ps-3">
                                    <span class="fw-semibold text-dark">{{ $item->description }}</span>
                                    <div class="text-muted small" style="font-size: 0.74rem;">{{ $item->entry_date->format('d/m/Y') }} &bull; {{ $item->entry_number }}</div>
                                </div>
                                <span class="fw-bold text-danger">- {{ number_format($item->total_amount, 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                    @endif

                    <div class="statement-subtotal {{ $report['net_financing'] >= 0 ? 'text-success' : 'text-danger' }}">
                        <span>Arus Kas Bersih dari Aktivitas Pendanaan</span>
                        <span class="fs-6">{{ $report['net_financing'] >= 0 ? '+' : '' }}Rp {{ number_format($report['net_financing'], 0, ',', '.') }}</span>
                    </div>
                </div>

                {{-- Ringkasan Kenaikan / Penurunan Bersih Kas --}}
                <div class="card ak-card mb-4" style="background: #f8fafc;">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="fw-bold text-dark">Kenaikan / (Penurunan) Bersih Kas Periode Ini</span>
                            <span class="fs-5 fw-bold {{ $report['net_cash_flow'] >= 0 ? 'text-success' : 'text-danger' }}">
                                {{ $report['net_cash_flow'] >= 0 ? '+' : '' }}Rp {{ number_format($report['net_cash_flow'], 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2 small text-muted">
                            <span>Saldo Kas & Setara Kas Awal Periode</span>
                            <span class="fw-semibold text-dark">Rp {{ number_format($report['saldo_awal'], 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                            <span class="fw-bold text-primary fs-6">SALDO KAS & SETARA KAS AKHIR PERIODE</span>
                            <span class="fw-bold text-primary fs-5">Rp {{ number_format($report['saldo_akhir'], 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        {{-- TAB 2: DAFTAR MUTASI KAS HARIAN --}}
        <div class="card ak-card">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr class="small text-uppercase fw-bold text-secondary">
                            <th>No. Voucher</th>
                            <th>Tanggal</th>
                            <th>Kategori & Keterangan</th>
                            <th>Pihak Terkait</th>
                            <th>Proyek</th>
                            <th class="text-end">Masuk (Rp)</th>
                            <th class="text-end">Keluar (Rp)</th>
                            <th class="text-center">Bukti</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mutasiEntries as $m)
                            <tr>
                                <td>
                                    <span class="badge {{ $m->transaction_type === 'inflow' ? 'badge-soft-success' : 'badge-soft-danger' }} fw-bold">
                                        {{ $m->entry_number }}
                                    </span>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark small">{{ $m->entry_date->format('d/m/Y') }}</div>
                                    <span class="text-muted" style="font-size: 0.72rem;">{{ $m->entry_date->locale('id')->isoFormat('dddd') }}</span>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark small">{{ $m->description }}</div>
                                    <div class="text-muted" style="font-size: 0.72rem;">
                                        Kategori: <span class="badge bg-light text-secondary border">{{ strtoupper($m->cash_flow_category) }}</span>
                                        &bull; Modul: {{ strtoupper(str_replace('_', ' ', $m->source_module)) }}
                                    </div>
                                </td>
                                <td class="small">{{ $m->party_name ?? '-' }}</td>
                                <td class="small text-primary fw-semibold">{{ $m->landBank?->nama_land_bank ?? 'Kantor / Umum' }}</td>
                                <td class="text-end fw-bold text-success small">
                                    {{ $m->transaction_type === 'inflow' ? number_format($m->total_amount, 0, ',', '.') : '-' }}
                                </td>
                                <td class="text-end fw-bold text-danger small">
                                    {{ $m->transaction_type === 'outflow' ? number_format($m->total_amount, 0, ',', '.') : '-' }}
                                </td>
                                <td class="text-center">
                                    @if($m->proof_url)
                                        <a href="{{ $m->proof_url }}" target="_blank" class="btn btn-sm btn-outline-info p-1 px-2" title="Bukti Transaksi">
                                            <i class="mdi mdi-paperclip"></i>
                                        </a>
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if(!$m->is_auto_generated)
                                        <form action="{{ route('keuangan.arus-kas.destroy-manual', $m->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus transaksi kas manual ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-light border text-danger p-1 px-2" title="Hapus">
                                                <i class="mdi mdi-trash-can-outline"></i>
                                            </button>
                                        </form>
                                    @else
                                        <span class="badge bg-light text-muted border" style="font-size: 0.7rem;">Otomatis</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-5 text-muted">
                                    <i class="mdi mdi-wallet-outline fs-1 d-block mb-2"></i>
                                    Tidak ada data mutasi kas pada periode ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($mutasiEntries->hasPages())
                <div class="card-footer bg-white border-top p-3 d-flex justify-content-between align-items-center">
                    <span class="small text-muted">Menampilkan {{ $mutasiEntries->firstItem() ?? 0 }} - {{ $mutasiEntries->lastItem() ?? 0 }} dari {{ $mutasiEntries->total() }} mutasi</span>
                    {{ $mutasiEntries->links() }}
                </div>
            @endif
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
function setPreset(type) {
    const today = new Date();
    const yyyy = today.getFullYear();
    const mm = String(today.getMonth() + 1).padStart(2, '0');
    const lastDay = new Date(yyyy, today.getMonth() + 1, 0).getDate();

    const startInput = document.querySelector('input[name="start_date"]');
    const endInput = document.querySelector('input[name="end_date"]');

    if (type === 'this_month') {
        startInput.value = `${yyyy}-${mm}-01`;
        endInput.value = `${yyyy}-${mm}-${String(lastDay).padStart(2, '0')}`;
    } else if (type === 'ytd') {
        startInput.value = `${yyyy}-01-01`;
        endInput.value = `${yyyy}-${mm}-${String(lastDay).padStart(2, '0')}`;
    } else if (type === 'all') {
        startInput.value = '2020-01-01';
        endInput.value = `${yyyy}-12-31`;
    }
    startInput.form.submit();
}
</script>
@endpush
