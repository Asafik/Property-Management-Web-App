@extends('layouts.partial.app')

@section('title', 'RAB Pembangunan - Property Management App')

@section('content')
<div class="container-fluid p-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="text-dark">Rencana Anggaran Biaya (RAB) Pembangunan</h3>
            <p class="text-muted">Rincian biaya pembangunan unit dari awal hingga selesai</p>
        </div>
    </div>

    <!-- Info Unit -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-light">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <small class="text-muted d-block">Unit</small>
                            <select class="form-control form-control-sm">
                                <option>A.1</option>
                                <option>A.2</option>
                                <option>B.1</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <small class="text-muted d-block">Tipe / Nama</small>
                            <input type="text" class="form-control form-control-sm" value="The Lavender - Tipe 45">
                        </div>
                        <div class="col-md-2">
                            <small class="text-muted d-block">Luas Tanah</small>
                            <input type="text" class="form-control form-control-sm" value="200 m²">
                        </div>
                        <div class="col-md-2">
                            <small class="text-muted d-block">Luas Bangunan</small>
                            <input type="text" class="form-control form-control-sm" value="45 m²">
                        </div>
                        <div class="col-md-3">
                            <small class="text-muted d-block">Harga Jual Unit</small>
                            <input type="text" class="form-control form-control-sm" value="Rp 500.000.000">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== I. PEKERJAAN PERSIAPAN ===== -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">I. PEKERJAAN PERSIAPAN</h5>
                    <button class="btn btn-sm btn-light" onclick="tambahItem('persiapan')">
                        <i class="mdi mdi-plus me-1"></i>Tambah Item
                    </button>
                </div>
                <div class="card-body p-0">
                    <table class="table table-bordered mb-0" id="table-persiapan">
                        <thead class="bg-light">
                            <tr>
                                <th style="width: 5%">No</th>
                                <th style="width: 30%">Uraian Pekerjaan</th>
                                <th style="width: 8%">Volume</th>
                                <th style="width: 8%">Satuan</th>
                                <th style="width: 12%">Harga Satuan (Rp)</th>
                                <th style="width: 12%">Total (Rp)</th>
                                <th style="width: 15%">Keterangan</th>
                                <th style="width: 10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1.1</td>
                                <td><input type="text" class="form-control form-control-sm" value="Pembersihan Lahan"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="1"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option selected>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="2000000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="2000000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Manual"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>1.2</td>
                                <td><input type="text" class="form-control form-control-sm" value="Pemasangan Pagar Pengaman"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="50"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option selected>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="150000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="7500000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Seng"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>1.3</td>
                                <td><input type="text" class="form-control form-control-sm" value="Pembuatan Direksi Keet"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="1"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option selected>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="3500000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="3500000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="3x4 m"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>1.4</td>
                                <td><input type="text" class="form-control form-control-sm" value="Pemasangan Listrik Sementara"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="1"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option selected>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="1500000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="1500000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="PLN"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>1.5</td>
                                <td><input type="text" class="form-control form-control-sm" value="Pemasangan Air Sementara"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="1"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option selected>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="1000000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="1000000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="PDAM"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot class="bg-light">
                            <tr>
                                <th colspan="5" class="text-end">SUB TOTAL I</th>
                                <th><input type="text" class="form-control form-control-sm" id="subtotal-persiapan" value="15500000" readonly></th>
                                <th colspan="2"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== II. PEKERJAAN PONDASI ===== -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">II. PEKERJAAN PONDASI</h5>
                    <button class="btn btn-sm btn-light" onclick="tambahItem('pondasi')">
                        <i class="mdi mdi-plus me-1"></i>Tambah Item
                    </button>
                </div>
                <div class="card-body p-0">
                    <table class="table table-bordered mb-0" id="table-pondasi">
                        <thead class="bg-light">
                            <tr>
                                <th style="width: 5%">No</th>
                                <th style="width: 30%">Uraian Pekerjaan</th>
                                <th style="width: 8%">Volume</th>
                                <th style="width: 8%">Satuan</th>
                                <th style="width: 12%">Harga Satuan (Rp)</th>
                                <th style="width: 12%">Total (Rp)</th>
                                <th style="width: 15%">Keterangan</th>
                                <th style="width: 10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2.1</td>
                                <td><input type="text" class="form-control form-control-sm" value="Galian Tanah Pondasi"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="30"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option selected>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="80000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="2400000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Kedalaman 1,5m"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>2.2</td>
                                <td><input type="text" class="form-control form-control-sm" value="Pasir Urug"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="8"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option selected>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="250000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="2000000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Tebal 10cm"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>2.3</td>
                                <td><input type="text" class="form-control form-control-sm" value="Batu Kali / Batu Belah"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="25"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option selected>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="350000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="8750000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Ukuran 15/20"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>2.4</td>
                                <td><input type="text" class="form-control form-control-sm" value="Semen PC (50kg)"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="150"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option selected>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="75000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="11250000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="@50kg"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>2.5</td>
                                <td><input type="text" class="form-control form-control-sm" value="Pasir Pasang"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="10"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option selected>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="300000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="3000000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Adukan"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>2.6</td>
                                <td><input type="text" class="form-control form-control-sm" value="Besi Beton Ø12mm"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="150"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option selected>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="120000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="18000000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Sloof"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>2.7</td>
                                <td><input type="text" class="form-control form-control-sm" value="Besi Beton Ø8mm"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="80"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option selected>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="55000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="4400000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Begel"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>2.8</td>
                                <td><input type="text" class="form-control form-control-sm" value="Kawat Beton"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="30"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option selected>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="25000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="750000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Bendrat"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>2.9</td>
                                <td><input type="text" class="form-control form-control-sm" value="Bekisting Kayu"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="40"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option selected>lembar</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="180000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="7200000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Multiplek 9mm"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>2.10</td>
                                <td><input type="text" class="form-control form-control-sm" value="Paku"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="15"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option selected>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="20000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="300000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="2''-4''"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>2.11</td>
                                <td><input type="text" class="form-control form-control-sm" value="Upah Pekerja"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="12"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option selected>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="350000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="4200000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="4 orang"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>2.12</td>
                                <td><input type="text" class="form-control form-control-sm" value="Upah Tukang"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="12"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option selected>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="450000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="5400000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="2 tukang"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot class="bg-light">
                            <tr>
                                <th colspan="5" class="text-end">SUB TOTAL II</th>
                                <th><input type="text" class="form-control form-control-sm" id="subtotal-pondasi" value="69900000" readonly></th>
                                <th colspan="2"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== III. PEKERJAAN STRUKTUR BETON ===== -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">III. PEKERJAAN STRUKTUR BETON</h5>
                    <button class="btn btn-sm btn-light" onclick="tambahItem('struktur')">
                        <i class="mdi mdi-plus me-1"></i>Tambah Item
                    </button>
                </div>
                <div class="card-body p-0">
                    <table class="table table-bordered mb-0" id="table-struktur">
                        <thead class="bg-light">
                            <tr>
                                <th style="width: 5%">No</th>
                                <th style="width: 30%">Uraian Pekerjaan</th>
                                <th style="width: 8%">Volume</th>
                                <th style="width: 8%">Satuan</th>
                                <th style="width: 12%">Harga Satuan (Rp)</th>
                                <th style="width: 12%">Total (Rp)</th>
                                <th style="width: 15%">Keterangan</th>
                                <th style="width: 10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>3.1</td>
                                <td><input type="text" class="form-control form-control-sm" value="Besi Beton Ø12mm (Kolom)"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="200"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option selected>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="120000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="24000000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Kolom utama"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>3.2</td>
                                <td><input type="text" class="form-control form-control-sm" value="Besi Beton Ø10mm (Balok)"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="150"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option selected>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="90000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="13500000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Balok ring"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>3.3</td>
                                <td><input type="text" class="form-control form-control-sm" value="Besi Beton Ø8mm"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="100"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option selected>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="55000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="5500000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Tulangan"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>3.4</td>
                                <td><input type="text" class="form-control form-control-sm" value="Semen PC (50kg)"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="200"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option selected>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="75000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="15000000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="K 225"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>3.5</td>
                                <td><input type="text" class="form-control form-control-sm" value="Pasir Beton"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="15"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option selected>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="320000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="4800000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Cor beton"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>3.6</td>
                                <td><input type="text" class="form-control form-control-sm" value="Split / Kerikil"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="20"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option selected>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="350000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="7000000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="1-2cm"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>3.7</td>
                                <td><input type="text" class="form-control form-control-sm" value="Kayu Bekisting"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="60"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option selected>lembar</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="180000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="10800000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Multiplek"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>3.8</td>
                                <td><input type="text" class="form-control form-control-sm" value="Kayu Usuk"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="80"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option selected>batang</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="45000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="3600000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Struktur"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>3.9</td>
                                <td><input type="text" class="form-control form-control-sm" value="Paku"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="20"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option selected>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="20000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="400000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Bekisting"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>3.10</td>
                                <td><input type="text" class="form-control form-control-sm" value="Kawat Beton"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="25"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option selected>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="25000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="625000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Ikat besi"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>3.11</td>
                                <td><input type="text" class="form-control form-control-sm" value="Upah Pekerja"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="20"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option selected>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="350000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="7000000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="5 orang"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>3.12</td>
                                <td><input type="text" class="form-control form-control-sm" value="Upah Tukang"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="20"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option selected>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="450000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="9000000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="3 tukang"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot class="bg-light">
                            <tr>
                                <th colspan="5" class="text-end">SUB TOTAL III</th>
                                <th><input type="text" class="form-control form-control-sm" id="subtotal-struktur" value="101225000" readonly></th>
                                <th colspan="2"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== IV. PEKERJAAN DINDING & PLAFON ===== -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">IV. PEKERJAAN DINDING & PLAFON</h5>
                    <button class="btn btn-sm btn-light" onclick="tambahItem('dinding')">
                        <i class="mdi mdi-plus me-1"></i>Tambah Item
                    </button>
                </div>
                <div class="card-body p-0">
                    <table class="table table-bordered mb-0" id="table-dinding">
                        <thead class="bg-light">
                            <tr>
                                <th style="width: 5%">No</th>
                                <th style="width: 30%">Uraian Pekerjaan</th>
                                <th style="width: 8%">Volume</th>
                                <th style="width: 8%">Satuan</th>
                                <th style="width: 12%">Harga Satuan (Rp)</th>
                                <th style="width: 12%">Total (Rp)</th>
                                <th style="width: 15%">Keterangan</th>
                                <th style="width: 10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>4.1</td>
                                <td><input type="text" class="form-control form-control-sm" value="Bata Ringan / Hebel"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="800"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option selected>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="8000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="6400000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="60x20"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>4.2</td>
                                <td><input type="text" class="form-control form-control-sm" value="Semen Perekat"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="80"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option selected>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="75000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="6000000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Perekat"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>4.3</td>
                                <td><input type="text" class="form-control form-control-sm" value="Pasir Pasang"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="8"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option selected>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="300000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="2400000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Halus"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>4.4</td>
                                <td><input type="text" class="form-control form-control-sm" value="Lem Hebel"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="40"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option selected>sak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="60000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="2400000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Thinbed"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>4.5</td>
                                <td><input type="text" class="form-control form-control-sm" value="Rangka Plafon"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="80"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option selected>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="85000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="6800000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Hollow"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>4.6</td>
                                <td><input type="text" class="form-control form-control-sm" value="Plafon Gypsum"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="80"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option selected>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="70000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="5600000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="9mm"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>4.7</td>
                                <td><input type="text" class="form-control form-control-sm" value="List Plafon"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="40"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option selected>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="35000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="1400000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Gypsum"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>4.8</td>
                                <td><input type="text" class="form-control form-control-sm" value="Upah Pekerja"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="15"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option selected>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="350000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="5250000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="4 orang"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>4.9</td>
                                <td><input type="text" class="form-control form-control-sm" value="Upah Tukang"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="15"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option selected>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="450000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="6750000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="2 tukang"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot class="bg-light">
                            <tr>
                                <th colspan="5" class="text-end">SUB TOTAL IV</th>
                                <th><input type="text" class="form-control form-control-sm" id="subtotal-dinding" value="43000000" readonly></th>
                                <th colspan="2"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== V. PEKERJAAN ATAP ===== -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">V. PEKERJAAN ATAP</h5>
                    <button class="btn btn-sm btn-light" onclick="tambahItem('atap')">
                        <i class="mdi mdi-plus me-1"></i>Tambah Item
                    </button>
                </div>
                <div class="card-body p-0">
                    <table class="table table-bordered mb-0" id="table-atap">
                        <thead class="bg-light">
                            <tr>
                                <th style="width: 5%">No</th>
                                <th style="width: 30%">Uraian Pekerjaan</th>
                                <th style="width: 8%">Volume</th>
                                <th style="width: 8%">Satuan</th>
                                <th style="width: 12%">Harga Satuan (Rp)</th>
                                <th style="width: 12%">Total (Rp)</th>
                                <th style="width: 15%">Keterangan</th>
                                <th style="width: 10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>5.1</td>
                                <td><input type="text" class="form-control form-control-sm" value="Kayu Kuda-kuda"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="15"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option selected>batang</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="250000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="3750000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Kruing"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>5.2</td>
                                <td><input type="text" class="form-control form-control-sm" value="Kayu Gording"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="20"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option selected>batang</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="180000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="3600000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="6/12"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>5.3</td>
                                <td><input type="text" class="form-control form-control-sm" value="Kayu Reng"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="50"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option selected>batang</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="45000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="2250000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="2/3"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>5.4</td>
                                <td><input type="text" class="form-control form-control-sm" value="Genteng Beton"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="800"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option selected>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="5500"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="4400000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Natural"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>5.5</td>
                                <td><input type="text" class="form-control form-control-sm" value="Nok Genteng"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="25"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option selected>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="15000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="375000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Warna"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>5.6</td>
                                <td><input type="text" class="form-control form-control-sm" value="Paku Atap"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="10"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option selected>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="25000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="250000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Anti karat"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>5.7</td>
                                <td><input type="text" class="form-control form-control-sm" value="Talang Air"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="20"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option selected>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="85000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="1700000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="PVC"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>5.8</td>
                                <td><input type="text" class="form-control form-control-sm" value="Listplank"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="18"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option selected>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="65000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="1170000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Kayu"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>5.9</td>
                                <td><input type="text" class="form-control form-control-sm" value="Upah Pekerja"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="10"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option selected>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="350000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="3500000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="3 orang"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>5.10</td>
                                <td><input type="text" class="form-control form-control-sm" value="Upah Tukang"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="10"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option selected>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="450000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="4500000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="2 tukang"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot class="bg-light">
                            <tr>
                                <th colspan="5" class="text-end">SUB TOTAL V</th>
                                <th><input type="text" class="form-control form-control-sm" id="subtotal-atap" value="25495000" readonly></th>
                                <th colspan="2"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== VI. PEKERJAAN LANTAI ===== -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">VI. PEKERJAAN LANTAI</h5>
                    <button class="btn btn-sm btn-light" onclick="tambahItem('lantai')">
                        <i class="mdi mdi-plus me-1"></i>Tambah Item
                    </button>
                </div>
                <div class="card-body p-0">
                    <table class="table table-bordered mb-0" id="table-lantai">
                        <thead class="bg-light">
                            <tr>
                                <th style="width: 5%">No</th>
                                <th style="width: 30%">Uraian Pekerjaan</th>
                                <th style="width: 8%">Volume</th>
                                <th style="width: 8%">Satuan</th>
                                <th style="width: 12%">Harga Satuan (Rp)</th>
                                <th style="width: 12%">Total (Rp)</th>
                                <th style="width: 15%">Keterangan</th>
                                <th style="width: 10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>6.1</td>
                                <td><input type="text" class="form-control form-control-sm" value="Urug Tanah"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="15"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option selected>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="150000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="2250000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Tanah merah"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>6.2</td>
                                <td><input type="text" class="form-control form-control-sm" value="Pasir Urug"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="5"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option selected>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="250000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="1250000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Tebal 5cm"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>6.3</td>
                                <td><input type="text" class="form-control form-control-sm" value="Semen (Lantai Kerja)"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="50"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option selected>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="75000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="3750000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Lantai kerja"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>6.4</td>
                                <td><input type="text" class="form-control form-control-sm" value="Keramik 60x60"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="85"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option selected>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="150000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="12750000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Granit motif"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>6.5</td>
                                <td><input type="text" class="form-control form-control-sm" value="Semen (Perekat)"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="30"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option selected>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="75000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="2250000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Perekat"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>6.6</td>
                                <td><input type="text" class="form-control form-control-sm" value="Pasir Halus"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="4"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option selected>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="300000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="1200000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Spesi"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>6.7</td>
                                <td><input type="text" class="form-control form-control-sm" value="Semen Warna (Nat)"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="5"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option selected>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="15000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="75000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Nat"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>6.8</td>
                                <td><input type="text" class="form-control form-control-sm" value="Upah Pekerja"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="8"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option selected>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="350000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="2800000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="3 orang"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>6.9</td>
                                <td><input type="text" class="form-control form-control-sm" value="Upah Tukang"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="8"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option selected>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="450000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="3600000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="2 tukang"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot class="bg-light">
                            <tr>
                                <th colspan="5" class="text-end">SUB TOTAL VI</th>
                                <th><input type="text" class="form-control form-control-sm" id="subtotal-lantai" value="29925000" readonly></th>
                                <th colspan="2"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== VII. PEKERJAAN INSTALASI ===== -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">VII. PEKERJAAN INSTALASI</h5>
                    <button class="btn btn-sm btn-light" onclick="tambahItem('instalasi')">
                        <i class="mdi mdi-plus me-1"></i>Tambah Item
                    </button>
                </div>
                <div class="card-body p-0">
                    <table class="table table-bordered mb-0" id="table-instalasi">
                        <thead class="bg-light">
                            <tr>
                                <th style="width: 5%">No</th>
                                <th style="width: 30%">Uraian Pekerjaan</th>
                                <th style="width: 8%">Volume</th>
                                <th style="width: 8%">Satuan</th>
                                <th style="width: 12%">Harga Satuan (Rp)</th>
                                <th style="width: 12%">Total (Rp)</th>
                                <th style="width: 15%">Keterangan</th>
                                <th style="width: 10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>7.1</td>
                                <td><input type="text" class="form-control form-control-sm" value="Kabel Listrik 2.5mm"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="150"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option selected>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="8000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="1200000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="NYA"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>7.2</td>
                                <td><input type="text" class="form-control form-control-sm" value="Kabel Listrik 1.5mm"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="100"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option selected>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="5500"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="550000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Lampu"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>7.3</td>
                                <td><input type="text" class="form-control form-control-sm" value="MCB Box"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="1"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option selected>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="350000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="350000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="6 group"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>7.4</td>
                                <td><input type="text" class="form-control form-control-sm" value="MCB 10A"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="4"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option selected>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="85000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="340000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Schneider"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>7.5</td>
                                <td><input type="text" class="form-control form-control-sm" value="Stop Kontak"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="8"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option selected>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="45000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="360000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Broco"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>7.6</td>
                                <td><input type="text" class="form-control form-control-sm" value="Saklar"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="6"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option selected>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="35000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="210000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Broco"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>7.7</td>
                                <td><input type="text" class="form-control form-control-sm" value="Fitting Lampu"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="8"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option selected>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="20000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="160000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Plafon"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>7.8</td>
                                <td><input type="text" class="form-control form-control-sm" value="Pipa Listrik"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="80"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option selected>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="12000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="960000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="PVC 5/8"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>7.9</td>
                                <td><input type="text" class="form-control form-control-sm" value="Pipa Air 3/4""></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="60"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option selected>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="25000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="1500000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="PVC"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>7.10</td>
                                <td><input type="text" class="form-control form-control-sm" value="Pipa Air 1/2""></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="30"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option selected>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="18000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="540000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="PVC"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>7.11</td>
                                <td><input type="text" class="form-control form-control-sm" value="Kran Air"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="4"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option selected>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="55000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="220000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Stainless"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>7.12</td>
                                <td><input type="text" class="form-control form-control-sm" value="Closet Duduk"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="1"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option selected>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="1200000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="1200000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Toto"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>7.13</td>
                                <td><input type="text" class="form-control form-control-sm" value="Wastafel"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="1"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option selected>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="850000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="850000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Dengan kran"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>7.14</td>
                                <td><input type="text" class="form-control form-control-sm" value="Shower"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="1"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option selected>set</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="450000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="450000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="K. mandi"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>7.15</td>
                                <td><input type="text" class="form-control form-control-sm" value="Upah Instalasi"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="5"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option selected>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="350000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="1750000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="2 pekerja"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot class="bg-light">
                            <tr>
                                <th colspan="5" class="text-end">SUB TOTAL VII</th>
                                <th><input type="text" class="form-control form-control-sm" id="subtotal-instalasi" value="10640000" readonly></th>
                                <th colspan="2"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== VIII. PEKERJAAN FINISHING ===== -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">VIII. PEKERJAAN FINISHING</h5>
                    <button class="btn btn-sm btn-light" onclick="tambahItem('finishing')">
                        <i class="mdi mdi-plus me-1"></i>Tambah Item
                    </button>
                </div>
                <div class="card-body p-0">
                    <table class="table table-bordered mb-0" id="table-finishing">
                        <thead class="bg-light">
                            <tr>
                                <th style="width: 5%">No</th>
                                <th style="width: 30%">Uraian Pekerjaan</th>
                                <th style="width: 8%">Volume</th>
                                <th style="width: 8%">Satuan</th>
                                <th style="width: 12%">Harga Satuan (Rp)</th>
                                <th style="width: 12%">Total (Rp)</th>
                                <th style="width: 15%">Keterangan</th>
                                <th style="width: 10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>8.1</td>
                                <td><input type="text" class="form-control form-control-sm" value="Cat Tembok Interior"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="200"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option selected>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="35000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="7000000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Dulux"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>8.2</td>
                                <td><input type="text" class="form-control form-control-sm" value="Cat Tembok Exterior"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="100"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option selected>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="40000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="4000000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Weathershield"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>8.3</td>
                                <td><input type="text" class="form-control form-control-sm" value="Cat Plafon"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="80"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option selected>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="30000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="2400000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Putih"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>8.4</td>
                                <td><input type="text" class="form-control form-control-sm" value="Pintu"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="5"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option selected>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="1200000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="6000000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Kayu jati"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>8.5</td>
                                <td><input type="text" class="form-control form-control-sm" value="Jendela"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="4"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option selected>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="900000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="3600000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Alumunium"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>8.6</td>
                                <td><input type="text" class="form-control form-control-sm" value="Kusen Pintu"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="5"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option selected>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="650000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="3250000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Kayu kamper"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>8.7</td>
                                <td><input type="text" class="form-control form-control-sm" value="Kusen Jendela"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="4"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option selected>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="550000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="2200000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="Kayu kamper"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>8.8</td>
                                <td><input type="text" class="form-control form-control-sm" value="Kaca"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="8"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option selected>lembar</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="250000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="2000000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="5mm"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>8.9</td>
                                <td><input type="text" class="form-control form-control-sm" value="Upah Pekerja"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="10"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option selected>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="350000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="3500000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="3 pekerja"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>8.10</td>
                                <td><input type="text" class="form-control form-control-sm" value="Upah Tukang"></td>
                                <td><input type="number" class="form-control form-control-sm volume" value="10"></td>
                                <td>
                                    <select class="form-control form-control-sm satuan">
                                        <option>ls</option>
                                        <option>m²</option>
                                        <option>m³</option>
                                        <option>m'</option>
                                        <option>unit</option>
                                        <option>zak</option>
                                        <option>buah</option>
                                        <option>kg</option>
                                        <option selected>hari</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-control-sm harga-satuan" value="450000"></td>
                                <td><input type="text" class="form-control form-control-sm total-item" value="4500000" readonly></td>
                                <td><input type="text" class="form-control form-control-sm" value="2 tukang"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot class="bg-light">
                            <tr>
                                <th colspan="5" class="text-end">SUB TOTAL VIII</th>
                                <th><input type="text" class="form-control form-control-sm" id="subtotal-finishing" value="38450000" readonly></th>
                                <th colspan="2"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Biaya Lain-lain -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">BIAYA LAIN-LAIN</h5>
                    <button class="btn btn-sm btn-light" onclick="tambahBiayaLain()">
                        <i class="mdi mdi-plus me-1"></i>Tambah Biaya
                    </button>
                </div>
                <div class="card-body p-0">
                    <table class="table table-bordered mb-0" id="table-biaya-lain">
                        <thead class="bg-light">
                            <tr>
                                <th style="width: 5%">No</th>
                                <th style="width: 40%">Uraian Biaya</th>
                                <th style="width: 20%">Jumlah (Rp)</th>
                                <th style="width: 25%">Keterangan</th>
                                <th style="width: 10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><input type="text" class="form-control form-control-sm" value="Biaya Arsitek & Perencanaan"></td>
                                <td><input type="text" class="form-control form-control-sm biaya-lain" value="10000000"></td>
                                <td><input type="text" class="form-control form-control-sm" value="Desain & gambar"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><input type="text" class="form-control form-control-sm" value="Biaya Pengawas"></td>
                                <td><input type="text" class="form-control form-control-sm biaya-lain" value="8000000"></td>
                                <td><input type="text" class="form-control form-control-sm" value="Pengawasan lapangan"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td><input type="text" class="form-control form-control-sm" value="Biaya Perizinan (IMB)"></td>
                                <td><input type="text" class="form-control form-control-sm biaya-lain" value="5000000"></td>
                                <td><input type="text" class="form-control form-control-sm" value="IMB + PBG"></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot class="bg-light">
                            <tr>
                                <th colspan="2" class="text-end">TOTAL BIAYA LAIN</th>
                                <th><input type="text" class="form-control form-control-sm" id="total-biaya-lain" value="23000000" readonly></th>
                                <th colspan="2"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Biaya Tak Terduga & Total -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">BIAYA TAK TERDUGA</h5>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Persentase</label>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <input type="number" class="form-control" id="persen-tak-terduga" value="5" min="0" max="20">
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Nilai Tak Terduga</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nilai-tak-terduga" value="0" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>TOTAL ANGGARAN PEMBANGUNAN</h5>
                    <h2 class="mt-3" id="total-anggaran">Rp 0</h2>
                    <hr class="bg-white">
                    <div class="row">
                        <div class="col-6">
                            <small>Total RAB</small>
                            <h5 id="total-rab">Rp 0</h5>
                        </div>
                        <div class="col-6">
                            <small>Biaya Lain + Tak Terduga</small>
                            <h5 id="total-lain">Rp 0</h5>
                        </div>
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
                        <a href="#" class="btn btn-light me-2">
                            <i class="mdi mdi-arrow-left me-1"></i>Kembali
                        </a>
                        <button class="btn btn-secondary">
                            <i class="mdi mdi-content-save me-1"></i>Simpan Draft
                        </button>
                    </div>
                    <div>
                        <button class="btn btn-success me-2">
                            <i class="mdi mdi-check-circle me-1"></i>Setujui RAB
                        </button>
                        <button class="btn btn-primary">
                            <i class="mdi mdi-printer me-1"></i>Cetak RAB
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Fungsi format angka ke rupiah
function formatRupiah(angka) {
    return new Intl.NumberFormat('id-ID').format(angka);
}

// Fungsi parse rupiah ke number
function parseRupiah(rupiah) {
    return parseInt(rupiah.replace(/\./g, '')) || 0;
}

// Hitung total per item
function hitungTotalItem(row) {
    let volume = $(row).find('.volume').val() || 0;
    let hargaSatuan = $(row).find('.harga-satuan').val().replace(/\./g, '') || 0;
    let total = volume * hargaSatuan;
    $(row).find('.total-item').val(total);
    return total;
}

// Hitung subtotal per tabel
function hitungSubtotal(tableId, subtotalId) {
    let total = 0;
    $(tableId + ' tbody tr').each(function() {
        let volume = $(this).find('.volume').val() || 0;
        let hargaSatuan = $(this).find('.harga-satuan').val().replace(/\./g, '') || 0;
        total += volume * hargaSatuan;
    });
    $(subtotalId).val(total);
    return total;
}

// Hitung total semua RAB
function hitungTotalRAB() {
    let total = 0;
    total += parseInt($('#subtotal-persiapan').val()) || 0;
    total += parseInt($('#subtotal-pondasi').val()) || 0;
    total += parseInt($('#subtotal-struktur').val()) || 0;
    total += parseInt($('#subtotal-dinding').val()) || 0;
    total += parseInt($('#subtotal-atap').val()) || 0;
    total += parseInt($('#subtotal-lantai').val()) || 0;
    total += parseInt($('#subtotal-instalasi').val()) || 0;
    total += parseInt($('#subtotal-finishing').val()) || 0;
    $('#total-rab').text('Rp ' + formatRupiah(total));
    return total;
}

// Hitung total biaya lain
function hitungTotalBiayaLain() {
    let total = 0;
    $('#table-biaya-lain tbody tr').each(function() {
        let nilai = $(this).find('.biaya-lain').val().replace(/\./g, '') || 0;
        total += parseInt(nilai);
    });
    $('#total-biaya-lain').val(total);
    return total;
}

// Hitung biaya tak terduga
function hitungTakTerduga() {
    let totalRAB = hitungTotalRAB();
    let persen = $('#persen-tak-terduga').val() || 0;
    let nilai = Math.round(totalRAB * persen / 100);
    $('#nilai-tak-terduga').val(nilai);
    return nilai;
}

// Hitung total anggaran
function hitungTotalAnggaran() {
    let totalRAB = hitungTotalRAB();
    let totalBiayaLain = hitungTotalBiayaLain();
    let takTerduga = hitungTakTerduga();
    let total = totalRAB + totalBiayaLain + takTerduga;
    $('#total-anggaran').text('Rp ' + formatRupiah(total));
    $('#total-lain').text('Rp ' + formatRupiah(totalBiayaLain + takTerduga));
}

// Event listener untuk perubahan
$(document).ready(function() {
    // Format input harga satuan
    $(document).on('keyup', '.harga-satuan, .biaya-lain', function() {
        let nilai = this.value.replace(/\D/g, '');
        if (nilai) {
            this.value = formatRupiah(nilai);
        }
    });

    // Hitung total saat volume atau harga berubah
    $(document).on('keyup change', '.volume, .harga-satuan', function() {
        let row = $(this).closest('tr');
        hitungTotalItem(row);

        // Hitung subtotal berdasarkan tabel
        let table = $(this).closest('table').attr('id');
        if (table === 'table-persiapan') hitungSubtotal('#table-persiapan', '#subtotal-persiapan');
        if (table === 'table-pondasi') hitungSubtotal('#table-pondasi', '#subtotal-pondasi');
        if (table === 'table-struktur') hitungSubtotal('#table-struktur', '#subtotal-struktur');
        if (table === 'table-dinding') hitungSubtotal('#table-dinding', '#subtotal-dinding');
        if (table === 'table-atap') hitungSubtotal('#table-atap', '#subtotal-atap');
        if (table === 'table-lantai') hitungSubtotal('#table-lantai', '#subtotal-lantai');
        if (table === 'table-instalasi') hitungSubtotal('#table-instalasi', '#subtotal-instalasi');
        if (table === 'table-finishing') hitungSubtotal('#table-finishing', '#subtotal-finishing');

        hitungTotalAnggaran();
    });

    // Hitung saat biaya lain berubah
    $(document).on('keyup', '.biaya-lain', function() {
        hitungTotalBiayaLain();
        hitungTotalAnggaran();
    });

    // Hitung saat persen tak terduga berubah
    $('#persen-tak-terduga').on('keyup change', function() {
        hitungTotalAnggaran();
    });

    // Inisialisasi perhitungan
    hitungTotalAnggaran();
});

// Tambah item ke tabel
function tambahItem(tipe) {
    let tableId = '#table-' + tipe;
    let rowCount = $(tableId + ' tbody tr').length + 1;
    let no = '';

    if (tipe === 'persiapan') no = '1.' + (rowCount + 5);
    else if (tipe === 'pondasi') no = '2.' + (rowCount + 11);
    else if (tipe === 'struktur') no = '3.' + (rowCount + 12);
    else if (tipe === 'dinding') no = '4.' + (rowCount + 9);
    else if (tipe === 'atap') no = '5.' + (rowCount + 10);
    else if (tipe === 'lantai') no = '6.' + (rowCount + 9);
    else if (tipe === 'instalasi') no = '7.' + (rowCount + 15);
    else if (tipe === 'finishing') no = '8.' + (rowCount + 10);

    let newRow = `
        <tr>
            <td>${no}</td>
            <td><input type="text" class="form-control form-control-sm" placeholder="Nama pekerjaan"></td>
            <td><input type="number" class="form-control form-control-sm volume" value="0"></td>
            <td>
                <select class="form-control form-control-sm satuan">
                    <option>ls</option>
                    <option>m²</option>
                    <option>m³</option>
                    <option>m'</option>
                    <option>unit</option>
                    <option>zak</option>
                    <option>buah</option>
                    <option>kg</option>
                    <option>lembar</option>
                    <option>batang</option>
                    <option>sak</option>
                    <option>set</option>
                    <option>hari</option>
                </select>
            </td>
            <td><input type="text" class="form-control form-control-sm harga-satuan" value="0"></td>
            <td><input type="text" class="form-control form-control-sm total-item" value="0" readonly></td>
            <td><input type="text" class="form-control form-control-sm" placeholder="Keterangan"></td>
            <td class="text-center">
                <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
            </td>
        </tr>
    `;
    $(tableId + ' tbody').append(newRow);
}

// Tambah biaya lain
function tambahBiayaLain() {
    let rowCount = $('#table-biaya-lain tbody tr').length + 1;
    let newRow = `
        <tr>
            <td>${rowCount}</td>
            <td><input type="text" class="form-control form-control-sm" placeholder="Nama biaya"></td>
            <td><input type="text" class="form-control form-control-sm biaya-lain" value="0"></td>
            <td><input type="text" class="form-control form-control-sm" placeholder="Keterangan"></td>
            <td class="text-center">
                <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(this)"><i class="mdi mdi-delete"></i></button>
            </td>
        </tr>
    `;
    $('#table-biaya-lain tbody').append(newRow);
}

// Hapus item
function hapusItem(btn) {
    $(btn).closest('tr').remove();
    // Update nomor urut
    let table = $(btn).closest('table');
    table.find('tbody tr').each(function(index) {
        $(this).find('td:first').text(index + 1);
    });

    // Hitung ulang total
    if (table.attr('id') === 'table-biaya-lain') {
        hitungTotalBiayaLain();
        hitungTotalAnggaran();
    } else {
        let tableId = table.attr('id');
        let subtotalId = '#subtotal-' + tableId.replace('table-', '');
        hitungSubtotal('#' + tableId, subtotalId);
        hitungTotalAnggaran();
    }
}
</script>
@endpush
