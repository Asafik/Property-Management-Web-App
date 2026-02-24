@extends('layouts.partial.app')

@section('title', 'Survey KPR - Properti Management')

@section('content')

<style>
    /* ===== STYLE CSS KHUSUS UNTUK HALAMAN SURVEY ===== */
    /* Form Styling */
    .survey-form-group {
        margin-bottom: 1rem;
    }

    @media (min-width: 768px) {
        .survey-form-group {
            margin-bottom: 1.2rem;
        }
    }

    .survey-form-group label {
        font-size: 0.8rem;
        font-weight: 600;
        color: #9a55ff !important;
        margin-bottom: 0.3rem;
        letter-spacing: 0.3px;
        font-family: 'Nunito', sans-serif;
        display: block;
    }

    @media (min-width: 768px) {
        .survey-form-group label {
            font-size: 0.85rem;
            margin-bottom: 0.4rem;
        }
    }

    .survey-form-control {
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
        .survey-form-control {
            padding: 0.6rem 0.75rem;
            font-size: 0.9rem;
            border-radius: 8px;
        }
    }

    .survey-form-control:focus {
        border-color: #9a55ff;
        box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.1);
        outline: none;
    }

    /* File Upload Styling */
    .survey-file-upload {
        position: relative;
        width: 100%;
    }

    .survey-file-upload input[type="file"] {
        position: absolute;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
        z-index: 2;
    }

    .survey-file-upload .survey-file-label {
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
        .survey-file-upload .survey-file-label {
            flex-direction: row;
            text-align: left;
            gap: 8px;
            padding: 0.75rem 1rem;
            min-height: auto;
        }
    }

    .survey-file-upload:hover .survey-file-label {
        border-color: #9a55ff;
        background: linear-gradient(135deg, #f1f0ff, #f8f9fa);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(154, 85, 255, 0.1);
    }

    .survey-file-upload .survey-file-label i {
        font-size: 1.6rem;
        color: #9a55ff;
        background: rgba(154, 85, 255, 0.1);
        padding: 8px;
        border-radius: 50%;
    }

    .survey-file-upload .survey-file-label .survey-file-info {
        flex: 1;
        width: 100%;
    }

    .survey-file-upload .survey-file-label .survey-file-info span {
        display: block;
        font-weight: 600;
        color: #2c2e3f;
        font-size: 0.8rem;
        word-break: break-word;
    }

    .survey-file-upload .survey-file-label .survey-file-info small {
        color: #6c7383;
        font-size: 0.65rem;
        display: block;
        margin-top: 2px;
    }

    /* Input Group */
    .survey-input-group {
        display: flex;
        align-items: stretch;
        width: 100%;
    }

    .survey-input-group-prepend {
        display: flex;
    }

    .survey-input-group-text {
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

    .survey-input-group .survey-form-control {
        border-radius: 0 10px 10px 0;
    }

    /* Button Styling */
    .survey-btn {
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
        .survey-btn {
            width: auto;
            padding: 0.5rem 1.2rem;
        }
    }

    .survey-btn-primary {
        background: linear-gradient(to right, #da8cff, #9a55ff);
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(154, 85, 255, 0.3);
    }

    .survey-btn-primary:hover {
        background: linear-gradient(to right, #c77cff, #8a45e6);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(154, 85, 255, 0.4);
    }

    .survey-btn-success {
        background: linear-gradient(135deg, #28a745, #5cb85c);
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
    }

    .survey-btn-success:hover {
        background: linear-gradient(135deg, #218838, #4cae4c);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(40, 167, 69, 0.4);
    }

    .survey-btn-outline-primary {
        background: transparent;
        border: 1px solid #9a55ff;
        color: #9a55ff;
    }

    .survey-btn-outline-primary:hover {
        background: linear-gradient(135deg, #9a55ff, #da8cff);
        color: #ffffff;
        border-color: transparent;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(154, 85, 255, 0.3);
    }

    .survey-btn-outline-secondary {
        background: transparent;
        border: 1px solid #e9ecef;
        color: #6c7383;
    }

    .survey-btn-outline-secondary:hover {
        background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
        color: #2c2e3f;
        border-color: #9a55ff;
        transform: translateY(-2px);
    }

    .survey-btn-outline-warning {
        background: transparent;
        border: 1px solid #ffc107;
        color: #ffc107;
    }

    .survey-btn-outline-warning:hover {
        background: linear-gradient(135deg, #ffc107, #ffdb6d);
        color: #2c2e3f;
        border-color: transparent;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 193, 7, 0.3);
    }

    /* Text colors */
    .survey-text-muted {
        color: #a5b3cb !important;
        font-size: 0.7rem;
        display: block;
        margin-top: 0.2rem;
    }

    .survey-text-primary {
        color: #9a55ff !important;
    }

    .survey-text-danger {
        color: #dc3545 !important;
    }

    .survey-text-success {
        color: #28a745 !important;
    }

    /* Divider */
    .survey-hr {
        border-top: 1px solid #e9ecef;
        margin: 0.8rem 0;
    }

    /* ===== MODERN CHECKBOX STYLING UNTUK SURVEY ===== */
    .survey-checkbox-group {
        display: flex;
        flex-wrap: wrap;
        gap: 0.8rem;
        margin-top: 0.3rem;
    }

    .survey-checkbox-wrapper {
        position: relative;
        flex: 1 1 calc(50% - 0.8rem);
        min-width: 160px;
    }

    @media (min-width: 768px) {
        .survey-checkbox-wrapper {
            flex: 1 1 calc(33.333% - 0.8rem);
        }
    }

    @media (min-width: 992px) {
        .survey-checkbox-wrapper {
            flex: 1 1 calc(25% - 0.8rem);
        }
    }

    .survey-checkbox-input {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }

    .survey-checkbox-label {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 0.8rem 1rem;
        background: linear-gradient(135deg, #f9f7ff, #f2ecff);
        border: 2px solid rgba(154, 85, 255, 0.2);
        border-radius: 14px;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(154, 85, 255, 0.08);
    }

    .survey-checkbox-label::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(218, 140, 255, 0.1), rgba(154, 85, 255, 0.1));
        opacity: 0;
        transition: opacity 0.3s ease;
        pointer-events: none;
    }

    .survey-checkbox-wrapper:hover .survey-checkbox-label {
        border-color: #9a55ff;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(154, 85, 255, 0.15);
    }

    .survey-checkbox-wrapper:hover .survey-checkbox-label::before {
        opacity: 1;
    }

    .survey-check-icon {
        font-size: 1.5rem;
        color: #d0d4db;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background: white;
        border-radius: 50%;
        padding: 4px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .survey-checkbox-input:checked + .survey-checkbox-label {
        border-color: #9a55ff;
        background: linear-gradient(135deg, #f1f0ff, #e8e0ff);
        box-shadow: 0 5px 15px rgba(154, 85, 255, 0.2);
    }

    .survey-checkbox-input:checked + .survey-checkbox-label .survey-check-icon {
        color: #9a55ff;
        transform: scale(1.1);
        filter: drop-shadow(0 4px 8px rgba(154, 85, 255, 0.4));
        animation: surveyCheckPulse 0.3s ease;
    }

    .survey-checkbox-input:checked + .survey-checkbox-label .survey-check-text {
        color: #9a55ff;
        font-weight: 600;
    }

    .survey-check-text {
        transition: all 0.3s ease;
        position: relative;
        font-size: 0.9rem;
        color: #2c2e3f;
        font-weight: 500;
    }

    .survey-check-text::before {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background: linear-gradient(to right, #da8cff, #9a55ff);
        transition: width 0.3s ease;
    }

    .survey-checkbox-input:checked + .survey-checkbox-label .survey-check-text::before {
        width: 100%;
    }

    @keyframes surveyCheckPulse {
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

    /* Grid System */
    .survey-row {
        display: flex;
        flex-wrap: wrap;
        margin-right: -0.5rem;
        margin-left: -0.5rem;
    }

    .survey-col-12,
    .survey-col-md-4,
    .survey-col-md-6 {
        position: relative;
        width: 100%;
        padding-right: 0.5rem;
        padding-left: 0.5rem;
        margin-bottom: 0.5rem;
    }

    .survey-col-12 {
        flex: 0 0 100%;
        max-width: 100%;
    }

    @media (min-width: 768px) {
        .survey-col-md-4 {
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
        }

        .survey-col-md-6 {
            flex: 0 0 50%;
            max-width: 50%;
        }
    }

    /* Section Title */
    .survey-section-title {
        font-size: 0.9rem;
        font-weight: 700;
        color: #9a55ff !important;
        margin-bottom: 0.8rem;
        padding-bottom: 0.4rem;
        border-bottom: 2px solid #e9ecef;
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .survey-section-title i {
        color: #9a55ff;
        font-size: 1rem;
        background: rgba(154, 85, 255, 0.1);
        padding: 6px;
        border-radius: 8px;
    }

    /* Responsive untuk mobile */
    @media (max-width: 576px) {
        .survey-checkbox-group {
            gap: 0.5rem;
        }

        .survey-checkbox-wrapper {
            flex: 0 0 calc(50% - 0.5rem);
            min-width: auto;
        }

        .survey-checkbox-label {
            padding: 0.6rem 0.8rem;
        }

        .survey-check-text {
            font-size: 0.8rem;
        }

        .survey-check-icon {
            font-size: 1.2rem;
        }
    }

    @media (max-width: 375px) {
        .survey-checkbox-wrapper {
            flex: 0 0 100%;
        }
    }

</style>

<div class="row">
    <div class="col-12">
        <!-- Header Info Customer -->
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap align-items-center gap-3">
                    <!-- Avatar -->
                    <div class="flex-shrink-0">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="mdi mdi-account" style="font-size: 24px;"></i>
                        </div>
                    </div>

                    <!-- Info Customer -->
                    <div class="flex-grow-1">
                        <h4 class="mb-1">Budi Santoso</h4>
                        <p class="text-muted mb-0">Booking ID: #INV/202502/001</p>
                    </div>

                    <!-- Info Unit -->
                    <div class="mt-3 mt-sm-0">
                        <div class="d-flex flex-wrap gap-3">
                            <div>
                                <small class="text-muted d-block">Unit</small>
                                <span class="fw-medium">The Lavender - Tipe 45</span>
                            </div>
                            <div>
                                <small class="text-muted d-block">Blok/No</small>
                                <span class="fw-medium">C/12</span>
                            </div>
                            <div>
                                <small class="text-muted d-block">Harga Unit</small>
                                <span class="fw-medium text-primary">Rp 450 Juta</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Row untuk Progress dan Detail -->
<div class="row mt-4">
    <!-- Kolom Kiri: Progress Timeline -->
    <div class="col-12 col-lg-8 mb-4 mb-lg-0">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="mdi mdi-timeline-text me-2 text-primary"></i>
                    Tahapan Survey KPR
                </h5>

                <!-- Progress Bar -->
                <div class="mb-4">
                    <div class="d-flex flex-wrap justify-content-between mb-2">
                        <span class="text-muted">Progress Survey</span>
                        <span class="text-primary">Tahap 3 dari 5</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                <!-- Timeline Steps -->
                <div class="timeline-steps">
                    <div class="row g-2 g-md-0">
                        <div class="col-4 col-md text-center mb-3 mb-md-0">
                            <div class="step completed">
                                <div class="step-icon bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 35px; height: 35px;">
                                    <i class="mdi mdi-check" style="font-size: 18px;"></i>
                                </div>
                                <span class="d-block text-success small fw-medium">Pengajuan</span>
                                <small class="text-muted d-none d-sm-block">12 Feb 2025</small>
                            </div>
                        </div>
                        <div class="col-4 col-md text-center mb-3 mb-md-0">
                            <div class="step completed">
                                <div class="step-icon bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 35px; height: 35px;">
                                    <i class="mdi mdi-check" style="font-size: 18px;"></i>
                                </div>
                                <span class="d-block text-success small fw-medium">Verifikasi</span>
                                <small class="text-muted d-none d-sm-block">14 Feb 2025</small>
                            </div>
                        </div>
                        <div class="col-4 col-md text-center mb-3 mb-md-0">
                            <div class="step active">
                                <div class="step-icon bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 35px; height: 35px;">
                                    <i class="mdi mdi-home" style="font-size: 18px;"></i>
                                </div>
                                <span class="d-block small fw-medium">Survey</span>
                                <small class="text-muted d-none d-sm-block">Sedang Proses</small>
                            </div>
                        </div>
                        <div class="col-4 col-md text-center mt-2 mt-md-0">
                            <div class="step">
                                <div class="step-icon bg-light text-muted rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 35px; height: 35px;">
                                    <i class="mdi mdi-handshake" style="font-size: 18px;"></i>
                                </div>
                                <span class="d-block text-muted small fw-medium">Akad</span>
                                <small class="text-muted d-none d-sm-block">Menunggu</small>
                            </div>
                        </div>
                        <div class="col-4 col-md text-center mt-2 mt-md-0">
                            <div class="step">
                                <div class="step-icon bg-light text-muted rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 35px; height: 35px;">
                                    <i class="mdi mdi-cash" style="font-size: 18px;"></i>
                                </div>
                                <span class="d-block text-muted small fw-medium">Cair</span>
                                <small class="text-muted d-none d-sm-block">Menunggu</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kolom Kanan: Detail KPR -->
    <div class="col-12 col-lg-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="mdi mdi-bank me-2 text-primary"></i>
                    Detail KPR
                </h5>

                <div class="detail-info">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Bank Tujuan</span>
                        <span class="fw-medium">Bank ABC Syariah</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Jumlah Pinjaman</span>
                        <span class="fw-medium">Rp 360 Juta</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Tenor</span>
                        <span class="fw-medium">15 Tahun</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Angsuran/bln</span>
                        <span class="fw-medium text-primary">Rp 3.2 Juta</span>
                    </div>
                </div>

                <hr class="my-3">

                <div class="mt-3">
                    <small class="text-muted d-block mb-2">Ditangani oleh:</small>
                    <div class="d-flex align-items-center">
                        <div class="bg-light rounded-circle p-2 me-2">
                            <i class="mdi mdi-account-tie text-primary"></i>
                        </div>
                        <div>
                            <span class="fw-medium d-block">Ahmad Rizki</span>
                            <small class="text-muted">Marketing Officer</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Row untuk Survey -->
<div class="row mt-4">
    <!-- Form Survey -->
    <div class="col-12 col-lg-8 mb-4 mb-lg-0">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="mdi mdi-home-map-marker me-2 text-primary"></i>
                    Form Survey Lapangan
                </h5>

                <!-- Alert Info -->
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <i class="mdi mdi-information-outline me-2"></i>
                    Isi hasil survey unit dengan lengkap. Data ini akan digunakan bank untuk penilaian.
                </div>

                <!-- Info Jadwal Survey -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="survey-form-group">
                            <label>Tanggal Survey</label>
                            <input type="date" class="survey-form-control" value="2025-02-20">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="survey-form-group">
                            <label>Jam Survey</label>
                            <input type="time" class="survey-form-control" value="10:00">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="survey-form-group">
                            <label>Surveyor</label>
                            <select class="survey-form-control">
                                <option>Pilih Surveyor</option>
                                <option selected>Hendra Wijaya (Tim Bank)</option>
                                <option>Bambang Supriadi (Tim Bank)</option>
                                <option>Rudi Hermawan (Internal)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <hr class="my-3">

                <h6 class="mb-3 fw-bold" style="color: #9a55ff;">Hasil Penilaian Unit</h6>

                <div class="row">
                    <div class="col-md-6">
                        <div class="survey-form-group">
                            <label>Nilai Pasar Unit <span class="text-danger">*</span></label>
                            <div class="survey-input-group">
                                <div class="survey-input-group-prepend">
                                    <span class="survey-input-group-text">Rp</span>
                                </div>
                                <input type="text" class="survey-form-control" value="450.000.000">
                            </div>
                            <small class="survey-text-muted">Sesuai harga jual unit</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="survey-form-group">
                            <label>Nilai Appraisal <span class="text-danger">*</span></label>
                            <div class="survey-input-group">
                                <div class="survey-input-group-prepend">
                                    <span class="survey-input-group-text">Rp</span>
                                </div>
                                <input type="text" class="survey-form-control" value="445.000.000">
                            </div>
                            <small class="survey-text-muted">Penilaian dari surveyor</small>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="survey-form-group">
                            <label>Luas Tanah</label>
                            <div class="survey-input-group">
                                <input type="text" class="survey-form-control" value="90">
                                <div class="survey-input-group-prepend">
                                    <span class="survey-input-group-text">m²</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="survey-form-group">
                            <label>Luas Bangunan</label>
                            <div class="survey-input-group">
                                <input type="text" class="survey-form-control" value="45">
                                <div class="survey-input-group-prepend">
                                    <span class="survey-input-group-text">m²</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="survey-form-group">
                            <label>Kondisi Bangunan</label>
                            <select class="survey-form-control">
                                <option>Pilih Kondisi</option>
                                <option selected>Baru (0-2 tahun)</option>
                                <option>Baik (2-5 tahun)</option>
                                <option>Cukup (5-10 tahun)</option>
                                <option>Perlu Renovasi</option>
                            </select>
                        </div>
                    </div>
                </div>

                <hr class="my-3">

                <!-- CHECKLIST KONDISI UNIT DENGAN MODERN CHECKBOX -->
                <div class="mb-4">
                    <h6 class="mb-3 fw-bold" style="color: #9a55ff;">
                        <i class="mdi mdi-checkbox-marked-outline me-2"></i>
                        Checklist Kondisi Unit
                    </h6>

                    <div class="survey-checkbox-group">
                        <div class="survey-checkbox-wrapper">
                            <input type="checkbox" class="survey-checkbox-input" id="listrik" checked>
                            <label class="survey-checkbox-label" for="listrik">
                                <i class="mdi mdi-check-circle survey-check-icon"></i>
                                <span class="survey-check-text">Instalasi Listrik</span>
                            </label>
                        </div>

                        <div class="survey-checkbox-wrapper">
                            <input type="checkbox" class="survey-checkbox-input" id="air" checked>
                            <label class="survey-checkbox-label" for="air">
                                <i class="mdi mdi-check-circle survey-check-icon"></i>
                                <span class="survey-check-text">PDAM / Air Bersih</span>
                            </label>
                        </div>

                        <div class="survey-checkbox-wrapper">
                            <input type="checkbox" class="survey-checkbox-input" id="akses" checked>
                            <label class="survey-checkbox-label" for="akses">
                                <i class="mdi mdi-check-circle survey-check-icon"></i>
                                <span class="survey-check-text">Akses Jalan</span>
                            </label>
                        </div>

                        <div class="survey-checkbox-wrapper">
                            <input type="checkbox" class="survey-checkbox-input" id="sertifikat" checked>
                            <label class="survey-checkbox-label" for="sertifikat">
                                <i class="mdi mdi-check-circle survey-check-icon"></i>
                                <span class="survey-check-text">Sertifikat Sesuai</span>
                            </label>
                        </div>

                        <div class="survey-checkbox-wrapper">
                            <input type="checkbox" class="survey-checkbox-input" id="shm" checked>
                            <label class="survey-checkbox-label" for="shm">
                                <i class="mdi mdi-check-circle survey-check-icon"></i>
                                <span class="survey-check-text">SHM / SHGB</span>
                            </label>
                        </div>

                        <div class="survey-checkbox-wrapper">
                            <input type="checkbox" class="survey-checkbox-input" id="imb" checked>
                            <label class="survey-checkbox-label" for="imb">
                                <i class="mdi mdi-check-circle survey-check-icon"></i>
                                <span class="survey-check-text">IMB</span>
                            </label>
                        </div>
                    </div>
                </div>

                <hr class="my-3">

                <h6 class="mb-3 fw-bold" style="color: #9a55ff;">Dokumentasi Survey</h6>

                <div class="row">
                    <div class="col-md-4">
                        <div class="survey-form-group">
                            <label>Foto Tampak Depan</label>
                            <div class="survey-file-upload">
                                <input type="file" id="fotoDepan" name="fotoDepan" accept=".jpg,.jpeg,.png">
                                <div class="survey-file-label">
                                    <i class="mdi mdi-camera"></i>
                                    <div class="survey-file-info">
                                        <span>Upload Foto</span>
                                        <small>Max 5MB</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="survey-form-group">
                            <label>Foto Interior</label>
                            <div class="survey-file-upload">
                                <input type="file" id="fotoInterior" name="fotoInterior" accept=".jpg,.jpeg,.png">
                                <div class="survey-file-label">
                                    <i class="mdi mdi-camera"></i>
                                    <div class="survey-file-info">
                                        <span>Upload Foto</span>
                                        <small>Max 5MB</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="survey-form-group">
                            <label>Foto Lingkungan</label>
                            <div class="survey-file-upload">
                                <input type="file" id="fotoLingkungan" name="fotoLingkungan" accept=".jpg,.jpeg,.png">
                                <div class="survey-file-label">
                                    <i class="mdi mdi-camera"></i>
                                    <div class="survey-file-info">
                                        <span>Upload Foto</span>
                                        <small>Max 5MB</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-3">

                <h6 class="mb-3 fw-bold" style="color: #9a55ff;">Catatan Survey</h6>

                <div class="survey-form-group">
                    <textarea class="survey-form-control" rows="3" placeholder="Contoh: Lokasi strategis dekat jalan raya, lingkungan aman, akses mudah">Lokasi strategis dekat jalan raya, lingkungan aman, akses mudah ke fasilitas umum. Kondisi bangunan baru dan terawat.</textarea>
                </div>

                <hr class="my-3">

                <h6 class="mb-3 fw-bold" style="color: #9a55ff;">Rekomendasi</h6>

                <div class="row">
                    <div class="col-md-6">
                        <div class="survey-form-group">
                            <label>Status Rekomendasi</label>
                            <select class="survey-form-control">
                                <option>Pilih Rekomendasi</option>
                                <option selected>Layak - Sesuai Harga</option>
                                <option>Layak - Dengan Penyesuaian Harga</option>
                                <option>Tidak Layak</option>
                                <option>Perlu Survey Ulang</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="survey-form-group">
                            <label>Persentase Kelayakan</label>
                            <div class="survey-input-group">
                                <input type="text" class="survey-form-control" value="95">
                                <div class="survey-input-group-prepend">
                                    <span class="survey-input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kolom Kanan: Info Survey & Aksi -->
    <div class="col-12 col-lg-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="mdi mdi-clipboard-text me-2 text-primary"></i>
                    Status Survey
                </h5>

                <!-- Status Badge -->
                <div class="text-center mb-4">
                    <span class="badge badge-warning p-2" style="font-size: 14px; background: linear-gradient(135deg, #ffc107, #ffdb6d); color: #2c2e3f;">
                        <i class="mdi mdi-progress-clock me-1"></i>
                        Menunggu Hasil Survey
                    </span>
                </div>

                <!-- Info Survey -->
                <div class="mb-4">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Surveyor</span>
                        <span class="fw-medium">Hendra Wijaya</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Asal Surveyor</span>
                        <span class="fw-medium">Tim Bank ABC</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Tanggal Survey</span>
                        <span class="fw-medium">20 Feb 2025</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Waktu</span>
                        <span class="fw-medium">10:00 WIB</span>
                    </div>
                </div>

                <hr class="my-3">

                <!-- Ringkasan Hasil -->
                <h6 class="mb-3 fw-bold" style="color: #9a55ff;">Ringkasan Hasil</h6>
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Nilai Appraisal</span>
                        <span class="fw-medium">Rp 445 Juta</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Selisih Harga</span>
                        <span class="fw-medium text-danger">- Rp 5 Juta</span>
                    </div>
                </div>

                <!-- Progress Checklist -->
                <h6 class="mb-3 fw-bold" style="color: #9a55ff;">Progress Checklist</h6>
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-muted">Checklist Kondisi</span>
                        <span class="fw-medium">6/6</span>
                    </div>
                    <div class="progress mb-3" style="height: 5px;">
                        <div class="progress-bar bg-success" style="width: 100%;"></div>
                    </div>

                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-muted">Upload Foto</span>
                        <span class="fw-medium">3/3</span>
                    </div>
                    <div class="progress mb-3" style="height: 5px;">
                        <div class="progress-bar bg-success" style="width: 100%;"></div>
                    </div>

                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-muted">Catatan</span>
                        <span class="fw-medium">Lengkap</span>
                    </div>
                    <div class="progress mb-3" style="height: 5px;">
                        <div class="progress-bar bg-success" style="width: 100%;"></div>
                    </div>
                </div>

                <hr class="my-3">

                <!-- Timeline Survey -->
                <h6 class="mb-3 fw-bold" style="color: #9a55ff;">Timeline Survey</h6>
                <div class="timeline">
                    <div class="d-flex mb-3">
                        <div class="me-3">
                            <i class="mdi mdi-check-circle text-success"></i>
                        </div>
                        <div>
                            <span class="d-block fw-medium">Dijadwalkan</span>
                            <small class="text-muted">19 Feb 2025 - 14:30</small>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="me-3">
                            <i class="mdi mdi-progress-clock text-primary"></i>
                        </div>
                        <div>
                            <span class="d-block fw-medium">Survey Berlangsung</span>
                            <small class="text-muted">20 Feb 2025 - 10:00</small>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="me-3">
                            <i class="mdi mdi-clock-outline text-muted"></i>
                        </div>
                        <div>
                            <span class="d-block fw-medium">Hasil Survey</span>
                            <small class="text-muted">Belum diisi</small>
                        </div>
                    </div>
                </div>

                <hr class="my-3">

                <!-- Tombol Aksi -->
                <div class="d-flex flex-column gap-2">
                    <button class="survey-btn survey-btn-success w-100">
                        <i class="mdi mdi-content-save me-2"></i>
                        Simpan Hasil Survey
                    </button>

                    <button class="survey-btn survey-btn-primary w-100">
                        <i class="mdi mdi-check-circle me-2"></i>
                        Selesaikan Survey
                    </button>

                    <button class="survey-btn survey-btn-outline-warning w-100">
                        <i class="mdi mdi-calendar-refresh me-2"></i>
                        Reschedule Survey
                    </button>

                    <button class="survey-btn survey-btn-outline-secondary w-100">
                        <i class="mdi mdi-arrow-left me-2"></i>
                        Kembali ke Proses KPR
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Custom styles untuk konsistensi dengan halaman verifikasi */
    .bg-light {
        background-color: #f8f9fc !important;
    }

    .badge {
        padding: 5px 10px;
        font-weight: 500;
    }

    .timeline .d-flex {
        align-items: flex-start;
    }

    .timeline i {
        font-size: 18px;
    }

    /* Progress steps styling */
    .timeline-steps .step .step-icon {
        transition: all 0.3s ease;
    }

    .timeline-steps .step.completed .step-icon {
        background-color: #28a745 !important;
    }

    .timeline-steps .step.active .step-icon {
        background-color: #9a55ff !important;
        box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.2);
    }

    /* Responsive */
    @media (max-width: 576px) {
        .timeline-steps .step small {
            display: none !important;
        }
        .timeline-steps .step-icon {
            width: 30px !important;
            height: 30px !important;
        }
        .timeline-steps .step-icon i {
            font-size: 16px !important;
        }
    }

    /* Utility */
    .h-100 {
        height: 100%;
    }

    .gap-2 {
        gap: 0.5rem;
    }

    .gap-3 {
        gap: 1rem;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handler untuk file upload - menampilkan nama file
        const fileInputs = document.querySelectorAll('.survey-file-upload input[type="file"]');
        fileInputs.forEach(input => {
            input.addEventListener('change', function(e) {
                const fileName = e.target.files[0]?.name;
                const label = this.closest('.survey-file-upload').querySelector('.survey-file-info span');
                if (fileName && label) {
                    label.textContent = fileName.length > 30 ? fileName.substring(0, 30) + '...' : fileName;
                } else {
                    // Reset ke teks awal
                    const inputName = this.name;
                    if (inputName === 'fotoDepan') {
                        label.textContent = 'Upload Foto';
                    } else if (inputName === 'fotoInterior') {
                        label.textContent = 'Upload Foto';
                    } else if (inputName === 'fotoLingkungan') {
                        label.textContent = 'Upload Foto';
                    }
                }
            });
        });

        // Handler untuk tombol-tombol aksi
        const btnSimpan = document.querySelector('.survey-btn-success');
        if (btnSimpan) {
            btnSimpan.addEventListener('click', function() {
                alert('Hasil survey disimpan');
            });
        }

        const btnSelesaikan = document.querySelector('.survey-btn-primary');
        if (btnSelesaikan) {
            btnSelesaikan.addEventListener('click', function() {
                alert('Survey selesai, lanjut ke tahap berikutnya');
            });
        }
    });
</script>
@endpush
