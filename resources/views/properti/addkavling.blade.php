@extends('layouts.partial.app')

@section('title', 'Buat Kavling - Property Management App')

@section('content')
<!-- KONTEN BUAT KAVLING -->
<div class="container-fluid p-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="text-dark">Buat Kavling / Master Unit</h3>
            <p class="text-muted">Buat unit-unit kavling dari tanah yang sudah diverifikasi</p>
        </div>
    </div>

    <!-- Info Tanah Induk -->
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-office-building text-primary me-2"></i>
                        Informasi Tanah Induk
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
                                <label class="text-muted small">Luas Total Tanah</label>
                                <p class="fw-bold">5.000 m²</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="text-muted small">Sisa Luas Belum Dikavling</label>
                                <p class="fw-bold text-primary">5.000 m²</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="text-muted small">Status Legal</label>
                                <p class="fw-bold"><span class="badge badge-success">Terverifikasi</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-2">
                                <label class="text-muted small">Lokasi</label>
                                <p class="fw-bold">Jl. Raya No. 123, RT 001/RW 002, Kel. Kebon Jeruk, Kec. Kebon Jeruk, Jakarta Selatan, DKI Jakarta 12345</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Progress Steps -->
    <div class="row">
        <div class="col-12 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <span class="text-success"><i class="mdi mdi-check-circle me-1"></i>Input Tanah</span>
                        <span class="text-success"><i class="mdi mdi-check-circle me-1"></i>Verifikasi Legal</span>
                        <span class="text-primary"><i class="mdi mdi-progress-clock me-1"></i>Buat Kavling</span>
                        <span class="text-muted"><i class="mdi mdi-circle-outline me-1"></i>Siap Jual</span>
                    </div>
                    <div class="progress mt-2" style="height: 6px;">
                        <div class="progress-bar bg-success" style="width: 50%"></div>
                        <div class="progress-bar bg-primary" style="width: 25%"></div>
                    </div>
                    <p class="text-muted small mt-2">Tahap 3 dari 4: Buat Kavling / Master Unit</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Pilihan Metode Pembuatan Kavling -->
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-tools me-2 text-primary"></i>
                        Metode Pembuatan Kavling
                    </h5>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="manual-tab" data-toggle="tab" href="#manual" role="tab" aria-controls="manual" aria-selected="true">
                                <i class="mdi mdi-pencil me-1"></i>Manual Satu per Satu
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="generate-tab" data-toggle="tab" href="#generate" role="tab" aria-controls="generate" aria-selected="false">
                                <i class="mdi mdi-auto-fix me-1"></i>Generate Otomatis
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="import-tab" data-toggle="tab" href="#import" role="tab" aria-controls="import" aria-selected="false">
                                <i class="mdi mdi-import me-1"></i>Import Excel
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content mt-4" id="myTabContent">
                        <!-- TAB MANUAL -->
                        <div class="tab-pane fade show active" id="manual" role="tabpanel" aria-labelledby="manual-tab">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Blok / No. Unit</label>
                                        <input type="text" class="form-control" placeholder="Contoh: A.1">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Luas (m²)</label>
                                        <input type="number" class="form-control" placeholder="200">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Harga (Rp)</label>
                                        <input type="text" class="form-control" placeholder="500.000.000">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Hadap</label>
                                        <select class="form-control">
                                            <option>Utara</option>
                                            <option>Selatan</option>
                                            <option>Timur</option>
                                            <option>Barat</option>
                                            <option>Timur Laut</option>
                                            <option>Barat Laut</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Posisi</label>
                                        <select class="form-control">
                                            <option>Hook</option>
                                            <option>Tengah</option>
                                            <option>Sudut</option>
                                            <option>Blok Dalam</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <input type="text" class="form-control" placeholder="Opsional">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-primary" onclick="alert('Unit berhasil ditambahkan ke daftar')">
                                        <i class="mdi mdi-plus me-1"></i>Tambah Unit ke Daftar
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- TAB GENERATE OTOMATIS -->
                        <div class="tab-pane fade" id="generate" role="tabpanel" aria-labelledby="generate-tab">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Jumlah Unit</label>
                                        <input type="number" class="form-control" value="10">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Luas per Unit (m²)</label>
                                        <input type="number" class="form-control" value="200">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Harga per Unit (Rp)</label>
                                        <input type="text" class="form-control" value="500.000.000">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Prefix Blok</label>
                                        <input type="text" class="form-control" value="A">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Nomor Awal</label>
                                        <input type="number" class="form-control" value="1">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Hadap Default</label>
                                        <select class="form-control">
                                            <option>Utara</option>
                                            <option>Selatan</option>
                                            <option>Timur</option>
                                            <option>Barat</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Posisi Default</label>
                                        <select class="form-control">
                                            <option>Tengah</option>
                                            <option>Hook</option>
                                            <option>Sudut</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 d-flex align-items-end">
                                    <div class="form-group w-100">
                                        <button class="btn btn-primary w-100" onclick="alert('10 unit berhasil digenerate')">
                                            <i class="mdi mdi-auto-fix me-1"></i>Generate Unit
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="alert alert-info mt-3">
                                <i class="mdi mdi-information-outline me-2"></i>
                                Total luas yang akan digunakan: <strong>2.000 m²</strong> dari 5.000 m² (sisa 3.000 m²)
                            </div>
                        </div>

                        <!-- TAB IMPORT EXCEL -->
                        <div class="tab-pane fade" id="import" role="tabpanel" aria-labelledby="import-tab">
                            <div class="text-center py-4">
                                <i class="mdi mdi-file-excel text-success" style="font-size: 48px;"></i>
                                <h5 class="mt-3">Import Data Kavling dari Excel</h5>
                                <p class="text-muted">Download template Excel, isi data unit, lalu upload kembali</p>

                                <div class="row justify-content-center">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Download Template</label>
                                            <div>
                                                <button class="btn btn-outline-success" onclick="alert('Download template excel')">
                                                    <i class="mdi mdi-download me-1"></i>Template Kavling.xlsx
                                                </button>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Upload File Excel</label>
                                            <input type="file" class="form-control">
                                            <small class="text-muted">Format: .xlsx, .xls (Max 5MB)</small>
                                        </div>
                                        <button class="btn btn-primary" onclick="alert('Data berhasil diimport')">
                                            <i class="mdi mdi-import me-1"></i>Import Data
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Unit yang Akan Dibuat -->
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-format-list-bulleted me-2 text-primary"></i>
                        Daftar Unit Kavling
                    </h5>
                    <span class="badge badge-primary">3 unit</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Blok / No</th>
                                    <th>Luas (m²)</th>
                                    <th>Harga (Rp)</th>
                                    <th>Hadap</th>
                                    <th>Posisi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td><strong>A.1</strong></td>
                                    <td>200</td>
                                    <td>500.000.000</td>
                                    <td>Utara</td>
                                    <td>Hook</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary me-1" onclick="alert('Edit unit A.1')">
                                            <i class="mdi mdi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger" onclick="alert('Hapus unit A.1')">
                                            <i class="mdi mdi-delete"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><strong>A.2</strong></td>
                                    <td>200</td>
                                    <td>485.000.000</td>
                                    <td>Timur</td>
                                    <td>Tengah</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary me-1" onclick="alert('Edit unit A.2')">
                                            <i class="mdi mdi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger" onclick="alert('Hapus unit A.2')">
                                            <i class="mdi mdi-delete"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><strong>A.3</strong></td>
                                    <td>200</td>
                                    <td>485.000.000</td>
                                    <td>Selatan</td>
                                    <td>Tengah</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary me-1" onclick="alert('Edit unit A.3')">
                                            <i class="mdi mdi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger" onclick="alert('Hapus unit A.3')">
                                            <i class="mdi mdi-delete"></i>
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

    <!-- Ringkasan -->
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card bg-light">
                <div class="card-body">
                    <h5 class="card-title">Ringkasan Kavling</h5>
                    <div class="row">
                        <div class="col-6">
                            <p class="text-muted mb-1">Total Unit</p>
                            <h4>3 unit</h4>
                        </div>
                        <div class="col-6">
                            <p class="text-muted mb-1">Total Luas</p>
                            <h4>600 m²</h4>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <p class="text-muted mb-1">Sisa Luas Tanah</p>
                            <h4>4.400 m²</h4>
                        </div>
                        <div class="col-6">
                            <p class="text-muted mb-1">Nilai Total</p>
                            <h4>Rp 1.470.000.000</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Denah Sederhana -->
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-map me-2 text-primary"></i>
                        Denah Kavling
                    </h5>
                </div>
                <div class="card-body text-center">
                    <div style="background-color: #f8f9fa; padding: 20px; border-radius: 8px;">
                        <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 10px;">
                            <span style="background-color: #28a745; color: white; padding: 5px 10px; border-radius: 4px;">A.1</span>
                            <span style="background-color: #28a745; color: white; padding: 5px 10px; border-radius: 4px;">A.2</span>
                            <span style="background-color: #28a745; color: white; padding: 5px 10px; border-radius: 4px;">A.3</span>
                            <span style="background-color: #6c757d; color: white; padding: 5px 10px; border-radius: 4px;">A.4</span>
                            <span style="background-color: #6c757d; color: white; padding: 5px 10px; border-radius: 4px;">A.5</span>
                            <span style="background-color: #6c757d; color: white; padding: 5px 10px; border-radius: 4px;">A.6</span>
                        </div>
                        <p class="text-muted mt-3 mb-0">Preview sederhana posisi kavling</p>
                        <small class="text-muted">(Hijau = sudah dibuat, Abu = belum dibuat)</small>
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
                        <a href="{{ url('/properti/verifikasi-legal') }}" class="btn btn-light me-2">
                            <i class="mdi mdi-arrow-left me-1"></i>Kembali
                        </a>
                        <button class="btn btn-secondary" onclick="alert('Draft kavling berhasil disimpan')">
                            <i class="mdi mdi-content-save me-1"></i>Simpan Draft
                        </button>
                    </div>
                    <div>
                        <button class="btn btn-success" onclick="alert('Kavling berhasil disimpan. Lanjut ke marketing?')">
                            <i class="mdi mdi-check-circle me-1"></i>Simpan Kavling
                        </button>
                        <button class="btn btn-primary" onclick="alert('Kavling disimpan dan lanjut ke halaman marketing')">
                            <i class="mdi mdi-arrow-right me-1"></i>Simpan & Lanjut Jual
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- AKHIR KONTEN BUAT KAVLING -->
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Enable tooltips
    $('[data-toggle="tooltip"]').tooltip();

    // Format Rupiah sederhana untuk input harga
    $('input[placeholder*="500.000.000"]').on('keyup', function() {
        let nilai = this.value.replace(/\D/g, '');
        if (nilai) {
            let rupiah = new Intl.NumberFormat('id-ID').format(nilai);
            this.value = rupiah;
        }
    });
});
</script>
@endpush
