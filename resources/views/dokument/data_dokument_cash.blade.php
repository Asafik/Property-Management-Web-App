@extends('layouts.partial.app')

@section('title', 'Pengecekan Dokumen Cash Legal - Property Management App')

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/bank/bank.css') }}">

    <style>
        .modern-file-upload {
            position: relative;
            width: 100%;
        }

        .modern-file-upload input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
            z-index: 2;
        }

        .modern-file-upload .file-label {
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
            .modern-file-upload .file-label {
                flex-direction: row;
                text-align: left;
                gap: 8px;
                padding: 0.75rem 1rem;
                min-height: auto;
            }
        }

        .modern-file-upload:hover .file-label {
            border-color: #9a55ff;
            background: linear-gradient(135deg, #f1f0ff, #f8f9fa);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(154, 85, 255, 0.1);
        }

        .modern-file-upload .file-label i {
            font-size: 1.6rem;
            color: #9a55ff;
            background: rgba(154, 85, 255, 0.1);
            padding: 8px;
            border-radius: 50%;
        }

        .modern-file-upload .file-label .file-info {
            flex: 1;
            width: 100%;
        }

        .modern-file-upload .file-label .file-info span {
            display: block;
            font-weight: 600;
            color: #2c2e3f;
            font-size: 0.8rem;
            word-break: break-word;
        }

        .modern-file-upload .file-label .file-info small {
            color: #6c7383;
            font-size: 0.65rem;
            display: block;
            margin-top: 2px;
        }

        .modern-file-upload .file-label .file-size {
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
            .modern-file-upload .file-label .file-size {
                margin-top: 0;
            }
        }

        .dokumen-card {
            background: white;
            border: 1px solid #e9ecef;
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1rem;
            transition: all 0.2s ease;
        }

        .dokumen-card:hover {
            border-color: #9a55ff;
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.1);
        }

        .dokumen-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .dokumen-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #f9f7ff, #f2ecff);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .dokumen-icon i {
            font-size: 24px;
            color: #9a55ff;
        }

        .dokumen-info { flex: 1; }

        .dokumen-info h6 {
            font-size: 1rem;
            font-weight: 600;
            color: #2c2e3f;
            margin-bottom: 0.25rem;
        }

        .dokumen-info p {
            font-size: 0.8rem;
            color: #6c7383;
            margin-bottom: 0;
        }

        .btn-upload {
            background: linear-gradient(135deg, #9a55ff, #da8cff);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-upload:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.3);
        }

        .btn-upload:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
        }

        .file-preview {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem;
            background: #f8f9fa;
            border-radius: 8px;
            margin-top: 0.5rem;
        }

        .file-preview i { color: #9a55ff; }

        .file-preview span {
            flex: 1;
            font-size: 0.8rem;
            color: #2c2e3f;
        }

        .file-preview .btn-download-file {
            color: #9a55ff;
            cursor: pointer;
            padding: 0.25rem;
        }

        .file-preview .btn-download-file:hover {
            background: rgba(154, 85, 255, 0.1);
            border-radius: 4px;
        }

        .custom-alert {
            padding: 0.75rem 1rem;
            border-radius: 8px;
            font-size: 0.85rem;
            border-left: 4px solid;
            margin-bottom: 1rem;
        }

        .custom-alert-success {
            background: linear-gradient(135deg, #f0fff4, #e6f7e6);
            color: #2c2e3f;
            border-left-color: #28a745;
        }

        .custom-alert-warning {
            background: linear-gradient(135deg, #fff9e6, #fff2d9);
            color: #2c2e3f;
            border-left-color: #ffc107;
        }

        .custom-alert-info {
            background: linear-gradient(135deg, #e6f3ff, #d9ecff);
            color: #2c2e3f;
            border-left-color: #17a2b8;
        }

        .section-title {
            font-size: 0.9rem;
            font-weight: 600;
            color: #9a55ff;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e9ecef;
        }

        .info-row { display: flex; margin-bottom: 0.5rem; }

        .info-label {
            width: 120px;
            font-weight: 600;
            color: #6c757d;
        }

        .info-value {
            flex: 1;
            color: #2c2e3f;
        }

        /* ===== UPLOAD FOTO SECTION ===== */
        .upload-foto-section {
            background: linear-gradient(135deg, #f9f7ff, #f3eeff);
            border: 1px solid #e0d0ff;
            border-radius: 14px;
            padding: 1.25rem;
        }

        .upload-foto-section .section-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1rem;
            padding-bottom: 0.75rem;
            border-bottom: 1.5px dashed #d0b8ff;
        }

        .upload-foto-section .section-header i {
            font-size: 1.4rem;
            color: #9a55ff;
        }

        .upload-foto-section .section-header span {
            font-size: 0.95rem;
            font-weight: 700;
            color: #5c3d9e;
        }

        .foto-upload-item {
            position: relative;
        }

        .foto-upload-item label.foto-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            gap: 6px;
            padding: 1rem 0.5rem;
            background: white;
            border: 2px dashed #c9b3f5;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.25s ease;
            min-height: 110px;
            width: 100%;
        }

        .foto-upload-item label.foto-label:hover {
            border-color: #9a55ff;
            background: #faf7ff;
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(154, 85, 255, 0.12);
        }

        .foto-upload-item input[type="file"] { display: none; }

        .foto-upload-item .foto-icon {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: rgba(154, 85, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .foto-upload-item .foto-icon i {
            font-size: 1.3rem;
            color: #9a55ff;
        }

        .foto-upload-item .foto-name {
            font-size: 0.7rem;
            font-weight: 600;
            color: #4a3070;
            line-height: 1.3;
        }

        .foto-upload-item .foto-hint {
            font-size: 0.6rem;
            color: #9a8ab4;
        }

        .foto-upload-item.has-preview label.foto-label {
            border-color: #28a745;
            border-style: solid;
            background: #f0fff4;
            padding: 0;
            overflow: hidden;
            min-height: 110px;
        }

        .foto-upload-item.has-preview .foto-preview-img {
            width: 100%;
            height: 110px;
            object-fit: cover;
            border-radius: 10px;
            display: block;
        }

        .foto-upload-item.has-preview .foto-preview-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.45);
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 4px;
            opacity: 0;
            transition: opacity 0.2s ease;
            cursor: pointer;
        }

        .foto-upload-item.has-preview:hover .foto-preview-overlay { opacity: 1; }

        .foto-upload-item.has-preview .foto-preview-overlay i {
            font-size: 1.2rem;
            color: white;
        }

        .foto-upload-item.has-preview .foto-preview-overlay span {
            font-size: 0.65rem;
            color: white;
            font-weight: 600;
        }

        .foto-upload-item .foto-badge-ok {
            position: absolute;
            top: 6px;
            right: 6px;
            background: #28a745;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 0.6rem;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 5;
            box-shadow: 0 2px 6px rgba(40,167,69,0.4);
        }

        .btn-upload-semua {
            background: linear-gradient(135deg, #9a55ff, #c78dff);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 0.65rem 1.5rem;
            font-size: 0.85rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.25s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            width: 100%;
            justify-content: center;
            margin-top: 1rem;
        }

        .btn-upload-semua:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(154, 85, 255, 0.35);
        }

        .btn-upload-semua:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .upload-progress-bar {
            height: 6px;
            background: #e9ecef;
            border-radius: 10px;
            overflow: hidden;
            margin-top: 0.5rem;
            display: none;
        }

        .upload-progress-bar .bar-fill {
            height: 100%;
            background: linear-gradient(90deg, #9a55ff, #da8cff);
            border-radius: 10px;
            width: 0%;
            transition: width 0.4s ease;
        }

        .foto-counter {
            font-size: 0.75rem;
            color: #6c7383;
            margin-top: 0.75rem;
        }

        .foto-counter strong { color: #9a55ff; }

        /* Alert lengkap di modal */
        .alert-dokumen-lengkap {
            background: linear-gradient(135deg, #f0fff4, #e6f7e6);
            border: 1px solid #b7ebc8;
            border-left: 4px solid #28a745;
            border-radius: 12px;
            padding: 1rem 1.25rem;
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 1.5rem;
        }

        .alert-dokumen-lengkap i {
            font-size: 1.8rem;
            color: #28a745;
            flex-shrink: 0;
        }

        .alert-dokumen-lengkap .alert-text strong {
            display: block;
            font-size: 0.95rem;
            font-weight: 700;
            color: #1a6b30;
            margin-bottom: 2px;
        }

        .alert-dokumen-lengkap .alert-text span {
            font-size: 0.8rem;
            color: #3a8a50;
        }
    </style>

    <div class="container-fluid p-2 p-sm-3 p-md-4">
        <!-- Header -->
        <div class="row mb-3 mb-sm-3 mb-md-4">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="text-dark mb-1">
                                <i class="mdi mdi-file-document-multiple me-2" style="color: #9a55ff;"></i>
                                Pengecekan Dokumen Cash Legal
                            </h3>
                            <p class="text-muted mb-0">
                                <i class="mdi mdi-information-outline me-1"></i>
                                Cek kelengkapan dokumen legal per booking
                            </p>
                        </div>
                        <div class="d-none d-sm-block">
                            <i class="mdi mdi-file-document" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel -->
        <div class="row mt-2 mt-sm-2 mt-md-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2">
                        <h5 class="card-title mb-0">
                            <i class="mdi mdi-format-list-bulleted me-2 text-primary"></i>
                            Daftar Pengecekan Dokumen
                        </h5>
                    </div>

                    <div class="card-body">
                        <!-- FILTER -->
                        <div class="filter-card mb-4">
                            <div class="card-body">
                                <h6 class="card-title mb-3" style="font-size: 1rem;">
                                    <i class="mdi mdi-filter-outline me-1" style="color: #9a55ff;"></i>
                                    Filter Data
                                </h6>

                                <!-- MOBILE -->
                                <div class="d-block d-md-none">
                                    <form method="GET" action="#">
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">
                                                <i class="mdi mdi-magnify me-1" style="color: #9a55ff;"></i>
                                                Cari Booking / Customer
                                            </label>
                                            <input type="text" class="form-control" name="search"
                                                placeholder="Cari ID booking atau nama..." style="height: 45px;">
                                        </div>
                                        <div class="row g-2 mb-3">
                                            <div class="col-6">
                                                <label class="form-label fw-semibold">
                                                    <i class="mdi mdi-flag me-1" style="color: #9a55ff;"></i>Kelengkapan
                                                </label>
                                                <select class="form-control" name="kelengkapan" style="height: 45px;">
                                                    <option value="">Semua</option>
                                                    <option value="lengkap">Lengkap</option>
                                                    <option value="kurang">Kurang</option>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label fw-semibold">
                                                    <i class="mdi mdi-chart-arc me-1" style="color: #9a55ff;"></i>Status
                                                </label>
                                                <select class="form-control" name="status" style="height: 45px;">
                                                    <option value="">Semua</option>
                                                    <option value="verified">Terverifikasi</option>
                                                    <option value="pending">Pending</option>
                                                    <option value="rejected">Revisi</option>
                                                    <option value="draft">Draft</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row g-2">
                                            <div class="col-6">
                                                <button type="submit"
                                                    class="btn btn-gradient-primary w-100 py-2 d-flex align-items-center justify-content-center">
                                                    <i class="mdi mdi-filter me-1"></i> Filter
                                                </button>
                                            </div>
                                            <div class="col-6">
                                                <a href="#"
                                                    class="btn btn-gradient-secondary w-100 py-2 d-flex align-items-center justify-content-center">
                                                    <i class="mdi mdi-refresh me-1"></i> Reset
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- DESKTOP -->
                                <div class="d-none d-md-block">
                                    <form method="GET" action="#">
                                        <div class="row g-2 align-items-end">
                                            <div class="col-md-3">
                                                <label class="form-label">
                                                    <i class="mdi mdi-magnify me-1" style="color: #9a55ff;"></i>
                                                    Cari Booking / Customer
                                                </label>
                                                <input type="text" class="form-control" name="search"
                                                    placeholder="ID booking atau nama...">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">
                                                    <i class="mdi mdi-flag me-1" style="color: #9a55ff;"></i>Kelengkapan
                                                </label>
                                                <select class="form-control" name="kelengkapan">
                                                    <option value="">Semua</option>
                                                    <option value="lengkap">Lengkap</option>
                                                    <option value="kurang">Kurang</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">
                                                    <i class="mdi mdi-chart-arc me-1" style="color: #9a55ff;"></i>Status
                                                </label>
                                                <select class="form-control" name="status">
                                                    <option value="">Semua</option>
                                                    <option value="verified">Terverifikasi</option>
                                                    <option value="pending">Pending</option>
                                                    <option value="rejected">Revisi</option>
                                                    <option value="draft">Draft</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">
                                                    <i class="mdi mdi-counter me-1" style="color: #9a55ff;"></i>Tampil
                                                </label>
                                                <select class="form-control" name="per_page">
                                                    <option value="10">10</option>
                                                    <option value="15">15</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                </select>
                                            </div>
                                            <div class="col-md-1">
                                                <label class="form-label invisible">Filter</label>
                                                <button type="submit"
                                                    class="btn btn-gradient-primary w-100 d-flex align-items-center justify-content-center">
                                                    <i class="mdi mdi-filter me-1"></i> Filter
                                                </button>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label invisible">Reset</label>
                                                <a href="#"
                                                    class="btn btn-gradient-secondary w-100 d-flex align-items-center justify-content-center">
                                                    <i class="mdi mdi-refresh me-1"></i> Reset
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- STATS -->
                        <div class="row g-3 mb-4">
                            <div class="col-6 col-md-3">
                                <div class="card bg-light border-0">
                                    <div class="card-body p-3">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-3">
                                                <i class="mdi mdi-file-document text-primary" style="font-size: 2rem;"></i>
                                            </div>
                                            <div>
                                                <h5 class="fw-bold mb-0">{{ $totalBooking }}</h5>
                                                <p class="text-muted small mb-0">Total Booking</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="card bg-light border-0">
                                    <div class="card-body p-3">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-3">
                                                <i class="mdi mdi-check-circle text-success" style="font-size: 2rem;"></i>
                                            </div>
                                            <div>
                                                <h5 class="fw-bold mb-0">{{ $lengkap }}</h5>
                                                <p class="text-muted small mb-0">Lengkap</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="card bg-light border-0">
                                    <div class="card-body p-3">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-3">
                                                <i class="mdi mdi-clock-outline text-warning" style="font-size: 2rem;"></i>
                                            </div>
                                            <div>
                                                <h5 class="fw-bold mb-0">{{ $kurang }}</h5>
                                                <p class="text-muted small mb-0">Kurang</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="card bg-light border-0">
                                    <div class="card-body p-3">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-3">
                                                <i class="mdi mdi-alert-circle text-danger" style="font-size: 2rem;"></i>
                                            </div>
                                            <div>
                                                <h5 class="fw-bold mb-0">{{ $revisi }}</h5>
                                                <p class="text-muted small mb-0">Perlu Revisi</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TABEL -->
                        <div class="table-responsive">
                            <table class="table table-hover align-middle" id="tableCekDokumen">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="5%">No</th>
                                        <th width="15%">ID Booking</th>
                                        <th width="20%">Nama Customer</th>
                                        <th width="20%">Unit</th>
                                        <th width="15%">Kelengkapan</th>
                                        <th width="15%">Status</th>
                                        <th class="text-center" width="10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bookings as $booking)
                                        @php
                                            $requiredDocs = $documents->where('required', true)->count();
                                            $uploaded = $booking->documentUploads
                                                ->whereIn('document_id', $documents->where('required', true)->pluck('id'))
                                                ->count();
                                            $isLengkap = $uploaded >= $requiredDocs;
                                        @endphp
                                        <tr>
                                            <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                                            <td>
                                                <span class="badge bg-light text-dark">{{ $booking->booking_code }}</span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-account-circle text-primary me-2"></i>
                                                    {{ $booking->customer->full_name ?? '-' }}
                                                </div>
                                            </td>
                                            <td>
                                                {{ $booking->unit->unit_name ?? '-' }}
                                                Type : {{ $booking->unit->type ?? '-' }}
                                                Jenis : {{ $booking->unit->jenis ?? '-' }}
                                            </td>
                                            <td>
                                                @if ($isLengkap)
                                                    <span class="badge badge-gradient-success">
                                                        <i class="mdi mdi-check-circle me-1"></i>Lengkap
                                                    </span>
                                                @else
                                                    <span class="badge badge-gradient-warning">
                                                        <i class="mdi mdi-clock-outline me-1"></i>{{ $uploaded }}/{{ $requiredDocs }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($isLengkap)
                                                    <span class="badge badge-gradient-success">
                                                        <i class="mdi mdi-check-circle me-1"></i>Siap Pecah Legal Unit
                                                    </span>
                                                @else
                                                    <span class="badge badge-gradient-warning">
                                                        <i class="mdi mdi-clock-outline me-1"></i>Pending
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-1">
                                                    {{-- Tombol detail dengan data-lengkap --}}
                                                    <button class="btn btn-outline-info btn-sm btn-detail-dokumen"
                                                        data-booking="{{ $booking->id }}"
                                                        data-lengkap="{{ $isLengkap ? 'true' : 'false' }}"
                                                        title="Detail Dokumen">
                                                        <i class="mdi mdi-eye"></i>
                                                    </button>

                                                    @if ($isLengkap)
                                                        <a href="{{ route('akad.cash', $booking->id) }}"
                                                            class="btn btn-success btn-sm" title="Proses Akad">
                                                            <i class="mdi mdi-file-sign"></i>
                                                        </a>
                                                    @else
                                                        <button class="btn btn-secondary btn-sm" disabled
                                                            title="Dokumen belum lengkap">
                                                            <i class="mdi mdi-file-sign"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- PAGINATION -->
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                            <div class="pagination-info mb-2 mb-sm-0">
                                <i class="mdi mdi-information-outline me-1 text-primary"></i>
                                Menampilkan 1 - 5 dari 24 data booking
                            </div>
                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0" style="gap: 2px;">
                                    <li class="page-item disabled">
                                        <span class="page-link"><i class="mdi mdi-chevron-left"></i></span>
                                    </li>
                                    <li class="page-item active"><span class="page-link">1</span></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#"><i class="mdi mdi-chevron-right"></i></a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Kembali -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-3">
                        <a href="#" class="btn btn-gradient-secondary">
                            <i class="mdi mdi-arrow-left me-1"></i>
                            Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL DETAIL DOKUMEN -->
    <div class="modal fade" id="modalDokumen" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="mdi mdi-file-document-multiple me-1" style="color: #9a55ff;"></i>
                        Detail Dokumen Legal
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <!-- Loading -->
                    <div id="loadingDokumen" class="text-center py-5">
                        <div class="spinner-border text-primary mb-3" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="text-muted">Memuat data dokumen...</p>
                    </div>

                    <!-- Konten dari server -->
                    <div id="contentDokumen" style="display: none;"></div>

                    {{--
                        Section Upload Foto KTP:
                        - Muncul jika dokumen BELUM lengkap
                        - Disembunyikan jika sudah lengkap (ditangani JS via data-lengkap)
                    --}}
                    <div id="sectionUploadFoto" style="display: none; margin-top: 1.5rem;">
                        <div class="upload-foto-section">
                            <div class="section-header">
                                <i class="mdi mdi-camera-plus"></i>
                                <span>Upload Foto KTP</span>
                                <span class="badge bg-warning text-dark ms-auto" style="font-size: 0.65rem;">
                                    <i class="mdi mdi-flask me-1"></i>UI Sementara
                                </span>
                            </div>

                            <div class="custom-alert custom-alert-warning mb-3">
                                <i class="mdi mdi-alert-circle me-1"></i>
                                Dokumen belum lengkap. Silakan upload foto KTP pembeli untuk melanjutkan proses.
                            </div>

                            <!-- Slot KTP -->
                            <div class="foto-upload-item" id="fotoItem_ktp" style="max-width: 180px;">
                                <input type="file" id="foto_ktp" accept="image/*,application/pdf"
                                    data-key="ktp" class="foto-input">
                                <label for="foto_ktp" class="foto-label">
                                    <div class="foto-icon">
                                        <i class="mdi mdi-card-account-details"></i>
                                    </div>
                                    <div class="foto-name">KTP Pembeli</div>
                                    <div class="foto-hint">Klik untuk upload</div>
                                </label>
                            </div>

                            <div class="foto-counter" id="fotoCounter" style="margin-top: 0.75rem;">
                                <strong>0</strong> dari <strong>1</strong> foto dipilih
                            </div>

                            <div class="upload-progress-bar" id="uploadProgressBar">
                                <div class="bar-fill" id="uploadBarFill"></div>
                            </div>

                            <button type="button" class="btn-upload-semua" id="btnUploadSemuaFoto" disabled>
                                <i class="mdi mdi-cloud-upload"></i>
                                Upload Foto KTP
                            </button>
                        </div>
                    </div>

                    {{--
                        Alert Lengkap:
                        - Muncul jika dokumen SUDAH lengkap
                        - Disembunyikan jika belum (ditangani JS)
                    --}}
                    <div id="sectionSudahLengkap" style="display: none;">
                        <div class="alert-dokumen-lengkap">
                            <i class="mdi mdi-check-circle"></i>
                            <div class="alert-text">
                                <strong>Dokumen Sudah Lengkap!</strong>
                                <span>Semua dokumen telah diupload. Booking ini siap untuk proses Akad / Pecah Legal Unit.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer" id="modalFooter" style="display: none;">
                    <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {

            // DataTables
            if ($.fn.DataTable.isDataTable('#tableCekDokumen')) {
                $('#tableCekDokumen').DataTable().destroy();
            }
            $('#tableCekDokumen').DataTable({
                responsive: true,
                ordering: true,
                paging: false,
                info: false,
                searching: false,
                lengthChange: false,
                destroy: true,
                language: {
                    emptyTable: "Data booking belum tersedia",
                    zeroRecords: "Data tidak ditemukan",
                },
                columnDefs: [{ orderable: false, targets: [6] }]
            });

            // Helpers
            function showLoading(message = 'Mohon tunggu sebentar') {
                Swal.fire({
                    title: 'Memuat...',
                    text: message,
                    allowOutsideClick: false,
                    didOpen: () => { Swal.showLoading(); }
                });
            }

            function initFileUpload() {
                $('.modern-file-upload input[type="file"]').off('change').on('change', function (e) {
                    const file = e.target.files[0];
                    const label = $(this).closest('.modern-file-upload').find('.file-info span');
                    const sizeSpan = $(this).closest('.modern-file-upload').find('.file-size');
                    if (file) {
                        label.text(file.name.length > 30 ? file.name.substring(0, 30) + '...' : file.name);
                        sizeSpan.text((file.size / (1024 * 1024)).toFixed(2) + ' MB').show();
                    } else {
                        sizeSpan.text('').hide();
                    }
                });
            }

            // Counter foto KTP
            let fotoSelected = 0;

            function updateFotoCounter() {
                fotoSelected = $('#fotoItem_ktp').hasClass('has-preview') ? 1 : 0;
                $('#fotoCounter strong:first').text(fotoSelected);
                $('#btnUploadSemuaFoto').prop('disabled', fotoSelected === 0);
            }

            // Preview foto saat dipilih
            $(document).on('change', '.foto-input', function (e) {
                const file = e.target.files[0];
                if (!file) return;

                const key = $(this).data('key');
                const itemEl = $('#fotoItem_' + key);
                const labelEl = itemEl.find('.foto-label');

                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function (ev) {
                        labelEl.empty();
                        labelEl.append(
                            $('<img>').addClass('foto-preview-img').attr('src', ev.target.result)
                        );
                        labelEl.append(
                            $('<div>').addClass('foto-preview-overlay').append(
                                $('<i>').addClass('mdi mdi-pencil'),
                                $('<span>').text('Ganti Foto')
                            )
                        );
                        itemEl.find('.foto-badge-ok').remove();
                        itemEl.append(
                            $('<div>').addClass('foto-badge-ok').html('<i class="mdi mdi-check"></i>')
                        );
                        itemEl.addClass('has-preview');
                        updateFotoCounter();
                    };
                    reader.readAsDataURL(file);
                } else {
                    // PDF
                    labelEl.empty().addClass('p-3 text-center').append(
                        $('<div>').addClass('foto-icon mb-1').append(
                            $('<i>').addClass('mdi mdi-file-pdf-box').css({ fontSize: '1.5rem', color: '#dc3545' })
                        ),
                        $('<div>').addClass('foto-name').text(
                            file.name.length > 16 ? file.name.substring(0, 13) + '...' : file.name
                        ),
                        $('<div>').addClass('foto-hint').text('Klik untuk ganti')
                    );
                    itemEl.find('.foto-badge-ok').remove();
                    itemEl.append(
                        $('<div>').addClass('foto-badge-ok').html('<i class="mdi mdi-check"></i>')
                    );
                    itemEl.addClass('has-preview');
                    updateFotoCounter();
                }
            });

            // Tombol upload (simulasi - ganti dengan AJAX real saat backend siap)
            $('#btnUploadSemuaFoto').on('click', function () {
                const btn = $(this);
                const progressBar = $('#uploadProgressBar');
                const barFill = $('#uploadBarFill');

                btn.prop('disabled', true).html('<i class="mdi mdi-loading mdi-spin"></i> Mengupload...');
                progressBar.show();

                let progress = 0;
                const interval = setInterval(function () {
                    progress += Math.random() * 15;
                    if (progress >= 100) {
                        progress = 100;
                        clearInterval(interval);
                        barFill.css('width', '100%');
                        setTimeout(function () {
                            progressBar.hide();
                            barFill.css('width', '0%');
                            btn.html('<i class="mdi mdi-cloud-upload"></i> Upload Foto KTP');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Foto KTP berhasil diupload.',
                                timer: 2500,
                                timerProgressBar: true,
                                showConfirmButton: false,
                                confirmButtonColor: '#9a55ff'
                            }).then(function () {
                                btn.prop('disabled', fotoSelected === 0);
                            });
                        }, 400);
                    } else {
                        barFill.css('width', Math.round(progress) + '%');
                    }
                }, 150);
            });

            // ================================================================
            // Buka Modal - cek data-lengkap untuk tampilkan/sembunyikan form
            // ================================================================
            $('.btn-detail-dokumen').on('click', function (e) {
                e.preventDefault();

                const bookingId  = $(this).data('booking');
                const isLengkap  = $(this).data('lengkap') === true; // baca dari data-lengkap di tombol

                // Reset modal
                $('#loadingDokumen').show();
                $('#contentDokumen').hide().html('');
                $('#sectionUploadFoto').hide();
                $('#sectionSudahLengkap').hide();
                $('#modalFooter').hide();

                // Reset slot KTP
                const ktpItem = $('#fotoItem_ktp');
                ktpItem.removeClass('has-preview').find('.foto-badge-ok').remove();
                ktpItem.find('input[type="file"]').val('');
                ktpItem.find('.foto-label').removeClass('p-3 text-center').empty().append(
                    $('<div>').addClass('foto-icon').append($('<i>').addClass('mdi mdi-card-account-details')),
                    $('<div>').addClass('foto-name').text('KTP Pembeli'),
                    $('<div>').addClass('foto-hint').text('Klik untuk upload')
                );
                updateFotoCounter();

                $('#modalDokumen').modal('show');

                fetch(`/document-legal/detail/${bookingId}`)
                    .then(res => res.text())
                    .then(html => {
                        $('#loadingDokumen').hide();
                        $('#contentDokumen').html(html).show();

                        // Cek kondisi lengkap/belum → tampilkan section yang sesuai
                        if (isLengkap) {
                            $('#sectionSudahLengkap').show(); // tampilkan info sudah lengkap
                            $('#sectionUploadFoto').hide();   // sembunyikan form upload
                        } else {
                            $('#sectionUploadFoto').show();   // tampilkan form upload
                            $('#sectionSudahLengkap').hide(); // sembunyikan info lengkap
                        }

                        $('#modalFooter').show();
                        initFileUpload();
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        $('#loadingDokumen').hide();
                        $('#contentDokumen').html(`
                            <div class="alert alert-danger text-center py-4">
                                <i class="mdi mdi-alert-circle me-2" style="font-size: 2rem;"></i>
                                <p class="mb-0">Gagal memuat data dokumen</p>
                            </div>
                        `).show();
                        // Tetap tampilkan form upload jika gagal load & belum lengkap
                        if (!isLengkap) $('#sectionUploadFoto').show();
                        $('#modalFooter').show();
                    });
            });

            // Submit upload dokumen dari konten server
            $(document).on('submit', '.form-upload-dokumen', function (e) {
                e.preventDefault();
                const form = this;
                const formData = new FormData(form);
                showLoading('Mengupload dokumen...');
                $.ajax({
                    url: $(form).attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        Swal.close();
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Dokumen berhasil diupload',
                            timer: 2000,
                            timerProgressBar: true,
                            showConfirmButton: false
                        }).then(() => {
                            const bookingId = $(form).data('booking');
                            $('.btn-detail-dokumen[data-booking="' + bookingId + '"]').click();
                        });
                    },
                    error: function (xhr) {
                        Swal.close();
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: xhr.responseJSON?.message || 'Terjadi kesalahan saat upload',
                            confirmButtonColor: '#9a55ff'
                        });
                    }
                });
            });

            // Download file
            $(document).on('click', '.btn-download-file', function (e) {
                e.preventDefault();
                window.open($(this).data('file'), '_blank');
            });

        });
    </script>
@endpush
