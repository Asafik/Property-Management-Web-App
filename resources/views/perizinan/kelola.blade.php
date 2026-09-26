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
        .syarat-item-block {
            border: 1.5px solid #e2e8f0 !important;
            border-radius: 10px !important;
            background: #ffffff !important;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02) !important;
            transition: all 0.2s ease;
        }
        .syarat-item-block.is-ready {
            border-color: #86efac !important;
        }
        .syarat-tambah-box {
            display: flex;
            align-items: stretch;
            width: 100%;
            border-radius: 8px;
            overflow: hidden;
            border: 1.5px solid #cbd5e1;
            background: #ffffff;
            transition: all 0.15s ease;
        }
        .syarat-tambah-box:focus-within {
            border-color: #9a55ff;
            box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.15);
        }
        .syarat-tambah-input {
            border: none !important;
            outline: none !important;
            padding: 0.55rem 0.85rem;
            font-size: 0.84rem;
            color: #1e293b;
            flex-grow: 1;
            background: transparent;
        }
        .syarat-tambah-btn {
            background: linear-gradient(135deg, #9a55ff, #8b5cf6) !important;
            border: none !important;
            color: #ffffff !important;
            font-size: 0.82rem !important;
            font-weight: 700 !important;
            padding: 0.55rem 1.15rem !important;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            white-space: nowrap;
            cursor: pointer;
            transition: all 0.15s ease;
        }
        .btn-syarat-lihat {
            background-color: #10b981 !important;
            color: #ffffff !important;
            border: none !important;
            font-size: 0.74rem !important;
            font-weight: 700 !important;
            padding: 4px 9px !important;
            border-radius: 6px !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 4px !important;
            text-decoration: none !important;
            box-shadow: 0 1px 3px rgba(16, 185, 129, 0.3) !important;
            cursor: pointer !important;
            white-space: nowrap !important;
        }
        .btn-syarat-lihat:hover {
            background-color: #059669 !important;
            color: #ffffff !important;
        }
        .btn-syarat-hapus {
            background-color: #fee2e2 !important;
            color: #dc2626 !important;
            border: 1px solid #fca5a5 !important;
            font-size: 0.74rem !important;
            font-weight: 700 !important;
            padding: 4px 8px !important;
            border-radius: 6px !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 3px !important;
            cursor: pointer !important;
            white-space: nowrap !important;
        }
        .btn-syarat-hapus:hover {
            background-color: #ef4444 !important;
            color: #ffffff !important;
            border-color: #ef4444 !important;
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

                        <!-- Status Dokumen & Progres Otomatis -->
                        <div class="row g-2 mb-3">
                            <div class="col-md-6">
                                <label class="form-label-custom">Status Dokumen <span class="text-danger">*</span></label>
                                <select name="status" id="inpStatus" class="form-select form-select-custom fw-bold" onchange="syncStatusChange(this.value, false)" required>
                                    <option value="Belum" {{ old('status', $item['status']) == 'Belum' ? 'selected' : '' }}>Belum Ada (Menunggu)</option>
                                    <option value="Proses" {{ in_array(old('status', $item['status']), ['Proses', 'Berjalan', 'Dalam Proses']) ? 'selected' : '' }}>Sedang Proses Dinas</option>
                                    <option value="Terbit" {{ in_array(old('status', $item['status']), ['Terbit', 'Selesai']) ? 'selected' : '' }}>Selesai / Terbit Resmi</option>
                                    <option value="Revisi" {{ in_array(old('status', $item['status']), ['Revisi', 'Tertunda', 'Terkendala']) ? 'selected' : '' }}>Ditolak / Perlu Revisi / Kendala</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <label class="form-label-custom mb-0 d-flex align-items-center gap-1.5">
                                        <i class="mdi mdi-calculator text-primary"></i>
                                        <span>Progres Berkas (Otomatis)</span>
                                    </label>
                                    <span id="txtProgressVal" class="badge px-2.5 py-1 fw-bold" style="font-size: 0.82rem; background: #f3e8ff; color: #9333ea; border-radius: 6px;">
                                        {{ old('progress', $item['progress'] ?? 0) }}%
                                    </span>
                                </div>
                                <!-- Real-time Auto Progress Bar -->
                                <div class="progress rounded-pill my-1" style="height: 10px; background-color: #f1f5f9; overflow: hidden; border: 1px solid #e2e8f0;">
                                    <div id="barProgressAuto" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" 
                                         style="width: {{ old('progress', $item['progress'] ?? 0) }}%; background: linear-gradient(90deg, #9a55ff, #00c9a7); transition: width 0.4s ease;" 
                                         aria-valuenow="{{ old('progress', $item['progress'] ?? 0) }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mt-1">
                                    <small class="text-muted" id="txtProgressDesc" style="font-size: 0.72rem;">
                                        {{ $item['uploaded_count'] ?? 0 }} dari {{ count($item['syarat_items'] ?? []) }} berkas terunggah
                                    </small>
                                    <span class="badge" style="font-size: 0.68rem; background: #f8fafc; color: #64748b; border: 1px solid #e2e8f0;">
                                        <i class="mdi mdi-sync me-0.5"></i> Auto
                                    </span>
                                </div>
                                <input type="hidden" name="progress" id="inpProgressHidden" value="{{ old('progress', $item['progress'] ?? 0) }}">
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

                        <!-- BAGIAN UPLOAD BERKAS UTAMA SK (1 Card dengan 2 Tombol: Lihat & Ganti) -->
                        <div class="mb-3">
                            <label class="form-label-custom d-flex justify-content-between align-items-center">
                                <span>Berkas Dokumen Utama / SK Izin</span>
                                <span class="badge" style="background-color: #fffbeb; border: 1px solid #fde68a; color: #d97706; font-size: 10px; font-weight: 600; padding: 2px 6px; border-radius: 4px;">PDF, JPG, PNG (Maks 20MB)</span>
                            </label>

                            <input type="file" name="file_dokumen" id="inpFileDokumen" class="d-none" accept=".pdf,.jpg,.jpeg,.png" onchange="previewSelectedDoc(this)">

                            @php
                                $hasMainDoc = !empty($item['file_dokumen']);
                                $mainDocUrl = $hasMainDoc 
                                    ? (str_starts_with($item['file_dokumen'], 'http') 
                                        ? $item['file_dokumen'] 
                                        : (str_starts_with($item['file_dokumen'], 'uploads/') ? asset($item['file_dokumen']) : asset('storage/' . $item['file_dokumen'])))
                                    : '#';
                            @endphp

                            <!-- Card Saat Berkas Sudah Terunggah (Tunggal dengan 2 Tombol: Lihat & Ganti) -->
                            <div id="mainDocUploadedCard" class="p-3 rounded-3" style="background: #f0fdf4; border: 1.5px solid #86efac; display: {{ $hasMainDoc ? 'block' : 'none' }};">
                                <div class="d-flex align-items-center justify-content-between gap-2 flex-wrap">
                                    <div class="d-flex align-items-center gap-2.5 overflow-hidden flex-grow-1 me-2">
                                        <div class="p-2 rounded-2 flex-shrink-0" style="background: rgba(0, 201, 167, 0.15); color: #00c9a7;">
                                            <i class="mdi mdi-file-check-outline" style="font-size: 1.35rem;"></i>
                                        </div>
                                        <div class="overflow-hidden">
                                            <span class="d-block fw-bold text-success" id="mainDocStatusText" style="font-size: 0.85rem; line-height: 1.2;">Berkas Terunggah</span>
                                            <small class="text-muted text-truncate d-block font-monospace" id="mainDocFileName" style="font-size: 0.74rem;">{{ basename($item['file_dokumen'] ?? '') }}</small>
                                        </div>
                                    </div>
                                    <!-- 2 BUTTONS: LIHAT & GANTI -->
                                    <div class="d-flex align-items-center gap-2 flex-shrink-0">
                                        <a href="{{ $mainDocUrl }}" target="_blank" id="btnMainDocView" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center gap-1.5" style="background-color: #10b981; border: none; font-size: 0.78rem; border-radius: 6px;">
                                            <i class="mdi mdi-eye" style="font-size: 0.95rem;"></i>
                                            <span>Lihat</span>
                                        </a>
                                        <button type="button" onclick="document.getElementById('inpFileDokumen').click()" class="btn btn-sm btn-light border fw-semibold px-3 py-1.5 shadow-sm d-inline-flex align-items-center gap-1.5" style="font-size: 0.78rem; border-radius: 6px; color: #475569;">
                                            <i class="mdi mdi-cloud-sync text-primary" style="font-size: 0.95rem;"></i>
                                            <span>Ganti</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Box Upload Saat Berkas Masih Kosong -->
                            <div id="mainDocEmptyBox" onclick="document.getElementById('inpFileDokumen').click()" style="cursor: pointer; display: {{ $hasMainDoc ? 'none' : 'block' }};">
                                <div class="p-3 rounded-3 d-flex align-items-center gap-3" style="border: 1.5px dashed #c4b5fd; background: #ffffff; transition: all 0.2s ease;">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="background: rgba(154, 85, 255, 0.12); width: 42px; height: 42px; color: #9a55ff;">
                                        <i class="mdi mdi-cloud-upload" style="font-size: 1.35rem;"></i>
                                    </div>
                                    <div class="overflow-hidden flex-grow-1">
                                        <span class="fw-bold d-block text-truncate" id="txtUploadMainLabel" style="font-size: 0.85rem; color: #9a55ff;">
                                            Pilih / Upload Berkas SK Resmi
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
                        <span class="badge font-monospace fw-semibold px-2.5 py-1" id="badgeSyaratCount" style="background-color: #94a3b8; color: #ffffff; font-size: 0.75rem; border-radius: 6px;">
                            0/{{ count($item['syarat_items'] ?? []) }} Siap
                        </span>
                    </div>

                    <div class="card-body">
                        <p class="text-muted small mb-3" style="font-size: 0.8rem; line-height: 1.4;">
                            Daftar berkas kelengkapan yang harus dipenuhi. Persentase progres dihitung otomatis berdasarkan jumlah berkas yang diunggah:
                        </p>

                        <!-- Dynamic Requirements List -->
                        <div class="d-flex flex-column mb-3" style="gap: 12px;" id="containerSyaratList">
                            @php
                                $syaratList = $item['syarat_items'] ?? [];
                                if (empty($syaratList)) {
                                    $syaratList = [
                                        'Salinan Akta Pelepasan Hak dari Notaris',
                                        'Berkas Kepemilikan Tanah Asli',
                                        'Legalitas Perusahaan PT'
                                    ];
                                }
                                $syaratFiles = $item['syarat_files'] ?? [];
                            @endphp

                            @foreach($syaratList as $idx => $sTitle)
                                @php
                                    $itemTitle = is_string($sTitle) ? $sTitle : ($sTitle['title'] ?? 'Syarat ' . ($idx + 1));
                                    $itemFile = $syaratFiles[$idx] ?? ($syaratFiles[$itemTitle] ?? null);
                                    $hasFile = !empty($itemFile);
                                    $fileUrl = $hasFile ? (str_starts_with($itemFile, 'http') ? $itemFile : asset($itemFile)) : 'javascript:void(0)';
                                    $fileName = $hasFile ? basename($itemFile) : '';
                                @endphp

                                <div class="border bg-white p-3 syarat-item-block {{ $hasFile ? 'is-ready' : '' }}" style="border-radius: 10px; border-color: {{ $hasFile ? '#86efac' : '#e2e8f0' }} !important;" id="syarat_card_{{ $idx }}">
                                    <!-- Input Nama Syarat untuk dikirim ke backend -->
                                    <input type="hidden" name="syarat_items[{{ $idx }}]" value="{{ $itemTitle }}" id="syarat_title_input_{{ $idx }}">
                                    @if($hasFile)
                                        <input type="hidden" name="existing_syarat_files[{{ $idx }}]" value="{{ $itemFile }}" id="existing_file_{{ $idx }}">
                                    @endif

                                    <!-- Judul Syarat -->
                                    <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
                                        <div class="fw-bold {{ $hasFile ? 'text-success' : 'text-dark' }}" style="font-size: 0.85rem; line-height: 1.35;" id="syarat_header_text_{{ $idx }}">
                                            <i class="mdi {{ $hasFile ? 'mdi-check-circle text-success' : 'mdi-checkbox-blank-circle-outline text-primary' }} me-1" id="syarat_status_icon_{{ $idx }}"></i>
                                            <span>{{ $itemTitle }}</span>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-link text-muted p-0" title="Hapus item syarat" onclick="hapusSyaratBlock('{{ $idx }}')">
                                            <i class="mdi mdi-close" style="font-size: 1rem;"></i>
                                        </button>
                                    </div>

                                    <!-- Upload Box Tunggal Tiap Syarat -->
                                    <div id="syarat_box_upload_{{ $idx }}" 
                                         class="p-2.5 px-3 d-flex align-items-center justify-content-between syarat-upload-card {{ $hasFile ? 'uploaded' : '' }}" 
                                         onclick="document.getElementById('file_input_syarat_{{ $idx }}').click()"
                                         style="{{ $hasFile ? 'border-color: #86efac; background: #f0fdf4;' : '' }}">
                                        <div class="d-flex align-items-center gap-2.5 overflow-hidden me-2">
                                            <div id="syarat_circle_{{ $idx }}" class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                                                 style="width: 36px; height: 36px; background-color: {{ $hasFile ? '#dcfce7' : '#f3e8ff' }}; color: {{ $hasFile ? '#16a34a' : '#a855f7' }};">
                                                <i id="syarat_icon_{{ $idx }}" class="mdi {{ $hasFile ? 'mdi-file-check' : 'mdi-cloud-upload' }}" style="font-size: 1.15rem;"></i>
                                            </div>
                                            <div class="overflow-hidden">
                                                <div id="syarat_title_{{ $idx }}" class="fw-bold mb-0 text-truncate" style="color: {{ $hasFile ? '#16a34a' : '#9333ea' }}; font-size: 0.82rem; line-height: 1.2;">
                                                    {{ $hasFile ? $fileName : 'Pilih / Upload Berkas' }}
                                                </div>
                                                <small id="syarat_sub_{{ $idx }}" class="text-muted d-block text-truncate" style="font-size: 0.71rem;">
                                                    {{ $hasFile ? 'Berkas terunggah • Klik untuk ganti' : 'PDF, JPG, PNG (Maks 20MB)' }}
                                                </small>
                                            </div>
                                        </div>
                                        <div id="syarat_actions_{{ $idx }}" class="{{ $hasFile ? 'd-flex' : 'd-none' }} align-items-center gap-1.5 flex-shrink-0" onclick="event.stopPropagation()">
                                            <a href="{{ $fileUrl }}" id="syarat_btn_view_{{ $idx }}" target="_blank" class="btn-syarat-lihat">
                                                <i class="mdi mdi-eye"></i>
                                                <span>Lihat</span>
                                            </a>
                                            <button type="button" class="btn-syarat-hapus" title="Hapus Berkas" onclick="removeSyaratFile('{{ $idx }}')">
                                                <i class="mdi mdi-trash-can-outline"></i>
                                                <span>Hapus</span>
                                            </button>
                                        </div>
                                        <input type="file" name="syarat_files[{{ $idx }}]" id="file_input_syarat_{{ $idx }}" style="display: none;" accept=".pdf,.jpg,.jpeg,.png" onchange="handleSyaratFileChosen(this, '{{ $idx }}')">
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Form Tambah Syarat Baru -->
                        <div class="syarat-tambah-box mb-3">
                            <input type="text" class="syarat-tambah-input" id="inpTambahSyaratManual" 
                                   placeholder="Tambah syarat baru ke daftar..." 
                                   onkeydown="if(event.key === 'Enter'){ event.preventDefault(); tambahItemSyaratBaru(); }">
                            <button type="button" class="syarat-tambah-btn" onclick="tambahItemSyaratBaru()">
                                <i class="mdi mdi-plus fs-6"></i>
                                <span>Tambah</span>
                            </button>
                        </div>

                        <!-- Container untuk file yang dihapus -->
                        <div id="deletedFilesContainer"></div>

                        <!-- Info Petunjuk -->
                        <div class="p-2.5 rounded-3" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                            <small class="text-muted d-block" style="font-size: 0.75rem; line-height: 1.4;">
                                <i class="mdi mdi-information-outline text-primary me-1"></i>
                                Semua berkas prasyarat tersimpan aman di server dan progres persentase akan dihitung secara otomatis saat berkas diunggah.
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
                    <span>Pastikan data nomor izin dan berkas prasyarat telah lengkap sebelum menyimpan.</span>
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
    // Map status berkas yang telah diunggah
    var uploadedSyaratMap = {};

    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi peta berkas dari PHP
        @foreach($syaratList as $idx => $sTitle)
            @php
                $itemTitle = is_string($sTitle) ? $sTitle : ($sTitle['title'] ?? 'Syarat ' . ($idx + 1));
                $hasFile = !empty($syaratFiles[$idx]) || !empty($syaratFiles[$itemTitle]);
            @endphp
            uploadedSyaratMap['{{ $idx }}'] = {{ $hasFile ? 'true' : 'false' }};
        @endforeach

        recalcProgressAuto(false);
    });

    // HITUNG PROGRES OTOMATIS & SINKRONKAN
    function recalcProgressAuto(autoSyncStatus = true) {
        var blocks = document.querySelectorAll('.syarat-item-block');
        var total = blocks.length;
        var count = 0;

        blocks.forEach(function(b) {
            var rawId = b.id.replace('syarat_card_', '');
            if (uploadedSyaratMap[rawId] === true) {
                count++;
            }
        });

        var percent = 0;
        if (total > 0) {
            percent = Math.round((count / total) * 100);
        }

        // Cek file SK utama
        var mainFileInput = document.getElementById('inpFileDokumen');
        var hasMainFileUploaded = {{ !empty($item['file_dokumen']) ? 'true' : 'false' }};
        var hasMainFileSelected = mainFileInput && mainFileInput.files && mainFileInput.files.length > 0;
        if (hasMainFileUploaded || hasMainFileSelected) {
            // Berkas SK utama ada / dipilih
            if (percent < 100 && total === 0) {
                percent = 100;
            }
        }

        // Perbarui UI Progress Bar
        var bar = document.getElementById('barProgressAuto');
        var txtVal = document.getElementById('txtProgressVal');
        var txtDesc = document.getElementById('txtProgressDesc');
        var inpHidden = document.getElementById('inpProgressHidden');
        var badgeCount = document.getElementById('badgeSyaratCount');

        if (bar) {
            bar.style.width = percent + '%';
            bar.setAttribute('aria-valuenow', percent);
            if (percent === 100) {
                bar.style.background = '#10b981';
            } else {
                bar.style.background = 'linear-gradient(90deg, #9a55ff, #00c9a7)';
            }
        }

        if (txtVal) {
            txtVal.textContent = percent + '%';
            if (percent === 100) {
                txtVal.style.background = '#dcfce7';
                txtVal.style.color = '#16a34a';
            } else if (percent > 0) {
                txtVal.style.background = '#f3e8ff';
                txtVal.style.color = '#9333ea';
            } else {
                txtVal.style.background = '#f1f5f9';
                txtVal.style.color = '#64748b';
            }
        }

        if (txtDesc) {
            txtDesc.textContent = count + ' dari ' + total + ' berkas prasyarat terunggah';
        }

        if (inpHidden) {
            inpHidden.value = percent;
        }

        if (badgeCount) {
            badgeCount.textContent = count + '/' + total + ' Siap';
            if (count === total && total > 0) {
                badgeCount.style.backgroundColor = '#10b981';
            } else {
                badgeCount.style.backgroundColor = '#94a3b8';
            }
        }

        // Sinkronisasi dropdown Status
        if (autoSyncStatus) {
            var statusSelect = document.getElementById('inpStatus');
            if (statusSelect) {
                var currentStatus = statusSelect.value;
                if (currentStatus !== 'Revisi') {
                    if (percent === 100) {
                        statusSelect.value = 'Terbit';
                    } else if (percent > 0) {
                        statusSelect.value = 'Proses';
                    } else {
                        statusSelect.value = 'Belum';
                    }
                    syncStatusChange(statusSelect.value, false);
                }
            }
        } else {
            var statusSelect = document.getElementById('inpStatus');
            if (statusSelect) {
                syncStatusChange(statusSelect.value, false);
            }
        }
    }

    // SINKRONISASI STATUS DOKUMEN & BADGE HEADER
    function syncStatusChange(val, updateProgress = true) {
        var topBadge = document.getElementById('topStatusBadge');
        var topText = document.getElementById('topStatusText');

        if (val === 'Terbit' || val === 'terbit' || val === 'selesai' || val === 'Selesai') {
            topBadge.style.backgroundColor = '#00c9a7';
            topBadge.style.color = '#ffffff';
            topBadge.style.border = 'none';
            topText.innerHTML = '<i class="mdi mdi-shield-check me-1"></i>Selesai / Terbit';
            if (updateProgress) {
                var inpHidden = document.getElementById('inpProgressHidden');
                if (inpHidden && parseInt(inpHidden.value) < 100) {
                    var bar = document.getElementById('barProgressAuto');
                    var txtVal = document.getElementById('txtProgressVal');
                    if (bar) { bar.style.width = '100%'; bar.style.background = '#10b981'; }
                    if (txtVal) { txtVal.textContent = '100%'; txtVal.style.background = '#dcfce7'; txtVal.style.color = '#16a34a'; }
                    inpHidden.value = 100;
                }
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

    // PREVIEW FILE UTAMA YANG DIPILIH
    function previewSelectedDoc(input) {
        if (input.files && input.files[0]) {
            var file = input.files[0];
            var objUrl = URL.createObjectURL(file);

            // Sembunyikan box upload kosong jika ada, dan tampilkan card uploaded
            var emptyBox = document.getElementById('mainDocEmptyBox');
            var cardUploaded = document.getElementById('mainDocUploadedCard');
            if (emptyBox) emptyBox.style.display = 'none';
            if (cardUploaded) cardUploaded.style.display = 'block';

            // Perbarui nama file & status di card uploaded
            var fileNameEl = document.getElementById('mainDocFileName');
            if (fileNameEl) fileNameEl.textContent = file.name + ' (' + (file.size / 1024 / 1024).toFixed(2) + ' MB)';

            var statusTextEl = document.getElementById('mainDocStatusText');
            if (statusTextEl) {
                statusTextEl.textContent = 'Berkas Baru Terpilih (Belum Disimpan)';
                statusTextEl.classList.remove('text-success');
                statusTextEl.classList.add('text-primary');
            }

            // Perbarui tombol Lihat agar membuka berkas yang baru dipilih
            var btnView = document.getElementById('btnMainDocView');
            if (btnView) {
                btnView.href = objUrl;
            }

            var txtLabel = document.getElementById('txtUploadMainLabel');
            if (txtLabel) {
                txtLabel.textContent = file.name;
                txtLabel.style.color = '#10b981';
            }
            var txtSub = document.getElementById('txtUploadMainSub');
            if (txtSub) {
                txtSub.textContent = 'File terpilih (' + (file.size / 1024 / 1024).toFixed(2) + ' MB). Klik Simpan untuk mengunggah.';
            }

            recalcProgressAuto(true);
        }
    }

    // HANDLE UPLOAD BERKAS PRASYARAT
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

            var headerText = document.getElementById('syarat_header_text_' + idx);
            if (headerText) {
                headerText.classList.remove('text-dark');
                headerText.classList.add('text-success');
            }

            var statusIcon = document.getElementById('syarat_status_icon_' + idx);
            if (statusIcon) {
                statusIcon.className = 'mdi mdi-check-circle text-success me-1';
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
            if (actions) {
                actions.classList.remove('d-none');
                actions.classList.add('d-flex');
            }

            var btnView = document.getElementById('syarat_btn_view_' + idx);
            if (btnView) btnView.href = URL.createObjectURL(file);

            recalcProgressAuto(true);
        }
    }

    // HAPUS BERKAS PRASYARAT
    function removeSyaratFile(idx) {
        uploadedSyaratMap[idx] = false;

        var existingInp = document.getElementById('existing_file_' + idx);
        if (existingInp && existingInp.value) {
            var delContainer = document.getElementById('deletedFilesContainer');
            if (delContainer) {
                var delInp = document.createElement('input');
                delInp.type = 'hidden';
                delInp.name = 'deleted_syarat_files[]';
                delInp.value = idx;
                delContainer.appendChild(delInp);
            }
            existingInp.remove();
        }

        var box = document.getElementById('syarat_box_upload_' + idx);
        if (box) {
            box.classList.remove('uploaded');
            box.style.borderColor = '#c084fc';
            box.style.background = '#faf5ff';
        }

        var headerText = document.getElementById('syarat_header_text_' + idx);
        if (headerText) {
            headerText.classList.remove('text-success');
            headerText.classList.add('text-dark');
        }

        var statusIcon = document.getElementById('syarat_status_icon_' + idx);
        if (statusIcon) {
            statusIcon.className = 'mdi mdi-checkbox-blank-circle-outline text-primary me-1';
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
        if (actions) {
            actions.classList.remove('d-flex');
            actions.classList.add('d-none');
        }

        var input = document.getElementById('file_input_syarat_' + idx);
        if (input) input.value = '';

        recalcProgressAuto(true);
    }

    // HAPUS SATU BLOK SYARAT
    function hapusSyaratBlock(idx) {
        var card = document.getElementById('syarat_card_' + idx);
        if (card) {
            var existingInp = document.getElementById('existing_file_' + idx);
            if (existingInp && existingInp.value) {
                var delContainer = document.getElementById('deletedFilesContainer');
                if (delContainer) {
                    var delInp = document.createElement('input');
                    delInp.type = 'hidden';
                    delInp.name = 'deleted_syarat_files[]';
                    delInp.value = idx;
                    delContainer.appendChild(delInp);
                }
            }
            card.remove();
            delete uploadedSyaratMap[idx];
            recalcProgressAuto(true);
        }
    }

    // TAMBAH SYARAT BARU
    function tambahItemSyaratBaru() {
        var inp = document.getElementById('inpTambahSyaratManual');
        var val = (inp.value || '').trim();
        if (!val) return;

        var container = document.getElementById('containerSyaratList');
        var newIdx = 'syarat_' + Date.now();

        var card = document.createElement('div');
        card.className = 'border bg-white p-3 syarat-item-block';
        card.style.borderRadius = '10px';
        card.style.borderColor = '#e2e8f0';
        card.id = 'syarat_card_' + newIdx;

        card.innerHTML = `
            <input type="hidden" name="syarat_items[${newIdx}]" value="${val}" id="syarat_title_input_${newIdx}">
            <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
                <div class="fw-bold text-dark" style="font-size: 0.85rem; line-height: 1.35;" id="syarat_header_text_${newIdx}">
                    <i class="mdi mdi-checkbox-blank-circle-outline text-primary me-1" id="syarat_status_icon_${newIdx}"></i>
                    <span>${val}</span>
                </div>
                <button type="button" class="btn btn-sm btn-link text-muted p-0" title="Hapus item syarat" onclick="hapusSyaratBlock('${newIdx}')">
                    <i class="mdi mdi-close" style="font-size: 1rem;"></i>
                </button>
            </div>
            <div id="syarat_box_upload_${newIdx}" class="p-2.5 px-3 d-flex align-items-center justify-content-between syarat-upload-card" 
                 onclick="document.getElementById('file_input_syarat_${newIdx}').click()">
                <div class="d-flex align-items-center gap-2.5 overflow-hidden me-2">
                    <div id="syarat_circle_${newIdx}" class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                         style="width: 36px; height: 36px; background-color: #f3e8ff; color: #a855f7;">
                        <i id="syarat_icon_${newIdx}" class="mdi mdi-cloud-upload" style="font-size: 1.15rem;"></i>
                    </div>
                    <div class="overflow-hidden">
                        <div id="syarat_title_${newIdx}" class="fw-bold mb-0 text-truncate" style="color: #9333ea; font-size: 0.82rem; line-height: 1.2;">
                            Pilih / Upload Berkas
                        </div>
                        <small id="syarat_sub_${newIdx}" class="text-muted d-block text-truncate" style="font-size: 0.71rem;">PDF, JPG, PNG (Maks 20MB)</small>
                    </div>
                </div>
                <div id="syarat_actions_${newIdx}" class="d-none align-items-center gap-1.5 flex-shrink-0" onclick="event.stopPropagation()">
                    <a href="javascript:void(0)" id="syarat_btn_view_${newIdx}" target="_blank" class="btn-syarat-lihat">
                        <i class="mdi mdi-eye"></i>
                        <span>Lihat</span>
                    </a>
                    <button type="button" class="btn-syarat-hapus" title="Hapus Berkas" onclick="removeSyaratFile('${newIdx}')">
                        <i class="mdi mdi-trash-can-outline"></i>
                        <span>Hapus</span>
                    </button>
                </div>
                <input type="file" name="syarat_files[${newIdx}]" id="file_input_syarat_${newIdx}" style="display: none;" accept=".pdf,.jpg,.jpeg,.png" onchange="handleSyaratFileChosen(this, '${newIdx}')">
            </div>
        `;

        container.appendChild(card);
        inp.value = '';
        uploadedSyaratMap[newIdx] = false;
        recalcProgressAuto(true);
    }
</script>
@endpush
