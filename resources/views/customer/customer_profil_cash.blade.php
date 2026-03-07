@extends('layouts.partial.app')

@section('title', 'Detail Customer - Property Management App')

@section('content')
    <style>
        /* ===== MODERN STYLING UNTUK HALAMAN DETAIL CUSTOMER ===== */
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

        .customer-status-badge.active {
            background: linear-gradient(135deg, #28a745, #5cb85c);
            color: white;
        }

        .customer-status-badge.inactive {
            background: linear-gradient(135deg, #6c757d, #a5b3cb);
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

        /* Info Row Styling - Tanpa Garis Putus-putus */
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

        /* Untuk item yang tidak perlu garis */
        .info-row.no-dots .info-label::after {
            display: none;
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

        /* ===== INVOICE PREVIEW ===== */
        .invoice-preview {
            background: #ffffff;
            border: 1px solid #e9ecef;
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 1rem;
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #f0f0f0;
        }

        .invoice-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #9a55ff;
        }

        .badge-gradient-success {
            background: linear-gradient(135deg, #28a745, #5cb85c);
            color: white;
            padding: 0.5rem 1.2rem;
            border-radius: 30px;
            font-weight: 600;
        }

        .invoice-table {
            width: 100%;
            margin: 1rem 0;
        }

        .invoice-table td {
            padding: 0.5rem 0;
        }

        .invoice-table td:last-child {
            text-align: right;
            font-weight: 600;
        }

        .invoice-total {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 12px;
            font-weight: 700;
            display: flex;
            justify-content: space-between;
            border: 1px solid #e9ecef;
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

        .btn-modern-primary:hover {
            background: linear-gradient(135deg, #8a45e6, #ca7cef);
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
                                <i class="mdi mdi-account-details me-2" style="color: #9a55ff;"></i>
                                Detail Customer
                            </h3>
                            <p class="text-muted mb-0 small">
                                <i class="mdi mdi-information-outline me-1"></i>
                                Informasi lengkap data customer dan riwayat transaksi
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
                                    <i class="mdi mdi-card-account-details me-1"></i> ID: CUST/202502/001
                                </span>
                                <span class="text-muted small">
                                    <i class="mdi mdi-calendar me-1"></i> Bergabung: 12 Feb 2025
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
                            <span class="customer-status-badge active">
                                <i class="mdi mdi-check-circle"></i>
                                Aktif
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
                            <a class="detail-custom-tab-link" id="kontak-tab" data-toggle="tab" href="#kontak" role="tab">
                                <i class="mdi mdi-phone"></i>
                                <span>Kontak</span>
                            </a>
                        </li>
                        <li class="detail-custom-tab-item">
                            <a class="detail-custom-tab-link" id="pekerjaan-tab" data-toggle="tab" href="#pekerjaan" role="tab">
                                <i class="mdi mdi-briefcase"></i>
                                <span>Pekerjaan</span>
                            </a>
                        </li>
                        <li class="detail-custom-tab-item">
                            <a class="detail-custom-tab-link" id="keluarga-tab" data-toggle="tab" href="#keluarga" role="tab">
                                <i class="mdi mdi-account-group"></i>
                                <span>Keluarga</span>
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
                            <a class="detail-custom-tab-link" id="invoice-tab" data-toggle="tab" href="#invoice" role="tab">
                                <i class="mdi mdi-file-pdf-box"></i>
                                <span>Invoice</span>
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
                                        <span class="info-label">Jumlah Anak</span>
                                        <span class="info-value">2</span>
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

                    <!-- TAB 3: KONTAK & MEDIA SOSIAL -->
                    <div class="detail-custom-tab-pane" id="kontak" role="tabpanel">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="info-card">
                                    <div class="info-card-header">
                                        <i class="mdi mdi-phone"></i>
                                        <h6>Kontak Utama</h6>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">No. HP / WA</span>
                                        <span class="info-value"><strong>0812-3456-7890</strong></span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">No. Telepon Rumah</span>
                                        <span class="info-value">021-1234-5678</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Email Pribadi</span>
                                        <span class="info-value">budi.santoso@email.com</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Email Kantor</span>
                                        <span class="info-value">budi.santoso@company.com</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-card">
                                    <div class="info-card-header">
                                        <i class="mdi mdi-share-variant"></i>
                                        <h6>Media Sosial</h6>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Instagram</span>
                                        <span class="info-value">@budisantoso</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Facebook</span>
                                        <span class="info-value">budi.santoso.123</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 4: PEKERJAAN & KEUANGAN -->
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
                                        <span class="info-label">NPWP</span>
                                        <span class="info-value">12.345.678.9-123.000</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-card">
                                    <div class="info-card-header">
                                        <i class="mdi mdi-cash"></i>
                                        <h6>Penghasilan</h6>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Penghasilan Pokok</span>
                                        <span class="info-value text-success">Rp 15.000.000</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Penghasilan Tambahan</span>
                                        <span class="info-value text-success">Rp 2.000.000</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Total Penghasilan</span>
                                        <span class="info-value text-success fw-bold">Rp 17.000.000</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 5: DATA KELUARGA -->
                    <div class="detail-custom-tab-pane" id="keluarga" role="tabpanel">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="info-card">
                                    <div class="info-card-header">
                                        <i class="mdi mdi-account-heart"></i>
                                        <h6>Data Pasangan</h6>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Nama Lengkap</span>
                                        <span class="info-value">Siti Aisyah</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">NIK Pasangan</span>
                                        <span class="info-value">3273012345678903</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-card">
                                    <div class="info-card-header">
                                        <i class="mdi mdi-account-multiple"></i>
                                        <h6>Data Orang Tua</h6>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Nama Ayah</span>
                                        <span class="info-value">Ahmad Supardi</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Nama Ibu</span>
                                        <span class="info-value">Siti Aminah</span>
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
                                        <span class="info-value">perumahan Belanda</span>
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

                    <!-- TAB 7: DOKUMEN -->
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
                                                <div class="dokumen-size">1.2 MB • 12 Feb 2025</div>
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
                                                <div class="dokumen-size">2.5 MB • 12 Feb 2025</div>
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
                                                <div class="dokumen-size">0.8 MB • 12 Feb 2025</div>
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
                                        <i class="mdi mdi-file-document"></i>
                                        <h6>Dokumen Tambahan</h6>
                                    </div>

                                    <div class="dokumen-item">
                                        <div class="dokumen-info">
                                            <div class="dokumen-icon">
                                                <i class="mdi mdi-card-account-details"></i>
                                            </div>
                                            <div>
                                                <div class="dokumen-name">KTP Pasangan</div>
                                                <div class="dokumen-size">1.1 MB • 12 Feb 2025</div>
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
                                                <div class="dokumen-name">Buku Nikah</div>
                                                <div class="dokumen-size">0.5 MB • 12 Feb 2025</div>
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
                                                <div class="dokumen-name">Surat Perjanjian</div>
                                                <div class="dokumen-size">1.5 MB • 25 Mar 2025</div>
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

                    <!-- TAB 8: INVOICE -->
                    <div class="detail-custom-tab-pane" id="invoice" role="tabpanel">
                        <div class="row g-4">
                            <div class="col-lg-8 mx-auto">
                                <div class="info-card">
                                    <div class="invoice-header">
                                        <div class="invoice-title">INVOICE</div>
                                        <span class="badge-gradient-success">LUNAS</span>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <small class="text-muted">No. Invoice</small>
                                            <div class="fw-bold">INV/202503/001</div>
                                        </div>
                                        <div class="col-6 text-end">
                                            <small class="text-muted">Tanggal</small>
                                            <div class="fw-bold">25 Maret 2025</div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <small class="text-muted">Kepada Yth.</small>
                                            <div class="fw-bold">Budi Santoso</div>
                                            <div class="text-muted small">Jl. Contoh No. 123, Jakarta Selatan</div>
                                        </div>
                                    </div>
                                    <hr>
                                    <table class="invoice-table">
                                        <tr>
                                            <td>Booking Unit A.1</td>
                                            <td>Rp 450.000.000</td>
                                        </tr>
                                        <tr>
                                            <td>Diskon (3.33%)</td>
                                            <td>- Rp 15.000.000</td>
                                        </tr>
                                        <tr>
                                            <td>Booking Fee</td>
                                            <td>- Rp 5.000.000</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Total</td>
                                            <td class="fw-bold">Rp 430.000.000</td>
                                        </tr>
                                    </table>
                                    <hr>
                                    <div class="invoice-total">
                                        <span>Total Dibayar</span>
                                        <span class="text-success">Rp 435.000.000</span>
                                    </div>
                                    <div class="d-flex justify-content-end gap-2 mt-3">
                                        <button class="btn-modern btn-modern-info">
                                            <i class="mdi mdi-printer me-1"></i>Cetak
                                        </button>
                                        <button class="btn-modern btn-modern-primary">
                                            <i class="mdi mdi-download me-1"></i>Download PDF
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
