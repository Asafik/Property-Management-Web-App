@extends('layouts.partial.app')

@section('title', 'Edit Properti - Properti Management')

@section('content')
    <style>
        /* ===== STYLE CSS KHUSUS UNTUK HALAMAN TAMBAH PROPERTI ===== */
        /* Form Styling */
        .properti-form-group {
            margin-bottom: 1rem;
        }

        @media (min-width: 768px) {
            .properti-form-group {
                margin-bottom: 1.2rem;
            }
        }

        .properti-form-group label,
        .properti-form-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: #9a55ff !important;
            margin-bottom: 0.3rem;
            letter-spacing: 0.3px;
            font-family: 'Nunito', sans-serif;
            display: block;
        }

        @media (min-width: 768px) {

            .properti-form-group label,
            .properti-form-label {
                font-size: 0.85rem;
                margin-bottom: 0.4rem;
            }
        }

        .properti-form-control,
        input[type="text"].properti-form-control,
        input[type="number"].properti-form-control,
        input[type="date"].properti-form-control,
        select.properti-form-control,
        textarea.properti-form-control {
            border: 1px solid #e9ecef;
            border-radius: 10px;
            padding: 0.7rem 0.8rem;
            font-size: 0.85rem;
            transition: all 0.2s ease;
            background-color: #ffffff;
            color: #2c2e3f;
            width: 100%;
            font-family: 'Nunito', sans-serif;
        }

        @media (min-width: 768px) {

            .properti-form-control,
            input[type="text"].properti-form-control,
            input[type="number"].properti-form-control,
            input[type="date"].properti-form-control,
            select.properti-form-control,
            textarea.properti-form-control {
                padding: 0.6rem 0.75rem;
                font-size: 0.9rem;
                border-radius: 8px;
            }
        }

        .properti-form-control:focus {
            border-color: #9a55ff;
            box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.1);
            outline: none;
        }

        .properti-form-control.is-invalid {
            border-color: #dc3545;
        }

        .properti-form-control.is-invalid:focus {
            box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
        }

        select.properti-form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%239a55ff' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 12px;
            padding-right: 2rem;
        }

        /* ===== SELECT2 CUSTOM STYLING AGAR SESUAI DENGAN FORM ===== */
        .select2-container--bootstrap-5 .select2-selection {
            border: 1px solid #e9ecef !important;
            border-radius: 10px !important;
            padding: 0.45rem 0.8rem !important;
            min-height: 42px !important;
            height: 42px !important;
            font-family: 'Nunito', sans-serif !important;
            background-color: #ffffff !important;
        }

        .select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
            color: #2c2e3f !important;
            font-size: 0.9rem !important;
            line-height: 26px !important;
            padding-left: 0 !important;
        }

        .select2-container--bootstrap-5 .select2-selection--single .select2-selection__arrow {
            height: 40px !important;
            right: 10px !important;
        }

        .select2-container--bootstrap-5 .select2-selection--single .select2-selection__arrow b {
            border-color: #9a55ff transparent transparent transparent !important;
        }

        @media (min-width: 768px) {
            .select2-container--bootstrap-5 .select2-selection {
                min-height: 38px !important;
                height: 38px !important;
                padding: 0.35rem 0.75rem !important;
                border-radius: 8px !important;
            }

            .select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
                line-height: 24px !important;
            }

            .select2-container--bootstrap-5 .select2-selection--single .select2-selection__arrow {
                height: 36px !important;
            }
        }

        .select2-container--bootstrap-5 .select2-selection:hover {
            border-color: #9a55ff !important;
        }

        .select2-container--bootstrap-5.select2-container--focus .select2-selection,
        .select2-container--bootstrap-5.select2-container--open .select2-selection {
            border-color: #9a55ff !important;
            box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.1) !important;
            outline: none !important;
        }

        .select2-container--bootstrap-5 .select2-dropdown {
            border-color: #e9ecef !important;
            border-radius: 10px !important;
            overflow: hidden !important;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1) !important;
        }

        .select2-container--bootstrap-5 .select2-results__option {
            padding: 0.6rem 0.8rem !important;
            font-size: 0.9rem !important;
            font-family: 'Nunito', sans-serif !important;
        }

        .select2-container--bootstrap-5 .select2-results__option--selected {
            background-color: #ede9fe !important;
            color: #6d28d9 !important;
            font-weight: 700 !important;
        }

        .select2-container--bootstrap-5 .select2-results__option--highlighted {
            background: #f5f3ff !important;
            color: #7c3aed !important;
        }

        .select2-container--bootstrap-5 .select2-search--dropdown .select2-search__field {
            border: 1px solid #e9ecef !important;
            border-radius: 8px !important;
            padding: 0.5rem !important;
            font-family: 'Nunito', sans-serif !important;
            margin: 0.5rem !important;
            width: calc(100% - 1rem) !important;
        }

        .select2-container--bootstrap-5 .select2-search--dropdown .select2-search__field:focus {
            border-color: #9a55ff !important;
            box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.1) !important;
            outline: none !important;
        }

        .select2-container--bootstrap-5 .select2-selection--single .select2-selection__placeholder {
            color: #a5b3cb !important;
        }

        /* Paksa hanya 5 item yang tampil di Select2 */
        .select2-limited-items .select2-results__options {
            max-height: 200px !important;
            /* Kurang lebih 5 item */
            overflow-y: auto !important;
        }

        /* Styling scrollbar */
        .select2-limited-items .select2-results__options::-webkit-scrollbar {
            width: 6px;
        }

        .select2-limited-items .select2-results__options::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .select2-limited-items .select2-results__options::-webkit-scrollbar-thumb {
            background: #9a55ff;
            border-radius: 10px;
        }

        .select2-limited-items .select2-results__options::-webkit-scrollbar-thumb:hover {
            background: #7a3fcc;
        }

        .select2-container {
            display: block !important;
            width: 100% !important;
        }

        /* Input Group */
        .properti-input-group {
            display: flex !important;
            align-items: stretch !important;
            width: 100% !important;
            position: relative;
        }

        .properti-input-group-prepend {
            display: flex !important;
            align-items: stretch !important;
            margin-right: -1px;
            z-index: 2;
        }

        .properti-input-group-text {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            padding: 0.6rem 0.85rem !important;
            font-size: 0.9rem !important;
            font-weight: 600 !important;
            line-height: 1.5 !important;
            color: #6c757d !important;
            text-align: center !important;
            white-space: nowrap !important;
            background-color: #f8f9fa !important;
            border: 1px solid #e9ecef !important;
            border-right: none !important;
            border-top-left-radius: 8px !important;
            border-bottom-left-radius: 8px !important;
            border-top-right-radius: 0 !important;
            border-bottom-right-radius: 0 !important;
            height: 100% !important;
        }

        @media (min-width: 768px) {
            .properti-input-group-text {
                padding: 0.6rem 0.85rem !important;
                font-size: 0.9rem !important;
            }
        }

        .properti-input-group .properti-form-control,
        .properti-input-group input[type="text"].properti-form-control,
        .properti-input-group input[type="number"].properti-form-control {
            border-top-left-radius: 0 !important;
            border-bottom-left-radius: 0 !important;
            border-top-right-radius: 8px !important;
            border-bottom-right-radius: 8px !important;
            position: relative;
            z-index: 1;
            flex: 1 1 auto;
            width: 1%;
        }

        .properti-input-group .properti-form-control:focus,
        .properti-input-group input[type="text"].properti-form-control:focus {
            z-index: 3;
            border-color: #9a55ff !important;
            box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.1) !important;
        }

        /* Button Styling */
        .properti-btn {
            font-size: 0.8rem;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            font-family: 'Nunito', sans-serif;
            display: inline-block;
            text-decoration: none;
            cursor: pointer;
            border: none;
            width: 100%;
            text-align: center;
        }

        @media (min-width: 576px) {
            .properti-btn {
                width: auto;
                padding: 0.5rem 1.2rem;
            }
        }

        .properti-btn-primary {
            background: linear-gradient(to right, #da8cff, #9a55ff);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.3);
        }

        .properti-btn-primary:hover {
            background: linear-gradient(to right, #c77cff, #8a45e6);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(154, 85, 255, 0.4);
        }

        .properti-btn-secondary {
            background: linear-gradient(135deg, #f0f2f5, #e4e6ea);
            border: 1px solid #e9ecef;
            color: #2c2e3f;
        }

        .properti-btn-secondary:hover {
            background: linear-gradient(135deg, #e4e6ea, #d8dce2);
            transform: translateY(-2px);
            color: #2c2e3f;
        }

        .properti-btn-outline-primary {
            background: transparent;
            border: 1px solid #9a55ff;
            color: #9a55ff;
        }

        .properti-btn-outline-primary:hover {
            background: linear-gradient(135deg, #9a55ff, #da8cff);
            color: #ffffff;
            border-color: transparent;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.3);
        }

        .properti-btn-sm {
            padding: 0.25rem 0.75rem;
            font-size: 0.75rem;
        }

        /* Text colors */
        .properti-text-muted {
            color: #a5b3cb !important;
            font-size: 0.7rem;
            display: block;
            margin-top: 0.2rem;
        }

        .properti-text-primary {
            color: #9a55ff !important;
        }

        .properti-text-danger {
            color: #dc3545 !important;
        }

        /* Divider */
        .properti-hr {
            border-top: 1px solid #e9ecef;
            margin: 0.8rem 0;
        }

        /* Alert Styling */
        .properti-alert {
            border: none;
            border-radius: 10px;
            padding: 0.8rem 1rem;
            font-size: 0.8rem;
            border-left: 4px solid;
            margin-bottom: 1rem;
        }

        @media (min-width: 768px) {
            .properti-alert {
                padding: 0.9rem 1rem;
                font-size: 0.85rem;
            }
        }

        .properti-alert-info {
            background: linear-gradient(135deg, #f6f9ff, #f0f4ff);
            color: #2c2e3f;
            border-left-color: #9a55ff;
        }

        .properti-alert-info i {
            color: #9a55ff;
        }

        .properti-alert-success {
            background: linear-gradient(135deg, #f0fff4, #e6f7e6);
            color: #2c2e3f;
            border-left-color: #28a745;
        }

        .properti-alert-danger {
            background: linear-gradient(135deg, #fff0f0, #ffe6e6);
            color: #2c2e3f;
            border-left-color: #dc3545;
        }

        /* Section Title */
        .properti-section-title {
            font-size: 1rem;
            font-weight: 700;
            color: #9a55ff !important;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e9ecef;
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .properti-section-title i {
            color: #9a55ff;
            font-size: 1.1rem;
            background: rgba(154, 85, 255, 0.1);
            padding: 6px;
            border-radius: 8px;
        }

        /* Card Styling */
        .properti-card {
            border: 1px solid #e9ecef;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
            background: #ffffff;
            transition: all 0.3s ease;
            margin-bottom: 1rem;
        }

        .properti-card .properti-card-body {
            padding: 1rem;
        }

        @media (min-width: 768px) {
            .properti-card .properti-card-body {
                padding: 1.2rem;
            }
        }

        /* Map Container */
        .properti-map-container {
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e9ecef;
        }

        /* Grid System */
        .properti-row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -0.3rem;
            margin-left: -0.3rem;
        }

        .properti-col-6,
        .properti-col-12,
        .properti-col-sm-6,
        .properti-col-md-2,
        .properti-col-md-3,
        .properti-col-md-4,
        .properti-col-md-6 {
            position: relative;
            width: 100%;
            padding-right: 0.3rem;
            padding-left: 0.3rem;
            margin-bottom: 0.5rem;
        }

        @media (min-width: 576px) {
            .properti-col-sm-6 {
                flex: 0 0 50%;
                max-width: 50%;
            }
        }

        @media (min-width: 768px) {
            .properti-col-md-2 {
                flex: 0 0 16.666667%;
                max-width: 16.666667%;
            }

            .properti-col-md-3 {
                flex: 0 0 25%;
                max-width: 25%;
            }

            .properti-col-md-4 {
                flex: 0 0 33.333333%;
                max-width: 33.333333%;
            }

            .properti-col-md-6 {
                flex: 0 0 50%;
                max-width: 50%;
            }
        }

        /* ===== MODERN CHECKBOX STYLING ===== */
        .properti-checkbox-group {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            justify-content: flex-start;
            margin-top: 0.5rem;
        }

        .properti-checkbox-wrapper {
            position: relative;
            min-width: 140px;
            flex: 1 1 auto;
        }

        .properti-checkbox-input {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .properti-checkbox-label {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 0.65rem 1.2rem;
            background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
            border: 2px solid #e9ecef;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            width: 100%;
        }

        .properti-checkbox-wrapper:hover .properti-checkbox-label {
            border-color: #9a55ff;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(154, 85, 255, 0.1);
        }

        .properti-checkbox-input:checked+.properti-checkbox-label {
            border-color: #9a55ff;
            background: linear-gradient(135deg, #f1f0ff, #e8e0ff);
            box-shadow: 0 5px 15px rgba(154, 85, 255, 0.1);
        }

        .properti-check-icon {
            font-size: 1.2rem;
            color: #d0d4db;
            transition: all 0.3s ease;
        }

        .properti-checkbox-input:checked+.properti-checkbox-label .properti-check-icon {
            color: #9a55ff;
        }

        .properti-check-text {
            font-size: 0.85rem;
            color: #2c2e3f;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .properti-checkbox-input:checked+.properti-checkbox-label .properti-check-text {
            color: #9a55ff;
            font-weight: 600;
        }

        /* ===== MODERN FILE UPLOAD STYLING ===== */
        .properti-file-upload-modern {
            position: relative;
            width: 100%;
        }

        .properti-file-upload-modern input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
            z-index: 2;
        }

        .properti-file-upload-modern .properti-file-label-modern {
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
            .properti-file-upload-modern .properti-file-label-modern {
                flex-direction: row;
                text-align: left;
                gap: 8px;
                padding: 0.75rem 1rem;
                min-height: auto;
            }
        }

        .properti-file-upload-modern:hover .properti-file-label-modern {
            border-color: #9a55ff;
            background: linear-gradient(135deg, #f1f0ff, #f8f9fa);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(154, 85, 255, 0.1);
        }

        .properti-file-upload-modern.is-uploaded .properti-file-label-modern {
            border: 2px dashed #28a745;
            background: linear-gradient(135deg, #f2faf4, #f9fdfa);
        }

        .properti-file-upload-modern.is-uploaded:hover .properti-file-label-modern {
            border-color: #1e7e34;
            background: linear-gradient(135deg, #e7f7ec, #f2faf4);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.15);
        }

        .properti-file-upload-modern .properti-file-label-modern i {
            font-size: 1.6rem;
            color: #9a55ff;
            background: rgba(154, 85, 255, 0.1);
            padding: 8px;
            border-radius: 50%;
        }

        .properti-file-upload-modern .properti-file-label-modern .properti-file-info-modern {
            flex: 1;
            width: 100%;
        }

        .properti-file-upload-modern .properti-file-label-modern .properti-file-info-modern span {
            display: block;
            font-weight: 600;
            color: #2c2e3f;
            font-size: 0.8rem;
            word-break: break-word;
        }

        .properti-file-upload-modern .properti-file-label-modern .properti-file-info-modern small {
            color: #6c7383;
            font-size: 0.65rem;
            display: block;
            margin-top: 2px;
        }

        .properti-file-upload-modern .properti-file-label-modern .properti-file-size {
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
            .properti-file-upload-modern .properti-file-label-modern .properti-file-size {
                margin-top: 0;
            }
        }

        /* Button Group */
        .properti-btn-group {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
        }

        .properti-btn-group .btn-right {
            display: flex;
            gap: 0.5rem;
            margin-left: auto;
        }

        @media (max-width: 576px) {
            .properti-btn-group {
                flex-direction: column;
            }

            .properti-btn-group .properti-btn {
                width: 100%;
            }

            .properti-btn-group .btn-right {
                margin-left: 0;
                width: 100%;
                flex-direction: column;
            }
        }

        /* Custom responsive adjustments */
        @media (max-width: 768px) {
            .content-wrapper {
                padding: 0.5rem !important;
            }

            .container-fluid {
                padding-left: 0.25rem !important;
                padding-right: 0.25rem !important;
            }

            .properti-card {
                border-radius: 8px !important;
                margin-bottom: 0.5rem !important;
            }

            .properti-card .properti-card-body {
                padding: 0.85rem !important;
            }

            .properti-row {
                flex-direction: column;
                margin-right: -0.2rem !important;
                margin-left: -0.2rem !important;
            }

            .properti-row>[class*="properti-col-"] {
                width: 100% !important;
                max-width: 100% !important;
                padding-right: 0.2rem !important;
                padding-left: 0.2rem !important;
                margin-bottom: 0.75rem !important;
            }

            .properti-btn {
                width: 100%;
                margin-bottom: 0.5rem;
            }

            .properti-checkbox-group {
                gap: 0.5rem;
            }

            .properti-checkbox-wrapper {
                min-width: calc(50% - 0.5rem);
                flex: 0 0 calc(50% - 0.5rem);
            }

            .properti-checkbox-label {
                padding: 0.6rem 0.8rem;
            }

            .properti-check-text {
                font-size: 0.85rem;
            }

            .properti-check-icon {
                font-size: 1.2rem;
            }
        }

        @media (min-width: 577px) and (max-width: 768px) {
            .properti-btn {
                padding: 0.5rem 0.75rem;
                font-size: 0.9rem;
            }

            .properti-checkbox-wrapper {
                min-width: 120px;
            }
        }

        /* Better touch targets for mobile */
        input,
        select,
        textarea,
        button {
            font-size: 16px !important;
        }

        /* Alert transition */
        .properti-alert-transition {
            transition: opacity 0.5s ease;
        }

        /* ===== MODERN TAB NAVIGATION ===== */
        .properti-nav-tab-wrapper {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 5px;
            display: inline-flex;
            flex-wrap: wrap;
            gap: 4px;
            margin-bottom: 1.5rem;
        }

        .properti-nav-tab {
            border: none;
            background: transparent;
            color: #64748b;
            font-size: 0.88rem;
            font-weight: 700;
            padding: 0.65rem 1.25rem;
            border-radius: 8px;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            text-decoration: none;
        }

        .properti-nav-tab:hover {
            color: #9a55ff;
            background: rgba(154, 85, 255, 0.06);
        }

        .properti-nav-tab.active {
            background: #ffffff !important;
            color: #7e22ce !important;
            box-shadow: 0 4px 12px rgba(126, 34, 206, 0.12), 0 1px 3px rgba(0, 0, 0, 0.04);
            transform: translateY(-1px);
        }

        .properti-tab-badge {
            background: #e2e8f0;
            color: #475569;
            font-size: 0.72rem;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 6px;
            transition: all 0.2s ease;
        }

        .properti-nav-tab.active .properti-tab-badge {
            background: linear-gradient(135deg, #da8cff, #9a55ff) !important;
            color: #ffffff !important;
            box-shadow: 0 2px 6px rgba(154, 85, 255, 0.3);
        }

        /* ===== WORKFLOW DOKUMEN FASE 4 STYLING ===== */
        .btn-fase4-add {
            background: linear-gradient(135deg, #9a55ff 0%, #7e22ce 100%) !important;
            color: #ffffff !important;
            border: none !important;
            border-radius: 8px;
            padding: 0.55rem 1.15rem;
            font-size: 0.84rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 2px 8px rgba(154, 85, 255, 0.3);
            transition: all 0.25s ease;
        }
        .btn-fase4-add:hover {
            box-shadow: 0 4px 14px rgba(154, 85, 255, 0.45) !important;
            transform: translateY(-1px);
            color: #ffffff !important;
        }

        .btn-fase4-master {
            background: #ffffff !important;
            border: 1.5px solid #9a55ff !important;
            color: #7e22ce !important;
            border-radius: 8px;
            padding: 0.55rem 1.15rem;
            font-size: 0.84rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 2px 6px rgba(154, 85, 255, 0.1);
            transition: all 0.25s ease;
        }
        .btn-fase4-master:hover {
            background: #fcfaff !important;
            border-color: #7e22ce !important;
            color: #6b21a8 !important;
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.2) !important;
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

        .fase4-card-inner {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 10px !important;
            padding: 1.15rem;
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

        .fase4-file-box {
            border-radius: 6px;
            padding: 0.55rem 0.75rem;
            margin-bottom: 0.65rem;
            margin-top: auto;
            font-size: 0.74rem;
            transition: all 0.2s ease;
        }

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

        /* ===== MODAL & CHECKLIST PICKER UI ===== */
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
            color: #ffffff !important;
            border: none !important;
            font-size: 0.88rem !important;
            font-weight: 600 !important;
            padding: 0.58rem 1.4rem !important;
            border-radius: 8px !important;
            box-shadow: 0 4px 14px rgba(154, 85, 255, 0.35) !important;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
            display: inline-flex !important;
            align-items: center !important;
            line-height: 1.4 !important;
            cursor: pointer;
        }

        .btn-master-submit:hover:not(:disabled) {
            color: #ffffff !important;
            background: linear-gradient(135deg, #8937fc 0%, #6b1cb8 100%) !important;
            box-shadow: 0 6px 20px rgba(154, 85, 255, 0.5) !important;
            transform: translateY(-2px);
        }

        .btn-master-submit:disabled {
            background: #cbd5e1 !important;
            color: #64748b !important;
            box-shadow: none !important;
            cursor: not-allowed;
            opacity: 0.75;
            transform: none !important;
        }

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
            .fase4-tab-nav {
                width: 100%;
                display: grid;
                grid-template-columns: repeat(2, 1fr);
            }
        }

    </style>


    <div class="container-fluid px-2 px-md-3 px-lg-4">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="properti-card shadow-sm">
                    <div class="properti-card-body p-3 p-md-4 p-lg-5">


                        <!-- HEADER TITLE & TAB NAVIGATION -->
                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4 pb-3 border-bottom">
                            <div>
                                <h4 class="properti-section-title mb-1 border-0 pb-0">
                                    <i class="fas fa-city me-2"></i>
                                    Edit Data Tanah: {{ $land->name }}
                                </h4>
                                <small class="text-muted" style="font-size: 0.82rem;">
                                    Kelola identitas lahan, peta lokasi, verifikasi legal awal, dan alur perizinan pengindukan PT.
                                </small>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <a href="{{ route('properti-all') }}" class="btn btn-sm btn-outline-secondary px-3 py-2 rounded-2 d-inline-flex align-items-center gap-1.5" style="font-size: 0.84rem; font-weight: 600;">
                                    <i class="fas fa-arrow-left"></i> Kembali ke Daftar Tanah
                                </a>
                            </div>
                        </div>

                        <!-- SEGMENTED TABS -->
                        <div class="properti-nav-tab-wrapper">
                            <button type="button" class="properti-nav-tab active" id="tabBtnProfil" onclick="switchPropertiTab('profil')">
                                <i class="fas fa-layer-group"></i>
                                <span>Profil & Informasi Lahan</span>
                            </button>
                            <button type="button" class="properti-nav-tab" id="tabBtnDokumen" onclick="switchPropertiTab('dokumen')">
                                <i class="fas fa-file-signature text-primary"></i>
                                <span>Dokumen Pengindukan & Perizinan</span>
                                <span class="properti-tab-badge" id="nav_badge_total_docs">{{ count($workflowDocs ?? []) }}</span>
                            </button>
                        </div>

                        <!-- TAB PANE 1: PROFIL & INFORMASI LAHAN -->
                        <div id="paneProfilLahan" class="properti-tab-pane">


                        {{-- ERROR VALIDATION --}}
                        @if (session('success'))
                            <div id="successAlert" class="properti-alert properti-alert-success">
                                <i class="fas fa-check-circle me-2"></i>
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="properti-alert properti-alert-danger" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $e)
                                        <li>{{ $e }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('properti.update', $land->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- ALERT --}}
                            <div class="properti-alert properti-alert-info d-flex align-items-center flex-wrap"
                                role="alert">
                                <i class="fas fa-info-circle me-2"></i>
                                <span>Setelah simpan data tanah, Anda bisa lanjut verifikasi legal & kavling</span>
                            </div>

                            {{-- ================= INFORMASI DASAR ================= --}}
                            <h5 class="properti-section-title">
                                <i class="fas fa-home me-2"></i>
                                Informasi Dasar Tanah
                            </h5>

                            <div class="properti-row">
                                <div class="properti-col-md-6">
                                    <div class="properti-form-group">
                                        <label class="properti-form-label">Nama Tanah/Proyek <span
                                                class="properti-text-danger">*</span></label>
                                        <input type="text" name="namaTanah"
                                            class="properti-form-control @error('namaTanah') is-invalid @enderror"
                                            value="{{ old('namaTanah', $land->name) }}" required>
                                        @error('namaTanah')
                                            <div class="properti-text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="properti-col-md-6">
                                    <div class="properti-form-group">
                                        <label class="properti-form-label">
                                            Nama Perusahaan <span class="properti-text-danger">*</span>
                                        </label>

                                        {{-- SELECT DENGAN SEARCH (SELECT2) - PAKSA 5 ITEM --}}
                                        <select name="company_profile_id" id="companySelect"
                                            class="properti-form-control @error('company_profile_id') is-invalid @enderror">
                                            <option value="">-- Pilih Perusahaan --</option>
                                            @foreach ($companies as $company)
                                                <option value="{{ $company->id }}"
                                                    {{ old('company_profile_id', $land->company_profile_id ?? ($companies->first()->id ?? '')) == $company->id ? 'selected' : '' }}>
                                                    {{ $company->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <small class="properti-text-muted">Ketik untuk mencari perusahaan</small>

                                        @error('company_profile_id')
                                            <div class="properti-text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="properti-col-md-6">
                                    <div class="properti-form-group">
                                        <label class="properti-form-label">Status Kepemilikan <span
                                                class="properti-text-danger">*</span></label>
                                        <select name="statusKepemilikan"
                                            class="properti-form-control @error('statusKepemilikan') is-invalid @enderror"
                                            required>
                                            <option value="">-- Pilih Status --</option>
                                            <option value="SHM"
                                                {{ old('statusKepemilikan', $land->ownership_status ?? 'SHM') == 'SHM' ? 'selected' : '' }}>SHM (Sertifikat
                                                Hak Milik)</option>
                                            <option value="HGB"
                                                {{ old('statusKepemilikan', $land->ownership_status ?? 'SHM') == 'HGB' ? 'selected' : '' }}>HGB (Hak Guna
                                                Bangunan)</option>
                                            <option value="HGU"
                                                {{ old('statusKepemilikan', $land->ownership_status ?? 'SHM') == 'HGU' ? 'selected' : '' }}>HGU (Hak Guna
                                                Usaha)</option>
                                            <option value="HP"
                                                {{ old('statusKepemilikan', $land->ownership_status ?? 'SHM') == 'HP' ? 'selected' : '' }}>
                                                HP (Hak Pakai)</option>
                                        </select>
                                        @error('statusKepemilikan')
                                            <div class="properti-text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="properti-form-group">
                                <label class="properti-form-label">Alamat Lengkap <span
                                        class="properti-text-danger">*</span></label>
                                <input type="text" name="lokasi"
                                    class="properti-form-control @error('lokasi') is-invalid @enderror"
                                    value="{{ old('lokasi', $land->address) }}" placeholder="Jl. Contoh No. 123" required>
                                @error('lokasi')
                                    <div class="properti-text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="properti-row">
                                <div class="properti-col-sm-6 properti-col-md-3">
                                    <div class="properti-form-group">
                                        <label class="properti-form-label">Provinsi</label>
                                        <select name="provinsi" id="provinsiProperti" class="form-control select2 properti-form-control">
                                            <option value="">-- Pilih Provinsi --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="properti-col-sm-6 properti-col-md-3">
                                    <div class="properti-form-group">
                                        <label class="properti-form-label">Kota/Kabupaten</label>
                                        <select name="kota" id="kotaProperti" class="form-control select2 properti-form-control">
                                            <option value="">-- Pilih Kota/Kabupaten --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="properti-col-sm-6 properti-col-md-3">
                                    <div class="properti-form-group">
                                        <label class="properti-form-label">Kecamatan</label>
                                        <select name="kecamatan" id="kecamatanProperti" class="form-control select2 properti-form-control">
                                            <option value="">-- Pilih Kecamatan --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="properti-col-sm-6 properti-col-md-3">
                                    <div class="properti-form-group">
                                        <label class="properti-form-label">Kelurahan/Desa</label>
                                        <select name="kelurahan" id="kelurahanProperti" class="form-control select2 properti-form-control">
                                            <option value="">-- Pilih Kelurahan/Desa --</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="properti-row">
                                <div class="properti-col-sm-6 properti-col-md-3">
                                    <div class="properti-form-group">
                                        <label class="properti-form-label">Luas Tanah (m²) <span
                                                class="properti-text-danger">*</span></label>
                                        <input type="number" name="luasTanah"
                                            class="properti-form-control @error('luasTanah') is-invalid @enderror"
                                            value="{{ old('luasTanah', $land->area) }}" min="0" step="0.01" required>
                                        @error('luasTanah')
                                            <div class="properti-text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="properti-col-sm-6 properti-col-md-3">
                                    <div class="properti-form-group">
                                        <label class="properti-form-label">Harga Perolehan <span
                                                class="properti-text-danger">*</span></label>
                                        <div class="properti-input-group">
                                            <div class="properti-input-group-prepend">
                                                <span class="properti-input-group-text">Rp</span>
                                            </div>
                                            <input type="text" name="hargaPerolehan"
                                                class="properti-form-control @error('hargaPerolehan') is-invalid @enderror"
                                                value="{{ old('hargaPerolehan', number_format($land->acquisition_price, 0, ',', '.')) }}" placeholder="1.000.000" required>
                                        </div>
                                        @error('hargaPerolehan')
                                            <div class="properti-text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="properti-col-sm-6 properti-col-md-3">
                                    <div class="properti-form-group">
                                        <label class="properti-form-label">Tanggal Perolehan</label>
                                        <input type="date" name="tanggalPerolehan"
                                            class="properti-form-control @error('tanggalPerolehan') is-invalid @enderror"
                                            value="{{ old('tanggalPerolehan', $land->acquisition_date ? \Carbon\Carbon::parse($land->acquisition_date)->format('Y-m-d') : date('Y-m-d')) }}">
                                        @error('tanggalPerolehan')
                                            <div class="properti-text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="properti-col-sm-6 properti-col-md-3">
                                    <div class="properti-form-group">
                                        <label class="properti-form-label">Kode Pos</label>
                                        <input type="text" name="kodePos" class="properti-form-control"
                                            value="{{ old('kodePos', $land->postal_code) }}" placeholder="12345">
                                    </div>
                                </div>
                            </div>

                            <div class="properti-row">
                                <div class="properti-col-md-4">
                                    <div class="properti-form-group">
                                        <label class="properti-form-label">Zonasi</label>
                                        <input type="text" name="zonasi"
                                            class="properti-form-control @error('zonasi') is-invalid @enderror"
                                            value="{{ old('zonasi', $land->zoning) }}" placeholder="Contoh: Perumahan">
                                        @error('zonasi')
                                            <div class="properti-text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="properti-col-md-4">
                                    <div class="properti-form-group">
                                        <label class="properti-form-label">Lebar Jalan (m)</label>
                                        <input type="number" name="lebarJalan"
                                            class="properti-form-control @error('lebarJalan') is-invalid @enderror"
                                            value="{{ old('lebarJalan', $land->road_width) }}" step="0.1" min="0">
                                        @error('lebarJalan')
                                            <div class="properti-text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="properti-col-md-4">
                                    <div class="properti-form-group">
                                        <label class="properti-form-label">Jenis Jalan</label>
                                        <select name="jenisJalan"
                                            class="properti-form-control @error('jenisJalan') is-invalid @enderror">
                                            <option value="">-- Pilih Jenis Jalan --</option>
                                            <option value="Aspal" {{ in_array(strtolower(old('jenisJalan', $land->road_type ?? '')), ['aspal', 'aspal hotmix']) ? 'selected' : '' }}>
                                                Aspal</option>
                                            <option value="Cor Beton" {{ in_array(strtolower(old('jenisJalan', $land->road_type ?? '')), ['cor beton', 'beton', 'cor beton (rabat)']) ? 'selected' : '' }}>
                                                Cor Beton</option>
                                            <option value="Paving Blok" {{ in_array(strtolower(old('jenisJalan', $land->road_type ?? '')), ['paving', 'paving blok']) ? 'selected' : '' }}>
                                                Paving Blok</option>
                                            <option value="Tanah" {{ in_array(strtolower(old('jenisJalan', $land->road_type ?? '')), ['tanah', 'tanah / pengerasan']) ? 'selected' : '' }}>
                                                Tanah</option>
                                        </select>
                                        @error('jenisJalan')
                                            <div class="properti-text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- ================= MODERN CHECKBOX FASILITAS ================= --}}
                            <div class="mt-3">
                                <label class="properti-form-label d-block text-start">Fasilitas Sekitar</label>

                                <div class="properti-checkbox-group">
                                    <div class="properti-checkbox-wrapper">
                                        <input type="checkbox" class="properti-checkbox-input" name="fasSekolah"
                                            id="fasSekolah" value="1" {{ old('fasSekolah', $land->facility_school) ? 'checked' : '' }}>
                                        <label class="properti-checkbox-label" for="fasSekolah">
                                            <i class="fas fa-check-circle properti-check-icon"></i>
                                            <span class="properti-check-text">Sekolah</span>
                                        </label>
                                    </div>

                                    <div class="properti-checkbox-wrapper">
                                        <input type="checkbox" class="properti-checkbox-input" name="fasRumahSakit"
                                            id="fasRumahSakit" value="1"
                                            {{ old('fasRumahSakit', $land->facility_hospital) ? 'checked' : '' }}>
                                        <label class="properti-checkbox-label" for="fasRumahSakit">
                                            <i class="fas fa-check-circle properti-check-icon"></i>
                                            <span class="properti-check-text">Rumah Sakit</span>
                                        </label>
                                    </div>

                                    <div class="properti-checkbox-wrapper">
                                        <input type="checkbox" class="properti-checkbox-input" name="fasMall"
                                            id="fasMall" value="1" {{ old('fasMall', $land->facility_mall) ? 'checked' : '' }}>
                                        <label class="properti-checkbox-label" for="fasMall">
                                            <i class="fas fa-check-circle properti-check-icon"></i>
                                            <span class="properti-check-text">Mall</span>
                                        </label>
                                    </div>

                                    <div class="properti-checkbox-wrapper">
                                        <input type="checkbox" class="properti-checkbox-input" name="fasTransportasi"
                                            id="fasTransportasi" value="1"
                                            {{ old('fasTransportasi', $land->facility_transport) ? 'checked' : '' }}>
                                        <label class="properti-checkbox-label" for="fasTransportasi">
                                            <i class="fas fa-check-circle properti-check-icon"></i>
                                            <span class="properti-check-text">Transportasi Umum</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="properti-form-group mt-3">
                                <label class="properti-form-label">Deskripsi</label>
                                <textarea name="deskripsi" class="properti-form-control" rows="3" placeholder="Deskripsi properti...">{{ old('deskripsi', $land->description) }}</textarea>
                            </div>

                            <hr class="properti-hr">

                            {{-- ================= LEGAL ================= --}}
                            <h5 class="properti-section-title">
                                <i class="fas fa-file-contract me-2"></i>
                                Dokumen Legal
                            </h5>

                            <div class="properti-row">
                                @foreach ($documentTypes as $type)
                                    @php
                                        $existingDoc = $land->documents->where('document_type_id', $type->id)->first();
                                        $isDocVerified = ($existingDoc && $existingDoc->status === 'verified') || $land->isFromPraLandbank() || $land->legal_status === 'verified';
                                    @endphp
                                    <div class="properti-col-md-4">
                                        <div class="properti-form-group">
                                            <label class="properti-form-label d-flex justify-content-between align-items-center">
                                                <span>No {{ $type->name }}</span>
                                                @if($isDocVerified && $existingDoc && $existingDoc->document_number)
                                                    <span class="badge bg-success-subtle text-success border border-success px-1.5 py-0.5" style="font-size: 0.65rem;">
                                                        <i class="fas fa-lock me-1"></i>Terkunci
                                                    </span>
                                                @endif
                                            </label>

                                            <input type="text" name="documents[{{ $type->id }}][number]"
                                                class="properti-form-control {{ $isDocVerified ? 'bg-light text-muted' : '' }}" 
                                                placeholder="Nomor {{ $type->name }}"
                                                value="{{ old('documents.'.$type->id.'.number', $existingDoc ? $existingDoc->document_number : '') }}"
                                                {{ $isDocVerified ? 'readonly' : '' }}>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <hr class="properti-hr">

                            <h5 class="properti-section-title">
                                <i class="fas fa-upload me-2"></i>
                                Berkas & Dokumen Terverifikasi
                            </h5>

                            <div class="properti-row">
                                @foreach ($documentTypes as $type)
                                    @php
                                        $existingDoc = $land->documents->where('document_type_id', $type->id)->first();
                                        $hasDoc = $existingDoc && $existingDoc->file_path;
                                        $isDocVerified = ($existingDoc && $existingDoc->status === 'verified') || $land->isFromPraLandbank() || $land->legal_status === 'verified';
                                    @endphp
                                    <div class="properti-col-md-4">
                                        <div class="properti-form-group mb-3">
                                            <label class="properti-form-label d-flex justify-content-between align-items-center mb-1">
                                                <span>Berkas {{ $type->name }}</span>
                                                @if($hasDoc && $isDocVerified)
                                                    <span class="badge bg-success text-white fw-bold px-2 py-1" style="font-size: 0.68rem; border-radius: 4px; background-color: #28a745 !important;">
                                                        <i class="fas fa-check-circle me-1"></i>Terverifikasi (Terkunci)
                                                    </span>
                                                @elseif($hasDoc)
                                                    <span class="badge bg-warning text-dark fw-bold px-2 py-1" style="font-size: 0.68rem; border-radius: 4px;">
                                                        <i class="fas fa-clock me-1"></i>Menunggu Verifikasi
                                                    </span>
                                                @else
                                                    <span class="badge bg-secondary text-white px-2 py-1" style="font-size: 0.68rem; border-radius: 4px;">
                                                        Belum Upload
                                                    </span>
                                                @endif
                                            </label>

                                            @if($isDocVerified && $hasDoc)
                                                <!-- KOTAK DOKUMEN TERKUNCI (READ ONLY KARENA SUDAH VERIFIKASI) -->
                                                <div class="card p-3 rounded-3 border bg-light d-flex flex-column justify-content-between" style="min-height: 110px; border-color: #28a745 !important; background: rgba(40, 167, 69, 0.04) !important;">
                                                    <div class="d-flex align-items-start gap-2">
                                                        <i class="fas fa-file-shield text-success fs-3 mt-1"></i>
                                                        <div>
                                                            <strong class="text-success d-block" style="font-size: 0.85rem;">Dokumen Sah Terverifikasi</strong>
                                                            <small class="text-muted d-block" style="font-size: 0.73rem;">Dokumen ini telah disetujui secara legal dan tidak dapat diubah lagi.</small>
                                                        </div>
                                                    </div>
                                                    <div class="mt-2 pt-2 border-top d-flex align-items-center justify-content-between">
                                                        <a href="{{ asset('uploads/' . $existingDoc->file_path) }}" target="_blank" class="btn btn-xs btn-outline-success d-inline-flex align-items-center gap-1 py-1 px-2 text-decoration-none fw-semibold" style="font-size: 0.75rem; border-radius: 6px;">
                                                            <i class="fas fa-eye"></i> Pratinjau Dokumen
                                                        </a>
                                                        @if($existingDoc->document_number)
                                                            <small class="text-muted font-monospace" style="font-size: 0.72rem;">No: {{ $existingDoc->document_number }}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                            @else
                                                <!-- FORM UPLOAD (HANYA BISA JIKA BELUM TERVERIFIKASI) -->
                                                <div class="properti-file-upload-modern {{ $hasDoc ? 'is-uploaded' : '' }}">
                                                    <input type="file" name="documents[{{ $type->id }}][file]"
                                                        id="upload_{{ $type->id }}" accept=".pdf,.jpg,.jpeg,.png"
                                                        data-type-name="{{ $type->name }}"
                                                        data-has-existing="{{ $hasDoc ? '1' : '0' }}">

                                                    <div class="properti-file-label-modern">
                                                        <i class="{{ $hasDoc ? 'fas fa-file-circle-check text-success' : 'fas fa-cloud-upload-alt' }}"
                                                           style="{{ $hasDoc ? 'color: #28a745 !important; background: rgba(40, 167, 69, 0.1) !important;' : '' }}"></i>
                                                        <div class="properti-file-info-modern">
                                                            <span class="file-title-text {{ $hasDoc ? 'text-success fw-bold' : '' }}">
                                                                {{ $hasDoc ? 'Dokumen Tersedia (Klik Ganti)' : 'Upload ' . $type->name . ' Baru' }}
                                                            </span>
                                                            <small class="file-sub-text text-muted">
                                                                Format: PDF, JPG, PNG (Max: 2MB)
                                                            </small>
                                                        </div>
                                                        <span class="properti-file-size"></span>
                                                    </div>
                                                </div>
                                                
                                                @if($hasDoc)
                                                    <div class="mt-2 d-flex align-items-center justify-content-between">
                                                        <a href="{{ asset('uploads/' . $existingDoc->file_path) }}" target="_blank" class="btn btn-xs btn-outline-primary d-inline-flex align-items-center gap-1 py-1 px-2 text-decoration-none fw-semibold" style="font-size: 0.75rem; border-radius: 6px; border: 1px solid rgba(154, 85, 255, 0.2); color: #9a55ff; background: rgba(154, 85, 255, 0.05);">
                                                            <i class="fas fa-eye"></i> Lihat Dokumen Saat Ini
                                                        </a>
                                                        @if($existingDoc->document_number)
                                                            <small class="text-muted" style="font-size: 0.72rem;">No: {{ $existingDoc->document_number }}</small>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <hr class="properti-hr">

                            {{-- ================= DENAH / SITEPLAN ================= --}}
                            <h5 class="properti-section-title">
                                <i class="fas fa-layer-group me-2"></i>
                                Upload Denah / Siteplan Properti
                            </h5>

                            @php
                                $hasDenah = !empty($land->denah);
                                $denahUrl = $hasDenah ? asset(str_starts_with($land->denah, 'uploads/') ? $land->denah : 'uploads/' . $land->denah) : null;
                            @endphp

                            <div class="properti-row">
                                <div class="properti-col-md-12">
                                    <div class="properti-form-group mb-3">
                                        <label class="properti-form-label d-flex justify-content-between align-items-center mb-1">
                                            <span>Berkas Denah / Siteplan</span>
                                            @if($hasDenah)
                                                <span class="badge bg-success text-white fw-bold px-2 py-1" style="font-size: 0.68rem; border-radius: 4px; background-color: #28a745 !important;">
                                                    <i class="fas fa-check-circle me-1"></i>Denah Terunggah
                                                </span>
                                            @endif
                                        </label>

                                        <div class="properti-file-upload-modern {{ $hasDenah ? 'is-uploaded' : '' }}">
                                            <input type="file" name="denah" id="upload_denah" accept=".pdf,.jpg,.jpeg,.png,.webp,.svg"
                                                data-type-name="Denah / Siteplan"
                                                data-has-existing="{{ $hasDenah ? '1' : '0' }}">

                                            <div class="properti-file-label-modern">
                                                <i class="{{ $hasDenah ? 'fas fa-file-circle-check text-success' : 'fas fa-map' }}"
                                                   style="{{ $hasDenah ? 'color: #28a745 !important; background: rgba(40, 167, 69, 0.1) !important;' : '' }}"></i>
                                                <div class="properti-file-info-modern">
                                                    <span class="file-title-text {{ $hasDenah ? 'text-success fw-bold' : '' }}">
                                                        {{ $hasDenah ? 'Denah / Siteplan Sudah Terunggah' : 'Upload Denah / Siteplan Baru' }}
                                                    </span>
                                                    <small class="file-sub-text text-muted">
                                                        {{ $hasDenah ? 'Klik di sini jika ingin mengganti file denah' : 'Format: JPG, PNG, WEBP, SVG, PDF (Max: 5MB)' }}
                                                    </small>
                                                </div>
                                                <span class="properti-file-size"></span>
                                            </div>
                                        </div>

                                        @if($hasDenah)
                                            <div class="mt-2 d-flex align-items-center gap-2">
                                                <a href="{{ $denahUrl }}" target="_blank" class="btn btn-xs btn-outline-primary d-inline-flex align-items-center gap-1 py-1 px-2 text-decoration-none fw-semibold" style="font-size: 0.75rem; border-radius: 6px; border: 1px solid rgba(154, 85, 255, 0.2); color: #9a55ff; background: rgba(154, 85, 255, 0.05);">
                                                    <i class="fas fa-eye"></i> Lihat Berkas Denah Saat Ini
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <hr class="properti-hr">

                            {{-- ================= STATUS ================= --}}
                            <h5 class="properti-section-title">
                                <i class="fas fa-tags me-2"></i>
                                Status
                            </h5>

                            <div class="properti-row">
                                <div class="properti-col-md-4">
                                    <div class="properti-form-group">
                                        <label class="properti-form-label">Status Legal <span
                                                class="properti-text-danger">*</span></label>
                                        <select name="statusLegal"
                                            class="properti-form-control @error('statusLegal') is-invalid @enderror"
                                            required>
                                            <option value="pending"
                                                {{ old('statusLegal', $land->legal_status) == 'pending' || old('statusLegal', $land->legal_status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="verified"
                                                {{ old('statusLegal', $land->legal_status) == 'verified' || old('statusLegal', $land->legal_status) == 'Lengkap' ? 'selected' : '' }}>Lengkap</option>
                                        </select>
                                        @error('statusLegal')
                                            <div class="properti-text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="properti-col-md-4">
                                    <div class="properti-form-group">
                                        <label class="properti-form-label">Status Kavling</label>
                                        <select name="statusKavling"
                                            class="properti-form-control @error('statusKavling') is-invalid @enderror">
                                            <option value="Belum"
                                                {{ old('statusKavling', $land->development_status ?? 'Belum') == 'Belum' || old('statusKavling', $land->development_status ?? 'Belum') == 'belum' ? 'selected' : '' }}>Belum</option>
                                            <option value="progress"
                                                {{ old('statusKavling', $land->development_status ?? 'Belum') == 'progress' || old('statusKavling', $land->development_status ?? 'Belum') == 'Proses' ? 'selected' : '' }}>Proses</option>
                                            <option value="Selesai"
                                                {{ old('statusKavling', $land->development_status ?? 'Belum') == 'Selesai' || old('statusKavling', $land->development_status ?? 'Belum') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                        </select>
                                        @error('statusKavling')
                                            <div class="properti-text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="properti-col-md-4">
                                    <div class="properti-form-group">
                                        <label class="properti-form-label">Prioritas</label>
                                        <select name="prioritas" class="properti-form-control">
                                            <option value="Normal" {{ old('prioritas', $land->priority) == 'Normal' ? 'selected' : '' }}>
                                                Normal</option>
                                            <option value="Tinggi" {{ old('prioritas', $land->priority) == 'Tinggi' ? 'selected' : '' }}>
                                                Tinggi</option>
                                            <option value="Urgent" {{ old('prioritas', $land->priority) == 'Urgent' ? 'selected' : '' }}>
                                                Urgent</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="properti-row mt-3">
                                <div class="properti-col-md-4">
                                    <div class="properti-form-group">
                                        <label class="properti-form-label">Fee Dokumen Verifikasi Pasca</label>
                                        <div class="properti-input-group">
                                            <div class="properti-input-group-prepend">
                                                <span class="properti-input-group-text">Rp</span>
                                            </div>
                                            <input type="text" name="fee_document_verification"
                                                class="properti-form-control @error('fee_document_verification') is-invalid @enderror"
                                                value="{{ old('fee_document_verification', $land->fee_document_verification ? number_format($land->fee_document_verification, 0, ',', '.') : '') }}"
                                                placeholder="Contoh: 5.000.000">
                                        </div>
                                        @error('fee_document_verification')
                                            <div class="properti-text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <hr class="properti-hr">
                            {{-- ================= MAP ================= --}}
                            <h5 class="properti-section-title">
                                <i class="fas fa-map-marker-alt me-2"></i>
                                Koordinat
                            </h5>

                            <div class="properti-row">
                                <div class="properti-col-md-6">
                                    <div class="properti-form-group">
                                        <label class="properti-form-label">Latitude</label>
                                        <input type="text" name="latitude" class="properti-form-control"
                                            value="{{ old('latitude', $land->lat) }}" placeholder="Contoh: -6.2088">
                                    </div>
                                </div>
                                <div class="properti-col-md-6">
                                    <div class="properti-form-group">
                                        <label class="properti-form-label">Longitude</label>
                                        <input type="text" name="longitude" class="properti-form-control"
                                            value="{{ old('longitude', $land->lng) }}" placeholder="Contoh: 106.8456">
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3">
                                <div class="properti-map-container">
                                    <div id="map" style="height: 400px;"></div>
                                </div>
                                <div class="mt-2 text-end">
                                    <button type="button" id="btnLokasiSaya"
                                        class="properti-btn properti-btn-outline-primary properti-btn-sm">
                                        <i class="fas fa-location-dot me-1"></i>
                                        Gunakan Lokasi Saya
                                    </button>
                                </div>
                            </div>

                            <hr class="properti-hr">


                            {{-- ================= BUTTON ================= --}}
                            <div class="properti-btn-group mt-4">
                                <a href="{{ route('properti-all') }}" class="properti-btn properti-btn-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali
                                </a>

                                <div class="btn-right">
                                    <button type="submit" class="properti-btn properti-btn-primary">
                                        <i class="fas fa-save me-2"></i>Simpan Perubahan
                                    </button>
                                </div>
                            </div>

                        </form>
                        </div>
                        <!-- END TAB PANE 1 -->

                        <!-- TAB PANE 2: WORKFLOW DOKUMEN PENGINDUKAN & PERIZINAN -->
                        <div id="paneDokumenPerizinan" class="properti-tab-pane d-none">
                            @php
                                $totalWorkflowDocs = count($workflowDocs ?? []);
                                $terbitCount = 0;
                                $prosesCount = 0;
                                $belumCount = 0;
                                foreach (($workflowDocs ?? []) as $wd) {
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

                            <!-- TOP ACTION BAR -->
                            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4 p-3 bg-light rounded-3 border">
                                <div>
                                    <h5 class="fw-bold text-dark mb-1 d-flex align-items-center gap-2" style="font-size: 1.05rem;">
                                        <i class="fas fa-stamp text-primary"></i>
                                        Workflow Dokumen Pengindukan & Perizinan Wilayah
                                    </h5>
                                    <small class="text-muted" style="font-size: 0.8rem;">
                                        Pencatatan alur pengurusan izin (Kelurahan/Kecamatan, BPN, PKKPR OSS, Validasi Pajak, hingga SHGB Induk an. PT).
                                    </small>
                                </div>
                                <div class="d-flex flex-wrap align-items-center gap-2">
                                    <button type="button" class="btn btn-sm btn-fase4-add shadow-sm" onclick="scrollToNewDocForm()">
                                        <i class="fas fa-plus-circle me-1"></i> <span>+ Tambah Dokumen Lapangan</span>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-fase4-master shadow-sm" onclick="openMasterPickerModal()">
                                        <i class="fas fa-file-signature me-1"></i> <span>+ Pilih dari Master Perizinan</span>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-fase4-template shadow-sm" onclick="loadFase4DefaultTemplate()" title="Muat paket template default">
                                        <i class="fas fa-clipboard-list me-1"></i> <span>Gunakan Template Standar</span>
                                    </button>
                                </div>
                            </div>

                            <!-- RINGKASAN DATA PROPERTI PASCA -->
                            <div class="p-3 rounded-3 mb-3" style="background: linear-gradient(135deg, #fbf9ff, #f6f0ff); border: 1px solid rgba(154, 85, 255, 0.2);">
                                <div class="row g-3 align-items-center">
                                    <div class="col-12 col-md-3">
                                        <small class="text-muted d-block" style="font-size: 0.74rem;">Nama Lahan / Properti</small>
                                        <strong class="text-dark" style="font-size: 0.92rem;">{{ $land->name }}</strong>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <small class="text-muted d-block" style="font-size: 0.74rem;">Status Alas Hak Awal</small>
                                        <span class="fw-semibold text-dark" style="font-size: 0.88rem;">{{ $land->ownership_status ?? 'SHM' }}</span>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <small class="text-muted d-block" style="font-size: 0.74rem;">Alamat / Lokasi</small>
                                        <span class="fw-semibold text-dark text-truncate d-block" style="font-size: 0.85rem;" title="{{ $land->address }}">
                                            <i class="fas fa-map-marker-alt text-danger me-1"></i>{{ $land->city ?? ($land->address ?? '-') }}
                                        </span>
                                    </div>
                                    <div class="col-12 col-md-3 text-md-end">
                                        <small class="text-muted d-block" style="font-size: 0.74rem;">Total Luas Lahan</small>
                                        <span class="badge bg-purple text-white px-2.5 py-1.5 rounded-2" style="background: #9a55ff; font-size: 0.85rem;">{{ number_format($land->area ?? 0, 0, ',', '.') }} m²</span>
                                    </div>
                                </div>
                            </div>

                            <!-- PROGRESS BAR & STATISTIK -->
                            <div class="p-3 rounded-3 mb-4 bg-white border shadow-sm">
                                <div class="row align-items-center g-3">
                                    <div class="col-12 col-md-5">
                                        <div class="d-flex justify-content-between align-items-center mb-1.5">
                                            <span class="fw-bold text-dark" style="font-size: 0.84rem;">
                                                <i class="fas fa-chart-pie text-primary me-1"></i> Progres Dokumen Pengindukan:
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
                                                <i class="fas fa-check-circle"></i>
                                                <span id="stat_terbit">{{ $terbitCount }} Selesai / Terbit</span>
                                            </div>
                                            <div class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 px-2.5 py-1.5 rounded-2 d-flex align-items-center gap-1.5" style="font-size: 0.78rem;">
                                                <i class="fas fa-clock"></i>
                                                <span id="stat_proses">{{ $prosesCount }} Dalam Proses</span>
                                            </div>
                                            <div class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25 px-2.5 py-1.5 rounded-2 d-flex align-items-center gap-1.5" style="font-size: 0.78rem;">
                                                <i class="fas fa-exclamation-circle"></i>
                                                <span id="stat_belum">{{ $belumCount }} Belum Ada</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- FILTER TABS & SEARCH BAR -->
                            <div class="fase4-tab-wrapper d-flex flex-wrap justify-content-between align-items-center gap-2.5 mb-4 p-2.5 bg-white rounded-3 border shadow-sm">
                                <div class="fase4-tab-nav" role="tablist">
                                    <button type="button" class="fase4-tab-item active fase4-filter-btn" data-status="all" onclick="filterFase4Docs('all', this)">
                                        <i class="fas fa-th-large"></i>
                                        <span>Semua Dokumen</span>
                                        <span class="fase4-tab-count" id="count_all">{{ $totalWorkflowDocs }}</span>
                                    </button>
                                    <button type="button" class="fase4-tab-item fase4-filter-btn" data-status="terbit" onclick="filterFase4Docs('terbit', this)">
                                        <i class="fas fa-check-double text-success"></i>
                                        <span>Selesai / Terbit</span>
                                        <span class="fase4-tab-count" id="count_terbit">{{ $terbitCount }}</span>
                                    </button>
                                    <button type="button" class="fase4-tab-item fase4-filter-btn" data-status="proses" onclick="filterFase4Docs('proses', this)">
                                        <i class="fas fa-hourglass-half text-warning"></i>
                                        <span>Dalam Proses</span>
                                        <span class="fase4-tab-count" id="count_proses">{{ $prosesCount }}</span>
                                    </button>
                                    <button type="button" class="fase4-tab-item fase4-filter-btn" data-status="belum" onclick="filterFase4Docs('belum', this)">
                                        <i class="fas fa-minus-circle text-secondary"></i>
                                        <span>Belum Ada</span>
                                        <span class="fase4-tab-count" id="count_belum">{{ $belumCount }}</span>
                                    </button>
                                </div>
                                <div class="fase4-search-wrapper" style="min-width: 260px;">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-search"></i></span>
                                        <input type="text" class="form-control border-start-0 bg-light" id="searchFase4Input" placeholder="Cari nama izin, instansi, nomor..." onkeyup="searchFase4Docs(this.value)">
                                    </div>
                                </div>
                            </div>

                            
                            <!-- LIST FORM WORKFLOW DOKUMEN (DIRECT INLINE FORM PER DOKUMEN) -->
                            <div id="fase4_docs_container" class="d-flex flex-column gap-3 mb-4">
                                @forelse(($workflowDocs ?? []) as $docIndex => $doc)
                                    @php
                                        $docId = $doc['id'] ?? ('doc_' . uniqid());
                                        $poinLabel = $doc['poin_label'] ?? ('Poin ' . ($docIndex + 7));
                                        $docName = $doc['doc_name'] ?? 'Dokumen Pengindukan';
                                        $instansi = $doc['instansi'] ?? '-';
                                        $docNumber = $doc['doc_number'] ?? '';
                                        $docDate = !empty($doc['doc_date']) ? \Carbon\Carbon::parse($doc['doc_date'])->format('Y-m-d') : '';
                                        $filePath = $doc['file_path'] ?? null;
                                        $cleanPath = $filePath ? str_replace('uploads/', '', $filePath) : null;
                                        $status = $doc['status'] ?? ($filePath ? 'terbit' : (!empty($docNumber) ? 'proses' : 'belum'));
                                        $isFinalGoal = !empty($doc['is_final_goal']) || $docId === 'template_shgb_induk' || str_contains(strtolower($docName), 'shgb induk');
                                        $nominal = $doc['nominal'] ?? null;
                                        $luas = $doc['luas'] ?? null;
                                        $notes = $doc['notes'] ?? '';

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

                                        $statusBorderColor = match($status) {
                                            'terbit', 'selesai' => '#10b981',
                                            'proses' => '#f59e0b',
                                            'ditolak' => '#ef4444',
                                            default => '#cbd5e1',
                                        };
                                        $statusHeaderBg = match($status) {
                                            'terbit', 'selesai' => 'linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%)',
                                            'proses' => 'linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%)',
                                            'ditolak' => 'linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%)',
                                            default => 'linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%)',
                                        };
                                    @endphp
                                    <div class="fase4-doc-card card border shadow-sm rounded-3 overflow-hidden {{ $isFinalGoal ? 'border-2 border-warning' : '' }}" 
                                         id="fase4_doc_card_{{ $docId }}"
                                         data-id="{{ $docId }}"
                                         data-status="{{ $status }}"
                                         data-search="{{ strtolower($docName . ' ' . $instansi . ' ' . $docNumber . ' ' . $poinLabel . ' ' . $notes) }}">
                                        
                                        <form class="fase4-item-form" id="form_doc_{{ $docId }}" onsubmit="saveSingleFase4Doc(event, '{{ $docId }}')" enctype="multipart/form-data">
                                            <input type="hidden" name="doc_id" value="{{ $docId }}">
                                            <input type="hidden" name="existing_syarat_files" id="existing_syarat_files_{{ $docId }}" value="{{ json_encode($syaratFiles) }}">
                                            <input type="hidden" name="deleted_syarat_files" id="deleted_syarat_files_{{ $docId }}" value="[]">

                                            <!-- HEADER FORM DOKUMEN -->
                                            <div class="card-header py-2.5 px-3 border-bottom d-flex flex-wrap justify-content-between align-items-center gap-2" style="background: {{ $statusHeaderBg }};">
                                                <div class="d-flex align-items-center gap-2 flex-grow-1 overflow-hidden">
                                                    <span class="badge {{ $isFinalGoal ? 'bg-warning text-dark' : 'bg-primary' }} px-2.5 py-1.5 rounded-2 font-monospace" style="font-size: 0.82rem;">
                                                        {{ $poinLabel }}
                                                    </span>
                                                    <h6 class="mb-0 fw-bold text-dark text-truncate" title="{{ $docName }}" style="font-size: 0.95rem;">
                                                        {{ $docName }}
                                                    </h6>
                                                    @if($isFinalGoal)
                                                        <span class="badge bg-success text-white" style="font-size: 0.72rem;"><i class="fas fa-crown me-1"></i>GOL AKHIR</span>
                                                    @endif
                                                </div>
                                                <div class="d-flex align-items-center gap-2">
                                                    <label class="small fw-semibold text-muted mb-0 d-none d-sm-inline" style="font-size: 0.75rem;">Status:</label>
                                                    <select name="status" class="form-select form-select-sm fw-bold border" style="width: auto; font-size: 0.78rem; border-color: {{ $statusBorderColor }}; border-radius: 6px;">
                                                        <option value="belum" {{ $status == 'belum' ? 'selected' : '' }}>⚪ Belum Ada</option>
                                                        <option value="proses" {{ $status == 'proses' ? 'selected' : '' }}>🟡 Sedang Proses</option>
                                                        <option value="terbit" {{ $status == 'terbit' || $status == 'selesai' ? 'selected' : '' }}>🟢 Selesai / Terbit</option>
                                                        <option value="ditolak" {{ $status == 'ditolak' ? 'selected' : '' }}>🔴 Ditolak / Kendala</option>
                                                    </select>
                                                    <button type="button" class="btn btn-sm btn-outline-danger px-2.5 py-1" onclick="deleteFase4Doc('{{ $docId }}', '{{ addslashes($docName) }}')" title="Hapus Form Dokumen Ini">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- BODY FORM DOKUMEN -->
                                            <div class="card-body p-3 bg-white">
                                                <!-- BARIS 1: NAMA DOKUMEN, INSTANSI, POIN -->
                                                <div class="row g-2.5 mb-2.5">
                                                    <div class="col-12 col-md-5">
                                                        <label class="form-label small fw-bold text-dark mb-1">
                                                            Nama Dokumen / Tahapan Pengurusan <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" name="doc_name" class="form-control form-control-sm fase4-form-input fw-semibold" value="{{ $docName }}" required placeholder="Nama dokumen/tahapan">
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label class="form-label small fw-bold text-dark mb-1">
                                                            Instansi / Kantor Terkait
                                                        </label>
                                                        <input type="text" name="instansi" class="form-control form-control-sm fase4-form-input" value="{{ $instansi }}" placeholder="Contoh: Kantor Pertanahan (BPN), Kelurahan">
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <label class="form-label small fw-bold text-dark mb-1">
                                                            Label Urutan
                                                        </label>
                                                        <input type="text" name="poin_label" class="form-control form-control-sm fase4-form-input font-monospace" value="{{ $poinLabel }}" placeholder="Contoh: Tahap 1 / Poin 7">
                                                    </div>
                                                </div>

                                                <!-- BARIS 2: NOMOR SK/REGISTRASI, TANGGAL, ESTIMASI BIAYA, LUAS -->
                                                <div class="row g-2.5 mb-2.5">
                                                    <div class="col-12 col-md-4">
                                                        <label class="form-label small fw-bold text-dark mb-1">
                                                            Nomor Registrasi / SK / Surat
                                                        </label>
                                                        <input type="text" name="doc_number" class="form-control form-control-sm fase4-form-input" value="{{ $docNumber }}" placeholder="Nomor resmi SK/Registrasi BPN">
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <label class="form-label small fw-bold text-dark mb-1">
                                                            Tanggal Dokumen / Pengurusan
                                                        </label>
                                                        <input type="date" name="doc_date" class="form-control form-control-sm fase4-form-input" value="{{ $docDate }}">
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <label class="form-label small fw-bold text-dark mb-1">
                                                            Estimasi Biaya / Pajak (Rp)
                                                        </label>
                                                        <input type="text" name="nominal" class="form-control form-control-sm fase4-form-input input-currency" value="{{ $nominal ? number_format($nominal, 0, ',', '.') : '' }}" placeholder="0" onkeyup="formatCurrencyDirect(this)">
                                                    </div>
                                                    <div class="col-12 col-md-2">
                                                        <label class="form-label small fw-bold text-dark mb-1">
                                                            Luas (m²)
                                                        </label>
                                                        <input type="number" step="0.01" name="luas" class="form-control form-control-sm fase4-form-input" value="{{ $luas }}" placeholder="m²">
                                                    </div>
                                                </div>

                                                <!-- BARIS 3: PRASYARAT BERKAS & CHECKLIST -->
                                                <div class="p-2.5 rounded-2 bg-light border mb-2.5">
                                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                                        <label class="form-label small fw-bold text-dark mb-0 d-flex align-items-center gap-1.5">
                                                            <i class="fas fa-tasks text-primary"></i>
                                                            <span>Prasyarat Berkas Permohonan:</span>
                                                        </label>
                                                        <span class="badge {{ $isAllSyaratReady ? 'bg-success text-white' : ($checkedCount > 0 ? 'bg-warning text-dark' : 'bg-secondary text-white') }} px-2 py-1" style="font-size: 0.72rem;">
                                                            {{ $checkedCount }}/{{ $totalSyarat }} Siap
                                                        </span>
                                                    </div>

                                                    <div class="row g-2 mb-2">
                                                        @if($totalSyarat > 0)
                                                            @foreach($syaratItems as $idx => $sItem)
                                                                @php 
                                                                    $itemFile = $syaratFiles[$sItem] ?? ($syaratFiles[$idx] ?? null);
                                                                    $isItemChecked = in_array($sItem, $syaratChecklist) || !empty($itemFile);
                                                                    $itemCleanPath = $itemFile ? str_replace('uploads/', '', $itemFile) : null;
                                                                    $itemExt = $itemFile ? pathinfo($itemFile, PATHINFO_EXTENSION) : 'pdf';
                                                                @endphp
                                                                <div class="col-12 col-md-6">
                                                                    <div class="p-2 rounded-2 bg-white border d-flex align-items-center justify-content-between gap-2 shadow-xs">
                                                                        <div class="form-check mb-0 d-flex align-items-center gap-2 overflow-hidden flex-grow-1">
                                                                            <input class="form-check-input flex-shrink-0" type="checkbox" name="syarat_checklist[]" value="{{ $sItem }}" id="chk_{{ $docId }}_{{ $idx }}" {{ $isItemChecked ? 'checked' : '' }} style="cursor: pointer;">
                                                                            <label class="form-check-label small fw-semibold text-dark text-truncate mb-0" for="chk_{{ $docId }}_{{ $idx }}" title="{{ $sItem }}" style="cursor: pointer; font-size: 0.76rem;">
                                                                                {{ $sItem }}
                                                                            </label>
                                                                        </div>
                                                                        <div class="d-flex align-items-center gap-1 flex-shrink-0">
                                                                            @if($itemFile)
                                                                                <button type="button" class="btn btn-xs btn-outline-success py-0.5 px-1.5 rounded-1 btn-preview-doc" data-url="{{ route('dokumen.preview', ['path' => $itemCleanPath]) }}" data-ext="{{ $itemExt }}" data-label="{{ $sItem }}" title="Lihat: {{ $sItem }}" style="font-size: 0.7rem;">
                                                                                    <i class="fas fa-eye me-0.5"></i>Lihat
                                                                                </button>
                                                                            @endif
                                                                            <label class="btn btn-xs btn-outline-primary py-0.5 px-1.5 rounded-1 mb-0" style="font-size: 0.7rem; cursor: pointer;" title="Upload Berkas Prasyarat: {{ $sItem }}">
                                                                                <i class="fas fa-upload me-0.5"></i>{{ $itemFile ? 'Ganti' : 'Upload' }}
                                                                                <input type="file" name="syarat_file_{{ $idx }}" class="d-none" accept=".pdf,.jpg,.jpeg,.png" onchange="previewSyaratFileName(this, 'label_syarat_{{ $docId }}_{{ $idx }}', 'chk_{{ $docId }}_{{ $idx }}')">
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <span class="d-block small text-primary text-truncate mt-0.5 ps-1" id="label_syarat_{{ $docId }}_{{ $idx }}" style="font-size: 0.68rem;"></span>
                                                                </div>
                                                            @endforeach
                                                        @else
                                                            <div class="col-12 text-muted small fst-italic py-1 px-2">
                                                                Tidak ada prasyarat berkas terdaftar untuk tahap ini.
                                                            </div>
                                                        @endif
                                                    </div>

                                                    <!-- Edit Teks Prasyarat -->
                                                    <div class="pt-1.5 border-top">
                                                        <a class="text-decoration-none small text-muted d-inline-flex align-items-center gap-1" data-bs-toggle="collapse" href="#collapseSyarat_{{ $docId }}" role="button" aria-expanded="false" style="font-size: 0.72rem;">
                                                            <i class="fas fa-edit"></i> Edit / Tambah Teks Prasyarat (Satu butir per baris)
                                                        </a>
                                                        <div class="collapse mt-1.5" id="collapseSyarat_{{ $docId }}">
                                                            <textarea name="syarat_dokumen" class="form-control form-control-sm fase4-form-input" rows="2" style="font-size: 0.76rem;" placeholder="• Contoh Syarat 1&#10;• Contoh Syarat 2">{{ $syaratDokumen }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- BARIS 4: UPLOAD BERKAS SK TERBIT & CATATAN -->
                                                <div class="row g-2.5 mb-2.5 align-items-center">
                                                    <div class="col-12 col-md-6">
                                                        <label class="form-label small fw-bold text-dark mb-1">
                                                            Upload Berkas SK / Dokumen Terbit Resmi (PDF/JPG/PNG)
                                                        </label>
                                                        <div class="d-flex align-items-center gap-2">
                                                            <input type="file" name="file_doc" class="form-control form-control-sm fase4-form-input" accept=".pdf,.jpg,.jpeg,.png">
                                                            @if($filePath)
                                                                <button type="button" class="btn btn-sm btn-success text-white px-2.5 flex-shrink-0 d-inline-flex align-items-center gap-1 btn-preview-doc" data-url="{{ route('dokumen.preview', ['path' => $cleanPath]) }}" data-ext="{{ pathinfo($filePath, PATHINFO_EXTENSION) }}" data-label="{{ $docName }}" style="font-size: 0.78rem;">
                                                                    <i class="fas fa-eye"></i> Lihat SK
                                                                </button>
                                                            @endif
                                                        </div>
                                                        @if($filePath)
                                                            <small class="text-success fw-semibold mt-1 d-block text-truncate" style="font-size: 0.72rem;">
                                                                <i class="fas fa-check-circle me-1"></i> Terunggah: {{ basename($filePath) }}
                                                            </small>
                                                        @endif
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <label class="form-label small fw-bold text-dark mb-1">
                                                            Catatan / Keterangan Tambahan
                                                        </label>
                                                        <textarea name="notes" class="form-control form-control-sm fase4-form-input" rows="1" placeholder="Tuliskan catatan teknis, kendala, atau keterangan khusus...">{{ $notes }}</textarea>
                                                    </div>
                                                </div>

                                                <!-- ACTION FOOTER FORM DOKUMEN -->
                                                <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                                                    <small class="text-muted" style="font-size: 0.73rem;">
                                                        <i class="fas fa-info-circle me-1 text-primary"></i> Data pada form ini akan langsung tersimpan ke sistem.
                                                    </small>
                                                    <button type="submit" class="btn btn-sm btn-success px-4 py-1.5 fw-bold shadow-sm d-inline-flex align-items-center gap-1.5" id="btn_save_doc_{{ $docId }}">
                                                        <i class="fas fa-save"></i> <span>Simpan Dokumen Ini</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                @empty
                                    <div class="card border border-dashed rounded-3 p-4 text-center bg-light my-2" id="fase4_docs_empty_state">
                                        <div class="p-3 bg-white rounded-circle d-inline-flex shadow-sm mb-2" style="color: #9a55ff;">
                                            <i class="fas fa-folder-plus fa-2x"></i>
                                        </div>
                                        <h6 class="fw-bold text-dark mb-1">Daftar Dokumen Pengurusan Masih Kosong</h6>
                                        <p class="text-muted small mx-auto mb-3" style="max-width: 480px;">
                                            Silakan tambahkan dokumen / perizinan melalui form di bawah ini atau muat paket template standar.
                                        </p>
                                        <div class="d-flex flex-wrap justify-content-center align-items-center gap-2">
                                            <button type="button" class="btn btn-sm btn-fase4-master px-3 py-2 fw-semibold shadow-sm" onclick="openMasterPickerModal()">
                                                <i class="fas fa-file-signature me-1"></i> <span>+ Pilih dari Master Perizinan</span>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-fase4-template px-3 py-2 fw-semibold shadow-sm" onclick="loadFase4DefaultTemplate()">
                                                <i class="fas fa-clipboard-list me-1"></i> <span>Gunakan Template Standar</span>
                                            </button>
                                        </div>
                                    </div>
                                @endforelse

                                <!-- FORM TAMBAH DOKUMEN BARU (INLINE CARD FORM AT BOTTOM) -->
                                <div class="card border-primary border-2 shadow-sm rounded-3 overflow-hidden mt-3" id="cardAddNewDoc">
                                    <div class="card-header bg-primary bg-opacity-10 py-2.5 px-3 border-bottom d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="p-1.5 rounded-2 bg-primary text-white" style="font-size: 0.8rem; line-height: 1;"><i class="fas fa-plus"></i></span>
                                            <h6 class="mb-0 fw-bold text-primary" style="font-size: 0.92rem;">+ Form Tambah Dokumen / Tahapan Baru</h6>
                                        </div>
                                        <span class="badge bg-primary text-white" style="font-size: 0.72rem;">Dokumen Baru</span>
                                    </div>
                                    <form id="formAddNewDoc" class="card-body p-3 bg-white" onsubmit="saveNewFase4Doc(event)" enctype="multipart/form-data">
                                        <input type="hidden" name="doc_id" value="">
                                        
                                        <!-- BARIS 1 -->
                                        <div class="row g-2.5 mb-2.5">
                                            <div class="col-12 col-md-5">
                                                <label class="form-label small fw-bold text-dark mb-1">
                                                    Nama Dokumen / Tahapan <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="doc_name" class="form-control form-control-sm fase4-form-input fw-semibold" placeholder="Contoh: SK HGB BPN / PKKPR OSS / Balik Nama" required>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="form-label small fw-bold text-dark mb-1">
                                                    Instansi / Lembaga Terkait
                                                </label>
                                                <input type="text" name="instansi" class="form-control form-control-sm fase4-form-input" placeholder="Contoh: Kantor Pertanahan ATR/BPN, Bapenda, Notaris">
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <label class="form-label small fw-bold text-dark mb-1">
                                                    Label Urutan
                                                </label>
                                                <input type="text" name="poin_label" class="form-control form-control-sm fase4-form-input font-monospace" placeholder="Contoh: Tahap {{ count($workflowDocs ?? []) + 1 }}">
                                            </div>
                                        </div>

                                        <!-- BARIS 2 -->
                                        <div class="row g-2.5 mb-2.5">
                                            <div class="col-12 col-md-3">
                                                <label class="form-label small fw-bold text-dark mb-1">
                                                    Nomor Registrasi / SK / Surat
                                                </label>
                                                <input type="text" name="doc_number" class="form-control form-control-sm fase4-form-input" placeholder="Nomor resmi registrasi">
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <label class="form-label small fw-bold text-dark mb-1">
                                                    Tanggal Dokumen
                                                </label>
                                                <input type="date" name="doc_date" class="form-control form-control-sm fase4-form-input">
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <label class="form-label small fw-bold text-dark mb-1">
                                                    Status Dokumen
                                                </label>
                                                <select name="status" class="form-select form-select-sm fase4-form-input fw-semibold">
                                                    <option value="proses" selected>🟡 Sedang Proses</option>
                                                    <option value="belum">⚪ Belum Ada</option>
                                                    <option value="terbit">🟢 Selesai / Terbit</option>
                                                    <option value="ditolak">🔴 Ditolak / Kendala</option>
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <label class="form-label small fw-bold text-dark mb-1">
                                                    Estimasi Biaya (Rp)
                                                </label>
                                                <input type="text" name="nominal" class="form-control form-control-sm fase4-form-input input-currency" placeholder="0" onkeyup="formatCurrencyDirect(this)">
                                            </div>
                                        </div>

                                        <!-- BARIS 3: PRASYARAT & BERKAS -->
                                        <div class="row g-2.5 mb-2.5">
                                            <div class="col-12 col-md-6">
                                                <label class="form-label small fw-bold text-dark mb-1">
                                                    Prasyarat Berkas (Satu baris per butir prasyarat)
                                                </label>
                                                <textarea name="syarat_dokumen" class="form-control form-control-sm fase4-form-input" rows="2" placeholder="• Copy KTP & KK Pemohon&#10;• Surat Kuasa Notaris&#10;• Bukti Bayar Pajak"></textarea>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="form-label small fw-bold text-dark mb-1">
                                                    Upload File / SK Dokumen Terbit (Opsional)
                                                </label>
                                                <input type="file" name="file_doc" class="form-control form-control-sm fase4-form-input mb-1.5" accept=".pdf,.jpg,.jpeg,.png">
                                                <input type="text" name="notes" class="form-control form-control-sm fase4-form-input" placeholder="Catatan tambahan...">
                                            </div>
                                        </div>

                                        <!-- SUBMIT ACTION -->
                                        <div class="text-end pt-2 border-top">
                                            <button type="submit" class="btn btn-sm btn-primary px-4 py-2 fw-bold shadow-sm" id="btnSubmitNewDoc">
                                                <i class="fas fa-plus-circle me-1"></i> Tambahkan ke Alur Pengurusan
                                            </button>
                                        </div>
                                    </form>
                                </div>

                            </div>

                        </div>
                        <!-- END TAB PANE 2 -->


                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL PREVIEW DOKUMEN (ZOOMABLE IMAGE + PDF READER) --}}
    <div class="modal fade" id="modalPreviewDokumen" tabindex="-1" aria-hidden="true" style="z-index: 1060;">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content shadow-lg" style="border-radius:14px; overflow:hidden; border:none;">
                <div class="modal-header bg-white border-bottom py-2 px-3 d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-file-alt fs-5 text-primary" id="modalDocIcon"></i>
                        <h6 class="modal-title mb-0 fw-bold text-dark text-truncate" style="max-width: 280px;" id="modalDocLabel">Preview Dokumen</h6>
                        <span class="badge bg-secondary ms-1" id="modalDocExt" style="font-size:0.68rem;"></span>
                    </div>

                    {{-- Toolbar Zoom & Aksi --}}
                    <div class="d-flex align-items-center gap-2">
                        <div id="imgZoomToolbar" class="d-none align-items-center bg-light border rounded-2 px-2 py-0.5 gap-1">
                            <button type="button" class="btn btn-xs btn-link text-dark p-1" onclick="changeImageZoom(-0.25)" title="Zoom Out (-)">
                                <i class="fas fa-search-minus"></i>
                            </button>
                            <span id="imgZoomLevelText" class="fw-bold text-muted px-1" style="font-size: 0.75rem; min-width: 42px; text-align: center;">100%</span>
                            <button type="button" class="btn btn-xs btn-link text-dark p-1" onclick="changeImageZoom(0.25)" title="Zoom In (+)">
                                <i class="fas fa-search-plus"></i>
                            </button>
                            <div class="vr my-1"></div>
                            <button type="button" class="btn btn-xs btn-link text-dark p-1" onclick="resetImageTransform()" title="Reset Ukuran (100%)">
                                <i class="fas fa-compress-arrows-alt"></i>
                            </button>
                            <button type="button" class="btn btn-xs btn-link text-dark p-1" onclick="rotateImagePreview()" title="Putar 90°">
                                <i class="fas fa-redo"></i>
                            </button>
                        </div>

                        <a href="#" id="btnOpenNewTab" target="_blank" class="btn btn-sm btn-outline-secondary py-1 px-2 d-flex align-items-center gap-1" title="Buka di Tab Baru">
                            <i class="fas fa-external-link-alt"></i> <span class="d-none d-md-inline" style="font-size: 0.78rem;">Tab Baru</span>
                        </a>

                        <a href="#" id="btnDownloadDoc" class="btn btn-sm btn-outline-primary py-1 px-2.5 d-flex align-items-center gap-1" download title="Download Dokumen">
                            <i class="fas fa-download"></i> <span class="d-none d-md-inline" style="font-size: 0.78rem;">Unduh</span>
                        </a>

                        <button type="button" class="btn-close ms-1" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>

                <div class="modal-body p-0 position-relative" style="background:#0f1117; min-height:65vh;">
                    <div id="previewLoading" class="flex-column align-items-center justify-content-center gap-3" style="min-height:65vh; background: #ffffff; display: flex;">
                        <div class="spinner-border text-primary" style="width:2.5rem;height:2.5rem;"></div>
                        <span class="text-muted small fw-semibold">Memuat dokumen, mohon tunggu...</span>
                    </div>

                    <div id="previewError" class="flex-column align-items-center justify-content-center gap-3 text-center p-4" style="min-height:65vh; background: #ffffff; display: none;">
                        <i class="fas fa-exclamation-triangle text-danger fa-3x mb-2" style="opacity:.8;"></i>
                        <div>
                            <div class="fw-bold text-danger fs-5 mb-1">Dokumen Fisik Tidak Ditemukan di Server</div>
                            <small class="text-muted d-block" style="max-width: 480px;">
                                File mungkin belum terunggah ke server. Silakan unggah ulang berkas terkait.
                            </small>
                        </div>
                    </div>

                    <iframe id="iframePreview" src="" style="width:100%; height:75vh; border:none; display:none; background:#ffffff;"></iframe>

                    <div id="divImagePreview" class="justify-content-center align-items-center" style="width: 100%; height: 75vh; overflow: auto; background: #181924; position: relative; padding: 20px; display: none;">
                        <div id="imgWrapper" style="display: inline-block; transform-origin: center center; transition: transform 0.12s ease-out; margin: auto;">
                            <img id="imgPreview" src="" alt="Preview Dokumen" style="max-width: 100%; max-height: 70vh; object-fit: contain; border-radius: 6px; box-shadow: 0 10px 35px rgba(0,0,0,0.6); display: block;" />
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-white border-top py-2 px-3 d-flex align-items-center justify-content-between">
                    <small class="text-muted" id="previewFooterInfo">
                        <i class="fas fa-info-circle me-1"></i>Gunakan toolbar di atas untuk memperbesar/memutar detail dokumen.
                    </small>
                    <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL CHECKLIST PICKER: PILIH DARI MASTER DOKUMEN PERIZINAN --}}
    <div class="modal fade" id="modalPickerMasterPerizinan" tabindex="-1" aria-hidden="true" style="z-index: 1056;">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center justify-content-between flex-wrap gap-2 py-3 px-4">
                    <div class="d-flex align-items-center gap-2.5">
                        <div class="p-2 rounded-3 text-primary" style="background-color: rgba(154, 85, 255, 0.12);">
                            <i class="fas fa-award fs-5"></i>
                        </div>
                        <div>
                            <h5 class="modal-title mb-0 fw-bold">Katalog Master Dokumen Perizinan Developer</h5>
                            <small class="text-muted d-block" style="font-size: 0.75rem;">Pilih dokumen perizinan standar untuk dimasukkan ke alur pengindukan tanah ini</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2 ms-auto">
                        <a href="{{ route('master.dokumen-perizinan.index') }}" target="_blank" class="btn btn-sm btn-outline-primary d-inline-flex align-items-center gap-1.5 py-1.5 px-3" style="font-size: 0.78rem;">
                            <i class="fas fa-cog"></i> <span>Kelola Master Data</span>
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
                                    <i class="fas fa-search master-search-icon"></i>
                                    <input type="text" class="form-control master-search-input" id="searchMasterPickerInput" placeholder="Cari nama izin, kode poin, instansi..." onkeyup="searchMasterPicker(this.value)">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <select class="form-select master-category-select" id="filterMasterCategorySelect" onchange="filterMasterPickerCategory(this.value)">
                                    <option value="">Semua Kategori ({{ isset($masterDocuments) ? $masterDocuments->count() : 0 }} Dokumen)</option>
                                    @if(isset($masterDocuments))
                                        @foreach($masterDocuments->pluck('kategori')->unique() as $kategori)
                                            <option value="{{ $kategori }}">{{ $kategori }} ({{ $masterDocuments->where('kategori', $kategori)->count() }})</option>
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
                                <i class="fas fa-check-double me-1"></i> <span id="masterPickerSelectedText">0 dokumen dipilih</span>
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
                            @if(isset($masterDocuments) && $masterDocuments->count() > 0)
                                @foreach($masterDocuments as $m)
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
                                                                <i class="fas fa-check-double me-1"></i>Sudah Ada di Lahan
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
                                                            <i class="fas fa-landmark text-primary me-1"></i>{{ $m->instansi_terkait }}
                                                        </small>
                                                    @endif

                                                    <div class="d-flex flex-wrap align-items-center gap-2 mt-2 pt-1.5 border-top" style="font-size: 0.74rem;">
                                                        @if($m->estimasi_hari)
                                                            <span class="text-muted">
                                                                <i class="far fa-clock me-0.5 text-secondary"></i>{{ $m->estimasi_hari }} Hari
                                                            </span>
                                                        @endif
                                                        @if($m->estimasi_biaya > 0)
                                                            <span class="fw-bold text-success">
                                                                Rp {{ number_format($m->estimasi_biaya, 0, ',', '.') }}
                                                            </span>
                                                        @endif
                                                        @if($m->syarat_dokumen)
                                                            <span class="text-muted text-truncate" style="max-width: 180px;" title="Syarat: {{ $m->syarat_dokumen }}">
                                                                <i class="fas fa-file-alt me-0.5 text-primary"></i>{{ $m->syarat_dokumen }}
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
                                    <i class="fas fa-award fa-3x text-muted opacity-50 mb-2"></i>
                                    <p class="mt-2 mb-0">Belum ada data master dokumen perizinan.</p>
                                </div>
                            @endif
                        </div>
                    </form>
                </div>

                <div class="modal-footer d-flex justify-content-end align-items-center gap-2 py-2.5 px-4">
                    <button type="button" class="btn btn-master-cancel" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1.5"></i>Batal
                    </button>
                    <button type="button" class="btn btn-master-submit" id="btnSubmitMasterPicker" onclick="submitBatchFromMaster()">
                        <i class="fas fa-plus-circle me-1.5"></i>
                        <span id="btnSubmitMasterPickerText">Tambahkan Dokumen Terpilih</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        // Format rupiah untuk harga perolehan & fee verifikasi
        document.addEventListener('DOMContentLoaded', function() {
            const rupiahInputs = document.querySelectorAll('input[name="hargaPerolehan"], input[name="fee_document_verification"]');
            rupiahInputs.forEach(input => {
                input.addEventListener('input', function(e) {
                    let value = this.value.replace(/\D/g, '');
                    if (value) {
                        value = parseInt(value).toLocaleString('id-ID');
                        this.value = value;
                    }
                });
            });
        });

        // Auto hide alert
        document.addEventListener("DOMContentLoaded", function() {
            const alert = document.getElementById("successAlert");
            if (alert) {
                setTimeout(() => {
                    alert.style.transition = "opacity 0.5s ease";
                    alert.style.opacity = "0";
                    setTimeout(() => alert.remove(), 500);
                }, 10000);
            }
        });

        // File upload modern preview
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.properti-file-upload-modern input[type="file"]').forEach(input => {
                input.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    const container = this.closest('.properti-file-upload-modern');
                    const label = container.querySelector('.file-title-text');
                    const subText = container.querySelector('.file-sub-text');
                    const sizeSpan = container.querySelector('.properti-file-size');
                    const icon = container.querySelector('.properti-file-label-modern i');
                    const typeName = this.getAttribute('data-type-name') || 'Dokumen';
                    const hasExisting = this.getAttribute('data-has-existing') === '1';

                    if (file) {
                        const fileName = file.name;
                        const fileSize = file.size;
                        label.textContent = fileName.length > 26 ? fileName.substring(0, 26) + '...' : fileName;
                        label.className = 'file-title-text text-primary fw-bold';
                        subText.textContent = 'File baru siap diupload';
                        
                        if (fileSize) {
                            const sizeInMB = (fileSize / (1024 * 1024)).toFixed(2);
                            sizeSpan.textContent = sizeInMB + ' MB';
                        }
                        
                        if (icon) {
                            icon.className = 'fas fa-file-arrow-up text-primary';
                            icon.style.cssText = 'color: #9a55ff !important; background: rgba(154, 85, 255, 0.1) !important;';
                        }
                    } else {
                        // Reset
                        if (hasExisting) {
                            label.textContent = 'Dokumen Sudah Terunggah';
                            label.className = 'file-title-text text-success fw-bold';
                            subText.textContent = 'Klik di sini jika ingin ganti / upload file baru';
                            if (icon) {
                                icon.className = 'fas fa-file-circle-check text-success';
                                icon.style.cssText = 'color: #28a745 !important; background: rgba(40, 167, 69, 0.1) !important;';
                            }
                        } else {
                            label.textContent = 'Upload ' + typeName + ' Baru';
                            label.className = 'file-title-text';
                            subText.textContent = 'Format: PDF, JPG, PNG (Max: 2MB)';
                            if (icon) {
                                icon.className = 'fas fa-cloud-upload-alt';
                                icon.style.cssText = '';
                            }
                        }
                        sizeSpan.textContent = '';
                    }
                });
            });
        });

        // SELECT2 & API WILAYAH INDONESIA INITIALIZATION
        $(document).ready(function() {
            $('#companySelect').select2({
                theme: 'bootstrap-5',
                allowClear: true,
                width: '100%',
                dropdownCssClass: 'select2-limited-items',
                language: {
                    noResults: function() {
                        return "Perusahaan tidak ditemukan";
                    },
                    searching: function() {
                        return "Mencari...";
                    }
                }
            });

            // --- API WILAYAH INDONESIA ---
            const API_BASE_WILAYAH = 'https://www.emsifa.com/api-wilayah-indonesia/api';

            const wilayahSelectIds = [
                '#provinsiProperti', '#kotaProperti', '#kecamatanProperti', '#kelurahanProperti'
            ];

            wilayahSelectIds.forEach(id => {
                $(id).select2({
                    theme: 'bootstrap-5',
                    width: '100%',
                    dropdownParent: $(id).parent()
                });
            });

            async function loadWilayahProperti(type, targetSelect, parentId = null, selectedValue = '') {
                let url = '';
                if (type === 'provinces') {
                    url = `${API_BASE_WILAYAH}/provinces.json`;
                } else if (type === 'regencies' && parentId) {
                    url = `${API_BASE_WILAYAH}/regencies/${parentId}.json`;
                } else if (type === 'districts' && parentId) {
                    url = `${API_BASE_WILAYAH}/districts/${parentId}.json`;
                } else if (type === 'villages' && parentId) {
                    url = `${API_BASE_WILAYAH}/villages/${parentId}.json`;
                }

                if (!url || !targetSelect) return null;

                try {
                    const res = await fetch(url);
                    const data = await res.json();

                    let placeholder = '-- Pilih --';
                    if (type === 'provinces') placeholder = '-- Pilih Provinsi --';
                    else if (type === 'regencies') placeholder = '-- Pilih Kota/Kabupaten --';
                    else if (type === 'districts') placeholder = '-- Pilih Kecamatan --';
                    else if (type === 'villages') placeholder = '-- Pilih Kelurahan/Desa --';

                    let optionsHtml = `<option value="">${placeholder}</option>`;
                    let matchedId = null;

                    data.forEach(item => {
                        const name = item.name.trim();
                        const isSelected = selectedValue && (name.toLowerCase() === selectedValue.trim().toLowerCase());
                        if (isSelected) matchedId = item.id;
                        optionsHtml += `<option value="${name}" data-id="${item.id}" ${isSelected ? 'selected' : ''}>${name}</option>`;
                    });

                    targetSelect.innerHTML = optionsHtml;
                    $(targetSelect).trigger('change.select2');
                    return matchedId;
                } catch (e) {
                    console.error(`Error loading wilayah ${type}:`, e);
                    return null;
                }
            }

            async function setupWilayahPropertiCascade(initialVals = {}) {
                const provSelect = document.getElementById('provinsiProperti');
                const kotaSelect = document.getElementById('kotaProperti');
                const kecSelect = document.getElementById('kecamatanProperti');
                const kelSelect = document.getElementById('kelurahanProperti');

                if (!provSelect) return;

                // 1. Load Provinces
                const provId = await loadWilayahProperti('provinces', provSelect, null, initialVals.province);

                if (provId) {
                    const kotaId = await loadWilayahProperti('regencies', kotaSelect, provId, initialVals.city);
                    if (kotaId) {
                        const kecId = await loadWilayahProperti('districts', kecSelect, kotaId, initialVals.district);
                        if (kecId) {
                            await loadWilayahProperti('villages', kelSelect, kecId, initialVals.village);
                        }
                    }
                }

                // On Province Change
                $('#provinsiProperti').on('change', async function() {
                    const selectedOpt = this.options[this.selectedIndex];
                    const pId = selectedOpt ? selectedOpt.getAttribute('data-id') : null;
                    kotaSelect.innerHTML = '<option value="">-- Pilih Kota/Kabupaten --</option>';
                    kecSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
                    kelSelect.innerHTML = '<option value="">-- Pilih Kelurahan/Desa --</option>';
                    $('#kotaProperti, #kecamatanProperti, #kelurahanProperti').trigger('change.select2');

                    if (pId) {
                        await loadWilayahProperti('regencies', kotaSelect, pId);
                    }
                });

                // On City Change
                $('#kotaProperti').on('change', async function() {
                    const selectedOpt = this.options[this.selectedIndex];
                    const cId = selectedOpt ? selectedOpt.getAttribute('data-id') : null;
                    kecSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
                    kelSelect.innerHTML = '<option value="">-- Pilih Kelurahan/Desa --</option>';
                    $('#kecamatanProperti, #kelurahanProperti').trigger('change.select2');

                    if (cId) {
                        await loadWilayahProperti('districts', kecSelect, cId);
                    }
                });

                // On District Change
                $('#kecamatanProperti').on('change', async function() {
                    const selectedOpt = this.options[this.selectedIndex];
                    const dId = selectedOpt ? selectedOpt.getAttribute('data-id') : null;
                    kelSelect.innerHTML = '<option value="">-- Pilih Kelurahan/Desa --</option>';
                    $('#kelurahanProperti').trigger('change.select2');

                    if (dId) {
                        await loadWilayahProperti('villages', kelSelect, dId);
                    }
                });
            }

            // Inisialisasi Wilayah dengan Data Properti yang Ada
            const initialWilayah = {
                province: "{{ old('provinsi', $land->province ?? '') }}",
                city: "{{ old('kota', $land->city ?? '') }}",
                district: "{{ old('kecamatan', $land->district ?? '') }}",
                village: "{{ old('kelurahan', $land->village ?? '') }}"
            };
            setupWilayahPropertiCascade(initialWilayah);
        });

        // Leaflet Map with Google Maps Tile Layers
        document.addEventListener("DOMContentLoaded", function() {
            let defaultLat = -8.1727;
            let defaultLng = 113.7000;

            let latInput = document.querySelector('input[name="latitude"]');
            let lngInput = document.querySelector('input[name="longitude"]');
            let btnLokasi = document.getElementById("btnLokasiSaya");

            let lat = (latInput && latInput.value) ? parseFloat(latInput.value) : defaultLat;
            let lng = (lngInput && lngInput.value) ? parseFloat(lngInput.value) : defaultLng;

            // Google Maps Tile Layers
            let googleRoadmap = L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
                attribution: '&copy; Google Maps'
            });

            let googleHybrid = L.tileLayer('https://{s}.google.com/vt/lyrs=y&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
                attribution: '&copy; Google Maps Satellite'
            });

            let googleTerrain = L.tileLayer('https://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
                attribution: '&copy; Google Maps Terrain'
            });

            let map = L.map('map', {
                center: [lat, lng],
                zoom: 15,
                layers: [googleRoadmap]
            });

            // Layer Switcher (Roadmap, Satellite, Terrain)
            let baseMaps = {
                "Google Roadmap": googleRoadmap,
                "Google Satellite": googleHybrid,
                "Google Terrain": googleTerrain
            };
            L.control.layers(baseMaps, null, { position: 'topright' }).addTo(map);

            let redIcon = L.divIcon({
                className: 'custom-red-marker-pin',
                html: `
                    <div style="
                        position: relative;
                        width: 34px;
                        height: 44px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        filter: drop-shadow(0 3px 6px rgba(0,0,0,0.35));
                        cursor: grab;
                    ">
                        <svg width="34" height="44" viewBox="0 0 24 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 0C5.373 0 0 5.373 0 12C0 21 12 32 12 32C12 32 24 21 24 12C24 5.373 18.627 0 12 0Z" fill="#e53935"/>
                            <circle cx="12" cy="11" r="5" fill="#ffffff"/>
                            <circle cx="12" cy="11" r="2.5" fill="#b71c1c"/>
                        </svg>
                    </div>
                `,
                iconSize: [34, 44],
                iconAnchor: [17, 44],
                popupAnchor: [0, -40]
            });

            let marker = L.marker([lat, lng], {
                draggable: true,
                icon: redIcon
            }).addTo(map);

            setTimeout(() => {
                map.invalidateSize();
                map.setView([lat, lng], 15);
                marker.setLatLng([lat, lng]);
            }, 300);

            // Drag marker
            marker.on('dragend', function() {
                let position = marker.getLatLng();
                latInput.value = position.lat.toFixed(6);
                lngInput.value = position.lng.toFixed(6);
            });

            // Klik map
            map.on('click', function(e) {
                marker.setLatLng(e.latlng);
                latInput.value = e.latlng.lat.toFixed(6);
                lngInput.value = e.latlng.lng.toFixed(6);
            });

            // Input manual
            function updateMarkerFromInput() {
                let newLat = parseFloat(latInput.value);
                let newLng = parseFloat(lngInput.value);

                if (!isNaN(newLat) && !isNaN(newLng)) {
                    marker.setLatLng([newLat, newLng]);
                    map.setView([newLat, newLng], 15);
                }
            }

            if (latInput) latInput.addEventListener('change', updateMarkerFromInput);
            if (lngInput) lngInput.addEventListener('change', updateMarkerFromInput);

            // Tombol Lokasi Saya
            if (btnLokasi) {
                btnLokasi.addEventListener("click", function() {
                    if (!navigator.geolocation) {
                        alert("Browser tidak mendukung geolocation.");
                        return;
                    }

                    btnLokasi.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Mendeteksi...';
                    btnLokasi.disabled = true;

                    navigator.geolocation.getCurrentPosition(
                        function(position) {
                            let userLat = position.coords.latitude;
                            let userLng = position.coords.longitude;

                            marker.setLatLng([userLat, userLng]);
                            latInput.value = userLat.toFixed(6);
                            lngInput.value = userLng.toFixed(6);
                            map.setView([userLat, userLng], 17);

                            btnLokasi.innerHTML =
                                '<i class="fas fa-location-dot me-1"></i> Gunakan Lokasi Saya';
                            btnLokasi.disabled = false;
                        },
                        function() {
                            alert("Gagal mendapatkan lokasi.");
                            btnLokasi.innerHTML =
                                '<i class="fas fa-location-dot me-1"></i> Gunakan Lokasi Saya';
                            btnLokasi.disabled = false;
                        }
                    );
                });
            }
        });
    </script>
@endpush


    <script>
        // ==========================================
        // PROPERTI TAB SWITCHING & FASE 4 WORKFLOW
        // ==========================================
        const FASE4_DOC_DATA = @json($workflowDocs ?? []);

        function switchPropertiTab(tabKey) {
            const btnProfil = document.getElementById('tabBtnProfil');
            const btnDokumen = document.getElementById('tabBtnDokumen');
            const paneProfil = document.getElementById('paneProfilLahan');
            const paneDokumen = document.getElementById('paneDokumenPerizinan');

            if (tabKey === 'dokumen') {
                if (btnProfil) btnProfil.classList.remove('active');
                if (btnDokumen) btnDokumen.classList.add('active');
                if (paneProfil) paneProfil.classList.add('d-none');
                if (paneDokumen) paneDokumen.classList.remove('d-none');
                window.location.hash = 'dokumen';
            } else {
                if (btnDokumen) btnDokumen.classList.remove('active');
                if (btnProfil) btnProfil.classList.add('active');
                if (paneDokumen) paneDokumen.classList.add('d-none');
                if (paneProfil) paneProfil.classList.remove('d-none');
                window.location.hash = 'profil';
            }
        }

        // Auto switch tab if URL contains #dokumen
        document.addEventListener("DOMContentLoaded", function() {
            if (window.location.hash === '#dokumen') {
                switchPropertiTab('dokumen');
            }
        });
        
        function previewSyaratFileName(input, labelId, checkboxId) {
            const label = document.getElementById(labelId);
            const chk = document.getElementById(checkboxId);
            if (input.files && input.files[0]) {
                if (label) {
                    label.innerHTML = '<i class="fas fa-check text-success me-1"></i>' + input.files[0].name;
                }
                if (chk) {
                    chk.checked = true;
                }
            } else {
                if (label) label.textContent = '';
            }
        }

        function formatCurrencyDirect(input) {
            let val = input.value.replace(/[^0-9]/g, '');
            if (!val) {
                input.value = '';
                return;
            }
            input.value = parseInt(val).toLocaleString('id-ID');
        }

        function scrollToNewDocForm() {
            const card = document.getElementById('cardAddNewDoc');
            if (card) {
                card.scrollIntoView({ behavior: 'smooth', block: 'center' });
                const nameInput = card.querySelector('input[name="doc_name"]');
                if (nameInput) {
                    setTimeout(() => nameInput.focus(), 400);
                }
            }
        }

        function saveSingleFase4Doc(e, docId) {
            e.preventDefault();
            const form = document.getElementById('form_doc_' + docId);
            if (!form) return;

            const btnSave = document.getElementById('btn_save_doc_' + docId);
            const origHtml = btnSave ? btnSave.innerHTML : '';
            if (btnSave) {
                btnSave.disabled = true;
                btnSave.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Menyimpan...';
            }

            const formData = new FormData(form);
            formData.append('_token', '{{ csrf_token() }}');

            const uploadUrl = '{{ route("properti.upload-custom-workflow-doc", $land->id) }}';

            Swal.fire({
                title: 'Menyimpan Dokumen...',
                text: 'Sedang memproses pembaruan data dan upload berkas',
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
                    throw new Error('Gagal menyimpan data dokumen.');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil Disimpan!',
                        text: data.message || 'Dokumen berhasil diperbarui.',
                        timer: 1400,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.hash = 'dokumen';
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: data.message || 'Terjadi kesalahan saat menyimpan.'
                    });
                    if (btnSave) {
                        btnSave.disabled = false;
                        btnSave.innerHTML = origHtml;
                    }
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: error.message || 'Terjadi kesalahan jaringan/server.'
                });
                if (btnSave) {
                    btnSave.disabled = false;
                    btnSave.innerHTML = origHtml;
                }
            });
        }

        function saveNewFase4Doc(e) {
            e.preventDefault();
            const form = document.getElementById('formAddNewDoc');
            if (!form) return;

            const btnSubmit = document.getElementById('btnSubmitNewDoc');
            const origHtml = btnSubmit ? btnSubmit.innerHTML : '';
            if (btnSubmit) {
                btnSubmit.disabled = true;
                btnSubmit.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Menambahkan...';
            }

            const formData = new FormData(form);
            formData.append('_token', '{{ csrf_token() }}');

            const uploadUrl = '{{ route("properti.upload-custom-workflow-doc", $land->id) }}';

            Swal.fire({
                title: 'Menambahkan Dokumen Baru...',
                text: 'Sedang mendaftarkan tahapan perizinan ke alur pengindukan',
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
                    throw new Error('Gagal menambahkan dokumen.');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Dokumen Ditambahkan!',
                        text: data.message || 'Dokumen berhasil ditambahkan ke alur pengurusan.',
                        timer: 1400,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.hash = 'dokumen';
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: data.message || 'Terjadi kesalahan saat menambahkan dokumen.'
                    });
                    if (btnSubmit) {
                        btnSubmit.disabled = false;
                        btnSubmit.innerHTML = origHtml;
                    }
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: error.message || 'Terjadi kesalahan jaringan/server.'
                });
                if (btnSubmit) {
                    btnSubmit.disabled = false;
                    btnSubmit.innerHTML = origHtml;
                }
            });
        }

function deleteFase4Doc(docId, docName) {
            Swal.fire({
                title: `Hapus ${docName || 'Dokumen Ini'}?`,
                text: 'Dokumen dan seluruh file lampirannya akan dihapus dari daftar workflow.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="fas fa-trash me-1"></i> Ya, Hapus!',
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

                    const deleteUrl = '{{ route("properti.delete-custom-workflow-doc", $land->id) }}';

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
                                window.location.hash = 'dokumen';
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
            Swal.fire({
                title: 'Muat Template Standar Perizinan?',
                text: 'Sistem akan menambahkan paket dokumen standar legalitas & perizinan BPN ke dalam daftar. Anda tetap bebas mengedit, mengubah, atau menghapus item yang tidak dibutuhkan.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#9a55ff',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="fas fa-clipboard-check me-1"></i> Ya, Muat Template',
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

                    const loadUrl = '{{ route("properti.load-fase4-template", $land->id) }}';

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
                                window.location.hash = 'dokumen';
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

            const visibleCheckboxes = document.querySelectorAll('.master-picker-item:not(.d-none) .master-picker-checkbox:not(:disabled)');
            const allChecked = visibleCheckboxes.length > 0 && Array.from(visibleCheckboxes).every(cb => cb.checked);
            const masterCheckbox = document.getElementById('checkAllMasterPicker');
            if (masterCheckbox) {
                masterCheckbox.checked = allChecked;
            }

            updatePickerSelectedCount();
        }

        function submitBatchFromMaster() {
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
                text: 'Dokumen terpilih akan langsung dimasukkan ke alur perizinan lahan ini.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#9a55ff',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="fas fa-plus-circle me-1"></i> Ya, Tambahkan!',
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

                    const batchUrl = '{{ route("properti.add-from-master", $land->id) }}';

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
                                window.location.hash = 'dokumen';
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
                            <i class="fas fa-filter me-1 fs-4 d-block mb-1 text-secondary"></i>
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
                            <i class="fas fa-search me-1 fs-4 d-block mb-1 text-secondary"></i>
                            Tidak ada dokumen yang cocok dengan pencarian "<strong>${query}</strong>".
                        </div>
                    `;
                } else {
                    emptyState.style.display = 'none';
                }
            }
        }

        // ==========================================
        // UNIVERSAL DOCUMENT PREVIEW MODAL LOGIC
        // ==========================================
        let currentZoomLevel = 1.0;
        let currentRotation = 0;

        function updateImageTransform() {
            const wrapper = document.getElementById('imgWrapper');
            const zoomText = document.getElementById('imgZoomLevelText');
            if (wrapper) {
                wrapper.style.transform = `scale(${currentZoomLevel}) rotate(${currentRotation}deg)`;
            }
            if (zoomText) {
                zoomText.textContent = Math.round(currentZoomLevel * 100) + '%';
            }
        }

        function changeImageZoom(delta) {
            currentZoomLevel = Math.max(0.25, Math.min(4.0, currentZoomLevel + delta));
            updateImageTransform();
        }

        function resetImageTransform() {
            currentZoomLevel = 1.0;
            currentRotation = 0;
            updateImageTransform();
        }

        function rotateImagePreview() {
            currentRotation = (currentRotation + 90) % 360;
            updateImageTransform();
        }

        document.addEventListener('click', function(e) {
            const previewBtn = e.target.closest('.btn-preview-doc');
            if (!previewBtn) return;

            e.preventDefault();
            const docUrl = previewBtn.getAttribute('data-url');
            const docExt = (previewBtn.getAttribute('data-ext') || 'pdf').toLowerCase();
            const docLabel = previewBtn.getAttribute('data-label') || 'Preview Dokumen';

            const modalEl = document.getElementById('modalPreviewDokumen');
            if (!modalEl) return;

            document.getElementById('modalDocLabel').textContent = docLabel;
            document.getElementById('modalDocExt').textContent = docExt.toUpperCase();
            document.getElementById('btnOpenNewTab').href = docUrl;
            document.getElementById('btnDownloadDoc').href = docUrl;
            document.getElementById('btnDownloadDoc').setAttribute('download', docLabel + '.' + docExt);

            const iframe = document.getElementById('iframePreview');
            const divImage = document.getElementById('divImagePreview');
            const imgEl = document.getElementById('imgPreview');
            const loading = document.getElementById('previewLoading');
            const error = document.getElementById('previewError');
            const zoomToolbar = document.getElementById('imgZoomToolbar');

            loading.style.display = 'flex';
            error.style.display = 'none';
            iframe.style.display = 'none';
            divImage.style.display = 'none';
            zoomToolbar.classList.add('d-none');
            zoomToolbar.classList.remove('d-flex');
            resetImageTransform();

            const isImage = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'svg'].includes(docExt);

            if (isImage) {
                imgEl.onload = function() {
                    loading.style.display = 'none';
                    divImage.style.display = 'flex';
                    zoomToolbar.classList.remove('d-none');
                    zoomToolbar.classList.add('d-flex');
                };
                imgEl.onerror = function() {
                    loading.style.display = 'none';
                    error.style.display = 'flex';
                };
                imgEl.src = docUrl;
            } else {
                iframe.onload = function() {
                    loading.style.display = 'none';
                    iframe.style.display = 'block';
                };
                iframe.onerror = function() {
                    loading.style.display = 'none';
                    error.style.display = 'flex';
                };
                iframe.src = docUrl;
            }

            const modalObj = bootstrap.Modal.getOrCreateInstance(modalEl);
            modalObj.show();
        });
    </script>
