 @extends('layouts.partial.app')

@section('title', 'KPR Upload Dokumen - Property Management App')

@section('content')
    <style>
        /* ===== MODERN FILE UPLOAD STYLING ===== */
        .card {
            transition: all 0.3s ease;
            margin-bottom: 1rem;
        }

        .card:hover {
            box-shadow: 0 8px 25px rgba(154, 85, 255, 0.1) !important;
        }

        .card-header {
            background: linear-gradient(135deg, #ffffff, #f8f9fa);
            border-bottom: 1px solid #e9ecef;
            padding: 0.75rem;
        }

        @media (min-width: 576px) {
            .card-header {
                padding: 1rem;
            }
        }

        @media (min-width: 768px) {
            .card-header {
                padding: 1.2rem;
            }
        }

        .card-body {
            padding: 0.75rem;
        }

        @media (min-width: 576px) {
            .card-body {
                padding: 1rem;
            }
        }

        @media (min-width: 768px) {
            .card-body {
                padding: 1.2rem;
            }
        }

        /* Card Title */
        .card-title {
            font-size: 0.9rem;
            font-weight: 600;
            color: #9a55ff;
            margin-bottom: 0;
        }

        @media (min-width: 576px) {
            .card-title {
                font-size: 1rem;
            }
        }

        @media (min-width: 768px) {
            .card-title {
                font-size: 1.1rem;
            }
        }

        /* ===== MODERN FILE UPLOAD STYLING ===== */
        .upload-file-modern {
            position: relative;
            width: 100%;
            margin-bottom: 1rem;
        }

        .upload-file-modern input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
            z-index: 2;
        }

        .upload-file-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            gap: 6px;
            padding: 1rem 0.6rem;
            background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
            border: 2px dashed #d0d4db;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            min-height: 100px;
        }

        @media (min-width: 576px) {
            .upload-file-label {
                flex-direction: row;
                text-align: left;
                gap: 8px;
                padding: 0.75rem 1rem;
                min-height: auto;
            }
        }

        .upload-file-modern:hover .upload-file-label {
            border-color: #9a55ff;
            background: linear-gradient(135deg, #f1f0ff, #f8f9fa);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(154, 85, 255, 0.1);
        }

        .upload-file-label i {
            font-size: 1.6rem;
            color: #9a55ff;
            background: rgba(154, 85, 255, 0.1);
            padding: 8px;
            border-radius: 50%;
        }

        .upload-file-info {
            flex: 1;
            width: 100%;
        }

        .upload-file-info span {
            display: block;
            font-weight: 600;
            color: #2c2e3f;
            font-size: 0.8rem;
            word-break: break-word;
        }

        .upload-file-info small {
            color: #6c7383;
            font-size: 0.65rem;
            display: block;
            margin-top: 2px;
        }

        .upload-file-size {
            font-size: 0.7rem;
            color: #9a55ff;
            font-weight: 600;
            background: rgba(154, 85, 255, 0.1);
            padding: 4px 10px;
            border-radius: 20px;
            white-space: nowrap;
            margin-top: 5px;
        }

        @media (min-width: 576px) {
            .upload-file-size {
                margin-top: 0;
            }
        }

        /* Dokumen Card */
        .dokumen-card {
            border: 1px solid #e9ecef;
            border-radius: 12px;
            padding: 1.25rem;
            margin-bottom: 1rem;
            background: white;
        }

        .dokumen-card:hover {
            border-color: #9a55ff;
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.1);
        }

        .dokumen-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .dokumen-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #f9f7ff, #f2ecff);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .dokumen-icon i {
            font-size: 24px;
            color: #9a55ff;
        }

        .dokumen-title {
            flex: 1;
        }

        .dokumen-title h6 {
            font-size: 1rem;
            font-weight: 600;
            color: #2c2e3f;
            margin-bottom: 0.25rem;
        }

        .dokumen-title p {
            font-size: 0.8rem;
            color: #6c7383;
            margin-bottom: 0;
        }

        .dokumen-title .required {
            color: #dc3545;
            margin-left: 4px;
        }

        /* Alert styling */
        .alert {
            border: none;
            border-radius: 10px;
            padding: 0.8rem 1rem;
            font-size: 0.8rem;
            border-left: 4px solid;
            margin-bottom: 1rem;
        }

        .alert-info {
            background: linear-gradient(135deg, #e6f3ff, #d9ecff);
            color: #2c2e3f;
            border-left-color: #17a2b8;
        }

        .alert-success {
            background: linear-gradient(135deg, #f0fff4, #e6f7e6);
            color: #2c2e3f;
            border-left-color: #28a745;
        }

        .alert-warning {
            background: linear-gradient(135deg, #fff9e6, #fff2d9);
            color: #2c2e3f;
            border-left-color: #ffc107;
        }

        /* Button styling */
        .btn {
            font-size: 0.85rem;
            padding: 0.6rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            font-family: 'Nunito', sans-serif;
            border: none;
        }

        @media (min-width: 576px) {
            .btn {
                font-size: 0.9rem;
                padding: 0.7rem 1.2rem;
                border-radius: 10px;
            }
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background: linear-gradient(to right, #da8cff, #9a55ff);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.3);
        }

        .btn-primary:hover {
            background: linear-gradient(to right, #c77cff, #8a45e6);
            box-shadow: 0 6px 16px rgba(154, 85, 255, 0.4);
        }

        .btn-outline-secondary {
            background: transparent;
            border: 1px solid #6c757d;
            color: #6c757d;
        }

        .btn-outline-secondary:hover {
            background: #6c757d;
            color: #ffffff;
        }

        /* Badge */
        .badge {
            padding: 0.35rem 0.6rem;
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: 30px;
            display: inline-block;
            white-space: nowrap;
        }

        .badge-warning {
            background: linear-gradient(135deg, #ffc107, #ffdb6d);
            color: #2c2e3f;
        }

        .badge-primary {
            background: linear-gradient(135deg, #9a55ff, #da8cff);
            color: #ffffff;
        }

        .badge-info {
            background: linear-gradient(135deg, #17a2b8, #5bc0de);
            color: #ffffff;
        }

        /* Info Card */
        .info-card {
            background: linear-gradient(135deg, #f9f7ff, #f2ecff);
            border-radius: 12px;
            padding: 1.25rem;
            margin-bottom: 1rem;
        }

        .info-row {
            display: flex;
            margin-bottom: 0.75rem;
            align-items: baseline;
        }

        .info-label {
            width: 100px;
            font-weight: 600;
            color: #6c757d;
        }

        .info-value {
            flex: 1;
            font-weight: 500;
            color: #2c2e3f;
        }

        @media (max-width: 576px) {
            .info-row {
                flex-direction: column;
                gap: 0.25rem;
            }

            .info-label {
                width: 100%;
            }

            .upload-file-label {
                padding: 0.8rem 0.5rem;
            }

            .upload-file-label i {
                font-size: 1.4rem;
            }

            .upload-file-info span {
                font-size: 0.75rem;
            }

            .upload-file-info small {
                font-size: 0.6rem;
            }
        }
    </style>

    <div class="container-fluid p-2 p-sm-3 p-md-4">
        <!-- Header -->
        <div class="row mb-3 mb-sm-3 mb-md-4">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-1 fw-bold text-dark">
                                <i class="mdi mdi-bank me-2" style="color: #9a55ff;"></i>
                                Upload Dokumen KPR
                            </h4>
                            <p class="mb-0 text-muted small">
                                <i class="mdi mdi-information-outline me-1"></i>
                                Upload dokumen-dokumen yang diperlukan untuk pengajuan KPR
                            </p>
                        </div>
                        <div class="d-none d-sm-block">
                            <i class="mdi mdi-file-document" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Info Status -->
        <div class="row mb-3">
            <div class="col-12">
                <div class="card shadow-sm border-0 bg-light">
                    <div class="card-body py-3">
                        <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center gap-2">
                            <div>
                                <span class="badge badge-info">Pengajuan KPR</span>
                            </div>
                            <div class="text-muted small d-flex align-items-center">
                                <i class="mdi mdi-calendar me-1 text-primary"></i>
                                <span>Tanggal: 15 Maret 2024</span>
                            </div>
                            <div class="ms-sm-auto mt-2 mt-sm-0">
                                <span class="badge badge-warning">Status: Menunggu Upload</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Info Customer -->
        <div class="row mb-3">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex flex-wrap align-items-center gap-3">
                            <div class="flex-shrink-0">
                                <div class="bg-gradient-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 50px; height: 50px;">
                                    <i class="mdi mdi-account" style="font-size: 24px;"></i>
                                </div>
                            </div>
                           <div class="flex-grow-1">
                                <h5 class="mb-1 text-dark">{{ $application->customer->full_name }}</h5>
                                <p class="text-muted mb-0">{{ $application->unit->unit_name }} - {{ $application->bank->bank_name }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Upload Dokumen -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">
                            <i class="mdi mdi-file-document-multiple me-2 text-primary"></i>
                            Upload Dokumen KPR
                        </h5>
                    </div>
                    <div class="card-body">
                        <!-- Alert Info -->
                        <div class="alert alert-info d-flex align-items-start gap-2 mb-4">
                            <i class="mdi mdi-information-outline mt-1 flex-shrink-0"></i>
                            <span>Upload dokumen-dokumen berikut. <span class="text-danger">*</span> Wajib diupload.</span>
                        </div>

                        <form>
                            @csrf
                            <div class="row">
                                <!-- KTP -->
                                <div class="col-12 col-md-6 mb-3">
                                    <div class="dokumen-card">
                                        <div class="dokumen-header">
                                            <div class="dokumen-icon">
                                                <i class="mdi mdi-card-account-details"></i>
                                            </div>
                                            <div class="dokumen-title">
                                                <h6>KTP <span class="required">*</span></h6>
                                                <p>Kartu Tanda Penduduk (KTP) Pemohon</p>
                                            </div>
                                        </div>
                                        <div class="upload-file-modern">
                                            <input type="file" id="document-ktp" name="document_ktp"
                                                accept=".jpg,.jpeg,.png,.pdf" required>
                                            <div class="upload-file-label">
                                                <i class="mdi mdi-cloud-upload"></i>
                                                <div class="upload-file-info">
                                                    <span>Upload KTP</span>
                                                    <small>Format: JPG, PNG, PDF (Max: 5MB)</small>
                                                </div>
                                                <span class="upload-file-size"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- KK -->
                                <div class="col-12 col-md-6 mb-3">
                                    <div class="dokumen-card">
                                        <div class="dokumen-header">
                                            <div class="dokumen-icon">
                                                <i class="mdi mdi-book-open-page-variant"></i>
                                            </div>
                                            <div class="dokumen-title">
                                                <h6>Kartu Keluarga <span class="required">*</span></h6>
                                                <p>Kartu Keluarga (KK) Pemohon</p>
                                            </div>
                                        </div>
                                        <div class="upload-file-modern">
                                            <input type="file" id="document-kk" name="document_kk"
                                                accept=".jpg,.jpeg,.png,.pdf" required>
                                            <div class="upload-file-label">
                                                <i class="mdi mdi-cloud-upload"></i>
                                                <div class="upload-file-info">
                                                    <span>Upload Kartu Keluarga</span>
                                                    <small>Format: JPG, PNG, PDF (Max: 5MB)</small>
                                                </div>
                                                <span class="upload-file-size"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- NPWP -->
                                <div class="col-12 col-md-6 mb-3">
                                    <div class="dokumen-card">
                                        <div class="dokumen-header">
                                            <div class="dokumen-icon">
                                                <i class="mdi mdi-domain"></i>
                                            </div>
                                            <div class="dokumen-title">
                                                <h6>NPWP</h6>
                                                <p>Nomor Pokok Wajib Pajak (jika ada)</p>
                                            </div>
                                        </div>
                                        <div class="upload-file-modern">
                                            <input type="file" id="document-npwp" name="document_npwp"
                                                accept=".jpg,.jpeg,.png,.pdf">
                                            <div class="upload-file-label">
                                                <i class="mdi mdi-cloud-upload"></i>
                                                <div class="upload-file-info">
                                                    <span>Upload NPWP</span>
                                                    <small>Format: JPG, PNG, PDF (Max: 5MB)</small>
                                                </div>
                                                <span class="upload-file-size"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Slip Gaji -->
                                <div class="col-12 col-md-6 mb-3">
                                    <div class="dokumen-card">
                                        <div class="dokumen-header">
                                            <div class="dokumen-icon">
                                                <i class="mdi mdi-cash"></i>
                                            </div>
                                            <div class="dokumen-title">
                                                <h6>Slip Gaji <span class="required">*</span></h6>
                                                <p>Slip gaji 3 bulan terakhir</p>
                                            </div>
                                        </div>
                                        <div class="upload-file-modern">
                                            <input type="file" id="document-slip-gaji" name="document_slip_gaji"
                                                accept=".jpg,.jpeg,.png,.pdf" required>
                                            <div class="upload-file-label">
                                                <i class="mdi mdi-cloud-upload"></i>
                                                <div class="upload-file-info">
                                                    <span>Upload Slip Gaji</span>
                                                    <small>Format: JPG, PNG, PDF (Max: 5MB)</small>
                                                </div>
                                                <span class="upload-file-size"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Rekening Koran -->
                                <div class="col-12 col-md-6 mb-3">
                                    <div class="dokumen-card">
                                        <div class="dokumen-header">
                                            <div class="dokumen-icon">
                                                <i class="mdi mdi-bank"></i>
                                            </div>
                                            <div class="dokumen-title">
                                                <h6>Rekening Koran <span class="required">*</span></h6>
                                                <p>Rekening koran 3 bulan terakhir</p>
                                            </div>
                                        </div>
                                        <div class="upload-file-modern">
                                            <input type="file" id="document-rekening" name="document_rekening"
                                                accept=".jpg,.jpeg,.png,.pdf" required>
                                            <div class="upload-file-label">
                                                <i class="mdi mdi-cloud-upload"></i>
                                                <div class="upload-file-info">
                                                    <span>Upload Rekening Koran</span>
                                                    <small>Format: JPG, PNG, PDF (Max: 5MB)</small>
                                                </div>
                                                <span class="upload-file-size"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Surat Nikah -->
                                <div class="col-12 col-md-6 mb-3">
                                    <div class="dokumen-card">
                                        <div class="dokumen-header">
                                            <div class="dokumen-icon">
                                                <i class="mdi mdi-heart"></i>
                                            </div>
                                            <div class="dokumen-title">
                                                <h6>Surat Nikah</h6>
                                                <p>Bagi yang sudah menikah (jika ada)</p>
                                            </div>
                                        </div>
                                        <div class="upload-file-modern">
                                            <input type="file" id="document-nikah" name="document_nikah"
                                                accept=".jpg,.jpeg,.png,.pdf">
                                            <div class="upload-file-label">
                                                <i class="mdi mdi-cloud-upload"></i>
                                                <div class="upload-file-info">
                                                    <span>Upload Surat Nikah</span>
                                                    <small>Format: JPG, PNG, PDF (Max: 5MB)</small>
                                                </div>
                                                <span class="upload-file-size"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- SIUP/IUMK -->
                                <div class="col-12 col-md-6 mb-3">
                                    <div class="dokumen-card">
                                        <div class="dokumen-header">
                                            <div class="dokumen-icon">
                                                <i class="mdi mdi-file-certificate"></i>
                                            </div>
                                            <div class="dokumen-title">
                                                <h6>SIUP / IUMK</h6>
                                                <p>Untuk wiraswasta (jika ada)</p>
                                            </div>
                                        </div>
                                        <div class="upload-file-modern">
                                            <input type="file" id="document-siup" name="document_siup"
                                                accept=".jpg,.jpeg,.png,.pdf">
                                            <div class="upload-file-label">
                                                <i class="mdi mdi-cloud-upload"></i>
                                                <div class="upload-file-info">
                                                    <span>Upload SIUP / IUMK</span>
                                                    <small>Format: JPG, PNG, PDF (Max: 5MB)</small>
                                                </div>
                                                <span class="upload-file-size"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="d-flex flex-column flex-sm-row justify-content-between gap-3 mt-4">
                                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                                    <i class="mdi mdi-arrow-left me-1"></i>Kembali Dashboard
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="mdi mdi-upload me-1"></i>Upload Dokumen
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // File upload preview untuk semua input file
            document.querySelectorAll('.upload-file-modern input[type="file"]').forEach(input => {
                input.addEventListener('change', function(e) {
                    const fileName = e.target.files[0]?.name;
                    const fileSize = e.target.files[0]?.size;
                    const label = this.closest('.upload-file-modern').querySelector(
                        '.upload-file-info span');
                    const sizeSpan = this.closest('.upload-file-modern').querySelector(
                        '.upload-file-size');

                    if (fileName) {
                        // Tampilkan nama file (potong jika terlalu panjang)
                        label.textContent = fileName.length > 30 ? fileName.substring(0, 30) +
                            '...' : fileName;

                        // Hitung dan tampilkan ukuran file dalam MB
                        if (fileSize) {
                            const sizeInMB = (fileSize / (1024 * 1024)).toFixed(2);
                            sizeSpan.textContent = sizeInMB + ' MB';
                        }
                    } else {
                        // Reset ke teks awal berdasarkan id
                        const inputId = this.id;
                        if (inputId === 'document-ktp') label.textContent = 'Upload KTP';
                        else if (inputId === 'document-kk') label.textContent = 'Upload Kartu Keluarga';
                        else if (inputId === 'document-npwp') label.textContent = 'Upload NPWP';
                        else if (inputId === 'document-slip-gaji') label.textContent = 'Upload Slip Gaji';
                        else if (inputId === 'document-rekening') label.textContent = 'Upload Rekening Koran';
                        else if (inputId === 'document-nikah') label.textContent = 'Upload Surat Nikah';
                        else if (inputId === 'document-siup') label.textContent = 'Upload SIUP / IUMK';
                        else label.textContent = 'Upload File';

                        sizeSpan.textContent = '';
                    }
                });
            });
        });
    </script>
@endpush

