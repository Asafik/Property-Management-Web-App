@extends('layouts.partial.app')

@section('title', 'Konfirmasi Persetujuan KPR - Properti Management')

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
            color: #ffc107;
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
            background: linear-gradient(90deg, #ffc107, #ffdb6d);
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
            background: #ffc107 !important;
            color: #fff;
            box-shadow: 0 0 0 3px rgba(255, 193, 7, 0.2);
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
            color: #ffc107 !important;
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

        .kpr-decision-card {
            position: relative;
            cursor: pointer;
        }

        .kpr-decision-card input[type="radio"] {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .kpr-decision-label {
            border: 2px solid #ebe7f2;
            border-radius: 18px;
            padding: 1rem;
            cursor: pointer;
            background: #fff;
            transition: all 0.25s ease;
            height: 100%;
            display: flex;
            gap: 12px;
            align-items: flex-start;
        }

        .kpr-decision-label:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(43, 31, 73, 0.07);
        }

        .kpr-decision-card.approve input[type="radio"]:checked+.kpr-decision-label {
            border-color: #7bd3a6;
            background: #edf9f3;
        }

        .kpr-decision-card.reject input[type="radio"]:checked+.kpr-decision-label {
            border-color: #f3a7b2;
            background: #fff1f3;
        }

        .kpr-decision-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 22px;
        }

        .kpr-decision-card.approve .kpr-decision-icon {
            background: #d9f3e6;
            color: #22a06b;
        }

        .kpr-decision-card.reject .kpr-decision-icon {
            background: #ffe2e8;
            color: #dc3545;
        }

        .kpr-decision-content {
            flex: 1;
        }

        .kpr-decision-title {
            font-size: 1rem;
            font-weight: 800;
            color: #2c2e3f;
            margin-bottom: 0.15rem;
        }

        .kpr-decision-desc {
            font-size: 0.82rem;
            color: #6c7383;
            margin-bottom: 0;
        }

        .kpr-decision-check {
            color: #c6ccd8;
            font-size: 1.2rem;
            margin-top: 2px;
        }

        .kpr-decision-card input[type="radio"]:checked+.kpr-decision-label .kpr-decision-check {
            color: #9a55ff;
        }

        .kpr-form-shell {
            margin-top: 1rem;
            border-radius: 18px;
            border: 1px solid #ebe7f2;
            padding: 1rem;
            background: #fff;
            display: none;
        }

        .kpr-form-shell.approve {
            background: linear-gradient(180deg, #fbfffd, #ffffff);
            border-color: #cfe9da;
        }

        .kpr-form-shell.reject {
            background: linear-gradient(180deg, #fffafb, #ffffff);
            border-color: #ffd7de;
        }

        .kpr-form-title {
            font-size: 1rem;
            font-weight: 800;
            margin-bottom: 0.9rem;
        }

        .kpr-form-title.approve {
            color: #22a06b;
        }

        .kpr-form-title.reject {
            color: #dc3545;
        }

        .kpr-form-group {
            margin-bottom: 1rem;
        }

        .kpr-form-label {
            display: block;
            font-size: 0.86rem;
            font-weight: 700;
            color: #2c2e3f;
            margin-bottom: 0.45rem;
        }

        .kpr-form-control {
            width: 100%;
            border: 1px solid #e6e8ef;
            border-radius: 14px;
            padding: 0.85rem 0.95rem;
            font-size: 0.9rem;
            color: #2c2e3f;
            transition: all 0.2s ease;
            background: #fff;
        }

        .kpr-form-control:focus {
            border-color: #c6a6ff;
            box-shadow: 0 0 0 4px rgba(154, 85, 255, 0.1);
            outline: none;
        }

        select.kpr-form-control {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%236c7383' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1em;
        }

        .kpr-input-group {
            display: flex;
            align-items: stretch;
        }

        .kpr-input-group-prepend {
            display: flex;
        }

        .kpr-input-group-text {
            display: flex;
            align-items: center;
            padding: 0.85rem 0.95rem;
            background: #f8f9fc;
            border: 1px solid #e6e8ef;
            border-radius: 14px 0 0 14px;
            color: #6c7383;
            font-weight: 500;
        }

        .kpr-input-group .kpr-form-control {
            border-radius: 0 14px 14px 0;
            border-left: none;
        }

        .kpr-input-group-append {
            display: flex;
        }

        .kpr-input-group.append .kpr-form-control {
            border-radius: 14px 0 0 14px;
            border-left: 1px solid #e6e8ef;
            border-right: none;
        }

        .kpr-input-group.append .kpr-input-group-text {
            border-radius: 0 14px 14px 0;
            border-left: none;
        }

        .kpr-btn.justify-content-center {
            justify-content: center !important;
        }

        .kpr-file-upload {
            position: relative;
            width: 100%;
        }

        .kpr-file-upload input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
            z-index: 2;
        }

        .kpr-file-label {
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
            .kpr-file-label {
                flex-direction: row;
                text-align: left;
                gap: 8px;
                padding: 0.75rem 1rem;
                min-height: auto;
            }
        }

        .kpr-file-upload:hover .kpr-file-label {
            border-color: #9a55ff;
            background: linear-gradient(135deg, #f1f0ff, #f8f9fa);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(154, 85, 255, 0.1);
        }

        .kpr-file-upload .kpr-file-label i {
            font-size: 1.6rem;
            color: #9a55ff;
            background: rgba(154, 85, 255, 0.1);
            padding: 8px;
            border-radius: 50%;
        }

        .kpr-file-info {
            flex: 1;
            width: 100%;
        }

        .kpr-file-info span {
            display: block;
            font-weight: 600;
            color: #2c2e3f;
            font-size: 0.8rem;
            word-break: break-word;
        }

        .kpr-file-info small {
            color: #6c7383;
            font-size: 0.65rem;
            display: block;
            margin-top: 2px;
        }

        .kpr-sidebar-section {
            border: 1px solid #ebe7f2;
            border-radius: 16px;
            padding: 1rem;
            background: #fff;
        }

        .kpr-sidebar-section+.kpr-sidebar-section {
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

        .kpr-action-bar {
            margin-top: 1.25rem;
            display: flex;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }

        .kpr-btn {
            border: none;
            border-radius: 12px;
            font-size: 0.9rem;
            font-weight: 700;
            padding: 0.82rem 1.2rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.25s ease;
            cursor: pointer;
        }

        .kpr-btn:hover {
            transform: translateY(-1px);
            text-decoration: none;
        }

        .kpr-btn-primary {
            background: linear-gradient(90deg, #c784ff, #9a55ff);
            color: #fff;
            box-shadow: 0 8px 18px rgba(154, 85, 255, 0.22);
        }

        .kpr-btn-primary:hover {
            color: #fff;
            box-shadow: 0 12px 24px rgba(154, 85, 255, 0.28);
        }

        .kpr-btn-secondary {
            background: #fff;
            color: #2c2e3f;
            border: 1px solid #ebe7f2;
        }

        .kpr-btn-secondary:hover {
            border-color: #cab0ff;
            color: #7f3df0;
            background: #faf7ff;
        }

        .kpr-error-box {
            display: none;
            margin-top: 1rem;
        }

        .kpr-sticky {
            position: sticky;
            top: 20px;
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

        .kpr-status-banner.warning {
            background: #fff8e6;
            color: #8a6a00;
        }

        .kpr-status-banner.success {
            background: #edf9f3;
            color: #22a06b;
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

            .kpr-steps {
                grid-template-columns: 1fr;
            }

            .kpr-action-bar {
                flex-direction: column-reverse;
            }

            .kpr-btn {
                justify-content: center;
                width: 100%;
            }
        }
    </style>

    <div class="kpr-page">
        <!-- Header Customer -->
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
                                    <p class="customer-booking mb-0">Booking ID: {{ optional($application->unit->activeBooking)->booking_code ?? '-' }}</p>
                                </div>
                            </div>

                            <div class="customer-unit-info">
                                <div class="info-item">
                                    <small>Unit - Type</small>
                                    <span>{{ $application->unit->unit_name ?? '-' }} - {{ $application->unit->type ?? '-' }}</span>
                                </div>
                                <div class="info-item">
                                    <small>Blok/No</small>
                                    <span>{{ $application->unit->unit_code ?? '-' }}</span>
                                </div>
                                <div class="info-item">
                                    <small>Jenis Unit</small>
                                    <span>{{ $application->unit->jenis ?? '-' }}</span>
                                </div>
                                <div class="info-item">
                                    <small>Harga Unit</small>
                                    <span class="text-primary fw-bold">Rp {{ number_format($application->unit->price ?? 0, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Progress Steps & Detail KPR -->
        <div class="row mt-4">
            <div class="col-12 col-lg-8 mb-4 mb-lg-0">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="kpr-section-title">
                            <i class="mdi mdi-timeline-text"></i>
                            <span>Tahapan Konfirmasi KPR</span>
                        </div>

                        <div class="kpr-progress-top">
                            <span class="kpr-muted">Progress Konfirmasi</span>
                            <span>Tahap 3 dari 5 (Proses Akad)</span>
                        </div>

                        <div class="kpr-progress">
                            <div class="kpr-progress-bar" style="width: 60%;"></div>
                        </div>

                        <div class="kpr-steps">
                            <!-- Step 1: Pengajuan - COMPLETED -->
                            <div class="kpr-step completed">
                                <div class="kpr-step-icon">
                                    <i class="mdi mdi-check"></i>
                                </div>
                                <span class="kpr-step-title">Pengajuan</span>
                                <small>{{ \Carbon\Carbon::parse($application->submitted_at ?? now())->translatedFormat('j F Y') }}</small>
                            </div>

                            <!-- Step 2: Verifikasi - COMPLETED -->
                            <div class="kpr-step completed">
                                <div class="kpr-step-icon">
                                    <i class="mdi mdi-check"></i>
                                </div>
                                <span class="kpr-step-title">Verifikasi</span>
                                <small>{{ \Carbon\Carbon::parse($application->created_at ?? now())->translatedFormat('j F Y') }}</small>
                            </div>

                            <!-- Step 3: Akad - ACTIVE -->
                            <div class="kpr-step active">
                                <div class="kpr-step-icon">
                                    <i class="mdi mdi-handshake-outline"></i>
                                </div>
                                <span class="kpr-step-title">Akad</span>
                                <small>Sedang diproses</small>
                            </div>

                            <!-- Step 4: Survey - PENDING -->
                            <div class="kpr-step">
                                <div class="kpr-step-icon">
                                    <i class="mdi mdi-home-search-outline"></i>
                                </div>
                                <span class="kpr-step-title">Survey</span>
                                <small>Menunggu</small>
                            </div>

                            <!-- Step 5: Serah Terima - PENDING -->
                            <div class="kpr-step">
                                <div class="kpr-step-icon">
                                    <i class="mdi mdi-key-variant"></i>
                                </div>
                                <span class="kpr-step-title">Serah Terima</span>
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
                            <span>Detail Pengajuan KPR</span>
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
                                <div class="fw-bold">{{ optional(optional($application->unit)->activeBooking)->sales->name ?? '-' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Konfirmasi & Sidebar -->
        <div class="row mt-4">
            <div class="col-12 col-lg-8 mb-4 mb-lg-0">
                <div class="card">
                    <div class="card-body">
                        <div class="kpr-section-title">
                            <i class="mdi mdi-shield-check-outline"></i>
                            <span>Konfirmasi Persetujuan KPR</span>
                        </div>

                        @if (session('success'))
                            <div class="kpr-inline-alert success">
                                <i class="mdi mdi-check-circle-outline"></i>
                                <div>{{ session('success') }}</div>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="kpr-inline-alert danger">
                                <i class="mdi mdi-alert-circle-outline"></i>
                                <div>{{ session('error') }}</div>
                            </div>
                        @endif

                        <div class="kpr-inline-alert info mb-4">
                            <i class="mdi mdi-information-outline"></i>
                            <div>Pilih status persetujuan dari bank. Keputusan ini akan menentukan langkah selanjutnya.</div>
                        </div>

                        <div class="kpr-inline-alert danger kpr-error-box" id="decisionErrorBox">
                            <i class="mdi mdi-alert-circle-outline"></i>
                            <div>Silakan pilih keputusan persetujuan terlebih dahulu sebelum submit.</div>
                        </div>

                        <form action="{{ route('kpr.verifikasi.store', $application->booking_id ?? $application->id) }}" method="POST" enctype="multipart/form-data" id="formKonfirmasiKpr">
                            @csrf
                            <input type="hidden" name="status" id="inputStatus" value="">

                            <div class="row g-3 mb-3">
                                <div class="col-12 col-md-6">
                                    <div class="kpr-decision-card approve" id="cardSetuju">
                                        <input type="radio" name="decision_choice" id="decisionApprove" value="survey">
                                        <label for="decisionApprove" class="kpr-decision-label">
                                            <div class="kpr-decision-icon">
                                                <i class="mdi mdi-check-bold"></i>
                                            </div>
                                            <div class="kpr-decision-content">
                                                <div class="kpr-decision-title">KPR DISETUJUI</div>
                                                <p class="kpr-decision-desc mb-0">Lanjut ke proses Survey / Akad</p>
                                            </div>
                                            <div class="kpr-decision-check">
                                                <i class="mdi mdi-check-circle"></i>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="kpr-decision-card reject" id="cardTolak">
                                        <input type="radio" name="decision_choice" id="decisionReject" value="rejected">
                                        <label for="decisionReject" class="kpr-decision-label">
                                            <div class="kpr-decision-icon">
                                                <i class="mdi mdi-close-thick"></i>
                                            </div>
                                            <div class="kpr-decision-content">
                                                <div class="kpr-decision-title">KPR DITOLAK</div>
                                                <p class="kpr-decision-desc mb-0">Pindah ke Cash / Pengajuan Ulang</p>
                                            </div>
                                            <div class="kpr-decision-check">
                                                <i class="mdi mdi-check-circle"></i>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- FORM KPR DISETUJUI -->
                            <div id="formSetuju" class="kpr-form-shell approve">
                                <div class="kpr-form-title approve">Form Persetujuan KPR</div>

                                <div class="kpr-inline-alert success">
                                    <i class="mdi mdi-check-circle-outline"></i>
                                    <div><strong>KPR disetujui.</strong> Silakan isi detail persetujuan dari bank.</div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="kpr-form-group">
                                            <label class="kpr-form-label">Nilai Disetujui</label>
                                            <div class="kpr-input-group">
                                                <div class="kpr-input-group-prepend">
                                                    <span class="kpr-input-group-text">Rp</span>
                                                </div>
                                                <input type="text" class="kpr-form-control" name="jumlah_pinjaman" value="{{ $application->jumlah_pinjaman ?? '' }}">
                                            </div>
                                            <small class="kpr-muted">Bisa berbeda dari pengajuan</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="kpr-form-group">
                                            <label class="kpr-form-label">Angsuran Disetujui</label>
                                            <div class="kpr-input-group">
                                                <div class="kpr-input-group-prepend">
                                                    <span class="kpr-input-group-text">Rp</span>
                                                </div>
                                                <input type="text" class="kpr-form-control" name="estimasi_angsuran" value="{{ $application->estimasi_angsuran ?? '' }}">
                                            </div>
                                            <small class="kpr-muted">Bisa berbeda dari pengajuan</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="kpr-form-group">
                                            <label class="kpr-form-label">Tenor Disetujui</label>
                                            <select class="kpr-form-control" name="tenor">
                                                <option value="5" {{ ($application->tenor ?? '') == 5 ? 'selected' : '' }}>5 Tahun</option>
                                                <option value="10" {{ ($application->tenor ?? '') == 10 ? 'selected' : '' }}>10 Tahun</option>
                                                <option value="15" {{ ($application->tenor ?? '') == 15 ? 'selected' : '' }}>15 Tahun</option>
                                                <option value="20" {{ ($application->tenor ?? '') == 20 ? 'selected' : '' }}>20 Tahun</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="kpr-form-group">
                                            <label class="kpr-form-label">Bunga Final</label>
                                            <div class="kpr-input-group append">
                                                <input type="text" class="kpr-form-control" name="bunga" value="{{ $application->bunga ?? '' }}">
                                                <div class="kpr-input-group-append">
                                                    <span class="kpr-input-group-text">%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="kpr-form-group">
                                            <label class="kpr-form-label">No. Surat Persetujuan (SP3K)</label>
                                            <input type="text" class="kpr-form-control" name="no_sp3k" value="SP3K/2025/021/ABC">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="kpr-form-group">
                                            <label class="kpr-form-label">Tanggal Persetujuan</label>
                                            <input type="date" class="kpr-form-control" name="approved_at" value="{{ date('Y-m-d') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="kpr-form-group">
                                    <label class="kpr-form-label">Upload Surat Persetujuan Prinsip</label>
                                    <div class="kpr-file-upload">
                                        <input type="file" name="berita_acara" accept=".jpg,.jpeg,.png,.pdf">
                                        <div class="kpr-file-label">
                                            <i class="mdi mdi-cloud-upload"></i>
                                            <div class="kpr-file-info">
                                                <span>Upload Surat Persetujuan</span>
                                                <small>Format: JPG, PNG, PDF (Max 5MB)</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="kpr-form-group mb-0">
                                    <label class="kpr-form-label">Catatan Persetujuan</label>
                                    <textarea class="kpr-form-control" name="catatan" rows="2">Disetujui dengan nilai Rp {{ number_format($application->jumlah_pinjaman ?? 0, 0, ',', '.') }}, bunga {{ $application->bunga ?? '' }}%</textarea>
                                </div>
                            </div>

                            <!-- FORM KPR DITOLAK -->
                            <div id="formTolak" class="kpr-form-shell reject">
                                <div class="kpr-form-title reject">Form Penolakan KPR</div>

                                <div class="kpr-inline-alert danger">
                                    <i class="mdi mdi-close-circle-outline"></i>
                                    <div><strong>KPR DITOLAK</strong> - Pilih alasan penolakan dari bank.</div>
                                </div>

                                <div class="kpr-form-group">
                                    <label class="kpr-form-label">Alasan Penolakan dari Bank</label>
                                    <select class="kpr-form-control" name="alasan_tolak" id="alasanTolak">
                                        <option value="">-- Pilih Alasan --</option>
                                        <option value="BI Checking">BI Checking / SLIK Bermasalah</option>
                                        <option value="Kemampuan Bayar">Kemampuan Bayar Kurang</option>
                                        <option value="Dokumen Tidak Lengkap">Dokumen Tidak Lengkap</option>
                                        <option value="Appraisal">Nilai Appraisal Rendah</option>
                                        <option value="Usia">Usia Tidak Memenuhi</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>

                                <div class="kpr-form-group" id="alasanLainnya" style="display: none;">
                                    <label class="kpr-form-label">Tulis Alasan Lainnya</label>
                                    <input type="text" class="kpr-form-control" name="alasan_lainnya" placeholder="Contoh: Kebijakan bank baru">
                                </div>

                                <div class="kpr-form-group mb-0">
                                    <label class="kpr-form-label">Catatan Penolakan</label>
                                    <textarea class="kpr-form-control" name="catatan" rows="2" placeholder="Detail penolakan dari bank..."></textarea>
                                </div>
                            </div>

                            <div class="kpr-action-bar">
                                <a href="{{ url('/marketing/kpr') }}" class="kpr-btn kpr-btn-secondary">
                                    <i class="mdi mdi-arrow-left"></i>
                                    Kembali
                                </a>

                                <button type="submit" class="kpr-btn kpr-btn-primary">
                                    <i class="mdi mdi-content-save-outline"></i>
                                    Simpan Konfirmasi
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="kpr-sticky">
                    <!-- Card Serah Terima Unit -->
                    <div class="card">
                        <div class="card-body">
                            <div class="kpr-section-title">
                                <i class="mdi mdi-home-key"></i>
                                <span>Serah Terima Unit</span>
                            </div>

                            @if (($application->status ?? '') === 'approved')
                                <div class="text-center py-3">
                                    <i class="mdi mdi-check-circle text-success" style="font-size: 48px;"></i>
                                    <p class="mt-3 mb-2 fw-medium">Akad telah disetujui</p>
                                    <p class="text-muted small">Unit siap untuk proses serah terima</p>
                                </div>
                                <a href="{{ route('booking.serah-terima', $application->booking->id ?? 0) }}" class="kpr-btn kpr-btn-primary w-100 justify-content-center">
                                    <i class="mdi mdi-key me-1"></i> Proses Serah Terima
                                </a>
                            @else
                                <div class="text-center py-4">
                                    <i class="mdi mdi-clock-outline text-warning" style="font-size: 48px;"></i>
                                    <p class="mt-3 mb-0 text-muted">Menunggu persetujuan akad</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Card Panduan Konfirmasi -->
                    <div class="card mt-4">
                        <div class="card-body">
                            <div class="kpr-section-title">
                                <i class="mdi mdi-lightbulb-on-outline"></i>
                                <span>Panduan Konfirmasi</span>
                            </div>

                            <div class="kpr-sidebar-section">
                                <div class="kpr-sidebar-title">Saat Disetujui</div>
                                <ul class="kpr-mini-list mb-0">
                                    <li>
                                        <i class="mdi mdi-arrow-right-circle-outline"></i>
                                        <span>Isi nilai pinjaman dan angsuran yang disetujui bank.</span>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-right-circle-outline"></i>
                                        <span>Upload surat persetujuan prinsip sebagai bukti.</span>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-right-circle-outline"></i>
                                        <span>Setelah disimpan, proses akan lanjut ke tahap Survey.</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="kpr-sidebar-section">
                                <div class="kpr-sidebar-title">Saat Ditolak</div>
                                <ul class="kpr-mini-list mb-0">
                                    <li>
                                        <i class="mdi mdi-arrow-right-circle-outline"></i>
                                        <span>Pilih alasan penolakan yang sesuai dari bank.</span>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-right-circle-outline"></i>
                                        <span>Isi catatan detail agar tim sales dapat menindaklanjuti.</span>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-right-circle-outline"></i>
                                        <span>Customer akan diarahkan ke opsi alternatif (cash/pengajuan ulang).</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            const $decisionApprove = $('#decisionApprove');
            const $decisionReject = $('#decisionReject');
            const $statusInput = $('#inputStatus');
            const $formSetuju = $('#formSetuju');
            const $formTolak = $('#formTolak');
            const $decisionErrorBox = $('#decisionErrorBox');

            function switchDecision(type) {
                $decisionErrorBox.hide();

                if (type === 'survey') {
                    $statusInput.val('survey');
                    $formSetuju.slideDown(180);
                    $formTolak.slideUp(180);
                } else if (type === 'rejected') {
                    $statusInput.val('rejected');
                    $formTolak.slideDown(180);
                    $formSetuju.slideUp(180);
                }
            }

            $decisionApprove.on('change', function() {
                if ($(this).is(':checked')) {
                    switchDecision('survey');
                }
            });

            $decisionReject.on('change', function() {
                if ($(this).is(':checked')) {
                    switchDecision('rejected');
                }
            });

            // Tampilkan input alasan lainnya
            $('#alasanTolak').change(function() {
                if ($(this).val() === 'Lainnya') {
                    $('#alasanLainnya').slideDown();
                } else {
                    $('#alasanLainnya').slideUp();
                }
            });

            // File upload preview
            $(document).on('change', 'input[type="file"]', function(e) {
                const file = e.target.files[0];
                const $container = $(this).closest('.kpr-file-upload');

                if (file) {
                    const sizeInMB = (file.size / (1024 * 1024)).toFixed(2);
                    $container.find('.kpr-file-info span').text(file.name);
                    $container.find('.kpr-file-info small').text(sizeInMB + ' MB');
                }
            });

            // Form validation
            $('#formKonfirmasiKpr').on('submit', function(e) {
                if (!$statusInput.val()) {
                    e.preventDefault();
                    $decisionErrorBox.slideDown(160);

                    $('html, body').animate({
                        scrollTop: $decisionErrorBox.offset().top - 120
                    }, 300);
                }
            });
        });
    </script>
@endpush
