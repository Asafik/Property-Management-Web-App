    @extends('layouts.partial.app')

    @section('title', 'Dokumen Izin - Property Management App')

    @section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/dokument/dokument.css') }}">
        <div class="container-fluid p-2 p-sm-3 p-md-4">
            <!-- Header Dashboard -->
            <div class="row mb-3 mb-sm-3 mb-md-4">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="text-dark mb-1">
                                    <i class="mdi mdi-file-document-multiple me-2" style="color: #9a55ff;"></i>
                                    Dokumen Izin
                                </h3>
                                <p class="text-muted mb-0">
                                    <i class="mdi mdi-information-outline me-1"></i>
                                    Kelola dokumen perizinan proyek seperti IMB, AMDAL, Izin Cut and Fill, dll
                                </p>
                            </div>
                            <div class="d-none d-sm-block">
                                <i class="mdi mdi-file-document" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Data Dokumen Izin -->
            <div class="row mt-2 mt-sm-2 mt-md-3">
                <div class="col-12">
                    <div class="card">
                        <div
                            class="card-header bg-white d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                            <h5 class="card-title mb-2 mb-md-0">
                                <i class="mdi mdi-format-list-bulleted me-2 text-primary"></i>
                                Daftar Dokumen Izin
                            </h5>
                            <div class="d-flex gap-2">
                                <button class="btn btn-sm btn-gradient-primary"
                                    onclick="$('#modalUploadDokumen').modal('show')">
                                    <i class="mdi mdi-upload me-1"></i><span class="d-none d-sm-inline">Tambah Dokumen</span>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Filter Section -->
                            <div class="filter-card">
                                <div class="card-body">
                                    <h6 class="card-title mb-3" style="font-size: 1rem;">
                                        <i class="mdi mdi-filter-outline me-1"></i>Filter Data
                                    </h6>

                                    <!-- FILTER UNTUK MOBILE -->
                                    <div class="d-block d-md-none">
                                        <div class="mb-3">
                                            <label class="form-label">
                                                <i class="mdi mdi-magnify me-1"></i>Cari Dokumen
                                            </label>
                                            <input type="text" class="form-control" placeholder="Cari nama dokumen...">
                                        </div>

                                        <div class="row g-2">
                                            <div class="col-6">
                                                <label class="form-label">
                                                    <i class="mdi mdi-shape-outline me-1"></i>Jenis Izin
                                                </label>
                                                <select class="form-control">
                                                    <option value="">Semua</option>
                                                    <option value="imb">IMB</option>
                                                    <option value="amdal">AMDAL</option>
                                                    <option value="cutfill">Izin Cut and Fill</option>
                                                    <option value="lokasi">Izin Lokasi</option>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">
                                                    <i class="mdi mdi-flag me-1"></i>Status
                                                </label>
                                                <select class="form-control">
                                                    <option value="">Semua</option>
                                                    <option value="lengkap">Lengkap</option>
                                                    <option value="proses">Diproses</option>
                                                    <option value="kurang">Kurang</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row g-2 mt-2">
                                            <div class="col-6">
                                                <label class="form-label">
                                                    <i class="mdi mdi-counter me-1"></i>Tampil
                                                </label>
                                                <select class="form-control">
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select>
                                            </div>
                                            <div class="col-6 d-flex align-items-end">
                                                <button type="button" class="btn btn-gradient-secondary w-100">
                                                    <i class="mdi mdi-refresh me-1"></i> Reset
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- FILTER UNTUK TABLET & DESKTOP - DIPERBAIKI SEJAJAR -->
                                    <div class="d-none d-md-block">
                                        <div class="filter-row">
                                            <div class="filter-col" style="flex: 2;">
                                                <label class="form-label">
                                                    <i class="mdi mdi-magnify me-1"></i>Cari Dokumen
                                                </label>
                                                <input type="text" class="form-control" placeholder="Cari nama dokumen...">
                                            </div>
                                            {{-- <div class="filter-col">
                                                <label class="form-label">
                                                    <i class="mdi mdi-shape-outline me-1"></i>Jenis Izin
                                                </label>
                                                <select class="form-control">
                                                    <option value="">Semua</option>
                                                    <option value="imb">IMB</option>
                                                    <option value="amdal">AMDAL</option>
                                                    <option value="cutfill">Izin Cut and Fill</option>
                                                    <option value="lokasi">Izin Lokasi</option>
                                                </select>
                                            </div> --}}
                                            <div class="filter-col">
                                                <label class="form-label">
                                                    <i class="mdi mdi-flag me-1"></i>Has Expiry
                                                </label>
                                                <select class="form-control">
                                                    <option value="">Semua</option>
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                </select>
                                            </div>
                                            <div class="filter-col">
                                                <label class="form-label">
                                                    <i class="mdi mdi-counter me-1"></i>Tampil
                                                </label>
                                                <select class="form-control">
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select>
                                            </div>
                                            <div class="filter-col-auto">
                                                <label class="form-label" style="visibility: hidden;">Filter</label>
                                                <button type="button" class="btn btn-gradient-primary btn-filter-reset">
                                                    <i class="mdi mdi-filter"></i>
                                                </button>
                                            </div>
                                            <div class="filter-col-auto">
                                                <label class="form-label" style="visibility: hidden;">Reset</label>
                                                <button type="button" class="btn btn-gradient-secondary btn-filter-reset">
                                                    <i class="mdi mdi-refresh"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover align-middle" id="tableDokumen" style="width:100%">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center" width="50">No</th>
                                            <th>Nama Dokumen</th>
                                            <th>Code</th>
                                            <th class="text-center">Has Expiry</th>
                                            <th class="text-center" width="150">Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($documentTypes as $item)
                                            <tr>
                                                <td class="text-center fw-semibold">
                                                    {{ $loop->iteration }}
                                                </td>

                                                <td class="fw-semibold">
                                                    {{ $item->name }}
                                                </td>

                                                <td>
                                                    {{ $item->code }}
                                                </td>

                                                <td class="text-center">
                                                    @if ($item->has_expiry)
                                                        <span class="badge bg-warning">Yes</span>
                                                    @else
                                                        <span class="badge bg-secondary">No</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center gap-1">

                                                        <!-- EDIT -->
                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-warning btn-action btn-edit"
                                                            data-id="{{ $item->id }}">
                                                            <i class="mdi mdi-pencil"></i>
                                                        </button>

                                                        <!-- DELETE -->
                                                        <form action="{{ route('document-types.destroy', $item->id) }}"
                                                            method="POST"
                                                            class="m-0 form-delete">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="submit"
                                                                class="btn btn-sm btn-outline-danger btn-action">
                                                                <i class="mdi mdi-delete"></i>
                                                            </button>
                                                        </form>

                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            {{-- BIARKAN KOSONG, DataTables akan handle emptyTable --}}
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-3">
                                <div class="pagination-info mb-2 mb-sm-0">
                                    <i class="mdi mdi-information-outline me-1"></i>
                                    Menampilkan 1 - 9 dari 9 data
                                </div>
                                <div>
                                    <nav>
                                        <ul class="pagination">
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#" tabindex="-1"><i
                                                        class="mdi mdi-chevron-left"></i></a>
                                            </li>
                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item">
                                                <a class="page-link" href="#"><i class="mdi mdi-chevron-right"></i></a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi Bawah -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="d-flex flex-wrap gap-2">
                                <a href="{{ route('dashboard') }}" class="btn btn-gradient-secondary">
                                    <i class="mdi mdi-arrow-left me-1"></i>Kembali ke Dashboard
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL UPLOAD DOKUMEN IZIN - DIPERBAIKI -->
        <div class="modal fade" id="modalUploadDokumen" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <!-- HEADER -->
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="mdi mdi-file-document-plus-outline"></i>
                            Tambah Master Dokumen
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- BODY -->
                    <form method="POST" action="{{ route('document-types.store') }}">
                        @csrf

                        <div class="modal-body">

                            <!-- Document Name -->
                            <div class="modal-form-group">
                                <label class="form-label fw-semibold">
                                    Nama Dokumen <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="name" class="modal-form-control"
                                    placeholder="Contoh: IMB, PBG, SLF" required>
                            </div>

                            <!-- Code -->
                            <div class="modal-form-group">
                                <label class="form-label fw-semibold">
                                    Code <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="code" class="modal-form-control" placeholder="imb / pbg / slf"
                                    required>
                                <small class="text-muted mt-1 d-block">
                                    <i class="mdi mdi-information-outline me-1"></i>
                                    Gunakan kode unik (huruf kecil tanpa spasi)
                                </small>
                            </div>

                            <!-- Has Expiry - Styling lebih baik -->
                            <div class="modal-switch-container">
                                <div>
                                    <span class="fw-semibold d-block">Dokumen memiliki masa berlaku</span>
                                    <small class="text-muted">
                                        Aktifkan jika dokumen memiliki tanggal kadaluarsa
                                    </small>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="has_expiry" value="1"
                                        id="hasExpirySwitch">
                                </div>
                            </div>

                        </div>

                        <!-- FOOTER -->
                        <div class="modal-footer">
                            <button type="button" class="modal-btn modal-btn-outline" data-bs-dismiss="modal">
                                <i class="mdi mdi-close me-1"></i> Batal
                            </button>
                            <button type="submit" class="modal-btn modal-btn-primary">
                                <i class="mdi mdi-content-save me-1"></i> Simpan
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- MODAL EDIT DOKUMEN -->
        <div class="modal fade" id="modalEditDokumen" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="mdi mdi-pencil-box-outline"></i>
                            Edit Master Dokumen
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form method="POST" id="formEditDokumen">
                        @csrf
                        @method('PUT')

                        <div class="modal-body">

                            <!-- Nama Dokumen -->
                            <div class="modal-form-group">
                                <label class="form-label fw-semibold">
                                    Nama Dokumen <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                    name="name"
                                    id="editName"
                                    class="modal-form-control"
                                    placeholder="Masukkan nama dokumen"
                                    required>
                            </div>

                            <!-- Code -->
                            <div class="modal-form-group">
                                <label class="form-label fw-semibold">
                                    Code <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                    name="code"
                                    id="editCode"
                                    class="modal-form-control"
                                    placeholder="Contoh: SHM"
                                    required>
                            </div>

                            <!-- Switch Expiry -->
                            <div class="modal-switch-container">
                                <div>
                                    <span class="fw-semibold d-block">
                                        Dokumen memiliki masa berlaku
                                    </span>
                                    <small class="text-muted">
                                        Aktifkan jika dokumen memiliki tanggal kadaluarsa
                                    </small>
                                </div>

                                <div class="form-check form-switch">
                                    <input class="form-check-input"
                                        type="checkbox"
                                        name="has_expiry"
                                        value="1"
                                        id="editHasExpiry">
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button"
                                class="modal-btn modal-btn-outline"
                                data-bs-dismiss="modal">
                                Batal
                            </button>

                            <button type="submit"
                                class="modal-btn modal-btn-primary">
                                Update
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    @endsection

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(document).ready(function() {
                // Inisialisasi DataTables jika diperlukan
                if ($.fn.DataTable && !$.fn.DataTable.isDataTable('#tableDokumen')) {
                    $('#tableDokumen').DataTable({
                        responsive: true,
                        paging: false,
                        info: false,
                        searching: false,
                        lengthChange: false,
                        ordering: true,
                        language: {
                            emptyTable: "Belum ada data dokumen izin",
                            zeroRecords: "Data tidak ditemukan",
                        },
                        columnDefs: [{
                            orderable: false,
                            targets: [0, 4] // Kolom No dan Aksi
                        }]
                    });
                }
            });

              // CONFIRM Edit
            $(document).on('click', '.btn-edit', function() {

                let id = $(this).data('id');

                $.ajax({
                    url: '/dashboard-dokument/' + id + '/edit',
                    type: 'GET',
                    success: function(response) {

                        // Isi field
                        $('#editName').val(response.name);
                        $('#editCode').val(response.code);

                        if (response.has_expiry == 1) {
                            $('#editHasExpiry').prop('checked', true);
                        } else {
                            $('#editHasExpiry').prop('checked', false);
                        }

                        // Set action form update
                        $('#formEditDokumen').attr(
                            'action',
                            '/dashboard-dokument/' + id + '/update'
                        );

                        // Tampilkan modal
                        $('#modalEditDokumen').modal('show');
                    },
                    error: function() {
                        Swal.fire('Error', 'Data tidak ditemukan', 'error');
                    }
                });

            });

            // CONFIRM DELETE
            $('.form-delete').on('submit', function(e) {
                e.preventDefault();

                let form = this;

                Swal.fire({
                    title: 'Yakin hapus data?',
                    text: "Data tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

            // SWAL SESSION
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 2000
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "{{ session('error') }}",
                    confirmButtonColor: '#d33'
                });
            @endif

            @if ($errors->any())
                Swal.fire({
                    icon: 'warning',
                    title: 'Validasi Gagal',
                    html: `{!! implode('<br>', $errors->all()) !!}`
                });
            @endif
        </script>
    @endpush
