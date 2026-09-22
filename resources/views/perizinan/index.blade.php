@extends('layouts.partial.app')

@section('title', 'Perizinan Proyek - Property Management App')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-clean.css') }}?v={{ time() }}">
@endpush

@section('content')

<style>
    /* Styling Persis Screenshot Monitoring Perizinan Proyek */
    .stat-card-clean {
        background: #ffffff;
        border-radius: 16px;
        padding: 20px;
        border: 1px solid #f1f5f9;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);
        display: flex;
        align-items: center;
        gap: 16px;
    }
    .stat-icon-box {
        width: 52px;
        height: 52px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 24px;
        font-weight: 700;
        flex-shrink: 0;
    }
    .table-container-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #f1f5f9;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.03);
        padding: 24px;
    }
    .filter-select {
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        padding: 7px 14px;
        font-size: 0.88rem;
        color: #334155;
        background-color: #ffffff;
        outline: none;
    }
    .filter-select:focus {
        border-color: #5046e5;
        box-shadow: 0 0 0 2px rgba(80, 70, 229, 0.15);
    }
    .btn-tambah-izin {
        background-color: #5046e5 !important;
        border: none !important;
        border-radius: 8px !important;
        color: #ffffff !important;
        padding: 8px 18px !important;
        font-size: 0.88rem !important;
        font-weight: 600 !important;
        transition: all 0.2s ease;
    }
    .btn-tambah-izin:hover {
        background-color: #4338ca !important;
        color: #ffffff !important;
    }
    .monitoring-table thead th {
        font-size: 0.82rem;
        font-weight: 600;
        color: #1e293b;
        border-bottom: 1px solid #f1f5f9;
        padding: 14px 16px;
        background: transparent;
    }
    .monitoring-table tbody td {
        font-size: 0.86rem;
        color: #1e293b;
        border-bottom: 1px solid #f8fafc;
        padding: 16px;
        vertical-align: middle;
    }
    .btn-action-edit {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        color: #1e293b;
        border-radius: 6px;
        padding: 4px 14px;
        font-size: 0.82rem;
        font-weight: 500;
        transition: all 0.15s ease;
    }
    .btn-action-edit:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
        color: #0f172a;
    }
    .btn-action-dots {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        color: #64748b;
        border-radius: 6px;
        padding: 4px 9px;
        font-size: 0.85rem;
    }
    .btn-action-dots:hover {
        background: #f8fafc;
        color: #1e293b;
    }

    /* Styling Modal Kelola Dokumen (Lebar Nyaman & Body Scrollable) */
    .fase4-modal-dialog {
        max-width: 580px;
    }
    .modal-dialog-scrollable .modal-body {
        max-height: calc(88vh - 130px);
        overflow-y: auto;
    }
    .modal-dialog-scrollable .modal-body::-webkit-scrollbar {
        width: 6px;
    }
    .modal-dialog-scrollable .modal-body::-webkit-scrollbar-track {
        background: #f8fafc;
    }
    .modal-dialog-scrollable .modal-body::-webkit-scrollbar-thumb {
        background-color: #cbd5e1;
        border-radius: 9999px;
    }
    .modal-dialog-scrollable .modal-body::-webkit-scrollbar-thumb:hover {
        background-color: #94a3b8;
    }
    .syarat-checkbox {
        width: 16px;
        height: 16px;
        accent-color: #00c9a7;
        cursor: pointer;
    }
    .btn-teal {
        background-color: #00c9a7 !important;
        border-color: #00c9a7 !important;
        color: #ffffff !important;
    }
    .btn-teal:hover {
        background-color: #00b395 !important;
        border-color: #00b395 !important;
        color: #ffffff !important;
    }

    /* Table Responsive & Text Wrapping persis show.blade.php */
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
        border-bottom: 2px solid #e2e8f0 !important;
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
    .table-perizinan .col-status {
        width: 95px;
        text-align: center;
        white-space: nowrap !important;
    }
    .table-perizinan .col-aksi {
        width: 105px;
        text-align: center;
        white-space: nowrap !important;
    }

    .status-badge.aktif {
        background-color: #ecfdf5;
        color: #059669;
        border: 1px solid #a7f3d0;
        font-weight: 600;
        border-radius: 6px;
    }
    .badge-development-progress {
        background-color: #fffbeb;
        color: #d97706;
        border: 1px solid #fde68a;
        font-weight: 600;
        border-radius: 6px;
    }
    .badge-development-belum {
        font-weight: 600;
        border-radius: 6px;
    }

    /* Styling Card Tabel Meniru Persis Card Total (.dash-kpi-card) */
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
    .compact-table-card .card-header {
        background: #ffffff !important;
        border-bottom: 1px solid #e2e8f0 !important;
        padding: 0.65rem 1.25rem !important;
        border-top-left-radius: 8px !important;
        border-top-right-radius: 8px !important;
    }
    .compact-table-card .card-body,
    .card.compact-table-card .card-body {
        padding: 0.75rem 1.25rem 1.15rem 1.25rem !important;
        background: #ffffff !important;
    }
    .compact-table-card .filter-card {
        margin-top: 0 !important;
        margin-bottom: 0.6rem !important;
    }
    .compact-table-card .filter-card form {
        margin-bottom: 0 !important;
    }
</style>

<div class="container-fluid px-2 px-md-4 py-3">

    <!-- Page Title & Subtitle -->
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
        <div>
            <h2 class="text-dark mb-1 fw-bold" style="font-size: 1.55rem; letter-spacing: -0.02em;">
                Perizinan Proyek
            </h2>
            <p class="text-muted mb-0" style="font-size: 0.88rem;">
                Daftar dan kelengkapan berkas izin kawasan per proyek properti.
            </p>
        </div>
    </div>

    <!-- 4 KPI Metrics Card Grid (Sama Persis Dashboard) -->
    <div class="dash-kpi-grid mb-4">
        
        <!-- Card 1: Total Izin (Ungu) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon purple">
                    <i class="mdi mdi-file-document-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Total Izin</div>
                    <div class="dash-kpi-val">{{ $totalIzin ?? 0 }}</div>
                    <div class="dash-kpi-sub">Seluruh Izin Terdaftar</div>
                </div>
            </div>
            <div class="dash-kpi-action purple">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>

        <!-- Card 2: Izin Selesai (Hijau) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon green">
                    <i class="mdi mdi-check-circle-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Izin Selesai</div>
                    <div class="dash-kpi-val">{{ $totalSelesai ?? 0 }}</div>
                    <div class="dash-kpi-sub">Dokumen Terbit / Final</div>
                </div>
            </div>
            <div class="dash-kpi-action green">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>

        <!-- Card 3: Dalam Proses (Biru) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon blue">
                    <i class="mdi mdi-progress-clock"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Dalam Proses</div>
                    <div class="dash-kpi-val">{{ $dalamProses ?? 0 }}</div>
                    <div class="dash-kpi-sub">Sedang Diproses Instansi</div>
                </div>
            </div>
            <div class="dash-kpi-action blue">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>

        <!-- Card 4: Tertunda / Kendala (Rose / Merah) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon rose">
                    <i class="mdi mdi-alert-circle-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Tertunda / Kendala</div>
                    <div class="dash-kpi-val">{{ $tertunda ?? 0 }}</div>
                    <div class="dash-kpi-sub">Perlu Tindak Lanjut / Revisi</div>
                </div>
            </div>
            <div class="dash-kpi-action rose">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>

    </div>

    <!-- Main Container: Table & Filters (Sama Persis Format Rincian show.blade.php) -->
    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card compact-table-card" style="background: #ffffff !important; border: 1px solid #e2e8f0 !important; border-radius: 8px !important; box-shadow: none !important;">
                <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2" style="padding: 0.65rem 1.25rem !important; border-bottom: 1px solid #e2e8f0 !important;">
                    <div class="d-flex align-items-center gap-2">
                        <div style="width: 32px; height: 32px; border-radius: 6px; background-color: #f3e8ff; color: #9333ea; display: inline-flex; align-items: center; justify-content: center; font-size: 1.15rem; flex-shrink: 0;">
                            <i class="mdi mdi-format-list-bulleted"></i>
                        </div>
                        <span style="font-size: 0.95rem; font-weight: 700; color: #0f172a;">Daftar Tanah / Proyek Kawasan</span>
                    </div>
                </div>

                <div class="card-body" style="padding: 0.75rem 1.25rem 1.15rem 1.25rem !important;">
                    <!-- Filter Toolbar -->
                    <div class="filter-card" style="margin-top: 0 !important; margin-bottom: 0.6rem !important;">
                        <form id="filterForm" method="GET" action="{{ route('perizinan.index') }}" style="margin-bottom: 0 !important;">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                    <!-- Search Input -->
                                    <div style="min-width: 240px; max-width: 360px; flex: 1;">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" id="liveSearchInput"
                                                placeholder="Cari nama proyek, lokasi, status tanah..."
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

                                    <!-- Filter Status -->
                                    <div style="width: 160px;">
                                        <select class="form-control" name="status" id="statusFilterSelect" onchange="document.getElementById('filterForm').submit()">
                                            <option value="all">Semua Status</option>
                                            <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                            <option value="Berjalan" {{ request('status') == 'Berjalan' ? 'selected' : '' }}>Berjalan</option>
                                            <option value="Tertunda" {{ request('status') == 'Tertunda' ? 'selected' : '' }}>Tertunda</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Reset Button -->
                                <div class="d-flex align-items-center gap-2 ms-auto">
                                    <button type="submit" class="btn btn-gradient-primary btn-icon-only" title="Terapkan Filter">
                                        <i class="mdi mdi-filter"></i>
                                    </button>
                                    <a href="{{ route('perizinan.index') }}" class="btn btn-gradient-secondary btn-icon-only" title="Reset Filter">
                                        <i class="mdi mdi-refresh"></i>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- TABEL DATA BANK BERSIH (MURNI TABEL PERSIS SHOW) -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle table-perizinan">
                            <thead>
                                <tr>
                                    <th class="col-no">No</th>
                                    <th>Nama Proyek & Perusahaan</th>
                                    <th>Status Tanah</th>
                                    <th>Lokasi</th>
                                    <th>Luas Lahan</th>
                                    <th style="width: 130px;">Progres</th>
                                    <th class="col-status text-center">Status</th>
                                    <th class="col-aksi text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($projects as $index => $proj)
                                    @php
                                        $pVal = $proj['progress'] ?? 0;
                                        $st = $proj['status'] ?? 'Belum';
                                        if ($st == 'Selesai' || $st == 'Terbit') {
                                            $stLabel = 'Selesai';
                                        } elseif ($st == 'Berjalan' || $st == 'Proses') {
                                            $stLabel = 'Berjalan';
                                        } elseif ($st == 'Tertunda' || $st == 'Revisi') {
                                            $stLabel = 'Tertunda';
                                        } else {
                                            $stLabel = 'Belum';
                                        }

                                        if ($pVal >= 100) {
                                            $pColor = '#10b981';
                                        } elseif ($pVal >= 70) {
                                            $pColor = '#7c3aed';
                                        } elseif ($pVal >= 40) {
                                            $pColor = '#0284c7';
                                        } else {
                                            $pColor = '#e11d48';
                                        }
                                    @endphp
                                    <tr class="project-table-row" id="row_project_{{ $proj['id'] }}" data-search="{{ strtolower($proj['nama'] . ' ' . ($proj['lokasi'] ?? '') . ' ' . ($proj['ownership_status'] ?? '')) }}">
                                        <td class="col-no fw-bold text-center">{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="fw-bold text-dark" style="line-height: 1.35; font-size: 0.85rem;">
                                                {{ $proj['nama'] }}
                                            </div>
                                            <div class="text-secondary mt-0.5" style="font-size: 0.78rem; line-height: 1.3;">
                                                {{ $proj['pt'] ?? 'PT Graha Cipta Sejahtera' }}
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-primary border font-monospace fw-bold" style="font-size: 0.76rem;">
                                                {{ $proj['ownership_status'] ?? 'SHGB Induk' }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-muted" style="font-size: 0.82rem;">
                                                {{ $proj['lokasi'] }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark border fw-medium" style="font-size: 0.78rem;">
                                                {{ $proj['luas'] }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2" style="width: 100%;">
                                                <div style="flex-grow: 1; background-color: #f1f5f9; border-radius: 9999px; height: 6px; overflow: hidden;">
                                                    <div style="width: {{ $pVal }}%; background-color: {{ $pColor }}; height: 100%; border-radius: 9999px;"></div>
                                                </div>
                                                <span style="font-size: 0.75rem; font-weight: 700; color: #334155;">{{ $pVal }}%</span>
                                            </div>
                                        </td>
                                        <td class="col-status text-center">
                                            @if($stLabel == 'Selesai')
                                                <span class="status-badge aktif" style="padding: 3px 8px; font-size: 0.75rem;">Selesai</span>
                                            @elseif($stLabel == 'Berjalan')
                                                <span class="badge-development-progress" style="padding: 3px 8px; font-size: 0.75rem;">Berjalan</span>
                                            @elseif($stLabel == 'Tertunda')
                                                <span class="badge-development-belum" style="background-color: #fee2e2; color: #b91c1c; border-color: #fecdd3; padding: 3px 8px; font-size: 0.75rem;">Tertunda</span>
                                            @else
                                                <span class="badge-development-belum" style="background-color: #f1f5f9; color: #64748b; border-color: #e2e8f0; padding: 3px 8px; font-size: 0.75rem;">Belum</span>
                                            @endif
                                        </td>
                                        <td class="col-aksi text-center">
                                            <!-- Tombol Tunggal Aksi Langsung: Kelola -->
                                            <a href="{{ route('perizinan.show', $proj['id']) }}" class="btn btn-sm btn-gradient-primary d-inline-flex align-items-center py-1 px-2.5 fw-semibold shadow-sm text-decoration-none" style="font-size: 0.76rem; border-radius: 5px;">
                                                <i class="mdi mdi-file-document-edit-outline" style="margin-right: 6px !important; font-size: 0.85rem;"></i>
                                                <span>Kelola</span>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-4">
                                            <i class="mdi mdi-domain-off me-2" style="font-size: 1.5rem;"></i>
                                            Tidak ada data proyek kawasan.
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

<!-- ================= MODAL KELOLA DOKUMEN (PERSIS SCREENSHOT FASE 4) ================= -->
<div class="modal fade" id="modalKelolaDokumen" tabindex="-1" aria-labelledby="modalKelolaDokumenLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable fase4-modal-dialog">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">

            <!-- Header Modal -->
            <div class="modal-header px-4 py-3 bg-white border-bottom align-items-center">
                <div class="d-flex align-items-center gap-2">
                    <i class="mdi mdi-file-document-edit-outline text-primary" style="font-size: 1.3rem;"></i>
                    <h5 class="modal-title fw-bold text-dark mb-0" id="modalKelolaDokumenLabel" style="font-size: 1.05rem;">
                        Kelola Dokumen Perizinan
                    </h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body Modal: Form Persis Screenshot -->
            <div class="modal-body px-4 py-3 bg-white">
                <form id="formKelolaDokumen">
                    <input type="hidden" id="modalPermitId" name="permit_id">

                    <!-- Baris Atas: Badge Poin & Judul & Badge Status Belum Ada -->
                    <div class="d-flex align-items-start justify-content-between mb-3">
                        <div>
                            <span class="badge py-1 px-2 mb-1" id="modalPoinBadge"
                                style="background-color: #f3e8ff; color: #7e22ce; font-size: 0.72rem; font-weight: 700; border-radius: 4px;">
                                Poin 12
                            </span>
                            <h6 class="fw-bold text-dark mb-0" id="modalNamaIzin" style="font-size: 0.98rem; line-height: 1.3;">
                                Rekomendasi Peil Banjir
                            </h6>
                        </div>
                        <div>
                            <span class="badge py-1 px-2.5" id="modalStatusBadgeTop"
                                style="background-color: #ffffff; color: #64748b; border: 1px solid #cbd5e1; font-size: 0.75rem; font-weight: 600; border-radius: 6px;">
                                Belum Ada
                            </span>
                        </div>
                    </div>

                    <!-- Status Dokumen Select -->
                    <div class="mb-3">
                        <label class="form-label text-dark fw-semibold mb-1" style="font-size: 0.8rem;">Status Dokumen</label>
                        <select class="form-select form-select-sm" id="modalStatusSelect" onchange="updateModalStatusBadge(this.value)"
                            style="border-radius: 6px; border-color: #cbd5e1; font-size: 0.85rem; padding: 6px 10px;">
                            <option value="Belum">Belum Ada</option>
                            <option value="Berjalan">Berjalan / Proses</option>
                            <option value="Selesai">Selesai / Terbit</option>
                            <option value="Tertunda">Tertunda / Kendala</option>
                        </select>
                    </div>

                    <!-- 2 Kolom: Nomor Dokumen / SK & Tanggal -->
                    <div class="row g-2 mb-3">
                        <div class="col-7">
                            <label class="form-label text-dark fw-semibold mb-1" style="font-size: 0.8rem;">Nomor Dokumen / SK</label>
                            <input type="text" class="form-control form-control-sm" id="modalNoIzin"
                                placeholder="Nomor resmi SK/Registrasi"
                                style="border-radius: 6px; border-color: #cbd5e1; font-size: 0.83rem; padding: 6px 10px;">
                        </div>
                        <div class="col-5">
                            <label class="form-label text-dark fw-semibold mb-1" style="font-size: 0.8rem;">Tanggal</label>
                            <input type="date" class="form-control form-control-sm" id="modalTanggal"
                                style="border-radius: 6px; border-color: #cbd5e1; font-size: 0.83rem; padding: 6px 10px;">
                        </div>
                    </div>

                    <!-- KONDISI 1: JIKA BELUM ADA FILE -> BOX UPLOAD UNGU -->
                    <div id="boxUploadBelumAda" class="mb-3">
                        <div class="p-3 text-center" 
                            style="border: 1.5px dashed #c084fc; background: #faf5ff; border-radius: 8px; cursor: pointer;"
                            onclick="document.getElementById('fileInputDokumen').click()">
                            <i class="mdi mdi-cloud-upload-outline d-block mb-1" style="font-size: 1.8rem; color: #9333ea;"></i>
                            <div class="fw-semibold text-primary mb-1" style="font-size: 0.82rem; color: #7e22ce !important;">
                                Pilih / Upload Berkas (PDF, JPG, PNG Maks 20MB)
                            </div>
                            <span class="badge" style="background-color: #e9d5ff; color: #6b21a8; font-size: 0.68rem; font-weight: 600;">
                                Format PDF/JPG/PNG
                            </span>
                            <input type="file" id="fileInputDokumen" style="display: none;" onchange="handleFileDokumenChosen(this)">
                        </div>
                    </div>

                    <!-- KONDISI 2: JIKA SUDAH ADA FILE -> BOX HIJAU BERKAS TERUNGGAH -->
                    <div id="boxBerkasTerunggah" class="mb-3" style="display: none;">
                        <div class="p-2.5 px-3 d-flex align-items-center justify-content-between"
                            style="background-color: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 8px;">
                            <div class="d-flex align-items-center gap-2">
                                <div class="rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 28px; height: 28px; background-color: #dcfce7; color: #16a34a;">
                                    <i class="mdi mdi-file-check-outline" style="font-size: 1.1rem;"></i>
                                </div>
                                <div>
                                    <div class="fw-bold text-success mb-0" style="font-size: 0.82rem;">Berkas Terunggah</div>
                                    <small class="text-muted" id="modalFileNameText" style="font-size: 0.72rem;">dokumen_resmi.pdf</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-1.5">
                                <a href="javascript:void(0)" id="modalBtnLihatBerkas" target="_blank"
                                    class="btn btn-sm btn-outline-success px-2 py-0.5 fw-semibold"
                                    style="font-size: 0.75rem; border-radius: 4px;">
                                    <i class="mdi mdi-eye-outline me-1"></i>Lihat Berkas
                                </a>
                                <button type="button" class="btn btn-sm btn-link text-secondary p-0 ms-1"
                                    title="Ganti Berkas" onclick="document.getElementById('fileInputDokumen').click()">
                                    <i class="mdi mdi-pencil" style="font-size: 0.95rem;"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Card Box: Rincian & Prasyarat (Expandable Accordion) -->
                    <div class="border rounded-2 p-2.5 mb-3" style="background-color: #f8fafc; border-color: #e2e8f0 !important;">
                        <div class="d-flex align-items-center justify-content-between" style="cursor: pointer;" onclick="togglePrasyaratAccordion()">
                            <div class="d-flex align-items-center gap-2">
                                <span class="fw-bold text-dark" style="font-size: 0.84rem;">Rincian & Prasyarat</span>
                                <span class="badge py-0.5 px-2" id="badgeSyaratCounter"
                                    style="background-color: #e2e8f0; color: #475569; font-size: 0.72rem; font-weight: 700; border-radius: 4px;">
                                    0/3 Siap
                                </span>
                            </div>
                            <button type="button" class="btn btn-sm py-0.5 px-2.5 fw-semibold" id="btnToggleSyarat"
                                style="background-color: #f3e8ff; color: #7e22ce; font-size: 0.72rem; border-radius: 4px; border: 1px solid #e9d5ff;">
                                Buka
                            </button>
                        </div>

                        <!-- Konten Dropdown Accordion Persyaratan & Upload Per Item (PERSIS SCREENSHOT) -->
                        <div id="collapsePrasyaratList" style="display: none;" class="mt-2.5 pt-2 border-top">
                            <!-- Header Breakdown Persis Screenshot -->
                            <div class="d-flex align-items-center justify-content-between mb-2.5 pt-1 px-1">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="mdi mdi-format-list-bulleted" style="color: #9333ea; font-size: 1.15rem;"></i>
                                    <span class="fw-bold text-dark" style="font-size: 0.88rem;">Checklist Prasyarat Berkas:</span>
                                </div>
                                <span class="badge text-white px-2 py-1" id="badgeSiapCounter"
                                    style="background-color: #a8a29e; font-size: 0.75rem; border-radius: 4px; font-weight: 700;">
                                    0/3 Siap
                                </span>
                            </div>

                            <!-- List Card Prasyarat dengan Form Upload Persis Gambar -->
                            <div id="listSyaratContainer" class="d-flex flex-column gap-2">
                                <!-- Generated dynamically via JavaScript -->
                            </div>
                        </div>
                    </div>

                </form>
            </div>

            <!-- Modal Footer Fixed di Bawah (Body modal yang di-scroll) -->
            <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex align-items-center justify-content-between">
                <button type="button" class="btn btn-teal d-inline-flex align-items-center gap-1.5 px-3.5 py-2 fw-semibold shadow-sm"
                    onclick="simpanDokumen()" style="font-size: 0.84rem; border-radius: 6px;">
                    <i class="mdi mdi-content-save-outline"></i>
                    <span>Simpan Dokumen</span>
                </button>
                <button type="button" class="btn d-inline-flex align-items-center gap-1 px-3.5 py-2 fw-semibold"
                    data-bs-dismiss="modal"
                    style="background-color: #f1f5f9; color: #475569; border: 1px solid #cbd5e1; font-size: 0.84rem; border-radius: 6px;">
                    <i class="mdi mdi-close"></i>
                    <span>Batal</span>
                </button>
            </div>

        </div>
    </div>
</div>

@push('scripts')
<script>
    let activePermitData = null;
    let modalInstance = null;

    document.addEventListener('DOMContentLoaded', function() {
        const modalEl = document.getElementById('modalKelolaDokumen');
        if (modalEl && typeof bootstrap !== 'undefined') {
            modalInstance = new bootstrap.Modal(modalEl);
        }
    });

    // Buka Modal Kelola Dokumen dengan data item
    function bukaModalKelola(item) {
        activePermitData = item;

        if (!modalInstance) {
            const modalEl = document.getElementById('modalKelolaDokumen');
            modalInstance = new bootstrap.Modal(modalEl);
        }

        if (item) {
            document.getElementById('modalPermitId').value = item.id;
            document.getElementById('modalPoinBadge').innerText = item.poin_label || 'Poin 1';
            document.getElementById('modalNamaIzin').innerText = item.nama_izin || 'Nama Perizinan';
            document.getElementById('modalStatusSelect').value = item.status || 'Belum';
            document.getElementById('modalNoIzin').value = item.no_izin && item.no_izin !== 'Nomor resmi SK/Registrasi' ? item.no_izin : '';
            document.getElementById('modalTanggal').value = item.tanggal || '';

            updateModalStatusBadge(item.status || 'Belum');

            // Cek file dokumen utama
            if (item.file_dokumen) {
                document.getElementById('boxUploadBelumAda').style.display = 'none';
                document.getElementById('boxBerkasTerunggah').style.display = 'block';
                document.getElementById('modalFileNameText').innerText = item.file_dokumen;
                document.getElementById('modalBtnLihatBerkas').href = '/storage/' + item.file_dokumen;
            } else {
                document.getElementById('boxUploadBelumAda').style.display = 'block';
                document.getElementById('boxBerkasTerunggah').style.display = 'none';
            }

            // Render daftar rincian & prasyarat
            renderSyaratList(item.syarat_items || []);
        } else {
            // Mode Tambah Izin Baru
            document.getElementById('modalPermitId').value = '';
            document.getElementById('modalPoinBadge').innerText = 'Poin Baru';
            document.getElementById('modalNamaIzin').innerText = 'Pengajuan Izin Baru';
            document.getElementById('modalStatusSelect').value = 'Belum';
            document.getElementById('modalNoIzin').value = '';
            document.getElementById('modalTanggal').value = '';
            updateModalStatusBadge('Belum');
            document.getElementById('boxUploadBelumAda').style.display = 'block';
            document.getElementById('boxBerkasTerunggah').style.display = 'none';
            renderSyaratList([
                'KTP & NPWP Pemohon',
                'Surat Permohonan Resmi',
                'Kelengkapan Berkas Teknis'
            ]);
        }

        modalInstance.show();
    }

    // Toggle Tampilan Badge Status di Kanan Atas Modal
    function updateModalStatusBadge(status) {
        const badge = document.getElementById('modalStatusBadgeTop');
        if (status === 'Selesai' || status === 'Terbit') {
            badge.style.backgroundColor = '#dcfce7';
            badge.style.color = '#15803d';
            badge.style.border = '1px solid #bbf7d0';
            badge.innerText = 'Selesai';
        } else if (status === 'Berjalan' || status === 'Proses') {
            badge.style.backgroundColor = '#e0f2fe';
            badge.style.color = '#0369a1';
            badge.style.border = '1px solid #bae6fd';
            badge.innerText = 'Berjalan';
        } else if (status === 'Tertunda' || status === 'Revisi') {
            badge.style.backgroundColor = '#fee2e2';
            badge.style.color = '#b91c1c';
            badge.style.border = '1px solid #fecdd3';
            badge.innerText = 'Tertunda';
        } else {
            badge.style.backgroundColor = '#ffffff';
            badge.style.color = '#64748b';
            badge.style.border = '1px solid #cbd5e1';
            badge.innerText = 'Belum Ada';
        }
    }

    // Toggle Dropdown Accordion Prasyarat
    function togglePrasyaratAccordion() {
        const collapseEl = document.getElementById('collapsePrasyaratList');
        const btnToggle = document.getElementById('btnToggleSyarat');
        if (collapseEl.style.display === 'none' || collapseEl.style.display === '') {
            collapseEl.style.display = 'block';
            btnToggle.innerText = 'Tutup';
            btnToggle.style.backgroundColor = '#e2e8f0';
            btnToggle.style.color = '#475569';
        } else {
            collapseEl.style.display = 'none';
            btnToggle.innerText = 'Buka';
            btnToggle.style.backgroundColor = '#f3e8ff';
            btnToggle.style.color = '#7e22ce';
        }
    }

    // Render Checklist Prasyarat dengan Form Upload per Item (Persis Screenshot)
    let uploadedSyaratState = {};

    function renderSyaratList(syaratItems) {
        const container = document.getElementById('listSyaratContainer');
        container.innerHTML = '';
        const total = syaratItems.length;
        uploadedSyaratState = {};

        syaratItems.forEach((syarat, idx) => {
            uploadedSyaratState[idx] = false;
            const card = document.createElement('div');
            card.className = 'border bg-white mb-2.5 p-3';
            card.style.borderRadius = '10px';
            card.style.borderColor = '#e2e8f0';
            card.id = `syarat_card_${idx}`;
            card.innerHTML = `
                <!-- Judul Syarat -->
                <div class="fw-bold text-dark mb-2" style="font-size: 0.88rem; line-height: 1.35;">
                    ${syarat}
                </div>

                <!-- Box Upload Tunggal (Tanpa box berkas terunggah terpisah) -->
                <div id="syarat_box_upload_${idx}" class="p-2.5 px-3 d-flex align-items-center justify-content-between"
                     style="border: 1.5px dashed #c084fc; background: #faf5ff; border-radius: 8px; cursor: pointer; transition: all 0.2s ease;"
                     onclick="document.getElementById('input_file_syarat_${idx}').click()">
                    <div class="d-flex align-items-center gap-3">
                        <div id="syarat_circle_${idx}" class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                             style="width: 38px; height: 38px; background-color: #f3e8ff; color: #a855f7;">
                            <i id="syarat_icon_${idx}" class="mdi mdi-cloud-upload" style="font-size: 1.25rem;"></i>
                        </div>
                        <div>
                            <div id="syarat_title_${idx}" class="fw-bold mb-0" style="color: #9333ea; font-size: 0.84rem; line-height: 1.2;">
                                Pilih / Upload Berkas
                            </div>
                            <small id="syarat_sub_${idx}" class="text-muted" style="font-size: 0.72rem; line-height: 1.2;">PDF, JPG, PNG (Maks 20MB)</small>
                        </div>
                    </div>
                    <div id="syarat_actions_${idx}" style="display: none;" class="d-flex align-items-center gap-2" onclick="event.stopPropagation()">
                        <a href="javascript:void(0)" id="syarat_btn_view_${idx}" target="_blank"
                           class="btn btn-sm btn-outline-success px-2.5 py-1 fw-semibold" style="font-size: 0.75rem; border-radius: 4px;">
                           <i class="mdi mdi-eye-outline me-1"></i>Lihat
                        </a>
                        <button type="button" class="btn btn-sm btn-link text-danger p-0"
                                title="Hapus Berkas" onclick="removeSyaratFile(${idx}, ${total})">
                            <i class="mdi mdi-trash-can-outline" style="font-size: 1.1rem;"></i>
                        </button>
                    </div>
                    <input type="file" id="input_file_syarat_${idx}" style="display: none;" onchange="handleSyaratUploaded(this, ${idx}, ${total})">
                </div>
            `;
            container.appendChild(card);
        });

        updateSyaratCount(total);
    }

    // Handle Upload File Persyaratan Item
    function handleSyaratUploaded(input, idx, total) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            uploadedSyaratState[idx] = true;
            
            const box = document.getElementById(`syarat_box_upload_${idx}`);
            box.style.borderColor = '#86efac';
            box.style.background = '#f0fdf4';
            
            const circle = document.getElementById(`syarat_circle_${idx}`);
            circle.style.backgroundColor = '#dcfce7';
            circle.style.color = '#16a34a';
            
            const icon = document.getElementById(`syarat_icon_${idx}`);
            icon.className = 'mdi mdi-file-check';
            
            const title = document.getElementById(`syarat_title_${idx}`);
            title.textContent = file.name;
            title.style.color = '#16a34a';
            
            const sub = document.getElementById(`syarat_sub_${idx}`);
            sub.textContent = 'Berkas siap & valid • Klik untuk ganti';
            
            const actions = document.getElementById(`syarat_actions_${idx}`);
            actions.style.display = 'flex';
            document.getElementById(`syarat_btn_view_${idx}`).href = URL.createObjectURL(file);
            
            updateSyaratCount(total);
        }
    }

    // Remove File Persyaratan Item
    function removeSyaratFile(idx, total) {
        uploadedSyaratState[idx] = false;
        
        const box = document.getElementById(`syarat_box_upload_${idx}`);
        box.style.borderColor = '#c084fc';
        box.style.background = '#faf5ff';
        
        const circle = document.getElementById(`syarat_circle_${idx}`);
        circle.style.backgroundColor = '#f3e8ff';
        circle.style.color = '#a855f7';
        
        const icon = document.getElementById(`syarat_icon_${idx}`);
        icon.className = 'mdi mdi-cloud-upload';
        
        const title = document.getElementById(`syarat_title_${idx}`);
        title.textContent = 'Pilih / Upload Berkas';
        title.style.color = '#9333ea';
        
        const sub = document.getElementById(`syarat_sub_${idx}`);
        sub.textContent = 'PDF, JPG, PNG (Maks 20MB)';
        
        const actions = document.getElementById(`syarat_actions_${idx}`);
        actions.style.display = 'none';
        
        document.getElementById(`input_file_syarat_${idx}`).value = '';
        updateSyaratCount(total);
    }

    // Hitung Ulang Badge Counter Persyaratan (0/3 Siap)
    function updateSyaratCount(total) {
        let count = 0;
        for (let key in uploadedSyaratState) {
            if (uploadedSyaratState[key] === true) count++;
        }

        const siapText = `${count}/${total} Siap`;
        const badgeSiap = document.getElementById('badgeSiapCounter');
        const badgeAccordion = document.getElementById('badgeSyaratCounter');

        if (badgeSiap) {
            badgeSiap.innerText = siapText;
            if (count === total && total > 0) {
                badgeSiap.style.backgroundColor = '#10b981';
            } else {
                badgeSiap.style.backgroundColor = '#a8a29e';
            }
        }

        if (badgeAccordion) {
            badgeAccordion.innerText = siapText;
            if (count === total && total > 0) {
                badgeAccordion.style.backgroundColor = '#dcfce7';
                badgeAccordion.style.color = '#15803d';
            } else {
                badgeAccordion.style.backgroundColor = '#e2e8f0';
                badgeAccordion.style.color = '#475569';
            }
        }
    }

    // Handle Upload Berkas Dokumen Utama
    function handleFileDokumenChosen(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            document.getElementById('boxUploadBelumAda').style.display = 'none';
            document.getElementById('boxBerkasTerunggah').style.display = 'block';
            document.getElementById('modalFileNameText').innerText = file.name;
            document.getElementById('modalBtnLihatBerkas').href = URL.createObjectURL(file);
        }
    }

    // Simpan Dokumen
    function simpanDokumen() {
        const noIzin = document.getElementById('modalNoIzin').value;
        const status = document.getElementById('modalStatusSelect').value;
        
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                icon: 'success',
                title: 'Dokumen Berhasil Disimpan',
                text: 'Status dan kelengkapan perizinan telah diperbarui!',
                timer: 1500,
                showConfirmButton: false
            }).then(() => {
                modalInstance.hide();
            });
        } else {
            alert('Dokumen berhasil disimpan!');
            modalInstance.hide();
        }
    }

    // Hapus Dokumen
    function hapusDokumen() {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Hapus Dokumen?',
                text: 'Dokumen dan berkas persyaratan akan dihapus dari perizinan ini.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e11d48',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Terhapus!', 'Dokumen telah dihapus.', 'success');
                    modalInstance.hide();
                }
            });
        } else {
            if (confirm('Yakin ingin menghapus dokumen perizinan ini?')) {
                modalInstance.hide();
            }
        }
    }
    // Live Search Filter Tabel Proyek
    function applyLiveSearch(query) {
        var filter = query.toLowerCase();
        var rows = document.querySelectorAll('.project-table-row');
        rows.forEach(function(row) {
            var text = row.getAttribute('data-search') || row.innerText.toLowerCase();
            if (text.toLowerCase().indexOf(filter) > -1) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
</script>
@endpush

@endsection
