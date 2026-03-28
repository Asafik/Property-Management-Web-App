@extends('layouts.partial.app')

@section('title', 'Serah Terima Unit - Properti Management')

@section('content')
    <style>
        .kpr-page .card {
            border: 1px solid #ebe7f2;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(29, 21, 44, 0.05);
            overflow: hidden;
            transition: all 0.25s ease;
        }

        .kpr-page .card:hover {
            box-shadow: 0 12px 28px rgba(29, 21, 44, 0.08);
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

        .kpr-summary-box.warning .value {
            color: #f59f00;
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

        .badge {
            padding: 5px 10px;
            font-weight: 500;
            border-radius: 30px;
        }

        .badge.bg-success {
            background: linear-gradient(135deg, #28a745, #5cb85c) !important;
            color: #ffffff !important;
        }

        .badge.bg-warning {
            background: linear-gradient(135deg, #ffc107, #ffdb6d) !important;
            color: #2c2e3f !important;
        }

        .badge.bg-primary {
            background: linear-gradient(135deg, #9a55ff, #da8cff) !important;
            color: #ffffff !important;
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

        .serah-checklist-item input[type="checkbox"]:checked+.check-label {
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

        .serah-checklist-item input[type="checkbox"]:checked+.check-label .check-icon {
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

        .serah-doc-item input[type="checkbox"]:checked+.doc-label {
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

        .serah-doc-item input[type="checkbox"]:checked+.doc-label .doc-badge {
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

        .kpr-sidebar-section {
            border: 1px solid #ebe7f2;
            border-radius: 16px;
            padding: 1rem;
            background: #fff;
        }

        .kpr-sidebar-section+.kpr-sidebar-section {
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

        .kpr-sticky {
            position: sticky;
            top: 20px;
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

        .approval-check-green input[type="checkbox"]:checked+.check-label {
            border-color: #7bd3a6;
            background: #edf9f3;
            box-shadow: inset 0 0 0 1px rgba(34, 160, 107, 0.05);
        }

        .approval-check-green input[type="checkbox"]:checked+.check-label .check-icon {
            background: #d9f3e6;
            color: #22a06b;
        }

        .approval-check-green input[type="checkbox"]:checked+.check-label .check-text {
            color: #146c43;
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
            .kpr-summary-grid,
            .serah-checklist-wrapper {
                grid-template-columns: 1fr;
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
                                        {{ $booking->customer->full_name ?? 'Ngebug boy' }}
                                        <span class="jenis-badge">
                                            <i class="mdi mdi-home-outline"></i>
                                            {{ $booking->unit->jenis == 'komersil' ? 'KOMERSIL' : strtoupper($booking->unit->jenis ?? '-') }}
                                        </span>
                                    </h4>
                                    <p class="customer-booking mb-0">Kode Booking: {{ $booking->booking_code ?? 'Ngebug boy' }}</p>
                                </div>
                            </div>

                            <div class="customer-unit-info">
                                <div class="info-item">
                                    <small>Unit</small>
                                    <span>{{ $booking->unit->landBank->name ?? 'Ngebug boy' }} - {{ $booking->unit->type ?? 'Ngebug Boy' }}</span>
                                </div>
                                <div class="info-item">
                                    <small>Blok/No</small>
                                    <span>{{ $booking->unit->unit_code ?? 'Ngebug boy' }}</span>
                                </div>
                                <div class="info-item">
                                    <small>Status Pembangunan</small>
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
                                    <span>{{ $progressMap[$booking->unit->construction_progress] ?? '-' }}</span>
                                </div>
                                <div class="info-item">
                                    <small>Harga Unit</small>
                                    <span class="text-primary fw-bold">{{ $booking->unit->price ? 'Rp ' . number_format($booking->unit->price, 0, ',', '.') : 'Ngebug Boy' }}</span>
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
                            <span>Tahapan Serah Terima Unit</span>
                        </div>

                        <div class="kpr-progress-top">
                            <span class="kpr-muted">Progress Transaksi</span>
                            <span>Tahap Akhir: Serah Terima</span>
                        </div>

                        <div class="kpr-progress">
                            <div class="kpr-progress-bar" style="width: 90%;"></div>
                        </div>

                        <div class="kpr-steps">
                            <div class="kpr-step completed">
                                <div class="kpr-step-icon">
                                    <i class="mdi mdi-check"></i>
                                </div>
                                <span class="kpr-step-title">Booking</span>
                                <small>{{ isset($booking->booking_date) ? \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('d F Y') : '-' }}</small>
                            </div>

                            <div class="kpr-step completed">
                                <div class="kpr-step-icon">
                                    <i class="mdi mdi-check"></i>
                                </div>
                                <span class="kpr-step-title">Pelunasan</span>
                                <small>{{ isset($booking->pelunasan_date) ? \Carbon\Carbon::parse($booking->pelunasan_date)->translatedFormat('d F Y') : '-' }}</small>
                            </div>

                            <div class="kpr-step completed">
                                <div class="kpr-step-icon">
                                    <i class="mdi mdi-check"></i>
                                </div>
                                <span class="kpr-step-title">Akad</span>
                                <small>{{ isset($booking->akad_date) ? \Carbon\Carbon::parse($booking->akad_date)->translatedFormat('d F Y') : '-' }}</small>
                            </div>

                            <div class="kpr-step active">
                                <div class="kpr-step-icon">
                                    <i class="mdi mdi-key"></i>
                                </div>
                                <span class="kpr-step-title">Serah Terima</span>
                                <small>Sedang Proses</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="kpr-section-title">
                            <i class="mdi mdi-cash-multiple"></i>
                            <span>Status Pembayaran</span>
                        </div>

                        <div class="kpr-detail-list">
                            <div class="kpr-detail-item">
                                <span>Harga Unit</span>
                                <span>{{ $booking->unit->price ? 'Rp ' . number_format($booking->unit->price, 0, ',', '.') : 'Ngebug Boy' }}</span>
                            </div>
                            <div class="kpr-detail-item">
                                <span>Diskon</span>
                                <span class="highlight">{{ $booking->harga_nego ? 'Rp ' . number_format($booking->harga_nego, 0, ',', '.') : '-' }}</span>
                            </div>
                            <div class="kpr-detail-item">
                                <span>Total Dibayar</span>
                                <span class="highlight">Rp {{ number_format(($booking->unit->price ?? 0) - ($booking->harga_nego ?? 0), 0, ',', '.') }}</span>
                            </div>
                            <div class="kpr-detail-item">
                                <span>Status</span>
                                <span>
                                    <span class="badge {{ ($booking->status_cash ?? '') == 'done' ? 'bg-success' : (($booking->status_cash ?? '') == 'process' ? 'bg-warning' : 'bg-warning') }}">
                                        {{ ($booking->status_cash ?? '') == 'done' ? 'Lunas' : (($booking->status_cash ?? '') == 'process' ? 'Proses' : 'Belum Lunas') }}
                                    </span>
                                </span>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="kpr-detail-list">
                            <div class="kpr-detail-item">
                                <span>Metode Pembayaran</span>
                                <span class="badge bg-success">Cash</span>
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
                                <small class="kpr-muted">{{ $booking->sales->role ?? '-' }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('serah-terima.store', $booking->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row mt-4">
                <div class="col-12 col-lg-8 mb-4 mb-lg-0">
                    <div class="card">
                        <div class="card-body">
                            <div class="kpr-section-title">
                                <i class="mdi mdi-key"></i>
                                <span>Form Serah Terima Unit</span>
                            </div>

                            <div class="kpr-inline-alert info">
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

                            <div class="kpr-section-title mb-3">
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

                            <div class="kpr-section-title mb-3">
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

                            <div class="kpr-section-title mb-3">
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

                <div class="col-12 col-lg-4">
                    <div class="kpr-sticky">
                        <div class="card">
                            <div class="card-body">
                                <div class="kpr-section-title">
                                    <i class="mdi mdi-clipboard-check-outline"></i>
                                    <span>Persetujuan</span>
                                </div>

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

                                <div class="mt-4">
                                    <button type="submit" class="serah-btn serah-btn-success">
                                        <i class="mdi mdi-check-decagram"></i>
                                        Proses Serah Terima
                                    </button>
                                </div>

                                <div class="text-center mt-3">
                                    <small class="kpr-muted">
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
        });
    </script>
@endpush
