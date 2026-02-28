@extends('layouts.partial.app')

@section('title', 'Master Data Bank - Property Management App')

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
                            <i class="mdi mdi-bank me-2" style="color: #9a55ff;"></i>
                            Master Data Bank
                        </h3>
                        <p class="text-muted mb-0">
                            <i class="mdi mdi-information-outline me-1"></i>
                            Kelola data bank untuk keperluan transaksi dan pembayaran
                        </p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-bank" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Data Bank -->
    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                    <h5 class="card-title mb-2 mb-md-0">
                        <i class="mdi mdi-format-list-bulleted me-2 text-primary"></i>
                        Daftar Bank
                    </h5>
                    <div class="d-flex gap-2">
                        <button class="btn btn-sm btn-gradient-primary" onclick="$('#modalTambahBank').modal('show')">
                            <i class="mdi mdi-plus me-1"></i><span class="d-none d-sm-inline">Tambah Bank</span>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <!-- FILTER SECTION - Selalu tampil -->
                    <div class="filter-card mb-4">
                        <div class="card-body">
                            <h6 class="card-title mb-3" style="font-size: 1rem;">
                                <i class="mdi mdi-filter-outline me-1" style="color: #9a55ff;"></i>
                                Filter Data Bank
                            </h6>

                            <!-- MOBILE VERSION -->
                            <div class="d-block d-md-none">
                                <form method="GET" action="{{ route('bank.index') }}">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            <i class="mdi mdi-magnify me-1" style="color: #9a55ff;"></i>
                                            Cari Bank
                                        </label>
                                        <input type="text" class="form-control" name="search" value="{{ request('search') }}"
                                            placeholder="Cari nama bank...">
                                    </div>

                                    <div class="row g-2 mb-3">
                                        <div class="col-6">
                                            <label class="form-label">
                                                <i class="mdi mdi-flag me-1" style="color: #9a55ff;"></i>Status
                                            </label>
                                            <select class="form-control" name="status">
                                                <option value="">Semua</option>
                                                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Aktif</option>
                                                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Non-Aktif</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">
                                                <i class="mdi mdi-counter me-1" style="color: #9a55ff;"></i>Tampil
                                            </label>
                                            <select class="form-control" name="per_page">
                                                <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                                <option value="25" {{ request('per_page', 10) == 25 ? 'selected' : '' }}>25</option>
                                                <option value="50" {{ request('per_page', 10) == 50 ? 'selected' : '' }}>50</option>
                                                <option value="100" {{ request('per_page', 10) == 100 ? 'selected' : '' }}>100</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row g-2">
                                        <div class="col-6">
                                            <button type="submit" class="btn btn-gradient-primary w-100">
                                                <i class="mdi mdi-filter me-1"></i> Filter
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <a href="{{ route('bank.index') }}" class="btn btn-gradient-secondary w-100">
                                                <i class="mdi mdi-refresh me-1"></i> Reset
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- DESKTOP VERSION -->
                            <div class="d-none d-md-block">
                                <form method="GET" action="{{ route('bank.index') }}">
                                    <div class="row g-2 align-items-end">
                                        <div class="col-md-4">
                                            <label class="form-label">
                                                <i class="mdi mdi-magnify me-1" style="color: #9a55ff;"></i>
                                                Cari Bank
                                            </label>
                                            <input type="text" class="form-control" name="search" value="{{ request('search') }}"
                                                placeholder="Cari nama bank...">
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label">
                                                <i class="mdi mdi-flag me-1" style="color: #9a55ff;"></i>Status
                                            </label>
                                            <select class="form-control" name="status">
                                                <option value="">Semua</option>
                                                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Aktif</option>
                                                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Non-Aktif</option>
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label">
                                                <i class="mdi mdi-counter me-1" style="color: #9a55ff;"></i>Tampil
                                            </label>
                                            <select class="form-control" name="per_page">
                                                <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                                <option value="25" {{ request('per_page', 10) == 25 ? 'selected' : '' }}>25</option>
                                                <option value="50" {{ request('per_page', 10) == 50 ? 'selected' : '' }}>50</option>
                                                <option value="100" {{ request('per_page', 10) == 100 ? 'selected' : '' }}>100</option>
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <button type="submit" class="btn btn-gradient-primary w-100">
                                                <i class="mdi mdi-filter me-1"></i> Filter
                                            </button>
                                        </div>

                                        <div class="col-md-2">
                                            <a href="{{ route('bank.index') }}" class="btn btn-gradient-secondary w-100" title="Reset">
                                                <i class="mdi mdi-refresh"></i>
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- TABEL DATA -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle" id="tableBank" {{ $banks->count() > 0 ? 'data-use-datatables=true' : '' }}>
                            <thead>
                                <tr>
                                    <th class="text-center" width="5%">No</th>
                                    <th width="25%">Nama Bank</th>
                                    <th width="25%">Pemilik Rekening</th>
                                    <th width="20%">Status</th>
                                    <th class="text-center" width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($banks as $bank)
                                <tr>
                                    <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-bank text-primary me-2" style="font-size: 1.2rem;"></i>
                                            <span class="fw-bold">{{ $bank->bank_name }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $bank->account_holder }}</td>
                                    <td>
                                        @if($bank->is_active)
                                            <span class="badge badge-gradient-success">
                                                <i class="mdi mdi-check-circle me-1"></i>Aktif
                                            </span>
                                        @else
                                            <span class="badge badge-gradient-danger">
                                                <i class="mdi mdi-close-circle me-1"></i>Non-Aktif
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <button class="btn btn-outline-warning btn-sm btnEdit" title="Edit" data-id="{{ $bank->id }}">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                            <form action="{{ route('bank.destroy', $bank->id) }}" method="POST" class="d-inline formDelete">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-outline-danger btn-sm btnDelete" title="Hapus" data-name="{{ $bank->bank_name }}">
                                                    <i class="mdi mdi-delete"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-5">
                                        <i class="mdi mdi-bank-off" style="font-size: 3rem; opacity: 0.3;"></i>
                                        <p class="mt-2 mb-0">Tidak ada data bank yang tersedia.</p>
                                        <p class="text-muted small">Silahkan tambahkan data bank baru.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- PAGINATION SECTION - Tampil jika ada data -->
                    @if($banks->count() > 0)
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                        <!-- Info Menampilkan Data -->
                        <div class="pagination-info mb-2 mb-sm-0">
                            <i class="mdi mdi-information-outline me-1 text-primary"></i>
                            Menampilkan
                            <span class="fw-bold">{{ $banks->firstItem() }}</span>
                            -
                            <span class="fw-bold">{{ $banks->lastItem() }}</span>
                            dari
                            <span class="fw-bold">{{ $banks->total() }}</span>
                            data bank
                        </div>

                        <!-- Pagination Links -->
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0" style="gap: 2px;">
                                {{-- Previous Page Link --}}
                                @if($banks->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link" aria-label="Previous">
                                            <i class="mdi mdi-chevron-left"></i>
                                        </span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $banks->previousPageUrl() }}" aria-label="Previous">
                                            <i class="mdi mdi-chevron-left"></i>
                                        </a>
                                    </li>
                                @endif

                                {{-- Page Links --}}
                                @foreach ($banks->getUrlRange(1, $banks->lastPage()) as $page => $url)
                                    <li class="page-item {{ $banks->currentPage() == $page ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach

                                {{-- Next Page Link --}}
                                @if($banks->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $banks->nextPageUrl() }}" aria-label="Next">
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
                            <i class="mdi mdi-arrow-left me-1"></i>
                            Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL TAMBAH BANK -->
<div class="modal fade" id="modalTambahBank" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="mdi mdi-bank-plus me-2" style="color: #9a55ff;"></i>
                    Tambah Bank Baru
                </h5>
                <button type="button" class="btn-close" onclick="$('#modalTambahBank').modal('hide')" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('bank.store') }}" method="POST" id="formTambahBank">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-bank me-1"></i>Nama Bank
                                </label>
                                <input type="text" name="bank_name" class="modal-form-control" placeholder="Contoh: Bank Central Asia" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-credit-card me-1"></i>Pemilik Rekening
                                </label>
                                <input type="text" name="account_holder" class="modal-form-control" placeholder="Contoh: Andi Sukma" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                         <div class="col-md-6">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-credit-card me-1"></i>Nomor Rekening
                                </label>
                                <input type="number" name="number" class="modal-form-control" placeholder="Contoh: 1234567890" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-flag me-1"></i>Status
                                </label>
                                <select class="modal-form-control" name="is_active" required>
                                    <option value="1">Aktif</option>
                                    <option value="0">Non-Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-gradient-secondary" onclick="$('#modalTambahBank').modal('hide')">Batal</button>
                <button type="submit" form="formTambahBank" class="btn btn-gradient-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL EDIT BANK -->
<div class="modal fade" id="modalEditBank" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="mdi mdi-pencil me-2" style="color: #9a55ff;"></i>
                    Edit Bank
                </h5>
                <button type="button" class="btn-close" onclick="$('#modalEditBank').modal('hide')" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="formEditBank">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-bank me-1"></i>Nama Bank
                                </label>
                                <input type="text" name="bank_name" id="editBankName" class="modal-form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-credit-card me-1"></i>Pemilik Rekening
                                </label>
                                <input type="text" name="account_holder" id="editAccountHolder" class="modal-form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                         <div class="col-md-6">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-credit-card me-1"></i>Nomor Rekening
                                </label>
                                <input type="number" name="number" id="editNumber" class="modal-form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="modal-form-group">
                                <label>
                                    <i class="mdi mdi-flag me-1"></i>Status
                                </label>
                                <select class="modal-form-control" name="is_active" id="editStatus" required>
                                    <option value="1">Aktif</option>
                                    <option value="0">Non-Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-gradient-secondary" onclick="$('#modalEditBank').modal('hide')">Batal</button>
                <button type="submit" form="formEditBank" class="btn btn-gradient-primary">Update</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Inisialisasi DataTables hanya jika ada data
    const tableElement = document.getElementById('tableBank');
    if (tableElement && tableElement.getAttribute('data-use-datatables') === 'true') {
        // Destroy existing DataTable if any
        if ($.fn.DataTable.isDataTable('#tableBank')) {
            $('#tableBank').DataTable().destroy();
        }

        // Initialize DataTable with minimal features
        $('#tableBank').DataTable({
            responsive: true,
            ordering: true,
            paging: false,           // Matikan pagination DataTables
            info: false,              // Matikan info DataTables
            searching: false,         // Matikan search DataTables
            lengthChange: false,      // Matikan length change
            destroy: true,
            language: {
                emptyTable: "Data bank belum tersedia",
                zeroRecords: "Data tidak ditemukan",
            },
            columnDefs: [
                { orderable: false, targets: [4] } // Kolom aksi tidak bisa diurutkan
            ]
        });
    }

    // Sweet Alert untuk session success/error
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            timer: 2000,
            showConfirmButton: false
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: "{{ session('error') }}",
            timer: 2000,
            showConfirmButton: false
        });
    @endif

    // ===== HANDLE FORM TAMBAH BANK =====
    $('#formTambahBank').on('submit', function(e) {
        e.preventDefault();
        this.submit(); // Submit biasa karena sudah pakai redirect
    });

    // ===== HANDLE EDIT BUTTON CLICK =====
    $('.btnEdit').click(function() {
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
            url: '/master-data-bank/' + id + '/edit',
            type: 'GET',
            success: function(response) {
                Swal.close();

                let bank = response;
                $('#editBankName').val(bank.bank_name);
                $('#editAccountHolder').val(bank.account_holder);
                $('#editNumber').val(bank.number);
                $('#editStatus').val(bank.is_active);

                // Set action form
                $('#formEditBank').attr('action', '/master-data-bank/' + id);

                $('#modalEditBank').modal('show');
            },
            error: function() {
                Swal.close();

                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Gagal mengambil data bank',
                    timer: 2000,
                    showConfirmButton: false
                });
            }
        });
    });

    // ===== HANDLE FORM EDIT BANK =====
    $('#formEditBank').on('submit', function(e) {
        e.preventDefault();
        this.submit(); // Submit biasa karena sudah pakai redirect
    });

    // ===== HANDLE DELETE BUTTON CLICK =====
    $('.btnDelete').click(function() {
        let form = $(this).closest('.formDelete');
        let bankName = $(this).data('name');

        Swal.fire({
            title: 'Hapus Bank?',
            text: "Bank " + bankName + " akan dihapus",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit(); // Submit form biasa
            }
        });
    });
});
</script>
@endpush
