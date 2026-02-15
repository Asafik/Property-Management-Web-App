@extends('layouts.partial.app')

@section('title', 'Dashboard Marketing - Properti Management')

@section('content')
<div class="container-fluid px-0 px-sm-2 px-md-3 px-lg-4">
    <!-- Header -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body p-3 p-md-4">
                    <div class="d-flex flex-column flex-md-row flex-wrap align-items-start align-items-md-center justify-content-between">
                        <div class="mb-2 mb-md-0">
                            <h4 class="mb-1 fs-5 fs-md-4">Dashboard Marketing</h4>
                            <p class="text-muted mb-0 small">Monitoring semua pengajuan KPR dan Cash</p>
                        </div>
                        <div class="mt-2 mt-md-0">
                            <span class="text-muted small">Senin, 16 Februari 2026</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Row Statistik -->
    <div class="row mt-3 mt-md-4 g-2 g-md-3">
        <div class="col-6 col-md-3 grid-margin stretch-card">
            <div class="card shadow-sm h-100">
                <div class="card-body p-2 p-md-3">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-gradient rounded-circle p-2 p-md-3 me-2 me-md-3">
                            <i class="mdi mdi-file-document text-white" style="font-size: 1.2rem; font-size: clamp(1rem, 3vw, 1.5rem);"></i>
                        </div>
                        <div class="overflow-hidden">
                            <h3 class="mb-0 fs-5 fs-md-3">24</h3>
                            <small class="text-muted text-truncate d-block" style="font-size: clamp(0.7rem, 2vw, 0.85rem);">Total Pengajuan</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3 grid-margin stretch-card">
            <div class="card shadow-sm h-100">
                <div class="card-body p-2 p-md-3">
                    <div class="d-flex align-items-center">
                        <div class="bg-info bg-gradient rounded-circle p-2 p-md-3 me-2 me-md-3">
                            <i class="mdi mdi-bank text-white" style="font-size: 1.2rem; font-size: clamp(1rem, 3vw, 1.5rem);"></i>
                        </div>
                        <div class="overflow-hidden">
                            <h3 class="mb-0 fs-5 fs-md-3">15</h3>
                            <small class="text-muted text-truncate d-block" style="font-size: clamp(0.7rem, 2vw, 0.85rem);">KPR Diproses</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3 grid-margin stretch-card mt-2 mt-md-0">
            <div class="card shadow-sm h-100">
                <div class="card-body p-2 p-md-3">
                    <div class="d-flex align-items-center">
                        <div class="bg-success bg-gradient rounded-circle p-2 p-md-3 me-2 me-md-3">
                            <i class="mdi mdi-cash text-white" style="font-size: 1.2rem; font-size: clamp(1rem, 3vw, 1.5rem);"></i>
                        </div>
                        <div class="overflow-hidden">
                            <h3 class="mb-0 fs-5 fs-md-3">9</h3>
                            <small class="text-muted text-truncate d-block" style="font-size: clamp(0.7rem, 2vw, 0.85rem);">Cash</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3 grid-margin stretch-card mt-2 mt-md-0">
            <div class="card shadow-sm h-100">
                <div class="card-body p-2 p-md-3">
                    <div class="d-flex align-items-center">
                        <div class="bg-warning bg-gradient rounded-circle p-2 p-md-3 me-2 me-md-3">
                            <i class="mdi mdi-check-circle text-white" style="font-size: 1.2rem; font-size: clamp(1rem, 3vw, 1.5rem);"></i>
                        </div>
                        <div class="overflow-hidden">
                            <h3 class="mb-0 fs-5 fs-md-3">12</h3>
                            <small class="text-muted text-truncate d-block" style="font-size: clamp(0.7rem, 2vw, 0.85rem);">Cair / Lunas</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter dan Search -->
    <div class="row mt-3 mt-md-4">
        <div class="col-12 grid-margin stretch-card">
            <div class="card shadow-sm">
                <div class="card-body p-3 p-md-4">
                    <div class="row g-2 g-md-3 align-items-end">
                        <div class="col-12 col-md-4">
                            <label class="small text-muted mb-1 d-block d-md-none">Pencarian</label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="mdi mdi-magnify"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Cari customer, no booking, unit...">
                            </div>
                        </div>
                        <div class="col-6 col-md-2">
                            <label class="small text-muted mb-1 d-block d-md-none">Status</label>
                            <select class="form-control form-control-sm">
                                <option value="">Semua Status</option>
                                <option>Draft</option>
                                <option>Pengajuan</option>
                                <option>Verifikasi</option>
                                <option>Survey</option>
                                <option>Akad</option>
                                <option>Cair</option>
                                <option>Lunas</option>
                                <option>Ditolak</option>
                            </select>
                        </div>
                        <div class="col-6 col-md-2">
                            <label class="small text-muted mb-1 d-block d-md-none">Metode</label>
                            <select class="form-control form-control-sm">
                                <option value="">Semua Metode</option>
                                <option>KPR</option>
                                <option>Cash</option>
                            </select>
                        </div>
                        <div class="col-6 col-md-2">
                            <label class="small text-muted mb-1 d-block d-md-none">Marketing</label>
                            <select class="form-control form-control-sm">
                                <option value="">Semua Marketing</option>
                                <option>Ahmad Rizki</option>
                                <option>Rina Wijaya</option>
                                <option>Budi Hartono</option>
                            </select>
                        </div>
                        <div class="col-6 col-md-2 text-end">
                            <div class="d-flex gap-1 justify-content-end">
                                <button class="btn btn-sm btn-gradient-primary flex-fill flex-md-grow-0">
                                    <i class="mdi mdi-filter me-1"></i> <span class="d-none d-md-inline">Filter</span>
                                </button>
                                <button class="btn btn-sm btn-gradient-secondary">
                                    <i class="mdi mdi-refresh"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel List Pengajuan -->
    <div class="row mt-3 mt-md-4">
        <div class="col-12 grid-margin stretch-card">
            <div class="card shadow-sm">
                <div class="card-body p-2 p-md-4">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
                        <h5 class="card-title mb-2 mb-md-0 fs-6 fs-md-5">Daftar Pengajuan</h5>
                        <div class="d-flex gap-1">
                            <button class="btn btn-xs btn-sm btn-gradient-success">
                                <i class="mdi mdi-file-excel me-1"></i> <span class="d-none d-sm-inline">Excel</span>
                            </button>
                            <button class="btn btn-xs btn-sm btn-gradient-danger">
                                <i class="mdi mdi-file-pdf me-1"></i> <span class="d-none d-sm-inline">PDF</span>
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive" style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
                        <table class="table table-hover table-sm align-middle mb-0" style="min-width: 900px;">
                            <thead class="bg-light">
                                <tr>
                                    <th class="py-2 ps-2 ps-md-3" width="5%">No</th>
                                    <th class="py-2" width="12%">Booking ID</th>
                                    <th class="py-2" width="12%">Customer</th>
                                    <th class="py-2" width="12%">Unit</th>
                                    <th class="py-2" width="8%">Metode</th>
                                    <th class="py-2" width="10%">Status</th>
                                    <th class="py-2" width="12%">Progress</th>
                                    <th class="py-2" width="10%">Marketing</th>
                                    <th class="py-2 pe-2 pe-md-3" width="12%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="ps-2 ps-md-3">1</td>
                                    <td><span class="fw-medium small">INV/202502/001</span></td>
                                    <td class="small">Budi Santoso</td>
                                    <td class="small">Lavender 45</td>
                                    <td><span class="badge badge-info badge-sm">KPR</span></td>
                                    <td><span class="badge badge-warning badge-sm">Survey</span></td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="progress w-100" style="height: 4px;">
                                                <div class="progress-bar bg-info" style="width: 60%"></div>
                                            </div>
                                            <span class="small">60%</span>
                                        </div>
                                    </td>
                                    <td class="small">Ahmad Rizki</td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="#" class="btn btn-xs btn-gradient-info p-1">
                                                <i class="mdi mdi-eye" style="font-size: 0.9rem;"></i>
                                            </a>
                                            <a href="#" class="btn btn-xs btn-gradient-warning p-1">
                                                <i class="mdi mdi-pencil" style="font-size: 0.9rem;"></i>
                                            </a>
                                            <a href="#" class="btn btn-xs btn-gradient-danger p-1">
                                                <i class="mdi mdi-delete" style="font-size: 0.9rem;"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ps-2 ps-md-3">2</td>
                                    <td><span class="fw-medium small">INV/202502/002</span></td>
                                    <td class="small">Siti Aminah</td>
                                    <td class="small">Garden 36</td>
                                    <td><span class="badge badge-success badge-sm">Cash</span></td>
                                    <td><span class="badge badge-success badge-sm">Lunas</span></td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="progress w-100" style="height: 4px;">
                                                <div class="progress-bar bg-success" style="width: 100%"></div>
                                            </div>
                                            <span class="small">100%</span>
                                        </div>
                                    </td>
                                    <td class="small">Rina Wijaya</td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="#" class="btn btn-xs btn-gradient-info p-1">
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                            <a href="#" class="btn btn-xs btn-gradient-warning p-1">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            <a href="#" class="btn btn-xs btn-gradient-danger p-1">
                                                <i class="mdi mdi-delete"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ps-2 ps-md-3">3</td>
                                    <td><span class="fw-medium small">INV/202502/003</span></td>
                                    <td class="small">Joko Widodo</td>
                                    <td class="small">Royal 70</td>
                                    <td><span class="badge badge-info badge-sm">KPR</span></td>
                                    <td><span class="badge badge-primary badge-sm">Akad</span></td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="progress w-100" style="height: 4px;">
                                                <div class="progress-bar bg-primary" style="width: 80%"></div>
                                            </div>
                                            <span class="small">80%</span>
                                        </div>
                                    </td>
                                    <td class="small">Ahmad Rizki</td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="#" class="btn btn-xs btn-gradient-info p-1">
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                            <a href="#" class="btn btn-xs btn-gradient-warning p-1">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            <a href="#" class="btn btn-xs btn-gradient-danger p-1">
                                                <i class="mdi mdi-delete"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ps-2 ps-md-3">4</td>
                                    <td><span class="fw-medium small">INV/202502/004</span></td>
                                    <td class="small">Rini Susanti</td>
                                    <td class="small">Lavender 45</td>
                                    <td><span class="badge badge-info badge-sm">KPR</span></td>
                                    <td><span class="badge badge-danger badge-sm">Ditolak</span></td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="progress w-100" style="height: 4px;">
                                                <div class="progress-bar bg-danger" style="width: 40%"></div>
                                            </div>
                                            <span class="small">40%</span>
                                        </div>
                                    </td>
                                    <td class="small">Budi Hartono</td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="#" class="btn btn-xs btn-gradient-info p-1">
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                            <a href="#" class="btn btn-xs btn-gradient-warning p-1">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            <a href="#" class="btn btn-xs btn-gradient-danger p-1">
                                                <i class="mdi mdi-delete"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ps-2 ps-md-3">5</td>
                                    <td><span class="fw-medium small">INV/202502/005</span></td>
                                    <td class="small">Hendra Wijaya</td>
                                    <td class="small">Garden 36</td>
                                    <td><span class="badge badge-info badge-sm">KPR</span></td>
                                    <td><span class="badge badge-warning badge-sm">Verifikasi</span></td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="progress w-100" style="height: 4px;">
                                                <div class="progress-bar bg-warning" style="width: 40%"></div>
                                            </div>
                                            <span class="small">40%</span>
                                        </div>
                                    </td>
                                    <td class="small">Rina Wijaya</td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="#" class="btn btn-xs btn-gradient-info p-1">
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                            <a href="#" class="btn btn-xs btn-gradient-warning p-1">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            <a href="#" class="btn btn-xs btn-gradient-danger p-1">
                                                <i class="mdi mdi-delete"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ps-2 ps-md-3">6</td>
                                    <td><span class="fw-medium small">INV/202502/006</span></td>
                                    <td class="small">Dewi Lestari</td>
                                    <td class="small">Royal 70</td>
                                    <td><span class="badge badge-success badge-sm">Cash</span></td>
                                    <td><span class="badge badge-warning badge-sm">Bertahap</span></td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="progress w-100" style="height: 4px;">
                                                <div class="progress-bar bg-success" style="width: 25%"></div>
                                            </div>
                                            <span class="small">25%</span>
                                        </div>
                                    </td>
                                    <td class="small">Ahmad Rizki</td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="#" class="btn btn-xs btn-gradient-info p-1">
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                            <a href="#" class="btn btn-xs btn-gradient-warning p-1">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            <a href="#" class="btn btn-xs btn-gradient-danger p-1">
                                                <i class="mdi mdi-delete"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ps-2 ps-md-3">7</td>
                                    <td><span class="fw-medium small">INV/202502/007</span></td>
                                    <td class="small">Fajar Pratama</td>
                                    <td class="small">Lavender 45</td>
                                    <td><span class="badge badge-info badge-sm">KPR</span></td>
                                    <td><span class="badge badge-primary badge-sm">Cair</span></td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="progress w-100" style="height: 4px;">
                                                <div class="progress-bar bg-primary" style="width: 100%"></div>
                                            </div>
                                            <span class="small">100%</span>
                                        </div>
                                    </td>
                                    <td class="small">Budi Hartono</td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="#" class="btn btn-xs btn-gradient-info p-1">
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                            <a href="#" class="btn btn-xs btn-gradient-warning p-1">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            <a href="#" class="btn btn-xs btn-gradient-danger p-1">
                                                <i class="mdi mdi-delete"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination (disembunyikan sementara) -->
                    <div class="d-flex justify-content-between align-items-center mt-4 d-none">
                        <div class="text-muted small">
                            Menampilkan 1 - 7 dari 24 data
                        </div>
                        <nav>
                            <ul class="pagination mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#">«</a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">4</a></li>
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
@endsection

@push('styles')
<style>
    .bg-gradient-primary {
        background: linear-gradient(45deg, #4b49ac, #7a78c5);
    }
    .bg-gradient-info {
        background: linear-gradient(45deg, #00c5fb, #0258f3);
    }
    .bg-gradient-success {
        background: linear-gradient(45deg, #00d25b, #028a44);
    }
    .bg-gradient-warning {
        background: linear-gradient(45deg, #ffab2e, #f16a0e);
    }
    .gap-1 {
        gap: 0.25rem;
    }
    .table td {
        vertical-align: middle;
    }
    .badge {
        padding: 4px 6px;
        font-weight: 500;
        font-size: 0.75rem;
    }
    .progress {
        background-color: #e9ecef;
    }
    .btn-xs {
        padding: 0.2rem 0.4rem;
        font-size: 0.75rem;
        line-height: 1;
    }
    .btn-sm {
        line-height: 1.2;
    }
    .btn i {
        vertical-align: middle;
    }

    /* Responsive font sizes */
    .fs-5 {
        font-size: 1.1rem;
    }
    .fs-6 {
        font-size: 0.95rem;
    }
    @media (min-width: 768px) {
        .fs-md-3 {
            font-size: 1.5rem;
        }
        .fs-md-4 {
            font-size: 1.3rem;
        }
        .fs-md-5 {
            font-size: 1.2rem;
        }
    }

    /* Card statistik di HP */
    @media (max-width: 575px) {
        .grid-margin {
            margin-bottom: 0.5rem;
        }
        .card-body {
            padding: 0.75rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Halaman list pengajuan - no logic needed
});
</script>
@endpush
