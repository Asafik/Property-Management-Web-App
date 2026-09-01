@extends('layouts.partial.app')

@section('title', 'Project Accounting & HPP - Sistem Keuangan ERP')

@push('styles')
<style>
    .kpi-card {
        border-radius: 12px;
        border: none;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        overflow: hidden;
        position: relative;
    }
    .kpi-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }
    .kpi-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
    }
    .kpi-card.kpi-revenue::before { background: #4b49ac; }
    .kpi-card.kpi-inflow::before { background: #10b981; }
    .kpi-card.kpi-cost::before { background: #f59e0b; }
    .kpi-card.kpi-outflow::before { background: #ef4444; }
    .kpi-card.kpi-profit::before { background: #8b5cf6; }
    .kpi-card.kpi-cashflow::before { background: #06b6d4; }

    .kpi-icon-wrap {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .erp-tab-btn {
        border-radius: 8px;
        font-weight: 600;
        padding: 10px 20px;
        color: #64748b;
        border: 1px solid transparent;
        background: transparent;
        transition: all 0.2s ease;
    }
    .erp-tab-btn:hover {
        color: #4b49ac;
        background: #f1f5f9;
    }
    .erp-tab-btn.active {
        color: #ffffff !important;
        background: #4b49ac !important;
        box-shadow: 0 4px 12px rgba(75, 73, 172, 0.3);
    }

    .table-erp th {
        background-color: #f8fafc;
        color: #475569;
        font-weight: 700;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e2e8f0;
        white-space: nowrap;
    }
    .table-erp td {
        vertical-align: middle;
        font-size: 0.85rem;
    }

    .badge-pill-soft {
        padding: 4px 10px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.75rem;
    }
    .badge-soft-success { background: #dcfce7; color: #15803d; }
    .badge-soft-primary { background: #e0e7ff; color: #4338ca; }
    .badge-soft-warning { background: #fef3c7; color: #b45309; }
    .badge-soft-danger { background: #fee2e2; color: #b91c1c; }
    .badge-soft-info { background: #cffafe; color: #0e7490; }

    .progress-thin {
        height: 6px;
        border-radius: 3px;
        background-color: #e2e8f0;
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-3">
    <!-- Header Page -->
    <div class="row align-items-center mb-4">
        <div class="col-md-7">
            <div class="d-flex align-items-center gap-3">
                <div class="bg-primary text-white p-3 rounded-3 shadow-sm d-flex align-items-center justify-content-center" style="width: 52px; height: 52px;">
                    <i class="mdi mdi-finance fs-3"></i>
                </div>
                <div>
                    <h4 class="fw-bold mb-1" style="color: #1e293b;">Project Accounting & HPP Ledger</h4>
                    <p class="text-muted small mb-0">
                        ERP Penelusuran Biaya Proyek, Rincian HPP Kavling, SPK Kontraktor, RAB, dan Laba Rugi Real-Time
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-5 text-md-end mt-3 mt-md-0">
            <a href="{{ route('keuangan.project-accounting.cetak', request()->all()) }}" target="_blank" class="btn btn-outline-primary me-2 shadow-sm">
                <i class="mdi mdi-printer me-1"></i> Cetak Laporan ERP
            </a>
            <a href="{{ route('keuangan.master-invoice.index') }}" class="btn btn-primary shadow-sm">
                <i class="mdi mdi-receipt me-1"></i> Master Invoice
            </a>
        </div>
    </div>

    <!-- KPI Metrics Executive Summary -->
    <div class="row g-3 mb-4">
        <!-- 1. Revenue -->
        <div class="col-xl-2 col-md-4 col-sm-6">
            <div class="card kpi-card kpi-revenue p-3 h-100">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <span class="text-muted small fw-bold">TOTAL REVENUE (OMSET)</span>
                    <div class="kpi-icon-wrap bg-soft-primary text-primary" style="background:#eef2ff; color:#4b49ac;">
                        <i class="mdi mdi-cash-multiple"></i>
                    </div>
                </div>
                <h5 class="fw-bold text-dark mb-1 font-monospace">Rp {{ number_format($summary['total_revenue_potential'], 0, ',', '.') }}</h5>
                <small class="text-muted">{{ $summary['total_units_sold'] }} dari {{ $summary['total_units_count'] }} unit terjual</small>
            </div>
        </div>

        <!-- 2. Cash Inflow -->
        <div class="col-xl-2 col-md-4 col-sm-6">
            <div class="card kpi-card kpi-inflow p-3 h-100">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <span class="text-muted small fw-bold">KAS MASUK (INFLOW)</span>
                    <div class="kpi-icon-wrap" style="background:#ecfdf5; color:#10b981;">
                        <i class="mdi mdi-arrow-bottom-left-bold-outline"></i>
                    </div>
                </div>
                <h5 class="fw-bold text-success mb-1 font-monospace">Rp {{ number_format($summary['total_cash_inflow'], 0, ',', '.') }}</h5>
                <small class="text-muted">Realisasi bayar dari konsumen</small>
            </div>
        </div>

        <!-- 3. Total HPP Komitmen -->
        <div class="col-xl-2 col-md-4 col-sm-6">
            <div class="card kpi-card kpi-cost p-3 h-100">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <span class="text-muted small fw-bold">TOTAL HPP PROYEK</span>
                    <div class="kpi-icon-wrap" style="background:#fffbeb; color:#f59e0b;">
                        <i class="mdi mdi-calculator"></i>
                    </div>
                </div>
                <h5 class="fw-bold text-dark mb-1 font-monospace">Rp {{ number_format($summary['total_hpp_project'], 0, ',', '.') }}</h5>
                <small class="text-muted">Tanah + SPK + RAB + Servis</small>
            </div>
        </div>

        <!-- 4. Cash Outflow Realisasi -->
        <div class="col-xl-2 col-md-4 col-sm-6">
            <div class="card kpi-card kpi-outflow p-3 h-100">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <span class="text-muted small fw-bold">KAS KELUAR (OUTFLOW)</span>
                    <div class="kpi-icon-wrap" style="background:#fef2f2; color:#ef4444;">
                        <i class="mdi mdi-arrow-top-right-bold-outline"></i>
                    </div>
                </div>
                <h5 class="fw-bold text-danger mb-1 font-monospace">Rp {{ number_format($summary['total_cash_outflow'], 0, ',', '.') }}</h5>
                <small class="text-muted">Realisasi bayar SPK & Lahan</small>
            </div>
        </div>

        <!-- 5. Gross Profit -->
        <div class="col-xl-2 col-md-4 col-sm-6">
            <div class="card kpi-card kpi-profit p-3 h-100">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <span class="text-muted small fw-bold">PROYEKSI LABA KOTOR</span>
                    <div class="kpi-icon-wrap" style="background:#f5f3ff; color:#8b5cf6;">
                        <i class="mdi mdi-chart-line-variant"></i>
                    </div>
                </div>
                <h5 class="fw-bold text-primary mb-1 font-monospace">Rp {{ number_format($summary['total_gross_profit'], 0, ',', '.') }}</h5>
                <span class="badge badge-pill-soft badge-soft-success">Margin: {{ $summary['avg_margin_persen'] }}%</span>
            </div>
        </div>

        <!-- 6. Outstanding Piutang / Utang -->
        <div class="col-xl-2 col-md-4 col-sm-6">
            <div class="card kpi-card kpi-cashflow p-3 h-100">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <span class="text-muted small fw-bold">STATUS PIUTANG & UTANG</span>
                    <div class="kpi-icon-wrap" style="background:#ecfeff; color:#06b6d4;">
                        <i class="mdi mdi-scale-balance"></i>
                    </div>
                </div>
                <div class="small mb-1">
                    <span class="text-muted">Piutang:</span>
                    <strong class="text-danger">Rp {{ number_format($summary['total_piutang'], 0, ',', '.') }}</strong>
                </div>
                <div class="small">
                    <span class="text-muted">Utang SPK:</span>
                    <strong class="text-warning">Rp {{ number_format($summary['total_utang_kontraktor'], 0, ',', '.') }}</strong>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Search Bar -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-3">
            <form action="{{ route('keuangan.project-accounting.index') }}" method="GET" class="row g-2 align-items-center">
                <div class="col-lg-3 col-md-4">
                    <label class="form-label small fw-bold text-muted mb-1">Pilih Project / Tanah Induk</label>
                    <select name="land_bank_id" class="form-control form-control-sm" onchange="this.form.submit()">
                        <option value="">-- Semua Project (Land Bank) --</option>
                        @foreach($projects as $p)
                            <option value="{{ $p->id }}" {{ $landBankId == $p->id ? 'selected' : '' }}>
                                {{ $p->name }} ({{ $p->units_count }} Unit)
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg-2 col-md-4">
                    <label class="form-label small fw-bold text-muted mb-1">Pilih Unit / Kavling</label>
                    <select name="unit_id" class="form-control form-control-sm" onchange="this.form.submit()">
                        <option value="">-- Semua Unit --</option>
                        @foreach($unitsList as $u)
                            <option value="{{ $u->id }}" {{ $unitId == $u->id ? 'selected' : '' }}>
                                Blok {{ $u->unit_code ?? $u->block . '-' . $u->unit_number }} - {{ $u->unit_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg-2 col-md-4">
                    <label class="form-label small fw-bold text-muted mb-1">Status Unit</label>
                    <select name="status_unit" class="form-control form-control-sm" onchange="this.form.submit()">
                        <option value="all">Semua Status</option>
                        <option value="sold" {{ $statusUnit == 'sold' ? 'selected' : '' }}>Terjual (Sold)</option>
                        <option value="booked" {{ $statusUnit == 'booked' ? 'selected' : '' }}>Booking Aktif</option>
                        <option value="available" {{ $statusUnit == 'available' ? 'selected' : '' }}>Tersedia (Ready)</option>
                    </select>
                </div>

                <div class="col-lg-3 col-md-8">
                    <label class="form-label small fw-bold text-muted mb-1">Cari Keyword</label>
                    <div class="input-group input-group-sm">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama kavling, blok, konsumen..." value="{{ $search }}">
                        <button type="submit" class="btn btn-primary">
                            <i class="mdi mdi-magnify"></i> Cari
                        </button>
                    </div>
                </div>

                <div class="col-lg-2 col-md-4 text-end mt-auto">
                    <a href="{{ route('keuangan.project-accounting.index') }}" class="btn btn-sm btn-outline-secondary w-100">
                        <i class="mdi mdi-refresh me-1"></i> Reset Filter
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Multi-Tab Section -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom p-3">
            <ul class="nav nav-pills gap-2" id="erpTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link erp-tab-btn active" id="hpp-tab" data-toggle="pill" data-target="#hppTabPane" type="button" role="tab">
                        <i class="mdi mdi-table-account me-1"></i> 1. Matriks HPP & Laba Rugi Kavling
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link erp-tab-btn" id="spk-rab-tab" data-toggle="pill" data-target="#spkRabTabPane" type="button" role="tab">
                        <i class="mdi mdi-hard-hat me-1"></i> 2. SPK vs RAB Variance Analysis
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link erp-tab-btn" id="journal-tab" data-toggle="pill" data-target="#journalTabPane" type="button" role="tab">
                        <i class="mdi mdi-book-open-outline me-1"></i> 3. Buku Jurnal Transaksi ERP (Audit Trail)
                    </button>
                </li>
            </ul>
        </div>
        <div class="card-body p-0">
            <div class="tab-content" id="erpTabContent">

                <!-- TAB 1: MATRIKS HPP & LABA RUGI PER KAVLING -->
                <div class="tab-pane fade show active p-3" id="hppTabPane" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table table-hover table-erp align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Project & Kavling</th>
                                    <th>Konsumen & Status</th>
                                    <th class="text-end">Harga Jual (Revenue)</th>
                                    <th class="text-end">Biaya Tanah</th>
                                    <th class="text-end">Biaya SPK / Konstruksi</th>
                                    <th class="text-end">RAB / Servis</th>
                                    <th class="text-end" style="background:#f1f5f9;">Total HPP</th>
                                    <th class="text-end" style="background:#f8fafc;">Gross Profit</th>
                                    <th class="text-center">Margin</th>
                                    <th class="text-end">Kas Masuk Konsumen</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($unitFinancials as $uf)
                                    <tr>
                                        <td>
                                            <div class="fw-bold text-dark">{{ $uf->unit_name }}</div>
                                            <small class="text-primary font-monospace">{{ $uf->block_code }}</small>
                                            <small class="text-muted d-block" style="font-size: 0.75rem;">{{ $uf->project_name }}</small>
                                        </td>
                                        <td>
                                            <div class="fw-semibold text-dark">{{ $uf->customer_name }}</div>
                                            @if($uf->status === 'sold')
                                                <span class="badge badge-pill-soft badge-soft-success">TERJUAL</span>
                                            @elseif($uf->status === 'booked')
                                                <span class="badge badge-pill-soft badge-soft-primary">BOOKING</span>
                                            @else
                                                <span class="badge badge-pill-soft badge-soft-secondary">AVAILABLE</span>
                                            @endif
                                            @if($uf->booking_code !== '-')
                                                <small class="text-muted d-block font-monospace" style="font-size: 0.7rem;">{{ $uf->booking_code }}</small>
                                            @endif
                                        </td>
                                        <td class="text-end fw-bold font-monospace text-dark">
                                            Rp {{ number_format($uf->harga_jual, 0, ',', '.') }}
                                        </td>
                                        <td class="text-end font-monospace text-muted">
                                            Rp {{ number_format($uf->biaya_tanah, 0, ',', '.') }}
                                        </td>
                                        <td class="text-end font-monospace">
                                            <span class="text-dark">Rp {{ number_format($uf->biaya_spk_kontrak, 0, ',', '.') }}</span>
                                            @if($uf->spk)
                                                <small class="d-block text-muted" style="font-size: 0.7rem;">SPK: {{ $uf->spk->no_spk }}</small>
                                            @endif
                                        </td>
                                        <td class="text-end font-monospace text-muted">
                                            Rp {{ number_format($uf->biaya_rab + $uf->biaya_servis, 0, ',', '.') }}
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
                                            <button type="button" class="btn btn-xs btn-outline-primary d-inline-flex align-items-center gap-1"
                                                onclick="openDetailUnitModal({{ json_encode($uf) }})">
                                                <i class="mdi mdi-eye"></i> Detail
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="11" class="text-center py-5 text-muted">
                                            <i class="mdi mdi-folder-search-outline fs-1 d-block mb-2 text-secondary"></i>
                                            Tidak ada data kavling / unit yang sesuai dengan filter pencarian.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- TAB 2: SPK VS RAB VARIANCE ANALYSIS -->
                <div class="tab-pane fade p-3" id="spkRabTabPane" role="tabpanel">
                    <div class="alert alert-soft-primary border mb-3 p-3">
                        <i class="mdi mdi-information-outline me-2"></i>
                        <strong>Analisis Varian Anggaran Konstruksi (RAB vs SPK):</strong> Membandingkan Rencana Anggaran Biaya (RAB) dengan Nilai Kontrak SPK Pemborong dan Realisasi Termin yang telah dibayarkan.
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-erp align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Nomor SPK & Pekerjaan</th>
                                    <th>Project / Unit</th>
                                    <th>Kontraktor / Pemborong</th>
                                    <th class="text-end">RAB Acuan</th>
                                    <th class="text-end">Nilai Kontrak SPK</th>
                                    <th class="text-end">Realisasi Termin Terbayar</th>
                                    <th class="text-end">Sisa Kewajiban Utang</th>
                                    <th class="text-center">Progress Fisik</th>
                                    <th class="text-center">Status</th>
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
                                        <td colspan="9" class="text-center py-5 text-muted">
                                            <i class="mdi mdi-hard-hat text-secondary fs-1 d-block mb-2"></i>
                                            Belum ada data kontrak SPK kontraktor pada project yang dipilih.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- TAB 3: BUKU JURNAL TRANSAKSI ERP (AUDIT TRAIL) -->
                <div class="tab-pane fade p-3" id="journalTabPane" role="tabpanel">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold text-dark mb-0">
                            <i class="mdi mdi-format-list-bulleted-type me-1 text-primary"></i> Kronologi Arus Kas & Jurnal Mutasi Proyek
                        </h6>
                        <span class="badge bg-light text-dark border">{{ $journalEntries->count() }} Entri Transaksi Terdaftar</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-erp align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Tanggal Transaksi</th>
                                    <th>No. Referensi / Ref ID</th>
                                    <th>Kategori & Keterangan</th>
                                    <th>Project / Unit</th>
                                    <th>Tipe Mutasi</th>
                                    <th class="text-end">Debit (Kas Masuk)</th>
                                    <th class="text-end">Kredit (Kas Keluar)</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($journalEntries as $je)
                                    <tr>
                                        <td>
                                            <small class="fw-bold text-dark">{{ $je->date ? $je->date->format('d/m/Y') : '-' }}</small>
                                            <small class="text-muted d-block">{{ $je->date ? $je->date->format('H:i') : '' }} WIB</small>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark border font-monospace">{{ $je->ref_no }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-soft-primary text-primary mb-1 text-uppercase" style="font-size: 0.7rem;">{{ $je->category }}</span>
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
                                        <td colspan="8" class="text-center py-5 text-muted">
                                            <i class="mdi mdi-book-open-page-variant-outline text-secondary fs-1 d-block mb-2"></i>
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

<!-- MODAL: DETAIL FINANCIAL DRILL DOWN PER KAVLING -->
<div class="modal fade" id="modalDetailUnitFin" tabindex="-1" role="dialog" aria-labelledby="modalDetailUnitFinLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white py-3">
                <h5 class="modal-title fw-bold" id="modalDetailUnitFinLabel">
                    <i class="mdi mdi-card-account-details-outline me-1"></i> Kartu Biaya & HPP Unit Kavling
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded-3 border h-100">
                            <span class="text-muted small d-block">Project & Kavling</span>
                            <h5 class="fw-bold text-primary mb-1" id="mUnitName">-</h5>
                            <span class="badge bg-secondary font-monospace" id="mBlockCode">-</span>
                            <span class="text-muted small d-block mt-2">Konsumen / Pembeli</span>
                            <strong class="text-dark d-block" id="mCustomer">-</strong>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded-3 border h-100">
                            <span class="text-muted small d-block">Harga Jual Unit (Omset)</span>
                            <h4 class="fw-bold text-dark font-monospace mb-1" id="mHargaJual">-</h4>
                            <span class="text-muted small d-block mt-2">Gross Profit & Margin</span>
                            <h5 class="fw-bold text-success font-monospace mb-0" id="mProfit">-</h5>
                        </div>
                    </div>
                </div>

                <h6 class="fw-bold text-dark mb-2">Rincian Komponen HPP Kavling:</h6>
                <div class="table-responsive mb-3">
                    <table class="table table-bordered table-sm mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Komponen Biaya</th>
                                <th class="text-end">Estimasi / Kontrak</th>
                                <th class="text-end">Realisasi Bayar</th>
                                <th>Status / Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Alokasi Pengadaan Lahan (Tanah Dasar)</td>
                                <td class="text-end font-monospace" id="mBiayaTanah">-</td>
                                <td class="text-end font-monospace" id="mBiayaTanahReal">-</td>
                                <td class="text-success small"><i class="mdi mdi-check"></i> Pro-rata Luas Lahan</td>
                            </tr>
                            <tr>
                                <td>Biaya Kontrak Konstruksi SPK Pemborong</td>
                                <td class="text-end font-monospace" id="mBiayaSpk">-</td>
                                <td class="text-end font-monospace text-danger fw-bold" id="mBiayaSpkReal">-</td>
                                <td class="small" id="mSpkKet">-</td>
                            </tr>
                            <tr>
                                <td>Biaya Anggaran Material & RAB Tambahan</td>
                                <td class="text-end font-monospace" id="mBiayaRab">-</td>
                                <td class="text-end font-monospace" id="mBiayaRabReal">-</td>
                                <td class="small text-muted">Rencana RAB</td>
                            </tr>
                            <tr>
                                <td>Biaya Servis & Klaim Garansi Pasca Serah Terima</td>
                                <td class="text-end font-monospace" id="mBiayaServis">-</td>
                                <td class="text-end font-monospace text-danger" id="mBiayaServisReal">-</td>
                                <td class="small text-muted">Pemeliharaan</td>
                            </tr>
                            <tr class="table-light fw-bold">
                                <td>TOTAL HPP UNIT KAVLING</td>
                                <td class="text-end font-monospace text-danger" id="mTotalHppKomitmen">-</td>
                                <td class="text-end font-monospace text-danger" id="mTotalHppReal">-</td>
                                <td>-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="p-3 bg-light rounded-3 border">
                    <div class="row text-center">
                        <div class="col-4">
                            <span class="text-muted small d-block">Uang Masuk Konsumen</span>
                            <strong class="text-success font-monospace" id="mUangMasuk">-</strong>
                        </div>
                        <div class="col-4 border-start border-end">
                            <span class="text-muted small d-block">Sisa Piutang Konsumen</span>
                            <strong class="text-danger font-monospace" id="mPiutang">-</strong>
                        </div>
                        <div class="col-4">
                            <span class="text-muted small d-block">Net Cashflow Unit</span>
                            <strong class="text-primary font-monospace" id="mNetCashflow">-</strong>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light py-2">
                <button type="button" class="btn btn-secondary px-4" data-dismiss="modal" data-bs-dismiss="modal">Tutup</button>
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

    function openDetailUnitModal(uf) {
        document.getElementById('mUnitName').innerText = uf.unit_name || '-';
        document.getElementById('mBlockCode').innerText = uf.block_code || '-';
        document.getElementById('mCustomer').innerText = uf.customer_name || '-';
        document.getElementById('mHargaJual').innerText = formatRupiah(uf.harga_jual);
        document.getElementById('mProfit').innerText = formatRupiah(uf.gross_profit) + ' (' + uf.margin_persen + '%)';

        document.getElementById('mBiayaTanah').innerText = formatRupiah(uf.biaya_tanah);
        document.getElementById('mBiayaTanahReal').innerText = formatRupiah(uf.biaya_tanah);

        document.getElementById('mBiayaSpk').innerText = formatRupiah(uf.biaya_spk_kontrak);
        document.getElementById('mBiayaSpkReal').innerText = formatRupiah(uf.realisasi_bayar_spk);
        document.getElementById('mSpkKet').innerText = uf.spk ? ('No: ' + uf.spk.no_spk) : 'Belum Ada SPK';

        document.getElementById('mBiayaRab').innerText = formatRupiah(uf.biaya_rab);
        document.getElementById('mBiayaRabReal').innerText = formatRupiah(uf.biaya_rab);

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
</script>
@endpush
