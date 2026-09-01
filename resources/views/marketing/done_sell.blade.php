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

    @php
        if (!function_exists('resolveFileUrl')) {
            function resolveFileUrl($path) {
                if (empty($path)) return '#';
                $path = str_replace('\\', '/', $path);
                if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
                    return $path;
                }
                $clean = ltrim($path, '/');
                if (file_exists(public_path($clean))) {
                    return asset($clean);
                }
                if (file_exists(public_path('uploads/' . $clean))) {
                    return asset('uploads/' . $clean);
                }
                if (file_exists(public_path('storage/' . $clean))) {
                    return asset('storage/' . $clean);
                }
                if (file_exists(storage_path('app/public/' . $clean))) {
                    return asset('storage/' . $clean);
                }
                if (str_starts_with($clean, 'uploads/') || str_starts_with($clean, 'storage/')) {
                    return asset($clean);
                }
                if (str_starts_with($clean, 'serah_terima/')) {
                    return asset('storage/' . $clean);
                }
                return asset('uploads/' . $clean);
            }
        }

        $kpr = $booking->kprApplication;
        $akad = $booking->akad;
        $serahTerima = $booking->serahTerima;
        $purchaseType = strtolower($booking->purchase_type ?? ($unit->purchase_type ?? 'cash'));
        
        $closingDate = $serahTerima?->tanggal_serah_terima 
            ? \Carbon\Carbon::parse($serahTerima->tanggal_serah_terima)->translatedFormat('d F Y') 
            : ($akad?->tanggal_akad 
                ? \Carbon\Carbon::parse($akad->tanggal_akad)->translatedFormat('d F Y') 
                : ($booking->serah_terima_date 
                    ? \Carbon\Carbon::parse($booking->serah_terima_date)->translatedFormat('d F Y') 
                    : ($booking->akad_date 
                        ? \Carbon\Carbon::parse($booking->akad_date)->translatedFormat('d F Y') 
                        : ($booking->updated_at ? $booking->updated_at->translatedFormat('d F Y') : '-'))));

        $totalPrice = $booking->total_price ?? ($unit->price ?? 0);
        $utjAmount = $booking->utj ?? ($booking->booking_fee ?? 0);
        $totalPaid = $booking->payments ? $booking->payments->sum('amount') : 0;
        $remaining = max(0, $totalPrice - $totalPaid);
    @endphp

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
                                        <span><i class="mdi mdi-calendar me-1"></i> Closing: {{ $closingDate }}</span>
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
                                        <span class="info-value">{{ $unit->area ?? ($kpr->luas_tanah ?? '-') }} m²</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Luas Bangunan</span>
                                        <span class="info-value">{{ $unit->building_area ?? ($kpr->luas_bangunan ?? '-') }} m²</span>
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
                                        <span class="info-value">{{ $unit->landBank->address ?? ($unit->landBank->project_name ?? '-') }}</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Koordinat</span>
                                        <span class="info-value">{{ $unit->landBank->lat ?? '-' }},
                                            {{ $unit->landBank->lng ?? '-' }}</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Zonasi</span>
                                        <span class="info-value">{{ $unit->landBank->zoning ?? ($unit->landBank->nama_cluster ?? '-') }}</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Lebar Jalan</span>
                                        <span class="info-value">{{ $unit->landBank->road_width ? $unit->landBank->road_width . 'm' : '-' }}
                                            ({{ $unit->landBank->road_type ?? '-' }})</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Listrik</span>
                                        <span class="info-value">{{ $unit->electricity ?? ($unit->listrik ?? '1300 VA') }}</span>
                                    </div>
                                    <div class="info-row">
                                        <span class="info-label">Sumber Air</span>
                                        <span class="info-value">{{ $unit->water_source ?? ($unit->air ?? 'PDAM / Sumur Bor') }}</span>
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
                                <h4 class="customer-name">{{ $booking->customer->full_name ?? '-' }}</h4>
                                <p class="customer-booking">Booking ID: {{ $booking->booking_code ?? '-' }}</p>
                            </div>
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
                            DOKUMEN TRANSAKSI
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="document-list">
                            {{-- Dokumen Akad --}}
                            @if(!empty($akad?->dokumen))
                                <div class="document-item">
                                    <div class="document-info">
                                        <i class="mdi mdi-file-pdf text-danger"></i>
                                        <div>
                                            <span class="document-name d-block">Dokumen Akad (No: {{ $akad->no_akad ?? '-' }})</span>
                                            <small class="text-muted">{{ $akad->tanggal_akad ? \Carbon\Carbon::parse($akad->tanggal_akad)->translatedFormat('d M Y') : '' }}</small>
                                        </div>
                                    </div>
                                    <a href="{{ resolveFileUrl($akad->dokumen) }}" target="_blank" class="btn-eye" title="Lihat Dokumen">
                                        <i class="mdi mdi-eye"></i>
                                    </a>
                                </div>
                            @endif

                            {{-- Dokumen SPK --}}
                            @if(!empty($unit->dokumen_spk))
                                <div class="document-item">
                                    <div class="document-info">
                                        <i class="mdi mdi-file-document-outline text-primary"></i>
                                        <div>
                                            <span class="document-name d-block">Dokumen SPK Pembangunan</span>
                                            <small class="text-muted">SPK Unit</small>
                                        </div>
                                    </div>
                                    <a href="{{ resolveFileUrl($unit->dokumen_spk) }}" target="_blank" class="btn-eye" title="Lihat Dokumen">
                                        <i class="mdi mdi-eye"></i>
                                    </a>
                                </div>
                            @endif

                            {{-- Foto Serah Kunci --}}
                            @if(!empty($serahTerima?->foto_serah_kunci))
                                <div class="document-item">
                                    <div class="document-info">
                                        <i class="mdi mdi-key text-warning"></i>
                                        <div>
                                            <span class="document-name d-block">Foto Serah Kunci (BAST: {{ $serahTerima->no_bast ?? '-' }})</span>
                                            <small class="text-muted">{{ $serahTerima->tanggal_serah_terima ? \Carbon\Carbon::parse($serahTerima->tanggal_serah_terima)->translatedFormat('d M Y') : '' }}</small>
                                        </div>
                                    </div>
                                    <a href="{{ resolveFileUrl($serahTerima->foto_serah_kunci) }}" target="_blank" class="btn-eye" title="Lihat Foto Serah Kunci">
                                        <i class="mdi mdi-eye"></i>
                                    </a>
                                </div>
                            @endif

                            {{-- Foto Kondisi Unit --}}
                            @if(!empty($serahTerima?->foto_kondisi_unit))
                                <div class="document-item">
                                    <div class="document-info">
                                        <i class="mdi mdi-camera text-info"></i>
                                        <div>
                                            <span class="document-name d-block">Foto Kondisi Unit Serah Terima</span>
                                            <small class="text-muted">{{ $serahTerima->tanggal_serah_terima ? \Carbon\Carbon::parse($serahTerima->tanggal_serah_terima)->translatedFormat('d M Y') : '' }}</small>
                                        </div>
                                    </div>
                                    <a href="{{ resolveFileUrl($serahTerima->foto_kondisi_unit) }}" target="_blank" class="btn-eye" title="Lihat Foto Kondisi">
                                        <i class="mdi mdi-eye"></i>
                                    </a>
                                </div>
                            @endif

                            {{-- Foto Survey KPR (Depan, Interior, Lingkungan) --}}
                            @if(!empty($kpr?->foto_depan))
                                <div class="document-item">
                                    <div class="document-info">
                                        <i class="mdi mdi-home-outline text-primary"></i>
                                        <div>
                                            <span class="document-name d-block">Foto Survey Tampak Depan</span>
                                            <small class="text-muted">Dokumentasi Survey</small>
                                        </div>
                                    </div>
                                    <a href="{{ resolveFileUrl($kpr->foto_depan) }}" target="_blank" class="btn-eye" title="Lihat Foto">
                                        <i class="mdi mdi-eye"></i>
                                    </a>
                                </div>
                            @endif
                            @if(!empty($kpr?->foto_interior))
                                <div class="document-item">
                                    <div class="document-info">
                                        <i class="mdi mdi-home-floor-1 text-primary"></i>
                                        <div>
                                            <span class="document-name d-block">Foto Survey Interior Unit</span>
                                            <small class="text-muted">Dokumentasi Survey</small>
                                        </div>
                                    </div>
                                    <a href="{{ resolveFileUrl($kpr->foto_interior) }}" target="_blank" class="btn-eye" title="Lihat Foto">
                                        <i class="mdi mdi-eye"></i>
                                    </a>
                                </div>
                            @endif
                            @if(!empty($kpr?->foto_lingkungan))
                                <div class="document-item">
                                    <div class="document-info">
                                        <i class="mdi mdi-tree text-success"></i>
                                        <div>
                                            <span class="document-name d-block">Foto Survey Lingkungan Sekitar</span>
                                            <small class="text-muted">Dokumentasi Survey</small>
                                        </div>
                                    </div>
                                    <a href="{{ resolveFileUrl($kpr->foto_lingkungan) }}" target="_blank" class="btn-eye" title="Lihat Foto">
                                        <i class="mdi mdi-eye"></i>
                                    </a>
                                </div>
                            @endif

                            {{-- Dokumen KPR --}}
                            @if($kpr && $kpr->documents && $kpr->documents->count() > 0)
                                @foreach($kpr->documents as $doc)
                                    <div class="document-item">
                                        <div class="document-info">
                                            <i class="mdi mdi-file-check-outline text-success"></i>
                                            <div>
                                                <span class="document-name d-block">{{ ucwords(str_replace('_', ' ', $doc->type ?? 'Dokumen KPR')) }}</span>
                                            </div>
                                        </div>
                                        <a href="{{ resolveFileUrl($doc->path) }}" target="_blank" class="btn-eye" title="Lihat Dokumen">
                                            <i class="mdi mdi-eye"></i>
                                        </a>
                                    </div>
                                @endforeach
                            @endif

                            {{-- Fallback jika belum ada berkas upload fisik --}}
                            @if(empty($akad?->dokumen) && empty($unit->dokumen_spk) && (!$kpr || $kpr->documents->isEmpty()) && empty($serahTerima?->foto_kondisi_unit) && empty($serahTerima?->foto_serah_kunci) && empty($kpr?->foto_depan))
                                <div class="document-item">
                                    <div class="document-info">
                                        <i class="mdi mdi-file-check-outline text-success"></i>
                                        <span class="document-name">Kelengkapan Administrasi & Berkas Unit</span>
                                    </div>
                                    <span class="badge badge-success">Terverifikasi</span>
                                </div>
                                <div class="document-item">
                                    <div class="document-info">
                                        <i class="mdi mdi-certificate text-warning"></i>
                                        <span class="document-name">Status Sertifikat (SHGB / SHM)</span>
                                    </div>
                                    <span class="badge badge-info">Tersedia di Legal</span>
                                </div>
                            @endif
                        </div>

                        <div class="mt-3 text-md-end text-start">
                            <span class="badge badge-success p-2">
                                <i class="mdi mdi-check-circle"></i> Berkas Terverifikasi
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
                            RINCIAN HARGA & PEMBAYARAN
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="price-summary">
                            @if ($purchaseType == 'cash' || $purchaseType == 'cash_tempo')
                                <div class="price-row">
                                    <span>Harga Unit</span>
                                    <span>Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                                </div>
                                <div class="price-row">
                                    <span>Uang Tanda Jadi (UTJ)</span>
                                    <span>Rp {{ number_format($utjAmount, 0, ',', '.') }}</span>
                                </div>
                                <div class="price-row">
                                    <span>Total Terbayar</span>
                                    <span class="text-success fw-bold">Rp {{ number_format($totalPaid, 0, ',', '.') }}</span>
                                </div>
                                <div class="price-row total">
                                    <span>Sisa Tagihan</span>
                                    <span class="{{ $remaining > 0 ? 'text-danger' : 'text-success' }}">
                                        Rp {{ number_format($remaining, 0, ',', '.') }}
                                    </span>
                                </div>
                            @elseif($purchaseType == 'kpr')
                                <div class="price-row">
                                    <span>Harga Unit</span>
                                    <span>Rp {{ number_format($kpr->harga_unit ?? $totalPrice, 0, ',', '.') }}</span>
                                </div>
                                <div class="price-row">
                                    <span>Uang Tanda Jadi (UTJ)</span>
                                    <span>Rp {{ number_format($utjAmount, 0, ',', '.') }}</span>
                                </div>
                                <div class="price-row">
                                    <span>Uang Muka / DP</span>
                                    <span>Rp {{ number_format($kpr->dp ?? 0, 0, ',', '.') }}</span>
                                </div>
                                <div class="price-row">
                                    <span>Plafon / Pinjaman KPR Disetujui</span>
                                    <span class="text-primary fw-bold">Rp {{ number_format($kpr->jumlah_pinjaman ?? 0, 0, ',', '.') }}</span>
                                </div>
                                <div class="price-row">
                                    <span>Tenor</span>
                                    <span>{{ $kpr->tenor ?? '-' }} Tahun</span>
                                </div>
                                <div class="price-row">
                                    <span>Suku Bunga</span>
                                    <span>{{ $kpr->bunga ?? '-' }}%</span>
                                </div>
                                <div class="price-row total">
                                    <span>Estimasi Angsuran / Bulan</span>
                                    <span class="text-success">Rp {{ number_format($kpr->estimasi_angsuran ?? 0, 0, ',', '.') }}</span>
                                </div>
                            @endif
                        </div>

                        @if ($purchaseType == 'kpr' && $kpr)
                            <div class="mt-3">
                                <div class="info-row">
                                    <span class="info-label">Bank Penyalur</span>
                                    <span class="info-value fw-bold">{{ $kpr->bank->bank_name ?? '-' }}</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">No. SP3K</span>
                                    <span class="info-value">{{ $kpr->no_sp3k ?? '-' }}</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">No. Akad</span>
                                    <span class="info-value">{{ $akad->no_akad ?? '-' }}</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">Tanggal Akad</span>
                                    <span class="info-value">{{ $akad?->tanggal_akad ? \Carbon\Carbon::parse($akad->tanggal_akad)->translatedFormat('d F Y') : '-' }}</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">Notaris</span>
                                    <span class="info-value">{{ $akad->nama_notaris ?? '-' }}</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">Lokasi Akad</span>
                                    <span class="info-value">{{ $akad->lokasi_akad ?? '-' }}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header bg-white">
                        <h5 class="card-title">
                            <i class="mdi mdi-timeline-text"></i>
                            RIWAYAT TRANSAKSI
                        </h5>
                    </div>

                    <div class="card-body">
                        <div class="timeline-completed">
                            @if($purchaseType == 'cash' || $purchaseType == 'cash_tempo')
                                <div class="timeline-item">
                                    <div class="timeline-date">
                                        {{ $booking->created_at ? $booking->created_at->translatedFormat('d M Y') : '-' }}
                                    </div>
                                    <div class="timeline-title">Booking Unit & UTJ</div>
                                    <div class="timeline-desc">
                                        Customer melakukan booking unit (UTJ: Rp {{ number_format($utjAmount, 0, ',', '.') }})
                                    </div>
                                </div>

                                <div class="timeline-item">
                                    <div class="timeline-date">
                                        {{ $booking->created_at ? $booking->created_at->translatedFormat('d M Y') : '-' }}
                                    </div>
                                    <div class="timeline-title">Pembayaran & Administrasi</div>
                                    <div class="timeline-desc">
                                        Total pembayaran tercatat sebesar Rp {{ number_format($totalPaid, 0, ',', '.') }}
                                    </div>
                                </div>

                                <div class="timeline-item">
                                    <div class="timeline-date">
                                        {{ $akad?->tanggal_akad ? \Carbon\Carbon::parse($akad->tanggal_akad)->translatedFormat('d M Y') : ($booking->akad_date ? $booking->akad_date->translatedFormat('d M Y') : '-') }}
                                    </div>
                                    <div class="timeline-title">Akad Jual Beli</div>
                                    <div class="timeline-desc">
                                        Akad transaksi berhasil diproses
                                    </div>
                                </div>

                                <div class="timeline-item">
                                    <div class="timeline-date">
                                        {{ $serahTerima?->tanggal_serah_terima ? \Carbon\Carbon::parse($serahTerima->tanggal_serah_terima)->translatedFormat('d M Y') : ($booking->serah_terima_date ? $booking->serah_terima_date->translatedFormat('d M Y') : ($booking->updated_at ? $booking->updated_at->translatedFormat('d M Y') : '-')) }}
                                    </div>
                                    <div class="timeline-title">Serah Terima Unit</div>
                                    <div class="timeline-desc">
                                        Unit resmi diserahkan kepada customer
                                    </div>
                                </div>
                            @elseif($purchaseType == 'kpr')
                                <div class="timeline-item">
                                    <div class="timeline-date">
                                        {{ $booking->created_at ? $booking->created_at->translatedFormat('d M Y') : '-' }}
                                    </div>
                                    <div class="timeline-title">Booking Unit & UTJ</div>
                                    <div class="timeline-desc">
                                        Customer booking unit (UTJ: Rp {{ number_format($utjAmount, 0, ',', '.') }})
                                    </div>
                                </div>

                                <div class="timeline-item">
                                    <div class="timeline-date">
                                        {{ $kpr?->submitted_at ? \Carbon\Carbon::parse($kpr->submitted_at)->translatedFormat('d M Y') : ($booking->created_at ? $booking->created_at->translatedFormat('d M Y') : '-') }}
                                    </div>
                                    <div class="timeline-title">Pengajuan & Verifikasi KPR</div>
                                    <div class="timeline-desc">
                                        Pengajuan KPR ke {{ $kpr->bank->bank_name ?? 'Bank' }} telah diverifikasi
                                    </div>
                                </div>

                                <div class="timeline-item">
                                    <div class="timeline-date">
                                        {{ $kpr?->survey_date ? \Carbon\Carbon::parse($kpr->survey_date)->translatedFormat('d M Y') : '-' }}
                                    </div>
                                    <div class="timeline-title">Survey & Penilaian Bank</div>
                                    <div class="timeline-desc">
                                        Hasil survey kelayakan {{ $kpr->persentase_kelayakan ?? '100' }}%
                                    </div>
                                </div>

                                <div class="timeline-item">
                                    <div class="timeline-date">
                                        {{ $akad?->tanggal_akad ? \Carbon\Carbon::parse($akad->tanggal_akad)->translatedFormat('d M Y') : ($booking->akad_date ? $booking->akad_date->translatedFormat('d M Y') : '-') }}
                                    </div>
                                    <div class="timeline-title">Akad Kredit</div>
                                    <div class="timeline-desc">
                                        Akad kredit selesai dilaksanakan (No: {{ $akad->no_akad ?? '-' }})
                                    </div>
                                </div>

                                <div class="timeline-item">
                                    <div class="timeline-date">
                                        {{ $serahTerima?->tanggal_serah_terima ? \Carbon\Carbon::parse($serahTerima->tanggal_serah_terima)->translatedFormat('d M Y') : ($booking->serah_terima_date ? $booking->serah_terima_date->translatedFormat('d M Y') : ($booking->updated_at ? $booking->updated_at->translatedFormat('d M Y') : '-')) }}
                                    </div>
                                    <div class="timeline-title">Serah Terima Unit</div>
                                    <div class="timeline-desc">
                                        Unit resmi diserahterimakan kepada customer
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="mt-3 text-center text-md-center">
                            <span class="badge badge-success p-2">
                                <i class="mdi mdi-check-circle"></i>
                                STATUS: {{ strtoupper($booking->status ?? 'SELESAI') }}
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
                                        <span> 12 Bulan (s/d {{ $serahTerima?->tanggal_serah_terima ? \Carbon\Carbon::parse($serahTerima->tanggal_serah_terima)->addYear()->translatedFormat('F Y') : \Carbon\Carbon::now()->addYear()->translatedFormat('F Y') }})</span>
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
                                        <span class="fw-bold">Sales Marketing:</span>
                                        <span> {{ $booking->sales->name ?? ($booking->sales->full_name ?? 'In-House Sales') }} ({{ $booking->sales->phone ?? ($booking->sales->no_hp ?? '-') }})</span>
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
                                        {{ $serahTerima?->catatan ?? ($akad?->catatan ?? ($booking->notes ?? 'Unit telah diserahkan kepada customer dalam kondisi baik bersama dokumen transaksi yang sah.')) }}
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
                                <a href="{{ route('marketing.jual-unit') }}" class="btn btn-outline-secondary">
                                    <i class="mdi mdi-arrow-left"></i> Kembali ke Daftar
                                </a>
                            </div>
                            <div class="action-right">
                                <button class="btn btn-outline-primary" onclick="window.print()">
                                    <i class="mdi mdi-printer"></i> Cetak
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
