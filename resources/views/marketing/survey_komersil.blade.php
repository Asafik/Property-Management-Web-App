@extends('layouts.partial.app')

@section('title', 'Survey Komersil - Properti Management')

@section('content')

    <style>
        /* ===== STYLE CSS KHUSUS UNTUK HALAMAN SURVEY KOMERSIL ===== */
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
            /* Tetap warna ungu */
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
            /* Tetap warna ungu */
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
            /* Tetap warna ungu */
            background: linear-gradient(135deg, #f1f0ff, #f8f9fa);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(154, 85, 255, 0.1);
        }

        .survey-file-upload .survey-file-label i {
            font-size: 1.6rem;
            color: #9a55ff;
            /* Tetap warna ungu */
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

        /* Input Group dengan satuan di kiri */
        .survey-input-group.satuan-kiri .survey-input-group-prepend {
            order: 0;
        }

        .survey-input-group.satuan-kiri .survey-input-group-prepend .survey-input-group-text {
            border-radius: 10px 0 0 10px;
            border-right: none;
        }

        .survey-input-group.satuan-kiri .survey-form-control {
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
            /* Gradien ungu */
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

        /* Text colors */
        .survey-text-muted {
            color: #a5b3cb !important;
            font-size: 0.7rem;
            display: block;
            margin-top: 0.2rem;
        }

        .survey-text-primary {
            color: #9a55ff !important;
            /* Ungu */
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

        .survey-checkbox-input:checked+.survey-checkbox-label {
            border-color: #9a55ff;
            background: linear-gradient(135deg, #f1f0ff, #e8e0ff);
            box-shadow: 0 5px 15px rgba(154, 85, 255, 0.2);
        }

        .survey-checkbox-input:checked+.survey-checkbox-label .survey-check-icon {
            color: #9a55ff;
            transform: scale(1.1);
            filter: drop-shadow(0 4px 8px rgba(154, 85, 255, 0.4));
            animation: surveyCheckPulse 0.3s ease;
        }

        .survey-checkbox-input:checked+.survey-checkbox-label .survey-check-text {
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

        .survey-checkbox-input:checked+.survey-checkbox-label .survey-check-text::before {
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

        /* Badge untuk komersil */
        .badge-komersil {
            background: linear-gradient(135deg, #da8cff, #9a55ff);
            /* Gradien ungu */
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.75rem;
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
            /* Ungu */
            box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.2);
        }

        /* Responsive untuk form rekomendasi */
        .rekomendasi-row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -0.25rem;
        }

        .rekomendasi-col {
            flex: 1;
            padding: 0 0.25rem;
            min-width: 120px;
        }

        @media (max-width: 768px) {
            .rekomendasi-col {
                flex: 0 0 100%;
                margin-bottom: 0.5rem;
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
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 50px; height: 50px; background: linear-gradient(135deg, #da8cff, #9a55ff) !important;">
                                <i class="mdi mdi-domain" style="font-size: 24px;"></i>
                                <!-- Ikon domain untuk perusahaan -->
                            </div>
                        </div>

                        <!-- Info Customer -->
                        <div class="flex-grow-1">
                            <h4 class="mb-1">PT. Maju Jaya Property</h4>
                            <p class="text-muted mb-0">
                                <span class="badge-komersil me-2">Komersil</span>
                                Booking ID: BK-CM-2025-001
                            </p>
                        </div>

                        <!-- Info Unit -->
                        <div class="mt-3 mt-sm-0">
                            <div class="d-flex flex-wrap gap-3">
                                <div>
                                    <small class="text-muted d-block">Unit</small>
                                    <span class="fw-medium">Ruko Tipe A - 45/120</span>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Blok/No</small>
                                    <span class="fw-medium">Ruko Blok A No. 12</span>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Harga Unit</small>
                                    <span class="fw-medium survey-text-primary">
                                        Rp 1.250.000.000
                                    </span>
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
                        <i class="mdi mdi-timeline-text me-2 survey-text-primary"></i>
                        Tahapan Survey Komersil
                    </h5>
                    <!-- Progress Bar -->
                    <div class="mb-4">
                        <div class="d-flex flex-wrap justify-content-between mb-2">
                            <span class="text-muted">Progress Survey</span>
                            <span class="survey-text-primary">Tahap 4 dari 5</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 70%; background: linear-gradient(135deg, #da8cff, #9a55ff);" aria-valuenow="70"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    <!-- Timeline Steps -->
                    <div class="timeline-steps">
                        <div class="row g-2 g-md-0">
                            <!-- Pengajuan -->
                            <div class="col-4 col-md text-center mb-3 mb-md-0">
                                <div class="step completed">
                                    <div class="step-icon bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                                        style="width: 35px; height: 35px;">
                                        <i class="mdi mdi-check" style="font-size: 18px;"></i>
                                    </div>
                                    <span class="d-block text-success small fw-medium">Pengajuan</span>
                                    <small class="text-muted d-none d-sm-block">15 Jan 2025</small>
                                </div>
                            </div>

                            <!-- Verifikasi -->
                            <div class="col-4 col-md text-center mb-3 mb-md-0">
                                <div class="step completed">
                                    <div class="step-icon bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                                        style="width: 35px; height: 35px;">
                                        <i class="mdi mdi-check" style="font-size: 18px;"></i>
                                    </div>
                                    <span class="d-block text-success small fw-medium">Verifikasi</span>
                                    <small class="text-muted d-none d-sm-block">20 Jan 2025</small>
                                </div>
                            </div>

                            <!-- Survey -->
                            <div class="col-4 col-md text-center mb-3 mb-md-0">
                                <div class="step active">
                                    <div class="step-icon text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                                        style="width: 35px; height: 35px; background: #9a55ff;">
                                        <i class="mdi mdi-check" style="font-size: 18px;"></i>
                                    </div>
                                    <span class="d-block small fw-medium survey-text-primary">Akad</span>
                                    <small class="text-muted d-none d-sm-block">25 Jan 2025</small>
                                </div>
                            </div>

                            <!-- Akad -->
                            <div class="col-4 col-md text-center mt-2 mt-md-0">
                                <div class="step">
                                    <div class="step-icon text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                                        style="width: 35px; height: 35px; background: #9a55ff;">
                                        <i class="mdi mdi-store" style="font-size: 18px;"></i>
                                    </div>
                                    <span class="d-block small fw-medium survey-text-primary">Survey</span>
                                    <small class="survey-text-primary d-none d-sm-block">Progress</small>
                                </div>
                            </div>

                            <!-- Cair -->
                            <div class="col-4 col-md text-center mt-2 mt-md-0">
                                <div class="step">
                                    <div class="step-icon bg-light text-muted rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                                        style="width: 35px; height: 35px;">
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

        <!-- Kolom Kanan: Detail Kredit Komersil -->
        <div class="col-12 col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="mdi mdi-bank me-2 survey-text-primary"></i>
                        Detail Kredit Komersil
                    </h5>

                    <div class="detail-info">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Lembaga Pembiayaan</span>
                            <span class="fw-medium">Bank Mandiri</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Jumlah Pembiayaan</span>
                            <span class="fw-medium">
                                Rp 1.000.000.000
                            </span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Tenor</span>
                            <span class="fw-medium">10 Tahun</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Angsuran/bln</span>
                            <span class="fw-medium survey-text-primary">Rp 12.500.000</span>
                        </div>
                    </div>

                    <hr class="my-3">

                    <div class="mt-3">
                        <small class="text-muted d-block mb-2">Ditangani oleh:</small>
                        <div class="d-flex align-items-center">
                            <div class="bg-light rounded-circle p-2 me-2">
                                <i class="mdi mdi-account-tie survey-text-primary"></i>
                            </div>
                            <div>
                                <span class="fw-medium d-block">Ahmad Syarif</span>
                                <small class="text-muted">Marketing Komersil</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Row untuk Survey Komersil -->
    <div class="row mt-4">
        <!-- Form Survey Komersil -->
        <div class="col-12 col-lg-8 mb-4 mb-lg-0">
            <form action="#" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="mdi mdi-store me-2 survey-text-primary"></i>
                            Form Survey Unit Komersil
                        </h5>

                        <div class="alert alert-info alert-dismissible fade show" role="alert" style="border-left-color: #9a55ff;">
                            <i class="mdi mdi-information-outline me-2 survey-text-primary"></i>
                            Isi hasil survey unit komersil dengan lengkap. Data ini akan digunakan untuk penilaian kelayakan pembiayaan.
                        </div>

                        <!-- Info Jadwal Survey -->
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="survey-form-group">
                                    <label>Tanggal Survey</label>
                                    <input type="date" class="survey-form-control" name="survey_date" value="2025-01-25">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="survey-form-group">
                                    <label>Jam Survey</label>
                                    <input type="time" class="survey-form-control" name="survey_time" value="10:00">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="survey-form-group">
                                    <label>Surveyor</label>
                                    <select class="survey-form-control" name="surveyor_id">
                                        <option value="">Pilih Surveyor</option>
                                        <option value="1" selected>Budi Santoso (Surveyor Senior)</option>
                                        <option value="2">Dewi Lestari (Surveyor)</option>
                                        <option value="3">Rudi Hartono (Surveyor)</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <hr class="my-3">

                        <h6 class="mb-3 fw-bold survey-text-primary">Hasil Penilaian Unit Komersil</h6>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="survey-form-group">
                                    <label>Nilai Pasar Unit <span class="text-danger">*</span></label>
                                    <div class="survey-input-group">
                                        <div class="survey-input-group-prepend">
                                            <span class="survey-input-group-text">Rp</span>
                                        </div>
                                        <input type="text" class="survey-form-control" name="harga_unit" value="1.250.000.000">
                                    </div>
                                    <small class="survey-text-muted">Sesuai harga jual unit komersil</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="survey-form-group">
                                    <label>Nilai Appraisal <span class="text-danger">*</span></label>
                                    <div class="survey-input-group">
                                        <div class="survey-input-group-prepend">
                                            <span class="survey-input-group-text">Rp</span>
                                        </div>
                                        <input type="text" class="survey-form-control" name="appraisal_value" value="1.150.000.000">
                                    </div>
                                    <small class="survey-text-muted">Penilaian dari surveyor</small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="survey-form-group">
                                    <label>Luas Tanah</label>
                                    <div class="survey-input-group satuan-kiri">
                                        <div class="survey-input-group-prepend">
                                            <span class="survey-input-group-text">m²</span>
                                        </div>
                                        <input type="text" class="survey-form-control" name="luas_tanah" value="120">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="survey-form-group">
                                    <label>Luas Bangunan</label>
                                    <div class="survey-input-group satuan-kiri">
                                        <div class="survey-input-group-prepend">
                                            <span class="survey-input-group-text">m²</span>
                                        </div>
                                        <input type="text" class="survey-form-control" name="luas_bangunan" value="45">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="survey-form-group">
                                    <label>Jumlah Lantai</label>
                                    <div class="survey-input-group satuan-kiri">
                                        <div class="survey-input-group-prepend">
                                            <span class="survey-input-group-text">Lt</span>
                                        </div>
                                        <input type="text" class="survey-form-control" name="jumlah_lantai" value="2">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="survey-form-group">
                                    <label>Kondisi Bangunan</label>
                                    <select class="survey-form-control" name="kondisi_bangunan">
                                        <option value="">Pilih Kondisi</option>
                                        <option value="Baru (0-2 tahun)" selected>Baru (0-2 tahun)</option>
                                        <option value="Baik (2-5 tahun)">Baik (2-5 tahun)</option>
                                        <option value="Cukup (5-10 tahun)">Cukup (5-10 tahun)</option>
                                        <option value="Perlu Renovasi">Perlu Renovasi</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="survey-form-group">
                                    <label>Zona / Peruntukan</label>
                                    <select class="survey-form-control" name="zona">
                                        <option value="">Pilih Zona</option>
                                        <option value="Komersial" selected>Komersial</option>
                                        <option value="Perkantoran">Perkantoran</option>
                                        <option value="Campuran">Campuran</option>
                                        <option value="Industri">Industri</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <hr class="my-3">

                        <!-- Checklist Kondisi Unit Komersil -->
                        <div class="mb-4">
                            <h6 class="mb-3 fw-bold survey-text-primary">
                                <i class="mdi mdi-checkbox-marked-outline me-2"></i>
                                Checklist Kondisi Unit Komersil
                            </h6>

                            <div class="row">
                                @php
                                    $checklistItems = [
                                        'listrik' => 'Instalasi Listrik 3 Phase',
                                        'air' => 'Air Bersih / PAM',
                                        'akses' => 'Akses Jalan Raya',
                                        'parkir' => 'Area Parkir Luas',
                                        'sertifikat' => 'Sertifikat HGB',
                                        'imb' => 'IMB Komersil',
                                        'keamanan' => 'Sistem Keamanan',
                                        'pbb' => 'PBB Sesuai'
                                    ];
                                @endphp

                                @foreach ($checklistItems as $field => $label)
                                    <div class="col-md-6 mb-2">
                                        <div class="survey-checkbox-wrapper">
                                            <input type="checkbox" class="survey-checkbox-input" id="{{ $field }}" name="{{ $field }}"
                                                {{ in_array($field, ['listrik', 'air', 'akses', 'sertifikat', 'imb']) ? 'checked' : '' }}>
                                            <label class="survey-checkbox-label" for="{{ $field }}">
                                                <i class="mdi mdi-check-circle survey-check-icon"></i>
                                                <span class="survey-check-text">{{ $label }}</span>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <hr class="my-3">

                        <!-- Analisis Lokasi dan Potensi -->
                        <h6 class="mb-3 fw-bold survey-text-primary">Analisis Lokasi & Potensi Bisnis</h6>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="survey-form-group">
                                    <label>Tingkat Keramaian</label>
                                    <select class="survey-form-control" name="keramaian">
                                        <option value="">Pilih</option>
                                        <option value="Sangat Tinggi">Sangat Tinggi</option>
                                        <option value="Tinggi" selected>Tinggi</option>
                                        <option value="Sedang">Sedang</option>
                                        <option value="Rendah">Rendah</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="survey-form-group">
                                    <label>Akses Transportasi</label>
                                    <select class="survey-form-control" name="transportasi">
                                        <option value="">Pilih</option>
                                        <option value="Sangat Mudah">Sangat Mudah</option>
                                        <option value="Mudah" selected>Mudah</option>
                                        <option value="Cukup">Cukup</option>
                                        <option value="Sulit">Sulit</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="survey-form-group">
                                    <label>Potensi Pengembangan</label>
                                    <select class="survey-form-control" name="potensi">
                                        <option value="">Pilih</option>
                                        <option value="Sangat Potensial">Sangat Potensial</option>
                                        <option value="Potensial" selected>Potensial</option>
                                        <option value="Cukup Potensial">Cukup Potensial</option>
                                        <option value="Kurang Potensial">Kurang Potensial</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="survey-form-group">
                                    <label>Estimasi Nilai Sewa / Bulan</label>
                                    <div class="survey-input-group">
                                        <div class="survey-input-group-prepend">
                                            <span class="survey-input-group-text">Rp</span>
                                        </div>
                                        <input type="text" class="survey-form-control" name="nilai_sewa" value="15.000.000">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-3">

                        <!-- Dokumentasi Survey -->
                        <h6 class="mb-3 fw-bold survey-text-primary">Dokumentasi Survey</h6>
                        <div class="row">
                            @foreach (['foto_depan'=>'Foto Tampak Depan','foto_interior'=>'Foto Interior','foto_lingkungan'=>'Foto Lingkungan','foto_parkir'=>'Foto Parkir'] as $field => $label)
                            <div class="col-md-3">
                                <div class="survey-form-group">
                                    <label>{{ $label }}</label>
                                    <div class="survey-file-upload">
                                        <input type="file" name="{{ $field }}" accept=".jpg,.jpeg,.png">
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
                            @endforeach
                        </div>

                        <hr class="my-3">

                        <h6 class="mb-3 fw-bold survey-text-primary">Catatan Survey Komersil</h6>
                        <div class="survey-form-group">
                            <textarea class="survey-form-control" name="catatan_survey" rows="3"
                                placeholder="Contoh: Lokasi strategis di jalan utama, cocok untuk usaha retail">Lokasi sangat strategis di pinggir jalan raya, dekat dengan pusat perbelanjaan dan perkantoran. Potensi tinggi untuk usaha retail atau showroom.</textarea>
                        </div>

                        <hr class="my-3">

                        <h6 class="mb-3 fw-bold survey-text-primary">Rekomendasi</h6>
                        <div class="rekomendasi-row">
                            <div class="rekomendasi-col">
                                <div class="survey-form-group">
                                    <label>Status</label>
                                    <select class="survey-form-control" name="rekomendasi">
                                        <option value="">Pilih</option>
                                        <option value="Layak - Sesuai Harga" selected>Layak - Sesuai Harga</option>
                                        <option value="Layak - Penyesuaian">Layak - Penyesuaian</option>
                                        <option value="Tidak Layak">Tidak Layak</option>
                                        <option value="Survey Ulang">Survey Ulang</option>
                                    </select>
                                </div>
                            </div>
                            <div class="rekomendasi-col">
                                <div class="survey-form-group">
                                    <label>Kelayakan</label>
                                    <div class="survey-input-group satuan-kiri">
                                        <div class="survey-input-group-prepend">
                                            <span class="survey-input-group-text">%</span>
                                        </div>
                                        <input type="text" class="survey-form-control" name="persentase_kelayakan" value="85">
                                    </div>
                                </div>
                            </div>
                            <div class="rekomendasi-col">
                                <div class="survey-form-group">
                                    <label>Plafon</label>
                                    <div class="survey-input-group">
                                        <div class="survey-input-group-prepend">
                                            <span class="survey-input-group-text">Rp</span>
                                        </div>
                                        <input type="text" class="survey-form-control" name="rekomendasi_plafon" value="1.000.000.000">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-3">

                        <!-- Submit Button - Hanya satu button -->
                        <div class="d-grid">
                            <button type="submit" class="survey-btn survey-btn-success w-100">
                                <i class="mdi mdi-content-save me-2"></i>
                                Simpan Hasil Survey Komersil
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Kolom Kanan: Riwayat Survey & Catatan -->
        <div class="col-12 col-lg-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="mdi mdi-history me-2 survey-text-primary"></i>
                        Riwayat Survey
                    </h5>

                    <div class="timeline">
                        <div class="d-flex gap-3 mb-3">
                            <div class="flex-shrink-0">
                                <div class="bg-success text-white rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                    <i class="mdi mdi-check" style="font-size: 16px;"></i>
                                </div>
                            </div>
                            <div>
                                <h6 class="mb-1">Survey Awal</h6>
                                <small class="text-muted d-block">15 Jan 2025, 10:00 WIB</small>
                                <p class="mb-0 small">Survey awal oleh tim marketing</p>
                            </div>
                        </div>

                        <div class="d-flex gap-3 mb-3">
                            <div class="flex-shrink-0">
                                <div class="text-white rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; background: #9a55ff;">
                                    <i class="mdi mdi-progress-clock" style="font-size: 16px;"></i>
                                </div>
                            </div>
                            <div>
                                <h6 class="mb-1">Survey Lapangan (Aktif)</h6>
                                <small class="text-muted d-block">25 Jan 2025, 10:00 WIB</small>
                                <p class="mb-0 small">Survey lapangan oleh surveyor</p>
                            </div>
                        </div>

                        <div class="d-flex gap-3">
                            <div class="flex-shrink-0">
                                <div class="bg-light text-muted rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                    <i class="mdi mdi-clock-outline" style="font-size: 16px;"></i>
                                </div>
                            </div>
                            <div>
                                <h6 class="mb-1">Verifikasi Hasil</h6>
                                <small class="text-muted d-block">Menunggu</small>
                                <p class="mb-0 small">Verifikasi oleh tim appraisal</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ringkasan Penilaian -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="mdi mdi-chart-bar me-2 survey-text-primary"></i>
                        Ringkasan Penilaian
                    </h5>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Nilai Pasar</span>
                            <span class="fw-medium">Rp 1.250.000.000</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Nilai Appraisal</span>
                            <span class="fw-medium">Rp 1.150.000.000</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Selisih</span>
                            <span class="fw-medium text-danger">- Rp 100.000.000</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Rasio Appraisal</span>
                            <span class="fw-medium">92%</span>
                        </div>
                    </div>

                    <div class="progress mb-3" style="height: 8px;">
                        <div class="progress-bar" role="progressbar" style="width: 92%; background: linear-gradient(135deg, #da8cff, #9a55ff);" aria-valuenow="92" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                    <hr>

                    <div class="mb-2">
                        <small class="text-muted d-block mb-2">Kriteria Penilaian</small>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge bg-success text-white">Lokasi: 95%</span>
                            <span class="badge bg-success text-white">Bangunan: 85%</span>
                            <span class="badge bg-warning text-white">Akses: 90%</span>
                            <span class="badge" style="background: linear-gradient(135deg, #da8cff, #9a55ff); color: white;">Potensi: 88%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        /* Custom styles untuk konsistensi */
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
                    const label = this.closest('.survey-file-upload').querySelector(
                        '.survey-file-info span');
                    if (fileName && label) {
                        label.textContent = fileName.length > 30 ? fileName.substring(0, 30) +
                            '...' : fileName;
                    } else {
                        // Reset ke teks awal
                        label.textContent = 'Upload Foto';
                    }
                });
            });

            // Format Rupiah
            const rupiahInputs = document.querySelectorAll('input[type="text"][value*="000"]');
            rupiahInputs.forEach(input => {
                input.addEventListener('keyup', function(e) {
                    let value = this.value.replace(/\D/g, '');
                    this.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                });
            });
        });
    </script>
@endpush
