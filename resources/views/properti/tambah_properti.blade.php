@extends('layouts.partial.app')

@section('title', 'Tambah Pasca Land Bank - Property Management App')

@push('styles')
<style>
/* ===== 1. STYLING CHECKBOX FASILITAS MODERN ===== */
.custom-checkbox-wrapper {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
}

.custom-checkbox-card {
    position: relative;
    cursor: pointer;
    user-select: none;
    flex: 1 1 calc(25% - 0.75rem);
    min-width: 140px;
    margin: 0;
}

.custom-checkbox-card input[type="checkbox"] {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
}

.custom-checkbox-card .checkbox-card-inner {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 0.75rem 1rem;
    background: #ffffff;
    border: 2px solid #e9ecef;
    border-radius: 12px;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 2px 6px rgba(0,0,0,0.02);
}

.custom-checkbox-card:hover .checkbox-card-inner {
    border-color: #da8cff;
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(154, 85, 255, 0.12);
}

.custom-checkbox-card .check-icon {
    font-size: 1.35rem;
    color: #6c757d;
    transition: all 0.25s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.custom-checkbox-card .check-text {
    font-size: 0.85rem;
    font-weight: 600;
    color: #2c2e3f;
    transition: all 0.25s ease;
}

.custom-checkbox-card input[type="checkbox"]:checked + .checkbox-card-inner {
    border-color: #9a55ff;
    background: linear-gradient(135deg, #f9f5ff, #f2e9ff);
    box-shadow: 0 4px 15px rgba(154, 85, 255, 0.2);
}

.custom-checkbox-card input[type="checkbox"]:checked + .checkbox-card-inner .check-icon {
    color: #9a55ff;
    transform: scale(1.15);
}

.custom-checkbox-card input[type="checkbox"]:checked + .checkbox-card-inner .check-text {
    color: #7a30e8;
    font-weight: 700;
}

/* ===== 2. STYLING UPLOAD DOKUMEN MODERN ===== */
.upload-card-box {
    position: relative;
    border: 2px dashed #d9dce2;
    border-radius: 12px;
    padding: 1rem 0.85rem;
    background: #fafbfc;
    text-align: center;
    transition: all 0.3s ease;
    cursor: pointer;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 110px;
}

.upload-card-box:hover {
    border-color: #9a55ff;
    background: #fbf9ff;
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(154, 85, 255, 0.1);
}

.upload-card-box input[type="file"] {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
    z-index: 5;
}

.upload-card-box .upload-icon-circle {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: rgba(154, 85, 255, 0.1);
    color: #9a55ff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.4rem;
    margin-bottom: 8px;
    transition: all 0.3s ease;
}

.upload-card-box:hover .upload-icon-circle {
    background: linear-gradient(135deg, #da8cff, #9a55ff);
    color: #ffffff;
    transform: scale(1.1);
}

.upload-card-box .upload-title-text {
    font-size: 0.83rem;
    font-weight: 700;
    color: #2c2e3f;
    word-break: break-word;
    margin-bottom: 2px;
}

.upload-card-box .upload-format-hint {
    font-size: 0.72rem;
    color: #8c93a0;
}

.upload-card-box .upload-size-badge {
    font-size: 0.72rem;
    font-weight: 700;
    color: #9a55ff;
    background: rgba(154, 85, 255, 0.12);
    padding: 2px 10px;
    border-radius: 20px;
    margin-top: 6px;
    display: none;
}

/* ===== 3. STYLING PETA GOOGLE MAP ===== */
.map-outer-card {
    border-radius: 14px;
    overflow: hidden;
    border: 1px solid #e9ecef;
    box-shadow: 0 6px 20px rgba(0,0,0,0.06);
    position: relative;
}

#map {
    height: 380px;
    width: 100%;
    z-index: 1;
}

.leaflet-container {
    height: 380px !important;
    width: 100% !important;
    max-width: 100% !important;
}

.leaflet-pane img,
.leaflet-tile,
.leaflet-marker-icon,
.leaflet-marker-shadow,
.leaflet-tile-container img {
    max-width: none !important;
    max-height: none !important;
}

.leaflet-control-layers {
    border-radius: 10px !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.15) !important;
    border: none !important;
    font-family: 'Nunito', sans-serif !important;
    font-weight: 600 !important;
    padding: 6px 10px !important;
}
</style>
@endpush

@section('content')

<div class="container-fluid px-1 px-sm-2 px-md-3 py-2 py-md-3">

    <!-- Header Card Banner -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 header-card">
                <div class="card-body p-4 p-md-4 py-4 py-md-4 d-flex flex-wrap justify-content-between align-items-center gap-3" style="min-height: 105px;">
                    <div>
                        <h3 class="text-dark mb-1 fw-bold" style="font-size: 1.35rem;">
                            Tambah Pasca Land Bank
                        </h3>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">
                            Inisialisasi dan lengkapi data tanah pasca akuisisi untuk pengembangan proyek baru
                        </p>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <a href="{{ route('properti-all') }}" class="btn btn-sm btn-gradient-secondary d-flex align-items-center gap-1 btn-back shadow-sm px-3 py-2">
                            <i class="mdi mdi-arrow-left" style="font-size: 1rem;"></i>
                            <span>Kembali</span>
                        </a>
                        <div class="d-none d-md-block pe-2">
                            <i class="mdi mdi-home-plus" style="font-size: 3rem; color: #9a55ff; opacity: 0.25;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Tambah Properti -->
    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-file-document-edit-outline me-2"></i>Formulir Data Properti Pasca Land Bank
                    </h5>
                    <span class="badge bg-light text-muted border px-2 py-1" style="font-size: 0.75rem;">
                        <span class="text-danger">*</span> Wajib Diisi
                    </span>
                </div>

                <div class="card-body p-3 p-md-4">
                    {{-- Alert Session --}}
                    @if (session('success'))
                        <div class="alert alert-success border-0 shadow-sm d-flex align-items-center gap-2 mb-4 py-2 px-3" style="border-radius: 8px;">
                            <i class="mdi mdi-check-circle" style="font-size: 1.25rem;"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger border-0 shadow-sm mb-4 py-2 px-3" style="border-radius: 8px;">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <i class="mdi mdi-alert-circle" style="font-size: 1.25rem;"></i>
                                <span class="fw-bold">Terdapat kesalahan pengisian data:</span>
                            </div>
                            <ul class="mb-0 ps-3 small">
                                @foreach ($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('properti.store') }}" method="POST" enctype="multipart/form-data" class="main-form">
                        @csrf

                        <!-- Alert info -->
                        <div class="alert alert-info border-0 shadow-sm d-flex align-items-center gap-2 mb-4 py-2 px-3" style="background: rgba(154, 85, 255, 0.08); border-left: 4px solid #9a55ff !important; border-radius: 8px;">
                            <i class="mdi mdi-information-outline text-primary" style="font-size: 1.25rem;"></i>
                            <span class="text-dark" style="font-size: 0.85rem;">
                                Setelah menyimpan data properti ini, Anda dapat melanjutkan ke tahapan verifikasi legalitas dokumen serta pembagian blok/kavling unit.
                            </span>
                        </div>

                        {{-- ================= 1. INFORMASI DASAR TANAH ================= --}}
                        <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom">
                            <span class="badge bg-primary bg-opacity-10 text-primary p-2 rounded-3">
                                <i class="mdi mdi-home-city" style="font-size: 1.1rem;"></i>
                            </span>
                            <h6 class="fw-bold text-dark mb-0">1. Informasi Dasar Tanah</h6>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">
                                    Nama Tanah / Proyek <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="namaTanah" class="form-control @error('namaTanah') is-invalid @enderror"
                                    placeholder="Contoh: Green Harmony Residence Tahap 2"
                                    value="{{ old('namaTanah') }}" required>
                                @error('namaTanah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">
                                    Nama Perusahaan (PT) <span class="text-danger">*</span>
                                </label>
                                <select name="company_profile_id" id="companySelect" class="form-control @error('company_profile_id') is-invalid @enderror" required>
                                    <option value="">-- Pilih Perusahaan (PT) --</option>
                                    @foreach ($companies as $company)
                                        <option value="{{ $company->id }}" {{ old('company_profile_id') == $company->id ? 'selected' : '' }}>
                                            {{ $company->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('company_profile_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">
                                    Status Kepemilikan <span class="text-danger">*</span>
                                </label>
                                <select name="statusKepemilikan" class="form-control @error('statusKepemilikan') is-invalid @enderror" required>
                                    <option value="">-- Pilih Status Kepemilikan --</option>
                                    <option value="SHM" {{ old('statusKepemilikan') == 'SHM' ? 'selected' : '' }}>SHM (Sertifikat Hak Milik)</option>
                                    <option value="HGB" {{ old('statusKepemilikan') == 'HGB' ? 'selected' : '' }}>HGB (Hak Guna Bangunan)</option>
                                    <option value="HGU" {{ old('statusKepemilikan') == 'HGU' ? 'selected' : '' }}>HGU (Hak Guna Usaha)</option>
                                    <option value="HP" {{ old('statusKepemilikan') == 'HP' ? 'selected' : '' }}>HP (Hak Pakai)</option>
                                </select>
                                @error('statusKepemilikan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">
                                    Alamat Lengkap <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror"
                                    value="{{ old('lokasi') }}" placeholder="Contoh: Jl. Raya Kaliurang Km 9.5" required>
                                @error('lokasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-sm-6 col-md-3">
                                <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">Kelurahan / Desa</label>
                                <input type="text" name="kelurahan" class="form-control" value="{{ old('kelurahan') }}" placeholder="Nama Kelurahan">
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">Kecamatan</label>
                                <input type="text" name="kecamatan" class="form-control" value="{{ old('kecamatan') }}" placeholder="Nama Kecamatan">
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">Kota / Kabupaten</label>
                                <input type="text" name="kota" class="form-control" value="{{ old('kota') }}" placeholder="Nama Kota/Kabupaten">
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">Provinsi</label>
                                <input type="text" name="provinsi" class="form-control" value="{{ old('provinsi') }}" placeholder="Nama Provinsi">
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-sm-6 col-md-3">
                                <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">
                                    Luas Tanah (m²) <span class="text-danger">*</span>
                                </label>
                                <input type="number" name="luasTanah" class="form-control @error('luasTanah') is-invalid @enderror"
                                    value="{{ old('luasTanah') }}" min="0" step="0.01" placeholder="Contoh: 15000" required>
                                @error('luasTanah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-6 col-md-3">
                                <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">
                                    Harga Perolehan <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted fw-semibold">Rp</span>
                                    <input type="text" name="hargaPerolehan" class="form-control @error('hargaPerolehan') is-invalid @enderror"
                                        value="{{ old('hargaPerolehan') }}" placeholder="1.500.000.000" required>
                                </div>
                                @error('hargaPerolehan')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-6 col-md-3">
                                <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">
                                    Tanggal Perolehan <span class="text-danger">*</span>
                                </label>
                                <input type="date" name="tanggalPerolehan" class="form-control @error('tanggalPerolehan') is-invalid @enderror"
                                    value="{{ old('tanggalPerolehan') }}" required>
                                @error('tanggalPerolehan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-6 col-md-3">
                                <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">Kode Pos</label>
                                <input type="text" name="kodePos" class="form-control" value="{{ old('kodePos') }}" placeholder="55581">
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">Zonasi</label>
                                <input type="text" name="zonasi" class="form-control" value="{{ old('zonasi') }}" placeholder="Contoh: Perumahan / Komersial">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">Lebar Jalan Utama (m)</label>
                                <input type="number" name="lebarJalan" class="form-control" value="{{ old('lebarJalan') }}" step="0.1" min="0" placeholder="Contoh: 8.5">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">Jenis Permukaan Jalan</label>
                                <select name="jenisJalan" class="form-control">
                                    <option value="">-- Pilih Jenis Jalan --</option>
                                    <option value="Aspal" {{ old('jenisJalan') == 'Aspal' ? 'selected' : '' }}>Aspal Hotmix</option>
                                    <option value="Paving Blok" {{ old('jenisJalan') == 'Paving Blok' ? 'selected' : '' }}>Paving Blok</option>
                                    <option value="Cor Beton" {{ old('jenisJalan') == 'Cor Beton' ? 'selected' : '' }}>Cor Beton (Rabat)</option>
                                    <option value="Tanah" {{ old('jenisJalan') == 'Tanah' ? 'selected' : '' }}>Tanah / Pengerasan</option>
                                </select>
                            </div>
                        </div>

                        <!-- 1. STYLING CHECKBOX FASILITAS SEKITAR -->
                        <div class="mb-3">
                            <label class="form-label fw-bold text-dark d-block mb-2" style="font-size: 0.85rem;">Fasilitas di Sekitar Lokasi</label>
                            <div class="custom-checkbox-wrapper">
                                <label class="custom-checkbox-card" for="fasSekolah">
                                    <input type="checkbox" name="fasSekolah" id="fasSekolah" value="1" {{ old('fasSekolah') ? 'checked' : '' }}>
                                    <div class="checkbox-card-inner">
                                        <i class="mdi mdi-school check-icon"></i>
                                        <span class="check-text">Dekat Sekolah</span>
                                    </div>
                                </label>

                                <label class="custom-checkbox-card" for="fasRumahSakit">
                                    <input type="checkbox" name="fasRumahSakit" id="fasRumahSakit" value="1" {{ old('fasRumahSakit') ? 'checked' : '' }}>
                                    <div class="checkbox-card-inner">
                                        <i class="mdi mdi-hospital-building check-icon"></i>
                                        <span class="check-text">Rumah Sakit</span>
                                    </div>
                                </label>

                                <label class="custom-checkbox-card" for="fasMall">
                                    <input type="checkbox" name="fasMall" id="fasMall" value="1" {{ old('fasMall') ? 'checked' : '' }}>
                                    <div class="checkbox-card-inner">
                                        <i class="mdi mdi-shopping check-icon"></i>
                                        <span class="check-text">Mall / Swalayan</span>
                                    </div>
                                </label>

                                <label class="custom-checkbox-card" for="fasTransportasi">
                                    <input type="checkbox" name="fasTransportasi" id="fasTransportasi" value="1" {{ old('fasTransportasi') ? 'checked' : '' }}>
                                    <div class="checkbox-card-inner">
                                        <i class="mdi mdi-bus check-icon"></i>
                                        <span class="check-text">Transportasi Umum</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">Deskripsi & Catatan Properti</label>
                            <textarea name="deskripsi" class="form-control" rows="3" placeholder="Tambahkan catatan khusus, potensi pengembangan, atau deskripsi lingkungan...">{{ old('deskripsi') }}</textarea>
                        </div>

                        {{-- ================= 2. DOKUMEN LEGALITAS ================= --}}
                        <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom mt-4">
                            <span class="badge bg-primary bg-opacity-10 text-primary p-2 rounded-3">
                                <i class="mdi mdi-file-certificate" style="font-size: 1.1rem;"></i>
                            </span>
                            <h6 class="fw-bold text-dark mb-0">2. Nomor Dokumen Legalitas</h6>
                        </div>

                        <div class="row g-3 mb-4">
                            @foreach ($documentTypes as $type)
                                <div class="col-md-4">
                                    <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">
                                        Nomor {{ $type->name }}
                                    </label>
                                    <input type="text" name="documents[{{ $type->id }}][number]" class="form-control" placeholder="Contoh: No. {{ $type->name }}">
                                </div>
                            @endforeach
                        </div>

                        {{-- ================= 3. UPLOAD BERKAS DOKUMEN (MODERN DRAG/DROP STYLE) ================= --}}
                        <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom mt-4">
                            <span class="badge bg-primary bg-opacity-10 text-primary p-2 rounded-3">
                                <i class="mdi mdi-cloud-upload" style="font-size: 1.1rem;"></i>
                            </span>
                            <h6 class="fw-bold text-dark mb-0">3. Upload Berkas Dokumen Legalitas</h6>
                        </div>

                        <div class="row g-3 mb-4">
                            @foreach ($documentTypes as $type)
                                <div class="col-md-4">
                                    <label class="form-label fw-bold text-dark mb-1" style="font-size: 0.85rem;">
                                        Upload {{ $type->name }}
                                    </label>
                                    <div class="upload-card-box">
                                        <input type="file" name="documents[{{ $type->id }}][file]"
                                            id="upload_{{ $type->id }}" accept=".pdf,.jpg,.jpeg,.png,.webp" class="file-upload-input" data-label="{{ $type->name }}">
                                        
                                        <div class="upload-icon-circle">
                                            <i class="mdi mdi-cloud-upload-outline"></i>
                                        </div>
                                        <span class="upload-title-text">Pilih Berkas {{ $type->name }}</span>
                                        <small class="upload-format-hint">Format: PDF, JPG, PNG (Max: 2MB)</small>
                                        <span class="upload-size-badge"></span>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- ================= 4. UPLOAD DENAH / SITEPLAN PROPERTI ================= --}}
                        <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom mt-4">
                            <span class="badge bg-primary bg-opacity-10 text-primary p-2 rounded-3">
                                <i class="mdi mdi-floor-plan" style="font-size: 1.1rem;"></i>
                            </span>
                            <h6 class="fw-bold text-dark mb-0">4. Upload Denah / Siteplan Properti</h6>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-12">
                                <div class="upload-card-box upload-denah-card p-3" style="border: 2px dashed #9a55ff; background: #faf8ff; min-height: 130px;">
                                    <input type="file" name="denah" id="upload_denah" accept=".pdf,.jpg,.jpeg,.png,.webp,.svg" class="file-upload-input" data-label="Denah / Siteplan">
                                    
                                    <div class="upload-icon-circle" style="width: 48px; height: 48px; background: rgba(154, 85, 255, 0.15); color: #9a55ff; font-size: 1.5rem;">
                                        <i class="mdi mdi-floor-plan"></i>
                                    </div>
                                    <span class="upload-title-text fw-bold" style="font-size: 0.9rem; color: #6a11cb;">
                                        Klik atau Seret Berkas Denah / Siteplan di Sini
                                    </span>
                                    <small class="upload-format-hint">Format: JPG, JPEG, PNG, WEBP, SVG, atau PDF (Maksimal: 5MB)</small>
                                    <span class="upload-size-badge"></span>
                                </div>

                                {{-- Container Preview Denah --}}
                                <div id="denahPreviewContainer" class="mt-3 p-3 border rounded-3 bg-white shadow-sm text-center" style="display: none;">
                                    <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                                        <span class="fw-bold text-dark" style="font-size: 0.85rem;">
                                            <i class="mdi mdi-image-check text-success me-1"></i>Pratinjau Berkas Denah
                                        </span>
                                        <button type="button" class="btn btn-sm btn-outline-danger py-1 px-2 d-inline-flex align-items-center gap-1" id="btnRemoveDenah" style="font-size: 0.75rem; border-radius: 6px;">
                                            <i class="mdi mdi-delete-outline"></i> Hapus / Ganti
                                        </button>
                                    </div>
                                    <div id="denahImageWrapper" class="text-center py-2" style="display: none;">
                                        <img id="denahImagePreview" src="" alt="Pratinjau Denah" class="img-fluid rounded shadow-sm border" style="max-height: 320px; max-width: 100%; object-fit: contain;">
                                    </div>
                                    <div id="denahPdfWrapper" class="p-3 text-center" style="display: none; background: #fdfaf6; border-radius: 8px;">
                                        <i class="mdi mdi-file-pdf-box text-danger" style="font-size: 2.5rem;"></i>
                                        <p class="mb-0 fw-bold text-dark mt-1" id="denahPdfFileName" style="font-size: 0.88rem;"></p>
                                        <small class="text-muted">Dokumen Denah format PDF siap diunggah</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- ================= 5. STATUS & PRIORITAS ================= --}}
                        <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom mt-4">
                            <span class="badge bg-primary bg-opacity-10 text-primary p-2 rounded-3">
                                <i class="mdi mdi-tag-check" style="font-size: 1.1rem;"></i>
                            </span>
                            <h6 class="fw-bold text-dark mb-0">5. Status Operasional & Verifikasi</h6>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">
                                    Status Legalitas <span class="text-danger">*</span>
                                </label>
                                <select name="statusLegal" class="form-control @error('statusLegal') is-invalid @enderror" required>
                                    <option value="Pending" {{ old('statusLegal') == 'Pending' ? 'selected' : '' }}>Pending (Dalam Pemeriksaan)</option>
                                    <option value="Lengkap" {{ old('statusLegal') == 'Lengkap' ? 'selected' : '' }}>Lengkap (Terverifikasi)</option>
                                </select>
                                @error('statusLegal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">
                                    Status Kavling <span class="text-danger">*</span>
                                </label>
                                <select name="statusKavling" class="form-control @error('statusKavling') is-invalid @enderror" required>
                                    <option value="Belum" {{ old('statusKavling') == 'Belum' ? 'selected' : '' }}>Belum Dipecah</option>
                                    <option value="Proses" {{ old('statusKavling') == 'Proses' ? 'selected' : '' }}>Dalam Proses Pecah</option>
                                    <option value="Selesai" {{ old('statusKavling') == 'Selesai' ? 'selected' : '' }}>Selesai Dipecah</option>
                                </select>
                                @error('statusKavling')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">Tingkat Prioritas</label>
                                <select name="prioritas" class="form-control">
                                    <option value="Normal" {{ old('prioritas') == 'Normal' ? 'selected' : '' }}>Normal</option>
                                    <option value="Tinggi" {{ old('prioritas') == 'Tinggi' ? 'selected' : '' }}>Tinggi</option>
                                    <option value="Urgent" {{ old('prioritas') == 'Urgent' ? 'selected' : '' }}>Urgent</option>
                                </select>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">Fee Dokumen Verifikasi Pasca</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted fw-semibold">Rp</span>
                                    <input type="text" name="fee_document_verification" class="form-control"
                                        value="{{ old('fee_document_verification') }}" placeholder="Contoh: 5.000.000">
                                </div>
                            </div>
                        </div>

                        {{-- ================= 6. DATA CUT AND FILL ================= --}}
                        <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom mt-4">
                            <span class="badge bg-primary bg-opacity-10 text-primary p-2 rounded-3">
                                <i class="mdi mdi-excavator" style="font-size: 1.1rem;"></i>
                            </span>
                            <h6 class="fw-bold text-dark mb-0">6. Rencana Pekerjaan Cut and Fill</h6>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-3">
                                <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">Elevasi Awal (m)</label>
                                <input type="number" step="0.01" name="elevasi_awal" value="{{ old('elevasi_awal') }}" class="form-control" placeholder="0.00">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">Elevasi Rencana (m)</label>
                                <input type="number" step="0.01" name="elevasi_rencana" value="{{ old('elevasi_rencana') }}" class="form-control" placeholder="0.00">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">Volume Cut (m³)</label>
                                <input type="number" step="0.01" name="volume_cut" value="{{ old('volume_cut') }}" class="form-control" placeholder="0.00">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">Volume Fill (m³)</label>
                                <input type="number" step="0.01" name="volume_fill" value="{{ old('volume_fill') }}" class="form-control" placeholder="0.00">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">Status Cut & Fill</label>
                                <select name="status_cut_fill" class="form-control">
                                    <option value="planned" {{ old('status_cut_fill') == 'planned' ? 'selected' : '' }}>Planned</option>
                                    <option value="proses" {{ old('status_cut_fill') == 'proses' ? 'selected' : '' }}>Proses</option>
                                    <option value="selesai" {{ old('status_cut_fill') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                            </div>
                        </div>

                        {{-- ================= 7. TITIK KOORDINAT & GOOGLE MAP ================= --}}
                        <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom mt-4">
                            <span class="badge bg-primary bg-opacity-10 text-primary p-2 rounded-3">
                                <i class="mdi mdi-google-maps" style="font-size: 1.1rem;"></i>
                            </span>
                            <h6 class="fw-bold text-dark mb-0">7. Titik Koordinat & Google Maps</h6>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">Latitude</label>
                                <input type="text" name="latitude" id="latitudeInput" class="form-control" value="{{ old('latitude') }}" placeholder="Contoh: -8.1727">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">Longitude</label>
                                <input type="text" name="longitude" id="longitudeInput" class="form-control" value="{{ old('longitude') }}" placeholder="Contoh: 113.7000">
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="map-outer-card">
                                <div id="map"></div>
                            </div>
                            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mt-2">
                                <small class="text-muted">
                                    <i class="mdi mdi-information-outline text-primary me-1"></i>
                                    Peta Google Map interaktif (dapat beralih ke mode <strong>Roadmap</strong> atau <strong>Satelit</strong>). Geser pin marker untuk menentukan koordinat lokasi.
                                </small>
                                <button type="button" id="btnLokasiSaya" class="btn btn-sm btn-gradient-primary d-flex align-items-center gap-1 shadow-sm px-3">
                                    <i class="mdi mdi-crosshairs-gps"></i>
                                    <span>Gunakan Lokasi Saya (GPS)</span>
                                </button>
                            </div>
                        </div>

                        <hr class="my-4" style="border-top: 1px solid #e9ecef;">

                        <!-- Tombol Aksi Form Mentok Kanan -->
                        <div class="d-flex justify-content-end align-items-center gap-2 pt-1">
                            <button type="reset" class="btn btn-sm btn-outline-secondary px-3 btn-reset" style="width: auto;">
                                <i class="mdi mdi-refresh me-1"></i>Reset Form
                            </button>

                            <button type="submit" class="btn btn-sm btn-gradient-primary px-4 d-flex align-items-center gap-1 shadow-sm" style="width: auto;">
                                <i class="mdi mdi-content-save me-1"></i>
                                <span>Simpan Data Properti</span>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Format rupiah input
    const rupiahInputs = document.querySelectorAll('input[name="hargaPerolehan"], input[name="fee_document_verification"]');
    rupiahInputs.forEach(input => {
        input.addEventListener('input', function() {
            let value = this.value.replace(/\D/g, '');
            if (value) {
                value = parseInt(value).toLocaleString('id-ID');
                this.value = value;
            }
        });
    });

    // Select2
    if ($('#companySelect').length) {
        $('#companySelect').select2({
            theme: 'bootstrap-5',
            width: '100%',
            placeholder: '-- Pilih Perusahaan (PT) --'
        });
    }

    // Modern File Upload Preview Handler
    document.querySelectorAll('.file-upload-input').forEach(input => {
        input.addEventListener('change', function(e) {
            const card = this.closest('.upload-card-box');
            const titleSpan = card.querySelector('.upload-title-text');
            const sizeBadge = card.querySelector('.upload-size-badge');
            const iconCircle = card.querySelector('.upload-icon-circle i');
            const defaultLabel = this.getAttribute('data-label') || 'Berkas';

            if (this.files && this.files[0]) {
                const file = this.files[0];
                const fileName = file.name;
                const sizeInMB = (file.size / (1024 * 1024)).toFixed(2);

                titleSpan.textContent = fileName.length > 25 ? fileName.substring(0, 25) + '...' : fileName;
                titleSpan.style.color = '#7a30e8';

                sizeBadge.textContent = sizeInMB + ' MB';
                sizeBadge.style.display = 'inline-block';

                iconCircle.className = 'mdi mdi-file-check text-success';
                card.style.borderColor = '#9a55ff';
                card.style.background = '#f7f2ff';
            } else {
                titleSpan.textContent = 'Pilih Berkas ' + defaultLabel;
                titleSpan.style.color = '#2c2e3f';
                sizeBadge.style.display = 'none';
                iconCircle.className = 'mdi mdi-cloud-upload-outline';
                card.style.borderColor = '#d9dce2';
                card.style.background = '#fafbfc';
            }
        });
    });

    // Handler Khusus Pratinjau Denah / Siteplan
    const denahInput = document.getElementById('upload_denah');
    const denahPreviewContainer = document.getElementById('denahPreviewContainer');
    const denahImageWrapper = document.getElementById('denahImageWrapper');
    const denahImagePreview = document.getElementById('denahImagePreview');
    const denahPdfWrapper = document.getElementById('denahPdfWrapper');
    const denahPdfFileName = document.getElementById('denahPdfFileName');
    const btnRemoveDenah = document.getElementById('btnRemoveDenah');

    if (denahInput) {
        denahInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const file = this.files[0];
                const fileType = file.type;

                if (fileType.startsWith('image/') || /\.(jpg|jpeg|png|webp|svg)$/i.test(file.name)) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        denahImagePreview.src = e.target.result;
                        denahImageWrapper.style.display = 'block';
                        denahPdfWrapper.style.display = 'none';
                        denahPreviewContainer.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else if (fileType === 'application/pdf' || /\.pdf$/i.test(file.name)) {
                    denahPdfFileName.textContent = file.name;
                    denahPdfWrapper.style.display = 'block';
                    denahImageWrapper.style.display = 'none';
                    denahPreviewContainer.style.display = 'block';
                }
            } else {
                denahPreviewContainer.style.display = 'none';
            }
        });
    }

    if (btnRemoveDenah) {
        btnRemoveDenah.addEventListener('click', function() {
            if (denahInput) {
                denahInput.value = '';
                const card = denahInput.closest('.upload-card-box');
                if (card) {
                    const titleSpan = card.querySelector('.upload-title-text');
                    const sizeBadge = card.querySelector('.upload-size-badge');
                    const iconCircle = card.querySelector('.upload-icon-circle i');
                    if (titleSpan) {
                        titleSpan.textContent = 'Klik atau Seret Berkas Denah / Siteplan di Sini';
                        titleSpan.style.color = '#6a11cb';
                    }
                    if (sizeBadge) sizeBadge.style.display = 'none';
                    if (iconCircle) iconCircle.className = 'mdi mdi-floor-plan';
                    card.style.borderColor = '#9a55ff';
                    card.style.background = '#faf8ff';
                }
            }
            denahPreviewContainer.style.display = 'none';
            denahImagePreview.src = '';
        });
    }

    // ===== 3. GOOGLE MAPS LEAFLET INTEGRATION =====
    let defaultLat = -8.1727;
    let defaultLng = 113.7000;

    let latInput = document.getElementById('latitudeInput');
    let lngInput = document.getElementById('longitudeInput');
    let btnLokasi = document.getElementById("btnLokasiSaya");

    let lat = latInput && latInput.value ? parseFloat(latInput.value) : defaultLat;
    let lng = lngInput && lngInput.value ? parseFloat(lngInput.value) : defaultLng;

    // Google Maps Tile Layers
    let googleRoadmap = L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
        attribution: '&copy; Google Maps'
    });

    let googleHybrid = L.tileLayer('https://{s}.google.com/vt/lyrs=y&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
        attribution: '&copy; Google Maps'
    });

    let map = L.map('map', {
        center: [lat, lng],
        zoom: 15,
        layers: [googleRoadmap]
    });

    // Invalidate size to ensure full tiles rendering without blank spaces
    setTimeout(function() {
        map.invalidateSize();
    }, 200);
    setTimeout(function() {
        map.invalidateSize();
    }, 600);
    window.addEventListener('resize', function() {
        map.invalidateSize();
    });

    // Layer Switcher (Roadmap & Satelit)
    let baseMaps = {
        "Google Roadmap": googleRoadmap,
        "Google Satellite": googleHybrid
    };
    L.control.layers(baseMaps, null, { position: 'topright' }).addTo(map);

    // Custom Red Pin Marker
    let redIcon = L.divIcon({
        className: 'custom-red-marker-pin',
        html: `
            <div style="
                position: relative;
                width: 34px;
                height: 44px;
                display: flex;
                align-items: center;
                justify-content: center;
                filter: drop-shadow(0 3px 6px rgba(0,0,0,0.35));
                cursor: grab;
            ">
                <svg width="34" height="44" viewBox="0 0 24 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 0C5.373 0 0 5.373 0 12C0 21 12 32 12 32C12 32 24 21 24 12C24 5.373 18.627 0 12 0Z" fill="#e53935"/>
                    <circle cx="12" cy="11" r="5" fill="#ffffff"/>
                    <circle cx="12" cy="11" r="2.5" fill="#b71c1c"/>
                </svg>
            </div>
        `,
        iconSize: [34, 44],
        iconAnchor: [17, 44],
        popupAnchor: [0, -40]
    });

    let marker = L.marker([lat, lng], { draggable: true, icon: redIcon }).addTo(map);

    marker.on('dragend', function() {
        let pos = marker.getLatLng();
        if (latInput) latInput.value = pos.lat.toFixed(6);
        if (lngInput) lngInput.value = pos.lng.toFixed(6);
    });

    map.on('click', function(e) {
        marker.setLatLng(e.latlng);
        if (latInput) latInput.value = e.latlng.lat.toFixed(6);
        if (lngInput) lngInput.value = e.latlng.lng.toFixed(6);
    });

    function updateMarkerFromInput() {
        let newLat = parseFloat(latInput.value);
        let newLng = parseFloat(lngInput.value);
        if (!isNaN(newLat) && !isNaN(newLng)) {
            marker.setLatLng([newLat, newLng]);
            map.setView([newLat, newLng], 16);
        }
    }

    if (latInput) latInput.addEventListener('change', updateMarkerFromInput);
    if (lngInput) lngInput.addEventListener('change', updateMarkerFromInput);

    // GPS Lokasi Saya
    if (btnLokasi) {
        btnLokasi.addEventListener("click", function() {
            if (!navigator.geolocation) {
                Swal.fire('Error', 'Browser Anda tidak mendukung geolokasi GPS.', 'error');
                return;
            }

            btnLokasi.innerHTML = '<i class="mdi mdi-loading mdi-spin"></i> Mendeteksi Lokasi...';
            btnLokasi.disabled = true;

            navigator.geolocation.getCurrentPosition(
                function(pos) {
                    let userLat = pos.coords.latitude;
                    let userLng = pos.coords.longitude;

                    marker.setLatLng([userLat, userLng]);
                    if (latInput) latInput.value = userLat.toFixed(6);
                    if (lngInput) lngInput.value = userLng.toFixed(6);
                    map.setView([userLat, userLng], 17);

                    btnLokasi.innerHTML = '<i class="mdi mdi-crosshairs-gps"></i> Gunakan Lokasi Saya (GPS)';
                    btnLokasi.disabled = false;

                    Swal.fire({
                        icon: 'success',
                        title: 'Lokasi Ditemukan',
                        text: `Koordinat GPS: ${userLat.toFixed(6)}, ${userLng.toFixed(6)}`,
                        timer: 2000,
                        showConfirmButton: false
                    });
                },
                function() {
                    Swal.fire('Gagal', 'Tidak dapat mendeteksi lokasi saat ini. Pastikan izin akses lokasi aktif.', 'warning');
                    btnLokasi.innerHTML = '<i class="mdi mdi-crosshairs-gps"></i> Gunakan Lokasi Saya (GPS)';
                    btnLokasi.disabled = false;
                },
                { enableHighAccuracy: true, timeout: 10000 }
            );
        });
    }

    // Submit confirmation
    const form = document.querySelector('.main-form');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Simpan Data Properti?',
                text: 'Pastikan seluruh informasi data tanah dan berkas legalitas sudah sesuai.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#9a55ff',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Simpan Data!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Memuat...',
                        text: 'Sedang menyimpan data properti ke sistem',
                        allowOutsideClick: false,
                        didOpen: () => Swal.showLoading()
                    });
                    form.submit();
                }
            });
        });
    }
});
</script>
@endpush
