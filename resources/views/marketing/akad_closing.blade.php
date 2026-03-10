@extends('layouts.partial.app')

@section('title', 'Verifikasi KPR - Tahap Akad - Property Management App')

@section('content')

    <style>
        /* ===== STYLING DARI VERIFIKASI KPR UNTUK UPLOAD DOKUMEN ===== */
        .verifikasi-file-upload {
            position: relative;
            width: 100%;
        }

        .verifikasi-file-upload input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
            z-index: 2;
        }


        .verifikasi-file-upload .verifikasi-file-label {
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
            .verifikasi-file-upload .verifikasi-file-label {
                flex-direction: row;
                text-align: left;
                gap: 8px;
                padding: 0.75rem 1rem;
                min-height: auto;
            }
        }

        .verifikasi-file-upload:hover .verifikasi-file-label {
            border-color: #9a55ff;
            background: linear-gradient(135deg, #f1f0ff, #f8f9fa);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(154, 85, 255, 0.1);
        }

        .verifikasi-file-upload .verifikasi-file-label i {
            font-size: 1.6rem;
            color: #9a55ff;
            background: rgba(154, 85, 255, 0.1);
            padding: 8px;
            border-radius: 50%;
        }

        .verifikasi-file-upload .verifikasi-file-label .verifikasi-file-info {
            flex: 1;
            width: 100%;
        }

        .verifikasi-file-upload .verifikasi-file-label .verifikasi-file-info span {
            display: block;
            font-weight: 600;
            color: #2c2e3f;
            font-size: 0.8rem;
            word-break: break-word;
        }

        .verifikasi-file-upload .verifikasi-file-label .verifikasi-file-info small {
            color: #6c7383;
            font-size: 0.65rem;
            display: block;
            margin-top: 2px;
        }

        /* ===== STYLING BUTTON DARI VERIFIKASI KPR ===== */
        .verifikasi-btn {
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
            .verifikasi-btn {
                width: auto;
                padding: 0.5rem 1.2rem;
            }
        }

        .verifikasi-btn-primary {
            background: linear-gradient(to right, #da8cff, #9a55ff);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.3);
        }

        .verifikasi-btn-primary:hover {
            background: linear-gradient(to right, #c77cff, #8a45e6);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(154, 85, 255, 0.4);
        }

        .verifikasi-btn-success {
            background: linear-gradient(135deg, #28a745, #5cb85c);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
        }

        .verifikasi-btn-success:hover {
            background: linear-gradient(135deg, #218838, #4cae4c);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(40, 167, 69, 0.4);
        }

        .verifikasi-btn-outline-primary {
            background: transparent;
            border: 1px solid #9a55ff;
            color: #9a55ff;
        }

        .verifikasi-btn-outline-primary:hover {
            background: linear-gradient(135deg, #9a55ff, #da8cff);
            color: #ffffff;
            border-color: transparent;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.3);
        }

        .verifikasi-btn-outline-secondary {
            background: transparent;
            border: 1px solid #e9ecef;
            color: #6c7383;
        }

        .verifikasi-btn-outline-secondary:hover {
            background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
            color: #2c2e3f;
            border-color: #9a55ff;
            transform: translateY(-2px);
        }

        .verifikasi-btn-outline-warning {
            background: transparent;
            border: 1px solid #ffc107;
            color: #ffc107;
        }

        .verifikasi-btn-outline-warning:hover {
            background: linear-gradient(135deg, #ffc107, #ffdb6d);
            color: #2c2e3f;
            border-color: transparent;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 193, 7, 0.3);
        }

        /* Text colors */
        .verifikasi-text-primary {
            color: #9a55ff !important;
        }

        /* ===== STYLE CSS DARI HALAMAN AKAD (HANYA YANG DIPERLUKAN) ===== */
        .konfirmasi-alert {
            border: none;
            border-radius: 10px;
            padding: 0.8rem 1rem;
            font-size: 0.8rem;
            border-left: 4px solid;
            margin-bottom: 1rem;
        }

        .konfirmasi-alert-danger {
            background: linear-gradient(135deg, #fff0f0, #ffe6e6);
            color: #2c2e3f;
            border-left-color: #dc3545;
        }

        .konfirmasi-alert-success {
            background: linear-gradient(135deg, #f0fff4, #e6f7e6);
            color: #2c2e3f;
            border-left-color: #28a745;
        }

        .konfirmasi-alert-warning {
            background: linear-gradient(135deg, #fff9e6, #fff2d9);
            color: #2c2e3f;
            border-left-color: #ffc107;
        }

        .konfirmasi-alert-info {
            background: linear-gradient(135deg, #e6f3ff, #d9ecff);
            color: #2c2e3f;
            border-left-color: #17a2b8;
        }

        .konfirmasi-alert i {
            color: inherit;
        }

        .konfirmasi-form-group {
            margin-bottom: 1rem;
        }

        .konfirmasi-form-group label {
            font-size: 0.8rem;
            font-weight: 600;
            color: #9a55ff !important;
            margin-bottom: 0.3rem;
            display: block;
        }

        .konfirmasi-form-control {
            border: 1px solid #e9ecef;
            border-radius: 10px;
            padding: 0.7rem 0.8rem;
            font-size: 0.85rem;
            width: 100%;
        }

        .konfirmasi-form-control:focus {
            border-color: #9a55ff;
            box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.1);
            outline: none;
        }

        .konfirmasi-text-primary {
            color: #9a55ff !important;
        }

        .konfirmasi-tindakan-card {
            position: relative;
            margin-bottom: 1rem;
            width: 100%;
        }

        .konfirmasi-tindakan-card input[type="radio"] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .konfirmasi-tindakan-label {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 1rem 1rem;
            background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
            border: 2px solid #e9ecef;
            border-radius: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            min-height: 70px;
        }

        .konfirmasi-tindakan-label:hover {
            border-color: #9a55ff;
            background: linear-gradient(135deg, #f1f0ff, #f8f9fa);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(154, 85, 255, 0.15);
        }

        .konfirmasi-tindakan-card input[type="radio"]:checked+.konfirmasi-tindakan-label {
            border-color: #9a55ff;
            background: linear-gradient(135deg, #f1f0ff, #e8e0ff);
        }

        .konfirmasi-tindakan-icon {
            flex-shrink: 0;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            border-radius: 12px;
        }

        .konfirmasi-tindakan-icon i {
            font-size: 24px;
            color: #9a55ff;
        }

        .konfirmasi-tindakan-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .konfirmasi-tindakan-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: #2c2e3f;
        }

        .konfirmasi-tindakan-desc {
            font-size: 0.75rem;
            color: #6c7383;
        }

        .konfirmasi-tindakan-check {
            flex-shrink: 0;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .konfirmasi-tindakan-check i {
            font-size: 20px;
            color: #d0d4db;
        }

        .konfirmasi-tindakan-card input[type="radio"]:checked+.konfirmasi-tindakan-label .konfirmasi-tindakan-check i {
            color: #9a55ff;
        }

        .konfirmasi-btn {
            font-size: 0.8rem;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-block;
            text-decoration: none;
            cursor: pointer;
            border: none;
        }

        .konfirmasi-btn-primary {
            background: linear-gradient(to right, #da8cff, #9a55ff);
            color: #ffffff;
        }

        .konfirmasi-btn-primary:hover {
            background: linear-gradient(to right, #c77cff, #8a45e6);
            transform: translateY(-2px);
        }

        .konfirmasi-btn-outline-secondary {
            background: transparent;
            border: 1px solid #e9ecef;
            color: #6c7383;
        }

        .konfirmasi-btn-outline-secondary:hover {
            background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
            color: #2c2e3f;
            border-color: #9a55ff;
            transform: translateY(-2px);
        }

        .badge.bg-warning {
            background: linear-gradient(135deg, #ffc107, #ffdb6d) !important;
            color: #2c2e3f;
        }

        .badge.bg-success {
            background: linear-gradient(135deg, #28a745, #5cb85c) !important;
            color: white;
        }

        .badge.bg-danger {
            background: linear-gradient(135deg, #dc3545, #e4606d) !important;
            color: white;
        }

        .badge.bg-info {
            background: linear-gradient(135deg, #17a2b8, #5bc0de) !important;
            color: white;
        }

        .badge.bg-primary {
            background: linear-gradient(135deg, #9a55ff, #da8cff) !important;
            color: white;
        }

        .badge {
            padding: 5px 10px;
            font-weight: 500;
            border-radius: 30px;
        }

        .table th {
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #495057;
        }

        .table td {
            vertical-align: middle;
            padding: 0.75rem;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .timeline-steps .step .step-icon {
            transition: all 0.3s ease;
        }

        .timeline-steps .step.completed .step-icon {
            background-color: #28a745 !important;
        }

        .timeline-steps .step.active .step-icon {
            background-color: #ffc107 !important;
            box-shadow: 0 0 0 3px rgba(255, 193, 7, 0.2);
        }

        .step.completed .step-icon i {
            color: white;
        }

        .step.active .step-icon i {
            color: white;
        }

        .detail-info {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 1rem;
        }

        .info-box {
            background: linear-gradient(135deg, #f9f7ff, #f2ecff);
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1rem;
        }
    </style>

    <div class="row">
        <div class="col-12">
            <!-- Header Info Customer (Statis) -->
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center gap-3">
                        <!-- Avatar -->
                        <div class="flex-shrink-0">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 50px; height: 50px;">
                                <i class="mdi mdi-account" style="font-size: 24px;"></i>
                            </div>
                        </div>

                        <!-- Info Customer -->
                        <div class="flex-grow-1">
                            <h4 class="mb-1">BUDI SANTOSO</h4>
                            <p class="text-muted mb-0">Booking ID: BK-2025-001</p>
                        </div>

                        <!-- Info Unit -->
                        <div class="mt-3 mt-sm-0">
                            <div class="d-flex flex-wrap gap-3">
                                <div>
                                    <small class="text-muted d-block">Unit</small>
                                    <span class="fw-medium">Tipe 36/72</span>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Blok/No</small>
                                    <span class="fw-medium">A.1</span>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Harga Unit</small>
                                    <span class="fw-medium text-primary">
                                        Rp 350.000.000
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
                        <i class="mdi mdi-timeline-text me-2 text-primary"></i>
                        Tahapan KPR
                    </h5>

                    <!-- Progress Bar -->
                    <div class="mb-4">
                        <div class="d-flex flex-wrap justify-content-between mb-2">
                            <span class="text-muted">Progress</span>
                            <span class="text-primary">Tahap 4 dari 6</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 66%;" aria-valuenow="66"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    <!-- Timeline Steps -->
                    <div class="timeline-steps">
                        <div class="row g-2 g-md-0">
                            <div class="col-2 col-md text-center mb-3 mb-md-0">
                                <div class="step completed">
                                    <div class="step-icon bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                                        style="width: 35px; height: 35px;">
                                        <i class="mdi mdi-check" style="font-size: 18px;"></i>
                                    </div>
                                    <span class="d-block text-success small fw-medium">Diajukan</span>
                                    <small class="text-muted d-none d-sm-block">10 Mar</small>
                                </div>
                            </div>
                            <div class="col-2 col-md text-center mb-3 mb-md-0">
                                <div class="step completed">
                                    <div class="step-icon bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                                        style="width: 35px; height: 35px;">
                                        <i class="mdi mdi-check" style="font-size: 18px;"></i>
                                    </div>
                                    <span class="d-block text-success small fw-medium">Verifikasi</span>
                                    <small class="text-muted d-none d-sm-block">12 Mar</small>
                                </div>
                            </div>
                            <div class="col-2 col-md text-center mb-3 mb-md-0">
                                <div class="step completed">
                                    <div class="step-icon bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                                        style="width: 35px; height: 35px;">
                                        <i class="mdi mdi-check" style="font-size: 18px;"></i>
                                    </div>
                                    <span class="d-block text-success small fw-medium">Survey</span>
                                    <small class="text-muted d-none d-sm-block">15 Mar</small>
                                </div>
                            </div>
                            <div class="col-2 col-md text-center mt-2 mt-md-0">
                                <div class="step active">
                                    <div class="step-icon bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                                        style="width: 35px; height: 35px;">
                                        <i class="mdi mdi-handshake" style="font-size: 18px;"></i>
                                    </div>
                                    <span class="d-block small fw-medium">Akad</span>
                                    <small class="text-muted d-none d-sm-block">Proses Closing</small>
                                </div>
                            </div>
                            <div class="col-2 col-md text-center mt-2 mt-md-0">
                                <div class="step">
                                    <div class="step-icon bg-light text-muted rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                                        style="width: 35px; height: 35px;">
                                        <i class="mdi mdi-cash-check" style="font-size: 18px;"></i>
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
                            <span class="fw-medium">BANK MANDIRI</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Jumlah Pinjaman</span>
                            <span class="fw-medium">
                                Rp 280.000.000
                            </span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Tenor</span>
                            <span class="fw-medium">15 Tahun</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Angsuran/bln</span>
                            <span class="fw-medium text-primary">
                                Rp 2.350.000
                            </span>
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
                                <span class="fw-medium d-block">AHMAD SYAIFUL</span>
                                <small class="text-muted">Marketing</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Row Kelengkapan Dokumen -->
    <div class="row mt-4">
        <div class="col-12 col-lg-8 mb-4 mb-lg-0">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="mdi mdi-file-document-multiple me-2 text-primary"></i>
                        Kelengkapan Dokumen
                    </h5>

                    <!-- Alert Info untuk Akad -->
                    <div class="konfirmasi-alert konfirmasi-alert-info mb-4" role="alert">
                        <i class="mdi mdi-information-outline me-2"></i>
                        Semua dokumen telah lengkap. Silakan lakukan proses akad.
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="bg-light">
                                <tr>
                                    <th style="width:40%">Nama Dokumen</th>
                                    <th style="width:25%">Status</th>
                                    <th style="width:20%">Tanggal Upload</th>
                                    <th style="width:15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-file-document-outline text-primary me-2"></i>
                                            <span>KTP</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-success">Lengkap</span>
                                    </td>
                                    <td>
                                        <small>10 Mar 2025</small>
                                    </td>
                                    <td>
                                        <a href="#" target="_blank" class="btn btn-sm btn-outline-primary">
                                            <i class="mdi mdi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-file-document-outline text-primary me-2"></i>
                                            <span>KK</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-success">Lengkap</span>
                                    </td>
                                    <td>
                                        <small>10 Mar 2025</small>
                                    </td>
                                    <td>
                                        <a href="#" target="_blank" class="btn btn-sm btn-outline-primary">
                                            <i class="mdi mdi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-file-document-outline text-primary me-2"></i>
                                            <span>NPWP</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-success">Lengkap</span>
                                    </td>
                                    <td>
                                        <small>11 Mar 2025</small>
                                    </td>
                                    <td>
                                        <a href="#" target="_blank" class="btn btn-sm btn-outline-primary">
                                            <i class="mdi mdi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-file-document-outline text-primary me-2"></i>
                                            <span>Slip Gaji</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-success">Lengkap</span>
                                    </td>
                                    <td>
                                        <small>12 Mar 2025</small>
                                    </td>
                                    <td>
                                        <a href="#" target="_blank" class="btn btn-sm btn-outline-primary">
                                            <i class="mdi mdi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-file-document-outline text-primary me-2"></i>
                                            <span>Rekening Koran</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-success">Lengkap</span>
                                    </td>
                                    <td>
                                        <small>12 Mar 2025</small>
                                    </td>
                                    <td>
                                        <a href="#" target="_blank" class="btn btn-sm btn-outline-primary">
                                            <i class="mdi mdi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-file-document-outline text-primary me-2"></i>
                                            <span>Surat Nikah</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-success">Lengkap</span>
                                    </td>
                                    <td>
                                        <small>11 Mar 2025</small>
                                    </td>
                                    <td>
                                        <a href="#" target="_blank" class="btn btn-sm btn-outline-primary">
                                            <i class="mdi mdi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="text-muted small mt-2 d-block d-sm-none">
                        <i class="mdi mdi-information-outline me-1"></i>
                        Geser tabel untuk melihat kolom lainnya
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="mdi mdi-information me-2 text-primary"></i>
                        Informasi Verifikasi
                    </h5>

                    <!-- Status Card -->
                    <div class="text-center mb-4">
                        <span class="badge bg-warning p-2" style="font-size: 14px;">
                            <i class="mdi mdi-handshake me-1"></i>
                            Menunggu Proses Akad
                        </span>
                    </div>

                    <!-- Ringkasan Dokumen -->
                    <h6 class="mb-3 konfirmasi-text-primary">Status Dokumen</h6>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Dokumen Lengkap</span>
                            <span class="fw-medium text-success">6 Dokumen</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Dokumen Kurang</span>
                            <span class="fw-medium text-danger">0 Dokumen</span>
                        </div>
                    </div>

                    <hr class="my-3">

                    <!-- Rekomendasi -->
                    <h6 class="mb-3 konfirmasi-text-primary">Rekomendasi</h6>
                    <div class="konfirmasi-alert konfirmasi-alert-success py-2">
                        <i class="mdi mdi-check-circle-outline me-2"></i>
                        Semua dokumen lengkap, siap untuk proses akad
                    </div>

                    <hr class="my-3">

                    <!-- Timeline -->
                    <h6 class="mb-3 konfirmasi-text-primary">Timeline Pengajuan</h6>
                    <div class="konfirmasi-timeline">
                        <div class="d-flex mb-2">
                            <div style="width: 24px;" class="me-2">
                                <i class="mdi mdi-check-circle text-success"></i>
                            </div>
                            <div>
                                <span class="d-block">Pengajuan KPR</span>
                                <small class="text-muted">10 Maret 2025</small>
                            </div>
                        </div>
                        <div class="d-flex mb-2">
                            <div style="width: 24px;" class="me-2">
                                <i class="mdi mdi-check-circle text-success"></i>
                            </div>
                            <div>
                                <span class="d-block">Verifikasi Dokumen</span>
                                <small class="text-muted">12 Maret 2025</small>
                            </div>
                        </div>
                        <div class="d-flex mb-2">
                            <div style="width: 24px;" class="me-2">
                                <i class="mdi mdi-check-circle text-success"></i>
                            </div>
                            <div>
                                <span class="d-block">Survey</span>
                                <small class="text-muted">15 Maret 2025</small>
                            </div>
                        </div>
                        <div class="d-flex mb-2">
                            <div style="width: 24px;" class="me-2">
                                <i class="mdi mdi-progress-clock text-warning"></i>
                            </div>
                            <div>
                                <span class="d-block">Akad</span>
                                <small class="text-muted">Proses Closing</small>
                            </div>
                        </div>
                        <div class="d-flex mb-2">
                            <div style="width: 24px;" class="me-2">
                                <i class="mdi mdi-clock-outline text-muted"></i>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div style="width: 24px;" class="me-2">
                                <i class="mdi mdi-clock-outline text-muted"></i>
                            </div>
                            <div>
                                <span class="d-block">Cair</span>
                                <small class="text-muted">Menunggu</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Row untuk Proses Akad -->
    <div class="row mt-4">
        <!-- Kolom Kiri: Form Proses Akad -->
        <div class="col-12 col-lg-8 mb-4 mb-lg-0">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="mdi mdi-handshake me-2 text-primary"></i>
                        Proses Akad
                    </h5>

                    <div class="konfirmasi-alert konfirmasi-alert-info" role="alert">
                        <i class="mdi mdi-information-outline me-2"></i>
                        Lengkapi data akad berikut untuk melanjutkan ke proses closing.
                    </div>

                    <form>
                        <input type="hidden" name="status" id="statusAkadInput" value="">

                        <!-- Tombol Pilih Selesai / Tunda -->
                        <div class="d-flex gap-2 mb-3">
                            <button type="button" id="pilihSelesai" class="konfirmasi-btn konfirmasi-btn-outline-success">
                                Selesai Akad
                            </button>
                            <button type="button" id="pilihTunda" class="konfirmasi-btn konfirmasi-btn-outline-warning">
                                Tunda / Bermasalah
                            </button>
                        </div>

                        <!-- FORM SELESAI AKAD -->
                        <div id="formSelesai" style="display: none;">
                            <hr class="my-3">
                            <h6 class="mb-3 konfirmasi-text-primary">Form Penyelesaian Akad</h6>

                            <div class="konfirmasi-alert konfirmasi-alert-success" role="alert">
                                <i class="mdi mdi-check-circle me-2"></i>
                                <strong>AKAD SELESAI</strong> - Lanjut ke proses closing
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="konfirmasi-form-group">
                                        <label>Tanggal Akad</label>
                                        <input type="date" class="konfirmasi-form-control" name="tanggal_akad" value="2025-03-20">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="konfirmasi-form-group">
                                        <label>Lokasi Akad</label>
                                        <input type="text" class="konfirmasi-form-control" name="lokasi_akad" value="Kantor Notaris Siti, SH">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="konfirmasi-form-group">
                                        <label>Nama Notaris</label>
                                        <input type="text" class="konfirmasi-form-control" name="nama_notaris" value="Siti Nurhaliza, SH">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="konfirmasi-form-group">
                                        <label>Nomor Akad</label>
                                        <input type="text" class="konfirmasi-form-control" name="nomor_akad" value="AKD/2025/03/123">
                                    </div>
                                </div>
                            </div>

                            <div class="verifikasi-form-group mb-4">
                                <label class="verifikasi-text-primary">Upload Dokumen Akad</label>
                                <div class="verifikasi-file-upload">
                                    <input type="file" name="dokumen_akad" accept=".jpg,.jpeg,.png,.pdf">
                                    <div class="verifikasi-file-label">
                                        <i class="mdi mdi-cloud-upload"></i>
                                        <div class="verifikasi-file-info">
                                            <span>Upload Dokumen Akad</span>
                                            <small>Format: JPG, PNG, PDF (Max 5MB)</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="konfirmasi-form-group">
                                <label>Catatan Akad</label>
                                <textarea class="konfirmasi-form-control" name="catatan" rows="2" placeholder="Contoh: Proses akad selesai, dokumen lengkap"></textarea>
                            </div>
                        </div>

                        <!-- FORM TUNDA / BERMASALAH -->
                        <div id="formTunda" style="display: none;">
                            <hr class="my-3">
                            <h6 class="mb-3 konfirmasi-text-primary">Form Penundaan Akad</h6>

                            <div class="konfirmasi-alert konfirmasi-alert-warning" role="alert">
                                <i class="mdi mdi-alert-circle me-2"></i>
                                <strong>AKAD DITUNDA</strong> - Pilih alasan dan tindakan selanjutnya
                            </div>

                            <div class="konfirmasi-form-group">
                                <label>Alasan Penundaan</label>
                                <select class="konfirmasi-form-control" name="alasan_masalah">
                                    <option value="jadwal_belum_cocok">Jadwal Belum Cocok</option>
                                    <option value="dokumen_kurang">Dokumen Kurang Lengkap</option>
                                    <option value="customer_belum_siap">Customer Belum Siap</option>
                                    <option value="bank_belum_terbit">SP3K Belum Terbit</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>

                            <div class="konfirmasi-form-group">
                                <label>Catatan / Keterangan</label>
                                <textarea class="konfirmasi-form-control" name="catatan_masalah" rows="3" placeholder="Jelaskan detail penundaan..."></textarea>
                            </div>

                            <hr class="my-3">
                            <h6 class="mb-3 konfirmasi-text-primary">Tindakan Selanjutnya</h6>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <div class="konfirmasi-tindakan-card">
                                        <input type="radio" name="tindakan" id="tindakanJadwalUlang" value="Jadwal Ulang" checked>
                                        <label class="konfirmasi-tindakan-label" for="tindakanJadwalUlang">
                                            <div class="konfirmasi-tindakan-icon">
                                                <i class="mdi mdi-calendar-clock"></i>
                                            </div>
                                            <div class="konfirmasi-tindakan-content">
                                                <span class="konfirmasi-tindakan-title">Jadwal Ulang</span>
                                                <span class="konfirmasi-tindakan-desc">Atur ulang jadwal akad</span>
                                            </div>
                                            <div class="konfirmasi-tindakan-check">
                                                <i class="mdi mdi-check-circle"></i>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="konfirmasi-tindakan-card">
                                        <input type="radio" name="tindakan" id="tindakanLengkapi" value="Lengkapi Dokumen">
                                        <label class="konfirmasi-tindakan-label" for="tindakanLengkapi">
                                            <div class="konfirmasi-tindakan-icon">
                                                <i class="mdi mdi-file-document-edit"></i>
                                            </div>
                                            <div class="konfirmasi-tindakan-content">
                                                <span class="konfirmasi-tindakan-title">Lengkapi Dokumen</span>
                                                <span class="konfirmasi-tindakan-desc">Dokumen masih kurang</span>
                                            </div>
                                            <div class="konfirmasi-tindakan-check">
                                                <i class="mdi mdi-check-circle"></i>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 d-flex justify-content-between">
                            <a href="#" class="konfirmasi-btn konfirmasi-btn-outline-secondary">
                                <i class="mdi mdi-arrow-left me-2"></i>
                                Kembali
                            </a>
                            <button type="submit" class="konfirmasi-btn konfirmasi-btn-primary">
                                <i class="mdi mdi-content-save me-2"></i>
                                Simpan Proses Akad
                            </button>
                        </div>
                    </form>

                    <!-- Informasi Tambahan untuk Mobile -->
                    <div class="text-muted small mt-2 d-block d-sm-none">
                        <i class="mdi mdi-information-outline me-1"></i>
                        Geser untuk melihat konten lainnya
                    </div>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Info Ringkasan -->
        <div class="col-12 col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="mdi mdi-calendar-check me-2 text-primary"></i>
                        Informasi Akad
                    </h5>

                    <div class="info-box">
                        <div class="d-flex mb-3">
                            <div style="width: 30px;" class="me-2">
                                <i class="mdi mdi-calendar text-primary"></i>
                            </div>
                            <div>
                                <span class="d-block text-muted small">Rencana Akad</span>
                                <span class="fw-medium">20 Maret 2025</span>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <div style="width: 30px;" class="me-2">
                                <i class="mdi mdi-map-marker text-primary"></i>
                            </div>
                            <div>
                                <span class="d-block text-muted small">Lokasi</span>
                                <span class="fw-medium">Kantor Notaris Siti, SH</span>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div style="width: 30px;" class="me-2">
                                <i class="mdi mdi-account-tie text-primary"></i>
                            </div>
                            <div>
                                <span class="d-block text-muted small">Notaris</span>
                                <span class="fw-medium">Siti Nurhaliza, SH</span>
                            </div>
                        </div>
                    </div>

                    <hr class="my-3">

                    <h6 class="mb-3 konfirmasi-text-primary">Yang perlu disiapkan</h6>
                    <div class="d-flex mb-2">
                        <div style="width: 24px;" class="me-2">
                            <i class="mdi mdi-check-circle text-success"></i>
                        </div>
                        <div>Dokumen KTP/KK</div>
                    </div>
                    <div class="d-flex mb-2">
                        <div style="width: 24px;" class="me-2">
                            <i class="mdi mdi-check-circle text-success"></i>
                        </div>
                        <div>SP3K dari Bank</div>
                    </div>
                    <div class="d-flex mb-2">
                        <div style="width: 24px;" class="me-2">
                            <i class="mdi mdi-check-circle text-success"></i>
                        </div>
                        <div>Materai 10.000 (2 lembar)</div>
                    </div>
                    <div class="d-flex">
                        <div style="width: 24px;" class="me-2">
                            <i class="mdi mdi-check-circle text-success"></i>
                        </div>
                        <div>Fotocopy sertifikat</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<!-- JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#pilihSelesai').click(function() {
        $('#formSelesai').slideDown();
        $('#formTunda').slideUp();
        $('#statusAkadInput').val('completed');

        // Ubah style tombol
        $(this).removeClass('konfirmasi-btn-outline-success').addClass('konfirmasi-btn-success');
        $('#pilihTunda').removeClass('konfirmasi-btn-warning').addClass('konfirmasi-btn-outline-warning');
    });

    $('#pilihTunda').click(function() {
        $('#formTunda').slideDown();
        $('#formSelesai').slideUp();
        $('#statusAkadInput').val('problem');

        // Ubah style tombol
        $(this).removeClass('konfirmasi-btn-outline-warning').addClass('konfirmasi-btn-warning');
        $('#pilihSelesai').removeClass('konfirmasi-btn-success').addClass('konfirmasi-btn-outline-success');
    });

    // Modern file upload menampilkan nama dan ukuran
    $('input[type="file"]').change(function(e) {
        const file = e.target.files[0];
        if(file) {
            const sizeInMB = (file.size / (1024*1024)).toFixed(2);
            $(this).closest('.verifikasi-file-upload').find('.verifikasi-file-info span').text(file.name);
            $(this).closest('.verifikasi-file-upload').find('.verifikasi-file-info small').text(sizeInMB + ' MB');
        } else {
            // Reset ke teks awal
            const parent = $(this).closest('.verifikasi-file-upload');
            const label = parent.find('.verifikasi-file-info span');
            const small = parent.find('.verifikasi-file-info small');

            if (parent.find('input[name="dokumen_akad"]').length) {
                label.text('Upload Dokumen Akad');
                small.text('Format: JPG, PNG, PDF (Max 5MB)');
            } else {
                label.text('Upload Dokumen Pendukung');
                small.text('Format: JPG, PNG, PDF (Max 5MB)');
            }
        }
    });
});
</script>
@endpush
