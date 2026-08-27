@extends('layouts.partial.app')

@section('title', 'Konfirmasi Akad Cash - Properti Management')

@section('content')
    <style>
        /* =========================================================
           TRANSAKSI AKAD CASH STYLES & LAYOUT
           ========================================================= */

        .transaksi-page {
            font-family: 'Nunito', 'Segoe UI', sans-serif;
            color: #2c2e3f;
        }

        .card {
            border-radius: 14px !important;
            border: none !important;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04);
            background: #ffffff;
            transition: all 0.3s ease;
        }

        .card-body {
            padding: 1.5rem !important;
        }

        /* CUSTOMER HEADER */
        .customer-header {
            width: 100%;
        }

        .customer-avatar {
            width: 58px;
            height: 58px;
            border-radius: 14px;
            background: linear-gradient(135deg, #da8cff, #9a55ff);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.25);
            flex-shrink: 0;
        }

        .customer-avatar i {
            font-size: 2.2rem;
            color: #ffffff;
        }

        .customer-name {
            font-size: 1.25rem;
            font-weight: 700;
            color: #2c2e3f;
        }

        .customer-booking {
            font-size: 0.88rem;
            color: #8b8fa3;
            font-weight: 600;
        }

        .customer-unit-info {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 1.25rem;
            background: #fbf9ff;
            border: 1px solid #ede4ff;
            padding: 0.75rem 1.25rem;
            border-radius: 12px;
        }

        .customer-unit-info .info-item {
            display: flex;
            flex-direction: column;
        }

        .customer-unit-info .info-item small {
            font-size: 0.75rem;
            color: #8b8fa3;
            font-weight: 600;
            margin-bottom: 2px;
        }

        .customer-unit-info .info-item span {
            font-size: 0.95rem;
            font-weight: 700;
            color: #2c2e3f;
        }

        /* BADGES */
        .badge-gradient-success {
            background: linear-gradient(135deg, #28c76f, #48da89) !important;
            color: #fff !important;
            padding: 0.4rem 0.75rem;
            font-size: 0.75rem;
            border-radius: 8px;
            font-weight: 700;
        }

        .badge-gradient-primary {
            background: linear-gradient(135deg, #da8cff, #9a55ff) !important;
            color: #fff !important;
            padding: 0.4rem 0.75rem;
            font-size: 0.75rem;
            border-radius: 8px;
            font-weight: 700;
        }

        .badge-gradient-secondary {
            background: #6c757d !important;
            color: #fff !important;
            padding: 0.4rem 0.75rem;
            font-size: 0.75rem;
            border-radius: 8px;
            font-weight: 700;
        }

        /* SECTION TITLES */
        .transaksi-section-title {
            display: flex;
            align-items: center;
            gap: 0.55rem;
            font-size: 1.05rem;
            font-weight: 700;
            color: #2c2e3f;
            margin-bottom: 1.25rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid #f1f3f7;
        }

        .transaksi-section-title i {
            font-size: 1.35rem;
            color: #9a55ff;
        }

        /* STEPPER PROGRESS */
        .transaksi-progress-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.92rem;
            margin-bottom: 0.75rem;
        }

        .transaksi-progress-top .transaksi-muted {
            color: #64748b !important;
            font-weight: 500;
        }

        .transaksi-progress {
            height: 8px;
            background: #eef1f6;
            border-radius: 20px;
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .transaksi-progress-bar {
            height: 100%;
            background: #9a55ff;
            border-radius: 20px;
            transition: width 0.4s ease;
        }

        .transaksi-steps {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            position: relative;
        }

        /* Connecting Line on parent container */
        .transaksi-steps::before {
            content: '';
            position: absolute;
            top: 22px;
            left: calc(100% / 14);
            right: calc(100% / 14);
            height: 2.5px;
            background: #e2e8f0;
            z-index: 1;
        }

        @media (max-width: 767px) {
            .transaksi-steps {
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 1.25rem 0.5rem;
            }
            .transaksi-steps::before {
                display: none !important;
            }
        }

        .transaksi-step {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 0.25rem 0.15rem;
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
            z-index: 2;
        }

        .transaksi-step.completed,
        .transaksi-step.active {
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
        }

        .transaksi-step-icon {
            position: relative;
            z-index: 3;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.65rem;
            font-size: 1.25rem;
            background: #f1f3f7 !important;
            border: 3px solid #ffffff !important;
            box-shadow: 0 0 0 1px #edf2f7;
            color: #94a3b8;
            transition: all 0.25s ease;
        }

        .transaksi-step.completed .transaksi-step-icon,
        .transaksi-step.active .transaksi-step-icon {
            background: #28c76f !important;
            border: 3px solid #ffffff !important;
            box-shadow: 0 0 0 1px #28c76f;
            color: #ffffff !important;
        }

        .transaksi-step-title {
            font-size: 0.88rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 2px;
            white-space: nowrap;
        }

        .transaksi-step small {
            font-size: 0.75rem;
            color: #64748b;
            font-weight: 500;
            line-height: 1.3;
            display: block;
        }

        /* DETAIL LIST */
        .transaksi-detail-list {
            display: flex;
            flex-direction: column;
            gap: 0.85rem;
        }

        .transaksi-detail-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.88rem;
            padding-bottom: 0.6rem;
            border-bottom: 1px dashed #f0f2f7;
        }

        .transaksi-detail-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .transaksi-detail-item > span:first-child {
            color: #8b8fa3;
            font-weight: 600;
        }

        .transaksi-detail-item > span:last-child {
            color: #2c2e3f;
            font-weight: 700;
            text-align: right;
        }

        .transaksi-detail-item .highlight {
            color: #28c76f !important;
            font-size: 0.98rem;
        }

        .transaksi-handler {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            background: #f8fafc;
            border: 1px solid #edf0f5;
            padding: 0.75rem 1rem;
            border-radius: 12px;
        }

        .transaksi-handler-icon {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-size: 1.3rem;
        }

        /* INLINE ALERTS */
        .transaksi-inline-alert {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.85rem 1rem;
            border-radius: 10px;
            font-size: 0.88rem;
            margin-bottom: 1.25rem;
        }

        .transaksi-inline-alert i {
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        .transaksi-inline-alert.success {
            background: #eefcf3;
            border: 1px solid #cbf4d8;
            color: #1b7a42;
        }

        .transaksi-inline-alert.warning {
            background: #fff9ed;
            border: 1px solid #ffe6be;
            color: #b26b00;
        }

        .transaksi-inline-alert.info {
            background: #f3f8ff;
            border: 1px solid #dbeafe;
            color: #1d4ed8;
        }

        .transaksi-inline-alert.danger {
            background: #fef2f2;
            border: 1px solid #fed7d7;
            color: #b91c1c;
        }

        /* DECISION CARDS */
        .transaksi-decision-card {
            position: relative;
        }

        .transaksi-decision-card input[type="radio"] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .transaksi-decision-label {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1.1rem 1.25rem;
            background: #ffffff;
            border: 2px solid #e2e8f0;
            border-radius: 14px;
            cursor: pointer;
            transition: all 0.25s ease;
            margin-bottom: 0;
        }

        .transaksi-decision-label:hover {
            border-color: #9a55ff;
            background: #faf8ff;
            transform: translateY(-2px);
        }

        .transaksi-decision-card.approve input[type="radio"]:checked + .transaksi-decision-label {
            border-color: #28c76f;
            background: #f0fdf4;
            box-shadow: 0 4px 12px rgba(40, 199, 111, 0.15);
        }

        .transaksi-decision-card.reject input[type="radio"]:checked + .transaksi-decision-label {
            border-color: #ef4444;
            background: #fef2f2;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.15);
        }

        .transaksi-decision-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            flex-shrink: 0;
        }

        .transaksi-decision-card.approve .transaksi-decision-icon {
            background: #eefcf3;
            color: #28c76f;
        }

        .transaksi-decision-card.reject .transaksi-decision-icon {
            background: #fee2e2;
            color: #ef4444;
        }

        .transaksi-decision-content {
            flex: 1;
        }

        .transaksi-decision-title {
            font-size: 1rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 2px;
        }

        .transaksi-decision-desc {
            font-size: 0.8rem;
            color: #64748b;
        }

        .transaksi-decision-check {
            font-size: 1.35rem;
            color: #cbd5e1;
            transition: all 0.25s ease;
        }

        .transaksi-decision-card.approve input[type="radio"]:checked + .transaksi-decision-label .transaksi-decision-check {
            color: #28c76f;
        }

        .transaksi-decision-card.reject input[type="radio"]:checked + .transaksi-decision-label .transaksi-decision-check {
            color: #ef4444;
        }

        /* FORMS */
        .transaksi-form-shell {
            display: none;
            padding: 1.25rem;
            border-radius: 14px;
            background: #ffffff;
            border: 1.5px solid #e2e8f0;
            margin-bottom: 1.25rem;
        }

        .transaksi-form-shell.approve {
            border-color: #bbf7d0;
            background: #fcfdfd;
        }

        .transaksi-form-shell.reject {
            border-color: #fecaca;
            background: #fffdfd;
        }

        .transaksi-form-title {
            font-size: 1.05rem;
            font-weight: 700;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #f1f5f9;
        }

        .transaksi-form-title.approve { color: #15803d; }
        .transaksi-form-title.reject { color: #b91c1c; }

        .transaksi-form-group {
            margin-bottom: 1.15rem;
        }

        .transaksi-form-label {
            display: block;
            font-size: 0.86rem;
            font-weight: 700;
            color: #2c2e3f;
            margin-bottom: 0.4rem;
        }

        .transaksi-form-control {
            width: 100%;
            border: 1.5px solid #e2e8f0;
            border-radius: 8px;
            padding: 0.65rem 0.85rem;
            font-size: 0.88rem;
            color: #2c2e3f;
            background: #ffffff;
            transition: all 0.2s ease;
        }

        .transaksi-form-control:focus {
            outline: none;
            border-color: #9a55ff;
            box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.15);
        }

        select.transaksi-form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%239a55ff' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.95rem center;
            background-size: 14px;
        }

        .transaksi-input-group {
            display: flex;
            align-items: stretch;
        }
        .transaksi-input-group-prepend {
            display: flex;
        }
        .transaksi-input-group-text {
            display: flex;
            align-items: center;
            padding: 0.65rem 0.85rem;
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 8px 0 0 8px;
            color: #64748b;
            font-weight: 700;
            font-size: 0.88rem;
        }
        .transaksi-input-group .transaksi-form-control {
            border-radius: 0 8px 8px 0;
            border-left: none;
        }

        .transaksi-file-upload {
            position: relative;
            width: 100%;
        }

        .transaksi-file-upload input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
            z-index: 2;
        }

        .transaksi-file-label {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            background: #ffffff;
            border: 1.5px dashed #cbd5e1;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .transaksi-file-upload:hover .transaksi-file-label {
            border-color: #9a55ff;
            background: #fbf9ff;
        }

        .transaksi-file-label i {
            font-size: 1.5rem;
            color: #9a55ff;
        }

        .transaksi-file-info {
            flex: 1;
        }

        .transaksi-file-info span {
            display: block;
            font-weight: 700;
            color: #2c2e3f;
            font-size: 0.85rem;
        }

        .transaksi-file-info small {
            color: #8b8fa3;
            font-size: 0.75rem;
            display: block;
        }

        /* BUTTONS & ACTIONS */
        .transaksi-action-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            padding-top: 1.25rem;
            border-top: 1px solid #f1f5f9;
        }

        .transaksi-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-weight: 700;
            font-size: 0.92rem;
            border: none;
            cursor: pointer;
            transition: all 0.25s ease;
            text-decoration: none !important;
        }

        .transaksi-btn-primary {
            background: linear-gradient(135deg, #da8cff, #9a55ff);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.25);
        }

        .transaksi-btn-primary:hover {
            box-shadow: 0 6px 18px rgba(154, 85, 255, 0.4);
            transform: translateY(-2px);
            color: #ffffff;
        }

        .transaksi-btn-secondary {
            background: #f1f5f9;
            color: #64748b;
        }

        .transaksi-btn-secondary:hover {
            background: #e2e8f0;
            color: #334155;
            transform: translateY(-2px);
        }

        /* SIDEBAR & STICKY */
        .transaksi-sticky {
            position: sticky;
            top: 20px;
        }

        .transaksi-status-banner {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1rem;
            border-radius: 10px;
            font-weight: 700;
            font-size: 0.88rem;
        }

        .transaksi-status-banner.success {
            background: linear-gradient(135deg, #eefcf3, #dcfce7);
            color: #15803d;
            border: 1px solid #bbf7d0;
        }

        .transaksi-status-banner.warning {
            background: linear-gradient(135deg, #fffbeb, #fef3c7);
            color: #b45309;
            border: 1px solid #fde68a;
        }

        .transaksi-sidebar-section {
            padding-top: 1rem;
            margin-top: 1rem;
            border-top: 1px solid #f1f3f7;
        }

        .transaksi-sidebar-title {
            font-size: 0.88rem;
            font-weight: 700;
            color: #2c2e3f;
            margin-bottom: 0.65rem;
        }

        .transaksi-mini-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .transaksi-mini-list li {
            display: flex;
            align-items: flex-start;
            gap: 0.5rem;
            font-size: 0.82rem;
            color: #64748b;
            line-height: 1.4;
        }

        .transaksi-mini-list li i {
            font-size: 1rem;
            color: #9a55ff;
            flex-shrink: 0;
            margin-top: 1px;
        }
    </style>

    <div class="transaksi-page">
        <!-- Customer Info Card -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="customer-header d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="customer-avatar">
                                    <i class="mdi mdi-account"></i>
                                </div>
                                <div>
                                    <h4 class="customer-name mb-1 d-flex align-items-center gap-2">
                                        {{ $booking->customer->full_name ?? '-' }}
                                        @php
                                            $jenis = strtolower($booking->unit->jenis ?? '');
                                            $badgeClass = $jenis == 'subsidi' ? 'badge-gradient-success' : ($jenis == 'komersil' ? 'badge-gradient-primary' : 'badge-gradient-secondary');
                                            $icon = $jenis == 'subsidi' ? 'mdi-home-assistant' : ($jenis == 'komersil' ? 'mdi-office-building' : 'mdi-help-circle-outline');
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">
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
                                    <small>Harga Unit</small>
                                    <span class="text-primary fw-bold">Rp {{ number_format($booking->unit->price ?? 0, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stepper & Payment Summary -->
        <div class="row mt-4">
            <div class="col-12 col-lg-8 mb-4 mb-lg-0">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="transaksi-section-title">
                            <i class="mdi mdi-timeline-text"></i>
                            <span>Tahapan Akad Cash</span>
                        </div>

                        @php
                            $steps = [
                                'booking' => 'Booking',
                                'cash' => 'Pelunasan',
                                'legal' => 'Persiapan Legal',
                                'spk' => 'SPK',
                                'construction' => 'Pembangunan',
                                'akad' => 'Akad',
                                'completed' => 'Serah Terima',
                            ];
                            $isBookingDone = !empty($booking->booking_date);
                            $isCashDone = strtolower($booking->status_cash ?? '') == 'done' || in_array(strtolower($booking->purchase_type), ['cash', 'cash_tempo']);
                            $isLegalDone = strtolower($booking->status_legal ?? '') == 'done';
                            $isSpkDone = !empty($booking->unit->dokumen_spk);
                            $construction = strtolower($booking->unit->construction_progress ?? '');
                            $isBuildDone = $construction == 'selesai';
                            $isAkadDone = $booking->status_akad == 'done';
                            $isCompleted = $booking->status == 'completed';

                            $completedCount = 0;
                            if ($isBookingDone) $completedCount++;
                            if ($isCashDone) $completedCount++;
                            if ($isLegalDone) $completedCount++;
                            if ($isSpkDone) $completedCount++;
                            if ($isBuildDone) $completedCount++;

                            $progressPercent = ($completedCount / 7) * 100;
                        @endphp

                        <div class="transaksi-progress-top">
                            <span class="transaksi-muted">Progress Akad</span>
                            <span>{{ $completedCount }} dari 7 tahap selesai</span>
                        </div>

                        <div class="transaksi-progress">
                            <div class="transaksi-progress-bar" style="width: {{ $progressPercent }}%;"></div>
                        </div>

                        <div class="transaksi-steps">
                            @foreach ($steps as $key => $label)
                                @php
                                    $isStepCompleted = false;
                                    $isStepActive = false;
                                    if ($key == 'booking') {
                                        $isStepCompleted = $isBookingDone;
                                        $isStepActive = !$isBookingDone;
                                    }
                                    if ($key == 'cash') {
                                        $isStepCompleted = $isCashDone;
                                        $isStepActive = $isBookingDone && !$isCashDone;
                                    }
                                    if ($key == 'legal') {
                                        $isStepCompleted = $isLegalDone;
                                        $isStepActive = $isCashDone && !$isLegalDone;
                                    }
                                    if ($key == 'spk') {
                                        $isStepCompleted = $isSpkDone;
                                        $isStepActive = $isLegalDone && !$isSpkDone;
                                    }
                                    if ($key == 'construction') {
                                        if ($construction == 'selesai') {
                                            $isStepCompleted = true;
                                        } elseif ($construction == 'proses') {
                                            $isStepActive = true;
                                        }
                                    }
                                    if ($key == 'akad') {
                                        if ($isAkadDone) {
                                            $isStepCompleted = true;
                                        } else {
                                            $isStepActive = true;
                                        }
                                    }
                                    if ($key == 'completed') {
                                        $isStepCompleted = $isCompleted;
                                    }
                                @endphp

                                <div class="transaksi-step {{ $isStepCompleted ? 'completed' : ($isStepActive ? 'active' : '') }}">
                                    <div class="transaksi-step-icon">
                                        @if ($isStepCompleted)
                                            <i class="mdi mdi-check"></i>
                                        @else
                                            @if ($key == 'booking')
                                                <i class="mdi mdi-book-open-page-variant"></i>
                                            @elseif($key == 'cash')
                                                <i class="mdi mdi-cash"></i>
                                            @elseif($key == 'legal')
                                                <i class="mdi mdi-file-document-outline"></i>
                                            @elseif($key == 'spk')
                                                <i class="mdi mdi-clipboard-text"></i>
                                            @elseif($key == 'construction')
                                                <i class="mdi mdi-home-city-outline"></i>
                                            @elseif($key == 'akad')
                                                <i class="mdi mdi-handshake"></i>
                                            @else
                                                <i class="mdi mdi-key"></i>
                                            @endif
                                        @endif
                                    </div>
                                    <span class="transaksi-step-title">{{ $label }}</span>
                                    <small>
                                        @if ($key == 'booking' && $booking->booking_date)
                                            {{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('j F Y') }}
                                        @elseif($isStepCompleted || $isStepActive)
                                            {{ $booking->updated_at->translatedFormat('j F Y') }}
                                        @else
                                            Menunggu
                                        @endif
                                    </small>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Pembayaran Sidebar -->
            <div class="col-12 col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="transaksi-section-title">
                            <i class="mdi mdi-cash-multiple"></i>
                            <span>Detail Pembayaran</span>
                        </div>

                        <div class="transaksi-detail-list">
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
                                        <i class="mdi mdi-cash me-1"></i>{{ $booking->purchase_type == 'cash' ? 'Cash Keras' : ($booking->purchase_type == 'cash_tempo' ? 'Cash Tempo' : 'Cash') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="transaksi-sidebar-section">
                            <div class="transaksi-sidebar-title mb-2" style="font-size: 0.86rem; font-weight: 700; color: #4b5565;">Ditangani oleh</div>
                            <div class="transaksi-handler">
                                <div class="transaksi-handler-icon">
                                    <i class="mdi mdi-account-tie"></i>
                                </div>
                                <div>
                                    <div class="fw-bold">{{ $booking->sales->name ?? 'Marketing' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Konfirmasi Akad & Panduan -->
        <div class="row mt-4">
            <div class="col-12 col-lg-8 mb-4 mb-lg-0">
                <div class="card">
                    <div class="card-body">
                        <div class="transaksi-section-title">
                            <i class="mdi mdi-handshake"></i>
                            <span>Konfirmasi Akad Cash</span>
                        </div>

                        <div class="transaksi-inline-alert info mb-4">
                            <i class="mdi mdi-information-outline"></i>
                            <div>Pilih salah satu keputusan di bawah ini. Form akan menyesuaikan secara otomatis sesuai status akad.</div>
                        </div>

                        <div class="transaksi-inline-alert danger transaksi-error-box" id="akadErrorBox" style="display: none;">
                            <i class="mdi mdi-alert-circle-outline"></i>
                            <div>Silakan pilih status akad terlebih dahulu sebelum submit.</div>
                        </div>

                        <form action="{{ route('akad.cash.store', $booking->id) }}" method="POST" enctype="multipart/form-data" id="formAkadCash">
                            @csrf
                            <input type="hidden" name="status_akad" id="statusAkadInput" value="">

                            <div class="row g-3 mb-3">
                                <div class="col-12 col-md-6">
                                    <div class="transaksi-decision-card approve">
                                        <input type="radio" name="decision_choice" id="decisionSelesai" value="selesai">
                                        <label for="decisionSelesai" class="transaksi-decision-label">
                                            <div class="transaksi-decision-icon">
                                                <i class="mdi mdi-check-bold"></i>
                                            </div>
                                            <div class="transaksi-decision-content">
                                                <div class="transaksi-decision-title">Akad Selesai</div>
                                                <p class="transaksi-decision-desc mb-0">Proses akad telah selesai dan siap lanjut ke serah terima unit.</p>
                                            </div>
                                            <div class="transaksi-decision-check">
                                                <i class="mdi mdi-check-circle"></i>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="transaksi-decision-card reject">
                                        <input type="radio" name="decision_choice" id="decisionBatal" value="batal">
                                        <label for="decisionBatal" class="transaksi-decision-label">
                                            <div class="transaksi-decision-icon">
                                                <i class="mdi mdi-close-thick"></i>
                                            </div>
                                            <div class="transaksi-decision-content">
                                                <div class="transaksi-decision-title">Akad Batal</div>
                                                <p class="transaksi-decision-desc mb-0">Proses akad dibatalkan dan perlu tindakan lanjutan.</p>
                                            </div>
                                            <div class="transaksi-decision-check">
                                                <i class="mdi mdi-check-circle"></i>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div id="formSelesai" class="transaksi-form-shell approve">
                                <div class="transaksi-form-title approve">Form Akad Selesai</div>

                                <div class="transaksi-inline-alert success">
                                    <i class="mdi mdi-check-circle-outline"></i>
                                    <div><strong>Akad disetujui.</strong> Pengajuan akan diarahkan ke tahap <strong>Serah Terima</strong>.</div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="transaksi-form-group">
                                            <label class="transaksi-form-label">No. Akad</label>
                                            <input type="text" name="no_akad" class="transaksi-form-control"
                                                value="AKAD/CASH/{{ date('Y') }}/{{ str_pad($booking->id, 4, '0', STR_PAD_LEFT) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="transaksi-form-group">
                                            <label class="transaksi-form-label">Tanggal Akad</label>
                                            <input type="date" name="tanggal_akad" class="transaksi-form-control"
                                                value="{{ date('Y-m-d') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="transaksi-form-group">
                                            <label class="transaksi-form-label">Total Pembayaran</label>
                                            <div class="transaksi-input-group">
                                                <div class="transaksi-input-group-prepend">
                                                    <span class="transaksi-input-group-text">Rp</span>
                                                </div>
                                                <input type="text" class="transaksi-form-control"
                                                    value="{{ number_format($sisaPembayaran, 0, ',', '.') }}"
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="transaksi-form-group">
                                            <label class="transaksi-form-label">Status Pembayaran</label>
                                            <select name="status_pembayaran" class="transaksi-form-control">
                                                <option value="lunas" selected>Lunas</option>
                                                <option value="bertahap">Bertahap (Belum Lunas)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="transaksi-form-group">
                                    <label class="transaksi-form-label">Upload Dokumen Akad</label>
                                    <div class="transaksi-file-upload">
                                        <input type="file" name="dokumen" id="uploadDokumenSelesai" accept=".jpg,.jpeg,.png,.pdf">
                                        <div class="transaksi-file-label">
                                            <i class="mdi mdi-cloud-upload"></i>
                                            <div class="transaksi-file-info">
                                                <span>Upload Dokumen Akad</span>
                                                <small>Format: JPG, PNG, PDF (Max 5MB)</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="transaksi-form-group">
                                    <label class="transaksi-form-label">Catatan Akad</label>
                                    <textarea name="catatan" class="transaksi-form-control" rows="3" placeholder="Contoh: Proses akad berjalan lancar, seluruh dokumen telah ditandatangani."></textarea>
                                </div>
                            </div>

                            <div id="formBatal" class="transaksi-form-shell reject">
                                <div class="transaksi-form-title reject">Form Pembatalan Akad</div>

                                <div class="transaksi-inline-alert danger">
                                    <i class="mdi mdi-close-circle-outline"></i>
                                    <div><strong>Akad dibatalkan.</strong> Pilih alasan dan tindakan lanjutan.</div>
                                </div>

                                <div class="transaksi-form-group">
                                    <label class="transaksi-form-label">Alasan Pembatalan</label>
                                    <select name="alasan_batal" id="alasanBatalSelect" class="transaksi-form-control">
                                        <option value="">-- Pilih Alasan --</option>
                                        <option value="customer batal">Customer Batal Beli</option>
                                        <option value="dana tidak cukup">Dana Tidak Cukup</option>
                                        <option value="masalah dokumen">Masalah Dokumen</option>
                                        <option value="mengundurkan diri">Customer Mengundurkan Diri</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>

                                <div class="transaksi-form-group" id="alasanLainnyaGroup" style="display: none;">
                                    <label class="transaksi-form-label">Tulis Alasan Lainnya</label>
                                    <input type="text" name="alasan_lainnya" class="transaksi-form-control" placeholder="Contoh: Masalah internal perusahaan">
                                </div>

                                <div class="transaksi-form-group">
                                    <label class="transaksi-form-label">Catatan Pembatalan</label>
                                    <textarea name="catatan" class="transaksi-form-control" rows="3" placeholder="Detail pembatalan..."></textarea>
                                </div>

                                <hr class="my-4">

                                <label class="transaksi-form-label">Tindakan Selanjutnya</label>
                                <div class="transaksi-next-step-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                                    <div class="transaksi-decision-card">
                                        <input type="radio" name="tindakan" id="tindakanRefund" value="refund" checked>
                                        <label class="transaksi-decision-label" for="tindakanRefund">
                                            <div class="transaksi-decision-icon" style="background: #eefcf3; color: #28c76f;">
                                                <i class="mdi mdi-cash-refund"></i>
                                            </div>
                                            <div class="transaksi-decision-content">
                                                <div class="transaksi-decision-title">Refund DP</div>
                                                <p class="transaksi-decision-desc mb-0">Kembalikan uang muka sesuai ketentuan</p>
                                            </div>
                                            <div class="transaksi-decision-check">
                                                <i class="mdi mdi-check-circle"></i>
                                            </div>
                                        </label>
                                    </div>

                                    <div class="transaksi-decision-card">
                                        <input type="radio" name="tindakan" id="tindakanHangus" value="hangus">
                                        <label class="transaksi-decision-label" for="tindakanHangus">
                                            <div class="transaksi-decision-icon" style="background: #fee2e2; color: #ef4444;">
                                                <i class="mdi mdi-cancel"></i>
                                            </div>
                                            <div class="transaksi-decision-content">
                                                <div class="transaksi-decision-title">DP Hangus</div>
                                                <p class="transaksi-decision-desc mb-0">Sesuai perjanjian yang telah disepakati</p>
                                            </div>
                                            <div class="transaksi-decision-check">
                                                <i class="mdi mdi-check-circle"></i>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="transaksi-action-bar">
                                <a href="{{ url()->previous() }}" class="transaksi-btn transaksi-btn-secondary">
                                    <i class="mdi mdi-arrow-left"></i>
                                    Kembali
                                </a>

                                <button type="submit" class="transaksi-btn transaksi-btn-primary">
                                    <i class="mdi mdi-content-save-outline"></i>
                                    Simpan Konfirmasi
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sticky Sidebar Information -->
            <div class="col-12 col-lg-4">
                <div class="transaksi-sticky">
                    <div class="card">
                        <div class="card-body">
                            <div class="transaksi-section-title">
                                <i class="mdi mdi-lightbulb-on-outline"></i>
                                <span>Informasi & Panduan</span>
                            </div>

                            <div class="transaksi-sidebar-section" style="border-top: none; padding-top: 0; margin-top: 0;">
                                <div class="transaksi-sidebar-title">Status Akad Saat Ini</div>
                                @if($booking->status_akad == 'done')
                                    <div class="transaksi-status-banner success">
                                        <i class="mdi mdi-check-circle-outline"></i>
                                        Akad telah selesai
                                    </div>
                                    @if($booking->status != 'completed')
                                        <div class="mt-3">
                                            <a href="{{ route('booking.serah-terima', $booking->id) }}" class="transaksi-btn transaksi-btn-primary w-100 justify-content-center">
                                                <i class="mdi mdi-key me-1"></i> Lanjut Serah Terima Unit
                                            </a>
                                        </div>
                                    @endif
                                @elseif($booking->status_akad == 'cancelled')
                                    <div class="transaksi-status-banner warning">
                                        <i class="mdi mdi-close-circle-outline"></i>
                                        Akad dibatalkan
                                    </div>
                                @else
                                    <div class="transaksi-status-banner warning">
                                        <i class="mdi mdi-progress-clock"></i>
                                        Menunggu konfirmasi akad
                                    </div>
                                @endif
                            </div>

                            <hr class="my-4">

                            <div class="transaksi-sidebar-section">
                                <div class="transaksi-sidebar-title">Panduan Konfirmasi</div>
                                <ul class="transaksi-mini-list">
                                    <li>
                                        <i class="mdi mdi-check-circle-outline"></i>
                                        <span>Pastikan seluruh dokumen akad telah ditandatangani</span>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-check-circle-outline"></i>
                                        <span>Verifikasi kelengkapan pembayaran sebelum konfirmasi</span>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-check-circle-outline"></i>
                                        <span>Upload dokumen akad sebagai arsip digital</span>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-check-circle-outline"></i>
                                        <span>Isi catatan untuk dokumentasi proses</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="transaksi-sidebar-section">
                                <div class="transaksi-sidebar-title">Checklist Akad</div>
                                <ul class="transaksi-mini-list mb-0">
                                    <li>
                                        <i class="mdi mdi-file-document-outline"></i>
                                        <span>Akta Jual Beli (AJB) ditandatangani</span>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-cash-multiple"></i>
                                        <span>Bukti pelunasan pembayaran</span>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-account-check"></i>
                                        <span>Identitas customer lengkap</span>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-handshake"></i>
                                        <span>Berita acara serah terima dokumen</span>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            const $decisionSelesai = $('#decisionSelesai');
            const $decisionBatal = $('#decisionBatal');
            const $statusInput = $('#statusAkadInput');
            const $formSelesai = $('#formSelesai');
            const $formBatal = $('#formBatal');
            const $errorBox = $('#akadErrorBox');

            function switchDecision(type) {
                $errorBox.hide();

                if (type === 'selesai') {
                    $statusInput.val('selesai');
                    $formSelesai.stop(true, true).slideDown(180);
                    $formBatal.stop(true, true).slideUp(180);
                } else if (type === 'batal') {
                    $statusInput.val('batal');
                    $formBatal.stop(true, true).slideDown(180);
                    $formSelesai.stop(true, true).slideUp(180);
                }
            }

            $decisionSelesai.on('change', function() {
                if ($(this).is(':checked')) {
                    switchDecision('selesai');
                }
            });

            $decisionBatal.on('change', function() {
                if ($(this).is(':checked')) {
                    switchDecision('batal');
                }
            });

            // Alasan lainnya handler
            $('#alasanBatalSelect').on('change', function() {
                const $alasanLainnya = $('#alasanLainnyaGroup');
                if ($(this).val() === 'Lainnya') {
                    $alasanLainnya.slideDown(180);
                } else {
                    $alasanLainnya.slideUp(180);
                }
            });

            // File upload handler
            $('#uploadDokumenSelesai').on('change', function(e) {
                const file = e.target.files[0];
                const $container = $(this).closest('.transaksi-file-upload');

                if (file) {
                    $container.addClass('has-file');
                    const sizeInMB = (file.size / (1024 * 1024)).toFixed(2);
                    $container.find('.transaksi-file-info span').text(file.name.length > 40 ? file.name.substring(0, 40) + '...' : file.name);
                    $container.find('.transaksi-file-info small').text(sizeInMB + ' MB | Format: ' + file.type.split('/').pop().toUpperCase());
                } else {
                    $container.removeClass('has-file');
                    $container.find('.transaksi-file-info span').text('Upload Dokumen Akad');
                    $container.find('.transaksi-file-info small').text('Format: JPG, PNG, PDF (Max 5MB)');
                }
            });

            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#9a55ff'
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan',
                    text: '{{ session('error') }}',
                    confirmButtonColor: '#9a55ff'
                });
            @endif
        });

        $('#formAkadCash').on('submit', function(e) {
            const status = $('#statusAkadInput').val();

            if (!status) {
                e.preventDefault();
                $('#akadErrorBox').stop(true, true).slideDown(160);
                $('html, body').animate({
                    scrollTop: $('#akadErrorBox').offset().top - 120
                }, 300);
                return false;
            }

            if (status === 'selesai') {
                const tanggal = $('input[name="tanggal_akad"]').val();
                if (!tanggal) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Tanggal Akad Harus Diisi',
                        text: 'Silakan isi tanggal pelaksanaan akad',
                        confirmButtonColor: '#9a55ff'
                    });
                    return false;
                }
            }

            if (status === 'batal') {
                const alasan = $('select[name="alasan_batal"]').val();
                if (!alasan) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Alasan Pembatalan Harus Dipilih',
                        text: 'Silakan pilih alasan pembatalan akad',
                        confirmButtonColor: '#9a55ff'
                    });
                    return false;
                }
            }

            e.preventDefault();

            Swal.fire({
                title: 'Simpan Konfirmasi Akad?',
                text: "Pastikan semua data dan dokumen sudah lengkap.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#9a55ff',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Simpan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Menyimpan...',
                        text: 'Mohon tunggu sebentar',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                            e.target.submit();
                        }
                    });
                }
            });
        });
    </script>
@endpush
