@extends('layouts.partial.app')

@section('title', 'Vertifikasi KPR - Properti Management')

@section('content')
<style>
    /* ===== STYLE CSS DARI HALAMAN AKAD ===== */
    /* Form Styling */
    .konfirmasi-form-group {
        margin-bottom: 1rem;
    }

    @media (min-width: 768px) {
        .konfirmasi-form-group {
            margin-bottom: 1.2rem;
        }
    }

    .konfirmasi-form-group label {
        font-size: 0.8rem;
        font-weight: 600;
        color: #9a55ff !important;
        margin-bottom: 0.3rem;
        letter-spacing: 0.3px;
        font-family: 'Nunito', sans-serif;
        display: block;
    }

    @media (min-width: 768px) {
        .konfirmasi-form-group label {
            font-size: 0.85rem;
            margin-bottom: 0.4rem;
        }
    }

    .konfirmasi-form-control {
        border: 1px solid #e9ecef;
        border-radius: 10px;
        padding: 0.7rem 0.8rem;
        font-size: 0.85rem;
        transition: all 0.2s ease;
        background-color: #ffffff;
        color: #2c2e3f;
        width: 100%;
        font-family: 'Nunito', sans-serif;
    }

    @media (min-width: 768px) {
        .konfirmasi-form-control {
            padding: 0.6rem 0.75rem;
            font-size: 0.9rem;
            border-radius: 8px;
        }
    }

    .konfirmasi-form-control:focus {
        border-color: #9a55ff;
        box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.1);
        outline: none;
    }

    /* Input Group */
    .konfirmasi-input-group {
        display: flex;
        align-items: stretch;
        width: 100%;
    }

    .konfirmasi-input-group-prepend {
        display: flex;
    }

    .konfirmasi-input-group-text {
        display: flex;
        align-items: center;
        padding: 0.7rem 0.8rem;
        font-size: 0.85rem;
        font-weight: 400;
        line-height: 1;
        color: #6c7383;
        text-align: center;
        white-space: nowrap;
        background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
        border: 1px solid #e9ecef;
        border-radius: 10px 0 0 10px;
        border-right: none;
    }

    .konfirmasi-input-group .konfirmasi-form-control {
        border-radius: 0 10px 10px 0;
    }

    /* Alert Styling dari Akad */
    .konfirmasi-alert {
        border: none;
        border-radius: 10px;
        padding: 0.8rem 1rem;
        font-size: 0.8rem;
        border-left: 4px solid;
        margin-bottom: 1rem;
    }

    @media (min-width: 768px) {
        .konfirmasi-alert {
            padding: 0.9rem 1rem;
            font-size: 0.85rem;
        }
    }

    .konfirmasi-alert-warning {
        background: linear-gradient(135deg, #fff9e6, #fff3d6);
        color: #2c2e3f;
        border-left-color: #ffc107;
    }

    .konfirmasi-alert-warning i {
        color: #ffc107;
    }

    .konfirmasi-alert-success {
        background: linear-gradient(135deg, #f0fff4, #e6f7e6);
        color: #2c2e3f;
        border-left-color: #28a745;
    }

    .konfirmasi-alert-success i {
        color: #28a745;
    }

    .konfirmasi-alert-danger {
        background: linear-gradient(135deg, #fff0f0, #ffe6e6);
        color: #2c2e3f;
        border-left-color: #dc3545;
    }

    .konfirmasi-alert-danger i {
        color: #dc3545;
    }

    /* Timeline Styling dari Akad */
    .konfirmasi-timeline {
        margin-top: 1rem;
    }

    .konfirmasi-timeline-item {
        display: flex;
        align-items: center;
        margin-bottom: 0.75rem;
    }

    .konfirmasi-timeline-icon {
        margin-right: 1rem;
        font-size: 1.2rem;
    }

    .konfirmasi-timeline-content {
        flex: 1;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .konfirmasi-timeline-text {
        font-weight: 500;
    }

    .konfirmasi-timeline-date {
        color: #6c757d;
        font-size: 0.85rem;
    }

    /* Text colors */
    .konfirmasi-text-muted {
        color: #a5b3cb !important;
        font-size: 0.7rem;
        display: block;
        margin-top: 0.2rem;
    }

    .konfirmasi-text-primary {
        color: #9a55ff !important;
    }

    /* Divider */
    .konfirmasi-hr {
        border-top: 1px solid #e9ecef;
        margin: 0.8rem 0;
    }

    /* Card Option Styling */
    .konfirmasi-card-option {
        transition: all 0.3s ease;
        cursor: pointer;
        border: none;
    }

    .konfirmasi-card-option:hover {
        transform: scale(1.02);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    .konfirmasi-card-option.bg-success {
        background: linear-gradient(135deg, #28a745, #5cb85c) !important;
    }

    .konfirmasi-card-option.bg-danger {
        background: linear-gradient(135deg, #dc3545, #e4606d) !important;
    }

    .konfirmasi-card-option i {
        filter: drop-shadow(0 4px 8px rgba(0,0,0,0.1));
    }

    /* ===== MODERN FILE UPLOAD STYLING DARI AKAD ===== */
    .konfirmasi-file-upload-modern {
        position: relative;
        width: 100%;
    }

    .konfirmasi-file-upload-modern input[type="file"] {
        position: absolute;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
        z-index: 2;
    }

    .konfirmasi-file-upload-modern .konfirmasi-file-label-modern {
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
        .konfirmasi-file-upload-modern .konfirmasi-file-label-modern {
            flex-direction: row;
            text-align: left;
            gap: 8px;
            padding: 0.75rem 1rem;
            min-height: auto;
        }
    }

    .konfirmasi-file-upload-modern:hover .konfirmasi-file-label-modern {
        border-color: #9a55ff;
        background: linear-gradient(135deg, #f1f0ff, #f8f9fa);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(154, 85, 255, 0.1);
    }

    .konfirmasi-file-upload-modern .konfirmasi-file-label-modern i {
        font-size: 1.6rem;
        color: #9a55ff;
        background: rgba(154, 85, 255, 0.1);
        padding: 8px;
        border-radius: 50%;
    }

    .konfirmasi-file-upload-modern .konfirmasi-file-label-modern .konfirmasi-file-info-modern {
        flex: 1;
        width: 100%;
    }

    .konfirmasi-file-upload-modern .konfirmasi-file-label-modern .konfirmasi-file-info-modern span {
        display: block;
        font-weight: 600;
        color: #2c2e3f;
        font-size: 0.8rem;
        word-break: break-word;
    }

    .konfirmasi-file-upload-modern .konfirmasi-file-label-modern .konfirmasi-file-info-modern small {
        color: #6c7383;
        font-size: 0.65rem;
        display: block;
        margin-top: 2px;
    }

    .konfirmasi-file-upload-modern .konfirmasi-file-label-modern .konfirmasi-file-size {
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
        .konfirmasi-file-upload-modern .konfirmasi-file-label-modern .konfirmasi-file-size {
            margin-top: 0;
        }
    }

    /* ===== TINDAKAN SELANJUTNYA - MODERN CARD STYLE DARI AKAD ===== */
    .konfirmasi-tindakan-card {
        position: relative;
        margin-bottom: 1rem;
        width: 100%;
    }

    .konfirmasi-tindakan-card input[type="radio"] {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }

    .konfirmasi-tindakan-label {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 1.2rem 1rem;
        background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
        border: 2px solid #e9ecef;
        border-radius: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        min-height: 85px;
    }

    /* Hover effect */
    .konfirmasi-tindakan-label:hover {
        border-color: #9a55ff;
        background: linear-gradient(135deg, #f1f0ff, #f8f9fa);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(154, 85, 255, 0.15);
    }

    /* Selected state */
    .konfirmasi-tindakan-card input[type="radio"]:checked + .konfirmasi-tindakan-label {
        border-color: #9a55ff;
        background: linear-gradient(135deg, #f1f0ff, #e8e0ff);
        box-shadow: 0 5px 15px rgba(154, 85, 255, 0.2);
    }

    /* Icon styling */
    .konfirmasi-tindakan-icon {
        flex-shrink: 0;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    .konfirmasi-tindakan-icon i {
        font-size: 28px;
        color: #9a55ff;
    }

    /* Content styling */
    .konfirmasi-tindakan-content {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .konfirmasi-tindakan-title {
        font-size: 1rem;
        font-weight: 700;
        color: #2c2e3f;
        line-height: 1.3;
    }

    .konfirmasi-tindakan-desc {
        font-size: 0.8rem;
        color: #6c7383;
        line-height: 1.3;
    }

    /* Check icon (hidden by default) */
    .konfirmasi-tindakan-check {
        flex-shrink: 0;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .konfirmasi-tindakan-check i {
        font-size: 24px;
        color: #d0d4db;
        transition: all 0.2s ease;
    }

    /* Show check icon when selected */
    .konfirmasi-tindakan-card input[type="radio"]:checked + .konfirmasi-tindakan-label .konfirmasi-tindakan-check i {
        color: #9a55ff;
        transform: scale(1.1);
        filter: drop-shadow(0 4px 8px rgba(154, 85, 255, 0.3));
    }

    /* Touch-friendly sizing */
    @media (max-width: 768px) {
        .konfirmasi-tindakan-label {
            padding: 1rem;
            min-height: 90px;
        }

        .konfirmasi-tindakan-icon {
            width: 45px;
            height: 45px;
        }

        .konfirmasi-tindakan-icon i {
            font-size: 24px;
        }

        .konfirmasi-tindakan-title {
            font-size: 0.95rem;
        }

        .konfirmasi-tindakan-desc {
            font-size: 0.75rem;
        }
    }

    /* Animasi pulse saat selected */
    @keyframes konfirmasiTindakanPulse {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
        100% {
            transform: scale(1);
        }
    }

    .konfirmasi-tindakan-card input[type="radio"]:checked + .konfirmasi-tindakan-label .konfirmasi-tindakan-icon {
        animation: konfirmasiTindakanPulse 0.3s ease;
    }

    /* ===== STYLING BUTTON DARI VERIFIKASI KPR ===== */
    .btn-primary {
        background: linear-gradient(to right, #da8cff, #9a55ff) !important;
        color: #ffffff !important;
        border: none !important;
        padding: 0.5rem 1rem !important;
        border-radius: 8px !important;
        font-weight: 600 !important;
        transition: all 0.3s ease !important;
    }

    .btn-primary:hover {
        background: linear-gradient(to right, #c77cff, #8a45e6) !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 6px 16px rgba(154, 85, 255, 0.4) !important;
    }

    .btn-outline-secondary {
        background: transparent !important;
        border: 1px solid #e9ecef !important;
        color: #6c7383 !important;
        padding: 0.5rem 1rem !important;
        border-radius: 8px !important;
        font-weight: 600 !important;
        transition: all 0.3s ease !important;
    }

    .btn-outline-secondary:hover {
        background: linear-gradient(135deg, #f8f9fa, #f1f3f5) !important;
        color: #2c2e3f !important;
        border-color: #9a55ff !important;
        transform: translateY(-2px) !important;
    }

    .konfirmasi-btn {
        font-size: 0.8rem;
        padding: 0.5rem 1rem;
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
        .konfirmasi-btn {
            width: auto;
            padding: 0.5rem 1.2rem;
        }
    }

    .konfirmasi-btn-primary {
        background: linear-gradient(to right, #da8cff, #9a55ff);
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(154, 85, 255, 0.3);
    }

    .konfirmasi-btn-primary:hover {
        background: linear-gradient(to right, #c77cff, #8a45e6);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(154, 85, 255, 0.4);
    }

    .konfirmasi-btn-outline-secondary {
        background: transparent;
        border: 1px solid #e9ecef;
        color: #6c7383;
    }

    .konfirmasi-btn-outline-secondary:hover {
        background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
        color: #2c2e3f;
        border-color: #9a55ff;
        transform: translateY(-2px);
    }

    /* Badge styling */
    .badge {
        padding: 5px 10px;
        font-weight: 500;
        border-radius: 30px;
    }

    .badge.bg-success {
        background: linear-gradient(135deg, #28a745, #5cb85c) !important;
        color: white;
    }

    .badge.bg-danger {
        background: linear-gradient(135deg, #dc3545, #e4606d) !important;
        color: white;
    }

    .badge.bg-warning {
        background: linear-gradient(135deg, #ffc107, #ffdb6d) !important;
        color: #2c2e3f;
    }

    /* Table styling */
    .table th {
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #495057;
    }

    .table td {
        vertical-align: middle;
        padding: 0.75rem;
    }

    .table tbody tr:hover {
        background-color: #f8f9fa;
    }

    /* Timeline steps styling */
    .timeline-steps .step .step-icon {
        transition: all 0.3s ease;
    }
    .timeline-steps .step.completed .step-icon {
        background-color: #28a745 !important;
    }
    .timeline-steps .step.active .step-icon {
        background-color: #ffc107 !important;
        box-shadow: 0 0 0 3px rgba(255, 193, 7, 0.2);
    }
</style>

<div class="row">
    <div class="col-12">
        <!-- Header Info Customer -->
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap align-items-center gap-3">
                    <!-- Avatar -->
                    <div class="flex-shrink-0">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 50px; height: 50px;">
                            <i class="mdi mdi-account" style="font-size: 24px;"></i>
                        </div>
                    </div>

                    <!-- Info Customer -->
                    <div class="flex-grow-1">
                        <h4 class="mb-1">{{ $booking->customer->full_name ?? '-' }}</h4>
                        <p class="text-muted mb-0">Booking ID: {{ $booking->booking_code ?? '-' }}</p>
                    </div>

                    <!-- Info Unit -->
                    <div class="mt-3 mt-sm-0">
                        <div class="d-flex flex-wrap gap-3">
                            <div>
                                <small class="text-muted d-block">Unit</small>
                                <span class="fw-medium">{{ $booking->unit->unit_name ?? '-' }}</span>
                            </div>
                            <div>
                                <small class="text-muted d-block">Blok/No</small>
                                <span class="fw-medium">{{ $booking->unit->unit_code ?? '-' }}</span>
                            </div>
                            <div>
                                <small class="text-muted d-block">Harga Unit</small>
                                <span class="fw-medium text-primary">
                                    Rp {{ number_format($booking->unit->price ?? 0, 0, ',', '.') }}
                                </span>
                            </div>
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
                    Tahapan Verifikasi KPR
                </h5>

                <!-- Progress Bar -->
                <div class="mb-4">
                    <div class="d-flex flex-wrap justify-content-between mb-2">
                        <span class="text-muted">Progress Verifikasi</span>
                        <span class="text-primary">Tahap 2 dari 5</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 40%;" aria-valuenow="40"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                <!-- Timeline Steps -->
                <div class="timeline-steps">
                    <div class="row g-2 g-md-0">
                        <div class="col-4 col-md text-center mb-3 mb-md-0">
                            <div class="step completed">
                                <div class="step-icon bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                                    style="width: 35px; height: 35px;">
                                    <i class="mdi mdi-check" style="font-size: 18px;"></i>
                                </div>
                                <span class="d-block text-success small fw-medium">Diajukan</span>
                                <small class="text-muted d-none d-sm-block">
                                    {{ $booking->kprApplication->submitted_at ? \Carbon\Carbon::parse($booking->kprApplication->submitted_at)->translatedFormat('j F Y') : '-' }}
                                </small>
                            </div>
                        </div>
                        <div class="col-4 col-md text-center mb-3 mb-md-0">
                            <div class="step active">
                                <div class="step-icon bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                                    style="width: 35px; height: 35px;">
                                    <i class="mdi mdi-file-document" style="font-size: 18px;"></i>
                                </div>
                                <span class="d-block small fw-medium">Verifikasi</span>
                                <small class="text-muted d-none d-sm-block">Sedang Proses</small>
                            </div>
                        </div>
                        <div class="col-4 col-md text-center mb-3 mb-md-0">
                            <div class="step">
                                <div class="step-icon bg-light text-muted rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                                    style="width: 35px; height: 35px;">
                                    <i class="mdi mdi-home" style="font-size: 18px;"></i>
                                </div>
                                <span class="d-block text-muted small fw-medium">Survey</span>
                                <small class="text-muted d-none d-sm-block">Menunggu</small>
                            </div>
                        </div>
                        <div class="col-4 col-md text-center mt-2 mt-md-0">
                            <div class="step">
                                <div class="step-icon bg-light text-muted rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                                    style="width: 35px; height: 35px;">
                                    <i class="mdi mdi-handshake" style="font-size: 18px;"></i>
                                </div>
                                <span class="d-block text-muted small fw-medium">Akad</span>
                                <small class="text-muted d-none d-sm-block">Menunggu</small>
                            </div>
                        </div>
                        <div class="col-4 col-md text-center mt-2 mt-md-0">
                            <div class="step">
                                <div class="step-icon bg-light text-muted rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                                    style="width: 35px; height: 35px;">
                                    <i class="mdi mdi-cash" style="font-size: 18px;"></i>
                                </div>
                                <span class="d-block text-muted small fw-medium">Cair</span>
                                <small class="text-muted d-none d-sm-block">Menunggu</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kolom Kanan: Detail KPR -->
    <div class="col-12 col-lg-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="mdi mdi-bank me-2 text-primary"></i>
                    Detail KPR
                </h5>

                <div class="detail-info">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Bank Tujuan</span>
                        <span class="fw-medium">{{ $booking->kprApplication->bank->bank_name ?? '-' }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Jumlah Pinjaman</span>
                        <span class="fw-medium">
                            Rp {{ number_format($booking->kprApplication->jumlah_pinjaman ?? 0, 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Tenor</span>
                        <span class="fw-medium">{{ $booking->kprApplication->tenor ?? '-' }} Tahun</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Angsuran/bln</span>
                        <span class="fw-medium text-primary">
                            Rp {{ number_format($booking->kprApplication->estimasi_angsuran ?? 0, 0, ',', '.') }}
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
            </div>
        </div>
    </div>
</div>

<!-- Row Kelengkapan Dokumen -->
<div class="row mt-4">
    <div class="col-12 col-lg-8 mb-4 mb-lg-0">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="mdi mdi-file-document-multiple me-2 text-primary"></i>
                    Kelengkapan Dokumen
                </h5>

                @php
                    $allTypes = [
                        'ktp',
                        'kk',
                        'npwp',
                        'slip_gaji',
                        'rekening_koran',
                        'surat_nikah',
                        'sku',
                        'ktp_pasangan',
                    ];

                    $missingCount = collect($allTypes)
                        ->filter(function ($type) use ($booking) {
                            return !$booking->kprApplication->documents->where('type', $type)->first();
                        })
                        ->count();
                @endphp

                @if ($missingCount > 0)
                    <div class="konfirmasi-alert konfirmasi-alert-warning" role="alert">
                        <i class="mdi mdi-information-outline me-2"></i>
                        Masih ada {{ $missingCount }} dokumen yang perlu dilengkapi
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="bg-light">
                            <tr>
                                <th style="width:40%">Nama Dokumen</th>
                                <th style="width:25%">Status</th>
                                <th style="width:20%">Tanggal Upload</th>
                                <th style="width:15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allTypes as $type)
                                @php
                                    $doc = $booking->kprApplication->documents->where('type', $type)->first();
                                    $status = $doc ? 'Lengkap' : 'Kurang';
                                    $badge = $doc ? 'bg-success' : 'bg-danger';
                                    $date = $doc
                                        ? \Carbon\Carbon::parse($doc->created_at)->translatedFormat('d M Y')
                                        : '-';
                                @endphp
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-file-document-outline text-primary me-2"></i>
                                            <span>{{ strtoupper(str_replace('_', ' ', $type)) }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge {{ $badge }}">{{ $status }}</span>
                                    </td>
                                    <td>
                                        <small>{{ $date }}</small>
                                    </td>
                                    <td>
                                        @if ($doc)
                                            <a href="{{ asset('storage/' . $doc->path) }}" target="_blank"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                        @else
                                            <button class="btn btn-sm btn-outline-secondary" disabled>
                                                <i class="mdi mdi-eye-off"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="text-muted small mt-2 d-block d-sm-none">
                    <i class="mdi mdi-information-outline me-1"></i>
                    Geser tabel untuk melihat kolom lainnya
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="mdi mdi-information me-2 text-primary"></i>
                    Informasi Verifikasi
                </h5>

                <!-- Status Card -->
                @php
                    $lengkapCount = collect($allTypes)
                        ->filter(fn($type) => $booking->kprApplication->documents->where('type', $type)->first())
                        ->count();
                    $kurangCount = count($allTypes) - $lengkapCount;
                @endphp

                @if ($kurangCount > 0)
                    <div class="text-center mb-4">
                        <span class="badge bg-warning p-2" style="font-size: 14px;">
                            <i class="mdi mdi-progress-clock me-1"></i>
                            Menunggu Verifikasi Dokumen ({{ $kurangCount }} dokumen kurang)
                        </span>
                    </div>
                @else
                    <div class="text-center mb-4">
                        <span class="badge bg-success p-2" style="font-size: 14px;">
                            <i class="mdi mdi-check-circle-outline me-1"></i>
                            Semua Dokumen Lengkap
                        </span>
                    </div>
                @endif

                <!-- Ringkasan Dokumen -->
                <h6 class="mb-3 konfirmasi-text-primary">Status Dokumen</h6>
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Dokumen Lengkap</span>
                        <span class="fw-medium text-success">{{ $lengkapCount }} Dokumen</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Dokumen Kurang</span>
                        <span class="fw-medium text-danger">{{ $kurangCount }} Dokumen</span>
                    </div>
                </div>

                <hr class="my-3">

                <!-- Rekomendasi -->
                <h6 class="mb-3 konfirmasi-text-primary">Rekomendasi</h6>
                @if ($kurangCount > 0)
                    <div class="konfirmasi-alert konfirmasi-alert-warning py-2">
                        <i class="mdi mdi-information-outline me-2"></i>
                        Lengkapi {{ $kurangCount }} dokumen yang kurang sebelum verifikasi
                    </div>
                @else
                    <div class="konfirmasi-alert konfirmasi-alert-success py-2">
                        <i class="mdi mdi-check-circle-outline me-2"></i>
                        Semua dokumen lengkap, siap untuk verifikasi
                    </div>
                @endif

                <hr class="my-3">

                <!-- Timeline -->
                <h6 class="mb-3 konfirmasi-text-primary">Timeline Pengajuan</h6>
                <div class="konfirmasi-timeline">
                    <div class="konfirmasi-timeline-item">
                        <div class="konfirmasi-timeline-icon">
                            <i class="mdi mdi-check-circle text-success"></i>
                        </div>
                        <div class="konfirmasi-timeline-content">
                            <span class="konfirmasi-timeline-text">Pengajuan KPR</span>
                            <small class="konfirmasi-timeline-date">
                                {{ $booking->kprApplication->submitted_at ? \Carbon\Carbon::parse($booking->kprApplication->submitted_at)->translatedFormat('j F Y') : '-' }}
                            </small>
                        </div>
                    </div>
                    <div class="konfirmasi-timeline-item">
                        <div class="konfirmasi-timeline-icon">
                            <i class="mdi mdi-check-circle text-success"></i>
                        </div>
                        <div class="konfirmasi-timeline-content">
                            <span class="konfirmasi-timeline-text">Verifikasi Dokumen</span>
                            <small class="konfirmasi-timeline-date">Sedang Proses</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Row untuk Verifikasi KPR -->
<div class="row mt-4">
    <!-- Kolom Kiri: Form Verifikasi -->
    <div class="col-12 col-lg-8 mb-4 mb-lg-0">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="mdi mdi-help-circle me-2 text-primary"></i>
                    Verifikasi KPR
                </h5>

                <!-- Pilihan Status Verifikasi -->
                <div class="row mb-4">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <div class="card konfirmasi-card-option bg-success text-white" id="pilihSetuju">
                            <div class="card-body text-center py-4">
                                <i class="mdi mdi-check-decagram" style="font-size: 48px;"></i>
                                <h5 class="mt-3 text-white">VERIFIKASI DISETUJUI</h5>
                                <p class="mb-0 small">Lanjut ke tahap Survey</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card konfirmasi-card-option bg-danger text-white" id="pilihTolak">
                            <div class="card-body text-center py-4">
                                <i class="mdi mdi-close-octagon" style="font-size: 48px;"></i>
                                <h5 class="mt-3 text-white">VERIFIKASI DITOLAK</h5>
                                <p class="mb-0 small">Perbaiki dokumen / Tindakan lain</p>
                            </div>
                        </div>
                    </div>
                </div>

                <form action="{{ route('kpr.verifikasi.store', $booking->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Hidden input untuk status verifikasi -->
                    <input type="hidden" name="status_verifikasi" id="statusVerifikasiInput" value="">

                    <!-- FORM VERIFIKASI DISETUJUI (muncul jika pilih setuju) -->
                    <div id="formSetuju" style="display: none;">
                        <hr class="my-3">
                        <h6 class="mb-3 konfirmasi-text-primary">Form Persetujuan Verifikasi</h6>

                        <div class="konfirmasi-alert konfirmasi-alert-success" role="alert">
                            <i class="mdi mdi-check-circle me-2"></i>
                            <strong>VERIFIKASI DISETUJUI</strong> - Silakan lanjutkan ke tahap Survey
                        </div>

                        <div class="konfirmasi-form-group">
                            <label>Catatan Verifikasi</label>
                            <textarea class="konfirmasi-form-control" name="catatan_setuju" rows="3" placeholder="Contoh: Semua dokumen lengkap dan valid"></textarea>
                        </div>

                        <div class="konfirmasi-form-group">
                            <label>Upload Berita Acara Verifikasi (Opsional)</label>
                            <div class="konfirmasi-file-upload-modern">
                                <input type="file" name="berita_acara_setuju" accept=".jpg,.jpeg,.png,.pdf">
                                <div class="konfirmasi-file-label-modern">
                                    <i class="mdi mdi-cloud-upload"></i>
                                    <div class="konfirmasi-file-info-modern">
                                        <span>Upload Berita Acara</span>
                                        <small>Format: JPG, PNG, PDF (Max 5MB)</small>
                                    </div>
                                    <span class="konfirmasi-file-size"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- FORM VERIFIKASI DITOLAK (muncul jika pilih tolak) -->
                    <div id="formTolak" style="display: none;">
                        <hr class="my-3">
                        <h6 class="mb-3 konfirmasi-text-primary">Form Penolakan Verifikasi</h6>

                        <div class="konfirmasi-alert konfirmasi-alert-danger" role="alert">
                            <i class="mdi mdi-close-circle me-2"></i>
                            <strong>VERIFIKASI DITOLAK</strong> - Pilih tindakan selanjutnya
                        </div>

                        <div class="konfirmasi-form-group">
                            <label>Alasan Penolakan</label>
                            <select class="konfirmasi-form-control" name="alasan_tolak" id="alasanTolak">
                                <option value="">-- Pilih Alasan --</option>
                                <option value="Dokumen Tidak Lengkap">Dokumen Tidak Lengkap</option>
                                <option value="Dokumen Tidak Valid">Dokumen Tidak Valid</option>
                                <option value="KTP Tidak Jelas">KTP Tidak Jelas</option>
                                <option value="Slip Gaji Tidak Sesuai">Slip Gaji Tidak Sesuai</option>
                                <option value="Data Tidak Cocok">Data Tidak Cocok dengan KTP</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>

                        <div class="konfirmasi-form-group" id="alasanLainnya" style="display: none;">
                            <label>Tulis Alasan Lainnya</label>
                            <input type="text" class="konfirmasi-form-control" name="alasan_lainnya" placeholder="Contoh: Dokumen tidak sesuai ketentuan">
                        </div>

                        <div class="konfirmasi-form-group">
                            <label>Catatan untuk Customer</label>
                            <textarea class="konfirmasi-form-control" name="catatan_tolak" rows="3" placeholder="Berikan penjelasan detail mengapa ditolak..."></textarea>
                        </div>

                        <hr class="my-3">

                        <h6 class="mb-3 konfirmasi-text-primary">Tindakan Selanjutnya</h6>

                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <div class="konfirmasi-tindakan-card">
                                    <input type="radio" name="tindakan" id="tindakanLengkapi" value="Lengkapi Dokumen" checked>
                                    <label class="konfirmasi-tindakan-label" for="tindakanLengkapi">
                                        <div class="konfirmasi-tindakan-icon">
                                            <i class="mdi mdi-file-document-edit"></i>
                                        </div>
                                        <div class="konfirmasi-tindakan-content">
                                            <span class="konfirmasi-tindakan-title">Lengkapi Dokumen</span>
                                            <span class="konfirmasi-tindakan-desc">Customer diminta melengkapi dokumen</span>
                                        </div>
                                        <div class="konfirmasi-tindakan-check">
                                            <i class="mdi mdi-check-circle"></i>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="konfirmasi-tindakan-card">
                                    <input type="radio" name="tindakan" id="tindakanUlang" value="Ajukan ke Bank Lain">
                                    <label class="konfirmasi-tindakan-label" for="tindakanUlang">
                                        <div class="konfirmasi-tindakan-icon">
                                            <i class="mdi mdi-bank-transfer"></i>
                                        </div>
                                        <div class="konfirmasi-tindakan-content">
                                            <span class="konfirmasi-tindakan-title">Ajukan ke Bank Lain</span>
                                            <span class="konfirmasi-tindakan-desc">Pengajuan ulang KPR</span>
                                        </div>
                                        <div class="konfirmasi-tindakan-check">
                                            <i class="mdi mdi-check-circle"></i>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="konfirmasi-tindakan-card">
                                    <input type="radio" name="tindakan" id="tindakanCash" value="Pindah ke Cash">
                                    <label class="konfirmasi-tindakan-label" for="tindakanCash">
                                        <div class="konfirmasi-tindakan-icon">
                                            <i class="mdi mdi-cash-multiple"></i>
                                        </div>
                                        <div class="konfirmasi-tindakan-content">
                                            <span class="konfirmasi-tindakan-title">Pindah ke Cash</span>
                                            <span class="konfirmasi-tindakan-desc">Customer akan membayar tunai</span>
                                        </div>
                                        <div class="konfirmasi-tindakan-check">
                                            <i class="mdi mdi-check-circle"></i>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="konfirmasi-tindakan-card">
                                    <input type="radio" name="tindakan" id="tindakanBatal" value="Batalkan Transaksi">
                                    <label class="konfirmasi-tindakan-label" for="tindakanBatal">
                                        <div class="konfirmasi-tindakan-icon">
                                            <i class="mdi mdi-cancel"></i>
                                        </div>
                                        <div class="konfirmasi-tindakan-content">
                                            <span class="konfirmasi-tindakan-title">Batalkan Transaksi</span>
                                            <span class="konfirmasi-tindakan-desc">Customer batal beli (refund)</span>
                                        </div>
                                        <div class="konfirmasi-tindakan-check">
                                            <i class="mdi mdi-check-circle"></i>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="konfirmasi-tindakan-card">
                                    <input type="radio" name="tindakan" id="tindakanBanding" value="Banding Ulang">
                                    <label class="konfirmasi-tindakan-label" for="tindakanBanding">
                                        <div class="konfirmasi-tindakan-icon">
                                            <i class="mdi mdi-scale-balance"></i>
                                        </div>
                                        <div class="konfirmasi-tindakan-content">
                                            <span class="konfirmasi-tindakan-title">Banding Ulang</span>
                                            <span class="konfirmasi-tindakan-desc">Ajukan banding ke bank yang sama</span>
                                        </div>
                                        <div class="konfirmasi-tindakan-check">
                                            <i class="mdi mdi-check-circle"></i>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 d-flex justify-content-between">
                        <a href="{{ url('/marketing/kpr') }}" class="konfirmasi-btn konfirmasi-btn-outline-secondary">
                            <i class="mdi mdi-arrow-left me-2"></i>
                            Kembali
                        </a>

                        <button type="submit" class="konfirmasi-btn konfirmasi-btn-primary">
                            <i class="mdi mdi-content-save me-2"></i>
                            Submit Verifikasi
                        </button>
                    </div>
                </form>

                <!-- Informasi Tambahan untuk Mobile -->
                <div class="text-muted small mt-2 d-block d-sm-none">
                    <i class="mdi mdi-information-outline me-1"></i>
                    Geser untuk melihat konten lainnya
                </div>
            </div>
        </div>
    </div>

    <!-- Kolom Kanan: Info & Ringkasan (sudah di atas) -->
    <div class="col-12 col-lg-4">
        <!-- Konten sudah di atas, tidak perlu diulang -->
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Pilih Verifikasi Disetujui
    $('#pilihSetuju').click(function() {
        $('#formSetuju').slideDown();
        $('#formTolak').slideUp();
        $('#pilihSetuju').addClass('border border-white border-3');
        $('#pilihTolak').removeClass('border border-white border-3');
        $('#statusVerifikasiInput').val('disetujui');
    });

    // Pilih Verifikasi Ditolak
    $('#pilihTolak').click(function() {
        $('#formTolak').slideDown();
        $('#formSetuju').slideUp();
        $('#pilihTolak').addClass('border border-white border-3');
        $('#pilihSetuju').removeClass('border border-white border-3');
        $('#statusVerifikasiInput').val('ditolak');
    });

    // Tampilkan input alasan lainnya
    $('#alasanTolak').change(function() {
        if($(this).val() === 'Lainnya') {
            $('#alasanLainnya').slideDown();
        } else {
            $('#alasanLainnya').slideUp();
        }
    });

    // MODERN FILE UPLOAD - Menampilkan nama file dan ukuran
    $('.konfirmasi-file-upload-modern input[type="file"]').change(function(e) {
        const fileName = e.target.files[0]?.name;
        const fileSize = e.target.files[0]?.size;
        const label = $(this).closest('.konfirmasi-file-upload-modern').find('.konfirmasi-file-info-modern span');
        const sizeSpan = $(this).closest('.konfirmasi-file-upload-modern').find('.konfirmasi-file-size');

        if (fileName) {
            label.text(fileName.length > 30 ? fileName.substring(0, 30) + '...' : fileName);
            if (fileSize) {
                const sizeInMB = (fileSize / (1024 * 1024)).toFixed(2);
                sizeSpan.text(sizeInMB + ' MB');
            }
        } else {
            label.text('Upload File');
            sizeSpan.text('');
        }
    });
});
</script>
@endpush
