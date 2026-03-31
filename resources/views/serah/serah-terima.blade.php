@extends('layouts.partial.app')

@section('title', 'Serah Terima Unit - Properti Management')

@section('content')
    <style>
        /* Gunakan CSS global transaksi.css sebisa mungkin. */
        /* Tambahkan hanya yang spesifik halaman ini. */

        .jenis-badge {
            background: linear-gradient(135deg, #ebf9eb, #d1f3d1);
            color: #28a745;
            border: 1px solid #9ce0a6;
            display: inline-flex;
            align-items: center;
            padding: 0.35rem 0.85rem;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 700;
            gap: 6px;
        }

        .jenis-badge i {
            font-size: 0.95rem;
        }

        .payment-method-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.15rem 0.4rem;
            border-radius: 4px;
            font-size: 0.7rem;
            font-weight: 600;
            gap: 3px;
            white-space: nowrap;
            max-width: 100px;
        }

        .payment-method-badge i {
            font-size: 0.75rem;
        }

        .header-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.3rem 0.7rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            gap: 4px;
            white-space: nowrap;
        }

        .header-badge i {
            font-size: 0.8rem;
        }

        .serah-form-group {
            margin-bottom: 1rem;
        }

        .serah-form-label {
            display: block;
            font-size: 0.86rem;
            font-weight: 700;
            color: #2c2e3f;
            margin-bottom: 0.45rem;
        }

        .serah-form-control {
            width: 100%;
            border: 1px solid #e6e8ef;
            border-radius: 14px;
            padding: 0.85rem 0.95rem;
            font-size: 0.9rem;
            color: #2c2e3f;
            transition: all 0.2s ease;
            background: #fff;
        }

        .serah-form-control:focus {
            border-color: #c6a6ff;
            box-shadow: 0 0 0 4px rgba(154, 85, 255, 0.1);
            outline: none;
        }

        select.serah-form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%239a55ff' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.9rem center;
            background-size: 14px;
            padding-right: 2.5rem;
        }

        .serah-checklist-wrapper {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .serah-checklist-item {
            position: relative;
        }

        .serah-checklist-item .form-check,
        .serah-doc-item .form-check {
            margin: 0;
            padding: 0;
        }

        .serah-checklist-item input[type="checkbox"],
        .serah-doc-item input[type="checkbox"] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .serah-checklist-item .check-label {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 1rem;
            background: #fff;
            border: 2px solid #ebe7f2;
            border-radius: 16px;
            cursor: pointer;
            transition: all 0.25s ease;
            min-height: 84px;
        }

        .serah-checklist-item .check-label:hover {
            border-color: #cab0ff;
            background: #faf7ff;
            transform: translateY(-2px);
        }

        .serah-checklist-item input[type="checkbox"]:checked + .check-label {
            border-color: #9a55ff;
            background: #f7f2ff;
            box-shadow: inset 0 0 0 1px rgba(154, 85, 255, 0.05);
        }

        .check-icon {
            width: 42px;
            height: 42px;
            border-radius: 14px;
            background: #f4ecff;
            color: #bdb5cf;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: all 0.25s ease;
        }

        .check-icon i {
            font-size: 1.3rem;
        }

        .serah-checklist-item input[type="checkbox"]:checked + .check-label .check-icon {
            color: #9a55ff;
            background: #ede1ff;
        }

        .check-text {
            flex: 1;
            font-size: 0.88rem;
            font-weight: 700;
            color: #2c2e3f;
            line-height: 1.45;
        }

        .serah-doc-wrapper {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .serah-doc-item {
            position: relative;
        }

        .serah-doc-item .doc-label {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0.95rem 1rem;
            background: #fff;
            border: 1px solid #ebe7f2;
            border-radius: 14px;
            cursor: pointer;
            transition: all 0.25s ease;
        }

        .serah-doc-item .doc-label:hover {
            border-color: #cab0ff;
            background: #faf7ff;
            transform: translateX(4px);
        }

        .serah-doc-item input[type="checkbox"]:checked + .doc-label {
            border-color: #9a55ff;
            background: #f7f2ff;
        }

        .doc-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: #f4ecff;
            color: #9a55ff;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .doc-icon i {
            font-size: 1.2rem;
        }

        .doc-text {
            flex: 1;
            font-weight: 700;
            color: #2c2e3f;
            font-size: 0.88rem;
        }

        .doc-badge {
            background: linear-gradient(135deg, #ffc107, #ffdb6d);
            color: #2c2e3f;
            padding: 0.3rem 0.65rem;
            border-radius: 999px;
            font-size: 0.7rem;
            font-weight: 700;
            white-space: nowrap;
        }

        .serah-doc-item input[type="checkbox"]:checked + .doc-label .doc-badge {
            background: linear-gradient(135deg, #9a55ff, #da8cff);
            color: #fff;
        }

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

        .serah-btn {
            border: none;
            border-radius: 12px;
            font-size: 0.9rem;
            font-weight: 700;
            padding: 0.82rem 1.2rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.25s ease;
            cursor: pointer;
            width: 100%;
        }

        .serah-btn:hover {
            transform: translateY(-1px);
            text-decoration: none;
        }

        .serah-btn-success {
            background: linear-gradient(90deg, #28a745, #5cb85c);
            color: #fff;
            box-shadow: 0 8px 18px rgba(40, 167, 69, 0.22);
        }

        .serah-btn-success:hover {
            color: #fff;
            box-shadow: 0 12px 24px rgba(40, 167, 69, 0.28);
        }

        .approval-check-green .check-label {
            border-color: #d7eadf;
            background: #fff;
        }

        .approval-check-green .check-label:hover {
            border-color: #7bd3a6;
            background: #f6fcf8;
        }

        .approval-check-green .check-icon {
            background: #edf9f3;
            color: #a7b3ad;
        }

        .approval-check-green input[type="checkbox"]:checked + .check-label {
            border-color: #7bd3a6;
            background: #edf9f3;
            box-shadow: inset 0 0 0 1px rgba(34, 160, 107, 0.05);
        }

        .approval-check-green input[type="checkbox"]:checked + .check-label .check-icon {
            background: #d9f3e6;
            color: #22a06b;
        }

        .approval-check-green input[type="checkbox"]:checked + .check-label .check-text {
            color: #146c43;
        }

        @media (max-width: 767.98px) {
            .serah-checklist-wrapper { grid-template-columns: 1fr; }
        }
    </style>

    <div class="transaksi-page">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="customer-header d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="customer-avatar">
                                    <i class="mdi mdi-account text-white" style="font-size: 2.2rem;"></i>
                                </div>
                                <div>
                                    <h4 class="customer-name mb-1 d-flex align-items-center gap-2">
                                        {{ $booking->customer->full_name ?? '-' }}
                                        @php
                                            $jenis = strtolower($booking->unit->jenis ?? '');
                                            $badgeClass = $jenis == 'subsidi' ? 'badge-gradient-success' : ($jenis == 'komersil' ? 'badge-gradient-primary' : 'badge-gradient-secondary');
                                            $icon = $jenis == 'subsidi' ? 'mdi-home-assistant' : ($jenis == 'komersil' ? 'mdi-office-building' : 'mdi-help-circle-outline');
                                        @endphp
                                        <span class="header-badge {{ $badgeClass }}">
                                            <i class="mdi {{ $icon }}"></i>
                                            {{ strtoupper($booking->unit->jenis ?? '-') }}
                                        </span>
                                    </h4>
                                    <p class="customer-booking mb-0">Id Booking: {{ $booking->booking_code ?? '-' }}</p>
                                </div>
                            </div>

                            <div class="customer-unit-info">
                                <div class="info-item">
                                     <small>Nama - Unit</small>
                                    <span>{{ $booking->unit->unit_name ?? $booking->unit->landBank->name ?? '-' }} - {{ $booking->unit->unit_code ?? '-' }}</span>
                                </div>
                                <div class="info-item">
                                    <small>Tipe</small>
                                    <span>{{ $booking->unit->type ?? '-' }}</span>
                                </div>
                                <div class="info-item">
                                    <small>Harga Unit</small>
                                    <span class="text-primary fw-bold">Rp {{ number_format($booking->unit->price ?? 0, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Progress & Summary --}}
        <div class="row mt-4">
            <div class="col-12 col-lg-8 mb-4 mb-lg-0">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="transaksi-section-title">
                            <i class="mdi mdi-timeline-text"></i>
                            <span>Tahapan Serah Terima Unit</span>
                        </div>

                        @php
                            $jenis = strtolower($booking->unit->jenis ?? '');

                            // Untuk Cash: 6 steps - Booking, Pelunasan, Persiapan Legal, Pembangunan, Akad, Serah Terima
                            // Untuk KPR: 6 steps - Booking, Verifikasi, Pembangunan, Akad, Survey, Serah Terima
                            $isKpr = strtolower($booking->purchase_type ?? '') == 'kpr';
                            $totalSteps = 6;

                            // Determine current step based on booking status
                            $bookingDone = !empty($booking->booking_date);
                            $verifikasiDone = !empty($booking->status_verifikasi) && $booking->status_verifikasi == 'approved';
                            $pembangunanDone = ($booking->status_pembangunan ?? 0) == 1;
                            $akadDone = ($booking->status_akad ?? 0) == 1;
                            $surveyDone = ($booking->status_survey ?? 0) == 1;
                            $serahTerimaDone = ($booking->status_serahterima ?? 0) == 1 || ($booking->status ?? '') == 'completed' || !empty($booking->serah_terima_date);

                            // Halaman ini adalah tahap Serah Terima (step terakhir), bar selalu penuh
                            $currentStep = $totalSteps;
                            $progressWidth = 100;
                            $stepStyle = 'style="grid-template-columns: repeat(' . $totalSteps . ', 1fr);"';
                        @endphp

                        <div class="transaksi-progress-top">
                            <span class="transaksi-muted">Progress Transaksi</span>
                            <span>Tahap {{ $currentStep }} dari {{ $totalSteps }}</span>
                        </div>

                        <div class="transaksi-progress">
                            <div class="transaksi-progress-bar" style="width: {{ $progressWidth }}%;"></div>
                        </div>

                        @if($isKpr)
                        <div class="transaksi-steps" {!! $stepStyle !!}>
                            <div class="transaksi-step completed">
                                <div class="transaksi-step-icon">
                                    <i class="mdi mdi-check"></i>
                                </div>
                                <span class="transaksi-step-title">Booking</span>
                                <small>{{ $booking->booking_date ? \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('d F Y') : '-' }}</small>
                            </div>

                            <div class="transaksi-step completed">
                                <div class="transaksi-step-icon">
                                    <i class="mdi mdi-check"></i>
                                </div>
                                <span class="transaksi-step-title">Verifikasi</span>
                                <small>Selesai</small>
                            </div>

                            <div class="transaksi-step completed">
                                <div class="transaksi-step-icon">
                                    <i class="mdi mdi-check"></i>
                                </div>
                                <span class="transaksi-step-title">Pembangunan</span>
                                <small>Selesai</small>
                            </div>

                            <div class="transaksi-step completed">
                                <div class="transaksi-step-icon">
                                    <i class="mdi mdi-check"></i>
                                </div>
                                <span class="transaksi-step-title">Akad</span>
                                <small>Selesai</small>
                            </div>

                            <div class="transaksi-step completed">
                                <div class="transaksi-step-icon">
                                    <i class="mdi mdi-check"></i>
                                </div>
                                <span class="transaksi-step-title">Survey</span>
                                <small>Selesai</small>
                            </div>

                            <div class="transaksi-step {{ $serahTerimaDone ? 'completed' : 'active' }}">
                                <div class="transaksi-step-icon">
                                    @if($serahTerimaDone)
                                        <i class="mdi mdi-check"></i>
                                    @else
                                        <i class="mdi mdi-key"></i>
                                    @endif
                                </div>
                                <span class="transaksi-step-title">Serah Terima</span>
                                <small>{{ $serahTerimaDone ? ($booking->serah_terima_date ? \Carbon\Carbon::parse($booking->serah_terima_date)->translatedFormat('d F Y') : 'Selesai') : 'Dalam Proses' }}</small>
                            </div>
                        </div>
                        @else
                        <div class="transaksi-steps" {!! $stepStyle !!}>
                            <div class="transaksi-step completed">
                                <div class="transaksi-step-icon">
                                    <i class="mdi mdi-check"></i>
                                </div>
                                <span class="transaksi-step-title">Booking</span>
                                <small>{{ $booking->booking_date ? \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('d F Y') : '-' }}</small>
                            </div>

                            <div class="transaksi-step completed">
                                <div class="transaksi-step-icon">
                                    <i class="mdi mdi-check"></i>
                                </div>
                                <span class="transaksi-step-title">Pelunasan</span>
                                <small>Selesai</small>
                            </div>

                            <div class="transaksi-step completed">
                                <div class="transaksi-step-icon">
                                    <i class="mdi mdi-check"></i>
                                </div>
                                <span class="transaksi-step-title">Persiapan Legal</span>
                                <small>Selesai</small>
                            </div>

                            <div class="transaksi-step completed">
                                <div class="transaksi-step-icon">
                                    <i class="mdi mdi-check"></i>
                                </div>
                                <span class="transaksi-step-title">Pembangunan</span>
                                <small>Selesai</small>
                            </div>

                            <div class="transaksi-step completed">
                                <div class="transaksi-step-icon">
                                    <i class="mdi mdi-check"></i>
                                </div>
                                <span class="transaksi-step-title">Akad</span>
                                <small>Selesai</small>
                            </div>

                            <div class="transaksi-step {{ $serahTerimaDone ? 'completed' : 'active' }}">
                                <div class="transaksi-step-icon">
                                    @if($serahTerimaDone)
                                        <i class="mdi mdi-check"></i>
                                    @else
                                        <i class="mdi mdi-key"></i>
                                    @endif
                                </div>
                                <span class="transaksi-step-title">Serah Terima</span>
                                <small>{{ $serahTerimaDone ? ($booking->serah_terima_date ? \Carbon\Carbon::parse($booking->serah_terima_date)->translatedFormat('d F Y') : 'Selesai') : 'Dalam Proses' }}</small>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4 mb-4 mb-lg-0">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="transaksi-section-title">
                            <i class="mdi mdi-cash-multiple"></i>
                            <span>Status Pembayaran</span>
                        </div>

                        <div class="transaksi-detail-list">
                            @if(in_array(strtolower($booking->purchase_type ?? ''), ['cash', 'cash_tempo']))
                                @php
                                    $hargaUnit = $booking->unit->price ?? 0;
                                    $hargaNego = (!empty($booking->harga_nego) && $booking->harga_nego > 0) ? $booking->harga_nego : $hargaUnit;
                                    $diskon = max(0, $hargaUnit - $hargaNego);
                                    $bookingFee = $booking->booking_fee ?? 0;
                                    $sisaPembayaran = max(0, $hargaNego - $bookingFee);
                                @endphp
                                <div class="transaksi-detail-item">
                                    <span>Harga Unit</span>
                                    <span>Rp {{ number_format($hargaUnit, 0, ',', '.') }}</span>
                                </div>
                                @if(strtolower($booking->purchase_type) != 'cash_tempo')
                                <div class="transaksi-detail-item">
                                    <span>Diskon / Negosiasi</span>
                                    <span class="highlight">- Rp {{ number_format($diskon, 0, ',', '.') }}</span>
                                </div>
                                @endif
                                <div class="transaksi-detail-item">
                                    <span>Harga Final</span>
                                    <span class="highlight">Rp {{ number_format($hargaNego, 0, ',', '.') }}</span>
                                </div>
                                <div class="transaksi-detail-item">
                                    <span>Booking Fee</span>
                                    <span>Rp {{ number_format($bookingFee, 0, ',', '.') }}</span>
                                </div>
                                <div class="transaksi-detail-item">
                                    <span>Sisa Pembayaran</span>
                                    <span class="highlight">Rp {{ number_format($sisaPembayaran, 0, ',', '.') }}</span>
                                </div>
                                <div class="transaksi-detail-item mt-2 align-items-center">
                                    <span>Status Pembayaran</span>
                                    <div class="ms-auto text-end" style="flex: 1;">
                                        <span class="badge bg-success text-white">
                                            <i class="mdi mdi-check-circle-outline me-1"></i>Lunas
                                        </span>
                                    </div>
                                </div>
                                <div class="transaksi-detail-item mt-2 align-items-center">
                                    <span>Metode Pembayaran</span>
                                    <div class="ms-auto text-end" style="flex: 1;">
                                        <span class="badge bg-success text-white">
                                            <i class="mdi mdi-cash me-1"></i>{{ strtolower($booking->purchase_type) == 'cash' ? 'Cash Keras' : 'Cash Tempo' }}
                                        </span>
                                    </div>
                                </div>
                            @else
                                <div class="transaksi-detail-item">
                                    <span>Harga Unit</span>
                                    <span>Rp {{ number_format($booking->unit->price ?? 0, 0, ',', '.') }}</span>
                                </div>
                                <div class="transaksi-detail-item">
                                    <span>Uang Muka (DP)</span>
                                    <span class="highlight">Rp {{ number_format($booking->booking_fee ?? 0, 0, ',', '.') }}</span>
                                </div>
                                @if(strtolower($booking->purchase_type ?? '') == 'kpr')
                                <div class="transaksi-detail-item">
                                    <span>Bank</span>
                                    <span>{{ $booking->kprApplication->bank->bank_name ?? '-' }}</span>
                                </div>
                                @endif
                                <div class="transaksi-detail-item">
                                    <span>Status Verifikasi</span>
                                    <span>
                                        <span class="payment-method-badge badge-gradient-success text-white">
                                            <i class="mdi mdi-check-circle-outline"></i>Disetujui
                                        </span>
                                    </span>
                                </div>
                                <div class="transaksi-detail-item mt-2">
                                    <span>Metode Pembayaran</span>
                                    <span class="payment-method-badge {{ strtolower($booking->purchase_type ?? '') == 'kpr' ? 'bg-primary' : 'badge-gradient-success' }} text-white">
                                        <i class="mdi {{ strtolower($booking->purchase_type ?? '') == 'kpr' ? 'mdi-bank' : 'mdi-cash' }}"></i>
                                        {{ strtoupper(str_replace('_', ' ', $booking->purchase_type ?? '-')) }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        <hr class="my-4">

                        <small class="transaksi-muted d-block mb-2">Ditangani oleh</small>
                        <div class="transaksi-handler">
                            <div class="transaksi-handler-icon">
                                <i class="mdi mdi-account-tie"></i>
                            </div>
                            <div>
                                <div class="fw-bold">{{ $booking->sales->name ?? '-' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Form Serah Terima --}}
        <form action="{{ route('serah-terima.store', $booking->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row mt-4">
                <div class="col-12 col-lg-8 mb-4 mb-lg-0">
                    <div class="card">
                        <div class="card-body">
                            <div class="transaksi-section-title">
                                <i class="mdi mdi-key"></i>
                                <span>Form Serah Terima Unit</span>
                            </div>

                            <div class="transaksi-inline-alert info">
                                <i class="mdi mdi-information-outline"></i>
                                <div>Silakan isi data serah terima, checklist kondisi unit, dokumen yang diserahkan, dan dokumentasi pendukung tanpa mengubah isi proses yang sudah berjalan.</div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="serah-form-group">
                                        <label class="serah-form-label">Tanggal Serah Terima</label>
                                        <input type="date" name="tanggal_serah_terima" class="serah-form-control"
                                            value="{{ date('Y-m-d') }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="serah-form-group">
                                        <label class="serah-form-label">No. BAST</label>
                                        <input type="text" name="no_bast" class="serah-form-control"
                                            value="{{ $noBast ?? 'Auto Generate' }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="serah-form-group">
                                <label class="serah-form-label">Lokasi Serah Terima</label>
                                <select name="lokasi_serah_terima" class="serah-form-control">
                                    <option value="site">Di Site / Proyek</option>
                                    <option value="kantor">Di Kantor Marketing</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>

                            <hr>

                            <div class="transaksi-section-title mb-3">
                                <i class="mdi mdi-home-check-outline"></i>
                                <span>Checklist Kondisi Unit</span>
                            </div>

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
                                            <input type="hidden" name="items[{{ $index }}][name]" value="{{ $item }}">
                                            <input type="checkbox" name="items[{{ $index }}][checked]" value="1" id="item_{{ $index }}" class="form-check-input">
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

                            <div class="transaksi-section-title mb-3">
                                <i class="mdi mdi-file-document-multiple-outline"></i>
                                <span>Dokumen yang Diserahkan</span>
                            </div>

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
                                            <input type="hidden" name="documents[{{ $index }}][name]" value="{{ $doc['name'] }}">
                                            <input type="checkbox" name="documents[{{ $index }}][submitted]" value="1" id="doc_{{ $index }}" class="form-check-input">
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

                            <div class="transaksi-section-title mb-3">
                                <i class="mdi mdi-camera-outline"></i>
                                <span>Dokumentasi Serah Terima</span>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="serah-form-group">
                                        <label class="serah-form-label">Foto Serah Terima Kunci</label>
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
                                        <label class="serah-form-label">Foto Kondisi Unit</label>
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

                            <div class="serah-form-group mb-0">
                                <label class="serah-form-label">Catatan</label>
                                <textarea name="catatan" class="serah-form-control" rows="3" placeholder="Tambahkan catatan jika ada..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sidebar Action --}}
                <div class="col-12 col-lg-4">
                    <div class="transaksi-sticky">
                        <div class="card">
                            <div class="card-body">
                                <div class="transaksi-section-title">
                                    <i class="mdi mdi-clipboard-check-outline"></i>
                                    <span>Informasi Serah Terima</span>
                                </div>

                                <div class="mb-3">
                                    <div class="transaksi-status-banner success">
                                        <i class="mdi mdi-key-variant"></i>
                                        Tahap Final Transaksi
                                    </div>
                                </div>

                                <div class="transaksi-summary-grid">
                                    <div class="transaksi-summary-box success">
                                        <div class="label">Status Unit</div>
                                        <div class="value">Siap</div>
                                    </div>
                                    <div class="transaksi-summary-box warning">
                                        <div class="label">Tahap</div>
                                        <div class="value">Serah Terima</div>
                                    </div>
                                </div>

                                <div class="transaksi-sidebar-section">
                                    <div class="transaksi-sidebar-title">Persetujuan</div>

                                    <div class="serah-form-group">
                                        <label class="serah-form-label">Saksi (Opsional)</label>
                                        <input type="text" name="saksi" class="serah-form-control" placeholder="Nama saksi">
                                    </div>

                                    <div class="serah-form-group mb-0">
                                        <div class="serah-checklist-item approval-check-green" style="width: 100%;">
                                            <div class="form-check">
                                                <input type="checkbox" name="persetujuan" value="1" id="persetujuan" class="form-check-input" required>
                                                <label for="persetujuan" class="check-label">
                                                    <span class="check-icon">
                                                        <i class="mdi mdi-check-circle"></i>
                                                    </span>
                                                    <span class="check-text">Saya menyatakan unit diterima dalam kondisi baik.</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="transaksi-sidebar-section">
                                    <div class="transaksi-sidebar-title">Panduan Proses</div>
                                    <ul class="transaksi-mini-list mb-0">
                                        <li>
                                            <i class="mdi mdi-arrow-right-circle-outline"></i>
                                            <span>Pastikan checklist kondisi unit telah dicek sebelum proses disimpan.</span>
                                        </li>
                                        <li>
                                            <i class="mdi mdi-arrow-right-circle-outline"></i>
                                            <span>Pastikan dokumen wajib yang diserahkan sudah ditandai dengan benar.</span>
                                        </li>
                                        <li>
                                            <i class="mdi mdi-arrow-right-circle-outline"></i>
                                            <span>Upload dokumentasi pendukung untuk mempermudah arsip serah terima.</span>
                                        </li>
                                    </ul>
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="serah-btn serah-btn-success">
                                        <i class="mdi mdi-check-decagram"></i>
                                        Proses Serah Terima
                                    </button>
                                </div>

                                <div class="text-center mt-3">
                                    <small class="transaksi-muted">
                                        <i class="mdi mdi-information-outline me-1"></i>
                                        Pastikan semua checklist terisi
                                    </small>
                                </div>
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
            $('.serah-file-upload-modern input[type="file"]').change(function(e) {
                const file = e.target.files[0];
                const $container = $(this).closest('.serah-file-upload-modern');
                const label = $container.find('.serah-file-info-modern span');
                const sizeSpan = $container.find('.serah-file-size');

                if (file) {
                    const fileName = file.name;
                    const fileSize = (file.size / (1024 * 1024)).toFixed(2);

                    label.text(fileName.length > 30 ? fileName.substring(0, 30) + '...' : fileName);
                    sizeSpan.text(fileSize + ' MB').show();
                } else {
                    if ($(this).attr('name') === 'foto_serah_kunci') {
                        label.text('Upload Foto Kunci');
                    } else {
                        label.text('Upload Foto Unit');
                    }
                    sizeSpan.text('').hide();
                }
            });

            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session("success") }}',
                    confirmButtonColor: '#9a55ff',
                    timer: 4000,
                    timerProgressBar: true
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: '{{ session("error") }}',
                    confirmButtonColor: '#9a55ff'
                });
            @endif
        });

        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();
            const form = this;

            Swal.fire({
                title: 'Proses Serah Terima?',
                text: 'Pastikan semua checklist dan dokumen sudah lengkap.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Proses',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Memproses...',
                        text: 'Mohon tunggu, sedang memproses serah terima unit',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                            form.submit();
                        }
                    });
                }
            });
        });
    </script>
@endpush
