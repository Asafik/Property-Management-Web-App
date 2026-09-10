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
            background: #fbf9ff !important;
            border: 1.5px solid #9a55ff !important;
            color: #7e22ce !important;
            border-radius: 8px;
            padding: 0.55rem 1.15rem;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 2px 5px rgba(154, 85, 255, 0.12);
            transition: all 0.25s ease;
        }

        .btn-outline-purple:hover {
            background: #9a55ff !important;
            color: #ffffff !important;
            border-color: #9a55ff !important;
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.3) !important;
            transform: translateY(-1px);
        }

        .btn-fase4-add {
            background: linear-gradient(135deg, #9a55ff 0%, #7e22ce 100%) !important;
            border: 1px solid #7e22ce !important;
            color: #ffffff !important;
            border-radius: 8px;
            padding: 0.55rem 1.15rem;
            font-size: 0.84rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 3px 8px rgba(154, 85, 255, 0.35);
            transition: all 0.25s ease;
        }

        .btn-fase4-add:hover {
            background: linear-gradient(135deg, #8b3cf6 0%, #6b18b5 100%) !important;
            color: #ffffff !important;
            box-shadow: 0 5px 14px rgba(154, 85, 255, 0.45) !important;
            transform: translateY(-1px);
        }

        .btn-fase4-master {
            background: #f3e8ff !important;
            border: 1.5px solid #a855f7 !important;
            color: #6b21a8 !important;
            border-radius: 8px;
            padding: 0.55rem 1.15rem;
            font-size: 0.84rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 2px 6px rgba(168, 85, 247, 0.18);
            transition: all 0.25s ease;
        }

        .btn-fase4-master:hover {
            background: #7e22ce !important;
            color: #ffffff !important;
            border-color: #7e22ce !important;
            box-shadow: 0 4px 12px rgba(126, 34, 206, 0.3) !important;
            transform: translateY(-1px);
        }

        .btn-fase4-template {
            background: #f8fafc !important;
            border: 1.5px solid #94a3b8 !important;
            color: #1e293b !important;
            border-radius: 8px;
            padding: 0.55rem 1.15rem;
            font-size: 0.84rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
            transition: all 0.25s ease;
        }

        .btn-fase4-template:hover {
            background: #e2e8f0 !important;
            color: #0f172a !important;
            border-color: #64748b !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12) !important;
            transform: translateY(-1px);
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
            border-radius: 6px;
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
            border-radius: 6px;
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
            .footer-action-row > div {
                width: 100% !important;
                display: flex !important;
                flex-wrap: wrap !important;
                gap: 0.5rem !important;
            }
            .footer-action-row .btn,
            .footer-action-row > div > .btn {
                flex: 1 1 100% !important;
                width: 100% !important;
                justify-content: center !important;
                text-align: center !important;
                padding: 0.65rem 1rem !important;
                font-size: 0.85rem !important;
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
            .footer-action-row {
                flex-direction: column !important;
                align-items: stretch !important;
                gap: 0.85rem !important;
            }
            .footer-action-row > div {
                width: 100% !important;
                display: flex !important;
                flex-wrap: wrap !important;
                gap: 0.65rem !important;
            }
            .footer-action-row .btn,
            .footer-action-row > div > .btn {
                flex: 1 1 calc(50% - 0.5rem) !important;
                min-width: 150px !important;
                justify-content: center !important;
                text-align: center !important;
                padding: 0.65rem 1rem !important;
                font-size: 0.84rem !important;
                white-space: normal !important;
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
            .fase4-actions-top {
                flex-wrap: wrap !important;
                gap: 0.5rem !important;
            }
        }

        /* ===== MODERN SEGMENTED TABS & BADGES (FASE 4) ===== */
        .fase4-tab-wrapper {
            background: #ffffff;
            border: 1px solid #e2e8f0 !important;
            border-radius: 10px !important;
            transition: all 0.2s ease;
        }

        .fase4-tab-nav {
            display: inline-flex;
            flex-wrap: wrap;
            align-items: center;
            background-color: #f1f5f9;
            padding: 4px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            gap: 3px;
        }

        .fase4-tab-item {
            border: none;
            background: transparent;
            color: #64748b;
            font-size: 0.82rem;
            font-weight: 600;
            padding: 0.45rem 0.95rem;
            border-radius: 6px;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex;
            align-items: center;
            gap: 7px;
            white-space: nowrap;
            text-decoration: none;
            cursor: pointer;
            outline: none;
        }

        .fase4-tab-item i {
            font-size: 0.95rem;
            line-height: 1;
        }

        .fase4-tab-item:hover {
            color: #9a55ff;
            background-color: rgba(255, 255, 255, 0.7);
        }

        .fase4-tab-item.active {
            background-color: #ffffff !important;
            color: #7e22ce !important;
            font-weight: 700 !important;
            box-shadow: 0 2px 8px rgba(126, 34, 206, 0.12), 0 1px 3px rgba(0, 0, 0, 0.04);
            transform: translateY(-1px);
        }

        .fase4-tab-count {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.72rem;
            font-weight: 700;
            padding: 0.15rem 0.5rem;
            border-radius: 5px;
            background-color: #e2e8f0;
            color: #475569;
            min-width: 22px;
            line-height: 1.25;
            transition: all 0.2s ease;
        }

        .fase4-tab-item.active .fase4-tab-count {
            background: linear-gradient(135deg, #da8cff, #9a55ff) !important;
            color: #ffffff !important;
            box-shadow: 0 2px 6px rgba(154, 85, 255, 0.3);
        }

        /* ===== FASE 4 CARD MODERN ENHANCEMENT ===== */
        .fase4-card-inner {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px !important;
            padding: 1.1rem;
            transition: all 0.22s ease-in-out;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .fase4-card-inner:hover {
            border-color: #cbd5e1;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
            transform: translateY(-2px);
        }

        .fase4-card-inner.is-final-goal {
            border: 1.5px solid #22c55e !important;
            background: linear-gradient(180deg, #ffffff 0%, #f7fee7 100%) !important;
        }

        .fase4-card-poin {
            border-radius: 5px !important;
            padding: 3.5px 7.5px !important;
            font-size: 0.73rem !important;
            font-weight: 700 !important;
            letter-spacing: 0.2px;
            line-height: 1.2;
        }

        .fase4-badge-goal {
            border-radius: 5px !important;
            padding: 3.5px 7px !important;
            font-size: 0.7rem !important;
            font-weight: 700 !important;
            letter-spacing: 0.3px;
            line-height: 1.2;
        }

        .badge-doc-status {
            border-radius: 5px !important;
            padding: 3.5px 8px !important;
            font-size: 0.72rem !important;
            font-weight: 600 !important;
            letter-spacing: 0.1px;
            line-height: 1.2;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .fase4-badge-syarat {
            border-radius: 4px !important;
            padding: 2.5px 6px !important;
            font-size: 0.68rem !important;
            font-weight: 600 !important;
            line-height: 1.2;
        }

        .fase4-card-title {
            font-size: 0.88rem !important;
            font-weight: 700 !important;
            color: #1e293b !important;
            line-height: 1.35 !important;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 2.4rem;
            margin-bottom: 0.25rem !important;
        }

        .fase4-card-instansi {
            font-size: 0.73rem;
            color: #64748b;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Container Key-Value Ringkasan */
        .fase4-card-meta {
            background-color: #f8fafc;
            border: 1px solid #edf2f7;
            border-radius: 6px;
            padding: 0.55rem 0.75rem;
            margin-bottom: 0.65rem;
        }

        .fase4-meta-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.74rem;
            margin-bottom: 0.3rem;
        }

        .fase4-meta-row:last-child {
            margin-bottom: 0;
        }

        .fase4-meta-label {
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .fase4-meta-value {
            font-weight: 600;
            color: #1e293b;
            text-align: right;
        }

        /* Box Prasyarat Berkas */
        .fase4-syarat-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 0.6rem 0.75rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            margin-bottom: 0.65rem;
            min-height: 95px;
        }

        .fase4-syarat-list {
            display: flex;
            flex-direction: column;
            gap: 4.5px;
            font-size: 0.72rem;
            max-height: 105px;
            overflow-y: auto;
            padding-right: 2px;
            margin-top: 0.35rem;
        }

        .fase4-syarat-item {
            display: flex;
            align-items: flex-start;
            gap: 6px;
            line-height: 1.3;
        }

        .fase4-syarat-item i {
            font-size: 0.85rem;
            line-height: 1.1;
            margin-top: 1px;
            flex-shrink: 0;
        }

        /* File Upload / Preview Box */
        .fase4-file-box {
            border-radius: 6px;
            padding: 0.55rem 0.75rem;
            margin-bottom: 0.65rem;
            margin-top: auto;
            font-size: 0.74rem;
            transition: all 0.2s ease;
        }

        /* Tombol Aksi Bawah */
        .btn-fase4-card-edit {
            background: #f5f3ff !important;
            color: #7c3aed !important;
            border: 1px solid #ddd6fe !important;
            border-radius: 6px !important;
            font-size: 0.76rem !important;
            font-weight: 600 !important;
            padding: 0.42rem 0.85rem !important;
            transition: all 0.2s ease !important;
        }

        .btn-fase4-card-edit:hover {
            background: #7c3aed !important;
            color: #ffffff !important;
            border-color: #7c3aed !important;
            box-shadow: 0 2px 8px rgba(124, 58, 237, 0.25) !important;
        }

        .btn-fase4-card-delete {
            background: #fef2f2 !important;
            color: #ef4444 !important;
            border: 1px solid #fecaca !important;
            border-radius: 6px !important;
            font-size: 0.85rem !important;
            padding: 0.42rem 0.65rem !important;
            transition: all 0.2s ease !important;
        }

        .btn-fase4-card-delete:hover {
            background: #ef4444 !important;
            color: #ffffff !important;
            border-color: #ef4444 !important;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.25) !important;
        }

        @media (max-width: 767.98px) {
            .fase4-tab-wrapper {
                flex-direction: column;
                align-items: stretch !important;
                padding: 0.65rem !important;
            }
            .fase4-tab-nav {
                width: 100%;
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                border-radius: 8px;
                padding: 4px;
                gap: 4px;
            }
            .fase4-tab-item {
                justify-content: center;
                border-radius: 6px;
                padding: 0.5rem 0.5rem;
                font-size: 0.76rem;
                gap: 4px;
            }
            .fase4-search-wrapper {
                width: 100% !important;
            }
        }

        /* ===== MODAL FASE 4 FORM MODERN STYLING ===== */
        .fase4-modal-section-card {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 1.1rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
            display: flex;
            flex-direction: column;
        }

        .fase4-modal-section-title {
            font-size: 0.84rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .fase4-form-input {
            border: 1.5px solid #cbd5e1 !important;
            border-radius: 6px !important;
            font-size: 0.85rem !important;
            color: #1e293b !important;
            padding: 0.48rem 0.75rem !important;
            transition: all 0.2s ease !important;
            background-color: #ffffff !important;
        }

        .fase4-form-input:focus {
            border-color: #9a55ff !important;
            box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.15) !important;
            background-color: #ffffff !important;
            outline: none !important;
        }

        .fase4-form-label {
            font-size: 0.76rem !important;
            font-weight: 600 !important;
            color: #334155 !important;
            margin-bottom: 0.35rem !important;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .fase4-upload-dropzone {
            background: #fafbfe;
            border: 2px dashed #cbd5e1;
            border-radius: 8px;
            padding: 1.15rem 1rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.25s ease;
            position: relative;
        }

        .fase4-upload-dropzone:hover {
            border-color: #9a55ff;
            background: #f8f6ff;
        }

        /* ===== MODERN CHECKLIST & MASTER PICKER UI ===== */
        .custom-picker-chk {
            width: 20px !important;
            height: 20px !important;
            min-width: 20px !important;
            cursor: pointer;
            border: 2px solid #cbd5e1 !important;
            border-radius: 5px !important;
            background-color: #ffffff;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            margin: 0 !important;
            display: inline-block;
            box-shadow: 0 1px 2px rgba(0,0,0,0.04);
        }

        .custom-picker-chk:hover {
            border-color: #9a55ff !important;
            box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.15) !important;
        }

        .custom-picker-chk:checked {
            background-color: #9a55ff !important;
            border-color: #9a55ff !important;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='M5 10l3 3l7-7'/%3e%3c/svg%3e") !important;
            box-shadow: 0 2px 6px rgba(154, 85, 255, 0.4) !important;
        }

        .custom-picker-chk:disabled {
            background-color: #f1f5f9 !important;
            border-color: #e2e8f0 !important;
            cursor: not-allowed;
            opacity: 0.7;
        }

        .master-picker-card {
            border: 1.5px solid #e2e8f0 !important;
            border-radius: 10px !important;
            background-color: #ffffff;
            transition: all 0.22s ease-in-out;
        }

        .master-picker-card:hover:not(.is-disabled) {
            border-color: rgba(154, 85, 255, 0.5) !important;
            box-shadow: 0 4px 16px rgba(154, 85, 255, 0.08) !important;
            transform: translateY(-2px);
        }

        .master-picker-card.is-checked {
            border-color: #9a55ff !important;
            background-color: #fcfaff !important;
            box-shadow: 0 4px 16px rgba(154, 85, 255, 0.14) !important;
        }

        .master-picker-card.is-disabled {
            background-color: #f8fafc !important;
            border-color: #e2e8f0 !important;
            opacity: 0.75;
            cursor: default !important;
        }

        .select-all-box {
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 8px !important;
            padding: 0.45rem 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .select-all-box:hover {
            border-color: #9a55ff;
            background: #fbf9ff;
        }

        /* Modern Search Input & Category Dropdown */
        .master-search-group {
            position: relative;
            display: flex;
            align-items: center;
            width: 100%;
        }

        .master-search-icon {
            position: absolute;
            left: 14px;
            font-size: 1.15rem;
            color: #9a55ff;
            pointer-events: none;
            z-index: 2;
        }

        .master-search-input {
            height: 42px !important;
            padding-left: 42px !important;
            padding-right: 14px !important;
            font-size: 0.88rem !important;
            border-radius: 8px !important;
            border: 1.5px solid #e2e8f0 !important;
            background-color: #f8fafc !important;
            color: #1e293b !important;
            transition: all 0.2s ease !important;
        }

        .master-search-input:focus {
            background-color: #ffffff !important;
            border-color: #9a55ff !important;
            box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.15) !important;
            outline: none !important;
        }

        .master-category-select {
            height: 42px !important;
            border-radius: 8px !important;
            border: 1.5px solid #e2e8f0 !important;
            background-color: #f8fafc !important;
            font-size: 0.88rem !important;
            color: #1e293b !important;
            font-weight: 500 !important;
            padding-left: 14px !important;
            transition: all 0.2s ease !important;
        }

        .master-category-select:focus {
            background-color: #ffffff !important;
            border-color: #9a55ff !important;
            box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.15) !important;
            outline: none !important;
        }

        /* Modal Footer Buttons */
        .btn-master-cancel {
            background-color: #f1f5f9 !important;
            border: 1px solid #cbd5e1 !important;
            color: #475569 !important;
            font-size: 0.88rem !important;
            font-weight: 600 !important;
            padding: 0.58rem 1.35rem !important;
            border-radius: 8px !important;
            transition: all 0.2s ease !important;
            display: inline-flex !important;
            align-items: center !important;
            line-height: 1.4 !important;
        }

        .btn-master-cancel:hover {
            background-color: #e2e8f0 !important;
            color: #0f172a !important;
            transform: translateY(-1px);
        }

        .btn-master-submit {
            background: linear-gradient(135deg, #9a55ff 0%, #7e22ce 100%) !important;
            border: none !important;
            color: #ffffff !important;
            font-size: 0.88rem !important;
            font-weight: 700 !important;
            padding: 0.58rem 1.55rem !important;
            border-radius: 8px !important;
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.3) !important;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
            display: inline-flex !important;
            align-items: center !important;
            line-height: 1.4 !important;
        }

        .btn-master-submit:hover:not(:disabled) {
            box-shadow: 0 6px 22px rgba(154, 85, 255, 0.5) !important;
            transform: translateY(-2px);
            color: #ffffff !important;
        }

        .btn-master-submit:active:not(:disabled) {
            transform: translateY(0);
        }

        .btn-master-submit:disabled {
            background: #cbd5e1 !important;
            color: #64748b !important;
            box-shadow: none !important;
            cursor: not-allowed;
            opacity: 0.75;
            transform: none !important;
        }

        /* Grid Layout for Master Document Cards to eliminate uneven row spacing */
        #masterPickerListContainer {
            display: grid !important;
            grid-template-columns: repeat(2, 1fr) !important;
            gap: 12px !important;
            margin: 0 !important;
        }

        @media (max-width: 767.98px) {
            #masterPickerListContainer {
                grid-template-columns: 1fr !important;
                gap: 10px !important;
            }
        }

        .master-picker-item {
            width: 100% !important;
            max-width: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
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

                            @php
                                $currentUser = auth()->user();
                                $userPositionName = strtolower($currentUser->position->name ?? '');
                                $userDivisionName = strtolower($currentUser->division->name ?? ($currentUser->position->division->name ?? ''));
                                $userPositionId = $currentUser->position_id ?? null;

                                $isAdmin = ($userPositionId == 5) || str_contains($userPositionName, 'admin');
                                $isKeuangan = ($userPositionId == 7) || str_contains($userPositionName, 'keuangan') || str_contains($userPositionName, 'finance') || str_contains($userDivisionName, 'keuangan') || str_contains($userDivisionName, 'finance');
                                $isReadOnlyKeuangan = $isKeuangan && !$isAdmin;
                                $isKepalaLegal = ($userPositionId == 3) || str_contains($userPositionName, 'kepala legal') || (str_contains($userPositionName, 'legal') && !str_contains($userPositionName, 'staff'));
                                $isStaffLegal = ($userPositionId == 4) || (str_contains($userPositionName, 'staff') && str_contains($userPositionName, 'legal'));
                                
                                // Hak Akses Role
                                $canEditGeneralInfo = ($isAdmin || !$isStaffLegal) && !$isKeuangan && !$land;
                                $canEditFinancial   = $isAdmin || $isKeuangan;
                                $canValidateDoc     = $isAdmin || $isKepalaLegal;
                                $canEditDecisions   = $isAdmin;

                                $rawStatus = strtoupper((string)($land->ownership_status ?? ''));
                                if (str_contains($rawStatus, 'APHB')) {
                                    $selectedCat = 'APHB';
                                } elseif (str_contains($rawStatus, 'WARIS')) {
                                    $selectedCat = 'WARISAN';
                                } elseif (str_contains($rawStatus, 'PETOK') || str_contains($rawStatus, 'GIRIK') || str_contains($rawStatus, 'LETTER')) {
                                    $selectedCat = 'PETOK_C';
                                } elseif (str_contains($rawStatus, 'AJB') || str_contains($rawStatus, 'HIBAH')) {
                                    $selectedCat = 'AJB';
                                } elseif (str_contains($rawStatus, 'SHM') || str_contains($rawStatus, 'HGB') || str_contains($rawStatus, 'HGU') || str_contains($rawStatus, 'HP')) {
                                    $selectedCat = 'SHM';
                                } else {
                                    $selectedCat = '';
                                }

                                $catDocTypeIds = !empty($selectedCat) ? $documentTypes->filter(function($dt) use ($selectedCat) {
                                    $c = $dt->applicable_categories ?? [];
                                    return empty($c) || in_array($selectedCat, $c);
                                })->pluck('id')->toArray() : [];

                                $praDocs = $land ? $land->documents : collect();
                                $applicablePraDocs = $praDocs->whereIn('document_type_id', $catDocTypeIds);
                                $totalUploadedDocs = $applicablePraDocs->whereNotNull('file_path')->count();
                                $verifiedCount = $applicablePraDocs->where('status', 'verified')->count();
                                $isLegalSah = $land && !empty($selectedCat) && ($totalUploadedDocs > 0) && ($verifiedCount === $totalUploadedDocs);
                                $isFase2Done = $land && (!empty($land->survey_date) || in_array($land->status, ['fase3', 'fase4', 'approved', 'rejected']));
                                $canAccessFase3 = $isLegalSah && $isFase2Done;
                                $canAccessFase4 = $canAccessFase3 && ($land && in_array($land->status, ['fase3', 'fase4', 'approved', 'rejected']));
                            @endphp

                            <!-- STEP 2 -->
                            <div class="step-item {{ !$land ? 'disabled' : '' }}" id="step2" onclick="switchStep(2)" style="cursor: pointer;" title="{{ (!$isLegalSah && !$isKeuangan && !$isAdmin && $land && $land->status != 'approved') ? 'Terkunci: Wajib verifikasi legalitas sah di Fase 1 terlebih dahulu' : '' }}">
                                <div class="step-circle">2</div>
                                <div class="step-title d-flex align-items-center justify-content-center">
                                    Fase 2
                                    @if(!$isLegalSah && !$isKeuangan && !$isAdmin && $land && $land->status != 'approved' && $land->status != 'rejected')
                                        <i class="mdi mdi-lock text-warning ms-1" style="font-size: 13px;" title="Terkunci: Menunggu Validasi Dokumen Sah di Fase 1"></i>
                                    @endif
                                </div>
                            </div>

                            <!-- STEP 3 -->
                            <div class="step-item {{ !$land ? 'disabled' : '' }}" id="step3" onclick="switchStep(3)" style="cursor: pointer;" title="{{ (!$canAccessFase3 && !$isKeuangan && !$isAdmin && $land && $land->status != 'approved') ? 'Terkunci: Wajib selesaikan Fase 1 dan Fase 2 terlebih dahulu' : '' }}">
                                <div class="step-circle">3</div>
                                <div class="step-title d-flex align-items-center justify-content-center">
                                    Fase 3
                                    @if(!$canAccessFase3 && !$isKeuangan && !$isAdmin && $land && $land->status != 'approved' && $land->status != 'rejected')
                                        <i class="mdi mdi-lock text-warning ms-1" style="font-size: 13px;" title="Terkunci: Wajib selesaikan Fase 2 terlebih dahulu"></i>
                                    @endif
                                </div>
                            </div>

                            <!-- STEP 4 -->
                            <div class="step-item {{ (!$land || (!$canAccessFase4 && !$isKeuangan && !$isAdmin && $land->status != 'approved')) ? 'disabled' : '' }}" id="step4" onclick="switchStep(4)" style="cursor: pointer;" title="{{ (!$canAccessFase4 && !$isKeuangan && !$isAdmin && $land && $land->status != 'approved') ? 'Terkunci: Wajib selesaikan Fase 1, 2, dan 3 terlebih dahulu' : '' }}">
                                <div class="step-circle">4</div>
                                <div class="step-title d-flex align-items-center justify-content-center">
                                    Fase 4
                                    @if(!$canAccessFase4 && !$isKeuangan && !$isAdmin && $land && $land->status != 'approved' && $land->status != 'rejected')
                                        <i class="mdi mdi-lock text-warning ms-1" style="font-size: 13px;" title="Terkunci: Wajib selesaikan Fase 3 terlebih dahulu"></i>
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
                            <form id="formFase1" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $land->id ?? '' }}">
                                <input type="hidden" name="fase" value="fase1">

                                @if($isReadOnlyKeuangan)
                                    <div class="alert alert-soft-info border border-info-subtle py-2.5 px-3 mb-3 d-flex align-items-center gap-2 rounded-3 text-info" style="background: #f0f9ff; font-size: 0.85rem;">
                                        <i class="mdi mdi-eye-outline fs-5"></i>
                                        <div>
                                            <strong>Mode Lihat Data (Divisi Keuangan)</strong>: Anda dapat melihat seluruh riwayat penawaran, status legalitas, dan berkas fisik tanah ini (Read-Only).
                                        </div>
                                    </div>
                                @elseif($isStaffLegal && $land)
                                    <div class="alert alert-soft-primary border border-primary-subtle py-2.5 px-3 mb-3 d-flex align-items-center gap-2 rounded-3 text-primary" style="background: #eff6ff; font-size: 0.83rem;">
                                        <i class="mdi mdi-information-outline fs-5 text-primary"></i>
                                        <span><strong>Peran Staff Legal:</strong> Anda berwenang melengkapi nomor dokumen, masa berlaku, status fisik keberadaan, dan mengunggah berkas pada bagian <strong>Dokumen Legalitas & Verifikasi Berkas (Fase 1)</strong> di bawah.</span>
                                    </div>
                                @endif

                                <!-- DATA MAKELAR -->
                                <div class="form-section">
                                    <div class="form-section-title">
                                        Data Kontak Makelar
                                        @if(!$canEditGeneralInfo)
                                            <small class="text-muted d-block fw-normal" style="font-size: 0.75rem;">(Diinput oleh Kepala Marketing / Admin)</small>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Nama Makelar *</label>
                                            <input type="text" class="form-control" name="land_owner" value="{{ $land->land_owner ?? '' }}" placeholder="Nama Lengkap Makelar" required {{ (!$canEditGeneralInfo || ($land && ($land->status == 'approved' || $land->status == 'rejected'))) ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Perusahaan / Instansi</label>
                                            <input type="text" class="form-control" name="land_source" value="{{ $land->land_source ?? '' }}" placeholder="Perusahaan Makelar" {{ (!$canEditGeneralInfo || ($land && ($land->status == 'approved' || $land->status == 'rejected'))) ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">No. WhatsApp / HP</label>
                                            <input type="text" class="form-control" name="owner_contact" value="{{ $land->owner_contact ?? '' }}" placeholder="Contoh: 08123456789" {{ (!$canEditGeneralInfo || ($land && ($land->status == 'approved' || $land->status == 'rejected'))) ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Tanggal Penawaran</label>
                                            <input type="date" class="form-control" name="survey_date" value="{{ $land && $land->survey_date ? \Carbon\Carbon::parse($land->survey_date)->format('Y-m-d') : '' }}" {{ (!$canEditGeneralInfo || ($land && ($land->status == 'approved' || $land->status == 'rejected'))) ? 'disabled' : '' }}>
                                        </div>
                                    </div>
                                </div>

                                <!-- DATA TANAH -->
                                <div class="form-section">
                                    <div class="form-section-title">
                                        Data Tanah
                                        @if(!$canEditGeneralInfo)
                                            <small class="text-muted d-block fw-normal" style="font-size: 0.75rem;">(Diinput oleh Kepala Marketing / Admin)</small>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Nama Prospek Tanah *</label>
                                            <input type="text" class="form-control" name="land_name" value="{{ $land->land_name ?? '' }}" placeholder="Contoh: Tanah Jember Regency" required {{ (!$canEditGeneralInfo || ($land && ($land->status == 'approved' || $land->status == 'rejected'))) ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Status Tanah / Kepemilikan (Dasar Perolehan) *</label>
                                            <select class="form-select select2-search" id="select_ownership_status" name="ownership_status" data-placeholder="Pilih Dasar Perolehan Tanah" style="width: 100%;" {{ (!$canEditGeneralInfo || ($land && ($land->status == 'approved' || $land->status == 'rejected'))) ? 'disabled' : '' }}>
                                                <option value="">-- Pilih Dasar Perolehan Tanah --</option>
                                                <option value="SHM" {{ ($land && !empty($land->ownership_status) && in_array(strtoupper($land->ownership_status), ['SHM', 'HGB', 'HGU', 'HP'])) ? 'selected' : '' }}>SHM (Sertifikat Hak Milik)</option>
                                                <option value="AJB" {{ ($land && !empty($land->ownership_status) && strtoupper($land->ownership_status) == 'AJB') ? 'selected' : '' }}>AJB / Akta Hibah</option>
                                                <option value="APHB" {{ ($land && !empty($land->ownership_status) && strtoupper($land->ownership_status) == 'APHB') ? 'selected' : '' }}>APHB (Akta Pembagian Hak Bersama)</option>
                                                <option value="WARISAN" {{ ($land && !empty($land->ownership_status) && strtoupper($land->ownership_status) == 'WARISAN') ? 'selected' : '' }}>AJB / Hibah (Harta Warisan)</option>
                                                <option value="PETOK_C" {{ ($land && !empty($land->ownership_status) && in_array(strtoupper($land->ownership_status), ['PETOK_C', 'GIRIK', 'PETOK D'])) ? 'selected' : '' }}>Petok C / Girik</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Nama di Sertifikat / Surat</label>
                                            <input type="text" class="form-control" id="certificate_owner" name="certificate_owner" value="{{ $land->certificate_owner ?? '' }}" placeholder="Nama pemilik sah di sertifikat" {{ (!$canEditGeneralInfo || ($land && ($land->status == 'approved' || $land->status == 'rejected'))) ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <label class="form-label mb-0">Nama Pemilik Tanah</label>
                                                <label class="same-cert-badge" for="sameAsCertificate" title="Centang untuk menyamakan dengan nama di sertifikat">
                                                    <input type="checkbox" id="sameAsCertificate" {{ $land && $land->owner_name && $land->certificate_owner && $land->owner_name === $land->certificate_owner ? 'checked' : '' }} {{ (!$canEditGeneralInfo || ($land && ($land->status == 'approved' || $land->status == 'rejected'))) ? 'disabled' : '' }}>
                                                    <span>Sama dengan sertifikat</span>
                                                </label>
                                            </div>
                                            <input type="text" class="form-control" id="owner_name" name="owner_name" value="{{ $land->owner_name ?? '' }}" placeholder="Nama pemilik tanah saat ini" {{ (!$canEditGeneralInfo || ($land && ($land->status == 'approved' || $land->status == 'rejected'))) ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="form-label">Alamat Lengkap *</label>
                                            <input type="text" class="form-control" name="address" value="{{ $land->address ?? '' }}" placeholder="Alamat lengkap lokasi tanah" required {{ (!$canEditGeneralInfo || ($land && ($land->status == 'approved' || $land->status == 'rejected'))) ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Luas Tanah (m²)</label>
                                            <input type="number" class="form-control" name="area" value="{{ $land->area ?? '' }}" placeholder="Luas tanah" {{ (!$canEditGeneralInfo || ($land && ($land->status == 'approved' || $land->status == 'rejected'))) ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Lebar Jalan Depan (m)</label>
                                            <input type="number" class="form-control" name="road_width" value="{{ $land->road_width ?? '' }}" placeholder="Lebar jalan" {{ (!$canEditGeneralInfo || ($land && ($land->status == 'approved' || $land->status == 'rejected'))) ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Jenis Konstruksi Jalan</label>
                                            <select class="form-select select2-search" id="select_road_type" name="road_type" data-placeholder="Pilih Konstruksi Jalan" style="width: 100%;" {{ (!$canEditGeneralInfo || ($land && ($land->status == 'approved' || $land->status == 'rejected'))) ? 'disabled' : '' }}>
                                                <option value="">Pilih</option>
                                                <option value="aspal" {{ $land && $land->road_type == 'aspal' ? 'selected' : '' }}>Aspal</option>
                                                <option value="beton" {{ $land && $land->road_type == 'beton' ? 'selected' : '' }}>Beton</option>
                                                <option value="paving" {{ $land && $land->road_type == 'paving' ? 'selected' : '' }}>Paving</option>
                                                <option value="tanah" {{ $land && $land->road_type == 'tanah' ? 'selected' : '' }}>Tanah</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold">
                                                Status Zona Tanah / Lahan <span class="text-danger">*</span>
                                                <i class="mdi mdi-information-outline text-primary" title="Pengecekan status LBS, LSD, atau LP2B untuk kelayakan izin perumahan"></i>
                                            </label>
                                            <select class="form-select" name="land_protection_status" {{ (!$canEditGeneralInfo || ($land && ($land->status == 'approved' || $land->status == 'rejected'))) ? 'disabled' : '' }}>
                                                <option value="aman" {{ ($land && ($land->land_protection_status ?? 'aman') == 'aman') ? 'selected' : '' }}>Aman (Bukan Zona Lindung / Bebas LSD)</option>
                                                <option value="lbs" {{ ($land && $land->land_protection_status == 'lbs') ? 'selected' : '' }}>LBS (Lahan Baku Sawah)</option>
                                                <option value="lsd" {{ ($land && $land->land_protection_status == 'lsd') ? 'selected' : '' }}>LSD (Lahan Sawah Dilindungi)</option>
                                                <option value="lp2b" {{ ($land && $land->land_protection_status == 'lp2b') ? 'selected' : '' }}>LP2B (Lahan Pertanian Pangan Berkelanjutan)</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-semibold">Status Pembayaran SPPT PBB <span class="text-danger">*</span></label>
                                            <select class="form-select" id="select_pbb_status" name="pbb_status" onchange="togglePbbArrearsField(this)" {{ (!$canEditGeneralInfo || ($land && ($land->status == 'approved' || $land->status == 'rejected'))) ? 'disabled' : '' }}>
                                                <option value="lunas" {{ ($land && ($land->pbb_status ?? 'lunas') == 'lunas') ? 'selected' : '' }}>Lunas</option>
                                                <option value="nunggak" {{ ($land && ($land->pbb_status ?? '') == 'nunggak') ? 'selected' : '' }}>Nunggak (Perlu Pelunasan)</option>
                                            </select>
                                        </div>
                                        <div class="col-12 {{ ($land && ($land->pbb_status ?? '') == 'nunggak') ? '' : 'd-none' }}" id="pbb_arrears_container">
                                            <div class="p-3 rounded-3 border border-danger-subtle mb-3" style="background: #fff8f8;">
                                                <div class="row g-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-semibold text-danger mb-1" style="font-size: 0.85rem;">
                                                            <i class="mdi mdi-clock-alert-outline me-1"></i> Lama / Keterangan Tunggakan PBB <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" class="form-control border-danger-subtle bg-white" id="input_pbb_note" name="pbb_note" value="{{ $land->pbb_note ?? '' }}" placeholder="Contoh: Nunggak 2 Tahun (2024 - 2025) / Nunggak 6 Bulan" {{ (!$canEditGeneralInfo || ($land && ($land->status == 'approved' || $land->status == 'rejected'))) ? 'disabled' : '' }}>
                                                        <small class="text-muted" style="font-size: 0.74rem;">Tuliskan durasi tunggakan (berapa bulan/tahun) atau tahun pajak.</small>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-semibold text-danger mb-1" style="font-size: 0.85rem;">
                                                            <i class="mdi mdi-cash-multiple me-1"></i> Nominal Tunggakan PBB (Rp) <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" class="form-control border-danger-subtle bg-white" id="input_pbb_nominal" name="pbb_nominal" value="{{ $land && $land->pbb_nominal ? number_format($land->pbb_nominal, 0, ',', '.') : '' }}" oninput="formatRupiah(this)" placeholder="Estimasi nominal tunggakan" {{ (!$canEditGeneralInfo || ($land && ($land->status == 'approved' || $land->status == 'rejected'))) ? 'disabled' : '' }}>
                                                        <small class="text-muted" style="font-size: 0.74rem;">Total tagihan pokok + denda tunggakan PBB yang harus dilunasi.</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- NEGOSIASI HARGA -->
                                <div class="form-section">
                                    <div class="form-section-title">
                                        Negosiasi Harga Awal
                                        @if(!$canEditGeneralInfo)
                                            <small class="text-muted d-block fw-normal" style="font-size: 0.75rem;">(Diinput oleh Kepala Marketing / Admin)</small>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Harga Penawaran Awal (Rp)</label>
                                            <input type="text" class="form-control" id="offer_price" name="offer_price" value="{{ $land && $land->offer_price ? number_format($land->offer_price, 0, ',', '.') : '' }}" oninput="formatRupiah(this)" placeholder="Harga penawaran" {{ (!$canEditGeneralInfo || ($land && ($land->status == 'approved' || $land->status == 'rejected'))) ? 'disabled' : '' }}>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Harga Target Negosiasi (Rp)</label>
                                            <input type="text" class="form-control" id="estimated_price" name="estimated_price" value="{{ $land && $land->estimated_price ? number_format($land->estimated_price, 0, ',', '.') : '' }}" oninput="formatRupiah(this)" placeholder="Harga negosiasi" {{ (!$canEditGeneralInfo || ($land && ($land->status == 'approved' || $land->status == 'rejected'))) ? 'disabled' : '' }}>
                                        </div>
                                    </div>
                                </div>

                                <!-- DOKUMEN LEGALITAS & UPLOAD BERKAS (FASE 1) -->
                                <div class="form-section">
                                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
                                        <div>
                                            <div class="form-section-title mb-0">
                                                Dokumen Legalitas & Verifikasi Berkas (Fase 1)
                                            </div>
                                            <small class="text-muted" style="font-size: 0.8rem;">
                                                Unggah berkas fisik dokumen legalitas tanah (KTP Pemilik, PBB, Sertifikat, dll.) dan validasi keabsahan dokumen oleh Kepala Legal.
                                            </small>
                                        </div>
                                        <span class="badge bg-soft-primary text-primary border border-primary-subtle py-1.5 px-3" style="font-size: 0.82rem; font-weight: 600;">
                                            <i class="mdi mdi-shield-check-outline me-1"></i> Berkas & Validasi Dokumen
                                        </span>
                                    </div>

                                    @php
                                        $uploadedDocs = [];
                                        if ($land) {
                                            foreach ($land->documents as $d) {
                                                $uploadedDocs[$d->document_type_id] = $d;
                                            }
                                        }
                                        // Uploaded docs mapping
                                    @endphp

                                    <!-- Dynamic Category Alert Banner (Filtered by Alas Hak) -->
                                    <div class="alert alert-info py-2.5 px-3 mb-3 d-flex align-items-center justify-content-between rounded-3 border shadow-none {{ empty($selectedCat) ? 'd-none' : '' }}" id="fase1CategoryAlert" style="background: #f0fdf4; border-color: #bbf7d0 !important; color: #166534;">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="mdi mdi-filter-check" style="font-size: 1.35rem; color: #16a34a;"></i>
                                            <div>
                                                <span class="fw-bold d-block" style="font-size: 0.88rem;">
                                                    Berkas Wajib Dasar Perolehan: <span id="fase1CategoryName" class="badge bg-success ms-1">{{ !empty($selectedCat) ? ($selectedCat == 'PETOK_C' ? 'Petok C / Girik Asli' : ($selectedCat == 'WARISAN' ? 'AJB & Akta Hibah (Harta Warisan)' : ($selectedCat == 'AJB' ? 'AJB / Akta Hibah' : ($selectedCat == 'APHB' ? 'APHB (Akta Pembagian Hak Bersama)' : 'SHM (Sertifikat Hak Milik)')))) : '' }}</span>
                                                </span>
                                                <small class="text-muted d-block" id="fase1CategoryDesc" style="font-size: 0.76rem;">
                                                    @if($selectedCat === 'SHM')
                                                        6 Dokumen Wajib: Sertifikat SHM Asli + 5 Dokumen Identitas & Pajak (KTP, KK, Nikah, NPWP, PBB).
                                                    @elseif($selectedCat === 'AJB')
                                                        10 Dokumen Wajib: AJB/Hibah Asli, Riwayat Tanah, Letter C, Penguasaan Fisik, Tanda Batas + 5 Dokumen Identitas & Pajak (KTP, KK, Nikah, NPWP, PBB).
                                                    @elseif($selectedCat === 'APHB')
                                                        11 Dokumen Wajib: APHB, Ket. Ahli Waris, Akta Kematian, Riwayat Tanah, Letter C, Penguasaan Fisik, Tanda Batas + 5 Dokumen Identitas & Pajak Ahli Waris.
                                                    @elseif($selectedCat === 'WARISAN')
                                                        11 Dokumen Wajib: AJB/Hibah Asli, Ket. Waris, Akta Kematian, Riwayat Tanah, Letter C, Penguasaan Fisik, Tanda Batas + 5 Dokumen Identitas & Pajak.
                                                    @elseif($selectedCat === 'PETOK_C')
                                                        10 Dokumen Wajib: Petok C Asli, Riwayat Tanah, Letter C, Penguasaan Fisik, Tanda Batas + 5 Dokumen Identitas & Pajak.
                                                    @else
                                                        Menampilkan berkas wajib legalitas sesuai SOP.
                                                    @endif
                                                </small>
                                            </div>
                                        </div>
                                        <span class="badge bg-success px-3 py-1.5 shadow-sm" id="fase1CategoryCountBadge" style="font-size: 0.82rem; font-weight: 700;">
                                            {{ count($catDocTypeIds) }} Dokumen Wajib
                                        </span>
                                    </div>

                                    <!-- Empty Placeholder Banner when no category is selected -->
                                    <div class="alert alert-light border border-dashed rounded-3 p-4 text-center mb-3 {{ !empty($selectedCat) ? 'd-none' : '' }}" id="fase1EmptyCategoryAlert" style="background: #f8fafc; border-color: #cbd5e1 !important;">
                                        <div class="d-flex flex-column align-items-center justify-content-center py-2">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center mb-2" style="width: 48px; height: 48px; background: #e0f2fe; color: #0284c7;">
                                                <i class="mdi mdi-file-document-outline" style="font-size: 24px;"></i>
                                            </div>
                                            <h6 class="fw-bold text-dark mb-1" style="font-size: 0.95rem;">Pilih Status Tanah / Kepemilikan (Dasar Perolehan)</h6>
                                            <p class="text-muted mb-0" style="font-size: 0.82rem; max-width: 500px;">
                                                Silakan tentukan <strong>Status Tanah / Kepemilikan (Dasar Perolehan)</strong> pada formulir Data Tanah di atas terlebih dahulu untuk memunculkan daftar berkas legalitas yang wajib diunggah.
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row g-3" id="documentGridContainerFase1">
                                        @foreach($documentTypes as $doc)
                                             @php
                                                 $existingDoc = $uploadedDocs[$doc->id] ?? null;
                                                 $hasFile = ($existingDoc && !empty($existingDoc->file_path));
                                                 $currentDocStatus = $existingDoc->status ?? ($hasFile ? 'pending' : 'belum_upload');
                                                 $docPhysStatus = $existingDoc->document_status ?? 'ada';
                                                 $docCategories = $doc->applicable_categories ?? [];
                                                 $isApplicable = !empty($selectedCat) && (empty($docCategories) || in_array($selectedCat, $docCategories));
                                             @endphp
                                             <div class="col-12 col-md-6 col-xl-4 doc-fase1-col {{ !$isApplicable ? 'd-none' : '' }}" id="doc-box-fase1-{{ $doc->id }}" data-categories='@json($docCategories)' data-doc-id="{{ $doc->id }}">
                                                 <div class="card h-100 border shadow-sm rounded-3 p-3 position-relative" style="background: #ffffff; border-color: #eaedf2 !important;">
                                                    <!-- Header Card Box -->
                                                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3 pb-2 border-bottom">
                                                        <div>
                                                            <h6 class="mb-0 fw-bold text-dark" style="font-size: 0.92rem;">{{ $doc->name }}</h6>
                                                        </div>
                                                        <div class="d-flex align-items-center gap-1 flex-wrap justify-content-end">
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
                                                        <select name="documents[{{ $doc->id }}][document_status]" class="form-select form-select-sm" onchange="toggleDocProcessNotes(this, {{ $doc->id }})" style="font-size: 0.85rem;" {{ ($isReadOnlyKeuangan || ($land && ($land->status == 'approved' || $land->status == 'rejected'))) ? 'disabled' : '' }}>
                                                            <option value="ada" {{ ($existingDoc->document_status ?? 'ada') === 'ada' ? 'selected' : '' }}>Ada / Lengkap</option>
                                                            <option value="proses" {{ ($existingDoc->document_status ?? '') === 'proses' ? 'selected' : '' }}>Masih Proses (Pengurusan Notaris/BPN/Dinas)</option>
                                                            <option value="belum_ada" {{ ($existingDoc->document_status ?? '') === 'belum_ada' ? 'selected' : '' }}>Belum Ada</option>
                                                        </select>
                                                    </div>

                                                    <!-- Dynamic Form Keterangan / Progres Pengurusan (Muncul saat Masih Proses) -->
                                                    <div class="mb-2 p-2 rounded-2 border process-notes-container {{ ($existingDoc->document_status ?? '') === 'proses' ? '' : 'd-none' }}" id="processNotesContainer_{{ $doc->id }}" style="background: #fffdf5; border-color: #fde68a !important;">
                                                        <label class="form-label mb-1 text-dark fw-bold d-flex align-items-center gap-1" style="font-size: 0.78rem;">
                                                            <i class="mdi mdi-progress-clock text-warning"></i> Keterangan & Progres Pengurusan Dokumen:
                                                        </label>
                                                        <textarea name="documents[{{ $doc->id }}][process_notes]" class="form-control form-control-sm" rows="2" placeholder="Tuliskan progres pengurusan berkas..." style="font-size: 0.8rem;" {{ ($isReadOnlyKeuangan || ($land && ($land->status == 'approved' || $land->status == 'rejected'))) ? 'disabled' : '' }}>{{ $existingDoc->process_notes ?? '' }}</textarea>
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
                                                            {{ ($isReadOnlyKeuangan || ($hasFile && $land && ($land->status == 'approved' || $land->status == 'rejected'))) ? 'disabled' : '' }}>
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

                                                            <!-- Opsi Ganti / Upload Ulang Berkas -->
                                                            @if (!$isReadOnlyKeuangan && (!$land || ($land && $land->status != 'approved' && $land->status != 'rejected')))
                                                                <div class="pratanah-file-upload-modern mb-1 ganti-file-box-{{ $doc->id }} {{ $isDocRejected ? '' : '' }}">
                                                                    <input type="file" name="documents[{{ $doc->id }}][file]" accept=".pdf,.jpg,.jpeg,.png">
                                                                    <div class="pratanah-file-label-modern py-1 px-2" style="background: #f8fafc; border: 1px dashed #cbd5e1;">
                                                                        <i class="mdi mdi-cloud-sync" style="font-size: 1.1rem; color: #64748b;"></i>
                                                                        <div class="pratanah-file-info-modern">
                                                                            <span class="file-label-text text-secondary" style="font-size: 0.76rem; font-weight: 600;">Ganti Berkas / Upload Ulang</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif

                                                            <!-- Tombol Aksi Validasi Kepala Legal / Admin (FASE 1) -->
                                                            @if($canValidateDoc)
                                                                <div class="mt-2 pt-2 border-top d-flex align-items-center justify-content-between gap-2 w-100" id="action-btns-doc-{{ $existingDoc->id }}">
                                                                    @if(($existingDoc->status ?? '') !== 'verified' && ($existingDoc->status ?? '') !== 'valid')
                                                                        <button type="button" class="btn btn-xs btn-success py-1.5 px-2 text-white flex-grow-1 d-inline-flex align-items-center justify-content-center shadow-sm" onclick="approvePraDoc({{ $existingDoc->id }}, {{ $doc->id }})" title="Setujui & Validasi Dokumen" style="font-size: 11px; font-weight: 600; border-radius: 6px;">
                                                                            <i class="mdi mdi-check me-1"></i>Validasi
                                                                        </button>
                                                                    @else
                                                                        <span class="badge bg-soft-success text-success small"><i class="mdi mdi-shield-check me-1"></i>Sah</span>
                                                                    @endif
                                                                    @if(($existingDoc->status ?? '') !== 'rejected' && ($existingDoc->status ?? '') !== 'revisi')
                                                                        <button type="button" class="btn btn-xs btn-danger py-1.5 px-2 text-white flex-grow-1 d-inline-flex align-items-center justify-content-center shadow-sm" onclick="rejectPraDoc({{ $existingDoc->id }}, {{ $doc->id }})" title="Tolak & Minta Revisi" style="font-size: 11px; font-weight: 600; border-radius: 6px;">
                                                                            <i class="mdi mdi-close me-1"></i>Tolak
                                                                        </button>
                                                                    @else
                                                                        <span class="badge bg-soft-danger text-danger small ms-1"><i class="mdi mdi-alert-circle me-1"></i>Perlu Revisi</span>
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
                                                            <!-- State: Dokumen Baru / Belum Ada Berkas -->
                                                            @if(!$isReadOnlyKeuangan)
                                                                <label class="form-label mb-1 text-muted d-flex align-items-center justify-content-between" style="font-size: 0.8rem; font-weight: 600;">
                                                                    <span>Upload Berkas {{ $doc->name }}</span>
                                                                    <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25" style="font-size: 9px;">Format PDF/JPG/PNG</span>
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
                                                            @else
                                                                <div class="p-2.5 rounded bg-light text-center border text-muted fst-italic" style="font-size: 0.78rem;">
                                                                    Belum ada file fisik diunggah
                                                                </div>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- ACTIONS FASE 1 -->
                                <div class="d-flex justify-content-end gap-3 mt-4 footer-action-row">
                                    @if ($isReadOnlyKeuangan)
                                        <button type="button" class="btn btn-gradient-primary btn-action-mobile" onclick="switchStep(2)">
                                            <i class="mdi mdi-arrow-right-circle me-1"></i> Lanjut Lihat Fase 2
                                        </button>
                                    @elseif (!$land)
                                        <button type="button" class="btn btn-gradient-primary btn-action-mobile" onclick="saveFase1(false)">
                                            <i class="mdi mdi-content-save-outline me-1"></i> Simpan Data Fase 1
                                        </button>
                                    @elseif ($land && $land->status != 'approved' && $land->status != 'rejected')
                                        <button type="button" class="btn {{ !$isLegalSah ? 'btn-gradient-primary' : 'btn-outline-purple' }} btn-action-mobile" onclick="saveFase1(false)">
                                            <i class="mdi mdi-content-save-outline me-1"></i> Simpan Perubahan Fase 1
                                        </button>
                                        @if ($isLegalSah)
                                            <button type="button" class="btn btn-gradient-primary btn-action-mobile" onclick="saveFase1(true)">
                                                <i class="mdi mdi-arrow-right-circle me-1"></i> Simpan & Lanjut ke Fase 2
                                            </button>
                                        @endif
                                    @else
                                        <button type="button" class="btn btn-gradient-primary btn-action-mobile" onclick="switchStep(2)">
                                            <i class="mdi mdi-arrow-right-circle me-1"></i> Menuju ke Fase 2
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
                                FASE 2: Survey Kelayakan Teknis & Spasial Map
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
                                                            {{ $land->ownership_status ?? '-' }}
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
                                                        <span class="fase2-info-label">Status SPPT PBB:</span>
                                                        <span class="fase2-info-value">
                                                            @if(($land->pbb_status ?? 'lunas') === 'nunggak')
                                                                <span class="badge bg-danger text-white py-1 px-2" style="font-size: 0.78rem;">
                                                                    <i class="mdi mdi-alert-circle-outline me-1"></i>Nunggak
                                                                </span>
                                                            @else
                                                                <span class="badge bg-success text-white py-1 px-2" style="font-size: 0.78rem;">
                                                                    <i class="mdi mdi-check-circle-outline me-1"></i>Lunas
                                                                </span>
                                                            @endif
                                                        </span>
                                                    </div>
                                                    @if(($land->pbb_status ?? '') === 'nunggak')
                                                        @if(!empty($land->pbb_note))
                                                            <div class="fase2-info-row">
                                                                <span class="fase2-info-label text-danger">Keterangan Nunggak:</span>
                                                                <span class="fase2-info-value text-danger fw-semibold">{{ $land->pbb_note }}</span>
                                                            </div>
                                                        @endif
                                                        @if(!empty($land->pbb_nominal))
                                                            <div class="fase2-info-row">
                                                                <span class="fase2-info-label text-danger">Nominal Tunggakan:</span>
                                                                <span class="fase2-info-value text-danger fw-bold">Rp {{ number_format($land->pbb_nominal, 0, ',', '.') }}</span>
                                                            </div>
                                                        @endif
                                                    @endif
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
                                            <label class="form-label">Kondisi Fisik / Kontur Lahan</label>
                                            <select class="form-select select2-search" id="select_land_status" name="land_status_temp" data-placeholder="Pilih Kondisi Fisik / Kontur Lahan" style="width: 100%;" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                <option value="">-- Pilih Kondisi Fisik / Kontur Lahan --</option>
                                                <option value="bekas_sawah" {{ $land && $land->land_status == 'bekas_sawah' ? 'selected' : '' }}>Lahan Bekas Sawah</option>
                                                <option value="perbukitan" {{ $land && $land->land_status == 'perbukitan' ? 'selected' : '' }}>Perbukitan</option>
                                                <option value="pekarangan" {{ $land && $land->land_status == 'pekarangan' ? 'selected' : '' }}>Pekarangan</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Kondisi Air</label>
                                            <select class="form-select select2-search" id="select_water_condition" name="water_condition_temp" data-placeholder="Pilih Kondisi Air" style="width: 100%;" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                <option value="">-- Pilih Kondisi Air --</option>
                                                <option value="sumur_bor" {{ $land && $land->water_condition == 'sumur_bor' ? 'selected' : '' }}>Sumur Bor</option>
                                                <option value="pdam" {{ $land && $land->water_condition == 'pdam' ? 'selected' : '' }}>PDAM</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- DOKUMENTASI FOTO LAHAN (2 FOTO) -->
                                    <div class="row pt-2 border-top mt-2">
                                        <div class="col-12 mb-2">
                                            <label class="form-label fw-bold text-dark mb-1" style="font-size: 0.88rem;">
                                                <i class="mdi mdi-camera-outline text-purple me-1"></i> Dokumentasi Foto Lahan
                                            </label>
                                        </div>

                                        <!-- Foto Lahan 1 -->
                                        <div class="col-12 col-md-6 mb-3">
                                            <div class="p-3 rounded-3 h-100 border bg-light bg-opacity-50">
                                                <label class="form-label fw-semibold text-dark mb-2 d-flex align-items-center justify-content-between" style="font-size: 0.83rem;">
                                                    <span><i class="mdi mdi-image-area text-primary me-1"></i> Foto Lahan 1</span>
                                                    @if($land && $land->photo)
                                                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25" style="font-size: 10px;">Sudah Terunggah</span>
                                                    @endif
                                                </label>

                                                @if($land && $land->photo)
                                                    <div class="mb-2 position-relative rounded-2 overflow-hidden border" style="height: 140px; background: #000;">
                                                        <img src="{{ asset($land->photo) }}" id="preview_photo_1" class="w-100 h-100" style="object-fit: cover;" alt="Foto Lahan 1">
                                                        <a href="{{ asset($land->photo) }}" target="_blank" class="btn btn-xs btn-dark bg-opacity-75 text-white position-absolute bottom-0 end-0 m-2" style="font-size: 11px;">
                                                            <i class="mdi mdi-magnify me-1"></i> Lihat Penuh
                                                        </a>
                                                    </div>
                                                @else
                                                    <div class="mb-2 d-none position-relative rounded-2 overflow-hidden border" id="box_preview_photo_1" style="height: 140px; background: #000;">
                                                        <img id="preview_photo_1" class="w-100 h-100" style="object-fit: cover;" alt="Preview Foto Lahan 1">
                                                    </div>
                                                @endif

                                                <div class="pratanah-file-upload-modern">
                                                    <input type="file" name="photo" id="input_photo_1" accept="image/jpeg,image/png,image/jpg,image/webp" onchange="previewImageFase2(this, 'preview_photo_1', 'box_preview_photo_1')" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                    <div class="pratanah-file-label-modern py-2 px-3">
                                                        <i class="mdi mdi-camera-plus" style="font-size: 1.25rem;"></i>
                                                        <div class="pratanah-file-info-modern">
                                                            <span class="file-label-text">{{ ($land && $land->photo) ? 'Ganti Foto Lahan 1' : 'Pilih Foto Lahan 1' }}</span>
                                                            <span class="file-label-hint">JPG, PNG, JPEG, WEBP</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Foto Lahan 2 -->
                                        <div class="col-12 col-md-6 mb-3">
                                            <div class="p-3 rounded-3 h-100 border bg-light bg-opacity-50">
                                                <label class="form-label fw-semibold text-dark mb-2 d-flex align-items-center justify-content-between" style="font-size: 0.83rem;">
                                                    <span><i class="mdi mdi-image-area text-primary me-1"></i> Foto Lahan 2</span>
                                                    @if($land && $land->photo_2)
                                                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25" style="font-size: 10px;">Sudah Terunggah</span>
                                                    @endif
                                                </label>

                                                @if($land && $land->photo_2)
                                                    <div class="mb-2 position-relative rounded-2 overflow-hidden border" style="height: 140px; background: #000;">
                                                        <img src="{{ asset($land->photo_2) }}" id="preview_photo_2" class="w-100 h-100" style="object-fit: cover;" alt="Foto Lahan 2">
                                                        <a href="{{ asset($land->photo_2) }}" target="_blank" class="btn btn-xs btn-dark bg-opacity-75 text-white position-absolute bottom-0 end-0 m-2" style="font-size: 11px;">
                                                            <i class="mdi mdi-magnify me-1"></i> Lihat Penuh
                                                        </a>
                                                    </div>
                                                @else
                                                    <div class="mb-2 d-none position-relative rounded-2 overflow-hidden border" id="box_preview_photo_2" style="height: 140px; background: #000;">
                                                        <img id="preview_photo_2" class="w-100 h-100" style="object-fit: cover;" alt="Preview Foto Lahan 2">
                                                    </div>
                                                @endif

                                                <div class="pratanah-file-upload-modern">
                                                    <input type="file" name="photo_2" id="input_photo_2" accept="image/jpeg,image/png,image/jpg,image/webp" onchange="previewImageFase2(this, 'preview_photo_2', 'box_preview_photo_2')" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                    <div class="pratanah-file-label-modern py-2 px-3">
                                                        <i class="mdi mdi-camera-plus" style="font-size: 1.25rem;"></i>
                                                        <div class="pratanah-file-info-modern">
                                                            <span class="file-label-text">{{ ($land && $land->photo_2) ? 'Ganti Foto Lahan 2' : 'Pilih Foto Lahan 2' }}</span>
                                                            <span class="file-label-hint">JPG, PNG, JPEG, WEBP</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
                                    <button type="button" class="btn btn-outline-purple btn-action-mobile" onclick="switchStep(1)">
                                        <i class="mdi mdi-arrow-left-circle me-1"></i> Kembali ke Fase 1
                                    </button>

                                    @if ($isReadOnlyKeuangan)
                                        <button type="button" class="btn btn-gradient-primary btn-action-mobile" onclick="switchStep(3)">
                                            <i class="mdi mdi-arrow-right-circle me-1"></i> Lanjut Lihat Fase 3
                                        </button>
                                    @elseif (!$land || ($land && $land->status != 'approved' && $land->status != 'rejected'))
                                        <button type="button" class="btn btn-gradient-primary btn-action-mobile" id="btnSaveFase2" onclick="saveFase2()">
                                            <i class="mdi mdi-content-save-all"></i> Simpan Data Fase 2
                                        </button>

                                        <button type="button" class="btn btn-gradient-success btn-action-mobile" id="btnProceedFase3" onclick="saveFase2(true)">
                                            <i class="mdi mdi-arrow-right-circle me-1"></i> Simpan & Lanjut ke Fase 3
                                        </button>
                                    @elseif($canAccessFase3)
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

                                @if($isReadOnlyKeuangan)
                                    <div class="alert alert-soft-info border border-info-subtle py-2.5 px-3 mb-3 d-flex align-items-center gap-2 rounded-3 text-info" style="background: #f0f9ff; font-size: 0.85rem;">
                                        <i class="mdi mdi-cash-multiple fs-5"></i>
                                        <div>
                                            <strong>Mode Lihat Data (Divisi Keuangan)</strong>: Menampilkan data transaksi, simulasi biaya legalitas & pajak, notaris rekanan, skema pembayaran, dan cetak invoice (Read-Only).
                                        </div>
                                    </div>
                                @endif

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
                                                                {{ $land->ownership_status ?? '-' }}
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
                                                            <span class="fase2-info-label">Status SPPT PBB:</span>
                                                            <span class="fase2-info-value">
                                                                @if(($land->pbb_status ?? 'lunas') === 'nunggak')
                                                                    <span class="badge bg-danger text-white py-1 px-2" style="font-size: 0.78rem;">
                                                                        <i class="mdi mdi-alert-circle-outline me-1"></i>Nunggak
                                                                    </span>
                                                                @else
                                                                    <span class="badge bg-success text-white py-1 px-2" style="font-size: 0.78rem;">
                                                                        <i class="mdi mdi-check-circle-outline me-1"></i>Lunas
                                                                    </span>
                                                                @endif
                                                            </span>
                                                        </div>
                                                        @if(($land->pbb_status ?? '') === 'nunggak')
                                                            @if(!empty($land->pbb_note))
                                                                <div class="fase2-info-row">
                                                                    <span class="fase2-info-label text-danger">Keterangan Nunggak:</span>
                                                                    <span class="fase2-info-value text-danger fw-semibold">{{ $land->pbb_note }}</span>
                                                                </div>
                                                            @endif
                                                            @if(!empty($land->pbb_nominal))
                                                                <div class="fase2-info-row">
                                                                    <span class="fase2-info-label text-danger">Nominal Tunggakan:</span>
                                                                    <span class="fase2-info-value text-danger fw-bold">Rp {{ number_format($land->pbb_nominal, 0, ',', '.') }}</span>
                                                                </div>
                                                            @endif
                                                        @endif
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

                                            <!-- Card Rangkuman Foto Lahan (Fase 2) di Fase 3 -->
                                            @if($land && ($land->photo || $land->photo_2))
                                                <div class="col-12">
                                                    <div class="p-3 rounded-3 border bg-light bg-opacity-50">
                                                        <h6 class="fw-bold text-primary mb-3" style="font-size: 0.88rem;">
                                                            <i class="mdi mdi-camera me-1"></i> Dokumentasi Foto Lahan (Hasil Survey Fase 2)
                                                        </h6>
                                                        <div class="row g-3">
                                                            @if($land->photo)
                                                                <div class="col-12 col-md-6">
                                                                    <div class="position-relative rounded-2 overflow-hidden border shadow-sm" style="height: 180px; background: #000;">
                                                                        <img src="{{ asset($land->photo) }}" class="w-100 h-100" style="object-fit: cover;" alt="Foto Lahan 1">
                                                                        <span class="badge bg-dark bg-opacity-75 text-white position-absolute top-0 start-0 m-2" style="font-size: 11px;">Foto Lahan 1</span>
                                                                        <a href="{{ asset($land->photo) }}" target="_blank" class="btn btn-xs btn-light position-absolute bottom-0 end-0 m-2 shadow-sm" style="font-size: 11px;">
                                                                            <i class="mdi mdi-magnify me-1"></i> Lihat Penuh
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if($land->photo_2)
                                                                <div class="col-12 col-md-6">
                                                                    <div class="position-relative rounded-2 overflow-hidden border shadow-sm" style="height: 180px; background: #000;">
                                                                        <img src="{{ asset($land->photo_2) }}" class="w-100 h-100" style="object-fit: cover;" alt="Foto Lahan 2">
                                                                        <span class="badge bg-dark bg-opacity-75 text-white position-absolute top-0 start-0 m-2" style="font-size: 11px;">Foto Lahan 2</span>
                                                                        <a href="{{ asset($land->photo_2) }}" target="_blank" class="btn btn-xs btn-light position-absolute bottom-0 end-0 m-2 shadow-sm" style="font-size: 11px;">
                                                                            <i class="mdi mdi-magnify me-1"></i> Lihat Penuh
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                <!-- KEPUTUSAN SIDANG AKHIR -->
                                <div class="form-section">
                                    <div class="form-section-title">
                                        Hasil Sidang & Keputusan Direksi
                                        @if(!$isAdmin)
                                            <small class="text-muted d-block fw-normal" style="font-size: 0.75rem;">(Wewenang Direksi / Admin)</small>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Hasil Keputusan Sidang Akhir <span class="text-danger">*</span></label>
                                            <select class="form-select border-primary" id="fase3_status_akhir" name="status" {{ (!$isAdmin || ($land && ($land->status == 'approved' || $land->status == 'rejected'))) ? 'disabled' : '' }}>
                                                <option value="approved" {{ $land && $land->status == 'approved' ? 'selected' : '' }}>DIAMBIL - Deal untuk Diakuisisi (Masuk LandBank Utama)</option>
                                                <option value="pending" {{ $land && $land->status == 'pending' ? 'selected' : '' }}>DIPENDING - Ditunda Sementara (Negosiasi / Evaluasi Lanjutan)</option>
                                                <option value="rejected" {{ $land && $land->status == 'rejected' ? 'selected' : '' }}>DIBATALKAN - Gugur Prospeknya (Tidak Diambil)</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Skala Prioritas Akuisisi</label>
                                            <select class="form-select" name="prioritas" {{ (!$isAdmin || ($land && ($land->status == 'approved' || $land->status == 'rejected'))) ? 'disabled' : '' }}>
                                                <option value="urgent" {{ $land && $land->priority == 'urgent' ? 'selected' : '' }}>Urgent (Sangat Prioritas / Segera Diproses)</option>
                                                <option value="high" {{ $land && $land->priority == 'high' ? 'selected' : '' }}>High (Tinggi)</option>
                                                <option value="normal" {{ $land && ($land->priority == 'normal' || !$land->priority) ? 'selected' : '' }}>Normal</option>
                                                <option value="low" {{ $land && $land->priority == 'low' ? 'selected' : '' }}>Low (Rendah)</option>
                                            </select>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="form-label fw-bold">Catatan & Kesimpulan Keputusan Sidang</label>
                                            <textarea class="form-control" name="catatan" rows="3" placeholder="Masukkan ringkasan pertimbangan keputusan rapat, kesepakatan notaris, tanggal rencana akta pelepasan..." {{ (!$isAdmin || ($land && ($land->status == 'approved' || $land->status == 'rejected'))) ? 'disabled' : '' }}>{{ $land->notes ?? '' }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <!-- PROSES JADWAL & TRANSAKSI DI KANTOR NOTARIS -->
                                <div class="form-section">
                                    <div class="form-section-title d-flex justify-content-between align-items-center">
                                        <div>
                                            <i class="mdi mdi-bank me-1 text-primary"></i> Notaris Rekanan & Jadwal Tanda Tangan Akta Pelepasan
                                        </div>
                                        <span class="badge bg-soft-primary text-primary border border-primary-subtle py-1 px-3" style="font-size: 0.8rem;">
                                            <i class="mdi mdi-bank me-1"></i>Transaksi Notaris
                                        </span>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Pilih Notaris Rekanan (Master Data Notaris) <span class="text-danger">*</span></label>
                                            <select class="form-select select2-search" id="select_notaris_id" name="notaris_id" data-placeholder="Pilih Notaris Rekanan" style="width: 100%;" onchange="autoSaveNotaryInfo()" {{ ($isReadOnlyKeuangan || ($land && ($land->status == 'approved' || $land->status == 'rejected'))) ? 'disabled' : '' }}>
                                                <option value="">-- Pilih Notaris Rekanan --</option>
                                                @if(isset($notarisList))
                                                    @foreach($notarisList as $not)
                                                        <option value="{{ $not->id }}" {{ ($land && $land->notaris_id == $not->id) ? 'selected' : '' }}>
                                                            {{ $not->nama_notaris }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <small class="text-muted d-block mt-1" style="font-size: 0.75rem;">
                                                *Data tersimpan otomatis & diambil langsung dari menu Master Data Notaris.
                                            </small>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Jadwal Tanda Tangan Akta di Kantor Notaris</label>
                                            <input type="datetime-local" class="form-control" id="input_notary_appointment_date" name="notary_appointment_date" value="{{ $land && $land->notary_appointment_date ? \Carbon\Carbon::parse($land->notary_appointment_date)->format('Y-m-d\TH:i') : '' }}" onchange="autoSaveNotaryInfo()" onblur="autoSaveNotaryInfo()" {{ ($isReadOnlyKeuangan || ($land && ($land->status == 'approved' || $land->status == 'rejected'))) ? 'disabled' : '' }}>
                                            <small class="text-muted d-block mt-1" style="font-size: 0.75rem;">
                                                *Jadwal kehadiran para pihak tersimpan otomatis saat dipilih.
                                            </small>
                                        </div>
                                    </div>

                                    <!-- UPLOAD BERKAS TRANSAKSI NOTARIS (AJAX AUTO-UPLOAD) -->
                                    <div class="row g-3 mt-1">
                                        <!-- Kwitansi Bermaterai -->
                                        <div class="col-12 col-md-4">
                                            <div class="card border rounded-3 p-3 h-100 shadow-sm" id="notary_card_receipt_file" style="background: #ffffff; border-color: #e2e8f0 !important;">
                                                <div class="d-flex align-items-center justify-content-between mb-1">
                                                    <span class="fw-bold text-dark d-flex align-items-center gap-1" style="font-size: 0.86rem;">
                                                        <i class="mdi mdi-receipt text-purple" style="font-size: 1.1rem;"></i>
                                                        Kwitansi Pembayaran
                                                    </span>
                                                    <span id="badge_receipt_file" class="badge {{ $land && $land->receipt_file ? 'bg-success' : 'bg-light text-muted border' }}" style="font-size: 10px;">
                                                        <i class="mdi {{ $land && $land->receipt_file ? 'mdi-check-circle me-1' : 'mdi-clock-outline me-1' }}"></i>
                                                        {{ $land && $land->receipt_file ? 'Terunggah' : 'Belum Ada' }}
                                                    </span>
                                                </div>
                                                <small class="text-muted d-block mb-3" style="font-size: 0.74rem;">Bukti kwitansi bermaterai pembayaran di kantor Notaris</small>

                                                <div class="d-flex flex-column justify-content-end flex-grow-1" id="container_receipt_file">
                                                    @if($land && $land->receipt_file)
                                                        @php $cleanReceipt = str_replace('uploads/', '', $land->receipt_file); @endphp
                                                        <!-- State: Berkas Sudah Terunggah -->
                                                        <div class="p-2.5 px-3 rounded-3 mb-2" style="background: #f0fdf4; border: 1.5px solid #86efac;">
                                                            <div class="d-flex align-items-center gap-2 mb-2">
                                                                <div class="p-1.5 rounded-2 flex-shrink-0 bg-success bg-opacity-10 text-success">
                                                                    <i class="mdi mdi-file-check-outline" style="font-size: 1.25rem;"></i>
                                                                </div>
                                                                <div class="overflow-hidden flex-grow-1">
                                                                    <span class="d-block fw-bold text-success" style="font-size: 0.82rem; line-height: 1.2;">Kwitansi Terunggah</span>
                                                                    <small class="text-muted text-truncate d-block" style="font-size: 0.72rem;">{{ basename($land->receipt_file) }}</small>
                                                                </div>
                                                            </div>
                                                            <button type="button" class="btn btn-xs btn-success text-white py-1.5 px-3 d-flex align-items-center justify-content-center w-100 shadow-sm btn-preview-doc"
                                                                data-url="{{ route('dokumen.preview', ['path' => $cleanReceipt]) }}"
                                                                data-ext="{{ pathinfo($land->receipt_file, PATHINFO_EXTENSION) }}"
                                                                data-label="Kwitansi Pembayaran Bermaterai"
                                                                style="font-size: 0.78rem; font-weight: 600; border-radius: 6px;">
                                                                <i class="mdi mdi-eye me-1"></i>Lihat Kwitansi
                                                            </button>
                                                        </div>

                                                        @if(!$land || ($land && $land->status != 'approved' && $land->status != 'rejected'))
                                                            <div class="pratanah-file-upload-modern mb-1">
                                                                <input type="file" name="receipt_file" accept=".pdf,.jpg,.jpeg,.png" onchange="autoUploadNotaryDoc(this, 'receipt_file')">
                                                                <div class="pratanah-file-label-modern py-1.5 px-2" style="background: #f8fafc; border: 1px dashed #cbd5e1;">
                                                                    <i class="mdi mdi-cloud-sync" style="font-size: 1.1rem; color: #64748b;"></i>
                                                                    <div class="pratanah-file-info-modern">
                                                                        <span class="file-label-text text-secondary" style="font-size: 0.76rem; font-weight: 600;">Ganti Kwitansi / Upload Ulang</span>
                                                                        <span class="file-label-hint" style="font-size: 0.7rem;">PDF, JPG, PNG (Auto Upload)</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @else
                                                        @if(!$land || ($land && $land->status != 'approved' && $land->status != 'rejected'))
                                                            <div class="pratanah-file-upload-modern mb-1">
                                                                <input type="file" name="receipt_file" accept=".pdf,.jpg,.jpeg,.png" onchange="autoUploadNotaryDoc(this, 'receipt_file')">
                                                                <div class="pratanah-file-label-modern py-2.5 px-3">
                                                                    <i class="mdi mdi-cloud-upload" style="font-size: 1.35rem; color: #9a55ff;"></i>
                                                                    <div class="pratanah-file-info-modern">
                                                                        <span class="file-label-text fw-semibold" style="font-size: 0.8rem;">Pilih File Kwitansi</span>
                                                                        <span class="file-label-hint" style="font-size: 0.72rem;">PDF, JPG, PNG (Auto Upload)</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="p-3 text-center text-muted bg-light rounded-2 border" style="font-size: 0.8rem;">
                                                                <i class="mdi mdi-file-hidden me-1"></i>Belum ada berkas kwitansi
                                                            </div>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Pajak PPh -->
                                        <div class="col-12 col-md-4">
                                            <div class="card border rounded-3 p-3 h-100 shadow-sm" id="notary_card_tax_pph_file" style="background: #ffffff; border-color: #e2e8f0 !important;">
                                                <div class="d-flex align-items-center justify-content-between mb-1">
                                                    <span class="fw-bold text-dark d-flex align-items-center gap-1" style="font-size: 0.86rem;">
                                                        <i class="mdi mdi-file-certificate text-purple" style="font-size: 1.1rem;"></i>
                                                        Bukti Bayar PPh
                                                    </span>
                                                    <span id="badge_tax_pph_file" class="badge {{ $land && $land->tax_pph_file ? 'bg-success' : 'bg-light text-muted border' }}" style="font-size: 10px;">
                                                        <i class="mdi {{ $land && $land->tax_pph_file ? 'mdi-check-circle me-1' : 'mdi-clock-outline me-1' }}"></i>
                                                        {{ $land && $land->tax_pph_file ? 'Terunggah' : 'Belum Ada' }}
                                                    </span>
                                                </div>
                                                <small class="text-muted d-block mb-3" style="font-size: 0.74rem;">Bukti bayar PPh (ACC Direktur PT & NPWP Penjual)</small>

                                                <div class="d-flex flex-column justify-content-end flex-grow-1" id="container_tax_pph_file">
                                                    @if($land && $land->tax_pph_file)
                                                        @php $cleanPph = str_replace('uploads/', '', $land->tax_pph_file); @endphp
                                                        <!-- State: Berkas Sudah Terunggah -->
                                                        <div class="p-2.5 px-3 rounded-3 mb-2" style="background: #f0fdf4; border: 1.5px solid #86efac;">
                                                            <div class="d-flex align-items-center gap-2 mb-2">
                                                                <div class="p-1.5 rounded-2 flex-shrink-0 bg-success bg-opacity-10 text-success">
                                                                    <i class="mdi mdi-file-check-outline" style="font-size: 1.25rem;"></i>
                                                                </div>
                                                                <div class="overflow-hidden flex-grow-1">
                                                                    <span class="d-block fw-bold text-success" style="font-size: 0.82rem; line-height: 1.2;">Bukti PPh Terunggah</span>
                                                                    <small class="text-muted text-truncate d-block" style="font-size: 0.72rem;">{{ basename($land->tax_pph_file) }}</small>
                                                                </div>
                                                            </div>
                                                            <button type="button" class="btn btn-xs btn-success text-white py-1.5 px-3 d-flex align-items-center justify-content-center w-100 shadow-sm btn-preview-doc"
                                                                data-url="{{ route('dokumen.preview', ['path' => $cleanPph]) }}"
                                                                data-ext="{{ pathinfo($land->tax_pph_file, PATHINFO_EXTENSION) }}"
                                                                data-label="Bukti Pembayaran Pajak PPh"
                                                                style="font-size: 0.78rem; font-weight: 600; border-radius: 6px;">
                                                                <i class="mdi mdi-eye me-1"></i>Lihat Bukti PPh
                                                            </button>
                                                        </div>

                                                        @if(!$land || ($land && $land->status != 'approved' && $land->status != 'rejected'))
                                                            <div class="pratanah-file-upload-modern mb-1">
                                                                <input type="file" name="tax_pph_file" accept=".pdf,.jpg,.jpeg,.png" onchange="autoUploadNotaryDoc(this, 'tax_pph_file')">
                                                                <div class="pratanah-file-label-modern py-1.5 px-2" style="background: #f8fafc; border: 1px dashed #cbd5e1;">
                                                                    <i class="mdi mdi-cloud-sync" style="font-size: 1.1rem; color: #64748b;"></i>
                                                                    <div class="pratanah-file-info-modern">
                                                                        <span class="file-label-text text-secondary" style="font-size: 0.76rem; font-weight: 600;">Ganti Bukti PPh / Upload Ulang</span>
                                                                        <span class="file-label-hint" style="font-size: 0.7rem;">PDF, JPG, PNG (Auto Upload)</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @else
                                                        @if(!$land || ($land && $land->status != 'approved' && $land->status != 'rejected'))
                                                            <div class="pratanah-file-upload-modern mb-1">
                                                                <input type="file" name="tax_pph_file" accept=".pdf,.jpg,.jpeg,.png" onchange="autoUploadNotaryDoc(this, 'tax_pph_file')">
                                                                <div class="pratanah-file-label-modern py-2.5 px-3">
                                                                    <i class="mdi mdi-cloud-upload" style="font-size: 1.35rem; color: #9a55ff;"></i>
                                                                    <div class="pratanah-file-info-modern">
                                                                        <span class="file-label-text fw-semibold" style="font-size: 0.8rem;">Pilih Bukti PPh</span>
                                                                        <span class="file-label-hint" style="font-size: 0.72rem;">PDF, JPG, PNG (Auto Upload)</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="p-3 text-center text-muted bg-light rounded-2 border" style="font-size: 0.8rem;">
                                                                <i class="mdi mdi-file-hidden me-1"></i>Belum ada berkas PPh
                                                            </div>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Salinan Akta Pelepasan -->
                                        <div class="col-12 col-md-4">
                                            <div class="card border rounded-3 p-3 h-100 shadow-sm" id="notary_card_release_deed_file" style="background: #ffffff; border-color: #e2e8f0 !important;">
                                                <div class="d-flex align-items-center justify-content-between mb-1">
                                                    <span class="fw-bold text-dark d-flex align-items-center gap-1" style="font-size: 0.86rem;">
                                                        <i class="mdi mdi-file-sign text-purple" style="font-size: 1.1rem;"></i>
                                                        Akta Pelepasan Hak
                                                    </span>
                                                    <span id="badge_release_deed_file" class="badge {{ $land && $land->release_deed_file ? 'bg-success' : 'bg-light text-muted border' }}" style="font-size: 10px;">
                                                        <i class="mdi {{ $land && $land->release_deed_file ? 'mdi-check-circle me-1' : 'mdi-clock-outline me-1' }}"></i>
                                                        {{ $land && $land->release_deed_file ? 'Terunggah' : 'Belum Ada' }}
                                                    </span>
                                                </div>
                                                <small class="text-muted d-block mb-3" style="font-size: 0.74rem;">Salinan Akta Pelepasan Hak resmi selesai dari Notaris</small>

                                                <div class="d-flex flex-column justify-content-end flex-grow-1" id="container_release_deed_file">
                                                    @if($land && $land->release_deed_file)
                                                        @php $cleanDeed = str_replace('uploads/', '', $land->release_deed_file); @endphp
                                                        <!-- State: Berkas Sudah Terunggah -->
                                                        <div class="p-2.5 px-3 rounded-3 mb-2" style="background: #f0fdf4; border: 1.5px solid #86efac;">
                                                            <div class="d-flex align-items-center gap-2 mb-2">
                                                                <div class="p-1.5 rounded-2 flex-shrink-0 bg-success bg-opacity-10 text-success">
                                                                    <i class="mdi mdi-file-check-outline" style="font-size: 1.25rem;"></i>
                                                                </div>
                                                                <div class="overflow-hidden flex-grow-1">
                                                                    <span class="d-block fw-bold text-success" style="font-size: 0.82rem; line-height: 1.2;">Akta Notaris Terunggah</span>
                                                                    <small class="text-muted text-truncate d-block" style="font-size: 0.72rem;">{{ basename($land->release_deed_file) }}</small>
                                                                </div>
                                                            </div>
                                                            <button type="button" class="btn btn-xs btn-success text-white py-1.5 px-3 d-flex align-items-center justify-content-center w-100 shadow-sm btn-preview-doc"
                                                                data-url="{{ route('dokumen.preview', ['path' => $cleanDeed]) }}"
                                                                data-ext="{{ pathinfo($land->release_deed_file, PATHINFO_EXTENSION) }}"
                                                                data-label="Salinan Akta Pelepasan Hak"
                                                                style="font-size: 0.78rem; font-weight: 600; border-radius: 6px;">
                                                                <i class="mdi mdi-eye me-1"></i>Lihat Akta Pelepasan
                                                            </button>
                                                        </div>

                                                        @if(!$land || ($land && $land->status != 'approved' && $land->status != 'rejected'))
                                                            <div class="pratanah-file-upload-modern mb-1">
                                                                <input type="file" name="release_deed_file" accept=".pdf,.jpg,.jpeg,.png" onchange="autoUploadNotaryDoc(this, 'release_deed_file')">
                                                                <div class="pratanah-file-label-modern py-1.5 px-2" style="background: #f8fafc; border: 1px dashed #cbd5e1;">
                                                                    <i class="mdi mdi-cloud-sync" style="font-size: 1.1rem; color: #64748b;"></i>
                                                                    <div class="pratanah-file-info-modern">
                                                                        <span class="file-label-text text-secondary" style="font-size: 0.76rem; font-weight: 600;">Ganti Akta / Upload Ulang</span>
                                                                        <span class="file-label-hint" style="font-size: 0.7rem;">PDF, JPG, PNG (Auto Upload)</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @else
                                                        @if(!$land || ($land && $land->status != 'approved' && $land->status != 'rejected'))
                                                            <div class="pratanah-file-upload-modern mb-1">
                                                                <input type="file" name="release_deed_file" accept=".pdf,.jpg,.jpeg,.png" onchange="autoUploadNotaryDoc(this, 'release_deed_file')">
                                                                <div class="pratanah-file-label-modern py-2.5 px-3">
                                                                    <i class="mdi mdi-cloud-upload" style="font-size: 1.35rem; color: #9a55ff;"></i>
                                                                    <div class="pratanah-file-info-modern">
                                                                        <span class="file-label-text fw-semibold" style="font-size: 0.8rem;">Pilih Akta Pelepasan</span>
                                                                        <span class="file-label-hint" style="font-size: 0.72rem;">PDF, JPG, PNG (Auto Upload)</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="p-3 text-center text-muted bg-light rounded-2 border" style="font-size: 0.8rem;">
                                                                <i class="mdi mdi-file-hidden me-1"></i>Belum ada salinan akta
                                                            </div>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- RINGKASAN DOKUMEN LEGALITAS DARI FASE 1 (READ-ONLY) -->
                                <div class="form-section">
                                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
                                        <div>
                                            <div class="form-section-title mb-0">
                                                Ringkasan Dokumen Legalitas (Hasil Validasi Fase 1)
                                            </div>
                                            <small class="text-muted" style="font-size: 0.78rem;">Seluruh berkas legalitas berikut disyaratkan untuk kategori <strong class="text-primary" id="fase3CategoryLabel">{{ $selectedCat }}</strong> dan telah diverifikasi sah pada Fase 1.</small>
                                        </div>
                                        <span class="badge bg-soft-success text-success border border-success-subtle py-1 px-3" style="font-size: 0.8rem; font-weight: 600;">
                                            <i class="mdi mdi-shield-check me-1"></i> Legalitas Terverifikasi Sah
                                        </span>
                                    </div>

                                    <!-- GRID RINGKASAN DOKUMEN FASE 3 (READ-ONLY) -->
                                    <div class="row g-3 mb-2" id="fase3DocumentGridContainer">
                                        @foreach($documentTypes as $doc)
                                            @php
                                                $docCategories = $doc->applicable_categories ?? [];
                                                $isApplicable = empty($docCategories) || in_array($selectedCat, $docCategories);
                                                $existingDoc = $uploadedDocs[$doc->id] ?? null;
                                                $hasExistingFile = ($existingDoc && !empty($existingDoc->file_path));
                                                $cleanPath = $hasExistingFile ? str_replace('uploads/', '', $existingDoc->file_path) : null;
                                                $docPhysStatus = $existingDoc->document_status ?? 'ada';
                                            @endphp
                                            <div class="col-md-6 col-lg-4 doc-fase3-col {{ !$isApplicable ? 'd-none' : '' }}" data-categories='@json($docCategories)' data-doc-id="{{ $doc->id }}">
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

                                @if(!$isStaffLegal || $isAdmin)
                                    <!-- ASPEK LEGALITAS & BIAYA TRANSAKSI -->
                                    <div class="form-section">
                                        <div class="form-section-title d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2">
                                            <div>
                                                Aspek Legalitas, Pajak & Biaya Administrasi
                                                @if(!$canEditFinancial)
                                                    <small class="text-muted d-block fw-normal" style="font-size: 0.75rem;">(Diinput oleh Divisi Keuangan / Admin)</small>
                                                @endif
                                            </div>
                                            @if ($canEditFinancial && (!$land || ($land && $land->status != 'approved' && $land->status != 'rejected')))
                                                <button type="button" class="btn btn-sm btn-gradient-primary py-1 px-3 shadow-sm d-inline-flex align-items-center gap-1 text-white text-nowrap flex-shrink-0" onclick="addCustomCostRow()" style="font-size: 0.8rem; font-weight: 600; border-radius: 6px; white-space: nowrap;">
                                                    <i class="mdi mdi-plus-circle me-1" style="font-size: 1rem;"></i> Tambah Biaya Admin / Lainnya
                                                </button>
                                            @endif
                                        </div>
                                        
                                        <!-- Estimasi Biaya Transaksi Standard -->
                                        <div class="row mb-2">
                                            <div class="col-md-3 mb-2">
                                                <label class="form-label text-muted fw-semibold" style="font-size: 0.82rem;">Biaya IJB / PPJB Notaris</label>
                                                <input type="text" class="form-control cost-input" name="biaya_ijb_temp" data-cost-name="Biaya IJB / PPJB Notaris" value="{{ $land && $land->cost_ijb ? number_format($land->cost_ijb, 0, ',', '.') : '' }}" placeholder="Contoh: 10.000.000" onkeyup="formatRupiahTemp(this); updateFinancialSummary();" {{ (!$canEditFinancial || ($land && ($land->status == 'approved' || $land->status == 'rejected'))) ? 'disabled' : '' }}>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <label class="form-label text-muted fw-semibold" style="font-size: 0.82rem;">Estimasi Pajak PPh/BPHTB</label>
                                                <input type="text" class="form-control cost-input" name="biaya_pajak_temp" data-cost-name="Estimasi Pajak (PPh & BPHTB)" value="{{ $land && $land->cost_tax ? number_format($land->cost_tax, 0, ',', '.') : '' }}" placeholder="Contoh: 50.000.000" onkeyup="formatRupiahTemp(this); updateFinancialSummary();" {{ (!$canEditFinancial || ($land && ($land->status == 'approved' || $land->status == 'rejected'))) ? 'disabled' : '' }}>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <label class="form-label text-muted fw-semibold" style="font-size: 0.82rem;">Fee Makelar / Perantara</label>
                                                <input type="text" class="form-control cost-input" name="fee_makelar_temp" data-cost-name="Fee Makelar / Perantara" value="{{ $land && $land->cost_broker ? number_format($land->cost_broker, 0, ',', '.') : '' }}" placeholder="Contoh: 15.000.000" onkeyup="formatRupiahTemp(this); updateFinancialSummary();" {{ (!$canEditFinancial || ($land && ($land->status == 'approved' || $land->status == 'rejected'))) ? 'disabled' : '' }}>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <label class="form-label text-muted fw-semibold" style="font-size: 0.82rem;">Biaya Lain-lain</label>
                                                <input type="text" class="form-control cost-input" name="biaya_lain_temp" data-cost-name="Biaya Lain-lain Admin" value="{{ $land && $land->cost_other ? number_format($land->cost_other, 0, ',', '.') : '' }}" placeholder="Contoh: 5.000.000" onkeyup="formatRupiahTemp(this); updateFinancialSummary();" {{ (!$canEditFinancial || ($land && ($land->status == 'approved' || $land->status == 'rejected'))) ? 'disabled' : '' }}>
                                            </div>
                                        </div>

                                        <!-- Dynamic Custom Extra Costs Container -->
                                        <div id="custom_costs_container" class="row g-2 mb-3"></div>
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
                                                <div class="col-12 col-sm-6 col-xl-3">
                                                    <label class="form-label fw-semibold text-dark" style="font-size: 0.82rem;">
                                                        Tipe Pembayaran <span class="text-danger">*</span>
                                                    </label>
                                                    <select name="cash_payment_type" id="cash_payment_type" class="form-select border-primary fw-semibold" onchange="toggleCashChannelFields()" {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                        <option value="transfer" {{ (!$cashPayment || $cashPayment->payment_type == 'transfer' || !$cashPayment->payment_type) ? 'selected' : '' }}>Transfer Bank</option>
                                                        <option value="cash" {{ ($cashPayment && $cashPayment->payment_type == 'cash') ? 'selected' : '' }}>Tunai / Cash Langsung</option>
                                                    </select>
                                                </div>

                                                <!-- Nominal Pelunasan (Otomatis Ikut Grand Total) -->
                                                <div class="col-12 col-sm-6 col-xl-3">
                                                    <label class="form-label fw-semibold text-dark" style="font-size: 0.82rem;">
                                                        Nominal Pelunasan (Grand Total) <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" class="form-control fw-bold border-success text-dark" id="cash_amount_input" name="cash_amount_temp" 
                                                        value="Rp {{ number_format($cashPayment ? $cashPayment->amount : $initialGrandTotal, 0, ',', '.') }}" 
                                                        placeholder="Rp 0" onkeyup="formatRupiahTemp(this); updateFinancialSummary();" 
                                                        {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                </div>

                                                <!-- Tanggal Pelunasan -->
                                                <div class="col-12 col-sm-6 col-xl-3">
                                                    <label class="form-label fw-semibold text-dark" style="font-size: 0.82rem;">
                                                        Tanggal Realisasi / Bayar <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="date" class="form-control" name="cash_payment_date" 
                                                        value="{{ $cashPayment && $cashPayment->due_date ? \Carbon\Carbon::parse($cashPayment->due_date)->format('Y-m-d') : date('Y-m-d') }}" 
                                                        {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                </div>

                                                <!-- Status Pembayaran -->
                                                <div class="col-12 col-sm-6 col-xl-3">
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
                                                <div class="col-12 col-sm-6 col-md-4">
                                                    <label class="form-label fw-semibold text-dark" style="font-size: 0.82rem;">
                                                        Nama Bank Penerima / Tujuan
                                                    </label>
                                                    <input type="text" class="form-control form-control-sm" name="cash_bank_name" 
                                                        value="{{ $cashPayment->bank_name ?? '' }}" 
                                                        placeholder="Contoh: BCA / Mandiri / BRI / BNI" 
                                                        {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                </div>

                                                <!-- Nomor Rekening -->
                                                <div class="col-12 col-sm-6 col-md-4">
                                                    <label class="form-label fw-semibold text-dark" style="font-size: 0.82rem;">
                                                        Nomor Rekening Penerima
                                                    </label>
                                                    <input type="text" class="form-control form-control-sm" name="cash_account_number" 
                                                        value="{{ $cashPayment->account_number ?? '' }}" 
                                                        placeholder="Contoh: 1234567890" 
                                                        {{ $land && ($land->status == 'approved' || $land->status == 'rejected') ? 'disabled' : '' }}>
                                                </div>

                                                <!-- Atas Nama Rekening -->
                                                <div class="col-12 col-sm-6 col-md-4">
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
                                @else
                                    <div class="alert alert-soft-secondary border py-3 px-3 mb-4 rounded-3 d-flex align-items-center gap-2" style="background: #f8fafc; font-size: 0.85rem; border-color: #e2e8f0 !important;">
                                        <i class="mdi mdi-shield-lock-outline fs-4 text-purple" style="color: #9a55ff;"></i>
                                        <div>
                                            <strong class="text-dark">Form Keuangan & Pembayaran Dikelola Terpisah</strong><br>
                                            <span class="text-muted">Sebagai Staff Legal, fokus utama Anda adalah input dan verifikasi berkas dokumen legalitas pada Fase 1. Pengelolaan biaya transaksi, skema pembayaran, dan realisasi termin ditangani secara khusus oleh Divisi Keuangan & Manajemen.</span>
                                        </div>
                                    </div>
                                @endif

                                <!-- ACTIONS -->
                                <div class="d-flex justify-content-between align-items-center gap-3 mt-4 footer-action-row">
                                    <div>
                                        <button type="button" class="btn btn-outline-purple btn-action-mobile" onclick="switchStep(2)">
                                            <i class="mdi mdi-arrow-left-circle me-1"></i> Kembali ke Fase 2
                                        </button>
                                    </div>
                                    <div class="d-flex gap-2">
                                        @if ($land && ($isAdmin || $isKeuangan))
                                            <button type="button" class="btn btn-outline-purple py-2 px-3 shadow-sm" onclick="previewInvoice()">
                                                <i class="mdi mdi-printer me-1"></i> Cetak / Pratinjau Invoice
                                            </button>
                                        @endif
                                        @if ($isAdmin)
                                            @if ($land && $land->status == 'approved')
                                                <button type="button" class="btn btn-gradient-warning py-2 px-4 shadow-sm" onclick="saveFase3()">
                                                    <i class="mdi mdi-cash-check me-1"></i> Update Keputusan & Transaksi
                                                </button>
                                            @elseif (!$land || ($land && $land->status != 'approved' && $land->status != 'rejected'))
                                                <button type="button" class="btn btn-gradient-success py-2 px-4 shadow-sm" onclick="saveFase3()">
                                                    <i class="mdi mdi-content-save-all me-1"></i> Simpan Keputusan Sidang (Admin)
                                                </button>
                                            @endif
                                        @elseif ($isKeuangan)
                                            <button type="button" class="btn btn-gradient-success py-2 px-4 shadow-sm" onclick="saveFase3()">
                                                <i class="mdi mdi-cash-register me-1"></i> Simpan & Update Data Keuangan
                                            </button>
                                        @endif
                                        @if($land)
                                            <button type="button" class="btn btn-gradient-primary py-2 px-3 shadow-sm d-inline-flex align-items-center gap-1" onclick="switchStep(4)">
                                                <span>Lanjut ke Fase 4 (Balik Nama PT)</span> <i class="mdi mdi-arrow-right-circle ms-1"></i>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- ================= FASE 4 CONTAINER (PENGURUSAN DOKUMEN BALIK NAMA & PENGINDUKAN AN. PT - DINAMIS) ================= -->
                <div id="containerFase4" class="d-none">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white py-3 d-flex flex-wrap justify-content-between align-items-center gap-2">
                            <div>
                                <h5 class="card-title mb-0" style="font-weight: 700; color: #2c2e3f;">
                                    FASE 4: Pengurusan Dokumen Balik Nama / Pengindukan an. PT
                                </h5>
                                <small class="text-muted" style="font-size: 0.8rem;">
                                    Tahapan pengurusan dokumen legalitas wilayah (Poin 7–17), perizinan teknis BPN, perizinan PKKPR OSS RBA, validasi perpajakan, form dokumen dinamis hingga penerbitan SHGB Induk an. PT dan migrasi ke Pasca Land Bank.
                                </small>
                            </div>
                            <div class="d-flex flex-wrap align-items-center gap-2 fase4-actions-top">
                                <button type="button" class="btn btn-sm btn-fase4-add shadow-sm" onclick="openFase4DocModal()">
                                    <i class="mdi mdi-plus-circle-outline fs-6"></i> <span>+ Tambah Dokumen Lapangan</span>
                                </button>
                                <button type="button" class="btn btn-sm btn-fase4-master shadow-sm" onclick="openMasterPickerModal()">
                                    <i class="mdi mdi-file-certificate-outline fs-6"></i> <span>+ Pilih dari Master Perizinan</span>
                                </button>
                                <button type="button" class="btn btn-sm btn-fase4-template shadow-sm" onclick="loadFase4DefaultTemplate()" title="Muat paket template default">
                                    <i class="mdi mdi-clipboard-text-play-outline fs-6"></i> <span>Gunakan Template (Poin 7–17)</span>
                                </button>
                                @if($land && $land->land_bank_id)
                                    <a href="{{ route('properti-all') }}" class="btn btn-sm btn-success text-white py-1.5 px-3 rounded-2 shadow-sm d-inline-flex align-items-center gap-1" style="font-size: 0.82rem; font-weight: 600;">
                                        <i class="mdi mdi-check-decagram"></i> Lahan Telah Masuk Pasca Land Bank #{{ $land->land_bank_id }}
                                    </a>
                                @else
                                    <span class="badge {{ ($land && $land->hgb_process_status == 'completed_hgb_induk') ? 'bg-success' : 'bg-soft-primary text-primary border border-primary-subtle' }} py-1.5 px-3 rounded-2" style="font-size: 0.82rem; font-weight: 600;">
                                        <i class="mdi {{ ($land && $land->hgb_process_status == 'completed_hgb_induk') ? 'mdi-check-all' : 'mdi-progress-clock' }} me-1"></i>
                                        {{ ($land && $land->hgb_process_status == 'completed_hgb_induk') ? 'SHGB Induk Terbit' : 'Dalam Proses Pengindukan' }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            @php
                                $workflowDocs = ($land && is_array($land->custom_workflow_docs)) ? $land->custom_workflow_docs : [];
                                $totalWorkflowDocs = count($workflowDocs);
                                $terbitCount = 0;
                                $prosesCount = 0;
                                $belumCount = 0;
                                foreach ($workflowDocs as $wd) {
                                    $st = $wd['status'] ?? 'belum';
                                    if ($st === 'terbit' || $st === 'selesai' || !empty($wd['file_path'])) {
                                        $terbitCount++;
                                    } elseif ($st === 'proses' || !empty($wd['doc_number'])) {
                                        $prosesCount++;
                                    } else {
                                        $belumCount++;
                                    }
                                }
                                $progressWorkflowPercent = $totalWorkflowDocs > 0 ? round(($terbitCount / $totalWorkflowDocs) * 100) : 0;
                            @endphp

                            <!-- RINGKASAN DATA LAHAN (INFO BANNER) -->
                            @if($land)
                                <div class="p-3 rounded-3 mb-3" style="background: linear-gradient(135deg, #fbf9ff, #f6f0ff); border: 1px solid rgba(154, 85, 255, 0.2);">
                                    <div class="row g-3 align-items-center">
                                        <div class="col-12 col-md-3">
                                            <small class="text-muted d-block" style="font-size: 0.74rem;">Nama Lahan / Prospek</small>
                                            <strong class="text-dark" style="font-size: 0.92rem;">{{ $land->land_name }}</strong>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <small class="text-muted d-block" style="font-size: 0.74rem;">Pemilik Awal (Alas Hak)</small>
                                            <span class="fw-semibold text-dark" style="font-size: 0.88rem;">{{ $land->owner_name ?? ($land->certificate_owner ?? '-') }}</span>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <small class="text-muted d-block" style="font-size: 0.74rem;">Notaris Rekanan Transaksi</small>
                                            <span class="fw-semibold text-primary" style="font-size: 0.88rem;">
                                                <i class="mdi mdi-bank me-1"></i>{{ $land->notaris ? $land->notaris->nama_notaris : ($land->notaris_id ? 'Notaris #' . $land->notaris_id : 'Belum Ditentukan') }}
                                            </span>
                                        </div>
                                        <div class="col-12 col-md-3 text-md-end">
                                            <small class="text-muted d-block" style="font-size: 0.74rem;">Total Luas Lahan Awal</small>
                                            <span class="badge bg-purple text-white px-2.5 py-1.5 rounded-2" style="background: #9a55ff; font-size: 0.85rem;">{{ number_format($land->area ?? 0, 0, ',', '.') }} m²</span>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- PROGRESS BAR & STATISTIK DOKUMEN FASE 4 -->
                            <div class="p-3 rounded-3 mb-4 bg-white border shadow-sm">
                                <div class="row align-items-center g-3">
                                    <div class="col-12 col-md-5">
                                        <div class="d-flex justify-content-between align-items-center mb-1.5">
                                            <span class="fw-bold text-dark" style="font-size: 0.84rem;">
                                                <i class="mdi mdi-chart-donut text-primary me-1"></i> Progres Dokumen Pengindukan:
                                            </span>
                                            <span class="fw-bold text-success" id="fase4_progress_text" style="font-size: 0.84rem;">
                                                {{ $terbitCount }} dari {{ $totalWorkflowDocs }} Selesai ({{ $progressWorkflowPercent }}%)
                                            </span>
                                        </div>
                                        <div class="progress" style="height: 8px; border-radius: 6px; background-color: #f1f5f9;">
                                            <div id="fase4_progress_bar" class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{ $progressWorkflowPercent }}%;"></div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-7">
                                        <div class="d-flex flex-wrap align-items-center justify-content-md-end gap-2">
                                            <div class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2.5 py-1.5 rounded-2 d-flex align-items-center gap-1.5" style="font-size: 0.78rem;">
                                                <i class="mdi mdi-check-circle"></i>
                                                <span id="stat_terbit">{{ $terbitCount }} Selesai / Terbit</span>
                                            </div>
                                            <div class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 px-2.5 py-1.5 rounded-2 d-flex align-items-center gap-1.5" style="font-size: 0.78rem;">
                                                <i class="mdi mdi-clock-outline"></i>
                                                <span id="stat_proses">{{ $prosesCount }} Dalam Proses</span>
                                            </div>
                                            <div class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25 px-2.5 py-1.5 rounded-2 d-flex align-items-center gap-1.5" style="font-size: 0.78rem;">
                                                <i class="mdi mdi-alert-circle-outline"></i>
                                                <span id="stat_belum">{{ $belumCount }} Belum Ada</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- MODERN SEGMENTED FILTER TABS & SEARCH BAR -->
                            <div class="fase4-tab-wrapper d-flex flex-wrap justify-content-between align-items-center gap-2.5 mb-4 p-2.5 bg-white rounded-3 border shadow-sm">
                                <div class="fase4-tab-nav" role="tablist">
                                    <button type="button" class="fase4-tab-item active fase4-filter-btn" data-status="all" onclick="filterFase4Docs('all', this)">
                                        <i class="mdi mdi-view-grid-outline"></i>
                                        <span>Semua Dokumen</span>
                                        <span class="fase4-tab-count" id="count_all">{{ $totalWorkflowDocs }}</span>
                                    </button>
                                    <button type="button" class="fase4-tab-item fase4-filter-btn" data-status="terbit" onclick="filterFase4Docs('terbit', this)">
                                        <i class="mdi mdi-check-decagram text-success"></i>
                                        <span>Selesai / Terbit</span>
                                        <span class="fase4-tab-count" id="count_terbit">{{ $terbitCount }}</span>
                                    </button>
                                    <button type="button" class="fase4-tab-item fase4-filter-btn" data-status="proses" onclick="filterFase4Docs('proses', this)">
                                        <i class="mdi mdi-progress-clock text-warning"></i>
                                        <span>Dalam Proses</span>
                                        <span class="fase4-tab-count" id="count_proses">{{ $prosesCount }}</span>
                                    </button>
                                    <button type="button" class="fase4-tab-item fase4-filter-btn" data-status="belum" onclick="filterFase4Docs('belum', this)">
                                        <i class="mdi mdi-alert-circle-outline text-secondary"></i>
                                        <span>Belum Ada</span>
                                        <span class="fase4-tab-count" id="count_belum">{{ $belumCount }}</span>
                                    </button>
                                </div>
                                <div class="fase4-search-wrapper" style="min-width: 260px;">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text bg-light border-end-0 text-muted" style="border-radius: 6px 0 0 6px;"><i class="mdi mdi-magnify"></i></span>
                                        <input type="text" class="form-control border-start-0 bg-light" id="searchFase4Input" placeholder="Cari nama izin, instansi, nomor..." onkeyup="searchFase4Docs(this.value)" style="border-radius: 0 6px 6px 0;">
                                    </div>
                                </div>
                            </div>

                            <!-- DYNAMIC REPEATER LIST / GRID OF FASE 4 DOCUMENTS -->
                            <div id="fase4_docs_container" class="row g-3 mb-4">
                                @forelse($workflowDocs as $doc)
                                    @php
                                        $docId = $doc['id'] ?? ('doc_' . uniqid());
                                        $poinLabel = $doc['poin_label'] ?? 'Dokumen';
                                        $docName = $doc['doc_name'] ?? 'Dokumen Pengindukan';
                                        $instansi = $doc['instansi'] ?? '-';
                                        $docNumber = $doc['doc_number'] ?? '';
                                        $docDate = !empty($doc['doc_date']) ? \Carbon\Carbon::parse($doc['doc_date'])->format('Y-m-d') : '';
                                        $docDateDisplay = !empty($doc['doc_date']) ? \Carbon\Carbon::parse($doc['doc_date'])->format('d M Y') : '-';
                                        $filePath = $doc['file_path'] ?? null;
                                        $cleanPath = $filePath ? str_replace('uploads/', '', $filePath) : null;
                                        $status = $doc['status'] ?? ($filePath ? 'terbit' : (!empty($docNumber) ? 'proses' : 'belum'));
                                        $isTemplate = !empty($doc['is_template']);
                                        $isFinalGoal = !empty($doc['is_final_goal']) || $docId === 'template_shgb_induk' || str_contains(strtolower($docName), 'shgb induk');
                                        $nominal = $doc['nominal'] ?? null;
                                        $luas = $doc['luas'] ?? null;
                                        $notes = $doc['notes'] ?? '';

                                        $badgeStatusStyle = match($status) {
                                            'terbit', 'selesai' => 'background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0;',
                                            'proses' => 'background: #fef3c7; color: #b45309; border: 1px solid #fde68a;',
                                            'ditolak' => 'background: #fee2e2; color: #b91c1c; border: 1px solid #fecaca;',
                                            default => 'background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1;',
                                        };
                                        $badgeStatusText = match($status) {
                                            'terbit', 'selesai' => 'Selesai / Terbit',
                                            'proses' => 'Sedang Proses',
                                            'ditolak' => 'Ditolak / Revisi',
                                            default => 'Belum Ada',
                                        };
                                        $badgeStatusIcon = match($status) {
                                            'terbit', 'selesai' => 'mdi-check-circle',
                                            'proses' => 'mdi-clock-fast',
                                            'ditolak' => 'mdi-close-circle',
                                            default => 'mdi-minus-circle-outline',
                                        };

                                        $syaratDokumen = $doc['syarat_dokumen'] ?? '';
                                        $syaratItems = $doc['syarat_items'] ?? [];
                                        $syaratChecklist = (array)($doc['syarat_checklist'] ?? []);
                                        $syaratFiles = (array)($doc['syarat_files'] ?? []);

                                        if (empty($syaratItems) && !empty($syaratDokumen)) {
                                            $lines = preg_split('/[\r\n]+/', $syaratDokumen);
                                            foreach ($lines as $line) {
                                                $clean = trim(preg_replace('/^[•\-\*\d+\.]\s*/u', '', trim($line)));
                                                if (!empty($clean)) {
                                                    $syaratItems[] = $clean;
                                                }
                                            }
                                        }
                                        $totalSyarat = count($syaratItems);
                                        $checkedCount = 0;
                                        foreach ($syaratItems as $idx => $si) {
                                            $hasItemFile = !empty($syaratFiles[$si]) || !empty($syaratFiles[$idx]);
                                            if (in_array($si, $syaratChecklist) || $hasItemFile) {
                                                $checkedCount++;
                                            }
                                        }
                                        $isAllSyaratReady = ($totalSyarat > 0 && $checkedCount >= $totalSyarat);
                                    @endphp
                                    <div class="col-12 col-md-6 col-lg-4 fase4-doc-card" 
                                         id="fase4_doc_card_{{ $docId }}"
                                         data-id="{{ $docId }}" 
                                         data-poin="{{ $poinLabel }}"
                                         data-name="{{ $docName }}"
                                         data-instansi="{{ $instansi }}"
                                         data-number="{{ $docNumber }}"
                                         data-date="{{ $docDate }}"
                                         data-nominal="{{ $nominal }}"
                                         data-luas="{{ $luas }}"
                                         data-notes="{{ $notes }}"
                                         data-status="{{ $status }}" 
                                         data-istemplate="{{ $isTemplate ? '1' : '0' }}"
                                         data-search="{{ strtolower($docName . ' ' . $instansi . ' ' . $docNumber . ' ' . $poinLabel . ' ' . $notes) }}">
                                        
                                        <div class="fase4-card-inner {{ $isFinalGoal ? 'is-final-goal' : '' }}">
                                            
                                            <!-- CARD HEADER (POIN & STATUS) -->
                                            <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                                                <div class="d-flex align-items-center gap-1.5">
                                                    <span class="badge {{ $isFinalGoal ? 'bg-success' : 'bg-primary' }} fase4-card-poin">{{ $poinLabel }}</span>
                                                    @if($isFinalGoal)
                                                        <span class="badge bg-warning text-dark fase4-badge-goal">GOL AKHIR</span>
                                                    @endif
                                                </div>
                                                <span class="badge badge-doc-status" style="{{ $badgeStatusStyle }}">
                                                    <i class="mdi {{ $badgeStatusIcon }}"></i> {{ $badgeStatusText }}
                                                </span>
                                            </div>

                                            <!-- CARD TITLE & INSTANSI -->
                                            <div class="mb-2">
                                                <h6 class="fase4-card-title mb-1" title="{{ $docName }}">
                                                    {{ $docName }}
                                                </h6>
                                                <small class="fase4-card-instansi d-block" title="{{ $instansi }}">
                                                    <i class="mdi mdi-office-building text-primary me-1"></i>{{ $instansi }}
                                                </small>
                                            </div>

                                            <!-- META INFO PANEL (No Reg, Tanggal, Nominal, Luas) -->
                                            <div class="fase4-card-meta">
                                                <div class="fase4-meta-row">
                                                    <span class="fase4-meta-label"><i class="mdi mdi-pound text-muted"></i>No. Dok/Reg:</span>
                                                    <span class="fase4-meta-value text-truncate doc-card-number" style="max-width: 55%;" title="{{ $docNumber ?: '-' }}">{{ $docNumber ?: '-' }}</span>
                                                </div>
                                                <div class="fase4-meta-row">
                                                    <span class="fase4-meta-label"><i class="mdi mdi-calendar-blank-outline text-muted"></i>Tanggal:</span>
                                                    <span class="fase4-meta-value doc-card-date">{{ $docDateDisplay }}</span>
                                                </div>
                                                @if(!empty($nominal) || !empty($luas))
                                                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 pt-1.5 mt-1.5 border-top">
                                                        @if(!empty($nominal))
                                                            <span class="badge rounded-1 px-2 py-1" style="background: rgba(154, 85, 255, 0.1); color: #7e22ce; font-size: 0.72rem; font-weight: 600;">
                                                                <i class="mdi mdi-cash-multiple me-1"></i>Rp {{ number_format($nominal, 0, ',', '.') }}
                                                            </span>
                                                        @endif
                                                        @if(!empty($luas))
                                                            <span class="badge rounded-1 px-2 py-1" style="background: rgba(14, 165, 233, 0.1); color: #0369a1; font-size: 0.72rem; font-weight: 600;">
                                                                <i class="mdi mdi-texture-box me-1"></i>{{ number_format($luas, 0, ',', '.') }} m²
                                                            </span>
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>

                                            @if(!empty($notes))
                                                <div class="p-1.5 rounded-2 bg-light border text-muted text-truncate mb-2 doc-card-notes" style="font-size: 0.72rem;" title="{{ $notes }}">
                                                    <i class="mdi mdi-information-outline me-1 text-primary"></i>{{ $notes }}
                                                </div>
                                            @endif

                                            <!-- PRASYARAT BERKAS (Flex-grow to balance height) -->
                                            <div class="fase4-syarat-box">
                                                <div class="d-flex align-items-center justify-content-between mb-1">
                                                    <span class="fw-bold" style="font-size: 0.73rem; color: {{ $isAllSyaratReady ? '#166534' : '#475569' }};">
                                                        <i class="mdi {{ $isAllSyaratReady ? 'mdi-checkbox-marked-circle text-success' : 'mdi-format-list-checks text-primary' }} me-1"></i>
                                                        Prasyarat Berkas:
                                                    </span>
                                                    <span class="badge {{ $isAllSyaratReady ? 'bg-success text-white' : ($checkedCount > 0 ? 'bg-warning text-dark' : 'bg-secondary text-white') }} fase4-badge-syarat">
                                                        {{ $checkedCount }}/{{ $totalSyarat }} Siap
                                                    </span>
                                                </div>

                                                @if($totalSyarat > 0)
                                                    <div class="fase4-syarat-list">
                                                        @foreach($syaratItems as $idx => $sItem)
                                                            @php 
                                                                $itemFile = $syaratFiles[$sItem] ?? ($syaratFiles[$idx] ?? null);
                                                                $isItemChecked = in_array($sItem, $syaratChecklist) || !empty($itemFile);
                                                                $itemCleanPath = $itemFile ? str_replace('uploads/', '', $itemFile) : null;
                                                                $itemExt = $itemFile ? pathinfo($itemFile, PATHINFO_EXTENSION) : 'pdf';
                                                            @endphp
                                                            <div class="fase4-syarat-item {{ $isItemChecked ? 'text-success fw-semibold' : 'text-muted' }} d-flex align-items-center justify-content-between gap-1 py-0.5">
                                                                <div class="d-flex align-items-center gap-1.5 overflow-hidden flex-grow-1">
                                                                    <i class="mdi {{ $isItemChecked ? 'mdi-check-circle text-success' : 'mdi-checkbox-blank-circle-outline text-muted' }}" style="font-size: 0.85rem; flex-shrink: 0;"></i>
                                                                    <span class="text-truncate" title="{{ $sItem }}" style="font-size: 0.72rem;">{{ $sItem }}</span>
                                                                </div>
                                                                @if($itemFile)
                                                                    <button type="button" class="btn btn-xs btn-outline-success py-0 px-1.5 rounded-1 btn-preview-doc flex-shrink-0" data-url="{{ route('dokumen.preview', ['path' => $itemCleanPath]) }}" data-ext="{{ $itemExt }}" data-label="{{ $sItem }}" title="Lihat Berkas: {{ $sItem }}" style="font-size: 0.68rem; height: 20px; line-height: 1;">
                                                                        <i class="mdi mdi-eye me-0.5"></i>Lihat
                                                                    </button>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <div class="d-flex align-items-center justify-content-center text-muted flex-grow-1" style="font-size: 0.72rem; min-height: 45px;">
                                                        <span class="fst-italic opacity-75">Tidak ada prasyarat berkas khusus</span>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- FILE STATUS & PREVIEW BOX -->
                                            <div class="fase4-file-box {{ $filePath ? 'bg-success bg-opacity-10 border border-success border-opacity-25' : 'bg-light border' }} doc-card-file-box">
                                                @if($filePath)
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div class="text-truncate me-2" style="font-size: 0.75rem;">
                                                            <i class="mdi mdi-file-check text-success me-1 fs-6"></i><span class="fw-semibold text-dark">{{ basename($filePath) }}</span>
                                                        </div>
                                                        <button type="button" class="btn btn-xs btn-success text-white py-1 px-2 rounded-2 btn-preview-doc" data-url="{{ route('dokumen.preview', ['path' => $cleanPath]) }}" data-ext="{{ pathinfo($filePath, PATHINFO_EXTENSION) }}" data-label="{{ $docName }}" style="font-size: 0.72rem; font-weight: 600;">
                                                            <i class="mdi mdi-eye me-1"></i>Lihat
                                                        </button>
                                                    </div>
                                                @else
                                                    <div class="d-flex align-items-center justify-content-between text-muted" style="font-size: 0.74rem;">
                                                        <span><i class="mdi mdi-cloud-upload-outline me-1 text-secondary"></i>Berkas belum diunggah</span>
                                                        <span class="text-primary fw-semibold" role="button" onclick="editFase4Doc('{{ $docId }}')" style="font-size: 0.71rem; cursor: pointer;">
                                                            <i class="mdi mdi-upload me-0.5"></i>Upload
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- CARD ACTION FOOTER -->
                                            <div class="d-flex align-items-center justify-content-between pt-2.5 border-top gap-2">
                                                <button type="button" class="btn btn-sm btn-fase4-card-edit d-inline-flex align-items-center justify-content-center gap-1.5 flex-grow-1" onclick="editFase4Doc('{{ $docId }}')">
                                                    <i class="mdi mdi-pencil-box-outline"></i> <span>Edit & Upload</span>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-fase4-card-delete d-inline-flex align-items-center justify-content-center" onclick="deleteFase4Doc('{{ $docId }}', '{{ addslashes($docName) }}')" title="Hapus Dokumen">
                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12" id="fase4_docs_empty_state">
                                        <div class="p-5 text-center bg-light rounded-4 border border-dashed my-2" style="border-width: 2px !important; border-color: #cbd5e1 !important;">
                                            <div class="p-3 bg-white rounded-circle d-inline-flex shadow-sm mb-3" style="color: #9a55ff;">
                                                <i class="mdi mdi-folder-plus-outline" style="font-size: 2.5rem;"></i>
                                            </div>
                                            <h6 class="fw-bold text-dark mb-1">Daftar Dokumen Pengurusan Masih Kosong</h6>
                                            <p class="text-muted small mx-auto mb-3" style="max-width: 480px;">
                                                Dokumen Fase 4 dibuat fleksibel & dinamis sesuai kebutuhan riil di lapangan. Anda dapat menambahkan perizinan/surat satu per satu, atau gunakan template standar legalitas bila diperlukan.
                                            </p>
                                            <div class="d-flex flex-wrap justify-content-center align-items-center gap-2">
                                                <button type="button" class="btn btn-sm btn-fase4-add px-3 py-2 fw-bold shadow-sm" onclick="openFase4DocModal()">
                                                    <i class="mdi mdi-plus-circle-outline fs-6"></i> <span>+ Tambah Dokumen Lapangan</span>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-fase4-master px-3 py-2 fw-semibold shadow-sm" onclick="openMasterPickerModal()">
                                                    <i class="mdi mdi-file-certificate-outline fs-6"></i> <span>+ Pilih dari Master Perizinan</span>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-fase4-template px-3 py-2 fw-semibold shadow-sm" onclick="loadFase4DefaultTemplate()">
                                                    <i class="mdi mdi-clipboard-text-play-outline fs-6"></i> <span>Gunakan Template Standar (Poin 7–17)</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforelse
                            </div>


                            <!-- FOOTER BACK BUTTON -->
                            <div class="d-flex justify-content-between align-items-center gap-3 mt-4 footer-action-row">
                                <div>
                                    <button type="button" class="btn btn-outline-purple btn-action-mobile" onclick="switchStep(3)">
                                        <i class="mdi mdi-arrow-left-circle me-1"></i> Kembali ke Fase 3
                                    </button>
                                </div>
                                <div>
                                    @if(!$land || !$land->land_bank_id)
                                        <button type="button" class="btn btn-gradient-success py-2 px-4 shadow-sm" onclick="confirmFinalizePasca()">
                                            <i class="mdi mdi-shield-crown me-1"></i> Finalisasi ke Pasca Land Bank
                                        </button>
                                    @endif
                                </div>
                            </div>

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
                        <div id="imgZoomToolbar" class="d-none align-items-center bg-light border rounded-2 px-2 py-0.5 gap-1">
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

    {{-- MODAL TAMBAH / EDIT DOKUMEN FASE 4 (DYNAMIC WORKFLOW) --}}
    <div class="modal fade" id="modalFase4Doc" tabindex="-1" aria-hidden="true" style="z-index: 1055;">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" style="max-width: 860px;">
            <form id="formFase4Doc" class="modal-content border-0 shadow-lg" onsubmit="submitModalFase4Doc(event)" enctype="multipart/form-data" style="border-radius: 12px; overflow: hidden;">
                <input type="hidden" id="modal_fase4_doc_id" name="doc_id" value="">
                
                <div class="modal-header bg-white py-3 px-4 border-bottom d-flex align-items-center justify-content-between flex-shrink-0">
                    <div class="d-flex align-items-center gap-2.5">
                        <div class="p-2 rounded-2 text-primary" style="background-color: rgba(154, 85, 255, 0.12); width: 38px; height: 38px; display: flex; align-items: center; justify-content: center;">
                            <i class="mdi mdi-file-document-edit fs-5"></i>
                        </div>
                        <div>
                            <h5 class="modal-title fw-bold text-dark mb-0" id="modalFase4DocTitle" style="font-size: 1.05rem;">Form Dokumen & Perizinan Fase 4</h5>
                            <small class="text-muted d-block" style="font-size: 0.74rem;">Pengurusan Legalisasi Wilayah, Teknis BPN & SHGB Induk</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body px-4 py-3" style="background-color: #f8fafc; overflow-y: auto;">
                        <div class="row g-3">
                            <!-- Quick Fill dari Master Dokumen Perizinan (Top Banner) -->
                            <div class="col-12" id="modal_fase4_master_picker_section">
                                <div class="p-3 rounded-2 border" style="background: linear-gradient(135deg, #fcfaff, #f8f4ff); border: 1.5px solid rgba(154, 85, 255, 0.22) !important;">
                                    <div class="d-flex justify-content-between align-items-center mb-1.5 flex-wrap gap-2">
                                        <label class="form-label small fw-bold text-dark mb-0 d-flex align-items-center gap-1.5">
                                            <i class="mdi mdi-file-certificate-outline" style="color: #9a55ff; font-size: 1.15rem;"></i>
                                            Pilih dari Katalog Master Perizinan (Isi Otomatis):
                                        </label>
                                        <a href="{{ route('master.dokumen-perizinan.index') }}" target="_blank" class="badge text-decoration-none fw-semibold rounded-1 px-2.5 py-1.5" style="background: rgba(154, 85, 255, 0.12); color: #7e22ce; font-size: 0.74rem;">
                                            Kelola Master Data <i class="mdi mdi-open-in-new ms-0.5"></i>
                                        </a>
                                    </div>
                                    <select id="modal_fase4_master_select" class="form-select fase4-form-input" onchange="applyMasterToFase4Form(this.value)">
                                        <option value="">-- Ketik / Pilih Standar Perizinan untuk Auto-Fill --</option>
                                        @if(isset($masterPerizinans) && $masterPerizinans->count() > 0)
                                            @foreach($masterPerizinans->groupBy('kategori') as $kategori => $items)
                                                <optgroup label="{{ $kategori }}">
                                                    @foreach($items as $mItem)
                                                        <option value="{{ $mItem->id }}"
                                                            data-kode="{{ $mItem->kode_dokumen }}"
                                                            data-nama="{{ $mItem->nama_dokumen }}"
                                                            data-instansi="{{ $mItem->instansi_terkait }}"
                                                            data-biaya="{{ $mItem->estimasi_biaya }}"
                                                            data-syarat="{{ $mItem->syarat_dokumen }}"
                                                            data-deskripsi="{{ $mItem->deskripsi }}">
                                                            {{ $mItem->nama_dokumen }} ({{ $mItem->kode_dokumen }})
                                                        </option>
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small class="text-muted d-block mt-1.5" style="font-size: 0.72rem;">
                                        <i class="mdi mdi-information-outline text-primary me-0.5"></i> Memilih izin master akan otomatis mengisi nama dokumen, instansi, estimasi biaya, dan butir checklist prasyarat.
                                    </small>
                                </div>
                            </div>

                            <!-- 2-KOLOM UTAMA: KIRI (IDENTITAS & STATUS) & KANAN (PRASYARAT & BERKAS) -->
                            <div class="col-12 col-lg-6 d-flex flex-column gap-3">
                                <!-- Card 1: Identitas Dokumen -->
                                <div class="fase4-modal-section-card">
                                    <div class="fase4-modal-section-title" style="color: #7e22ce;">
                                        <i class="mdi mdi-card-account-details-outline"></i> Identitas & Instansi Dokumen
                                    </div>
                                    <div class="row g-2">
                                        <div class="col-4">
                                            <label class="fase4-form-label">Poin / Urutan</label>
                                            <input type="text" class="form-control fase4-form-input" id="modal_fase4_poin_label" name="poin_label" placeholder="Poin 7">
                                        </div>
                                        <div class="col-8">
                                            <label class="fase4-form-label">Nama Dokumen / Perizinan <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control fase4-form-input fw-bold" id="modal_fase4_doc_name" name="doc_name" placeholder="Contoh: PKKPR OSS RBA / SK HGB BPN" required>
                                        </div>
                                        <div class="col-12">
                                            <label class="fase4-form-label">Instansi / Lembaga Terkait</label>
                                            <input type="text" class="form-control fase4-form-input" id="modal_fase4_instansi" name="instansi" placeholder="Contoh: Kantor Pertanahan (BPN) / Pemda / Notaris">
                                        </div>
                                    </div>
                                </div>

                                <!-- Card 2: Legalitas & Status Progres -->
                                <div class="fase4-modal-section-card">
                                    <div class="fase4-modal-section-title text-primary">
                                        <i class="mdi mdi-shield-check-outline"></i> Legalitas & Status Progres
                                    </div>
                                    <div class="row g-2">
                                        <div class="col-7">
                                            <label class="fase4-form-label">Nomor Registrasi / SK / Surat</label>
                                            <input type="text" class="form-control fase4-form-input" id="modal_fase4_doc_number" name="doc_number" placeholder="Nomor resmi registrasi / SK">
                                        </div>
                                        <div class="col-5">
                                            <label class="fase4-form-label">Tanggal Terbit</label>
                                            <input type="date" class="form-control fase4-form-input" id="modal_fase4_doc_date" name="doc_date">
                                        </div>
                                        <div class="col-12">
                                            <label class="fase4-form-label">Status Progres Dokumen <span class="text-danger">*</span></label>
                                            <select class="form-select fase4-form-input fw-bold" id="modal_fase4_status" name="status" required>
                                                <option value="belum">Belum Diurus / Belum Ada</option>
                                                <option value="proses">Sedang Dalam Proses</option>
                                                <option value="selesai">Selesai / Terbit Resmi</option>
                                                <option value="ditolak">Dibatalkan / Tidak Diperlukan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card 3: Finansial & Teknis (Opsional) -->
                                <div class="fase4-modal-section-card">
                                    <div class="fase4-modal-section-title text-success">
                                        <i class="mdi mdi-cash-multiple"></i> Informasi Finansial & Teknis (Opsional)
                                    </div>
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <label class="fase4-form-label">Nominal Biaya / Pajak</label>
                                            <input type="text" class="form-control fase4-form-input" id="modal_fase4_nominal" name="nominal" placeholder="Rp 0 (BPHTB / Biaya BPN)" onkeyup="formatRupiahTemp(this)">
                                        </div>
                                        <div class="col-6">
                                            <label class="fase4-form-label">Luas Hasil Ukur (M²)</label>
                                            <input type="text" class="form-control fase4-form-input" id="modal_fase4_luas" name="luas" placeholder="Contoh: 15.420 m²">
                                        </div>
                                        <div class="col-12">
                                            <label class="fase4-form-label">Catatan Progres / Keterangan Kendala</label>
                                            <textarea class="form-control fase4-form-input" id="modal_fase4_notes" name="notes" rows="2" placeholder="Tuliskan catatan teknis, kendala berkas, atau catatan tindak lanjut..."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- KOLOM KANAN: CHECKLIST PRASYARAT & BERKAS UPLOAD -->
                            <div class="col-12 col-lg-6 d-flex flex-column gap-3">
                                <!-- Card 4: Checklist Prasyarat Berkas -->
                                <div class="fase4-modal-section-card" id="modal_fase4_syarat_section">
                                    <div class="fase4-modal-section-title text-dark d-flex justify-content-between align-items-center mb-1">
                                        <div class="d-flex align-items-center gap-1.5" style="color: #0f172a;">
                                            <i class="mdi mdi-format-list-checks text-primary fs-5"></i>
                                            <span>Checklist Prasyarat Berkas</span>
                                        </div>
                                        <span class="badge rounded-1 px-2.5 py-1" id="modal_syarat_summary_badge" style="background: rgba(14, 165, 233, 0.12); color: #0284c7; font-size: 0.73rem; font-weight: 600;">
                                            0/0 Terpenuhi
                                        </span>
                                    </div>
                                    <small class="text-muted d-block mb-2" style="font-size: 0.72rem;">
                                        Unggah berkas prasyarat pada masing-masing butir di bawah. Checklist otomatis tercentang saat berkas dipilih/diunggah.
                                    </small>

                                    <!-- Container Checkboxes Dinamis -->
                                    <div id="modal_syarat_checkboxes_container" class="p-2.5 rounded-2 mb-2" style="background-color: #f8fafc; border: 1.5px dashed #cbd5e1; min-height: 140px; max-height: 260px; overflow-y: auto;">
                                        <!-- Checkboxes dirender otomatis via JavaScript -->
                                    </div>

                                    <!-- Collapsible Editor untuk Tambah/Edit Prasyarat -->
                                    <div class="pt-1">
                                        <a class="btn btn-xs btn-outline-secondary py-1 px-2.5 rounded-2 d-inline-flex align-items-center gap-1 text-decoration-none fw-semibold" data-bs-toggle="collapse" href="#collapseSyaratEditor" role="button" aria-expanded="false" style="font-size: 0.73rem;">
                                            <i class="mdi mdi-playlist-edit fs-6"></i> Edit Teks / Tambah Prasyarat Baru
                                        </a>
                                        <div class="collapse mt-2" id="collapseSyaratEditor">
                                            <textarea class="form-control fase4-form-input" id="modal_fase4_syarat_dokumen" name="syarat_dokumen" rows="3" placeholder="Tuliskan prasyarat berkas per baris atau dengan simbol bullet (• / -)..." oninput="onSyaratTextInput(this.value)"></textarea>
                                            <small class="text-muted d-block mt-1" style="font-size: 0.7rem;">Setiap baris teks otomatis diubah menjadi kotak centang checklist prasyarat di atas.</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card 5: Upload Dokumen Fisik / Scan -->
                                <div class="fase4-modal-section-card flex-grow-1">
                                    <div class="fase4-modal-section-title text-dark">
                                        <i class="mdi mdi-cloud-upload-outline text-primary fs-5"></i> Dokumen Hasil / SK Terbit Resmi (Opsional)
                                    </div>
                                    
                                    <div id="modal_fase4_current_file_preview" class="mb-2 d-none">
                                        <!-- Will show existing file info if any -->
                                    </div>

                                    <div class="pratanah-file-upload-modern h-100 d-flex flex-column justify-content-center">
                                        <input type="file" id="modal_fase4_file" name="file" accept=".pdf,.jpg,.jpeg,.png,.webp,.zip,.doc,.docx" onchange="handleModalFase4File(this)">
                                        <div class="fase4-upload-dropzone">
                                            <div class="mb-1.5" style="color: #9a55ff;">
                                                <i class="mdi mdi-cloud-upload" style="font-size: 2.2rem;"></i>
                                            </div>
                                            <div class="fw-bold text-dark mb-0.5" id="modal_fase4_file_label" style="font-size: 0.85rem;">Pilih Berkas Baru (Klik / Drop File)</div>
                                            <small class="text-muted d-block" style="font-size: 0.72rem;">Format PDF, JPG, PNG, DOCX (Maksimal 25MB)</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer bg-white border-top px-4 py-3 d-flex align-items-center justify-content-end gap-2.5 flex-shrink-0" style="background-color: #ffffff;">
                        <button type="button" class="btn btn-master-cancel" data-bs-dismiss="modal">
                            <i class="mdi mdi-close me-1.5"></i>Batal
                        </button>
                        <button type="submit" class="btn btn-master-submit" id="btnSaveModalFase4">
                            <i class="mdi mdi-content-save-check me-1.5"></i>Simpan Dokumen
                        </button>
                    </div>
            </form>
        </div>
    </div>

    {{-- MODAL CHECKLIST PICKER: PILIH DARI MASTER DOKUMEN PERIZINAN --}}
    <div class="modal fade" id="modalPickerMasterPerizinan" tabindex="-1" aria-hidden="true" style="z-index: 1056;">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center justify-content-between flex-wrap gap-2 py-3 px-4">
                    <div class="d-flex align-items-center gap-2.5">
                        <div class="p-2 rounded-3 text-primary" style="background-color: rgba(154, 85, 255, 0.12);">
                            <i class="mdi mdi-file-certificate-outline fs-5"></i>
                        </div>
                        <div>
                            <h5 class="modal-title">Katalog Master Dokumen Perizinan Developer</h5>
                            <small class="text-muted d-block" style="font-size: 0.75rem;">Pilih dokumen perizinan standar untuk dimasukkan ke alur kerja Fase 4 lahan ini</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2 ms-auto">
                        <a href="{{ route('master.dokumen-perizinan.index') }}" target="_blank" class="btn btn-sm btn-outline-purple d-inline-flex align-items-center gap-1.5 py-1.5 px-3" style="font-size: 0.78rem;">
                            <i class="mdi mdi-cog-outline fs-6"></i> <span>Kelola Master Data</span>
                        </a>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>

                <div class="modal-body p-4 bg-light" style="max-height: 75vh; overflow-y: auto;">
                    <!-- Filter & Search Master -->
                    <div class="p-3 bg-white rounded-3 border shadow-sm mb-3">
                        <div class="row g-2 align-items-center">
                            <div class="col-md-7">
                                <div class="master-search-group">
                                    <i class="mdi mdi-magnify master-search-icon"></i>
                                    <input type="text" class="form-control master-search-input" id="searchMasterPickerInput" placeholder="Cari nama izin, kode poin, instansi..." onkeyup="searchMasterPicker(this.value)">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <select class="form-select master-category-select" id="filterMasterCategorySelect" onchange="filterMasterPickerCategory(this.value)">
                                    <option value="">Semua Kategori ({{ isset($masterPerizinans) ? $masterPerizinans->count() : 0 }} Dokumen)</option>
                                    @if(isset($masterPerizinans))
                                        @foreach($masterPerizinans->pluck('kategori')->unique() as $kategori)
                                            <option value="{{ $kategori }}">{{ $kategori }} ({{ $masterPerizinans->where('kategori', $kategori)->count() }})</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <!-- Select All & Summary Bar -->
                        <div class="d-flex flex-wrap justify-content-between align-items-center mt-3 pt-2.5 border-top gap-2">
                            <label class="select-all-box m-0" for="checkAllMasterPicker">
                                <input class="form-check-input custom-picker-chk m-0" type="checkbox" id="checkAllMasterPicker" onchange="togglePickerSelectAll(this)">
                                <span class="fw-bold text-dark small user-select-none" style="font-size: 0.82rem;">
                                    Pilih Semua yang Ditampilkan
                                </span>
                            </label>
                            <div class="badge px-3 py-2 fw-bold" id="masterPickerSelectedBadge" style="background: rgba(154, 85, 255, 0.1); color: #7e22ce; font-size: 0.82rem; border: 1px solid rgba(154, 85, 255, 0.25); border-radius: 8px;">
                                <i class="mdi mdi-check-all me-1"></i> <span id="masterPickerSelectedText">0 dokumen dipilih</span>
                            </div>
                        </div>
                    </div>

                    <!-- Items Checklist Container -->
                    <form id="formPickerMasterPerizinan">
                        @php
                            $existingCodes = [];
                            $existingNames = [];
                            if (isset($workflowDocs) && is_array($workflowDocs)) {
                                foreach ($workflowDocs as $wd) {
                                    if (!empty($wd['poin_label'])) $existingCodes[] = strtolower(trim($wd['poin_label']));
                                    if (!empty($wd['doc_name'])) $existingNames[] = strtolower(trim($wd['doc_name']));
                                }
                            }
                        @endphp

                        <div class="row g-2.5" id="masterPickerListContainer">
                            @if(isset($masterPerizinans) && $masterPerizinans->count() > 0)
                                @foreach($masterPerizinans as $m)
                                    @php
                                        $isAlreadyAdded = in_array(strtolower(trim($m->kode_dokumen)), $existingCodes) || in_array(strtolower(trim($m->nama_dokumen)), $existingNames);
                                        $searchString = strtolower($m->nama_dokumen . ' ' . $m->kode_dokumen . ' ' . $m->kategori . ' ' . $m->instansi_terkait . ' ' . $m->syarat_dokumen . ' ' . $m->deskripsi);
                                    @endphp
                                    <div class="col-12 col-md-6 master-picker-item" 
                                         data-kategori="{{ $m->kategori }}" 
                                         data-search="{{ $searchString }}"
                                         data-already="{{ $isAlreadyAdded ? '1' : '0' }}">
                                        <div class="card h-100 p-3 transition-all master-picker-card {{ $isAlreadyAdded ? 'is-disabled' : '' }}" 
                                             id="picker_card_{{ $m->id }}"
                                             style="cursor: {{ $isAlreadyAdded ? 'default' : 'pointer' }};"
                                             onclick="togglePickerCardClick(event, '{{ $m->id }}', {{ $isAlreadyAdded ? 'true' : 'false' }})">
                                            <div class="d-flex align-items-start gap-3">
                                                <div class="flex-shrink-0 pt-1 me-1">
                                                    <input class="form-check-input master-picker-checkbox custom-picker-chk" 
                                                           type="checkbox" 
                                                           name="master_ids[]" 
                                                           value="{{ $m->id }}" 
                                                           id="picker_chk_{{ $m->id }}"
                                                           {{ $isAlreadyAdded ? 'disabled' : '' }}
                                                           onchange="updatePickerSelectedCount()">
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <div class="d-flex align-items-center justify-content-between gap-1 mb-1">
                                                        <div class="d-flex align-items-center gap-1.5 flex-wrap">
                                                            <span class="badge bg-light text-dark border font-monospace rounded-2" style="font-size: 0.72rem;">{{ $m->kode_dokumen }}</span>
                                                            <span class="badge rounded-2 fw-semibold" style="background-color: rgba(154,85,255,0.12); color: #9a55ff; font-size: 0.7rem;">{{ $m->kategori }}</span>
                                                        </div>
                                                        @if($isAlreadyAdded)
                                                            <span class="badge bg-secondary rounded-2" style="font-size: 0.68rem;">
                                                                <i class="mdi mdi-check-all me-1"></i>Sudah Ada di Lahan
                                                            </span>
                                                        @elseif($m->is_required)
                                                            <span class="badge bg-danger-soft text-danger fw-bold border border-danger-subtle rounded-2" style="background-color: rgba(220,53,69,0.1); font-size: 0.68rem;">
                                                                Wajib
                                                            </span>
                                                        @endif
                                                    </div>

                                                    <h6 class="fw-bold text-dark mb-1 text-truncate" style="font-size: 0.88rem;" title="{{ $m->nama_dokumen }}">
                                                        {{ $m->nama_dokumen }}
                                                    </h6>

                                                    @if($m->instansi_terkait)
                                                        <small class="text-muted d-block text-truncate mb-1" style="font-size: 0.74rem;">
                                                            <i class="mdi mdi-office-building text-primary me-1"></i>{{ $m->instansi_terkait }}
                                                        </small>
                                                    @endif

                                                    <div class="d-flex flex-wrap align-items-center gap-2 mt-2 pt-1.5 border-top" style="font-size: 0.74rem;">
                                                        @if($m->estimasi_hari)
                                                            <span class="text-muted">
                                                                <i class="mdi mdi-clock-outline me-0.5 text-secondary"></i>{{ $m->estimasi_hari }} Hari
                                                            </span>
                                                        @endif
                                                        @if($m->estimasi_biaya > 0)
                                                            <span class="fw-bold text-success">
                                                                Rp {{ number_format($m->estimasi_biaya, 0, ',', '.') }}
                                                            </span>
                                                        @endif
                                                        @if($m->syarat_dokumen)
                                                            <span class="text-muted text-truncate" style="max-width: 180px;" title="Syarat: {{ $m->syarat_dokumen }}">
                                                                <i class="mdi mdi-file-outline me-0.5 text-primary"></i>{{ $m->syarat_dokumen }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-12 py-5 text-center text-muted">
                                    <i class="mdi mdi-file-certificate-outline fs-1 text-muted opacity-50"></i>
                                    <p class="mt-2 mb-0">Belum ada data master dokumen perizinan.</p>
                                </div>
                            @endif
                        </div>
                    </form>
                </div>

                <div class="modal-footer d-flex justify-content-end align-items-center gap-2 py-2.5 px-4">
                    <button type="button" class="btn btn-master-cancel" data-bs-dismiss="modal">
                        <i class="mdi mdi-close me-1.5"></i>Batal
                    </button>
                    <button type="button" class="btn btn-master-submit" id="btnSubmitMasterPicker" onclick="submitBatchFromMaster()">
                        <i class="mdi mdi-plus-box-multiple me-1.5 fs-6"></i>
                        <span id="btnSubmitMasterPickerText">Tambahkan Dokumen Terpilih</span>
                    </button>
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
        let isFase2Done = {{ ($isFase2Done ?? false) ? 'true' : 'false' }};
        let canAccessFase3 = {{ ($canAccessFase3 ?? false) ? 'true' : 'false' }};
        let canAccessFase4 = {{ ($canAccessFase4 ?? false) ? 'true' : 'false' }};

        // Read step query param if present
        const urlParams = new URLSearchParams(window.location.search);
        const queryStep = parseInt(urlParams.get('step'));

        // Determine step based on query parameter or fallback to land status
        if (isEditMode) {
            if (queryStep >= 1 && queryStep <= 4) {
                if (queryStep === 4 && !canAccessFase4 && currentLandStatus !== 'approved' && currentLandStatus !== 'rejected') {
                    activeStep = (isLegalSah && isFase2Done) ? 3 : (isLegalSah ? 2 : 1);
                } else if (queryStep === 3 && (!isLegalSah || !isFase2Done) && currentLandStatus !== 'approved' && currentLandStatus !== 'rejected') {
                    activeStep = isLegalSah ? 2 : 1;
                } else if (queryStep === 2 && !isLegalSah && currentLandStatus !== 'approved' && currentLandStatus !== 'rejected') {
                    activeStep = 1;
                } else {
                    activeStep = queryStep;
                }
                if (window.history.replaceState) {
                    window.history.replaceState(null, '', window.location.pathname + '?step=' + activeStep);
                }
            } else {
                if (currentLandStatus === 'fase2') {
                    activeStep = isLegalSah ? 2 : 1;
                } else if (currentLandStatus === 'fase3') {
                    activeStep = (isLegalSah && isFase2Done) ? 3 : (isLegalSah ? 2 : 1);
                } else if (currentLandStatus === 'fase4' || currentLandStatus === 'approved' || currentLandStatus === 'rejected') {
                    activeStep = (isLegalSah && isFase2Done) ? 4 : (isLegalSah ? 2 : 1);
                }
            }
        }

        // ===============================
        // KATEGORI DOKUMEN SESUAI ALAS HAK
        // ===============================
        const CATEGORY_META = {
            'SHM': {
                name: 'SHM (Sertifikat Hak Milik)',
                desc: '6 Dokumen Wajib: Sertifikat SHM Asli + 5 Dokumen Identitas & Pajak (KTP, KK, Nikah, NPWP, PBB).'
            },
            'AJB': {
                name: 'AJB / Akta Hibah',
                desc: '10 Dokumen Wajib: AJB/Hibah Asli, Riwayat Tanah, Letter C, Penguasaan Fisik, Tanda Batas + 5 Dokumen Identitas & Pajak.'
            },
            'APHB': {
                name: 'APHB (Akta Pembagian Hak Bersama)',
                desc: '11 Dokumen Wajib: APHB, Ket. Ahli Waris, Akta Kematian, Riwayat Tanah, Letter C, Penguasaan Fisik, Tanda Batas + 5 Dokumen Identitas & Pajak Ahli Waris.'
            },
            'WARISAN': {
                name: 'AJB & Akta Hibah (Harta Warisan)',
                desc: '11 Dokumen Wajib: AJB/Hibah Asli, Ket. Waris, Akta Kematian, Riwayat Tanah, Letter C, Penguasaan Fisik, Tanda Batas + 5 Dokumen Identitas & Pajak.'
            },
            'PETOK_C': {
                name: 'Petok C / Girik Asli',
                desc: '10 Dokumen Wajib: Petok C Asli, Riwayat Tanah, Letter C, Penguasaan Fisik, Tanda Batas + 5 Dokumen Identitas & Pajak.'
            }
        };

        function getNormalizedCategory(raw) {
            const val = (raw || '').toString().toUpperCase().trim();
            if (!val) return '';
            if (val.includes('APHB')) return 'APHB';
            if (val.includes('WARIS')) return 'WARISAN';
            if (val.includes('PETOK') || val.includes('GIRIK') || val.includes('LETTER')) return 'PETOK_C';
            if (val.includes('AJB') || val.includes('HIBAH')) return 'AJB';
            if (val.includes('SHM') || val.includes('HGB') || val.includes('HGU') || val.includes('HP')) return 'SHM';
            return '';
        }

        function filterFase1DocumentsByCategory(selectedVal) {
            const cat = getNormalizedCategory(selectedVal);
            const alertEl = document.getElementById('fase1CategoryAlert');
            const emptyEl = document.getElementById('fase1EmptyCategoryAlert');
            const nameEl = document.getElementById('fase1CategoryName');
            const descEl = document.getElementById('fase1CategoryDesc');
            const countEl = document.getElementById('fase1CategoryCountBadge');
            const fase3CatLabel = document.getElementById('fase3CategoryLabel');

            if (!cat) {
                if (alertEl) alertEl.classList.add('d-none');
                if (emptyEl) emptyEl.classList.remove('d-none');

                document.querySelectorAll('.doc-fase1-col').forEach(card => {
                    card.classList.add('d-none');
                });
                document.querySelectorAll('.doc-fase3-col').forEach(card => {
                    card.classList.add('d-none');
                });
                if (fase3CatLabel) fase3CatLabel.textContent = '-';
                return;
            }

            if (emptyEl) emptyEl.classList.add('d-none');
            if (alertEl) alertEl.classList.remove('d-none');

            let visibleCount = 0;
            document.querySelectorAll('.doc-fase1-col').forEach(card => {
                let rawCats = card.getAttribute('data-categories');
                let cats = [];
                try {
                    cats = typeof rawCats === 'string' ? JSON.parse(rawCats) : (rawCats || []);
                } catch (e) {
                    cats = [];
                }

                if (!cats || cats.length === 0 || cats.includes(cat)) {
                    card.classList.remove('d-none');
                    visibleCount++;
                } else {
                    card.classList.add('d-none');
                }
            });

            // Update Fase 3 document grid cards to match the category
            document.querySelectorAll('.doc-fase3-col').forEach(card => {
                let rawCats = card.getAttribute('data-categories');
                let cats = [];
                try {
                    cats = typeof rawCats === 'string' ? JSON.parse(rawCats) : (rawCats || []);
                } catch (e) {
                    cats = [];
                }

                if (!cats || cats.length === 0 || cats.includes(cat)) {
                    card.classList.remove('d-none');
                } else {
                    card.classList.add('d-none');
                }
            });

            // Update info banner
            const info = CATEGORY_META[cat] || { name: cat, desc: 'Menampilkan berkas wajib legalitas sesuai SOP.' };
            if (nameEl) nameEl.textContent = info.name;
            if (descEl) descEl.textContent = info.desc;
            if (countEl) countEl.textContent = visibleCount + ' Dokumen Wajib';
            if (fase3CatLabel) fase3CatLabel.textContent = info.name || cat;
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Render correct step view upon loading
            switchStep(activeStep);

            // Display flash or sessionStorage notifications
            const pendingMsg = sessionStorage.getItem('success_message');
            if (pendingMsg) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: pendingMsg,
                    timer: 2500,
                    showConfirmButton: false
                });
                sessionStorage.removeItem('success_message');
            }

            @if(session('warning'))
                Swal.fire({
                    icon: 'warning',
                    title: 'Akses Terkunci',
                    text: "{{ session('warning') }}"
                });
            @endif

            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: "{{ session('success') }}",
                    timer: 2500,
                    showConfirmButton: false
                });
            @endif

            // Initial toggle for installment view (do not regenerate rows to preserve Blade pre-render)
            toggleInstallmentView(true);

            // Filter berkas dokumen Fase 1 secara dinamis sesuai Status Kepemilikan (Alas Hak)
            const initialOwnership = $('#select_ownership_status').val();
            filterFase1DocumentsByCategory(initialOwnership);

            $('#select_ownership_status').on('change select2:select', function() {
                filterFase1DocumentsByCategory($(this).val());
            });



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
        // DYNAMIC STEP MANAGER (4 FASE)
        // ===============================
        function switchStep(step) {
            // If in create mode and user tries to skip to step 2, 3, or 4, reject
            if (!isEditMode && step > 1) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Langkah Terkunci',
                    text: 'Silakan isi dan simpan data Fase 1 terlebih dahulu.'
                });
                return;
            }

            // Cek akses ke Step 2 (Wajib dokumen di Fase 1 Sah)
            if (step === 2 && !isLegalSah && currentLandStatus !== 'approved' && currentLandStatus !== 'rejected') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Fase 2 Terkunci!',
                    html: `
                        <p class="text-muted mb-3" style="font-size: 0.92rem;">
                            Anda belum dapat melanjutkan ke <b>Fase 2 (Survey Kelayakan Teknis & Spasial)</b>.
                        </p>
                        <div class="p-3 rounded-3 text-start mb-2" style="background: #fffbeb; border: 1.5px solid #fde68a;">
                            <div class="d-flex align-items-center gap-2 mb-2 text-warning fw-bold" style="font-size: 0.85rem;">
                                <i class="mdi mdi-shield-alert" style="font-size: 1.1rem;"></i>
                                <span>Syarat Pembukaan Akses Fase 2:</span>
                            </div>
                            <ul class="mb-0 ps-3 text-secondary" style="font-size: 0.82rem; line-height: 1.6;">
                                <li>Berkas dokumen legalitas di <b>Fase 1</b> wajib diunggah lengkap.</li>
                                <li>Seluruh dokumen wajib telah <b>Divalidasi Sah</b> oleh Kepala Legal.</li>
                            </ul>
                        </div>
                    `,
                    confirmButtonColor: '#9a55ff',
                    confirmButtonText: '<i class="mdi mdi-arrow-left me-1"></i> Periksa Dokumen di Fase 1'
                }).then(() => {
                    switchStep(1);
                });
                return;
            }

            // Cek akses ke Step 3 (Wajib Fase 1 Sah DAN Fase 2 Selesai)
            if (step === 3 && currentLandStatus !== 'approved' && currentLandStatus !== 'rejected') {
                if (!isLegalSah) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Fase 3 Terkunci!',
                        html: `
                            <p class="text-muted mb-3" style="font-size: 0.92rem;">
                                Anda belum dapat melanjutkan ke <b>Fase 3 (Sidang Keputusan Akhir)</b>.
                            </p>
                            <div class="p-3 rounded-3 text-start mb-2" style="background: #fffbeb; border: 1.5px solid #fde68a;">
                                <div class="d-flex align-items-center gap-2 mb-2 text-warning fw-bold" style="font-size: 0.85rem;">
                                    <i class="mdi mdi-shield-alert" style="font-size: 1.1rem;"></i>
                                    <span>Syarat Pembukaan Akses Fase 3:</span>
                                </div>
                                <ul class="mb-0 ps-3 text-secondary" style="font-size: 0.82rem; line-height: 1.6;">
                                    <li class="fw-semibold text-danger">Dokumen legalitas di <b>Fase 1</b> wajib diunggah dan <b>Divalidasi Sah</b> oleh Kepala Legal terlebih dahulu.</li>
                                    <li>Data survey fisik, zonasi & titik spasial di <b>Fase 2</b> wajib diselesaikan.</li>
                                </ul>
                            </div>
                        `,
                        confirmButtonColor: '#9a55ff',
                        confirmButtonText: '<i class="mdi mdi-arrow-left me-1"></i> Periksa Dokumen di Fase 1'
                    }).then(() => {
                        switchStep(1);
                    });
                    return;
                }

                if (!isFase2Done) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Fase 3 Terkunci!',
                        html: `
                            <p class="text-muted mb-3" style="font-size: 0.92rem;">
                                Anda belum dapat melanjutkan ke <b>Fase 3 (Sidang Keputusan Akhir)</b> karena tahap <b>Fase 2</b> belum diselesaikan.
                            </p>
                            <div class="p-3 rounded-3 text-start mb-2" style="background: #fffbeb; border: 1.5px solid #fde68a;">
                                <div class="d-flex align-items-center gap-2 mb-2 text-warning fw-bold" style="font-size: 0.85rem;">
                                    <i class="mdi mdi-alert-circle-outline" style="font-size: 1.1rem;"></i>
                                    <span>Harap Selesaikan Fase 2 Terlebih Dahulu:</span>
                                </div>
                                <ul class="mb-0 ps-3 text-secondary" style="font-size: 0.82rem; line-height: 1.6;">
                                    <li class="text-success"><i class="mdi mdi-check-circle me-1"></i>Dokumen legalitas di <b>Fase 1</b> telah Divalidasi Sah.</li>
                                    <li class="fw-semibold text-danger"><i class="mdi mdi-close-circle me-1"></i>Data survey fisik & spasial di <b>Fase 2</b> belum diisi / disimpan.</li>
                                </ul>
                            </div>
                        `,
                        confirmButtonColor: '#9a55ff',
                        confirmButtonText: '<i class="mdi mdi-arrow-right-circle me-1"></i> Buka Fase 2'
                    }).then(() => {
                        switchStep(2);
                    });
                    return;
                }
            }

            // Cek akses ke Step 4 (Wajib Fase 1, 2, 3 Selesai)
            if (step === 4 && !canAccessFase4 && currentLandStatus !== 'approved' && currentLandStatus !== 'rejected') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Fase 4 Terkunci!',
                    html: `
                        <p class="text-muted mb-3" style="font-size: 0.92rem;">
                            Anda belum dapat melanjutkan ke <b>Fase 4 (Balik Nama & Pengindukan an. PT)</b>.
                        </p>
                        <div class="p-3 rounded-3 text-start mb-2" style="background: #fffbeb; border: 1.5px solid #fde68a;">
                            <div class="d-flex align-items-center gap-2 mb-2 text-warning fw-bold" style="font-size: 0.85rem;">
                                <i class="mdi mdi-shield-alert" style="font-size: 1.1rem;"></i>
                                <span>Syarat Pembukaan Akses Fase 4:</span>
                            </div>
                            <ul class="mb-0 ps-3 text-secondary" style="font-size: 0.82rem; line-height: 1.6;">
                                <li>Tahap <b>Fase 1</b> (Validasi Dokumen Sah) wajib lengkap.</li>
                                <li>Tahap <b>Fase 2</b> (Survey Lapangan & Spasial) wajib tersimpan.</li>
                                <li>Tahap <b>Fase 3</b> (Sidang Keputusan / Notaris) wajib disetujui / diproses.</li>
                            </ul>
                        </div>
                    `,
                    confirmButtonColor: '#9a55ff',
                    confirmButtonText: '<i class="mdi mdi-arrow-left me-1"></i> Periksa Fase 3'
                }).then(() => {
                    switchStep(3);
                });
                return;
            }

            activeStep = step;
            if (window.history.replaceState) {
                window.history.replaceState(null, '', window.location.pathname + '?step=' + activeStep);
            }

            // Manage CSS display containers
            document.getElementById('containerFase1')?.classList.add('d-none');
            document.getElementById('containerFase2')?.classList.add('d-none');
            document.getElementById('containerFase3')?.classList.add('d-none');
            document.getElementById('containerFase4')?.classList.add('d-none');

            // Reset active & completed classes and text
            ['step1', 'step2', 'step3', 'step4'].forEach((sId, idx) => {
                const el = document.getElementById(sId);
                if (el) {
                    el.classList.remove('active', 'completed');
                    const circle = el.querySelector('.step-circle');
                    if (circle) circle.innerHTML = (idx + 1).toString();
                }
            });

            // Show active container
            const activeCont = document.getElementById(`containerFase${step}`);
            if (activeCont) activeCont.classList.remove('d-none');
            const activeStepEl = document.getElementById(`step${step}`);
            if (activeStepEl) activeStepEl.classList.add('active');

            // Apply completed status & checkmarks
            const isFase4Finished = {{ ($land && (!empty($land->land_bank_id) || !empty($land->shgb_induk_no))) ? 'true' : 'false' }};
            const isFase3Finished = isEditMode && (currentLandStatus === 'fase4' || currentLandStatus === 'approved' || currentLandStatus === 'rejected' || {{ ($land && !empty($land->notaris_id)) ? 'true' : 'false' }});

            if (isEditMode && isLegalSah) {
                document.getElementById('step1')?.classList.add('completed');
                const c1 = document.querySelector('#step1 .step-circle');
                if (c1) c1.innerHTML = '<i class="mdi mdi-check"></i>';
            }

            if (isEditMode && isFase2Done) {
                document.getElementById('step2')?.classList.add('completed');
                const c2 = document.querySelector('#step2 .step-circle');
                if (c2) c2.innerHTML = '<i class="mdi mdi-check"></i>';
            }

            if (isFase3Finished) {
                document.getElementById('step3')?.classList.add('completed');
                const c3 = document.querySelector('#step3 .step-circle');
                if (c3) c3.innerHTML = '<i class="mdi mdi-check"></i>';
            }

            if (isFase4Finished) {
                document.getElementById('step4')?.classList.add('completed');
                const c4 = document.querySelector('#step4 .step-circle');
                if (c4) c4.innerHTML = '<i class="mdi mdi-check"></i>';
            }

            // Manage Progress Bar Width (4 Steps: 0%, 33%, 66%, 100%)
            const bar = document.getElementById('wizardProgressBar');
            if (bar) {
                if (step === 1) {
                    bar.style.width = '0%';
                    setTimeout(() => initSelect2Search(), 100);
                } else if (step === 2) {
                    bar.style.width = '33%';
                    setTimeout(() => {
                        initMapFase2();
                        initSelect2Search();
                    }, 300);
                } else if (step === 3) {
                    bar.style.width = '66%';
                    setTimeout(() => initSelect2Search(), 100);
                } else if (step === 4) {
                    bar.style.width = '100%';
                    setTimeout(() => initSelect2Search(), 100);
                }
            }
        }

        // ===============================
        // SELECT2 SEARCH INITIALIZER
        // ===============================
        function initSelect2Search() {
            if (typeof $ !== 'undefined' && typeof $.fn.select2 !== 'undefined') {
                $('.select2-search').each(function() {
                    const $this = $(this);
                    if ($this.is(':visible')) {
                        if ($this.hasClass("select2-hidden-accessible")) {
                            $this.select2('destroy');
                        }
                        $this.select2({
                            theme: 'bootstrap-5',
                            placeholder: $this.data('placeholder') || 'Pilih...',
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
        async function saveFase1(andProceed = false) {
            try {
                showLoading('Menyimpan Data & Dokumen Fase 1...');
                let form = document.getElementById('formFase1');
                let formData = new FormData(form);

                let res = await fetchJSON("{{ route('pra-landbanks.store') }}", formData);
                Swal.close();

                if (res.success) {
                    let targetId = res.id || "{{ $land->id ?? '' }}";
                    if (andProceed && targetId && isLegalSah) {
                        sessionStorage.setItem('success_message', 'Data Fase 1 berhasil disimpan.');
                        window.location.href = "{{ url('/properti/pra-landbank/proses') }}/" + targetId + "?step=2";
                    } else if (targetId) {
                        sessionStorage.setItem('success_message', 'Perubahan data Fase 1 berhasil disimpan.');
                        window.location.href = "{{ url('/properti/pra-landbank/proses') }}/" + targetId + "?step=1";
                    } else {
                        window.location.href = "{{ route('pralandbank.all') }}";
                    }
                } else {
                    showError(res.message);
                }
            } catch (err) {
                Swal.close();
                showError(err.message);
            }
        }

        function previewImageFase2(input, imgId, boxId) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    let img = document.getElementById(imgId);
                    if (img) img.src = e.target.result;
                    let box = document.getElementById(boxId);
                    if (box) box.classList.remove('d-none');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        async function saveFase2(andProceed = false) {
            try {
                showLoading('Menyimpan data Fase 2 & Survey Kelayakan...');
                let form = document.getElementById('formFase2');
                let formData = new FormData(form);

                let res = await fetchJSON("{{ route('pra-landbanks.store') }}", formData);
                Swal.close();

                if (res.success) {
                    let targetId = res.id || "{{ $land->id ?? '' }}";
                    isFase2Done = true;
                    document.querySelector('#step3 .mdi-lock')?.remove();
                    document.getElementById('step3')?.classList.remove('disabled');
                    sessionStorage.setItem('success_message', 'Data Fase 2 & Survey Kelayakan berhasil disimpan.');
                    if (andProceed && targetId) {
                        window.location.href = "{{ url('/properti/pra-landbank/proses') }}/" + targetId + "?step=3";
                    } else if (targetId) {
                        window.location.href = "{{ url('/properti/pra-landbank/proses') }}/" + targetId + "?step=2";
                    } else {
                        window.location.href = "{{ route('pralandbank.all') }}";
                    }
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

                // Explicitly sync key fields
                const selectPayMethod = document.getElementById('temp_payment_method');
                const chosenMethod = selectPayMethod ? selectPayMethod.value : 'cash';
                formData.set('payment_method_temp', chosenMethod);
                formData.set('payment_method', chosenMethod);

                if (chosenMethod === 'cash') {
                    // CRITICAL: Delete any installments array from formData so they don't get sent when user chose Cash!
                    for (let key of Array.from(formData.keys())) {
                        if (key.startsWith('installments[')) {
                            formData.delete(key);
                        }
                    }
                }

                const selectDuration = document.getElementById('temp_installment_duration');
                if (selectDuration) {
                    formData.set('installment_duration_temp', selectDuration.value);
                }
                const selectCount = document.getElementById('temp_installment_count');
                if (selectCount) {
                    formData.set('installment_count_temp', selectCount.value);
                }
                const selectStatusAkhir = document.getElementById('fase3_status_akhir');
                if (selectStatusAkhir) {
                    formData.set('status', selectStatusAkhir.value);
                }
                const dealPriceInput = document.getElementById('deal_price_input');
                if (dealPriceInput) {
                    formData.set('deal_price', dealPriceInput.value);
                }
                const selectNotaris = form.querySelector('select[name="notaris_id"]');
                if (selectNotaris && selectNotaris.value) {
                    formData.set('notaris_id', selectNotaris.value);
                }
                const inputNotaryDate = form.querySelector('input[name="notary_appointment_date"]');
                if (inputNotaryDate && inputNotaryDate.value) {
                    formData.set('notary_appointment_date', inputNotaryDate.value);
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
                        title: '{!! ($isKeuangan && !$isAdmin) ? "Data Keuangan Berhasil Disimpan!" : "Keputusan Fase 3 Disimpan!" !!}',
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
                let disabledInputs = form.querySelectorAll(':disabled');
                disabledInputs.forEach(el => el.disabled = false);
                let formData = new FormData(form);
                disabledInputs.forEach(el => el.disabled = true);

                const selectPayMethod = document.getElementById('temp_payment_method');
                const chosenMethod = selectPayMethod ? selectPayMethod.value : 'cash';
                formData.set('payment_method_temp', chosenMethod);
                formData.set('payment_method', chosenMethod);

                if (chosenMethod === 'cash') {
                    for (let key of Array.from(formData.keys())) {
                        if (key.startsWith('installments[')) {
                            formData.delete(key);
                        }
                    }
                }

                const selectNotaris = form.querySelector('select[name="notaris_id"]');
                if (selectNotaris && selectNotaris.value) {
                    formData.set('notaris_id', selectNotaris.value);
                }
                const inputNotaryDate = form.querySelector('input[name="notary_appointment_date"]');
                if (inputNotaryDate && inputNotaryDate.value) {
                    formData.set('notary_appointment_date', inputNotaryDate.value);
                }

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
            if (typeof isInitial !== 'boolean') {
                isInitial = false;
            }
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
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-1">
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

        window.togglePbbArrearsField = function(selectEl) {
            let val = $(selectEl).val();
            let $container = $('#pbb_arrears_container');
            if (val === 'nunggak') {
                $container.removeClass('d-none');
                $('#input_pbb_note').focus();
            } else {
                $container.addClass('d-none');
            }
        };

        window.toggleDocProcessNotes = function(selectEl, docId) {
            let val = $(selectEl).val();
            let $card = $(selectEl).closest('.card');
            let container = $card.find('.process-notes-container');
            if (!container.length) {
                container = $(`#processNotesContainer_${docId}`);
            }
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
                                    <button type="button" class="btn btn-xs btn-danger text-white py-1 px-2 ms-1 shadow-sm" onclick="rejectPraDoc(${docId}, ${typeId})" title="Tolak / Revisi" style="font-size: 11px; font-weight: 600; border-radius: 6px;"><i class="mdi mdi-close me-1"></i>Tolak</button>
                                `);
                                
                                // Hide revision note box and ganti file box on approval
                                $(`.revision-box-${typeId}`).addClass('d-none');
                                $(`.ganti-file-box-${typeId}`).addClass('d-none');

                                // Auto check if all applicable documents are now verified
                                const visibleCols = Array.from(document.querySelectorAll('.doc-fase1-col')).filter(c => !c.classList.contains('d-none'));
                                const totalUploads = visibleCols.filter(c => c.querySelector('[id^="action-btns-doc-"]')).length;
                                const totalVerified = visibleCols.filter(c => c.querySelector('[id^="action-btns-doc-"] .bg-soft-success')).length;
                                const isAllNowVerified = res.auto_advanced_to_fase2 || (totalUploads > 0 && totalVerified === totalUploads);

                                if (isAllNowVerified) {
                                    isLegalSah = true;
                                    document.querySelector('#step2 .mdi-lock')?.remove();
                                    document.querySelector('#step3 .mdi-lock')?.remove();
                                    document.getElementById('step2')?.classList.remove('disabled');
                                    document.getElementById('step3')?.classList.remove('disabled');

                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Semua Berkas Berhasil Divalidasi!',
                                        html: `
                                            <p class="text-muted mb-3" style="font-size: 0.92rem;">
                                                Seluruh berkas dokumen legalitas telah dinyatakan <b>Sah (Terverifikasi)</b> oleh Kepala Legal.
                                            </p>
                                            <div class="p-3 rounded-3 text-start mb-2" style="background: #f0fdf4; border: 1.5px solid #86efac;">
                                                <div class="d-flex align-items-center gap-2 text-success fw-bold" style="font-size: 0.85rem;">
                                                    <i class="mdi mdi-check-decagram" style="font-size: 1.1rem;"></i>
                                                    <span>Akses Fase 2 & Fase 3 Telah Terbuka</span>
                                                </div>
                                                <small class="text-muted d-block mt-1" style="font-size: 0.82rem; line-height: 1.5;">
                                                    Anda dapat melanjutkan ke tahap berikutnya yaitu <b>Fase 2 (Survey Kelayakan Teknis & Spasial Map)</b> atau tetap melihat berkas di Fase 1.
                                                </small>
                                            </div>
                                        `,
                                        showCancelButton: true,
                                        confirmButtonColor: '#9a55ff',
                                        cancelButtonColor: '#6c757d',
                                        confirmButtonText: '<i class="mdi mdi-arrow-right-circle me-1"></i> Lanjut ke Fase 2',
                                        cancelButtonText: '<i class="mdi mdi-eye me-1"></i> Tetap di Sini (Lihat Berkas)'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            switchStep(2);
                                        }
                                    });
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
                                    <button type="button" class="btn btn-xs btn-success py-1 px-2 text-white shadow-sm" onclick="approvePraDoc(${docId}, ${typeId})" title="Setujui & Validasi Dokumen" style="font-size: 11px; font-weight: 600; border-radius: 6px;"><i class="mdi mdi-check me-1"></i>Validasi</button>
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

        function autoUploadNotaryDoc(inputEl, fieldName) {
            if (!inputEl.files || inputEl.files.length === 0) return;
            const file = inputEl.files[0];

            // Max 20MB
            if (file.size > 20 * 1024 * 1024) {
                Swal.fire({
                    icon: 'error',
                    title: 'File Terlalu Besar',
                    text: 'Ukuran file maksimal adalah 20MB'
                });
                inputEl.value = '';
                return;
            }

            const landId = '{{ $land->id ?? 0 }}';
            if (!landId || landId === '0') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian',
                    text: 'Data tanah belum tersimpan. Silakan simpan data terlebih dahulu.'
                });
                return;
            }

            const formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('file_field', fieldName);
            formData.append('file', file);

            const uploadUrl = '{{ route("pra-landbank.upload-notary-doc", ["id" => $land->id ?? 0]) }}';

            Swal.fire({
                title: 'Mengunggah Berkas...',
                text: 'Sedang memproses upload berkas notaris secara instan',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            fetch(uploadUrl, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Gagal mengunggah berkas.');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil Diunggah!',
                        text: data.message,
                        timer: 2000,
                        showConfirmButton: false
                    });

                    // Update Badge
                    const badgeEl = document.getElementById(`badge_${fieldName}`);
                    if (badgeEl) {
                        badgeEl.className = 'badge bg-success';
                        badgeEl.innerHTML = '<i class="mdi mdi-check-circle me-1"></i>Terunggah';
                    }

                    // Update Container
                    const containerEl = document.getElementById(`container_${fieldName}`);
                    if (containerEl) {
                        const newHtml = `
                            <div class="p-2.5 px-3 rounded-3 mb-2" style="background: #f0fdf4; border: 1.5px solid #86efac;">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <div class="p-1.5 rounded-2 flex-shrink-0 bg-success bg-opacity-10 text-success">
                                        <i class="mdi mdi-file-check-outline" style="font-size: 1.25rem;"></i>
                                    </div>
                                    <div class="overflow-hidden flex-grow-1">
                                        <span class="d-block fw-bold text-success" style="font-size: 0.82rem; line-height: 1.2;">${data.doc_label} Terunggah</span>
                                        <small class="text-muted text-truncate d-block" style="font-size: 0.72rem;">${data.filename}</small>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-xs btn-success text-white py-1.5 px-3 d-flex align-items-center justify-content-center w-100 shadow-sm btn-preview-doc"
                                    data-url="${data.preview_url}"
                                    data-ext="${data.ext}"
                                    data-label="${data.doc_label}"
                                    style="font-size: 0.78rem; font-weight: 600; border-radius: 6px;">
                                    <i class="mdi mdi-eye me-1"></i>Lihat Berkas
                                </button>
                            </div>
                            <div class="pratanah-file-upload-modern mb-1">
                                <input type="file" name="${fieldName}" accept=".pdf,.jpg,.jpeg,.png" onchange="autoUploadNotaryDoc(this, '${fieldName}')">
                                <div class="pratanah-file-label-modern py-1.5 px-2" style="background: #f8fafc; border: 1px dashed #cbd5e1;">
                                    <i class="mdi mdi-cloud-sync" style="font-size: 1.1rem; color: #64748b;"></i>
                                    <div class="pratanah-file-info-modern">
                                        <span class="file-label-text text-secondary" style="font-size: 0.76rem; font-weight: 600;">Ganti Berkas / Upload Ulang</span>
                                        <span class="file-label-hint" style="font-size: 0.7rem;">PDF, JPG, PNG (Auto Upload)</span>
                                    </div>
                                </div>
                            </div>
                        `;
                        containerEl.innerHTML = newHtml;
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: data.message || 'Terjadi kesalahan saat mengunggah berkas.'
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: error.message || 'Terjadi kesalahan jaringan/server.'
                });
            });
        }

        function autoSaveNotaryInfo() {
            const landId = '{{ $land->id ?? 0 }}';
            if (!landId || landId === '0') return;

            const notarisId = $('#select_notaris_id').val() || $('select[name="notaris_id"]').val() || document.getElementById('select_notaris_id')?.value;
            const appointmentDate = document.getElementById('input_notary_appointment_date')?.value || $('input[name="notary_appointment_date"]').val();

            const updateUrl = '{{ route("pra-landbank.update-notary-info", ["id" => $land->id ?? 0]) }}';

            fetch(updateUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    notaris_id: notarisId,
                    notary_appointment_date: appointmentDate
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2500,
                        timerProgressBar: true
                    });
                    Toast.fire({
                        icon: 'success',
                        title: 'Data Notaris & Jadwal Tersimpan'
                    });
                }
            })
            .catch(err => {
                console.error('Auto-save notary info error:', err);
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

        // ==========================================
        // DOKUMEN DINAMIS & WORKFLOW FASE 4 (REPEATER)
        // ==========================================
        const FASE4_DOC_DATA = @json($workflowDocs ?? []);

        let currentSyaratFilesMap = {};
        let deletedSyaratFiles = [];

        function escapeHtml(str) {
            if (!str) return '';
            return String(str)
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }

        function parseSyaratLines(text) {
            if (!text) return [];
            return text.split(/\r?\n/)
                .map(line => line.replace(/^[•\-\*\d+\.]\s*/u, '').trim())
                .filter(line => line.length > 0);
        }

        function renderModalSyaratChecklist(items, checkedList = [], filesMap = {}) {
            const container = document.getElementById('modal_syarat_checkboxes_container');
            const badge = document.getElementById('modal_syarat_summary_badge');
            if (!container) return;

            if (!Array.isArray(items) || items.length === 0) {
                container.innerHTML = `
                    <div class="text-center text-muted py-3" style="font-size: 0.74rem;">
                        <i class="mdi mdi-information-outline me-1"></i>Belum ada prasyarat berkas untuk dokumen ini. Gunakan tombol 'Edit Teks' di bawah untuk menambahkan prasyarat.
                    </div>
                `;
                if (badge) {
                    badge.textContent = '0/0 Terpenuhi';
                    badge.className = 'badge bg-light text-muted border';
                }
                return;
            }

            const checkedSet = new Set(Array.isArray(checkedList) ? checkedList : []);
            let html = '';

            items.forEach((item, idx) => {
                const filePath = filesMap[item] || filesMap[idx] || null;
                const hasFile = !!filePath;
                const isChecked = checkedSet.has(item) || hasFile;
                const safeItem = escapeHtml(item);
                const fileName = filePath ? filePath.split('/').pop() : '';
                const fileExt = filePath ? filePath.split('.').pop().toLowerCase() : 'pdf';
                const cleanFilePath = filePath ? filePath.replace(/^uploads\//, '') : '';

                html += `
                    <div class="p-2.5 rounded-2 mb-2 bg-white border syarat-item-row" id="syarat_item_row_${idx}" style="transition: all 0.2s ease;">
                        <div class="d-flex align-items-center justify-content-between gap-2 mb-1.5">
                            <div class="form-check d-flex align-items-center gap-2 m-0 flex-grow-1">
                                <input class="form-check-input modal-syarat-chk m-0" type="checkbox" name="syarat_checklist[]" value="${safeItem}" id="modal_syarat_chk_${idx}" ${isChecked ? 'checked' : ''} onchange="updateModalSyaratSummary()">
                                <label class="form-check-label fw-semibold ${isChecked ? 'text-success' : 'text-dark'} mb-0 user-select-none" for="modal_syarat_chk_${idx}" style="cursor: pointer; font-size: 0.78rem;">
                                    ${safeItem}
                                </label>
                            </div>
                            <span class="badge ${hasFile ? 'bg-success bg-opacity-10 text-success border border-success border-opacity-25' : 'bg-light text-muted border'}" id="syarat_badge_status_${idx}" style="font-size: 0.68rem; font-weight: 600;">
                                ${hasFile ? '<i class="mdi mdi-check-circle me-0.5"></i>Ada Berkas' : 'Belum Ada Berkas'}
                            </span>
                        </div>

                        <!-- SLOT UPLOAD BERKAS KHUSUS BUTIR PRASYARAT INI -->
                        <div class="d-flex align-items-center justify-content-between gap-2 pt-1.5 border-top" id="syarat_file_slot_${idx}" style="border-color: #f1f5f9 !important;">
                            ${hasFile ? `
                                <div class="d-flex align-items-center gap-1.5 overflow-hidden me-auto" style="max-width: 62%;">
                                    <i class="mdi mdi-file-document-check text-success fs-6 flex-shrink-0"></i>
                                    <span class="text-truncate fw-semibold text-dark" style="font-size: 0.73rem;" title="${fileName}">${fileName}</span>
                                </div>
                                <div class="d-flex align-items-center gap-1 flex-shrink-0">
                                    <button type="button" class="btn btn-xs btn-outline-success py-1 px-2 rounded-1 btn-preview-doc" data-url="/dokumen/preview/${cleanFilePath}" data-ext="${fileExt}" data-label="${safeItem}" style="font-size: 0.72rem; font-weight: 600;">
                                        <i class="mdi mdi-eye me-1"></i>Lihat
                                    </button>
                                    <label class="btn btn-xs btn-outline-primary py-1 px-2 rounded-1 m-0" style="font-size: 0.72rem; cursor: pointer; font-weight: 600;">
                                        <i class="mdi mdi-file-replace me-1"></i>Ganti
                                        <input type="file" name="syarat_files[${idx}]" accept=".pdf,.jpg,.jpeg,.png,.webp,.doc,.docx" class="d-none syarat-item-file-input" data-idx="${idx}" data-item="${safeItem}" onchange="handleSyaratItemFileChange(this, ${idx})">
                                    </label>
                                    <button type="button" class="btn btn-xs btn-outline-danger py-1 px-1.5 rounded-1" onclick="removeSyaratItemFile(${idx}, '${safeItem}')" title="Hapus Berkas">
                                        <i class="mdi mdi-trash-can-outline"></i>
                                    </button>
                                </div>
                            ` : `
                                <div class="d-flex align-items-center gap-2 flex-grow-1">
                                    <label class="btn btn-xs btn-outline-primary py-1 px-2.5 rounded-1 d-inline-flex align-items-center gap-1.5 m-0" style="font-size: 0.73rem; cursor: pointer; background-color: #faf5ff; font-weight: 600;">
                                        <i class="mdi mdi-cloud-upload text-primary"></i>
                                        <span id="syarat_file_label_${idx}">Upload Berkas</span>
                                        <input type="file" name="syarat_files[${idx}]" accept=".pdf,.jpg,.jpeg,.png,.webp,.doc,.docx" class="d-none syarat-item-file-input" data-idx="${idx}" data-item="${safeItem}" onchange="handleSyaratItemFileChange(this, ${idx})">
                                    </label>
                                    <span class="text-muted text-truncate" style="font-size: 0.69rem;" id="syarat_file_status_${idx}">PDF, JPG, PNG, DOCX (Maks 25MB)</span>
                                </div>
                            `}
                        </div>
                    </div>
                `;
            });

            container.innerHTML = html;
            updateModalSyaratSummary();
        }

        function handleSyaratItemFileChange(input, idx) {
            if (input.files && input.files[0]) {
                const file = input.files[0];
                const chk = document.getElementById(`modal_syarat_chk_${idx}`);
                if (chk) chk.checked = true;

                const labelEl = document.getElementById(`syarat_file_label_${idx}`);
                if (labelEl) {
                    labelEl.textContent = 'Ganti: ' + file.name.substring(0, 15) + '...';
                }
                const statusEl = document.getElementById(`syarat_file_status_${idx}`);
                if (statusEl) {
                    statusEl.innerHTML = `<span class="text-success fw-bold"><i class="mdi mdi-check-circle me-1"></i>${file.name}</span>`;
                }
                const badgeEl = document.getElementById(`syarat_badge_status_${idx}`);
                if (badgeEl) {
                    badgeEl.className = 'badge bg-success bg-opacity-10 text-success border border-success border-opacity-25';
                    badgeEl.innerHTML = '<i class="mdi mdi-check-circle me-0.5"></i>Siap Diunggah';
                }

                const row = document.getElementById(`syarat_item_row_${idx}`);
                if (row) {
                    row.classList.add('border-success', 'border-opacity-50');
                }

                updateModalSyaratSummary();
            }
        }

        function removeSyaratItemFile(idx, itemName) {
            if (!deletedSyaratFiles.includes(itemName)) {
                deletedSyaratFiles.push(itemName);
            }
            if (currentSyaratFilesMap[itemName]) {
                delete currentSyaratFilesMap[itemName];
            }
            if (currentSyaratFilesMap[idx]) {
                delete currentSyaratFilesMap[idx];
            }

            const slot = document.getElementById(`syarat_file_slot_${idx}`);
            if (slot) {
                slot.innerHTML = `
                    <div class="d-flex align-items-center gap-2 flex-grow-1">
                        <label class="btn btn-xs btn-outline-primary py-1 px-2.5 rounded-1 d-inline-flex align-items-center gap-1.5 m-0" style="font-size: 0.73rem; cursor: pointer; background-color: #faf5ff; font-weight: 600;">
                            <i class="mdi mdi-cloud-upload text-primary"></i>
                            <span id="syarat_file_label_${idx}">Upload Berkas</span>
                            <input type="file" name="syarat_files[${idx}]" accept=".pdf,.jpg,.jpeg,.png,.webp,.doc,.docx" class="d-none syarat-item-file-input" data-idx="${idx}" data-item="${escapeHtml(itemName)}" onchange="handleSyaratItemFileChange(this, ${idx})">
                        </label>
                        <span class="text-danger" style="font-size: 0.69rem;" id="syarat_file_status_${idx}"><i class="mdi mdi-alert-circle-outline me-0.5"></i>Berkas dihapus</span>
                    </div>
                `;
            }

            const badgeEl = document.getElementById(`syarat_badge_status_${idx}`);
            if (badgeEl) {
                badgeEl.className = 'badge bg-light text-muted border';
                badgeEl.innerHTML = 'Belum Ada Berkas';
            }

            updateModalSyaratSummary();
        }

        function updateModalSyaratSummary() {
            const total = document.querySelectorAll('.modal-syarat-chk').length;
            const checked = document.querySelectorAll('.modal-syarat-chk:checked').length;
            const badge = document.getElementById('modal_syarat_summary_badge');

            document.querySelectorAll('.modal-syarat-chk').forEach(cb => {
                const row = cb.closest('.syarat-item-row') || cb.closest('.form-check');
                const label = row?.querySelector('.form-check-label');
                if (cb.checked) {
                    label?.classList.remove('text-dark');
                    label?.classList.add('text-success');
                } else {
                    label?.classList.remove('text-success');
                    label?.classList.add('text-dark');
                }
            });

            if (badge) {
                if (total === 0) {
                    badge.textContent = '0/0 Terpenuhi';
                    badge.className = 'badge bg-light text-muted border';
                } else if (checked >= total) {
                    badge.textContent = `${checked}/${total} Lengkap (100%)`;
                    badge.className = 'badge bg-success text-white shadow-sm';
                } else {
                    badge.textContent = `${checked}/${total} Terpenuhi`;
                    badge.className = 'badge bg-soft-info text-info border';
                }
            }
        }

        function onSyaratTextInput(val) {
            const currentlyChecked = Array.from(document.querySelectorAll('.modal-syarat-chk:checked')).map(cb => cb.value);
            const items = parseSyaratLines(val);
            renderModalSyaratChecklist(items, currentlyChecked, currentSyaratFilesMap);
        }

        function handleModalFase4File(input) {
            const labelEl = document.getElementById('modal_fase4_file_label');
            if (input.files && input.files[0]) {
                labelEl.textContent = input.files[0].name;
                labelEl.classList.add('text-primary');
            } else {
                labelEl.textContent = 'Pilih Berkas Baru (Opsional)';
                labelEl.classList.remove('text-primary');
            }
        }

        function applyMasterToFase4Form(masterId) {
            if (!masterId) return;
            const select = document.getElementById('modal_fase4_master_select');
            const selectedOption = select.options[select.selectedIndex];
            if (!selectedOption) return;

            const kode = selectedOption.getAttribute('data-kode') || '';
            const nama = selectedOption.getAttribute('data-nama') || '';
            const instansi = selectedOption.getAttribute('data-instansi') || '';
            const biaya = selectedOption.getAttribute('data-biaya') || '';
            const syarat = selectedOption.getAttribute('data-syarat') || '';
            const deskripsi = selectedOption.getAttribute('data-deskripsi') || '';

            if (kode) document.getElementById('modal_fase4_poin_label').value = kode;
            if (nama) document.getElementById('modal_fase4_doc_name').value = nama;
            if (instansi) document.getElementById('modal_fase4_instansi').value = instansi;
            if (biaya && parseInt(biaya) > 0) {
                document.getElementById('modal_fase4_nominal').value = 'Rp ' + parseInt(biaya).toLocaleString('id-ID');
            }
            if (deskripsi) {
                document.getElementById('modal_fase4_notes').value = deskripsi;
            }

            // Syarat Dokumen & Checklist
            const syaratInput = document.getElementById('modal_fase4_syarat_dokumen');
            if (syaratInput) syaratInput.value = syarat || '';
            const items = parseSyaratLines(syarat || '');
            currentSyaratFilesMap = {};
            deletedSyaratFiles = [];
            renderModalSyaratChecklist(items, [], {});
        }

        function openFase4DocModal(docId) {
            const modalEl = document.getElementById('modalFase4Doc');
            if (!modalEl) return;

            const form = document.getElementById('formFase4Doc');
            form.reset();
            currentSyaratFilesMap = {};
            deletedSyaratFiles = [];

            const masterSelect = document.getElementById('modal_fase4_master_select');
            if (masterSelect) masterSelect.value = '';

            const titleEl = document.getElementById('modalFase4DocTitle');
            const hiddenId = document.getElementById('modal_fase4_doc_id');
            const poinInput = document.getElementById('modal_fase4_poin_label');
            const nameInput = document.getElementById('modal_fase4_doc_name');
            const instansiInput = document.getElementById('modal_fase4_instansi');
            const numberInput = document.getElementById('modal_fase4_doc_number');
            const dateInput = document.getElementById('modal_fase4_doc_date');
            const statusSelect = document.getElementById('modal_fase4_status');
            const nominalInput = document.getElementById('modal_fase4_nominal');
            const luasInput = document.getElementById('modal_fase4_luas');
            const notesInput = document.getElementById('modal_fase4_notes');
            const syaratInput = document.getElementById('modal_fase4_syarat_dokumen');
            const previewContainer = document.getElementById('modal_fase4_current_file_preview');
            const fileLabel = document.getElementById('modal_fase4_file_label');
            
            previewContainer.innerHTML = '';
            previewContainer.classList.add('d-none');
            fileLabel.textContent = 'Pilih Berkas Baru (Opsional)';
            fileLabel.classList.remove('text-primary');

            if (docId) {
                // Find existing doc
                let doc = FASE4_DOC_DATA.find(d => String(d.id) === String(docId));
                if (!doc) {
                    const card = document.getElementById(`fase4_doc_card_${docId}`);
                    if (card) {
                        doc = {
                            id: docId,
                            poin_label: card.querySelector('.fase4-card-poin')?.innerText || '',
                            doc_name: card.querySelector('.fase4-card-title')?.innerText || '',
                            instansi: card.querySelector('.fase4-card-instansi')?.innerText || '',
                            status: card.getAttribute('data-status') || 'proses'
                        };
                    }
                }

                if (doc) {
                    titleEl.innerText = `Edit: ${doc.doc_name || 'Dokumen'}`;
                    hiddenId.value = doc.id;
                    poinInput.value = doc.poin_label || '';
                    nameInput.value = doc.doc_name || '';
                    instansiInput.value = doc.instansi || '';
                    numberInput.value = doc.doc_number || '';
                    dateInput.value = doc.doc_date || '';
                    statusSelect.value = doc.status || 'belum';
                    nominalInput.value = doc.nominal ? (typeof formatRupiahTemp === 'function' ? 'Rp ' + (parseInt(doc.nominal.toString().replace(/[^0-9]/g, '')) || 0).toLocaleString('id-ID') : doc.nominal) : '';
                    luasInput.value = doc.luas || '';
                    notesInput.value = doc.notes || '';

                    // Load syarat items and checklist & files
                    const rawSyarat = doc.syarat_dokumen || '';
                    if (syaratInput) syaratInput.value = rawSyarat;

                    let items = doc.syarat_items || [];
                    if (!items || items.length === 0) {
                        items = parseSyaratLines(rawSyarat);
                    }
                    const checkedList = doc.syarat_checklist || [];
                    currentSyaratFilesMap = doc.syarat_files || {};
                    renderModalSyaratChecklist(items, checkedList, currentSyaratFilesMap);

                    if (doc.file_path) {
                        const cleanPath = doc.file_path.replace('uploads/', '');
                        const ext = doc.file_path.split('.').pop();
                        previewContainer.innerHTML = `
                            <div class="p-2 px-3 rounded-2 bg-success bg-opacity-10 border border-success border-opacity-25 d-flex align-items-center justify-content-between mb-2">
                                <div class="d-flex align-items-center gap-2 overflow-hidden me-2">
                                    <i class="mdi mdi-file-check text-success fs-5"></i>
                                    <span class="text-truncate fw-semibold text-dark" style="font-size: 0.8rem;">Berkas SK Terbit (${ext.toUpperCase()})</span>
                                </div>
                                <button type="button" class="btn btn-xs btn-success text-white py-1 px-2.5 shadow-sm btn-preview-doc" data-url="/dokumen/preview/${cleanPath}" data-ext="${ext}" data-label="${doc.doc_name || 'Dokumen'}" style="font-size: 0.75rem;">
                                    <i class="mdi mdi-eye me-1"></i>Lihat Berkas
                                </button>
                            </div>
                        `;
                        previewContainer.classList.remove('d-none');
                    }
                }
            } else {
                titleEl.innerText = 'Tambah Dokumen / Tahapan Workflow Baru';
                hiddenId.value = '';
                statusSelect.value = 'proses';
                if (syaratInput) syaratInput.value = '';
                currentSyaratFilesMap = {};
                deletedSyaratFiles = [];
                renderModalSyaratChecklist([], [], {});
            }

            const modalObj = bootstrap.Modal.getOrCreateInstance(modalEl);
            modalObj.show();
        }

        function editFase4Doc(docId) {
            openFase4DocModal(docId);
        }

        function submitModalFase4Doc(e) {
            e.preventDefault();
            const landId = '{{ $land->id ?? 0 }}';
            if (!landId || landId === '0') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian',
                    text: 'Data tanah belum tersimpan di database. Simpan data awal terlebih dahulu.'
                });
                return;
            }

            const form = document.getElementById('formFase4Doc');
            const formData = new FormData(form);
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('existing_syarat_files', JSON.stringify(currentSyaratFilesMap));
            formData.append('deleted_syarat_files', JSON.stringify(deletedSyaratFiles));

            const uploadUrl = '{{ route("pra-landbank.upload-custom-workflow-doc", ["id" => $land->id ?? 0]) }}';

            Swal.fire({
                title: 'Menyimpan Dokumen...',
                text: 'Sedang memproses penyimpanan data dokumen dan upload berkas',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            fetch(uploadUrl, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Gagal menyimpan dokumen.');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil Disimpan!',
                        text: data.message,
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: data.message || 'Terjadi kesalahan saat menyimpan dokumen.'
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: error.message || 'Terjadi kesalahan jaringan/server.'
                });
            });
        }

        function deleteFase4Doc(docId, docName) {
            const landId = '{{ $land->id ?? 0 }}';
            if (!landId || landId === '0') return;

            Swal.fire({
                title: `Hapus ${docName || 'Dokumen Ini'}?`,
                text: 'Dokumen dan seluruh file lampirannya akan dihapus dari daftar workflow.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="mdi mdi-delete me-1"></i> Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Menghapus Dokumen...',
                        text: 'Mohon tunggu sebentar',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    const deleteUrl = '{{ route("pra-landbank.delete-custom-workflow-doc", ["id" => $land->id ?? 0]) }}';

                    fetch(deleteUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({ doc_id: docId })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Dokumen Dihapus',
                                text: data.message,
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: data.message || 'Gagal menghapus dokumen.'
                            });
                        }
                    })
                    .catch(err => {
                        console.error('Delete doc error:', err);
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Terjadi kesalahan saat menghapus dokumen.'
                        });
                    });
                }
            });
        }

        function loadFase4DefaultTemplate() {
            const landId = '{{ $land->id ?? 0 }}';
            if (!landId || landId === '0') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian',
                    text: 'Data tanah belum tersimpan di database. Simpan data awal terlebih dahulu.'
                });
                return;
            }

            Swal.fire({
                title: 'Muat Template Standar (Poin 7–17)?',
                text: 'Sistem akan menambahkan paket dokumen standar legalitas & perizinan BPN ke dalam daftar. Anda tetap bebas mengedit, mengubah, atau menghapus item yang tidak dibutuhkan.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#9a55ff',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="mdi mdi-clipboard-check me-1"></i> Ya, Muat Template',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Memuat Template...',
                        text: 'Sedang menyiapkan paket dokumen legalitas',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    const loadUrl = '{{ route("pra-landbank.load-fase4-template", ["id" => $land->id ?? 0]) }}';

                    fetch(loadUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Template Dimuat!',
                                text: data.message,
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: data.message || 'Gagal memuat template dokumen.'
                            });
                        }
                    })
                    .catch(err => {
                        console.error('Load template error:', err);
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Terjadi kesalahan jaringan/server.'
                        });
                    });
                }
            });
        }

        // ==========================================
        // MASTER DOKUMEN PERIZINAN PICKER FUNCTIONS
        // ==========================================
        function openMasterPickerModal() {
            const modalEl = document.getElementById('modalPickerMasterPerizinan');
            if (!modalEl) return;

            const searchInput = document.getElementById('searchMasterPickerInput');
            const categorySelect = document.getElementById('filterMasterCategorySelect');
            const checkAll = document.getElementById('checkAllMasterPicker');

            if (searchInput) searchInput.value = '';
            if (categorySelect) categorySelect.value = '';
            if (checkAll) checkAll.checked = false;

            document.querySelectorAll('.master-picker-checkbox:not(:disabled)').forEach(cb => {
                cb.checked = false;
            });

            document.querySelectorAll('.master-picker-item').forEach(el => {
                el.classList.remove('d-none');
            });

            updatePickerSelectedCount();

            const modalObj = bootstrap.Modal.getOrCreateInstance(modalEl);
            modalObj.show();
        }

        function togglePickerCardClick(event, masterId, isAlreadyAdded) {
            if (isAlreadyAdded) return;
            if (event.target.tagName === 'INPUT' || event.target.closest('input')) return;
            const cb = document.getElementById('picker_chk_' + masterId);
            if (cb && !cb.disabled) {
                cb.checked = !cb.checked;
                updatePickerSelectedCount();
            }
        }

        function togglePickerSelectAll(masterCheckbox) {
            const isChecked = masterCheckbox.checked;
            document.querySelectorAll('.master-picker-item:not(.d-none) .master-picker-checkbox:not(:disabled)').forEach(cb => {
                cb.checked = isChecked;
            });
            updatePickerSelectedCount();
        }

        function updatePickerSelectedCount() {
            const allCheckboxes = document.querySelectorAll('.master-picker-checkbox');
            let checkedCount = 0;

            allCheckboxes.forEach(cb => {
                const card = document.getElementById('picker_card_' + cb.value);
                if (cb.checked) {
                    checkedCount++;
                    if (card) card.classList.add('is-checked');
                } else {
                    if (card) card.classList.remove('is-checked');
                }
            });

            const textEl = document.getElementById('masterPickerSelectedText');
            const btnTextEl = document.getElementById('btnSubmitMasterPickerText');
            const btnEl = document.getElementById('btnSubmitMasterPicker');

            if (textEl) {
                textEl.textContent = `${checkedCount} dokumen dipilih`;
            }
            if (btnTextEl) {
                btnTextEl.textContent = checkedCount > 0 ? `Tambahkan ${checkedCount} Dokumen Terpilih` : 'Tambahkan Dokumen Terpilih';
            }
            if (btnEl) {
                btnEl.disabled = checkedCount === 0;
            }
        }

        function filterMasterPickerCategory(cat) {
            const query = (document.getElementById('searchMasterPickerInput')?.value || '').toLowerCase().trim();
            applyMasterPickerFilters(cat, query);
        }

        function searchMasterPicker(query) {
            const cat = document.getElementById('filterMasterCategorySelect')?.value || '';
            applyMasterPickerFilters(cat, query.toLowerCase().trim());
        }

        function applyMasterPickerFilters(category, query) {
            document.querySelectorAll('.master-picker-item').forEach(el => {
                const itemCat = el.getAttribute('data-kategori') || '';
                const searchContent = el.getAttribute('data-search') || '';

                const matchCat = !category || itemCat === category;
                const matchQuery = !query || searchContent.includes(query);

                if (matchCat && matchQuery) {
                    el.classList.remove('d-none');
                } else {
                    el.classList.add('d-none');
                }
            });

            // Update master check all status
            const visibleCheckboxes = document.querySelectorAll('.master-picker-item:not(.d-none) .master-picker-checkbox:not(:disabled)');
            const allChecked = visibleCheckboxes.length > 0 && Array.from(visibleCheckboxes).every(cb => cb.checked);
            const masterCheckbox = document.getElementById('checkAllMasterPicker');
            if (masterCheckbox) {
                masterCheckbox.checked = allChecked;
            }

            updatePickerSelectedCount();
        }

        function submitBatchFromMaster() {
            const landId = '{{ $land->id ?? 0 }}';
            if (!landId || landId === '0') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian',
                    text: 'Data tanah belum tersimpan di database. Simpan data awal terlebih dahulu.'
                });
                return;
            }

            const selectedCheckboxes = document.querySelectorAll('.master-picker-checkbox:checked');
            const masterIds = Array.from(selectedCheckboxes).map(cb => cb.value);

            if (masterIds.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Pilih Dokumen',
                    text: 'Silakan centang setidaknya satu dokumen perizinan dari daftar master.'
                });
                return;
            }

            Swal.fire({
                title: `Tambahkan ${masterIds.length} Dokumen?`,
                text: 'Dokumen terpilih akan langsung dimasukkan ke alur kerja Fase 4 lahan ini.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#9a55ff',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="mdi mdi-plus-box-multiple me-1"></i> Ya, Tambahkan!',
                cancelButtonText: 'Batal'
            }).then((res) => {
                if (res.isConfirmed) {
                    Swal.fire({
                        title: 'Menambahkan Dokumen...',
                        text: 'Sedang menyinkronkan data perizinan',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    const batchUrl = '{{ route("pra-landbank.add-from-master", ["id" => $land->id ?? 0]) }}';

                    fetch(batchUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({ master_ids: masterIds })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil Ditambahkan!',
                                text: data.message,
                                timer: 1600,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: data.message || 'Terjadi kesalahan saat menambahkan dokumen dari master.'
                            });
                        }
                    })
                    .catch(err => {
                        console.error('Batch add error:', err);
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Terjadi kesalahan koneksi server.'
                        });
                    });
                }
            });
        }

        function filterFase4Docs(status, btn) {
            const filterBtns = document.querySelectorAll('.fase4-tab-item, .fase4-filter-btn');
            filterBtns.forEach(b => {
                b.classList.remove('active', 'btn-primary', 'shadow-sm');
            });

            if (btn) {
                btn.classList.add('active');
            }

            const cards = document.querySelectorAll('.fase4-doc-card');
            let visibleCount = 0;

            cards.forEach(card => {
                const cardStatus = card.getAttribute('data-status');
                if (status === 'all' || cardStatus === status) {
                    card.style.display = '';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            const emptyState = document.getElementById('fase4_docs_empty_state');
            if (emptyState) {
                if (visibleCount === 0 && cards.length > 0) {
                    emptyState.style.display = '';
                    emptyState.innerHTML = `
                        <div class="p-4 text-center text-muted bg-light rounded-3 border w-100 my-2" style="font-size: 0.85rem;">
                            <i class="mdi mdi-filter-remove-outline me-1 fs-4 d-block mb-1 text-secondary"></i>
                            Tidak ada dokumen dengan filter status <strong>${status.toUpperCase()}</strong>.
                        </div>
                    `;
                } else {
                    emptyState.style.display = 'none';
                }
            }
        }

        function searchFase4Docs(query) {
            const q = (query || '').toLowerCase().trim();
            const cards = document.querySelectorAll('.fase4-doc-card');
            let visibleCount = 0;

            cards.forEach(card => {
                const text = card.textContent.toLowerCase();
                if (!q || text.includes(q)) {
                    card.style.display = '';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            const emptyState = document.getElementById('fase4_docs_empty_state');
            if (emptyState) {
                if (visibleCount === 0 && cards.length > 0) {
                    emptyState.style.display = '';
                    emptyState.innerHTML = `
                        <div class="p-4 text-center text-muted bg-light rounded-3 border w-100 my-2" style="font-size: 0.85rem;">
                            <i class="mdi mdi-magnify-close me-1 fs-4 d-block mb-1 text-secondary"></i>
                            Tidak ada dokumen yang cocok dengan pencarian "<strong>${query}</strong>".
                        </div>
                    `;
                } else {
                    emptyState.style.display = 'none';
                }
            }
        }

        function confirmFinalizePasca() {
            const landId = '{{ $land->id ?? 0 }}';
            if (!landId || landId === '0') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian',
                    text: 'Data tanah belum tersimpan. Silakan simpan data terlebih dahulu.'
                });
                return;
            }

            // Find SHGB Induk document from Fase 4 docs
            const shgbDoc = FASE4_DOC_DATA.find(d => (d.doc_name && d.doc_name.toLowerCase().includes('shgb induk')) || d.id === 'shgb_induk');
            
            const shgbNo = shgbDoc ? (shgbDoc.doc_number || '') : '';
            const shgbDate = shgbDoc ? (shgbDoc.doc_date || '') : '';
            const shgbArea = shgbDoc ? (shgbDoc.luas || '') : '';

            if (!shgbNo) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Nomor SHGB Induk Belum Terisi',
                    html: `
                        <p class="text-muted small mb-3">
                            Nomor Sertifikat SHGB Induk an. PT pada Poin 17 belum terdaftar atau masih kosong.
                        </p>
                        <div class="p-3 rounded-3 bg-light text-start border small">
                            Silakan klik <b>Edit</b> pada kartu <b>Poin 17 (Penerbitan Sertifikat SHGB Induk an. PT)</b> untuk mengisi Nomor SHGB Induk, Tanggal Terbit, dan Luas sebelum melakukan finalisasi.
                        </div>
                    `,
                    confirmButtonText: 'Buka Form SHGB Induk',
                    showCancelButton: true,
                    cancelButtonText: 'Batal'
                }).then((res) => {
                    if (res.isConfirmed) {
                        openFase4DocModal('shgb_induk');
                    }
                });
                return;
            }

            Swal.fire({
                title: 'Finalisasi ke Pasca Land Bank?',
                html: `
                    <p class="text-muted small mb-2">
                        Lahan ini akan resmi diterbitkan <b>SHGB Induk No. ${shgbNo}</b> atas nama PT dan dialihkan statusnya menjadi <b>Tanah Pasca Land Bank</b> (siap untuk dipecah kavling).
                    </p>
                    <div class="p-2.5 rounded-3 bg-success bg-opacity-10 border border-success border-opacity-25 text-success small fw-semibold text-start">
                        <i class="mdi mdi-check-circle me-1"></i> Data SHGB Induk valid dan siap diterbitkan ke Master Pasca Land Bank.
                    </div>
                `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#22c55e',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="mdi mdi-shield-crown me-1"></i> Ya, Finalisasi Sekarang!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Memproses Finalisasi...',
                        text: 'Sedang mendaftarkan tanah ke database Pasca Land Bank',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    const finalizeUrl = '{{ route("pra-landbank.finalize-pasca", ["id" => $land->id ?? 0]) }}';

                    fetch(finalizeUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({
                            shgb_induk_no: shgbNo,
                            shgb_induk_date: shgbDate,
                            shgb_induk_area: shgbArea
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil Masuk Pasca Land Bank!',
                                text: data.message,
                                confirmButtonText: 'Buka Master Tanah Pasca Land Bank'
                            }).then(() => {
                                if (data.redirect_url) {
                                    window.location.href = data.redirect_url;
                                } else {
                                    window.location.reload();
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: data.message || 'Terjadi kesalahan saat memproses finalisasi.'
                            });
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: error.message || 'Terjadi kesalahan jaringan/server.'
                        });
                    });
                }
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

            // Auto-save notary on change & blur
            const notaryDateInput = document.getElementById('input_notary_appointment_date');
            if (notaryDateInput) {
                notaryDateInput.addEventListener('change', autoSaveNotaryInfo);
                notaryDateInput.addEventListener('blur', autoSaveNotaryInfo);
            }

            if (typeof $ !== 'undefined') {
                $('select[name="notaris_id"], #select_notaris_id').on('change', function() {
                    autoSaveNotaryInfo();
                });
                $('#input_notary_appointment_date').on('change blur', function() {
                    autoSaveNotaryInfo();
                });
            }
        });
    </script>
@endpush
