@extends('layouts.partial.app')

@section('title', 'Pembelian Cash Tenor - Properti Management')

@section('content')
<style>
/* =========================================================
   PEMBELIAN CASH TENOR / TEMPO STYLES & LAYOUT
   ========================================================= */

.transaksi-page {
    font-family: 'Nunito', 'Segoe UI', sans-serif;
    color: #2c2e3f;
}

.card {
    border-radius: 14px !important;
    border: none !important;
    box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04);
    background: #ffffff;
    transition: all 0.3s ease;
}

.card-body {
    padding: 1.5rem !important;
}

/* CUSTOMER HEADER */
.customer-header {
    width: 100%;
}

.customer-avatar {
    width: 58px;
    height: 58px;
    border-radius: 14px;
    background: linear-gradient(135deg, #da8cff, #9a55ff);
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 12px rgba(154, 85, 255, 0.25);
    flex-shrink: 0;
}

.customer-avatar i {
    font-size: 2.2rem;
    color: #ffffff;
}

.customer-name {
    font-size: 1.25rem;
    font-weight: 700;
    color: #2c2e3f;
}

.customer-booking {
    font-size: 0.88rem;
    color: #8b8fa3;
    font-weight: 600;
}

.customer-unit-info {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 1.25rem;
    background: #fbf9ff;
    border: 1px solid #ede4ff;
    padding: 0.75rem 1.25rem;
    border-radius: 12px;
}

.customer-unit-info .info-item {
    display: flex;
    flex-direction: column;
}

.customer-unit-info .info-item small {
    font-size: 0.75rem;
    color: #8b8fa3;
    font-weight: 600;
    margin-bottom: 2px;
}

.customer-unit-info .info-item span {
    font-size: 0.95rem;
    font-weight: 700;
    color: #2c2e3f;
}

/* BADGES */
.badge-cash-tenor {
    background: linear-gradient(135deg, #f59e0b, #fbbf24) !important;
    color: #ffffff !important;
    padding: 0.4rem 0.85rem;
    border-radius: 8px;
    font-size: 0.78rem;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

.badge-gradient-primary {
    background: linear-gradient(135deg, #da8cff, #9a55ff) !important;
    color: #fff !important;
    padding: 0.4rem 0.75rem;
    font-size: 0.75rem;
    border-radius: 8px;
    font-weight: 700;
}

.badge-gradient-success {
    background: linear-gradient(135deg, #28c76f, #48da89) !important;
    color: #fff !important;
    padding: 0.4rem 0.75rem;
    font-size: 0.75rem;
    border-radius: 8px;
    font-weight: 700;
}

.header-badge {
    display: inline-flex;
    align-items: center;
    padding: 0.3rem 0.7rem;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 600;
    gap: 4px;
    white-space: nowrap;
}

/* SECTION TITLES */
.transaksi-section-title {
    display: flex;
    align-items: center;
    gap: 0.55rem;
    font-size: 1.05rem;
    font-weight: 700;
    color: #2c2e3f;
    margin-bottom: 1.25rem;
    padding-bottom: 0.75rem;
    border-bottom: 1px solid #f1f3f7;
}

.transaksi-section-title i {
    font-size: 1.35rem;
    color: #9a55ff;
}

/* INLINE ALERTS */
.transaksi-inline-alert {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.85rem 1rem;
    border-radius: 10px;
    font-size: 0.88rem;
    margin-bottom: 1.25rem;
}

.transaksi-inline-alert i {
    font-size: 1.25rem;
    flex-shrink: 0;
}

.transaksi-inline-alert.info {
    background: #f3f8ff;
    border: 1px solid #dbeafe;
    color: #1d4ed8;
}

.transaksi-inline-alert.warning {
    background: #fffbeb;
    border: 1px solid #fef3c7;
    color: #b45309;
}

/* FORM CONTROLS */
.cash-form-group {
    margin-bottom: 1.15rem;
}

.cash-form-label {
    display: block;
    font-size: 0.86rem;
    font-weight: 700;
    color: #2c2e3f;
    margin-bottom: 0.45rem;
}

.cash-form-control {
    width: 100%;
    border: 1.5px solid #e2e8f0;
    border-radius: 8px;
    padding: 0.65rem 0.85rem;
    font-size: 0.88rem;
    color: #2c2e3f;
    transition: all 0.2s ease;
    background: #ffffff;
}

.cash-form-control:focus {
    border-color: #9a55ff;
    box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.15);
    outline: none;
}

.cash-form-control[readonly] {
    background-color: #f8fafc;
    color: #64748b;
    border-color: #e2e8f0;
}

select.cash-form-control {
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%239a55ff' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 0.9rem center;
    background-size: 14px;
    padding-right: 2.5rem;
}

.cash-input-group {
    display: flex;
    align-items: stretch;
    width: 100%;
}

.cash-input-group-text {
    display: flex;
    align-items: center;
    padding: 0.65rem 0.85rem;
    font-size: 0.88rem;
    font-weight: 700;
    color: #64748b;
    background-color: #f1f5f9;
    border: 1.5px solid #e2e8f0;
    border-right: none;
    border-top-left-radius: 8px;
    border-bottom-left-radius: 8px;
}

.cash-input-group .cash-form-control {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
}

/* BOX SKEMA TENOR */
.box-skema-tenor {
    background: linear-gradient(135deg, #fffdfa, #fef8ee);
    border: 1.5px solid #fde68a;
    border-radius: 12px;
    padding: 1.25rem;
    margin-top: 1rem;
    margin-bottom: 1.25rem;
}

.box-estimasi-angsuran {
    background: linear-gradient(135deg, #f5eeff, #ede4ff);
    border: 1.5px solid #d8b4fe;
    border-radius: 12px;
    padding: 1rem 1.25rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 1rem;
}

.box-estimasi-angsuran .estimasi-label {
    font-size: 0.88rem;
    font-weight: 700;
    color: #6b21a8;
}

.box-estimasi-angsuran .estimasi-value {
    font-size: 1.25rem;
    font-weight: 800;
    color: #7e22ce;
}

/* SIMULASI TABEL */
.table-simulasi-wrapper {
    max-height: 280px;
    overflow-y: auto;
    border: 1px solid #edf0f5;
    border-radius: 10px;
}

.table-simulasi {
    width: 100%;
    margin-bottom: 0;
    font-size: 0.85rem;
}

.table-simulasi thead th {
    position: sticky;
    top: 0;
    background: #f8fafc;
    color: #475569;
    font-weight: 700;
    border-bottom: 2px solid #e2e8f0;
    padding: 0.65rem 0.85rem;
    z-index: 1;
}

.table-simulasi tbody td {
    padding: 0.6rem 0.85rem;
    color: #2c2e3f;
    border-bottom: 1px solid #f1f5f9;
}

.table-simulasi tfoot td {
    position: sticky;
    bottom: 0;
    background: #f8fafc;
    font-weight: 700;
    color: #1e293b;
    border-top: 2px solid #e2e8f0;
    padding: 0.65rem 0.85rem;
}

/* MODERN FILE UPLOAD */
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
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1rem;
    background: #ffffff;
    border: 1.5px dashed #cbd5e1;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.2s ease;
}

.properti-file-upload-modern:hover .properti-file-label-modern {
    border-color: #9a55ff;
    background: #fbf9ff;
}

.properti-file-upload-modern .properti-file-label-modern i {
    font-size: 1.5rem;
    color: #9a55ff;
}

.properti-file-upload-modern .properti-file-label-modern .properti-file-info-modern {
    flex: 1;
}

.properti-file-upload-modern .properti-file-label-modern .properti-file-info-modern span {
    display: block;
    font-weight: 700;
    color: #2c2e3f;
    font-size: 0.85rem;
}

.properti-file-upload-modern .properti-file-label-modern .properti-file-info-modern small {
    color: #8b8fa3;
    font-size: 0.75rem;
    display: block;
}

.properti-file-upload-modern .properti-file-label-modern .properti-file-size {
    font-size: 0.75rem;
    color: #9a55ff;
    font-weight: 700;
    background: rgba(154, 85, 255, 0.1);
    padding: 3px 8px;
    border-radius: 6px;
}

/* SIDEBAR STYLES */
.transaksi-sticky {
    position: sticky;
    top: 20px;
}

.transaksi-detail-list {
    display: flex;
    flex-direction: column;
    gap: 0.85rem;
}

.transaksi-detail-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 0.88rem;
    padding-bottom: 0.6rem;
    border-bottom: 1px dashed #f0f2f7;
}

.transaksi-detail-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.transaksi-detail-item > span:first-child {
    color: #8b8fa3;
    font-weight: 600;
}

.transaksi-detail-item > span:last-child {
    color: #2c2e3f;
    font-weight: 700;
    text-align: right;
}

.transaksi-detail-item .highlight {
    color: #9a55ff !important;
    font-size: 0.98rem;
    font-weight: 800;
}

.transaksi-detail-item .highlight-danger {
    color: #ef4444 !important;
    font-weight: 700;
}

.transaksi-detail-item .highlight-success {
    color: #28c76f !important;
    font-weight: 800;
    font-size: 1.05rem;
}

.timeline-box-custom {
    background: #fdfbff;
    border: 1px solid #f0e6ff;
    border-radius: 10px;
    padding: 0.85rem 1rem;
    margin-top: 1rem;
}

.timeline-box-custom .timeline-title {
    font-size: 0.78rem;
    color: #64748b;
    font-weight: 600;
    margin-bottom: 4px;
}

.timeline-box-custom .timeline-val {
    font-size: 0.92rem;
    color: #2c2e3f;
    font-weight: 700;
}

.btn-proses-cash {
    background: linear-gradient(135deg, #da8cff, #9a55ff);
    color: #ffffff;
    border: none;
    padding: 0.82rem 1.25rem;
    border-radius: 12px;
    font-weight: 700;
    font-size: 0.92rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(154, 85, 255, 0.3);
    width: 100%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    cursor: pointer;
}

.btn-proses-cash:hover {
    background: linear-gradient(135deg, #c77cff, #8a45e6);
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(154, 85, 255, 0.4);
    color: #ffffff;
}

.btn-kembali-cash {
    background: #f8fafc;
    color: #475569;
    border: 1.5px solid #e2e8f0;
    padding: 0.75rem 1.25rem;
    border-radius: 12px;
    font-weight: 700;
    font-size: 0.88rem;
    transition: all 0.25s ease;
    width: 100%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    text-decoration: none;
    margin-top: 0.65rem;
}

.btn-kembali-cash:hover {
    background: #e2e8f0;
    color: #1e293b;
    text-decoration: none;
}
</style>

<div class="transaksi-page container-fluid p-0">
    <!-- Header Banner Card -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                        <div>
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <h3 class="mb-0 fw-bold" style="color: #2c2e3f;">
                                    <i class="mdi mdi-cash-clock me-2" style="color: #9a55ff; font-size: 1.8rem;"></i>
                                    Form Pembelian Cash Tempo
                                </h3>
                                <span class="badge-cash-tenor">
                                    <i class="mdi mdi-clock-outline"></i>
                                    Cash Tempo (Maks. 3 Tahun)
                                </span>
                            </div>
                            <p class="text-muted small mb-0">
                                <i class="mdi mdi-information-outline me-1" style="color: #9a55ff;"></i>
                                Pembayaran bertahap dengan jangka waktu fleksibel maksimal 36 bulan (3 tahun)
                            </p>
                        </div>
                        <div class="d-none d-md-block">
                            <i class="mdi mdi-currency-usd" style="font-size: 2.8rem; color: #9a55ff; opacity: 0.18;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Customer & Unit Summary Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="customer-header d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="customer-avatar">
                                <i class="mdi mdi-account text-white"></i>
                            </div>
                            <div>
                                <h4 class="customer-name mb-1 d-flex align-items-center gap-2">
                                    {{ $booking->customer->full_name ?? '-' }}
                                    <span class="header-badge badge-gradient-primary">
                                        <i class="mdi mdi-office-building"></i>
                                        {{ strtoupper($booking->unit->jenis ?? 'CASH TEMPO') }}
                                    </span>
                                </h4>
                                <p class="customer-booking mb-0">Id Booking: {{ $booking->booking_code ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="customer-unit-info">
                            <div class="info-item">
                                <small>Nama - Unit</small>
                                <span>{{ $booking->unit->unit_name ?? $booking->unit->landBank->name ?? '-' }} - {{ $booking->unit->unit_code ?? '-' }}</span>
                            </div>
                            <div class="info-item">
                                <small>Tipe Unit</small>
                                <span>{{ $booking->unit->type ?? '-' }}</span>
                            </div>
                            <div class="info-item">
                                <small>Harga Unit</small>
                                <span class="text-primary fw-bold">Rp {{ number_format($booking->unit->price ?? 0, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Pembelian Cash Tempo -->
    <form action="{{ route('cash-tempo.store') }}" method="POST" enctype="multipart/form-data" id="formCashTempo">
        @csrf
        <input type="hidden" name="booking_id" value="{{ $booking->id }}">
        <input type="hidden" name="diskon" id="diskon" value="0">

        <div class="row">
            <!-- Left Column: Form Details & Simulator -->
            <div class="col-12 col-lg-8 mb-4 mb-lg-0">
                <!-- Card 1: Data Customer & Unit -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="transaksi-section-title">
                            <i class="mdi mdi-account-details-outline"></i>
                            <span>Data Customer & Unit</span>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="cash-form-group">
                                    <label class="cash-form-label">Nama Customer <span class="text-danger">*</span></label>
                                    <input type="text" class="cash-form-control" value="{{ $booking->customer->full_name ?? '' }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="cash-form-group">
                                    <label class="cash-form-label">No. KTP (NIK) <span class="text-danger">*</span></label>
                                    <input type="text" class="cash-form-control" value="{{ $booking->customer->nik ?? '' }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="cash-form-group">
                                    <label class="cash-form-label">No. NPWP</label>
                                    <input type="text" class="cash-form-control" value="{{ $booking->customer->npwp ?? '-' }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="cash-form-group">
                                    <label class="cash-form-label">No. Telepon / WhatsApp <span class="text-danger">*</span></label>
                                    <input type="text" class="cash-form-control" value="{{ $booking->customer->phone ?? '' }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="cash-form-group">
                            <label class="cash-form-label">Alamat Lengkap</label>
                            <textarea class="cash-form-control" rows="2" readonly>{{ $booking->customer->address ?? '-' }}</textarea>
                        </div>

                        <hr class="my-4">

                        <!-- Detail Spesifikasi Unit -->
                        <div class="transaksi-section-title mb-3">
                            <i class="mdi mdi-home-city-outline"></i>
                            <span>Detail Spesifikasi Unit</span>
                        </div>

                        <div class="row">
                            <div class="col-6 col-md-3">
                                <div class="cash-form-group">
                                    <label class="cash-form-label">Tipe Unit</label>
                                    <input type="text" class="cash-form-control" value="{{ $booking->unit->type ?? '-' }}" readonly>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="cash-form-group">
                                    <label class="cash-form-label">Blok</label>
                                    <input type="text" class="cash-form-control" value="{{ $booking->unit->unit_code ?? '-' }}" readonly>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="cash-form-group">
                                    <label class="cash-form-label">No. Unit</label>
                                    <input type="text" class="cash-form-control" value="{{ $booking->unit->unit_number ?? '-' }}" readonly>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="cash-form-group">
                                    <label class="cash-form-label">Luas T/B</label>
                                    <input type="text" class="cash-form-control" value="{{ $booking->unit->area ?? 0 }} m² / {{ $booking->unit->building_area ?? 0 }} m²" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Skema & Simulasi Pembayaran Cash Tempo -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="transaksi-section-title">
                            <i class="mdi mdi-calculator-variant-outline"></i>
                            <span>Skema & Simulasi Pembayaran Cash Tempo</span>
                        </div>

                        <div class="transaksi-inline-alert info">
                            <i class="mdi mdi-information-outline"></i>
                            <div>Tentukan tenor angsuran (maks. 36 bulan) dan uang muka (minimal 20% dari harga unit setelah diskon).</div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="cash-form-group">
                                    <label class="cash-form-label">Harga Unit <span class="text-danger">*</span></label>
                                    <div class="cash-input-group">
                                        <span class="cash-input-group-text">Rp</span>
                                        <input type="number" class="cash-form-control" id="hargaUnit" name="harga_unit" value="{{ $booking->unit->price ?? 0 }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="cash-form-group">
                                    <label class="cash-form-label">Promo / Diskon Developer</label>
                                    <select class="cash-form-control" name="promo_id" id="promoSelect">
                                        <option value="" data-nominal="0">-- Tanpa Promo / Diskon --</option>
                                        @foreach ($promos as $promo)
                                            <option value="{{ $promo->id }}" data-nominal="{{ $promo->value ?? 0 }}">
                                                {{ $promo->name }} (Potongan Rp {{ number_format($promo->value ?? 0, 0, ',', '.') }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="cash-form-group">
                                    <label class="cash-form-label">Booking Fee (Uang Tanda Jadi) <span class="text-danger">*</span></label>
                                    <div class="cash-input-group">
                                        <span class="cash-input-group-text">Rp</span>
                                        <input type="number" class="cash-form-control" id="bookingFee" name="booking_fee" value="{{ $booking->booking_fee ?? 0 }}" required>
                                    </div>
                                    <small class="text-muted mt-1 d-block" style="font-size: 0.75rem;">Termasuk dalam total uang muka yang dibayarkan customer</small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="cash-form-group">
                                    <label class="cash-form-label">Metode Pembayaran <span class="text-danger">*</span></label>
                                    <select class="cash-form-control" id="metodePembayaran" name="metode_pembayaran" required>
                                        <option value="">-- Pilih Metode Pembayaran --</option>
                                        <option value="transfer" selected>Transfer Bank</option>
                                        <option value="cash">Cash (Tunai)</option>
                                        <option value="giro">Cek / Bilyet Giro</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Skema Tenor Box -->
                        <div class="box-skema-tenor">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <i class="mdi mdi-calendar-clock text-warning" style="font-size: 1.3rem;"></i>
                                <span class="fw-bold" style="color: #92400e;">Konfigurasi Tenor & Angsuran</span>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="cash-form-group">
                                        <label class="cash-form-label">Jangka Waktu Tenor <span class="text-danger">*</span></label>
                                        <select class="cash-form-control" id="jangkaTenor" name="tenor_bulan" required>
                                            <option value="6">6 Bulan</option>
                                            <option value="12" selected>12 Bulan (1 Tahun)</option>
                                            <option value="18">18 Bulan (1.5 Tahun)</option>
                                            <option value="24">24 Bulan (2 Tahun)</option>
                                            <option value="30">30 Bulan (2.5 Tahun)</option>
                                            <option value="36">36 Bulan (3 Tahun)</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="cash-form-group">
                                        <label class="cash-form-label">Uang Muka (DP) <span class="text-danger">*</span></label>
                                        <div class="cash-input-group">
                                            <span class="cash-input-group-text">Rp</span>
                                            <input type="number" class="cash-form-control" id="uangMuka" name="dp" value="{{ $booking->booking_fee ?? 0 }}" required>
                                        </div>
                                        <small class="text-danger d-block mt-1" id="dpWarning" style="font-size: 0.75rem;"></small>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="cash-form-group">
                                        <label class="cash-form-label">Sisa Angsuran Pokok</label>
                                        <div class="cash-input-group">
                                            <span class="cash-input-group-text">Rp</span>
                                            <input type="number" class="cash-form-control" id="sisaAngsuran" name="sisa_pembayaran" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="cash-form-group">
                                        <label class="cash-form-label">Tanggal Mulai Angsuran <span class="text-danger">*</span></label>
                                        <input type="date" class="cash-form-control" id="tanggalMulaiAngsuran" name="tanggal_mulai_angsuran" value="{{ date('Y-m-d') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="cash-form-group">
                                        <label class="cash-form-label">Jatuh Tempo Akhir</label>
                                        <input type="date" class="cash-form-control" id="jatuhTempoAkhir" name="tanggal_jatuh_tempo_akhir" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="cash-form-group">
                                        <label class="cash-form-label">Denda Keterlambatan (%)</label>
                                        <div class="cash-input-group">
                                            <span class="cash-input-group-text">%</span>
                                            <input type="number" class="cash-form-control" id="denda" name="denda_persen" value="2" step="0.1" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Box Highlight Angsuran / Bulan -->
                            <div class="box-estimasi-angsuran">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="mdi mdi-cash-multiple" style="font-size: 1.5rem; color: #7e22ce;"></i>
                                    <div>
                                        <div class="estimasi-label">Estimasi Angsuran Pokok / Bulan</div>
                                        <small class="text-muted" id="estimasiTenorInfo">12 Kali Pembayaran</small>
                                    </div>
                                </div>
                                <div class="estimasi-value" id="estimasiAngsuranDisplay">Rp 0</div>
                            </div>
                        </div>

                        <!-- Simulasi Tabel Angsuran -->
                        <div class="mt-4">
                            <label class="fw-bold mb-2 d-flex align-items-center gap-2" style="font-size: 0.92rem; color: #2c2e3f;">
                                <i class="mdi mdi-table-clock text-primary" style="font-size: 1.25rem;"></i>
                                <span>Jadwal Rincian Angsuran (<span id="tenorText">12 Bulan</span>)</span>
                            </label>

                            <div class="table-simulasi-wrapper">
                                <table class="table table-hover table-simulasi" id="tabelAngsuran">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 15%;">Bulan Ke-</th>
                                            <th style="width: 30%;">Jatuh Tempo</th>
                                            <th style="width: 30%;">Nominal Angsuran</th>
                                            <th style="width: 25%;">Sisa Pokok</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyAngsuran">
                                        <!-- Diisi otomatis oleh JavaScript -->
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2" class="text-end">Total Sisa Pokok:</td>
                                            <td id="totalAngsuran" class="text-primary font-monospace fw-bold">Rp 0</td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Upload Dokumen Pendukung -->
                <div class="card">
                    <div class="card-body">
                        <div class="transaksi-section-title">
                            <i class="mdi mdi-file-document-multiple-outline"></i>
                            <span>Upload Dokumen Pendukung</span>
                        </div>

                        <p class="text-muted small mb-3">Dokumen verifikasi untuk pengajuan pembelian cash tempo.</p>

                        @php
                            $uploadFields = [
                                'KTP' => 'KTP Customer',
                                'NPWP' => 'NPWP',
                                'Surat Perjanjian' => 'Surat Perjanjian Cash Tempo',
                            ];
                            $documents = $booking->customer->documents ?? collect();
                        @endphp

                        <div class="row">
                            @foreach ($uploadFields as $docName => $label)
                                @php
                                    $file = $documents->first(function($d) use ($docName) {
                                        return strtolower($d->document_name) == strtolower($docName);
                                    });
                                @endphp

                                <div class="col-12 col-md-6 mb-3">
                                    <div class="cash-form-group">
                                        <label class="cash-form-label">{{ $label }}</label>

                                        @if ($file)
                                            <div class="border p-3 rounded d-flex align-items-center justify-content-between" style="background: #f0fdf4; border-color: #bbf7d0 !important;">
                                                <div class="d-flex align-items-center gap-2">
                                                    <i class="mdi mdi-check-decagram text-success" style="font-size: 1.4rem;"></i>
                                                    <div>
                                                        <span class="d-block fw-bold text-success" style="font-size: 0.85rem;">Sudah Terupload</span>
                                                        <small class="text-muted">Dari data master customer</small>
                                                    </div>
                                                </div>
                                                <a href="{{ asset('storage/' . $file->file) }}" target="_blank" class="btn btn-sm btn-outline-success">
                                                    <i class="mdi mdi-eye me-1"></i>Lihat
                                                </a>
                                            </div>
                                        @else
                                            <div class="properti-file-upload-modern">
                                                <input type="file" name="{{ Str::slug($docName, '_') }}" accept=".jpg,.jpeg,.png,.pdf">
                                                <div class="properti-file-label-modern">
                                                    <i class="mdi mdi-cloud-upload"></i>
                                                    <div class="properti-file-info-modern">
                                                        <span>Upload {{ $label }}</span>
                                                        <small>Format: PDF, JPG, PNG (Max: 2MB)</small>
                                                    </div>
                                                    <span class="properti-file-size"></span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Sticky Summary & Action -->
            <div class="col-12 col-lg-4">
                <div class="transaksi-sticky">
                    <div class="card">
                        <div class="card-body">
                            <div class="transaksi-section-title">
                                <i class="mdi mdi-receipt-text-outline"></i>
                                <span>Ringkasan Pembayaran</span>
                            </div>

                            <div class="transaksi-detail-list">
                                <div class="transaksi-detail-item">
                                    <span>Harga Unit</span>
                                    <span id="totalHargaDisplay">Rp 0</span>
                                </div>
                                <div class="transaksi-detail-item">
                                    <span>Diskon / Promo</span>
                                    <span class="highlight-danger" id="diskonDisplay">- Rp 0</span>
                                </div>
                                <div class="transaksi-detail-item">
                                    <span>Harga Setelah Diskon</span>
                                    <span class="highlight" id="hargaNettoDisplay">Rp 0</span>
                                </div>
                                <div class="transaksi-detail-item">
                                    <span>Booking Fee</span>
                                    <span id="bookingFeeDisplay">Rp 0</span>
                                </div>
                                <div class="transaksi-detail-item">
                                    <span>Uang Muka (DP)</span>
                                    <span class="highlight" id="dpDisplay">Rp 0</span>
                                </div>
                                <div class="transaksi-detail-item">
                                    <span>Total Sisa Pokok</span>
                                    <span class="highlight-success" id="sisaBayarDisplay">Rp 0</span>
                                </div>
                            </div>

                            <!-- Timeline Preview Box -->
                            <div class="timeline-box-custom">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="mdi mdi-timeline-clock-outline text-primary"></i>
                                    <span class="fw-bold" style="font-size: 0.85rem; color: #2c2e3f;">Periode Angsuran</span>
                                </div>
                                <div class="timeline-title">Jangka Waktu</div>
                                <div class="timeline-val mb-2" id="timelineAngsuran">Angsuran 1 - 12 Bulan</div>
                                <div class="timeline-title">Rentang Periode</div>
                                <div class="timeline-val mb-2" id="timelinePeriode">-</div>
                                <div class="timeline-title">Skema Pembayaran</div>
                                <div class="timeline-val text-primary" id="timelineNominal">12 x Rp 0</div>
                            </div>

                            <hr class="my-4">

                            <!-- Submit Buttons -->
                            <button type="submit" class="btn-proses-cash" id="btnProses">
                                <i class="mdi mdi-check-circle-outline"></i>
                                Proses Cash Tenor
                            </button>

                            <a href="{{ url()->previous() }}" class="btn-kembali-cash">
                                <i class="mdi mdi-arrow-left"></i>
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            // 1. File Upload Label & Size Preview
            $('.properti-file-upload-modern input[type="file"]').change(function(e) {
                const file = e.target.files[0];
                const $container = $(this).closest('.properti-file-upload-modern');
                const label = $container.find('.properti-file-info-modern span');
                const sizeSpan = $container.find('.properti-file-size');

                if (file) {
                    const fileName = file.name;
                    const fileSize = (file.size / (1024 * 1024)).toFixed(2);
                    label.text(fileName.length > 25 ? fileName.substring(0, 25) + '...' : fileName);
                    sizeSpan.text(fileSize + ' MB').show();
                } else {
                    label.text('Pilih Dokumen');
                    sizeSpan.text('').hide();
                }
            });

            // 2. Format & Parse Rupiah (Robust terhadap integer, float database .00, string)
            function parseRupiah(val) {
                if (val === undefined || val === null || val === '') return 0;
                if (typeof val === 'number') return val;
                var str = val.toString().trim();
                // Jika numeric murni (cth: "400000000" atau "400000000.00")
                if (!isNaN(str) && !isNaN(parseFloat(str))) {
                    return parseFloat(str);
                }
                // Jika berformat rupiah dengan pemisah titik/koma (cth: "400.000.000")
                str = str.replace(/[^0-9]/g, '');
                return parseFloat(str) || 0;
            }

            function formatRupiah(angka) {
                if (angka === undefined || angka === null || isNaN(angka)) return '0';
                return Math.round(angka).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            // 3. Master Calculation Function (Menghitung Total, Tenor, Tabel Angsuran, Sidebar & Highlight)
            function hitungSemua() {
                var hargaUnit = parseRupiah($('#hargaUnit').val());
                var selectedPromo = $('#promoSelect').find(':selected');
                var diskon = parseFloat(selectedPromo.data('nominal')) || parseRupiah($('#diskon').val()) || 0;
                $('#diskon').val(diskon);

                var bookingFee = parseRupiah($('#bookingFee').val());
                var uangMuka = parseRupiah($('#uangMuka').val());
                var jangkaTenor = parseInt($('#jangkaTenor').val()) || 12;
                var tanggalMulai = $('#tanggalMulaiAngsuran').val() || new Date().toISOString().slice(0, 10);

                var hargaSetelahDiskon = Math.max(0, hargaUnit - diskon);
                var minimalDP = hargaSetelahDiskon * 0.20;

                // Tampilkan info validasi DP minimal 20%
                if (uangMuka < minimalDP) {
                    $('#dpWarning').html('<i class="mdi mdi-alert-circle-outline me-1"></i>Min. DP 20%: Rp ' + formatRupiah(minimalDP));
                } else {
                    $('#dpWarning').html('');
                }

                var sisaAngsuran = Math.max(0, hargaSetelahDiskon - uangMuka);
                $('#sisaAngsuran').val(sisaAngsuran);

                var angsuranPerBulan = (jangkaTenor > 0 && sisaAngsuran > 0) ? Math.floor(sisaAngsuran / jangkaTenor) : 0;

                // Update Box Highlight Estimasi
                $('#estimasiAngsuranDisplay').text('Rp ' + formatRupiah(angsuranPerBulan) + ' / Bln');
                $('#estimasiTenorInfo').text(jangkaTenor + ' Kali Pembayaran');
                $('#tenorText').text(jangkaTenor + ' Bulan');

                // Update Sidebar Display
                $('#totalHargaDisplay').text('Rp ' + formatRupiah(hargaUnit));
                $('#diskonDisplay').text('- Rp ' + formatRupiah(diskon));
                $('#hargaNettoDisplay').text('Rp ' + formatRupiah(hargaSetelahDiskon));
                $('#bookingFeeDisplay').text('Rp ' + formatRupiah(bookingFee));
                $('#dpDisplay').text('Rp ' + formatRupiah(uangMuka));
                $('#sisaBayarDisplay').text('Rp ' + formatRupiah(sisaAngsuran));

                // Update Timeline Box
                var dateMulai = new Date(tanggalMulai);
                var dateAkhir = new Date(tanggalMulai);
                dateAkhir.setMonth(dateAkhir.getMonth() + (jangkaTenor - 1));

                var bulanMulai = dateMulai.toLocaleDateString('id-ID', { month: 'short', year: 'numeric' });
                var bulanAkhir = dateAkhir.toLocaleDateString('id-ID', { month: 'short', year: 'numeric' });

                $('#timelineAngsuran').text('Angsuran 1 - ' + jangkaTenor + ' Bulan');
                $('#timelinePeriode').text(bulanMulai + ' s/d ' + bulanAkhir);
                $('#timelineNominal').text(jangkaTenor + ' x Rp ' + formatRupiah(angsuranPerBulan));

                // Update Input Jatuh Tempo Akhir
                var jatuhTempoAkhirDate = new Date(tanggalMulai);
                jatuhTempoAkhirDate.setMonth(jatuhTempoAkhirDate.getMonth() + jangkaTenor);
                var yyyy = jatuhTempoAkhirDate.getFullYear();
                var mm = ('0' + (jatuhTempoAkhirDate.getMonth() + 1)).slice(-2);
                var dd = ('0' + jatuhTempoAkhirDate.getDate()).slice(-2);
                $('#jatuhTempoAkhir').val(yyyy + '-' + mm + '-' + dd);

                // Generate Tabel Rincian Angsuran
                var sisa = sisaAngsuran;
                var tbody = '';

                for (var i = 1; i <= jangkaTenor; i++) {
                    var tgl = new Date(tanggalMulai);
                    tgl.setMonth(tgl.getMonth() + (i - 1));

                    var options = { day: 'numeric', month: 'short', year: 'numeric' };
                    var tanggalFormatted = tgl.toLocaleDateString('id-ID', options);

                    var angsuranBulanIni = (i === jangkaTenor) ? sisa : angsuranPerBulan;
                    sisa -= angsuranBulanIni;

                    tbody += '<tr>' +
                        '<td class="text-center"><span class="badge bg-light text-dark fw-bold">' + i + '</span></td>' +
                        '<td>' + tanggalFormatted + '</td>' +
                        '<td class="fw-bold text-primary">Rp ' + formatRupiah(angsuranBulanIni) + '</td>' +
                        '<td class="text-muted">Rp ' + formatRupiah(Math.max(sisa, 0)) + '</td>' +
                        '</tr>';
                }

                $('#tbodyAngsuran').html(tbody);
                $('#totalAngsuran').text('Rp ' + formatRupiah(sisaAngsuran));
            }

            // 4. Event Listeners untuk semua input terkait perhitungan
            $('#hargaUnit, #uangMuka, #bookingFee, #diskon').on('input keyup change', function() {
                hitungSemua();
            });

            $('#promoSelect, #jangkaTenor, #tanggalMulaiAngsuran').on('change', function() {
                hitungSemua();
            });

            // 5. Initial Execution on Page Load
            hitungSemua();

            // 8. SweetAlert Notifications
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#9a55ff',
                    timer: 3500,
                    timerProgressBar: true
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Perhatian!',
                    text: '{{ session('error') }}',
                    confirmButtonColor: '#ff4747'
                });
            @endif

            // 9. Intercept Submit Form
            $('#formCashTempo').on('submit', function(e) {
                e.preventDefault();
                const form = this;

                var hargaUnit = parseRupiah($('#hargaUnit').val());
                var diskon = parseRupiah($('#diskon').val());
                var uangMuka = parseRupiah($('#uangMuka').val());
                var hargaSetelahDiskon = hargaUnit - diskon;
                var minimalDP = hargaSetelahDiskon * 0.20;

                if (uangMuka < minimalDP) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'DP Kurang dari 20%',
                        text: 'Uang Muka (DP) minimal adalah Rp ' + formatRupiah(minimalDP) + ' (20% dari harga setelah diskon).',
                        confirmButtonColor: '#9a55ff'
                    });
                    return false;
                }

                if (!$('#metodePembayaran').val()) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Metode Pembayaran Kosong',
                        text: 'Silakan pilih metode pembayaran terlebih dahulu.',
                        confirmButtonColor: '#9a55ff'
                    });
                    return false;
                }

                Swal.fire({
                    title: 'Proses Cash Tenor?',
                    text: 'Jadwal angsuran akan dibuat dan status transaksi akan diproses.',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#9a55ff',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Proses Sekarang',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Sedang Memproses...',
                            text: 'Mohon tunggu sebentar...',
                            allowOutsideClick: false,
                            showConfirmButton: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush
