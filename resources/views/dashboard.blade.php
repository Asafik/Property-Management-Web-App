@extends('layouts.partial.app')

@section('title', 'Dashboard - Purple Admin')

@section('content')
<!-- KONTEN DASHBOARD -->
<div class="container-fluid p-4">
    <!-- Header Dashboard -->
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="text-dark">Dashboard</h3>
            <p class="text-muted">Selamat Datang di Dashboard Admin</p>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row">
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-primary card-img-holder text-white">
                <div class="card-body">
                    <img src="{{ asset('admin/assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Total Properti <i class="mdi mdi-office-building mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">156</h2>
                    <h6 class="card-text">+12% dari bulan lalu</h6>
                </div>
            </div>
        </div>
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                    <img src="{{ asset('admin/assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Total Customer <i class="mdi mdi-account-group mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">892</h2>
                    <h6 class="card-text">+5% dari bulan lalu</h6>
                </div>
            </div>
        </div>
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-success card-img-holder text-white">
                <div class="card-body">
                    <img src="{{ asset('admin/assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Transaksi <i class="mdi mdi-cash-multiple mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">45</h2>
                    <h6 class="card-text">Bulan ini</h6>
                </div>
            </div>
        </div>
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-danger card-img-holder text-white">
                <div class="card-body">
                    <img src="{{ asset('admin/assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Pendapatan <i class="mdi mdi-currency-usd mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">Rp 2,5 M</h2>
                    <h6 class="card-text">+18% dari bulan lalu</h6>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel DataTables -->
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Daftar Properti Terbaru</h4>
                    <a href="#" class="btn btn-gradient-primary btn-sm">Tambah Properti</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Properti</th>
                                    <th>Kategori</th>
                                    <th>Lokasi</th>
                                    <th>Harga</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <img src="{{ asset('admin/assets/images/faces/face1.jpg') }}" class="me-2 rounded" width="35" alt="image">
                                        Griya Permata
                                    </td>
                                    <td>Rumah</td>
                                    <td>Jakarta Selatan</td>
                                    <td>Rp 1,2 M</td>
                                    <td>
                                        <label class="badge badge-gradient-success">Tersedia</label>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-gradient-info"><i class="mdi mdi-eye"></i></a>
                                        <a href="#" class="btn btn-sm btn-gradient-warning"><i class="mdi mdi-pencil"></i></a>
                                        <a href="#" class="btn btn-sm btn-gradient-danger"><i class="mdi mdi-delete"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>
                                        <img src="{{ asset('admin/assets/images/faces/face2.jpg') }}" class="me-2 rounded" width="35" alt="image">
                                    </td>
                                    <td>Apartemen</td>
                                    <td>Jakarta Pusat</td>
                                    <td>Rp 850 Jt</td>
                                    <td>
                                        <label class="badge badge-gradient-warning">Booking</label>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-gradient-info"><i class="mdi mdi-eye"></i></a>
                                        <a href="#" class="btn btn-sm btn-gradient-warning"><i class="mdi mdi-pencil"></i></a>
                                        <a href="#" class="btn btn-sm btn-gradient-danger"><i class="mdi mdi-delete"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>
                                        <img src="{{ asset('admin/assets/images/faces/face3.jpg') }}" class="me-2 rounded" width="35" alt="image">
                                        Citra Garden
                                    </td>
                                    <td>Rumah</td>
                                    <td>Jakarta Barat</td>
                                    <td>Rp 950 Jt</td>
                                    <td>
                                        <label class="badge badge-gradient-success">Tersedia</label>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-gradient-info"><i class="mdi mdi-eye"></i></a>
                                        <a href="#" class="btn btn-sm btn-gradient-warning"><i class="mdi mdi-pencil"></i></a>
                                        <a href="#" class="btn btn-sm btn-gradient-danger"><i class="mdi mdi-delete"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>
                                        <img src="{{ asset('admin/assets/images/faces/face4.jpg') }}" class="me-2 rounded" width="35" alt="image">
                                        Green Lake
                                    </td>
                                    <td>Rumah</td>
                                    <td>Tangerang</td>
                                    <td>Rp 1,5 M</td>
                                    <td>
                                        <label class="badge badge-gradient-info">Terjual</label>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-gradient-info"><i class="mdi mdi-eye"></i></a>
                                        <a href="#" class="btn btn-sm btn-gradient-warning"><i class="mdi mdi-pencil"></i></a>
                                        <a href="#" class="btn btn-sm btn-gradient-danger"><i class="mdi mdi-delete"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>
                                        <img src="{{ asset('admin/assets/images/faces/face5.jpg') }}" class="me-2 rounded" width="35" alt="image">
                                    </td>
                                    <td>Apartemen</td>
                                    <td>Jakarta Timur</td>
                                    <td>Rp 780 Jt</td>
                                    <td>
                                        <label class="badge badge-gradient-success">Tersedia</label>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-gradient-info"><i class="mdi mdi-eye"></i></a>
                                        <a href="#" class="btn btn-sm btn-gradient-warning"><i class="mdi mdi-pencil"></i></a>
                                        <a href="#" class="btn btn-sm btn-gradient-danger"><i class="mdi mdi-delete"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>
                                        <img src="{{ asset('admin/assets/images/faces/face6.jpg') }}" class="me-2 rounded" width="35" alt="image">
                                        Grand Wisata
                                    </td>
                                    <td>Rumah</td>
                                    <td>Bekasi</td>
                                    <td>Rp 890 Jt</td>
                                    <td>
                                        <label class="badge badge-gradient-warning">Booking</label>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-gradient-info"><i class="mdi mdi-eye"></i></a>
                                        <a href="#" class="btn btn-sm btn-gradient-warning"><i class="mdi mdi-pencil"></i></a>
                                        <a href="#" class="btn btn-sm btn-gradient-danger"><i class="mdi mdi-delete"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>
                                        <img src="{{ asset('admin/assets/images/faces/face7.jpg') }}" class="me-2 rounded" width="35" alt="image">
                                    </td>
                                    <td>Ruko</td>
                                    <td>Depok</td>
                                    <td>Rp 2,1 M</td>
                                    <td>
                                        <label class="badge badge-gradient-success">Tersedia</label>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-gradient-info"><i class="mdi mdi-eye"></i></a>
                                        <a href="#" class="btn btn-sm btn-gradient-warning"><i class="mdi mdi-pencil"></i></a>
                                        <a href="#" class="btn btn-sm btn-gradient-danger"><i class="mdi mdi-delete"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>
                                        <img src="{{ asset('admin/assets/images/faces/face8.jpg') }}" class="me-2 rounded" width="35" alt="image">
                                    </td>
                                    <td>Tanah</td>
                                    <td>Bogor</td>
                                    <td>Rp 3,5 M</td>
                                    <td>
                                        <label class="badge badge-gradient-info">Terjual</label>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-gradient-info"><i class="mdi mdi-eye"></i></a>
                                        <a href="#" class="btn btn-sm btn-gradient-warning"><i class="mdi mdi-pencil"></i></a>
                                        <a href="#" class="btn btn-sm btn-gradient-danger"><i class="mdi mdi-delete"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- AKHIR KONTEN DASHBOARD -->
@endsection

@push('styles')
<!-- DataTables CSS -->
<link rel="stylesheet" href="{{ asset('admin/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
<style>
    .datatable tbody tr:hover {
        background-color: rgba(0,0,0,.02);
    }
    .btn-group-sm > .btn, .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        line-height: 1.5;
        border-radius: 0.2rem;
        margin: 0 2px;
    }
</style>
@endpush

@push('scripts')
<!-- DataTables JS -->
<script src="{{ asset('admin/assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('admin/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>

<script>
$(document).ready(function() {
    // Inisialisasi DataTables
    $('.datatable').DataTable({
        "language": {
            "processing": "Sedang memproses...",
            "lengthMenu": "Tampilkan _MENU_ data per halaman",
            "zeroRecords": "Data tidak ditemukan",
            "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
            "infoEmpty": "Tidak ada data yang tersedia",
            "infoFiltered": "(difilter dari _MAX_ total data)",
            "search": "Cari:",
            "paginate": {
                "first": "Pertama",
                "last": "Terakhir",
                "next": "Selanjutnya",
                "previous": "Sebelumnya"
            },
        },
        "pageLength": 10,
        "order": [[0, 'asc']],
        "responsive": true
    });
});
</script>
@endpush
