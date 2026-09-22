@extends('layouts.partial.app')

@section('title', 'Kelola Dokumen: ' . ($item['nama_izin'] ?: 'Dokumen Perizinan') . ' - ' . $project['nama'])

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-clean.css') }}?v={{ time() }}">
    <style>
        .kelola-card {
            background: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 10px !important;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04) !important;
            overflow: hidden;
        }
        .kelola-card .card-header {
            background: #ffffff !important;
            border-bottom: 1px solid #e2e8f0 !important;
            padding: 1rem 1.4rem !important;
        }
        .kelola-card .card-body {
            padding: 1.4rem !important;
            background: #ffffff !important;
        }
        .form-label-custom {
            font-size: 0.82rem;
            font-weight: 600;
            color: #475569;
            margin-bottom: 0.35rem;
        }
        .form-control-custom,
        .form-select-custom {
            border: 1.5px solid #cbd5e1;
            border-radius: 6px !important;
            font-size: 0.86rem;
            padding: 0.5rem 0.8rem;
            color: #1e293b;
            background-color: #ffffff;
            transition: all 0.15s ease;
        }
        .form-control-custom:focus,
        .form-select-custom:focus {
            border-color: #9a55ff;
            box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.15);
            outline: none;
        }
        .btn-kembali-proyek {
            border-radius: 8px !important;
            font-size: 0.85rem;
            font-weight: 600;
            border: 1px solid #cbd5e1;
            background-color: #ffffff;
            color: #1e293b;
            transition: all 0.15s ease;
        }
        .btn-kembali-proyek:hover {
            background-color: #f8fafc !important;
            border-color: #94a3b8 !important;
            color: #0f172a !important;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08) !important;
        }
        .badge-poin-custom {
            background: #9a55ff;
            color: #ffffff;
            font-size: 0.75rem;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 6px;
            letter-spacing: 0.02em;
        }
        .badge-status-top {
            font-size: 0.78rem;
            font-weight: 700;
            padding: 5px 12px;
            border-radius: 6px;
            transition: all 0.2s ease;
        }
        .syarat-upload-card {
            border: 1.5px dashed #c084fc;
            background: #faf5ff;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .syarat-upload-card:hover {
            border-color: #9333ea;
            background: #f5f3ff;
        }
        .syarat-upload-card.uploaded {
            border-color: #86efac;
            background: #f0fdf4;
        }
    </style>
@endpush

@section('content')
<div class="container-fluid px-2 px-md-4 py-3">

    <!-- Top Header Breadcrumb & Actions -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <div class="d-flex align-items-center gap-2 mb-1">
                <span class="badge-poin-custom">
                    {{ $item['poin_label'] ?? 'Poin Perizinan' }}
                </span>
                <span class="text-muted" style="font-size: 0.85rem;">
                    Kawasan <strong>{{ $project['nama'] }}</strong>
                </span>
            </div>
            <h2 class="text-dark mb-1 fw-bold" style="font-size: 1.5rem; letter-spacing: -0.02em;">
                {{ $item['nama_izin'] ?: 'Dokumen Perizinan Baru' }}
            </h2>
            <p class="text-muted mb-0" style="font-size: 0.85rem;">
                {{ $project['pt'] }} &bull; {{ $project['lokasi'] }} &bull; Luas: {{ $project['luas'] }}
            </p>
        </div>

        <div class="d-flex align-items-center gap-2">
            <!-- Dynamic Status Badge Top -->
            <span id="topStatusBadge" class="badge-status-top">
                <span id="topStatusText">Belum Ada</span>
            </span>

            <a href="{{ route('perizinan.show', $project['id']) }}" class="btn btn-sm d-inline-flex align-items-center gap-2 px-3 py-2 shadow-sm btn-kembali-proyek">
                <i class="mdi mdi-arrow-left text-primary" style="font-size: 1.05rem; line-height: 1;"></i>
                <span>Kembali ke Kawasan</span>
            </a>
        </div>
    </div>

    <!-- Alert Notifications -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm d-flex align-items-center gap-2 mb-3" role="alert" style="border-radius: 8px; background: #ecfdf5; color: #065f46;">
            <i class="mdi mdi-check-circle fs-5 text-success"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm d-flex align-items-center gap-2 mb-3" role="alert" style="border-radius: 8px; background: #fef2f2; color: #991b1b;">
            <i class="mdi mdi-alert-circle fs-5 text-danger"></i>
            <div>{{ session('error') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Form Kelola Dokumen -->
    <form action="{{ route('perizinan.dokumen.simpan', ['id' => $project['id'], 'item_id' => $item_id]) }}" method="POST" enctype="multipart/form-data" id="formKelolaDokumen">
        @csrf

        <div class="row g-3">
            <!-- Left Column: Informasi Utama Dokumen & Berkas SK -->
            <div class="col-lg-7">
                <div class="card kelola-card mb-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-2">
                            <div style="width: 32px; height: 32px; border-radius: 6px; background-color: #f3e8ff; color: #9333ea; display: inline-flex; align-items: center; justify-content: center; font-size: 1.15rem; flex-shrink: 0;">
                                <i class="mdi mdi-file-document-edit-outline"></i>
                            </div>
                            <h5 class="mb-0 fw-bold text-dark" style="font-size: 0.95rem;">Informasi & Legalitas Dokumen</h5>
                        </div>
                        <small class="text-muted">ID: #{{ $item['id'] }}</small>
                    </div>

                    <div class="card-body">
                        <!-- Nama Dokumen Izin -->
                        <div class="mb-3">
                            <label class="form-label-custom">Nama Perizinan / Dokumen <span class="text-danger">*</span></label>
                            <input type="text" name="nama_izin" class="form-control form-control-custom fw-semibold" 
                                   value="{{ old('nama_izin', $item['nama_izin']) }}" 
                                   placeholder="Contoh: Rekomendasi Peil Banjir, PKKPR, PBG..." required>
                        </div>

                        <!-- Status Dokumen & Progres -->
                        <div class="row g-2 mb-3">
                            <div class="col-md-6">
                                <label class="form-label-custom">Status Dokumen <span class="text-danger">*</span></label>
                                <select name="status" id="inpStatus" class="form-select form-select-custom fw-bold" onchange="syncStatusChange(this.value)" required>
                                    <option value="Belum" {{ old('status', $item['status']) == 'Belum' ? 'selected' : '' }}>Belum Ada (Menunggu)</option>
                                    <option value="Proses" {{ in_array(old('status', $item['status']), ['Proses', 'Berjalan', 'Dalam Proses']) ? 'selected' : '' }}>Sedang Proses Dinas</option>
                                    <option value="Terbit" {{ in_array(old('status', $item['status']), ['Terbit', 'Selesai']) ? 'selected' : '' }}>Selesai / Terbit Resmi</option>
                                    <option value="Revisi" {{ in_array(old('status', $item['status']), ['Revisi', 'Tertunda', 'Terkendala']) ? 'selected' : '' }}>Ditolak / Perlu Revisi / Kendala</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <label class="form-label-custom mb-0">Persentase Progres</label>
                                    <span id="txtProgressVal" class="fw-bold text-primary" style="font-size: 0.85rem;">{{ old('progress', $item['progress'] ?? 0) }}%</span>
                                </div>
                                <div class="d-flex align-items-center gap-2" style="height: 38px;">
                                    <input type="range" class="form-range flex-grow-1" id="inpProgressRange" min="0" max="100" step="5"
                                           value="{{ old('progress', $item['progress'] ?? 0) }}" oninput="syncProgressVal(this.value)">
                                    <input type="number" name="progress" id="inpProgressNum" class="form-control form-control-custom text-center p-1" style="width: 60px;"
                                           min="0" max="100" value="{{ old('progress', $item['progress'] ?? 0) }}" oninput="syncProgressRange(this.value)">
                                </div>
                            </div>
                        </div>

                        <!-- Nomor Dokumen/SK & Tanggal -->
                        <div class="row g-2 mb-3">
                            <div class="col-md-7">
                                <label class="form-label-custom">Nomor Dokumen / SK</label>
                                <input type="text" name="no_izin" id="inpNoIzin" class="form-control form-control-custom font-monospace" 
                                       value="{{ old('no_izin', $item['no_izin']) }}" placeholder="Contoh: 503/124/DPMPTSP/2026">
                            </div>
                            <div class="col-md-5">
                                <label class="form-label-custom">Tanggal Terbit / SK</label>
                                @php
                                    $tglVal = '';
                                    if (!empty($item['tanggal']) && $item['tanggal'] !== '-') {
                                        try {
                                            $tglVal = date('Y-m-d', strtotime(str_replace('/', '-', $item['tanggal'])));
                                        } catch(\Throwable $e) {}
                                    }
                                @endphp
                                <input type="date" name="tanggal" id="inpTanggal" class="form-control form-control-custom" 
                                       value="{{ old('tanggal', $tglVal) }}">
                            </div>
                        </div>

                        <!-- Instansi & Target Selesai -->
                        <div class="row g-2 mb-3">
                            <div class="col-md-7">
                                <label class="form-label-custom">Instansi Terkait / Penerbit</label>
                                <input type="text" name="instansi" class="form-control form-control-custom" 
                                       value="{{ old('instansi', $item['instansi']) }}" placeholder="Contoh: Dinas PUPR / DPMPTSP / BPN">
                            </div>
                            <div class="col-md-5">
                                <label class="form-label-custom">Target Selesai (Deadline)</label>
                                @php
                                    $dlVal = '';
                                    if (!empty($item['target_selesai']) && $item['target_selesai'] !== '-') {
                                        try {
                                            $dlVal = date('Y-m-d', strtotime(str_replace('/', '-', $item['target_selesai'])));
                                        } catch(\Throwable $e) {}
                                    }
                                @endphp
                                <input type="date" name="target_selesai" class="form-control form-control-custom" 
                                       value="{{ old('target_selesai', $dlVal) }}">
                            </div>
                        </div>

                        <hr class="my-3" style="border-color: #f1f5f9;">

                        <!-- BAGIAN UPLOAD BERKAS UTAMA SK -->
                        <div class="mb-3">
                            <label class="form-label-custom d-flex justify-content-between align-items-center">
                                <span>Berkas Dokumen Utama / SK Izin</span>
                                <span class="badge" style="background-color: #fffbeb; border: 1px solid #fde68a; color: #d97706; font-size: 10px; font-weight: 600; padding: 2px 6px; border-radius: 4px;">PDF, JPG, PNG (Maks 20MB)</span>
                            </label>

                            <!-- Kondisi A: Berkas Sudah Ada -->
                            @if(!empty($item['file_dokumen']))
                                <div class="p-3 rounded-3 mb-2" style="background: #f0fdf4; border: 1.5px solid #86efac;">
                                    <div class="d-flex align-items-center justify-content-between gap-2">
                                        <div class="d-flex align-items-center gap-2.5 overflow-hidden">
                                            <div class="p-2 rounded-2 flex-shrink-0" style="background: rgba(0, 201, 167, 0.15); color: #00c9a7;">
                                                <i class="mdi mdi-file-check-outline" style="font-size: 1.35rem;"></i>
                                            </div>
                                            <div class="overflow-hidden">
                                                <span class="d-block fw-bold text-success" style="font-size: 0.85rem; line-height: 1.2;">Berkas Terunggah</span>
                                                <small class="text-muted text-truncate d-block font-monospace" style="font-size: 0.74rem;">{{ basename($item['file_dokumen']) }}</small>
                                            </div>
                                        </div>
                                        <a href="{{ asset('storage/' . $item['file_dokumen']) }}" target="_blank" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm flex-shrink-0" style="background-color: #10b981; border: none; font-size: 0.78rem; border-radius: 6px;">
                                            <i class="mdi mdi-eye me-1"></i> Buka Berkas
                                        </a>
                                    </div>
                                </div>
                            @endif

                            <!-- Box Upload File Utama -->
                            <div onclick="document.getElementById('inpFileDokumen').click()" style="cursor: pointer;">
                                <input type="file" name="file_dokumen" id="inpFileDokumen" class="d-none" accept=".pdf,.jpg,.jpeg,.png" onchange="previewSelectedDoc(this)">
                                <div class="p-3 rounded-3 d-flex align-items-center gap-3" style="border: 1.5px dashed #c4b5fd; background: #ffffff; transition: all 0.2s ease;">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="background: rgba(154, 85, 255, 0.12); width: 42px; height: 42px; color: #9a55ff;">
                                        <i class="mdi mdi-cloud-upload" style="font-size: 1.35rem;"></i>
                                    </div>
                                    <div class="overflow-hidden flex-grow-1">
                                        <span class="fw-bold d-block text-truncate" id="txtUploadMainLabel" style="font-size: 0.85rem; color: #9a55ff;">
                                            {{ !empty($item['file_dokumen']) ? 'Ganti Berkas / Upload Ulang' : 'Pilih / Upload Berkas SK Resmi' }}
                                        </span>
                                        <small class="text-muted d-block" id="txtUploadMainSub" style="font-size: 0.74rem;">Klik di sini untuk memilih file dokumen (PDF, JPG, PNG)</small>
                                    </div>
                                    <span class="btn btn-sm btn-light border px-2.5 py-1 text-secondary fw-semibold" style="font-size: 0.75rem;">Browse</span>
                                </div>
                            </div>
                        </div>

                        <!-- Catatan Lapangan / Kendala -->
                        <div class="mb-2">
                            <label class="form-label-custom">Catatan Lapangan / Catatan Kendala</label>
                            <textarea name="catatan" class="form-control form-control-custom text-dark" rows="3" 
                                      placeholder="Tambahkan informasi progres survei, hasil koordinasi instansi, atau kendala revisi berkas...">{{ old('catatan', $item['catatan']) }}</textarea>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Right Column: Rincian & Prasyarat Dokumen (Checklist Upload Persyaratan) -->
            <div class="col-lg-5">
                <div class="card kelola-card mb-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-2">
                            <div style="width: 32px; height: 32px; border-radius: 6px; background-color: #e0f2fe; color: #0284c7; display: inline-flex; align-items: center; justify-content: center; font-size: 1.15rem; flex-shrink: 0;">
                                <i class="mdi mdi-checkbox-multiple-marked-outline"></i>
                            </div>
                            <h5 class="mb-0 fw-bold text-dark" style="font-size: 0.95rem;">Rincian & Prasyarat</h5>
                        </div>
                        <span class="badge font-monospace fw-semibold px-2 py-1" id="badgeSyaratCount" style="background-color: #94a3b8; color: #ffffff; font-size: 0.75rem; border-radius: 6px;">
                            0/{{ count($item['syarat_items'] ?? []) }} Siap
                        </span>
                    </div>

                    <div class="card-body">
                        <p class="text-muted small mb-3" style="font-size: 0.8rem; line-height: 1.4;">
                            Daftar berkas kelengkapan yang harus dipenuhi sebelum dokumen izin ini dapat disetujui & diterbitkan:
                        </p>

                        <!-- Dynamic Requirements List -->
                        <div class="d-flex flex-column gap-2.5 mb-3" id="containerSyaratList">
                            @php
                                $syaratList = $item['syarat_items'] ?? [];
                                if (empty($syaratList)) {
                                    $syaratList = [
                                        'Salinan KTP & KK Pemohon',
                                        'Legalitas Kepemilikan Lahan',
                                        'Surat Permohonan Resmi'
                                    ];
                                }
                            @endphp

                            @foreach($syaratList as $idx => $sTitle)
                                <div class="border bg-white p-3 syarat-item-block" style="border-radius: 10px; border-color: #e2e8f0;" id="syarat_card_{{ $idx }}">
                                    <!-- Judul Syarat -->
                                    <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
                                        <div class="fw-bold text-dark" style="font-size: 0.85rem; line-height: 1.35;">
                                            <i class="mdi mdi-checkbox-marked-circle text-primary me-1"></i>
                                            {{ is_string($sTitle) ? $sTitle : ($sTitle['title'] ?? 'Syarat ' . ($idx + 1)) }}
                                        </div>
                                        <button type="button" class="btn btn-sm btn-link text-muted p-0" title="Hapus item syarat" onclick="hapusSyaratBlock({{ $idx }})">
                                            <i class="mdi mdi-close" style="font-size: 1rem;"></i>
                                        </button>
                                    </div>

                                    <!-- Upload Box Tunggal Tiap Syarat -->
                                    <div id="syarat_box_upload_{{ $idx }}" class="p-2.5 px-3 d-flex align-items-center justify-content-between syarat-upload-card" 
                                         onclick="document.getElementById('file_input_syarat_{{ $idx }}').click()">
                                        <div class="d-flex align-items-center gap-2.5">
                                            <div id="syarat_circle_{{ $idx }}" class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                                                 style="width: 36px; height: 36px; background-color: #f3e8ff; color: #a855f7;">
                                                <i id="syarat_icon_{{ $idx }}" class="mdi mdi-cloud-upload" style="font-size: 1.15rem;"></i>
                                            </div>
                                            <div>
                                                <div id="syarat_title_{{ $idx }}" class="fw-bold mb-0" style="color: #9333ea; font-size: 0.82rem; line-height: 1.2;">
                                                    Pilih / Upload Berkas
                                                </div>
                                                <small id="syarat_sub_{{ $idx }}" class="text-muted" style="font-size: 0.71rem;">PDF, JPG, PNG (Maks 20MB)</small>
                                            </div>
                                        </div>
                                        <div id="syarat_actions_{{ $idx }}" style="display: none;" class="d-flex align-items-center gap-2" onclick="event.stopPropagation()">
                                            <a href="javascript:void(0)" id="syarat_btn_view_{{ $idx }}" target="_blank"
                                               class="btn btn-sm btn-outline-success px-2 py-0.5 fw-semibold" style="font-size: 0.72rem; border-radius: 4px;">
                                                <i class="mdi mdi-eye-outline me-1"></i>Lihat
                                            </a>
                                            <button type="button" class="btn btn-sm btn-link text-danger p-0"
                                                    title="Hapus Berkas" onclick="removeSyaratFile({{ $idx }})">
                                                <i class="mdi mdi-trash-can-outline" style="font-size: 1.1rem;"></i>
                                            </button>
                                        </div>
                                        <input type="file" name="syarat_files[{{ $idx }}]" id="file_input_syarat_{{ $idx }}" style="display: none;" onchange="handleSyaratFileChosen(this, {{ $idx }})">
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Form Tambah Syarat Baru -->
                        <div class="input-group input-group-sm mb-3">
                            <input type="text" class="form-control" id="inpTambahSyaratManual" placeholder="Tambah syarat baru ke daftar..." style="border-radius: 6px 0 0 6px; font-size: 0.82rem;">
                            <button type="button" class="btn text-white fw-bold px-3" onclick="tambahItemSyaratBaru()" style="background: #9a55ff; border-radius: 0 6px 6px 0; font-size: 0.8rem;">
                                <i class="mdi mdi-plus"></i> Tambah
                            </button>
                        </div>

                        <!-- Info Petunjuk -->
                        <div class="p-2.5 rounded-3" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                            <small class="text-muted d-block" style="font-size: 0.75rem; line-height: 1.4;">
                                <i class="mdi mdi-information-outline text-primary me-1"></i>
                                Semua berkas pendukung tersimpan aman di server dan dapat dipantau oleh tim legal maupun operasional proyek.
                            </small>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Sticky / Fixed Bottom Action Bar -->
        <div class="card border-0 shadow-lg mt-3 p-3 bg-white" style="border-radius: 10px; border: 1px solid #e2e8f0 !important;">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                <div class="d-flex align-items-center gap-2 text-muted" style="font-size: 0.85rem;">
                    <i class="mdi mdi-shield-check text-success fs-5"></i>
                    <span>Pastikan data nomor izin dan tanggal terbit telah sesuai sebelum menyimpan.</span>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('perizinan.show', $project['id']) }}" class="btn fw-semibold px-3 py-2 btn-kembali-proyek">
                        <i class="mdi mdi-close me-1"></i> Batal
                    </a>
                    <button type="submit" class="btn text-white fw-bold px-4 py-2 shadow-sm d-inline-flex align-items-center gap-2" style="background: linear-gradient(135deg, #00c9a7, #059669); border: none; border-radius: 8px; font-size: 0.88rem;">
                        <i class="mdi mdi-content-save" style="font-size: 1.1rem;"></i>
                        <span>Simpan Dokumen Perizinan</span>
                    </button>
                </div>
            </div>
        </div>
    </form>

</div>
@endsection

@push('scripts')
<script>
    // Inisialisasi Status Badge pada load
    document.addEventListener('DOMContentLoaded', function() {
        var statusSelect = document.getElementById('inpStatus');
        if (statusSelect) {
            syncStatusChange(statusSelect.value);
        }
        updateBadgeSyaratCounter();
    });

    // SINKRONISASI STATUS DOKUMEN & BADGE
    function syncStatusChange(val) {
        var topBadge = document.getElementById('topStatusBadge');
        var topText = document.getElementById('topStatusText');

        if (val === 'Terbit' || val === 'terbit' || val === 'selesai' || val === 'Selesai') {
            topBadge.style.backgroundColor = '#00c9a7';
            topBadge.style.color = '#ffffff';
            topBadge.style.border = 'none';
            topText.innerHTML = '<i class="mdi mdi-shield-check me-1"></i>Selesai / Terbit';
            // Auto set progress 100% jika belum 100
            var progNum = document.getElementById('inpProgressNum');
            if (progNum && parseInt(progNum.value) < 100) {
                syncProgressVal(100);
            }
        } else if (val === 'Proses' || val === 'proses' || val === 'Berjalan' || val === 'Dalam Proses') {
            topBadge.style.backgroundColor = '#fffbeb';
            topBadge.style.border = '1px solid #fde68a';
            topBadge.style.color = '#d97706';
            topText.innerHTML = '<i class="mdi mdi-clock-outline me-1"></i>Sedang Proses';
        } else if (val === 'Revisi' || val === 'Tertunda' || val === 'Terkendala') {
            topBadge.style.backgroundColor = '#fff1f2';
            topBadge.style.border = '1px solid #fecdd3';
            topBadge.style.color = '#e11d48';
            topText.innerHTML = '<i class="mdi mdi-alert-circle me-1"></i>Ditolak / Kendala';
        } else {
            topBadge.style.backgroundColor = '#ffffff';
            topBadge.style.border = '1px solid #e2e8f0';
            topBadge.style.color = '#94a3b8';
            topText.innerHTML = 'Belum Ada';
        }
    }

    // SINKRONISASI SLIDER & NUMBER PROGRESS
    function syncProgressVal(val) {
        document.getElementById('txtProgressVal').textContent = val + '%';
        document.getElementById('inpProgressNum').value = val;
        document.getElementById('inpProgressRange').value = val;
    }
    function syncProgressRange(val) {
        var v = Math.min(100, Math.max(0, parseInt(val) || 0));
        document.getElementById('txtProgressVal').textContent = v + '%';
        document.getElementById('inpProgressRange').value = v;
    }

    // PREVIEW FILE UTAMA YANG DIPILIH
    function previewSelectedDoc(input) {
        if (input.files && input.files[0]) {
            var file = input.files[0];
            document.getElementById('txtUploadMainLabel').textContent = file.name;
            document.getElementById('txtUploadMainLabel').style.color = '#10b981';
            document.getElementById('txtUploadMainSub').textContent = 'File terpilih (' + (file.size / 1024 / 1024).toFixed(2) + ' MB). Klik Simpan untuk mengunggah.';
        }
    }

    // CHECKLIST UPLOAD PERSYARATAN BERKAS
    var uploadedSyaratMap = {};

    function handleSyaratFileChosen(input, idx) {
        if (input.files && input.files[0]) {
            var file = input.files[0];
            uploadedSyaratMap[idx] = true;

            var box = document.getElementById('syarat_box_upload_' + idx);
            if (box) {
                box.classList.add('uploaded');
                box.style.borderColor = '#86efac';
                box.style.background = '#f0fdf4';
            }

            var circle = document.getElementById('syarat_circle_' + idx);
            if (circle) {
                circle.style.backgroundColor = '#dcfce7';
                circle.style.color = '#16a34a';
            }

            var icon = document.getElementById('syarat_icon_' + idx);
            if (icon) icon.className = 'mdi mdi-file-check';

            var title = document.getElementById('syarat_title_' + idx);
            if (title) {
                title.textContent = file.name;
                title.style.color = '#16a34a';
            }

            var sub = document.getElementById('syarat_sub_' + idx);
            if (sub) sub.textContent = 'Berkas siap & valid • Klik untuk ganti';

            var actions = document.getElementById('syarat_actions_' + idx);
            if (actions) actions.style.display = 'flex';

            var btnView = document.getElementById('syarat_btn_view_' + idx);
            if (btnView) btnView.href = URL.createObjectURL(file);

            updateBadgeSyaratCounter();
        }
    }

    function removeSyaratFile(idx) {
        uploadedSyaratMap[idx] = false;

        var box = document.getElementById('syarat_box_upload_' + idx);
        if (box) {
            box.classList.remove('uploaded');
            box.style.borderColor = '#c084fc';
            box.style.background = '#faf5ff';
        }

        var circle = document.getElementById('syarat_circle_' + idx);
        if (circle) {
            circle.style.backgroundColor = '#f3e8ff';
            circle.style.color = '#a855f7';
        }

        var icon = document.getElementById('syarat_icon_' + idx);
        if (icon) icon.className = 'mdi mdi-cloud-upload';

        var title = document.getElementById('syarat_title_' + idx);
        if (title) {
            title.textContent = 'Pilih / Upload Berkas';
            title.style.color = '#9333ea';
        }

        var sub = document.getElementById('syarat_sub_' + idx);
        if (sub) sub.textContent = 'PDF, JPG, PNG (Maks 20MB)';

        var actions = document.getElementById('syarat_actions_' + idx);
        if (actions) actions.style.display = 'none';

        var input = document.getElementById('file_input_syarat_' + idx);
        if (input) input.value = '';

        updateBadgeSyaratCounter();
    }

    function updateBadgeSyaratCounter() {
        var cards = document.querySelectorAll('.syarat-item-block');
        var total = cards.length;
        var count = 0;
        for (var k in uploadedSyaratMap) {
            if (uploadedSyaratMap[k] === true) count++;
        }

        var badge = document.getElementById('badgeSyaratCount');
        if (badge) {
            badge.textContent = count + '/' + total + ' Siap';
            if (count === total && total > 0) {
                badge.style.backgroundColor = '#10b981';
            } else {
                badge.style.backgroundColor = '#94a3b8';
            }
        }
    }

    function hapusSyaratBlock(idx) {
        var card = document.getElementById('syarat_card_' + idx);
        if (card) {
            card.remove();
            delete uploadedSyaratMap[idx];
            updateBadgeSyaratCounter();
        }
    }

    function tambahItemSyaratBaru() {
        var inp = document.getElementById('inpTambahSyaratManual');
        var val = (inp.value || '').trim();
        if (!val) return;

        var container = document.getElementById('containerSyaratList');
        var newIdx = Date.now();

        var card = document.createElement('div');
        card.className = 'border bg-white p-3 syarat-item-block';
        card.style.borderRadius = '10px';
        card.style.borderColor = '#e2e8f0';
        card.id = 'syarat_card_' + newIdx;

        card.innerHTML = `
            <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
                <div class="fw-bold text-dark" style="font-size: 0.85rem; line-height: 1.35;">
                    <i class="mdi mdi-checkbox-marked-circle text-primary me-1"></i>
                    ${val}
                </div>
                <button type="button" class="btn btn-sm btn-link text-muted p-0" title="Hapus item syarat" onclick="hapusSyaratBlock(${newIdx})">
                    <i class="mdi mdi-close" style="font-size: 1rem;"></i>
                </button>
            </div>
            <div id="syarat_box_upload_${newIdx}" class="p-2.5 px-3 d-flex align-items-center justify-content-between syarat-upload-card" 
                 onclick="document.getElementById('file_input_syarat_${newIdx}').click()">
                <div class="d-flex align-items-center gap-2.5">
                    <div id="syarat_circle_${newIdx}" class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                         style="width: 36px; height: 36px; background-color: #f3e8ff; color: #a855f7;">
                        <i id="syarat_icon_${newIdx}" class="mdi mdi-cloud-upload" style="font-size: 1.15rem;"></i>
                    </div>
                    <div>
                        <div id="syarat_title_${newIdx}" class="fw-bold mb-0" style="color: #9333ea; font-size: 0.82rem; line-height: 1.2;">
                            Pilih / Upload Berkas
                        </div>
                        <small id="syarat_sub_${newIdx}" class="text-muted" style="font-size: 0.71rem;">PDF, JPG, PNG (Maks 20MB)</small>
                    </div>
                </div>
                <div id="syarat_actions_${newIdx}" style="display: none;" class="d-flex align-items-center gap-2" onclick="event.stopPropagation()">
                    <a href="javascript:void(0)" id="syarat_btn_view_${newIdx}" target="_blank"
                       class="btn btn-sm btn-outline-success px-2 py-0.5 fw-semibold" style="font-size: 0.72rem; border-radius: 4px;">
                        <i class="mdi mdi-eye-outline me-1"></i>Lihat
                    </a>
                    <button type="button" class="btn btn-sm btn-link text-danger p-0"
                            title="Hapus Berkas" onclick="removeSyaratFile(${newIdx})">
                        <i class="mdi mdi-trash-can-outline" style="font-size: 1.1rem;"></i>
                    </button>
                </div>
                <input type="file" name="syarat_files[${newIdx}]" id="file_input_syarat_${newIdx}" style="display: none;" onchange="handleSyaratFileChosen(this, ${newIdx})">
            </div>
        `;

        container.appendChild(card);
        inp.value = '';
        updateBadgeSyaratCounter();
    }
</script>
@endpush
