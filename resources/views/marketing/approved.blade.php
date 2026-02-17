@extends('layouts.partial.app')

@section('title', 'Pencairan Dana KPR - Properti Management')
@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/marketing/approved.css') }}">


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
                    Tahapan Pencairan Dana
                </h5>

                <!-- Progress Bar -->
                <div class="mb-4">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Progress Pencairan</span>
                        <span class="text-primary">Tahap 5 dari 5</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
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
                        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 35px; height: 35px;">
                            <i class="mdi mdi-check" style="font-size: 18px;"></i>
                        </div>
                        <span class="d-block text-success small fw-medium">Akad</span>
                        <small class="text-muted">5 Mar 2025</small>
                    </div>
                    <div class="col text-center">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 35px; height: 35px;">
                            <i class="mdi mdi-cash" style="font-size: 18px;"></i>
                        </div>
                        <span class="d-block small fw-medium">Cair</span>
                        <small class="text-muted">Sedang Proses</small>
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

                <hr class="cair-hr">

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

<!-- Row untuk Pencairan Dana -->
<div class="row">
    <!-- Kolom Kiri: Form & Info Pencairan -->
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="mdi mdi-cash-multiple me-2 text-primary"></i>
                    Pencairan Dana KPR
                </h5>

                <!-- Alert Info -->
                <div class="cair-alert cair-alert-info" role="alert">
                    <i class="mdi mdi-information-outline me-2"></i>
                    Proses pencairan dana dari bank ke rekening developer. Pastikan semua dokumen lengkap.
                </div>

                <!-- Status Pencairan -->
                <div class="cair-card bg-light mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="cair-status-icon me-3">
                                <i class="mdi mdi-progress-clock"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Status Pencairan</h6>
                                <p class="cair-text-muted mb-0">Menunggu proses transfer dari bank</p>
                            </div>
                            <div class="ms-auto">
                                <span class="cair-badge cair-badge-warning">Proses</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Akad -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="cair-border-card">
                            <div class="card-body">
                                <small class="cair-text-muted d-block">Tanggal Akad</small>
                                <span class="fw-medium">5 Maret 2025</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="cair-border-card">
                            <div class="card-body">
                                <small class="cair-text-muted d-block">No. Akta AJB</small>
                                <span class="fw-medium">AJB/123/III/2025</span>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="cair-hr">

                <h6 class="cair-text-primary mb-3">Detail Pencairan</h6>

                <div class="row">
                    <div class="col-md-6">
                        <div class="cair-form-group">
                            <label>Nilai Pencairan</label>
                            <div class="cair-input-group">
                                <div class="cair-input-group-prepend">
                                    <span class="cair-input-group-text">Rp</span>
                                </div>
                                <input type="text" class="cair-form-control" value="360.000.000" readonly>
                            </div>
                            <small class="cair-text-muted">Sesuai SP3K</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="cair-form-group">
                            <label>Tanggal Pencairan</label>
                            <input type="date" class="cair-form-control" value="2025-03-10">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="cair-form-group">
                            <label>No. Referensi Transfer</label>
                            <input type="text" class="cair-form-control" placeholder="TT123456789">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="cair-form-group">
                            <label>Bank Pengirim</label>
                            <input type="text" class="cair-form-control" value="Bank ABC Syariah" readonly>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="cair-form-group">
                            <label>Rekening Tujuan</label>
                            <input type="text" class="cair-form-control" value="PT. Properti Management - 1234567890 (BCA)">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="cair-form-group">
                            <label>Status Transfer</label>
                            <select class="cair-form-control">
                                <option value="proses" selected>Proses Transfer</option>
                                <option value="berhasil">Berhasil (Dana Masuk)</option>
                                <option value="gagal">Gagal / Tertunda</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="cair-form-group">
                    <label>Upload Bukti Transfer</label>
                    <div class="cair-file-upload-modern">
                        <input type="file" id="uploadBukti" name="uploadBukti" accept=".jpg,.jpeg,.png,.pdf">
                        <div class="cair-file-label-modern">
                            <i class="mdi mdi-cloud-upload"></i>
                            <div class="cair-file-info-modern">
                                <span>Upload Bukti Transfer</span>
                                <small>Format: JPG, PNG, PDF (Max 5MB)</small>
                            </div>
                            <span class="cair-file-size"></span>
                        </div>
                    </div>
                </div>

                <hr class="cair-hr">

                <h6 class="cair-text-primary mb-3">Riwayat Pembayaran Customer</h6>

                <div class="cair-table-responsive">
                    <table class="cair-table">
                        <thead>
                            <tr>
                                <th>Keterangan</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Booking Fee</td>
                                <td>Rp 10.000.000</td>
                                <td><span class="cair-badge cair-badge-success">Lunas</span></td>
                            </tr>
                            <tr>
                                <td>DP 20%</td>
                                <td>Rp 90.000.000</td>
                                <td><span class="cair-badge cair-badge-success">Lunas</span></td>
                            </tr>
                            <tr>
                                <td>Biaya Notaris</td>
                                <td>Rp 5.000.000</td>
                                <td><span class="cair-badge cair-badge-success">Lunas</span></td>
                            </tr>
                            <tr>
                                <td>BPHTB</td>
                                <td>Rp 4.500.000</td>
                                <td><span class="cair-badge cair-badge-success">Lunas</span></td>
                            </tr>
                            <tr class="fw-bold">
                                <td>Total Pembayaran</td>
                                <td>Rp 109.500.000</td>
                                <td><span class="cair-badge cair-badge-primary">Lunas</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="cair-card bg-success text-white mt-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <span class="fw-medium">Pencairan dari Bank</span>
                            <span class="fw-medium">Rp 360.000.000</span>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <span class="fw-medium">Total Keseluruhan</span>
                            <span class="fw-medium">Rp 469.500.000</span>
                        </div>
                        <small class="d-block mt-2">(Harga Unit + Biaya Akad)</small>
                    </div>
                </div>

                <hr class="cair-hr">

                <h6 class="cair-text-primary mb-3">Serah Terima Unit</h6>

                <div class="row">
                    <div class="col-md-6">
                        <div class="cair-form-group">
                            <label>Jadwal Serah Terima Kunci</label>
                            <input type="date" class="cair-form-control" value="2025-03-15">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="cair-form-group">
                            <label>Status Unit</label>
                            <select class="cair-form-control">
                                <option value="siap">Siap Serah Terima</option>
                                <option value="sudah">Sudah Diserahkan</option>
                                <option value="tunda">Ditunda</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="cair-form-group">
                    <label>Catatan Serah Terima</label>
                    <textarea class="cair-form-control" rows="2" placeholder="Contoh: Unit dalam kondisi baik, listrik dan air sudah aktif"></textarea>
                </div>
            </div>
        </div>
    </div>

    <!-- Kolom Kanan: Info Pencairan & Aksi -->
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="mdi mdi-clipboard-text me-2 text-primary"></i>
                    Status Pencairan
                </h5>

                <!-- Status Badge -->
                <div class="text-center mb-4">
                    <span class="cair-badge cair-badge-warning" style="font-size: 14px;">
                        <i class="mdi mdi-progress-clock me-1"></i>
                        Menunggu Transfer Bank
                    </span>
                </div>

                <!-- Info Pencairan -->
                <div class="mb-4">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Nilai Cair</span>
                        <span class="fw-medium cair-text-primary">Rp 360 Juta</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Tanggal Cair</span>
                        <span class="fw-medium">10 Maret 2025</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Bank</span>
                        <span class="fw-medium">Bank ABC Syariah</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">No. SP3K</span>
                        <span class="fw-medium">SP3K/2025/021</span>
                    </div>
                </div>

                <hr class="cair-hr">

                <!-- Ringkasan -->
                <h6 class="cair-text-primary mb-3">Ringkasan Transaksi</h6>
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Harga Unit</span>
                        <span class="fw-medium">Rp 450 Juta</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">DP + Biaya</span>
                        <span class="fw-medium">Rp 109.5 Juta</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Pencairan Bank</span>
                        <span class="fw-medium cair-text-success">Rp 360 Juta</span>
                    </div>
                    <hr class="cair-hr">
                    <div class="d-flex justify-content-between">
                        <span class="fw-medium">Total</span>
                        <span class="fw-medium cair-text-primary">Rp 469.5 Juta</span>
                    </div>
                </div>

                <hr class="cair-hr">

                <!-- Checklist Dokumen -->
                <h6 class="cair-text-primary mb-3">Dokumen Pencairan</h6>
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Akta AJB</span>
                        <span class="cair-badge cair-badge-success">Ada</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>SP3K Asli</span>
                        <span class="cair-badge cair-badge-success">Ada</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Sertifikat</span>
                        <span class="cair-badge cair-badge-warning">Proses</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Bukti Transfer</span>
                        <span class="cair-badge cair-badge-danger">Belum</span>
                    </div>
                </div>

                <hr class="cair-hr">

                <!-- Timeline Pencairan -->
                <h6 class="cair-text-primary mb-3">Timeline</h6>
                <div class="cair-timeline">
                    <div class="cair-timeline-item">
                        <div class="cair-timeline-icon">
                            <i class="mdi mdi-check-circle text-success"></i>
                        </div>
                        <div class="cair-timeline-content">
                            <span class="cair-timeline-title">Akad Selesai</span>
                            <span class="cair-timeline-date">5 Maret 2025</span>
                        </div>
                    </div>
                    <div class="cair-timeline-item">
                        <div class="cair-timeline-icon">
                            <i class="mdi mdi-progress-clock text-primary"></i>
                        </div>
                        <div class="cair-timeline-content">
                            <span class="cair-timeline-title">Pengajuan Pencairan ke Bank</span>
                            <span class="cair-timeline-date">6 Maret 2025</span>
                        </div>
                    </div>
                    <div class="cair-timeline-item">
                        <div class="cair-timeline-icon">
                            <i class="mdi mdi-clock-outline text-muted"></i>
                        </div>
                        <div class="cair-timeline-content">
                            <span class="cair-timeline-title">Target Dana Cair</span>
                            <span class="cair-timeline-date">10 Maret 2025</span>
                        </div>
                    </div>
                </div>

                <hr class="cair-hr">

                <!-- Tombol Aksi -->
                <button class="cair-btn cair-btn-success w-100 mb-2">
                    <i class="mdi mdi-check-circle me-2"></i>
                    Konfirmasi Dana Cair
                </button>

                <button onclick="window.open('/dashboard-cetak-laporan', '_blank')" class="cair-btn cair-btn-primary w-100 mb-2">
                    <i class="mdi mdi-printer me-2"></i>
                    Cetak Laporan
                </button>

                <button class="cair-btn cair-btn-info w-100 mb-2">
                    <i class="mdi mdi-whatsapp me-2"></i>
                    Notifikasi Customer
                </button>

                <button class="cair-btn cair-btn-outline-warning w-100 mb-2">
                    <i class="mdi mdi-key me-2"></i>
                    Serah Terima Kunci
                </button>

                <button class="cair-btn cair-btn-outline-secondary w-100">
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
    .badge {
        padding: 5px 10px;
    }
    .timeline .d-flex {
        align-items: flex-start;
    }
    .timeline i {
        font-size: 18px;
    }
    hr {
        border-top: 1px solid rgba(0,0,0,.1);
    }
    .table td, .table th {
        padding: 0.75rem;
    }
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // File upload modern preview
    $('.cair-file-upload-modern input[type="file"]').change(function(e) {
        const fileName = e.target.files[0]?.name;
        const fileSize = e.target.files[0]?.size;
        const label = $(this).closest('.cair-file-upload-modern').find('.cair-file-info-modern span');
        const sizeSpan = $(this).closest('.cair-file-upload-modern').find('.cair-file-size');

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
});
</script>
@endpush
