@extends('layouts.partial.app')

@section('title', 'Laporan Arus Kas (Cash Flow) - Sistem Keuangan ERP')

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
    .statement-section {
        background: #ffffff;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        overflow: hidden;
        margin-bottom: 1.25rem;
    }
    .statement-header {
        background: #f8fafc;
        padding: 0.85rem 1.25rem;
        font-weight: 700;
        font-size: 0.95rem;
        border-bottom: 2px solid #e2e8f0;
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
    <div class="card header-card mb-3">
        <div class="card-body p-3">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <div>
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <span class="badge badge-soft-primary"><i class="mdi mdi-cash-fast me-1"></i>Arus Kas Terintegrasi</span>
                        <span class="text-muted" style="font-size: 0.8rem;"><i class="mdi mdi-calendar me-1"></i>{{ date('d M Y', strtotime($startDate)) }} s/d {{ date('d M Y', strtotime($endDate)) }}</span>
                    </div>
                    <h4 class="mb-0 fw-bold text-dark">Laporan Arus Kas (Cash Flow)</h4>
                    <p class="text-muted mb-0 small">Memantau likuiditas kas masuk, kas keluar proyek, dan saldo kas rill perusahaan.</p>
                </div>
                <div class="d-flex flex-wrap align-items-center gap-2">
                    {{-- Tombol BKM --}}
                    <button type="button" class="btn btn-success btn-sm fw-semibold px-3 py-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalKasMasuk">
                        <i class="mdi mdi-arrow-down-bold-circle me-1"></i> + Kas Masuk (BKM)
                    </button>

                    {{-- Tombol BKK --}}
                    <button type="button" class="btn btn-danger btn-sm fw-semibold px-3 py-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalKasKeluar">
                        <i class="mdi mdi-arrow-up-bold-circle me-1"></i> + Kas Keluar (BKK)
                    </button>

                    {{-- Tombol Cetak --}}
                    <a href="{{ route('keuangan.arus-kas.cetak', request()->query()) }}" target="_blank" class="btn btn-outline-secondary btn-sm fw-semibold px-3 py-2">
                        <i class="mdi mdi-printer me-1"></i> Cetak Arus Kas
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Flash Notifications --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
            <i class="mdi mdi-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
            <i class="mdi mdi-alert-circle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- KPI Cards --}}
    <div class="row g-3 mb-3">
        <div class="col-6 col-lg-3">
            <div class="card kpi-card p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted d-block small mb-1">Saldo Awal Kas</span>
                        <h4 class="fw-bold mb-0 text-dark">Rp {{ number_format($report['saldo_awal'], 0, ',', '.') }}</h4>
                        <span class="text-muted small" style="font-size: 0.72rem;">Sebelum {{ date('d M Y', strtotime($startDate)) }}</span>
                    </div>
                    <div class="kpi-icon-wrap bg-secondary-subtle text-secondary">
                        <i class="mdi mdi-wallet-outline"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="card kpi-card p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted d-block small mb-1">Total Kas Masuk (Inflow)</span>
                        <h4 class="fw-bold mb-0 text-success">+ Rp {{ number_format($report['total_inflow'], 0, ',', '.') }}</h4>
                        <span class="badge badge-soft-success mt-1">Penerimaan Dana</span>
                    </div>
                    <div class="kpi-icon-wrap bg-success-subtle text-success">
                        <i class="mdi mdi-arrow-down-bold"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="card kpi-card p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted d-block small mb-1">Total Kas Keluar (Outflow)</span>
                        <h4 class="fw-bold mb-0 text-danger">- Rp {{ number_format($report['total_outflow'], 0, ',', '.') }}</h4>
                        <span class="badge badge-soft-danger mt-1">Pengeluaran Kas/Bank</span>
                    </div>
                    <div class="kpi-icon-wrap bg-danger-subtle text-danger">
                        <i class="mdi mdi-arrow-up-bold"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="card kpi-card p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted d-block small mb-1">Saldo Kas Akhir</span>
                        <h4 class="fw-bold mb-0 text-primary">Rp {{ number_format($report['saldo_akhir'], 0, ',', '.') }}</h4>
                        <span class="badge badge-soft-primary mt-1">
                            Net Flow: {{ $report['net_cash_flow'] >= 0 ? '+' : '' }}Rp {{ number_format($report['net_cash_flow'], 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="kpi-icon-wrap bg-primary-subtle text-primary">
                        <i class="mdi mdi-safe"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter Panel --}}
    <div class="card filter-card mb-3">
        <form method="GET" action="{{ route('keuangan.arus-kas.index') }}">
            <input type="hidden" name="tab" value="{{ $tab }}">
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
                    <a href="{{ route('keuangan.arus-kas.index') }}" class="btn btn-light btn-sm px-2 py-2" title="Reset Filter">
                        <i class="mdi mdi-refresh"></i>
                    </a>
                </div>
            </div>
            <div class="d-flex align-items-center gap-1 mt-2 pt-2 border-top flex-wrap">
                <span class="small text-muted me-2" style="font-size: 0.74rem;">Preset Periode:</span>
                <button type="button" class="btn btn-sm btn-outline-secondary py-0 px-2" style="font-size: 0.72rem; border-radius: 4px;" onclick="setPreset('this_month')">Bulan Ini</button>
                <button type="button" class="btn btn-sm btn-outline-primary py-0 px-2" style="font-size: 0.72rem; border-radius: 4px;" onclick="setPreset('ytd')">Tahun Berjalan (YTD)</button>
                <button type="button" class="btn btn-sm btn-outline-secondary py-0 px-2" style="font-size: 0.72rem; border-radius: 4px;" onclick="setPreset('all')">Semua Transaksi</button>
                <span class="ms-auto text-muted small" style="font-size: 0.72rem;">
                    <i class="mdi mdi-information-outline me-1"></i>Periode aktif: <strong class="text-dark">{{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }}</strong> s/d <strong class="text-dark">{{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}</strong>
                </span>
            </div>
        </form>
    </div>

    {{-- Nav Tabs --}}
    <ul class="nav nav-pills mb-3" id="cashFlowTabs" role="tablist">
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
                <div class="card border-0 shadow-sm mb-4" style="border-radius: 10px; background: #f8fafc; border: 1px solid #cbd5e1 !important;">
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
        <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
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

{{-- Modal Kas Masuk (BKM) --}}
<div class="modal fade" id="modalKasMasuk" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <form action="{{ route('keuangan.arus-kas.store-manual') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="voucher_type" value="BKM">
                <div class="modal-header bg-success text-white p-3">
                    <h5 class="modal-title fw-bold">
                        <i class="mdi mdi-arrow-down-bold-circle-outline me-1"></i> Catat Kas Masuk (BKM)
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">Tanggal Penerimaan <span class="text-danger">*</span></label>
                        <input type="date" name="entry_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">Masuk ke Rekening / Kas <span class="text-danger">*</span></label>
                        <select name="cash_bank_account_id" class="form-select" required>
                            @foreach($cashBankAccounts as $cb)
                                <option value="{{ $cb->id }}">[{{ $cb->code }}] {{ $cb->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">Sumber Pendapatan / Akun Lawan <span class="text-danger">*</span></label>
                        <select name="contra_account_id" class="form-select" required>
                            <option value="">-- Pilih Sumber Pendapatan / Akun --</option>
                            @foreach($contraAccounts as $ca)
                                <option value="{{ $ca->id }}">[{{ $ca->code }}] {{ $ca->name }} ({{ $ca->sub_category }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">Kategori Aktivitas Arus Kas <span class="text-danger">*</span></label>
                        <select name="cash_flow_category" class="form-select" required>
                            <option value="operating" selected>Operasional (Penerimaan Usaha / Konsumen)</option>
                            <option value="financing">Pendanaan (Modal Pemilik / Pencairan Bank)</option>
                            <option value="investing">Investasi (Penjualan Aset)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">Nominal Diterima (Rp) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text fw-bold">Rp</span>
                            <input type="number" name="amount" class="form-control fw-bold" placeholder="0" min="1" step="any" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">Diterima Dari (Nama)</label>
                        <input type="text" name="party_name" class="form-control" placeholder="Nama konsumen / pihak pembayar">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">Alokasi Proyek</label>
                        <select name="land_bank_id" class="form-select">
                            <option value="">Kantor Pusat / Umum</option>
                            @foreach($landBanks as $lb)
                                <option value="{{ $lb->id }}">{{ $lb->nama_land_bank }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">Keterangan / Uraian <span class="text-danger">*</span></label>
                        <textarea name="description" class="form-control" rows="2" placeholder="Uraian detail penerimaan kas..." required></textarea>
                    </div>
                    <div class="mb-0">
                        <label class="form-label small fw-semibold text-secondary">Lampiran Bukti (Struk/Kwitansi/Slip)</label>
                        <input type="file" name="proof_file" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                    </div>
                </div>
                <div class="modal-footer bg-light p-3">
                    <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success btn-sm px-4 fw-semibold">
                        <i class="mdi mdi-content-save me-1"></i> Simpan Kas Masuk
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Kas Keluar (BKK) --}}
<div class="modal fade" id="modalKasKeluar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <form action="{{ route('keuangan.arus-kas.store-manual') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="voucher_type" value="BKK">
                <div class="modal-header bg-danger text-white p-3">
                    <h5 class="modal-title fw-bold">
                        <i class="mdi mdi-arrow-up-bold-circle-outline me-1"></i> Catat Kas Keluar (BKK)
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">Tanggal Pengeluaran <span class="text-danger">*</span></label>
                        <input type="date" name="entry_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">Dikeluarkan Dari Rekening / Kas <span class="text-danger">*</span></label>
                        <select name="cash_bank_account_id" class="form-select" required>
                            @foreach($cashBankAccounts as $cb)
                                <option value="{{ $cb->id }}">[{{ $cb->code }}] {{ $cb->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">Tujuan Beban / Akun Biaya <span class="text-danger">*</span></label>
                        <select name="contra_account_id" class="form-select" required>
                            <option value="">-- Pilih Akun Biaya / Beban / HPP --</option>
                            @foreach($contraAccounts as $ca)
                                <option value="{{ $ca->id }}">[{{ $ca->code }}] {{ $ca->name }} ({{ $ca->sub_category }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">Kategori Aktivitas Arus Kas <span class="text-danger">*</span></label>
                        <select name="cash_flow_category" class="form-select" required>
                            <option value="operating" selected>Operasional (Beban Kantor, Gaji, Legalitas)</option>
                            <option value="investing">Investasi / Proyek (Lahan, SPK Unit, Infrastruktur)</option>
                            <option value="financing">Pendanaan (Pembayaran Hutang Pokok, Prive)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">Nominal Pengeluaran (Rp) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text fw-bold">Rp</span>
                            <input type="number" name="amount" class="form-control fw-bold" placeholder="0" min="1" step="any" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">Dibayarkan Kepada</label>
                        <input type="text" name="party_name" class="form-control" placeholder="Nama vendor / mandor / penerima">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">Alokasi Proyek</label>
                        <select name="land_bank_id" class="form-select">
                            <option value="">Kantor Pusat / Umum</option>
                            @foreach($landBanks as $lb)
                                <option value="{{ $lb->id }}">{{ $lb->nama_land_bank }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">Keterangan / Uraian <span class="text-danger">*</span></label>
                        <textarea name="description" class="form-control" rows="2" placeholder="Uraian detail keperluan pengeluaran dana..." required></textarea>
                    </div>
                    <div class="mb-0">
                        <label class="form-label small fw-semibold text-secondary">Lampiran Bukti (Struk/Nota/Kwitansi)</label>
                        <input type="file" name="proof_file" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                    </div>
                </div>
                <div class="modal-footer bg-light p-3">
                    <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger btn-sm px-4 fw-semibold">
                        <i class="mdi mdi-content-save me-1"></i> Simpan Kas Keluar
                    </button>
                </div>
            </form>
        </div>
    </div>
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
