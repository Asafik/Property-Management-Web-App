@extends('layouts.partial.app')

@section('title', 'Dashboard Divisi Proyek - Property Management App')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-clean.css') }}?v={{ time() }}">
    <style>
        /* 5-Column Responsive KPI Grid Khusus Divisi Proyek */
        .dash-kpi-grid-5 {
            display: grid;
            grid-template-columns: 1fr;
            gap: 0.75rem;
            margin-bottom: 1.25rem;
            width: 100%;
        }
        @media (min-width: 576px) {
            .dash-kpi-grid-5 {
                grid-template-columns: repeat(2, 1fr);
                gap: 0.85rem;
            }
        }
        @media (min-width: 992px) {
            .dash-kpi-grid-5 {
                grid-template-columns: repeat(3, 1fr);
            }
        }
        @media (min-width: 1200px) {
            .dash-kpi-grid-5 {
                grid-template-columns: repeat(5, 1fr);
                gap: 0.85rem;
            }
        }

        /* Clean Micro Action Buttons */
        .action-pill-btn {
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.28rem 0.65rem;
            border-radius: 4px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            text-decoration: none !important;
            transition: all 0.2s ease;
        }
        .action-pill-btn.green {
            background-color: #ecfdf5;
            color: #059669;
            border: 1px solid #a7f3d0;
        }
        .action-pill-btn.green:hover {
            background-color: #059669;
            color: #ffffff;
        }
        .action-pill-btn.blue {
            background-color: #f0f9ff;
            color: #0284c7;
            border: 1px solid #bae6fd;
        }
        .action-pill-btn.blue:hover {
            background-color: #0284c7;
            color: #ffffff;
        }
        .action-pill-btn.amber {
            background-color: #fffbeb;
            color: #d97706;
            border: 1px solid #fde68a;
        }
        .action-pill-btn.amber:hover {
            background-color: #d97706;
            color: #ffffff;
        }
        .action-pill-btn.purple {
            background-color: #9a55ff;
            color: #ffffff !important;
            border: 1px solid #9a55ff;
            border-radius: 4px;
        }
        .action-pill-btn.purple:hover {
            background-color: #8432f7;
            border-color: #8432f7;
            color: #ffffff !important;
        }

        /* Progress Bar Halus */
        .progress-subtle {
            height: 6px;
            border-radius: 6px;
            background-color: #e2e8f0;
            overflow: hidden;
        }
    </style>
@endpush

@section('content')
<div class="dash-wrapper">

    <!-- ========================================================================= -->
    <!-- 1. HEADER SECTION (CLEAN MODERN PERSIS DASHBOARD MARKETING & ADMIN) -->
    <!-- ========================================================================= -->
    <div class="dash-header mb-4">
        <!-- Kiri: Greeting Title & Subtitle -->
        <div>

            <h1 class="dash-header-title">
                Selamat datang, {{ auth()->user()->name ?? 'Kepala Proyek' }}
            </h1>
            <p class="dash-header-sub">
                Monitoring terpadu pematangan lahan, fasilitas kawasan, SPK kontraktor, dan opname fisik proyek.
            </p>
        </div>

        <!-- Kanan: Tanggal Hari Ini & Sapaan -->
        <div class="dash-header-date-box">
            <div class="dash-header-date-icon">
                <i class="mdi mdi-calendar-month-outline"></i>
            </div>
            <div>
                <div class="dash-header-date-text">
                    {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}
                </div>
                <div class="dash-header-date-sub">
                    Selamat bekerja, {{ auth()->user()->name ?? 'Kepala Proyek' }}!
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- 2. 5 EXECUTIVE METRIC CARDS (PERSIS DASHBOARD CLEAN STANDARD) -->
    <!-- ========================================================================= -->
    <div class="dash-kpi-grid-5 mb-4">
        
        <!-- Card 1: Total Proyek Kawasan (Ungu) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon purple">
                    <i class="mdi mdi-city-variant-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Proyek Kawasan</div>
                    <div class="dash-kpi-val">{{ $totalProjects }} <span style="font-size: 0.75rem; font-weight: normal; color: #64748b;">Kawasan</span></div>
                    <div class="dash-kpi-sub">{{ number_format($totalArea, 0, ',', '.') }} m² Total Luas</div>
                </div>
            </div>
            <a href="#kawasanTableSection" class="dash-kpi-action purple" title="Lihat Daftar Kawasan">
                <i class="mdi mdi-arrow-right"></i>
            </a>
        </div>

        <!-- Card 2: Pengolahan Lahan (Hijau) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon green">
                    <i class="mdi mdi-hard-hat"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Infrastruktur Lahan</div>
                    <div class="dash-kpi-val">{{ $avgInfraProgress }}% <span style="font-size: 0.75rem; font-weight: normal; color: #64748b;">Selesai</span></div>
                    <div class="dash-kpi-sub">{{ $infraSelesai }}/{{ $totalInfrastruktur }} Item Selesai</div>
                </div>
            </div>
            <a href="{{ route('proyek.pengolahan-lahan.index') }}" class="dash-kpi-action green" title="Buka Pengolahan Lahan">
                <i class="mdi mdi-arrow-right"></i>
            </a>
        </div>

        <!-- Card 3: Unit Kavling Proyek (Biru) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon blue">
                    <i class="mdi mdi-home-city-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Unit Kavling</div>
                    <div class="dash-kpi-val">{{ $totalUnits }} <span style="font-size: 0.75rem; font-weight: normal; color: #64748b;">Kavling</span></div>
                    <div class="dash-kpi-sub">{{ $readyUnits }} Ready | {{ $progressUnits }} Dibangun</div>
                </div>
            </div>
            <a href="{{ route('proyek.unit.index') }}" class="dash-kpi-action blue" title="Buka Monitoring Unit">
                <i class="mdi mdi-arrow-right"></i>
            </a>
        </div>

        <!-- Card 4: SPK Kontraktor (Amber) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon amber">
                    <i class="mdi mdi-file-sign"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">SPK Kontraktor</div>
                    <div class="dash-kpi-val">{{ $spkBerjalan }} <span style="font-size: 0.75rem; font-weight: normal; color: #64748b;">Aktif</span></div>
                    <div class="dash-kpi-sub">Rp {{ number_format($totalNilaiKontrak, 0, ',', '.') }}</div>
                </div>
            </div>
            <a href="{{ route('spk.index') }}" class="dash-kpi-action amber" title="Kelola SPK Kontraktor">
                <i class="mdi mdi-arrow-right"></i>
            </a>
        </div>

        <!-- Card 5: Pengajuan Pending (Rose) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon rose">
                    <i class="mdi mdi-clipboard-clock-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Pengajuan Pending</div>
                    <div class="dash-kpi-val">{{ $opnamePending + $totalTerminPending }} <span style="font-size: 0.75rem; font-weight: normal; color: #64748b;">Item</span></div>
                    <div class="dash-kpi-sub">{{ $opnamePending }} Opname | {{ $totalTerminPending }} Termin</div>
                </div>
            </div>
            <a href="#terminTableSection" class="dash-kpi-action rose" title="Lihat Pengajuan Pending">
                <i class="mdi mdi-arrow-right"></i>
            </a>
        </div>

    </div>

    <!-- ========================================================================= -->
    <!-- 3. SECTION A: DAFTAR PROYEK KAWASAN & PENGOLAHAN LAHAN -->
    <!-- ========================================================================= -->
    <div id="kawasanTableSection" class="dash-panel mb-4">
        <div class="dash-panel-header">
            <div class="dash-panel-title-wrap">
                <div class="dash-panel-icon purple">
                    <i class="mdi mdi-office-building"></i>
                </div>
                <div>
                    <h3 class="dash-panel-title">Kawasan Proyek & Pengolahan Lahan</h3>
                    <p class="dash-panel-subtitle">Monitoring pematangan tanah induk dan progres fasilitas fisik kawasan</p>
                </div>
            </div>
        </div>

        <div class="dash-panel-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="font-size: 0.86rem;">
                    <thead>
                        <tr style="background: linear-gradient(135deg, #f8f9fa, #f1f3f5); border-bottom: 2px solid #e9ecef;">
                            <th class="py-2.5 px-3 text-center" style="width: 50px; color: #9a55ff; font-weight: 700; font-size: 0.8rem; text-transform: uppercase;">NO</th>
                            <th class="py-2.5" style="color: #9a55ff; font-weight: 700; font-size: 0.8rem; text-transform: uppercase;">NAMA KAWASAN PROYEK</th>
                            <th class="py-2.5" style="color: #9a55ff; font-weight: 700; font-size: 0.8rem; text-transform: uppercase;">PENGEMBANG & PT</th>
                            <th class="py-2.5" style="color: #9a55ff; font-weight: 700; font-size: 0.8rem; text-transform: uppercase;">LUAS TANAH</th>
                            <th class="py-2.5" style="color: #9a55ff; font-weight: 700; font-size: 0.8rem; text-transform: uppercase;">LEGALITAS</th>
                            <th class="py-2.5" style="color: #9a55ff; font-weight: 700; font-size: 0.8rem; text-transform: uppercase; width: 230px;">PROGRES INFRASTRUKTUR</th>
                            <th class="py-2.5 text-center" style="color: #9a55ff; font-weight: 700; font-size: 0.8rem; text-transform: uppercase; width: 140px;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($projectsList as $idx => $proj)
                            <tr>
                                <td class="px-3 text-center text-muted fw-bold">{{ $idx + 1 }}</td>
                                <td>
                                    <div class="fw-bold text-dark" style="font-size: 0.92rem;">
                                        <i class="mdi mdi-city-variant text-primary me-1"></i>{{ $proj->name }}
                                    </div>
                                </td>
                                <td>
                                    <span class="badge py-1 px-2" style="background: #f1f5f9; color: #334155; font-size: 0.74rem; font-weight: 600; border-radius: 4px;">
                                        <i class="mdi mdi-domain me-1" style="color: #9a55ff;"></i>{{ $proj->company_name }}
                                    </span>
                                </td>
                                <td>
                                    <span class="fw-bold text-dark font-monospace" style="font-size: 0.88rem;">{{ number_format($proj->area, 0, ',', '.') }} m²</span>
                                </td>
                                <td>
                                    <span class="badge py-1 px-2" style="background: #e0f2fe; color: #0369a1; font-size: 0.74rem; font-weight: 600; border-radius: 4px;">
                                        <i class="mdi mdi-shield-check me-0.5"></i>{{ $proj->legal_status }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <span class="small fw-semibold text-dark">{{ $proj->done_infra }}/{{ $proj->total_infra }} Selesai</span>
                                        <span class="badge {{ $proj->progress_infra >= 100 ? 'bg-success' : 'bg-primary' }} text-white" style="font-size: 0.72rem; border-radius: 4px;">
                                            {{ $proj->progress_infra }}%
                                        </span>
                                    </div>
                                    <div class="progress progress-subtle">
                                        <div class="progress-bar {{ $proj->progress_infra >= 100 ? 'bg-success' : 'bg-primary' }}" 
                                            role="progressbar" 
                                            style="width: {{ $proj->progress_infra }}%;" 
                                            aria-valuenow="{{ $proj->progress_infra }}" 
                                            aria-valuemin="0" 
                                            aria-valuemax="100"></div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('properti.pengolahanLahan', $proj->id) }}" class="action-pill-btn purple" title="Kelola Pengolahan Lahan">
                                        <i class="mdi mdi-tools"></i> Kelola
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="mdi mdi-office-building-outline fs-2 d-block mb-2 opacity-50"></i>
                                    Belum ada kawasan proyek yang terdaftar.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- 3. SECTION B: MONITORING UNIT KAVLING PROYEK (CARD DEDIKASI TERSENDIRI) -->
    <!-- ========================================================================= -->
    <div id="unitTableSection" class="dash-panel mb-4">
        <div class="dash-panel-header">
            <div class="dash-panel-title-wrap">
                <div class="dash-panel-icon blue">
                    <i class="mdi mdi-home-city-outline"></i>
                </div>
                <div>
                    <h3 class="dash-panel-title">Monitoring Unit Kavling Proyek</h3>
                    <p class="dash-panel-subtitle">Ketersediaan unit kavling, progres konstruksi, dan status pembangunan fisik</p>
                </div>
            </div>
        </div>

        <div class="dash-panel-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="font-size: 0.86rem;">
                    <thead>
                        <tr style="background: linear-gradient(135deg, #f8f9fa, #f1f3f5); border-bottom: 2px solid #e9ecef;">
                            <th class="py-2.5 px-3 text-center" style="width: 50px; color: #9a55ff; font-weight: 700; font-size: 0.8rem; text-transform: uppercase;">NO</th>
                            <th class="py-2.5" style="color: #9a55ff; font-weight: 700; font-size: 0.8rem; text-transform: uppercase;">KODE & NAMA UNIT</th>
                            <th class="py-2.5" style="color: #9a55ff; font-weight: 700; font-size: 0.8rem; text-transform: uppercase;">KAWASAN PROYEK</th>
                            <th class="py-2.5" style="color: #9a55ff; font-weight: 700; font-size: 0.8rem; text-transform: uppercase;">TIPE & SPESIFIKASI</th>
                            <th class="py-2.5 text-center" style="color: #9a55ff; font-weight: 700; font-size: 0.8rem; text-transform: uppercase; width: 180px;">PROGRES FISIK</th>
                            <th class="py-2.5 text-center" style="color: #9a55ff; font-weight: 700; font-size: 0.8rem; text-transform: uppercase; width: 110px;">STATUS</th>
                            <th class="py-2.5 text-center" style="color: #9a55ff; font-weight: 700; font-size: 0.8rem; text-transform: uppercase; width: 160px;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentUnits ?? [] as $uIdx => $u)
                            @php
                                $uStatus = strtolower($u->status ?? 'ready');
                                $uBadgeColor = match(true) {
                                    in_array($uStatus, ['ready', 'tersedia', 'available']) => 'bg-success',
                                    in_array($uStatus, ['booked', 'booking']) => 'bg-info',
                                    in_array($uStatus, ['sold', 'terjual']) => 'bg-primary',
                                    in_array($uStatus, ['progress', 'pembangunan', 'proses']) => 'bg-warning text-dark',
                                    default => 'bg-secondary'
                                };
                                $uStatusLabel = match(true) {
                                    in_array($uStatus, ['ready', 'tersedia', 'available']) => 'Ready',
                                    in_array($uStatus, ['booked', 'booking']) => 'Booking',
                                    in_array($uStatus, ['sold', 'terjual']) => 'Terjual',
                                    in_array($uStatus, ['progress', 'pembangunan', 'proses']) => 'Pembangunan',
                                    default => ucfirst($uStatus)
                                };
                                $uProg = $u->construction_progress_percentage ?? 0;
                            @endphp
                            <tr>
                                <td class="px-3 text-center text-muted fw-bold">{{ $uIdx + 1 }}</td>
                                <td>
                                    <div class="fw-bold text-dark" style="font-size: 0.9rem;">
                                        <span class="badge bg-light text-dark border px-2 py-0.5 me-1 font-monospace" style="font-size: 0.74rem;">
                                            {{ $u->unit_code ?: ($u->block . '.' . $u->unit_number) }}
                                        </span>
                                        {{ $u->unit_name ?: 'Kavling ' . $u->unit_code }}
                                    </div>
                                </td>
                                <td>
                                    <span class="fw-semibold text-dark d-block">
                                        <i class="mdi mdi-city-variant-outline me-1 text-primary"></i>{{ $u->landBank->name ?? '-' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="fw-bold text-dark d-block">{{ $u->type ? 'Tipe ' . $u->type : 'Standar' }}</span>
                                    <small class="text-muted font-monospace" style="font-size: 0.72rem;">
                                        LT: {{ $u->area }} m² &bull; {{ ucfirst($u->jenis ?? 'Komersil') }}
                                    </small>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-between align-items-center mb-1 px-2">
                                        <span class="small text-muted" style="font-size: 0.72rem;">Konstruksi</span>
                                        <span class="fw-bold text-dark" style="font-size: 0.76rem;">{{ $uProg }}%</span>
                                    </div>
                                    <div class="progress progress-subtle mx-2">
                                        <div class="progress-bar {{ $uProg >= 100 ? 'bg-success' : ($uProg > 0 ? 'bg-primary' : 'bg-secondary') }}" 
                                            role="progressbar" 
                                            style="width: {{ $uProg }}%;" 
                                            aria-valuenow="{{ $uProg }}" 
                                            aria-valuemin="0" 
                                            aria-valuemax="100"></div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge {{ $uBadgeColor }} py-1 px-2.5" style="font-size: 0.72rem; border-radius: 4px;">
                                        {{ $uStatusLabel }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('properti.progress', $u->land_bank_id) }}" class="action-pill-btn amber" title="Progres Pembangunan">
                                        <i class="mdi mdi-progress-wrench"></i> Progres
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="mdi mdi-home-outline fs-2 d-block mb-2 opacity-50"></i>
                                    Belum ada data unit kavling yang terdaftar.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- 4. SECTION: DUA KOLOM (SPK KONTRAKTOR & OPNAME MINGGUAN) -->
    <!-- ========================================================================= -->
    <div class="dash-row-grid mb-4">
        
        <!-- Kolom Kiri: SPK Kontraktor Berjalan -->
        <div class="dash-panel">
            <div class="dash-panel-header">
                <div class="dash-panel-title-wrap">
                    <div class="dash-panel-icon amber">
                        <i class="mdi mdi-file-sign"></i>
                    </div>
                    <div>
                        <h3 class="dash-panel-title">SPK Kontraktor Berjalan</h3>
                        <p class="dash-panel-subtitle">Daftar penugasan konstruksi aktif</p>
                    </div>
                </div>
                <a href="{{ route('spk.index') }}" class="small text-primary fw-bold text-decoration-none d-inline-flex align-items-center">
                    Lihat Semua SPK <i class="mdi mdi-chevron-right"></i>
                </a>
            </div>

            <div class="dash-panel-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" style="font-size: 0.84rem;">
                        <thead>
                            <tr style="background: linear-gradient(135deg, #f8f9fa, #f1f3f5); border-bottom: 2px solid #e9ecef;">
                                <th class="py-2.5 px-3" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase;">KONTRAKTOR</th>
                                <th class="py-2.5" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase;">PEKERJAAN</th>
                                <th class="py-2.5 text-end" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase;">NILAI KONTRAK</th>
                                <th class="py-2.5 text-center" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase; width: 80px;">FISIK</th>
                                <th class="py-2.5 text-center" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase; width: 90px;">STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentSpks as $spk)
                                <tr>
                                    <td class="px-3">
                                        <div class="fw-bold text-dark" style="font-size: 0.85rem;">
                                            {{ $spk->kontraktor_nama ?? 'Kontraktor' }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-dark fw-semibold text-truncate d-inline-block" style="max-width: 140px;" title="{{ $spk->nama_pekerjaan ?? '-' }}">
                                            {{ Str::limit($spk->nama_pekerjaan ?? '-', 18) }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <span class="fw-bold text-dark font-monospace" style="font-size: 0.85rem;">Rp {{ number_format($spk->nilai_kontrak ?? 0, 0, ',', '.') }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="fw-bold text-primary">{{ $spk->progress ?? 0 }}%</span>
                                        <div class="progress progress-subtle mt-1">
                                            <div class="progress-bar bg-primary" style="width: {{ $spk->progress ?? 0 }}%;"></div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge {{ strtolower($spk->status ?? '') === 'selesai' ? 'bg-success' : 'bg-warning text-dark' }} py-1 px-2" style="font-size: 0.72rem; border-radius: 4px;">
                                            {{ ucfirst($spk->status ?? 'Proses') }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">
                                        <i class="mdi mdi-file-outline fs-3 d-block mb-1 opacity-50"></i>
                                        Belum ada data SPK kontraktor.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Opname Mingguan Lapangan -->
        <div class="dash-panel">
            <div class="dash-panel-header">
                <div class="dash-panel-title-wrap">
                    <div class="dash-panel-icon purple">
                        <i class="mdi mdi-clipboard-text-outline"></i>
                    </div>
                    <div>
                        <h3 class="dash-panel-title">Opname Mingguan Lapangan</h3>
                        <p class="dash-panel-subtitle">Verifikasi progres fisik mingguan</p>
                    </div>
                </div>
                <span class="badge px-2.5 py-1" style="background: rgba(154, 85, 255, 0.12); color: #9a55ff; font-size: 0.74rem; font-weight: 700; border-radius: 6px;">
                    {{ $opnamePending }} Menunggu Review
                </span>
            </div>

            <div class="dash-panel-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" style="font-size: 0.84rem;">
                        <thead>
                            <tr style="background: linear-gradient(135deg, #f8f9fa, #f1f3f5); border-bottom: 2px solid #e9ecef;">
                                <th class="py-2.5 px-3" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase;">MINGGU & NO OPNAME</th>
                                <th class="py-2.5" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase;">UNIT / KAWASAN</th>
                                <th class="py-2.5 text-center" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase;">PROGRES KUMULATIF</th>
                                <th class="py-2.5 text-center" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase; width: 100px;">STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentOpnames as $opname)
                                <tr>
                                    <td class="px-3">
                                        <span class="badge bg-light text-dark border fw-bold me-1" style="font-size: 0.72rem;">
                                            M-{{ $opname->minggu_ke ?? '1' }}
                                        </span>
                                        <span class="fw-semibold text-dark font-monospace">{{ $opname->no_opname ?? '-' }}</span>
                                        <small class="text-muted d-block mt-0.5">
                                            <i class="mdi mdi-calendar me-0.5"></i>{{ $opname->tanggal_mulai_minggu ? \Carbon\Carbon::parse($opname->tanggal_mulai_minggu)->format('d M') : '' }} - {{ $opname->tanggal_akhir_minggu ? \Carbon\Carbon::parse($opname->tanggal_akhir_minggu)->format('d M Y') : '' }}
                                        </small>
                                    </td>
                                    <td>
                                        <span class="fw-bold text-dark d-block">{{ $opname->unit->unit_name ?? ($opname->unit->unit_code ?? 'Kavling') }}</span>
                                        <small class="text-muted">{{ $opname->unit->landBank->name ?? '-' }}</small>
                                    </td>
                                    <td class="text-center">
                                        <span class="fw-bold text-success">{{ $opname->progress_kumulatif ?? 0 }}%</span>
                                        <small class="text-muted d-block" style="font-size: 0.72rem;">
                                            +{{ $opname->progress_minggu_ini ?? 0 }}% mg ini
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        @php $st = strtolower($opname->status ?? ''); @endphp
                                        @if($st === 'disetujui' || $st === 'approved' || $st === 'acc')
                                            <span class="badge bg-success text-white py-1 px-2" style="font-size: 0.72rem; border-radius: 4px;">
                                                <i class="mdi mdi-check-circle me-0.5"></i>Disetujui
                                            </span>
                                        @elseif($st === 'revisi')
                                            <span class="badge bg-danger text-white py-1 px-2" style="font-size: 0.72rem; border-radius: 4px;">
                                                <i class="mdi mdi-alert-circle me-0.5"></i>Revisi
                                            </span>
                                        @else
                                            <span class="badge bg-warning text-dark py-1 px-2" style="font-size: 0.72rem; border-radius: 4px;">
                                                <i class="mdi mdi-clock-outline me-0.5"></i>Diajukan
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">
                                        <i class="mdi mdi-clipboard-outline fs-3 d-block mb-1 opacity-50"></i>
                                        Belum ada laporan opname mingguan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <!-- ========================================================================= -->
    <!-- 5. SECTION: JADWAL & STATUS PEMBAYARAN TERMIN KONTRAKTOR -->
    <!-- ========================================================================= -->
    <div id="terminTableSection" class="dash-panel mb-4">
        <div class="dash-panel-header">
            <div class="dash-panel-title-wrap">
                <div class="dash-panel-icon green">
                    <i class="mdi mdi-cash-register"></i>
                </div>
                <div>
                    <h3 class="dash-panel-title">Pengajuan & Pembayaran Termin Kontraktor</h3>
                    <p class="dash-panel-subtitle">Monitoring tagihan pembayaran termin konstruksi berdasarkan syarat capaian fisik lapangan</p>
                </div>
            </div>
            <div class="d-flex align-items-center gap-2">
                @if($totalTerminPending > 0)
                    <span class="badge py-1.5 px-3" style="background: #fef3c7; color: #b45309; font-size: 0.8rem; font-weight: 700; border: 1px solid #fde68a; border-radius: 6px;">
                        <i class="mdi mdi-clock-alert-outline me-1"></i>{{ $totalTerminPending }} Termin Menunggu Approval (Rp {{ number_format($nominalTerminPending, 0, ',', '.') }})
                    </span>
                @else
                    <span class="badge py-1.5 px-3" style="background: #ecfdf5; color: #059669; font-size: 0.8rem; font-weight: 700; border: 1px solid #a7f3d0; border-radius: 6px;">
                        <i class="mdi mdi-check-circle me-1"></i>Seluruh Termin Terkendali
                    </span>
                @endif
            </div>
        </div>

        <div class="dash-panel-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="font-size: 0.85rem;">
                    <thead>
                        <tr style="background: linear-gradient(135deg, #f8f9fa, #f1f3f5); border-bottom: 2px solid #e9ecef;">
                            <th class="py-2.5 px-3 text-center" style="width: 50px; color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase;">NO</th>
                            <th class="py-2.5" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase;">UNIT & KAWASAN</th>
                            <th class="py-2.5" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase;">TERMIN & URAIAN PEKERJAAN</th>
                            <th class="py-2.5 text-center" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase;">SYARAT PROGRES</th>
                            <th class="py-2.5 text-end" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase;">NOMINAL TERMIN</th>
                            <th class="py-2.5 text-center" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase;">JATUH TEMPO</th>
                            <th class="py-2.5 text-center" style="color: #9a55ff; font-weight: 700; font-size: 0.78rem; text-transform: uppercase; width: 110px;">STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentTermins as $idx => $termin)
                            <tr>
                                <td class="px-3 text-center text-muted fw-bold">{{ $idx + 1 }}</td>
                                <td>
                                    <div class="fw-bold text-dark">
                                        <i class="mdi mdi-home-outline text-primary me-0.5"></i>{{ $termin->unit->unit_name ?? ($termin->unit->unit_code ?? 'Unit Kavling') }}
                                    </div>
                                    <small class="text-muted">{{ $termin->unit->landBank->name ?? '-' }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border px-2 py-0.5 fw-bold" style="font-size: 0.72rem;">
                                        Termin {{ $termin->termin_ke ?? '-' }} ({{ $termin->persentase_bayar ?? 0 }}%)
                                    </span>
                                    <span class="d-block text-dark mt-1">{{ Str::limit($termin->uraian_pekerjaan ?? ($termin->nama_termin ?? '-'), 35) }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="fw-bold text-dark">{{ $termin->syarat_progress_persen ?? 0 }}%</span>
                                    <small class="text-muted d-block" style="font-size: 0.7rem;">Minimal Capaian</small>
                                </td>
                                <td class="text-end">
                                    <span class="fw-bold text-dark fs-6">Rp {{ number_format($termin->nominal ?? 0, 0, ',', '.') }}</span>
                                </td>
                                <td class="text-center">
                                    <small class="text-muted">
                                        <i class="mdi mdi-calendar me-0.5"></i>{{ $termin->tanggal_jatuh_tempo ? \Carbon\Carbon::parse($termin->tanggal_jatuh_tempo)->format('d M Y') : '-' }}
                                    </small>
                                </td>
                                <td class="text-center">
                                    @php $ts = strtolower($termin->status ?? ''); @endphp
                                    @if($ts === 'lunas' || $ts === 'dibayar')
                                        <span class="badge bg-success text-white py-1 px-2.5" style="font-size: 0.74rem; border-radius: 4px;">
                                            <i class="mdi mdi-check-circle me-1"></i>Lunas
                                        </span>
                                    @elseif($ts === 'disetujui' || $ts === 'approved')
                                        <span class="badge bg-primary text-white py-1 px-2.5" style="font-size: 0.74rem; border-radius: 4px;">
                                            <i class="mdi mdi-check me-1"></i>Disetujui
                                        </span>
                                    @else
                                        <span class="badge bg-warning text-dark py-1 px-2.5" style="font-size: 0.74rem; border-radius: 4px;">
                                            <i class="mdi mdi-clock-alert-outline me-1"></i>Menunggu
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="mdi mdi-cash-check text-success me-1 fs-3 d-block mb-1 opacity-50"></i>
                                    Tidak ada antrean pembayaran termin kontraktor.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
