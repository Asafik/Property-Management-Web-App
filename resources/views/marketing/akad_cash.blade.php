@extends('layouts.partial.app')

@section('title', 'Konfirmasi Akad Cash - Properti Management')

@section('content')
    <style>
        .akad-page .card {
            border: 1px solid #ebe7f2;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(29, 21, 44, 0.05);
            overflow: hidden;
        }

        .akad-page .card-body {
            padding: 1.25rem;
        }

        .akad-section-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.15rem;
            font-weight: 800;
            color: #2c2e3f;
            margin-bottom: 1rem;
        }

        .akad-section-title i {
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

        .akad-muted {
            color: #6c7383 !important;
        }

        .akad-progress-top {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 0.5rem;
        }

        .akad-progress-top span:last-child {
            color: #9a55ff;
            font-weight: 700;
        }

        .akad-progress {
            width: 100%;
            height: 12px;
            background: #ece9f3;
            border-radius: 999px;
            overflow: hidden;
            margin-bottom: 1.25rem;
        }

        .akad-progress-bar {
            height: 100%;
            border-radius: 999px;
            background: linear-gradient(90deg, #c184ff, #9a55ff);
        }

        .akad-steps {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 12px;
        }

        .akad-step {
            text-align: center;
            position: relative;
        }

        .akad-step-icon {
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

        .akad-step.completed .akad-step-icon {
            background: #28a745 !important;
            color: #fff;
        }

        .akad-step.active .akad-step-icon {
            background: #ffc107 !important;
            color: #fff;
            box-shadow: 0 0 0 3px rgba(255, 193, 7, 0.2);
        }

        .akad-step-title {
            display: block;
            font-size: 0.82rem;
            font-weight: 700;
            color: #2c2e3f;
        }

        .akad-step small {
            display: block;
            color: #6c7383;
            font-size: 0.72rem;
            line-height: 1.35;
        }

        .akad-detail-list {
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
        }

        .akad-detail-item {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            align-items: flex-start;
        }

        .akad-detail-item span:first-child {
            color: #6c7383;
        }

        .akad-detail-item span:last-child {
            color: #2c2e3f;
            font-weight: 700;
            text-align: right;
        }

        .akad-detail-item .highlight {
            color: #9a55ff !important;
        }

        .akad-handler {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0.85rem;
            background: #fbf9fe;
            border: 1px solid #ebe7f2;
            border-radius: 14px;
        }

        .akad-handler-icon {
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

        .akad-inline-alert {
            border-radius: 14px;
            padding: 0.9rem 1rem;
            font-size: 0.88rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .akad-inline-alert i {
            font-size: 1rem;
            margin-top: 2px;
        }

        .akad-inline-alert.info {
            background: #f6f7fb;
            border-color: #e7eaf3;
            color: #4b5565;
        }

        .akad-inline-alert.warning {
            background: #fff8e6;
            border-color: #ffe29b;
            color: #8a6a00;
        }

        .akad-inline-alert.success {
            background: #edf9f3;
            border-color: #b9e7cf;
            color: #146c43;
        }

        .akad-inline-alert.danger {
            background: #fff1f3;
            border-color: #ffc9d0;
            color: #b42318;
        }

        .akad-summary-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
            margin-bottom: 1rem;
        }

        .akad-summary-box {
            border: 1px solid #ebe7f2;
            background: #fbf9fe;
            border-radius: 16px;
            padding: 1rem;
        }

        .akad-summary-box .label {
            font-size: 0.75rem;
            color: #6c7383;
            margin-bottom: 0.35rem;
        }

        .akad-summary-box .value {
            font-size: 1.2rem;
            font-weight: 800;
        }

        .akad-summary-box.success .value {
            color: #22a06b;
        }

        .akad-summary-box.danger .value {
            color: #dc3545;
        }

        .akad-status-banner {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 0.55rem 0.9rem;
            border-radius: 999px;
            font-size: 0.86rem;
            font-weight: 700;
        }

        .akad-status-banner.success {
            background: #edf9f3;
            color: #22a06b;
        }

        .akad-status-banner.warning {
            background: #fff8e6;
            color: #8a6a00;
        }

        /* DECISION CARDS - SAMA PERSIS DENGAN VERIFIKASI KPR */
        .akad-decision-card {
            position: relative;
        }

        .akad-decision-card input[type="radio"] {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .akad-decision-label {
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

        .akad-decision-label:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(43, 31, 73, 0.07);
        }

        .akad-decision-card.selesai input[type="radio"]:checked + .akad-decision-label {
            border-color: #7bd3a6;
            background: #edf9f3;
        }

        .akad-decision-card.batal input[type="radio"]:checked + .akad-decision-label {
            border-color: #f3a7b2;
            background: #fff1f3;
        }

        .akad-decision-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 22px;
        }

        .akad-decision-card.selesai .akad-decision-icon {
            background: #d9f3e6;
            color: #22a06b;
        }

        .akad-decision-card.batal .akad-decision-icon {
            background: #ffe2e8;
            color: #dc3545;
        }

        .akad-decision-content {
            flex: 1;
        }

        .akad-decision-title {
            font-size: 1rem;
            font-weight: 800;
            color: #2c2e3f;
            margin-bottom: 0.15rem;
        }

        .akad-decision-desc {
            font-size: 0.82rem;
            color: #6c7383;
            margin-bottom: 0;
        }

        .akad-decision-check {
            color: #c6ccd8;
            font-size: 1.2rem;
            margin-top: 2px;
        }

        .akad-decision-card input[type="radio"]:checked + .akad-decision-label .akad-decision-check {
            color: #9a55ff;
        }

        /* FORM SHELL */
        .akad-form-shell {
            margin-top: 1rem;
            border-radius: 18px;
            border: 1px solid #ebe7f2;
            padding: 1rem;
            background: #fff;
            display: none;
        }

        .akad-form-shell.selesai {
            background: linear-gradient(180deg, #fbfffd, #ffffff);
            border-color: #cfe9da;
        }

        .akad-form-shell.batal {
            background: linear-gradient(180deg, #fffafb, #ffffff);
            border-color: #ffd7de;
        }

        .akad-form-title {
            font-size: 1rem;
            font-weight: 800;
            margin-bottom: 0.9rem;
        }

        .akad-form-title.selesai {
            color: #22a06b;
        }

        .akad-form-title.batal {
            color: #dc3545;
        }

        .akad-form-group {
            margin-bottom: 1rem;
        }

        .akad-form-label {
            display: block;
            font-size: 0.86rem;
            font-weight: 700;
            color: #2c2e3f;
            margin-bottom: 0.45rem;
        }

        .akad-form-control {
            width: 100%;
            border: 1px solid #e6e8ef;
            border-radius: 14px;
            padding: 0.85rem 0.95rem;
            font-size: 0.9rem;
            color: #2c2e3f;
            transition: all 0.2s ease;
            background: #fff;
        }

        .akad-form-control:focus {
            border-color: #c6a6ff;
            box-shadow: 0 0 0 4px rgba(154, 85, 255, 0.1);
            outline: none;
        }

        select.akad-form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%239a55ff' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.95rem center;
            background-size: 14px;
        }

        .akad-input-group {
            display: flex;
            align-items: center;
        }

        .akad-input-group-prepend {
            margin-right: -1px;
        }

        .akad-input-group-text {
            background: #f8f9fa;
            border: 1px solid #e6e8ef;
            border-radius: 14px 0 0 14px;
            padding: 0.85rem 0.95rem;
            font-size: 0.9rem;
            color: #9a55ff;
            font-weight: 600;
        }

        .akad-input-group .akad-form-control {
            border-radius: 0 14px 14px 0;
        }

        .akad-file-upload {
            position: relative;
            width: 100%;
        }

        .akad-file-upload input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
            z-index: 2;
        }

        .akad-file-upload .akad-file-label {
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
            .akad-file-upload .akad-file-label {
                flex-direction: row;
                text-align: left;
                gap: 8px;
                padding: 0.75rem 1rem;
                min-height: auto;
            }
        }

        .akad-file-upload:hover .akad-file-label {
            border-color: #9a55ff;
            background: linear-gradient(135deg, #f1f0ff, #f8f9fa);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(154, 85, 255, 0.1);
        }

        .akad-file-upload .akad-file-label i {
            font-size: 1.6rem;
            color: #9a55ff;
            background: rgba(154, 85, 255, 0.1);
            padding: 8px;
            border-radius: 50%;
        }

        .akad-file-upload .akad-file-label .akad-file-info {
            flex: 1;
            width: 100%;
        }

        .akad-file-upload .akad-file-label .akad-file-info span {
            display: block;
            font-weight: 600;
            color: #2c2e3f;
            font-size: 0.8rem;
            word-break: break-word;
        }

        .akad-file-upload .akad-file-label .akad-file-info small {
            color: #6c7383;
            font-size: 0.65rem;
            display: block;
            margin-top: 2px;
        }

        /* TINDAKAN GRID - SAMA DENGAN VERIFIKASI KPR */
        .akad-tindakan-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .akad-tindakan-card {
            position: relative;
        }

        .akad-tindakan-card input[type="radio"] {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .akad-tindakan-label {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            padding: 1rem;
            border-radius: 18px;
            border: 2px solid #ebe7f2;
            background: #fff;
            cursor: pointer;
            transition: all 0.25s ease;
        }

        .akad-tindakan-label:hover {
            border-color: #cab0ff;
            background: #faf7ff;
        }

        .akad-tindakan-card input[type="radio"]:checked + .akad-tindakan-label {
            border-color: #9a55ff;
            background: #f7f2ff;
            box-shadow: inset 0 0 0 1px rgba(154, 85, 255, 0.05);
        }

        .akad-tindakan-icon {
            width: 46px;
            height: 46px;
            border-radius: 14px;
            background: #f4ecff;
            color: #9a55ff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }

        .akad-tindakan-content {
            flex: 1;
        }

        .akad-tindakan-title {
            display: block;
            font-size: 0.97rem;
            font-weight: 800;
            color: #2c2e3f;
            margin-bottom: 0.15rem;
        }

        .akad-tindakan-desc {
            display: block;
            font-size: 0.8rem;
            color: #6c7383;
            line-height: 1.4;
        }

        .akad-tindakan-check {
            font-size: 1.1rem;
            color: #c6ccd8;
            margin-top: 2px;
        }

        .akad-tindakan-card input[type="radio"]:checked + .akad-tindakan-label .akad-tindakan-check {
            color: #9a55ff;
        }

        .akad-sidebar-section {
            border: 1px solid #ebe7f2;
            border-radius: 16px;
            padding: 1rem;
            background: #fff;
        }

        .akad-sidebar-section + .akad-sidebar-section {
            margin-top: 1rem;
        }

        .akad-sidebar-title {
            font-size: 0.95rem;
            font-weight: 800;
            color: #2c2e3f;
            margin-bottom: 0.75rem;
        }

        .akad-mini-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .akad-mini-list li {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            font-size: 0.84rem;
            color: #6c7383;
            margin-bottom: 0.55rem;
        }

        .akad-mini-list li i {
            color: #9a55ff;
            margin-top: 2px;
        }

        .akad-action-bar {
            margin-top: 1.25rem;
            display: flex;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }

        .akad-btn {
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

        .akad-btn:hover {
            transform: translateY(-1px);
            text-decoration: none;
        }

        .akad-btn-primary {
            background: linear-gradient(90deg, #c784ff, #9a55ff);
            color: #fff;
            box-shadow: 0 8px 18px rgba(154, 85, 255, 0.22);
        }

        .akad-btn-primary:hover {
            color: #fff;
            box-shadow: 0 12px 24px rgba(154, 85, 255, 0.28);
        }

        .akad-btn-secondary {
            background: #fff;
            color: #2c2e3f;
            border: 1px solid #ebe7f2;
        }

        .akad-btn-secondary:hover {
            border-color: #cab0ff;
            color: #7f3df0;
            background: #faf7ff;
        }

        .akad-error-box {
            display: none;
            margin-top: 1rem;
        }

        .akad-sticky {
            position: sticky;
            top: 20px;
        }

        @media (max-width: 991.98px) {
            .akad-sticky {
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

            .akad-steps,
            .akad-tindakan-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .akad-action-bar {
                flex-direction: column-reverse;
            }

            .akad-btn {
                justify-content: center;
                width: 100%;
            }
        }
    </style>

    <div class="akad-page">
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
                                    <h4 class="customer-name mb-1">{{ $booking->customer->full_name ?? '-' }}</h4>
                                    <p class="customer-booking mb-0">Booking ID: {{ $booking->booking_code ?? '-' }}</p>
                                </div>
                            </div>

                            <div class="customer-unit-info">
                                <div class="info-item">
                                    <small>Unit</small>
                                    <span>{{ $booking->unit->LandBank->name ?? '-' }} - {{ $booking->unit->type ?? '-' }}</span>
                                </div>
                                <div class="info-item">
                                    <small>Jenis Unit</small>
                                    <span>{{ $booking->unit->jenis ?? '-' }}</span>
                                </div>
                                <div class="info-item">
                                    <small>Blok/No</small>
                                    <span>{{ $booking->unit->unit_code ?? '-' }}</span>
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

        <div class="row mt-4">
            <div class="col-12 col-lg-8 mb-4 mb-lg-0">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="akad-section-title">
                            <i class="mdi mdi-timeline-text"></i>
                            <span>Tahapan Akad Cash</span>
                        </div>

                        @php
                            $steps = [
                                'booking' => 'Booking',
                                'cash' => 'Pelunasan',
                                'legal' => 'Persiapan Legal',
                                'construction' => 'Pembangunan',
                                'akad' => 'Akad',
                                'completed' => 'Serah Terima',
                            ];
                            $isBookingDone = !empty($booking->booking_date);
                            $isCashDone = strtolower($booking->status_cash ?? '') == 'done';
                            $isLegalDone = strtolower($booking->status_legal ?? '') == 'done';
                            $construction = strtolower($booking->unit->construction_progress ?? '');
                            $isBuildDone = $construction == 'selesai';
                            $isAkadDone = $booking->status_akad == 'done';
                            $isCompleted = $booking->status == 'completed';

                            $completedCount = 0;
                            if ($isBookingDone) $completedCount++;
                            if ($isCashDone) $completedCount++;
                            if ($isLegalDone) $completedCount++;
                            if ($isBuildDone) $completedCount++;
                            if ($isAkadDone) $completedCount++;

                            $progressPercent = ($completedCount / 6) * 100;
                        @endphp

                        <div class="akad-progress-top">
                            <span class="akad-muted">Progress Akad</span>
                            <span>{{ $completedCount }} dari 6 tahap selesai</span>
                        </div>

                        <div class="akad-progress">
                            <div class="akad-progress-bar" style="width: {{ $progressPercent }}%;"></div>
                        </div>

                        <div class="akad-steps">
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
                                        } elseif ($isCashDone && $isLegalDone && $isBuildDone) {
                                            $isStepActive = true;
                                        }
                                    }
                                    if ($key == 'completed') {
                                        $isStepCompleted = $isCompleted;
                                    }
                                @endphp

                                <div class="akad-step {{ $isStepCompleted ? 'completed' : ($isStepActive ? 'active' : '') }}">
                                    <div class="akad-step-icon">
                                        @if ($isStepCompleted)
                                            <i class="mdi mdi-check"></i>
                                        @elseif($isStepActive)
                                            @if ($key == 'booking')
                                                <i class="mdi mdi-book-open-page-variant"></i>
                                            @elseif($key == 'cash')
                                                <i class="mdi mdi-cash"></i>
                                            @elseif($key == 'legal')
                                                <i class="mdi mdi-file-document-outline"></i>
                                            @elseif($key == 'construction')
                                                <i class="mdi mdi-home-city-outline"></i>
                                            @elseif($key == 'akad')
                                                <i class="mdi mdi-handshake"></i>
                                            @else
                                                <i class="mdi mdi-key"></i>
                                            @endif
                                        @else
                                            <i class="mdi mdi-circle-outline"></i>
                                        @endif
                                    </div>
                                    <span class="akad-step-title">{{ $label }}</span>
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

            <div class="col-12 col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="akad-section-title">
                            <i class="mdi mdi-cash-multiple"></i>
                            <span>Detail Pembayaran</span>
                        </div>

                        <div class="akad-detail-list">
                            <div class="akad-detail-item">
                                <span>Harga Unit</span>
                                <span>Rp {{ number_format($booking->unit->price ?? 0, 0, ',', '.') }}</span>
                            </div>
                            <div class="akad-detail-item">
                                <span>Diskon / Negosiasi</span>
                                <span class="highlight">- Rp {{ number_format($booking->unit->harga_nego ?? 0, 0, ',', '.') }}</span>
                            </div>
                            <div class="akad-detail-item">
                                <span>Harga Final</span>
                                <span class="highlight">Rp {{ number_format(($booking->unit->price ?? 0) - ($booking->unit->harga_nego ?? 0), 0, ',', '.') }}</span>
                            </div>
                            <div class="akad-detail-item">
                                <span>Booking Fee</span>
                                <span>Rp {{ number_format($booking->booking_fee ?? 0, 0, ',', '.') }}</span>
                            </div>
                            <div class="akad-detail-item">
                                <span>Sisa Pembayaran</span>
                                <span class="highlight">Rp {{ number_format((($booking->unit->price ?? 0) - ($booking->unit->harga_nego ?? 0)) - ($booking->booking_fee ?? 0), 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="mb-3">
                            <small class="akad-muted d-block mb-2">Status Pembayaran</small>
                            @php
                                $finalPayment = $booking->finalPayment->type ?? null;
                            @endphp
                            <div class="akad-status-banner {{ $finalPayment == 'pelunasan' ? 'success' : 'warning' }}">
                                <i class="mdi {{ $finalPayment == 'pelunasan' ? 'mdi-check-circle-outline' : 'mdi-progress-clock' }}"></i>
                                <span>{{ $finalPayment == 'pelunasan' ? 'Lunas' : ($finalPayment ? ucfirst($finalPayment) : 'Menunggu Pelunasan') }}</span>
                            </div>
                        </div>

                        <hr class="my-4">

                        <small class="akad-muted d-block mb-2">Ditangani oleh</small>
                        <div class="akad-handler">
                            <div class="akad-handler-icon">
                                <i class="mdi mdi-account-tie"></i>
                            </div>
                            <div>
                                <div class="fw-bold">{{ $booking->sales->name ?? '-' }}</div>
                                <small class="akad-muted">{{ $booking->sales->role ?? 'Marketing' }}</small>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div>
                            <small class="akad-muted d-block mb-2">Metode Pembayaran</small>
                            <div class="akad-status-banner {{ $booking->purchase_type == 'cash' ? 'success' : ($booking->purchase_type == 'kpr' ? 'warning' : 'info') }}">
                                <i class="mdi {{ $booking->purchase_type == 'cash' ? 'mdi-cash' : ($booking->purchase_type == 'kpr' ? 'mdi-bank' : 'mdi-calendar-clock') }}"></i>
                                <span>
                                    {{ $booking->purchase_type == 'cash' ? 'Cash Keras' : ($booking->purchase_type == 'kpr' ? 'KPR' : ($booking->purchase_type == 'cash_tempo' ? 'Cash Tempo' : '-')) }}
                                </span>
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
                        <div class="akad-section-title">
                            <i class="mdi mdi-handshake"></i>
                            <span>Konfirmasi Akad Cash</span>
                        </div>

                        <div class="akad-inline-alert info mb-4">
                            <i class="mdi mdi-information-outline"></i>
                            <div>Pilih salah satu keputusan di bawah ini. Form akan menyesuaikan secara otomatis sesuai status akad.</div>
                        </div>

                        <div class="akad-inline-alert danger akad-error-box" id="akadErrorBox">
                            <i class="mdi mdi-alert-circle-outline"></i>
                            <div>Silakan pilih status akad terlebih dahulu sebelum submit.</div>
                        </div>

                        <form action="{{ route('akad.cash.store', $booking->id) }}" method="POST" enctype="multipart/form-data" id="formAkadCash">
                            @csrf
                            <input type="hidden" name="status_akad" id="statusAkadInput" value="">

                            <!-- DECISION CARDS - SAMA PERSIS DENGAN VERIFIKASI KPR -->
                            <div class="row g-3 mb-3">
                                <div class="col-12 col-md-6">
                                    <div class="akad-decision-card selesai">
                                        <input type="radio" name="decision_choice" id="decisionSelesai" value="selesai">
                                        <label for="decisionSelesai" class="akad-decision-label">
                                            <div class="akad-decision-icon">
                                                <i class="mdi mdi-check-bold"></i>
                                            </div>
                                            <div class="akad-decision-content">
                                                <div class="akad-decision-title">Akad Selesai</div>
                                                <p class="akad-decision-desc mb-0">Proses akad telah selesai dan siap lanjut ke serah terima unit.</p>
                                            </div>
                                            <div class="akad-decision-check">
                                                <i class="mdi mdi-check-circle"></i>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="akad-decision-card batal">
                                        <input type="radio" name="decision_choice" id="decisionBatal" value="batal">
                                        <label for="decisionBatal" class="akad-decision-label">
                                            <div class="akad-decision-icon">
                                                <i class="mdi mdi-close-thick"></i>
                                            </div>
                                            <div class="akad-decision-content">
                                                <div class="akad-decision-title">Akad Batal</div>
                                                <p class="akad-decision-desc mb-0">Proses akad dibatalkan dan perlu tindakan lanjutan.</p>
                                            </div>
                                            <div class="akad-decision-check">
                                                <i class="mdi mdi-check-circle"></i>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- FORM AKAD SELESAI -->
                            <div id="formSelesai" class="akad-form-shell selesai">
                                <div class="akad-form-title selesai">Form Akad Selesai</div>

                                <div class="akad-inline-alert success">
                                    <i class="mdi mdi-check-circle-outline"></i>
                                    <div><strong>Akad disetujui.</strong> Pengajuan akan diarahkan ke tahap <strong>Serah Terima</strong>.</div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="akad-form-group">
                                            <label class="akad-form-label">No. Akad</label>
                                            <input type="text" name="no_akad" class="akad-form-control"
                                                value="AKAD/CASH/{{ date('Y') }}/{{ str_pad($booking->id, 4, '0', STR_PAD_LEFT) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="akad-form-group">
                                            <label class="akad-form-label">Tanggal Akad</label>
                                            <input type="date" name="tanggal_akad" class="akad-form-control"
                                                value="{{ date('Y-m-d') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="akad-form-group">
                                            <label class="akad-form-label">Total Pembayaran</label>
                                            <div class="akad-input-group">
                                                <div class="akad-input-group-prepend">
                                                    <span class="akad-input-group-text">Rp</span>
                                                </div>
                                                <input type="text" class="akad-form-control"
                                                    value="{{ number_format(($booking->unit->price ?? 0) - ($booking->unit->harga_nego ?? 0), 0, ',', '.') }}"
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="akad-form-group">
                                            <label class="akad-form-label">Status Pembayaran</label>
                                            <select name="status_pembayaran" class="akad-form-control">
                                                <option value="lunas" selected>Lunas</option>
                                                <option value="bertahap">Bertahap (Belum Lunas)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="akad-form-group">
                                    <label class="akad-form-label">Upload Dokumen Akad</label>
                                    <div class="akad-file-upload">
                                        <input type="file" name="dokumen" id="uploadDokumenSelesai" accept=".jpg,.jpeg,.png,.pdf">
                                        <div class="akad-file-label">
                                            <i class="mdi mdi-cloud-upload"></i>
                                            <div class="akad-file-info">
                                                <span>Upload Dokumen Akad</span>
                                                <small>Format: JPG, PNG, PDF (Max 5MB)</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="akad-form-group">
                                    <label class="akad-form-label">Catatan Akad</label>
                                    <textarea name="catatan" class="akad-form-control" rows="3" placeholder="Contoh: Proses akad berjalan lancar, seluruh dokumen telah ditandatangani."></textarea>
                                </div>
                            </div>

                            <!-- FORM AKAD BATAL -->
                            <div id="formBatal" class="akad-form-shell batal">
                                <div class="akad-form-title batal">Form Pembatalan Akad</div>

                                <div class="akad-inline-alert danger">
                                    <i class="mdi mdi-close-circle-outline"></i>
                                    <div><strong>Akad dibatalkan.</strong> Pilih alasan dan tindakan lanjutan.</div>
                                </div>

                                <div class="akad-form-group">
                                    <label class="akad-form-label">Alasan Pembatalan</label>
                                    <select name="alasan_batal" id="alasanBatalSelect" class="akad-form-control">
                                        <option value="">-- Pilih Alasan --</option>
                                        <option value="customer batal">Customer Batal Beli</option>
                                        <option value="dana tidak cukup">Dana Tidak Cukup</option>
                                        <option value="masalah dokumen">Masalah Dokumen</option>
                                        <option value="mengundurkan diri">Customer Mengundurkan Diri</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>

                                <div class="akad-form-group" id="alasanLainnyaGroup" style="display: none;">
                                    <label class="akad-form-label">Tulis Alasan Lainnya</label>
                                    <input type="text" name="alasan_lainnya" class="akad-form-control" placeholder="Contoh: Masalah internal perusahaan">
                                </div>

                                <div class="akad-form-group">
                                    <label class="akad-form-label">Catatan Pembatalan</label>
                                    <textarea name="catatan" class="akad-form-control" rows="3" placeholder="Detail pembatalan..."></textarea>
                                </div>

                                <hr class="my-4">

                                <label class="akad-form-label">Tindakan Selanjutnya</label>
                                <div class="akad-tindakan-grid">
                                    <div class="akad-tindakan-card">
                                        <input type="radio" name="tindakan" id="tindakanRefund" value="refund" checked>
                                        <label class="akad-tindakan-label" for="tindakanRefund">
                                            <div class="akad-tindakan-icon">
                                                <i class="mdi mdi-cash-refund"></i>
                                            </div>
                                            <div class="akad-tindakan-content">
                                                <span class="akad-tindakan-title">Refund DP</span>
                                                <span class="akad-tindakan-desc">Kembalikan uang muka sesuai ketentuan</span>
                                            </div>
                                            <div class="akad-tindakan-check">
                                                <i class="mdi mdi-check-circle"></i>
                                            </div>
                                        </label>
                                    </div>

                                    <div class="akad-tindakan-card">
                                        <input type="radio" name="tindakan" id="tindakanHangus" value="hangus">
                                        <label class="akad-tindakan-label" for="tindakanHangus">
                                            <div class="akad-tindakan-icon">
                                                <i class="mdi mdi-cancel"></i>
                                            </div>
                                            <div class="akad-tindakan-content">
                                                <span class="akad-tindakan-title">DP Hangus</span>
                                                <span class="akad-tindakan-desc">Sesuai perjanjian yang telah disepakati</span>
                                            </div>
                                            <div class="akad-tindakan-check">
                                                <i class="mdi mdi-check-circle"></i>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="akad-action-bar">
                                <a href="{{ url('/marketing/booking') }}" class="akad-btn akad-btn-secondary">
                                    <i class="mdi mdi-arrow-left"></i>
                                    Kembali
                                </a>

                                <button type="submit" class="akad-btn akad-btn-primary">
                                    <i class="mdi mdi-content-save-outline"></i>
                                    Simpan Konfirmasi
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="akad-sticky">
                    <div class="card">
                        <div class="card-body">
                            <div class="akad-section-title">
                                <i class="mdi mdi-lightbulb-on-outline"></i>
                                <span>Informasi & Panduan</span>
                            </div>

                            <div class="akad-sidebar-section">
                                <div class="akad-sidebar-title">Status Akad Saat Ini</div>
                                @if($booking->status_akad == 'done')
                                    <div class="akad-status-banner success">
                                        <i class="mdi mdi-check-circle-outline"></i>
                                        Akad telah selesai
                                    </div>
                                    @if($booking->status != 'completed')
                                        <div class="mt-3">
                                            <a href="{{ route('booking.serah-terima', $booking->id) }}" class="akad-btn akad-btn-primary w-100">
                                                <i class="mdi mdi-key me-1"></i> Lanjut Serah Terima Unit
                                            </a>
                                        </div>
                                    @endif
                                @elseif($booking->status_akad == 'cancelled')
                                    <div class="akad-status-banner warning">
                                        <i class="mdi mdi-close-circle-outline"></i>
                                        Akad dibatalkan
                                    </div>
                                @else
                                    <div class="akad-status-banner warning">
                                        <i class="mdi mdi-progress-clock"></i>
                                        Menunggu konfirmasi akad
                                    </div>
                                @endif
                            </div>

                            <div class="akad-sidebar-section">
                                <div class="akad-sidebar-title">Panduan Konfirmasi</div>
                                <ul class="akad-mini-list">
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

                            <div class="akad-sidebar-section">
                                <div class="akad-sidebar-title">Checklist Akad</div>
                                <ul class="akad-mini-list mb-0">
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
                const $container = $(this).closest('.akad-file-upload');

                if (file) {
                    const sizeInMB = (file.size / (1024 * 1024)).toFixed(2);
                    $container.find('.akad-file-info span').text(file.name.length > 40 ? file.name.substring(0, 40) + '...' : file.name);
                    $container.find('.akad-file-info small').text(sizeInMB + ' MB | Format: ' + file.type.split('/').pop().toUpperCase());
                } else {
                    $container.find('.akad-file-info span').text('Upload Dokumen Akad');
                    $container.find('.akad-file-info small').text('Format: JPG, PNG, PDF (Max 5MB)');
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
