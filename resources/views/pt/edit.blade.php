@extends('layouts.partial.app')

@section('title', 'Edit Perusahaan: ' . $companyProfile->name . ' - Property Management App')

@push('styles')
<style>
    .form-section-card {
        background: #ffffff;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        margin-bottom: 1.5rem;
        overflow: hidden;
    }
    .form-section-header {
        padding: 1rem 1.25rem;
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .form-section-title {
        font-size: 0.95rem;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .form-section-body {
        padding: 1.25rem;
    }
    .form-control-custom {
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        padding: 0.55rem 0.85rem;
        font-size: 0.86rem;
        transition: all 0.2s ease;
    }
    .form-control-custom:focus {
        border-color: #9a55ff;
        box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.15);
    }
    .pratanah-file-upload-modern {
        position: relative;
        width: 100%;
    }
    .pratanah-file-upload-modern input[type="file"] {
        position: absolute;
        opacity: 0;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        cursor: pointer;
        z-index: 2;
    }
    .pratanah-file-label-modern {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 0.65rem 0.85rem;
        background: #f8fafc;
        border: 1.5px dashed #cbd5e1;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.25s ease;
    }
    .pratanah-file-upload-modern:hover .pratanah-file-label-modern {
        border-color: #9a55ff;
        background: #f5f3ff;
    }
    .pratanah-file-label-modern i {
        font-size: 1.25rem;
        color: #9a55ff;
        background: rgba(154, 85, 255, 0.12);
        padding: 6px;
        border-radius: 50%;
        flex-shrink: 0;
    }
    .pratanah-file-info-modern {
        flex: 1;
        overflow: hidden;
        min-width: 0;
    }
    .pratanah-file-info-modern .file-label-text {
        display: block;
        font-weight: 600;
        color: #334155;
        font-size: 0.78rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .pratanah-file-info-modern .file-label-hint {
        display: block;
        color: #94a3b8;
        font-size: 0.7rem;
    }
    .doc-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 1rem;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: all 0.2s ease;
    }
    .doc-card:hover {
        border-color: #cbd5e1;
        box-shadow: 0 2px 6px rgba(0,0,0,0.03);
    }
    .existing-doc-badge {
        background: #f0fdf4;
        border: 1px solid #86efac;
        padding: 8px 12px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 8px;
    }
</style>
@endpush

@section('content')

<div class="container-fluid px-1 px-sm-2 px-md-3 py-2 py-md-3">

    <!-- Header Breadcrumb & Title -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <div class="d-flex align-items-center gap-2 mb-1">
                <a href="{{ route('company-profile.index') }}" class="text-decoration-none text-muted" style="font-size: 0.85rem;">
                    <i class="mdi mdi-domain me-1"></i>Master Data PT
                </a>
                <span class="text-muted" style="font-size: 0.85rem;">/</span>
                <span class="text-dark fw-semibold" style="font-size: 0.85rem;">Edit Perusahaan</span>
            </div>
            <h2 class="text-dark mb-0 fw-bold" style="font-size: 1.45rem; letter-spacing: -0.02em;">
                Edit: {{ $companyProfile->name }}
            </h2>
            <p class="text-muted mb-0" style="font-size: 0.85rem;">
                Perbarui profil badan hukum dan kelola 6 berkas legalitas resmi perusahaan.
            </p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('company-profile.index') }}" class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center gap-1.5 px-3 py-2" style="border-radius: 8px; font-weight: 600;">
                <i class="mdi mdi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    @if (isset($errors) && $errors->any())
        <div class="alert alert-danger alert-dismissible fade show rounded-3 border-0 shadow-sm mb-4" role="alert">
            <div class="d-flex align-items-start gap-2">
                <i class="mdi mdi-alert-circle fs-5 mt-0.5"></i>
                <div>
                    <strong>Perhatian!</strong> Terdapat kesalahan pengisian formulir:
                    <ul class="mb-0 mt-1 ps-3" style="font-size: 0.84rem;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('company-profile.update', $companyProfile->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- SEKSI 1: DATA UMUM PERUSAHAAN -->
        <div class="form-section-card">
            <div class="form-section-header">
                <h3 class="form-section-title">
                    <i class="mdi mdi-office-building text-primary"></i> Data Umum Perusahaan
                </h3>
                <span class="badge bg-light text-muted border px-2 py-1" style="font-size: 0.72rem;">ID: #{{ $companyProfile->id }}</span>
            </div>
            <div class="form-section-body">
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-bold" style="font-size: 0.84rem; color: #1e293b;">
                            Nama Perusahaan (PT) <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="name" class="form-control form-control-custom" 
                               placeholder="Contoh: PT. Graha Cipta Sejahtera" 
                               value="{{ old('name', $companyProfile->name) }}" required>
                        <small class="text-muted" style="font-size: 0.73rem;">Gunakan nama lengkap berbadan hukum sesuai Akta Notaris.</small>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label fw-bold" style="font-size: 0.84rem; color: #1e293b;">
                            Nomor Telepon Kantor
                        </label>
                        <input type="text" name="phone" class="form-control form-control-custom" 
                               placeholder="Contoh: 0331-331447 / 08123456789" 
                               value="{{ old('phone', $companyProfile->phone) }}">
                        <small class="text-muted" style="font-size: 0.73rem;">Nomor telepon kantor operasional atau kontak penanggung jawab.</small>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-bold" style="font-size: 0.84rem; color: #1e293b;">
                            Alamat Kantor Resmi
                        </label>
                        <textarea name="address" rows="2" class="form-control form-control-custom" 
                                  placeholder="Contoh: Jl. Letjen Sutoyo No. 99 A, Kel. Kaliwates, Kec. Kaliwates, Kab. Jember">{{ old('address', $companyProfile->address) }}</textarea>
                        <small class="text-muted" style="font-size: 0.73rem;">Alamat domisili kantor PT sesuai yang tertera pada Surat Keterangan Domisili / NIB.</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- SEKSI 2: 6 BERKAS LEGALITAS RESMI PT -->
        <div class="form-section-card">
            <div class="form-section-header">
                <div>
                    <h3 class="form-section-title">
                        <i class="mdi mdi-shield-account text-purple"></i> Dokumen Legalitas PT (SOP Notaris & BPN)
                    </h3>
                    <small class="text-muted d-block mt-0.5" style="font-size: 0.75rem;">
                        Dokumen ini otomatis tersambung ke seluruh modul perizinan dan pertanahan BPN.
                    </small>
                </div>
                <div>
                    @php
                        $legCount = $companyProfile->uploaded_legal_docs_count;
                    @endphp
                    @if($legCount == 6)
                        <span class="badge bg-success text-white px-2.5 py-1" style="font-size: 0.75rem;">
                            <i class="mdi mdi-check-circle me-1"></i> Lengkap (6/6 Berkas)
                        </span>
                    @elseif($legCount > 0)
                        <span class="badge bg-warning text-dark px-2.5 py-1" style="font-size: 0.75rem;">
                            <i class="mdi mdi-clock-outline me-1"></i> {{ $legCount }}/6 Berkas
                        </span>
                    @else
                        <span class="badge bg-secondary text-white px-2.5 py-1" style="font-size: 0.75rem;">
                            0/6 Berkas
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-section-body">
                @php
                    $legalDocs = [
                        [
                            'field' => 'file_akta_pendirian',
                            'no'    => '1',
                            'title' => 'Akta Pendirian PT & SK Kemenkumham',
                            'desc'  => 'Akta Notaris pendirian badan hukum PT beserta Surat Keputusan Pengesahan AHU Kemenkumham.',
                        ],
                        [
                            'field' => 'file_akta_perubahan',
                            'no'    => '2',
                            'title' => 'Akta Perubahan Terakhir & AHU',
                            'desc'  => 'Akta Notaris penyesuaian modal / susunan pengurus terakhir dan bukti penerimaan pemberitahuan AHU.',
                        ],
                        [
                            'field' => 'file_npwp',
                            'no'    => '3',
                            'title' => 'NPWP Badan Usaha (PT)',
                            'desc'  => 'Kartu NPWP resmi badan hukum PT dan Surat Keterangan Terdaftar (SKT) Pajak.',
                        ],
                        [
                            'field' => 'file_direksi',
                            'no'    => '4',
                            'title' => 'Identitas Direksi / Penanggung Jawab',
                            'desc'  => 'KTP, Kartu Keluarga (KK), dan NPWP Direktur Utama yang berwenang menandatangani akta.',
                        ],
                        [
                            'field' => 'file_nib',
                            'no'    => '5',
                            'title' => 'Nomor Induk Berusaha (NIB OSS RBA)',
                            'desc'  => 'NIB resmi dari sistem OSS Kementerian Investasi / BKPM yang mencakup KBLI Real Estate.',
                        ],
                        [
                            'field' => 'file_domisili',
                            'no'    => '6',
                            'title' => 'Surat Keterangan Domisili PT',
                            'desc'  => 'Surat Keterangan Domisili Perusahaan (SKDP) dari Kantor Kelurahan / Kecamatan setempat.',
                        ],
                    ];
                @endphp

                <div class="row g-3">
                    @foreach($legalDocs as $doc)
                        @php
                            $filePath = $companyProfile->{$doc['field']};
                            $hasFile = !empty($filePath) && (file_exists(public_path($filePath)) || file_exists(storage_path('app/public/' . str_replace('uploads/', '', $filePath))));
                        @endphp
                        <div class="col-12 col-md-6">
                            <div class="doc-card">
                                <div>
                                    <div class="d-flex align-items-center gap-2 mb-1">
                                        <span class="badge bg-light text-primary border fw-bold" style="font-size: 0.72rem;">
                                            Dokumen {{ $doc['no'] }}
                                        </span>
                                        <span class="fw-bold text-dark" style="font-size: 0.86rem;">
                                            {{ $doc['title'] }}
                                        </span>
                                    </div>
                                    <p class="text-muted mb-3" style="font-size: 0.74rem; line-height: 1.45;">
                                        {{ $doc['desc'] }}
                                    </p>
                                </div>

                                <div>
                                    <!-- Jika sudah ada berkas sebelumnya -->
                                    @if($hasFile || !empty($filePath))
                                        <div class="existing-doc-badge">
                                            <div class="d-flex align-items-center gap-2 overflow-hidden">
                                                <i class="mdi mdi-file-check text-success" style="font-size: 1.25rem;"></i>
                                                <div class="overflow-hidden">
                                                    <span class="d-block fw-bold text-success text-truncate" style="font-size: 0.76rem;">
                                                        Berkas Sudah Terunggah
                                                    </span>
                                                    <small class="text-muted d-block text-truncate" style="font-size: 0.68rem;">
                                                        {{ basename($filePath) }}
                                                    </small>
                                                </div>
                                            </div>
                                            <a href="{{ asset($filePath) }}" target="_blank" class="btn btn-xs btn-success text-white py-1 px-2.5 d-inline-flex align-items-center gap-1 shadow-sm" style="font-size: 0.72rem; border-radius: 6px; white-space: nowrap;">
                                                <i class="mdi mdi-eye"></i> Lihat Berkas
                                            </a>
                                        </div>
                                    @endif

                                    <!-- Upload / Ganti Berkas -->
                                    <div class="pratanah-file-upload-modern">
                                        <input type="file" name="{{ $doc['field'] }}" id="{{ $doc['field'] }}" 
                                               accept=".pdf,.jpg,.jpeg,.png"
                                               onchange="handleFileSelect(this, 'label_text_{{ $doc['field'] }}')">
                                        <div class="pratanah-file-label-modern">
                                            <i class="mdi mdi-cloud-upload"></i>
                                            <div class="pratanah-file-info-modern">
                                                <span class="file-label-text" id="label_text_{{ $doc['field'] }}">
                                                    {{ !empty($filePath) ? 'Unggah Berkas Baru untuk Mengganti...' : 'Pilih Berkas...' }}
                                                </span>
                                                <span class="file-label-hint">Format PDF, JPG, PNG (Maks 10 MB)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- FORM ACTION BUTTONS -->
        <div class="d-flex align-items-center justify-content-end gap-2 mb-5">
            <a href="{{ route('company-profile.index') }}" class="btn btn-light border px-4 py-2" style="font-size: 0.86rem; font-weight: 600; border-radius: 8px;">
                Batal
            </a>
            <button type="submit" class="btn btn-gradient-primary px-4 py-2 d-inline-flex align-items-center gap-2 shadow-sm" style="font-size: 0.86rem; font-weight: 600; border-radius: 8px;">
                <i class="mdi mdi-content-save-check-outline"></i>
                <span>Perbarui Perusahaan</span>
            </button>
        </div>

    </form>

</div>

@push('scripts')
<script>
    function handleFileSelect(input, labelId) {
        const labelElem = document.getElementById(labelId);
        if (input.files && input.files[0]) {
            const fileName = input.files[0].name;
            const fileSize = (input.files[0].size / 1024 / 1024).toFixed(2);
            labelElem.textContent = `${fileName} (${fileSize} MB)`;
            labelElem.style.color = '#9a55ff';
            labelElem.style.fontWeight = '700';
        } else {
            labelElem.textContent = 'Pilih Berkas...';
            labelElem.style.color = '#334155';
            labelElem.style.fontWeight = '600';
        }
    }
</script>
@endpush

@endsection
