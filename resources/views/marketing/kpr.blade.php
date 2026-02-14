@extends('layouts.partial.app')

@section('title', 'Proses KPR - Properti Management')

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
                        <span class="text-primary">Tahap 2 dari 5</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 40%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
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
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 35px; height: 35px;">
                            <i class="mdi mdi-file-document" style="font-size: 18px;"></i>
                        </div>
                        <span class="d-block small fw-medium">Verifikasi</span>
                        <small class="text-muted">Sedang Proses</small>
                    </div>
                    <div class="col text-center">
                        <div class="bg-light text-muted rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 35px; height: 35px;">
                            <i class="mdi mdi-home" style="font-size: 18px;"></i>
                        </div>
                        <span class="d-block text-muted small fw-medium">Survey</span>
                        <small class="text-muted">Menunggu</small>
                    </div>
                    <div class="col text-center">
                        <div class="bg-light text-muted rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 35px; height: 35px;">
                            <i class="mdi mdi-handshake" style="font-size: 18px;"></i>
                        </div>
                        <span class="d-block text-muted small fw-medium">Akad</span>
                        <small class="text-muted">Menunggu</small>
                    </div>
                    <div class="col text-center">
                        <div class="bg-light text-muted rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 35px; height: 35px;">
                            <i class="mdi mdi-cash" style="font-size: 18px;"></i>
                        </div>
                        <span class="d-block text-muted small fw-medium">Cair</span>
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

<!-- Row untuk Dokumen dan Aksi -->
<div class="row">
    <!-- Checklist Dokumen -->
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
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

                <!-- List Dokumen -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center justify-content-between p-2 mb-2 bg-light rounded">
                            <div>
                                <i class="mdi mdi-check-circle text-success me-2"></i>
                                <span>KTP</span>
                            </div>
                            <span class="badge badge-success">Lengkap</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center justify-content-between p-2 mb-2 bg-light rounded">
                            <div>
                                <i class="mdi mdi-check-circle text-success me-2"></i>
                                <span>KK</span>
                            </div>
                            <span class="badge badge-success">Lengkap</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center justify-content-between p-2 mb-2 bg-light rounded">
                            <div>
                                <i class="mdi mdi-check-circle text-success me-2"></i>
                                <span>NPWP</span>
                            </div>
                            <span class="badge badge-success">Lengkap</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center justify-content-between p-2 mb-2 bg-light rounded">
                            <div>
                                <i class="mdi mdi-close-circle text-danger me-2"></i>
                                <span>Slip Gaji</span>
                            </div>
                            <span class="badge badge-danger">Kurang</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center justify-content-between p-2 mb-2 bg-light rounded">
                            <div>
                                <i class="mdi mdi-close-circle text-danger me-2"></i>
                                <span>Rekening Tabungan</span>
                            </div>
                            <span class="badge badge-danger">Kurang</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center justify-content-between p-2 mb-2 bg-light rounded">
                            <div>
                                <i class="mdi mdi-check-circle text-success me-2"></i>
                                <span>Surat Nikah</span>
                            </div>
                            <span class="badge badge-success">Lengkap</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Aksi Cepat -->
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="mdi mdi-lightning-bolt me-2 text-primary"></i>
                    Aksi Cepat
                </h5>

                <button class="btn btn-primary btn-block mb-2">
                    <i class="mdi mdi-upload me-2"></i>
                    Upload Dokumen
                </button>

                <button class="btn btn-outline-primary btn-block mb-2">
                    <i class="mdi mdi-bank-transfer me-2"></i>
                    Ajukan ke Bank Lain
                </button>

                <button class="btn btn-outline-secondary btn-block">
                    <i class="mdi mdi-chat me-2"></i>
                    Konsultasi dengan Marketing
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Custom style hanya jika diperlukan, tapi sebagian besar pakai bawaan dashboard */
    .bg-light {
        background-color: #f8f9fc !important;
    }
    .btn-block {
        width: 100%;
    }
    .badge {
        padding: 5px 10px;
    }
</style>
@endpush

@push('scripts')
<!-- Script kosong, fokus UI -->
@endpush
