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
                            Kelola master dokumen perizinan dan persyaratan
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
                <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-format-list-bulleted me-2 text-primary"></i>
                        Daftar Dokumen Izin
                    </h5>
                    <div class="ms-auto">
                        <button class="btn btn-gradient-primary" style="padding: 8px 20px; font-size: 0.95rem; white-space: nowrap;" onclick="$('#modalUploadDokumen').modal('show')">
                            <i class="mdi mdi-plus me-1"></i>
                            <span>Tambah Dokumen</span>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Filter Section - Selalu tampil -->
                    <div class="filter-card mb-4">
                        <div class="card-body">
                            <h6 class="card-title mb-3" style="font-size: 1rem;">
                                <i class="mdi mdi-filter-outline me-1" style="color: #9a55ff;"></i>
                                Filter Data Dokumen
                            </h6>

                            <!-- FILTER UNTUK MOBILE -->
                            <div class="d-block d-md-none">
                                <form method="GET" action="{{ route('dokument.index') }}">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">
                                            <i class="mdi mdi-magnify me-1" style="color: #9a55ff;"></i>
                                            Cari Dokumen
                                        </label>
                                        <input type="text" class="form-control" name="search" value="{{ request('search') }}"
                                            placeholder="Cari nama dokumen..." style="height: 45px;">
                                    </div>

                                    <div class="row g-2 mb-3">
                                        <div class="col-6">
                                            <label class="form-label fw-semibold">
                                                <i class="mdi mdi-flag me-1" style="color: #9a55ff;"></i>Has Expiry
                                            </label>
                                            <select class="form-control" name="has_expiry" style="height: 45px;">
                                                <option value="">Semua</option>
                                                <option value="yes" {{ request('has_expiry') == 'yes' ? 'selected' : '' }}>Yes</option>
                                                <option value="no" {{ request('has_expiry') == 'no' ? 'selected' : '' }}>No</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label fw-semibold">
                                                <i class="mdi mdi-counter me-1" style="color: #9a55ff;"></i>Tampil
                                            </label>
                                            <select class="form-control" name="per_page" style="height: 45px;">
                                                <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                                <option value="15" {{ request('per_page', 10) == 15 ? 'selected' : '' }}>15</option>
                                                <option value="25" {{ request('per_page', 10) == 25 ? 'selected' : '' }}>25</option>
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
                                            <a href="{{ route('dokument.index') }}" class="btn btn-gradient-secondary w-100 py-2 d-flex align-items-center justify-content-center">
                                                <i class="mdi mdi-refresh me-1"></i> Reset
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- FILTER UNTUK TABLET & DESKTOP -->
                            <div class="d-none d-md-block">
                                <form method="GET" action="{{ route('dokument.index') }}">
                                    <div class="row g-2 align-items-end">
                                        <div class="col-md-4">
                                            <label class="form-label">
                                                <i class="mdi mdi-magnify me-1" style="color: #9a55ff;"></i>
                                                Cari Dokumen
                                            </label>
                                            <input type="text" class="form-control" name="search" value="{{ request('search') }}"
                                                placeholder="Cari nama dokumen...">
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label">
                                                <i class="mdi mdi-flag me-1" style="color: #9a55ff;"></i>Has Expiry
                                            </label>
                                            <select class="form-control" name="has_expiry">
                                                <option value="">Semua</option>
                                                <option value="yes" {{ request('has_expiry') == 'yes' ? 'selected' : '' }}>Yes</option>
                                                <option value="no" {{ request('has_expiry') == 'no' ? 'selected' : '' }}>No</option>
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label">
                                                <i class="mdi mdi-counter me-1" style="color: #9a55ff;"></i>Tampil
                                            </label>
                                            <select class="form-control" name="per_page">
                                                <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                                <option value="15" {{ request('per_page', 10) == 15 ? 'selected' : '' }}>15</option>
                                                <option value="25" {{ request('per_page', 10) == 25 ? 'selected' : '' }}>25</option>
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
                                            <a href="{{ route('dokument.index') }}" class="btn btn-gradient-secondary w-100 d-flex align-items-center justify-content-center" title="Reset">
                                                <i class="mdi mdi-refresh me-1"></i> Reset
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel Dokumen -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle" id="tableDokumen" {{ $documentTypes->count() > 0 ? 'data-use-datatables=true' : '' }}>
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center" width="5%">No</th>
                                    <th width="35%">Nama Dokumen</th>
                                    <th width="20%">Code</th>
                                    <th class="text-center" width="20%">Has Expiry</th>
                                    <th class="text-center" width="20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($documentTypes as $item)
                                <tr>
                                    <td class="text-center fw-semibold">{{ $loop->iteration }}</td>
                                    <td class="fw-semibold">{{ $item->name }}</td>
                                    <td><span class="badge bg-light text-dark">{{ $item->code }}</span></td>
                                    <td class="text-center">
                                        @if($item->has_expiry)
                                            <span class="badge bg-warning text-dark">
                                                <i class="mdi mdi-calendar-clock me-1"></i>Yes
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">
                                                <i class="mdi mdi-calendar-remove me-1"></i>No
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <!-- EDIT -->
                                            <button type="button" class="btn btn-sm btn-outline-warning btn-action btn-edit"
                                                data-id="{{ $item->id }}">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>

                                            <!-- DELETE -->
                                            <form action="{{ route('document-types.destroy', $item->id) }}" method="POST" class="m-0 form-delete">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger btn-action">
                                                    <i class="mdi mdi-delete"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-5">
                                        <i class="mdi mdi-file-document-off" style="font-size: 3rem; opacity: 0.3;"></i>
                                        <p class="mt-2 mb-0">Tidak ada data dokumen yang tersedia.</p>
                                        <p class="text-muted small">Silahkan tambahkan data dokumen baru.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Section - Tampil jika ada data -->
                    @if($documentTypes->count() > 0)
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                        <div class="pagination-info mb-2 mb-sm-0">
                            <i class="mdi mdi-information-outline me-1 text-primary"></i>
                            Menampilkan
                            <span class="fw-bold">{{ $documentTypes->firstItem() }}</span>
                            -
                            <span class="fw-bold">{{ $documentTypes->lastItem() }}</span>
                            dari
                            <span class="fw-bold">{{ $documentTypes->total() }}</span>
                            data dokumen
                        </div>

                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0" style="gap: 2px;">
                                {{-- Previous Page Link --}}
                                @if($documentTypes->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link" aria-label="Previous">
                                            <i class="mdi mdi-chevron-left"></i>
                                        </span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $documentTypes->previousPageUrl() }}" aria-label="Previous">
                                            <i class="mdi mdi-chevron-left"></i>
                                        </a>
                                    </li>
                                @endif

                                {{-- Page Links --}}
                                @foreach ($documentTypes->getUrlRange(1, $documentTypes->lastPage()) as $page => $url)
                                    <li class="page-item {{ $documentTypes->currentPage() == $page ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach

                                {{-- Next Page Link --}}
                                @if($documentTypes->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $documentTypes->nextPageUrl() }}" aria-label="Next">
                                            <i class="mdi mdi-chevron-right"></i>
                                        </a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <span class="page-link" aria-label="Next">
                                            <i class="mdi mdi-chevron-right"></i>
                                        </span>
                                    </li>
                                @endif
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

<!-- MODAL TAMBAH DOKUMEN -->
<div class="modal fade" id="modalUploadDokumen" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="mdi mdi-file-document-plus-outline"></i>
                    Tambah Master Dokumen
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('document-types.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="modal-form-group">
                        <label class="form-label fw-semibold">
                            Nama Dokumen <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="name" class="modal-form-control"
                            placeholder="Contoh: IMB, PBG, SLF" required>
                    </div>

                    <div class="modal-form-group">
                        <label class="form-label fw-semibold">
                            Code <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="code" class="modal-form-control" placeholder="imb / pbg / slf" required>
                        <small class="text-muted mt-1 d-block">
                            <i class="mdi mdi-information-outline me-1"></i>
                            Gunakan kode unik (huruf kecil tanpa spasi)
                        </small>
                    </div>

                    <div class="modal-switch-container">
                        <div>
                            <span class="fw-semibold d-block">Dokumen memiliki masa berlaku</span>
                            <small class="text-muted">
                                Aktifkan jika dokumen memiliki tanggal kadaluarsa
                            </small>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="has_expiry" value="1" id="hasExpirySwitch">
                        </div>
                    </div>
                </div>

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
                    <div class="modal-form-group">
                        <label class="form-label fw-semibold">
                            Nama Dokumen <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="name" id="editName" class="modal-form-control" placeholder="Masukkan nama dokumen" required>
                    </div>

                    <div class="modal-form-group">
                        <label class="form-label fw-semibold">
                            Code <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="code" id="editCode" class="modal-form-control" placeholder="Contoh: SHM" required>
                    </div>

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
                            <input class="form-check-input" type="checkbox" name="has_expiry" value="1" id="editHasExpiry">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="modal-btn modal-btn-outline" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="modal-btn modal-btn-primary">Update</button>
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
    // Inisialisasi DataTables hanya jika ada data
    const tableElement = document.getElementById('tableDokumen');
    if (tableElement && tableElement.getAttribute('data-use-datatables') === 'true') {
        // Destroy existing DataTable if any
        if ($.fn.DataTable.isDataTable('#tableDokumen')) {
            $('#tableDokumen').DataTable().destroy();
        }

        // Initialize DataTable with minimal features
        $('#tableDokumen').DataTable({
            responsive: true,
            ordering: true,
            paging: false,
            info: false,
            searching: false,
            lengthChange: false,
            destroy: true,
            language: {
                emptyTable: "Belum ada data dokumen izin",
                zeroRecords: "Data tidak ditemukan",
            },
            columnDefs: [
                { orderable: false, targets: [0, 4] } // Kolom No dan Aksi tidak bisa diurutkan
            ]
        });
    }

    // Handle Edit Button
    $(document).on('click', '.btn-edit', function() {
        let id = $(this).data('id');

        $.ajax({
            url: '/dashboard-dokument/' + id + '/edit',
            type: 'GET',
            success: function(response) {
                $('#editName').val(response.name);
                $('#editCode').val(response.code);
                $('#editHasExpiry').prop('checked', response.has_expiry == 1);
                $('#formEditDokumen').attr('action', '/dashboard-dokument/' + id + '/update');
                $('#modalEditDokumen').modal('show');
            },
            error: function() {
                Swal.fire('Error', 'Data tidak ditemukan', 'error');
            }
        });
    });

    // Handle Delete Confirmation
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

    // Sweet Alert for Session
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2000
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: "{{ session('error') }}",
            confirmButtonColor: '#d33'
        });
    @endif

    @if($errors->any())
        Swal.fire({
            icon: 'warning',
            title: 'Validasi Gagal',
            html: `{!! implode('<br>', $errors->all()) !!}`
        });
    @endif
});
</script>
@endpush
