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

        .badge.badge-success {
            background: linear-gradient(135deg, #28a745, #5cb85c) !important;
            color: #ffffff;
        }

        .badge.badge-warning {
            background: linear-gradient(135deg, #ffc107, #ffdb6d) !important;
            color: #2c2e3f;
        }

        .badge.badge-primary {
            background: linear-gradient(135deg, #9a55ff, #da8cff) !important;
            color: #ffffff;
        }

        .badge.badge-info {
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

        /* ===== CHECKLIST STYLING ===== */
        .serah-checklist-item {
            display: flex;
            align-items: center;
            padding: 0.75rem;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            margin-bottom: 0.5rem;
            transition: all 0.2s ease;
        }

        .serah-checklist-item:hover {
            background: #f8f9fa;
            border-color: #9a55ff;
        }

        .serah-checklist-item .form-check {
            display: flex;
            align-items: center;
            width: 100%;
            margin: 0;
        }

        .serah-checklist-item .form-check-input {
            margin-right: 1rem;
            width: 20px;
            height: 20px;
            cursor: pointer;
        }

        .serah-checklist-item .form-check-input:checked {
            background-color: #28a745;
            border-color: #28a745;
        }

        .serah-checklist-item .form-check-label {
            flex: 1;
            cursor: pointer;
            font-weight: 500;
            color: #2c2e3f;
        }

        .serah-checklist-item .badge {
            margin-left: 0.5rem;
        }

        /* ===== TIMELINE STYLING ===== */
        .serah-timeline {
            margin-top: 0.5rem;
        }

        .serah-timeline-item {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            margin-bottom: 0.75rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid #e9ecef;
        }

        .serah-timeline-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .serah-timeline-icon {
            width: 24px;
            text-align: center;
        }

        .serah-timeline-icon i {
            font-size: 1rem;
        }

        .serah-timeline-content {
            flex: 1;
        }

        .serah-timeline-text {
            display: block;
            font-size: 0.85rem;
            font-weight: 500;
            color: #2c2e3f;
        }

        .serah-timeline-date {
            display: block;
            font-size: 0.7rem;
            color: #6c7383;
        }

        /* ===== DOKUMEN CARD ===== */
        .serah-dokumen-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.75rem;
            background: #f8f9fa;
            border-radius: 8px;
            margin-bottom: 0.5rem;
        }

        .serah-dokumen-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .serah-dokumen-info i {
            font-size: 1.5rem;
            color: #9a55ff;
        }

        .serah-dokumen-info span {
            font-weight: 500;
            color: #2c2e3f;
        }

        .serah-dokumen-status {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* ===== TANDA TANGAN ===== */
        .serah-signature-area {
            border: 2px dashed #e9ecef;
            border-radius: 8px;
            padding: 1rem;
            text-align: center;
            background: #f8f9fa;
            cursor: pointer;
            transition: all 0.3s ease;
            min-height: 150px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .serah-signature-area:hover {
            border-color: #9a55ff;
            background: #f1f0ff;
        }

        .serah-signature-area i {
            font-size: 3rem;
            color: #9a55ff;
            margin-bottom: 0.5rem;
        }

        .serah-signature-area span {
            color: #6c7383;
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

                        <!-- Timeline Steps -->
                        <div class="row g-2 g-md-0">
                            <div class="col text-center mb-3 mb-md-0">
                                <div class="step completed">
                                    <div class="step-icon bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                                        style="width: 35px; height: 35px;">
                                        <i class="mdi mdi-check"></i>
                                    </div>
                                    <span class="d-block text-success small fw-medium">Booking</span>
                                    <small class="text-muted d-none d-sm-block">
                                        {{ $booking->booking_date ? \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('j F Y') : '-' }}
                                    </small>
                                </div>
                            </div>
                            <div class="col text-center mb-3 mb-md-0">
                                <div class="step completed">
                                    <div class="step-icon bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                                        style="width: 35px; height: 35px;">
                                        <i class="mdi mdi-check"></i>
                                    </div>
                                    <span class="d-block text-success small fw-medium">Pelunasan</span>
                                    <small class="text-muted d-none d-sm-block">
                                        {{ $booking->pelunasan_date ? \Carbon\Carbon::parse($booking->pelunasan_date)->translatedFormat('j F Y') : '-' }}
                                    </small>
                                </div>
                            </div>
                            <div class="col text-center mb-3 mb-md-0">
                                <div class="step completed">
                                    <div class="step-icon bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                                        style="width: 35px; height: 35px;">
                                        <i class="mdi mdi-check"></i>
                                    </div>
                                    <span class="d-block text-success small fw-medium">Akad</span>
                                    <small class="text-muted d-none d-sm-block">
                                        {{ $booking->akad_date ? \Carbon\Carbon::parse($booking->akad_date)->translatedFormat('j F Y') : '-' }}
                                    </small>
                                </div>
                            </div>
                            <div class="col text-center">
                                <div class="step active">
                                    <div class="step-icon bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                                        style="width: 35px; height: 35px;">
                                        <i class="mdi mdi-key"></i>
                                    </div>
                                    <span class="d-block text-primary small fw-medium">Serah Terima</span>
                                    <small class="text-muted d-none d-sm-block">Sedang Proses</small>
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
                                    <span class="fw-medium d-block">{{$booking->sales->name ?? '-'}}</span>
                                    <small class="text-muted">{{$booking->sales->role ?? '-'}}</small>
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

        <!-- Form Serah Terima Unit -->
        <div class="row mt-4">
            <!-- Kolom Kiri: Form Utama -->
            <div class="col-12 col-lg-8 mb-4 mb-lg-0">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="mdi mdi-key me-2 text-primary"></i>
                            Form Serah Terima Unit
                        </h5>

                        <!-- Alert Info -->
                        <div class="serah-alert serah-alert-success" role="alert">
                            <i class="mdi mdi-information-outline me-2"></i>
                            Unit siap diserahkan kepada customer. Pastikan semua checklist terpenuhi.
                        </div>

                        <!-- Informasi Serah Terima -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="serah-form-group">
                                    <label>Tanggal Serah Terima</label>
                                    <input type="date" class="serah-form-control" value="2025-03-01">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="serah-form-group">
                                    <label>No. BAST</label>
                                    <input type="text" class="serah-form-control" value="BAST/03/2025/001" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="serah-form-group">
                            <label>Lokasi Serah Terima</label>
                            <select class="serah-form-control">
                                <option value="site" selected>Di Site / Proyek</option>
                                <option value="kantor">Di Kantor Marketing</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>

                        <hr class="my-3">

                        <!-- Checklist Kondisi Unit -->
                        <h6 class="mb-3 text-primary">
                            <i class="mdi mdi-checkbox-marked-circle me-2"></i>
                            Checklist Kondisi Unit
                        </h6>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="serah-checklist-item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="listrik" checked>
                                        <label class="form-check-label" for="listrik">
                                            Listrik berfungsi normal
                                        </label>
                                    </div>
                                    <span class="badge bg-success small">OK</span>
                                </div>

                                <div class="serah-checklist-item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="air" checked>
                                        <label class="form-check-label" for="air">
                                            Air mengalir lancar
                                        </label>
                                    </div>
                                    <span class="badge bg-success small">OK</span>
                                </div>

                                <div class="serah-checklist-item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="pintu" checked>
                                        <label class="form-check-label" for="pintu">
                                            Pintu & jendela berfungsi baik
                                        </label>
                                    </div>
                                    <span class="badge bg-success small">OK</span>
                                </div>

                                <div class="serah-checklist-item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="kunci" checked>
                                        <label class="form-check-label" for="kunci">
                                            Kunci lengkap (pintu utama, pagar)
                                        </label>
                                    </div>
                                    <span class="badge bg-success small">OK</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="serah-checklist-item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="dinding">
                                        <label class="form-check-label" for="dinding">
                                            Dinding & plafon (ada retak?)
                                        </label>
                                    </div>
                                    <span class="badge bg-warning">Periksa</span>
                                </div>

                                <div class="serah-checklist-item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="lantai" checked>
                                        <label class="form-check-label" for="lantai">
                                            Lantai keramik baik
                                        </label>
                                    </div>
                                    <span class="badge bg-success small">OK</span>
                                </div>

                                <div class="serah-checklist-item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="wc" checked>
                                        <label class="form-check-label" for="wc">
                                            Kloset & sanitasi berfungsi
                                        </label>
                                    </div>
                                    <span class="badge bg-success small">OK</span>
                                </div>

                                <div class="serah-checklist-item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="meteran" checked>
                                        <label class="form-check-label" for="meteran">
                                            Meteran listrik & air terpasang
                                        </label>
                                    </div>
                                    <span class="badge bg-success small">OK</span>
                                </div>
                            </div>
                        </div>

                        <hr class="my-3">

                        <!-- Dokumen yang Diserahkan -->
                        <h6 class="mb-3 text-primary">
                            <i class="mdi mdi-file-document me-2"></i>
                            Dokumen yang Diserahkan
                        </h6>

                        <div class="serah-dokumen-card">
                            <div class="serah-dokumen-info">
                                <i class="mdi mdi-key-variant"></i>
                                <span>Kunci Unit (3 buah)</span>
                            </div>
                            <div class="serah-dokumen-status">
                                <span class="badge bg-success">Sudah</span>
                                <input type="checkbox" checked disabled style="opacity: 0.5;">
                            </div>
                        </div>

                        <div class="serah-dokumen-card">
                            <div class="serah-dokumen-info">
                                <i class="mdi mdi-file-document"></i>
                                <span>Akta Jual Beli (AJB)</span>
                            </div>
                            <div class="serah-dokumen-status">
                                <span class="badge bg-success">Sudah</span>
                                <input type="checkbox" checked disabled style="opacity: 0.5;">
                            </div>
                        </div>

                        <div class="serah-dokumen-card">
                            <div class="serah-dokumen-info">
                                <i class="mdi mdi-certificate"></i>
                                <span>Sertifikat Hak Milik (SHM)</span>
                            </div>
                            <div class="serah-dokumen-status">
                                <span class="badge bg-warning">Proses</span>
                                <input type="checkbox">
                            </div>
                        </div>

                        <div class="serah-dokumen-card">
                            <div class="serah-dokumen-info">
                                <i class="mdi mdi-file-document-box"></i>
                                <span>IMB / PBG</span>
                            </div>
                            <div class="serah-dokumen-status">
                                <span class="badge bg-success">Sudah</span>
                                <input type="checkbox" checked disabled style="opacity: 0.5;">
                            </div>
                        </div>

                        <div class="serah-dokumen-card">
                            <div class="serah-dokumen-info">
                                <i class="mdi mdi-book-open-variant"></i>
                                <span>Buku Panduan & Garansi</span>
                            </div>
                            <div class="serah-dokumen-status">
                                <span class="badge bg-success">Sudah</span>
                                <input type="checkbox" checked disabled style="opacity: 0.5;">
                            </div>
                        </div>

                        <hr class="my-3">

                        <!-- Upload Dokumentasi -->
                        <h6 class="mb-3 text-primary">
                            <i class="mdi mdi-camera me-2"></i>
                            Dokumentasi Serah Terima
                        </h6>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="serah-form-group">
                                    <label>Foto 1: Serah Terima Kunci</label>
                                    <div class="serah-file-upload-modern">
                                        <input type="file" id="foto1" accept=".jpg,.jpeg,.png">
                                        <div class="serah-file-label-modern">
                                            <i class="mdi mdi-cloud-upload"></i>
                                            <div class="serah-file-info-modern">
                                                <span>Upload Foto</span>
                                                <small>Customer terima kunci</small>
                                            </div>
                                            <span class="serah-file-size"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="serah-form-group">
                                    <label>Foto 2: Kondisi Unit</label>
                                    <div class="serah-file-upload-modern">
                                        <input type="file" id="foto2" accept=".jpg,.jpeg,.png">
                                        <div class="serah-file-label-modern">
                                            <i class="mdi mdi-cloud-upload"></i>
                                            <div class="serah-file-info-modern">
                                                <span>Upload Foto</span>
                                                <small>Tampak depan unit</small>
                                            </div>
                                            <span class="serah-file-size"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="serah-form-group">
                            <label>Catatan Serah Terima</label>
                            <textarea class="serah-form-control" rows="2"
                                placeholder="Contoh: Unit dalam kondisi baik, listrik dan air sudah aktif, kunci sudah diterima customer">Unit dalam kondisi baik, customer sudah cek seluruh ruangan dan menyatakan puas.</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Tanda Tangan & Aksi -->
            <div class="col-12 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="mdi mdi-signature me-2 text-primary"></i>
                            Tanda Tangan & Persetujuan
                        </h5>

                        <!-- Tanda Tangan Customer -->
                        <div class="serah-form-group">
                            <label>Tanda Tangan Customer</label>
                            <div class="serah-signature-area" onclick="alert('Demo: Modal tanda tangan akan muncul')">
                                <i class="mdi mdi-draw"></i>
                                <span>Klik untuk tanda tangan</span>
                                <small class="text-muted mt-2">{{ $booking->customer->full_name ?? 'Ngebug boy' }}</small>
                            </div>
                        </div>

                        <!-- Tanda Tangan Marketing -->
                        <div class="serah-form-group">
                            <label>Tanda Tangan Marketing</label>
                            <div class="serah-signature-area" onclick="alert('Demo: Modal tanda tangan akan muncul')">
                                <i class="mdi mdi-draw"></i>
                                <span>Klik untuk tanda tangan</span>
                                <small class="text-muted mt-2">Ahmad Rizki</small>
                            </div>
                        </div>

                        <!-- Saksi (opsional) -->
                        <div class="serah-form-group">
                            <label>Saksi (opsional)</label>
                            <input type="text" class="serah-form-control" placeholder="Nama saksi">
                        </div>

                        <hr class="my-3">

                        <!-- Checkbox Persetujuan -->
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="setuju" checked>
                            <label class="form-check-label" for="setuju">
                                Saya menyatakan bahwa unit telah diterima dalam kondisi baik dan sesuai dengan perjanjian.
                            </label>
                        </div>

                        <hr class="my-3">

                        <!-- Ringkasan & Timeline -->
                        <h6 class="mb-3 text-primary">
                            <i class="mdi mdi-timeline-clock me-2"></i>
                            Timeline Transaksi
                        </h6>

                        <div class="serah-timeline">
                            <div class="serah-timeline-item">
                                <div class="serah-timeline-icon">
                                    <i class="mdi mdi-check-circle text-success"></i>
                                </div>
                                <div class="serah-timeline-content">
                                    <span class="serah-timeline-text">Booking & Bayar Booking Fee</span>
                                    <span class="serah-timeline-date">10 Februari 2025</span>
                                </div>
                            </div>
                            <div class="serah-timeline-item">
                                <div class="serah-timeline-icon">
                                    <i class="mdi mdi-check-circle text-success"></i>
                                </div>
                                <div class="serah-timeline-content">
                                    <span class="serah-timeline-text">Pelunasan Pembayaran</span>
                                    <span class="serah-timeline-date">20 Februari 2025</span>
                                </div>
                            </div>
                            <div class="serah-timeline-item">
                                <div class="serah-timeline-icon">
                                    <i class="mdi mdi-check-circle text-success"></i>
                                </div>
                                <div class="serah-timeline-content">
                                    <span class="serah-timeline-text">Proses Akad Cash</span>
                                    <span class="serah-timeline-date">25 Februari 2025</span>
                                </div>
                            </div>
                            <div class="serah-timeline-item">
                                <div class="serah-timeline-icon">
                                    <i class="mdi mdi-progress-clock text-primary"></i>
                                </div>
                                <div class="serah-timeline-content">
                                    <span class="serah-timeline-text">Serah Terima Unit</span>
                                    <span class="serah-timeline-date">1 Maret 2025 (Sekarang)</span>
                                </div>
                            </div>
                        </div>

                        <hr class="my-3">

                        <!-- Tombol Aksi -->
                        <div class="d-flex flex-column gap-2">
                            <button class="serah-btn serah-btn-success w-100">
                                <i class="mdi mdi-check-decagram me-2"></i>
                                Proses Serah Terima
                            </button>

                            <button class="serah-btn serah-btn-primary w-100">
                                <i class="mdi mdi-printer me-2"></i>
                                Cetak BAST
                            </button>

                            <button class="serah-btn serah-btn-primary w-100"
                                style="background: linear-gradient(135deg, #25D366, #128C7E);">
                                <i class="mdi mdi-whatsapp me-2"></i>
                                Kirim Notifikasi WhatsApp
                            </button>

                            <button class="serah-btn serah-btn-outline-secondary w-100">
                                <i class="mdi mdi-arrow-left me-2"></i>
                                Kembali ke Akad Cash
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                            sizeSpan.text(sizeInMB + ' MB');
                        }
                    } else {
                        label.text('Upload Foto');
                        sizeSpan.text('');
                    }
                });

                // Checklist item styling
                $('.serah-checklist-item .form-check-input').change(function() {
                    const badge = $(this).closest('.serah-checklist-item').find('.badge');
                    if ($(this).is(':checked')) {
                        badge.removeClass('bg-warning').addClass('bg-success').text('OK');
                    } else {
                        badge.removeClass('bg-success').addClass('bg-warning').text('Periksa');
                    }
                });

                // Dokumen checklist
                $('.serah-dokumen-status input[type="checkbox"]').change(function() {
                    const badge = $(this).closest('.serah-dokumen-status').find('.badge');
                    if ($(this).is(':checked')) {
                        badge.removeClass('bg-warning').addClass('bg-success').text('Sudah');
                    } else {
                        badge.removeClass('bg-success').addClass('bg-warning').text('Belum');
                    }
                });
            });
        </script>
    @endpush
@endsection
