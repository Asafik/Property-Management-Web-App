@extends('layouts.partial.app')

@section('title', 'Data Dokumen Cash Legal - Property Management App')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/bank/bank.css') }}">

<div class="container-fluid p-2 p-sm-3 p-md-4">
    <!-- Header Dashboard -->
    <div class="row mb-3 mb-sm-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="text-dark mb-1">
                            <i class="mdi mdi-file-document-multiple me-2" style="color: #9a55ff;"></i>
                            Data Dokumen Cash Legal
                        </h3>
                        <p class="text-muted mb-0">
                            <i class="mdi mdi-information-outline me-1"></i>
                            Kelola dokumen legal untuk transaksi cash
                        </p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-file-document" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Data Dokumen -->
    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-format-list-bulleted me-2 text-primary"></i>
                        Daftar Dokumen Cash Legal
                    </h5>
                    <div class="ms-auto">
                        <button class="btn btn-gradient-primary" style="padding: 8px 20px; font-size: 0.95rem; white-space: nowrap;" onclick="$('#modalUploadDokumen').modal('show')">
                            <i class="mdi mdi-cloud-upload me-1"></i>
                            <span>Upload Dokumen</span>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <!-- FILTER SECTION -->
                    <div class="filter-card mb-4">
                        <div class="card-body">
                            <h6 class="card-title mb-3" style="font-size: 1rem;">
                                <i class="mdi mdi-filter-outline me-1" style="color: #9a55ff;"></i>
                                Filter Data Dokumen
                            </h6>

                            <!-- MOBILE VERSION -->
                            <div class="d-block d-md-none">
                                <form method="GET" action="#">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">
                                            <i class="mdi mdi-magnify me-1" style="color: #9a55ff;"></i>
                                            Cari Dokumen
                                        </label>
                                        <input type="text" class="form-control" name="search"
                                            placeholder="Cari nama dokumen..." style="height: 45px;">
                                    </div>

                                    <div class="row g-2 mb-3">
                                        <div class="col-6">
                                            <label class="form-label fw-semibold">
                                                <i class="mdi mdi-flag me-1" style="color: #9a55ff;"></i>Status
                                            </label>
                                            <select class="form-control" name="status" style="height: 45px;">
                                                <option value="">Semua</option>
                                                <option value="verified">Terverifikasi</option>
                                                <option value="pending">Pending</option>
                                                <option value="rejected">Rejected</option>
                                                <option value="draft">Draft</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label fw-semibold">
                                                <i class="mdi mdi-counter me-1" style="color: #9a55ff;"></i>Tampil
                                            </label>
                                            <select class="form-control" name="per_page" style="height: 45px;">
                                                <option value="10">10</option>
                                                <option value="15">15</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row g-2">
                                        <div class="col-6">
                                            <button type="submit" class="btn btn-gradient-primary w-100 py-2 d-flex align-items-center justify-content-center">
                                                <i class="mdi mdi-filter me-1"></i> Filter
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <a href="#" class="btn btn-gradient-secondary w-100 py-2 d-flex align-items-center justify-content-center">
                                                <i class="mdi mdi-refresh me-1"></i> Reset
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- DESKTOP VERSION -->
                            <div class="d-none d-md-block">
                                <form method="GET" action="#">
                                    <div class="row g-2 align-items-end">
                                        <div class="col-md-4">
                                            <label class="form-label">
                                                <i class="mdi mdi-magnify me-1" style="color: #9a55ff;"></i>
                                                Cari Dokumen
                                            </label>
                                            <input type="text" class="form-control" name="search"
                                                placeholder="Cari nama dokumen...">
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label">
                                                <i class="mdi mdi-flag me-1" style="color: #9a55ff;"></i>Status
                                            </label>
                                            <select class="form-control" name="status">
                                                <option value="">Semua</option>
                                                <option value="verified">Terverifikasi</option>
                                                <option value="pending">Pending</option>
                                                <option value="rejected">Rejected</option>
                                                <option value="draft">Draft</option>
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label">
                                                <i class="mdi mdi-counter me-1" style="color: #9a55ff;"></i>Tampil
                                            </label>
                                            <select class="form-control" name="per_page">
                                                <option value="10">10</option>
                                                <option value="15">15</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label invisible">Filter</label>
                                            <button type="submit" class="btn btn-gradient-primary w-100 d-flex align-items-center justify-content-center">
                                                <i class="mdi mdi-filter me-1"></i> Filter
                                            </button>
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label invisible">Reset</label>
                                            <a href="#" class="btn btn-gradient-secondary w-100 d-flex align-items-center justify-content-center" title="Reset">
                                                <i class="mdi mdi-refresh me-1"></i> Reset
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- STATS CARDS -->
                    <div class="row g-3 mb-4">
                        <div class="col-6 col-md-3">
                            <div class="card bg-light border-0">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-3">
                                            <i class="mdi mdi-file-document text-primary" style="font-size: 2rem;"></i>
                                        </div>
                                        <div>
                                            <h5 class="fw-bold mb-0">12</h5>
                                            <p class="text-muted small mb-0">Total Dokumen</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="card bg-light border-0">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-3">
                                            <i class="mdi mdi-check-circle text-success" style="font-size: 2rem;"></i>
                                        </div>
                                        <div>
                                            <h5 class="fw-bold mb-0">7</h5>
                                            <p class="text-muted small mb-0">Terverifikasi</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="card bg-light border-0">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-3">
                                            <i class="mdi mdi-clock-outline text-warning" style="font-size: 2rem;"></i>
                                        </div>
                                        <div>
                                            <h5 class="fw-bold mb-0">3</h5>
                                            <p class="text-muted small mb-0">Pending</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="card bg-light border-0">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-3">
                                            <i class="mdi mdi-alert-circle text-danger" style="font-size: 2rem;"></i>
                                        </div>
                                        <div>
                                            <h5 class="fw-bold mb-0">2</h5>
                                            <p class="text-muted small mb-0">Revisi</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- INFO CUSTOMER CARD -->
                    <div class="card mb-4 border-0 bg-light">
                        <div class="card-body p-3">
                            <div class="d-flex flex-wrap align-items-center gap-3">
                                <div class="flex-shrink-0">
                                    <div class="bg-gradient-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 50px; height: 50px; background: linear-gradient(135deg, #9a55ff, #da8cff);">
                                        <i class="mdi mdi-account" style="font-size: 24px;"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1 text-dark">Budi Santoso</h6>
                                    <p class="text-muted small mb-0">Grand Emerald Blok A.12 - Tipe 45/90</p>
                                </div>
                                <div>
                                    <span class="badge badge-gradient-primary">
                                        <i class="mdi mdi-cash me-1"></i>Pembayaran Cash
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TABEL DATA -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle" id="tableDokumen">
                            <thead>
                                <tr>
                                    <th class="text-center" width="5%">No</th>
                                    <th width="25%">Nama Dokumen</th>
                                    <th width="20%">Nomor Dokumen</th>
                                    <th width="15%">Tanggal</th>
                                    <th width="15%">Ukuran</th>
                                    <th width="10%">Status</th>
                                    <th class="text-center" width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center fw-bold">1</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-card-account-details text-primary me-2" style="font-size: 1.2rem;"></i>
                                            <span class="fw-bold">KTP Pembeli</span>
                                        </div>
                                    </td>
                                    <td>3175-1234-5678</td>
                                    <td>15 Mar 2025</td>
                                    <td>1.2 MB</td>
                                    <td>
                                        <span class="badge badge-gradient-success">
                                            <i class="mdi mdi-check-circle me-1"></i>Terverifikasi
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <button class="btn btn-outline-info btn-sm btnView" title="Lihat">
                                                <i class="mdi mdi-eye"></i>
                                            </button>
                                            <button class="btn btn-outline-warning btn-sm btnEdit" title="Edit">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                            <button class="btn btn-outline-danger btn-sm btnDelete" title="Hapus">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center fw-bold">2</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-file-account text-primary me-2" style="font-size: 1.2rem;"></i>
                                            <span class="fw-bold">NPWP</span>
                                        </div>
                                    </td>
                                    <td>99.123.456.7-888</td>
                                    <td>15 Mar 2025</td>
                                    <td>0.8 MB</td>
                                    <td>
                                        <span class="badge badge-gradient-success">
                                            <i class="mdi mdi-check-circle me-1"></i>Terverifikasi
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <button class="btn btn-outline-info btn-sm btnView" title="Lihat">
                                                <i class="mdi mdi-eye"></i>
                                            </button>
                                            <button class="btn btn-outline-warning btn-sm btnEdit" title="Edit">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                            <button class="btn btn-outline-danger btn-sm btnDelete" title="Hapus">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center fw-bold">3</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-ring text-primary me-2" style="font-size: 1.2rem;"></i>
                                            <span class="fw-bold">Surat Nikah</span>
                                        </div>
                                    </td>
                                    <td>123/KUA/III/2025</td>
                                    <td>16 Mar 2025</td>
                                    <td>2.1 MB</td>
                                    <td>
                                        <span class="badge badge-gradient-warning">
                                            <i class="mdi mdi-clock-outline me-1"></i>Pending
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <button class="btn btn-outline-info btn-sm btnView" title="Lihat">
                                                <i class="mdi mdi-eye"></i>
                                            </button>
                                            <button class="btn btn-outline-warning btn-sm btnEdit" title="Edit">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                            <button class="btn btn-outline-danger btn-sm btnDelete" title="Hapus">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center fw-bold">4</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-file-sign text-primary me-2" style="font-size: 1.2rem;"></i>
                                            <span class="fw-bold">Akta Jual Beli</span>
                                        </div>
                                    </td>
                                    <td>AJB/045/PPAT/2025</td>
                                    <td>17 Mar 2025</td>
                                    <td>3.5 MB</td>
                                    <td>
                                        <span class="badge badge-gradient-danger">
                                            <i class="mdi mdi-close-circle me-1"></i>Revisi
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <button class="btn btn-outline-info btn-sm btnView" title="Lihat">
                                                <i class="mdi mdi-eye"></i>
                                            </button>
                                            <button class="btn btn-outline-warning btn-sm btnEdit" title="Edit">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                            <button class="btn btn-outline-danger btn-sm btnDelete" title="Hapus">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center fw-bold">5</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-receipt text-primary me-2" style="font-size: 1.2rem;"></i>
                                            <span class="fw-bold">Kwitansi Pembayaran</span>
                                        </div>
                                    </td>
                                    <td>INV/2025/00123</td>
                                    <td>18 Mar 2025</td>
                                    <td>0.5 MB</td>
                                    <td>
                                        <span class="badge badge-gradient-secondary">
                                            <i class="mdi mdi-pencil me-1"></i>Draft
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <button class="btn btn-outline-info btn-sm btnView" title="Lihat">
                                                <i class="mdi mdi-eye"></i>
                                            </button>
                                            <button class="btn btn-outline-warning btn-sm btnEdit" title="Edit">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                            <button class="btn btn-outline-danger btn-sm btnDelete" title="Hapus">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- PAGINATION SECTION -->
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                        <div class="pagination-info mb-2 mb-sm-0">
                            <i class="mdi mdi-information-outline me-1 text-primary"></i>
                            Menampilkan 1 - 5 dari 12 data dokumen
                        </div>

                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0" style="gap: 2px;">
                                <li class="page-item disabled">
                                    <span class="page-link" aria-label="Previous">
                                        <i class="mdi mdi-chevron-left"></i>
                                    </span>
                                </li>
                                <li class="page-item active">
                                    <span class="page-link">1</span>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">3</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <i class="mdi mdi-chevron-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tombol Kembali -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-3">
                    <div class="d-flex flex-column flex-sm-row justify-content-start">
                        <a href="#" class="btn btn-gradient-secondary">
                            <i class="mdi mdi-arrow-left me-1"></i>
                            Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL UPLOAD DOKUMEN -->
<div class="modal fade" id="modalUploadDokumen" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="mdi mdi-cloud-upload me-2" style="color: #9a55ff;"></i>
                    Upload Dokumen Cash Legal
                </h5>
                <button type="button" class="btn-close" onclick="$('#modalUploadDokumen').modal('hide')" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" id="formUploadDokumen" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-file-document me-1"></i>Jenis Dokumen
                                </label>
                                <select class="modal-form-control" name="jenis" required>
                                    <option value="">Pilih Jenis Dokumen</option>
                                    <option value="KTP">KTP Pembeli</option>
                                    <option value="NPWP">NPWP</option>
                                    <option value="Surat Nikah">Surat Nikah</option>
                                    <option value="Akta Jual Beli">Akta Jual Beli</option>
                                    <option value="Kwitansi">Kwitansi Pembayaran</option>
                                    <option value="SPPT">SPPT PBB</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-note-text me-1"></i>Nomor Dokumen
                                </label>
                                <input type="text" name="nomor" class="modal-form-control" placeholder="Masukkan nomor dokumen" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-calendar me-1"></i>Tanggal Terbit
                                </label>
                                <input type="date" name="tanggal" class="modal-form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-flag me-1"></i>Status
                                </label>
                                <select class="modal-form-control" name="status" required>
                                    <option value="draft">Draft</option>
                                    <option value="pending">Pending</option>
                                    <option value="verified">Terverifikasi</option>
                                    <option value="rejected">Revisi</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-cloud-upload me-1"></i>File Dokumen
                                </label>
                                <div class="upload-file-modern position-relative">
                                    <input type="file" name="file" accept=".pdf,.jpg,.jpeg,.png" required style="opacity:0; position:absolute; width:100%; height:100%; cursor:pointer; z-index:2;">
                                    <div class="upload-file-label" style="border: 2px dashed #e9ecef; border-radius: 8px; padding: 1rem; text-align: center; background: #f8f9fa;">
                                        <i class="mdi mdi-cloud-upload" style="font-size: 2rem; color: #9a55ff;"></i>
                                        <div class="upload-file-info">
                                            <span>Pilih file dokumen</span>
                                            <small class="d-block text-muted">Format: PDF, JPG, PNG (Max 5MB)</small>
                                        </div>
                                        <span class="upload-file-size badge bg-light text-primary mt-2"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-gradient-secondary" onclick="$('#modalUploadDokumen').modal('hide')">Batal</button>
                <button type="submit" form="formUploadDokumen" class="btn btn-gradient-primary">Upload</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL EDIT DOKUMEN -->
<div class="modal fade" id="modalEditDokumen" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="mdi mdi-pencil me-2" style="color: #9a55ff;"></i>
                    Edit Dokumen
                </h5>
                <button type="button" class="btn-close" onclick="$('#modalEditDokumen').modal('hide')" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" id="formEditDokumen" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-file-document me-1"></i>Jenis Dokumen
                                </label>
                                <select class="modal-form-control" name="jenis" id="editJenis" required>
                                    <option value="KTP">KTP Pembeli</option>
                                    <option value="NPWP">NPWP</option>
                                    <option value="Surat Nikah">Surat Nikah</option>
                                    <option value="Akta Jual Beli">Akta Jual Beli</option>
                                    <option value="Kwitansi">Kwitansi Pembayaran</option>
                                    <option value="SPPT">SPPT PBB</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-note-text me-1"></i>Nomor Dokumen
                                </label>
                                <input type="text" name="nomor" id="editNomor" class="modal-form-control" value="3175-1234-5678" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-calendar me-1"></i>Tanggal Terbit
                                </label>
                                <input type="date" name="tanggal" id="editTanggal" class="modal-form-control" value="2025-03-15" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-flag me-1"></i>Status
                                </label>
                                <select class="modal-form-control" name="status" id="editStatus" required>
                                    <option value="draft">Draft</option>
                                    <option value="pending">Pending</option>
                                    <option value="verified">Terverifikasi</option>
                                    <option value="rejected">Revisi</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-gradient-secondary" onclick="$('#modalEditDokumen').modal('hide')">Batal</button>
                <button type="submit" form="formEditDokumen" class="btn btn-gradient-primary">Update</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL VIEW DOKUMEN -->
<div class="modal fade" id="modalViewDokumen" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="mdi mdi-eye me-2" style="color: #9a55ff;"></i>
                    Lihat Dokumen
                </h5>
                <button type="button" class="btn-close" onclick="$('#modalViewDokumen').modal('hide')" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div class="p-5 bg-light rounded">
                    <i class="mdi mdi-file-pdf" style="font-size: 5rem; color: #dc3545;"></i>
                    <p class="mt-3">KTP_Pembeli.pdf</p>
                    <p class="text-muted small">Preview dokumen akan tampil di sini</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-gradient-secondary" onclick="$('#modalViewDokumen').modal('hide')">Tutup</button>
                <a href="#" class="btn btn-gradient-primary">
                    <i class="mdi mdi-download me-1"></i>Download
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Inisialisasi DataTables dengan minimal features
    if ($.fn.DataTable.isDataTable('#tableDokumen')) {
        $('#tableDokumen').DataTable().destroy();
    }

    $('#tableDokumen').DataTable({
        responsive: true,
        ordering: true,
        paging: false,
        info: false,
        searching: false,
        lengthChange: false,
        destroy: true,
        language: {
            emptyTable: "Data dokumen belum tersedia",
            zeroRecords: "Data tidak ditemukan",
        },
        columnDefs: [
            { orderable: false, targets: [6] } // Kolom aksi tidak bisa diurutkan
        ]
    });

    // File upload preview
    $('input[type="file"]').on('change', function() {
        const fileName = this.files[0]?.name;
        const fileSize = this.files[0]?.size;
        const label = $(this).closest('.upload-file-modern').find('.upload-file-info span');
        const sizeSpan = $(this).closest('.upload-file-modern').find('.upload-file-size');

        if (fileName) {
            label.text(fileName.length > 30 ? fileName.substring(0, 30) + '...' : fileName);
            if (fileSize) {
                const sizeInMB = (fileSize / (1024 * 1024)).toFixed(2);
                sizeSpan.text(sizeInMB + ' MB').show();
            }
        } else {
            label.text('Pilih file dokumen');
            sizeSpan.text('').hide();
        }
    });

    // Modal handlers
    $('.btnView').click(function() {
        $('#modalViewDokumen').modal('show');
    });

    $('.btnEdit').click(function() {
        $('#modalEditDokumen').modal('show');
    });

    $('.btnDelete').click(function() {
        Swal.fire({
            title: 'Hapus Dokumen?',
            text: "Dokumen akan dihapus",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Dokumen berhasil dihapus',
                    timer: 2000,
                    showConfirmButton: false
                });
            }
        });
    });
});
</script>
@endpush
