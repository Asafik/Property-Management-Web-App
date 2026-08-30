@extends('layouts.partial.app')

@section('title', 'Master Data Bahan & Jasa Pengolahan Lahan - Property Management App')

@section('content')
<div class="content-wrapper p-3 p-md-4">
    <!-- Header & Breadcrumbs -->
    <div class="page-header mb-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-1 small">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none text-muted">Dashboard</a></li>
                        <li class="breadcrumb-item text-muted">Master Data</li>
                        <li class="breadcrumb-item active text-primary fw-bold" aria-current="page">Bahan & Jasa Infrastruktur</li>
                    </ol>
                </nav>
                <h3 class="page-title fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                    <span class="p-2 rounded-3 bg-gradient-primary text-white d-inline-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                        <i class="mdi mdi-package-variant-closed"></i>
                    </span>
                    Master Bahan & Jasa Pengolahan Lahan
                </h3>
                <p class="text-muted small mb-0 mt-1">
                    Katalog master material, alat berat, dan jasa infrastruktur site development (PJU, Drainase, Jalan, Pematangan, Air, Listrik, Upah)
                </p>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <button type="button" class="btn btn-gradient-primary btn-sm px-3 d-flex align-items-center gap-1 rounded-pill shadow-sm" data-bs-toggle="modal" data-bs-target="#modalAddMaterial">
                    <i class="mdi mdi-plus-circle"></i> Tambah Master Bahan
                </button>
            </div>
        </div>
    </div>

    <!-- Quick Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <span class="text-muted small">Total Master Bahan</span>
                <h4 class="fw-bold text-primary mb-0 mt-1">{{ \App\Models\InfrastructureMaterial::count() }} Item</h4>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <span class="text-muted small">Kategori Bahan & Jasa</span>
                <h4 class="fw-bold text-dark mb-0 mt-1">{{ \App\Models\InfrastructureMaterial::distinct('category')->count('category') }} Kategori</h4>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <span class="text-muted small">Bahan Aktif</span>
                <h4 class="fw-bold text-success mb-0 mt-1">{{ \App\Models\InfrastructureMaterial::where('is_active', true)->count() }} Item</h4>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <span class="text-muted small">Integrasi Keuangan ERP</span>
                <h4 class="fw-bold text-info mb-0 mt-1">Terhubung</h4>
            </div>
        </div>
    </div>

    <!-- Filter & Search Bar -->
    <div class="card border-0 shadow-sm rounded-4 mb-4 bg-white">
        <div class="card-body p-3">
            <form action="{{ route('master.bahan.index') }}" method="GET" class="row g-2 align-items-center">
                <div class="col-md-5">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-light border-0"><i class="mdi mdi-magnify"></i></span>
                        <input type="text" name="search" class="form-control form-control-sm bg-light border-0" placeholder="Cari nama bahan, kode, atau spesifikasi..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <select name="category" class="form-select form-select-sm bg-light border-0">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-sm btn-primary rounded-pill flex-grow-1">
                        <i class="mdi mdi-filter me-1"></i>Filter
                    </button>
                    <a href="{{ route('master.bahan.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill">
                        Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Materials Table Card -->
    <div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
        <div class="card-header bg-white py-3 px-4 border-bottom d-flex justify-content-between align-items-center">
            <h6 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                <i class="mdi mdi-format-list-bulleted text-primary"></i> Daftar Master Bahan & Jasa Lapangan
            </h6>
            <span class="badge bg-light text-dark fw-bold">{{ $materials->total() }} Bahan Terdaftar</span>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr class="text-muted small">
                        <th class="ps-4">KODE</th>
                        <th>NAMA BAHAN / JASA</th>
                        <th>KATEGORI</th>
                        <th>SATUAN</th>
                        <th>HARGA STANDAR (ESTIMASI)</th>
                        <th>SPESIFIKASI / KETERANGAN</th>
                        <th>STATUS</th>
                        <th class="text-center pe-4">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($materials as $mat)
                        <tr>
                            <td class="ps-4 fw-bold text-primary small">
                                <code>{{ $mat->code ?? '-' }}</code>
                            </td>
                            <td>
                                <span class="fw-bold text-dark d-block">{{ $mat->name }}</span>
                            </td>
                            <td>
                                <span class="badge bg-soft-primary text-primary rounded-pill small px-2 py-1">
                                    {{ $mat->category }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border rounded-pill">{{ $mat->unit }}</span>
                            </td>
                            <td>
                                <span class="fw-bold text-success">
                                    Rp {{ number_format($mat->default_price, 0, ',', '.') }}
                                </span>
                            </td>
                            <td>
                                <span class="small text-muted">{{ Str::limit($mat->specification ?? '-', 45) }}</span>
                            </td>
                            <td>
                                @if($mat->is_active)
                                    <span class="badge bg-soft-success text-success rounded-pill px-2 py-1"><i class="mdi mdi-check-circle me-1"></i>Aktif</span>
                                @else
                                    <span class="badge bg-soft-secondary text-secondary rounded-pill px-2 py-1"><i class="mdi mdi-close-circle me-1"></i>Nonaktif</span>
                                @endif
                            </td>
                            <td class="text-center pe-4">
                                <div class="d-flex justify-content-center gap-1">
                                    <button type="button" class="btn btn-sm btn-outline-primary p-1 px-2 rounded-2" 
                                            onclick='openEditMaterialModal(@json($mat))' title="Edit Master Bahan">
                                        <i class="mdi mdi-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-danger p-1 px-2 rounded-2" 
                                            onclick="deleteMaterial({{ $mat->id }}, '{{ addslashes($mat->name) }}')" title="Hapus Master Bahan">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="mdi mdi-package-variant-closed fs-1 opacity-25"></i>
                                <p class="mt-2 mb-0">Belum ada data master bahan.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($materials->hasPages())
            <div class="card-footer bg-white border-top py-3 px-4 d-flex justify-content-between align-items-center">
                <span class="small text-muted">Menampilkan {{ $materials->firstItem() }} - {{ $materials->lastItem() }} dari {{ $materials->total() }} data</span>
                {{ $materials->links() }}
            </div>
        @endif
    </div>
</div>

<!-- MODAL ADD MATERIAL -->
<div class="modal fade" id="modalAddMaterial" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-gradient-primary text-white p-3">
                <h5 class="modal-title fw-bold mb-0 text-white"><i class="mdi mdi-plus-box me-1"></i> Tambah Master Bahan Baru</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('master.bahan.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Nama Bahan / Jasa <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="Contoh: Tiang PJU 7m / Paving Block K-300" required>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">Kategori <span class="text-danger">*</span></label>
                            <select name="category" class="form-select" required>
                                <option value="PJU & Penerangan">PJU & Penerangan</option>
                                <option value="Drainase & Sanitasi">Drainase & Sanitasi</option>
                                <option value="Aksesibilitas Jalan">Aksesibilitas Jalan</option>
                                <option value="Pematangan Lahan">Pematangan Lahan (Cut & Fill)</option>
                                <option value="Jaringan Air Bersih">Jaringan Air Bersih</option>
                                <option value="Jaringan Listrik & Gerbang">Jaringan Listrik & Gerbang</option>
                                <option value="Upah Tenaga Kerja">Upah Tenaga Kerja / Mandor</option>
                                <option value="Alat Berat & Sewa">Alat Berat & Sewa</option>
                                <option value="Lain-lain">Lain-lain</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">Satuan <span class="text-danger">*</span></label>
                            <input type="text" name="unit" class="form-control" placeholder="sak, m3, m2, batang, rit, unit, hari" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Harga Standar Estimasi (Rp)</label>
                        <input type="number" name="default_price" class="form-control" placeholder="0" min="0">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Kode Bahan (Opsional)</label>
                        <input type="text" name="code" class="form-control" placeholder="Otomatis digenerate jika kosong">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Spesifikasi / Catatan Teknis</label>
                        <textarea name="specification" class="form-control" rows="2" placeholder="Catatan spesifikasi teknis / standar SNI..."></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light p-3">
                    <button type="button" class="btn btn-secondary btn-sm px-3 rounded-pill" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-gradient-primary btn-sm px-4 rounded-pill"><i class="mdi mdi-check me-1"></i>Simpan Master Bahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDIT MATERIAL -->
<div class="modal fade" id="modalEditMaterial" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-gradient-primary text-white p-3">
                <h5 class="modal-title fw-bold mb-0 text-white"><i class="mdi mdi-pencil-box me-1"></i> Edit Master Bahan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditMaterial" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Nama Bahan / Jasa <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="editName" class="form-control" required>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">Kategori <span class="text-danger">*</span></label>
                            <select name="category" id="editCategory" class="form-select" required>
                                <option value="PJU & Penerangan">PJU & Penerangan</option>
                                <option value="Drainase & Sanitasi">Drainase & Sanitasi</option>
                                <option value="Aksesibilitas Jalan">Aksesibilitas Jalan</option>
                                <option value="Pematangan Lahan">Pematangan Lahan (Cut & Fill)</option>
                                <option value="Jaringan Air Bersih">Jaringan Air Bersih</option>
                                <option value="Jaringan Listrik & Gerbang">Jaringan Listrik & Gerbang</option>
                                <option value="Upah Tenaga Kerja">Upah Tenaga Kerja / Mandor</option>
                                <option value="Alat Berat & Sewa">Alat Berat & Sewa</option>
                                <option value="Lain-lain">Lain-lain</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">Satuan <span class="text-danger">*</span></label>
                            <input type="text" name="unit" id="editUnit" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Harga Standar Estimasi (Rp)</label>
                        <input type="number" name="default_price" id="editPrice" class="form-control" min="0">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Kode Bahan</label>
                        <input type="text" name="code" id="editCode" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Spesifikasi / Catatan</label>
                        <textarea name="specification" id="editSpec" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="editIsActive">
                        <label class="form-check-label small fw-bold text-dark" for="editIsActive">Status Aktif (Tersedia untuk proyek)</label>
                    </div>
                </div>
                <div class="modal-footer bg-light p-3">
                    <button type="button" class="btn btn-secondary btn-sm px-3 rounded-pill" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-gradient-primary btn-sm px-4 rounded-pill"><i class="mdi mdi-check me-1"></i>Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function openEditMaterialModal(mat) {
        $('#editName').val(mat.name);
        $('#editCategory').val(mat.category);
        $('#editUnit').val(mat.unit);
        $('#editPrice').val(mat.default_price);
        $('#editCode').val(mat.code);
        $('#editSpec').val(mat.specification);
        $('#editIsActive').prop('checked', mat.is_active == 1);

        $('#formEditMaterial').attr('action', `/master-data-bahan-infrastruktur/${mat.id}/update`);
        const modal = new bootstrap.Modal(document.getElementById('modalEditMaterial'));
        modal.show();
    }

    function deleteMaterial(id, name) {
        Swal.fire({
            title: 'Hapus Master Bahan?',
            text: `Data master bahan "${name}" akan dihapus dari katalog.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/master-data-bahan-infrastruktur/${id}`,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'DELETE'
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: res.message,
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.reload();
                            });
                        }
                    }
                });
            }
        });
    }

    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            confirmButtonColor: '#9a55ff'
        });
    @endif
</script>
@endpush
