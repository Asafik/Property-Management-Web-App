@extends('layouts.partial.app')

@section('title', 'Vertifikasi KPR - Properti Management')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/marketing/akad.css') }}">

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
                        <p class="text-muted mb-0">Booking ID: BK/2025/00123</p>
                    </div>

                    <!-- Info Unit -->
                    <div class="mt-3 mt-sm-0">
                        <div class="d-flex flex-wrap gap-3">
                            <div>
                                <small class="text-muted d-block">Unit</small>
                                <span class="fw-medium">Cluster Mawar - Subsidi</span>
                            </div>
                            <div>
                                <small class="text-muted d-block">Blok/No</small>
                                <span class="fw-medium">A.1</span>
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
    <div class="col-12 col-lg-8 mb-4 mb-lg-0">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="mdi mdi-timeline-text me-2 text-primary"></i>
                    Tahapan Verifikasi KPR
                </h5>

                <!-- Progress Bar -->
                <div class="mb-4">
                    <div class="d-flex flex-wrap justify-content-between mb-2">
                        <span class="text-muted">Progress Verifikasi</span>
                        <span class="text-primary">Tahap 2 dari 5</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 40%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                <!-- Timeline Steps -->
                <div class="timeline-steps">
                    <div class="row g-2 g-md-0">
                        <div class="col-4 col-md text-center mb-3 mb-md-0">
                            <div class="step completed">
                                <div class="step-icon bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 35px; height: 35px;">
                                    <i class="mdi mdi-check" style="font-size: 18px;"></i>
                                </div>
                                <span class="d-block text-success small fw-medium">Diajukan</span>
                                <small class="text-muted d-none d-sm-block">15 Maret 2025</small>
                            </div>
                        </div>
                        <div class="col-4 col-md text-center mb-3 mb-md-0">
                            <div class="step active">
                                <div class="step-icon bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 35px; height: 35px;">
                                    <i class="mdi mdi-file-document" style="font-size: 18px;"></i>
                                </div>
                                <span class="d-block small fw-medium">Verifikasi</span>
                                <small class="text-muted d-none d-sm-block">Sedang Proses</small>
                            </div>
                        </div>
                        <div class="col-4 col-md text-center mb-3 mb-md-0">
                            <div class="step">
                                <div class="step-icon bg-light text-muted rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 35px; height: 35px;">
                                    <i class="mdi mdi-home" style="font-size: 18px;"></i>
                                </div>
                                <span class="d-block text-muted small fw-medium">Survey</span>
                                <small class="text-muted d-none d-sm-block">Menunggu</small>
                            </div>
                        </div>
                        <div class="col-4 col-md text-center mt-2 mt-md-0">
                            <div class="step">
                                <div class="step-icon bg-light text-muted rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 35px; height: 35px;">
                                    <i class="mdi mdi-handshake" style="font-size: 18px;"></i>
                                </div>
                                <span class="d-block text-muted small fw-medium">Akad</span>
                                <small class="text-muted d-none d-sm-block">Menunggu</small>
                            </div>
                        </div>
                        <div class="col-4 col-md text-center mt-2 mt-md-0">
                            <div class="step">
                                <div class="step-icon bg-light text-muted rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 35px; height: 35px;">
                                    <i class="mdi mdi-cash" style="font-size: 18px;"></i>
                                </div>
                                <span class="d-block text-muted small fw-medium">Cair</span>
                                <small class="text-muted d-none d-sm-block">Menunggu</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kolom Kanan: Detail KPR -->
    <div class="col-12 col-lg-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="mdi mdi-bank me-2 text-primary"></i>
                    Detail KPR
                </h5>

                <div class="detail-info">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Bank Tujuan</span>
                        <span class="fw-medium">Bank ABC Syariah</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Jumlah Pinjaman</span>
                        <span class="fw-medium">Rp 400 Juta</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Tenor</span>
                        <span class="fw-medium">15 Tahun</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Angsuran/bln</span>
                        <span class="fw-medium text-primary">Rp 3.6 Juta</span>
                    </div>
                </div>

                <hr class="my-3">

                <div class="mt-3">
                    <small class="text-muted d-block mb-2">Ditangani oleh:</small>
                    <div class="d-flex align-items-center">
                        <div class="bg-light rounded-circle p-2 me-2">
                            <i class="mdi mdi-account-tie text-primary"></i>
                        </div>
                        <div>
                            <span class="fw-medium d-block">Ahmad Rizki</span>
                            <small class="text-muted">Marketing Senior</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Row untuk Kelengkapan Dokumen (CARD TERPISAH) -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="mdi mdi-file-document-multiple me-2 text-primary"></i>
                    Kelengkapan Dokumen
                </h5>

                <!-- Alert Info -->
                <div class="konfirmasi-alert konfirmasi-alert-warning" role="alert">
                    <i class="mdi mdi-information-outline me-2"></i>
                    Masih ada 2 dokumen yang perlu dilengkapi
                </div>

                <!-- Tabel Dokumen -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col" style="width: 40%">Nama Dokumen</th>
                                <th scope="col" style="width: 25%">Status</th>
                                <th scope="col" style="width: 20%">Tanggal Upload</th>
                                <th scope="col" style="width: 15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="mdi mdi-credit-card-outline text-primary me-2"></i>
                                        <span>KTP</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-success">Lengkap</span>
                                </td>
                                <td>
                                    <small>12 Feb 2025</small>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" title="Lihat Dokumen">
                                        <i class="mdi mdi-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="mdi mdi-account-multiple-outline text-primary me-2"></i>
                                        <span>KK</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-success">Lengkap</span>
                                </td>
                                <td>
                                    <small>12 Feb 2025</small>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" title="Lihat Dokumen">
                                        <i class="mdi mdi-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="mdi mdi-file-document-outline text-primary me-2"></i>
                                        <span>NPWP</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-success">Lengkap</span>
                                </td>
                                <td>
                                    <small>13 Feb 2025</small>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" title="Lihat Dokumen">
                                        <i class="mdi mdi-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="mdi mdi-cash-multiple text-danger me-2"></i>
                                        <span>Slip Gaji</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-danger">Kurang</span>
                                </td>
                                <td>
                                    <small>-</small>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-secondary" title="Upload Dokumen" disabled>
                                        <i class="mdi mdi-eye-off"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="mdi mdi-bank text-danger me-2"></i>
                                        <span>Rekening Tabungan</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-danger">Kurang</span>
                                </td>
                                <td>
                                    <small>-</small>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-secondary" title="Upload Dokumen" disabled>
                                        <i class="mdi mdi-eye-off"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="mdi mdi-ring text-primary me-2"></i>
                                        <span>Surat Nikah</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-success">Lengkap</span>
                                </td>
                                <td>
                                    <small>14 Feb 2025</small>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" title="Lihat Dokumen">
                                        <i class="mdi mdi-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Informasi Tambahan untuk Mobile -->
                <div class="text-muted small mt-2 d-block d-sm-none">
                    <i class="mdi mdi-information-outline me-1"></i>
                    Geser tabel untuk melihat kolom lainnya
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Row untuk Verifikasi KPR -->
<div class="row mt-4">
    <!-- Kolom Kiri: Form Verifikasi -->
    <div class="col-12 col-lg-8 mb-4 mb-lg-0">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="mdi mdi-help-circle me-2 text-primary"></i>
                    Verifikasi KPR
                </h5>

                <!-- Alert Info -->
                <div class="konfirmasi-alert konfirmasi-alert-warning" role="alert">
                    <i class="mdi mdi-information-outline me-2"></i>
                    Pilih status verifikasi. Keputusan ini akan menentukan langkah selanjutnya.
                </div>

                <!-- Pilihan Status Verifikasi -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card konfirmasi-card-option bg-success text-white" id="pilihSetuju">
                            <div class="card-body text-center py-4">
                                <i class="mdi mdi-check-decagram" style="font-size: 48px;"></i>
                                <h5 class="mt-3 text-white">VERIFIKASI DISETUJUI</h5>
                                <p class="mb-0 small">Lanjut ke tahap Survey</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card konfirmasi-card-option bg-danger text-white" id="pilihTolak">
                            <div class="card-body text-center py-4">
                                <i class="mdi mdi-close-octagon" style="font-size: 48px;"></i>
                                <h5 class="mt-3 text-white">VERIFIKASI DITOLAK</h5>
                                <p class="mb-0 small">Perbaiki dokumen / Tindakan lain</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FORM VERIFIKASI DISETUJUI (muncul jika pilih setuju) -->
                <div id="formSetuju" style="display: none;">
                    <hr class="my-3">
                    <h6 class="mb-3 konfirmasi-text-primary">Form Persetujuan Verifikasi</h6>

                    <div class="konfirmasi-alert konfirmasi-alert-success" role="alert">
                        <i class="mdi mdi-check-circle me-2"></i>
                        <strong>VERIFIKASI DISETUJUI</strong> - Silakan lanjutkan ke tahap Survey
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="konfirmasi-form-group">
                                <label>Catatan Verifikasi</label>
                                <textarea class="konfirmasi-form-control" rows="3" placeholder="Contoh: Semua dokumen lengkap dan valid">Semua dokumen lengkap dan valid</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="konfirmasi-form-group">
                        <label>Upload Berita Acara Verifikasi (Opsional)</label>
                        <div class="konfirmasi-file-upload-modern">
                            <input type="file" id="uploadSetuju" accept=".jpg,.jpeg,.png,.pdf">
                            <div class="konfirmasi-file-label-modern">
                                <i class="mdi mdi-cloud-upload"></i>
                                <div class="konfirmasi-file-info-modern">
                                    <span>Upload Berita Acara</span>
                                    <small>Format: JPG, PNG, PDF (Max 5MB)</small>
                                </div>
                                <span class="konfirmasi-file-size"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FORM VERIFIKASI DITOLAK (muncul jika pilih tolak) -->
                <div id="formTolak" style="display: none;">
                    <hr class="my-3">
                    <h6 class="mb-3 konfirmasi-text-primary">Form Penolakan Verifikasi</h6>

                    <div class="konfirmasi-alert konfirmasi-alert-danger" role="alert">
                        <i class="mdi mdi-close-circle me-2"></i>
                        <strong>VERIFIKASI DITOLAK</strong> - Pilih tindakan selanjutnya
                    </div>

                    <div class="konfirmasi-form-group">
                        <label>Alasan Penolakan</label>
                        <select class="konfirmasi-form-control" id="alasanTolak">
                            <option value="">-- Pilih Alasan --</option>
                            <option value="Dokumen Tidak Lengkap">Dokumen Tidak Lengkap</option>
                            <option value="Dokumen Tidak Valid">Dokumen Tidak Valid</option>
                            <option value="KTP Tidak Jelas">KTP Tidak Jelas</option>
                            <option value="Slip Gaji Tidak Sesuai">Slip Gaji Tidak Sesuai</option>
                            <option value="Data Tidak Cocok">Data Tidak Cocok dengan KTP</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div class="konfirmasi-form-group" id="alasanLainnya" style="display: none;">
                        <label>Tulis Alasan Lainnya</label>
                        <input type="text" class="konfirmasi-form-control" placeholder="Contoh: Dokumen tidak sesuai ketentuan">
                    </div>

                    <div class="konfirmasi-form-group">
                        <label>Catatan untuk Customer</label>
                        <textarea class="konfirmasi-form-control" rows="3" placeholder="Berikan penjelasan detail mengapa ditolak..."></textarea>
                    </div>

                    <hr class="my-3">

                    <!-- TINDAKAN SELANJUTNYA - MODERN CARD STYLE -->
                    <h6 class="mb-3 konfirmasi-text-primary">Tindakan Selanjutnya</h6>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="konfirmasi-tindakan-card">
                                <input type="radio" name="tindakanVerifikasi" id="tindakanLengkapi" checked>
                                <label class="konfirmasi-tindakan-label" for="tindakanLengkapi">
                                    <div class="konfirmasi-tindakan-icon">
                                        <i class="mdi mdi-file-document-edit"></i>
                                    </div>
                                    <div class="konfirmasi-tindakan-content">
                                        <span class="konfirmasi-tindakan-title">Lengkapi Dokumen</span>
                                        <span class="konfirmasi-tindakan-desc">Customer diminta melengkapi dokumen</span>
                                    </div>
                                    <div class="konfirmasi-tindakan-check">
                                        <i class="mdi mdi-check-circle"></i>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="konfirmasi-tindakan-card">
                                <input type="radio" name="tindakanVerifikasi" id="tindakanUlang">
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
                                <input type="radio" name="tindakanVerifikasi" id="tindakanCash">
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
                                <input type="radio" name="tindakanVerifikasi" id="tindakanBatal">
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
                    </div>
                </div>

                <!-- Informasi Tambahan untuk Mobile -->
                <div class="text-muted small mt-2 d-block d-sm-none">
                    <i class="mdi mdi-information-outline me-1"></i>
                    Geser untuk melihat konten lainnya
                </div>
            </div>
        </div>
    </div>

    <!-- Kolom Kanan: Info & Ringkasan -->
    <div class="col-12 col-lg-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="mdi mdi-information me-2 text-primary"></i>
                    Informasi Verifikasi
                </h5>

                <!-- Status Card -->
                <div class="text-center mb-4">
                    <span class="badge badge-warning p-2" style="font-size: 14px;">
                        <i class="mdi mdi-progress-clock me-1"></i>
                        Menunggu Verifikasi Dokumen
                    </span>
                </div>

                <!-- Ringkasan Dokumen -->
                <h6 class="mb-3 konfirmasi-text-primary">Status Dokumen</h6>
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Dokumen Lengkap</span>
                        <span class="fw-medium text-success">4 Dokumen</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Dokumen Kurang</span>
                        <span class="fw-medium text-danger">2 Dokumen</span>
                    </div>
                </div>

                <hr class="my-3">

                <!-- Rekomendasi -->
                <h6 class="mb-3 konfirmasi-text-primary">Rekomendasi</h6>
                <div class="konfirmasi-alert konfirmasi-alert-warning py-2">
                    <i class="mdi mdi-information-outline me-2"></i>
                    Lengkapi dokumen yang kurang sebelum verifikasi
                </div>

                <hr class="my-3">

                <!-- Timeline -->
                <h6 class="mb-3 konfirmasi-text-primary">Timeline Pengajuan</h6>
                <div class="konfirmasi-timeline">
                    <div class="konfirmasi-timeline-item">
                        <div class="konfirmasi-timeline-icon">
                            <i class="mdi mdi-check-circle text-success"></i>
                        </div>
                        <div class="konfirmasi-timeline-content">
                            <span class="konfirmasi-timeline-text">Pengajuan KPR</span>
                            <small class="konfirmasi-timeline-date">15 Mar 2025</small>
                        </div>
                    </div>
                </div>

                <hr class="my-3">

                <!-- Tombol Aksi -->
                <button class="konfirmasi-btn konfirmasi-btn-primary w-100 mb-2" id="btnSimpan">
                    <i class="mdi mdi-content-save me-2"></i>
                    Simpan Verifikasi
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

@push('scripts')
<script>
$(document).ready(function() {
    // Pilih Verifikasi Disetujui
    $('#pilihSetuju').click(function() {
        $('#formSetuju').slideDown();
        $('#formTolak').slideUp();
        $('#pilihSetuju').addClass('border border-white border-3');
        $('#pilihTolak').removeClass('border border-white border-3');
    });

    // Pilih Verifikasi Ditolak
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
            label.text('Upload File');
            sizeSpan.text('');
        }
    });

    // Handler untuk tombol Simpan
    $('#btnSimpan').click(function() {
        alert('Verifikasi berhasil disimpan (demo)');
    });
});
</script>
@endpush
