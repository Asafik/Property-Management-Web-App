@extends('layouts.partial.app')

@section('title', 'Vertifikasi KPR - Properti Management')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/marketing/vertifikasi.css') }}">
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
                                <small class="text-muted d-none d-sm-block">12 Feb 2025</small>
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

                <hr class="my-3">

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

<!-- Row untuk Dokumen dan Aksi -->
<div class="row mt-4">
    <!-- Checklist Dokumen - Tabel -->
    <div class="col-12 col-lg-8 mb-4 mb-lg-0">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="mdi mdi-file-document-multiple me-2 text-primary"></i>
                    Kelengkapan Dokumen
                </h5>

                <!-- Alert Info -->
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
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
                                    <button class="verifikasi-btn verifikasi-btn-outline-primary" style="padding: 0.25rem 0.5rem; font-size: 0.875rem;" title="Lihat Dokumen">
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
                                    <button class="verifikasi-btn verifikasi-btn-outline-primary" style="padding: 0.25rem 0.5rem; font-size: 0.875rem;" title="Lihat Dokumen">
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
                                    <button class="verifikasi-btn verifikasi-btn-outline-primary" style="padding: 0.25rem 0.5rem; font-size: 0.875rem;" title="Lihat Dokumen">
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
                                    <button class="verifikasi-btn verifikasi-btn-outline-secondary" style="padding: 0.25rem 0.5rem; font-size: 0.875rem;" title="Upload Dokumen" disabled>
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
                                    <button class="verifikasi-btn verifikasi-btn-outline-secondary" style="padding: 0.25rem 0.5rem; font-size: 0.875rem;" title="Upload Dokumen" disabled>
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
                                    <button class="verifikasi-btn verifikasi-btn-outline-primary" style="padding: 0.25rem 0.5rem; font-size: 0.875rem;" title="Lihat Dokumen">
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

    <!-- Aksi Cepat dengan UPLOAD DOKUMEN dan BUTTON HOVER dari Verifikasi KPR -->
    <div class="col-12 col-lg-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="mdi mdi-lightning-bolt me-2 text-primary"></i>
                    Aksi Verifikasi
                </h5>

                <!-- UPLOAD DOKUMEN - Styling dari Verifikasi KPR -->
                <div class="verifikasi-form-group mb-4">
                    <label for="uploadDokumen" class="verifikasi-text-primary">Upload Dokumen Baru</label>
                    <div class="verifikasi-file-upload">
                        <input type="file" id="uploadDokumen" name="uploadDokumen" accept=".jpg,.jpeg,.png,.pdf">
                        <div class="verifikasi-file-label">
                            <i class="mdi mdi-cloud-upload"></i>
                            <div class="verifikasi-file-info">
                                <span>Upload Dokumen</span>
                                <small>Klik untuk upload (Max 5MB)</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- BUTTON - Styling dan HOVER dari Verifikasi KPR -->
                <div class="d-flex flex-column gap-2">
                    <button class="verifikasi-btn verifikasi-btn-primary w-100">
                        <i class="mdi mdi-upload me-2"></i>
                        Upload Dokumen
                    </button>

                    <button class="verifikasi-btn verifikasi-btn-outline-primary w-100">
                        <i class="mdi mdi-bank-transfer me-2"></i>
                        Ajukan ke Bank Lain
                    </button>

                    <!-- TAMBAHAN 2 BUTTON BARU -->
                    <button class="verifikasi-btn verifikasi-btn-success w-100">
                        <i class="mdi mdi-check-circle me-2"></i>
                        Lanjut ke Survey
                    </button>

                    <button class="verifikasi-btn verifikasi-btn-outline-warning w-100">
                        <i class="mdi mdi-file-document-edit me-2"></i>
                        Revisi
                    </button>

                    <button class="verifikasi-btn verifikasi-btn-outline-secondary w-100">
                        <i class="mdi mdi-chat me-2"></i>
                        Konsultasi dengan Marketing
                    </button>
                </div>

                <!-- Info Tambahan -->
                <hr class="my-3">

                <div class="small">
                    <div class="d-flex align-items-center text-success mb-2">
                        <i class="mdi mdi-check-circle me-2"></i>
                        <span>4 Dokumen Lengkap</span>
                    </div>
                    <div class="d-flex align-items-center text-danger">
                        <i class="mdi mdi-close-circle me-2"></i>
                        <span>2 Dokumen Kurang</span>
                    </div>
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

    .badge {
        padding: 5px 10px;
        font-weight: 500;
    }

    .badge.bg-success {
        background-color: #28a745 !important;
        color: white;
    }

    .badge.bg-danger {
        background-color: #dc3545 !important;
        color: white;
    }

    .table th {
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #495057;
    }

    .table td {
        vertical-align: middle;
        padding: 0.75rem;
    }

    .table tbody tr:hover {
        background-color: #f8f9fa;
    }

    @media (max-width: 576px) {
        .timeline-steps .step small {
            display: none !important;
        }
        .timeline-steps .step-icon {
            width: 30px !important;
            height: 30px !important;
        }
        .timeline-steps .step-icon i {
            font-size: 16px !important;
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

    .table-responsive {
        border-radius: 8px;
        overflow-x: auto;
    }

    .table-responsive::-webkit-scrollbar {
        height: 6px;
    }
    .table-responsive::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    .table-responsive::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 10px;
    }
    .table-responsive::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handler untuk tombol view
        const viewButtons = document.querySelectorAll('.verifikasi-btn-outline-primary:not([disabled])');
        viewButtons.forEach(button => {
            button.addEventListener('click', function() {
                const row = this.closest('tr');
                const documentName = row.querySelector('td:first-child span').textContent;
                alert('Melihat dokumen: ' + documentName);
            });
        });

        // Handler untuk tombol Lanjut ke Survey
        const btnSurvey = document.querySelector('.verifikasi-btn-success');
        if (btnSurvey) {
            btnSurvey.addEventListener('click', function() {
                alert('Lanjut ke tahap Survey');
            });
        }

        // Handler untuk tombol Revisi
        const btnRevisi = document.querySelector('.verifikasi-btn-outline-warning');
        if (btnRevisi) {
            btnRevisi.addEventListener('click', function() {
                alert('Revisi dokumen diperlukan');
            });
        }

        // Handler untuk file upload - menampilkan nama file
        const fileInput = document.getElementById('uploadDokumen');
        if (fileInput) {
            fileInput.addEventListener('change', function(e) {
                const fileName = e.target.files[0]?.name;
                const label = this.closest('.verifikasi-file-upload').querySelector('.verifikasi-file-info span');
                if (fileName && label) {
                    label.textContent = fileName.length > 30 ? fileName.substring(0, 30) + '...' : fileName;
                }
            });
        }
    });
</script>
@endpush
