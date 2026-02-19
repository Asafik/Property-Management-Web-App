@extends('layouts.partial.app')

@section('title', 'Survey KPR - Properti Management')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/marketing/survey.css') }}">

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
                    Tahapan Survey KPR
                </h5>

                <!-- Progress Bar -->
                <div class="mb-4">
                    <div class="d-flex flex-wrap justify-content-between mb-2">
                        <span class="text-muted">Progress Survey</span>
                        <span class="text-primary">Tahap 3 dari 5</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
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
                                <span class="d-block text-success small fw-medium">Pengajuan</span>
                                <small class="text-muted d-none d-sm-block">12 Feb 2025</small>
                            </div>
                        </div>
                        <div class="col-4 col-md text-center mb-3 mb-md-0">
                            <div class="step completed">
                                <div class="step-icon bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 35px; height: 35px;">
                                    <i class="mdi mdi-check" style="font-size: 18px;"></i>
                                </div>
                                <span class="d-block text-success small fw-medium">Verifikasi</span>
                                <small class="text-muted d-none d-sm-block">14 Feb 2025</small>
                            </div>
                        </div>
                        <div class="col-4 col-md text-center mb-3 mb-md-0">
                            <div class="step active">
                                <div class="step-icon bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 35px; height: 35px;">
                                    <i class="mdi mdi-home" style="font-size: 18px;"></i>
                                </div>
                                <span class="d-block small fw-medium">Survey</span>
                                <small class="text-muted d-none d-sm-block">Sedang Proses</small>
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

<!-- Row untuk Survey -->
<div class="row mt-4">
    <!-- Form Survey -->
    <div class="col-12 col-lg-8 mb-4 mb-lg-0">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="mdi mdi-home-map-marker me-2 text-primary"></i>
                    Form Survey Lapangan
                </h5>

                <!-- Alert Info -->
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <i class="mdi mdi-information-outline me-2"></i>
                    Isi hasil survey unit dengan lengkap. Data ini akan digunakan bank untuk penilaian.
                </div>

                <!-- Info Jadwal Survey -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="survey-form-group">
                            <label>Tanggal Survey</label>
                            <input type="date" class="survey-form-control" value="2025-02-20">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="survey-form-group">
                            <label>Jam Survey</label>
                            <input type="time" class="survey-form-control" value="10:00">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="survey-form-group">
                            <label>Surveyor</label>
                            <select class="survey-form-control">
                                <option>Pilih Surveyor</option>
                                <option selected>Hendra Wijaya (Tim Bank)</option>
                                <option>Bambang Supriadi (Tim Bank)</option>
                                <option>Rudi Hermawan (Internal)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <hr class="my-3">

                <h6 class="mb-3 fw-bold" style="color: #9a55ff;">Hasil Penilaian Unit</h6>

                <div class="row">
                    <div class="col-md-6">
                        <div class="survey-form-group">
                            <label>Nilai Pasar Unit <span class="text-danger">*</span></label>
                            <div class="survey-input-group">
                                <div class="survey-input-group-prepend">
                                    <span class="survey-input-group-text">Rp</span>
                                </div>
                                <input type="text" class="survey-form-control" value="450.000.000">
                            </div>
                            <small class="survey-text-muted">Sesuai harga jual unit</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="survey-form-group">
                            <label>Nilai Appraisal <span class="text-danger">*</span></label>
                            <div class="survey-input-group">
                                <div class="survey-input-group-prepend">
                                    <span class="survey-input-group-text">Rp</span>
                                </div>
                                <input type="text" class="survey-form-control" value="445.000.000">
                            </div>
                            <small class="survey-text-muted">Penilaian dari surveyor</small>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="survey-form-group">
                            <label>Luas Tanah</label>
                            <div class="survey-input-group">
                                <input type="text" class="survey-form-control" value="90">
                                <div class="survey-input-group-prepend">
                                    <span class="survey-input-group-text">m²</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="survey-form-group">
                            <label>Luas Bangunan</label>
                            <div class="survey-input-group">
                                <input type="text" class="survey-form-control" value="45">
                                <div class="survey-input-group-prepend">
                                    <span class="survey-input-group-text">m²</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="survey-form-group">
                            <label>Kondisi Bangunan</label>
                            <select class="survey-form-control">
                                <option>Pilih Kondisi</option>
                                <option selected>Baru (0-2 tahun)</option>
                                <option>Baik (2-5 tahun)</option>
                                <option>Cukup (5-10 tahun)</option>
                                <option>Perlu Renovasi</option>
                            </select>
                        </div>
                    </div>
                </div>

                <hr class="my-3">

                <!-- CHECKLIST KONDISI UNIT -->
                <div class="mb-4">
                    <h6 class="mb-3 fw-bold" style="color: #9a55ff;">
                        <i class="mdi mdi-checkbox-marked-outline me-2"></i>
                        Checklist Kondisi Unit
                    </h6>

                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="me-2" id="listrik" checked>
                                <label for="listrik">Instalasi Listrik</label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="me-2" id="air" checked>
                                <label for="air">PDAM / Air Bersih</label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="me-2" id="akses" checked>
                                <label for="akses">Akses Jalan</label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="me-2" id="sertifikat" checked>
                                <label for="sertifikat">Sertifikat Sesuai</label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="me-2" id="shm" checked>
                                <label for="shm">SHM / SHGB</label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="me-2" id="imb" checked>
                                <label for="imb">IMB</label>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-3">

                <h6 class="mb-3 fw-bold" style="color: #9a55ff;">Dokumentasi Survey</h6>

                <div class="row">
                    <div class="col-md-4">
                        <div class="survey-form-group">
                            <label>Foto Tampak Depan</label>
                            <div class="survey-file-upload">
                                <input type="file" id="fotoDepan" name="fotoDepan" accept=".jpg,.jpeg,.png">
                                <div class="survey-file-label">
                                    <i class="mdi mdi-camera"></i>
                                    <div class="survey-file-info">
                                        <span>Upload Foto</span>
                                        <small>Max 5MB</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="survey-form-group">
                            <label>Foto Interior</label>
                            <div class="survey-file-upload">
                                <input type="file" id="fotoInterior" name="fotoInterior" accept=".jpg,.jpeg,.png">
                                <div class="survey-file-label">
                                    <i class="mdi mdi-camera"></i>
                                    <div class="survey-file-info">
                                        <span>Upload Foto</span>
                                        <small>Max 5MB</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="survey-form-group">
                            <label>Foto Lingkungan</label>
                            <div class="survey-file-upload">
                                <input type="file" id="fotoLingkungan" name="fotoLingkungan" accept=".jpg,.jpeg,.png">
                                <div class="survey-file-label">
                                    <i class="mdi mdi-camera"></i>
                                    <div class="survey-file-info">
                                        <span>Upload Foto</span>
                                        <small>Max 5MB</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-3">

                <h6 class="mb-3 fw-bold" style="color: #9a55ff;">Catatan Survey</h6>

                <div class="survey-form-group">
                    <textarea class="survey-form-control" rows="3" placeholder="Contoh: Lokasi strategis dekat jalan raya, lingkungan aman, akses mudah">Lokasi strategis dekat jalan raya, lingkungan aman, akses mudah ke fasilitas umum. Kondisi bangunan baru dan terawat.</textarea>
                </div>

                <hr class="my-3">

                <h6 class="mb-3 fw-bold" style="color: #9a55ff;">Rekomendasi</h6>

                <div class="row">
                    <div class="col-md-6">
                        <div class="survey-form-group">
                            <label>Status Rekomendasi</label>
                            <select class="survey-form-control">
                                <option>Pilih Rekomendasi</option>
                                <option selected>Layak - Sesuai Harga</option>
                                <option>Layak - Dengan Penyesuaian Harga</option>
                                <option>Tidak Layak</option>
                                <option>Perlu Survey Ulang</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="survey-form-group">
                            <label>Persentase Kelayakan</label>
                            <div class="survey-input-group">
                                <input type="text" class="survey-form-control" value="95">
                                <div class="survey-input-group-prepend">
                                    <span class="survey-input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kolom Kanan: Info Survey & Aksi -->
    <div class="col-12 col-lg-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="mdi mdi-clipboard-text me-2 text-primary"></i>
                    Status Survey
                </h5>

                <!-- Status Badge -->
                <div class="text-center mb-4">
                    <span class="badge badge-warning p-2" style="font-size: 14px; background: linear-gradient(135deg, #ffc107, #ffdb6d); color: #2c2e3f;">
                        <i class="mdi mdi-progress-clock me-1"></i>
                        Menunggu Hasil Survey
                    </span>
                </div>

                <!-- Info Survey -->
                <div class="mb-4">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Surveyor</span>
                        <span class="fw-medium">Hendra Wijaya</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Asal Surveyor</span>
                        <span class="fw-medium">Tim Bank ABC</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Tanggal Survey</span>
                        <span class="fw-medium">20 Feb 2025</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Waktu</span>
                        <span class="fw-medium">10:00 WIB</span>
                    </div>
                </div>

                <hr class="my-3">

                <!-- Ringkasan Hasil -->
                <h6 class="mb-3 fw-bold" style="color: #9a55ff;">Ringkasan Hasil</h6>
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Nilai Appraisal</span>
                        <span class="fw-medium">Rp 445 Juta</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Selisih Harga</span>
                        <span class="fw-medium text-danger">- Rp 5 Juta</span>
                    </div>
                </div>

                <!-- Progress Checklist -->
                <h6 class="mb-3 fw-bold" style="color: #9a55ff;">Progress Checklist</h6>
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-muted">Checklist Kondisi</span>
                        <span class="fw-medium">6/6</span>
                    </div>
                    <div class="progress mb-3" style="height: 5px;">
                        <div class="progress-bar bg-success" style="width: 100%;"></div>
                    </div>

                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-muted">Upload Foto</span>
                        <span class="fw-medium">3/3</span>
                    </div>
                    <div class="progress mb-3" style="height: 5px;">
                        <div class="progress-bar bg-success" style="width: 100%;"></div>
                    </div>

                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-muted">Catatan</span>
                        <span class="fw-medium">Lengkap</span>
                    </div>
                    <div class="progress mb-3" style="height: 5px;">
                        <div class="progress-bar bg-success" style="width: 100%;"></div>
                    </div>
                </div>

                <hr class="my-3">

                <!-- Timeline Survey -->
                <h6 class="mb-3 fw-bold" style="color: #9a55ff;">Timeline Survey</h6>
                <div class="timeline">
                    <div class="d-flex mb-3">
                        <div class="me-3">
                            <i class="mdi mdi-check-circle text-success"></i>
                        </div>
                        <div>
                            <span class="d-block fw-medium">Dijadwalkan</span>
                            <small class="text-muted">19 Feb 2025 - 14:30</small>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="me-3">
                            <i class="mdi mdi-progress-clock text-primary"></i>
                        </div>
                        <div>
                            <span class="d-block fw-medium">Survey Berlangsung</span>
                            <small class="text-muted">20 Feb 2025 - 10:00</small>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="me-3">
                            <i class="mdi mdi-clock-outline text-muted"></i>
                        </div>
                        <div>
                            <span class="d-block fw-medium">Hasil Survey</span>
                            <small class="text-muted">Belum diisi</small>
                        </div>
                    </div>
                </div>

                <hr class="my-3">

                <!-- Tombol Aksi -->
                <div class="d-flex flex-column gap-2">
                    <button class="survey-btn survey-btn-success w-100">
                        <i class="mdi mdi-content-save me-2"></i>
                        Simpan Hasil Survey
                    </button>

                    <button class="survey-btn survey-btn-primary w-100">
                        <i class="mdi mdi-check-circle me-2"></i>
                        Selesaikan Survey
                    </button>

                    <button class="survey-btn survey-btn-outline-warning w-100">
                        <i class="mdi mdi-calendar-refresh me-2"></i>
                        Reschedule Survey
                    </button>

                    <button class="survey-btn survey-btn-outline-secondary w-100">
                        <i class="mdi mdi-arrow-left me-2"></i>
                        Kembali ke Proses KPR
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Custom styles untuk konsistensi dengan halaman verifikasi */
    .bg-light {
        background-color: #f8f9fc !important;
    }

    .badge {
        padding: 5px 10px;
        font-weight: 500;
    }

    .timeline .d-flex {
        align-items: flex-start;
    }

    .timeline i {
        font-size: 18px;
    }

    /* Progress steps styling */
    .timeline-steps .step .step-icon {
        transition: all 0.3s ease;
    }

    .timeline-steps .step.completed .step-icon {
        background-color: #28a745 !important;
    }

    .timeline-steps .step.active .step-icon {
        background-color: #9a55ff !important;
        box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.2);
    }

    /* Responsive */
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

    /* Utility */
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
    document.addEventListener('DOMContentLoaded', function() {
        // Handler untuk file upload - menampilkan nama file
        const fileInputs = document.querySelectorAll('.survey-file-upload input[type="file"]');
        fileInputs.forEach(input => {
            input.addEventListener('change', function(e) {
                const fileName = e.target.files[0]?.name;
                const label = this.closest('.survey-file-upload').querySelector('.survey-file-info span');
                if (fileName && label) {
                    label.textContent = fileName.length > 30 ? fileName.substring(0, 30) + '...' : fileName;
                }
            });
        });

        // Handler untuk tombol-tombol aksi
        const btnSimpan = document.querySelector('.survey-btn-success');
        if (btnSimpan) {
            btnSimpan.addEventListener('click', function() {
                alert('Hasil survey disimpan');
            });
        }

        const btnSelesaikan = document.querySelector('.survey-btn-primary');
        if (btnSelesaikan) {
            btnSelesaikan.addEventListener('click', function() {
                alert('Survey selesai, lanjut ke tahap berikutnya');
            });
        }
    });
</script>
@endpush
