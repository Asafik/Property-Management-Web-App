@extends('layouts.partial.app')

@section('title', 'Detail Customer KPR - Property Management App')

@section('content')
    <style>
        /* ===== MODERN STYLING UNTUK HALAMAN DETAIL CUSTOMER KPR ===== */
        .card {
            transition: all 0.3s ease;
            margin-bottom: 1rem;
            border-radius: 16px !important;
            border: 1px solid #e9ecef !important;
            box-shadow: 0 4px 12px rgba(0,0,0,0.02) !important;
        }

        .card:hover {
            box-shadow: 0 8px 25px rgba(154, 85, 255, 0.1) !important;
        }

        .card-header {
            background: linear-gradient(135deg, #ffffff, #f8f9fa);
            border-bottom: 1px solid #e9ecef;
            padding: 1rem;
            border-radius: 16px 16px 0 0 !important;
        }

        .card-body {
            padding: 1.25rem;
        }

        /* Card Title */
        .card-title {
            font-size: 1rem;
            font-weight: 600;
            color: #9a55ff;
            margin-bottom: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-title i {
            font-size: 1.2rem;
        }

        /* ===== CUSTOM TAB STYLING ===== */
        .detail-custom-tabs-wrapper {
            background: linear-gradient(135deg, #f9f7ff, #f2ecff);
            border-radius: 16px;
            padding: 8px;
            margin-bottom: 1.5rem;
            border: 1px solid rgba(154, 85, 255, 0.1);
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .detail-custom-tabs {
            display: flex;
            flex-wrap: nowrap;
            gap: 6px;
            list-style: none;
            padding: 0;
            margin: 0;
            min-width: min-content;
        }

        .detail-custom-tab-item {
            flex: 0 0 auto;
        }

        .detail-custom-tab-link {
            display: flex;
            align-items: center;
            padding: 12px 24px;
            font-size: 0.9rem;
            font-weight: 600;
            color: #6c7383;
            background: transparent;
            border: none;
            border-radius: 12px;
            text-decoration: none;
            transition: all 0.2s ease;
            white-space: nowrap;
            gap: 10px;
            font-family: 'Nunito', sans-serif;
        }

        .detail-custom-tab-link i {
            font-size: 1.2rem;
            color: #a5b3cb;
            transition: all 0.2s ease;
        }

        .detail-custom-tab-link:hover {
            color: #9a55ff;
            background: #ffffff;
            box-shadow: 0 2px 8px rgba(154, 85, 255, 0.1);
        }

        .detail-custom-tab-link:hover i {
            color: #9a55ff;
        }

        .detail-custom-tab-link.active {
            color: #9a55ff;
            background: #ffffff;
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.15);
            font-weight: 700;
        }

        .detail-custom-tab-link.active i {
            color: #9a55ff;
        }

        /* Tab Content Animation */
        .detail-custom-tab-pane {
            display: none;
        }

        .detail-custom-tab-pane.active {
            display: block;
            animation: detailFadeIn 0.3s ease;
        }

        @keyframes detailFadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ===== HEADER CARD CUSTOMER ===== */
        .customer-header-card {
            background: linear-gradient(135deg, #ffffff, #f8f9fa);
            border-radius: 20px;
            padding: 1.5rem;
            border: 1px solid #e9ecef;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.02);
        }

        .customer-avatar-large {
            width: 90px;
            height: 90px;
            background: linear-gradient(135deg, #da8cff, #9a55ff);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 36px;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.3);
        }

        .customer-status-badge {
            padding: 0.5rem 1.2rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .customer-status-badge.kpr-process {
            background: linear-gradient(135deg, #ffc107, #ffdb6d);
            color: #2c2e3f;
        }

        .customer-status-badge.kpr-approved {
            background: linear-gradient(135deg, #28a745, #5cb85c);
            color: white;
        }

        .customer-status-badge.kpr-rejected {
            background: linear-gradient(135deg, #dc3545, #e4606d);
            color: white;
        }

        /* ===== INFO CARD STYLING UNIFORM ===== */
        .info-card {
            background: #ffffff;
            border: 1px solid #e9ecef;
            border-radius: 16px;
            padding: 1.25rem;
            height: 100%;
            transition: all 0.2s ease;
        }

        .info-card:hover {
            border-color: #9a55ff;
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.05);
        }

        .info-card-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1.25rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid #f0f0f0;
        }

        .info-card-header i {
            font-size: 1.2rem;
            color: #9a55ff;
            background: rgba(154, 85, 255, 0.1);
            padding: 8px;
            border-radius: 12px;
        }

        .info-card-header h6 {
            font-size: 1rem;
            font-weight: 700;
            color: #9a55ff;
            margin: 0;
        }

        /* Info Row Styling */
        .info-row {
            display: flex;
            margin-bottom: 0.75rem;
            font-size: 0.9rem;
            padding: 0.25rem 0;
        }

        .info-label {
            width: 140px;
            color: #6c7383;
            font-weight: 500;
        }

        .info-value {
            flex: 1;
            color: #2c2e3f;
            font-weight: 600;
            padding-left: 15px;
            margin-left: auto;
            text-align: right;
        }

        .info-value strong {
            color: #9a55ff;
        }

        .info-value.text-success {
            color: #28a745 !important;
        }

        .info-value.text-primary {
            color: #9a55ff !important;
        }

        .info-value.text-warning {
            color: #ffc107 !important;
        }

        /* ===== KPR STATUS TIMELINE ===== */
        .kpr-timeline {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 2rem 0;
            position: relative;
        }

        .kpr-timeline::before {
            content: '';
            position: absolute;
            top: 25px;
            left: 0;
            right: 0;
            height: 3px;
            background: #e9ecef;
            z-index: 1;
        }

        .timeline-step {
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            flex: 1;
        }

        .step-icon {
            width: 50px;
            height: 50px;
            background: white;
            border: 2px solid #e9ecef;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.5rem;
            transition: all 0.3s ease;
        }

        .step-icon i {
            font-size: 1.5rem;
            color: #6c7383;
        }

        .timeline-step.completed .step-icon {
            background: linear-gradient(135deg, #28a745, #5cb85c);
            border-color: #28a745;
        }

        .timeline-step.completed .step-icon i {
            color: white;
        }

        .timeline-step.active .step-icon {
            background: linear-gradient(135deg, #9a55ff, #da8cff);
            border-color: #9a55ff;
        }

        .timeline-step.active .step-icon i {
            color: white;
        }

        .step-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: #6c7383;
        }

        .timeline-step.completed .step-label {
            color: #28a745;
        }

        .timeline-step.active .step-label {
            color: #9a55ff;
            font-weight: 700;
        }

        .step-date {
            font-size: 0.7rem;
            color: #6c7383;
            margin-top: 0.25rem;
        }

        /* ===== BANK CARD ===== */
        .bank-card {
            background: #ffffff;
            border: 1px solid #e9ecef;
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 0.75rem;
            transition: all 0.2s ease;
        }

        .bank-card:hover {
            border-color: #9a55ff;
            background: #f9f7ff;
        }

        .bank-card-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 0.5rem;
        }

        .bank-logo {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #f9f7ff, #f2ecff);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .bank-logo i {
            font-size: 1.5rem;
            color: #9a55ff;
        }

        .bank-name {
            font-weight: 600;
            color: #2c2e3f;
        }

        .bank-detail {
            display: flex;
            justify-content: space-between;
            font-size: 0.85rem;
            margin-top: 0.5rem;
            padding-top: 0.5rem;
            border-top: 1px dashed #e9ecef;
        }

        /* ===== DOKUMEN CARD STYLING ===== */
        .dokumen-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.75rem;
            border: 1px solid #e9ecef;
            border-radius: 12px;
            margin-bottom: 0.75rem;
            transition: all 0.2s ease;
        }

        .dokumen-item:hover {
            border-color: #9a55ff;
            background: #f9f7ff;
        }

        .dokumen-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .dokumen-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #f9f7ff, #f2ecff);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .dokumen-icon i {
            font-size: 1.3rem;
            color: #9a55ff;
        }

        .dokumen-name {
            font-weight: 600;
            color: #2c2e3f;
        }

        .dokumen-size {
            font-size: 0.7rem;
            color: #6c7383;
        }

        .btn-action {
            width: 36px;
            height: 36px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: transparent;
            border: 1px solid #e9ecef;
            color: #6c7383;
            transition: all 0.2s ease;
        }

        .btn-action:hover {
            border-color: #9a55ff;
            color: #9a55ff;
            background: #f9f7ff;
            transform: translateY(-2px);
        }

        /* ===== PROGRESS BAR ===== */
        .progress-custom {
            height: 8px;
            border-radius: 4px;
            background-color: #e9ecef;
            margin: 0.75rem 0;
        }

        .progress-custom-bar {
            height: 8px;
            border-radius: 4px;
        }

        .progress-custom-bar.bg-success {
            background: linear-gradient(135deg, #28a745, #5cb85c);
        }

        .progress-custom-bar.bg-warning {
            background: linear-gradient(135deg, #ffc107, #ffdb6d);
        }

        .progress-custom-bar.bg-primary {
            background: linear-gradient(135deg, #9a55ff, #da8cff);
        }

        .progress-custom-bar.bg-info {
            background: linear-gradient(135deg, #17a2b8, #5bc0de);
        }

        /* ===== BUTTON STYLING MODERN ===== */
        .btn-modern {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 0.75rem 1.5rem;
            font-size: 0.9rem;
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .btn-modern-sm {
            padding: 0.5rem 1.2rem;
            font-size: 0.85rem;
        }

        .btn-modern-primary {
            background: linear-gradient(135deg, #9a55ff, #da8cff);
            color: white;
        }

        .btn-modern-success {
            background: linear-gradient(135deg, #28a745, #5cb85c);
            color: white;
        }

        .btn-modern-warning {
            background: linear-gradient(135deg, #ffc107, #ffdb6d);
            color: #2c2e3f;
        }

        .btn-modern-secondary {
            background: linear-gradient(135deg, #6c757d, #a5b3cb);
            color: white;
        }

        .btn-modern-info {
            background: linear-gradient(135deg, #17a2b8, #5bc0de);
            color: white;
        }

        .btn-modern-outline {
            background: transparent;
            border: 1px solid #e9ecef;
            color: #6c7383;
        }

        .btn-modern-outline:hover {
            border-color: #9a55ff;
            color: #9a55ff;
            background: #f9f7ff;
        }

        /* Button group */
        .btn-group-custom {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .info-row {
                flex-direction: column;
            }

            .info-label {
                width: 100%;
                margin-bottom: 0.25rem;
            }

            .info-value {
                padding-left: 0;
                text-align: left;
            }

            .customer-header-card {
                padding: 1.25rem;
            }

            .customer-avatar-large {
                width: 70px;
                height: 70px;
                font-size: 28px;
            }

            .kpr-timeline {
                flex-direction: column;
                gap: 1rem;
            }

            .kpr-timeline::before {
                display: none;
            }

            .timeline-step {
                width: 100%;
                flex-direction: row;
                gap: 1rem;
            }
        }
    </style>

    <div class="container-fluid p-2 p-sm-3 p-md-4">
        <!-- Header Dashboard -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="text-dark mb-1 fw-bold">
                                <i class="mdi mdi-bank me-2" style="color: #9a55ff;"></i>
                                Detail Customer KPR
                            </h3>
                            <p class="text-muted mb-0 small">
                                <i class="mdi mdi-information-outline me-1"></i>
                                Informasi lengkap pengajuan KPR customer
                            </p>
                        </div>
                        <div class="d-none d-sm-block">
                            <i class="mdi mdi-account-circle" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customer Header Card -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="customer-header-card">
                    <div class="d-flex flex-wrap align-items-center gap-4">
                        <!-- Avatar -->
                        <div class="customer-avatar-large">
                            B
                        </div>

                        <!-- Info Customer -->
                        <div class="flex-grow-1">
                            <h4 class="fw-bold mb-2">Budi Santoso</h4>
                            <div class="d-flex flex-wrap gap-3">
                                <span class="text-muted small">
                                    <i class="mdi mdi-card-account-details me-1"></i> ID: CUST/KPR/202503/001
                                </span>
                                <span class="text-muted small">
                                    <i class="mdi mdi-calendar me-1"></i> Pengajuan: 15 Mar 2025
                                </span>
                                <span class="text-muted small">
                                    <i class="mdi mdi-phone me-1"></i> 0812-3456-7890
                                </span>
                                <span class="text-muted small">
                                    <i class="mdi mdi-email me-1"></i> budi.santoso@email.com
                                </span>
                            </div>
                        </div>

                        <!-- Status Badge -->
                        <div class="mt-2 mt-sm-0">
                            <span class="customer-status-badge kpr-process">
                                <i class="mdi mdi-progress-clock"></i>
                                Proses Verifikasi
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Custom Tabs -->
        <div class="row">
            <div class="col-12">
                <div class="detail-custom-tabs-wrapper overflow-auto">
                    <ul class="detail-custom-tabs" id="detailTab" role="tablist">
                        <li class="detail-custom-tab-item">
                            <a class="detail-custom-tab-link active" id="pribadi-tab" data-toggle="tab" href="#pribadi" role="tab">
                                <i class="mdi mdi-account"></i>
                                <span>Pribadi</span>
                            </a>
                        </li>
                        <li class="detail-custom-tab-item">
                            <a class="detail-custom-tab-link" id="alamat-tab" data-toggle="tab" href="#alamat" role="tab">
                                <i class="mdi mdi-map-marker"></i>
                                <span>Alamat</span>
                            </a>
                        </li>
                        <li class="detail-custom-tab-item">
                            <a class="detail-custom-tab-link" id="pekerjaan-tab" data-toggle="tab" href="#pekerjaan" role="tab">
                                <i class="mdi mdi-briefcase"></i>
                                <span>Pekerjaan</span>
                            </a>
                        </li>
                        <li class="detail-custom-tab-item">
                            <a class="detail-custom-tab-link" id="keuangan-tab" data-toggle="tab" href="#keuangan" role="tab">
                                <i class="mdi mdi-cash"></i>
                                <span>Keuangan</span>
                            </a>
                        </li>
                        <li class="detail-custom-tab-item">
                            <a class="detail-custom-tab-link" id="bank-tab" data-toggle="tab" href="#bank" role="tab">
                                <i class="mdi mdi-bank"></i>
                                <span>Bank</span>
                            </a>
                        </li>
                        <li class="detail-custom-tab-item">
                            <a class="detail-custom-tab-link" id="unit-tab" data-toggle="tab" href="#unit" role="tab">
                                <i class="mdi mdi-home"></i>
                                <span>Unit</span>
                            </a>
                        </li>
                        <li class="detail-custom-tab-item">
                            <a class="detail-custom-tab-link" id="dokumen-tab" data-toggle="tab" href="#dokumen" role="tab">
                                <i class="mdi mdi-file-document"></i>
                                <span>Dokumen</span>
                            </a>
                        </li>
                        <li class="detail-custom-tab-item">
                            <a class="detail-custom-tab-link" id="simulasi-tab" data-toggle="tab" href="#simulasi" role="tab">
                                <i class="mdi mdi-calculator"></i>
                                <span>Simulasi</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Tab Content -->
                <div class="tab-content mt-3" id="detailTabContent">

                    <!-- TAB 1: DATA PRIBADI -->
                    <div class="detail-custom-tab-pane active" id="pribadi" role="tabpanel">
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="info-card">
                                    <div class="info-card-header">
                                        <i class="mdi mdi-card-account-details"></i>
                                        <h6>Identitas Diri</h6>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Nama Lengkap</span>
                                        <span class="info-value"><strong>Budi Santoso</strong></span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Nama Panggilan</span>
                                        <span class="info-value">Budi</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">NIK</span>
                                        <span class="info-value">3273012345678901</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Nomor KK</span>
                                        <span class="info-value">3273012345678902</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Tempat Lahir</span>
                                        <span class="info-value">Jakarta</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Tanggal Lahir</span>
                                        <span class="info-value">15 Mei 1990</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Usia</span>
                                        <span class="info-value">35 Tahun</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="info-card">
                                    <div class="info-card-header">
                                        <i class="mdi mdi-account-details"></i>
                                        <h6>Informasi Lainnya</h6>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Jenis Kelamin</span>
                                        <span class="info-value">Laki-laki</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Agama</span>
                                        <span class="info-value">Islam</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Kewarganegaraan</span>
                                        <span class="info-value">WNI</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Status Pernikahan</span>
                                        <span class="info-value">Menikah</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Tanggal Pernikahan</span>
                                        <span class="info-value">10 Januari 2015</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Jumlah Tanggungan</span>
                                        <span class="info-value">3 (Istri + 2 Anak)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 2: ALAMAT -->
                    <div class="detail-custom-tab-pane" id="alamat" role="tabpanel">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="info-card">
                                    <div class="info-card-header">
                                        <i class="mdi mdi-card-account-details"></i>
                                        <h6>Alamat KTP</h6>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Provinsi</span>
                                        <span class="info-value">DKI Jakarta</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Kota/Kabupaten</span>
                                        <span class="info-value">Jakarta Selatan</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Kecamatan</span>
                                        <span class="info-value">Kebayoran Baru</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Kelurahan/Desa</span>
                                        <span class="info-value">Cipete</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">RT / RW</span>
                                        <span class="info-value">001 / 002</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Kode Pos</span>
                                        <span class="info-value">12345</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Alamat Lengkap</span>
                                        <span class="info-value">Jl. Contoh No. 123</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-card">
                                    <div class="info-card-header">
                                        <i class="mdi mdi-home"></i>
                                        <h6>Alamat Domisili</h6>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Provinsi</span>
                                        <span class="info-value">DKI Jakarta</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Kota/Kabupaten</span>
                                        <span class="info-value">Jakarta Selatan</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Kecamatan</span>
                                        <span class="info-value">Kebayoran Baru</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Kelurahan/Desa</span>
                                        <span class="info-value">Cipete</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">RT / RW</span>
                                        <span class="info-value">001 / 002</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Kode Pos</span>
                                        <span class="info-value">12345</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Alamat Lengkap</span>
                                        <span class="info-value">Jl. Contoh No. 123</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 3: PEKERJAAN -->
                    <div class="detail-custom-tab-pane" id="pekerjaan" role="tabpanel">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="info-card">
                                    <div class="info-card-header">
                                        <i class="mdi mdi-briefcase"></i>
                                        <h6>Data Pekerjaan</h6>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Status Pekerjaan</span>
                                        <span class="info-value">Karyawan Swasta</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Perusahaan</span>
                                        <span class="info-value">PT Maju Jaya Abadi</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Bidang Usaha</span>
                                        <span class="info-value">Teknologi Informasi</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Jabatan</span>
                                        <span class="info-value">Senior Developer</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Lama Bekerja</span>
                                        <span class="info-value">5 Tahun</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">NPWP</span>
                                        <span class="info-value">12.345.678.9-123.000</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-card">
                                    <div class="info-card-header">
                                        <i class="mdi mdi-domain"></i>
                                        <h6>Informasi Perusahaan</h6>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Alamat Kantor</span>
                                        <span class="info-value">Jl. Sudirman No. 456</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Kota</span>
                                        <span class="info-value">Jakarta Pusat</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">No. Telepon</span>
                                        <span class="info-value">021-1234-5678</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Email Kantor</span>
                                        <span class="info-value">hrd@majuabadi.com</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 4: KEUANGAN -->
                    <div class="detail-custom-tab-pane" id="keuangan" role="tabpanel">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="info-card">
                                    <div class="info-card-header">
                                        <i class="mdi mdi-cash"></i>
                                        <h6>Penghasilan</h6>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Gaji Pokok</span>
                                        <span class="info-value text-success">Rp 15.000.000</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Tunjangan</span>
                                        <span class="info-value text-success">Rp 3.000.000</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Bonus / Omset</span>
                                        <span class="info-value text-success">Rp 2.000.000</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Penghasilan Pasangan</span>
                                        <span class="info-value text-success">Rp 8.000.000</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label fw-bold">Total Penghasilan</span>
                                        <span class="info-value fw-bold text-success">Rp 28.000.000</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-card">
                                    <div class="info-card-header">
                                        <i class="mdi mdi-cash-minus"></i>
                                        <h6>Pengeluaran Bulanan</h6>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Biaya Hidup</span>
                                        <span class="info-value text-warning">Rp 5.000.000</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Cicilan Kredit</span>
                                        <span class="info-value text-warning">Rp 2.500.000</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Biaya Pendidikan</span>
                                        <span class="info-value text-warning">Rp 1.500.000</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Biaya Lainnya</span>
                                        <span class="info-value text-warning">Rp 1.000.000</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label fw-bold">Total Pengeluaran</span>
                                        <span class="info-value fw-bold text-warning">Rp 10.000.000</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label fw-bold">Sisa Penghasilan</span>
                                        <span class="info-value fw-bold text-primary">Rp 18.000.000</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="info-card">
                                    <div class="info-card-header">
                                        <i class="mdi mdi-chart-line"></i>
                                        <h6>Rasio Keuangan</h6>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="info-row">
                                                <span class="info-label">Debt to Income Ratio</span>
                                                <span class="info-value">35.7% (Baik)</span>
                                            </div>
                                            <div class="progress-custom">
                                                <div class="progress-custom-bar bg-success" style="width: 36%"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="info-row">
                                                <span class="info-label">Kemampuan Angsuran</span>
                                                <span class="info-value">Rp 12.000.000</span>
                                            </div>
                                            <div class="progress-custom">
                                                <div class="progress-custom-bar bg-primary" style="width: 75%"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="info-row">
                                                <span class="info-label">Skor Kredit</span>
                                                <span class="info-value">750 (Bagus)</span>
                                            </div>
                                            <div class="progress-custom">
                                                <div class="progress-custom-bar bg-info" style="width: 80%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 5: BANK -->
                    <div class="detail-custom-tab-pane" id="bank" role="tabpanel">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="info-card">
                                    <div class="info-card-header">
                                        <i class="mdi mdi-bank"></i>
                                        <h6>Bank Pengajuan</h6>
                                    </div>

                                    <div class="bank-card">
                                        <div class="bank-card-header">
                                            <div class="bank-logo">
                                                <i class="mdi mdi-bank"></i>
                                            </div>
                                            <div class="bank-name">Bank Central Asia (BCA)</div>
                                        </div>
                                        <div class="bank-detail">
                                            <span>Plafon: Rp 350.000.000</span>
                                            <span class="text-warning">Proses</span>
                                        </div>
                                    </div>

                                    <div class="bank-card">
                                        <div class="bank-card-header">
                                            <div class="bank-logo">
                                                <i class="mdi mdi-bank"></i>
                                            </div>
                                            <div class="bank-name">Bank Mandiri</div>
                                        </div>
                                        <div class="bank-detail">
                                            <span>Plafon: Rp 400.000.000</span>
                                            <span class="text-success">Disetujui</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-card">
                                    <div class="info-card-header">
                                        <i class="mdi mdi-file-document"></i>
                                        <h6>Detail Pengajuan KPR</h6>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Jenis KPR</span>
                                        <span class="info-value">KPR Subsidi</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Tenor</span>
                                        <span class="info-value">15 Tahun (180 Bulan)</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Suku Bunga</span>
                                        <span class="info-value">5% per tahun (fix 5 tahun)</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Plafon Diajukan</span>
                                        <span class="info-value">Rp 400.000.000</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Plafon Disetujui</span>
                                        <span class="info-value text-success">Rp 380.000.000</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">DP (10%)</span>
                                        <span class="info-value">Rp 38.000.000</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="info-card">
                                    <div class="info-card-header">
                                        <i class="mdi mdi-timeline"></i>
                                        <h6>Timeline Pengajuan KPR</h6>
                                    </div>
                                    <div class="kpr-timeline">
                                        <div class="timeline-step completed">
                                            <div class="step-icon">
                                                <i class="mdi mdi-file-document"></i>
                                            </div>
                                            <div class="step-label">Pengajuan</div>
                                            <div class="step-date">15 Mar 2025</div>
                                        </div>
                                        <div class="timeline-step completed">
                                            <div class="step-icon">
                                                <i class="mdi mdi-account-check"></i>
                                            </div>
                                            <div class="step-label">Verifikasi</div>
                                            <div class="step-date">18 Mar 2025</div>
                                        </div>
                                        <div class="timeline-step active">
                                            <div class="step-icon">
                                                <i class="mdi mdi-bank"></i>
                                            </div>
                                            <div class="step-label">Survey</div>
                                            <div class="step-date">22 Mar 2025</div>
                                        </div>
                                        <div class="timeline-step">
                                            <div class="step-icon">
                                                <i class="mdi mdi-handshake"></i>
                                            </div>
                                            <div class="step-label">Akad</div>
                                            <div class="step-date">-</div>
                                        </div>
                                        <div class="timeline-step">
                                            <div class="step-icon">
                                                <i class="mdi mdi-check-circle"></i>
                                            </div>
                                            <div class="step-label">Cair</div>
                                            <div class="step-date">-</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 6: UNIT -->
                    <div class="detail-custom-tab-pane" id="unit" role="tabpanel">
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="info-card">
                                    <div class="info-card-header">
                                        <i class="mdi mdi-home"></i>
                                        <h6>Detail Unit</h6>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Proyek</span>
                                        <span class="info-value">Grand Emerald</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Blok / No</span>
                                        <span class="info-value"><strong>A.1</strong></span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Tipe</span>
                                        <span class="info-value">Subsidi</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Nama Unit</span>
                                        <span class="info-value">Cluster Mawar</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Luas Tanah</span>
                                        <span class="info-value">200 m²</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Luas Bangunan</span>
                                        <span class="info-value">150 m²</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Hadap</span>
                                        <span class="info-value">Utara</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Posisi</span>
                                        <span class="info-value">Hook</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="info-card">
                                    <div class="info-card-header">
                                        <i class="mdi mdi-currency-usd"></i>
                                        <h6>Informasi Harga</h6>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Harga Unit</span>
                                        <span class="info-value">Rp 450.000.000</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Harga Nego</span>
                                        <span class="info-value text-primary">Rp 435.000.000</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Diskon</span>
                                        <span class="info-value text-success">Rp 15.000.000</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label fw-bold">Harga Final</span>
                                        <span class="info-value fw-bold text-primary">Rp 435.000.000</span>
                                    </div>
                                </div>

                                <div class="info-card mt-4">
                                    <div class="info-card-header">
                                        <i class="mdi mdi-hammer"></i>
                                        <h6>Status Pembangunan</h6>
                                    </div>
                                    <div class="d-flex justify-content-between mb-1">
                                        <span class="fw-medium">Progress</span>
                                        <span class="fw-bold">60%</span>
                                    </div>
                                    <div class="progress-custom">
                                        <div class="progress-custom-bar bg-warning" style="width: 60%"></div>
                                    </div>
                                    <div class="info-row mt-2">
                                        <span class="info-label">Tahap</span>
                                        <span class="info-value">Atap</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Target Selesai</span>
                                        <span class="info-value">Desember 2025</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 7: DOKUMEN KPR -->
                    <div class="detail-custom-tab-pane" id="dokumen" role="tabpanel">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="info-card">
                                    <div class="info-card-header">
                                        <i class="mdi mdi-card-account-details"></i>
                                        <h6>Dokumen Pribadi</h6>
                                    </div>

                                    <div class="dokumen-item">
                                        <div class="dokumen-info">
                                            <div class="dokumen-icon">
                                                <i class="mdi mdi-card-account-details"></i>
                                            </div>
                                            <div>
                                                <div class="dokumen-name">KTP - Budi Santoso</div>
                                                <div class="dokumen-size">1.2 MB • 15 Mar 2025</div>
                                            </div>
                                        </div>
                                        <button class="btn-action">
                                            <i class="mdi mdi-eye"></i>
                                        </button>
                                    </div>

                                    <div class="dokumen-item">
                                        <div class="dokumen-info">
                                            <div class="dokumen-icon">
                                                <i class="mdi mdi-file-document"></i>
                                            </div>
                                            <div>
                                                <div class="dokumen-name">Kartu Keluarga</div>
                                                <div class="dokumen-size">2.5 MB • 15 Mar 2025</div>
                                            </div>
                                        </div>
                                        <button class="btn-action">
                                            <i class="mdi mdi-eye"></i>
                                        </button>
                                    </div>

                                    <div class="dokumen-item">
                                        <div class="dokumen-info">
                                            <div class="dokumen-icon">
                                                <i class="mdi mdi-file-document"></i>
                                            </div>
                                            <div>
                                                <div class="dokumen-name">NPWP</div>
                                                <div class="dokumen-size">0.8 MB • 15 Mar 2025</div>
                                            </div>
                                        </div>
                                        <button class="btn-action">
                                            <i class="mdi mdi-eye"></i>
                                        </button>
                                    </div>

                                    <div class="dokumen-item">
                                        <div class="dokumen-info">
                                            <div class="dokumen-icon">
                                                <i class="mdi mdi-ring"></i>
                                            </div>
                                            <div>
                                                <div class="dokumen-name">Buku Nikah</div>
                                                <div class="dokumen-size">1.1 MB • 15 Mar 2025</div>
                                            </div>
                                        </div>
                                        <button class="btn-action">
                                            <i class="mdi mdi-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-card">
                                    <div class="info-card-header">
                                        <i class="mdi mdi-briefcase"></i>
                                        <h6>Dokumen Pekerjaan & Keuangan</h6>
                                    </div>

                                    <div class="dokumen-item">
                                        <div class="dokumen-info">
                                            <div class="dokumen-icon">
                                                <i class="mdi mdi-file-document"></i>
                                            </div>
                                            <div>
                                                <div class="dokumen-name">Slip Gaji (3 bln)</div>
                                                <div class="dokumen-size">2.1 MB • 15 Mar 2025</div>
                                            </div>
                                        </div>
                                        <button class="btn-action">
                                            <i class="mdi mdi-eye"></i>
                                        </button>
                                    </div>

                                    <div class="dokumen-item">
                                        <div class="dokumen-info">
                                            <div class="dokumen-icon">
                                                <i class="mdi mdi-file-document"></i>
                                            </div>
                                            <div>
                                                <div class="dokumen-name">Rekening Koran (3 bln)</div>
                                                <div class="dokumen-size">3.2 MB • 15 Mar 2025</div>
                                            </div>
                                        </div>
                                        <button class="btn-action">
                                            <i class="mdi mdi-eye"></i>
                                        </button>
                                    </div>

                                    <div class="dokumen-item">
                                        <div class="dokumen-info">
                                            <div class="dokumen-icon">
                                                <i class="mdi mdi-file-sign"></i>
                                            </div>
                                            <div>
                                                <div class="dokumen-name">Surat Keterangan Kerja</div>
                                                <div class="dokumen-size">0.5 MB • 15 Mar 2025</div>
                                            </div>
                                        </div>
                                        <button class="btn-action">
                                            <i class="mdi mdi-eye"></i>
                                        </button>
                                    </div>

                                    <div class="dokumen-item">
                                        <div class="dokumen-info">
                                            <div class="dokumen-icon">
                                                <i class="mdi mdi-file-sign"></i>
                                            </div>
                                            <div>
                                                <div class="dokumen-name">SPT Tahunan</div>
                                                <div class="dokumen-size">1.5 MB • 15 Mar 2025</div>
                                            </div>
                                        </div>
                                        <button class="btn-action">
                                            <i class="mdi mdi-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 8: SIMULASI KPR -->
                    <div class="detail-custom-tab-pane" id="simulasi" role="tabpanel">
                        <div class="row g-4">
                            <div class="col-lg-8 mx-auto">
                                <div class="info-card">
                                    <div class="info-card-header">
                                        <i class="mdi mdi-calculator"></i>
                                        <h6>Simulasi Angsuran KPR</h6>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <div class="info-row">
                                                <span class="info-label">Plafon KPR</span>
                                                <span class="info-value">Rp 380.000.000</span>
                                            </div>
                                            <div class="info-row">
                                                <span class="info-label">Suku Bunga</span>
                                                <span class="info-value">5% per tahun (fix)</span>
                                            </div>
                                            <div class="info-row">
                                                <span class="info-label">Tenor</span>
                                                <span class="info-value">15 Tahun (180 bulan)</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-row">
                                                <span class="info-label">Angsuran Pokok</span>
                                                <span class="info-value">Rp 2.111.111</span>
                                            </div>
                                            <div class="info-row">
                                                <span class="info-label">Angsuran Bunga</span>
                                                <span class="info-value">Rp 1.583.333</span>
                                            </div>
                                            <div class="info-row">
                                                <span class="info-label fw-bold">Total Angsuran</span>
                                                <span class="info-value fw-bold text-primary">Rp 3.694.444</span>
                                            </div>
                                        </div>
                                    </div>

                                    <table class="table table-bordered table-sm">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="text-center">Tahun</th>
                                                <th class="text-center">Sisa Pokok</th>
                                                <th class="text-center">Angsuran/Bln</th>
                                                <th class="text-center">Bunga</th>
                                                <th class="text-center">Pokok</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">1</td>
                                                <td class="text-end">Rp 380.000.000</td>
                                                <td class="text-end">Rp 3.694.444</td>
                                                <td class="text-end">Rp 19.000.000</td>
                                                <td class="text-end">Rp 25.333.333</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">2</td>
                                                <td class="text-end">Rp 354.666.667</td>
                                                <td class="text-end">Rp 3.694.444</td>
                                                <td class="text-end">Rp 17.733.333</td>
                                                <td class="text-end">Rp 26.600.000</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">3</td>
                                                <td class="text-end">Rp 328.066.667</td>
                                                <td class="text-end">Rp 3.694.444</td>
                                                <td class="text-end">Rp 16.403.333</td>
                                                <td class="text-end">Rp 27.930.000</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div class="d-flex justify-content-end gap-2 mt-3">
                                        <button class="btn-modern btn-modern-info">
                                            <i class="mdi mdi-file-excel me-1"></i>Export Excel
                                        </button>
                                        <button class="btn-modern btn-modern-primary">
                                            <i class="mdi mdi-printer me-1"></i>Cetak Simulasi
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi Bawah -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="btn-group-custom justify-content-between">
                            <div class="btn-group-custom">
                                <a href="" class="btn-modern btn-modern-secondary">
                                    <i class="mdi mdi-arrow-left me-1"></i>Kembali
                                </a>
                                <button class="btn-modern btn-modern-warning">
                                    <i class="mdi mdi-clock-outline me-1"></i>Hold
                                </button>
                                <button class="btn-modern btn-modern-success">
                                    <i class="mdi mdi-check-circle me-1"></i>Setujui
                                </button>
                                <button class="btn-modern btn-modern-danger" style="background: linear-gradient(135deg, #dc3545, #e4606d); color: white;">
                                    <i class="mdi mdi-close-circle me-1"></i>Tolak
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            // Simple Tab Functionality
            $('.detail-custom-tab-link').on('click', function(e) {
                e.preventDefault();

                // Remove active class from all tabs and panes
                $('.detail-custom-tab-link').removeClass('active');
                $('.detail-custom-tab-pane').removeClass('active');

                // Add active class to current tab
                $(this).addClass('active');

                // Show corresponding pane
                var target = $(this).attr('href');
                $(target).addClass('active');
            });
        });
    </script>
@endpush
