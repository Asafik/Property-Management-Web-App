<?php $__env->startSection('title', 'Unit Legalitas & Sertifikat - Property Management App'); ?>

<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/dashboard-clean.css')); ?>?v=<?php echo e(time()); ?>">
    <style>
        /* Table Responsive & Layout persis proyek unit & pengolahan lahan */
        .table-legal-unit {
            width: 100% !important;
            margin-bottom: 0;
        }
        .table-legal-unit thead th {
            background: #f8fafc !important;
            color: #4b5563 !important;
            font-weight: 700;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e2e8f0 !important;
            padding: 0.75rem 0.65rem !important;
            vertical-align: middle;
            white-space: nowrap;
        }
        .table-legal-unit tbody td {
            padding: 0.75rem 0.65rem !important;
            vertical-align: middle;
            font-size: 0.83rem;
            border-bottom: 1px solid #f1f5f9;
            white-space: normal !important;
        }
        .table-legal-unit .col-no {
            width: 45px;
            text-align: center;
            white-space: nowrap !important;
        }
        .table-legal-unit .col-status {
            width: 110px;
            text-align: center;
            white-space: nowrap !important;
        }
        .table-legal-unit .col-aksi {
            width: 120px;
            text-align: center;
            white-space: nowrap !important;
        }

        /* Compact Table Card meniru persis Card Total (.dash-kpi-card) */
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
        .compact-table-card .card-body,
        .card.compact-table-card .card-body {
            padding: 0 !important;
            background: #ffffff !important;
        }

        /* Detail Modal Styles */
        .detail-item {
            display: flex;
            justify-content: space-between;
            padding: 0.65rem 0;
            border-bottom: 1px dashed #e2e8f0;
            font-size: 0.85rem;
        }
        .detail-item:last-child {
            border-bottom: none;
        }
        .detail-label {
            color: #64748b;
            font-weight: 500;
        }
        .detail-value {
            color: #1e293b;
            font-weight: 600;
            text-align: right;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid px-2 px-md-4 py-3">

    <!-- Page Title & Subtitle -->
    <div class="row align-items-center mb-4">
        <div class="col">
            <h2 class="text-dark mb-1 fw-bold" style="font-size: 1.55rem; letter-spacing: -0.02em;">
                Unit Legalitas
            </h2>
            <p class="text-muted mb-0" style="font-size: 0.88rem;">
                Daftar status sertifikat tanah (SHM/SHGB), pemecahan BPN, kelengkapan PBB & PBG per unit kavling kawasan.
            </p>
        </div>
    </div>

    <!-- 4 KPI Metrics Card Grid (Persis Proyek Unit & Perizinan) -->
    <div class="dash-kpi-grid mb-4">
        
        <!-- Card 1: Total Unit Kavling (Ungu) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon purple">
                    <i class="mdi mdi-home-city-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Total Unit Kavling</div>
                    <div class="dash-kpi-val"><?php echo e($totalUnit ?? 0); ?></div>
                    <div class="dash-kpi-sub">Kavling Dalam Kawasan</div>
                </div>
            </div>
            <div class="dash-kpi-action purple">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>

        <!-- Card 2: Legalitas Selesai / SHM Terbit (Hijau) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon green">
                    <i class="mdi mdi-check-decagram-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">SHM / Terbit</div>
                    <div class="dash-kpi-val"><?php echo e($totalLegalSelesai ?? 0); ?></div>
                    <div class="dash-kpi-sub">Sertifikat Siap / Lengkap</div>
                </div>
            </div>
            <div class="dash-kpi-action green">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>

        <!-- Card 3: Proses BPN & Notaris (Amber / Kuning) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon amber">
                    <i class="mdi mdi-file-clock-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Proses BPN / Notaris</div>
                    <div class="dash-kpi-val"><?php echo e($totalProsesLegal ?? 0); ?></div>
                    <div class="dash-kpi-sub">Pemecahan & Validasi</div>
                </div>
            </div>
            <div class="dash-kpi-action amber">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>

        <!-- Card 4: Unit Terjual / Akad (Rose / Merah) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon rose">
                    <i class="mdi mdi-handshake-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Unit Terjual / Akad</div>
                    <div class="dash-kpi-val"><?php echo e($totalSold ?? 0); ?></div>
                    <div class="dash-kpi-sub">Proses Balik Nama</div>
                </div>
            </div>
            <div class="dash-kpi-action rose">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>
    </div>

    <!-- Main Container: Table & Filters (Card Meniru Persis Card Total) -->
    <div class="row">
        <div class="col-12">
            <div class="card compact-table-card shadow-sm border-0">
                <div class="card-body p-0">
                    
                    <!-- Search & Filter Toolbar -->
                    <div class="card-toolbar-box p-3 border-bottom bg-white">
                        <form id="filterForm" method="GET" action="<?php echo e(route('legal.unit.index')); ?>">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                                
                                <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                    <!-- Search Input -->
                                    <div style="min-width: 240px; max-width: 320px; flex: 1;">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" id="liveSearchInput"
                                                placeholder="Cari kode unit, blok, sertifikat..."
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

                                    <!-- Filter Proyek Asal Dropdown -->
                                    <div style="min-width: 190px;">
                                        <select name="land_bank_id" class="form-control" onchange="document.getElementById('filterForm').submit()">
                                            <option value="all">Semua Tanah Proyek</option>
                                            <?php $__currentLoopData = $landBanks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($lb->id); ?>" <?php echo e(request('land_bank_id') == $lb->id ? 'selected' : ''); ?>>
                                                    <?php echo e($lb->name); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    <!-- Filter Status Legalitas Dropdown -->
                                    <div style="width: 170px;">
                                        <select class="form-control" name="legal_status" onchange="document.getElementById('filterForm').submit()">
                                            <option value="all" <?php echo e(request('legal_status') == 'all' ? 'selected' : ''); ?>>Semua Legalitas</option>
                                            <option value="selesai" <?php echo e(request('legal_status') == 'selesai' ? 'selected' : ''); ?>>SHM / Selesai</option>
                                            <option value="bpn" <?php echo e(request('legal_status') == 'bpn' ? 'selected' : ''); ?>>Proses BPN</option>
                                            <option value="notaris" <?php echo e(request('legal_status') == 'notaris' ? 'selected' : ''); ?>>Validasi Notaris</option>
                                            <option value="persiapan" <?php echo e(request('legal_status') == 'persiapan' ? 'selected' : ''); ?>>Persiapan Berkas</option>
                                        </select>
                                    </div>

                                    <!-- Filter Status Penjualan Dropdown -->
                                    <div style="width: 140px;">
                                        <select class="form-control" name="status" onchange="document.getElementById('filterForm').submit()">
                                            <option value="all" <?php echo e(request('status') == 'all' ? 'selected' : ''); ?>>Semua Status</option>
                                            <option value="available" <?php echo e(request('status') == 'available' ? 'selected' : ''); ?>>Available</option>
                                            <option value="booking" <?php echo e(request('status') == 'booking' ? 'selected' : ''); ?>>Booking</option>
                                            <option value="sold" <?php echo e(request('status') == 'sold' ? 'selected' : ''); ?>>Sold / Terjual</option>
                                        </select>
                                    </div>

                                    <!-- Filter Jenis Dropdown -->
                                    <div style="width: 130px;">
                                        <select class="form-control" name="jenis" onchange="document.getElementById('filterForm').submit()">
                                            <option value="all" <?php echo e(request('jenis') == 'all' ? 'selected' : ''); ?>>Semua Jenis</option>
                                            <option value="subsidi" <?php echo e(request('jenis') == 'subsidi' ? 'selected' : ''); ?>>Subsidi</option>
                                            <option value="komersil" <?php echo e(request('jenis') == 'komersil' ? 'selected' : ''); ?>>Komersil</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Action Filter / Reset Buttons -->
                                <div class="d-flex align-items-center gap-2 ms-auto">
                                    <button type="submit" class="btn btn-gradient-primary btn-icon-only" title="Terapkan Filter">
                                        <i class="mdi mdi-filter"></i>
                                    </button>
                                    <a href="<?php echo e(route('legal.unit.index')); ?>" class="btn btn-gradient-secondary btn-icon-only" title="Reset Filter">
                                        <i class="mdi mdi-refresh"></i>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Pure Clean Table: Daftar Unit Legalitas -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle table-legal-unit mb-0">
                            <thead>
                                <tr>
                                    <th class="col-no text-center">No</th>
                                    <th>Kode / Unit</th>
                                    <th>Tanah / Proyek Asal</th>
                                    <th>Tipe / Dimensi</th>
                                    <th>Jenis</th>
                                    <th style="min-width: 220px;">Legalitas & Sertifikat</th>
                                    <th class="col-status text-center">Status Unit</th>
                                    <th class="col-aksi text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <?php
                                        // Status Unit
                                        $st = strtolower($u->status ?? 'available');
                                        if ($st == 'available' || $st == 'tersedia') {
                                            $badgeBg = '#ecfdf5';
                                            $badgeColor = '#059669';
                                            $badgeBorder = '#a7f3d0';
                                            $stLabel = 'Available';
                                        } elseif ($st == 'booking') {
                                            $badgeBg = '#fffbeb';
                                            $badgeColor = '#d97706';
                                            $badgeBorder = '#fde68a';
                                            $stLabel = 'Booking';
                                        } elseif ($st == 'sold' || $st == 'terjual') {
                                            $badgeBg = '#fef2f2';
                                            $badgeColor = '#dc2626';
                                            $badgeBorder = '#fecaca';
                                            $stLabel = 'Sold';
                                        } else {
                                            $badgeBg = '#f8fafc';
                                            $badgeColor = '#475569';
                                            $badgeBorder = '#e2e8f0';
                                            $stLabel = ucfirst($st);
                                        }

                                        // Status Legalitas
                                        $legKey = $u->legal_status_key ?? 'persiapan';
                                        $legPct = (int) ($u->legal_progress_percentage ?? 0);
                                        if ($legKey == 'selesai') {
                                            $legBadgeBg = '#ecfdf5';
                                            $legBadgeColor = '#059669';
                                            $legBadgeBorder = '#a7f3d0';
                                            $pColor = '#10b981';
                                        } elseif ($legKey == 'bpn') {
                                            $legBadgeBg = '#f5f3ff';
                                            $legBadgeColor = '#7c3aed';
                                            $legBadgeBorder = '#ddd6fe';
                                            $pColor = '#7c3aed';
                                        } elseif ($legKey == 'notaris') {
                                            $legBadgeBg = '#f0f9ff';
                                            $legBadgeColor = '#0284c7';
                                            $legBadgeBorder = '#bae6fd';
                                            $pColor = '#0284c7';
                                        } else {
                                            $legBadgeBg = '#fffbeb';
                                            $legBadgeColor = '#d97706';
                                            $legBadgeBorder = '#fde68a';
                                            $pColor = '#f59e0b';
                                        }
                                    ?>
                                    <tr class="unit-table-row" id="row_unit_<?php echo e($u->id); ?>" 
                                        data-search="<?php echo e(strtolower($u->unit_code . ' ' . $u->unit_name . ' ' . ($u->landBank->name ?? '') . ' ' . $u->block . ' ' . $u->type . ' ' . $u->jenis . ' ' . $u->no_sertifikat . ' ' . $u->legal_status_label . ' ' . $stLabel)); ?>">
                                        
                                        <td class="col-no fw-bold text-center">
                                            <?php echo e($units->firstItem() + $index); ?>

                                        </td>

                                        <td>
                                            <!-- KODE / UNIT -->
                                            <div class="fw-bold text-dark font-monospace" style="font-size: 0.88rem; line-height: 1.3;">
                                                <?php echo e($u->unit_code ?: ($u->block . '-' . $u->unit_number)); ?>

                                            </div>
                                            <div class="text-secondary mt-0.5" style="font-size: 0.77rem; line-height: 1.3;">
                                                <?php echo e($u->unit_name ?: ('Blok ' . $u->block . ' No. ' . $u->unit_number)); ?>

                                            </div>
                                        </td>

                                        <td>
                                            <!-- TANAH / PROYEK ASAL -->
                                            <span class="badge py-1 px-2.5"
                                                style="background-color: #f3e8ff; color: #7e22ce; font-size: 0.76rem; font-weight: 700; border-radius: 6px; border: 1px solid #e9d5ff;">
                                                <i class="mdi mdi-map-marker me-0.5"></i><?php echo e($u->landBank->name ?? 'Tanah Proyek'); ?>

                                            </span>
                                        </td>

                                        <td>
                                            <!-- TIPE & DIMENSI -->
                                            <div class="fw-bold text-dark" style="font-size: 0.82rem;">
                                                <?php echo e($u->type ? 'Tipe ' . $u->type : '-'); ?>

                                            </div>
                                            <div class="text-secondary font-monospace" style="font-size: 0.75rem;">
                                                LB: <?php echo e($u->building_area ?? '-'); ?> m² | LT: <?php echo e($u->area ?? '-'); ?> m²
                                            </div>
                                        </td>

                                        <td>
                                            <!-- JENIS -->
                                            <?php if(strtolower($u->jenis) == 'subsidi'): ?>
                                                <span class="badge py-1 px-2.5 fw-semibold" 
                                                    style="background-color: #eff6ff; color: #1d4ed8; font-size: 0.74rem; border-radius: 6px; border: 1px solid #bfdbfe;">
                                                    Subsidi
                                                </span>
                                            <?php else: ?>
                                                <span class="badge py-1 px-2.5 fw-semibold" 
                                                    style="background-color: #fef3c7; color: #92400e; font-size: 0.74rem; border-radius: 6px; border: 1px solid #fde68a;">
                                                    Komersil
                                                </span>
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <!-- LEGALITAS & SERTIFIKAT -->
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <span class="badge py-0.5 px-2 fw-semibold" style="font-size: 0.72rem; border-radius: 4px; background-color: <?php echo e($legBadgeBg); ?>; color: <?php echo e($legBadgeColor); ?>; border: 1px solid <?php echo e($legBadgeBorder); ?>;">
                                                    <?php echo e($u->legal_status_label ?? 'Persiapan'); ?>

                                                </span>
                                                <span class="fw-bold" style="font-size: 0.75rem; color: #334155;"><?php echo e($legPct); ?>%</span>
                                            </div>
                                            <div class="fw-semibold text-dark mb-1" style="font-size: 0.79rem;">
                                                <i class="mdi mdi-certificate-outline me-1 text-primary"></i><?php echo e($u->no_sertifikat ?? '-'); ?>

                                            </div>
                                            <div class="progress" style="height: 5px; background-color: #e2e8f0; border-radius: 9999px;">
                                                <div class="progress-bar rounded-pill" role="progressbar" style="width: <?php echo e($legPct); ?>%; background-color: <?php echo e($pColor); ?>;"></div>
                                            </div>
                                        </td>

                                        <td class="col-status text-center">
                                            <!-- STATUS UNIT -->
                                            <span class="badge py-1 px-2.5 fw-semibold" style="font-size: 0.74rem; border-radius: 6px; background-color: <?php echo e($badgeBg); ?>; color: <?php echo e($badgeColor); ?>; border: 1px solid <?php echo e($badgeBorder); ?>;">
                                                <?php echo e($stLabel); ?>

                                            </span>
                                        </td>

                                        <td class="col-aksi text-center">
                                            <!-- AKSI -->
                                            <button type="button" 
                                                class="btn btn-sm btn-gradient-primary d-inline-flex align-items-center gap-1.5 px-2.5 py-1.5 shadow-sm text-decoration-none fw-semibold" 
                                                style="border-radius: 6px; font-size: 0.8rem;" 
                                                title="Lihat Detail Berkas Legalitas"
                                                onclick="showDetailModal(<?php echo e(json_encode($u)); ?>)">
                                                <i class="mdi mdi-file-document-outline" style="font-size: 0.95rem;"></i>
                                                <span>Detail</span>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-4">
                                            <i class="mdi mdi-home-alert-outline me-2" style="font-size: 1.5rem;"></i>
                                            Tidak ada data unit legalitas yang sesuai dengan filter.
                                        </td>
                                    </tr>
                                <?php endif; ?>

                                <tr id="noResultsRow" style="display: none;">
                                    <td colspan="8" class="text-center text-muted py-4">
                                        <i class="mdi mdi-magnify-close me-2" style="font-size: 1.5rem;"></i>
                                        Tidak ada unit legalitas yang cocok dengan kata kunci pencarian.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Footer -->
                    <?php if($units->hasPages()): ?>
                        <div class="px-3 py-3 border-top d-flex flex-wrap justify-content-between align-items-center bg-white">
                            <div class="text-muted" style="font-size: 0.82rem;">
                                Menampilkan <span class="fw-semibold text-dark"><?php echo e($units->firstItem() ?? 0); ?></span> - <span class="fw-semibold text-dark"><?php echo e($units->lastItem() ?? 0); ?></span> dari <span class="fw-semibold text-dark"><?php echo e($units->total()); ?></span> unit kavling
                            </div>
                            <div>
                                <?php echo e($units->links('pagination::bootstrap-5')); ?>

                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modal Detail Berkas Legalitas Unit -->
<div class="modal fade" id="detailLegalModal" tabindex="-1" aria-labelledby="detailLegalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header bg-light border-bottom py-3 px-4">
                <div class="d-flex align-items-center gap-2">
                    <div class="d-flex align-items-center justify-content-center rounded-circle bg-primary text-white" style="width: 36px; height: 36px;">
                        <i class="mdi mdi-file-certificate-outline" style="font-size: 1.2rem;"></i>
                    </div>
                    <div>
                        <h6 class="modal-title fw-bold text-dark mb-0" id="detailModalTitle">Detail Legalitas Unit</h6>
                        <small class="text-muted" id="detailModalSubtitle">Informasi Sertifikat & Perizinan Unit</small>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                
                <div class="p-3 mb-3 rounded-3" style="background-color: #f8fafc; border: 1px solid #e2e8f0;">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="text-secondary small fw-semibold">Progres Legalitas Unit</span>
                        <span class="fw-bold small text-primary" id="modalProgressText">100%</span>
                    </div>
                    <div class="progress" style="height: 6px; background-color: #e2e8f0; border-radius: 9999px;">
                        <div id="modalProgressBar" class="progress-bar rounded-pill bg-success" role="progressbar" style="width: 100%;"></div>
                    </div>
                </div>

                <div class="detail-list">
                    <div class="detail-item">
                        <span class="detail-label">Tanah / Proyek Asal</span>
                        <span class="detail-value text-primary" id="modalLandBank">-</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Kode & Blok Unit</span>
                        <span class="detail-value font-monospace" id="modalUnitCode">-</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Tipe & Dimensi</span>
                        <span class="detail-value" id="modalUnitType">-</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Jenis Properti</span>
                        <span class="detail-value text-capitalize" id="modalUnitJenis">-</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Status Unit</span>
                        <span class="detail-value text-capitalize" id="modalUnitStatus">-</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Status Legalitas</span>
                        <span class="detail-value text-success" id="modalLegalStatus">-</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Nomor Sertifikat</span>
                        <span class="detail-value fw-bold text-dark" id="modalNoSertifikat">-</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Nomor Objek Pajak (PBB)</span>
                        <span class="detail-value font-monospace" id="modalNoPbb">-</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Nomor PBG / IMB Unit</span>
                        <span class="detail-value font-monospace" id="modalNoPbg">-</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Status Pajak & Retribusi</span>
                        <span class="detail-value text-success" id="modalStatusPajak">-</span>
                    </div>
                </div>

            </div>
            <div class="modal-footer bg-light border-top py-2 px-4">
                <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    function applyLiveSearch(keyword) {
        keyword = (keyword || '').toLowerCase().trim();
        const rows = document.querySelectorAll('.unit-table-row');
        let visibleCount = 0;
        rows.forEach(row => {
            const searchData = row.getAttribute('data-search') || '';
            if (!keyword || searchData.includes(keyword)) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        const noRes = document.getElementById('noResultsRow');
        if (noRes) {
            noRes.style.display = (visibleCount === 0 && keyword !== '') ? '' : 'none';
        }
    }

    function showDetailModal(unit) {
        if (!unit) return;

        document.getElementById('detailModalTitle').innerText = 'Unit ' + (unit.unit_code || ('Blok ' + unit.block));
        document.getElementById('detailModalSubtitle').innerText = (unit.landBank ? unit.landBank.name : 'Tanah Kawasan') + ' • ' + (unit.unit_name || '');
        
        document.getElementById('modalLandBank').innerText = unit.landBank ? unit.landBank.name : '-';
        document.getElementById('modalUnitCode').innerText = (unit.unit_code || '-') + ' (Blok ' + (unit.block || '-') + ' No. ' + (unit.unit_number || '-') + ')';
        document.getElementById('modalUnitType').innerText = (unit.type ? 'Tipe ' + unit.type : '-') + ' (LB: ' + (unit.building_area || '-') + ' m² / LT: ' + (unit.area || '-') + ' m²)';
        document.getElementById('modalUnitJenis').innerText = unit.jenis || '-';
        document.getElementById('modalUnitStatus').innerText = unit.status || '-';
        document.getElementById('modalLegalStatus').innerText = unit.legal_status_label || '-';
        document.getElementById('modalNoSertifikat').innerText = unit.no_sertifikat || '-';
        document.getElementById('modalNoPbb').innerText = unit.no_pbb || '-';
        document.getElementById('modalNoPbg').innerText = unit.no_pbg || '-';
        document.getElementById('modalStatusPajak').innerText = unit.status_pajak || '-';

        const pct = parseInt(unit.legal_progress_percentage || 0);
        document.getElementById('modalProgressText').innerText = pct + '%';
        const pBar = document.getElementById('modalProgressBar');
        pBar.style.width = pct + '%';
        if (pct >= 100) {
            pBar.className = 'progress-bar rounded-pill bg-success';
        } else if (pct >= 60) {
            pBar.className = 'progress-bar rounded-pill bg-info';
        } else {
            pBar.className = 'progress-bar rounded-pill bg-warning';
        }

        const modalEl = document.getElementById('detailLegalModal');
        const modal = new bootstrap.Modal(modalEl);
        modal.show();
    }
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.partial.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Property-Management-Web-App\resources\views/legal_unit/index.blade.php ENDPATH**/ ?>