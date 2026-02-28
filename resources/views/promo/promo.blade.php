@extends('layouts.partial.app')

@section('title', 'Manajemen Promo - Property Management App')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/promo/promo.css') }}">
    <div class="container-fluid p-2 p-sm-3 p-md-4">
        <!-- Header Dashboard -->
        <div class="row mb-3 mb-sm-3 mb-md-4">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="text-dark mb-1">
                                <i class="mdi mdi-tag-multiple me-2" style="color: #9a55ff;"></i>
                                Manajemen Promo & Biaya Tambahan
                            </h3>
                            <p class="text-muted mb-0">
                                <i class="mdi mdi-information-outline me-1"></i>
                                Kelola promo, diskon, dan biaya tambahan seperti PPN, kanopi, pagar, dll
                            </p>
                        </div>
                        <div class="d-none d-sm-block">
                            <i class="mdi mdi-percent" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Data Promo -->
        <div class="row mt-2 mt-sm-2 mt-md-3">
            <div class="col-12">
                <div class="card">
                    <div
                        class="card-header bg-white d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                        <h5 class="card-title mb-2 mb-md-0">
                            <i class="mdi mdi-format-list-bulleted me-2 text-primary"></i>
                            Daftar Promo & Biaya Tambahan
                        </h5>
                        <div class="d-flex gap-2">
                            <button class="btn btn-sm btn-gradient-primary" onclick="$('#modalTambahPromo').modal('show')">
                                <i class="mdi mdi-plus me-1"></i><span class="d-none d-sm-inline">Tambah Promo</span>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Filter Section - HANYA TAMPIL JIKA ADA DATA -->
                        @if($promo->count() > 0)
                        <div class="filter-card">
                            <div class="card-body">
                                <h6 class="card-title mb-3" style="font-size: 1rem;">
                                    <i class="mdi mdi-filter-outline me-1"></i>Filter Data
                                </h6>

                                <!-- FILTER UNTUK MOBILE -->
                                <div class="d-block d-md-none">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            <i class="mdi mdi-magnify me-1"></i>Cari Promo
                                        </label>
                                        <input type="text" class="form-control" id="searchMobile" placeholder="Cari nama promo...">
                                    </div>

                                    <div class="row g-2">
                                        <div class="col-6">
                                            <label class="form-label">
                                                <i class="mdi mdi-shape-outline me-1"></i>Kategori
                                            </label>
                                            <select class="form-control" id="kategoriMobile">
                                                <option value="">Semua</option>
                                                <option value="promo">Promo Diskon</option>
                                                <option value="biaya">Biaya Tambahan</option>
                                                <option value="fasilitas">Fasilitas</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">
                                                <i class="mdi mdi-counter me-1"></i>Tampil
                                            </label>
                                            <select class="form-control" id="lengthMobile">
                                                <option value="10">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row g-2 mt-2">
                                        <div class="col-6">
                                            <button type="button" class="btn btn-gradient-primary w-100" id="filterMobile">
                                                <i class="mdi mdi-filter me-1"></i> Filter
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <button type="button" class="btn btn-gradient-secondary w-100" id="resetMobile">
                                                <i class="mdi mdi-refresh me-1"></i> Reset
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- FILTER UNTUK TABLET & DESKTOP -->
                                <div class="d-none d-md-block">
                                    <div class="row g-2 align-items-end">
                                        <div class="col-md-4">
                                            <label class="form-label">
                                                <i class="mdi mdi-magnify me-1"></i>Cari Promo
                                            </label>
                                            <input type="text" class="form-control" id="searchDesktop" placeholder="Cari nama promo...">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">
                                                <i class="mdi mdi-shape-outline me-1"></i>Kategori
                                            </label>
                                            <select class="form-control" id="kategoriDesktop">
                                                <option value="">Semua</option>
                                                <option value="promo">Promo Diskon</option>
                                                <option value="biaya">Biaya Tambahan</option>
                                                <option value="fasilitas">Fasilitas</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">
                                                <i class="mdi mdi-counter me-1"></i>Tampil
                                            </label>
                                            <select class="form-control" id="lengthDesktop">
                                                <option value="10">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-gradient-primary w-100" id="filterDesktop">
                                                <i class="mdi mdi-filter me-1"></i> Filter
                                            </button>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-gradient-secondary w-100 btn-icon-only"
                                                title="Reset" id="resetDesktop">
                                                <i class="mdi mdi-refresh"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Tabel Promo -->
                        <div class="table-responsive">
                            <table class="table table-hover" id="tablePromo" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center"><i class="mdi mdi-counter me-1"></i>No</th>
                                        <th><i class="mdi mdi-tag me-1"></i>Nama Promo</th>
                                        <th><i class="mdi mdi-shape-outline me-1"></i>Kategori</th>
                                        <th><i class="mdi mdi-calculator me-1"></i>Tipe</th>
                                        <th><i class="mdi mdi-currency-usd me-1"></i>Nilai</th>
                                        <th><i class="mdi mdi-calendar me-1"></i>Berlaku</th>
                                        <th><i class="mdi mdi-flag me-1"></i>Status</th>
                                        <th class="text-center"><i class="mdi mdi-cog me-1"></i>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($promo as $p)
                                        <tr>
                                            <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-sale text-primary me-2"
                                                        style="font-size: 1rem;"></i>
                                                    <span class="fw-bold">{{ $p->name }}</span>
                                                </div>
                                            </td>
                                            <td>{{ $p->category }}</td>
                                            <td>{{ $p->type == 'persen' ? 'Persentase' : 'Nominal' }}</td>
                                            <td>
                                                @if($p->type == 'persen')
                                                    {{ $p->value }}%
                                                @else
                                                    Rp {{ number_format($p->value, 0, ',', '.') }}
                                                @endif
                                            </td>
                                            <td>{{ $p->duration_days ? $p->duration_days . ' hari' : 'Selalu' }}</td>
                                            <td>
                                                @if($p->status == 'aktif')
                                                    <span class="badge badge-gradient-success">
                                                        <i class="mdi mdi-check-circle me-1"></i>Aktif
                                                    </span>
                                                @else
                                                    <span class="badge badge-gradient-secondary">
                                                        <i class="mdi mdi-close-circle me-1"></i>Tidak Aktif
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-1">
                                                    <button class="btn btn-outline-warning btn-sm btn-edit"
                                                        title="Edit"
                                                        data-id="{{ $p->id }}">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </button>
                                                    <button class="btn btn-outline-danger btn-sm btn-delete"
                                                        title="Hapus"
                                                        data-id="{{ $p->id }}"
                                                        data-name="{{ $p->name }}">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center text-muted py-4">
                                                <i class="mdi mdi-emoticon-sad-outline me-2"
                                                    style="font-size: 1.5rem;"></i>
                                                Tidak ada data promo atau biaya tambahan yang tersedia.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination UI - HANYA TAMPIL JIKA ADA DATA -->
                        @if($promo->count() > 0)
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-3">
                            <div class="pagination-info mb-2 mb-sm-0">
                                <i class="mdi mdi-information-outline me-1"></i>
                                Menampilkan 1-{{ min(10, $promo->count()) }} dari {{ $promo->count() }} promo
                            </div>
                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0"
                                    style="gap: 2px;">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1" aria-label="Previous">
                                            <i class="mdi mdi-chevron-left"></i>
                                        </a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    @if($promo->count() > 10)
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    @endif
                                    @if($promo->count() > 20)
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    @endif
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Next">
                                            <i class="mdi mdi-chevron-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi Bawah -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="d-flex flex-column flex-sm-row justify-content-start">
                            <a href="{{ route('dashboard') }}" class="btn btn-gradient-secondary">
                                <i class="mdi mdi-arrow-left me-1"></i>Kembali ke Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL TAMBAH PROMO -->
    <div class="modal fade" id="modalTambahPromo" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="mdi mdi-tag-plus me-2" style="color: #9a55ff;"></i>
                        Tambah Promo / Biaya Baru
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('promo.store') }}" method="POST" id="formTambahPromo">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="modal-form-group">
                                    <label>
                                        <i class="mdi mdi-tag me-1"></i>Nama Promo <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="name" class="modal-form-control" required
                                        placeholder="Contoh: Diskon Early Bird">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="modal-form-group">
                                    <label>
                                        <i class="mdi mdi-shape-outline me-1"></i>Kategori <span class="text-danger">*</span>
                                    </label>
                                    <select class="modal-form-control" name="category" required>
                                        <option value="promo">Promo Diskon</option>
                                        <option value="biaya">Biaya Tambahan</option>
                                        <option value="fasilitas">Fasilitas</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="modal-form-group">
                                    <label>
                                        <i class="mdi mdi-calculator me-1"></i>Tipe <span class="text-danger">*</span>
                                    </label>
                                    <select class="modal-form-control" name="type" id="tipePromo" required>
                                        <option value="persen">Persentase (%)</option>
                                        <option value="nominal">Nominal (Rp)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="modal-form-group">
                                    <label>
                                        <i class="mdi mdi-currency-usd me-1"></i>Nilai <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="value" class="modal-form-control" id="nilaiPromo" required
                                        placeholder="Contoh: 10 atau 500000">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="modal-form-group">
                                    <label>
                                        <i class="mdi mdi-calendar me-1"></i>Berlaku <span class="text-danger">*</span>
                                    </label>
                                    <select class="modal-form-control" name="validity_period" id="berlaku" required>
                                        <option value="selalu">Selalu</option>
                                        <option value="periode">Periode Tertentu</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="periodeContainer" style="display: none;">
                            <div class="col-md-6">
                                <div class="modal-form-group">
                                    <label>
                                        <i class="mdi mdi-calendar-start me-1"></i>Tanggal Mulai <span class="text-danger">*</span>
                                    </label>
                                    <input type="date" name="start_date" class="modal-form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="modal-form-group">
                                    <label>
                                        <i class="mdi mdi-calendar-end me-1"></i>Tanggal Berakhir <span class="text-danger">*</span>
                                    </label>
                                    <input type="date" name="end_date" class="modal-form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="modal-form-group">
                                    <label>
                                        <i class="mdi mdi-flag me-1"></i>Status <span class="text-danger">*</span>
                                    </label>
                                    <select class="modal-form-control" name="status" required>
                                        <option value="aktif">Aktif</option>
                                        <option value="tidak_aktif">Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="modal-form-group">
                                    <label>
                                        <i class="mdi mdi-note-text me-1"></i>Keterangan <span class="text-danger">*</span>
                                    </label>
                                    <textarea name="description" class="modal-form-control" rows="3" required placeholder="Deskripsi promo..."></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-3">
                            <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-gradient-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL EDIT PROMO -->
    <div class="modal fade" id="modalEditPromo" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="mdi mdi-pencil me-2" style="color: #9a55ff;"></i>
                        Edit Promo
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="formEditPromo">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="modal-form-group">
                                    <label>
                                        <i class="mdi mdi-tag me-1"></i>Nama Promo <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="name" class="modal-form-control" id="editNama" required
                                        placeholder="Contoh: Diskon Early Bird">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="modal-form-group">
                                    <label>
                                        <i class="mdi mdi-shape-outline me-1"></i>Kategori <span class="text-danger">*</span>
                                    </label>
                                    <select class="modal-form-control" name="category" id="editKategori" required>
                                        <option value="promo">Promo Diskon</option>
                                        <option value="biaya">Biaya Tambahan</option>
                                        <option value="fasilitas">Fasilitas</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="modal-form-group">
                                    <label>
                                        <i class="mdi mdi-calculator me-1"></i>Tipe <span class="text-danger">*</span>
                                    </label>
                                    <select class="modal-form-control" name="type" id="editTipe" required>
                                        <option value="persen">Persentase (%)</option>
                                        <option value="nominal">Nominal (Rp)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="modal-form-group">
                                    <label>
                                        <i class="mdi mdi-currency-usd me-1"></i>Nilai <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="value" class="modal-form-control" id="editNilai" required
                                        placeholder="Contoh: 10 atau 500000">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="modal-form-group">
                                    <label>
                                        <i class="mdi mdi-calendar me-1"></i>Berlaku <span class="text-danger">*</span>
                                    </label>
                                    <select class="modal-form-control" name="validity_period" id="editBerlaku" required>
                                        <option value="selalu">Selalu</option>
                                        <option value="periode">Periode Tertentu</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="editPeriodeContainer" style="display: none;">
                            <div class="col-md-6">
                                <div class="modal-form-group">
                                    <label>
                                        <i class="mdi mdi-calendar-start me-1"></i>Tanggal Mulai <span class="text-danger">*</span>
                                    </label>
                                    <input type="date" name="start_date" class="modal-form-control" id="editStart">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="modal-form-group">
                                    <label>
                                        <i class="mdi mdi-calendar-end me-1"></i>Tanggal Berakhir <span class="text-danger">*</span>
                                    </label>
                                    <input type="date" name="end_date" class="modal-form-control" id="editEnd">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="modal-form-group">
                                    <label>
                                        <i class="mdi mdi-flag me-1"></i>Status <span class="text-danger">*</span>
                                    </label>
                                    <select class="modal-form-control" name="status" id="editStatus" required>
                                        <option value="aktif">Aktif</option>
                                        <option value="tidak_aktif">Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="modal-form-group">
                                    <label>
                                        <i class="mdi mdi-note-text me-1"></i>Keterangan <span class="text-danger">*</span>
                                    </label>
                                    <textarea name="description" class="modal-form-control" rows="3" id="editDeskripsi" required placeholder="Deskripsi promo..."></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-3">
                            <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-gradient-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(document).ready(function() {
                // Tampilkan SweetAlert untuk session success (default)
                @if (session('success'))
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: '{{ session('success') }}',
                        timer: 2000,
                        showConfirmButton: false
                    });
                @endif

                // Tampilkan SweetAlert untuk session error (default)
                @if (session('error'))
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: '{{ session('error') }}',
                        timer: 2000,
                        showConfirmButton: false
                    });
                @endif

                // Tampilkan SweetAlert untuk error validasi (default)
                @if ($errors->any())
                    let errorMessage = '';
                    @foreach ($errors->all() as $error)
                        errorMessage += '• {{ $error }}\n';
                    @endforeach
                    Swal.fire({
                        icon: 'error',
                        title: 'Validasi Gagal',
                        text: errorMessage,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    });
                @endif

                // Cek apakah ada data promo
                var hasData = {{ $promo->count() > 0 ? 'true' : 'false' }};

                // HANYA inisialisasi DataTables jika ada data
                if (hasData) {
                    $('#tablePromo').DataTable({
                        responsive: true,
                        paging: false,
                        info: false,
                        searching: false,
                        lengthChange: false,
                        ordering: true,
                        language: {
                            emptyTable: "Data promo belum tersedia",
                            zeroRecords: "Data tidak ditemukan",
                        },
                        columnDefs: [{
                            orderable: false,
                            targets: [7]
                        }]
                    });
                }

                // Format Rupiah untuk input nilai jika tipe nominal
                $('#tipePromo, #editTipe').change(function() {
                    let isEdit = $(this).attr('id') === 'editTipe';
                    let nilaiInput = isEdit ? $('#editNilai') : $('#nilaiPromo');

                    if ($(this).val() === 'nominal') {
                        nilaiInput.attr('placeholder', 'Contoh: 500000');
                    } else {
                        nilaiInput.attr('placeholder', 'Contoh: 10');
                    }
                });

                // Format Rupiah on input (hanya untuk modal)
                $('#nilaiPromo, #editNilai').on('input', function() {
                    let isEdit = $(this).attr('id') === 'editNilai';
                    let tipeSelect = isEdit ? $('#editTipe') : $('#tipePromo');

                    if (tipeSelect.val() === 'nominal') {
                        let nilai = this.value.replace(/\D/g, '');
                        if (nilai) {
                            let rupiah = new Intl.NumberFormat('id-ID').format(nilai);
                            this.value = rupiah;
                        }
                    }
                });

                // Toggle periode container
                $('#berlaku').change(function() {
                    if ($(this).val() === 'periode') {
                        $('#periodeContainer').slideDown();
                    } else {
                        $('#periodeContainer').slideUp();
                    }
                });

                $('#editBerlaku').change(function() {
                    if ($(this).val() === 'periode') {
                        $('#editPeriodeContainer').slideDown();
                    } else {
                        $('#editPeriodeContainer').slideUp();
                    }
                });

                // Handle form tambah promo
                $('#formTambahPromo').on('submit', function(e) {
                    e.preventDefault();

                    let form = $(this);

                    // Tampilkan loading
                    Swal.fire({
                        title: 'Menyimpan...',
                        text: 'Mohon tunggu sebentar',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    $.ajax({
                        url: form.attr('action'),
                        type: 'POST',
                        data: form.serialize(),
                        success: function(response) {
                            Swal.close();

                            // Tampilkan notifikasi sukses (default)
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Promo berhasil ditambahkan',
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                $('#modalTambahPromo').modal('hide');
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            Swal.close();

                            let errors = xhr.responseJSON.errors;
                            let errorMessage = '';

                            if (errors) {
                                $.each(errors, function(key, value) {
                                    errorMessage += '• ' + value[0] + '\n';
                                });
                            } else {
                                errorMessage = 'Terjadi kesalahan saat menyimpan data';
                            }

                            Swal.fire({
                                icon: 'error',
                                title: 'Validasi Gagal',
                                text: errorMessage,
                                confirmButtonColor: '#3085d6'
                            });
                        }
                    });
                });

                // Handle edit button click
                $('.btn-edit').click(function() {
                    let id = $(this).data('id');

                    // Tampilkan loading
                    Swal.fire({
                        title: 'Memuat...',
                        text: 'Mengambil data promo',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // Ambil data via AJAX
                    $.ajax({
                        url: '/dashboard-promo/get/' + id,
                        type: 'GET',
                        success: function(response) {
                            Swal.close();

                            if (response.success) {
                                let promo = response.data;

                                // Isi form edit
                                $('#editNama').val(promo.name);
                                $('#editKategori').val(promo.category);
                                $('#editTipe').val(promo.type);
                                $('#editNilai').val(promo.value_formatted || promo.value);
                                $('#editBerlaku').val(promo.validity_period);
                                $('#editStatus').val(promo.status);
                                $('#editDeskripsi').val(promo.description);

                                if (promo.validity_period === 'periode') {
                                    $('#editStart').val(promo.start_date);
                                    $('#editEnd').val(promo.end_date);
                                    $('#editPeriodeContainer').show();
                                } else {
                                    $('#editPeriodeContainer').hide();
                                }

                                // Set action form
                                $('#formEditPromo').attr('action', '/dashboard-promo/' + id);

                                // Tampilkan modal
                                $('#modalEditPromo').modal('show');
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: response.message || 'Gagal mengambil data promo',
                                    confirmButtonColor: '#3085d6'
                                });
                            }
                        },
                        error: function(xhr) {
                            Swal.close();
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Gagal mengambil data promo',
                                confirmButtonColor: '#3085d6'
                            });
                        }
                    });
                });

                // Handle form edit promo
                $('#formEditPromo').on('submit', function(e) {
                    e.preventDefault();

                    let form = $(this);

                    // Tampilkan loading
                    Swal.fire({
                        title: 'Menyimpan...',
                        text: 'Mohon tunggu sebentar',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    $.ajax({
                        url: form.attr('action'),
                        type: 'POST',
                        data: form.serialize(),
                        success: function(response) {
                            Swal.close();

                            // Tampilkan notifikasi sukses (default)
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Promo berhasil diperbarui',
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                $('#modalEditPromo').modal('hide');
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            Swal.close();

                            let errors = xhr.responseJSON.errors;
                            let errorMessage = '';

                            if (errors) {
                                $.each(errors, function(key, value) {
                                    errorMessage += '• ' + value[0] + '\n';
                                });
                            } else {
                                errorMessage = 'Terjadi kesalahan saat menyimpan data';
                            }

                            Swal.fire({
                                icon: 'error',
                                title: 'Validasi Gagal',
                                text: errorMessage,
                                confirmButtonColor: '#3085d6'
                            });
                        }
                    });
                });

                // Handle delete button click
                $('.btn-delete').click(function() {
                    let id = $(this).data('id');
                    let name = $(this).data('name');

                    Swal.fire({
                        title: 'Hapus Promo?',
                        text: `Promo ${name} akan dihapus`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, Hapus',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Tampilkan loading
                            Swal.fire({
                                title: 'Menghapus...',
                                text: 'Mohon tunggu sebentar',
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });

                            $.ajax({
                                url: '/dashboard-promo/' + id,
                                type: 'DELETE',
                                data: {
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(response) {
                                    Swal.close();

                                    if (response.success) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Berhasil!',
                                            text: response.message,
                                            timer: 2000,
                                            showConfirmButton: false
                                        }).then(() => {
                                            location.reload();
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Gagal!',
                                            text: response.message,
                                            confirmButtonColor: '#3085d6'
                                        });
                                    }
                                },
                                error: function(xhr) {
                                    Swal.close();

                                    let message = 'Terjadi kesalahan';
                                    if (xhr.responseJSON && xhr.responseJSON.message) {
                                        message = xhr.responseJSON.message;
                                    }

                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal!',
                                        text: message,
                                        confirmButtonColor: '#3085d6'
                                    });
                                }
                            });
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
