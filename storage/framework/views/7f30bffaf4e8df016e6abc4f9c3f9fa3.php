<?php $__env->startSection('title', 'Pembagian Tugas Perizinan - Property Management App'); ?>

<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/dashboard-clean.css')); ?>?v=<?php echo e(time()); ?>">
    <style>
        .task-user-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .user-avatar-circle {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6366f1, #a855f7);
            color: #ffffff;
            font-size: 0.76rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 2px 4px rgba(99, 102, 241, 0.2);
        }
        .user-avatar-circle.updater {
            background: linear-gradient(135deg, #0ea5e9, #2563eb);
            width: 26px;
            height: 26px;
            font-size: 0.68rem;
        }
        .timeline-container {
            position: relative;
            padding-left: 28px;
        }
        .timeline-container::before {
            content: '';
            position: absolute;
            top: 6px;
            bottom: 6px;
            left: 11px;
            width: 2px;
            background: #e2e8f0;
        }
        .timeline-item {
            position: relative;
            margin-bottom: 20px;
        }
        .timeline-point {
            position: absolute;
            left: -28px;
            top: 2px;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: #ffffff;
            border: 2px solid #4f46e5;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }
        .timeline-point.success {
            border-color: #16a34a;
            color: #16a34a;
            box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.1);
        }
        .timeline-point.warning {
            border-color: #f59e0b;
            color: #f59e0b;
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
        }
        .timeline-point.danger {
            border-color: #ef4444;
            color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }
        .timeline-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 12px 16px;
        }

        /* Table Responsive & Text Wrapping persis Perizinan */
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
        .table-perizinan .col-status {
            width: 105px;
            text-align: center;
            white-space: nowrap !important;
        }
        .table-perizinan .col-aksi {
            width: 195px !important;
            min-width: 195px !important;
            text-align: center;
            white-space: nowrap !important;
        }

        /* Cegah dropdown terpotong dan hilangkan scrollbar merusak tabel */
        .compact-table-card {
            overflow: visible !important;
        }
        .compact-table-card .table-responsive {
            overflow: visible !important;
        }
        @media (max-width: 991.98px) {
            .compact-table-card .table-responsive {
                overflow-x: auto !important;
            }
        }

        .dropdown-menu-action {
            min-width: 110px !important;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12) !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 6px !important;
            padding: 4px 0 !important;
            z-index: 1060 !important;
            background: #ffffff !important;
        }
        .dropdown-menu-action .dropdown-item {
            padding: 6px 14px !important;
            font-size: 0.82rem !important;
            font-weight: 500 !important;
            color: #334155 !important;
            display: flex !important;
            align-items: center !important;
            transition: all 0.15s ease !important;
            border: none !important;
            background: transparent !important;
            width: 100% !important;
            text-align: left !important;
        }
        .dropdown-menu-action .dropdown-item:hover {
            background-color: #f8fafc !important;
            color: #0f172a !important;
        }
        .dropdown-menu-action .dropdown-item.text-danger:hover {
            background-color: #fef2f2 !important;
            color: #dc2626 !important;
        }

        /* Styling Card Tabel Meniru Persis Card Perizinan (.compact-table-card) */
        .card.compact-table-card,
        .compact-table-card {
            background: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 8px !important;
            box-shadow: none !important;
            transition: border-color 0.2s ease;
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

        /* Button Action styling persis Perizinan */
        .btn-action-edit {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            color: #1e293b;
            border-radius: 6px;
            padding: 4px 12px;
            font-size: 0.8rem;
            font-weight: 500;
            transition: all 0.15s ease;
        }
        .btn-action-edit:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
            color: #0f172a;
        }
        .btn-action-dots {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            color: #64748b;
            border-radius: 6px;
            padding: 4px 9px;
            font-size: 0.85rem;
        }
        .btn-action-dots:hover {
            background: #f8fafc;
            color: #1e293b;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-2 px-md-4 py-3">

    <!-- Header Judul & Navigasi Tab -->
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-3">
        <div>
            <h2 class="text-dark mb-1 fw-bold" style="font-size: 1.55rem; letter-spacing: -0.02em;">
                Pembagian Tugas Perizinan
            </h2>
            <p class="text-muted mb-0" style="font-size: 0.88rem;">
                Delegasi tugas perizinan staf legal, update progres lapangan, serta pelacakan riwayat aktivitas pembaruan.
            </p>
        </div>
    </div>

    <!-- Alert Notifikasi -->
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm d-flex align-items-center gap-2 mb-4" role="alert" style="border-radius: 8px; background: #ecfdf5; color: #065f46;">
            <i class="mdi mdi-check-circle fs-5 text-success"></i>
            <div><?php echo e(session('success')); ?></div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm d-flex align-items-center gap-2 mb-4" role="alert" style="border-radius: 8px; background: #fef2f2; color: #991b1b;">
            <i class="mdi mdi-alert-circle fs-5 text-danger"></i>
            <div><?php echo e(session('error')); ?></div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>


    <!-- 4 KPI Metrics Card -->
    <div class="dash-kpi-grid mb-4">
        <!-- Total Tugas -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon purple">
                    <i class="mdi mdi-clipboard-text-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Total Tugas</div>
                    <div class="dash-kpi-val"><?php echo e($totalTugas); ?></div>
                    <div class="dash-kpi-sub"><?php echo e($isStaffLegal && !$canManage ? 'Tugas Saya' : 'Semua Staf Legal'); ?></div>
                </div>
            </div>
            <div class="dash-kpi-action purple">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>

        <!-- Dalam Proses -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon blue">
                    <i class="mdi mdi-progress-clock"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Dalam Proses</div>
                    <div class="dash-kpi-val"><?php echo e($tugasProses); ?></div>
                    <div class="dash-kpi-sub">Sedang Dikerjakan Lapangan</div>
                </div>
            </div>
            <div class="dash-kpi-action blue">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>

        <!-- Selesai (Terbit) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon green">
                    <i class="mdi mdi-check-decagram-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Izin Selesai</div>
                    <div class="dash-kpi-val"><?php echo e($tugasSelesai); ?></div>
                    <div class="dash-kpi-sub">Dokumen Terbit Resmi</div>
                </div>
            </div>
            <div class="dash-kpi-action green">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>

        <!-- Terkendala / Pending -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon <?php echo e($tugasTerkendala > 0 ? 'rose' : 'orange'); ?>">
                    <i class="mdi <?php echo e($tugasTerkendala > 0 ? 'mdi-alert-circle-outline' : 'mdi-clock-outline'); ?>"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label"><?php echo e($tugasTerkendala > 0 ? 'Terkendala' : 'Pending'); ?></div>
                    <div class="dash-kpi-val"><?php echo e($tugasTerkendala > 0 ? $tugasTerkendala : $tugasPending); ?></div>
                    <div class="dash-kpi-sub"><?php echo e($tugasTerkendala > 0 ? 'Butuh Tindak Lanjut' : 'Menunggu Pengerjaan'); ?></div>
                </div>
            </div>
            <div class="dash-kpi-action <?php echo e($tugasTerkendala > 0 ? 'rose' : 'orange'); ?>">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>
    </div>

    <!-- Main Container: Table & Filters (Sama Persis Format Perizinan) -->
    <div class="row mt-2 mt-sm-2 mt-md-3">
        <div class="col-12">
            <div class="card compact-table-card">
                <div class="card-header bg-white d-flex flex-wrap flex-md-row justify-content-between align-items-center gap-2">
                    <div class="d-flex align-items-center gap-2">
                        <div style="width: 32px; height: 32px; border-radius: 5px; background-color: #f3e8ff; color: #9333ea; display: inline-flex; align-items: center; justify-content: center; font-size: 1.15rem; flex-shrink: 0;">
                            <i class="mdi mdi-format-list-checks"></i>
                        </div>
                        <span style="font-size: 0.95rem; font-weight: 700; color: #0f172a;">Daftar Delegasi Tugas Perizinan</span>
                    </div>

                    <?php if($canManage): ?>
                        <a href="<?php echo e(route('perizinan.tugas.create')); ?>" class="btn btn-sm btn-gradient-primary d-inline-flex align-items-center px-3 py-1.5 fw-semibold shadow-sm" style="border-radius: 5px; font-size: 0.84rem;">
                            <i class="mdi mdi-plus-circle-outline fs-6" style="margin-right: 6px !important;"></i>
                            <span>Tugaskan Staf Legal</span>
                        </a>
                    <?php endif; ?>
                </div>

                <div class="card-body">
                    <!-- Filter Toolbar -->
                    <div class="filter-card">
                        <form id="filterForm" method="GET" action="<?php echo e(route('perizinan.tugas.index')); ?>">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                    <!-- Search Input -->
                                    <div style="min-width: 220px; max-width: 320px; flex: 1;">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" id="liveSearchInput"
                                                placeholder="Cari tugas, instansi, proyek..."
                                                value="<?php echo e(request('search')); ?>"
                                                style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none;">
                                            <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                type="submit" title="Cari"
                                                style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <?php if($canManage): ?>
                                        <!-- Filter Staf Legal -->
                                        <div style="width: 170px;">
                                            <select name="employee_id" class="form-control" onchange="document.getElementById('filterForm').submit()">
                                                <option value="all">Semua Staf Legal</option>
                                                <?php $__currentLoopData = $legalStaffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($staf->id); ?>" <?php echo e(request('employee_id') == $staf->id ? 'selected' : ''); ?>>
                                                        <?php echo e($staf->name); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Filter Proyek -->
                                    <div style="width: 170px;">
                                        <select name="proyek_id" class="form-control" onchange="document.getElementById('filterForm').submit()">
                                            <option value="all">Semua Proyek</option>
                                            <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($p['id']); ?>" <?php echo e(request('proyek_id') == $p['id'] ? 'selected' : ''); ?>>
                                                    <?php echo e($p['nama']); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    <!-- Filter Status -->
                                    <div style="width: 150px;">
                                        <select name="status" class="form-control" onchange="document.getElementById('filterForm').submit()">
                                            <option value="all" <?php echo e(request('status') == 'all' ? 'selected' : ''); ?>>Semua Status</option>
                                            <option value="Pending" <?php echo e(request('status') == 'Pending' ? 'selected' : ''); ?>>Pending</option>
                                            <option value="Dalam Proses" <?php echo e(request('status') == 'Dalam Proses' ? 'selected' : ''); ?>>Dalam Proses</option>
                                            <option value="Selesai" <?php echo e(request('status') == 'Selesai' ? 'selected' : ''); ?>>Selesai</option>
                                            <option value="Terkendala" <?php echo e(request('status') == 'Terkendala' ? 'selected' : ''); ?>>Terkendala</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Filter Buttons -->
                                <div class="d-flex align-items-center gap-2 ms-auto">
                                    <button type="submit" class="btn btn-gradient-primary btn-icon-only" title="Terapkan Filter">
                                        <i class="mdi mdi-filter"></i>
                                    </button>
                                    <?php if(request()->hasAny(['search', 'employee_id', 'proyek_id', 'status'])): ?>
                                        <a href="<?php echo e(route('perizinan.tugas.index')); ?>" class="btn btn-gradient-secondary btn-icon-only" title="Reset Filter">
                                            <i class="mdi mdi-refresh"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- TABEL DATA (PERSIS PERIZINAN) -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle table-perizinan">
                            <thead>
                                <tr>
                                    <th class="col-no">No</th>
                                    <th>Tugas Perizinan & Instansi</th>
                                    <th>Proyek Kawasan</th>
                                    <th>Staf Pelaksana</th>
                                    <th style="width: 110px;">Deadline</th>
                                    <th style="width: 120px;">Progres</th>
                                    <th class="col-status text-center">Status</th>
                                    <th class="col-aksi text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <?php
                                        $st = $task->status;
                                        if ($st === 'Selesai') {
                                            $pColor = '#10b981';
                                        } elseif ($st === 'Dalam Proses') {
                                            $pColor = '#4f46e5';
                                        } elseif ($st === 'Terkendala') {
                                            $pColor = '#dc2626';
                                        } else {
                                            $pColor = '#94a3b8';
                                        }

                                        $staffName = $task->employee->name ?? 'Staf';
                                    ?>
                                    <tr>
                                        <td class="col-no fw-bold text-center text-muted">
                                            <?php echo e($loop->iteration + ($tasks->currentPage() - 1) * $tasks->perPage()); ?>

                                        </td>

                                        <!-- Tugas & Instansi -->
                                        <td>
                                            <div class="fw-bold text-dark" style="font-size: 0.86rem; line-height: 1.35;">
                                                <?php echo e($task->nama_tugas); ?>

                                            </div>
                                            <div class="text-secondary small mt-0.5" style="font-size: 0.76rem;">
                                                <i class="mdi mdi-bank-outline me-1"></i><?php echo e($task->instansi ?: 'Instansi Pemda / BPN'); ?>

                                            </div>
                                            <?php if($task->nomor_dokumen): ?>
                                                <div class="mt-1">
                                                    <span class="badge bg-light text-dark border font-monospace" style="font-size: 0.7rem;">
                                                        <i class="mdi mdi-certificate-outline me-0.5 text-primary"></i><?php echo e($task->nomor_dokumen); ?>

                                                    </span>
                                                </div>
                                            <?php endif; ?>
                                        </td>

                                        <!-- Proyek Kawasan -->
                                        <td>
                                            <span class="badge px-2 py-1 text-wrap text-start" style="background-color: #f1f5f9; color: #334155; font-size: 0.78rem; font-weight: 600; border: 1px solid #e2e8f0;">
                                                <i class="mdi mdi-map-marker-outline text-danger me-0.5"></i><?php echo e($task->proyek_nama ?: 'Kawasan Umum'); ?>

                                            </span>
                                        </td>

                                        <!-- Staf Pelaksana -->
                                        <td>
                                            <div class="fw-semibold text-dark" style="font-size: 0.85rem;">
                                                <?php echo e($staffName); ?>

                                            </div>
                                        </td>

                                        <!-- Deadline -->
                                        <td>
                                            <?php if($task->deadline): ?>
                                                <?php
                                                    $isOverdue = $task->deadline->isPast() && $task->status !== 'Selesai';
                                                ?>
                                                <div style="font-size: 0.8rem; font-weight: 600; color: <?php echo e($isOverdue ? '#dc2626' : '#475569'); ?>;">
                                                    <i class="mdi mdi-calendar-clock me-0.5"></i><?php echo e($task->deadline->format('d M Y')); ?>

                                                </div>
                                                <?php if($isOverdue): ?>
                                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle mt-0.5" style="font-size: 0.68rem;">Terlambat</span>
                                                <?php else: ?>
                                                    <small class="text-muted d-block" style="font-size: 0.7rem;"><?php echo e($task->deadline->diffForHumans()); ?></small>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <span class="text-muted" style="font-size: 0.8rem;">-</span>
                                            <?php endif; ?>
                                        </td>

                                        <!-- Progres -->
                                        <td>
                                            <div class="dash-progress-wrap">
                                                <div class="dash-progress-bar-bg" style="width: 75px;">
                                                    <div class="dash-progress-bar-fill" style="width: <?php echo e($task->progress); ?>%; background-color: <?php echo e($pColor); ?>;"></div>
                                                </div>
                                                <span style="font-size: 0.75rem; font-weight: 700; color: #334155;"><?php echo e($task->progress); ?>%</span>
                                            </div>
                                        </td>

                                        <!-- Status -->
                                        <td class="col-status text-center">
                                            <?php if($task->status == 'Selesai'): ?>
                                                <span class="dash-status-pill on-track"><span class="dot"></span>Selesai</span>
                                            <?php elseif($task->status == 'Dalam Proses'): ?>
                                                <span class="dash-status-pill" style="background-color: #e0f2fe; color: #0284c7; border-color: #bae6fd;"><span class="dot" style="background-color: #0284c7;"></span>Proses</span>
                                            <?php elseif($task->status == 'Terkendala'): ?>
                                                <span class="dash-status-pill danger"><span class="dot"></span>Kendala</span>
                                            <?php else: ?>
                                                <span class="dash-status-pill" style="background-color: #f1f5f9; color: #64748b; border-color: #e2e8f0;"><span class="dot" style="background-color: #94a3b8;"></span>Pending</span>
                                            <?php endif; ?>
                                        </td>

                                        <!-- Aksi -->
                                        <td class="col-aksi text-center">
                                            <div class="d-flex align-items-center justify-content-center gap-1">
                                                <?php if($canManage || ($isStaffLegal && $task->employee_id == auth()->id())): ?>
                                                    <a href="<?php echo e(route('perizinan.tugas.progres', $task->id)); ?>" class="btn btn-action-edit d-inline-flex align-items-center gap-1 shadow-none"
                                                        title="Update Progres & Dokumen">
                                                        <i class="mdi mdi-pencil text-primary"></i>
                                                        <span>Progres</span>
                                                    </a>
                                                <?php endif; ?>

                                                <button type="button" class="btn btn-action-edit d-inline-flex align-items-center gap-1 shadow-none"
                                                    title="Lihat Riwayat & Audit Trail"
                                                    onclick="bukaModalRiwayatLog(<?php echo e($task->id); ?>)">
                                                    <i class="mdi mdi-history text-info"></i>
                                                    <span>Log</span>
                                                </button>

                                                <?php if($canManage): ?>
                                                    <div class="dropdown d-inline-block position-relative">
                                                        <button class="btn btn-action-dots d-inline-flex align-items-center justify-content-center shadow-none" 
                                                            type="button" 
                                                            data-toggle="dropdown" 
                                                            data-bs-toggle="dropdown" 
                                                            aria-haspopup="true" 
                                                            aria-expanded="false"
                                                            title="Pilihan Lainnya">
                                                            <i class="mdi mdi-dots-vertical"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-end dropdown-menu-action shadow-sm border">
                                                            <a class="dropdown-item py-1.5" href="<?php echo e(route('perizinan.tugas.edit', $task->id)); ?>">
                                                                <i class="mdi mdi-pencil-outline text-warning" style="margin-right: 6px !important; font-size: 0.95rem;"></i>
                                                                <span>Edit</span>
                                                            </a>
                                                            <div class="dropdown-divider my-1"></div>
                                                            <form action="<?php echo e(route('perizinan.tugas.destroy', $task->id)); ?>" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus tugas ini? Riwayat log tugas juga akan terhapus.');" class="m-0 p-0">
                                                                <?php echo csrf_field(); ?>
                                                                <?php echo method_field('DELETE'); ?>
                                                                <button type="submit" class="dropdown-item text-danger py-1.5">
                                                                    <i class="mdi mdi-trash-can-outline" style="margin-right: 6px !important; font-size: 0.95rem;"></i>
                                                                    <span>Hapus</span>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-5">
                                            <div class="p-3">
                                                <i class="mdi mdi-clipboard-text-off-outline text-secondary" style="font-size: 2.8rem; opacity: 0.5;"></i>
                                                <h5 class="fw-bold text-dark mt-2 mb-1" style="font-size: 1rem;">Belum Ada Tugas Perizinan</h5>
                                                <p class="text-muted mb-0" style="font-size: 0.82rem;">
                                                    <?php echo e($isStaffLegal && !$canManage ? 'Saat ini belum ada tugas perizinan yang didelegasikan kepada Anda.' : 'Silakan klik tombol "Tugaskan Staf Legal" untuk membagi tugas baru.'); ?>

                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <?php if($tasks->hasPages()): ?>
                        <div class="p-3 border-top d-flex flex-wrap justify-content-between align-items-center gap-2">
                            <small class="text-muted" style="font-size: 0.82rem;">
                                Menampilkan <?php echo e($tasks->firstItem()); ?> - <?php echo e($tasks->lastItem()); ?> dari <?php echo e($tasks->total()); ?> tugas
                            </small>
                            <div>
                                <?php echo e($tasks->links('pagination::bootstrap-4')); ?>

                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</div>


<!-- ================= MODAL: AUDIT TRAIL / RIWAYAT AKTIVITAS (HANYA LOG YANG TETAP MODAL) ================= -->
<div class="modal fade" id="modalRiwayatLog" tabindex="-1" aria-labelledby="modalRiwayatLogLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 580px; width: 95%;">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 6px !important; overflow: hidden; border: 1px solid #e2e8f0;">
            <div class="modal-header px-4 py-3 bg-white border-bottom">
                <div class="d-flex align-items-center gap-2">
                    <div class="p-2 rounded-2" style="background: rgba(14, 165, 233, 0.1); color: #0ea5e9;">
                        <i class="mdi mdi-history fs-5"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold text-dark mb-0" style="font-size: 1rem;">
                            Riwayat Aktivitas & Audit Trail
                        </h5>
                        <small class="text-muted" id="auditModalSubtitle" style="font-size: 0.78rem;">
                            Kronologis pembaruan data dan staf pengubah
                        </small>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body px-4 py-3 bg-white">
                <!-- Header Ringkasan Tugas -->
                <div class="p-3 mb-4" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 5px;">
                    <div class="row g-2">
                        <div class="col-sm-6">
                            <span class="text-muted small d-block" style="font-size: 0.72rem;">NAMA TUGAS</span>
                            <span class="fw-bold text-dark" id="auditTaskNama" style="font-size: 0.88rem;">-</span>
                        </div>
                        <div class="col-sm-6">
                            <span class="text-muted small d-block" style="font-size: 0.72rem;">PROYEK KAWASAN</span>
                            <span class="fw-bold text-dark" id="auditTaskProyek" style="font-size: 0.88rem;">-</span>
                        </div>
                        <div class="col-sm-6 mt-2">
                            <span class="text-muted small d-block" style="font-size: 0.72rem;">STAF PELAKSANA</span>
                            <span class="fw-bold text-primary" id="auditTaskStaff" style="font-size: 0.84rem;">-</span>
                        </div>
                        <div class="col-sm-6 mt-2">
                            <span class="text-muted small d-block" style="font-size: 0.72rem;">STATUS & PROGRES SAAT INI</span>
                            <span id="auditTaskStatusBadge" class="badge bg-secondary">-</span>
                        </div>
                    </div>
                </div>

                <!-- Container Timeline Kronologis -->
                <h6 class="fw-bold text-dark mb-3" style="font-size: 0.86rem;">
                    <i class="mdi mdi-timeline-clock-outline me-1 text-primary"></i> Kronologi Pembaruan (Terbaru ke Terlama):
                </h6>
                
                <div id="timelineContentWrapper" class="timeline-container">
                    <div class="text-center py-4 text-muted">
                        <div class="spinner-border spinner-border-sm text-primary me-1" role="status"></div>
                        <span>Memuat riwayat aktivitas...</span>
                    </div>
                </div>
            </div>

            <div class="modal-footer px-4 py-2.5 bg-white border-top">
                <button type="button" class="btn btn-secondary btn-sm px-4" data-bs-dismiss="modal" style="border-radius: 5px;">Tutup</button>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    $(document).ready(function() {
        if (typeof $.fn.dropdown !== 'undefined') {
            $('[data-toggle="dropdown"]').dropdown();
        }
    });

    // BUKA MODAL RIWAYAT AUDIT TRAIL LOG
    function bukaModalRiwayatLog(taskId) {
        var modal = new bootstrap.Modal(document.getElementById('modalRiwayatLog'));
        modal.show();

        var container = document.getElementById('timelineContentWrapper');
        container.innerHTML = `
            <div class="text-center py-4 text-muted">
                <div class="spinner-border spinner-border-sm text-primary me-1" role="status"></div>
                <span>Memuat riwayat aktivitas...</span>
            </div>
        `;

        fetch('/perizinan-tugas/' + taskId + '/logs')
            .then(res => res.json())
            .then(data => {
                if (data.status !== 'success') {
                    container.innerHTML = '<div class="alert alert-danger py-2">Gagal memuat log aktivitas.</div>';
                    return;
                }

                var task = data.task;
                document.getElementById('auditTaskNama').textContent = task.nama_tugas;
                document.getElementById('auditTaskProyek').textContent = task.proyek_nama || 'Kawasan Umum';
                document.getElementById('auditTaskStaff').textContent = task.staff_name + ' (' + task.staff_pos + ')';
                
                var stBadge = document.getElementById('auditTaskStatusBadge');
                stBadge.textContent = task.status + ' (' + task.progress + '%)';
                stBadge.className = 'badge ' + (task.status === 'Selesai' ? 'bg-success' : (task.status === 'Dalam Proses' ? 'bg-primary' : (task.status === 'Terkendala' ? 'bg-danger' : 'bg-secondary')));

                var logs = data.logs;
                if (!logs || logs.length === 0) {
                    container.innerHTML = '<p class="text-muted text-center py-3">Belum ada catatan aktivitas perubahan.</p>';
                    return;
                }

                var html = '';
                logs.forEach(function(item) {
                    var pointClass = '';
                    var icon = 'mdi-pencil';
                    if (item.action.includes('Selesai') || item.new_status === 'Selesai') {
                        pointClass = 'success';
                        icon = 'mdi-check-bold';
                    } else if (item.action.includes('Kendala') || item.new_status === 'Terkendala') {
                        pointClass = 'danger';
                        icon = 'mdi-alert';
                    } else if (item.action.includes('Penugasan') || item.action.includes('Reassign')) {
                        pointClass = 'warning';
                        icon = 'mdi-account-arrow-right';
                    }

                    var fileBtn = '';
                    if (item.file_url) {
                        fileBtn = `
                            <div class="mt-2">
                                <a href="${item.file_url}" target="_blank" class="btn btn-xs btn-outline-success py-1 px-2 fw-semibold" style="font-size: 0.74rem; border-radius: 4px;">
                                    <i class="mdi mdi-file-download-outline me-1"></i>Unduh / Pratinjau Dokumen SK
                                </a>
                            </div>
                        `;
                    }

                    html += `
                        <div class="timeline-item">
                            <div class="timeline-point ${pointClass}">
                                <i class="mdi ${icon}"></i>
                            </div>
                            <div class="timeline-box">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-1">
                                    <div class="d-flex align-items-center gap-1.5">
                                        <span class="fw-bold text-dark" style="font-size: 0.86rem;">${item.user_name}</span>
                                        <span class="badge" style="background: #e0f2fe; color: #0369a1; font-size: 0.68rem; font-weight: 600;">
                                            ${item.user_pos}
                                        </span>
                                    </div>
                                    <small class="text-muted" style="font-size: 0.72rem;">
                                        <i class="mdi mdi-clock-outline me-0.5"></i>${item.created_at} (${item.time_ago})
                                    </small>
                                </div>

                                <div class="fw-semibold text-primary mb-1" style="font-size: 0.8rem;">
                                    ${item.action}
                                </div>

                                ${item.new_status ? `
                                    <div class="mb-1.5" style="font-size: 0.78rem;">
                                        <span class="text-muted">Status:</span>
                                        <span class="badge bg-light text-dark border px-2 py-0.5">${item.old_status || 'Awal'}</span>
                                        <i class="mdi mdi-arrow-right text-muted mx-1"></i>
                                        <span class="badge bg-primary px-2 py-0.5">${item.new_status}</span>
                                        ${item.new_progress !== null ? `<span class="fw-bold text-dark ms-1">(${item.new_progress}%)</span>` : ''}
                                    </div>
                                ` : ''}

                                <div class="text-secondary" style="font-size: 0.8rem; line-height: 1.35; background: #ffffff; padding: 6px 10px; border-radius: 6px; border: 1px solid #f1f5f9;">
                                    ${item.keterangan || 'Tidak ada catatan tambahan.'}
                                </div>

                                ${fileBtn}
                            </div>
                        </div>
                    `;
                });

                container.innerHTML = html;
            })
            .catch(err => {
                console.error(err);
                container.innerHTML = '<div class="alert alert-danger py-2">Gagal menghubungi server untuk memuat log.</div>';
            });
    }
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.partial.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Property-Management-Web-App\resources\views/perizinan/tugas/index.blade.php ENDPATH**/ ?>