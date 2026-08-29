@extends('layouts.partial.app')

@section('title', 'Master Data Jenis Dokumen - Property Management App')

@section('content')

<div class="container-fluid px-1 px-sm-2 px-md-3 py-2 py-md-3">

    <!-- Header Card Banner -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 header-card">
                <div class="card-body p-4 p-md-4 py-4 py-md-4 d-flex flex-wrap justify-content-between align-items-center gap-3" style="min-height: 105px;">
                    <div>
                        <h3 class="text-dark mb-1 fw-bold" style="font-size: 1.35rem;">
                            Master Data Jenis Dokumen
                        </h3>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">
                            Kelola daftar jenis dokumen legalitas tanah, perizinan, dan berkas pendukung
                        </p>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <button type="button" class="btn btn-sm btn-gradient-primary d-flex align-items-center gap-1 shadow-sm px-3 py-2" onclick="openModalTambah()">
                            <i class="mdi mdi-plus-circle" style="font-size: 1rem;"></i>
                            <span>Tambah Jenis Dokumen</span>
                        </button>
                        <div class="d-none d-md-block pe-2">
                            <i class="mdi mdi-file-document-multiple-outline" style="font-size: 3rem; color: #9a55ff; opacity: 0.25;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Notifikasi -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm d-flex align-items-center gap-2 mb-3" role="alert">
            <i class="mdi mdi-check-circle" style="font-size: 1.25rem;"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm d-flex align-items-center gap-2 mb-3" role="alert">
            <i class="mdi mdi-alert-circle" style="font-size: 1.25rem;"></i>
            <div>{{ session('error') }}</div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Tabel Data Jenis Dokumen -->
    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2 py-3">
                    <h5 class="card-title mb-0 fw-bold" style="color: #2c2e3f;">
                        <i class="mdi mdi-format-list-bulleted me-2" style="color: #9a55ff;"></i>Daftar Jenis Dokumen
                    </h5>
                    <span class="badge rounded-pill bg-light text-primary border px-3 py-2" style="font-size: 0.8rem;">
                        Total: {{ $documentTypes->total() }} Dokumen
                    </span>
                </div>

                <div class="card-body">
                    <!-- Filter Section -->
                    <div class="filter-card mb-3">
                        <!-- Desktop Filter -->
                        <div class="filter-row-desktop d-none d-md-block">
                            <form method="GET" action="{{ route('master.data.jenis-dokumen.index') }}" onsubmit="return showFilterLoading()">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                    <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                        <div style="min-width: 240px; max-width: 320px; flex: 1;">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="search" id="searchInput"
                                                    placeholder="Cari nama / kode dokumen..."
                                                    value="{{ request('search') }}"
                                                    style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                                <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                    type="submit" title="Cari"
                                                    style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                    <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div style="width: 200px;">
                                            <select class="form-control" name="has_expiry" id="expirySelect">
                                                <option value="">Semua Masa Berlaku</option>
                                                <option value="yes" {{ request('has_expiry') == 'yes' ? 'selected' : '' }}>Ada Masa Berlaku</option>
                                                <option value="no" {{ request('has_expiry') == 'no' ? 'selected' : '' }}>Tanpa Masa Berlaku</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center gap-2 ms-auto">
                                        <div style="width: 115px;">
                                            <select class="form-control" name="per_page" id="showSelect">
                                                <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 data</option>
                                                <option value="15" {{ request('per_page', 15) == 15 ? 'selected' : '' }}>15 data</option>
                                                <option value="25" {{ request('per_page', 25) == 25 ? 'selected' : '' }}>25 data</option>
                                                <option value="50" {{ request('per_page', 50) == 50 ? 'selected' : '' }}>50 data</option>
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-gradient-primary btn-icon-only" title="Filter">
                                            <i class="mdi mdi-filter"></i>
                                        </button>
                                        <a href="{{ route('master.data.jenis-dokumen.index') }}" class="btn btn-gradient-secondary btn-icon-only" title="Reset" onclick="showResetLoading(event)">
                                            <i class="mdi mdi-refresh"></i>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Mobile Filter -->
                        <div class="filter-row-mobile d-block d-md-none">
                            <form method="GET" action="{{ route('master.data.jenis-dokumen.index') }}" onsubmit="return showFilterLoading()">
                                <div class="row g-2">
                                    <div class="col-12 mb-2">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" id="searchInputMobile"
                                                placeholder="Cari nama / kode dokumen..."
                                                value="{{ request('search') }}"
                                                style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                            <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                type="submit" title="Cari"
                                                style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-6 mb-2">
                                        <select class="form-control" name="has_expiry" id="expirySelectMobile">
                                            <option value="">Semua Status</option>
                                            <option value="yes" {{ request('has_expiry') == 'yes' ? 'selected' : '' }}>Ada Masa</option>
                                            <option value="no" {{ request('has_expiry') == 'no' ? 'selected' : '' }}>Tanpa Masa</option>
                                        </select>
                                    </div>

                                    <div class="col-6 mb-2">
                                        <select class="form-control" name="per_page" id="showSelectMobile">
                                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 data</option>
                                            <option value="15" {{ request('per_page', 15) == 15 ? 'selected' : '' }}>15 data</option>
                                            <option value="25" {{ request('per_page', 25) == 25 ? 'selected' : '' }}>25 data</option>
                                        </select>
                                    </div>

                                    <div class="col-12 d-flex gap-2">
                                        <button type="submit" class="btn btn-gradient-primary flex-fill" title="Filter">
                                            <i class="mdi mdi-filter me-1"></i>Filter
                                        </button>
                                        <a href="{{ route('master.data.jenis-dokumen.index') }}" class="btn btn-gradient-secondary flex-fill" title="Reset" onclick="showResetLoading(event)">
                                            <i class="mdi mdi-refresh me-1"></i>Reset
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Table Data -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center" style="width: 60px;">No</th>
                                    <th>Nama Dokumen</th>
                                    <th>Kode Dokumen</th>
                                    <th class="text-center">Masa Berlaku</th>
                                    <th>Tanggal Dibuat</th>
                                    <th class="text-center" style="width: 140px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($documentTypes as $index => $doc)
                                    <tr>
                                        <td class="text-center fw-bold">{{ $documentTypes->firstItem() + $index }}</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="p-2 rounded-3" style="background: rgba(154, 85, 255, 0.1); color: #9a55ff;">
                                                    <i class="mdi mdi-file-document-outline" style="font-size: 1.2rem;"></i>
                                                </div>
                                                <div>
                                                    <span class="fw-bold text-dark d-block">{{ $doc->name }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-primary border px-2 py-1" style="font-family: monospace; font-size: 0.8rem;">
                                                {{ $doc->code }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            @if($doc->has_expiry)
                                                <span class="badge bg-warning text-dark px-2 py-1 rounded-pill" style="font-size: 0.75rem;">
                                                    <i class="mdi mdi-clock-outline me-1"></i>Ada Masa Berlaku
                                                </span>
                                            @else
                                                <span class="badge bg-success text-white px-2 py-1 rounded-pill" style="font-size: 0.75rem;">
                                                    <i class="mdi mdi-infinity me-1"></i>Permanen / Seumur Hidup
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-muted" style="font-size: 0.85rem;">
                                            {{ $doc->created_at ? $doc->created_at->translatedFormat('d M Y, H:i') : '-' }}
                                        </td>
                                        <td class="text-center">
                                            <div class="d-inline-flex align-items-center gap-1">
                                                <button type="button" class="btn btn-sm btn-outline-purple p-2 rounded-2" onclick="openModalEdit({{ $doc->id }})" title="Edit Dokumen">
                                                    <i class="mdi mdi-pencil" style="font-size: 0.95rem;"></i>
                                                </button>

                                                <form action="{{ route('master.data.jenis-dokumen.destroy', $doc->id) }}" method="POST" class="d-inline form-delete">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-outline-danger p-2 rounded-2 btn-delete" title="Hapus Dokumen" onclick="confirmDelete(this, '{{ $doc->name }}')">
                                                        <i class="mdi mdi-trash-can-outline" style="font-size: 0.95rem;"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-muted">
                                            <i class="mdi mdi-file-hidden-outline d-block mb-2" style="font-size: 2.5rem; color: #c0c5d0;"></i>
                                            Belum ada data jenis dokumen ditemukan
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($documentTypes->hasPages())
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-3 pt-3 border-top">
                            <div class="text-muted small mb-2 mb-sm-0">
                                Menampilkan {{ $documentTypes->firstItem() ?? 0 }} - {{ $documentTypes->lastItem() ?? 0 }} dari {{ $documentTypes->total() }} data
                            </div>
                            <div>
                                {{ $documentTypes->links() }}
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>

<!-- ================= MODAL TAMBAH ================= -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-white border-bottom">
                <h5 class="modal-title fw-bold text-dark">
                    <i class="mdi mdi-plus-circle me-1" style="color: #9a55ff;"></i> Tambah Jenis Dokumen
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('master.data.jenis-dokumen.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">Nama Dokumen <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" placeholder="Contoh: Sertifikat Hak Milik (SHM)" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">Kode Dokumen (Opsional)</label>
                        <input type="text" class="form-control" name="code" placeholder="Contoh: SHM (Kosongkan untuk otomatis)">
                        <small class="text-muted" style="font-size: 0.78rem;">Jika dikosongkan, kode akan digenerate otomatis dari nama dokumen.</small>
                    </div>

                    <div class="mb-2">
                        <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">Status Masa Berlaku</label>
                        <div class="form-check form-switch mt-1">
                            <input class="form-check-input" type="checkbox" role="switch" name="has_expiry" value="1" id="switchExpiryTambah">
                            <label class="form-check-label text-dark fw-semibold" for="switchExpiryTambah" style="font-size: 0.85rem;">
                                Dokumen ini memiliki tanggal kadaluarsa / masa berlaku
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light border-top">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-gradient-primary btn-sm px-3">
                        <i class="mdi mdi-content-save me-1"></i> Simpan Dokumen
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ================= MODAL EDIT ================= -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-white border-bottom">
                <h5 class="modal-title fw-bold text-dark">
                    <i class="mdi mdi-pencil me-1" style="color: #9a55ff;"></i> Edit Jenis Dokumen
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEdit" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">Nama Dokumen <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">Kode Dokumen <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_code" name="code" required>
                    </div>

                    <div class="mb-2">
                        <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">Status Masa Berlaku</label>
                        <div class="form-check form-switch mt-1">
                            <input class="form-check-input" type="checkbox" role="switch" name="has_expiry" value="1" id="switchExpiryEdit">
                            <label class="form-check-label text-dark fw-semibold" for="switchExpiryEdit" style="font-size: 0.85rem;">
                                Dokumen ini memiliki tanggal kadaluarsa / masa berlaku
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light border-top">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-gradient-primary btn-sm px-3">
                        <i class="mdi mdi-content-save me-1"></i> Perbarui Dokumen
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function openModalTambah() {
        const modal = new bootstrap.Modal(document.getElementById('modalTambah'));
        modal.show();
    }

    async function openModalEdit(id) {
        try {
            Swal.fire({
                title: 'Memuat data...',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });

            const res = await fetch(`{{ url('/master-data/jenis-dokumen') }}/${id}/edit`);
            const data = await res.json();
            Swal.close();

            document.getElementById('edit_name').value = data.name;
            document.getElementById('edit_code').value = data.code;
            document.getElementById('switchExpiryEdit').checked = (data.has_expiry == 1 || data.has_expiry === true);

            const form = document.getElementById('formEdit');
            form.action = `{{ url('/master-data/jenis-dokumen') }}/${id}`;

            const modal = new bootstrap.Modal(document.getElementById('modalEdit'));
            modal.show();
        } catch (err) {
            Swal.close();
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Tidak dapat mengambil data jenis dokumen.'
            });
        }
    }

    function confirmDelete(button, name) {
        Swal.fire({
            title: 'Hapus Jenis Dokumen?',
            text: `Apakah Anda yakin ingin menghapus "${name}"?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                button.closest('form').submit();
            }
        });
    }

    function showFilterLoading() {
        return true;
    }

    function showResetLoading(e) {
        return true;
    }
</script>
@endpush

@endsection
