@extends('layouts.partial.app')

@section('title', 'Edit Kavling ' . ($unit->unit_code ?? '') . ' - Property Management App')

@push('styles')
<style>
/* ===== Header & Breadcrumb Card ===== */
.header-card {
    background: #ffffff;
    border-radius: 14px;
    border: 1px solid rgba(154, 85, 255, 0.12);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
    overflow: hidden;
    position: relative;
}

.header-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 6px;
    height: 100%;
    background: linear-gradient(180deg, #9a55ff 0%, #da8cff 100%);
}

.breadcrumb-nav .breadcrumb-item a {
    color: #9a55ff;
    text-decoration: none;
    font-weight: 500;
}

.breadcrumb-nav .breadcrumb-item.active {
    color: #6c757d;
    font-weight: 600;
}

/* ===== Form Styling ===== */
.form-card {
    background: #ffffff;
    border-radius: 14px;
    border: 1px solid rgba(0, 0, 0, 0.05);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
}

.section-title {
    font-size: 0.95rem;
    font-weight: 700;
    color: #2c2e3f;
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 1.25rem;
    padding-bottom: 0.6rem;
    border-bottom: 2px solid #f3f4f6;
}

.section-title i {
    color: #9a55ff;
    font-size: 1.25rem;
}

.form-label {
    font-size: 0.82rem;
    font-weight: 600;
    color: #4b5563;
    margin-bottom: 0.4rem;
}

.form-label span.req {
    color: #ef4444;
}

.form-control, .form-select {
    font-size: 0.875rem;
    border-radius: 10px;
    border: 1.5px solid #e5e7eb;
    padding: 0.65rem 0.9rem;
    transition: all 0.2s ease;
    color: #1f2937;
}

.form-control:focus, .form-select:focus {
    border-color: #9a55ff;
    box-shadow: 0 0 0 3px rgba(154, 85, 255, 0.15);
}

/* ===== File Upload Box ===== */
.spk-file-box {
    border: 2px dashed #d1d5db;
    border-radius: 12px;
    padding: 1.25rem;
    background: #f9fafb;
    text-align: center;
    transition: all 0.25s ease;
    position: relative;
    cursor: pointer;
}

.spk-file-box:hover {
    border-color: #9a55ff;
    background: #faf5ff;
}

.spk-file-box input[type="file"] {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
}

.current-file-card {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 0.85rem 1.1rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
}

/* ===== Status Badge ===== */
.badge-unit-type {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 0.35rem 0.85rem;
    border-radius: 30px;
    font-size: 0.78rem;
    font-weight: 600;
}

.badge-unit-type.subsidi {
    background: rgba(0, 201, 167, 0.12);
    color: #00897b;
    border: 1px solid rgba(0, 201, 167, 0.3);
}

.badge-unit-type.komersil {
    background: rgba(132, 94, 194, 0.12);
    color: #845ec2;
    border: 1px solid rgba(132, 94, 194, 0.3);
}
</style>
@endpush

@section('content')
<div class="container-fluid px-1 px-sm-2 px-md-3 py-2 py-md-3">

    <!-- Header Card -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 header-card">
                <div class="card-body p-4 d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div>
                        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
                            <ol class="breadcrumb mb-0" style="font-size: 0.82rem;">
                                <li class="breadcrumb-item"><a href="{{ route('kavling.index') }}">Daftar Kavling</a></li>
                                @if($unit->land_bank_id)
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('properti.buatKavling', ['land_bank_id' => $unit->land_bank_id]) }}">
                                            {{ $unit->landBank->name ?? 'Detail Properti' }}
                                        </a>
                                    </li>
                                @endif
                                <li class="breadcrumb-item active" aria-current="page">Edit Unit {{ $unit->unit_code }}</li>
                            </ol>
                        </nav>
                        <h3 class="text-dark mb-1 fw-bold" style="font-size: 1.35rem;">
                            Edit Unit Kavling <span class="text-primary">{{ $unit->unit_code }}</span>
                        </h3>
                        <p class="text-muted mb-0" style="font-size: 0.88rem;">
                            Perbarui spesifikasi unit, harga transaksi, dan dokumen legalitas / SPK unit kavling ini.
                        </p>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        @if($unit->land_bank_id)
                            <a href="{{ route('properti.buatKavling', ['land_bank_id' => $unit->land_bank_id]) }}" class="btn btn-outline-secondary btn-sm px-3 d-flex align-items-center gap-1">
                                <i class="mdi mdi-arrow-left"></i> Kembali ke Daftar Unit
                            </a>
                        @else
                            <a href="{{ route('kavling.index') }}" class="btn btn-outline-secondary btn-sm px-3 d-flex align-items-center gap-1">
                                <i class="mdi mdi-arrow-left"></i> Kembali
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Notifikasi -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm d-flex align-items-center gap-2 mb-3" role="alert">
            <i class="mdi mdi-check-circle fs-5"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm d-flex align-items-center gap-2 mb-3" role="alert">
            <i class="mdi mdi-alert-circle fs-5"></i>
            <div>{{ session('error') }}</div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-3" role="alert">
            <div class="d-flex align-items-center gap-2 mb-1">
                <i class="mdi mdi-alert-circle fs-5"></i>
                <strong class="small">Terdapat beberapa kesalahan pengisian formulir:</strong>
            </div>
            <ul class="mb-0 small ps-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Form Edit Card -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0 form-card">
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('properti.kavling.update', ['unit' => $unit->id]) }}" method="POST" id="formEditKavling" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Informasi Identitas Unit -->
                        <div class="section-title">
                            <i class="mdi mdi-information-outline"></i>
                            <span>1. Informasi Identitas & Tipe Unit</span>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-3 col-sm-6">
                                <label class="form-label">Blok / Kode <span class="req">*</span></label>
                                <input type="text" name="block" class="form-control @error('block') is-invalid @enderror" 
                                    value="{{ old('block', $unit->block) }}" placeholder="Contoh: A" required>
                                @error('block')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3 col-sm-6">
                                <label class="form-label">No. Unit <span class="req">*</span></label>
                                <input type="text" name="unit_number" class="form-control @error('unit_number') is-invalid @enderror" 
                                    value="{{ old('unit_number', $unit->unit_number) }}" placeholder="Contoh: 1" required>
                                @error('unit_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3 col-sm-6">
                                <label class="form-label">Jenis Unit <span class="req">*</span></label>
                                <select name="jenis" class="form-select @error('jenis') is-invalid @enderror" required>
                                    <option value="">-- Pilih Jenis --</option>
                                    <option value="subsidi" {{ old('jenis', $unit->jenis ?? $unit->type) == 'subsidi' ? 'selected' : '' }}>Subsidi</option>
                                    <option value="komersil" {{ old('jenis', $unit->jenis ?? $unit->type) == 'komersil' ? 'selected' : '' }}>Komersil</option>
                                </select>
                                @error('jenis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3 col-sm-6">
                                <label class="form-label">Tipe Unit <span class="req">*</span></label>
                                <input type="text" name="type" class="form-control @error('type') is-invalid @enderror" 
                                    value="{{ old('type', $unit->type) }}" placeholder="Contoh: 36/60" required>
                                @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Nama Unit / Cluster</label>
                                <input type="text" name="unit_name" class="form-control @error('unit_name') is-invalid @enderror" 
                                    value="{{ old('unit_name', $unit->unit_name) }}" placeholder="Contoh: Cluster Lavender">
                                @error('unit_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3 col-sm-6">
                                <label class="form-label">Hadap</label>
                                <select name="facing" class="form-select @error('facing') is-invalid @enderror">
                                    <option value="">-- Pilih Arah Hadap --</option>
                                    <option value="Utara" {{ old('facing', $unit->facing) == 'Utara' ? 'selected' : '' }}>Utara</option>
                                    <option value="Selatan" {{ old('facing', $unit->facing) == 'Selatan' ? 'selected' : '' }}>Selatan</option>
                                    <option value="Timur" {{ old('facing', $unit->facing) == 'Timur' ? 'selected' : '' }}>Timur</option>
                                    <option value="Barat" {{ old('facing', $unit->facing) == 'Barat' ? 'selected' : '' }}>Barat</option>
                                </select>
                                @error('facing')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3 col-sm-6">
                                <label class="form-label">Posisi</label>
                                <select name="position" class="form-select @error('position') is-invalid @enderror">
                                    <option value="">-- Pilih Posisi --</option>
                                    <option value="Hook" {{ old('position', $unit->position) == 'Hook' ? 'selected' : '' }}>Hook</option>
                                    <option value="Tengah" {{ old('position', $unit->position) == 'Tengah' ? 'selected' : '' }}>Tengah</option>
                                    <option value="Sudut" {{ old('position', $unit->position) == 'Sudut' ? 'selected' : '' }}>Sudut</option>
                                </select>
                                @error('position')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Dimensi & Finansial -->
                        <div class="section-title">
                            <i class="mdi mdi-currency-usd"></i>
                            <span>2. Dimensi & Skema Harga</span>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6 col-lg-3">
                                <label class="form-label">Luas Tanah (m²) <span class="req">*</span></label>
                                <div class="input-group">
                                    <input type="number" name="area" class="form-control @error('area') is-invalid @enderror" 
                                        value="{{ old('area', $unit->area) }}" placeholder="60" min="1" step="any" required>
                                    <span class="input-group-text bg-light text-muted">m²</span>
                                </div>
                                @error('area')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <label class="form-label">Luas Bangunan (m²) <span class="req">*</span></label>
                                <div class="input-group">
                                    <input type="number" name="building_area" class="form-control @error('building_area') is-invalid @enderror" 
                                        value="{{ old('building_area', $unit->building_area) }}" placeholder="36" min="1" step="any" required>
                                    <span class="input-group-text bg-light text-muted">m²</span>
                                </div>
                                @error('building_area')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 col-lg-2">
                                <label class="form-label">Harga Unit</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted">Rp</span>
                                    <input type="text" name="price" class="form-control price-format @error('price') is-invalid @enderror" 
                                        value="{{ old('price', $unit->price ? number_format($unit->price, 0, ',', '.') : '') }}" placeholder="150.000.000">
                                </div>
                                @error('price')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 col-lg-2">
                                <label class="form-label">Harga IJB</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted">Rp</span>
                                    <input type="text" name="ijb_price" class="form-control price-format @error('ijb_price') is-invalid @enderror" 
                                        value="{{ old('ijb_price', $unit->ijb_price ? number_format($unit->ijb_price, 0, ',', '.') : '') }}" placeholder="150.000.000">
                                </div>
                                @error('ijb_price')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 col-lg-2">
                                <label class="form-label">Harga AJB</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted">Rp</span>
                                    <input type="text" name="ajb_price" class="form-control price-format @error('ajb_price') is-invalid @enderror" 
                                        value="{{ old('ajb_price', $unit->ajb_price ? number_format($unit->ajb_price, 0, ',', '.') : '') }}" placeholder="150.000.000">
                                </div>
                                @error('ajb_price')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- SPK & Legalitas Konstruksi -->
                        <div class="section-title">
                            <i class="mdi mdi-file-document-edit-outline"></i>
                            <span>3. SPK & Informasi Pembangunan</span>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <label class="form-label">Nomor SPK</label>
                                <input type="text" name="no_spk" class="form-control @error('no_spk') is-invalid @enderror" 
                                    value="{{ old('no_spk', $unit->no_spk) }}" placeholder="Contoh: SPK/001/2026">
                                @error('no_spk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Kontraktor / Pelaksana</label>
                                <input type="text" name="kontraktor" class="form-control @error('kontraktor') is-invalid @enderror" 
                                    value="{{ old('kontraktor', $unit->kontraktor) }}" placeholder="Nama PT / CV Kontraktor">
                                @error('kontraktor')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Upload Dokumen SPK Baru (PDF, Max 5MB)</label>
                                <input type="file" name="dokumen_spk" class="form-control @error('dokumen_spk') is-invalid @enderror" accept=".pdf">
                                @error('dokumen_spk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            @if ($unit->dokumen_spk)
                                <div class="col-12">
                                    <div class="current-file-card">
                                        <div class="d-flex align-items-center gap-3">
                                            <i class="mdi mdi-file-pdf text-danger" style="font-size: 2rem;"></i>
                                            <div>
                                                <div class="fw-bold text-dark small">{{ basename($unit->dokumen_spk) }}</div>
                                                <small class="text-muted">Dokumen SPK saat ini telah terunggah</small>
                                            </div>
                                        </div>
                                        <div class="d-flex gap-2">
                                            <a href="{{ asset($unit->dokumen_spk) }}" target="_blank" class="btn btn-sm btn-outline-primary px-3">
                                                <i class="mdi mdi-eye me-1"></i>Lihat
                                            </a>
                                            <a href="{{ asset($unit->dokumen_spk) }}" download class="btn btn-sm btn-outline-success px-3">
                                                <i class="mdi mdi-download me-1"></i>Unduh
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="col-12">
                                <label class="form-label">Keterangan Tambahan / Catatan Unit</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
                                    rows="3" placeholder="Tambahkan catatan khusus mengenai unit kavling ini (opsional)">{{ old('description', $unit->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Tombol Aksi Submit & Batal -->
                        <hr class="my-4" style="opacity: 0.1;">
                        <div class="d-flex flex-wrap justify-content-end align-items-center gap-2">
                            @if($unit->land_bank_id)
                                <a href="{{ route('properti.buatKavling', ['land_bank_id' => $unit->land_bank_id]) }}" class="btn btn-gradient-secondary px-4">
                                    <i class="mdi mdi-close me-1"></i>Batal
                                </a>
                            @else
                                <a href="{{ route('kavling.index') }}" class="btn btn-gradient-secondary px-4">
                                    <i class="mdi mdi-close me-1"></i>Batal
                                </a>
                            @endif
                            <button type="submit" class="btn btn-gradient-primary px-4 shadow-sm">
                                <i class="mdi mdi-content-save me-1"></i>Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Format mata uang rupiah on typing
    $(document).on('keyup', '.price-format', function() {
        let val = $(this).val().replace(/\D/g, '');
        if (val) {
            $(this).val(new Intl.NumberFormat('id-ID').format(val));
        }
    });

    // Handle submit form
    $('#formEditKavling').on('submit', function(e) {
        e.preventDefault();

        // Bersihkan tanda titik pemisah ribuan sebelum submit
        $('.price-format').each(function() {
            let val = $(this).val().replace(/\./g, '');
            $(this).val(val);
        });

        Swal.fire({
            title: 'Menyimpan...',
            text: 'Sedang memperbarui data unit kavling',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });

        this.submit();
    });
});
</script>
@endpush
