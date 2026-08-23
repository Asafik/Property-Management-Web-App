@extends('layouts.partial.app')

@section('title', 'Master Data Bank - Property Management App')

@section('content')

<div class="container-fluid px-1 px-sm-2 px-md-3 py-2 py-md-3">

    <!-- Header Halaman (Tanpa Card Box) -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center px-1">
                <div>
                    <h3 class="text-dark mb-1 fw-bold">
                        <i class="mdi mdi-bank me-2" style="color: #9a55ff;"></i>Master Data Bank
                    </h3>
                    <p class="text-muted mb-0">Kelola daftar rekening bank operasional untuk transaksi dan penerimaan dana</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-format-list-bulleted me-2"></i>Daftar Rekening Bank
                    </h5>
                    <button type="button" class="btn btn-sm btn-gradient-primary d-flex align-items-center gap-1 shadow-sm" onclick="openModal('tambah')">
                        <i class="mdi mdi-plus-circle" style="font-size: 1rem;"></i>
                        <span>Tambah Bank</span>
                    </button>
                </div>

                <div class="card-body">
                    <!-- Filter Section -->
                    <div class="filter-card mb-3">
                        <!-- Desktop Version -->
                        <div class="filter-row-desktop d-none d-md-block">
                            <form id="filterForm" method="GET" action="{{ route('bank.index') }}" onsubmit="return showFilterLoading()">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                    <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                        <!-- Search Input -->
                                        <div style="min-width: 260px; max-width: 360px; flex: 1;">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="search" id="searchInput"
                                                    placeholder="Cari nama bank..."
                                                    value="{{ request('search') }}"
                                                    style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                                <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                    type="submit" title="Cari"
                                                    style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                    <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Status Filter -->
                                        <div style="width: 155px;">
                                            <select class="form-control" name="status" id="statusSelect">
                                                <option value="">Semua Status</option>
                                                <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Aktif</option>
                                                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Nonaktif</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Right Limit & Buttons -->
                                    <div class="d-flex align-items-center gap-2 ms-auto">
                                        <div style="width: 110px;">
                                            <select class="form-control" name="per_page" id="perPageSelect">
                                                <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 data</option>
                                                <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15 data</option>
                                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 data</option>
                                                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 data</option>
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-gradient-primary btn-icon-only" title="Filter">
                                            <i class="mdi mdi-filter"></i>
                                        </button>
                                        <a href="{{ route('bank.index') }}" class="btn btn-gradient-secondary btn-icon-only" title="Reset" onclick="showResetLoading(event)">
                                            <i class="mdi mdi-refresh"></i>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Mobile Version -->
                        <div class="filter-row-mobile d-block d-md-none">
                            <form method="GET" action="{{ route('bank.index') }}" onsubmit="return showFilterLoading()">
                                <div class="row g-2">
                                    <div class="col-12 mb-2">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" id="searchInputMobile"
                                                placeholder="Cari nama bank..."
                                                value="{{ request('search') }}"
                                                style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                            <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                type="submit" title="Cari"
                                                style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <select class="form-control" name="status" id="statusSelectMobile">
                                            <option value="">Semua Status</option>
                                            <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Aktif</option>
                                            <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Nonaktif</option>
                                        </select>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <select class="form-control" name="per_page" id="perPageSelectMobile">
                                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 data</option>
                                            <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15 data</option>
                                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 data</option>
                                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 data</option>
                                        </select>
                                    </div>

                                    <div class="col-6">
                                        <button type="submit" class="btn btn-gradient-primary w-100 d-flex align-items-center justify-content-center gap-1">
                                            <i class="mdi mdi-filter"></i> Filter
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('bank.index') }}" class="btn btn-gradient-secondary w-100 d-flex align-items-center justify-content-center gap-1" onclick="showResetLoading(event)">
                                            <i class="mdi mdi-refresh"></i> Reset
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Tabel Data Bank -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="sortable" data-field="bank_name" data-direction="{{ request('sortField') == 'bank_name' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Nama Bank
                                        @if(request('sortField') == 'bank_name')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable" data-field="account_holder" data-direction="{{ request('sortField') == 'account_holder' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Pemilik Rekening
                                        @if(request('sortField') == 'account_holder')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable" data-field="number" data-direction="{{ request('sortField') == 'number' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Nomor Rekening
                                        @if(request('sortField') == 'number')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable" data-field="is_active" data-direction="{{ request('sortField') == 'is_active' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Status
                                        @if(request('sortField') == 'is_active')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($banks as $index => $bank)
                                    @php
                                        $bName = $bank->bank_name ?? 'Bank';
                                        $bParts = explode(' ', trim(str_replace(['Bank', 'BANK', 'bank'], '', $bName)));
                                        $initials = strtoupper(substr($bParts[0] ?? $bName, 0, 2));
                                        if (trim($initials) == '') {
                                            $initials = 'BK';
                                        }
                                    @endphp
                                    <tr>
                                        <td class="text-center fw-bold">{{ $banks->firstItem() + $index }}</td>
                                        <td>
                                            <div class="info-inline">
                                                <span class="initial-avatar" style="background: linear-gradient(135deg, #17a2b8, #56c6d8);">{{ $initials }}</span>
                                                <span class="fw-bold text-dark">{{ $bank->bank_name }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-dark fw-medium">{{ $bank->account_holder }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark fw-bold px-2 py-1 border font-monospace" style="font-size: 0.85rem; letter-spacing: 0.5px;">
                                                <i class="mdi mdi-credit-card-outline text-primary me-1"></i>{{ $bank->number }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($bank->is_active)
                                                <span class="status-badge aktif">
                                                    <i class="mdi mdi-check-circle"></i> Aktif
                                                </span>
                                            @else
                                                <span class="status-badge nonaktif">
                                                    <i class="mdi mdi-close-circle"></i> Nonaktif
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="d-inline-flex align-items-center gap-1">
                                                <button class="btn-action edit" title="Edit Bank" onclick="openModal('edit', {{ $bank->id }})">
                                                    <i class="mdi mdi-pencil"></i>
                                                </button>
                                                <button class="btn-action delete" title="Hapus Bank" onclick="confirmDelete({{ $bank->id }})">
                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">
                                            <i class="mdi mdi-bank-off me-2" style="font-size: 1.5rem;"></i>
                                            Belum ada data rekening bank yang tersimpan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if ($banks instanceof \Illuminate\Pagination\LengthAwarePaginator && $banks->total() > 0)
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                            <div class="pagination-info mb-2 mb-sm-0 text-muted" style="font-size: 0.82rem;">
                                Menampilkan {{ $banks->firstItem() }} - {{ $banks->lastItem() }} dari {{ $banks->total() }} data
                            </div>
                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                    <li class="page-item {{ $banks->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $banks->previousPageUrl() }}" {{ !$banks->onFirstPage() ? 'onclick=showPaginationLoading(event)' : '' }}>
                                            <i class="mdi mdi-chevron-left"></i>
                                        </a>
                                    </li>

                                    @for($page = 1; $page <= $banks->lastPage(); $page++)
                                        <li class="page-item {{ $page == $banks->currentPage() ? 'active' : '' }}">
                                            @if($page == $banks->currentPage())
                                                <span class="page-link">{{ $page }}</span>
                                            @else
                                                <a class="page-link" href="{{ $banks->appends(request()->query())->url($page) }}" onclick="showPaginationLoading(event)">{{ $page }}</a>
                                            @endif
                                        </li>
                                    @endfor

                                    <li class="page-item {{ $banks->hasMorePages() ? '' : 'disabled' }}">
                                        <a class="page-link" href="{{ $banks->nextPageUrl() }}" {{ $banks->hasMorePages() ? 'onclick=showPaginationLoading(event)' : '' }}>
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

</div>

<!-- Modal Tambah/Edit Bank -->
<div class="modal fade" id="modalBank" tabindex="-1" aria-labelledby="modalBankLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-white border-bottom">
                <h5 class="modal-title fw-bold" id="modalBankLabel" style="color: #2c2e3f;">
                    <i class="mdi mdi-plus-circle me-2" id="modalIcon" style="color: #9a55ff;"></i>
                    <span id="modalTitle">Tambah Bank</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formBank" method="POST" onsubmit="return submitForm(event)">
                @csrf
                <input type="hidden" name="_method" id="methodField" value="POST">
                <input type="hidden" id="bankId" name="id">

                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color: #2c2e3f;">Nama Bank <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="bank_name" id="namaBank" placeholder="Contoh: Bank Mandiri / BCA / BNI" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color: #2c2e3f;">Pemilik Rekening (A.N.) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="account_holder" id="pemilikRekening" placeholder="Nama perusahaan / pemilik rekening" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color: #2c2e3f;">Nomor Rekening <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="number" id="nomorRekening" placeholder="Contoh: 1420018899221" required>
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-bold" style="color: #2c2e3f;">Status Operasional</label>
                        <select class="form-control" name="is_active" id="status">
                            <option value="1">Aktif (Dapat digunakan transaksi)</option>
                            <option value="0">Nonaktif</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer bg-light border-top">
                    <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-gradient-primary btn-sm px-4" id="submitBtn">
                        <i class="mdi mdi-content-save me-1" id="btnIcon"></i>
                        <span id="btnText">Simpan Data</span>
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
    $('.sortable').click(function() {
        let field = $(this).data('field');
        let direction = $(this).data('direction');

        Swal.fire({
            title: 'Memuat...',
            html: 'Sedang mengurutkan data',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        let url = new URL(window.location.href);
        url.searchParams.set('sortField', field);
        url.searchParams.set('sortDirection', direction);
        url.searchParams.set('page', 1);

        window.location.href = url.toString();
    });

    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            timer: 2500,
            showConfirmButton: true,
            confirmButtonColor: '#9a55ff',
            timerProgressBar: true
        });
    @endif

    @if (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}',
            confirmButtonColor: '#dc3545'
        });
    @endif
});

function showFilterLoading() {
    Swal.fire({
        title: 'Memuat...',
        html: 'Sedang memfilter data',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    return true;
}

function showResetLoading(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Memuat...',
        html: 'Sedang mereset filter',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    window.location.href = event.currentTarget.href;
}

function showPaginationLoading(event) {
    if (event.currentTarget.parentElement.classList.contains('disabled')) return;
    event.preventDefault();
    Swal.fire({
        title: 'Memuat...',
        html: 'Sedang memuat halaman',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    window.location.href = event.currentTarget.href;
}

function submitForm(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Mohon tunggu...',
        html: 'Sedang menyimpan data',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    setTimeout(() => {
        document.getElementById('formBank').submit();
    }, 100);

    return false;
}

function openModal(type, id = null) {
    if (type === 'tambah') {
        $('#formBank')[0].reset();
        $('#bankId').val('');
        $('#methodField').val('POST');
        $('#formBank').attr('action', '{{ route("bank.store") }}');

        $('#modalTitle').text('Tambah Bank');
        $('#modalIcon').removeClass('mdi-pencil').addClass('mdi-plus-circle');
        $('#btnText').text('Simpan Data');
        $('#btnIcon').removeClass('mdi-pencil').addClass('mdi-content-save');

        $('#modalBank').modal('show');
    } else {
        Swal.fire({
            title: 'Mohon tunggu...',
            html: 'Sedang mengambil data bank',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        $.get('{{ url("master-data-bank") }}/' + id + '/edit', function(data) {
            Swal.close();

            $('#bankId').val(data.id);
            $('#namaBank').val(data.bank_name);
            $('#pemilikRekening').val(data.account_holder);
            $('#nomorRekening').val(data.number);
            $('#status').val(data.is_active ? '1' : '0');

            $('#methodField').val('PUT');
            $('#formBank').attr('action', '{{ url("master-data-bank") }}/' + id);

            $('#modalTitle').text('Edit Bank');
            $('#modalIcon').removeClass('mdi-plus-circle').addClass('mdi-pencil');
            $('#btnText').text('Update Data');
            $('#btnIcon').removeClass('mdi-content-save').addClass('mdi-pencil');

            $('#modalBank').modal('show');
        }).fail(function() {
            Swal.close();
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Gagal mengambil data bank',
                confirmButtonColor: '#dc3545'
            });
        });
    }
}

function confirmDelete(id) {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "Data rekening bank ini akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Menghapus...',
                html: 'Sedang menghapus data',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            setTimeout(() => {
                let form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ url("master-data-bank") }}/' + id;

                let csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}';

                let methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';

                form.appendChild(csrfInput);
                form.appendChild(methodInput);

                document.body.appendChild(form);
                form.submit();
            }, 100);
        }
    });
}
</script>
@endpush
