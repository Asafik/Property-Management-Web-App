@extends('layouts.partial.app')

@section('title', 'Dashboard - Purple Admin')

@section('content')
<!-- KONTEN DASHBOARD -->
<div class="container-fluid p-2 p-sm-3 p-md-4 p-lg-4">
    <!-- Header Dashboard -->
    <div class="row mb-3 mb-sm-3 mb-md-4">
        <div class="col-12">
            <h3 class="text-dark fs-4 fs-sm-3 fs-md-3 fs-lg-2">Dashboard</h3>
            <p class="text-muted small small-sm small-md mb-0">Selamat Datang di Dashboard Admin</p>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-2 g-sm-2 g-md-3">
        <!-- Mobile: 2 cards per row, Tablet: 2 cards per row, Desktop: 4 cards per row -->
        <div class="col-6 col-sm-6 col-md-6 col-lg-3 mb-2 mb-sm-2 mb-md-3">
            <div class="card bg-gradient-primary card-img-holder text-white h-100">
                <div class="card-body p-2 p-sm-2 p-md-3">
                    <img src="{{ asset('admin/assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-2 mb-sm-2 mb-md-3 small fs-6 fs-sm-6 fs-md-5">
                        Total Properti
                        <i class="mdi mdi-office-building float-end" style="font-size: 1.2rem;"></i>
                    </h4>
                    <h2 class="mb-2 mb-sm-2 mb-md-4 fs-5 fs-sm-5 fs-md-2">156</h2>
                    <h6 class="card-text small">+12%</h6>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-6 col-md-6 col-lg-3 mb-2 mb-sm-2 mb-md-3">
            <div class="card bg-gradient-info card-img-holder text-white h-100">
                <div class="card-body p-2 p-sm-2 p-md-3">
                    <img src="{{ asset('admin/assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-2 mb-sm-2 mb-md-3 small fs-6 fs-sm-6 fs-md-5">
                        Total Customer
                        <i class="mdi mdi-account-group float-end" style="font-size: 1.2rem;"></i>
                    </h4>
                    <h2 class="mb-2 mb-sm-2 mb-md-4 fs-5 fs-sm-5 fs-md-2">892</h2>
                    <h6 class="card-text small">+5%</h6>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-6 col-md-6 col-lg-3 mb-2 mb-sm-2 mb-md-3">
            <div class="card bg-gradient-success card-img-holder text-white h-100">
                <div class="card-body p-2 p-sm-2 p-md-3">
                    <img src="{{ asset('admin/assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-2 mb-sm-2 mb-md-3 small fs-6 fs-sm-6 fs-md-5">
                        Transaksi
                        <i class="mdi mdi-cash-multiple float-end" style="font-size: 1.2rem;"></i>
                    </h4>
                    <h2 class="mb-2 mb-sm-2 mb-md-4 fs-5 fs-sm-5 fs-md-2">45</h2>
                    <h6 class="card-text small">Bulan ini</h6>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-6 col-md-6 col-lg-3 mb-2 mb-sm-2 mb-md-3">
            <div class="card bg-gradient-danger card-img-holder text-white h-100">
                <div class="card-body p-2 p-sm-2 p-md-3">
                    <img src="{{ asset('admin/assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-2 mb-sm-2 mb-md-3 small fs-6 fs-sm-6 fs-md-5">
                        Pendapatan
                        <i class="mdi mdi-currency-usd float-end" style="font-size: 1.2rem;"></i>
                    </h4>
                    <h2 class="mb-2 mb-sm-2 mb-md-4 fs-5 fs-sm-5 fs-md-2">Rp 2,5 M</h2>
                    <h6 class="card-text small">+18%</h6>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel dengan Filter UI -->
    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center py-2 py-sm-2 py-md-3">
                    <h4 class="card-title mb-2 mb-sm-0 fs-6 fs-sm-5 fs-md-4">Daftar Properti Terbaru</h4>
                    <a href="#" class="btn btn-gradient-primary btn-sm w-100 w-sm-auto">+ Tambah</a>
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
                                            <input type="text" class="form-control form-control-sm" placeholder="Cari nama properti...">
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
                                                <input type="text" class="form-control form-control-sm" placeholder="Cari nama properti...">
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
                                                <input type="text" class="form-control form-control-sm" placeholder="Cari nama properti...">
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
                                                <button type="button" class="btn btn-gradient-secondary btn-sm w-100">
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
                                    <th class="text-nowrap">Kategori</th>
                                    <!-- Sembunyikan Lokasi di mobile, tampilkan di tablet/desktop -->
                                    <th class="text-nowrap d-none d-md-table-cell">Lokasi</th>
                                    <th class="text-nowrap">Harga</th>
                                    <th class="text-nowrap">Status</th>
                                    <th class="text-nowrap">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('admin/assets/images/faces/face1.jpg') }}"
                                                 class="me-2 rounded"
                                                 width="30"
                                                 height="30"
                                                 style="object-fit: cover;"
                                                 alt="image">
                                            <span class="small small-md">Griya Permata</span>
                                        </div>
                                    </td>
                                    <td><span class="small">Rumah</span></td>
                                    <td class="d-none d-md-table-cell"><span class="small">Jakarta Selatan</span></td>
                                    <td><span class="small text-nowrap">Rp 1,2 M</span></td>
                                    <td>
                                        <label class="badge badge-gradient-success badge-sm">Tersedia</label>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="#" class="btn btn-sm btn-gradient-info p-1 p-sm-1 p-md-2">
                                                <i class="mdi mdi-eye" style="font-size: 1rem;"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-gradient-warning p-1 p-sm-1 p-md-2">
                                                <i class="mdi mdi-pencil" style="font-size: 1rem;"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-gradient-danger p-1 p-sm-1 p-md-2">
                                                <i class="mdi mdi-delete" style="font-size: 1rem;"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('admin/assets/images/faces/face2.jpg') }}"
                                                 class="me-2 rounded"
                                                 width="30"
                                                 height="30"
                                                 style="object-fit: cover;"
                                                 alt="image">
                                            <span class="small small-md">Apartemen Mewah</span>
                                        </div>
                                    </td>
                                    <td><span class="small">Apartemen</span></td>
                                    <td class="d-none d-md-table-cell"><span class="small">Jakarta Pusat</span></td>
                                    <td><span class="small text-nowrap">Rp 850 Jt</span></td>
                                    <td>
                                        <label class="badge badge-gradient-warning badge-sm">Booking</label>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="#" class="btn btn-sm btn-gradient-info p-1 p-sm-1 p-md-2">
                                                <i class="mdi mdi-eye" style="font-size: 1rem;"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-gradient-warning p-1 p-sm-1 p-md-2">
                                                <i class="mdi mdi-pencil" style="font-size: 1rem;"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-gradient-danger p-1 p-sm-1 p-md-2">
                                                <i class="mdi mdi-delete" style="font-size: 1rem;"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Tambahkan baris lainnya dengan struktur yang sama -->
                                <tr>
                                    <td>3</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('admin/assets/images/faces/face3.jpg') }}"
                                                 class="me-2 rounded"
                                                 width="30"
                                                 height="30"
                                                 style="object-fit: cover;"
                                                 alt="image">
                                            <span class="small small-md">Citra Garden</span>
                                        </div>
                                    </td>
                                    <td><span class="small">Rumah</span></td>
                                    <td class="d-none d-md-table-cell"><span class="small">Jakarta Barat</span></td>
                                    <td><span class="small text-nowrap">Rp 950 Jt</span></td>
                                    <td>
                                        <label class="badge badge-gradient-success badge-sm">Tersedia</label>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="#" class="btn btn-sm btn-gradient-info p-1 p-sm-1 p-md-2">
                                                <i class="mdi mdi-eye" style="font-size: 1rem;"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-gradient-warning p-1 p-sm-1 p-md-2">
                                                <i class="mdi mdi-pencil" style="font-size: 1rem;"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-gradient-danger p-1 p-sm-1 p-md-2">
                                                <i class="mdi mdi-delete" style="font-size: 1rem;"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Lanjutkan hingga row 8 dengan pola yang sama -->
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Sederhana - Responsive -->
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-3">
                        <div class="text-muted small mb-2 mb-sm-0">
                            <span class="d-none d-sm-inline">Menampilkan</span> 1-8 dari 156
                        </div>
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">«</a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item d-none d-sm-block"><a class="page-link" href="#">4</a></li>
                                <li class="page-item d-none d-sm-block"><a class="page-link" href="#">5</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">»</a>
                                </li>
                            </ul>
                        </nav>
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
<script>

</script>
@endpush
