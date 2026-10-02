@extends('layouts.partial.app')

@section('title', 'Buku Jurnal Umum - Sistem Keuangan ERP')

@push('styles')
<style>
    /* Card Dasar Konsisten */
    .ak-card {
        border-radius: 6px !important;
        border: 1px solid #e2e8f0 !important;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04) !important;
        background: #ffffff;
    }

    /* 4 KPI Cards (Persis Dashboard & Arus Kas) */
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

    /* Buttons Solid Colors */
    .btn-solid-purple {
        background: #9a55ff !important;
        border: 1px solid #9a55ff !important;
        color: #ffffff !important;
        font-weight: 600;
        border-radius: 6px !important;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: all 0.2s ease;
    }
    .btn-solid-purple:hover {
        background: #8435f5 !important;
        border-color: #8435f5 !important;
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

    /* SPK Rupiah Box */
    .spk-rupiah-box {
        display: flex !important;
        align-items: stretch !important;
        width: 100% !important;
        border: 1px solid #cbd5e1 !important;
        border-radius: 6px !important;
        overflow: hidden !important;
        background: #ffffff !important;
        height: 38px !important;
        transition: all 0.2s ease !important;
    }
    .spk-rupiah-box:focus-within {
        border-color: #9a55ff !important;
        box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.12) !important;
    }
    .spk-rupiah-box .spk-prefix {
        background: #f8fafc !important;
        color: #475569 !important;
        font-weight: 700 !important;
        font-size: 0.85rem !important;
        padding: 0 14px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        border-right: 1px solid #cbd5e1 !important;
        user-select: none !important;
    }
    .spk-rupiah-box input.rupiah-spk-input {
        border: none !important;
        outline: none !important;
        box-shadow: none !important;
        padding: 0 12px !important;
        font-size: 0.95rem !important;
        font-weight: 600 !important;
        color: #1e293b !important;
        flex: 1 !important;
        width: 100% !important;
        height: 100% !important;
        background: transparent !important;
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
    .table-jurnal th {
        background-color: #f8fafc;
        color: #475569;
        font-size: 0.78rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 700;
        border-bottom: 2px solid #e2e8f0 !important;
        vertical-align: middle;
    }
    .table-jurnal td {
        font-size: 0.85rem;
        vertical-align: middle;
        padding: 0.75rem 0.65rem;
        border-bottom: 1px solid #f1f5f9;
    }
    .btn-action-icon {
        width: 32px;
        height: 32px;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        border: none;
        transition: all 0.2s;
        text-decoration: none;
    }
    .account-line-debit {
        font-weight: 600;
        color: #1e293b;
    }
    .account-line-credit {
        padding-left: 1.5rem;
        color: #64748b;
        font-style: italic;
    }
    .voucher-watermark {
        position: absolute;
        right: 20px;
        top: 20px;
        opacity: 0.08;
        font-size: 8rem;
        pointer-events: none;
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
                        <span class="text-muted" style="font-size: 0.8rem;"><i class="mdi mdi-calendar-range me-1"></i>Periode: {{ $startDate ? date('d M Y', strtotime($startDate)) : 'Semua' }} s/d {{ $endDate ? date('d M Y', strtotime($endDate)) : 'Hari Ini' }}</span>
                    </div>
                    <h4 class="mb-0 fw-bold text-dark">Buku Jurnal Umum</h4>
                    <p class="text-muted mb-0 small">Pencatatan ganda (double-entry) otomatis dari operasional proyek, penjualan, dan voucher kas.</p>
                </div>
                <div class="d-flex flex-wrap align-items-center gap-2">
                    {{-- Form Sinkronisasi Otomatis --}}
                    <form action="{{ route('keuangan.jurnal.sync') }}" method="POST" id="formSyncJurnal" class="d-inline">
                        @csrf
                        <button type="button" class="btn btn-outline-neutral btn-sm px-3 py-2" id="btnSyncJurnal" title="Tarik data transaksi otomatis dari booking, kas tempo, KPR, SPK mandor, dan pra-landbank">
                            <i class="mdi mdi-sync me-1"></i> Sinkronkan Transaksi
                        </button>
                    </form>

                    {{-- Cetak Jurnal --}}
                    <a href="{{ route('keuangan.jurnal.cetak', request()->query()) }}" target="_blank" class="btn btn-outline-neutral btn-sm px-3 py-2">
                        <i class="mdi mdi-printer me-1"></i> Cetak Jurnal
                    </a>

                    {{-- Tambah Jurnal Manual (Halaman Sendiri) --}}
                    <a href="{{ route('keuangan.jurnal.create') }}" class="btn btn-solid-purple btn-sm px-3 py-2 shadow-sm">
                        <i class="mdi mdi-plus-circle me-1"></i> Catat Voucher / Jurnal
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
    @if(isset($errors) && $errors->any())
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" style="border-radius: 6px;" role="alert">
            <i class="mdi mdi-alert me-2"></i> <strong>Mohon periksa kesalahan input:</strong>
            <ul class="mb-0 mt-1">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- 4 KPI Cards (Persis Style Dashboard & Arus Kas) --}}
    <div class="row g-3 mb-3">
        <!-- 1. Total Transaksi (Purple) -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="dash-kpi-card">
                <div class="dash-kpi-left">
                    <div class="dash-kpi-icon purple">
                        <i class="mdi mdi-receipt-text-outline"></i>
                    </div>
                    <div class="dash-kpi-info">
                        <div class="dash-kpi-label">Total Transaksi</div>
                        <div class="dash-kpi-val">{{ number_format($totalEntries) }}</div>
                        <div class="dash-kpi-sub">
                            <span class="text-primary fw-semibold">{{ $autoCount }} Otomatis</span> &bull; <span>{{ $manualCount }} Manual</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. Total Debit (Green) -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="dash-kpi-card">
                <div class="dash-kpi-left">
                    <div class="dash-kpi-icon green">
                        <i class="mdi mdi-arrow-down-bold"></i>
                    </div>
                    <div class="dash-kpi-info">
                        <div class="dash-kpi-label">Total Debit</div>
                        <div class="dash-kpi-val" style="color: #16a34a;">Rp {{ number_format($totalDebit, 0, ',', '.') }}</div>
                        <div class="dash-kpi-sub"><span class="badge badge-soft-success">Sisi Debit</span></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. Total Kredit (Rose) -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="dash-kpi-card">
                <div class="dash-kpi-left">
                    <div class="dash-kpi-icon rose">
                        <i class="mdi mdi-arrow-up-bold"></i>
                    </div>
                    <div class="dash-kpi-info">
                        <div class="dash-kpi-label">Total Kredit</div>
                        <div class="dash-kpi-val" style="color: #e11d48;">Rp {{ number_format($totalCredit, 0, ',', '.') }}</div>
                        <div class="dash-kpi-sub"><span class="badge badge-soft-danger">Sisi Kredit</span></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4. Keseimbangan (Blue / Green) -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="dash-kpi-card">
                <div class="dash-kpi-left">
                    <div class="dash-kpi-icon {{ $isBalanced ? 'green' : 'rose' }}">
                        <i class="mdi mdi-scale-balance"></i>
                    </div>
                    <div class="dash-kpi-info">
                        <div class="dash-kpi-label">Keseimbangan (Balance)</div>
                        @if($isBalanced)
                            <div class="dash-kpi-val" style="color: #16a34a;">SEIMBANG</div>
                            <div class="dash-kpi-sub"><span class="badge badge-soft-success">Selisih: Rp 0</span></div>
                        @else
                            <div class="dash-kpi-val" style="color: #e11d48;">SELISIH</div>
                            <div class="dash-kpi-sub"><span class="badge badge-soft-danger">Rp {{ number_format(abs($totalDebit - $totalCredit), 0, ',', '.') }}</span></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter Panel (Persis Catalog Unit & Arus Kas) --}}
    <div class="card compact-table-card filter-card mb-3">
        <div class="card-body">
            <form method="GET" action="{{ route('keuangan.jurnal.index') }}" id="filterForm">
                <div class="row g-2 align-items-end">
                    <div class="col-12 col-sm-6 col-md-2">
                        <label class="form-label small fw-semibold text-secondary mb-1">Mulai Tanggal</label>
                        <input type="date" name="start_date" class="form-control" value="{{ $startDate }}">
                    </div>
                    <div class="col-12 col-sm-6 col-md-2">
                        <label class="form-label small fw-semibold text-secondary mb-1">Sampai Tanggal</label>
                        <input type="date" name="end_date" class="form-control" value="{{ $endDate }}">
                    </div>
                    <div class="col-12 col-sm-6 col-md-2">
                        <label class="form-label small fw-semibold text-secondary mb-1">Proyek / Landbank</label>
                        <select name="land_bank_id" class="form-select">
                            <option value="">Semua Proyek</option>
                            @foreach($landBanks as $lb)
                                <option value="{{ $lb->id }}" {{ $landBankId == $lb->id ? 'selected' : '' }}>
                                    {{ $lb->nama_land_bank }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-sm-6 col-md-2">
                        <label class="form-label small fw-semibold text-secondary mb-1">Tipe Transaksi</label>
                        <select name="type" class="form-select">
                            <option value="all">Semua Tipe</option>
                            <option value="inflow" {{ $type === 'inflow' ? 'selected' : '' }}>Kas Masuk (BKM)</option>
                            <option value="outflow" {{ $type === 'outflow' ? 'selected' : '' }}>Kas Keluar (BKK)</option>
                            <option value="general" {{ $type === 'general' ? 'selected' : '' }}>Jurnal Umum (JRN)</option>
                        </select>
                    </div>
                    <div class="col-12 col-sm-6 col-md-2">
                        <label class="form-label small fw-semibold text-secondary mb-1">Sumber Modul</label>
                        <select name="source_module" class="form-select">
                            <option value="all">Semua Sumber</option>
                            <option value="manual" {{ $source === 'manual' ? 'selected' : '' }}>Manual Voucher</option>
                            <option value="booking_payment" {{ $source === 'booking_payment' ? 'selected' : '' }}>Booking / UTJ</option>
                            <option value="cash_tempo" {{ $source === 'cash_tempo' ? 'selected' : '' }}>Angsuran Cash Tempo</option>
                            <option value="kpr_disbursement" {{ $source === 'kpr_disbursement' ? 'selected' : '' }}>Pencairan KPR</option>
                            <option value="spk_termin" {{ $source === 'spk_termin' ? 'selected' : '' }}>SPK Mandor / Konstruksi</option>
                            <option value="infrastructure" {{ $source === 'infrastructure' ? 'selected' : '' }}>Infrastruktur Lahan</option>
                            <option value="pra_landbank" {{ $source === 'pra_landbank' ? 'selected' : '' }}>Pra-Landbank</option>
                            <option value="invoice" {{ $source === 'invoice' ? 'selected' : '' }}>Invoice Konsumen</option>
                        </select>
                    </div>
                    <div class="col-12 col-sm-6 col-md-2 d-flex align-items-end gap-1">
                        <button type="submit" class="btn btn-gradient-primary btn-icon-only" title="Filter Data">
                            <i class="mdi mdi-filter"></i>
                        </button>
                        <a href="{{ route('keuangan.jurnal.index') }}" class="btn btn-gradient-secondary btn-icon-only" title="Reset Filter">
                            <i class="mdi mdi-refresh"></i>
                        </a>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-white border-end-0" style="border-radius: 6px 0 0 6px; border: 1px solid #cbd5e1; border-right: none;"><i class="mdi mdi-magnify text-muted"></i></span>
                            <input type="text" name="search" class="form-control border-start-0" style="border-radius: 0 6px 6px 0; border: 1px solid #cbd5e1; border-left: none;" placeholder="Cari No. Voucher, deskripsi transaksi, atau nama konsumen/vendor..." value="{{ $search }}">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Main Table Card --}}
    <div class="card compact-table-card border-0 mb-3" style="border-radius: 6px !important; overflow: hidden;">
        <div class="table-responsive">
            <table class="table table-hover table-jurnal align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 140px;">No. Voucher</th>
                        <th style="width: 100px;">Tanggal</th>
                        <th>Kode & Nama Akun / Rekening</th>
                        <th style="width: 160px;">Proyek / Modul</th>
                        <th style="width: 130px;" class="text-end">Debit (Rp)</th>
                        <th style="width: 130px;" class="text-end">Kredit (Rp)</th>
                        <th style="width: 90px;" class="text-center">Bukti</th>
                        <th style="width: 90px;" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($entries as $entry)
                        @php
                            $debitItem = $entry->items->where('type', 'debit')->first();
                            $creditItem = $entry->items->where('type', 'credit')->first();
                            $badgeClass = match($entry->transaction_type) {
                                'inflow'  => 'badge-soft-success',
                                'outflow' => 'badge-soft-danger',
                                default   => 'badge-soft-primary',
                            };
                        @endphp
                        <tr>
                            <td>
                                <span class="badge {{ $badgeClass }} fw-bold mb-1 d-inline-block">{{ $entry->entry_number }}</span>
                                <div class="text-muted" style="font-size: 0.72rem;">
                                    @if($entry->is_auto_generated)
                                        <i class="mdi mdi-robot me-1 text-primary"></i>Otomatis Proyek
                                    @else
                                        <i class="mdi mdi-account-edit me-1 text-secondary"></i>Manual
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="fw-semibold text-dark">{{ $entry->entry_date->format('d/m/Y') }}</div>
                                <span class="text-muted" style="font-size: 0.72rem;">{{ $entry->entry_date->locale('id')->isoFormat('dddd') }}</span>
                            </td>
                            <td>
                                {{-- Baris Akun Debit --}}
                                @if($debitItem)
                                    <div class="account-line-debit d-flex justify-content-between align-items-center">
                                        <span>
                                            <span class="badge bg-light text-dark border me-1">{{ $debitItem->account?->code ?? '-' }}</span>
                                            {{ $debitItem->account?->name ?? 'Akun Debit' }}
                                        </span>
                                    </div>
                                @endif

                                {{-- Baris Akun Kredit --}}
                                @if($creditItem)
                                    <div class="account-line-credit d-flex justify-content-between align-items-center mt-1">
                                        <span>
                                            <span class="badge bg-light text-muted border me-1">{{ $creditItem->account?->code ?? '-' }}</span>
                                            {{ $creditItem->account?->name ?? 'Akun Kredit' }}
                                        </span>
                                    </div>
                                @endif

                                {{-- Deskripsi / Keterangan --}}
                                <div class="text-muted mt-1 small" style="font-size: 0.78rem;">
                                    <i class="mdi mdi-text-short me-1"></i>{{ $entry->description }}
                                    @if($entry->party_name && !str_contains(strtolower($entry->description), strtolower($entry->party_name)))
                                        <span class="text-dark fw-semibold ms-1">({{ $entry->party_name }})</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                @if($entry->landBank)
                                    <div class="fw-semibold text-primary" style="font-size: 0.8rem;">
                                        <i class="mdi mdi-domain me-1"></i>{{ $entry->landBank->nama_land_bank }}
                                    </div>
                                @else
                                    <span class="text-muted small">Umum / Kantor</span>
                                @endif
                                <span class="badge bg-light text-secondary border mt-1" style="font-size: 0.7rem;">
                                    {{ strtoupper(str_replace('_', ' ', $entry->source_module)) }}
                                </span>
                            </td>
                            <td class="text-end fw-bold text-success">
                                {{ $debitItem ? number_format($debitItem->amount, 0, ',', '.') : '-' }}
                            </td>
                            <td class="text-end fw-bold text-danger">
                                {{ $creditItem ? number_format($creditItem->amount, 0, ',', '.') : '-' }}
                            </td>
                            <td class="text-center">
                                @if($entry->proof_url)
                                    <a href="{{ $entry->proof_url }}" target="_blank" class="btn btn-sm btn-outline-info p-1 px-2" title="Lihat Lampiran Bukti">
                                        <i class="mdi mdi-paperclip"></i>
                                    </a>
                                @else
                                    <span class="text-muted small">-</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-inline-flex gap-1">
                                    {{-- Modal View Detail Voucher --}}
                                    <button type="button" class="btn btn-sm btn-light border text-primary btn-action-icon btn-detail-voucher" data-id="{{ $entry->id }}" title="Lihat Slip Voucher">
                                        <i class="mdi mdi-eye"></i>
                                    </button>

                                    {{-- Hapus (Hanya jika manual) --}}
                                    @if(!$entry->is_auto_generated)
                                        <form action="{{ route('keuangan.jurnal.destroy', $entry->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus voucher manual ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-light border text-danger btn-action-icon" title="Hapus Voucher">
                                                <i class="mdi mdi-trash-can-outline"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <div class="py-4">
                                    <i class="mdi mdi-book-open-outline text-muted" style="font-size: 3.5rem;"></i>
                                    <h5 class="fw-bold text-secondary mt-3 mb-1">Belum Ada Transaksi Jurnal</h5>
                                    <p class="text-muted small mb-3">Klik tombol <strong>"Sinkronkan Transaksi"</strong> untuk menarik transaksi proyek atau <strong>"Catat Voucher"</strong> untuk mencatat manual.</p>
                                    <a href="{{ route('keuangan.jurnal.create') }}" class="btn btn-solid-purple btn-sm px-4">
                                        <i class="mdi mdi-plus-circle me-1"></i> Catat Jurnal Baru
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($entries->hasPages())
            <div class="card-footer bg-white border-top p-3 d-flex justify-content-between align-items-center">
                <span class="small text-muted">Menampilkan {{ $entries->firstItem() ?? 0 }} - {{ $entries->lastItem() ?? 0 }} dari {{ $entries->total() }} transaksi</span>
                {{ $entries->links() }}
            </div>
        @endif
    </div>
</div>

{{-- Modal Detail Voucher Slip --}}
<div class="modal fade" id="modalDetailVoucher" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content border-0 shadow" style="border-radius: 6px; overflow: hidden;">
            <div class="modal-header border-bottom-0 pb-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 pt-1" id="slipVoucherContent">
                <div class="text-center py-4">
                    <div class="spinner-border text-primary" role="status"></div>
                    <div class="mt-2 text-muted small">Memuat slip voucher...</div>
                </div>
            </div>
            <div class="modal-footer bg-light p-3">
                <button type="button" class="btn btn-outline-neutral btn-sm px-3" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-solid-purple btn-sm px-3 shadow-sm" onclick="window.print()"><i class="mdi mdi-printer me-1"></i>Cetak Slip</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // SweetAlert Confirm Sync
    document.getElementById('btnSyncJurnal')?.addEventListener('click', function() {
        Swal.fire({
            title: 'Sinkronisasi Transaksi Proyek?',
            text: 'Sistem akan memeriksa dan menyelaraskan otomatis data dari modul Booking, Angsuran Cash Bertempo, Pencairan KPR, SPK Mandor, Infrastruktur, dan Pra-Landbank ke Buku Jurnal.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#9a55ff',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="mdi mdi-sync"></i> Ya, Sinkronkan Sekarang',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Sedang Menyinkronkan...',
                    text: 'Mohon tunggu sebentar selagi sistem memproses jurnal akuntansi.',
                    allowOutsideClick: false,
                    didOpen: () => { Swal.showLoading(); }
                });
                document.getElementById('formSyncJurnal').submit();
            }
        });
    });

    // Update labels modal based on BKM/BKK/JRN
    function updateVoucherLabels(type) {
        const lblDebit = document.getElementById('labelDebitAccount');
        const lblCredit = document.getElementById('labelCreditAccount');
        const lblParty = document.getElementById('labelPartyName');

        if (type === 'BKM') {
            lblDebit.innerHTML = 'Akun Kas / Bank Masuk (DEBIT) <span class="text-danger">*</span>';
            lblCredit.innerHTML = 'Sumber Pendapatan / Piutang (KREDIT) <span class="text-danger">*</span>';
            lblParty.innerText = 'Diterima Dari (Konsumen / Pihak Ketiga)';
        } else if (type === 'BKK') {
            lblDebit.innerHTML = 'Akun Biaya / Beban / HPP (DEBIT) <span class="text-danger">*</span>';
            lblCredit.innerHTML = 'Kas / Bank Keluar (KREDIT) <span class="text-danger">*</span>';
            lblParty.innerText = 'Dibayarkan Kepada (Vendor / Mandor / Karyawan)';
        } else {
            lblDebit.innerHTML = 'Akun DEBIT <span class="text-danger">*</span>';
            lblCredit.innerHTML = 'Akun KREDIT <span class="text-danger">*</span>';
            lblParty.innerText = 'Pihak Terkait';
        }
    }

    // Detail Voucher Modal Ajax
    document.querySelectorAll('.btn-detail-voucher').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const modal = new bootstrap.Modal(document.getElementById('modalDetailVoucher'));
            modal.show();

            const container = document.getElementById('slipVoucherContent');
            container.innerHTML = `
                <div class="text-center py-4">
                    <div class="spinner-border text-primary" role="status"></div>
                    <div class="mt-2 text-muted small">Memuat data voucher...</div>
                </div>
            `;

            fetch(`{{ url('keuangan/jurnal-umum/detail') }}/${id}`)
                .then(res => res.json())
                .then(res => {
                    if (res.status && res.data) {
                        const d = res.data;
                        const debit = d.items.find(i => i.type === 'debit');
                        const credit = d.items.find(i => i.type === 'credit');

                        let dateFormatted = d.entry_date;
                        try {
                            const parsedDate = new Date(d.entry_date);
                            if (!isNaN(parsedDate)) {
                                dateFormatted = parsedDate.toLocaleDateString('id-ID', { weekday: 'long', day: '2-digit', month: '2-digit', year: 'numeric' });
                            }
                        } catch (e) {}

                        container.innerHTML = `
                            <div class="text-center pb-3 border-bottom mb-3">
                                <h6 class="fw-bold mb-0 text-dark">PT GRAHA CIPTA SEJAHTERA</h6>
                                <p class="text-muted small mb-1" style="font-size: 0.72rem;">SISTEM KEUANGAN & AKUNTANSI ERP</p>
                                <span class="badge bg-primary px-3 py-1 fs-6 fw-bold">${d.entry_number}</span>
                            </div>
                            <table class="table table-sm table-borderless small mb-3">
                                <tr>
                                    <td class="text-muted" style="width: 35%;">Tanggal</td>
                                    <td class="fw-semibold">: ${dateFormatted}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Jenis Transaksi</td>
                                    <td class="fw-semibold">: ${d.transaction_type.toUpperCase()} (${d.source_module})</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Proyek</td>
                                    <td class="fw-semibold">: ${d.land_bank ? d.land_bank.nama_land_bank : 'Umum / Kantor'}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Pihak Terkait</td>
                                    <td class="fw-semibold">: ${d.party_name || '-'}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Keterangan</td>
                                    <td class="fw-semibold">: ${d.description}</td>
                                </tr>
                            </table>
                            <div class="bg-light p-3 rounded mb-3">
                                <div class="d-flex justify-content-between mb-1 small">
                                    <span class="text-success fw-bold">DEBIT: [${debit?.account?.code || '-'}] ${debit?.account?.name || '-'}</span>
                                    <span class="fw-bold text-success">Rp ${parseFloat(debit?.amount || 0).toLocaleString('id-ID')}</span>
                                </div>
                                <div class="d-flex justify-content-between small">
                                    <span class="text-danger fw-bold ps-3">KREDIT: [${credit?.account?.code || '-'}] ${credit?.account?.name || '-'}</span>
                                    <span class="fw-bold text-danger">Rp ${parseFloat(credit?.amount || 0).toLocaleString('id-ID')}</span>
                                </div>
                            </div>
                            <div class="text-end">
                                <span class="text-muted small d-block">Total Nominal:</span>
                                <h4 class="fw-bold text-dark mb-0">Rp ${parseFloat(d.total_amount).toLocaleString('id-ID')}</h4>
                            </div>
                        `;
                    } else {
                        container.innerHTML = `<div class="alert alert-danger">Gagal memuat slip voucher.</div>`;
                    }
                })
                .catch(err => {
                    container.innerHTML = `<div class="alert alert-danger">Terjadi kesalahan: ${err.message}</div>`;
                });
        });
    });
</script>
@endpush
