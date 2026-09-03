@extends('layouts.partial.app')

@section('title', 'Master Tahapan & Kategori Progress Pembangunan - Property Management App')

@section('content')
<div class="container-fluid px-1 px-sm-2 px-md-3 py-2 py-md-3">

    <!-- Header Banner -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 header-card" style="background: linear-gradient(135deg, #ffffff 0%, #f9f8fe 100%); border-radius: 14px;">
                <div class="card-body p-3 p-md-4 d-flex justify-content-between align-items-center">
                    <div>
                        <span class="badge bg-primary px-3 py-1.5 mb-2" style="font-size: 0.76rem; border-radius: 6px;">
                            <i class="mdi mdi-tune-vertical me-1"></i>Master Template Pembangunan Unit
                        </span>
                        <h3 class="text-dark mb-1 fw-bold" style="font-size: 1.35rem;">
                            Master Tahapan & Kategori Progress Pembangunan
                        </h3>
                        <p class="text-muted mb-0" style="font-size: 0.88rem;">
                            Kelola kategori dinamis (Perizinan s/d Finishing) dan item template standar RAP unit kavling
                        </p>
                    </div>
                    <div class="d-none d-sm-block pe-2">
                        <i class="mdi mdi-format-list-checks" style="font-size: 3.2rem; color: #9a55ff; opacity: 0.25;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Metric KPI Cards -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-4">
            <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 12px; background: #ffffff; border-left: 4px solid #9a55ff !important;">
                <span class="text-muted small fw-semibold text-uppercase d-block" style="font-size: 0.75rem;">Total Tahapan / Kategori</span>
                <h4 class="fw-bold text-dark mt-1 mb-0">{{ $totalCategories }} Kategori</h4>
                <small class="text-muted" style="font-size: 0.75rem;">Termasuk Perizinan & Legalitas</small>
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 12px; background: #ffffff; border-left: 4px solid #06b6d4 !important;">
                <span class="text-muted small fw-semibold text-uppercase d-block" style="font-size: 0.75rem;">Total Item Pekerjaan Template</span>
                <h4 class="fw-bold text-dark mt-1 mb-0">{{ $totalItems }} Item Standar</h4>
                <small class="text-muted" style="font-size: 0.75rem;">Digunakan saat generate RAP unit</small>
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 12px; background: #ffffff; border-left: 4px solid #10b981 !important;">
                <span class="text-muted small fw-semibold text-uppercase d-block" style="font-size: 0.75rem;">Estimasi Total Anggaran Template</span>
                <h4 class="fw-bold text-success font-monospace mt-1 mb-0">Rp {{ number_format($totalEstimasi, 0, ',', '.') }}</h4>
                <small class="text-muted" style="font-size: 0.75rem;">Sebelum penambahan PPN 10%</small>
            </div>
        </div>
    </div>

    <!-- Action Button Bar -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <h5 class="fw-bold text-dark mb-0">
            <i class="mdi mdi-layers-outline me-1 text-primary"></i>Daftar Tahapan Pekerjaan Unit (Dinamis)
        </h5>
        <button type="button" class="btn btn-sm btn-gradient-primary shadow-sm px-3 py-2" onclick="openModalCategory('tambah')" style="border-radius: 8px; font-weight: 600;">
            <i class="mdi mdi-plus-circle me-1"></i>+ Tambah Tahapan / Kategori Baru
        </button>
    </div>

    <!-- Category Cards List -->
    <div class="row g-3">
        @forelse($categories as $cat)
            @php
                $catSubtotal = $cat->items->sum(fn($i) => $i->default_volume * $i->default_harga_satuan);
            @endphp
            <div class="col-12">
                <div class="card shadow-sm border-0 mb-3" style="border-radius: 12px; overflow: hidden;">
                    <div class="card-header bg-white py-3 px-4 d-flex flex-wrap justify-content-between align-items-center gap-2 border-bottom">
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-light text-primary border font-monospace px-2.5 py-1.5" style="font-size: 0.85rem; font-weight: 700;">
                                Prefix: {{ $cat->prefix }}
                            </span>
                            <h5 class="mb-0 fw-bold text-dark d-flex align-items-center">
                                <i class="mdi mdi-{{ $cat->icon ?? 'folder-outline' }} me-2" style="color: #9a55ff;"></i>
                                {{ $cat->nama_kategori }}
                            </h5>
                            @if(!$cat->is_active)
                                <span class="badge bg-secondary ms-2">Non-Aktif</span>
                            @endif
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="text-muted small me-2">
                                <strong>{{ $cat->items->count() }}</strong> Item | Subtotal: <strong class="text-success font-monospace">Rp {{ number_format($catSubtotal, 0, ',', '.') }}</strong>
                            </span>
                            <button type="button" class="btn btn-xs btn-outline-success" onclick="openModalItem('tambah', {{ $cat->id }}, '{{ addslashes($cat->nama_kategori) }}')" title="Tambah Item ke Kategori Ini" style="border-radius: 6px; padding: 4px 10px; font-weight: 600;">
                                <i class="mdi mdi-plus me-1"></i>Tambah Item
                            </button>
                            <button type="button" class="btn btn-xs btn-outline-primary" onclick="openModalCategory('edit', {{ json_encode($cat) }})" title="Edit Kategori" style="border-radius: 6px; padding: 4px 10px;">
                                <i class="mdi mdi-pencil"></i>
                            </button>
                            <form action="{{ route('master.progress.category.destroy', $cat->id) }}" method="POST" class="d-inline form-delete-cat">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-xs btn-outline-danger btn-delete-cat" title="Hapus Kategori Ini" style="border-radius: 6px; padding: 4px 10px;">
                                    <i class="mdi mdi-trash-can-outline"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped align-middle mb-0" style="font-size: 0.87rem;">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 70px;" class="text-center">KODE</th>
                                        <th>URAIAN PEKERJAAN</th>
                                        <th style="width: 100px;" class="text-center">VOLUME</th>
                                        <th style="width: 80px;" class="text-center">SATUAN</th>
                                        <th style="width: 160px;" class="text-end">HARGA SATUAN</th>
                                        <th style="width: 170px;" class="text-end">TOTAL ESTIMASI</th>
                                        <th>KETERANGAN / SPESIFIKASI</th>
                                        <th style="width: 100px;" class="text-center">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($cat->items as $item)
                                        @php
                                            $itemTotal = round($item->default_volume * $item->default_harga_satuan);
                                        @endphp
                                        <tr>
                                            <td class="text-center font-monospace fw-bold text-primary">{{ $item->kode }}</td>
                                            <td class="fw-semibold text-dark">{{ $item->uraian }}</td>
                                            <td class="text-center">{{ $item->default_volume }}</td>
                                            <td class="text-center"><span class="badge bg-light text-dark border">{{ $item->satuan }}</span></td>
                                            <td class="text-end font-monospace">Rp {{ number_format($item->default_harga_satuan, 0, ',', '.') }}</td>
                                            <td class="text-end font-monospace fw-bold text-success">Rp {{ number_format($itemTotal, 0, ',', '.') }}</td>
                                            <td class="text-muted small">{{ $item->keterangan ?? '-' }}</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-xs btn-link text-primary p-0 me-2" onclick="openModalItem('edit', {{ $cat->id }}, '{{ addslashes($cat->nama_kategori) }}', {{ json_encode($item) }})" title="Edit Item">
                                                    <i class="mdi mdi-pencil font-size-16"></i>
                                                </button>
                                                <form action="{{ route('master.progress.item.destroy', $item->id) }}" method="POST" class="d-inline form-delete-item">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-xs btn-link text-danger p-0 btn-delete-item" title="Hapus Item">
                                                        <i class="mdi mdi-trash-can-outline font-size-16"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-3 text-muted">
                                                Belum ada item pekerjaan di kategori ini. Klik tombol <strong>+ Tambah Item</strong> di pojok kanan atas kategori.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card p-5 text-center text-muted border-0 shadow-sm" style="border-radius: 12px;">
                    <i class="mdi mdi-folder-open-outline mb-2" style="font-size: 3rem; opacity: 0.3;"></i>
                    <h5 class="fw-bold">Belum Ada Kategori Progress</h5>
                    <p class="small mb-3">Klik tombol Tambah Tahapan / Kategori Baru untuk membuat struktur RAP.</p>
                    <div>
                        <button type="button" class="btn btn-primary btn-sm px-4" onclick="openModalCategory('tambah')">
                            + Tambah Kategori Pertama
                        </button>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

</div>

<!-- MODAL: TAMBAH / EDIT KATEGORI PROGRESS -->
<div class="modal fade" id="modalCategory" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 14px; overflow: hidden;">
            <div class="modal-header bg-white border-bottom py-3 px-4">
                <h5 class="modal-title fw-bold text-dark" id="modalCategoryTitle">Tambah Kategori Progress</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formCategory" method="POST" action="{{ route('master.progress.category.store') }}">
                @csrf
                <input type="hidden" name="_method" id="categoryFormMethod" value="POST">
                <div class="modal-body p-4 bg-light">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Nama Kategori / Tahapan Pembangunan <span class="text-danger">*</span></label>
                        <input type="text" name="nama_kategori" id="cat_nama" class="form-control" placeholder="Contoh: IX. PEKERJAAN INTERIOR & MEUBEL" required>
                        <small class="text-muted" style="font-size: 0.72rem;">Sertakan nomor romawi di awal (misal: I. PERIZINAN & LEGALITAS)</small>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label small fw-bold text-dark">Prefix Kode <span class="text-danger">*</span></label>
                            <input type="text" name="prefix" id="cat_prefix" class="form-control font-monospace" placeholder="Contoh: P / 1 / 2 / 8" required>
                            <small class="text-muted" style="font-size: 0.72rem;">Awalan kode item (misal: P.1, 1.1)</small>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold text-dark">Urutan Tampil</label>
                            <input type="number" name="urutan" id="cat_urutan" class="form-control" placeholder="1, 2, 3...">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Icon (MDI Icon Name)</label>
                        <input type="text" name="icon" id="cat_icon" class="form-control font-monospace" placeholder="folder-outline / tools / roofing / brush">
                        <small class="text-muted" style="font-size: 0.72rem;">Contoh: file-certificate-outline, tools, foundation, bridge, wall, roofing, brush, dots-horizontal</small>
                    </div>
                </div>
                <div class="modal-footer bg-white border-top py-2.5 px-4 d-flex justify-content-end">
                    <button type="button" class="btn btn-sm btn-light border px-3" data-bs-dismiss="modal" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-gradient-primary px-4 fw-semibold">Simpan Kategori</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL: TAMBAH / EDIT ITEM PEKERJAAN -->
<div class="modal fade" id="modalItem" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 14px; overflow: hidden;">
            <div class="modal-header bg-white border-bottom py-3 px-4">
                <div>
                    <h5 class="modal-title fw-bold text-dark" id="modalItemTitle">Tambah Item Pekerjaan</h5>
                    <small class="text-primary fw-semibold" id="modalItemCategorySubtitle">-</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formItem" method="POST" action="">
                @csrf
                <input type="hidden" name="_method" id="itemFormMethod" value="POST">
                <div class="modal-body p-4 bg-light">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Uraian / Nama Pekerjaan <span class="text-danger">*</span></label>
                        <input type="text" name="uraian" id="item_uraian" class="form-control" placeholder="Contoh: Pasangan Dinding Bata Ringan (Hebel)" required>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-dark">Kode Item (Opsional)</label>
                            <input type="text" name="kode" id="item_kode" class="form-control font-monospace" placeholder="Otomatis jika kosong">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-dark">Default Volume <span class="text-danger">*</span></label>
                            <input type="number" step="any" name="default_volume" id="item_volume" class="form-control text-center" value="1" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-dark">Satuan <span class="text-danger">*</span></label>
                            <input type="text" name="satuan" id="item_satuan" class="form-control text-center" placeholder="m² / m³ / ls / unit / paket" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Estimasi Harga Satuan (Rp) <span class="text-danger">*</span></label>
                        <input type="number" name="default_harga_satuan" id="item_harga" class="form-control text-end font-monospace" placeholder="0" required>
                    </div>
                    <div class="mb-0">
                        <label class="form-label small fw-bold text-dark">Keterangan / Spesifikasi Bahan</label>
                        <input type="text" name="keterangan" id="item_keterangan" class="form-control" placeholder="Contoh: Mortar instan / Besi 10mm / Merk Dulux">
                    </div>
                </div>
                <div class="modal-footer bg-white border-top py-2.5 px-4 d-flex justify-content-end">
                    <button type="button" class="btn btn-sm btn-light border px-3" data-bs-dismiss="modal" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-gradient-primary px-4 fw-semibold">Simpan Item Pekerjaan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
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
            title.innerText = 'Tambah Kategori Progress Baru';
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
            document.getElementById('item_harga').value = data.default_harga_satuan;
            document.getElementById('item_keterangan').value = data.keterangan || '';
        } else {
            title.innerText = 'Tambah Item Pekerjaan Baru';
            form.action = '/master-data/progress-kategori/' + categoryId + '/item';
            method.value = 'POST';
            document.getElementById('item_uraian').value = '';
            document.getElementById('item_kode').value = '';
            document.getElementById('item_volume').value = 1;
            document.getElementById('item_satuan').value = 'ls';
            document.getElementById('item_harga').value = '';
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
