    @extends('layouts.partial.app')

    @section('title', 'Pengaturan - Property Management App')

    @section('content')
    <style>
    /* ===== STYLING UNTUK HALAMAN PENGATURAN ===== */
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

    /* Form Styling */
    .form-group {
        margin-bottom: 1rem;
    }

    .form-group label {
        font-size: 0.85rem;
        font-weight: 600;
        color: #9a55ff !important;
        margin-bottom: 0.3rem;
        letter-spacing: 0.3px;
        font-family: 'Nunito', sans-serif;
        display: block;
    }

    .form-control {
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: 0.6rem 0.8rem;
        font-size: 0.9rem;
        transition: all 0.2s ease;
        background-color: #ffffff;
        color: #2c2e3f;
        width: 100%;
        height: 42px;
    }

    .form-control:focus {
        border-color: #9a55ff;
        box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.1);
        outline: none;
    }

    textarea.form-control {
        min-height: 80px;
        height: auto;
    }

    /* Input Group */
    .input-group {
        display: flex;
        align-items: center;
        width: 100%;
    }

    .input-group-prepend {
        margin-right: -1px;
    }

    .input-group-text {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        border: 1px solid #e9ecef;
        border-radius: 8px 0 0 8px;
        padding: 0.6rem 0.8rem;
        font-size: 0.9rem;
        color: #9a55ff;
        font-weight: 600;
        height: 42px;
        display: flex;
        align-items: center;
        white-space: nowrap;
    }

    .input-group .form-control {
        border-radius: 0 8px 8px 0;
        height: 42px;
        flex: 1;
    }

    /* File Upload Styles */
    .file-upload-wrapper {
        position: relative;
        width: 100%;
        margin-bottom: 0.5rem;
    }

    .file-upload-area {
        position: relative;
        border: 2px dashed #d0d4db;
        border-radius: 12px;
        background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
        transition: all 0.3s ease;
        overflow: hidden;
        min-height: 120px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .file-upload-area.has-preview {
        border: 2px solid #9a55ff;
        background: #ffffff;
    }

    .file-upload-area:hover {
        border-color: #9a55ff;
        box-shadow: 0 5px 15px rgba(154, 85, 255, 0.1);
    }

    .file-upload-input {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
        z-index: 10;
    }

    .file-upload-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 1.5rem;
        text-align: center;
        width: 100%;
    }

    .file-upload-content.preview-mode {
        padding: 1rem;
    }

    .file-upload-icon {
        font-size: 2.5rem;
        color: #9a55ff;
        background: rgba(154, 85, 255, 0.1);
        padding: 0.8rem;
        border-radius: 50%;
        margin-bottom: 0.5rem;
    }

    .file-upload-title {
        display: block;
        font-weight: 600;
        color: #2c2e3f;
        font-size: 0.9rem;
        margin-bottom: 0.25rem;
    }

    .file-upload-subtitle {
        display: block;
        color: #6c7383;
        font-size: 0.75rem;
    }

    /* Preview Styles */
    .preview-container {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
    }

    .preview-image-wrapper {
        position: relative;
        display: inline-block;
    }

    .preview-image {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid #9a55ff;
        background: #ffffff;
        box-shadow: 0 4px 10px rgba(154, 85, 255, 0.2);
    }

    /* Button Styling */
    .btn {
        font-size: 0.85rem;
        padding: 0.6rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        font-family: 'Nunito', sans-serif;
        border: none;
        height: 42px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    @media (min-width: 576px) {
        .btn {
            font-size: 0.9rem;
            padding: 0.7rem 1.2rem;
        }
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .btn-gradient-primary {
        background: linear-gradient(to right, #da8cff, #9a55ff);
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(154, 85, 255, 0.3);
    }

    .btn-gradient-primary:hover {
        background: linear-gradient(to right, #c77cff, #8a45e6);
        box-shadow: 0 6px 16px rgba(154, 85, 255, 0.4);
        color: #ffffff;
    }

    .btn-gradient-secondary {
        background: #6c757d;
        color: #ffffff;
    }

    .btn-gradient-secondary:hover {
        background: #5a6268;
        color: #ffffff;
    }

    /* Section Title */
    .section-title {
        font-size: 1rem;
        font-weight: 700;
        color: #2c2e3f;
        margin-bottom: 1.25rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #9a55ff;
    }

    .section-title i {
        color: #9a55ff;
        margin-right: 0.5rem;
    }

    /* Hidden Class */
    .hidden {
        display: none !important;
    }

    /* Responsive */
    @media (max-width: 576px) {
        .preview-image {
            width: 80px;
            height: 80px;
        }

        .input-group {
            flex-wrap: nowrap;
        }

        .input-group-text {
            padding: 0.6rem 0.6rem;
            font-size: 0.85rem;
        }
    }

    .mdi {
        vertical-align: middle;
    }

    /* Info Text */
    .text-muted-small {
        color: #6c7383;
        font-size: 0.75rem;
        margin-top: 4px;
        display: block;
    }

    /* Alert Success */
    .alert-success {
        background-color: rgba(154, 85, 255, 0.1);
        border-left: 4px solid #9a55ff;
        color: #2c2e3f;
        padding: 12px 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .alert-success i {
        font-size: 20px;
        color: #9a55ff;
    }
    </style>

    <div class="container-fluid p-2 p-sm-3 p-md-4">
        <!-- Header Dashboard -->
        <div class="row mb-3 mb-sm-3 mb-md-4">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="text-dark mb-1">
                                <i class="mdi mdi-cog me-2" style="color: #9a55ff;"></i>
                                Pengaturan
                            </h3>
                            <p class="text-muted mb-0">
                                <i class="mdi mdi-information-outline me-1"></i>
                                Kelola pengaturan perusahaan
                            </p>
                        </div>
                        <div class="d-none d-sm-block">
                            <i class="mdi mdi-cog" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Settings Form -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">
                            <i class="mdi mdi-cog me-2 text-primary"></i>
                            Pengaturan Perusahaan
                        </h5>
                    </div>
                    <div class="card-body">

                        <!-- Alert Success -->
                        @if(session('success'))
                            <div class="alert-success">
                                <i class="mdi mdi-check-circle"></i>
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('setting.update') }}" method="POST" enctype="multipart/form-data" id="formSettings">
                            @csrf

                            <!-- PROFIL PERUSAHAAN -->
                            <div class="section-title">
                                <i class="mdi mdi-domain"></i> Profil Perusahaan
                            </div>

                            <!-- Baris 1: Nama Perusahaan dan NPWP -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>
                                            <i class="mdi mdi-domain me-1"></i>Nama Perusahaan / PT
                                        </label>
                                        <input type="text" class="form-control @error('company_name') is-invalid @enderror" name="company_name" value="{{ old('company_name', $company->company_name ?? '') }}">
                                        @error('company_name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>
                                            <i class="mdi mdi-card-account-details me-1"></i>NPWP
                                        </label>
                                        <input type="text" class="form-control @error('npwp') is-invalid @enderror" name="npwp" value="{{ old('npwp', $company->npwp ?? '') }}" id="npwpInput">
                                        @error('npwp')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Baris 2: Alamat Lengkap (Full Width) -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>
                                            <i class="mdi mdi-map-marker me-1"></i>Alamat Lengkap
                                        </label>
                                        <textarea class="form-control @error('address') is-invalid @enderror" name="address" rows="3">{{ old('address', $company->address ?? '') }}</textarea>
                                        @error('address')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Baris 3: Kota, Provinsi, Kode Pos -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>
                                            <i class="mdi mdi-city me-1"></i>Kota
                                        </label>
                                        <input type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city', $company->city ?? '') }}">
                                        @error('city')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>
                                            <i class="mdi mdi-map me-1"></i>Provinsi
                                        </label>
                                        <input type="text" class="form-control @error('province') is-invalid @enderror" name="province" value="{{ old('province', $company->province ?? '') }}">
                                        @error('province')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>
                                            <i class="mdi mdi-mailbox me-1"></i>Kode Pos
                                        </label>
                                        <input type="text" class="form-control @error('postal_code') is-invalid @enderror" name="postal_code" value="{{ old('postal_code', $company->postal_code ?? '') }}">
                                        @error('postal_code')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Baris 4: No Telepon, No WhatsApp, Email -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>
                                            <i class="mdi mdi-phone me-1"></i>No. Telepon
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">(021)</span>
                                            </div>
                                            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', $company->phone ?? '') }}">
                                        </div>
                                        @error('phone')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>
                                            <i class="mdi mdi-whatsapp me-1"></i>No. WhatsApp
                                        </label>
                                        <input type="text" class="form-control @error('whatsapp') is-invalid @enderror" name="whatsapp" value="{{ old('whatsapp', $company->whatsapp ?? '') }}">
                                        @error('whatsapp')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>
                                            <i class="mdi mdi-email me-1"></i>Email
                                        </label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $company->email ?? '') }}">
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Baris 5: Website dan Tanggal Berdiri -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>
                                            <i class="mdi mdi-web me-1"></i>Website
                                        </label>
                                        <input type="text" class="form-control @error('website') is-invalid @enderror" name="website" value="{{ old('website', $company->website ?? '') }}">
                                        @error('website')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>
                                            <i class="mdi mdi-calendar me-1"></i>Tanggal Berdiri
                                        </label>
                                        <input type="date" class="form-control @error('founded_date') is-invalid @enderror"
                                            name="founded_date"
                                            value="{{ old('founded_date', isset($company->founded_date) ? $company->founded_date->format('Y-m-d') : '') }}">
                                        @error('founded_date')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- BRANDING -->
                            <div class="section-title mt-4">
                                <i class="mdi mdi-palette"></i> Branding
                            </div>

                            <!-- Baris 6: Logo dan Favicon (Kanan Kiri) -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>
                                            <i class="mdi mdi-image me-1"></i>Logo Perusahaan
                                        </label>

                                        <!-- File Upload dengan Preview - TANPA TOMBOL HAPUS -->
                                        <div class="file-upload-wrapper">
                                            <div class="file-upload-area" id="logoArea">
                                                <input type="file" class="file-upload-input" id="uploadLogo" name="logo" accept=".jpg,.jpeg,.png,.svg">

                                                <!-- Default Upload State -->
                                                <div class="file-upload-content" id="logoDefault">
                                                    <i class="mdi mdi-cloud-upload file-upload-icon"></i>
                                                    <div class="file-upload-info">
                                                        <span class="file-upload-title">Klik untuk upload logo</span>
                                                        <span class="file-upload-subtitle">Format: JPG, PNG, SVG (Max 5MB)</span>
                                                    </div>
                                                </div>

                                                <!-- Preview State (Hidden by default) - TANPA TOMBOL HAPUS -->
                                                <div class="file-upload-content preview-mode hidden" id="logoPreview">
                                                    <div class="preview-container">
                                                        <div class="preview-image-wrapper">
                                                            <img src="" alt="Preview Logo" class="preview-image" id="logoPreviewImage">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @error('logo')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>
                                            <i class="mdi mdi-image me-1"></i>Favicon
                                        </label>

                                        <!-- File Upload dengan Preview untuk Favicon - TANPA TOMBOL HAPUS -->
                                        <div class="file-upload-wrapper">
                                            <div class="file-upload-area" id="faviconArea">
                                                <input type="file" class="file-upload-input" id="uploadFavicon" name="favicon" accept=".ico,.png">

                                                <!-- Default Upload State -->
                                                <div class="file-upload-content" id="faviconDefault">
                                                    <i class="mdi mdi-cloud-upload file-upload-icon"></i>
                                                    <div class="file-upload-info">
                                                        <span class="file-upload-title">Klik untuk upload favicon</span>
                                                        <span class="file-upload-subtitle">Format: ICO, PNG (Max 5MB)</span>
                                                    </div>
                                                </div>

                                                <!-- Preview State (Hidden by default) - TANPA TOMBOL HAPUS -->
                                                <div class="file-upload-content preview-mode hidden" id="faviconPreview">
                                                    <div class="preview-container">
                                                        <div class="preview-image-wrapper">
                                                            <img src="" alt="Preview Favicon" class="preview-image" id="faviconPreviewImage">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @error('favicon')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <!-- Tombol Aksi -->
                            <div class="d-flex flex-wrap justify-content-end gap-2">
                                <button type="submit" class="btn btn-gradient-primary" id="saveBtn">
                                    <i class="mdi mdi-content-save"></i>
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Kembali -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body d-flex justify-content-start">
                        <a href="{{ route('dashboard') }}" class="btn btn-gradient-secondary">
                            <i class="mdi mdi-arrow-left me-1"></i>Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    $(document).ready(function() {

        // ===== FORMAT NPWP =====
        function formatNPWP(value) {
            let numbers = value.replace(/\D/g, '');
            if (numbers.length > 15) numbers = numbers.substr(0, 15);

            let formatted = '';
            for (let i = 0; i < numbers.length; i++) {
                if (i === 2 || i === 5) {
                    formatted += '.' + numbers[i];
                } else if (i === 8) {
                    formatted += '.' + numbers[i] + '-';
                } else if (i === 11) {
                    formatted += '.' + numbers[i];
                } else {
                    formatted += numbers[i];
                }
            }
            return formatted;
        }

        // Format NPWP saat ini (jika sudah ada data)
        let npwpValue = $('input[name="npwp"]').val();
        if (npwpValue && npwpValue.length === 15 && !npwpValue.includes('.')) {
            $('input[name="npwp"]').val(formatNPWP(npwpValue));
        }

        // Format NPWP otomatis saat mengetik
        $('input[name="npwp"]').on('input', function() {
            let value = $(this).val();
            let formatted = formatNPWP(value);
            $(this).val(formatted);
        });

        // ===== PREVIEW LOGO =====
        // Tampilkan preview logo jika sudah ada
        @if(isset($company) && $company->logo)
            $('#logoPreviewImage').attr('src', '{{ asset('storage/' . $company->logo) }}');
            $('#logoDefault').addClass('hidden');
            $('#logoPreview').removeClass('hidden');
            $('#logoArea').addClass('has-preview');
        @endif

        // Tampilkan preview favicon jika sudah ada
        @if(isset($company) && $company->favicon)
            $('#faviconPreviewImage').attr('src', '{{ asset('storage/' . $company->favicon) }}');
            $('#faviconDefault').addClass('hidden');
            $('#faviconPreview').removeClass('hidden');
            $('#faviconArea').addClass('has-preview');
        @endif

        // Preview untuk Logo - saat upload file baru
        $('#uploadLogo').change(function(e) {
            const file = e.target.files[0];
            if (file) {
                // Validasi tipe file
                const fileName = file.name.toLowerCase();
                if (!fileName.match(/\.(jpg|jpeg|png|svg)$/)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Format Tidak Didukung',
                        text: 'Gunakan JPG, PNG, atau SVG.',
                        confirmButtonColor: '#9a55ff'
                    });
                    $(this).val('');
                    return;
                }

                // Validasi ukuran file (max 5MB)
                if (file.size > 5 * 1024 * 1024) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Ukuran File Terlalu Besar',
                        text: 'Ukuran file maksimal 5MB.',
                        confirmButtonColor: '#9a55ff'
                    });
                    $(this).val('');
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#logoPreviewImage').attr('src', e.target.result);

                    // Sembunyikan default, tampilkan preview
                    $('#logoDefault').addClass('hidden');
                    $('#logoPreview').removeClass('hidden');
                    $('#logoArea').addClass('has-preview');
                }
                reader.readAsDataURL(file);
            }
        });

        // Preview untuk Favicon - saat upload file baru
        $('#uploadFavicon').change(function(e) {
            const file = e.target.files[0];
            if (file) {
                // Validasi tipe file
                const fileName = file.name.toLowerCase();
                if (!fileName.match(/\.(ico|png)$/)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Format Tidak Didukung',
                        text: 'Gunakan ICO atau PNG.',
                        confirmButtonColor: '#9a55ff'
                    });
                    $(this).val('');
                    return;
                }

                // Validasi ukuran file (max 5MB)
                if (file.size > 5 * 1024 * 1024) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Ukuran File Terlalu Besar',
                        text: 'Ukuran file maksimal 5MB.',
                        confirmButtonColor: '#9a55ff'
                    });
                    $(this).val('');
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#faviconPreviewImage').attr('src', e.target.result);

                    // Sembunyikan default, tampilkan preview
                    $('#faviconDefault').addClass('hidden');
                    $('#faviconPreview').removeClass('hidden');
                    $('#faviconArea').addClass('has-preview');
                }
                reader.readAsDataURL(file);
            }
        });

        // Submit form dengan konfirmasi SweetAlert
        $('#formSettings').on('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Simpan Perubahan?',
                text: "Apakah Anda yakin ingin menyimpan perubahan pengaturan?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#9a55ff',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Simpan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Tampilkan loading SweetAlert
                    Swal.fire({
                        title: 'Menyimpan...',
                        text: 'Mohon tunggu sebentar',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // Bersihkan format NPWP untuk dikirim ke database
                    let npwp = $('input[name="npwp"]').val().replace(/\D/g, '');
                    $('input[name="npwp"]').val(npwp);

                    // Submit form
                    this.submit();
                }
            });
        });

        // Tampilkan SweetAlert sukses jika ada session success
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#9a55ff',
                timer: 3000,
                timerProgressBar: true
            });
        @endif

        // Tampilkan SweetAlert error jika ada error validasi
        @if($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Validasi Gagal',
                html: `
                    <ul style="text-align: left; margin-top: 10px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                `,
                confirmButtonColor: '#9a55ff'
            });
        @endif
    });
    </script>
    @endpush
    @endsection
