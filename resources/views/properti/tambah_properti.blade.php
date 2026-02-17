@extends('layouts.partial.app')

@section('title', 'Tambah Properti - Properti Management')

@section('content')
<style>
/* ===== STYLE CSS KHUSUS UNTUK HALAMAN TAMBAH PROPERTI ===== */
/* Form Styling */
.properti-form-group {
    margin-bottom: 1rem;
}

@media (min-width: 768px) {
    .properti-form-group {
        margin-bottom: 1.2rem;
    }
}

.properti-form-group label,
.properti-form-label {
    font-size: 0.8rem;
    font-weight: 600;
    color: #9a55ff !important;
    margin-bottom: 0.3rem;
    letter-spacing: 0.3px;
    font-family: 'Nunito', sans-serif;
    display: block;
}

@media (min-width: 768px) {
    .properti-form-group label,
    .properti-form-label {
        font-size: 0.85rem;
        margin-bottom: 0.4rem;
    }
}

.properti-form-control,
input[type="text"].properti-form-control,
input[type="number"].properti-form-control,
input[type="date"].properti-form-control,
select.properti-form-control,
textarea.properti-form-control {
    border: 1px solid #e9ecef;
    border-radius: 10px;
    padding: 0.7rem 0.8rem;
    font-size: 0.85rem;
    transition: all 0.2s ease;
    background-color: #ffffff;
    color: #2c2e3f;
    width: 100%;
    font-family: 'Nunito', sans-serif;
}

@media (min-width: 768px) {
    .properti-form-control,
    input[type="text"].properti-form-control,
    input[type="number"].properti-form-control,
    input[type="date"].properti-form-control,
    select.properti-form-control,
    textarea.properti-form-control {
        padding: 0.6rem 0.75rem;
        font-size: 0.9rem;
        border-radius: 8px;
    }
}

.properti-form-control:focus {
    border-color: #9a55ff;
    box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.1);
    outline: none;
}

.properti-form-control.is-invalid {
    border-color: #dc3545;
}

.properti-form-control.is-invalid:focus {
    box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
}

select.properti-form-control {
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%239a55ff' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 0.75rem center;
    background-size: 12px;
    padding-right: 2rem;
}

/* Input Group */
.properti-input-group {
    display: flex;
    align-items: stretch;
    width: 100%;
}

.properti-input-group-prepend {
    display: flex;
}

.properti-input-group-text {
    display: flex;
    align-items: center;
    padding: 0.7rem 0.8rem;
    font-size: 0.85rem;
    font-weight: 400;
    line-height: 1;
    color: #6c7383;
    text-align: center;
    white-space: nowrap;
    background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
    border: 1px solid #e9ecef;
    border-radius: 10px 0 0 10px;
    border-right: none;
}

@media (min-width: 768px) {
    .properti-input-group-text {
        padding: 0.6rem 0.8rem;
        font-size: 0.9rem;
    }
}

.properti-input-group .properti-form-control {
    border-radius: 0 10px 10px 0;
}

/* Button Styling */
.properti-btn {
    font-size: 0.8rem;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
    font-family: 'Nunito', sans-serif;
    display: inline-block;
    text-decoration: none;
    cursor: pointer;
    border: none;
    width: 100%;
    text-align: center;
}

@media (min-width: 576px) {
    .properti-btn {
        width: auto;
        padding: 0.5rem 1.2rem;
    }
}

.properti-btn-primary {
    background: linear-gradient(to right, #da8cff, #9a55ff);
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(154, 85, 255, 0.3);
}

.properti-btn-primary:hover {
    background: linear-gradient(to right, #c77cff, #8a45e6);
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(154, 85, 255, 0.4);
}

.properti-btn-secondary {
    background: linear-gradient(135deg, #f0f2f5, #e4e6ea);
    border: 1px solid #e9ecef;
    color: #2c2e3f;
}

.properti-btn-secondary:hover {
    background: linear-gradient(135deg, #e4e6ea, #d8dce2);
    transform: translateY(-2px);
    color: #2c2e3f;
}

.properti-btn-outline-primary {
    background: transparent;
    border: 1px solid #9a55ff;
    color: #9a55ff;
}

.properti-btn-outline-primary:hover {
    background: linear-gradient(135deg, #9a55ff, #da8cff);
    color: #ffffff;
    border-color: transparent;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(154, 85, 255, 0.3);
}

.properti-btn-sm {
    padding: 0.25rem 0.75rem;
    font-size: 0.75rem;
}

/* Text colors */
.properti-text-muted {
    color: #a5b3cb !important;
    font-size: 0.7rem;
    display: block;
    margin-top: 0.2rem;
}

.properti-text-primary {
    color: #9a55ff !important;
}

.properti-text-danger {
    color: #dc3545 !important;
}

/* Divider */
.properti-hr {
    border-top: 1px solid #e9ecef;
    margin: 0.8rem 0;
}

/* Alert Styling */
.properti-alert {
    border: none;
    border-radius: 10px;
    padding: 0.8rem 1rem;
    font-size: 0.8rem;
    border-left: 4px solid;
    margin-bottom: 1rem;
}

@media (min-width: 768px) {
    .properti-alert {
        padding: 0.9rem 1rem;
        font-size: 0.85rem;
    }
}

.properti-alert-info {
    background: linear-gradient(135deg, #f6f9ff, #f0f4ff);
    color: #2c2e3f;
    border-left-color: #9a55ff;
}

.properti-alert-info i {
    color: #9a55ff;
}

.properti-alert-success {
    background: linear-gradient(135deg, #f0fff4, #e6f7e6);
    color: #2c2e3f;
    border-left-color: #28a745;
}

.properti-alert-danger {
    background: linear-gradient(135deg, #fff0f0, #ffe6e6);
    color: #2c2e3f;
    border-left-color: #dc3545;
}

/* Section Title */
.properti-section-title {
    font-size: 1rem;
    font-weight: 700;
    color: #9a55ff !important;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #e9ecef;
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
}

.properti-section-title i {
    color: #9a55ff;
    font-size: 1.1rem;
    background: rgba(154, 85, 255, 0.1);
    padding: 6px;
    border-radius: 8px;
}

/* Card Styling */
.properti-card {
    border: 1px solid #e9ecef;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.02);
    background: #ffffff;
    transition: all 0.3s ease;
    margin-bottom: 1rem;
}

.properti-card .properti-card-body {
    padding: 1rem;
}

@media (min-width: 768px) {
    .properti-card .properti-card-body {
        padding: 1.2rem;
    }
}

/* Map Container */
.properti-map-container {
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid #e9ecef;
}

/* Grid System */
.properti-row {
    display: flex;
    flex-wrap: wrap;
    margin-right: -0.3rem;
    margin-left: -0.3rem;
}

.properti-col-6,
.properti-col-12,
.properti-col-sm-6,
.properti-col-md-3,
.properti-col-md-4,
.properti-col-md-6 {
    position: relative;
    width: 100%;
    padding-right: 0.3rem;
    padding-left: 0.3rem;
    margin-bottom: 0.5rem;
}

@media (min-width: 576px) {
    .properti-col-sm-6 {
        flex: 0 0 50%;
        max-width: 50%;
    }
}

@media (min-width: 768px) {
    .properti-col-md-3 {
        flex: 0 0 25%;
        max-width: 25%;
    }
    .properti-col-md-4 {
        flex: 0 0 33.333333%;
        max-width: 33.333333%;
    }
    .properti-col-md-6 {
        flex: 0 0 50%;
        max-width: 50%;
    }
}

/* ===== MODERN CHECKBOX STYLING ===== */
.properti-checkbox-group {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    justify-content: center;
    margin-top: 0.5rem;
}

.properti-checkbox-wrapper {
    position: relative;
    min-width: 140px;
    flex: 1 1 auto;
}

.properti-checkbox-input {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
}

.properti-checkbox-label {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 0.75rem 1.2rem;
    background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
    border: 2px solid #e9ecef;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.properti-checkbox-label::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(154, 85, 255, 0.1), rgba(218, 140, 255, 0.1));
    opacity: 0;
    transition: opacity 0.3s ease;
    pointer-events: none;
}

.properti-checkbox-wrapper:hover .properti-checkbox-label {
    border-color: #9a55ff;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(154, 85, 255, 0.15);
}

.properti-checkbox-wrapper:hover .properti-checkbox-label::before {
    opacity: 1;
}

.properti-check-icon {
    font-size: 1.4rem;
    color: #d0d4db;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    background: white;
    border-radius: 50%;
    padding: 2px;
}

.properti-checkbox-input:checked + .properti-checkbox-label {
    border-color: #9a55ff;
    background: linear-gradient(135deg, #f1f0ff, #e8e0ff);
    box-shadow: 0 5px 15px rgba(154, 85, 255, 0.2);
}

.properti-checkbox-input:checked + .properti-checkbox-label .properti-check-icon {
    color: #9a55ff;
    transform: scale(1.1);
    filter: drop-shadow(0 4px 8px rgba(154, 85, 255, 0.4));
    animation: propertiCheckPulse 0.3s ease;
}

.properti-checkbox-input:checked + .properti-checkbox-label .properti-check-text {
    color: #9a55ff;
    font-weight: 600;
}

.properti-check-text {
    transition: all 0.3s ease;
    position: relative;
    font-size: 0.9rem;
    color: #2c2e3f;
}

.properti-check-text::before {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 0;
    height: 2px;
    background: linear-gradient(to right, #da8cff, #9a55ff);
    transition: width 0.3s ease;
}

.properti-checkbox-input:checked + .properti-checkbox-label .properti-check-text::before {
    width: 100%;
}

@keyframes propertiCheckPulse {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.2);
    }
    100% {
        transform: scale(1.1);
    }
}

/* ===== MODERN FILE UPLOAD STYLING ===== */
.properti-file-upload-modern {
    position: relative;
    width: 100%;
}

.properti-file-upload-modern input[type="file"] {
    position: absolute;
    opacity: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
    z-index: 2;
}

.properti-file-upload-modern .properti-file-label-modern {
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
    .properti-file-upload-modern .properti-file-label-modern {
        flex-direction: row;
        text-align: left;
        gap: 8px;
        padding: 0.75rem 1rem;
        min-height: auto;
    }
}

.properti-file-upload-modern:hover .properti-file-label-modern {
    border-color: #9a55ff;
    background: linear-gradient(135deg, #f1f0ff, #f8f9fa);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(154, 85, 255, 0.1);
}

.properti-file-upload-modern .properti-file-label-modern i {
    font-size: 1.6rem;
    color: #9a55ff;
    background: rgba(154, 85, 255, 0.1);
    padding: 8px;
    border-radius: 50%;
}

.properti-file-upload-modern .properti-file-label-modern .properti-file-info-modern {
    flex: 1;
    width: 100%;
}

.properti-file-upload-modern .properti-file-label-modern .properti-file-info-modern span {
    display: block;
    font-weight: 600;
    color: #2c2e3f;
    font-size: 0.8rem;
    word-break: break-word;
}

.properti-file-upload-modern .properti-file-label-modern .properti-file-info-modern small {
    color: #6c7383;
    font-size: 0.65rem;
    display: block;
    margin-top: 2px;
}

.properti-file-upload-modern .properti-file-label-modern .properti-file-size {
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
    .properti-file-upload-modern .properti-file-label-modern .properti-file-size {
        margin-top: 0;
    }
}

/* Button Group */
.properti-btn-group {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;
}

.properti-btn-group .btn-right {
    display: flex;
    gap: 0.5rem;
    margin-left: auto;
}

@media (max-width: 576px) {
    .properti-btn-group {
        flex-direction: column;
    }

    .properti-btn-group .properti-btn {
        width: 100%;
    }

    .properti-btn-group .btn-right {
        margin-left: 0;
        width: 100%;
        flex-direction: column;
    }
}

/* Custom responsive adjustments */
@media (max-width: 576px) {
    .properti-card .properti-card-body {
        padding: 1rem !important;
    }

    .properti-btn {
        width: 100%;
        margin-bottom: 0.5rem;
    }

    .properti-row {
        flex-direction: column;
    }

    .properti-row > [class*="properti-col-"] {
        width: 100%;
        max-width: 100%;
    }

    .properti-checkbox-group {
        gap: 0.5rem;
    }

    .properti-checkbox-wrapper {
        min-width: calc(50% - 0.5rem);
        flex: 0 0 calc(50% - 0.5rem);
    }

    .properti-checkbox-label {
        padding: 0.6rem 0.8rem;
    }

    .properti-check-text {
        font-size: 0.85rem;
    }

    .properti-check-icon {
        font-size: 1.2rem;
    }
}

@media (min-width: 577px) and (max-width: 768px) {
    .properti-btn {
        padding: 0.5rem 0.75rem;
        font-size: 0.9rem;
    }

    .properti-checkbox-wrapper {
        min-width: 120px;
    }
}

/* Better touch targets for mobile */
input, select, textarea, button {
    font-size: 16px !important;
}

/* Alert transition */
.properti-alert-transition {
    transition: opacity 0.5s ease;
}
</style>

<div class="container-fluid px-2 px-md-3 px-lg-4">
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="properti-card shadow-sm">
                <div class="properti-card-body p-3 p-md-4 p-lg-5">

                    <h4 class="properti-section-title">
                        <i class="fas fa-plus-circle me-2"></i>
                        Tambah Data Tanah / Properti
                    </h4>

                    {{-- ERROR VALIDATION --}}
                    @if (session('success'))
                        <div id="successAlert" class="properti-alert properti-alert-success">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="properti-alert properti-alert-danger" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('properti.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- ALERT --}}
                        <div class="properti-alert properti-alert-info d-flex align-items-center flex-wrap" role="alert">
                            <i class="fas fa-info-circle me-2"></i>
                            <span>Setelah simpan data tanah, Anda bisa lanjut verifikasi legal & kavling</span>
                        </div>

                        {{-- ================= INFORMASI DASAR ================= --}}
                        <h5 class="properti-section-title">
                            <i class="fas fa-home me-2"></i>
                            Informasi Dasar Tanah
                        </h5>

                        <div class="properti-row">
                            <div class="properti-col-md-6">
                                <div class="properti-form-group">
                                    <label class="properti-form-label">Nama Tanah/Proyek <span class="properti-text-danger">*</span></label>
                                    <input type="text" name="namaTanah"
                                        class="properti-form-control @error('namaTanah') is-invalid @enderror"
                                        value="{{ old('namaTanah') }}" required>
                                    @error('namaTanah')
                                        <div class="properti-text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="properti-col-md-6">
                                <div class="properti-form-group">
                                    <label class="properti-form-label">Status Kepemilikan <span class="properti-text-danger">*</span></label>
                                    <select name="statusKepemilikan"
                                        class="properti-form-control @error('statusKepemilikan') is-invalid @enderror" required>
                                        <option value="">-- Pilih Status --</option>
                                        <option value="SHM" {{ old('statusKepemilikan') == 'SHM' ? 'selected' : '' }}>SHM (Sertifikat Hak Milik)</option>
                                        <option value="HGB" {{ old('statusKepemilikan') == 'HGB' ? 'selected' : '' }}>HGB (Hak Guna Bangunan)</option>
                                        <option value="HGU" {{ old('statusKepemilikan') == 'HGU' ? 'selected' : '' }}>HGU (Hak Guna Usaha)</option>
                                        <option value="HP" {{ old('statusKepemilikan') == 'HP' ? 'selected' : '' }}>HP (Hak Pakai)</option>
                                    </select>
                                    @error('statusKepemilikan')
                                        <div class="properti-text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="properti-form-group">
                            <label class="properti-form-label">Alamat Lengkap <span class="properti-text-danger">*</span></label>
                            <input type="text" name="lokasi"
                                class="properti-form-control @error('lokasi') is-invalid @enderror" value="{{ old('lokasi') }}"
                                placeholder="Jl. Contoh No. 123" required>
                            @error('lokasi')
                                <div class="properti-text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="properti-row">
                            <div class="properti-col-sm-6 properti-col-md-3">
                                <div class="properti-form-group">
                                    <label class="properti-form-label">Kelurahan/Desa</label>
                                    <input type="text" name="kelurahan" class="properti-form-control"
                                        value="{{ old('kelurahan') }}" placeholder="Kelurahan">
                                </div>
                            </div>
                            <div class="properti-col-sm-6 properti-col-md-3">
                                <div class="properti-form-group">
                                    <label class="properti-form-label">Kecamatan</label>
                                    <input type="text" name="kecamatan" class="properti-form-control"
                                        value="{{ old('kecamatan') }}" placeholder="Kecamatan">
                                </div>
                            </div>
                            <div class="properti-col-sm-6 properti-col-md-3">
                                <div class="properti-form-group">
                                    <label class="properti-form-label">Kota/Kabupaten</label>
                                    <input type="text" name="kota" class="properti-form-control" value="{{ old('kota') }}"
                                        placeholder="Kota">
                                </div>
                            </div>
                            <div class="properti-col-sm-6 properti-col-md-3">
                                <div class="properti-form-group">
                                    <label class="properti-form-label">Provinsi</label>
                                    <input type="text" name="provinsi" class="properti-form-control"
                                        value="{{ old('provinsi') }}" placeholder="Provinsi">
                                </div>
                            </div>
                        </div>

                        <div class="properti-row">
                            <div class="properti-col-sm-6 properti-col-md-3">
                                <div class="properti-form-group">
                                    <label class="properti-form-label">Luas Tanah (m²) <span class="properti-text-danger">*</span></label>
                                    <input type="number" name="luasTanah"
                                        class="properti-form-control @error('luasTanah') is-invalid @enderror"
                                        value="{{ old('luasTanah') }}" min="0" step="0.01" required>
                                    @error('luasTanah')
                                        <div class="properti-text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="properti-col-sm-6 properti-col-md-3">
                                <div class="properti-form-group">
                                    <label class="properti-form-label">Harga Perolehan <span class="properti-text-danger">*</span></label>
                                    <div class="properti-input-group">
                                        <div class="properti-input-group-prepend">
                                            <span class="properti-input-group-text">Rp</span>
                                        </div>
                                        <input type="text" name="hargaPerolehan"
                                            class="properti-form-control @error('hargaPerolehan') is-invalid @enderror"
                                            value="{{ old('hargaPerolehan') }}" placeholder="1.000.000" required>
                                    </div>
                                    @error('hargaPerolehan')
                                        <div class="properti-text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="properti-col-sm-6 properti-col-md-3">
                                <div class="properti-form-group">
                                    <label class="properti-form-label">Tanggal Perolehan <span class="properti-text-danger">*</span></label>
                                    <input type="date" name="tanggalPerolehan"
                                        class="properti-form-control @error('tanggalPerolehan') is-invalid @enderror"
                                        value="{{ old('tanggalPerolehan') }}" required>
                                    @error('tanggalPerolehan')
                                        <div class="properti-text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="properti-col-sm-6 properti-col-md-3">
                                <div class="properti-form-group">
                                    <label class="properti-form-label">Kode Pos</label>
                                    <input type="text" name="kodePos" class="properti-form-control"
                                        value="{{ old('kodePos') }}" placeholder="12345">
                                </div>
                            </div>
                        </div>

                        <div class="properti-row">
                            <div class="properti-col-md-4">
                                <div class="properti-form-group">
                                    <label class="properti-form-label">Zonasi</label>
                                    <input type="text" name="zonasi"
                                        class="properti-form-control @error('zonasi') is-invalid @enderror"
                                        value="{{ old('zonasi') }}" placeholder="Contoh: Perumahan">
                                    @error('zonasi')
                                        <div class="properti-text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="properti-col-md-4">
                                <div class="properti-form-group">
                                    <label class="properti-form-label">Lebar Jalan (m)</label>
                                    <input type="number" name="lebarJalan"
                                        class="properti-form-control @error('lebarJalan') is-invalid @enderror"
                                        value="{{ old('lebarJalan') }}" step="0.1" min="0">
                                    @error('lebarJalan')
                                        <div class="properti-text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="properti-col-md-4">
                                <div class="properti-form-group">
                                    <label class="properti-form-label">Jenis Jalan</label>
                                    <select name="jenisJalan"
                                        class="properti-form-control @error('jenisJalan') is-invalid @enderror">
                                        <option value="">-- Pilih Jenis Jalan --</option>
                                        <option value="Aspal" {{ old('jenisJalan') == 'Aspal' ? 'selected' : '' }}>Aspal</option>
                                        <option value="Beton" {{ old('jenisJalan') == 'Beton' ? 'selected' : '' }}>Beton</option>
                                        <option value="Tanah" {{ old('jenisJalan') == 'Tanah' ? 'selected' : '' }}>Tanah</option>
                                    </select>
                                    @error('jenisJalan')
                                        <div class="properti-text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- ================= MODERN CHECKBOX FASILITAS ================= --}}
                        <div class="mt-3">
                            <label class="properti-form-label d-block text-start">Fasilitas Sekitar</label>

                            <div class="properti-checkbox-group">
                                <div class="properti-checkbox-wrapper">
                                    <input type="checkbox" class="properti-checkbox-input" name="fasSekolah" id="fasSekolah" value="1" {{ old('fasSekolah') ? 'checked' : '' }}>
                                    <label class="properti-checkbox-label" for="fasSekolah">
                                        <i class="fas fa-check-circle properti-check-icon"></i>
                                        <span class="properti-check-text">Sekolah</span>
                                    </label>
                                </div>

                                <div class="properti-checkbox-wrapper">
                                    <input type="checkbox" class="properti-checkbox-input" name="fasRumahSakit" id="fasRumahSakit" value="1" {{ old('fasRumahSakit') ? 'checked' : '' }}>
                                    <label class="properti-checkbox-label" for="fasRumahSakit">
                                        <i class="fas fa-check-circle properti-check-icon"></i>
                                        <span class="properti-check-text">Rumah Sakit</span>
                                    </label>
                                </div>

                                <div class="properti-checkbox-wrapper">
                                    <input type="checkbox" class="properti-checkbox-input" name="fasMall" id="fasMall" value="1" {{ old('fasMall') ? 'checked' : '' }}>
                                    <label class="properti-checkbox-label" for="fasMall">
                                        <i class="fas fa-check-circle properti-check-icon"></i>
                                        <span class="properti-check-text">Mall</span>
                                    </label>
                                </div>

                                <div class="properti-checkbox-wrapper">
                                    <input type="checkbox" class="properti-checkbox-input" name="fasTransportasi" id="fasTransportasi" value="1" {{ old('fasTransportasi') ? 'checked' : '' }}>
                                    <label class="properti-checkbox-label" for="fasTransportasi">
                                        <i class="fas fa-check-circle properti-check-icon"></i>
                                        <span class="properti-check-text">Transportasi Umum</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="properti-form-group mt-3">
                            <label class="properti-form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="properti-form-control" rows="3" placeholder="Deskripsi properti...">{{ old('deskripsi') }}</textarea>
                        </div>

                        <hr class="properti-hr">

                        {{-- ================= LEGAL ================= --}}
                        <h5 class="properti-section-title">
                            <i class="fas fa-file-contract me-2"></i>
                            Dokumen Legal
                        </h5>

                        <div class="properti-row">
                            <div class="properti-col-md-4">
                                <div class="properti-form-group">
                                    <label class="properti-form-label">No Sertifikat <span class="properti-text-danger">*</span></label>
                                    <input type="text" name="noSertifikat"
                                        class="properti-form-control @error('noSertifikat') is-invalid @enderror"
                                        value="{{ old('noSertifikat') }}" required>
                                    @error('noSertifikat')
                                        <div class="properti-text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="properti-col-md-4">
                                <div class="properti-form-group">
                                    <label class="properti-form-label">Atas Nama <span class="properti-text-danger">*</span></label>
                                    <input type="text" name="atasNama"
                                        class="properti-form-control @error('atasNama') is-invalid @enderror"
                                        value="{{ old('atasNama') }}" required>
                                    @error('atasNama')
                                        <div class="properti-text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="properti-col-md-4">
                                <div class="properti-form-group">
                                    <label class="properti-form-label">No IMB</label>
                                    <input type="text" name="noIMB" class="properti-form-control"
                                        value="{{ old('noIMB') }}" placeholder="Nomor IMB">
                                </div>
                            </div>
                        </div>

                        <div class="properti-form-group">
                            <label class="properti-form-label">No PBB</label>
                            <input type="text" name="noPBB" class="properti-form-control" value="{{ old('noPBB') }}"
                                placeholder="Nomor PBB">
                        </div>

                        <hr class="properti-hr">

                        {{-- ================= UPLOAD DOKUMEN MODERN ================= --}}
                        <h5 class="properti-section-title">
                            <i class="fas fa-upload me-2"></i>
                            Upload Dokumen
                        </h5>

                        <div class="properti-row">
                            <div class="properti-col-md-4">
                                <div class="properti-form-group">
                                    <label class="properti-form-label">Upload Sertifikat</label>
                                    <div class="properti-file-upload-modern">
                                        <input type="file" name="uploadSertifikat" id="uploadSertifikat" accept=".pdf,.jpg,.jpeg,.png">
                                        <div class="properti-file-label-modern">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                            <div class="properti-file-info-modern">
                                                <span>Upload Sertifikat</span>
                                                <small>Format: PDF, JPG, PNG (Max: 2MB)</small>
                                            </div>
                                            <span class="properti-file-size"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="properti-col-md-4">
                                <div class="properti-form-group">
                                    <label class="properti-form-label">Upload IMB</label>
                                    <div class="properti-file-upload-modern">
                                        <input type="file" name="uploadIMB" id="uploadIMB" accept=".pdf,.jpg,.jpeg,.png">
                                        <div class="properti-file-label-modern">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                            <div class="properti-file-info-modern">
                                                <span>Upload IMB</span>
                                                <small>Format: PDF, JPG, PNG (Max: 2MB)</small>
                                            </div>
                                            <span class="properti-file-size"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="properti-col-md-4">
                                <div class="properti-form-group">
                                    <label class="properti-form-label">Upload PBB</label>
                                    <div class="properti-file-upload-modern">
                                        <input type="file" name="uploadPBB" id="uploadPBB" accept=".pdf,.jpg,.jpeg,.png">
                                        <div class="properti-file-label-modern">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                            <div class="properti-file-info-modern">
                                                <span>Upload PBB</span>
                                                <small>Format: PDF, JPG, PNG (Max: 2MB)</small>
                                            </div>
                                            <span class="properti-file-size"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="properti-hr">

                        {{-- ================= STATUS ================= --}}
                        <h5 class="properti-section-title">
                            <i class="fas fa-tags me-2"></i>
                            Status
                        </h5>

                        <div class="properti-row">
                            <div class="properti-col-md-4">
                                <div class="properti-form-group">
                                    <label class="properti-form-label">Status Legal <span class="properti-text-danger">*</span></label>
                                    <select name="statusLegal"
                                        class="properti-form-control @error('statusLegal') is-invalid @enderror" required>
                                        <option value="Pending" {{ old('statusLegal') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Lengkap" {{ old('statusLegal') == 'Lengkap' ? 'selected' : '' }}>Lengkap</option>
                                    </select>
                                    @error('statusLegal')
                                        <div class="properti-text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="properti-col-md-4">
                                <div class="properti-form-group">
                                    <label class="properti-form-label">Status Kavling <span class="properti-text-danger">*</span></label>
                                    <select name="statusKavling"
                                        class="properti-form-control @error('statusKavling') is-invalid @enderror" required>
                                        <option value="Belum" {{ old('statusKavling') == 'Belum' ? 'selected' : '' }}>Belum</option>
                                        <option value="Proses" {{ old('statusKavling') == 'Proses' ? 'selected' : '' }}>Proses</option>
                                        <option value="Selesai" {{ old('statusKavling') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                    </select>
                                    @error('statusKavling')
                                        <div class="properti-text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="properti-col-md-4">
                                <div class="properti-form-group">
                                    <label class="properti-form-label">Prioritas</label>
                                    <select name="prioritas" class="properti-form-control">
                                        <option value="Normal" {{ old('prioritas') == 'Normal' ? 'selected' : '' }}>Normal</option>
                                        <option value="Tinggi" {{ old('prioritas') == 'Tinggi' ? 'selected' : '' }}>Tinggi</option>
                                        <option value="Urgent" {{ old('prioritas') == 'Urgent' ? 'selected' : '' }}>Urgent</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <hr class="properti-hr">

                        {{-- ================= MAP ================= --}}
                        <h5 class="properti-section-title">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            Koordinat
                        </h5>

                        <div class="properti-row">
                            <div class="properti-col-md-6">
                                <div class="properti-form-group">
                                    <label class="properti-form-label">Latitude</label>
                                    <input type="text" name="latitude" class="properti-form-control"
                                        value="{{ old('latitude') }}" placeholder="Contoh: -6.2088">
                                </div>
                            </div>
                            <div class="properti-col-md-6">
                                <div class="properti-form-group">
                                    <label class="properti-form-label">Longitude</label>
                                    <input type="text" name="longitude" class="properti-form-control"
                                        value="{{ old('longitude') }}" placeholder="Contoh: 106.8456">
                                </div>
                            </div>
                        </div>

                        <div class="mt-3">
                            <div class="properti-map-container">
                                <div id="map" style="height: 400px;"></div>
                            </div>
                            <div class="mt-2 text-end">
                                <button type="button" id="btnLokasiSaya" class="properti-btn properti-btn-outline-primary properti-btn-sm">
                                    <i class="fas fa-location-dot me-1"></i>
                                    Gunakan Lokasi Saya
                                </button>
                            </div>
                        </div>

                        <hr class="properti-hr">

                        {{-- ================= BUTTON ================= --}}
                        <div class="properti-btn-group mt-4">
                            <a href="" class="properti-btn properti-btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>

                            <div class="btn-right">
                                <button type="submit" class="properti-btn properti-btn-primary">
                                    <i class="fas fa-save me-2"></i>Simpan Properti
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
    // Format rupiah untuk harga perolehan
    document.addEventListener('DOMContentLoaded', function() {
        const hargaInput = document.querySelector('input[name="hargaPerolehan"]');
        if (hargaInput) {
            hargaInput.addEventListener('input', function(e) {
                let value = this.value.replace(/\D/g, '');
                if (value) {
                    value = parseInt(value).toLocaleString('id-ID');
                    this.value = value;
                }
            });
        }
    });

    // Auto hide alert
    document.addEventListener("DOMContentLoaded", function() {
        const alert = document.getElementById("successAlert");
        if (alert) {
            setTimeout(() => {
                alert.style.transition = "opacity 0.5s ease";
                alert.style.opacity = "0";
                setTimeout(() => alert.remove(), 500);
            }, 3000);
        }
    });

    // File upload modern preview
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.properti-file-upload-modern input[type="file"]').forEach(input => {
            input.addEventListener('change', function(e) {
                const fileName = e.target.files[0]?.name;
                const fileSize = e.target.files[0]?.size;
                const label = this.closest('.properti-file-upload-modern').querySelector('.properti-file-info-modern span');
                const sizeSpan = this.closest('.properti-file-upload-modern').querySelector('.properti-file-size');

                if (fileName) {
                    label.textContent = fileName.length > 30 ? fileName.substring(0, 30) + '...' : fileName;
                    if (fileSize) {
                        const sizeInMB = (fileSize / (1024 * 1024)).toFixed(2);
                        sizeSpan.textContent = sizeInMB + ' MB';
                    }
                } else {
                    // Reset ke teks awal berdasarkan input name
                    const inputName = this.name;
                    if (inputName === 'uploadSertifikat') {
                        label.textContent = 'Upload Sertifikat';
                    } else if (inputName === 'uploadIMB') {
                        label.textContent = 'Upload IMB';
                    } else if (inputName === 'uploadPBB') {
                        label.textContent = 'Upload PBB';
                    }
                    sizeSpan.textContent = '';
                }
            });
        });
    });

    // Leaflet Map
    document.addEventListener("DOMContentLoaded", function() {
        let defaultLat = -8.1727;
        let defaultLng = 113.7000;

        let latInput = document.querySelector('input[name="latitude"]');
        let lngInput = document.querySelector('input[name="longitude"]');
        let btnLokasi = document.getElementById("btnLokasiSaya");

        let lat = latInput.value ? parseFloat(latInput.value) : defaultLat;
        let lng = lngInput.value ? parseFloat(lngInput.value) : defaultLng;

        let map = L.map('map').setView([lat, lng], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        let marker = L.marker([lat, lng], {
            draggable: true
        }).addTo(map);

        // Drag marker
        marker.on('dragend', function() {
            let position = marker.getLatLng();
            latInput.value = position.lat.toFixed(6);
            lngInput.value = position.lng.toFixed(6);
        });

        // Klik map
        map.on('click', function(e) {
            marker.setLatLng(e.latlng);
            latInput.value = e.latlng.lat.toFixed(6);
            lngInput.value = e.latlng.lng.toFixed(6);
        });

        // Input manual
        function updateMarkerFromInput() {
            let newLat = parseFloat(latInput.value);
            let newLng = parseFloat(lngInput.value);

            if (!isNaN(newLat) && !isNaN(newLng)) {
                marker.setLatLng([newLat, newLng]);
                map.setView([newLat, newLng], 15);
            }
        }

        latInput.addEventListener('change', updateMarkerFromInput);
        lngInput.addEventListener('change', updateMarkerFromInput);

        // Tombol Lokasi Saya
        btnLokasi.addEventListener("click", function() {
            if (!navigator.geolocation) {
                alert("Browser tidak mendukung geolocation.");
                return;
            }

            btnLokasi.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Mendeteksi...';
            btnLokasi.disabled = true;

            navigator.geolocation.getCurrentPosition(
                function(position) {
                    let userLat = position.coords.latitude;
                    let userLng = position.coords.longitude;

                    marker.setLatLng([userLat, userLng]);
                    latInput.value = userLat.toFixed(6);
                    lngInput.value = userLng.toFixed(6);
                    map.setView([userLat, userLng], 17);

                    btnLokasi.innerHTML = '<i class="fas fa-location-dot me-1"></i> Gunakan Lokasi Saya';
                    btnLokasi.disabled = false;
                },
                function() {
                    alert("Gagal mendapatkan lokasi.");
                    btnLokasi.innerHTML = '<i class="fas fa-location-dot me-1"></i> Gunakan Lokasi Saya';
                    btnLokasi.disabled = false;
                }
            );
        });
    });
</script>

{{-- Leaflet CSS & JS --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
@endpush
