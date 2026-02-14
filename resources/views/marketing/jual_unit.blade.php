@extends('layouts.partial.app')

@section('title', 'Marketing Jual Unit - Property Management App')

@section('content')
<!-- KONTEN MARKETING JUAL UNIT -->
<div class="container-fluid p-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="text-dark">Marketing Jual Unit</h3>
            <p class="text-muted">Kelola unit-unit yang siap dipasarkan ke customer</p>
        </div>
    </div>

    <!-- Info Ringkas -->
    <div class="row">
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-primary card-img-holder text-white">
                <div class="card-body">
                    <img src="{{ asset('admin/assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Total Unit <i class="mdi mdi-home-group mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-3">156</h2>
                    <h6 class="card-text">Semua unit</h6>
                </div>
            </div>
        </div>
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-success card-img-holder text-white">
                <div class="card-body">
                    <img src="{{ asset('admin/assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Tersedia <i class="mdi mdi-check-circle mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-3">89</h2>
                    <h6 class="card-text">Siap dijual</h6>
                </div>
            </div>
        </div>
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-warning card-img-holder text-white">
                <div class="card-body">
                    <img src="{{ asset('admin/assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Booking <i class="mdi mdi-clock mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-3">23</h2>
                    <h6 class="card-text">Dalam proses</h6>
                </div>
            </div>
        </div>
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-danger card-img-holder text-white">
                <div class="card-body">
                    <img src="{{ asset('admin/assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Terjual <i class="mdi mdi-cash-check mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-3">44</h2>
                    <h6 class="card-text">Sudah laku</h6>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter dan Search Bar -->
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-2">
                            <div class="form-group mb-0">
                                <label class="small">Cari Unit</label>
                                <input type="text" class="form-control" placeholder="Cari blok, lokasi...">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group mb-0">
                                <label class="small">Proyek</label>
                                <select class="form-control">
                                    <option>Semua Proyek</option>
                                    <option>Green Lake City</option>
                                    <option>Grand Wisata</option>
                                    <option>Citra Garden</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group mb-0">
                                <label class="small">Status</label>
                                <select class="form-control">
                                    <option>Semua Status</option>
                                    <option>Tersedia</option>
                                    <option>Booking</option>
                                    <option>Terjual</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group mb-0">
                                <label class="small">Range Harga</label>
                                <select class="form-control">
                                    <option>Semua Harga</option>
                                    <option>< Rp 500 Jt</option>
                                    <option>Rp 500 Jt - 1 M</option>
                                    <option>> Rp 1 M</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group mb-0">
                                <label class="small">Agent</label>
                                <select class="form-control">
                                    <option>Semua Agent</option>
                                    <option>Robert Fox</option>
                                    <option>Jenny Wilson</option>
                                    <option>Albert Flores</option>
                                    <option>Tanpa Agent</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <div class="form-group mb-0 w-100">
                                <button class="btn btn-primary w-100">
                                    <i class="mdi mdi-filter me-1"></i>Filter
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toggle View dan Aksi -->
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <span class="text-muted">Menampilkan 12 dari 156 unit</span>
            </div>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-outline-primary active" id="btnTableView" onclick="switchView('table')">
                    <i class="mdi mdi-view-list me-1"></i>Table
                </button>
                <button type="button" class="btn btn-outline-primary" id="btnGridView" onclick="switchView('grid')">
                    <i class="mdi mdi-view-grid me-1"></i>Grid
                </button>
            </div>
        </div>
    </div>

    <!-- TABLE VIEW -->
    <div id="tableView" class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-format-list-bulleted me-2 text-primary"></i>
                        Daftar Unit Kavling
                    </h5>
                    <button class="btn btn-sm btn-success" onclick="alert('Export ke Excel')">
                        <i class="mdi mdi-export me-1"></i>Export
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Blok</th>
                                    <th>Proyek</th>
                                    <th>Luas (m²)</th>
                                    <th>Harga</th>
                                    <th>Hadap</th>
                                    <th>Status</th>
                                    <th>Agent</th>
                                    <th>Customer</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>A.1</strong></td>
                                    <td>Green Lake City</td>
                                    <td>200</td>
                                    <td>Rp 500.000.000</td>
                                    <td>Utara</td>
                                    <td><span class="badge badge-success">Tersedia</span></td>
                                    <td>
                                        <span class="text-muted">-</span>
                                    </td>
                                    <td>
                                        <span class="text-muted">-</span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary me-1" onclick="alert('Detail unit A.1')">
                                            <i class="mdi mdi-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning me-1" onclick="alert('Edit unit A.1')">
                                            <i class="mdi mdi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-info" onclick="alert('Assign ke agent')">
                                            <i class="mdi mdi-account-plus"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>A.2</strong></td>
                                    <td>Green Lake City</td>
                                    <td>200</td>
                                    <td>Rp 485.000.000</td>
                                    <td>Timur</td>
                                    <td><span class="badge badge-success">Tersedia</span></td>
                                    <td>
                                        <img src="{{ asset('admin/assets/images/faces/face1.jpg') }}" class="me-2 rounded" width="25" alt="image">
                                        Robert Fox
                                    </td>
                                    <td>
                                        <span class="text-muted">-</span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary me-1" onclick="alert('Detail unit A.2')">
                                            <i class="mdi mdi-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning me-1" onclick="alert('Edit unit A.2')">
                                            <i class="mdi mdi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-info" onclick="alert('Assign ke agent')">
                                            <i class="mdi mdi-account-plus"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>B.5</strong></td>
                                    <td>Grand Wisata</td>
                                    <td>150</td>
                                    <td>Rp 375.000.000</td>
                                    <td>Selatan</td>
                                    <td><span class="badge badge-warning">Booking</span></td>
                                    <td>
                                        <img src="{{ asset('admin/assets/images/faces/face2.jpg') }}" class="me-2 rounded" width="25" alt="image">
                                        Jenny Wilson
                                    </td>
                                    <td>
                                        <img src="{{ asset('admin/assets/images/faces/face5.jpg') }}" class="me-2 rounded" width="25" alt="image">
                                        John Doe
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary me-1" onclick="alert('Detail unit B.5')">
                                            <i class="mdi mdi-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning me-1" onclick="alert('Edit unit B.5')">
                                            <i class="mdi mdi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-info" onclick="alert('Assign ke agent')">
                                            <i class="mdi mdi-account-plus"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>C.2</strong></td>
                                    <td>Citra Garden</td>
                                    <td>250</td>
                                    <td>Rp 750.000.000</td>
                                    <td>Barat</td>
                                    <td><span class="badge badge-danger">Terjual</span></td>
                                    <td>
                                        <img src="{{ asset('admin/assets/images/faces/face3.jpg') }}" class="me-2 rounded" width="25" alt="image">
                                        Albert Flores
                                    </td>
                                    <td>
                                        <img src="{{ asset('admin/assets/images/faces/face6.jpg') }}" class="me-2 rounded" width="25" alt="image">
                                        Sarah Smith
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary me-1" onclick="alert('Detail unit C.2')">
                                            <i class="mdi mdi-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning me-1" onclick="alert('Edit unit C.2')">
                                            <i class="mdi mdi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-secondary" disabled>
                                            <i class="mdi mdi-account-plus"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>D.3</strong></td>
                                    <td>Green Lake City</td>
                                    <td>180</td>
                                    <td>Rp 425.000.000</td>
                                    <td>Timur</td>
                                    <td><span class="badge badge-warning">Booking</span></td>
                                    <td>
                                        <img src="{{ asset('admin/assets/images/faces/face4.jpg') }}" class="me-2 rounded" width="25" alt="image">
                                        Michael Chen
                                    </td>
                                    <td>
                                        <img src="{{ asset('admin/assets/images/faces/face7.jpg') }}" class="me-2 rounded" width="25" alt="image">
                                        Linda Wijaya
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary me-1" onclick="alert('Detail unit D.3')">
                                            <i class="mdi mdi-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning me-1" onclick="alert('Edit unit D.3')">
                                            <i class="mdi mdi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-info" onclick="alert('Assign ke agent')">
                                            <i class="mdi mdi-account-plus"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination -->
                    <nav class="mt-4">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- GRID VIEW (Katalog) -->
    <div id="gridView" class="row" style="display: none;">
        <!-- Unit 1 - Tersedia tanpa agent -->
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="position-relative">
                        <span class="badge badge-success position-absolute" style="top: 10px; right: 10px;">Tersedia</span>
                        <div class="text-center bg-light py-4 rounded">
                            <i class="mdi mdi-home-outline" style="font-size: 48px;"></i>
                        </div>
                    </div>
                    <h5 class="mt-3">A.1 - Green Lake City</h5>
                    <p class="text-muted mb-1"><i class="mdi mdi-map-marker me-1"></i>Jakarta Selatan</p>
                    <p class="mb-1"><i class="mdi mdi-arrow-expand me-1"></i>200 m² | Hadap Utara</p>
                    <h4 class="text-primary mt-2">Rp 500.000.000</h4>

                    <!-- Info Agent -->
                    <div class="d-flex align-items-center mt-2 p-2 bg-light rounded">
                        <i class="mdi mdi-account-tie text-primary me-2"></i>
                        <span class="text-muted">Agent: </span>
                        <span class="ms-1">-</span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <small class="text-muted">Status: Tersedia</small>
                        <div>
                            <button class="btn btn-sm btn-outline-primary me-1" onclick="alert('Detail unit A.1')">
                                <i class="mdi mdi-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-success" onclick="alert('Booking unit A.1')">
                                <i class="mdi mdi-cart"></i> Booking
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Unit 2 - Tersedia dengan agent -->
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="position-relative">
                        <span class="badge badge-success position-absolute" style="top: 10px; right: 10px;">Tersedia</span>
                        <div class="text-center bg-light py-4 rounded">
                            <i class="mdi mdi-home-outline" style="font-size: 48px;"></i>
                        </div>
                    </div>
                    <h5 class="mt-3">A.2 - Green Lake City</h5>
                    <p class="text-muted mb-1"><i class="mdi mdi-map-marker me-1"></i>Jakarta Selatan</p>
                    <p class="mb-1"><i class="mdi mdi-arrow-expand me-1"></i>200 m² | Hadap Timur</p>
                    <h4 class="text-primary mt-2">Rp 485.000.000</h4>

                    <!-- Info Agent -->
                    <div class="d-flex align-items-center mt-2 p-2 bg-light rounded">
                        <img src="{{ asset('admin/assets/images/faces/face1.jpg') }}" class="me-2 rounded" width="25" alt="image">
                        <span class="text-muted">Agent: </span>
                        <span class="fw-bold ms-1">Robert Fox</span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <small class="text-muted">Status: Tersedia</small>
                        <div>
                            <button class="btn btn-sm btn-outline-primary me-1" onclick="alert('Detail unit A.2')">
                                <i class="mdi mdi-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-success" onclick="alert('Booking unit A.2')">
                                <i class="mdi mdi-cart"></i> Booking
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Unit 3 - Booking dengan agent dan customer -->
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="position-relative">
                        <span class="badge badge-warning position-absolute" style="top: 10px; right: 10px;">Booking</span>
                        <div class="text-center bg-light py-4 rounded">
                            <i class="mdi mdi-home-outline" style="font-size: 48px;"></i>
                        </div>
                    </div>
                    <h5 class="mt-3">B.5 - Grand Wisata</h5>
                    <p class="text-muted mb-1"><i class="mdi mdi-map-marker me-1"></i>Bekasi</p>
                    <p class="mb-1"><i class="mdi mdi-arrow-expand me-1"></i>150 m² | Hadap Selatan</p>
                    <h4 class="text-primary mt-2">Rp 375.000.000</h4>

                    <!-- Info Agent -->
                    <div class="d-flex align-items-center mt-2 p-2 bg-light rounded">
                        <img src="{{ asset('admin/assets/images/faces/face2.jpg') }}" class="me-2 rounded" width="25" alt="image">
                        <span class="text-muted">Agent: </span>
                        <span class="fw-bold ms-1">Jenny Wilson</span>
                    </div>

                    <!-- Info Customer -->
                    <div class="d-flex align-items-center mt-2 p-2 bg-light rounded">
                        <img src="{{ asset('admin/assets/images/faces/face5.jpg') }}" class="me-2 rounded" width="25" alt="image">
                        <span class="text-muted">Customer: </span>
                        <span class="fw-bold ms-1">John Doe</span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <small class="text-muted">Booking: 14 Feb 2026</small>
                        <div>
                            <button class="btn btn-sm btn-outline-primary me-1" onclick="alert('Detail unit B.5')">
                                <i class="mdi mdi-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-secondary" disabled>
                                <i class="mdi mdi-cart"></i> Booking
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Unit 4 - Terjual dengan agent dan customer -->
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="position-relative">
                        <span class="badge badge-danger position-absolute" style="top: 10px; right: 10px;">Terjual</span>
                        <div class="text-center bg-light py-4 rounded">
                            <i class="mdi mdi-home-outline" style="font-size: 48px;"></i>
                        </div>
                    </div>
                    <h5 class="mt-3">C.2 - Citra Garden</h5>
                    <p class="text-muted mb-1"><i class="mdi mdi-map-marker me-1"></i>Tangerang</p>
                    <p class="mb-1"><i class="mdi mdi-arrow-expand me-1"></i>250 m² | Hadap Barat</p>
                    <h4 class="text-primary mt-2">Rp 750.000.000</h4>

                    <!-- Info Agent -->
                    <div class="d-flex align-items-center mt-2 p-2 bg-light rounded">
                        <img src="{{ asset('admin/assets/images/faces/face3.jpg') }}" class="me-2 rounded" width="25" alt="image">
                        <span class="text-muted">Agent: </span>
                        <span class="fw-bold ms-1">Albert Flores</span>
                    </div>

                    <!-- Info Customer -->
                    <div class="d-flex align-items-center mt-2 p-2 bg-light rounded">
                        <img src="{{ asset('admin/assets/images/faces/face6.jpg') }}" class="me-2 rounded" width="25" alt="image">
                        <span class="text-muted">Customer: </span>
                        <span class="fw-bold ms-1">Sarah Smith</span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <small class="text-muted">Terjual: 10 Feb 2026</small>
                        <div>
                            <button class="btn btn-sm btn-outline-primary me-1" onclick="alert('Detail unit C.2')">
                                <i class="mdi mdi-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-secondary" disabled>
                                <i class="mdi mdi-cart"></i> Booking
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Unit 5 - Tersedia dengan agent -->
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="position-relative">
                        <span class="badge badge-success position-absolute" style="top: 10px; right: 10px;">Tersedia</span>
                        <div class="text-center bg-light py-4 rounded">
                            <i class="mdi mdi-home-outline" style="font-size: 48px;"></i>
                        </div>
                    </div>
                    <h5 class="mt-3">A.5 - Green Lake City</h5>
                    <p class="text-muted mb-1"><i class="mdi mdi-map-marker me-1"></i>Jakarta Selatan</p>
                    <p class="mb-1"><i class="mdi mdi-arrow-expand me-1"></i>200 m² | Hadap Utara</p>
                    <h4 class="text-primary mt-2">Rp 520.000.000</h4>

                    <!-- Info Agent -->
                    <div class="d-flex align-items-center mt-2 p-2 bg-light rounded">
                        <img src="{{ asset('admin/assets/images/faces/face4.jpg') }}" class="me-2 rounded" width="25" alt="image">
                        <span class="text-muted">Agent: </span>
                        <span class="fw-bold ms-1">Michael Chen</span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <small class="text-muted">Status: Tersedia</small>
                        <div>
                            <button class="btn btn-sm btn-outline-primary me-1" onclick="alert('Detail unit A.5')">
                                <i class="mdi mdi-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-success" onclick="alert('Booking unit A.5')">
                                <i class="mdi mdi-cart"></i> Booking
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Unit 6 - Booking dengan agent dan customer -->
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="position-relative">
                        <span class="badge badge-warning position-absolute" style="top: 10px; right: 10px;">Booking</span>
                        <div class="text-center bg-light py-4 rounded">
                            <i class="mdi mdi-home-outline" style="font-size: 48px;"></i>
                        </div>
                    </div>
                    <h5 class="mt-3">D.3 - Green Lake City</h5>
                    <p class="text-muted mb-1"><i class="mdi mdi-map-marker me-1"></i>Jakarta Selatan</p>
                    <p class="mb-1"><i class="mdi mdi-arrow-expand me-1"></i>180 m² | Hadap Timur</p>
                    <h4 class="text-primary mt-2">Rp 425.000.000</h4>

                    <!-- Info Agent -->
                    <div class="d-flex align-items-center mt-2 p-2 bg-light rounded">
                        <img src="{{ asset('admin/assets/images/faces/face8.jpg') }}" class="me-2 rounded" width="25" alt="image">
                        <span class="text-muted">Agent: </span>
                        <span class="fw-bold ms-1">David Lee</span>
                    </div>

                    <!-- Info Customer -->
                    <div class="d-flex align-items-center mt-2 p-2 bg-light rounded">
                        <img src="{{ asset('admin/assets/images/faces/face7.jpg') }}" class="me-2 rounded" width="25" alt="image">
                        <span class="text-muted">Customer: </span>
                        <span class="fw-bold ms-1">Linda Wijaya</span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <small class="text-muted">Booking: 13 Feb 2026</small>
                        <div>
                            <button class="btn btn-sm btn-outline-primary me-1" onclick="alert('Detail unit D.3')">
                                <i class="mdi mdi-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-secondary" disabled>
                                <i class="mdi mdi-cart"></i> Booking
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination untuk Grid View -->
        <div class="col-12">
            <nav class="mt-2">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>

    <!-- Tombol Aksi Bawah -->
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <a href="{{ url('/properti/buat-kavling') }}" class="btn btn-light me-2">
                            <i class="mdi mdi-arrow-left me-1"></i>Kembali ke Kavling
                        </a>
                    </div>
                    <div>
                        <button class="btn btn-primary" onclick="alert('Publikasi unit ke website customer')">
                            <i class="mdi mdi-web me-1"></i>Publikasi ke Website
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Progress Steps -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <span class="text-success"><i class="mdi mdi-check-circle me-1"></i>Input Tanah</span>
                        <span class="text-success"><i class="mdi mdi-check-circle me-1"></i>Verifikasi Legal</span>
                        <span class="text-success"><i class="mdi mdi-check-circle me-1"></i>Buat Kavling</span>
                        <span class="text-primary"><i class="mdi mdi-progress-clock me-1"></i>Marketing Jual Unit</span>
                        <span class="text-muted"><i class="mdi mdi-circle-outline me-1"></i>Customer Booking</span>
                    </div>
                    <div class="progress mt-2" style="height: 6px;">
                        <div class="progress-bar bg-success" style="width: 60%"></div>
                        <div class="progress-bar bg-primary" style="width: 15%"></div>
                    </div>
                    <p class="text-muted small mt-2">Tahap 4 dari 5: Marketing Jual Unit</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- AKHIR KONTEN MARKETING JUAL UNIT -->
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Default view adalah table
    // Grid view hidden

    // Tooltips
    $('[data-toggle="tooltip"]').tooltip();
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

// Format Rupiah untuk input harga
function formatRupiah(angka) {
    return new Intl.NumberFormat('id-ID').format(angka);
}
</script>
@endpush
