@extends('layouts.partial.app')

@section('title', 'Master Data Aturan Fee & Komisi - Property Management App')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-clean.css') }}?v={{ time() }}">
@endpush

@section('content')

<style>
    /* Styling Card Tabel Meniru Persis Card Total (.dash-kpi-card) */
    .card.compact-table-card,
    .compact-table-card {
        background: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 8px !important;
        box-shadow: none !important;
        transition: border-color 0.2s ease;
        overflow: hidden;
    }
    .card.compact-table-card:hover,
    .compact-table-card:hover {
        border-color: #cbd5e1 !important;
        box-shadow: none !important;
    }
    .compact-table-card .card-header {
        background: #ffffff !important;
        border-bottom: 1px solid #e2e8f0 !important;
        padding: 0.65rem 1.25rem !important;
        border-top-left-radius: 8px !important;
        border-top-right-radius: 8px !important;
    }
    .compact-table-card .card-body,
    .card.compact-table-card .card-body {
        padding: 0.75rem 1.25rem 1.15rem 1.25rem !important;
        background: #ffffff !important;
    }
    .compact-table-card .filter-card {
        margin-top: 0 !important;
        margin-bottom: 0.6rem !important;
    }
    .compact-table-card .filter-card form {
        margin-bottom: 0 !important;
    }

    /* Badges Khusus Kategori */
    .badge-kat-notaris,
    .badge-kat-makelar,
    .badge-kat-pajak,
    .badge-kat-pertanahan {
        display: inline-block !important;
        white-space: nowrap !important;
        font-weight: 700;
        font-size: 0.72rem;
        padding: 4px 10px;
        border-radius: 6px;
        text-align: center;
        letter-spacing: 0.2px;
    }
    .badge-kat-notaris {
        background-color: #f3e8ff;
        color: #7e22ce;
        border: 1px solid #e9d5ff;
    }
    .badge-kat-makelar {
        background-color: #fdf2f8;
        color: #be185d;
        border: 1px solid #fbcfe8;
    }
    .badge-kat-pajak {
        background-color: #ecfdf5;
        color: #047857;
        border: 1px solid #a7f3d0;
    }
    .badge-kat-pertanahan {
        background-color: #e0f2fe;
        color: #0369a1;
        border: 1px solid #bae6fd;
    }

    /* Badge Tipe Perhitungan */
    .badge-tipe-flat {
        background-color: #f8fafc;
        color: #1e293b;
        border: 1px solid #cbd5e1;
        font-weight: 600;
        font-size: 0.72rem;
        padding: 2px 6px;
        border-radius: 4px;
    }
    .badge-tipe-persen {
        background-color: #fffbeb;
        color: #b45309;
        border: 1px solid #fde68a;
        font-weight: 600;
        font-size: 0.72rem;
        padding: 2px 6px;
        border-radius: 4px;
    }
    .badge-tipe-meter {
        background-color: #eff6ff;
        color: #1d4ed8;
        border: 1px solid #bfdbfe;
        font-weight: 600;
        font-size: 0.72rem;
        padding: 2px 6px;
        border-radius: 4px;
    }

    /* Table Styling */
    .table-fee thead th {
        background: #f8fafc !important;
        color: #4b5563 !important;
        font-weight: 700;
        font-size: 0.78rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 1px solid #e2e8f0 !important;
        padding: 0.75rem 0.6rem !important;
        vertical-align: middle;
        white-space: nowrap;
    }
    .table-fee tbody td {
        padding: 0.75rem 0.6rem !important;
        vertical-align: middle;
        font-size: 0.83rem;
        border-bottom: 1px solid #f1f5f9;
        white-space: normal !important;
    }

    /* Action Buttons (Meniru Persis Halaman Bank) */
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
        font-size: 0.95rem;
        text-decoration: none;
        vertical-align: middle;
    }
    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }
    .btn-action.edit {
        background: #f59e0b !important;
        color: #ffffff !important;
    }
    .btn-action.delete {
        background: #ef4444 !important;
        color: #ffffff !important;
    }

    /* Toggle Switch Styling */
    .form-check-input:checked {
        background-color: #10b981 !important;
        border-color: #10b981 !important;
    }

    /* Modal Form Custom Styling */
    .modal-rule-custom .modal-content {
        border-radius: 14px !important;
        border: 1px solid #e2e8f0 !important;
        overflow: hidden;
    }
    .modal-rule-custom .modal-header {
        background: #ffffff !important;
        border-bottom: 1px solid #f1f5f9 !important;
        padding: 1rem 1.4rem !important;
    }
    .modal-rule-custom .modal-body {
        padding: 1.25rem 1.4rem !important;
        background: #ffffff !important;
        max-height: 75vh;
        overflow-y: auto;
    }
    .modal-rule-custom .modal-footer {
        background: #f8fafc !important;
        border-top: 1px solid #e2e8f0 !important;
        padding: 0.8rem 1.4rem !important;
    }
    .modal-rule-section {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 0.9rem 1rem 1rem 1rem;
        margin-bottom: 1rem;
    }
    .modal-rule-section-title {
        font-size: 0.78rem;
        font-weight: 700;
        color: #475569;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 0.75rem;
    }
    .modal-rule-custom .form-label {
        font-size: 0.78rem !important;
        font-weight: 600 !important;
        color: #334155 !important;
        margin-bottom: 0.35rem !important;
    }
    .modal-rule-custom .form-control,
    .modal-rule-custom .form-select {
        border: 1.5px solid #cbd5e1 !important;
        border-radius: 6px !important;
        font-size: 0.84rem !important;
        color: #1e293b !important;
        padding: 0.46rem 0.75rem !important;
        background-color: #ffffff !important;
        transition: all 0.2s ease;
    }
    .modal-rule-custom .form-control:focus,
    .modal-rule-custom .form-select:focus {
        border-color: #9a55ff !important;
        box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.12) !important;
        background-color: #ffffff !important;
    }
    /* Custom Seamless Input Group (Rp & %) */
    .input-group-fee {
        display: flex !important;
        flex-direction: row !important;
        flex-wrap: nowrap !important;
        align-items: stretch !important;
        width: 100% !important;
        position: relative !important;
    }
    .input-group-fee .fee-addon {
        background-color: #f8fafc !important;
        border: 1.5px solid #cbd5e1 !important;
        color: #334155 !important;
        font-weight: 700 !important;
        font-size: 0.84rem !important;
        padding: 0.46rem 0.85rem !important;
        margin: 0 !important;
        flex-shrink: 0 !important;
        line-height: 1 !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
    }
    .input-group-fee .fee-input {
        flex: 1 1 auto !important;
        width: 1% !important;
        min-width: 0 !important;
        border: 1.5px solid #cbd5e1 !important;
        font-size: 0.84rem !important;
        color: #1e293b !important;
        padding: 0.46rem 0.75rem !important;
        background-color: #ffffff !important;
        margin: 0 !important;
        transition: all 0.2s ease !important;
        outline: none !important;
    }
    
    /* 1. Mode Flat: Prefix Rp saja */
    .input-group-fee.mode-flat .fee-addon-prefix {
        border-radius: 6px 0 0 6px !important;
        border-right: none !important;
        display: inline-flex !important;
    }
    .input-group-fee.mode-flat .fee-input {
        border-radius: 0 6px 6px 0 !important;
        border-left: 1.5px solid #cbd5e1 !important;
    }
    .input-group-fee.mode-flat .fee-addon-suffix {
        display: none !important;
    }

    /* 2. Mode Persen: Suffix % saja */
    .input-group-fee.mode-persen .fee-addon-prefix {
        display: none !important;
    }
    .input-group-fee.mode-persen .fee-input {
        border-radius: 6px 0 0 6px !important;
        border-right: none !important;
        border-left: 1.5px solid #cbd5e1 !important;
    }
    .input-group-fee.mode-persen .fee-addon-suffix {
        border-radius: 0 6px 6px 0 !important;
        border-left: none !important;
        display: inline-flex !important;
    }

    /* 3. Mode Meter: Prefix Rp dan Suffix /m² */
    .input-group-fee.mode-meter .fee-addon-prefix {
        border-radius: 6px 0 0 6px !important;
        border-right: none !important;
        display: inline-flex !important;
    }
    .input-group-fee.mode-meter .fee-input {
        border-radius: 0 !important;
        border-right: none !important;
        border-left: 1.5px solid #cbd5e1 !important;
    }
    .input-group-fee.mode-meter .fee-addon-suffix {
        border-radius: 0 6px 6px 0 !important;
        border-left: none !important;
        display: inline-flex !important;
    }

    /* Focus ring on the whole group */
    .input-group-fee:focus-within {
        box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.14) !important;
        border-radius: 6px !important;
    }
    .input-group-fee:focus-within .fee-addon,
    .input-group-fee:focus-within .fee-input {
        border-color: #9a55ff !important;
        box-shadow: none !important;
    }
</style>

<div class="container-fluid px-2 px-md-4 py-3">

    <!-- Top Navigation & Page Title -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <div>
            <div class="d-flex align-items-center gap-2">
                <h2 class="text-dark mb-0 fw-bold" style="font-size: 1.35rem; letter-spacing: -0.02em;">
                    Master Aturan Fee & Komisi
                </h2>
            </div>
            <p class="text-muted mb-0 mt-0.5" style="font-size: 0.82rem;">
                Standar acuan tarif Fee AJB, Makelar, Notaris, Balik Nama, dan Pajak.
            </p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('keuangan.pembayaran.simulasi') }}" class="btn btn-sm btn-white border d-inline-flex align-items-center gap-1.5 px-3 py-2 shadow-sm fw-semibold" style="border-radius: 6px; font-size: 0.84rem; background: #ffffff; color: #334155;">
                <i class="mdi mdi-calculator text-primary" style="font-size: 1.05rem;"></i>
                <span>Simulasi & Hitung Fee</span>
            </a>
        </div>
    </div>

    <!-- Main Container: Table & Filters -->
    <div class="row mt-1">
        <div class="col-12">
            <div class="card compact-table-card" style="background: #ffffff !important; border: 1px solid #e2e8f0 !important; border-radius: 8px !important; box-shadow: none !important;">
                
                <!-- Card Header -->
                <div class="card-header bg-white d-flex flex-wrap justify-content-between align-items-center gap-2" style="padding: 0.55rem 1.25rem !important; border-bottom: 1px solid #e2e8f0 !important;">
                    <div class="d-flex align-items-center gap-2">
                        <div style="width: 28px; height: 28px; border-radius: 6px; background-color: #f3e8ff; color: #9333ea; display: inline-flex; align-items: center; justify-content: center; font-size: 1.05rem; flex-shrink: 0;">
                            <i class="mdi mdi-format-list-checks"></i>
                        </div>
                        <span style="font-size: 0.92rem; font-weight: 700; color: #0f172a;">Daftar Aturan Standar Tarif</span>
                    </div>

                    <button type="button" class="btn btn-sm btn-gradient-primary d-inline-flex align-items-center gap-1 px-3 py-1.5 shadow-sm fw-semibold" style="border-radius: 6px; font-size: 0.82rem;" onclick="bukaModalFormRule('tambah')">
                        <i class="mdi mdi-plus-circle" style="font-size: 0.95rem;"></i>
                        <span>Tambah</span>
                    </button>
                </div>

                <div class="card-body" style="padding: 0.75rem 1.25rem 1.15rem 1.25rem !important;">
                    
                    <!-- Filter Toolbar -->
                    <div class="filter-card" style="margin-top: 0 !important; margin-bottom: 0.6rem !important;">
                        <form id="filterForm" method="GET" action="{{ route('keuangan.pembayaran.index') }}" style="margin-bottom: 0 !important;">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                
                                <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                    <!-- Search Input -->
                                    <div style="min-width: 240px; max-width: 340px; flex: 1;">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" id="liveSearchInput"
                                                placeholder="Cari kode, nama fee, penerima, proyek..."
                                                value="{{ request('search') }}"
                                                onkeyup="applyLiveSearch(this.value)"
                                                style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                            <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                type="submit" title="Cari"
                                                style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Filter Kategori -->
                                    <div style="width: 175px;">
                                        <select class="form-control" name="kategori" id="kategoriFilterSelect" onchange="document.getElementById('filterForm').submit()">
                                            <option value="all">Semua Kategori</option>
                                            <option value="notaris" {{ request('kategori') == 'notaris' ? 'selected' : '' }}>Notaris / PPAT</option>
                                            <option value="makelar" {{ request('kategori') == 'makelar' ? 'selected' : '' }}>Makelar & Agency</option>
                                            <option value="pajak" {{ request('kategori') == 'pajak' ? 'selected' : '' }}>Perpajakan</option>
                                            <option value="pertanahan" {{ request('kategori') == 'pertanahan' ? 'selected' : '' }}>Pertanahan BPN</option>
                                        </select>
                                    </div>

                                    <!-- Filter Tipe Hitung -->
                                    <div style="width: 165px;">
                                        <select class="form-control" name="tipe_hitung" id="tipeFilterSelect" onchange="document.getElementById('filterForm').submit()">
                                            <option value="all">Semua Tipe Hitung</option>
                                            <option value="flat" {{ request('tipe_hitung') == 'flat' ? 'selected' : '' }}>Nominal Tetap (Flat)</option>
                                            <option value="persen" {{ request('tipe_hitung') == 'persen' ? 'selected' : '' }}>Persentase (%)</option>
                                            <option value="meter" {{ request('tipe_hitung') == 'meter' ? 'selected' : '' }}>Per Meter (m²)</option>
                                        </select>
                                    </div>

                                    <!-- Filter Status -->
                                    <div style="width: 140px;">
                                        <select class="form-control" name="status" id="statusFilterSelect" onchange="document.getElementById('filterForm').submit()">
                                            <option value="all">Semua Status</option>
                                            <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Aktif</option>
                                            <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Non-aktif</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Reset & Filter Button -->
                                <div class="d-flex align-items-center gap-2 ms-auto">
                                    <button type="submit" class="btn btn-gradient-primary btn-icon-only" title="Terapkan Filter">
                                        <i class="mdi mdi-filter"></i>
                                    </button>
                                    <a href="{{ route('keuangan.pembayaran.index') }}" class="btn btn-gradient-secondary btn-icon-only" title="Reset Filter">
                                        <i class="mdi mdi-refresh"></i>
                                    </a>
                                </div>

                            </div>
                        </form>
                    </div>

                    <!-- TABEL MASTER DATA ATURAN FEE -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle table-fee mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 45px; text-align: center;">No</th>
                                    <th>Nama Aturan Fee</th>
                                    <th style="width: 130px; white-space: nowrap;">Kategori</th>
                                    <th style="width: 165px; white-space: nowrap;">Besaran Tarif</th>
                                    <th>Pihak Penerima Default</th>
                                    <th style="width: 80px; white-space: nowrap;" class="text-center">Status</th>
                                    <th style="width: 90px; white-space: nowrap;" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($rules as $index => $r)
                                    @php
                                        $katBadge = 'badge-kat-notaris';
                                        if ($r['kategori'] === 'makelar') $katBadge = 'badge-kat-makelar';
                                        elseif ($r['kategori'] === 'pajak') $katBadge = 'badge-kat-pajak';
                                        elseif ($r['kategori'] === 'pertanahan') $katBadge = 'badge-kat-pertanahan';
                                    @endphp
                                    <tr class="fee-table-row" id="row_fee_{{ $r['id'] }}" 
                                        data-search="{{ strtolower($r['kode_fee'] . ' ' . $r['nama_fee'] . ' ' . $r['kategori_label'] . ' ' . $r['target_penerima'] . ' ' . $r['proyek'] . ' ' . $r['keterangan']) }}">
                                        
                                        <td class="text-center text-muted fw-semibold">{{ $loop->iteration }}</td>

                                        <td>
                                            <div class="fw-bold text-dark" style="font-size: 0.86rem; line-height: 1.35;">
                                                {{ $r['nama_fee'] }}
                                            </div>
                                            <div class="d-flex align-items-center gap-1.5 mt-0.5">
                                                <span class="badge bg-light text-secondary border font-monospace" style="font-size: 0.7rem; font-weight: 500;">
                                                    {{ $r['kode_fee'] }}
                                                </span>
                                                @if(!empty($r['syarat_cair']))
                                                    <i class="mdi mdi-information-outline text-muted" style="font-size: 0.85rem; cursor: pointer;" title="Syarat: {{ $r['syarat_cair'] }}" data-bs-toggle="tooltip"></i>
                                                @endif
                                            </div>
                                        </td>

                                        <td style="white-space: nowrap;">
                                            <span class="{{ $katBadge }}">
                                                {{ $r['kategori_label'] }}
                                            </span>
                                        </td>

                                        <td style="white-space: nowrap;">
                                            <span class="fw-bold text-dark" style="font-size: 0.88rem;">
                                                @if($r['tipe_hitung'] === 'flat')
                                                    Rp {{ number_format($r['nilai'], 0, ',', '.') }}
                                                @elseif($r['tipe_hitung'] === 'persen')
                                                    {{ number_format($r['nilai'], 1, ',', '.') }}%
                                                @else
                                                    Rp {{ number_format($r['nilai'], 0, ',', '.') }}/m²
                                                @endif
                                            </span>
                                            <span class="badge bg-light text-muted border ms-1" style="font-size: 0.68rem; font-weight: 500;">
                                                {{ $r['tipe_hitung'] === 'flat' ? 'Flat' : ($r['tipe_hitung'] === 'persen' ? '% Transaksi' : 'Per m²') }}
                                            </span>
                                        </td>

                                        <td>
                                            <span class="text-dark" style="font-size: 0.84rem;">
                                                {{ $r['target_penerima'] }}
                                            </span>
                                        </td>

                                        <td class="text-center" style="white-space: nowrap;">
                                            <div class="form-check form-switch d-inline-block mb-0">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    id="switchStatus_{{ $r['id'] }}"
                                                    {{ $r['is_active'] ? 'checked' : '' }}
                                                    onchange='toggleStatusItem(@json($r), this)'
                                                    title="{{ $r['is_active'] ? 'Status: Aktif' : 'Status: Non-aktif' }}"
                                                    style="cursor: pointer; width: 34px; height: 18px;">
                                            </div>
                                        </td>

                                        <td class="text-center" style="white-space: nowrap;">
                                            <div class="d-inline-flex align-items-center gap-1">
                                                <button type="button" class="btn-action edit" title="Edit Aturan" onclick='editItemIni(@json($r))'>
                                                    <i class="mdi mdi-pencil"></i>
                                                </button>
                                                <button type="button" class="btn-action delete" title="Hapus Aturan" onclick='hapusItemIni(@json($r))'>
                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">
                                            <i class="mdi mdi-cog-off me-2" style="font-size: 1.5rem;"></i>
                                            Tidak ada aturan fee yang sesuai dengan filter.
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

<!-- ================= MODAL TAMBAH / EDIT ATURAN FEE ================= -->
<div class="modal fade modal-rule-custom" id="modalFormRule" tabindex="-1" aria-labelledby="modalFormRuleLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 680px;">
        <div class="modal-content border-0 shadow-lg">
            
            <div class="modal-header d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2.5">
                    <div id="modalFormIconBox" style="width: 36px; height: 36px; border-radius: 8px; background-color: #f3e8ff; color: #9333ea; display: inline-flex; align-items: center; justify-content: center; font-size: 1.2rem; flex-shrink: 0;">
                        <i class="mdi mdi-plus-box-multiple-outline" id="modalFormIcon"></i>
                    </div>
                    <div>
                        <h5 class="modal-title mb-0 fw-bold text-dark" id="modalFormTitle" style="font-size: 1rem; letter-spacing: -0.01em;">
                            Tambah Aturan Standar Fee Baru
                        </h5>
                        <p class="text-muted mb-0" id="modalFormSubtitle" style="font-size: 0.77rem;">
                            Tetapkan acuan tarif standar, metode hitung, dan penerima fee.
                        </p>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="formRule" onsubmit="simpanAturanFee(event)">
                <div class="modal-body">

                    <!-- Section 1: Identitas & Klasifikasi -->
                    <div class="modal-rule-section">
                        <div class="modal-rule-section-title">
                            <i class="mdi mdi-tag-text-outline text-primary" style="font-size: 1rem;"></i>
                            <span>1. Identitas & Penerima Hak Fee</span>
                        </div>
                        <div class="row g-2.5">
                            <div class="col-md-4">
                                <label class="form-label">Kode Fee <span class="text-danger">*</span></label>
                                <input type="text" class="form-control font-monospace fw-bold" name="kode_fee" id="input_kode_fee" placeholder="FEE-AJB-02" required>
                            </div>
                            <div class="col-md-8">
                                <label class="form-label">Nama Aturan Fee <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nama_fee" id="input_nama_fee" placeholder="Contoh: Fee AJB Notaris / Komisi Penjualan" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Kategori Fee <span class="text-danger">*</span></label>
                                <select class="form-select" name="kategori" id="input_kategori" required>
                                    <option value="notaris">Notaris & PPAT</option>
                                    <option value="makelar">Makelar & Agen Lepas</option>
                                    <option value="pertanahan">Pertanahan (BPN / Balik Nama)</option>
                                    <option value="pajak">Pajak Daerah & Pusat (BPHTB/PPh)</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Pihak Penerima Default <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="target_penerima" id="input_target_penerima" list="notarisDatalist" placeholder="PPAT Bambang Trihatmodjo / Makelar" required>
                                <datalist id="notarisDatalist">
                                    @foreach($notarisList as $n)
                                        <option value="{{ $n->nama_notaris }}">
                                    @endforeach
                                    <option value="Makelar / Agen Lepas / Broker Eksternal">
                                    <option value="Bapenda Kabupaten Jember">
                                    <option value="Kantor Pertanahan ATR/BPN Kab. Jember">
                                    <option value="Petugas Ukur BPN & Notaris Rekanan">
                                </datalist>
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Besaran Tarif & Cakupan -->
                    <div class="modal-rule-section">
                        <div class="modal-rule-section-title">
                            <i class="mdi mdi-calculator-variant-outline text-primary" style="font-size: 1rem;"></i>
                            <span>2. Besaran Tarif & Cakupan Proyek</span>
                        </div>
                        <div class="row g-2.5">
                            <div class="col-md-6">
                                <label class="form-label">Metode Perhitungan <span class="text-danger">*</span></label>
                                <select class="form-select" name="tipe_hitung" id="input_tipe_hitung" onchange="updateSatuanLabel(this.value)" required>
                                    <option value="flat">Nominal Tetap (Flat Rp)</option>
                                    <option value="persen">Persentase (%) dari Transaksi</option>
                                    <option value="meter">Per Meter Persegi (Rp/m²)</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Besaran Nilai Tarif <span class="text-danger">*</span></label>
                                <div class="input-group-fee mode-flat" id="wrapper_input_tarif">
                                    <span class="fee-addon fee-addon-prefix" id="label_prefix_nilai">Rp</span>
                                    <input type="number" step="any" class="fee-input fw-bold" name="nilai" id="input_nilai" placeholder="5000000" required>
                                    <span class="fee-addon fee-addon-suffix" id="label_suffix_nilai">%</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Berlaku di Proyek</label>
                                <select class="form-select" name="proyek" id="input_proyek">
                                    <option value="Semua Proyek">Semua Proyek (Global)</option>
                                    @foreach($proyekList as $p)
                                        <option value="{{ $p->name }}">{{ $p->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tipe Unit Target</label>
                                <input type="text" class="form-control" name="tipe_unit" id="input_tipe_unit" placeholder="Semua Tipe / Contoh: Komersil 45/90">
                            </div>
                        </div>
                    </div>

                    <!-- Status Toggle Sederhana (Cukup Status) -->
                    <div class="d-flex align-items-center justify-content-between p-2 px-3 rounded-2 mt-2" style="background: #f8fafc; border: 1px solid #cbd5e1;">
                        <span class="fw-bold text-dark small">Status</span>
                        <div class="form-check form-switch mb-0">
                            <input class="form-check-input" type="checkbox" id="input_is_active" checked style="cursor: pointer; width: 34px; height: 18px;">
                        </div>
                    </div>

                </div>

                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-sm btn-white border px-3 py-1.5 fw-semibold text-secondary" data-bs-dismiss="modal" style="border-radius: 6px; font-size: 0.82rem;">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-sm btn-gradient-primary px-4 py-1.5 fw-semibold shadow-sm d-inline-flex align-items-center gap-1.5" style="border-radius: 6px; font-size: 0.82rem;">
                        <i class="mdi mdi-content-save" style="font-size: 0.95rem;"></i>
                        <span>Simpan Aturan Fee</span>
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

@push('scripts')
<script>
    // Data aturan fee dari backend
    const masterRulesData = @json($rules->values());

    // Live Search Table
    function applyLiveSearch(keyword) {
        keyword = (keyword || '').toLowerCase().trim();
        const rows = document.querySelectorAll('.fee-table-row');

        rows.forEach(row => {
            const searchData = row.getAttribute('data-search') || '';
            if (!keyword || searchData.includes(keyword)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Ubah prefix / suffix input nilai form
    function updateSatuanLabel(tipe) {
        const wrapper = document.getElementById('wrapper_input_tarif');
        const suffix = document.getElementById('label_suffix_nilai');
        if (!wrapper) return;

        wrapper.classList.remove('mode-flat', 'mode-persen', 'mode-meter');
        if (tipe === 'persen') {
            wrapper.classList.add('mode-persen');
            if (suffix) suffix.innerText = '%';
        } else if (tipe === 'meter') {
            wrapper.classList.add('mode-meter');
            if (suffix) suffix.innerText = '/m²';
        } else {
            wrapper.classList.add('mode-flat');
        }
    }

    // Buka Modal Form Tambah / Edit
    function bukaModalFormRule(mode, data = null) {
        const modalEl = document.getElementById('modalFormRule');
        const titleEl = document.getElementById('modalFormTitle');
        const subtitleEl = document.getElementById('modalFormSubtitle');
        const iconEl = document.getElementById('modalFormIcon');
        
        if (mode === 'edit' && data) {
            titleEl.innerText = 'Ubah Aturan Standar Fee';
            subtitleEl.innerText = 'Perbarui standar tarif & ketentuan: ' + data.nama_fee;
            if (iconEl) iconEl.className = 'mdi mdi-pencil-box-multiple-outline';
            document.getElementById('input_kode_fee').value = data.kode_fee;
            document.getElementById('input_nama_fee').value = data.nama_fee;
            document.getElementById('input_kategori').value = data.kategori;
            document.getElementById('input_target_penerima').value = data.target_penerima;
            document.getElementById('input_tipe_hitung').value = data.tipe_hitung;
            document.getElementById('input_nilai').value = data.nilai;
            document.getElementById('input_proyek').value = data.proyek || 'Semua Proyek';
            document.getElementById('input_tipe_unit').value = data.tipe_unit || '';
            const inpSyarat = document.getElementById('input_syarat_cair');
            if (inpSyarat) inpSyarat.value = data.syarat_cair || '';
            const inpKet = document.getElementById('input_keterangan');
            if (inpKet) inpKet.value = data.keterangan || '';
            document.getElementById('input_is_active').checked = !!data.is_active;
            updateSatuanLabel(data.tipe_hitung);
        } else {
            titleEl.innerText = 'Tambah Aturan Standar Fee Baru';
            subtitleEl.innerText = 'Tetapkan acuan tarif standar, metode hitung, dan penerima fee.';
            if (iconEl) iconEl.className = 'mdi mdi-plus-box-multiple-outline';
            document.getElementById('formRule').reset();
            document.getElementById('input_kode_fee').value = 'FEE-NEW-' + Math.floor(10 + Math.random() * 90);
            document.getElementById('input_proyek').value = 'Semua Proyek';
            document.getElementById('input_is_active').checked = true;
            updateSatuanLabel('flat');
        }

        const modal = new bootstrap.Modal(modalEl);
        modal.show();
    }

    // Edit item dari baris tabel
    function editItemIni(data) {
        bukaModalFormRule('edit', data);
    }

    // Simpan Aturan Fee
    function simpanAturanFee(e) {
        e.preventDefault();
        const modalEl = document.getElementById('modalFormRule');
        const modal = bootstrap.Modal.getInstance(modalEl);
        if (modal) modal.hide();

        if (typeof Swal !== 'undefined') {
            Swal.fire({
                icon: 'success',
                title: 'Aturan Fee Berhasil Disimpan!',
                text: 'Ketentuan fee telah diperbarui dan otomatis siap digunakan di transaksi.',
                confirmButtonColor: '#9a55ff',
                timer: 2000
            }).then(() => {
                location.reload();
            });
        } else {
            alert('Aturan Fee Berhasil Disimpan!');
            location.reload();
        }
    }

    // Toggle Status Aktif / Non-aktif (Instant Tanpa Reload / Loading)
    function toggleStatusItem(data, checkbox) {
        const isAktif = checkbox ? checkbox.checked : !data.is_active;
        data.is_active = isAktif;

        if (checkbox) {
            checkbox.title = isAktif ? 'Status: Aktif' : 'Status: Non-aktif';
        }

        // Tampilkan toast notifikasi instan di sudut kanan atas (tanpa reload halaman)
        if (typeof Swal !== 'undefined') {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1800,
                timerProgressBar: true
            });

            Toast.fire({
                icon: isAktif ? 'success' : 'info',
                title: `${data.nama_fee} berhasil ${isAktif ? 'diaktifkan' : 'dinonaktifkan'}`
            });
        }
    }

    // Hapus Aturan Fee
    function hapusItemIni(data) {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Hapus Aturan Fee?',
                html: `Apakah Anda yakin ingin menghapus aturan <strong>${data.nama_fee}</strong> (${data.kode_fee})?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e11d48',
                cancelButtonColor: '#64748b',
                confirmButtonText: '<i class="mdi mdi-delete me-1"></i>Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((res) => {
                if (res.isConfirmed) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Aturan Berhasil Dihapus!',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        const row = document.getElementById(`row_fee_${data.id}`);
                        if (row) row.remove();
                    });
                }
            });
        } else {
            if (confirm(`Apakah Anda yakin ingin menghapus aturan ${data.nama_fee}?`)) {
                const row = document.getElementById(`row_fee_${data.id}`);
                if (row) row.remove();
            }
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endpush
@endsection
