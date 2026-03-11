@extends('layouts.partial.app')

@section('title', 'Master Data PT - Property Management App')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/pt/pt.css') }}">

<style>
/* Style untuk alamat dengan ellipsis */
.address-cell {
    max-width: 250px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    cursor: help;
}

.address-cell i {
    flex-shrink: 0;
    margin-right: 5px;
}

.address-cell span {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

/* Tooltip custom */
.address-tooltip {
    position: relative;
}

.address-tooltip:hover::after {
    content: attr(data-full-address);
    position: absolute;
    bottom: 100%;
    left: 0;
    background: #2c2e3f;
    color: white;
    padding: 8px 12px;
    border-radius: 6px;
    font-size: 12px;
    white-space: normal;
    max-width: 400px;
    min-width: 250px;
    z-index: 1000;
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    pointer-events: none;
    word-wrap: break-word;
    margin-bottom: 5px;
}

.address-tooltip:hover::before {
    content: '';
    position: absolute;
    bottom: 100%;
    left: 20px;
    border-width: 5px;
    border-style: solid;
    border-color: #2c2e3f transparent transparent transparent;
    transform: rotate(180deg);
    margin-bottom: -5px;
    z-index: 1000;
}

/* Fix untuk tombol aksi di mobile */
.action-buttons {
    position: relative;
    z-index: 10;
}

.btn-outline-warning, .btn-outline-danger {
    position: relative;
    z-index: 15;
    pointer-events: auto !important;
    cursor: pointer !important;
}

/* DataTables wrapper styling */
.dataTables_wrapper {
    width: 100%;
    overflow-x: auto;
}

/* Pastikan tabel tetap terlihat */
.table {
    width: 100% !important;
    margin-bottom: 0;
}

/* Fix untuk DataTables di mobile */
@media (max-width: 768px) {
    .dataTables_wrapper .table {
        width: 100% !important;
    }
}
</style>

<div class="container-fluid p-2 p-sm-3 p-md-4">
    <!-- Header Dashboard -->
    <div class="row mb-3 mb-sm-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="text-dark mb-1">
                            <i class="mdi mdi-domain me-2" style="color: #9a55ff;"></i>
                            Master Data PT
                        </h3>
                        <p class="text-muted mb-0">
                            <i class="mdi mdi-information-outline me-1"></i>
                            Kelola data perusahaan (PT) untuk keperluan administrasi
                        </p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-domain" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Data PT -->
    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-format-list-bulleted me-2 text-primary"></i>
                        Daftar Perusahaan (PT)
                    </h5>
                    <div class="ms-auto">
                        <button type="button" class="btn btn-gradient-primary" style="padding: 8px 20px; font-size: 0.95rem; white-space: nowrap;" onclick="$('#modalTambahPT').modal('show')">
                            <i class="mdi mdi-plus me-1"></i>
                            <span>Tambah PT</span>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Filter Section -->
                    <div class="filter-card mb-4">
                        <div class="card-body">
                            <h6 class="card-title mb-3" style="font-size: 1rem;">
                                <i class="mdi mdi-filter-outline me-1" style="color: #9a55ff;"></i>
                                Filter Data PT
                            </h6>

                            <!-- FILTER UNTUK MOBILE -->
                            <div class="d-block d-md-none">
                                <form method="GET" action="{{ route('company-profile.index') }}">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">
                                            <i class="mdi mdi-magnify me-1" style="color: #9a55ff;"></i>
                                            Cari PT
                                        </label>
                                        <input type="text" class="form-control" name="search" value="{{ request('search') }}"
                                            placeholder="Cari nama PT..." style="height: 45px;">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">
                                            <i class="mdi mdi-counter me-1" style="color: #9a55ff;"></i>
                                            Tampil per Halaman
                                        </label>
                                        <select class="form-control" name="per_page" style="height: 45px;">
                                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                            <option value="15" {{ request('per_page', 10) == 15 ? 'selected' : '' }}>15</option>
                                            <option value="25" {{ request('per_page', 10) == 25 ? 'selected' : '' }}>25</option>
                                        </select>
                                    </div>

                                    <div class="row g-2">
                                        <div class="col-6">
                                            <button type="submit" class="btn btn-gradient-primary w-100 py-2 d-flex align-items-center justify-content-center">
                                                <i class="mdi mdi-filter me-1"></i> Filter
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <a href="{{ route('company-profile.index') }}" class="btn btn-gradient-secondary w-100 py-2 d-flex align-items-center justify-content-center">
                                                <i class="mdi mdi-refresh me-1"></i> Reset
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- FILTER UNTUK TABLET & DESKTOP -->
                            <div class="d-none d-md-block">
                                <form method="GET" action="{{ route('company-profile.index') }}">
                                    <div class="row g-2 align-items-end">
                                        <div class="col-md-6">
                                            <label class="form-label">
                                                <i class="mdi mdi-magnify me-1" style="color: #9a55ff;"></i>
                                                Cari PT
                                            </label>
                                            <input type="text" class="form-control" name="search" value="{{ request('search') }}"
                                                placeholder="Cari nama PT...">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">
                                                <i class="mdi mdi-counter me-1" style="color: #9a55ff;"></i>
                                                Tampil per Halaman
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

                                        <div class="col-md-1">
                                            <label class="form-label invisible">Reset</label>
                                            <a href="{{ route('company-profile.index') }}" class="btn btn-gradient-secondary w-100 d-flex align-items-center justify-content-center" title="Reset">
                                                <i class="mdi mdi-refresh"></i>
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel PT -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle" id="tablePT" {{ $companies->count() > 0 ? 'data-use-datatables=true' : '' }}>
                            <thead>
                                <tr>
                                    <th class="text-center" width="5%">No</th>
                                    <th width="25%">Nama PT</th>
                                    <th width="35%">Alamat</th>
                                    <th width="20%">No. Telepon</th>
                                    <th class="text-center" width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($companies as $item)
                                <tr>
                                    <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-domain text-primary me-2" style="font-size: 1.2rem;"></i>
                                            <span class="fw-bold">{{ $item->name }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        @if($item->address)
                                        <div class="d-flex align-items-center address-cell address-tooltip" data-full-address="{{ $item->address }}">
                                            <i class="mdi mdi-map-marker text-danger me-1 flex-shrink-0"></i>
                                            <span>{{ $item->address }}</span>
                                        </div>
                                        @else
                                        <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->phone)
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-whatsapp text-success me-1"></i>
                                            {{ $item->phone }}
                                        </div>
                                        @else
                                        <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1 action-buttons">
                                            <button type="button" class="btn btn-outline-warning btn-sm btnEdit" title="Edit" data-id="{{ $item->id }}">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                            <form action="{{ route('company-profile.destroy', $item->id) }}" method="POST" class="d-inline formDelete">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-outline-danger btn-sm btnDelete" title="Hapus" data-name="{{ $item->name }}">
                                                    <i class="mdi mdi-delete"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-5">
                                        <i class="mdi mdi-domain-off" style="font-size: 3rem; opacity: 0.3;"></i>
                                        <p class="mt-2 mb-0">Tidak ada data PT yang tersedia.</p>
                                        <p class="text-muted small">Silahkan tambahkan data PT baru.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($companies->count() > 0)
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                        <div class="pagination-info mb-2 mb-sm-0">
                            <i class="mdi mdi-information-outline me-1 text-primary"></i>
                            Menampilkan
                            <span class="fw-bold">{{ $companies->firstItem() }}</span>
                            -
                            <span class="fw-bold">{{ $companies->lastItem() }}</span>
                            dari
                            <span class="fw-bold">{{ $companies->total() }}</span>
                            data PT
                        </div>

                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0" style="gap: 2px;">
                                {{-- Previous Page Link --}}
                                @if($companies->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link" aria-label="Previous">
                                            <i class="mdi mdi-chevron-left"></i>
                                        </span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $companies->previousPageUrl() }}" aria-label="Previous">
                                            <i class="mdi mdi-chevron-left"></i>
                                        </a>
                                    </li>
                                @endif

                                {{-- Page Links --}}
                                @foreach ($companies->getUrlRange(1, $companies->lastPage()) as $page => $url)
                                    <li class="page-item {{ $companies->currentPage() == $page ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach

                                {{-- Next Page Link --}}
                                @if($companies->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $companies->nextPageUrl() }}" aria-label="Next">
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

    <!-- Tombol Kembali -->
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

<!-- MODAL TAMBAH PT -->
<div class="modal fade" id="modalTambahPT" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="mdi mdi-domain-plus me-2" style="color: #9a55ff;"></i>
                    Tambah PT Baru
                </h5>
                <button type="button" class="btn-close" onclick="$('#modalTambahPT').modal('hide')" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('company-profile.store') }}" method="POST" id="formTambahPT">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-domain me-1"></i>Nama PT <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="name" class="modal-form-control" placeholder="Contoh: PT Properti Management" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-map-marker me-1"></i>Alamat
                                </label>
                                <textarea name="address" class="modal-form-control" rows="3" placeholder="Alamat lengkap PT..."></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-phone me-1"></i>No. Telepon
                                </label>
                                <input type="text" name="phone" class="modal-form-control" placeholder="Contoh: 081234567890">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-gradient-secondary" onclick="$('#modalTambahPT').modal('hide')">Batal</button>
                <button type="submit" form="formTambahPT" class="btn btn-gradient-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL EDIT PT -->
<div class="modal fade" id="modalEditPT" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="mdi mdi-pencil me-2" style="color: #9a55ff;"></i>
                    Edit PT
                </h5>
                <button type="button" class="btn-close" onclick="$('#modalEditPT').modal('hide')" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="formEditPT">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="modal-form-group">
                                <label>Nama PT <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="editName" class="modal-form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="modal-form-group">
                                <label>Alamat</label>
                                <textarea name="address" id="editAddress" class="modal-form-control" rows="3"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="modal-form-group">
                                <label>No. Telepon</label>
                                <input type="text" name="phone" id="editPhone" class="modal-form-control">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-gradient-secondary" onclick="$('#modalEditPT').modal('hide')">Batal</button>
                <button type="submit" form="formEditPT" class="btn btn-gradient-primary">Update</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    // Inisialisasi DataTables
    const tableElement = document.getElementById('tablePT');
    if (tableElement && tableElement.getAttribute('data-use-datatables') === 'true') {
        if ($.fn.DataTable.isDataTable('#tablePT')) {
            $('#tablePT').DataTable().destroy();
        }

        $('#tablePT').DataTable({
            responsive: true,
            ordering: true,
            paging: false,
            info: false,
            searching: false,
            lengthChange: false,
            destroy: true,
            language: {
                emptyTable: "Data PT belum tersedia",
                zeroRecords: "Data tidak ditemukan",
            },
            columnDefs: [
                { orderable: false, targets: [4] }
            ],
            // Fix untuk mobile
            autoWidth: false,
            deferRender: true
        });
    }

    // ===== HANDLE FORM TAMBAH PT =====
    $('#formTambahPT').on('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Menyimpan...',
            text: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        this.submit();
    });

    // ===== HANDLE EDIT BUTTON CLICK =====
    $(document).on('click', '.btnEdit', function() {
        let id = $(this).data('id');

        Swal.fire({
            title: 'Memuat...',
            text: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        $.ajax({
            url: '/pt/' + id + '/edit',
            type: 'GET',
            success: function(response) {
                Swal.close();

                let pt = response;
                $('#editName').val(pt.name);
                $('#editAddress').val(pt.address);
                $('#editPhone').val(pt.phone);

                $('#formEditPT').attr('action', '/pt/' + id);

                $('#modalEditPT').modal('show');
            },
            error: function(xhr, status, error) {
                Swal.close();
                console.error('Error:', error);

                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Gagal mengambil data PT',
                    confirmButtonColor: '#9a55ff',
                    confirmButtonText: 'OK'
                });
            }
        });
    });

    // ===== HANDLE FORM EDIT PT =====
    $('#formEditPT').on('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Menyimpan...',
            text: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        this.submit();
    });

    // ===== HANDLE DELETE BUTTON CLICK =====
    $(document).on('click', '.btnDelete', function() {
        let form = $(this).closest('.formDelete');
        let companyName = $(this).data('name');

        Swal.fire({
            title: 'Hapus PT?',
            text: "PT " + companyName + " akan dihapus",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Menghapus...',
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                form.submit();
            }
        });
    });
});

// Sweet Alert session success
@if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        timer: 3000,
        timerProgressBar: true,
        confirmButtonText: 'OK',
        confirmButtonColor: '#9a55ff'
    });
@endif

// Sweet Alert session error
@if(session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: "{{ session('error') }}",
        confirmButtonColor: '#9a55ff',
        confirmButtonText: 'OK'
    });
@endif
</script>
@endpush
