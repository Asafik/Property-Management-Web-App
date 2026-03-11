@extends('layouts.partial.app')

@section('title', 'Detail Unit Terjual - Property Management App')

@section('content')
    <style>
        /* ===== STYLING SAMA PERSIS DENGAN HALAMAN SEBELUMNYA ===== */
        .card {
            transition: all 0.3s ease;
            margin-bottom: 1rem;
        }

        .card:hover {
            box-shadow: 0 8px 25px rgba(154, 85, 255, 0.1) !important;
        }

        .card-header {
            background: linear-gradient(135deg, #ffffff, #f8f9fa);
            border-bottom: 1px solid #e9ecef;
            padding: 0.75rem;
        }

        @media (min-width: 576px) {
            .card-header {
                padding: 1rem;
            }
        }

        .card-body {
            padding: 0.75rem;
        }

        @media (min-width: 576px) {
            .card-body {
                padding: 1rem;
            }
        }

        .card-title {
            font-size: 1rem;
            font-weight: 600;
            color: #9a55ff;
            margin-bottom: 0;
        }

        /* ===== SECTION TITLE ===== */
        .section-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: #9a55ff !important;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e9ecef;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .section-title i {
            color: #9a55ff;
            font-size: 1.1rem;
            background: rgba(154, 85, 255, 0.1);
            padding: 6px;
            border-radius: 8px;
        }

        /* ===== INFO BOX ===== */
        .info-box {
            background: linear-gradient(135deg, #f9f7ff, #f2ecff);
            border-radius: 12px;
            padding: 1.25rem;
            margin-bottom: 1rem;
        }

        .info-row {
            display: flex;
            margin-bottom: 0.75rem;
            align-items: baseline;
        }

        .info-label {
            width: 120px;
            font-weight: 600;
            color: #6c757d;
            font-size: 0.85rem;
        }

        .info-value {
            flex: 1;
            font-weight: 500;
            color: #2c2e3f;
            font-size: 0.95rem;
        }

        .info-value-large {
            font-size: 1.1rem;
            font-weight: 700;
            color: #28a745;
        }

        .info-badge {
            display: inline-block;
            padding: 0.35rem 0.8rem;
            background: linear-gradient(135deg, #28a745, #5cb85c);
            color: white;
            border-radius: 30px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-left: 0.5rem;
        }

        /* ===== DETAIL CARD ===== */
        .detail-card {
            border: 1px solid #e9ecef;
            border-radius: 12px;
            padding: 1.25rem;
            margin-bottom: 1rem;
            background: white;
        }

        .detail-card:hover {
            border-color: #9a55ff;
            box-shadow: 0 4px 12px rgba(154, 85, 255, 0.1);
        }

        .detail-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .detail-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #f9f7ff, #f2ecff);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .detail-icon i {
            font-size: 24px;
            color: #9a55ff;
        }

        .detail-title {
            font-size: 1rem;
            font-weight: 700;
            color: #2c2e3f;
            margin-bottom: 0.25rem;
        }

        .detail-subtitle {
            font-size: 0.8rem;
            color: #6c7383;
        }

        /* ===== STATUS BADGE ===== */
        .badge {
            padding: 0.35rem 0.6rem;
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: 30px;
            display: inline-block;
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

        /* ===== TIMELINE ===== */
        .timeline-completed {
            position: relative;
            padding-left: 2rem;
        }

        .timeline-completed::before {
            content: '';
            position: absolute;
            left: 7px;
            top: 0;
            height: 100%;
            width: 2px;
            background: linear-gradient(to bottom, #28a745, #28a745);
            opacity: 0.5;
        }

        .timeline-item {
            position: relative;
            padding-bottom: 1.5rem;
        }

        .timeline-item:last-child {
            padding-bottom: 0;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -1.3rem;
            top: 0.3rem;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #28a745;
            border: 2px solid #ffffff;
            box-shadow: 0 0 0 2px rgba(40, 167, 69, 0.3);
        }

        .timeline-date {
            font-size: 0.7rem;
            color: #28a745;
            font-weight: 600;
        }

        .timeline-title {
            font-size: 0.9rem;
            font-weight: 600;
            color: #2c2e3f;
        }

        .timeline-desc {
            font-size: 0.8rem;
            color: #6c7383;
        }

        /* ===== DOCUMENT LIST ===== */
        .document-list {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .document-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.75rem 1rem;
            background: #f8f9fa;
            border-radius: 8px;
            border-left: 4px solid #9a55ff;
        }

        .document-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .document-info i {
            font-size: 1.2rem;
            color: #9a55ff;
        }

        .document-name {
            font-weight: 500;
            color: #2c2e3f;
        }

        .btn-eye {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            background: linear-gradient(135deg, #9a55ff, #da8cff);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
        }

        /* ===== PRICE SUMMARY ===== */
        .price-summary {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 1rem;
        }

        .price-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .price-row.total {
            font-weight: 700;
            color: #28a745;
            font-size: 1.1rem;
            border-top: 1px solid #dee2e6;
            padding-top: 0.5rem;
            margin-top: 0.5rem;
        }

        /* ===== BUTTONS ===== */
        .btn {
            font-size: 0.85rem;
            padding: 0.6rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
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
        }

        .btn-outline-secondary {
            background: transparent;
            border: 1px solid #6c757d;
            color: #6c757d;
        }

        .btn-outline-secondary:hover {
            background: #6c757d;
            color: white;
        }

        .btn-success {
            background: linear-gradient(135deg, #28a745, #5cb85c);
            color: white;
        }

        /* ===== GRID ===== */
        .row-custom {
            display: flex;
            flex-wrap: wrap;
            margin-right: -0.5rem;
            margin-left: -0.5rem;
        }

        .col-custom-6 {
            position: relative;
            width: 100%;
            padding-right: 0.5rem;
            padding-left: 0.5rem;
        }

        @media (min-width: 768px) {
            .col-custom-6 {
                flex: 0 0 50%;
                max-width: 50%;
            }
        }

        /* Responsive */
        @media (max-width: 576px) {
            .info-row {
                flex-direction: column;
                gap: 0.25rem;
            }

            .info-label {
                width: 100%;
            }
        }
    </style>

    <div class="container-fluid p-2 p-sm-3 p-md-4">
        <!-- Header dengan Status TERJUAL -->
        <div class="row mb-3">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex flex-wrap align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 60px; height: 60px;">
                                    <i class="mdi mdi-check" style="font-size: 30px;"></i>
                                </div>
                                <div>
                                    <h4 class="mb-1 fw-bold text-dark">UNIT TELAH TERJUAL</h4>
                                    <p class="text-muted mb-0">
                                        <i class="mdi mdi-calendar me-1"></i> Closing: 25 Maret 2025
                                        <span class="badge badge-success ms-2">SELESAI</span>
                                    </p>
                                </div>
                            </div>
                            <div class="mt-3 mt-sm-0">
                                <span class="badge badge-success p-2" style="font-size: 1rem;">
                                    <i class="mdi mdi-home me-1"></i> {{ $unit->unit_code ?? '-' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Row: Info Unit (LENGKAP BANGET) -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="card-title">
                            <i class="mdi mdi-home-variant me-2 text-primary"></i>
                            INFORMASI UNIT YANG DIBELI
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Kiri -->
                            <div class="col-md-6">
                                <div class="info-box mb-3">
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
                            <!-- Kanan -->
                            <div class="col-md-6">
                                <div class="info-box mb-3">
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
            <!-- Kiri: Data Customer -->
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header bg-white">
                        <h5 class="card-title">
                            <i class="mdi mdi-account-circle me-2 text-primary"></i>
                            DATA CUSTOMER
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 70px; height: 70px;">
                                <i class="mdi mdi-account" style="font-size: 35px;"></i>
                            </div>
                            <div>
                                <h4 class="mb-1">{{ $unit->activeBooking->customer->full_name ?? '-' }}</h4>
                                <p class="text-muted mb-0">Booking ID: {{ $unit->activeBooking->booking_code ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="detail-card">
                            <div class="info-row">
                                <span class="info-label">NIK</span>
                                <span class="info-value">{{ $unit->activeBooking->customer->nik ?? '-' }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">NPWP</span>
                                <span class="info-value">{{ $unit->activeBooking->customer->npwp ?? '-' }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">No. HP</span>
                                <span class="info-value">{{ $unit->activeBooking->customer->phone ?? '-' }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Email</span>
                                <span class="info-value">{{ $unit->activeBooking->customer->email ?? '-' }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Alamat</span>
                                <span class="info-value">{{ $unit->activeBooking->customer->address ?? '-' }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Pekerjaan</span>
                                <span class="info-value">{{ $unit->activeBooking->customer->job_status }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kanan: Data Dokumen Final -->
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header bg-white">
                        <h5 class="card-title">
                            <i class="mdi mdi-file-document-multiple me-2 text-primary"></i>
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

                        <div class="mt-3 text-end">
                            <span class="badge badge-success p-2">
                                <i class="mdi mdi-check-circle me-1"></i> 5 Dokumen Lengkap
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Row: Rincian Harga & Riwayat -->
        <div class="row mt-3">
            <!-- Kiri: Rincian Harga Final -->
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header bg-white">
                        <h5 class="card-title">
                            <i class="mdi mdi-cash-multiple me-2 text-primary"></i>
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
                                    <span class="fw-bold">Rp {{ number_format($unit->price ?? 0, 0, ',', '.') }}</span>
                                </div>
                                <div class="price-row">
                                    <span>DP</span>
                                    <span>Rp {{ number_format($dpAmount, 0, ',', '.') }}</span>
                                </div>
                                <div class="price-row total">
                                    <span>Sisa Bayar</span>
                                    <span class="fw-bold">Rp {{ number_format($remaining, 0, ',', '.') }}</span>
                                </div>
                            @elseif($unit->purchase_type == 'kpr')
                                <!-- KPR -->
                                <div class="price-row">
                                    <span>Harga Unit</span>
                                    <span class="fw-bold">Rp {{ number_format($unit->price, 0, ',', '.') }}</span>
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
                            <!-- Info Bank / Sertifikat hanya untuk KPR -->
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

            <!-- Kanan: Riwayat Transaksi (Timeline) -->
         @php
    $purchaseType = $unit->activeBooking?->purchase_type ?? 'cash';
@endphp

<div class="col-md-6">
    <div class="card h-100">
        <div class="card-header bg-white">
            <h5 class="card-title">
                <i class="mdi mdi-timeline-text me-2 text-primary"></i>
                RIWAYAT TRANSAKSI LENGKAP
            </h5>
        </div>

        <div class="card-body">
            <div class="timeline-completed">

                {{-- ===================== CASH ===================== --}}
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

                {{-- ===================== KPR ===================== --}}
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

            <div class="mt-3 text-center">
                <span class="badge badge-success p-2">
                    <i class="mdi mdi-check-circle me-1"></i>
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
                            <i class="mdi mdi-information-outline me-2 text-primary"></i>
                            INFORMASI TAMBAHAN
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="mdi mdi-calendar-check text-success"></i>
                                    <span class="fw-bold">Masa Garansi:</span>
                                    <span>12 Bulan (s/d Maret 2026)</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="mdi mdi-tools text-primary"></i>
                                    <span class="fw-bold">Jadwal Maintenance:</span>
                                    <span>Setiap 6 bulan</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="mdi mdi-phone text-info"></i>
                                    <span class="fw-bold">CS Marketing:</span>
                                    <span>Ahmad (0812-3456-7890)</span>
                                </div>
                            </div>
                        </div>
                        <hr class="my-3">
                        <div class="row">
                            <div class="col-md-6">
                                <small class="text-muted d-block">Catatan:</small>
                                <p class="mb-0">Unit sudah diserahkan ke customer dalam kondisi baik. Kunci unit (2 set),
                                    buku STNK, dan dokumen lainnya sudah diterima customer.</p>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-body d-flex flex-wrap gap-2 justify-content-between">
                        <div>
                            <a href="#" class="btn btn-outline-secondary">
                                <i class="mdi mdi-arrow-left me-2"></i>Kembali ke Daftar
                            </a>
                        </div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-outline-primary">
                                <i class="mdi mdi-printer me-1"></i> Cetak
                            </button>
                            <button class="btn btn-success">
                                <i class="mdi mdi-download me-1"></i> Download PDF
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
