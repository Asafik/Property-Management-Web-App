@extends('layouts.partial.app')

@section('title', 'Master Tahapan Progress Pembangunan - Property Management App')

@section('content')
<style>
    .header-card {
        background: #ffffff;
        border-radius: 12px !important;
        border: none !important;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04);
    }
    .stat-card-kpi {
        background: #ffffff;
        border-radius: 12px;
        border: 1px solid #f1f5f9;
        transition: all 0.25s ease;
    }
    .stat-card-kpi:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(154, 85, 255, 0.08);
        border-color: #e2e8f0;
    }
    .cat-card-wrapper {
        border-radius: 12px;
        border: 1px solid #eef2f6;
        background: #ffffff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);
        transition: all 0.2s ease;
    }
    .cat-card-wrapper:hover {
        border-color: #cbd5e1;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
    }
    .category-header-bar {
        background: #f8fafc;
        min-height: 56px;
        padding: 0.85rem 1.25rem;
        border-bottom: 1px solid #e2e8f0;
    }
    .btn-add-item-custom {
        height: 32px;
        padding: 0 12px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 0.8rem;
        font-weight: 600;
        border-radius: 6px;
        background: #28a745;
        border: 1px solid #28a745;
        color: #ffffff;
        box-shadow: 0 2px 6px rgba(40, 167, 69, 0.25);
        transition: all 0.2s ease;
    }
    .btn-add-item-custom:hover {
        background: #218838;
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(40, 167, 69, 0.35);
    }
    .table-progress-master thead th {
        background-color: #f8fafc !important;
        color: #475569 !important;
        font-size: 0.78rem !important;
        font-weight: 700 !important;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        border-bottom: 1px solid #e2e8f0 !important;
        padding: 0.75rem 1rem !important;
    }
    .table-progress-master tbody td {
        padding: 0.85rem 1rem !important;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.86rem;
    }
    .table-progress-master tbody tr:hover {
        background-color: #faf8ff !important;
    }
    .btn-action {
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        margin: 0 2px;
        transition: all 0.2s ease;
        border: none;
        cursor: pointer;
        font-size: 0.95rem;
        text-decoration: none;
        vertical-align: middle;
    }
    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }
    .btn-action.edit {
        background: linear-gradient(135deg, #ffc107, #ffdb6d) !important;
        color: #2c2e3f !important;
    }
    .btn-action.delete {
        background: linear-gradient(135deg, #dc3545, #e4606d) !important;
        color: #fff !important;
    }
</style>

<div class="container-fluid px-1 px-sm-2 px-md-3 py-2 py-md-3">

    <!-- 1. Header Banner Card -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 header-card">
                <div class="card-body p-3 p-md-4">
                    <h4 class="text-dark mb-1 fw-bold" style="font-size: 1.35rem;">
                        Master Tahapan Progress Pembangunan
                    </h4>
                    <p class="text-muted mb-0" style="font-size: 0.88rem;">
                        Kelola kategori tahapan dan item template standar RAP pembangunan unit.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. Metric KPI Cards (Dashboard Style) -->
    <div class="row g-3 mb-3 mb-md-4">
        <!-- Card 1: Total Tahapan / Kategori -->
        <div class="col-12 col-sm-6 col-md-4">
            <div class="card shadow-sm border-0 h-100 stat-card-kpi">
                <div class="card-body p-3">
                    <h4 class="text-dark mb-1 fw-bold">{{ $totalCategories }} <span style="font-size: 0.85rem; font-weight: 500;" class="text-muted">Kategori</span></h4>
                    <p class="text-muted mb-0" style="font-size: 0.82rem;">Tahapan Pekerjaan</p>
                </div>
            </div>
        </div>

        <!-- Card 2: Total Item Pekerjaan -->
        <div class="col-12 col-sm-6 col-md-4">
            <div class="card shadow-sm border-0 h-100 stat-card-kpi">
                <div class="card-body p-3">
                    <h4 class="text-info mb-1 fw-bold">{{ $totalItems }} <span style="font-size: 0.85rem; font-weight: 500;" class="text-muted">Item</span></h4>
                    <p class="text-muted mb-0" style="font-size: 0.82rem;">Template Standar RAP</p>
                </div>
            </div>
        </div>

        <!-- Card 3: Estimasi Total Anggaran Template -->
        <div class="col-12 col-sm-6 col-md-4">
            <div class="card shadow-sm border-0 h-100 stat-card-kpi">
                <div class="card-body p-3">
                    <h4 class="text-success mb-1 fw-bold" style="font-size: 1.1rem;">Rp {{ number_format($totalEstimasi, 0, ',', '.') }}</h4>
                    <p class="text-muted mb-0" style="font-size: 0.82rem;">Estimasi Total RAP</p>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. Unified Categories Table Card -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0" style="border-radius: 14px; overflow: hidden;">
                <div class="card-header bg-white py-3 px-3 px-md-4 d-flex flex-wrap justify-content-between align-items-center gap-2 border-bottom">
                    <h5 class="fw-bold text-dark mb-0" style="font-size: 1.05rem;">
                        Daftar Tahapan Pekerjaan
                    </h5>
                    <button type="button" class="btn btn-sm btn-gradient-primary shadow-sm px-3 py-2 text-white fw-bold d-inline-flex align-items-center gap-1.5" onclick="openModalCategory('tambah')" style="border-radius: 8px;">
                        + Tambah Kategori
                    </button>
                </div>

                <div class="card-body p-3 p-md-4">
                    @forelse($categories as $cat)
                        @php
                            $catSubtotal = $cat->items->sum(fn($i) => $i->default_volume * $i->default_harga_satuan);
                        @endphp

                        <div class="category-section-block border rounded-3 mb-4 {{ !$loop->last ? 'mb-4' : '' }}" style="overflow: hidden; background: #ffffff;">
                            <!-- Category Header Bar -->
                            <div class="category-header-bar d-flex flex-wrap justify-content-between align-items-center gap-2">
                                <div class="d-flex align-items-center gap-2.5 flex-wrap">
                                    <span class="badge bg-primary bg-opacity-10 text-primary font-monospace px-2.5 py-1.5 rounded-2 fw-bold" style="font-size: 0.82rem;">
                                        Prefix: {{ $cat->prefix ?? '-' }}
                                    </span>
                                    <h6 class="mb-0 fw-bold text-dark d-flex align-items-center" style="font-size: 0.98rem;">
                                        <i class="mdi mdi-{{ $cat->icon ?? 'folder-outline' }} me-2" style="color: #9a55ff; font-size: 1.15rem;"></i>
                                        {{ $cat->nama_kategori }}
                                    </h6>
                                    @if(!$cat->is_active)
                                        <span class="badge bg-secondary ms-1">Non-Aktif</span>
                                    @endif
                                </div>

                                <div class="d-flex align-items-center">
                                    <button type="button" class="btn-add-item-custom shadow-sm me-3 me-md-4" onclick="openModalItem('tambah', {{ $cat->id }}, '{{ addslashes($cat->nama_kategori) }}')" title="Tambah Item ke Kategori Ini">
                                        + Tambah Item
                                    </button>
                                    <div class="d-inline-flex align-items-center gap-1">
                                        <button type="button" class="btn-action edit" onclick="openModalCategory('edit', {{ json_encode($cat) }})" title="Edit Kategori">
                                            <i class="mdi mdi-pencil"></i>
                                        </button>
                                        <form action="{{ route('master.progress.category.destroy', $cat->id) }}" method="POST" class="d-inline form-delete-cat m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn-action delete btn-delete-cat" title="Hapus Kategori Ini">
                                                <i class="mdi mdi-trash-can-outline"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Table of Items for this Category -->
                            <div class="table-responsive">
                                <table class="table table-hover table-progress-master align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width: 75px;" class="text-center">KODE</th>
                                            <th>URAIAN PEKERJAAN</th>
                                            <th style="width: 95px;" class="text-center">VOLUME</th>
                                            <th style="width: 85px;" class="text-center">SATUAN</th>
                                            <th style="width: 155px;" class="text-end">HARGA SATUAN</th>
                                            <th style="width: 165px;" class="text-end">TOTAL ESTIMASI</th>
                                            <th>KETERANGAN / SPESIFIKASI</th>
                                            <th style="width: 90px;" class="text-center">AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($cat->items as $item)
                                            @php
                                                $itemTotal = round($item->default_volume * $item->default_harga_satuan);
                                            @endphp
                                            <tr>
                                                <td class="text-center font-monospace fw-bold text-primary">
                                                    <span class="badge bg-primary bg-opacity-10 text-primary px-2 py-1">{{ $item->kode }}</span>
                                                </td>
                                                <td class="fw-bold text-dark">{{ $item->uraian }}</td>
                                                <td class="text-center fw-semibold">{{ $item->default_volume }}</td>
                                                <td class="text-center">
                                                    <span class="badge bg-light text-dark border px-2 py-1">{{ $item->satuan }}</span>
                                                </td>
                                                <td class="text-end font-monospace text-secondary">Rp {{ number_format($item->default_harga_satuan, 0, ',', '.') }}</td>
                                                <td class="text-end font-monospace fw-bold text-success">Rp {{ number_format($itemTotal, 0, ',', '.') }}</td>
                                                <td class="text-muted small">{{ $item->keterangan ?? '-' }}</td>
                                                <td class="text-center">
                                                    <div class="d-inline-flex align-items-center gap-1 justify-content-center">
                                                        <button type="button" class="btn-action edit" onclick="openModalItem('edit', {{ $cat->id }}, '{{ addslashes($cat->nama_kategori) }}', {{ json_encode($item) }})" title="Edit Item">
                                                            <i class="mdi mdi-pencil"></i>
                                                        </button>
                                                        <form action="{{ route('master.progress.item.destroy', $item->id) }}" method="POST" class="d-inline form-delete-item m-0">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn-action delete btn-delete-item" title="Hapus Item">
                                                                <i class="mdi mdi-trash-can-outline"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center py-3 text-muted">
                                                    Belum ada item di kategori ini.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr class="bg-light bg-opacity-75" style="border-top: 1px solid #e2e8f0;">
                                            <td colspan="4" class="text-start ps-3 ps-md-4 fw-bold text-dark small py-3">
                                                Subtotal {{ $cat->nama_kategori }} ({{ $cat->items->count() }} Item)
                                            </td>
                                            <td colspan="4" class="text-end pe-3 pe-md-4 font-monospace fw-bold text-success py-3" style="font-size: 1rem;">
                                                Rp {{ number_format($catSubtotal, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    @empty
                        <div class="p-5 text-center text-muted">
                            <h5 class="fw-bold text-dark">Belum Ada Kategori Progress</h5>
                            <p class="small mb-3 text-muted">Klik tombol Tambah Kategori untuk membuat tahapan template RAP.</p>
                            <div>
                                <button type="button" class="btn btn-gradient-primary btn-sm px-4 text-white fw-semibold rounded-3 shadow-sm" onclick="openModalCategory('tambah')">
                                    + Tambah Kategori Pertama
                                </button>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

</div>

<!-- MODAL: TAMBAH / EDIT KATEGORI PROGRESS -->
<div class="modal fade" id="modalCategory" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-white border-bottom">
                <h5 class="modal-title fw-bold" style="color: #2c2e3f;">
                    <i class="mdi mdi-folder-plus me-2" style="color: #9a55ff;"></i>
                    <span id="modalCategoryTitle">Tambah Kategori</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formCategory" method="POST" action="{{ route('master.progress.category.store') }}">
                @csrf
                <input type="hidden" name="_method" id="categoryFormMethod" value="POST">
                <div class="modal-body p-4 bg-white">
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color: #2c2e3f;">Nama Kategori / Tahapan <span class="text-danger">*</span></label>
                        <input type="text" name="nama_kategori" id="cat_nama" class="form-control" placeholder="Contoh: I. PERIZINAN & LEGALITAS" required>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-bold" style="color: #2c2e3f;">Prefix Kode <span class="text-danger">*</span></label>
                            <input type="text" name="prefix" id="cat_prefix" class="form-control font-monospace" placeholder="Contoh: P, 1, 2" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-bold" style="color: #2c2e3f;">Urutan</label>
                            <input type="number" name="urutan" id="cat_urutan" class="form-control" placeholder="1, 2, 3...">
                        </div>
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-bold" style="color: #2c2e3f;">Icon (MDI Icon)</label>
                        <input type="text" name="icon" id="cat_icon" class="form-control font-monospace" placeholder="tools, wall, roofing, brush...">
                    </div>
                </div>
                <div class="modal-footer bg-light border-top">
                    <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-gradient-primary btn-sm px-4">
                        <i class="mdi mdi-content-save me-1"></i>
                        <span>Simpan Kategori</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL: TAMBAH / EDIT ITEM PEKERJAAN -->
<div class="modal fade" id="modalItem" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-white border-bottom">
                <div>
                    <h5 class="modal-title fw-bold mb-0" style="color: #2c2e3f;">
                        <i class="mdi mdi-format-list-checks me-2" style="color: #9a55ff;"></i>
                        <span id="modalItemTitle">Tambah Item Pekerjaan</span>
                    </h5>
                    <small class="text-muted" id="modalItemCategorySubtitle">-</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formItem" method="POST" action="">
                @csrf
                <input type="hidden" name="_method" id="itemFormMethod" value="POST">
                <div class="modal-body p-4 bg-white">
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color: #2c2e3f;">Nama Pekerjaan <span class="text-danger">*</span></label>
                        <input type="text" name="uraian" id="item_uraian" class="form-control" placeholder="Contoh: Pasangan Dinding Bata Ringan" required>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-bold" style="color: #2c2e3f;">Kode (Opsional)</label>
                            <input type="text" name="kode" id="item_kode" class="form-control font-monospace" placeholder="Otomatis jika kosong">
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-bold" style="color: #2c2e3f;">Satuan <span class="text-danger">*</span></label>
                            <input type="text" name="satuan" id="item_satuan" class="form-control text-center" placeholder="m², m³, unit, ls" required>
                        </div>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-bold" style="color: #2c2e3f;">Volume <span class="text-danger">*</span></label>
                            <input type="number" step="any" name="default_volume" id="item_volume" class="form-control text-center" value="1" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-bold" style="color: #2c2e3f;">Harga Satuan <span class="text-danger">*</span></label>
                            <input type="text" id="item_harga_display" class="form-control" placeholder="Rp 0" oninput="handleHargaInput(this)" required>
                            <input type="hidden" name="default_harga_satuan" id="item_harga" value="0">
                        </div>
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-bold" style="color: #2c2e3f;">Keterangan (Opsional)</label>
                        <input type="text" name="keterangan" id="item_keterangan" class="form-control" placeholder="Spesifikasi bahan / keterangan">
                    </div>
                </div>
                <div class="modal-footer bg-light border-top">
                    <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-gradient-primary btn-sm px-4">
                        <i class="mdi mdi-content-save me-1"></i>
                        <span>Simpan Item</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function handleHargaInput(input) {
        let raw = input.value.replace(/[^0-9]/g, '');
        let hidden = document.getElementById('item_harga');
        if (!raw || raw === '') {
            hidden.value = 0;
            input.value = '';
            return;
        }
        let num = parseInt(raw, 10);
        hidden.value = num;
        input.value = 'Rp ' + new Intl.NumberFormat('id-ID').format(num);
    }

    function openModalCategory(mode, data = null) {
        let form = document.getElementById('formCategory');
        let title = document.getElementById('modalCategoryTitle');
        let method = document.getElementById('categoryFormMethod');

        if (mode === 'edit' && data) {
            title.innerText = 'Edit Kategori: ' + data.nama_kategori;
            form.action = '/master-data/progress-kategori/' + data.id;
            method.value = 'PUT';
            document.getElementById('cat_nama').value = data.nama_kategori;
            document.getElementById('cat_prefix').value = data.prefix;
            document.getElementById('cat_urutan').value = data.urutan;
            document.getElementById('cat_icon').value = data.icon;
        } else {
            title.innerText = 'Tambah Kategori Baru';
            form.action = '{{ route("master.progress.category.store") }}';
            method.value = 'POST';
            document.getElementById('cat_nama').value = '';
            document.getElementById('cat_prefix').value = '';
            document.getElementById('cat_urutan').value = '';
            document.getElementById('cat_icon').value = 'folder-outline';
        }

        if (window.bootstrap && bootstrap.Modal) {
            new bootstrap.Modal(document.getElementById('modalCategory')).show();
        } else if (window.jQuery) {
            $('#modalCategory').modal('show');
        }
    }

    function openModalItem(mode, categoryId, categoryTitle, data = null) {
        let form = document.getElementById('formItem');
        let title = document.getElementById('modalItemTitle');
        let subtitle = document.getElementById('modalItemCategorySubtitle');
        let method = document.getElementById('itemFormMethod');

        subtitle.innerText = 'Kategori: ' + categoryTitle;

        if (mode === 'edit' && data) {
            title.innerText = 'Edit Item Pekerjaan';
            form.action = '/master-data/progress-kategori/item/' + data.id;
            method.value = 'PUT';
            document.getElementById('item_uraian').value = data.uraian;
            document.getElementById('item_kode').value = data.kode;
            document.getElementById('item_volume').value = data.default_volume;
            document.getElementById('item_satuan').value = data.satuan;
            
            let hrg = data.default_harga_satuan ? Math.round(data.default_harga_satuan) : 0;
            document.getElementById('item_harga').value = hrg;
            document.getElementById('item_harga_display').value = hrg ? ('Rp ' + new Intl.NumberFormat('id-ID').format(hrg)) : '';
            
            document.getElementById('item_keterangan').value = data.keterangan || '';
        } else {
            title.innerText = 'Tambah Item Pekerjaan';
            form.action = '/master-data/progress-kategori/' + categoryId + '/item';
            method.value = 'POST';
            document.getElementById('item_uraian').value = '';
            document.getElementById('item_kode').value = '';
            document.getElementById('item_volume').value = 1;
            document.getElementById('item_satuan').value = 'ls';
            document.getElementById('item_harga').value = 0;
            document.getElementById('item_harga_display').value = '';
            document.getElementById('item_keterangan').value = '';
        }

        if (window.bootstrap && bootstrap.Modal) {
            new bootstrap.Modal(document.getElementById('modalItem')).show();
        } else if (window.jQuery) {
            $('#modalItem').modal('show');
        }
    }

    $(document).ready(function() {
        // SweetAlert Delete Category
        $('.btn-delete-cat').on('click', function(e) {
            e.preventDefault();
            let form = $(this).closest('form');
            Swal.fire({
                title: 'Hapus Kategori Ini?',
                text: 'Semua item pekerjaan di dalam kategori ini juga akan terhapus!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus Kategori!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });

        // SweetAlert Delete Item
        $('.btn-delete-item').on('click', function(e) {
            e.preventDefault();
            let form = $(this).closest('form');
            Swal.fire({
                title: 'Hapus Item Pekerjaan Ini?',
                text: 'Item akan dihapus dari template master kategori!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endpush
