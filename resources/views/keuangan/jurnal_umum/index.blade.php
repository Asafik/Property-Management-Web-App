@extends('layouts.partial.app')

@section('title', 'Buku Jurnal Umum - Sistem Keuangan ERP')

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
    .badge-soft {
        border-radius: 6px;
        font-weight: 600;
        padding: 5px 10px;
        font-size: 0.78rem;
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
    <div class="card header-card mb-3">
        <div class="card-body p-3">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <div>
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <span class="badge badge-soft-primary"><i class="mdi mdi-book-open-page-variant-outline me-1"></i>Akuntansi ERP</span>
                        <span class="text-muted" style="font-size: 0.8rem;"><i class="mdi mdi-calendar-range me-1"></i>Periode: {{ $startDate ? date('d M Y', strtotime($startDate)) : 'Semua' }} s/d {{ $endDate ? date('d M Y', strtotime($endDate)) : 'Hari Ini' }}</span>
                    </div>
                    <h4 class="mb-0 fw-bold text-dark">Buku Jurnal Umum</h4>
                    <p class="text-muted mb-0 small">Pencatatan ganda (double-entry) otomatis dari operasional proyek, penjualan, dan voucher kas.</p>
                </div>
                <div class="d-flex flex-wrap align-items-center gap-2">
                    {{-- Form Sinkronisasi Otomatis --}}
                    <form action="{{ route('keuangan.jurnal.sync') }}" method="POST" id="formSyncJurnal" class="d-inline">
                        @csrf
                        <button type="button" class="btn btn-outline-primary btn-sm fw-semibold px-3 py-2" id="btnSyncJurnal" title="Tarik data transaksi otomatis dari booking, kas tempo, KPR, SPK mandor, dan pra-landbank">
                            <i class="mdi mdi-sync me-1"></i> Sinkronkan Transaksi
                        </button>
                    </form>

                    {{-- Cetak Jurnal --}}
                    <a href="{{ route('keuangan.jurnal.cetak', request()->query()) }}" target="_blank" class="btn btn-outline-secondary btn-sm fw-semibold px-3 py-2">
                        <i class="mdi mdi-printer me-1"></i> Cetak Jurnal
                    </a>

                    {{-- Tambah Jurnal Manual --}}
                    <button type="button" class="btn btn-primary btn-sm fw-semibold px-3 py-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahJurnal">
                        <i class="mdi mdi-plus-circle me-1"></i> Catat Voucher / Jurnal
                    </button>
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
    @if(isset($errors) && $errors->any())
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
            <i class="mdi mdi-alert me-2"></i> <strong>Mohon periksa kesalahan input:</strong>
            <ul class="mb-0 mt-1">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- KPI Cards --}}
    <div class="row g-3 mb-3">
        <div class="col-6 col-lg-3">
            <div class="card kpi-card p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted d-block small mb-1">Total Transaksi</span>
                        <h4 class="fw-bold mb-0 text-dark">{{ number_format($totalEntries) }}</h4>
                        <div class="mt-1 small text-muted" style="font-size: 0.75rem;">
                            <span class="text-primary fw-semibold">{{ $autoCount }} Otomatis</span> &bull; <span>{{ $manualCount }} Manual</span>
                        </div>
                    </div>
                    <div class="kpi-icon-wrap bg-primary-subtle text-primary">
                        <i class="mdi mdi-receipt-text"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="card kpi-card p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted d-block small mb-1">Total Debit</span>
                        <h4 class="fw-bold mb-0 text-success">Rp {{ number_format($totalDebit, 0, ',', '.') }}</h4>
                        <span class="badge badge-soft-success mt-1">Sisi Debit</span>
                    </div>
                    <div class="kpi-icon-wrap bg-success-subtle text-success">
                        <i class="mdi mdi-arrow-down-bold-circle-outline"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="card kpi-card p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted d-block small mb-1">Total Kredit</span>
                        <h4 class="fw-bold mb-0 text-danger">Rp {{ number_format($totalCredit, 0, ',', '.') }}</h4>
                        <span class="badge badge-soft-danger mt-1">Sisi Kredit</span>
                    </div>
                    <div class="kpi-icon-wrap bg-danger-subtle text-danger">
                        <i class="mdi mdi-arrow-up-bold-circle-outline"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="card kpi-card p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted d-block small mb-1">Keseimbangan (Balance)</span>
                        @if($isBalanced)
                            <h5 class="fw-bold mb-0 text-success"><i class="mdi mdi-check-all me-1"></i>SEIMBANG</h5>
                            <span class="badge badge-soft-success mt-1">Selisih: Rp 0</span>
                        @else
                            <h5 class="fw-bold mb-0 text-danger"><i class="mdi mdi-alert-circle me-1"></i>SELISIH</h5>
                            <span class="badge badge-soft-danger mt-1">Rp {{ number_format(abs($totalDebit - $totalCredit), 0, ',', '.') }}</span>
                        @endif
                    </div>
                    <div class="kpi-icon-wrap {{ $isBalanced ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }}">
                        <i class="mdi mdi-scale-balance"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter Panel --}}
    <div class="card filter-card mb-3">
        <form method="GET" action="{{ route('keuangan.jurnal.index') }}" id="filterForm">
            <div class="row g-2 align-items-end">
                <div class="col-12 col-md-2">
                    <label class="form-label small fw-semibold text-secondary mb-1">Mulai Tanggal</label>
                    <input type="date" name="start_date" class="form-control" value="{{ $startDate }}">
                </div>
                <div class="col-12 col-md-2">
                    <label class="form-label small fw-semibold text-secondary mb-1">Sampai Tanggal</label>
                    <input type="date" name="end_date" class="form-control" value="{{ $endDate }}">
                </div>
                <div class="col-12 col-md-2">
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
                <div class="col-12 col-md-2">
                    <label class="form-label small fw-semibold text-secondary mb-1">Tipe Transaksi</label>
                    <select name="type" class="form-select">
                        <option value="all">Semua Tipe</option>
                        <option value="inflow" {{ $type === 'inflow' ? 'selected' : '' }}>Kas Masuk (BKM)</option>
                        <option value="outflow" {{ $type === 'outflow' ? 'selected' : '' }}>Kas Keluar (BKK)</option>
                        <option value="general" {{ $type === 'general' ? 'selected' : '' }}>Jurnal Umum (JRN)</option>
                    </select>
                </div>
                <div class="col-12 col-md-2">
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
                <div class="col-12 col-md-2 d-flex gap-1">
                    <button type="submit" class="btn btn-primary btn-sm w-100 py-2 fw-semibold">
                        <i class="mdi mdi-filter me-1"></i> Filter
                    </button>
                    <a href="{{ route('keuangan.jurnal.index') }}" class="btn btn-light btn-sm px-2 py-2" title="Reset Filter">
                        <i class="mdi mdi-refresh"></i>
                    </a>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-white border-end-0"><i class="mdi mdi-magnify text-muted"></i></span>
                        <input type="text" name="search" class="form-control border-start-0" placeholder="Cari No. Voucher, deskripsi transaksi, atau nama konsumen/vendor..." value="{{ $search }}">
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- Main Table Card --}}
    <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
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
                                    <button type="button" class="btn btn-primary btn-sm px-4" data-bs-toggle="modal" data-bs-target="#modalTambahJurnal">
                                        <i class="mdi mdi-plus-circle me-1"></i> Catat Jurnal Baru
                                    </button>
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

{{-- Modal Tambah Jurnal / Voucher Baru --}}
<div class="modal fade" id="modalTambahJurnal" tabindex="-1" aria-labelledby="modalTambahJurnalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <form action="{{ route('keuangan.jurnal.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-primary text-white p-3">
                    <h5 class="modal-title fw-bold" id="modalTambahJurnalLabel">
                        <i class="mdi mdi-plus-circle-outline me-1"></i> Catat Entri Voucher / Jurnal Keuangan
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    {{-- Pilihan Tipe Voucher --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-dark mb-2">Pilih Jenis Voucher</label>
                        <div class="row g-2">
                            <div class="col-4">
                                <input type="radio" class="btn-check" name="voucher_type" id="vTypeBKM" value="BKM" checked onchange="updateVoucherLabels('BKM')">
                                <label class="btn btn-outline-success w-100 py-2 d-flex flex-column align-items-center" for="vTypeBKM">
                                    <i class="mdi mdi-arrow-down-bold fs-4 mb-1"></i>
                                    <span class="fw-bold">BKM (Kas Masuk)</span>
                                    <small class="text-muted" style="font-size: 0.7rem;">Penerimaan Uang</small>
                                </label>
                            </div>
                            <div class="col-4">
                                <input type="radio" class="btn-check" name="voucher_type" id="vTypeBKK" value="BKK" onchange="updateVoucherLabels('BKK')">
                                <label class="btn btn-outline-danger w-100 py-2 d-flex flex-column align-items-center" for="vTypeBKK">
                                    <i class="mdi mdi-arrow-up-bold fs-4 mb-1"></i>
                                    <span class="fw-bold">BKK (Kas Keluar)</span>
                                    <small class="text-muted" style="font-size: 0.7rem;">Pengeluaran Dana</small>
                                </label>
                            </div>
                            <div class="col-4">
                                <input type="radio" class="btn-check" name="voucher_type" id="vTypeJRN" value="JRN" onchange="updateVoucherLabels('JRN')">
                                <label class="btn btn-outline-primary w-100 py-2 d-flex flex-column align-items-center" for="vTypeJRN">
                                    <i class="mdi mdi-book-edit fs-4 mb-1"></i>
                                    <span class="fw-bold">Jurnal Penyesuaian</span>
                                    <small class="text-muted" style="font-size: 0.7rem;">Non-Kas / Mutasi</small>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">Tanggal Transaksi <span class="text-danger">*</span></label>
                            <input type="date" name="entry_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">Alokasi Proyek (Opsional)</label>
                            <select name="land_bank_id" class="form-select">
                                <option value="">Kantor Pusat / Umum</option>
                                @foreach($landBanks as $lb)
                                    <option value="{{ $lb->id }}">{{ $lb->nama_land_bank }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Form Akun Debit & Kredit --}}
                    <div class="card bg-light border-0 p-3 mb-3" style="border-radius: 8px;">
                        <h6 class="fw-bold text-dark mb-2" style="font-size: 0.85rem;"><i class="mdi mdi-swap-horizontal me-1"></i>Pasangan Rekening Akun (Double Entry)</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-success" id="labelDebitAccount">Akun Masuk / Penerima (DEBIT) <span class="text-danger">*</span></label>
                                <select name="debit_account_id" id="debit_account_id" class="form-select" required>
                                    <option value="">-- Pilih Akun Debit --</option>
                                    @foreach($accounts as $acc)
                                        <option value="{{ $acc->id }}">[{{ $acc->code }}] {{ $acc->name }} ({{ $acc->sub_category }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-danger" id="labelCreditAccount">Akun Sumber / Pengirim (KREDIT) <span class="text-danger">*</span></label>
                                <select name="credit_account_id" id="credit_account_id" class="form-select" required>
                                    <option value="">-- Pilih Akun Kredit --</option>
                                    @foreach($accounts as $acc)
                                        <option value="{{ $acc->id }}">[{{ $acc->code }}] {{ $acc->name }} ({{ $acc->sub_category }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">Nominal (Rp) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text fw-bold">Rp</span>
                                <input type="number" name="amount" class="form-control fw-bold" placeholder="0" min="1" step="any" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">Kategori Arus Kas</label>
                            <select name="cash_flow_category" class="form-select">
                                <option value="operating">Aktivitas Operasi (Operasional, Penerimaan Konsumen)</option>
                                <option value="investing">Aktivitas Investasi / Proyek (Lahan, SPK, Infrastruktur)</option>
                                <option value="financing">Aktivitas Pendanaan (Bank, Modal, Dividen)</option>
                                <option value="none">Bukan Arus Kas Langsung (Non-Kas)</option>
                            </select>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary" id="labelPartyName">Diterima Dari / Dibayarkan Kepada</label>
                            <input type="text" name="party_name" class="form-control" placeholder="Contoh: PT Semen Perkasa / Bpk. Rudi">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-secondary">Metode Pembayaran</label>
                            <select name="payment_method" class="form-select">
                                <option value="Transfer Bank">Transfer Bank</option>
                                <option value="Tunai / Kas">Tunai / Kas</option>
                                <option value="Cek / Giro">Cek / Giro</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">Keterangan / Uraian Transaksi <span class="text-danger">*</span></label>
                        <textarea name="description" class="form-control" rows="2" placeholder="Tuliskan uraian tujuan pengeluaran / penerimaan secara rinci..." required></textarea>
                    </div>

                    <div class="mb-0">
                        <label class="form-label small fw-semibold text-secondary">Lampiran Bukti Transaksi (Kuitansi / Struk / Nota)</label>
                        <input type="file" name="proof_file" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        <div class="form-text text-muted" style="font-size: 0.72rem;">Format: JPG, PNG, PDF. Ukuran maks 5MB.</div>
                    </div>
                </div>
                <div class="modal-footer bg-light p-3">
                    <button type="button" class="btn btn-light btn-sm fw-semibold" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm fw-semibold px-4">
                        <i class="mdi mdi-content-save me-1"></i> Simpan Voucher
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Detail Voucher Slip --}}
<div class="modal fade" id="modalDetailVoucher" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content border-0 shadow">
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
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary btn-sm" onclick="window.print()"><i class="mdi mdi-printer me-1"></i>Cetak Slip</button>
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
