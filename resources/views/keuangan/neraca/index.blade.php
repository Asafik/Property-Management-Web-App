@extends('layouts.partial.app')

@section('title', 'Neraca Keuangan (Balance Sheet) - Sistem Keuangan ERP')

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
    .neraca-box {
        background: #ffffff;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        overflow: hidden;
        box-shadow: 0 2px 6px rgba(0,0,0,0.03);
    }
    .neraca-header {
        padding: 0.85rem 1.25rem;
        font-weight: 700;
        font-size: 0.95rem;
        border-bottom: 2px solid #e2e8f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .neraca-section-title {
        background: #f8fafc;
        padding: 0.5rem 1.25rem;
        font-size: 0.82rem;
        font-weight: 700;
        text-transform: uppercase;
        color: #475569;
        letter-spacing: 0.5px;
        border-bottom: 1px solid #edf2f7;
    }
    .neraca-item {
        padding: 0.65rem 1.25rem;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.86rem;
    }
    .neraca-item:hover {
        background: #fbfcfe;
    }
    .neraca-subtotal {
        padding: 0.75rem 1.25rem;
        background: #f8fafc;
        font-weight: 700;
        font-size: 0.9rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px dashed #cbd5e1;
    }
    .neraca-total-box {
        padding: 1rem 1.25rem;
        font-weight: 800;
        font-size: 1.05rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
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
                        <span class="badge badge-soft-primary"><i class="mdi mdi-scale-balance me-1"></i>Posisi Keuangan</span>
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
                    <a href="{{ route('keuangan.neraca.cetak', request()->query()) }}" target="_blank" class="btn btn-outline-secondary btn-sm fw-semibold px-3 py-2">
                        <i class="mdi mdi-printer me-1"></i> Cetak Neraca
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- KPI Cards --}}
    <div class="row g-3 mb-3">
        <div class="col-12 col-md-4">
            <div class="card kpi-card p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted d-block small mb-1">Total Aset (Aktiva)</span>
                        <h4 class="fw-bold mb-0 text-primary">Rp {{ number_format($report['total_assets'], 0, ',', '.') }}</h4>
                        <span class="badge badge-soft-primary mt-1">Kas + Piutang + Persediaan</span>
                    </div>
                    <div class="kpi-icon-wrap bg-primary-subtle text-primary">
                        <i class="mdi mdi-domain"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card kpi-card p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted d-block small mb-1">Total Kewajiban (Liabilitas)</span>
                        <h4 class="fw-bold mb-0 text-danger">Rp {{ number_format($report['total_liabilities'], 0, ',', '.') }}</h4>
                        <span class="badge badge-soft-danger mt-1">Hutang SPK & Uang Muka</span>
                    </div>
                    <div class="kpi-icon-wrap bg-danger-subtle text-danger">
                        <i class="mdi mdi-file-document-alert-outline"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card kpi-card p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted d-block small mb-1">Total Ekuitas & Laba</span>
                        <h4 class="fw-bold mb-0 text-success">Rp {{ number_format($report['total_equity'], 0, ',', '.') }}</h4>
                        <span class="badge badge-soft-success mt-1">Modal + Laba Berjalan</span>
                    </div>
                    <div class="kpi-icon-wrap bg-success-subtle text-success">
                        <i class="mdi mdi-shield-account-outline"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter Panel --}}
    <div class="card filter-card mb-3">
        <form method="GET" action="{{ route('keuangan.neraca.index') }}">
            <div class="row g-2 align-items-end">
                <div class="col-12 col-md-5">
                    <label class="form-label small fw-semibold text-secondary mb-1">Posisi Neraca Per Tanggal</label>
                    <input type="date" name="as_of_date" class="form-control" value="{{ $asOfDate }}">
                </div>
                <div class="col-12 col-md-5">
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
                    <a href="{{ route('keuangan.neraca.index') }}" class="btn btn-light btn-sm px-2 py-2" title="Reset Filter">
                        <i class="mdi mdi-refresh"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>

    {{-- Dual Column Neraca (Skontro) --}}
    <div class="row g-3 mb-4">
        {{-- KOLOM KIRI: ASET (AKTIVA) --}}
        <div class="col-12 col-lg-6">
            <div class="neraca-box h-100 d-flex flex-column">
                <div class="neraca-header bg-primary text-white">
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
                    <div class="neraca-total-box bg-primary text-white">
                        <span>TOTAL ASET (AKTIVA):</span>
                        <span>Rp {{ number_format($report['total_assets'], 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- KOLOM KANAN: KEWAJIBAN & EKUITAS (PASIVA) --}}
        <div class="col-12 col-lg-6">
            <div class="neraca-box h-100 d-flex flex-column">
                <div class="neraca-header bg-dark text-white">
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
                    <div class="neraca-total-box bg-dark text-white">
                        <span>TOTAL KEWAJIBAN & EKUITAS:</span>
                        <span>Rp {{ number_format($report['total_liabilities_and_equity'], 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
