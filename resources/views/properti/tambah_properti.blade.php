@extends('layouts.partial.app')

@section('title', 'Tambah Pasca Land Bank - Property Management App')

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

        .select2-limited-items .select2-results__options {
            max-height: 200px !important;
            overflow-y: auto !important;
        }

        .select2-limited-items .select2-results__options::-webkit-scrollbar {
            width: 6px;
        }

        .select2-limited-items .select2-results__options::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .select2-limited-items .select2-results__options::-webkit-scrollbar-thumb {
            background: #c7a4ff;
            border-radius: 10px;
        }

        .select2-limited-items .select2-results__options::-webkit-scrollbar-thumb:hover {
            background: #9a55ff;
        }

        /* Layout Grid */
        .properti-row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -0.4rem;
            margin-left: -0.4rem;
        }

        @media (min-width: 768px) {
            .properti-row {
                margin-right: -0.5rem;
                margin-left: -0.5rem;
            }
        }

        .properti-row>[class*="properti-col-"] {
            padding-right: 0.4rem;
            padding-left: 0.4rem;
            width: 100%;
        }

        @media (min-width: 768px) {
            .properti-row>[class*="properti-col-"] {
                padding-right: 0.5rem;
                padding-left: 0.5rem;
            }
        }

        .properti-col-12 { flex: 0 0 100%; max-width: 100%; }

        @media (min-width: 576px) {
            .properti-col-sm-6 { flex: 0 0 50%; max-width: 50%; }
        }

        @media (min-width: 768px) {
            .properti-col-md-3 { flex: 0 0 25%; max-width: 25%; }
            .properti-col-md-4 { flex: 0 0 33.333333%; max-width: 33.333333%; }
            .properti-col-md-6 { flex: 0 0 50%; max-width: 50%; }
            .properti-col-md-12 { flex: 0 0 100%; max-width: 100%; }
        }

        /* Input Group */
        .properti-input-group {
            display: flex;
            align-items: stretch;
            width: 100%;
        }

        .properti-input-group-prepend {
            display: flex;
        }

        .properti-input-group-text {
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
            color: #9a55ff;
            font-weight: 600;
            padding: 0.7rem 0.8rem;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
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
            color: #ffffff;
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

        /* Checkbox Modern Styling */
        .properti-checkbox-group {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .properti-checkbox-wrapper {
            position: relative;
        }

        .properti-checkbox-input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        .properti-checkbox-label {
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
            font-family: 'Nunito', sans-serif;
            margin-bottom: 0 !important;
        }

        .properti-checkbox-label:hover {
            border-color: #9a55ff;
            background: rgba(154, 85, 255, 0.02);
        }

        .properti-checkbox-input:checked+.properti-checkbox-label {
            border-color: #9a55ff;
            background: rgba(154, 85, 255, 0.08);
            box-shadow: 0 2px 8px rgba(154, 85, 255, 0.15);
        }

        .properti-check-icon {
            color: #d0d4db;
            font-size: 1rem;
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

        .properti-file-upload-modern .properti-file-info-modern {
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .properti-file-upload-modern .properti-file-label-modern .file-title-text {
            font-size: 0.85rem;
            font-weight: 600;
            color: #2c2e3f;
        }

        .properti-file-upload-modern .properti-file-label-modern .file-sub-text {
            font-size: 0.72rem;
            color: #6c757d;
        }

        .properti-file-upload-modern .properti-file-label-modern .properti-file-size {
            font-size: 0.75rem;
            font-weight: 600;
            color: #9a55ff;
            margin-top: 4px;
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

        /* Custom Map Container */
        .properti-map-container {
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e9ecef;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
    </style>

    <div class="container-fluid px-2 px-md-3 px-lg-4">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="properti-card shadow-sm">
                    <div class="properti-card-body p-3 p-md-4 p-lg-5">

                        <h4 class="properti-section-title">
                            <i class="fas fa-plus-circle me-2"></i>
                            Tambah Data Tanah / Properti
                        </h4>

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

                        <form action="{{ route('properti.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- ALERT INFO --}}
                            <div class="properti-alert properti-alert-info d-flex align-items-center flex-wrap" role="alert">
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
                                        <label class="properti-form-label">Nama Tanah/Proyek <span class="properti-text-danger">*</span></label>
                                        <input type="text" name="namaTanah"
                                            class="properti-form-control @error('namaTanah') is-invalid @enderror"
                                            value="{{ old('namaTanah') }}" placeholder="Contoh: Green Harmony Residence Tahap 2" required>
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

                                        {{-- SELECT DENGAN SEARCH (SELECT2) --}}
                                        <select name="company_profile_id" id="companySelect"
                                            class="properti-form-control @error('company_profile_id') is-invalid @enderror" required>
                                            <option value="">-- Pilih Perusahaan --</option>
                                            @foreach ($companies as $company)
                                                <option value="{{ $company->id }}" {{ old('company_profile_id') == $company->id ? 'selected' : '' }}>
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
                                        <label class="properti-form-label">Status Kepemilikan <span class="properti-text-danger">*</span></label>
                                        <select name="statusKepemilikan"
                                            class="properti-form-control @error('statusKepemilikan') is-invalid @enderror" required>
                                            <option value="">-- Pilih Status --</option>
                                            <option value="SHM" {{ old('statusKepemilikan') == 'SHM' ? 'selected' : '' }}>SHM (Sertifikat Hak Milik)</option>
                                            <option value="HGB" {{ old('statusKepemilikan') == 'HGB' ? 'selected' : '' }}>HGB (Hak Guna Bangunan)</option>
                                            <option value="HGU" {{ old('statusKepemilikan') == 'HGU' ? 'selected' : '' }}>HGU (Hak Guna Usaha)</option>
                                            <option value="HP" {{ old('statusKepemilikan') == 'HP' ? 'selected' : '' }}>HP (Hak Pakai)</option>
                                        </select>
                                        @error('statusKepemilikan')
                                            <div class="properti-text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="properti-form-group">
                                <label class="properti-form-label">Alamat Lengkap <span class="properti-text-danger">*</span></label>
                                <input type="text" name="lokasi"
                                    class="properti-form-control @error('lokasi') is-invalid @enderror"
                                    value="{{ old('lokasi') }}" placeholder="Contoh: Jl. Raya Kaliurang Km 9.5" required>
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
                                        <label class="properti-form-label">Luas Tanah (m²) <span class="properti-text-danger">*</span></label>
                                        <input type="number" name="luasTanah"
                                            class="properti-form-control @error('luasTanah') is-invalid @enderror"
                                            value="{{ old('luasTanah') }}" min="0" step="0.01" placeholder="Contoh: 15000" required>
                                        @error('luasTanah')
                                            <div class="properti-text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="properti-col-sm-6 properti-col-md-3">
                                    <div class="properti-form-group">
                                        <label class="properti-form-label">Harga Perolehan <span class="properti-text-danger">*</span></label>
                                        <div class="properti-input-group">
                                            <div class="properti-input-group-prepend">
                                                <span class="properti-input-group-text">Rp</span>
                                            </div>
                                            <input type="text" name="hargaPerolehan"
                                                class="properti-form-control @error('hargaPerolehan') is-invalid @enderror"
                                                value="{{ old('hargaPerolehan') }}" placeholder="1.500.000.000" required>
                                        </div>
                                        @error('hargaPerolehan')
                                            <div class="properti-text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="properti-col-sm-6 properti-col-md-3">
                                    <div class="properti-form-group">
                                        <label class="properti-form-label">Tanggal Perolehan <span class="properti-text-danger">*</span></label>
                                        <input type="date" name="tanggalPerolehan"
                                            class="properti-form-control @error('tanggalPerolehan') is-invalid @enderror"
                                            value="{{ old('tanggalPerolehan', date('Y-m-d')) }}" required>
                                        @error('tanggalPerolehan')
                                            <div class="properti-text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="properti-col-sm-6 properti-col-md-3">
                                    <div class="properti-form-group">
                                        <label class="properti-form-label">Kode Pos</label>
                                        <input type="text" name="kodePos" class="properti-form-control"
                                            value="{{ old('kodePos') }}" placeholder="55581">
                                    </div>
                                </div>
                            </div>

                            <div class="properti-row">
                                <div class="properti-col-md-4">
                                    <div class="properti-form-group">
                                        <label class="properti-form-label">Zonasi</label>
                                        <input type="text" name="zonasi"
                                            class="properti-form-control @error('zonasi') is-invalid @enderror"
                                            value="{{ old('zonasi') }}" placeholder="Contoh: Perumahan / Komersial">
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
                                            value="{{ old('lebarJalan') }}" step="0.1" min="0" placeholder="Contoh: 8.5">
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
                                            <option value="Aspal" {{ old('jenisJalan') == 'Aspal' ? 'selected' : '' }}>Aspal</option>
                                            <option value="Cor Beton" {{ old('jenisJalan') == 'Cor Beton' ? 'selected' : '' }}>Cor Beton</option>
                                            <option value="Paving Blok" {{ old('jenisJalan') == 'Paving Blok' ? 'selected' : '' }}>Paving Blok</option>
                                            <option value="Tanah" {{ old('jenisJalan') == 'Tanah' ? 'selected' : '' }}>Tanah</option>
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
                                            id="fasSekolah" value="1" {{ old('fasSekolah') ? 'checked' : '' }}>
                                        <label class="properti-checkbox-label" for="fasSekolah">
                                            <i class="fas fa-check-circle properti-check-icon"></i>
                                            <span class="properti-check-text">Dekat Sekolah</span>
                                        </label>
                                    </div>

                                    <div class="properti-checkbox-wrapper">
                                        <input type="checkbox" class="properti-checkbox-input" name="fasRumahSakit"
                                            id="fasRumahSakit" value="1" {{ old('fasRumahSakit') ? 'checked' : '' }}>
                                        <label class="properti-checkbox-label" for="fasRumahSakit">
                                            <i class="fas fa-check-circle properti-check-icon"></i>
                                            <span class="properti-check-text">Rumah Sakit</span>
                                        </label>
                                    </div>

                                    <div class="properti-checkbox-wrapper">
                                        <input type="checkbox" class="properti-checkbox-input" name="fasMall"
                                            id="fasMall" value="1" {{ old('fasMall') ? 'checked' : '' }}>
                                        <label class="properti-checkbox-label" for="fasMall">
                                            <i class="fas fa-check-circle properti-check-icon"></i>
                                            <span class="properti-check-text">Mall / Swalayan</span>
                                        </label>
                                    </div>

                                    <div class="properti-checkbox-wrapper">
                                        <input type="checkbox" class="properti-checkbox-input" name="fasTransportasi"
                                            id="fasTransportasi" value="1" {{ old('fasTransportasi') ? 'checked' : '' }}>
                                        <label class="properti-checkbox-label" for="fasTransportasi">
                                            <i class="fas fa-check-circle properti-check-icon"></i>
                                            <span class="properti-check-text">Transportasi Umum</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="properti-form-group mt-3">
                                <label class="properti-form-label">Deskripsi</label>
                                <textarea name="deskripsi" class="properti-form-control" rows="3" placeholder="Deskripsi ringkas properti...">{{ old('deskripsi') }}</textarea>
                            </div>

                            <hr class="properti-hr">

                            {{-- ================= DOKUMEN LEGAL NUMBER ================= --}}
                            <h5 class="properti-section-title">
                                <i class="fas fa-file-contract me-2"></i>
                                Dokumen Legal
                            </h5>

                            <div class="properti-row">
                                @foreach ($documentTypes as $type)
                                    <div class="properti-col-md-4">
                                        <div class="properti-form-group">
                                            <label class="properti-form-label">No {{ $type->name }}</label>
                                            <input type="text" name="documents[{{ $type->id }}][number]"
                                                class="properti-form-control" placeholder="Nomor {{ $type->name }}"
                                                value="{{ old('documents.'.$type->id.'.number') }}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <hr class="properti-hr">

                            {{-- ================= BERKAS & DOKUMEN UPLOAD ================= --}}
                            <h5 class="properti-section-title">
                                <i class="fas fa-upload me-2"></i>
                                Berkas & Dokumen Legal
                            </h5>

                            <div class="properti-row">
                                @foreach ($documentTypes as $type)
                                    <div class="properti-col-md-4">
                                        <div class="properti-form-group mb-3">
                                            <label class="properti-form-label d-flex justify-content-between align-items-center mb-1">
                                                <span>Berkas {{ $type->name }}</span>
                                                <span class="badge bg-secondary text-white px-2 py-1" style="font-size: 0.68rem; border-radius: 4px;">
                                                    Belum Upload
                                                </span>
                                            </label>

                                            <div class="properti-file-upload-modern">
                                                <input type="file" name="documents[{{ $type->id }}][file]"
                                                    id="upload_{{ $type->id }}" accept=".pdf,.jpg,.jpeg,.png"
                                                    data-type-name="{{ $type->name }}"
                                                    data-has-existing="0">

                                                <div class="properti-file-label-modern">
                                                    <i class="fas fa-cloud-upload-alt"></i>
                                                    <div class="properti-file-info-modern">
                                                        <span class="file-title-text">
                                                            Upload {{ $type->name }} Baru
                                                        </span>
                                                        <small class="file-sub-text text-muted">
                                                            Format: PDF, JPG, PNG (Max: 2MB)
                                                        </small>
                                                    </div>
                                                    <span class="properti-file-size"></span>
                                                </div>
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

                            <div class="properti-row">
                                <div class="properti-col-md-12">
                                    <div class="properti-form-group mb-3">
                                        <label class="properti-form-label mb-1">Berkas Denah / Siteplan</label>

                                        <div class="properti-file-upload-modern">
                                            <input type="file" name="denah" id="upload_denah" accept=".pdf,.jpg,.jpeg,.png,.webp,.svg"
                                                data-type-name="Denah / Siteplan"
                                                data-has-existing="0">

                                            <div class="properti-file-label-modern">
                                                <i class="fas fa-map"></i>
                                                <div class="properti-file-info-modern">
                                                    <span class="file-title-text">
                                                        Upload Denah / Siteplan Baru
                                                    </span>
                                                    <small class="file-sub-text text-muted">
                                                        Format: JPG, PNG, WEBP, SVG, PDF (Max: 5MB)
                                                    </small>
                                                </div>
                                                <span class="properti-file-size"></span>
                                            </div>
                                        </div>
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
                                        <label class="properti-form-label">Status Legal <span class="properti-text-danger">*</span></label>
                                        <select name="statusLegal"
                                            class="properti-form-control @error('statusLegal') is-invalid @enderror" required>
                                            <option value="pending" {{ old('statusLegal') == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="verified" {{ old('statusLegal') == 'verified' ? 'selected' : '' }}>Lengkap</option>
                                        </select>
                                        @error('statusLegal')
                                            <div class="properti-text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="properti-col-md-4">
                                    <div class="properti-form-group">
                                        <label class="properti-form-label">Status Kavling <span class="properti-text-danger">*</span></label>
                                        <select name="statusKavling"
                                            class="properti-form-control @error('statusKavling') is-invalid @enderror" required>
                                            <option value="Belum" {{ old('statusKavling', 'Belum') == 'Belum' ? 'selected' : '' }}>Belum</option>
                                            <option value="progress" {{ old('statusKavling') == 'progress' ? 'selected' : '' }}>Proses</option>
                                            <option value="Selesai" {{ old('statusKavling') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
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
                                            <option value="Normal" {{ old('prioritas', 'Normal') == 'Normal' ? 'selected' : '' }}>Normal</option>
                                            <option value="Tinggi" {{ old('prioritas') == 'Tinggi' ? 'selected' : '' }}>Tinggi</option>
                                            <option value="Urgent" {{ old('prioritas') == 'Urgent' ? 'selected' : '' }}>Urgent</option>
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
                                                value="{{ old('fee_document_verification') }}"
                                                placeholder="Contoh: 5.000.000">
                                        </div>
                                        @error('fee_document_verification')
                                            <div class="properti-text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <hr class="properti-hr">

                            {{-- ================= MAP KOORDINAT ================= --}}
                            <h5 class="properti-section-title">
                                <i class="fas fa-map-marker-alt me-2"></i>
                                Koordinat
                            </h5>

                            <div class="properti-row">
                                <div class="properti-col-md-6">
                                    <div class="properti-form-group">
                                        <label class="properti-form-label">Latitude</label>
                                        <input type="text" name="latitude" class="properti-form-control"
                                            value="{{ old('latitude', '-8.1727') }}" placeholder="Contoh: -8.1727">
                                    </div>
                                </div>
                                <div class="properti-col-md-6">
                                    <div class="properti-form-group">
                                        <label class="properti-form-label">Longitude</label>
                                        <input type="text" name="longitude" class="properti-form-control"
                                            value="{{ old('longitude', '113.7000') }}" placeholder="Contoh: 113.7000">
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
                                        <i class="fas fa-save me-2"></i>Simpan Data Tanah
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
                        label.textContent = 'Upload ' + typeName + ' Baru';
                        label.className = 'file-title-text';
                        subText.textContent = 'Format: PDF, JPG, PNG (Max: 2MB)';
                        if (icon) {
                            icon.className = 'fas fa-cloud-upload-alt';
                            icon.style.cssText = '';
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
                placeholder: '-- Pilih Perusahaan --',
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

            // Inisialisasi Wilayah
            const initialWilayah = {
                province: "{{ old('provinsi') }}",
                city: "{{ old('kota') }}",
                district: "{{ old('kecamatan') }}",
                village: "{{ old('kelurahan') }}"
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
