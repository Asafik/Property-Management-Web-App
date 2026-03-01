@extends('layouts.partial.app')

@section('title', 'Konfirmasi Akad Cash - Properti Management')

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
        .akad-form-group {
            margin-bottom: 1rem;
        }

        .akad-form-group label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #9a55ff !important;
            margin-bottom: 0.3rem;
            letter-spacing: 0.3px;
            font-family: 'Nunito', sans-serif;
            display: block;
        }

        .akad-form-control {
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 0.6rem 0.8rem;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            background-color: #ffffff;
            color: #2c2e3f;
            width: 100%;
        }

        .akad-form-control:focus {
            border-color: #9a55ff;
            box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.1);
            outline: none;
        }

        select.akad-form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%239a55ff' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 12px;
            padding-right: 2rem;
        }

        /* ===== INPUT GROUP STYLING ===== */
        .akad-input-group {
            display: flex;
            align-items: center;
        }

        .akad-input-group-prepend {
            margin-right: -1px;
        }

        .akad-input-group-text {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border: 1px solid #e9ecef;
            border-radius: 8px 0 0 8px;
            padding: 0.6rem 0.8rem;
            font-size: 0.9rem;
            color: #9a55ff;
            font-weight: 600;
        }

        .akad-input-group .akad-form-control:first-child {
            border-radius: 0 8px 8px 0;
        }

        .akad-input-group .akad-form-control:last-child {
            border-radius: 0 8px 8px 0;
        }

        /* ===== FILE UPLOAD MODERN ===== */
        .akad-file-upload-modern {
            position: relative;
            width: 100%;
        }

        .akad-file-upload-modern input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
            z-index: 2;
        }

        .akad-file-upload-modern .akad-file-label-modern {
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
            .akad-file-upload-modern .akad-file-label-modern {
                flex-direction: row;
                text-align: left;
                gap: 8px;
                padding: 0.75rem 1rem;
                min-height: auto;
            }
        }

        .akad-file-upload-modern:hover .akad-file-label-modern {
            border-color: #9a55ff;
            background: linear-gradient(135deg, #f1f0ff, #f8f9fa);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(154, 85, 255, 0.1);
        }

        .akad-file-upload-modern .akad-file-label-modern i {
            font-size: 1.6rem;
            color: #9a55ff;
            background: rgba(154, 85, 255, 0.1);
            padding: 8px;
            border-radius: 50%;
        }

        .akad-file-upload-modern .akad-file-label-modern .akad-file-info-modern {
            flex: 1;
            width: 100%;
        }

        .akad-file-upload-modern .akad-file-label-modern .akad-file-info-modern span {
            display: block;
            font-weight: 600;
            color: #2c2e3f;
            font-size: 0.8rem;
            word-break: break-word;
        }

        .akad-file-upload-modern .akad-file-label-modern .akad-file-info-modern small {
            color: #6c7383;
            font-size: 0.65rem;
            display: block;
            margin-top: 2px;
        }

        .akad-file-upload-modern .akad-file-label-modern .akad-file-size {
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
            .akad-file-upload-modern .akad-file-label-modern .akad-file-size {
                margin-top: 0;
            }
        }

        /* ===== ALERT STYLING ===== */
        .akad-alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        .akad-alert-success {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            border-left: 4px solid #28a745;
            color: #155724;
        }

        .akad-alert-warning {
            background: linear-gradient(135deg, #fff3cd, #ffeeba);
            border-left: 4px solid #ffc107;
            color: #856404;
        }

        .akad-alert-info {
            background: linear-gradient(135deg, #d1ecf1, #bee5eb);
            border-left: 4px solid #17a2b8;
            color: #0c5460;
        }

        .akad-alert-danger {
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
            border-left: 4px solid #dc3545;
            color: #721c24;
        }

        /* ===== OPTION CARDS ===== */
        .akad-option-card {
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .akad-option-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .akad-option-card.bg-success {
            background: linear-gradient(135deg, #28a745, #5cb85c) !important;
        }

        .akad-option-card.bg-danger {
            background: linear-gradient(135deg, #dc3545, #e4606d) !important;
        }

        .akad-option-card.bg-primary {
            background: linear-gradient(135deg, #9a55ff, #da8cff) !important;
        }

        /* ===== TINDAKAN CARDS ===== */
        .akad-tindakan-card {
            margin-bottom: 0.5rem;
            position: relative;
        }

        .akad-tindakan-card input[type="radio"] {
            position: absolute;
            opacity: 0;
        }

        .akad-tindakan-label {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem;
            background: white;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .akad-tindakan-card input[type="radio"]:checked+.akad-tindakan-label {
            border-color: #9a55ff;
            background: linear-gradient(135deg, #f9f7ff, #f2ecff);
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.1);
        }

        .akad-tindakan-card input[type="radio"]:checked+.akad-tindakan-label .akad-tindakan-check i {
            color: #9a55ff;
        }

        .akad-tindakan-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .akad-tindakan-icon i {
            font-size: 1.2rem;
            color: #9a55ff;
        }

        .akad-tindakan-content {
            flex: 1;
        }

        .akad-tindakan-title {
            display: block;
            font-weight: 600;
            color: #2c2e3f;
            font-size: 0.9rem;
        }

        .akad-tindakan-desc {
            display: block;
            font-size: 0.7rem;
            color: #6c7383;
        }

        .akad-tindakan-check i {
            font-size: 1.2rem;
            color: #a5b3cb;
            transition: all 0.2s ease;
        }

        /* ===== TIMELINE STYLING ===== */
        .akad-timeline {
            margin-top: 0.5rem;
        }

        .akad-timeline-item {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            margin-bottom: 0.75rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid #e9ecef;
        }

        .akad-timeline-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .akad-timeline-icon {
            width: 24px;
            text-align: center;
        }

        .akad-timeline-icon i {
            font-size: 1rem;
        }

        .akad-timeline-content {
            flex: 1;
        }

        .akad-timeline-text {
            display: block;
            font-size: 0.85rem;
            font-weight: 500;
            color: #2c2e3f;
        }

        .akad-timeline-date {
            display: block;
            font-size: 0.7rem;
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
        .akad-btn {
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
            .akad-btn {
                width: auto;
                padding: 0.6rem 1.2rem;
            }
        }

        .akad-btn-primary {
            background: linear-gradient(to right, #da8cff, #9a55ff);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.3);
        }

        .akad-btn-primary:hover {
            background: linear-gradient(to right, #c77cff, #8a45e6);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(154, 85, 255, 0.4);
        }

        .akad-btn-outline-secondary {
            background: transparent;
            border: 1px solid #6c757d;
            color: #6c757d;
        }

        .akad-btn-outline-secondary:hover {
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
                            <h4 class="mb-1 text-dark">{{ $booking->customer->full_name }}</h4>
                            <p class="text-muted mb-0"> Kode : {{ $booking->booking_code }}</p>
                        </div>

                        <!-- Info Unit -->
                        <div class="mt-3 mt-sm-0">
                            <div class="d-flex flex-wrap gap-3">
                                <div>
                                    <small class="text-muted d-block">Unit</small>
                                    <span class="fw-medium">{{ $booking->unit->LandBank->name }} -
                                        {{ $booking->unit->type }}</span>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Blok/No</small>
                                    <span class="fw-medium">{{ $booking->unit->unit_code }}</span>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Harga Unit</small>
                                    <span class="fw-medium text-primary">Rp
                                        {{ number_format($booking->unit->price, 0, ',', '.') }}</span>
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
                            Tahapan Akad Cash
                        </h5>

                        <!-- Progress Bar -->
                        <div class="mb-4">
                            <div class="d-flex flex-wrap justify-content-between mb-2">
                                <span class="text-muted">Progress Akad</span>
                                <span class="badge badge-warning">Menunggu Konfirmasi Akad</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 70%;"
                                    aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>

                        <!-- Timeline Steps -->
                        @php
                            $steps = [
                                'active' => 'Booking',
                                'cash_process' => 'Pelunasan',
                                'akad' => 'Akad',
                                'completed' => 'Serah Terima',
                            ];

                            $currentStatus = $booking->status;
                            $statusOrder = array_keys($steps);
                            $currentIndex = array_search($currentStatus, $statusOrder);
                        @endphp

                        <div class="row g-2 g-md-0">
                         @foreach ($steps as $key => $label)
    @php
        $index = array_search($key, $statusOrder);

        // Step dianggap selesai jika index < currentIndex
        $isCompleted = $index < $currentIndex;

        // Step aktif jika index == currentIndex
        $isActive = $index == $currentIndex;

        // Khusus: jika step 'akad' dan status 'akad', langsung completed
        if ($key == 'akad' && $booking->status === 'akad') {
            $isCompleted = true;
            $isActive = false;
        }
    @endphp

    <div class="col text-center mb-3 mb-md-0">
        <div class="step {{ $isCompleted ? 'completed' : ($isActive ? 'active' : '') }}">
            <div class="step-icon 
                {{ $isCompleted ? 'bg-success text-white' : ($isActive ? 'bg-warning text-white' : 'bg-light text-muted') }}
                rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                style="width: 35px; height: 35px;">

                @if ($isCompleted)
                    <i class="mdi mdi-check"></i>
                @elseif($isActive)
                    @if($key == 'akad')
                        <i class="mdi mdi-handshake"></i>
                    @elseif($key == 'completed')
                        <i class="mdi mdi-certificate"></i>
                    @else
                        <i class="mdi mdi-cash"></i>
                    @endif
                @else
                    <i class="mdi mdi-cash"></i>
                @endif
            </div>

            <span class="d-block 
                {{ $isCompleted ? 'text-success' : ($isActive ? 'text-warning' : 'text-muted') }}
                small fw-medium">
                {{ $label }}
            </span>

            <small class="text-muted d-none d-sm-block">
                @if ($key == 'active' && $booking->booking_date)
                    {{ $booking->booking_date->format('d M Y') }}
                @elseif($isCompleted || $isActive)
                    {{ $booking->updated_at->format('d M Y') }}
                @else
                    Menunggu
                @endif
            </small>
        </div>
    </div>
@endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Detail Pembayaran -->
            <div class="col-12 col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="mdi mdi-cash-multiple me-2 text-primary"></i>
                            Detail Pembayaran
                        </h5>

                        <div class="detail-info">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Harga Unit</span>
                                <span class="fw-medium">Rp {{ number_format($booking->unit->price, 0, ',', '.') }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Diskon / Negosiasi</span>
                                <span class="fw-medium text-success">Rp
                                    {{ number_format($booking->unit->harga_nego, 0, ',', '.') }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Harga Final</span>
                                <span class="fw-medium">
                                    Rp {{ number_format($booking->unit->price - $booking->unit->harga_nego, 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Booking Fee</span>
                                <span class="fw-medium">Rp {{ number_format($booking->booking_fee, 0, ',', '.') }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Status Pembayaran</span>
                                @if ($booking->finalPayment?->type === 'pelunasan')
                                    <span class="badge bg-success text-dark fw-medium">Lunas</span>
                                @elseif($booking->finalPayment?->type)
                                    <span class="badge bg-warning">{{ $booking->finalPayment->type }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
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
                            <span
                                class="badge {{ $booking->purchase_type === 'cash' ? 'bg-success' : ($booking->purchase_type === 'kpr' ? 'bg-primary' : 'bg-secondary') }}">
                                {{ $booking->purchase_type === 'cash' ? 'Cash' : ($booking->purchase_type === 'kpr' ? 'KPR' : '-') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('akad.cash.store', $booking->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Row untuk Konfirmasi Akad -->
            <div class="row mt-4">
                <!-- Kolom Kiri: Form Konfirmasi Akad -->
                <div class="col-12 col-lg-8 mb-4 mb-lg-0">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="mdi mdi-handshake me-2 text-primary"></i>
                                Konfirmasi Akad Cash
                            </h5>

                            <!-- Alert Info -->
                            <div class="akad-alert akad-alert-warning" role="alert">
                                <i class="mdi mdi-information-outline me-2"></i>
                                Konfirmasi bahwa proses akad telah selesai dilakukan.
                            </div>

                            <!-- Pilihan Status Akad -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="card akad-option-card bg-success text-white" id="pilihSelesai">
                                        <div class="card-body text-center py-4">
                                            <i class="mdi mdi-check-decagram" style="font-size: 48px;"></i>
                                            <h5 class="mt-3 text-white">AKAD SELESAI</h5>
                                            <p class="mb-0 small">Lanjut ke proses Serah Terima</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card akad-option-card bg-danger text-white" id="pilihBatal">
                                        <div class="card-body text-center py-4">
                                            <i class="mdi mdi-close-octagon" style="font-size: 48px;"></i>
                                            <h5 class="mt-3 text-white">AKAD BATAL</h5>
                                            <p class="mb-0 small">Pembatalan transaksi</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- FORM AKAD SELESAI -->
                            <div id="formSelesai" style="display: none;">
                                <hr class="my-3">
                                <h6 class="mb-3 text-primary">Form Akad Selesai</h6>

                                <div class="akad-alert akad-alert-success" role="alert">
                                    <i class="mdi mdi-check-circle me-2"></i>
                                    <strong>AKAD SELESAI</strong> - Lengkapi data akad di bawah ini
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="akad-form-group">
                                            <label>No. Akad</label>
                                            <input type="text" name="no_akad" class="akad-form-control"
                                                value="AKAD/CASH/2025/002">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="akad-form-group">
                                            <label>Tanggal Akad</label>
                                            <input type="date" name="tanggal_akad" class="akad-form-control"
                                                value="2025-02-25">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="akad-form-group">
                                            <label>Total Pembayaran</label>
                                            <div class="akad-input-group">
                                                <div class="akad-input-group-prepend">
                                                    <span class="akad-input-group-text">Rp</span>
                                                </div>
                                                <input type="text" class="akad-form-control" value="435.000.000"
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="akad-form-group">
                                            <label>Status Pembayaran</label>
                                            <select name="status_pembayaran" class="akad-form-control">
                                                <option value="lunas" selected>Lunas</option>
                                                <option value="bertahap">Bertahap (Belum Lunas)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Upload Dokumen Akad -->
                                <div class="akad-form-group">
                                    <label>Upload Dokumen Akad</label>
                                    <input type="file" name="dokumen" class="akad-form-control"
                                        accept=".jpg,.jpeg,.png,.pdf">
                                </div>

                                <div class="akad-form-group">
                                    <label>Catatan Akad</label>
                                    <textarea name="catatan" class="akad-form-control" rows="2" placeholder="Catatan proses akad...">Akad selesai, pembayaran lunas</textarea>
                                </div>
                            </div>

                            <!-- FORM AKAD BATAL -->
                            <div id="formBatal" style="display: none;">
                                <hr class="my-3">
                                <h6 class="mb-3 text-primary">Form Pembatalan Akad</h6>

                                <div class="akad-alert akad-alert-danger" role="alert">
                                    <i class="mdi mdi-close-circle me-2"></i>
                                    <strong>AKAD BATAL</strong> - Pilih alasan pembatalan
                                </div>

                                <div class="akad-form-group">
                                    <label>Alasan Pembatalan</label>
                                    <select name="alasan_batal" id="alasanBatal" class="akad-form-control">
                                        <option value="">-- Pilih Alasan --</option>
                                        <option value="customer batal">Customer Batal Beli</option>
                                        <option value="dana tidak cukup">Dana Tidak Cukup</option>
                                        <option value="masalah dokumen">Masalah Dokumen</option>
                                        <option value="mengundurkan diri">Customer Mengundurkan Diri</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>

                                <div class="akad-form-group" id="alasanLainnya" style="display: none;">
                                    <label>Tulis Alasan Lainnya</label>
                                    <input type="text" name="alasan_lainnya" class="akad-form-control"
                                        placeholder="Contoh: Masalah internal">
                                </div>

                                <div class="akad-form-group">
                                    <label>Catatan Pembatalan</label>
                                    <textarea name="catatan" class="akad-form-control" rows="2" placeholder="Detail pembatalan..."></textarea>
                                </div>

                                <hr class="my-3">
                                <h6 class="mb-3 text-primary">Tindakan Selanjutnya</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="akad-tindakan-card">
                                            <input type="radio" name="tindakan" id="tindakanRefund" value="refund"
                                                checked>
                                            <label class="akad-tindakan-label" for="tindakanRefund">
                                                <div class="akad-tindakan-icon"><i class="mdi mdi-cash-refund"></i></div>
                                                <div class="akad-tindakan-content">
                                                    <span class="akad-tindakan-title">Refund DP</span>
                                                    <span class="akad-tindakan-desc">Kembalikan uang muka</span>
                                                </div>
                                                <div class="akad-tindakan-check"><i class="mdi mdi-check-circle"></i>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="akad-tindakan-card">
                                            <input type="radio" name="tindakan" id="tindakanHangus" value="hangus">
                                            <label class="akad-tindakan-label" for="tindakanHangus">
                                                <div class="akad-tindakan-icon"><i class="mdi mdi-cancel"></i></div>
                                                <div class="akad-tindakan-content">
                                                    <span class="akad-tindakan-title">DP Hangus</span>
                                                    <span class="akad-tindakan-desc">Sesuai perjanjian</span>
                                                </div>
                                                <div class="akad-tindakan-check"><i class="mdi mdi-check-circle"></i>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tombol Submit -->
                            <div class="mt-3">
                                <button type="submit" class="akad-btn akad-btn-primary w-100">
                                    <i class="mdi mdi-content-save me-2"></i>
                                    Simpan Konfirmasi
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan: Info & Ringkasan (tidak ikut form) -->
                <div class="col-12 col-lg-4">
                    <div class="card h-100">
                       <div class="card-body">
    <h5 class="card-title"><i class="mdi mdi-information me-2 text-primary"></i>Informasi Akad</h5>

    @php
        $totalDibayar = $booking->payments->sum('amount');
        $sisaPembayaran = $booking->unit->price - $totalDibayar;
        $statusLunas = $sisaPembayaran <= 0;
    @endphp

    <div class="d-flex justify-content-between mb-2">
        <span class="text-muted">Total Dibayar</span>
        <span class="fw-medium">Rp {{ number_format($totalDibayar, 0, ',', '.') }}</span>
    </div>

    <div class="d-flex justify-content-between mb-2">
        <span class="text-muted">Sisa Pembayaran</span>
        <span class="fw-medium text-primary">Rp {{ number_format(max($sisaPembayaran, 0), 0, ',', '.') }}</span>
    </div>

    <div class="d-flex justify-content-between mb-2">
        <span class="text-muted">Status</span>
        <span class="fw-medium">
            @if ($statusLunas)
                <span class="badge bg-success">Lunas</span>
            @else
                <span class="badge bg-warning">Belum Lunas</span>
            @endif
        </span>
    </div>

    <!-- Tombol Serah Terima Unit -->
    @if ($booking->status === 'akad')
        <div class="mt-3">
            <a href="{{ route('booking.serah-terima', $booking->id) }}" 
               class="btn btn-primary w-100">
               <i class="mdi mdi-key me-1"></i> Serah Terima Unit
            </a>
        </div>
    @endif
</div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                // Pilih Akad Selesai
                $('#pilihSelesai').click(function() {
                    $('#formSelesai').slideDown();
                    $('#formBatal').slideUp();
                    $('#pilihSelesai').addClass('border border-white border-3');
                    $('#pilihBatal').removeClass('border border-white border-3');
                });

                // Pilih Akad Batal
                $('#pilihBatal').click(function() {
                    $('#formBatal').slideDown();
                    $('#formSelesai').slideUp();
                    $('#pilihBatal').addClass('border border-white border-3');
                    $('#pilihSelesai').removeClass('border border-white border-3');
                });

                // Tampilkan input alasan lainnya
                $('#alasanBatal').change(function() {
                    if ($(this).val() === 'Lainnya') {
                        $('#alasanLainnya').slideDown();
                    } else {
                        $('#alasanLainnya').slideUp();
                    }
                });

                // MODERN FILE UPLOAD - Menampilkan nama file dan ukuran
                $('#uploadAkad').change(function(e) {
                    const fileName = e.target.files[0]?.name;
                    const fileSize = e.target.files[0]?.size;
                    const label = $(this).closest('.akad-file-upload-modern').find(
                        '.akad-file-info-modern span');
                    const sizeSpan = $(this).closest('.akad-file-upload-modern').find('.akad-file-size');

                    if (fileName) {
                        // Tampilkan nama file (potong jika terlalu panjang)
                        label.text(fileName.length > 30 ? fileName.substring(0, 30) + '...' : fileName);

                        // Hitung dan tampilkan ukuran file dalam MB
                        if (fileSize) {
                            const sizeInMB = (fileSize / (1024 * 1024)).toFixed(2);
                            sizeSpan.text(sizeInMB + ' MB');
                        }
                    } else {
                        // Reset ke teks awal jika tidak ada file
                        label.text('Upload Dokumen Akad');
                        sizeSpan.text('');
                    }
                });

                // Format Rupiah untuk input harga
                $('input[value*="000"]').on('input', function() {
                    let nilai = this.value.replace(/\D/g, '');
                    if (nilai) {
                        let rupiah = new Intl.NumberFormat('id-ID').format(nilai);
                        this.value = rupiah;
                    }
                });
            });
        </script>
    @endpush
@endsection
