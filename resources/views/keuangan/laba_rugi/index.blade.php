@extends('layouts.partial.app')

@section('title', 'Laporan Laba Rugi - Sistem Keuangan ERP')

@push('styles')
<style>
    /* Card Dasar Konsisten */
    .ak-card {
        border-radius: 6px !important;
        border: 1px solid #e2e8f0 !important;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04) !important;
        background: #ffffff;
    }

    /* 4 KPI Cards (Persis Dashboard, Arus Kas & Jurnal Umum) */
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

    /* Badges */
    .badge-soft {
        border-radius: 4px;
        font-weight: 600;
        padding: 3px 7px;
        font-size: 0.74rem;
    }
    .badge-soft-success {
        background: #e6f9ed;
        color: #10b981;
        border: 1px solid #bbf7d0;
    }
    .badge-soft-primary {
        background: #eef2ff;
        color: #6366f1;
        border: 1px solid #c7d2fe;
    }
    .badge-soft-danger {
        background: #fef2f2;
        color: #ef4444;
        border: 1px solid #fecaca;
    }
    .badge-soft-warning {
        background: #fffbeb;
        color: #f59e0b;
        border: 1px solid #fde68a;
    }
    .badge-soft-info {
        background: #f0fdfa;
        color: #0d9488;
        border: 1px solid #99f6e4;
    }

    /* Statement Table Styling */
    .statement-table th {
        background-color: #f8fafc;
        color: #475569;
        font-size: 0.78rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e2e8f0 !important;
        padding: 0.85rem 1rem;
    }
    .statement-table td {
        font-size: 0.86rem;
        vertical-align: middle;
        padding: 0.7rem 1rem;
    }
    .category-header-row {
        background-color: #f8fafc;
        font-weight: 700;
        color: #1e293b;
        border-top: 1px solid #e2e8f0;
    }
    .subtotal-row {
        background-color: #fcfdfe;
        font-weight: 700;
        border-top: 1px dashed #cbd5e1;
    }
    .gross-profit-row {
        background-color: #eff6ff !important;
        font-weight: 800;
        color: #1d4ed8;
        font-size: 0.95rem;
    }
    .net-profit-row {
        background-color: #ecfdf5 !important;
        font-weight: 800;
        color: #065f46;
        font-size: 0.98rem;
    }
    .net-deficit-row {
        background-color: #fef2f2 !important;
        font-weight: 800;
        color: #991b1b;
        font-size: 0.98rem;
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
                        <span class="text-muted" style="font-size: 0.8rem;"><i class="mdi mdi-calendar-range me-1"></i>Periode: {{ date('d M Y', strtotime($startDate)) }} s/d {{ date('d M Y', strtotime($endDate)) }}</span>
                    </div>
                    <h4 class="mb-0 fw-bold text-dark">Laporan Laba Rugi (Income Statement)</h4>
                    <p class="text-muted mb-0 small">Kinerja operasional, margin laba kotor proyek, dan laba bersih perusahaan secara akrual.</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('keuangan.laba-rugi.cetak', request()->query()) }}" target="_blank" class="btn btn-outline-neutral btn-sm px-3 py-2">
                        <i class="mdi mdi-printer me-1"></i> Cetak Laba Rugi
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- 4 KPI Cards (Persis Style Dashboard & Arus Kas) --}}
    <div class="row g-3 mb-3">
        <!-- 1. Total Pendapatan (Purple) -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="dash-kpi-card">
                <div class="dash-kpi-left">
                    <div class="dash-kpi-icon purple">
                        <i class="mdi mdi-cash-multiple"></i>
                    </div>
                    <div class="dash-kpi-info">
                        <div class="dash-kpi-label">Total Pendapatan</div>
                        <div class="dash-kpi-val" style="color: #9333ea;">Rp {{ number_format($report['total_revenue'], 0, ',', '.') }}</div>
                        <div class="dash-kpi-sub">
                            <span class="badge badge-soft-primary">Penjualan Properti</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. Total HPP Proyek (Rose) -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="dash-kpi-card">
                <div class="dash-kpi-left">
                    <div class="dash-kpi-icon rose">
                        <i class="mdi mdi-tools"></i>
                    </div>
                    <div class="dash-kpi-info">
                        <div class="dash-kpi-label">Total HPP Proyek</div>
                        <div class="dash-kpi-val" style="color: #e11d48;">Rp {{ number_format($report['total_cogs'], 0, ',', '.') }}</div>
                        <div class="dash-kpi-sub">
                            <span class="text-muted small">Lahan + SPK + Infra</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. Laba Kotor (Blue) -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="dash-kpi-card">
                <div class="dash-kpi-left">
                    <div class="dash-kpi-icon blue">
                        <i class="mdi mdi-chart-areaspline"></i>
                    </div>
                    <div class="dash-kpi-info">
                        <div class="dash-kpi-label">Laba Kotor (Gross)</div>
                        <div class="dash-kpi-val" style="color: #0284c7;">Rp {{ number_format($report['gross_profit'], 0, ',', '.') }}</div>
                        <div class="dash-kpi-sub">
                            <span class="badge badge-soft-info">Margin: {{ number_format($report['gross_profit_margin'], 1) }}%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4. Laba Bersih Operasional (Green / Rose) -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="dash-kpi-card">
                <div class="dash-kpi-left">
                    <div class="dash-kpi-icon {{ $report['net_income'] >= 0 ? 'green' : 'rose' }}">
                        <i class="mdi mdi-trophy-outline"></i>
                    </div>
                    <div class="dash-kpi-info">
                        <div class="dash-kpi-label">Laba Bersih Operasional</div>
                        <div class="dash-kpi-val" style="color: {{ $report['net_income'] >= 0 ? '#16a34a' : '#e11d48' }};">
                            Rp {{ number_format($report['net_income'], 0, ',', '.') }}
                        </div>
                        <div class="dash-kpi-sub">
                            <span class="badge {{ $report['net_income'] >= 0 ? 'badge-soft-success' : 'badge-soft-danger' }}">
                                {{ $report['net_income'] >= 0 ? 'PROFIT' : 'DEFISIT' }} ({{ number_format($report['net_income_margin'], 1) }}%)
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter Card (Persis Catalog Unit & Arus Kas) --}}
    <div class="card compact-table-card filter-card mb-3">
        <div class="card-body">
            <form method="GET" action="{{ route('keuangan.laba-rugi.index') }}">
                <div class="row g-2 align-items-end">
                    <div class="col-12 col-sm-6 col-md-3">
                        <label class="form-label small fw-semibold text-secondary mb-1">Mulai Tanggal</label>
                        <input type="date" name="start_date" class="form-control" value="{{ $startDate }}">
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <label class="form-label small fw-semibold text-secondary mb-1">Sampai Tanggal</label>
                        <input type="date" name="end_date" class="form-control" value="{{ $endDate }}">
                    </div>
                    <div class="col-12 col-sm-6 col-md-4">
                        <label class="form-label small fw-semibold text-secondary mb-1">Filter Proyek / Landbank</label>
                        <select name="land_bank_id" class="form-select">
                            <option value="">Semua Proyek (Konsolidasi)</option>
                            @foreach($landBanks as $lb)
                                <option value="{{ $lb->id }}" {{ $landBankId == $lb->id ? 'selected' : '' }}>
                                    {{ $lb->nama_land_bank }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-sm-6 col-md-2 d-flex align-items-end gap-1">
                        <button type="submit" class="btn btn-gradient-primary btn-icon-only" title="Tampilkan Laporan">
                            <i class="mdi mdi-filter"></i>
                        </button>
                        <a href="{{ route('keuangan.laba-rugi.index') }}" class="btn btn-gradient-secondary btn-icon-only" title="Reset Filter">
                            <i class="mdi mdi-refresh"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Table Laba Rugi --}}
    <div class="card compact-table-card border-0 shadow-sm mb-4" style="border-radius: 6px !important; overflow: hidden;">
        <div class="table-responsive">
            <table class="table table-hover statement-table align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 15%;">Kode Akun</th>
                        <th>Keterangan / Pos Rekening</th>
                        <th style="width: 25%;" class="text-end">Jumlah (Rp)</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- 1. PENDAPATAN --}}
                    <tr class="category-header-row">
                        <td colspan="3"><i class="mdi mdi-plus-box text-success me-2"></i>1. PENDAPATAN USAHA (REVENUE)</td>
                    </tr>
                    @forelse($report['revenue_data'] as $rev)
                        <tr>
                            <td class="text-muted fw-semibold font-monospace">{{ $rev['account']->code }}</td>
                            <td class="ps-4">
                                <span class="fw-semibold text-dark">{{ $rev['account']->name }}</span>
                                <span class="text-muted small ms-2">({{ $rev['account']->sub_category }})</span>
                            </td>
                            <td class="text-end fw-semibold text-dark">
                                Rp {{ number_format($rev['balance'], 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-muted small ps-4 py-2">Belum ada pos pendapatan pada periode ini.</td>
                        </tr>
                    @endforelse
                    <tr class="subtotal-row">
                        <td colspan="2" class="text-end fw-bold text-dark">TOTAL PENDAPATAN:</td>
                        <td class="text-end fw-bold text-primary fs-6">
                            Rp {{ number_format($report['total_revenue'], 0, ',', '.') }}
                        </td>
                    </tr>

                    {{-- 2. HPP --}}
                    <tr class="category-header-row">
                        <td colspan="3"><i class="mdi mdi-minus-box text-warning me-2"></i>2. HARGA POKOK PENJUALAN (HPP PROYEK)</td>
                    </tr>
                    @forelse($report['cogs_data'] as $cogs)
                        <tr>
                            <td class="text-muted fw-semibold font-monospace">{{ $cogs['account']->code }}</td>
                            <td class="ps-4">
                                <span class="fw-semibold text-dark">{{ $cogs['account']->name }}</span>
                                <span class="text-muted small ms-2">({{ $cogs['account']->sub_category }})</span>
                            </td>
                            <td class="text-end fw-semibold text-danger">
                                (Rp {{ number_format($cogs['balance'], 0, ',', '.') }})
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-muted small ps-4 py-2">Belum ada realisasi HPP proyek pada periode ini.</td>
                        </tr>
                    @endforelse
                    <tr class="subtotal-row">
                        <td colspan="2" class="text-end fw-bold text-dark">TOTAL HARGA POKOK PENJUALAN (HPP):</td>
                        <td class="text-end fw-bold text-danger fs-6">
                            (Rp {{ number_format($report['total_cogs'], 0, ',', '.') }})
                        </td>
                    </tr>

                    {{-- 3. LABA KOTOR --}}
                    <tr class="gross-profit-row">
                        <td colspan="2" class="fw-bold">
                            <i class="mdi mdi-calculator me-2"></i>LABA KOTOR (GROSS PROFIT)
                            <small class="text-muted fw-normal ms-2">(Total Pendapatan - Total HPP)</small>
                        </td>
                        <td class="text-end fw-bold">
                            Rp {{ number_format($report['gross_profit'], 0, ',', '.') }}
                        </td>
                    </tr>

                    {{-- 4. BEBAN OPERASIONAL --}}
                    <tr class="category-header-row">
                        <td colspan="3"><i class="mdi mdi-minus-box text-danger me-2"></i>3. BEBAN OPERASIONAL & PEMASARAN</td>
                    </tr>
                    @forelse($report['expense_data'] as $exp)
                        <tr>
                            <td class="text-muted fw-semibold font-monospace">{{ $exp['account']->code }}</td>
                            <td class="ps-4">
                                <span class="fw-semibold text-dark">{{ $exp['account']->name }}</span>
                                <span class="text-muted small ms-2">({{ $exp['account']->sub_category }})</span>
                            </td>
                            <td class="text-end fw-semibold text-danger">
                                (Rp {{ number_format($exp['balance'], 0, ',', '.') }})
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-muted small ps-4 py-2">Belum ada beban operasional yang dicatat pada periode ini.</td>
                        </tr>
                    @endforelse
                    <tr class="subtotal-row">
                        <td colspan="2" class="text-end fw-bold text-dark">TOTAL BEBAN OPERASIONAL:</td>
                        <td class="text-end fw-bold text-danger fs-6">
                            (Rp {{ number_format($report['total_expense'], 0, ',', '.') }})
                        </td>
                    </tr>

                    {{-- 5. LABA BERSIH OPERASIONAL --}}
                    <tr class="{{ $report['net_income'] >= 0 ? 'net-profit-row' : 'net-deficit-row' }}">
                        <td colspan="2" class="fw-bold">
                            <i class="mdi mdi-trophy me-2"></i>LABA / (RUGI) BERSIH OPERASIONAL (NET OPERATING INCOME)
                            <small class="text-muted fw-normal ms-2">(Laba Kotor - Total Beban)</small>
                        </td>
                        <td class="text-end fw-bold">
                            Rp {{ number_format($report['net_income'], 0, ',', '.') }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

