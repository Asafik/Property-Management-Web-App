@extends('layouts.partial.app')

@section('title', 'Monitoring & Setoran Tugas Sosial Media - Property Management')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard-clean.css') }}?v={{ time() }}">
<meta name="referrer" content="no-referrer">
<style>
    /* 100% Solid Flat Colors - Sesuai Catalog Unit (Tanpa Gradient) */
    .compact-table-card {
        background: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 8px !important;
        box-shadow: none !important;
        overflow: hidden;
    }

    /* Tab Styling Bersih */
    .nav-tabs-clean {
        border-bottom: 2px solid #e2e8f0;
        gap: 0.25rem;
    }

    .nav-tabs-clean .nav-link {
        border: none;
        color: #64748b;
        font-weight: 700;
        font-size: 0.85rem;
        padding: 0.75rem 1.15rem;
        border-radius: 6px 6px 0 0;
        transition: all 0.15s ease;
        display: flex;
        align-items: center;
        gap: 0.45rem;
        background: transparent;
    }

    .nav-tabs-clean .nav-link:hover {
        color: #0f172a;
        background: #f8fafc;
    }

    .nav-tabs-clean .nav-link.active {
        color: #9a55ff;
        background: #ffffff;
        border-bottom: 3px solid #9a55ff;
    }

    /* Table Clean (Persis Catalog Unit & Table Lahan) */
    .table-clean {
        width: 100% !important;
        margin-bottom: 0;
    }

    .table-clean thead th {
        background: #f8fafc !important;
        color: #4b5563 !important;
        font-weight: 700;
        font-size: 0.76rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e2e8f0 !important;
        padding: 0.8rem 0.75rem !important;
        vertical-align: middle;
        white-space: nowrap;
    }

    .table-clean tbody td {
        padding: 0.8rem 0.75rem !important;
        vertical-align: middle;
        font-size: 0.84rem;
        border-bottom: 1px solid #f1f5f9;
        white-space: nowrap;
    }

    .table-clean tbody tr:hover {
        background-color: #f8fafc;
    }

    /* Tombol Aksi Persis Catalog Unit & Master Bank */
    .btn-action {
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        border: none;
        transition: all 0.15s ease;
        text-decoration: none !important;
        cursor: pointer;
    }

    .btn-action i {
        font-size: 0.95rem;
        line-height: 1;
    }

    .btn-action.view {
        background: #9a55ff !important;
        color: #ffffff !important;
    }
    .btn-action.view:hover {
        background: #8b3df5 !important;
        color: #ffffff !important;
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

    .btn-action.success {
        background: #10b981 !important;
        color: #ffffff !important;
    }
    .btn-action.success:hover {
        background: #059669 !important;
        color: #ffffff !important;
    }

    /* View Toggle Buttons persis Catalog Unit */
    .btn-view-toggle {
        padding: 0.38rem 0.85rem;
        font-size: 0.82rem;
        font-weight: 600;
        border-radius: 6px !important;
        border: 1.5px solid #e2e8f0;
        background: #ffffff;
        color: #4a5568;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        cursor: pointer;
    }
    .btn-view-toggle:hover {
        border-color: #c4b5fd;
        color: #7c3aed;
        background: #faf5ff;
    }
    .btn-view-toggle.active {
        background: #9a55ff !important;
        color: #ffffff !important;
        border-color: #9a55ff !important;
        box-shadow: 0 2px 6px rgba(154, 85, 255, 0.25);
    }

    /* Grid Card (Mode Grid) */
    .task-grid-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 1.15rem 1.25rem;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .task-grid-card:hover {
        border-color: #9a55ff;
        box-shadow: 0 4px 12px rgba(154, 85, 255, 0.1);
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-2 px-md-4 py-3">

    <!-- Page Title & Subtitle (Tanpa Card, Persis Halaman Catalog Unit) -->
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
        <div>
            <h2 class="text-dark mb-1 fw-bold" style="font-size: 1.55rem; letter-spacing: -0.02em;">
                Monitoring Tugas Promosi
            </h2>
            <p class="text-muted mb-0" style="font-size: 0.88rem;">
                Kelola penugasan konten video promosi Instagram & TikTok serta pantau setoran tim
            </p>
        </div>
        <div class="d-flex flex-wrap align-items-center gap-2">
            @if($pendingTasks->count() > 0)
            <button type="button" class="btn btn-sm text-white fw-semibold d-inline-flex align-items-center gap-1.5 px-3 shadow-sm" onclick="bukaModalSetorTugas({{ $pendingTasks->first()->id }}, '{{ addslashes($pendingTasks->first()->nama_tugas) }}')" style="height: 38px; border-radius: 6px; background-color: #9a55ff; border: 1px solid #9a55ff;">
                <i class="mdi mdi-upload fs-6"></i>
                <span>Setor Link Tugas</span>
            </button>
            @endif
            <button type="button" class="btn btn-sm d-inline-flex align-items-center gap-1.5 px-3 fw-semibold" onclick="openModalTambahTugas()" style="height: 38px; border-radius: 6px; background-color: #f3e8ff; color: #9333ea; border: 1px solid #d8b4fe;">
                <i class="mdi mdi-plus-circle"></i>
                <span>Tambah Tugas Baru</span>
            </button>
        </div>
    </div>

    <!-- Alert Khusus Staff Marketing: TUGAS BELUM DISELESAIKAN -->
    @if($pendingTasks->count() > 0)
    <div id="alertTugasPending" class="alert border-0 shadow-sm d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between p-3 mb-4 gap-3" style="background-color: #fffbeb; border-left: 4px solid #f59e0b !important; border-radius: 8px;">
        <div class="d-flex align-items-start gap-3">
            <div style="width: 40px; height: 40px; border-radius: 8px; background-color: #fef3c7; display: flex; align-items: center; justify-content: center; color: #b45309; font-size: 1.35rem; flex-shrink: 0;">
                <i class="mdi mdi-alert-circle"></i>
            </div>
            <div>
                <h6 class="fw-bold mb-1" style="color: #92400e; font-size: 0.94rem;">
                    Halo {{ auth()->user()->name ?? 'Staff Marketing' }}! Anda memiliki {{ $pendingTasks->count() }} Tugas Promosi yang Belum Diselesaikan
                </h6>
                <p class="mb-0 text-muted" style="font-size: 0.83rem;">
                    Tugas: <strong>"{{ $pendingTasks->first()->nama_tugas }}"</strong> &bull; Deadline: <span class="text-danger fw-bold">{{ $pendingTasks->first()->deadline ? \Carbon\Carbon::parse($pendingTasks->first()->deadline)->format('d M Y') : '-' }}</span>. Klik tombol detail untuk instruksi lengkap atau setor link video.
                </p>
            </div>
        </div>
        <div class="d-flex align-items-center gap-2 flex-shrink-0">
            <a href="{{ route('marketing.sosialmedia.task.show', $pendingTasks->first()->id) }}" class="btn btn-sm btn-outline-secondary px-3 py-1.5 fw-semibold" style="height: 36px; border-radius: 6px;">
                <i class="mdi mdi-eye-outline me-1"></i>Lihat Detail
            </a>
            <button type="button" class="btn btn-sm text-white fw-bold px-3 py-1.5 text-nowrap d-inline-flex align-items-center gap-1.5 shadow-sm" onclick="bukaModalSetorTugas({{ $pendingTasks->first()->id }}, '{{ addslashes($pendingTasks->first()->nama_tugas) }}')" style="height: 36px; border-radius: 6px; background-color: #f59e0b; border: 1px solid #d97706;">
                <i class="mdi mdi-upload fs-6"></i>
                <span>Setor Link Tugas Ini</span>
            </button>
        </div>
    </div>
    @endif

    <!-- 4 KPI Metrics Card Grid (Persis Catalog Unit - 1 Warna Solid, Tanpa Gradient) -->
    <div class="dash-kpi-grid mb-4">
        <!-- Card 1: Tugas Belum Disetor (Kuning/Amber Solid) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon" style="background-color: #fef3c7; color: #b45309;">
                    <i class="mdi mdi-clock-alert-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Tugas Belum Disetor</div>
                    <div class="dash-kpi-val">{{ $totalPendingCount }}</div>
                    <div class="dash-kpi-sub">Perlu Segera Dikerjakan</div>
                </div>
            </div>
        </div>

        <!-- Card 2: Tugas Selesai (Hijau Solid) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon" style="background-color: #ecfdf5; color: #059669;">
                    <i class="mdi mdi-checkbox-marked-circle-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Tugas Selesai</div>
                    <div class="dash-kpi-val">{{ $totalCompletedCount }}</div>
                    <div class="dash-kpi-sub">Telah Disetor & Tayang</div>
                </div>
            </div>
        </div>

        <!-- Card 3: Total Tayangan (Biru Solid) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon" style="background-color: #f0f9ff; color: #0284c7;">
                    <i class="mdi mdi-eye-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Total Tayangan</div>
                    <div class="dash-kpi-val">{{ number_format($totalViews, 0, ',', '.') }}</div>
                    <div class="dash-kpi-sub">Akumulasi Views Video</div>
                </div>
            </div>
        </div>

        <!-- Card 4: Total Interaksi / Suka (Merah Solid) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon" style="background-color: #fef2f2; color: #ef4444;">
                    <i class="mdi mdi-heart-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Total Suka (Likes)</div>
                    <div class="dash-kpi-val">{{ number_format($totalLikes, 0, ',', '.') }}</div>
                    <div class="dash-kpi-sub">Interaksi Tayangan</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Card Container with Tabs (Solid Clean Persis Catalog Unit) -->
    <div class="card compact-table-card shadow-sm border-0 mb-4">
        <div class="card-header bg-white border-bottom p-0 pt-2 px-3 px-md-4">
            <ul class="nav nav-tabs nav-tabs-clean" id="socialMediaTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="tab-tugas-btn" data-bs-toggle="tab" data-bs-target="#tab-tugas" type="button" role="tab">
                        <i class="mdi mdi-clipboard-alert-outline fs-5 text-warning"></i>
                        <span>Tugas Perlu Dikerjakan (<span id="tabPendingBadge">{{ $totalPendingCount }}</span>)</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab-selesai-btn" data-bs-toggle="tab" data-bs-target="#tab-selesai" type="button" role="tab">
                        <i class="mdi mdi-check-all fs-5 text-success"></i>
                        <span>Riwayat Tugas Selesai (<span id="tabCompletedBadge">{{ $totalCompletedCount }}</span>)</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab-grafik-btn" data-bs-toggle="tab" data-bs-target="#tab-grafik" type="button" role="tab">
                        <i class="mdi mdi-chart-areaspline fs-5 text-primary"></i>
                        <span>Grafik Tren & Analisis Views</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab-tim-btn" data-bs-toggle="tab" data-bs-target="#tab-tim" type="button" role="tab">
                        <i class="mdi mdi-account-group-outline fs-5" style="color: #9a55ff;"></i>
                        <span>Pantauan Seluruh Tim (Mode Admin)</span>
                    </button>
                </li>
            </ul>
        </div>

        <div class="card-body p-3 p-md-4">
            <div class="tab-content" id="socialMediaTabsContent">

                <!-- ================= TAB 1: TUGAS PERLU DIKERJAKAN ================= -->
                <div class="tab-pane fade show active" id="tab-tugas" role="tabpanel">
                    
                    <div id="wrapperTugasPending">
                        <!-- Toolbar Atas Tab 1 (Header Daftar & Toggle View) -->
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
                            <div class="d-flex align-items-center gap-2">
                                <div style="width: 32px; height: 32px; border-radius: 6px; background-color: #f3e8ff; color: #9333ea; display: inline-flex; align-items: center; justify-content: center; font-size: 1.15rem; flex-shrink: 0;">
                                    <i class="mdi mdi-format-list-bulleted"></i>
                                </div>
                                <span style="font-size: 0.95rem; font-weight: 700; color: #0f172a;">Daftar Tugas Promosi Aktif</span>
                            </div>

                            <!-- Toggle View persis Catalog Unit -->
                            <div class="d-flex align-items-center gap-1" id="viewToggleGroup">
                                <button type="button" class="btn btn-view-toggle active" id="btnTableView" onclick="switchTaskView('table')">
                                    <i class="mdi mdi-view-list"></i><span>Table</span>
                                </button>
                                <button type="button" class="btn btn-view-toggle" id="btnGridView" onclick="switchTaskView('grid')">
                                    <i class="mdi mdi-view-grid"></i><span>Grid</span>
                                </button>
                            </div>
                        </div>

                        @if($pendingTasks->count() > 0)
                        
                        <!-- 1. TAMPILAN TABEL SINGKAT (PERSIS KATALOG UNIT - TANPA DESKRIPSI) -->
                        <div id="viewModeTableContainer" class="table-responsive">
                            <table class="table table-hover align-middle table-clean mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 45px;">No</th>
                                        <th>Nama Tugas Promosi</th>
                                        <th>Target Platform</th>
                                        <th>Batas Waktu</th>
                                        <th class="text-center" style="width: 120px;">Status</th>
                                        <th class="text-center" style="width: 175px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pendingTasks as $index => $pt)
                                    <tr id="rowTugasPending{{ $pt->id }}">
                                        <td class="text-center fw-bold">{{ $index + 1 }}</td>
                                        <td>
                                            <!-- Judul Tugas Singkat & Bersih (Klik untuk melihat deskripsi lengkap di detail) -->
                                            <a href="{{ route('marketing.sosialmedia.task.show', $pt->id) }}" class="fw-bold text-dark text-decoration-none" title="Lihat Deskripsi Lengkap">
                                                {{ $pt->nama_tugas }}
                                            </a>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-danger border px-2 py-1 fw-bold" style="font-size: 0.74rem;">
                                                <i class="mdi mdi-instagram me-1"></i>{{ $pt->platform ?: 'Instagram Reels / TikTok' }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($pt->deadline)
                                            <div class="fw-bold text-danger d-inline-flex align-items-center gap-1" style="font-size: 0.82rem;">
                                                <i class="mdi mdi-calendar-alert"></i>
                                                <span>{{ \Carbon\Carbon::parse($pt->deadline)->format('d M Y') }}</span>
                                            </div>
                                            @else
                                            <span class="text-muted small">-</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <span class="badge py-1.5 px-2.5 fw-semibold" style="font-size: 0.74rem; border-radius: 6px; background-color: #fffbeb; color: #b45309; border: 1px solid #fde68a;">
                                                <i class="mdi mdi-clock-outline me-1"></i>Belum Disetor
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-inline-flex align-items-center gap-1">
                                                <!-- Tombol Detail ke Halaman Tersendiri -->
                                                <a href="{{ route('marketing.sosialmedia.task.show', $pt->id) }}" class="btn btn-sm btn-outline-secondary px-2.5 py-1.5 d-inline-flex align-items-center gap-1 text-nowrap" style="font-size: 0.78rem; border-radius: 6px;" title="Lihat Deskripsi & Rincian">
                                                    <i class="mdi mdi-eye-outline"></i>
                                                    <span>Detail</span>
                                                </a>
                                                <!-- Tombol Setor Link -->
                                                <button type="button" class="btn btn-sm text-white px-2.5 py-1.5 d-inline-flex align-items-center gap-1 text-nowrap shadow-sm fw-semibold" onclick="bukaModalSetorTugas({{ $pt->id }}, '{{ addslashes($pt->nama_tugas) }}')" style="font-size: 0.78rem; border-radius: 6px; background-color: #9a55ff; border: 1px solid #9a55ff;">
                                                    <i class="mdi mdi-upload"></i>
                                                    <span>Setor Link</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- 2. TAMPILAN GRID (PERSIS GRID KATALOG UNIT) -->
                        <div id="viewModeGridContainer" class="d-none">
                            <div class="row g-3">
                                @foreach($pendingTasks as $pt)
                                <div class="col-md-6 col-lg-4" id="cardTugasPending{{ $pt->id }}">
                                    <div class="task-grid-card">
                                        <div>
                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                <span class="badge py-1 px-2 fw-semibold" style="font-size: 0.72rem; border-radius: 6px; background-color: #fffbeb; color: #b45309; border: 1px solid #fde68a;">
                                                    <i class="mdi mdi-clock-outline me-1"></i>Belum Disetor
                                                </span>
                                                <span class="badge bg-light text-danger border px-2 py-1" style="font-size: 0.72rem;">
                                                    {{ $pt->platform ?: 'Instagram Reels' }}
                                                </span>
                                            </div>

                                            <h5 class="fw-bold text-dark mb-2" style="font-size: 0.95rem; line-height: 1.4;">
                                                <a href="{{ route('marketing.sosialmedia.task.show', $pt->id) }}" class="text-dark text-decoration-none" title="Lihat Deskripsi Lengkap">
                                                    {{ $pt->nama_tugas }}
                                                </a>
                                            </h5>

                                            @if($pt->deadline)
                                            <div class="text-danger small mb-3">
                                                <i class="mdi mdi-calendar-alert me-1"></i>Deadline: <strong>{{ \Carbon\Carbon::parse($pt->deadline)->format('d M Y') }}</strong>
                                            </div>
                                            @endif
                                        </div>

                                        <div class="pt-3 border-top d-flex align-items-center justify-content-between gap-1">
                                            <a href="{{ route('marketing.sosialmedia.task.show', $pt->id) }}" class="btn btn-sm btn-outline-secondary py-1 px-2" style="font-size: 0.78rem; border-radius: 6px;">
                                                <i class="mdi mdi-eye-outline me-1"></i>Detail
                                            </a>
                                            <button type="button" class="btn btn-sm text-white py-1 px-3 fw-semibold shadow-sm" onclick="bukaModalSetorTugas({{ $pt->id }}, '{{ addslashes($pt->nama_tugas) }}')" style="font-size: 0.78rem; border-radius: 6px; background-color: #9a55ff; border: 1px solid #9a55ff;">
                                                <i class="mdi mdi-upload me-1"></i>Setor Link
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        @else
                        <!-- State jika semua tugas sudah selesai -->
                        <div id="stateSemuaTugasSelesai" class="text-center py-5">
                            <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle" style="width: 64px; height: 64px; background-color: #ecfdf5; color: #10b981; font-size: 2rem;">
                                <i class="mdi mdi-checkbox-marked-circle-outline"></i>
                            </div>
                            <h5 class="fw-bold text-dark mb-1">Hebat! Semua Tugas Promosi Sudah Anda Setor</h5>
                            <p class="text-muted mb-0" style="max-width: 480px; margin: 0 auto; font-size: 0.85rem;">
                                Tidak ada tugas promosi tertunda saat ini. Anda dapat memeriksa riwayat setoran pada tab <strong>Riwayat Tugas Selesai</strong>.
                            </p>
                        </div>
                        @endif

                    </div>

                </div>

                <!-- ================= TAB 2: RIWAYAT TUGAS SELESAI (SINGKAT TANPA DESKRIPSI) ================= -->
                <div class="tab-pane fade" id="tab-selesai" role="tabpanel">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <div style="width: 32px; height: 32px; border-radius: 6px; background-color: #ecfdf5; color: #059669; display: inline-flex; align-items: center; justify-content: center; font-size: 1.15rem; flex-shrink: 0;">
                                <i class="mdi mdi-check-all"></i>
                            </div>
                            <span style="font-size: 0.95rem; font-weight: 700; color: #0f172a;">Riwayat Tugas Promosi Selesai</span>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle table-clean mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 45px;">No</th>
                                    <th>Nama Tugas Promosi</th>
                                    <th>Platform & Link Video</th>
                                    <th>Tanggal Disetor</th>
                                    <th class="text-center">Performa Tayangan</th>
                                    <th class="text-center" style="width: 120px;">Status</th>
                                    <th class="text-center" style="width: 140px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tbodyRiwayatSelesai">
                                @forelse($completedTasks as $index => $ct)
                                <tr>
                                    <td class="text-center fw-bold">{{ $index + 1 }}</td>
                                    <td>
                                        <!-- Nama Tugas Singkat -->
                                        <a href="{{ route('marketing.sosialmedia.task.show', $ct->id) }}" class="fw-bold text-dark text-decoration-none" title="Lihat Detail & Deskripsi Lengkap">
                                            {{ $ct->nama_tugas }}
                                        </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-1.5">
                                            <span class="badge bg-light text-danger border font-monospace" style="font-size: 0.72rem;">
                                                <i class="mdi mdi-instagram me-1"></i>{{ $ct->platform ?: 'Instagram Reels' }}
                                            </span>
                                        </div>
                                        <a href="{{ $ct->link_postingan }}" target="_blank" class="text-primary text-decoration-none small fw-semibold d-inline-flex align-items-center gap-0.5 mt-1">
                                            <span>{{ Str::limit($ct->link_postingan, 32) }}</span>
                                            <i class="mdi mdi-open-in-new" style="font-size: 11px;"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <div class="fw-semibold text-dark">{{ $ct->tanggal_setor ? \Carbon\Carbon::parse($ct->tanggal_setor)->format('d M Y') : '-' }}</div>
                                        <small class="text-muted">{{ $ct->tanggal_setor ? \Carbon\Carbon::parse($ct->tanggal_setor)->format('H:i') . ' WIB' : '' }}</small>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex align-items-center justify-content-center gap-2">
                                            <span class="badge bg-light text-dark border px-2 py-1 fw-bold">
                                                <i class="mdi mdi-eye text-primary me-1"></i>{{ number_format($ct->views ?: 0, 0, ',', '.') }} Views
                                            </span>
                                            <span class="badge bg-light text-dark border px-2 py-1 fw-bold">
                                                <i class="mdi mdi-heart text-danger me-1"></i>{{ number_format($ct->likes ?: 0, 0, ',', '.') }} Likes
                                            </span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge py-1.5 px-2.5 fw-semibold" style="font-size: 0.74rem; border-radius: 6px; background-color: #ecfdf5; color: #059669; border: 1px solid #a7f3d0;">
                                            <i class="mdi mdi-check-circle me-1"></i>Sudah Selesai
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-inline-flex align-items-center gap-1">
                                            <a href="{{ route('marketing.sosialmedia.task.show', $ct->id) }}" class="btn btn-sm btn-outline-secondary py-1 px-2 d-inline-flex align-items-center gap-1" style="border-radius: 6px; font-size: 0.76rem;" title="Lihat Deskripsi & Detail">
                                                <i class="mdi mdi-eye-outline"></i> Detail
                                            </a>
                                            <a href="{{ $ct->link_postingan }}" target="_blank" class="btn btn-sm btn-outline-success py-1 px-2 d-inline-flex align-items-center gap-1" style="border-radius: 6px; font-size: 0.76rem;" title="Tonton Video">
                                                <i class="mdi mdi-play"></i> Tonton
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        Belum ada riwayat tugas yang disetor. Silakan setor tugas di tab pertama.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- ================= TAB 3: GRAFIK ANALITIK VIEWS ================= -->
                <div class="tab-pane fade" id="tab-grafik" role="tabpanel">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
                        <div>
                            <h5 class="fw-bold text-dark mb-1">
                                <i class="mdi mdi-trending-up text-success me-1"></i> Pertumbuhan Tayangan Video Promosi (7 Hari Terakhir)
                            </h5>
                            <p class="text-muted mb-0" style="font-size: 0.85rem;">
                                Menampilkan total akumulasi views dan likes dari video promosi yang disetor staff marketing.
                            </p>
                        </div>
                    </div>

                    <div style="position: relative; height: 340px; width: 100%;">
                        <canvas id="dummyTrendChartCanvas"></canvas>
                    </div>

                    <div class="d-flex flex-wrap align-items-center justify-content-between mt-3 pt-3 border-top gap-2">
                        <small class="text-muted" style="font-size: 0.78rem;">
                            <i class="mdi mdi-information-outline me-1"></i> Metrik dihitung dari total postingan promosi aktif yang telah disetorkan.
                        </small>
                        <span class="badge bg-light text-secondary border px-2 py-1" style="font-size: 0.75rem;">
                            Akumulasi: {{ number_format($totalViews, 0, ',', '.') }} Views &bull; {{ number_format($totalLikes, 0, ',', '.') }} Likes
                        </span>
                    </div>
                </div>

                <!-- ================= TAB 4: PANTAUAN SELURUH TIM (MODE ADMIN) ================= -->
                <div class="tab-pane fade" id="tab-tim" role="tabpanel">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <div style="width: 32px; height: 32px; border-radius: 6px; background-color: #f3e8ff; color: #9333ea; display: inline-flex; align-items: center; justify-content: center; font-size: 1.15rem; flex-shrink: 0;">
                                <i class="mdi mdi-account-group-outline"></i>
                            </div>
                            <span style="font-size: 0.95rem; font-weight: 700; color: #0f172a;">Rekap Seluruh Tim Marketing</span>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <button type="button" class="btn btn-sm d-inline-flex align-items-center gap-1 shadow-sm px-3 py-1.5 text-white fw-semibold" onclick="openModalTambahTugas()" style="border-radius: 6px; background-color: #9a55ff; border: 1px solid #9a55ff;">
                                <i class="mdi mdi-plus-circle fs-6"></i>
                                <span>Tambah Tugas Baru</span>
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle table-clean mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 45px;">No</th>
                                    <th>Nama Staff Marketing</th>
                                    <th>Nama Tugas Promosi</th>
                                    <th>Batas Waktu</th>
                                    <th class="text-center">Status Setoran</th>
                                    <th>Link Video Disetor</th>
                                    <th class="text-center" style="width: 140px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($allStaffTasks as $index => $st)
                                <tr>
                                    <td class="text-center fw-bold">{{ $index + 1 }}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div style="width: 30px; height: 30px; border-radius: 6px; background-color: #f3e8ff; color: #9a55ff; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 0.75rem;">
                                                {{ strtoupper(substr($st->employee->name ?? 'M', 0, 2)) }}
                                            </div>
                                            <div>
                                                <div class="fw-bold text-dark mb-0">{{ $st->employee->name ?? 'Staff Marketing' }}</div>
                                                @if(isset($st->employee->position->name) && strcasecmp(trim($st->employee->position->name), trim($st->employee->name ?? '')) !== 0)
                                                    <small class="text-muted">{{ $st->employee->position->name }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <!-- Judul Tugas Singkat -->
                                        <a href="{{ route('marketing.sosialmedia.task.show', $st->id) }}" class="fw-bold text-dark text-decoration-none" title="Lihat Deskripsi Lengkap">
                                            {{ $st->nama_tugas }}
                                        </a>
                                    </td>
                                    <td><small class="text-muted">{{ $st->deadline ? \Carbon\Carbon::parse($st->deadline)->format('d M Y') : '-' }}</small></td>
                                    <td class="text-center">
                                        @if($st->link_postingan)
                                        <span class="badge py-1 px-2 fw-semibold" style="font-size: 0.74rem; border-radius: 6px; background-color: #ecfdf5; color: #059669; border: 1px solid #a7f3d0;">
                                            <i class="mdi mdi-check-circle me-1"></i>Sudah Setor
                                        </span>
                                        @else
                                        <span class="badge py-1 px-2 fw-semibold" style="font-size: 0.74rem; border-radius: 6px; background-color: #fef2f2; color: #dc2626; border: 1px solid #fecaca;">
                                            <i class="mdi mdi-alert-circle me-1"></i>Belum Setor
                                        </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($st->link_postingan)
                                        <a href="{{ $st->link_postingan }}" target="_blank" class="text-primary text-decoration-none small fw-semibold d-inline-flex align-items-center gap-1">
                                            <i class="mdi mdi-link"></i>
                                            <span>{{ Str::limit($st->link_postingan, 26) }}</span>
                                        </a>
                                        @else
                                        <span class="text-muted small fst-italic">Menunggu setoran staff</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <!-- Tombol Aksi: Detail (Mata), Tonton (Play), Edit (Kuning), Hapus (Merah) -->
                                        <div class="d-inline-flex align-items-center gap-1">
                                            <a href="{{ route('marketing.sosialmedia.task.show', $st->id) }}" class="btn-action view" title="Lihat Deskripsi & Detail Tugas">
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                            @if($st->link_postingan)
                                            <a href="{{ $st->link_postingan }}" target="_blank" class="btn-action success" title="Tonton Video">
                                                <i class="mdi mdi-play"></i>
                                            </a>
                                            @endif
                                            <button type="button" class="btn-action edit" title="Edit Tugas" onclick="openModalEditTugas({{ $st->id }}, '{{ addslashes($st->nama_tugas) }}', {{ $st->employee_id ?? 'null' }}, '{{ $st->platform }}', '{{ $st->deadline }}', '{{ addslashes($st->deskripsi) }}')">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                            <button type="button" class="btn-action delete" title="Hapus Tugas" onclick="confirmDeleteTugas({{ $st->id }})">
                                                <i class="mdi mdi-trash-can-outline"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">Belum ada data tugas tim yang dibuat.</td>
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

<!-- ================= MODAL 1: SETOR LINK TUGAS ================= -->
<div class="modal fade" id="modalSetorTugas" tabindex="-1" aria-labelledby="modalSetorTugasLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header bg-white border-bottom px-4 py-3">
                <div class="d-flex align-items-center gap-2">
                    <div style="width: 32px; height: 32px; border-radius: 6px; background-color: #f3e8ff; display: flex; align-items: center; justify-content: center; color: #9a55ff;">
                        <i class="mdi mdi-upload fs-5"></i>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold text-dark mb-0" id="modalSetorTugasLabel" style="font-size: 1rem;">
                            Setor Link Video Promosi
                        </h5>
                        <small class="text-muted" style="font-size: 0.76rem;">Formulir laporan bukti tayang tugas marketing</small>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form id="formSetorTugasNyata" onsubmit="kirimSetorTugasDb(event)">
                @csrf
                <input type="hidden" name="task_id" id="modalInputTaskId" value="">

                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark" style="font-size: 0.84rem;">
                            Tugas yang Dikerjakan
                        </label>
                        <input type="text" id="modalInputNamaTugas" class="form-control bg-light fw-bold" readonly value="" style="font-size: 0.88rem; border-radius: 6px;">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark" style="font-size: 0.84rem;">
                            Platform Media Sosial <span class="text-danger">*</span>
                        </label>
                        <select name="platform" id="modalInputPlatform" class="form-select" style="font-size: 0.88rem; border-radius: 6px;" required>
                            <option value="Instagram Reels">Instagram Reels (@instagram)</option>
                            <option value="TikTok">TikTok (@tiktok)</option>
                            <option value="YouTube Shorts">YouTube Shorts</option>
                            <option value="Facebook Video">Facebook Video / Reels</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark" style="font-size: 0.84rem;">
                            Link URL Postingan Video <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted border-end-0">
                                <i class="mdi mdi-link-variant"></i>
                            </span>
                            <input type="url" name="link_postingan" id="modalInputUrlVideo" class="form-control border-start-0" 
                                   placeholder="https://www.instagram.com/reel/C... atau https://www.tiktok.com/@..." 
                                   required style="font-size: 0.88rem; border-radius: 0 6px 6px 0;">
                        </div>
                        <small class="text-muted" style="font-size: 0.74rem;">
                            *Salin tautan video promosi yang sudah Anda tayangkan di medsos.
                        </small>
                    </div>

                    <div class="mb-2">
                        <label class="form-label fw-bold text-dark" style="font-size: 0.84rem;">
                            Catatan Tambahan (Opsional)
                        </label>
                        <textarea name="catatan_setor" id="modalInputCatatan" class="form-control" rows="2" placeholder="Contoh: Sudah ditayangkan di akun pribadi & kantor, caption menyertakan kontak WA..." style="font-size: 0.85rem; border-radius: 6px;"></textarea>
                    </div>
                </div>

                <div class="modal-footer bg-light border-top px-4 py-2.5">
                    <button type="button" class="btn btn-sm btn-secondary fw-semibold px-3 py-1.5" data-bs-dismiss="modal" style="border-radius: 6px;">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-sm text-white px-4 py-1.5 d-inline-flex align-items-center gap-1 shadow-sm fw-semibold" style="border-radius: 6px; background-color: #10b981; border: 1px solid #10b981;">
                        <i class="mdi mdi-check-circle-outline"></i>
                        <span>Kirim Bukti Setoran Tugas</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ================= MODAL 2: TAMBAH & EDIT TUGAS (MODE ADMIN) ================= -->
<div class="modal fade" id="modalTugasAdmin" tabindex="-1" aria-labelledby="modalTugasAdminLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header bg-white border-bottom px-4 py-3">
                <div class="d-flex align-items-center gap-2">
                    <div id="modalAdminIconWrapper" style="width: 32px; height: 32px; border-radius: 6px; background-color: #f3e8ff; display: flex; align-items: center; justify-content: center; color: #9a55ff;">
                        <i id="modalAdminIcon" class="mdi mdi-plus-circle fs-5"></i>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold text-dark mb-0" id="modalTugasAdminLabel" style="font-size: 1rem;">
                            Tambah Tugas Promosi Baru
                        </h5>
                        <small class="text-muted" style="font-size: 0.76rem;">Formulir penugasan konten untuk staff marketing</small>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form id="formTugasAdmin" onsubmit="submitFormTugasAdmin(event)">
                @csrf
                <input type="hidden" name="_method" id="adminFormMethod" value="POST">
                <input type="hidden" id="adminTaskId" value="">

                <div class="modal-body p-4">
                    <!-- Pilih Staff Marketing -->
                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark" style="font-size: 0.84rem;">
                            Ditugaskan Kepada Staff <span class="text-danger">*</span>
                        </label>
                        <select name="employee_id" id="adminInputEmployeeId" class="form-select" style="font-size: 0.88rem; border-radius: 6px;" required>
                            <option value="">-- Pilih Staff Marketing --</option>
                            @foreach($allEmployees as $emp)
                            <option value="{{ $emp->id }}">
                                {{ $emp->name }} ({{ $emp->position->name ?? 'Marketing' }})
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Judul Tugas -->
                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark" style="font-size: 0.84rem;">
                            Judul / Nama Tugas Promosi <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="nama_tugas" id="adminInputNamaTugas" class="form-control" placeholder="Contoh: Upload Video Reels Promosi Rumah Subsidi Blok A" required style="font-size: 0.88rem; border-radius: 6px;">
                    </div>

                    <!-- Platform & Deadline -->
                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-dark" style="font-size: 0.84rem;">
                                Platform Target
                            </label>
                            <select name="platform" id="adminInputPlatform" class="form-select" style="font-size: 0.88rem; border-radius: 6px;">
                                <option value="Instagram Reels / TikTok">Instagram Reels / TikTok</option>
                                <option value="Instagram Reels">Instagram Reels</option>
                                <option value="TikTok">TikTok</option>
                                <option value="YouTube Shorts">YouTube Shorts</option>
                                <option value="Facebook Reels">Facebook Reels</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-dark" style="font-size: 0.84rem;">
                                Batas Waktu (Deadline)
                            </label>
                            <input type="date" name="deadline" id="adminInputDeadline" class="form-control" style="font-size: 0.88rem; border-radius: 6px;">
                        </div>
                    </div>

                    <!-- Deskripsi & Arahan Penugasan -->
                    <div class="mb-2">
                        <label class="form-label fw-bold text-dark" style="font-size: 0.84rem;">
                            Deskripsi / Instruksi Pembuatan Konten (Tampil di Halaman Detail)
                        </label>
                        <textarea name="deskripsi" id="adminInputDeskripsi" class="form-control" rows="3" placeholder="Jelaskan poin-poin yang wajib disampaikan dalam video, contoh: DP 0%, gratis biaya notaris, fasilitas umum..." style="font-size: 0.85rem; border-radius: 6px;"></textarea>
                    </div>
                </div>

                <div class="modal-footer bg-light border-top px-4 py-2.5">
                    <button type="button" class="btn btn-sm btn-secondary fw-semibold px-3 py-1.5" data-bs-dismiss="modal" style="border-radius: 6px;">
                        Batal
                    </button>
                    <button type="submit" id="adminSubmitBtn" class="btn btn-sm text-white px-4 py-1.5 d-inline-flex align-items-center gap-1 shadow-sm fw-semibold" style="border-radius: 6px; background-color: #9a55ff; border: 1px solid #9a55ff;">
                        <i class="mdi mdi-content-save-outline"></i>
                        <span id="adminSubmitBtnText">Simpan Tugas</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{-- Chart.js & SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Toggle Tampilan Table vs Grid persis Catalog Unit
    function switchTaskView(mode) {
        const tableContainer = document.getElementById('viewModeTableContainer');
        const gridContainer = document.getElementById('viewModeGridContainer');
        const btnTable = document.getElementById('btnTableView');
        const btnGrid = document.getElementById('btnGridView');

        if (mode === 'grid') {
            if (tableContainer) tableContainer.classList.add('d-none');
            if (gridContainer) gridContainer.classList.remove('d-none');
            if (btnGrid) btnGrid.classList.add('active');
            if (btnTable) btnTable.classList.remove('active');
        } else {
            if (tableContainer) tableContainer.classList.remove('d-none');
            if (gridContainer) gridContainer.classList.add('d-none');
            if (btnTable) btnTable.classList.add('active');
            if (btnGrid) btnGrid.classList.remove('active');
        }
    }

    // Modal Setor Link Tugas
    function bukaModalSetorTugas(taskId, namaTugas) {
        document.getElementById('modalInputTaskId').value = taskId;
        document.getElementById('modalInputNamaTugas').value = namaTugas;
        const modal = new bootstrap.Modal(document.getElementById('modalSetorTugas'));
        modal.show();
    }

    // Kirim Setor Tugas via AJAX
    function kirimSetorTugasDb(e) {
        e.preventDefault();
        const form = document.getElementById('formSetorTugasNyata');
        const formData = new FormData(form);
        const modalEl = document.getElementById('modalSetorTugas');
        const modalInstance = bootstrap.Modal.getInstance(modalEl);

        Swal.fire({
            title: 'Menyimpan...',
            text: 'Sedang memproses tautan video promosi Anda',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        fetch("{{ route('marketing.sosialmedia.submitTask') }}", {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                if (modalInstance) {
                    modalInstance.hide();
                }
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil Disetor!',
                    text: 'Tautan video promosi telah berhasil disimpan.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#10b981'
                }).then(() => {
                    window.location.reload();
                });
            } else {
                Swal.fire('Gagal Menyimpan', data.message || 'Terjadi kesalahan saat menyimpan.', 'error');
            }
        })
        .catch(err => {
            console.error(err);
            Swal.fire('Error', 'Gagal menghubungi server.', 'error');
        });
    }

    // Modal Admin Tambah Tugas
    function openModalTambahTugas() {
        document.getElementById('formTugasAdmin').reset();
        document.getElementById('adminFormMethod').value = 'POST';
        document.getElementById('adminTaskId').value = '';
        
        document.getElementById('modalTugasAdminLabel').innerText = 'Tambah Tugas Promosi Baru';
        document.getElementById('adminSubmitBtnText').innerText = 'Simpan Tugas';
        document.getElementById('modalAdminIconWrapper').style.backgroundColor = '#f3e8ff';
        document.getElementById('modalAdminIconWrapper').style.color = '#9a55ff';
        document.getElementById('modalAdminIcon').className = 'mdi mdi-plus-circle fs-5';

        const modal = new bootstrap.Modal(document.getElementById('modalTugasAdmin'));
        modal.show();
    }

    // Modal Admin Edit Tugas
    function openModalEditTugas(id, namaTugas, employeeId, platform, deadline, deskripsi) {
        document.getElementById('adminTaskId').value = id;
        document.getElementById('adminFormMethod').value = 'PUT';
        document.getElementById('adminInputEmployeeId').value = employeeId || '';
        document.getElementById('adminInputNamaTugas').value = namaTugas || '';
        document.getElementById('adminInputPlatform').value = platform || 'Instagram Reels / TikTok';
        document.getElementById('adminInputDeadline').value = deadline ? deadline.substring(0, 10) : '';
        document.getElementById('adminInputDeskripsi').value = deskripsi || '';

        document.getElementById('modalTugasAdminLabel').innerText = 'Edit Tugas Promosi';
        document.getElementById('adminSubmitBtnText').innerText = 'Perbarui Tugas';
        document.getElementById('modalAdminIconWrapper').style.backgroundColor = '#fef3c7';
        document.getElementById('modalAdminIconWrapper').style.color = '#d97706';
        document.getElementById('modalAdminIcon').className = 'mdi mdi-pencil fs-5';

        const modal = new bootstrap.Modal(document.getElementById('modalTugasAdmin'));
        modal.show();
    }

    // Submit Form Admin Tambah/Edit Tugas
    function submitFormTugasAdmin(e) {
        e.preventDefault();
        const form = document.getElementById('formTugasAdmin');
        const formData = new FormData(form);
        const taskId = document.getElementById('adminTaskId').value;
        const method = document.getElementById('adminFormMethod').value;
        const modalEl = document.getElementById('modalTugasAdmin');
        const modalInstance = bootstrap.Modal.getInstance(modalEl);

        let url = "{{ route('marketing.sosialmedia.task.store') }}";
        if (taskId && method === 'PUT') {
            url = "{{ url('marketing/sosial-media/task') }}/" + taskId;
        }

        Swal.fire({
            title: 'Memproses Data...',
            text: 'Sedang menyimpan data penugasan',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        fetch(url, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                if (modalInstance) {
                    modalInstance.hide();
                }
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: data.message,
                    confirmButtonColor: '#10b981'
                }).then(() => {
                    window.location.reload();
                });
            } else {
                Swal.fire('Gagal Menyimpan', data.message || 'Terjadi kesalahan.', 'error');
            }
        })
        .catch(err => {
            console.error(err);
            Swal.fire('Error', 'Gagal memproses permintaan.', 'error');
        });
    }

    // Konfirmasi Hapus Tugas oleh Admin
    function confirmDeleteTugas(id) {
        Swal.fire({
            title: 'Yakin ingin menghapus tugas ini?',
            text: 'Data tugas promosi ini akan dihapus permanen!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Menghapus...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                fetch("{{ url('marketing/sosial-media/task') }}/" + id, {
                    method: 'DELETE',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Dihapus!',
                            text: data.message,
                            confirmButtonColor: '#10b981'
                        }).then(() => {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire('Gagal!', data.message || 'Gagal menghapus.', 'error');
                    }
                })
                .catch(err => {
                    console.error(err);
                    Swal.fire('Error', 'Gagal menghubungi server.', 'error');
                });
            }
        });
    }

    // Inisialisasi Grafik Chart.js (Flat Solid)
    document.addEventListener('DOMContentLoaded', function() {
        const canvasEl = document.getElementById('dummyTrendChartCanvas');
        if (canvasEl) {
            const ctx = canvasEl.getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['26 Sep', '27 Sep', '28 Sep', '29 Sep', '30 Sep', '01 Okt', '02 Okt'],
                    datasets: [
                        {
                            label: 'Tayangan (Views)',
                            data: {!! json_encode($chartViews) !!},
                            borderColor: '#0284c7',
                            backgroundColor: 'rgba(2, 132, 199, 0.08)',
                            borderWidth: 2.5,
                            pointBackgroundColor: '#0284c7',
                            pointBorderColor: '#ffffff',
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            pointHoverRadius: 6,
                            tension: 0.35,
                            fill: true,
                        },
                        {
                            label: 'Suka (Likes)',
                            data: {!! json_encode($chartLikes) !!},
                            borderColor: '#ef4444',
                            backgroundColor: 'rgba(239, 68, 68, 0.05)',
                            borderWidth: 2.5,
                            pointBackgroundColor: '#ef4444',
                            pointBorderColor: '#ffffff',
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            pointHoverRadius: 6,
                            tension: 0.35,
                            fill: true,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                font: { family: "'Inter', sans-serif", weight: '600', size: 12 },
                                usePointStyle: true,
                                pointStyle: 'circle'
                            }
                        },
                        tooltip: {
                            backgroundColor: '#0f172a',
                            titleFont: { size: 13, weight: 'bold' },
                            bodyFont: { size: 12 },
                            padding: 10,
                            cornerRadius: 8
                        }
                    },
                    scales: {
                        x: {
                            grid: { color: '#f1f5f9' },
                            ticks: { font: { family: "'Inter', sans-serif", size: 11 }, color: '#64748b' }
                        },
                        y: {
                            grid: { color: '#f1f5f9' },
                            ticks: { font: { family: "'Inter', sans-serif", size: 11 }, color: '#64748b' }
                        }
                    }
                }
            });
        }
    });
</script>
@endpush
