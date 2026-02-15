@extends('layouts.partial.app')

@section('title', 'Konfirmasi Persetujuan KPR - Properti Management')

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

<!-- Row untuk Progress dan Detail -->
<div class="row mt-4">
    <!-- Kolom Kiri: Progress Timeline -->
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="mdi mdi-timeline-text me-2 text-primary"></i>
                    Tahapan Pengajuan KPR
                </h5>

                <!-- Progress Bar -->
                <div class="mb-4">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Progress Pengajuan</span>
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

                <hr>

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
                <div class="alert alert-warning" role="alert">
                    <i class="mdi mdi-information-outline me-2"></i>
                    Pilih status persetujuan dari bank. Keputusan ini akan menentukan langkah selanjutnya.
                </div>

                <!-- Pilihan Status Persetujuan -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card bg-success text-white cursor-pointer" id="pilihSetuju" style="cursor: pointer;">
                            <div class="card-body text-center py-4">
                                <i class="mdi mdi-check-decagram" style="font-size: 48px;"></i>
                                <h5 class="mt-3 text-white">KPR DISETUJUI</h5>
                                <p class="mb-0 small">Lanjut ke proses Akad</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-danger text-white cursor-pointer" id="pilihTolak" style="cursor: pointer;">
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
                    <hr>
                    <h6 class="mb-3">Form Persetujuan KPR</h6>

                    <div class="alert alert-success" role="alert">
                        <i class="mdi mdi-check-circle me-2"></i>
                        <strong>KPR DISETUJUI</strong> - Silakan lengkapi data persetujuan dari bank
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nilai Disetujui</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="text" class="form-control" value="360.000.000">
                                </div>
                                <small class="text-muted">Bisa berbeda dari pengajuan</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tenor Disetujui</label>
                                <select class="form-control">
                                    <option value="5">5 Tahun</option>
                                    <option value="10">10 Tahun</option>
                                    <option value="15" selected>15 Tahun</option>
                                    <option value="20">20 Tahun</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Bunga Final</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="7.25">
                                    <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>No. Surat Persetujuan (SP3K)</label>
                                <input type="text" class="form-control" value="SP3K/2025/021/ABC">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Persetujuan</label>
                                <input type="date" class="form-control" value="2025-02-25">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Upload Surat Persetujuan Prinsip</label>
                        <input type="file" class="form-control">
                        <small class="text-muted">Format: PDF, Max 5MB</small>
                    </div>

                    <div class="form-group">
                        <label>Catatan Persetujuan</label>
                        <textarea class="form-control" rows="2" placeholder="Contoh: Disetujui dengan nilai 360jt, bunga 7.25%">Disetujui dengan nilai 360jt, bunga 7.25%</textarea>
                    </div>
                </div>

                <!-- FORM KPR DITOLAK (muncul jika pilih tolak) -->
                <div id="formTolak" style="display: none;">
                    <hr>
                    <h6 class="mb-3">Form Penolakan KPR</h6>

                    <div class="alert alert-danger" role="alert">
                        <i class="mdi mdi-close-circle me-2"></i>
                        <strong>KPR DITOLAK</strong> - Pilih tindakan selanjutnya untuk customer
                    </div>

                    <div class="form-group">
                        <label>Alasan Penolakan dari Bank</label>
                        <select class="form-control" id="alasanTolak">
                            <option value="">-- Pilih Alasan --</option>
                            <option value="BI Checking">BI Checking / SLIK Bermasalah</option>
                            <option value="Kemampuan Bayar">Kemampuan Bayar Kurang</option>
                            <option value="Dokumen Tidak Lengkap">Dokumen Tidak Lengkap</option>
                            <option value="Appraisal">Nilai Appraisal Rendah</option>
                            <option value="Usia">Usia Tidak Memenuhi</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div class="form-group" id="alasanLainnya" style="display: none;">
                        <label>Tulis Alasan Lainnya</label>
                        <input type="text" class="form-control" placeholder="Contoh: Kebijakan bank baru">
                    </div>

                    <div class="form-group">
                        <label>Catatan Penolakan</label>
                        <textarea class="form-control" rows="2" placeholder="Detail penolakan dari bank..."></textarea>
                    </div>

                    <hr>

                    <h6 class="mb-3">Tindakan Selanjutnya</h6>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card border mb-2">
                                <div class="card-body p-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="tindakan" id="tindakanCash" checked>
                                        <label class="form-check-label" for="tindakanCash">
                                            <strong>Pindah ke Cash</strong><br>
                                            <small class="text-muted">Customer akan membayar tunai</small>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border mb-2">
                                <div class="card-body p-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="tindakan" id="tindakanUlang">
                                        <label class="form-check-label" for="tindakanUlang">
                                            <strong>Ajukan ke Bank Lain</strong><br>
                                            <small class="text-muted">Pengajuan ulang KPR</small>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border mb-2">
                                <div class="card-body p-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="tindakan" id="tindakanBatal">
                                        <label class="form-check-label" for="tindakanBatal">
                                            <strong>Batalkan Transaksi</strong><br>
                                            <small class="text-muted">Customer batal beli (refund)</small>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border mb-2">
                                <div class="card-body p-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="tindakan" id="tindakanRevisi">
                                        <label class="form-check-label" for="tindakanRevisi">
                                            <strong>Revisi Dokumen</strong><br>
                                            <small class="text-muted">Lengkapi dokumen & ajukan ulang</small>
                                        </label>
                                    </div>
                                </div>
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
                    Informasi Pengajuan
                </h5>

                <!-- Status Card -->
                <div class="text-center mb-4">
                    <span class="badge badge-warning p-2" style="font-size: 14px;">
                        <i class="mdi mdi-progress-clock me-1"></i>
                        Menunggu Konfirmasi Persetujuan
                    </span>
                </div>

                <!-- Ringkasan Survey -->
                <h6 class="mb-3">Hasil Survey</h6>
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

                <hr>

                <!-- Rekomendasi -->
                <h6 class="mb-3">Rekomendasi Survey</h6>
                <div class="alert alert-success py-2">
                    <i class="mdi mdi-thumb-up me-2"></i>
                    Layak - Sesuai Harga
                </div>

                <hr>

                <!-- Timeline -->
                <h6 class="mb-3">Timeline Pengajuan</h6>
                <div class="timeline">
                    <div class="d-flex mb-2">
                        <div class="me-3">
                            <i class="mdi mdi-check-circle text-success"></i>
                        </div>
                        <div class="flex-grow-1">
                            <span>Pengajuan KPR</span>
                            <small class="text-muted float-end">12 Feb 2025</small>
                        </div>
                    </div>
                    <div class="d-flex mb-2">
                        <div class="me-3">
                            <i class="mdi mdi-check-circle text-success"></i>
                        </div>
                        <div class="flex-grow-1">
                            <span>Verifikasi Dokumen</span>
                            <small class="text-muted float-end">14 Feb 2025</small>
                        </div>
                    </div>
                    <div class="d-flex mb-2">
                        <div class="me-3">
                            <i class="mdi mdi-check-circle text-success"></i>
                        </div>
                        <div class="flex-grow-1">
                            <span>Survey</span>
                            <small class="text-muted float-end">20 Feb 2025</small>
                        </div>
                    </div>
                </div>

                <hr>

                <!-- Tombol Aksi -->
                <button class="btn btn-primary btn-block mb-2" id="btnSimpan">
                    <i class="mdi mdi-content-save me-2"></i>
                    Simpan Konfirmasi
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
    .btn-block {
        width: 100%;
    }
    .badge {
        padding: 5px 10px;
    }
    .cursor-pointer {
        cursor: pointer;
    }
    .card.bg-success, .card.bg-danger {
        transition: transform 0.2s;
    }
    .card.bg-success:hover, .card.bg-danger:hover {
        transform: scale(1.02);
    }
    hr {
        border-top: 1px solid rgba(0,0,0,.1);
    }
    .timeline .d-flex {
        align-items: center;
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
});
</script>
@endpush
