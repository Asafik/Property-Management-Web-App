@extends('layouts.partial.app')

@section('title', 'Cash Keras - Properti Management')

@section('content')
<div class="row">
    <div class="col-12">
        <!-- Header Info Customer -->
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="me-4 mb-2 mb-sm-0">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="mdi mdi-account" style="font-size: 24px;"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <h4 class="mb-1">Budi Santoso</h4>
                        <p class="text-muted mb-0">Booking ID: #INV/202502/001</p>
                    </div>
                    <div class="mt-3 mt-sm-0">
                        <div class="d-flex">
                            <div class="me-4">
                                <small class="text-muted d-block">Unit</small>
                                <span class="fw-medium">The Lavender - Tipe 45</span>
                            </div>
                            <div class="me-4">
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
        <div class="card bg-light">
            <div class="card-body py-3">
                <div class="d-flex align-items-center">
                    <span class="me-3 fw-medium">Demo Mode:</span>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-sm btn-success active" id="btnCashAwal">
                            <i class="mdi mdi-cash me-1"></i>Cash Awal
                        </button>
                        <button type="button" class="btn btn-sm btn-warning" id="btnKonversi">
                            <i class="mdi mdi-bank-off me-1"></i>Konversi dari KPR
                        </button>
                    </div>
                    <small class="text-muted ms-3">Klik untuk lihat perbedaan tampilan</small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Row untuk Status dan Info -->
<div class="row mt-4">
    <!-- Kolom Kiri: Info Pembayaran -->
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="mdi mdi-cash-multiple me-2 text-primary"></i>
                    <span id="titleCash">Cash Keras - Lunas Langsung</span>
                </h5>

                <!-- ALERT SKENARIO 1: CASH AWAL -->
                <div class="alert alert-success" id="alertCashAwal">
                    <div class="d-flex align-items-center">
                        <i class="mdi mdi-check-circle me-3" style="font-size: 24px;"></i>
                        <div>
                            <strong>Cash Keras</strong> - Customer membayar lunas langsung (bisa nego)
                        </div>
                    </div>
                </div>

                <!-- ALERT SKENARIO 2: KONVERSI DARI KPR -->
                <div class="alert alert-warning" id="alertKonversi" style="display: none;">
                    <div class="d-flex">
                        <i class="mdi mdi-information-outline me-3" style="font-size: 24px;"></i>
                        <div>
                            <strong>Konversi dari KPR ke Cash Keras</strong> - KPR ditolak, pindah ke cash lunas
                            <div class="mt-2 p-2 bg-white rounded">
                                <small class="d-block"><span class="fw-medium">Alasan Penolakan:</span> BI Checking / SLIK bermasalah (Rating kurang)</small>
                                <small class="d-block"><span class="fw-medium">Bank:</span> Bank ABC Syariah</small>
                                <small class="d-block"><span class="fw-medium">Tanggal Penolakan:</span> 25 Februari 2025</small>
                                <button class="btn btn-sm btn-outline-primary mt-2">
                                    <i class="mdi mdi-file-pdf me-1"></i>Lihat Surat Penolakan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FORM NEGO HARGA -->
                <div class="card bg-light mb-4">
                    <div class="card-body">
                        <h6 class="text-primary mb-3">
                            <i class="mdi mdi-tag-multiple me-2"></i>
                            Informasi Harga & Negosiasi
                        </h6>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Harga Unit</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="text" class="form-control" id="hargaUnit" value="450.000.000" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Harga Nego / Kesepakatan</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="text" class="form-control" id="hargaNego" value="435.000.000">
                                    </div>
                                    <small class="text-muted">Masukkan harga final setelah negosiasi</small>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-4">
                                <div class="card border-success">
                                    <div class="card-body p-2">
                                        <small class="text-muted d-block">Diskon</small>
                                        <span class="fw-bold text-success" id="diskonValue">Rp 15.000.000</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-primary">
                                    <div class="card-body p-2">
                                        <small class="text-muted d-block">Persentase Diskon</small>
                                        <span class="fw-bold text-primary" id="diskonPersen">3.33%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-danger">
                                    <div class="card-body p-2">
                                        <small class="text-muted d-block">Total Bayar</small>
                                        <span class="fw-bold text-danger" id="totalBayar">Rp 435.000.000</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-info mt-3 mb-0">
                            <i class="mdi mdi-information-outline me-2"></i>
                            <strong>Cash Keras:</strong> Customer akan membayar lunas <strong>Rp 435.000.000</strong> (setelah nego)
                        </div>
                    </div>
                </div>

                <!-- SECTION KHUSUS SKENARIO 2: BIAYA HANGUS -->
                <div class="card border-warning bg-warning-subtle mt-3" id="biayaHangus" style="display: none;">
                    <div class="card-body">
                        <h6 class="text-warning mb-2">
                            <i class="mdi mdi-alert-circle me-1"></i>
                            Biaya KPR yang Tidak Kembali (Hangus)
                        </h6>
                        <div class="row">
                            <div class="col-md-4">
                                <small class="text-muted d-block">Biaya Survey</small>
                                <span class="fw-medium">Rp 500.000</span>
                            </div>
                            <div class="col-md-4">
                                <small class="text-muted d-block">Biaya Provisi</small>
                                <span class="fw-medium">Rp 3.600.000</span>
                            </div>
                            <div class="col-md-4">
                                <small class="text-muted d-block">Total Hangus</small>
                                <span class="fw-bold text-danger">Rp 4.100.000</span>
                            </div>
                        </div>
                        <small class="text-muted d-block mt-2">*Biaya ini sudah dikeluarkan dan tidak dapat dikembalikan</small>
                    </div>
                </div>

                <hr>

                <!-- Form Input Pembayaran Lunas -->
                <h6 class="mb-3">Form Pembayaran Lunas</h6>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tanggal Pembayaran</label>
                            <input type="date" class="form-control" value="2025-03-25">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Jumlah Dibayar</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="text" class="form-control" id="jumlahBayar" value="435.000.000" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Metode Pembayaran</label>
                            <select class="form-control">
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
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" class="form-control" value="Pelunasan Cash Keras - Nego Rp 435jt">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Upload Bukti Transfer</label>
                            <input type="file" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="alert alert-success">
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

                <button class="btn btn-success btn-lg mt-3">
                    <i class="mdi mdi-check-circle me-2"></i>
                    Proses Pembayaran Lunas
                </button>
            </div>
        </div>
    </div>

    <!-- Kolom Kanan: Info & Aksi -->
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="mdi mdi-information me-2 text-primary"></i>
                    Ringkasan Transaksi
                </h5>

                <!-- Status Badge - Berubah sesuai skenario -->
                <div class="text-center mb-4" id="badgeCashAwal">
                    <span class="badge badge-success p-2" style="font-size: 14px;">
                        <i class="mdi mdi-check-circle me-1"></i>
                        Cash Keras - Belum Lunas
                    </span>
                </div>
                <div class="text-center mb-4" id="badgeKonversi" style="display: none;">
                    <span class="badge badge-warning p-2" style="font-size: 14px;">
                        <i class="mdi mdi-bank-off me-1"></i>
                        Konversi KPR - Cash Keras
                    </span>
                </div>

                <!-- Ringkasan Transaksi -->
                <div class="mb-4">
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td>Harga Unit</td>
                            <td class="text-end">Rp 450.000.000</td>
                        </tr>
                        <tr>
                            <td>Harga Nego</td>
                            <td class="text-end text-primary">Rp 435.000.000</td>
                        </tr>
                        <tr>
                            <td>Diskon</td>
                            <td class="text-end text-success">- Rp 15.000.000</td>
                        </tr>
                        <tr class="fw-bold">
                            <td>TOTAL LUNAS</td>
                            <td class="text-end text-danger">Rp 435.000.000</td>
                        </tr>
                    </table>
                </div>

                <hr>

                <!-- Timeline Transaksi -->
                <h6 class="mb-3">Timeline Transaksi</h6>
                <div class="timeline">
                    <div class="d-flex mb-3">
                        <div class="me-3">
                            <i class="mdi mdi-check-circle text-success"></i>
                        </div>
                        <div>
                            <span class="d-block fw-medium">Booking Unit</span>
                            <small class="text-muted">12 Feb 2025</small>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="me-3">
                            <i class="mdi mdi-check-circle text-success"></i>
                        </div>
                        <div>
                            <span class="d-block fw-medium">Negosiasi Harga</span>
                            <small class="text-muted">20 Feb 2025 - Diskon Rp 15jt</small>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="me-3">
                            <i class="mdi mdi-clock-outline text-warning"></i>
                        </div>
                        <div>
                            <span class="d-block fw-medium">Pembayaran Lunas</span>
                            <small class="text-muted">Menunggu pembayaran</small>
                        </div>
                    </div>
                </div>

                <hr>

                <!-- Dokumen Penting -->
                <h6 class="mb-3">Dokumen</h6>
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>Surat Perjanjian Cash</span>
                        <button class="btn btn-sm btn-outline-primary">
                            <i class="mdi mdi-download"></i>
                        </button>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>Bukti Negosiasi Harga</span>
                        <button class="btn btn-sm btn-outline-primary">
                            <i class="mdi mdi-download"></i>
                        </button>
                    </div>
                    <!-- DOKUMEN TAMBAHAN UNTUK SKENARIO 2 -->
                    <div class="d-flex justify-content-between align-items-center mb-2" id="dokumenPenolakan" style="display: none;">
                        <span>
                            <i class="mdi mdi-file-pdf text-danger me-1"></i>
                            Surat Penolakan KPR
                        </span>
                        <button class="btn btn-sm btn-outline-danger">
                            <i class="mdi mdi-download"></i>
                        </button>
                    </div>
                </div>

                <hr>

                <!-- Tombol Aksi -->
                <button
                    onclick="window.open('/dashboard-cetak-invoice-cash', '_blank')"
                    class="btn btn-primary btn-block mb-2">
                    <i class="mdi mdi-printer me-2"></i>
                    Cetak Invoice
                </button>



                <button class="btn btn-info btn-block mb-2">
                    <i class="mdi mdi-whatsapp me-2"></i>
                    Kirim Invoice
                </button>

                <button class="btn btn-outline-warning btn-block mb-2">
                    <i class="mdi mdi-key me-2"></i>
                    Serah Terima Kunci
                </button>

                <button class="btn btn-outline-secondary btn-block">
                    <i class="mdi mdi-arrow-left me-2"></i>
                    Kembali
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .bg-light {
        background-color: #f8f9fc !important;
    }
    .bg-warning-subtle {
        background-color: #fff3cd !important;
    }
    .btn-block {
        width: 100%;
    }
    .badge {
        padding: 5px 10px;
    }
    hr {
        border-top: 1px solid rgba(0,0,0,.1);
    }
    .timeline .d-flex {
        align-items: flex-start;
    }
    .timeline i {
        font-size: 18px;
    }
    .table-borderless td {
        padding: 0.3rem 0;
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
