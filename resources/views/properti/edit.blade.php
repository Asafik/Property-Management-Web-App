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
            font-size: 0.85rem;
            padding: 0.55rem 1.25rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            font-family: 'Nunito', sans-serif;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 8px !important;
            text-decoration: none;
            cursor: pointer;
            border: none;
            width: 100%;
            text-align: center;
        }

        .properti-btn i {
            margin-right: 6px;
        }

        @media (min-width: 576px) {
            .properti-btn {
                width: auto;
                padding: 0.55rem 1.35rem;
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

        /* Card Styling Persis Pasca Land Bank */
        .card.compact-table-card,
        .compact-table-card,
        .properti-card {
            background: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 8px !important;
            box-shadow: none !important;
            transition: border-color 0.2s ease;
            overflow: hidden;
            margin-bottom: 1.5rem;
        }

        .card.compact-table-card:hover,
        .compact-table-card:hover,
        .properti-card:hover {
            border-color: #cbd5e1 !important;
            box-shadow: none !important;
        }

        .compact-table-card .card-header {
            background: #ffffff !important;
            border-bottom: 1px solid #e2e8f0 !important;
            padding: 0.85rem 1.25rem !important;
            border-top-left-radius: 8px !important;
            border-top-right-radius: 8px !important;
        }

        .properti-card .properti-card-body,
        .compact-table-card .card-body {
            padding: 1.25rem;
            background: #ffffff !important;
        }

        @media (min-width: 768px) {
            .properti-card .properti-card-body,
            .compact-table-card .card-body {
                padding: 1.5rem 1.75rem;
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
            background: #ede9fe;
            color: #7e22ce;
            font-size: 0.72rem;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 9999px;
            border: 1px solid #ddd6fe;
            transition: all 0.2s ease;
            margin-left: 5px;
            line-height: 1.2;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .properti-nav-tab.active .properti-tab-badge {
            background: #7e22ce !important;
            color: #ffffff !important;
            border-color: #7e22ce !important;
            box-shadow: 0 2px 6px rgba(126, 34, 206, 0.25);
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

        .btn-fase4-delete {
            background-color: #fff1f2 !important;
            border: 1.5px solid #fecdd3 !important;
            color: #e11d48 !important;
            font-size: 0.78rem !important;
            font-weight: 600 !important;
            border-radius: 6px !important;
            padding: 0.4rem 0.85rem !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 6px !important;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
            box-shadow: 0 1px 3px rgba(225, 29, 72, 0.08) !important;
            cursor: pointer !important;
            text-decoration: none !important;
        }

        .btn-fase4-delete:hover {
            background-color: #ffe4e6 !important;
            border-color: #fda4af !important;
            color: #be123c !important;
            box-shadow: 0 3px 8px rgba(225, 29, 72, 0.18) !important;
            transform: translateY(-1px) !important;
        }

        .btn-fase4-delete:active {
            transform: translateY(0) !important;
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
            border-radius: 9px;
            border: 1px solid #e2e8f0;
            gap: 4px;
        }

        .fase4-tab-item {
            border: 1px solid transparent;
            background: transparent;
            color: #64748b;
            font-size: 0.82rem;
            font-weight: 600;
            padding: 0.42rem 0.85rem;
            border-radius: 7px;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
            text-decoration: none;
            cursor: pointer;
            outline: none;
        }

        .fase4-tab-item:hover {
            color: #1e293b;
            background-color: rgba(255, 255, 255, 0.8);
        }

        .fase4-tab-item.active {
            background-color: #ffffff !important;
            color: #0f172a !important;
            font-weight: 700 !important;
            border-color: #e2e8f0 !important;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05), 0 1px 2px rgba(0, 0, 0, 0.03);
            transform: translateY(-1px);
        }

        .fase4-tab-count {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.72rem;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 9999px;
            min-width: 22px;
            height: 20px;
            line-height: 1;
            margin-left: 2px;
            background-color: #e2e8f0;
            color: #475569;
            border: 1px solid #cbd5e1;
            transition: all 0.2s ease;
        }

        /* Default / All Tab Active Badge */
        .fase4-tab-item.active .fase4-tab-count,
        .fase4-tab-item[data-status="all"].active .fase4-tab-count {
            background: #ede9fe !important;
            color: #7e22ce !important;
            border: 1px solid #d8b4fe !important;
            box-shadow: none !important;
        }

        /* Selesai / Terbit Tab Pill */
        .fase4-tab-item[data-status="terbit"] .fase4-tab-count {
            background-color: #f0fdf4;
            color: #16a34a;
            border-color: #bbf7d0;
        }
        .fase4-tab-item[data-status="terbit"].active .fase4-tab-count {
            background: #dcfce7 !important;
            color: #15803d !important;
            border: 1px solid #86efac !important;
            box-shadow: none !important;
        }

        /* Dalam Proses Tab Pill */
        .fase4-tab-item[data-status="proses"] .fase4-tab-count {
            background-color: #fffbeb;
            color: #d97706;
            border-color: #fde68a;
        }
        .fase4-tab-item[data-status="proses"].active .fase4-tab-count {
            background: #fef3c7 !important;
            color: #b45309 !important;
            border: 1px solid #fcd34d !important;
            box-shadow: none !important;
        }

        /* Belum Ada Tab Pill */
        .fase4-tab-item[data-status="belum"] .fase4-tab-count {
            background-color: #f8fafc;
            color: #64748b;
            border-color: #e2e8f0;
        }
        .fase4-tab-item[data-status="belum"].active .fase4-tab-count {
            background: #f1f5f9 !important;
            color: #334155 !important;
            border: 1px solid #cbd5e1 !important;
            box-shadow: none !important;
        }

        .btn-modal-rincian-trigger {
            background: #ffffff !important;
            border: 1px solid #cbd5e1 !important;
            border-radius: 6px !important;
            box-shadow: none !important;
            margin-top: 14px !important;
            margin-bottom: 6px !important;
            transition: all 0.2s ease !important;
        }

        .btn-modal-rincian-trigger:hover {
            background: #f8fafc !important;
            border-color: #9a55ff !important;
            box-shadow: 0 2px 8px rgba(154, 85, 255, 0.12) !important;
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
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
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

        textarea.fase4-form-input {
            min-height: 100px !important;
            height: auto !important;
            line-height: 1.5 !important;
            resize: vertical !important;
            font-size: 0.85rem !important;
        }

        textarea.fase4-form-input.fase4-syarat-area {
            min-height: 120px !important;
        }

        textarea.fase4-form-input.fase4-notes-area {
            min-height: 90px !important;
        }

        textarea.fase4-form-input.fase4-name-area {
            min-height: 58px !important;
            line-height: 1.35 !important;
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
            background-color: #f1f5f9 !important;
            border: 1.5px dashed #cbd5e1 !important;
            opacity: 0.88;
            cursor: not-allowed !important;
        }

        .master-picker-card.is-disabled:hover {
            transform: none !important;
            box-shadow: none !important;
            border-color: #cbd5e1 !important;
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
            top: 50%;
            transform: translateY(-50%);
            font-size: 1rem;
            color: #9a55ff;
            pointer-events: none;
            z-index: 5;
        }

        .master-search-input,
        #searchMasterPickerInput {
            height: 42px !important;
            padding-left: 44px !important;
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

        /* ===== RESPONSIVE STYLING (MOBILE & TABLET) ===== */
        @media (min-width: 768px) and (max-width: 991.98px) {
            .fase4-top-bar {
                flex-direction: column !important;
                align-items: stretch !important;
                gap: 12px !important;
            }
            .fase4-top-actions {
                display: flex !important;
                flex-wrap: wrap !important;
                gap: 8px !important;
            }
            .fase4-top-actions .btn {
                flex: 1 1 auto !important;
                justify-content: center !important;
            }
            .fase4-summary-card .col-md-3 {
                flex: 0 0 50% !important;
                max-width: 50% !important;
            }
            .fase4-tab-wrapper {
                gap: 10px !important;
            }
            .fase4-tab-nav {
                flex: 1 1 auto !important;
            }
            .fase4-search-wrapper {
                flex: 1 1 240px !important;
                min-width: 220px !important;
            }
            .modal-dialog {
                max-width: 92% !important;
                width: 92% !important;
                margin: 1.25rem auto !important;
            }
            .modal-body {
                max-height: 72vh !important;
            }
        }

        @media (max-width: 767.98px) {
            /* TOP BAR & ACTIONS */
            .fase4-top-bar {
                flex-direction: column !important;
                align-items: stretch !important;
                padding: 1rem !important;
                gap: 12px !important;
            }
            .fase4-top-info h5 {
                font-size: 0.98rem !important;
                line-height: 1.35 !important;
            }
            .fase4-top-actions {
                display: flex !important;
                flex-direction: column !important;
                width: 100% !important;
                gap: 8px !important;
            }
            .fase4-top-actions .btn {
                width: 100% !important;
                justify-content: center !important;
                padding: 0.55rem 0.9rem !important;
                font-size: 0.82rem !important;
            }

            /* SUMMARY CARD */
            .fase4-summary-card {
                padding: 0.85rem !important;
            }

            /* PROGRESS & STAT BADGES */
            .fase4-stat-badges {
                display: flex !important;
                flex-wrap: wrap !important;
                gap: 6px !important;
                width: 100% !important;
                justify-content: flex-start !important;
            }
            .fase4-stat-badges .badge {
                flex: 1 1 calc(33.333% - 6px) !important;
                min-width: 110px !important;
                justify-content: center !important;
                text-align: center !important;
                padding: 0.45rem 0.5rem !important;
                font-size: 0.74rem !important;
            }

            /* FILTER TABS & SEARCH BAR */
            .fase4-tab-wrapper {
                flex-direction: column !important;
                align-items: stretch !important;
                padding: 0.75rem !important;
                gap: 8px !important;
            }
            .fase4-tab-nav {
                width: 100% !important;
                display: grid !important;
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 6px !important;
                padding: 4px !important;
            }
            .fase4-tab-item {
                width: 100% !important;
                justify-content: center !important;
                padding: 0.45rem 0.4rem !important;
                font-size: 0.76rem !important;
                gap: 6px !important;
            }
            .fase4-tab-item span:first-of-type {
                text-overflow: ellipsis;
                overflow: hidden;
                white-space: nowrap;
            }
            .fase4-search-wrapper {
                width: 100% !important;
                min-width: 100% !important;
            }

            /* CARDS IN GRID */
            .fase4-doc-card-inner {
                padding: 0.85rem !important;
            }
            .fase4-card-head {
                gap: 6px !important;
            }
            .fase4-card-head-title {
                max-width: 100% !important;
            }
            .fase4-card-footer {
                flex-wrap: wrap !important;
                gap: 8px !important;
            }
            .fase4-card-footer .btn-success {
                flex-grow: 1 !important;
                justify-content: center !important;
            }

            /* MODALS (DETAIL, TAMBAH, MASTER) */
            .modal-dialog {
                margin: 0.5rem auto !important;
                width: 96% !important;
                max-width: 96% !important;
            }
            .modal-header {
                padding: 0.75rem 1rem !important;
            }
            .modal-header .modal-title {
                font-size: 0.95rem !important;
            }
            .modal-body {
                padding: 0.75rem !important;
                max-height: 74vh !important;
            }
            .modal-body .p-3 {
                padding: 0.75rem !important;
            }
            .fase4-modal-footer {
                padding: 0.75rem 1rem !important;
                flex-wrap: wrap !important;
                gap: 8px !important;
            }
            .fase4-modal-footer .btn {
                flex: 1 1 calc(50% - 6px) !important;
                justify-content: center !important;
                text-align: center !important;
                padding: 0.5rem 0.75rem !important;
                font-size: 0.82rem !important;
            }

            /* MASTER PICKER SPECIFICS */
            .master-picker-header {
                padding: 0.75rem 1rem !important;
            }
            .master-search-group,
            .master-category-select {
                width: 100% !important;
            }
            .select-all-box {
                width: 100% !important;
                justify-content: space-between !important;
            }
            #masterPickerSelectedBadge {
                width: 100% !important;
                text-align: center !important;
                justify-content: center !important;
            }
            .master-picker-item {
                width: 100% !important;
            }
        }

        @media (max-width: 480px) {
            .fase4-tab-nav {
                grid-template-columns: 1fr !important;
            }
            .fase4-stat-badges .badge {
                flex: 1 1 100% !important;
            }
            .fase4-modal-footer .btn {
                flex: 1 1 100% !important;
                width: 100% !important;
            }
        }

        /* ===== MODERN FILE UPLOAD STYLING (FASE 1 PARITY) ===== */
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
            top: 0;
            left: 0;
        }

        .pratanah-file-label-modern {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0.65rem 1rem;
            background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
            border: 2px dashed #d0d4db;
            border-radius: 10px;
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
            display: flex;
            align-items: center;
            justify-content: center;
            line-height: 1;
        }

        .pratanah-file-info-modern {
            flex: 1;
            overflow: hidden;
        }

        .pratanah-file-info-modern span {
            display: block;
            font-weight: 600;
            color: #2c2e3f;
            font-size: 0.8rem;
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
        }

        .pratanah-file-info-modern small {
            color: #6c7383;
            font-size: 0.68rem;
            display: block;
        }

        .fase4-doc-card-inner {
            border: 1.5px solid #cbd5e1 !important;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04) !important;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
            transform: none !important;
        }

        .fase4-doc-card-inner:hover {
            border-color: #9a55ff !important;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06) !important;
            transform: none !important;
        }

        .fase4-syarat-list-container {
            max-height: none;
            overflow: visible;
        }

        .btn-back-daftar {
            background-color: #ffffff !important;
            border: 1.5px solid #cbd5e1 !important;
            color: #334155 !important;
            font-size: 0.82rem !important;
            font-weight: 600 !important;
            border-radius: 8px !important;
            padding: 0.5rem 1.1rem !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 8px !important;
            text-decoration: none !important;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05) !important;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }

        .btn-back-daftar:hover {
            background-color: #f8fafc !important;
            border-color: #9a55ff !important;
            color: #7e22ce !important;
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.15) !important;
            transform: translateY(-1px) !important;
        }

        /* Universal Icon Spacing Rules so icons NEVER stick to text */
        i.fas, i.far, i.fab, i.mdi {
            display: inline-block !important;
            vertical-align: middle !important;
            line-height: 1 !important;
        }

        /* Guarantee proper margin on icons preceding text */
        .btn > i:first-child,
        .properti-btn > i:first-child,
        button > i:first-child,
        a > i:first-child,
        .badge > i:first-child,
        .form-label > i:first-child,
        .form-label span > i:first-child,
        h5 > i:first-child,
        h6 > i:first-child,
        span > i:first-child,
        div > i:first-child {
            margin-right: 8px !important;
        }

        /* Reset margin only when icon is strictly solitary */
        .btn:has(> i:only-child) > i,
        .btn-icon > i,
        button:has(> i:only-child) > i {
            margin-right: 0 !important;
        }

        /* Filter Tab Items and Navigation Tabs */
        .fase4-tab-item {
            display: inline-flex !important;
            align-items: center !important;
            gap: 7px !important;
        }
        .fase4-tab-item > i {
            margin-right: 0 !important;
        }

        .properti-nav-tab {
            display: inline-flex !important;
            align-items: center !important;
            gap: 8px !important;
        }
        .properti-nav-tab > i {
            margin-right: 0 !important;
        }
    </style>


    <div class="container-fluid px-2 px-md-4 py-3">

        <!-- Page Title & Subtitle (Persis Header Halaman Pasca Land Bank) -->
        <div class="row align-items-center mb-4">
            <div class="col d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div>
                    <h2 class="text-dark mb-1 fw-bold" style="font-size: 1.55rem; letter-spacing: -0.02em;">
                        Edit Data Tanah: {{ $land->name }}
                    </h2>
                    <p class="text-muted mb-0" style="font-size: 0.88rem;">
                        Kelola identitas lahan, spesifikasi tanah, legalitas awal, dan peta lokasi kawasan pasca land bank
                    </p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('properti-all') }}" class="btn btn-sm d-inline-flex align-items-center gap-2 px-3 py-2 shadow-sm text-white fw-bold" style="border: 1px solid #64748b; background-color: #64748b; border-radius: 8px; font-size: 0.85rem; transition: all 0.2s ease;">
                        <i class="mdi mdi-arrow-left text-white" style="font-size: 1.1rem; line-height: 1;"></i>
                        <span>Kembali</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Card: Persis Card Pasca Land Bank (compact-table-card) -->
        <div class="row">
            <div class="col-12">
                <div class="card compact-table-card shadow-sm border-0 mb-4" style="background: #ffffff; border: 1px solid #e2e8f0 !important; border-radius: 8px !important;">
                    
                    <!-- Card Header Berdiri Sendiri -->
                    <div class="card-header bg-white d-flex flex-wrap justify-content-between align-items-center gap-2 py-3 border-bottom" style="border-top-left-radius: 8px; border-top-right-radius: 8px; border-bottom: 1px solid #e2e8f0 !important;">
                        <div class="d-flex align-items-center gap-2">
                            <div class="p-2 rounded-2 bg-primary bg-opacity-10 text-primary">
                                <i class="mdi mdi-office-building-marker-outline fs-5"></i>
                            </div>
                            <div>
                                <h5 class="card-title mb-0" style="font-weight: 700; color: #1e293b; font-size: 1.05rem;">
                                    Formulir Edit Data Properti: {{ $land->name }}
                                </h5>
                                <small class="text-muted" style="font-size: 0.78rem;">Lengkapi identitas kawasan, peruntukan zona, fasilitas, dan dokumen legalitas tanah</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2.5 py-1.5 rounded-2 fw-semibold" style="font-size: 0.75rem;">
                                <i class="mdi mdi-check-circle me-1"></i>Pasca Land Bank
                            </span>
                        </div>
                    </div>

                    <div class="card-body p-3 p-md-4">
                        <!-- FORM CONTAINER PROFIL LAHAN -->
                        <div id="paneProfilLahan">


                        {{-- ERROR VALIDATION --}}
                        @if (session('success'))
                            <div id="successAlert" class="properti-alert properti-alert-success">
                                <i class="fas fa-check-circle me-2"></i>
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="properti-alert properti-alert-danger" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                                                    {{ old('company_profile_id', $land->company_profile_id) == $company->id ? 'selected' : '' }}>
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
                                            <span class="properti-check-text">Dekat Sekolah</span>
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
                                        <input type="checkbox" class="properti-checkbox-input" name="fasPasar"
                                            id="fasPasar" value="1"
                                            {{ old('fasPasar', $land->facility_market) ? 'checked' : '' }}>
                                        <label class="properti-checkbox-label" for="fasPasar">
                                            <i class="fas fa-check-circle properti-check-icon"></i>
                                            <span class="properti-check-text">Pasar</span>
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

                                    <div class="properti-checkbox-wrapper">
                                        <input type="checkbox" class="properti-checkbox-input" name="fasMall"
                                            id="fasMall" value="1" {{ old('fasMall', $land->facility_mall) ? 'checked' : '' }}>
                                        <label class="properti-checkbox-label" for="fasMall">
                                            <i class="fas fa-check-circle properti-check-icon"></i>
                                            <span class="properti-check-text">Mall / Swalayan</span>
                                        </label>
                                    </div>

                                    <div class="properti-checkbox-wrapper">
                                        <input type="checkbox" class="properti-checkbox-input" name="fasBank"
                                            id="fasBank" value="1"
                                            {{ old('fasBank', $land->facility_bank) ? 'checked' : '' }}>
                                        <label class="properti-checkbox-label" for="fasBank">
                                            <i class="fas fa-check-circle properti-check-icon"></i>
                                            <span class="properti-check-text">Bank / ATM</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="properti-form-group mt-3">
                                <label class="properti-form-label">Deskripsi</label>
                                <textarea name="deskripsi" class="properti-form-control" rows="3" placeholder="Deskripsi properti...">{{ old('deskripsi', $land->description) }}</textarea>
                            </div>

                            <hr class="properti-hr">

                            {{-- ================= DOKUMEN LEGAL & BERKAS WARKAH ================= --}}
                            @php
                                $shgbNomor = $shgbTask->nomor_dokumen ?? ($land->shgb_induk_no ?: null);
                                $shgbTglRaw = $shgbTask->tanggal_terbit ?? $land->shgb_induk_date;
                                $shgbTanggal = $shgbTglRaw ? \Carbon\Carbon::parse($shgbTglRaw)->translatedFormat('d F Y') : null;
                                $shgbFile = $shgbTask->file_dokumen ?? $land->shgb_induk_file;
                                $isShgbTerbit = $shgbTask && in_array(strtolower($shgbTask->status ?? ''), ['selesai', 'terbit']);
                                
                                $shgbUrl = '#';
                                if (!empty($shgbFile)) {
                                    if (str_starts_with($shgbFile, 'http')) {
                                        $shgbUrl = $shgbFile;
                                    } elseif (str_starts_with($shgbFile, 'uploads/')) {
                                        $shgbUrl = asset($shgbFile);
                                    } elseif (str_starts_with($shgbFile, 'storage/')) {
                                        $shgbUrl = asset($shgbFile);
                                    } elseif (file_exists(public_path('uploads/' . $shgbFile))) {
                                        $shgbUrl = asset('uploads/' . $shgbFile);
                                    } else {
                                        $shgbUrl = asset('storage/' . $shgbFile);
                                    }
                                }
                            @endphp

                            <h5 class="properti-section-title">
                                <i class="fas fa-file-contract me-2"></i>
                                Dokumen Legalitas & Berkas Alas Hak (Sertifikat Tanah)
                            </h5>

                            <div class="row g-3 mb-3">
                                <!-- Card Sertifikat SHGB Induk an. PT (Hasil Perizinan) -->
                                <div class="col-12 col-md-6 col-xl-4">
                                    <div class="card h-100 border shadow-sm rounded-3 p-3 position-relative fase4-doc-card-inner" style="background: #ffffff;">
                                        <!-- Header Card Box -->
                                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3 pb-2 border-bottom">
                                            <div>
                                                <h6 class="mb-0 fw-bold text-dark" style="font-size: 0.92rem;">Sertifikat SHGB Induk an. PT</h6>
                                            </div>
                                            <div class="d-flex align-items-center gap-1 flex-wrap justify-content-end">
                                                @if($isShgbTerbit || $shgbNomor)
                                                    <span class="badge bg-success py-1 px-2 text-wrap" style="font-size: 10px;">
                                                        <i class="mdi mdi-shield-check me-1"></i>Sah (Terbit)
                                                    </span>
                                                @else
                                                    <span class="badge bg-warning text-dark py-1 px-2 text-wrap" style="font-size: 10px;">
                                                        <i class="mdi mdi-clock-outline me-1"></i>Proses Perizinan
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Input Nomor Dokumen -->
                                        <div class="mb-2">
                                            <label class="form-label mb-1 text-muted d-flex align-items-center justify-content-between" style="font-size: 0.78rem; font-weight: 600;">
                                                <span>Nomor Sertifikat SHGB Induk</span>
                                                <span class="badge bg-success-subtle text-success border border-success px-1.5 py-0.2" style="font-size: 0.65rem;">
                                                    <i class="fas fa-lock me-1"></i>Terkunci (Perizinan)
                                                </span>
                                            </label>
                                            <input type="text" 
                                                class="form-control form-control-sm bg-light text-dark font-monospace fw-semibold" 
                                                placeholder="Nomor SHGB Induk"
                                                value="{{ $shgbNomor ?: 'Belum Terbit' }}"
                                                style="font-size: 0.84rem;"
                                                readonly>
                                        </div>

                                        <!-- Upload / Display Berkas File (Persis Kelola Perizinan) -->
                                        <div class="mb-1 flex-grow-1 d-flex flex-column justify-content-end">
                                            @if($shgbFile)
                                                <!-- State: Berkas SHGB Resmi Terunggah (File Bawaan dari Perizinan -> Cuma Tombol Lihat) -->
                                                <div class="p-3 rounded-3 mb-2" style="background: #f0fdf4; border: 1.5px solid #86efac;">
                                                    <div class="d-flex align-items-center justify-content-between gap-2 flex-wrap doc-uploaded-inner">
                                                        <div class="d-flex align-items-center gap-2.5 overflow-hidden flex-grow-1 me-2" style="min-width: 0;">
                                                            <div class="p-2 rounded-2 flex-shrink-0" style="background: rgba(0, 201, 167, 0.15); color: #00c9a7;">
                                                                <i class="mdi mdi-file-check-outline" style="font-size: 1.35rem;"></i>
                                                            </div>
                                                            <div class="overflow-hidden" style="min-width: 0;">
                                                                <span class="d-block fw-bold text-success text-truncate" id="shgbStatusText" style="font-size: 0.85rem; line-height: 1.2;">Berkas SK Resmi Terunggah</span>
                                                                <small class="text-muted text-truncate d-block font-monospace" id="shgbFileName" style="font-size: 0.74rem;">{{ basename($shgbFile) }}</small>
                                                            </div>
                                                        </div>
                                                        <!-- FILE BAWAAN: CUMA TOMBOL LIHAT -->
                                                        <div class="flex-shrink-0">
                                                            <a href="{{ $shgbUrl }}" target="_blank" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center" style="background-color: #10b981; border: none; font-size: 0.78rem; border-radius: 6px; gap: 6px;">
                                                                <i class="mdi mdi-eye" style="font-size: 0.95rem; line-height: 1; margin-right: 2px;"></i>
                                                                <span>Lihat</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <!-- State: Belum Upload / Dari Perizinan -->
                                                <div class="p-2.5 px-3 rounded-3 mb-2 bg-light border text-center">
                                                    <small class="text-muted d-block mb-1" style="font-size: 0.74rem;">Berkas diunggah di modul Perizinan</small>
                                                    @if(isset($proyekId))
                                                        <a href="{{ route('perizinan.show', $proyekId) }}" target="_blank" class="btn btn-xs btn-outline-primary py-1 px-2.5 rounded-2 d-inline-flex align-items-center gap-1 shadow-xs" style="font-size: 0.75rem;">
                                                            <i class="fas fa-external-link-alt"></i> Buka Perizinan
                                                        </a>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                @foreach ($documentTypes as $type)
                                    @php
                                        $existingDoc = $land->documents->where('document_type_id', $type->id)->first();
                                        $hasDoc = $existingDoc && !empty($existingDoc->file_path);
                                        $isDocLocked = $hasDoc && (($existingDoc->status === 'verified') || $land->isFromPraLandbank() || $land->legal_status === 'verified' || str_contains($existingDoc->file_path, 'pra_landbank'));
                                        
                                        $docUrl = '#';
                                        if ($hasDoc) {
                                            $fPath = $existingDoc->file_path;
                                            if (str_starts_with($fPath, 'http')) {
                                                $docUrl = $fPath;
                                            } elseif (str_starts_with($fPath, 'uploads/')) {
                                                $docUrl = asset($fPath);
                                            } elseif (str_starts_with($fPath, 'storage/')) {
                                                $docUrl = asset($fPath);
                                            } elseif (file_exists(public_path('uploads/' . $fPath))) {
                                                $docUrl = asset('uploads/' . $fPath);
                                            } else {
                                                $docUrl = asset('storage/' . $fPath);
                                            }
                                        }
                                    @endphp
                                    <div class="col-12 col-md-6 col-xl-4">
                                        <div class="card h-100 border shadow-sm rounded-3 p-3 position-relative fase4-doc-card-inner" style="background: #ffffff;">
                                            <!-- Header Card Box -->
                                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3 pb-2 border-bottom">
                                                <div>
                                                    <h6 class="mb-0 fw-bold text-dark" style="font-size: 0.92rem;">{{ $type->name }}</h6>
                                                </div>
                                                <div class="d-flex align-items-center gap-1 flex-wrap justify-content-end">
                                                    @if($hasDoc && $isDocLocked)
                                                        <span class="badge bg-success py-1 px-2 text-wrap" style="font-size: 10px;">
                                                            <i class="mdi mdi-shield-check me-1"></i>Sah (ACC)
                                                        </span>
                                                    @elseif($hasDoc)
                                                        <span class="badge bg-warning text-dark py-1 px-2 text-wrap" style="font-size: 10px;">
                                                            <i class="mdi mdi-clock-outline me-1"></i>Menunggu Verifikasi
                                                        </span>
                                                    @else
                                                        <span class="badge bg-light text-muted border py-1 px-2" style="font-size: 10px;">
                                                            Belum Upload
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Input Nomor Dokumen -->
                                            <div class="mb-2">
                                                <label class="form-label mb-1 text-muted d-flex align-items-center justify-content-between" style="font-size: 0.78rem; font-weight: 600;">
                                                    <span>Nomor Dokumen {{ $type->name }}</span>
                                                    @if($isDocLocked && $existingDoc && $existingDoc->document_number)
                                                        <span class="badge bg-success-subtle text-success border border-success px-1.5 py-0.2" style="font-size: 0.65rem;">
                                                            <i class="fas fa-lock me-1"></i>Terkunci
                                                        </span>
                                                    @endif
                                                </label>
                                                <input type="text" 
                                                    name="documents[{{ $type->id }}][number]"
                                                    class="form-control form-control-sm {{ $isDocLocked ? 'bg-light text-muted' : '' }}" 
                                                    placeholder="Nomor {{ $type->name }}"
                                                    value="{{ old('documents.'.$type->id.'.number', $existingDoc ? $existingDoc->document_number : '') }}"
                                                    style="font-size: 0.84rem;"
                                                    {{ $isDocLocked ? 'readonly' : '' }}>
                                            </div>

                                            <!-- Upload / Display Berkas File (Persis Format Perizinan Kelola) -->
                                            <div class="mb-1 flex-grow-1 d-flex flex-column justify-content-end">
                                                @if($hasDoc)
                                                    <!-- State: Berkas Sudah Ada (Persis Perizinan Kelola) -->
                                                    <div class="p-3 rounded-3 mb-2" style="background: #f0fdf4; border: 1.5px solid #86efac;">
                                                        <div class="d-flex align-items-center justify-content-between gap-2 flex-wrap doc-uploaded-inner">
                                                            <div class="d-flex align-items-center gap-2.5 overflow-hidden flex-grow-1 me-2" style="min-width: 0;">
                                                                <div class="p-2 rounded-2 flex-shrink-0" style="background: rgba(0, 201, 167, 0.15); color: #00c9a7;">
                                                                    <i class="mdi mdi-file-check-outline" style="font-size: 1.35rem;"></i>
                                                                </div>
                                                                <div class="overflow-hidden" style="min-width: 0;">
                                                                    <span class="d-block fw-bold text-success text-truncate" id="docStatusText_{{ $type->id }}" style="font-size: 0.85rem; line-height: 1.2;">Berkas SK Resmi Terunggah</span>
                                                                    <small class="text-muted text-truncate d-block font-monospace" id="docFileName_{{ $type->id }}" style="font-size: 0.74rem;">{{ basename($existingDoc->file_path) }}</small>
                                                                </div>
                                                            </div>
                                                            <!-- BUTTONS: JIKA FILE BAWAAN HANYA LIHAT, JIKA UPLOAD BARU ADA LIHAT & GANTI -->
                                                            <div class="d-flex align-items-center flex-shrink-0 doc-action-btns" style="gap: 8px;">
                                                                <a href="{{ $docUrl }}" target="_blank" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center" style="background-color: #10b981; border: none; font-size: 0.78rem; border-radius: 6px; gap: 6px;">
                                                                    <i class="mdi mdi-eye" style="font-size: 0.95rem; line-height: 1; margin-right: 2px;"></i>
                                                                    <span>Lihat</span>
                                                                </a>
                                                                @if(!$isDocLocked)
                                                                    <button type="button" onclick="document.getElementById('upload_{{ $type->id }}').click()" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center" style="background-color: #9a55ff; border: 1px solid #9a55ff; font-size: 0.78rem; border-radius: 6px; gap: 6px;">
                                                                        <i class="mdi mdi-cloud-sync" style="font-size: 0.95rem; line-height: 1; margin-right: 2px;"></i>
                                                                        <span>Ganti</span>
                                                                    </button>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if(!$isDocLocked)
                                                        <input type="file" name="documents[{{ $type->id }}][file]" id="upload_{{ $type->id }}" class="d-none" accept=".pdf,.jpg,.jpeg,.png" onchange="previewDocFileChange(this, {{ $type->id }})">
                                                    @endif
                                                @else
                                                    <!-- State: Belum Upload (Gaya Asal Modern Pra/Tambah Properti) -->
                                                    <div id="docEmptyBox_{{ $type->id }}">
                                                        <label class="form-label mb-1 text-muted d-flex align-items-center justify-content-between" style="font-size: 0.78rem; font-weight: 600;">
                                                            <span>Upload Berkas {{ $type->name }}</span>
                                                            <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25" style="font-size: 9px;">Format PDF/JPG/PNG</span>
                                                        </label>
                                                        <div class="pratanah-file-upload-modern" onclick="document.getElementById('upload_{{ $type->id }}').click()" style="cursor: pointer;">
                                                            <div class="pratanah-file-label-modern py-2 px-2.5 rounded-3 d-flex align-items-center gap-2.5" style="border: 1.5px dashed #c4b5fd; background: #fdfcff; transition: all 0.2s ease;">
                                                                <div class="p-1.5 rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="background: rgba(154, 85, 255, 0.12); width: 34px; height: 34px;">
                                                                    <i class="fas fa-cloud-upload-alt text-primary" style="font-size: 1.1rem; color: #9a55ff;"></i>
                                                                </div>
                                                                <div class="pratanah-file-info-modern overflow-hidden">
                                                                    <span class="file-label-text fw-bold text-primary text-truncate d-block" style="font-size: 0.80rem;">Pilih Berkas {{ $type->name }}</span>
                                                                    <small class="text-muted d-block" style="font-size: 0.68rem;">PDF, JPG, PNG (Maks 2MB)</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- State: Box Hijau Saat Baru Dipilih (Upload Baru -> Ada Lihat & Ganti) -->
                                                    <div id="docUploadedBox_{{ $type->id }}" class="p-3 rounded-3 mb-2" style="background: #f0fdf4; border: 1.5px solid #86efac; display: none;">
                                                        <div class="d-flex align-items-center justify-content-between gap-2 flex-wrap doc-uploaded-inner">
                                                            <div class="d-flex align-items-center gap-2.5 overflow-hidden flex-grow-1 me-2" style="min-width: 0;">
                                                                <div class="p-2 rounded-2 flex-shrink-0" style="background: rgba(0, 201, 167, 0.15); color: #00c9a7;">
                                                                    <i class="mdi mdi-file-check-outline" style="font-size: 1.35rem;"></i>
                                                                </div>
                                                                <div class="overflow-hidden" style="min-width: 0;">
                                                                    <span class="d-block fw-bold text-success text-truncate" id="docStatusText_{{ $type->id }}" style="font-size: 0.85rem; line-height: 1.2;">Berkas SK Resmi Terunggah</span>
                                                                    <small class="text-muted text-truncate d-block font-monospace" id="docFileName_{{ $type->id }}" style="font-size: 0.74rem;"></small>
                                                                </div>
                                                            </div>
                                                            <!-- 2 BUTTONS: LIHAT & GANTI UNTUK UPLOAD BARU -->
                                                            <div class="d-flex align-items-center flex-shrink-0 doc-action-btns" style="gap: 8px;">
                                                                <a href="#" target="_blank" id="docViewLink_{{ $type->id }}" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center" style="background-color: #10b981; border: none; font-size: 0.78rem; border-radius: 6px; gap: 6px;">
                                                                    <i class="mdi mdi-eye" style="font-size: 0.95rem; line-height: 1; margin-right: 2px;"></i>
                                                                    <span>Lihat</span>
                                                                </a>
                                                                <button type="button" onclick="document.getElementById('upload_{{ $type->id }}').click()" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center" style="background-color: #9a55ff; border: 1px solid #9a55ff; font-size: 0.78rem; border-radius: 6px; gap: 6px;">
                                                                    <i class="mdi mdi-cloud-sync" style="font-size: 0.95rem; line-height: 1; margin-right: 2px;"></i>
                                                                    <span>Ganti</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <input type="file" name="documents[{{ $type->id }}][file]" id="upload_{{ $type->id }}" class="d-none" accept=".pdf,.jpg,.jpeg,.png" onchange="previewDocFileChange(this, {{ $type->id }})">
                                                @endif
                                            </div>
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

                            <div class="row g-3 mb-3">
                                <div class="col-12">
                                    <div class="card border shadow-sm rounded-3 p-3 position-relative fase4-doc-card-inner" style="background: #ffffff;">
                                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3 pb-2 border-bottom">
                                            <div>
                                                <h6 class="mb-0 fw-bold text-dark" style="font-size: 0.92rem;">Berkas Denah / Siteplan</h6>
                                            </div>
                                            <div>
                                                @if($hasDenah)
                                                    <span class="badge bg-success py-1 px-2 text-wrap" style="font-size: 10px;">
                                                        <i class="mdi mdi-shield-check me-1"></i>Denah Terunggah
                                                    </span>
                                                @else
                                                    <span class="badge bg-light text-muted border py-1 px-2" style="font-size: 10px;">
                                                        Belum Upload
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        @if($hasDenah)
                                            <div id="denahUploadedBox" class="p-3 rounded-3 mb-2" style="background: #f0fdf4; border: 1.5px solid #86efac;">
                                                <div class="d-flex align-items-center justify-content-between gap-2 flex-wrap doc-uploaded-inner">
                                                    <div class="d-flex align-items-center gap-2.5 overflow-hidden flex-grow-1 me-2" style="min-width: 0;">
                                                        <div class="p-2 rounded-2 flex-shrink-0" style="background: rgba(0, 201, 167, 0.15); color: #00c9a7;">
                                                            <i class="mdi mdi-file-check-outline" style="font-size: 1.35rem;"></i>
                                                        </div>
                                                        <div class="overflow-hidden" style="min-width: 0;">
                                                            <span class="d-block fw-bold text-success text-truncate" id="denahStatusText" style="font-size: 0.85rem; line-height: 1.2;">Berkas SK Resmi Terunggah</span>
                                                            <small class="text-muted text-truncate d-block font-monospace" id="denahFileName" style="font-size: 0.74rem;">{{ basename($land->denah) }}</small>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center flex-shrink-0 doc-action-btns" style="gap: 8px;">
                                                        <a href="{{ $denahUrl }}" target="_blank" id="denahViewLink" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center" style="background-color: #10b981; border: none; font-size: 0.78rem; border-radius: 6px; gap: 6px;">
                                                            <i class="mdi mdi-eye" style="font-size: 0.95rem; line-height: 1; margin-right: 2px;"></i>
                                                            <span>Lihat</span>
                                                        </a>
                                                        <button type="button" onclick="document.getElementById('upload_denah').click()" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center" style="background-color: #9a55ff; border: 1px solid #9a55ff; font-size: 0.78rem; border-radius: 6px; gap: 6px;">
                                                            <i class="mdi mdi-cloud-sync" style="font-size: 0.95rem; line-height: 1; margin-right: 2px;"></i>
                                                            <span>Ganti</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="file" name="denah" id="upload_denah" class="d-none" accept=".pdf,.jpg,.jpeg,.png,.webp,.svg" onchange="previewDenahFileChange(this)">
                                        @else
                                            <div id="denahEmptyBox">
                                                <label class="form-label mb-1 text-muted d-flex align-items-center justify-content-between" style="font-size: 0.78rem; font-weight: 600;">
                                                    <span>Upload Berkas Denah / Siteplan</span>
                                                    <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25" style="font-size: 9px;">JPG, PNG, WEBP, PDF (Maks 5MB)</span>
                                                </label>
                                                <div class="pratanah-file-upload-modern" onclick="document.getElementById('upload_denah').click()" style="cursor: pointer;">
                                                    <div class="pratanah-file-label-modern py-2 px-3" style="border: 1.5px dashed #9a55ff; background: #faf5ff;">
                                                        <i class="mdi mdi-cloud-upload" style="color: #9a55ff; font-size: 1.3rem;"></i>
                                                        <div class="pratanah-file-info-modern">
                                                            <span class="file-label-text fw-bold text-primary" style="font-size: 0.82rem;">Pilih Berkas Denah / Siteplan</span>
                                                            <small style="font-size: 0.70rem; color: #8c98a4;">Format: JPG, PNG, WEBP, SVG, PDF (Maks 5MB)</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="denahUploadedBox" class="p-3 rounded-3 mb-2" style="background: #f0fdf4; border: 1.5px solid #86efac; display: none;">
                                                <div class="d-flex align-items-center justify-content-between gap-2 flex-wrap doc-uploaded-inner">
                                                    <div class="d-flex align-items-center gap-2.5 overflow-hidden flex-grow-1 me-2" style="min-width: 0;">
                                                        <div class="p-2 rounded-2 flex-shrink-0" style="background: rgba(0, 201, 167, 0.15); color: #00c9a7;">
                                                            <i class="mdi mdi-file-check-outline" style="font-size: 1.35rem;"></i>
                                                        </div>
                                                        <div class="overflow-hidden" style="min-width: 0;">
                                                            <span class="d-block fw-bold text-success text-truncate" id="denahStatusText" style="font-size: 0.85rem; line-height: 1.2;">Berkas SK Resmi Terunggah</span>
                                                            <small class="text-muted text-truncate d-block font-monospace" id="denahFileName" style="font-size: 0.74rem;"></small>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center flex-shrink-0 doc-action-btns" style="gap: 8px;">
                                                        <a href="#" target="_blank" id="denahViewLink" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center" style="background-color: #10b981; border: none; font-size: 0.78rem; border-radius: 6px; gap: 6px;">
                                                            <i class="mdi mdi-eye" style="font-size: 0.95rem; line-height: 1; margin-right: 2px;"></i>
                                                            <span>Lihat</span>
                                                        </a>
                                                        <button type="button" onclick="document.getElementById('upload_denah').click()" class="btn btn-sm text-white fw-bold px-3 py-1.5 shadow-sm d-inline-flex align-items-center justify-content-center" style="background-color: #9a55ff; border: 1px solid #9a55ff; font-size: 0.78rem; border-radius: 6px; gap: 6px;">
                                                            <i class="mdi mdi-cloud-sync" style="font-size: 0.95rem; line-height: 1; margin-right: 2px;"></i>
                                                            <span>Ganti</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="file" name="denah" id="upload_denah" class="d-none" accept=".pdf,.jpg,.jpeg,.png,.webp,.svg" onchange="previewDenahFileChange(this)">
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
                                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                                </a>

                                <div class="btn-right">
                                    <button type="submit" class="properti-btn properti-btn-primary">
                                        <i class="fas fa-save mr-2"></i>Simpan Perubahan
                                    </button>
                                </div>
                            </div>

                        </form>
                        </div>
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
                    if (selectedValue) {
                        $(targetSelect).val(selectedValue);
                    }
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
                $('#provinsiProperti').on('change select2:select', async function() {
                    const selectedOpt = $(this).find(':selected')[0];
                    const pId = selectedOpt ? selectedOpt.getAttribute('data-id') : null;
                    kotaSelect.innerHTML = '<option value="">-- Pilih Kota/Kabupaten --</option>';
                    kecSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
                    kelSelect.innerHTML = '<option value="">-- Pilih Kelurahan/Desa --</option>';
                    $('#kotaProperti, #kecamatanProperti, #kelurahanProperti').val('').trigger('change.select2');

                    if (pId) {
                        await loadWilayahProperti('regencies', kotaSelect, pId);
                    }
                });

                // On City Change
                $('#kotaProperti').on('change select2:select', async function() {
                    const selectedOpt = $(this).find(':selected')[0];
                    const cId = selectedOpt ? selectedOpt.getAttribute('data-id') : null;
                    kecSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
                    kelSelect.innerHTML = '<option value="">-- Pilih Kelurahan/Desa --</option>';
                    $('#kecamatanProperti, #kelurahanProperti').val('').trigger('change.select2');

                    if (cId) {
                        await loadWilayahProperti('districts', kecSelect, cId);
                    }
                });

                // On District Change
                $('#kecamatanProperti').on('change select2:select', async function() {
                    const selectedOpt = $(this).find(':selected')[0];
                    const dId = selectedOpt ? selectedOpt.getAttribute('data-id') : null;
                    kelSelect.innerHTML = '<option value="">-- Pilih Kelurahan/Desa --</option>';
                    $('#kelurahanProperti').val('').trigger('change.select2');

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

            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    timer: 3500,
                    showConfirmButton: true,
                    confirmButtonColor: '#3085d6'
                });
            @endif
            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Memperbarui!',
                    text: "{{ session('error') }}",
                    showConfirmButton: true,
                    confirmButtonColor: '#d33'
                });
            @endif
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


    
        // Delegated change listener for modern file upload labels
        document.addEventListener('change', function(e) {
            if (e.target && e.target.matches('.pratanah-file-upload-modern input[type="file"]')) {
                const labelText = e.target.closest('.pratanah-file-upload-modern')?.querySelector('.file-label-text');
                if (labelText && e.target.files && e.target.files.length > 0) {
                    labelText.textContent = e.target.files[0].name;
                    labelText.classList.add('text-success');
                }
            }
        });

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

        function previewDocFileChange(input, typeId) {
            if (input.files && input.files[0]) {
                const file = input.files[0];
                const fileUrl = URL.createObjectURL(file);

                const fileNameEl = document.getElementById('docFileName_' + typeId);
                const statusTextEl = document.getElementById('docStatusText_' + typeId);
                const viewLinkEl = document.getElementById('docViewLink_' + typeId);

                if (fileNameEl) fileNameEl.textContent = file.name;
                if (statusTextEl) {
                    statusTextEl.textContent = 'Berkas SK Resmi Terunggah';
                    statusTextEl.className = 'd-block fw-bold text-success text-truncate';
                }
                if (viewLinkEl) {
                    viewLinkEl.href = fileUrl;
                }

                // If currently showing empty box, transition to uploaded box (which has Lihat & Ganti)
                const emptyBox = document.getElementById('docEmptyBox_' + typeId);
                const uploadedBox = document.getElementById('docUploadedBox_' + typeId);
                if (emptyBox && uploadedBox) {
                    emptyBox.style.display = 'none';
                    uploadedBox.style.display = 'block';
                }
            }
        }

        function previewShgbFileChange(input) {
            if (input.files && input.files[0]) {
                const file = input.files[0];
                const fileNameEl = document.getElementById('shgbFileName');
                const statusTextEl = document.getElementById('shgbStatusText');
                if (fileNameEl) fileNameEl.textContent = file.name + ' (Baru dipilih)';
                if (statusTextEl) {
                    statusTextEl.textContent = 'Berkas Baru Dipilih';
                    statusTextEl.className = 'd-block fw-bold text-primary text-truncate';
                }
            }
        }

        function previewDenahFileChange(input) {
            if (input.files && input.files[0]) {
                const file = input.files[0];
                const fileUrl = URL.createObjectURL(file);
                const fileNameEl = document.getElementById('denahFileName');
                const statusTextEl = document.getElementById('denahStatusText');
                const viewLinkEl = document.getElementById('denahViewLink');
                const emptyBox = document.getElementById('denahEmptyBox');
                const uploadedBox = document.getElementById('denahUploadedBox');

                if (fileNameEl) fileNameEl.textContent = file.name;
                if (statusTextEl) {
                    statusTextEl.textContent = 'Berkas SK Resmi Terunggah';
                    statusTextEl.className = 'd-block fw-bold text-success text-truncate';
                }
                if (viewLinkEl) {
                    viewLinkEl.href = fileUrl;
                }
                if (emptyBox) emptyBox.style.display = 'none';
                if (uploadedBox) uploadedBox.style.display = 'block';
            }
        }
    </script>
@endpush
