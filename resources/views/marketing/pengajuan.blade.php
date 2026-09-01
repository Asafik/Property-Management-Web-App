@extends('layouts.partial.app')

@section('title', 'Pengajuan KPR - Property Management App')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        /* ===== FORM PENGAJUAN KPR CUSTOM STYLES ===== */
        .card-form-kpr {
            border: none;
            border-radius: 14px;
            background: #ffffff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            margin-bottom: 1.5rem;
            overflow: hidden;
        }

        .card-form-kpr .card-header {
            background: #ffffff;
            border-bottom: 1px solid #f0f2f5;
            padding: 1.2rem 1.5rem;
        }

        .card-form-kpr .card-body {
            padding: 1.5rem;
        }

        .section-header-kpr {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            margin-bottom: 1.25rem;
            padding-bottom: 0.75rem;
            border-bottom: 1.5px solid #f3f4f8;
        }

        .section-header-kpr .header-icon,
        .section-header-kpr > i,
        .section-header-kpr > div > .header-icon {
            font-size: 1.35rem;
            color: #9a55ff;
            background: rgba(154, 85, 255, 0.1);
            padding: 8px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
        }

        .badge-utj-status {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.35rem 0.75rem;
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 8px;
            font-size: 0.8rem;
            color: #166534;
            font-weight: 600;
        }

        .badge-utj-status i {
            font-size: 1rem !important;
            color: #16a34a !important;
            background: transparent !important;
            padding: 0 !important;
            width: auto !important;
            height: auto !important;
            border-radius: 0 !important;
            display: inline-block !important;
        }

        .badge-pill-lunas {
            background: #16a34a;
            color: #ffffff;
            font-size: 0.7rem;
            font-weight: 700;
            padding: 2px 6px;
            border-radius: 4px;
            margin-left: 2px;
        }

        .section-header-kpr h5 {
            margin: 0;
            font-weight: 800;
            color: #2c2e3f;
            font-size: 1.05rem;
            letter-spacing: -0.2px;
        }

        .form-label-kpr {
            font-weight: 700;
            font-size: 0.86rem;
            color: #3b3f5c;
            margin-bottom: 0.45rem;
            display: block;
        }

        .form-label-kpr .req {
            color: #fe5b5b;
        }

        .form-control-kpr {
            border: 1.5px solid #e2e8f0;
            border-radius: 8px;
            padding: 0.55rem 0.95rem;
            font-size: 0.9rem;
            color: #2c2e3f;
            min-height: 42px;
            background-color: #ffffff;
            transition: all 0.2s ease;
            width: 100%;
        }

        .form-control-kpr:focus {
            border-color: #9a55ff;
            box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.12);
            outline: none;
            background-color: #ffffff;
        }

        .form-control-kpr[readonly],
        .form-control-kpr:disabled {
            background-color: #f8fafc;
            color: #4b5563;
            font-weight: 600;
            cursor: not-allowed;
            border-color: #e5e7eb;
        }

        /* Seamless Rupiah Input Group */
        .kpr-input-group {
            display: flex !important;
            flex-wrap: nowrap !important;
            align-items: stretch !important;
            width: 100% !important;
        }

        .kpr-input-group .input-group-text {
            background-color: #f8fafc !important;
            border: 1.5px solid #e2e8f0 !important;
            border-right: none !important;
            border-top-left-radius: 8px !important;
            border-bottom-left-radius: 8px !important;
            border-top-right-radius: 0 !important;
            border-bottom-right-radius: 0 !important;
            color: #9a55ff !important;
            font-size: 0.92rem !important;
            font-weight: 700 !important;
            padding: 0 0.85rem !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            min-height: 42px !important;
            margin: 0 !important;
        }

        .kpr-input-group .form-control-kpr {
            border-top-left-radius: 0 !important;
            border-bottom-left-radius: 0 !important;
            border-top-right-radius: 8px !important;
            border-bottom-right-radius: 8px !important;
            border-left: 1.5px solid #e2e8f0 !important;
            flex: 1 1 auto;
        }

        .kpr-input-group:focus-within .input-group-text {
            border-color: #9a55ff !important;
            background-color: #fdfaff !important;
        }

        .kpr-input-group:focus-within .form-control-kpr {
            border-color: #9a55ff !important;
            box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.12) !important;
        }

        /* Percent Input Group for Suku Bunga */
        .kpr-percent-group {
            display: flex !important;
            flex-wrap: nowrap !important;
            align-items: stretch !important;
            width: 100% !important;
        }

        .kpr-percent-group .form-control-kpr {
            border-top-right-radius: 0 !important;
            border-bottom-right-radius: 0 !important;
            border-top-left-radius: 8px !important;
            border-bottom-left-radius: 8px !important;
            border: 1.5px solid #e2e8f0 !important;
            border-right: none !important;
            flex: 1 1 auto !important;
            min-height: 42px !important;
            margin: 0 !important;
        }

        .kpr-percent-group .input-group-text {
            background-color: #f8fafc !important;
            border: 1.5px solid #e2e8f0 !important;
            border-left: none !important;
            border-top-right-radius: 8px !important;
            border-bottom-right-radius: 8px !important;
            border-top-left-radius: 0 !important;
            border-bottom-left-radius: 0 !important;
            color: #4b5563 !important;
            font-size: 0.95rem !important;
            font-weight: 700 !important;
            padding: 0 0.85rem !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            min-height: 42px !important;
            margin: 0 !important;
            flex-shrink: 0;
        }

        .kpr-percent-group:focus-within .form-control-kpr {
            border-color: #9a55ff !important;
            box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.12) !important;
        }

        .kpr-percent-group:focus-within .input-group-text {
            border-color: #9a55ff !important;
            background-color: #fdfaff !important;
        }

        /* Highlight Result Box for Estimasi Angsuran */
        .highlight-calc-box {
            background: linear-gradient(135deg, rgba(154, 85, 255, 0.06), rgba(218, 140, 255, 0.08));
            border: 1.5px dashed rgba(154, 85, 255, 0.35);
            border-radius: 10px;
            padding: 0.85rem 1rem;
        }

        /* Modern File Upload Cards */
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
            flex-direction: row;
            align-items: center;
            gap: 12px;
            padding: 0.85rem 1rem;
            background: #ffffff;
            border: 1.5px dashed #cbd5e1;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.25s ease;
            min-height: 72px;
        }

        .properti-file-upload-modern:hover .properti-file-label-modern {
            border-color: #9a55ff;
            background: #faf7ff;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(154, 85, 255, 0.08);
        }

        .properti-file-upload-modern.has-existing-doc .properti-file-label-modern {
            border-style: solid;
            border-color: #10b981;
            background: linear-gradient(135deg, #f0fdf4, #ffffff);
        }

        .properti-file-upload-modern.has-existing-doc:hover .properti-file-label-modern {
            transform: none !important;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.1) !important;
            border-color: #10b981 !important;
        }

        .properti-file-upload-modern .btn {
            position: relative;
            z-index: 3;
        }

        .properti-file-upload-modern .properti-file-label-modern i {
            font-size: 1.45rem;
            color: #9a55ff;
            background: rgba(154, 85, 255, 0.1);
            padding: 10px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .properti-file-upload-modern.has-existing-doc .properti-file-label-modern i {
            color: #10b981;
            background: rgba(16, 185, 129, 0.12);
        }

        .properti-file-upload-modern .properti-file-info-modern {
            flex: 1;
            min-width: 0;
        }

        .properti-file-upload-modern .properti-file-info-modern span {
            display: block;
            font-weight: 700;
            color: #2c2e3f;
            font-size: 0.85rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .properti-file-upload-modern .properti-file-info-modern small {
            color: #64748b;
            font-size: 0.72rem;
            display: block;
            margin-top: 2px;
        }

        .properti-file-upload-modern .properti-file-size {
            font-size: 0.72rem;
            color: #9a55ff;
            font-weight: 700;
            background: rgba(154, 85, 255, 0.1);
            padding: 3px 8px;
            border-radius: 12px;
            white-space: nowrap;
        }

        .properti-file-upload-modern.error .properti-file-label-modern {
            border-color: #ef4444 !important;
            background: #fff5f5 !important;
        }

        /* SELECT2 ENHANCEMENTS */
        .select2-container--bootstrap-5 .select2-selection {
            border: 1.5px solid #e2e8f0 !important;
            border-radius: 8px !important;
            min-height: 42px !important;
            padding: 0.45rem 0.85rem !important;
            font-family: inherit !important;
            background-color: #ffffff !important;
        }

        .select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
            color: #2c2e3f !important;
            font-size: 0.9rem !important;
            font-weight: 600 !important;
            padding-left: 0 !important;
        }

        .select2-container--bootstrap-5 .select2-selection--single .select2-selection__arrow {
            height: 40px !important;
            right: 10px !important;
        }

        .select2-container--bootstrap-5 .select2-selection:hover,
        .select2-container--bootstrap-5.select2-container--focus .select2-selection,
        .select2-container--bootstrap-5.select2-container--open .select2-selection {
            border-color: #9a55ff !important;
            box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.12) !important;
        }

        .select2-container--bootstrap-5 .select2-dropdown {
            border-color: #e2e8f0 !important;
            border-radius: 10px !important;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
            overflow: hidden !important;
        }

        .select2-container--bootstrap-5 .select2-results__option {
            padding: 0.6rem 0.9rem !important;
            font-size: 0.88rem !important;
            font-weight: 600 !important;
        }

        .select2-container--bootstrap-5 .select2-results__option--selected {
            background-color: #f3e8ff !important;
            color: #7e22ce !important;
        }

        .select2-container--bootstrap-5 .select2-results__option--highlighted {
            background: #9a55ff !important;
            color: #ffffff !important;
        }
    </style>

    <div class="container-fluid px-1 px-sm-2 px-md-3 py-2 py-md-3">
        <!-- Header Card Banner -->
        <div class="row mb-3 mb-md-4">
            <div class="col-12">
                <div class="card shadow-sm border-0 header-card">
                    <div class="card-body p-4 p-md-4 py-4 py-md-4 d-flex justify-content-between align-items-center" style="min-height: 105px;">
                        <div>
                            <h3 class="text-dark mb-1 fw-bold" style="font-size: 1.35rem;">
                                Form Pengajuan KPR
                            </h3>
                            <p class="text-muted mb-0" style="font-size: 0.9rem;">
                                Lengkapi data pengajuan KPR untuk customer yang sudah booking unit
                            </p>
                        </div>
                        <div class="d-none d-sm-block pe-2">
                            <i class="mdi mdi-bank" style="font-size: 3rem; color: #9a55ff; opacity: 0.25;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Info Status Ribbon -->
        <div class="row mb-3">
            <div class="col-12">
                <div class="card border-0 shadow-sm" style="border-radius: 10px; background: #ffffff;">
                    <div class="card-body py-2 px-3">
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-primary text-white px-3 py-2" style="border-radius: 6px; font-weight: 700; font-size: 0.8rem; background: linear-gradient(135deg, #da8cff, #9a55ff) !important;">
                                    <i class="mdi mdi-plus-circle-outline me-1"></i>Pengajuan Baru
                                </span>
                                <span class="text-muted small d-flex align-items-center">
                                    <i class="mdi mdi-calendar-clock me-1 text-primary"></i>
                                    Tanggal: <strong>{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</strong>
                                </span>
                            </div>
                            <div>
                                <span class="badge bg-warning text-dark px-3 py-2" style="border-radius: 6px; font-weight: 700; font-size: 0.8rem;">
                                    <i class="mdi mdi-file-document-edit-outline me-1"></i>Status: Draft
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 10px; border-left: 4px solid #28a745;">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 10px; border-left: 4px solid #dc3545;">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger" style="border-radius: 10px; border-left: 4px solid #dc3545;">
                <i class="fas fa-exclamation-circle me-2"></i>{{ $errors->first() }}
            </div>
        @endif

        <!-- Form Pengajuan KPR -->
        <form action="{{ route('pengajuan.store') }}" method="POST" enctype="multipart/form-data" class="pengajuan-form-sample">
            @csrf

            <!-- Hidden Data dari Booking -->
            <input type="hidden" name="customer_id" value="{{ $booking->customer->id ?? '' }}">
            <input type="hidden" name="unit_id" value="{{ $booking->unit->id ?? '' }}">
            <input type="hidden" name="booking_id" value="{{ $booking->id }}">

            <!-- CARD 1: INFORMASI CUSTOMER & DETAIL UNIT -->
            <div class="card card-form-kpr">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-dark d-flex align-items-center">
                        <i class="mdi mdi-account-box-outline text-primary me-2" style="font-size: 1.3rem;"></i>
                        Data Customer & Detail Unit
                    </h5>
                    <span class="badge bg-light text-primary border px-2 py-1" style="font-size: 0.78rem;">
                        Kode Booking: <strong>{{ $booking->booking_code ?? 'BOOK-'.$booking->id }}</strong>
                    </span>
                </div>
                <div class="card-body">
                    <!-- Info Alert -->
                    <div class="alert alert-info d-flex align-items-center gap-2 mb-4 p-3" style="border-radius: 8px; background: rgba(154, 85, 255, 0.06); border: 1px solid rgba(154, 85, 255, 0.2);">
                        <i class="mdi mdi-information-outline text-primary flex-shrink-0" style="font-size: 1.35rem;"></i>
                        <span class="small text-dark">
                            Pastikan data customer sudah lengkap di menu <strong>Master Customer</strong> sebelum mengajukan berkas KPR ke bank.
                        </span>
                    </div>

                    <!-- Customer Field -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label-kpr"><i class="mdi mdi-account text-primary me-1"></i>Nama Customer <span class="req">*</span></label>
                            <input type="text" class="form-control-kpr" value="{{ $booking->customer->full_name ?? '-' }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-kpr"><i class="mdi mdi-card-account-details-outline text-primary me-1"></i>NIK / ID Customer</label>
                            <input type="text" class="form-control-kpr" value="{{ $booking->customer->nik ?? $booking->customer->customer_id ?? '-' }}" readonly>
                        </div>
                    </div>

                    <div class="section-header-kpr d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <div class="d-flex align-items-center gap-2">
                            <i class="mdi mdi-home-city-outline header-icon"></i>
                            <h5>Detail Unit yang Dibooking</h5>
                        </div>
                        <div class="badge-utj-status">
                            <i class="mdi mdi-check-circle"></i>
                            <span>UTJ Terbayar: <strong>Rp {{ number_format($booking->booking_fee ?? 0, 0, ',', '.') }}</strong></span>
                            <span class="badge-pill-lunas">Lunas</span>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-12 col-sm-6 col-md-3">
                            <label class="form-label-kpr"><i class="mdi mdi-home-outline text-primary me-1"></i>Nama Unit</label>
                            <input type="text" class="form-control-kpr" value="{{ $booking->unit->unit_name ?? '-' }}" readonly>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <label class="form-label-kpr"><i class="mdi mdi-home-group text-primary me-1"></i>Type Unit</label>
                            <input type="text" class="form-control-kpr" value="{{ $booking->unit->type ?? '-' }}" readonly>
                        </div>
                        <div class="col-6 col-sm-6 col-md-3">
                            <label class="form-label-kpr"><i class="mdi mdi-numeric text-primary me-1"></i>Blok / No</label>
                            <input type="text" class="form-control-kpr" value="{{ $booking->unit->block ?? '-' }} / {{ $booking->unit->unit_code ?? '-' }}" readonly>
                        </div>
                        <div class="col-6 col-sm-6 col-md-3">
                            <label class="form-label-kpr"><i class="mdi mdi-tag-outline text-primary me-1"></i>Jenis Unit</label>
                            <input type="text" class="form-control-kpr" value="{{ Str::upper($booking->unit->jenis ?? '-') }}" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CARD 2: DATA PENGAJUAN KPR & SIMULASI -->
            <div class="card card-form-kpr">
                <div class="card-header">
                    <h5 class="mb-0 fw-bold text-dark d-flex align-items-center">
                        <i class="mdi mdi-calculator-variant text-primary me-2" style="font-size: 1.3rem;"></i>
                        Data Pengajuan KPR & Simulasi Angsuran
                    </h5>
                </div>
                <div class="card-body">
                    <!-- Bank & Produk -->
                    <div class="row g-3 mb-3">
                        <div class="col-12 col-md-6">
                            <label class="form-label-kpr" for="bankSelect"><i class="mdi mdi-bank text-primary me-1"></i>Bank Tujuan <span class="req">*</span></label>
                            <select class="form-control-kpr select2-bank" name="banks_id" id="bankSelect" required style="width: 100%;">
                                <option value="">-- Pilih Bank Tujuan --</option>
                                @foreach ($banks as $bank)
                                    <option value="{{ $bank->id }}">{{ $bank->bank_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label-kpr" for="produkSelect"><i class="mdi mdi-shield-home-outline text-primary me-1"></i>Produk KPR <span class="req">*</span></label>
                            <select class="form-control-kpr select2-produk" name="produk_kpr" id="produkSelect" style="width: 100%;">
                                <option value="subsidi">KPR Subsidi</option>
                                <option value="non_subsidi">KPR Non Subsidi</option>
                                <option value="syariah">KPR Syariah</option>
                            </select>
                        </div>
                    </div>

                    <!-- Harga Unit, DP, Promo -->
                    <div class="row g-3 mb-3">
                        <div class="col-12 col-sm-6 col-md-4">
                            <label class="form-label-kpr"><i class="mdi mdi-cash text-primary me-1"></i>Harga Unit</label>
                            <div class="kpr-input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="text" class="form-control-kpr" id="hargaUnit" value="{{ number_format($booking->unit->price ?? 0, 0, ',', '.') }}" readonly>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-4">
                            <label class="form-label-kpr"><i class="mdi mdi-cash-multiple text-primary me-1"></i>Uang Muka (DP) <span class="req">*</span></label>
                            <div class="kpr-input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="text" class="form-control-kpr" name="dp_display" id="dp" required value="0" autocomplete="off">
                                <input type="hidden" name="dp" id="dp_hidden" value="0">
                            </div>
                            <small class="text-muted" style="font-size: 0.75rem;">Masukkan nominal Uang Muka (DP) yang dibayarkan</small>
                        </div>

                        <div class="col-12 col-sm-6 col-md-4">
                            <label class="form-label-kpr" for="promoSelect"><i class="mdi mdi-tag-percent-outline text-primary me-1"></i>Promo / Diskon</label>
                            <select class="form-control-kpr select2-promo" name="promo_id" id="promoSelect" style="width: 100%;">
                                <option value="">-- Pilih Promo --</option>
                                @foreach ($promos as $promo)
                                    <option value="{{ $promo->id }}" data-nominal="{{ $promo->nominal ?? 0 }}">
                                        {{ $promo->name }} (Rp {{ number_format($promo->value ?? $promo->nominal ?? 0, 0, ',', '.') }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Tenor, Bunga, Jumlah Pinjaman -->
                    <div class="row g-3 mb-3">
                        <div class="col-12 col-sm-6 col-md-4">
                            <label class="form-label-kpr" for="tenor"><i class="mdi mdi-calendar-range text-primary me-1"></i>Tenor Angsuran <span class="req">*</span></label>
                            <select class="form-control-kpr select2-tenor" name="tenor" id="tenor" required style="width: 100%;">
                                <option value="">-- Pilih Tenor --</option>
                                <option value="5">5 Tahun (60 Bulan)</option>
                                <option value="10">10 Tahun (120 Bulan)</option>
                                <option value="15" selected>15 Tahun (180 Bulan)</option>
                                <option value="20">20 Tahun (240 Bulan)</option>
                            </select>
                        </div>

                        <div class="col-12 col-sm-6 col-md-4">
                            <label class="form-label-kpr"><i class="mdi mdi-percent-outline text-primary me-1"></i>Suku Bunga (%) <span class="req">*</span></label>
                            <div class="kpr-percent-group">
                                <input type="number" class="form-control-kpr" name="bunga" id="bunga" step="0.1" value="5.0" required>
                                <span class="input-group-text">%</span>
                            </div>
                        </div>

                        @php
                            $hargaUnit = $booking->unit->price ?? 0;
                            $dp = 0;
                            $jumlahPinjaman = $hargaUnit;
                        @endphp

                        <div class="col-12 col-sm-6 col-md-4">
                            <label class="form-label-kpr"><i class="mdi mdi-cash-register text-primary me-1"></i>Jumlah Pinjaman KPR</label>
                            <div class="kpr-input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="text" class="form-control-kpr" name="jumlah_pinjaman" id="jumlahPinjaman" value="{{ number_format($jumlahPinjaman, 0, ',', '.') }}" readonly>
                            </div>
                        </div>
                    </div>

                    <!-- Estimasi Angsuran & Status Pekerjaan -->
                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <div class="highlight-calc-box">
                                <label class="form-label-kpr text-primary mb-1"><i class="mdi mdi-currency-usd text-primary me-1"></i>Estimasi Angsuran / Bulan</label>
                                <div class="kpr-input-group">
                                    <span class="input-group-text fw-bold text-success">Rp</span>
                                    <input type="text" class="form-control-kpr fw-bold text-success" style="font-size: 1.15rem;" name="estimasi_angsuran" id="angsuran" readonly placeholder="0">
                                </div>
                                <small class="text-muted d-block mt-1" style="font-size: 0.75rem;">*Estimasi perhitungan flat sesuai tenor dan bunga</small>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="form-label-kpr"><i class="mdi mdi-briefcase-outline text-primary me-1"></i>Status Pekerjaan Customer</label>
                            <input type="text" class="form-control-kpr" name="status_pekerjaan" value="{{ ($booking->customer->job_status ?? '') === 'Lainnya' ? ($booking->customer->job_status_lainnya ?? '') : ($booking->customer->job_status ?? '') }}" placeholder="Contoh: Karyawan Swasta / PNS">
                        </div>
                    </div>
                </div>
            </div>

            <!-- CARD 3: DOKUMEN PERSYARATAN KPR -->
            <div class="card card-form-kpr">
                <div class="card-header d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2">
                    <div>
                        <h5 class="mb-1 fw-bold text-dark d-flex align-items-center">
                            <i class="mdi mdi-file-document-multiple-outline text-primary me-2" style="font-size: 1.3rem;"></i>
                            Upload Dokumen Persyaratan KPR
                        </h5>
                        <small class="text-muted">Lengkapi dokumen wajib untuk pengajuan berkas ke pihak bank</small>
                    </div>
                    <div>
                        <span class="badge bg-primary px-3 py-2" id="uploadCounter" style="border-radius: 20px; font-weight: 700; font-size: 0.8rem; background: linear-gradient(135deg, #da8cff, #9a55ff) !important;">
                            0 / 8 Dokumen
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        @php
                            $uploadFields = [
                                'ktp'            => 'KTP Pemohon',
                                'kk'             => 'Kartu Keluarga (KK)',
                                'slip_gaji'      => 'Slip Gaji 3 Bulan',
                                'rekening_koran' => 'Rekening Koran',
                                'npwp'           => 'NPWP Pemohon',
                                'sku'            => 'SKU / Surat Keterangan Kerja',
                                'surat_nikah'    => 'Buku / Surat Nikah',
                                'ktp_pasangan'   => 'KTP Pasangan',
                            ];
                            $docMap = [
                                'ktp'          => 'KTP',
                                'kk'           => 'Kartu Keluarga',
                                'npwp'         => 'NPWP',
                                'ktp_pasangan' => 'KTP Pasangan'
                            ];
                        @endphp

                        @foreach ($uploadFields as $field => $label)
                            @php
                                $mappedName = $docMap[$field] ?? null;
                                $hasDoc = $mappedName && isset($existingCustomerDocs[$mappedName]) && $existingCustomerDocs[$mappedName];
                                $fileUrl = '';
                                $previewUrl = '';
                                if ($hasDoc) {
                                    $docPath = $existingCustomerDocs[$mappedName];
                                    $fileUrl = \Illuminate\Support\Str::startsWith($docPath, 'uploads/') ? asset($docPath) : asset('uploads/' . $docPath);
                                    $relativePath = \Illuminate\Support\Str::startsWith($docPath, 'uploads/') ? $docPath : 'uploads/' . $docPath;
                                    $previewUrl = route('document.preview', ['path' => $relativePath]);
                                }
                            @endphp
                            <div class="col-12 col-md-6 mb-2">
                                <label class="form-label-kpr" for="{{ $field }}">{{ $label }} <span class="req">*</span></label>
                                <div class="properti-file-upload-modern {{ $hasDoc ? 'has-existing-doc' : '' }}">
                                    <input type="file" id="{{ $field }}" name="{{ $field }}" accept=".jpg,.jpeg,.png,.pdf" {{ $hasDoc ? '' : 'required' }}>

                                    @if ($hasDoc)
                                        <div class="properti-file-label-modern">
                                            <i class="fas fa-check-circle"></i>
                                            <div class="properti-file-info-modern">
                                                <span style="color: #10b981;">{{ $label }} Tersedia (Data Customer)</span>
                                                <small>File sudah ada. Klik untuk mengganti jika perlu.</small>
                                            </div>
                                            <div class="d-flex align-items-center gap-1">
                                                <a href="{{ $previewUrl }}" target="_blank" class="btn btn-sm btn-outline-success px-2 py-1 d-flex align-items-center gap-1" style="font-size: 0.75rem; border-radius: 6px;">
                                                    <i class="fas fa-eye" style="font-size: 0.75rem; background: none; padding: 0; color: inherit;"></i> Lihat
                                                </a>
                                                <a href="{{ $fileUrl }}" download class="btn btn-sm btn-outline-primary px-2 py-1 d-flex align-items-center gap-1" style="font-size: 0.75rem; border-radius: 6px;">
                                                    <i class="fas fa-download" style="font-size: 0.75rem; background: none; padding: 0; color: inherit;"></i> Unduh
                                                </a>
                                            </div>
                                        </div>
                                    @else
                                        <div class="properti-file-label-modern">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                            <div class="properti-file-info-modern">
                                                <span>Upload {{ $label }}</span>
                                                <small>Format: PDF, JPG, PNG (Max 2MB)</small>
                                            </div>
                                            <span class="properti-file-size"></span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Tombol Action -->
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3 mt-4 pt-3 border-top">
                        <a href="{{ url('/marketing/jual-unit') }}" class="btn btn-light px-4 py-2 fw-bold text-muted border" style="border-radius: 8px;">
                            <i class="mdi mdi-arrow-left me-1"></i>Kembali
                        </a>
                        <button type="submit" class="btn btn-gradient-primary px-5 py-2 fw-bold text-white shadow-sm" style="border-radius: 8px; font-size: 0.95rem;">
                            <i class="mdi mdi-send-check me-1"></i>Ajukan Berkas KPR
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                // Select2 Bank Tujuan
                $('#bankSelect').select2({
                    theme: 'bootstrap-5',
                    placeholder: '-- Pilih Bank Tujuan --',
                    allowClear: true,
                    width: '100%'
                });

                // Select2 Produk KPR
                $('#produkSelect').select2({
                    theme: 'bootstrap-5',
                    placeholder: '-- Pilih Produk --',
                    allowClear: false,
                    width: '100%'
                });

                // Select2 Promo
                $('#promoSelect').select2({
                    theme: 'bootstrap-5',
                    placeholder: '-- Pilih Promo --',
                    allowClear: true,
                    width: '100%'
                });

                // Select2 Tenor
                $('#tenor').select2({
                    theme: 'bootstrap-5',
                    placeholder: '-- Pilih Tenor --',
                    allowClear: false,
                    width: '100%'
                });
            });

            // File Upload Preview & Counter
            document.addEventListener('DOMContentLoaded', function() {
                const uploadFields = ['ktp', 'kk', 'slip_gaji', 'rekening_koran', 'npwp', 'sku', 'surat_nikah', 'ktp_pasangan'];
                const counterElement = document.getElementById('uploadCounter');

                function updateCounter() {
                    let uploadedCount = 0;
                    uploadFields.forEach(field => {
                        const input = document.getElementById(field);
                        if (!input) return;
                        const container = input.closest('.properti-file-upload-modern');
                        if ((input.files && input.files.length > 0) || (container && container.classList.contains('has-existing-doc'))) {
                            uploadedCount++;
                        }
                    });
                    if (counterElement) {
                        counterElement.textContent = uploadedCount + ' / 8 Dokumen';
                        if (uploadedCount === 8) {
                            counterElement.style.background = '#10b981';
                        }
                    }
                }

                document.querySelectorAll('.properti-file-upload-modern input[type="file"]').forEach(input => {
                    input.addEventListener('change', function(e) {
                        const fileName = e.target.files[0]?.name;
                        const fileSize = e.target.files[0]?.size;
                        const container = this.closest('.properti-file-upload-modern');
                        if (!container) return;
                        const label = container.querySelector('.properti-file-info-modern span');
                        const sizeSpan = container.querySelector('.properti-file-size');

                        if (fileName) {
                            if (label) label.textContent = fileName.length > 30 ? fileName.substring(0, 30) + '...' : fileName;
                            if (fileSize && sizeSpan) {
                                const sizeInMB = (fileSize / (1024 * 1024)).toFixed(2);
                                sizeSpan.textContent = sizeInMB + ' MB';
                            }
                            if (container.classList.contains('has-existing-doc')) {
                                const smallText = container.querySelector('.properti-file-info-modern small');
                                if (smallText) {
                                    smallText.textContent = 'File baru dipilih (menggantikan file customer)';
                                    smallText.style.color = '#9a55ff';
                                }
                            }
                            container.classList.remove('error');
                        }
                        updateCounter();
                    });
                });

                updateCounter();
            });

            // Perhitungan KPR Otomatis
            document.addEventListener('DOMContentLoaded', function() {
                const hargaUnitInput = {{ $booking->unit->price ?? 0 }};
                const dpInput = document.querySelector('#dp');
                const dpHidden = document.querySelector('#dp_hidden');
                const bungaInput = document.querySelector('#bunga');
                const tenorSelect = document.querySelector('#tenor');
                const angsuranInput = document.querySelector('#angsuran');
                const jumlahPinjamanInput = document.querySelector('#jumlahPinjaman');

                function formatRupiah(angka) {
                    return new Intl.NumberFormat('id-ID').format(angka);
                }

                function hitungPinjaman() {
                    const rawDp = dpInput ? dpInput.value.replace(/[^0-9]/g, '') : '0';
                    const dp = parseFloat(rawDp) || 0;
                    if (dpHidden) dpHidden.value = dp;

                    const promoNominal = parseFloat($('#promoSelect option:selected').data('nominal')) || 0;
                    const jumlahPinjaman = Math.max(hargaUnitInput - dp - promoNominal, 0);
                    if (jumlahPinjamanInput) {
                        jumlahPinjamanInput.value = formatRupiah(jumlahPinjaman);
                    }
                    return jumlahPinjaman;
                }

                function hitungAngsuran() {
                    const jumlahPinjaman = hitungPinjaman();
                    const bunga = parseFloat(bungaInput ? bungaInput.value : 0) || 0;
                    const tenor = parseInt(tenorSelect ? tenorSelect.value : 0) || 0;

                    if (jumlahPinjaman > 0 && bunga >= 0 && tenor > 0 && angsuranInput) {
                        const bungaTotal = jumlahPinjaman * (bunga / 100);
                        const totalPinjaman = jumlahPinjaman + bungaTotal;
                        const angsuran = totalPinjaman / (tenor * 12);
                        angsuranInput.value = formatRupiah(Math.round(angsuran));
                    } else if (angsuranInput) {
                        angsuranInput.value = '0';
                    }
                }

                if (dpInput) {
                    dpInput.addEventListener('input', function() {
                        let val = this.value.replace(/[^0-9]/g, '');
                        if (val) {
                            this.value = formatRupiah(val);
                        } else {
                            this.value = '';
                        }
                        hitungAngsuran();
                    });
                }
                if (bungaInput) bungaInput.addEventListener('input', hitungAngsuran);

                $('#tenor, #promoSelect').on('change', function() {
                    hitungAngsuran();
                });

                hitungAngsuran();
            });

            // Validasi Form
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.querySelector('.pengajuan-form-sample');
                const uploadFields = ['ktp', 'kk', 'slip_gaji', 'rekening_koran', 'npwp', 'sku', 'surat_nikah', 'ktp_pasangan'];

                if (form) {
                    form.addEventListener('submit', function(e) {
                        let isValid = true;
                        let missingFields = [];

                        document.querySelectorAll('.properti-file-upload-modern').forEach(el => {
                            el.classList.remove('error');
                        });

                        uploadFields.forEach(field => {
                            const input = document.getElementById(field);
                            if (input) {
                                const isRequired = input.hasAttribute('required');
                                if (isRequired && (!input.files || input.files.length === 0)) {
                                    isValid = false;
                                    missingFields.push(field.replace('_', ' ').toUpperCase());
                                    input.closest('.properti-file-upload-modern')?.classList.add('error');
                                }
                            }
                        });

                        if (!isValid) {
                            e.preventDefault();
                            Swal.fire({
                                icon: 'warning',
                                title: 'Dokumen Belum Lengkap',
                                html: '<p class="mb-2">Harap upload dokumen persyaratan berikut:</p><strong>' + missingFields.join(', ') + '</strong>'
                            });
                            return false;
                        }
                    });
                }
            });
        </script>
    @endpush
@endsection
