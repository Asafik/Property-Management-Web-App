@extends('layouts.partial.app')

@section('title', 'Neraca Keuangan (Balance Sheet) - Sistem Keuangan ERP')

@push('styles')
<style>
    /* Card Dasar Konsisten */
    .ak-card {
        border-radius: 6px !important;
        border: 1px solid #e2e8f0 !important;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04) !important;
        background: #ffffff;
    }

    /* 3 KPI Cards (Persis Dashboard, Arus Kas & Jurnal Umum) */
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

    /* Neraca Skontro Boxes */
    .neraca-box {
        background: #ffffff;
        border-radius: 6px !important;
        border: 1px solid #e2e8f0;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
    }
    .neraca-header {
        padding: 0.85rem 1.25rem;
        font-weight: 700;
        font-size: 0.92rem;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        letter-spacing: 0.3px;
    }
    .neraca-header-aktiva {
        background: #9a55ff;
        color: #ffffff;
    }
    .neraca-header-pasiva {
        background: #334155;
        color: #ffffff;
    }
    .neraca-section-title {
        background: #f8fafc;
        padding: 0.55rem 1.25rem;
        font-size: 0.78rem;
        font-weight: 700;
        text-transform: uppercase;
        color: #475569;
        letter-spacing: 0.5px;
        border-bottom: 1px solid #edf2f7;
        border-top: 1px solid #edf2f7;
    }
    .neraca-item {
        padding: 0.65rem 1.25rem;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.86rem;
        transition: background 0.15s ease;
    }
    .neraca-item:hover {
        background: #f8fafc;
    }
    .neraca-subtotal {
        padding: 0.75rem 1.25rem;
        background: #f8fafc;
        font-weight: 700;
        font-size: 0.88rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px dashed #cbd5e1;
    }
    .neraca-total-box {
        padding: 0.9rem 1.25rem;
        font-weight: 800;
        font-size: 1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .neraca-total-aktiva {
        background: #9a55ff;
        color: #ffffff;
    }
    .neraca-total-pasiva {
        background: #334155;
        color: #ffffff;
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
                        <span class="text-muted" style="font-size: 0.8rem;"><i class="mdi mdi-calendar-check me-1"></i>Per Tanggal: {{ date('d F Y', strtotime($asOfDate)) }}</span>
                        @if($report['is_balanced'])
                            <span class="badge badge-soft-success"><i class="mdi mdi-check-circle me-1"></i>SEIMBANG (BALANCED)</span>
                        @else
                            <span class="badge badge-soft-danger"><i class="mdi mdi-alert-circle me-1"></i>SELISIH Rp {{ number_format(abs($report['difference']), 0, ',', '.') }}</span>
                        @endif
                    </div>
                    <h4 class="mb-0 fw-bold text-dark">Neraca Keuangan (Balance Sheet)</h4>
                    <p class="text-muted mb-0 small">Menampilkan struktur posisi aset properti, kewajiban mandor/vendor, dan ekuitas modal pemilik.</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('keuangan.neraca.cetak', request()->query()) }}" target="_blank" class="btn btn-outline-neutral btn-sm px-3 py-2">
                        <i class="mdi mdi-printer me-1"></i> Cetak Neraca
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- 3 KPI Cards (Persis Style Dashboard & Arus Kas) --}}
    <div class="row g-3 mb-3">
        <!-- 1. Total Aset / Aktiva (Purple) -->
        <div class="col-12 col-md-4">
            <div class="dash-kpi-card">
                <div class="dash-kpi-left">
                    <div class="dash-kpi-icon purple">
                        <i class="mdi mdi-domain"></i>
                    </div>
                    <div class="dash-kpi-info">
                        <div class="dash-kpi-label">Total Aset (Aktiva)</div>
                        <div class="dash-kpi-val" style="color: #9333ea;">Rp {{ number_format($report['total_assets'], 0, ',', '.') }}</div>
                        <div class="dash-kpi-sub">
                            <span class="badge badge-soft-primary">Kas + Piutang + Persediaan</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. Total Kewajiban / Liabilitas (Rose) -->
        <div class="col-12 col-md-4">
            <div class="dash-kpi-card">
                <div class="dash-kpi-left">
                    <div class="dash-kpi-icon rose">
                        <i class="mdi mdi-file-document-alert-outline"></i>
                    </div>
                    <div class="dash-kpi-info">
                        <div class="dash-kpi-label">Total Kewajiban (Liabilitas)</div>
                        <div class="dash-kpi-val" style="color: #e11d48;">Rp {{ number_format($report['total_liabilities'], 0, ',', '.') }}</div>
                        <div class="dash-kpi-sub">
                            <span class="badge badge-soft-danger">Hutang SPK & Uang Muka</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. Total Ekuitas & Laba (Green) -->
        <div class="col-12 col-md-4">
            <div class="dash-kpi-card">
                <div class="dash-kpi-left">
                    <div class="dash-kpi-icon green">
                        <i class="mdi mdi-shield-account-outline"></i>
                    </div>
                    <div class="dash-kpi-info">
                        <div class="dash-kpi-label">Total Ekuitas & Laba</div>
                        <div class="dash-kpi-val" style="color: #16a34a;">Rp {{ number_format($report['total_equity'], 0, ',', '.') }}</div>
                        <div class="dash-kpi-sub">
                            <span class="badge badge-soft-success">Modal + Laba Berjalan</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter Panel (Persis Catalog Unit & Arus Kas) --}}
    <div class="card compact-table-card filter-card mb-3">
        <div class="card-body">
            <form method="GET" action="{{ route('keuangan.neraca.index') }}">
                <div class="row g-2 align-items-end">
                    <div class="col-12 col-sm-6 col-md-5">
                        <label class="form-label small fw-semibold text-secondary mb-1">Posisi Neraca Per Tanggal</label>
                        <input type="date" name="as_of_date" class="form-control" value="{{ $asOfDate }}">
                    </div>
                    <div class="col-12 col-sm-6 col-md-5">
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
                        <button type="submit" class="btn btn-gradient-primary btn-icon-only" title="Tampilkan Posisi">
                            <i class="mdi mdi-filter"></i>
                        </button>
                        <a href="{{ route('keuangan.neraca.index') }}" class="btn btn-gradient-secondary btn-icon-only" title="Reset Filter">
                            <i class="mdi mdi-refresh"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Dual Column Neraca (Skontro) --}}
    <div class="row g-3 mb-4">
        {{-- KOLOM KIRI: ASET (AKTIVA) --}}
        <div class="col-12 col-lg-6">
            <div class="neraca-box h-100 d-flex flex-column">
                <div class="neraca-header neraca-header-aktiva">
                    <span><i class="mdi mdi-arrow-down-bold-box-outline me-2"></i>ASET (AKTIVA)</span>
                    <span class="fs-6 fw-bold">Rp {{ number_format($report['total_assets'], 0, ',', '.') }}</span>
                </div>

                {{-- 1. Aset Lancar --}}
                <div class="neraca-section-title">
                    <i class="mdi mdi-cash-multiple me-1 text-primary"></i> 1. ASET LANCAR
                </div>
                @php $subtotalCurrent = 0; @endphp
                @forelse($report['assets_current'] as $item)
                    @php $subtotalCurrent += $item['balance']; @endphp
                    <div class="neraca-item">
                        <div>
                            <span class="text-muted font-monospace small me-2">{{ $item['account']->code }}</span>
                            <span class="fw-semibold text-dark">{{ $item['account']->name }}</span>
                        </div>
                        <span class="fw-bold text-dark">Rp {{ number_format($item['balance'], 0, ',', '.') }}</span>
                    </div>
                @empty
                    <div class="neraca-item text-muted small ps-4">Belum ada saldo akun aset lancar.</div>
                @endforelse
                <div class="neraca-subtotal text-primary">
                    <span>Subtotal Aset Lancar:</span>
                    <span>Rp {{ number_format($subtotalCurrent, 0, ',', '.') }}</span>
                </div>

                {{-- 2. Persediaan Properti & Proyek --}}
                <div class="neraca-section-title mt-2">
                    <i class="mdi mdi-home-city-outline me-1 text-primary"></i> 2. PERSEDIAAN PROPERTI & PROYEK (WIP)
                </div>
                @php $subtotalProject = 0; @endphp
                @forelse($report['assets_project'] as $item)
                    @php $subtotalProject += $item['balance']; @endphp
                    <div class="neraca-item">
                        <div>
                            <span class="text-muted font-monospace small me-2">{{ $item['account']->code }}</span>
                            <span class="fw-semibold text-dark">{{ $item['account']->name }}</span>
                        </div>
                        <span class="fw-bold text-dark">Rp {{ number_format($item['balance'], 0, ',', '.') }}</span>
                    </div>
                @empty
                    <div class="neraca-item text-muted small ps-4">Belum ada saldo persediaan properti.</div>
                @endforelse
                <div class="neraca-subtotal text-primary">
                    <span>Subtotal Persediaan Properti:</span>
                    <span>Rp {{ number_format($subtotalProject, 0, ',', '.') }}</span>
                </div>

                <div class="mt-auto">
                    <div class="neraca-total-box neraca-total-aktiva">
                        <span>TOTAL ASET (AKTIVA):</span>
                        <span>Rp {{ number_format($report['total_assets'], 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- KOLOM KANAN: KEWAJIBAN & EKUITAS (PASIVA) --}}
        <div class="col-12 col-lg-6">
            <div class="neraca-box h-100 d-flex flex-column">
                <div class="neraca-header neraca-header-pasiva">
                    <span><i class="mdi mdi-arrow-up-bold-box-outline me-2"></i>KEWAJIBAN & EKUITAS (PASIVA)</span>
                    <span class="fs-6 fw-bold">Rp {{ number_format($report['total_liabilities_and_equity'], 0, ',', '.') }}</span>
                </div>

                {{-- 1. Kewajiban (Liabilitas) --}}
                <div class="neraca-section-title">
                    <i class="mdi mdi-alert-circle-outline me-1 text-danger"></i> 1. KEWAJIBAN JANGKA PENDEK (LIABILITAS)
                </div>
                @forelse($report['liabilities'] as $item)
                    <div class="neraca-item">
                        <div>
                            <span class="text-muted font-monospace small me-2">{{ $item['account']->code }}</span>
                            <span class="fw-semibold text-dark">{{ $item['account']->name }}</span>
                        </div>
                        <span class="fw-bold text-danger">Rp {{ number_format($item['balance'], 0, ',', '.') }}</span>
                    </div>
                @empty
                    <div class="neraca-item text-muted small ps-4">Tidak ada kewajiban lancar tercatat.</div>
                @endforelse
                <div class="neraca-subtotal text-danger">
                    <span>Subtotal Kewajiban:</span>
                    <span>Rp {{ number_format($report['total_liabilities'], 0, ',', '.') }}</span>
                </div>

                {{-- 2. Ekuitas (Modal) --}}
                <div class="neraca-section-title mt-2">
                    <i class="mdi mdi-shield-check-outline me-1 text-success"></i> 2. EKUITAS & MODAL PEMILIK
                </div>
                @forelse($report['equity'] as $item)
                    <div class="neraca-item">
                        <div>
                            <span class="text-muted font-monospace small me-2">{{ $item['account']->code }}</span>
                            <span class="fw-semibold text-dark">{{ $item['account']->name }}</span>
                        </div>
                        <span class="fw-bold {{ $item['balance'] >= 0 ? 'text-success' : 'text-danger' }}">
                            Rp {{ number_format($item['balance'], 0, ',', '.') }}
                        </span>
                    </div>
                @empty
                    <div class="neraca-item text-muted small ps-4">Tidak ada saldo akun ekuitas.</div>
                @endforelse
                <div class="neraca-subtotal text-success">
                    <span>Subtotal Ekuitas:</span>
                    <span>Rp {{ number_format($report['total_equity'], 0, ',', '.') }}</span>
                </div>

                <div class="mt-auto">
                    <div class="neraca-total-box neraca-total-pasiva">
                        <span>TOTAL KEWAJIBAN & EKUITAS:</span>
                        <span>Rp {{ number_format($report['total_liabilities_and_equity'], 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

