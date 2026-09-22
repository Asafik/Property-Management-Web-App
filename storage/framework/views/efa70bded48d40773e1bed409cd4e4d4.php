<?php $__env->startSection('title', 'Master Data Bahan & Jasa Pengolahan Lahan - Property Management App'); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid px-1 px-sm-2 px-md-3 py-2 py-md-3">

    <!-- Header Card Banner (Style Bank) -->
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 header-card">
                <div class="card-body p-4 p-md-4 py-4 py-md-4 d-flex justify-content-between align-items-center" style="min-height: 105px;">
                    <div>
                        <h3 class="text-dark mb-1 fw-bold" style="font-size: 1.35rem;">
                            Master Data Bahan & Jasa Pengolahan Lahan
                        </h3>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">
                            Kelola katalog material, alat berat, dan jasa infrastruktur site development proyek
                        </p>
                    </div>
                    <div class="d-none d-sm-block pe-2">
                        <i class="mdi mdi-package-variant-closed" style="font-size: 3rem; color: #9a55ff; opacity: 0.25;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Card Content (Style Bank) -->
    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-format-list-bulleted me-2"></i>Daftar Master Bahan & Jasa Lapangan
                    </h5>
                    <button type="button" class="btn btn-sm btn-gradient-primary d-flex align-items-center gap-1 shadow-sm" onclick="openModal('tambah')">
                        <i class="mdi mdi-plus-circle" style="font-size: 1rem;"></i>
                        <span>Tambah Master Bahan</span>
                    </button>
                </div>

                <div class="card-body">
                    <!-- Filter Section (Identik Style Master Data Bank) -->
                    <div class="filter-card mb-3">
                        <!-- Desktop Version -->
                        <div class="filter-row-desktop d-none d-md-block">
                            <form id="filterForm" method="GET" action="<?php echo e(route('master.bahan.index')); ?>" onsubmit="return showFilterLoading()">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                    <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                        <!-- Search Input with Joined Search Button -->
                                        <div style="min-width: 260px; max-width: 340px; flex: 1;">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="search" id="searchInput"
                                                    placeholder="Cari nama bahan, kode, spesifikasi..."
                                                    value="<?php echo e(request('search')); ?>"
                                                    style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                                <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                    type="submit" title="Cari"
                                                    style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                    <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Category Filter -->
                                        <div style="width: 220px;">
                                            <select class="form-control" name="category" id="categorySelect">
                                                <option value="">Semua Kategori</option>
                                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($cat); ?>" <?php echo e(request('category') == $cat ? 'selected' : ''); ?>><?php echo e($cat); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>

                                        <!-- Status Filter -->
                                        <div style="width: 155px;">
                                            <select class="form-control" name="status" id="statusSelect">
                                                <option value="">Semua Status</option>
                                                <option value="1" <?php echo e(request('status') === '1' ? 'selected' : ''); ?>>Aktif</option>
                                                <option value="0" <?php echo e(request('status') === '0' ? 'selected' : ''); ?>>Nonaktif</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Right Limit & Buttons -->
                                    <div class="d-flex align-items-center gap-2 ms-auto">
                                        <div style="width: 110px;">
                                            <select class="form-control" name="per_page" id="perPageSelect">
                                                <option value="10" <?php echo e(request('per_page', 10) == 10 ? 'selected' : ''); ?>>10 data</option>
                                                <option value="15" <?php echo e(request('per_page') == 15 ? 'selected' : ''); ?>>15 data</option>
                                                <option value="25" <?php echo e(request('per_page') == 25 ? 'selected' : ''); ?>>25 data</option>
                                                <option value="50" <?php echo e(request('per_page') == 50 ? 'selected' : ''); ?>>50 data</option>
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-gradient-primary btn-icon-only" title="Filter">
                                            <i class="mdi mdi-filter"></i>
                                        </button>
                                        <a href="<?php echo e(route('master.bahan.index')); ?>" class="btn btn-gradient-secondary btn-icon-only" title="Reset" onclick="showResetLoading(event)">
                                            <i class="mdi mdi-refresh"></i>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Mobile Version -->
                        <div class="filter-row-mobile d-block d-md-none">
                            <form method="GET" action="<?php echo e(route('master.bahan.index')); ?>" onsubmit="return showFilterLoading()">
                                <div class="row g-2">
                                    <div class="col-12 mb-2">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" id="searchInputMobile"
                                                placeholder="Cari nama bahan, kode..."
                                                value="<?php echo e(request('search')); ?>"
                                                style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                            <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                type="submit" title="Cari"
                                                style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <select class="form-control" name="category" id="categorySelectMobile">
                                            <option value="">Semua Kategori</option>
                                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($cat); ?>" <?php echo e(request('category') == $cat ? 'selected' : ''); ?>><?php echo e($cat); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <select class="form-control" name="status" id="statusSelectMobile">
                                            <option value="">Semua Status</option>
                                            <option value="1" <?php echo e(request('status') === '1' ? 'selected' : ''); ?>>Aktif</option>
                                            <option value="0" <?php echo e(request('status') === '0' ? 'selected' : ''); ?>>Nonaktif</option>
                                        </select>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <select class="form-control" name="per_page" id="perPageSelectMobile">
                                            <option value="10" <?php echo e(request('per_page', 10) == 10 ? 'selected' : ''); ?>>10 data</option>
                                            <option value="15" <?php echo e(request('per_page') == 15 ? 'selected' : ''); ?>>15 data</option>
                                            <option value="25" <?php echo e(request('per_page') == 25 ? 'selected' : ''); ?>>25 data</option>
                                            <option value="50" <?php echo e(request('per_page') == 50 ? 'selected' : ''); ?>>50 data</option>
                                        </select>
                                    </div>

                                    <div class="col-6">
                                        <button type="submit" class="btn btn-gradient-primary w-100 d-flex align-items-center justify-content-center gap-1">
                                            <i class="mdi mdi-filter"></i> Filter
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <a href="<?php echo e(route('master.bahan.index')); ?>" class="btn btn-gradient-secondary w-100 d-flex align-items-center justify-content-center gap-1" onclick="showResetLoading(event)">
                                            <i class="mdi mdi-refresh"></i> Reset
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Tabel Data Master Bahan -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 50px;">No</th>
                                    <th class="sortable" data-field="code" data-direction="<?php echo e(request('sortField') == 'code' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc'); ?>">
                                        Kode
                                        <?php if(request('sortField') == 'code'): ?>
                                            <i class="mdi mdi-<?php echo e(request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down'); ?>"></i>
                                        <?php else: ?>
                                            <i class="mdi mdi-swap-vertical"></i>
                                        <?php endif; ?>
                                    </th>
                                    <th class="sortable" data-field="name" data-direction="<?php echo e(request('sortField') == 'name' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc'); ?>">
                                        Nama Bahan / Jasa
                                        <?php if(request('sortField') == 'name'): ?>
                                            <i class="mdi mdi-<?php echo e(request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down'); ?>"></i>
                                        <?php else: ?>
                                            <i class="mdi mdi-swap-vertical"></i>
                                        <?php endif; ?>
                                    </th>
                                    <th class="sortable" data-field="category" data-direction="<?php echo e(request('sortField') == 'category' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc'); ?>">
                                        Kategori
                                        <?php if(request('sortField') == 'category'): ?>
                                            <i class="mdi mdi-<?php echo e(request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down'); ?>"></i>
                                        <?php else: ?>
                                            <i class="mdi mdi-swap-vertical"></i>
                                        <?php endif; ?>
                                    </th>
                                    <th class="text-center sortable" data-field="unit" data-direction="<?php echo e(request('sortField') == 'unit' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc'); ?>">
                                        Satuan
                                        <?php if(request('sortField') == 'unit'): ?>
                                            <i class="mdi mdi-<?php echo e(request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down'); ?>"></i>
                                        <?php else: ?>
                                            <i class="mdi mdi-swap-vertical"></i>
                                        <?php endif; ?>
                                    </th>
                                    <th class="text-end sortable" data-field="default_price" data-direction="<?php echo e(request('sortField') == 'default_price' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc'); ?>">
                                        Harga Standar (Rp)
                                        <?php if(request('sortField') == 'default_price'): ?>
                                            <i class="mdi mdi-<?php echo e(request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down'); ?>"></i>
                                        <?php else: ?>
                                            <i class="mdi mdi-swap-vertical"></i>
                                        <?php endif; ?>
                                    </th>
                                    <th>Spesifikasi / Ket</th>
                                    <th class="sortable text-center" data-field="is_active" data-direction="<?php echo e(request('sortField') == 'is_active' ? (request('sortDirection') == 'asc' ? 'desc' : 'asc') : 'asc'); ?>">
                                        Status
                                        <?php if(request('sortField') == 'is_active'): ?>
                                            <i class="mdi mdi-<?php echo e(request('sortDirection') == 'asc' ? 'arrow-up' : 'arrow-down'); ?>"></i>
                                        <?php else: ?>
                                            <i class="mdi mdi-swap-vertical"></i>
                                        <?php endif; ?>
                                    </th>
                                    <th class="text-center" style="width: 100px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $materials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $mat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td class="text-center fw-bold"><?php echo e($materials->firstItem() + $index); ?></td>
                                        <td>
                                            <span class="badge bg-light text-dark fw-bold px-2 py-1 border font-monospace" style="font-size: 0.82rem; letter-spacing: 0.5px;">
                                                <?php echo e($mat->code ?? '-'); ?>

                                            </span>
                                        </td>
                                        <td>
                                            <span class="fw-bold text-dark"><?php echo e($mat->name); ?></span>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-primary border fw-semibold px-2 py-1" style="font-size: 0.8rem;">
                                                <?php echo e($mat->category); ?>

                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-light text-dark border px-2 py-1" style="font-size: 0.8rem;"><?php echo e($mat->unit); ?></span>
                                        </td>
                                        <td class="text-end">
                                            <strong class="text-success" style="font-size: 0.9rem;">
                                                Rp <?php echo e(number_format($mat->default_price, 0, ',', '.')); ?>

                                            </strong>
                                        </td>
                                        <td>
                                            <span class="small text-muted"><?php echo e(Str::limit($mat->specification ?? '-', 35)); ?></span>
                                        </td>
                                        <td class="text-center">
                                            <?php if($mat->is_active): ?>
                                                <span class="status-badge aktif">
                                                    <i class="mdi mdi-check-circle"></i> Aktif
                                                </span>
                                            <?php else: ?>
                                                <span class="status-badge nonaktif">
                                                    <i class="mdi mdi-close-circle"></i> Nonaktif
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-inline-flex align-items-center gap-1">
                                                <button class="btn-action edit" title="Edit Master Bahan" onclick="openModal('edit', <?php echo e($mat->id); ?>)">
                                                    <i class="mdi mdi-pencil"></i>
                                                </button>
                                                <button class="btn-action delete" title="Hapus Master Bahan" onclick="confirmDelete(<?php echo e($mat->id); ?>)">
                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="9" class="text-center text-muted py-4">
                                            <i class="mdi mdi-package-variant-closed me-2" style="font-size: 1.5rem;"></i>
                                            Belum ada data master bahan yang tersimpan.
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination (Identik Style Bank) -->
                    <?php if($materials instanceof \Illuminate\Pagination\LengthAwarePaginator && $materials->total() > 0): ?>
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                            <div class="pagination-info mb-2 mb-sm-0 text-muted" style="font-size: 0.82rem;">
                                Menampilkan <?php echo e($materials->firstItem()); ?> - <?php echo e($materials->lastItem()); ?> dari <?php echo e($materials->total()); ?> data
                            </div>
                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-sm flex-wrap justify-content-center mb-0">
                                    <li class="page-item <?php echo e($materials->onFirstPage() ? 'disabled' : ''); ?>">
                                        <a class="page-link" href="<?php echo e($materials->previousPageUrl()); ?>" <?php echo e(!$materials->onFirstPage() ? 'onclick=showPaginationLoading(event)' : ''); ?>>
                                            <i class="mdi mdi-chevron-left"></i>
                                        </a>
                                    </li>

                                    <?php for($page = 1; $page <= $materials->lastPage(); $page++): ?>
                                        <li class="page-item <?php echo e($page == $materials->currentPage() ? 'active' : ''); ?>">
                                            <?php if($page == $materials->currentPage()): ?>
                                                <span class="page-link"><?php echo e($page); ?></span>
                                            <?php else: ?>
                                                <a class="page-link" href="<?php echo e($materials->appends(request()->query())->url($page)); ?>" onclick="showPaginationLoading(event)"><?php echo e($page); ?></a>
                                            <?php endif; ?>
                                        </li>
                                    <?php endfor; ?>

                                    <li class="page-item <?php echo e($materials->hasMorePages() ? '' : 'disabled'); ?>">
                                        <a class="page-link" href="<?php echo e($materials->nextPageUrl()); ?>" <?php echo e($materials->hasMorePages() ? 'onclick=showPaginationLoading(event)' : ''); ?>>
                                            <i class="mdi mdi-chevron-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modal Tambah/Edit Master Bahan (Identik Style Modal Bank) -->
<div class="modal fade" id="modalMaterial" tabindex="-1" aria-labelledby="modalMaterialLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-white border-bottom">
                <h5 class="modal-title fw-bold" id="modalMaterialLabel" style="color: #2c2e3f;">
                    <i class="mdi mdi-plus-circle me-2" id="modalIcon" style="color: #9a55ff;"></i>
                    <span id="modalTitle">Tambah Master Bahan</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formMaterial" method="POST" onsubmit="return submitForm(event)">
                <?php echo csrf_field(); ?>
                <input type="hidden" id="materialId" name="id">

                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color: #2c2e3f;">Nama Bahan / Jasa <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" id="namaMaterial" placeholder="Contoh: Tiang PJU 7m / Paving Block K-300" required>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold" style="color: #2c2e3f;">Kategori <span class="text-danger">*</span></label>
                            <select name="category" id="kategoriMaterial" class="form-control" required>
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
                            <label class="form-label fw-bold" style="color: #2c2e3f;">Satuan <span class="text-danger">*</span></label>
                            <input type="text" name="unit" id="satuanMaterial" class="form-control" placeholder="sak, m3, m2, unit, hari" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color: #2c2e3f;">Harga Standar Estimasi (Rp)</label>
                        <input type="number" name="default_price" id="hargaMaterial" class="form-control" placeholder="0" min="0">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color: #2c2e3f;">Kode Bahan (Opsional)</label>
                        <input type="text" name="code" id="kodeMaterial" class="form-control" placeholder="Otomatis digenerate jika kosong">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color: #2c2e3f;">Spesifikasi / Catatan Teknis</label>
                        <textarea name="specification" id="spesifikasiMaterial" class="form-control" rows="2" placeholder="Catatan spesifikasi teknis / standar SNI..."></textarea>
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-bold" style="color: #2c2e3f;">Status Operasional</label>
                        <select class="form-control" name="is_active" id="statusMaterial">
                            <option value="1">Aktif (Tersedia untuk proyek)</option>
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

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
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

    <?php if(session('success')): ?>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '<?php echo e(session('success')); ?>',
            timer: 2500,
            showConfirmButton: true,
            confirmButtonColor: '#9a55ff',
            timerProgressBar: true
        });
    <?php endif; ?>

    <?php if(session('error')): ?>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '<?php echo e(session('error')); ?>',
            confirmButtonColor: '#dc3545'
        });
    <?php endif; ?>
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
        document.getElementById('formMaterial').submit();
    }, 100);

    return false;
}

function openModal(type, id = null) {
    if (type === 'tambah') {
        $('#formMaterial')[0].reset();
        $('#materialId').val('');
        $('#formMaterial').attr('action', '<?php echo e(route("master.bahan.store")); ?>');

        $('#modalTitle').text('Tambah Master Bahan');
        $('#modalIcon').removeClass('mdi-pencil').addClass('mdi-plus-circle');
        $('#btnText').text('Simpan Data');
        $('#btnIcon').removeClass('mdi-pencil').addClass('mdi-content-save');

        $('#modalMaterial').modal('show');
    } else {
        Swal.fire({
            title: 'Mohon tunggu...',
            html: 'Sedang mengambil data bahan',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        $.get('<?php echo e(url("master-data-bahan-infrastruktur")); ?>/' + id + '/edit', function(data) {
            Swal.close();

            $('#materialId').val(data.id);
            $('#namaMaterial').val(data.name);
            $('#kategoriMaterial').val(data.category);
            $('#satuanMaterial').val(data.unit);
            $('#hargaMaterial').val(data.default_price);
            $('#kodeMaterial').val(data.code);
            $('#spesifikasiMaterial').val(data.specification);
            $('#statusMaterial').val(data.is_active ? '1' : '0');

            $('#formMaterial').attr('action', '<?php echo e(url("master-data-bahan-infrastruktur")); ?>/' + id + '/update');

            $('#modalTitle').text('Edit Master Bahan');
            $('#modalIcon').removeClass('mdi-plus-circle').addClass('mdi-pencil');
            $('#btnText').text('Update Data');
            $('#btnIcon').removeClass('mdi-content-save').addClass('mdi-pencil');

            $('#modalMaterial').modal('show');
        }).fail(function() {
            Swal.close();
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Gagal mengambil data bahan',
                confirmButtonColor: '#dc3545'
            });
        });
    }
}

function confirmDelete(id) {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "Data master bahan ini akan dihapus dari katalog!",
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
                form.action = '<?php echo e(url("master-data-bahan-infrastruktur")); ?>/' + id;

                let csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = '<?php echo e(csrf_token()); ?>';

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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.partial.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Property-Management-Web-App\resources\views/master_data/bahan_infrastruktur/index.blade.php ENDPATH**/ ?>