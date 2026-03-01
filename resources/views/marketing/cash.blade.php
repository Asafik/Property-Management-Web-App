@extends('layouts.partial.app')

@section('title', 'Cash Keras - Properti Management')

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/marketing/cash.css') }}">

    <div class="row">
        <div class="col-12">
            <!-- Header Info Customer -->
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center gap-3">
                        <!-- Avatar -->
                        <div class="flex-shrink-0">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 50px; height: 50px;">
                                <i class="mdi mdi-account" style="font-size: 24px;"></i>
                            </div>
                        </div>

                        <!-- Info Customer -->
                        <div class="flex-grow-1">
                            <h4 class="mb-1">
                                {{ $booking->customer->full_name ?? '-' }}
                            </h4>
                            <p class="text-muted mb-0">
                                Booking ID: {{ $booking->booking_code ?? '-' }}
                            </p>
                        </div>

                        <!-- Info Unit -->
                        <div class="mt-3 mt-sm-0">
                            <div class="d-flex flex-wrap gap-3">
                                <div>
                                    <small class="text-muted d-block">Unit</small>
                                    <span class="fw-medium">{{ $booking->unit->landBank->name ?? '-' }} -
                                        {{ $booking->unit->type ?? '-' }}</span>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Blok/No</small>
                                    <span class="fw-medium">{{ $booking->unit->unit_code }}</span>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Harga Unit</small>
                                    <span class="fw-medium text-primary">Rp
                                        {{ number_format($booking->unit->price ?? 0, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Row untuk Pilihan Skenario (DEMO PURPOSES) -->
    <div class="row mt-3">
        <div class="col-12">
            <div class="cash-card bg-light">
                <div class="card-body py-3">
                    <div class="d-flex align-items-center flex-wrap gap-2">
                        <div class="cash-btn-group">
                            <button type="button" class="cash-btn cash-btn-sm cash-btn-success active" id="btnCashAwal">
                                <i class="mdi mdi-cash me-1"></i>Cash Awal
                            </button>
                            <button type="button" class="cash-btn cash-btn-sm cash-btn-warning" id="btnKonversi">
                                <i class="mdi mdi-bank-off me-1"></i>Konversi dari KPR
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Row untuk Status dan Info -->
    <div class="row mt-4">
        <!-- Kolom Kiri: Info Pembayaran -->
        <div class="col-12 col-lg-8 mb-4 mb-lg-0">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="mdi mdi-cash-multiple me-2 text-primary"></i>
                        <span id="titleCash">Cash Keras - Lunas Langsung</span>
                    </h5>

                    <!-- ALERT SKENARIO 1: CASH AWAL -->
                    <div class="cash-alert cash-alert-success" id="alertCashAwal">
                        <div class="d-flex align-items-center">
                            <i class="mdi mdi-check-circle me-3" style="font-size: 24px;"></i>
                            <div>
                                <strong>Cash Keras</strong> - Customer membayar lunas langsung (bisa nego)
                            </div>
                        </div>
                    </div>

                    <!-- ALERT SKENARIO 2: KONVERSI DARI KPR -->
                    <div class="cash-alert cash-alert-warning" id="alertKonversi" style="display: none;">
                        <div class="d-flex">
                            <i class="mdi mdi-information-outline me-3" style="font-size: 24px;"></i>
                            <div>
                                <strong>Konversi dari KPR ke Cash Keras</strong> - KPR ditolak, pindah ke cash lunas
                                <div class="mt-2 p-2 bg-white rounded">
                                    <small class="d-block"><span class="fw-medium">Alasan Penolakan:</span> BI Checking /
                                        SLIK bermasalah (Rating kurang)</small>
                                    <small class="d-block"><span class="fw-medium">Bank:</span> Bank ABC Syariah</small>
                                    <small class="d-block"><span class="fw-medium">Tanggal Penolakan:</span> 25 Februari
                                        2025</small>
                                    <button class="cash-btn cash-btn-outline-primary mt-2"
                                        style="width: auto; padding: 0.25rem 0.75rem; font-size: 0.75rem;">
                                        <i class="mdi mdi-file-pdf me-1"></i>Lihat Surat Penolakan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- FORM NEGO HARGA -->
                    <div class="cash-card bg-light mb-4">
                        <div class="card-body">
                            <h6 class="cash-text-primary mb-3">
                                <i class="mdi mdi-tag-multiple me-2"></i>
                                Informasi Harga & Negosiasi
                            </h6>

                            <form action="{{ route('bookings.updateNego', $booking->id) }}" method="POST"
                                id="formNegoHarga">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="cash-form-group">
                                            <label>Harga Unit</label>
                                            <div class="cash-input-group">
                                                <div class="cash-input-group-prepend">
                                                    <span class="cash-input-group-text">Rp</span>
                                                </div>
                                                <input type="text" class="cash-form-control" id="hargaUnit"
                                                    value="{{ number_format($booking->unit->price ?? 0, 0, ',', '.') }}"
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="cash-form-group">
                                            <label>Harga Nego / Kesepakatan</label>
                                            <div class="cash-input-group">
                                                <div class="cash-input-group-prepend">
                                                    <span class="cash-input-group-text">Rp</span>
                                                </div>
                                                <input type="text" class="cash-form-control" id="hargaNego"
                                                    name="harga_nego"
                                                    value="{{ number_format($booking->harga_nego ?? 0, 0, ',', '.') }}">
                                            </div>
                                            <small class="cash-text-muted">Masukkan harga final setelah negosiasi</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <div class="cash-form-group">
                                            <label>Booking Fee (Sudah Dibayar)</label>
                                            <div class="cash-input-group">
                                                <div class="cash-input-group-prepend">
                                                    <span class="cash-input-group-text">Rp</span>
                                                </div>
                                                <input type="text" class="cash-form-control" id="bookingFee"
                                                    value="{{ number_format($booking->booking_fee ?? 0, 0, ',', '.') }}"
                                                    readonly>
                                            </div>
                                            <small class="cash-text-muted">Akan dipotong dari total pembayaran</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="cash-card bg-light mb-3">
                                    <div class="card-body">
                                        <h6 class="cash-text-primary mb-3">
                                            <i class="mdi mdi-ticket-percent me-2"></i>
                                            Gunakan Promo
                                        </h6>

                                        <div class="cash-form-group">
                                            <select class="cash-form-control" name="promo_id" id="promoSelect">
                                                <option value="">-- Tanpa Promo --</option>

                                                @foreach ($promos as $promo)
                                                    <option value="{{ $promo->id }}" data-type="{{ $promo->type }}"
                                                        data-value="{{ $promo->value }}">

                                                        {{ $promo->name }} -

                                                        @if ($promo->type == 'persen')
                                                            {{ $promo->value }}%
                                                        @elseif (is_numeric($promo->value))
                                                            Rp {{ number_format((float) $promo->value, 0, ',', '.') }}
                                                        @else
                                                            {{ $promo->value }}
                                                        @endif

                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- Summary Diskon & Total -->
                                <div class="row mt-2">
                                    <div class="col-md-4">
                                        <div class="cash-card border-success">
                                            <div class="card-body p-2">
                                                <small class="cash-text-muted d-block">Diskon</small>
                                                <span class="fw-bold cash-text-success" id="diskonValue">Rp
                                                    15.000.000</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="cash-card border-primary">
                                            <div class="card-body p-2">
                                                <small class="cash-text-muted d-block">Persentase Diskon</small>
                                                <span class="fw-bold cash-text-primary" id="diskonPersen">3.33%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="cash-card border-danger">
                                            <div class="card-body p-2">
                                                <small class="cash-text-muted d-block">Total Bayar</small>
                                                <span class="fw-bold cash-text-danger" id="totalBayar">Rp 0</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="cash-alert cash-alert-info mt-3 mb-3">
                                    <i class="mdi mdi-information-outline me-2"></i>
                                    <strong>Cash Keras:</strong> Customer akan membayar lunas
                                    <strong id="totalBayarAlert">Rp 0</strong> (setelah nego)
                                </div>

                                <!-- BUTTON SUBMIT NEGOSIASI -->
                                <div class="text-end">
                                    <button type="submit" class="cash-btn cash-btn-primary">
                                        <i class="mdi mdi-content-save me-2"></i> Simpan Negosiasi
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- SECTION KHUSUS SKENARIO 2: BIAYA HANGUS -->
                    <div class="cash-card bg-warning-subtle mt-3" id="biayaHangus" style="display: none;">
                        <div class="card-body">
                            <h6 class="text-warning mb-2">
                                <i class="mdi mdi-alert-circle me-1"></i>
                                Biaya KPR yang Tidak Kembali (Hangus)
                            </h6>
                            <div class="row">
                                <div class="col-md-4">
                                    <small class="cash-text-muted d-block">Biaya Survey</small>
                                    <span class="fw-medium">Rp 500.000</span>
                                </div>
                                <div class="col-md-4">
                                    <small class="cash-text-muted d-block">Biaya Provisi</small>
                                    <span class="fw-medium">Rp 3.600.000</span>
                                </div>
                                <div class="col-md-4">
                                    <small class="cash-text-muted d-block">Total Hangus</small>
                                    <span class="fw-bold cash-text-danger">Rp 4.100.000</span>
                                </div>
                            </div>
                            <small class="cash-text-muted d-block mt-2">*Biaya ini sudah dikeluarkan dan tidak dapat
                                dikembalikan</small>
                        </div>
                    </div>

                    <hr class="my-3">

                    <!-- Form Input Pembayaran Lunas -->
                    <h6 class="cash-text-primary mb-3">Form Pembayaran Lunas</h6>

                    <form action="{{ route('payments.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                        <input type="hidden" name="type" value="pelunasan">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="cash-form-group">
                                    <label>Tanggal Pembayaran</label>
                                    <input type="date" class="cash-form-control" name="payment_date"
                                        value="2025-03-25" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="cash-form-group">
                                    <label>Jumlah Dibayar</label>
                                    <div class="cash-input-group">
                                        <div class="cash-input-group-prepend">
                                            <span class="cash-input-group-text">Rp</span>
                                        </div>
                                        <input type="text" class="cash-form-control" name="amount" id="jumlahBayar"
                                            value="435000000" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="cash-form-group">
                                    <label>Metode Pembayaran</label>
                                    <select class="cash-form-control" name="method" required>
                                        <option value="Transfer Bank">Transfer Bank</option>
                                        <option value="Tunai">Tunai</option>
                                        <option value="Kartu Kredit">Kartu Kredit</option>
                                        <option value="Virtual Account">Virtual Account</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-6">
                                <div class="cash-form-group">
                                    <label>Keterangan</label>
                                    <input type="text" class="cash-form-control" name="notes" id="keteranganBayar"
                                        value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="cash-form-group">
                                    <label>Upload Bukti Transfer</label>
                                    <div class="cash-file-upload-modern">
                                        <input type="file" id="uploadBukti" name="reference_number"
                                            accept=".jpg,.jpeg,.png,.pdf">
                                        <div class="cash-file-label-modern">
                                            <i class="mdi mdi-cloud-upload"></i>
                                            <div class="cash-file-info-modern">
                                                <span>Upload Bukti Transfer</span>
                                                <small>Format: JPG, PNG, PDF (Max 5MB)</small>
                                            </div>
                                            <span class="cash-file-size"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button class="cash-btn cash-btn-success btn-lg mt-3 w-100" id="btnProsesBayar">
                            <i class="mdi mdi-check-circle me-2"></i>
                            Proses Pembayaran Lunas
                        </button>
                    </form>

                    <!-- Informasi Tambahan untuk Mobile -->
                    <div class="text-muted small mt-2 d-block d-sm-none">
                        <i class="mdi mdi-information-outline me-1"></i>
                        Geser untuk melihat konten lainnya
                    </div>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Info & Aksi -->
        <div class="col-12 col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="mdi mdi-information me-2 text-primary"></i>
                        Ringkasan Transaksi
                    </h5>

                    <!-- Status Badge - Berubah sesuai skenario -->
                    <!-- Badge Status -->
                    <div class="text-center mb-4" id="badgeCashAwal">
                        <span class="cash-badge cash-badge-success" style="font-size: 14px;">
                            <i class="mdi mdi-check-circle me-1"></i>
                            Cash Keras - Belum Lunas
                        </span>
                    </div>
                    <div class="text-center mb-4" id="badgeKonversi" style="display: none;">
                        <span class="cash-badge cash-badge-warning" style="font-size: 14px;">
                            <i class="mdi mdi-bank-off me-1"></i>
                            Konversi KPR - Cash Keras
                        </span>
                    </div>

                    <!-- Ringkasan Transaksi -->
                    <div class="mb-4 cash-summary-card">
                        <table class="cash-table">
                            <tr>
                                <td>Harga Unit</td>
                                <td class="text-end" id="hargaUnitView">Rp 0</td>
                            </tr>
                            <tr>
                                <td>Harga Nego</td>
                                <td class="text-end cash-text-primary" id="hargaNegoView">Rp 0</td>
                            </tr>
                            <tr>
                                <td>Diskon</td>
                                <td class="text-end cash-text-success" id="diskonView">- Rp 0</td>
                            </tr>
                            <tr class="fw-bold">
                                <td>TOTAL LUNAS</td>
                                <td class="text-end cash-text-danger" id="totalLunasView">Rp 0</td>
                            </tr>
                        </table>
                    </div>

                    <hr class="my-3">

                    <!-- Timeline Transaksi -->
                    <h6 class="cash-text-primary mb-3">Timeline Transaksi</h6>
                    <div class="cash-timeline">
                        <!-- Booking Unit -->
                        <div class="cash-timeline-item">
                            <div class="cash-timeline-icon">
                                <i class="mdi mdi-check-circle text-success"></i>
                            </div>
                            <div class="cash-timeline-content">
                                <span class="cash-timeline-title">Booking Unit</span>
                                <span class="cash-timeline-date">
                                    {{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('l, d F Y') }}
                                </span>
                            </div>
                        </div>

                        <!-- Negosiasi Harga -->
                        @if ($booking->harga_unit != $booking->harga_nego)
                            <div class="cash-timeline-item">
                                <div class="cash-timeline-icon">
                                    <i class="mdi mdi-check-circle text-success"></i>
                                </div>
                                <div class="cash-timeline-content">
                                    <span class="cash-timeline-title">Negosiasi Harga</span>
                                    <span class="cash-timeline-date">
                                        {{ \Carbon\Carbon::parse($booking->updated_at)->translatedFormat('l, d F Y') }}
                                        - Diskon
                                        {{ 'Rp ' . number_format($booking->unit->price - $booking->harga_nego, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        @endif

                        <!-- Semua Pembayaran -->
                        @foreach ($booking->payments->sortBy('payment_date') as $payment)
                            <div class="cash-timeline-item">
                                <div class="cash-timeline-icon">
                                    @if ($payment->payment_date)
                                        <i class="mdi mdi-check-circle text-success"></i>
                                    @else
                                        <i class="mdi mdi-clock-outline text-warning"></i>
                                    @endif
                                </div>
                                <div class="cash-timeline-content">
                                    <span class="cash-timeline-title">
                                        @switch($payment->type)
                                            @case('booking_fee')
                                                Booking Fee
                                            @break

                                            @case('dp')
                                                DP
                                            @break

                                            @case('cicilan')
                                                Cicilan
                                            @break

                                            @case('pelunasan')
                                                Pelunasan
                                            @break
                                        @endswitch
                                    </span>
                                    <span class="cash-timeline-date">
                                        {{ $payment->payment_date ? \Carbon\Carbon::parse($payment->payment_date)->translatedFormat('l, d F Y') : 'Menunggu pembayaran' }}
                                        - {{ 'Rp ' . number_format($payment->amount, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <hr class="my-3">

                    <!-- Dokumen Penting -->
                    <h6 class="cash-text-primary mb-3">Dokumen</h6>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span>Surat Perjanjian Cash</span>
                            <button class="cash-btn cash-btn-outline-primary"
                                style="width: auto; padding: 0.25rem 0.75rem;">
                                <i class="mdi mdi-download"></i>
                            </button>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span>Bukti Negosiasi Harga</span>
                            <button class="cash-btn cash-btn-outline-primary"
                                style="width: auto; padding: 0.25rem 0.75rem;">
                                <i class="mdi mdi-download"></i>
                            </button>
                        </div>

                        @php
                            $payment = $unit->activeBooking
                                ? $unit->activeBooking->payments()->latest()->first()
                                : null;

                            $label = null;

                            if ($payment) {
                                switch ($payment->type) {
                                    case 'booking_fee':
                                        $label = 'Booking Fee';
                                        break;
                                    case 'dp':
                                        $label = 'DP';
                                        break;
                                    case 'pelunasan':
                                        $label = 'Pelunasan';
                                        break;
                                    case 'cicilan':
                                        $label = 'Cicilan';
                                        break;
                                }
                            }
                        @endphp

                        @if ($payment && $payment->reference_number)
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span>
                                    <i class="mdi mdi-bank-transfer me-1"></i>
                                    {{ $label }}
                                </span>
                                <a href="{{ asset('storage/' . $payment->reference_number) }}" target="_blank"
                                    class="cash-btn cash-btn-outline-success"
                                    style="width: auto; padding: 0.25rem 0.75rem;">
                                    <i class="mdi mdi-download"></i>
                                </a>
                            </div>
                        @endif

                        <!-- DOKUMEN TAMBAHAN UNTUK SKENARIO 2 -->
                        <div class="d-flex justify-content-between align-items-center mb-2" id="dokumenPenolakan"
                            style="display: none;">
                            <span>
                                <i class="mdi mdi-file-pdf text-danger me-1"></i>
                                Surat Penolakan KPR
                            </span>
                            <button class="cash-btn cash-btn-outline-danger"
                                style="width: auto; padding: 0.25rem 0.75rem;">
                                <i class="mdi mdi-download"></i>
                            </button>
                        </div>
                    </div>

                    <hr class="my-3">

                    <!-- Tombol Aksi -->
                    <div class="d-flex flex-column gap-2">
                        <button
                            onclick="handleInvoice(
                                '{{ route('cetak.invoice_cash', $booking->id) }}',
                                '{{ route('cetak.invoice_wa', $booking->id) }}'
                            )"
                            class="cash-btn cash-btn-primary w-100">
                            <i class="mdi mdi-printer me-2"></i>
                            Cetak & Kirim WA
                        </button>

                        <button class="cash-btn cash-btn-info w-100">
                            <i class="mdi mdi-whatsapp me-2"></i>
                            Kirim Invoice
                        </button>
                       @if ($booking->status == 'cash_process')
    <a href="{{ route('akad.cash', $booking->id) }}"
        class="cash-btn cash-btn-outline-warning w-100 text-center d-inline-block">
        <i class="mdi mdi-handshake-outline me-2"></i>
        Lanjut ke Akad
    </a>
@elseif ($booking->status == 'akad')
    <button class="cash-btn cash-btn-outline-success w-100" disabled>
        <i class="mdi mdi-check-circle-outline me-2"></i>
        Sudah Akad
    </button>
@else
    <button class="cash-btn cash-btn-outline-warning w-100" disabled>
        <i class="mdi mdi-clock-outline me-2"></i>
        Menunggu Pelunasan
    </button>
@endif
@if($booking->status == 'akad')
    <a href="{{ route('cash.document.legal', $booking->id) }}"
       class="cash-btn cash-btn-outline-warning w-100">
       <i class="mdi mdi-file-certificate-outline me-2"></i>
       Persiapan Document Legal - {{ $booking->customer->name }}
    </a>
@elseif($booking->status == 'legal_done')
    <button class="cash-btn cash-btn-outline-success w-100" disabled>
        <i class="mdi mdi-check-circle-outline me-2"></i>
        Legal Document Selesai
    </button>
@else
    <button class="cash-btn cash-btn-outline-warning w-100" disabled>
        <i class="mdi mdi-clock-outline me-2"></i>
        Menunggu Proses Legal
    </button>
@endif


                        <button class="cash-btn cash-btn-outline-secondary w-100">
                            <i class="mdi mdi-arrow-left me-2"></i>
                            Kembali
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        /* Custom styles asli - tetap sama */
        .bg-light {
            background-color: #f8f9fc !important;
        }

        .bg-warning-subtle {
            background-color: #fff3cd !important;
        }

        .badge {
            padding: 5px 10px;
            font-weight: 500;
        }

        hr {
            border-top: 1px solid rgba(0, 0, 0, .1);
        }

        .table-borderless td {
            padding: 0.3rem 0;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .d-flex.flex-wrap .mt-3.mt-sm-0 {
                width: 100%;
            }

            .d-flex.flex-wrap .mt-3.mt-sm-0 .d-flex {
                justify-content: space-between;
            }

            .d-flex.flex-wrap .mt-3.mt-sm-0 .d-flex>div {
                margin-right: 0 !important;
                text-align: center;
                flex: 1;
            }
        }

        .h-100 {
            height: 100%;
        }

        .gap-2 {
            gap: 0.5rem;
        }

        .gap-3 {
            gap: 1rem;
        }
    </style>
@endpush

@push('scripts')
    <script>
        function handleInvoice(printUrl, waUrl) {
            // buka cetak di tab baru
            window.open(printUrl, '_blank');

            // redirect ke WA setelah 1 detik
            setTimeout(() => {
                window.location.href = waUrl;
            }, 1000);
        }
    </script>
    <script>
        $(document).ready(function() {
            // Fungsi format rupiah
            function formatRupiah(angka) {
                angka = angka.toString();
                return 'Rp ' + angka.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            function hitungDiskon() {
                let hargaUnit = parseInt($('#hargaUnit').val().replace(/[^0-9]/g, '')) || 0;
                let hargaNego = parseInt($('#hargaNego').val().replace(/[^0-9]/g, '')) || 0;
                let bookingFee = parseInt($('#bookingFee').val().replace(/[^0-9]/g, '')) || 0;

                if (hargaNego === 0) hargaNego = hargaUnit;

                let diskon = hargaUnit - hargaNego;
                if (diskon < 0) diskon = 0;

                let sisaBayar = hargaNego - bookingFee;
                if (sisaBayar < 0) sisaBayar = 0;

                let persenDiskon = hargaUnit > 0 ? ((diskon / hargaUnit) * 100).toFixed(2) : 0;

                // ===== Update Semua Elemen Dinamis =====
                // Ringkasan Transaksi
                $('#hargaUnitView').text(formatRupiah(hargaUnit));
                $('#hargaNegoView').text(formatRupiah(hargaNego));
                $('#diskonView').text(`- ${formatRupiah(diskon)}`);
                $('#totalLunasView').text(formatRupiah(sisaBayar));

                // Alert dan Total Bayar
                $('#totalBayar').text(formatRupiah(sisaBayar));
                $('#totalBayarAlert').text(formatRupiah(sisaBayar));
                $('#keteranganBayar').val(`Pelunasan Cash Keras - Nego ${formatRupiah(sisaBayar)}`);
                $('#statusBayarNominal').text(formatRupiah(sisaBayar));
                $('#diskonValue').text(formatRupiah(diskon));
                $('#diskonPersen').text(persenDiskon + '%');
                $('#hargaSetelahNego').text(formatRupiah(hargaNego));
                $('#bookingFeeView').text(formatRupiah(bookingFee));
                $('#sisaBayar').text(formatRupiah(sisaBayar));
                $('#alertHargaNego').text(formatRupiah(hargaNego));
                $('#alertSisaBayar').text(formatRupiah(sisaBayar));
                $('#jumlahBayar').val(sisaBayar); // untuk form submission

                // Badge Cash
                if (sisaBayar === 0) {
                    $('#badgeCashAwal').html(
                        `<span class="cash-badge cash-badge-success"><i class="mdi mdi-check-circle me-1"></i>Cash Keras - Lunas</span>`
                    );
                } else {
                    $('#badgeCashAwal').html(
                        `<span class="cash-badge cash-badge-success"><i class="mdi mdi-check-circle me-1"></i>Cash Keras - Belum Lunas</span>`
                    );
                }

                // Badge Konversi contoh kondisi
                if (diskon > 50000000) {
                    $('#badgeKonversi').show();
                } else {
                    $('#badgeKonversi').hide();
                }

                // Timeline Negosiasi
                $('#timelineNegosiasi').text(`Diskon ${formatRupiah(diskon)}`);
            }

            // Event listener untuk input dinamis
            $('#hargaNego, #hargaUnit, #bookingFee').on('input', function() {
                let nilai = $(this).val().replace(/[^0-9]/g, '');
                $(this).val(nilai); // simpan sebagai angka
                hitungDiskon();
            });

            // File upload modern preview
            $('.cash-file-upload-modern input[type="file"]').change(function(e) {
                const fileName = e.target.files[0]?.name;
                const fileSize = e.target.files[0]?.size;
                const label = $(this).closest('.cash-file-upload-modern').find(
                    '.cash-file-info-modern span');
                const sizeSpan = $(this).closest('.cash-file-upload-modern').find('.cash-file-size');

                if (fileName) {
                    label.text(fileName.length > 30 ? fileName.substring(0, 30) + '...' : fileName);
                    if (fileSize) {
                        const sizeInMB = (fileSize / (1024 * 1024)).toFixed(2);
                        sizeSpan.text(sizeInMB + ' MB');
                    }
                } else {
                    label.text('Upload Bukti Transfer');
                    sizeSpan.text('');
                }
            });

            // Toggle Skenario Cash Awal / Konversi
            $('#btnCashAwal').click(function() {
                $(this).addClass('active');
                $('#btnKonversi').removeClass('active');
                $('#alertCashAwal').show();
                $('#alertKonversi').hide();
                $('#biayaHangus').hide();
                $('#badgeCashAwal').show();
                $('#badgeKonversi').hide();
                $('#dokumenPenolakan').hide();
                $('#titleCash').text('Cash Keras - Lunas Langsung (Cash Awal)');
            });

            $('#btnKonversi').click(function() {
                $(this).addClass('active');
                $('#btnCashAwal').removeClass('active');
                $('#alertKonversi').show();
                $('#alertCashAwal').hide();
                $('#biayaHangus').show();
                $('#badgeKonversi').show();
                $('#badgeCashAwal').hide();
                $('#dokumenPenolakan').show();
                $('#titleCash').text('Cash Keras - Lunas Langsung (Konversi dari KPR)');
            });

            // Inisialisasi hitung diskon
            hitungDiskon();
        });
    </script>
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    confirmButtonText: 'OK',
                    timer: 3000, // otomatis hilang setelah 3 detik (opsional)
                });
            });
        </script>
    @endif
    <script>
        document.getElementById('btnProsesBayar').addEventListener('click', function(e) {
            e.preventDefault(); // cegah submit otomatis

            Swal.fire({
                title: 'Konfirmasi Pembayaran',
                text: "Apakah Anda yakin ingin memproses pembayaran ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, proses pembayaran!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit form secara manual
                    this.closest('form').submit();
                }
            });
        });

        // Optional: tampilkan SweetAlert sukses jika session success ada
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 2500,
                showConfirmButton: false
            });
        @endif
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const input = document.getElementById('hargaNego');

            input.addEventListener('keyup', function() {

                let angka = this.value.replace(/[^,\d]/g, '');
                let split = angka.split(',');
                let sisa = split[0].length % 3;
                let rupiah = split[0].substr(0, sisa);
                let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                if (ribuan) {
                    let separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                this.value = rupiah;
            });

        });
    </script>
@endpush
