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
}

.form-control:focus {
    border-color: #9a55ff;
    box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.1);
    outline: none;
}

select.form-control {
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%239a55ff' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 0.75rem center;
    background-size: 12px;
    padding-right: 2rem;
}

textarea.form-control {
    min-height: 80px;
    resize: vertical;
}

/* Input Group */
.input-group {
    display: flex;
    align-items: center;
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
}

.input-group .form-control {
    border-radius: 0 8px 8px 0;
}

/* File Upload */
.file-upload-modern {
    position: relative;
    width: 100%;
    margin-bottom: 1rem;
}

.file-upload-modern input[type="file"] {
    position: absolute;
    opacity: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
    z-index: 2;
}

.file-upload-label {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    gap: 8px;
    padding: 1.5rem 1rem;
    background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
    border: 2px dashed #d0d4db;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
}

@media (min-width: 576px) {
    .file-upload-label {
        flex-direction: row;
        text-align: left;
        gap: 12px;
        padding: 1rem 1.5rem;
    }
}

.file-upload-modern:hover .file-upload-label {
    border-color: #9a55ff;
    background: linear-gradient(135deg, #f1f0ff, #f8f9fa);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(154, 85, 255, 0.1);
}

.file-upload-label i {
    font-size: 2rem;
    color: #9a55ff;
    background: rgba(154, 85, 255, 0.1);
    padding: 12px;
    border-radius: 50%;
}

.file-upload-info {
    flex: 1;
}

.file-upload-info span {
    display: block;
    font-weight: 600;
    color: #2c2e3f;
    font-size: 0.9rem;
    margin-bottom: 4px;
}

.file-upload-info small {
    color: #6c7383;
    font-size: 0.75rem;
    display: block;
}

.file-upload-size {
    font-size: 0.8rem;
    color: #9a55ff;
    font-weight: 600;
    background: rgba(154, 85, 255, 0.1);
    padding: 6px 12px;
    border-radius: 20px;
    white-space: nowrap;
}

/* Tab Styling */
.settings-tabs-wrapper {
    background: #f6f9ff;
    border-radius: 8px;
    padding: 6px;
    margin-bottom: 25px;
    border: 1px solid #e9ecef;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

.settings-tabs {
    display: flex;
    flex-wrap: nowrap;
    gap: 4px;
    list-style: none;
    padding: 0;
    margin: 0;
    min-width: min-content;
}

.settings-tab-item {
    flex: 0 0 auto;
}

.settings-tab-link {
    display: flex;
    align-items: center;
    padding: 10px 16px;
    font-size: 0.85rem;
    font-weight: 500;
    color: #6c7383;
    background: transparent;
    border: none;
    border-radius: 6px;
    text-decoration: none;
    transition: all 0.2s ease;
    white-space: nowrap;
    gap: 6px;
    font-family: 'Nunito', sans-serif;
}

.settings-tab-link i {
    font-size: 1rem;
    color: #a5b3cb;
    transition: all 0.2s ease;
}

.settings-tab-link:hover {
    color: #9a55ff;
    background: #ffffff;
    box-shadow: 0 2px 5px rgba(154, 85, 255, 0.1);
}

.settings-tab-link:hover i {
    color: #9a55ff;
}

.settings-tab-link.active {
    color: #9a55ff;
    background: #ffffff;
    box-shadow: 0 2px 8px rgba(154, 85, 255, 0.15);
    font-weight: 600;
}

.settings-tab-link.active i {
    color: #9a55ff;
}

/* Tab Content */
.settings-tab-pane {
    display: none;
}

.settings-tab-pane.active {
    display: block;
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Logo Preview */
.logo-preview {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-top: 0.5rem;
    padding: 0.5rem;
    background: #f8f9fa;
    border-radius: 8px;
}

.logo-preview img {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 8px;
    border: 1px solid #e9ecef;
}

.logo-preview-info {
    flex: 1;
}

.logo-preview-info span {
    display: block;
    font-weight: 500;
    color: #2c2e3f;
    font-size: 0.9rem;
}

.logo-preview-info small {
    color: #6c7383;
    font-size: 0.7rem;
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
}

.btn-gradient-secondary {
    background: #6c757d;
    color: #ffffff;
}

.btn-gradient-secondary:hover {
    background: #5a6268;
}

.btn-gradient-success {
    background: linear-gradient(135deg, #28a745, #5cb85c);
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
}

.btn-gradient-success:hover {
    background: linear-gradient(135deg, #218838, #4cae4c);
    box-shadow: 0 6px 16px rgba(40, 167, 69, 0.4);
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

.badge.badge-info {
    background: linear-gradient(135deg, #17a2b8, #5bc0de);
    color: #ffffff;
}

.badge.badge-success {
    background: linear-gradient(135deg, #28a745, #5cb85c);
    color: #ffffff;
}

.badge.badge-warning {
    background: linear-gradient(135deg, #ffc107, #ffdb6d);
    color: #2c2e3f;
}

/* Responsive */
@media (max-width: 576px) {
    .settings-tab-link {
        padding: 8px 12px;
        font-size: 0.8rem;
    }

    .settings-tab-link i {
        font-size: 0.9rem;
    }
}

/* DataTables Custom Styling */
.dataTables_filter,
.dataTables_length,
.dataTables_paginate,
.dataTables_info {
    display: none !important;
}

.sorting, .sorting_asc, .sorting_desc {
    cursor: pointer;
}

.mdi {
    vertical-align: middle;
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
                            Kelola pengaturan perusahaan dan aplikasi
                        </p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-cog" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Settings Tabs -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- Tab Navigation -->
                    <div class="settings-tabs-wrapper overflow-auto mb-4">
                        <ul class="settings-tabs" id="settingsTab" role="tablist">
                            <li class="settings-tab-item">
                                <a class="settings-tab-link active" id="company-tab" data-bs-toggle="tab" href="#company" role="tab">
                                    <i class="mdi mdi-domain"></i>
                                    <span>Profil Perusahaan</span>
                                </a>
                            </li>
                            <li class="settings-tab-item">
                                <a class="settings-tab-link" id="app-tab" data-bs-toggle="tab" href="#app" role="tab">
                                    <i class="mdi mdi-cog"></i>
                                    <span>Pengaturan Aplikasi</span>
                                </a>
                            </li>
                            <li class="settings-tab-item">
                                <a class="settings-tab-link" id="branding-tab" data-bs-toggle="tab" href="#branding" role="tab">
                                    <i class="mdi mdi-palette"></i>
                                    <span>Branding</span>
                                </a>
                            </li>
                            <li class="settings-tab-item">
                                <a class="settings-tab-link" id="notification-tab" data-bs-toggle="tab" href="#notification" role="tab">
                                    <i class="mdi mdi-bell"></i>
                                    <span>Notifikasi</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Tab Content -->
                    <div class="tab-content" id="settingsTabContent">
                        <!-- TAB 1: PROFIL PERUSAHAAN -->
                        <div class="settings-tab-pane active" id="company" role="tabpanel">
                            <form id="formCompany">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                <i class="mdi mdi-domain me-1"></i>Nama Perusahaan / PT
                                            </label>
                                            <input type="text" class="form-control" name="company_name" value="PT Properti Management" placeholder="PT Properti Management">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                <i class="mdi mdi-card-account-details me-1"></i>NPWP
                                            </label>
                                            <input type="text" class="form-control" name="npwp" value="01.234.567.8-123.000" placeholder="01.234.567.8-123.000">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>
                                                <i class="mdi mdi-map-marker me-1"></i>Alamat Lengkap
                                            </label>
                                            <textarea class="form-control" name="address" rows="3">Jl. Sudirman No. 123, Jakarta Selatan 12190</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>
                                                <i class="mdi mdi-city me-1"></i>Kota
                                            </label>
                                            <input type="text" class="form-control" name="city" value="Jakarta Selatan">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>
                                                <i class="mdi mdi-map me-1"></i>Provinsi
                                            </label>
                                            <input type="text" class="form-control" name="province" value="DKI Jakarta">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>
                                                <i class="mdi mdi-mailbox me-1"></i>Kode Pos
                                            </label>
                                            <input type="text" class="form-control" name="postal_code" value="12190">
                                        </div>
                                    </div>
                                </div>

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
                                                <input type="text" class="form-control" name="phone" value="1234567">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>
                                                <i class="mdi mdi-whatsapp me-1"></i>No. WhatsApp
                                            </label>
                                            <input type="text" class="form-control" name="whatsapp" value="081234567890">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>
                                                <i class="mdi mdi-email me-1"></i>Email
                                            </label>
                                            <input type="email" class="form-control" name="email" value="info@propertimanagement.com">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                <i class="mdi mdi-web me-1"></i>Website
                                            </label>
                                            <input type="text" class="form-control" name="website" value="www.propertimanagement.com">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                <i class="mdi mdi-calendar me-1"></i>Tanggal Berdiri
                                            </label>
                                            <input type="date" class="form-control" name="founded_date" value="2010-01-01">
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <div class="d-flex justify-content-end gap-2">
                                    <button type="reset" class="btn btn-gradient-secondary">Batal</button>
                                    <button type="submit" class="btn btn-gradient-primary" onclick="alert('Data perusahaan berhasil disimpan (demo)'); return false;">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>

                        <!-- TAB 2: PENGATURAN APLIKASI -->
                        <div class="settings-tab-pane" id="app" role="tabpanel">
                            <form id="formApp">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>
                                                <i class="mdi mdi-currency-usd me-1"></i>Mata Uang
                                            </label>
                                            <select class="form-control" name="currency">
                                                <option value="IDR" selected>Rupiah (Rp)</option>
                                                <option value="USD">Dolar AS (USD)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>
                                                <i class="mdi mdi-clock-outline me-1"></i>Zona Waktu
                                            </label>
                                            <select class="form-control" name="timezone">
                                                <option value="Asia/Jakarta" selected>Asia/Jakarta (WIB)</option>
                                                <option value="Asia/Makassar">Asia/Makassar (WITA)</option>
                                                <option value="Asia/Jayapura">Asia/Jayapura (WIT)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>
                                                <i class="mdi mdi-calendar me-1"></i>Format Tanggal
                                            </label>
                                            <select class="form-control" name="date_format">
                                                <option value="dd/mm/yyyy" selected>dd/mm/yyyy</option>
                                                <option value="yyyy-mm-dd">yyyy-mm-dd</option>
                                                <option value="mm/dd/yyyy">mm/dd/yyyy</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>
                                                <i class="mdi mdi-ruler-square me-1"></i>Satuan Luas
                                            </label>
                                            <select class="form-control" name="area_unit">
                                                <option value="m2" selected>Meter Persegi (m²)</option>
                                                <option value="ha">Hektar (ha)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>
                                                <i class="mdi mdi-calculator me-1"></i>Jumlah Desimal
                                            </label>
                                            <select class="form-control" name="decimal_places">
                                                <option value="0">0 (contoh: 1.000.000)</option>
                                                <option value="2" selected>2 (contoh: 1.000.000,00)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>
                                                <i class="mdi mdi-percent me-1"></i>PPN Default
                                            </label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" name="default_ppn" value="11" step="0.1">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <div class="d-flex justify-content-end gap-2">
                                    <button type="reset" class="btn btn-gradient-secondary">Batal</button>
                                    <button type="submit" class="btn btn-gradient-primary" onclick="alert('Pengaturan aplikasi berhasil disimpan (demo)'); return false;">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>

                        <!-- TAB 3: BRANDING -->
                        <div class="settings-tab-pane" id="branding" role="tabpanel">
                            <form id="formBranding">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                <i class="mdi mdi-format-title me-1"></i>Judul Aplikasi
                                            </label>
                                            <input type="text" class="form-control" name="app_name" value="Properti Management">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                <i class="mdi mdi-palette me-1"></i>Warna Utama
                                            </label>
                                            <div class="input-group">
                                                <input type="color" class="form-control" name="primary_color" value="#9a55ff" style="height: 42px; padding: 4px;">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">#9a55ff</span>
                                                </div>
                                            </div>
                                            <small class="text-muted">Klik kotak warna untuk memilih warna</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                <i class="mdi mdi-image me-1"></i>Logo Perusahaan
                                            </label>
                                            <div class="file-upload-modern">
                                                <input type="file" id="uploadLogo" name="logo" accept=".jpg,.jpeg,.png,.svg">
                                                <div class="file-upload-label">
                                                    <i class="mdi mdi-cloud-upload"></i>
                                                    <div class="file-upload-info">
                                                        <span class="file-name-text">Klik untuk upload logo</span>
                                                        <small>Format: JPG, PNG, SVG (Max 2MB)</small>
                                                    </div>
                                                    <span class="file-upload-size file-size-text"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                <i class="mdi mdi-image me-1"></i>Favicon
                                            </label>
                                            <div class="file-upload-modern">
                                                <input type="file" id="uploadFavicon" name="favicon" accept=".ico,.png">
                                                <div class="file-upload-label">
                                                    <i class="mdi mdi-cloud-upload"></i>
                                                    <div class="file-upload-info">
                                                        <span class="file-name-text">Klik untuk upload favicon</span>
                                                        <small>Format: ICO, PNG (16x16, 32x32)</small>
                                                    </div>
                                                    <span class="file-upload-size file-size-text"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Preview Logo -->
                                <div class="logo-preview">
                                    <img src="https://via.placeholder.com/60x60/9a55ff/ffffff?text=Logo" alt="Logo Preview">
                                    <div class="logo-preview-info">
                                        <span>logo-properti-management.png</span>
                                        <small>Ukuran: 124 KB | Terakhir diupload: 20 Feb 2026</small>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <div class="d-flex justify-content-end gap-2">
                                    <button type="reset" class="btn btn-gradient-secondary">Batal</button>
                                    <button type="submit" class="btn btn-gradient-primary" onclick="alert('Branding berhasil disimpan (demo)'); return false;">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>

                        <!-- TAB 4: NOTIFIKASI -->
                        <div class="settings-tab-pane" id="notification" role="tabpanel">
                            <form id="formNotification">
                                @csrf
                                <div class="alert alert-info d-flex align-items-start gap-2 mb-4" style="background: linear-gradient(135deg, #d1ecf1, #bee5eb); border-left: 4px solid #17a2b8;">
                                    <i class="mdi mdi-information-outline mt-1 flex-shrink-0" style="color: #17a2b8;"></i>
                                    <span>Pengaturan notifikasi akan segera hadir di versi berikutnya.</span>
                                </div>

                                <div class="text-center py-5">
                                    <i class="mdi mdi-bell" style="font-size: 5rem; color: #e0e4e9;"></i>
                                    <h5 class="mt-3 text-muted">Fitur Notifikasi Sedang dalam Pengembangan</h5>
                                    <p class="text-muted">Kami akan segera menambahkan fitur notifikasi email, WhatsApp, dan in-app.</p>
                                </div>
                            </form>
                        </div>
                    </div>
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
<script>
$(document).ready(function() {
    // File upload preview untuk logo
    $('#uploadLogo, #uploadFavicon').change(function(e) {
        const fileName = e.target.files[0]?.name;
        const fileSize = e.target.files[0]?.size;
        const $fileUpload = $(this).closest('.file-upload-modern');
        const $fileNameSpan = $fileUpload.find('.file-upload-info span');
        const $fileSizeSpan = $fileUpload.find('.file-upload-size');

        if (fileName) {
            $fileNameSpan.text(fileName.length > 40 ? fileName.substring(0, 40) + '...' : fileName);
            if (fileSize) {
                const sizeInMB = (fileSize / (1024 * 1024)).toFixed(2);
                $fileSizeSpan.text(sizeInMB + ' MB');
            }
        } else {
            const inputId = $(this).attr('id');
            if (inputId === 'uploadLogo') {
                $fileNameSpan.text('Klik untuk@extends('layouts.partial.app')

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
}

.form-control:focus {
    border-color: #9a55ff;
    box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.1);
    outline: none;
}

select.form-control {
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%239a55ff' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 0.75rem center;
    background-size: 12px;
    padding-right: 2rem;
}

textarea.form-control {
    min-height: 80px;
    resize: vertical;
}

/* Input Group */
.input-group {
    display: flex;
    align-items: center;
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
}

.input-group .form-control {
    border-radius: 0 8px 8px 0;
}

/* File Upload */
.file-upload-modern {
    position: relative;
    width: 100%;
    margin-bottom: 1rem;
}

.file-upload-modern input[type="file"] {
    position: absolute;
    opacity: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
    z-index: 2;
}

.file-upload-label {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    gap: 8px;
    padding: 1.5rem 1rem;
    background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
    border: 2px dashed #d0d4db;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
}

@media (min-width: 576px) {
    .file-upload-label {
        flex-direction: row;
        text-align: left;
        gap: 12px;
        padding: 1rem 1.5rem;
    }
}

.file-upload-modern:hover .file-upload-label {
    border-color: #9a55ff;
    background: linear-gradient(135deg, #f1f0ff, #f8f9fa);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(154, 85, 255, 0.1);
}

.file-upload-label i {
    font-size: 2rem;
    color: #9a55ff;
    background: rgba(154, 85, 255, 0.1);
    padding: 12px;
    border-radius: 50%;
}

.file-upload-info {
    flex: 1;
}

.file-upload-info span {
    display: block;
    font-weight: 600;
    color: #2c2e3f;
    font-size: 0.9rem;
    margin-bottom: 4px;
}

.file-upload-info small {
    color: #6c7383;
    font-size: 0.75rem;
    display: block;
}

.file-upload-size {
    font-size: 0.8rem;
    color: #9a55ff;
    font-weight: 600;
    background: rgba(154, 85, 255, 0.1);
    padding: 6px 12px;
    border-radius: 20px;
    white-space: nowrap;
}

/* Logo Preview */
.logo-preview {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-top: 0.5rem;
    padding: 0.5rem;
    background: #f8f9fa;
    border-radius: 8px;
}

.logo-preview img {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 8px;
    border: 1px solid #e9ecef;
}

.logo-preview-info {
    flex: 1;
}

.logo-preview-info span {
    display: block;
    font-weight: 500;
    color: #2c2e3f;
    font-size: 0.9rem;
}

.logo-preview-info small {
    color: #6c7383;
    font-size: 0.7rem;
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
}

.btn-gradient-secondary {
    background: #6c757d;
    color: #ffffff;
}

.btn-gradient-secondary:hover {
    background: #5a6268;
}

.btn-gradient-success {
    background: linear-gradient(135deg, #28a745, #5cb85c);
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
}

.btn-gradient-success:hover {
    background: linear-gradient(135deg, #218838, #4cae4c);
    box-shadow: 0 6px 16px rgba(40, 167, 69, 0.4);
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

.badge.badge-info {
    background: linear-gradient(135deg, #17a2b8, #5bc0de);
    color: #ffffff;
}

.badge.badge-success {
    background: linear-gradient(135deg, #28a745, #5cb85c);
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

/* Responsive */
@media (max-width: 576px) {
    .logo-preview {
        flex-direction: column;
        text-align: center;
    }
}

/* DataTables Custom Styling */
.dataTables_filter,
.dataTables_length,
.dataTables_paginate,
.dataTables_info {
    display: none !important;
}

.sorting, .sorting_asc, .sorting_desc {
    cursor: pointer;
}

.mdi {
    vertical-align: middle;
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
                            Kelola pengaturan perusahaan dan aplikasi
                        </p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-cog" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Settings Form - Single Tab -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-cog me-2 text-primary"></i>
                        Pengaturan Lengkap
                    </h5>
                </div>
                <div class="card-body">
                    <form id="formSettings">
                        @csrf

                        <!-- PROFIL PERUSAHAAN -->
                        <div class="section-title">
                            <i class="mdi mdi-domain"></i> Profil Perusahaan
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        <i class="mdi mdi-domain me-1"></i>Nama Perusahaan / PT
                                    </label>
                                    <input type="text" class="form-control" name="company_name" value="PT Properti Management" placeholder="PT Properti Management">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        <i class="mdi mdi-card-account-details me-1"></i>NPWP
                                    </label>
                                    <input type="text" class="form-control" name="npwp" value="01.234.567.8-123.000" placeholder="01.234.567.8-123.000">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>
                                        <i class="mdi mdi-map-marker me-1"></i>Alamat Lengkap
                                    </label>
                                    <textarea class="form-control" name="address" rows="3">Jl. Sudirman No. 123, Jakarta Selatan 12190</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>
                                        <i class="mdi mdi-city me-1"></i>Kota
                                    </label>
                                    <input type="text" class="form-control" name="city" value="Jakarta Selatan">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>
                                        <i class="mdi mdi-map me-1"></i>Provinsi
                                    </label>
                                    <input type="text" class="form-control" name="province" value="DKI Jakarta">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>
                                        <i class="mdi mdi-mailbox me-1"></i>Kode Pos
                                    </label>
                                    <input type="text" class="form-control" name="postal_code" value="12190">
                                </div>
                            </div>
                        </div>

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
                                        <input type="text" class="form-control" name="phone" value="1234567">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>
                                        <i class="mdi mdi-whatsapp me-1"></i>No. WhatsApp
                                    </label>
                                    <input type="text" class="form-control" name="whatsapp" value="081234567890">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>
                                        <i class="mdi mdi-email me-1"></i>Email
                                    </label>
                                    <input type="email" class="form-control" name="email" value="info@propertimanagement.com">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        <i class="mdi mdi-web me-1"></i>Website
                                    </label>
                                    <input type="text" class="form-control" name="website" value="www.propertimanagement.com">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        <i class="mdi mdi-calendar me-1"></i>Tanggal Berdiri
                                    </label>
                                    <input type="date" class="form-control" name="founded_date" value="2010-01-01">
                                </div>
                            </div>
                        </div>

                        <!-- BRANDING -->
                        <div class="section-title mt-4">
                            <i class="mdi mdi-palette"></i> Branding
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        <i class="mdi mdi-format-title me-1"></i>Judul Aplikasi
                                    </label>
                                    <input type="text" class="form-control" name="app_name" value="Properti Management">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        <i class="mdi mdi-image me-1"></i>Logo Perusahaan
                                    </label>
                                    <div class="file-upload-modern">
                                        <input type="file" id="uploadLogo" name="logo" accept=".jpg,.jpeg,.png,.svg">
                                        <div class="file-upload-label">
                                            <i class="mdi mdi-cloud-upload"></i>
                                            <div class="file-upload-info">
                                                <span class="file-name-text">Klik untuk upload logo</span>
                                                <small>Format: JPG, PNG, SVG (Max 2MB)</small>
                                            </div>
                                            <span class="file-upload-size file-size-text"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        <i class="mdi mdi-image me-1"></i>Favicon
                                    </label>
                                    <div class="file-upload-modern">
                                        <input type="file" id="uploadFavicon" name="favicon" accept=".ico,.png">
                                        <div class="file-upload-label">
                                            <i class="mdi mdi-cloud-upload"></i>
                                            <div class="file-upload-info">
                                                <span class="file-name-text">Klik untuk upload favicon</span>
                                                <small>Format: ICO, PNG (16x16, 32x32)</small>
                                            </div>
                                            <span class="file-upload-size file-size-text"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Preview Logo -->
                        <div class="logo-preview">
                            <img src="https://via.placeholder.com/60x60/9a55ff/ffffff?text=Logo" alt="Logo Preview">
                            <div class="logo-preview-info">
                                <span>logo-properti-management.png</span>
                                <small>Ukuran: 124 KB | Terakhir diupload: 20 Feb 2026</small>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Tombol Aksi -->
                        <div class="d-flex flex-wrap justify-content-end gap-2">
                            <button type="reset" class="btn btn-gradient-secondary">Batal</button>
                            <button type="submit" class="btn btn-gradient-primary" onclick="alert('Pengaturan berhasil disimpan (demo)'); return false;">
                                <i class="mdi mdi-content-save me-1"></i>Simpan Perubahan
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
<script>
$(document).ready(function() {
    // File upload preview untuk logo
    $('#uploadLogo, #uploadFavicon').change(function(e) {
        const fileName = e.target.files[0]?.name;
        const fileSize = e.target.files[0]?.size;
        const $fileUpload = $(this).closest('.file-upload-modern');
        const $fileNameSpan = $fileUpload.find('.file-upload-info span');
        const $fileSizeSpan = $fileUpload.find('.file-upload-size');

        if (fileName) {
            $fileNameSpan.text(fileName.length > 40 ? fileName.substring(0, 40) + '...' : fileName);
            if (fileSize) {
                const sizeInMB = (fileSize / (1024 * 1024)).toFixed(2);
                $fileSizeSpan.text(sizeInMB + ' MB');
            }
        } else {
            const inputId = $(this).attr('id');
            if (inputId === 'uploadLogo') {
                $fileNameSpan.text('Klik untuk upload logo');
            } else {
                $fileNameSpan.text('Klik untuk upload favicon');
            }
            $fileSizeSpan.text('');
        }
    });
});
</script>
@endpush
@endsection upload logo');
            } else {
                $fileNameSpan.text('Klik untuk upload favicon');
            }
            $fileSizeSpan.text('');
        }
    });

    // Reset form saat tab diganti (optional)
    $('#settingsTab a').on('click', function() {
        // Bisa ditambahkan logic jika diperlukan
    });
});
</script>
@endpush
@endsection
