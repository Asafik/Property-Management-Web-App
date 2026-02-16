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
                            {{-- Nama Tanah / Proyek --}}
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="text-muted small">Nama Tanah / Proyek</label>
                                    <p class="fw-bold">{{ $land->name ?? '-' }}</p>
                                </div>
                            </div>

                            {{-- Luas Total Tanah --}}
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="text-muted small">Luas Total Tanah</label>
                                    <p class="fw-bold">{{ number_format($land->area ?? 0, 0, ',', '.') }} m²</p>
                                </div>
                            </div>

                            {{-- Sisa Luas Belum Dikavling --}}
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="text-muted small">Sisa Luas Belum Dikavling</label>
                                    <p class="fw-bold text-primary">
                                        {{ number_format($land->remaining_area ?? ($land->area ?? 0), 0, ',', '.') }} m²</p>
                                </div>
                            </div>

                            {{-- Status Legal --}}
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="text-muted small">Status Legal</label>
                                    @if ($land->legal_status == 'terverifikasi')
                                        <p class="fw-bold"><span class="badge badge-success">Terverifikasi</span></p>
                                    @else
                                        <p class="fw-bold"><span
                                                class="badge badge-warning">{{ ucfirst($land->legal_status) ?? '-' }}</span>
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Lokasi --}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-2">
                                    <label class="text-muted small">Lokasi</label>
                                    <p class="fw-bold">
                                        {{ $land->address ?? '-' }},
                                        Kel. {{ $land->village ?? '-' }},
                                        Kec. {{ $land->district ?? '-' }},
                                        {{ $land->city ?? '-' }},
                                        {{ $land->province ?? '-' }}
                                        {{ $land->postal_code ?? '' }}
                                    </p>
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
                                <a class="nav-link active" id="manual-tab" data-toggle="tab" href="#manual" role="tab"
                                    aria-controls="manual" aria-selected="true">
                                    <i class="mdi mdi-pencil me-1"></i>Manual Satu per Satu
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="generate-tab" data-toggle="tab" href="#generate" role="tab"
                                    aria-controls="generate" aria-selected="false">
                                    <i class="mdi mdi-auto-fix me-1"></i>Generate Otomatis
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="import-tab" data-toggle="tab" href="#import" role="tab"
                                    aria-controls="import" aria-selected="false">
                                    <i class="mdi mdi-import me-1"></i>Import Excel
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content mt-4" id="myTabContent">
                            <!-- TAB MANUAL -->
                            <div class="tab-pane fade show active" id="manual" role="tabpanel"
                                aria-labelledby="manual-tab">
                                <form action="{{ route('properti.storeKavling', $land->id) }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Blok / No. Unit</label>
                                                <input type="text" name="block" class="form-control"
                                                    placeholder="Contoh: A">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Nomor Unit</label>
                                                <input type="text" name="unit_number" class="form-control"
                                                    placeholder="1">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Type Unit</label>
                                                <input type="text" name="type" class="form-control"
                                                    placeholder="Cluster Ijen">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Luas (m²)</label>
                                                <input type="number" name="area" class="form-control"
                                                    placeholder="200">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Luas Bangunan(m²)</label>
                                                <input type="number" name="building_area" class="form-control"
                                                    placeholder="200">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Harga (Rp)</label>
                                                <input type="text" name="price" class="form-control"
                                                    placeholder="500.000.000">
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label>Hadap</label>
                                                <select name="facing" class="form-control">
                                                    <option>Utara</option>
                                                    <option>Selatan</option>
                                                    <option>Timur</option>
                                                    <option>Barat</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label>Posisi</label>
                                                <select name="position" class="form-control">
                                                    <option>Hook</option>
                                                    <option>Tengah</option>
                                                    <option>Sudut</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Keterangan</label>
                                                <input type="text" name="description" class="form-control"
                                                    placeholder="Opsional">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="mdi mdi-plus me-1"></i>Tambah Unit ke Daftar
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>


                            <!-- TAB GENERATE OTOMATIS -->
                            <div class="tab-pane fade" id="generate" role="tabpanel" aria-labelledby="generate-tab">
                                <form action="{{ route('properti.generateKavling', $land->id) }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Jumlah Unit</label>
                                                <input type="number" name="jumlah_unit" class="form-control"
                                                    value="10">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Luas per Unit (m²)</label>
                                                <input type="number" name="area_per_unit" class="form-control"
                                                    value="200">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Harga per Unit (Rp)</label>
                                                <input type="text" name="price_per_unit" class="form-control"
                                                    value="500.000.000">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Prefix Blok</label>
                                                <input type="text" name="prefix_block" class="form-control"
                                                    value="A">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Nomor Awal</label>
                                                <input type="number" name="start_number" class="form-control"
                                                    value="1">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Hadap Default</label>
                                                <select name="default_facing" class="form-control">
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
                                                <select name="default_position" class="form-control">
                                                    <option>Tengah</option>
                                                    <option>Hook</option>
                                                    <option>Sudut</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 d-flex align-items-end">
                                            <div class="form-group w-100">
                                                <button type="submit" class="btn btn-primary w-100">
                                                    <i class="mdi mdi-auto-fix me-1"></i>Generate Unit
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="alert alert-info mt-3">
                                    <i class="mdi mdi-information-outline me-2"></i>
                                    Total luas yang akan digunakan: <strong>{{ $land->area_used ?? 0 }} m²</strong> dari
                                    {{ $land->total_area ?? 0 }} m²
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
                                                    <button class="btn btn-outline-success"
                                                        onclick="alert('Download template excel')">
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
                        <span class="badge badge-primary">{{ $land->units->count() }} unit</span>
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
                                    @forelse($land->units as $i => $unit)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td><strong>{{ $unit->unit_code }}</strong></td>
                                            <td>{{ number_format($unit->area, 0, ',', '.') }}</td>
                                            <td>{{ number_format($unit->price ?? 0, 0, ',', '.') }}</td>
                                            <td>{{ $unit->facing ?? '-' }}</td>
                                            <td>{{ $unit->position ?? '-' }}</td>
                                            <td>
                                                {{-- Edit --}}
                                                <a href="{{ route('properti.kavling.edit', ['unit' => $unit->id]) }}"
                                                    class="btn btn-sm btn-outline-primary me-1">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>

                                                {{-- Update Progress --}}
                                                <a href="{{ route('properti.progress', ['land_bank_id' => $unit->land_bank_id]) }}"
                                                    class="btn btn-sm btn-outline-info me-1">
                                                    <i class="mdi mdi-progress-clock"></i>
                                                </a>


                                                {{-- Delete --}}
                                                <form
                                                    action="{{ route('properti.kavling.destroy', ['unit' => $unit->id]) }}"
                                                    method="POST" style="display:inline-block;"
                                                    onsubmit="return confirm('Hapus unit {{ $unit->unit_code }}?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-outline-danger">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </form>
                                            </td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted">
                                                Belum ada unit kavling
                                            </td>
                                        </tr>
                                    @endforelse
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
                        @php
                            $totalUnits = $land->units->count();
                            $totalArea = $land->units->sum('area');
                            $sisaLuas = max(0, $land->remaining_area ?? $land->area - $totalArea);
                            $totalNilai = $land->units->sum('price');

                            // Progress pembangunan berdasarkan luas yang sudah terpakai
                            $progressPercent = $land->area > 0 ? ($totalArea / $land->area) * 100 : 0;
                        @endphp

                        <div class="row">
                            <div class="col-6">
                                <p class="text-muted mb-1">Total Unit</p>
                                <h4>{{ $totalUnits }} unit</h4>
                            </div>
                            <div class="col-6">
                                <p class="text-muted mb-1">Total Luas</p>
                                <h4>{{ number_format($totalArea, 0, ',', '.') }} m²</h4>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-6">
                                <p class="text-muted mb-1">Sisa Luas Tanah</p>
                                <h4>{{ number_format($sisaLuas, 0, ',', '.') }} m²</h4>
                            </div>
                            <div class="col-6">
                                <p class="text-muted mb-1">Nilai Total</p>
                                <h4>Rp {{ number_format($totalNilai, 0, ',', '.') }}</h4>
                            </div>
                        </div>

                        <!-- Progress Pembangunan -->
                        @php
                            $progressPercent = $unit->construction_progress ?? 0;
                        @endphp

                        <div class="mt-4">
                            <p class="text-muted mb-1">Progress Pembangunan</p>
     <div class="progress">
    <div class="progress-bar bg-success"
         role="progressbar"
         style="width: {{ $unit->progress_percentage }}%;"
         aria-valuenow="{{ $unit->progress_percentage }}"
         aria-valuemin="0"
         aria-valuemax="100">
        {{ $unit->construction_progress }} ({{ $unit->progress_percentage }}%)
    </div>
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
                                @php
                                    // Misal kavling dari A.1 sampai A.6
                                    $allKavlings = [];
                                    for ($i = 1; $i <= 6; $i++) {
                                        $allKavlings[] = 'A.' . $i;
                                    }
                                    $createdKavlings = $land->units->pluck('unit_code')->toArray();
                                @endphp

                                @foreach ($allKavlings as $kav)
                                    <span
                                        style="background-color: {{ in_array($kav, $createdKavlings) ? '#28a745' : '#6c757d' }}; color: white; padding: 5px 10px; border-radius: 4px;">
                                        {{ $kav }}
                                    </span>
                                @endforeach
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
                            <button class="btn btn-success"
                                onclick="alert('Kavling berhasil disimpan. Lanjut ke marketing?')">
                                <i class="mdi mdi-check-circle me-1"></i>Simpan Kavling
                            </button>
                            <button class="btn btn-primary"
                                onclick="alert('Kavling disimpan dan lanjut ke halaman marketing')">
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
