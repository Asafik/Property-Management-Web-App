@extends('layouts.partial.app')

@section('title', 'Dashboard - Purple Admin')

@section('content')
    <!-- KONTEN DASHBOARD -->
    <div class="container-fluid p-2 p-sm-3 p-md-4 p-lg-4">
        <!-- Header Dashboard -->
        <div class="row mb-3 mb-sm-3 mb-md-4">
            <div class="col-12">
                <h3 class="text-dark fs-4 fs-sm-3 fs-md-3 fs-lg-2">Semua Tanah / LandBank Terverifikasi Dokument</h3>
            </div>
        </div>


        <!-- Tabel dengan Filter UI -->
        <div class="row mt-2 mt-sm-2 mt-md-3">
            <div class="col-12">
                <div class="card">
                    <div
                        class="card-header bg-white d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center py-2 py-sm-2 py-md-3">
                        <h4 class="card-title mb-2 mb-sm-0 fs-6 fs-sm-5 fs-md-4">Daftar Tanah / LandBank Terverifikasi
                            Terbaru</h4>
                    </div>
                    <div class="card-body pt-2 pt-sm-2 pt-md-3">
                        <!-- Filter Section - Responsive untuk Mobile & Tablet -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card border-0 mb-2">
                                    <div class="card-body py-2 py-sm-2 py-md-3 px-2 px-sm-2 px-md-3">
                                        <h6 class="card-title mb-2 fw-bold small">
                                            <i class="mdi mdi-filter-outline me-1"></i>Filter Data
                                        </h6>

                                        <!-- VERSION 1: FILTER UNTUK MOBILE (di bawah 768px) -->
                                        <div class="d-block d-sm-block d-md-none">
                                            <!-- Search - Full width di mobile -->
                                            <div class="mb-2">
                                                <label class="form-label text-muted small mb-1">Pencarian</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    placeholder="Cari nama properti...">
                                            </div>

                                            <!-- Grid 2 kolom untuk filter lainnya -->
                                            <div class="row g-2">
                                                <div class="col-6">
                                                    <label class="form-label text-muted small mb-1">Kategori</label>
                                                    <select class="form-control form-control-sm">
                                                        <option value="">Semua</option>
                                                        <option value="Rumah">Rumah</option>
                                                        <option value="Apartemen">Apartemen</option>
                                                        <option value="Ruko">Ruko</option>
                                                        <option value="Tanah">Tanah</option>
                                                    </select>
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label text-muted small mb-1">Lokasi</label>
                                                    <select class="form-control form-control-sm">
                                                        <option value="">Semua</option>
                                                        <option value="Jakarta Selatan">Jaksel</option>
                                                        <option value="Jakarta Pusat">Jakpus</option>
                                                        <option value="Jakarta Barat">Jakbar</option>
                                                        <option value="Jakarta Timur">Jaktim</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row g-2 mt-2">
                                                <div class="col-6">
                                                    <label class="form-label text-muted small mb-1">Tampil</label>
                                                    <select class="form-control form-control-sm">
                                                        <option value="10">10</option>
                                                        <option value="25">25</option>
                                                        <option value="50">50</option>
                                                    </select>
                                                </div>
                                                <div class="col-6 d-flex align-items-end">
                                                    <button type="button" class="btn btn-gradient-secondary btn-sm w-100">
                                                        <i class="mdi mdi-refresh"></i> Reset
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- VERSION 2: FILTER UNTUK TABLET (768px - 991px) -->
                                        <div class="d-none d-md-block d-lg-none">
                                            <div class="row g-2">
                                                <!-- Search - Lebih besar di tablet -->
                                                <div class="col-md-4">
                                                    <label class="form-label text-muted small mb-1">Pencarian</label>
                                                    <input type="text" class="form-control form-control-sm"
                                                        placeholder="Cari nama properti...">
                                                </div>

                                                <!-- Kategori & Lokasi dalam 2 kolom -->
                                                <div class="col-md-3">
                                                    <label class="form-label text-muted small mb-1">Kategori</label>
                                                    <select class="form-control form-control-sm">
                                                        <option value="">Semua Kategori</option>
                                                        <option value="Rumah">Rumah</option>
                                                        <option value="Apartemen">Apartemen</option>
                                                        <option value="Ruko">Ruko</option>
                                                        <option value="Tanah">Tanah</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-3">
                                                    <label class="form-label text-muted small mb-1">Lokasi</label>
                                                    <select class="form-control form-control-sm">
                                                        <option value="">Semua Lokasi</option>
                                                        <option value="Jakarta Selatan">Jakarta Selatan</option>
                                                        <option value="Jakarta Pusat">Jakarta Pusat</option>
                                                        <option value="Jakarta Barat">Jakarta Barat</option>
                                                        <option value="Jakarta Timur">Jakarta Timur</option>
                                                    </select>
                                                </div>

                                                <!-- Tampil dan Reset dalam 1 baris -->
                                                <div class="col-md-2">
                                                    <label class="form-label text-muted small mb-1">Tampil</label>
                                                    <select class="form-control form-control-sm">
                                                        <option value="10">10</option>
                                                        <option value="25">25</option>
                                                        <option value="50">50</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Baris kedua untuk tombol reset (tablet) -->
                                            <div class="row mt-2">
                                                <div class="col-md-12">
                                                    <button type="button" class="btn btn-gradient-secondary btn-sm">
                                                        <i class="mdi mdi-refresh me-1"></i> Reset Filter
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- VERSION 3: FILTER UNTUK DESKTOP (di atas 992px) - TETAP SAMA -->
                                        <div class="d-none d-lg-block">
                                            <div class="row g-2">
                                                <div class="col-md-3">
                                                    <label class="form-label text-muted small mb-1">Pencarian</label>
                                                    <input type="text" class="form-control form-control-sm"
                                                        placeholder="Cari nama properti...">
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label text-muted small mb-1">Kategori</label>
                                                    <select class="form-control form-control-sm">
                                                        <option value="">Semua Kategori</option>
                                                        <option value="Rumah">Rumah</option>
                                                        <option value="Apartemen">Apartemen</option>
                                                        <option value="Ruko">Ruko</option>
                                                        <option value="Tanah">Tanah</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label text-muted small mb-1">Lokasi</label>
                                                    <select class="form-control form-control-sm">
                                                        <option value="">Semua Lokasi</option>
                                                        <option value="Jakarta Selatan">Jakarta Selatan</option>
                                                        <option value="Jakarta Pusat">Jakarta Pusat</option>
                                                        <option value="Jakarta Barat">Jakarta Barat</option>
                                                        <option value="Jakarta Timur">Jakarta Timur</option>
                                                        <option value="Tangerang">Tangerang</option>
                                                        <option value="Bekasi">Bekasi</option>
                                                        <option value="Depok">Depok</option>
                                                        <option value="Bogor">Bogor</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label text-muted small mb-1">Tampil</label>
                                                    <select class="form-control form-control-sm">
                                                        <option value="10">10 Data</option>
                                                        <option value="25">25 Data</option>
                                                        <option value="50">50 Data</option>
                                                        <option value="100">100 Data</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 d-flex align-items-end">
                                                    <button type="button"
                                                        class="btn btn-gradient-secondary btn-sm w-100">
                                                        <i class="mdi mdi-refresh me-1"></i> Reset
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tabel Data - Responsive -->
                        <div class="table-responsive">
                            <table class="table table-hover table-sm">
    <thead>
        <tr>
            <th class="text-nowrap">No</th>
            <th class="text-nowrap">Nama Properti</th>
            <th class="text-nowrap">Tipe</th>
            <th class="text-nowrap d-none d-md-table-cell">Lokasi</th>
            <th class="text-nowrap">Harga Awal Beli</th>
            <th class="text-nowrap">Luas Tanah</th>
            <th class="text-nowrap">Sisa Tanah</th>
            <th class="text-nowrap">Status</th>
            <th class="text-nowrap">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($lands as $i => $land)
            <tr>
                <td>{{ $i + $lands->firstItem() }}</td>

                {{-- NAMA PROPERTI --}}
                <td>
                    <div class="d-flex align-items-center">
                        <span class="small small-md fw-bold">
                            {{ $land->name ?? '-' }}
                        </span>
                    </div>
                </td>

                {{-- TIPE --}}
                <td>
                    <span class="small">
                        {{ $land->zoning ?? 'Tanah' }}
                    </span>
                </td>

                {{-- LOKASI --}}
                <td class="d-none d-md-table-cell">
                    <span class="small">
                        {{ $land->address ?? '-' }}
                    </span>
                </td>

                {{-- HARGA --}}
                <td>
                    <span class="small text-nowrap">
                        Rp {{ number_format($land->acquisition_price ?? 0, 0, ',', '.') }}
                    </span>
                </td>
               <td>
    <span class="small text-nowrap">
        {{ number_format($land->area ?? 0, 0, ',', '.') }} m²
    </span>
</td>
<td>
    <span class="small text-nowrap">
        @php
            $totalUnitArea = $land->units->sum('area');
            $remainingArea = $land->area - $totalUnitArea;
        @endphp
        {{ number_format($remainingArea, 0, ',', '.') }} m²
    </span>
</td>

                {{-- STATUS --}}
                <td>
                    @if ($land->status == 'sold')
                        <label class="badge badge-gradient-danger badge-sm">Terjual</label>
                    @elseif($land->status == 'booking')
                        <label class="badge badge-gradient-warning badge-sm">Booking</label>
                    @else
                        <label class="badge badge-gradient-success badge-sm">Tersedia</label>
                    @endif
                </td>

                {{-- AKSI --}}
                <td>
                    <div class="d-flex gap-1">
                        <a href="{{ route('properti.buatKavling', ['land_bank_id' => $land->id]) }}"
                           class="btn btn-primary btn-sm">
                           Buat Kavling
                        </a>
                        {{-- Tambahkan tombol lain jika perlu --}}
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center text-muted">
                    Belum ada properti terverifikasi
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

{{-- Pagination --}}
<div class="d-flex justify-content-center mt-3">
    {{ $lands->links() }}
</div>

                        </div>


                        <!-- Pagination Sederhana - Responsive -->
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-3">
                            <div class="text-muted small mb-2 mb-sm-0"> <span class="small text-muted"> Menampilkan
                                    {{ $lands->firstItem() }} - {{ $lands->lastItem() }} dari
                                    {{ $lands->total() }} data </span> </div>
                            <div class="d-flex justify-content-center mt-3"> {{ $lands->links() }} </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- AKHIR KONTEN DASHBOARD -->
@endsection

@push('styles')
@endpush

@push('scripts')
    <script></script>
@endpush
