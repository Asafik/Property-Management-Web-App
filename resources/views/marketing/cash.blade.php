@extends('layouts.partial.app')

@section('title', 'Cash Keras - Properti Management')

@section('content')
    <style>
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

        .customer-header {
            min-height: 110px;
        }

        .badge {
            padding: 0.35rem 0.6rem;
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: 30px;
            display: inline-block;
            white-space: nowrap;
        }
        @media (min-width: 576px) { .badge { padding: 0.4rem 0.75rem; font-size: 0.8rem; } }
        .badge-gradient-success { background: linear-gradient(135deg, #28a745, #5cb85c); color: #ffffff; border:none; }
        .badge-gradient-primary { background: linear-gradient(to right, #da8cff, #9a55ff) !important; color: #ffffff !important; border:none; }
        .badge-gradient-secondary { background: #6c757d !important; color: #ffffff !important; border:none; }

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
            grid-template-columns: repeat(5, minmax(90px, auto));
            gap: 1.25rem;
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
            font-size: 1rem;
            font-weight: 600;
            color: #2c2e3f;
            line-height: 1.3;
        }

        .kpr-muted {
            color: #6c7383 !important;
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

        .cash-segment {
            display: inline-flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .cash-chip {
            border: 1px solid #e5d8ff;
            background: #fff;
            color: #6b46c1;
            border-radius: 999px;
            padding: 0.55rem 0.95rem;
            font-size: 0.82rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.25s ease;
        }

        .cash-chip.active {
            background: linear-gradient(90deg, #c784ff, #9a55ff);
            border-color: transparent;
            color: #fff;
            box-shadow: 0 8px 18px rgba(154, 85, 255, 0.2);
        }

        .cash-soft-card {
            background: #fbf9fe;
            border: 1px solid #ebe7f2;
            border-radius: 14px;
        }

        .cash-form-group {
            margin-bottom: 1rem;
        }

        .cash-form-group label {
            font-size: 0.82rem;
            font-weight: 700;
            color: #2c2e3f;
            margin-bottom: 0.4rem;
            display: block;
        }

        .cash-form-control {
            border: 1px solid #e9ecef;
            border-radius: 12px;
            padding: 0.78rem 0.9rem;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            background-color: #ffffff;
            color: #2c2e3f;
            width: 100%;
        }

        .cash-form-control:focus {
            border-color: #9a55ff;
            box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.1);
            outline: none;
        }

        .cash-input-group {
            display: flex;
            align-items: stretch;
            width: 100%;
        }

        .cash-input-group-prepend {
            display: flex;
        }

        .cash-input-group-text {
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

        .cash-input-group .cash-form-control {
            border-radius: 0 12px 12px 0;
        }

        .cash-summary-mini {
            border: 1px solid #ebe7f2;
            background: #fbf9fe;
            border-radius: 14px;
            padding: 0.85rem;
            height: 100%;
        }

        .cash-summary-mini small {
            display: block;
            color: #6c7383;
            font-size: 0.75rem;
            margin-bottom: 0.25rem;
        }

        .cash-summary-mini .value {
            font-weight: 800;
            font-size: 1rem;
            line-height: 1.45;
            word-break: break-word;
        }

        .cash-text-primary {
            color: #9a55ff !important;
        }

        .cash-text-success {
            color: #28a745 !important;
        }

        .cash-text-danger {
            color: #dc3545 !important;
        }

        .cash-text-warning {
            color: #f59f00 !important;
        }

        .cash-text-muted {
            color: #6c7383 !important;
            font-size: 0.76rem;
        }

        .cash-status-banner {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 0.55rem 0.9rem;
            border-radius: 999px;
            font-size: 0.86rem;
            font-weight: 700;
        }

        .cash-status-banner.success {
            background: #edf9f3;
            color: #22a06b;
        }

        .cash-status-banner.warning {
            background: #fff8e6;
            color: #8a6a00;
        }

        .cash-status-banner.info {
            background: #f4ecff;
            color: #7f3df0;
        }

        .cash-summary-stack {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 1rem;
        }

        .cash-summary-box {
            border: 1px solid #ebe7f2;
            background: #fbf9fe;
            border-radius: 16px;
            padding: 1rem;
            width: 100%;
        }

        .cash-summary-box .label {
            font-size: 0.75rem;
            color: #6c7383;
            margin-bottom: 0.35rem;
        }

        .cash-summary-box .value {
            font-size: 1.15rem;
            font-weight: 800;
            line-height: 1.45;
            word-break: break-word;
        }

        .cash-summary-box.primary .value {
            color: #9a55ff;
        }

        .cash-summary-box.success .value {
            color: #22a06b;
        }

        .cash-summary-box.danger .value {
            color: #dc3545;
        }

        .cash-summary-box.warning .value {
            color: #f59f00;
        }

        .cash-timeline-section {
            margin-top: 1.5rem;
            margin-bottom: 1.75rem;
        }

        .cash-timeline-title-wrap {
            margin-bottom: 1rem;
        }

        .cash-timeline {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .cash-timeline-item {
            display: flex;
            gap: 12px;
            align-items: flex-start;
        }

        .cash-timeline-icon {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: #f4ecff;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .cash-timeline-content {
            flex: 1;
            padding-top: 2px;
        }

        .cash-timeline-title {
            display: block;
            font-size: 0.88rem;
            font-weight: 700;
            color: #2c2e3f;
            margin-bottom: 2px;
        }

        .cash-timeline-date {
            display: block;
            font-size: 0.78rem;
            color: #6c7383;
            line-height: 1.5;
        }

        .cash-doc-section {
            margin-top: 1.75rem;
        }

        .cash-doc-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            padding: 0.8rem 0;
            border-bottom: 1px dashed #ece7f7;
        }

        .cash-doc-row:last-child {
            border-bottom: none;
        }

        .cash-doc-left {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 0;
            flex: 1;
        }

        .cash-doc-badge {
            width: 36px;
            height: 36px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 18px;
        }

        .cash-doc-badge.available {
            background: #edf9f3;
            color: #22a06b;
            border: 1px solid #b9e7cf;
        }

        .cash-doc-badge.empty {
            background: #f6f7fb;
            color: #9aa0ac;
            border: 1px solid #e7eaf3;
        }

        .cash-doc-name {
            font-size: 0.88rem;
            color: #2c2e3f;
            font-weight: 600;
            line-height: 1.4;
        }

        .cash-doc-sub {
            display: block;
            font-size: 0.74rem;
            color: #6c7383;
            margin-top: 2px;
        }

        .cash-btn {
            border: none;
            border-radius: 12px;
            font-size: 0.88rem;
            font-weight: 700;
            padding: 0.82rem 1.1rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.25s ease;
            cursor: pointer;
        }

        .cash-btn:hover {
            transform: translateY(-1px);
            text-decoration: none;
        }

        .cash-btn-primary {
            background: linear-gradient(90deg, #c784ff, #9a55ff);
            color: #fff;
            box-shadow: 0 8px 18px rgba(154, 85, 255, 0.22);
        }

        .cash-btn-primary:hover {
            color: #fff;
        }

        .cash-btn-success {
            background: linear-gradient(135deg, #28a745, #5cb85c);
            color: #fff;
        }

        .cash-btn-success:hover {
            color: #fff;
        }

        .cash-btn-info {
            background: linear-gradient(135deg, #17a2b8, #3cc3d9);
            color: #fff;
        }

        .cash-btn-info:hover {
            color: #fff;
        }

        .cash-btn-outline-primary {
            background: #fff;
            color: #9a55ff;
            border: 1px solid #d8c4ff;
        }

        .cash-btn-outline-primary:hover {
            background: #f4ecff;
            color: #7f3df0;
        }

        .cash-btn-outline-success {
            background: #28a745;
            color: #fff;
            border: 1px solid #28a745;
        }

        .cash-btn-outline-success:hover {
            background: #28a745;
            color: #fff;
            box-shadow: none;
            transform: none;
        }

        .cash-btn-outline-warning {
            background: #fff;
            color: #f59f00;
            border: 1px solid #ffe0a3;
        }

        .cash-btn-outline-warning:hover {
            background: #fff8e6;
            color: #c77c02;
        }

        .cash-btn-outline-secondary {
            background: #fff;
            color: #6c7383;
            border: 1px solid #e4e7ee;
        }

        .cash-btn-outline-secondary:hover {
            background: #f8f9fb;
            color: #2c2e3f;
        }

        .cash-file-upload-modern {
            position: relative;
            width: 100%;
        }

        .cash-file-upload-modern input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
            z-index: 2;
        }

        .cash-file-label-modern {
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

        .cash-file-label-modern i {
            font-size: 1.6rem;
            color: #9a55ff;
            background: rgba(154, 85, 255, 0.1);
            padding: 8px;
            border-radius: 50%;
        }

        .cash-file-info-modern {
            flex: 1;
            width: 100%;
        }

        .cash-file-info-modern span {
            display: block;
            font-weight: 600;
            color: #2c2e3f;
            font-size: 0.8rem;
            word-break: break-word;
        }

        .cash-file-info-modern small,
        .cash-file-size {
            color: #6c7383;
            font-size: 0.65rem;
            display: block;
            margin-top: 2px;
        }

        .cash-file-upload-modern:hover .cash-file-label-modern {
            border-color: #9a55ff;
            background: linear-gradient(135deg, #f1f0ff, #f8f9fa);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(154, 85, 255, 0.1);
        }

        @media (min-width: 576px) {
            .cash-file-label-modern {
                flex-direction: row;
                text-align: left;
                gap: 8px;
                padding: 0.75rem 1rem;
                min-height: auto;
            }
        }

        @media (max-width: 991.98px) {
            .customer-unit-info {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                width: 100%;
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
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 1rem;
                margin-top: 0.5rem;
            }

            .cash-doc-row {
                align-items: flex-start;
                flex-direction: column;
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
                                    {{ strtoupper(substr($booking->customer->full_name ?? 'C', 0, 1)) }}
                                </div>
                                <div>
                                    <h4 class="customer-name mb-1 d-flex align-items-center gap-2" style="font-size: 1.4rem;">
                                        {{ $booking->customer->full_name ?? '-' }}
                                        @php
                                            $jenis = strtolower($booking->unit->jenis ?? '');
                                            $badgeClass = $jenis == 'subsidi' ? 'badge-gradient-success' : ($jenis == 'komersil' ? 'badge-gradient-primary' : 'badge-gradient-secondary');
                                            $icon = $jenis == 'subsidi' ? 'mdi-home-assistant' : ($jenis == 'komersil' ? 'mdi-office-building' : 'mdi-help-circle-outline');
                                        @endphp
                                        <span class="badge {{ $badgeClass }}" style="font-size: 0.85rem; padding: 0.4rem 1rem;">
                                            <i class="mdi {{ $icon }} me-1"></i>
                                            {{ strtoupper($booking->unit->jenis ?? '-') }}
                                        </span>
                                    </h4>
                                    <p class="customer-booking mb-0">Booking ID: {{ $booking->booking_code ?? '-' }}</p>
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
                                    <small>Status Pembangunan</small>
                                    @php
                                        $progressMap = [
                                            'belum_mulai' => 'Belum mulai pembangunan',
                                            'pondasi' => 'Tahap pondasi',
                                            'dinding' => 'Tahap dinding',
                                            'atap' => 'Tahap atap',
                                            'finishing' => 'Tahap finishing',
                                            'selesai' => 'Selesai pembangunan',
                                        ];
                                    @endphp
                                    <span>{{ $progressMap[$booking->unit->construction_progress] ?? '-' }}</span>
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

        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-body py-3">
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                            <div>
                                <div class="kpr-section-title mb-0">
                                    <i class="mdi mdi-cash-multiple"></i>
                                    <span id="titleCash">Cash Keras - Lunas Langsung</span>
                                </div>
                            </div>

                            <div class="cash-segment">
                                <button type="button" class="cash-chip active" id="btnCashAwal">
                                    <i class="mdi mdi-cash me-1"></i> Cash Awal
                                </button>
                                <button type="button" class="cash-chip" id="btnKonversi">
                                    <i class="mdi mdi-bank-off me-1"></i> Konversi dari KPR
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12 col-lg-8 mb-4 mb-lg-0">
                <div class="card">
                    <div class="card-body">
                        <div class="kpr-inline-alert success" id="alertCashAwal">
                            <i class="mdi mdi-check-circle"></i>
                            <div>
                                <strong>Cash Keras</strong> — Customer membayar lunas langsung dan harga bisa dinegosiasikan.
                            </div>
                        </div>

                        <div class="kpr-inline-alert warning" id="alertKonversi" style="display: none;">
                            <i class="mdi mdi-information-outline"></i>
                            <div>
                                <strong>Konversi dari KPR ke Cash Keras</strong> — KPR ditolak, lalu customer berpindah ke skema cash lunas.
                                <div class="cash-soft-card p-3 mt-3">
                                    <small class="d-block mb-1"><strong>Alasan Penolakan:</strong> BI Checking / SLIK bermasalah (Rating kurang)</small>
                                    <small class="d-block mb-1"><strong>Bank:</strong> Bank ABC Syariah</small>
                                    <small class="d-block mb-2"><strong>Tanggal Penolakan:</strong> 25 Februari 2025</small>
                                    <button type="button" class="cash-btn cash-btn-outline-primary" style="padding: 0.45rem 0.85rem;">
                                        <i class="mdi mdi-file-pdf-box me-1"></i> Lihat Surat Penolakan
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="cash-soft-card p-3 mb-4">
                            <div class="kpr-section-title mb-3">
                                <i class="mdi mdi-tag-multiple"></i>
                                <span>Informasi Harga & Negosiasi</span>
                            </div>

                            <form action="{{ route('bookings.updateNego', $booking->id) }}" method="POST" id="formNegoHarga">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="cash-form-group">
                                            <label>Harga Unit</label>
                                            <div class="cash-input-group">
                                                <div class="cash-input-group-prepend">
                                                    <span class="cash-input-group-text">Rp</span>
                                                </div>
                                                <input type="text" class="cash-form-control" id="hargaUnit"
                                                    value="{{ number_format($booking->unit->price ?? 0, 0, ',', '.') }}" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="cash-form-group">
                                            <label>Harga Nego / Kesepakatan</label>
                                            <div class="cash-input-group">
                                                <div class="cash-input-group-prepend">
                                                    <span class="cash-input-group-text">Rp</span>
                                                </div>
                                                <input type="text" class="cash-form-control" id="hargaNego" name="harga_nego"
                                                    value="{{ number_format($booking->harga_nego ?? 0, 0, ',', '.') }}">
                                            </div>
                                            <small class="cash-text-muted">Masukkan harga final setelah negosiasi</small>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mt-2">
                                        <div class="cash-form-group">
                                            <label>Booking Fee (Sudah Dibayar)</label>
                                            <div class="cash-input-group">
                                                <div class="cash-input-group-prepend">
                                                    <span class="cash-input-group-text">Rp</span>
                                                </div>
                                                <input type="text" class="cash-form-control" id="bookingFee"
                                                    value="{{ number_format($booking->booking_fee ?? 0, 0, ',', '.') }}" readonly>
                                            </div>
                                            <small class="cash-text-muted">Akan dipotong dari total pembayaran</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="cash-soft-card p-3 mb-3">
                                    <div class="kpr-section-title mb-3">
                                        <i class="mdi mdi-ticket-percent"></i>
                                        <span>Gunakan Promo</span>
                                    </div>

                                    <div class="cash-form-group mb-0">
                                        <select class="cash-form-control" name="promo_id" id="promoSelect">
                                            <option value="">-- Tanpa Promo --</option>
                                            @foreach ($promos as $promo)
                                                <option value="{{ $promo->id }}" data-type="{{ $promo->type }}" data-value="{{ $promo->value }}">
                                                    {{ $promo->name }} -
                                                    @if ($promo->type == 'persen')
                                                        {{ $promo->value }}%
                                                    @elseif (is_numeric($promo->value))
                                                        Rp {{ number_format((float) $promo->value, 0, ',', '.') }}
                                                    @else
                                                        {{ $promo->value }}
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-4 mb-3 mb-md-0">
                                        <div class="cash-summary-mini">
                                            <small>Diskon</small>
                                            <div class="value cash-text-success" id="diskonValue">Rp 15.000.000</div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3 mb-md-0">
                                        <div class="cash-summary-mini">
                                            <small>Persentase Diskon</small>
                                            <div class="value cash-text-primary" id="diskonPersen">3.33%</div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="cash-summary-mini">
                                            <small>Total Bayar</small>
                                            <div class="value cash-text-danger" id="totalBayar">Rp 0</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="kpr-inline-alert info mt-3 mb-3">
                                    <i class="mdi mdi-information-outline"></i>
                                    <div>
                                        <strong>Cash Keras:</strong> Customer akan membayar lunas
                                        <strong id="totalBayarAlert">Rp 0</strong> setelah negosiasi.
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="cash-btn cash-btn-primary">
                                        <i class="mdi mdi-content-save-outline"></i> Simpan Negosiasi
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="cash-soft-card p-3 mt-3" id="biayaHangus" style="display: none; background: #fff9ec; border-color: #ffe5ab;">
                            <div class="kpr-section-title mb-3">
                                <i class="mdi mdi-alert-circle-outline" style="color:#f59f00;"></i>
                                <span>Biaya KPR yang Tidak Kembali (Hangus)</span>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3 mb-md-0">
                                    <small class="cash-text-muted d-block">Biaya Survey</small>
                                    <span class="fw-bold">Rp 500.000</span>
                                </div>
                                <div class="col-md-4 mb-3 mb-md-0">
                                    <small class="cash-text-muted d-block">Biaya Provisi</small>
                                    <span class="fw-bold">Rp 3.600.000</span>
                                </div>
                                <div class="col-md-4">
                                    <small class="cash-text-muted d-block">Total Hangus</small>
                                    <span class="fw-bold cash-text-danger">Rp 4.100.000</span>
                                </div>
                            </div>

                            <small class="cash-text-muted d-block mt-2">
                                *Biaya ini sudah dikeluarkan dan tidak dapat dikembalikan
                            </small>
                        </div>

                        <hr class="my-4">

                        <div class="kpr-section-title">
                            <i class="mdi mdi-cash-register"></i>
                            <span>Form Pembayaran Lunas</span>
                        </div>

                        <form action="{{ route('payments.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                            <input type="hidden" name="type" value="pelunasan">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="cash-form-group">
                                        <label>Tanggal Pembayaran</label>
                                        <input type="date" class="cash-form-control" name="payment_date" value="2025-03-25" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="cash-form-group">
                                        <label>Jumlah Dibayar</label>
                                        <div class="cash-input-group">
                                            <div class="cash-input-group-prepend">
                                                <span class="cash-input-group-text">Rp</span>
                                            </div>
                                            <input type="text" class="cash-form-control" name="amount" id="jumlahBayar" value="435000000" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="cash-form-group">
                                        <label>Metode Pembayaran</label>
                                        <select class="cash-form-control" name="method" required>
                                            <option value="Transfer Bank">Transfer Bank</option>
                                            <option value="Tunai">Tunai</option>
                                            <option value="Kartu Kredit">Kartu Kredit</option>
                                            <option value="Virtual Account">Virtual Account</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <div class="cash-form-group">
                                        <label>Keterangan</label>
                                        <input type="text" class="cash-form-control" name="notes" id="keteranganBayar" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="cash-form-group">
                                        <label>Upload Bukti Transfer</label>
                                        <div class="cash-file-upload-modern">
                                            <input type="file" id="uploadBukti" name="reference_number" accept=".jpg,.jpeg,.png,.pdf">
                                            <div class="cash-file-label-modern">
                                                <i class="mdi mdi-cloud-upload"></i>
                                                <div class="cash-file-info-modern">
                                                    <span>Upload Bukti Transfer</span>
                                                    <small>Format: JPG, PNG, PDF (Max 5MB)</small>
                                                </div>
                                                <span class="cash-file-size"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button class="cash-btn cash-btn-success mt-3 w-100" id="btnProsesBayar">
                                <i class="mdi mdi-check-circle-outline"></i>
                                Proses Pembayaran Lunas
                            </button>
                        </form>

                        <div class="text-muted small mt-3 d-block d-sm-none">
                            <i class="mdi mdi-information-outline me-1"></i>
                            Scroll untuk melihat seluruh isi form
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="kpr-section-title">
                            <i class="mdi mdi-clipboard-text-outline"></i>
                            <span>Ringkasan Transaksi</span>
                        </div>

                        <div class="mb-3 text-center" id="badgeCashAwal">
                            <span class="cash-status-banner success">
                                <i class="mdi mdi-check-circle-outline"></i>
                                Cash Keras - Lunas
                            </span>
                        </div>

                        <div class="mb-3 text-center" id="badgeKonversi" style="display: none;">
                            <span class="cash-status-banner warning">
                                <i class="mdi mdi-bank-off"></i>
                                Konversi KPR - Cash Keras
                            </span>
                        </div>

                        <div class="cash-summary-stack">
                            <div class="cash-summary-box primary">
                                <div class="label">Harga Unit</div>
                                <div class="value" id="hargaUnitView">Rp 0</div>
                            </div>

                            <div class="cash-summary-box primary">
                                <div class="label">Harga Nego</div>
                                <div class="value" id="hargaNegoView">Rp 0</div>
                            </div>

                            <div class="cash-summary-box success">
                                <div class="label">Diskon</div>
                                <div class="value" id="diskonView">- Rp 0</div>
                            </div>

                            <div class="cash-summary-box danger">
                                <div class="label">Total Lunas</div>
                                <div class="value" id="totalLunasView">Rp 0</div>
                            </div>
                        </div>

                        <div class="kpr-sidebar-section cash-timeline-section">
                            <div class="kpr-sidebar-title cash-timeline-title-wrap">Timeline Transaksi</div>

                            <div class="cash-timeline">
                                <div class="cash-timeline-item">
                                    <div class="cash-timeline-icon">
                                        <i class="mdi mdi-check-circle text-success"></i>
                                    </div>
                                    <div class="cash-timeline-content">
                                        <span class="cash-timeline-title">Booking Unit</span>
                                        <span class="cash-timeline-date">
                                            {{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('l, d F Y') }}
                                        </span>
                                    </div>
                                </div>

                                @if ($booking->harga_unit != $booking->harga_nego)
                                    <div class="cash-timeline-item">
                                        <div class="cash-timeline-icon">
                                            <i class="mdi mdi-check-circle text-success"></i>
                                        </div>
                                        <div class="cash-timeline-content">
                                            <span class="cash-timeline-title">Negosiasi Harga</span>
                                            <span class="cash-timeline-date">
                                                {{ \Carbon\Carbon::parse($booking->updated_at)->translatedFormat('l, d F Y') }}
                                                - Diskon {{ 'Rp ' . number_format($booking->unit->price - $booking->harga_nego, 0, ',', '.') }}
                                            </span>
                                        </div>
                                    </div>
                                @endif

                                @foreach ($booking->payments->sortBy('payment_date') as $payment)
                                    <div class="cash-timeline-item">
                                        <div class="cash-timeline-icon">
                                            @if ($payment->payment_date)
                                                <i class="mdi mdi-check-circle text-success"></i>
                                            @else
                                                <i class="mdi mdi-clock-outline text-warning"></i>
                                            @endif
                                        </div>
                                        <div class="cash-timeline-content">
                                            <span class="cash-timeline-title">
                                                @switch($payment->type)
                                                    @case('booking_fee') Booking Fee @break
                                                    @case('dp') DP @break
                                                    @case('cicilan') Cicilan @break
                                                    @case('pelunasan') Pelunasan @break
                                                @endswitch
                                            </span>
                                            <span class="cash-timeline-date">
                                                {{ $payment->payment_date ? \Carbon\Carbon::parse($payment->payment_date)->translatedFormat('l, d F Y') : 'Menunggu pembayaran' }}
                                                - {{ 'Rp ' . number_format($payment->amount, 0, ',', '.') }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="kpr-sidebar-section cash-doc-section">
                            <div class="kpr-sidebar-title mb-3">Dokumen</div>

                            <div class="cash-doc-row">
                                <div class="cash-doc-left">
                                    <div class="cash-doc-badge empty">
                                        <i class="mdi mdi-file-outline"></i>
                                    </div>
                                    <div>
                                        <div class="cash-doc-name">Surat Perjanjian Cash</div>
                                        <small class="cash-doc-sub">Dokumen belum tersedia</small>
                                    </div>
                                </div>
                                <button class="cash-btn cash-btn-outline-secondary" style="padding: 0.45rem 0.8rem;" disabled>
                                    <i class="mdi mdi-download-off"></i>
                                </button>
                            </div>

                            <div class="cash-doc-row">
                                <div class="cash-doc-left">
                                    <div class="cash-doc-badge empty">
                                        <i class="mdi mdi-file-outline"></i>
                                    </div>
                                    <div>
                                        <div class="cash-doc-name">Bukti Negosiasi Harga</div>
                                        <small class="cash-doc-sub">Dokumen belum tersedia</small>
                                    </div>
                                </div>
                                <button class="cash-btn cash-btn-outline-secondary" style="padding: 0.45rem 0.8rem;" disabled>
                                    <i class="mdi mdi-download-off"></i>
                                </button>
                            </div>

                            @php
                                $payment = $unit->activeBooking ? $unit->activeBooking->payments()->latest()->first() : null;
                                $label = null;

                                if ($payment) {
                                    switch ($payment->type) {
                                        case 'booking_fee':
                                            $label = 'Booking Fee';
                                            break;
                                        case 'dp':
                                            $label = 'DP';
                                            break;
                                        case 'pelunasan':
                                            $label = 'Pelunasan';
                                            break;
                                        case 'cicilan':
                                            $label = 'Cicilan';
                                            break;
                                    }
                                }
                            @endphp

                            @if ($payment && $payment->reference_number)
                                <div class="cash-doc-row">
                                    <div class="cash-doc-left">
                                        <div class="cash-doc-badge available" style="background: #28a745; color: #fff;">
                                            <i class="mdi mdi-file-check-outline"></i>
                                        </div>
                                        <div>
                                            <div class="cash-doc-name">
                                                <i class="mdi mdi-bank-transfer me-1"></i>{{ $label }}
                                            </div>
                                            <small class="cash-doc-sub">Dokumen tersedia dan dapat diunduh</small>
                                        </div>
                                    </div>
                                    <a href="{{ asset('storage/' . $payment->reference_number) }}" target="_blank"
                                        class="cash-btn cash-btn-outline-success" style="padding: 0.45rem 0.8rem;">
                                        <i class="mdi mdi-download"></i>
                                    </a>
                                </div>
                            @else
                                <div class="cash-doc-row">
                                    <div class="cash-doc-left">
                                        <div class="cash-doc-badge empty">
                                            <i class="mdi mdi-file-outline"></i>
                                        </div>
                                        <div>
                                            <div class="cash-doc-name">Bukti Pembayaran</div>
                                            <small class="cash-doc-sub">Belum ada file yang diupload</small>
                                        </div>
                                    </div>
                                    <button class="cash-btn cash-btn-outline-secondary" style="padding: 0.45rem 0.8rem;" disabled>
                                        <i class="mdi mdi-download-off"></i>
                                    </button>
                                </div>
                            @endif

                            <div class="cash-doc-row" id="dokumenPenolakan" style="display: none;">
                                <div class="cash-doc-left">
                                    <div class="cash-doc-badge available" style="background: #28a745; color: #fff;">
                                        <i class="mdi mdi-file-pdf-box"></i>
                                    </div>
                                    <div>
                                        <div class="cash-doc-name">Surat Penolakan KPR</div>
                                        <small class="cash-doc-sub">Dokumen tersedia dan dapat diunduh</small>
                                    </div>
                                </div>
                                <button class="cash-btn cash-btn-outline-success" style="padding: 0.45rem 0.8rem;">
                                    <i class="mdi mdi-download"></i>
                                </button>
                            </div>
                        </div>

                        <div class="kpr-sidebar-section">
                            <div class="d-flex flex-column gap-2">
                                <button
                                    onclick="handleInvoice('{{ route('cetak.invoice_cash', $booking->id) }}','{{ route('cetak.invoice_wa', $booking->id) }}')"
                                    class="cash-btn cash-btn-primary w-100">
                                    <i class="mdi mdi-printer"></i>
                                    Cetak & Kirim WA
                                </button>

                                <button class="cash-btn cash-btn-info w-100">
                                    <i class="mdi mdi-whatsapp"></i>
                                    Kirim Invoice
                                </button>

                                @if ($booking->status_cash == 'process')
                                    <a href="{{ route('akad.cash', $booking->id) }}" class="cash-btn cash-btn-outline-warning w-100">
                                        <i class="mdi mdi-handshake-outline"></i> Lanjut ke Akad
                                    </a>
                                @elseif($booking->status_cash == 'done')
                                    <button class="cash-btn cash-btn-outline-success w-100" disabled>
                                        <i class="mdi mdi-check-circle-outline"></i> Cash Keras - Sudah Lunas
                                    </button>
                                @else
                                    <button class="cash-btn cash-btn-outline-secondary w-100" disabled>
                                        <i class="mdi mdi-clock-outline"></i> Menunggu Pembayaran
                                    </button>
                                @endif

                                @php
                                    $isLegalDone = strtolower($booking->status_legal) == 'done';
                                    $isBuildDone = strtolower($booking->unit->construction_progress) == 'selesai';
                                    $isAkadDone = $booking->status_akad == 'done';
                                @endphp

                                @if ($isAkadDone)
                                    <button class="cash-btn cash-btn-outline-success w-100" disabled>
                                        <i class="mdi mdi-check-circle-outline"></i> Sudah Akad
                                    </button>
                                @elseif ($isLegalDone && $isBuildDone)
                                    <a href="{{ route('akad.cash', $booking->id) }}" class="cash-btn cash-btn-outline-primary w-100">
                                        <i class="mdi mdi-cash"></i> Proses Akad
                                    </a>
                                @elseif ($isLegalDone && !$isBuildDone)
                                    <a href="{{ route('properti.progress', $booking->unit->land_bank_id) }}?unit_id={{ $booking->unit->id }}"
                                        class="cash-btn cash-btn-outline-warning w-100">
                                        <i class="mdi mdi-hammer"></i> Lihat Progress Pembangunan
                                    </a>
                                @else
                                    <button class="cash-btn cash-btn-outline-secondary w-100" disabled>
                                        <i class="mdi mdi-clock-outline"></i> Menunggu Legal & Pembangunan
                                    </button>
                                @endif

                                @if ($booking->status_legal == 'done')
                                    <button class="cash-btn cash-btn-outline-success w-100" disabled>
                                        <i class="mdi mdi-check-circle-outline"></i> Legal Document Selesai
                                    </button>
                                @else
                                    <a href="{{ route('cash.document.legal', $booking->id) }}" class="cash-btn cash-btn-outline-warning w-100">
                                        <i class="mdi mdi-file-certificate-outline"></i> Persiapan Document Legal
                                    </a>
                                @endif

                                <button class="cash-btn cash-btn-outline-secondary w-100">
                                    <i class="mdi mdi-arrow-left"></i>
                                    Kembali
                                </button>
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
        function handleInvoice(printUrl, waUrl) {
            window.open(printUrl, '_blank');
            setTimeout(() => {
                window.location.href = waUrl;
            }, 1000);
        }
    </script>

    <script>
        $(document).ready(function() {
            function formatRupiah(angka) {
                angka = angka.toString();
                return 'Rp ' + angka.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            function hitungDiskon() {
                let hargaUnit = parseInt($('#hargaUnit').val().replace(/[^0-9]/g, '')) || 0;
                let hargaNego = parseInt($('#hargaNego').val().replace(/[^0-9]/g, '')) || 0;
                let bookingFee = parseInt($('#bookingFee').val().replace(/[^0-9]/g, '')) || 0;

                if (hargaNego === 0) hargaNego = hargaUnit;

                let diskon = hargaUnit - hargaNego;
                if (diskon < 0) diskon = 0;

                let sisaBayar = hargaNego - bookingFee;
                if (sisaBayar < 0) sisaBayar = 0;

                let persenDiskon = hargaUnit > 0 ? ((diskon / hargaUnit) * 100).toFixed(2) : 0;

                $('#hargaUnitView').text(formatRupiah(hargaUnit));
                $('#hargaNegoView').text(formatRupiah(hargaNego));
                $('#diskonView').text(`- ${formatRupiah(diskon)}`);
                $('#totalLunasView').text(formatRupiah(sisaBayar));

                $('#totalBayar').text(formatRupiah(sisaBayar));
                $('#totalBayarAlert').text(formatRupiah(sisaBayar));
                $('#keteranganBayar').val(`Pelunasan Cash Keras - Nego ${formatRupiah(sisaBayar)}`);
                $('#diskonValue').text(formatRupiah(diskon));
                $('#diskonPersen').text(persenDiskon + '%');
                $('#jumlahBayar').val(sisaBayar);
            }

            $('#hargaNego, #hargaUnit, #bookingFee').on('input', function() {
                let nilai = $(this).val().replace(/[^0-9]/g, '');
                $(this).val(nilai);
                hitungDiskon();
            });

            $('.cash-file-upload-modern input[type="file"]').change(function(e) {
                const fileName = e.target.files[0]?.name;
                const fileSize = e.target.files[0]?.size;
                const label = $(this).closest('.cash-file-upload-modern').find('.cash-file-info-modern span');
                const sizeSpan = $(this).closest('.cash-file-upload-modern').find('.cash-file-size');

                if (fileName) {
                    label.text(fileName.length > 30 ? fileName.substring(0, 30) + '...' : fileName);
                    if (fileSize) {
                        const sizeInMB = (fileSize / (1024 * 1024)).toFixed(2);
                        sizeSpan.text(sizeInMB + ' MB');
                    }
                } else {
                    label.text('Upload Bukti Transfer');
                    sizeSpan.text('');
                }
            });

            $('#btnCashAwal').click(function() {
                $(this).addClass('active');
                $('#btnKonversi').removeClass('active');
                $('#alertCashAwal').show();
                $('#alertKonversi').hide();
                $('#biayaHangus').hide();
                $('#badgeCashAwal').show();
                $('#badgeKonversi').hide();
                $('#dokumenPenolakan').hide();
                $('#titleCash').text('Cash Keras - Lunas Langsung');
            });

            $('#btnKonversi').click(function() {
                $(this).addClass('active');
                $('#btnCashAwal').removeClass('active');
                $('#alertKonversi').show();
                $('#alertCashAwal').hide();
                $('#biayaHangus').show();
                $('#badgeKonversi').show();
                $('#badgeCashAwal').hide();
                $('#dokumenPenolakan').show();
                $('#titleCash').text('Cash Keras - Lunas Langsung (Konversi dari KPR)');
            });

            hitungDiskon();
        });
    </script>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    confirmButtonText: 'OK',
                    timer: 3000,
                });
            });
        </script>
    @endif

    <script>
        document.getElementById('btnProsesBayar').addEventListener('click', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Konfirmasi Pembayaran',
                text: "Apakah Anda yakin ingin memproses pembayaran ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, proses pembayaran!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.closest('form').submit();
                }
            });
        });

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 2500,
                showConfirmButton: false
            });
        @endif
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const input = document.getElementById('hargaNego');

            input.addEventListener('keyup', function() {
                let angka = this.value.replace(/[^,\d]/g, '');
                let split = angka.split(',');
                let sisa = split[0].length % 3;
                let rupiah = split[0].substr(0, sisa);
                let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                if (ribuan) {
                    let separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                this.value = rupiah;
            });
        });
    </script>
@endpush
