@extends('layouts.partial.app')

@section('title', 'Dokumen Izin Persiapan - Property Management App')

@section('content')

<div class="container-fluid px-1 px-sm-2 px-md-3 py-2 py-md-3">

    <!-- Header Card Banner -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 header-card">
                <div class="card-body p-4 p-md-4 py-4 py-md-4 d-flex flex-wrap justify-content-between align-items-center gap-3" style="min-height: 105px;">
                    <div>
                        <h3 class="text-dark mb-1 fw-bold" style="font-size: 1.35rem;">
                            Dokumen Izin Persiapan
                        </h3>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">
                            Kelola master dokumen perizinan dan persyaratan
                        </p>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <button type="button" class="btn btn-sm btn-gradient-primary d-flex align-items-center gap-1 shadow-sm px-3 py-2" onclick="openModal('tambah')">
                            <i class="mdi mdi-plus-circle" style="font-size: 1rem;"></i>
                            <span>Tambah Dokumen</span>
                        </button>
                        <div class="d-none d-md-block pe-2">
                            <i class="mdi mdi-file-document-multiple" style="font-size: 3rem; color: #9a55ff; opacity: 0.25;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-format-list-bulleted me-2"></i>Daftar Dokumen Izin
                    </h5>
                </div>

                <div class="card-body">
                    <!-- Filter Section -->
                    <div class="filter-card mb-3">
                        <!-- Desktop Filter -->
                        <div class="filter-row-desktop d-none d-md-block">
                            <form method="GET" action="{{ route('dokument.persiapan') }}" onsubmit="return showFilterLoading()">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                    <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                        <div style="min-width: 240px; max-width: 320px; flex: 1;">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="search" id="searchInput"
                                                    placeholder="Cari nama dokumen..."
                                                    value="{{ request('search') }}"
                                                    style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                                <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                    type="submit" title="Cari"
                                                    style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                    <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div style="width: 190px;">
                                            <select class="form-control" name="required" id="requiredSelect">
                                                <option value="">Semua Status Wajib</option>
                                                <option value="yes" {{ request('required') == 'yes' ? 'selected' : '' }}>Wajib Upload</option>
                                                <option value="no" {{ request('required') == 'no' ? 'selected' : '' }}>Opsional</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center gap-2 ms-auto">
                                        <div style="width: 115px;">
                                            <select class="form-control" name="per_page" id="showSelect">
                                                <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 data</option>
                                                <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15 data</option>
                                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 data</option>
                                                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 data</option>
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-gradient-primary btn-icon-only" title="Filter">
                                            <i class="mdi mdi-filter"></i>
                                        </button>
                                        <a href="{{ route('dokument.persiapan') }}" class="btn btn-gradient-secondary btn-icon-only" title="Reset" onclick="showResetLoading(event)">
                                            <i class="mdi mdi-refresh"></i>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Mobile Filter -->
                        <div class="filter-row-mobile d-block d-md-none">
                            <form method="GET" action="{{ route('dokument.persiapan') }}" onsubmit="return showFilterLoading()">
                                <div class="row g-2">
                                    <div class="col-12 mb-2">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" id="searchInputMobile"
                                                placeholder="Cari nama dokumen..."
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
                                        <select class="form-control" name="required" id="requiredSelectMobile">
                                            <option value="">Semua Status Wajib</option>
                                            <option value="yes" {{ request('required') == 'yes' ? 'selected' : '' }}>Wajib Upload</option>
                                            <option value="no" {{ request('required') == 'no' ? 'selected' : '' }}>Opsional</option>
                                        </select>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <select class="form-control" name="per_page" id="showSelectMobile">
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
                                        <a href="{{ route('dokument.persiapan') }}" class="btn btn-gradient-secondary w-100 d-flex align-items-center justify-content-center gap-1" onclick="showResetLoading(event)">
                                            <i class="mdi mdi-refresh"></i> Reset
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- TABEL DATA DOKUMEN -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Nama Dokumen</th>
                                    <th>Deskripsi</th>
                                    <th>Status Upload</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($documentTypes as $index => $item)
                                <tr>
                                    <td class="text-center fw-bold">{{ $documentTypes->firstItem() + $index }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="mdi mdi-file-document-outline text-primary me-2" style="font-size: 1.2rem;"></i>
                                            <span class="fw-bold">{{ $item->name }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-muted">{{ $item->description ?: '-' }}</span>
                                    </td>
                                    <td>
                                        @if ($item->required)
                                            <span class="status-badge aktif">
                                                <i class="mdi mdi-check-circle"></i> Wajib
                                            </span>
                                        @else
                                            <span class="status-badge nonaktif">
                                                <i class="mdi mdi-minus-circle"></i> Opsional
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <button class="btn-action edit me-1" title="Edit Dokumen" onclick="openModal('edit', {{ $item->id }})">
                                            <i class="mdi mdi-pencil"></i>
                                        </button>
                                        <button class="btn-action delete" title="Hapus Dokumen" onclick="confirmDelete({{ $item->id }})">
                                            <i class="mdi mdi-trash-can-outline"></i>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        <i class="mdi mdi-file-document-off-outline me-2" style="font-size: 1.5rem;"></i>
                                        Tidak ada data dokumen yang tersedia.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- PAGINATION -->
                    @if ($documentTypes instanceof \Illuminate\Pagination\LengthAwarePaginator && $documentTypes->total() > 0)
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                        <div class="pagination-info mb-2 mb-sm-0 text-muted" style="font-size: 0.82rem;">
                            Menampilkan {{ $documentTypes->firstItem() }} - {{ $documentTypes->lastItem() }} dari {{ $documentTypes->total() }} data
                        </div>

                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                <li class="page-item {{ $documentTypes->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $documentTypes->previousPageUrl() }}" {{ !$documentTypes->onFirstPage() ? 'onclick=showPaginationLoading(event)' : '' }}>
                                        <i class="mdi mdi-chevron-left"></i>
                                    </a>
                                </li>

                                @for($page = 1; $page <= $documentTypes->lastPage(); $page++)
                                    <li class="page-item {{ $page == $documentTypes->currentPage() ? 'active' : '' }}">
                                        @if($page == $documentTypes->currentPage())
                                            <span class="page-link">{{ $page }}</span>
                                        @else
                                            <a class="page-link" href="{{ $documentTypes->appends(request()->query())->url($page) }}" onclick="showPaginationLoading(event)">{{ $page }}</a>
                                        @endif
                                    </li>
                                @endfor

                                <li class="page-item {{ $documentTypes->hasMorePages() ? '' : 'disabled' }}">
                                    <a class="page-link" href="{{ $documentTypes->nextPageUrl() }}" {{ $documentTypes->hasMorePages() ? 'onclick=showPaginationLoading(event)' : '' }}>
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

<!-- Modal Tambah/Edit Dokumen -->
<div class="modal fade" id="modalDokumen" tabindex="-1" aria-labelledby="modalDokumenLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-white border-bottom">
                <h5 class="modal-title fw-bold" id="modalDokumenLabel" style="color: #2c2e3f;">
                    <i class="mdi mdi-file-document-plus-outline me-2" id="modalIcon" style="color: #9a55ff;"></i>
                    <span id="modalTitle">Tambah Dokumen</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formDokumen" method="POST" onsubmit="return submitForm(event)">
                @csrf
                <input type="hidden" name="_method" id="methodField" value="POST">

                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color: #2c2e3f;">
                            Nama Dokumen <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="name" id="namaDokumen" class="form-control" placeholder="Contoh: KTP, KK, NPWP" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color: #2c2e3f;">
                            Deskripsi <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="description" id="deskripsiDokumen" class="form-control" placeholder="Contoh: Keterangan dokumen" required>
                    </div>

                    <div class="modal-form-group mb-3 d-none" id="codeFormGroup">
                        <label class="form-label fw-bold" style="color: #2c2e3f;">
                            Kode
                        </label>
                        <input type="text" name="code" id="codeDokumen" class="form-control" placeholder="Contoh: SHM">
                    </div>

                    <input type="hidden" name="accept" value=".jpg,.jpeg,.png,.pdf">
                    <input type="hidden" name="icon" value="mdi-file-document-outline">

                    <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded-3 mt-3 border">
                        <div>
                            <span class="fw-bold d-block text-dark" style="font-size: 0.88rem;">Dokumen Wajib Upload</span>
                            <small class="text-muted" style="font-size: 0.75rem;">
                                Aktifkan jika dokumen wajib dilengkapi
                            </small>
                        </div>
                        <div class="form-check form-switch mb-0">
                            <input class="form-check-input" type="checkbox" name="required" value="1" id="requiredCheckbox" checked style="cursor: pointer; width: 40px; height: 20px;">
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light border-top">
                    <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-gradient-primary btn-sm px-4" id="submitBtn">
                        <i class="mdi mdi-content-save me-1" id="btnIcon"></i>
                        <span id="btnText">Simpan</span>
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
    // Notifikasi sukses
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: true,
            confirmButtonText: 'OK',
            confirmButtonColor: '#9a55ff',
            timerProgressBar: true
        });
    @endif

    // Notifikasi error
    @if (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Ooops!',
            text: '{{ session('error') }}',
            confirmButtonColor: '#dc3545'
        });
    @endif

    // Validasi error
    @if($errors->any())
        Swal.fire({
            icon: 'warning',
            title: 'Validasi Gagal',
            html: `
                <ul style="text-align: left; margin-top: 10px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            `,
            confirmButtonColor: '#9a55ff'
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
        document.getElementById('formDokumen').submit();
    }, 100);

    return false;
}

function openModal(type, id = null) {
    if (type === 'tambah') {
        $('#formDokumen')[0].reset();
        $('#methodField').val('POST');
        $('#formDokumen').attr('action', '/documents/persiapan-pecah-legal');

        $('#modalTitle').text('Tambah Dokumen');
        $('#modalIcon').removeClass('mdi-pencil').addClass('mdi-file-document-plus-outline');
        $('#btnText').text('Simpan');
        $('#btnIcon').removeClass('mdi-pencil').addClass('mdi-content-save');

        $('#requiredCheckbox').prop('checked', true);
        $('#codeFormGroup').addClass('d-none');

        $('#modalDokumen').modal('show');
    } else {
        Swal.fire({
            title: 'Mohon tunggu...',
            html: 'Sedang mengambil data dokumen',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        $.get('/documents/persiapan-pecah-legal/' + id + '/edit', function(data) {
            Swal.close();

            $('#namaDokumen').val(data.name);
            $('#deskripsiDokumen').val(data.description);
            $('#requiredCheckbox').prop('checked', data.required == 1);
            if(data.code !== undefined && data.code !== null){
                 $('#codeFormGroup').removeClass('d-none');
                 $('#codeDokumen').val(data.code);
            }

            $('#methodField').val('PUT');
            $('#formDokumen').attr('action', '/documents/persiapan-pecah-legal/' + id);

            $('#modalTitle').text('Edit Dokumen');
            $('#modalIcon').removeClass('mdi-file-document-plus-outline').addClass('mdi-pencil');
            $('#btnText').text('Update');
            $('#btnIcon').removeClass('mdi-content-save').addClass('mdi-pencil');

            $('#modalDokumen').modal('show');
        }).fail(function() {
            Swal.close();
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Gagal mengambil data dokumen',
                confirmButtonColor: '#dc3545'
            });
        });
    }
}

function confirmDelete(id) {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            return new Promise((resolve) => {
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
                    form.action = '/documents/persiapan-pecah-legal/' + id;

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

                    resolve();
                }, 100);
            });
        }
    });
}
</script>
@endpush
