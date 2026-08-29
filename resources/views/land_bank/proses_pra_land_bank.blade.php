@extends('layouts.partial.app')

@section('title', 'Proses Pra Tanah - Property Management App')

@section('content')

    <style>
        /* ===== STEP WIZARD STYLING ===== */
        .step-wizard {
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            margin-bottom: 2.5rem;
            padding: 0 1rem;
        }

        .step-wizard::before {
            content: '';
            position: absolute;
            top: 25px;
            left: 0;
            width: 100%;
            height: 4px;
            background: #e9ecef;
            z-index: 1;
        }

        .step-progress-bar {
            position: absolute;
            top: 25px;
            left: 0;
            width: 0%;
            height: 4px;
            background: linear-gradient(to right, #da8cff, #9a55ff);
            z-index: 2;
            transition: width 0.4s ease;
        }

        .step-item {
            position: relative;
            z-index: 3;
            display: flex;
            flex-direction: column;
            align-items: center;
            cursor: default;
            width: 120px;
        }

        .step-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #ffffff;
            border: 3px solid #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.2rem;
            color: #6c7383;
            transition: all 0.4s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .step-item.active .step-circle {
            border-color: #9a55ff;
            color: #9a55ff;
            background: #f1f0ff;
            box-shadow: 0 0 15px rgba(154, 85, 255, 0.2);
        }

        .step-item.completed .step-circle {
            border-color: #28a745;
            background: #28a745;
            color: #ffffff;
            box-shadow: 0 4px 10px rgba(40, 167, 69, 0.2);
        }

        .step-title {
            margin-top: 0.5rem;
            font-size: 0.8rem;
            font-weight: 600;
            color: #6c7383;
            transition: color 0.4s ease;
            text-align: center;
        }

        .step-item.active .step-title {
            color: #9a55ff;
            font-weight: 700;
        }

        .step-item.completed .step-title {
            color: #28a745;
        }

        .step-item.disabled {
            cursor: not-allowed;
            opacity: 0.6;
        }

        /* ===== GENERAL CARD & FORM STYLING ===== */
        .card {
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
            border: none !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .card:hover {
            box-shadow: 0 8px 25px rgba(154, 85, 255, 0.1) !important;
        }

        .card-header {
            background: linear-gradient(135deg, #ffffff, #f8f9fa);
            border-bottom: 1px solid #e9ecef;
            padding: 0.85rem 1.25rem;
        }

        @media (min-width: 576px) {
            .card-header {
                padding: 1rem 1.25rem;
            }
        }

        .card-title {
            font-size: 1.05rem;
            font-weight: 700;
            color: #2c2e3f;
            margin-bottom: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #9a55ff !important;
            margin-bottom: 0.4rem;
            letter-spacing: 0.3px;
        }

        .form-control,
        .form-select {
            border: 1px solid #e9ecef;
            border-radius: 10px;
            padding: 0.65rem 1rem;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            background-color: #ffffff;
            color: #2c2e3f;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #9a55ff;
            box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.1);
            outline: none;
        }

        .form-control:disabled,
        .form-select:disabled {
            background-color: #f8f9fa;
            color: #6c757d;
            border-color: #e9ecef;
            cursor: not-allowed;
        }

        /* Section within Form Card */
        .form-section {
            margin-bottom: 2rem;
            border-bottom: 1px solid #e9ecef;
            padding-bottom: 1.5rem;
        }

        .form-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .form-section-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: #9a55ff;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-section-title i {
            background: rgba(154, 85, 255, 0.1);
            padding: 6px;
            border-radius: 8px;
            font-size: 1.1rem;
        }

        /* Buttons */
        .btn {
            font-weight: 600;
            padding: 0.7rem 1.5rem;
            border-radius: 10px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border: none;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-gradient-primary {
            background: linear-gradient(to right, #da8cff, #9a55ff) !important;
            color: #ffffff !important;
        }

        .btn-gradient-success {
            background: linear-gradient(135deg, #28a745, #5cb85c) !important;
            color: #ffffff !important;
        }

        .btn-gradient-secondary {
            background: #6c757d !important;
            color: #ffffff !important;
        }

        .btn-outline-purple {
            background: rgba(154, 85, 255, 0.03) !important;
            border: 1px solid #9a55ff !important;
            color: #9a55ff !important;
            border-radius: 10px;
            padding: 0.6rem 1.2rem;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s ease;
        }

        .btn-outline-purple:hover {
            background: #9a55ff !important;
            color: #ffffff !important;
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.2) !important;
            transform: translateY(-2px);
        }

        /* Checkboxes */
        .pratanah-checkbox-group {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            justify-content: flex-start;
            margin-top: 0.5rem;
        }

        .pratanah-checkbox-wrapper {
            position: relative;
            min-width: 140px;
            flex: 1 1 auto;
        }

        .pratanah-checkbox-input {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .pratanah-checkbox-label {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 0.65rem 1.2rem;
            background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
            border: 2px solid #e9ecef;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            width: 100%;
        }

        .pratanah-checkbox-input:checked+.pratanah-checkbox-label {
            border-color: #9a55ff;
            background: linear-gradient(135deg, #f1f0ff, #e8e0ff);
            box-shadow: 0 5px 15px rgba(154, 85, 255, 0.1);
        }

        .pratanah-check-icon {
            font-size: 1.2rem;
            color: #d0d4db;
            transition: all 0.3s ease;
        }

        .pratanah-checkbox-input:checked+.pratanah-checkbox-label .pratanah-check-icon {
            color: #9a55ff;
        }

        .pratanah-check-text {
            font-size: 0.85rem;
            color: #2c2e3f;
            font-weight: 500;
        }

        .pratanah-checkbox-input:checked+.pratanah-checkbox-label .pratanah-check-text {
            color: #9a55ff;
            font-weight: 600;
        }

        /* Modern File Upload */
        .pratanah-file-upload-modern {
            position: relative;
            width: 100%;
        }

        .pratanah-file-upload-modern input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
            z-index: 2;
        }

        .pratanah-file-label-modern {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0.65rem 1rem;
            background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
            border: 2px dashed #d0d4db;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .pratanah-file-upload-modern:hover .pratanah-file-label-modern {
            border-color: #9a55ff;
            background: linear-gradient(135deg, #f1f0ff, #f8f9fa);
        }

        .pratanah-file-label-modern i {
            font-size: 1.3rem;
            color: #9a55ff;
            background: rgba(154, 85, 255, 0.1);
            padding: 8px;
            border-radius: 50%;
        }

        .pratanah-file-info-modern {
            flex: 1;
        }

        .pratanah-file-info-modern span {
            display: block;
            font-weight: 600;
            color: #2c2e3f;
            font-size: 0.8rem;
        }

        .pratanah-file-info-modern small {
            color: #6c7383;
            font-size: 0.65rem;
        }

        .pratanah-file-size {
            font-size: 0.7rem;
            color: #9a55ff;
            font-weight: 600;
            background: rgba(154, 85, 255, 0.1);
            padding: 2px 8px;
            border-radius: 20px;
        }

        /* Map Container */
        .pratanah-map-container {
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid #e9ecef;
            height: 350px;
            margin-top: 0.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        }

        .status-header-badge {
            font-size: 0.8rem;
            font-weight: 700;
            padding: 0.5rem 1rem;
            border-radius: 30px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .status-header-badge.fase1 {
            background: rgba(154, 85, 255, 0.1);
            color: #9a55ff;
        }

        .status-header-badge.fase2 {
            background: rgba(23, 162, 184, 0.1);
            color: #17a2b8;
        }

        .status-header-badge.fase3 {
            background: rgba(40, 167, 69, 0.1);
            color: #28a745;
        }

        .status-header-badge.approved {
            background: linear-gradient(135deg, #28a745, #5cb85c);
            color: white;
        }

        .status-header-badge.rejected {
            background: linear-gradient(135deg, #dc3545, #e4606d);
            color: white;
        }

        .status-header-badge.pending {
            background: rgba(108, 117, 125, 0.1);
            color: #6c757d;
        }

        .d-none {
            display: none !important;
        }



        /* ===== OPTIMASI LEBAR & PADDING (DESKTOP, TABLET & MOBILE) ===== */
        .content-wrapper {
            padding: 1.25rem 1rem !important;
        }

        .card-body {
            padding: 1.25rem 1.5rem;
        }

        /* Mode Tablet (iPad / 768px - 1024px) */
        @media (max-width: 1024px) {
            .content-wrapper {
                padding: 1.15rem 0.85rem !important;
            }
            .container-fluid {
                padding-left: 0.25rem !important;
                padding-right: 0.25rem !important;
            }
        }

        /* Mode HP / Mobile */
        @media (max-width: 576px) {
            .content-wrapper {
                padding: 0.85rem 0.65rem !important;
            }
            .container-fluid {
                padding-left: 0.25rem !important;
                padding-right: 0.25rem !important;
            }
            .card-body {
                padding: 0.85rem 0.85rem !important;
            }
            .step-wizard {
                padding: 0;
            }
            .step-circle {
                width: 38px;
                height: 38px;
                font-size: 0.95rem;
            }
            .step-title {
                font-size: 0.725rem;
            }
        }

        /* ===== B. PASCA-AKUISISI & LEGALITAS PERIZINAN STYLING ===== */
        .pasca-legal-container {
            background: #ffffff;
            border-radius: 12px;
            border: 1px solid #ebedf2;
            padding: 1.25rem;
            margin-top: 1.5rem;
        }
        .pasca-progress-box {
            background: linear-gradient(135deg, #f8f6ff 0%, #f0ebff 100%);
            border: 1px solid #e0d4fc;
            border-radius: 12px;
            padding: 1.15rem 1.25rem;
            margin-bottom: 1.25rem;
        }
        .pasca-progress-bar {
            height: 12px;
            border-radius: 10px;
            background: #e2e8f0;
            overflow: hidden;
        }
        .pasca-progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #9a55ff 0%, #28c76f 100%);
            border-radius: 10px;
            transition: width 0.4s ease;
        }
        .pasca-summary-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 0.35rem 0.75rem;
            border-radius: 30px;
            font-size: 0.78rem;
            font-weight: 600;
        }
        .pasca-summary-pill.selesai {
            background: #e8fadf;
            color: #28a745;
            border: 1px solid #c3e6cb;
        }
        .pasca-summary-pill.proses {
            background: #e8f4fd;
            color: #0d6efd;
            border: 1px solid #b6d4fe;
        }
        .pasca-summary-pill.menunggu {
            background: #fff8e6;
            color: #d97706;
            border: 1px solid #ffe69c;
        }
        .legal-item-card {
            background: #ffffff;
            border: 1px solid #eef0f4;
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 0.85rem;
            transition: all 0.2s ease;
        }
        .legal-item-card:hover {
            border-color: #bfa5fa;
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.08);
        }
        .legal-badge-shgb {
            background: #f3e8ff;
            color: #7e22ce;
            font-weight: 700;
            font-size: 0.75rem;
            padding: 0.25rem 0.55rem;
            border-radius: 6px;
            border: 1px solid #d8b4fe;
        }
    </style>

    <div class="container-fluid px-1 px-sm-2 px-md-3 py-2 py-md-3">

        <!-- Header Card Banner -->
        <div class="row mb-3 mb-md-4">
            <div class="col-12">
                <div class="card shadow-sm border-0 header-card">
                    <div class="card-body p-4 p-md-4 py-4 py-md-4 d-flex flex-wrap justify-content-between align-items-center gap-3" style="min-height: 105px;">
                        <div>
                            <h3 class="text-dark mb-1 fw-bold" style="font-size: 1.35rem;">
                                @if ($land)
                                    @if($land->status == 'approved' || $land->status == 'rejected')
                                        Detail Pra Tanah
                                    @else
                                        Proses Pra Tanah
                                    @endif
                                @else
                                    Tambah Pra Tanah Baru
                                @endif
                            </h3>
                            <p class="text-muted mb-0" style="font-size: 0.9rem;">
                                @if ($land)
                                    Mengelola dan mengulas alur pelepasan tanah untuk <strong>{{ $land->land_name }}</strong>
                                @else
                                    Inisialisasi data penawaran awal makelar (Fase 1)
                                @endif
                            </p>
                        </div>

                        <!-- BUTTON KEMBALI & ICON -->
                        <div class="d-flex align-items-center gap-3">
                            <a href="{{ route('pralandbank.all') }}" class="btn btn-sm btn-gradient-secondary d-inline-flex align-items-center gap-1 btn-back shadow-sm px-3 py-2">
                                <i class="mdi mdi-arrow-left"></i> Kembali
                            </a>
                            <div class="d-none d-md-block pe-2">
                                <i class="mdi mdi-hand-holding-usd" style="font-size: 3rem; color: #9a55ff; opacity: 0.25;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- PIPELINE STEP WIZARD -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body py-4">
                        <div class="step-wizard">
                            <div class="step-progress-bar" id="wizardProgressBar"></div>

                            <!-- STEP 1 -->
                            <div class="step-item" id="step1">
                                <div class="step-circle">1</div>
                                <div class="step-title">Fase 1</div>
                            </div>

                            <!-- STEP 2 -->
                            <div class="step-item {{ !$land ? 'disabled' : '' }}" id="step2">
                                <div class="step-circle">2</div>
                                <div class="step-title">Fase 2</div>
                            </div>

                            <!-- STEP 3 -->
                            <div class="step-item {{ !$land ? 'disabled' : '' }}" id="step3">
                                <div class="step-circle">3</div>
                                <div class="step-title">Fase 3</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- WORKSPACE DYNAMIC CONTENT -->
        <div class="row">
            <div class="col-12">

                <!-- ================= FASE 1 CONTAINER ================= -->
                <div id="containerFase1" class="d-none">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white py-3">
                            <h5 class="card-title mb-0" style="font-weight: 700; color: #2c2e3f;">
                                <i class="mdi mdi-account-tie me-2" style="color: #9a55ff;"></i>FASE 1: Informasi Makelar & Penawaran Awal
                            </h5>
                        </div>
                        <div class="card-body">
                            <form id="formFase1">
                                @csrf
                                <input type="hidden" name="id" value="{{ $land->id ?? '' }}">
                                <input type="hidden" name="fase" value="fase1">

                                <!-- DATA MAKELAR -->
                                <div class="form-section">
                                    <div class="form-section-title">
                                        <i class="mdi mdi-account-card-details"></i> Data Kontak Makelar
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Nama Makelar *</label>
                                            <input type="text" class="form-control" name="land_owner" value="{{ $land->land_owner ?? '' }}" placeholder="Nama Lengkap Makelar" required {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Perusahaan / Instansi</label>
                                            <input type="text" class="form-control" name="land_source" value="{{ $land->land_source ?? '' }}" placeholder="Perusahaan Makelar" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">No. WhatsApp / HP</label>
                                            <input type="text" class="form-control" name="owner_contact" value="{{ $land->owner_contact ?? '' }}" placeholder="Contoh: 08123456789" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Tanggal Penawaran</label>
                                            <input type="date" class="form-control" name="survey_date" value="{{ $land && $land->survey_date ? \Carbon\Carbon::parse($land->survey_date)->format('Y-m-d') : '' }}" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                    </div>
                                </div>

                                <!-- DATA TANAH -->
                                <div class="form-section">
                                    <div class="form-section-title">
                                        <i class="mdi mdi-map-marker-radius"></i> Data Tanah
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Nama Prospek Tanah *</label>
                                            <input type="text" class="form-control" name="land_name" value="{{ $land->land_name ?? '' }}" placeholder="Contoh: Tanah Jember Regency" required {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Status Tanah / Kepemilikan *</label>
                                            <select class="form-select" name="ownership_status" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                <option value="">-- Pilih Status Kepemilikan --</option>
                                                <option value="SHM" {{ ($land && ($land->ownership_status ?? 'SHM') == 'SHM') ? 'selected' : '' }}>SHM (Sertifikat Hak Milik)</option>
                                                <option value="HGB" {{ ($land && $land->ownership_status == 'HGB') ? 'selected' : '' }}>HGB (Hak Guna Bangunan)</option>
                                                <option value="HGU" {{ ($land && $land->ownership_status == 'HGU') ? 'selected' : '' }}>HGU (Hak Guna Usaha)</option>
                                                <option value="HP" {{ ($land && $land->ownership_status == 'HP') ? 'selected' : '' }}>HP (Hak Pakai)</option>
                                                <option value="Girik" {{ ($land && $land->ownership_status == 'Girik') ? 'selected' : '' }}>Girik / Letter C</option>
                                                <option value="Petok D" {{ ($land && $land->ownership_status == 'Petok D') ? 'selected' : '' }}>Petok D</option>
                                                <option value="AJB" {{ ($land && $land->ownership_status == 'AJB') ? 'selected' : '' }}>AJB (Akta Jual Beli)</option>
                                                <option value="Lainnya" {{ ($land && $land->ownership_status == 'Lainnya') ? 'selected' : '' }}>Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Nama di Sertifikat / Surat</label>
                                            <input type="text" class="form-control" id="certificate_owner" name="certificate_owner" value="{{ $land->certificate_owner ?? '' }}" placeholder="Nama pemilik sah di sertifikat" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <label class="form-label mb-0">Nama Pemilik Tanah</label>
                                                <label class="d-flex align-items-center gap-2 mb-0 px-2 py-1 rounded" for="sameAsCertificate" style="cursor: pointer; background: rgba(154, 85, 255, 0.08); border: 1px solid rgba(154, 85, 255, 0.25); user-select: none;">
                                                    <input class="form-check-input m-0" type="checkbox" id="sameAsCertificate" {{ $land && $land->owner_name && $land->certificate_owner && $land->owner_name === $land->certificate_owner ? 'checked' : '' }} {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }} style="cursor: pointer; width: 16px; height: 16px; accent-color: #9a55ff; border: 1.5px solid #9a55ff;">
                                                    <span class="fw-bold" style="font-size: 0.78rem; color: #782cd1;">
                                                        Sama dengan sertifikat
                                                    </span>
                                                </label>
                                            </div>
                                            <input type="text" class="form-control" id="owner_name" name="owner_name" value="{{ $land->owner_name ?? '' }}" placeholder="Nama pemilik tanah saat ini" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="form-label">Alamat Lengkap *</label>
                                            <input type="text" class="form-control" name="address" value="{{ $land->address ?? '' }}" placeholder="Alamat lengkap lokasi tanah" required {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Luas Tanah (m²)</label>
                                            <input type="number" class="form-control" name="area" value="{{ $land->area ?? '' }}" placeholder="Luas tanah" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Lebar Jalan Depan (m)</label>
                                            <input type="number" class="form-control" name="road_width" value="{{ $land->road_width ?? '' }}" placeholder="Lebar jalan" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Jenis Konstruksi Jalan</label>
                                            <select class="form-select" name="road_type" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                <option value="">Pilih</option>
                                                <option value="aspal" {{ $land && $land->road_type == 'aspal' ? 'selected' : '' }}>Aspal</option>
                                                <option value="beton" {{ $land && $land->road_type == 'beton' ? 'selected' : '' }}>Beton</option>
                                                <option value="paving" {{ $land && $land->road_type == 'paving' ? 'selected' : '' }}>Paving</option>
                                                <option value="tanah" {{ $land && $land->road_type == 'tanah' ? 'selected' : '' }}>Tanah</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- NEGOSIASI HARGA -->
                                <div class="form-section">
                                    <div class="form-section-title">
                                        <i class="mdi mdi-currency-usd"></i> Negosiasi Harga Awal
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Harga Penawaran Awal (Rp)</label>
                                            <input type="text" class="form-control" id="offer_price" name="offer_price" value="{{ $land && $land->offer_price ? number_format($land->offer_price, 0, ',', '.') : '' }}" oninput="formatRupiah(this)" placeholder="Harga penawaran" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Harga Target Negosiasi (Rp)</label>
                                            <input type="text" class="form-control" id="estimated_price" name="estimated_price" value="{{ $land && $land->estimated_price ? number_format($land->estimated_price, 0, ',', '.') : '' }}" oninput="formatRupiah(this)" placeholder="Harga negosiasi" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                    </div>
                                </div>

                                <!-- ACTIONS -->
                                <div class="d-flex justify-content-end gap-3 mt-4">
                                    @if (!$land || ($land && $land->status != 'approved' && $land->status != 'rejected'))
                                        <button type="button" class="btn btn-gradient-primary" onclick="saveFase1()">
                                            <i class="mdi mdi-content-save-all"></i> Simpan Fase 1
                                        </button>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- ================= FASE 2 CONTAINER ================= -->
                <div id="containerFase2" class="d-none">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white py-3">
                            <h5 class="card-title mb-0" style="font-weight: 700; color: #2c2e3f;">
                                <i class="mdi mdi-magnify me-2" style="color: #9a55ff;"></i>FASE 2: Verifikasi Kelayakan, Dokumen & Spasial Map
                            </h5>
                        </div>
                        <div class="card-body">
                            <form id="formFase2" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $land->id ?? '' }}">
                                <input type="hidden" name="fase" value="fase2">

                                <!-- PROFIL PEMILIK & INFORMASI TANAH DARI FASE 1 -->
                                <div class="form-section">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="form-section-title mb-0">
                                            <i class="mdi mdi-account-box-outline"></i> Profil Pemilik & Informasi Tanah (Fase 1)
                                        </div>
                                        <button type="button" class="btn btn-sm btn-outline-purple py-1 px-3" onclick="switchStep(1)" style="font-size: 0.78rem;">
                                            <i class="mdi mdi-pencil me-1"></i> Edit Data Fase 1
                                        </button>
                                    </div>

                                    <div class="row g-3">
                                        <!-- Card Profil Pemilik -->
                                        <div class="col-md-6">
                                            <div class="p-3 rounded-3 h-100" style="background: linear-gradient(135deg, #fbf9ff, #f6f0ff); border: 1px solid rgba(154, 85, 255, 0.2);">
                                                <h6 class="fw-bold text-primary mb-3 d-flex align-items-center gap-2" style="font-size: 0.88rem;">
                                                    <i class="mdi mdi-account-tie"></i> Data Pemilik & Makelar
                                                </h6>
                                                <div class="d-flex flex-column gap-2" style="font-size: 0.85rem;">
                                                    <div class="d-flex justify-content-between pb-1 border-bottom" style="border-color: rgba(154, 85, 255, 0.1) !important;">
                                                        <span class="text-muted">Nama Pemilik Tanah:</span>
                                                        <span class="fw-bold text-dark">{{ $land->owner_name ?? ($land->certificate_owner ?? '-') }}</span>
                                                    </div>
                                                    <div class="d-flex justify-content-between pb-1 border-bottom" style="border-color: rgba(154, 85, 255, 0.1) !important;">
                                                        <span class="text-muted">Nama di Sertifikat:</span>
                                                        <span class="fw-bold text-dark">{{ $land->certificate_owner ?? '-' }}</span>
                                                    </div>
                                                    <div class="d-flex justify-content-between pb-1 border-bottom" style="border-color: rgba(154, 85, 255, 0.1) !important;">
                                                        <span class="text-muted">Nama Makelar:</span>
                                                        <span class="fw-semibold text-dark">{{ $land->land_owner ?? '-' }}</span>
                                                    </div>
                                                    <div class="d-flex justify-content-between pb-1 border-bottom" style="border-color: rgba(154, 85, 255, 0.1) !important;">
                                                        <span class="text-muted">Instansi / Perusahaan:</span>
                                                        <span class="text-dark">{{ $land->land_source ?? '-' }}</span>
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <span class="text-muted">No. WhatsApp / HP:</span>
                                                        <span class="fw-bold text-success">
                                                            @if(!empty($land->owner_contact))
                                                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $land->owner_contact) }}" target="_blank" class="text-success text-decoration-none d-inline-flex align-items-center">
                                                                    <i class="mdi mdi-whatsapp me-1"></i>{{ $land->owner_contact }}
                                                                </a>
                                                            @else
                                                                -
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Card Data Tanah & Nilai -->
                                        <div class="col-md-6">
                                            <div class="p-3 rounded-3 h-100" style="background: linear-gradient(135deg, #fbf9ff, #f6f0ff); border: 1px solid rgba(154, 85, 255, 0.2);">
                                                <h6 class="fw-bold text-primary mb-3 d-flex align-items-center gap-2" style="font-size: 0.88rem;">
                                                    <i class="mdi mdi-map-marker-radius"></i> Informasi Prospek & Nilai Tanah
                                                </h6>
                                                <div class="d-flex flex-column gap-2" style="font-size: 0.85rem;">
                                                    <div class="d-flex justify-content-between pb-1 border-bottom" style="border-color: rgba(154, 85, 255, 0.1) !important;">
                                                        <span class="text-muted">Nama Prospek:</span>
                                                        <span class="fw-bold text-dark">{{ $land->land_name ?? '-' }}</span>
                                                    </div>
                                                    <div class="d-flex justify-content-between pb-1 border-bottom" style="border-color: rgba(154, 85, 255, 0.1) !important;">
                                                        <span class="text-muted">Status Kepemilikan:</span>
                                                        <span class="badge text-white px-2 py-1" style="background: linear-gradient(135deg, #da8cff, #9a55ff); font-size: 0.75rem;">
                                                            {{ $land->ownership_status ?? 'SHM' }}
                                                        </span>
                                                    </div>
                                                    <div class="d-flex justify-content-between pb-1 border-bottom" style="border-color: rgba(154, 85, 255, 0.1) !important;">
                                                        <span class="text-muted">Luas Tanah:</span>
                                                        <span class="fw-bold text-dark">{{ $land && $land->area ? number_format($land->area, 0, ',', '.') . ' m²' : '-' }}</span>
                                                    </div>
                                                    <div class="d-flex justify-content-between pb-1 border-bottom" style="border-color: rgba(154, 85, 255, 0.1) !important;">
                                                        <span class="text-muted">Harga Penawaran:</span>
                                                        <span class="text-danger fw-semibold">Rp {{ number_format($land->offer_price ?? 0, 0, ',', '.') }}</span>
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <span class="text-muted">Target Negosiasi:</span>
                                                        <span class="text-primary fw-bold">Rp {{ number_format($land->estimated_price ?? 0, 0, ',', '.') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Alamat Lokasi -->
                                        <div class="col-12">
                                            <div class="p-2 px-3 rounded-2 d-flex align-items-center gap-2" style="background: #ffffff; border: 1px dashed rgba(154, 85, 255, 0.4); font-size: 0.85rem;">
                                                <i class="mdi mdi-map-marker text-danger" style="font-size: 1.1rem;"></i>
                                                <span class="text-muted">Lokasi:</span>
                                                <span class="fw-semibold text-dark">{{ $land->address ?? 'Alamat belum diisi pada Fase 1' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- SURVEY LAPANGAN -->
                                <div class="form-section">
                                    <div class="form-section-title">
                                        <i class="mdi mdi-checkbox-marked-circle-outline"></i> Survey Fisik Lapangan
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Tanggal Survey Fisik</label>
                                            <input type="date" class="form-control" name="tgl_survey" value="{{ $land && $land->survey_date ? \Carbon\Carbon::parse($land->survey_date)->format('Y-m-d') : '' }}" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Status Lahan</label>
                                            <select class="form-select" name="land_status_temp" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                <option value="">Pilih Status Lahan</option>
                                                <option value="bekas_sawah" {{ $land && $land->land_status == 'bekas_sawah' ? 'selected' : '' }}>Lahan Bekas Sawah</option>
                                                <option value="perbukitan" {{ $land && $land->land_status == 'perbukitan' ? 'selected' : '' }}>Perbukitan</option>
                                                <option value="pekarangan" {{ $land && $land->land_status == 'pekarangan' ? 'selected' : '' }}>Pekarangan</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Kondisi Air</label>
                                            <select class="form-select" name="water_condition_temp" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                <option value="">Pilih Kondisi Air</option>
                                                <option value="sumur_bor" {{ $land && $land->water_condition == 'sumur_bor' ? 'selected' : '' }}>Sumur Bor</option>
                                                <option value="pdam" {{ $land && $land->water_condition == 'pdam' ? 'selected' : '' }}>PDAM</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- KEJELASAN LEGALITAS -->
                                <div class="form-section">
                                    <div class="form-section-title">
                                        <i class="mdi mdi-scale-balance"></i> Aspek Kejelasan Legalitas Tanah
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Status Kejelasan Sengketa</label>
                                            <select class="form-select" id="select_status_tanah" name="status_tanah" onchange="toggleMasalahHukum()" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                <option value="clear" {{ $land && $land->legal_status == 'clear' ? 'selected' : '' }}>Clear & Clean (Bebas Sengketa)</option>
                                                <option value="checking" {{ $land && $land->legal_status == 'checking' ? 'selected' : '' }}>Dalam Pengecekan Notaris/BPN</option>
                                                <option value="problem" {{ $land && $land->legal_status == 'problem' ? 'selected' : '' }}>Bermasalah / Dalam Sengketa</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3 {{ ($land && $land->legal_status == 'problem') ? '' : 'd-none' }}" id="wrapper_keterangan_masalah">
                                            <label class="form-label text-danger">Detail Permasalahan Hukum <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control border-danger" id="input_keterangan_masalah" name="keterangan_masalah" value="{{ $land->legal_issue_note ?? '' }}" placeholder="Catatan masalah legalitas / sengketa" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                    </div>
                                </div>

                                <!-- PERIZINAN & FASILITAS SEKITAR -->
                                <div class="form-section">
                                    <div class="form-section-title">
                                        <i class="mdi mdi-office-building"></i> Zonasi & Fasilitas Publik Sekitar
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Rencana Tata Ruang / Zonasi</label>
                                            <input type="text" class="form-control" name="zoning" value="{{ $land->zoning ?? '' }}" placeholder="Contoh: Perumahan Kepadatan Sedang, Komersil" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Tingkat Kesulitan Pengurusan Izin</label>
                                            <select class="form-select" id="select_kesulitan_izin" name="kesulitan_izin" onchange="toggleKeteranganIzin()" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                <option value="mudah" {{ $land && $land->permit_difficulty == 'mudah' ? 'selected' : '' }}>Mudah</option>
                                                <option value="sedang" {{ $land && $land->permit_difficulty == 'sedang' ? 'selected' : '' }}>Sedang</option>
                                                <option value="sulit" {{ $land && $land->permit_difficulty == 'sulit' ? 'selected' : '' }}>Sulit</option>
                                                <option value="very_sulit" {{ $land && $land->permit_difficulty == 'very_sulit' ? 'selected' : '' }}>Sangat Sulit (Zonasi Hijau)</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12 mb-3 {{ ($land && in_array($land->permit_difficulty, ['sulit', 'very_sulit'])) ? '' : 'd-none' }}" id="wrapper_keterangan_izin">
                                            <label class="form-label text-danger fw-semibold">Detail / Keterangan Masalah Izin <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control border-danger" id="input_keterangan_izin" name="keterangan_kesulitan_izin" value="{{ $land->permit_difficulty_note ?? '' }}" placeholder="Catatan kendala pengurusan perizinan (contoh: Masuk zona hijau / kendala tata ruang / butuh rekomendasi khusus)..." {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="form-label">Fasilitas Sekitar</label>
                                            <div class="pratanah-checkbox-group">
                                                <div class="pratanah-checkbox-wrapper">
                                                    <input type="checkbox" class="pratanah-checkbox-input" name="fasilitas[]" value="sekolah" id="fase2_fac_sekolah" {{ $land && $land->facility_school ? 'checked' : '' }} {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                    <label class="pratanah-checkbox-label" for="fase2_fac_sekolah">
                                                        <i class="mdi mdi-check-circle pratanah-check-icon"></i>
                                                        <span class="pratanah-check-text">Sekolah</span>
                                                    </label>
                                                </div>
                                                <div class="pratanah-checkbox-wrapper">
                                                    <input type="checkbox" class="pratanah-checkbox-input" name="fasilitas[]" value="rumah_sakit" id="fase2_fac_rs" {{ $land && $land->facility_hospital ? 'checked' : '' }} {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                    <label class="pratanah-checkbox-label" for="fase2_fac_rs">
                                                        <i class="mdi mdi-check-circle pratanah-check-icon"></i>
                                                        <span class="pratanah-check-text">Rumah Sakit</span>
                                                    </label>
                                                </div>
                                                <div class="pratanah-checkbox-wrapper">
                                                    <input type="checkbox" class="pratanah-checkbox-input" name="fasilitas[]" value="pasar" id="fase2_fac_pasar" {{ $land && $land->facility_market ? 'checked' : '' }} {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                    <label class="pratanah-checkbox-label" for="fase2_fac_pasar">
                                                        <i class="mdi mdi-check-circle pratanah-check-icon"></i>
                                                        <span class="pratanah-check-text">Pasar</span>
                                                    </label>
                                                </div>
                                                <div class="pratanah-checkbox-wrapper">
                                                    <input type="checkbox" class="pratanah-checkbox-input" name="fasilitas[]" value="transportasi" id="fase2_fac_trans" {{ $land && $land->facility_transport ? 'checked' : '' }} {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                    <label class="pratanah-checkbox-label" for="fase2_fac_trans">
                                                        <i class="mdi mdi-check-circle pratanah-check-icon"></i>
                                                        <span class="pratanah-check-text">Transportasi</span>
                                                    </label>
                                                </div>
                                                <div class="pratanah-checkbox-wrapper">
                                                    <input type="checkbox" class="pratanah-checkbox-input" name="fasilitas[]" value="mall" id="fase2_fac_mall" {{ $land && $land->facility_mall ? 'checked' : '' }} {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                    <label class="pratanah-checkbox-label" for="fase2_fac_mall">
                                                        <i class="mdi mdi-check-circle pratanah-check-icon"></i>
                                                        <span class="pratanah-check-text">Mall</span>
                                                    </label>
                                                </div>
                                                <div class="pratanah-checkbox-wrapper">
                                                    <input type="checkbox" class="pratanah-checkbox-input" name="fasilitas[]" value="bank" id="fase2_fac_bank" {{ $land && $land->facility_bank ? 'checked' : '' }} {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                    <label class="pratanah-checkbox-label" for="fase2_fac_bank">
                                                        <i class="mdi mdi-check-circle pratanah-check-icon"></i>
                                                        <span class="pratanah-check-text">Bank / ATM</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- DOKUMEN LEGALITAS & UPLOAD BERKAS (KOTAK PER FILE) -->
                                <div class="form-section">
                                    <div class="form-section-title">
                                        <i class="mdi mdi-file-document-multiple-outline"></i> Dokumen Legalitas & Upload Berkas
                                    </div>

                                    @php
                                        $uploadedDocs = [];
                                        if ($land) {
                                            foreach ($land->documents as $d) {
                                                $uploadedDocs[$d->document_type_id] = $d;
                                            }
                                        }
                                    @endphp

                                    <div class="row g-3" id="documentGridContainer">
                                        @foreach($documentTypes as $doc)
                                            @php
                                                $existingDoc = $uploadedDocs[$doc->id] ?? null;
                                            @endphp
                                            <div class="col-md-6 col-lg-4" id="doc-box-{{ $doc->id }}">
                                                <div class="card h-100 border shadow-sm rounded-3 p-3 position-relative" style="background: #ffffff; border-color: #eaedf2 !important;">
                                                    <!-- Header Card Box -->
                                                    <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <div class="p-2 rounded-2" style="background: rgba(154, 85, 255, 0.1); color: #9a55ff;">
                                                                <i class="mdi mdi-file-document-outline" style="font-size: 1.25rem;"></i>
                                                            </div>
                                                            <div>
                                                                <h6 class="mb-0 fw-bold text-dark" style="font-size: 0.92rem;">{{ $doc->name }}</h6>
                                                                <span class="badge bg-light text-primary border" style="font-size: 10px; font-family: monospace;">{{ $doc->code }}</span>
                                                            </div>
                                                        </div>
                                                        @if($existingDoc && !empty($existingDoc->file_path))
                                                            <span class="badge bg-success py-1 px-2" style="font-size: 10px;">
                                                                <i class="mdi mdi-check-circle me-1"></i>Tersedia
                                                            </span>
                                                        @else
                                                            <span class="badge bg-light text-muted border py-1 px-2" style="font-size: 10px;">
                                                                Belum Upload
                                                            </span>
                                                        @endif
                                                    </div>

                                                    <!-- Input Nomor Dokumen -->
                                                    <div class="mb-3">
                                                        <label class="form-label mb-1 text-muted" style="font-size: 0.8rem; font-weight: 600;">
                                                            Nomor Dokumen {{ $doc->name }}
                                                        </label>
                                                        <input type="text" class="form-control"
                                                            name="documents[{{ $doc->id }}][number]"
                                                            value="{{ $existingDoc->document_number ?? '' }}"
                                                            placeholder="Nomor {{ $doc->name }}"
                                                            style="font-size: 0.85rem;"
                                                            {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                    </div>

                                                    <!-- Upload Berkas File -->
                                                    <div class="mb-1 flex-grow-1 d-flex flex-column justify-content-end">
                                                        <label class="form-label mb-1 text-muted" style="font-size: 0.8rem; font-weight: 600;">
                                                            Upload Berkas (PDF / JPG / PNG)
                                                        </label>

                                                        @if (!$land || ($land && $land->status != 'approved' && $land->status != 'rejected'))
                                                            <div class="pratanah-file-upload-modern">
                                                                <input type="file" name="documents[{{ $doc->id }}][file]" accept=".pdf,.jpg,.jpeg,.png">
                                                                <div class="pratanah-file-label-modern py-2 px-3">
                                                                    <i class="mdi mdi-cloud-upload"></i>
                                                                    <div class="pratanah-file-info-modern">
                                                                        <span class="file-label-text" style="font-size: 0.82rem;">Pilih Berkas {{ $doc->name }}</span>
                                                                        <small style="font-size: 0.72rem; color: #8c98a4;">Maksimal ukuran 2MB</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif

                                                        @if($existingDoc && !empty($existingDoc->file_path))
                                                            @php
                                                                $cleanPath = str_replace('uploads/', '', $existingDoc->file_path);
                                                            @endphp
                                                            <div class="mt-2 pt-2 border-top d-flex align-items-center justify-content-between">
                                                                <a href="{{ route('dokumen.preview', ['path' => $cleanPath]) }}" target="_blank" class="btn btn-xs btn-outline-primary py-1 px-2" style="font-size: 11px;">
                                                                    <i class="mdi mdi-eye me-1"></i>Lihat Berkas
                                                                </a>
                                                                <span class="text-muted" style="font-size: 10px;">
                                                                    {{ $existingDoc->updated_at ? $existingDoc->updated_at->format('d M Y') : '' }}
                                                                </span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- SPASIAL MAPS KOORDINAT -->
                                <div class="form-section">
                                    <div class="form-section-title">
                                        <i class="mdi mdi-map-marker"></i> Koordinat
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Latitude</label>
                                            <input type="text" class="form-control" id="fase2_lat" name="lat"
                                                value="{{ $land->lat ?? '-8.1727' }}" placeholder="Contoh: -6.2088" required {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Longitude</label>
                                            <input type="text" class="form-control" id="fase2_lng" name="lng"
                                                value="{{ $land->lng ?? '113.7000' }}" placeholder="Contoh: 106.8456" required {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <div class="pratanah-map-container">
                                                <div id="map-fase2" style="height: 100%; width: 100%;"></div>
                                            </div>
                                        </div>
                                        <div class="col-12 text-end">
                                            <button type="button" class="btn btn-outline-purple"
                                                onclick="getCurrentLocation()" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                <i class="mdi mdi-map-marker"></i> Gunakan Lokasi Saya
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- ACTIONS -->
                                <div class="d-flex justify-content-end gap-3 mt-4">
                                    @if (!$land || ($land && $land->status != 'approved' && $land->status != 'rejected'))
                                        <button type="button" class="btn btn-gradient-primary" onclick="saveFase2()">
                                            <i class="mdi mdi-content-save-all"></i> Simpan Fase 2
                                        </button>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- ================= FASE 3 CONTAINER ================= -->
                <div id="containerFase3" class="d-none">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white py-3">
                            <h5 class="card-title mb-0" style="font-weight: 700; color: #2c2e3f;">
                                <i class="mdi mdi-check-decagram me-2" style="color: #9a55ff;"></i>FASE 3: Sidang & Keputusan Akhir
                            </h5>
                        </div>
                        <div class="card-body">
                            <form id="formFase3">
                                @csrf
                                <input type="hidden" name="id" value="{{ $land->id ?? '' }}">
                                <input type="hidden" name="fase" value="fase3">

                                <!-- KEPUTUSAN HULU KE HILIR -->
                                <div class="form-section">
                                    <div class="form-section-title">
                                        <i class="mdi mdi-gavel"></i> Keputusan Akusisi Tanah
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Hasil Keputusan Sidang Akhir *</label>
                                            <select class="form-select" id="fase3_status_akhir" name="status" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                <option value="approved" {{ $land && $land->status == 'approved' ? 'selected' : '' }}>DIAMBIL - Deal untuk Diakuisisi</option>
                                                <option value="pending" {{ $land && $land->status == 'pending' ? 'selected' : '' }}>DIPENDING - Ditunda Sementara</option>
                                                <option value="rejected" {{ $land && $land->status == 'rejected' ? 'selected' : '' }}>DIBATALKAN - Gugur Prospeknya</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Skala Prioritas Akusisi</label>
                                            <select class="form-select" name="prioritas" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                <option value="urgent" {{ $land && $land->priority == 'urgent' ? 'selected' : '' }}>Urgent (Segera Diputuskan)</option>
                                                <option value="high" {{ $land && $land->priority == 'high' ? 'selected' : '' }}>High (Tinggi)</option>
                                                <option value="normal" {{ $land && ($land->priority == 'normal' || !$land->priority) ? 'selected' : '' }}>Normal</option>
                                                <option value="low" {{ $land && $land->priority == 'low' ? 'selected' : '' }}>Low (Rendah)</option>
                                            </select>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="form-label">Catatan & Kesimpulan Keputusan Akhir</label>
                                            <textarea class="form-control" name="catatan" rows="4" placeholder="Masukan keputusan penawaran harga final deal makelar, tanggal rencana akta pelepasan..." {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>{{ $land->notes ?? '' }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <!-- BIAYA LEGALITAS & ADMIN -->
                                <div class="form-section">
                                    <div class="form-section-title">
                                        <i class="mdi mdi-scale-balance"></i> Aspek Legalitas & Biaya Administrasi
                                    </div>
                                    
                                    <!-- 1. Estimasi Biaya Administrasi -->
                                    <div class="row mb-3">
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">Biaya IJB / PPJB (Rp)</label>
                                            <input type="text" class="form-control" name="biaya_ijb_temp" value="{{ $land && $land->cost_ijb ? number_format($land->cost_ijb, 0, ',', '.') : '' }}" placeholder="Contoh: 10.000.000" onkeyup="formatRupiahTemp(this)" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">Estimasi Pajak PPh/BPHTB (Rp)</label>
                                            <input type="text" class="form-control" name="biaya_pajak_temp" value="{{ $land && $land->cost_tax ? number_format($land->cost_tax, 0, ',', '.') : '' }}" placeholder="Contoh: 50.000.000" onkeyup="formatRupiahTemp(this)" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">Fee Makelar (Rp)</label>
                                            <input type="text" class="form-control" name="fee_makelar_temp" value="{{ $land && $land->cost_broker ? number_format($land->cost_broker, 0, ',', '.') : '' }}" placeholder="Contoh: 15.000.000" onkeyup="formatRupiahTemp(this)" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">Biaya Lain-lain Admin (Rp)</label>
                                            <input type="text" class="form-control" name="biaya_lain_temp" value="{{ $land && $land->cost_other ? number_format($land->cost_other, 0, ',', '.') : '' }}" placeholder="Contoh: 5.000.000" onkeyup="formatRupiahTemp(this)" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                    </div>

                                    <!-- 2. Berkas Dokumen Kelengkapan Legalitas & Perizinan -->
                                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-2 gap-2">
                                        <h6 class="mb-0 text-dark fw-bold" style="font-size: 0.9rem;">
                                            <i class="mdi mdi-file-document-multiple text-primary me-1"></i>Dokumen Kelengkapan Legalitas & Perizinan
                                        </h6>
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="text-muted" style="font-size: 0.78rem;">Progres Unggah:</span>
                                            <span class="badge bg-primary text-white fw-bold" id="doc_progress_badge" style="font-size: 0.78rem;">0 dari 6 Berkas (0%)</span>
                                        </div>
                                    </div>

                                    <!-- SLIM MINI PROGRESS BAR & PILLS -->
                                    <div class="p-2 px-3 mb-3" style="background: #f8f9fa; border: 1px solid #e9ecef; border-radius: 10px;">
                                        <div class="progress mb-2" style="height: 6px; border-radius: 10px; background-color: #e9ecef;">
                                            <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" id="doc_progress_bar" role="progressbar" style="width: 0%;"></div>
                                        </div>
                                        <div class="d-flex flex-wrap gap-2 pt-1" style="font-size: 0.75rem;">
                                            <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1" id="pill_doc_uploaded">
                                                <i class="mdi mdi-check-circle me-1"></i><span id="count_doc_uploaded">0</span> Berkas Sudah Diunggah
                                            </span>
                                            <span class="badge bg-light text-muted border px-2 py-1" id="pill_doc_unuploaded">
                                                <i class="mdi mdi-clock-outline me-1"></i><span id="count_doc_unuploaded">6</span> Berkas Belum Diunggah
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row g-3">
                                        <!-- 1. Akta Pelepasan Hak / PPJB / AJB -->
                                        <div class="col-12 col-lg-6">
                                            <div class="legal-item-card h-100 p-3" data-has-file="{{ $land && $land->file_ijb ? 'true' : 'false' }}">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <div>
                                                        <h6 class="fw-bold text-dark mb-1" style="font-size: 0.88rem;">
                                                            1. Akta Pelepasan Hak / PPJB / AJB Notaris
                                                        </h6>
                                                        <small class="text-muted d-block" style="font-size: 0.75rem;">Peralihan hak resmi dari pemilik asal ke PT</small>
                                                    </div>
                                                    <span class="badge {{ $land && $land->file_ijb ? 'bg-success' : 'bg-secondary' }} doc-card-badge" style="font-size: 10px;">
                                                        <i class="mdi {{ $land && $land->file_ijb ? 'mdi-check-circle' : 'mdi-clock-outline' }} me-1"></i>
                                                        <span class="badge-text">{{ $land && $land->file_ijb ? 'Sudah Diunggah' : 'Belum Diunggah' }}</span>
                                                    </span>
                                                </div>
                                                <div class="mb-2">
                                                    <label class="form-label" style="font-size: 0.75rem;">No. Akta / SPH</label>
                                                    <input type="text" class="form-control form-control-sm" value="SPH/2026/04/018" placeholder="No. Akta" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                </div>
                                                <div class="pratanah-file-upload-modern mt-2">
                                                    <input type="file" name="file_ijb_temp" id="file_ijb_temp" class="d-none doc-file-input" onchange="handleDocFileUpload(this)" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                    <label for="file_ijb_temp" class="pratanah-file-label-modern mb-0 w-100 py-2">
                                                        <i class="mdi mdi-cloud-upload-outline fs-4"></i>
                                                        <div class="pratanah-file-info-modern">
                                                            <span class="file-name-text">{{ $land && $land->file_ijb ? basename($land->file_ijb) : 'Unggah Berkas Akta / SPH' }}</span>
                                                            <small>Format: PDF, JPG, PNG (Maks 10MB)</small>
                                                        </div>
                                                    </label>
                                                    @if($land && $land->file_ijb)
                                                        @php $cleanIjbPath = str_replace('uploads/', '', $land->file_ijb); @endphp
                                                        <div class="mt-2 d-flex align-items-center justify-content-between">
                                                            <a href="{{ route('dokumen.preview', ['path' => $cleanIjbPath]) }}" target="_blank" class="btn btn-xs btn-outline-primary py-1 px-2" style="font-size: 11px;">
                                                                <i class="mdi mdi-eye me-1"></i>Lihat Berkas
                                                            </a>
                                                            <span class="badge bg-success py-1 px-2" style="font-size: 10px;"><i class="mdi mdi-check-circle me-1"></i>Tersedia</span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!-- 2. Validasi Pajak PPh & BPHTB -->
                                        <div class="col-12 col-lg-6">
                                            <div class="legal-item-card h-100 p-3" data-has-file="{{ $land && $land->file_tax ? 'true' : 'false' }}">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <div>
                                                        <h6 class="fw-bold text-dark mb-1" style="font-size: 0.88rem;">
                                                            2. Validasi Pajak (PPh Final & BPHTB)
                                                        </h6>
                                                        <small class="text-muted d-block" style="font-size: 0.75rem;">Pelunasan & validasi pajak daerah Bapenda/KPP</small>
                                                    </div>
                                                    <span class="badge {{ $land && $land->file_tax ? 'bg-success' : 'bg-secondary' }} doc-card-badge" style="font-size: 10px;">
                                                        <i class="mdi {{ $land && $land->file_tax ? 'mdi-check-circle' : 'mdi-clock-outline' }} me-1"></i>
                                                        <span class="badge-text">{{ $land && $land->file_tax ? 'Sudah Diunggah' : 'Belum Diunggah' }}</span>
                                                    </span>
                                                </div>
                                                <div class="mb-2">
                                                    <label class="form-label" style="font-size: 0.75rem;">No. NTPN / Bukti Setor</label>
                                                    <input type="text" class="form-control form-control-sm" value="NTPN-8829103991" placeholder="Kode NTPN" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                </div>
                                                <div class="pratanah-file-upload-modern mt-2">
                                                    <input type="file" name="file_pajak_temp" id="file_pajak_temp" class="d-none doc-file-input" onchange="handleDocFileUpload(this)" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                    <label for="file_pajak_temp" class="pratanah-file-label-modern mb-0 w-100 py-2">
                                                        <i class="mdi mdi-cloud-upload-outline fs-4"></i>
                                                        <div class="pratanah-file-info-modern">
                                                            <span class="file-name-text">{{ $land && $land->file_tax ? basename($land->file_tax) : 'Unggah Bukti Setor Pajak' }}</span>
                                                            <small>Format: PDF, JPG, PNG (Maks 10MB)</small>
                                                        </div>
                                                    </label>
                                                    @if($land && $land->file_tax)
                                                        @php $cleanTaxPath = str_replace('uploads/', '', $land->file_tax); @endphp
                                                        <div class="mt-2 d-flex align-items-center justify-content-between">
                                                            <a href="{{ route('dokumen.preview', ['path' => $cleanTaxPath]) }}" target="_blank" class="btn btn-xs btn-outline-primary py-1 px-2" style="font-size: 11px;">
                                                                <i class="mdi mdi-eye me-1"></i>Lihat Berkas
                                                            </a>
                                                            <span class="badge bg-success py-1 px-2" style="font-size: 10px;"><i class="mdi mdi-check-circle me-1"></i>Tersedia</span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!-- 3. KKPR / Izin Lokasi OSS -->
                                        <div class="col-12 col-lg-6">
                                            <div class="legal-item-card h-100 p-3" data-has-file="false">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <div>
                                                        <h6 class="fw-bold text-dark mb-1" style="font-size: 0.88rem;">
                                                            3. KKPR / Izin Lokasi OSS
                                                        </h6>
                                                        <small class="text-muted d-block" style="font-size: 0.75rem;">Kesesuaian Kegiatan Pemanfaatan Ruang perumahan</small>
                                                    </div>
                                                    <span class="badge bg-secondary doc-card-badge" style="font-size: 10px;">
                                                        <i class="mdi mdi-clock-outline me-1"></i>
                                                        <span class="badge-text">Belum Diunggah</span>
                                                    </span>
                                                </div>
                                                <div class="mb-2">
                                                    <label class="form-label" style="font-size: 0.75rem;">No. SK KKPR</label>
                                                    <input type="text" class="form-control form-control-sm" value="503/KKPR-JBR/2026" placeholder="No. SK KKPR" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                </div>
                                                <div class="pratanah-file-upload-modern mt-2">
                                                    <input type="file" id="dummy_file_kkpr" class="d-none doc-file-input" onchange="handleDocFileUpload(this)" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                    <label for="dummy_file_kkpr" class="pratanah-file-label-modern mb-0 w-100 py-2">
                                                        <i class="mdi mdi-cloud-upload-outline fs-4"></i>
                                                        <div class="pratanah-file-info-modern">
                                                            <span class="file-name-text">Unggah Dokumen SK KKPR</span>
                                                            <small>Format: PDF, JPG, PNG (Maks 10MB)</small>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- 4. Pengesahan Siteplan Induk -->
                                        <div class="col-12 col-lg-6">
                                            <div class="legal-item-card h-100 p-3" data-has-file="false">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <div>
                                                        <h6 class="fw-bold text-dark mb-1" style="font-size: 0.88rem;">
                                                            4. Pengesahan Rencana Tapak / Siteplan
                                                        </h6>
                                                        <small class="text-muted d-block" style="font-size: 0.75rem;">Persetujuan tata letak kavling & PSU Dinas Perkim</small>
                                                    </div>
                                                    <span class="badge bg-secondary doc-card-badge" style="font-size: 10px;">
                                                        <i class="mdi mdi-clock-outline me-1"></i>
                                                        <span class="badge-text">Belum Diunggah</span>
                                                    </span>
                                                </div>
                                                <div class="mb-2">
                                                    <label class="form-label" style="font-size: 0.75rem;">No. SK Siteplan</label>
                                                    <input type="text" class="form-control form-control-sm" value="640/STP-PERKIM/2026" placeholder="No. Pengesahan" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                </div>
                                                <div class="pratanah-file-upload-modern mt-2">
                                                    <input type="file" id="dummy_file_siteplan" class="d-none doc-file-input" onchange="handleDocFileUpload(this)" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                    <label for="dummy_file_siteplan" class="pratanah-file-label-modern mb-0 w-100 py-2">
                                                        <i class="mdi mdi-cloud-upload-outline fs-4"></i>
                                                        <div class="pratanah-file-info-modern">
                                                            <span class="file-name-text">Unggah Lembar Siteplan Sah</span>
                                                            <small>Format: PDF, JPG, PNG (Maks 10MB)</small>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- 5. Pengurusan SHGB Induk PT -->
                                        <div class="col-12 col-lg-6">
                                            <div class="legal-item-card h-100 p-3" data-has-file="false">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <div>
                                                        <h6 class="fw-bold text-dark mb-1" style="font-size: 0.88rem;">
                                                            5. Pengurusan SHGB Induk PT
                                                        </h6>
                                                        <small class="text-muted d-block" style="font-size: 0.75rem;">Sertifikat Hak Guna Bangunan atas nama PT dari BPN</small>
                                                    </div>
                                                    <span class="badge bg-secondary doc-card-badge" style="font-size: 10px;">
                                                        <i class="mdi mdi-clock-outline me-1"></i>
                                                        <span class="badge-text">Belum Diunggah</span>
                                                    </span>
                                                </div>
                                                <div class="mb-2">
                                                    <label class="form-label" style="font-size: 0.75rem;">No. SHGB Induk</label>
                                                    <input type="text" class="form-control form-control-sm" value="HGB.01422/Kec.Kaliwates" placeholder="No. SHGB Induk" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                </div>
                                                <div class="pratanah-file-upload-modern mt-2">
                                                    <input type="file" id="dummy_file_shgb" class="d-none doc-file-input" onchange="handleDocFileUpload(this)" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                    <label for="dummy_file_shgb" class="pratanah-file-label-modern mb-0 w-100 py-2">
                                                        <i class="mdi mdi-cloud-upload-outline fs-4"></i>
                                                        <div class="pratanah-file-info-modern">
                                                            <span class="file-name-text">Unggah Scan SHGB Induk</span>
                                                            <small>Format: PDF, JPG, PNG (Maks 10MB)</small>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- 6. Persetujuan Bangunan Gedung (PBG / IMB Induk) -->
                                        <div class="col-12 col-lg-6">
                                            <div class="legal-item-card h-100 p-3" data-has-file="false">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <div>
                                                        <h6 class="fw-bold text-dark mb-1" style="font-size: 0.88rem;">
                                                            6. Persetujuan Bangunan Gedung (PBG / IMB Induk)
                                                        </h6>
                                                        <small class="text-muted d-block" style="font-size: 0.75rem;">Izin konstruksi bangunan induk perumahan melalui SIMBG</small>
                                                    </div>
                                                    <span class="badge bg-secondary doc-card-badge" style="font-size: 10px;">
                                                        <i class="mdi mdi-clock-outline me-1"></i>
                                                        <span class="badge-text">Belum Diunggah</span>
                                                    </span>
                                                </div>
                                                <div class="mb-2">
                                                    <label class="form-label" style="font-size: 0.75rem;">No. Registrasi / SK PBG</label>
                                                    <input type="text" class="form-control form-control-sm" value="" placeholder="PBG-3509-2026..." {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                </div>
                                                <div class="pratanah-file-upload-modern mt-2">
                                                    <input type="file" id="dummy_file_pbg" class="d-none doc-file-input" onchange="handleDocFileUpload(this)" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                    <label for="dummy_file_pbg" class="pratanah-file-label-modern mb-0 w-100 py-2">
                                                        <i class="mdi mdi-cloud-upload-outline fs-4"></i>
                                                        <div class="pratanah-file-info-modern">
                                                            <span class="file-name-text">Unggah Dokumen SK PBG Induk</span>
                                                            <small>Format: PDF, JPG, PNG (Maks 10MB)</small>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- SKEMA PEMBAYARAN & PEMBAYARAN BERTAHAP -->
                                <div class="form-section">
                                    <div class="form-section-title">
                                        <i class="mdi mdi-cash-multiple"></i> Skema Pembayaran & Pembayaran Bertahap
                                    </div>

                                    <!-- HARGA DEAL & DP CALCULATOR -->
                                    <div class="row mb-3">
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label text-muted">Harga Target Negosiasi (Fase 1)</label>
                                            <input type="text" class="form-control" value="Rp {{ $land && $land->estimated_price ? number_format($land->estimated_price, 0, ',', '.') : '0' }}" disabled style="background-color: #e9ecef; color: #495057; font-weight: 600;">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label text-dark font-weight-bold">Harga Deal Akhir Tanah (Rp)</label>
                                            <input type="text" class="form-control" id="deal_price_input" value="Rp {{ $land && $land->estimated_price ? number_format($land->estimated_price, 0, ',', '.') : '0' }}" disabled style="background-color: #e9ecef; color: #495057; font-weight: 600;">
                                        </div>
                                        <div class="col-md-3 mb-3" id="dp_container" style="display: none;">
                                            <label class="form-label text-primary font-weight-bold">Uang Muka / DP (Rp)</label>
                                            <input type="text" class="form-control border-success mb-2" id="dp_price_input" placeholder="Masukkan nominal DP" value="{{ ($land && $land->payments->count() > 0) ? number_format($land->payments->first()->amount, 0, ',', '.') : '' }}" onkeyup="formatRupiahTemp(this); calculateInstallments();" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                            
                                            <!-- Upload Bukti Transfer DP (Dummy Preview UI) -->
                                            <div class="pratanah-file-upload-modern">
                                                <input type="file" id="dummy_file_dp" class="d-none" onchange="handleDummyFileName(this)" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                <label for="dummy_file_dp" class="pratanah-file-label-modern mb-0 w-100 py-1 px-2" style="border-radius: 6px; font-size: 11px;">
                                                    <i class="mdi mdi-cloud-upload-outline fs-5 me-1"></i>
                                                    <div class="pratanah-file-info-modern">
                                                        <span class="file-name-text">Unggah Bukti DP</span>
                                                        <small>Format: PDF/JPG/PNG</small>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3" id="remaining_container" style="display: none;">
                                            <label class="form-label text-muted">Sisa Pembayaran (Rp)</label>
                                            <input type="text" class="form-control font-weight-bold" id="remaining_price_input" value="0" disabled style="background-color: #f8f9fa;">
                                        </div>
                                    </div>

                                    <!-- RINCIAN AKUMULASI TOTAL BIAYA & POTONGAN DP WIDGET -->
                                    <div class="card shadow-none border mb-4 p-3" style="border-radius: 12px; background: #ffffff;">
                                        <div class="d-flex align-items-center mb-2">
                                            <h6 class="mb-0 text-dark fw-bold" style="font-size: 0.9rem;">
                                                <i class="mdi mdi-calculator text-primary me-1"></i>Rincian Akumulasi Total Biaya & Potongan DP
                                            </h6>
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table table-sm table-bordered align-middle mb-0" style="font-size: 0.85rem;">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Komponen Transaksi</th>
                                                        <th class="text-end" width="40%">Nominal (Rp)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><span class="fw-semibold text-dark">Harga Deal Pokok Tanah</span></td>
                                                        <td class="text-end fw-bold text-dark" id="calc_summary_deal">Rp 0</td>
                                                    </tr>
                                                    <tr>
                                                        <td><span>Biaya IJB / PPJB Notaris</span></td>
                                                        <td class="text-end" id="calc_summary_ijb">Rp 0</td>
                                                    </tr>
                                                    <tr>
                                                        <td><span>Estimasi Pajak (PPh & BPHTB)</span></td>
                                                        <td class="text-end" id="calc_summary_pajak">Rp 0</td>
                                                    </tr>
                                                    <tr>
                                                        <td><span>Fee Makelar / Perantara</span></td>
                                                        <td class="text-end" id="calc_summary_makelar">Rp 0</td>
                                                    </tr>
                                                    <tr>
                                                        <td><span>Biaya Lain-lain Admin</span></td>
                                                        <td class="text-end" id="calc_summary_lain">Rp 0</td>
                                                    </tr>
                                                    <tr style="background: rgba(154, 85, 255, 0.08);">
                                                        <td><strong class="text-purple" style="color: #7e22ce;">TOTAL KESELURUHAN BIAYA (Grand Total)</strong></td>
                                                        <td class="text-end fw-bold text-purple" id="calc_summary_grand_total" style="color: #7e22ce; font-size: 0.95rem;">Rp 0</td>
                                                    </tr>
                                                    <tr style="background: rgba(255, 193, 7, 0.12);">
                                                        <td><strong class="text-danger">Dipotong Uang Muka / DP (Tahap 1)</strong></td>
                                                        <td class="text-end fw-bold text-danger" id="calc_summary_dp">- Rp 0</td>
                                                    </tr>
                                                    <tr style="background: rgba(40, 167, 69, 0.12);">
                                                        <td><strong class="text-success" style="font-size: 0.92rem;">SISA KEWAJIBAN PEMBAYARAN POKOK</strong></td>
                                                        <td class="text-end fw-bold text-success" id="calc_summary_sisa" style="font-size: 1.05rem;">Rp 0</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- METODE PEMBAYARAN & JANGKA WAKTU -->
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Metode Pembayaran Kesepakatan</label>
                                            <select class="form-select" id="temp_payment_method" name="payment_method_temp" onchange="toggleInstallmentView(); updateFinancialSummary();" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                <option value="cash" {{ $land && $land->payment_method == 'cash' ? 'selected' : '' }}>Cash Keras (Lunas Sekaligus)</option>
                                                <option value="termin" {{ $land && $land->payment_method == 'termin' ? 'selected' : '' }}>Pembayaran Bertahap</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3" id="temp_duration_container" style="display: none;">
                                            <label class="form-label">Jangka Waktu Bertahap (Maks. 1 Tahun)</label>
                                            <select class="form-select" id="temp_installment_duration" name="installment_duration_temp" onchange="generateInstallmentRows()" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                <option value="3_bulan" {{ $land && $land->installment_duration == '3_bulan' ? 'selected' : '' }}>3 Bulan</option>
                                                <option value="6_bulan" {{ $land && $land->installment_duration == '6_bulan' ? 'selected' : '' }}>6 Bulan</option>
                                                <option value="9_bulan" {{ $land && $land->installment_duration == '9_bulan' ? 'selected' : '' }}>9 Bulan</option>
                                                <option value="1_tahun" {{ $land && ($land->installment_duration == '1_tahun' || !$land->installment_duration) ? 'selected' : '' }}>1 Tahun</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3" id="temp_count_container" style="display: none;">
                                            <label class="form-label">Frekuensi Pembayaran</label>
                                            <select class="form-select" id="temp_installment_count" name="installment_count_temp" onchange="generateInstallmentRows()" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                <option value="2" {{ $land && $land->installment_count == 2 ? 'selected' : '' }}>2x Bayar</option>
                                                <option value="3" {{ $land && $land->installment_count == 3 ? 'selected' : '' }}>3x Bayar</option>
                                                <option value="4" {{ $land && ($land->installment_count == 4 || !$land->installment_count) ? 'selected' : '' }}>4x Bayar</option>
                                                <option value="5" {{ $land && $land->installment_count == 5 ? 'selected' : '' }}>5x Bayar</option>
                                                <option value="6" {{ $land && $land->installment_count == 6 ? 'selected' : '' }}>6x Bayar</option>
                                                <option value="12" {{ $land && $land->installment_count == 12 ? 'selected' : '' }}>12x Bayar</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- INSTALLMENT WIDGET -->
                                    <div id="installment_widget_container" class="card shadow-none border mt-3 p-3" style="display: none; background: rgba(0,0,0,0.02); border-radius: 12px;">
                                        <div class="mb-3">
                                            <h6 class="mb-0 text-dark font-weight-bold">
                                                <i class="mdi mdi-calendar-clock text-primary"></i> Rencana Rincian Jadwal Pembayaran Bertahap
                                            </h6>
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover align-middle mb-0" style="background: white;">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th width="12%">Tahap</th>
                                                        <th width="30%">Nominal Pembayaran</th>
                                                        <th width="18%">Jatuh Tempo</th>
                                                        <th width="25%">Bukti Dokumentasi (Temp)</th>
                                                        <th width="15%">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="installment_tbody">
                                                    @if($land && $land->payments->count() > 0)
                                                        @foreach($land->payments as $index => $payment)
                                                            @php $i = $index + 1; @endphp
                                                            <tr>
                                                                <td class="font-weight-bold text-primary text-center">
                                                                    {{ $payment->term_name }}
                                                                    <input type="hidden" name="installments[{{ $i }}][term_name]" value="{{ $payment->term_name }}">
                                                                </td>
                                                                <td>
                                                                                                                                        <input type="text" name="installments[{{ $i }}][amount_temp]" class="form-control form-control-sm" value="Rp {{ number_format($payment->amount, 0, ',', '.') }}" placeholder="Rp 0" onkeyup="formatRupiahTemp(this); calculateInstallments();" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                                </td>
                                                                <td>
                                                                    <input type="date" name="installments[{{ $i }}][due_date]" class="form-control form-control-sm" value="{{ $payment->due_date ? \Carbon\Carbon::parse($payment->due_date)->format('Y-m-d') : '' }}" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                                </td>
                                                                <td>
                                                                    <div class="pratanah-file-upload-modern py-1 px-2 d-flex align-items-center justify-content-between" style="border-width: 1px; border-style: dashed; border-radius: 6px; background: rgba(0,0,0,0.01);">
                                                                        <input type="file" name="installments[{{ $i }}][file]" id="file_tahap_{{ $i }}" class="d-none" onchange="handleTerminFileName(this)" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                                        <label for="file_tahap_{{ $i }}" class="mb-0 d-flex align-items-center gap-2 cursor-pointer w-100" style="font-size: 11px;">
                                                                            <i class="mdi mdi-file-upload text-muted fs-5"></i>
                                                                            <span class="text-truncate text-muted file-label-text" style="max-width: 120px;">
                                                                                {{ $payment->file_path ? basename($payment->file_path) : 'Pilih Bukti' }}
                                                                            </span>
                                                                        </label>
                                                                        @if($payment->file_path)
                                                                            @php
                                                                                $cleanPath = str_replace('uploads/', '', $payment->file_path);
                                                                            @endphp
                                                                            <a href="{{ route('dokumen.preview', ['path' => $cleanPath]) }}" target="_blank" class="btn btn-xs btn-link p-0 ms-1 text-primary" title="Lihat Berkas">
                                                                                <i class="mdi mdi-eye" style="font-size: 14px;"></i>
                                                                            </a>
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <select name="installments[{{ $i }}][status]" class="form-select form-select-sm" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                                        <option value="belum" {{ $payment->status == 'belum' ? 'selected' : '' }}>Belum</option>
                                                                        <option value="lunas" {{ $payment->status == 'lunas' ? 'selected' : '' }}>Lunas</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- ACTIONS -->
                                <div class="d-flex justify-content-end gap-3 mt-4">
                                    @if (!$land || ($land && $land->status != 'approved' && $land->status != 'rejected'))
                                        <button type="button" class="btn btn-gradient-success" onclick="saveFase3()">
                                            <i class="mdi mdi-content-save"></i> Simpan Fase 3
                                        </button>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        // State variables
        let activeStep = 1;
        const isEditMode = {{ $land ? 'true' : 'false' }};
        const currentLandStatus = "{{ $land->status ?? 'fase1' }}";

        // Read step query param if present
        const urlParams = new URLSearchParams(window.location.search);
        const queryStep = parseInt(urlParams.get('step'));

        // Determine step based on query parameter or fallback to land status
        if (isEditMode) {
            if (queryStep >= 1 && queryStep <= 3) {
                activeStep = queryStep;
            } else {
                if (currentLandStatus === 'fase2') {
                    activeStep = 2;
                } else if (currentLandStatus === 'fase3' || currentLandStatus === 'approved' || currentLandStatus === 'rejected') {
                    activeStep = 3;
                }
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Render correct step view upon loading
            switchStep(activeStep);

            // Initial toggle for installment view (do not regenerate rows to preserve Blade pre-render)
            toggleInstallmentView(true);



            // Handle customized file inputs
            document.querySelectorAll('.pratanah-file-upload-modern input[type="file"]').forEach(input => {
                input.addEventListener('change', function() {
                    const container = this.closest('.pratanah-file-upload-modern');
                    const label = container.querySelector('.pratanah-file-label-modern');
                    const fileName = container.querySelector('.pratanah-file-info-modern span');
                    const fileInfo = container.querySelector('.pratanah-file-info-modern small');
                    const icon = container.querySelector('i');

                    if (this.files && this.files.length > 0) {
                        const file = this.files[0];
                        const size = (file.size / 1024).toFixed(1) + ' KB';

                        // Change styling to selected status
                        fileName.textContent = file.name;
                        fileInfo.textContent = size;
                        fileInfo.className = 'pratanah-file-size';
                        icon.className = 'mdi mdi-check-circle';
                        label.style.borderColor = '#9a55ff';
                        label.style.background = 'linear-gradient(135deg, #f1f0ff, #f8f9fa)';
                    } else {
                        // Reset if no files selected
                        fileName.textContent = 'Upload File';
                        fileInfo.textContent = 'PDF / JPG / PNG';
                        fileInfo.className = '';
                        icon.className = 'mdi mdi-file';
                        label.style.borderColor = '#d0d4db';
                        label.style.background = 'linear-gradient(135deg, #f8f9fa, #f1f3f5)';
                    }
                });
            });
        });

        // ===============================
        // DYNAMIC STEP MANAGER
        // ===============================
        function switchStep(step) {
            // If in create mode and user tries to skip to step 2 or 3, reject
            if (!isEditMode && step > 1) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Langkah Terkunci',
                    text: 'Silakan isi dan simpan data Fase 1 terlebih dahulu.'
                });
                return;
            }


            activeStep = step;

            // Manage CSS display containers
            document.getElementById('containerFase1').classList.add('d-none');
            document.getElementById('containerFase2').classList.add('d-none');
            document.getElementById('containerFase3').classList.add('d-none');

            // Reset active & completed classes and text
            document.getElementById('step1').classList.remove('active', 'completed');
            document.getElementById('step2').classList.remove('active', 'completed');
            document.getElementById('step3').classList.remove('active', 'completed');

            document.querySelector('#step1 .step-circle').innerHTML = '1';
            document.querySelector('#step2 .step-circle').innerHTML = '2';
            document.querySelector('#step3 .step-circle').innerHTML = '3';

            // Show active container
            document.getElementById(`containerFase${step}`).classList.remove('d-none');
            document.getElementById(`step${step}`).classList.add('active');

            // Apply completed status & checkmarks
            if (isEditMode) {
                document.getElementById('step1').classList.add('completed');
                document.querySelector('#step1 .step-circle').innerHTML = '<i class="mdi mdi-check"></i>';
            }

            if (isEditMode && currentLandStatus !== 'fase1') {
                document.getElementById('step2').classList.add('completed');
                document.querySelector('#step2 .step-circle').innerHTML = '<i class="mdi mdi-check"></i>';
            }

            if (isEditMode && (currentLandStatus === 'approved' || currentLandStatus === 'rejected')) {
                document.getElementById('step3').classList.add('completed');
                document.querySelector('#step3 .step-circle').innerHTML = '<i class="mdi mdi-check"></i>';
            }

            // Manage Progress Bar Width
            if (step === 1) {
                document.getElementById('wizardProgressBar').style.width = '0%';
            } else if (step === 2) {
                document.getElementById('wizardProgressBar').style.width = '50%';
                setTimeout(() => initMapFase2(), 300);
            } else if (step === 3) {
                document.getElementById('wizardProgressBar').style.width = '100%';
            }
        }

        // ===============================
        // FORMAT RUPIAH
        // ===============================
        function formatRupiah(input) {
            let value = input.value.replace(/[^,\d]/g, '');
            let split = value.split(',');
            let sisa = split[0].length % 3;
            let rupiah = split[0].substr(0, sisa);
            let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            input.value = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        }

        // ===============================
        // HELPER FETCH API
        // ===============================
        async function fetchJSON(url, formData) {
            const res = await fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
            });

            const text = await res.text();

            try {
                return JSON.parse(text);
            } catch {
                console.error("Non-JSON Response received:", text);
                throw new Error("Sistem Server Mengalami Gangguan.");
            }
        }

        // ===============================
        // NOTIFICATIONS
        // ===============================
        function showError(msg) {
            Swal.fire({
                icon: 'error',
                title: 'Transaksi Gagal',
                text: msg
            });
        }

        function showLoading(msg = 'Menyimpan progres...') {
            Swal.fire({
                title: msg,
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });
        }

        // ===============================
        // AJAX SAVE FLOWS
        // ===============================
        async function saveFase1() {
            try {
                showLoading('Menyimpan Fase 1...');
                let form = document.getElementById('formFase1');
                let formData = new FormData(form);

                let res = await fetchJSON("{{ route('pra-landbanks.store') }}", formData);
                Swal.close();

                if (res.success) {
                    sessionStorage.setItem('success_message', 'Data Fase 1 berhasil disimpan.');
                    window.location.href = "{{ route('pralandbank.all') }}";
                } else {
                    showError(res.message);
                }
            } catch (err) {
                Swal.close();
                showError(err.message);
            }
        }

        async function saveFase2() {
            try {
                showLoading('Menyimpan data Fase 2 & Dokumen Kelayakan...');
                let form = document.getElementById('formFase2');
                let formData = new FormData(form);

                let res = await fetchJSON("{{ route('pra-landbanks.store') }}", formData);
                Swal.close();

                if (res.success) {
                    sessionStorage.setItem('success_message', 'Data Fase 2 & Dokumen Kelayakan berhasil disimpan.');
                    window.location.href = "{{ route('pralandbank.all') }}";
                } else {
                    showError(res.message);
                }
            } catch (err) {
                Swal.close();
                showError(err.message);
            }
        }

        async function saveFase3() {
            try {
                showLoading('Menyimpan keputusan sidang akhir...');
                let form = document.getElementById('formFase3');
                let formData = new FormData(form);

                let res = await fetchJSON("{{ route('pra-landbanks.store') }}", formData);
                Swal.close();

                if (res.success) {
                    let textMsg = res.message || 'Data keputusan sidang berhasil disimpan!';
                    if (res.status === 'approved') {
                        textMsg = 'Tanah berhasil disetujui (Deal) dan telah di-upgrade ke Daftar Proyek Landbank utama!';
                    }
                    sessionStorage.setItem('success_message', textMsg);
                    window.location.href = "{{ route('pralandbank.all') }}";
                } else {
                    showError(res.message);
                }
            } catch (err) {
                Swal.close();
                showError(err.message);
            }
        }

        // ===============================
        // LEAFLET MAP & GPS
        // ===============================
        let mapFase2, markerFase2;

        function initMapFase2() {
            let lat = parseFloat(document.getElementById('fase2_lat')?.value) || -8.1727;
            let lng = parseFloat(document.getElementById('fase2_lng')?.value) || 113.7000;

            const isReadOnly = {{ ($land && ($land->status == 'approved' || $land->status == 'rejected')) ? 'true' : 'false' }};

            if (!mapFase2) {
                // Google Maps Tile Layers
                const googleRoadmap = L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                    maxZoom: 20,
                    subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
                    attribution: '&copy; Google Maps'
                });

                const googleHybrid = L.tileLayer('https://{s}.google.com/vt/lyrs=y&x={x}&y={y}&z={z}', {
                    maxZoom: 20,
                    subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
                    attribution: '&copy; Google Maps Satellite'
                });

                const googleTerrain = L.tileLayer('https://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}', {
                    maxZoom: 20,
                    subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
                    attribution: '&copy; Google Maps Terrain'
                });

                mapFase2 = L.map('map-fase2', {
                    center: [lat, lng],
                    zoom: 15,
                    layers: [googleRoadmap]
                });

                // Layer Switcher (Roadmap, Satellite, Terrain)
                const baseMaps = {
                    "Google Roadmap": googleRoadmap,
                    "Google Satellite": googleHybrid,
                    "Google Terrain": googleTerrain
                };
                L.control.layers(baseMaps, null, { position: 'topright' }).addTo(mapFase2);

                markerFase2 = L.marker([lat, lng], {
                    draggable: !isReadOnly
                }).addTo(mapFase2);

                if (!isReadOnly) {
                    markerFase2.on('dragend', function() {
                        let pos = markerFase2.getLatLng();
                        document.getElementById('fase2_lat').value = pos.lat.toFixed(6);
                        document.getElementById('fase2_lng').value = pos.lng.toFixed(6);
                    });

                    mapFase2.on('click', function(e) {
                        markerFase2.setLatLng(e.latlng);
                        document.getElementById('fase2_lat').value = e.latlng.lat.toFixed(6);
                        document.getElementById('fase2_lng').value = e.latlng.lng.toFixed(6);
                    });
                }
            } else {
                mapFase2.setView([lat, lng]);
                markerFase2.setLatLng([lat, lng]);
                mapFase2.invalidateSize();
            }
        }

        function toggleInstallmentView(isInitial = false) {
            const method = document.getElementById('temp_payment_method').value;
            const durationContainer = document.getElementById('temp_duration_container');
            const countContainer = document.getElementById('temp_count_container');
            const widgetContainer = document.getElementById('installment_widget_container');

            if (method === 'termin') {
                durationContainer.style.display = 'block';
                countContainer.style.display = 'block';
                widgetContainer.style.display = 'block';
                if (!isInitial) {
                    generateInstallmentRows();
                } else {
                    calculateInstallments();
                }
            } else {
                durationContainer.style.display = 'none';
                countContainer.style.display = 'none';
                widgetContainer.style.display = 'none';
                calculateInstallments();
            }
            updateFinancialSummary();
        }

        function calculateInstallments() {
            const method = document.getElementById('temp_payment_method').value;
            const dpContainer = document.getElementById('dp_container');
            const remainingContainer = document.getElementById('remaining_container');
            
            if (method !== 'termin') {
                if (dpContainer) dpContainer.style.display = 'none';
                if (remainingContainer) remainingContainer.style.display = 'none';
                updateFinancialSummary();
                return;
            }
            
            if (dpContainer) dpContainer.style.display = 'block';
            if (remainingContainer) remainingContainer.style.display = 'block';
            
            const cleanNum = (str) => parseInt((str || '').replace(/[^0-9]/g, '')) || 0;
            const formatRp = (num) => 'Rp ' + num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            
            const dealPrice = cleanNum(document.getElementById('deal_price_input').value);
            const dpPriceInput = document.getElementById('dp_price_input');
            let dpPrice = cleanNum(dpPriceInput.value);

            // Default DP to 20% of deal price if not set yet
            if (!dpPriceInput.value && dealPrice > 0) {
                dpPrice = Math.round(dealPrice * 0.20);
                dpPriceInput.value = formatRp(dpPrice);
            }
            
            let remaining = dealPrice - dpPrice;
            if (remaining < 0) remaining = 0;
            
            const remainingInput = document.getElementById('remaining_price_input');
            if (remainingInput) remainingInput.value = formatRp(remaining);
            
            const count = parseInt(document.getElementById('temp_installment_count').value) || 4;
            const tbody = document.getElementById('installment_tbody');
            const rows = tbody.querySelectorAll('tr');
            
            if (rows.length === count) {
                let remainingInstallments = count - 1;
                let installmentAmount = remainingInstallments > 0 ? Math.round(remaining / remainingInstallments) : 0;
                
                rows.forEach((row, index) => {
                    const amountInput = row.querySelector('input[name$="[amount_temp]"]');
                    if (amountInput) {
                        if (index === 0) {
                            amountInput.value = formatRp(dpPrice);
                        } else {
                            if (index === count - 1) {
                                let totalCalculated = dpPrice + (installmentAmount * (remainingInstallments - 1));
                                let finalInstallment = dealPrice - totalCalculated;
                                if (finalInstallment < 0) finalInstallment = 0;
                                amountInput.value = formatRp(finalInstallment);
                            } else {
                                amountInput.value = formatRp(installmentAmount);
                            }
                        }
                    }
                });
            }
            updateFinancialSummary();
        }

        function generateInstallmentRows() {
            const count = parseInt(document.getElementById('temp_installment_count').value) || 4;
            const duration = document.getElementById('temp_installment_duration').value;
            const tbody = document.getElementById('installment_tbody');
            tbody.innerHTML = '';
            
            let durationMonths = 12;
            if (duration === '3_bulan') durationMonths = 3;
            else if (duration === '6_bulan') durationMonths = 6;
            else if (duration === '9_bulan') durationMonths = 9;
            
            let baseDate = new Date();

            for (let i = 1; i <= count; i++) {
                let terminName = i === 1 ? 'DP (Tahap 1)' : `Tahap ${i}`;
                
                let dateVal = new Date(baseDate);
                if (i > 1 && count > 1) {
                    let monthsToAdd = Math.round((durationMonths / (count - 1)) * (i - 1));
                    dateVal.setMonth(dateVal.getMonth() + monthsToAdd);
                }
                let dateStr = dateVal.toISOString().split('T')[0];
                
                let row = document.createElement('tr');
                row.innerHTML = `
                    <td class="font-weight-bold text-primary text-center">
                        ${terminName}
                        <input type="hidden" name="installments[${i}][term_name]" value="${terminName}">
                    </td>
                    <td>
                        <input type="text" name="installments[${i}][amount_temp]" class="form-control form-control-sm" placeholder="Rp 0" onkeyup="formatRupiahTemp(this); calculateInstallments();" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                    </td>
                    <td>
                        <input type="date" name="installments[${i}][due_date]" value="${dateStr}" class="form-control form-control-sm" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                    </td>
                    <td>
                        <div class="pratanah-file-upload-modern py-1 px-2" style="border-width: 1px; border-style: dashed; border-radius: 6px; background: rgba(0,0,0,0.01);">
                            <input type="file" name="installments[${i}][file]" id="file_tahap_${i}" class="d-none" onchange="handleTerminFileName(this)" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                            <label for="file_tahap_${i}" class="mb-0 d-flex align-items-center gap-2 cursor-pointer w-100" style="font-size: 11px;">
                                <i class="mdi mdi-file-upload text-muted fs-5"></i>
                                <span class="text-truncate text-muted file-label-text" style="max-width: 150px;">Pilih Bukti</span>
                            </label>
                        </div>
                    </td>
                    <td>
                        <select name="installments[${i}][status]" class="form-select form-select-sm" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                            <option value="belum">Belum</option>
                            <option value="lunas">Lunas</option>
                        </select>
                    </td>
                `;
                tbody.appendChild(row);
            }
            
            // Instantly trigger calculations
            calculateInstallments();
        }

        function handleTerminFileName(input) {
            const labelSpan = input.closest('.pratanah-file-upload-modern').querySelector('.file-label-text');
            if (input.files && input.files[0]) {
                labelSpan.textContent = input.files[0].name;
                labelSpan.classList.remove('text-muted');
                labelSpan.classList.add('text-success', 'font-weight-bold');
            } else {
                labelSpan.textContent = "Pilih Bukti";
                labelSpan.classList.remove('text-success', 'font-weight-bold');
                labelSpan.classList.add('text-muted');
            }
        }

        function formatRupiahTemp(input) {
            let value = input.value.replace(/[^,\d]/g, '');
            let split = value.split(',');
            let sisa = split[0].length % 3;
            let rupiah = split[0].substr(0, sisa);
            let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            input.value = rupiah;
        }

        function getCurrentLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(pos => {
                    let lat = pos.coords.latitude;
                    let lng = pos.coords.longitude;

                    document.getElementById('fase2_lat').value = lat.toFixed(6);
                    document.getElementById('fase2_lng').value = lng.toFixed(6);

                    if (mapFase2) {
                        mapFase2.setView([lat, lng], 15);
                        markerFase2.setLatLng([lat, lng]);
                    }

                    Swal.fire({
                        icon: 'success',
                        title: 'Lokasi Ditemukan',
                        text: 'Koordinat GPS Anda berhasil diambil',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }, () => {
                    showError('Gagal mendeteksi lokasi GPS. Pastikan izin lokasi aktif.');
                });
            } else {
                showError('Browser Anda tidak mendukung layanan Geolocation.');
            }
        }

        function updateFinancialSummary() {
            const cleanNum = (str) => parseInt((str || '').replace(/[^0-9]/g, '')) || 0;
            const formatRp = (num) => 'Rp ' + (num || 0).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            
            const dealPrice = cleanNum(document.getElementById('deal_price_input') ? document.getElementById('deal_price_input').value : 0);
            const ijb = cleanNum(document.querySelector('input[name="biaya_ijb_temp"]') ? document.querySelector('input[name="biaya_ijb_temp"]').value : 0);
            const pajak = cleanNum(document.querySelector('input[name="biaya_pajak_temp"]') ? document.querySelector('input[name="biaya_pajak_temp"]').value : 0);
            const makelar = cleanNum(document.querySelector('input[name="fee_makelar_temp"]') ? document.querySelector('input[name="fee_makelar_temp"]').value : 0);
            const lain = cleanNum(document.querySelector('input[name="biaya_lain_temp"]') ? document.querySelector('input[name="biaya_lain_temp"]').value : 0);
            
            const method = document.getElementById('temp_payment_method') ? document.getElementById('temp_payment_method').value : 'cash';
            let dp = 0;
            if (method === 'termin') {
                dp = cleanNum(document.getElementById('dp_price_input') ? document.getElementById('dp_price_input').value : 0);
            } else {
                dp = dealPrice; // Cash = DP 100%
            }

            const totalBiayaTambahan = ijb + pajak + makelar + lain;
            const grandTotal = dealPrice + totalBiayaTambahan;
            const sisa = dealPrice > dp ? (dealPrice - dp) : 0;

            if (document.getElementById('calc_summary_deal')) document.getElementById('calc_summary_deal').innerText = formatRp(dealPrice);
            if (document.getElementById('calc_summary_ijb')) document.getElementById('calc_summary_ijb').innerText = formatRp(ijb);
            if (document.getElementById('calc_summary_pajak')) document.getElementById('calc_summary_pajak').innerText = formatRp(pajak);
            if (document.getElementById('calc_summary_makelar')) document.getElementById('calc_summary_makelar').innerText = formatRp(makelar);
            if (document.getElementById('calc_summary_lain')) document.getElementById('calc_summary_lain').innerText = formatRp(lain);
            if (document.getElementById('calc_summary_grand_total')) document.getElementById('calc_summary_grand_total').innerText = formatRp(grandTotal);
            if (document.getElementById('calc_summary_dp')) document.getElementById('calc_summary_dp').innerText = '- ' + formatRp(dp);
            if (document.getElementById('calc_summary_sisa')) document.getElementById('calc_summary_sisa').innerText = formatRp(sisa);
        }

        function recalculateDocProgress() {
            const cards = document.querySelectorAll('.legal-item-card');
            if (!cards.length) return;

            let total = cards.length;
            let uploaded = 0;

            cards.forEach(card => {
                const hasFile = card.getAttribute('data-has-file') === 'true';
                if (hasFile) uploaded++;
            });

            let unuploaded = total - uploaded;
            let percent = Math.round((uploaded / total) * 100);

            const progressBar = document.getElementById('doc_progress_bar');
            const badge = document.getElementById('doc_progress_badge');
            const countUploaded = document.getElementById('count_doc_uploaded');
            const countUnuploaded = document.getElementById('count_doc_unuploaded');

            if (progressBar) progressBar.style.width = percent + '%';
            if (badge) badge.innerText = `${uploaded} dari ${total} Berkas (${percent}%)`;
            if (countUploaded) countUploaded.innerText = uploaded;
            if (countUnuploaded) countUnuploaded.innerText = unuploaded;
        }

        function handleDocFileUpload(input) {
            const card = input.closest('.legal-item-card');
            const labelSpan = input.closest('.pratanah-file-upload-modern').querySelector('.file-name-text');
            
            if (input.files && input.files[0]) {
                labelSpan.textContent = input.files[0].name;
                labelSpan.classList.add('text-success', 'font-weight-bold');
                
                if (card) {
                    card.setAttribute('data-has-file', 'true');
                    const badge = card.querySelector('.doc-card-badge');
                    if (badge) {
                        badge.className = 'badge bg-success doc-card-badge';
                        badge.innerHTML = '<i class="mdi mdi-check-circle me-1"></i><span class="badge-text">Sudah Diunggah</span>';
                    }
                }
            } else {
                labelSpan.classList.remove('text-success', 'font-weight-bold');
                if (card && card.getAttribute('data-has-file') !== 'true') {
                    card.setAttribute('data-has-file', 'false');
                    const badge = card.querySelector('.doc-card-badge');
                    if (badge) {
                        badge.className = 'badge bg-secondary doc-card-badge';
                        badge.innerHTML = '<i class="mdi mdi-clock-outline me-1"></i><span class="badge-text">Belum Diunggah</span>';
                    }
                }
            }
            recalculateDocProgress();
        }

        function handleDummyFileName(input) {
            handleDocFileUpload(input);
        }

        // ===============================
        // TOGGLE DETAIL PERMASALAHAN HUKUM
        // ===============================
        function toggleMasalahHukum() {
            const selectStatus = document.getElementById('select_status_tanah');
            const wrapperMasalah = document.getElementById('wrapper_keterangan_masalah');
            const inputMasalah = document.getElementById('input_keterangan_masalah');

            if (selectStatus && wrapperMasalah) {
                if (selectStatus.value === 'problem') {
                    wrapperMasalah.classList.remove('d-none');
                    if (inputMasalah) inputMasalah.focus();
                } else {
                    wrapperMasalah.classList.add('d-none');
                }
            }
        }

        // ===============================
        // TOGGLE DETAIL KESULITAN IZIN
        // ===============================
        function toggleKeteranganIzin() {
            const selectIzin = document.getElementById('select_kesulitan_izin');
            const wrapperIzin = document.getElementById('wrapper_keterangan_izin');
            const inputIzin = document.getElementById('input_keterangan_izin');

            if (selectIzin && wrapperIzin) {
                if (selectIzin.value === 'sulit' || selectIzin.value === 'very_sulit') {
                    wrapperIzin.classList.remove('d-none');
                    if (inputIzin) inputIzin.focus();
                } else {
                    wrapperIzin.classList.add('d-none');
                }
            }
        }

        // ===============================
        // MODAL & DYNAMIC DOCUMENT BOX
        // ===============================
        function openModalTambahDocBox() {
            Swal.fire({
                title: 'Tambah Dokumen Baru',
                html: `
                    <div class="text-start mb-3">
                        <label class="form-label fw-semibold small text-dark">Nama Dokumen <span class="text-danger">*</span></label>
                        <input type="text" id="swal_doc_name" class="form-control" placeholder="Contoh: Surat PBB / Surat Kuasa">
                    </div>
                    <div class="text-start mb-2">
                        <label class="form-label fw-semibold small text-dark">Kode Dokumen (Opsional)</label>
                        <input type="text" id="swal_doc_code" class="form-control" placeholder="Contoh: PBB (Otomatis jika kosong)">
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: 'Tambahkan',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#9a55ff',
                cancelButtonColor: '#6c757d',
                preConfirm: () => {
                    const name = document.getElementById('swal_doc_name').value.trim();
                    const code = document.getElementById('swal_doc_code').value.trim();
                    if (!name) {
                        Swal.showValidationMessage('Nama dokumen wajib diisi!');
                        return false;
                    }
                    return { name, code };
                }
            }).then(async (result) => {
                if (result.isConfirmed) {
                    try {
                        Swal.fire({
                            title: 'Menyimpan jenis dokumen...',
                            allowOutsideClick: false,
                            didOpen: () => Swal.showLoading()
                        });

                        const response = await fetch('{{ route("document-types.store") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                name: result.value.name,
                                code: result.value.code || result.value.name.replace(/\s+/g, '_').toUpperCase()
                            })
                        });

                        // Append new box into documentGridContainer
                        const grid = document.getElementById('documentGridContainer');
                        const newDocName = result.value.name;
                        const newDocCode = result.value.code || result.value.name.replace(/\s+/g, '_').toUpperCase();
                        const tempId = 'custom_' + Date.now();

                        const boxHtml = `
                            <div class="col-md-6 col-lg-4" style="animation: fadeIn 0.3s ease;">
                                <div class="card h-100 border shadow-sm rounded-3 p-3 position-relative" style="background: #ffffff; border-color: #9a55ff !important;">
                                    <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="p-2 rounded-2" style="background: rgba(154, 85, 255, 0.1); color: #9a55ff;">
                                                <i class="mdi mdi-file-document-outline" style="font-size: 1.25rem;"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 fw-bold text-dark" style="font-size: 0.92rem;">${newDocName}</h6>
                                                <span class="badge bg-light text-primary border" style="font-size: 10px; font-family: monospace;">${newDocCode}</span>
                                            </div>
                                        </div>
                                        <span class="badge bg-info text-white py-1 px-2" style="font-size: 10px;">Baru</span>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label mb-1 text-muted" style="font-size: 0.8rem; font-weight: 600;">Nomor Dokumen ${newDocName}</label>
                                        <input type="text" class="form-control" name="documents[${tempId}][number]" placeholder="Nomor ${newDocName}" style="font-size: 0.85rem;">
                                        <input type="hidden" name="documents[${tempId}][custom_type_name]" value="${newDocName}">
                                    </div>
                                    <div class="mb-1 flex-grow-1 d-flex flex-column justify-content-end">
                                        <label class="form-label mb-1 text-muted" style="font-size: 0.8rem; font-weight: 600;">Upload Berkas (PDF / JPG / PNG)</label>
                                        <div class="pratanah-file-upload-modern">
                                            <input type="file" name="documents[${tempId}][file]" accept=".pdf,.jpg,.jpeg,.png">
                                            <div class="pratanah-file-label-modern py-2 px-3">
                                                <i class="mdi mdi-cloud-upload"></i>
                                                <div class="pratanah-file-info-modern">
                                                    <span class="file-label-text" style="font-size: 0.82rem;">Pilih Berkas ${newDocName}</span>
                                                    <small style="font-size: 0.72rem; color: #8c98a4;">Maksimal ukuran 2MB</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;

                        if (grid) {
                            grid.insertAdjacentHTML('beforeend', boxHtml);
                        }

                        // Bind file input label text change
                        initFileUploadEvents();

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: `Kotak dokumen "${newDocName}" telah ditambahkan ke form.`,
                            timer: 1500,
                            showConfirmButton: false
                        });

                    } catch (err) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Terjadi kesalahan saat menambahkan jenis dokumen.'
                        });
                    }
                }
            });
        }

        function initFileUploadEvents() {
            document.querySelectorAll('.pratanah-file-upload-modern input[type="file"]').forEach(input => {
                input.onchange = function () {
                    const label = this.closest('.pratanah-file-upload-modern')?.querySelector('.file-label-text');
                    if (label && this.files.length > 0) {
                        label.textContent = this.files[0].name;
                        label.classList.add('fw-bold', 'text-primary');
                    }
                };
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Financial summary listeners
            const costInputs = ['biaya_ijb_temp', 'biaya_pajak_temp', 'fee_makelar_temp', 'biaya_lain_temp'];
            costInputs.forEach(name => {
                const el = document.querySelector(`input[name="${name}"]`);
                if (el) {
                    el.addEventListener('input', updateFinancialSummary);
                    el.addEventListener('keyup', updateFinancialSummary);
                }
            });

            const dpInput = document.getElementById('dp_price_input');
            if (dpInput) {
                dpInput.addEventListener('input', updateFinancialSummary);
                dpInput.addEventListener('keyup', updateFinancialSummary);
            }

            updateFinancialSummary();
            recalculateDocProgress();

            // Legal issue & permit difficulty toggles
            toggleMasalahHukum();
            toggleKeteranganIzin();

            // Auto sync owner name with certificate
            const certInput = document.getElementById('certificate_owner');
            const ownerInput = document.getElementById('owner_name');
            const sameCheckbox = document.getElementById('sameAsCertificate');

            if (certInput && ownerInput && sameCheckbox) {
                sameCheckbox.addEventListener('change', function () {
                    if (this.checked) {
                        ownerInput.value = certInput.value;
                    }
                });

                certInput.addEventListener('input', function () {
                    if (sameCheckbox.checked) {
                        ownerInput.value = this.value;
                    }
                });

                ownerInput.addEventListener('input', function () {
                    if (sameCheckbox.checked && this.value !== certInput.value) {
                        sameCheckbox.checked = false;
                    }
                });
            }

            initFileUploadEvents();
        });
    </script>
@endpush
