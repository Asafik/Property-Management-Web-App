@extends('layouts.partial.app')

@section('title', 'Dashboard Divisi Proyek - Property Management App')

@push('styles')
<style>
    .proyek-hero-card {
        background: linear-gradient(135deg, #1e1b4b 0%, #312e81 50%, #4338ca 100%);
        border-radius: 16px;
        color: #ffffff;
        position: relative;
        overflow: hidden;
    }
    .proyek-hero-card::after {
        content: '';
        position: absolute;
        right: -30px;
        bottom: -40px;
        width: 220px;
        height: 220px;
        background: radial-gradient(circle, rgba(165, 180, 252, 0.15) 0%, rgba(255, 255, 255, 0) 70%);
        border-radius: 50%;
        pointer-events: none;
    }
    .kpi-card {
        border-radius: 14px;
        background: #ffffff;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        border: 1px solid #f1f5f9;
    }
    .kpi-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.06), 0 8px 10px -6px rgba(0, 0, 0, 0.04) !important;
    }
    .badge-soft-success {
        background: #dcfce7;
        color: #15803d;
    }
    .badge-soft-warning {
        background: #fef3c7;
        color: #b45309;
    }
    .badge-soft-info {
        background: #e0f2fe;
        color: #0369a1;
    }
    .badge-soft-purple {
        background: #f3e8ff;
        color: #7e22ce;
    }
    .badge-soft-danger {
        background: #fee2e2;
        color: #b91c1c;
    }
    .progress-custom {
        height: 7px;
        border-radius: 10px;
        background-color: #f1f5f9;
        overflow: hidden;
    }
    .table-proyek-hover tbody tr:hover {
        background-color: #f8fafc;
    }
    .quick-action-btn {
        background: rgba(255, 255, 255, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.25);
        color: #ffffff;
        border-radius: 8px;
        font-size: 0.82rem;
        font-weight: 600;
        padding: 0.45rem 0.85rem;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .quick-action-btn:hover {
        background: #ffffff;
        color: #312e81;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-3 py-3">

    <!-- ========================================================================= -->
    <!-- 1. HERO HEADER BANNER -->
    <!-- ========================================================================= -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm proyek-hero-card p-4">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <span class="badge" style="background: rgba(255, 255, 255, 0.2); color: #ffffff; font-size: 0.75rem; letter-spacing: 0.5px; border-radius: 6px;">
                                <i class="mdi mdi-domain me-1"></i> DIVISI PROYEK & KONSTRUKSI
                            </span>
                            @if($isKepalaProyek)
                                <span class="badge" style="background: #fbbf24; color: #78350f; font-weight: 700; font-size: 0.75rem; border-radius: 6px;">
                                    <i class="mdi mdi-shield-crown me-0.5"></i> Kepala Proyek
                                </span>
                            @else
                                <span class="badge" style="background: #60a5fa; color: #1e3a8a; font-weight: 700; font-size: 0.75rem; border-radius: 6px;">
                                    <i class="mdi mdi-account-hard-hat me-0.5"></i> Staff Proyek
                                </span>
                            @endif
                        </div>
                        <h2 class="fw-bold mb-1 text-white" style="font-size: 1.55rem;">
                            Dashboard Operasional Kawasan & Pembangunan
                        </h2>
                        <p class="text-white-50 mb-0 small" style="max-width: 650px;">
                            Monitoring terpadu pematangan lahan, infrastruktur kawasan, pelaksanaan SPK kontraktor, dan opname fisik unit perumahan.
                        </p>
                    </div>

                    <!-- Quick Action Shortcuts -->
                    <div class="d-flex flex-wrap align-items-center gap-2">
                        <a href="{{ route('spk.create') }}" class="quick-action-btn">
                            <i class="mdi mdi-plus-circle-outline"></i> Buat SPK Baru
                        </a>
                        <a href="{{ route('proyek.pengolahan-lahan.index') }}" class="quick-action-btn">
                            <i class="mdi mdi-hard-hat"></i> Pengolahan Lahan
                        </a>
                        <a href="{{ route('proyek.unit.index') }}" class="quick-action-btn">
                            <i class="mdi mdi-home-city-outline"></i> Monitoring Unit
                        </a>
                        <a href="{{ route('proyek.index') }}" class="quick-action-btn">
                            <i class="mdi mdi-city-variant-outline"></i> Profil Kawasan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- 2. TOP 5 EXECUTIVE METRIC CARDS -->
    <!-- ========================================================================= -->
    <div class="row g-3 mb-4">
        <!-- Card 1: Total Proyek Kawasan -->
        <div class="col-12 col-sm-6 col-xl">
            <div class="card border-0 shadow-sm p-3 h-100 kpi-card" style="border-left: 4px solid #4f46e5 !important;">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <span class="text-muted small fw-semibold d-block">Proyek Kawasan</span>
                        <h3 class="fw-bold mb-1 mt-1" style="color: #4f46e5; font-size: 1.45rem;">
                            {{ $totalProjects }} <span class="fs-6 fw-normal text-muted">Kawasan</span>
                        </h3>
                        <small class="text-muted d-block" style="font-size: 0.76rem;">
                            <i class="mdi mdi-texture-box me-0.5 text-primary"></i> {{ number_format($totalArea, 0, ',', '.') }} m² Total Luas
                        </small>
                    </div>
                    <div class="rounded-circle p-2.5 d-flex align-items-center justify-content-center" style="background: rgba(79, 70, 229, 0.12); color: #4f46e5; width: 44px; height: 44px;">
                        <i class="mdi mdi-city-variant-outline fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 2: Pengolahan Lahan -->
        <div class="col-12 col-sm-6 col-xl">
            <div class="card border-0 shadow-sm p-3 h-100 kpi-card" style="border-left: 4px solid #059669 !important;">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <span class="text-muted small fw-semibold d-block">Infrastruktur Lahan</span>
                        <h3 class="fw-bold mb-1 mt-1" style="color: #059669; font-size: 1.45rem;">
                            {{ $avgInfraProgress }}%
                        </h3>
                        <small class="text-muted d-block" style="font-size: 0.76rem;">
                            <i class="mdi mdi-check-circle-outline me-0.5 text-success"></i> {{ $infraSelesai }}/{{ $totalInfrastruktur }} Item Selesai
                        </small>
                    </div>
                    <div class="rounded-circle p-2.5 d-flex align-items-center justify-content-center" style="background: rgba(5, 150, 105, 0.12); color: #059669; width: 44px; height: 44px;">
                        <i class="mdi mdi-hard-hat fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 3: Unit Kavling Proyek -->
        <div class="col-12 col-sm-6 col-xl">
            <div class="card border-0 shadow-sm p-3 h-100 kpi-card" style="border-left: 4px solid #0284c7 !important;">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <span class="text-muted small fw-semibold d-block">Unit Kavling</span>
                        <h3 class="fw-bold mb-1 mt-1" style="color: #0284c7; font-size: 1.45rem;">
                            {{ $totalUnits }} <span class="fs-6 fw-normal text-muted">Kavling</span>
                        </h3>
                        <small class="text-muted d-block" style="font-size: 0.76rem;">
                            <span class="text-success fw-bold">{{ $readyUnits }} Ready</span> | <span class="text-warning fw-bold">{{ $progressUnits }} Dibangun</span>
                        </small>
                    </div>
                    <div class="rounded-circle p-2.5 d-flex align-items-center justify-content-center" style="background: rgba(2, 132, 199, 0.12); color: #0284c7; width: 44px; height: 44px;">
                        <i class="mdi mdi-home-city-outline fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 4: SPK Kontraktor -->
        <div class="col-12 col-sm-6 col-xl">
            <div class="card border-0 shadow-sm p-3 h-100 kpi-card" style="border-left: 4px solid #d97706 !important;">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <span class="text-muted small fw-semibold d-block">SPK Kontraktor</span>
                        <h3 class="fw-bold mb-1 mt-1" style="color: #d97706; font-size: 1.45rem;">
                            {{ $spkBerjalan }} <span class="fs-6 fw-normal text-muted">Aktif</span>
                        </h3>
                        <small class="text-muted d-block" style="font-size: 0.76rem;">
                            <i class="mdi mdi-cash-multiple me-0.5 text-warning"></i> Rp {{ number_format($totalNilaiKontrak, 0, ',', '.') }}
                        </small>
                    </div>
                    <div class="rounded-circle p-2.5 d-flex align-items-center justify-content-center" style="background: rgba(217, 119, 6, 0.12); color: #d97706; width: 44px; height: 44px;">
                        <i class="mdi mdi-file-sign fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 5: Opname & Termin Menunggu -->
        <div class="col-12 col-sm-6 col-xl">
            <div class="card border-0 shadow-sm p-3 h-100 kpi-card" style="border-left: 4px solid #db2777 !important;">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <span class="text-muted small fw-semibold d-block">Pengajuan Pending</span>
                        <h3 class="fw-bold mb-1 mt-1" style="color: #db2777; font-size: 1.45rem;">
                            {{ $opnamePending + $totalTerminPending }} <span class="fs-6 fw-normal text-muted">Item</span>
                        </h3>
                        <small class="text-muted d-block" style="font-size: 0.76rem;">
                            {{ $opnamePending }} Opname | {{ $totalTerminPending }} Termin Tagihan
                        </small>
                    </div>
                    <div class="rounded-circle p-2.5 d-flex align-items-center justify-content-center" style="background: rgba(219, 39, 119, 0.12); color: #db2777; width: 44px; height: 44px;">
                        <i class="mdi mdi-clipboard-clock-outline fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- 3. SECTION: DAFTAR PROYEK KAWASAN & STATUS PENGOLAHAN LAHAN -->
    <!-- ========================================================================= -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-radius: 14px; background: #ffffff;">
                <div class="card-header bg-white py-3 px-4 border-bottom d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <div class="d-flex align-items-center gap-2.5">
                        <div class="rounded-circle p-2 d-flex align-items-center justify-content-center" style="background: rgba(79, 70, 229, 0.1); color: #4f46e5; width: 40px; height: 40px;">
                            <i class="mdi mdi-office-building fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-0" style="font-size: 1.05rem;">
                                Kawasan Proyek & Pengolahan Lahan
                            </h5>
                            <small class="text-muted" style="font-size: 0.8rem;">
                                Monitoring pematangan lahan dan progres fasilitas fisik kawasan proyek
                            </small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <a href="{{ route('proyek.index') }}" class="btn btn-sm btn-outline-primary d-inline-flex align-items-center gap-1 shadow-sm" style="border-radius: 6px; font-size: 0.82rem;">
                            <i class="mdi mdi-format-list-bulleted me-1"></i> Buka Master Proyek
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 table-proyek-hover" style="font-size: 0.86rem;">
                            <thead class="table-light">
                                <tr style="background: #f8fafc;">
                                    <th class="py-2.5 px-3 text-center" style="width: 50px; color: #475569; font-weight: 700;">No</th>
                                    <th class="py-2.5" style="color: #475569; font-weight: 700;">Nama Kawasan & Lokasi</th>
                                    <th class="py-2.5" style="color: #475569; font-weight: 700;">Luas & Pengembang</th>
                                    <th class="py-2.5" style="color: #475569; font-weight: 700; width: 220px;">Progres Infrastruktur Lahan</th>
                                    <th class="py-2.5 text-center" style="color: #475569; font-weight: 700;">Unit Kavling</th>
                                    <th class="py-2.5 text-center" style="color: #475569; font-weight: 700; width: 200px;">Aksi Cepat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($projectsList as $idx => $proj)
                                    <tr>
                                        <td class="px-3 text-center text-muted fw-semibold">{{ $idx + 1 }}</td>
                                        <td>
                                            <div class="fw-bold text-dark" style="font-size: 0.92rem;">
                                                <i class="mdi mdi-city-variant text-primary me-1"></i>{{ $proj->name }}
                                            </div>
                                            <small class="text-muted d-block mt-0.5">
                                                <i class="mdi mdi-map-marker-outline me-0.5"></i>{{ $proj->address ? Str::limit($proj->address, 45) : 'Alamat belum diatur' }}
                                            </small>
                                        </td>
                                        <td>
                                            <span class="badge py-1 px-2 mb-1" style="background: #f1f5f9; color: #334155; font-size: 0.74rem; font-weight: 600;">
                                                <i class="mdi mdi-domain me-1"></i>{{ $proj->company_name }}
                                            </span>
                                            <small class="text-muted d-block">
                                                <i class="mdi mdi-ruler-square me-0.5"></i>{{ number_format($proj->area, 0, ',', '.') }} m² | {{ $proj->legal_status }}
                                            </small>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <span class="small fw-semibold text-dark">{{ $proj->done_infra }}/{{ $proj->total_infra }} Item Selesai</span>
                                                <span class="badge {{ $proj->progress_infra >= 100 ? 'bg-success' : 'bg-primary' }} text-white" style="font-size: 0.72rem;">
                                                    {{ $proj->progress_infra }}%
                                                </span>
                                            </div>
                                            <div class="progress progress-custom">
                                                <div class="progress-bar {{ $proj->progress_infra >= 100 ? 'bg-success' : 'bg-gradient-primary' }}" 
                                                    role="progressbar" 
                                                    style="width: {{ $proj->progress_infra }}%;" 
                                                    aria-valuenow="{{ $proj->progress_infra }}" 
                                                    aria-valuemin="0" 
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="fw-bold text-dark fs-6">{{ $proj->total_units }}</div>
                                            <small class="text-muted" style="font-size: 0.72rem;">
                                                <span class="text-success fw-semibold">{{ $proj->ready_units }} Ready</span> &bull; 
                                                <span class="text-warning fw-semibold">{{ $proj->progress_units }} Proses</span>
                                            </small>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex align-items-center justify-content-center gap-1.5">
                                                <a href="{{ route('properti.pengolahanLahan', $proj->id) }}" class="btn btn-sm btn-outline-success py-1 px-2 shadow-sm" style="font-size: 0.76rem; border-radius: 6px;" title="Kelola Pengolahan Lahan">
                                                    <i class="mdi mdi-hard-hat me-0.5"></i>Lahan
                                                </a>
                                                <a href="{{ route('properti.buatKavling', $proj->id) }}" class="btn btn-sm btn-outline-primary py-1 px-2 shadow-sm" style="font-size: 0.76rem; border-radius: 6px;" title="Kelola Kavling & Unit">
                                                    <i class="mdi mdi-home-outline me-0.5"></i>Kavling
                                                </a>
                                                <a href="{{ route('properti.progress', $proj->id) }}" class="btn btn-sm btn-outline-warning py-1 px-2 shadow-sm" style="font-size: 0.76rem; border-radius: 6px;" title="Progres Pembangunan">
                                                    <i class="mdi mdi-progress-wrench me-0.5"></i>Progres
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-muted">
                                            <i class="mdi mdi-office-building-outline fs-3 d-block mb-1 opacity-50"></i>
                                            Belum ada kawasan proyek yang terdaftar.
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

    <!-- ========================================================================= -->
    <!-- 4. SECTION: DUA KOLOM (SPK KONTRAKTOR & OPNAME MINGGUAN) -->
    <!-- ========================================================================= -->
    <div class="row g-3 mb-4">
        <!-- Kolom Kiri: SPK Kontraktor Berjalan -->
        <div class="col-12 col-lg-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 14px; background: #ffffff;">
                <div class="card-header bg-white py-3 px-4 border-bottom d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <i class="mdi mdi-file-sign text-warning fs-4"></i>
                        <h5 class="fw-bold text-dark mb-0" style="font-size: 1rem;">
                            SPK Kontraktor Berjalan
                        </h5>
                    </div>
                    <a href="{{ route('spk.index') }}" class="small text-primary fw-bold text-decoration-none">
                        Lihat Semua SPK <i class="mdi mdi-chevron-right"></i>
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" style="font-size: 0.84rem;">
                            <thead class="table-light">
                                <tr style="background: #f8fafc;">
                                    <th class="py-2.5 px-3" style="color: #475569; font-weight: 700;">No & Kontraktor</th>
                                    <th class="py-2.5" style="color: #475569; font-weight: 700;">Pekerjaan</th>
                                    <th class="py-2.5 text-end" style="color: #475569; font-weight: 700;">Nilai Kontrak</th>
                                    <th class="py-2.5 text-center" style="color: #475569; font-weight: 700;">Fisik</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentSpks as $spk)
                                    <tr>
                                        <td class="px-3">
                                            <span class="fw-bold text-dark d-block" style="font-size: 0.85rem;">{{ $spk->no_spk ?? '-' }}</span>
                                            <small class="text-muted"><i class="mdi mdi-account-hard-hat me-0.5"></i>{{ $spk->kontraktor_nama ?? 'Kontraktor' }}</small>
                                        </td>
                                        <td>
                                            <span class="text-dark d-block fw-semibold">{{ Str::limit($spk->nama_pekerjaan ?? '-', 28) }}</span>
                                            <small class="text-muted"><i class="mdi mdi-map-marker me-0.5"></i>{{ $spk->landBank->name ?? '-' }}</small>
                                        </td>
                                        <td class="text-end">
                                            <span class="fw-bold text-dark d-block">Rp {{ number_format($spk->nilai_kontrak ?? 0, 0, ',', '.') }}</span>
                                            <span class="badge {{ strtolower($spk->status ?? '') === 'selesai' ? 'badge-soft-success' : 'badge-soft-warning' }}" style="font-size: 0.7rem; border-radius: 4px;">
                                                {{ ucfirst($spk->status ?? 'Proses') }}
                                            </span>
                                        </td>
                                        <td class="text-center" style="width: 75px;">
                                            <span class="fw-bold text-primary">{{ $spk->progress ?? 0 }}%</span>
                                            <div class="progress progress-custom mt-1">
                                                <div class="progress-bar bg-primary" style="width: {{ $spk->progress ?? 0 }}%;"></div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted">
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
        </div>

        <!-- Kolom Kanan: Opname Mingguan Lapangan -->
        <div class="col-12 col-lg-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 14px; background: #ffffff;">
                <div class="card-header bg-white py-3 px-4 border-bottom d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <i class="mdi mdi-clipboard-text-outline text-primary fs-4"></i>
                        <h5 class="fw-bold text-dark mb-0" style="font-size: 1rem;">
                            Opname Mingguan Lapangan
                        </h5>
                    </div>
                    <span class="badge bg-primary bg-opacity-10 text-primary px-2.5 py-1" style="font-size: 0.74rem; font-weight: 700;">
                        {{ $opnamePending }} Menunggu Review
                    </span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" style="font-size: 0.84rem;">
                            <thead class="table-light">
                                <tr style="background: #f8fafc;">
                                    <th class="py-2.5 px-3" style="color: #475569; font-weight: 700;">Minggu & No Opname</th>
                                    <th class="py-2.5" style="color: #475569; font-weight: 700;">Unit / Kawasan</th>
                                    <th class="py-2.5 text-center" style="color: #475569; font-weight: 700;">Progres Kumulatif</th>
                                    <th class="py-2.5 text-center" style="color: #475569; font-weight: 700;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentOpnames as $opname)
                                    <tr>
                                        <td class="px-3">
                                            <span class="badge bg-light text-dark border fw-bold me-1" style="font-size: 0.72rem;">
                                                M-{{ $opname->minggu_ke ?? '1' }}
                                            </span>
                                            <span class="fw-semibold text-dark">{{ $opname->no_opname ?? '-' }}</span>
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
                                                <span class="badge badge-soft-success py-1 px-2" style="font-size: 0.72rem; border-radius: 4px;">
                                                    <i class="mdi mdi-check-circle me-0.5"></i>Disetujui
                                                </span>
                                            @elseif($st === 'revisi')
                                                <span class="badge badge-soft-danger py-1 px-2" style="font-size: 0.72rem; border-radius: 4px;">
                                                    <i class="mdi mdi-alert-circle me-0.5"></i>Perlu Revisi
                                                </span>
                                            @else
                                                <span class="badge badge-soft-warning py-1 px-2" style="font-size: 0.72rem; border-radius: 4px;">
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
    </div>

    <!-- ========================================================================= -->
    <!-- 5. SECTION: JADWAL & STATUS PEMBAYARAN TERMIN KONTRAKTOR -->
    <!-- ========================================================================= -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-radius: 14px; background: #ffffff;">
                <div class="card-header bg-white py-3 px-4 border-bottom d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <div class="d-flex align-items-center gap-2.5">
                        <div class="rounded-circle p-2 d-flex align-items-center justify-content-center" style="background: rgba(16, 185, 129, 0.12); color: #10b981; width: 40px; height: 40px;">
                            <i class="mdi mdi-cash-register fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-0" style="font-size: 1.05rem;">
                                Pengajuan & Pembayaran Termin Kontraktor
                            </h5>
                            <small class="text-muted" style="font-size: 0.8rem;">
                                Monitoring tagihan pembayaran termin konstruksi berdasarkan syarat capaian fisik lapangan
                            </small>
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
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" style="font-size: 0.85rem;">
                            <thead class="table-light">
                                <tr style="background: #f8fafc;">
                                    <th class="py-2.5 px-3 text-center" style="width: 50px; color: #475569; font-weight: 700;">No</th>
                                    <th class="py-2.5" style="color: #475569; font-weight: 700;">Unit & Kawasan</th>
                                    <th class="py-2.5" style="color: #475569; font-weight: 700;">Termin & Uraian Pekerjaan</th>
                                    <th class="py-2.5 text-center" style="color: #475569; font-weight: 700;">Syarat Progres</th>
                                    <th class="py-2.5 text-end" style="color: #475569; font-weight: 700;">Nominal Termin</th>
                                    <th class="py-2.5 text-center" style="color: #475569; font-weight: 700;">Jatuh Tempo</th>
                                    <th class="py-2.5 text-center" style="color: #475569; font-weight: 700;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentTermins as $idx => $termin)
                                    <tr>
                                        <td class="px-3 text-center text-muted fw-semibold">{{ $idx + 1 }}</td>
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
                                                <span class="badge badge-soft-success py-1 px-2.5" style="font-size: 0.74rem; border-radius: 6px;">
                                                    <i class="mdi mdi-check-circle me-1"></i>Lunas
                                                </span>
                                            @elseif($ts === 'disetujui' || $ts === 'approved')
                                                <span class="badge badge-soft-info py-1 px-2.5" style="font-size: 0.74rem; border-radius: 6px;">
                                                    <i class="mdi mdi-check me-1"></i>Disetujui
                                                </span>
                                            @else
                                                <span class="badge badge-soft-warning py-1 px-2.5" style="font-size: 0.74rem; border-radius: 6px;">
                                                    <i class="mdi mdi-clock-alert-outline me-1"></i>Menunggu
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4 text-muted">
                                            <i class="mdi mdi-cash-check text-success me-1 fs-5"></i> Tidak ada antrean pembayaran termin kontraktor.
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
@endsection
