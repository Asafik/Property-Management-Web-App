@extends('layouts.partial.app')

@section('title', 'Detail Unit Terjual - Property Management App')

@section('content')
    <style>
        .sold-unit-page {
            color: #2c2e3f;
        }

        /* ===== CARD ===== */
        .sold-unit-page .card {
            border: 0;
            margin-bottom: 1rem;
            box-shadow: 0 4px 18px rgba(44, 46, 63, 0.05);
            transition: box-shadow 0.25s ease;
            background: #fff;
        }

        .sold-unit-page .card:hover {
            transform: none !important;
            box-shadow: 0 8px 20px rgba(154, 85, 255, 0.08);
        }

        .sold-unit-page .card-header {
            background: #ffffff;
            border-bottom: 1px solid #f0edf7;
            padding: 1rem 1.25rem;
        }

        .sold-unit-page .card-body {
            padding: 1.25rem;
        }

        .sold-unit-page .card-title {
            font-size: 1rem;
            font-weight: 700;
            color: #2c2e3f;
            margin-bottom: 0;
            display: flex;
            align-items: center;
            gap: 8px;
            letter-spacing: 0.2px;
        }

        .sold-unit-page .card-title i {
            color: #9a55ff !important;
            font-size: 1.1rem;
        }

        /* ===== HEADER STATUS ===== */
        .sold-status-card .card-body {
            padding: 1.5rem;
        }

        .sold-status-main {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .sold-status-left {
            display: flex;
            align-items: center;
            gap: 1rem;
            min-width: 0;
            flex: 1;
        }

        .sold-status-icon {
            width: 64px;
            height: 64px;
            border-radius: 12px;
            background: linear-gradient(135deg, #28a745, #5cb85c);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 6px 14px rgba(40, 167, 69, 0.18);
        }

        .sold-status-icon i {
            font-size: 1.9rem;
        }

        .sold-status-title {
            font-size: 1.35rem;
            font-weight: 800;
            color: #2c2e3f;
            margin-bottom: 0.3rem;
            line-height: 1.2;
        }

        .sold-status-meta {
            color: #6c7383;
            font-size: 0.92rem;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .sold-unit-box {
            min-width: 110px;
            padding: 0.85rem 1rem;
            background: linear-gradient(135deg, #f8f4ff, #f2ecff);
            border: 1px solid #eadfff;
            text-align: center;
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.08);
        }

        .sold-unit-label {
            display: block;
            font-size: 0.72rem;
            font-weight: 700;
            color: #8d86a5;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin-bottom: 0.25rem;
        }

        .sold-unit-code {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.35rem;
            padding: 0.45rem 0.75rem;
            background: linear-gradient(135deg, #28a745, #5cb85c);
            color: #fff;
            font-size: 0.95rem;
            font-weight: 800;
            line-height: 1;
        }

        .sold-unit-code i {
            font-size: 0.95rem;
        }

        /* ===== INFO BOX ===== */
        .info-box {
            background: linear-gradient(135deg, #faf8ff, #f3ecff);
            border: 1px solid #eee6ff;
            border-radius: 12px;
            padding: 1.15rem 1.2rem;
            height: 100%;
        }

        .info-row {
            display: flex;
            align-items: flex-start;
            gap: 0.85rem;
            margin-bottom: 0.8rem;
        }

        .info-row:last-child {
            margin-bottom: 0;
        }

        .info-label {
            width: 130px;
            min-width: 130px;
            font-size: 0.83rem;
            font-weight: 700;
            color: #6c7383;
            line-height: 1.5;
        }

        .info-value {
            flex: 1;
            font-size: 0.94rem;
            font-weight: 600;
            color: #2c2e3f;
            line-height: 1.55;
            word-break: break-word;
        }

        .info-value-large {
            font-size: 1.1rem;
            font-weight: 800;
            color: #28a745;
        }

        /* ===== DETAIL CARD ===== */
        .detail-card {
            border: 1px solid #eeeaf7;
            border-radius: 12px;
            padding: 1rem 1.1rem;
            background: #fff;
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.4);
            transition: all 0.25s ease;
        }

        .detail-card:hover {
            border-color: rgba(154, 85, 255, 0.28);
            box-shadow: 0 10px 25px rgba(154, 85, 255, 0.08);
        }

        .customer-summary {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.25rem;
        }

        .customer-avatar {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: linear-gradient(135deg, #9a55ff, #b57cff);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 10px 20px rgba(154, 85, 255, 0.18);
        }

        .customer-avatar i {
            font-size: 2rem;
        }

        .customer-name {
            font-size: 1.35rem;
            font-weight: 800;
            color: #2c2e3f;
            margin-bottom: 0.2rem;
            line-height: 1.2;
        }

        .customer-booking {
            font-size: 0.9rem;
            color: #7b8092;
            margin-bottom: 0;
        }

        /* ===== BADGE ===== */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.45rem 0.8rem;
            border-radius: 999px;
            font-size: 0.76rem;
            font-weight: 700;
            line-height: 1;
            border: none;
        }

        .badge-success {
            background: linear-gradient(135deg, #28a745, #5cb85c);
            color: white;
        }

        .badge-warning {
            background: linear-gradient(135deg, #ffc107, #ffdb6d);
            color: #2c2e3f;
        }

        .badge-info {
            background: linear-gradient(135deg, #17a2b8, #5bc0de);
            color: white;
        }

        .badge-primary {
            background: linear-gradient(135deg, #9a55ff, #da8cff);
            color: white;
        }

        /* ===== DOCUMENT LIST ===== */
        .document-list {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .document-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            padding: 0.9rem 1rem;
            background: #fbfaff;
            border: 1px solid #efe8ff;
            border-left: 4px solid #9a55ff;
            border-radius: 10px;
            transition: all 0.25s ease;
        }

        .document-item:hover {
            box-shadow: 0 10px 22px rgba(154, 85, 255, 0.08);
        }

        .document-info {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            min-width: 0;
            flex: 1;
        }

        .document-info i {
            font-size: 1.2rem;
            color: #9a55ff;
            flex-shrink: 0;
        }

        .document-name {
            font-weight: 700;
            color: #2c2e3f;
            line-height: 1.4;
            word-break: break-word;
        }

        .btn-eye {
            width: 38px;
            height: 38px;
            border-radius: 6px;
            background: linear-gradient(135deg, #9a55ff, #da8cff);
            color: white;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: none;
            flex-shrink: 0;
            transition: all 0.25s ease;
        }

        .btn-eye:hover {
            box-shadow: 0 8px 16px rgba(154, 85, 255, 0.20);
        }

        /* ===== PRICE ===== */
        .price-summary {
            background: linear-gradient(135deg, #fcfbff, #f5f1ff);
            border: 1px solid #eee6ff;
            border-radius: 12px;
            padding: 1rem 1rem 0.9rem;
        }

        .price-row {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 0.8rem;
            font-size: 0.93rem;
            color: #2c2e3f;
        }

        .price-row span:first-child {
            color: #6c7383;
            font-weight: 600;
        }

        .price-row span:last-child {
            text-align: right;
            font-weight: 700;
            color: #2c2e3f;
        }

        .price-row.total {
            border-top: 1px dashed #d7c8ff;
            margin-top: 0.9rem;
            padding-top: 0.9rem;
        }

        .price-row.total span {
            font-size: 1.05rem;
            font-weight: 800 !important;
            color: #28a745 !important;
        }

        /* ===== TIMELINE ===== */
        .timeline-completed {
            position: relative;
            padding-left: 2rem;
        }

        .timeline-completed::before {
            content: '';
            position: absolute;
            left: 8px;
            top: 6px;
            bottom: 6px;
            width: 2px;
            background: linear-gradient(to bottom, rgba(40, 167, 69, 0.35), rgba(40, 167, 69, 0.65));
        }

        .timeline-item {
            position: relative;
            padding-bottom: 1.25rem;
        }

        .timeline-item:last-child {
            padding-bottom: 0;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -1.52rem;
            top: 0.32rem;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #28a745;
            border: 3px solid #ffffff;
            box-shadow: 0 0 0 4px rgba(40, 167, 69, 0.16);
        }

        .timeline-date {
            font-size: 0.78rem;
            color: #28a745;
            font-weight: 800;
            margin-bottom: 0.15rem;
        }

        .timeline-title {
            font-size: 1rem;
            font-weight: 800;
            color: #2c2e3f;
            margin-bottom: 0.15rem;
            line-height: 1.35;
        }

        .timeline-desc {
            font-size: 0.88rem;
            color: #6c7383;
            line-height: 1.5;
        }

        /* ===== BUTTON ===== */
        .btn {
            font-size: 0.88rem;
            padding: 0.72rem 1.05rem;
            border-radius: 12px;
            font-weight: 700;
            transition: all 0.25s ease;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.35rem;
        }

        .btn:hover {
            transform: none;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.08);
        }

        .btn-primary {
            background: linear-gradient(to right, #da8cff, #9a55ff);
            color: white;
        }

        .btn-outline-primary {
            background: transparent;
            border: 1px solid #9a55ff;
            color: #9a55ff;
        }

        .btn-outline-primary:hover {
            background: linear-gradient(135deg, #9a55ff, #da8cff);
            color: white;
            border-color: transparent;
        }

        .btn-outline-secondary {
            background: transparent;
            border: 1px solid #c7c9d1;
            color: #6c757d;
        }

        .btn-outline-secondary:hover {
            background: #6c757d;
            color: white;
            border-color: #6c757d;
        }

        .btn-success {
            background: linear-gradient(135deg, #28a745, #5cb85c);
            color: white;
        }

        /* ===== ADDITIONAL INFO ===== */
        .additional-info-item {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.85rem 0.95rem;
            background: #fcfbff;
            border: 1px solid #f0eaff;
            border-radius: 10px;
            height: 100%;
        }

        .additional-info-item i {
            font-size: 1.15rem;
            flex-shrink: 0;
        }

        .note-box {
            background: linear-gradient(135deg, #faf8ff, #f6f2ff);
            border: 1px solid #efe7ff;
            border-radius: 10px;
            padding: 1rem 1rem 0.9rem;
        }

        /* ===== ACTION CARD ===== */
        .action-card .card-body {
            padding: 1rem 1.25rem;
        }

        .action-wrap {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .action-right {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 991.98px) {
            .sold-unit-page .card-header,
            .sold-unit-page .card-body {
                padding: 1rem;
            }

            .sold-status-title {
                font-size: 1.25rem;
            }

            .customer-name {
                font-size: 1.15rem;
            }
        }

        @media (max-width: 767.98px) {
            .sold-unit-page .container-fluid {
                padding-left: 0.75rem !important;
                padding-right: 0.75rem !important;
            }

            .sold-status-main {
                align-items: flex-start;
            }

            .sold-status-left {
                width: 100%;
            }

            .sold-unit-box {
                width: 100%;
                min-width: 100%;
                text-align: left;
                padding: 0.85rem 0.9rem;
            }

            .sold-unit-code {
                width: 100%;
            }

            .action-wrap,
            .action-right {
                width: 100%;
            }

            .action-right .btn,
            .action-wrap > div:first-child,
            .action-wrap > div:first-child .btn {
                width: 100%;
            }
        }

        @media (max-width: 575.98px) {
            .sold-unit-page .card-header {
                padding: 0.9rem 0.9rem;
            }

            .sold-unit-page .card-body,
            .sold-status-card .card-body,
            .action-card .card-body {
                padding: 0.9rem;
            }

            .sold-status-left {
                gap: 0.85rem;
                align-items: flex-start;
            }

            .sold-status-icon {
                width: 56px;
                height: 56px;
                border-radius: 10px;
            }

            .sold-status-icon i {
                font-size: 1.6rem;
            }

            .sold-status-title {
                font-size: 1.05rem;
            }

            .sold-status-meta {
                font-size: 0.82rem;
            }

            .customer-summary {
                align-items: flex-start;
            }

            .customer-avatar {
                width: 58px;
                height: 58px;
            }

            .customer-avatar i {
                font-size: 1.6rem;
            }

            .customer-name {
                font-size: 1.05rem;
            }

            .info-row {
                flex-direction: column;
                gap: 0.15rem;
                margin-bottom: 0.75rem;
            }

            .info-label {
                width: 100%;
                min-width: 100%;
                font-size: 0.78rem;
            }

            .info-value {
                font-size: 0.9rem;
            }

            .document-item {
                padding: 0.85rem 0.85rem;
            }

            .document-name {
                font-size: 0.9rem;
            }

            .price-row {
                flex-direction: column;
                gap: 0.18rem;
                margin-bottom: 0.75rem;
            }

            .price-row span:last-child {
                text-align: left;
            }

            .timeline-completed {
                padding-left: 1.6rem;
            }

            .timeline-item::before {
                left: -1.25rem;
            }

            .timeline-title {
                font-size: 0.94rem;
            }

            .timeline-desc {
                font-size: 0.84rem;
            }

            .badge {
                font-size: 0.72rem;
                padding: 0.42rem 0.7rem;
            }

            .btn {
                width: 100%;
                padding: 0.8rem 1rem;
            }
        }
    </style>

    <div class="container-fluid p-2 p-sm-3 p-md-4 sold-unit-page">
        <!-- Header dengan Status TERJUAL -->
        <div class="row mb-3">
            <div class="col-12">
                <div class="card sold-status-card">
                    <div class="card-body">
                        <div class="sold-status-main">
                            <div class="sold-status-left">
                                <div class="sold-status-icon">
                                    <i class="mdi mdi-check"></i>
                                </div>
                                <div>
                                    <h4 class="sold-status-title">UNIT TELAH TERJUAL</h4>
                                    <div class="sold-status-meta">
                                        <span><i class="mdi mdi-calendar me-1"></i> Closing: 25 Maret 2025</span>
                                        <span class="badge badge-success">SELESAI</span>
                                    </div>
                                </div>
                            </div>

                            <div class="sold-unit-box">
                                <span class="sold-unit-label">Unit</span>
                                <span class="sold-unit-code">
                                    <i class="mdi mdi-home"></i> {{ $unit->unit_code ?? '-' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Row: Info Unit -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="card-title">
                            <i class="mdi mdi-home-variant"></i>
                            INFORMASI UNIT YANG DIBELI
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="info-box">
                                    <div class="info-row">
                                        <span class="info-label">Nama Unit</span>
                                        <span class="info-value fw-bold">Tipe {{ $unit->type ?? '-' }} -
                                            {{ $unit->unit_name ?? '-' }}</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Blok / No</span>
                                        <span class="info-value">{{ $unit->unit_code ?? '-' }}</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Luas Tanah</span>
                                        <span class="info-value">{{ $unit->area ?? '-' }} m²</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Luas Bangunan</span>
                                        <span class="info-value">{{ $unit->building_area ?? '-' }} m²</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Hadap</span>
                                        <span class="info-value">{{ $unit->facing ?? '-' }}</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Posisi</span>
                                        <span class="info-value">{{ $unit->position ?? '-' }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-box">
                                    <div class="info-row">
                                        <span class="info-label">Lokasi</span>
                                        <span class="info-value">{{ $unit->landBank->address ?? '-' }}</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Koordinat</span>
                                        <span class="info-value">{{ $unit->landBank->lat ?? '-' }},
                                            {{ $unit->landBank->lng ?? '-' }}</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Zonasi</span>
                                        <span class="info-value">{{ $unit->landBank->zoning ?? '-' }}</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Lebar Jalan</span>
                                        <span class="info-value">{{ $unit->landBank->road_width ?? '-' }}m
                                            ({{ $unit->landBank->road_type ?? '-' }})</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Listrik</span>
                                        <span class="info-value">2200 VA</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Sumber Air</span>
                                        <span class="info-value">PAM / PDAM</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Row: Data Customer & Dokumen -->
        <div class="row mt-3">
            <div class="col-md-6 mb-3 mb-md-0">
                <div class="card h-100">
                    <div class="card-header bg-white">
                        <h5 class="card-title">
                            <i class="mdi mdi-account-circle"></i>
                            DATA CUSTOMER
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="customer-summary">
                            <div class="customer-avatar">
                                <i class="mdi mdi-account"></i>
                            </div>
                            <div>
                                <h4 class="customer-name">
                                    {{ $booking->customer->full_name ?? '-' }}
                                </h4>
                                
                                <p class="customer-booking">
                                    Booking ID: {{ $booking->booking_code ?? '-' }}
                                </p>                   </div>
                        </div>

                        <div class="detail-card">
                            <div class="info-row">
                                <span class="info-label">NIK</span>
                                <span class="info-value">{{ $booking->customer->nik ?? '-' }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">NPWP</span>
                                <span class="info-value">{{ $booking->customer->npwp ?? '-' }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">No. HP</span>
                                <span class="info-value">{{ $booking->customer->phone ?? '-' }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Email</span>
                                <span class="info-value">{{ $booking->customer->email ?? '-' }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Alamat</span>
                                <span class="info-value">{{ $booking->customer->address ?? '-' }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Pekerjaan</span>
                                <span class="info-value">{{ $booking->customer->job_status ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header bg-white">
                        <h5 class="card-title">
                            <i class="mdi mdi-file-document-multiple"></i>
                            DOKUMEN FINAL
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="document-list">
                            <div class="document-item">
                                <div class="document-info">
                                    <i class="mdi mdi-file-pdf"></i>
                                    <span class="document-name">Akad Kredit</span>
                                </div>
                                <button class="btn-eye">
                                    <i class="mdi mdi-eye"></i>
                                </button>
                            </div>
                            <div class="document-item">
                                <div class="document-info">
                                    <i class="mdi mdi-file-pdf"></i>
                                    <span class="document-name">AJB (Akta Jual Beli)</span>
                                </div>
                                <button class="btn-eye">
                                    <i class="mdi mdi-eye"></i>
                                </button>
                            </div>
                            <div class="document-item">
                                <div class="document-info">
                                    <i class="mdi mdi-file-image"></i>
                                    <span class="document-name">Bukti Transfer Pencairan</span>
                                </div>
                                <button class="btn-eye">
                                    <i class="mdi mdi-eye"></i>
                                </button>
                            </div>
                            <div class="document-item">
                                <div class="document-info">
                                    <i class="mdi mdi-file-pdf"></i>
                                    <span class="document-name">Berita Acara Serah Terima</span>
                                </div>
                                <button class="btn-eye">
                                    <i class="mdi mdi-eye"></i>
                                </button>
                            </div>
                            <div class="document-item">
                                <div class="document-info">
                                    <i class="mdi mdi-file-certificate"></i>
                                    <span class="document-name">Sertifikat (SHM)</span>
                                </div>
                                <button class="btn-eye">
                                    <i class="mdi mdi-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mt-3 text-md-end text-start">
                            <span class="badge badge-success p-2">
                                <i class="mdi mdi-check-circle"></i> 5 Dokumen Lengkap
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Row: Rincian Harga & Riwayat -->
        <div class="row mt-3">
            <div class="col-md-6 mb-3 mb-md-0">
                <div class="card h-100">
                    <div class="card-header bg-white">
                        <h5 class="card-title">
                            <i class="mdi mdi-cash-multiple"></i>
                            RINCIAN HARGA FINAL
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="price-summary">
                            @php
                                $purchaseType =
                                    $unit->activeBooking?->purchase_type ?? ($unit->purchase_type ?? 'cash');
                                $dpAmount = $unit->activeBooking?->booking_fee ?? 0;
                                $remaining = ($unit->price ?? 0) - $dpAmount;
                            @endphp

                            @if ($purchaseType == 'cash')
                                <div class="price-row">
                                    <span>Harga Unit</span>
                                    <span>Rp {{ number_format($unit->price ?? 0, 0, ',', '.') }}</span>
                                </div>
                                <div class="price-row">
                                    <span>DP</span>
                                    <span>Rp {{ number_format($dpAmount, 0, ',', '.') }}</span>
                                </div>
                                <div class="price-row total">
                                    <span>Sisa Bayar</span>
                                    <span>Rp {{ number_format($remaining, 0, ',', '.') }}</span>
                                </div>
                            @elseif($unit->purchase_type == 'kpr')
                                <div class="price-row">
                                    <span>Harga Unit</span>
                                    <span>Rp {{ number_format($unit->price, 0, ',', '.') }}</span>
                                </div>
                                <div class="price-row">
                                    <span>DP ({{ $unit->activeBooking->booking_fee_percent ?? 20 }}%)</span>
                                    <span>Rp {{ number_format($unit->activeBooking->booking_fee, 0, ',', '.') }}</span>
                                </div>
                                <div class="price-row">
                                    <span>Pokok Pinjaman KPR</span>
                                    <span>Rp {{ number_format($unit->loan_principal ?? 0, 0, ',', '.') }}</span>
                                </div>
                                <div class="price-row">
                                    <span>Bunga ({{ $unit->interest_rate ?? 7.5 }}% x {{ $unit->loan_years ?? 15 }}
                                        thn)</span>
                                    <span>Rp {{ number_format($unit->loan_interest ?? 0, 0, ',', '.') }}</span>
                                </div>
                                <div class="price-row">
                                    <span>Total Pinjaman + Bunga</span>
                                    <span>Rp
                                        {{ number_format(($unit->loan_principal ?? 0) + ($unit->loan_interest ?? 0), 0, ',', '.') }}</span>
                                </div>
                                <div class="price-row">
                                    <span>Biaya BPHTB</span>
                                    <span>Rp {{ number_format($unit->bphtb_fee ?? 0, 0, ',', '.') }}</span>
                                </div>
                                <div class="price-row">
                                    <span>Biaya PNBP</span>
                                    <span>Rp {{ number_format($unit->pnbp_fee ?? 0, 0, ',', '.') }}</span>
                                </div>
                                <div class="price-row">
                                    <span>Biaya Notaris</span>
                                    <span>Rp {{ number_format($unit->notary_fee ?? 0, 0, ',', '.') }}</span>
                                </div>
                                <div class="price-row total">
                                    <span>TOTAL BIAYA</span>
                                    <span>Rp
                                        {{ number_format(
                                            ($unit->loan_principal ?? 0) +
                                                ($unit->loan_interest ?? 0) +
                                                ($unit->bphtb_fee ?? 0) +
                                                ($unit->pnbp_fee ?? 0) +
                                                ($unit->notary_fee ?? 0),
                                            0,
                                            ',',
                                            '.',
                                        ) }}</span>
                                </div>
                            @endif
                        </div>

                        @if ($unit->purchase_type == 'kpr')
                            <div class="mt-3">
                                <div class="info-row">
                                    <span class="info-label">Bank Pencairan</span>
                                    <span class="info-value">{{ $unit->bank_name ?? 'BANK MANDIRI' }}</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">No. Referensi</span>
                                    <span class="info-value">{{ $unit->bank_reference ?? 'SK/2025/03/1234' }}</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">Tanggal Cair</span>
                                    <span class="info-value">{{ $unit->disbursement_date ?? '25 Maret 2025' }}</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">No. Sertifikat</span>
                                    <span class="info-value">{{ $unit->certificate_number ?? 'SHM 12345/Jember' }}</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">Atas Nama</span>
                                    <span class="info-value">{{ $unit->owner_name ?? 'BUDI SANTOSO' }}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            @php
                $purchaseType = $unit->activeBooking?->purchase_type ?? 'cash';
            @endphp

            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header bg-white">
                        <h5 class="card-title">
                            <i class="mdi mdi-timeline-text"></i>
                            RIWAYAT TRANSAKSI LENGKAP
                        </h5>
                    </div>

                    <div class="card-body">
                        <div class="timeline-completed">
                            @if($purchaseType == 'cash')
                                <div class="timeline-item">
                                    <div class="timeline-date">
                                        {{ $unit->activeBooking?->created_at?->format('d M Y') }}
                                    </div>
                                    <div class="timeline-title">Booking Unit</div>
                                    <div class="timeline-desc">
                                        Customer melakukan booking unit
                                    </div>
                                </div>

                                <div class="timeline-item">
                                    <div class="timeline-date">
                                        {{ $unit->activeBooking?->created_at?->format('d M Y') }}
                                    </div>
                                    <div class="timeline-title">Pembayaran DP</div>
                                    <div class="timeline-desc">
                                        DP dibayarkan sebesar
                                        Rp {{ number_format($unit->activeBooking?->booking_fee ?? 0,0,',','.') }}
                                    </div>
                                </div>

                                <div class="timeline-item">
                                    <div class="timeline-date">
                                        {{ $unit->activeBooking?->updated_at?->format('d M Y') }}
                                    </div>
                                    <div class="timeline-title">Pelunasan</div>
                                    <div class="timeline-desc">
                                        Customer melakukan pelunasan pembayaran unit
                                    </div>
                                </div>

                                <div class="timeline-item">
                                    <div class="timeline-date">
                                        {{ $unit->activeBooking?->updated_at?->format('d M Y') }}
                                    </div>
                                    <div class="timeline-title">Serah Terima Unit</div>
                                    <div class="timeline-desc">
                                        Unit resmi diserahkan kepada customer
                                    </div>
                                </div>
                            @elseif($purchaseType == 'kpr')
                                <div class="timeline-item">
                                    <div class="timeline-date">10 Maret 2025</div>
                                    <div class="timeline-title">Pengajuan KPR</div>
                                    <div class="timeline-desc">
                                        Customer mengajukan KPR ke Bank
                                    </div>
                                </div>

                                <div class="timeline-item">
                                    <div class="timeline-date">12 Maret 2025</div>
                                    <div class="timeline-title">Verifikasi Dokumen</div>
                                    <div class="timeline-desc">
                                        Dokumen dinyatakan lengkap
                                    </div>
                                </div>

                                <div class="timeline-item">
                                    <div class="timeline-date">15 Maret 2025</div>
                                    <div class="timeline-title">Survey & Appraisal</div>
                                    <div class="timeline-desc">
                                        Bank melakukan survey dan penilaian properti
                                    </div>
                                </div>

                                <div class="timeline-item">
                                    <div class="timeline-date">20 Maret 2025</div>
                                    <div class="timeline-title">Akad Kredit</div>
                                    <div class="timeline-desc">
                                        Akad kredit dilakukan di notaris
                                    </div>
                                </div>

                                <div class="timeline-item">
                                    <div class="timeline-date">25 Maret 2025</div>
                                    <div class="timeline-title">Pencairan Dana</div>
                                    <div class="timeline-desc">
                                        Bank mencairkan dana KPR
                                    </div>
                                </div>

                                <div class="timeline-item">
                                    <div class="timeline-date">26 Maret 2025</div>
                                    <div class="timeline-title">Serah Terima Unit</div>
                                    <div class="timeline-desc">
                                        Unit resmi menjadi milik customer
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="mt-3 text-center text-md-center">
                            <span class="badge badge-success p-2">
                                <i class="mdi mdi-check-circle"></i>
                                STATUS: {{ strtoupper($unit->activeBooking?->status ?? 'SELESAI') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Row: Informasi Tambahan -->
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="card-title">
                            <i class="mdi mdi-information-outline"></i>
                            INFORMASI TAMBAHAN
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="additional-info-item">
                                    <i class="mdi mdi-calendar-check text-success"></i>
                                    <div>
                                        <span class="fw-bold">Masa Garansi:</span>
                                        <span> 12 Bulan (s/d Maret 2026)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="additional-info-item">
                                    <i class="mdi mdi-tools text-primary"></i>
                                    <div>
                                        <span class="fw-bold">Jadwal Maintenance:</span>
                                        <span> Setiap 6 bulan</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="additional-info-item">
                                    <i class="mdi mdi-phone text-info"></i>
                                    <div>
                                        <span class="fw-bold">CS Marketing:</span>
                                        <span> Ahmad (0812-3456-7890)</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-3">

                        <div class="row">
                            <div class="col-md-8">
                                <div class="note-box">
                                    <small class="text-muted d-block mb-1">Catatan:</small>
                                    <p class="mb-0">
                                        Unit sudah diserahkan ke customer dalam kondisi baik. Kunci unit (2 set),
                                        buku garansi, dan dokumen lainnya sudah diterima customer.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="row mt-3">
            <div class="col-12">
                <div class="card action-card">
                    <div class="card-body">
                        <div class="action-wrap">
                            <div>
                                <a href="#" class="btn btn-outline-secondary">
                                    <i class="mdi mdi-arrow-left"></i> Kembali ke Daftar
                                </a>
                            </div>
                            <div class="action-right">
                                <button class="btn btn-outline-primary">
                                    <i class="mdi mdi-printer"></i> Cetak
                                </button>
                                <button class="btn btn-success">
                                    <i class="mdi mdi-download"></i> Download PDF
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
