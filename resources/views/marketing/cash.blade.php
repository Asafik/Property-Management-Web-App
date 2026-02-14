@extends('layouts.partial.app')

@section('title', 'Pembayaran Cash - Properti Management')

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
                    Informasi Pembayaran Cash
                </h5>

                <!-- ALERT SKENARIO 1: CASH AWAL -->
                <div class="alert alert-success" id="alertCashAwal">
                    <div class="d-flex align-items-center">
                        <i class="mdi mdi-check-circle me-3" style="font-size: 24px;"></i>
                        <div>
                            <strong>Cash dari Awal</strong> - Customer memilih pembayaran tunai langsung ke developer
                        </div>
                    </div>
                </div>

                <!-- ALERT SKENARIO 2: KONVERSI DARI KPR -->
                <div class="alert alert-warning" id="alertKonversi" style="display: none;">
                    <div class="d-flex">
                        <i class="mdi mdi-information-outline me-3" style="font-size: 24px;"></i>
                        <div>
                            <strong>Konversi dari KPR</strong> - KPR ditolak, pindah ke jalur cash
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

                <!-- Jenis Pembayaran Cash -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jenis Cash</label>
                            <select class="form-control" id="jenisCash">
                                <option value="keras" selected>Cash Keras (Lunas Langsung)</option>
                                <option value="bertahap">Cash Bertahap (Cicil ke Developer)</option>
                                <option value="inhouse">Inhouse Financing</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6" id="tenorField">
                        <div class="form-group">
                            <label>Tenor / Lama Cicilan</label>
                            <select class="form-control">
                                <option value="6">6 Bulan</option>
                                <option value="12" selected>12 Bulan</option>
                                <option value="24">24 Bulan</option>
                                <option value="36">36 Bulan</option>
                            </select>
                        </div>
                    </div>
                </div>

                <hr>

                <!-- Ringkasan Keuangan -->
                <h6 class="mb-3">Ringkasan Keuangan</h6>

                <div class="row">
                    <div class="col-md-3">
                        <div class="card bg-light border-0">
                            <div class="card-body text-center p-2">
                                <small class="text-muted d-block">Harga Unit</small>
                                <span class="fw-bold text-primary">Rp 450J</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-light border-0">
                            <div class="card-body text-center p-2">
                                <small class="text-muted d-block">Diskon</small>
                                <span class="fw-bold text-success">Rp 5J</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-light border-0">
                            <div class="card-body text-center p-2">
                                <small class="text-muted d-block">Total</small>
                                <span class="fw-bold text-primary">Rp 445J</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-light border-0">
                            <div class="card-body text-center p-2">
                                <small class="text-muted d-block">Progress</small>
                                <span class="fw-bold text-primary">22.5%</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-6">
                        <div class="card bg-light border-0">
                            <div class="card-body p-2">
                                <div class="d-flex justify-content-between">
                                    <small class="text-muted">Sudah Dibayar:</small>
                                    <span class="fw-bold text-success">Rp 100J</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-light border-0">
                            <div class="card-body p-2">
                                <div class="d-flex justify-content-between">
                                    <small class="text-muted">Sisa Tagihan:</small>
                                    <span class="fw-bold text-danger">Rp 345J</span>
                                </div>
                            </div>
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

                <!-- Tabel Riwayat Pembayaran -->
                <h6 class="mb-3">Riwayat Pembayaran</h6>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="bg-light">
                            <tr>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th>Bukti</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>12 Feb 2025</td>
                                <td>Booking Fee</td>
                                <td>Rp 10.000.000</td>
                                <td><span class="badge badge-success">Lunas</span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="mdi mdi-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>14 Feb 2025</td>
                                <td>DP 20%</td>
                                <td>Rp 90.000.000</td>
                                <td><span class="badge badge-success">Lunas</span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="mdi mdi-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>10 Mar 2025</td>
                                <td>Angsuran 1</td>
                                <td>Rp 15.000.000</td>
                                <td><span class="badge badge-warning">Menunggu</span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-secondary" disabled>
                                        <i class="mdi mdi-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <hr>

                <!-- Form Input Pembayaran Baru -->
                <h6 class="mb-3">Input Pembayaran Baru</h6>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tanggal Bayar</label>
                            <input type="date" class="form-control" value="2025-03-25">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Jumlah</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="text" class="form-control" value="15.000.000">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Metode</label>
                            <select class="form-control">
                                <option>Transfer Bank</option>
                                <option>Tunai</option>
                                <option>Kartu Kredit</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" class="form-control" value="Angsuran ke-1">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Upload Bukti</label>
                            <input type="file" class="form-control">
                        </div>
                    </div>
                </div>

                <button class="btn btn-primary mt-2">
                    <i class="mdi mdi-cash-plus me-2"></i>
                    Tambah Pembayaran
                </button>
            </div>
        </div>
    </div>

    <!-- Kolom Kanan: Jadwal & Aksi -->
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="mdi mdi-calendar-clock me-2 text-primary"></i>
                    Jadwal Angsuran
                </h5>

                <!-- Status Badge - Berubah sesuai skenario -->
                <div class="text-center mb-4" id="badgeCashAwal">
                    <span class="badge badge-success p-2" style="font-size: 14px;">
                        <i class="mdi mdi-check-circle me-1"></i>
                        Cash Bertahap - 12 Bulan
                    </span>
                </div>
                <div class="text-center mb-4" id="badgeKonversi" style="display: none;">
                    <span class="badge badge-warning p-2" style="font-size: 14px;">
                        <i class="mdi mdi-bank-off me-1"></i>
                        Konversi dari KPR - Cash Bertahap
                    </span>
                </div>

                <!-- Info Jatuh Tempo -->
                <div class="mb-4">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Jatuh Tempo</span>
                        <span class="fw-medium">Setiap Tanggal 10</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Angsuran per Bulan</span>
                        <span class="fw-medium">Rp 14.375.000</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Sisa Angsuran</span>
                        <span class="fw-medium">11 Bulan</span>
                    </div>
                </div>

                <hr>

                <!-- Tabel Jadwal Angsuran -->
                <h6 class="mb-3">Jadwal Cicilan</h6>

                <div class="table-responsive" style="max-height: 250px; overflow-y: auto;">
                    <table class="table table-sm">
                        <thead class="bg-light">
                            <tr>
                                <th>Bln</th>
                                <th>Jatuh Tempo</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>10 Mar 2025</td>
                                <td><span class="badge badge-warning">Proses</span></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>10 Apr 2025</td>
                                <td><span class="badge badge-secondary">Mendatang</span></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>10 Mei 2025</td>
                                <td><span class="badge badge-secondary">Mendatang</span></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>10 Jun 2025</td>
                                <td><span class="badge badge-secondary">Mendatang</span></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>10 Jul 2025</td>
                                <td><span class="badge badge-secondary">Mendatang</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <hr>

                <!-- Dokumen Penting -->
                <h6 class="mb-3">Dokumen</h6>
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>Kwitansi Booking</span>
                        <button class="btn btn-sm btn-outline-primary">
                            <i class="mdi mdi-download"></i>
                        </button>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>Invoice DP</span>
                        <button class="btn btn-sm btn-outline-primary">
                            <i class="mdi mdi-download"></i>
                        </button>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>Surat Perjanjian Cash</span>
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
                <button class="btn btn-success btn-block mb-2">
                    <i class="mdi mdi-check-circle me-2"></i>
                    Tandai Lunas
                </button>

                <button class="btn btn-primary btn-block mb-2">
                    <i class="mdi mdi-printer me-2"></i>
                    Cetak Invoice
                </button>

                <button class="btn btn-info btn-block mb-2">
                    <i class="mdi mdi-whatsapp me-2"></i>
                    Kirim Tagihan
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
    .table td, .table th {
        padding: 0.75rem;
    }
    .table-sm td, .table-sm th {
        padding: 0.3rem 0.5rem;
    }
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
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
    });

    // Tampilkan/sembunyikan tenor berdasarkan pilihan jenis cash
    $('#jenisCash').change(function() {
        if($(this).val() === 'keras') {
            $('#tenorField').hide();
        } else {
            $('#tenorField').show();
        }
    });
});
</script>
@endpush
