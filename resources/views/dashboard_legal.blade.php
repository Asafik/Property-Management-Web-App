@extends('layouts.partial.app')

@section('title', 'Dashboard - Property Management App')

@section('content')

<style>
    .header-card {
        background: #ffffff;
        border-radius: 8px !important;
        border: none !important;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04);
        margin-bottom: 0;
    }

    .badge-gradient-primary {
        background: linear-gradient(to right, #da8cff, #9a55ff) !important;
        color: #ffffff !important;
    }

    .badge-gradient-info {
        background: linear-gradient(135deg, #17a2b8, #00c0ef) !important;
        color: #ffffff !important;
    }

    .badge-gradient-success {
        background: linear-gradient(135deg, #28a745, #5cb85c) !important;
        color: #ffffff !important;
    }

    .btn-gradient-primary {
        background: linear-gradient(to right, #da8cff, #9a55ff) !important;
        color: #ffffff !important;
        border: none !important;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .btn-gradient-primary:hover {
        background: linear-gradient(to right, #cc70f9, #883cf2) !important;
        color: #ffffff !important;
    }

    /* Uniform Center Button Styling & Distinct Button Appearance */
    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        vertical-align: middle;
        font-weight: 600;
        border-radius: 6px;
        transition: all 0.2s ease;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .btn-outline-primary {
        color: #7c3aed !important;
        border: 1.5px solid #c4b5fd !important;
        background-color: #f5f3ff !important;
    }
    .btn-outline-primary:hover {
        background: linear-gradient(to right, #da8cff, #9a55ff) !important;
        color: #ffffff !important;
        border-color: #9a55ff !important;
        box-shadow: 0 2px 6px rgba(154, 85, 255, 0.25);
    }

    .btn-outline-secondary {
        color: #475569 !important;
        border: 1.5px solid #cbd5e1 !important;
        background-color: #f8fafc !important;
    }
    .btn-outline-secondary:hover {
        background-color: #e2e8f0 !important;
        color: #0f172a !important;
        border-color: #94a3b8 !important;
    }

    .btn-outline-warning {
        color: #b45309 !important;
        border: 1.5px solid #fde68a !important;
        background-color: #fffbeb !important;
    }
    .btn-outline-warning:hover {
        background-color: #f59e0b !important;
        color: #ffffff !important;
        border-color: #f59e0b !important;
    }

    .btn-outline-success {
        color: #15803d !important;
        border: 1.5px solid #bbf7d0 !important;
        background-color: #f0fdf4 !important;
    }
    .btn-outline-success:hover {
        background-color: #16a34a !important;
        color: #ffffff !important;
        border-color: #16a34a !important;
    }

    .btn-outline-danger {
        color: #dc2626 !important;
        border: 1.5px solid #fecaca !important;
        background-color: #fef2f2 !important;
    }
    .btn-outline-danger:hover {
        background-color: #dc2626 !important;
        color: #ffffff !important;
        border-color: #dc2626 !important;
    }

    /* Pipeline Step Filter Item */
    .pipeline-filter-card {
        background: #ffffff;
        border: 1px solid #ebedf2;
        border-radius: 8px;
        padding: 0.85rem 1rem;
        transition: all 0.2s ease;
        text-decoration: none !important;
        display: block;
        height: 100%;
    }

    .pipeline-filter-card:hover {
        border-color: #9a55ff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(154, 85, 255, 0.1);
    }

    .pipeline-filter-card.active {
        border-color: #9a55ff;
        background: #fbf9ff;
        box-shadow: 0 0 0 2px rgba(154, 85, 255, 0.2);
    }

    .pipeline-filter-title {
        font-size: 0.82rem;
        font-weight: 700;
        color: #2c2e3f;
        margin-bottom: 0.25rem;
    }

    .pipeline-filter-count {
        font-size: 1.35rem;
        font-weight: 800;
        line-height: 1.2;
    }

    /* Table styling uniform with dashboard.blade.php */
    .table-legal th {
        background-color: #f8f9fa !important;
        color: #3b3f5c !important;
        font-weight: 700 !important;
        font-size: 0.82rem !important;
        vertical-align: middle !important;
        padding: 10px 14px !important;
        border-bottom: 1.5px solid #ebedf2 !important;
    }

    .table-legal td {
        vertical-align: middle !important;
        padding: 10px 14px !important;
        font-size: 0.85rem !important;
        color: #3b3f5c !important;
        border-bottom: 1px solid #ebedf2 !important;
    }

    .table-legal tbody tr:hover td {
        background-color: #fcfaff !important;
    }

    .kpi-link-card {
        text-decoration: none !important;
        display: block;
        height: 100%;
    }

    .kpi-link-card:hover .card {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.07) !important;
    }

    /* Legal Modules Grid Card */
    .legal-module-card {
        background: #ffffff;
        border: 1px solid #ebedf2;
        border-radius: 8px;
        padding: 1.15rem;
        transition: all 0.25s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .legal-module-card:hover {
        transform: translateY(-2px);
        border-color: #9a55ff;
        box-shadow: 0 6px 16px rgba(154, 85, 255, 0.08);
    }

    .sop-item {
        background: #ffffff;
        border: 1px solid #eef0f4;
        border-radius: 8px;
        padding: 0.75rem 0.9rem;
        transition: all 0.2s ease;
    }

    .sop-item:hover {
        border-color: #9a55ff;
        background: #faf8ff;
    }

    /* Responsive adjustments */
    @media (max-width: 767.98px) {
        .header-card .card-body {
            padding: 1rem !important;
        }
        .table-responsive table {
            min-width: 800px;
        }
    }
</style>

<div class="container-fluid px-1 px-sm-2 px-md-3 py-2 py-md-3">

    <!-- Header Dashboard Card Banner -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 header-card">
                <div class="card-body p-3 p-md-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                    <div>
                        <h3 class="text-dark mb-1 fw-bold" style="font-size: 1.35rem;">
                            Dashboard
                        </h3>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">
                            @if($isStaffLegal)
                                Manajemen Pemberkasan, Checklist Kelengkapan Dokumen Legalitas, Input Prospek Baru & Pemetaan Kavling
                            @else
                                Monitoring Uji Kelayakan, Validasi Berkas Dokumen, dan Alur Pengadaan Tanah Pra & Pasca Land Bank
                            @endif
                        </p>
                    </div>
                    <div class="d-flex flex-wrap align-items-center gap-2">
                        <a href="{{ route('pra-landbank.proses') }}" class="btn btn-sm btn-gradient-primary d-inline-flex align-items-center justify-content-center gap-1 shadow-sm px-3 py-2 text-center">
                            + Input Pra Tanah
                        </a>
                        @if($isStaffLegal)
                            <a href="{{ route('kavling.index') }}" class="btn btn-sm btn-outline-primary d-inline-flex align-items-center justify-content-center gap-1 shadow-sm px-3 py-2 text-center">
                                Master Kavling
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ================= STATISTIC KPI CARDS (CLEAN WHITE CARD STYLE) ================= -->
    @if($isStaffLegal)
        <!-- KPI Cards Khusus Staff Legal (Fokus: Input & Pemberkasan) -->
        <div class="row g-2 g-md-3 mb-4">
            <!-- Card 1: Prospek Aktif Dikerjakan -->
            <div class="col-6 col-md-4 col-xl">
                <a href="{{ route('dashboard', ['status' => 'incomplete_doc']) }}#tabelPraTanah" class="kpi-link-card">
                    <div class="card shadow-sm border-0 h-100 mb-0">
                        <div class="card-body p-3">
                            <h4 class="text-dark mb-1 fw-bold fs-4">{{ $totalPraTanahStaffActive }}</h4>
                            <p class="text-muted mb-0 fw-semibold text-truncate small">Prospek Aktif (Fase 1-2)</p>
                            <small class="text-muted text-truncate d-block" style="font-size: 0.72rem;">{{ $totalPraTanahFase1 }} Fase 1 • {{ $totalPraTanahFase2 }} Fase 2</small>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Card 2: Lahan Perlu Kelengkapan Dokumen -->
            <div class="col-6 col-md-4 col-xl">
                <a href="#tugasStaffLegal" class="kpi-link-card">
                    <div class="card shadow-sm border-0 h-100 mb-0">
                        <div class="card-body p-3">
                            <h4 class="text-dark mb-1 fw-bold fs-4">{{ $incompleteLands->count() }}</h4>
                            <p class="text-muted mb-0 fw-semibold text-truncate small">Perlu Pemberkasan</p>
                            <small class="text-muted text-truncate d-block" style="font-size: 0.72rem;">
                                {{ $incompleteLands->count() > 0 ? 'Upload / lengkapi berkas' : 'Pemberkasan lengkap' }}
                            </small>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Card 3: Berkas Terunggah Menunggu Validasi Kepala -->
            <div class="col-6 col-md-4 col-xl">
                <a href="{{ route('dashboard', ['status' => 'pending_doc']) }}#tabelPraTanah" class="kpi-link-card">
                    <div class="card shadow-sm border-0 h-100 mb-0">
                        <div class="card-body p-3">
                            <h4 class="text-dark mb-1 fw-bold fs-4">{{ $totalPendingDocs }}</h4>
                            <p class="text-muted mb-0 fw-semibold text-truncate small">Menunggu Review</p>
                            <small class="text-muted text-truncate d-block" style="font-size: 0.72rem;">Berkas diajukan validasi</small>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Card 4: Dokumen Sah Terverifikasi -->
            <div class="col-6 col-md-6 col-xl">
                <a href="{{ route('dashboard', ['status' => 'approved']) }}#tabelPraTanah" class="kpi-link-card">
                    <div class="card shadow-sm border-0 h-100 mb-0">
                        <div class="card-body p-3">
                            <h4 class="text-dark mb-1 fw-bold fs-4">{{ $totalVerifiedDocs }}</h4>
                            <p class="text-muted mb-0 fw-semibold text-truncate small">Dokumen Sah</p>
                            <small class="text-muted text-truncate d-block" style="font-size: 0.72rem;">{{ $totalApprovedTanah }} Lahan Disetujui</small>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Card 5: Kavling & Titik Lokasi -->
            <div class="col-6 col-md-6 col-xl">
                <a href="{{ route('kavling.index') }}" class="kpi-link-card">
                    <div class="card shadow-sm border-0 h-100 mb-0">
                        <div class="card-body p-3">
                            <h4 class="text-dark mb-1 fw-bold fs-4">{{ $totalKavling }} Unit</h4>
                            <p class="text-muted mb-0 fw-semibold text-truncate small">Data Master Kavling</p>
                            <small class="text-muted text-truncate d-block" style="font-size: 0.72rem;">{{ $totalLokasi }} Titik Lokasi</small>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    @else
        <!-- KPI Cards Kepala Legal / Management (Fokus: Supervisi, Validasi & Aset) -->
        <div class="row g-2 g-md-3 mb-4">
            <!-- Card 1: Total Prospek Pra Tanah -->
            <div class="col-6 col-md-4 col-xl">
                <a href="{{ route('dashboard', ['status' => 'all']) }}#tabelPraTanah" class="kpi-link-card">
                    <div class="card shadow-sm border-0 h-100 mb-0">
                        <div class="card-body p-3">
                            <h4 class="text-dark mb-1 fw-bold fs-4">{{ $totalPraTanah }}</h4>
                            <p class="text-muted mb-0 fw-semibold text-truncate small">Total Pra Tanah</p>
                            <small class="text-muted text-truncate d-block" style="font-size: 0.72rem;">{{ $totalPraTanahFase1 }} F1 • {{ $totalPraTanahFase2 }} F2 • {{ $totalPraTanahFase3 }} F3</small>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Card 2: Butuh Validasi Legal -->
            <div class="col-6 col-md-4 col-xl">
                <a href="{{ route('dashboard', ['status' => 'pending_doc']) }}#tabelPraTanah" class="kpi-link-card">
                    <div class="card shadow-sm border-0 h-100 mb-0">
                        <div class="card-body p-3">
                            <h4 class="text-dark mb-1 fw-bold fs-4">{{ $totalPendingDocs }}</h4>
                            <p class="text-muted mb-0 fw-semibold text-truncate small">Butuh Validasi Legal</p>
                            <small class="text-muted text-truncate d-block" style="font-size: 0.72rem;">
                                {{ $totalPendingDocs > 0 ? 'Perlu tindakan review' : 'Semua berkas sah' }}
                            </small>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Card 3: Dokumen Sah / Verified -->
            <div class="col-6 col-md-4 col-xl">
                <a href="{{ route('dashboard', ['status' => 'approved']) }}#tabelPraTanah" class="kpi-link-card">
                    <div class="card shadow-sm border-0 h-100 mb-0">
                        <div class="card-body p-3">
                            <h4 class="text-dark mb-1 fw-bold fs-4">{{ $totalVerifiedDocs }}</h4>
                            <p class="text-muted mb-0 fw-semibold text-truncate small">Dokumen Sah</p>
                            <small class="text-muted text-truncate d-block" style="font-size: 0.72rem;">{{ $totalApprovedTanah }} Lahan Disetujui</small>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Card 4: Pasca Land Bank -->
            <div class="col-6 col-md-6 col-xl">
                <a href="{{ route('properti-all') }}" class="kpi-link-card">
                    <div class="card shadow-sm border-0 h-100 mb-0">
                        <div class="card-body p-3">
                            <h4 class="text-dark mb-1 fw-bold fs-4">{{ $totalPascaLandBank }}</h4>
                            <p class="text-muted mb-0 fw-semibold text-truncate small">Pasca Land Bank</p>
                            <small class="text-muted text-truncate d-block" style="font-size: 0.72rem;">Properti induk aktif</small>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Card 5: Total Luas Lahan Terkelola -->
            <div class="col-6 col-md-6 col-xl">
                <div class="card shadow-sm border-0 h-100 mb-0">
                    <div class="card-body p-3">
                        <h4 class="text-dark mb-1 fw-bold fs-4">{{ number_format($totalLuasLahan) }} m²</h4>
                        <p class="text-muted mb-0 fw-semibold text-truncate small">Total Luas Lahan</p>
                        <small class="text-muted text-truncate d-block" style="font-size: 0.72rem;">Pra & Pasca Land Bank</small>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- ================= RINGKASAN FITUR & MODUL OPERASIONAL ================= -->
    <div class="card shadow-sm border-0 mb-4" style="border-radius: 8px;">
        <div class="card-header bg-white py-3 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
            <div>
                <h5 class="card-title mb-0" style="font-weight: 700; color: #2c2e3f; font-size: 1rem;">
                    <i class="mdi mdi-view-dashboard-outline me-2" style="color: #9a55ff;"></i>
                    {{ $isStaffLegal ? 'Modul Operasional & Input Staff Legal' : 'Ringkasan Fitur & Modul Divisi Legal' }}
                </h5>
                <small class="text-muted">
                    {{ $isStaffLegal ? 'Akses langsung penginputan berkas, manajemen properti, kavling, dan lokasi' : 'Ringkasan status, metrik, dan akses langsung ke seluruh modul operasional divisi Legal' }}
                </small>
            </div>
            <span class="badge {{ $isStaffLegal ? 'badge-gradient-info' : 'badge-gradient-primary' }} px-2.5 py-1" style="font-size: 0.72rem;">5 Modul Operasional</span>
        </div>
        <div class="card-body p-3">
            <div class="row g-3">
                <!-- Modul 1: Pra Land Bank -->
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="legal-module-card">
                        <div>
                            <div class="d-flex align-items-center gap-3 mb-2.5">
                                <div class="legal-module-icon" style="background: #f5f3ff; color: #9a55ff;">
                                    <i class="mdi mdi-map-marker-path"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-0 text-dark" style="font-size: 0.92rem;">Semua Tanah Pra Land Bank</h6>
                                    <small class="text-muted" style="font-size: 0.75rem;">Prospek & Inisiasi Lahan</small>
                                </div>
                            </div>
                            <p class="text-muted mb-3" style="font-size: 0.8rem; line-height: 1.45;">
                                Pendaftaran calon lahan baru, pencatatan kontak makelar, uji kelayakan, dan penetapan status kelayakan pengadaan.
                            </p>
                            <div class="p-2 rounded bg-light border mb-3" style="font-size: 0.78rem;">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="text-muted">Total Prospek:</span>
                                    <strong class="text-dark">{{ $totalPraTanah }} Lahan</strong>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted">Status Alur:</span>
                                    <span class="text-primary fw-semibold">{{ $totalPraTanahFase1 }} F1 • {{ $totalPraTanahFase2 }} F2 • {{ $totalPraTanahFase3 }} F3</span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('pralandbank.all') }}" class="btn btn-sm btn-outline-primary d-inline-flex align-items-center justify-content-center text-center w-100 py-1.5" style="font-size: 0.78rem;">
                                Buka Master
                            </a>
                            <a href="{{ route('pra-landbank.proses') }}" class="btn btn-sm btn-gradient-primary text-white d-inline-flex align-items-center justify-content-center text-center py-1.5 px-3" title="Tambah Prospek Baru" style="font-size: 0.78rem; white-space: nowrap;">
                                + Tambah
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Modul 2: Uji Kelayakan & Dokumen Legalitas -->
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="legal-module-card">
                        <div>
                            <div class="mb-2.5">
                                <h6 class="fw-bold mb-0 text-dark" style="font-size: 0.92rem;">
                                    {{ $isStaffLegal ? 'Pemberkasan & Upload Dokumen' : 'Validasi Berkas & Legalitas' }}
                                </h6>
                                <small class="text-muted" style="font-size: 0.75rem;">Audit Sertifikat & Perizinan</small>
                            </div>
                            <p class="text-muted mb-3" style="font-size: 0.8rem; line-height: 1.45;">
                                Pemeriksaan keabsahan sertifikat (SHM/HGB), surat waris/kematian, PBB, IMB, dan uji status bebas sengketa.
                            </p>
                            <div class="p-2 rounded bg-light border mb-3" style="font-size: 0.78rem;">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="text-muted">{{ $isStaffLegal ? 'Berkas Menunggu Review:' : 'Dokumen Pending:' }}</span>
                                    <strong class="text-danger">{{ $totalPendingDocs }} Dokumen</strong>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted">Dokumen Sah:</span>
                                    <span class="text-success fw-semibold">{{ $totalVerifiedDocs }} Berkas Sah</span>
                                </div>
                            </div>
                        </div>
                        <div>
                            @if($isStaffLegal)
                                <a href="#tugasStaffLegal" class="btn btn-sm btn-outline-warning text-dark d-inline-flex align-items-center justify-content-center text-center w-100 py-1.5" style="font-size: 0.78rem;">
                                    Buka Checklist Pemberkasan
                                </a>
                            @else
                                <a href="{{ route('dashboard', ['status' => 'pending_doc']) }}#tabelPraTanah" class="btn btn-sm btn-outline-danger d-inline-flex align-items-center justify-content-center text-center w-100 py-1.5" style="font-size: 0.78rem;">
                                    Periksa Berkas Pending
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Modul 3: Semua Tanah Pasca Land Bank -->
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="legal-module-card">
                        <div>
                            <div class="mb-2.5">
                                <h6 class="fw-bold mb-0 text-dark" style="font-size: 0.92rem;">Semua Tanah Pasca Land Bank</h6>
                                <small class="text-muted" style="font-size: 0.75rem;">Aset Tanah Induk Perusahaan</small>
                            </div>
                            <p class="text-muted mb-3" style="font-size: 0.8rem; line-height: 1.45;">
                                Portofolio tanah induk yang telah sah dibeli/diakuisisi perusahaan, siap untuk site development dan pemecahan unit.
                            </p>
                            <div class="p-2 rounded bg-light border mb-3" style="font-size: 0.78rem;">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="text-muted">Total Tanah Induk:</span>
                                    <strong class="text-primary">{{ $totalPascaLandBank }} Properti</strong>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted">Luas Aset Pasca:</span>
                                    <span class="text-dark fw-semibold">{{ number_format($totalLuasPasca) }} m²</span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <a href="{{ route('properti-all') }}" class="btn btn-sm btn-outline-primary d-inline-flex align-items-center justify-content-center text-center w-100 py-1.5" style="font-size: 0.78rem;">
                                Kelola Pasca Land Bank
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Modul 4: Tambah & Master Kavling -->
                <div class="col-12 col-md-6 col-xl-6">
                    <div class="legal-module-card">
                        <div>
                            <div class="mb-2.5">
                                <h6 class="fw-bold mb-0 text-dark" style="font-size: 0.92rem;">Tambah & Master Kavling</h6>
                                <small class="text-muted" style="font-size: 0.75rem;">Pecah Sertifikat & Unit Properti</small>
                            </div>
                            <p class="text-muted mb-3" style="font-size: 0.8rem; line-height: 1.45;">
                                Pemecahan sertifikat tanah induk menjadi kavling-kavling unit siap bangun/jual, status legalitas kavling, dan template data unit.
                            </p>
                            <div class="p-2 rounded bg-light border mb-3" style="font-size: 0.78rem;">
                                <div class="row g-2 text-center">
                                    <div class="col-4">
                                        <span class="text-muted d-block" style="font-size: 0.72rem;">Total Unit</span>
                                        <strong class="text-dark">{{ $totalKavling }}</strong>
                                    </div>
                                    <div class="col-4">
                                        <span class="text-muted d-block" style="font-size: 0.72rem;">Tersedia</span>
                                        <strong class="text-success">{{ $totalKavlingAvailable }}</strong>
                                    </div>
                                    <div class="col-4">
                                        <span class="text-muted d-block" style="font-size: 0.72rem;">Terjual/Booked</span>
                                        <strong class="text-primary">{{ $totalKavlingSold }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <a href="{{ route('kavling.index') }}" class="btn btn-sm btn-outline-success d-inline-flex align-items-center justify-content-center text-center w-100 py-1.5" style="font-size: 0.78rem;">
                                Buka Manajemen Kavling
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Modul 5: Lokasi & Pemetaan Wilayah -->
                <div class="col-12 col-md-6 col-xl-6">
                    <div class="legal-module-card">
                        <div>
                            <div class="mb-2.5">
                                <h6 class="fw-bold mb-0 text-dark" style="font-size: 0.92rem;">Master Lokasi & Peta Wilayah</h6>
                                <small class="text-muted" style="font-size: 0.75rem;">Geografis & Zonasi Tata Ruang</small>
                            </div>
                            <p class="text-muted mb-3" style="font-size: 0.8rem; line-height: 1.45;">
                                Pemetaan koordinat latitude/longitude, persebaran properti proyek di peta digital, serta analisis peruntukan tata ruang.
                            </p>
                            <div class="p-2 rounded bg-light border mb-3" style="font-size: 0.78rem;">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="text-muted">Total Lokasi Properti:</span>
                                    <strong class="text-dark">{{ $totalLokasi }} Titik Koordinat</strong>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted">Kepatuhan Zonasi:</span>
                                    <span class="text-success fw-semibold">Terverifikasi</span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <a href="{{ route('lokasi.index') }}" class="btn btn-sm btn-outline-warning text-dark d-inline-flex align-items-center justify-content-center text-center w-100 py-1.5" style="font-size: 0.78rem;">
                                Buka Peta & Data Lokasi
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pipeline Fase Filter Bar (Interactive) -->
    <div class="card shadow-sm border-0 mb-4" style="border-radius: 8px;">
        <div class="card-body p-3">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center gap-2">
                    <i class="mdi mdi-sitemap" style="color: #9a55ff; font-size: 1.2rem;"></i>
                    <span class="fw-bold text-dark" style="font-size: 0.95rem;">Filter Berdasarkan Alur Fase Lahan</span>
                </div>
                <a href="{{ route('dashboard') }}#tabelPraTanah" class="btn btn-sm {{ !request('status') || request('status') === 'all' ? 'btn-gradient-primary' : 'btn-outline-secondary' }} px-3 py-1" style="font-size: 0.78rem;">
                    Tampilkan Semua ({{ $totalPraTanah }})
                </a>
            </div>

            <div class="row g-2">
                <!-- Fase 1 -->
                <div class="col-6 col-md-3">
                    <a href="{{ route('dashboard', ['status' => 'fase1']) }}#tabelPraTanah" class="pipeline-filter-card {{ request('status') === 'fase1' ? 'active' : '' }}">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="badge bg-warning text-dark px-2 py-0.5 mb-1" style="font-size: 0.68rem; font-weight: 700;">FASE 1</span>
                                <div class="pipeline-filter-title">{{ $isStaffLegal ? 'Input & Penawaran' : 'Penawaran & Makelar' }}</div>
                            </div>
                            <div class="pipeline-filter-count text-dark">{{ $totalPraTanahFase1 }}</div>
                        </div>
                    </a>
                </div>

                <!-- Fase 2 -->
                <div class="col-6 col-md-3">
                    <a href="{{ route('dashboard', ['status' => 'fase2']) }}#tabelPraTanah" class="pipeline-filter-card {{ request('status') === 'fase2' ? 'active' : '' }}">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="badge bg-primary text-white px-2 py-0.5 mb-1" style="font-size: 0.68rem; font-weight: 700;">FASE 2</span>
                                <div class="pipeline-filter-title">{{ $isStaffLegal ? 'Pemberkasan & Berkas' : 'Uji Kelayakan & Legalitas' }}</div>
                            </div>
                            <div class="pipeline-filter-count text-primary">{{ $totalPraTanahFase2 }}</div>
                        </div>
                    </a>
                </div>

                <!-- Fase 3 -->
                <div class="col-6 col-md-3">
                    <a href="{{ route('dashboard', ['status' => 'fase3']) }}#tabelPraTanah" class="pipeline-filter-card {{ request('status') === 'fase3' ? 'active' : '' }}">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="badge text-white px-2 py-0.5 mb-1" style="font-size: 0.68rem; font-weight: 700; background-color: #9a55ff;">FASE 3</span>
                                <div class="pipeline-filter-title">Sidang & Keputusan</div>
                            </div>
                            <div class="pipeline-filter-count" style="color: #9a55ff;">{{ $totalPraTanahFase3 }}</div>
                        </div>
                    </a>
                </div>

                <!-- Selesai / Approved -->
                <div class="col-6 col-md-3">
                    <a href="{{ route('dashboard', ['status' => 'approved']) }}#tabelPraTanah" class="pipeline-filter-card {{ request('status') === 'approved' ? 'active' : '' }}">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="badge bg-success text-white px-2 py-0.5 mb-1" style="font-size: 0.68rem; font-weight: 700;">FINAL</span>
                                <div class="pipeline-filter-title">Disetujui / Sah</div>
                            </div>
                            <div class="pipeline-filter-count text-success">{{ $totalApprovedTanah }}</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- ================= SECTION TUGAS OPERASIONAL ATAU ANTREAN APPROVAL ================= -->
    @if($isStaffLegal)
        <!-- Section Khusus Staff Legal: Checklist Tugas Pemberkasan & SOP -->
        <div class="row g-3 mb-4" id="tugasStaffLegal" style="scroll-margin-top: 80px;">
            <!-- Daftar Lahan Butuh Tindak Lanjut Pemberkasan -->
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 h-100" style="border-radius: 8px;">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title mb-0" style="font-weight: 700; color: #2c2e3f; font-size: 0.95rem;">
                                Checklist & Tugas Pemberkasan Dokumen (Staff Legal)
                            </h5>
                            <small class="text-muted">Daftar prospek lahan yang memerlukan kelengkapan dokumen dan unggah berkas legalitas</small>
                        </div>
                        <span class="badge bg-warning text-dark px-2.5 py-1" style="font-size: 0.72rem;">
                            {{ $incompleteLands->count() }} Lahan Aktif
                        </span>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-legal align-middle mb-0" style="min-width: 700px;">
                                <thead>
                                    <tr>
                                        <th style="width: 40px;">#</th>
                                        <th>Prospek Lahan & Pemilik</th>
                                        <th>Status Pemberkasan</th>
                                        <th>Fase</th>
                                        <th class="text-center">Aksi Tindak Lanjut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($incompleteLands as $index => $land)
                                        @php
                                            $docs = $land->documents;
                                            $uploadedCount = $docs->whereNotNull('file_path')->count();
                                            $pendingCount = $docs->where('status', 'pending')->whereNotNull('file_path')->count();
                                            $verifiedCount = $docs->where('status', 'verified')->count();
                                        @endphp
                                        <tr>
                                            <td class="text-muted fw-bold">{{ $index + 1 }}</td>
                                            <td>
                                                <div class="fw-bold text-dark">{{ $land->land_name }}</div>
                                                <small class="text-muted" style="font-size: 0.75rem;">
                                                    {{ $land->certificate_owner ?? ($land->owner_name ?? '-') }}
                                                    @if($land->area)
                                                        • <span class="fw-semibold">{{ number_format($land->area) }} m²</span>
                                                    @endif
                                                </small>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column gap-1">
                                                    @if($uploadedCount === 0)
                                                        <span class="badge bg-light text-danger border border-danger px-2 py-1" style="font-size: 0.72rem; width: fit-content;">
                                                            Belum Ada Berkas Diunggah
                                                        </span>
                                                    @else
                                                        <div class="d-flex align-items-center gap-1.5 flex-wrap">
                                                            @if($pendingCount > 0)
                                                                <span class="badge bg-warning text-dark px-2 py-0.5" style="font-size: 0.7rem;">
                                                                    {{ $pendingCount }} Menunggu Review Kepala
                                                                </span>
                                                            @endif
                                                            @if($verifiedCount > 0)
                                                                <span class="badge bg-success text-white px-2 py-0.5" style="font-size: 0.7rem;">
                                                                    {{ $verifiedCount }} Berkas Sah
                                                                </span>
                                                            @endif
                                                        </div>
                                                    @endif
                                                    <small class="text-muted" style="font-size: 0.72rem;">
                                                        Jenis Sertifikat: <strong class="text-dark">{{ $land->ownership_status ?? 'SHM' }}</strong>
                                                    </small>
                                                </div>
                                            </td>
                                            <td>
                                                @if($land->status == 'fase1')
                                                    <span class="badge bg-warning text-dark px-2 py-1" style="font-size: 0.72rem;">Fase 1 (Draft/Penawaran)</span>
                                                @elseif($land->status == 'fase2')
                                                    <span class="badge bg-primary text-white px-2 py-1" style="font-size: 0.72rem;">Fase 2 (Pemberkasan)</span>
                                                @else
                                                    <span class="badge bg-secondary text-white px-2 py-1" style="font-size: 0.72rem;">{{ ucfirst($land->status) }}</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('pra-landbank.proses', $land->id) }}?step=2" class="btn btn-sm btn-gradient-primary d-inline-flex align-items-center justify-content-center text-center px-3 py-1.5 fw-semibold shadow-sm" style="font-size: 0.78rem; white-space: nowrap;">
                                                    Upload / Lengkapi Berkas
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-4 text-muted">
                                                <p class="mb-0 fw-semibold" style="font-size: 0.85rem;">Seluruh berkas calon lahan aktif telah lengkap dan tersubmit!</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Panduan SOP Pemberkasan Legalitas -->
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 h-100" style="border-radius: 8px;">
                    <div class="card-header bg-white py-3">
                        <h5 class="card-title mb-0" style="font-weight: 700; color: #2c2e3f; font-size: 0.95rem;">
                            <i class="mdi mdi-clipboard-text-outline me-2 text-primary"></i>Checklist Dokumen Wajib Staff
                        </h5>
                    </div>
                    <div class="card-body p-3">
                        <p class="text-muted mb-3" style="font-size: 0.8rem; line-height: 1.45;">
                            Pastikan berkas-berkas berikut telah diunggah dan terverifikasi sebelum diajukan ke sidang keputusan Kepala Legal:
                        </p>
                        <div class="d-flex flex-column gap-2 mb-3">
                            @forelse($documentTypes as $index => $docType)
                                @php
                                    $lowName = strtolower($docType->name . ' ' . $docType->code);
                                    $docStyle = ['icon' => 'mdi-file-document-outline', 'color' => '#9a55ff', 'bg' => '#f5f3ff'];
                                    if (str_contains($lowName, 'sertifikat') || str_contains($lowName, 'shm') || str_contains($lowName, 'hgb')) {
                                        $docStyle = ['icon' => 'mdi-file-certificate', 'color' => '#10b981', 'bg' => '#ecfdf5'];
                                    } elseif (str_contains($lowName, 'akta') || str_contains($lowName, 'ajb')) {
                                        $docStyle = ['icon' => 'mdi-file-sign', 'color' => '#3b82f6', 'bg' => '#eff6ff'];
                                    } elseif (str_contains($lowName, 'imb') || str_contains($lowName, 'pbg')) {
                                        $docStyle = ['icon' => 'mdi-home-city-outline', 'color' => '#f59e0b', 'bg' => '#fffbeb'];
                                    } elseif (str_contains($lowName, 'pbb') || str_contains($lowName, 'pajak')) {
                                        $docStyle = ['icon' => 'mdi-receipt-text-outline', 'color' => '#8b5cf6', 'bg' => '#fbf7ff'];
                                    }
                                @endphp
                                <div class="sop-item d-flex align-items-center gap-2">
                                    <div class="rounded-2 d-flex align-items-center justify-content-center" style="width: 34px; height: 34px; background: {{ $docStyle['bg'] }}; color: {{ $docStyle['color'] }}; flex-shrink: 0;">
                                        <i class="mdi {{ $docStyle['icon'] }}" style="font-size: 1.15rem;"></i>
                                    </div>
                                    <div style="font-size: 0.8rem;" class="flex-grow-1">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <strong class="text-dark d-block">{{ $index + 1 }}. {{ $docType->name }}</strong>
                                            <span class="badge bg-light text-primary border" style="font-size: 9px; font-family: monospace;">{{ $docType->code }}</span>
                                        </div>
                                        <small class="text-muted">Wajib diunggah & diverifikasi pada Fase 2</small>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-3 text-muted">
                                    <small>Belum ada master tipe dokumen di database</small>
                                </div>
                            @endforelse
                        </div>

                        <div class="pt-2 border-top">
                            <a href="{{ route('pra-landbank.proses') }}" class="btn btn-sm btn-outline-primary d-inline-flex align-items-center justify-content-center text-center w-100 py-1.5" style="font-size: 0.8rem;">
                                Mulai Input Prospek Baru
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Section Khusus Kepala Legal: Antrean Validasi Berkas & Rekap Legalitas -->
        <div class="row g-3 mb-4">
            <!-- Antrean Dokumen Pending (Grouped per Tanah) -->
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 h-100" style="border-radius: 8px;">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0" style="font-weight: 700; color: #2c2e3f; font-size: 0.95rem;">
                            Antrean Validasi Berkas Legalitas (Kepala Legal)
                        </h5>
                        <span class="badge bg-danger text-white px-2 py-1" style="font-size: 0.72rem;">
                            {{ $totalPendingDocs }} Dokumen Menunggu
                        </span>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-legal align-middle mb-0" style="min-width: 700px;">
                                <thead>
                                    <tr>
                                        <th style="width: 40px;">#</th>
                                        <th>Nama Prospek Lahan</th>
                                        <th>Daftar Berkas / Surat Tanah</th>
                                        <th>Status Berkas</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pendingLandbanks as $index => $land)
                                        @php
                                            $pendingDocs = $land->documents->where('status', 'pending');
                                            $verifiedDocs = $land->documents->where('status', 'verified');
                                        @endphp
                                        <tr>
                                            <td class="text-muted fw-bold">{{ $index + 1 }}</td>
                                            <td>
                                                <div class="fw-bold text-dark">{{ $land->land_name }}</div>
                                                <small class="text-muted" style="font-size: 0.75rem;">
                                                    Pemilik: {{ $land->certificate_owner ?? ($land->owner_name ?? '-') }}
                                                </small>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column gap-1">
                                                    @foreach($land->documents as $doc)
                                                        @if($doc->status == 'pending')
                                                            <div class="d-inline-flex align-items-center gap-1.5 p-1 px-2 rounded border" style="background-color: #fffbeb; border-color: #fef08a !important; font-size: 0.78rem;">
                                                                <span class="fw-semibold text-dark">{{ $doc->documentType->name ?? 'Dokumen' }}</span>:
                                                                <span class="font-monospace text-muted">{{ $doc->document_number ?: '-' }}</span>
                                                                <span class="badge bg-warning text-dark ms-auto" style="font-size: 0.65rem; padding: 2px 5px;">Pending</span>
                                                            </div>
                                                        @elseif($doc->status == 'verified')
                                                            <div class="d-inline-flex align-items-center gap-1.5 p-1 px-2 rounded border" style="background-color: #f0fdf4; border-color: #dcfce7 !important; font-size: 0.78rem;">
                                                                <span class="fw-semibold text-dark">{{ $doc->documentType->name ?? 'Dokumen' }}</span>:
                                                                <span class="font-monospace text-muted">{{ $doc->document_number ?: '-' }}</span>
                                                                <span class="badge bg-success text-white ms-auto" style="font-size: 0.65rem; padding: 2px 5px;">Sah</span>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column gap-1">
                                                    <span class="badge bg-danger text-white px-2 py-1" style="font-size: 0.72rem;">
                                                        {{ $pendingDocs->count() }} Surat Pending
                                                    </span>
                                                    @if($verifiedDocs->count() > 0)
                                                        <span class="badge bg-success text-white px-2 py-1" style="font-size: 0.72rem;">
                                                            {{ $verifiedDocs->count() }} Sah Terverifikasi
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('pra-landbank.proses', $land->id) }}?step=2" class="btn btn-sm btn-outline-primary d-inline-flex align-items-center justify-content-center text-center px-3 py-1.5 fw-semibold" style="font-size: 0.78rem; white-space: nowrap;">
                                                    Validasi ({{ $pendingDocs->count() }} Berkas)
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-4 text-muted">
                                                <p class="mb-0 fw-semibold" style="font-size: 0.85rem;">Tidak ada dokumen pending. Seluruh berkas telah diverifikasi sah!</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rekapitulasi Aspek Hukum & Sertifikat -->
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 h-100" style="border-radius: 8px;">
                    <div class="card-header bg-white py-3">
                        <h5 class="card-title mb-0" style="font-weight: 700; color: #2c2e3f; font-size: 0.95rem;">
                            Rekapitulasi Legalitas Tanah
                        </h5>
                    </div>
                    <div class="card-body p-3">
                        <!-- Status Sengketa -->
                        <div class="mb-3">
                            <label class="form-label text-muted fw-bold mb-2" style="font-size: 0.75rem; text-transform: uppercase;">
                                Kejelasan Bebas Sengketa
                            </label>
                            <div class="d-flex flex-column gap-2">
                                <div class="d-flex justify-content-between align-items-center p-2 rounded bg-light border">
                                    <span class="text-success fw-semibold" style="font-size: 0.82rem;">
                                        Clear & Clean
                                    </span>
                                    <strong class="text-success">{{ $legalStatusCounts['clear'] ?? 0 }}</strong>
                                </div>
                                <div class="d-flex justify-content-between align-items-center p-2 rounded bg-light border">
                                    <span class="text-warning fw-semibold" style="font-size: 0.82rem;">
                                        Pengecekan BPN/Notaris
                                    </span>
                                    <strong class="text-dark">{{ $legalStatusCounts['checking'] ?? 0 }}</strong>
                                </div>
                                <div class="d-flex justify-content-between align-items-center p-2 rounded bg-light border">
                                    <span class="text-danger fw-semibold" style="font-size: 0.82rem;">
                                        Sengketa / Masalah
                                    </span>
                                    <strong class="text-danger">{{ $legalStatusCounts['problem'] ?? 0 }}</strong>
                                </div>
                            </div>
                        </div>

                        <!-- Jenis Sertifikat -->
                        <div class="pt-2 border-top">
                            <label class="form-label text-muted fw-bold mb-2" style="font-size: 0.75rem; text-transform: uppercase;">
                                Jenis Sertifikat Kepemilikan
                            </label>
                            <div class="row g-2 text-center">
                                @foreach($ownershipCounts as $type => $count)
                                    <div class="col-4">
                                        <div class="p-2 rounded border bg-light">
                                            <div class="text-muted" style="font-size: 0.75rem; font-weight: 600;">{{ $type }}</div>
                                            <div class="fw-bold text-dark" style="font-size: 0.95rem;">{{ $count }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Data Table Prospek Pra Land Bank -->
    <div class="card shadow-sm border-0" id="tabelPraTanah" style="border-radius: 8px; scroll-margin-top: 80px;">
        <div class="card-header bg-white py-3 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h5 class="card-title mb-0" style="font-weight: 700; color: #2c2e3f; font-size: 1rem;">
                    Data Prospek Pra Land Bank
                </h5>
            </div>
            <div class="d-flex flex-wrap align-items-center gap-2">
                <form action="{{ route('dashboard') }}#tabelPraTanah" method="GET" class="d-flex gap-2 m-0">
                    @if(request('status'))
                        <input type="hidden" name="status" value="{{ request('status') }}">
                    @endif
                    <div class="input-group input-group-sm" style="width: 220px;">
                        <input type="text" name="search" class="form-control" placeholder="Cari lahan / pemilik..." value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary d-inline-flex align-items-center justify-content-center" type="submit">
                            <i class="mdi mdi-magnify"></i>
                        </button>
                    </div>
                </form>
                <a href="{{ route('pralandbank.all') }}" class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center justify-content-center text-center px-3 py-1.5" style="font-size: 0.78rem;">
                    Buka Master Pra Tanah
                </a>
            </div>
        </div>

        <div class="card-body p-0">
            @if(request('status') && request('status') !== 'all')
                <div class="p-3 pb-0">
                    <div class="alert alert-light border d-flex align-items-center justify-content-between py-2 px-3 mb-2" style="background: #faf7ff; border-color: #eadcff !important; border-radius: 6px;">
                        <div class="d-flex align-items-center gap-2">
                            <span style="font-size: 0.84rem; color: #2c2e3f;">
                                Filter Aktif: Menampilkan data 
                                <strong>
                                    @if(request('status') == 'fase1') Fase 1 (Penawaran & Makelar)
                                    @elseif(request('status') == 'fase2') Fase 2 (Uji Kelayakan & Dokumen Legalitas)
                                    @elseif(request('status') == 'fase3') Fase 3 (Sidang Keputusan Direksi)
                                    @elseif(request('status') == 'approved') Final (Lahan Sah Disetujui)
                                    @elseif(request('status') == 'rejected') Ditolak
                                    @elseif(request('status') == 'pending_doc') Dokumen Menunggu Validasi Legal
                                    @elseif(request('status') == 'incomplete_doc') Prospek Aktif / Belum Selesai (Fase 1 & 2)
                                    @else {{ ucfirst(request('status')) }}
                                    @endif
                                </strong>
                                ({{ $praLandbanks->total() }} Lahan ditemukan)
                            </span>
                        </div>
                        <a href="{{ route('dashboard') }}#tabelPraTanah" class="btn btn-sm btn-outline-danger d-inline-flex align-items-center justify-content-center py-0.5 px-2" style="font-size: 0.74rem;">
                            Reset Filter
                        </a>
                    </div>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-legal align-middle mb-0" style="min-width: 850px;">
                    <thead>
                        <tr>
                            <th style="width: 45px;">#</th>
                            <th>Nama Prospek Lahan</th>
                            <th>Pemilik Sah / Makelar</th>
                            <th>Sertifikat</th>
                            <th>Luas (m²)</th>
                            <th>Status Hukum</th>
                            <th>Status Dokumen</th>
                            <th>Fase Alur</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($praLandbanks as $index => $item)
                            @php
                                $docs = $item->documents;
                                $totalUploaded = $docs->whereNotNull('file_path')->count();
                                $verified = $docs->where('status', 'verified')->count();
                                $pending = $docs->where('status', 'pending')->whereNotNull('file_path')->count();
                                $isAllVerified = ($totalUploaded > 0 && $verified === $totalUploaded);
                            @endphp
                            <tr>
                                <td class="text-muted fw-bold">
                                    {{ $praLandbanks->firstItem() + $index }}
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $item->land_name }}</div>
                                    <small class="text-muted" style="font-size: 0.75rem;">
                                        {{ Str::limit($item->address ?? 'Alamat belum diatur', 35) }}
                                    </small>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark">{{ $item->certificate_owner ?? ($item->owner_name ?? '-') }}</div>
                                    <small class="text-muted" style="font-size: 0.75rem;">
                                        Makelar: {{ $item->land_owner ?? '-' }}
                                    </small>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border px-2 py-1 fw-bold" style="font-size: 0.75rem;">
                                        {{ $item->ownership_status ?? 'SHM' }}
                                    </span>
                                    @if($docs->count() > 0)
                                        <div class="d-flex flex-wrap gap-1 mt-1">
                                            @foreach($docs->take(3) as $doc)
                                                <span class="badge bg-light text-secondary border" style="font-size: 0.65rem; padding: 2px 5px;">
                                                    {{ $doc->documentType->name ?? 'Dokumen' }}
                                                </span>
                                            @endforeach
                                            @if($docs->count() > 3)
                                                <span class="badge bg-light text-muted border" style="font-size: 0.65rem; padding: 2px 4px;">+{{ $docs->count() - 3 }}</span>
                                            @endif
                                        </div>
                                    @endif
                                </td>
                                <td class="fw-semibold text-dark">
                                    {{ number_format($item->area ?? 0) }} m²
                                </td>
                                <td>
                                    @if($item->legal_status == 'clear')
                                        <span class="badge bg-success text-white px-2 py-1" style="font-size: 0.72rem;">
                                            Clear & Clean
                                        </span>
                                    @elseif($item->legal_status == 'checking')
                                        <span class="badge bg-warning text-dark px-2 py-1" style="font-size: 0.72rem;">
                                            Pengecekan BPN
                                        </span>
                                    @elseif($item->legal_status == 'problem')
                                        <span class="badge bg-danger text-white px-2 py-1" style="font-size: 0.72rem;">
                                            Sengketa
                                        </span>
                                    @else
                                        <span class="badge bg-secondary text-white px-2 py-1" style="font-size: 0.72rem;">Belum Diisi</span>
                                    @endif
                                </td>
                                <td>
                                    @if($totalUploaded == 0)
                                        <span class="badge bg-light text-danger border border-danger px-2 py-1" style="font-size: 0.72rem;">
                                            Belum Ada File
                                        </span>
                                    @elseif($isAllVerified)
                                        <span class="badge bg-success text-white px-2 py-1" style="font-size: 0.72rem;">
                                            {{ $verified }}/{{ $totalUploaded }} Sah
                                        </span>
                                    @elseif($pending > 0)
                                        <span class="badge bg-warning text-dark px-2 py-1" style="font-size: 0.72rem;">
                                            {{ $pending }} Pending Review
                                        </span>
                                    @else
                                        <span class="badge bg-info text-white px-2 py-1" style="font-size: 0.72rem;">
                                            {{ $verified }}/{{ $totalUploaded }} Sah
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if($item->status == 'fase1')
                                        <span class="badge bg-warning text-dark px-2 py-1" style="font-size: 0.72rem;">Fase 1</span>
                                    @elseif($item->status == 'fase2')
                                        <span class="badge bg-primary text-white px-2 py-1" style="font-size: 0.72rem;">Fase 2</span>
                                    @elseif($item->status == 'fase3')
                                        <span class="badge text-white px-2 py-1" style="font-size: 0.72rem; background-color: #9a55ff;">Fase 3</span>
                                    @elseif($item->status == 'approved')
                                        <span class="badge bg-success text-white px-2 py-1" style="font-size: 0.72rem;">Disetujui</span>
                                    @elseif($item->status == 'rejected')
                                        <span class="badge bg-danger text-white px-2 py-1" style="font-size: 0.72rem;">Ditolak</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-inline-flex align-items-center justify-content-center gap-1">
                                        <a href="{{ route('pra-landbank.proses', $item->id) }}" class="btn btn-sm btn-outline-primary d-inline-flex align-items-center justify-content-center text-center px-2.5 py-1" title="Buka Form Wizard Pra Land Bank" style="font-size: 0.78rem;">
                                            Proses
                                        </a>
                                        @if($isStaffLegal)
                                            <a href="{{ route('pra-landbank.proses', $item->id) }}?step=2" class="btn btn-sm btn-outline-warning text-dark d-inline-flex align-items-center justify-content-center text-center px-2.5 py-1" title="Upload & Kelola Berkas Legalitas" style="font-size: 0.78rem;">
                                                Berkas
                                            </a>
                                        @else
                                            <a href="{{ route('pra-landbank.proses', $item->id) }}?step=2" class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center justify-content-center text-center px-2.5 py-1" title="Verifikasi & Validasi Dokumen" style="font-size: 0.78rem;">
                                                Validasi
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-4 text-muted">
                                    Belum ada data Pra Land Bank yang sesuai kriteria filter.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($praLandbanks->hasPages())
                <div class="px-3 py-3 border-top d-flex justify-content-between align-items-center">
                    <small class="text-muted">
                        Menampilkan {{ $praLandbanks->firstItem() }} - {{ $praLandbanks->lastItem() }} dari {{ $praLandbanks->total() }} data
                    </small>
                    <div>
                        {{ $praLandbanks->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>

</div>
@endsection
