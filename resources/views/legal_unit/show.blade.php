@extends('layouts.partial.app')

@section('title', 'Detail Unit Legalitas: ' . ($unit->unit_code ?: ($unit->block . '-' . $unit->unit_number)) . ' - Property Management App')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-clean.css') }}?v={{ time() }}">
    <style>
        .legal-detail-card {
            background: #ffffff;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
            margin-bottom: 1.5rem;
            overflow: hidden;
        }
        .legal-detail-card .card-header {
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            padding: 1rem 1.25rem;
        }
        .legal-detail-card .card-body {
            padding: 1.25rem;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px dashed #e2e8f0;
            font-size: 0.88rem;
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .detail-row-label {
            color: #64748b;
            font-weight: 500;
        }
        .detail-row-val {
            color: #1e293b;
            font-weight: 600;
            text-align: right;
        }
        .doc-preview-box {
            background-color: #0f172a;
            border-radius: 8px;
            min-height: 480px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .kpi-mini-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 1rem 1.25rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            box-shadow: 0 1px 2px rgba(0,0,0,0.03);
            transition: transform 0.2s ease;
        }
        .kpi-mini-card:hover {
            transform: translateY(-2px);
            border-color: #cbd5e1;
        }
        .kpi-mini-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
        }

        /* Button Kembali (Sama Persis Perizinan Kelola & Show) */
        .btn-kembali-proyek {
            border-radius: 8px !important;
            font-size: 0.85rem !important;
            font-weight: 700 !important;
            border: 1px solid #64748b !important;
            background-color: #64748b !important;
            color: #ffffff !important;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1) !important;
            transition: all 0.15s ease !important;
            text-decoration: none !important;
        }
        .btn-kembali-proyek:hover {
            background-color: #475569 !important;
            border-color: #475569 !important;
            color: #ffffff !important;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15) !important;
        }

        /* Unified Theme Action Button */
        .btn-theme-action {
            background-color: #7c3aed !important;
            border: 1px solid #7c3aed !important;
            color: #ffffff !important;
            font-size: 0.85rem !important;
            font-weight: 600 !important;
            padding: 0.5rem 1rem !important;
            border-radius: 8px !important;
            box-shadow: 0 1px 3px rgba(124, 58, 237, 0.2) !important;
            text-decoration: none !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 6px !important;
            transition: all 0.2s ease !important;
            cursor: pointer !important;
        }
        .btn-theme-action:hover {
            background-color: #6d28d9 !important;
            border-color: #6d28d9 !important;
            color: #ffffff !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(124, 58, 237, 0.3) !important;
        }
        .btn-theme-action:active {
            transform: translateY(0);
        }
        .btn-theme-action-sm {
            padding: 0.35rem 0.85rem !important;
            font-size: 0.78rem !important;
            border-radius: 6px !important;
        }
    </style>
@endpush

@section('content')
<div class="container-fluid px-3 px-md-4 py-3">

    <!-- Top Breadcrumb & Actions Toolbar -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4 pb-2 border-bottom">
        <div>
            <h4 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                <span>Unit {{ $unit->unit_code ?: ($unit->block . '-' . $unit->unit_number) }}</span>
                @if(strtolower($unit->jenis) == 'subsidi')
                    <span class="badge py-1 px-2.5 fw-semibold" style="background-color: #eff6ff; color: #1d4ed8; font-size: 0.75rem; border-radius: 6px; border: 1px solid #bfdbfe;">Subsidi</span>
                @else
                    <span class="badge py-1 px-2.5 fw-semibold" style="background-color: #fef3c7; color: #92400e; font-size: 0.75rem; border-radius: 6px; border: 1px solid #fde68a;">Komersil</span>
                @endif
            </h4>
            <small class="text-muted">
                {{ $unit->landBank->name ?? 'Tanah Proyek' }} • {{ $unit->unit_name ?: ('Blok ' . $unit->block . ' No. ' . $unit->unit_number) }}
            </small>
        </div>

        <div class="d-flex flex-wrap align-items-center gap-2">
            <a href="{{ route('legal.unit.index') }}" class="btn btn-sm d-inline-flex align-items-center gap-2 px-3 py-2 shadow-sm btn-kembali-proyek">
                <i class="mdi mdi-arrow-left text-white" style="font-size: 1.05rem; line-height: 1;"></i>
                <span>Kembali</span>
            </a>
            <a href="{{ route('properti.buatKavling', $unit->land_bank_id) }}" target="_blank" class="btn-theme-action">
                <i class="mdi mdi-home-edit-outline"></i>
                <span>Edit di Kavling Proyek</span>
            </a>
        </div>
    </div>

    @php
        // Status Unit Color
        $st = strtolower($unit->status ?? 'available');
        if ($st == 'available' || $st == 'tersedia') {
            $badgeBg = '#ecfdf5'; $badgeColor = '#059669'; $badgeBorder = '#a7f3d0'; $stLabel = 'Available';
        } elseif ($st == 'booking') {
            $badgeBg = '#fffbeb'; $badgeColor = '#d97706'; $badgeBorder = '#fde68a'; $stLabel = 'Booking';
        } elseif ($st == 'sold' || $st == 'terjual') {
            $badgeBg = '#fef2f2'; $badgeColor = '#dc2626'; $badgeBorder = '#fecaca'; $stLabel = 'Sold';
        } else {
            $badgeBg = '#f8fafc'; $badgeColor = '#475569'; $badgeBorder = '#e2e8f0'; $stLabel = ucfirst($st);
        }

        // Status Legalitas
        $legKey = $unit->legal_status_key ?? 'persiapan';
        $legPct = (int) ($unit->legal_progress_percentage ?? 0);
        if ($legKey == 'selesai') {
            $legBg = '#ecfdf5'; $legColor = '#059669'; $legBorder = '#a7f3d0';
        } elseif ($legKey == 'bpn') {
            $legBg = '#f5f3ff'; $legColor = '#7c3aed'; $legBorder = '#ddd6fe';
        } elseif ($legKey == 'notaris') {
            $legBg = '#f0f9ff'; $legColor = '#0284c7'; $legBorder = '#bae6fd';
        } else {
            $legBg = '#fffbeb'; $legColor = '#d97706'; $legBorder = '#fde68a';
        }

        // Progres Pembangunan
        $progPct = (float) $unit->real_construction_progress_percentage;
        $progColor = $progPct >= 100 ? '#10b981' : ($progPct >= 50 ? '#0284c7' : ($progPct > 0 ? '#f59e0b' : '#94a3b8'));
        $totalRab = (float) $unit->total_rab;
    @endphp

    <!-- Top KPI Mini Cards -->
    <div class="row g-3 mb-4">
        <!-- Card 1: Status Legalitas -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="kpi-mini-card">
                <div class="kpi-mini-icon" style="background-color: #ecfdf5; color: #059669;">
                    <i class="mdi mdi-shield-check-outline"></i>
                </div>
                <div>
                    <small class="text-muted d-block fw-semibold" style="font-size: 0.75rem;">STATUS LEGALITAS</small>
                    <span class="badge py-1 px-2 fw-bold" style="background-color: {{ $legBg }}; color: {{ $legColor }}; border: 1px solid {{ $legBorder }}; font-size: 0.78rem;">
                        {{ $unit->legal_status_label ?? 'Persiapan' }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Card 2: Sertifikat -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="kpi-mini-card">
                <div class="kpi-mini-icon" style="background-color: #f5f3ff; color: #7c3aed;">
                    <i class="mdi mdi-certificate-outline"></i>
                </div>
                <div>
                    <small class="text-muted d-block fw-semibold" style="font-size: 0.75rem;">NOMOR SERTIFIKAT</small>
                    <div class="fw-bold font-monospace text-dark text-truncate" style="max-width: 160px; font-size: 0.88rem;" title="{{ $unit->certificate_no ?: 'Belum diisi' }}">
                        {{ $unit->certificate_no ?: '-' }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 3: Pembangunan -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="kpi-mini-card">
                <div class="kpi-mini-icon" style="background-color: #eff6ff; color: #0284c7;">
                    <i class="mdi mdi-hammer"></i>
                </div>
                <div>
                    <small class="text-muted d-block fw-semibold" style="font-size: 0.75rem;">PEMBANGUNAN FISIK</small>
                    <div class="fw-bold text-dark" style="font-size: 1rem;">
                        {{ number_format($progPct, 1) }}%
                    </div>
                    <small class="text-muted" style="font-size: 0.72rem;">{{ ucwords(str_replace('_', ' ', $unit->construction_progress ?? 'Belum Mulai')) }}</small>
                </div>
            </div>
        </div>

        <!-- Card 4: Total RAP Unit -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="kpi-mini-card">
                <div class="kpi-mini-icon" style="background-color: #fef3c7; color: #d97706;">
                    <i class="mdi mdi-cash-multiple"></i>
                </div>
                <div>
                    <small class="text-muted d-block fw-semibold" style="font-size: 0.75rem;">TOTAL RAP TERPADU</small>
                    <div class="fw-bold font-monospace text-dark" style="font-size: 0.95rem;">
                        @if($totalRab > 0)
                            Rp {{ number_format($totalRab, 0, ',', '.') }}
                        @else
                            <span class="text-muted fw-normal" style="font-size: 0.82rem;">Belum ada RAP</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Grid Content -->
    <div class="row g-4">
        
        <!-- Left Column: Legalitas & Pratinjau Dokumen -->
        <div class="col-12 col-lg-7">
            
            <!-- Card Data Legalitas Unit -->
            <div class="legal-detail-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <i class="mdi mdi-shield-check text-primary" style="font-size: 1.25rem;"></i>
                        <h6 class="mb-0 fw-bold text-dark">Data Berkas & Perizinan Legalitas</h6>
                    </div>
                    @if(!empty($unit->file_certificate))
                        <span class="badge py-1 px-2 fw-semibold" style="background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; font-size: 0.74rem;">
                            <i class="mdi mdi-check-circle me-1"></i>Dokumen Fisik Ada
                        </span>
                    @else
                        <span class="badge py-1 px-2 fw-semibold" style="background: #fffbeb; color: #b45309; border: 1px solid #fde68a; font-size: 0.74rem;">
                            Dokumen Fisik Belum Diunggah
                        </span>
                    @endif
                </div>
                <div class="card-body">
                    <div class="detail-row">
                        <span class="detail-row-label">Status Legalitas</span>
                        <span class="detail-row-val">
                            <span class="badge py-1 px-2.5 fw-semibold" style="background-color: {{ $legBg }}; color: {{ $legColor }}; border: 1px solid {{ $legBorder }};">
                                {{ $unit->legal_status_label ?? 'Persiapan' }}
                            </span>
                        </span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-row-label">Nomor Sertifikat (SHM / HGB)</span>
                        <span class="detail-row-val font-monospace fw-bold text-dark">
                            {{ $unit->certificate_no ?: '-' }}
                        </span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-row-label">Nomor Objek Pajak (NOP / PBB)</span>
                        <span class="detail-row-val font-monospace">
                            {{ $unit->no_pbb ?? '-' }}
                        </span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-row-label">Nomor PBG / IMB Unit</span>
                        <span class="detail-row-val font-monospace">
                            {{ $unit->no_pbg ?? '-' }}
                        </span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-row-label">Status Pajak & Retribusi</span>
                        <span class="detail-row-val text-success">
                            {{ $unit->status_pajak ?? 'Lunas / Terverifikasi' }}
                        </span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-row-label">Tanah / Proyek Asal</span>
                        <span class="detail-row-val text-primary fw-bold">
                            {{ $unit->landBank->name ?? 'Tanah Proyek' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Card Pratinjau Dokumen Sertifikat -->
            <div class="legal-detail-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <i class="mdi mdi-file-certificate text-success" style="font-size: 1.25rem;"></i>
                        <h6 class="mb-0 fw-bold text-dark">Dokumen Fisik Sertifikat</h6>
                    </div>
                    @if(!empty($unit->file_certificate))
                        <div class="d-flex align-items-center gap-2">
                            <a href="{{ asset($unit->file_certificate) }}" target="_blank" class="btn-theme-action btn-theme-action-sm">
                                <i class="mdi mdi-open-in-new"></i> <span>Buka Ukuran Penuh</span>
                            </a>
                            <a href="{{ asset($unit->file_certificate) }}" download class="btn-theme-action btn-theme-action-sm">
                                <i class="mdi mdi-download"></i> <span>Unduh</span>
                            </a>
                        </div>
                    @endif
                </div>
                <div class="card-body p-0">
                    @if(!empty($unit->file_certificate))
                        @php
                            $certPath = asset($unit->file_certificate);
                            $ext = strtolower(pathinfo($unit->file_certificate, PATHINFO_EXTENSION));
                            $isImg = in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif']);
                            $isPdf = in_array($ext, ['pdf']);
                        @endphp

                        @if($isImg)
                            <div class="p-3 text-center" style="background-color: #0f172a;">
                                <img src="{{ $certPath }}" alt="Dokumen Sertifikat" class="img-fluid rounded shadow border" style="max-height: 540px; object-fit: contain;">
                            </div>
                        @elseif($isPdf)
                            <div style="height: 560px; width: 100%;">
                                <iframe src="{{ $certPath }}#toolbar=1" class="w-100 h-100 border-0"></iframe>
                            </div>
                        @else
                            <div class="p-4 text-center">
                                <i class="mdi mdi-file-check-outline text-success" style="font-size: 3rem;"></i>
                                <h6 class="fw-bold mt-2">Dokumen Berkas Tersimpan</h6>
                                <p class="text-muted small mb-3">Dokumen berformat <code>.{{ $ext }}</code> siap dibuka atau diunduh.</p>
                                <a href="{{ $certPath }}" target="_blank" class="btn-theme-action btn-theme-action-sm">
                                    <i class="mdi mdi-download me-1"></i><span>Buka Dokumen</span>
                                </a>
                            </div>
                        @endif
                    @else
                        <div class="p-4 text-center text-muted">
                            <i class="mdi mdi-file-upload-outline text-muted" style="font-size: 3rem; opacity: 0.6;"></i>
                            <h6 class="fw-bold mt-2 text-dark">Belum Ada Dokumen Fisik Sertifikat</h6>
                            <p class="text-muted small mb-3">Nomor sertifikat belum dilampiri dengan file pindaian/scan dokumen fisik.</p>
                            <a href="{{ route('properti.buatKavling', $unit->land_bank_id) }}" target="_blank" class="btn-theme-action btn-theme-action-sm">
                                <i class="mdi mdi-upload me-1"></i><span>Unggah di Menu Kavling Proyek</span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>

        </div>

        <!-- Right Column: Kavling & Pembangunan (RAB) -->
        <div class="col-12 col-lg-5">
            
            <!-- Card Spesifikasi Unit & Kavling -->
            <div class="legal-detail-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <i class="mdi mdi-home-outline text-primary" style="font-size: 1.25rem;"></i>
                        <h6 class="mb-0 fw-bold text-dark">Spesifikasi Unit & Kavling</h6>
                    </div>
                    <span class="badge py-1 px-2 fw-semibold" style="background-color: {{ $badgeBg }}; color: {{ $badgeColor }}; border: 1px solid {{ $badgeBorder }}; font-size: 0.74rem;">
                        {{ $stLabel }}
                    </span>
                </div>
                <div class="card-body">
                    <div class="detail-row">
                        <span class="detail-row-label">Kode Unit</span>
                        <span class="detail-row-val font-monospace fw-bold text-dark">
                            {{ $unit->unit_code ?: ($unit->block . '-' . $unit->unit_number) }}
                        </span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-row-label">Blok & Nomor</span>
                        <span class="detail-row-val font-monospace">
                            Blok {{ $unit->block ?? '-' }} No. {{ $unit->unit_number ?? '-' }}
                        </span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-row-label">Tipe Rumah</span>
                        <span class="detail-row-val fw-bold">
                            {{ $unit->type ? 'Tipe ' . $unit->type : '-' }}
                        </span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-row-label">Luas Bangunan (LB)</span>
                        <span class="detail-row-val font-monospace">
                            {{ $unit->building_area ? $unit->building_area . ' m²' : '-' }}
                        </span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-row-label">Luas Tanah (LT)</span>
                        <span class="detail-row-val font-monospace">
                            {{ $unit->area ? $unit->area . ' m²' : '-' }}
                        </span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-row-label">Jenis Properti</span>
                        <span class="detail-row-val text-capitalize">
                            {{ $unit->jenis ?? '-' }}
                        </span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-row-label">Arah Hadap / Posisi</span>
                        <span class="detail-row-val text-capitalize">
                            {{ $unit->facing ?: '-' }} / {{ $unit->position ?: '-' }}
                        </span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-row-label">Harga Jual Unit</span>
                        <span class="detail-row-val fw-bold text-success font-monospace" style="font-size: 0.95rem;">
                            Rp {{ number_format($unit->price ?? 0, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Card Pembangunan & RAP Fisik -->
            <div class="legal-detail-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <i class="mdi mdi-hammer text-info" style="font-size: 1.25rem;"></i>
                        <h6 class="mb-0 fw-bold text-dark">Pembangunan & RAP Fisik</h6>
                    </div>
                    <span class="fw-bold" style="color: {{ $progColor }}; font-size: 0.85rem;">
                        {{ number_format($progPct, 1) }}%
                    </span>
                </div>
                <div class="card-body">
                    <!-- Progress Bar Fisik -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="small fw-semibold text-secondary">Capaian Progres Riil</span>
                            <span class="fw-bold small" style="color: {{ $progColor }};">{{ number_format($progPct, 1) }}%</span>
                        </div>
                        <div class="progress" style="height: 7px; background-color: #e2e8f0; border-radius: 9999px;">
                            <div class="progress-bar rounded-pill" role="progressbar" style="width: {{ $progPct }}%; background-color: {{ $progColor }};"></div>
                        </div>
                    </div>

                    <div class="detail-row">
                        <span class="detail-row-label">Tahap Pekerjaan</span>
                        <span class="detail-row-val text-capitalize">
                            {{ ucwords(str_replace('_', ' ', $unit->construction_progress ?? 'Belum Mulai')) }}
                        </span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-row-label">Total Anggaran RAP</span>
                        <span class="detail-row-val font-monospace fw-bold text-dark">
                            @if($totalRab > 0)
                                Rp {{ number_format($totalRab, 0, ',', '.') }}
                            @else
                                <span class="text-muted fw-normal">-</span>
                            @endif
                        </span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-row-label">Rincian Item Pekerjaan</span>
                        <span class="detail-row-val font-monospace">
                            {{ $unit->total_item_rab }} item terdaftar
                        </span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-row-label">No. SPK / Kontraktor</span>
                        <span class="detail-row-val">
                            {{ $unit->no_spk ?: '-' }}
                            @if($unit->kontraktor)
                                <small class="text-muted d-block">({{ $unit->kontraktor }})</small>
                            @endif
                        </span>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection
