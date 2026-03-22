@extends('layouts.partial.app')

@section('title', 'Master Data Posisi - Property Management App')

@section('content')

<link rel="stylesheet" href="{{ asset('assets/css/masterdata/posisi.css') }}">

<div class="container-fluid p-2 p-sm-3 p-md-4">

    <div class="row mb-3 mb-sm-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="text-dark mb-1">
                            <i class="mdi mdi-briefcase-account me-2" style="color: #9a55ff;"></i>Master Data Posisi
                        </h3>
                        <p class="text-muted mb-0">Kelola data posisi/jabatan untuk setiap divisi</p>
                    </div>
                    <div class="d-none d-sm-block">
                        <i class="mdi mdi-briefcase-account" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-format-list-bulleted me-2"></i>Daftar Posisi
                    </h5>
                    <button class="btn btn-gradient-primary" style="padding: 0.6rem 1.2rem; font-size: 0.9rem;" onclick="openModal()">
                        <i class="mdi mdi-plus me-1"></i>Tambah Posisi
                    </button>
                </div>

                <div class="card-body">

                    <div class="filter-card mb-4">
                        <div class="card-body">

                            <div class="filter-row-desktop">
                                <div class="filter-text">
                                    <i class="mdi mdi-filter-outline"></i>
                                    <span>Filter data posisi</span>
                                </div>

                                <form id="filterForm" method="GET" action="{{ route('master.data.posisi') }}">
                                    <div class="row g-2 align-items-end w-100">
                                        <div class="col-md-5">
                                            <label class="form-label">Cari Posisi</label>
                                            <input type="text" class="form-control" name="search" placeholder="Nama posisi..." value="{{ request('search') }}">
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Divisi</label>
                                            <select class="form-control" name="division_id">
                                                <option value="">Semua Divisi</option>
                                                @foreach ($divisions as $division)
                                                    <option value="{{ $division->id }}" {{ request('division_id') == $division->id ? 'selected' : '' }}>
                                                        {{ $division->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-1">
                                            <label class="form-label">Tampil</label>
                                            <select class="form-control" name="per_page">
                                                <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                                <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
                                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label invisible d-none d-md-block">Aksi</label>
                                            <div class="d-flex gap-2">
                                                <button type="submit" class="btn btn-gradient-primary btn-icon-only flex-fill" title="Filter" onclick="showFilterLoading()">
                                                    <i class="mdi mdi-filter"></i>
                                                </button>
                                                <a href="{{ route('master.data.posisi') }}" class="btn btn-gradient-secondary btn-icon-only flex-fill" title="Reset" onclick="showResetLoading(event)">
                                                    <i class="mdi mdi-refresh"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="filter-row-mobile">
                                <div class="filter-text mb-2">
                                    <i class="mdi mdi-filter-outline"></i>
                                    <span>Filter data posisi</span>
                                </div>

                                <form method="GET" action="{{ route('master.data.posisi') }}">
                                    <div class="row g-2">
                                        <div class="col-12 mb-2">
                                            <label class="form-label">Cari Posisi</label>
                                            <input type="text" class="form-control" name="search" placeholder="Nama posisi..." value="{{ request('search') }}">
                                        </div>
                                        <div class="col-12 mb-2">
                                            <label class="form-label">Divisi</label>
                                            <select class="form-control" name="division_id">
                                                <option value="">Semua Divisi</option>
                                                @foreach ($divisions as $division)
                                                    <option value="{{ $division->id }}" {{ request('division_id') == $division->id ? 'selected' : '' }}>
                                                        {{ $division->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <label class="form-label">Tampil</label>
                                            <select class="form-control" name="per_page">
                                                <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                                <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
                                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <button type="submit" class="btn btn-gradient-primary btn-icon-only-mobile w-100" onclick="showFilterLoading()">
                                                <i class="mdi mdi-filter"></i> Filter
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <a href="{{ route('master.data.posisi') }}" class="btn btn-gradient-secondary btn-icon-only-mobile w-100" onclick="showResetLoading(event)">
                                                <i class="mdi mdi-refresh"></i> Reset
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger mb-3">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="sortable {{ request('sortField') == 'name' ? 'active-sort' : '' }}" data-field="name" data-direction="{{ request('sortField') == 'name' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Nama Posisi
                                        @if(request('sortField') == 'name')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="sortable {{ request('sortField') == 'division_id' ? 'active-sort' : '' }}" data-field="division_id" data-direction="{{ request('sortField') == 'division_id' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc' }}">
                                        Divisi
                                        @if(request('sortField') == 'division_id')
                                            <i class="mdi mdi-{{ request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                        @else
                                            <i class="mdi mdi-swap-vertical"></i>
                                        @endif
                                    </th>
                                    <th class="action-cell">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($positions as $index => $position)
                                    <tr>
                                        <td class="text-center fw-bold">{{ $positions->firstItem() + $index }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-briefcase text-primary me-2" style="font-size: 1.2rem;"></i>
                                                <span class="fw-bold">{{ $position->name }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge-division">
                                                <i class="mdi mdi-domain me-1"></i>{{ $position->division->name ?? '-' }}
                                            </span>
                                        </td>
                                        <td class="action-cell">
                                            <button
                                                type="button"
                                                class="btn-action edit"
                                                title="Edit"
                                                data-id="{{ $position->id }}"
                                                data-division-id="{{ $position->division_id }}"
                                                data-name="{{ $position->name }}"
                                                onclick="openEditModal(this)">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>

                                            <button
                                                type="button"
                                                class="btn-action delete"
                                                title="Hapus"
                                                onclick="confirmDelete('{{ $position->id }}')">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">
                                            Tidak ada data posisi
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($positions instanceof \Illuminate\Pagination\LengthAwarePaginator && $positions->total() > 0)
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                            <div class="pagination-info mb-2 mb-sm-0">
                                Menampilkan {{ $positions->firstItem() }} - {{ $positions->lastItem() }} dari {{ $positions->total() }} data
                            </div>

                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                    @if ($positions->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link"><i class="mdi mdi-chevron-left"></i></span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $positions->previousPageUrl() }}" onclick="showPaginationLoading(event)">
                                                <i class="mdi mdi-chevron-left"></i>
                                            </a>
                                        </li>
                                    @endif

                                    @foreach ($positions->getUrlRange(max(1, $positions->currentPage() - 2), min($positions->lastPage(), $positions->currentPage() + 2)) as $page => $url)
                                        @if ($page == $positions->currentPage())
                                            <li class="page-item active">
                                                <span class="page-link">{{ $page }}</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $url }}" onclick="showPaginationLoading(event)">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach

                                    @if ($positions->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $positions->nextPageUrl() }}" onclick="showPaginationLoading(event)">
                                                <i class="mdi mdi-chevron-right"></i>
                                            </a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <span class="page-link"><i class="mdi mdi-chevron-right"></i></span>
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
</div>

<div class="modal fade" id="modalPosition" tabindex="-1" aria-labelledby="modalPositionLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPositionLabel">
                    <i class="mdi mdi-plus-circle me-2" id="modalIcon"></i>
                    <span id="modalTitle">Tambah Posisi</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="formPosition" method="POST" onsubmit="return submitForm(event)">
                @csrf
                <input type="hidden" name="_method" id="methodField" value="POST">

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Pilih Divisi <span class="text-danger">*</span></label>
                        <select class="form-control" name="division_id" id="divisionId" required>
                            <option value="">Pilih Divisi</option>
                            @foreach ($divisions as $division)
                                <option value="{{ $division->id }}">{{ $division->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Posisi <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" id="positionName" placeholder="Contoh: Staff HRD" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-gradient-secondary" data-bs-dismiss="modal">
                        <i class="mdi mdi-close me-1"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-gradient-primary" id="submitBtn">
                        <i class="mdi mdi-content-save me-1" id="btnIcon"></i>
                        <span id="btnText">Simpan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<form id="deleteForm" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.sortable').forEach(item => {
        item.addEventListener('click', function() {
            let field = this.getAttribute('data-field');
            let direction = this.getAttribute('data-direction');

            Swal.fire({
                title: 'Memuat...',
                html: 'Sedang mengurutkan data',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });

            let url = new URL(window.location.href);
            url.searchParams.set('sortField', field);
            url.searchParams.set('sortDirection', direction);
            url.searchParams.set('page', 1);

            window.location.href = url.toString();
        });
    });

    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            timer: 2000,
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
        didOpen: () => Swal.showLoading()
    });
    return true;
}

function showResetLoading(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Memuat...',
        html: 'Sedang mereset filter',
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
    });
    window.location.href = event.currentTarget.href;
}

function showPaginationLoading(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Memuat...',
        html: 'Sedang memuat halaman',
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
    });
    window.location.href = event.currentTarget.href;
}

function submitForm(event) {
    event.preventDefault();

    Swal.fire({
        title: 'Mohon tunggu...',
        html: 'Sedang menyimpan data',
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
    });

    setTimeout(() => {
        document.getElementById('formPosition').submit();
    }, 100);

    return false;
}

function openModal() {
    const form = document.getElementById('formPosition');
    form.reset();

    document.getElementById('methodField').value = 'POST';
    form.action = '{{ route("master.data.posisi.store") }}';

    document.getElementById('modalTitle').textContent = 'Tambah Posisi';
    document.getElementById('modalIcon').className = 'mdi mdi-plus-circle me-2';
    document.getElementById('btnText').textContent = 'Simpan';
    document.getElementById('btnIcon').className = 'mdi mdi-content-save me-1';

    const modal = new bootstrap.Modal(document.getElementById('modalPosition'));
    modal.show();
}

function openEditModal(button) {
    Swal.fire({
        title: 'Memuat...',
        html: 'Sedang mengambil data posisi',
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
    });

    setTimeout(() => {
        const id = button.getAttribute('data-id');
        const divisionId = button.getAttribute('data-division-id');
        const name = button.getAttribute('data-name');

        const form = document.getElementById('formPosition');
        form.reset();

        document.getElementById('methodField').value = 'PUT';
        form.action = '{{ url("/master-data/posisi/update") }}/' + id;

        document.getElementById('divisionId').value = divisionId;
        document.getElementById('positionName').value = name;

        document.getElementById('modalTitle').textContent = 'Edit Posisi';
        document.getElementById('modalIcon').className = 'mdi mdi-pencil-circle me-2';
        document.getElementById('btnText').textContent = 'Update';
        document.getElementById('btnIcon').className = 'mdi mdi-pencil me-1';

        Swal.close();

        const modal = new bootstrap.Modal(document.getElementById('modalPosition'));
        modal.show();
    }, 300);
}

function confirmDelete(id) {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: 'Data yang dihapus tidak dapat dikembalikan!',
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
                didOpen: () => Swal.showLoading()
            });

            setTimeout(() => {
                const form = document.getElementById('deleteForm');
                form.action = '{{ url("/master-data/posisi") }}/' + id;
                form.submit();
            }, 100);
        }
    });
}
</script>
@endpush
