@extends('layouts.partial.app')

@section('title', 'Laporan Laba Rugi - Sistem Keuangan ERP')

@push('styles')
<style>
    .header-card {
        border-radius: 12px;
        border: none;
        background: #ffffff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
    }
    .kpi-card {
        border-radius: 10px;
        border: 1px solid #edf2f7;
        background: #ffffff;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
        transition: all 0.25s ease;
    }
    .kpi-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 14px rgba(0, 0, 0, 0.07);
    }
    .kpi-icon-wrap {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.35rem;
    }
    .filter-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 1rem;
    }
    .filter-card .form-control,
    .filter-card .form-select {
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-size: 0.85rem;
    }
    .statement-table th {
        background-color: #f8fafc;
        font-size: 0.82rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .statement-table td {
        font-size: 0.88rem;
        vertical-align: middle;
        padding: 0.75rem 1rem;
    }
    .category-header-row {
        background-color: #f1f5f9;
        font-weight: 700;
        color: #1e293b;
    }
    .subtotal-row {
        background-color: #f8fafc;
        font-weight: 700;
        border-top: 1px dashed #cbd5e1;
    }
    .gross-profit-row {
        background-color: #eef2ff !important;
        font-weight: 800;
        color: #4338ca;
        font-size: 1rem;
    }
    .net-profit-row {
        background-color: #ecfdf5 !important;
        font-weight: 800;
        color: #065f46;
        font-size: 1.05rem;
    }
    .net-deficit-row {
        background-color: #fef2f2 !important;
        font-weight: 800;
        color: #991b1b;
        font-size: 1.05rem;
    }
    .badge-soft {
        border-radius: 6px;
        font-weight: 600;
        padding: 4px 8px;
        font-size: 0.76rem;
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
</style>
@endpush

@section('content')
<div class="container-fluid px-3 py-2">
    {{-- Header Banner --}}
    <div class="card header-card mb-3">
        <div class="card-body p-3">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <div>
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <span class="badge badge-soft-success"><i class="mdi mdi-chart-line me-1"></i>Profit & Loss Statement</span>
                        <span class="text-muted" style="font-size: 0.8rem;"><i class="mdi mdi-calendar-range me-1"></i>Periode: {{ date('d M Y', strtotime($startDate)) }} s/d {{ date('d M Y', strtotime($endDate)) }}</span>
                    </div>
                    <h4 class="mb-0 fw-bold text-dark">Laporan Laba Rugi (Income Statement)</h4>
                    <p class="text-muted mb-0 small">Kinerja operasional, margin laba kotor proyek, dan laba bersih perusahaan secara akrual.</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('keuangan.laba-rugi.cetak', request()->query()) }}" target="_blank" class="btn btn-outline-secondary btn-sm fw-semibold px-3 py-2">
                        <i class="mdi mdi-printer me-1"></i> Cetak Laba Rugi
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- KPI Cards --}}
    <div class="row g-3 mb-3">
        <div class="col-6 col-lg-3">
            <div class="card kpi-card p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted d-block small mb-1">Total Pendapatan (Revenue)</span>
                        <h4 class="fw-bold mb-0 text-primary">Rp {{ number_format($report['total_revenue'], 0, ',', '.') }}</h4>
                        <span class="badge badge-soft-primary mt-1">Penjualan Properti</span>
                    </div>
                    <div class="kpi-icon-wrap bg-primary-subtle text-primary">
                        <i class="mdi mdi-cash-multiple"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="card kpi-card p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted d-block small mb-1">Total HPP Proyek (COGS)</span>
                        <h4 class="fw-bold mb-0 text-warning text-dark">Rp {{ number_format($report['total_cogs'], 0, ',', '.') }}</h4>
                        <span class="text-muted small" style="font-size: 0.72rem;">Lahan + SPK Unit + Infra</span>
                    </div>
                    <div class="kpi-icon-wrap bg-warning-subtle text-warning">
                        <i class="mdi mdi-tools"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="card kpi-card p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted d-block small mb-1">Laba Kotor (Gross Profit)</span>
                        <h4 class="fw-bold mb-0 text-info">Rp {{ number_format($report['gross_profit'], 0, ',', '.') }}</h4>
                        <span class="badge badge-soft-success mt-1">Margin: {{ number_format($report['gross_profit_margin'], 1) }}%</span>
                    </div>
                    <div class="kpi-icon-wrap bg-info-subtle text-info">
                        <i class="mdi mdi-chart-areaspline"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="card kpi-card p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted d-block small mb-1">Laba Bersih Operasional</span>
                        <h4 class="fw-bold mb-0 {{ $report['net_income'] >= 0 ? 'text-success' : 'text-danger' }}">
                            Rp {{ number_format($report['net_income'], 0, ',', '.') }}
                        </h4>
                        <span class="badge {{ $report['net_income'] >= 0 ? 'badge-soft-success' : 'badge-soft-danger' }} mt-1">
                            {{ $report['net_income'] >= 0 ? 'PROFIT' : 'DEFISIT' }} ({{ number_format($report['net_income_margin'], 1) }}%)
                        </span>
                    </div>
                    <div class="kpi-icon-wrap {{ $report['net_income'] >= 0 ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }}">
                        <i class="mdi mdi-trophy-outline"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter Card --}}
    <div class="card filter-card mb-3">
        <form method="GET" action="{{ route('keuangan.laba-rugi.index') }}">
            <div class="row g-2 align-items-end">
                <div class="col-12 col-md-3">
                    <label class="form-label small fw-semibold text-secondary mb-1">Mulai Tanggal</label>
                    <input type="date" name="start_date" class="form-control" value="{{ $startDate }}">
                </div>
                <div class="col-12 col-md-3">
                    <label class="form-label small fw-semibold text-secondary mb-1">Sampai Tanggal</label>
                    <input type="date" name="end_date" class="form-control" value="{{ $endDate }}">
                </div>
                <div class="col-12 col-md-4">
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
                <div class="col-12 col-md-2 d-flex gap-1">
                    <button type="submit" class="btn btn-primary btn-sm w-100 py-2 fw-semibold">
                        <i class="mdi mdi-filter me-1"></i> Tampilkan
                    </button>
                    <a href="{{ route('keuangan.laba-rugi.index') }}" class="btn btn-light btn-sm px-2 py-2" title="Reset Filter">
                        <i class="mdi mdi-refresh"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>

    {{-- Table Laba Rugi --}}
    <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px; overflow: hidden;">
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
