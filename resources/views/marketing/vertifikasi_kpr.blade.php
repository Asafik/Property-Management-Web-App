@extends('layouts.partial.app')

@section('title', 'Verifikasi KPR - Properti Management')

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
            font-size: 1.4rem;
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
            grid-template-columns: repeat(3, minmax(90px, auto));
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
            grid-template-columns: repeat(4, 1fr);
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

        .kpr-summary-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
            margin-bottom: 1rem;
        }

        .kpr-summary-box {
            border: 1px solid #ebe7f2;
            background: #fbf9fe;
            border-radius: 16px;
            padding: 1rem;
        }

        .kpr-summary-box .label {
            font-size: 0.75rem;
            color: #6c7383;
            margin-bottom: 0.35rem;
        }

        .kpr-summary-box .value {
            font-size: 1.2rem;
            font-weight: 800;
        }

        .kpr-summary-box.success .value {
            color: #22a06b;
        }

        .kpr-summary-box.danger .value {
            color: #dc3545;
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

        .kpr-doc-table th {
            font-size: 0.82rem;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            color: #5d6472;
            background: #faf8fd;
            border-bottom: 1px solid #ebe7f2;
            font-weight: 600;
        }

        .kpr-doc-table td {
            vertical-align: middle;
            padding-top: 0.95rem;
            padding-bottom: 0.95rem;
            border-color: #f0edf5;
        }

        .kpr-doc-name {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            color: #2c2e3f;
        }

        .kpr-doc-icon {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            background: #f4ecff;
            color: #9a55ff;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .badge.bg-warning {
            background: linear-gradient(135deg, #ffc107, #ffdb6d) !important;
            color: #2c2e3f;
        }

        .badge.bg-success {
            background: linear-gradient(135deg, #28a745, #5cb85c) !important;
            color: white;
        }

        .badge.bg-danger {
            background: linear-gradient(135deg, #dc3545, #e4606d) !important;
            color: white;
        }

        .badge {
            padding: 5px 10px;
            font-weight: 500;
            border-radius: 30px;
        }

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

        .kpr-doc-action {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #d8c4ff;
            background: #fff;
            color: #9a55ff;
            transition: all 0.25s ease;
        }

        .kpr-doc-action:hover {
            background: #f4ecff;
            color: #7f3df0;
            transform: translateY(-1px);
        }

        .kpr-doc-action.disabled,
        .kpr-doc-action:disabled {
            border-color: #eaecf0;
            color: #b3b9c5;
            background: #f9fafb;
            cursor: not-allowed;
        }

        .kpr-decision-card {
            position: relative;
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

        .kpr-decision-card.approve input[type="radio"]:checked + .kpr-decision-label {
            border-color: #7bd3a6;
            background: #edf9f3;
        }

        .kpr-decision-card.reject input[type="radio"]:checked + .kpr-decision-label {
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

        .kpr-decision-card input[type="radio"]:checked + .kpr-decision-label .kpr-decision-check {
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

        .kpr-next-step-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .kpr-next-card {
            position: relative;
        }

        .kpr-next-card input[type="radio"] {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .kpr-next-label {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            padding: 1rem;
            border-radius: 18px;
            border: 2px solid #ebe7f2;
            background: #fff;
            cursor: pointer;
            min-height: 110px;
            transition: all 0.25s ease;
        }

        .kpr-next-label:hover {
            border-color: #cab0ff;
            background: #faf7ff;
        }

        .kpr-next-card input[type="radio"]:checked + .kpr-next-label {
            border-color: #9a55ff;
            background: #f7f2ff;
            box-shadow: inset 0 0 0 1px rgba(154, 85, 255, 0.05);
        }

        .kpr-next-icon {
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

        .kpr-next-content {
            flex: 1;
        }

        .kpr-next-title {
            display: block;
            font-size: 0.97rem;
            font-weight: 800;
            color: #2c2e3f;
            margin-bottom: 0.15rem;
        }

        .kpr-next-desc {
            display: block;
            font-size: 0.8rem;
            color: #6c7383;
            line-height: 1.4;
        }

        .kpr-next-check {
            font-size: 1.1rem;
            color: #c6ccd8;
            margin-top: 2px;
        }

        .kpr-next-card input[type="radio"]:checked + .kpr-next-label .kpr-next-check {
            color: #9a55ff;
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

        .kpr-decision-summary {
            display: none;
        }

        .kpr-decision-summary .summary-state {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 0.5rem 0.8rem;
            border-radius: 999px;
            font-size: 0.82rem;
            font-weight: 700;
        }

        .kpr-decision-summary.approve .summary-state {
            background: #edf9f3;
            color: #22a06b;
        }

        .kpr-decision-summary.reject .summary-state {
            background: #fff1f3;
            color: #dc3545;
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
                font-size: 1.15rem;
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
            .kpr-next-step-grid,
            .kpr-summary-grid {
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
                                        <span class="jenis-badge">
                                            <i class="mdi mdi-home-outline"></i>
                                            {{ strtoupper($booking->unit->jenis ?? '-') }}
                                        </span>
                                    </h4>
                                    <p class="customer-booking mb-0">Booking ID: {{ $booking->booking_code ?? '-' }}</p>
                                </div>
                            </div>

                            <div class="customer-unit-info">
                                <div class="info-item">
                                    <small>Unit</small>
                                    <span>{{ $booking->unit->unit_name ?? '-' }}</span>
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
                        <div class="kpr-section-title">
                            <i class="mdi mdi-timeline-text"></i>
                            <span>Tahapan Verifikasi KPR</span>
                        </div>

                        <div class="kpr-progress-top">
                            <span class="kpr-muted">Progress Proses</span>
                            <span>Tahap 2 dari 4</span>
                        </div>

                        <div class="kpr-progress">
                            <div class="kpr-progress-bar" style="width: 50%;"></div>
                        </div>

                        <div class="kpr-steps">
                            <div class="kpr-step completed">
                                <div class="kpr-step-icon">
                                    <i class="mdi mdi-check"></i>
                                </div>
                                <span class="kpr-step-title">Diajukan</span>
                                <small>{{ $booking->kprApplication->submitted_at ? \Carbon\Carbon::parse($booking->kprApplication->submitted_at)->translatedFormat('d F Y') : '-' }}</small>
                            </div>

                            <div class="kpr-step active">
                                <div class="kpr-step-icon">
                                    <i class="mdi mdi-file-document-edit-outline"></i>
                                </div>
                                <span class="kpr-step-title">Verifikasi</span>
                                <small>Dalam Proses</small>
                            </div>

                            <div class="kpr-step">
                                <div class="kpr-step-icon">
                                    <i class="mdi mdi-handshake-outline"></i>
                                </div>
                                <span class="kpr-step-title">Akad</span>
                                <small>Menunggu</small>
                            </div>

                            <div class="kpr-step">
                                <div class="kpr-step-icon">
                                    <i class="mdi mdi-home-outline"></i>
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
                            <span>Detail KPR</span>
                        </div>

                        <div class="kpr-detail-list">
                            <div class="kpr-detail-item">
                                <span>Bank Tujuan</span>
                                <span>{{ $booking->kprApplication->bank->bank_name ?? '-' }}</span>
                            </div>
                            <div class="kpr-detail-item">
                                <span>Jumlah Pinjaman</span>
                                <span>Rp {{ number_format($booking->kprApplication->jumlah_pinjaman ?? 0, 0, ',', '.') }}</span>
                            </div>
                            <div class="kpr-detail-item">
                                <span>Tenor</span>
                                <span>{{ $booking->kprApplication->tenor ?? '-' }} Tahun</span>
                            </div>
                            <div class="kpr-detail-item">
                                <span>Angsuran / bln</span>
                                <span class="highlight">Rp {{ number_format($booking->kprApplication->estimasi_angsuran ?? 0, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <hr class="my-4">

                        <small class="kpr-muted d-block mb-2">Ditangani oleh</small>
                        <div class="kpr-handler">
                            <div class="kpr-handler-icon">
                                <i class="mdi mdi-account-tie"></i>
                            </div>
                            <div>
                                <div class="fw-bold">{{ $booking->sales->name ?? '-' }}</div>
                                {{-- <small class="kpr-muted">{{ $booking->sales->role ?? '-' }}</small> --}}
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
                        <div class="kpr-section-title">
                            <i class="mdi mdi-file-document-multiple-outline"></i>
                            <span>Kelengkapan Dokumen</span>
                        </div>

                        @if (
                            collect(['ktp', 'kk', 'npwp', 'slip_gaji', 'rekening_koran', 'surat_nikah', 'sku', 'ktp_pasangan'])
                                ->filter(fn($type) => collect($booking->kprApplication->documents ?? [])->firstWhere('type', $type))
                                ->count() < 8
                        )
                            <div class="kpr-inline-alert warning">
                                <i class="mdi mdi-alert-circle-outline"></i>
                                <div>
                                    Masih ada
                                    <strong>
                                        {{
                                            8 -
                                            collect(['ktp', 'kk', 'npwp', 'slip_gaji', 'rekening_koran', 'surat_nikah', 'sku', 'ktp_pasangan'])
                                                ->filter(fn($type) => collect($booking->kprApplication->documents ?? [])->firstWhere('type', $type))
                                                ->count()
                                        }}
                                        dokumen
                                    </strong>
                                    yang perlu dilengkapi sebelum proses verifikasi final.
                                </div>
                            </div>
                        @else
                            <div class="kpr-inline-alert success">
                                <i class="mdi mdi-check-circle-outline"></i>
                                <div>Semua dokumen utama telah tersedia dan siap untuk ditinjau.</div>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table kpr-doc-table align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 38%;">Nama Dokumen</th>
                                        <th style="width: 20%;">Status</th>
                                        <th style="width: 22%;">Tanggal Upload</th>
                                        <th style="width: 20%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse (['ktp', 'kk', 'npwp', 'slip_gaji', 'rekening_koran', 'surat_nikah', 'sku', 'ktp_pasangan'] as $type)
                                        @php
                                            $doc = collect($booking->kprApplication->documents ?? [])->firstWhere('type', $type);
                                        @endphp
                                        <tr>
                                            <td>
                                                <div class="kpr-doc-name">
                                                    <div class="kpr-doc-icon">
                                                        <i class="mdi mdi-file-document-outline"></i>
                                                    </div>
                                                    <div>
                                                        <div>{{ strtoupper(str_replace('_', ' ', $type)) }}</div>
                                                        <small class="kpr-muted">{{ $doc ? 'Siap direview' : 'Perlu dilengkapi' }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge {{ $doc ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $doc ? 'Lengkap' : 'Kurang' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="kpr-muted">
                                                    {{ $doc ? \Carbon\Carbon::parse($doc->created_at)->translatedFormat('d M Y') : '-' }}
                                                </span>
                                            </td>
                                            <td>
                                                @if ($doc)
                                                    <a href="{{ asset('storage/' . $doc->path) }}"
                                                        target="_blank"
                                                        class="kpr-doc-action"
                                                        title="Lihat dokumen">
                                                        <i class="mdi mdi-eye-outline"></i>
                                                    </a>
                                                @else
                                                    <button type="button"
                                                        class="kpr-doc-action disabled"
                                                        title="Dokumen belum tersedia"
                                                        disabled>
                                                        <i class="mdi mdi-eye-off-outline"></i>
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted">
                                                Belum ada data dokumen
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="text-muted small mt-3 d-block d-sm-none">
                            <i class="mdi mdi-information-outline me-1"></i>
                            Geser tabel untuk melihat kolom lainnya
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="kpr-sticky">
                    <div class="card">
                        <div class="card-body">
                            <div class="kpr-section-title">
                                <i class="mdi mdi-clipboard-text-outline"></i>
                                <span>Informasi Verifikasi</span>
                            </div>

                            <div class="mb-3">
                                @if (
                                    collect(['ktp', 'kk', 'npwp', 'slip_gaji', 'rekening_koran', 'surat_nikah', 'sku', 'ktp_pasangan'])
                                        ->filter(fn($type) => collect($booking->kprApplication->documents ?? [])->firstWhere('type', $type))
                                        ->count() === 8
                                )
                                    <div class="kpr-status-banner success">
                                        <i class="mdi mdi-check-circle-outline"></i>
                                        Semua Dokumen Lengkap
                                    </div>
                                @else
                                    <div class="kpr-status-banner warning">
                                        <i class="mdi mdi-progress-clock"></i>
                                        Menunggu Kelengkapan Dokumen
                                    </div>
                                @endif
                            </div>

                            <div class="kpr-summary-grid">
                                <div class="kpr-summary-box success">
                                    <div class="label">Dokumen Lengkap</div>
                                    <div class="value">
                                        {{
                                            collect(['ktp', 'kk', 'npwp', 'slip_gaji', 'rekening_koran', 'surat_nikah', 'sku', 'ktp_pasangan'])
                                                ->filter(fn($type) => collect($booking->kprApplication->documents ?? [])->firstWhere('type', $type))
                                                ->count()
                                        }}
                                    </div>
                                </div>
                                <div class="kpr-summary-box danger">
                                    <div class="label">Dokumen Kurang</div>
                                    <div class="value">
                                        {{
                                            8 -
                                            collect(['ktp', 'kk', 'npwp', 'slip_gaji', 'rekening_koran', 'surat_nikah', 'sku', 'ktp_pasangan'])
                                                ->filter(fn($type) => collect($booking->kprApplication->documents ?? [])->firstWhere('type', $type))
                                                ->count()
                                        }}
                                    </div>
                                </div>
                            </div>

                            <div class="kpr-sidebar-section">
                                <div class="kpr-sidebar-title">Rekomendasi Sistem</div>
                                @if (
                                    collect(['ktp', 'kk', 'npwp', 'slip_gaji', 'rekening_koran', 'surat_nikah', 'sku', 'ktp_pasangan'])
                                        ->filter(fn($type) => collect($booking->kprApplication->documents ?? [])->firstWhere('type', $type))
                                        ->count() === 8
                                )
                                    <div class="kpr-inline-alert success mb-0">
                                        <i class="mdi mdi-check-decagram-outline"></i>
                                        <div>Dokumen sudah lengkap. Verifikasi dapat dilanjutkan ke pengambilan keputusan.</div>
                                    </div>
                                @else
                                    <div class="kpr-inline-alert warning mb-0">
                                        <i class="mdi mdi-file-alert-outline"></i>
                                        <div>
                                            Fokus utama saat ini adalah melengkapi
                                            {{
                                                8 -
                                                collect(['ktp', 'kk', 'npwp', 'slip_gaji', 'rekening_koran', 'surat_nikah', 'sku', 'ktp_pasangan'])
                                                    ->filter(fn($type) => collect($booking->kprApplication->documents ?? [])->firstWhere('type', $type))
                                                    ->count()
                                            }}
                                            dokumen yang belum tersedia.
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="kpr-sidebar-section kpr-decision-summary" id="decisionSummary">
                                <div class="kpr-sidebar-title">Ringkasan Keputusan</div>
                                <div class="summary-state" id="decisionStateBadge">
                                    <i class="mdi mdi-help-circle-outline"></i>
                                    <span id="decisionStateText">Belum dipilih</span>
                                </div>

                                <ul class="kpr-mini-list mt-3 mb-0" id="decisionSummaryList">
                                    <li>
                                        <i class="mdi mdi-information-outline"></i>
                                        <span>Pilih keputusan verifikasi untuk melihat ringkasan langkah berikutnya.</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="kpr-sidebar-section">
                                <div class="kpr-sidebar-title">Checklist Review</div>
                                <ul class="kpr-mini-list mb-0">
                                    <li>
                                        <i class="mdi mdi-check-circle-outline"></i>
                                        <span>Pastikan seluruh dokumen yang tersedia sudah ditinjau.</span>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-check-circle-outline"></i>
                                        <span>Isi catatan verifikasi agar keputusan mudah dilacak tim berikutnya.</span>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-check-circle-outline"></i>
                                        <span>Unggah berita acara bila dibutuhkan untuk arsip proses.</span>
                                    </li>
                                </ul>
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
                        <div class="kpr-section-title">
                            <i class="mdi mdi-shield-check-outline"></i>
                            <span>Keputusan Verifikasi KPR</span>
                        </div>

                        <div class="kpr-inline-alert info mb-4" id="decisionHint">
                            <i class="mdi mdi-information-outline"></i>
                            <div>Pilih salah satu keputusan di bawah ini. Form akan menyesuaikan secara otomatis sesuai status verifikasi.</div>
                        </div>

                        <div class="kpr-inline-alert danger kpr-error-box" id="decisionErrorBox">
                            <i class="mdi mdi-alert-circle-outline"></i>
                            <div>Silakan pilih keputusan verifikasi terlebih dahulu sebelum submit.</div>
                        </div>

                        <form action="{{ route('kpr.verifikasi.store', $booking->id) }}" method="POST" enctype="multipart/form-data" id="formVerifikasiKpr">
                            @csrf
                            <input type="hidden" name="status" id="statusVerifikasiInput" value="">

                            <div class="row g-3 mb-3">
                                <div class="col-12 col-md-6">
                                    <div class="kpr-decision-card approve">
                                        <input type="radio" name="decision_choice" id="decisionApprove" value="survey">
                                        <label for="decisionApprove" class="kpr-decision-label">
                                            <div class="kpr-decision-icon">
                                                <i class="mdi mdi-check-bold"></i>
                                            </div>
                                            <div class="kpr-decision-content">
                                                <div class="kpr-decision-title">Setujui Verifikasi</div>
                                                <p class="kpr-decision-desc mb-0">Dokumen dan data dinilai memadai untuk lanjut ke tahap survey.</p>
                                            </div>
                                            <div class="kpr-decision-check">
                                                <i class="mdi mdi-check-circle"></i>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="kpr-decision-card reject">
                                        <input type="radio" name="decision_choice" id="decisionReject" value="rejected">
                                        <label for="decisionReject" class="kpr-decision-label">
                                            <div class="kpr-decision-icon">
                                                <i class="mdi mdi-close-thick"></i>
                                            </div>
                                            <div class="kpr-decision-content">
                                                <div class="kpr-decision-title">Tolak Verifikasi</div>
                                                <p class="kpr-decision-desc mb-0">Pengajuan belum dapat dilanjutkan dan perlu tindakan lanjutan.</p>
                                            </div>
                                            <div class="kpr-decision-check">
                                                <i class="mdi mdi-check-circle"></i>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div id="formSetuju" class="kpr-form-shell approve">
                                <div class="kpr-form-title approve">Form Persetujuan Verifikasi</div>

                                <div class="kpr-inline-alert success">
                                    <i class="mdi mdi-check-circle-outline"></i>
                                    <div><strong>Verifikasi disetujui.</strong> Pengajuan akan diarahkan ke tahap <strong>Survey</strong>.</div>
                                </div>

                                <div class="kpr-form-group">
                                    <label class="kpr-form-label" for="catatan_setuju">Catatan Verifikasi</label>
                                    <textarea id="catatan_setuju"
                                              class="kpr-form-control"
                                              name="catatan_setuju"
                                              rows="4"
                                              placeholder="Contoh: Semua dokumen lengkap, valid, dan layak dilanjutkan ke tahap survey."></textarea>
                                </div>

                                <div class="kpr-form-group mb-0">
                                    <label class="kpr-form-label">Upload Berita Acara (Opsional)</label>
                                    <div class="verifikasi-file-upload">
                                        <input type="file" name="berita_acara_setuju" accept=".jpg,.jpeg,.png,.pdf">
                                        <div class="verifikasi-file-label">
                                            <i class="mdi mdi-cloud-upload"></i>
                                            <div class="verifikasi-file-info">
                                                <span>Upload Berita Acara</span>
                                                <small>Format: JPG, PNG, PDF (Max 5MB)</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="formTolak" class="kpr-form-shell reject">
                                <div class="kpr-form-title reject">Form Penolakan Verifikasi</div>

                                <div class="kpr-inline-alert danger">
                                    <i class="mdi mdi-close-circle-outline"></i>
                                    <div><strong>Verifikasi ditolak.</strong> Pilih alasan dan tindakan lanjutan agar proses tetap jelas untuk customer dan internal.</div>
                                </div>

                                <div class="kpr-form-group">
                                    <label class="kpr-form-label" for="catatan_tolak">Catatan / Alasan</label>
                                    <textarea id="catatan_tolak"
                                              class="kpr-form-control"
                                              name="catatan_tolak"
                                              rows="4"
                                              placeholder="Contoh: NPWP belum tersedia dan rekening koran belum sesuai periode yang diminta."></textarea>
                                </div>

                                <div class="kpr-form-group">
                                    <label class="kpr-form-label">Upload Berita Acara (Opsional)</label>
                                    <div class="verifikasi-file-upload">
                                        <input type="file" name="berita_acara_tolak" accept=".jpg,.jpeg,.png,.pdf">
                                        <div class="verifikasi-file-label">
                                            <i class="mdi mdi-cloud-upload"></i>
                                            <div class="verifikasi-file-info">
                                                <span>Upload Berita Acara</span>
                                                <small>Format: JPG, PNG, PDF (Max 5MB)</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="kpr-form-group mb-0">
                                    <label class="kpr-form-label">Tindakan Selanjutnya</label>

                                    <div class="kpr-next-step-grid">
                                        <div class="kpr-next-card">
                                            <input type="radio" name="tindakan" id="tindakanLengkapi" value="Lengkapi Dokumen" checked>
                                            <label class="kpr-next-label" for="tindakanLengkapi">
                                                <div class="kpr-next-icon">
                                                    <i class="mdi mdi-file-document-edit-outline"></i>
                                                </div>
                                                <div class="kpr-next-content">
                                                    <span class="kpr-next-title">Lengkapi Dokumen</span>
                                                    <span class="kpr-next-desc">Customer diminta melengkapi dokumen yang belum tersedia atau belum valid.</span>
                                                </div>
                                                <div class="kpr-next-check">
                                                    <i class="mdi mdi-check-circle"></i>
                                                </div>
                                            </label>
                                        </div>

                                        <div class="kpr-next-card">
                                            <input type="radio" name="tindakan" id="tindakanUlang" value="Ajukan ke Bank Lain">
                                            <label class="kpr-next-label" for="tindakanUlang">
                                                <div class="kpr-next-icon">
                                                    <i class="mdi mdi-bank-transfer-out"></i>
                                                </div>
                                                <div class="kpr-next-content">
                                                    <span class="kpr-next-title">Ajukan ke Bank Lain</span>
                                                    <span class="kpr-next-desc">Pengajuan diulang ke bank lain dengan penyesuaian kelengkapan bila diperlukan.</span>
                                                </div>
                                                <div class="kpr-next-check">
                                                    <i class="mdi mdi-check-circle"></i>
                                                </div>
                                            </label>
                                        </div>

                                        <div class="kpr-next-card">
                                            <input type="radio" name="tindakan" id="tindakanCash" value="Pindah ke Cash">
                                            <label class="kpr-next-label" for="tindakanCash">
                                                <div class="kpr-next-icon">
                                                    <i class="mdi mdi-cash-multiple"></i>
                                                </div>
                                                <div class="kpr-next-content">
                                                    <span class="kpr-next-title">Pindah ke Cash</span>
                                                    <span class="kpr-next-desc">Customer melanjutkan pembelian dengan metode pembayaran tunai.</span>
                                                </div>
                                                <div class="kpr-next-check">
                                                    <i class="mdi mdi-check-circle"></i>
                                                </div>
                                            </label>
                                        </div>

                                        <div class="kpr-next-card">
                                            <input type="radio" name="tindakan" id="tindakanBatal" value="Batalkan Transaksi">
                                            <label class="kpr-next-label" for="tindakanBatal">
                                                <div class="kpr-next-icon">
                                                    <i class="mdi mdi-cancel"></i>
                                                </div>
                                                <div class="kpr-next-content">
                                                    <span class="kpr-next-title">Batalkan Transaksi</span>
                                                    <span class="kpr-next-desc">Customer membatalkan transaksi pembelian dan proses diarahkan ke refund.</span>
                                                </div>
                                                <div class="kpr-next-check">
                                                    <i class="mdi mdi-check-circle"></i>
                                                </div>
                                            </label>
                                        </div>

                                        <div class="kpr-next-card">
                                            <input type="radio" name="tindakan" id="tindakanBanding" value="Banding Ulang">
                                            <label class="kpr-next-label" for="tindakanBanding">
                                                <div class="kpr-next-icon">
                                                    <i class="mdi mdi-scale-balance"></i>
                                                </div>
                                                <div class="kpr-next-content">
                                                    <span class="kpr-next-title">Banding Ulang</span>
                                                    <span class="kpr-next-desc">Ajukan banding atau review ulang ke bank yang sama dengan catatan tambahan.</span>
                                                </div>
                                                <div class="kpr-next-check">
                                                    <i class="mdi mdi-check-circle"></i>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="kpr-action-bar">
                                <a href="{{ url('/marketing/kpr') }}" class="kpr-btn kpr-btn-secondary">
                                    <i class="mdi mdi-arrow-left"></i>
                                    Kembali
                                </a>

                                <button type="submit" class="kpr-btn kpr-btn-primary">
                                    <i class="mdi mdi-content-save-outline"></i>
                                    Simpan Verifikasi
                                </button>
                            </div>
                        </form>

                        <div class="text-muted small mt-3 d-block d-sm-none">
                            <i class="mdi mdi-information-outline me-1"></i>
                            Scroll untuk melihat seluruh isi form
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="kpr-sticky">
                    <div class="card">
                        <div class="card-body">
                            <div class="kpr-section-title">
                                <i class="mdi mdi-lightbulb-on-outline"></i>
                                <span>Panduan Keputusan</span>
                            </div>

                            <div class="kpr-sidebar-section">
                                <div class="kpr-sidebar-title">Saat Disetujui</div>
                                <ul class="kpr-mini-list mb-0">
                                    <li>
                                        <i class="mdi mdi-arrow-right-circle-outline"></i>
                                        <span>Gunakan jika dokumen utama lengkap dan tidak ada temuan material.</span>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-right-circle-outline"></i>
                                        <span>Tambahkan catatan singkat agar tim survey memahami konteks review.</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="kpr-sidebar-section">
                                <div class="kpr-sidebar-title">Saat Ditolak</div>
                                <ul class="kpr-mini-list mb-0">
                                    <li>
                                        <i class="mdi mdi-arrow-right-circle-outline"></i>
                                        <span>Jelaskan alasan penolakan secara spesifik dan dapat ditindaklanjuti.</span>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-right-circle-outline"></i>
                                        <span>Pilih tindakan lanjutan yang paling relevan agar proses berikutnya tidak ambigu.</span>
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
        $(document).ready(function() {
            const $decisionApprove = $('#decisionApprove');
            const $decisionReject = $('#decisionReject');
            const $statusInput = $('#statusVerifikasiInput');
            const $formSetuju = $('#formSetuju');
            const $formTolak = $('#formTolak');
            const $decisionErrorBox = $('#decisionErrorBox');
            const $decisionSummary = $('#decisionSummary');
            const $decisionStateText = $('#decisionStateText');
            const $decisionSummaryList = $('#decisionSummaryList');

            function renderSummary(type) {
                $decisionSummary.removeClass('approve reject').show();

                if (type === 'survey') {
                    $decisionSummary.addClass('approve');
                    $decisionStateText.text('Verifikasi Disetujui');
                    $decisionSummaryList.html(`
                        <li>
                            <i class="mdi mdi-check-circle-outline"></i>
                            <span>Status booking akan diarahkan ke tahap <strong>Survey</strong>.</span>
                        </li>
                        <li>
                            <i class="mdi mdi-note-text-outline"></i>
                            <span>Isi catatan singkat sebagai referensi untuk tim berikutnya.</span>
                        </li>
                        <li>
                            <i class="mdi mdi-paperclip"></i>
                            <span>Berita acara bisa ditambahkan bila diperlukan untuk arsip.</span>
                        </li>
                    `);
                } else if (type === 'rejected') {
                    $decisionSummary.addClass('reject');
                    const tindakan = $('input[name="tindakan"]:checked').val() || 'Lengkapi Dokumen';
                    $decisionStateText.text('Verifikasi Ditolak');
                    $decisionSummaryList.html(`
                        <li>
                            <i class="mdi mdi-close-circle-outline"></i>
                            <span>Pengajuan tidak dilanjutkan ke tahap survey pada kondisi saat ini.</span>
                        </li>
                        <li>
                            <i class="mdi mdi-arrow-right-bold-circle-outline"></i>
                            <span>Tindakan lanjutan terpilih: <strong>${tindakan}</strong>.</span>
                        </li>
                        <li>
                            <i class="mdi mdi-note-text-outline"></i>
                            <span>Catatan alasan penolakan sebaiknya diisi dengan detail yang jelas.</span>
                        </li>
                    `);
                }
            }

            function switchDecision(type) {
                $decisionErrorBox.hide();

                if (type === 'survey') {
                    $statusInput.val('survey');
                    $formSetuju.stop(true, true).slideDown(180);
                    $formTolak.stop(true, true).slideUp(180);
                    renderSummary('survey');
                } else if (type === 'rejected') {
                    $statusInput.val('rejected');
                    $formTolak.stop(true, true).slideDown(180);
                    $formSetuju.stop(true, true).slideUp(180);
                    renderSummary('rejected');
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

            $(document).on('change', 'input[name="tindakan"]', function() {
                if ($decisionReject.is(':checked')) {
                    renderSummary('rejected');
                }
            });

            $(document).on('change', 'input[type="file"]', function(e) {
                const file = e.target.files[0];
                const $container = $(this).closest('.verifikasi-file-upload');

                if (file) {
                    const sizeInMB = (file.size / (1024 * 1024)).toFixed(2);
                    $container.find('.verifikasi-file-info span').text(file.name);
                    $container.find('.verifikasi-file-info small').text(sizeInMB + ' MB');
                }
            });

            $('#formVerifikasiKpr').on('submit', function(e) {
                if (!$statusInput.val()) {
                    e.preventDefault();
                    $decisionErrorBox.stop(true, true).slideDown(160);

                    $('html, body').animate({
                        scrollTop: $decisionErrorBox.offset().top - 120
                    }, 300);
                }
            });
        });
    </script>
@endpush
