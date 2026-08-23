@extends('layouts.partial.app')

@section('title', 'Master Data Divisi - Property Management App')

@section('content')

<div class="container-fluid px-1 px-sm-2 px-md-3 py-2 py-md-3">

    <!-- Header Halaman (Tanpa Card Box) -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center px-1">
                <div>
                    <h3 class="text-dark mb-1 fw-bold">
                        <i class="mdi mdi-account-group me-2" style="color: #9a55ff;"></i>Master Data Divisi
                    </h3>
                    <p class="text-muted mb-0">Kelola data divisi untuk struktur organisasi dan departemen perusahaan</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Data Divisi -->
    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-format-list-bulleted me-2"></i>Daftar Divisi
                    </h5>
                    <button class="btn btn-sm btn-gradient-primary d-flex align-items-center gap-1 shadow-sm" onclick="openModal('tambah')">
                        <i class="mdi mdi-plus-circle" style="font-size: 1rem;"></i>
                        <span>Tambah Divisi</span>
                    </button>
                </div>

                <div class="card-body">
                    <!-- Filter Section -->
                    <div class="filter-card mb-3">
                        <!-- Desktop Version -->
                        <div class="filter-row-desktop d-none d-md-block">
                            <form id="filterForm" method="GET" action="{{ route('master.data.division.index') }}" onsubmit="return showFilterLoading()">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                    <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                        <div style="min-width: 260px; max-width: 380px; flex: 1;">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="search" id="searchInput"
                                                    placeholder="Cari nama divisi..."
                                                    value="{{ request('search') }}"
                                                    style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                                <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                    type="submit" title="Cari"
                                                    style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                    <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center gap-2 ms-auto">
                                        <div style="width: 115px;">
                                            <select class="form-control" name="per_page" id="perPageSelect">
                                                <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 data</option>
                                                <option value="15" {{ request('per_page', 15) == 15 ? 'selected' : '' }}>15 data</option>
                                                <option value="25" {{ request('per_page', 25) == 25 ? 'selected' : '' }}>25 data</option>
                                                <option value="50" {{ request('per_page', 50) == 50 ? 'selected' : '' }}>50 data</option>
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-gradient-primary btn-icon-only" title="Filter">
                                            <i class="mdi mdi-filter"></i>
                                        </button>
                                        <a href="{{ route('master.data.division.index') }}" class="btn btn-gradient-secondary btn-icon-only" title="Reset" onclick="showResetLoading(event)">
                                            <i class="mdi mdi-refresh"></i>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Mobile Version -->
                        <div class="filter-row-mobile d-block d-md-none">
                            <form method="GET" action="{{ route('master.data.division.index') }}" onsubmit="return showFilterLoading()">
                                <div class="row g-2">
                                    <div class="col-12 mb-2">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" id="searchInputMobile"
                                                placeholder="Cari nama divisi..."
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
                                        <select class="form-control" name="per_page" id="perPageSelectMobile">
                                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 data</option>
                                            <option value="15" {{ request('per_page', 15) == 15 ? 'selected' : '' }}>15 data</option>
                                            <option value="25" {{ request('per_page', 25) == 25 ? 'selected' : '' }}>25 data</option>
                                            <option value="50" {{ request('per_page', 50) == 50 ? 'selected' : '' }}>50 data</option>
                                        </select>
                                    </div>

                                    <div class="col-6">
                                        <button type="submit" class="btn btn-gradient-primary w-100 d-flex align-items-center justify-content-center gap-1">
                                            <i class="mdi mdi-filter"></i> Filter
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('master.data.division.index') }}" class="btn btn-gradient-secondary w-100 d-flex align-items-center justify-content-center gap-1" onclick="showResetLoading(event)">
                                            <i class="mdi mdi-refresh"></i> Reset
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Tabel Data Divisi -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="sortable" data-field="name" data-direction="{{ request('sortField') == 'name' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Nama Divisi
                                        @if(request('sortField') == 'name')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable text-center" data-field="employees_count" data-direction="{{ request('sortField') == 'employees_count' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Jumlah Karyawan
                                        @if(request('sortField') == 'employees_count')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($division as $index => $item)
                                    @php
                                        $dName = $item->name ?? 'Divisi';
                                        $initials = strtoupper(substr($dName, 0, 2));
                                    @endphp
                                    <tr>
                                        <td class="text-center fw-bold">{{ $division->firstItem() + $index }}</td>
                                        <td>
                                            <div class="info-inline">
                                                <span class="initial-avatar">{{ $initials }}</span>
                                                <span class="fw-bold text-dark">{{ $item->name }}</span>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-primary bg-opacity-10 text-primary fw-semibold px-3 py-1 border border-primary border-opacity-25" style="font-size: 0.8rem;">
                                                <i class="mdi mdi-account-multiple me-1"></i>{{ $item->employees_count }} Karyawan
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-inline-flex align-items-center gap-1">
                                                <button class="btn-action edit" title="Edit Divisi" onclick="openModal('edit', {{ $item->id }}, '{{ addslashes($item->name) }}')">
                                                    <i class="mdi mdi-pencil"></i>
                                                </button>
                                                <button class="btn-action delete" title="Hapus Divisi" onclick="confirmDelete({{ $item->id }})">
                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">
                                            <i class="mdi mdi-account-multiple-remove me-2" style="font-size: 1.5rem;"></i>
                                            Belum ada data divisi yang tersimpan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if ($division instanceof \Illuminate\Pagination\LengthAwarePaginator && $division->total() > 0)
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                            <div class="pagination-info mb-2 mb-sm-0 text-muted" style="font-size: 0.82rem;">
                                Menampilkan {{ $division->firstItem() }} - {{ $division->lastItem() }} dari {{ $division->total() }} data
                            </div>
                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                    <li class="page-item {{ $division->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $division->previousPageUrl() }}" {{ !$division->onFirstPage() ? 'onclick=showPaginationLoading(event)' : '' }}>
                                            <i class="mdi mdi-chevron-left"></i>
                                        </a>
                                    </li>

                                    @for($page = 1; $page <= $division->lastPage(); $page++)
                                        <li class="page-item {{ $page == $division->currentPage() ? 'active' : '' }}">
                                            @if($page == $division->currentPage())
                                                <span class="page-link">{{ $page }}</span>
                                            @else
                                                <a class="page-link" href="{{ $division->appends(request()->query())->url($page) }}" onclick="showPaginationLoading(event)">{{ $page }}</a>
                                            @endif
                                        </li>
                                    @endfor

                                    <li class="page-item {{ $division->hasMorePages() ? '' : 'disabled' }}">
                                        <a class="page-link" href="{{ $division->nextPageUrl() }}" {{ $division->hasMorePages() ? 'onclick=showPaginationLoading(event)' : '' }}>
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

<!-- Modal Tambah/Edit Divisi -->
<div class="modal fade" id="modalDivisi" tabindex="-1" aria-labelledby="modalDivisiLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-white border-bottom">
                <h5 class="modal-title fw-bold" id="modalDivisiLabel" style="color: #2c2e3f;">
                    <i class="mdi mdi-plus-circle me-2" id="modalIcon" style="color: #9a55ff;"></i>
                    <span id="modalTitle">Tambah Divisi</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formDivisi" method="POST" action="{{ route('master.data.division.store') }}">
                @csrf
                <input type="hidden" name="_method" id="methodField" value="POST">
                <input type="hidden" id="divisiId" name="id">

                <div class="modal-body p-4">
                    <div class="mb-0">
                        <label class="form-label fw-bold" style="color: #2c2e3f;">Nama Divisi <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" id="namaDivisi" placeholder="Contoh: Divisi Operasional / Marketing / Legal" value="{{ old('name') }}" required>
                    </div>
                </div>

                <div class="modal-footer bg-light border-top">
                    <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-gradient-primary btn-sm px-4" id="submitBtn" onclick="showSubmitLoading()">
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

function showSubmitLoading() {
    Swal.fire({
        title: 'Mohon tunggu...',
        html: 'Sedang menyimpan data',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    return true;
}

function openModal(type, id = null, name = '') {
    if (type === 'tambah') {
        $('#formDivisi')[0].reset();
        $('#divisiId').val('');
        $('#methodField').val('POST');
        $('#formDivisi').attr('action', '{{ route("master.data.division.store") }}');

        $('#modalTitle').text('Tambah Divisi');
        $('#modalIcon').removeClass('mdi-pencil').addClass('mdi-plus-circle');
        $('#btnText').text('Simpan Data');
        $('#btnIcon').removeClass('mdi-pencil').addClass('mdi-content-save');

        $('#modalDivisi').modal('show');
    } else {
        $('#divisiId').val(id);
        $('#namaDivisi').val(name);

        $('#methodField').val('PUT');
        $('#formDivisi').attr('action', '{{ url("master-data/division/update") }}/' + id);

        $('#modalTitle').text('Edit Divisi');
        $('#modalIcon').removeClass('mdi-plus-circle').addClass('mdi-pencil');
        $('#btnText').text('Update Data');
        $('#btnIcon').removeClass('mdi-content-save').addClass('mdi-pencil');

        $('#modalDivisi').modal('show');
    }
}

function confirmDelete(id) {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "Data divisi ini akan dihapus permanen!",
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
                html: 'Sedang menghapus data divisi',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            setTimeout(() => {
                let form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ url("master-data/division") }}/' + id;

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
