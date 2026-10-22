@extends('layouts.partial.app')

@section('title', 'Unit Legalitas & Sertifikat - Property Management App')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-clean.css') }}?v={{ time() }}">
    <style>
        /* Table Responsive & Layout persis proyek unit & pengolahan lahan */
        .table-legal-unit {
            width: 100% !important;
            margin-bottom: 0;
        }
        .table-legal-unit thead th {
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
        .table-legal-unit tbody td {
            padding: 0.75rem 0.65rem !important;
            vertical-align: middle;
            font-size: 0.83rem;
            border-bottom: 1px solid #f1f5f9;
            white-space: normal !important;
        }
        .table-legal-unit .col-no {
            width: 45px;
            text-align: center;
            white-space: nowrap !important;
        }
        .table-legal-unit .col-status {
            width: 110px;
            text-align: center;
            white-space: nowrap !important;
        }
        .table-legal-unit .col-aksi {
            width: 120px;
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

        /* Detail Modal Styles */
        .detail-item {
            display: flex;
            justify-content: space-between;
            padding: 0.65rem 0;
            border-bottom: 1px dashed #e2e8f0;
            font-size: 0.85rem;
        }
        .detail-item:last-child {
            border-bottom: none;
        }
        .detail-label {
            color: #64748b;
            font-weight: 500;
        }
        .detail-value {
            color: #1e293b;
            font-weight: 600;
            text-align: right;
        }

        /* Certificate Document Link Hover */
        .cert-doc-link {
            transition: all 0.15s ease;
        }
        .cert-doc-link:hover .cert-text {
            color: #0284c7 !important;
            text-decoration: underline !important;
        }
        .cert-doc-link:hover {
            transform: translateY(-1px);
        }
    </style>
@endpush

@section('content')

<div class="container-fluid px-2 px-md-4 py-3">

    <!-- Page Title & Subtitle -->
    <div class="row align-items-center mb-4">
        <div class="col">
            <h2 class="text-dark mb-1 fw-bold" style="font-size: 1.55rem; letter-spacing: -0.02em;">
                Unit Legalitas
            </h2>
            <p class="text-muted mb-0" style="font-size: 0.88rem;">
                Daftar status sertifikat tanah (SHM/SHGB), pemecahan BPN, kelengkapan PBB & PBG per unit kavling kawasan.
            </p>
        </div>
    </div>

    <!-- 4 KPI Metrics Card Grid (Persis Proyek Unit & Perizinan) -->
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
                    <div class="dash-kpi-sub">Kavling Dalam Kawasan</div>
                </div>
            </div>
            <div class="dash-kpi-action purple">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>

        <!-- Card 2: Legalitas Selesai / SHM Terbit (Hijau) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon green">
                    <i class="mdi mdi-check-decagram-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">SHM / Terbit</div>
                    <div class="dash-kpi-val">{{ $totalLegalSelesai ?? 0 }}</div>
                    <div class="dash-kpi-sub">Sertifikat Siap / Lengkap</div>
                </div>
            </div>
            <div class="dash-kpi-action green">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>

        <!-- Card 3: Proses BPN & Notaris (Amber / Kuning) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon amber">
                    <i class="mdi mdi-file-clock-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Proses BPN / Notaris</div>
                    <div class="dash-kpi-val">{{ $totalProsesLegal ?? 0 }}</div>
                    <div class="dash-kpi-sub">Pemecahan & Validasi</div>
                </div>
            </div>
            <div class="dash-kpi-action amber">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>

        <!-- Card 4: Unit Terjual / Akad (Rose / Merah) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon rose">
                    <i class="mdi mdi-handshake-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Unit Terjual / Akad</div>
                    <div class="dash-kpi-val">{{ $totalSold ?? 0 }}</div>
                    <div class="dash-kpi-sub">Proses Balik Nama</div>
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
                        <form id="filterForm" method="GET" action="{{ route('legal.unit.index') }}">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                                
                                <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                    <!-- Search Input -->
                                    <div style="min-width: 240px; max-width: 320px; flex: 1;">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" id="liveSearchInput"
                                                placeholder="Cari kode unit, blok, sertifikat..."
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
                                    <div style="min-width: 190px;">
                                        <select name="land_bank_id" class="form-control" onchange="document.getElementById('filterForm').submit()">
                                            <option value="all">Semua Tanah Proyek</option>
                                            @foreach($landBanks as $lb)
                                                <option value="{{ $lb->id }}" {{ request('land_bank_id') == $lb->id ? 'selected' : '' }}>
                                                    {{ $lb->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Filter Status Legalitas Dropdown -->
                                    <div style="width: 170px;">
                                        <select class="form-control" name="legal_status" onchange="document.getElementById('filterForm').submit()">
                                            <option value="all" {{ request('legal_status') == 'all' ? 'selected' : '' }}>Semua Legalitas</option>
                                            <option value="selesai" {{ request('legal_status') == 'selesai' ? 'selected' : '' }}>SHM / Selesai</option>
                                            <option value="bpn" {{ request('legal_status') == 'bpn' ? 'selected' : '' }}>Proses BPN</option>
                                            <option value="notaris" {{ request('legal_status') == 'notaris' ? 'selected' : '' }}>Validasi Notaris</option>
                                            <option value="persiapan" {{ request('legal_status') == 'persiapan' ? 'selected' : '' }}>Persiapan Berkas</option>
                                        </select>
                                    </div>

                                    <!-- Filter Status Penjualan Dropdown -->
                                    <div style="width: 140px;">
                                        <select class="form-control" name="status" onchange="document.getElementById('filterForm').submit()">
                                            <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Semua Status</option>
                                            <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Available</option>
                                            <option value="booking" {{ request('status') == 'booking' ? 'selected' : '' }}>Booking</option>
                                            <option value="sold" {{ request('status') == 'sold' ? 'selected' : '' }}>Sold / Terjual</option>
                                        </select>
                                    </div>

                                    <!-- Filter Jenis Dropdown -->
                                    <div style="width: 130px;">
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
                                    <a href="{{ route('legal.unit.index') }}" class="btn btn-gradient-secondary btn-icon-only" title="Reset Filter">
                                        <i class="mdi mdi-refresh"></i>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Pure Clean Table: Daftar Unit Legalitas -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle table-legal-unit mb-0">
                            <thead>
                                <tr>
                                    <th class="col-no text-center">No</th>
                                    <th>Kode / Unit</th>
                                    <th>Tanah / Proyek Asal</th>
                                    <th>Tipe</th>
                                    <th>Jenis</th>
                                    <th style="min-width: 120px;">Legalitas</th>
                                    <th style="min-width: 150px;">Sertifikat</th>
                                    <th style="min-width: 130px;">Pembangunan</th>
                                    <th class="col-status text-center">Status Unit</th>
                                    <th class="col-aksi text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($units as $index => $u)
                                    @php
                                        // Status Unit
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

                                        // Status Legalitas
                                        $legKey = $u->legal_status_key ?? 'persiapan';
                                        $legPct = (int) ($u->legal_progress_percentage ?? 0);
                                        if ($legKey == 'selesai') {
                                            $legBadgeBg = '#ecfdf5';
                                            $legBadgeColor = '#059669';
                                            $legBadgeBorder = '#a7f3d0';
                                            $pColor = '#10b981';
                                        } elseif ($legKey == 'bpn') {
                                            $legBadgeBg = '#f5f3ff';
                                            $legBadgeColor = '#7c3aed';
                                            $legBadgeBorder = '#ddd6fe';
                                            $pColor = '#7c3aed';
                                        } elseif ($legKey == 'notaris') {
                                            $legBadgeBg = '#f0f9ff';
                                            $legBadgeColor = '#0284c7';
                                            $legBadgeBorder = '#bae6fd';
                                            $pColor = '#0284c7';
                                        } else {
                                            $legBadgeBg = '#fffbeb';
                                            $legBadgeColor = '#d97706';
                                            $legBadgeBorder = '#fde68a';
                                            $pColor = '#f59e0b';
                                        }

                                        // Data Pembangunan & RAB
                                        $progPct = (float) $u->real_construction_progress_percentage;
                                        $progColor = $progPct >= 100 ? '#10b981' : ($progPct >= 50 ? '#0284c7' : ($progPct > 0 ? '#f59e0b' : '#94a3b8'));
                                        $totalRab = (float) $u->total_rab;
                                    @endphp
                                    <tr class="unit-table-row" id="row_unit_{{ $u->id }}" 
                                        data-search="{{ strtolower($u->unit_code . ' ' . $u->unit_name . ' ' . ($u->landBank->name ?? '') . ' ' . $u->block . ' ' . $u->type . ' ' . $u->jenis . ' ' . $u->certificate_no . ' ' . $u->legal_status_label . ' ' . $stLabel) }}">
                                        
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
                                            <!-- TIPE -->
                                            <div class="fw-bold text-dark" style="font-size: 0.82rem;">
                                                {{ $u->type ? 'Tipe ' . $u->type : '-' }}
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

                                        <!-- KOLOM 1: LEGALITAS -->
                                        <td>
                                            <span class="badge py-1 px-2.5 fw-semibold" style="font-size: 0.74rem; border-radius: 6px; background-color: {{ $legBadgeBg }}; color: {{ $legBadgeColor }}; border: 1px solid {{ $legBadgeBorder }};">
                                                {{ $u->legal_status_label ?? 'Persiapan' }}
                                            </span>
                                        </td>

                                        <!-- KOLOM 2: SERTIFIKAT -->
                                        <td>
                                            @if(!empty($u->certificate_no))
                                                @if(!empty($u->file_certificate))
                                                    <a href="javascript:void(0)" 
                                                        class="fw-bold font-monospace text-decoration-none d-inline-flex align-items-center gap-1 cert-doc-link" 
                                                        style="font-size: 0.83rem; max-width: 175px; color: #1e293b;"
                                                        title="Klik untuk membuka dokumen fisik sertifikat"
                                                        onclick="previewCertificateDoc('{{ asset($u->file_certificate) }}', '{{ addslashes($u->certificate_no) }}', '{{ addslashes($u->unit_code ?: ($u->block . '-' . $u->unit_number)) }}')">
                                                        <i class="mdi mdi-certificate-outline text-success" style="font-size: 1.05rem;"></i>
                                                        <span class="text-truncate cert-text" style="text-decoration: underline dotted #0284c7;">{{ $u->certificate_no }}</span>
                                                    </a>
                                                @else
                                                    <div class="fw-bold text-dark font-monospace text-truncate d-inline-flex align-items-center gap-1" style="font-size: 0.83rem; max-width: 175px;" title="{{ $u->certificate_no }} (Dokumen fisik belum diunggah)">
                                                        <i class="mdi mdi-certificate-outline text-muted" style="font-size: 1.05rem;"></i>
                                                        <span class="text-truncate">{{ $u->certificate_no }}</span>
                                                    </div>
                                                @endif
                                            @else
                                                <span class="text-muted fw-semibold" style="font-size: 0.85rem;">-</span>
                                            @endif
                                        </td>

                                        <!-- KOLOM 3: PROSES PEMBANGUNAN (RAB) -->
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <span class="text-secondary fw-semibold" style="font-size: 0.72rem;">
                                                    <i class="mdi mdi-hammer me-1 text-primary"></i>Fisik Bangun
                                                </span>
                                                <span class="fw-bold" style="font-size: 0.75rem; color: #1e293b;">
                                                    {{ number_format($progPct, 1) }}%
                                                </span>
                                            </div>
                                            <div class="progress" style="height: 6px; background-color: #e2e8f0; border-radius: 9999px;">
                                                <div class="progress-bar rounded-pill" role="progressbar" 
                                                    style="width: {{ $progPct }}%; background-color: {{ $progColor }};" 
                                                    aria-valuenow="{{ $progPct }}" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                        </td>

                                        <td class="col-status text-center">
                                            <!-- STATUS UNIT -->
                                            <span class="badge py-1 px-2.5 fw-semibold" style="font-size: 0.74rem; border-radius: 6px; background-color: {{ $badgeBg }}; color: {{ $badgeColor }}; border: 1px solid {{ $badgeBorder }};">
                                                {{ $stLabel }}
                                            </span>
                                        </td>

                                        <td class="col-aksi text-center">
                                            <!-- AKSI: Halaman Detail Sendiri -->
                                            <a href="{{ route('legal.unit.show', $u->id) }}" 
                                                class="btn btn-sm btn-gradient-primary d-inline-flex align-items-center justify-content-center gap-1.5 px-3 py-1.5 shadow-sm text-decoration-none fw-semibold" 
                                                style="border-radius: 6px; font-size: 0.8rem;" 
                                                title="Buka Halaman Detail Legalitas & Berkas Unit">
                                                <i class="mdi mdi-file-document-outline"></i>
                                                <span>Detail</span>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center text-muted py-4">
                                            <i class="mdi mdi-home-alert-outline me-2" style="font-size: 1.5rem;"></i>
                                            Tidak ada data unit legalitas yang sesuai dengan filter.
                                        </td>
                                    </tr>
                                @endforelse

                                <tr id="noResultsRow" style="display: none;">
                                    <td colspan="10" class="text-center text-muted py-4">
                                        <i class="mdi mdi-magnify-close me-2" style="font-size: 1.5rem;"></i>
                                        Tidak ada unit legalitas yang cocok dengan kata kunci pencarian.
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



<!-- Modal Pratinjau Dokumen Sertifikat -->
<div class="modal fade" id="previewCertModal" tabindex="-1" aria-labelledby="previewCertModalLabel" aria-hidden="true" style="z-index: 1070;">
    <div class="modal-dialog modal-dialog-centered modal-xl" style="max-width: 920px; width: 95%;">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header bg-light border-bottom py-3 px-4 d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-2">
                    <div class="d-flex align-items-center justify-content-center rounded-circle bg-success text-white" style="width: 36px; height: 36px;">
                        <i class="mdi mdi-certificate-outline" style="font-size: 1.25rem;"></i>
                    </div>
                    <div>
                        <h6 class="modal-title fw-bold text-dark mb-0" id="previewCertTitle">Dokumen Sertifikat</h6>
                        <small class="text-muted" id="previewCertSubtitle">Nomor Sertifikat</small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <a href="#" id="previewCertExternalLink" target="_blank" class="btn btn-sm btn-outline-primary d-inline-flex align-items-center gap-1 px-3" style="border-radius: 6px; font-size: 0.8rem;">
                        <i class="mdi mdi-open-in-new"></i>
                        <span>Buka di Tab Baru</span>
                    </a>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body p-0 position-relative" style="background-color: #0f172a; min-height: 480px;">
                <!-- Loading indicator -->
                <div id="previewCertLoading" class="position-absolute top-50 start-50 translate-middle text-center py-5">
                    <div class="spinner-border text-light mb-2" role="status"></div>
                    <div class="text-white-50 small">Memuat dokumen fisik sertifikat...</div>
                </div>
                <!-- Container Image -->
                <div id="previewCertImageContainer" class="d-none text-center p-3" style="max-height: 75vh; overflow: auto;">
                    <img id="previewCertImage" src="" alt="Dokumen Sertifikat" class="img-fluid rounded shadow border" style="max-height: 70vh; object-fit: contain;">
                </div>
                <!-- Container PDF / iframe -->
                <div id="previewCertIframeContainer" class="d-none w-100" style="height: 75vh;">
                    <iframe id="previewCertIframe" src="" class="w-100 h-100 border-0" style="background-color: #ffffff;"></iframe>
                </div>
                <!-- Container Fallback jika format tidak didukung -->
                <div id="previewCertFallback" class="d-none text-center py-5 px-3 text-white">
                    <i class="mdi mdi-file-question-outline text-warning" style="font-size: 3.5rem;"></i>
                    <h6 class="fw-bold mt-2 text-white">Pratinjau langsung tidak tersedia</h6>
                    <p class="text-white-50 small mb-3">Format berkas dapat dibuka atau diunduh langsung melalui tombol di bawah ini.</p>
                    <a href="#" id="previewCertDownloadBtn" target="_blank" class="btn btn-primary btn-sm px-4">
                        <i class="mdi mdi-download me-1"></i>Unduh / Buka Dokumen
                    </a>
                </div>
            </div>
            <div class="modal-footer bg-light border-top py-2 px-4 d-flex justify-content-between">
                <small class="text-muted" id="previewCertFooterInfo">Dokumen Fisik Sertifikat Tanah / Unit</small>
                <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal" style="border-radius: 6px;">Tutup</button>
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

    function previewCertificateDoc(url, certNo, unitCode) {
        if (!url) return;

        document.getElementById('previewCertTitle').innerText = 'Dokumen Sertifikat — ' + (unitCode || 'Unit');
        document.getElementById('previewCertSubtitle').innerText = 'Nomor Sertifikat: ' + (certNo || '-');
        document.getElementById('previewCertExternalLink').href = url;
        document.getElementById('previewCertDownloadBtn').href = url;
        document.getElementById('previewCertFooterInfo').innerText = 'Berkas: ' + url.split('/').pop();

        const loading = document.getElementById('previewCertLoading');
        const imgContainer = document.getElementById('previewCertImageContainer');
        const iframeContainer = document.getElementById('previewCertIframeContainer');
        const fallback = document.getElementById('previewCertFallback');
        const img = document.getElementById('previewCertImage');
        const iframe = document.getElementById('previewCertIframe');

        loading.classList.remove('d-none');
        imgContainer.classList.add('d-none');
        iframeContainer.classList.add('d-none');
        fallback.classList.add('d-none');

        const cleanUrl = url.split('?')[0].toLowerCase();
        const isImage = cleanUrl.endsWith('.jpg') || cleanUrl.endsWith('.jpeg') || cleanUrl.endsWith('.png') || cleanUrl.endsWith('.webp') || cleanUrl.endsWith('.gif');
        const isPdf = cleanUrl.endsWith('.pdf');

        if (isImage) {
            img.onload = function() {
                loading.classList.add('d-none');
                imgContainer.classList.remove('d-none');
            };
            img.onerror = function() {
                loading.classList.add('d-none');
                fallback.classList.remove('d-none');
            };
            img.src = url;
            if (img.complete && img.naturalWidth > 0) {
                loading.classList.add('d-none');
                imgContainer.classList.remove('d-none');
            }
        } else if (isPdf) {
            iframe.onload = function() {
                loading.classList.add('d-none');
                iframeContainer.classList.remove('d-none');
            };
            iframe.src = url + '#toolbar=1';
            setTimeout(() => {
                loading.classList.add('d-none');
                iframeContainer.classList.remove('d-none');
            }, 600);
        } else {
            loading.classList.add('d-none');
            fallback.classList.remove('d-none');
        }

        const modalEl = document.getElementById('previewCertModal');
        const modal = new bootstrap.Modal(modalEl);
        modal.show();
    }
</script>
@endpush

@endsection
