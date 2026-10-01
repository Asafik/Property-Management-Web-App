@extends('layouts.partial.app')

@section('title', 'Daftar Unit Proyek Kawasan - Property Management App')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-clean.css') }}?v={{ time() }}">
    <style>
        /* Table Responsive & Layout persis pengolahan lahan & perizinan */
        .table-unit {
            width: 100% !important;
            margin-bottom: 0;
        }
        .table-unit thead th {
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
        .table-unit tbody td {
            padding: 0.75rem 0.65rem !important;
            vertical-align: middle;
            font-size: 0.83rem;
            border-bottom: 1px solid #f1f5f9;
            white-space: normal !important;
        }
        .table-unit .col-no {
            width: 45px;
            text-align: center;
            white-space: nowrap !important;
        }
        .table-unit .col-status {
            width: 110px;
            text-align: center;
            white-space: nowrap !important;
        }
        .table-unit .col-aksi {
            width: 110px;
            text-align: center;
            white-space: nowrap !important;
        }

        /* Compact Table Card meniru persis Card Total (.dash-kpi-card) */
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

        /* Modal Atur SPK Unit Styles (Standard Theme) */
        .spk-rupiah-box {
            display: flex !important;
            align-items: stretch !important;
            width: 100% !important;
            border: 1px solid #cbd5e1 !important;
            border-radius: 8px !important;
            overflow: hidden !important;
            background: #ffffff !important;
            height: 40px !important;
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
            font-size: 0.92rem !important;
            font-weight: 600 !important;
            color: #1e293b !important;
            flex: 1 !important;
            width: 100% !important;
            height: 100% !important;
            background: transparent !important;
        }
        .spk-total-summary-box {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 5px;
            padding: 3px 10px;
            background: rgba(154, 85, 255, 0.08);
            border-radius: 6px;
            border: 1px solid rgba(154, 85, 255, 0.18);
            font-size: 0.78rem;
            color: #7c3aed;
            font-weight: 600;
        }
        .spk-upload-box {
            position: relative;
            border: 2px dashed #cbd5e1;
            border-radius: 10px;
            background: #f8fafc;
            padding: 10px 16px;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .spk-upload-box:hover {
            border-color: #9a55ff;
            background: #faf5ff;
        }
        .spk-upload-box input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
            z-index: 10;
        }
        .spk-upload-box > div {
            pointer-events: none;
        }
        .spk-unit-card {
            transition: all 0.2s ease;
            border: 1px solid #e2e8f0 !important;
        }
        .spk-unit-card:hover {
            border-color: #9a55ff !important;
            background: #faf5ff !important;
        }
        .spk-unit-card.is-selected {
            border-color: #9a55ff !important;
            background: rgba(154, 85, 255, 0.08) !important;
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

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-3" role="alert" style="background-color: #fef2f2; color: #991b1b; border-radius: 8px;">
            <div class="fw-bold mb-1"><i class="mdi mdi-alert-circle-outline me-1"></i>Terdapat kesalahan:</div>
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Page Title & Subtitle -->
    <div class="row align-items-center mb-4">
        <div class="col">
            <h2 class="text-dark mb-1 fw-bold" style="font-size: 1.55rem; letter-spacing: -0.02em;">
                Daftar Unit Proyek Kawasan
            </h2>
            <p class="text-muted mb-0" style="font-size: 0.88rem;">
                Ketersediaan unit kavling, progres fisik konstruksi bangunan, dan penugasan SPK borongan proyek.
            </p>
        </div>
        <div class="col-auto">
            <button type="button" class="btn btn-gradient-primary d-inline-flex align-items-center gap-1.5 shadow-sm fw-semibold px-3 py-2" data-bs-toggle="modal" data-bs-target="#modalSpkUnitProyek" style="border-radius: 8px; font-size: 0.88rem;">
                <i class="mdi mdi-file-document-edit-outline" style="font-size: 1.15rem;"></i>
                <span>Atur SPK Unit</span>
            </button>
        </div>
    </div>

    <!-- 4 KPI Metrics Card Grid (Sama Persis Perizinan & Pengolahan Lahan) -->
    <div class="dash-kpi-grid mb-4">
        
        <!-- Card 1: Total Unit Kavling (Ungu) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon purple">
                    <i class="mdi mdi-home-city-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Total Unit Kavling</div>
                    <div class="dash-kpi-val">{{ $totalUnit ?? 0 }}</div>
                    <div class="dash-kpi-sub">Seluruh Unit Terdaftar</div>
                </div>
            </div>
            <div class="dash-kpi-action purple">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>

        <!-- Card 2: Unit Tersedia (Hijau) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon green">
                    <i class="mdi mdi-checkbox-marked-circle-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Unit Tersedia</div>
                    <div class="dash-kpi-val">{{ $totalAvailable ?? 0 }}</div>
                    <div class="dash-kpi-sub">Siap Dipasarkan / Booking</div>
                </div>
            </div>
            <div class="dash-kpi-action green">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>

        <!-- Card 3: Unit Ter-Booking (Kuning / Amber) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon amber">
                    <i class="mdi mdi-clock-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Unit Ter-Booking</div>
                    <div class="dash-kpi-val">{{ $totalBooking ?? 0 }}</div>
                    <div class="dash-kpi-sub">Dalam Proses Pembayaran DP</div>
                </div>
            </div>
            <div class="dash-kpi-action amber">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>

        <!-- Card 4: Unit Terjual (Sold) (Rose / Merah) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon rose">
                    <i class="mdi mdi-cash-check"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Unit Terjual (Sold)</div>
                    <div class="dash-kpi-val">{{ $totalSold ?? 0 }}</div>
                    <div class="dash-kpi-sub">Akad / Lunas Terverifikasi</div>
                </div>
            </div>
            <div class="dash-kpi-action rose">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>
    </div>

    <!-- Main Container: Table & Filters (Card Meniru Persis Card Total) -->
    <div class="row">
        <div class="col-12">
            <div class="card compact-table-card shadow-sm border-0">
                <div class="card-body p-0">
                    
                    <!-- Search & Filter Toolbar -->
                    <div class="card-toolbar-box p-3 border-bottom bg-white">
                        <form id="filterForm" method="GET" action="{{ route('proyek.unit.index') }}">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                                
                                <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                    <!-- Search Input -->
                                    <div style="min-width: 240px; max-width: 340px; flex: 1;">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" id="liveSearchInput"
                                                placeholder="Cari kode unit, blok, nama unit..."
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

                                    <!-- Filter Proyek Asal Dropdown -->
                                    <div style="min-width: 200px;">
                                        <select name="land_bank_id" class="form-control" onchange="document.getElementById('filterForm').submit()">
                                            <option value="all">Semua Tanah Proyek</option>
                                            @foreach($landBanks as $lb)
                                                <option value="{{ $lb->id }}" {{ request('land_bank_id') == $lb->id ? 'selected' : '' }}>
                                                    {{ $lb->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Filter Status Dropdown -->
                                    <div style="width: 150px;">
                                        <select class="form-control" name="status" onchange="document.getElementById('filterForm').submit()">
                                            <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Semua Status</option>
                                            <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Available</option>
                                            <option value="booking" {{ request('status') == 'booking' ? 'selected' : '' }}>Booking</option>
                                            <option value="sold" {{ request('status') == 'sold' ? 'selected' : '' }}>Terjual (Sold)</option>
                                        </select>
                                    </div>

                                    <!-- Filter Jenis Dropdown -->
                                    <div style="width: 140px;">
                                        <select class="form-control" name="jenis" onchange="document.getElementById('filterForm').submit()">
                                            <option value="all" {{ request('jenis') == 'all' ? 'selected' : '' }}>Semua Jenis</option>
                                            <option value="subsidi" {{ request('jenis') == 'subsidi' ? 'selected' : '' }}>Subsidi</option>
                                            <option value="komersil" {{ request('jenis') == 'komersil' ? 'selected' : '' }}>Komersil</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Action Filter / Reset Buttons -->
                                <div class="d-flex align-items-center gap-2 ms-auto">
                                    <button type="submit" class="btn btn-gradient-primary btn-icon-only" title="Terapkan Filter">
                                        <i class="mdi mdi-filter"></i>
                                    </button>
                                    <a href="{{ route('proyek.unit.index') }}" class="btn btn-gradient-secondary btn-icon-only" title="Reset Filter">
                                        <i class="mdi mdi-refresh"></i>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Pure Clean Table: Daftar Unit Proyek -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle table-unit mb-0">
                            <thead>
                                <tr>
                                    <th class="col-no text-center">No</th>
                                    <th>Kode / Unit</th>
                                    <th>Tanah / Proyek Asal</th>
                                    <th>Tipe / Dimensi</th>
                                    <th>Jenis</th>
                                    <th style="width: 160px;">Progres Bangunan</th>
                                    <th>SPK Kontraktor</th>
                                    <th class="col-status text-center">Status</th>
                                    <th class="col-aksi text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($units as $index => $u)
                                    @php
                                        $st = strtolower($u->status ?? 'available');
                                        if ($st == 'available' || $st == 'tersedia') {
                                            $badgeBg = '#ecfdf5';
                                            $badgeColor = '#059669';
                                            $badgeBorder = '#a7f3d0';
                                            $stLabel = 'Available';
                                        } elseif ($st == 'booking') {
                                            $badgeBg = '#fffbeb';
                                            $badgeColor = '#d97706';
                                            $badgeBorder = '#fde68a';
                                            $stLabel = 'Booking';
                                        } elseif ($st == 'sold' || $st == 'terjual') {
                                            $badgeBg = '#fef2f2';
                                            $badgeColor = '#dc2626';
                                            $badgeBorder = '#fecaca';
                                            $stLabel = 'Sold';
                                        } else {
                                            $badgeBg = '#f8fafc';
                                            $badgeColor = '#475569';
                                            $badgeBorder = '#e2e8f0';
                                            $stLabel = ucfirst($st);
                                        }

                                        $progPct = (int) ($u->construction_progress_percentage ?? 0);
                                        $progText = ucwords(str_replace('_', ' ', $u->construction_progress ?? 'Belum Mulai'));

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
                                    <tr class="unit-table-row" id="row_unit_{{ $u->id }}" 
                                        data-search="{{ strtolower($u->unit_code . ' ' . $u->unit_name . ' ' . ($u->landBank->name ?? '') . ' ' . $u->block . ' ' . $u->type . ' ' . $u->jenis . ' ' . ($u->no_spk ?? '') . ' ' . ($u->kontraktor ?? '') . ' ' . $stLabel) }}">
                                        
                                        <td class="col-no fw-bold text-center">
                                            {{ $units->firstItem() + $index }}
                                        </td>

                                        <td>
                                            <!-- KODE / UNIT -->
                                            <div class="fw-bold text-dark font-monospace" style="font-size: 0.88rem; line-height: 1.3;">
                                                {{ $u->unit_code ?: ($u->block . '-' . $u->unit_number) }}
                                            </div>
                                            <div class="text-secondary mt-0.5" style="font-size: 0.77rem; line-height: 1.3;">
                                                {{ $u->unit_name ?: ('Blok ' . $u->block . ' No. ' . $u->unit_number) }}
                                            </div>
                                        </td>

                                        <td>
                                            <!-- TANAH / PROYEK ASAL -->
                                            <span class="badge py-1 px-2.5"
                                                style="background-color: #f3e8ff; color: #7e22ce; font-size: 0.76rem; font-weight: 700; border-radius: 6px; border: 1px solid #e9d5ff;">
                                                <i class="mdi mdi-map-marker me-0.5"></i>{{ $u->landBank->name ?? 'Tanah Proyek' }}
                                            </span>
                                        </td>

                                        <td>
                                            <!-- TIPE & DIMENSI -->
                                            <div class="fw-bold text-dark" style="font-size: 0.82rem;">
                                                {{ $u->type ? 'Tipe ' . $u->type : '-' }}
                                            </div>
                                            <div class="text-secondary font-monospace" style="font-size: 0.75rem;">
                                                LB: {{ $u->building_area ?? '-' }} m² | LT: {{ $u->area ?? '-' }} m²
                                            </div>
                                        </td>

                                        <td>
                                            <!-- JENIS -->
                                            @if(strtolower($u->jenis) == 'subsidi')
                                                <span class="badge py-1 px-2.5 fw-semibold" 
                                                    style="background-color: #eff6ff; color: #1d4ed8; font-size: 0.74rem; border-radius: 6px; border: 1px solid #bfdbfe;">
                                                    Subsidi
                                                </span>
                                            @else
                                                <span class="badge py-1 px-2.5 fw-semibold" 
                                                    style="background-color: #fef3c7; color: #92400e; font-size: 0.74rem; border-radius: 6px; border: 1px solid #fde68a;">
                                                    Komersil
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            <!-- PROGRES FISIK BANGUNAN -->
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <span class="text-secondary" style="font-size: 0.74rem; font-weight: 600;">{{ $progText }}</span>
                                                <span class="fw-bold" style="font-size: 0.75rem; color: #334155;">{{ $progPct }}%</span>
                                            </div>
                                            <div class="progress" style="height: 6px; background-color: #e2e8f0; border-radius: 9999px;">
                                                <div class="progress-bar rounded-pill" role="progressbar" style="width: {{ $progPct }}%; background-color: {{ $pColor }};"></div>
                                            </div>
                                        </td>

                                        <td>
                                            <!-- SPK KONTRAKTOR -->
                                            @if($u->no_spk)
                                                @php
                                                    $spkRecord = !empty($u->no_spk) ? \App\Models\Spk::where('no_spk', $u->no_spk)->first() : null;
                                                    $spkDocUrl = !empty($u->dokumen_spk) ? resolveFileUrl($u->dokumen_spk) : null;
                                                    $targetUrl = $spkRecord ? route('spk.cetak', $spkRecord->id) : ($spkDocUrl ?: null);
                                                @endphp

                                                @if($targetUrl)
                                                    <a href="{{ $targetUrl }}" target="_blank"
                                                       class="badge py-1.5 px-2.5 fw-semibold text-decoration-none d-inline-flex align-items-center gap-1 shadow-sm" 
                                                       style="background-color: #f0fdf4; color: #166534; font-size: 0.76rem; border-radius: 6px; border: 1px solid #bbf7d0;" 
                                                       title="Cetak / Buka Surat Resmi SPK: {{ $u->no_spk }}{{ $u->kontraktor ? ' (Kontraktor: ' . $u->kontraktor . ')' : '' }}">
                                                        <i class="mdi mdi-printer text-success me-1"></i>
                                                        <span class="fw-bold">{{ $u->no_spk }}</span>
                                                        <i class="mdi mdi-open-in-new ms-0.5" style="font-size: 10px;"></i>
                                                    </a>
                                                @else
                                                    <span class="badge py-1.5 px-2.5 fw-semibold d-inline-flex align-items-center gap-1" 
                                                          style="background-color: #f8fafc; color: #475569; font-size: 0.76rem; border-radius: 6px; border: 1px solid #e2e8f0;" 
                                                          title="No. SPK: {{ $u->no_spk }}{{ $u->kontraktor ? ' (Kontraktor: ' . $u->kontraktor . ')' : '' }}">
                                                        <i class="mdi mdi-file-document-outline text-primary me-1"></i>
                                                        <span>{{ $u->no_spk }}</span>
                                                    </span>
                                                @endif
                                            @else
                                                <button type="button" class="btn btn-outline-secondary btn-sm py-0.5 px-2 text-nowrap d-inline-flex align-items-center gap-1" style="font-size: 0.72rem; border-radius: 6px;" onclick="openAssignSpkForSingleUnit({{ $u->id }}, '{{ $u->unit_code ?: ($u->block . '-' . $u->unit_number) }}', {{ $u->land_bank_id }})" title="Atur SPK untuk unit ini">
                                                    <i class="mdi mdi-plus-circle-outline me-1"></i>
                                                    <span>Beri SPK</span>
                                                </button>
                                            @endif
                                        </td>

                                        <td class="col-status text-center">
                                            <!-- STATUS -->
                                            <span class="badge py-1 px-2.5 fw-semibold" style="font-size: 0.74rem; border-radius: 6px; background-color: {{ $badgeBg }}; color: {{ $badgeColor }}; border: 1px solid {{ $badgeBorder }};">
                                                {{ $stLabel }}
                                            </span>
                                        </td>

                                        <td class="col-aksi text-center">
                                            <!-- AKSI -->
                                            <a href="{{ route('properti.progress', ['land_bank_id' => $u->land_bank_id, 'unit_id' => $u->id]) }}" class="btn btn-sm btn-gradient-primary d-inline-flex align-items-center justify-content-center px-3 py-1.5 shadow-sm text-decoration-none fw-semibold" style="border-radius: 6px; font-size: 0.82rem;" title="Input & Kelola RAP / RAB Unit">
                                                <i class="mdi mdi-tools me-2" style="font-size: 0.95rem;"></i>
                                                <span>Kelola</span>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted py-4">
                                            <i class="mdi mdi-home-alert-outline me-2" style="font-size: 1.5rem;"></i>
                                            Tidak ada data unit kavling yang sesuai dengan filter.
                                        </td>
                                    </tr>
                                @endforelse

                                <tr id="noResultsRow" style="display: none;">
                                    <td colspan="9" class="text-center text-muted py-4">
                                        <i class="mdi mdi-magnify-close me-2" style="font-size: 1.5rem;"></i>
                                        Tidak ada unit kavling yang cocok dengan kata kunci pencarian.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Footer -->
                    @if($units->hasPages())
                        <div class="px-3 py-3 border-top d-flex flex-wrap justify-content-between align-items-center bg-white">
                            <div class="text-muted" style="font-size: 0.82rem;">
                                Menampilkan <span class="fw-semibold text-dark">{{ $units->firstItem() ?? 0 }}</span> - <span class="fw-semibold text-dark">{{ $units->lastItem() ?? 0 }}</span> dari <span class="fw-semibold text-dark">{{ $units->total() }}</span> unit kavling
                            </div>
                            <div>
                                {{ $units->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modal Atur SPK Unit Proyek -->
<div class="modal fade" id="modalSpkUnitProyek" tabindex="-1" aria-labelledby="modalSpkUnitProyekLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 620px;">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <div class="d-inline-flex p-2 rounded-3 bg-primary bg-opacity-10 text-primary">
                        <i class="mdi mdi-file-document-edit-outline fs-4"></i>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold text-dark mb-0" id="modalSpkUnitProyekLabel" style="font-size: 1.1rem;">Atur SPK Unit Proyek</h5>
                        <small class="text-muted" style="font-size: 0.78rem;">Terbitkan kontrak SPK borongan ke unit kavling proyek untuk pembangunan fisik & RAB</small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>

            <div class="modal-body p-3 p-md-4" style="max-height: 70vh; overflow-y: auto;">
                <form id="formAssignSpkProyek" action="{{ route('proyek.unit.assignSpk') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Baris 1: Nomor SPK & Nama Kontraktor -->
                    <div class="row g-3 mb-3">
                        <div class="col-12 col-md-6">
                            <label class="form-label fw-bold small text-dark mb-1">Nomor SPK <span class="text-danger">*</span></label>
                            <input type="text" name="no_spk" id="modalSpkNoSpk" class="form-control" placeholder="Contoh: SPK/2026/IX/001" required>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label fw-bold small text-dark mb-1">Nama Kontraktor <span class="text-danger">*</span></label>
                            <input type="text" name="kontraktor" id="modalSpkKontraktor" class="form-control" placeholder="Nama kontraktor/pemborong..." required>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label fw-bold small text-dark mb-1 d-flex align-items-center justify-content-between">
                                <span>Nilai SPK per Unit (Rp) <span class="text-danger">*</span></span>
                                <i class="mdi mdi-information-outline text-primary fs-6" title="Nilai borongan ini otomatis masuk ke perhitungan HPP Bangunan Unit di Modul Keuangan & Project Accounting."></i>
                            </label>
                            <div class="spk-rupiah-box">
                                <span class="spk-prefix">Rp</span>
                                <input type="text" name="nilai_kontrak" id="modalSpkNilaiKontrak" class="rupiah-spk-input" placeholder="0" required>
                            </div>
                            <div class="spk-total-summary-box" id="modalSpkTotalCalculation">
                                <i class="mdi mdi-calculator me-1"></i>Total SPK: <strong class="ms-1">Rp 0</strong> <span class="text-muted ms-1">(0 unit dipilih)</span>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label fw-bold small text-dark mb-1">Tanggal SPK</label>
                            <input type="date" name="tanggal_spk" id="modalSpkTanggal" class="form-control" value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold small text-dark mb-1">Keterangan / Ruang Lingkup</label>
                            <input type="text" name="description" id="modalSpkDeskripsi" class="form-control" placeholder="Contoh: Pembangunan unit rumah standar...">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold small text-dark mb-1">Upload Berkas Dokumen SPK (PDF)</label>
                            <div class="spk-upload-box">
                                <input type="file" id="uploadDokumenSpkInputProyek" name="dokumen_spk" accept=".pdf">
                                <div class="d-flex align-items-center justify-content-center gap-3">
                                    <div class="rounded-circle p-2 bg-danger bg-opacity-10 text-danger d-inline-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                        <i class="mdi mdi-file-pdf-box fs-4"></i>
                                    </div>
                                    <div class="text-start">
                                        <span class="fw-bold text-dark d-block" id="dokumenSpkFileNameProyek" style="font-size: 0.85rem;">Pilih berkas PDF atau seret ke sini</span>
                                        <small class="text-muted" style="font-size: 0.75rem;">Format PDF maksimal 15MB</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pilih Multi-Unit Kavling -->
                    <div class="border rounded-3 p-3 bg-light">
                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-2 pb-2 border-bottom">
                            <div>
                                <h6 class="fw-bold text-dark mb-0" style="font-size: 0.88rem;">Pilih Unit Kavling <span class="text-danger">*</span></h6>
                                <small class="text-muted" id="spkUnitCounter">0 unit dipilih</small>
                            </div>
                            <div class="d-flex align-items-center gap-1.5">
                                <button type="button" class="btn btn-sm btn-light border text-primary fw-semibold px-2.5 py-1 d-inline-flex align-items-center gap-1 shadow-sm" id="btnSelectAllSpkUnits" style="font-size: 0.78rem; border-radius: 6px; background: #ffffff; border-color: #cbd5e1 !important;">
                                    <i class="mdi mdi-checkbox-multiple-marked-outline text-primary"></i>
                                    <span>Pilih Semua</span>
                                </button>
                                <button type="button" class="btn btn-sm btn-light border text-muted fw-semibold px-2.5 py-1 d-inline-flex align-items-center gap-1 shadow-sm" id="btnUnselectAllSpkUnits" style="font-size: 0.78rem; border-radius: 6px; background: #ffffff; border-color: #cbd5e1 !important;">
                                    <i class="mdi mdi-checkbox-multiple-blank-outline"></i>
                                    <span>Batal Pilih</span>
                                </button>
                            </div>
                        </div>

                        <!-- Filter Proyek & Search Unit di Modal -->
                        <div class="row g-2 mb-2">
                            <div class="col-md-6">
                                <select id="modalSpkFilterProject" class="form-control form-control-sm bg-white" style="font-size: 0.82rem; height: 38px; border-radius: 6px; border: 1px solid #cbd5e1;">
                                    <option value="all">Semua Proyek Kawasan</option>
                                    @foreach($landBanks as $lb)
                                        <option value="{{ $lb->id }}">{{ $lb->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-stretch" style="border: 1px solid #cbd5e1; border-radius: 6px; overflow: hidden; background: #ffffff;">
                                    <input type="text" class="form-control border-0 shadow-none px-3" id="filterSpkUnitSearchProyek"
                                        placeholder="Cari kode unit atau tipe..."
                                        style="height: 38px; font-size: 0.85rem; border-radius: 0 !important;">
                                    <div class="px-3 d-flex align-items-center justify-content-center bg-light text-muted border-start">
                                        <i class="mdi mdi-magnify fs-5"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Daftar Unit Checkbox List -->
                        <div class="spk-unit-selection-grid" style="max-height: 230px; overflow-y: auto; padding-right: 5px;">
                            <div class="row g-2" id="spkUnitCardsContainer">
                                @forelse ($allUnitsForSpk as $u)
                                    @php
                                        $uKode = $u->unit_code ?: ($u->block . '-' . $u->unit_number);
                                    @endphp
                                    <div class="col-sm-6 col-12 spk-unit-item-col" 
                                        data-landbank-id="{{ $u->land_bank_id }}" 
                                        data-code="{{ strtolower($uKode) }}" 
                                        data-name="{{ strtolower($u->unit_name ?? '') }}" 
                                        data-type="{{ strtolower($u->type ?? '') }}">
                                        <label class="d-flex align-items-start gap-2 p-2 rounded-3 border bg-white h-100 shadow-sm spk-unit-card" style="cursor: pointer;">
                                            <input type="checkbox" name="unit_ids[]" value="{{ $u->id }}" class="form-check-input mt-1 spk-unit-checkbox">
                                            <div class="flex-grow-1" style="font-size: 12px; line-height: 1.3;">
                                                <div class="fw-bold text-dark d-flex justify-content-between align-items-center">
                                                    <span>{{ $uKode }}</span>
                                                    <span class="badge bg-light text-muted border py-0 px-1" style="font-size: 10px;">{{ $u->type ?: $u->jenis }}</span>
                                                </div>
                                                <div class="text-secondary small text-truncate" style="max-width: 140px;">
                                                    {{ $u->landBank->name ?? 'Proyek' }}
                                                </div>
                                                @if($u->no_spk)
                                                    <div class="text-primary mt-1 fw-semibold" style="font-size: 10px;" title="SPK: {{ $u->no_spk }}">
                                                        <i class="mdi mdi-file-check me-0.5"></i>SPK: {{ $u->no_spk }}
                                                    </div>
                                                @else
                                                    <div class="text-muted mt-1" style="font-size: 10px;">
                                                        Belum ada SPK
                                                    </div>
                                                @endif
                                            </div>
                                        </label>
                                    </div>
                                @empty
                                    <div class="col-12 text-center py-4 text-muted">
                                        <i class="mdi mdi-home-alert-outline fs-3 d-block mb-1"></i>
                                        Belum ada unit kavling yang terdaftar.
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer border-top py-2.5 px-4 d-flex justify-content-end gap-2 bg-white">
                <button type="button" class="btn btn-sm btn-light border px-3" data-bs-dismiss="modal">
                    Batal
                </button>
                <button type="submit" form="formAssignSpkProyek" class="btn btn-sm btn-gradient-primary fw-bold text-white px-3 shadow-sm">
                    <i class="mdi mdi-check-all me-1"></i>Simpan SPK
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function applyLiveSearch(keyword) {
        keyword = (keyword || '').toLowerCase().trim();
        const rows = document.querySelectorAll('.unit-table-row');
        let visibleCount = 0;
        rows.forEach(row => {
            const searchData = row.getAttribute('data-search') || '';
            if (!keyword || searchData.includes(keyword)) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        const noRes = document.getElementById('noResultsRow');
        if (noRes) {
            noRes.style.display = (visibleCount === 0 && keyword !== '') ? '' : 'none';
        }
    }

    // SPK Rupiah formatting & Live Multiplier
    function formatRupiahSpk(angka) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            var separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        return split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    }

    function updateSpkCalculation() {
        const count = $('.spk-unit-checkbox:checked').length;
        $('#spkUnitCounter').text(count + ' unit dipilih');

        const rawVal = $('#modalSpkNilaiKontrak').val() || '0';
        const numVal = parseInt(rawVal.replace(/[^0-9]/g, ''), 10) || 0;
        const totalVal = numVal * count;

        $('#modalSpkTotalCalculation').html(
            '<i class="mdi mdi-calculator me-1"></i>Total Kontrak SPK: <strong class="ms-1">Rp ' + totalVal.toLocaleString('id-ID') + '</strong> <span class="text-muted ms-1">(' + count + ' unit dipilih)</span>'
        );
    }

    $(document).on('keyup', '#modalSpkNilaiKontrak', function() {
        $(this).val(formatRupiahSpk($(this).val()));
        updateSpkCalculation();
    });

    $(document).on('change', '.spk-unit-checkbox', function() {
        updateSpkCalculation();
        if ($(this).is(':checked')) {
            $(this).closest('.spk-unit-card').addClass('is-selected border-primary');
        } else {
            $(this).closest('.spk-unit-card').removeClass('is-selected border-primary');
        }
    });

    function filterSpkUnitGrid() {
        const selectedProject = $('#modalSpkFilterProject').val();
        const searchKeyword = ($('#filterSpkUnitSearchProyek').val() || '').toLowerCase().trim();

        $('.spk-unit-item-col').each(function() {
            const projectMatch = (selectedProject === 'all' || $(this).data('landbank-id') == selectedProject);
            const code = String($(this).data('code') || '');
            const name = String($(this).data('name') || '');
            const type = String($(this).data('type') || '');
            const textMatch = !searchKeyword || code.includes(searchKeyword) || name.includes(searchKeyword) || type.includes(searchKeyword);

            if (projectMatch && textMatch) {
                $(this).removeClass('d-none');
            } else {
                $(this).addClass('d-none');
            }
        });
    }

    $('#modalSpkFilterProject').on('change', function() {
        filterSpkUnitGrid();
    });

    $('#filterSpkUnitSearchProyek').on('keyup', function() {
        filterSpkUnitGrid();
    });

    $('#btnSelectAllSpkUnits').on('click', function() {
        $('.spk-unit-item-col:not(.d-none) .spk-unit-checkbox').prop('checked', true).trigger('change');
    });

    $('#btnUnselectAllSpkUnits').on('click', function() {
        $('.spk-unit-checkbox').prop('checked', false).trigger('change');
    });

    // File change SPK PDF in Modal
    $('#uploadDokumenSpkInputProyek').on('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            if (file.size > 15 * 1024 * 1024) {
                if (typeof Swal !== 'undefined') {
                    Swal.fire('Error', 'Ukuran file PDF maksimal 15MB!', 'error');
                } else {
                    alert('Ukuran file PDF maksimal 15MB!');
                }
                $(this).val('');
                $('#dokumenSpkFileNameProyek').text('Pilih berkas PDF atau seret ke sini');
                return;
            }
            $('#dokumenSpkFileNameProyek').html('<span class="text-primary fw-bold"><i class="mdi mdi-file-pdf me-1 text-danger"></i>' + file.name + '</span>');
        } else {
            $('#dokumenSpkFileNameProyek').text('Pilih berkas PDF atau seret ke sini');
        }
    });

    // Quick open modal for single unit
    window.openAssignSpkForSingleUnit = function(unitId, unitCode, landBankId) {
        // Reset selections
        $('.spk-unit-checkbox').prop('checked', false).closest('.spk-unit-card').removeClass('is-selected border-primary');
        
        // Filter by this unit's project
        if (landBankId) {
            $('#modalSpkFilterProject').val(landBankId);
        } else {
            $('#modalSpkFilterProject').val('all');
        }
        $('#filterSpkUnitSearchProyek').val('');
        filterSpkUnitGrid();

        // Check the specific unit
        const checkbox = $('.spk-unit-checkbox[value="' + unitId + '"]');
        if (checkbox.length) {
            checkbox.prop('checked', true).trigger('change');
        }

        // Open modal
        const modalEl = document.getElementById('modalSpkUnitProyek');
        if (modalEl) {
            if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                const modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
                modal.show();
            } else if (typeof $ !== 'undefined' && $.fn.modal) {
                $('#modalSpkUnitProyek').modal('show');
            }
        }
    };

    // Form submit validation
    $('#formAssignSpkProyek').on('submit', function(e) {
        const selectedCount = $('.spk-unit-checkbox:checked').length;
        if (selectedCount === 0) {
            e.preventDefault();
            if (typeof Swal !== 'undefined') {
                Swal.fire('Peringatan', 'Silakan pilih minimal 1 unit kavling untuk diterbitkan SPK-nya!', 'warning');
            } else {
                alert('Silakan pilih minimal 1 unit kavling untuk diterbitkan SPK-nya!');
            }
            return false;
        }

        const rawVal = $('#modalSpkNilaiKontrak').val() || '';
        if (!rawVal || rawVal === '0') {
            e.preventDefault();
            if (typeof Swal !== 'undefined') {
                Swal.fire('Peringatan', 'Silakan masukkan Nilai SPK per Unit kavling!', 'warning');
            } else {
                alert('Silakan masukkan Nilai SPK per Unit kavling!');
            }
            return false;
        }

        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Menerbitkan SPK...',
                text: 'Menyimpan kontrak SPK dan menugaskannya ke unit terpilih',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });
        }
    });
</script>
@endpush

@endsection
