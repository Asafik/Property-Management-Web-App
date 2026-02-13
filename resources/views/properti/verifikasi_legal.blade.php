@extends('layouts.partial.app')

@section('title', 'Verifikasi Legal - Property Management App')

@section('content')
<!-- KONTEN VERIFIKASI LEGAL -->
<div class="container-fluid p-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="text-dark">Verifikasi Legal Properti</h3>
            <p class="text-muted">Periksa dan verifikasi kelengkapan dokumen legal tanah</p>
        </div>
    </div>

    <!-- Info Properti -->
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-information-outline text-primary me-2"></i>
                        Informasi Properti
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="text-muted small">Nama Tanah / Proyek</label>
                                <p class="fw-bold">Green Lake City</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="text-muted small">Status Kepemilikan</label>
                                <p class="fw-bold">Sertifikat Hak Milik (SHM)</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="text-muted small">Luas Tanah</label>
                                <p class="fw-bold">5.000 m²</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="text-muted small">Tanggal Pengajuan</label>
                                <p class="fw-bold">13 Februari 2026</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-2">
                                <label class="text-muted small">Alamat Lengkap</label>
                                <p class="fw-bold">Jl. Raya No. 123, RT 001/RW 002, Kel. Kebon Jeruk, Kec. Kebon Jeruk, Jakarta Selatan, DKI Jakarta 12345</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="text-muted small">Nomor Sertifikat</label>
                                <p class="fw-bold">SHM 12345/GN</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Progress Verifikasi -->
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card bg-light">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="fw-bold">Progress Verifikasi Dokumen</span>
                        <span class="badge badge-primary">3 dari 5 dokumen terverifikasi</span>
                    </div>
                    <div class="progress mb-2" style="height: 8px;">
                        <div class="progress-bar bg-success" style="width: 60%"></div>
                    </div>
                    <p class="text-muted small mb-0">60% selesai</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Dokumen -->
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-file-document me-2 text-primary"></i>
                        Daftar Dokumen Legal
                    </h5>
                    <div>
                        <span class="badge badge-success me-2">Terverifikasi</span>
                        <span class="badge badge-warning me-2">Pending</span>
                        <span class="badge badge-danger">Ditolak</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Dokumen</th>
                                    <th>Nomor Dokumen</th>
                                    <th>Tanggal Upload</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <i class="mdi mdi-file-pdf text-danger me-2"></i>
                                        Sertifikat Tanah
                                    </td>
                                    <td>SHM 12345/GN</td>
                                    <td>13 Feb 2026</td>
                                    <td>
                                        <span class="badge badge-success">Terverifikasi</span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-primary me-1" onclick="alert('Lihat dokumen: Sertifikat Tanah')">
                                            <i class="mdi mdi-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>
                                        <i class="mdi mdi-file-pdf text-danger me-2"></i>
                                        IMB (Izin Mendirikan Bangunan)
                                    </td>
                                    <td>IMB-12345/2024</td>
                                    <td>13 Feb 2026</td>
                                    <td>
                                        <span class="badge badge-warning">Pending</span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-primary me-1" onclick="alert('Lihat dokumen: IMB')">
                                            <i class="mdi mdi-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-success me-1" onclick="alert('Verifikasi dokumen: IMB')">
                                            <i class="mdi mdi-check"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="alert('Tolak dokumen: IMB')">
                                            <i class="mdi mdi-close"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>
                                        <i class="mdi mdi-file-pdf text-danger me-2"></i>
                                        PBB (Pajak Bumi Bangunan)
                                    </td>
                                    <td>31.71.123.456.789</td>
                                    <td>13 Feb 2026</td>
                                    <td>
                                        <span class="badge badge-warning">Pending</span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-primary me-1" onclick="alert('Lihat dokumen: PBB')">
                                            <i class="mdi mdi-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-success me-1" onclick="alert('Verifikasi dokumen: PBB')">
                                            <i class="mdi mdi-check"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="alert('Tolak dokumen: PBB')">
                                            <i class="mdi mdi-close"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>
                                        <i class="mdi mdi-image text-info me-2"></i>
                                        Site Plan / Denah
                                    </td>
                                    <td>-</td>
                                    <td>14 Feb 2026</td>
                                    <td>
                                        <span class="badge badge-danger">Ditolak</span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-primary me-1" onclick="alert('Lihat dokumen: Site Plan')">
                                            <i class="mdi mdi-eye"></i>
                                        </button>
                                        <span class="badge badge-light text-muted" title="Ukuran tidak sesuai standar">
                                            <i class="mdi mdi-information-outline"></i>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>
                                        <i class="mdi mdi-image text-info me-2"></i>
                                        Foto Lapangan
                                    </td>
                                    <td>-</td>
                                    <td>14 Feb 2026</td>
                                    <td>
                                        <span class="badge badge-warning">Pending</span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-primary me-1" onclick="alert('Lihat dokumen: Foto Lapangan')">
                                            <i class="mdi mdi-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-success me-1" onclick="alert('Verifikasi dokumen: Foto Lapangan')">
                                            <i class="mdi mdi-check"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="alert('Tolak dokumen: Foto Lapangan')">
                                            <i class="mdi mdi-close"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Catatan Verifikasi -->
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-note-text me-2 text-primary"></i>
                        Catatan Verifikasi
                    </h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="catatan">Catatan Umum</label>
                        <textarea class="form-control" id="catatan" rows="3" placeholder="Tambahkan catatan untuk properti ini...">Menunggu konfirmasi dari BPN terkait keaslian sertifikat.</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tombol Aksi -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <a href="{{ url('/properti') }}" class="btn btn-light me-2">
                            <i class="mdi mdi-arrow-left me-1"></i>Kembali
                        </a>
                        <button type="button" class="btn btn-secondary" onclick="alert('Progress verifikasi berhasil disimpan')">
                            <i class="mdi mdi-content-save me-1"></i>Simpan Progress
                        </button>
                    </div>
                    <div>
                        <button type="button" class="btn btn-warning me-2" onclick="alert('Permintaan revisi telah dikirim')">
                            <i class="mdi mdi-alert me-1"></i>Minta Revisi
                        </button>
                        <button type="button" class="btn btn-danger me-2" onclick="alert('Seluruh pengajuan properti telah ditolak')">
                            <i class="mdi mdi-close-circle me-1"></i>Tolak Pengajuan
                        </button>
                        <button type="button" class="btn btn-success" onclick="alert('Semua dokumen telah disetujui')">
                            <i class="mdi mdi-check-all me-1"></i>Setujui Semua
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Progress Steps -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <span class="text-success"><i class="mdi mdi-check-circle me-1"></i>Input Tanah</span>
                        <span class="text-primary"><i class="mdi mdi-progress-clock me-1"></i>Verifikasi Legal</span>
                        <span class="text-muted"><i class="mdi mdi-circle-outline me-1"></i>Buat Kavling</span>
                        <span class="text-muted"><i class="mdi mdi-circle-outline me-1"></i>Siap Jual</span>
                    </div>
                    <div class="progress mt-2" style="height: 6px;">
                        <div class="progress-bar bg-success" style="width: 25%"></div>
                        <div class="progress-bar bg-primary" style="width: 25%"></div>
                    </div>
                    <p class="text-muted small mt-2">Tahap 2 dari 4: Verifikasi Legal</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- AKHIR KONTEN VERIFIKASI LEGAL -->
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Enable tooltips
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
@endpush
