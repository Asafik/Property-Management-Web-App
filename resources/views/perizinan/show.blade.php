@extends('layouts.partial.app')

@section('title', 'Kelola Perizinan: ' . $project['nama'] . ' - Property Management App')

@section('content')

<style>
    /* Styling Modal Kelola Dokumen & Persyaratan (Lebar Nyaman & Body Scrollable) */
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

    /* Table Responsive & Text Wrapping agar Pas dengan Layar */
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
        white-space: normal !important; /* Timpa white-space: nowrap bawaan theme */
    }
    .table-perizinan .col-no {
        width: 45px;
        text-align: center;
        white-space: nowrap !important;
    }
    .table-perizinan .col-nama {
        min-width: 250px;
    }
    .table-perizinan .col-no-sk {
        width: 170px;
    }
    .table-perizinan .col-tgl {
        width: 130px;
        white-space: nowrap !important;
    }
    .table-perizinan .col-status {
        width: 90px;
        text-align: center;
        white-space: nowrap !important;
    }
    .table-perizinan .col-progres {
        width: 130px;
        white-space: nowrap !important;
    }
    .table-perizinan .col-aksi {
        width: 105px;
        text-align: center;
        white-space: nowrap !important;
    }
</style>

<div class="container-fluid px-1 px-sm-2 px-md-3 py-2 py-md-3">

    <!-- Top Navigation: Kembali ke Daftar Proyek -->
    <div class="d-flex align-items-center justify-content-between mb-3">
        <a href="{{ route('perizinan.index') }}" class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center gap-1.5 px-3 py-1.5 shadow-sm" style="border-radius: 6px; font-weight: 600;">
            <i class="mdi mdi-arrow-left"></i>
            <span>Kembali ke Daftar Proyek</span>
        </a>

        <span class="badge bg-light text-primary border px-2.5 py-1.5 fw-bold" style="font-size: 0.8rem;">
            <i class="mdi mdi-domain me-1"></i>{{ $project['nama'] }}
        </span>
    </div>

    <!-- Header Card Banner Kawasan -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 header-card">
                <div class="card-body p-4 p-md-4 py-4 py-md-4 d-flex justify-content-between align-items-center" style="min-height: 105px;">
                    <div>
                        <h3 class="text-dark mb-1 fw-bold" style="font-size: 1.35rem;">
                            Perizinan Kawasan: {{ $project['nama'] }}
                        </h3>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">
                            {{ $project['pt'] }} &bull; {{ $project['lokasi'] }} &bull; Luas: {{ $project['luas'] }} ({{ $project['ownership_status'] }})
                        </p>
                    </div>
                    <div class="d-none d-sm-block pe-2">
                        <i class="mdi mdi-file-certificate-outline" style="font-size: 3rem; color: #9a55ff; opacity: 0.25;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 4 KPI Metrics Card Proyek Ini -->
    <div class="row g-2 g-md-3 mb-3">
        <div class="col-6 col-md-3">
            <div class="card shadow-sm border-0 h-100 p-3 bg-white" style="border-radius: 8px;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted text-uppercase fw-bold" style="font-size: 0.68rem;">Total Dokumen Izin</small>
                        <h4 class="fw-bold text-dark mb-0 mt-1">{{ $totalIzin }}</h4>
                    </div>
                    <div class="p-2 rounded-2" style="background: #eff6ff; color: #2563eb;">
                        <i class="mdi mdi-file-document-multiple-outline fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card shadow-sm border-0 h-100 p-3 bg-white" style="border-radius: 8px;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted text-uppercase fw-bold" style="font-size: 0.68rem;">Izin Terbit & Sah</small>
                        <h4 class="fw-bold text-success mb-0 mt-1">{{ $totalTerbit }}</h4>
                    </div>
                    <div class="p-2 rounded-2" style="background: #ecfdf5; color: #059669;">
                        <i class="mdi mdi-check-decagram-outline fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card shadow-sm border-0 h-100 p-3 bg-white" style="border-radius: 8px;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted text-uppercase fw-bold" style="font-size: 0.68rem;">Sedang Proses Dinas</small>
                        <h4 class="fw-bold text-warning mb-0 mt-1">{{ $totalProses }}</h4>
                    </div>
                    <div class="p-2 rounded-2" style="background: #fffbeb; color: #d97706;">
                        <i class="mdi mdi-clock-outline fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card shadow-sm border-0 h-100 p-3 bg-white" style="border-radius: 8px;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted text-uppercase fw-bold" style="font-size: 0.68rem;">Perlu Revisi / Kendala</small>
                        <h4 class="fw-bold text-danger mb-0 mt-1">{{ $totalRevisi }}</h4>
                    </div>
                    <div class="p-2 rounded-2" style="background: #fef2f2; color: #dc2626;">
                        <i class="mdi mdi-alert-circle-outline fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Container: Dokumen Perizinan Proyek (MURNI TABEL GAYA DATA BANK) -->
    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2 py-3">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-format-list-bulleted me-2"></i>Rincian Dokumen Perizinan Kawasan
                    </h5>
                    <button type="button" class="btn btn-sm btn-gradient-primary d-flex align-items-center gap-1 shadow-sm" onclick="bukaModalKelola(null)">
                        <i class="mdi mdi-plus-circle" style="font-size: 1rem;"></i>
                        <span>Tambah Dokumen Izin</span>
                    </button>
                </div>

                <div class="card-body">
                    <!-- Filter Toolbar -->
                    <div class="filter-card mb-3">
                        <form id="filterForm" method="GET" action="{{ route('perizinan.show', $project['id']) }}">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                    <!-- Search Input -->
                                    <div style="min-width: 240px; max-width: 360px; flex: 1;">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" id="liveSearchInput"
                                                placeholder="Cari nama izin, instansi, nomor SK..."
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
                                            <option value="Terbit" {{ request('status') == 'Terbit' ? 'selected' : '' }}>Terbit</option>
                                            <option value="Proses" {{ request('status') == 'Proses' ? 'selected' : '' }}>Proses</option>
                                            <option value="Revisi" {{ request('status') == 'Revisi' ? 'selected' : '' }}>Revisi</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Reset Button -->
                                <div class="d-flex align-items-center gap-2 ms-auto">
                                    <button type="submit" class="btn btn-gradient-primary btn-icon-only" title="Terapkan Filter">
                                        <i class="mdi mdi-filter"></i>
                                    </button>
                                    <a href="{{ route('perizinan.show', $project['id']) }}" class="btn btn-gradient-secondary btn-icon-only" title="Reset Filter">
                                        <i class="mdi mdi-refresh"></i>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- TABEL DATA BANK BERSIH (MURNI TABEL) -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle table-perizinan">
                            <thead>
                                <tr>
                                    <th class="col-no">No</th>
                                    <th class="col-nama">Nama Perizinan & Instansi</th>
                                    <th class="col-no-sk">Nomor Izin / SK</th>
                                    <th class="col-tgl">Target / Tgl</th>
                                    <th class="col-status">Status</th>
                                    <th class="col-progres">Progres</th>
                                    <th class="col-aksi">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($permits as $index => $item)
                                    @php
                                        $pVal = $item['progress'];
                                        if ($pVal >= 100) {
                                            $pColor = '#10b981'; // Green
                                        } elseif ($pVal >= 70) {
                                            $pColor = '#7c3aed'; // Purple
                                        } elseif ($pVal >= 40) {
                                            $pColor = '#0284c7'; // Blue
                                        } else {
                                            $pColor = '#e11d48'; // Rose
                                        }
                                    @endphp
                                    <tr class="permit-table-row" id="row_permit_{{ $item['id'] }}" data-search="{{ strtolower($item['nama_izin'] . ' ' . $item['instansi'] . ' ' . $item['no_izin']) }}">
                                        <td class="col-no fw-bold text-center">{{ $loop->iteration }}</td>
                                        <td class="col-nama">
                                            <div class="fw-bold text-dark" style="line-height: 1.35; font-size: 0.85rem;">
                                                {{ $item['nama_izin'] }}
                                            </div>
                                            <div class="text-secondary mt-0.5" style="font-size: 0.78rem; line-height: 1.3;">
                                                {{ $item['instansi'] }}
                                            </div>
                                        </td>
                                        <td class="col-no-sk">
                                            @if($item['no_izin'])
                                                <span class="badge bg-light text-dark px-2 py-1 border font-monospace text-wrap" style="font-size: 0.75rem; word-break: break-all; line-height: 1.25;">
                                                    {{ $item['no_izin'] }}
                                                </span>
                                            @else
                                                <span class="text-muted" style="font-size: 0.78rem;">-</span>
                                            @endif
                                        </td>
                                        <td class="col-tgl">
                                            <span class="text-muted" style="font-size: 0.8rem;">
                                                {{ $item['tanggal'] }}
                                            </span>
                                        </td>
                                        <td class="col-status text-center">
                                            @if($item['status'] == 'Terbit' || $item['status'] == 'Selesai')
                                                <span class="status-badge aktif" style="padding: 3px 8px; font-size: 0.75rem;">Terbit</span>
                                            @elseif($item['status'] == 'Proses' || $item['status'] == 'Berjalan')
                                                <span class="badge-development-progress" style="padding: 3px 8px; font-size: 0.75rem;">Proses</span>
                                            @elseif($item['status'] == 'Tertunda' || $item['status'] == 'Revisi')
                                                <span class="badge-development-belum" style="background-color: #fee2e2; color: #b91c1c; border-color: #fecdd3; padding: 3px 8px; font-size: 0.75rem;">Revisi</span>
                                            @else
                                                <span class="badge-development-belum" style="background-color: #f1f5f9; color: #64748b; border-color: #e2e8f0; padding: 3px 8px; font-size: 0.75rem;">Belum</span>
                                            @endif
                                        </td>
                                        <td class="col-progres">
                                            <div class="d-flex align-items-center gap-2" style="width: 100%;">
                                                <div style="flex-grow: 1; background-color: #f1f5f9; border-radius: 9999px; height: 6px; overflow: hidden;">
                                                    <div style="width: {{ $pVal }}%; background-color: {{ $pColor }}; height: 100%; border-radius: 9999px;"></div>
                                                </div>
                                                <span style="font-size: 0.75rem; font-weight: 700; color: #334155;">{{ $pVal }}%</span>
                                            </div>
                                        </td>
                                        <td class="col-aksi text-center">
                                            <!-- Tombol Tunggal Aksi Langsung: Kelola -->
                                            <button type="button" class="btn btn-sm btn-gradient-primary d-inline-flex align-items-center py-1 px-2.5 fw-semibold shadow-sm" 
                                                    onclick='bukaModalKelola(@json($item))' title="Kelola Dokumen & Persyaratan" style="font-size: 0.76rem; border-radius: 5px;">
                                                <i class="mdi mdi-file-document-edit-outline" style="margin-right: 6px !important; font-size: 0.85rem;"></i>
                                                <span>Kelola</span>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">
                                            <i class="mdi mdi-file-question-outline me-2" style="font-size: 1.5rem;"></i>
                                            Tidak ada dokumen perizinan yang sesuai dengan filter.
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

<!-- ================= MODAL KELOLA DOKUMEN (PERSIS SCREENSHOT USER) ================= -->
<div class="modal fade" id="modalKelolaDokumen" tabindex="-1" aria-labelledby="modalKelolaDokumenLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable fase4-modal-dialog">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden; border: 1px solid #e2e8f0;">
            
            <!-- 1. Header Modal Fixed di Atas -->
            <div class="modal-header px-4 py-3 bg-white border-bottom d-flex align-items-start justify-content-between">
                <div>
                    <span class="badge py-1 px-2 font-monospace fw-bold text-white d-inline-block" id="modalPoinBadge" style="background: #9a55ff; font-size: 0.72rem; border-radius: 4px;">
                        Poin 12
                    </span>
                    <h5 class="fw-bold text-dark mb-0 mt-1.5" id="modalDocTitle" style="font-size: 0.98rem; line-height: 1.35;">
                        Rekomendasi Peil Banjir
                    </h5>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge py-1 px-2 fw-semibold" id="modalStatusBadge" style="background: #ffffff; border: 1px solid #e2e8f0; color: #94a3b8; font-size: 0.72rem; border-radius: 4px;">
                        <span id="modalStatusText">Belum Ada</span>
                    </span>
                    <button type="button" class="btn-close ms-1" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>

            <!-- Body Modal yang di-scroll -->
            <div class="modal-body px-4 py-3 bg-white">
                <form id="formKelolaDokumen" onsubmit="simpanKelolaDokumen(event)">
                    <!-- 2. Status Dokumen (Dropdown Select) -->
                    <div class="mb-2.5">
                        <label class="form-label mb-1 text-muted fw-semibold" style="font-size: 0.78rem;">
                            Status Dokumen
                        </label>
                        <select class="form-select form-select-sm fw-semibold" id="inpStatus" onchange="updateModalStatusBadge(this.value)" style="border: 1.5px solid #cbd5e1; border-radius: 6px; font-size: 0.85rem; color: #1e293b; padding: 0.45rem 0.75rem;">
                            <option value="Belum">Belum Ada</option>
                            <option value="Proses">Sedang Proses</option>
                            <option value="Terbit">Selesai / Terbit Resmi</option>
                            <option value="Revisi">Ditolak / Kendala</option>
                        </select>
                    </div>

                    <!-- 3. Nomor Dokumen / SK & Tanggal -->
                    <div class="row g-2 mb-2.5">
                        <div class="col-7">
                            <label class="form-label mb-1 text-muted fw-semibold" style="font-size: 0.78rem;">
                                Nomor Dokumen / SK
                            </label>
                            <input type="text" class="form-control form-control-sm font-monospace" id="inpNoIzin" placeholder="Nomor resmi SK/Registrasi" style="border: 1.5px solid #cbd5e1; border-radius: 6px; font-size: 0.84rem; color: #1e293b; padding: 0.45rem 0.75rem;">
                        </div>
                        <div class="col-5">
                            <label class="form-label mb-1 text-muted fw-semibold" style="font-size: 0.78rem;">
                                Tanggal
                            </label>
                            <input type="date" class="form-control form-control-sm" id="inpTanggal" placeholder="mm/dd/yyyy" style="border: 1.5px solid #cbd5e1; border-radius: 6px; font-size: 0.84rem; color: #1e293b; padding: 0.45rem 0.75rem;">
                        </div>
                    </div>

                    <!-- 4. BAGIAN UPLOAD DOKUMEN UTAMA: MEMBEDAKAN BERKAS TERUNGGAH VS BELUM ADA BERKAS -->
                    
                    <!-- KONDISI A: BERKAS SUDAH TERUNGGAH -->
                    <div id="wrapperFileSudahAda" style="display: none;">
                        <div class="p-2.5 px-3 rounded-3 mb-2" style="background: #f0fdf4; border: 1.5px solid #86efac;">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <div class="p-1.5 rounded-2 flex-shrink-0" style="background: rgba(0, 201, 167, 0.12); color: #00c9a7;">
                                    <i class="mdi mdi-file-check-outline" style="font-size: 1.25rem;"></i>
                                </div>
                                <div class="overflow-hidden flex-grow-1">
                                    <span class="d-block fw-bold" style="color: #00c9a7; font-size: 0.82rem; line-height: 1.2;">Berkas Terunggah</span>
                                    <small class="text-muted text-truncate d-block font-monospace" id="txtNamaFileSK" style="font-size: 0.72rem;">file_dokumen.pdf</small>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm text-white w-100 fw-bold d-flex align-items-center justify-content-center gap-1.5 shadow-sm" onclick="previewMainDoc()" style="background-color: #00c9a7; border: none; font-size: 0.8rem; border-radius: 6px; padding: 6px;">
                                <i class="mdi mdi-eye"></i> <span>Lihat Berkas</span>
                            </button>
                        </div>

                        <!-- Opsi Ganti / Upload Ulang Berkas -->
                        <div class="mb-3" onclick="document.getElementById('inpUploadFileGanti').click()" style="cursor: pointer;">
                            <input type="file" id="inpUploadFileGanti" class="d-none" accept=".pdf,.jpg,.jpeg,.png" onchange="fileSelectedGanti(this)">
                            <div class="py-1.5 px-2.5 rounded-2 d-flex align-items-center gap-2" style="background: #f8fafc; border: 1px dashed #cbd5e1; transition: all 0.2s ease;">
                                <i class="mdi mdi-cloud-sync" style="font-size: 1.1rem; color: #64748b;"></i>
                                <div class="overflow-hidden flex-grow-1">
                                    <span class="text-secondary text-truncate d-block" id="txtGantiLabel" style="font-size: 0.76rem; font-weight: 600;">Ganti Berkas / Upload Ulang</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- KONDISI B: BELUM ADA BERKAS (PERSIS SCREENSHOT USER) -->
                    <div id="wrapperFileBelumAda" class="mb-3" style="display: none;">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <span class="text-muted fw-semibold" style="font-size: 0.78rem;">Upload Berkas Dokumen</span>
                            <span class="badge" style="background-color: #fffbeb; border: 1px solid #fde68a; color: #d97706; font-size: 9px; font-weight: 600; padding: 2px 6px; border-radius: 4px;">Format PDF/JPG/PNG</span>
                        </div>
                        <div onclick="document.getElementById('inpUploadFileBaru').click()" style="cursor: pointer;">
                            <input type="file" id="inpUploadFileBaru" class="d-none" accept=".pdf,.jpg,.jpeg,.png" onchange="fileSelectedBaru(this)">
                            <div class="py-2 px-2.5 rounded-3 d-flex align-items-center gap-2.5" style="border: 1.5px dashed #c4b5fd; background: #ffffff; transition: all 0.2s ease;">
                                <div class="p-1.5 rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="background: rgba(154, 85, 255, 0.12); width: 36px; height: 36px;">
                                    <i class="mdi mdi-cloud-upload" style="font-size: 1.25rem; color: #9a55ff;"></i>
                                </div>
                                <div class="overflow-hidden flex-grow-1">
                                    <span class="file-label-text fw-bold text-truncate d-block" id="txtBaruLabel" style="font-size: 0.82rem; color: #9a55ff;">Pilih / Upload Berkas</span>
                                    <small class="text-muted d-block" style="font-size: 0.70rem; color: #94a3b8 !important;">PDF, JPG, PNG (Maks 20MB)</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 5. RINCIAN & PRASYARAT (PERSIS SCREENSHOT USER DENGAN DROPDOWN FORM UPLOAD) -->
                    <div class="mb-3">
                        <div class="d-flex align-items-center justify-content-between p-2 px-3 rounded-2 border bg-white" style="border-color: #cbd5e1 !important;">
                            <div class="d-inline-flex align-items-center gap-2">
                                <span class="text-dark fw-bold" style="font-size: 0.85rem;">Rincian & Prasyarat</span>
                                <span class="badge font-monospace fw-semibold px-2 py-0.5" id="badgeSyaratCount" style="background-color: #94a3b8; color: #ffffff; font-size: 0.72rem; border-radius: 4px;">
                                    0/4 Syarat
                                </span>
                            </div>
                            <button type="button" class="btn btn-sm text-white px-3 py-1 fw-semibold shadow-2xs" id="btnToggleRincianSyarat" onclick="toggleModalSyaratSection()" style="background: #9a55ff; font-size: 0.76rem; border-radius: 4px;">
                                Buka
                            </button>
                        </div>

                        <!-- Dropdown Accordion Yang Berisi Form Upload Tiap Item Persyaratan -->
                        <div id="sectionSyaratExpanded" class="mt-2.5 p-2.5 rounded-3 bg-light border" style="display: none;">
                            <div class="d-flex justify-content-between align-items-center mb-2 pb-1 border-bottom">
                                <span class="fw-bold text-dark small" style="font-size: 0.78rem;">
                                    <i class="mdi mdi-checkbox-marked-circle-outline text-success me-1"></i>Checklist Prasyarat Berkas:
                                </span>
                            </div>

                            <!-- List Item Persyaratan yang Masing-Masing Memiliki Form Upload Berkas -->
                            <div class="d-flex flex-column gap-2 mb-2.5" id="containerSyaratList">
                                <!-- Diisi dinamis oleh JavaScript -->
                            </div>

                            <!-- Tambah Syarat Baru -->
                            <div class="input-group input-group-sm mb-2">
                                <input type="text" class="form-control" id="inpTambahSyarat" placeholder="Tambah syarat baru..." style="font-size: 0.78rem;">
                                <button type="button" class="btn text-white fw-bold px-2.5" onclick="tambahItemSyaratManual()" style="background: #9a55ff; font-size: 0.75rem;">
                                    <i class="mdi mdi-plus"></i> Tambah
                                </button>
                            </div>

                            <div class="pt-2 border-top">
                                <label class="form-label mb-1 text-muted fw-bold small" style="font-size: 0.74rem;">Catatan Lapangan:</label>
                                <textarea class="form-control form-control-sm text-dark bg-white" id="inpCatatan" rows="2" placeholder="Catatan dinas atau hasil survei..." style="font-size: 0.78rem;"></textarea>
                            </div>
                        </div>
                    </div>

                </form>
            </div>

            <!-- Modal Footer Fixed di Bawah (Body Modal yang Scroll) -->
            <div class="modal-footer px-4 py-2.5 bg-white border-top d-flex align-items-center justify-content-between">
                <button type="button" class="btn text-white fw-bold px-3.5 py-2 shadow-sm d-inline-flex align-items-center gap-1.5"
                    onclick="document.getElementById('formKelolaDokumen').requestSubmit()"
                    style="background-color: #00c9a7; border-radius: 6px; font-size: 0.84rem; border: none;">
                    <i class="mdi mdi-content-save"></i> <span>Simpan Dokumen</span>
                </button>
                <div class="d-flex align-items-center gap-1.5">
                    <button type="button" class="btn fw-bold px-3.5 py-2 d-inline-flex align-items-center gap-1"
                        data-bs-dismiss="modal"
                        style="background-color: #f1f5f9; border: 1px solid #cbd5e1; color: #475569; border-radius: 6px; font-size: 0.84rem;">
                        <i class="mdi mdi-close"></i> <span>Batal</span>
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

@push('scripts')
<script>
    // LIVE SEARCH TABLE
    function applyLiveSearch(keyword) {
        var val = (keyword || '').toLowerCase().trim();
        var rows = document.querySelectorAll('.permit-table-row');
        rows.forEach(function(row) {
            var str = (row.getAttribute('data-search') || '').toLowerCase();
            row.style.display = (val === '' || str.includes(val)) ? '' : 'none';
        });
    }

    var currentSyaratList = [];
    var currentItemFile = null;

    // BUKA MODAL KELOLA DOKUMEN (PERSIS SCREENSHOT USER)
    function bukaModalKelola(item) {
        currentSyaratList = [];
        var container = document.getElementById('containerSyaratList');
        container.innerHTML = '';
        
        // Reset accordion syarat (tertutup saat pertama kali buka)
        document.getElementById('sectionSyaratExpanded').style.display = 'none';
        document.getElementById('btnToggleRincianSyarat').textContent = 'Buka';

        if (!item) {
            // Mode Tambah Dokumen Baru
            document.getElementById('modalPoinBadge').textContent = 'Poin Baru';
            document.getElementById('modalDocTitle').textContent = 'Dokumen Perizinan Baru';
            document.getElementById('inpStatus').value = 'Belum';
            updateModalStatusBadge('Belum');
            document.getElementById('inpNoIzin').value = '';
            document.getElementById('inpTanggal').value = '';
            document.getElementById('inpCatatan').value = '';
            currentItemFile = null;

            // Kondisi Belum Ada Berkas -> Tampilkan Form Upload Baru
            document.getElementById('wrapperFileSudahAda').style.display = 'none';
            document.getElementById('wrapperFileBelumAda').style.display = 'block';
            document.getElementById('txtBaruLabel').textContent = 'Pilih / Upload Berkas';

            currentSyaratList = [
                { title: 'Salinan KTP & NPWP Direksi PT', file: null },
                { title: 'Akta Pendirian & Legalitas PT Developer', file: null }
            ];
            renderSyaratListModal(currentSyaratList, false);
        } else {
            // Mode Edit Dokumen Eksisting
            document.getElementById('modalPoinBadge').textContent = item.poin_label || 'Poin 1';
            document.getElementById('modalDocTitle').textContent = item.nama_izin || 'Nama Dokumen';
            document.getElementById('inpStatus').value = item.status || 'Belum';
            updateModalStatusBadge(item.status || 'Belum');
            document.getElementById('inpNoIzin').value = item.no_izin || '';
            
            // Format tanggal untuk input date YYYY-MM-DD
            document.getElementById('inpTanggal').value = formatDateForInput(item.tanggal);
            document.getElementById('inpCatatan').value = item.catatan || '';

            // PEMBEDAAN: JIKA SUDAH ADA BERKAS VS BELUM ADA BERKAS (PERSIS SCREENSHOT)
            if (item.file_dokumen) {
                currentItemFile = item.file_dokumen;
                document.getElementById('wrapperFileSudahAda').style.display = 'block';
                document.getElementById('wrapperFileBelumAda').style.display = 'none';
                document.getElementById('txtNamaFileSK').textContent = item.file_dokumen;
                document.getElementById('txtGantiLabel').textContent = 'Ganti Berkas / Upload Ulang';
            } else {
                currentItemFile = null;
                document.getElementById('wrapperFileSudahAda').style.display = 'none';
                document.getElementById('wrapperFileBelumAda').style.display = 'block';
                document.getElementById('txtBaruLabel').textContent = 'Pilih / Upload Berkas';
            }

            // Persyaratan Berkas dengan form upload masing-masing
            var rawSyarat = (item.syarat_items && item.syarat_items.length > 0) 
                ? item.syarat_items 
                : ['Salinan KTP & KK Pemohon', 'Legalitas Kepemilikan Lahan'];
            
            currentSyaratList = rawSyarat.map(function(s, idx) {
                return {
                    title: (typeof s === 'string') ? s : (s.title || 'Syarat ' + (idx + 1)),
                    file: null
                };
            });

            renderSyaratListModal(currentSyaratList, false);
        }

        var modal = new bootstrap.Modal(document.getElementById('modalKelolaDokumen'));
        modal.show();
    }

    // HELPER FORMAT TANGGAL KE YYYY-MM-DD JIKA MEMUNGKINKAN
    function formatDateForInput(str) {
        if (!str) return '';
        var parts = str.match(/(\d{1,2})\s+([A-Za-z]+)\s+(\d{4})/);
        if (parts) {
            var months = {
                'jan': '01', 'feb': '02', 'mar': '03', 'apr': '04', 'may': '05', 'jun': '06',
                'jul': '07', 'aug': '08', 'sep': '09', 'oct': '10', 'nov': '11', 'dec': '12'
            };
            var mKey = parts[2].substring(0, 3).toLowerCase();
            var m = months[mKey] || '01';
            var d = parts[1].padStart(2, '0');
            var y = parts[3];
            return `${y}-${m}-${d}`;
        }
        return '';
    }

    // UPDATE BADGE STATUS DI KANAN ATAS (PERSIS SCREENSHOT)
    function updateModalStatusBadge(statusVal) {
        var badge = document.getElementById('modalStatusBadge');
        var text = document.getElementById('modalStatusText');

        if (statusVal === 'Terbit' || statusVal === 'terbit' || statusVal === 'selesai') {
            badge.style.backgroundColor = '#00c9a7';
            badge.style.border = 'none';
            badge.style.color = '#ffffff';
            text.innerHTML = '<i class="mdi mdi-shield-check me-1"></i>Selesai / Terbit';
        } else if (statusVal === 'Proses' || statusVal === 'proses') {
            badge.style.backgroundColor = '#fffbeb';
            badge.style.border = '1px solid #fde68a';
            badge.style.color = '#d97706';
            text.innerHTML = '<i class="mdi mdi-clock-outline me-1"></i>Sedang Proses';
        } else if (statusVal === 'Revisi' || statusVal === 'ditolak') {
            badge.style.backgroundColor = '#fff1f2';
            badge.style.border = '1px solid #fecdd3';
            badge.style.color = '#e11d48';
            text.innerHTML = '<i class="mdi mdi-alert-circle me-1"></i>Ditolak / Kendala';
        } else {
            // Belum Ada persis screenshot user (background putih, border abu-abu, teks abu-abu)
            badge.style.backgroundColor = '#ffffff';
            badge.style.border = '1px solid #e2e8f0';
            badge.style.color = '#94a3b8';
            text.innerHTML = 'Belum Ada';
        }
    }

    // TOGGLE BAGIAN RINCIAN & PRASYARAT
    function toggleModalSyaratSection() {
        var sec = document.getElementById('sectionSyaratExpanded');
        var btn = document.getElementById('btnToggleRincianSyarat');
        if (sec.style.display === 'none' || sec.style.display === '') {
            sec.style.display = 'block';
            btn.textContent = 'Tutup';
        } else {
            sec.style.display = 'none';
            btn.textContent = 'Buka';
        }
    }

    // RENDER LIST PERSYARATAN DI DALAM ACCORDION (PERSIS SCREENSHOT USER)
    var uploadedSyaratStateShow = {};

    function renderSyaratListModal(items, allChecked) {
        var container = document.getElementById('containerSyaratList');
        container.innerHTML = '';
        var total = items.length;
        uploadedSyaratStateShow = {};

        items.forEach(function(itemObj, idx) {
            var title = itemObj.title || itemObj;
            var file = itemObj.file || null;
            uploadedSyaratStateShow[idx] = !!file;

            var card = document.createElement('div');
            card.className = 'border bg-white mb-2.5 p-3';
            card.style.borderRadius = '10px';
            card.style.borderColor = '#e2e8f0';
            card.id = 'syarat_card_' + idx;

            card.innerHTML = `
                <!-- Judul Syarat -->
                <div class="fw-bold text-dark mb-2" style="font-size: 0.88rem; line-height: 1.35;">
                    ${title}
                </div>

                <!-- Box Upload Tunggal (Tanpa box berkas terunggah terpisah) -->
                <div id="syarat_box_upload_${idx}" class="p-2.5 px-3 d-flex align-items-center justify-content-between"
                     style="border: 1.5px dashed #c084fc; background: #faf5ff; border-radius: 8px; cursor: pointer; transition: all 0.2s ease;"
                     onclick="document.getElementById('file_input_syarat_${idx}').click()">
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
                                title="Hapus Berkas" onclick="removeShowSyaratFile(${idx}, ${total})">
                            <i class="mdi mdi-trash-can-outline" style="font-size: 1.1rem;"></i>
                        </button>
                    </div>
                    <input type="file" id="file_input_syarat_${idx}" style="display: none;" onchange="handleShowSyaratUploaded(this, ${idx}, ${total})">
                </div>
            `;
            container.appendChild(card);
        });

        updateBadgeSyaratCountShow(total);
    }

    function handleShowSyaratUploaded(input, idx, total) {
        if (input.files && input.files[0]) {
            var file = input.files[0];
            uploadedSyaratStateShow[idx] = true;
            
            var box = document.getElementById('syarat_box_upload_' + idx);
            box.style.borderColor = '#86efac';
            box.style.background = '#f0fdf4';
            
            var circle = document.getElementById('syarat_circle_' + idx);
            circle.style.backgroundColor = '#dcfce7';
            circle.style.color = '#16a34a';
            
            var icon = document.getElementById('syarat_icon_' + idx);
            icon.className = 'mdi mdi-file-check';
            
            var title = document.getElementById('syarat_title_' + idx);
            title.textContent = file.name;
            title.style.color = '#16a34a';
            
            var sub = document.getElementById('syarat_sub_' + idx);
            sub.textContent = 'Berkas siap & valid • Klik untuk ganti';
            
            var actions = document.getElementById('syarat_actions_' + idx);
            actions.style.display = 'flex';
            document.getElementById('syarat_btn_view_' + idx).href = URL.createObjectURL(file);
            
            updateBadgeSyaratCountShow(total);
        }
    }

    function removeShowSyaratFile(idx, total) {
        uploadedSyaratStateShow[idx] = false;
        
        var box = document.getElementById('syarat_box_upload_' + idx);
        box.style.borderColor = '#c084fc';
        box.style.background = '#faf5ff';
        
        var circle = document.getElementById('syarat_circle_' + idx);
        circle.style.backgroundColor = '#f3e8ff';
        circle.style.color = '#a855f7';
        
        var icon = document.getElementById('syarat_icon_' + idx);
        icon.className = 'mdi mdi-cloud-upload';
        
        var title = document.getElementById('syarat_title_' + idx);
        title.textContent = 'Pilih / Upload Berkas';
        title.style.color = '#9333ea';
        
        var sub = document.getElementById('syarat_sub_' + idx);
        sub.textContent = 'PDF, JPG, PNG (Maks 20MB)';
        
        var actions = document.getElementById('syarat_actions_' + idx);
        actions.style.display = 'none';
        
        document.getElementById('file_input_syarat_' + idx).value = '';
        updateBadgeSyaratCountShow(total);
    }

    function updateBadgeSyaratCountShow(total) {
        var count = 0;
        for (var k in uploadedSyaratStateShow) {
            if (uploadedSyaratStateShow[k] === true) count++;
        }

        var text = count + '/' + total + ' Siap';
        var badgeTop = document.getElementById('badgeSiapCountTop');
        var badgeSec = document.getElementById('badgeSyaratCount');

        if (badgeTop) {
            badgeTop.textContent = text;
            badgeTop.style.backgroundColor = (count === total && total > 0) ? '#10b981' : '#a8a29e';
        }
        if (badgeSec) {
            badgeSec.textContent = text;
            if (count === total && total > 0) {
                badgeSec.style.backgroundColor = '#00c9a7';
                badgeSec.style.color = '#ffffff';
            } else {
                badgeSec.style.backgroundColor = '#94a3b8';
                badgeSec.style.color = '#ffffff';
            }
        }
    }

    // UPLOAD BERKAS DI MASING-MASING ITEM PERSYARATAN
    function syaratFileUploaded(input, idx) {
        if (input.files && input.files[0]) {
            var fileName = input.files[0].name;
            currentSyaratList[idx].file = fileName;

            // Checkbox otomatis tercentang
            var chk = document.getElementById('chk_syarat_' + idx);
            if (chk) {
                chk.checked = true;
                updateSyaratState(chk, idx);
            }

            // Tampilkan tombol lihat
            var btnView = document.getElementById('btn_view_syarat_' + idx);
            if (btnView) btnView.style.display = 'inline-flex';

            // Ubah tampilan box upload jadi hijau sukses
            var labelBox = document.getElementById('label_box_syarat_' + idx);
            if (labelBox) {
                labelBox.style.borderColor = '#86efac';
                labelBox.style.background = '#f0fdf4';
            }
            var icon = document.getElementById('icon_syarat_' + idx);
            if (icon) {
                icon.className = 'mdi mdi-file-check text-success';
            }
            var labelText = document.getElementById('label_syarat_file_' + idx);
            if (labelText) {
                labelText.className = 'file-label-text fw-bold text-success text-truncate d-block';
                labelText.textContent = fileName;
            }
        }
    }

    // TAMBAH SYARAT BARU KE CHECKLIST
    function tambahItemSyaratManual() {
        var inp = document.getElementById('inpTambahSyarat');
        var val = (inp.value || '').trim();
        if (!val) return;
        currentSyaratList.push({ title: val, file: null });
        renderSyaratListModal(currentSyaratList, false);
        inp.value = '';
    }

    // HAPUS ITEM SYARAT
    function hapusSyaratItem(idx) {
        currentSyaratList.splice(idx, 1);
        renderSyaratListModal(currentSyaratList, false);
    }

    // UPLOAD BERKAS UTAMA: DARI KONDISI BELUM ADA
    function fileSelectedBaru(input) {
        if (input.files && input.files[0]) {
            var fileName = input.files[0].name;
            currentItemFile = fileName;
            // Beralih ke box berkas terunggah
            document.getElementById('wrapperFileBelumAda').style.display = 'none';
            document.getElementById('wrapperFileSudahAda').style.display = 'block';
            document.getElementById('txtNamaFileSK').textContent = fileName;
            document.getElementById('txtGantiLabel').textContent = 'Ganti Berkas / Upload Ulang';
        }
    }

    // GANTI BERKAS UTAMA
    function fileSelectedGanti(input) {
        if (input.files && input.files[0]) {
            var fileName = input.files[0].name;
            currentItemFile = fileName;
            document.getElementById('txtNamaFileSK').textContent = fileName;
            document.getElementById('txtGantiLabel').textContent = 'Ganti Berkas: ' + fileName;
        }
    }

    // LIHAT BERKAS UTAMA
    function previewMainDoc() {
        alert('Pratinjau dokumen: ' + (currentItemFile || 'Dokumen SK'));
    }

    // SIMPAN FORM KELOLA DOKUMEN
    function simpanKelolaDokumen(e) {
        e.preventDefault();
        alert('Data perizinan, berkas SK & lampiran persyaratan berhasil disimpan!');
        var modalEl = document.getElementById('modalKelolaDokumen');
        var modal = bootstrap.Modal.getInstance(modalEl);
        if (modal) modal.hide();
    }
</script>
@endpush

@endsection
