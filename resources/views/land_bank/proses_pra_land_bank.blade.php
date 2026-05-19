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
            border: none !important;
            border-radius: 16px !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            margin-bottom: 2rem;
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 8px 30px rgba(154, 85, 255, 0.08) !important;
        }

        .card-header {
            background: linear-gradient(135deg, #ffffff, #f8f9fa);
            border-bottom: 1px solid #e9ecef;
            padding: 1.25rem 1.5rem;
            border-radius: 16px 16px 0 0 !important;
        }

        .card-title {
            font-weight: 700;
            color: #9a55ff;
            margin-bottom: 0;
            display: flex;
            align-items: center;
            gap: 10px;
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
    </style>

    <div class="container-fluid p-2 p-sm-3 p-md-4">

        <!-- HEADER SECTION -->
        <div class="row mb-3 mb-sm-3 mb-md-4">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
                        <div class="d-flex align-items-center gap-3">
                            <div>
                                <h3 class="text-dark mb-1">
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
                                <p class="text-muted mb-0">
                                    @if ($land)
                                        Mengelola dan mengulas alur pelepasan tanah untuk <strong>{{ $land->land_name }}</strong>
                                    @else
                                        Inisialisasi data penawaran awal makelar (Fase 1)
                                    @endif
                                </p>
                            </div>
                        </div>

                        <!-- BUTTON KEMBALI -->
                        <div>
                            <a href="{{ route('pralandbank.all') }}" class="btn btn-outline-secondary" style="border-radius: 8px; font-weight: 500; height: 42px; display: inline-flex; align-items: center; gap: 6px; padding: 0 16px;">
                                <i class="mdi mdi-arrow-left fs-5"></i> Kembali
                            </a>
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
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                <i class="mdi mdi-account-tie"></i> FASE 1: Informasi Makelar & Penawaran Awal
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
                                        <i class="mdi mdi-map-marker-radius"></i> Data Spasial Tanah
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Nama Prospek Tanah *</label>
                                            <input type="text" class="form-control" name="land_name" value="{{ $land->land_name ?? '' }}" placeholder="Contoh: Tanah Jember Regency" required {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Pemilik Sertifikat (Nama di SHM)</label>
                                            <input type="text" class="form-control" name="certificate_owner" value="{{ $land->certificate_owner ?? '' }}" placeholder="Nama pemilik sah di sertifikat" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
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
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                <i class="mdi mdi-magnify"></i> FASE 2: Verifikasi Kelayakan, Dokumen & Spasial Map
                            </h5>
                        </div>
                        <div class="card-body">
                            <form id="formFase2" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $land->id ?? '' }}">
                                <input type="hidden" name="fase" value="fase2">

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
                                            <label class="form-label">Petugas Survey</label>
                                            <input type="text" class="form-control" name="petugas" value="{{ $land->survey_by ?? '' }}" placeholder="Nama petugas survey" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Kesimpulan Survey</label>
                                            <select class="form-select" name="hasil_survey" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                <option value="belum" {{ $land && $land->survey_result == 'belum' ? 'selected' : '' }}>Belum Survey</option>
                                                <option value="sesuai" {{ $land && $land->survey_result == 'sesuai' ? 'selected' : '' }}>Sesuai</option>
                                                <option value="tidak_sesuai" {{ $land && $land->survey_result == 'tidak_sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
                                                <option value="survey_ulang" {{ $land && $land->survey_result == 'survey_ulang' ? 'selected' : '' }}>Perlu Survey Ulang</option>
                                            </select>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="form-label">Catatan Hasil Survey Lapangan</label>
                                            <textarea class="form-control" name="catatan_survey" rows="3" placeholder="Catatan mendalam kelayakan fisik jalan, tiang listrik, kontur tanah..." {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>{{ $land->survey_notes ?? '' }}</textarea>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Status Lahan</label>
                                            <select class="form-select" name="land_status_temp" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                <option value="">Pilih Status Lahan</option>
                                                <option value="bekas_sawah">Lahan Bekas Sawah</option>
                                                <option value="perbukitan">Perbukitan</option>
                                                <option value="pekarangan">Pekarangan</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Kondisi Air</label>
                                            <select class="form-select" name="water_condition_temp" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                <option value="">Pilih Kondisi Air</option>
                                                <option value="sumur_bor">Sumur Bor</option>
                                                <option value="pdam">PDAM</option>
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
                                            <select class="form-select" name="status_tanah" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                <option value="clear" {{ $land && $land->status_tanah == 'clear' ? 'selected' : '' }}>Clear & Clean (Bebas Sengketa)</option>
                                                <option value="checking" {{ $land && $land->status_tanah == 'checking' ? 'selected' : '' }}>Dalam Pengecekan Notaris/BPN</option>
                                                <option value="problem" {{ $land && $land->status_tanah == 'problem' ? 'selected' : '' }}>Bermasalah / Dalam Sengketa</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Detail Permasalahan Hukum (Jika Bermasalah)</label>
                                            <input type="text" class="form-control" name="keterangan_masalah" value="{{ $land->keterangan_masalah ?? '' }}" placeholder="Catatan masalah legalitas" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
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
                                            <select class="form-select" name="kesulitan_izin" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                <option value="mudah" {{ $land && $land->kesulitan_izin == 'mudah' ? 'selected' : '' }}>Mudah</option>
                                                <option value="sedang" {{ $land && $land->kesulitan_izin == 'sedang' ? 'selected' : '' }}>Sedang</option>
                                                <option value="sulit" {{ $land && $land->kesulitan_izin == 'sulit' ? 'selected' : '' }}>Sulit</option>
                                                <option value="very_sulit" {{ $land && $land->kesulitan_izin == 'very_sulit' ? 'selected' : '' }}>Sangat Sulit (Zonasi Hijau)</option>
                                            </select>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="form-label">Fasilitas Sekitar</label>
                                            <div class="pratanah-checkbox-group">
                                                <div class="pratanah-checkbox-wrapper">
                                                    <input type="checkbox" class="pratanah-checkbox-input" name="fasilitas[]" value="sekolah" id="fase2_fac_sekolah" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                    <label class="pratanah-checkbox-label" for="fase2_fac_sekolah">
                                                        <i class="mdi mdi-check-circle pratanah-check-icon"></i>
                                                        <span class="pratanah-check-text">Sekolah</span>
                                                    </label>
                                                </div>
                                                <div class="pratanah-checkbox-wrapper">
                                                    <input type="checkbox" class="pratanah-checkbox-input" name="fasilitas[]" value="rumah_sakit" id="fase2_fac_rs" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                    <label class="pratanah-checkbox-label" for="fase2_fac_rs">
                                                        <i class="mdi mdi-check-circle pratanah-check-icon"></i>
                                                        <span class="pratanah-check-text">Rumah Sakit</span>
                                                    </label>
                                                </div>
                                                <div class="pratanah-checkbox-wrapper">
                                                    <input type="checkbox" class="pratanah-checkbox-input" name="fasilitas[]" value="pasar" id="fase2_fac_pasar" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                    <label class="pratanah-checkbox-label" for="fase2_fac_pasar">
                                                        <i class="mdi mdi-check-circle pratanah-check-icon"></i>
                                                        <span class="pratanah-check-text">Pasar</span>
                                                    </label>
                                                </div>
                                                <div class="pratanah-checkbox-wrapper">
                                                    <input type="checkbox" class="pratanah-checkbox-input" name="fasilitas[]" value="transportasi" id="fase2_fac_trans" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                    <label class="pratanah-checkbox-label" for="fase2_fac_trans">
                                                        <i class="mdi mdi-check-circle pratanah-check-icon"></i>
                                                        <span class="pratanah-check-text">Transportasi</span>
                                                    </label>
                                                </div>
                                                <div class="pratanah-checkbox-wrapper">
                                                    <input type="checkbox" class="pratanah-checkbox-input" name="fasilitas[]" value="mall" id="fase2_fac_mall" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                    <label class="pratanah-checkbox-label" for="fase2_fac_mall">
                                                        <i class="mdi mdi-check-circle pratanah-check-icon"></i>
                                                        <span class="pratanah-check-text">Mall</span>
                                                    </label>
                                                </div>
                                                <div class="pratanah-checkbox-wrapper">
                                                    <input type="checkbox" class="pratanah-checkbox-input" name="fasilitas[]" value="bank" id="fase2_fac_bank" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                    <label class="pratanah-checkbox-label" for="fase2_fac_bank">
                                                        <i class="mdi mdi-check-circle pratanah-check-icon"></i>
                                                        <span class="pratanah-check-text">Bank / ATM</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- FILE UPLOAD DOKUMEN PENDUKUNG -->
                                <div class="form-section">
                                    <div class="form-section-title">
                                        <i class="mdi mdi-file-document-outline"></i> Unggah Dokumen Kelayakan
                                    </div>
                                    <div class="row">
                                        @php
                                            $uploadedDocs = [];
                                            if ($land) {
                                                foreach ($land->documents as $d) {
                                                    $uploadedDocs[$d->document_type_id] = $d;
                                                }
                                            }
                                        @endphp
                                        @foreach($documentTypes as $doc)
                                            @php
                                                $existingDoc = $uploadedDocs[$doc->id] ?? null;
                                            @endphp
                                            <div class="col-md-6 mb-4">
                                                <div class="card shadow-none border p-3" style="background:#fafafc;">
                                                    <label class="form-label d-flex justify-content-between align-items-center mb-2">
                                                        <span>{{ $doc->name }}</span>
                                                        @if($existingDoc)
                                                            <span class="badge bg-success py-1 px-2"><i class="mdi mdi-check-circle me-1"></i>Tersedia</span>
                                                        @else
                                                            <span class="badge bg-warning text-dark py-1 px-2"><i class="mdi mdi-clock-outline me-1"></i>Belum Ada</span>
                                                        @endif
                                                    </label>

                                                    <input type="text" class="form-control mb-2"
                                                        name="documents[{{ $doc->id }}][number]"
                                                        value="{{ $existingDoc->document_number ?? '' }}"
                                                        placeholder="Nomor {{ $doc->name }}"
                                                        {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>

                                                    @if (!$land || ($land && $land->status != 'approved' && $land->status != 'rejected'))
                                                        <div class="pratanah-file-upload-modern">
                                                            <input type="file" name="documents[{{ $doc->id }}][file]"
                                                                accept=".pdf,.jpg,.jpeg,.png">

                                                            <div class="pratanah-file-label-modern">
                                                                <i class="mdi mdi-file"></i>
                                                                <div class="pratanah-file-info-modern">
                                                                    <span>{{ $existingDoc ? 'Ganti File Baru' : 'Upload ' . $doc->name }}</span>
                                                                    <small>PDF / JPG / PNG</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if($existingDoc)
                                                        @php
                                                            $cleanPath = str_replace('uploads/', '', $existingDoc->file_path);
                                                        @endphp
                                                        <div class="mt-2 d-flex align-items-center gap-2">
                                                            <a href="{{ route('dokumen.preview', ['path' => $cleanPath]) }}" target="_blank" class="btn btn-sm btn-outline-primary py-1 px-2">
                                                                <i class="mdi mdi-eye me-1"></i>Lihat Berkas Aktif
                                                            </a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- SPASIAL MAPS KOORDINAT -->
                                <div class="form-section">
                                    <div class="form-section-title">
                                        <i class="mdi mdi-map-marker-radius"></i> Koordinat Lintang & Bujur (Leaflet Map)
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5 mb-3">
                                            <label class="form-label">Latitude *</label>
                                            <input type="text" class="form-control" id="fase2_lat" name="lat"
                                                value="{{ $land->lat ?? '-8.1727' }}" placeholder="-8.1727" required {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-md-5 mb-3">
                                            <label class="form-label">Longitude *</label>
                                            <input type="text" class="form-control" id="fase2_lng" name="lng"
                                                value="{{ $land->lng ?? '113.7000' }}" placeholder="113.7000" required {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-md-2 mb-3 d-flex align-items-end">
                                            <button type="button" class="btn btn-gradient-info w-100" style="height: 42px;"
                                                onclick="getCurrentLocation()" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }} title="Dapatkan Lokasi Saya Saat Ini">
                                                <i class="mdi mdi-crosshairs-gps"></i> GPS
                                            </button>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="form-label">Geser Marker Peta di Bawah untuk Memilih Lokasi secara Visual</label>
                                            <div class="pratanah-map-container">
                                                <div id="map-fase2" style="height: 100%; width: 100%;"></div>
                                            </div>
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
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                <i class="mdi mdi-check-decagram"></i> FASE 3: Sidang & Keputusan Akhir
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
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">Biaya IJB (Rp)</label>
                                            <input type="text" class="form-control" name="biaya_ijb_temp" placeholder="Contoh: 10.000.000" onkeyup="formatRupiahTemp(this)" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">Estimasi Pajak PPh/BPHTB (Rp)</label>
                                            <input type="text" class="form-control" name="biaya_pajak_temp" placeholder="Contoh: 50.000.000" onkeyup="formatRupiahTemp(this)" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">Fee Makelar (Rp)</label>
                                            <input type="text" class="form-control" name="fee_makelar_temp" placeholder="Contoh: 15.000.000" onkeyup="formatRupiahTemp(this)" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">Biaya Lain-lain Admin (Rp)</label>
                                            <input type="text" class="form-control" name="biaya_lain_temp" placeholder="Contoh: 5.000.000" onkeyup="formatRupiahTemp(this)" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Unggah Berkas IJB (Temp)</label>
                                            <div class="pratanah-file-upload-modern">
                                                <input type="file" name="file_ijb_temp" id="file_ijb_temp" class="d-none" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                <label for="file_ijb_temp" class="pratanah-file-label-modern mb-0 w-100">
                                                    <i class="mdi mdi-cloud-upload-outline fs-3"></i>
                                                    <div class="pratanah-file-info-modern">
                                                        <span>Unggah Berkas IJB</span>
                                                        <small>Format: PDF, JPG, PNG (Maks 10MB)</small>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Unggah Berkas Bukti Pajak (Temp)</label>
                                            <div class="pratanah-file-upload-modern">
                                                <input type="file" name="file_pajak_temp" id="file_pajak_temp" class="d-none" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                <label for="file_pajak_temp" class="pratanah-file-label-modern mb-0 w-100">
                                                    <i class="mdi mdi-cloud-upload-outline fs-3"></i>
                                                    <div class="pratanah-file-info-modern">
                                                        <span>Unggah Berkas Pajak</span>
                                                        <small>Format: PDF, JPG, PNG (Maks 10MB)</small>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- SKEMA PEMBAYARAN & PEMBAYARAN BERTAHAP -->
                                <div class="form-section">
                                    <div class="form-section-title">
                                        <i class="mdi mdi-cash-multiple"></i> Skema Pembayaran & Pembayaran Bertahap
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Metode Pembayaran Kesepakatan</label>
                                            <select class="form-select" id="temp_payment_method" name="payment_method_temp" onchange="toggleInstallmentView()" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                <option value="cash" selected>Cash Keras (Lunas Sekaligus)</option>
                                                <option value="termin">Pembayaran Bertahap</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3" id="temp_duration_container" style="display: none;">
                                            <label class="form-label">Jangka Waktu Bertahap (Maks. 1 Tahun)</label>
                                            <select class="form-select" id="temp_installment_duration" name="installment_duration_temp" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                <option value="3_bulan">3 Bulan</option>
                                                <option value="6_bulan">6 Bulan</option>
                                                <option value="9_bulan">9 Bulan</option>
                                                <option value="1_tahun" selected>1 Tahun</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3" id="temp_count_container" style="display: none;">
                                            <label class="form-label">Frekuensi Pembayaran</label>
                                            <select class="form-select" id="temp_installment_count" name="installment_count_temp" onchange="generateInstallmentRows()" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                <option value="2">2x Bayar</option>
                                                <option value="3">3x Bayar</option>
                                                <option value="4" selected>4x Bayar</option>
                                                <option value="5">5x Bayar</option>
                                                <option value="6">6x Bayar</option>
                                                <option value="12">12x Bayar</option>
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
                                                    <!-- Dynamic rows generated by Javascript -->
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
                    let textMsg = 'Data keputusan sidang berhasil disimpan!';
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
                mapFase2 = L.map('map-fase2').setView([lat, lng], 13);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(mapFase2);

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

        function toggleInstallmentView() {
            const method = document.getElementById('temp_payment_method').value;
            const durationContainer = document.getElementById('temp_duration_container');
            const countContainer = document.getElementById('temp_count_container');
            const widgetContainer = document.getElementById('installment_widget_container');

            if (method === 'termin') {
                durationContainer.style.display = 'block';
                countContainer.style.display = 'block';
                widgetContainer.style.display = 'block';
                generateInstallmentRows();
            } else {
                durationContainer.style.display = 'none';
                countContainer.style.display = 'none';
                widgetContainer.style.display = 'none';
            }
        }

        function generateInstallmentRows() {
            const count = parseInt(document.getElementById('temp_installment_count').value) || 4;
            const tbody = document.getElementById('installment_tbody');
            tbody.innerHTML = '';

            for (let i = 1; i <= count; i++) {
                let terminName = i === 1 ? 'DP (Tahap 1)' : `Tahap ${i}`;
                
                let row = document.createElement('tr');
                row.innerHTML = `
                    <td class="font-weight-bold text-primary text-center">${terminName}</td>
                    <td>
                        <input type="text" class="form-control form-control-sm" placeholder="Rp 0" onkeyup="formatRupiahTemp(this)">
                    </td>
                    <td>
                        <input type="date" class="form-control form-control-sm">
                    </td>
                    <td>
                        <div class="pratanah-file-upload-modern py-1 px-2" style="border-width: 1px; border-style: dashed; border-radius: 6px; background: rgba(0,0,0,0.01);">
                            <input type="file" id="file_tahap_${i}" class="d-none" onchange="handleTerminFileName(this)">
                            <label for="file_tahap_${i}" class="mb-0 d-flex align-items-center gap-2 cursor-pointer w-100" style="font-size: 11px;">
                                <i class="mdi mdi-file-upload text-muted fs-5"></i>
                                <span class="text-truncate text-muted file-label-text" style="max-width: 150px;">Pilih Bukti</span>
                            </label>
                        </div>
                    </td>
                    <td>
                        <select class="form-select form-select-sm">
                            <option value="belum">Belum</option>
                            <option value="lunas">Lunas</option>
                        </select>
                    </td>
                `;
                tbody.appendChild(row);
            }
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
    </script>
@endpush
