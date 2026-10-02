@extends('layouts.partial.app')

@section('title', 'Master Data SPK Kontraktor - Property Management App')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-clean.css') }}?v={{ time() }}">
    <style>
        /* Table Responsive & Layout persis Catalog Unit */
        .table-spk {
            width: 100% !important;
            margin-bottom: 0;
        }
        .table-spk thead th {
            background: #f8fafc !important;
            color: #4b5563 !important;
            font-weight: 700;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e2e8f0 !important;
            padding: 0.75rem 0.65rem !important;
            vertical-align: middle;
            white-space: nowrap;
        }
        .table-spk tbody td {
            padding: 0.75rem 0.65rem !important;
            vertical-align: middle;
            font-size: 0.83rem;
            border-bottom: 1px solid #f1f5f9;
            white-space: normal !important;
        }
        .table-spk .col-no {
            width: 45px;
            text-align: center;
            white-space: nowrap !important;
        }
        .table-spk .col-status {
            width: 110px;
            text-align: center;
            white-space: nowrap !important;
        }
        .table-spk .col-aksi {
            width: 155px;
            text-align: center;
            white-space: nowrap !important;
        }

        /* Compact Table Card persis Catalog Unit (.compact-table-card) */
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
        .compact-table-card .card-body,
        .card.compact-table-card .card-body {
            padding: 0 !important;
            background: #ffffff !important;
        }

        /* NO GRADIENTS - Solid Buttons */
        .btn-solid-primary,
        .btn-gradient-primary {
            background: #7c3aed !important;
            background-color: #7c3aed !important;
            border: 1px solid #6d28d9 !important;
            color: #ffffff !important;
            box-shadow: none !important;
            transition: all 0.15s ease-in-out;
        }
        .btn-solid-primary:hover,
        .btn-gradient-primary:hover {
            background: #6d28d9 !important;
            background-color: #6d28d9 !important;
            color: #ffffff !important;
        }

        .btn-solid-secondary,
        .btn-gradient-secondary {
            background: #f1f5f9 !important;
            background-color: #f1f5f9 !important;
            border: 1px solid #cbd5e1 !important;
            color: #475569 !important;
            box-shadow: none !important;
            transition: all 0.15s ease-in-out;
        }
        .btn-solid-secondary:hover,
        .btn-gradient-secondary:hover {
            background: #e2e8f0 !important;
            background-color: #e2e8f0 !important;
            color: #1e293b !important;
        }

        .btn-icon-only {
            width: 38px;
            height: 38px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
        }

        /* Action Buttons - Persis UI Halaman Bank (Solid, No Gradient) */
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
            border: none !important;
            cursor: pointer;
            font-size: 0.95rem;
            text-decoration: none;
            vertical-align: middle;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
            color: #ffffff !important;
        }
        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            color: #ffffff !important;
        }
        .btn-action i {
            font-size: 0.95rem;
            color: #ffffff !important;
        }
        .btn-action.view {
            background: #0284c7 !important;
            color: #ffffff !important;
        }
        .btn-action.print {
            background: #16a34a !important;
            color: #ffffff !important;
        }
        .btn-action.edit {
            background: #f59e0b !important;
            color: #ffffff !important;
        }
        .btn-action.delete {
            background: #ef4444 !important;
            color: #ffffff !important;
        }

        /* Status Badges - Solid Soft Tone (NO GRADIENTS) */
        .status-badge-spk {
            font-size: 0.74rem;
            font-weight: 600;
            padding: 0.25rem 0.65rem;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        .status-badge-spk.draft {
            background-color: #f8fafc;
            color: #475569;
            border: 1px solid #e2e8f0;
        }
        .status-badge-spk.berjalan {
            background-color: #eff6ff;
            color: #1d4ed8;
            border: 1px solid #bfdbfe;
        }
        .status-badge-spk.selesai {
            background-color: #ecfdf5;
            color: #059669;
            border: 1px solid #a7f3d0;
        }
        .status-badge-spk.dibatalkan {
            background-color: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }
    </style>
@endpush

@section('content')

    <div class="container-fluid px-2 px-md-4 py-3">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-3 d-flex align-items-center" role="alert" style="background-color: #ecfdf5; color: #065f46; border-radius: 8px;">
                <i class="mdi mdi-check-circle-outline me-2 fs-5"></i>
                <div>{{ session('success') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-3 d-flex align-items-center" role="alert" style="background-color: #fef2f2; color: #991b1b; border-radius: 8px;">
                <i class="mdi mdi-alert-circle-outline me-2 fs-5"></i>
                <div>{{ session('error') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Page Title & Subtitle -->
        <div class="row align-items-center mb-4">
            <div class="col-12">
                <h2 class="text-dark mb-1 fw-bold" style="font-size: 1.55rem; letter-spacing: -0.02em;">
                    Surat Perintah Kerja (SPK) Kontraktor
                </h2>
                <p class="text-muted mb-0" style="font-size: 0.88rem;">
                    Buat, kelola, monitor termin pembayaran, dan cetak surat resmi SPK kontraktor & pemborong.
                </p>
            </div>
        </div>

        <!-- 4 KPI Metrics Card Grid (Persis Catalog Unit & Perizinan) -->
        <div class="dash-kpi-grid mb-4">
            <!-- Card 1: Total SPK -->
            <div class="dash-kpi-card">
                <div class="dash-kpi-left">
                    <div class="dash-kpi-icon purple">
                        <i class="mdi mdi-file-document-multiple-outline"></i>
                    </div>
                    <div class="dash-kpi-info">
                        <div class="dash-kpi-label">Total SPK</div>
                        <div class="dash-kpi-val">{{ $stats['total_spk'] }}</div>
                        <div class="dash-kpi-sub">Seluruh SPK Dibuat</div>
                    </div>
                </div>
                <div class="dash-kpi-action purple">
                    <i class="mdi mdi-arrow-right"></i>
                </div>
            </div>

            <!-- Card 2: SPK Berjalan -->
            <div class="dash-kpi-card">
                <div class="dash-kpi-left">
                    <div class="dash-kpi-icon blue">
                        <i class="mdi mdi-progress-clock"></i>
                    </div>
                    <div class="dash-kpi-info">
                        <div class="dash-kpi-label">SPK Berjalan</div>
                        <div class="dash-kpi-val">{{ $stats['spk_berjalan'] }}</div>
                        <div class="dash-kpi-sub">Dalam Pengerjaan Fisik</div>
                    </div>
                </div>
                <div class="dash-kpi-action blue">
                    <i class="mdi mdi-arrow-right"></i>
                </div>
            </div>

            <!-- Card 3: SPK Selesai -->
            <div class="dash-kpi-card">
                <div class="dash-kpi-left">
                    <div class="dash-kpi-icon green">
                        <i class="mdi mdi-check-decagram-outline"></i>
                    </div>
                    <div class="dash-kpi-info">
                        <div class="dash-kpi-label">SPK Selesai</div>
                        <div class="dash-kpi-val">{{ $stats['spk_selesai'] }}</div>
                        <div class="dash-kpi-sub">Pekerjaan Rampung 100%</div>
                    </div>
                </div>
                <div class="dash-kpi-action green">
                    <i class="mdi mdi-arrow-right"></i>
                </div>
            </div>

            <!-- Card 4: Total Nilai Kontrak -->
            <div class="dash-kpi-card">
                <div class="dash-kpi-left">
                    <div class="dash-kpi-icon amber">
                        <i class="mdi mdi-cash-multiple"></i>
                    </div>
                    <div class="dash-kpi-info">
                        <div class="dash-kpi-label">Total Nilai Kontrak</div>
                        <div class="dash-kpi-val" style="font-size: 1.15rem; color: #059669;">Rp {{ number_format($stats['total_nilai'], 0, ',', '.') }}</div>
                        <div class="dash-kpi-sub">Akumulasi Nilai SPK</div>
                    </div>
                </div>
                <div class="dash-kpi-action amber">
                    <i class="mdi mdi-arrow-right"></i>
                </div>
            </div>
        </div>

        <!-- Main Container: Table & Filters (Card Meniru Persis Catalog Unit) -->
        <div class="row">
            <div class="col-12">
                <div class="card compact-table-card shadow-sm border-0">
                    <div class="card-header bg-white px-3 py-3 border-bottom d-flex flex-wrap justify-content-between align-items-center gap-2">
                        <div class="d-flex align-items-center gap-2">
                            <div style="width: 32px; height: 32px; border-radius: 6px; background-color: #f3e8ff; display: flex; align-items: center; justify-content: center; color: #7c3aed;">
                                <i class="mdi mdi-format-list-bulleted fs-5"></i>
                            </div>
                            <div>
                                <span style="font-size: 0.95rem; font-weight: 700; color: #0f172a;">Daftar SPK Kontraktor</span>
                            </div>
                        </div>
                        <a href="{{ route('spk.create') }}" class="btn btn-sm btn-solid-primary d-inline-flex align-items-center gap-1.5 px-3 py-1.5 fw-semibold shadow-sm text-decoration-none text-white" style="border-radius: 6px; font-size: 0.82rem; height: 36px; white-space: nowrap;">
                            <i class="mdi mdi-plus-circle-outline fs-6"></i>
                            <span>Buat SPK Baru</span>
                        </a>
                    </div>

                    <div class="card-body p-0">
                        <!-- Search & Filter Toolbar -->
                        <div class="card-toolbar-box p-3 border-bottom bg-white">
                            <!-- Desktop Version -->
                            <div class="filter-row-desktop d-none d-md-block">
                                <form id="filterForm" method="GET" action="{{ route('spk.index') }}" onsubmit="return showFilterLoading()">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                        <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                            <!-- Search Input -->
                                            <div style="min-width: 260px; max-width: 360px; flex: 1;">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="search" id="searchInput"
                                                        placeholder="Cari no SPK / kontraktor / pekerjaan..."
                                                        value="{{ request('search') }}"
                                                        style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                                    <button class="btn btn-solid-primary d-flex align-items-center justify-content-center px-3" 
                                                        type="submit" title="Cari"
                                                        style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                        <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Proyek / Land Bank Filter -->
                                            <div style="min-width: 200px;">
                                                <select class="form-control" name="land_bank_id" id="landBankSelect">
                                                    <option value="">Semua Proyek / Land Bank</option>
                                                    @foreach($landBanks as $lb)
                                                        <option value="{{ $lb->id }}" {{ request('land_bank_id') == $lb->id ? 'selected' : '' }}>
                                                            {{ $lb->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Status Filter -->
                                            <div style="width: 155px;">
                                                <select class="form-control" name="status" id="statusSelect">
                                                    <option value="">Semua Status</option>
                                                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                                    <option value="berjalan" {{ request('status') == 'berjalan' ? 'selected' : '' }}>Berjalan</option>
                                                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                                    <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Right Limit & Buttons -->
                                        <div class="d-flex align-items-center gap-2 ms-auto">
                                            <div style="width: 110px;">
                                                <select class="form-control" name="per_page" id="perPageSelect">
                                                    <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 data</option>
                                                    <option value="15" {{ request('per_page', 15) == 15 ? 'selected' : '' }}>15 data</option>
                                                    <option value="25" {{ request('per_page', 25) == 25 ? 'selected' : '' }}>25 data</option>
                                                    <option value="50" {{ request('per_page', 50) == 50 ? 'selected' : '' }}>50 data</option>
                                                </select>
                                            </div>

                                            <button type="submit" class="btn btn-solid-primary btn-icon-only" title="Filter">
                                                <i class="mdi mdi-filter"></i>
                                            </button>
                                            <a href="{{ route('spk.index') }}" class="btn btn-solid-secondary btn-icon-only" title="Reset" onclick="showResetLoading(event)">
                                                <i class="mdi mdi-refresh"></i>
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- Mobile Version -->
                            <div class="filter-row-mobile d-block d-md-none">
                                <form method="GET" action="{{ route('spk.index') }}" onsubmit="return showFilterLoading()">
                                    <div class="row g-2">
                                        <div class="col-12 mb-2">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="search" id="searchInputMobile"
                                                    placeholder="Cari no SPK / kontraktor / pekerjaan..."
                                                    value="{{ request('search') }}"
                                                    style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                                <button class="btn btn-solid-primary d-flex align-items-center justify-content-center px-3" 
                                                    type="submit" title="Cari"
                                                    style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                    <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="col-12 mb-2">
                                            <select class="form-control" name="land_bank_id">
                                                <option value="">Semua Proyek / Land Bank</option>
                                                @foreach($landBanks as $lb)
                                                    <option value="{{ $lb->id }}" {{ request('land_bank_id') == $lb->id ? 'selected' : '' }}>
                                                        {{ $lb->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-12 mb-2">
                                            <select class="form-control" name="status">
                                                <option value="">Semua Status</option>
                                                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                                <option value="berjalan" {{ request('status') == 'berjalan' ? 'selected' : '' }}>Berjalan</option>
                                                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                                <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                            </select>
                                        </div>

                                        <div class="col-12 mb-2">
                                            <select class="form-control" name="per_page">
                                                <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 data</option>
                                                <option value="15" {{ request('per_page', 15) == 15 ? 'selected' : '' }}>15 data</option>
                                                <option value="25" {{ request('per_page', 25) == 25 ? 'selected' : '' }}>25 data</option>
                                                <option value="50" {{ request('per_page', 50) == 50 ? 'selected' : '' }}>50 data</option>
                                            </select>
                                        </div>

                                        <div class="col-6">
                                            <button type="submit" class="btn btn-solid-primary w-100 d-flex align-items-center justify-content-center gap-1">
                                                <i class="mdi mdi-filter"></i> Filter
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <a href="{{ route('spk.index') }}" class="btn btn-solid-secondary w-100 d-flex align-items-center justify-content-center gap-1" onclick="showResetLoading(event)">
                                                <i class="mdi mdi-refresh"></i> Reset
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Pure Clean Table: Daftar SPK Kontraktor -->
                        <div class="table-responsive">
                            <table class="table table-hover align-middle table-spk mb-0">
                                <thead>
                                    <tr>
                                        <th class="col-no text-center">No</th>
                                        <th>Nomor SPK & Tanggal</th>
                                        <th>Proyek & Pekerjaan</th>
                                        <th>Kontraktor / Mandor</th>
                                        <th class="text-end">Nilai Kontrak</th>
                                        <th class="text-center" style="width: 130px;">Progress</th>
                                        <th class="col-status text-center">Status</th>
                                        <th class="col-aksi text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($spks as $index => $spk)
                                        @php
                                            $progPct = (int) ($spk->progress ?? 0);
                                            if ($progPct >= 100) {
                                                $pColor = '#10b981';
                                            } elseif ($progPct >= 70) {
                                                $pColor = '#7c3aed';
                                            } elseif ($progPct >= 40) {
                                                $pColor = '#0284c7';
                                            } else {
                                                $pColor = '#f59e0b';
                                            }
                                        @endphp
                                        <tr>
                                            <td class="col-no text-center fw-bold">{{ $spks->firstItem() + $index }}</td>
                                            <td>
                                                <div class="fw-bold text-dark mb-1">
                                                    <i class="mdi mdi-file-document-outline text-primary me-1"></i>{{ $spk->no_spk }}
                                                </div>
                                                <small class="text-muted">
                                                    <i class="mdi mdi-calendar-blank-outline me-1"></i>{{ $spk->tanggal_spk ? date('d/m/Y', strtotime($spk->tanggal_spk)) : '-' }}
                                                </small>
                                            </td>
                                            <td>
                                                <div class="fw-bold text-dark mb-1">
                                                    {{ $spk->nama_pekerjaan }}
                                                </div>
                                                <div class="small text-muted d-flex align-items-center gap-1">
                                                    <i class="mdi mdi-domain" style="color: #7c3aed;"></i>
                                                    <span>{{ $spk->landBank->name ?? '-' }}</span>
                                                    @if($spk->unit)
                                                        <span class="badge bg-light text-dark border ms-1 font-monospace" style="font-size: 0.74rem;">
                                                            Kav. {{ $spk->unit->unit_code }} ({{ $spk->unit->type }})
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="fw-semibold text-dark mb-1">
                                                    <i class="mdi mdi-account-hard-hat me-1 text-muted"></i>{{ $spk->kontraktor_nama }}
                                                </div>
                                                @if($spk->kontraktor_pic)
                                                    <small class="text-muted d-block">
                                                        PIC: {{ $spk->kontraktor_pic }}
                                                    </small>
                                                @endif
                                                @if($spk->kontraktor_telepon)
                                                    <small class="text-muted d-block">
                                                        <i class="mdi mdi-phone-outline me-1"></i>{{ $spk->kontraktor_telepon }}
                                                    </small>
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                <span class="badge bg-light text-dark fw-bold px-2 py-1 border font-monospace" style="font-size: 0.83rem; letter-spacing: 0.5px;">
                                                    {{ $spk->formatted_nilai_kontrak }}
                                                </span>
                                                <small class="text-muted d-block mt-1">
                                                    {{ $spk->termins->count() }} Termin
                                                </small>
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex align-items-center justify-content-center gap-2">
                                                    <div class="progress flex-grow-1" style="height: 6px; width: 60px; background-color: #e2e8f0; border-radius: 9999px;">
                                                        <div class="progress-bar rounded-pill" role="progressbar" 
                                                             style="width: {{ $progPct }}%; background-color: {{ $pColor }};" 
                                                             aria-valuenow="{{ $progPct }}" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <span class="fw-bold" style="font-size: 0.75rem; color: #334155;">{{ $progPct }}%</span>
                                                </div>
                                            </td>
                                            <td class="col-status text-center">
                                                @if($spk->status == 'berjalan')
                                                    <span class="status-badge-spk berjalan">
                                                        <i class="mdi mdi-play-circle-outline"></i> Berjalan
                                                    </span>
                                                @elseif($spk->status == 'selesai')
                                                    <span class="status-badge-spk selesai">
                                                        <i class="mdi mdi-check-circle"></i> Selesai
                                                    </span>
                                                @elseif($spk->status == 'dibatalkan')
                                                    <span class="status-badge-spk dibatalkan">
                                                        <i class="mdi mdi-close-circle"></i> Batal
                                                    </span>
                                                @else
                                                    <span class="status-badge-spk draft">
                                                        <i class="mdi mdi-file-clock-outline"></i> Draft
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="col-aksi text-center">
                                                <div class="d-inline-flex align-items-center gap-1">
                                                    <a href="{{ route('spk.show', $spk->id) }}" class="btn-action view" title="Lihat Detail SPK">
                                                        <i class="mdi mdi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('spk.cetak', $spk->id) }}" target="_blank" class="btn-action print" title="Cetak SPK">
                                                        <i class="mdi mdi-printer"></i>
                                                    </a>
                                                    <a href="{{ route('spk.edit', $spk->id) }}" class="btn-action edit" title="Edit SPK">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </a>
                                                    <button type="button" class="btn-action delete" title="Hapus SPK" onclick="confirmDeleteSpk('{{ $spk->id }}', '{{ $spk->no_spk }}')">
                                                        <i class="mdi mdi-trash-can-outline"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center text-muted py-4">
                                                <i class="mdi mdi-file-document-outline me-2" style="font-size: 1.5rem;"></i>
                                                Belum ada data SPK Kontraktor yang tersimpan.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if ($spks instanceof \Illuminate\Pagination\LengthAwarePaginator && $spks->total() > 0)
                            <div class="p-3 border-top d-flex flex-column flex-sm-row justify-content-between align-items-center">
                                <div class="pagination-info mb-2 mb-sm-0 text-muted" style="font-size: 0.82rem;">
                                    Menampilkan {{ $spks->firstItem() }} - {{ $spks->lastItem() }} dari {{ $spks->total() }} data
                                </div>
                                <nav aria-label="Page navigation">
                                    <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                        <li class="page-item {{ $spks->onFirstPage() ? 'disabled' : '' }}">
                                            <a class="page-link" href="{{ $spks->previousPageUrl() }}" {{ !$spks->onFirstPage() ? 'onclick=showPaginationLoading(event)' : '' }}>
                                                <i class="mdi mdi-chevron-left"></i>
                                            </a>
                                        </li>

                                        @for($page = 1; $page <= $spks->lastPage(); $page++)
                                            <li class="page-item {{ $page == $spks->currentPage() ? 'active' : '' }}">
                                                @if($page == $spks->currentPage())
                                                    <span class="page-link" style="background-color: #7c3aed; border-color: #7c3aed; color: #ffffff;">{{ $page }}</span>
                                                @else
                                                    <a class="page-link" href="{{ $spks->appends(request()->query())->url($page) }}" onclick="showPaginationLoading(event)">{{ $page }}</a>
                                                @endif
                                            </li>
                                        @endfor

                                        <li class="page-item {{ $spks->hasMorePages() ? '' : 'disabled' }}">
                                            <a class="page-link" href="{{ $spks->nextPageUrl() }}" {{ $spks->hasMorePages() ? 'onclick=showPaginationLoading(event)' : '' }}>
                                                <i class="mdi mdi-chevron-right"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 2500,
                showConfirmButton: true,
                confirmButtonColor: '#9a55ff',
                timerProgressBar: true
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
                confirmButtonColor: '#dc3545'
            });
        @endif
    });

    function showFilterLoading() {
        Swal.fire({
            title: 'Memuat...',
            html: 'Sedang memfilter data',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        return true;
    }

    function showResetLoading(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Memuat...',
            html: 'Sedang mereset filter',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        window.location.href = event.currentTarget.href;
    }

    function showPaginationLoading(event) {
        if (event.currentTarget.parentElement.classList.contains('disabled')) return;
        event.preventDefault();
        Swal.fire({
            title: 'Memuat...',
            html: 'Sedang memuat halaman',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        window.location.href = event.currentTarget.href;
    }

    function confirmDeleteSpk(id, noSpk) {
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: `Data SPK ${noSpk} beserta seluruh jadwal terminnya akan dihapus permanen!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Menghapus...',
                    html: 'Sedang menghapus data SPK',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: `/spk/${id}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(res) {
                        if (res.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Terhapus!',
                                text: res.message,
                                timer: 1800,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire('Error', res.message || 'Gagal menghapus data', 'error');
                        }
                    },
                    error: function(xhr) {
                        Swal.fire('Error', 'Terjadi kesalahan sistem saat menghapus data.', 'error');
                    }
                });
            }
        });
    }
</script>
@endpush
