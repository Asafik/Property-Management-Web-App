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

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "{{ session('error') }}",
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif

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
                    <!-- Filter Section - HANYA TAMPIL JIKA ADA DATA -->
                    @if($banks->count() > 0)
                    <div class="filter-card">
                        <div class="card-body">
                            <h6 class="card-title mb-3" style="font-size: 1rem;">
                                <i class="mdi mdi-filter-outline me-1" style="color: #9a55ff;"></i>Filter Data
                            </h6>

                            <!-- FILTER UNTUK MOBILE -->
                            <div class="d-block d-md-none">
                                <div class="mb-3">
                                    <label class="form-label">
                                        <i class="mdi mdi-magnify me-1" style="color: #9a55ff;"></i>Cari Bank
                                    </label>
                                    <input type="text" class="form-control" id="searchMobile" placeholder="Cari nama bank...">
                                </div>

                                <div class="row g-2">
                                    <div class="col-6">
                                        <label class="form-label">
                                            <i class="mdi mdi-flag me-1" style="color: #9a55ff;"></i>Status
                                        </label>
                                        <select class="form-control" id="statusMobile">
                                            <option value="">Semua</option>
                                            <option value="1">Aktif</option>
                                            <option value="0">Non-Aktif</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">
                                            <i class="mdi mdi-counter me-1" style="color: #9a55ff;"></i>Tampil
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
                                            <i class="mdi mdi-magnify me-1" style="color: #9a55ff;"></i>Cari Bank
                                        </label>
                                        <input type="text" class="form-control" id="searchDesktop" placeholder="Cari nama bank...">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">
                                            <i class="mdi mdi-flag me-1" style="color: #9a55ff;"></i>Status
                                        </label>
                                        <select class="form-control" id="statusDesktop">
                                            <option value="">Semua</option>
                                            <option value="1">Aktif</option>
                                            <option value="0">Non-Aktif</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">
                                            <i class="mdi mdi-counter me-1" style="color: #9a55ff;"></i>Tampil
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

                    <!-- Tabel Bank -->
                    <div class="table-responsive">
                        <table class="table table-hover" id="tableBank" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center"><i class="mdi mdi-counter me-1"></i>No</th>
                                    <th><i class="mdi mdi-bank me-1"></i>Nama Bank</th>
                                    <th><i class="mdi mdi-credit-card me-1"></i>Pemilik Rekening</th>
                                    <th><i class="mdi mdi-flag me-1"></i>Status</th>
                                    <th class="text-center"><i class="mdi mdi-cog me-1"></i>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($banks as $bank)
                                <tr>
                                    <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-bank text-primary me-2" style="font-size: 1rem;"></i>
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
                                    <td colspan="5" class="text-center text-muted py-4">
                                        <i class="mdi mdi-bank-off me-2" style="font-size: 1.5rem;"></i>
                                        Tidak ada data bank yang tersedia.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination UI - HANYA TAMPIL JIKA ADA DATA -->
                    @if($banks->count() > 0)
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-3">
                        <div class="pagination-info mb-2 mb-sm-0">
                            <i class="mdi mdi-information-outline me-1"></i>
                            Menampilkan <span id="infoStart">1</span>-<span id="infoEnd">{{ min(10, $banks->count()) }}</span> dari <span id="infoTotal">{{ $banks->count() }}</span> data
                        </div>
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0" style="gap: 2px;" id="pagination">
                                <!-- Akan diisi oleh DataTables -->
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
    // Cek apakah ada data
    var hasData = {{ $banks->count() > 0 ? 'true' : 'false' }};

    // Inisialisasi DataTables hanya jika ada data
    if (hasData) {
        let table = $('#tableBank').DataTable({
            responsive: true,
            paging: true,
            pageLength: 10,
            lengthMenu: [10, 25, 50, 100],
            info: true,
            searching: true,
            ordering: true,
            language: {
                emptyTable: "Data bank belum tersedia",
                zeroRecords: "Data tidak ditemukan",
                paginate: {
                    previous: "<i class='mdi mdi-chevron-left'></i>",
                    next: "<i class='mdi mdi-chevron-right'></i>"
                }
            },
            columnDefs: [
                { orderable: false, targets: [4] } // Non-aktifkan sorting untuk kolom Aksi
            ]
        });

        // Sembunyikan DataTables default controls
        $('.dataTables_filter, .dataTables_length, .dataTables_paginate, .dataTables_info').hide();

        // ===== FUNGSI FILTER =====
        function applyFilter() {
            let searchTerm = $('#searchMobile').val() || $('#searchDesktop').val() || '';
            let status = $('#statusMobile').val() || $('#statusDesktop').val() || '';
            let length = $('#lengthMobile').val() || $('#lengthDesktop').val() || 10;

            table.search(searchTerm).draw();

            // Filter status manual
            if (status) {
                $.fn.dataTable.ext.search.push(
                    function(settings, data, dataIndex) {
                        let statusCell = $(table.cell(dataIndex, 3).node()).find('.badge').text().trim();
                        let statusValue = statusCell.includes('Aktif') ? '1' : '0';
                        return statusValue === status;
                    }
                );
                table.draw();
                $.fn.dataTable.ext.search.pop();
            }

            table.page.len(length).draw();

            // Update info pagination
            updatePaginationInfo(table);
        }

        function resetFilter() {
            $('#searchMobile, #searchDesktop').val('');
            $('#statusMobile, #statusDesktop').val('');
            $('#lengthMobile, #lengthDesktop').val('10');

            table.search('').draw();
            table.page.len(10).draw();

            updatePaginationInfo(table);
        }

        function updatePaginationInfo(table) {
            let info = table.page.info();
            $('#infoStart').text(info.start + 1);
            $('#infoEnd').text(info.end);
            $('#infoTotal').text(info.recordsTotal);
        }

        // Event listeners untuk filter
        $('#filterMobile, #filterDesktop').on('click', applyFilter);
        $('#resetMobile, #resetDesktop').on('click', resetFilter);

        $('#searchMobile, #searchDesktop').on('keyup', function(e) {
            if (e.key === 'Enter') {
                applyFilter();
            }
        });

        // Update info saat halaman berubah
        table.on('page.dt', function() {
            updatePaginationInfo(table);
        });

        table.on('length.dt', function() {
            updatePaginationInfo(table);
        });

        // Initial update
        updatePaginationInfo(table);
    }

    // ===== HANDLE FORM TAMBAH BANK DENGAN AJAX =====
    $('#formTambahBank').on('submit', function(e) {
        e.preventDefault();

        let form = $(this);

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

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Bank berhasil ditambahkan',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    $('#modalTambahBank').modal('hide');
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

    // ===== HANDLE FORM EDIT BANK DENGAN AJAX =====
    $('#formEditBank').on('submit', function(e) {
        e.preventDefault();

        let form = $(this);

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

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Bank berhasil diperbarui',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    $('#modalEditBank').modal('hide');
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

    // ===== HANDLE DELETE BUTTON CLICK DENGAN AJAX =====
    $('.btnDelete').click(function() {
        let form = $(this).closest('.formDelete');
        let bankName = $(this).data('name');
        let actionUrl = form.attr('action');

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
                    url: actionUrl,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'DELETE'
                    },
                    success: function(response) {
                        Swal.close();

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data bank berhasil dihapus',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        Swal.close();

                        let message = 'Gagal menghapus data bank';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: message,
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                });
            }
        });
    });
});

// ===== FUNGSI EXPORT TABLE =====
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
</script>
@endpush
