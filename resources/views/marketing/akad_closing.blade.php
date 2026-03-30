@extends('layouts.partial.app')

@section('title', 'Verifikasi KPR - Tahap Akad - Property Management App')

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
            line-height: 1.45;
            word-break: break-word;
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

        .badge.bg-info {
            background: linear-gradient(135deg, #17a2b8, #5bc0de) !important;
            color: white;
        }

        .badge.bg-primary {
            background: linear-gradient(135deg, #9a55ff, #da8cff) !important;
            color: white;
        }

        .badge {
            padding: 5px 10px;
            font-weight: 500;
            border-radius: 30px;
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

        .akad-choice-card {
            position: relative;
            height: 100%;
        }

        .akad-choice-card input[type="radio"] {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .akad-choice-label {
            border: 2px solid #ebe7f2;
            border-radius: 18px;
            padding: 1rem;
            cursor: pointer;
            background: #fff;
            transition: all 0.25s ease;
            height: 100%;
            min-height: 150px;
            display: flex;
            gap: 12px;
            align-items: flex-start;
        }

        .akad-choice-label:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(43, 31, 73, 0.07);
        }

        .akad-choice-card.success input[type="radio"]:checked + .akad-choice-label {
            border-color: #7bd3a6;
            background: #edf9f3;
        }

        .akad-choice-card.warning input[type="radio"]:checked + .akad-choice-label {
            border-color: #f2d27a;
            background: #fff8e6;
        }

        .akad-choice-card.danger input[type="radio"]:checked + .akad-choice-label {
            border-color: #ffc9d0;
            background: #fff1f3;
        }

        .akad-choice-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 22px;
        }

        .akad-choice-card.success .akad-choice-icon {
            background: #d9f3e6;
            color: #22a06b;
        }

        .akad-choice-card.warning .akad-choice-icon {
            background: #fff1cc;
            color: #f59f00;
        }

        .akad-choice-card.danger .akad-choice-icon {
            background: #ffe3e6;
            color: #dc3545;
        }

        .akad-choice-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .akad-choice-title {
            font-size: 1rem;
            font-weight: 800;
            color: #2c2e3f;
            margin-bottom: 0.15rem;
        }

        .akad-choice-desc {
            font-size: 0.82rem;
            color: #6c7383;
            margin-bottom: 0;
            line-height: 1.5;
        }

        .akad-choice-check {
            color: #c6ccd8;
            font-size: 1.2rem;
            margin-top: 2px;
        }

        .akad-choice-card input[type="radio"]:checked + .akad-choice-label .akad-choice-check {
            color: #9a55ff;
        }

        .akad-form-shell {
            margin-top: 1rem;
            border-radius: 18px;
            border: 1px solid #ebe7f2;
            padding: 1rem;
            background: #fff;
            display: none;
        }

        .akad-form-shell.success {
            background: linear-gradient(180deg, #fbfffd, #ffffff);
            border-color: #cfe9da;
        }

        .akad-form-shell.warning {
            background: linear-gradient(180deg, #fffef9, #ffffff);
            border-color: #ffe5ab;
        }

        .akad-form-shell.danger {
            background: linear-gradient(180deg, #fff1f3, #ffffff);
            border-color: #ffc9d0;
        }

        .akad-form-title {
            font-size: 1rem;
            font-weight: 800;
            margin-bottom: 0.9rem;
        }

        .akad-form-title.success {
            color: #22a06b;
        }

        .akad-form-title.warning {
            color: #f59f00;
        }

        .akad-form-title.danger {
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

        .akad-next-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .akad-next-card {
            position: relative;
        }

        .akad-next-card input[type="radio"] {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .akad-next-label {
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

        .akad-next-label:hover {
            border-color: #cab0ff;
            background: #faf7ff;
        }

        .akad-next-card input[type="radio"]:checked + .akad-next-label {
            border-color: #9a55ff;
            background: #f7f2ff;
            box-shadow: inset 0 0 0 1px rgba(154, 85, 255, 0.05);
        }

        .akad-next-icon {
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

        .akad-next-content {
            flex: 1;
        }

        .akad-next-title {
            display: block;
            font-size: 0.97rem;
            font-weight: 800;
            color: #2c2e3f;
            margin-bottom: 0.15rem;
        }

        .akad-next-desc {
            display: block;
            font-size: 0.8rem;
            color: #6c7383;
            line-height: 1.4;
        }

        .akad-next-check {
            font-size: 1.1rem;
            color: #c6ccd8;
            margin-top: 2px;
        }

        .akad-next-card input[type="radio"]:checked + .akad-next-label .akad-next-check {
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

        .akad-action-bar {
            margin-top: 1.25rem;
            display: flex;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }

        .kpr-sticky {
            position: sticky;
            top: 20px;
        }

        @media (max-width: 991.98px) {
            .kpr-sticky {
                position: static;
            }

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
                font-size: 1.15rem;
            }

            .customer-booking {
                font-size: 0.9rem;
            }

            .customer-unit-info {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 1rem;
                margin-top: 0.5rem;
            }

            .kpr-steps,
            .akad-next-grid,
            .kpr-summary-grid {
                grid-template-columns: 1fr;
            }

            .akad-action-bar {
                flex-direction: column-reverse;
            }

            .akad-btn {
                width: 100%;
                justify-content: center;
            }

            .kpr-step small {
                display: none !important;
            }

            .kpr-step-icon {
                width: 32px !important;
                height: 32px !important;
            }

            .kpr-step-icon i {
                font-size: 15px !important;
            }

            .akad-choice-label {
                min-height: auto;
            }
        }
    </style>

    @php
        $documentsCount = $kpr->documents->whereNotNull('path')->count();
        $missingDocuments = max(0, 8 - $documentsCount);
        $akadSelesai = optional($kpr->booking->akad)->status === 'selesai';
    @endphp

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
                                        {{ $kpr->booking->customer->full_name ?? '-' }}
                                        @php
                                            $jenis = strtolower($kpr->booking->unit->jenis ?? '');
                                            $badgeClass = $jenis == 'subsidi' ? 'badge-gradient-success' : ($jenis == 'komersil' ? 'badge-gradient-primary' : 'badge-gradient-secondary');
                                        @endphp
                                        <span class="badge {{ $badgeClass }} ms-2" style="font-size: 0.85rem; padding: 0.4rem 1rem;">
                                            <i class="mdi mdi-home-outline me-1"></i>
                                            {{ strtoupper($kpr->booking->unit->jenis ?? '-') }}
                                        </span>
                                    </h4>
                                    <p class="customer-booking mb-0">Booking ID: {{ $kpr->booking->booking_code ?? '-' }}</p>
                                </div>
                            </div>

                            <div class="customer-unit-info">
                                <div class="info-item">
                                    <small>Unit</small>
                                    <span>Tipe {{ $kpr->unit->type ?? '-' }}</span>
                                </div>
                                <div class="info-item">
                                    <small>Blok/No</small>
                                    <span>{{ $kpr->unit->unit_code ?? '-' }}</span>
                                </div>
                                <div class="info-item">
                                    <small>Harga Unit</small>
                                    <span class="text-primary fw-bold">Rp {{ number_format($kpr->unit->price ?? 0, 0, ',', '.') }}</span>
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
                            <span>Tahapan KPR</span>
                        </div>

                        <div class="kpr-progress-top">
                            <span class="kpr-muted">Progress Proses</span>
                            <span>Tahap 3 dari 4</span>
                        </div>

                        <div class="kpr-progress">
                            <div class="kpr-progress-bar" style="width: 75%;"></div>
                        </div>

                        <div class="kpr-steps">
                            <div class="kpr-step completed">
                                <div class="kpr-step-icon">
                                    <i class="mdi mdi-check"></i>
                                </div>
                                <span class="kpr-step-title">Diajukan</span>
                                <small>{{ $kpr->submitted_at ? \Carbon\Carbon::parse($kpr->submitted_at)->translatedFormat('d F Y') : '-' }}</small>
                            </div>

                            <div class="kpr-step completed">
                                <div class="kpr-step-icon">
                                    <i class="mdi mdi-check"></i>
                                </div>
                                <span class="kpr-step-title">Verifikasi</span>
                                <small>{{ $kpr->approved_at ? \Carbon\Carbon::parse($kpr->approved_at)->translatedFormat('d F Y') : \Carbon\Carbon::parse($kpr->updated_at)->translatedFormat('d F Y') }}</small>
                            </div>

                            <div class="kpr-step active">
                                <div class="kpr-step-icon">
                                    <i class="mdi mdi-handshake-outline"></i>
                                </div>
                                <span class="kpr-step-title">Akad</span>
                                <small>Proses Closing</small>
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
                                <span>{{ $kpr->bank->bank_name ?? '-' }}</span>
                            </div>
                            <div class="kpr-detail-item">
                                <span>Jumlah Pinjaman</span>
                                <span>Rp {{ number_format($kpr->jumlah_pinjaman ?? 0, 0, ',', '.') }}</span>
                            </div>
                            <div class="kpr-detail-item">
                                <span>Tenor</span>
                                <span>{{ $kpr->tenor ?? '-' }} Tahun</span>
                            </div>
                            <div class="kpr-detail-item">
                                <span>Angsuran / bln</span>
                                <span class="highlight">Rp {{ number_format($kpr->estimasi_angsuran ?? 0, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <hr class="my-4">

                        <small class="kpr-muted d-block mb-2">Ditangani oleh</small>
                        <div class="kpr-handler">
                            <div class="kpr-handler-icon">
                                <i class="mdi mdi-account-tie"></i>
                            </div>
                            <div>
                                <div class="fw-bold">{{ $kpr->booking->sales->name ?? '-' }}</div>
                                {{-- <small class="kpr-muted">{{ $kpr->booking->sales->role ?? '-' }}</small> --}}
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

                        @if ($documentsCount < 8)
                            <div class="kpr-inline-alert warning">
                                <i class="mdi mdi-alert-circle-outline"></i>
                                <div>
                                    Masih ada
                                    <strong>{{ $missingDocuments }} dokumen</strong>
                                    yang perlu dilengkapi sebelum proses akad final berjalan optimal.
                                </div>
                            </div>
                        @else
                            <div class="kpr-inline-alert success">
                                <i class="mdi mdi-check-circle-outline"></i>
                                <div>Semua dokumen utama telah tersedia dan siap untuk ditinjau pada tahap akad.</div>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table kpr-doc-table align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 40%;">Nama Dokumen</th>
                                        <th style="width: 20%;">Status</th>
                                        <th style="width: 20%;">Tanggal Upload</th>
                                        <th style="width: 20%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($kpr->documents as $doc)
                                        <tr>
                                            <td>
                                                <div class="kpr-doc-name">
                                                    <div class="kpr-doc-icon">
                                                        <i class="mdi mdi-file-document-outline"></i>
                                                    </div>
                                                    <div>
                                                        <div>{{ strtoupper(str_replace('_', ' ', $doc->type ?? '-')) }}</div>
                                                        <small class="kpr-muted">{{ $doc->path ? 'Siap direview' : 'Perlu dilengkapi' }}</small>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                @if ($doc->path)
                                                    <span class="badge bg-success">Lengkap</span>
                                                @else
                                                    <span class="badge bg-danger">Kurang</span>
                                                @endif
                                            </td>

                                            <td>
                                                <span class="kpr-muted">
                                                    {{ $doc->created_at ? \Carbon\Carbon::parse($doc->created_at)->translatedFormat('d M Y') : '-' }}
                                                </span>
                                            </td>

                                            <td>
                                                @if ($doc->path)
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
                                            <td colspan="4" class="text-center text-muted">Belum ada data dokumen</td>
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
                                <span>Informasi Akad</span>
                            </div>

                            <div class="mb-3">
                                @if ($akadSelesai)
                                    <div class="kpr-status-banner success">
                                        <i class="mdi mdi-check-circle-outline"></i>
                                        Akad Sudah Selesai
                                    </div>
                                @else
                                    <div class="kpr-status-banner warning">
                                        <i class="mdi mdi-handshake-outline"></i>
                                        Menunggu Proses Akad
                                    </div>
                                @endif
                            </div>

                            <div class="kpr-summary-grid">
                                <div class="kpr-summary-box success">
                                    <div class="label">Dokumen Lengkap</div>
                                    <div class="value">{{ $documentsCount }}</div>
                                </div>
                                <div class="kpr-summary-box danger">
                                    <div class="label">Dokumen Kurang</div>
                                    <div class="value">{{ $missingDocuments }}</div>
                                </div>
                            </div>

                            <div class="kpr-sidebar-section">
                                <div class="kpr-sidebar-title">Rekomendasi Sistem</div>
                                @if ($documentsCount >= 8)
                                    <div class="kpr-inline-alert success mb-0">
                                        <i class="mdi mdi-check-decagram-outline"></i>
                                        <div>Dokumen sudah lengkap. Proses akad dapat dilanjutkan ke tahap berikutnya.</div>
                                    </div>
                                @else
                                    <div class="kpr-inline-alert warning mb-0">
                                        <i class="mdi mdi-file-alert-outline"></i>
                                        <div>Masih ada dokumen yang perlu dilengkapi agar proses akad berjalan lebih aman dan jelas.</div>
                                    </div>
                                @endif
                            </div>

                            <div class="kpr-sidebar-section">
                                <div class="kpr-sidebar-title">Rencana Akad</div>
                                <ul class="kpr-mini-list mb-0">
                                    <li>
                                        <i class="mdi mdi-calendar-outline"></i>
                                        <span>Rencana akad:
                                            {{ optional($kpr->booking->akad)->tanggal_akad
                                                ? \Carbon\Carbon::parse($kpr->booking->akad->tanggal_akad)->translatedFormat('d F Y')
                                                : '20 Maret 2025' }}
                                        </span>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-map-marker-outline"></i>
                                        <span>Lokasi:
                                            {{ optional($kpr->booking->akad)->lokasi_akad ?? 'Kantor Notaris Siti, SH' }}
                                        </span>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-account-tie-outline"></i>
                                        <span>Notaris:
                                            {{ optional($kpr->booking->akad)->nama_notaris ?? 'Siti Nurhaliza, SH' }}
                                        </span>
                                    </li>
                                </ul>
                            </div>

                            @if ($akadSelesai)
                                <div class="kpr-sidebar-section">
                                    <div class="kpr-sidebar-title">Langkah Berikutnya</div>
                                    <a href="{{ route('kpr.serahterima', $kpr->id) }}" class="akad-btn akad-btn-primary w-100 justify-content-center">
                                        <i class="mdi mdi-home-check-outline"></i>
                                        Proses Serah Terima
                                    </a>
                                </div>
                            @endif
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
                            <i class="mdi mdi-handshake-outline"></i>
                            <span>Proses Akad</span>
                        </div>

                        <div class="kpr-inline-alert info mb-4" id="akadHint">
                            <i class="mdi mdi-information-outline"></i>
                            <div>Pilih salah satu status di bawah ini. Form akan menyesuaikan secara otomatis sesuai hasil proses akad.</div>
                        </div>

                        <form action="{{ route('akad.kpr.store', $kpr->booking_id) }}" method="POST" enctype="multipart/form-data" id="formProsesAkad">
                            @csrf
                            <input type="hidden" name="status" id="statusAkadInput" value="">

                            <div class="row g-3 mb-3 align-items-stretch">
                                <div class="col-12 col-md-6 d-flex">
                                    <div class="akad-choice-card success w-100">
                                        <input type="radio" name="akad_choice" id="choiceSelesai" value="completed">
                                        <label for="choiceSelesai" class="akad-choice-label">
                                            <div class="akad-choice-icon">
                                                <i class="mdi mdi-check-bold"></i>
                                            </div>
                                            <div class="akad-choice-content">
                                                <div class="akad-choice-title">Selesai Akad</div>
                                                <p class="akad-choice-desc mb-0">
                                                    Dokumen dan proses closing telah selesai dan siap lanjut ke tahap berikutnya.
                                                </p>
                                            </div>
                                            <div class="akad-choice-check">
                                                <i class="mdi mdi-check-circle"></i>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 d-flex">
                                    <div class="akad-choice-card danger w-100">
                                        <input type="radio" name="akad_choice" id="choiceTunda" value="cancelled">
                                        <label for="choiceTunda" class="akad-choice-label">
                                            <div class="akad-choice-icon">
                                                <i class="mdi mdi-alert-outline"></i>
                                            </div>
                                            <div class="akad-choice-content">
                                                <div class="akad-choice-title">Tolak akad / Bermasalah</div>
                                                <p class="akad-choice-desc mb-0">
                                                    Ada kendala saat proses akad dan perlu tindak lanjut lebih lanjut.
                                                </p>
                                            </div>
                                            <div class="akad-choice-check">
                                                <i class="mdi mdi-check-circle"></i>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div id="formSelesai" class="akad-form-shell success">
                                <div class="akad-form-title success">Form Penyelesaian Akad</div>

                                <div class="kpr-inline-alert success">
                                    <i class="mdi mdi-check-circle-outline"></i>
                                    <div><strong>Akad selesai.</strong> Pengajuan dapat diarahkan ke proses <strong>Serah Terima</strong>.</div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="akad-form-group">
                                            <label class="akad-form-label">Tanggal Akad</label>
                                            <input type="date"
                                                class="akad-form-control"
                                                name="tanggal_akad"
                                                value="{{ optional($kpr->booking->akad)->tanggal_akad ?? '2025-03-20' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="akad-form-group">
                                            <label class="akad-form-label">Lokasi Akad</label>
                                            <input type="text"
                                                class="akad-form-control"
                                                name="lokasi_akad"
                                                value="{{ optional($kpr->booking->akad)->lokasi_akad ?? 'Kantor Notaris Siti, SH' }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="akad-form-group">
                                            <label class="akad-form-label">Nama Notaris</label>
                                            <input type="text"
                                                class="akad-form-control"
                                                name="nama_notaris"
                                                value="{{ optional($kpr->booking->akad)->nama_notaris ?? 'Siti Nurhaliza, SH' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="akad-form-group">
                                            <label class="akad-form-label">Nomor Akad</label>
                                            <input type="text"
                                                class="akad-form-control"
                                                name="nomor_akad"
                                                id="nomor_akad_selesai"
                                                value="{{ optional($kpr->booking->akad)->nomor_akad ?? 'AKD/2025/03/123' }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="akad-form-group">
                                    <label class="akad-form-label">Upload Dokumen Akad</label>
                                    <div class="verifikasi-file-upload">
                                        <input type="file" name="dokumen_akad" accept=".jpg,.jpeg,.png,.pdf">
                                        <div class="verifikasi-file-label">
                                            <i class="mdi mdi-cloud-upload"></i>
                                            <div class="verifikasi-file-info">
                                                <span>Upload Dokumen Akad</span>
                                                <small>Format: JPG, PNG, PDF (Max 5MB)</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="akad-form-group mb-0">
                                    <label class="akad-form-label">Catatan Akad</label>
                                    <textarea class="akad-form-control"
                                        name="catatan"
                                        rows="3"
                                        placeholder="Contoh: Proses akad selesai, seluruh dokumen telah ditandatangani dan siap lanjut serah terima."></textarea>
                                </div>
                            </div>

                            <div id="formTunda" class="akad-form-shell danger">
                                <div class="akad-form-title danger">Form Penundaan / Kendala Akad</div>

                                <div class="kpr-inline-alert danger">
                                    <i class="mdi mdi-alert-circle-outline"></i>
                                    <div><strong>Akad ditunda atau bermasalah.</strong> Pilih alasan dan tindakan lanjutan agar proses tetap jelas untuk tim dan customer.</div>
                                </div>

                                <div class="akad-form-group">
                                    <label class="akad-form-label">Nomor Akad</label>
                                    <input type="text"
                                        class="akad-form-control"
                                        id="nomor_akad_tunda"
                                        value="{{ optional($kpr->booking->akad)->nomor_akad ?? 'AKD/2025/03/123' }}">
                                </div>

                                <div class="akad-form-group">
                                    <label class="akad-form-label">Alasan Penundaan</label>
                                    <select class="akad-form-control" name="alasan_masalah">
                                        <option value="jadwal_belum_cocok">Jadwal Belum Cocok</option>
                                        <option value="dokumen_kurang">Dokumen Kurang Lengkap</option>
                                        <option value="customer_belum_siap">Customer Belum Siap</option>
                                        <option value="bank_belum_terbit">SP3K Belum Terbit</option>
                                        <option value="lainnya">Lainnya</option>
                                    </select>
                                </div>

                                <div class="akad-form-group">
                                    <label class="akad-form-label">Catatan / Keterangan</label>
                                    <textarea class="akad-form-control"
                                        name="catatan_masalah"
                                        rows="3"
                                        placeholder="Jelaskan detail kendala akad secara spesifik..."></textarea>
                                </div>

                                <div class="akad-form-group mb-0">
                                    <label class="akad-form-label">Tindakan Selanjutnya</label>

                                    <div class="akad-next-grid">
                                        <div class="akad-next-card">
                                            <input type="radio" name="tindakan" id="tindakanJadwalUlang" value="Jadwal Ulang" checked>
                                            <label class="akad-next-label" for="tindakanJadwalUlang">
                                                <div class="akad-next-icon">
                                                    <i class="mdi mdi-calendar-clock-outline"></i>
                                                </div>
                                                <div class="akad-next-content">
                                                    <span class="akad-next-title">Jadwal Ulang</span>
                                                    <span class="akad-next-desc">Atur ulang jadwal akad dengan pihak customer, bank, dan notaris.</span>
                                                </div>
                                                <div class="akad-next-check">
                                                    <i class="mdi mdi-check-circle"></i>
                                                </div>
                                            </label>
                                        </div>

                                        <div class="akad-next-card">
                                            <input type="radio" name="tindakan" id="tindakanLengkapi" value="Lengkapi Dokumen">
                                            <label class="akad-next-label" for="tindakanLengkapi">
                                                <div class="akad-next-icon">
                                                    <i class="mdi mdi-file-document-edit-outline"></i>
                                                </div>
                                                <div class="akad-next-content">
                                                    <span class="akad-next-title">Lengkapi Dokumen</span>
                                                    <span class="akad-next-desc">Dokumen perlu dilengkapi sebelum akad dilanjutkan kembali.</span>
                                                </div>
                                                <div class="akad-next-check">
                                                    <i class="mdi mdi-check-circle"></i>
                                                </div>
                                            </label>
                                        </div>

                                        <div class="akad-next-card">
                                            <input type="radio" name="tindakan" id="tindakanKoordinasiBank" value="Koordinasi Ulang dengan Bank">
                                            <label class="akad-next-label" for="tindakanKoordinasiBank">
                                                <div class="akad-next-icon">
                                                    <i class="mdi mdi-bank-transfer"></i>
                                                </div>
                                                <div class="akad-next-content">
                                                    <span class="akad-next-title">Koordinasi Ulang Bank</span>
                                                    <span class="akad-next-desc">Lakukan follow up ulang ke pihak bank untuk kendala administrasi/SP3K.</span>
                                                </div>
                                                <div class="akad-next-check">
                                                    <i class="mdi mdi-check-circle"></i>
                                                </div>
                                            </label>
                                        </div>

                                        <div class="akad-next-card">
                                            <input type="radio" name="tindakan" id="tindakanReviewInternal" value="Review Internal">
                                            <label class="akad-next-label" for="tindakanReviewInternal">
                                                <div class="akad-next-icon">
                                                    <i class="mdi mdi-clipboard-search-outline"></i>
                                                </div>
                                                <div class="akad-next-content">
                                                    <span class="akad-next-title">Review Internal</span>
                                                    <span class="akad-next-desc">Perlu review tambahan dari tim internal sebelum menentukan jadwal berikutnya.</span>
                                                </div>
                                                <div class="akad-next-check">
                                                    <i class="mdi mdi-check-circle"></i>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="akad-action-bar">
                                <a href="{{ url('/marketing/kpr') }}" class="akad-btn akad-btn-secondary">
                                    <i class="mdi mdi-arrow-left"></i>
                                    Kembali
                                </a>

                                <button type="submit" class="akad-btn akad-btn-primary">
                                    <i class="mdi mdi-content-save-outline"></i>
                                    Simpan Proses Akad
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
                                <span>Panduan Proses</span>
                            </div>

                            <div class="kpr-sidebar-section">
                                <div class="kpr-sidebar-title">Saat Akad Selesai</div>
                                <ul class="kpr-mini-list mb-0">
                                    <li>
                                        <i class="mdi mdi-arrow-right-circle-outline"></i>
                                        <span>Gunakan jika seluruh proses penandatanganan dan closing telah selesai tanpa kendala material.</span>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-right-circle-outline"></i>
                                        <span>Isi tanggal, lokasi, notaris, dan nomor akad agar arsip proses lengkap.</span>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-right-circle-outline"></i>
                                        <span>Upload dokumen akad bila sudah tersedia sebagai bukti administrasi.</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="kpr-sidebar-section">
                                <div class="kpr-sidebar-title">Saat Ditunda / Bermasalah</div>
                                <ul class="kpr-mini-list mb-0">
                                    <li>
                                        <i class="mdi mdi-arrow-right-circle-outline"></i>
                                        <span>Gunakan jika ada hambatan jadwal, dokumen, kesiapan customer, atau proses dari bank/notaris.</span>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-right-circle-outline"></i>
                                        <span>Jelaskan alasan kendala secara spesifik dan mudah ditindaklanjuti.</span>
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

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal Proses',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    <script>
        $(document).ready(function() {
            const $choiceSelesai = $('#choiceSelesai');
            const $choiceTunda = $('#choiceTunda');
            const $statusInput = $('#statusAkadInput');
            const $formSelesai = $('#formSelesai');
            const $formTunda = $('#formTunda');

            function switchAkad(type) {
                if (type === 'completed') {
                    $statusInput.val('completed');
                    $formSelesai.stop(true, true).slideDown(180);
                    $formTunda.stop(true, true).slideUp(180);
                    $('#nomor_akad_selesai').attr('name', 'nomor_akad');
                    $('#nomor_akad_tunda').removeAttr('name');
                } else if (type === 'cancelled') {
                    $statusInput.val('cancelled');
                    $formTunda.stop(true, true).slideDown(180);
                    $formSelesai.stop(true, true).slideUp(180);
                    $('#nomor_akad_tunda').attr('name', 'nomor_akad');
                    $('#nomor_akad_selesai').removeAttr('name');
                }
            }

            $choiceSelesai.on('change', function() {
                if ($(this).is(':checked')) {
                    switchAkad('completed');
                }
            });

            $choiceTunda.on('change', function() {
                if ($(this).is(':checked')) {
                    switchAkad('cancelled');
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
        });
    </script>
@endpush
