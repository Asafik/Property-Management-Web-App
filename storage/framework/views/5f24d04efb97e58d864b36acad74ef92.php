<?php $__env->startSection('title', 'Monitoring Pengolahan Lahan Proyek - Property Management App'); ?>

<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/dashboard-clean.css')); ?>?v=<?php echo e(time()); ?>">
    <style>
        /* Table Responsive & Text Wrapping persis perizinan */
        .table-lahan {
            width: 100% !important;
            margin-bottom: 0;
        }
        .table-lahan thead th {
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
        .table-lahan tbody td {
            padding: 0.75rem 0.6rem !important;
            vertical-align: middle;
            font-size: 0.83rem;
            border-bottom: 1px solid #f1f5f9;
            white-space: normal !important;
        }
        .table-lahan .col-no {
            width: 45px;
            text-align: center;
            white-space: nowrap !important;
        }
        .table-lahan .col-status {
            width: 100px;
            text-align: center;
            white-space: nowrap !important;
        }
        .table-lahan .col-aksi {
            width: 110px;
            text-align: center;
            white-space: nowrap !important;
        }

        /* Styling Card Tabel Meniru Persis Card Total (.dash-kpi-card) */
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
        .compact-table-card .card-body,
        .card.compact-table-card .card-body {
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

    <!-- Page Title & Subtitle -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <div>
            <h2 class="text-dark mb-1 fw-bold" style="font-size: 1.55rem; letter-spacing: -0.02em;">
                Pengolahan Lahan Proyek
            </h2>
            <p class="text-muted mb-0" style="font-size: 0.88rem;">
                Manajemen infrastruktur kawasan (Cut & Fill, Drainase, Jalan, PJU & Utilitas Proyek).
            </p>
        </div>
        <div>
            <a href="<?php echo e(route('proyek.index')); ?>" class="btn btn-outline-primary d-inline-flex align-items-center gap-1.5 px-3 py-2 fw-semibold shadow-sm" style="border-radius: 6px; font-size: 0.86rem;">
                <i class="mdi mdi-city-variant-outline"></i>
                <span>Menu Proyek (Profil & Dokumen)</span>
            </a>
        </div>
    </div>

    <!-- 4 KPI Metrics Card Grid (Sama Persis Perizinan) -->
    <div class="dash-kpi-grid mb-4">
        
        <!-- Card 1: Total Proyek (Ungu) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon purple">
                    <i class="mdi mdi-hard-hat"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Total Proyek Lahan</div>
                    <div class="dash-kpi-val"><?php echo e($totalProyek ?? 0); ?></div>
                    <div class="dash-kpi-sub">Seluruh Kawasan Proyek</div>
                </div>
            </div>
            <div class="dash-kpi-action purple">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>

        <!-- Card 2: Lahan Selesai (Hijau) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon green">
                    <i class="mdi mdi-check-circle-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Lahan Selesai Diolah</div>
                    <div class="dash-kpi-val"><?php echo e($totalSelesai ?? 0); ?></div>
                    <div class="dash-kpi-sub">Infrastruktur 100% Selesai</div>
                </div>
            </div>
            <div class="dash-kpi-action green">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>

        <!-- Card 3: Dalam Pengerjaan Fisik (Biru) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon blue">
                    <i class="mdi mdi-progress-wrench"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Dalam Pengerjaan Fisik</div>
                    <div class="dash-kpi-val"><?php echo e($dalamProses ?? 0); ?></div>
                    <div class="dash-kpi-sub">Pengerjaan Aktif Lapangan</div>
                </div>
            </div>
            <div class="dash-kpi-action blue">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>

        <!-- Card 4: Tertunda / Kendala (Rose / Merah) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon rose">
                    <i class="mdi mdi-alert-circle-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Tertunda / Kendala</div>
                    <div class="dash-kpi-val"><?php echo e($tertunda ?? 0); ?></div>
                    <div class="dash-kpi-sub">Perlu Tindak Lanjut / Evaluasi</div>
                </div>
            </div>
            <div class="dash-kpi-action rose">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>

    </div>

    <!-- Main Container: Table & Filters (Sama Persis Perizinan) -->
    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card compact-table-card">
                <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2">
                    <div class="d-flex align-items-center gap-2">
                        <div style="width: 32px; height: 32px; border-radius: 6px; background-color: #f3e8ff; color: #9333ea; display: inline-flex; align-items: center; justify-content: center; font-size: 1.15rem; flex-shrink: 0;">
                            <i class="mdi mdi-format-list-bulleted"></i>
                        </div>
                        <span style="font-size: 0.95rem; font-weight: 700; color: #0f172a;">Daftar Pengolahan Lahan Kawasan</span>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Filter Toolbar -->
                    <div class="filter-card">
                        <form id="filterForm" method="GET" action="<?php echo e(route('proyek.pengolahan-lahan.index')); ?>" style="margin-bottom: 0 !important;">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                    <!-- Search Input -->
                                    <div style="min-width: 240px; max-width: 360px; flex: 1;">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" id="liveSearchInput"
                                                placeholder="Cari nama proyek, lokasi, status tanah..."
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

                                    <!-- Filter Proyek Dropdown -->
                                    <div style="min-width: 180px;">
                                        <select name="proyek_id" class="form-control" onchange="document.getElementById('filterForm').submit()">
                                            <option value="all">Semua Proyek Kawasan</option>
                                            <?php $__currentLoopData = $allProjects ?? $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($p['id']); ?>" <?php echo e(request('proyek_id') == $p['id'] ? 'selected' : ''); ?>>
                                                    <?php echo e($p['nama']); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    <!-- Filter Status -->
                                    <div style="width: 160px;">
                                        <select class="form-control" name="status" id="statusFilterSelect" onchange="document.getElementById('filterForm').submit()">
                                            <option value="all" <?php echo e(request('status') == 'all' ? 'selected' : ''); ?>>Semua Status</option>
                                            <option value="Selesai" <?php echo e(request('status') == 'Selesai' ? 'selected' : ''); ?>>Selesai</option>
                                            <option value="Berjalan" <?php echo e(request('status') == 'Berjalan' ? 'selected' : ''); ?>>Berjalan</option>
                                            <option value="Tertunda" <?php echo e(request('status') == 'Tertunda' ? 'selected' : ''); ?>>Tertunda</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Reset Button -->
                                <div class="d-flex align-items-center gap-2 ms-auto">
                                    <button type="submit" class="btn btn-gradient-primary btn-icon-only" title="Terapkan Filter">
                                        <i class="mdi mdi-filter"></i>
                                    </button>
                                    <a href="<?php echo e(route('proyek.pengolahan-lahan.index')); ?>" class="btn btn-gradient-secondary btn-icon-only" title="Reset Filter">
                                        <i class="mdi mdi-refresh"></i>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Pure Clean Table: Daftar Pengolahan Lahan Kawasan -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle table-lahan mb-0">
                            <thead>
                                <tr>
                                    <th class="col-no text-center">No</th>
                                    <th>Nama Proyek & Perusahaan</th>
                                    <th>Status Tanah</th>
                                    <th>Tahapan Aktif</th>
                                    <th>Lokasi</th>
                                    <th>Luas Lahan</th>
                                    <th>Target Selesai</th>
                                    <th style="width: 140px;">Progress Fisik</th>
                                    <th class="col-status text-center">Status</th>
                                    <th class="col-aksi text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $proj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <?php
                                        $pVal = (int) ($proj['progress'] ?? 65);
                                        $st = $proj['status'] ?? 'Berjalan';
                                        if ($st == 'Selesai') {
                                            $badgeBg = '#ecfdf5';
                                            $badgeColor = '#059669';
                                            $badgeBorder = '#a7f3d0';
                                            $stLabel = 'Selesai';
                                        } elseif ($st == 'Berjalan') {
                                            $badgeBg = '#eff6ff';
                                            $badgeColor = '#1d4ed8';
                                            $badgeBorder = '#bfdbfe';
                                            $stLabel = 'Berjalan';
                                        } else {
                                            $badgeBg = '#fef2f2';
                                            $badgeColor = '#b91c1c';
                                            $badgeBorder = '#fecaca';
                                            $stLabel = 'Tertunda';
                                        }

                                        if ($pVal >= 100) {
                                            $pColor = '#10b981';
                                        } elseif ($pVal >= 70) {
                                            $pColor = '#7c3aed';
                                        } elseif ($pVal >= 40) {
                                            $pColor = '#0284c7';
                                        } else {
                                            $pColor = '#f59e0b';
                                        }
                                    ?>
                                    <tr class="lahan-table-row" id="row_lahan_<?php echo e($proj['id']); ?>" data-search="<?php echo e(strtolower($proj['nama'] . ' ' . ($proj['pt'] ?? '') . ' ' . ($proj['lokasi'] ?? '') . ' ' . ($proj['ownership_status'] ?? '') . ' ' . ($proj['fase_aktif'] ?? ''))); ?>">
                                        <td class="col-no fw-bold text-center"><?php echo e($loop->iteration); ?></td>
                                        <td>
                                            <div class="fw-bold text-dark" style="line-height: 1.35; font-size: 0.86rem;">
                                                <?php echo e($proj['nama']); ?>

                                            </div>
                                            <div class="text-secondary mt-0.5" style="font-size: 0.77rem; line-height: 1.3;">
                                                <?php echo e($proj['pt'] ?? 'PT Graha Cipta Sejahtera'); ?>

                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge py-1 px-2.5 font-monospace"
                                                style="background-color: #f3e8ff; color: #7e22ce; font-size: 0.75rem; font-weight: 700; border-radius: 6px; border: 1px solid #e9d5ff;">
                                                <?php echo e($proj['ownership_status'] ?? 'SHGB Induk'); ?>

                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge py-1 px-2.5"
                                                style="background-color: #fef3c7; color: #92400e; font-size: 0.75rem; font-weight: 600; border-radius: 6px; border: 1px solid #fde68a;">
                                                <i class="mdi mdi-hammer-wrench me-1"></i><?php echo e($proj['fase_aktif'] ?? 'Fase 1'); ?>

                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-secondary" style="font-size: 0.82rem;">
                                                <i class="mdi mdi-map-marker-outline text-danger me-0.5"></i><?php echo e($proj['lokasi']); ?>

                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark px-2 py-1 border font-monospace" style="font-size: 0.76rem;">
                                                <?php echo e($proj['luas']); ?>

                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-secondary" style="font-size: 0.82rem;"><?php echo e($proj['target_selesai'] ?? '30 Jul 2026'); ?></span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2" style="min-width: 120px;">
                                                <div class="progress flex-grow-1" style="height: 6px; background-color: #e2e8f0; border-radius: 9999px;">
                                                    <div class="progress-bar rounded-pill" role="progressbar" style="width: <?php echo e($pVal); ?>%; background-color: <?php echo e($pColor); ?>;"></div>
                                                </div>
                                                <span style="font-size: 0.75rem; font-weight: 700; color: #334155; min-width: 32px; text-align: right;"><?php echo e($pVal); ?>%</span>
                                            </div>
                                        </td>
                                        <td class="col-status text-center">
                                            <span class="badge py-1 px-2.5 fw-semibold" style="font-size: 0.74rem; border-radius: 6px; background-color: <?php echo e($badgeBg); ?>; color: <?php echo e($badgeColor); ?>; border: 1px solid <?php echo e($badgeBorder); ?>;">
                                                <?php echo e($stLabel); ?>

                                            </span>
                                        </td>
                                        <td class="col-aksi text-center">
                                            <a href="<?php echo e(route('properti.pengolahanLahan', $proj['id'])); ?>" class="btn btn-sm btn-gradient-primary d-inline-flex align-items-center gap-1.5 px-3 py-1.5 shadow-sm text-decoration-none fw-semibold" style="border-radius: 6px; font-size: 0.82rem;">
                                                <i class="mdi mdi-tools" style="font-size: 0.95rem;"></i>
                                                <span>Kelola</span>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="10" class="text-center text-muted py-4">
                                            <i class="mdi mdi-domain-off me-2" style="font-size: 1.5rem;"></i>
                                            Tidak ada data proyek pengolahan lahan.
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

<?php $__env->startPush('scripts'); ?>
<script>
    function applyLiveSearch(keyword) {
        keyword = (keyword || '').toLowerCase().trim();
        const rows = document.querySelectorAll('.lahan-table-row');
        rows.forEach(row => {
            const searchData = row.getAttribute('data-search') || '';
            if (!keyword || searchData.includes(keyword)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.partial.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Property-Management-Web-App\resources\views/pengolahan_lahan/index.blade.php ENDPATH**/ ?>