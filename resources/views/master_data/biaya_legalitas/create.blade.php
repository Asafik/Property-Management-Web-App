@php
    $isEdit = isset($biaya);
@endphp

@extends('layouts.partial.app')

@section('title', ($isEdit ? 'Edit Komponen Biaya Legalitas' : 'Tambah Komponen Biaya Legalitas') . ' - Property Management App')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard-clean.css') }}?v={{ time() }}">
    <style>
        .compact-table-card {
            background: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 6px !important;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04) !important;
            overflow: hidden;
            width: 100% !important;
        }
        .compact-table-card .card-header {
            background: #ffffff !important;
            border-bottom: 1px solid #e2e8f0 !important;
            padding: 1rem 1.5rem !important;
        }
        .compact-table-card .card-body {
            padding: 1.5rem !important;
            background: #ffffff !important;
        }
        .form-label-custom {
            font-size: 0.83rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.35rem;
            display: block;
        }
        .form-control-custom,
        .form-select-custom {
            border: 1px solid #cbd5e1;
            border-radius: 5px !important;
            font-size: 0.88rem;
            padding: 0.55rem 0.85rem;
            color: #1e293b;
            background-color: #ffffff;
            transition: all 0.15s ease;
            height: 42px;
        }
        textarea.form-control-custom {
            height: auto !important;
        }
        .form-control-custom:focus,
        .form-select-custom:focus {
            border-color: #7c3aed;
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.12);
            outline: none;
        }
        .btn-kembali-header {
            border-radius: 5px !important;
            font-size: 0.84rem;
            font-weight: 600;
            border: 1px solid #cbd5e1;
            background: #ffffff;
            color: #475569;
            padding: 0.5rem 1rem;
            transition: all 0.15s ease;
            text-decoration: none;
        }
        .btn-kembali-header:hover {
            background: #f8fafc;
            color: #0f172a;
            border-color: #94a3b8;
        }
        .custom-switch-clean .form-check-input {
            cursor: pointer;
            width: 38px;
            height: 20px;
        }
        .custom-switch-clean .form-check-input:checked {
            background-color: #10b981;
            border-color: #10b981;
        }
    </style>
@endpush

@section('content')
<div class="container-fluid px-2 px-md-4 py-3">

    <!-- Header Judul & Tombol Kembali -->
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-3">
        <div>
            <div class="d-flex align-items-center gap-2 mb-1">
                <a href="{{ route('master.biaya-legalitas.index') }}" class="btn btn-sm btn-link text-muted p-0 me-1" title="Kembali ke Daftar">
                    <i class="mdi mdi-arrow-left fs-4"></i>
                </a>
                <h2 class="text-dark mb-0 fw-bold" style="font-size: 1.55rem; letter-spacing: -0.02em;">
                    {{ $isEdit ? 'Edit Komponen Biaya Legalitas' : 'Tambah Komponen Biaya Legalitas' }}
                </h2>
            </div>
            <p class="text-muted mb-0" style="font-size: 0.88rem;">
                {{ $isEdit ? 'Perbarui informasi dan formula acuan tarif biaya transaksi tanah.' : 'Formulir input master tarif baku IJB/PPJB Notaris, Estimasi Pajak, Fee, dan komponen biaya tanah.' }}
            </p>
        </div>

        <div>
            <a href="{{ route('master.biaya-legalitas.index') }}" class="btn-kembali-header d-inline-flex align-items-center">
                <i class="mdi mdi-arrow-left fs-6" style="margin-right: 6px !important;"></i>
                <span>Kembali ke Daftar Master</span>
            </a>
        </div>
    </div>

    <!-- Alert Notifikasi Error Validation -->
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-3" role="alert" style="border-radius: 6px; background: #fef2f2; color: #991b1b;">
            <div class="d-flex align-items-center gap-2 mb-1 fw-bold">
                <i class="mdi mdi-alert-circle fs-5 text-danger"></i>
                <span>Terdapat kesalahan pada input formulir:</span>
            </div>
            <ul class="mb-0 ps-4" style="font-size: 0.84rem;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Main Card Form -->
    <div class="row">
        <div class="col-12">
            <div class="card compact-table-card">
                <div class="card-header d-flex align-items-center gap-2">
                    <div style="width: 32px; height: 32px; border-radius: 5px; background: rgba(124, 58, 237, 0.1); color: #7c3aed; display: flex; align-items: center; justify-content: center; font-size: 1.15rem; flex-shrink: 0;">
                        <i class="mdi {{ $isEdit ? 'mdi-cash-edit' : 'mdi-cash-plus' }}"></i>
                    </div>
                    <span style="font-size: 0.95rem; font-weight: 700; color: #0f172a;">
                        {{ $isEdit ? 'Formulir Pembaruan Data Komponen' : 'Formulir Komponen Biaya Baru' }}
                    </span>
                </div>

                <div class="card-body">
                    <form action="{{ $isEdit ? route('master.biaya-legalitas.update', $biaya->id) : route('master.biaya-legalitas.store') }}" method="POST" id="formBiaya">
                        @csrf
                        @if($isEdit)
                            @method('PUT')
                        @endif

                        <div class="row g-3">
                            <!-- Kode Biaya -->
                            <div class="col-md-5">
                                <label class="form-label-custom">
                                    Kode Biaya <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="kode_biaya" id="kode_biaya"
                                    class="form-control form-control-custom font-monospace"
                                    placeholder="Contoh: BIAYA-IJB-PPJB"
                                    value="{{ old('kode_biaya', $biaya->kode_biaya ?? '') }}"
                                    required style="text-transform: uppercase;">
                                <small class="text-muted d-block mt-1" style="font-size: 0.74rem;">Unik, huruf kapital dan tanda strip (A-Z, 0-9, -)</small>
                            </div>

                            <!-- Nama Komponen Biaya -->
                            <div class="col-md-7">
                                <label class="form-label-custom">
                                    Nama Komponen Biaya <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="nama_biaya" id="nama_biaya"
                                    class="form-control form-control-custom"
                                    placeholder="Contoh: Biaya IJB / PPJB Notaris"
                                    value="{{ old('nama_biaya', $biaya->nama_biaya ?? '') }}"
                                    required>
                            </div>

                            <!-- Kategori -->
                            <div class="col-md-6">
                                <label class="form-label-custom">
                                    Kategori <span class="text-danger">*</span>
                                </label>
                                <select name="kategori" id="kategori" class="form-select form-select-custom w-100" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach($categories as $catKey => $catLabel)
                                        <option value="{{ $catKey }}" {{ old('kategori', $biaya->kategori ?? '') == $catKey ? 'selected' : '' }}>
                                            {{ $catKey }} ({{ $catLabel }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Tipe Perhitungan -->
                            <div class="col-md-6">
                                <label class="form-label-custom">
                                    Tipe Perhitungan Biaya <span class="text-danger">*</span>
                                </label>
                                <select name="tipe_perhitungan" id="tipe_perhitungan" class="form-select form-select-custom w-100" required onchange="handleTipePerhitunganChange()">
                                    <option value="nominal_tetap" {{ old('tipe_perhitungan', $biaya->tipe_perhitungan ?? 'nominal_tetap') == 'nominal_tetap' ? 'selected' : '' }}>
                                        Nominal Tetap (Rp Acuan Standar)
                                    </option>
                                    <option value="persentase" {{ old('tipe_perhitungan', $biaya->tipe_perhitungan ?? '') == 'persentase' ? 'selected' : '' }}>
                                        Persentase (% dari Deal Price)
                                    </option>
                                    <option value="fleksibel" {{ old('tipe_perhitungan', $biaya->tipe_perhitungan ?? '') == 'fleksibel' ? 'selected' : '' }}>
                                        Fleksibel / Input Manual Bebas
                                    </option>
                                </select>
                            </div>

                            <!-- Estimasi / Nominal Standar -->
                            <div class="col-md-6" id="container_nominal_standar">
                                <label class="form-label-custom" id="label_nominal_standar">
                                    Estimasi / Nominal Standar (Rp)
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light fw-bold text-muted" style="border-color: #cbd5e1; border-radius: 5px 0 0 5px;">Rp</span>
                                    <input type="text" name="nominal_standar" id="nominal_standar"
                                        class="form-control form-control-custom"
                                        style="border-radius: 0 5px 5px 0 !important;"
                                        placeholder="Contoh: 10.000.000"
                                        value="{{ old('nominal_standar', isset($biaya->nominal_standar) ? number_format($biaya->nominal_standar, 0, ',', '.') : '') }}"
                                        onkeyup="formatRupiah(this)">
                                </div>
                            </div>

                            <!-- Persentase Standar -->
                            <div class="col-md-6" id="container_persentase_standar" style="display: none;">
                                <label class="form-label-custom">
                                    Persentase Standar (%)
                                </label>
                                <div class="input-group">
                                    <input type="number" step="0.01" min="0" max="100" name="persentase_standar" id="persentase_standar"
                                        class="form-control form-control-custom"
                                        style="border-radius: 5px 0 0 5px !important;"
                                        placeholder="Contoh: 2.50 atau 5.00"
                                        value="{{ old('persentase_standar', $biaya->persentase_standar ?? '') }}">
                                    <span class="input-group-text bg-light fw-bold text-muted" style="border-color: #cbd5e1; border-radius: 0 5px 5px 0;">%</span>
                                </div>
                                <small class="text-muted d-block mt-1" style="font-size: 0.74rem;">Dihitung otomatis terhadap Deal Price saat di form Pra Land Bank</small>
                            </div>

                            <!-- Pihak Penanggung -->
                            <div class="col-md-6">
                                <label class="form-label-custom">
                                    Pihak Penanggung Beban <span class="text-danger">*</span>
                                </label>
                                <select name="pihak_penanggung" id="pihak_penanggung" class="form-select form-select-custom w-100" required>
                                    @foreach($pihakPenanggung as $val => $label)
                                        <option value="{{ $val }}" {{ old('pihak_penanggung', $biaya->pihak_penanggung ?? 'perusahaan') == $val ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Urutan Tampilan -->
                            <div class="col-md-6">
                                <label class="form-label-custom">
                                    Urutan Tampilan
                                </label>
                                <input type="number" name="urutan" id="urutan"
                                    class="form-control form-control-custom"
                                    min="0"
                                    value="{{ old('urutan', $biaya->urutan ?? 0) }}">
                            </div>

                            <!-- Deskripsi / Acuan Perhitungan -->
                            <div class="col-12">
                                <label class="form-label-custom">
                                    Deskripsi / Dasar Acuan Perhitungan
                                </label>
                                <textarea name="deskripsi" id="deskripsi" class="form-control form-control-custom" rows="3"
                                    placeholder="Catatan aturan hukum, peruntukan biaya, atau keterangan detail lainnya...">{{ old('deskripsi', $biaya->deskripsi ?? '') }}</textarea>
                            </div>

                            <!-- Pengaturan Sifat & Status -->
                            <div class="col-12">
                                <div class="p-3 border" style="background: #f8fafc; border-radius: 6px; border-color: #e2e8f0 !important;">
                                    <div class="row g-3">
                                        <div class="col-sm-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="is_standard" id="is_standard" value="1"
                                                    {{ old('is_standard', $biaya->is_standard ?? false) ? 'checked' : '' }}
                                                    style="cursor: pointer; width: 18px; height: 18px; margin-top: 0.15rem;">
                                                <label class="form-check-label fw-semibold text-dark ms-1" for="is_standard" style="font-size: 0.84rem; cursor: pointer;">
                                                    Komponen Baku Form
                                                </label>
                                                <small class="text-muted d-block ms-1" style="font-size: 0.74rem;">Muncul otomatis sebagai baris standar di form</small>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="is_required" id="is_required" value="1"
                                                    {{ old('is_required', $biaya->is_required ?? false) ? 'checked' : '' }}
                                                    style="cursor: pointer; width: 18px; height: 18px; margin-top: 0.15rem;">
                                                <label class="form-check-label fw-semibold text-dark ms-1" for="is_required" style="font-size: 0.84rem; cursor: pointer;">
                                                    Wajib Diisi (Required)
                                                </label>
                                                <small class="text-muted d-block ms-1" style="font-size: 0.74rem;">Form transaksi wajib melengkapi nilai biaya ini</small>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-check form-switch custom-switch-clean">
                                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
                                                    {{ old('is_active', $biaya->is_active ?? true) ? 'checked' : '' }}>
                                                <label class="form-check-label fw-semibold text-success ms-1" for="is_active" style="font-size: 0.84rem; cursor: pointer;">
                                                    Status Aktif
                                                </label>
                                                <small class="text-muted d-block ms-1" style="font-size: 0.74rem;">Dapat dipilih & digunakan pada transaksi</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex align-items-center justify-content-end gap-2 mt-4 pt-3 border-top">
                            <a href="{{ route('master.biaya-legalitas.index') }}" class="btn btn-secondary px-4 py-2" style="border-radius: 5px; font-size: 0.86rem;">
                                Batal
                            </a>
                            <button type="submit" class="btn btn-primary d-inline-flex align-items-center px-4 py-2 fw-semibold shadow-sm" style="border-radius: 5px; font-size: 0.86rem; background: #7c3aed; border-color: #7c3aed;">
                                <i class="mdi mdi-content-save fs-6" style="margin-right: 8px !important;"></i>
                                <span>{{ $isEdit ? 'Simpan Perubahan' : 'Simpan Komponen Biaya' }}</span>
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
<script>
    function formatRupiah(input) {
        let value = input.value.replace(/[^0-9]/g, '');
        if (value) {
            input.value = new Intl.NumberFormat('id-ID').format(value);
        } else {
            input.value = '';
        }
    }

    function handleTipePerhitunganChange() {
        const tipe = document.getElementById('tipe_perhitungan').value;
        const containerNominal = document.getElementById('container_nominal_standar');
        const containerPersen = document.getElementById('container_persentase_standar');
        const labelNominal = document.getElementById('label_nominal_standar');

        if (tipe === 'persentase') {
            containerPersen.style.display = 'block';
            containerNominal.style.display = 'block';
            if (labelNominal) labelNominal.textContent = 'Estimasi Nominal Awal (Opsional)';
        } else if (tipe === 'nominal_tetap') {
            containerPersen.style.display = 'none';
            containerNominal.style.display = 'block';
            if (labelNominal) labelNominal.textContent = 'Estimasi / Nominal Standar (Rp)';
        } else {
            containerPersen.style.display = 'none';
            containerNominal.style.display = 'block';
            if (labelNominal) labelNominal.textContent = 'Nominal Acuan Default (Opsional)';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        handleTipePerhitunganChange();
    });
</script>
@endpush
