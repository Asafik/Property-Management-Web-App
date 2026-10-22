@extends('layouts.partial.app')

@section('title', 'Tambah Skema Angsuran KPR - Property Management App')

@section('content')
<div class="container-fluid px-1 px-sm-2 px-md-3 py-2 py-md-3">

    <!-- Page Title & Navigation (Mentok Kanan Kiri dengan Tombol Kembali) -->
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3 mb-md-4">
        <div>
            <h2 class="text-dark mb-1 fw-bold" style="font-size: 1.45rem; letter-spacing: -0.02em;">
                Tambah Skema Angsuran KPR
            </h2>
            <p class="text-muted mb-0" style="font-size: 0.88rem;">
                Tambahkan data skema nominal angsuran flat KPR baru per bank, produk, dan tenor tahun
            </p>
        </div>
        <div>
            <a href="{{ route('master.skema-kpr.index') }}" class="btn btn-sm d-inline-flex align-items-center gap-1 px-3 text-white fw-semibold shadow-sm" style="height: 34px; border-radius: 6px; background-color: #64748b; border: 1px solid #64748b;">
                <i class="mdi mdi-arrow-left"></i> Kembali ke Daftar
            </a>
        </div>
    </div>

    <!-- Alert Error Validation -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center mb-3" role="alert" style="border-radius: 8px;">
            <i class="mdi mdi-alert-circle fs-5 me-2"></i>
            <div>
                <strong>Terdapat kesalahan input:</strong>
                <ul class="mb-0 mt-1 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Form Card -->
    <div class="row">
        <div class="col-12">
            <div class="card" style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px; box-shadow: none;">
                <div class="card-header bg-white d-flex align-items-center gap-2 py-3 px-4" style="border-bottom: 1px solid #e2e8f0;">
                    <div style="width: 32px; height: 32px; border-radius: 6px; background-color: #f3e8ff; color: #9333ea; display: inline-flex; align-items: center; justify-content: center; font-size: 1.15rem; flex-shrink: 0;">
                        <i class="mdi mdi-calculator-variant"></i>
                    </div>
                    <span style="font-size: 0.95rem; font-weight: 700; color: #0f172a;">Formulir Skema Angsuran KPR Baru</span>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('master.skema-kpr.store') }}">
                        @csrf

                        <div class="row g-3">
                            <!-- Bank Tujuan -->
                            <div class="col-12 col-md-6">
                                <label class="form-label small fw-bold text-dark">Bank Tujuan <span class="text-danger">*</span></label>
                                <select class="form-select" name="bank_id" id="bank_id" required style="border-radius: 6px; height: 38px; font-size: 0.88rem;">
                                    <option value="">-- Pilih Bank --</option>
                                    @foreach($banks as $b)
                                        <option value="{{ $b->id }}" {{ old('bank_id') == $b->id ? 'selected' : '' }}>{{ $b->bank_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Produk KPR -->
                            <div class="col-12 col-md-6">
                                <label class="form-label small fw-bold text-dark">Produk KPR <span class="text-danger">*</span></label>
                                <select class="form-select" name="produk_kpr" id="produk_kpr" required style="border-radius: 6px; height: 38px; font-size: 0.88rem;">
                                    <option value="subsidi" {{ old('produk_kpr') == 'subsidi' ? 'selected' : '' }}>KPR Subsidi</option>
                                    <option value="non_subsidi" {{ old('produk_kpr') == 'non_subsidi' ? 'selected' : '' }}>KPR Non Subsidi</option>
                                    <option value="syariah" {{ old('produk_kpr') == 'syariah' ? 'selected' : '' }}>KPR Syariah</option>
                                </select>
                            </div>

                            <!-- Nama Skema -->
                            <div class="col-12">
                                <label class="form-label small fw-bold text-dark">Nama Skema (Opsional)</label>
                                <input type="text" class="form-control" name="nama_skema" id="nama_skema" 
                                    value="{{ old('nama_skema') }}" placeholder="Contoh: KPR Subsidi FLPP BTN" 
                                    style="border-radius: 6px; height: 38px; font-size: 0.88rem;">
                            </div>

                            <!-- Tenor Angsuran -->
                            <div class="col-12 col-md-6">
                                <label class="form-label small fw-bold text-dark">Tenor Angsuran <span class="text-danger">*</span></label>
                                <select class="form-select" name="tenor" id="tenor" required style="border-radius: 6px; height: 38px; font-size: 0.88rem;">
                                    <option value="5" {{ old('tenor') == '5' ? 'selected' : '' }}>5 Tahun (60 Bulan)</option>
                                    <option value="10" {{ old('tenor') == '10' ? 'selected' : '' }}>10 Tahun (120 Bulan)</option>
                                    <option value="15" {{ old('tenor', '15') == '15' ? 'selected' : '' }}>15 Tahun (180 Bulan)</option>
                                    <option value="20" {{ old('tenor') == '20' ? 'selected' : '' }}>20 Tahun (240 Bulan)</option>
                                </select>
                            </div>

                            <!-- Suku Bunga -->
                            <div class="col-12 col-md-6">
                                <label class="form-label small fw-bold text-dark">Suku Bunga (%) <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" step="0.01" class="form-control" name="bunga" id="bunga" 
                                        value="{{ old('bunga', '5.00') }}" required 
                                        style="border-radius: 6px 0 0 6px; height: 38px; font-size: 0.88rem;">
                                    <span class="input-group-text" style="border-radius: 0 6px 6px 0; height: 38px;">%</span>
                                </div>
                            </div>

                            <!-- Periode Tahun Flat -->
                            <div class="col-12 col-md-6">
                                <label class="form-label small fw-bold text-dark">Periode Tahun (Flat) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="periode_tahun" id="periode_tahun" 
                                    value="{{ old('periode_tahun', 'Tahun 1 - 5') }}" required 
                                    placeholder="Contoh: Tahun 1 - 5, Tahun 6 - 10, atau Flat Sepanjang Tenor" 
                                    style="border-radius: 6px; height: 38px; font-size: 0.88rem;">
                                <small class="text-muted" style="font-size: 0.74rem;">Bisa diisi rentang tahun (misal: Tahun 1 - 5) atau 'Flat Sepanjang Tenor'.</small>
                            </div>

                            <!-- Nominal Angsuran Flat -->
                            <div class="col-12 col-md-6">
                                <label class="form-label small fw-bold text-dark">Nominal Angsuran Flat per Bulan (Rp) <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text fw-bold text-success" style="border-radius: 6px 0 0 6px; height: 38px;">Rp</span>
                                    <input type="number" class="form-control fw-bold text-success" name="angsuran_per_bulan" id="angsuran_per_bulan" 
                                        value="{{ old('angsuran_per_bulan') }}" required 
                                        placeholder="Contoh: 700000" min="0" step="1000" 
                                        style="border-radius: 0 6px 6px 0; height: 38px; font-size: 0.95rem;">
                                </div>
                            </div>

                            <!-- Keterangan Tambahan -->
                            <div class="col-12">
                                <label class="form-label small fw-bold text-dark">Keterangan Tambahan (Opsional)</label>
                                <textarea class="form-control" name="keterangan" id="keterangan" rows="3" 
                                    placeholder="Catatan syarat ketentuan cicilan" 
                                    style="border-radius: 6px; font-size: 0.88rem;">{{ old('keterangan') }}</textarea>
                            </div>

                            <!-- Status Operasional Switch Card -->
                            <div class="col-12">
                                <div class="d-flex align-items-center justify-content-between p-3 rounded-2" style="background-color: #f8fafc; border: 1px solid #e2e8f0;">
                                    <div class="d-flex align-items-center gap-3">
                                        <div style="width: 36px; height: 36px; border-radius: 6px; background-color: #ecfdf5; color: #059669; display: inline-flex; align-items: center; justify-content: center; font-size: 1.2rem; flex-shrink: 0;">
                                            <i class="mdi mdi-check-circle-outline"></i>
                                        </div>
                                        <div>
                                            <label class="form-check-label fw-bold text-dark mb-0 d-block" for="is_active" style="cursor: pointer; font-size: 0.9rem;">
                                                Status Skema KPR Aktif
                                            </label>
                                            <small class="text-muted" style="font-size: 0.78rem;">
                                                Skema yang aktif dapat langsung dipilih oleh marketing pada simulasi dan pengajuan berkas KPR.
                                            </small>
                                        </div>
                                    </div>
                                    <div class="form-check form-switch mb-0 fs-5 ps-0 pe-2">
                                        <input class="form-check-input ms-0" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', '1') == '1' ? 'checked' : '' }} style="cursor: pointer; width: 44px; height: 22px;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 pt-3 mt-4 border-top">
                            <a href="{{ route('master.skema-kpr.index') }}" class="btn btn-sm d-inline-flex align-items-center gap-1 px-3 text-white fw-semibold shadow-sm" style="height: 36px; border-radius: 6px; background-color: #64748b; border: 1px solid #64748b;">
                                <i class="mdi mdi-arrow-left"></i> Kembali ke Daftar
                            </a>
                            <div class="d-flex align-items-center gap-2">
                                <a href="{{ route('master.skema-kpr.index') }}" class="btn btn-sm btn-light border px-3 fw-semibold text-secondary" style="height: 36px; border-radius: 6px;">
                                    Batal
                                </a>
                                <button type="submit" class="btn btn-sm d-inline-flex align-items-center gap-1.5 px-4 text-white fw-bold shadow-sm" style="height: 36px; border-radius: 6px; background-color: #9a55ff; border: 1px solid #9a55ff;">
                                    <i class="mdi mdi-content-save-check-outline"></i>
                                    <span>Simpan Skema KPR</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
