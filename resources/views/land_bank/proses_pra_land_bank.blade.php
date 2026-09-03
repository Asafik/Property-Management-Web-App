@extends('layouts.partial.app')

@section('title', 'Proses Pra Tanah - Property Management App')

@section('content')

    <style>
        /* ===== STEP WIZARD STYLING ===== */
        .step-wizard {
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            margin-bottom: 2.5rem;
            padding: 0 1rem;
        }

        .step-wizard::before {
            content: '';
            position: absolute;
            top: 25px;
            left: 0;
            width: 100%;
            height: 4px;
            background: #e9ecef;
            z-index: 1;
        }

        .step-progress-bar {
            position: absolute;
            top: 25px;
            left: 0;
            width: 0%;
            height: 4px;
            background: linear-gradient(to right, #da8cff, #9a55ff);
            z-index: 2;
            transition: width 0.4s ease;
        }

        .step-item {
            position: relative;
            z-index: 3;
            display: flex;
            flex-direction: column;
            align-items: center;
            cursor: default;
            width: 120px;
        }

        .step-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #ffffff;
            border: 3px solid #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.2rem;
            color: #6c7383;
            transition: all 0.4s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .step-item.active .step-circle {
            border-color: #9a55ff;
            color: #9a55ff;
            background: #f1f0ff;
            box-shadow: 0 0 15px rgba(154, 85, 255, 0.2);
        }

        .step-item.completed .step-circle {
            border-color: #28a745;
            background: #28a745;
            color: #ffffff;
            box-shadow: 0 4px 10px rgba(40, 167, 69, 0.2);
        }

        .step-title {
            margin-top: 0.5rem;
            font-size: 0.8rem;
            font-weight: 600;
            color: #6c7383;
            transition: color 0.4s ease;
            text-align: center;
        }

        .step-item.active .step-title {
            color: #9a55ff;
            font-weight: 700;
        }

        .step-item.completed .step-title {
            color: #28a745;
        }

        .step-item.disabled {
            cursor: not-allowed;
            opacity: 0.6;
        }

        /* ===== GENERAL CARD & FORM STYLING ===== */
        .card {
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
            border: none !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .card:hover {
            box-shadow: 0 8px 25px rgba(154, 85, 255, 0.1) !important;
        }

        .card-header {
            background: linear-gradient(135deg, #ffffff, #f8f9fa);
            border-bottom: 1px solid #e9ecef;
            padding: 0.85rem 1.25rem;
        }

        @media (min-width: 576px) {
            .card-header {
                padding: 1rem 1.25rem;
            }
        }

        .card-title {
            font-size: 1.05rem;
            font-weight: 700;
            color: #2c2e3f;
            margin-bottom: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #9a55ff !important;
            margin-bottom: 0.4rem;
            letter-spacing: 0.3px;
        }

        .form-control,
        .form-select {
            border: 1px solid #e9ecef;
            border-radius: 10px;
            padding: 0.65rem 1rem;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            background-color: #ffffff;
            color: #2c2e3f;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #9a55ff;
            box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.1);
            outline: none;
        }

        .form-control:disabled,
        .form-select:disabled {
            background-color: #f8f9fa;
            color: #6c757d;
            border-color: #e9ecef;
            cursor: not-allowed;
        }

        /* Section within Form Card */
        .form-section {
            margin-bottom: 2rem;
            border-bottom: 1px solid #e9ecef;
            padding-bottom: 1.5rem;
        }

        .form-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .form-section-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: #9a55ff;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-section-title i {
            background: rgba(154, 85, 255, 0.1);
            padding: 6px;
            border-radius: 8px;
            font-size: 1.1rem;
        }

        /* Buttons */
        .btn {
            font-weight: 600;
            padding: 0.7rem 1.5rem;
            border-radius: 10px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border: none;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-gradient-primary {
            background: linear-gradient(to right, #da8cff, #9a55ff) !important;
            color: #ffffff !important;
        }

        .btn-gradient-success {
            background: linear-gradient(135deg, #28a745, #5cb85c) !important;
            color: #ffffff !important;
        }

        .btn-gradient-secondary {
            background: #6c757d !important;
            color: #ffffff !important;
        }

        .btn-outline-purple {
            background: rgba(154, 85, 255, 0.03) !important;
            border: 1px solid #9a55ff !important;
            color: #9a55ff !important;
            border-radius: 10px;
            padding: 0.6rem 1.2rem;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s ease;
        }

        .btn-outline-purple:hover {
            background: #9a55ff !important;
            color: #ffffff !important;
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.2) !important;
            transform: translateY(-2px);
        }

        /* Checkboxes (Sama seperti Tambah Properti) */
        .pratanah-checkbox-group {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-top: 0.5rem;
        }

        .pratanah-checkbox-wrapper {
            position: relative;
        }

        .pratanah-checkbox-input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        .pratanah-checkbox-label {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 0.5rem 1rem;
            background: #ffffff;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            user-select: none;
            margin-bottom: 0 !important;
        }

        .pratanah-checkbox-label:hover {
            border-color: #9a55ff;
            background: rgba(154, 85, 255, 0.02);
        }

        .pratanah-checkbox-input:checked+.pratanah-checkbox-label {
            border-color: #9a55ff;
            background: rgba(154, 85, 255, 0.08);
            box-shadow: 0 2px 8px rgba(154, 85, 255, 0.15);
        }

        .pratanah-check-icon {
            color: #d0d4db;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .pratanah-checkbox-input:checked+.pratanah-checkbox-label .pratanah-check-icon {
            color: #9a55ff;
        }

        .pratanah-check-text {
            font-size: 0.85rem;
            color: #2c2e3f;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .pratanah-checkbox-input:checked+.pratanah-checkbox-label .pratanah-check-text {
            color: #9a55ff;
            font-weight: 600;
        }

        /* Same As Certificate Toggle Badge */
        .same-cert-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 5px 12px;
            border-radius: 6px;
            background: rgba(154, 85, 255, 0.08);
            border: 1.5px solid rgba(154, 85, 255, 0.3);
            cursor: pointer;
            transition: all 0.2s ease;
            user-select: none;
        }

        .same-cert-badge:hover {
            background: rgba(154, 85, 255, 0.15);
            border-color: #9a55ff;
        }

        .same-cert-badge input[type="checkbox"] {
            cursor: pointer;
            width: 17px;
            height: 17px;
            accent-color: #9a55ff;
            margin: 0;
            border-radius: 3px;
        }

        .same-cert-badge span {
            font-size: 0.82rem;
            font-weight: 700;
            color: #6b21a8;
        }

        /* Modern File Upload */
        .pratanah-file-upload-modern {
            position: relative;
            width: 100%;
        }

        .pratanah-file-upload-modern input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
            z-index: 2;
        }

        .pratanah-file-label-modern {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0.65rem 1rem;
            background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
            border: 2px dashed #d0d4db;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .pratanah-file-upload-modern:hover .pratanah-file-label-modern {
            border-color: #9a55ff;
            background: linear-gradient(135deg, #f1f0ff, #f8f9fa);
        }

        .pratanah-file-label-modern i {
            font-size: 1.3rem;
            color: #9a55ff;
            background: rgba(154, 85, 255, 0.1);
            padding: 8px;
            border-radius: 50%;
        }

        .pratanah-file-info-modern {
            flex: 1;
        }

        .pratanah-file-info-modern span {
            display: block;
            font-weight: 600;
            color: #2c2e3f;
            font-size: 0.8rem;
        }

        .pratanah-file-info-modern small {
            color: #6c7383;
            font-size: 0.65rem;
        }

        .pratanah-file-size {
            font-size: 0.7rem;
            color: #9a55ff;
            font-weight: 600;
            background: rgba(154, 85, 255, 0.1);
            padding: 2px 8px;
            border-radius: 20px;
        }

        /* Map Container */
        .pratanah-map-container {
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid #e9ecef;
            height: 350px;
            margin-top: 0.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        }

        .status-header-badge {
            font-size: 0.8rem;
            font-weight: 700;
            padding: 0.5rem 1rem;
            border-radius: 30px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .status-header-badge.fase1 {
            background: rgba(154, 85, 255, 0.1);
            color: #9a55ff;
        }

        .status-header-badge.fase2 {
            background: rgba(23, 162, 184, 0.1);
            color: #17a2b8;
        }

        .status-header-badge.fase3 {
            background: rgba(40, 167, 69, 0.1);
            color: #28a745;
        }

        .status-header-badge.approved {
            background: linear-gradient(135deg, #28a745, #5cb85c);
            color: white;
        }

        .status-header-badge.rejected {
            background: linear-gradient(135deg, #dc3545, #e4606d);
            color: white;
        }

        .status-header-badge.pending {
            background: rgba(108, 117, 125, 0.1);
            color: #6c757d;
        }

        .d-none {
            display: none !important;
        }



        /* ===== OPTIMASI LEBAR & PADDING (DESKTOP, TABLET & MOBILE) ===== */
        .content-wrapper {
            padding: 1.25rem 1rem !important;
        }

        .card-body {
            padding: 1.25rem 1.5rem;
        }

        /* Mode Tablet (iPad / 768px - 1024px) */
        @media (max-width: 1024px) {
            .content-wrapper {
                padding: 1.15rem 0.85rem !important;
            }
            .container-fluid {
                padding-left: 0.25rem !important;
                padding-right: 0.25rem !important;
            }
        }

        /* Responsive Fase 2 Styles */
        .pratanah-map-container {
            height: 320px;
            width: 100%;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #e0e4e9;
        }

        .fase2-info-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 12px;
            padding-bottom: 0.35rem;
            border-bottom: 1px solid rgba(154, 85, 255, 0.1) !important;
            font-size: 0.85rem;
        }

        .fase2-info-row:last-child {
            border-bottom: none !important;
            padding-bottom: 0;
        }

        .fase2-info-label {
            color: #6c757d;
            flex-shrink: 0;
        }

        .fase2-info-value {
            font-weight: 600;
            text-align: right;
            word-break: break-word;
            color: #2c2e3f;
        }

        /* Mode HP / Mobile */
        @media (max-width: 576px) {
            .content-wrapper {
                padding: 0.85rem 0.65rem !important;
            }
            .container-fluid {
                padding-left: 0.25rem !important;
                padding-right: 0.25rem !important;
            }
            .card-body {
                padding: 0.85rem 0.85rem !important;
            }
            .step-wizard {
                padding: 0;
            }
            .step-circle {
                width: 38px;
                height: 38px;
                font-size: 0.95rem;
            }
            .step-title {
                font-size: 0.725rem;
            }
            .pratanah-checkbox-wrapper {
                min-width: calc(50% - 0.4rem) !important;
                flex: 1 1 auto;
            }
            .pratanah-checkbox-label {
                padding: 0.45rem 0.65rem !important;
                font-size: 0.78rem !important;
            }
            .pratanah-map-container {
                height: 220px;
            }
            .fase2-info-row {
                font-size: 0.8rem;
                gap: 8px;
            }
            .fase2-info-value {
                font-size: 0.8rem;
            }
            .btn-action-mobile {
                width: 100% !important;
            }
        }

        /* ===== B. PASCA-AKUISISI & LEGALITAS PERIZINAN STYLING ===== */
        .pasca-legal-container {
            background: #ffffff;
            border-radius: 12px;
            border: 1px solid #ebedf2;
            padding: 1.25rem;
            margin-top: 1.5rem;
        }
        .pasca-progress-box {
            background: linear-gradient(135deg, #f8f6ff 0%, #f0ebff 100%);
            border: 1px solid #e0d4fc;
            border-radius: 12px;
            padding: 1.15rem 1.25rem;
            margin-bottom: 1.25rem;
        }
        .pasca-progress-bar {
            height: 12px;
            border-radius: 10px;
            background: #e2e8f0;
            overflow: hidden;
        }
        .pasca-progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #9a55ff 0%, #28c76f 100%);
            border-radius: 10px;
            transition: width 0.4s ease;
        }
        .pasca-summary-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 0.35rem 0.75rem;
            border-radius: 30px;
            font-size: 0.78rem;
            font-weight: 600;
        }
        .pasca-summary-pill.selesai {
            background: #e8fadf;
            color: #28a745;
            border: 1px solid #c3e6cb;
        }
        .pasca-summary-pill.proses {
            background: #e8f4fd;
            color: #0d6efd;
            border: 1px solid #b6d4fe;
        }
        .pasca-summary-pill.menunggu {
            background: #fff8e6;
            color: #d97706;
            border: 1px solid #ffe69c;
        }
        .legal-item-card {
            background: #ffffff;
            border: 1px solid #eef0f4;
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 0.85rem;
            transition: all 0.2s ease;
        }
        .legal-item-card:hover {
            border-color: #bfa5fa;
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.08);
        }
        /* ===== INSTALLMENT TABLE & PAYMENT INPUTS STYLING ===== */
        #installment_widget_container table th {
            color: #1e293b !important;
            font-weight: 700 !important;
            background-color: #f1f5f9 !important;
            font-size: 0.82rem !important;
            vertical-align: middle !important;
        }

        #installment_tbody tr td {
            background-color: #ffffff !important;
            vertical-align: middle !important;
            padding: 8px 10px !important;
        }

        #installment_tbody .form-control,
        #installment_tbody .form-select,
        #cash_payment_container .form-control,
        #cash_payment_container .form-select {
            color: #0f172a !important;
            background-color: #ffffff !important;
            border: 1.5px solid #cbd5e1 !important;
            font-weight: 600 !important;
            font-size: 0.85rem !important;
            padding: 6px 10px !important;
            border-radius: 6px !important;
            opacity: 1 !important;
            -webkit-text-fill-color: #0f172a !important;
        }

        #installment_tbody .form-control:focus,
        #installment_tbody .form-select:focus,
        #cash_payment_container .form-control:focus,
        #cash_payment_container .form-select:focus {
            border-color: #9a55ff !important;
            box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.15) !important;
        }

        #installment_tbody .form-control::placeholder,
        #cash_payment_container .form-control::placeholder {
            color: #64748b !important;
            font-weight: 400 !important;
            -webkit-text-fill-color: #64748b !important;
            opacity: 1 !important;
        }

        .termin-payment-type {
            font-weight: 700 !important;
            color: #0f172a !important;
            background-color: #f8fafc !important;
            border: 1.5px solid #94a3b8 !important;
        }

        .termin-bank-box input {
            border: 1.5px solid #94a3b8 !important;
            font-weight: 600 !important;
            color: #0f172a !important;
            background-color: #ffffff !important;
        }

        /* ===== SELECT2 SEARCH THEME ALIGNMENT ===== */
        .select2-container--bootstrap-5 .select2-selection {
            min-height: 42px !important;
            height: 42px !important;
            padding: 0.375rem 0.75rem !important;
            display: flex !important;
            align-items: center !important;
            border: 1.5px solid #cbd5e1 !important;
            border-radius: 6px !important;
            font-size: 0.875rem !important;
            background-color: #ffffff !important;
            transition: all 0.2s ease !important;
        }
        .select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
            line-height: 1.5 !important;
            padding-left: 0 !important;
            color: #0f172a !important;
            font-weight: 600 !important;
        }
        .select2-container--bootstrap-5.select2-container--focus .select2-selection,
        .select2-container--bootstrap-5.select2-container--open .select2-selection {
            border-color: #9a55ff !important;
            box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.15) !important;
        }
        .select2-container--bootstrap-5 .select2-dropdown {
            border: 1px solid #e2e8f0 !important;
            border-radius: 8px !important;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1) !important;
            z-index: 1060 !important;
            overflow: hidden !important;
        }
        .select2-container--bootstrap-5 .select2-search--dropdown {
            padding: 8px !important;
        }
        .select2-container--bootstrap-5 .select2-search__field {
            border: 1.5px solid #cbd5e1 !important;
            border-radius: 6px !important;
            padding: 6px 10px !important;
            font-size: 0.85rem !important;
        }
        .select2-container--bootstrap-5 .select2-search__field:focus {
            border-color: #9a55ff !important;
            outline: none !important;
        }
        .select2-container--bootstrap-5 .select2-results__option--highlighted {
            background-color: #f6f1ff !important;
            color: #792fe0 !important;
            font-weight: 600 !important;
        }
        .select2-container--bootstrap-5 .select2-results__option--selected {
            background-color: #eee4ff !important;
            color: #581c87 !important;
            font-weight: 700 !important;
        }

        /* ===== RESPONSIVE MOBILE & TABLET STYLING ===== */
        @media (max-width: 575.98px) {
            .step-wizard {
                padding: 0;
                margin-bottom: 1.25rem;
            }
            .step-item {
                width: 75px;
            }
            .step-circle {
                width: 36px;
                height: 36px;
                font-size: 0.95rem;
                border-width: 2px;
            }
            .step-wizard::before,
            .step-progress-bar {
                top: 18px;
                height: 3px;
            }
            .step-title {
                font-size: 0.72rem;
                margin-top: 0.35rem;
            }
            .card-header {
                padding: 0.75rem 1rem !important;
            }
            .card-body {
                padding: 1rem 0.85rem !important;
            }
            .form-section {
                margin-bottom: 1.25rem;
                padding-bottom: 1rem;
            }
            #mapFase2 {
                height: 260px !important;
            }
            .footer-action-row {
                flex-direction: column !important;
                align-items: stretch !important;
                gap: 0.75rem !important;
            }
            .footer-action-row .btn,
            .footer-action-row > div,
            .footer-action-row > div > .btn {
                width: 100% !important;
            }
        }

        @media (min-width: 576px) and (max-width: 991.98px) {
            .step-wizard {
                padding: 0 0.5rem;
                margin-bottom: 1.75rem;
            }
            .step-item {
                width: 95px;
            }
            .step-circle {
                width: 42px;
                height: 42px;
                font-size: 1.05rem;
            }
            .step-wizard::before,
            .step-progress-bar {
                top: 21px;
            }
            #mapFase2 {
                height: 300px !important;
            }
        }

        /* ===== RESPONSIVE INSTALLMENT TABLE ===== */
        #installment_widget_container .table-responsive {
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            overflow-x: auto !important;
            -webkit-overflow-scrolling: touch !important;
        }
        #installment_widget_container table {
            min-width: 880px !important;
            table-layout: auto !important;
        }
        .termin-status-select {
            min-width: 85px !important;
            font-size: 0.82rem !important;
            padding: 4px 6px !important;
            font-weight: 600 !important;
        }

        @media (max-width: 991.98px) {
            .calc-summary-table {
                font-size: 0.85rem !important;
            }
        }
    </style>

    <div class="container-fluid px-1 px-sm-2 px-md-3 py-2 py-md-3">

        <!-- Header Card Banner -->
        <div class="row mb-3 mb-md-4">
            <div class="col-12">
                <div class="card shadow-sm border-0 header-card">
                    <div class="card-body p-4 p-md-4 py-4 py-md-4 d-flex flex-wrap justify-content-between align-items-center gap-3" style="min-height: 105px;">
                        <div>
                            <h3 class="text-dark mb-1 fw-bold" style="font-size: 1.35rem;">
                                @if ($land)
                                    @if($land->status == 'approved' || $land->status == 'rejected')
                                        Detail Pra Tanah
                                    @else
                                        Proses Pra Tanah
                                    @endif
                                @else
                                    Tambah Pra Tanah Baru
                                @endif
                            </h3>
                            <p class="text-muted mb-0" style="font-size: 0.9rem;">
                                @if ($land)
                                    Mengelola dan mengulas alur pelepasan tanah untuk <strong>{{ $land->land_name }}</strong>
                                @else
                                    Inisialisasi data penawaran awal makelar (Fase 1)
                                @endif
                            </p>
                        </div>

                        <!-- BUTTON KEMBALI -->
                        <div class="d-flex align-items-center gap-3">
                            <a href="{{ route('pralandbank.all') }}" class="btn btn-sm btn-gradient-secondary d-inline-flex align-items-center gap-1 btn-back shadow-sm px-3 py-2">
                                <i class="mdi mdi-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- PIPELINE STEP WIZARD -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body py-4">
                        <div class="step-wizard">
                            <div class="step-progress-bar" id="wizardProgressBar"></div>

                            <!-- STEP 1 -->
                            <div class="step-item" id="step1" onclick="switchStep(1)" style="cursor: pointer;">
                                <div class="step-circle">1</div>
                                <div class="step-title">Fase 1</div>
                            </div>

                            <!-- STEP 2 -->
                            <div class="step-item {{ !$land ? 'disabled' : '' }}" id="step2" onclick="switchStep(2)" style="cursor: pointer;">
                                <div class="step-circle">2</div>
                                <div class="step-title">Fase 2</div>
                            </div>

                            <!-- STEP 3 -->
                            @php
                                $praDocs = $land ? $land->documents : collect();
                                $totalUploadedDocs = $praDocs->whereNotNull('file_path')->count();
                                $verifiedCount = $praDocs->where('status', 'verified')->count();
                                $isLegalSah = $land && ($totalUploadedDocs > 0) && ($verifiedCount === $totalUploadedDocs);
                            @endphp
                            <div class="step-item {{ !$land ? 'disabled' : '' }}" id="step3" onclick="switchStep(3)" style="cursor: pointer;" title="{{ !$isLegalSah && $land && $land->status != 'approved' ? 'Terkunci: Wajib verifikasi legalitas sah terlebih dahulu' : '' }}">
                                <div class="step-circle">3</div>
                                <div class="step-title d-flex align-items-center justify-content-center">
                                    Fase 3
                                    @if(!$isLegalSah && $land && $land->status != 'approved' && $land->status != 'rejected')
                                        <i class="mdi mdi-lock text-warning ms-1" style="font-size: 13px;" title="Terkunci: Menunggu Validasi Legalitas Sah"></i>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- WORKSPACE DYNAMIC CONTENT -->
        <div class="row">
            <div class="col-12">

                <!-- ================= FASE 1 CONTAINER ================= -->
                <div id="containerFase1" class="d-none">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white py-3">
                            <h5 class="card-title mb-0" style="font-weight: 700; color: #2c2e3f;">
                                FASE 1: Informasi Makelar & Penawaran Awal
                            </h5>
                        </div>
                        <div class="card-body">
                            <form id="formFase1">
                                @csrf
                                <input type="hidden" name="id" value="{{ $land->id ?? '' }}">
                                <input type="hidden" name="fase" value="fase1">

                                <!-- DATA MAKELAR -->
                                <div class="form-section">
                                    <div class="form-section-title">
                                        Data Kontak Makelar
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Nama Makelar *</label>
                                            <input type="text" class="form-control" name="land_owner" value="{{ $land->land_owner ?? '' }}" placeholder="Nama Lengkap Makelar" required {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Perusahaan / Instansi</label>
                                            <input type="text" class="form-control" name="land_source" value="{{ $land->land_source ?? '' }}" placeholder="Perusahaan Makelar" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">No. WhatsApp / HP</label>
                                            <input type="text" class="form-control" name="owner_contact" value="{{ $land->owner_contact ?? '' }}" placeholder="Contoh: 08123456789" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Tanggal Penawaran</label>
                                            <input type="date" class="form-control" name="survey_date" value="{{ $land && $land->survey_date ? \Carbon\Carbon::parse($land->survey_date)->format('Y-m-d') : '' }}" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                    </div>
                                </div>

                                <!-- DATA TANAH -->
                                <div class="form-section">
                                    <div class="form-section-title">
                                        Data Tanah
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Nama Prospek Tanah *</label>
                                            <input type="text" class="form-control" name="land_name" value="{{ $land->land_name ?? '' }}" placeholder="Contoh: Tanah Jember Regency" required {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Status Tanah / Kepemilikan *</label>
                                            <select class="form-select select2-search" id="select_ownership_status" name="ownership_status" data-placeholder="Pilih Status Kepemilikan" style="width: 100%;" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                <option value="">-- Pilih Status Kepemilikan --</option>
                                                <option value="SHM" {{ ($land && ($land->ownership_status ?? 'SHM') == 'SHM') ? 'selected' : '' }}>SHM (Sertifikat Hak Milik)</option>
                                                <option value="HGB" {{ ($land && $land->ownership_status == 'HGB') ? 'selected' : '' }}>HGB (Hak Guna Bangunan)</option>
                                                <option value="HGU" {{ ($land && $land->ownership_status == 'HGU') ? 'selected' : '' }}>HGU (Hak Guna Usaha)</option>
                                                <option value="HP" {{ ($land && $land->ownership_status == 'HP') ? 'selected' : '' }}>HP (Hak Pakai)</option>
                                                <option value="Girik" {{ ($land && $land->ownership_status == 'Girik') ? 'selected' : '' }}>Girik / Letter C</option>
                                                <option value="Petok D" {{ ($land && $land->ownership_status == 'Petok D') ? 'selected' : '' }}>Petok D</option>
                                                <option value="AJB" {{ ($land && $land->ownership_status == 'AJB') ? 'selected' : '' }}>AJB (Akta Jual Beli)</option>
                                                <option value="Lainnya" {{ ($land && $land->ownership_status == 'Lainnya') ? 'selected' : '' }}>Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Nama di Sertifikat / Surat</label>
                                            <input type="text" class="form-control" id="certificate_owner" name="certificate_owner" value="{{ $land->certificate_owner ?? '' }}" placeholder="Nama pemilik sah di sertifikat" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <label class="form-label mb-0">Nama Pemilik Tanah</label>
                                                <label class="same-cert-badge" for="sameAsCertificate" title="Centang untuk menyamakan dengan nama di sertifikat">
                                                    <input type="checkbox" id="sameAsCertificate" {{ $land && $land->owner_name && $land->certificate_owner && $land->owner_name === $land->certificate_owner ? 'checked' : '' }} {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                    <span>Sama dengan sertifikat</span>
                                                </label>
                                            </div>
                                            <input type="text" class="form-control" id="owner_name" name="owner_name" value="{{ $land->owner_name ?? '' }}" placeholder="Nama pemilik tanah saat ini" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="form-label">Alamat Lengkap *</label>
                                            <input type="text" class="form-control" name="address" value="{{ $land->address ?? '' }}" placeholder="Alamat lengkap lokasi tanah" required {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Luas Tanah (m²)</label>
                                            <input type="number" class="form-control" name="area" value="{{ $land->area ?? '' }}" placeholder="Luas tanah" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Lebar Jalan Depan (m)</label>
                                            <input type="number" class="form-control" name="road_width" value="{{ $land->road_width ?? '' }}" placeholder="Lebar jalan" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Jenis Konstruksi Jalan</label>
                                            <select class="form-select select2-search" id="select_road_type" name="road_type" data-placeholder="Pilih Konstruksi Jalan" style="width: 100%;" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                <option value="">Pilih</option>
                                                <option value="aspal" {{ $land && $land->road_type == 'aspal' ? 'selected' : '' }}>Aspal</option>
                                                <option value="beton" {{ $land && $land->road_type == 'beton' ? 'selected' : '' }}>Beton</option>
                                                <option value="paving" {{ $land && $land->road_type == 'paving' ? 'selected' : '' }}>Paving</option>
                                                <option value="tanah" {{ $land && $land->road_type == 'tanah' ? 'selected' : '' }}>Tanah</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- NEGOSIASI HARGA -->
                                <div class="form-section">
                                    <div class="form-section-title">
                                        Negosiasi Harga Awal
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Harga Penawaran Awal (Rp)</label>
                                            <input type="text" class="form-control" id="offer_price" name="offer_price" value="{{ $land && $land->offer_price ? number_format($land->offer_price, 0, ',', '.') : '' }}" oninput="formatRupiah(this)" placeholder="Harga penawaran" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Harga Target Negosiasi (Rp)</label>
                                            <input type="text" class="form-control" id="estimated_price" name="estimated_price" value="{{ $land && $land->estimated_price ? number_format($land->estimated_price, 0, ',', '.') : '' }}" oninput="formatRupiah(this)" placeholder="Harga negosiasi" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                    </div>
                                </div>

                                <!-- ACTIONS -->
                                <div class="d-flex justify-content-end gap-3 mt-4 footer-action-row">
                                    @if (!$land || ($land && $land->status != 'approved' && $land->status != 'rejected'))
                                        <button type="button" class="btn btn-gradient-primary btn-action-mobile" onclick="saveFase1()">
                                            <i class="mdi mdi-content-save-all"></i> {{ $land ? 'Update / Simpan Fase 1' : 'Simpan Fase 1' }}
                                        </button>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- ================= FASE 2 CONTAINER ================= -->
                <div id="containerFase2" class="d-none">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white py-3">
                            <h5 class="card-title mb-0" style="font-weight: 700; color: #2c2e3f;">
                                FASE 2: Verifikasi Kelayakan, Dokumen & Spasial Map
                            </h5>
                        </div>
                        <div class="card-body">
                            <form id="formFase2" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $land->id ?? '' }}">
                                <input type="hidden" name="fase" value="fase2">

                                <!-- PROFIL PEMILIK & INFORMASI TANAH DARI FASE 1 -->
                                <div class="form-section">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="form-section-title mb-0">
                                            Profil Pemilik & Informasi Tanah (Fase 1)
                                        </div>
                                        <button type="button" class="btn btn-sm btn-outline-purple py-1 px-3" onclick="switchStep(1)" style="font-size: 0.78rem;">
                                            <i class="mdi mdi-pencil me-1"></i> Edit Data Fase 1
                                        </button>
                                    </div>

                                    <div class="row g-3">
                                        <!-- Card Profil Pemilik -->
                                        <div class="col-12 col-md-6">
                                            <div class="p-3 rounded-3 h-100" style="background: linear-gradient(135deg, #fbf9ff, #f6f0ff); border: 1px solid rgba(154, 85, 255, 0.2);">
                                                <h6 class="fw-bold text-primary mb-3" style="font-size: 0.88rem;">
                                                    Data Pemilik & Makelar
                                                </h6>
                                                <div class="d-flex flex-column gap-2">
                                                    <div class="fase2-info-row">
                                                        <span class="fase2-info-label">Nama Pemilik Tanah:</span>
                                                        <span class="fase2-info-value">{{ $land->owner_name ?? ($land->certificate_owner ?? '-') }}</span>
                                                    </div>
                                                    <div class="fase2-info-row">
                                                        <span class="fase2-info-label">Nama di Sertifikat:</span>
                                                        <span class="fase2-info-value">{{ $land->certificate_owner ?? '-' }}</span>
                                                    </div>
                                                    <div class="fase2-info-row">
                                                        <span class="fase2-info-label">Nama Makelar:</span>
                                                        <span class="fase2-info-value">{{ $land->land_owner ?? '-' }}</span>
                                                    </div>
                                                    <div class="fase2-info-row">
                                                        <span class="fase2-info-label">Instansi / Perusahaan:</span>
                                                        <span class="fase2-info-value text-muted">{{ $land->land_source ?? '-' }}</span>
                                                    </div>
                                                    <div class="fase2-info-row">
                                                        <span class="fase2-info-label">No. WhatsApp / HP:</span>
                                                        <span class="fase2-info-value text-success">
                                                            @if(!empty($land->owner_contact))
                                                                 {{ $land->owner_contact }}
                                                            @else
                                                                -
                                                            @endif
                                                        </span>
                                                    </div>
                                                    <div class="fase2-info-row">
                                                        <span class="fase2-info-label">Alamat Lokasi:</span>
                                                        <span class="fase2-info-value">{{ $land->address ?? '-' }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Card Data Tanah & Nilai -->
                                        <div class="col-12 col-md-6">
                                            <div class="p-3 rounded-3 h-100" style="background: linear-gradient(135deg, #fbf9ff, #f6f0ff); border: 1px solid rgba(154, 85, 255, 0.2);">
                                                <h6 class="fw-bold text-primary mb-3" style="font-size: 0.88rem;">
                                                    Informasi Prospek & Nilai Tanah
                                                </h6>
                                                <div class="d-flex flex-column gap-2">
                                                    <div class="fase2-info-row">
                                                        <span class="fase2-info-label">Nama Prospek:</span>
                                                        <span class="fase2-info-value">{{ $land->land_name ?? '-' }}</span>
                                                    </div>
                                                    <div class="fase2-info-row">
                                                        <span class="fase2-info-label">Status Kepemilikan:</span>
                                                        <span class="fase2-info-value">
                                                            {{ $land->ownership_status ?? 'SHM' }}
                                                        </span>
                                                    </div>
                                                    <div class="fase2-info-row">
                                                        <span class="fase2-info-label">Luas Tanah:</span>
                                                        <span class="fase2-info-value">{{ $land && $land->area ? number_format($land->area, 0, ',', '.') . ' m²' : '-' }}</span>
                                                    </div>
                                                    <div class="fase2-info-row">
                                                        <span class="fase2-info-label">Harga Penawaran:</span>
                                                        <span class="fase2-info-value text-danger">Rp {{ number_format($land->offer_price ?? 0, 0, ',', '.') }}</span>
                                                    </div>
                                                    <div class="fase2-info-row">
                                                        <span class="fase2-info-label">Target Negosiasi:</span>
                                                        <span class="fase2-info-value text-primary">Rp {{ number_format($land->estimated_price ?? 0, 0, ',', '.') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- SURVEY LAPANGAN -->
                                <div class="form-section">
                                    <div class="form-section-title">
                                        Survey Fisik Lapangan
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Tanggal Survey Fisik</label>
                                            <input type="date" class="form-control" name="tgl_survey" value="{{ $land && $land->survey_date ? \Carbon\Carbon::parse($land->survey_date)->format('Y-m-d') : '' }}" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Status Lahan</label>
                                            <select class="form-select select2-search" id="select_land_status" name="land_status_temp" data-placeholder="Pilih Status Lahan" style="width: 100%;" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                <option value="">Pilih Status Lahan</option>
                                                <option value="bekas_sawah" {{ $land && $land->land_status == 'bekas_sawah' ? 'selected' : '' }}>Lahan Bekas Sawah</option>
                                                <option value="perbukitan" {{ $land && $land->land_status == 'perbukitan' ? 'selected' : '' }}>Perbukitan</option>
                                                <option value="pekarangan" {{ $land && $land->land_status == 'pekarangan' ? 'selected' : '' }}>Pekarangan</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Kondisi Air</label>
                                            <select class="form-select select2-search" id="select_water_condition" name="water_condition_temp" data-placeholder="Pilih Kondisi Air" style="width: 100%;" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                <option value="">Pilih Kondisi Air</option>
                                                <option value="sumur_bor" {{ $land && $land->water_condition == 'sumur_bor' ? 'selected' : '' }}>Sumur Bor</option>
                                                <option value="pdam" {{ $land && $land->water_condition == 'pdam' ? 'selected' : '' }}>PDAM</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- KEJELASAN LEGALITAS -->
                                <div class="form-section">
                                    <div class="form-section-title">
                                        Aspek Kejelasan Legalitas Tanah
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Status Kejelasan Sengketa</label>
                                            <select class="form-select" id="select_status_tanah" name="status_tanah" onchange="toggleMasalahHukum()" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                <option value="clear" {{ $land && $land->legal_status == 'clear' ? 'selected' : '' }}>Clear & Clean (Bebas Sengketa)</option>
                                                <option value="checking" {{ $land && $land->legal_status == 'checking' ? 'selected' : '' }}>Dalam Pengecekan Notaris/BPN</option>
                                                <option value="problem" {{ $land && $land->legal_status == 'problem' ? 'selected' : '' }}>Bermasalah / Dalam Sengketa</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3 {{ ($land && $land->legal_status == 'problem') ? '' : 'd-none' }}" id="wrapper_keterangan_masalah">
                                            <label class="form-label text-danger">Detail Permasalahan Hukum <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control border-danger" id="input_keterangan_masalah" name="keterangan_masalah" value="{{ $land->legal_issue_note ?? '' }}" placeholder="Catatan masalah legalitas / sengketa" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                    </div>
                                </div>

                                <!-- PERIZINAN & FASILITAS SEKITAR -->
                                <div class="form-section">
                                    <div class="form-section-title">
                                        Zonasi & Fasilitas Publik Sekitar
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Rencana Tata Ruang / Zonasi</label>
                                            <input type="text" class="form-control" name="zoning" value="{{ $land->zoning ?? '' }}" placeholder="Contoh: Perumahan Kepadatan Sedang, Komersil" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Tingkat Kesulitan Pengurusan Izin</label>
                                            <select class="form-select" id="select_kesulitan_izin" name="kesulitan_izin" onchange="toggleKeteranganIzin()" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                <option value="mudah" {{ $land && $land->permit_difficulty == 'mudah' ? 'selected' : '' }}>Mudah</option>
                                                <option value="sedang" {{ $land && $land->permit_difficulty == 'sedang' ? 'selected' : '' }}>Sedang</option>
                                                <option value="sulit" {{ $land && $land->permit_difficulty == 'sulit' ? 'selected' : '' }}>Sulit</option>
                                                <option value="very_sulit" {{ $land && $land->permit_difficulty == 'very_sulit' ? 'selected' : '' }}>Sangat Sulit (Zonasi Hijau)</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12 mb-3 {{ ($land && in_array($land->permit_difficulty, ['sulit', 'very_sulit'])) ? '' : 'd-none' }}" id="wrapper_keterangan_izin">
                                            <label class="form-label text-danger fw-semibold">Detail / Keterangan Masalah Izin <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control border-danger" id="input_keterangan_izin" name="keterangan_kesulitan_izin" value="{{ $land->permit_difficulty_note ?? '' }}" placeholder="Catatan kendala pengurusan perizinan (contoh: Masuk zona hijau / kendala tata ruang / butuh rekomendasi khusus)..." {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="form-label">Fasilitas Sekitar</label>
                                            <div class="pratanah-checkbox-group">
                                                <div class="pratanah-checkbox-wrapper">
                                                    <input type="checkbox" class="pratanah-checkbox-input" name="fasilitas[]" value="sekolah" id="fase2_fac_sekolah" {{ $land && $land->facility_school ? 'checked' : '' }} {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                    <label class="pratanah-checkbox-label" for="fase2_fac_sekolah">
                                                        <i class="mdi mdi-checkbox-marked-circle pratanah-check-icon"></i>
                                                        <span class="pratanah-check-text">Dekat Sekolah</span>
                                                    </label>
                                                </div>
                                                <div class="pratanah-checkbox-wrapper">
                                                    <input type="checkbox" class="pratanah-checkbox-input" name="fasilitas[]" value="rumah_sakit" id="fase2_fac_rs" {{ $land && $land->facility_hospital ? 'checked' : '' }} {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                    <label class="pratanah-checkbox-label" for="fase2_fac_rs">
                                                        <i class="mdi mdi-checkbox-marked-circle pratanah-check-icon"></i>
                                                        <span class="pratanah-check-text">Rumah Sakit</span>
                                                    </label>
                                                </div>
                                                <div class="pratanah-checkbox-wrapper">
                                                    <input type="checkbox" class="pratanah-checkbox-input" name="fasilitas[]" value="pasar" id="fase2_fac_pasar" {{ $land && $land->facility_market ? 'checked' : '' }} {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                    <label class="pratanah-checkbox-label" for="fase2_fac_pasar">
                                                        <i class="mdi mdi-checkbox-marked-circle pratanah-check-icon"></i>
                                                        <span class="pratanah-check-text">Pasar</span>
                                                    </label>
                                                </div>
                                                <div class="pratanah-checkbox-wrapper">
                                                    <input type="checkbox" class="pratanah-checkbox-input" name="fasilitas[]" value="transportasi" id="fase2_fac_trans" {{ $land && $land->facility_transport ? 'checked' : '' }} {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                    <label class="pratanah-checkbox-label" for="fase2_fac_trans">
                                                        <i class="mdi mdi-checkbox-marked-circle pratanah-check-icon"></i>
                                                        <span class="pratanah-check-text">Transportasi Umum</span>
                                                    </label>
                                                </div>
                                                <div class="pratanah-checkbox-wrapper">
                                                    <input type="checkbox" class="pratanah-checkbox-input" name="fasilitas[]" value="mall" id="fase2_fac_mall" {{ $land && $land->facility_mall ? 'checked' : '' }} {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                    <label class="pratanah-checkbox-label" for="fase2_fac_mall">
                                                        <i class="mdi mdi-checkbox-marked-circle pratanah-check-icon"></i>
                                                        <span class="pratanah-check-text">Mall / Swalayan</span>
                                                    </label>
                                                </div>
                                                <div class="pratanah-checkbox-wrapper">
                                                    <input type="checkbox" class="pratanah-checkbox-input" name="fasilitas[]" value="bank" id="fase2_fac_bank" {{ $land && $land->facility_bank ? 'checked' : '' }} {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                    <label class="pratanah-checkbox-label" for="fase2_fac_bank">
                                                        <i class="mdi mdi-checkbox-marked-circle pratanah-check-icon"></i>
                                                        <span class="pratanah-check-text">Bank / ATM</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- DOKUMEN LEGALITAS & UPLOAD BERKAS (KOTAK PER FILE) -->
                                <div class="form-section">
                                    <div class="form-section-title">
                                        Dokumen Legalitas & Upload Berkas
                                    </div>

                                    @php
                                        $uploadedDocs = [];
                                        if ($land) {
                                            foreach ($land->documents as $d) {
                                                $uploadedDocs[$d->document_type_id] = $d;
                                            }
                                        }
                                        $currentUser = auth()->user();
                                        $userPositionName = strtolower($currentUser->position->name ?? '');
                                        $isStaffLegal = str_contains($userPositionName, 'staff') && str_contains($userPositionName, 'legal');
                                        $canValidateDoc = !$isStaffLegal;
                                    @endphp

                                    <div class="row g-3" id="documentGridContainer">
                                        @foreach($documentTypes as $doc)
                                            @php
                                                $existingDoc = $uploadedDocs[$doc->id] ?? null;
                                                $hasFile = ($existingDoc && !empty($existingDoc->file_path));
                                            @endphp
                                            <div class="col-12 col-md-6 col-xl-4" id="doc-box-{{ $doc->id }}">
                                                <div class="card h-100 border shadow-sm rounded-3 p-3 position-relative" style="background: #ffffff; border-color: #eaedf2 !important;">
                                                    <!-- Header Card Box -->
                                                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3 pb-2 border-bottom">
                                                        <div>
                                                            <h6 class="mb-0 fw-bold text-dark" style="font-size: 0.92rem;">{{ $doc->name }}</h6>
                                                        </div>
                                                        <div class="d-flex align-items-center gap-1 flex-wrap justify-content-end">
                                                            @php
                                                                $currentDocStatus = $existingDoc->status ?? ($hasFile ? 'pending' : 'belum_upload');
                                                                $docPhysStatus = $existingDoc->document_status ?? 'ada';
                                                            @endphp

                                                            <!-- Status Fisik Dokumen Badge -->
                                                            @if($docPhysStatus === 'proses')
                                                                <span class="badge bg-warning text-dark py-1 px-2 doc-phys-badge-{{ $doc->id }}" style="font-size: 10px;">
                                                                    <i class="mdi mdi-progress-clock me-1"></i>Masih Proses
                                                                </span>
                                                            @elseif($docPhysStatus === 'belum_ada')
                                                                <span class="badge bg-light text-muted border py-1 px-2 doc-phys-badge-{{ $doc->id }}" style="font-size: 10px;">
                                                                    Belum Ada
                                                                </span>
                                                            @else
                                                                <span class="badge bg-soft-primary text-primary border py-1 px-2 doc-phys-badge-{{ $doc->id }}" style="font-size: 10px;">
                                                                    <i class="mdi mdi-check-circle-outline me-1"></i>Fisik Lengkap
                                                                </span>
                                                            @endif

                                                            <!-- Status Verifikasi Legal Badge -->
                                                            @if($currentDocStatus === 'verified' || $currentDocStatus === 'valid')
                                                                <span class="badge bg-success py-1 px-2 doc-badge-{{ $doc->id }} text-wrap" style="font-size: 10px;">
                                                                    <i class="mdi mdi-shield-check me-1"></i>Sah (ACC)
                                                                </span>
                                                            @elseif($currentDocStatus === 'rejected' || $currentDocStatus === 'revisi')
                                                                <span class="badge bg-danger py-1 px-2 doc-badge-{{ $doc->id }} text-wrap" style="font-size: 10px;">
                                                                    <i class="mdi mdi-alert-circle me-1"></i>Revisi
                                                                </span>
                                                            @elseif($existingDoc && !empty($existingDoc->file_path))
                                                                <span class="badge bg-warning text-dark py-1 px-2 doc-badge-{{ $doc->id }} text-wrap" style="font-size: 10px;">
                                                                    <i class="mdi mdi-clock-outline me-1"></i>Menunggu Verifikasi
                                                                </span>
                                                            @else
                                                                <span class="badge bg-light text-muted border py-1 px-2 doc-badge-{{ $doc->id }}" style="font-size: 10px;">
                                                                    Belum Upload
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <!-- Status Dokumen Fisik / Progres Pengurusan -->
                                                    <div class="mb-2">
                                                        <label class="form-label mb-1 text-muted" style="font-size: 0.8rem; font-weight: 600;">
                                                            Status Fisik / Keberadaan Dokumen
                                                        </label>
                                                        <select name="documents[{{ $doc->id }}][document_status]" class="form-select form-select-sm" onchange="toggleDocProcessNotes(this, {{ $doc->id }})" style="font-size: 0.85rem;" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                            <option value="ada" {{ ($existingDoc->document_status ?? 'ada') === 'ada' ? 'selected' : '' }}>Ada / Lengkap</option>
                                                            <option value="proses" {{ ($existingDoc->document_status ?? '') === 'proses' ? 'selected' : '' }}>Masih Proses (Pengurusan Notaris/BPN/Dinas)</option>
                                                            <option value="belum_ada" {{ ($existingDoc->document_status ?? '') === 'belum_ada' ? 'selected' : '' }}>Belum Ada</option>
                                                        </select>
                                                    </div>

                                                    <!-- Dynamic Form Keterangan / Progres Pengurusan (Muncul saat Masih Proses) -->
                                                    <div class="mb-2 p-2 rounded-2 border {{ ($existingDoc->document_status ?? '') === 'proses' ? '' : 'd-none' }}" id="processNotesContainer_{{ $doc->id }}" style="background: #fffdf5; border-color: #fde68a !important;">
                                                        <label class="form-label mb-1 text-dark fw-bold d-flex align-items-center gap-1" style="font-size: 0.78rem;">
                                                            <i class="mdi mdi-progress-clock text-warning"></i> Keterangan & Progres Pengurusan Dokumen:
                                                        </label>
                                                        <textarea name="documents[{{ $doc->id }}][process_notes]" class="form-control form-control-sm" rows="2" placeholder="Tuliskan progres pengurusan (contoh: Sedang proses balik nama di Notaris Budi, estimasi selesai tgl 15 bulan depan, nomor resi 123)..." style="font-size: 0.8rem;" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>{{ $existingDoc->process_notes ?? '' }}</textarea>
                                                        <small class="text-muted d-block mt-1" style="font-size: 0.72rem; line-height: 1.2;">
                                                            *Kepala Legal dapat memverifikasi & menyetujui dokumen ini secara paralel agar alur lahan tetap bisa berjalan.
                                                        </small>
                                                    </div>

                                                    <!-- Input Nomor Dokumen -->
                                                    <div class="mb-2">
                                                        <label class="form-label mb-1 text-muted" style="font-size: 0.8rem; font-weight: 600;">
                                                             Nomor Dokumen {{ $doc->name }}
                                                        </label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            name="documents[{{ $doc->id }}][number]"
                                                            value="{{ $existingDoc->document_number ?? '' }}"
                                                            placeholder="Nomor {{ $doc->name }}"
                                                            style="font-size: 0.85rem;"
                                                            {{ $hasFile && $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                    </div>

                                                     <!-- Catatan Revisi Legalitas (Jika Ditolak / Direvisi) -->
                                                     @php
                                                         $hasRevision = $existingDoc && (($existingDoc->status ?? '') === 'rejected' || !empty($existingDoc->admin_notes));
                                                     @endphp
                                                     <div class="alert alert-danger p-2 mb-2 rounded-2 revision-box-{{ $doc->id }} {{ $hasRevision ? '' : 'd-none' }}" style="font-size: 0.78rem; background: #fff5f5; border: 1px solid #fed7d7; color: #c53030;">
                                                         <div class="d-flex align-items-start gap-1">
                                                             <i class="mdi mdi-alert-circle text-danger mt-0" style="font-size: 1rem;"></i>
                                                             <div class="flex-grow-1">
                                                                 <div class="d-flex align-items-center justify-content-between">
                                                                     <strong class="d-block text-danger">Catatan Revisi Legal:</strong>
                                                                     <span class="badge bg-danger text-white px-1 py-0 rev-badge-{{ $doc->id }}" style="font-size: 9px;">
                                                                         Rev #{{ $existingDoc->revision_number ?? 1 }}
                                                                     </span>
                                                                 </div>
                                                                 <div class="text-dark mt-1 revision-notes-text-{{ $doc->id }}" style="font-size: 0.78rem;">
                                                                     {{ $existingDoc->admin_notes ?? 'Berkas ditolak / perlu perbaikan dari pihak pengunggah.' }}
                                                                 </div>
                                                             </div>
                                                         </div>
                                                     </div>

                                                     <!-- Upload Berkas File -->
                                                     <div class="mb-1 flex-grow-1 d-flex flex-column justify-content-end">
                                                         @if($existingDoc && !empty($existingDoc->file_path))
                                                             @php
                                                                 $cleanPath = str_replace('uploads/', '', $existingDoc->file_path);
                                                                 $isDocRejected = ($currentDocStatus === 'rejected' || $currentDocStatus === 'revisi');
                                                             @endphp
                                                             <!-- State: Berkas Sudah Terunggah -->
                                                             <div class="p-2.5 px-3 rounded-3 mb-2" style="background: #f0fdf4; border: 1.5px solid #86efac;">
                                                                 <div class="d-flex align-items-center gap-2 mb-2">
                                                                     <div class="p-1.5 rounded-2 flex-shrink-0 bg-success bg-opacity-10 text-success">
                                                                         <i class="mdi mdi-file-check-outline" style="font-size: 1.25rem;"></i>
                                                                     </div>
                                                                     <div class="overflow-hidden flex-grow-1">
                                                                         <span class="d-block fw-bold text-success" style="font-size: 0.82rem; line-height: 1.2;">Berkas Terunggah</span>
                                                                         <small class="text-muted text-truncate d-block" style="font-size: 0.72rem;">{{ basename($existingDoc->file_path) }}</small>
                                                                     </div>
                                                                 </div>
                                                                 <button type="button" class="btn btn-xs btn-success text-white py-1.5 px-3 d-flex align-items-center justify-content-center w-100 shadow-sm btn-preview-doc"
                                                                      data-url="{{ route('dokumen.preview', ['path' => $cleanPath]) }}"
                                                                      data-ext="{{ pathinfo($existingDoc->file_path, PATHINFO_EXTENSION) }}"
                                                                      data-label="{{ $doc->name }}"
                                                                      style="font-size: 0.78rem; font-weight: 600; border-radius: 6px;">
                                                                      <i class="mdi mdi-eye me-1"></i>Lihat Berkas
                                                                  </button>
                                                             </div>

                                                             <!-- Opsi Ganti / Upload Ulang Berkas (Hanya muncul saat status Ditolak/Revisi) -->
                                                             @if (!$land || ($land && $land->status != 'approved' && $land->status != 'rejected'))
                                                                 <div class="pratanah-file-upload-modern mb-1 ganti-file-box-{{ $doc->id }} {{ $isDocRejected ? '' : 'd-none' }}">
                                                                     <input type="file" name="documents[{{ $doc->id }}][file]" accept=".pdf,.jpg,.jpeg,.png">
                                                                     <div class="pratanah-file-label-modern py-1 px-2" style="background: #fff5f5; border: 1px dashed #fca5a5;">
                                                                         <i class="mdi mdi-cloud-sync" style="font-size: 1.1rem; color: #ef4444;"></i>
                                                                         <div class="pratanah-file-info-modern">
                                                                             <span class="file-label-text text-danger" style="font-size: 0.76rem; font-weight: 600;">Ganti Berkas / Upload Ulang</span>
                                                                         </div>
                                                                     </div>
                                                                 </div>
                                                             @endif

                                                             <!-- Tombol Aksi Validasi Kepala Legal / Admin -->
                                                             @if($canValidateDoc)
                                                                 <div class="mt-2 pt-2 border-top d-flex align-items-center justify-content-between gap-1 w-100" id="action-btns-doc-{{ $existingDoc->id }}">
                                                                     @if(($existingDoc->status ?? '') !== 'verified')
                                                                         <button type="button" class="btn btn-xs btn-success py-1.5 px-2 text-white flex-grow-1 d-inline-flex align-items-center justify-content-center" onclick="approvePraDoc({{ $existingDoc->id }}, {{ $doc->id }})" title="Setujui & Validasi Dokumen" style="font-size: 11px; font-weight: 600;">
                                                                             <i class="mdi mdi-check me-1"></i>Validasi
                                                                         </button>
                                                                     @endif
                                                                     @if(($existingDoc->status ?? '') !== 'rejected')
                                                                         <button type="button" class="btn btn-xs btn-outline-danger py-1.5 px-2 flex-grow-1 d-inline-flex align-items-center justify-content-center" onclick="rejectPraDoc({{ $existingDoc->id }}, {{ $doc->id }})" title="Tolak & Minta Revisi" style="font-size: 11px; font-weight: 600;">
                                                                             <i class="mdi mdi-close me-1"></i>Tolak
                                                                         </button>
                                                                     @endif
                                                                 </div>
                                                             @else
                                                                 <div class="mt-2 pt-2 border-top d-flex align-items-center justify-content-end gap-1 w-100">
                                                                     @if(($existingDoc->status ?? '') === 'verified' || ($existingDoc->status ?? '') === 'valid')
                                                                         <span class="badge bg-success text-white py-1 px-2" style="font-size: 10px;">
                                                                             <i class="mdi mdi-shield-check me-1"></i>Sah
                                                                         </span>
                                                                     @elseif(($existingDoc->status ?? '') === 'rejected' || ($existingDoc->status ?? '') === 'revisi')
                                                                         <span class="badge bg-danger text-white py-1 px-2" style="font-size: 10px;">
                                                                             <i class="mdi mdi-alert-circle me-1"></i>Perlu Revisi
                                                                         </span>
                                                                     @else
                                                                         <span class="badge bg-warning text-dark py-1 px-2" style="font-size: 10px;">
                                                                             <i class="mdi mdi-clock-outline me-1"></i>Menunggu Review
                                                                         </span>
                                                                     @endif
                                                                 </div>
                                                             @endif
                                                        @else
                                                            <!-- State: Dokumen Baru / Belum Ada Berkas -> WAJIB BISA UPLOAD (TIDAK READONLY) -->
                                                            <label class="form-label mb-1 text-muted d-flex align-items-center justify-content-between" style="font-size: 0.8rem; font-weight: 600;">
                                                                <span>Upload Berkas {{ $doc->name }} <span class="text-danger">*</span></span>
                                                                <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25" style="font-size: 9px;">Wajib Upload</span>
                                                            </label>
                                                            <div class="pratanah-file-upload-modern">
                                                                <input type="file" name="documents[{{ $doc->id }}][file]" accept=".pdf,.jpg,.jpeg,.png">
                                                                <div class="pratanah-file-label-modern py-2 px-3" style="border: 1.5px dashed #9a55ff; background: #faf5ff;">
                                                                    <i class="mdi mdi-cloud-upload" style="color: #9a55ff; font-size: 1.3rem;"></i>
                                                                    <div class="pratanah-file-info-modern">
                                                                        <span class="file-label-text fw-bold text-primary" style="font-size: 0.82rem;">Pilih Berkas {{ $doc->name }}</span>
                                                                        <small style="font-size: 0.72rem; color: #8c98a4;">Format PDF, JPG, PNG (Maks 2MB)</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- SPASIAL MAPS KOORDINAT -->
                                <div class="form-section">
                                    <div class="form-section-title">
                                        Koordinat Lokasi (Peta Spasial)
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Latitude</label>
                                            <input type="text" class="form-control" id="fase2_lat" name="lat"
                                                value="{{ $land->lat ?? '-8.1727' }}" placeholder="Contoh: -6.2088" required {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Longitude</label>
                                            <input type="text" class="form-control" id="fase2_lng" name="lng"
                                                value="{{ $land->lng ?? '113.7000' }}" placeholder="Contoh: 106.8456" required {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <div class="pratanah-map-container">
                                                <div id="map-fase2" style="height: 100%; width: 100%;"></div>
                                            </div>
                                        </div>
                                        <div class="col-12 text-end">
                                            <button type="button" class="btn btn-outline-purple btn-action-mobile"
                                                onclick="getCurrentLocation()" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                <i class="mdi mdi-map-marker"></i> Gunakan Lokasi Saya
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- ACTIONS -->
                                <div class="d-flex justify-content-end gap-3 mt-4 footer-action-row" id="actionsFase2Wrapper">
                                    @php
                                        $totalRequired = max($documentTypes->count(), $land ? $land->documents->count() : 0);
                                        $totalVerified = $land ? $land->documents->where('status', 'verified')->count() : 0;
                                        $isAllDocsSah = ($totalRequired > 0) && ($totalVerified === $totalRequired);
                                    @endphp

                                    @if (!$land || ($land && $land->status != 'approved' && $land->status != 'rejected') || !$isAllDocsSah)
                                        <button type="button" class="btn btn-gradient-primary btn-action-mobile" id="btnSaveFase2" onclick="saveFase2()">
                                            <i class="mdi mdi-content-save-all"></i> {{ $land ? 'Update / Simpan Fase 2' : 'Simpan Fase 2' }}
                                        </button>
                                    @endif

                                    @if ($isAllDocsSah)
                                        <button type="button" class="btn btn-gradient-success btn-action-mobile" onclick="switchStep(3)">
                                            <i class="mdi mdi-arrow-right-circle me-1"></i> Lanjut ke Fase 3
                                        </button>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>                <!-- ================= FASE 3 CONTAINER ================= -->
                <div id="containerFase3" class="d-none">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0" style="font-weight: 700; color: #2c2e3f;">
                                FASE 3: Sidang & Keputusan Akhir
                            </h5>
                            @if ($land)
                                @if ($land->status == 'approved')
                                    <span class="badge bg-success py-2 px-3">
                                        Status: DISETUJUI (APPROVED)
                                    </span>
                                @elseif ($land->status == 'rejected')
                                    <span class="badge bg-danger py-2 px-3">
                                        Status: DIBATALKAN (REJECTED)
                                    </span>
                                @else
                                    <span class="badge bg-primary py-2 px-3" style="background: linear-gradient(135deg, #da8cff, #9a55ff) !important;">
                                        Status: FASE 3
                                    </span>
                                @endif
                            @endif
                        </div>
                        <div class="card-body">
                            <form id="formFase3">
                                @csrf
                                <input type="hidden" name="id" value="{{ $land->id ?? '' }}">
                                <input type="hidden" name="fase" value="fase3">

                                <!-- PROFIL PEMILIK & INFORMASI TANAH (FASE 1 & 2) -->
                                @if($land)
                                    <div class="form-section mb-4">
                                        <div class="form-section-title mb-3">
                                            Profil Pemilik & Informasi Tanah
                                        </div>

                                        <div class="row g-3">
                                            <!-- Card Profil Pemilik -->
                                            <div class="col-12 col-md-6">
                                                <div class="p-3 rounded-3 h-100" style="background: linear-gradient(135deg, #fbf9ff, #f6f0ff); border: 1px solid rgba(154, 85, 255, 0.2);">
                                                    <h6 class="fw-bold text-primary mb-3" style="font-size: 0.88rem;">
                                                        Data Pemilik Tanah
                                                    </h6>
                                                    <div class="d-flex flex-column gap-2">
                                                        <div class="fase2-info-row">
                                                            <span class="fase2-info-label">Nama Pemilik Tanah:</span>
                                                            <span class="fase2-info-value">{{ $land->owner_name ?? ($land->certificate_owner ?? '-') }}</span>
                                                        </div>
                                                        <div class="fase2-info-row">
                                                            <span class="fase2-info-label">Nama di Sertifikat:</span>
                                                            <span class="fase2-info-value">{{ $land->certificate_owner ?? '-' }}</span>
                                                        </div>
                                                        <div class="fase2-info-row">
                                                            <span class="fase2-info-label">Sumber Info:</span>
                                                            <span class="fase2-info-value text-muted">{{ $land->land_source ?? '-' }}</span>
                                                        </div>
                                                        <div class="fase2-info-row">
                                                            <span class="fase2-info-label">Alamat Lokasi:</span>
                                                            <span class="fase2-info-value">{{ $land->address ?? '-' }}</span>
                                                        </div>
                                                        <div class="fase2-info-row">
                                                            <span class="fase2-info-label">Zonasi:</span>
                                                            <span class="fase2-info-value">{{ $land->zoning ?? '-' }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Card Data Tanah & Nilai -->
                                            <div class="col-12 col-md-6">
                                                <div class="p-3 rounded-3 h-100" style="background: linear-gradient(135deg, #fbf9ff, #f6f0ff); border: 1px solid rgba(154, 85, 255, 0.2);">
                                                    <h6 class="fw-bold text-primary mb-3" style="font-size: 0.88rem;">
                                                        Informasi Prospek & Nilai Tanah
                                                    </h6>
                                                    <div class="d-flex flex-column gap-2">
                                                        <div class="fase2-info-row">
                                                            <span class="fase2-info-label">Nama Prospek:</span>
                                                            <span class="fase2-info-value">{{ $land->land_name ?? '-' }}</span>
                                                        </div>
                                                        <div class="fase2-info-row">
                                                            <span class="fase2-info-label">Status Kepemilikan:</span>
                                                            <span class="fase2-info-value">
                                                                {{ $land->ownership_status ?? 'SHM' }}
                                                            </span>
                                                        </div>
                                                        <div class="fase2-info-row">
                                                            <span class="fase2-info-label">Luas Tanah:</span>
                                                            <span class="fase2-info-value">{{ $land && $land->area ? number_format($land->area, 0, ',', '.') . ' m²' : '-' }}</span>
                                                        </div>
                                                        <div class="fase2-info-row">
                                                            <span class="fase2-info-label">Harga Penawaran:</span>
                                                            <span class="fase2-info-value text-danger">Rp {{ number_format($land->offer_price ?? 0, 0, ',', '.') }}</span>
                                                        </div>
                                                        <div class="fase2-info-row">
                                                            <span class="fase2-info-label">Target Negosiasi:</span>
                                                            <span class="fase2-info-value text-primary">Rp {{ number_format($land->estimated_price ?? 0, 0, ',', '.') }}</span>
                                                        </div>
                                                        <div class="fase2-info-row">
                                                            <span class="fase2-info-label">Status Legalitas / Sengketa:</span>
                                                            <span class="fase2-info-value">
                                                                @if(($land->legal_status ?? '') == 'problem')
                                                                    <span class="badge bg-danger py-1 px-2" style="font-size: 11px;">Bermasalah: {{ $land->legal_issue_note ?? 'Dalam Sengketa' }}</span>
                                                                @elseif(($land->legal_status ?? '') == 'checking')
                                                                    <span class="badge bg-warning text-dark py-1 px-2" style="font-size: 11px;">Dalam Pengecekan Notaris/BPN</span>
                                                                @else
                                                                    <span class="badge bg-success py-1 px-2" style="font-size: 11px;">Clear / Bebas Sengketa</span>
                                                                @endif
                                                            </span>
                                                        </div>
                                                        <div class="fase2-info-row">
                                                            <span class="fase2-info-label">Tingkat Kesulitan Izin:</span>
                                                            <span class="fase2-info-value">
                                                                @if(in_array(($land->permit_difficulty ?? ''), ['sulit', 'very_sulit']))
                                                                    <span class="badge bg-warning text-dark py-1 px-2" style="font-size: 11px;">{{ ucfirst($land->permit_difficulty) }} ({{ $land->permit_difficulty_note ?? '-' }})</span>
                                                                @else
                                                                    <span class="badge bg-info text-white py-1 px-2" style="font-size: 11px;">{{ ucfirst($land->permit_difficulty ?? 'Mudah') }}</span>
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- KEPUTUSAN SIDANG AKHIR -->
                                <div class="form-section">
                                    <div class="form-section-title">
                                        Hasil Sidang & Keputusan Direksi
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Hasil Keputusan Sidang Akhir <span class="text-danger">*</span></label>
                                            <select class="form-select border-primary" id="fase3_status_akhir" name="status" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                <option value="approved" {{ $land && $land->status == 'approved' ? 'selected' : '' }}>DIAMBIL - Deal untuk Diakuisisi (Masuk LandBank Utama)</option>
                                                <option value="pending" {{ $land && $land->status == 'pending' ? 'selected' : '' }}>DIPENDING - Ditunda Sementara (Negosiasi / Evaluasi Lanjutan)</option>
                                                <option value="rejected" {{ $land && $land->status == 'rejected' ? 'selected' : '' }}>DIBATALKAN - Gugur Prospeknya (Tidak Diambil)</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Skala Prioritas Akuisisi</label>
                                            <select class="form-select" name="prioritas" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                <option value="urgent" {{ $land && $land->priority == 'urgent' ? 'selected' : '' }}>Urgent (Sangat Prioritas / Segera Diproses)</option>
                                                <option value="high" {{ $land && $land->priority == 'high' ? 'selected' : '' }}>High (Tinggi)</option>
                                                <option value="normal" {{ $land && ($land->priority == 'normal' || !$land->priority) ? 'selected' : '' }}>Normal</option>
                                                <option value="low" {{ $land && $land->priority == 'low' ? 'selected' : '' }}>Low (Rendah)</option>
                                            </select>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="form-label fw-bold">Catatan & Kesimpulan Keputusan Sidang</label>
                                            <textarea class="form-control" name="catatan" rows="3" placeholder="Masukkan ringkasan pertimbangan keputusan rapat, kesepakatan notaris, tanggal rencana akta pelepasan..." {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>{{ $land->notes ?? '' }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <!-- ASPEK LEGALITAS & BIAYA TRANSAKSI -->
                                <div class="form-section">
                                    <div class="form-section-title d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2">
                                        <div>
                                            Aspek Legalitas, Pajak & Biaya Administrasi
                                        </div>
                                        @if (!$land || ($land && $land->status != 'approved' && $land->status != 'rejected'))
                                            <button type="button" class="btn btn-sm btn-gradient-primary py-1 px-3 shadow-sm d-inline-flex align-items-center gap-1 text-white text-nowrap flex-shrink-0" onclick="addCustomCostRow()" style="font-size: 0.8rem; font-weight: 600; border-radius: 6px; white-space: nowrap;">
                                                <i class="mdi mdi-plus-circle me-1" style="font-size: 1rem;"></i> Tambah Biaya Admin / Lainnya
                                            </button>
                                        @endif
                                    </div>
                                    
                                    <!-- Estimasi Biaya Transaksi Standard -->
                                    <div class="row mb-2">
                                        <div class="col-md-3 mb-2">
                                            <label class="form-label text-muted fw-semibold" style="font-size: 0.82rem;">Biaya IJB / PPJB Notaris</label>
                                            <input type="text" class="form-control cost-input" name="biaya_ijb_temp" data-cost-name="Biaya IJB / PPJB Notaris" value="{{ $land && $land->cost_ijb ? number_format($land->cost_ijb, 0, ',', '.') : '' }}" placeholder="Contoh: 10.000.000" onkeyup="formatRupiahTemp(this); updateFinancialSummary();" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label class="form-label text-muted fw-semibold" style="font-size: 0.82rem;">Estimasi Pajak PPh/BPHTB</label>
                                            <input type="text" class="form-control cost-input" name="biaya_pajak_temp" data-cost-name="Estimasi Pajak (PPh & BPHTB)" value="{{ $land && $land->cost_tax ? number_format($land->cost_tax, 0, ',', '.') : '' }}" placeholder="Contoh: 50.000.000" onkeyup="formatRupiahTemp(this); updateFinancialSummary();" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label class="form-label text-muted fw-semibold" style="font-size: 0.82rem;">Fee Makelar / Perantara</label>
                                            <input type="text" class="form-control cost-input" name="fee_makelar_temp" data-cost-name="Fee Makelar / Perantara" value="{{ $land && $land->cost_broker ? number_format($land->cost_broker, 0, ',', '.') : '' }}" placeholder="Contoh: 15.000.000" onkeyup="formatRupiahTemp(this); updateFinancialSummary();" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label class="form-label text-muted fw-semibold" style="font-size: 0.82rem;">Biaya Lain-lain</label>
                                            <input type="text" class="form-control cost-input" name="biaya_lain_temp" data-cost-name="Biaya Lain-lain Admin" value="{{ $land && $land->cost_other ? number_format($land->cost_other, 0, ',', '.') : '' }}" placeholder="Contoh: 5.000.000" onkeyup="formatRupiahTemp(this); updateFinancialSummary();" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                    </div>

                                    <!-- Dynamic Custom Extra Costs Container -->
                                    <div id="custom_costs_container" class="row g-2 mb-3"></div>

                                    <!-- RINGKASAN DOKUMEN LEGALITAS DARI FASE 2 (READ-ONLY) -->
                                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
                                        <div>
                                            <h6 class="mb-0 text-dark fw-bold" style="font-size: 0.95rem;">
                                                Ringkasan Dokumen Legalitas (Hasil Validasi Fase 2)
                                            </h6>
                                            <small class="text-muted" style="font-size: 0.78rem;">Seluruh berkas legalitas berikut telah diverifikasi dan disetujui sah oleh Kepala Legal pada Fase 2.</small>
                                        </div>
                                        <span class="badge bg-soft-success text-success border border-success-subtle py-1 px-3" style="font-size: 0.8rem; font-weight: 600;">
                                            Legalitas Terverifikasi Sah
                                        </span>
                                    </div>

                                    <!-- GRID RINGKASAN DOKUMEN FASE 3 (READ-ONLY) -->
                                    <div class="row g-3 mb-4" id="fase3DocumentGridContainer">
                                        @foreach($documentTypes as $doc)
                                            @php
                                                $existingDoc = $uploadedDocs[$doc->id] ?? null;
                                                $hasExistingFile = ($existingDoc && !empty($existingDoc->file_path));
                                                $cleanPath = $hasExistingFile ? str_replace('uploads/', '', $existingDoc->file_path) : null;
                                                $docPhysStatus = $existingDoc->document_status ?? 'ada';
                                            @endphp
                                            <div class="col-md-6 col-lg-4">
                                                <div class="card h-100 border shadow-sm rounded-3 p-3 d-flex flex-column" style="background: #ffffff; border-color: #eaedf2 !important;">
                                                    <div class="d-flex align-items-center justify-content-between mb-2 pb-2 border-bottom">
                                                        <div>
                                                            <h6 class="mb-0 fw-bold text-dark" style="font-size: 0.9rem;">{{ $doc->name }}</h6>
                                                        </div>
                                                        <div class="d-flex align-items-center gap-1">
                                                            @if($docPhysStatus === 'proses')
                                                                <span class="badge bg-warning text-dark py-1 px-2" style="font-size: 10px;">
                                                                    <i class="mdi mdi-progress-clock me-1"></i>Proses
                                                                </span>
                                                            @endif

                                                            @if($existingDoc && in_array($existingDoc->status ?? '', ['verified', 'valid']))
                                                                <span class="badge bg-success py-1 px-2" style="font-size: 10px;">
                                                                    <i class="mdi mdi-shield-check me-1"></i>Sah (ACC)
                                                                </span>
                                                            @else
                                                                <span class="badge bg-secondary py-1 px-2" style="font-size: 10px;">
                                                                    {{ ucfirst($existingDoc->status ?? 'Tersedia') }}
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="mb-2">
                                                        <small class="text-muted d-block" style="font-size: 0.75rem;">Status Keberadaan:</small>
                                                        <span class="fw-semibold {{ $docPhysStatus === 'proses' ? 'text-warning-emphasis' : ($docPhysStatus === 'belum_ada' ? 'text-danger' : 'text-success') }}" style="font-size: 0.82rem;">
                                                            @if($docPhysStatus === 'proses')
                                                                <i class="mdi mdi-clock-outline me-1"></i>Masih Proses Pengurusan
                                                            @elseif($docPhysStatus === 'belum_ada')
                                                                <i class="mdi mdi-close-circle-outline me-1"></i>Belum Ada
                                                            @else
                                                                <i class="mdi mdi-check-circle-outline me-1"></i>Fisik Lengkap
                                                            @endif
                                                        </span>
                                                    </div>

                                                    <div class="mb-2">
                                                        <small class="text-muted d-block" style="font-size: 0.75rem;">Nomor Dokumen:</small>
                                                        <span class="fw-semibold text-dark" style="font-size: 0.85rem;">
                                                            {{ $existingDoc->document_number ?? '-' }}
                                                        </span>
                                                    </div>

                                                    @if($docPhysStatus === 'proses' && !empty($existingDoc->process_notes))
                                                        <div class="p-2 rounded-2 mb-2 border" style="background: #fffdf5; border-color: #fde68a !important; font-size: 0.78rem;">
                                                            <strong class="d-block text-dark mb-1"><i class="mdi mdi-information-outline text-warning me-1"></i>Keterangan Proses:</strong>
                                                            <span class="text-muted">{{ $existingDoc->process_notes }}</span>
                                                        </div>
                                                    @endif

                                                    @if($hasExistingFile)
                                                        <div class="mt-auto pt-2 border-top d-flex align-items-center justify-content-between">
                                                            <button type="button" class="btn btn-sm btn-success text-white py-1 px-3 d-inline-flex align-items-center flex-shrink-0 btn-preview-doc"
                                                                data-url="{{ route('dokumen.preview', ['path' => $cleanPath]) }}"
                                                                data-ext="{{ pathinfo($existingDoc->file_path, PATHINFO_EXTENSION) }}"
                                                                data-label="{{ $doc->name }}"
                                                                style="font-size: 0.78rem; font-weight: 600; border-radius: 6px;">
                                                                <i class="mdi mdi-eye me-1"></i>Lihat Berkas
                                                            </button>
                                                            <small class="text-muted" style="font-size: 0.72rem;">
                                                                {{ $existingDoc->updated_at ? $existingDoc->updated_at->format('d M Y') : '' }}
                                                            </small>
                                                        </div>
                                                    @else
                                                        <div class="mt-auto pt-2 border-top">
                                                            <span class="text-muted fst-italic" style="font-size: 0.75rem;">Tidak ada file berkas fisik</span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- SKEMA PEMBAYARAN & PEMBAYARAN BERTAHAP -->
                                <div class="form-section">
                                    <div class="form-section-title">
                                        Skema Transaksi & Jadwal Pembayaran
                                    </div>

                                    <!-- HARGA DEAL & DP CALCULATOR -->
                                    <div class="row g-3 mb-3">
                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <label class="form-label text-muted">Harga Target Negosiasi (Fase 1)</label>
                                            <input type="text" class="form-control" value="Rp {{ $land && $land->estimated_price ? number_format($land->estimated_price, 0, ',', '.') : '0' }}" disabled style="background-color: #f1f3f7; color: #6c757d; font-weight: 600;">
                                        </div>
                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <label class="form-label text-dark font-weight-bold">Harga Deal Pokok Tanah (Rp) <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control font-weight-bold border-primary" id="deal_price_input" name="deal_price" value="Rp {{ $land && ($land->deal_price || $land->estimated_price) ? number_format($land->deal_price ?? $land->estimated_price, 0, ',', '.') : ($land && $land->offer_price ? number_format($land->offer_price, 0, ',', '.') : '0') }}" placeholder="Contoh: 500.000.000" onkeyup="formatRupiahTemp(this); calculateInstallments(); updateFinancialSummary();" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <label class="form-label font-weight-bold" style="color: #7e22ce;">Grand Total Final Transaksi (Rp)</label>
                                            <input type="text" class="form-control font-weight-bold" id="grand_total_final_display" value="Rp 0" disabled style="background-color: #f5f3ff; color: #7e22ce; border: 1.5px solid #d8b4fe; font-size: 0.95rem; font-weight: 700;">
                                        </div>
                                        <div class="col-12 col-sm-6 col-lg-6" id="dp_container" style="display: none;">
                                            <label class="form-label text-primary font-weight-bold">Uang Muka / DP (Rp)</label>
                                            <input type="text" class="form-control border-success mb-2 font-weight-bold" id="dp_price_input" placeholder="Masukkan nominal DP" value="{{ ($land && $land->payments->count() > 0) ? number_format($land->payments->first()->amount, 0, ',', '.') : '' }}" onkeyup="formatRupiahTemp(this); calculateInstallments(); updateFinancialSummary();" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-12 col-sm-6 col-lg-6" id="remaining_container" style="display: none;">
                                            <label class="form-label text-muted">Sisa Pembayaran (Rp)</label>
                                            <input type="text" class="form-control font-weight-bold text-danger" id="remaining_price_input" value="0" disabled style="background-color: #f8f9fa;">
                                        </div>
                                    </div>

                                    <!-- RINCIAN AKUMULASI TOTAL BIAYA & SKEMA TRANSAKSI WIDGET (100% DINAMIS) -->
                                    <div class="card shadow-none border mb-4 p-3 rounded-3" style="background: #ffffff;">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h6 class="mb-0 text-dark fw-bold" style="font-size: 0.9rem;">
                                                Rincian Akumulasi Total Biaya & Skema Transaksi
                                            </h6>
                                            <span class="badge bg-light text-primary border px-2 py-1" id="calc_method_badge" style="font-size: 11px;">
                                                Cash Keras
                                            </span>
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table table-sm table-bordered align-middle mb-0" style="font-size: 0.85rem;">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th width="60%">Komponen Transaksi</th>
                                                        <th class="text-end" width="40%">Nominal (Rp)</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="calc_summary_tbody">
                                                    <!-- Dynamic rows will be inserted here live -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- METODE PEMBAYARAN & JANGKA WAKTU -->
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label fw-bold">Metode Pembayaran</label>
                                            <select class="form-select border-primary fw-bold" id="temp_payment_method" name="payment_method_temp" onchange="toggleInstallmentView(); updateFinancialSummary();" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                <option value="cash" {{ $land && $land->payment_method == 'cash' ? 'selected' : '' }}>Cash Keras (Lunas Sekaligus)</option>
                                                <option value="termin" {{ $land && $land->payment_method == 'termin' ? 'selected' : '' }}>Pembayaran Bertahap (Termin)</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3" id="temp_duration_container" style="display: none;">
                                            <label class="form-label fw-bold">Jangka Waktu Bertahap</label>
                                            <select class="form-select" id="temp_installment_duration" name="installment_duration_temp" onchange="generateInstallmentRows()" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                <option value="3_bulan" {{ $land && $land->installment_duration == '3_bulan' ? 'selected' : '' }}>3 Bulan</option>
                                                <option value="6_bulan" {{ $land && $land->installment_duration == '6_bulan' ? 'selected' : '' }}>6 Bulan</option>
                                                <option value="9_bulan" {{ $land && $land->installment_duration == '9_bulan' ? 'selected' : '' }}>9 Bulan</option>
                                                <option value="1_tahun" {{ $land && ($land->installment_duration == '1_tahun' || !$land->installment_duration) ? 'selected' : '' }}>1 Tahun</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3" id="temp_count_container" style="display: none;">
                                            <label class="form-label fw-bold">Frekuensi Pembayaran</label>
                                            <select class="form-select" id="temp_installment_count" name="installment_count_temp" onchange="generateInstallmentRows()" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                <option value="2" {{ $land && $land->installment_count == 2 ? 'selected' : '' }}>2x Bayar</option>
                                                <option value="3" {{ $land && $land->installment_count == 3 ? 'selected' : '' }}>3x Bayar</option>
                                                <option value="4" {{ $land && ($land->installment_count == 4 || !$land->installment_count) ? 'selected' : '' }}>4x Bayar</option>
                                                <option value="5" {{ $land && $land->installment_count == 5 ? 'selected' : '' }}>5x Bayar</option>
                                                <option value="6" {{ $land && $land->installment_count == 6 ? 'selected' : '' }}>6x Bayar</option>
                                                <option value="12" {{ $land && $land->installment_count == 12 ? 'selected' : '' }}>12x Bayar</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- FORM PEMBAYARAN CASH KERAS -->
                                    @php
                                        $cashPayment = ($land && $land->payment_method == 'cash') ? $land->payments->first() : null;
                                        $initialGrandTotal = ($land ? ($land->estimated_price ?? $land->offer_price ?? 0) + ($land->cost_ijb ?? 0) + ($land->cost_tax ?? 0) + ($land->cost_broker ?? 0) + ($land->cost_other ?? 0) : 0);
                                    @endphp
                                    <div id="cash_payment_container" class="card shadow-none border mt-2 mb-3 p-3 rounded-3" style="background: #fafbfe;">
                                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2 mb-3">
                                            <div>
                                                <h6 class="mb-0 text-dark font-weight-bold">
                                                    Rincian Pembayaran Cash Keras (Lunas Sekaligus)
                                                </h6>
                                                <small class="text-muted">Lengkapi data nominal pelunasan (otomatis mengikuti Grand Total), tanggal realisasi transaksi, bukti transfer, dan status pembayaran.</small>
                                            </div>
                                            <span class="badge bg-success-subtle text-success border border-success px-3 py-1 fw-bold text-nowrap flex-shrink-0">
                                                1x Pelunasan
                                            </span>
                                        </div>

                                        <div class="row g-3">
                                            <!-- Tipe Pembayaran Realisasi -->
                                            <div class="col-12 col-sm-6 col-lg-3">
                                                <label class="form-label fw-semibold text-dark" style="font-size: 0.82rem;">
                                                    Tipe Pembayaran <span class="text-danger">*</span>
                                                </label>
                                                <select name="cash_payment_type" id="cash_payment_type" class="form-select border-primary fw-semibold" onchange="toggleCashChannelFields()" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                    <option value="transfer" {{ (!$cashPayment || $cashPayment->payment_type == 'transfer' || !$cashPayment->payment_type) ? 'selected' : '' }}>Transfer Bank</option>
                                                    <option value="cash" {{ ($cashPayment && $cashPayment->payment_type == 'cash') ? 'selected' : '' }}>Tunai / Cash Langsung</option>
                                                </select>
                                            </div>

                                            <!-- Nominal Pelunasan (Otomatis Ikut Grand Total) -->
                                            <div class="col-12 col-sm-6 col-lg-3">
                                                <label class="form-label fw-semibold text-dark" style="font-size: 0.82rem;">
                                                    Nominal Pelunasan (Grand Total) <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control fw-bold border-success text-dark" id="cash_amount_input" name="cash_amount_temp" 
                                                    value="Rp {{ number_format($cashPayment ? $cashPayment->amount : $initialGrandTotal, 0, ',', '.') }}" 
                                                    placeholder="Rp 0" onkeyup="formatRupiahTemp(this); updateFinancialSummary();" 
                                                    {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                            </div>

                                            <!-- Tanggal Pelunasan -->
                                            <div class="col-12 col-sm-6 col-lg-3">
                                                <label class="form-label fw-semibold text-dark" style="font-size: 0.82rem;">
                                                    Tanggal Realisasi / Bayar <span class="text-danger">*</span>
                                                </label>
                                                <input type="date" class="form-control" name="cash_payment_date" 
                                                    value="{{ $cashPayment && $cashPayment->due_date ? \Carbon\Carbon::parse($cashPayment->due_date)->format('Y-m-d') : date('Y-m-d') }}" 
                                                    {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                            </div>

                                            <!-- Status Pembayaran -->
                                            <div class="col-12 col-sm-6 col-lg-3">
                                                <label class="form-label fw-semibold text-dark" style="font-size: 0.82rem;">
                                                    Status Pembayaran <span class="text-danger">*</span>
                                                </label>
                                                <select name="cash_status" class="form-select border-success fw-semibold" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                    <option value="lunas" {{ (!$cashPayment || $cashPayment->status == 'lunas') ? 'selected' : '' }}>Lunas</option>
                                                    <option value="belum" {{ ($cashPayment && $cashPayment->status == 'belum') ? 'selected' : '' }}>Belum Lunas</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- DETAIL TRANSFER BANK CONTAINER (MUNCUL JIKA TRANSFER) -->
                                        <div id="cash_bank_details_container" class="row g-3 mt-1 pt-2 border-top" style="{{ ($cashPayment && $cashPayment->payment_type == 'cash') ? 'display: none;' : '' }}">
                                            <!-- Nama Bank -->
                                            <div class="col-12 col-sm-6 col-lg-4">
                                                <label class="form-label fw-semibold text-dark" style="font-size: 0.82rem;">
                                                    Nama Bank Penerima / Tujuan
                                                </label>
                                                <input type="text" class="form-control form-control-sm" name="cash_bank_name" 
                                                    value="{{ $cashPayment->bank_name ?? '' }}" 
                                                    placeholder="Contoh: BCA / Mandiri / BRI / BNI" 
                                                    {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                            </div>

                                            <!-- Nomor Rekening -->
                                            <div class="col-12 col-sm-6 col-lg-4">
                                                <label class="form-label fw-semibold text-dark" style="font-size: 0.82rem;">
                                                    Nomor Rekening Penerima
                                                </label>
                                                <input type="text" class="form-control form-control-sm" name="cash_account_number" 
                                                    value="{{ $cashPayment->account_number ?? '' }}" 
                                                    placeholder="Contoh: 1234567890" 
                                                    {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                            </div>

                                            <!-- Atas Nama Rekening -->
                                            <div class="col-12 col-sm-6 col-lg-4">
                                                <label class="form-label fw-semibold text-dark" style="font-size: 0.82rem;">
                                                    Atas Nama Rekening (A/N)
                                                </label>
                                                <input type="text" class="form-control form-control-sm" name="cash_account_holder" 
                                                    value="{{ $cashPayment->account_holder ?? ($land->owner_name ?? '') }}" 
                                                    placeholder="Nama Pemilik Rekening" 
                                                    {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                            </div>
                                        </div>

                                        <!-- ROW BUKTI PEMBAYARAN -->
                                        <div class="row g-3 mt-1">
                                            <!-- Upload Bukti Pelunasan / Transfer -->
                                            <div class="col-12">
                                                <label class="form-label fw-semibold text-dark" style="font-size: 0.82rem;">
                                                    Bukti Transfer / Kuitansi Fisik Pelunasan
                                                </label>
                                                <div class="pratanah-file-upload-modern py-2 px-3 d-flex align-items-center justify-content-between" style="border-width: 1px; border-style: dashed; border-radius: 6px; background: #ffffff;">
                                                    <input type="file" name="cash_file" id="cash_payment_file" class="d-none" onchange="handleSingleFileUpload(this)" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                    <label for="cash_payment_file" class="mb-0 d-flex align-items-center gap-2 cursor-pointer w-100" style="font-size: 11px;">
                                                        <i class="mdi mdi-cloud-upload-outline text-muted fs-4"></i>
                                                        <span class="text-truncate text-muted file-label-text" style="max-width: 280px;">
                                                            {{ $cashPayment && $cashPayment->file_path ? basename($cashPayment->file_path) : 'Unggah Bukti Transfer / Kuitansi Pelunasan' }}
                                                        </span>
                                                    </label>
                                                    @if($cashPayment && $cashPayment->file_path)
                                                        @php $cleanCashPath = str_replace('uploads/', '', $cashPayment->file_path); @endphp
                                                        <button type="button" class="btn btn-xs btn-outline-primary ms-2 py-1 px-2 btn-preview-doc"
                                                            data-url="{{ route('dokumen.preview', ['path' => $cleanCashPath]) }}"
                                                            data-ext="{{ pathinfo($cashPayment->file_path, PATHINFO_EXTENSION) }}"
                                                            data-label="Bukti Pelunasan Tunai"
                                                            title="Lihat Berkas" style="font-size: 11px;">
                                                            <i class="mdi mdi-eye me-1"></i>Lihat Berkas
                                                        </button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- INSTALLMENT WIDGET (MULTI-TERMIN DINAMIS) -->
                                    <div id="installment_widget_container" class="card shadow-none border mt-3 p-3 rounded-3" style="display: none; background: #fafbfe;">
                                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2 mb-3">
                                            <div>
                                                <h6 class="mb-0 text-dark font-weight-bold">
                                                    Rencana Jadwal Pembayaran Bertahap (Termin)
                                                </h6>
                                                <small class="text-muted">Nominal, tanggal jatuh tempo, dan bukti pembayaran dapat dikelola per tahap.</small>
                                            </div>
                                            @if (!$land || ($land && $land->status != 'approved' && $land->status != 'rejected'))
                                                <button type="button" class="btn btn-sm btn-gradient-primary py-1 px-3 shadow-sm d-inline-flex align-items-center gap-1 text-white text-nowrap flex-shrink-0" onclick="addCustomInstallmentRow()" style="font-size: 0.8rem; font-weight: 600; border-radius: 6px; white-space: nowrap;">
                                                    <i class="mdi mdi-plus-circle me-1" style="font-size: 1rem;"></i> Tambah Tahap Pembayaran
                                                </button>
                                            @endif
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover align-middle mb-2" style="background: white;">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th style="min-width: 130px; width: 15%;">Tahap</th>
                                                        <th style="min-width: 175px; width: 18%;">Metode / Rekening</th>
                                                        <th style="min-width: 165px; width: 20%;">Nominal Pembayaran (Rp)</th>
                                                        <th style="min-width: 135px; width: 14%;">Jatuh Tempo</th>
                                                        <th style="min-width: 140px; width: 15%;">Bukti Pembayaran</th>
                                                        <th style="min-width: 100px; width: 11%;" class="text-center">Status</th>
                                                        <th style="min-width: 55px; width: 7%;" class="text-center">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="installment_tbody">
                                                    @if($land && $land->payments->count() > 0)
                                                        @foreach($land->payments as $index => $payment)
                                                            @php $i = $index + 1; @endphp
                                                            <tr id="termin_row_{{ $i }}">
                                                                <td class="font-weight-bold text-primary text-center">
                                                                    <input type="hidden" name="installments[{{ $i }}][existing_file_path]" value="{{ $payment->file_path }}">
                                                                    <input type="text" name="installments[{{ $i }}][term_name]" class="form-control form-control-sm text-center fw-bold text-primary" value="{{ $payment->term_name }}" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                                </td>
                                                                <td>
                                                                    <select name="installments[{{ $i }}][payment_type]" class="form-select form-select-sm mb-1 py-0" style="font-size: 11px;" onchange="handleTerminTypeChange(this)" {{ $land && $land->status == 'rejected' ? 'disabled' : '' }}>
                                                                        <option value="transfer" {{ (!$payment->payment_type || $payment->payment_type == 'transfer') ? 'selected' : '' }}>Transfer Bank</option>
                                                                        <option value="cash" {{ ($payment->payment_type == 'cash') ? 'selected' : '' }}>Tunai / Cash</option>
                                                                    </select>
                                                                    <div class="termin-bank-box" style="{{ ($payment->payment_type == 'cash') ? 'display: none;' : '' }}">
                                                                        <input type="text" name="installments[{{ $i }}][account_number]" class="form-control form-control-sm py-0" style="font-size: 11px;" placeholder="Bank & No. Rekening" value="{{ $payment->account_number ?? '' }}" {{ $land && $land->status == 'rejected' ? 'disabled' : '' }}>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="installments[{{ $i }}][amount_temp]" class="form-control form-control-sm termin-amount-input fw-semibold" value="Rp {{ number_format($payment->amount, 0, ',', '.') }}" placeholder="Rp 0" onkeyup="formatRupiahTemp(this); updateInstallmentBalance();" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                                </td>
                                                                <td>
                                                                    <input type="date" name="installments[{{ $i }}][due_date]" class="form-control form-control-sm" value="{{ $payment->due_date ? \Carbon\Carbon::parse($payment->due_date)->format('Y-m-d') : '' }}" {{ $land && $land->status == 'rejected' ? 'disabled' : '' }}>
                                                                </td>
                                                                <td>
                                                                    <div class="pratanah-file-upload-modern py-1 px-2 d-flex align-items-center justify-content-between" style="border-width: 1px; border-style: dashed; border-radius: 6px; background: rgba(0,0,0,0.01);">
                                                                        <input type="file" name="installments[{{ $i }}][file]" id="file_tahap_{{ $i }}" class="d-none" onchange="handleTerminFileName(this)" {{ $land && $land->status == 'rejected' ? 'disabled' : '' }}>
                                                                        <label for="file_tahap_{{ $i }}" class="mb-0 d-flex align-items-center gap-2 cursor-pointer w-100" style="font-size: 11px;">
                                                                            <i class="mdi mdi-file-upload text-muted fs-5"></i>
                                                                            <span class="text-truncate text-muted file-label-text" style="max-width: 120px;">
                                                                                {{ $payment->file_path ? basename($payment->file_path) : 'Pilih Bukti' }}
                                                                            </span>
                                                                        </label>
                                                                        @if($payment->file_path)
                                                                            @php
                                                                                $cleanPath = str_replace('uploads/', '', $payment->file_path);
                                                                            @endphp
                                                                            <button type="button" class="btn btn-xs btn-link p-0 ms-1 text-primary btn-preview-doc"
                                                                                data-url="{{ route('dokumen.preview', ['path' => $cleanPath]) }}"
                                                                                data-ext="{{ pathinfo($payment->file_path, PATHINFO_EXTENSION) }}"
                                                                                data-label="Bukti Pembayaran {{ $payment->term_name }}"
                                                                                title="Lihat Berkas">
                                                                                <i class="mdi mdi-eye" style="font-size: 14px;"></i>
                                                                            </button>
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <select name="installments[{{ $i }}][status]" class="form-select form-select-sm termin-status-select" {{ $land && $land->status == 'rejected' ? 'disabled' : '' }}>
                                                                        <option value="belum" {{ $payment->status == 'belum' ? 'selected' : '' }}>Belum</option>
                                                                        <option value="lunas" {{ $payment->status == 'lunas' ? 'selected' : '' }}>Lunas</option>
                                                                    </select>
                                                                </td>
                                                                <td class="text-center">
                                                                    @if (!$land || ($land && $land->status != 'approved' && $land->status != 'rejected'))
                                                                        <button type="button" class="btn btn-xs btn-danger text-white py-1 px-2 shadow-sm" onclick="removeInstallmentRow(this)" title="Hapus Tahap" style="background-color: #ef4444; border: 1px solid #ef4444; border-radius: 4px;">
                                                                            <i class="mdi mdi-delete text-white"></i>
                                                                        </button>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- STATUS BALANCE INDIKATOR -->
                                        <div class="d-flex justify-content-between align-items-center p-2 rounded-2 mt-1" id="termin_balance_box" style="background: #eef2ff; font-size: 0.82rem;">
                                            <div>
                                                <span>Total Terjadwal Termin: <strong id="termin_total_scheduled">Rp 0</strong></span>
                                                <span class="ms-3 text-muted">Target Pokok: <strong id="termin_target_deal" class="text-dark">Rp 0</strong></span>
                                            </div>
                                            <div id="termin_balance_status">
                                                <span class="badge bg-success"><i class="mdi mdi-check-circle me-1"></i>Balance / Sesuai</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- ACTIONS -->
                                <div class="d-flex justify-content-between align-items-center gap-3 mt-4 footer-action-row">
                                    <div>
                                        @if ($land)
                                            <button type="button" class="btn btn-outline-purple py-2 px-3 shadow-sm" onclick="previewInvoice()">
                                                <i class="mdi mdi-printer me-1"></i> Cetak / Pratinjau Invoice
                                            </button>
                                        @endif
                                    </div>
                                    <div class="d-flex gap-2">
                                        @if ($land && $land->status == 'approved')
                                            <button type="button" class="btn btn-gradient-warning py-2 px-4 shadow-sm" onclick="saveFase3()">
                                                <i class="mdi mdi-cash-check me-1"></i> Update Pembayaran Cicilan
                                            </button>
                                        @elseif (!$land || ($land && $land->status != 'approved' && $land->status != 'rejected'))
                                            <button type="button" class="btn btn-gradient-success py-2 px-4 shadow-sm" onclick="saveFase3()">
                                                <i class="mdi mdi-content-save-all me-1"></i> Simpan Keputusan Fase 3
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    {{-- MODAL PREVIEW DOKUMEN (ZOOMABLE IMAGE + PDF READER + SCROLLABLE) --}}
    <div class="modal fade" id="modalPreviewDokumen" tabindex="-1" aria-hidden="true" style="z-index: 1060;">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content shadow-lg" style="border-radius:14px; overflow:hidden; border:none;">
                <div class="modal-header bg-white border-bottom py-2 px-3 d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <i class="mdi mdi-file-eye-outline fs-5 text-primary" id="modalDocIcon"></i>
                        <h6 class="modal-title mb-0 fw-bold text-dark text-truncate" style="max-width: 280px;" id="modalDocLabel">Preview Dokumen</h6>
                        <span class="badge bg-secondary ms-1" id="modalDocExt" style="font-size:0.68rem;"></span>
                    </div>

                    {{-- Toolbar Zoom & Aksi --}}
                    <div class="d-flex align-items-center gap-2">
                        {{-- Toolbar Image Zoom (Hanya aktif saat gambar) --}}
                        <div id="imgZoomToolbar" class="d-none align-items-center bg-light border rounded-pill px-2 py-0.5 gap-1">
                            <button type="button" class="btn btn-xs btn-link text-dark p-1" onclick="changeImageZoom(-0.25)" title="Zoom Out (-)">
                                <i class="mdi mdi-magnify-minus-outline fs-6"></i>
                            </button>
                            <span id="imgZoomLevelText" class="fw-bold text-muted px-1" style="font-size: 0.75rem; min-width: 42px; text-align: center;">100%</span>
                            <button type="button" class="btn btn-xs btn-link text-dark p-1" onclick="changeImageZoom(0.25)" title="Zoom In (+)">
                                <i class="mdi mdi-magnify-plus-outline fs-6"></i>
                            </button>
                            <div class="vr my-1"></div>
                            <button type="button" class="btn btn-xs btn-link text-dark p-1" onclick="resetImageTransform()" title="Reset Ukuran (100%)">
                                <i class="mdi mdi-fit-to-screen-outline fs-6"></i>
                            </button>
                            <button type="button" class="btn btn-xs btn-link text-dark p-1" onclick="rotateImagePreview()" title="Putar 90°">
                                <i class="mdi mdi-rotate-right fs-6"></i>
                            </button>
                        </div>

                        {{-- Tombol Buka Tab Baru --}}
                        <a href="#" id="btnOpenNewTab" target="_blank" class="btn btn-sm btn-outline-secondary py-1 px-2 d-flex align-items-center gap-1" title="Buka di Tab Baru">
                            <i class="mdi mdi-open-in-new"></i> <span class="d-none d-md-inline" style="font-size: 0.78rem;">Tab Baru</span>
                        </a>

                        {{-- Tombol Unduh --}}
                        <a href="#" id="btnDownloadDoc" class="btn btn-sm btn-outline-primary py-1 px-2.5 d-flex align-items-center gap-1" download title="Download Dokumen">
                            <i class="mdi mdi-download"></i> <span class="d-none d-md-inline" style="font-size: 0.78rem;">Unduh</span>
                        </a>

                        <button type="button" class="btn-close ms-1" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>

                <div class="modal-body p-0 position-relative" style="background:#0f1117; min-height:65vh;">
                    {{-- Loading State --}}
                    <div id="previewLoading" class="flex-column align-items-center justify-content-center gap-3" style="min-height:65vh; background: #ffffff; display: flex;">
                        <div class="spinner-border text-primary" style="width:2.5rem;height:2.5rem;"></div>
                        <span class="text-muted small fw-semibold">Memuat dokumen, mohon tunggu...</span>
                    </div>

                    {{-- Error State --}}
                    <div id="previewError" class="flex-column align-items-center justify-content-center gap-3 text-center p-4" style="min-height:65vh; background: #ffffff; display: none;">
                        <i class="mdi mdi-file-alert-outline text-danger" style="font-size:4rem; opacity:.8;"></i>
                        <div>
                            <div class="fw-bold text-danger fs-5 mb-1">Dokumen Fisik Tidak Ditemukan di Server</div>
                            <small class="text-muted d-block" style="max-width: 480px;">
                                File mungkin belum terunggah ke penyimpanan server atau telah dipindahkan. Silakan unggah ulang file atau gunakan tombol unduh.
                            </small>
                        </div>
                        <div class="d-flex gap-2 mt-2">
                            <a href="#" id="btnErrorOpenTab" target="_blank" class="btn btn-sm btn-outline-primary">
                                <i class="mdi mdi-open-in-new me-1"></i> Buka Link Langsung
                            </a>
                            <a href="#" id="btnErrorDownload" class="btn btn-sm btn-primary" download>
                                <i class="mdi mdi-download me-1"></i> Coba Unduh File
                            </a>
                        </div>
                    </div>

                    {{-- PDF Viewer via iframe --}}
                    <iframe id="iframePreview" src="" style="width:100%; height:75vh; border:none; display:none; background:#ffffff;"></iframe>

                    {{-- Image Viewer Container with Scrollbars & Drag-Zoom --}}
                    <div id="divImagePreview" class="justify-content-center align-items-center" style="width: 100%; height: 75vh; overflow: auto; background: #181924; position: relative; padding: 20px; display: none;">
                        <div id="imgWrapper" style="display: inline-block; transform-origin: center center; transition: transform 0.12s ease-out; margin: auto;">
                            <img id="imgPreview" src="" alt="Preview Dokumen" style="max-width: 100%; max-height: 70vh; object-fit: contain; border-radius: 6px; box-shadow: 0 10px 35px rgba(0,0,0,0.6); display: block;" />
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-white border-top py-2 px-3 d-flex align-items-center justify-content-between">
                    <small class="text-muted" id="previewFooterInfo">
                        <i class="mdi mdi-information-outline me-1"></i>Gunakan toolbar di atas atau scroll mouse untuk memperbesar/memutar detail dokumen.
                    </small>
                    <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        // ===============================
        // MODAL PREVIEW DOKUMEN (ZOOM & PDF)
        // ===============================
        const PDF_EXTS = ['pdf'];
        const IMAGE_EXTS = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'svg', 'bmp'];
        let currentZoom = 1.0;
        let currentRotate = 0;

        function showPreviewSection(sectionId, displayStyle = 'flex') {
            const sections = ['previewLoading', 'previewError', 'iframePreview', 'divImagePreview'];
            sections.forEach(function(id) {
                const el = document.getElementById(id);
                if (el) {
                    if (id === sectionId) {
                        el.style.setProperty('display', displayStyle, 'important');
                        el.classList.remove('d-none');
                    } else {
                        el.style.setProperty('display', 'none', 'important');
                        el.classList.add('d-none');
                    }
                }
            });
        }

        function resetPreviewState() {
            currentZoom = 1.0;
            currentRotate = 0;
            applyImageTransform();

            showPreviewSection('previewLoading', 'flex');
            $('#imgZoomToolbar').removeClass('d-flex').hide();
            
            const img = document.getElementById('imgPreview');
            if (img) {
                img.onload = null;
                img.onerror = null;
                img.src = '';
            }
            const iframe = document.getElementById('iframePreview');
            if (iframe) {
                iframe.src = '';
            }
        }

        function applyImageTransform() {
            $('#imgWrapper').css('transform', `scale(${currentZoom}) rotate(${currentRotate}deg)`);
            $('#imgZoomLevelText').text(Math.round(currentZoom * 100) + '%');
        }

        window.changeImageZoom = function(delta) {
            currentZoom = Math.min(Math.max(0.25, currentZoom + delta), 4.0);
            applyImageTransform();
        };

        window.resetImageTransform = function() {
            currentZoom = 1.0;
            currentRotate = 0;
            applyImageTransform();
        };

        window.rotateImagePreview = function() {
            currentRotate = (currentRotate + 90) % 360;
            applyImageTransform();
        };

        function showPreviewError(url) {
            showPreviewSection('previewError', 'flex');
            $('#imgZoomToolbar').removeClass('d-flex').hide();
            $('#btnErrorDownload').attr('href', url);
            $('#btnErrorOpenTab').attr('href', url);
        }

        function previewPdf(url) {
            showPreviewSection('iframePreview', 'block');
            $('#imgZoomToolbar').removeClass('d-flex').hide();
            
            const iframe = document.getElementById('iframePreview');
            if (iframe) {
                iframe.src = url + '#toolbar=1&navpanes=1';
            }
            $('#previewFooterInfo').html(`<i class="mdi mdi-file-pdf-box me-1 text-danger"></i>Format Dokumen PDF — Gunakan toolbar pembaca PDF untuk navigasi.`);
        }

        function previewImage(url) {
            showPreviewSection('previewLoading', 'flex');
            $('#imgZoomToolbar').removeClass('d-flex').hide();

            const img = document.getElementById('imgPreview');
            if (!img) return;

            function onReady() {
                showPreviewSection('divImagePreview', 'flex');
                $('#imgZoomToolbar').addClass('d-flex').show();
                $('#previewFooterInfo').html(`<i class="mdi mdi-image-size-select-actual me-1 text-primary"></i>Resolusi: <strong>${img.naturalWidth} × ${img.naturalHeight} px</strong> — Scroll atau gunakan zoom toolbar.`);
            }

            img.onload = function() {
                onReady();
            };
            img.onerror = function() {
                showPreviewError(url);
            };

            img.src = url;

            if (img.complete && img.naturalWidth > 0) {
                onReady();
            }
        }

        $(document).on('click', '.btn-preview-doc', function(e) {
            e.preventDefault();
            const url = $(this).data('url');
            const ext = ($(this).data('ext') || '').toString().toLowerCase();
            const label = $(this).data('label') || 'Preview Dokumen';

            // Set info modal & action links
            $('#modalDocLabel').text(label);
            $('#modalDocExt').text(ext ? ext.toUpperCase() : 'FILE');
            $('#btnDownloadDoc').attr('href', url);
            $('#btnOpenNewTab').attr('href', url);
            $('#btnErrorDownload').attr('href', url);
            $('#btnErrorOpenTab').attr('href', url);

            // Icon sesuai tipe dokumen
            if (PDF_EXTS.includes(ext)) {
                $('#modalDocIcon').attr('class', 'mdi mdi-file-pdf-box text-danger fs-5');
            } else if (IMAGE_EXTS.includes(ext)) {
                $('#modalDocIcon').attr('class', 'mdi mdi-image text-primary fs-5');
            } else {
                $('#modalDocIcon').attr('class', 'mdi mdi-file-document-outline text-muted fs-5');
            }

            // Reset & Buka modal
            resetPreviewState();
            const modalEl = document.getElementById('modalPreviewDokumen');
            if (modalEl) {
                const modalObj = bootstrap.Modal.getOrCreateInstance(modalEl);
                modalObj.show();
            }

            if (PDF_EXTS.includes(ext)) {
                previewPdf(url);
            } else {
                previewImage(url);
            }
        });

        // Wheel Zoom Support on Image Container
        document.addEventListener('DOMContentLoaded', function() {
            const imgBox = document.getElementById('divImagePreview');
            if (imgBox) {
                imgBox.addEventListener('wheel', function(e) {
                    if (e.ctrlKey || e.altKey || $('#imgZoomToolbar').is(':visible')) {
                        e.preventDefault();
                        if (e.deltaY < 0) {
                            changeImageZoom(0.15);
                        } else {
                            changeImageZoom(-0.15);
                        }
                    }
                }, { passive: false });
            }

            const previewModalEl = document.getElementById('modalPreviewDokumen');
            if (previewModalEl) {
                previewModalEl.addEventListener('hidden.bs.modal', function() {
                    resetPreviewState();
                });
            }
        });
        // State variables
        let activeStep = 1;
        const isEditMode = {{ $land ? 'true' : 'false' }};
        const currentLandStatus = "{{ $land->status ?? 'fase1' }}";
        let isLegalSah = {{ $isLegalSah ? 'true' : 'false' }};

        // Read step query param if present
        const urlParams = new URLSearchParams(window.location.search);
        const queryStep = parseInt(urlParams.get('step'));

        // Determine step based on query parameter or fallback to land status
        if (isEditMode) {
            if (queryStep >= 1 && queryStep <= 3) {
                activeStep = (queryStep === 3 && !isLegalSah && currentLandStatus !== 'approved' && currentLandStatus !== 'rejected') ? 2 : queryStep;
            } else {
                if (currentLandStatus === 'fase2') {
                    activeStep = 2;
                } else if (currentLandStatus === 'fase3' || currentLandStatus === 'approved' || currentLandStatus === 'rejected') {
                    activeStep = (isLegalSah || currentLandStatus === 'approved' || currentLandStatus === 'rejected') ? 3 : 2;
                }
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Render correct step view upon loading
            switchStep(activeStep);

            // Initial toggle for installment view (do not regenerate rows to preserve Blade pre-render)
            toggleInstallmentView(true);



            // Handle customized file inputs
            document.querySelectorAll('.pratanah-file-upload-modern input[type="file"]').forEach(input => {
                input.addEventListener('change', function() {
                    const container = this.closest('.pratanah-file-upload-modern');
                    if (!container) return;
                    const label = container.querySelector('.pratanah-file-label-modern');
                    const fileName = container.querySelector('.pratanah-file-info-modern span');
                    const fileInfo = container.querySelector('.pratanah-file-info-modern small');
                    const icon = container.querySelector('i');

                    if (this.files && this.files.length > 0) {
                        const file = this.files[0];
                        const size = (file.size / 1024).toFixed(1) + ' KB';

                        if (fileName) fileName.textContent = file.name;
                        if (fileInfo) {
                            fileInfo.textContent = size;
                            fileInfo.className = 'pratanah-file-size';
                        }
                        if (icon) icon.className = 'mdi mdi-check-circle text-success';
                        if (label) {
                            label.style.borderColor = '#28c76f';
                            label.style.background = '#f0fdf4';
                        }
                    }
                });
            });
        });

        // ===============================
        // DYNAMIC STEP MANAGER
        // ===============================
        function switchStep(step) {
            // If in create mode and user tries to skip to step 2 or 3, reject
            if (!isEditMode && step > 1) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Langkah Terkunci',
                    text: 'Silakan isi dan simpan data Fase 1 terlebih dahulu.'
                });
                return;
            }

            if (step === 3 && !isLegalSah && currentLandStatus !== 'approved' && currentLandStatus !== 'rejected') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Status Legalitas Belum Sah!',
                    html: `
                        <p class="text-muted mb-2">Anda belum dapat melanjutkan ke <b>Fase 3 (Sidang & Keputusan Akhir)</b>.</p>
                        <div class="alert alert-warning border text-start py-2 px-3 mb-0" style="font-size: 0.85rem; background: #fffbeb; border-color: #fde68a !important;">
                            <i class="mdi mdi-shield-alert text-warning me-1"></i>
                            <b>Syarat Mutlak:</b> Seluruh dokumen kelayakan legalitas tanah di <b>Fase 2</b> wajib berstatus <b>Terverifikasi (Sah) oleh Kepala Legal</b> terlebih dahulu.
                        </div>
                    `,
                    confirmButtonColor: '#9a55ff',
                    confirmButtonText: '<i class="mdi mdi-arrow-left me-1"></i> Periksa Dokumen Fase 2'
                });
                return;
            }


            activeStep = step;

            // Manage CSS display containers
            document.getElementById('containerFase1').classList.add('d-none');
            document.getElementById('containerFase2').classList.add('d-none');
            document.getElementById('containerFase3').classList.add('d-none');

            // Reset active & completed classes and text
            document.getElementById('step1').classList.remove('active', 'completed');
            document.getElementById('step2').classList.remove('active', 'completed');
            document.getElementById('step3').classList.remove('active', 'completed');

            document.querySelector('#step1 .step-circle').innerHTML = '1';
            document.querySelector('#step2 .step-circle').innerHTML = '2';
            document.querySelector('#step3 .step-circle').innerHTML = '3';

            // Show active container
            document.getElementById(`containerFase${step}`).classList.remove('d-none');
            document.getElementById(`step${step}`).classList.add('active');

            // Apply completed status & checkmarks
            if (isEditMode) {
                document.getElementById('step1').classList.add('completed');
                document.querySelector('#step1 .step-circle').innerHTML = '<i class="mdi mdi-check"></i>';
            }

            if (isEditMode && currentLandStatus !== 'fase1') {
                document.getElementById('step2').classList.add('completed');
                document.querySelector('#step2 .step-circle').innerHTML = '<i class="mdi mdi-check"></i>';
            }

            if (isEditMode && (currentLandStatus === 'approved' || currentLandStatus === 'rejected')) {
                document.getElementById('step3').classList.add('completed');
                document.querySelector('#step3 .step-circle').innerHTML = '<i class="mdi mdi-check"></i>';
            }

            // Manage Progress Bar Width
            if (step === 1) {
                document.getElementById('wizardProgressBar').style.width = '0%';
                setTimeout(() => initSelect2Search(), 100);
            } else if (step === 2) {
                document.getElementById('wizardProgressBar').style.width = '50%';
                setTimeout(() => {
                    initMapFase2();
                    initSelect2Search();
                }, 300);
            } else if (step === 3) {
                document.getElementById('wizardProgressBar').style.width = '100%';
                setTimeout(() => initSelect2Search(), 100);
            }
        }

        // ===============================
        // SELECT2 SEARCH INITIALIZER
        // ===============================
        function initSelect2Search() {
            if (typeof $ !== 'undefined' && typeof $.fn.select2 !== 'undefined') {
                $('.select2-search').each(function() {
                    if (!$(this).hasClass("select2-hidden-accessible")) {
                        $(this).select2({
                            theme: 'bootstrap-5',
                            placeholder: $(this).data('placeholder') || 'Pilih...',
                            allowClear: true,
                            width: '100%'
                        });
                    }
                });
            }
        }

        // ===============================
        // FORMAT RUPIAH
        // ===============================
        function formatRupiah(input) {
            let value = input.value.replace(/[^,\d]/g, '');
            let split = value.split(',');
            let sisa = split[0].length % 3;
            let rupiah = split[0].substr(0, sisa);
            let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            input.value = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        }

        // ===============================
        // HELPER FETCH API
        // ===============================
        async function fetchJSON(url, formData) {
            const res = await fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
            });

            const text = await res.text();

            try {
                return JSON.parse(text);
            } catch {
                console.error("Non-JSON Response received:", text);
                throw new Error("Sistem Server Mengalami Gangguan.");
            }
        }

        // ===============================
        // NOTIFICATIONS
        // ===============================
        function showError(msg) {
            Swal.fire({
                icon: 'error',
                title: 'Transaksi Gagal',
                text: msg
            });
        }

        function showLoading(msg = 'Menyimpan progres...') {
            Swal.fire({
                title: msg,
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });
        }

        // ===============================
        // AJAX SAVE FLOWS
        // ===============================
        async function saveFase1() {
            try {
                showLoading('Menyimpan Fase 1...');
                let form = document.getElementById('formFase1');
                let formData = new FormData(form);

                let res = await fetchJSON("{{ route('pra-landbanks.store') }}", formData);
                Swal.close();

                if (res.success) {
                    sessionStorage.setItem('success_message', 'Data Fase 1 berhasil disimpan.');
                    window.location.href = "{{ route('pralandbank.all') }}";
                } else {
                    showError(res.message);
                }
            } catch (err) {
                Swal.close();
                showError(err.message);
            }
        }

        async function saveFase2() {
            try {
                showLoading('Menyimpan data Fase 2 & Dokumen Kelayakan...');
                let form = document.getElementById('formFase2');
                let formData = new FormData(form);

                let res = await fetchJSON("{{ route('pra-landbanks.store') }}", formData);
                Swal.close();

                if (res.success) {
                    sessionStorage.setItem('success_message', 'Data Fase 2 & Dokumen Kelayakan berhasil disimpan.');
                    window.location.href = "{{ route('pralandbank.all') }}";
                } else {
                    showError(res.message);
                }
            } catch (err) {
                Swal.close();
                showError(err.message);
            }
        }

        async function saveFase3() {
            try {
                showLoading('Menyimpan keputusan & progres pembayaran...');
                let form = document.getElementById('formFase3');

                // Temporarily un-disable inputs to ensure FormData captures all amounts, fees, and installment rows
                let disabledInputs = form.querySelectorAll(':disabled');
                disabledInputs.forEach(el => el.disabled = false);
                let formData = new FormData(form);
                disabledInputs.forEach(el => el.disabled = true);

                // Explicitly check key fields
                const selectPayMethod = document.getElementById('temp_payment_method');
                if (selectPayMethod && !formData.has('payment_method_temp')) {
                    formData.append('payment_method_temp', selectPayMethod.value);
                }
                const selectDuration = document.getElementById('temp_installment_duration');
                if (selectDuration && !formData.has('installment_duration_temp')) {
                    formData.append('installment_duration_temp', selectDuration.value);
                }
                const selectCount = document.getElementById('temp_installment_count');
                if (selectCount && !formData.has('installment_count_temp')) {
                    formData.append('installment_count_temp', selectCount.value);
                }
                const selectStatusAkhir = document.getElementById('fase3_status_akhir');
                if (selectStatusAkhir && !formData.has('status')) {
                    formData.append('status', selectStatusAkhir.value);
                }
                const dealPriceInput = document.getElementById('deal_price_input');
                if (dealPriceInput && !formData.has('deal_price')) {
                    formData.append('deal_price', dealPriceInput.value);
                }

                let res = await fetchJSON("{{ route('pra-landbanks.store') }}", formData);
                Swal.close();

                if (res.success) {
                    let textMsg = res.message || 'Data keputusan sidang berhasil disimpan!';
                    if (res.status === 'approved') {
                        textMsg = 'Tanah berhasil disetujui (Deal) dan telah di-upgrade ke Daftar Proyek Landbank utama!';
                    }
                    
                    const invoiceUrl = res.invoice_url || "{{ $land ? route('pra-landbank.invoice', $land->id) : '' }}";

                    Swal.fire({
                        icon: 'success',
                        title: 'Keputusan Fase 3 Disimpan!',
                        html: `
                            <p class="mb-3 text-muted" style="font-size: 0.9rem;">${textMsg}</p>
                            <div class="alert alert-light border py-2 px-3 mb-0 text-start" style="font-size: 0.85rem; background: #fafbfe;">
                                <i class="mdi mdi-receipt-text-check text-success me-1"></i>
                                Invoice transaksi telah otomatis digenerate oleh sistem.
                            </div>
                        `,
                        showCancelButton: true,
                        confirmButtonText: '<i class="mdi mdi-printer me-1"></i> Cetak / Lihat Invoice',
                        cancelButtonText: '<i class="mdi mdi-check-all me-1"></i> Selesai & Kembali',
                        confirmButtonColor: '#9a55ff',
                        cancelButtonColor: '#6c757d',
                        allowOutsideClick: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            if (invoiceUrl) {
                                window.open(invoiceUrl, '_blank');
                            }
                            window.location.href = "{{ route('pralandbank.all') }}";
                        } else {
                            window.location.href = "{{ route('pralandbank.all') }}";
                        }
                    });
                } else {
                    showError(res.message);
                }
            } catch (err) {
                Swal.close();
                showError(err.message);
            }
        }

        async function previewInvoice() {
            const isReadOnly = {{ ($land && ($land->status == 'approved' || $land->status == 'rejected')) ? 'true' : 'false' }};
            const defaultInvoiceUrl = "{{ $land ? route('pra-landbank.invoice', $land->id) : '' }}";

            if (isReadOnly) {
                if (defaultInvoiceUrl) window.open(defaultInvoiceUrl, '_blank');
                return;
            }

            try {
                showLoading('Menyiapkan dan menyinkronkan data invoice...');
                let form = document.getElementById('formFase3');
                let formData = new FormData(form);
                formData.append('is_preview', '1');

                let res = await fetchJSON("{{ route('pra-landbanks.store') }}", formData);
                Swal.close();

                if (res.success) {
                    const invoiceUrl = res.invoice_url || defaultInvoiceUrl;
                    if (invoiceUrl) {
                        window.open(invoiceUrl, '_blank');
                    }
                } else {
                    showError(res.message);
                }
            } catch (err) {
                Swal.close();
                if (defaultInvoiceUrl) {
                    window.open(defaultInvoiceUrl, '_blank');
                } else {
                    showError(err.message);
                }
            }
        }

        // ===============================
        // LEAFLET MAP & GPS
        // ===============================
        let mapFase2, markerFase2;

        function initMapFase2() {
            let lat = parseFloat(document.getElementById('fase2_lat')?.value) || -8.1727;
            let lng = parseFloat(document.getElementById('fase2_lng')?.value) || 113.7000;

            const isReadOnly = {{ ($land && ($land->status == 'approved' || $land->status == 'rejected')) ? 'true' : 'false' }};

            if (!mapFase2) {
                // Google Maps Tile Layers
                const googleRoadmap = L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                    maxZoom: 20,
                    subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
                    attribution: '&copy; Google Maps'
                });

                const googleHybrid = L.tileLayer('https://{s}.google.com/vt/lyrs=y&x={x}&y={y}&z={z}', {
                    maxZoom: 20,
                    subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
                    attribution: '&copy; Google Maps Satellite'
                });

                const googleTerrain = L.tileLayer('https://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}', {
                    maxZoom: 20,
                    subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
                    attribution: '&copy; Google Maps Terrain'
                });

                mapFase2 = L.map('map-fase2', {
                    center: [lat, lng],
                    zoom: 15,
                    layers: [googleRoadmap]
                });

                // Layer Switcher (Roadmap, Satellite, Terrain)
                const baseMaps = {
                    "Google Roadmap": googleRoadmap,
                    "Google Satellite": googleHybrid,
                    "Google Terrain": googleTerrain
                };
                L.control.layers(baseMaps, null, { position: 'topright' }).addTo(mapFase2);

                markerFase2 = L.marker([lat, lng], {
                    draggable: !isReadOnly
                }).addTo(mapFase2);

                if (!isReadOnly) {
                    markerFase2.on('dragend', function() {
                        let pos = markerFase2.getLatLng();
                        document.getElementById('fase2_lat').value = pos.lat.toFixed(6);
                        document.getElementById('fase2_lng').value = pos.lng.toFixed(6);
                    });

                    mapFase2.on('click', function(e) {
                        markerFase2.setLatLng(e.latlng);
                        document.getElementById('fase2_lat').value = e.latlng.lat.toFixed(6);
                        document.getElementById('fase2_lng').value = e.latlng.lng.toFixed(6);
                    });
                }
            } else {
                mapFase2.setView([lat, lng]);
                markerFase2.setLatLng([lat, lng]);
                mapFase2.invalidateSize();
            }
        }

        function toggleCashChannelFields() {
            const type = document.getElementById('cash_payment_type')?.value || 'transfer';
            const bankDetails = document.getElementById('cash_bank_details_container');
            if (bankDetails) {
                if (type === 'transfer') {
                    bankDetails.style.display = 'flex';
                } else {
                    bankDetails.style.display = 'none';
                }
            }
        }

        function handleTerminTypeChange(select) {
            const bankBox = select.closest('td').querySelector('.termin-bank-box');
            if (bankBox) {
                if (select.value === 'cash') {
                    bankBox.style.display = 'none';
                    const input = bankBox.querySelector('input');
                    if (input) input.value = '';
                } else {
                    bankBox.style.display = 'block';
                }
            }
        }

        function toggleInstallmentView(isInitial = false) {
            const method = document.getElementById('temp_payment_method') ? document.getElementById('temp_payment_method').value : 'cash';
            const cashContainer = document.getElementById('cash_payment_container');
            const durationContainer = document.getElementById('temp_duration_container');
            const countContainer = document.getElementById('temp_count_container');
            const widgetContainer = document.getElementById('installment_widget_container');
            const dpContainer = document.getElementById('dp_container');
            const remainingContainer = document.getElementById('remaining_container');

            if (method === 'termin') {
                if (cashContainer) cashContainer.style.display = 'none';
                if (durationContainer) durationContainer.style.display = 'block';
                if (countContainer) countContainer.style.display = 'block';
                if (widgetContainer) widgetContainer.style.display = 'block';
                if (dpContainer) dpContainer.style.display = 'block';
                if (remainingContainer) remainingContainer.style.display = 'block';
                if (!isInitial) {
                    generateInstallmentRows();
                } else {
                    calculateInstallments();
                }
            } else {
                if (cashContainer) cashContainer.style.display = 'block';
                if (durationContainer) durationContainer.style.display = 'none';
                if (countContainer) countContainer.style.display = 'none';
                if (widgetContainer) widgetContainer.style.display = 'none';
                if (dpContainer) dpContainer.style.display = 'none';
                if (remainingContainer) remainingContainer.style.display = 'none';
                toggleCashChannelFields();

                // Auto-fill cash amount with grand total if empty
                const dealInput = document.getElementById('deal_price_input');
                const cashAmountInput = document.getElementById('cash_amount_input');
                if (cashAmountInput && dealInput && (!cashAmountInput.value || cashAmountInput.value === 'Rp 0')) {
                    cashAmountInput.value = dealInput.value;
                }
            }
            updateFinancialSummary();
        }

        function calculateInstallments() {
            const method = document.getElementById('temp_payment_method') ? document.getElementById('temp_payment_method').value : 'cash';
            const dpContainer = document.getElementById('dp_container');
            const remainingContainer = document.getElementById('remaining_container');
            
            if (method !== 'termin') {
                if (dpContainer) dpContainer.style.display = 'none';
                if (remainingContainer) remainingContainer.style.display = 'none';
                updateFinancialSummary();
                return;
            }
            
            if (dpContainer) dpContainer.style.display = 'block';
            if (remainingContainer) remainingContainer.style.display = 'block';
            const cleanNum = (str) => parseInt((str || '').replace(/[^0-9]/g, '')) || 0;
            const formatRp = (num) => 'Rp ' + (num || 0).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            
            const dealPrice = cleanNum(document.getElementById('deal_price_input')?.value || 0);
            
            // Calculate total additional costs
            const costInputs = document.querySelectorAll('.cost-input, .custom-cost-amount');
            let totalAdditionalCosts = 0;
            costInputs.forEach(input => {
                totalAdditionalCosts += cleanNum(input.value);
            });
            const grandTotal = dealPrice + totalAdditionalCosts;

            const dpPriceInput = document.getElementById('dp_price_input');
            let dpPrice = cleanNum(dpPriceInput?.value || 0);

            // Default DP to 20% of deal price if empty
            if (dpPriceInput && !dpPriceInput.value && dealPrice > 0) {
                dpPrice = Math.round(dealPrice * 0.20);
                dpPriceInput.value = formatRp(dpPrice);
            }
            
            let remaining = dealPrice - dpPrice;
            if (remaining < 0) remaining = 0;
            
            const remainingInput = document.getElementById('remaining_price_input');
            if (remainingInput) remainingInput.value = formatRp(remaining);
            
            const count = parseInt(document.getElementById('temp_installment_count')?.value) || 4;
            const tbody = document.getElementById('installment_tbody');
            const rows = tbody ? tbody.querySelectorAll('tr') : [];
            
            if (rows.length === count) {
                let remainingInstallments = count - 1;
                let installmentAmount = remainingInstallments > 0 ? Math.round(remaining / remainingInstallments) : 0;
                
                rows.forEach((row, index) => {
                    const amountInput = row.querySelector('input[name$="[amount_temp]"]');
                    if (amountInput) {
                        if (index === 0) {
                            amountInput.value = formatRp(dpPrice);
                        } else {
                            if (index === count - 1) {
                                let totalCalculated = dpPrice + (installmentAmount * (remainingInstallments - 1));
                                let finalInstallment = dealPrice - totalCalculated;
                                if (finalInstallment < 0) finalInstallment = 0;
                                amountInput.value = formatRp(finalInstallment);
                            } else {
                                amountInput.value = formatRp(installmentAmount);
                            }
                        }
                    }
                });
            }
            updateInstallmentBalance();
            updateFinancialSummary();
        }

        function generateInstallmentRows() {
            const count = parseInt(document.getElementById('temp_installment_count')?.value) || 4;
            const duration = document.getElementById('temp_installment_duration')?.value || '1_tahun';
            const tbody = document.getElementById('installment_tbody');
            if (!tbody) return;

            tbody.innerHTML = '';
            
            let durationMonths = 12;
            if (duration === '3_bulan') durationMonths = 3;
            else if (duration === '6_bulan') durationMonths = 6;
            else if (duration === '9_bulan') durationMonths = 9;
            
            let baseDate = new Date();

            for (let i = 1; i <= count; i++) {
                let terminName = i === 1 ? 'DP (Tahap 1)' : `Tahap ${i}`;
                
                let dateVal = new Date(baseDate);
                if (i > 1 && count > 1) {
                    let monthsToAdd = Math.round((durationMonths / (count - 1)) * (i - 1));
                    dateVal.setMonth(dateVal.getMonth() + monthsToAdd);
                }

                let yyyy = dateVal.getFullYear();
                let mm = String(dateVal.getMonth() + 1).padStart(2, '0');
                let dd = String(dateVal.getDate()).padStart(2, '0');
                let dateStr = `${yyyy}-${mm}-${dd}`;

                const row = document.createElement('tr');
                row.id = `installment_row_${i}`;
                row.innerHTML = `
                    <td>
                        <input type="text" name="installments[${i}][term_name]" value="${terminName}" class="form-control form-control-sm text-center fw-bold text-primary" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                    </td>
                    <td>
                        <select name="installments[${i}][payment_type]" class="form-select form-select-sm mb-1 py-0" style="font-size: 11px;" onchange="handleTerminTypeChange(this)" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                            <option value="transfer">Transfer Bank</option>
                            <option value="cash">Tunai / Cash</option>
                        </select>
                        <div class="termin-bank-box">
                            <input type="text" name="installments[${i}][account_number]" class="form-control form-control-sm py-0" style="font-size: 11px;" placeholder="Bank & No. Rekening" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                        </div>
                    </td>
                    <td>
                        <input type="text" name="installments[${i}][amount_temp]" class="form-control form-control-sm termin-amount-input fw-semibold" placeholder="Rp 0" onkeyup="formatRupiahTemp(this); updateInstallmentBalance();" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                    </td>
                    <td>
                        <input type="date" name="installments[${i}][due_date]" value="${dateStr}" class="form-control form-control-sm" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                    </td>
                    <td>
                        <div class="pratanah-file-upload-modern py-1 px-2 d-flex align-items-center justify-content-between" style="border-width: 1px; border-style: dashed; border-radius: 6px; background: rgba(0,0,0,0.01);">
                            <input type="file" name="installments[${i}][file]" id="file_tahap_${i}" class="d-none" onchange="handleTerminFileName(this)" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                            <label for="file_tahap_${i}" class="mb-0 d-flex align-items-center gap-2 cursor-pointer w-100" style="font-size: 11px;">
                                <i class="mdi mdi-file-upload text-muted fs-5"></i>
                                <span class="text-truncate text-muted file-label-text" style="max-width: 120px;">Pilih Bukti</span>
                            </label>
                        </div>
                    </td>
                    <td>
                        <select name="installments[${i}][status]" class="form-select form-select-sm termin-status-select" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                            <option value="belum">Belum</option>
                            <option value="lunas">Lunas</option>
                        </select>
                    </td>
                    <td class="text-center">
                        @if (!$land || ($land && $land->status != 'approved' && $land->status != 'rejected'))
                            <button type="button" class="btn btn-xs btn-danger text-white py-1 px-2 shadow-sm" onclick="removeInstallmentRow(this)" title="Hapus Tahap" style="background-color: #ef4444; border: 1px solid #ef4444; border-radius: 4px;">
                                <i class="mdi mdi-delete text-white"></i>
                            </button>
                        @endif
                    </td>
                `;
                tbody.appendChild(row);
            }
            
            // Instantly trigger calculations
            calculateInstallments();
        }

        function addCustomInstallmentRow() {
            const tbody = document.getElementById('installment_tbody');
            if (!tbody) return;

            const existingRows = tbody.querySelectorAll('tr').length;
            const newIndex = existingRows + 1;
            const today = new Date();
            const dateStr = `${today.getFullYear()}-${String(today.getMonth() + 1).padStart(2, '0')}-${String(today.getDate()).padStart(2, '0')}`;

            const row = document.createElement('tr');
            row.id = `installment_row_${newIndex}`;
            row.style.animation = 'fadeIn 0.3s ease';
            row.innerHTML = `
                <td>
                    <input type="text" name="installments[${newIndex}][term_name]" value="Tahap ${newIndex}" class="form-control form-control-sm text-center fw-bold text-primary">
                </td>
                <td>
                    <select name="installments[${newIndex}][payment_type]" class="form-select form-select-sm mb-1 py-0" style="font-size: 11px;" onchange="handleTerminTypeChange(this)">
                        <option value="transfer">Transfer Bank</option>
                        <option value="cash">Tunai / Cash</option>
                    </select>
                    <div class="termin-bank-box">
                        <input type="text" name="installments[${newIndex}][account_number]" class="form-control form-control-sm py-0" style="font-size: 11px;" placeholder="Bank & No. Rekening">
                    </div>
                </td>
                <td>
                    <input type="text" name="installments[${newIndex}][amount_temp]" class="form-control form-control-sm termin-amount-input fw-semibold" placeholder="Rp 0" onkeyup="formatRupiahTemp(this); updateInstallmentBalance();">
                </td>
                <td>
                    <input type="date" name="installments[${newIndex}][due_date]" value="${dateStr}" class="form-control form-control-sm">
                </td>
                <td>
                    <div class="pratanah-file-upload-modern py-1 px-2 d-flex align-items-center justify-content-between" style="border-width: 1px; border-style: dashed; border-radius: 6px; background: rgba(0,0,0,0.01);">
                        <input type="file" name="installments[${newIndex}][file]" id="file_tahap_${newIndex}" class="d-none" onchange="handleTerminFileName(this)">
                        <label for="file_tahap_${newIndex}" class="mb-0 d-flex align-items-center gap-2 cursor-pointer w-100" style="font-size: 11px;">
                            <i class="mdi mdi-file-upload text-muted fs-5"></i>
                            <span class="text-truncate text-muted file-label-text" style="max-width: 120px;">Pilih Bukti</span>
                        </label>
                    </div>
                </td>
                <td>
                    <select name="installments[${newIndex}][status]" class="form-select form-select-sm termin-status-select">
                        <option value="belum">Belum</option>
                        <option value="lunas">Lunas</option>
                    </select>
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-xs btn-danger text-white py-1 px-2 shadow-sm" onclick="removeInstallmentRow(this)" title="Hapus Tahap" style="background-color: #ef4444; border: 1px solid #ef4444; border-radius: 4px;">
                        <i class="mdi mdi-delete text-white"></i>
                    </button>
                </td>
            `;
            tbody.appendChild(row);
            updateInstallmentBalance();
        }

        function removeInstallmentRow(btn) {
            const row = btn.closest('tr');
            if (row) {
                row.remove();
                updateInstallmentBalance();
            }
        }

        function updateInstallmentBalance() {
            const cleanNum = (str) => parseInt((str || '').replace(/[^0-9]/g, '')) || 0;
            const formatRp = (num) => 'Rp ' + (num || 0).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");

            const dealPrice = cleanNum(document.getElementById('deal_price_input')?.value || 0);
            const costInputs = document.querySelectorAll('.cost-input, .custom-cost-amount');
            let totalAdditionalCosts = 0;
            costInputs.forEach(input => {
                totalAdditionalCosts += cleanNum(input.value);
            });
            const grandTotal = dealPrice + totalAdditionalCosts;

            const amountInputs = document.querySelectorAll('.termin-amount-input');
            let totalScheduled = 0;

            amountInputs.forEach(input => {
                totalScheduled += cleanNum(input.value);
            });

            const scheduledEl = document.getElementById('termin_total_scheduled');
            const targetEl = document.getElementById('termin_target_deal');
            const statusEl = document.getElementById('termin_balance_status');

            if (scheduledEl) scheduledEl.innerText = formatRp(totalScheduled);
            if (targetEl) targetEl.innerText = formatRp(dealPrice);

            if (statusEl) {
                const diff = dealPrice - totalScheduled;
                if (diff === 0 && dealPrice > 0) {
                    statusEl.innerHTML = `<span class="badge bg-success py-1 px-2"><i class="mdi mdi-check-circle me-1"></i>Balance / Sesuai Target</span>`;
                } else if (diff > 0) {
                    statusEl.innerHTML = `<span class="badge bg-warning text-dark py-1 px-2"><i class="mdi mdi-alert-circle me-1"></i>Kurang: ${formatRp(diff)}</span>`;
                } else if (diff < 0) {
                    statusEl.innerHTML = `<span class="badge bg-danger py-1 px-2"><i class="mdi mdi-alert-circle me-1"></i>Lebih: ${formatRp(Math.abs(diff))}</span>`;
                } else {
                    statusEl.innerHTML = `<span class="badge bg-secondary py-1 px-2">Belum Ditentukan</span>`;
                }
            }
        }

        function handleTerminFileName(input) {
            const labelSpan = input.closest('.pratanah-file-upload-modern').querySelector('.file-label-text');
            if (input.files && input.files[0]) {
                labelSpan.textContent = input.files[0].name;
                labelSpan.classList.remove('text-muted');
                labelSpan.classList.add('text-success', 'fw-bold');
            } else {
                labelSpan.textContent = "Pilih Bukti";
                labelSpan.classList.remove('text-success', 'fw-bold');
                labelSpan.classList.add('text-muted');
            }
        }

        function handleSingleFileUpload(input) {
            const labelSpan = input.closest('.pratanah-file-upload-modern')?.querySelector('.file-label-text');
            if (labelSpan && input.files && input.files[0]) {
                labelSpan.textContent = input.files[0].name;
                labelSpan.classList.add('text-primary', 'fw-bold');
            }
        }

        function toggleDocUploadBox(docId) {
            const uploadBox = document.getElementById('upload_box_doc_' + docId);
            const previewBox = document.getElementById('preview_box_doc_' + docId);
            if (uploadBox && previewBox) {
                if (uploadBox.classList.contains('d-none')) {
                    uploadBox.classList.remove('d-none');
                    previewBox.classList.add('d-none');
                } else {
                    uploadBox.classList.add('d-none');
                    previewBox.classList.remove('d-none');
                }
            }
        }

        function handleDynamicDocUpload(input) {
            const cardItem = input.closest('.doc-fase3-item');
            const labelSpan = input.closest('.pratanah-file-upload-modern')?.querySelector('.file-label-text');
            
            if (input.files && input.files[0]) {
                if (labelSpan) {
                    labelSpan.textContent = input.files[0].name;
                    labelSpan.classList.add('text-primary', 'fw-bold');
                }
                if (cardItem) {
                    cardItem.setAttribute('data-has-file', 'true');
                    const badge = cardItem.querySelector('.doc-status-badge');
                    if (badge) {
                        badge.className = 'badge bg-success py-1 px-2 doc-status-badge';
                        badge.innerHTML = '<i class="mdi mdi-check-circle me-1"></i>Tersedia';
                    }
                }
            } else {
                if (cardItem && cardItem.getAttribute('data-has-file') !== 'true') {
                    cardItem.setAttribute('data-has-file', 'false');
                    const badge = cardItem.querySelector('.doc-status-badge');
                    if (badge) {
                        badge.className = 'badge bg-light text-muted border py-1 px-2 doc-status-badge';
                        badge.innerText = 'Belum Upload';
                    }
                }
            }
            recalculateFase3DocProgress();
        }

        function recalculateFase3DocProgress() {
            const items = document.querySelectorAll('.doc-fase3-item');
            if (!items.length) return;

            let total = items.length;
            let uploaded = 0;

            items.forEach(item => {
                if (item.getAttribute('data-has-file') === 'true') {
                    uploaded++;
                }
            });

            let unuploaded = total - uploaded;
            let percent = Math.round((uploaded / total) * 100);

            const progressBar = document.getElementById('fase3_doc_progress_bar');
            const badge = document.getElementById('fase3_doc_progress_badge');
            const countUploaded = document.getElementById('fase3_count_uploaded');
            const countUnuploaded = document.getElementById('fase3_count_unuploaded');

            if (progressBar) progressBar.style.width = percent + '%';
            if (badge) badge.innerText = `${uploaded} dari ${total} Berkas (${percent}%)`;
            if (countUploaded) countUploaded.innerText = uploaded;
            if (countUnuploaded) countUnuploaded.innerText = unuploaded;
        }

        function formatRupiahTemp(input) {
            let value = input.value.replace(/[^,\d]/g, '');
            let split = value.split(',');
            let sisa = split[0].length % 3;
            let rupiah = split[0].substr(0, sisa);
            let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            input.value = rupiah;
        }

        function getCurrentLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(pos => {
                    let lat = pos.coords.latitude;
                    let lng = pos.coords.longitude;

                    document.getElementById('fase2_lat').value = lat.toFixed(6);
                    document.getElementById('fase2_lng').value = lng.toFixed(6);

                    if (mapFase2) {
                        mapFase2.setView([lat, lng], 15);
                        markerFase2.setLatLng([lat, lng]);
                    }

                    Swal.fire({
                        icon: 'success',
                        title: 'Lokasi Ditemukan',
                        text: 'Koordinat GPS Anda berhasil diambil',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }, () => {
                    showError('Gagal mendeteksi lokasi GPS. Pastikan izin lokasi aktif.');
                });
            } else {
                showError('Browser Anda tidak mendukung layanan Geolocation.');
            }
        }

        function addCustomCostRow() {
            const container = document.getElementById('custom_costs_container');
            if (!container) return;

            const rowId = 'custom_cost_' + Date.now();
            const rowHtml = `
                <div class="col-md-6 custom-cost-row mb-2" id="${rowId}" style="animation: fadeIn 0.3s ease;">
                    <div class="d-flex align-items-center gap-2">
                        <input type="text" name="custom_costs[${rowId}][name]" class="form-control custom-cost-name" placeholder="Nama Biaya (Contoh: Retribusi / Pengeringan)" onkeyup="updateFinancialSummary()">
                        <input type="text" name="custom_costs[${rowId}][amount]" class="form-control custom-cost-amount fw-bold" placeholder="Rp 0" onkeyup="formatRupiahTemp(this); updateFinancialSummary();">
                        <button type="button" class="btn btn-danger text-white px-2 py-1 flex-shrink-0 shadow-sm" onclick="document.getElementById('${rowId}').remove(); updateFinancialSummary();" title="Hapus Biaya" style="height: 38px; width: 38px; display: flex; align-items: center; justify-content: center; border-radius: 6px; background-color: #ef4444; border: 1px solid #ef4444;">
                            <i class="mdi mdi-delete text-white" style="font-size: 1.15rem;"></i>
                        </button>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', rowHtml);
        }

        function updateFinancialSummary() {
            const cleanNum = (str) => parseInt((str || '').replace(/[^0-9]/g, '')) || 0;
            const formatRp = (num) => 'Rp ' + (num || 0).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            
            const dealPrice = cleanNum(document.getElementById('deal_price_input')?.value || 0);
            const method = document.getElementById('temp_payment_method')?.value || 'cash';
            const methodBadge = document.getElementById('calc_method_badge');
            if (methodBadge) {
                methodBadge.textContent = method === 'termin' ? 'Pembayaran Bertahap (Termin)' : 'Cash Keras (Lunas Sekaligus)';
            }

            // Collect all standard and custom cost items
            const costInputs = document.querySelectorAll('.cost-input, .custom-cost-amount');
            let costRowsHtml = '';
            let totalAdditionalCosts = 0;

            costInputs.forEach(input => {
                const val = cleanNum(input.value);
                let name = input.getAttribute('data-cost-name');
                if (!name) {
                    const nameInput = input.closest('.custom-cost-row')?.querySelector('.custom-cost-name');
                    name = nameInput?.value.trim() || 'Biaya Tambahan Lainnya';
                }
                if (val > 0) {
                    totalAdditionalCosts += val;
                    costRowsHtml += `
                        <tr>
                            <td class="ps-3"><i class="mdi mdi-circle-small text-primary me-1"></i>${name}</td>
                            <td class="text-end fw-semibold text-dark">${formatRp(val)}</td>
                        </tr>
                    `;
                }
            });

            const grandTotal = dealPrice + totalAdditionalCosts;
            const grandTotalDisplay = document.getElementById('grand_total_final_display');
            if (grandTotalDisplay) {
                grandTotalDisplay.value = formatRp(grandTotal);
            }

            const tbody = document.getElementById('calc_summary_tbody');
            if (!tbody) return;

            let html = `
                <tr style="background: #fafbfe;">
                    <td><strong class="text-dark"><i class="mdi mdi-home-city text-primary me-1"></i>Harga Deal Pokok Tanah</strong></td>
                    <td class="text-end fw-bold text-dark" style="font-size: 0.95rem;">${formatRp(dealPrice)}</td>
                </tr>
            `;

            if (costRowsHtml) {
                html += `
                    <tr class="table-light">
                        <td colspan="2" class="fw-bold text-muted py-1" style="font-size: 0.78rem; text-transform: uppercase; letter-spacing: 0.5px;">
                            Biaya Transaksi, Pajak & Administrasi
                        </td>
                    </tr>
                    ${costRowsHtml}
                `;
            }

            html += `
                <tr style="background: rgba(154, 85, 255, 0.08); border-top: 2px solid #9a55ff;">
                    <td><strong class="text-purple" style="color: #7e22ce; font-size: 0.92rem;"><i class="mdi mdi-sigma me-1"></i>TOTAL KESELURUHAN BIAYA (Grand Total)</strong></td>
                    <td class="text-end fw-bold text-purple" style="color: #7e22ce; font-size: 1rem;">${formatRp(grandTotal)}</td>
                </tr>
            `;

            if (method === 'cash') {
                const cashAmountInput = document.getElementById('cash_amount_input');
                if (cashAmountInput) {
                    cashAmountInput.value = formatRp(grandTotal);
                }

                html += `
                    <tr style="background: rgba(40, 167, 69, 0.1);">
                        <td>
                            <div class="d-flex align-items-center justify-content-between">
                                <strong class="text-success"><i class="mdi mdi-check-decagram me-1"></i>Skema: Cash Keras (Pelunasan 100% Sekaligus)</strong>
                                <span class="badge bg-success">Lunas Langsung</span>
                            </div>
                        </td>
                        <td class="text-end fw-bold text-success" style="font-size: 0.95rem;">${formatRp(grandTotal)}</td>
                    </tr>
                `;
            } else {
                const dpPriceInput = document.getElementById('dp_price_input');
                const dpPrice = cleanNum(dpPriceInput?.value || 0);
                const sisaPokok = dealPrice > dpPrice ? (dealPrice - dpPrice) : 0;

                // Count scheduled installments
                const terminInputs = document.querySelectorAll('.termin-amount-input');
                let totalScheduled = 0;
                let terminDetailsHtml = '';

                terminInputs.forEach((tInput, idx) => {
                    const tVal = cleanNum(tInput.value);
                    const row = tInput.closest('tr');
                    const termNameInput = row?.querySelector('input[name$="[term_name]"]');
                    const tName = termNameInput?.value || `Tahap ${idx + 1}`;
                    totalScheduled += tVal;

                    if (idx > 0 && tVal > 0) {
                        terminDetailsHtml += `
                            <tr>
                                <td class="ps-4 text-muted" style="font-size: 0.82rem;"><i class="mdi mdi-calendar-check me-1"></i>${tName}</td>
                                <td class="text-end text-muted" style="font-size: 0.82rem;">${formatRp(tVal)}</td>
                            </tr>
                        `;
                    }
                });

                html += `
                    <tr style="background: rgba(255, 193, 7, 0.12);">
                        <td><strong class="text-dark"><i class="mdi mdi-cash-fast text-warning me-1"></i>Dipotong Uang Muka / DP (Tahap 1)</strong></td>
                        <td class="text-end fw-bold text-danger">- ${formatRp(dpPrice)}</td>
                    </tr>
                    <tr style="background: rgba(13, 110, 253, 0.08);">
                        <td><strong class="text-primary"><i class="mdi mdi-calculator-variant me-1"></i>Sisa Pokok yang Dicicil (Harga Deal - DP)</strong></td>
                        <td class="text-end fw-bold text-primary" style="font-size: 0.95rem;">${formatRp(sisaPokok)}</td>
                    </tr>
                `;

                if (terminDetailsHtml) {
                    html += `
                        <tr class="table-light">
                            <td colspan="2" class="fw-bold text-muted py-1" style="font-size: 0.78rem; text-transform: uppercase; letter-spacing: 0.5px;">
                                Rincian Jadwal Termin
                            </td>
                        </tr>
                        ${terminDetailsHtml}
                    `;
                }

                const diff = dealPrice - totalScheduled;
                let balanceBadge = '';
                if (diff === 0 && dealPrice > 0) {
                    balanceBadge = `<span class="badge bg-success"><i class="mdi mdi-check-circle me-1"></i>Pas / Balance Sesuai Target</span>`;
                } else if (diff > 0) {
                    balanceBadge = `<span class="badge bg-warning text-dark"><i class="mdi mdi-alert-circle me-1"></i>Kurang ${formatRp(diff)}</span>`;
                } else if (diff < 0) {
                    balanceBadge = `<span class="badge bg-danger"><i class="mdi mdi-alert-circle me-1"></i>Lebih ${formatRp(Math.abs(diff))}</span>`;
                }

                html += `
                    <tr style="background: #f8f9fa; border-top: 1px solid #dee2e6;">
                        <td>
                            <div class="d-flex align-items-center justify-content-between">
                                <strong class="text-dark"><i class="mdi mdi-playlist-check me-1"></i>Total Nominal Semua Tahap Termin</strong>
                                ${balanceBadge}
                            </div>
                        </td>
                        <td class="text-end fw-bold text-dark">${formatRp(totalScheduled)}</td>
                    </tr>
                `;
            }

            tbody.innerHTML = html;
            updateInstallmentBalance();
        }

        // ===============================
        // TOGGLE DETAIL PERMASALAHAN HUKUM
        // ===============================
        function toggleMasalahHukum() {
            const selectStatus = document.getElementById('select_status_tanah');
            const wrapperMasalah = document.getElementById('wrapper_keterangan_masalah');
            const inputMasalah = document.getElementById('input_keterangan_masalah');

            if (selectStatus && wrapperMasalah) {
                if (selectStatus.value === 'problem') {
                    wrapperMasalah.classList.remove('d-none');
                    if (inputMasalah) inputMasalah.focus();
                } else {
                    wrapperMasalah.classList.add('d-none');
                }
            }
        }

        // ===============================
        // TOGGLE DETAIL KESULITAN IZIN
        // ===============================
        function toggleKeteranganIzin() {
            const selectIzin = document.getElementById('select_kesulitan_izin');
            const wrapperIzin = document.getElementById('wrapper_keterangan_izin');
            const inputIzin = document.getElementById('input_keterangan_izin');

            if (selectIzin && wrapperIzin) {
                if (selectIzin.value === 'sulit' || selectIzin.value === 'very_sulit') {
                    wrapperIzin.classList.remove('d-none');
                    if (inputIzin) inputIzin.focus();
                } else {
                    wrapperIzin.classList.add('d-none');
                }
            }
        }

        function initFileUploadEvents() {
            document.querySelectorAll('.pratanah-file-upload-modern input[type="file"]').forEach(input => {
                input.onchange = function () {
                    const label = this.closest('.pratanah-file-upload-modern')?.querySelector('.file-label-text');
                    if (label && this.files.length > 0) {
                        label.textContent = this.files[0].name;
                        label.classList.add('fw-bold', 'text-primary');
                    }
                };
            });
        }

        window.toggleDocProcessNotes = function(selectEl, docId) {
            let val = $(selectEl).val();
            let container = $(`#processNotesContainer_${docId}`);
            let badge = $(`.doc-phys-badge-${docId}`);
            if (val === 'proses') {
                container.removeClass('d-none');
                badge.replaceWith(`<span class="badge bg-warning text-dark py-1 px-2 doc-phys-badge-${docId}" style="font-size: 10px;"><i class="mdi mdi-progress-clock me-1"></i>Masih Proses</span>`);
            } else if (val === 'belum_ada') {
                container.addClass('d-none');
                badge.replaceWith(`<span class="badge bg-light text-muted border py-1 px-2 doc-phys-badge-${docId}" style="font-size: 10px;">Belum Ada</span>`);
            } else {
                container.addClass('d-none');
                badge.replaceWith(`<span class="badge bg-soft-primary text-primary border py-1 px-2 doc-phys-badge-${docId}" style="font-size: 10px;"><i class="mdi mdi-check-circle-outline me-1"></i>Fisik Lengkap</span>`);
            }
        };

        function approvePraDoc(docId, typeId) {
            Swal.fire({
                title: 'Validasi Dokumen?',
                text: 'Apakah Anda sebagai Kepala Legal menyetujui dan memverifikasi keabsahan dokumen ini?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#22c55e',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="mdi mdi-check"></i> Ya, Validasi Sah',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/pra-landbank/dokumen/${docId}/approve`,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        dataType: 'json',
                        success: function(res) {
                            if (res.success) {
                                $(`.doc-badge-${typeId}, .doc-badge-fase3-${typeId}`).removeClass('bg-warning bg-danger bg-light text-dark text-muted').addClass('bg-success text-white').html('<i class="mdi mdi-check-circle me-1"></i>Terverifikasi (Sah)');
                                $(`#action-btns-doc-${docId}, #fase3-action-doc-${docId}`).html(`
                                    <span class="badge bg-soft-success text-success small"><i class="mdi mdi-shield-check me-1"></i>Sah</span>
                                    <button type="button" class="btn btn-xs btn-outline-danger py-1 px-2 ms-1" onclick="rejectPraDoc(${docId}, ${typeId})" title="Tolak / Revisi" style="font-size: 11px;"><i class="mdi mdi-close"></i> Tolak</button>
                                `);
                                
                                // Hide revision note box and ganti file box on approval
                                $(`.revision-box-${typeId}`).addClass('d-none');
                                $(`.ganti-file-box-${typeId}`).addClass('d-none');

                                // Auto check if all documents are now verified
                                const totalUploads = document.querySelectorAll('[id^="action-btns-doc-"]').length;
                                const totalVerified = document.querySelectorAll('[id^="action-btns-doc-"] .bg-soft-success, [id^="action-btns-doc-"] .btn-outline-danger').length;
                                const isAllNowVerified = res.auto_advanced_to_fase3 || (totalUploads > 0 && totalVerified === totalUploads);

                                if (isAllNowVerified) {
                                    isLegalSah = true;
                                    document.querySelector('#step3 .mdi-lock')?.remove();
                                    document.getElementById('step3')?.classList.remove('disabled');

                                    // Replace Fase 2 bottom button with Lanjut ke Fase 3
                                    const actionsFase2 = document.getElementById('actionsFase2Wrapper');
                                    if (actionsFase2) {
                                        actionsFase2.innerHTML = `
                                            <button type="button" class="btn btn-gradient-primary" onclick="switchStep(3)">
                                                <i class="mdi mdi-arrow-right-circle me-1"></i> Lanjut ke Fase 3
                                            </button>
                                        `;
                                    }

                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Dokumen Terverifikasi Sah!',
                                        html: `
                                            <p class="text-muted mb-2">${res.message}</p>
                                            <div class="alert alert-success border py-2 px-3 mb-0 text-start" style="font-size: 0.85rem; background: #f0fdf4; border-color: #bbf7d0 !important;">
                                                <i class="mdi mdi-check-decagram text-success me-1"></i>
                                                Seluruh berkas legalitas telah sah diverifikasi. Mengalihkan otomatis ke <b>Fase 3 (Sidang Keputusan Direksi)</b>...
                                            </div>
                                        `,
                                        timer: 1800,
                                        showConfirmButton: false
                                    }).then(() => {
                                        switchStep(3);
                                    });

                                    setTimeout(() => {
                                        switchStep(3);
                                    }, 1800);
                                } else {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil Diverifikasi!',
                                        text: res.message,
                                        timer: 1500,
                                        showConfirmButton: false
                                    });
                                }
                            }
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: 'Gagal memvalidasi dokumen'
                            });
                        }
                    });
                }
            });
        }

        function rejectPraDoc(docId, typeId) {
            Swal.fire({
                title: 'Tolak / Minta Revisi Dokumen',
                text: 'Masukkan catatan alasan penolakan atau instruksi revisi berkas:',
                input: 'textarea',
                inputPlaceholder: 'Contoh: Berkas buram / nomor sertifikat tidak sesuai...',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="mdi mdi-close"></i> Tolak Dokumen',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/pra-landbank/dokumen/${docId}/reject`,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            catatan_admin: result.value
                        },
                        dataType: 'json',
                        success: function(res) {
                            if (res.success) {
                                isLegalSah = false;
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Status Dokumen Ditolak',
                                    text: res.message,
                                    timer: 1500,
                                    showConfirmButton: false
                                });
                                $(`.doc-badge-${typeId}, .doc-badge-fase3-${typeId}`).removeClass('bg-warning bg-success bg-light text-dark text-muted').addClass('bg-danger text-white').html('<i class="mdi mdi-alert-circle me-1"></i>Revisi');
                                $(`#action-btns-doc-${docId}, #fase3-action-doc-${docId}`).html(`
                                    <button type="button" class="btn btn-xs btn-success py-1 px-2 text-white" onclick="approvePraDoc(${docId}, ${typeId})" title="Setujui & Validasi Dokumen" style="font-size: 11px;"><i class="mdi mdi-check me-1"></i>Validasi</button>
                                    <span class="badge bg-soft-danger text-danger small ms-1"><i class="mdi mdi-alert-circle me-1"></i>Perlu Revisi</span>
                                `);
                                
                                // Show and update revision note box & ganti file box immediately
                                const noteContent = res.notes || result.value || 'Berkas ditolak / perlu perbaikan dari pihak pengunggah.';
                                $(`.revision-notes-text-${typeId}`).text(noteContent);
                                if (res.revision_number) {
                                    $(`.rev-badge-${typeId}`).text('Rev #' + res.revision_number);
                                }
                                $(`.revision-box-${typeId}`).removeClass('d-none');
                                $(`.ganti-file-box-${typeId}`).removeClass('d-none');
                            }
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: 'Gagal menolak dokumen'
                            });
                        }
                    });
                }
            });
        }

        function initFileUploadEvents() {
            document.querySelectorAll('.pratanah-file-upload-modern input[type="file"]').forEach(input => {
                input.addEventListener('change', function () {
                    const labelText = this.closest('.pratanah-file-upload-modern').querySelector('.file-label-text');
                    if (labelText && this.files && this.files.length > 0) {
                        const fileName = this.files[0].name;
                        labelText.innerHTML = `<span class="text-success fw-bold"><i class="mdi mdi-file-check me-1"></i>${fileName}</span>`;
                    }
                });
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Financial summary listeners
            const costInputs = ['biaya_ijb_temp', 'biaya_pajak_temp', 'fee_makelar_temp', 'biaya_lain_temp'];
            costInputs.forEach(name => {
                const el = document.querySelector(`input[name="${name}"]`);
                if (el) {
                    el.addEventListener('input', updateFinancialSummary);
                    el.addEventListener('keyup', updateFinancialSummary);
                }
            });

            const dpInput = document.getElementById('dp_price_input');
            if (dpInput) {
                dpInput.addEventListener('input', updateFinancialSummary);
                dpInput.addEventListener('keyup', updateFinancialSummary);
            }

            const dealInput = document.getElementById('deal_price_input');
            if (dealInput) {
                dealInput.addEventListener('input', updateFinancialSummary);
                dealInput.addEventListener('keyup', updateFinancialSummary);
            }

            toggleInstallmentView(true);
            updateFinancialSummary();
            recalculateFase3DocProgress();

            // Legal issue & permit difficulty toggles
            toggleMasalahHukum();
            toggleKeteranganIzin();

            // Auto sync owner name with certificate
            const certInput = document.getElementById('certificate_owner');
            const ownerInput = document.getElementById('owner_name');
            const sameCheckbox = document.getElementById('sameAsCertificate');

            if (certInput && ownerInput && sameCheckbox) {
                sameCheckbox.addEventListener('change', function () {
                    if (this.checked) {
                        ownerInput.value = certInput.value;
                    }
                });

                certInput.addEventListener('input', function () {
                    if (sameCheckbox.checked) {
                        ownerInput.value = this.value;
                    }
                });

                ownerInput.addEventListener('input', function () {
                    if (sameCheckbox.checked && this.value !== certInput.value) {
                        sameCheckbox.checked = false;
                    }
                });
            }

            initFileUploadEvents();
            initSelect2Search();
        });
    </script>
@endpush
