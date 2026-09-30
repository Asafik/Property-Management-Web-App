@extends('layouts.partial.app')

@section('title', isset($customer) ? 'Edit Customer - Property Management App' : 'Tambah Customer - Property Management App')

@section('content')
<style>
    .card {
        border-radius: 12px !important;
        border: none !important;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .form-control, .form-select, select.form-control, textarea.form-control {
        border: 1.5px solid #e2e8f0;
        border-radius: 8px;
        padding: 0.6rem 0.85rem;
        font-size: 0.88rem;
        color: #2c2e3f;
        background-color: #ffffff;
        height: auto;
        min-height: 40px;
        transition: all 0.2s ease;
    }

    .form-control:focus, .form-select:focus, select.form-control:focus, textarea.form-control:focus {
        border-color: #9a55ff !important;
        box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.15) !important;
        outline: none;
    }

    /* Seamless Modern Input Group Styling */
    .input-group {
        display: flex !important;
        flex-wrap: nowrap !important;
        align-items: stretch !important;
        width: 100% !important;
    }

    .input-group .input-group-text {
        background-color: #f8fafc !important;
        border: 1.5px solid #e2e8f0 !important;
        border-right: none !important;
        border-top-left-radius: 8px !important;
        border-bottom-left-radius: 8px !important;
        border-top-right-radius: 0 !important;
        border-bottom-right-radius: 0 !important;
        color: #9a55ff !important;
        font-size: 0.95rem !important;
        padding: 0 0.85rem !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        min-height: 40px !important;
        transition: all 0.2s ease !important;
        margin: 0 !important;
    }

    .input-group .form-control {
        border-top-left-radius: 0 !important;
        border-bottom-left-radius: 0 !important;
        border-top-right-radius: 8px !important;
        border-bottom-right-radius: 8px !important;
        border-left: 1.5px solid #e2e8f0 !important;
        margin: 0 !important;
        flex: 1 1 auto;
    }

    .input-group:focus-within .input-group-text {
        border-color: #9a55ff !important;
        background-color: #fdfaff !important;
    }

    .input-group:focus-within .form-control {
        border-color: #9a55ff !important;
        box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.15) !important;
    }

    .form-label {
        font-size: 0.82rem;
        font-weight: 700;
        color: #3b3f5c !important;
        margin-bottom: 0.35rem;
        letter-spacing: 0.3px;
    }

    .btn-gradient-primary {
        background: linear-gradient(to right, #da8cff, #9a55ff) !important;
        color: #ffffff !important;
        border: none;
    }

    .btn-gradient-secondary {
        background: #6c757d !important;
        color: #ffffff !important;
        border: none;
    }

    .btn-nav-action {
        height: 38px !important;
        padding: 0 1.35rem !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 0.45rem !important;
        font-size: 0.88rem !important;
        font-weight: 600 !important;
        border-radius: 8px !important;
        white-space: nowrap !important;
        transition: all 0.2s ease !important;
        line-height: 1 !important;
    }

    .btn-nav-action i {
        font-size: 1.1rem !important;
        line-height: 1 !important;
    }

    /* Compact Tab Navigation */
    .custom-nav-tabs {
        display: flex;
        flex-wrap: nowrap;
        gap: 6px;
        border-bottom: 1px solid #edf2f9;
        padding-bottom: 0.75rem;
        margin-bottom: 1.25rem;
        overflow-x: auto;
        scrollbar-width: thin;
        scrollbar-color: #da8cff transparent;
    }

    .custom-nav-tabs::-webkit-scrollbar {
        height: 4px;
    }
    .custom-nav-tabs::-webkit-scrollbar-thumb {
        background: #da8cff;
        border-radius: 10px;
    }

    .custom-tab-item {
        list-style: none;
        flex-shrink: 0;
    }

    .custom-tab-link {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        height: 32px;
        padding: 0 0.75rem;
        border-radius: 6px;
        background: #f8fafc;
        color: #64748b;
        font-weight: 600;
        font-size: 0.8rem;
        text-decoration: none;
        transition: all 0.2s ease;
        white-space: nowrap;
        border: 1px solid #e2e8f0;
        cursor: pointer;
        line-height: 1;
        box-sizing: border-box;
    }

    .custom-tab-link i {
        font-size: 0.95rem;
        color: #9a55ff;
        transition: all 0.2s ease;
        line-height: 1;
    }

    .custom-tab-link:hover {
        background: #ffffff;
        color: #9a55ff;
        border-color: #c084fc;
    }

    .custom-tab-link.active {
        background: linear-gradient(135deg, #da8cff 0%, #9a55ff 100%) !important;
        color: #ffffff !important;
        border: 1px solid transparent !important;
        box-shadow: 0 2px 6px rgba(154, 85, 255, 0.25) !important;
    }

    .custom-tab-link.active i {
        color: #ffffff !important;
    }

    .custom-tab-pane {
        display: none;
        animation: fadeIn 0.25s ease;
    }

    .custom-tab-pane.active {
        display: block;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(6px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Section Subtitle */
    .form-section-title {
        font-size: 0.95rem;
        font-weight: 700;
        color: #9a55ff;
        margin-top: 1rem;
        margin-bottom: 0.85rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        border-bottom: 1px dashed #e2d4fd;
        padding-bottom: 0.4rem;
    }

    /* Same Address Checkbox Card */
    .same-address-card {
        background: #f8fafc;
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        padding: 0.85rem 1.15rem;
        margin: 1.2rem 0;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        gap: 0.85rem;
        cursor: pointer;
    }

    .same-address-card:hover {
        background: #faf7ff;
        border-color: #d8b4fe;
    }

    .custom-checkbox-input {
        width: 22px !important;
        height: 22px !important;
        min-height: 22px !important;
        cursor: pointer;
        background-color: #ffffff;
        border: 2px solid #cbd5e1 !important;
        border-radius: 6px !important;
        position: relative;
        appearance: none;
        -webkit-appearance: none;
        outline: none !important;
        box-shadow: none !important;
        transition: all 0.2s ease;
        flex-shrink: 0;
        margin: 0 !important;
        padding: 0 !important;
        display: inline-flex !important;
        align-items: center;
        justify-content: center;
    }

    .custom-checkbox-input:checked {
        background: linear-gradient(135deg, #da8cff, #9a55ff) !important;
        border-color: #9a55ff !important;
    }

    .custom-checkbox-input:checked:after {
        content: '';
        display: block;
        width: 6px;
        height: 11px;
        border: solid white;
        border-width: 0 2.5px 2.5px 0;
        transform: rotate(45deg);
        margin-bottom: 2px;
    }

    .same-address-label {
        cursor: pointer;
        user-select: none;
        flex: 1;
        margin-bottom: 0;
    }

    /* File Upload Box */
    .file-upload-box {
        position: relative;
        border: 2px dashed #d1d5db;
        border-radius: 12px;
        padding: 1.25rem 1rem;
        text-align: center;
        background: #fafbff;
        cursor: pointer;
        transition: all 0.25s ease;
        overflow: hidden;
    }

    .file-upload-box:hover {
        border-color: #9a55ff;
        background: #f9f6ff;
        box-shadow: 0 4px 12px rgba(154, 85, 255, 0.08);
    }

    .file-upload-box.has-file {
        border-color: #10b981 !important;
        background: #f0fdf4 !important;
        border-style: solid !important;
    }

    .file-upload-box input[type="file"] {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
        z-index: 10;
    }

    .file-upload-icon {
        font-size: 2.2rem;
        color: #9a55ff;
        margin-bottom: 0.35rem;
        transition: all 0.2s ease;
    }

    .file-upload-box.has-file .file-upload-icon {
        color: #10b981 !important;
    }

    .file-upload-text {
        font-size: 0.88rem;
        font-weight: 700;
        color: #3b3f5c;
    }

    .file-upload-hint {
        font-size: 0.75rem;
        color: #888ea8;
        margin-top: 0.2rem;
    }

    /* KTP Scanner & OCR Styles */
    .ktp-dropzone:hover {
        background-color: #f3e8ff !important;
        border-color: #9a55ff !important;
    }
    .ktp-dropzone.dragover {
        background-color: #ede9fe !important;
        border-color: #7c3aed !important;
        transform: scale(1.01);
    }
    .ktp-scan-laser {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, transparent, #9a55ff, #da8cff, #9a55ff, transparent);
        box-shadow: 0 0 12px 3px rgba(154, 85, 255, 0.75);
        animation: ktpScanAnimation 1.6s ease-in-out infinite alternate;
        pointer-events: none;
    }
    @keyframes ktpScanAnimation {
        0% { top: 5%; }
        100% { top: 92%; }
    }
</style>

@php
    $isEdit = isset($customer);
    $formAction = $isEdit ? route('customer.update', $customer->id) : route('customer.store');
    $displayId = $isEdit ? $customer->customer_id : $customerId;
@endphp

<div class="container-fluid p-2 p-sm-3 p-md-4">

    <!-- Header Card Banner -->
    <div class="row mb-3 mb-sm-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 header-card">
                <div class="card-body p-4 p-md-4 py-4 py-md-4 d-flex flex-wrap justify-content-between align-items-center gap-3" style="min-height: 105px;">
                    <div>
                        <h3 class="text-dark mb-1 fw-bold" style="font-size: 1.35rem;">
                            {{ $isEdit ? 'Edit Customer' : 'Tambah Customer Baru' }}
                        </h3>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">
                            Input data lengkap customer untuk booking unit, pengajuan KPR, dan transaksi
                        </p>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <a href="{{ route('customer.data') }}" class="btn btn-gradient-secondary d-inline-flex align-items-center gap-1" style="height: 38px; padding: 0.5rem 1rem;">
                            <i class="mdi mdi-arrow-left"></i> Kembali ke Data User
                        </a>
                        <div class="d-none d-md-block pe-2">
                            <i class="mdi {{ $isEdit ? 'mdi-account-edit' : 'mdi-account-plus' }}" style="font-size: 3rem; color: #9a55ff; opacity: 0.25;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Info ID & Status Bar -->
    <div class="row mb-3">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body p-3 d-flex flex-wrap align-items-center justify-content-between gap-2">
                    <div class="d-flex align-items-center gap-3">
                        <span class="badge px-3 py-2" style="background: linear-gradient(135deg, #da8cff, #9a55ff); color: #fff; font-size: 0.9rem; font-weight: 700; border-radius: 8px;">
                            <i class="mdi mdi-card-account-details-outline me-1"></i>{{ $displayId }}
                        </span>
                        <div class="text-muted small d-flex align-items-center">
                            <i class="mdi mdi-calendar me-1" style="color: #9a55ff;"></i>
                            <span>Tanggal: <strong>{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</strong></span>
                        </div>
                    </div>
                    <div>
                        <span class="badge px-3 py-2" style="background: {{ $isEdit ? '#e0f2fe' : '#dcfce7' }}; color: {{ $isEdit ? '#0284c7' : '#15803d' }}; border-radius: 8px; font-weight: 700;">
                            <i class="mdi {{ $isEdit ? 'mdi-pencil' : 'mdi-plus' }} me-1"></i>{{ $isEdit ? 'Mode Update' : 'Customer Baru' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Form Card -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex flex-wrap justify-content-between align-items-center p-3 border-bottom gap-2">
                    <h5 class="card-title mb-0 fw-bold d-flex align-items-center">
                        <i class="mdi mdi-form-select me-2 text-primary"></i>Formulir Data Customer
                    </h5>
                </div>

                <div class="card-body p-3 p-md-4">
                    <form action="{{ $formAction }}" method="POST" enctype="multipart/form-data" id="formCustomer">
                        @csrf
                        @if($isEdit) @method('PUT') @endif
                        @if(isset($guest) && $guest)
                            <input type="hidden" name="guest_id" value="{{ $guest->id }}">
                        @endif

                        <!-- Compact Tab Navigation -->
                        <ul class="custom-nav-tabs">
                            <li class="custom-tab-item">
                                <a class="custom-tab-link active" data-tab="pribadi" href="#pribadi">
                                    <i class="mdi mdi-account"></i>
                                    <span>Data Pribadi</span>
                                </a>
                            </li>
                            <li class="custom-tab-item">
                                <a class="custom-tab-link" data-tab="alamat" href="#alamat">
                                    <i class="mdi mdi-map-marker"></i>
                                    <span>Alamat Domisili & KTP</span>
                                </a>
                            </li>
                            <li class="custom-tab-item">
                                <a class="custom-tab-link" data-tab="kontak" href="#kontak">
                                    <i class="mdi mdi-phone"></i>
                                    <span>Kontak & Medsos</span>
                                </a>
                            </li>
                            <li class="custom-tab-item">
                                <a class="custom-tab-link" data-tab="pekerjaan" href="#pekerjaan">
                                    <i class="mdi mdi-briefcase"></i>
                                    <span>Pekerjaan & Finansial</span>
                                </a>
                            </li>
                            <li class="custom-tab-item">
                                <a class="custom-tab-link" data-tab="keluarga" href="#keluarga">
                                    <i class="mdi mdi-account-group"></i>
                                    <span>Keluarga</span>
                                </a>
                            </li>
                            <li class="custom-tab-item">
                                <a class="custom-tab-link" data-tab="dokumen" href="#dokumen">
                                    <i class="mdi mdi-file-document"></i>
                                    <span>Dokumen Lampiran</span>
                                </a>
                            </li>
                        </ul>

                        <!-- Tab Panes -->
                        <div class="tab-content-wrapper">

                            <!-- TAB 1: PRIBADI -->
                            <div class="custom-tab-pane active" id="pribadi">
                                <!-- Banner Panduan Auto-Fill KTP -->
                                <div class="p-3 rounded-3 mb-3 d-flex flex-wrap align-items-center justify-content-between gap-2" style="background: linear-gradient(135deg, #f5f3ff, #ede9fe); border: 1px solid #ddd6fe;">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle flex-shrink-0" style="width: 38px; height: 38px; background: #8b5cf6; color: white;">
                                            <i class="mdi mdi-card-account-details-outline fs-5"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark" style="font-size: 0.88rem;">Auto-Fill Data dari Foto e-KTP</div>
                                            <div class="text-muted" style="font-size: 0.76rem;">Scan atau upload foto e-KTP untuk mengisi NIK, Nama, Tanggal Lahir, Alamat, dll secara otomatis.</div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-sm text-white fw-bold d-inline-flex align-items-center gap-1 shadow-sm" id="btnScanKtpTab1" style="background: #7c3aed; border-radius: 6px; font-size: 0.8rem; padding: 0.4rem 0.85rem;">
                                        <i class="mdi mdi-camera-plus-outline"></i>
                                        <span>Scan KTP Sekarang</span>
                                    </button>
                                </div>

                                <div class="row g-3">
                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="full_name" value="{{ old('full_name', $customer->full_name ?? ($guest->name ?? '')) }}" placeholder="Sesuai KTP" required>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Nama Panggilan</label>
                                        <input type="text" class="form-control" name="nickname" value="{{ old('nickname', $customer->nickname ?? '') }}" placeholder="Contoh: John">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="form-label">NIK (Nomor Induk Kependudukan) <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="nik" value="{{ old('nik', $customer->nik ?? '') }}" placeholder="16 digit angka NIK" maxlength="16" required>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Nomor Kartu Keluarga (KK)</label>
                                        <input type="text" class="form-control" name="no_kk" value="{{ old('no_kk', $customer->no_kk ?? '') }}" placeholder="16 digit angka KK" maxlength="16">
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label class="form-label">Tempat Lahir</label>
                                        <input type="text" class="form-control" name="birthplace" value="{{ old('birthplace', $customer->birthplace ?? '') }}" placeholder="Contoh: Jakarta">
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label class="form-label">Tanggal Lahir</label>
                                        <input type="date" class="form-control" name="date_birth" value="{{ old('date_birth', $customer->date_birth ?? '') }}">
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label class="form-label">Usia (Tahun)</label>
                                        <input type="number" class="form-control bg-light" name="age" value="{{ old('age', $customer->age ?? '') }}" placeholder="Otomatis terisi" readonly>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label class="form-label">Jenis Kelamin</label>
                                        <select class="form-control" name="gender">
                                            <option value="">-- Pilih Jenis Kelamin --</option>
                                            <option value="L" {{ old('gender', $customer->gender ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="P" {{ old('gender', $customer->gender ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label class="form-label">Agama</label>
                                        <select class="form-control" name="religion">
                                            <option value="">-- Pilih Agama --</option>
                                            @foreach(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Lainnya'] as $rel)
                                                <option value="{{ $rel }}" {{ old('religion', $customer->religion ?? '') == $rel ? 'selected' : '' }}>{{ $rel }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label class="form-label">Kewarganegaraan</label>
                                        <select class="form-control" name="nationality">
                                            <option value="WNI" {{ old('nationality', $customer->nationality ?? '') == 'WNI' ? 'selected' : '' }}>WNI (Indonesia)</option>
                                            <option value="WNA" {{ old('nationality', $customer->nationality ?? '') == 'WNA' ? 'selected' : '' }}>WNA</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        @php
                                            $currMarital = strtoupper(trim(old('marital_status', $customer->marital_status ?? '')));
                                            if ($currMarital === 'MENIKAH') $currMarital = 'KAWIN';
                                            if ($currMarital === 'BELUM MENIKAH') $currMarital = 'BELUM KAWIN';
                                            if ($currMarital === 'CERAI') $currMarital = 'CERAI HIDUP';
                                        @endphp
                                        <label class="form-label">Status Perkawinan (Sesuai KTP)</label>
                                        <select class="form-control" name="marital_status">
                                            <option value="">-- Pilih Status Perkawinan --</option>
                                            @foreach(['BELUM KAWIN', 'KAWIN', 'CERAI HIDUP', 'CERAI MATI'] as $st)
                                                <option value="{{ $st }}" {{ $currMarital === $st ? 'selected' : '' }}>{{ $st }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label class="form-label">Tanggal Pernikahan</label>
                                        <input type="date" class="form-control" name="marital_date" value="{{ old('marital_date', $customer->marital_date ?? '') }}">
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label class="form-label">Jumlah Anak / Tanggungan</label>
                                        <input type="number" class="form-control" name="child_count" value="{{ old('child_count', $customer->child_count ?? '0') }}" min="0">
                                    </div>
                                </div>
                            </div>

                            <!-- TAB 2: ALAMAT -->
                            <div class="custom-tab-pane" id="alamat">
                                <div class="form-section-title"><i class="mdi mdi-home"></i> Alamat Domisili Saat Ini</div>
                                <div class="row g-3">
                                    <div class="col-12 col-md-4">
                                        <label class="form-label">Provinsi</label>
                                        <select class="form-control select2-search" id="provinsiDomisili" name="domicile_province" data-search="true" style="width: 100%;">
                                            <option value="">-- Memuat Provinsi... --</option>
                                            @if(old('domicile_province', $customer->domicile_province ?? ''))
                                                <option value="{{ old('domicile_province', $customer->domicile_province ?? '') }}" selected>{{ old('domicile_province', $customer->domicile_province ?? '') }}</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label class="form-label">Kota / Kabupaten</label>
                                        <select class="form-control select2-search" id="kotaDomisili" name="domicile_city" data-search="true" style="width: 100%;">
                                            <option value="">-- Pilih Kota/Kabupaten --</option>
                                            @if(old('domicile_city', $customer->domicile_city ?? ''))
                                                <option value="{{ old('domicile_city', $customer->domicile_city ?? '') }}" selected>{{ old('domicile_city', $customer->domicile_city ?? '') }}</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label class="form-label">Kecamatan</label>
                                        <select class="form-control select2-search" id="kecamatanDomisili" name="domicile_subdistrict" data-search="true" style="width: 100%;">
                                            <option value="">-- Pilih Kecamatan --</option>
                                            @if(old('domicile_subdistrict', $customer->domicile_subdistrict ?? ''))
                                                <option value="{{ old('domicile_subdistrict', $customer->domicile_subdistrict ?? '') }}" selected>{{ old('domicile_subdistrict', $customer->domicile_subdistrict ?? '') }}</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label class="form-label">Kelurahan / Desa</label>
                                        <select class="form-control select2-search" id="kelurahanDomisili" name="domicile_village" data-search="true" style="width: 100%;">
                                            <option value="">-- Pilih Kelurahan/Desa --</option>
                                            @if(old('domicile_village', $customer->domicile_village ?? ''))
                                                <option value="{{ old('domicile_village', $customer->domicile_village ?? '') }}" selected>{{ old('domicile_village', $customer->domicile_village ?? '') }}</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-6 col-md-2">
                                        <label class="form-label">RT</label>
                                        <input type="text" class="form-control" id="rtDomisili" name="domicile_rt" value="{{ old('domicile_rt', $customer->domicile_rt ?? '') }}" placeholder="001">
                                    </div>
                                    <div class="col-6 col-md-2">
                                        <label class="form-label">RW</label>
                                        <input type="text" class="form-control" id="rwDomisili" name="domicile_rw" value="{{ old('domicile_rw', $customer->domicile_rw ?? '') }}" placeholder="002">
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label class="form-label">Kode Pos</label>
                                        <input type="text" class="form-control" id="kodePosDomisili" name="domicile_postal_code" value="{{ old('domicile_postal_code', $customer->domicile_postal_code ?? '') }}" placeholder="12345">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Alamat Lengkap Domisili</label>
                                        <textarea class="form-control" id="alamatDomisili" name="domicile_address" rows="2" placeholder="Nama Jalan, Blok, No. Rumah">{{ old('domicile_address', $customer->domicile_address ?? '') }}</textarea>
                                    </div>
                                </div>

                                <!-- Modern Same Address Checkbox Card -->
                                <div class="same-address-card">
                                    <input class="custom-checkbox-input" type="checkbox" id="alamatSamaKTP">
                                    <label class="same-address-label" for="alamatSamaKTP">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="mdi mdi-checkbox-multiple-marked-circle-outline text-primary" style="font-size: 1.3rem;"></i>
                                            <div>
                                                <div class="fw-bold text-dark" style="font-size: 0.9rem;">Alamat KTP Sama dengan Alamat Domisili</div>
                                                <small class="text-muted">Centang opsi ini untuk otomatis menyalin data provinsi, kota, kecamatan, kelurahan, dan alamat lengkap ke data KTP</small>
                                            </div>
                                        </div>
                                    </label>
                                </div>

                                <div class="form-section-title"><i class="mdi mdi-card-account-details"></i> Alamat Sesuai KTP</div>
                                <div class="row g-3">
                                    <div class="col-12 col-md-4">
                                        <label class="form-label">Provinsi</label>
                                        <select class="form-control select2-search" id="provinsiKTP" name="province" data-search="true" style="width: 100%;">
                                            <option value="">-- Memuat Provinsi... --</option>
                                            @if(old('province', $customer->province ?? ''))
                                                <option value="{{ old('province', $customer->province ?? '') }}" selected>{{ old('province', $customer->province ?? '') }}</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label class="form-label">Kota / Kabupaten</label>
                                        <select class="form-control select2-search" id="kotaKTP" name="city" data-search="true" style="width: 100%;">
                                            <option value="">-- Pilih Kota/Kabupaten --</option>
                                            @if(old('city', $customer->city ?? ''))
                                                <option value="{{ old('city', $customer->city ?? '') }}" selected>{{ old('city', $customer->city ?? '') }}</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label class="form-label">Kecamatan</label>
                                        <select class="form-control select2-search" id="kecamatanKTP" name="subdistrict" data-search="true" style="width: 100%;">
                                            <option value="">-- Pilih Kecamatan --</option>
                                            @if(old('subdistrict', $customer->subdistrict ?? ''))
                                                <option value="{{ old('subdistrict', $customer->subdistrict ?? '') }}" selected>{{ old('subdistrict', $customer->subdistrict ?? '') }}</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label class="form-label">Kelurahan / Desa</label>
                                        <select class="form-control select2-search" id="kelurahanKTP" name="village" data-search="true" style="width: 100%;">
                                            <option value="">-- Pilih Kelurahan/Desa --</option>
                                            @if(old('village', $customer->village ?? ''))
                                                <option value="{{ old('village', $customer->village ?? '') }}" selected>{{ old('village', $customer->village ?? '') }}</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-6 col-md-2">
                                        <label class="form-label">RT</label>
                                        <input type="text" class="form-control" id="rtKTP" name="rt" value="{{ old('rt', $customer->rt ?? '') }}" placeholder="001">
                                    </div>
                                    <div class="col-6 col-md-2">
                                        <label class="form-label">RW</label>
                                        <input type="text" class="form-control" id="rwKTP" name="rw" value="{{ old('rw', $customer->rw ?? '') }}" placeholder="002">
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label class="form-label">Kode Pos</label>
                                        <input type="text" class="form-control" id="kodePosKTP" name="postal_code" value="{{ old('postal_code', $customer->postal_code ?? '') }}" placeholder="12345">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Alamat Lengkap Sesuai KTP</label>
                                        <textarea class="form-control" id="alamatKTP" name="address" rows="2" placeholder="Nama Jalan, Blok, No. Rumah">{{ old('address', $customer->address ?? '') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- TAB 3: KONTAK -->
                            <div class="custom-tab-pane" id="kontak">
                                <div class="row g-3">
                                    <div class="col-12 col-md-6">
                                        <label class="form-label">No. HP / WhatsApp <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light text-success fw-bold"><i class="mdi mdi-whatsapp"></i></span>
                                            <input type="text" class="form-control" name="phone" value="{{ old('phone', $customer->phone ?? ($guest->phone ?? '')) }}" placeholder="081234567890" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="form-label">No. Telepon Rumah / Kantor</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light text-primary"><i class="mdi mdi-phone-classic"></i></span>
                                            <input type="text" class="form-control" name="home_phone" value="{{ old('home_phone', $customer->home_phone ?? '') }}" placeholder="021-1234567">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Email Pribadi</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light text-primary"><i class="mdi mdi-email-outline"></i></span>
                                            <input type="email" class="form-control" name="email" value="{{ old('email', $customer->email ?? ($guest->email ?? '')) }}" placeholder="john@example.com">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Email Kantor</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light text-primary"><i class="mdi mdi-briefcase-outline"></i></span>
                                            <input type="email" class="form-control" name="office_email" value="{{ old('office_email', $customer->office_email ?? '') }}" placeholder="john@company.com">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-section-title mt-4"><i class="mdi mdi-share-variant"></i> Akun Media Sosial</div>
                                <div class="row g-3">
                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Instagram</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light text-primary">@</span>
                                            <input type="text" class="form-control" name="instagram" value="{{ old('instagram', $customer->instagram ?? '') }}" placeholder="username_instagram">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Facebook</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light text-primary"><i class="mdi mdi-facebook"></i></span>
                                            <input type="text" class="form-control" name="facebook" value="{{ old('facebook', $customer->facebook ?? '') }}" placeholder="nama.profil.facebook">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- TAB 4: PEKERJAAN & FINANSIAL -->
                            <div class="custom-tab-pane" id="pekerjaan">
                                <div class="row g-3">
                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Status Pekerjaan</label>
                                        <select class="form-control" name="job_status" id="jobStatus">
                                            <option value="">-- Pilih Pekerjaan --</option>
                                            @foreach(['Karyawan Swasta','PNS','Wiraswasta','Ibu Rumah Tangga','Pensiunan','Lainnya'] as $j)
                                                <option value="{{ $j }}" {{ old('job_status', $customer->job_status ?? '') == $j ? 'selected' : '' }}>{{ $j }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-6" id="jobStatusLainnyaWrapper" style="{{ old('job_status', $customer->job_status ?? '') == 'Lainnya' ? 'display:block' : 'display:none' }}">
                                        <label class="form-label">Masukkan Status Pekerjaan Lainnya</label>
                                        <input type="text" class="form-control" id="jobStatusLainnya" name="job_status_lainnya" value="{{ old('job_status_lainnya', $customer->job_status_lainnya ?? '') }}" placeholder="Tuliskan pekerjaan...">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Nama Perusahaan / Usaha</label>
                                        <input type="text" class="form-control" name="company_name" value="{{ old('company_name', $customer->company_name ?? '') }}" placeholder="Contoh: PT. Maju Bersama">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Penghasilan Pokok per Bulan</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light text-primary fw-bold">Rp</span>
                                            <input type="text" class="form-control rupiah-format" name="main_income" value="{{ old('main_income', $customer->main_income ?? '') }}" placeholder="10.000.000">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Penghasilan Tambahan per Bulan</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light text-primary fw-bold">Rp</span>
                                            <input type="text" class="form-control rupiah-format" name="side_income" value="{{ old('side_income', $customer->side_income ?? '') }}" placeholder="2.000.000">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Nomor Pokok Wajib Pajak (NPWP)</label>
                                        <input type="text" class="form-control" name="npwp" value="{{ old('npwp', $customer->npwp ?? '') }}" placeholder="XX.XXX.XXX.X-XXX.XXX">
                                    </div>
                                </div>
                            </div>

                            <!-- TAB 5: KELUARGA -->
                            <div class="custom-tab-pane" id="keluarga">
                                <div class="form-section-title"><i class="mdi mdi-account-heart"></i> Data Pasangan (Suami / Istri)</div>
                                <div class="row g-3">
                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Nama Lengkap Pasangan</label>
                                        <input type="text" class="form-control" name="spouse_name" value="{{ old('spouse_name', $customer->spouse_name ?? '') }}" placeholder="Sesuai KTP Pasangan">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="form-label">NIK Pasangan</label>
                                        <input type="text" class="form-control" name="spouse_nik" value="{{ old('spouse_nik', $customer->spouse_nik ?? '') }}" placeholder="16 digit NIK Pasangan" maxlength="16">
                                    </div>
                                </div>

                                <div class="form-section-title mt-4"><i class="mdi mdi-account-multiple"></i> Data Orang Tua</div>
                                <div class="row g-3">
                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Nama Ayah Kandung</label>
                                        <input type="text" class="form-control" name="father_name" value="{{ old('father_name', $customer->father_name ?? '') }}" placeholder="Nama Ayah">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Nama Ibu Kandung</label>
                                        <input type="text" class="form-control" name="mother_name" value="{{ old('mother_name', $customer->mother_name ?? '') }}" placeholder="Nama Ibu">
                                    </div>
                                </div>
                            </div>

                            <!-- TAB 6: DOKUMEN -->
                            <div class="custom-tab-pane" id="dokumen">
                                <div class="form-section-title"><i class="mdi mdi-file-upload"></i> Upload Dokumen Lampiran</div>
                                <div class="row g-3">
                                    @foreach(['uploadKtp' => 'KTP Customer', 'uploadKk' => 'Kartu Keluarga (KK)', 'uploadNpwp' => 'NPWP', 'uploadPasangan' => 'KTP Pasangan'] as $f => $l)
                                        <div class="col-12 col-md-6">
                                            <label class="form-label fw-bold">{{ $l }}</label>
                                            <div class="file-upload-box" id="box_{{ $f }}">
                                                <input type="file" id="{{ $f }}" name="{{ $f }}" data-label="{{ $l }}" accept=".jpg,.jpeg,.png,.pdf">
                                                <i class="mdi mdi-cloud-upload file-upload-icon"></i>
                                                <div class="file-upload-text file-name-text">Klik untuk upload {{ $l }}</div>
                                                <div class="file-upload-hint">Format: JPG, PNG, PDF (Maks. 10MB)</div>
                                            </div>

                                            @if($isEdit && isset($customer->documents))
                                                @php
                                                    $docType = str_replace('upload', '', $f) == 'Ktp' ? 'KTP' : (str_replace('upload', '', $f) == 'Kk' ? 'Kartu Keluarga' : (str_replace('upload', '', $f) == 'Npwp' ? 'NPWP' : 'KTP Pasangan'));
                                                    $doc = $customer->documents->where('document_name', $docType)->first();
                                                @endphp
                                                @if($doc) 
                                                    @php
                                                        $fileUrl = file_exists(public_path('uploads/' . $doc->file)) ? asset('uploads/' . $doc->file) : asset('storage/' . $doc->file);
                                                        $ext = pathinfo($doc->file, PATHINFO_EXTENSION);
                                                        $downloadName = str_replace(' ', '_', $l) . '_' . str_replace(' ', '_', $customer->full_name) . '.' . $ext;
                                                    @endphp
                                                    <div class="mt-2 d-flex justify-content-end gap-2">
                                                        <a href="{{ $fileUrl }}" target="_blank" class="btn btn-sm btn-outline-info"> 
                                                            <i class="mdi mdi-eye me-1"></i> Lihat Dokumen
                                                        </a>
                                                        <a href="{{ $fileUrl }}" download="{{ $downloadName }}" class="btn btn-sm btn-outline-success"> 
                                                            <i class="mdi mdi-download me-1"></i> Unduh
                                                        </a>
                                                    </div> 
                                                @endif
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>

                        <hr class="my-4" style="border-color: #edf2f9;">

                        <!-- Action Navigation Buttons -->
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3 mt-4">
                            <div class="d-flex flex-wrap gap-2 w-100 w-sm-auto">
                                <button type="button" class="btn btn-gradient-secondary btn-nav-action" id="btnPrevGlobal">
                                    <i class="mdi mdi-arrow-left"></i>
                                    <span>Sebelumnya</span>
                                </button>
                                <button type="reset" class="btn btn-outline-secondary btn-nav-action">
                                    <i class="mdi mdi-refresh"></i>
                                    <span>Reset</span>
                                </button>
                            </div>
                            <div>
                                <button type="button" id="btnNextGlobal" class="btn btn-gradient-primary btn-nav-action">
                                    <span>Lanjut</span>
                                    <i class="mdi mdi-arrow-right"></i>
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL SCAN KTP / OCR AUTO-FILL -->
<div class="modal fade" id="modalKtpScanner" tabindex="-1" aria-labelledby="modalKtpScannerLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content" style="border-radius: 14px; border: none; box-shadow: 0 15px 35px rgba(0,0,0,0.18);">
            <div class="modal-header border-bottom py-3 px-4" style="background: linear-gradient(135deg, #f8fafc, #f1f5f9);">
                <div class="d-flex align-items-center gap-2">
                    <div class="d-flex align-items-center justify-content-center rounded-3" style="width: 38px; height: 38px; background: linear-gradient(135deg, #7c3aed, #9a55ff); color: white;">
                        <i class="mdi mdi-card-account-details-outline fs-4"></i>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold text-dark mb-0" id="modalKtpScannerLabel" style="font-size: 1.05rem;">
                            Scan & Auto-Fill Data e-KTP
                        </h5>
                        <small class="text-muted" style="font-size: 0.75rem;">Ekstrak otomatis NIK, Nama, Tanggal Lahir, Alamat, dll dari foto e-KTP</small>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">
                <!-- Sumber Input: Upload File vs Kamera -->
                <ul class="nav nav-pills nav-fill mb-3 p-1 rounded-3" style="background: #f1f5f9;" id="ktpSourceTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active fw-semibold py-2 d-flex align-items-center justify-content-center gap-2" id="tab-upload-btn" data-bs-toggle="pill" data-bs-target="#tab-upload" type="button" role="tab" style="border-radius: 8px; font-size: 0.85rem;">
                            <i class="mdi mdi-file-image-outline fs-5"></i> Upload Foto KTP
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-semibold py-2 d-flex align-items-center justify-content-center gap-2" id="tab-camera-btn" data-bs-toggle="pill" data-bs-target="#tab-camera" type="button" role="tab" style="border-radius: 8px; font-size: 0.85rem;">
                            <i class="mdi mdi-camera-outline fs-5"></i> Ambil dari Kamera
                        </button>
                    </li>
                </ul>

                <div class="tab-content" id="ktpSourceTabContent">
                    <!-- Tab 1: Upload File -->
                    <div class="tab-pane fade show active" id="tab-upload" role="tabpanel">
                        <div class="ktp-dropzone p-4 text-center rounded-3 border-2 border-dashed" id="ktpDropzone" style="border-color: #cbd5e1; background: #faf5ff; cursor: pointer; transition: all 0.2s ease;">
                            <input type="file" id="ktpFileInput" accept="image/*" class="d-none">
                            <i class="mdi mdi-cloud-upload-outline text-primary mb-2" style="font-size: 3rem;"></i>
                            <h6 class="fw-bold text-dark mb-1">Klik atau Tarik Foto e-KTP ke sini</h6>
                            <p class="text-muted small mb-2">Mendukung format JPG, PNG, WEBP (Bisa juga tekan <strong>Ctrl + V</strong> untuk paste gambar)</p>
                            <span class="badge px-3 py-1.5" style="background: #ede9fe; color: #7c3aed; font-weight: 600;">
                                <i class="mdi mdi-lightning-bolt me-1"></i>Pindai Otomatis dengan AI OCR
                            </span>
                        </div>
                    </div>

                    <!-- Tab 2: Kamera -->
                    <div class="tab-pane fade" id="tab-camera" role="tabpanel">
                        <div class="text-center rounded-3 p-2 bg-dark position-relative overflow-hidden" style="min-height: 240px;">
                            <video id="ktpCameraVideo" autoplay playsinline class="w-100 rounded-2" style="max-height: 280px; object-fit: contain; background: #000;"></video>
                            <div class="ktp-camera-overlay" id="ktpCameraOverlay" style="display: none; position: absolute; top: 8%; left: 8%; right: 8%; bottom: 8%; border: 2px dashed rgba(255,255,255,0.75); border-radius: 12px; pointer-events: none;">
                                <span class="badge bg-dark bg-opacity-75 text-white position-absolute top-0 start-50 translate-middle-x mt-2">
                                    Posisikan KTP di dalam bingkai
                                </span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center gap-2 mt-3">
                            <button type="button" class="btn btn-outline-secondary btn-sm" id="btnStartCamera">
                                <i class="mdi mdi-camera-switch me-1"></i>Buka Kamera
                            </button>
                            <button type="button" class="btn btn-primary btn-sm text-white px-3 fw-bold" id="btnCaptureCamera" disabled>
                                <i class="mdi mdi-camera me-1"></i>Ambil Foto
                            </button>
                            <button type="button" class="btn btn-outline-danger btn-sm" id="btnStopCamera" style="display: none;">
                                <i class="mdi mdi-stop me-1"></i>Tutup
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Preview Area & Progress Scan -->
                <div id="ktpPreviewWrapper" class="mt-3 p-3 rounded-3 border" style="background: #ffffff; display: none;">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="fw-bold text-dark small d-flex align-items-center gap-1">
                            <i class="mdi mdi-image-check text-success"></i> Foto KTP yang Dipindai
                        </span>
                        <button type="button" class="btn btn-sm btn-outline-secondary py-0.5 px-2" id="btnResetKtpScan" style="font-size: 0.76rem;">
                            <i class="mdi mdi-refresh me-1"></i>Ganti Foto
                        </button>
                    </div>

                    <div class="position-relative text-center bg-light rounded-2 p-2 overflow-hidden" style="max-height: 220px;">
                        <img id="ktpImagePreview" src="" alt="Preview KTP" class="img-fluid rounded" style="max-height: 200px; object-fit: contain;">
                        <!-- Scanline Laser Effect -->
                        <div id="ktpScanline" class="ktp-scan-laser" style="display: none;"></div>
                    </div>

                    <!-- Progress Bar OCR -->
                    <div id="ktpOcrProgressWrapper" class="mt-3" style="display: none;">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="small fw-semibold text-primary" id="ktpOcrStatusText">
                                <span class="spinner-border spinner-border-sm me-1" role="status"></span>Menganalisis KTP...
                            </span>
                            <span class="small fw-bold text-primary" id="ktpOcrPercent">0%</span>
                        </div>
                        <div class="progress" style="height: 6px; border-radius: 10px; background: #e2e8f0;">
                            <div id="ktpOcrProgressBar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%; background: linear-gradient(90deg, #7c3aed, #9a55ff);"></div>
                        </div>
                    </div>
                </div>

                <!-- Form Verifikasi Data Hasil Ekstraksi OCR -->
                <div id="ktpResultWrapper" class="mt-3" style="display: none;">
                    <div class="alert alert-success d-flex align-items-center py-2 px-3 mb-3 rounded-3" style="font-size: 0.82rem;">
                        <i class="mdi mdi-check-circle fs-5 me-2 text-success"></i>
                        <div><strong>Berhasil!</strong> Data berhasil dibaca dari foto KTP. Periksa atau koreksi hasil di bawah jika diperlukan:</div>
                    </div>

                    <div class="row g-2" style="font-size: 0.84rem;">
                        <div class="col-12 col-md-6">
                            <label class="form-label small mb-1 fw-bold text-dark">NIK (16 Digit) <span class="text-danger">*</span></label>
                            <input type="text" id="ocr_nik" class="form-control form-control-sm fw-bold font-monospace text-primary" maxlength="16" placeholder="3271xxxxxxxxxxxx">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label small mb-1 fw-bold text-dark">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" id="ocr_full_name" class="form-control form-control-sm fw-bold text-uppercase" placeholder="Nama Sesuai KTP">
                        </div>
                        <div class="col-6 col-md-6">
                            <label class="form-label small mb-1 fw-bold text-dark">Tempat Lahir</label>
                            <input type="text" id="ocr_birthplace" class="form-control form-control-sm text-uppercase" placeholder="Kota/Kabupaten">
                        </div>
                        <div class="col-6 col-md-6">
                            <label class="form-label small mb-1 fw-bold text-dark">Tanggal Lahir</label>
                            <input type="date" id="ocr_date_birth" class="form-control form-control-sm">
                        </div>
                        <div class="col-6 col-md-4">
                            <label class="form-label small mb-1 fw-bold text-dark">Jenis Kelamin</label>
                            <select id="ocr_gender" class="form-select form-select-sm">
                                <option value="">-- Pilih --</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="col-6 col-md-4">
                            <label class="form-label small mb-1 fw-bold text-dark">Agama</label>
                            <select id="ocr_religion" class="form-select form-select-sm">
                                <option value="">-- Pilih --</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Katolik">Katolik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="form-label small mb-1 fw-bold text-dark">Status Perkawinan</label>
                            <select id="ocr_marital_status" class="form-select form-select-sm">
                                <option value="">-- Pilih --</option>
                                <option value="BELUM KAWIN">BELUM KAWIN</option>
                                <option value="KAWIN">KAWIN</option>
                                <option value="CERAI HIDUP">CERAI HIDUP</option>
                                <option value="CERAI MATI">CERAI MATI</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label small mb-1 fw-bold text-dark">Alamat Lengkap</label>
                            <input type="text" id="ocr_address" class="form-control form-control-sm" placeholder="Nama Jalan, Blok, No. Rumah">
                        </div>
                        <div class="col-4 col-md-2">
                            <label class="form-label small mb-1 fw-bold text-dark">RT</label>
                            <input type="text" id="ocr_rt" class="form-control form-control-sm" placeholder="001">
                        </div>
                        <div class="col-4 col-md-2">
                            <label class="form-label small mb-1 fw-bold text-dark">RW</label>
                            <input type="text" id="ocr_rw" class="form-control form-control-sm" placeholder="002">
                        </div>
                        <div class="col-4 col-md-4">
                            <label class="form-label small mb-1 fw-bold text-dark">Kelurahan / Desa</label>
                            <input type="text" id="ocr_village" class="form-control form-control-sm" placeholder="Kelurahan">
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="form-label small mb-1 fw-bold text-dark">Kecamatan</label>
                            <input type="text" id="ocr_subdistrict" class="form-control form-control-sm" placeholder="Kecamatan">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label small mb-1 fw-bold text-dark">Kota / Kabupaten</label>
                            <input type="text" id="ocr_city" class="form-control form-control-sm" placeholder="Kota / Kabupaten">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label small mb-1 fw-bold text-dark">Provinsi</label>
                            <input type="text" id="ocr_province" class="form-control form-control-sm" placeholder="Provinsi">
                        </div>
                    </div>

                    <!-- Accordion Raw Text OCR (Opsional) -->
                    <div class="mt-2 text-end">
                        <a class="text-muted small text-decoration-none" data-bs-toggle="collapse" href="#collapseRawOcr" role="button" style="font-size: 0.74rem;">
                            <i class="mdi mdi-code-tags me-1"></i>Lihat teks mentah pembacaan OCR
                        </a>
                        <div class="collapse text-start mt-2" id="collapseRawOcr">
                            <textarea id="ocr_raw_text" class="form-control form-control-sm font-monospace text-muted" rows="4" readonly style="font-size: 0.72rem; background: #f8fafc;"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer border-top py-2.5 px-4 bg-light d-flex justify-content-between">
                <button type="button" class="btn btn-sm btn-light border px-3" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-sm text-white px-4 fw-bold shadow-sm" id="btnApplyKtpToForm" disabled style="background: linear-gradient(135deg, #7c3aed, #9a55ff); border-radius: 6px;">
                    <i class="mdi mdi-check-all me-1"></i>Terapkan ke Formulir Customer
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // 1. Tab Navigation
    $('.custom-tab-link').on('click', function(e) {
        e.preventDefault();
        $('.custom-tab-link').removeClass('active');
        $('.custom-tab-pane').removeClass('active');
        $(this).addClass('active');
        $($(this).attr('href')).addClass('active');
        updateButtonState();
    });

    // 2. Hitung Usia Otomatis dari Tanggal Lahir
    $('input[name="date_birth"]').on('change', function() {
        if (!this.value) return;
        const birth = new Date(this.value);
        const today = new Date();
        let age = today.getFullYear() - birth.getFullYear();
        if (today.getMonth() < birth.getMonth() || (today.getMonth() == birth.getMonth() && today.getDate() < birth.getDate())) age--;
        $('input[name="age"]').val(age);
    });

    // --- API WILAYAH INDONESIA DENGAN SELECT2 SEARCH ---
    const API_BASE = 'https://www.emsifa.com/api-wilayah-indonesia/api';

    // Init Select2 dengan Fitur Search untuk Dropdown Wilayah
    const wilayahSelectIds = [
        '#provinsiDomisili', '#kotaDomisili', '#kecamatanDomisili', '#kelurahanDomisili',
        '#provinsiKTP', '#kotaKTP', '#kecamatanKTP', '#kelurahanKTP'
    ];

    wilayahSelectIds.forEach(id => {
        $(id).select2({
            theme: 'bootstrap-5',
            width: '100%',
            dropdownParent: $(id).parent()
        });
    });

    async function loadWilayah(type, targetSelect, parentId = null, selectedValue = '') {
        let url = '';
        if (type === 'provinces') {
            url = `${API_BASE}/provinces.json`;
        } else if (type === 'regencies' && parentId) {
            url = `${API_BASE}/regencies/${parentId}.json`;
        } else if (type === 'districts' && parentId) {
            url = `${API_BASE}/districts/${parentId}.json`;
        } else if (type === 'villages' && parentId) {
            url = `${API_BASE}/villages/${parentId}.json`;
        }

        if (!url || !targetSelect) return null;

        try {
            const res = await fetch(url);
            const data = await res.json();

            let placeholder = '-- Pilih --';
            if (type === 'provinces') placeholder = '-- Pilih Provinsi --';
            else if (type === 'regencies') placeholder = '-- Pilih Kota/Kabupaten --';
            else if (type === 'districts') placeholder = '-- Pilih Kecamatan --';
            else if (type === 'villages') placeholder = '-- Pilih Kelurahan/Desa --';

            let optionsHtml = `<option value="">${placeholder}</option>`;
            let matchedId = null;

            data.forEach(item => {
                const name = item.name.trim();
                const isSelected = selectedValue && (name.toLowerCase() === selectedValue.trim().toLowerCase());
                if (isSelected) matchedId = item.id;
                optionsHtml += `<option value="${name}" data-id="${item.id}" ${isSelected ? 'selected' : ''}>${name}</option>`;
            });

            targetSelect.innerHTML = optionsHtml;
            $(targetSelect).trigger('change.select2');
            return matchedId;
        } catch (e) {
            console.error(`Error loading wilayah ${type}:`, e);
            return null;
        }
    }

    async function setupWilayahCascade(prefix, initialVals = {}) {
        const provSelect = document.getElementById('provinsi' + prefix);
        const kotaSelect = document.getElementById('kota' + prefix);
        const kecSelect = document.getElementById('kecamatan' + prefix);
        const kelSelect = document.getElementById('kelurahan' + prefix);

        if (!provSelect) return;

        // 1. Load Provinces
        const provId = await loadWilayah('provinces', provSelect, null, initialVals.province);

        if (provId) {
            const kotaId = await loadWilayah('regencies', kotaSelect, provId, initialVals.city);
            if (kotaId) {
                const kecId = await loadWilayah('districts', kecSelect, kotaId, initialVals.subdistrict);
                if (kecId) {
                    await loadWilayah('villages', kelSelect, kecId, initialVals.village);
                }
            }
        }

        // On Province Change (jQuery event for Select2 compatibility)
        $('#provinsi' + prefix).on('change', async function() {
            const selectedOpt = this.options[this.selectedIndex];
            const pId = selectedOpt ? selectedOpt.getAttribute('data-id') : null;
            kotaSelect.innerHTML = '<option value="">-- Pilih Kota/Kabupaten --</option>';
            kecSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
            kelSelect.innerHTML = '<option value="">-- Pilih Kelurahan/Desa --</option>';
            $('#kota' + prefix + ', #kecamatan' + prefix + ', #kelurahan' + prefix).trigger('change.select2');

            if (pId) {
                await loadWilayah('regencies', kotaSelect, pId);
            }
            if (prefix === 'Domisili') syncKtpIfChecked();
        });

        // On City Change
        $('#kota' + prefix).on('change', async function() {
            const selectedOpt = this.options[this.selectedIndex];
            const cId = selectedOpt ? selectedOpt.getAttribute('data-id') : null;
            kecSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
            kelSelect.innerHTML = '<option value="">-- Pilih Kelurahan/Desa --</option>';
            $('#kecamatan' + prefix + ', #kelurahan' + prefix).trigger('change.select2');

            if (cId) {
                await loadWilayah('districts', kecSelect, cId);
            }
            if (prefix === 'Domisili') syncKtpIfChecked();
        });

        // On District Change
        $('#kecamatan' + prefix).on('change', async function() {
            const selectedOpt = this.options[this.selectedIndex];
            const dId = selectedOpt ? selectedOpt.getAttribute('data-id') : null;
            kelSelect.innerHTML = '<option value="">-- Pilih Kelurahan/Desa --</option>';
            $('#kelurahan' + prefix).trigger('change.select2');

            if (dId) {
                await loadWilayah('villages', kelSelect, dId);
            }
            if (prefix === 'Domisili') syncKtpIfChecked();
        });

        // On Village Change
        $('#kelurahan' + prefix).on('change', function() {
            if (prefix === 'Domisili') syncKtpIfChecked();
        });
    }

    const initialDomisili = {
        province: "{{ old('domicile_province', $customer->domicile_province ?? '') }}",
        city: "{{ old('domicile_city', $customer->domicile_city ?? '') }}",
        subdistrict: "{{ old('domicile_subdistrict', $customer->domicile_subdistrict ?? '') }}",
        village: "{{ old('domicile_village', $customer->domicile_village ?? '') }}"
    };

    const initialKTP = {
        province: "{{ old('province', $customer->province ?? '') }}",
        city: "{{ old('city', $customer->city ?? '') }}",
        subdistrict: "{{ old('subdistrict', $customer->subdistrict ?? '') }}",
        village: "{{ old('village', $customer->village ?? '') }}"
    };

    setupWilayahCascade('Domisili', initialDomisili);
    setupWilayahCascade('KTP', initialKTP);

    // 3. Sinkronisasi Alamat Domisili ke KTP
    function syncKtpIfChecked() {
        if (!$("#alamatSamaKTP").is(':checked')) return;

        const domProv = document.getElementById('provinsiDomisili');
        const domKota = document.getElementById('kotaDomisili');
        const domKec = document.getElementById('kecamatanDomisili');
        const domKel = document.getElementById('kelurahanDomisili');

        const ktpProv = document.getElementById('provinsiKTP');
        const ktpKota = document.getElementById('kotaKTP');
        const ktpKec = document.getElementById('kecamatanKTP');
        const ktpKel = document.getElementById('kelurahanKTP');

        if (domProv && ktpProv) {
            ktpProv.innerHTML = domProv.innerHTML;
            $('#provinsiKTP').val($(domProv).val()).trigger('change.select2');
        }
        if (domKota && ktpKota) {
            ktpKota.innerHTML = domKota.innerHTML;
            $('#kotaKTP').val($(domKota).val()).trigger('change.select2');
        }
        if (domKec && ktpKec) {
            ktpKec.innerHTML = domKec.innerHTML;
            $('#kecamatanKTP').val($(domKec).val()).trigger('change.select2');
        }
        if (domKel && ktpKel) {
            ktpKel.innerHTML = domKel.innerHTML;
            $('#kelurahanKTP').val($(domKel).val()).trigger('change.select2');
        }

        const rtDom = document.getElementById('rtDomisili');
        const rwDom = document.getElementById('rwDomisili');
        const posDom = document.getElementById('kodePosDomisili');
        const almtDom = document.getElementById('alamatDomisili');

        if (rtDom) document.getElementById('rtKTP').value = rtDom.value;
        if (rwDom) document.getElementById('rwKTP').value = rwDom.value;
        if (posDom) document.getElementById('kodePosKTP').value = posDom.value;
        if (almtDom) document.getElementById('alamatKTP').value = almtDom.value;
    }

    $("#alamatSamaKTP").on("change", function() {
        const isChecked = this.checked;
        const ktpSelects = ['provinsiKTP', 'kotaKTP', 'kecamatanKTP', 'kelurahanKTP'];
        const ktpInputs = ['rtKTP', 'rwKTP', 'kodePosKTP', 'alamatKTP'];

        if (isChecked) {
            syncKtpIfChecked();
            ktpSelects.forEach(id => {
                $('#' + id).prop('disabled', true).trigger('change.select2');
            });
            ktpInputs.forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    el.readOnly = true;
                    el.style.backgroundColor = '#f1f5f9';
                }
            });
        } else {
            ktpSelects.forEach(id => {
                $('#' + id).prop('disabled', false).trigger('change.select2');
            });
            ktpInputs.forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    el.readOnly = false;
                    el.style.backgroundColor = '#ffffff';
                }
            });
        }
    });

    $('#rtDomisili, #rwDomisili, #kodePosDomisili, #alamatDomisili').on('input', function() {
        syncKtpIfChecked();
    });

    // 4. Toggle Status Pekerjaan Lainnya
    $("#jobStatus").on("change", function() {
        $("#jobStatusLainnyaWrapper").toggle(this.value === "Lainnya");
    });

    // 5. Nama File Upload Preview & Visual Feedback
    $('input[type="file"]').on('change', function() {
        const box = $(this).closest('.file-upload-box');
        const labelText = $(this).data('label') || 'Dokumen';
        if (this.files && this.files[0]) {
            const file = this.files[0];
            const sizeInMb = (file.size / (1024 * 1024)).toFixed(2);
            box.addClass('has-file');
            box.find('.file-upload-icon').removeClass('mdi-cloud-upload').addClass('mdi-file-check');
            box.find('.file-name-text').html('<span class="text-success fw-bold"><i class="mdi mdi-check-circle me-1"></i>' + file.name + '</span>');
            box.find('.file-upload-hint').html('<span class="text-muted">Ukuran: ' + sizeInMb + ' MB • <i>Klik jika ingin mengganti</i></span>');

            // Deteksi KTP Customer untuk Auto-Fill jika upload langsung dari tab dokumen
            if ($(this).attr('id') === 'uploadKtp' && !window.isApplyingKtpFile && file.type.startsWith('image/')) {
                Swal.fire({
                    title: 'Pindai KTP Otomatis?',
                    text: 'Foto KTP terdeteksi! Mau mengekstrak NIK, Nama, dan Alamat secara otomatis untuk mengisi formulir customer?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#9a55ff',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="mdi mdi-text-box-search-outline me-1"></i> Ya, Scan & Auto-Fill',
                    cancelButtonText: 'Tidak, Hanya Simpan File'
                }).then((result) => {
                    if (result.isConfirmed) {
                        openKtpScannerWithFile(file);
                    }
                });
            }
        } else {
            box.removeClass('has-file');
            box.find('.file-upload-icon').removeClass('mdi-file-check').addClass('mdi-cloud-upload');
            box.find('.file-name-text').text('Klik untuk upload ' + labelText);
            box.find('.file-upload-hint').text('Format: JPG, PNG, PDF (Maks. 10MB)');
        }
    });

    // 6. Format Ribuan Rupiah untuk Input Finansial
    $('.rupiah-format').on('input', function() {
        let value = this.value.replace(/\D/g, '');
        this.value = value ? new Intl.NumberFormat('id-ID').format(value) : '';
    });

    // 7. Navigasi Tombol Lanjut & Kembali
    const btnNext = document.getElementById("btnNextGlobal");
    const btnPrev = document.getElementById("btnPrevGlobal");
    const tabLinks = document.querySelectorAll(".custom-tab-link");
    const form = document.getElementById('formCustomer');

    function updateButtonState() {
        const activeIdx = Array.from(tabLinks).findIndex(t => t.classList.contains('active'));
        btnPrev.disabled = activeIdx === 0;

        if (activeIdx === tabLinks.length - 1) {
            btnNext.innerHTML = '<span>{{ $isEdit ? "Update Customer" : "Simpan Customer" }}</span> <i class="mdi mdi-content-save"></i>';
            btnNext.type = "submit";
        } else {
            btnNext.innerHTML = '<span>Lanjut</span> <i class="mdi mdi-arrow-right"></i>';
            btnNext.type = "button";
        }
    }

    btnNext.onclick = function(e) {
        if (this.type === "submit") return;
        e.preventDefault();
        const activeIdx = Array.from(tabLinks).findIndex(t => t.classList.contains('active'));
        if (activeIdx < tabLinks.length - 1) {
            tabLinks[activeIdx + 1].click();
            updateButtonState();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    };

    btnPrev.onclick = function() {
        const activeIdx = Array.from(tabLinks).findIndex(t => t.classList.contains('active'));
        if (activeIdx > 0) {
            tabLinks[activeIdx - 1].click();
            updateButtonState();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    };

    tabLinks.forEach(t => t.addEventListener("click", () => setTimeout(updateButtonState, 10)));

    // 8. Submit AJAX dengan SweetAlert Loading
    $(form).on('submit', function(e) {
        e.preventDefault();

        let fullName = $('input[name="full_name"]').val();
        if (!fullName || fullName.trim() === '') {
            Swal.fire({ icon: 'error', title: 'Oops...', text: 'Nama lengkap wajib diisi!', confirmButtonColor: '#9a55ff' });
            return false;
        }

        Swal.fire({
            title: 'Sedang memproses...',
            html: 'Menyimpan data customer',
            allowOutsideClick: false,
            didOpen: () => { Swal.showLoading(); }
        });

        // Enable selects temporarily so FormData includes them
        const ktpSelects = ['provinsiKTP', 'kotaKTP', 'kecamatanKTP', 'kelurahanKTP'];
        ktpSelects.forEach(id => {
            const el = document.getElementById(id);
            if (el) el.disabled = false;
        });

        let formData = new FormData(this);

        if ($("#alamatSamaKTP").is(':checked')) {
            ktpSelects.forEach(id => {
                const el = document.getElementById(id);
                if (el) el.disabled = true;
            });
        }
        let actionUrl = $(this).attr('action');

        $.ajax({
            url: actionUrl,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data customer berhasil disimpan.',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = '{{ route("customer.data") }}';
                });
            },
            error: function(xhr) {
                let msg = 'Terjadi kesalahan sistem.';
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    msg = 'Periksa kembali inputan Anda:<br><ul class="text-start mt-2">';
                    $.each(errors, function(key, value) {
                        msg += '<li>' + value[0] + '</li>';
                    });
                    msg += '</ul>';
                }
                Swal.fire({ icon: 'error', title: 'Simpan Gagal', html: msg, confirmButtonColor: '#9a55ff' });
            }
        });
    });

    updateButtonState();

    // ==========================================
    // FITUR KTP OCR SCANNER & AUTO-FILL
    // ==========================================
    let ktpScannerModal = null;
    let cameraStream = null;
    let currentScannedKtpFile = null;

    function getKtpModalInstance() {
        if (!ktpScannerModal) {
            const modalEl = document.getElementById('modalKtpScanner');
            if (modalEl) {
                ktpScannerModal = new bootstrap.Modal(modalEl);
            }
        }
        return ktpScannerModal;
    }

    window.openKtpScannerWithFile = function(file) {
        const modal = getKtpModalInstance();
        if (modal) {
            modal.show();
            handleKtpFile(file);
        }
    };

    $('#btnOpenKtpScanner, #btnScanKtpTab1').on('click', function() {
        const modal = getKtpModalInstance();
        if (modal) {
            modal.show();
        }
    });

    // Dropzone Click & Change
    $('#ktpDropzone').on('click', function(e) {
        if (e.target !== document.getElementById('ktpFileInput')) {
            $('#ktpFileInput').trigger('click');
        }
    });

    $('#ktpFileInput').on('change', function() {
        if (this.files && this.files[0]) {
            handleKtpFile(this.files[0]);
        }
    });

    // Drag and Drop
    const dropzone = document.getElementById('ktpDropzone');
    if (dropzone) {
        ['dragenter', 'dragover'].forEach(eventName => {
            dropzone.addEventListener(eventName, (e) => {
                e.preventDefault();
                e.stopPropagation();
                dropzone.classList.add('dragover');
            }, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropzone.addEventListener(eventName, (e) => {
                e.preventDefault();
                e.stopPropagation();
                dropzone.classList.remove('dragover');
            }, false);
        });

        dropzone.addEventListener('drop', (e) => {
            const dt = e.dataTransfer;
            if (dt && dt.files && dt.files[0]) {
                handleKtpFile(dt.files[0]);
            }
        });
    }

    // Paste Image from Clipboard (Ctrl + V)
    document.addEventListener('paste', function(e) {
        const modalEl = document.getElementById('modalKtpScanner');
        if (modalEl && modalEl.classList.contains('show')) {
            const items = (e.clipboardData || e.originalEvent.clipboardData).items;
            for (let item of items) {
                if (item.type.indexOf('image') !== -1) {
                    const blob = item.getAsFile();
                    handleKtpFile(blob);
                    break;
                }
            }
        }
    });

    // Reset / Ganti Foto
    $('#btnResetKtpScan').on('click', function() {
        $('#ktpPreviewWrapper').hide();
        $('#ktpResultWrapper').hide();
        $('#btnApplyKtpToForm').prop('disabled', true);
        $('#ktpFileInput').val('');
        currentScannedKtpFile = null;
    });

    // Helper global pintar untuk memilih value pada dropdown (tahan case, alias, dan teks)
    function applySelectValue(selector, value) {
        if (!value) return;
        const select = typeof selector === 'string' ? document.querySelector(selector) : selector;
        if (!select || !select.options) return;

        const target = value.toString().trim().toUpperCase();

        // 1. Coba kecocokan value persis
        for (let i = 0; i < select.options.length; i++) {
            if (select.options[i].value.trim().toUpperCase() === target) {
                select.selectedIndex = i;
                $(select).trigger('change');
                return;
            }
        }

        // 2. Coba kecocokan text persis
        for (let i = 0; i < select.options.length; i++) {
            if (select.options[i].text.trim().toUpperCase() === target) {
                select.selectedIndex = i;
                $(select).trigger('change');
                return;
            }
        }

        // 3. Kecocokan cerdas berdasarkan teks, value, dan alias umum
        for (let i = 0; i < select.options.length; i++) {
            const optVal = select.options[i].value.trim().toUpperCase();
            const optText = select.options[i].text.trim().toUpperCase();
            const optCombined = optVal + ' ' + optText;

            // Jenis Kelamin: Perempuan / P / Wanita
            if ((target === 'P' || target.includes('PEREMPUAN') || target.includes('WANITA') || target.includes('FEMALE')) &&
                (optVal === 'P' || optCombined.includes('PEREMPUAN') || optCombined.includes('WANITA'))) {
                select.selectedIndex = i;
                $(select).trigger('change');
                return;
            }
            // Jenis Kelamin: Laki-laki / L / Pria
            if ((target === 'L' || target.includes('LAKI') || target.includes('PRIA') || target.includes('MALE')) &&
                (optVal === 'L' || optCombined.includes('LAKI') || optCombined.includes('PRIA'))) {
                select.selectedIndex = i;
                $(select).trigger('change');
                return;
            }

            // Agama: Islam
            if ((target.includes('ISLAM') || target.includes('1SLAM') || target.includes('ISIAM')) && optCombined.includes('ISLAM')) {
                select.selectedIndex = i;
                $(select).trigger('change');
                return;
            }
            // Agama: Kristen
            if ((target.includes('KRISTEN') || target.includes('PROTESTAN')) && optCombined.includes('KRISTEN')) {
                select.selectedIndex = i;
                $(select).trigger('change');
                return;
            }
            // Agama: Katolik
            if (target.includes('KATOLIK') && optCombined.includes('KATOLIK')) {
                select.selectedIndex = i;
                $(select).trigger('change');
                return;
            }
            // Agama: Hindu
            if (target.includes('HINDU') && optCombined.includes('HINDU')) {
                select.selectedIndex = i;
                $(select).trigger('change');
                return;
            }
            // Agama: Buddha
            if (target.includes('BUDDHA') && optCombined.includes('BUDDHA')) {
                select.selectedIndex = i;
                $(select).trigger('change');
                return;
            }

            // Status Perkawinan: BELUM KAWIN
            if ((target.includes('BELUM') || target.includes('BLM')) && optCombined.includes('BELUM')) {
                select.selectedIndex = i;
                $(select).trigger('change');
                return;
            }
            // Status Perkawinan: KAWIN / MENIKAH
            if ((target === 'KAWIN' || target === 'MENIKAH' || (!target.includes('BELUM') && (target.includes('KAWIN') || target.includes('MENIKAH')))) &&
                (optVal === 'KAWIN' || optVal === 'MENIKAH' || (!optCombined.includes('BELUM') && (optCombined.includes('KAWIN') || optCombined.includes('MENIKAH'))))) {
                select.selectedIndex = i;
                $(select).trigger('change');
                return;
            }
            // Status Perkawinan: CERAI MATI
            if (target.includes('MATI') && optCombined.includes('MATI')) {
                select.selectedIndex = i;
                $(select).trigger('change');
                return;
            }
            // Status Perkawinan: CERAI HIDUP / CERAI
            if (target.includes('CERAI') && !target.includes('MATI') && (optCombined.includes('CERAI HIDUP') || optCombined.includes('CERAI'))) {
                select.selectedIndex = i;
                $(select).trigger('change');
                return;
            }
        }
    }

    // Handle KTP File Selection
    function handleKtpFile(file) {
        if (!file || !file.type.startsWith('image/')) {
            Swal.fire({
                icon: 'warning',
                title: 'Format Tidak Sesuai',
                text: 'Harap pilih file gambar (JPG, PNG, atau WEBP).'
            });
            return;
        }

        currentScannedKtpFile = file;

        const reader = new FileReader();
        reader.onload = function(e) {
            const previewImg = document.getElementById('ktpImagePreview');
            $('#ktpPreviewWrapper').show();
            $('#ktpResultWrapper').hide();
            $('#btnApplyKtpToForm').prop('disabled', true);

            let triggered = false;
            function runOcr() {
                if (triggered) return;
                triggered = true;
                processKtpOcr(previewImg, file);
            }

            previewImg.onload = runOcr;
            previewImg.src = e.target.result;

            // Fallback jika gambar sudah selesai ter-render secara sinkron
            if (previewImg.complete && previewImg.naturalWidth > 0) {
                runOcr();
            }
        };
        reader.readAsDataURL(file);
    }

    // Kamera Handlers
    $('#btnStartCamera').on('click', async function() {
        try {
            cameraStream = await navigator.mediaDevices.getUserMedia({
                video: { facingMode: 'environment', width: { ideal: 1280 }, height: { ideal: 720 } }
            });
            const video = document.getElementById('ktpCameraVideo');
            video.srcObject = cameraStream;
            $('#ktpCameraOverlay').show();
            $('#btnCaptureCamera').prop('disabled', false);
            $('#btnStopCamera').show();
            $(this).hide();
        } catch (err) {
            console.error('Error camera:', err);
            Swal.fire({
                icon: 'error',
                title: 'Akses Kamera Gagal',
                text: 'Tidak dapat membuka kamera. Pastikan izin kamera aktif pada browser Anda.'
            });
        }
    });

    function stopCamera() {
        if (cameraStream) {
            cameraStream.getTracks().forEach(track => track.stop());
            cameraStream = null;
            const video = document.getElementById('ktpCameraVideo');
            if (video) video.srcObject = null;
        }
        $('#ktpCameraOverlay').hide();
        $('#btnCaptureCamera').prop('disabled', true);
        $('#btnStopCamera').hide();
        $('#btnStartCamera').show();
    }

    $('#btnStopCamera').on('click', stopCamera);

    // Ambil Snapshot dari Kamera
    $('#btnCaptureCamera').on('click', function() {
        const video = document.getElementById('ktpCameraVideo');
        if (!video || !video.videoWidth) return;

        const canvas = document.createElement('canvas');
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        const ctx = canvas.getContext('2d');
        ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

        stopCamera();

        canvas.toBlob(function(blob) {
            const file = new File([blob], 'ktp_capture_' + Date.now() + '.jpg', { type: 'image/jpeg' });
            // Switch kembali ke tab preview upload
            $('#tab-upload-btn').tab('show');
            handleKtpFile(file);
        }, 'image/jpeg', 0.95);
    });

    // Hentikan kamera saat modal ditutup
    $('#modalKtpScanner').on('hidden.bs.modal', function() {
        stopCamera();
    });

    // Pra-pemrosesan Gambar (Grayscale & Contrast Boost) untuk meningkatkan akurasi OCR
    function preprocessImageForOcr(imgEl) {
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');

        let width = imgEl.naturalWidth || imgEl.width;
        let height = imgEl.naturalHeight || imgEl.height;

        // Normalisasi ukuran gambar ideal OCR
        if (width > 1600) {
            height = Math.round((height * 1600) / width);
            width = 1600;
        } else if (width < 800) {
            height = Math.round((height * 1000) / width);
            width = 1000;
        }

        canvas.width = width;
        canvas.height = height;
        ctx.drawImage(imgEl, 0, 0, width, height);

        const imgData = ctx.getImageData(0, 0, width, height);
        const data = imgData.data;

        // Grayscale dan reduksi noise pola biru KTP
        for (let i = 0; i < data.length; i += 4) {
            const r = data[i];
            const g = data[i + 1];
            const b = data[i + 2];

            // Luminance
            let gray = 0.299 * r + 0.587 * g + 0.114 * b;

            // Jika background KTP kebiruan, buat lebih terang agar teks hitam kontras
            if (b > 130 && r < 120 && g < 130) {
                gray = Math.min(255, gray + 45);
            }

            // Contrast stretch
            const contrast = 1.35;
            gray = contrast * (gray - 128) + 128;
            gray = Math.max(0, Math.min(255, gray));

            data[i] = gray;
            data[i + 1] = gray;
            data[i + 2] = gray;
        }

        ctx.putImageData(imgData, 0, 0);
        return canvas.toDataURL('image/jpeg', 0.92);
    }

    // Eksekusi Tesseract.js OCR
    async function processKtpOcr(imgEl, file) {
        $('#ktpScanline').show();
        $('#ktpOcrProgressWrapper').show();
        $('#ktpOcrPercent').text('5%');
        $('#ktpOcrProgressBar').css('width', '5%');
        $('#ktpOcrStatusText').html('<span class="spinner-border spinner-border-sm me-1"></span>Mempersiapkan mesin OCR...');

        try {
            if (typeof Tesseract === 'undefined') {
                throw new Error('Pustaka Tesseract OCR belum terhubung.');
            }

            const processedDataUrl = preprocessImageForOcr(imgEl);

            // Inisialisasi Tesseract Worker
            const worker = await Tesseract.createWorker('ind', 1, {
                logger: m => {
                    if (m.status === 'recognizing text') {
                        const pct = Math.round(m.progress * 100);
                        $('#ktpOcrPercent').text(pct + '%');
                        $('#ktpOcrProgressBar').css('width', pct + '%');
                        $('#ktpOcrStatusText').html('<span class="spinner-border spinner-border-sm me-1"></span>Membaca teks KTP: ' + pct + '%');
                    } else if (m.status === 'loading tesseract core') {
                        $('#ktpOcrStatusText').html('<span class="spinner-border spinner-border-sm me-1"></span>Memuat modul OCR...');
                    } else if (m.status === 'loading language traineddata') {
                        $('#ktpOcrStatusText').html('<span class="spinner-border spinner-border-sm me-1"></span>Memuat bahasa Indonesia...');
                    }
                }
            });

            const ret = await worker.recognize(processedDataUrl);
            await worker.terminate();

            $('#ktpScanline').hide();
            $('#ktpOcrProgressBar').css('width', '100%');
            $('#ktpOcrPercent').text('100%');
            $('#ktpOcrStatusText').html('<i class="mdi mdi-check-circle text-success me-1"></i>Ekstraksi teks selesai!');

            const rawText = ret.data.text || '';
            const parsedData = parseKtpText(rawText);

            // Isi nilai hasil ekstraksi ke form verifikasi modal
            $('#ocr_nik').val(parsedData.nik);
            $('#ocr_full_name').val(parsedData.full_name);
            $('#ocr_birthplace').val(parsedData.birthplace);
            $('#ocr_date_birth').val(parsedData.date_birth);

            applySelectValue('#ocr_gender', parsedData.gender);
            applySelectValue('#ocr_religion', parsedData.religion);
            applySelectValue('#ocr_marital_status', parsedData.marital_status);

            $('#ocr_address').val(parsedData.address);
            $('#ocr_rt').val(parsedData.rt);
            $('#ocr_rw').val(parsedData.rw);
            $('#ocr_village').val(parsedData.village);
            $('#ocr_subdistrict').val(parsedData.subdistrict);
            $('#ocr_city').val(parsedData.city);
            $('#ocr_province').val(parsedData.province);
            $('#ocr_raw_text').val(rawText);

            $('#ktpResultWrapper').slideDown();
            $('#btnApplyKtpToForm').prop('disabled', false);

        } catch (err) {
            console.error('OCR Error:', err);
            $('#ktpScanline').hide();
            $('#ktpOcrStatusText').html('<span class="text-danger"><i class="mdi mdi-alert-circle me-1"></i>Gagal memproses gambar.</span>');

            Swal.fire({
                icon: 'warning',
                title: 'Pembacaan Otomatis Kurang Maksimal',
                text: 'Kualitas foto mungkin kurang jelas atau jaringan lambat. Anda tetap dapat memasukkan data secara manual atau mencoba foto KTP yang lebih terang.'
            });

            // Tampilkan form verifikasi kosong agar user tetap bisa mengisi
            $('#ktpResultWrapper').slideDown();
            $('#btnApplyKtpToForm').prop('disabled', false);
        }
    }

    // Heuristik & Regex Parser e-KTP Indonesia
    function parseKtpText(raw) {
        const result = {
            nik: '',
            full_name: '',
            birthplace: '',
            date_birth: '',
            gender: '',
            religion: '',
            marital_status: '',
            address: '',
            rt: '',
            rw: '',
            village: '',
            subdistrict: '',
            city: '',
            province: ''
        };

        if (!raw) return result;

        const lines = raw.split('\n').map(l => l.trim()).filter(Boolean);

        // Teks ternormalisasi untuk menangani typo karakter OCR (1->I, 0->O, !->I)
        const norm = raw.replace(/[1!|]/g, 'I')
                        .replace(/0/g, 'O')
                        .replace(/5/g, 'S')
                        .toUpperCase();

        // 1. Ekstraksi NIK (16 Digit)
        for (let line of lines) {
            if (/N[I1l!|][Kk]/i.test(line)) {
                let cleaned = line.replace(/N[I1l!|][Kk]/i, '')
                                  .replace(/[oO]/g, '0')
                                  .replace(/[lI|]/g, '1')
                                  .replace(/[bB]/g, '8')
                                  .replace(/[sS]/g, '5')
                                  .replace(/[^0-9]/g, '');
                if (cleaned.length >= 16) {
                    result.nik = cleaned.substring(0, 16);
                    break;
                }
            }
        }
        if (!result.nik) {
            const digitCleaned = raw.replace(/[oO]/g, '0').replace(/[lI|]/g, '1');
            const nikMatch = digitCleaned.match(/\b([1-9][0-9]{15})\b/);
            if (nikMatch) result.nik = nikMatch[1];
        }

        // 2. Provinsi & Kota/Kabupaten
        for (let i = 0; i < lines.length; i++) {
            const line = lines[i];
            if (/PROVINSI/i.test(line)) {
                result.province = line.replace(/PROVINSI/i, '').replace(/[:;.-]/g, '').trim().toUpperCase();
                // Baris tepat di bawah PROVINSI biasanya KOTA/KABUPATEN (misal JAKARTA BARAT)
                if (i + 1 < lines.length && !result.city) {
                    const nextLine = lines[i + 1].trim();
                    if (!/NIK|N[I1l!|][Kk]/i.test(nextLine) && nextLine.length > 3) {
                        result.city = nextLine.replace(/KOTA|KABUPATEN|KAB\.?|ADM\.?/gi, '').replace(/[:;.-]/g, '').trim().toUpperCase();
                    }
                }
            }
            if (/KABUPATEN|KOTA/i.test(line) && !/PROVINSI/i.test(line)) {
                result.city = line.replace(/KABUPATEN|KOTA|KAB\.?|ADM\.?/gi, '').replace(/[:;.-]/g, '').trim().toUpperCase();
            }
        }

        // Helper cari baris setelah label
        function getAfter(regex) {
            for (let line of lines) {
                const m = line.match(regex);
                if (m && m[1]) return m[1].replace(/^[:;.-]+/, '').trim();
            }
            return '';
        }

        // 3. Nama
        let rawName = getAfter(/(?:Nama|Name)\s*[:;]?\s*(.+)/i);
        if (rawName) {
            rawName = rawName.replace(/\b(Tempat|Tgl|Lahir|Jenis|Kelamin|Alamat|Agama)\b.*/i, '')
                             .replace(/[^A-Za-z\s.'`]/g, '')
                             .trim();
            result.full_name = rawName.toUpperCase();
        } else {
            // Jika label Nama tidak terdeteksi, ambil baris di bawah NIK
            for (let i = 0; i < lines.length; i++) {
                if (/N[I1l!|][Kk]/i.test(lines[i]) || (result.nik && lines[i].includes(result.nik))) {
                    if (i + 1 < lines.length) {
                        let candidate = lines[i + 1].replace(/^[:;.-]+/, '').trim();
                        if (/^[A-Za-z\s.'`]+$/.test(candidate) && candidate.length > 3 && !/tempat|lahir/i.test(candidate)) {
                            result.full_name = candidate.toUpperCase();
                        }
                    }
                    break;
                }
            }
        }

        // 4. Tempat / Tanggal Lahir
        for (let line of lines) {
            if (/Tempat|Tgl\s*Lahir|Lahir|TG[Ll1I|]/i.test(line)) {
                let cleaned = line.replace(/Tempat\s*[\/|\\]?\s*TG[Ll1I|]?\s*Lahir/gi, '')
                                  .replace(/Tempat\s*[\/|\\]?\s*TG[Ll1I|]?/gi, '')
                                  .replace(/Tempat|Lahir/gi, '')
                                  .replace(/^[:;.-]+/, '')
                                  .trim();
                const dateMatch = cleaned.match(/(\d{1,2})[\s\/-]+(\d{1,2})[\s\/-]+(\d{4})/);
                if (dateMatch) {
                    const d = dateMatch[1].padStart(2, '0');
                    const m = dateMatch[2].padStart(2, '0');
                    const y = dateMatch[3];
                    result.date_birth = `${y}-${m}-${d}`;

                    let place = cleaned.substring(0, dateMatch.index)
                                       .replace(/TEMPAT\s*[\/|\\]?\s*TG[Ll1I|]?\s*LAHIR/gi, '')
                                       .replace(/TEMPAT\s*[\/|\\]?\s*TG[Ll1I|]?/gi, '')
                                       .replace(/TG[Ll1I|]?\s*LAHIR/gi, '')
                                       .replace(/TEMPAT/gi, '')
                                       .replace(/LAHIR/gi, '')
                                       .replace(/[^A-Za-z\s]/g, '')
                                       .replace(/\s+/g, ' ')
                                       .trim();
                    if (place) result.birthplace = place.toUpperCase();
                } else {
                    const parts = cleaned.split(/[,:]/);
                    if (parts.length > 0 && parts[0].length > 2) {
                        result.birthplace = parts[0].replace(/TEMPAT\s*[\/|\\]?\s*TG[Ll1I|]?/gi, '').replace(/[^A-Za-z\s]/g, '').trim().toUpperCase();
                    }
                }
                break;
            }
        }

        // 5. Jenis Kelamin
        let rawGender = getAfter(/(?:Jenis\s*Kelamin|Kelamin|Jns\s*Kelamin)\s*[:;.]?\s*(.+)/i);
        const genderSearch = (rawGender + ' ' + raw + ' ' + norm).toUpperCase();

        if (/PEREMPUAN|PERENPUAN|PFREMPUAN|PFRFMPUAN|WANITA|FEMALE/i.test(genderSearch) || /\bPER\b/i.test(rawGender) || /PEREMPUAN|WANITA/i.test(raw)) {
            result.gender = 'P';
        } else if (/LAKI\s*[-–]\s*LAKI|LAKILAKI|LAKHLAKI|LAK1\s*[-–]\s*LAK1|PRIA|MALE/i.test(genderSearch) || /\bLAK\b/i.test(rawGender) || /LAKI/i.test(raw)) {
            result.gender = 'L';
        }

        // 6. Alamat
        let rawAlamat = getAfter(/Alamat\s*[:;]?\s*(.+)/i);
        if (rawAlamat) {
            result.address = rawAlamat.replace(/\b(RT|RW|Kel|Desa|Kecamatan)\b.*/i, '').trim();
        }

        // 7. RT / RW
        const rtrw = raw.match(/RT\s*\/?\s*RW\s*[:;]?\s*(\d{1,3})\s*[\/-]\s*(\d{1,3})/i) ||
                     raw.match(/(\d{1,3})\s*\/\s*(\d{1,3})/);
        if (rtrw) {
            result.rt = rtrw[1].padStart(3, '0');
            result.rw = rtrw[2].padStart(3, '0');
        }

        // 8. Kelurahan / Desa
        let rawKel = getAfter(/(?:Kel\/?Desa|Kelurahan|Desa)\s*[:;]?\s*(.+)/i);
        if (rawKel) {
            result.village = rawKel.replace(/\b(Kecamatan|Agama)\b.*/i, '').replace(/[^A-Za-z0-9\s.-]/g, '').trim().toUpperCase();
        }

        // 9. Kecamatan
        let rawKec = getAfter(/(?:Kecamatan|Kec)\s*[:;]?\s*(.+)/i);
        if (rawKec) {
            result.subdistrict = rawKec.replace(/\b(Agama|Status)\b.*/i, '').replace(/[^A-Za-z0-9\s.-]/g, '').trim().toUpperCase();
        }

        // 10. Agama
        let rawAgama = getAfter(/(?:Agama|Agm|Agma)\s*[:;.]?\s*(.+)/i);
        const agamaSearch = (rawAgama + ' ' + raw + ' ' + norm).toUpperCase();

        if (/ISLAM|1SLAM|!SLAM|ISIAM|1S1AM/i.test(agamaSearch) || /ISLAM/i.test(raw)) {
            result.religion = 'Islam';
        } else if (/KRISTEN|KR1STEN|PROTESTAN|PROT/i.test(agamaSearch) || /KRISTEN/i.test(raw)) {
            result.religion = 'Kristen';
        } else if (/KATOLIK|KATHOLIK|KAT0L1K/i.test(agamaSearch) || /KATOLIK/i.test(raw)) {
            result.religion = 'Katolik';
        } else if (/HINDU|H1NDU/i.test(agamaSearch) || /HINDU/i.test(raw)) {
            result.religion = 'Hindu';
        } else if (/BUDDHA|BUDHA/i.test(agamaSearch) || /BUDDHA/i.test(raw)) {
            result.religion = 'Buddha';
        } else if (/KONGHUCU|KHONGHUCU/i.test(agamaSearch) || /KONGHUCU/i.test(raw)) {
            result.religion = 'Lainnya';
        }

        // 11. Status Perkawinan (Sesuai Standar e-KTP: BELUM KAWIN, KAWIN, CERAI HIDUP, CERAI MATI)
        let rawStatus = getAfter(/(?:Status\s*Perkawinan|Status\s*Pernikahan|Perkawinan|Status)\s*[:;.]?\s*(.+)/i);
        const statusSearch = (rawStatus + ' ' + raw + ' ' + norm).toUpperCase();

        if (/BELUM\s*KAWIN|BELUM\s*MENIKAH|BFLUM\s*KAWIN|BLM\s*KAWIN|BELUMKAWIN/i.test(statusSearch) || /BELUM\s*KAWIN|BELUM\s*MENIKAH/i.test(raw)) {
            result.marital_status = 'BELUM KAWIN';
        } else if (/CERAI\s*MATI|CERAI\s*MTI/i.test(statusSearch) || /CERAI\s*MATI/i.test(raw)) {
            result.marital_status = 'CERAI MATI';
        } else if (/CERAI\s*HIDUP|CERAI\s*H1DUP|\bCERAI\b/i.test(statusSearch) || /CERAI\s*HIDUP|CERAI/i.test(raw)) {
            result.marital_status = 'CERAI HIDUP';
        } else if (/KAWIN|KAW1N|KAW\s*IN|MENIKAH|KANIN/i.test(statusSearch) || /KAWIN|MENIKAH/i.test(raw)) {
            result.marital_status = 'KAWIN';
        }

        return result;
    }

    // Terapkan Data Hasil Scan ke Formulir Customer
    $('#btnApplyKtpToForm').on('click', function() {
        // 1. Data Pribadi
        const fullName = $('#ocr_full_name').val().trim();
        const nik = $('#ocr_nik').val().trim();
        const birthplace = $('#ocr_birthplace').val().trim();
        const dateBirth = $('#ocr_date_birth').val();
        const gender = $('#ocr_gender').val();
        const religion = $('#ocr_religion').val();
        const maritalStatus = $('#ocr_marital_status').val();

        if (fullName) $('input[name="full_name"]').val(fullName);
        if (nik) $('input[name="nik"]').val(nik);
        if (birthplace) $('input[name="birthplace"]').val(birthplace);
        if (dateBirth) {
            $('input[name="date_birth"]').val(dateBirth).trigger('change'); // Otomatis hitung usia
        }
        if (gender) applySelectValue('select[name="gender"]', gender);
        if (religion) applySelectValue('select[name="religion"]', religion);
        if (maritalStatus) applySelectValue('select[name="marital_status"]', maritalStatus);

        // 2. Alamat Sesuai KTP
        const address = $('#ocr_address').val().trim();
        const rt = $('#ocr_rt').val().trim();
        const rw = $('#ocr_rw').val().trim();
        const province = $('#ocr_province').val().trim();
        const city = $('#ocr_city').val().trim();
        const subdistrict = $('#ocr_subdistrict').val().trim();
        const village = $('#ocr_village').val().trim();

        if (address) $('#alamatKTP').val(address);
        if (rt) $('#rtKTP').val(rt);
        if (rw) $('#rwKTP').val(rw);

        // Jika alamat wilayah terbaca, sinkronkan dropdown cascade KTP
        if (province || city || subdistrict || village) {
            setupWilayahCascade('KTP', {
                province: province,
                city: city,
                subdistrict: subdistrict,
                village: village
            });
        }

        // 3. Pasang file KTP ke input uploadKtp di Tab Dokumen
        if (currentScannedKtpFile) {
            window.isApplyingKtpFile = true;
            try {
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(currentScannedKtpFile);
                const uploadKtpInput = document.getElementById('uploadKtp');
                if (uploadKtpInput) {
                    uploadKtpInput.files = dataTransfer.files;
                    $(uploadKtpInput).trigger('change');
                }
            } catch (e) {
                console.warn('DataTransfer not supported:', e);
            }
            window.isApplyingKtpFile = false;
        }

        // 4. Arahkan kembali ke Tab 1 (Data Pribadi) agar user melihat hasil input
        $('.custom-tab-link[href="#pribadi"]').trigger('click');

        // 5. Tutup Modal
        const modal = getKtpModalInstance();
        if (modal) modal.hide();

        Swal.fire({
            icon: 'success',
            title: 'Data KTP Berhasil Diisi!',
            html: 'Data NIK, Nama, Tanggal Lahir, Alamat, dan File KTP telah diterapkan ke formulir customer.',
            timer: 2500,
            showConfirmButton: false
        });
    });
});
</script>
<script src="https://cdn.jsdelivr.net/npm/tesseract.js@5/dist/tesseract.min.js"></script>
@endpush
