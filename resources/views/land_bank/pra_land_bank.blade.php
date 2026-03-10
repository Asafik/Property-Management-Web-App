@extends('layouts.partial.app')

@section('title', 'Pra Tanah - Property Management App')

@section('content')
    <style>
        /* ===== STYLE CSS SAMA PERSIS DENGAN ASLINYA ===== */
        .pratanah-form-group {
            margin-bottom: 1rem;
        }

        @media (min-width: 768px) {
            .pratanah-form-group {
                margin-bottom: 1.2rem;
            }
        }

        .pratanah-form-group label,
        .pratanah-form-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: #9a55ff !important;
            margin-bottom: 0.3rem;
            letter-spacing: 0.3px;
            font-family: 'Nunito', sans-serif;
            display: block;
        }

        @media (min-width: 768px) {

            .pratanah-form-group label,
            .pratanah-form-label {
                font-size: 0.85rem;
                margin-bottom: 0.4rem;
            }
        }

        .pratanah-form-control,
        input[type="text"].pratanah-form-control,
        input[type="number"].pratanah-form-control,
        input[type="date"].pratanah-form-control,
        select.pratanah-form-control,
        textarea.pratanah-form-control {
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

            .pratanah-form-control,
            input[type="text"].pratanah-form-control,
            input[type="number"].pratanah-form-control,
            input[type="date"].pratanah-form-control,
            select.pratanah-form-control,
            textarea.pratanah-form-control {
                padding: 0.6rem 0.75rem;
                font-size: 0.9rem;
                border-radius: 8px;
            }
        }

        .pratanah-form-control:focus {
            border-color: #9a55ff;
            box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.1);
            outline: none;
        }

        .pratanah-form-control.is-invalid {
            border-color: #dc3545;
        }

        select.pratanah-form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%239a55ff' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 12px;
            padding-right: 2rem;
        }

        /* Select2 Styling */
        .select2-container--bootstrap-5 .select2-selection {
            border: 1px solid #e9ecef !important;
            border-radius: 10px !important;
            padding: 0.5rem 0.8rem !important;
            min-height: 42px !important;
            font-family: 'Nunito', sans-serif !important;
            background-color: #ffffff !important;
        }

        .select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
            color: #2c2e3f !important;
            font-size: 0.9rem !important;
            line-height: 1.5 !important;
            padding-left: 0 !important;
        }

        .select2-container--bootstrap-5 .select2-selection--single .select2-selection__arrow {
            height: 40px !important;
            right: 10px !important;
        }

        .select2-container--bootstrap-5 .select2-selection--single .select2-selection__arrow b {
            border-color: #9a55ff transparent transparent transparent !important;
        }

        /* Input Group */
        .pratanah-input-group {
            display: flex;
            align-items: stretch;
            width: 100%;
        }

        .pratanah-input-group-prepend {
            display: flex;
        }

        .pratanah-input-group-text {
            display: flex;
            align-items: center;
            padding: 0.7rem 0.8rem;
            font-size: 0.85rem;
            font-weight: 400;
            line-height: 1;
            color: #6c7383;
            text-align: center;
            white-space: nowrap;
            background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
            border: 1px solid #e9ecef;
            border-radius: 10px 0 0 10px;
            border-right: none;
        }

        .pratanah-input-group .pratanah-form-control {
            border-radius: 0 10px 10px 0;
        }

        /* Button Styling */
        .pratanah-btn {
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
            .pratanah-btn {
                width: auto;
                padding: 0.5rem 1.2rem;
            }
        }

        .pratanah-btn-primary {
            background: linear-gradient(to right, #da8cff, #9a55ff);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.3);
        }

        .pratanah-btn-primary:hover {
            background: linear-gradient(to right, #c77cff, #8a45e6);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(154, 85, 255, 0.4);
        }

        .pratanah-btn-secondary {
            background: linear-gradient(135deg, #f0f2f5, #e4e6ea);
            border: 1px solid #e9ecef;
            color: #2c2e3f;
        }

        .pratanah-btn-secondary:hover {
            background: linear-gradient(135deg, #e4e6ea, #d8dce2);
            transform: translateY(-2px);
            color: #2c2e3f;
        }

        .pratanah-btn-outline-primary {
            background: transparent;
            border: 1px solid #9a55ff;
            color: #9a55ff;
        }

        .pratanah-btn-outline-primary:hover {
            background: linear-gradient(135deg, #9a55ff, #da8cff);
            color: #ffffff;
            border-color: transparent;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.3);
        }

        .pratanah-btn-sm {
            padding: 0.25rem 0.75rem;
            font-size: 0.75rem;
        }

        /* Text colors */
        .pratanah-text-muted {
            color: #a5b3cb !important;
            font-size: 0.7rem;
            display: block;
            margin-top: 0.2rem;
        }

        .pratanah-text-danger {
            color: #dc3545 !important;
        }

        .pratanah-text-success {
            color: #28a745 !important;
        }

        .pratanah-text-warning {
            color: #ffc107 !important;
        }

        /* Divider */
        .pratanah-hr {
            border-top: 1px solid #e9ecef;
            margin: 0.8rem 0;
        }

        /* Alert Styling */
        .pratanah-alert {
            border: none;
            border-radius: 10px;
            padding: 0.8rem 1rem;
            font-size: 0.8rem;
            border-left: 4px solid;
            margin-bottom: 1rem;
        }

        .pratanah-alert-info {
            background: linear-gradient(135deg, #f6f9ff, #f0f4ff);
            color: #2c2e3f;
            border-left-color: #9a55ff;
        }

        .pratanah-alert-success {
            background: linear-gradient(135deg, #f0fff4, #e6f7e6);
            color: #2c2e3f;
            border-left-color: #28a745;
        }

        .pratanah-alert-warning {
            background: linear-gradient(135deg, #fff9e6, #fff3d6);
            color: #2c2e3f;
            border-left-color: #ffc107;
        }

        /* Section Title */
        .pratanah-section-title {
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

        .pratanah-section-title i {
            color: #9a55ff;
            font-size: 1.1rem;
            background: rgba(154, 85, 255, 0.1);
            padding: 6px;
            border-radius: 8px;
        }

        .pratanah-section-title .badge {
            margin-left: auto;
            font-size: 0.7rem;
            padding: 0.3rem 0.6rem;
        }

        /* Card Styling */
        .pratanah-card {
            border: 1px solid #e9ecef;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
            background: #ffffff;
            transition: all 0.3s ease;
            margin-bottom: 1rem;
        }

        .pratanah-card .pratanah-card-body {
            padding: 1rem;
        }

        @media (min-width: 768px) {
            .pratanah-card .pratanah-card-body {
                padding: 1.2rem;
            }
        }

        /* Grid System */
        .pratanah-row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -0.3rem;
            margin-left: -0.3rem;
        }

        .pratanah-col-6,
        .pratanah-col-12,
        .pratanah-col-sm-6,
        .pratanah-col-md-3,
        .pratanah-col-md-4,
        .pratanah-col-md-6 {
            position: relative;
            width: 100%;
            padding-right: 0.3rem;
            padding-left: 0.3rem;
            margin-bottom: 0.5rem;
        }

        @media (min-width: 576px) {
            .pratanah-col-sm-6 {
                flex: 0 0 50%;
                max-width: 50%;
            }
        }

        @media (min-width: 768px) {
            .pratanah-col-md-3 {
                flex: 0 0 25%;
                max-width: 25%;
            }

            .pratanah-col-md-4 {
                flex: 0 0 33.333333%;
                max-width: 33.333333%;
            }

            .pratanah-col-md-6 {
                flex: 0 0 50%;
                max-width: 50%;
            }
        }

        /* Modern Checkbox - Sama persis dengan template */
        .pratanah-checkbox-group {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            justify-content: flex-start;
            margin-top: 0.5rem;
        }

        .pratanah-checkbox-wrapper {
            position: relative;
            min-width: 140px;
            flex: 1 1 auto;
        }

        .pratanah-checkbox-input {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .pratanah-checkbox-label {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0.75rem 1.2rem;
            background: linear-gradient(135deg, #f8f9fa, #f1f3f5);
            border: 2px solid #e9ecef;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .pratanah-checkbox-label::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(154, 85, 255, 0.1), rgba(218, 140, 255, 0.1));
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }

        .pratanah-checkbox-wrapper:hover .pratanah-checkbox-label {
            border-color: #9a55ff;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(154, 85, 255, 0.15);
        }

        .pratanah-checkbox-wrapper:hover .pratanah-checkbox-label::before {
            opacity: 1;
        }

        .pratanah-check-icon {
            font-size: 1.4rem;
            color: #d0d4db;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: white;
            border-radius: 50%;
            padding: 2px;
        }

        .pratanah-checkbox-input:checked+.pratanah-checkbox-label {
            border-color: #9a55ff;
            background: linear-gradient(135deg, #f1f0ff, #e8e0ff);
            box-shadow: 0 5px 15px rgba(154, 85, 255, 0.2);
        }

        .pratanah-checkbox-input:checked+.pratanah-checkbox-label .pratanah-check-icon {
            color: #9a55ff;
            transform: scale(1.1);
            filter: drop-shadow(0 4px 8px rgba(154, 85, 255, 0.4));
            animation: pratanahCheckPulse 0.3s ease;
        }

        .pratanah-checkbox-input:checked+.pratanah-checkbox-label .pratanah-check-text {
            color: #9a55ff;
            font-weight: 600;
        }

        .pratanah-check-text {
            transition: all 0.3s ease;
            position: relative;
            font-size: 0.9rem;
            color: #2c2e3f;
        }

        .pratanah-check-text::before {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(to right, #da8cff, #9a55ff);
            transition: width 0.3s ease;
        }

        .pratanah-checkbox-input:checked+.pratanah-checkbox-label .pratanah-check-text::before {
            width: 100%;
        }

        @keyframes pratanahCheckPulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.2);
            }

            100% {
                transform: scale(1.1);
            }
        }

        /* Modern File Upload - Sama persis dengan template */
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

        .pratanah-file-upload-modern .pratanah-file-label-modern {
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
            .pratanah-file-upload-modern .pratanah-file-label-modern {
                flex-direction: row;
                text-align: left;
                gap: 8px;
                padding: 0.75rem 1rem;
                min-height: auto;
            }
        }

        .pratanah-file-upload-modern:hover .pratanah-file-label-modern {
            border-color: #9a55ff;
            background: linear-gradient(135deg, #f1f0ff, #f8f9fa);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(154, 85, 255, 0.1);
        }

        .pratanah-file-upload-modern .pratanah-file-label-modern i {
            font-size: 1.6rem;
            color: #9a55ff;
            background: rgba(154, 85, 255, 0.1);
            padding: 8px;
            border-radius: 50%;
        }

        .pratanah-file-upload-modern .pratanah-file-info-modern {
            flex: 1;
            width: 100%;
        }

        .pratanah-file-upload-modern .pratanah-file-info-modern span {
            display: block;
            font-weight: 600;
            color: #2c2e3f;
            font-size: 0.8rem;
            word-break: break-word;
        }

        .pratanah-file-upload-modern .pratanah-file-info-modern small {
            color: #6c7383;
            font-size: 0.65rem;
            display: block;
            margin-top: 2px;
        }

        .pratanah-file-upload-modern .pratanah-file-label-modern .pratanah-file-size {
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
            .pratanah-file-upload-modern .pratanah-file-label-modern .pratanah-file-size {
                margin-top: 0;
            }
        }

        /* Badge Status */
        .pratanah-badge {
            padding: 0.35rem 0.6rem;
            font-size: 0.7rem;
            font-weight: 600;
            border-radius: 30px;
            display: inline-block;
        }

        .pratanah-badge-success {
            background: linear-gradient(135deg, #28a745, #5cb85c);
            color: #ffffff;
        }

        .pratanah-badge-warning {
            background: linear-gradient(135deg, #ffc107, #ffdb6d);
            color: #2c2e3f;
        }

        .pratanah-badge-danger {
            background: linear-gradient(135deg, #dc3545, #e4606d);
            color: #ffffff;
        }

        /* Timeline Negosiasi */
        .pratanah-timeline {
            position: relative;
            padding-left: 2rem;
        }

        .pratanah-timeline::before {
            content: '';
            position: absolute;
            left: 7px;
            top: 0;
            height: 100%;
            width: 2px;
            background: linear-gradient(to bottom, #9a55ff, #da8cff);
            opacity: 0.3;
        }

        .pratanah-timeline-item {
            position: relative;
            padding-bottom: 1.5rem;
        }

        .pratanah-timeline-item::before {
            content: '';
            position: absolute;
            left: -1.3rem;
            top: 0.3rem;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #9a55ff;
            border: 2px solid #ffffff;
            box-shadow: 0 0 0 2px rgba(154, 85, 255, 0.3);
        }

        .pratanah-timeline-date {
            font-size: 0.7rem;
            color: #9a55ff;
            font-weight: 600;
        }

        .pratanah-timeline-title {
            font-size: 0.85rem;
            font-weight: 600;
            color: #2c2e3f;
        }

        .pratanah-timeline-desc {
            font-size: 0.8rem;
            color: #6c7383;
        }

        /* Map Container */
        .pratanah-map-container {
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e9ecef;
            height: 350px;
        }

        /* Button Group */
        .pratanah-btn-group {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
        }

        .pratanah-btn-group .btn-right {
            display: flex;
            gap: 0.5rem;
            margin-left: auto;
        }

        @media (max-width: 576px) {
            .pratanah-btn-group {
                flex-direction: column;
            }

            .pratanah-btn-group .pratanah-btn {
                width: 100%;
            }

            .pratanah-btn-group .btn-right {
                margin-left: 0;
                width: 100%;
                flex-direction: column;
            }
        }

        input,
        select,
        textarea,
        button {
            font-size: 16px !important;
        }

        #map {
            height: 100%;
            width: 100%;
            z-index: 1;
        }
    </style>

    <div class="container-fluid px-2 px-md-3 px-lg-4">
        <div class="row">
            <div class="col-12">
                <div class="pratanah-card">
                    <div class="pratanah-card-body p-3 p-md-4">

                        {{-- HEADER --}}
                        <h4 class="pratanah-section-title">
                            <i class="fas fa-hand-holding-usd me-2"></i>
                            Form Pra Tanah / Pra Pelepasan
                        </h4>

                        {{-- ALERT INFO --}}
                        <div class="pratanah-alert pratanah-alert-info d-flex align-items-center flex-wrap mb-3">
                            <i class="fas fa-info-circle me-2"></i>
                            <span>Data tanah yang masih dalam tahap penawaran/negosiasi sebelum pembelian resmi</span>
                        </div>

                        {{-- STATUS TANAH --}}
                        <div class="pratanah-alert pratanah-alert-warning d-flex align-items-center flex-wrap mb-4">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <span>Status: <strong>Pra Pelepasan</strong> - Belum dilakukan pembelian, masih dalam proses
                                penawaran</span>
                        </div>

                        <form action="{{ route('pra-landbanks.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- ================= SECTION 1: INFORMASI SUMBER ================= --}}
                            <h5 class="pratanah-section-title">
                                <i class="fas fa-user-tie me-2"></i>
                                1. Informasi Sumber Penawaran
                                <span class="badge bg-light text-dark ms-2">Dari Makelar/Broker</span>
                            </h5>

                            <div class="pratanah-row">
                                <div class="pratanah-col-md-6">
                                    <div class="pratanah-form-group">
                                        <label class="pratanah-form-label">Nama Makelar/Broker <span class="pratanah-text-danger">*</span></label>
                                        <input type="text" name="land_source" class="pratanah-form-control" placeholder="Nama Makelar/Broker">
                                    </div>
                                </div>
                                <div class="pratanah-col-md-6">
                                    <div class="pratanah-form-group">
                                        <label class="pratanah-form-label">Perusahaan Makelar/Broker</label>
                                        <input type="text" name="broker_company" class="pratanah-form-control" placeholder="Perusahaan Makelar">
                                    </div>
                                </div>
                                <div class="pratanah-col-md-6">
                                    <div class="pratanah-form-group">
                                        <label class="pratanah-form-label">No. Telepon/WhatsApp</label>
                                        <input type="text" name="owner_contact" class="pratanah-form-control" placeholder="No WhatsApp">
                                    </div>
                                </div>
                                <div class="pratanah-col-md-6">
                                    <div class="pratanah-form-group">
                                        <label class="pratanah-form-label">Tanggal Penawaran</label>
                                        <input type="date" name="offer_date" class="pratanah-form-control">
                                    </div>
                                </div>
                            </div>

                            <hr class="pratanah-hr">

                            {{-- ================= SECTION 2: INFORMASI TANAH ================= --}}
                            <h5 class="pratanah-section-title">
                                <i class="fas fa-map-marked-alt me-2"></i>
                                2. Informasi Tanah
                            </h5>

                            <div class="pratanah-row">
                                <div class="pratanah-col-md-6">
                                    <div class="pratanah-form-group">
                                        <label class="pratanah-form-label">Nama Tanah/Lokasi <span class="pratanah-text-danger">*</span></label>
                                        <input type="text" name="land_name" class="pratanah-form-control" placeholder="Contoh: Tanah Kavling Jember">
                                    </div>
                                </div>
                                <div class="pratanah-col-md-6">
                                    <div class="pratanah-form-group">
                                        <label class="pratanah-form-label">Nama Pemilik Tanah</label>
                                        <input type="text" name="land_owner" class="pratanah-form-control" placeholder="Nama Pemilik">
                                    </div>
                                </div>
                            </div>

                            <div class="pratanah-form-group">
                                <label class="pratanah-form-label">Alamat/Lokasi Tanah <span class="pratanah-text-danger">*</span></label>
                                <input type="text" name="address" class="pratanah-form-control" placeholder="Alamat lengkap tanah">
                            </div>

                            <div class="pratanah-row">
                                <div class="pratanah-col-sm-6 pratanah-col-md-3">
                                    <div class="pratanah-form-group">
                                        <label class="pratanah-form-label">Kelurahan/Desa</label>
                                        <input type="text" name="village" class="pratanah-form-control" placeholder="Kelurahan">
                                    </div>
                                </div>
                                <div class="pratanah-col-sm-6 pratanah-col-md-3">
                                    <div class="pratanah-form-group">
                                        <label class="pratanah-form-label">Kecamatan</label>
                                        <input type="text" name="district" class="pratanah-form-control" placeholder="Kecamatan">
                                    </div>
                                </div>
                                <div class="pratanah-col-sm-6 pratanah-col-md-3">
                                    <div class="pratanah-form-group">
                                        <label class="pratanah-form-label">Kota/Kabupaten</label>
                                        <input type="text" name="city" value="Jember" class="pratanah-form-control">
                                    </div>
                                </div>
                                <div class="pratanah-col-sm-6 pratanah-col-md-3">
                                    <div class="pratanah-form-group">
                                        <label class="pratanah-form-label">Provinsi</label>
                                        <input type="text" name="province" value="Jawa Timur" class="pratanah-form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="pratanah-row">
                                <div class="pratanah-col-sm-6 pratanah-col-md-4">
                                    <div class="pratanah-form-group">
                                        <label class="pratanah-form-label">Luas Tanah (m²) <span class="pratanah-text-danger">*</span></label>
                                        <input type="number" name="area" class="pratanah-form-control" placeholder="Contoh: 1000">
                                    </div>
                                </div>
                                <div class="pratanah-col-sm-6 pratanah-col-md-4">
                                    <div class="pratanah-form-group">
                                        <label class="pratanah-form-label">Lebar Jalan (m)</label>
                                        <input type="number" name="road_width" class="pratanah-form-control" placeholder="Contoh: 6">
                                    </div>
                                </div>
                                <div class="pratanah-col-sm-6 pratanah-col-md-4">
                                    <div class="pratanah-form-group">
                                        <label class="pratanah-form-label">Jenis Jalan</label>
                                        <select name="road_type" class="pratanah-form-control">
                                            <option value="">Pilih Jenis Jalan</option>
                                            <option value="aspal">Aspal</option>
                                            <option value="beton">Beton</option>
                                            <option value="paving">Paving</option>
                                            <option value="tanah">Tanah</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <hr class="pratanah-hr">

                            {{-- ================= SECTION 3: NEGOSIASI HARGA ================= --}}
                            <h5 class="pratanah-section-title">
                                <i class="fas fa-handshake me-2"></i>
                                3. Negosiasi Harga
                            </h5>

                            <div class="pratanah-row">
                                <div class="pratanah-col-md-4">
                                    <div class="pratanah-form-group">
                                        <label class="pratanah-form-label">Harga Penawaran Awal (Rp)</label>
                                        <div class="pratanah-input-group">
                                            <div class="pratanah-input-group-prepend">
                                                <span class="pratanah-input-group-text">Rp</span>
                                            </div>
                                            <input type="text" name="offer_price" class="pratanah-form-control" placeholder="0">
                                        </div>
                                    </div>
                                </div>
                                <div class="pratanah-col-md-4">
                                    <div class="pratanah-form-group">
                                        <label class="pratanah-form-label">Harga Negosiasi Terakhir (Rp)</label>
                                        <div class="pratanah-input-group">
                                            <div class="pratanah-input-group-prepend">
                                                <span class="pratanah-input-group-text">Rp</span>
                                            </div>
                                            <input type="text" name="estimated_price" class="pratanah-form-control" placeholder="0">
                                        </div>
                                    </div>
                                </div>
                                <div class="pratanah-col-md-4">
                                    <div class="pratanah-form-group">
                                        <label class="pratanah-form-label">Status Negosiasi</label>
                                        <select name="negotiation_status" class="pratanah-form-control">
                                            <option value="negotiation">Masih Negosiasi</option>
                                            <option value="almost_deal">Hampir Deal</option>
                                            <option value="deal">Sudah Deal</option>
                                            <option value="cancel">Batal</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <hr class="pratanah-hr">

                            {{-- ================= SECTION 4: SURVEY LAPANGAN ================= --}}
                            <h5 class="pratanah-section-title">
                                <i class="fas fa-search-location me-2"></i>
                                4. Survey Lapangan
                            </h5>

                            <div class="pratanah-row">
                                <div class="pratanah-col-md-4">
                                    <div class="pratanah-form-group">
                                        <label class="pratanah-form-label">Tanggal Survey</label>
                                        <input type="date" name="survey_date" class="pratanah-form-control">
                                    </div>
                                </div>
                                <div class="pratanah-col-md-4">
                                    <div class="pratanah-form-group">
                                        <label class="pratanah-form-label">Petugas Survey</label>
                                        <input type="text" name="survey_by" class="pratanah-form-control" placeholder="Nama Petugas">
                                    </div>
                                </div>
                                <div class="pratanah-col-md-4">
                                    <div class="pratanah-form-group">
                                        <label class="pratanah-form-label">Hasil Survey</label>
                                        <select name="survey_result" class="pratanah-form-control">
                                            <option value="belum">Belum Survey</option>
                                            <option value="sesuai">Sesuai</option>
                                            <option value="tidak_sesuai">Tidak Sesuai</option>
                                            <option value="survey_ulang">Perlu Survey Ulang</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="pratanah-form-group">
                                <label class="pratanah-form-label">Catatan Survey</label>
                                <textarea name="notes" class="pratanah-form-control" rows="3" placeholder="Catatan hasil survey..."></textarea>
                            </div>

                            <hr class="pratanah-hr">

                            {{-- ================= SECTION 5: STATUS KELAYAKAN ================= --}}
                            <h5 class="pratanah-section-title">
                                <i class="fas fa-clipboard-check me-2"></i>
                                5. Status Kelayakan & Kejelasan Tanah
                            </h5>

                            <div class="pratanah-row">
                                <div class="pratanah-col-md-6">
                                    <div class="pratanah-form-group">
                                        <label class="pratanah-form-label">Status Kejelasan Tanah <span class="pratanah-text-danger">*</span></label>
                                        <select name="land_status" class="pratanah-form-control">
                                            <option value="clear">Clear & Clean (Bebas Sengketa)</option>
                                            <option value="checking">Dalam Pengecekan</option>
                                            <option value="problem">Bermasalah</option>
                                        </select>
                                        <small class="pratanah-text-muted">Apakah tanah clear/tidak dari sengketa</small>
                                    </div>
                                </div>
                                <div class="pratanah-col-md-6">
                                    <div class="pratanah-form-group">
                                        <label class="pratanah-form-label">Keterangan Masalah (jika ada)</label>
                                        <input type="text" name="land_issue" class="pratanah-form-control" placeholder="Jelaskan masalah jika ada">
                                    </div>
                                </div>
                            </div>

                            <hr class="pratanah-hr">

                            {{-- ================= SECTION 6: PERIZINAN & FASILITAS ================= --}}
                            <h5 class="pratanah-section-title">
                                <i class="fas fa-file-signature me-2"></i>
                                6. Perizinan & Fasilitas
                            </h5>

                            {{-- Fasilitas Sekitar dengan Modern Checkbox --}}
                            <div class="mt-3">
                                <label class="pratanah-form-label d-block text-start">Fasilitas Sekitar</label>

                                <div class="pratanah-checkbox-group">
                                    <div class="pratanah-checkbox-wrapper">
                                        <input type="checkbox" class="pratanah-checkbox-input" name="facility_school" id="facility_school" value="1">
                                        <label class="pratanah-checkbox-label" for="facility_school">
                                            <i class="fas fa-check-circle pratanah-check-icon"></i>
                                            <span class="pratanah-check-text">Sekolah</span>
                                        </label>
                                    </div>

                                    <div class="pratanah-checkbox-wrapper">
                                        <input type="checkbox" class="pratanah-checkbox-input" name="facility_hospital" id="facility_hospital" value="1">
                                        <label class="pratanah-checkbox-label" for="facility_hospital">
                                            <i class="fas fa-check-circle pratanah-check-icon"></i>
                                            <span class="pratanah-check-text">Rumah Sakit</span>
                                        </label>
                                    </div>

                                    <div class="pratanah-checkbox-wrapper">
                                        <input type="checkbox" class="pratanah-checkbox-input" name="facility_market" id="facility_market" value="1">
                                        <label class="pratanah-checkbox-label" for="facility_market">
                                            <i class="fas fa-check-circle pratanah-check-icon"></i>
                                            <span class="pratanah-check-text">Pasar</span>
                                        </label>
                                    </div>

                                    <div class="pratanah-checkbox-wrapper">
                                        <input type="checkbox" class="pratanah-checkbox-input" name="facility_transport" id="facility_transport" value="1">
                                        <label class="pratanah-checkbox-label" for="facility_transport">
                                            <i class="fas fa-check-circle pratanah-check-icon"></i>
                                            <span class="pratanah-check-text">Transportasi Umum</span>
                                        </label>
                                    </div>

                                    <div class="pratanah-checkbox-wrapper">
                                        <input type="checkbox" class="pratanah-checkbox-input" name="facility_mall" id="facility_mall" value="1">
                                        <label class="pratanah-checkbox-label" for="facility_mall">
                                            <i class="fas fa-check-circle pratanah-check-icon"></i>
                                            <span class="pratanah-check-text">Mall</span>
                                        </label>
                                    </div>

                                    <div class="pratanah-checkbox-wrapper">
                                        <input type="checkbox" class="pratanah-checkbox-input" name="facility_bank" id="facility_bank" value="1">
                                        <label class="pratanah-checkbox-label" for="facility_bank">
                                            <i class="fas fa-check-circle pratanah-check-icon"></i>
                                            <span class="pratanah-check-text">Bank/ATM</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="pratanah-row mt-3">
                                <div class="pratanah-col-md-4">
                                    <div class="pratanah-form-group">
                                        <label class="pratanah-form-label">Zonasi/Peruntukan</label>
                                        <input type="text" name="zoning" class="pratanah-form-control" placeholder="Contoh: Perumahan, Komersial">
                                    </div>
                                </div>
                            </div>

                            {{-- Upload Dokumen dengan Modern File Upload --}}
                            <div class="mt-3">
                                <label class="pratanah-form-label d-block text-start">Upload Dokumen Pendukung</label>

                                <div class="pratanah-row">
                                    <div class="pratanah-col-md-4">
                                        <div class="pratanah-form-group">
                                            <label class="pratanah-form-label">Upload Sertifikat</label>
                                            <div class="pratanah-file-upload-modern">
                                                <input type="file" name="file_certificate" accept=".pdf,.jpg,.jpeg,.png">
                                                <div class="pratanah-file-label-modern">
                                                    <i class="fas fa-cloud-upload-alt"></i>
                                                    <div class="pratanah-file-info-modern">
                                                        <span>Upload Sertifikat</span>
                                                        <small>PDF, JPG, PNG (Max: 2MB)</small>
                                                    </div>
                                                    <span class="pratanah-file-size"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pratanah-col-md-4">
                                        <div class="pratanah-form-group">
                                            <label class="pratanah-form-label">Upload Foto Lokasi</label>
                                            <div class="pratanah-file-upload-modern">
                                                <input type="file" name="photo[]" multiple accept=".jpg,.jpeg,.png">
                                                <div class="pratanah-file-label-modern">
                                                    <i class="fas fa-cloud-upload-alt"></i>
                                                    <div class="pratanah-file-info-modern">
                                                        <span>Upload Foto</span>
                                                        <small>JPG, PNG (Max: 2MB per file)</small>
                                                    </div>
                                                    <span class="pratanah-file-size"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="pratanah-hr">

                            {{-- ================= SECTION 7: KOORDINAT ================= --}}
                            <h5 class="pratanah-section-title">
                                <i class="fas fa-map-marker-alt me-2"></i>
                                7. Koordinat Lokasi (Jember)
                            </h5>

                            <div class="pratanah-row">
                                <div class="pratanah-col-md-6">
                                    <div class="pratanah-form-group">
                                        <label class="pratanah-form-label">Latitude</label>
                                        <input type="text" name="lat" id="latitude" class="pratanah-form-control" value="-8.1727" readonly>
                                    </div>
                                </div>
                                <div class="pratanah-col-md-6">
                                    <div class="pratanah-form-group">
                                        <label class="pratanah-form-label">Longitude</label>
                                        <input type="text" name="lng" id="longitude" class="pratanah-form-control" value="113.7000" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3 pratanah-map-container">
                                <div id="map" style="height: 350px;"></div>
                            </div>

                            <div class="mt-2 text-end">
                                <button type="button" id="btnLokasiSaya" class="pratanah-btn pratanah-btn-outline-primary pratanah-btn-sm">
                                    <i class="fas fa-location-dot me-1"></i>Gunakan Lokasi Saya
                                </button>
                                <button type="button" id="btnCariJember" class="pratanah-btn pratanah-btn-outline-primary pratanah-btn-sm">
                                    <i class="fas fa-map-pin me-1"></i>Pusatkan ke Jember
                                </button>
                            </div>

                            <hr class="pratanah-hr">

                            {{-- ================= SECTION 8: STATUS & PRIORITAS ================= --}}
                            <h5 class="pratanah-section-title">
                                <i class="fas fa-tags me-2"></i>
                                8. Status & Prioritas
                            </h5>

                            <div class="pratanah-row">
                                <div class="pratanah-col-md-6">
                                    <div class="pratanah-form-group">
                                        <label class="pratanah-form-label">Status</label>
                                        <select name="status" class="pratanah-form-control">
                                            <option value="draft">Draft</option>
                                            <option value="review">Review</option>
                                            <option value="approved">Approved</option>
                                            <option value="rejected">Rejected</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="pratanah-col-md-6">
                                    <div class="pratanah-form-group">
                                        <label class="pratanah-form-label">Prioritas</label>
                                        <select name="priority" class="pratanah-form-control">
                                            <option value="normal">Normal</option>
                                            <option value="high">Tinggi</option>
                                            <option value="urgent">Urgent</option>
                                            <option value="low">Rendah</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="pratanah-form-group">
                                <label class="pratanah-form-label">Catatan & Kesimpulan</label>
                                <textarea name="notes" class="pratanah-form-control" rows="3" placeholder="Catatan kesimpulan..."></textarea>
                            </div>

                            <hr class="pratanah-hr">

                            {{-- ================= BUTTON ================= --}}
                            <div class="pratanah-btn-group mt-4">
                                <a href="" class="pratanah-btn pratanah-btn-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali
                                </a>
                                <div class="btn-right">
                                    <button type="submit" class="pratanah-btn pratanah-btn-primary">
                                        <i class="fas fa-check-circle me-2"></i>Simpan Data Pra Tanah
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    {{-- Leaflet CSS & JS --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Format rupiah untuk input harga
            document.querySelectorAll('input[placeholder*="000"], input[name="offer_price"], input[name="estimated_price"]').forEach(input => {
                input.addEventListener('input', function(e) {
                    let value = this.value.replace(/\D/g, '');
                    if (value) {
                        value = parseInt(value).toLocaleString('id-ID');
                        this.value = value;
                    }
                });
            });

            // ================= MAP LEAFLET =================
            // Koordinat Jember: -8.1727, 113.7000
            const defaultLat = -8.1727;
            const defaultLng = 113.7000;

            // Ambil input latitude dan longitude
            const latInput = document.getElementById('latitude');
            const lngInput = document.getElementById('longitude');

            // Ambil nilai dari input atau gunakan default
            let lat = latInput.value ? parseFloat(latInput.value) : defaultLat;
            let lng = lngInput.value ? parseFloat(lngInput.value) : defaultLng;

            // Inisialisasi map
            const map = L.map('map').setView([lat, lng], 13);

            // Tambahkan tile layer (OpenStreetMap)
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 19
            }).addTo(map);

            // Tambahkan marker yang bisa di-drag
            const marker = L.marker([lat, lng], {
                draggable: true,
                autoPan: true
            }).addTo(map);

            // Event ketika marker selesai di-drag
            marker.on('dragend', function(e) {
                const position = marker.getLatLng();
                latInput.value = position.lat.toFixed(6);
                lngInput.value = position.lng.toFixed(6);
            });

            // Event ketika map di-click
            map.on('click', function(e) {
                const { lat, lng } = e.latlng;
                marker.setLatLng([lat, lng]);
                latInput.value = lat.toFixed(6);
                lngInput.value = lng.toFixed(6);
            });

            // Update marker ketika input berubah
            function updateMarkerFromInput() {
                const newLat = parseFloat(latInput.value);
                const newLng = parseFloat(lngInput.value);

                if (!isNaN(newLat) && !isNaN(newLng)) {
                    marker.setLatLng([newLat, newLng]);
                    map.setView([newLat, newLng], map.getZoom());
                }
            }

            latInput.addEventListener('change', updateMarkerFromInput);
            lngInput.addEventListener('change', updateMarkerFromInput);

            // Tombol Gunakan Lokasi Saya
            document.getElementById('btnLokasiSaya').addEventListener('click', function() {
                if (!navigator.geolocation) {
                    alert('Browser Anda tidak mendukung geolocation.');
                    return;
                }

                const btn = this;
                const originalText = btn.innerHTML;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Mendeteksi...';
                btn.disabled = true;

                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        const userLat = position.coords.latitude;
                        const userLng = position.coords.longitude;

                        marker.setLatLng([userLat, userLng]);
                        map.setView([userLat, userLng], 17);

                        latInput.value = userLat.toFixed(6);
                        lngInput.value = userLng.toFixed(6);

                        btn.innerHTML = originalText;
                        btn.disabled = false;
                    },
                    function(error) {
                        let errorMessage = 'Gagal mendapatkan lokasi. ';
                        switch (error.code) {
                            case error.PERMISSION_DENIED:
                                errorMessage += 'Izin lokasi ditolak.';
                                break;
                            case error.POSITION_UNAVAILABLE:
                                errorMessage += 'Informasi lokasi tidak tersedia.';
                                break;
                            case error.TIMEOUT:
                                errorMessage += 'Waktu permintaan lokasi habis.';
                                break;
                            default:
                                errorMessage += 'Terjadi kesalahan.';
                        }
                        alert(errorMessage);
                        btn.innerHTML = originalText;
                        btn.disabled = false;
                    }, {
                        enableHighAccuracy: true,
                        timeout: 10000,
                        maximumAge: 0
                    }
                );
            });

            // Tombol Pusatkan ke Jember
            document.getElementById('btnCariJember').addEventListener('click', function() {
                marker.setLatLng([defaultLat, defaultLng]);
                map.setView([defaultLat, defaultLng], 13);
                latInput.value = defaultLat;
                lngInput.value = defaultLng;
            });

            // Tambahkan kontrol skala
            L.control.scale({
                imperial: false,
                metric: true
            }).addTo(map);

            // File upload preview untuk modern file upload
            document.querySelectorAll('.pratanah-file-upload-modern input[type="file"]').forEach(input => {
                input.addEventListener('change', function(e) {
                    const fileName = e.target.files[0]?.name;
                    const fileSize = e.target.files[0]?.size;
                    const label = this.closest('.pratanah-file-upload-modern').querySelector(
                        '.pratanah-file-info-modern span');
                    const sizeSpan = this.closest('.pratanah-file-upload-modern').querySelector(
                        '.pratanah-file-size');

                    if (fileName) {
                        label.textContent = fileName.length > 30 ? fileName.substring(0, 30) + '...' : fileName;
                        if (fileSize) {
                            const sizeInMB = (fileSize / (1024 * 1024)).toFixed(2);
                            sizeSpan.textContent = sizeInMB + ' MB';
                        }
                    } else {
                        // Reset ke teks awal
                        const parentDiv = this.closest('.pratanah-file-upload-modern');
                        const defaultText = parentDiv.querySelector('.pratanah-file-info-modern span');
                        if (defaultText) {
                            defaultText.textContent = 'Upload File';
                        }
                        if (sizeSpan) sizeSpan.textContent = '';
                    }
                });
            });
        });
    </script>
@endpush
