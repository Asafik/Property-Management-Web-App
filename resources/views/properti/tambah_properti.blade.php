@extends('layouts.partial.app')
@section('title','Tambah Properti')

@section('content')
<div class="container-fluid px-2 px-md-3 px-lg-4">

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card shadow-sm">
                <div class="card-body p-3 p-md-4 p-lg-5">

                    <h4 class="card-title mb-3 mb-md-4">Tambah Data Tanah / Properti</h4>

                    {{-- ERROR VALIDATION --}}
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('properti.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- ALERT --}}
                        <div class="alert alert-info d-flex align-items-center flex-wrap" role="alert">
                            <i class="fas fa-info-circle me-2"></i>
                            <span>Setelah simpan data tanah, Anda bisa lanjut verifikasi legal & kavling</span>
                        </div>

                        {{-- ================= INFORMASI DASAR ================= --}}
                        <h5 class="text-primary mb-3 border-bottom pb-2">
                            <i class="fas fa-home me-2"></i>Informasi Dasar Tanah
                        </h5>

                        <div class="row g-3">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Nama Tanah/Proyek <span class="text-danger">*</span></label>
                                <input type="text" name="namaTanah" class="form-control @error('namaTanah') is-invalid @enderror"
                                       value="{{ old('namaTanah') }}" required>
                                @error('namaTanah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Status Kepemilikan <span class="text-danger">*</span></label>
                                <select name="statusKepemilikan" class="form-select @error('statusKepemilikan') is-invalid @enderror" required>
                                    <option value="">-- Pilih Status --</option>
                                    <option value="SHM" {{ old('statusKepemilikan') == 'SHM' ? 'selected' : '' }}>SHM (Sertifikat Hak Milik)</option>
                                    <option value="HGB" {{ old('statusKepemilikan') == 'HGB' ? 'selected' : '' }}>HGB (Hak Guna Bangunan)</option>
                                    <option value="HGU" {{ old('statusKepemilikan') == 'HGU' ? 'selected' : '' }}>HGU (Hak Guna Usaha)</option>
                                    <option value="HP" {{ old('statusKepemilikan') == 'HP' ? 'selected' : '' }}>HP (Hak Pakai)</option>
                                </select>
                                @error('statusKepemilikan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Alamat Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror"
                                   value="{{ old('lokasi') }}" placeholder="Jl. Contoh No. 123" required>
                            @error('lokasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row g-3">
                            <div class="col-sm-6 col-md-3 mb-3">
                                <label class="form-label">Kelurahan/Desa</label>
                                <input type="text" name="kelurahan" class="form-control" value="{{ old('kelurahan') }}" placeholder="Kelurahan">
                            </div>
                            <div class="col-sm-6 col-md-3 mb-3">
                                <label class="form-label">Kecamatan</label>
                                <input type="text" name="kecamatan" class="form-control" value="{{ old('kecamatan') }}" placeholder="Kecamatan">
                            </div>
                            <div class="col-sm-6 col-md-3 mb-3">
                                <label class="form-label">Kota/Kabupaten</label>
                                <input type="text" name="kota" class="form-control" value="{{ old('kota') }}" placeholder="Kota">
                            </div>
                            <div class="col-sm-6 col-md-3 mb-3">
                                <label class="form-label">Provinsi</label>
                                <input type="text" name="provinsi" class="form-control" value="{{ old('provinsi') }}" placeholder="Provinsi">
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-sm-6 col-md-3 mb-3">
                                <label class="form-label fw-semibold">Luas Tanah (m²) <span class="text-danger">*</span></label>
                                <input type="number" name="luasTanah" class="form-control @error('luasTanah') is-invalid @enderror"
                                       value="{{ old('luasTanah') }}" min="0" step="0.01" required>
                                @error('luasTanah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6 col-md-3 mb-3">
                                <label class="form-label fw-semibold">Harga Perolehan <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="text" name="hargaPerolehan" class="form-control @error('hargaPerolehan') is-invalid @enderror"
                                           value="{{ old('hargaPerolehan') }}" placeholder="1.000.000" required>
                                </div>
                                @error('hargaPerolehan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6 col-md-3 mb-3">
                                <label class="form-label fw-semibold">Tanggal Perolehan <span class="text-danger">*</span></label>
                                <input type="date" name="tanggalPerolehan" class="form-control @error('tanggalPerolehan') is-invalid @enderror"
                                       value="{{ old('tanggalPerolehan') }}" required>
                                @error('tanggalPerolehan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6 col-md-3 mb-3">
                                <label class="form-label">Kode Pos</label>
                                <input type="text" name="kodePos" class="form-control" value="{{ old('kodePos') }}" placeholder="12345">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3" placeholder="Deskripsi properti...">{{ old('deskripsi') }}</textarea>
                        </div>

                        {{-- ================= LEGAL ================= --}}
                        <h5 class="text-primary mt-4 mb-3 border-bottom pb-2">
                            <i class="fas fa-file-contract me-2"></i>Dokumen Legal
                        </h5>

                        <div class="row g-3">
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-semibold">No Sertifikat <span class="text-danger">*</span></label>
                                <input type="text" name="noSertifikat" class="form-control @error('noSertifikat') is-invalid @enderror"
                                       value="{{ old('noSertifikat') }}" required>
                                @error('noSertifikat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-semibold">Atas Nama <span class="text-danger">*</span></label>
                                <input type="text" name="atasNama" class="form-control @error('atasNama') is-invalid @enderror"
                                       value="{{ old('atasNama') }}" required>
                                @error('atasNama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">No IMB</label>
                                <input type="text" name="noIMB" class="form-control" value="{{ old('noIMB') }}" placeholder="Nomor IMB">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">No PBB</label>
                            <input type="text" name="noPBB" class="form-control" value="{{ old('noPBB') }}" placeholder="Nomor PBB">
                        </div>

                        {{-- ================= UPLOAD ================= --}}
                        <h5 class="text-primary mt-4 mb-3 border-bottom pb-2">
                            <i class="fas fa-upload me-2"></i>Upload Dokumen
                        </h5>

                        <div class="row g-3">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Upload Sertifikat</label>
                                <input type="file" name="uploadSertifikat" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                                <small class="text-muted">Format: PDF, JPG, PNG (Max: 2MB)</small>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Upload IMB</label>
                                <input type="file" name="uploadIMB" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                                <small class="text-muted">Format: PDF, JPG, PNG (Max: 2MB)</small>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Upload PBB</label>
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
                                <select name="statusLegal" class="form-select @error('statusLegal') is-invalid @enderror" required>
                                    <option value="Pending" {{ old('statusLegal') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Lengkap" {{ old('statusLegal') == 'Lengkap' ? 'selected' : '' }}>Lengkap</option>
                                </select>
                                @error('statusLegal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-semibold">Status Kavling <span class="text-danger">*</span></label>
                                <select name="statusKavling" class="form-select @error('statusKavling') is-invalid @enderror" required>
                                    <option value="Belum" {{ old('statusKavling') == 'Belum' ? 'selected' : '' }}>Belum</option>
                                    <option value="Proses" {{ old('statusKavling') == 'Proses' ? 'selected' : '' }}>Proses</option>
                                    <option value="Selesai" {{ old('statusKavling') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                                @error('statusKavling')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Prioritas</label>
                                <select name="prioritas" class="form-select">
                                    <option value="Normal" {{ old('prioritas') == 'Normal' ? 'selected' : '' }}>Normal</option>
                                    <option value="Tinggi" {{ old('prioritas') == 'Tinggi' ? 'selected' : '' }}>Tinggi</option>
                                    <option value="Urgent" {{ old('prioritas') == 'Urgent' ? 'selected' : '' }}>Urgent</option>
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
                                <input type="text" name="latitude" class="form-control" value="{{ old('latitude') }}" placeholder="Contoh: -6.2088">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Longitude</label>
                                <input type="text" name="longitude" class="form-control" value="{{ old('longitude') }}" placeholder="Contoh: 106.8456">
                            </div>
                        </div>

                        {{-- ================= BUTTON ================= --}}
                        <div class="d-flex flex-column flex-sm-row justify-content-end gap-2 mt-4">
                            <a href="" class="btn btn-secondary order-2 order-sm-1">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>

                            <button type="submit" class="btn btn-primary order-1 order-sm-2">
                                <i class="fas fa-save me-2"></i>Simpan Properti
                            </button>

                            <button type="submit" name="redirect" value="verifikasi" class="btn btn-success order-3">
                                <i class="fas fa-check-circle me-2"></i>Simpan & Lanjut Verifikasi
                            </button>
                        </div>

                    </form>

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
    }

    @media (min-width: 577px) and (max-width: 768px) {
        .btn {
            padding: 0.5rem 0.75rem;
            font-size: 0.9rem;
        }
    }

    /* Improve form spacing on mobile */
    .form-label {
        font-size: 0.9rem;
        margin-bottom: 0.25rem;
    }

    /* Better touch targets for mobile */
    input, select, textarea, button {
        font-size: 16px !important; /* Prevents zoom on mobile */
    }

    /* Alert styling */
    .alert-info {
        background-color: #cff4fc;
        border-color: #b6effb;
        color: #055160;
    }

    /* Card shadow adjustment for mobile */
    .card {
        border-radius: 0.5rem;
    }

    @media (max-width: 768px) {
        .card {
            border-radius: 0.25rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Optional: Add number formatting for hargaPerolehan
    document.addEventListener('DOMContentLoaded', function() {
        const hargaInput = document.querySelector('input[name="hargaPerolehan"]');
        if (hargaInput) {
            hargaInput.addEventListener('input', function(e) {
                // Remove non-digit characters
                let value = this.value.replace(/\D/g, '');
                if (value) {
                    // Format with thousand separator
                    value = parseInt(value).toLocaleString('id-ID');
                    this.value = value;
                }
            });
        }
    });
</script>
@endpush
