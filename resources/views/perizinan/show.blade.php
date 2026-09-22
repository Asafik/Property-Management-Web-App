@extends('layouts.partial.app')

@section('title', 'Kelola Perizinan: ' . $project['nama'] . ' - Property Management App')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-clean.css') }}?v={{ time() }}">
@endpush

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

    /* Styling Card Tabel Meniru Persis Card Total */
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
    .btn-kembali-proyek:hover {
        background-color: #f8fafc !important;
        border-color: #94a3b8 !important;
        color: #0f172a !important;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08) !important;
    }
</style>

<div class="container-fluid px-2 px-md-4 py-3">

    <!-- Top Navigation & Page Title -->
    <div class="d-flex flex-wrap justify-content-between align-items-start gap-3 mb-4">
        <div>
            <h2 class="text-dark mb-1 fw-bold" style="font-size: 1.55rem; letter-spacing: -0.02em;">
                Perizinan Kawasan: {{ $project['nama'] }}
            </h2>
            <p class="text-muted mb-0" style="font-size: 0.88rem;">
                {{ $project['pt'] }} &bull; {{ $project['lokasi'] }} &bull; Luas: {{ $project['luas'] }} ({{ $project['ownership_status'] }})
            </p>
        </div>
        <div class="d-flex align-items-center gap-2">
            @if(!empty($project['is_finalized_to_pasca']) && !empty($project['land_bank_id']))
                <a href="{{ route('properti.edit', $project['land_bank_id']) }}" class="btn btn-sm d-inline-flex align-items-center gap-2 px-3 py-2 shadow-sm text-white fw-semibold" style="background: linear-gradient(135deg, #10b981, #059669); border: none; border-radius: 8px; font-size: 0.85rem;" title="Buka data kawasan ini di Pasca Land Bank">
                    <i class="mdi mdi-shield-check" style="font-size: 1.1rem; line-height: 1;"></i>
                    <span>Buka di Pasca Land Bank</span>
                </a>
            @else
                <button type="button" class="btn btn-sm d-inline-flex align-items-center gap-2 px-3 py-2 shadow-sm text-white fw-semibold" onclick="confirmFinalizeToPasca({{ $project['id'] }}, '{{ addslashes($project['nama']) }}', {{ $projectProgress ?? 0 }}, {{ $totalTerbit ?? 0 }}, {{ $totalIzin ?? 0 }})" style="background: linear-gradient(135deg, #10b981, #059669); border: none; border-radius: 8px; font-size: 0.85rem;" title="Alihkan kawasan ini ke Pasca Land Bank untuk pengolahan lahan & kavling">
                    <i class="mdi mdi-shield-crown" style="font-size: 1.1rem; line-height: 1;"></i>
                    <span>Finalisasi ke Pasca Land Bank</span>
                </button>
            @endif
            <a href="{{ route('perizinan.index') }}" class="btn btn-sm d-inline-flex align-items-center gap-2 px-3 py-2 shadow-sm btn-kembali-proyek" style="border: 1px solid #cbd5e1; background-color: #ffffff; color: #1e293b; border-radius: 8px; font-weight: 600; font-size: 0.85rem; transition: all 0.2s ease;">
                <i class="mdi mdi-arrow-left text-primary" style="font-size: 1.1rem; line-height: 1;"></i>
                <span>Kembali</span>
            </a>
        </div>
    </div>

    <!-- 4 KPI Metrics Card Proyek Ini (Sama Persis Halaman Index) -->
    <div class="dash-kpi-grid mb-4">
        <!-- Card 1: Total Izin (Ungu) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon purple">
                    <i class="mdi mdi-file-document-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Total Dokumen Izin</div>
                    <div class="dash-kpi-val">{{ $totalIzin ?? 0 }}</div>
                    <div class="dash-kpi-sub">Seluruh Dokumen Proyek</div>
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
                    <div class="dash-kpi-label">Izin Terbit & Sah</div>
                    <div class="dash-kpi-val">{{ $totalTerbit ?? 0 }}</div>
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
                    <div class="dash-kpi-label">Sedang Proses Dinas</div>
                    <div class="dash-kpi-val">{{ $totalProses ?? 0 }}</div>
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
                    <div class="dash-kpi-label">Perlu Revisi / Kendala</div>
                    <div class="dash-kpi-val">{{ $totalRevisi ?? 0 }}</div>
                    <div class="dash-kpi-sub">Perlu Tindak Lanjut / Revisi</div>
                </div>
            </div>
            <div class="dash-kpi-action rose">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>
    </div>

    <!-- Main Container: Dokumen Perizinan Proyek (MURNI TABEL GAYA DATA BANK) -->
    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card compact-table-card" style="background: #ffffff !important; border: 1px solid #e2e8f0 !important; border-radius: 8px !important; box-shadow: none !important;">
                <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2" style="padding: 0.65rem 1.25rem !important; border-bottom: 1px solid #e2e8f0 !important;">
                    <div class="d-flex align-items-center gap-2">
                        <div style="width: 32px; height: 32px; border-radius: 6px; background-color: #f3e8ff; color: #9333ea; display: inline-flex; align-items: center; justify-content: center; font-size: 1.15rem; flex-shrink: 0;">
                            <i class="mdi mdi-format-list-bulleted"></i>
                        </div>
                        <span style="font-size: 0.95rem; font-weight: 700; color: #0f172a;">Rincian Dokumen Perizinan Kawasan</span>
                    </div>
                    <a href="{{ route('perizinan.dokumen.kelola', ['id' => $project['id'], 'item_id' => 'baru']) }}" class="btn btn-sm btn-gradient-primary d-flex align-items-center gap-1 shadow-sm">
                        <i class="mdi mdi-plus-circle" style="font-size: 1rem;"></i>
                        <span>Tambah Dokumen Izin</span>
                    </a>
                </div>

                <div class="card-body" style="padding: 0.75rem 1.25rem 1.15rem 1.25rem !important;">
                    <!-- Filter Toolbar -->
                    <div class="filter-card" style="margin-top: 0 !important; margin-bottom: 0.6rem !important;">
                        <form id="filterForm" method="GET" action="{{ route('perizinan.show', $project['id']) }}" style="margin-bottom: 0 !important;">
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
                                            <!-- Tombol Aksi: Kelola Dokumen (Halaman Sendiri) -->
                                            <a href="{{ route('perizinan.dokumen.kelola', ['id' => $project['id'], 'item_id' => $item['id']]) }}" 
                                               class="btn btn-sm btn-gradient-primary d-inline-flex align-items-center py-1 px-2.5 fw-semibold shadow-sm" 
                                               title="Kelola Dokumen & Persyaratan" style="font-size: 0.76rem; border-radius: 5px;">
                                                <i class="mdi mdi-file-document-edit-outline" style="margin-right: 6px !important; font-size: 0.85rem;"></i>
                                                <span>Kelola</span>
                                            </a>
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

@push('scripts')
<script>
    // FINALISASI KE PASCA LAND BANK
    function confirmFinalizeToPasca(id, nama, progress, terbit, total) {
        let noteText = '';
        if (progress < 100) {
            noteText = `<div class="p-2 mb-3 rounded" style="background:#fffbeb; border:1px solid #fde68a; font-size:0.83rem; text-align:left; color:#92400e;">
                <i class="mdi mdi-alert-circle-outline me-1"></i>
                <strong>Perhatian:</strong> Progres perizinan saat ini baru mencapai <strong>${progress}%</strong> (${terbit} dari ${total} izin terbit).
                Pastikan dokumen esensial (seperti PKKPR, Pertek, atau Akta Pelepasan) telah memadai sebelum memulai pekerjaan fisik di Pasca Land Bank.
            </div>`;
        } else {
            noteText = `<div class="p-2 mb-3 rounded" style="background:#ecfdf5; border:1px solid #a7f3d0; font-size:0.83rem; text-align:left; color:#065f46;">
                <i class="mdi mdi-check-decagram me-1"></i>
                <strong>Luar Biasa!</strong> Seluruh izin telah 100% tuntas. Kawasan ini siap dialihkan secara penuh ke Pasca Land Bank.
            </div>`;
        }

        Swal.fire({
            title: '<span style="font-size: 1.18rem; font-weight: 700; color: #1e293b;"><i class="mdi mdi-shield-crown text-success me-1.5"></i> Finalisasi ke Pasca Land Bank</span>',
            html: `
                <div style="font-size: 0.9rem; color: #475569; line-height: 1.5; text-align: center;" class="mb-3">
                    Apakah Anda yakin ingin mengalihkan kawasan <strong>"${nama}"</strong> ke modul <strong>Pasca Land Bank</strong>?
                </div>
                ${noteText}
                <div style="font-size: 0.82rem; color: #64748b; text-align: left; background: #f8fafc; padding: 10px; border-radius: 8px; border: 1px solid #e2e8f0;">
                    <ul class="mb-0 ps-3">
                        <li>Data kawasan, legalitas, koordinat peta, dan dokumen akan didaftarkan ke Pasca Land Bank.</li>
                        <li>Tim operasional & teknik dapat mulai merancang <strong>Pengolahan Lahan</strong> & <strong>Pembuatan Kavling</strong>.</li>
                    </ul>
                </div>
            `,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#10b981',
            cancelButtonColor: '#64748b',
            confirmButtonText: '<i class="mdi mdi-check-circle me-1"></i> Ya, Alihkan ke Pasca',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            focusConfirm: false,
            customClass: {
                popup: 'rounded-4 shadow-lg border-0',
                confirmButton: 'px-4 py-2 rounded-3 fw-semibold',
                cancelButton: 'px-4 py-2 rounded-3 fw-semibold'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Memproses Finalisasi...',
                    text: 'Sedang mendaftarkan kawasan ke Pasca Land Bank',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                fetch(`{{ route('perizinan.finalize-pasca', ':id') }}`.replace(':id', id), {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: '<span style="color: #059669; font-weight: 700;">Berhasil Dialihkan!</span>',
                            html: `<p style="font-size:0.92rem; color:#475569;">${data.message}</p>`,
                            icon: 'success',
                            showCancelButton: true,
                            confirmButtonColor: '#10b981',
                            cancelButtonColor: '#6366f1',
                            confirmButtonText: '<i class="mdi mdi-arrow-right me-1"></i> Buka di Pasca Land Bank',
                            cancelButtonText: 'Tetap di Halaman Ini',
                            reverseButtons: true,
                            customClass: {
                                popup: 'rounded-4 shadow-lg border-0',
                                confirmButton: 'px-4 py-2 rounded-3 fw-semibold',
                                cancelButton: 'px-4 py-2 rounded-3 fw-semibold'
                            }
                        }).then((choice) => {
                            if (choice.isConfirmed && data.redirect_url) {
                                window.location.href = data.redirect_url;
                            } else {
                                window.location.reload();
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Mengalihkan',
                            text: data.message || 'Terjadi kesalahan saat memproses data.',
                            customClass: { popup: 'rounded-4' }
                        });
                    }
                })
                .catch(err => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Koneksi Terputus',
                        text: 'Gagal menghubungi server. Silakan coba kembali.',
                        customClass: { popup: 'rounded-4' }
                    });
                });
            }
        });
    }

    // LIVE SEARCH TABLE
    function applyLiveSearch(keyword) {
        var val = (keyword || '').toLowerCase().trim();
        var rows = document.querySelectorAll('.permit-table-row');
        rows.forEach(function(row) {
            var str = (row.getAttribute('data-search') || '').toLowerCase();
            row.style.display = (val === '' || str.includes(val)) ? '' : 'none';
        });
    }
</script>
@endpush

@endsection
