@extends('layouts.partial.app')

@section('title', 'Survey KPR - Properti Management')

@section('content')
    <style>
        .kpr-page .card {
            border: 1px solid #ebe7f2;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(29, 21, 44, 0.05);
            overflow: hidden;
        }

        .kpr-page .card-body {
            padding: 1.25rem;
        }

        .kpr-section-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.15rem;
            font-weight: 800;
            color: #2c2e3f;
            margin-bottom: 1rem;
        }

        .kpr-section-title i {
            color: #9a55ff;
        }

        /* HEADER CUSTOMER */
        .customer-header {
            min-height: 110px;
        }

        .customer-avatar {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: linear-gradient(135deg, #b57cff, #8f52ff);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 1.5rem;
            flex-shrink: 0;
            box-shadow: 0 8px 18px rgba(154, 85, 255, 0.20);
        }

        .customer-name {
            font-size: 2rem;
            font-weight: 700;
            color: #2c2e3f;
            line-height: 1.2;
        }

        .customer-booking {
            font-size: 1rem;
            color: #8c8c8c;
        }

        .customer-unit-info {
            display: grid;
            grid-template-columns: repeat(4, minmax(90px, auto));
            gap: 1.5rem;
            align-items: center;
        }

        .customer-unit-info .info-item small {
            display: block;
            font-size: 0.8rem;
            color: #9a9a9a;
            margin-bottom: 2px;
        }

        .customer-unit-info .info-item span {
            display: block;
            font-size: 1.05rem;
            font-weight: 600;
            color: #2c2e3f;
            line-height: 1.3;
        }

        .kpr-muted {
            color: #6c7383 !important;
        }

        .kpr-progress-top {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 0.5rem;
        }

        .kpr-progress-top span:last-child {
            color: #9a55ff;
            font-weight: 700;
        }

        .kpr-progress {
            width: 100%;
            height: 12px;
            background: #ece9f3;
            border-radius: 999px;
            overflow: hidden;
            margin-bottom: 1.25rem;
        }

        .kpr-progress-bar {
            height: 100%;
            border-radius: 999px;
            background: linear-gradient(90deg, #c184ff, #9a55ff);
        }

        .kpr-steps {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 12px;
        }

        .kpr-step {
            text-align: center;
            position: relative;
        }

        .kpr-step-icon {
            width: 42px;
            height: 42px;
            margin: 0 auto 0.6rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f0eef5;
            color: #9aa0ac;
            font-size: 18px;
            transition: all 0.25s ease;
        }

        .kpr-step.completed .kpr-step-icon {
            background: #28a745 !important;
            color: #fff;
        }

        .kpr-step.active .kpr-step-icon {
            background: #9a55ff !important;
            color: #fff;
            box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.2);
        }

        .kpr-step-title {
            display: block;
            font-size: 0.82rem;
            font-weight: 700;
            color: #2c2e3f;
        }

        .kpr-step small {
            display: block;
            color: #6c7383;
            font-size: 0.72rem;
            line-height: 1.35;
        }

        .kpr-detail-list {
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
        }

        .kpr-detail-item {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            align-items: flex-start;
        }

        .kpr-detail-item span:first-child {
            color: #6c7383;
        }

        .kpr-detail-item span:last-child {
            color: #2c2e3f;
            font-weight: 700;
            text-align: right;
        }

        .kpr-detail-item .highlight {
            color: #9a55ff !important;
        }

        .kpr-handler {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0.85rem;
            background: #fbf9fe;
            border: 1px solid #ebe7f2;
            border-radius: 14px;
        }

        .kpr-handler-icon {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #f4ecff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #9a55ff;
            flex-shrink: 0;
        }

        .kpr-inline-alert {
            border-radius: 14px;
            padding: 0.9rem 1rem;
            font-size: 0.88rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .kpr-inline-alert i {
            font-size: 1rem;
            margin-top: 2px;
        }

        .kpr-inline-alert.info {
            background: #f6f7fb;
            border-color: #e7eaf3;
            color: #4b5565;
        }

        .kpr-inline-alert.warning {
            background: #fff8e6;
            border-color: #ffe29b;
            color: #8a6a00;
        }

        .kpr-inline-alert.success {
            background: #edf9f3;
            border-color: #b9e7cf;
            color: #146c43;
        }

        .kpr-inline-alert.danger {
            background: #fff1f3;
            border-color: #ffc9d0;
            color: #b42318;
        }

        .kpr-summary-stack {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 1rem;
        }

        .kpr-summary-box {
            border: 1px solid #ebe7f2;
            background: #fbf9fe;
            border-radius: 16px;
            padding: 1rem;
            width: 100%;
        }

        .kpr-summary-box .label {
            font-size: 0.75rem;
            color: #6c7383;
            margin-bottom: 0.35rem;
        }

        .kpr-summary-box .value {
            font-size: 1.2rem;
            font-weight: 800;
            line-height: 1.4;
            word-break: break-word;
        }

        .kpr-summary-box.success .value {
            color: #22a06b;
        }

        .kpr-summary-box.warning .value {
            color: #f59f00;
        }

        .kpr-status-banner {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 0.55rem 0.9rem;
            border-radius: 999px;
            font-size: 0.86rem;
            font-weight: 700;
        }

        .kpr-status-banner.success {
            background: #edf9f3;
            color: #22a06b;
        }

        .kpr-status-banner.warning {
            background: #fff8e6;
            color: #8a6a00;
        }

        .kpr-sidebar-section {
            border: 1px solid #ebe7f2;
            border-radius: 16px;
            padding: 1rem;
            background: #fff;
        }

        .kpr-sidebar-section + .kpr-sidebar-section {
            margin-top: 1rem;
        }

        .kpr-sidebar-title {
            font-size: 0.95rem;
            font-weight: 800;
            color: #2c2e3f;
            margin-bottom: 0.75rem;
        }

        .kpr-mini-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .kpr-mini-list li {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            font-size: 0.84rem;
            color: #6c7383;
            margin-bottom: 0.55rem;
        }

        .kpr-mini-list li i {
            color: #9a55ff;
            margin-top: 2px;
        }

        .kpr-sticky {
            position: sticky;
            top: 20px;
        }

        /* FORM SURVEY */
        .survey-form-group {
            margin-bottom: 1rem;
        }

        .survey-form-group label {
            font-size: 0.82rem;
            font-weight: 700;
            color: #2c2e3f;
            margin-bottom: 0.4rem;
            display: block;
        }

        .survey-form-control {
            border: 1px solid #e9ecef;
            border-radius: 12px;
            padding: 0.78rem 0.9rem;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            background-color: #ffffff;
            color: #2c2e3f;
            width: 100%;
        }

        .survey-form-control:focus {
            border-color: #9a55ff;
            box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.1);
            outline: none;
        }

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
            padding: 0.78rem 0.85rem;
            font-size: 0.85rem;
            color: #6c7383;
            background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
            border: 1px solid #e9ecef;
            border-radius: 12px 0 0 12px;
            border-right: none;
        }

        .survey-input-group .survey-form-control {
            border-radius: 0 12px 12px 0;
        }

        .survey-input-group.satuan-kiri .survey-input-group-prepend .survey-input-group-text {
            border-radius: 12px 0 0 12px;
            border-right: none;
        }

        .survey-input-group.satuan-kiri .survey-form-control {
            border-radius: 0 12px 12px 0;
        }

        /* Upload lama */
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

        .survey-checklist-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .survey-checkbox-wrapper {
            position: relative;
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
            padding: 0.9rem 1rem;
            background: linear-gradient(135deg, #f9f7ff, #f2ecff);
            border: 2px solid rgba(154, 85, 255, 0.2);
            border-radius: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.08);
            min-height: 64px;
        }

        .survey-checkbox-label::before {
            content: '';
            position: absolute;
            inset: 0;
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
            font-size: 1.45rem;
            color: #d0d4db;
            transition: all 0.3s ease;
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
            transform: scale(1.08);
        }

        .survey-checkbox-input:checked + .survey-checkbox-label .survey-check-text {
            color: #9a55ff;
            font-weight: 700;
        }

        .survey-check-text {
            font-size: 0.9rem;
            color: #2c2e3f;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .survey-btn {
            font-size: 0.88rem;
            padding: 0.85rem 1.2rem;
            border-radius: 12px;
            font-weight: 700;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            cursor: pointer;
            border: none;
            width: 100%;
            text-align: center;
            gap: 8px;
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
            color: #fff;
        }

        @media (max-width: 991.98px) {
            .kpr-sticky {
                position: static;
            }
        }

        @media (max-width: 767.98px) {
            .customer-header {
                min-height: auto;
            }

            .customer-avatar {
                width: 48px;
                height: 48px;
                font-size: 1.1rem;
            }

            .customer-name {
                font-size: 1.25rem;
            }

            .customer-booking {
                font-size: 0.9rem;
            }

            .customer-unit-info {
                width: 100%;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 1rem;
                margin-top: 0.5rem;
            }

            .kpr-steps,
            .survey-checklist-grid {
                grid-template-columns: 1fr;
            }

            .kpr-step small {
                display: none !important;
            }

            .kpr-step-icon {
                width: 32px !important;
                height: 32px !important;
            }

            .kpr-step-icon i {
                font-size: 15px !important;
            }
        }
    </style>

    <div class="kpr-page">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="customer-header d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="customer-avatar">
                                    {{ strtoupper(substr($application->customer->full_name ?? 'C', 0, 1)) }}
                                </div>
                                <div>
                                    <h4 class="customer-name mb-1">{{ $application->customer->full_name ?? '-' }}</h4>
                                    <p class="customer-booking mb-0">
                                        Booking ID: {{ optional($application->unit->activeBooking)->booking_code ?? '-' }}
                                    </p>
                                </div>
                            </div>

                            <div class="customer-unit-info">
                                <div class="info-item">
                                    <small>Unit</small>
                                    <span>{{ $application->unit->unit_name ?? '-' }}</span>
                                </div>
                                <div class="info-item">
                                    <small>Jenis Unit</small>
                                    <span>{{ $application->unit->jenis ?? '-' }}</span>
                                </div>
                                <div class="info-item">
                                    <small>Blok/No</small>
                                    <span>{{ $application->unit->unit_code ?? '-' }}</span>
                                </div>
                                <div class="info-item">
                                    <small>Harga Unit</small>
                                    <span class="text-primary fw-bold">
                                        Rp {{ number_format($application->unit->price ?? 0, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if (session('error'))
            <div class="row mt-3">
                <div class="col-12">
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                </div>
            </div>
        @endif

        <div class="row mt-4">
            <div class="col-12 col-lg-8 mb-4 mb-lg-0">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="kpr-section-title">
                            <i class="mdi mdi-timeline-text"></i>
                            <span>Tahapan Survey KPR</span>
                        </div>

                        <div class="kpr-progress-top">
                            <span class="kpr-muted">Progress Survey</span>
                            <span>Tahap 4 dari 5</span>
                        </div>

                        <div class="kpr-progress">
                            <div class="kpr-progress-bar" style="width: 70%;"></div>
                        </div>

                        <div class="kpr-steps">
                            <div class="kpr-step completed">
                                <div class="kpr-step-icon">
                                    <i class="mdi mdi-check"></i>
                                </div>
                                <span class="kpr-step-title">Pengajuan</span>
                                <small>{{ \Carbon\Carbon::parse($application->created_at)->translatedFormat('j F Y') }}</small>
                            </div>

                            <div class="kpr-step completed">
                                <div class="kpr-step-icon">
                                    <i class="mdi mdi-check"></i>
                                </div>
                                <span class="kpr-step-title">Verifikasi</span>
                                <small>
                                    {{ $application->submitted_at ? \Carbon\Carbon::parse($application->submitted_at)->translatedFormat('j F Y') : '-' }}
                                </small>
                            </div>

                            <div class="kpr-step completed">
                                <div class="kpr-step-icon">
                                    <i class="mdi mdi-check"></i>
                                </div>
                                <span class="kpr-step-title">Akad</span>
                                <small>
                                    {{ $application->akad_at ? \Carbon\Carbon::parse($application->akad_at)->translatedFormat('j F Y') : '-' }}
                                </small>
                            </div>

                            <div class="kpr-step active">
                                <div class="kpr-step-icon">
                                    <i class="mdi mdi-home-search-outline"></i>
                                </div>
                                <span class="kpr-step-title">Survey</span>
                                <small>Progress</small>
                            </div>

                            <div class="kpr-step">
                                <div class="kpr-step-icon">
                                    <i class="mdi mdi-cash-fast"></i>
                                </div>
                                <span class="kpr-step-title">Cair</span>
                                <small>Menunggu</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="kpr-section-title">
                            <i class="mdi mdi-bank-outline"></i>
                            <span>Detail KPR</span>
                        </div>

                        <div class="kpr-detail-list">
                            <div class="kpr-detail-item">
                                <span>Bank Tujuan</span>
                                <span>{{ $application->bank->bank_name ?? '-' }}</span>
                            </div>
                            <div class="kpr-detail-item">
                                <span>Jumlah Pinjaman</span>
                                <span>Rp {{ number_format($application->jumlah_pinjaman ?? 0, 0, ',', '.') }}</span>
                            </div>
                            <div class="kpr-detail-item">
                                <span>Tenor</span>
                                <span>{{ $application->tenor ?? '-' }} Tahun</span>
                            </div>
                            <div class="kpr-detail-item">
                                <span>Angsuran / bln</span>
                                <span class="highlight">Rp {{ number_format($application->estimasi_angsuran ?? 0, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <hr class="my-4">

                        <small class="kpr-muted d-block mb-2">Ditangani oleh</small>
                        <div class="kpr-handler">
                            <div class="kpr-handler-icon">
                                <i class="mdi mdi-account-tie"></i>
                            </div>
                            <div>
                                <div class="fw-bold">{{ $application->booking->sales->name ?? '-' }}</div>
                                {{-- <small class="kpr-muted">{{ $application->booking->sales->phone ?? '-' }}</small> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12 col-lg-8 mb-4 mb-lg-0">
                <form action="{{ route('kpr.survey.store', $application->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="kpr-section-title">
                                <i class="mdi mdi-home-map-marker"></i>
                                <span>Form Survey Lapangan</span>
                            </div>

                            <div class="kpr-inline-alert info">
                                <i class="mdi mdi-information-outline"></i>
                                <div>Isi hasil survey unit dengan lengkap. Data ini akan digunakan bank untuk penilaian.</div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="survey-form-group">
                                        <label>Tanggal Survey</label>
                                        <input type="date" class="survey-form-control" name="survey_date"
                                            value="{{ $application->survey_date?->format('Y-m-d') ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="survey-form-group">
                                        <label>Jam Survey</label>
                                        <input type="time" class="survey-form-control" name="survey_time"
                                            value="{{ $application->survey_time?->format('H:i') ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="survey-form-group">
                                        <label>Surveyor</label>
                                        <select class="survey-form-control" name="surveyor_id">
                                            <option value="">Pilih Surveyor</option>
                                            @foreach ($surveyors as $surveyor)
                                                <option value="{{ $surveyor->id }}"
                                                    {{ $application->surveyor_id == $surveyor->id ? 'selected' : '' }}>
                                                    {{ $surveyor->name }} ({{ $surveyor->role }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="kpr-section-title mb-3">
                                <i class="mdi mdi-home-city-outline"></i>
                                <span>Hasil Penilaian Unit</span>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="survey-form-group">
                                        <label>Nilai Pasar Unit <span class="text-danger">*</span></label>
                                        <div class="survey-input-group">
                                            <div class="survey-input-group-prepend">
                                                <span class="survey-input-group-text">Rp</span>
                                            </div>
                                            <input type="text" class="survey-form-control" name="harga_unit"
                                                value="{{ number_format($application->harga_unit ?? 0, 0, ',', '.') }}">
                                        </div>
                                        <small class="kpr-muted">Sesuai harga jual unit</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="survey-form-group">
                                        <label>Nilai Appraisal <span class="text-danger">*</span></label>
                                        <div class="survey-input-group">
                                            <div class="survey-input-group-prepend">
                                                <span class="survey-input-group-text">Rp</span>
                                            </div>
                                            <input type="text" class="survey-form-control" name="appraisal_value"
                                                value="{{ number_format($application->jumlah_pinjaman ?? 0, 0, ',', '.') }}">
                                        </div>
                                        <small class="kpr-muted">Penilaian dari surveyor</small>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="survey-form-group">
                                        <label>Luas Tanah</label>
                                        <div class="survey-input-group satuan-kiri">
                                            <div class="survey-input-group-prepend">
                                                <span class="survey-input-group-text">m²</span>
                                            </div>
                                            <input type="text" class="survey-form-control" name="luas_tanah"
                                                value="{{ $application->unit->area ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="survey-form-group">
                                        <label>Luas Bangunan</label>
                                        <div class="survey-input-group satuan-kiri">
                                            <div class="survey-input-group-prepend">
                                                <span class="survey-input-group-text">m²</span>
                                            </div>
                                            <input type="text" class="survey-form-control" name="luas_bangunan"
                                                value="{{ $application->unit->building_area ?? '' }}">
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
                                            @foreach (['Baru (0-2 tahun)', 'Baik (2-5 tahun)', 'Cukup (5-10 tahun)', 'Perlu Renovasi'] as $kondisi)
                                                <option value="{{ $kondisi }}" {{ $application->kondisi_bangunan == $kondisi ? 'selected' : '' }}>
                                                    {{ $kondisi }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="kpr-section-title mb-3">
                                <i class="mdi mdi-checkbox-marked-outline"></i>
                                <span>Checklist Kondisi Unit</span>
                            </div>

                            <div class="survey-checklist-grid">
                                @foreach ([
                                    'listrik' => 'Instalasi Listrik',
                                    'air' => 'PDAM / Air Bersih',
                                    'akses' => 'Akses Jalan',
                                    'sertifikat' => 'Sertifikat Sesuai',
                                    'shm' => 'SHM / SHGB',
                                    'imb' => 'IMB',
                                ] as $field => $label)
                                    <div class="survey-checkbox-wrapper">
                                        <input type="checkbox" class="survey-checkbox-input" id="{{ $field }}" name="{{ $field }}"
                                            {{ $application->$field ? 'checked' : '' }}>
                                        <label class="survey-checkbox-label" for="{{ $field }}">
                                            <i class="mdi mdi-check-circle survey-check-icon"></i>
                                            <span class="survey-check-text">{{ $label }}</span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <hr class="my-4">

                            <div class="kpr-section-title mb-3">
                                <i class="mdi mdi-camera-outline"></i>
                                <span>Dokumentasi Survey</span>
                            </div>

                            <div class="row">
                                @foreach ([
                                    'foto_depan' => 'Foto Tampak Depan',
                                    'foto_interior' => 'Foto Interior',
                                    'foto_lingkungan' => 'Foto Lingkungan',
                                ] as $field => $label)
                                    <div class="col-md-4">
                                        <div class="survey-form-group">
                                            <label>{{ $label }}</label>
                                            <div class="verifikasi-file-upload">
                                                <input type="file" name="{{ $field }}" accept=".jpg,.jpeg,.png">
                                                <div class="verifikasi-file-label">
                                                    <i class="mdi mdi-camera"></i>
                                                    <div class="verifikasi-file-info">
                                                        <span>Upload Foto</span>
                                                        <small>Format: JPG, PNG (Max 5MB)</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <hr class="my-4">

                            <div class="kpr-section-title mb-3">
                                <i class="mdi mdi-note-text-outline"></i>
                                <span>Catatan Survey</span>
                            </div>

                            <div class="survey-form-group">
                                <textarea class="survey-form-control" name="catatan_survey" rows="4"
                                    placeholder="Contoh: Lokasi strategis dekat jalan raya">{{ $application->catatan_survey ?? '' }}</textarea>
                            </div>

                            <hr class="my-4">

                            <div class="kpr-section-title mb-3">
                                <i class="mdi mdi-clipboard-check-outline"></i>
                                <span>Rekomendasi</span>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="survey-form-group">
                                        <label>Status Rekomendasi</label>
                                        <select class="survey-form-control" name="rekomendasi">
                                            <option value="">Pilih Rekomendasi</option>
                                            @foreach (['Layak - Sesuai Harga', 'Layak - Dengan Penyesuaian Harga', 'Tidak Layak', 'Perlu Survey Ulang'] as $rec)
                                                <option value="{{ $rec }}" {{ $application->rekomendasi == $rec ? 'selected' : '' }}>
                                                    {{ $rec }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="survey-form-group">
                                        <label>Persentase Kelayakan</label>
                                        <div class="survey-input-group satuan-kiri">
                                            <div class="survey-input-group-prepend">
                                                <span class="survey-input-group-text">%</span>
                                            </div>
                                            <input type="text" class="survey-form-control" name="persentase_kelayakan"
                                                value="{{ $application->persentase_kelayakan ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <button type="submit" class="survey-btn survey-btn-success">
                                <i class="mdi mdi-content-save-outline"></i>
                                Simpan Hasil Survey
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-12 col-lg-4">
                <div class="kpr-sticky">
                    <div class="card">
                        <div class="card-body">
                            <div class="kpr-section-title">
                                <i class="mdi mdi-clipboard-text-outline"></i>
                                <span>Ringkasan Survey</span>
                            </div>

                            <div class="mb-3">
                                @if ($application->rekomendasi)
                                    <div class="kpr-status-banner success">
                                        <i class="mdi mdi-check-circle-outline"></i>
                                        Survey Sudah Diisi
                                    </div>
                                @else
                                    <div class="kpr-status-banner warning">
                                        <i class="mdi mdi-progress-clock"></i>
                                        Menunggu Hasil Survey
                                    </div>
                                @endif
                            </div>

                            <div class="kpr-summary-stack">
                                <div class="kpr-summary-box success">
                                    <div class="label">Nilai Appraisal</div>
                                    <div class="value">
                                        Rp {{ number_format($application->jumlah_pinjaman ?? 0, 0, ',', '.') }}
                                    </div>
                                </div>

                                <div class="kpr-summary-box warning">
                                    <div class="label">Kelayakan</div>
                                    <div class="value">
                                        {{ $application->persentase_kelayakan ? $application->persentase_kelayakan . '%' : '-' }}
                                    </div>
                                </div>
                            </div>

                            <div class="kpr-sidebar-section">
                                <div class="kpr-sidebar-title">Rekomendasi Saat Ini</div>
                                @if ($application->rekomendasi)
                                    <div class="kpr-inline-alert success mb-0">
                                        <i class="mdi mdi-check-decagram-outline"></i>
                                        <div>{{ $application->rekomendasi }}</div>
                                    </div>
                                @else
                                    <div class="kpr-inline-alert warning mb-0">
                                        <i class="mdi mdi-file-alert-outline"></i>
                                        <div>Belum ada rekomendasi survey yang disimpan.</div>
                                    </div>
                                @endif
                            </div>

                            <div class="kpr-sidebar-section">
                                <div class="kpr-sidebar-title">Checklist Survey</div>
                                <ul class="kpr-mini-list mb-0">
                                    <li>
                                        <i class="mdi mdi-check-circle-outline"></i>
                                        <span>Pastikan jadwal dan surveyor sudah terisi.</span>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-check-circle-outline"></i>
                                        <span>Masukkan nilai pasar dan appraisal unit dengan benar.</span>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-check-circle-outline"></i>
                                        <span>Lengkapi checklist kondisi unit dan unggah dokumentasi.</span>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-check-circle-outline"></i>
                                        <span>Simpan rekomendasi akhir survey untuk proses berikutnya.</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="kpr-sidebar-section">
                                <div class="kpr-sidebar-title">Catatan Saat Ini</div>
                                @if ($application->catatan_survey)
                                    <div class="kpr-inline-alert info mb-0">
                                        <i class="mdi mdi-note-text-outline"></i>
                                        <div>{{ $application->catatan_survey }}</div>
                                    </div>
                                @else
                                    <div class="kpr-inline-alert info mb-0">
                                        <i class="mdi mdi-note-plus-outline"></i>
                                        <div>Belum ada catatan survey yang dicatat.</div>
                                    </div>
                                @endif
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

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileInputs = document.querySelectorAll('.verifikasi-file-upload input[type="file"]');

            fileInputs.forEach(input => {
                input.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    const container = this.closest('.verifikasi-file-upload');
                    const title = container.querySelector('.verifikasi-file-info span');
                    const small = container.querySelector('.verifikasi-file-info small');

                    if (file) {
                        const sizeInMB = (file.size / (1024 * 1024)).toFixed(2);
                        title.textContent = file.name.length > 30 ? file.name.substring(0, 30) + '...' : file.name;
                        small.textContent = sizeInMB + ' MB';
                    } else {
                        title.textContent = 'Upload Foto';
                        small.textContent = 'Format: JPG, PNG (Max 5MB)';
                    }
                });
            });
        });
    </script>
@endpush
