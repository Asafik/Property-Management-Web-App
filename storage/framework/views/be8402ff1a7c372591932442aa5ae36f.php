<?php $__env->startSection('title', 'Master Data Perusahaan (PT) - Property Management App'); ?>

<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/dashboard-clean.css')); ?>?v=<?php echo e(time()); ?>">
    <style>
        .table-perizinan {
            width: 100% !important;
            margin-bottom: 0;
        }
        .table-perizinan thead th {
            background: #f8fafc !important;
            color: #4b5563 !important;
            font-weight: 700;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e2e8f0 !important;
            padding: 0.75rem 0.6rem !important;
            vertical-align: middle;
            white-space: nowrap;
        }
        .table-perizinan tbody td {
            padding: 0.75rem 0.6rem !important;
            vertical-align: middle;
            font-size: 0.83rem;
            border-bottom: 1px solid #f1f5f9;
            white-space: normal !important;
        }
        .table-perizinan .col-no {
            width: 45px;
            text-align: center;
            white-space: nowrap !important;
        }
        .table-perizinan .col-aksi {
            width: 95px;
            text-align: center;
            white-space: nowrap !important;
        }

        .card.compact-table-card,
        .compact-table-card {
            background: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 8px !important;
            box-shadow: none !important;
            transition: border-color 0.2s ease;
            overflow: hidden;
        }
        .card.compact-table-card:hover,
        .compact-table-card:hover {
            border-color: #cbd5e1 !important;
            box-shadow: none !important;
        }
        .compact-table-card .card-header {
            background: #ffffff !important;
            border-bottom: 1px solid #e2e8f0 !important;
            padding: 0.65rem 1.25rem !important;
            border-top-left-radius: 8px !important;
            border-top-right-radius: 8px !important;
        }
        .compact-table-card .card-body {
            padding: 0.75rem 1.25rem 1.15rem 1.25rem !important;
            background: #ffffff !important;
        }
        .compact-table-card .filter-card {
            margin-top: 0 !important;
            margin-bottom: 0.6rem !important;
        }
        .compact-table-card .filter-card form {
            margin-bottom: 0 !important;
        }

    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid px-2 px-md-4 py-3">

    <!-- Page Title & Header Action (Sama Persis Format Perizinan) -->
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
        <div>
            <h2 class="text-dark mb-1 fw-bold" style="font-size: 1.55rem; letter-spacing: -0.02em;">
                Master Data Perusahaan (PT)
            </h2>
            <p class="text-muted mb-0" style="font-size: 0.88rem;">
                Kelola data entitas badan hukum developer dan 6 dokumen legalitas resmi untuk Notaris & BPN.
            </p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="<?php echo e(route('company-profile.create')); ?>" class="btn btn-sm btn-gradient-primary d-inline-flex align-items-center gap-1.5 px-3 py-2 shadow-sm text-white fw-semibold" style="border-radius: 8px; font-size: 0.85rem;">
                <i class="mdi mdi-plus-circle" style="font-size: 1rem;"></i>
                <span>Tambah Perusahaan</span>
            </a>
        </div>
    </div>



    <!-- Main Container: Table & Filters (Format Sama Persis Perizinan) -->
    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card compact-table-card">
                
                <!-- Card Header -->
                <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2">
                    <div class="d-flex align-items-center gap-2">
                        <div style="width: 32px; height: 32px; border-radius: 6px; background-color: #f3e8ff; color: #9333ea; display: inline-flex; align-items: center; justify-content: center; font-size: 1.15rem; flex-shrink: 0;">
                            <i class="mdi mdi-format-list-bulleted"></i>
                        </div>
                        <span style="font-size: 0.95rem; font-weight: 700; color: #0f172a;">Daftar Perusahaan (PT) & Legalitas</span>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Filter Toolbar -->
                    <div class="filter-card">
                        <form id="filterForm" method="GET" action="<?php echo e(route('company-profile.index')); ?>">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                    <!-- Search Input -->
                                    <div style="min-width: 240px; max-width: 360px; flex: 1;">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" id="liveSearchInput"
                                                placeholder="Cari nama perusahaan, alamat, telepon..."
                                                value="<?php echo e(request('search')); ?>"
                                                onkeyup="applyLiveSearch(this.value)"
                                                style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                            <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                type="submit" title="Cari"
                                                style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Filter Baris per Halaman -->
                                    <div style="width: 140px;">
                                        <select class="form-control" name="per_page" id="perPageSelect" onchange="document.getElementById('filterForm').submit()">
                                            <option value="10" <?php echo e(request('per_page', 10) == 10 ? 'selected' : ''); ?>>10 data</option>
                                            <option value="15" <?php echo e(request('per_page', 15) == 15 ? 'selected' : ''); ?>>15 data</option>
                                            <option value="25" <?php echo e(request('per_page', 25) == 25 ? 'selected' : ''); ?>>25 data</option>
                                            <option value="50" <?php echo e(request('per_page', 50) == 50 ? 'selected' : ''); ?>>50 data</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="d-flex align-items-center gap-2 ms-auto">
                                    <button type="submit" class="btn btn-gradient-primary btn-icon-only" title="Terapkan Filter">
                                        <i class="mdi mdi-filter"></i>
                                    </button>
                                    <a href="<?php echo e(route('company-profile.index')); ?>" class="btn btn-gradient-secondary btn-icon-only" title="Reset Filter">
                                        <i class="mdi mdi-refresh"></i>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- TABEL DATA PERUSAHAAN (SAMA PERSIS DENGAN TABEL PERIZINAN) -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle table-perizinan">
                            <thead>
                                <tr>
                                    <th class="col-no">No</th>
                                    <th>Nama Perusahaan (PT)</th>
                                    <th>Alamat Kantor</th>
                                    <th>No. Telepon</th>
                                    <th class="text-center">Proyek Terkait</th>
                                    <th class="text-center">Status Legalitas PT</th>
                                    <th class="col-aksi text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <?php
                                        $cName = $company->name ?? '-';
                                        $legCount = $company->uploaded_legal_docs_count;
                                    ?>
                                    <tr class="company-table-row" id="row_company_<?php echo e($company->id); ?>" data-search="<?php echo e(strtolower($cName . ' ' . ($company->address ?? '') . ' ' . ($company->phone ?? ''))); ?>">
                                        <td class="col-no fw-bold text-center"><?php echo e($companies->firstItem() + $index); ?></td>
                                        <td>
                                            <div class="fw-bold text-dark" style="font-size: 0.86rem; line-height: 1.35;">
                                                <?php echo e($cName); ?>

                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-inline-flex align-items-center gap-1.5 text-muted" style="font-size: 0.82rem;" title="<?php echo e($company->address); ?>">
                                                <i class="mdi mdi-map-marker text-danger" style="font-size: 0.95rem;"></i>
                                                <span><?php echo e(Str::limit($company->address ?: '-', 45)); ?></span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-inline-flex align-items-center gap-1.5 text-secondary" style="font-size: 0.82rem;">
                                                <i class="mdi mdi-phone text-success" style="font-size: 0.95rem;"></i>
                                                <span><?php echo e($company->phone ?: '-'); ?></span>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge font-monospace fw-bold" style="background: #e0f2fe; color: #0284c7; border: 1px solid #bae6fd; font-size: 0.76rem; border-radius: 6px; padding: 4px 8px;">
                                                <i class="mdi mdi-office-building me-1"></i><?php echo e($company->land_banks_count); ?> Proyek
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <?php if($legCount == 6): ?>
                                                <span class="badge" style="background: #ecfdf5; color: #059669; border: 1px solid #a7f3d0; font-size: 0.76rem; border-radius: 6px; padding: 4px 8px;" title="Semua 6 Berkas Legalitas PT Lengkap">
                                                    <i class="mdi mdi-shield-check me-1"></i>Lengkap (6/6)
                                                </span>
                                            <?php elseif($legCount > 0): ?>
                                                <span class="badge" style="background: #fffbeb; color: #d97706; border: 1px solid #fde68a; font-size: 0.76rem; border-radius: 6px; padding: 4px 8px;" title="Baru <?php echo e($legCount); ?> dari 6 Berkas Legalitas Terunggah">
                                                    <i class="mdi mdi-clock-outline me-1"></i><?php echo e($legCount); ?>/6 Berkas
                                                </span>
                                            <?php else: ?>
                                                <span class="badge" style="background: #f1f5f9; color: #64748b; border: 1px solid #e2e8f0; font-size: 0.76rem; border-radius: 6px; padding: 4px 8px;" title="Belum Ada Berkas Legalitas">
                                                    <i class="mdi mdi-alert-circle-outline me-1"></i>Belum Ada (0/6)
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="col-aksi text-center">
                                            <div class="d-inline-flex align-items-center gap-1">
                                                <a href="<?php echo e(route('company-profile.edit', $company->id)); ?>" class="btn-action edit" title="Edit Perusahaan & Berkas Legalitas">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>
                                                <button type="button" class="btn-action delete" title="Hapus Perusahaan" onclick="confirmDelete(<?php echo e($company->id); ?>)">
                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-5">
                                            <i class="mdi mdi-domain-off fs-1 d-block mb-2 text-muted opacity-50"></i>
                                            Belum ada data entitas perusahaan (PT) yang tersimpan.
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination (Sama Persis Perizinan) -->
                    <?php if($companies instanceof \Illuminate\Pagination\LengthAwarePaginator && $companies->total() > 0): ?>
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-3 pt-3 border-top">
                            <div class="text-muted mb-2 mb-sm-0" style="font-size: 0.82rem;">
                                Menampilkan <?php echo e($companies->firstItem()); ?> - <?php echo e($companies->lastItem()); ?> dari <?php echo e($companies->total()); ?> data
                            </div>
                            <div>
                                <?php echo e($companies->links()); ?>

                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>

</div>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Live Search Functionality (Sama Persis Perizinan)
    function applyLiveSearch(keyword) {
        var val = (keyword || '').toLowerCase().trim();
        var rows = document.querySelectorAll('.company-table-row');
        rows.forEach(function(row) {
            var str = (row.getAttribute('data-search') || '').toLowerCase();
            row.style.display = (val === '' || str.includes(val)) ? '' : 'none';
        });
    }

    // Konfirmasi Hapus Data
    function confirmDelete(id) {
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: "Data perusahaan dan tautan dokumennya akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            customClass: {
                popup: 'rounded-4 shadow-lg border-0',
                confirmButton: 'px-4 py-2 rounded-3 fw-semibold',
                cancelButton: 'px-4 py-2 rounded-3 fw-semibold'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Menghapus...',
                    html: 'Sedang menghapus data perusahaan',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                let form = document.createElement('form');
                form.method = 'POST';
                form.action = '<?php echo e(url("master-data-pt")); ?>/' + id;

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
            }
        });
    }

    <?php if(session('success')): ?>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '<?php echo e(session('success')); ?>',
            confirmButtonColor: '#10b981',
            customClass: { popup: 'rounded-4' }
        });
    <?php endif; ?>

    <?php if(session('error')): ?>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '<?php echo e(session('error')); ?>',
            confirmButtonColor: '#dc2626',
            customClass: { popup: 'rounded-4' }
        });
    <?php endif; ?>
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.partial.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Property-Management-Web-App\resources\views/pt/pt.blade.php ENDPATH**/ ?>