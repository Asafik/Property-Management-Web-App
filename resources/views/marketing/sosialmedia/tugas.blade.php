@extends('layouts.partial.app')

@section('title', 'Tugas Promosi Sosial Media - Property Management')

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

    /* Tombol Aksi Persis Catalog Unit (jual_unit.blade.php) */
    .action-group {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.35rem;
    }

    .btn-action {
        width: 36px;
        height: 36px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        transition: all 0.2s ease;
        border: none;
        cursor: pointer;
        text-decoration: none !important;
    }

    .btn-action i {
        font-size: 1.05rem;
        line-height: 1;
    }

    .btn-action.view {
        background: #9a55ff;
        color: #ffffff !important;
    }

    .btn-action.view:hover {
        background: #8b3df5;
        color: #ffffff !important;
        transform: translateY(-1px);
    }

    /* KPI Flat Solid Metrics Cards (Persis Catalog Unit) */
    .dash-kpi-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .dash-kpi-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 1.15rem 1.25rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        transition: transform 0.15s ease, border-color 0.15s ease;
    }

    .dash-kpi-card:hover {
        transform: translateY(-2px);
        border-color: #cbd5e1;
    }

    .dash-kpi-left {
        display: flex;
        align-items: center;
        gap: 1rem;
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

    .dash-kpi-info {
        display: flex;
        flex-direction: column;
    }

    .dash-kpi-label {
        font-size: 0.76rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #64748b;
        margin-bottom: 0.2rem;
    }

    .dash-kpi-val {
        font-size: 1.55rem;
        font-weight: 800;
        color: #0f172a;
        line-height: 1.15;
    }

    .dash-kpi-sub {
        font-size: 0.74rem;
        color: #94a3b8;
        margin-top: 0.2rem;
    }

    /* Switch View Toggle (Table / Grid) */
    .btn-view-toggle {
        display: inline-flex;
        align-items: center;
        background: #f1f5f9;
        border-radius: 6px;
        padding: 2px;
        border: 1px solid #e2e8f0;
    }

    .btn-view-toggle .btn {
        border: none;
        background: transparent;
        padding: 0.35rem 0.65rem;
        font-size: 0.8rem;
        font-weight: 600;
        color: #64748b;
        border-radius: 4px;
        transition: all 0.15s ease;
    }

    .btn-view-toggle .btn.active {
        background: #ffffff;
        color: #0f172a;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.08);
    }

    /* Grid Card */
    .task-grid-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 1.15rem;
        transition: all 0.15s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .task-grid-card:hover {
        border-color: #cbd5e1;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    /* Alert Banner Flat Solid */
    .alert-banner-solid {
        background-color: #fffbeb;
        border: 1px solid #fef3c7;
        border-radius: 8px;
        padding: 1rem 1.25rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.5rem;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-3 px-md-4 py-4">

    <!-- Header Bersih Solid (Catalog Unit Pattern) -->
    <div class="mb-4">
        <h3 class="fw-bold text-dark mb-1" style="letter-spacing: -0.02em;">Tugas Promosi Sosial Media</h3>
        <p class="text-muted mb-0" style="font-size: 0.88rem;">
            Kelola penugasan konten video promosi Instagram & TikTok yang perlu dikerjakan serta disetorkan.
        </p>
    </div>

    <!-- Alert / Banner Notifikasi Jika Ada Tugas Aktif -->
    @if($totalPendingCount > 0)
    <div class="alert-banner-solid">
        <div class="d-flex align-items-center gap-3">
            <div style="width: 38px; height: 38px; border-radius: 8px; background-color: #fef3c7; color: #d97706; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; flex-shrink: 0;">
                <i class="mdi mdi-alert-circle-outline"></i>
            </div>
            <div>
                <div class="fw-bold text-dark" style="font-size: 0.92rem;">
                    Halo {{ auth()->user()->name ?? 'Staff Marketing' }}! Anda memiliki {{ $totalPendingCount }} Tugas Promosi yang Belum Diselesaikan
                </div>
                <div class="text-muted" style="font-size: 0.8rem;">
                    Tugas: <strong>"{{ $pendingTasks->first()->nama_tugas ?? '' }}"</strong> &bull; Deadline: <span class="text-danger fw-semibold">{{ $pendingTasks->first()->deadline ? \Carbon\Carbon::parse($pendingTasks->first()->deadline)->format('d M Y') : 'Segera' }}</span>. Klik tombol detail untuk instruksi lengkap atau setor link video.
                </div>
            </div>
        </div>
        <div class="d-none d-md-flex align-items-center gap-2">
            <button type="button" class="btn btn-sm text-dark fw-bold px-3 py-1.5" onclick="bukaModalSetorTugas({{ $pendingTasks->first()->id }}, '{{ addslashes($pendingTasks->first()->nama_tugas) }}')" style="border-radius: 6px; background-color: #f59e0b; border: 1px solid #f59e0b; color: #ffffff !important;">
                <i class="mdi mdi-upload me-1"></i>Setor Link Tugas Ini
            </button>
        </div>
    </div>
    @endif

    <!-- KPI Metric Cards (Solid Flat - Catalog Unit Style) -->
    <div class="dash-kpi-grid">
        <!-- Card 1: Tugas Belum Disetor (Kuning Solid) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon" style="background-color: #fffbeb; color: #b45309;">
                    <i class="mdi mdi-clock-alert-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Tugas Perlu Dikerjakan</div>
                    <div class="dash-kpi-val" id="statPendingCount">{{ $totalPendingCount }}</div>
                    <div class="dash-kpi-sub">Perlu Segera Dikerjakan</div>
                </div>
            </div>
        </div>

        <!-- Card 2: Link Halaman Tugas Selesai (Hijau Solid) -->
        <a href="{{ route('marketing.sosialmedia.selesai') }}" class="dash-kpi-card text-decoration-none">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon" style="background-color: #ecfdf5; color: #059669;">
                    <i class="mdi mdi-checkbox-marked-circle-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Riwayat Tugas Selesai</div>
                    <div class="dash-kpi-val" style="font-size: 1.15rem; color: #059669; font-weight: 700;">
                        Lihat Riwayat &rarr;
                    </div>
                    <div class="dash-kpi-sub">Buka Halaman Tugas Selesai</div>
                </div>
            </div>
        </a>

        <!-- Card 3: Link Analisa & Pantauan Tim (Biru Solid) -->
        <a href="{{ route('marketing.sosialmedia.analisa') }}" class="dash-kpi-card text-decoration-none">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon" style="background-color: #f0f9ff; color: #0284c7;">
                    <i class="mdi mdi-chart-line"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Analisa & Pantauan Tim</div>
                    <div class="dash-kpi-val" style="font-size: 1.15rem; color: #0284c7; font-weight: 700;">
                        Lihat Grafik &rarr;
                    </div>
                    <div class="dash-kpi-sub">Buka Halaman Analisa</div>
                </div>
            </div>
        </a>
    </div>

    <!-- Main Card Container: Daftar Tugas Aktif -->
    <div class="card compact-table-card shadow-sm border-0 mb-4">
        <div class="card-header bg-white border-bottom p-3 px-md-4 d-flex flex-wrap align-items-center justify-content-between gap-2">
            <div class="d-flex align-items-center gap-2">
                <div style="width: 32px; height: 32px; border-radius: 6px; background-color: #fffbeb; color: #b45309; display: inline-flex; align-items: center; justify-content: center; font-size: 1.15rem; flex-shrink: 0;">
                    <i class="mdi mdi-clipboard-alert-outline"></i>
                </div>
                <div>
                    <span style="font-size: 0.95rem; font-weight: 700; color: #0f172a;">Daftar Tugas Promosi Aktif</span>
                    <span class="badge bg-light text-secondary border ms-2" style="font-size: 0.75rem;">{{ $totalPendingCount }} Tugas</span>
                </div>
            </div>

            <!-- View Toggle: Table / Grid -->
            <div class="d-flex align-items-center gap-2">
                <div class="btn-view-toggle">
                    <button type="button" class="btn active" id="btnViewTable" onclick="switchView('table')">
                        <i class="mdi mdi-table me-1"></i>Table
                    </button>
                    <button type="button" class="btn" id="btnViewGrid" onclick="switchView('grid')">
                        <i class="mdi mdi-view-grid me-1"></i>Grid
                    </button>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            @if($totalPendingCount > 0)
            <!-- 1. TAMPILAN TABEL -->
            <div id="viewModeTableContainer" class="table-responsive">
                <table class="table table-hover align-middle table-clean mb-0" id="tablePendingTasks">
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
                                <div class="action-group">
                                    <!-- Tombol Detail Ikon Eye Kotak Ungu Persis Catalog Unit -->
                                    <a href="{{ route('marketing.sosialmedia.task.show', $pt->id) }}" class="btn-action view" title="Detail Tugas">
                                        <i class="mdi mdi-eye"></i>
                                    </a>
                                    <!-- Tombol Setor Link -->
                                    <button type="button" class="btn btn-sm text-white px-2.5 py-1.5 d-inline-flex align-items-center gap-1 text-nowrap shadow-sm fw-semibold" onclick="bukaModalSetorTugas({{ $pt->id }}, '{{ addslashes($pt->nama_tugas) }}')" style="font-size: 0.78rem; border-radius: 6px; background-color: #9a55ff; border: 1px solid #9a55ff; height: 36px;">
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

            <!-- 2. TAMPILAN GRID -->
            <div id="viewModeGridContainer" class="d-none p-3 p-md-4">
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
                                <a href="{{ route('marketing.sosialmedia.task.show', $pt->id) }}" class="btn-action view" title="Detail Tugas">
                                    <i class="mdi mdi-eye"></i>
                                </a>
                                <button type="button" class="btn btn-sm text-white py-1.5 px-3 fw-semibold shadow-sm d-inline-flex align-items-center gap-1" onclick="bukaModalSetorTugas({{ $pt->id }}, '{{ addslashes($pt->nama_tugas) }}')" style="font-size: 0.78rem; border-radius: 6px; background-color: #9a55ff; border: 1px solid #9a55ff; height: 36px;">
                                    <i class="mdi mdi-upload"></i>
                                    <span>Setor Link</span>
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
                <p class="text-muted mb-3" style="max-width: 480px; margin: 0 auto; font-size: 0.85rem;">
                    Tidak ada tugas promosi aktif yang tertunda saat ini. Anda dapat memeriksa hasil publikasi di halaman riwayat tugas selesai.
                </p>
                <a href="{{ route('marketing.sosialmedia.selesai') }}" class="btn btn-sm btn-outline-success px-3 py-1.5 fw-semibold" style="border-radius: 6px;">
                    <i class="mdi mdi-check-all me-1"></i>Buka Riwayat Tugas Selesai
                </a>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- ================= MODAL 1: SETOR LINK TUGAS ================= -->
<div class="modal fade" id="modalSetorTugas" tabindex="-1" aria-labelledby="modalSetorTugasLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <form id="formSetorTugas" method="POST" action="{{ route('marketing.sosialmedia.submitTask') }}">
                @csrf
                <div class="modal-header bg-white border-bottom py-3">
                    <div class="d-flex align-items-center gap-2">
                        <div style="width: 32px; height: 32px; border-radius: 6px; background-color: #f3e8ff; color: #9a55ff; display: flex; align-items: center; justify-content: center; font-size: 1.1rem;">
                            <i class="mdi mdi-upload"></i>
                        </div>
                        <h5 class="modal-title fw-bold text-dark mb-0" id="modalSetorTugasLabel" style="font-size: 1rem;">
                            Setor Link Tugas Promosi
                        </h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <input type="hidden" name="task_id" id="setorTaskId" value="">

                    <!-- Pilih Tugas jika dibuka dari tombol header -->
                    <div class="mb-3" id="selectTaskGroup" style="display: none;">
                        <label class="form-label fw-semibold text-dark small">Pilih Tugas yang Disetor <span class="text-danger">*</span></label>
                        <select class="form-select" id="selectTaskDropdown" onchange="document.getElementById('setorTaskId').value = this.value">
                            <option value="">-- Pilih Tugas Promosi --</option>
                            @foreach($pendingTasks as $pt)
                            <option value="{{ $pt->id }}">{{ $pt->nama_tugas }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Judul Tugas Terpilih -->
                    <div class="p-3 mb-3 rounded" id="infoSelectedTask" style="background-color: #f8fafc; border: 1px solid #e2e8f0;">
                        <small class="text-muted text-uppercase fw-bold" style="font-size: 0.7rem; letter-spacing: 0.5px;">Tugas Promosi</small>
                        <div class="fw-bold text-dark mt-0.5" id="setorTaskTitle" style="font-size: 0.95rem;">-</div>
                    </div>

                    <!-- Target Platform -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Platform Publikasi <span class="text-danger">*</span></label>
                        <select name="platform" id="setorPlatform" class="form-select" required>
                            <option value="Instagram Reels">Instagram Reels</option>
                            <option value="TikTok">TikTok Video</option>
                            <option value="YouTube Shorts">YouTube Shorts</option>
                            <option value="Facebook Reels">Facebook Reels</option>
                        </select>
                    </div>

                    <!-- Input URL / Link Video -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Link Video Postingan <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-muted">
                                <i class="mdi mdi-link-variant"></i>
                            </span>
                            <input type="url" name="link_postingan" id="setorLinkPostingan" class="form-control border-start-0 ps-0" placeholder="https://www.instagram.com/reel/..." required>
                        </div>
                        <small class="text-muted" style="font-size: 0.75rem;">Pastikan postingan bersifat publik agar dapat diverifikasi oleh admin.</small>
                    </div>

                    <!-- Catatan / Keterangan Tambahan -->
                    <div class="mb-0">
                        <label class="form-label fw-semibold text-dark small">Catatan Tambahan (Opsional)</label>
                        <textarea name="catatan_setor" id="setorCatatan" class="form-control" rows="2" placeholder="Contoh: Sudah diposting jam 15:00 WIB menggunakan hashtag resmi..."></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light border-top py-2.5 px-4">
                    <button type="button" class="btn btn-outline-secondary btn-sm px-3" data-bs-dismiss="modal" style="border-radius: 6px;">Batal</button>
                    <button type="submit" class="btn btn-sm text-white px-3 fw-semibold shadow-sm" id="btnSubmitSetor" style="border-radius: 6px; background-color: #9a55ff; border: 1px solid #9a55ff;">
                        <i class="mdi mdi-check-circle me-1"></i>Simpan Bukti Setoran
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ================= MODAL 2: TAMBAH TUGAS BARU (ADMIN) ================= -->
<div class="modal fade" id="modalTambahTugas" tabindex="-1" aria-labelledby="modalTambahTugasLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <form id="formTambahTugas" method="POST" action="{{ route('marketing.sosialmedia.task.store') }}">
                @csrf
                <div class="modal-header bg-white border-bottom py-3">
                    <div class="d-flex align-items-center gap-2">
                        <div style="width: 32px; height: 32px; border-radius: 6px; background-color: #f3e8ff; color: #9a55ff; display: flex; align-items: center; justify-content: center; font-size: 1.1rem;">
                            <i class="mdi mdi-plus-circle"></i>
                        </div>
                        <h5 class="modal-title fw-bold text-dark mb-0" id="modalTambahTugasLabel" style="font-size: 1rem;">
                            Tambah Tugas Promosi Baru
                        </h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <!-- Ditugaskan Kepada -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Delegasikan Kepada Staff <span class="text-danger">*</span></label>
                        <select name="employee_id" class="form-select" required>
                            <option value="">-- Pilih Staff Marketing --</option>
                            @foreach($marketingStaffList as $stf)
                            <option value="{{ $stf->id }}" {{ (auth()->user()->id ?? 0) == $stf->id ? 'selected' : '' }}>
                                {{ $stf->name }} ({{ $stf->position->name ?? 'Marketing' }})
                            </option>
                            @endforeach
                            @if($marketingStaffList->isEmpty())
                                @foreach($allEmployees as $emp)
                                <option value="{{ $emp->id }}">
                                    {{ $emp->name }} ({{ $emp->position->name ?? 'Staff' }})
                                </option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <!-- Nama / Judul Tugas -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark small">Nama Tugas Promosi <span class="text-danger">*</span></label>
                        <input type="text" name="nama_tugas" class="form-control" placeholder="Contoh: Upload Video Reels Rumah Subsidi Blok A" required>
                    </div>

                    <!-- Platform & Deadline -->
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Target Platform</label>
                            <select name="platform" class="form-select">
                                <option value="Instagram Reels / TikTok">Instagram Reels / TikTok</option>
                                <option value="Instagram Reels">Instagram Reels</option>
                                <option value="TikTok Video">TikTok Video</option>
                                <option value="YouTube Shorts">YouTube Shorts</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold text-dark small">Batas Waktu (Deadline)</label>
                            <input type="date" name="deadline" class="form-control" value="{{ \Carbon\Carbon::now()->addDays(3)->format('Y-m-d') }}">
                        </div>
                    </div>

                    <!-- Deskripsi & Panduan Konten -->
                    <div class="mb-0">
                        <label class="form-label fw-semibold text-dark small">Instruksi & Deskripsi Konten (Opsional)</label>
                        <textarea name="deskripsi" class="form-control" rows="3" placeholder="Jelaskan poin promosi, hook 3 detik awal, call-to-action, serta hashtag yang wajib digunakan..."></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light border-top py-2.5 px-4">
                    <button type="button" class="btn btn-outline-secondary btn-sm px-3" data-bs-dismiss="modal" style="border-radius: 6px;">Batal</button>
                    <button type="submit" class="btn btn-sm text-white px-3 fw-semibold shadow-sm" style="border-radius: 6px; background-color: #9a55ff; border: 1px solid #9a55ff;">
                        <i class="mdi mdi-content-save me-1"></i>Simpan & Tugaskan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function switchView(mode) {
        const tableContainer = document.getElementById('viewModeTableContainer');
        const gridContainer = document.getElementById('viewModeGridContainer');
        const btnTable = document.getElementById('btnViewTable');
        const btnGrid = document.getElementById('btnViewGrid');

        if (!tableContainer || !gridContainer) return;

        if (mode === 'grid') {
            tableContainer.classList.add('d-none');
            gridContainer.classList.remove('d-none');
            btnTable.classList.remove('active');
            btnGrid.classList.add('active');
        } else {
            gridContainer.classList.add('d-none');
            tableContainer.classList.remove('d-none');
            btnGrid.classList.remove('active');
            btnTable.classList.add('active');
        }
    }

    function bukaModalSetorTugas(id, title) {
        document.getElementById('setorTaskId').value = id;
        document.getElementById('setorTaskTitle').textContent = title;
        document.getElementById('infoSelectedTask').style.display = 'block';
        document.getElementById('selectTaskGroup').style.display = 'none';

        const modalEl = document.getElementById('modalSetorTugas');
        const modal = new bootstrap.Modal(modalEl);
        modal.show();
    }

    function openModalSetorCepat() {
        const modalEl = document.getElementById('modalSetorTugas');
        const dropdown = document.getElementById('selectTaskDropdown');
        const selectGroup = document.getElementById('selectTaskGroup');
        const infoGroup = document.getElementById('infoSelectedTask');

        if (dropdown && dropdown.options.length > 1) {
            selectGroup.style.display = 'block';
            infoGroup.style.display = 'none';
            document.getElementById('setorTaskId').value = dropdown.options[1].value;
            dropdown.selectedIndex = 1;
        } else {
            selectGroup.style.display = 'none';
            infoGroup.style.display = 'block';
        }

        const modal = new bootstrap.Modal(modalEl);
        modal.show();
    }

    function openModalTambahTugas() {
        const modalEl = document.getElementById('modalTambahTugas');
        const modal = new bootstrap.Modal(modalEl);
        modal.show();
    }
</script>
@endpush
