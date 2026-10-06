@extends('layouts.partial.app')

@section('title', 'Konfirmasi Persetujuan KPR - Properti Management')

@section('content')
    <style>
        /* ============================================
           CSS LOKAL (Spesifik Halaman KPR)
           ============================================ */

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

        /* Progress Bar Khusus Halaman Akad */
        .akad-progress {
            height: 10px;
            background: #eef1f6;
            border-radius: 20px;
            overflow: hidden;
            margin-bottom: 2rem;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.06);
        }

        .akad-progress-bar {
            height: 100%;
            border-radius: 20px;
            background: linear-gradient(135deg, #da8cff, #9a55ff);
            transition: width 0.4s ease;
        }

        .transaksi-steps {
            display: grid;
            position: relative;
        }

        .transaksi-steps::before {
            content: '';
            position: absolute;
            top: 26px;
            left: 5%;
            right: 5%;
            height: 2.5px;
            background: #e2e8f0;
            z-index: 1;
        }

        /* 6 kolom untuk flow tahapan KPR */
        .transaksi-steps.steps-6 {
            grid-template-columns: repeat(6, 1fr);
        }
        .transaksi-steps.steps-5 {
            grid-template-columns: repeat(5, 1fr);
        }

        @media (max-width: 991.98px) {
            .transaksi-steps.steps-5,
            .transaksi-steps.steps-6 {
                grid-template-columns: repeat(3, 1fr);
                gap: 1.25rem 0.75rem;
            }
            .transaksi-steps::before {
                display: none !important;
            }
        }
        @media (max-width: 575.98px) {
            .transaksi-steps.steps-5,
            .transaksi-steps.steps-6 {
                grid-template-columns: repeat(2, 1fr);
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

        /* DETAIL KPR LIST */
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

        /* FORM CONTROLS */
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

        /* Custom Input Group (untuk Prefix Rp & Suffix %) */
        .transaksi-input-group {
            display: flex;
            align-items: stretch;
            width: 100%;
            position: relative;
        }

        .transaksi-input-group-prepend,
        .transaksi-input-group-append {
            display: flex;
            align-items: stretch;
        }

        .transaksi-input-group-text {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.65rem 0.95rem;
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            color: #64748b;
            font-weight: 700;
            font-size: 0.88rem;
            user-select: none;
        }

        /* Prepend (Rp) */
        .transaksi-input-group-prepend .transaksi-input-group-text {
            border-radius: 8px 0 0 8px;
            border-right: none;
        }
        .transaksi-input-group:not(.append) .transaksi-form-control {
            border-radius: 0 8px 8px 0;
            border-left: 1.5px solid #e2e8f0;
            flex: 1;
            min-width: 0;
        }

        /* Append (%) */
        .transaksi-input-group.append .transaksi-form-control {
            border-radius: 8px 0 0 8px;
            border-right: none;
            flex: 1;
            min-width: 0;
        }
        .transaksi-input-group.append .transaksi-input-group-text {
            border-radius: 0 8px 8px 0;
            border-left: 1.5px solid #e2e8f0;
        }

        /* Custom Icon Arrow pada Select */
        select.transaksi-form-control {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%236c7383' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1em;
        }

        /* DECISION RADIO CARDS */
        .transaksi-decision-card {
            position: relative;
            height: 100%;
            cursor: pointer;
        }

        .transaksi-decision-card input[type="radio"] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
            pointer-events: none;
        }

        .transaksi-decision-label {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1.15rem 1.25rem;
            background: #ffffff;
            border: 2px solid #e2e8f0;
            border-radius: 14px;
            cursor: pointer;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
            margin-bottom: 0;
            user-select: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
        }

        .transaksi-decision-label:hover {
            border-color: #9a55ff;
            background: #faf8ff;
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(154, 85, 255, 0.12);
        }

        .transaksi-decision-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.45rem;
            flex-shrink: 0;
            transition: all 0.25s ease;
        }

        .transaksi-decision-card.approve .transaksi-decision-icon {
            background: #ecfdf5;
            color: #10b981;
        }

        .transaksi-decision-card.reject .transaksi-decision-icon {
            background: #fee2e2;
            color: #ef4444;
        }

        .transaksi-decision-content {
            flex: 1;
            min-width: 0;
        }

        .transaksi-decision-title {
            font-size: 1rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 2px;
        }

        .transaksi-decision-desc {
            font-size: 0.82rem;
            color: #64748b;
            margin-bottom: 0;
            line-height: 1.35;
        }

        .transaksi-decision-check {
            font-size: 1.4rem;
            color: #cbd5e1;
            transition: all 0.25s ease;
            flex-shrink: 0;
        }

        /* State: Approved Checked */
        .transaksi-decision-card.approve input[type="radio"]:checked + .transaksi-decision-label,
        .transaksi-decision-card.approve.is-selected .transaksi-decision-label {
            border-color: #10b981;
            background: #f0fdf4;
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.15);
            transform: translateY(-2px);
        }

        .transaksi-decision-card.approve input[type="radio"]:checked + .transaksi-decision-label .transaksi-decision-check,
        .transaksi-decision-card.approve.is-selected .transaksi-decision-check {
            color: #10b981;
        }

        .transaksi-decision-card.approve input[type="radio"]:checked + .transaksi-decision-label .transaksi-decision-icon,
        .transaksi-decision-card.approve.is-selected .transaksi-decision-icon {
            background: #10b981;
            color: #ffffff;
        }

        /* State: Reject Checked */
        .transaksi-decision-card.reject input[type="radio"]:checked + .transaksi-decision-label,
        .transaksi-decision-card.reject.is-selected .transaksi-decision-label {
            border-color: #ef4444;
            background: #fef2f2;
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.15);
            transform: translateY(-2px);
        }

        .transaksi-decision-card.reject input[type="radio"]:checked + .transaksi-decision-label .transaksi-decision-check,
        .transaksi-decision-card.reject.is-selected .transaksi-decision-check {
            color: #ef4444;
        }

        .transaksi-decision-card.reject input[type="radio"]:checked + .transaksi-decision-label .transaksi-decision-icon,
        .transaksi-decision-card.reject.is-selected .transaksi-decision-icon {
            background: #ef4444;
            color: #ffffff;
        }

        /* ERROR BOX */
        .transaksi-error-box {
            display: none;
        }

        /* FORM SHELL */
        .transaksi-form-shell {
            display: none;
            padding: 1.5rem;
            border-radius: 14px;
            background: #ffffff;
            border: 1.5px solid #e2e8f0;
            margin-top: 1.25rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.02);
            transition: all 0.3s ease;
        }

        .transaksi-form-shell.approve {
            border-color: #a7f3d0;
            background: #fafdfb;
        }

        .transaksi-form-shell.reject {
            border-color: #fecaca;
            background: #fffcfc;
        }

        .transaksi-form-title {
            font-size: 1.05rem;
            font-weight: 700;
            margin-bottom: 1.25rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .transaksi-form-title.approve {
            color: #047857;
        }

        .transaksi-form-title.reject {
            color: #b91c1c;
        }

        /* FILE UPLOAD */
        .transaksi-file-upload {
            position: relative;
            width: 100%;
        }

        .transaksi-file-upload input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
            z-index: 2;
        }

        .transaksi-file-label {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 1.25rem;
            background: #ffffff;
            border: 2px dashed #cbd5e1;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.25s ease;
        }

        .transaksi-file-upload:hover .transaksi-file-label {
            border-color: #9a55ff;
            background: #faf8ff;
            box-shadow: 0 4px 14px rgba(154, 85, 255, 0.08);
        }

        .transaksi-file-label i {
            font-size: 1.8rem;
            color: #9a55ff;
            background: #f3e8ff;
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: all 0.25s ease;
        }

        .transaksi-file-upload:hover .transaksi-file-label i {
            transform: scale(1.05);
        }

        .transaksi-file-info {
            flex: 1;
            min-width: 0;
        }

        .transaksi-file-info span {
            display: block;
            font-weight: 700;
            color: #1e293b;
            font-size: 0.9rem;
            margin-bottom: 2px;
            word-break: break-all;
        }

        .transaksi-file-info small {
            display: block;
            color: #8b8fa3;
            font-size: 0.78rem;
        }

        /* ACTION BAR */
        .transaksi-action-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            margin-top: 1.5rem;
            padding-top: 1.25rem;
            border-top: 1px solid #f1f5f9;
        }

        /* BUTTONS */
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

        /* SIDEBAR & SUMMARY */
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

        .transaksi-summary-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.75rem;
            margin-bottom: 1.25rem;
        }

        .transaksi-summary-box {
            padding: 0.85rem;
            border-radius: 10px;
            text-align: center;
        }

        .transaksi-summary-box.success {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
        }

        .transaksi-summary-box.success .label {
            font-size: 0.75rem;
            color: #16a34a;
            font-weight: 600;
        }

        .transaksi-summary-box.success .value {
            font-size: 1.1rem;
            color: #15803d;
            font-weight: 800;
        }

        .transaksi-summary-box.danger {
            background: #fef2f2;
            border: 1px solid #fecaca;
        }

        .transaksi-summary-box.danger .label {
            font-size: 0.75rem;
            color: #dc2626;
            font-weight: 600;
        }

        .transaksi-summary-box.danger .value {
            font-size: 1.1rem;
            color: #b91c1c;
            font-weight: 800;
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
                                        {{ $application->customer->full_name ?? '-' }}
                                        @php
                                            $jenis = strtolower($application->unit->jenis ?? '');
                                            $badgeClass = $jenis == 'subsidi' ? 'badge-gradient-success' : ($jenis == 'komersil' ? 'badge-gradient-primary' : 'badge-gradient-secondary');
                                            $icon = $jenis == 'subsidi' ? 'mdi-home-assistant' : ($jenis == 'komersil' ? 'mdi-office-building' : 'mdi-help-circle-outline');
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">
                                            <i class="mdi {{ $icon }} me-1"></i>
                                            {{ strtoupper($application->unit->jenis ?? 'Komersil') }}
                                        </span>
                                    </h4>
                                    <p class="customer-booking mb-0">Booking ID: {{ $application->booking->booking_code ?? optional(optional($application->unit)->activeBooking)->booking_code ?? '-' }}</p>
                                </div>
                            </div>

                            <div class="customer-unit-info">
                                @if(optional(optional($application->unit)->landBank)->nama_landbank)
                                    <div class="info-item">
                                        <small>Perumahan</small>
                                        <span class="text-truncate" style="max-width: 180px;">{{ optional($application->unit->landBank)->nama_landbank }}</span>
                                    </div>
                                @endif
                                <div class="info-item">
                                    <small>Unit - Type</small>
                                    <span>{{ $application->unit->unit_name ?? '-' }} - {{ $application->unit->type ?? '-' }}</span>
                                </div>
                                <div class="info-item">
                                    <small>Blok/No</small>
                                    <span>{{ $application->unit->unit_code ?? '-' }}</span>
                                </div>
                                <div class="info-item">
                                    <small>Harga Unit</small>
                                    <span class="text-primary fw-bold">Rp {{ number_format($application->unit->price ?? 0, 0, ',', '.') }}</span>
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
                        <div class="transaksi-section-title">
                            <i class="mdi mdi-timeline-text"></i>
                            <span>Tahapan Verifikasi KPR {{ $jenis == 'komersil' ? 'Komersil' : '' }}</span>
                        </div>

                        @php
                            $surveyDone = !empty($application->rekomendasi) ||
                                       strtolower($application->status_survey ?? '') == 'done' ||
                                       ($application->booking->status_survey ?? 0) == 1;
                        @endphp

                        <div class="transaksi-progress-top">
                            <span class="transaksi-muted">Progress Proses</span>
                            <span class="fw-bold" style="color: #9a55ff;">Tahap 5 dari 6 (Proses Akad)</span>
                        </div>

                        <div class="akad-progress">
                            <div class="akad-progress-bar" style="width: 83.3%;"></div>
                        </div>

                        <div class="transaksi-steps steps-6">
                            <div class="transaksi-step completed">
                                <div class="transaksi-step-icon">
                                    <i class="mdi mdi-check"></i>
                                </div>
                                <span class="transaksi-step-title">Pengajuan</span>
                                <small>{{ \Carbon\Carbon::parse($application->submitted_at ?? $application->created_at ?? now())->translatedFormat('j F Y') }}</small>
                            </div>

                            <div class="transaksi-step completed">
                                <div class="transaksi-step-icon">
                                    <i class="mdi mdi-check"></i>
                                </div>
                                <span class="transaksi-step-title">Verifikasi</span>
                                <small>{{ \Carbon\Carbon::parse($application->created_at ?? now())->translatedFormat('j F Y') }}</small>
                            </div>

                            @php
                                $status = strtolower($application->unit->construction_progress ?? '');
                                $statusText = [
                                    'belum_mulai' => 'Belum mulai pembangunan',
                                    'pondasi' => 'Tahap pondasi',
                                    'dinding' => 'Tahap dinding',
                                    'atap' => 'Tahap atap',
                                    'finishing' => 'Tahap finishing',
                                    'selesai' => 'Pembangunan selesai',
                                ];
                                $config = [
                                    'belum_mulai' => ['icon' => 'mdi-home-city', 'color' => 'secondary'],
                                    'pondasi' => ['icon' => 'mdi-hammer', 'color' => 'warning'],
                                    'dinding' => ['icon' => 'mdi-wall', 'color' => 'warning'],
                                    'atap' => ['icon' => 'mdi-home-roof', 'color' => 'info'],
                                    'finishing' => ['icon' => 'mdi-brush', 'color' => 'primary'],
                                    'selesai' => ['icon' => 'mdi-check-circle', 'color' => 'success'],
                                ];
                                $statusConfig = $config[$status] ?? ['icon' => 'mdi-home-city', 'color' => 'secondary'];
                            @endphp

                            <div class="transaksi-step {{ $status == 'selesai' ? 'completed' : '' }}">
                                @if ($status == 'selesai')
                                    <div class="transaksi-step-icon">
                                        <i class="mdi mdi-check"></i>
                                    </div>
                                @else
                                    <div class="transaksi-step-icon border border-{{ $statusConfig['color'] }} text-{{ $statusConfig['color'] }}">
                                        <i class="mdi {{ $statusConfig['icon'] }}"></i>
                                    </div>
                                @endif
                                <span class="transaksi-step-title">Pembangunan</span>
                                <small>{{ $statusText[$status] ?? 'Pembangunan selesai' }}</small>
                            </div>

                            <div class="transaksi-step {{ $surveyDone ? 'completed' : '' }}">
                                @if($surveyDone)
                                    <div class="transaksi-step-icon">
                                        <i class="mdi mdi-check"></i>
                                    </div>
                                    <span class="transaksi-step-title">Survey</span>
                                    <small>{{ $application->survey_date ? \Carbon\Carbon::parse($application->survey_date)->translatedFormat('j F Y') : 'Selesai' }}</small>
                                @else
                                    <div class="transaksi-step-icon">
                                        <i class="mdi mdi-home-search-outline"></i>
                                    </div>
                                    <span class="transaksi-step-title">Survey</span>
                                    <small>Menunggu</small>
                                @endif
                            </div>

                            <div class="transaksi-step active">
                                <div class="transaksi-step-icon">
                                    <i class="mdi mdi-handshake-outline"></i>
                                </div>
                                <span class="transaksi-step-title">Akad</span>
                                <small>Dalam Proses</small>
                            </div>

                            <div class="transaksi-step">
                                <div class="transaksi-step-icon">
                                    <i class="mdi mdi-key-variant"></i>
                                </div>
                                <span class="transaksi-step-title">Serah Terima</span>
                                <small>Menunggu</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="transaksi-section-title">
                            <i class="mdi mdi-bank-outline"></i>
                            <span>Detail Pengajuan KPR</span>
                        </div>

                        <div class="transaksi-detail-list">
                            <div class="transaksi-detail-item">
                                <span>Bank Tujuan</span>
                                <span>{{ $application->bank->bank_name ?? '-' }}</span>
                            </div>
                            <div class="transaksi-detail-item">
                                <span>Jumlah Pinjaman</span>
                                <span>Rp {{ number_format($application->jumlah_pinjaman ?? 0, 0, ',', '.') }}</span>
                            </div>
                            <div class="transaksi-detail-item">
                                <span>Tenor</span>
                                <span>{{ $application->tenor ?? '-' }} Tahun</span>
                            </div>
                            <div class="transaksi-detail-item">
                                <span>Angsuran / bln</span>
                                <span class="highlight">Rp {{ number_format($application->estimasi_angsuran ?? 0, 0, ',', '.') }}</span>
                            </div>
                            <div class="transaksi-detail-item">
                                <span>Promo</span>
                                <span>{{ $application->promo_name ?? '-' }}</span>
                            </div>
                            <div class="transaksi-detail-item">
                                <span>Nilai Promo</span>
                                <span>Rp {{ number_format($application->promo_value ?? 0, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <hr class="my-4">

                        <small class="transaksi-muted d-block mb-2">Ditangani oleh</small>
                        <div class="transaksi-handler">
                            <div class="transaksi-handler-icon">
                                <i class="mdi mdi-account-tie"></i>
                            </div>
                            <div>
                                <div class="fw-bold">{{ $application->booking->sales->name ?? (optional(optional($application->unit)->activeBooking)->sales->name ?? 'Staff Marketing') }}</div>
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
                        <div class="transaksi-section-title">
                            <i class="mdi mdi-shield-check-outline"></i>
                            <span>Konfirmasi Persetujuan KPR</span>
                        </div>

                        @if (session('success'))
                            <div class="transaksi-inline-alert success">
                                <i class="mdi mdi-check-circle-outline"></i>
                                <div>{{ session('success') }}</div>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="transaksi-inline-alert danger">
                                <i class="mdi mdi-alert-circle-outline"></i>
                                <div>{{ session('error') }}</div>
                            </div>
                        @endif

                        <div class="transaksi-inline-alert info mb-4">
                            <i class="mdi mdi-information-outline"></i>
                            <div>Pilih status persetujuan dari bank. Keputusan ini akan menentukan langkah selanjutnya.</div>
                        </div>

                        <div class="transaksi-inline-alert danger transaksi-error-box" id="decisionErrorBox" style="display: none;">
                            <i class="mdi mdi-alert-circle-outline"></i>
                            <div>Silakan pilih keputusan persetujuan terlebih dahulu sebelum submit.</div>
                        </div>

                        <form action="{{ route('kpr.verifikasi.store', $application->booking_id ?? $application->id) }}" method="POST" enctype="multipart/form-data" id="formKonfirmasiKpr">
                            @csrf
                            <input type="hidden" name="status" id="inputStatus" value="">

                            <div class="row g-3 mb-3">
                                <div class="col-12 col-md-6">
                                    <div class="transaksi-decision-card approve" id="cardSetuju">
                                        <input type="radio" name="decision_choice" id="decisionApprove" value="survey">
                                        <label for="decisionApprove" class="transaksi-decision-label">
                                            <div class="transaksi-decision-icon">
                                                <i class="mdi mdi-check-bold"></i>
                                            </div>
                                            <div class="transaksi-decision-content">
                                                <div class="transaksi-decision-title">KPR DISETUJUI</div>
                                                <p class="transaksi-decision-desc mb-0">Lanjut ke proses Survey / Akad</p>
                                            </div>
                                            <div class="transaksi-decision-check">
                                                <i class="mdi mdi-check-circle"></i>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="transaksi-decision-card reject" id="cardTolak">
                                        <input type="radio" name="decision_choice" id="decisionReject" value="rejected">
                                        <label for="decisionReject" class="transaksi-decision-label">
                                            <div class="transaksi-decision-icon">
                                                <i class="mdi mdi-close-thick"></i>
                                            </div>
                                            <div class="transaksi-decision-content">
                                                <div class="transaksi-decision-title">KPR DITOLAK</div>
                                                <p class="transaksi-decision-desc mb-0">Pindah ke Cash / Pengajuan Ulang</p>
                                            </div>
                                            <div class="transaksi-decision-check">
                                                <i class="mdi mdi-check-circle"></i>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div id="formSetuju" class="transaksi-form-shell approve">
                                <div class="transaksi-form-title approve">
                                    <i class="mdi mdi-check-decagram-outline"></i> Form Persetujuan KPR
                                </div>

                                <div class="transaksi-inline-alert success">
                                    <i class="mdi mdi-check-circle-outline"></i>
                                    <div><strong>KPR disetujui.</strong> Silakan isi detail persetujuan dari bank.</div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-12 col-md-6 col-lg-3">
                                        <div class="transaksi-form-group">
                                            <label class="transaksi-form-label">Nilai Disetujui</label>
                                            <div class="transaksi-input-group">
                                                <div class="transaksi-input-group-prepend">
                                                    <span class="transaksi-input-group-text">Rp</span>
                                                </div>
                                                <input type="text" class="transaksi-form-control" name="jumlah_pinjaman" value="{{ $application->jumlah_pinjaman ?? '' }}" placeholder="0">
                                            </div>
                                            <small class="transaksi-muted">Bisa berbeda dari pengajuan</small>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3">
                                        <div class="transaksi-form-group">
                                            <label class="transaksi-form-label">Angsuran Disetujui</label>
                                            <div class="transaksi-input-group">
                                                <div class="transaksi-input-group-prepend">
                                                    <span class="transaksi-input-group-text">Rp</span>
                                                </div>
                                                <input type="text" class="transaksi-form-control" name="estimasi_angsuran" value="{{ $application->estimasi_angsuran ?? '' }}" placeholder="0">
                                            </div>
                                            <small class="transaksi-muted">Bisa berbeda dari pengajuan</small>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3">
                                        <div class="transaksi-form-group">
                                            <label class="transaksi-form-label">Tenor Disetujui</label>
                                            <select class="transaksi-form-control" name="tenor">
                                                @foreach([1, 2, 3, 5, 10, 15, 20, 25, 30] as $tenorOption)
                                                    <option value="{{ $tenorOption }}" {{ ($application->tenor ?? '') == $tenorOption ? 'selected' : '' }}>
                                                        {{ $tenorOption }} Tahun
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-3">
                                        <div class="transaksi-form-group">
                                            <label class="transaksi-form-label">Bunga Final</label>
                                            <div class="transaksi-input-group append">
                                                <input type="text" class="transaksi-form-control" name="bunga" value="{{ $application->bunga ?? '' }}" placeholder="0.00">
                                                <div class="transaksi-input-group-append">
                                                    <span class="transaksi-input-group-text">%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-12 col-md-6">
                                        <div class="transaksi-form-group">
                                            <label class="transaksi-form-label">No. Surat Persetujuan (SP3K)</label>
                                            <input type="text" class="transaksi-form-control" name="no_sp3k" value="{{ $application->no_sp3k ?? ('SP3K/' . date('Y') . '/' . str_pad($application->id, 3, '0', STR_PAD_LEFT) . '/ABC') }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="transaksi-form-group">
                                            <label class="transaksi-form-label">Tanggal Persetujuan</label>
                                            <input type="date" class="transaksi-form-control" name="approved_at" value="{{ $application->approved_at ? \Carbon\Carbon::parse($application->approved_at)->format('Y-m-d') : date('Y-m-d') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="transaksi-form-group">
                                    <label class="transaksi-form-label">Upload Surat Persetujuan Prinsip (SP3K)</label>
                                    <div class="transaksi-file-upload">
                                        <input type="file" name="berita_acara" accept=".jpg,.jpeg,.png,.pdf">
                                        <div class="transaksi-file-label">
                                            <i class="mdi mdi-cloud-upload-outline"></i>
                                            <div class="transaksi-file-info">
                                                <span>{{ $application->berita_acara ? basename($application->berita_acara) : 'Upload Surat Persetujuan' }}</span>
                                                <small>{{ $application->berita_acara ? 'Klik untuk mengganti berkas yang sudah ada' : 'Format: JPG, PNG, PDF (Maks. 5MB)' }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="transaksi-form-group mb-0">
                                    <label class="transaksi-form-label">Catatan Persetujuan</label>
                                    <textarea class="transaksi-form-control" name="catatan" rows="2" placeholder="Catatan persetujuan dari bank...">{{ $application->catatan ?? ('Disetujui dengan nilai Rp ' . number_format($application->jumlah_pinjaman ?? 0, 0, ',', '.') . ', bunga ' . ($application->bunga ?? '') . '%') }}</textarea>
                                </div>
                            </div>

                            <div id="formTolak" class="transaksi-form-shell reject">
                                <div class="transaksi-form-title reject">
                                    <i class="mdi mdi-close-circle-outline"></i> Form Penolakan KPR
                                </div>

                                <div class="transaksi-inline-alert danger">
                                    <i class="mdi mdi-close-circle-outline"></i>
                                    <div><strong>KPR Ditolak.</strong> Silakan pilih alasan penolakan dari bank.</div>
                                </div>

                                <div class="transaksi-form-group">
                                    <label class="transaksi-form-label">Alasan Penolakan dari Bank</label>
                                    <select class="transaksi-form-control" name="alasan_tolak" id="alasanTolak">
                                        <option value="">-- Pilih Alasan --</option>
                                        <option value="BI Checking">BI Checking / SLIK Bermasalah</option>
                                        <option value="Kemampuan Bayar">Kemampuan Bayar Kurang</option>
                                        <option value="Dokumen Tidak Lengkap">Dokumen Tidak Lengkap</option>
                                        <option value="Appraisal">Nilai Appraisal Rendah</option>
                                        <option value="Usia">Usia Tidak Memenuhi</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>

                                <div class="transaksi-form-group" id="alasanLainnya" style="display: none;">
                                    <label class="transaksi-form-label">Tulis Alasan Lainnya</label>
                                    <input type="text" class="transaksi-form-control" name="alasan_lainnya" placeholder="Contoh: Kebijakan bank baru">
                                </div>

                                <div class="transaksi-form-group mb-0">
                                    <label class="transaksi-form-label">Catatan Penolakan</label>
                                    <textarea class="transaksi-form-control" name="catatan_tolak" rows="2" placeholder="Detail penolakan dari bank..."></textarea>
                                </div>
                            </div>

                            <div class="transaksi-action-bar">
                                <a href="{{ url('/marketing/kpr') }}" class="transaksi-btn transaksi-btn-secondary">
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

            <div class="col-12 col-lg-4">
                <div class="transaksi-sticky">
                    <div class="card">
                        <div class="card-body">
                            <div class="transaksi-section-title">
                                <i class="mdi mdi-home-key"></i>
                                <span>Serah Terima Unit</span>
                            </div>

                            @if (($application->status ?? '') === 'approved' || ($application->status ?? '') === 'akad' || ($application->status ?? '') === 'selesai')
                                <div class="text-center py-3">
                                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 58px; height: 58px; background: #ecfdf5;">
                                        <i class="mdi mdi-check-circle text-success" style="font-size: 32px;"></i>
                                    </div>
                                    <h6 class="mb-1 fw-bold text-dark">Akad Telah Disetujui</h6>
                                    <p class="text-muted small mb-3">Unit siap untuk proses serah terima</p>
                                    <a href="{{ route('booking.serah-terima', $application->booking->id ?? $application->booking_id ?? 0) }}" class="transaksi-btn transaksi-btn-primary w-100 justify-content-center">
                                        <i class="mdi mdi-key me-1"></i> Proses Serah Terima
                                    </a>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 58px; height: 58px; background: #fffbeb;">
                                        <i class="mdi mdi-clock-outline text-warning" style="font-size: 32px;"></i>
                                    </div>
                                    <h6 class="mb-1 fw-bold text-dark">Menunggu Persetujuan Akad</h6>
                                    <p class="text-muted small mb-0">Tahap serah terima dapat diproses setelah persetujuan akad selesai.</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="card mt-4">
                        <div class="card-body">
                            <div class="transaksi-section-title">
                                <i class="mdi mdi-lightbulb-on-outline"></i>
                                <span>Panduan Konfirmasi</span>
                            </div>

                            <div class="transaksi-sidebar-section">
                                <div class="transaksi-sidebar-title">Saat Disetujui</div>
                                <ul class="transaksi-mini-list mb-0">
                                    <li>
                                        <i class="mdi mdi-arrow-right-circle-outline"></i>
                                        <span>Isi nilai pinjaman dan angsuran yang disetujui bank.</span>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-right-circle-outline"></i>
                                        <span>Upload surat persetujuan prinsip (SP3K) sebagai bukti.</span>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-right-circle-outline"></i>
                                        <span>Setelah disimpan, proses akan lanjut ke tahap Survey / Akad Closing.</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="transaksi-sidebar-section">
                                <div class="transaksi-sidebar-title">Saat Ditolak</div>
                                <ul class="transaksi-mini-list mb-0">
                                    <li>
                                        <i class="mdi mdi-arrow-right-circle-outline"></i>
                                        <span>Pilih alasan penolakan yang sesuai dari bank.</span>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-right-circle-outline"></i>
                                        <span>Isi catatan detail agar tim sales dapat menindaklanjuti.</span>
                                    </li>
                                    <li>
                                        <i class="mdi mdi-arrow-right-circle-outline"></i>
                                        <span>Customer akan diarahkan ke opsi alternatif (cash/pengajuan ulang).</span>
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
            const $decisionApprove = $('#decisionApprove');
            const $decisionReject = $('#decisionReject');
            const $statusInput = $('#inputStatus');
            const $formSetuju = $('#formSetuju');
            const $formTolak = $('#formTolak');
            const $decisionErrorBox = $('#decisionErrorBox');

            function switchDecision(type) {
                $decisionErrorBox.stop(true, true).slideUp(150);

                if (type === 'survey') {
                    $statusInput.val('survey');
                    $decisionApprove.prop('checked', true);
                    $('#cardSetuju').addClass('is-selected');
                    $('#cardTolak').removeClass('is-selected');
                    $formSetuju.stop(true, true).slideDown(220);
                    $formTolak.stop(true, true).slideUp(220);
                } else if (type === 'rejected') {
                    $statusInput.val('rejected');
                    $decisionReject.prop('checked', true);
                    $('#cardTolak').addClass('is-selected');
                    $('#cardSetuju').removeClass('is-selected');
                    $formTolak.stop(true, true).slideDown(220);
                    $formSetuju.stop(true, true).slideUp(220);
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

            $('#cardSetuju').on('click', function(e) {
                if (!$(e.target).is('input[type="radio"]')) {
                    switchDecision('survey');
                }
            });

            $('#cardTolak').on('click', function(e) {
                if (!$(e.target).is('input[type="radio"]')) {
                    switchDecision('rejected');
                }
            });

            // Tampilkan input alasan lainnya
            $('#alasanTolak').on('change', function() {
                if ($(this).val() === 'Lainnya') {
                    $('#alasanLainnya').stop(true, true).slideDown(180);
                } else {
                    $('#alasanLainnya').stop(true, true).slideUp(180);
                }
            });

            // File upload preview
            $(document).on('change', 'input[type="file"]', function(e) {
                const file = e.target.files[0];
                const $container = $(this).closest('.transaksi-file-upload');

                if (file) {
                    const sizeInMB = (file.size / (1024 * 1024)).toFixed(2);
                    $container.find('.transaksi-file-info span').text(file.name);
                    $container.find('.transaksi-file-info small').text(sizeInMB + ' MB • Berkas siap diupload');
                }
            });

            // Inisialisasi jika ada nilai tersimpan
            if ($decisionApprove.is(':checked')) {
                switchDecision('survey');
            } else if ($decisionReject.is(':checked')) {
                switchDecision('rejected');
            }

            // Form validation
            $('#formKonfirmasiKpr').on('submit', function(e) {
                if (!$statusInput.val()) {
                    e.preventDefault();
                    $decisionErrorBox.stop(true, true).slideDown(180);

                    $('html, body').animate({
                        scrollTop: $decisionErrorBox.offset().top - 120
                    }, 300);
                }
            });
        });
    </script>
@endpush
