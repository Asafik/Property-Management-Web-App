@extends('layouts.partial.app')

@section('title', 'Pengajuan KPR - Property Management App')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-clean.css') }}?v={{ time() }}">
@endpush

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        /* ===== FORM PENGAJUAN KPR CUSTOM STYLES (SESUAI CATALOG UNIT) ===== */
        .card-form-kpr {
            border: 1px solid #e2e8f0 !important;
            border-radius: 8px !important;
            background: #ffffff !important;
            box-shadow: none !important;
            margin-bottom: 1.5rem;
            overflow: hidden;
            transition: border-color 0.2s ease;
        }

        .card-form-kpr:hover {
            border-color: #cbd5e1 !important;
            box-shadow: none !important;
        }

        .card-form-kpr .card-header {
            background: #ffffff !important;
            border-bottom: 1px solid #e2e8f0 !important;
            padding: 0.85rem 1.25rem;
        }

        .card-form-kpr .card-body {
            padding: 1.25rem 1.5rem;
        }

        .section-header-kpr {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            margin-bottom: 1.25rem;
            padding-bottom: 0.75rem;
            border-bottom: 1.5px solid #f1f5f9;
        }

        .section-header-kpr .header-icon,
        .section-header-kpr > i,
        .section-header-kpr > div > .header-icon {
            font-size: 1.15rem;
            color: #9333ea;
            background: #f3e8ff;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            flex-shrink: 0;
        }

        .badge-utj-status {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.35rem 0.75rem;
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            border-radius: 6px !important;
            font-size: 0.8rem;
            color: #065f46;
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

        /* Universal Badge: 1 Warna Solid, Border Radius 6px */
        .badge, 
        .badge-pill, 
        span.badge {
            border-radius: 6px !important;
            background-image: none !important;
        }

        /* Highlight Result Box for Estimasi Angsuran */
        .highlight-calc-box {
            background: #f8fafc;
            border: 1px dashed #cbd5e1;
            border-radius: 6px;
            padding: 0.85rem 1rem;
        }

        /* Skema Angsuran Master Data Styles */
        .skema-container {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 1.25rem;
            box-shadow: none;
        }

        .skema-header {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid #f1f5f9;
        }

        .skema-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
            gap: 1rem;
        }

        .skema-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 1rem 1.15rem;
            position: relative;
            transition: all 0.2s ease;
            overflow: hidden;
            box-shadow: none;
        }

        .skema-card:hover {
            transform: translateY(-1px);
            border-color: #cbd5e1;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
        }

        .skema-card .tier-period {
            font-size: 0.82rem;
            font-weight: 700;
            color: #334155;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 0.4rem;
        }

        .skema-card .tier-amount {
            font-size: 1.3rem;
            font-weight: 800;
            color: #10b981;
            margin-bottom: 0.35rem;
            letter-spacing: -0.5px;
        }

        .skema-card .tier-amount span {
            font-size: 0.78rem;
            font-weight: 500;
            color: #6b7280;
        }

        .skema-card .tier-meta {
            font-size: 0.78rem;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* Document Category Styling */
        .doc-category-box {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 1.25rem;
            margin-bottom: 1.25rem;
            box-shadow: none;
        }

        .doc-category-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            margin-bottom: 1.25rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid #e2e8f0;
            flex-wrap: wrap;
        }

        .doc-category-icon {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.15rem;
            flex-shrink: 0;
            background-color: #f3e8ff !important;
            color: #9333ea !important;
        }

        .job-type-nav {
            display: inline-flex;
            background: #f1f5f9;
            padding: 4px;
            border-radius: 6px;
            gap: 4px;
        }

        .job-type-nav .btn-job-type {
            border: none;
            background: transparent;
            padding: 6px 16px;
            border-radius: 6px;
            font-size: 0.82rem;
            font-weight: 700;
            color: #64748b;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .job-type-nav .btn-job-type.active {
            background: #9a55ff !important;
            color: #ffffff !important;
            box-shadow: none !important;
        }

        /* Modern File Upload Cards */
        /* Modern File Upload Cards & Uploaded Boxes (Matching addkavling modal) */
        .properti-file-upload-modern {
            position: relative;
            width: 100%;
        }

        .properti-file-empty-box {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0.75rem 1rem;
            background: #ffffff;
            border: 1.5px dashed #cbd5e1;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            min-height: 60px;
        }

        .properti-file-empty-box:hover {
            border-color: #9a55ff;
            background: #faf7ff;
        }

        .empty-icon-circle {
            width: 38px;
            height: 38px;
            border-radius: 6px;
            background: #f3e8ff;
            color: #9a55ff;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 1.25rem;
        }

        .properti-file-upload-modern.error .properti-file-empty-box {
            border-color: #ef4444 !important;
            background: #fff5f5 !important;
        }

        /* Uploaded Green Box - Exact match to modal addkavling */
        .properti-uploaded-box {
            background: #f0fdf4 !important;
            border: 1.5px solid #86efac !important;
            padding: 12px 18px !important;
            min-height: 60px !important;
            border-radius: 8px !important;
            transition: all 0.2s ease;
        }

        .properti-uploaded-box:hover {
            border-color: #4ade80 !important;
        }

        .uploaded-icon-box {
            background: rgba(0, 201, 167, 0.15);
            color: #00c9a7;
            width: 38px;
            height: 38px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .btn-doc-lihat {
            background-color: #10b981 !important;
            border: none !important;
            font-size: 0.78rem !important;
            border-radius: 6px !important;
            gap: 4px;
            transition: all 0.15s ease;
        }
        .btn-doc-lihat:hover {
            background-color: #059669 !important;
            color: #ffffff !important;
        }

        .btn-doc-ganti {
            background-color: #9a55ff !important;
            border: 1px solid #9a55ff !important;
            font-size: 0.78rem !important;
            border-radius: 6px !important;
            gap: 4px;
            transition: all 0.15s ease;
        }
        .btn-doc-ganti:hover {
            background-color: #8338ec !important;
            border-color: #8338ec !important;
            color: #ffffff !important;
        }

        /* Backward compatibility for legacy labels if any */
        .properti-file-info-modern {
            flex: 1;
            min-width: 0;
        }

        .properti-file-info-modern span {
            display: block;
            font-weight: 700;
            color: #2c2e3f;
            font-size: 0.85rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .properti-file-info-modern small {
            color: #64748b;
            font-size: 0.72rem;
            display: block;
            margin-top: 2px;
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
            border-radius: 8px !important;
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

    <div class="container-fluid px-2 px-md-4 py-3">
        <!-- Page Title & Subtitle (Tanpa Card Persis Catalog Unit) -->
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
            <div>
                <h2 class="text-dark mb-1 fw-bold" style="font-size: 1.55rem; letter-spacing: -0.02em;">
                    Form Pengajuan KPR
                </h2>
                <p class="text-muted mb-0" style="font-size: 0.88rem;">
                    Lengkapi data pengajuan KPR untuk customer yang sudah booking unit
                </p>
            </div>
            <div>
                <a href="{{ route('marketing.list_pengajuan') }}" class="btn btn-sm d-inline-flex align-items-center gap-1 px-3 text-white fw-semibold" style="height: 34px; border-radius: 6px; background-color: #64748b; border: 1px solid #64748b;">
                    <i class="mdi mdi-arrow-left"></i> Kembali ke Daftar
                </a>
            </div>
        </div>

        <!-- Info Status Ribbon -->
        <div class="row mb-3">
            <div class="col-12">
                <div class="card" style="border: 1px solid #e2e8f0 !important; border-radius: 8px !important; background: #ffffff !important; box-shadow: none !important;">
                    <div class="card-body py-2 px-3">
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge text-white px-3 py-2" style="border-radius: 6px !important; font-weight: 700; font-size: 0.8rem; background: #9a55ff !important;">
                                    <i class="mdi mdi-plus-circle-outline me-1"></i>Pengajuan Baru
                                </span>
                                <span class="text-muted small d-flex align-items-center">
                                    <i class="mdi mdi-calendar-clock me-1 text-primary"></i>
                                    Tanggal: <strong>{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</strong>
                                </span>
                            </div>
                            <div>
                                <span class="badge px-3 py-2" style="border-radius: 6px !important; font-weight: 700; font-size: 0.8rem; background: #fef3c7 !important; color: #d97706 !important; border: 1px solid #fde68a !important;">
                                    <i class="mdi mdi-file-document-edit-outline me-1"></i>Status: Draft
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 8px; border-left: 4px solid #28a745;">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 8px; border-left: 4px solid #dc3545;">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger" style="border-radius: 8px; border-left: 4px solid #dc3545;">
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
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <div class="d-flex align-items-center gap-2">
                        <div style="width: 32px; height: 32px; border-radius: 6px; background-color: #f3e8ff; color: #9333ea; display: inline-flex; align-items: center; justify-content: center; font-size: 1.15rem; flex-shrink: 0;">
                            <i class="mdi mdi-account-box-outline"></i>
                        </div>
                        <span style="font-size: 0.95rem; font-weight: 700; color: #0f172a;">Data Customer & Detail Unit</span>
                    </div>
                    <span class="badge border px-2 py-1" style="font-size: 0.78rem; border-radius: 6px !important; background: #f8fafc; color: #64748b; border-color: #e2e8f0 !important;">
                        Kode Booking: <strong class="text-primary">{{ $booking->booking_code ?? 'BOOK-'.$booking->id }}</strong>
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
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <div style="width: 32px; height: 32px; border-radius: 6px; background-color: #f3e8ff; color: #9333ea; display: inline-flex; align-items: center; justify-content: center; font-size: 1.15rem; flex-shrink: 0;">
                            <i class="mdi mdi-calculator-variant"></i>
                        </div>
                        <span style="font-size: 0.95rem; font-weight: 700; color: #0f172a;">Data Pengajuan KPR & Simulasi Angsuran</span>
                    </div>
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

                    <!-- Status Pekerjaan Customer -->
                    <div class="row g-3 mb-3">
                        <div class="col-12">
                            <label class="form-label-kpr"><i class="mdi mdi-briefcase-outline text-primary me-1"></i>Status Pekerjaan Customer</label>
                            <input type="text" class="form-control-kpr" name="status_pekerjaan" value="{{ ($booking->customer->job_status ?? '') === 'Lainnya' ? ($booking->customer->job_status_lainnya ?? '') : ($booking->customer->job_status ?? '') }}" placeholder="Contoh: Karyawan Swasta / PNS">
                        </div>
                    </div>

                    <!-- Skema Angsuran KPR dari Master Data -->
                    <div class="skema-container mt-2">
                        <div class="skema-header">
                            <div>
                                <h6 class="mb-1 fw-bold text-dark d-flex align-items-center">
                                    <i class="mdi mdi-chart-timeline-variant text-primary me-2" style="font-size: 1.25rem;"></i>
                                    Rincian Skema Angsuran Flat (Master Data)
                                </h6>
                                <small class="text-muted">Cicilan flat per periode tahun yang diambil langsung dari Master Skema KPR Bank</small>
                            </div>
                            <span class="badge" id="skemaBadge" style="background: rgba(154, 85, 255, 0.12); color: #9a55ff; border: 1px solid rgba(154, 85, 255, 0.25); font-size: 0.78rem; font-weight: 600; padding: 0.45rem 0.85rem; border-radius: 6px !important;">
                                <i class="mdi mdi-database-sync me-1"></i> Sinkron Master Data
                            </span>
                        </div>

                        <!-- Area Tampilan Data Skema -->
                        <div id="skemaContent">
                            <div class="text-center py-4 text-muted" style="background: #fafafa; border-radius: 8px; border: 1px dashed #e2e8f0;">
                                <i class="mdi mdi-information-outline text-primary me-1" style="font-size: 1.25rem;"></i>
                                Silakan pilih Bank Tujuan dan Tenor Angsuran di atas untuk menampilkan rincian cicilan flat.
                            </div>
                        </div>

                        <!-- Hidden input untuk pengiriman nominal estimasi_angsuran ke backend -->
                        <input type="hidden" name="estimasi_angsuran" id="angsuran" value="0">
                    </div>
                </div>
            </div>

            <!-- CARD 3: DOKUMEN PERSYARATAN KPR -->
            <div class="card card-form-kpr">
                <div class="card-header d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2">
                    <div class="d-flex align-items-center gap-2">
                        <div style="width: 32px; height: 32px; border-radius: 6px; background-color: #f3e8ff; color: #9333ea; display: inline-flex; align-items: center; justify-content: center; font-size: 1.15rem; flex-shrink: 0;">
                            <i class="mdi mdi-file-document-multiple-outline"></i>
                        </div>
                        <div>
                            <span style="font-size: 0.95rem; font-weight: 700; color: #0f172a;" class="d-block">Upload Dokumen Persyaratan KPR</span>
                            <small class="text-muted" style="font-size: 0.8rem;">Lengkapi dokumen wajib untuk pengajuan berkas ke pihak bank</small>
                        </div>
                    </div>
                    <div>
                        <span class="badge px-3 py-2 text-white" id="uploadCounter" style="border-radius: 6px !important; font-weight: 700; font-size: 0.8rem; background: #9a55ff !important;">
                            0 / 8 Dokumen
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    @php
                        $customer = $booking->customer;
                        $rawJob = strtolower($customer->job_status ?? '');
                        $isWiraswasta = str_contains($rawJob, 'wira') || str_contains($rawJob, 'usaha') || str_contains($rawJob, 'dagang') || str_contains($rawJob, 'bisnis');
                        $rawMarital = strtoupper($customer->marital_status ?? '');
                        $isMenikah = (str_contains($rawMarital, 'KAWIN') && !str_contains($rawMarital, 'BELUM')) || (str_contains($rawMarital, 'NIKAH') && !str_contains($rawMarital, 'BELUM'));
                        $isCerai = str_contains($rawMarital, 'CERAI') || str_contains($rawMarital, 'DUDA') || str_contains($rawMarital, 'JANDA');
                        $rawCity = strtoupper($customer->city ?? $customer->domicile_city ?? '');
                        $isLuarJember = $rawCity && !str_contains($rawCity, 'JEMBER');

                        $docMap = [
                            'ktp'             => 'KTP',
                            'kk'              => 'Kartu Keluarga',
                            'npwp'            => 'NPWP',
                            'npwp_wiraswasta' => 'NPWP',
                            'ktp_pasangan'    => 'KTP Pasangan'
                        ];
                    @endphp

                    <!-- ============================================== -->
                    <!-- 1. DOKUMEN BANK                                -->
                    <!-- ============================================== -->
                    <div class="doc-category-box">
                        <div class="doc-category-header">
                            <div class="d-flex align-items-center gap-2">
                                <span class="doc-category-icon" style="background: rgba(154, 85, 255, 0.12); color: #9a55ff;">
                                    <i class="mdi mdi-bank"></i>
                                </span>
                                <div>
                                    <h6 class="fw-bold text-dark mb-0">1. Dokumen Bank</h6>
                                    <small class="text-muted">Formulir permohonan KPR bank dan verifikasi kepesertaan aplikasi</small>
                                </div>
                            </div>
                            <span class="badge" style="background: rgba(154, 85, 255, 0.12); color: #9a55ff; border: 1px solid rgba(154, 85, 255, 0.25); font-size: 0.72rem; border-radius: 6px;">
                                2 Dokumen
                            </span>
                        </div>

                        <div class="row g-3">
                            <!-- 1. Form Bank -->
                            <div class="col-12 col-md-6 mb-2">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <label class="form-label-kpr mb-0" for="form_bank">Form Bank <span class="req">*</span></label>
                                    <span class="badge bg-light text-primary border" style="font-size: 0.7rem;">Wajib</span>
                                </div>
                                <div class="properti-file-upload-modern" data-label="Form Bank">
                                    <input type="file" id="form_bank" name="form_bank" class="properti-file-input d-none" accept=".jpg,.jpeg,.png,.pdf" required>
                                    
                                    <div class="properti-file-empty-box" onclick="document.getElementById('form_bank').click()">
                                        <div class="empty-icon-circle">
                                            <i class="mdi mdi-cloud-upload"></i>
                                        </div>
                                        <div class="properti-file-info-modern">
                                            <span>Upload Form Bank</span>
                                            <small class="text-muted">Format: PDF, JPG, PNG (Max 5MB)</small>
                                        </div>
                                    </div>

                                    <div class="properti-uploaded-box rounded-3 mb-1" style="display: none;">
                                        <div class="d-flex align-items-center justify-content-between gap-3 w-100">
                                            <div class="d-flex align-items-center gap-2.5 overflow-hidden flex-grow-1" style="min-width: 0;">
                                                <div class="uploaded-icon-box">
                                                    <i class="mdi mdi-file-check-outline" style="font-size: 1.35rem;"></i>
                                                </div>
                                                <div class="overflow-hidden" style="min-width: 0;">
                                                    <span class="d-block fw-bold text-success text-truncate uploaded-doc-title" style="font-size: 0.88rem; line-height: 1.2;">Berkas Form Bank Terunggah</span>
                                                    <small class="text-muted text-truncate d-block uploaded-doc-subtitle" style="font-size: 0.72rem; margin-top: 2px;"></small>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center flex-shrink-0" style="gap: 8px;">
                                                <a href="#" target="_blank" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center btn-doc-lihat">
                                                    <i class="mdi mdi-eye" style="font-size: 0.95rem; line-height: 1;"></i>
                                                    <span>Lihat</span>
                                                </a>
                                                <button type="button" onclick="document.getElementById('form_bank').click()" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center btn-doc-ganti">
                                                    <i class="mdi mdi-cloud-sync" style="font-size: 0.95rem; line-height: 1;"></i>
                                                    <span>Ganti</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <small class="text-muted mt-1 d-block" style="font-size: 0.72rem;">*Formulir permohonan KPR resmi yang telah diisi & ditandatangani</small>
                            </div>

                            <!-- 2. Tapera Mobile -->
                            <div class="col-12 col-md-6 mb-2">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <label class="form-label-kpr mb-0" for="tapera_mobile">Tapera Mobile <span class="req">*</span></label>
                                    <span class="badge bg-light text-primary border" style="font-size: 0.7rem;">Wajib</span>
                                </div>
                                <div class="properti-file-upload-modern" data-label="Tapera Mobile">
                                    <input type="file" id="tapera_mobile" name="tapera_mobile" class="properti-file-input d-none" accept=".jpg,.jpeg,.png,.pdf" required>
                                    
                                    <div class="properti-file-empty-box" onclick="document.getElementById('tapera_mobile').click()">
                                        <div class="empty-icon-circle">
                                            <i class="mdi mdi-cloud-upload"></i>
                                        </div>
                                        <div class="properti-file-info-modern">
                                            <span>Upload Bukti Tapera Mobile</span>
                                            <small class="text-muted">Format: PDF, JPG, PNG (Max 5MB)</small>
                                        </div>
                                    </div>

                                    <div class="properti-uploaded-box rounded-3 mb-1" style="display: none;">
                                        <div class="d-flex align-items-center justify-content-between gap-3 w-100">
                                            <div class="d-flex align-items-center gap-2.5 overflow-hidden flex-grow-1" style="min-width: 0;">
                                                <div class="uploaded-icon-box">
                                                    <i class="mdi mdi-file-check-outline" style="font-size: 1.35rem;"></i>
                                                </div>
                                                <div class="overflow-hidden" style="min-width: 0;">
                                                    <span class="d-block fw-bold text-success text-truncate uploaded-doc-title" style="font-size: 0.88rem; line-height: 1.2;">Berkas Tapera Mobile Terunggah</span>
                                                    <small class="text-muted text-truncate d-block uploaded-doc-subtitle" style="font-size: 0.72rem; margin-top: 2px;"></small>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center flex-shrink-0" style="gap: 8px;">
                                                <a href="#" target="_blank" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center btn-doc-lihat">
                                                    <i class="mdi mdi-eye" style="font-size: 0.95rem; line-height: 1;"></i>
                                                    <span>Lihat</span>
                                                </a>
                                                <button type="button" onclick="document.getElementById('tapera_mobile').click()" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center btn-doc-ganti">
                                                    <i class="mdi mdi-cloud-sync" style="font-size: 0.95rem; line-height: 1;"></i>
                                                    <span>Ganti</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <small class="text-muted mt-1 d-block" style="font-size: 0.72rem;">*Screenshot bukti registrasi / kepesertaan aktif di aplikasi Tapera Mobile</small>
                            </div>
                        </div>
                    </div>

                    <!-- ============================================== -->
                    <!-- 2. DATA DIRI & KEPENDUDUKAN                    -->
                    <!-- ============================================== -->
                    <div class="doc-category-box">
                        <div class="doc-category-header">
                            <div class="d-flex align-items-center gap-2">
                                <span class="doc-category-icon" style="background: rgba(16, 185, 129, 0.12); color: #10b981;">
                                    <i class="mdi mdi-account-box-multiple"></i>
                                </span>
                                <div>
                                    <h6 class="fw-bold text-dark mb-0">2. Data Diri & Kependudukan</h6>
                                    <small class="text-muted">Dokumen identitas pemohon, pasangan, dan surat keterangan kelurahan</small>
                                </div>
                            </div>
                            <span class="badge" style="background: rgba(16, 185, 129, 0.12); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.25); font-size: 0.72rem; border-radius: 6px;">
                                Data Diri
                            </span>
                        </div>

                        <div class="row g-3">
                            <!-- 1. KTP Pemohon -->
                            @php
                                $hasKtp = isset($existingCustomerDocs['KTP']) && $existingCustomerDocs['KTP'];
                                $ktpFileUrl = $hasKtp ? (\Illuminate\Support\Str::startsWith($existingCustomerDocs['KTP'], 'uploads/') ? asset($existingCustomerDocs['KTP']) : asset('uploads/' . $existingCustomerDocs['KTP'])) : '';
                                $ktpPreview = $hasKtp ? route('document.preview', ['path' => (\Illuminate\Support\Str::startsWith($existingCustomerDocs['KTP'], 'uploads/') ? $existingCustomerDocs['KTP'] : 'uploads/' . $existingCustomerDocs['KTP'])]) : '';
                            @endphp
                            <div class="col-12 col-md-6 mb-2">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <label class="form-label-kpr mb-0" for="ktp">KTP Pemohon <span class="req">*</span></label>
                                    <span class="badge bg-light text-primary border" style="font-size: 0.7rem;">Wajib</span>
                                </div>
                                <div class="properti-file-upload-modern {{ $hasKtp ? 'has-existing-doc' : '' }}" data-label="KTP Pemohon">
                                    <input type="file" id="ktp" name="ktp" class="properti-file-input d-none" accept=".jpg,.jpeg,.png,.pdf" {{ $hasKtp ? '' : 'required' }}>
                                    
                                    <div class="properti-file-empty-box" style="{{ $hasKtp ? 'display: none;' : 'display: flex;' }}" onclick="document.getElementById('ktp').click()">
                                        <div class="empty-icon-circle">
                                            <i class="mdi mdi-cloud-upload"></i>
                                        </div>
                                        <div class="properti-file-info-modern">
                                            <span>Upload KTP Pemohon</span>
                                            <small class="text-muted">Format: PDF, JPG, PNG (Max 5MB)</small>
                                        </div>
                                    </div>

                                    <div class="properti-uploaded-box rounded-3 mb-1" style="{{ $hasKtp ? 'display: flex;' : 'display: none;' }}">
                                        <div class="d-flex align-items-center justify-content-between gap-3 w-100">
                                            <div class="d-flex align-items-center gap-2.5 overflow-hidden flex-grow-1" style="min-width: 0;">
                                                <div class="uploaded-icon-box">
                                                    <i class="mdi mdi-file-check-outline" style="font-size: 1.35rem;"></i>
                                                </div>
                                                <div class="overflow-hidden" style="min-width: 0;">
                                                    <span class="d-block fw-bold text-success text-truncate uploaded-doc-title" style="font-size: 0.88rem; line-height: 1.2;">Berkas KTP Pemohon Terunggah</span>
                                                    <small class="text-muted text-truncate d-block uploaded-doc-subtitle" style="font-size: 0.72rem; margin-top: 2px;">{{ $hasKtp ? 'Tersedia dari Data Customer' : '' }}</small>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center flex-shrink-0" style="gap: 8px;">
                                                <a href="{{ $ktpPreview ?: '#' }}" target="_blank" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center btn-doc-lihat">
                                                    <i class="mdi mdi-eye" style="font-size: 0.95rem; line-height: 1;"></i>
                                                    <span>Lihat</span>
                                                </a>
                                                @if (!$hasKtp)
                                                <button type="button" onclick="document.getElementById('ktp').click()" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center btn-doc-ganti">
                                                    <i class="mdi mdi-cloud-sync" style="font-size: 0.95rem; line-height: 1;"></i>
                                                    <span>Ganti</span>
                                                </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <small class="text-muted mt-1 d-block" style="font-size: 0.72rem;">*KTP asli pemohon yang masih berlaku</small>
                            </div>

                            <!-- 2. KTP Pasangan -->
                            @php
                                $hasKtpPasangan = isset($existingCustomerDocs['KTP Pasangan']) && $existingCustomerDocs['KTP Pasangan'];
                                $ktpPasanganFileUrl = $hasKtpPasangan ? (\Illuminate\Support\Str::startsWith($existingCustomerDocs['KTP Pasangan'], 'uploads/') ? asset($existingCustomerDocs['KTP Pasangan']) : asset('uploads/' . $existingCustomerDocs['KTP Pasangan'])) : '';
                                $ktpPasanganPreview = $hasKtpPasangan ? route('document.preview', ['path' => (\Illuminate\Support\Str::startsWith($existingCustomerDocs['KTP Pasangan'], 'uploads/') ? $existingCustomerDocs['KTP Pasangan'] : 'uploads/' . $existingCustomerDocs['KTP Pasangan'])]) : '';
                            @endphp
                            <div class="col-12 col-md-6 mb-2">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <label class="form-label-kpr mb-0" for="ktp_pasangan">
                                        KTP Pasangan @if($isMenikah) <span class="req">*</span> @endif
                                    </label>
                                    <span class="badge {{ $isMenikah ? 'bg-light text-primary border' : 'bg-light text-muted border' }}" style="font-size: 0.7rem; border-radius: 6px;">
                                        {{ $isMenikah ? 'Wajib (Menikah)' : 'Opsional' }}
                                    </span>
                                </div>
                                <div class="properti-file-upload-modern {{ $hasKtpPasangan ? 'has-existing-doc' : '' }}" data-label="KTP Pasangan">
                                    <input type="file" id="ktp_pasangan" name="ktp_pasangan" class="properti-file-input d-none" accept=".jpg,.jpeg,.png,.pdf" {{ ($isMenikah && !$hasKtpPasangan) ? 'required' : '' }}>
                                    
                                    <div class="properti-file-empty-box" style="{{ $hasKtpPasangan ? 'display: none;' : 'display: flex;' }}" onclick="document.getElementById('ktp_pasangan').click()">
                                        <div class="empty-icon-circle">
                                            <i class="mdi mdi-cloud-upload"></i>
                                        </div>
                                        <div class="properti-file-info-modern">
                                            <span>Upload KTP Pasangan</span>
                                            <small class="text-muted">Format: PDF, JPG, PNG (Max 5MB)</small>
                                        </div>
                                    </div>

                                    <div class="properti-uploaded-box rounded-3 mb-1" style="{{ $hasKtpPasangan ? 'display: flex;' : 'display: none;' }}">
                                        <div class="d-flex align-items-center justify-content-between gap-3 w-100">
                                            <div class="d-flex align-items-center gap-2.5 overflow-hidden flex-grow-1" style="min-width: 0;">
                                                <div class="uploaded-icon-box">
                                                    <i class="mdi mdi-file-check-outline" style="font-size: 1.35rem;"></i>
                                                </div>
                                                <div class="overflow-hidden" style="min-width: 0;">
                                                    <span class="d-block fw-bold text-success text-truncate uploaded-doc-title" style="font-size: 0.88rem; line-height: 1.2;">Berkas KTP Pasangan Terunggah</span>
                                                    <small class="text-muted text-truncate d-block uploaded-doc-subtitle" style="font-size: 0.72rem; margin-top: 2px;">{{ $hasKtpPasangan ? 'Tersedia dari Data Customer' : '' }}</small>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center flex-shrink-0" style="gap: 8px;">
                                                <a href="{{ $ktpPasanganPreview ?: '#' }}" target="_blank" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center btn-doc-lihat">
                                                    <i class="mdi mdi-eye" style="font-size: 0.95rem; line-height: 1;"></i>
                                                    <span>Lihat</span>
                                                </a>
                                                @if (!$hasKtpPasangan)
                                                <button type="button" onclick="document.getElementById('ktp_pasangan').click()" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center btn-doc-ganti">
                                                    <i class="mdi mdi-cloud-sync" style="font-size: 0.95rem; line-height: 1;"></i>
                                                    <span>Ganti</span>
                                                </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <small class="text-muted mt-1 d-block" style="font-size: 0.72rem;">*KTP asli suami/istri jika status sudah menikah</small>
                            </div>

                            <!-- 3. Kartu Keluarga Pemohon -->
                            @php
                                $hasKk = isset($existingCustomerDocs['Kartu Keluarga']) && $existingCustomerDocs['Kartu Keluarga'];
                                $kkFileUrl = $hasKk ? (\Illuminate\Support\Str::startsWith($existingCustomerDocs['Kartu Keluarga'], 'uploads/') ? asset($existingCustomerDocs['Kartu Keluarga']) : asset('uploads/' . $existingCustomerDocs['Kartu Keluarga'])) : '';
                                $kkPreview = $hasKk ? route('document.preview', ['path' => (\Illuminate\Support\Str::startsWith($existingCustomerDocs['Kartu Keluarga'], 'uploads/') ? $existingCustomerDocs['Kartu Keluarga'] : 'uploads/' . $existingCustomerDocs['Kartu Keluarga'])]) : '';
                            @endphp
                            <div class="col-12 col-md-6 mb-2">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <label class="form-label-kpr mb-0" for="kk">Kartu Keluarga (KK) Pemohon <span class="req">*</span></label>
                                    <span class="badge bg-light text-primary border" style="font-size: 0.7rem;">Wajib</span>
                                </div>
                                <div class="properti-file-upload-modern {{ $hasKk ? 'has-existing-doc' : '' }}" data-label="Kartu Keluarga (KK)">
                                    <input type="file" id="kk" name="kk" class="properti-file-input d-none" accept=".jpg,.jpeg,.png,.pdf" {{ $hasKk ? '' : 'required' }}>
                                    
                                    <div class="properti-file-empty-box" style="{{ $hasKk ? 'display: none;' : 'display: flex;' }}" onclick="document.getElementById('kk').click()">
                                        <div class="empty-icon-circle">
                                            <i class="mdi mdi-cloud-upload"></i>
                                        </div>
                                        <div class="properti-file-info-modern">
                                            <span>Upload Kartu Keluarga (KK)</span>
                                            <small class="text-muted">Format: PDF, JPG, PNG (Max 5MB)</small>
                                        </div>
                                    </div>

                                    <div class="properti-uploaded-box rounded-3 mb-1" style="{{ $hasKk ? 'display: flex;' : 'display: none;' }}">
                                        <div class="d-flex align-items-center justify-content-between gap-3 w-100">
                                            <div class="d-flex align-items-center gap-2.5 overflow-hidden flex-grow-1" style="min-width: 0;">
                                                <div class="uploaded-icon-box">
                                                    <i class="mdi mdi-file-check-outline" style="font-size: 1.35rem;"></i>
                                                </div>
                                                <div class="overflow-hidden" style="min-width: 0;">
                                                    <span class="d-block fw-bold text-success text-truncate uploaded-doc-title" style="font-size: 0.88rem; line-height: 1.2;">Berkas Kartu Keluarga (KK) Terunggah</span>
                                                    <small class="text-muted text-truncate d-block uploaded-doc-subtitle" style="font-size: 0.72rem; margin-top: 2px;">{{ $hasKk ? 'Tersedia dari Data Customer' : '' }}</small>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center flex-shrink-0" style="gap: 8px;">
                                                <a href="{{ $kkPreview ?: '#' }}" target="_blank" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center btn-doc-lihat">
                                                    <i class="mdi mdi-eye" style="font-size: 0.95rem; line-height: 1;"></i>
                                                    <span>Lihat</span>
                                                </a>
                                                @if (!$hasKk)
                                                <button type="button" onclick="document.getElementById('kk').click()" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center btn-doc-ganti">
                                                    <i class="mdi mdi-cloud-sync" style="font-size: 0.95rem; line-height: 1;"></i>
                                                    <span>Ganti</span>
                                                </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <small class="text-muted mt-1 d-block" style="font-size: 0.72rem;">*Kartu Keluarga terbaru ber-barcode / legalisir</small>
                            </div>

                            <!-- 4. Pas Foto Berwarna Pemohon & Pasangan -->
                            <div class="col-12 col-md-6 mb-2">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <label class="form-label-kpr mb-0" for="pas_foto">Foto Berwarna Pemohon & Pasangan <span class="req">*</span></label>
                                    <span class="badge bg-light text-primary border" style="font-size: 0.7rem;">Wajib</span>
                                </div>
                                <div class="properti-file-upload-modern" data-label="Foto Pemohon & Pasangan">
                                    <input type="file" id="pas_foto" name="pas_foto" class="properti-file-input d-none" accept=".jpg,.jpeg,.png,.pdf" required>
                                    
                                    <div class="properti-file-empty-box" onclick="document.getElementById('pas_foto').click()">
                                        <div class="empty-icon-circle">
                                            <i class="mdi mdi-cloud-upload"></i>
                                        </div>
                                        <div class="properti-file-info-modern">
                                            <span>Upload Pas Foto Berwarna</span>
                                            <small class="text-muted">Format: JPG, PNG, PDF (Max 5MB)</small>
                                        </div>
                                    </div>

                                    <div class="properti-uploaded-box rounded-3 mb-1" style="display: none;">
                                        <div class="d-flex align-items-center justify-content-between gap-3 w-100">
                                            <div class="d-flex align-items-center gap-2.5 overflow-hidden flex-grow-1" style="min-width: 0;">
                                                <div class="uploaded-icon-box">
                                                    <i class="mdi mdi-file-check-outline" style="font-size: 1.35rem;"></i>
                                                </div>
                                                <div class="overflow-hidden" style="min-width: 0;">
                                                    <span class="d-block fw-bold text-success text-truncate uploaded-doc-title" style="font-size: 0.88rem; line-height: 1.2;">Berkas Foto Pemohon & Pasangan Terunggah</span>
                                                    <small class="text-muted text-truncate d-block uploaded-doc-subtitle" style="font-size: 0.72rem; margin-top: 2px;"></small>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center flex-shrink-0" style="gap: 8px;">
                                                <a href="#" target="_blank" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center btn-doc-lihat">
                                                    <i class="mdi mdi-eye" style="font-size: 0.95rem; line-height: 1;"></i>
                                                    <span>Lihat</span>
                                                </a>
                                                <button type="button" onclick="document.getElementById('pas_foto').click()" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center btn-doc-ganti">
                                                    <i class="mdi mdi-cloud-sync" style="font-size: 0.95rem; line-height: 1;"></i>
                                                    <span>Ganti</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <small class="text-muted mt-1 d-block" style="font-size: 0.72rem;">*Pas foto formal 3x4 berwarna (background merah/biru)</small>
                            </div>

                            <!-- 5. Buku Nikah / Ket. Belum Menikah / Akta Cerai -->
                            <div class="col-12 col-md-6 mb-2">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <label class="form-label-kpr mb-0" for="surat_nikah">
                                        Buku Nikah / Ket. Belum Menikah / Akta Cerai <span class="req">*</span>
                                    </label>
                                    <span class="badge bg-light text-primary border" style="font-size: 0.7rem;">Sesuai KTP</span>
                                </div>
                                <div class="properti-file-upload-modern" data-label="Dokumen Status Nikah">
                                    <input type="file" id="surat_nikah" name="surat_nikah" class="properti-file-input d-none" accept=".jpg,.jpeg,.png,.pdf" required>
                                    
                                    <div class="properti-file-empty-box" onclick="document.getElementById('surat_nikah').click()">
                                        <div class="empty-icon-circle">
                                            <i class="mdi mdi-cloud-upload"></i>
                                        </div>
                                        <div class="properti-file-info-modern">
                                            <span>Upload Dokumen Status Nikah</span>
                                            <small class="text-muted">Format: PDF, JPG, PNG (Max 5MB)</small>
                                        </div>
                                    </div>

                                    <div class="properti-uploaded-box rounded-3 mb-1" style="display: none;">
                                        <div class="d-flex align-items-center justify-content-between gap-3 w-100">
                                            <div class="d-flex align-items-center gap-2.5 overflow-hidden flex-grow-1" style="min-width: 0;">
                                                <div class="uploaded-icon-box">
                                                    <i class="mdi mdi-file-check-outline" style="font-size: 1.35rem;"></i>
                                                </div>
                                                <div class="overflow-hidden" style="min-width: 0;">
                                                    <span class="d-block fw-bold text-success text-truncate uploaded-doc-title" style="font-size: 0.88rem; line-height: 1.2;">Berkas Dokumen Status Nikah Terunggah</span>
                                                    <small class="text-muted text-truncate d-block uploaded-doc-subtitle" style="font-size: 0.72rem; margin-top: 2px;"></small>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center flex-shrink-0" style="gap: 8px;">
                                                <a href="#" target="_blank" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center btn-doc-lihat">
                                                    <i class="mdi mdi-eye" style="font-size: 0.95rem; line-height: 1;"></i>
                                                    <span>Lihat</span>
                                                </a>
                                                <button type="button" onclick="document.getElementById('surat_nikah').click()" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center btn-doc-ganti">
                                                    <i class="mdi mdi-cloud-sync" style="font-size: 0.95rem; line-height: 1;"></i>
                                                    <span>Ganti</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <small class="text-muted mt-1 d-block" style="font-size: 0.72rem;">
                                    *Buku Nikah (Menikah) / Ket. Belum Menikah Kelurahan (Belum Menikah) / Akta Cerai (Cerai)
                                </small>
                            </div>

                            <!-- 6. Surat Keterangan Belum Menikah Kembali (Khusus Janda / Duda) -->
                            <div class="col-12 col-md-6 mb-2">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <label class="form-label-kpr mb-0" for="surat_belum_nikah_kembali">
                                        Ket. Belum Menikah Kembali
                                    </label>
                                    <span class="badge" style="{{ $isCerai ? 'background-color: #ea580c; color: #ffffff;' : 'background-color: #f8f9fa; color: #6c757d; border: 1px solid #dee2e6;' }} font-size: 0.7rem; font-weight: 600; border-radius: 6px; padding: 4px 8px;">
                                        {{ $isCerai ? 'Wajib (Janda/Duda)' : 'Khusus Janda/Duda' }}
                                    </span>
                                </div>
                                <div class="properti-file-upload-modern" data-label="Ket. Belum Nikah Kembali">
                                    <input type="file" id="surat_belum_nikah_kembali" name="surat_belum_nikah_kembali" class="properti-file-input d-none" accept=".jpg,.jpeg,.png,.pdf" {{ $isCerai ? 'required' : '' }}>
                                    
                                    <div class="properti-file-empty-box" onclick="document.getElementById('surat_belum_nikah_kembali').click()">
                                        <div class="empty-icon-circle">
                                            <i class="mdi mdi-cloud-upload"></i>
                                        </div>
                                        <div class="properti-file-info-modern">
                                            <span>Upload Surat Ket. Belum Nikah Kembali</span>
                                            <small class="text-muted">Format: PDF, JPG, PNG (Max 5MB)</small>
                                        </div>
                                    </div>

                                    <div class="properti-uploaded-box rounded-3 mb-1" style="display: none;">
                                        <div class="d-flex align-items-center justify-content-between gap-3 w-100">
                                            <div class="d-flex align-items-center gap-2.5 overflow-hidden flex-grow-1" style="min-width: 0;">
                                                <div class="uploaded-icon-box">
                                                    <i class="mdi mdi-file-check-outline" style="font-size: 1.35rem;"></i>
                                                </div>
                                                <div class="overflow-hidden" style="min-width: 0;">
                                                    <span class="d-block fw-bold text-success text-truncate uploaded-doc-title" style="font-size: 0.88rem; line-height: 1.2;">Berkas Ket. Belum Nikah Kembali Terunggah</span>
                                                    <small class="text-muted text-truncate d-block uploaded-doc-subtitle" style="font-size: 0.72rem; margin-top: 2px;"></small>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center flex-shrink-0" style="gap: 8px;">
                                                <a href="#" target="_blank" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center btn-doc-lihat">
                                                    <i class="mdi mdi-eye" style="font-size: 0.95rem; line-height: 1;"></i>
                                                    <span>Lihat</span>
                                                </a>
                                                <button type="button" onclick="document.getElementById('surat_belum_nikah_kembali').click()" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center btn-doc-ganti">
                                                    <i class="mdi mdi-cloud-sync" style="font-size: 0.95rem; line-height: 1;"></i>
                                                    <span>Ganti</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <small class="text-muted mt-1 d-block" style="font-size: 0.72rem;">*Surat Keterangan Belum Menikah Kembali dari Kelurahan (apabila status Janda / Duda)</small>
                            </div>

                            <!-- 7. Surat Keterangan Domisili (KTP Luar Jember) -->
                            <div class="col-12 col-md-6 mb-2">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <label class="form-label-kpr mb-0" for="surat_domisili">
                                        Surat Keterangan Domisili
                                    </label>
                                    <span class="badge" style="{{ $isLuarJember ? 'background-color: #ea580c; color: #ffffff;' : 'background-color: #f8f9fa; color: #6c757d; border: 1px solid #dee2e6;' }} font-size: 0.7rem; font-weight: 600; border-radius: 6px; padding: 4px 8px;">
                                        {{ $isLuarJember ? 'Wajib (KTP Luar Jember)' : 'Khusus Luar Jember' }}
                                    </span>
                                </div>
                                <div class="properti-file-upload-modern" data-label="Surat Keterangan Domisili">
                                    <input type="file" id="surat_domisili" name="surat_domisili" class="properti-file-input d-none" accept=".jpg,.jpeg,.png,.pdf" {{ $isLuarJember ? 'required' : '' }}>
                                    
                                    <div class="properti-file-empty-box" onclick="document.getElementById('surat_domisili').click()">
                                        <div class="empty-icon-circle">
                                            <i class="mdi mdi-cloud-upload"></i>
                                        </div>
                                        <div class="properti-file-info-modern">
                                            <span>Upload Surat Keterangan Domisili</span>
                                            <small class="text-muted">Format: PDF, JPG, PNG (Max 5MB)</small>
                                        </div>
                                    </div>

                                    <div class="properti-uploaded-box rounded-3 mb-1" style="display: none;">
                                        <div class="d-flex align-items-center justify-content-between gap-3 w-100">
                                            <div class="d-flex align-items-center gap-2.5 overflow-hidden flex-grow-1" style="min-width: 0;">
                                                <div class="uploaded-icon-box">
                                                    <i class="mdi mdi-file-check-outline" style="font-size: 1.35rem;"></i>
                                                </div>
                                                <div class="overflow-hidden" style="min-width: 0;">
                                                    <span class="d-block fw-bold text-success text-truncate uploaded-doc-title" style="font-size: 0.88rem; line-height: 1.2;">Berkas Surat Domisili Terunggah</span>
                                                    <small class="text-muted text-truncate d-block uploaded-doc-subtitle" style="font-size: 0.72rem; margin-top: 2px;"></small>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center flex-shrink-0" style="gap: 8px;">
                                                <a href="#" target="_blank" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center btn-doc-lihat">
                                                    <i class="mdi mdi-eye" style="font-size: 0.95rem; line-height: 1;"></i>
                                                    <span>Lihat</span>
                                                </a>
                                                <button type="button" onclick="document.getElementById('surat_domisili').click()" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center btn-doc-ganti">
                                                    <i class="mdi mdi-cloud-sync" style="font-size: 0.95rem; line-height: 1;"></i>
                                                    <span>Ganti</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <small class="text-muted mt-1 d-block" style="font-size: 0.72rem;">*Surat Keterangan Domisili dari Kelurahan setempat jika KTP bukan wilayah Jember</small>
                            </div>

                            <!-- 8. Surat Keterangan Tidak Punya Rumah -->
                            <div class="col-12 col-md-6 mb-2">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <label class="form-label-kpr mb-0" for="surat_belum_punya_rumah">
                                        Surat Ket. Tidak Punya Rumah <span class="req">*</span>
                                    </label>
                                    <span class="badge bg-light text-primary border" style="font-size: 0.7rem;">Wajib</span>
                                </div>
                                <div class="properti-file-upload-modern" data-label="Surat Ket. Tidak Punya Rumah">
                                    <input type="file" id="surat_belum_punya_rumah" name="surat_belum_punya_rumah" class="properti-file-input d-none" accept=".jpg,.jpeg,.png,.pdf" required>
                                    
                                    <div class="properti-file-empty-box" onclick="document.getElementById('surat_belum_punya_rumah').click()">
                                        <div class="empty-icon-circle">
                                            <i class="mdi mdi-cloud-upload"></i>
                                        </div>
                                        <div class="properti-file-info-modern">
                                            <span>Upload Surat Ket. Belum Punya Rumah</span>
                                            <small class="text-muted">Format: PDF, JPG, PNG (Max 5MB)</small>
                                        </div>
                                    </div>

                                    <div class="properti-uploaded-box rounded-3 mb-1" style="display: none;">
                                        <div class="d-flex align-items-center justify-content-between gap-3 w-100">
                                            <div class="d-flex align-items-center gap-2.5 overflow-hidden flex-grow-1" style="min-width: 0;">
                                                <div class="uploaded-icon-box">
                                                    <i class="mdi mdi-file-check-outline" style="font-size: 1.35rem;"></i>
                                                </div>
                                                <div class="overflow-hidden" style="min-width: 0;">
                                                    <span class="d-block fw-bold text-success text-truncate uploaded-doc-title" style="font-size: 0.88rem; line-height: 1.2;">Berkas Ket. Tidak Punya Rumah Terunggah</span>
                                                    <small class="text-muted text-truncate d-block uploaded-doc-subtitle" style="font-size: 0.72rem; margin-top: 2px;"></small>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center flex-shrink-0" style="gap: 8px;">
                                                <a href="#" target="_blank" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center btn-doc-lihat">
                                                    <i class="mdi mdi-eye" style="font-size: 0.95rem; line-height: 1;"></i>
                                                    <span>Lihat</span>
                                                </a>
                                                <button type="button" onclick="document.getElementById('surat_belum_punya_rumah').click()" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center btn-doc-ganti">
                                                    <i class="mdi mdi-cloud-sync" style="font-size: 0.95rem; line-height: 1;"></i>
                                                    <span>Ganti</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <small class="text-muted mt-1 d-block" style="font-size: 0.72rem;">*Surat Keterangan Belum Memiliki Rumah Pribadi dari Kelurahan / Desa</small>
                            </div>

                            <!-- 9. Surat Keterangan Jika Pasangan Tidak Bekerja -->
                            <div class="col-12 col-md-6 mb-2">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <label class="form-label-kpr mb-0" for="surat_pasangan_tidak_bekerja">
                                        Ket. Pasangan Tidak Bekerja
                                    </label>
                                    <span class="badge bg-light text-muted border" style="font-size: 0.7rem;">Opsional / Jika Berlaku</span>
                                </div>
                                <div class="properti-file-upload-modern" data-label="Ket. Pasangan Tidak Bekerja">
                                    <input type="file" id="surat_pasangan_tidak_bekerja" name="surat_pasangan_tidak_bekerja" class="properti-file-input d-none" accept=".jpg,.jpeg,.png,.pdf">
                                    
                                    <div class="properti-file-empty-box" onclick="document.getElementById('surat_pasangan_tidak_bekerja').click()">
                                        <div class="empty-icon-circle">
                                            <i class="mdi mdi-cloud-upload"></i>
                                        </div>
                                        <div class="properti-file-info-modern">
                                            <span>Upload Surat Ket. Pasangan Tidak Bekerja</span>
                                            <small class="text-muted">Format: PDF, JPG, PNG (Max 5MB)</small>
                                        </div>
                                    </div>

                                    <div class="properti-uploaded-box rounded-3 mb-1" style="display: none;">
                                        <div class="d-flex align-items-center justify-content-between gap-3 w-100">
                                            <div class="d-flex align-items-center gap-2.5 overflow-hidden flex-grow-1" style="min-width: 0;">
                                                <div class="uploaded-icon-box">
                                                    <i class="mdi mdi-file-check-outline" style="font-size: 1.35rem;"></i>
                                                </div>
                                                <div class="overflow-hidden" style="min-width: 0;">
                                                    <span class="d-block fw-bold text-success text-truncate uploaded-doc-title" style="font-size: 0.88rem; line-height: 1.2;">Berkas Ket. Pasangan Tidak Bekerja Terunggah</span>
                                                    <small class="text-muted text-truncate d-block uploaded-doc-subtitle" style="font-size: 0.72rem; margin-top: 2px;"></small>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center flex-shrink-0" style="gap: 8px;">
                                                <a href="#" target="_blank" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center btn-doc-lihat">
                                                    <i class="mdi mdi-eye" style="font-size: 0.95rem; line-height: 1;"></i>
                                                    <span>Lihat</span>
                                                </a>
                                                <button type="button" onclick="document.getElementById('surat_pasangan_tidak_bekerja').click()" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center btn-doc-ganti">
                                                    <i class="mdi mdi-cloud-sync" style="font-size: 0.95rem; line-height: 1;"></i>
                                                    <span>Ganti</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <small class="text-muted mt-1 d-block" style="font-size: 0.72rem;">*Surat Keterangan jika pasangan (suami/istri) tidak memiliki pekerjaan / tidak berpenghasilan</small>
                            </div>
                        </div>
                    </div>

                    <!-- ============================================== -->
                    <!-- 3. DOKUMEN PEKERJAAN & PENGHASILAN             -->
                    <!-- ============================================== -->
                    <div class="doc-category-box">
                        <div class="doc-category-header">
                            <div class="d-flex align-items-center gap-2">
                                <span class="doc-category-icon" style="background: rgba(245, 158, 11, 0.12); color: #d97706;">
                                    <i class="mdi mdi-briefcase"></i>
                                </span>
                                <div>
                                    <h6 class="fw-bold text-dark mb-0">3. Dokumen Pekerjaan & Penghasilan</h6>
                                    <small class="text-muted">Pilih profil pekerjaan pemohon untuk menyesuaikan berkas finansial yang wajib</small>
                                </div>
                            </div>
                            <div class="job-type-nav">
                                <button type="button" class="btn-job-type {{ $isWiraswasta ? '' : 'active' }}" id="btnTypeKaryawan">
                                    <i class="mdi mdi-account-tie me-1"></i> Karyawan Swasta / PNS
                                </button>
                                <button type="button" class="btn-job-type {{ $isWiraswasta ? 'active' : '' }}" id="btnTypeWiraswasta">
                                    <i class="mdi mdi-storefront me-1"></i> Wiraswasta / Usaha
                                </button>
                            </div>
                        </div>

                        <!-- 3.A. PROFIL: KARYAWAN SWASTA / PNS -->
                        <div id="sectionKaryawan" style="{{ $isWiraswasta ? 'display: none;' : '' }}">
                            <div class="alert alert-info py-2 px-3 mb-3 d-flex align-items-center" style="border-radius: 8px; font-size: 0.82rem;">
                                <i class="mdi mdi-information-outline me-2 fs-6"></i>
                                Profil Pekerjaan: <strong>Karyawan Swasta / PNS / BUMN / Pegawai</strong>. Wajib melengkapi 6 berkas di bawah ini:
                            </div>

                            @php
                                $hasNpwp = isset($existingCustomerDocs['NPWP']) && $existingCustomerDocs['NPWP'];
                                $npwpFileUrl = $hasNpwp ? (\Illuminate\Support\Str::startsWith($existingCustomerDocs['NPWP'], 'uploads/') ? asset($existingCustomerDocs['NPWP']) : asset('uploads/' . $existingCustomerDocs['NPWP'])) : '';
                                $npwpPreview = $hasNpwp ? route('document.preview', ['path' => (\Illuminate\Support\Str::startsWith($existingCustomerDocs['NPWP'], 'uploads/') ? $existingCustomerDocs['NPWP'] : 'uploads/' . $existingCustomerDocs['NPWP'])]) : '';
                            @endphp

                            <div class="row g-3">
                                <!-- 1. NPWP -->
                                <div class="col-12 col-md-6 mb-2">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <label class="form-label-kpr mb-0" for="npwp">NPWP Pemohon <span class="req">*</span></label>
                                        <span class="badge bg-light text-primary border" style="font-size: 0.7rem;">Wajib</span>
                                    </div>
                                    <div class="properti-file-upload-modern {{ $hasNpwp ? 'has-existing-doc' : '' }}" data-label="NPWP Pemohon">
                                        <input type="file" id="npwp" name="npwp" class="properti-file-input d-none" accept=".jpg,.jpeg,.png,.pdf" {{ ($hasNpwp || $isWiraswasta) ? '' : 'required' }}>
                                        
                                        <div class="properti-file-empty-box" style="{{ $hasNpwp ? 'display: none;' : 'display: flex;' }}" onclick="document.getElementById('npwp').click()">
                                            <div class="empty-icon-circle">
                                                <i class="mdi mdi-cloud-upload"></i>
                                            </div>
                                            <div class="properti-file-info-modern">
                                                <span>Upload NPWP Pemohon</span>
                                                <small class="text-muted">Format: PDF, JPG, PNG (Max 5MB)</small>
                                            </div>
                                        </div>

                                        <div class="properti-uploaded-box rounded-3 mb-1" style="{{ $hasNpwp ? 'display: flex;' : 'display: none;' }}">
                                            <div class="d-flex align-items-center justify-content-between gap-3 w-100">
                                                <div class="d-flex align-items-center gap-2.5 overflow-hidden flex-grow-1" style="min-width: 0;">
                                                    <div class="uploaded-icon-box">
                                                        <i class="mdi mdi-file-check-outline" style="font-size: 1.35rem;"></i>
                                                    </div>
                                                    <div class="overflow-hidden" style="min-width: 0;">
                                                        <span class="d-block fw-bold text-success text-truncate uploaded-doc-title" style="font-size: 0.88rem; line-height: 1.2;">Berkas NPWP Pemohon Terunggah</span>
                                                        <small class="text-muted text-truncate d-block uploaded-doc-subtitle" style="font-size: 0.72rem; margin-top: 2px;">{{ $hasNpwp ? 'Tersedia dari Data Customer' : '' }}</small>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center flex-shrink-0" style="gap: 8px;">
                                                    <a href="{{ $npwpPreview ?: '#' }}" target="_blank" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center btn-doc-lihat">
                                                        <i class="mdi mdi-eye" style="font-size: 0.95rem; line-height: 1;"></i>
                                                        <span>Lihat</span>
                                                    </a>
                                                    @if (!$hasNpwp)
                                                    <button type="button" onclick="document.getElementById('npwp').click()" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center btn-doc-ganti">
                                                        <i class="mdi mdi-cloud-sync" style="font-size: 0.95rem; line-height: 1;"></i>
                                                        <span>Ganti</span>
                                                    </button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <small class="text-muted mt-1 d-block" style="font-size: 0.72rem;">*Kartu NPWP pemohon yang valid</small>
                                </div>

                                <!-- 2. SPT Tahunan -->
                                <div class="col-12 col-md-6 mb-2">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <label class="form-label-kpr mb-0" for="spt">SPT Tahunan <span class="req">*</span></label>
                                        <span class="badge bg-light text-primary border" style="font-size: 0.7rem;">Wajib</span>
                                    </div>
                                    <div class="properti-file-upload-modern" data-label="SPT Tahunan">
                                        <input type="file" id="spt" name="spt" class="properti-file-input d-none" accept=".jpg,.jpeg,.png,.pdf" {{ $isWiraswasta ? '' : 'required' }}>
                                        
                                        <div class="properti-file-empty-box" onclick="document.getElementById('spt').click()">
                                            <div class="empty-icon-circle">
                                                <i class="mdi mdi-cloud-upload"></i>
                                            </div>
                                            <div class="properti-file-info-modern">
                                                <span>Upload Bukti Lapor SPT Tahunan</span>
                                                <small class="text-muted">Format: PDF, JPG, PNG (Max 5MB)</small>
                                            </div>
                                        </div>

                                        <div class="properti-uploaded-box rounded-3 mb-1" style="display: none;">
                                            <div class="d-flex align-items-center justify-content-between gap-3 w-100">
                                                <div class="d-flex align-items-center gap-2.5 overflow-hidden flex-grow-1" style="min-width: 0;">
                                                    <div class="uploaded-icon-box">
                                                        <i class="mdi mdi-file-check-outline" style="font-size: 1.35rem;"></i>
                                                    </div>
                                                    <div class="overflow-hidden" style="min-width: 0;">
                                                        <span class="d-block fw-bold text-success text-truncate uploaded-doc-title" style="font-size: 0.88rem; line-height: 1.2;">Berkas SPT Tahunan Terunggah</span>
                                                        <small class="text-muted text-truncate d-block uploaded-doc-subtitle" style="font-size: 0.72rem; margin-top: 2px;"></small>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center flex-shrink-0" style="gap: 8px;">
                                                    <a href="#" target="_blank" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center btn-doc-lihat">
                                                        <i class="mdi mdi-eye" style="font-size: 0.95rem; line-height: 1;"></i>
                                                        <span>Lihat</span>
                                                    </a>
                                                    <button type="button" onclick="document.getElementById('spt').click()" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center btn-doc-ganti">
                                                        <i class="mdi mdi-cloud-sync" style="font-size: 0.95rem; line-height: 1;"></i>
                                                        <span>Ganti</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <small class="text-muted mt-1 d-block" style="font-size: 0.72rem;">*Bukti Penerimaan Elektronik (BPE) / Formulir SPT Tahunan PPh 21 terakhir</small>
                                </div>

                                <!-- 3. Surat Keterangan Kerja -->
                                <div class="col-12 col-md-6 mb-2">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <label class="form-label-kpr mb-0" for="surat_keterangan_kerja">Surat Keterangan Kerja <span class="req">*</span></label>
                                        <span class="badge bg-light text-primary border" style="font-size: 0.7rem;">Wajib</span>
                                    </div>
                                    <div class="properti-file-upload-modern" data-label="Surat Keterangan Kerja">
                                        <input type="file" id="surat_keterangan_kerja" name="surat_keterangan_kerja" class="properti-file-input d-none" accept=".jpg,.jpeg,.png,.pdf" {{ $isWiraswasta ? '' : 'required' }}>
                                        
                                        <div class="properti-file-empty-box" onclick="document.getElementById('surat_keterangan_kerja').click()">
                                            <div class="empty-icon-circle">
                                                <i class="mdi mdi-cloud-upload"></i>
                                            </div>
                                            <div class="properti-file-info-modern">
                                                <span>Upload Surat Keterangan Kerja</span>
                                                <small class="text-muted">Format: PDF, JPG, PNG (Max 5MB)</small>
                                            </div>
                                        </div>

                                        <div class="properti-uploaded-box rounded-3 mb-1" style="display: none;">
                                            <div class="d-flex align-items-center justify-content-between gap-3 w-100">
                                                <div class="d-flex align-items-center gap-2.5 overflow-hidden flex-grow-1" style="min-width: 0;">
                                                    <div class="uploaded-icon-box">
                                                        <i class="mdi mdi-file-check-outline" style="font-size: 1.35rem;"></i>
                                                    </div>
                                                    <div class="overflow-hidden" style="min-width: 0;">
                                                        <span class="d-block fw-bold text-success text-truncate uploaded-doc-title" style="font-size: 0.88rem; line-height: 1.2;">Berkas Surat Keterangan Kerja Terunggah</span>
                                                        <small class="text-muted text-truncate d-block uploaded-doc-subtitle" style="font-size: 0.72rem; margin-top: 2px;"></small>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center flex-shrink-0" style="gap: 8px;">
                                                    <a href="#" target="_blank" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center btn-doc-lihat">
                                                        <i class="mdi mdi-eye" style="font-size: 0.95rem; line-height: 1;"></i>
                                                        <span>Lihat</span>
                                                    </a>
                                                    <button type="button" onclick="document.getElementById('surat_keterangan_kerja').click()" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center btn-doc-ganti">
                                                        <i class="mdi mdi-cloud-sync" style="font-size: 0.95rem; line-height: 1;"></i>
                                                        <span>Ganti</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <small class="text-muted mt-1 d-block" style="font-size: 0.72rem;">*SK Pengangkatan / Surat Keterangan Bekerja Aktif dengan kop & stempel instansi</small>
                                </div>

                                <!-- 4. Slip Gaji 3 Bulan Terakhir -->
                                <div class="col-12 col-md-6 mb-2">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <label class="form-label-kpr mb-0" for="slip_gaji">Slip Gaji 3 Bulan Terakhir <span class="req">*</span></label>
                                        <span class="badge bg-light text-primary border" style="font-size: 0.7rem;">Wajib</span>
                                    </div>
                                    <div class="properti-file-upload-modern" data-label="Slip Gaji 3 Bulan">
                                        <input type="file" id="slip_gaji" name="slip_gaji" class="properti-file-input d-none" accept=".jpg,.jpeg,.png,.pdf" {{ $isWiraswasta ? '' : 'required' }}>
                                        
                                        <div class="properti-file-empty-box" onclick="document.getElementById('slip_gaji').click()">
                                            <div class="empty-icon-circle">
                                                <i class="mdi mdi-cloud-upload"></i>
                                            </div>
                                            <div class="properti-file-info-modern">
                                                <span>Upload Slip Gaji 3 Bulan</span>
                                                <small class="text-muted">Format: PDF, JPG, PNG (Max 5MB)</small>
                                            </div>
                                        </div>

                                        <div class="properti-uploaded-box rounded-3 mb-1" style="display: none;">
                                            <div class="d-flex align-items-center justify-content-between gap-3 w-100">
                                                <div class="d-flex align-items-center gap-2.5 overflow-hidden flex-grow-1" style="min-width: 0;">
                                                    <div class="uploaded-icon-box">
                                                        <i class="mdi mdi-file-check-outline" style="font-size: 1.35rem;"></i>
                                                    </div>
                                                    <div class="overflow-hidden" style="min-width: 0;">
                                                        <span class="d-block fw-bold text-success text-truncate uploaded-doc-title" style="font-size: 0.88rem; line-height: 1.2;">Berkas Slip Gaji 3 Bulan Terunggah</span>
                                                        <small class="text-muted text-truncate d-block uploaded-doc-subtitle" style="font-size: 0.72rem; margin-top: 2px;"></small>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center flex-shrink-0" style="gap: 8px;">
                                                    <a href="#" target="_blank" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center btn-doc-lihat">
                                                        <i class="mdi mdi-eye" style="font-size: 0.95rem; line-height: 1;"></i>
                                                        <span>Lihat</span>
                                                    </a>
                                                    <button type="button" onclick="document.getElementById('slip_gaji').click()" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center btn-doc-ganti">
                                                        <i class="mdi mdi-cloud-sync" style="font-size: 0.95rem; line-height: 1;"></i>
                                                        <span>Ganti</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <small class="text-muted mt-1 d-block" style="font-size: 0.72rem;">*Slip gaji 3 bulan berturut-turut asli bertandatangan HRD/Keuangan</small>
                                </div>

                                <!-- 5. Rekening Koran 3 Bulan Terakhir -->
                                <div class="col-12 col-md-6 mb-2">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <label class="form-label-kpr mb-0" for="rekening_koran">Rekening Koran 3 Bulan Terakhir <span class="req">*</span></label>
                                        <span class="badge bg-light text-primary border" style="font-size: 0.7rem;">Wajib</span>
                                    </div>
                                    <div class="properti-file-upload-modern" data-label="Rekening Koran 3 Bulan">
                                        <input type="file" id="rekening_koran" name="rekening_koran" class="properti-file-input d-none" accept=".jpg,.jpeg,.png,.pdf" {{ $isWiraswasta ? '' : 'required' }}>
                                        
                                        <div class="properti-file-empty-box" onclick="document.getElementById('rekening_koran').click()">
                                            <div class="empty-icon-circle">
                                                <i class="mdi mdi-cloud-upload"></i>
                                            </div>
                                            <div class="properti-file-info-modern">
                                                <span>Upload Rekening Koran 3 Bulan</span>
                                                <small class="text-muted">Format: PDF, JPG, PNG (Max 5MB)</small>
                                            </div>
                                        </div>

                                        <div class="properti-uploaded-box rounded-3 mb-1" style="display: none;">
                                            <div class="d-flex align-items-center justify-content-between gap-3 w-100">
                                                <div class="d-flex align-items-center gap-2.5 overflow-hidden flex-grow-1" style="min-width: 0;">
                                                    <div class="uploaded-icon-box">
                                                        <i class="mdi mdi-file-check-outline" style="font-size: 1.35rem;"></i>
                                                    </div>
                                                    <div class="overflow-hidden" style="min-width: 0;">
                                                        <span class="d-block fw-bold text-success text-truncate uploaded-doc-title" style="font-size: 0.88rem; line-height: 1.2;">Berkas Rekening Koran 3 Bulan Terunggah</span>
                                                        <small class="text-muted text-truncate d-block uploaded-doc-subtitle" style="font-size: 0.72rem; margin-top: 2px;"></small>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center flex-shrink-0" style="gap: 8px;">
                                                    <a href="#" target="_blank" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center btn-doc-lihat">
                                                        <i class="mdi mdi-eye" style="font-size: 0.95rem; line-height: 1;"></i>
                                                        <span>Lihat</span>
                                                    </a>
                                                    <button type="button" onclick="document.getElementById('rekening_koran').click()" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center btn-doc-ganti">
                                                        <i class="mdi mdi-cloud-sync" style="font-size: 0.95rem; line-height: 1;"></i>
                                                        <span>Ganti</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <small class="text-muted mt-1 d-block" style="font-size: 0.72rem;">*Rekening koran tabungan gaji / mutasi payroll 3 bulan terakhir berstempel bank</small>
                                </div>

                                <!-- 6. Denah Tempat Kerja dan Foto -->
                                <div class="col-12 col-md-6 mb-2">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <label class="form-label-kpr mb-0" for="denah_tempat_kerja">Denah Tempat Kerja & Foto <span class="req">*</span></label>
                                        <span class="badge bg-light text-primary border" style="font-size: 0.7rem;">Wajib</span>
                                    </div>
                                    <div class="properti-file-upload-modern" data-label="Denah & Foto Tempat Kerja">
                                        <input type="file" id="denah_tempat_kerja" name="denah_tempat_kerja" class="properti-file-input d-none" accept=".jpg,.jpeg,.png,.pdf" {{ $isWiraswasta ? '' : 'required' }}>
                                        
                                        <div class="properti-file-empty-box" onclick="document.getElementById('denah_tempat_kerja').click()">
                                            <div class="empty-icon-circle">
                                                <i class="mdi mdi-cloud-upload"></i>
                                            </div>
                                            <div class="properti-file-info-modern">
                                                <span>Upload Denah & Foto Tempat Kerja</span>
                                                <small class="text-muted">Format: PDF, JPG, PNG (Max 5MB)</small>
                                            </div>
                                        </div>

                                        <div class="properti-uploaded-box rounded-3 mb-1" style="display: none;">
                                            <div class="d-flex align-items-center justify-content-between gap-3 w-100">
                                                <div class="d-flex align-items-center gap-2.5 overflow-hidden flex-grow-1" style="min-width: 0;">
                                                    <div class="uploaded-icon-box">
                                                        <i class="mdi mdi-file-check-outline" style="font-size: 1.35rem;"></i>
                                                    </div>
                                                    <div class="overflow-hidden" style="min-width: 0;">
                                                        <span class="d-block fw-bold text-success text-truncate uploaded-doc-title" style="font-size: 0.88rem; line-height: 1.2;">Berkas Denah & Foto Tempat Kerja Terunggah</span>
                                                        <small class="text-muted text-truncate d-block uploaded-doc-subtitle" style="font-size: 0.72rem; margin-top: 2px;"></small>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center flex-shrink-0" style="gap: 8px;">
                                                    <a href="#" target="_blank" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center btn-doc-lihat">
                                                        <i class="mdi mdi-eye" style="font-size: 0.95rem; line-height: 1;"></i>
                                                        <span>Lihat</span>
                                                    </a>
                                                    <button type="button" onclick="document.getElementById('denah_tempat_kerja').click()" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center btn-doc-ganti">
                                                        <i class="mdi mdi-cloud-sync" style="font-size: 0.95rem; line-height: 1;"></i>
                                                        <span>Ganti</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <small class="text-muted mt-1 d-block" style="font-size: 0.72rem;">*Denah rute kantor dan foto tampak depan gedung / ruangan kantor</small>
                                </div>
                            </div>
                        </div>

                        <!-- 3.B. PROFIL: WIRASWASTA -->
                        <div id="sectionWiraswasta" style="{{ $isWiraswasta ? '' : 'display: none;' }}">
                            <div class="alert alert-warning py-2 px-3 mb-3 d-flex align-items-center" style="border-radius: 8px; font-size: 0.82rem;">
                                <i class="mdi mdi-information-outline me-2 fs-6"></i>
                                Profil Pekerjaan: <strong>Wiraswasta / Pengusaha / Pedagang</strong>. Wajib melengkapi 6 berkas di bawah ini:
                            </div>

                            <div class="row g-3">
                                <!-- 1. NPWP Wiraswasta -->
                                <div class="col-12 col-md-6 mb-2">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <label class="form-label-kpr mb-0" for="npwp_wiraswasta">NPWP Pemohon <span class="req">*</span></label>
                                        <span class="badge bg-light text-primary border" style="font-size: 0.7rem;">Wajib</span>
                                    </div>
                                    <div class="properti-file-upload-modern {{ $hasNpwp ? 'has-existing-doc' : '' }}" data-label="NPWP Pemohon">
                                        <input type="file" id="npwp_wiraswasta" name="npwp_wiraswasta" class="properti-file-input d-none" accept=".jpg,.jpeg,.png,.pdf" {{ ($hasNpwp || !$isWiraswasta) ? '' : 'required' }}>
                                        
                                        <div class="properti-file-empty-box" style="{{ $hasNpwp ? 'display: none;' : 'display: flex;' }}" onclick="document.getElementById('npwp_wiraswasta').click()">
                                            <div class="empty-icon-circle">
                                                <i class="mdi mdi-cloud-upload"></i>
                                            </div>
                                            <div class="properti-file-info-modern">
                                                <span>Upload NPWP Pemohon</span>
                                                <small class="text-muted">Format: PDF, JPG, PNG (Max 5MB)</small>
                                            </div>
                                        </div>

                                        <div class="properti-uploaded-box rounded-3 mb-1" style="{{ $hasNpwp ? 'display: flex;' : 'display: none;' }}">
                                            <div class="d-flex align-items-center justify-content-between gap-3 w-100">
                                                <div class="d-flex align-items-center gap-2.5 overflow-hidden flex-grow-1" style="min-width: 0;">
                                                    <div class="uploaded-icon-box">
                                                        <i class="mdi mdi-file-check-outline" style="font-size: 1.35rem;"></i>
                                                    </div>
                                                    <div class="overflow-hidden" style="min-width: 0;">
                                                        <span class="d-block fw-bold text-success text-truncate uploaded-doc-title" style="font-size: 0.88rem; line-height: 1.2;">Berkas NPWP Pemohon Terunggah</span>
                                                        <small class="text-muted text-truncate d-block uploaded-doc-subtitle" style="font-size: 0.72rem; margin-top: 2px;">{{ $hasNpwp ? 'Tersedia dari Data Customer' : '' }}</small>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center flex-shrink-0" style="gap: 8px;">
                                                    <a href="{{ $npwpPreview ?: '#' }}" target="_blank" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center btn-doc-lihat">
                                                        <i class="mdi mdi-eye" style="font-size: 0.95rem; line-height: 1;"></i>
                                                        <span>Lihat</span>
                                                    </a>
                                                    @if (!$hasNpwp)
                                                    <button type="button" onclick="document.getElementById('npwp_wiraswasta').click()" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center btn-doc-ganti">
                                                        <i class="mdi mdi-cloud-sync" style="font-size: 0.95rem; line-height: 1;"></i>
                                                        <span>Ganti</span>
                                                    </button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <small class="text-muted mt-1 d-block" style="font-size: 0.72rem;">*Kartu NPWP pemohon yang valid</small>
                                </div>

                                <!-- 2. SPT Tahunan Wiraswasta -->
                                <div class="col-12 col-md-6 mb-2">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <label class="form-label-kpr mb-0" for="spt_wiraswasta">SPT Tahunan <span class="req">*</span></label>
                                        <span class="badge bg-light text-primary border" style="font-size: 0.7rem;">Wajib</span>
                                    </div>
                                    <div class="properti-file-upload-modern" data-label="SPT Tahunan">
                                        <input type="file" id="spt_wiraswasta" name="spt_wiraswasta" class="properti-file-input d-none" accept=".jpg,.jpeg,.png,.pdf" {{ $isWiraswasta ? 'required' : '' }}>
                                        
                                        <div class="properti-file-empty-box" onclick="document.getElementById('spt_wiraswasta').click()">
                                            <div class="empty-icon-circle">
                                                <i class="mdi mdi-cloud-upload"></i>
                                            </div>
                                            <div class="properti-file-info-modern">
                                                <span>Upload Bukti Lapor SPT Tahunan</span>
                                                <small class="text-muted">Format: PDF, JPG, PNG (Max 5MB)</small>
                                            </div>
                                        </div>

                                        <div class="properti-uploaded-box rounded-3 mb-1" style="display: none;">
                                            <div class="d-flex align-items-center justify-content-between gap-3 w-100">
                                                <div class="d-flex align-items-center gap-2.5 overflow-hidden flex-grow-1" style="min-width: 0;">
                                                    <div class="uploaded-icon-box">
                                                        <i class="mdi mdi-file-check-outline" style="font-size: 1.35rem;"></i>
                                                    </div>
                                                    <div class="overflow-hidden" style="min-width: 0;">
                                                        <span class="d-block fw-bold text-success text-truncate uploaded-doc-title" style="font-size: 0.88rem; line-height: 1.2;">Berkas SPT Tahunan Terunggah</span>
                                                        <small class="text-muted text-truncate d-block uploaded-doc-subtitle" style="font-size: 0.72rem; margin-top: 2px;"></small>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center flex-shrink-0" style="gap: 8px;">
                                                    <a href="#" target="_blank" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center btn-doc-lihat">
                                                        <i class="mdi mdi-eye" style="font-size: 0.95rem; line-height: 1;"></i>
                                                        <span>Lihat</span>
                                                    </a>
                                                    <button type="button" onclick="document.getElementById('spt_wiraswasta').click()" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-center justify-content-center btn-doc-ganti">
                                                        <i class="mdi mdi-cloud-sync" style="font-size: 0.95rem; line-height: 1;"></i>
                                                        <span>Ganti</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <small class="text-muted mt-1 d-block" style="font-size: 0.72rem;">*Bukti Penerimaan Elektronik (BPE) SPT Tahunan Orang Pribadi / Badan</small>
                                </div>

                                <!-- 3. Surat Keterangan Usaha (SKU) -->
                                <div class="col-12 col-md-6 mb-2">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <label class="form-label-kpr mb-0" for="sku">Surat Keterangan Usaha (SKU) <span class="req">*</span></label>
                                        <span class="badge bg-light text-primary border" style="font-size: 0.7rem;">Wajib</span>
                                    </div>
                                    <div class="properti-file-upload-modern" data-label="Surat Keterangan Usaha (SKU)">
                                        <input type="file" id="sku" name="sku" class="properti-file-input d-none" accept=".jpg,.jpeg,.png,.pdf" {{ $isWiraswasta ? 'required' : '' }}>
                                        
                                        <div class="properti-file-empty-box" onclick="document.getElementById('sku').click()">
                                            <div class="empty-icon-circle">
                                                <i class="mdi mdi-cloud-upload"></i>
                                            </div>
                                            <div class="properti-file-info-modern">
                                                <span>Upload SKU / NIB</span>
                                                <small class="text-muted">Format: PDF, JPG, PNG (Max 5MB)</small>
                                            </div>
                                        </div>

                                        <div class="properti-uploaded-box rounded-3 mb-1" style="display: none;">
                                            <div class="d-flex align-items-center justify-content-between gap-3 w-100">
                                                <div class="d-flex align-items-center gap-2.5 overflow-hidden flex-grow-1" style="min-width: 0;">
                                                    <div class="uploaded-icon-box">
                                                        <i class="mdi mdi-file-check-outline" style="font-size: 1.35rem;"></i>
                                                    </div>
                                                    <div class="overflow-hidden" style="min-width: 0;">
                                                        <span class="d-block fw-bold text-success text-truncate uploaded-doc-title" style="font-size: 0.88rem; line-height: 1.2;">Berkas SKU / NIB Terunggah</span>
                                                        <small class="text-muted text-truncate d-block uploaded-doc-subtitle" style="font-size: 0.72rem; margin-top: 2px;"></small>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center flex-shrink-0" style="gap: 8px;">
                                                    <a href="#" target="_blank" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center btn-doc-lihat">
                                                        <i class="mdi mdi-eye" style="font-size: 0.95rem; line-height: 1;"></i>
                                                        <span>Lihat</span>
                                                    </a>
                                                    <button type="button" onclick="document.getElementById('sku').click()" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center btn-doc-ganti">
                                                        <i class="mdi mdi-cloud-sync" style="font-size: 0.95rem; line-height: 1;"></i>
                                                        <span>Ganti</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <small class="text-muted mt-1 d-block" style="font-size: 0.72rem;">*Surat Keterangan Usaha dari Kelurahan / NIB OSS yang masih aktif</small>
                                </div>

                                <!-- 4. Slip Gaji / Laporan Keuangan 6 Bulan Terakhir -->
                                <div class="col-12 col-md-6 mb-2">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <label class="form-label-kpr mb-0" for="slip_gaji_wiraswasta">Slip Gaji / Laporan 6 Bulan <span class="req">*</span></label>
                                        <span class="badge bg-light text-primary border" style="font-size: 0.7rem;">Wajib</span>
                                    </div>
                                    <div class="properti-file-upload-modern" data-label="Laporan Keuangan 6 Bulan">
                                        <input type="file" id="slip_gaji_wiraswasta" name="slip_gaji_wiraswasta" class="properti-file-input d-none" accept=".jpg,.jpeg,.png,.pdf" {{ $isWiraswasta ? 'required' : '' }}>
                                        
                                        <div class="properti-file-empty-box" onclick="document.getElementById('slip_gaji_wiraswasta').click()">
                                            <div class="empty-icon-circle">
                                                <i class="mdi mdi-cloud-upload"></i>
                                            </div>
                                            <div class="properti-file-info-modern">
                                                <span>Upload Laporan Keuangan 6 Bulan</span>
                                                <small class="text-muted">Format: PDF, JPG, PNG (Max 5MB)</small>
                                            </div>
                                        </div>

                                        <div class="properti-uploaded-box rounded-3 mb-1" style="display: none;">
                                            <div class="d-flex align-items-center justify-content-between gap-3 w-100">
                                                <div class="d-flex align-items-center gap-2.5 overflow-hidden flex-grow-1" style="min-width: 0;">
                                                    <div class="uploaded-icon-box">
                                                        <i class="mdi mdi-file-check-outline" style="font-size: 1.35rem;"></i>
                                                    </div>
                                                    <div class="overflow-hidden" style="min-width: 0;">
                                                        <span class="d-block fw-bold text-success text-truncate uploaded-doc-title" style="font-size: 0.88rem; line-height: 1.2;">Berkas Laporan Keuangan 6 Bulan Terunggah</span>
                                                        <small class="text-muted text-truncate d-block uploaded-doc-subtitle" style="font-size: 0.72rem; margin-top: 2px;"></small>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center flex-shrink-0" style="gap: 8px;">
                                                    <a href="#" target="_blank" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center btn-doc-lihat">
                                                        <i class="mdi mdi-eye" style="font-size: 0.95rem; line-height: 1;"></i>
                                                        <span>Lihat</span>
                                                    </a>
                                                    <button type="button" onclick="document.getElementById('slip_gaji_wiraswasta').click()" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center btn-doc-ganti">
                                                        <i class="mdi mdi-cloud-sync" style="font-size: 0.95rem; line-height: 1;"></i>
                                                        <span>Ganti</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <small class="text-muted mt-1 d-block" style="font-size: 0.72rem;">*Catatan pembukuan / omset / slip penghasilan 6 bulan terakhir</small>
                                </div>

                                <!-- 5. Rekening Koran 6 Bulan Terakhir -->
                                <div class="col-12 col-md-6 mb-2">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <label class="form-label-kpr mb-0" for="rekening_koran_wiraswasta">Rekening Koran 6 Bulan Terakhir <span class="req">*</span></label>
                                        <span class="badge bg-light text-primary border" style="font-size: 0.7rem;">Wajib</span>
                                    </div>
                                    <div class="properti-file-upload-modern" data-label="Rekening Koran 6 Bulan">
                                        <input type="file" id="rekening_koran_wiraswasta" name="rekening_koran_wiraswasta" class="properti-file-input d-none" accept=".jpg,.jpeg,.png,.pdf" {{ $isWiraswasta ? 'required' : '' }}>
                                        
                                        <div class="properti-file-empty-box" onclick="document.getElementById('rekening_koran_wiraswasta').click()">
                                            <div class="empty-icon-circle">
                                                <i class="mdi mdi-cloud-upload"></i>
                                            </div>
                                            <div class="properti-file-info-modern">
                                                <span>Upload Rekening Koran 6 Bulan</span>
                                                <small class="text-muted">Format: PDF, JPG, PNG (Max 5MB)</small>
                                            </div>
                                        </div>

                                        <div class="properti-uploaded-box rounded-3 mb-1" style="display: none;">
                                            <div class="d-flex align-items-center justify-content-between gap-3 w-100">
                                                <div class="d-flex align-items-center gap-2.5 overflow-hidden flex-grow-1" style="min-width: 0;">
                                                    <div class="uploaded-icon-box">
                                                        <i class="mdi mdi-file-check-outline" style="font-size: 1.35rem;"></i>
                                                    </div>
                                                    <div class="overflow-hidden" style="min-width: 0;">
                                                        <span class="d-block fw-bold text-success text-truncate uploaded-doc-title" style="font-size: 0.88rem; line-height: 1.2;">Berkas Rekening Koran 6 Bulan Terunggah</span>
                                                        <small class="text-muted text-truncate d-block uploaded-doc-subtitle" style="font-size: 0.72rem; margin-top: 2px;"></small>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center flex-shrink-0" style="gap: 8px;">
                                                    <a href="#" target="_blank" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center btn-doc-lihat">
                                                        <i class="mdi mdi-eye" style="font-size: 0.95rem; line-height: 1;"></i>
                                                        <span>Lihat</span>
                                                    </a>
                                                    <button type="button" onclick="document.getElementById('rekening_koran_wiraswasta').click()" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center btn-doc-ganti">
                                                        <i class="mdi mdi-cloud-sync" style="font-size: 0.95rem; line-height: 1;"></i>
                                                        <span>Ganti</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <small class="text-muted mt-1 d-block" style="font-size: 0.72rem;">*Rekening koran mutasi transaksi bisnis/usaha 6 bulan terakhir berstempel bank</small>
                                </div>

                                <!-- 6. Denah Tempat Kerja dan Foto Usaha -->
                                <div class="col-12 col-md-6 mb-2">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <label class="form-label-kpr mb-0" for="denah_tempat_kerja_wiraswasta">Denah Tempat Kerja & Foto Usaha <span class="req">*</span></label>
                                        <span class="badge bg-light text-primary border" style="font-size: 0.7rem;">Wajib</span>
                                    </div>
                                    <div class="properti-file-upload-modern" data-label="Denah & Foto Usaha">
                                        <input type="file" id="denah_tempat_kerja_wiraswasta" name="denah_tempat_kerja_wiraswasta" class="properti-file-input d-none" accept=".jpg,.jpeg,.png,.pdf" {{ $isWiraswasta ? 'required' : '' }}>
                                        
                                        <div class="properti-file-empty-box" onclick="document.getElementById('denah_tempat_kerja_wiraswasta').click()">
                                            <div class="empty-icon-circle">
                                                <i class="mdi mdi-cloud-upload"></i>
                                            </div>
                                            <div class="properti-file-info-modern">
                                                <span>Upload Denah & Foto Tempat Usaha</span>
                                                <small class="text-muted">Format: PDF, JPG, PNG (Max 5MB)</small>
                                            </div>
                                        </div>

                                        <div class="properti-uploaded-box rounded-3 mb-1" style="display: none;">
                                            <div class="d-flex align-items-center justify-content-between gap-3 w-100">
                                                <div class="d-flex align-items-center gap-2.5 overflow-hidden flex-grow-1" style="min-width: 0;">
                                                    <div class="uploaded-icon-box">
                                                        <i class="mdi mdi-file-check-outline" style="font-size: 1.35rem;"></i>
                                                    </div>
                                                    <div class="overflow-hidden" style="min-width: 0;">
                                                        <span class="d-block fw-bold text-success text-truncate uploaded-doc-title" style="font-size: 0.88rem; line-height: 1.2;">Berkas Denah & Foto Tempat Usaha Terunggah</span>
                                                        <small class="text-muted text-truncate d-block uploaded-doc-subtitle" style="font-size: 0.72rem; margin-top: 2px;"></small>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center flex-shrink-0" style="gap: 8px;">
                                                    <a href="#" target="_blank" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center btn-doc-lihat">
                                                        <i class="mdi mdi-eye" style="font-size: 0.95rem; line-height: 1;"></i>
                                                        <span>Lihat</span>
                                                    </a>
                                                    <button type="button" onclick="document.getElementById('denah_tempat_kerja_wiraswasta').click()" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center btn-doc-ganti">
                                                        <i class="mdi mdi-cloud-sync" style="font-size: 0.95rem; line-height: 1;"></i>
                                                        <span>Ganti</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <small class="text-muted mt-1 d-block" style="font-size: 0.72rem;">*Denah lokasi tempat usaha serta foto tempat usaha dan aktivitas bisnis</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ============================================== -->
                    <!-- 4. SUBSECTION: DOKUMEN TAMBAHAN DINAMIS        -->
                    <!-- ============================================== -->
                    <div class="doc-category-box">
                        <div class="doc-category-header">
                            <div>
                                <h6 class="fw-bold text-dark mb-1 d-flex align-items-center">
                                    <i class="mdi mdi-folder-plus-outline text-primary me-2" style="font-size: 1.15rem;"></i>
                                    Dokumen Pendukung Lainnya (Opsional / Dinamis)
                                </h6>
                                <small class="text-muted">Tambahkan berkas pendukung tambahan sesuai permintaan bank (misal: Rekening Listrik, PBB, Sertifikat Pendukung, dll)</small>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-primary fw-bold px-3 py-2" id="btnAddDynamicDoc" style="border-radius: 6px;">
                                <i class="fas fa-plus me-1"></i> Tambah Dokumen
                            </button>
                        </div>

                        <!-- Container Dynamic Rows -->
                        <div id="dynamicDocContainer" class="d-flex flex-column gap-3">
                            <!-- Dynamic rows will be inserted here -->
                        </div>
                    </div>

                    <!-- Tombol Action -->
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3 mt-4 pt-3 border-top">
                        <a href="{{ route('marketing.list_pengajuan') }}" class="btn px-4 py-2 fw-semibold text-muted border bg-white" style="border-radius: 6px; border-color: #cbd5e1 !important;">
                            <i class="mdi mdi-arrow-left me-1"></i>Kembali
                        </a>
                        <button type="submit" class="btn px-5 py-2 fw-bold text-white" style="border-radius: 6px; font-size: 0.95rem; background: #9a55ff !important; border: 1px solid #9a55ff !important;">
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

            // Dynamic Additional Documents
            let dynamicDocIndex = 0;
            const btnAddDynamicDoc = document.getElementById('btnAddDynamicDoc');
            const dynamicDocContainer = document.getElementById('dynamicDocContainer');

            if (btnAddDynamicDoc && dynamicDocContainer) {
                btnAddDynamicDoc.addEventListener('click', function() {
                    const rowId = `dynamic_doc_${dynamicDocIndex}`;
                    const rowHtml = `
                        <div class="card p-3 border shadow-none bg-light dynamic-doc-row" id="${rowId}" style="border-radius: 6px; border: 1px dashed #cbd5e1 !important;">
                            <div class="row g-2 align-items-center">
                                <div class="col-12 col-md-5">
                                    <label class="form-label-kpr small mb-1">Nama / Jenis Dokumen <span class="req">*</span></label>
                                    <input type="text" name="additional_documents[${dynamicDocIndex}][name]" class="form-control-kpr" placeholder="Contoh: SPT Tahunan / Rekening Listrik" required>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label-kpr small mb-1">Pilih File Berkas <span class="req">*</span></label>
                                    <input type="file" name="additional_documents[${dynamicDocIndex}][file]" class="form-control-kpr" accept=".jpg,.jpeg,.png,.pdf" required>
                                </div>
                                <div class="col-12 col-md-1 d-flex align-items-end justify-content-end">
                                    <button type="button" class="btn btn-outline-danger btn-sm p-2 w-100" onclick="removeDynamicDoc('${rowId}')" title="Hapus Dokumen" style="border-radius: 6px; height: 42px;">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;
                    dynamicDocContainer.insertAdjacentHTML('beforeend', rowHtml);
                    dynamicDocIndex++;
                });
            }

            function removeDynamicDoc(rowId) {
                const row = document.getElementById(rowId);
                if (row) {
                    row.remove();
                }
            }

            // File Upload Preview & Counter & Job Switcher
            document.addEventListener('DOMContentLoaded', function() {
                const counterElement = document.getElementById('uploadCounter');
                const btnTypeKaryawan = document.getElementById('btnTypeKaryawan');
                const btnTypeWiraswasta = document.getElementById('btnTypeWiraswasta');
                const sectionKaryawan = document.getElementById('sectionKaryawan');
                const sectionWiraswasta = document.getElementById('sectionWiraswasta');

                function updateCounter() {
                    if (!counterElement) return;
                    let uploadedCount = 0;
                    document.querySelectorAll('.properti-file-upload-modern').forEach(container => {
                        // Ignore hidden section
                        if (container.closest('#sectionKaryawan') && sectionKaryawan && sectionKaryawan.style.display === 'none') return;
                        if (container.closest('#sectionWiraswasta') && sectionWiraswasta && sectionWiraswasta.style.display === 'none') return;

                        const input = container.querySelector('input[type="file"]');
                        if ((input && input.files && input.files.length > 0) || container.classList.contains('has-existing-doc')) {
                            uploadedCount++;
                        }
                    });

                    counterElement.textContent = uploadedCount + ' Dokumen Terunggah';
                }

                function setJobType(type) {
                    if (type === 'karyawan') {
                        if (btnTypeKaryawan) btnTypeKaryawan.classList.add('active');
                        if (btnTypeWiraswasta) btnTypeWiraswasta.classList.remove('active');
                        if (sectionKaryawan) sectionKaryawan.style.display = 'block';
                        if (sectionWiraswasta) sectionWiraswasta.style.display = 'none';

                        // Set required for karyawan
                        $('#sectionKaryawan input[type="file"]').each(function() {
                            const isExisting = $(this).closest('.properti-file-upload-modern').hasClass('has-existing-doc');
                            if (!isExisting) $(this).attr('required', true);
                        });
                        $('#sectionWiraswasta input[type="file"]').removeAttr('required');
                    } else {
                        if (btnTypeWiraswasta) btnTypeWiraswasta.classList.add('active');
                        if (btnTypeKaryawan) btnTypeKaryawan.classList.remove('active');
                        if (sectionWiraswasta) sectionWiraswasta.style.display = 'block';
                        if (sectionKaryawan) sectionKaryawan.style.display = 'none';

                        // Set required for wiraswasta
                        $('#sectionWiraswasta input[type="file"]').each(function() {
                            const isExisting = $(this).closest('.properti-file-upload-modern').hasClass('has-existing-doc');
                            if (!isExisting) $(this).attr('required', true);
                        });
                        $('#sectionKaryawan input[type="file"]').removeAttr('required');
                    }
                    updateCounter();
                }

                if (btnTypeKaryawan && btnTypeWiraswasta) {
                    btnTypeKaryawan.addEventListener('click', () => setJobType('karyawan'));
                    btnTypeWiraswasta.addEventListener('click', () => setJobType('wiraswasta'));
                }

                // Delegated change listener for file input (Matching addkavling modal behavior)
                $(document).on('change', '.properti-file-upload-modern input[type="file"]', function(e) {
                    const file = e.target.files && e.target.files[0];
                    const container = this.closest('.properti-file-upload-modern');
                    if (!container) return;

                    const emptyBox = container.querySelector('.properti-file-empty-box');
                    const uploadedBox = container.querySelector('.properti-uploaded-box');
                    const titleEl = container.querySelector('.uploaded-doc-title');
                    const subtitleEl = container.querySelector('.uploaded-doc-subtitle');
                    const viewBtn = container.querySelector('.btn-doc-lihat');
                    const docLabel = container.dataset.label || 'Dokumen';

                    if (file) {
                        const fileUrl = URL.createObjectURL(file);
                        const sizeInMB = (file.size / (1024 * 1024)).toFixed(2);

                        if (titleEl) titleEl.textContent = `Berkas ${docLabel} Terunggah`;
                        if (subtitleEl) {
                            subtitleEl.textContent = `${file.name} (${sizeInMB} MB)`;
                        }
                        if (viewBtn) viewBtn.href = fileUrl;

                        const gantiBtn = container.querySelector('.btn-doc-ganti');
                        if (gantiBtn) gantiBtn.style.display = 'inline-flex';

                        if (emptyBox) emptyBox.style.display = 'none';
                        if (uploadedBox) uploadedBox.style.display = 'flex';
                        container.classList.remove('error');
                    }
                    updateCounter();
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

                function loadSkemaMasterData() {
                    const bankId = $('#bankSelect').val();
                    const tenor = $('#tenor').val();
                    const produkKpr = $('#produkSelect').val();
                    const skemaContent = $('#skemaContent');
                    const skemaBadge = $('#skemaBadge');

                    if (!bankId || !tenor) {
                        skemaContent.html(`
                            <div class="text-center py-4 text-muted" style="background: #fafafa; border-radius: 8px; border: 1px dashed #e2e8f0;">
                                <i class="mdi mdi-information-outline text-primary me-1" style="font-size: 1.25rem;"></i>
                                Silakan pilih Bank Tujuan dan Tenor Angsuran di atas untuk menampilkan rincian cicilan flat.
                            </div>
                        `);
                        skemaBadge.html('<i class="mdi mdi-database-sync me-1"></i> Menunggu Pilihan Bank');
                        skemaBadge.css({'color': '#9a55ff', 'background': 'rgba(154, 85, 255, 0.12)', 'border-color': 'rgba(154, 85, 255, 0.25)'});
                        if (angsuranInput) angsuranInput.value = '0';
                        return;
                    }

                    // Tampilkan loader
                    skemaContent.html(`
                        <div class="text-center py-4 text-muted">
                            <div class="spinner-border spinner-border-sm text-primary me-2" role="status"></div>
                            <span>Mengambil rincian skema angsuran master data...</span>
                        </div>
                    `);

                    $.ajax({
                        url: "{{ route('api.skema-kpr') }}",
                        type: 'GET',
                        data: {
                            bank_id: bankId,
                            tenor: tenor,
                            produk_kpr: produkKpr
                        },
                        dataType: 'json',
                        success: function(res) {
                            if (res.success && res.data && res.data.length > 0) {
                                const skemas = res.data;
                                let cardsHtml = '<div class="skema-grid">';
                                
                                skemas.forEach(function(item) {
                                    cardsHtml += `
                                        <div class="skema-card">
                                            <div class="tier-period">
                                                <i class="mdi mdi-calendar-clock"></i> ${item.periode_tahun}
                                            </div>
                                            <div class="tier-amount">
                                                Rp ${formatRupiah(item.angsuran_per_bulan)}
                                                <span>/bln</span>
                                            </div>
                                            <div class="tier-meta">
                                                <span><i class="mdi mdi-percent-outline text-primary"></i> Suku Bunga: <strong>${item.bunga}%</strong></span>
                                                <span class="badge bg-light text-success border">Flat</span>
                                            </div>
                                            ${item.keterangan ? `<small class="text-muted d-block mt-2" style="font-size: 0.72rem; line-height: 1.25;"><i class="mdi mdi-information me-1"></i>${item.keterangan}</small>` : ''}
                                        </div>
                                    `;
                                });
                                cardsHtml += '</div>';

                                skemaContent.html(cardsHtml);

                                // Sinkronkan nilai estimasi angsuran utama (dari periode pertama)
                                if (angsuranInput) {
                                    angsuranInput.value = skemas[0].angsuran_per_bulan;
                                }

                                // Sinkronkan bunga dengan skema jika ada input bunga
                                if (bungaInput && skemas[0].bunga) {
                                    bungaInput.value = skemas[0].bunga;
                                }

                                skemaBadge.html(`<i class="mdi mdi-check-circle text-success me-1"></i> ${skemas.length} Periode Master Ditemukan`);
                                skemaBadge.css({'color': '#10b981', 'background': 'rgba(16, 185, 129, 0.1)', 'border-color': 'rgba(16, 185, 129, 0.3)'});
                            } else {
                                // Jika belum ada di master data untuk kombinasi bank & tenor ini
                                skemaContent.html(`
                                    <div class="alert alert-warning d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-2 p-3" style="border-radius: 8px;">
                                        <div>
                                            <div class="fw-bold mb-1 text-dark"><i class="mdi mdi-alert-circle-outline text-warning me-1"></i> Master Skema Belum Dikonfigurasi</div>
                                            <small class="text-muted">Belum ada skema angsuran flat di Master Data untuk Bank ini dengan Tenor ${tenor} Tahun. Silakan tambahkan di Master Data atau masukkan nominal manual di bawah.</small>
                                        </div>
                                        <a href="{{ route('master.skema-kpr.index') }}" target="_blank" class="btn btn-sm btn-outline-warning text-nowrap">
                                            <i class="mdi mdi-plus me-1"></i> Atur Master Skema
                                        </a>
                                    </div>
                                    <div class="mt-3 p-3 bg-light rounded-3 border" style="max-width: 400px;">
                                        <label class="form-label-kpr text-dark mb-1"><i class="mdi mdi-cash text-primary me-1"></i>Input Angsuran Manual / Bulan (Fallback)</label>
                                        <div class="kpr-input-group">
                                            <span class="input-group-text fw-bold text-success">Rp</span>
                                            <input type="text" class="form-control-kpr fw-bold text-success" id="angsuranManualInput" placeholder="0">
                                        </div>
                                        <small class="text-muted" style="font-size: 0.72rem;">*Akan disimpan sebagai estimasi angsuran pengajuan</small>
                                    </div>
                                `);

                                skemaBadge.html('<i class="mdi mdi-alert-outline text-warning me-1"></i> Belum Ada di Master');
                                skemaBadge.css({'color': '#f59e0b', 'background': 'rgba(245, 158, 11, 0.1)', 'border-color': 'rgba(245, 158, 11, 0.3)'});

                                // Setup fallback manual input handler
                                $('#angsuranManualInput').on('input', function() {
                                    let val = this.value.replace(/[^0-9]/g, '');
                                    if (val) {
                                        this.value = formatRupiah(val);
                                        if (angsuranInput) angsuranInput.value = val;
                                    } else {
                                        this.value = '';
                                        if (angsuranInput) angsuranInput.value = '0';
                                    }
                                });
                            }
                        },
                        error: function() {
                            skemaContent.html(`
                                <div class="alert alert-danger py-2 px-3 mb-0" style="border-radius: 8px;">
                                    <small><i class="mdi mdi-close-circle-outline me-1"></i> Gagal memuat data skema angsuran dari server.</small>
                                </div>
                            `);
                            skemaBadge.html('<i class="mdi mdi-close-circle text-danger me-1"></i> Gagal Sinkron');
                            skemaBadge.css({'color': '#ef4444', 'background': 'rgba(239, 68, 68, 0.1)', 'border-color': 'rgba(239, 68, 68, 0.3)'});
                        }
                    });
                }

                if (dpInput) {
                    dpInput.addEventListener('input', function() {
                        let val = this.value.replace(/[^0-9]/g, '');
                        if (val) {
                            this.value = formatRupiah(val);
                        } else {
                            this.value = '';
                        }
                        hitungPinjaman();
                    });
                }

                $('#bankSelect, #produkSelect, #tenor').on('change', function() {
                    loadSkemaMasterData();
                });

                $('#promoSelect').on('change', function() {
                    hitungPinjaman();
                });

                hitungPinjaman();
                loadSkemaMasterData();
            });

            // Validasi Form Dokumen Pengajuan
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.querySelector('.pengajuan-form-sample');
                const sectionKaryawan = document.getElementById('sectionKaryawan');
                const sectionWiraswasta = document.getElementById('sectionWiraswasta');

                if (form) {
                    form.addEventListener('submit', function(e) {
                        let isValid = true;
                        let missingFields = [];

                        document.querySelectorAll('.properti-file-upload-modern').forEach(el => {
                            el.classList.remove('error');
                        });

                        document.querySelectorAll('.properti-file-upload-modern input[type="file"]').forEach(input => {
                            const container = input.closest('.properti-file-upload-modern');
                            if (!container) return;

                            // Abaikan field di section yang tersembunyi
                            if (container.closest('#sectionKaryawan') && sectionKaryawan && sectionKaryawan.style.display === 'none') return;
                            if (container.closest('#sectionWiraswasta') && sectionWiraswasta && sectionWiraswasta.style.display === 'none') return;

                            const isRequired = input.hasAttribute('required');
                            const hasExisting = container.classList.contains('has-existing-doc');
                            const hasFile = input.files && input.files.length > 0;

                            if (isRequired && !hasExisting && !hasFile) {
                                isValid = false;
                                const colBox = container.closest('.col-12');
                                const labelText = colBox?.querySelector('.form-label-kpr')?.childNodes[0]?.textContent?.trim() || input.name;
                                missingFields.push(labelText);
                                container.classList.add('error');
                            }
                        });

                        if (!isValid) {
                            e.preventDefault();
                            Swal.fire({
                                icon: 'warning',
                                title: 'Dokumen Belum Lengkap',
                                html: '<p class="mb-2">Harap lengkapi dokumen persyaratan wajib berikut:</p><div class="text-start p-2 bg-light rounded" style="max-height: 220px; overflow-y: auto;"><ol class="mb-0 ps-3">' +
                                    missingFields.map(f => `<li class="mb-1 fw-semibold text-dark">${f}</li>`).join('') + '</ol></div>'
                            });
                            return false;
                        }
                    });
                }
            });
        </script>
    @endpush
@endsection
