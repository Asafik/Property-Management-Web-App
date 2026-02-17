@extends('layouts.partial.app')

@section('title', 'Konfirmasi Persetujuan KPR - Properti Management')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/marketing/akad.css') }}">

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

<!-- Row untuk Progress dan Detail -->
<div class="row mt-4">
    <!-- Kolom Kiri: Progress Timeline -->
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="mdi mdi-timeline-text me-2 text-primary"></i>
                    Tahapan Konfirmasi KPR
                </h5>

                <!-- Progress Bar -->
                <div class="mb-4">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Progress Konfirmasi</span>
                        <span class="text-primary">Menunggu Persetujuan Bank</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 70%;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                <!-- Timeline Steps -->
                <div class="row">
                    <div class="col text-center">
                        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 35px; height: 35px;">
                            <i class="mdi mdi-check" style="font-size: 18px;"></i>
                        </div>
                        <span class="d-block text-success small fw-medium">Pengajuan</span>
                        <small class="text-muted">12 Feb 2025</small>
                    </div>
                    <div class="col text-center">
                        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 35px; height: 35px;">
                            <i class="mdi mdi-check" style="font-size: 18px;"></i>
                        </div>
                        <span class="d-block text-success small fw-medium">Verifikasi</span>
                        <small class="text-muted">14 Feb 2025</small>
                    </div>
                    <div class="col text-center">
                        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 35px; height: 35px;">
                            <i class="mdi mdi-check" style="font-size: 18px;"></i>
                        </div>
                        <span class="d-block text-success small fw-medium">Survey</span>
                        <small class="text-muted">20 Feb 2025</small>
                    </div>
                    <div class="col text-center">
                        <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 35px; height: 35px;">
                            <i class="mdi mdi-clock" style="font-size: 18px;"></i>
                        </div>
                        <span class="d-block small fw-medium">Persetujuan</span>
                        <small class="text-muted">Menunggu</small>
                    </div>
                    <div class="col text-center">
                        <div class="bg-light text-muted rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 35px; height: 35px;">
                            <i class="mdi mdi-handshake" style="font-size: 18px;"></i>
                        </div>
                        <span class="d-block text-muted small fw-medium">Akad</span>
                        <small class="text-muted">Menunggu</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kolom Kanan: Detail KPR -->
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="mdi mdi-bank me-2 text-primary"></i>
                    Detail KPR
                </h5>

                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Bank Tujuan</span>
                        <span class="fw-medium">Bank ABC Syariah</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Jumlah Pinjaman</span>
                        <span class="fw-medium">Rp 360 Juta</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Tenor</span>
                        <span class="fw-medium">15 Tahun</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Angsuran/bln</span>
                        <span class="fw-medium text-primary">Rp 3.2 Juta</span>
                    </div>
                </div>

                <hr class="konfirmasi-hr">

                <div class="mt-3">
                    <small class="text-muted d-block mb-2">Ditangani oleh:</small>
                    <div class="d-flex align-items-center">
                        <div class="bg-light rounded-circle p-2 me-2">
                            <i class="mdi mdi-account-tie text-primary"></i>
                        </div>
                        <div>
                            <span class="fw-medium d-block">Ahmad Rizki</span>
                            <small class="text-muted">Marketing Officer</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Row untuk Konfirmasi Persetujuan -->
<div class="row">
    <!-- Kolom Kiri: Form Konfirmasi -->
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="mdi mdi-help-circle me-2 text-primary"></i>
                    Konfirmasi Persetujuan KPR
                </h5>

                <!-- Alert Info -->
                <div class="konfirmasi-alert konfirmasi-alert-warning" role="alert">
                    <i class="mdi mdi-information-outline me-2"></i>
                    Pilih status persetujuan dari bank. Keputusan ini akan menentukan langkah selanjutnya.
                </div>

                <!-- Pilihan Status Persetujuan -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card konfirmasi-card-option bg-success text-white" id="pilihSetuju">
                            <div class="card-body text-center py-4">
                                <i class="mdi mdi-check-decagram" style="font-size: 48px;"></i>
                                <h5 class="mt-3 text-white">KPR DISETUJUI</h5>
                                <p class="mb-0 small">Lanjut ke proses Akad</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card konfirmasi-card-option bg-danger text-white" id="pilihTolak">
                            <div class="card-body text-center py-4">
                                <i class="mdi mdi-close-octagon" style="font-size: 48px;"></i>
                                <h5 class="mt-3 text-white">KPR DITOLAK</h5>
                                <p class="mb-0 small">Pindah ke Cash / Pengajuan Ulang</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FORM KPR DISETUJUI (muncul jika pilih setuju) -->
                <div id="formSetuju" style="display: none;">
                    <hr class="konfirmasi-hr">
                    <h6 class="mb-3 konfirmasi-text-primary">Form Persetujuan KPR</h6>

                    <div class="konfirmasi-alert konfirmasi-alert-success" role="alert">
                        <i class="mdi mdi-check-circle me-2"></i>
                        <strong>KPR DISETUJUI</strong> - Silakan lengkapi data persetujuan dari bank
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="konfirmasi-form-group">
                                <label>Nilai Disetujui</label>
                                <div class="konfirmasi-input-group">
                                    <div class="konfirmasi-input-group-prepend">
                                        <span class="konfirmasi-input-group-text">Rp</span>
                                    </div>
                                    <input type="text" class="konfirmasi-form-control" value="360.000.000">
                                </div>
                                <small class="konfirmasi-text-muted">Bisa berbeda dari pengajuan</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="konfirmasi-form-group">
                                <label>Tenor Disetujui</label>
                                <select class="konfirmasi-form-control">
                                    <option value="5">5 Tahun</option>
                                    <option value="10">10 Tahun</option>
                                    <option value="15" selected>15 Tahun</option>
                                    <option value="20">20 Tahun</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="konfirmasi-form-group">
                                <label>Bunga Final</label>
                                <div class="konfirmasi-input-group">
                                    <input type="text" class="konfirmasi-form-control" value="7.25">
                                    <div class="konfirmasi-input-group-prepend">
                                        <span class="konfirmasi-input-group-text">%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="konfirmasi-form-group">
                                <label>No. Surat Persetujuan (SP3K)</label>
                                <input type="text" class="konfirmasi-form-control" value="SP3K/2025/021/ABC">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="konfirmasi-form-group">
                                <label>Tanggal Persetujuan</label>
                                <input type="date" class="konfirmasi-form-control" value="2025-02-25">
                            </div>
                        </div>
                    </div>

                    <!-- UPLOAD SURAT PERSETUJUAN PRINSIP - MODERN STYLE -->
                    <div class="konfirmasi-form-group">
                        <label>Upload Surat Persetujuan Prinsip</label>
                        <div class="konfirmasi-file-upload-modern">
                            <input type="file" id="uploadSP3K" name="uploadSP3K" accept=".jpg,.jpeg,.png,.pdf">
                            <div class="konfirmasi-file-label-modern">
                                <i class="mdi mdi-cloud-upload"></i>
                                <div class="konfirmasi-file-info-modern">
                                    <span>Upload Surat Persetujuan Prinsip</span>
                                    <small>Format: JPG, PNG, PDF (Max 5MB)</small>
                                </div>
                                <span class="konfirmasi-file-size"></span>
                            </div>
                        </div>
                    </div>

                    <div class="konfirmasi-form-group">
                        <label>Catatan Persetujuan</label>
                        <textarea class="konfirmasi-form-control" rows="2" placeholder="Contoh: Disetujui dengan nilai 360jt, bunga 7.25%">Disetujui dengan nilai 360jt, bunga 7.25%</textarea>
                    </div>
                </div>

                <!-- FORM KPR DITOLAK (muncul jika pilih tolak) -->
                <div id="formTolak" style="display: none;">
                    <hr class="konfirmasi-hr">
                    <h6 class="mb-3 konfirmasi-text-primary">Form Penolakan KPR</h6>

                    <div class="konfirmasi-alert konfirmasi-alert-danger" role="alert">
                        <i class="mdi mdi-close-circle me-2"></i>
                        <strong>KPR DITOLAK</strong> - Pilih tindakan selanjutnya untuk customer
                    </div>

                    <div class="konfirmasi-form-group">
                        <label>Alasan Penolakan dari Bank</label>
                        <select class="konfirmasi-form-control" id="alasanTolak">
                            <option value="">-- Pilih Alasan --</option>
                            <option value="BI Checking">BI Checking / SLIK Bermasalah</option>
                            <option value="Kemampuan Bayar">Kemampuan Bayar Kurang</option>
                            <option value="Dokumen Tidak Lengkap">Dokumen Tidak Lengkap</option>
                            <option value="Appraisal">Nilai Appraisal Rendah</option>
                            <option value="Usia">Usia Tidak Memenuhi</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div class="konfirmasi-form-group" id="alasanLainnya" style="display: none;">
                        <label>Tulis Alasan Lainnya</label>
                        <input type="text" class="konfirmasi-form-control" placeholder="Contoh: Kebijakan bank baru">
                    </div>

                    <div class="konfirmasi-form-group">
                        <label>Catatan Penolakan</label>
                        <textarea class="konfirmasi-form-control" rows="2" placeholder="Detail penolakan dari bank..."></textarea>
                    </div>

                    <hr class="konfirmasi-hr">

                    <!-- TINDAKAN SELANJUTNYA - MODERN CARD STYLE -->
                    <h6 class="mb-3 konfirmasi-text-primary">Tindakan Selanjutnya</h6>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="konfirmasi-tindakan-card">
                                <input type="radio" name="tindakan" id="tindakanCash" checked>
                                <label class="konfirmasi-tindakan-label" for="tindakanCash">
                                    <div class="konfirmasi-tindakan-icon">
                                        <i class="mdi mdi-cash-multiple"></i>
                                    </div>
                                    <div class="konfirmasi-tindakan-content">
                                        <span class="konfirmasi-tindakan-title">Pindah ke Cash</span>
                                        <span class="konfirmasi-tindakan-desc">Customer akan membayar tunai</span>
                                    </div>
                                    <div class="konfirmasi-tindakan-check">
                                        <i class="mdi mdi-check-circle"></i>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="konfirmasi-tindakan-card">
                                <input type="radio" name="tindakan" id="tindakanUlang">
                                <label class="konfirmasi-tindakan-label" for="tindakanUlang">
                                    <div class="konfirmasi-tindakan-icon">
                                        <i class="mdi mdi-bank-transfer"></i>
                                    </div>
                                    <div class="konfirmasi-tindakan-content">
                                        <span class="konfirmasi-tindakan-title">Ajukan ke Bank Lain</span>
                                        <span class="konfirmasi-tindakan-desc">Pengajuan ulang KPR</span>
                                    </div>
                                    <div class="konfirmasi-tindakan-check">
                                        <i class="mdi mdi-check-circle"></i>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="konfirmasi-tindakan-card">
                                <input type="radio" name="tindakan" id="tindakanBatal">
                                <label class="konfirmasi-tindakan-label" for="tindakanBatal">
                                    <div class="konfirmasi-tindakan-icon">
                                        <i class="mdi mdi-cancel"></i>
                                    </div>
                                    <div class="konfirmasi-tindakan-content">
                                        <span class="konfirmasi-tindakan-title">Batalkan Transaksi</span>
                                        <span class="konfirmasi-tindakan-desc">Customer batal beli (refund)</span>
                                    </div>
                                    <div class="konfirmasi-tindakan-check">
                                        <i class="mdi mdi-check-circle"></i>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="konfirmasi-tindakan-card">
                                <input type="radio" name="tindakan" id="tindakanRevisi">
                                <label class="konfirmasi-tindakan-label" for="tindakanRevisi">
                                    <div class="konfirmasi-tindakan-icon">
                                        <i class="mdi mdi-file-document-edit"></i>
                                    </div>
                                    <div class="konfirmasi-tindakan-content">
                                        <span class="konfirmasi-tindakan-title">Revisi Dokumen</span>
                                        <span class="konfirmasi-tindakan-desc">Lengkapi dokumen</span>
                                    </div>
                                    <div class="konfirmasi-tindakan-check">
                                        <i class="mdi mdi-check-circle"></i>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kolom Kanan: Info & Ringkasan -->
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="mdi mdi-information me-2 text-primary"></i>
                    Informasi Konfirmasi
                </h5>

                <!-- Status Card -->
                <div class="text-center mb-4">
                    <span class="badge badge-warning p-2" style="font-size: 14px;">
                        <i class="mdi mdi-progress-clock me-1"></i>
                        Menunggu Konfirmasi Persetujuan
                    </span>
                </div>

                <!-- Ringkasan Survey -->
                <h6 class="mb-3 konfirmasi-text-primary">Hasil Survey</h6>
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Nilai Appraisal</span>
                        <span class="fw-medium">Rp 445 Juta</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Selisih Harga</span>
                        <span class="fw-medium text-danger">- Rp 5 Juta</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Surveyor</span>
                        <span class="fw-medium">Hendra Wijaya</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Tanggal Survey</span>
                        <span class="fw-medium">20 Feb 2025</span>
                    </div>
                </div>

                <hr class="konfirmasi-hr">

                <!-- Rekomendasi -->
                <h6 class="mb-3 konfirmasi-text-primary">Rekomendasi Survey</h6>
                <div class="konfirmasi-alert konfirmasi-alert-success py-2">
                    <i class="mdi mdi-thumb-up me-2"></i>
                    Layak - Sesuai Harga
                </div>

                <hr class="konfirmasi-hr">

                <!-- Timeline -->
                <h6 class="mb-3 konfirmasi-text-primary">Timeline Pengajuan</h6>
                <div class="konfirmasi-timeline">
                    <div class="konfirmasi-timeline-item">
                        <div class="konfirmasi-timeline-icon">
                            <i class="mdi mdi-check-circle text-success"></i>
                        </div>
                        <div class="konfirmasi-timeline-content">
                            <span class="konfirmasi-timeline-text">Pengajuan KPR</span>
                            <small class="konfirmasi-timeline-date">12 Feb 2025</small>
                        </div>
                    </div>
                    <div class="konfirmasi-timeline-item">
                        <div class="konfirmasi-timeline-icon">
                            <i class="mdi mdi-check-circle text-success"></i>
                        </div>
                        <div class="konfirmasi-timeline-content">
                            <span class="konfirmasi-timeline-text">Verifikasi Dokumen</span>
                            <small class="konfirmasi-timeline-date">14 Feb 2025</small>
                        </div>
                    </div>
                    <div class="konfirmasi-timeline-item">
                        <div class="konfirmasi-timeline-icon">
                            <i class="mdi mdi-check-circle text-success"></i>
                        </div>
                        <div class="konfirmasi-timeline-content">
                            <span class="konfirmasi-timeline-text">Survey</span>
                            <small class="konfirmasi-timeline-date">20 Feb 2025</small>
                        </div>
                    </div>
                </div>

                <hr class="konfirmasi-hr">

                <!-- Tombol Aksi -->
                <button class="konfirmasi-btn konfirmasi-btn-primary w-100 mb-2" id="btnSimpan">
                    <i class="mdi mdi-content-save me-2"></i>
                    Simpan Konfirmasi
                </button>

                <a href="{{ url('/marketing/kpr') }}" class="konfirmasi-btn konfirmasi-btn-outline-secondary w-100">
                    <i class="mdi mdi-arrow-left me-2"></i>
                    Kembali
                </a>
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
    .badge {
        padding: 5px 10px;
    }
    .cursor-pointer {
        cursor: pointer;
    }
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Pilih KPR Disetujui
    $('#pilihSetuju').click(function() {
        $('#formSetuju').slideDown();
        $('#formTolak').slideUp();
        $('#pilihSetuju').addClass('border border-white border-3');
        $('#pilihTolak').removeClass('border border-white border-3');
    });

    // Pilih KPR Ditolak
    $('#pilihTolak').click(function() {
        $('#formTolak').slideDown();
        $('#formSetuju').slideUp();
        $('#pilihTolak').addClass('border border-white border-3');
        $('#pilihSetuju').removeClass('border border-white border-3');
    });

    // Tampilkan input alasan lainnya
    $('#alasanTolak').change(function() {
        if($(this).val() === 'Lainnya') {
            $('#alasanLainnya').slideDown();
        } else {
            $('#alasanLainnya').slideUp();
        }
    });

    // MODERN FILE UPLOAD - Menampilkan nama file dan ukuran
    $('.konfirmasi-file-upload-modern input[type="file"]').change(function(e) {
        const fileName = e.target.files[0]?.name;
        const fileSize = e.target.files[0]?.size;
        const label = $(this).closest('.konfirmasi-file-upload-modern').find('.konfirmasi-file-info-modern span');
        const sizeSpan = $(this).closest('.konfirmasi-file-upload-modern').find('.konfirmasi-file-size');

        if (fileName) {
            // Tampilkan nama file (potong jika terlalu panjang)
            label.text(fileName.length > 30 ? fileName.substring(0, 30) + '...' : fileName);

            // Hitung dan tampilkan ukuran file dalam MB
            if (fileSize) {
                const sizeInMB = (fileSize / (1024 * 1024)).toFixed(2);
                sizeSpan.text(sizeInMB + ' MB');
            }
        } else {
            // Reset ke teks awal jika tidak ada file
            label.text('Upload Surat Persetujuan Prinsip');
            sizeSpan.text('');
        }
    });
});
</script>
@endpush
