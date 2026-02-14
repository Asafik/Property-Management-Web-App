@extends('layouts.partial.app')
@section('title','Revisi Properti')

@section('content')
<div class="container-fluid px-2 px-md-3 px-lg-4">

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card shadow-sm">
                <div class="card-body p-3 p-md-4 p-lg-5">

                    {{-- HEADER DENGAN STATUS REVISI --}}
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
                        <div>
                            <h4 class="card-title mb-1">Revisi Data Tanah / Properti</h4>
                            <p class="text-muted small mb-0">Form ID: PRP-2024-001 / Green Lake City</p>
                        </div>
                        <div class="mt-2 mt-md-0">
                            <span class="badge bg-warning text-dark p-2">
                                <i class="fas fa-edit me-1"></i>Status: Perlu Revisi
                            </span>
                        </div>
                    </div>

                    {{-- ALERT REVISI --}}
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <div class="d-flex">
                            <i class="fas fa-exclamation-triangle me-3 fs-4"></i>
                            <div>
                                <strong>Catatan Revisi dari Admin:</strong>
                                <p class="mb-0">Mohon lengkapi data luas tanah dan upload sertifikat. Harga perolehan masih belum sesuai dengan NJOP.</p>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    {{-- PROGRESS BAR REVISI --}}
                    <div class="card bg-light mb-4">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="small fw-semibold">Progress Kelengkapan Data</span>
                                <span class="small text-primary">65%</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 65%"></div>
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 20%"></div>
                            </div>
                            <div class="d-flex justify-content-between mt-2 small text-muted">
                                <span><i class="fas fa-check-circle text-success me-1"></i>Lengkap</span>
                                <span><i class="fas fa-exclamation-circle text-warning me-1"></i>Perlu Revisi</span>
                                <span><i class="fas fa-circle text-secondary me-1"></i>Belum diisi</span>
                            </div>
                        </div>
                    </div>

                    {{-- ================= INFORMASI DASAR ================= --}}
                    <h5 class="text-primary mb-3 border-bottom pb-2">
                        <i class="fas fa-home me-2"></i>Informasi Dasar Tanah
                        <span class="badge bg-warning text-dark ms-2 small">Perlu Revisi</span>
                    </h5>

                    <div class="row g-3">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Nama Tanah/Proyek <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" name="namaTanah" class="form-control bg-light"
                                       value="Green Lake City" readonly disabled>
                                <span class="input-group-text bg-light text-muted">
                                    <i class="fas fa-lock" title="Tidak dapat diubah"></i>
                                </span>
                            </div>
                            <small class="text-muted">Tidak dapat diubah</small>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Status Kepemilikan <span class="text-danger">*</span></label>
                            <select name="statusKepemilikan" class="form-select border-warning" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="SHM" selected>SHM (Sertifikat Hak Milik)</option>
                                <option value="HGB">HGB (Hak Guna Bangunan)</option>
                                <option value="HGU">HGU (Hak Guna Usaha)</option>
                                <option value="HP">HP (Hak Pakai)</option>
                            </select>
                            <small class="text-warning"><i class="fas fa-edit me-1"></i>Perlu dipilih ulang</small>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Alamat Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="lokasi" class="form-control"
                               value="Jl. Danau Green No. 15, Jakarta Selatan" required>
                    </div>

                    <div class="row g-3">
                        <div class="col-sm-6 col-md-3 mb-3">
                            <label class="form-label">Kelurahan/Desa</label>
                            <input type="text" name="kelurahan" class="form-control" value="Pondok Indah">
                        </div>
                        <div class="col-sm-6 col-md-3 mb-3">
                            <label class="form-label">Kecamatan</label>
                            <input type="text" name="kecamatan" class="form-control" value="Kebayoran Lama">
                        </div>
                        <div class="col-sm-6 col-md-3 mb-3">
                            <label class="form-label">Kota/Kabupaten</label>
                            <input type="text" name="kota" class="form-control" value="Jakarta Selatan">
                        </div>
                        <div class="col-sm-6 col-md-3 mb-3">
                            <label class="form-label">Provinsi</label>
                            <input type="text" name="provinsi" class="form-control" value="DKI Jakarta">
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-sm-6 col-md-3 mb-3">
                            <label class="form-label fw-semibold">Luas Tanah (m²) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" name="luasTanah" class="form-control border-warning"
                                       value="200" min="0" step="0.01" required>
                                <span class="input-group-text bg-warning text-dark">m²</span>
                            </div>
                            <small class="text-warning"><i class="fas fa-edit me-1"></i>Harap dicek kembali</small>
                        </div>
                        <div class="col-sm-6 col-md-3 mb-3">
                            <label class="form-label fw-semibold">Harga Perolehan <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="text" name="hargaPerolehan" class="form-control border-warning"
                                       value="1.500.000.000" placeholder="1.000.000" required>
                            </div>
                            <small class="text-warning"><i class="fas fa-edit me-1"></i>Sesuaikan dengan NJOP</small>
                        </div>
                        <div class="col-sm-6 col-md-3 mb-3">
                            <label class="form-label fw-semibold">Tanggal Perolehan <span class="text-danger">*</span></label>
                            <input type="date" name="tanggalPerolehan" class="form-control" value="2024-01-15" required>
                        </div>
                        <div class="col-sm-6 col-md-3 mb-3">
                            <label class="form-label">Kode Pos</label>
                            <input type="text" name="kodePos" class="form-control" value="12345">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3">Kavling premium dengan view danau, cocok untuk hunian atau investasi</textarea>
                    </div>

                    {{-- ================= LEGAL ================= --}}
                    <h5 class="text-primary mt-4 mb-3 border-bottom pb-2">
                        <i class="fas fa-file-contract me-2"></i>Dokumen Legal
                        <span class="badge bg-success ms-2 small">Lengkap</span>
                    </h5>

                    <div class="row g-3">
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">No Sertifikat <span class="text-danger">*</span></label>
                            <input type="text" name="noSertifikat" class="form-control" value="SHM-1234/GLC/2024" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Atas Nama <span class="text-danger">*</span></label>
                            <input type="text" name="atasNama" class="form-control" value="PT. Property Development" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">No IMB</label>
                            <input type="text" name="noIMB" class="form-control" value="IMB-5678/GLC/2024">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">No PBB</label>
                        <input type="text" name="noPBB" class="form-control" value="PBB-9012/GLC/2024">
                    </div>

                    {{-- ================= UPLOAD ================= --}}
                    <h5 class="text-primary mt-4 mb-3 border-bottom pb-2">
                        <i class="fas fa-upload me-2"></i>Upload Dokumen
                        <span class="badge bg-warning text-dark ms-2 small">Perlu Upload Ulang</span>
                    </h5>

                    <div class="row g-3">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Upload Sertifikat <span class="text-danger">*</span></label>
                            <div class="border rounded p-3 bg-light mb-2">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <i class="fas fa-file-pdf text-danger me-2"></i>
                                        <small>sertifikat_glc.pdf</small>
                                    </div>
                                    <button class="btn btn-sm btn-outline-danger" type="button">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <input type="file" name="uploadSertifikat" class="form-control border-warning" accept=".pdf,.jpg,.jpeg,.png">
                            <small class="text-warning"><i class="fas fa-edit me-1"></i>Upload ulang dokumen</small>
                            <small class="text-muted d-block">Format: PDF, JPG, PNG (Max: 2MB)</small>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Upload IMB</label>
                            <div class="border rounded p-3 bg-light mb-2">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <i class="fas fa-file-image text-success me-2"></i>
                                        <small>imb_glc.jpg</small>
                                    </div>
                                    <button class="btn btn-sm btn-outline-danger" type="button">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <input type="file" name="uploadIMB" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                            <small class="text-muted">Format: PDF, JPG, PNG (Max: 2MB)</small>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Upload PBB</label>
                            <div class="border rounded p-3 bg-light mb-2">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <i class="fas fa-file-pdf text-danger me-2"></i>
                                        <small>pbb_glc.pdf</small>
                                    </div>
                                    <button class="btn btn-sm btn-outline-danger" type="button">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <input type="file" name="uploadPBB" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                            <small class="text-muted">Format: PDF, JPG, PNG (Max: 2MB)</small>
                        </div>
                    </div>

                    {{-- ================= STATUS ================= --}}
                    <h5 class="text-primary mt-4 mb-3 border-bottom pb-2">
                        <i class="fas fa-tags me-2"></i>Status
                    </h5>

                    <div class="row g-3">
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Status Legal <span class="text-danger">*</span></label>
                            <select name="statusLegal" class="form-select" required>
                                <option value="Pending" selected>Pending</option>
                                <option value="Lengkap">Lengkap</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Status Kavling <span class="text-danger">*</span></label>
                            <select name="statusKavling" class="form-select" required>
                                <option value="Belum" selected>Belum</option>
                                <option value="Proses">Proses</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Prioritas</label>
                            <select name="prioritas" class="form-select">
                                <option value="Normal">Normal</option>
                                <option value="Tinggi" selected>Tinggi</option>
                                <option value="Urgent">Urgent</option>
                            </select>
                        </div>
                    </div>

                    {{-- ================= MAP ================= --}}
                    <h5 class="text-primary mt-4 mb-3 border-bottom pb-2">
                        <i class="fas fa-map-marker-alt me-2"></i>Koordinat
                    </h5>

                    <div class="row g-3">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Latitude</label>
                            <input type="text" name="latitude" class="form-control" value="-6.2088">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Longitude</label>
                            <input type="text" name="longitude" class="form-control" value="106.8456">
                        </div>
                    </div>

                    {{-- ================= RIWAYAT REVISI ================= --}}
                    <h5 class="text-primary mt-4 mb-3 border-bottom pb-2">
                        <i class="fas fa-history me-2"></i>Riwayat Revisi
                    </h5>

                    <div class="timeline mb-4">
                        <div class="d-flex mb-3">
                            <div class="me-3">
                                <span class="badge bg-primary rounded-circle p-2">1</span>
                            </div>
                            <div class="flex-grow-1">
                                <div class="bg-light p-3 rounded">
                                    <div class="d-flex justify-content-between">
                                        <strong>Admin</strong>
                                        <small class="text-muted">10 Jan 2024, 09:30</small>
                                    </div>
                                    <p class="mb-0 small">Data awal diinput oleh user</p>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <div class="me-3">
                                <span class="badge bg-warning rounded-circle p-2">2</span>
                            </div>
                            <div class="flex-grow-1">
                                <div class="bg-light p-3 rounded border-start border-warning border-4">
                                    <div class="d-flex justify-content-between">
                                        <strong class="text-warning">Admin (Revisi)</strong>
                                        <small class="text-muted">11 Jan 2024, 14:15</small>
                                    </div>
                                    <p class="mb-0 small">Mohon lengkapi data luas tanah dan upload sertifikat. Harga perolehan masih belum sesuai dengan NJOP.</p>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="me-3">
                                <span class="badge bg-secondary rounded-circle p-2">3</span>
                            </div>
                            <div class="flex-grow-1">
                                <div class="bg-light p-3 rounded">
                                    <div class="d-flex justify-content-between">
                                        <strong>User (Sekarang)</strong>
                                        <small class="text-muted">Sedang mengisi</small>
                                    </div>
                                    <p class="mb-0 small">Melakukan perbaikan sesuai catatan revisi</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ================= BUTTON ================= --}}
                    <div class="d-flex flex-column flex-sm-row justify-content-end gap-2 mt-4">
                        <a href="" class="btn btn-secondary order-2 order-sm-1">
                            <i class="fas fa-times me-2"></i>Batal
                        </a>

                        <button type="submit" class="btn btn-warning text-dark order-1 order-sm-2">
                            <i class="fas fa-save me-2"></i>Simpan Revisi
                        </button>

                        <button type="submit" name="submit_type" value="draft" class="btn btn-outline-primary order-3">
                            <i class="fas fa-clock me-2"></i>Simpan sebagai Draft
                        </button>

                        <button type="submit" name="submit_type" value="final" class="btn btn-success order-4">
                            <i class="fas fa-check-circle me-2"></i>Ajukan Final
                        </button>
                    </div>

                    {{-- ================= CATATAN REVISI ================= --}}
                    <div class="mt-4 p-3 bg-light rounded">
                        <label class="form-label fw-semibold">Tambahkan Catatan Revisi (Opsional):</label>
                        <textarea class="form-control" rows="2" placeholder="Tuliskan perubahan yang Anda lakukan..."></textarea>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('styles')
<style>
    /* Custom responsive adjustments */
    @media (max-width: 576px) {
        .card-body {
            padding: 1rem !important;
        }

        .btn {
            width: 100%;
            margin-bottom: 0.5rem;
        }

        .d-flex {
            flex-direction: column;
        }

        .gap-2 > * {
            margin-right: 0 !important;
        }

        .timeline .d-flex {
            flex-direction: row !important;
        }
    }

    @media (min-width: 577px) and (max-width: 768px) {
        .btn {
            padding: 0.5rem 0.75rem;
            font-size: 0.9rem;
        }
    }

    /* Form styling */
    .form-label {
        font-size: 0.9rem;
        margin-bottom: 0.25rem;
        font-weight: 500;
    }

    input, select, textarea, button {
        font-size: 16px !important;
    }

    /* Border warning for fields needing revision */
    .border-warning {
        border-color: #ffc107 !important;
    }

    /* Timeline styling */
    .timeline .badge {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Card styling */
    .card {
        border-radius: 0.5rem;
        border: none;
    }

    @media (max-width: 768px) {
        .card {
            border-radius: 0.25rem;
        }
    }

    /* Progress bar customization */
    .progress {
        background-color: #e9ecef;
        border-radius: 10px;
    }

    /* File upload styling */
    .border-warning {
        border: 2px solid #ffc107 !important;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Format Rupiah untuk input harga
        const hargaInput = document.querySelector('input[name="hargaPerolehan"]');
        if (hargaInput) {
            hargaInput.addEventListener('input', function(e) {
                let value = this.value.replace(/\D/g, '');
                if (value) {
                    value = parseInt(value).toLocaleString('id-ID');
                    this.value = value;
                }
            });
        }

        // Konfirmasi sebelum submit
        const submitButtons = document.querySelectorAll('button[type="submit"]');
        submitButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                if (this.name === 'submit_type' && this.value === 'final') {
                    if (!confirm('Anda yakin ingin mengajukan final? Data akan dikirim untuk verifikasi akhir.')) {
                        e.preventDefault();
                    }
                }
            });
        });

        // Delete file confirmation
        const deleteButtons = document.querySelectorAll('.btn-outline-danger');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                if (confirm('Hapus file ini?')) {
                    const fileContainer = this.closest('.border.rounded');
                    if (fileContainer) {
                        fileContainer.remove();
                    }
                }
            });
        });
    });
</script>
@endpush
