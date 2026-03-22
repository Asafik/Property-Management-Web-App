@extends('layouts.partial.app')

@section('title', 'Serah Terima Unit - Properti Management')

@section('content')
    <style>
        /* ===== SEMUA CSS SAMA PERSIS DENGAN HALAMAN SEBELUMNYA ===== */
        .card {
            transition: all 0.3s ease;
            margin-bottom: 1rem;
        }

        .card:hover {
            box-shadow: 0 8px 25px rgba(154, 85, 255, 0.1) !important;
        }

        .card-header {
            background: linear-gradient(135deg, #ffffff, #f8f9fa);
            border-bottom: 1px solid #e9ecef;
            padding: 0.75rem;
        }

        @media (min-width: 576px) {
            .card-header {
                padding: 1rem;
            }
        }

        @media (min-width: 768px) {
            .card-header {
                padding: 1.2rem;
            }
        }

        .card-body {
            padding: 0.75rem;
        }

        @media (min-width: 576px) {
            .card-body {
                padding: 1rem;
            }
        }

        @media (min-width: 768px) {
            .card-body {
                padding: 1.2rem;
            }
        }

        /* Card Title */
        .card-title {
            font-size: 0.9rem;
            font-weight: 600;
            color: #9a55ff;
            margin-bottom: 0;
        }

        @media (min-width: 576px) {
            .card-title {
                font-size: 1rem;
            }
        }

        @media (min-width: 768px) {
            .card-title {
                font-size: 1.1rem;
            }
        }

        /* ===== STATISTICS CARDS ===== */
        .bg-gradient-primary {
            background: linear-gradient(135deg, #da8cff, #9a55ff) !important;
        }

        .bg-gradient-info {
            background: linear-gradient(135deg, #17a2b8, #5bc0de) !important;
        }

        .bg-gradient-success {
            background: linear-gradient(135deg, #28a745, #5cb85c) !important;
        }

        .bg-gradient-warning {
            background: linear-gradient(135deg, #ffc107, #ffdb6d) !important;
        }

        .bg-gradient-danger {
            background: linear-gradient(135deg, #dc3545, #e4606d) !important;
        }

        .bg-gradient-secondary {
            background: linear-gradient(135deg, #6c757d, #a5b3cb) !important;
        }

        /* Badge Styling */
        .badge {
            padding: 0.35rem 0.6rem;
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: 30px;
            display: inline-block;
            white-space: nowrap;
        }

        @media (min-width: 576px) {
            .badge {
                padding: 0.4rem 0.75rem;
                font-size: 0.8rem;
            }
        }

        @media (min-width: 768px) {
            .badge {
                padding: 0.45rem 0.8rem;
                font-size: 0.85rem;
            }
        }

        .badge.bg-success {
            background: linear-gradient(135deg, #28a745, #5cb85c) !important;
            color: #ffffff;
        }

        .badge.bg-warning {
            background: linear-gradient(135deg, #ffc107, #ffdb6d) !important;
            color: #2c2e3f;
        }

        .badge.bg-primary {
            background: linear-gradient(135deg, #9a55ff, #da8cff) !important;
            color: #ffffff;
        }

        .badge.bg-info {
            background: linear-gradient(135deg, #17a2b8, #5bc0de) !important;
            color: #ffffff;
        }

        /* ===== FORM STYLING ===== */
        .serah-form-group {
            margin-bottom: 1rem;
        }

        .serah-form-group label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #9a55ff !important;
            margin-bottom: 0.3rem;
            letter-spacing: 0.3px;
            font-family: 'Nunito', sans-serif;
            display: block;
        }

        .serah-form-control {
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 0.6rem 0.8rem;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            background-color: #ffffff;
            color: #2c2e3f;
            width: 100%;
        }

        .serah-form-control:focus {
            border-color: #9a55ff;
            box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.1);
            outline: none;
        }

        select.serah-form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%239a55ff' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 12px;
            padding-right: 2rem;
        }

        /* ===== INPUT GROUP STYLING ===== */
        .serah-input-group {
            display: flex;
            align-items: center;
        }

        .serah-input-group-prepend {
            margin-right: -1px;
        }

        .serah-input-group-text {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border: 1px solid #e9ecef;
            border-radius: 8px 0 0 8px;
            padding: 0.6rem 0.8rem;
            font-size: 0.9rem;
            color: #9a55ff;
            font-weight: 600;
        }

        .serah-input-group .serah-form-control:first-child {
            border-radius: 0 8px 8px 0;
        }

        .serah-input-group .serah-form-control:last-child {
            border-radius: 0 8px 8px 0;
        }

        /* ===== FILE UPLOAD MODERN ===== */
        .serah-file-upload-modern {
            position: relative;
            width: 100%;
        }

        .serah-file-upload-modern input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
            z-index: 2;
        }

        .serah-file-upload-modern .serah-file-label-modern {
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
            .serah-file-upload-modern .serah-file-label-modern {
                flex-direction: row;
                text-align: left;
                gap: 8px;
                padding: 0.75rem 1rem;
                min-height: auto;
            }
        }

        .serah-file-upload-modern:hover .serah-file-label-modern {
            border-color: #9a55ff;
            background: linear-gradient(135deg, #f1f0ff, #f8f9fa);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(154, 85, 255, 0.1);
        }

        .serah-file-upload-modern .serah-file-label-modern i {
            font-size: 1.6rem;
            color: #9a55ff;
            background: rgba(154, 85, 255, 0.1);
            padding: 8px;
            border-radius: 50%;
        }

        .serah-file-upload-modern .serah-file-label-modern .serah-file-info-modern {
            flex: 1;
            width: 100%;
        }

        .serah-file-upload-modern .serah-file-label-modern .serah-file-info-modern span {
            display: block;
            font-weight: 600;
            color: #2c2e3f;
            font-size: 0.8rem;
            word-break: break-word;
        }

        .serah-file-upload-modern .serah-file-label-modern .serah-file-info-modern small {
            color: #6c7383;
            font-size: 0.65rem;
            display: block;
            margin-top: 2px;
        }

        .serah-file-upload-modern .serah-file-label-modern .serah-file-size {
            font-size: 0.7rem;
            color: #9a55ff;
            font-weight: 600;
            background: rgba(154, 85, 255, 0.1);
            padding: 4px 10px;
            border-radius: 20px;
            white-space: nowrap;
            margin-top: 5px;
        }

        @media (min-width: 576px) {
            .serah-file-upload-modern .serah-file-label-modern .serah-file-size {
                margin-top: 0;
            }
        }

        /* ===== ALERT STYLING ===== */
        .serah-alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        .serah-alert-success {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            border-left: 4px solid #28a745;
            color: #155724;
        }

        .serah-alert-warning {
            background: linear-gradient(135deg, #fff3cd, #ffeeba);
            border-left: 4px solid #ffc107;
            color: #856404;
        }

        .serah-alert-info {
            background: linear-gradient(135deg, #d1ecf1, #bee5eb);
            border-left: 4px solid #17a2b8;
            color: #0c5460;
        }

        .serah-alert-danger {
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
            border-left: 4px solid #dc3545;
            color: #721c24;
        }

        /* ===== CHECKLIST STYLING - MODERN ===== */
        .serah-checklist-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .serah-checklist-item {
            position: relative;
            width: 100%;
        }

        @media (min-width: 768px) {
            .serah-checklist-item {
                width: calc(50% - 0.25rem);
            }
        }

        .serah-checklist-item .form-check {
            position: relative;
            margin: 0;
            padding: 0;
        }

        .serah-checklist-item input[type="checkbox"] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .serah-checklist-item .check-label {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0.75rem 1rem;
            background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
            border: 2px solid #e9ecef;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            min-height: 60px;
        }

        .serah-checklist-item .check-label:hover {
            border-color: #9a55ff;
            background: linear-gradient(135deg, #f1f0ff, #f8f9fa);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(154, 85, 255, 0.15);
        }

        .serah-checklist-item input[type="checkbox"]:checked+.check-label {
            border-color: #9a55ff;
            background: linear-gradient(135deg, #f1f0ff, #e8e0ff);
            box-shadow: 0 5px 15px rgba(154, 85, 255, 0.2);
        }

        .check-icon {
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            border-radius: 8px;
            color: #d0d4db;
            transition: all 0.3s ease;
        }

        .check-icon i {
            font-size: 1.4rem;
        }

        .serah-checklist-item input[type="checkbox"]:checked+.check-label .check-icon {
            color: #9a55ff;
            transform: scale(1.1);
            animation: checkPulse 0.3s ease;
        }

        .check-text {
            flex: 1;
            font-weight: 600;
            color: #2c2e3f;
            font-size: 0.9rem;
        }

        .serah-checklist-item input[type="checkbox"]:checked+.check-label .check-text {
            color: #9a55ff;
        }

        @keyframes checkPulse {
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

        /* Dokumen Checklist Modern */
        .serah-doc-wrapper {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .serah-doc-item {
            position: relative;
        }

        .serah-doc-item .form-check {
            margin: 0;
            padding: 0;
        }

        .serah-doc-item input[type="checkbox"] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .serah-doc-item .doc-label {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0.75rem 1rem;
            background: white;
            border: 1px solid #e9ecef;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .serah-doc-item .doc-label:hover {
            border-color: #9a55ff;
            background: #f8f9fa;
            transform: translateX(5px);
        }

        .serah-doc-item input[type="checkbox"]:checked+.doc-label {
            border-color: #9a55ff;
            background: linear-gradient(135deg, #f1f0ff, #e8e0ff);
            border-left: 4px solid #9a55ff;
        }

        .doc-icon {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(154, 85, 255, 0.1);
            border-radius: 8px;
            color: #9a55ff;
        }

        .doc-icon i {
            font-size: 1.2rem;
        }

        .serah-doc-item input[type="checkbox"]:checked+.doc-label .doc-icon {
            background: rgba(154, 85, 255, 0.2);
            color: #9a55ff;
        }

        .doc-text {
            flex: 1;
            font-weight: 500;
            color: #2c2e3f;
        }

        .serah-doc-item input[type="checkbox"]:checked+.doc-label .doc-text {
            color: #9a55ff;
            font-weight: 600;
        }

        .doc-badge {
            background: linear-gradient(135deg, #ffc107, #ffdb6d);
            color: #2c2e3f;
            padding: 0.25rem 0.5rem;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
        }

        .serah-doc-item input[type="checkbox"]:checked+.doc-label .doc-badge {
            background: linear-gradient(135deg, #9a55ff, #da8cff);
            color: white;
        }

        /* ===== TEXT COLORS ===== */
        .text-primary {
            color: #9a55ff !important;
        }

        .text-muted {
            color: #6c7383 !important;
        }

        /* ===== BUTTON STYLING ===== */
        .serah-btn {
            font-size: 0.85rem;
            padding: 0.6rem 1rem;
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
            .serah-btn {
                width: auto;
                padding: 0.6rem 1.2rem;
            }
        }

        .serah-btn-primary {
            background: linear-gradient(to right, #da8cff, #9a55ff);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.3);
        }

        .serah-btn-primary:hover {
            background: linear-gradient(to right, #c77cff, #8a45e6);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(154, 85, 255, 0.4);
        }

        .serah-btn-success {
            background: linear-gradient(to right, #28a745, #5cb85c);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
        }

        .serah-btn-success:hover {
            background: linear-gradient(to right, #23923d, #4fae54);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(40, 167, 69, 0.4);
        }

        .serah-btn-outline-secondary {
            background: transparent;
            border: 1px solid #6c757d;
            color: #6c757d;
        }

        .serah-btn-outline-secondary:hover {
            background: #6c757d;
            color: #ffffff;
            transform: translateY(-2px);
        }

        /* ===== TIMELINE STEPS (BAWAAN) ===== */
        .timeline-steps {
            margin-top: 1rem;
        }

        .step {
            text-align: center;
        }

        .step .step-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 0.5rem;
            font-size: 1.2rem;
        }

        .step.completed .step-icon {
            background-color: #28a745 !important;
            color: white;
        }

        .step.active .step-icon {
            background-color: #007bff !important;
            color: white;
        }

        .step small {
            display: block;
            font-size: 0.75rem;
            color: #6c757d;
        }

        .detail-info {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 1rem;
        }
    </style>

    <div class="container-fluid p-2 p-sm-3 p-md-4">
        <!-- Header Info Customer -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex flex-wrap align-items-center gap-3">
                        <!-- Avatar -->
                        <div class="flex-shrink-0">
                            <div class="bg-gradient-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 50px; height: 50px;">
                                <i class="mdi mdi-account" style="font-size: 24px;"></i>
                            </div>
                        </div>

                        <!-- Info Customer -->
                        <div class="flex-grow-1">
                            <h4 class="mb-1 text-dark">{{ $booking->customer->full_name ?? 'Ngebug boy' }}</h4>
                            <p class="text-muted mb-0">Kode Booking: {{ $booking->booking_code ?? 'Ngebug boy' }}</p>
                        </div>

                        <!-- Info Unit -->
                        <div class="mt-3 mt-sm-0">
                            <div class="d-flex flex-wrap gap-3">
                                <div>
                                    <small class="text-muted d-block">Unit</small>
                                    <span class="fw-medium">{{ $booking->unit->landBank->name ?? 'Ngebug boy' }} -
                                        {{ $booking->unit->type ?? 'Ngebug Boy' }}</span>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Blok/No</small>
                                    <span class="fw-medium">{{ $booking->unit->unit_code ?? 'Ngebug boy' }}</span>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Jenis Unit</small>
                                    <span
                                        class="fw-medium">{{ $booking->unit->jenis == 'komersil' ? 'Komersil' : '-' }}</span>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Status Pembangunan</small>
                                    @php
                                        $progressMap = [
                                            'belum_mulai' => 'Belum mulai pembangunan',
                                            'pondasi' => 'Sedang tahap pondasi',
                                            'dinding' => 'Sedang tahap pembangunan Dinding',
                                            'atap' => 'Sedang tahap pembangunan Atap',
                                            'finishing' => 'Sedang tahap Finishing',
                                            'selesai' => 'Selesai pembangunan',
                                        ];
                                    @endphp

                                    <span class="fw-medium">
                                        {{ $progressMap[$booking->unit->construction_progress] ?? '-' }}
                                    </span>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Harga Unit</small>
                                    <span class="fw-medium text-primary">
                                        {{ $booking->unit->price ? 'Rp ' . number_format($booking->unit->price, 0, ',', '.') : 'Ngebug Boy' }}
                                    </span>
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
                            Tahapan Serah Terima Unit
                        </h5>

                        <!-- Progress Bar -->
                        <div class="mb-4">
                            <div class="d-flex flex-wrap justify-content-between mb-2">
                                <span class="text-muted">Progress Transaksi</span>
                                <span class="badge badge-primary">Tahap Akhir: Serah Terima</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 90%;"
                                    aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>

                        <!-- Timeline Steps (Bawaan) -->
                        <div class="timeline-steps">
                            <div class="row">
                                <div class="col-3 text-center">
                                    <div class="step completed">
                                        <div class="step-icon">
                                            <i class="mdi mdi-check"></i>
                                        </div>
                                        <span>Booking</span>
                                        <small>{{ $booking->booking_date ? \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('j F Y') : '-' }}</small>
                                    </div>
                                </div>
                                <div class="col-3 text-center">
                                    <div class="step completed">
                                        <div class="step-icon">
                                            <i class="mdi mdi-check"></i>
                                        </div>
                                        <span>Pelunasan</span>
                                        <small>{{ $booking->pelunasan_date ? \Carbon\Carbon::parse($booking->pelunasan_date)->translatedFormat('j F Y') : '-' }}</small>
                                    </div>
                                </div>
                                <div class="col-3 text-center">
                                    <div class="step completed">
                                        <div class="step-icon">
                                            <i class="mdi mdi-check"></i>
                                        </div>
                                        <span>Akad</span>
                                        <small>{{ $booking->akad_date ? \Carbon\Carbon::parse($booking->akad_date)->translatedFormat('j F Y') : '-' }}</small>
                                    </div>
                                </div>
                                <div class="col-3 text-center">
                                    <div class="step active">
                                        <div class="step-icon">
                                            <i class="mdi mdi-key"></i>
                                        </div>
                                        <span>Serah Terima</span>
                                        <small>Sedang Proses</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Status Pembayaran -->
            <div class="col-12 col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="mdi mdi-cash-multiple me-2 text-primary"></i>
                            Status Pembayaran
                        </h5>

                        <div class="detail-info">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Harga Unit</span>
                                <span class="fw-medium">
                                    {{ $booking->unit->price ? 'Rp ' . number_format($booking->unit->price, 0, ',', '.') : 'Ngebug Boy' }}</span>

                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Diskon</span>
                                <span class="fw-medium text-success">
                                    {{ $booking->harga_nego ? 'Rp ' . number_format($booking->harga_nego, 0, ',', '.') : '-' }}
                                </span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Total Dibayar</span>
                                <span class="fw-medium text-primary">
                                    {{ $booking->unit->price
                                        ? 'Rp ' . number_format($booking->unit->price - ($booking->harga_nego ?? 0), 0, ',', '.')
                                        : '-' }}
                                </span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Status</span>
                                <span class="badge bg-success">
                                    {{ $booking->status_cash === 'done' ? 'Lunas' : ($booking->status_cash === 'process' ? 'Proses' : 'Belum Lunas') }}
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
                                    <span class="fw-medium d-block">{{ $booking->sales->name ?? '-' }}</span>
                                    <small class="text-muted">{{ $booking->sales->role ?? '-' }}</small>
                                </div>
                            </div>
                        </div>

                        <hr class="my-3">

                        <div class="mt-3">
                            <small class="text-muted d-block mb-2">Metode Pembayaran:</small>
                            <span class="badge bg-success">Cash</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('serah-terima.store', $booking->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row mt-4">

                <!-- ================= LEFT ================= -->
                <div class="col-12 col-lg-8 mb-4 mb-lg-0">
                    <div class="card">
                        <div class="card-body">

                            <h5 class="card-title">
                                <i class="mdi mdi-key me-2 text-primary"></i>
                                Form Serah Terima Unit
                            </h5>

                            <!-- Informasi -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="serah-form-group">
                                        <label>Tanggal Serah Terima</label>
                                        <input type="date" name="tanggal_serah_terima" class="serah-form-control"
                                            value="{{ date('Y-m-d') }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="serah-form-group">
                                        <label>No. BAST</label>
                                        <input type="text" name="no_bast" class="serah-form-control"
                                            value="{{ $noBast ?? 'Auto Generate' }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="serah-form-group">
                                <label>Lokasi Serah Terima</label>
                                <select name="lokasi_serah_terima" class="serah-form-control">
                                    <option value="site">Di Site / Proyek</option>
                                    <option value="kantor">Di Kantor Marketing</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>

                            <hr>

                            <!-- ================= CHECKLIST MODERN ================= -->
                            <h6 class="text-primary mb-3">Checklist Kondisi Unit</h6>

                            @php
                                $items = [
                                    'Listrik berfungsi normal',
                                    'Air mengalir lancar',
                                    'Pintu & jendela berfungsi baik',
                                    'Kunci lengkap (pintu utama, pagar)',
                                    'Dinding & plafon baik',
                                    'Lantai keramik baik',
                                    'Kloset & sanitasi berfungsi',
                                    'Meteran listrik & air terpasang',
                                ];
                            @endphp

                            <div class="serah-checklist-wrapper">
                                @foreach ($items as $index => $item)
                                    <div class="serah-checklist-item">
                                        <div class="form-check">
                                            <input type="hidden" name="items[{{ $index }}][name]"
                                                value="{{ $item }}">
                                            <input type="checkbox" name="items[{{ $index }}][checked]"
                                                value="1" id="item_{{ $index }}" class="form-check-input">
                                            <label for="item_{{ $index }}" class="check-label">
                                                <span class="check-icon">
                                                    <i class="mdi mdi-check-circle"></i>
                                                </span>
                                                <span class="check-text">{{ $item }}</span>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <hr>

                            <!-- ================= DOKUMEN MODERN ================= -->
                            <h6 class="text-primary mb-3">Dokumen yang Diserahkan</h6>

                            @php
                                $documents = [
                                    ['name' => 'Kunci Unit (3 buah)', 'icon' => 'key'],
                                    ['name' => 'Akta Jual Beli (AJB)', 'icon' => 'file-document-outline'],
                                    ['name' => 'Sertifikat Hak Milik (SHM)', 'icon' => 'file-certificate'],
                                    ['name' => 'IMB / PBG', 'icon' => 'file-document'],
                                    ['name' => 'Buku Panduan & Garansi', 'icon' => 'book-open'],
                                ];
                            @endphp

                            <div class="serah-doc-wrapper">
                                @foreach ($documents as $index => $doc)
                                    <div class="serah-doc-item">
                                        <div class="form-check">
                                            <input type="hidden" name="documents[{{ $index }}][name]"
                                                value="{{ $doc['name'] }}">
                                            <input type="checkbox" name="documents[{{ $index }}][submitted]"
                                                value="1" id="doc_{{ $index }}" class="form-check-input">
                                            <label for="doc_{{ $index }}" class="doc-label">
                                                <span class="doc-icon">
                                                    <i class="mdi mdi-{{ $doc['icon'] }}"></i>
                                                </span>
                                                <span class="doc-text">{{ $doc['name'] }}</span>
                                                <span class="doc-badge">Wajib</span>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <hr>

                            <!-- ================= UPLOAD MODERN ================= -->
                            <h6 class="text-primary mb-3">Dokumentasi Serah Terima</h6>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="serah-form-group">
                                        <label>Foto Serah Terima Kunci</label>
                                        <div class="serah-file-upload-modern">
                                            <input type="file" name="foto_serah_kunci" accept=".jpg,.jpeg,.png">
                                            <div class="serah-file-label-modern">
                                                <i class="mdi mdi-cloud-upload"></i>
                                                <div class="serah-file-info-modern">
                                                    <span>Upload Foto Kunci</span>
                                                    <small>Format: JPG, PNG (Max 5MB)</small>
                                                </div>
                                                <span class="serah-file-size"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="serah-form-group">
                                        <label>Foto Kondisi Unit</label>
                                        <div class="serah-file-upload-modern">
                                            <input type="file" name="foto_kondisi_unit" accept=".jpg,.jpeg,.png">
                                            <div class="serah-file-label-modern">
                                                <i class="mdi mdi-cloud-upload"></i>
                                                <div class="serah-file-info-modern">
                                                    <span>Upload Foto Unit</span>
                                                    <small>Format: JPG, PNG (Max 5MB)</small>
                                                </div>
                                                <span class="serah-file-size"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="serah-form-group">
                                <label>Catatan</label>
                                <textarea name="catatan" class="serah-form-control" rows="3" placeholder="Tambahkan catatan jika ada..."></textarea>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- ================= RIGHT ================= -->
                <div class="col-12 col-lg-4">
                    <div class="card">
                        <div class="card-body">

                            <h5 class="card-title">
                                <i class="mdi mdi-signature me-2 text-primary"></i>
                                Persetujuan
                            </h5>

                            <div class="serah-form-group">
                                <label>Saksi (Opsional)</label>
                                <input type="text" name="saksi" class="serah-form-control"
                                    placeholder="Nama saksi">
                            </div>

                            <div class="serah-form-group">
                                <div class="serah-checklist-item" style="width: 100%;">
                                    <div class="form-check">
                                        <input type="checkbox" name="persetujuan" value="1" id="persetujuan"
                                            class="form-check-input" required>
                                        <label for="persetujuan" class="check-label">
                                            <span class="check-icon">
                                                <i class="mdi mdi-check-circle"></i>
                                            </span>
                                            <span class="check-text">Saya menyatakan unit diterima dalam kondisi
                                                baik.</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <button type="submit" class="serah-btn serah-btn-success w-100">
                                <i class="mdi mdi-check-decagram me-2"></i>
                                Proses Serah Terima
                            </button>

                            <div class="text-center mt-3">
                                <small class="text-muted">
                                    <i class="mdi mdi-information-outline me-1"></i>
                                    Pastikan semua checklist terisi
                                </small>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </form>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // File upload preview untuk semua input file
            $('.serah-file-upload-modern input[type="file"]').change(function(e) {
                const fileName = e.target.files[0]?.name;
                const fileSize = e.target.files[0]?.size;
                const label = $(this).closest('.serah-file-upload-modern').find(
                    '.serah-file-info-modern span');
                const sizeSpan = $(this).closest('.serah-file-upload-modern').find('.serah-file-size');

                if (fileName) {
                    label.text(fileName.length > 30 ? fileName.substring(0, 30) + '...' : fileName);
                    if (fileSize) {
                        const sizeInMB = (fileSize / (1024 * 1024)).toFixed(2);
                        sizeSpan.text(sizeInMB + ' MB').show();
                    }
                } else {
                    const parent = $(this).closest('.serah-file-upload-modern');
                    if (parent.find('input[name="foto_serah_kunci"]').length) {
                        label.text('Upload Foto Kunci');
                    } else {
                        label.text('Upload Foto Unit');
                    }
                    sizeSpan.text('').hide();
                }
            });
        });
    </script>
@endpush
