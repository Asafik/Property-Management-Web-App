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
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="mdi mdi-account" style="font-size: 24px;"></i>
                        </div>
                    </div>

                    <!-- Info Customer -->
                    <div class="flex-grow-1">
                        <h4 class="mb-1">Budi Santoso</h4>
                        <p class="text-muted mb-0">Booking ID: #INV/202502/001</p>
                    </div>

                    <!-- Info Unit -->
                    <div class="mt-3 mt-sm-0">
                        <div class="d-flex flex-wrap gap-3">
                            <div>
                                <small class="text-muted d-block">Unit</small>
                                <span class="fw-medium">The Lavender - Tipe 45</span>
                            </div>
                            <div>
                                <small class="text-muted d-block">Blok/No</small>
                                <span class="fw-medium">C/12</span>
                            </div>
                            <div>
                                <small class="text-muted d-block">Harga Unit</small>
                                <span class="fw-medium text-primary">Rp 450 Juta</span>
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
                    <span class="me-3 fw-medium">Demo Mode:</span>
                    <div class="cash-btn-group">
                        <button type="button" class="cash-btn cash-btn-sm cash-btn-success active" id="btnCashAwal">
                            <i class="mdi mdi-cash me-1"></i>Cash Awal
                        </button>
                        <button type="button" class="cash-btn cash-btn-sm cash-btn-warning" id="btnKonversi">
                            <i class="mdi mdi-bank-off me-1"></i>Konversi dari KPR
                        </button>
                    </div>
                    <small class="cash-text-muted ms-3">Klik untuk lihat perbedaan tampilan</small>
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
                                <small class="d-block"><span class="fw-medium">Alasan Penolakan:</span> BI Checking / SLIK bermasalah (Rating kurang)</small>
                                <small class="d-block"><span class="fw-medium">Bank:</span> Bank ABC Syariah</small>
                                <small class="d-block"><span class="fw-medium">Tanggal Penolakan:</span> 25 Februari 2025</small>
                                <button class="cash-btn cash-btn-outline-primary mt-2" style="width: auto; padding: 0.25rem 0.75rem; font-size: 0.75rem;">
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

                        <div class="row">
                            <div class="col-md-6">
                                <div class="cash-form-group">
                                    <label>Harga Unit</label>
                                    <div class="cash-input-group">
                                        <div class="cash-input-group-prepend">
                                            <span class="cash-input-group-text">Rp</span>
                                        </div>
                                        <input type="text" class="cash-form-control" id="hargaUnit" value="450.000.000" readonly>
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
                                        <input type="text" class="cash-form-control" id="hargaNego" value="435.000.000">
                                    </div>
                                    <small class="cash-text-muted">Masukkan harga final setelah negosiasi</small>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-4">
                                <div class="cash-card border-success">
                                    <div class="card-body p-2">
                                        <small class="cash-text-muted d-block">Diskon</small>
                                        <span class="fw-bold cash-text-success" id="diskonValue">Rp 15.000.000</span>
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
                                        <span class="fw-bold cash-text-danger" id="totalBayar">Rp 435.000.000</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="cash-alert cash-alert-info mt-3 mb-0">
                            <i class="mdi mdi-information-outline me-2"></i>
                            <strong>Cash Keras:</strong> Customer akan membayar lunas <strong>Rp 435.000.000</strong> (setelah nego)
                        </div>
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
                        <small class="cash-text-muted d-block mt-2">*Biaya ini sudah dikeluarkan dan tidak dapat dikembalikan</small>
                    </div>
                </div>

                <hr class="my-3">

                <!-- Form Input Pembayaran Lunas -->
                <h6 class="cash-text-primary mb-3">Form Pembayaran Lunas</h6>

                <div class="row">
                    <div class="col-md-4">
                        <div class="cash-form-group">
                            <label>Tanggal Pembayaran</label>
                            <input type="date" class="cash-form-control" value="2025-03-25">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="cash-form-group">
                            <label>Jumlah Dibayar</label>
                            <div class="cash-input-group">
                                <div class="cash-input-group-prepend">
                                    <span class="cash-input-group-text">Rp</span>
                                </div>
                                <input type="text" class="cash-form-control" id="jumlahBayar" value="435.000.000" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="cash-form-group">
                            <label>Metode Pembayaran</label>
                            <select class="cash-form-control">
                                <option>Transfer Bank</option>
                                <option>Tunai</option>
                                <option>Kartu Kredit</option>
                                <option>Virtual Account</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="cash-form-group">
                            <label>Keterangan</label>
                            <input type="text" class="cash-form-control" value="Pelunasan Cash Keras - Nego Rp 435jt">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="cash-form-group">
                            <label>Upload Bukti Transfer</label>
                            <div class="cash-file-upload-modern">
                                <input type="file" id="uploadBukti" name="uploadBukti" accept=".jpg,.jpeg,.png,.pdf">
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

                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="cash-alert cash-alert-success">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="mdi mdi-check-circle me-2"></i>
                                    <strong>Status:</strong> Menunggu pembayaran lunas
                                </div>
                                <span class="fw-bold">Rp 435.000.000</span>
                            </div>
                        </div>
                    </div>
                </div>

                <button class="cash-btn cash-btn-success btn-lg mt-3 w-100">
                    <i class="mdi mdi-check-circle me-2"></i>
                    Proses Pembayaran Lunas
                </button>

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
                            <td class="text-end">Rp 450.000.000</td>
                        </tr>
                        <tr>
                            <td>Harga Nego</td>
                            <td class="text-end cash-text-primary">Rp 435.000.000</td>
                        </tr>
                        <tr>
                            <td>Diskon</td>
                            <td class="text-end cash-text-success">- Rp 15.000.000</td>
                        </tr>
                        <tr class="fw-bold">
                            <td>TOTAL LUNAS</td>
                            <td class="text-end cash-text-danger">Rp 435.000.000</td>
                        </tr>
                    </table>
                </div>

                <hr class="my-3">

                <!-- Timeline Transaksi -->
                <h6 class="cash-text-primary mb-3">Timeline Transaksi</h6>
                <div class="cash-timeline">
                    <div class="cash-timeline-item">
                        <div class="cash-timeline-icon">
                            <i class="mdi mdi-check-circle text-success"></i>
                        </div>
                        <div class="cash-timeline-content">
                            <span class="cash-timeline-title">Booking Unit</span>
                            <span class="cash-timeline-date">12 Feb 2025</span>
                        </div>
                    </div>
                    <div class="cash-timeline-item">
                        <div class="cash-timeline-icon">
                            <i class="mdi mdi-check-circle text-success"></i>
                        </div>
                        <div class="cash-timeline-content">
                            <span class="cash-timeline-title">Negosiasi Harga</span>
                            <span class="cash-timeline-date">20 Feb 2025 - Diskon Rp 15jt</span>
                        </div>
                    </div>
                    <div class="cash-timeline-item">
                        <div class="cash-timeline-icon">
                            <i class="mdi mdi-clock-outline text-warning"></i>
                        </div>
                        <div class="cash-timeline-content">
                            <span class="cash-timeline-title">Pembayaran Lunas</span>
                            <span class="cash-timeline-date">Menunggu pembayaran</span>
                        </div>
                    </div>
                </div>

                <hr class="my-3">

                <!-- Dokumen Penting -->
                <h6 class="cash-text-primary mb-3">Dokumen</h6>
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>Surat Perjanjian Cash</span>
                        <button class="cash-btn cash-btn-outline-primary" style="width: auto; padding: 0.25rem 0.75rem;">
                            <i class="mdi mdi-download"></i>
                        </button>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>Bukti Negosiasi Harga</span>
                        <button class="cash-btn cash-btn-outline-primary" style="width: auto; padding: 0.25rem 0.75rem;">
                            <i class="mdi mdi-download"></i>
                        </button>
                    </div>
                    <!-- DOKUMEN TAMBAHAN UNTUK SKENARIO 2 -->
                    <div class="d-flex justify-content-between align-items-center mb-2" id="dokumenPenolakan" style="display: none;">
                        <span>
                            <i class="mdi mdi-file-pdf text-danger me-1"></i>
                            Surat Penolakan KPR
                        </span>
                        <button class="cash-btn cash-btn-outline-danger" style="width: auto; padding: 0.25rem 0.75rem;">
                            <i class="mdi mdi-download"></i>
                        </button>
                    </div>
                </div>

                <hr class="my-3">

                <!-- Tombol Aksi -->
                <div class="d-flex flex-column gap-2">
                    <button onclick="window.open('/dashboard-cetak-invoice-cash', '_blank')" class="cash-btn cash-btn-primary w-100">
                        <i class="mdi mdi-printer me-2"></i>
                        Cetak Invoice
                    </button>

                    <button class="cash-btn cash-btn-info w-100">
                        <i class="mdi mdi-whatsapp me-2"></i>
                        Kirim Invoice
                    </button>

                    <button class="cash-btn cash-btn-outline-warning w-100">
                        <i class="mdi mdi-key me-2"></i>
                        Serah Terima Kunci
                    </button>

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
        border-top: 1px solid rgba(0,0,0,.1);
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
        .d-flex.flex-wrap .mt-3.mt-sm-0 .d-flex > div {
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
$(document).ready(function() {
    // Fungsi format rupiah
    function formatRupiah(angka) {
        return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    // Hitung diskon otomatis
    function hitungDiskon() {
        let hargaUnit = parseInt($('#hargaUnit').val().replace(/[^0-9]/g, ''));
        let hargaNego = parseInt($('#hargaNego').val().replace(/[^0-9]/g, ''));

        if(isNaN(hargaNego)) hargaNego = hargaUnit;

        let diskon = hargaUnit - hargaNego;
        let persenDiskon = ((diskon / hargaUnit) * 100).toFixed(2);

        $('#diskonValue').text(formatRupiah(diskon));
        $('#diskonPersen').text(persenDiskon + '%');
        $('#totalBayar').text(formatRupiah(hargaNego));
        $('#jumlahBayar').val(formatRupiah(hargaNego).replace('Rp ', ''));
    }

    // Event listener untuk input harga nego
    $('#hargaNego').on('keyup', function() {
        let nilai = this.value.replace(/[^0-9]/g, '');
        if (nilai) {
            this.value = formatRupiah(nilai).replace('Rp ', '');
        }
        hitungDiskon();
    });

    // File upload modern preview
    $('.cash-file-upload-modern input[type="file"]').change(function(e) {
        const fileName = e.target.files[0]?.name;
        const fileSize = e.target.files[0]?.size;
        const label = $(this).closest('.cash-file-upload-modern').find('.cash-file-info-modern span');
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

    // Toggle untuk demo 2 skenario
    $('#btnCashAwal').click(function() {
        // Aktifkan button
        $(this).addClass('active');
        $('#btnKonversi').removeClass('active');

        // Tampilkan alert cash awal, sembunyikan alert konversi
        $('#alertCashAwal').show();
        $('#alertKonversi').hide();

        // Sembunyikan biaya hangus
        $('#biayaHangus').hide();

        // Ganti badge
        $('#badgeCashAwal').show();
        $('#badgeKonversi').hide();

        // Sembunyikan dokumen penolakan
        $('#dokumenPenolakan').hide();

        // Ubah judul
        $('#titleCash').text('Cash Keras - Lunas Langsung (Cash Awal)');
    });

    $('#btnKonversi').click(function() {
        // Aktifkan button
        $(this).addClass('active');
        $('#btnCashAwal').removeClass('active');

        // Tampilkan alert konversi, sembunyikan alert cash awal
        $('#alertKonversi').show();
        $('#alertCashAwal').hide();

        // Tampilkan biaya hangus
        $('#biayaHangus').show();

        // Ganti badge
        $('#badgeKonversi').show();
        $('#badgeCashAwal').hide();

        // Tampilkan dokumen penolakan
        $('#dokumenPenolakan').show();

        // Ubah judul
        $('#titleCash').text('Cash Keras - Lunas Langsung (Konversi dari KPR)');
    });

    // Inisialisasi hitung diskon
    hitungDiskon();
});
</script>
@endpush
