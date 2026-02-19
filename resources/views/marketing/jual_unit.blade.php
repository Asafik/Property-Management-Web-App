@extends('layouts.partial.app')

@section('title', 'Marketing Jual Unit - Property Management App')

@section('content')
    <!-- KONTEN MARKETING JUAL UNIT -->
    <div class="container-fluid px-2 px-md-3 px-lg-4 py-3 py-md-4">
        <!-- Header -->
        <div class="row mb-3 mb-md-4">
            <div class="col-12">
                <h3 class="text-dark fs-2 fs-md-1">Marketing Jual Unit</h3>
                <p class="text-muted small">Kelola unit-unit yang siap dipasarkan ke customer</p>
            </div>
        </div>

        <!-- Info Ringkas - Responsive Cards -->
        <div class="row g-2 g-md-3 mb-4">
            <div class="col-6 col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-primary card-img-holder text-white h-100">
                    <div class="card-body p-3 p-md-4">
                        <img src="{{ asset('admin/assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                            alt="circle-image" />
                        <h4 class="font-weight-normal mb-2 small text-uppercase">
                            Total Unit
                            <i class="mdi mdi-home-group float-end"></i>
                        </h4>
                        <h2 class="mb-1 fs-3 fs-md-1">{{ $totalUnits }}</h2>
                        <h6 class="card-text small">Semua unit</h6>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white h-100">
                    <div class="card-body p-3 p-md-4">
                        <img src="{{ asset('admin/assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                            alt="circle-image" />
                        <h4 class="font-weight-normal mb-2 small text-uppercase">
                            Tersedia
                            <i class="mdi mdi-check-circle float-end"></i>
                        </h4>
                        <h2 class="mb-1 fs-3 fs-md-1">{{ $totalTersedia }}</h2>
                        <h6 class="card-text small">Siap dijual</h6>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-warning card-img-holder text-white h-100">
                    <div class="card-body p-3 p-md-4">
                        <img src="{{ asset('admin/assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                            alt="circle-image" />
                        <h4 class="font-weight-normal mb-2 small text-uppercase">
                            Booking
                            <i class="mdi mdi-clock float-end"></i>
                        </h4>
                        <h2 class="mb-1 fs-3 fs-md-1">{{ $totalBooking }}</h2>
                        <h6 class="card-text small">Dalam proses</h6>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white h-100">
                    <div class="card-body p-3 p-md-4">
                        <img src="{{ asset('admin/assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                            alt="circle-image" />
                        <h4 class="font-weight-normal mb-2 small text-uppercase">
                            Terjual
                            <i class="mdi mdi-cash-check float-end"></i>
                        </h4>
                        <h2 class="mb-1 fs-3 fs-md-1">{{ $totalSold }}</h2>
                        <h6 class="card-text small">Sudah laku</h6>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter dan Search Bar - Responsive -->
        <div class="row mb-4">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body p-3 p-md-4">
                        <div class="row g-2 g-md-3">
                            <div class="col-12 col-md-6 col-lg-2">
                                <div class="form-group mb-0">
                                    <label class="small fw-semibold">Cari Unit</label>
                                    <input type="text" class="form-control form-control-sm" id="customSearch"
                                        placeholder="Cari blok, lokasi...">
                                </div>
                            </div>
                            <div class="col-6 col-md-3 col-lg-2">
                                <div class="form-group mb-0">
                                    <label class="small fw-semibold">Proyek</label>
                                    <select class="form-control form-control-sm" id="filterProyek">
                                        <option value="">Semua Proyek</option>
                                        <option value="Green Lake City">Green Lake City</option>
                                        <option value="Grand Wisata">Grand Wisata</option>
                                        <option value="Citra Garden">Citra Garden</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 col-md-3 col-lg-2">
                                <div class="form-group mb-0">
                                    <label class="small fw-semibold">Status</label>
                                    <select class="form-control form-control-sm" id="filterStatus">
                                        <option value="">Semua Status</option>
                                        <option value="Tersedia">Tersedia</option>
                                        <option value="Booking">Booking</option>
                                        <option value="Terjual">Terjual</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 col-md-3 col-lg-2">
                                <div class="form-group mb-0">
                                    <label class="small fw-semibold">Range Harga</label>
                                    <select class="form-control form-control-sm" id="filterHarga">
                                        <option value="">Semua Harga</option>
                                        <option value="<500">
                                            < Rp 500 Jt</option>
                                        <option value="500-1000">Rp 500 Jt - 1 M</option>
                                        <option value=">1000">> Rp 1 M</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 col-md-3 col-lg-2">
                                <div class="form-group mb-0">
                                    <label class="small fw-semibold">Agent</label>
                                    <select class="form-control form-control-sm" id="filterAgent">
                                        <option value="">Semua Agent</option>
                                        <option value="Robert Fox">Robert Fox</option>
                                        <option value="Jenny Wilson">Jenny Wilson</option>
                                        <option value="Albert Flores">Albert Flores</option>
                                        <option value="-">Tanpa Agent</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 col-lg-2 d-flex align-items-end">
                                <div class="form-group mb-0 w-100">
                                    <button class="btn btn-primary w-100 btn-sm" id="btnFilter">
                                        <i class="mdi mdi-filter me-1"></i>Filter
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Toggle View dan Aksi - Responsive -->
        <div class="row mb-3">
            <div
                class="col-12 d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2">
                <div>
                    <span class="text-muted small" id="infoDisplay">Menampilkan semua unit</span>
                </div>
                <div class="btn-group btn-group-sm" role="group">
                    <button type="button" class="btn btn-outline-primary active" id="btnTableView"
                        onclick="switchView('table')">
                        <i class="mdi mdi-view-list me-1"></i><span class="d-none d-sm-inline">Table</span>
                    </button>
                    <button type="button" class="btn btn-outline-primary" id="btnGridView"
                        onclick="switchView('grid')">
                        <i class="mdi mdi-view-grid me-1"></i><span class="d-none d-sm-inline">Grid</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- TABLE VIEW WITH DATATABLES - Responsive -->
        <div id="tableView" class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div
                        class="card-header bg-white d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center p-3">
                        <h5 class="card-title mb-2 mb-md-0 fs-6 fs-md-5">
                            <i class="mdi mdi-format-list-bulleted me-2 text-primary"></i>
                            Daftar Unit Kavling
                        </h5>
                        <div class="d-flex gap-2">
                            <button class="btn btn-sm btn-success" onclick="exportTable('excel')">
                                <i class="mdi mdi-export me-1"></i><span class="d-none d-sm-inline">Excel</span>
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="exportTable('pdf')">
                                <i class="mdi mdi-file-pdf me-1"></i><span class="d-none d-sm-inline">PDF</span>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-2 p-md-3">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped" id="unitTable" style="width:100%">
                                <thead class="table-light">
                                    <tr>
                                        <th>Blok</th>
                                        <th>Proyek</th>
                                        <th>Lokasi</th>
                                        <th>Luas</th>
                                        <th>Harga</th>
                                        <th>Hadap</th>
                                        <th>Status</th>
                                        <th>Agent</th>
                                        <th>Customer</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($units as $unit)
                                        <tr>
                                            <td><strong>{{ $unit->unit_code }}</strong></td>
                                            <td>{{ $unit->landBank->name ?? '-' }}</td>
                                            <td>{{ $unit->landBank->address ?? '-' }}</td>
                                            <td>{{ $unit->building_area ?? ($unit->area ?? '-') }}</td>
                                            <td>Rp {{ number_format($unit->price ?? 0, 0, ',', '.') }}</td>
                                            <td>{{ $unit->facing ?? '-' }}</td>
                                            <td>
                                                @if ($unit->status == 'ready' || $unit->status == 'tersedia')
                                                    <span class="badge badge-success">Tersedia</span>
                                                @elseif($unit->status == 'sold')
                                                    <span class="badge badge-danger">Terjual</span>
                                                @else
                                                    <span class="badge badge-warning">{{ ucfirst($unit->status) }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $unit->agency->name ?? '-' }}</td>

                                            <td>{{ $unit->customer->full_name ?? '-' }}
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group">

                                                    <button class="btn btn-outline-primary" data-toggle="tooltip"
                                                        title="Detail">
                                                        <i class="mdi mdi-eye"></i>
                                                    </button>

                                                    <button class="btn btn-outline-warning" data-toggle="tooltip"
                                                        title="Edit">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </button>

                                                    <!-- MODAL CUSTOMER -->
                                                    <button onclick="$('#modalCustomer').modal('show')"
                                                        class="btn btn-danger" title="Tambah Customer">
                                                        <i class="mdi mdi-account-plus"></i>
                                                    </button>

                                                    <!-- MODAL AGENCY -->
                                                    <button class="btn btn-info bukaModal"
                                                        data-unit="{{ $unit->id }}" data-toggle="modal"
                                                        data-target="#modalAgency">
                                                        <i class="mdi mdi-office-building"></i>
                                                    </button>



                                                </div>
                                            </td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-center text-muted">Data unit belum tersedia
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="modal fade" id="modalAgency" tabindex="-1">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">

                                        <div class="modal-header bg-info text-white">
                                            <h5 class="modal-title">Pilih Agency</h5>
                                            <button type="button" class="close text-white" data-dismiss="modal">
                                                <span>&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">

                                            <form id="formAgency" method="POST">
                                                @csrf
                                                <input type="hidden" name="employee_id" id="employee_id">
                                                {{-- <button type="submit" class="btn btn-primary">Set Agency</button> --}}
                                            </form>



                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead class="bg-light">
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama Agency</th>
                                                            <th>No HP</th>
                                                            <th>Alamat</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($agencies as $a)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $a->name }}</td>
                                                                <td>{{ $a->phone }}</td>
                                                                <td>{{ $a->address }}</td>
                                                                <td>
                                                                    <button type="button"
                                                                        class="btn btn-success pilihAgency"
                                                                        data-id="{{ $a->id }}">
                                                                        Pilih
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- GRID VIEW (Katalog) - Responsive -->
        <div id="gridView" class="row g-3" style="display: none;">
            <!-- Unit 1 -->
            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="card h-100">
                    <div class="card-body p-3">
                        <div class="position-relative">
                            <span class="badge badge-success position-absolute top-0 end-0 m-2">Tersedia</span>
                            <div class="text-center bg-light py-3 py-md-4 rounded">
                                <i class="mdi mdi-home-outline" style="font-size: 36px;"></i>
                            </div>
                        </div>
                        <h5 class="mt-2 fs-6">A.1 - Green Lake City</h5>
                        <p class="text-muted small mb-1">
                            <i class="mdi mdi-map-marker me-1"></i>Jakarta Selatan
                        </p>
                        <p class="small mb-1">
                            <i class="mdi mdi-arrow-expand me-1"></i>200 m² | Hadap Utara
                        </p>
                        <h5 class="text-primary mt-2">Rp 500 Jt</h5>

                        <!-- Info Agent -->
                        <div class="d-flex align-items-center mt-2 p-2 bg-light rounded small">
                            <i class="mdi mdi-account-tie text-primary me-2"></i>
                            <span class="text-muted">Agent: -</span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <small class="text-muted">Status: Tersedia</small>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary" onclick="alert('Detail unit')">
                                    <i class="mdi mdi-eye"></i>
                                </button>
                                <button class="btn btn-outline-success" onclick="alert('Booking unit')">
                                    <i class="mdi mdi-cart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Tambahkan unit grid lainnya dengan pola yang sama -->
        </div>

        <!-- Tombol Aksi Bawah - Responsive -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-3">
                        <div
                            class="d-flex flex-column flex-sm-row justify-content-between align-items-stretch align-items-sm-center gap-2">
                            <div>
                                <a href="{{ route('properti-all') }}" class="btn btn-light w-100 w-sm-auto">
                                    <i class="mdi mdi-arrow-left me-1"></i>Kembali ke Kavling
                                </a>
                            </div>
                            <div>
                                <button class="btn btn-primary w-100 w-sm-auto"
                                    onclick="alert('Publikasi unit ke website customer')">
                                    <i class="mdi mdi-web me-1"></i>Publikasi ke Website
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Progress Steps - Responsive -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-3">
                        <!-- Progress Steps Horizontal - Hidden on mobile, show on desktop -->
                        <div class="d-none d-md-flex justify-content-between">
                            <span class="text-success small"><i class="mdi mdi-check-circle me-1"></i>Input Tanah</span>
                            <span class="text-success small"><i class="mdi mdi-check-circle me-1"></i>Verifikasi
                                Legal</span>
                            <span class="text-success small"><i class="mdi mdi-check-circle me-1"></i>Buat Kavling</span>
                            <span class="text-primary small"><i class="mdi mdi-progress-clock me-1"></i>Marketing Jual
                                Unit</span>
                            <span class="text-muted small"><i class="mdi mdi-circle-outline me-1"></i>Customer
                                Booking</span>
                        </div>

                        <!-- Progress Steps Vertical - Show on mobile -->
                        <div class="d-md-none">
                            <div class="d-flex flex-column gap-2">
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-success rounded-circle p-2 me-2">✓</span>
                                    <span class="small">Input Tanah</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-success rounded-circle p-2 me-2">✓</span>
                                    <span class="small">Verifikasi Legal</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-success rounded-circle p-2 me-2">✓</span>
                                    <span class="small">Buat Kavling</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-primary rounded-circle p-2 me-2">⟳</span>
                                    <span class="small fw-bold">Marketing Jual Unit</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-secondary rounded-circle p-2 me-2">○</span>
                                    <span class="small">Customer Booking</span>
                                </div>
                            </div>
                        </div>

                        <div class="progress mt-3 d-none d-md-block" style="height: 6px;">
                            <div class="progress-bar bg-success" style="width: 60%"></div>
                            <div class="progress-bar bg-primary" style="width: 15%"></div>
                        </div>
                        <p class="text-muted small mt-2 text-center text-md-start">
                            Tahap 4 dari 5: Marketing Jual Unit
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalCustomer" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Data Customer</h5>
                    <button type="button" class="close text-white" style="background: transparent;"
                        onclick="$('#modalCustomer').modal('hide')">
                        <span>&times;</span>
                    </button>

                </div>

                <div class="modal-body">

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="tableCustomer">
                            <thead class="bg-light">
                                <tr>
                                    <th>No</th>
                                    <th>ID Customer</th>
                                    <th>Nama</th>
                                    <th>No HP</th>
                                    <th>Pekerjaan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $c)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $c->customer_id ?? 'Masih Kosong' }}</td>
                                        <td>{{ $c->full_name ?? 'Masih Kosong' }}</td>
                                        <td>{{ $c->phone ?? 'Masih Kosong' }}</td>
                                        <td>{{ $c->job_status ?? 'Masih Kosong' }}</td>
                                        <td>

                                            @foreach ($units as $unit)
                                                <form method="POST" action="{{ route('set.customer', $unit->id) }}">
                                                    @csrf
                                                    <input type="hidden" name="customer_id"
                                                        value="{{ $c->id }}">
                                                    <button type="submit" class="btn btn-success btn-sm">
                                                        Pilih
                                                    </button>
                                                </form>
                                            @endforeach



                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                </div>


            </div>
        </div>
    </div>

    <!-- END MODAL AGENCY -->
    <!-- AKHIR KONTEN MARKETING JUAL UNIT -->
@endsection

@push('styles')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <style>
        /* Custom responsive styles */
        @media (max-width: 576px) {
            .card-body {
                padding: 0.75rem !important;
            }

            .btn-group {
                width: 100%;
            }

            .btn-group .btn {
                flex: 1;
            }

            .table td,
            .table th {
                font-size: 0.75rem;
                padding: 0.5rem 0.25rem;
                white-space: nowrap;
            }

            .badge {
                font-size: 0.65rem;
                padding: 0.25rem 0.35rem;
            }
        }

        @media (min-width: 577px) and (max-width: 768px) {

            .table td,
            .table th {
                font-size: 0.85rem;
                padding: 0.5rem;
            }
        }

        /* Card hover effect */
        .card {
            transition: transform 0.2s;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Responsive font sizes */
        .fs-1 {
            font-size: 2rem !important;
        }

        .fs-2 {
            font-size: 1.75rem !important;
        }

        .fs-3 {
            font-size: 1.5rem !important;
        }

        .fs-4 {
            font-size: 1.25rem !important;
        }

        .fs-5 {
            font-size: 1rem !important;
        }

        .fs-6 {
            font-size: 0.875rem !important;
        }

        @media (min-width: 768px) {
            .fs-md-1 {
                font-size: 2rem !important;
            }

            .fs-md-2 {
                font-size: 1.75rem !important;
            }

            .fs-md-3 {
                font-size: 1.5rem !important;
            }

            .fs-md-4 {
                font-size: 1.25rem !important;
            }

            .fs-md-5 {
                font-size: 1rem !important;
            }

            .fs-md-6 {
                font-size: 0.875rem !important;
            }
        }

        /* Fix for DataTables on mobile */
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            margin: 0.5rem 0;
            text-align: left !important;
        }

        @media (min-width: 768px) {

            .dataTables_wrapper .dataTables_length,
            .dataTables_wrapper .dataTables_filter,
            .dataTables_wrapper .dataTables_info,
            .dataTables_wrapper .dataTables_paginate {
                text-align: right !important;
            }
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('admin/assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Inisialisasi DataTables dengan konfigurasi responsif
            var table = $('#unitTable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal({
                            header: function(row) {
                                var data = row.data();
                                return 'Detail Unit ' + data[0];
                            }
                        }),
                        renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                            tableClass: 'table table-sm border'
                        })
                    }
                },
                "pageLength": 10,
                "lengthMenu": [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "All"]
                ],
                "language": {
                    "search": "Cari:",
                    "lengthMenu": "Tampilkan _MENU_ data",
                    "zeroRecords": "Data tidak ditemukan",
                    "info": "Menampilkan _START_ - _END_ dari _TOTAL_",
                    "infoEmpty": "Tidak ada data",
                    "infoFiltered": "(difilter dari _MAX_ total data)",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    }
                },
                "columnDefs": [{
                    "orderable": false,
                    "targets": 9
                }],
                "drawCallback": function() {
                    // Reinitialize tooltips after draw
                    $('[data-toggle="tooltip"]').tooltip();
                    updateInfoDisplay();
                }
            });

            // Tooltips
            $('[data-toggle="tooltip"]').tooltip();

            // Filter events
            $('#customSearch').on('keyup', function() {
                table.search(this.value).draw();
            });

            $('#filterProyek').on('change', function() {
                table.column(1).search(this.value).draw();
            });

            $('#filterStatus').on('change', function() {
                table.column(6).search(this.value).draw();
            });

            $('#filterAgent').on('change', function() {
                table.column(7).search(this.value).draw();
            });

            // Custom filter untuk harga
            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    var filterHarga = $('#filterHarga').val();
                    if (!filterHarga) return true;

                    var harga = data[4].replace(/[^0-9]/g, '');
                    harga = parseInt(harga) / 1000000;

                    if (filterHarga === '<500' && harga < 500) return true;
                    if (filterHarga === '500-1000' && harga >= 500 && harga <= 1000) return true;
                    if (filterHarga === '>1000' && harga > 1000) return true;

                    return false;
                }
            );

            $('#filterHarga').on('change', function() {
                table.draw();
            });

            $('#btnFilter').on('click', function() {
                table.draw();
            });

            // Update info display
            function updateInfoDisplay() {
                var info = table.page.info();
                $('#infoDisplay').text('Menampilkan ' + info.recordsDisplay + ' dari ' + info.recordsTotal +
                    ' unit');
            }

            // Handle window resize untuk DataTables
            $(window).on('resize', function() {
                table.columns.adjust().responsive.recalc();
            });
        });

        function switchView(view) {
            if (view === 'table') {
                $('#tableView').show();
                $('#gridView').hide();
                $('#btnTableView').addClass('active');
                $('#btnGridView').removeClass('active');
            } else {
                $('#tableView').hide();
                $('#gridView').show();
                $('#btnGridView').addClass('active');
                $('#btnTableView').removeClass('active');
            }
        }

        function exportTable(type) {
            const msg = type === 'excel' ? 'Excel' : 'PDF';
            Swal.fire({
                icon: 'info',
                title: 'Export ' + msg,
                text: 'Fitur export sedang dalam pengembangan',
                timer: 2000,
                showConfirmButton: false
            });
        }

        // Format Rupiah
        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(angka);
        }
    </script>
    <script>
        let selectedUnitId = null;

        function openCustomerModal(unitId) {
            selectedUnitId = unitId;
            $('#modalCustomer').modal('show');
        }

        $(document).on('click', '.pilihCustomer', function() {

            let customerId = $(this).data('id');

            if (!selectedUnitId) {
                alert('Unit belum dipilih!');
                return;
            }

            let actionUrl = "{{ route('set.customer', ['unitId' => 'UNIT_ID']) }}";
            actionUrl = actionUrl.replace('UNIT_ID', selectedUnitId);

            let form = $('<form>', {
                method: 'POST',
                action: actionUrl
            });

            form.append($('<input>', {
                type: 'hidden',
                name: '_token',
                value: '{{ csrf_token() }}'
            }));

            form.append($('<input>', {
                type: 'hidden',
                name: 'customer_id',
                value: customerId
            }));

            $('body').append(form);
            form.submit();
        });
    </script>




    {{-- <script>
        let currentUnit = null;

        $(document).on('click', '.bukaModal', function() {
            currentUnit = $(this).data('unit');

            let url = "{{ url('marketing/setAgency') }}/" + currentUnit;
            $('#formAgency').attr('action', url);
        });

        $(document).on('click', '.pilihAgency', function() {

            let id = $(this).data('id');
            $('#employee_id').val(id);

            $('#formAgency').submit();
        });
    </script> --}}
    <script>
        let selectedUnit = null;

        // buka modal agency
        $(document).on('click', '.bukaModal', function() {

            let unitId = $(this).data('unit');

            let url = "{{ url('marketing/set-agency') }}/" + unitId;
            $('#formAgency').attr('action', url);

            $('#modalAgency').modal('show');
        });



        // pilih agency (employee)
        $(document).on('click', '.pilihAgency', function() {

            let employeeId = $(this).data('id');

            // isi hidden employee_id
            $('#employee_id').val(employeeId);

            // submit ke controller
            $('#formAgency').submit();
        });
    </script>





    <!-- Optional: SweetAlert2 untuk notifikasi yang lebih baik -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
