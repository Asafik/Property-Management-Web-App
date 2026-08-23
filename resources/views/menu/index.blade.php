@extends('layouts.partial.app')

@section('title', 'Role & Permission - Property Management App')

@section('content')

<div class="container-fluid px-1 px-sm-2 px-md-3 py-2 py-md-3">

    <!-- Header Halaman (Tanpa Card Box) -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center px-1">
                <div>
                    <h3 class="text-dark mb-1 fw-bold">
                        <i class="mdi mdi-shield-account me-2" style="color: #9a55ff;"></i>Role & Permission
                    </h3>
                    <p class="text-muted mb-0">Kelola pemetaan hak akses dan perizinan menu sistem per posisi jabatan</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-format-list-bulleted me-2"></i>Daftar Hak Akses Menu
                    </h5>
                </div>

                <div class="card-body">
                    <!-- Filter Section -->
                    <div class="filter-card mb-3">
                        <!-- Desktop Version -->
                        <div class="filter-row-desktop d-none d-md-block">
                            <form id="filterForm" method="GET" action="{{ route('master.data.menu') }}" onsubmit="return showFilterLoading()">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                    <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                        <div style="min-width: 260px; max-width: 380px; flex: 1;">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="search" id="searchInput"
                                                    placeholder="Cari nama menu atau route..."
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
                                                <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15 data</option>
                                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 data</option>
                                                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 data</option>
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-gradient-primary btn-icon-only" title="Filter">
                                            <i class="mdi mdi-filter"></i>
                                        </button>
                                        <a href="{{ route('master.data.menu') }}" class="btn btn-gradient-secondary btn-icon-only" title="Reset" onclick="showResetLoading(event)">
                                            <i class="mdi mdi-refresh"></i>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Mobile Version -->
                        <div class="filter-row-mobile d-block d-md-none">
                            <form method="GET" action="{{ route('master.data.menu') }}" onsubmit="return showFilterLoading()">
                                <div class="row g-2">
                                    <div class="col-12 mb-2">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" id="searchInputMobile"
                                                placeholder="Cari nama menu atau route..."
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
                                        <select class="form-control" name="per_page">
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
                                        <a href="{{ route('master.data.menu') }}" class="btn btn-gradient-secondary w-100 d-flex align-items-center justify-content-center gap-1" onclick="showResetLoading(event)">
                                            <i class="mdi mdi-refresh"></i> Reset
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Tabel Data Menu & Permission -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Nama Menu</th>
                                    <th>Route / URL</th>
                                    <th>Menu Induk (Parent)</th>
                                    <th>Posisi / Hak Akses</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($menus as $index => $item)
                                    <tr>
                                        <td class="text-center fw-bold">
                                            {{ method_exists($menus, 'firstItem') ? $menus->firstItem() + $index : $index + 1 }}
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi {{ $item->icon ?: 'mdi-menu' }} text-primary me-2" style="font-size: 1.2rem;"></i>
                                                <span class="fw-bold">{{ $item->name }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($item->route)
                                                <code class="px-2 py-1 bg-light text-primary rounded border" style="font-size: 0.78rem;">
                                                    {{ $item->route }}
                                                </code>
                                            @else
                                                <span class="text-muted" style="font-size: 0.8rem;">(Header / Dropdown)</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->parent)
                                                <span class="badge-category" style="background: rgba(23, 162, 184, 0.1); color: #17a2b8; border-color: rgba(23, 162, 184, 0.2);">
                                                    <i class="mdi mdi-file-tree me-1"></i>{{ $item->parent->name }}
                                                </span>
                                            @else
                                                <span class="badge bg-light text-dark fw-semibold px-2 py-1 border" style="font-size: 0.78rem;">
                                                    <i class="mdi mdi-home-outline me-1"></i>Menu Utama
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-1">
                                                @forelse($item->positions as $pos)
                                                    <span class="badge bg-success bg-opacity-10 text-success fw-semibold px-2 py-1 border border-success border-opacity-25" style="font-size: 0.75rem; border-radius: 4px;">
                                                        {{ $pos->name }}
                                                    </span>
                                                @empty
                                                    <span class="text-muted small">
                                                        <i class="mdi mdi-lock-outline me-1"></i>Belum ada akses
                                                    </span>
                                                @endforelse
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn-action edit"
                                                data-bs-toggle="modal"
                                                data-bs-target="#accessMenuModal"
                                                title="Ubah Hak Akses Posisi"
                                                onclick="editAksesMenu('{{ $item->id }}', '{{ addslashes($item->name) }}', {{ json_encode($item->positions->pluck('id')->toArray()) }})">
                                                <i class="mdi mdi-key-variant"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">
                                            <i class="mdi mdi-information-outline me-2"></i>Tidak ada data menu ditemukan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if ($menus instanceof \Illuminate\Pagination\LengthAwarePaginator && $menus->total() > 0)
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                            <div class="pagination-info mb-2 mb-sm-0 text-muted" style="font-size: 0.82rem;">
                                Menampilkan {{ $menus->firstItem() ?? 0 }} - {{ $menus->lastItem() ?? 0 }} dari {{ $menus->total() }} data
                            </div>

                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                    <li class="page-item {{ $menus->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $menus->previousPageUrl() }}" {{ !$menus->onFirstPage() ? 'onclick=showPaginationLoading(event)' : '' }}>
                                            <i class="mdi mdi-chevron-left"></i>
                                        </a>
                                    </li>

                                    @for($page = 1; $page <= $menus->lastPage(); $page++)
                                        <li class="page-item {{ $page == $menus->currentPage() ? 'active' : '' }}">
                                            @if($page == $menus->currentPage())
                                                <span class="page-link">{{ $page }}</span>
                                            @else
                                                <a class="page-link" href="{{ $menus->appends(request()->query())->url($page) }}" onclick="showPaginationLoading(event)">{{ $page }}</a>
                                            @endif
                                        </li>
                                    @endfor

                                    <li class="page-item {{ $menus->hasMorePages() ? '' : 'disabled' }}">
                                        <a class="page-link" href="{{ $menus->nextPageUrl() }}" {{ $menus->hasMorePages() ? 'onclick=showPaginationLoading(event)' : '' }}>
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

<!-- Modal Hak Akses Menu -->
<div class="modal fade" id="accessMenuModal" tabindex="-1" aria-labelledby="accessMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-white border-bottom">
                <h5 class="modal-title fw-bold" id="accessMenuModalLabel" style="color: #2c2e3f;">
                    <i class="mdi mdi-shield-key-outline me-2" style="color: #9a55ff;"></i>Pengaturan Hak Akses Menu
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('menu.store_positions') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <input type="hidden" name="menu_id" id="access_menu_id">

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color: #2c2e3f;">Nama Menu</label>
                        <input type="text" class="form-control bg-light" id="access_menu_name" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color: #2c2e3f;">Posisi / Jabatan yang Diberi Izin</label>
                        <select class="form-control modal-select-multiple shadow-sm" style="height: 220px !important; min-height: 220px !important;" name="position_ids[]" id="access_position" multiple required>
                            @foreach ($positions as $pos)
                                <option value="{{ $pos->id }}">{{ $pos->name }}</option>
                            @endforeach
                        </select>
                        <small class="text-muted mt-2 d-block" style="font-size: 0.75rem;">
                            <i class="mdi mdi-information-outline me-1 text-primary"></i>Tahan tombol <strong>Ctrl</strong> (Windows) atau <strong>Cmd</strong> (Mac) saat klik untuk memilih lebih dari 1 posisi.
                        </small>
                    </div>
                </div>

                <div class="modal-footer bg-light border-top">
                    <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-gradient-primary btn-sm px-4">
                        <i class="mdi mdi-content-save me-1"></i>Simpan Hak Akses
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
@if(session('success'))
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

function editAksesMenu(id, name, positionIds) {
    document.getElementById('access_menu_id').value = id;
    document.getElementById('access_menu_name').value = name;

    let select = document.getElementById('access_position');

    for (let i = 0; i < select.options.length; i++) {
        select.options[i].selected = false;
    }

    if (positionIds && positionIds.length > 0) {
        for (let i = 0; i < select.options.length; i++) {
            if (positionIds.includes(parseInt(select.options[i].value))) {
                select.options[i].selected = true;
            }
        }
    }
}
</script>
@endpush
