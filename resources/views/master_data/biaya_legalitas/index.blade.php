@extends('layouts.partial.app')

@section('title', 'Master Biaya Legalitas & Administrasi - Property Management App')

@push('styles')
<style>
    /* Design Tokens persis Perizinan & Dashboard Modern */
    :root {
        --primary-purple: #7c3aed;
        --border-color: #e2e8f0;
    }

    /* KPI Grid & Cards */
    .dash-kpi-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
    }
    @media (max-width: 991.98px) {
        .dash-kpi-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    @media (max-width: 575.98px) {
        .dash-kpi-grid {
            grid-template-columns: 1fr;
        }
    }

    .dash-kpi-card {
        background: #ffffff;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 1.1rem 1.25rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: all 0.2s ease;
    }
    .dash-kpi-card:hover {
        border-color: #cbd5e1;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
    }
    .dash-kpi-left {
        display: flex;
        align-items: center;
        gap: 0.9rem;
    }
    .dash-kpi-icon {
        width: 44px;
        height: 44px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.35rem;
        flex-shrink: 0;
    }
    .dash-kpi-icon.purple { background: rgba(124, 58, 237, 0.1); color: #7c3aed; }
    .dash-kpi-icon.green  { background: rgba(16, 185, 129, 0.1); color: #10b981; }
    .dash-kpi-icon.blue   { background: rgba(14, 165, 233, 0.1); color: #0ea5e9; }
    .dash-kpi-icon.rose   { background: rgba(244, 63, 94, 0.1);  color: #f43f5e; }

    .dash-kpi-label {
        font-size: 0.76rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #64748b;
        margin-bottom: 2px;
    }
    .dash-kpi-val {
        font-size: 1.45rem;
        font-weight: 700;
        color: #0f172a;
        line-height: 1.2;
    }
    .dash-kpi-sub {
        font-size: 0.73rem;
        color: #94a3b8;
        margin-top: 2px;
    }

    /* Compact Table Card persis Perizinan */
    .compact-table-card {
        background: #ffffff !important;
        border: 1px solid var(--border-color) !important;
        border-radius: 8px !important;
        box-shadow: none !important;
        transition: border-color 0.2s ease;
    }
    .compact-table-card .card-header {
        background: #ffffff !important;
        border-bottom: 1px solid var(--border-color) !important;
        padding: 0.65rem 1.25rem !important;
        border-top-left-radius: 8px !important;
        border-top-right-radius: 8px !important;
    }
    .compact-table-card .card-body {
        padding: 0.75rem 1.25rem 1.15rem 1.25rem !important;
        background: #ffffff !important;
    }

    /* Table Perizinan Styling */
    .table-perizinan {
        width: 100% !important;
        margin-bottom: 0;
    }
    .table-perizinan thead th {
        background: #f8fafc !important;
        color: #4b5563 !important;
        font-weight: 700;
        font-size: 0.78rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid var(--border-color) !important;
        padding: 0.75rem 0.6rem !important;
        vertical-align: middle;
        white-space: nowrap;
    }
    .table-perizinan tbody td {
        padding: 0.75rem 0.6rem !important;
        vertical-align: middle;
        font-size: 0.83rem;
        border-bottom: 1px solid #f1f5f9;
        white-space: normal !important;
    }
    .table-perizinan .col-no {
        width: 45px;
        text-align: center;
        white-space: nowrap !important;
    }

    /* Standard Action Buttons persis Halaman Bank */
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
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
    }
    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }
    .btn-action.edit {
        background: #f59e0b !important;
        color: #ffffff !important;
    }
    .btn-action.edit:hover {
        background: #d97706 !important;
        color: #ffffff !important;
    }
    .btn-action.delete {
        background: #ef4444 !important;
        color: #ffffff !important;
    }
    .btn-action.delete:hover {
        background: #dc2626 !important;
        color: #ffffff !important;
    }

    /* Category Badges */
    .badge-cat-legalitas {
        background: #f3e8ff;
        color: #7e22ce;
        border: 1px solid #e9d5ff;
        font-weight: 600;
        font-size: 0.73rem;
        padding: 3px 8px;
        border-radius: 5px;
    }
    .badge-cat-pajak {
        background: #fee2e2;
        color: #b91c1c;
        border: 1px solid #fecaca;
        font-weight: 600;
        font-size: 0.73rem;
        padding: 3px 8px;
        border-radius: 5px;
    }
    .badge-cat-broker {
        background: #fef3c7;
        color: #b45309;
        border: 1px solid #fde68a;
        font-weight: 600;
        font-size: 0.73rem;
        padding: 3px 8px;
        border-radius: 5px;
    }
    .badge-cat-desa {
        background: #ecfdf5;
        color: #059669;
        border: 1px solid #a7f3d0;
        font-weight: 600;
        font-size: 0.73rem;
        padding: 3px 8px;
        border-radius: 5px;
    }
    .badge-cat-admin {
        background: #e0f2fe;
        color: #0284c7;
        border: 1px solid #bae6fd;
        font-weight: 600;
        font-size: 0.73rem;
        padding: 3px 8px;
        border-radius: 5px;
    }

    /* Penanggung Badges (High Contrast) */
    .badge-penanggung-dev {
        background: #e0f2fe;
        color: #0369a1;
        border: 1px solid #bae6fd;
        font-weight: 600;
        font-size: 0.73rem;
        padding: 3px 8px;
        border-radius: 5px;
    }
    .badge-penanggung-pembeli {
        background: #fef3c7;
        color: #b45309;
        border: 1px solid #fde68a;
        font-weight: 600;
        font-size: 0.73rem;
        padding: 3px 8px;
        border-radius: 5px;
    }
    .badge-penanggung-penjual {
        background: #f1f5f9;
        color: #334155;
        border: 1px solid #cbd5e1;
        font-weight: 600;
        font-size: 0.73rem;
        padding: 3px 8px;
        border-radius: 5px;
    }
    .badge-penanggung-split {
        background: #ede9fe;
        color: #6d28d9;
        border: 1px solid #ddd6fe;
        font-weight: 600;
        font-size: 0.73rem;
        padding: 3px 8px;
        border-radius: 5px;
    }

    /* Sifat Badges */
    .badge-sifat-baku {
        background: #f5f3ff;
        color: #6d28d9;
        border: 1px solid #ddd6fe;
        font-weight: 600;
        font-size: 0.72rem;
        padding: 3px 8px;
        border-radius: 5px;
    }
    .badge-sifat-tambahan {
        background: #f8fafc;
        color: #64748b;
        border: 1px solid #e2e8f0;
        font-weight: 500;
        font-size: 0.72rem;
        padding: 3px 8px;
        border-radius: 5px;
    }

    /* Custom Switch Styling */
    .custom-switch-clean .form-check-input {
        cursor: pointer;
        width: 36px;
        height: 18px;
        margin-top: 0.15rem;
    }
    .custom-switch-clean .form-check-input:checked {
        background-color: #10b981;
        border-color: #10b981;
    }

    /* Modal Form Controls */
    #modalBiayaLegalitas .modal-content {
        border-radius: 6px !important;
        border: 1px solid #e2e8f0;
        overflow: hidden;
    }
    #modalBiayaLegalitas input.form-control,
    #modalBiayaLegalitas select.form-control,
    #modalBiayaLegalitas .input-group-text {
        height: 38px;
        font-size: 0.86rem;
        border-radius: 5px;
        border-color: #cbd5e1;
    }
    #modalBiayaLegalitas textarea.form-control {
        border-radius: 5px;
        border-color: #cbd5e1;
        font-size: 0.86rem;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-2 px-md-4 py-3">

    <!-- Header Judul Halaman -->
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-3">
        <div>
            <h2 class="text-dark mb-1 fw-bold" style="font-size: 1.55rem; letter-spacing: -0.02em;">
                Master Biaya Legalitas, Pajak & Administrasi
            </h2>
            <p class="text-muted mb-0" style="font-size: 0.88rem;">
                Katalog acuan tarif baku IJB/PPJB Notaris, Estimasi Pajak PPh/BPHTB, Fee Makelar, Kompensasi Desa, hingga biaya operasional tanah.
            </p>
        </div>
    </div>

    <!-- Alert Notifikasi -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm d-flex align-items-center gap-2 mb-3" role="alert" style="border-radius: 6px; background: #ecfdf5; color: #065f46;">
            <i class="mdi mdi-check-circle fs-5 text-success"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm d-flex align-items-center gap-2 mb-3" role="alert" style="border-radius: 6px; background: #fef2f2; color: #991b1b;">
            <i class="mdi mdi-alert-circle fs-5 text-danger"></i>
            <div>{{ session('error') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Quick Stats Cards (KPI Cards Persis Perizinan) -->
    <div class="dash-kpi-grid mb-3 mb-md-4">
        <!-- Card 1: Total Komponen (Ungu) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon purple">
                    <i class="mdi mdi-calculator-variant-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Total Komponen</div>
                    <div class="dash-kpi-val">{{ $stats['total'] ?? 0 }}</div>
                    <div class="dash-kpi-sub">Seluruh Tarif Terdaftar</div>
                </div>
            </div>
        </div>

        <!-- Card 2: Biaya Aktif (Hijau) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon green">
                    <i class="mdi mdi-check-circle-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Biaya Aktif</div>
                    <div class="dash-kpi-val text-success">{{ $stats['active'] ?? 0 }}</div>
                    <div class="dash-kpi-sub">Siap Digunakan di Form</div>
                </div>
            </div>
        </div>

        <!-- Card 3: Komponen Baku (Biru) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon blue">
                    <i class="mdi mdi-star-circle-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Komponen Baku</div>
                    <div class="dash-kpi-val" style="color: #0284c7;">{{ $stats['standard'] ?? 0 }}</div>
                    <div class="dash-kpi-sub">Standar Pra Land Bank</div>
                </div>
            </div>
        </div>

        <!-- Card 4: Biaya Tambahan (Rose / Merah) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon rose">
                    <i class="mdi mdi-plus-box-multiple-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Biaya Tambahan</div>
                    <div class="dash-kpi-val text-danger">{{ $stats['custom'] ?? 0 }}</div>
                    <div class="dash-kpi-sub">Komponen Opsional / Kustom</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Table Container Card -->
    <div class="row">
        <div class="col-12">
            <div class="card compact-table-card">
                <!-- Card Header with Action Buttons -->
                <div class="card-header bg-white d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <div class="d-flex align-items-center gap-2">
                        <div style="width: 32px; height: 32px; border-radius: 5px; background-color: #f3e8ff; color: #9333ea; display: inline-flex; align-items: center; justify-content: center; font-size: 1.15rem; flex-shrink: 0;">
                            <i class="mdi mdi-format-list-checks"></i>
                        </div>
                        <span style="font-size: 0.95rem; font-weight: 700; color: #0f172a;">
                            Daftar Komponen Biaya Legalitas & Administrasi
                        </span>
                    </div>

                    <div>
                        <a href="{{ route('master.biaya-legalitas.create') }}" class="btn btn-sm btn-gradient-primary d-inline-flex align-items-center gap-1.5 px-3 py-1.5 fw-semibold shadow-sm" style="border-radius: 5px; font-size: 0.84rem;">
                            <i class="mdi mdi-plus-circle-outline fs-6" style="margin-right: 2px !important;"></i>
                            <span>Tambah Komponen Biaya</span>
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Filter Toolbar -->
                    <div class="filter-card mb-3">
                        <form id="filterForm" method="GET" action="{{ route('master.biaya-legalitas.index') }}">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                    <!-- Search Input -->
                                    <div style="min-width: 220px; max-width: 300px; flex: 1;">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" id="liveSearchInput"
                                                placeholder="Cari kode, nama biaya..."
                                                value="{{ request('search') }}"
                                                onkeyup="applyLiveSearch(this.value)"
                                                style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none; height: 38px; border-radius: 5px;">
                                            <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                type="submit" title="Cari"
                                                style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 5px !important; border-bottom-right-radius: 5px !important; height: 38px; box-shadow: none;">
                                                <i class="mdi mdi-magnify text-white"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Category Filter -->
                                    <div style="width: 180px;">
                                        <select class="form-control" name="kategori" id="categorySelect" onchange="document.getElementById('filterForm').submit()" style="height: 38px; border-radius: 5px;">
                                            <option value="">Semua Kategori</option>
                                            @foreach($categories as $catKey => $catLabel)
                                                <option value="{{ $catKey }}" {{ request('kategori') == $catKey ? 'selected' : '' }}>{{ $catKey }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Tipe Perhitungan Filter -->
                                    <div style="width: 160px;">
                                        <select class="form-control" name="tipe_perhitungan" id="tipeSelect" onchange="document.getElementById('filterForm').submit()" style="height: 38px; border-radius: 5px;">
                                            <option value="">Semua Tipe</option>
                                            <option value="nominal_tetap" {{ request('tipe_perhitungan') == 'nominal_tetap' ? 'selected' : '' }}>Nominal Tetap</option>
                                            <option value="persentase" {{ request('tipe_perhitungan') == 'persentase' ? 'selected' : '' }}>Persentase (%)</option>
                                            <option value="fleksibel" {{ request('tipe_perhitungan') == 'fleksibel' ? 'selected' : '' }}>Fleksibel</option>
                                        </select>
                                    </div>

                                    <!-- Status Filter -->
                                    <div style="width: 130px;">
                                        <select class="form-control" name="status" id="statusSelect" onchange="document.getElementById('filterForm').submit()" style="height: 38px; border-radius: 5px;">
                                            <option value="">Semua Status</option>
                                            <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Aktif</option>
                                            <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Nonaktif</option>
                                        </select>
                                    </div>

                                    <!-- Sifat Standar Filter -->
                                    <div style="width: 140px;">
                                        <select class="form-control" name="is_standard" id="standardSelect" onchange="document.getElementById('filterForm').submit()" style="height: 38px; border-radius: 5px;">
                                            <option value="">Semua Sifat</option>
                                            <option value="1" {{ request('is_standard') === '1' ? 'selected' : '' }}>Baku Standar</option>
                                            <option value="0" {{ request('is_standard') === '0' ? 'selected' : '' }}>Tambahan</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Right Limit & Buttons -->
                                <div class="d-flex align-items-center gap-2 ms-auto">
                                    <div style="width: 105px;">
                                        <select class="form-control" name="per_page" id="perPageSelect" onchange="document.getElementById('filterForm').submit()" style="height: 38px; border-radius: 5px;">
                                            <option value="10" {{ request('per_page', 15) == 10 ? 'selected' : '' }}>10 data</option>
                                            <option value="15" {{ request('per_page', 15) == 15 ? 'selected' : '' }}>15 data</option>
                                            <option value="25" {{ request('per_page', 15) == 25 ? 'selected' : '' }}>25 data</option>
                                            <option value="50" {{ request('per_page', 15) == 50 ? 'selected' : '' }}>50 data</option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-gradient-primary btn-icon-only" title="Terapkan Filter" style="height: 38px; width: 38px; border-radius: 5px;">
                                        <i class="mdi mdi-filter"></i>
                                    </button>
                                    @if(request()->hasAny(['search', 'kategori', 'tipe_perhitungan', 'status', 'is_standard', 'per_page']))
                                        <a href="{{ route('master.biaya-legalitas.index') }}" class="btn btn-gradient-secondary btn-icon-only" title="Reset Filter" style="height: 38px; width: 38px; border-radius: 5px;">
                                            <i class="mdi mdi-refresh"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- TABEL DATA -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle table-perizinan">
                            <thead>
                                <tr>
                                    <th class="col-no">No</th>
                                    <th style="width: 140px;">Kode Biaya</th>
                                    <th>Nama Komponen Biaya & Keterangan</th>
                                    <th style="width: 160px;">Kategori</th>
                                    <th style="width: 160px;">Tipe & Acuan</th>
                                    <th style="width: 140px;">Penanggung</th>
                                    <th class="text-center" style="width: 95px;">Sifat</th>
                                    <th class="text-center" style="width: 85px;">Status</th>
                                    <th class="text-center" style="width: 95px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($biayas as $index => $item)
                                    @php
                                        $catClass = match($item->kategori) {
                                            'Legalitas & Notaris'       => 'badge-cat-legalitas',
                                            'Pajak & Retribusi'         => 'badge-cat-pajak',
                                            'Perantara & Broker'        => 'badge-cat-broker',
                                            'Perizinan & Kas Desa'      => 'badge-cat-desa',
                                            default                     => 'badge-cat-admin',
                                        };

                                        $penanggungClass = match($item->pihak_penanggung) {
                                            'perusahaan' => 'badge-penanggung-dev',
                                            'pembeli'    => 'badge-penanggung-pembeli',
                                            'penjual'    => 'badge-penanggung-penjual',
                                            default      => 'badge-penanggung-split',
                                        };

                                        $penanggungLabel = match($item->pihak_penanggung) {
                                            'perusahaan' => 'Perusahaan (Dev)',
                                            'pembeli'    => 'Beban Pembeli',
                                            'penjual'    => 'Beban Penjual',
                                            'bagi_dua'   => 'Bagi Dua (50:50)',
                                            default      => $pihakPenanggung[$item->pihak_penanggung] ?? ucfirst($item->pihak_penanggung),
                                        };
                                    @endphp
                                    <tr class="biaya-table-row" data-search="{{ strtolower($item->kode_biaya . ' ' . $item->nama_biaya . ' ' . $item->kategori . ' ' . $penanggungLabel) }}">
                                        <td class="col-no fw-bold text-center text-muted">
                                            {{ $biayas->firstItem() + $index }}
                                        </td>
                                        <td>
                                            <span class="badge font-monospace" style="background: #f8fafc; color: #334155; border: 1px solid #e2e8f0; font-size: 0.74rem; padding: 3px 6px; letter-spacing: 0.3px;">
                                                {{ $item->kode_biaya }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="fw-bold text-dark" style="font-size: 0.86rem; line-height: 1.35;">
                                                {{ $item->nama_biaya }}
                                            </div>
                                            @if($item->deskripsi)
                                                <div class="text-secondary small mt-0.5 text-truncate" style="font-size: 0.76rem; max-width: 320px;" title="{{ $item->deskripsi }}">
                                                    {{ $item->deskripsi }}
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge {{ $catClass }}">
                                                {{ $item->kategori }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($item->tipe_perhitungan === 'nominal_tetap')
                                                <span class="badge" style="background: #f8fafc; color: #475569; border: 1px solid #e2e8f0; font-size: 0.72rem;">Nominal Tetap</span>
                                                <div class="fw-bold text-success mt-1" style="font-size: 0.84rem;">
                                                    Rp {{ number_format($item->nominal_standar ?? 0, 0, ',', '.') }}
                                                </div>
                                            @elseif($item->tipe_perhitungan === 'persentase')
                                                <span class="badge" style="background: #fffbeb; color: #b45309; border: 1px solid #fde68a; font-size: 0.72rem;">
                                                    Persentase (%)
                                                </span>
                                                <div class="fw-bold text-dark mt-1" style="font-size: 0.84rem;">
                                                    {{ $item->persentase_standar }}% dari Deal
                                                    @if($item->nominal_standar)
                                                        <span class="text-muted d-block fw-normal" style="font-size: 0.71rem;">(Est: Rp {{ number_format($item->nominal_standar, 0, ',', '.') }})</span>
                                                    @endif
                                                </div>
                                            @else
                                                <span class="badge" style="background: #f1f5f9; color: #64748b; border: 1px solid #e2e8f0; font-size: 0.72rem;">Fleksibel / Bebas</span>
                                                @if($item->nominal_standar)
                                                    <div class="text-muted mt-1" style="font-size: 0.75rem;">
                                                        Acuan: Rp {{ number_format($item->nominal_standar, 0, ',', '.') }}
                                                    </div>
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge {{ $penanggungClass }}">
                                                {{ $penanggungLabel }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            @if($item->is_standard)
                                                <span class="badge badge-sifat-baku" title="Komponen standar baku di form Pra Land Bank">
                                                    <i class="mdi mdi-star text-warning me-0.5"></i> Baku
                                                </span>
                                            @else
                                                <span class="badge badge-sifat-tambahan">
                                                    Tambahan
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-switch d-inline-block mb-0 custom-switch-clean">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    id="switchStatus_{{ $item->id }}"
                                                    {{ $item->is_active ? 'checked' : '' }}
                                                    onchange="toggleActiveStatus({{ $item->id }}, this)"
                                                    title="{{ $item->is_active ? 'Status: Aktif' : 'Status: Nonaktif' }}">
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-inline-flex align-items-center gap-1">
                                                <a href="{{ route('master.biaya-legalitas.edit', $item->id) }}" class="btn-action edit" title="Edit Biaya">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>
                                                <button type="button" class="btn-action delete" title="Hapus Biaya" onclick="deleteBiaya({{ $item->id }}, '{{ addslashes($item->nama_biaya) }}')">
                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center py-5 text-muted">
                                            <div class="p-3">
                                                <i class="mdi mdi-cash-remove mb-2" style="font-size: 2.8rem; color: #94a3b8; opacity: 0.6;"></i>
                                                <h6 class="fw-bold text-dark mb-1">Belum Ada Data Master Biaya Legalitas</h6>
                                                <p class="text-muted mb-3" style="font-size: 0.84rem;">Silakan tambahkan komponen biaya baru atau reset filter.</p>
                                                <a href="{{ route('master.biaya-legalitas.create') }}" class="btn btn-sm btn-gradient-primary px-3 py-1.5" style="border-radius: 5px;">
                                                    <i class="mdi mdi-plus-circle me-1"></i> Tambah Komponen Baru
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($biayas->hasPages())
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2 mt-4 pt-3 border-top">
                            <small class="text-muted">
                                Menampilkan {{ $biayas->firstItem() }} s/d {{ $biayas->lastItem() }} dari {{ $biayas->total() }} data
                            </small>
                            <div>
                                {{ $biayas->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Hidden Delete Form -->
<form id="deleteBiayaForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

@endsection

@push('scripts')
<script>

    // Toggle Aktif Status via AJAX
    function toggleActiveStatus(id, checkbox) {
        const originalState = !checkbox.checked;
        fetch(`/master-data/biaya-legalitas/${id}/toggle-status`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                if (typeof Swal !== 'undefined') {
                    const toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true
                    });
                    toast.fire({
                        icon: 'success',
                        title: data.message
                    });
                }
            } else {
                checkbox.checked = originalState;
                if (typeof Swal !== 'undefined') {
                    Swal.fire('Gagal!', data.message || 'Gagal memperbarui status', 'error');
                } else {
                    alert('Gagal: ' + (data.message || 'Gagal memperbarui status'));
                }
            }
        })
        .catch(err => {
            checkbox.checked = originalState;
            if (typeof Swal !== 'undefined') {
                Swal.fire('Error!', 'Terjadi kesalahan sistem: ' + err.message, 'error');
            } else {
                alert('Terjadi kesalahan sistem: ' + err.message);
            }
        });
    }

    // Hapus Biaya Confirmation
    function deleteBiaya(id, name) {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Hapus Komponen Biaya?',
                html: `Apakah Anda yakin ingin menghapus <strong>"${name}"</strong> dari Master Data?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#64748b',
                confirmButtonText: '<i class="mdi mdi-trash-can me-1"></i> Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('deleteBiayaForm');
                    form.action = `/master-data/biaya-legalitas/${id}`;
                    form.submit();
                }
            });
        } else {
            if (confirm(`Yakin ingin menghapus "${name}"?`)) {
                const form = document.getElementById('deleteBiayaForm');
                form.action = `/master-data/biaya-legalitas/${id}`;
                form.submit();
            }
        }
    }

    // Live Search Client Side (Instant Table Search)
    function applyLiveSearch(query) {
        var filter = query.toLowerCase().trim();
        var rows = document.querySelectorAll('.biaya-table-row');
        rows.forEach(function(row) {
            var text = row.getAttribute('data-search') || row.innerText.toLowerCase();
            if (filter === '' || text.indexOf(filter) > -1) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
</script>
@endpush
