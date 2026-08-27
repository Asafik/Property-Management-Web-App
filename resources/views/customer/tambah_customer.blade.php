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
                <div class="card-header bg-white d-flex justify-content-between align-items-center p-3 border-bottom">
                    <h5 class="card-title mb-0 fw-bold">
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
                                        <label class="form-label">Status Pernikahan</label>
                                        <select class="form-control" name="marital_status">
                                            <option value="">-- Pilih Status --</option>
                                            @foreach(['Belum Menikah', 'Menikah', 'Cerai'] as $st)
                                                <option value="{{ $st }}" {{ old('marital_status', $customer->marital_status ?? '') == $st ? 'selected' : '' }}>{{ $st }}</option>
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
});
</script>
@endpush
