<?php $__env->startSection('title', 'Pra Tanah - Property Management App'); ?>

<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/dashboard-clean.css')); ?>?v=<?php echo e(time()); ?>">
    <style>
        /* Table Responsive & Text Wrapping persis Perizinan */
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
            padding: 0.75rem 0.65rem !important;
            vertical-align: middle;
            white-space: nowrap;
        }
        .table-lahan tbody td {
            padding: 0.75rem 0.65rem !important;
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
            width: 190px;
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
        .compact-table-card .card-header {
            background: #ffffff !important;
            border-bottom: 1px solid #e2e8f0 !important;
            padding: 0.75rem 1.25rem !important;
            border-top-left-radius: 8px !important;
            border-top-right-radius: 8px !important;
        }
        .compact-table-card .card-body,
        .card.compact-table-card .card-body {
            padding: 0 !important;
            background: #ffffff !important;
        }

        /* Tombol Aksi Fase */
        .btn-fase-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            padding: 0.32rem 0.6rem;
            font-size: 0.76rem;
            font-weight: 600;
            border-radius: 6px;
            border: none;
            color: #ffffff !important;
            transition: all 0.2s ease;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            text-decoration: none;
            line-height: 1.2;
            cursor: pointer;
        }
        .btn-fase-action:hover {
            transform: translateY(-1px);
            box-shadow: 0 3px 6px rgba(0,0,0,0.12);
            color: #ffffff !important;
        }
        .btn-fase-1 {
            background: linear-gradient(135deg, #a855f7, #7e22ce);
        }
        .btn-fase-2 {
            background: linear-gradient(135deg, #0284c7, #0369a1);
        }
        .btn-fase-3 {
            background: linear-gradient(135deg, #10b981, #059669);
        }
        .btn-fase-delete {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            padding: 0.32rem 0.55rem;
        }

        /* Process Document Pill */
        .process-doc-pill {
            background: #ffffff;
            border: 1px solid #e9e4f5 !important;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
            transition: all 0.2s ease;
        }
        .process-doc-pill:hover {
            border-color: #c4b5fd !important;
            box-shadow: 0 2px 6px rgba(154, 85, 255, 0.1) !important;
        }
        .btn-upload-doc-pill {
            padding: 3px 8px !important;
            font-size: 9.5px !important;
            font-weight: 700 !important;
            border-radius: 6px !important;
            border: none !important;
            background: linear-gradient(135deg, #da8cff, #9a55ff) !important;
            color: #ffffff !important;
            box-shadow: 0 2px 4px rgba(154, 85, 255, 0.25);
            transition: all 0.2s ease;
            cursor: pointer;
            text-decoration: none;
            line-height: 1.2;
        }

        /* Modern File Upload */
        .pratanah-file-upload-modern {
            position: relative;
            width: 100%;
        }
        .pratanah-file-upload-modern input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
            z-index: 2;
        }
        .pratanah-file-label-modern {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0.65rem 1rem;
            background: #f8fafc;
            border: 2px dashed #cbd5e1;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .pratanah-file-upload-modern:hover .pratanah-file-label-modern {
            border-color: #6366f1;
            background: #f5f3ff;
        }
        .pratanah-file-info-modern {
            flex: 1;
        }
        .pratanah-file-size {
            font-size: 0.7rem;
            color: #6366f1;
            font-weight: 600;
            background: rgba(99, 102, 241, 0.1);
            padding: 2px 8px;
            border-radius: 20px;
        }

        /* Badge Prioritas */
        .badge-priority {
            font-size: 0.73rem;
            font-weight: 600;
            padding: 3px 8px;
            border-radius: 6px;
        }
        .badge-priority-urgent {
            background-color: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }
        .badge-priority-high {
            background-color: #fff7ed;
            color: #ea580c;
            border: 1px solid #fed7aa;
        }
        .badge-priority-normal {
            background-color: #f0fdf4;
            color: #16a34a;
            border: 1px solid #bbf7d0;
        }
        .badge-priority-low {
            background-color: #f8fafc;
            color: #64748b;
            border: 1px solid #e2e8f0;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<?php
    $praLandBank = $praLandBank ?? ($praLandbank ?? ($lands ?? collect()));
    $documentTypes = $documentTypes ?? \App\Models\DocumentTypes::all();
    $landsWithPendingDocsCount = $landsWithPendingDocsCount ?? 0;

    $currentUser = auth()->user();
    $userPositionName = strtolower($currentUser->position->name ?? '');
    $userDivisionName = strtolower($currentUser->division->name ?? ($currentUser->position->division->name ?? ''));
    $userPositionId = $currentUser->position_id ?? null;
    $isAdmin = ($userPositionId == 5) || str_contains($userPositionName, 'admin');
    $isKeuangan = ($userPositionId == 7) || str_contains($userPositionName, 'keuangan') || str_contains($userPositionName, 'finance') || str_contains($userDivisionName, 'keuangan') || str_contains($userDivisionName, 'finance');
?>

<div class="container-fluid px-2 px-md-4 py-3">

    <!-- Page Title & Subtitle (Persis Perizinan) -->
    <div class="row align-items-center mb-4">
        <div class="col">
            <h2 class="text-dark mb-1 fw-bold" style="font-size: 1.55rem; letter-spacing: -0.02em;">
                Pra Tanah / Pra Pelepasan
            </h2>
            <p class="text-muted mb-0" style="font-size: 0.88rem;">
                Kelola data tanah dalam tahap penawaran, survei lokasi, verifikasi legalitas, dan negosiasi transaksi.
            </p>
        </div>
    </div>

    <!-- 4 KPI Metrics Card Grid (Sama Persis Perizinan) -->
    <div class="dash-kpi-grid mb-4">
        
        <!-- Card 1: Total Pra Tanah (Ungu) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon purple">
                    <i class="mdi mdi-hand-holding-usd"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Total Pra Tanah</div>
                    <div class="dash-kpi-val"><?php echo e($totalPraTanah ?? $praLandBank->total()); ?></div>
                    <div class="dash-kpi-sub">Seluruh Tanah Terdaftar</div>
                </div>
            </div>
            <div class="dash-kpi-action purple">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>

        <!-- Card 2: Fase 1: Survei & Legal (Biru) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon blue">
                    <i class="mdi mdi-clipboard-text-search-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Fase 1: Survei & Legal</div>
                    <div class="dash-kpi-val"><?php echo e($totalFase1 ?? 0); ?></div>
                    <div class="dash-kpi-sub">Pemeriksaan Awal & Berkas</div>
                </div>
            </div>
            <div class="dash-kpi-action blue">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>

        <!-- Card 3: Fase 2: Negosiasi (Kuning / Amber) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon amber">
                    <i class="mdi mdi-handshake-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Fase 2: Negosiasi</div>
                    <div class="dash-kpi-val"><?php echo e($totalFase2 ?? 0); ?></div>
                    <div class="dash-kpi-sub">Penawaran & Kesepakatan</div>
                </div>
            </div>
            <div class="dash-kpi-action amber">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>

        <!-- Card 4: Fase 3: Sidang & Deal (Hijau) -->
        <div class="dash-kpi-card">
            <div class="dash-kpi-left">
                <div class="dash-kpi-icon green">
                    <i class="mdi mdi-check-decagram-outline"></i>
                </div>
                <div class="dash-kpi-info">
                    <div class="dash-kpi-label">Fase 3: Sidang & Deal</div>
                    <div class="dash-kpi-val"><?php echo e($totalFase3 ?? 0); ?></div>
                    <div class="dash-kpi-sub">Disetujui / Deal Pembayaran</div>
                </div>
            </div>
            <div class="dash-kpi-action green">
                <i class="mdi mdi-arrow-right"></i>
            </div>
        </div>
    </div>

    <!-- Main Container: Table Card (Sama Persis Perizinan) -->
    <div class="row">
        <div class="col-12">
            <div class="card compact-table-card shadow-sm border-0">
                
                <!-- Card Header -->
                <div class="card-header bg-white d-flex flex-wrap justify-content-between align-items-center gap-2 py-3 border-bottom">
                    <div>
                        <h5 class="card-title mb-0" style="font-weight: 700; color: #1e293b; font-size: 1.05rem;">
                            <i class="mdi mdi-format-list-bulleted me-2" style="color: #6366f1;"></i>Daftar Pra Tanah
                        </h5>
                    </div>
                    <?php if(!$isKeuangan || $isAdmin): ?>
                        <a class="btn btn-sm btn-gradient-primary d-inline-flex align-items-center gap-1.5 px-3 py-2 shadow-sm fw-semibold" style="border-radius: 6px; font-size: 0.84rem;"
                            href="<?php echo e(route('pra-landbank.proses')); ?>">
                            <i class="mdi mdi-plus"></i>Tambah Pra Tanah
                        </a>
                    <?php endif; ?>
                </div>

                <div class="card-body p-0">
                    
                    <!-- Search & Filter Toolbar -->
                    <div class="card-toolbar-box p-3 border-bottom bg-white">
                        <form id="filterForm" method="GET" action="<?php echo e(route('pralandbank.all')); ?>">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                                
                                <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                    <!-- Search Input -->
                                    <div style="min-width: 240px; max-width: 360px; flex: 1;">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" id="liveSearchInput"
                                                placeholder="Cari nama tanah, pemilik, atau makelar..."
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

                                    <!-- Filter Limit Dropdown -->
                                    <div style="width: 130px;">
                                        <select class="form-control" name="perPage" onchange="document.getElementById('filterForm').submit()">
                                            <option value="5" <?php echo e(request('perPage') == 5 ? 'selected' : ''); ?>>5 Data</option>
                                            <option value="10" <?php echo e(request('perPage', 10) == 10 ? 'selected' : ''); ?>>10 Data</option>
                                            <option value="15" <?php echo e(request('perPage') == 15 ? 'selected' : ''); ?>>15 Data</option>
                                            <option value="25" <?php echo e(request('perPage') == 25 ? 'selected' : ''); ?>>25 Data</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="d-flex align-items-center gap-2 ms-auto">
                                    <button type="submit" class="btn btn-gradient-primary btn-icon-only" title="Terapkan Filter">
                                        <i class="mdi mdi-filter"></i>
                                    </button>
                                    <a href="<?php echo e(route('pralandbank.all')); ?>" class="btn btn-gradient-secondary btn-icon-only" title="Reset Filter">
                                        <i class="mdi mdi-refresh"></i>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>

                    <?php if(!empty($landsWithPendingDocsCount) && $landsWithPendingDocsCount > 0): ?>
                        <div class="m-3 mb-0 alert alert-warning border-0 shadow-sm rounded-3 d-flex align-items-center justify-content-between p-3" style="background: #fffbeb; border-left: 4px solid #f59e0b !important;">
                            <div class="d-flex align-items-center gap-2">
                                <i class="mdi mdi-alert-decagram text-warning fs-4"></i>
                                <div>
                                    <span class="fw-bold text-dark d-block" style="font-size: 13px;">Pemberitahuan Dokumen & Capaian Legalitas:</span>
                                    <small class="text-muted" style="font-size: 12px;">
                                        Terdapat <strong><?php echo e($landsWithPendingDocsCount); ?> tanah</strong> dengan dokumen baru yang menunggu verifikasi Kepala Legal.
                                    </small>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Pure Clean Table: Daftar Pra Tanah -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle table-lahan mb-0">
                            <thead>
                                <tr>
                                    <th class="col-no text-center">No</th>
                                    <th>Nama Tanah & Alas Hak</th>
                                    <th>Makelar / Pemilik</th>
                                    <th>Harga Penawaran / Deal</th>
                                    <th style="width: 150px;">Progress 3 Fase</th>
                                    <th style="min-width: 170px;">Progress Legalitas</th>
                                    <th class="col-status text-center">Status</th>
                                    <th class="text-center" style="width: 90px;">Prioritas</th>
                                    <th class="col-aksi text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                <?php $__empty_1 = true; $__currentLoopData = $praLandBank; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $land): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <?php
                                        $priorityClass = match (strtolower($land->priority ?? 'normal')) {
                                            'urgent' => 'badge-priority-urgent',
                                            'high', 'tinggi' => 'badge-priority-high',
                                            'normal', 'sedang' => 'badge-priority-normal',
                                            'low', 'rendah' => 'badge-priority-low',
                                            default => 'badge-priority-normal',
                                        };

                                        $isTerminActive = $land->payment_method == 'termin' && $land->payments->where('status', 'belum')->count() > 0;
                                        if ($isTerminActive) {
                                            $paidCount = $land->payments->where('status', 'lunas')->count();
                                            $totalPayments = $land->payments->count();
                                            $percent = $totalPayments > 0 ? round(($paidCount / $totalPayments) * 100) : 0;
                                            $fase = 3;
                                        }

                                        switch ($isTerminActive ? 'termin_active_bypass' : $land->status) {
                                            case 'termin_active_bypass':
                                                break;
                                            case 'fase1':
                                                $fase = 1;
                                                $percent = 33;
                                                break;
                                            case 'fase2':
                                                $fase = 2;
                                                $percent = 67;
                                                break;
                                            case 'fase3':
                                            case 'fase4':
                                            case 'approved':
                                                $fase = 3;
                                                $percent = 100;
                                                break;
                                            case 'rejected':
                                                $fase = 0;
                                                $percent = 0;
                                                break;
                                            case 'pending':
                                                if (!empty($land->notaris_id) || !empty($land->file_ijb) || $land->status === 'fase3') {
                                                    $fase = 3;
                                                    $percent = 100;
                                                } elseif (!empty($land->survey_date) || !empty($land->survey_by) || $land->status === 'fase2') {
                                                    $fase = 2;
                                                    $percent = 67;
                                                } else {
                                                    $fase = 1;
                                                    $percent = 33;
                                                }
                                                break;
                                            default:
                                                $fase = 1;
                                                $percent = 33;
                                        }

                                        // Warna bar fase
                                        if ($land->status == 'approved' || $percent == 100) {
                                            $faseColor = '#10b981';
                                        } elseif ($land->status == 'rejected') {
                                            $faseColor = '#ef4444';
                                        } elseif ($percent >= 60) {
                                            $faseColor = '#0284c7';
                                        } else {
                                            $faseColor = '#7c3aed';
                                        }

                                        // Legalitas Check
                                        $rawStatus = strtoupper($land->ownership_status ?? 'SHM');
                                        if (str_contains($rawStatus, 'APHB')) {
                                            $cat = 'APHB';
                                        } elseif (str_contains($rawStatus, 'WARIS')) {
                                            $cat = 'WARISAN';
                                        } elseif (str_contains($rawStatus, 'PETOK') || str_contains($rawStatus, 'GIRIK') || str_contains($rawStatus, 'LETTER')) {
                                            $cat = 'PETOK_C';
                                        } elseif (str_contains($rawStatus, 'AJB') || str_contains($rawStatus, 'HIBAH')) {
                                            $cat = 'AJB';
                                        } else {
                                            $cat = 'SHM';
                                        }

                                        $catDocTypeIds = $documentTypes->filter(function($dt) use ($cat) {
                                            $c = $dt->applicable_categories ?? [];
                                            return empty($c) || in_array($cat, $c);
                                        })->pluck('id')->toArray();

                                        $totalRequired = count($catDocTypeIds);
                                        $docs = $land->documents->whereIn('document_type_id', $catDocTypeIds);
                                        $verifiedDocs = $docs->where('status', 'verified')->count();
                                        $rejectedDocs = $docs->where('status', 'rejected')->count();
                                        $processDocs = $docs->where('document_status', 'proses');
                                        $unverifiedOrMissing = max(0, $totalRequired - $verifiedDocs);
                                        $legalPercent = $totalRequired > 0 ? round(($verifiedDocs / $totalRequired) * 100) : 0;
                                        $isLandLegalSah = ($totalRequired > 0) && ($verifiedDocs === $totalRequired);
                                        $isFase2Done = !empty($land->survey_date) && !empty($land->survey_by);
                                        $canAccessFase2 = $isLandLegalSah || $land->status === 'approved' || $land->status === 'rejected';
                                        $canAccessFase3 = ($isLandLegalSah && $isFase2Done) || $land->status === 'approved' || $land->status === 'rejected' || $isTerminActive;
                                    ?>

                                    <tr class="pra-table-row" id="row-<?php echo e($land->id); ?>"
                                        data-search="<?php echo e(strtolower($land->land_name . ' ' . ($land->land_owner ?? '') . ' ' . ($land->ownership_status ?? '') . ' ' . $land->status)); ?>">
                                        
                                        <td class="col-no fw-bold text-center">
                                            <?php echo e($praLandBank->firstItem() + $index); ?>

                                        </td>

                                        <td>
                                            <div class="fw-bold text-dark" style="font-size: 0.88rem; line-height: 1.3;">
                                                <i class="mdi mdi-map-marker text-primary me-0.5"></i><?php echo e($land->land_name); ?>

                                            </div>
                                            <?php if(!empty($land->ownership_status)): ?>
                                                <span class="badge py-0.5 px-2 mt-1" 
                                                    style="background-color: #f3e8ff; color: #7e22ce; font-size: 0.73rem; font-weight: 700; border-radius: 4px; border: 1px solid #e9d5ff;">
                                                    <?php echo e($land->ownership_status); ?>

                                                </span>
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <span class="text-dark fw-semibold" style="font-size: 0.83rem;">
                                                <i class="mdi mdi-account-tie me-1 text-secondary"></i><?php echo e($land->land_owner ?? '-'); ?>

                                            </span>
                                        </td>

                                        <td>
                                            <span class="badge bg-light text-dark px-2 py-1 border font-monospace fw-bold" style="font-size: 0.78rem;">
                                                Rp <?php echo e(number_format($land->deal_price ?: ($land->estimated_price ?? 0), 0, ',', '.')); ?>

                                            </span>
                                        </td>

                                        <td>
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <span class="fw-bold" style="font-size: 0.74rem; color: #334155;">
                                                    <?php if($land->status == 'rejected'): ?>
                                                        <span class="text-danger">REJECTED</span>
                                                    <?php elseif($isTerminActive): ?>
                                                        <span class="text-warning">CICILAN (<?php echo e($paidCount); ?>/<?php echo e($totalPayments); ?>)</span>
                                                    <?php elseif($land->status == 'approved'): ?>
                                                        <span class="text-success">APPROVED</span>
                                                    <?php else: ?>
                                                        FASE <?php echo e($fase); ?>/3
                                                    <?php endif; ?>
                                                </span>
                                                <span class="fw-bold" style="font-size: 0.74rem; color: #334155;"><?php echo e($percent); ?>%</span>
                                            </div>
                                            <div class="progress" style="height: 6px; background-color: #e2e8f0; border-radius: 9999px;">
                                                <div class="progress-bar rounded-pill" role="progressbar" style="width: <?php echo e($percent); ?>%; background-color: <?php echo e($faseColor); ?>;"></div>
                                            </div>
                                        </td>

                                        <td>
                                            <?php if($totalRequired == 0): ?>
                                                <span class="badge bg-light text-muted border py-1 px-2" style="font-size: 10px;">
                                                    Belum Ada Berkas
                                                </span>
                                            <?php else: ?>
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <?php if($verifiedDocs == $totalRequired): ?>
                                                        <span class="fw-bold text-success" style="font-size: 10.5px;">
                                                            <i class="mdi mdi-shield-check me-0.5"></i>100% Sah
                                                        </span>
                                                    <?php elseif($rejectedDocs > 0): ?>
                                                        <span class="fw-bold text-danger" style="font-size: 10.5px;">
                                                            <i class="mdi mdi-alert-circle me-0.5"></i>Perlu Revisi
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="fw-bold" style="font-size: 10.5px; color: #b45309;">
                                                            <?php echo e($verifiedDocs); ?>/<?php echo e($totalRequired); ?> Sah
                                                        </span>
                                                    <?php endif; ?>
                                                    <span class="fw-bold" style="font-size: 10.5px; color: #334155;"><?php echo e($legalPercent); ?>%</span>
                                                </div>
                                                <div class="progress" style="height: 6px; background-color: #e2e8f0; border-radius: 9999px;">
                                                    <div class="progress-bar rounded-pill" role="progressbar" style="width: <?php echo e($legalPercent); ?>%; background-color: <?php echo e($verifiedDocs == $totalRequired ? '#10b981' : ($rejectedDocs > 0 ? '#ef4444' : '#f59e0b')); ?>;"></div>
                                                </div>

                                                <?php if($processDocs->isNotEmpty()): ?>
                                                    <div class="mt-1.5 d-flex flex-column gap-1">
                                                        <?php $__currentLoopData = $processDocs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pDoc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="process-doc-pill d-flex align-items-center justify-content-between p-1 px-1.5 rounded-2" style="font-size: 9.5px;">
                                                                <div class="d-flex align-items-center gap-1 text-truncate">
                                                                    <i class="mdi mdi-progress-clock text-warning"></i>
                                                                    <span class="fw-bold text-dark text-truncate" style="max-width: 75px;"><?php echo e($pDoc->documentType->name ?? 'Dokumen'); ?></span>
                                                                </div>
                                                                <button type="button" class="btn-upload-doc-pill d-inline-flex align-items-center gap-0.5" onclick="openUploadDocModal(<?php echo e($pDoc->id); ?>, '<?php echo e(addslashes($pDoc->documentType->name ?? 'Dokumen')); ?>', '<?php echo e(addslashes($land->land_name)); ?>', '<?php echo e($pDoc->document_number ?? ''); ?>')">
                                                                    <i class="mdi mdi-cloud-upload"></i>
                                                                    <span>Upload</span>
                                                                </button>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </td>

                                        <td class="col-status text-center">
                                            <?php if($isTerminActive): ?>
                                                <span class="badge py-1 px-2.5 fw-semibold" style="font-size: 0.74rem; border-radius: 6px; background-color: #fffbeb; color: #b45309; border: 1px solid #fde68a;">
                                                    Cicilan Aktif
                                                </span>
                                            <?php elseif($land->status == 'approved'): ?>
                                                <span class="badge py-1 px-2.5 fw-semibold" style="font-size: 0.74rem; border-radius: 6px; background-color: #ecfdf5; color: #059669; border: 1px solid #a7f3d0;">
                                                    Approved
                                                </span>
                                            <?php elseif($land->status == 'rejected'): ?>
                                                <span class="badge py-1 px-2.5 fw-semibold" style="font-size: 0.74rem; border-radius: 6px; background-color: #fef2f2; color: #dc2626; border: 1px solid #fecaca;">
                                                    Rejected
                                                </span>
                                            <?php else: ?>
                                                <span class="badge py-1 px-2.5 fw-semibold" style="font-size: 0.74rem; border-radius: 6px; background-color: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe;">
                                                    <?php echo e(ucfirst($land->status)); ?>

                                                </span>
                                            <?php endif; ?>
                                        </td>

                                        <td class="text-center">
                                            <span class="badge-priority <?php echo e($priorityClass); ?>">
                                                <?php echo e(ucfirst($land->priority ?? 'Normal')); ?>

                                            </span>
                                        </td>

                                        <td class="col-aksi text-center">
                                            <div class="d-inline-flex align-items-center gap-1">
                                                <!-- Fase 1 -->
                                                <a href="<?php echo e(route('pra-landbank.proses', ['id' => $land->id, 'step' => 1])); ?>" 
                                                    class="btn-fase-action btn-fase-1" title="FASE 1: Dokumen Legalitas">
                                                    <i class="mdi mdi-file-document-check"></i>
                                                    <span>Fase 1</span>
                                                </a>

                                                <!-- Fase 2 -->
                                                <?php if($canAccessFase2): ?>
                                                    <a href="<?php echo e(route('pra-landbank.proses', ['id' => $land->id, 'step' => 2])); ?>" 
                                                        class="btn-fase-action btn-fase-2" title="FASE 2: Survey & Teknis">
                                                        <i class="mdi mdi-map-search"></i>
                                                        <span>Fase 2</span>
                                                    </a>
                                                <?php else: ?>
                                                    <button type="button" class="btn-fase-action btn-fase-2" 
                                                        onclick="alertFase2Locked(<?php echo e($land->id); ?>)" 
                                                        style="opacity: 0.75;" title="Terkunci: Menunggu Validasi Legalitas Fase 1">
                                                        <i class="mdi mdi-lock"></i>
                                                        <span>Fase 2</span>
                                                    </button>
                                                <?php endif; ?>

                                                <!-- Fase 3 / Cicilan -->
                                                <?php if($canAccessFase3): ?>
                                                    <a href="<?php echo e(route('pra-landbank.proses', ['id' => $land->id, 'step' => 3])); ?>" 
                                                        class="btn-fase-action btn-fase-3" title="<?php echo e($isTerminActive ? 'Kelola Pembayaran Cicilan' : 'FASE 3: Sidang & Deal'); ?>">
                                                        <i class="mdi <?php echo e($isTerminActive ? 'mdi-cash-check' : 'mdi-check-decagram'); ?>"></i>
                                                        <span><?php echo e($isTerminActive ? 'Cicilan' : 'Fase 3'); ?></span>
                                                    </a>
                                                <?php else: ?>
                                                    <button type="button" class="btn-fase-action btn-fase-3" 
                                                        onclick="alertFase3Locked(<?php echo e($land->id); ?>, <?php echo e($isLandLegalSah ? 'true' : 'false'); ?>, <?php echo e($isFase2Done ? 'true' : 'false'); ?>)" 
                                                        style="opacity: 0.75;" title="Terkunci">
                                                        <i class="mdi mdi-lock"></i>
                                                        <span>Fase 3</span>
                                                    </button>
                                                <?php endif; ?>

                                                <!-- Delete Button -->
                                                <?php if(!$isKeuangan || $isAdmin): ?>
                                                    <form action="<?php echo e(route('pra-landbanks.destroy', $land->id)); ?>" method="POST" class="d-inline delete-form">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="button" class="btn-fase-action btn-fase-delete delete-btn" title="Hapus Data">
                                                            <i class="mdi mdi-trash-can-outline"></i>
                                                        </button>
                                                    </form>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="9" class="text-center text-muted py-4">
                                            <i class="mdi mdi-alert-circle-outline me-2" style="font-size: 1.5rem;"></i>
                                            Tidak ada data pra tanah yang terdaftar.
                                        </td>
                                    </tr>
                                <?php endif; ?>

                                <tr id="noResultsRow" style="display: none;">
                                    <td colspan="9" class="text-center text-muted py-4">
                                        <i class="mdi mdi-magnify-close me-2" style="font-size: 1.5rem;"></i>
                                        Tidak ada data yang cocok dengan pencarian.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Footer (Bootstrap 5) -->
                    <?php if($praLandBank->hasPages()): ?>
                        <div class="px-3 py-3 border-top d-flex flex-wrap justify-content-between align-items-center bg-white">
                            <div class="text-muted" style="font-size: 0.82rem;">
                                Menampilkan <span class="fw-semibold text-dark"><?php echo e($praLandBank->firstItem() ?? 0); ?></span> - <span class="fw-semibold text-dark"><?php echo e($praLandBank->lastItem() ?? 0); ?></span> dari <span class="fw-semibold text-dark"><?php echo e($praLandBank->total()); ?></span> data pra tanah
                            </div>
                            <div>
                                <?php echo e($praLandBank->links('pagination::bootstrap-5')); ?>

                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>

</div>

<!-- MODAL QUICK UPDATE / UPLOAD BERKAS FISIK DOKUMEN SELESAI (STAFF LEGAL) -->
<div class="modal fade" id="modalUploadCompletedDoc" tabindex="-1" aria-labelledby="modalUploadCompletedDocLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
            <div class="modal-header border-0 p-4 pb-3" style="background: linear-gradient(135deg, #fcfaff, #f5efff);">
                <div class="d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center justify-content-center shadow-sm" style="width: 44px; height: 44px; border-radius: 12px; background: linear-gradient(135deg, #da8cff, #9a55ff); color: #ffffff;">
                        <i class="mdi mdi-file-check-outline" style="font-size: 1.4rem;"></i>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold text-dark mb-0" id="modalUploadCompletedDocLabel" style="font-size: 1.1rem;">Upload Berkas Fisik Jadi</h5>
                        <small class="text-muted" style="font-size: 0.8rem;">Perbarui status pengurusan dokumen yang telah terbit</small>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="formUploadCompletedDoc" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" id="uploadDocId" name="doc_id">

                <div class="modal-body p-4 pt-2">
                    <div class="p-3 mb-3 rounded-3" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="text-muted" style="font-size: 0.75rem;">JENIS DOKUMEN</span>
                            <span class="badge bg-primary text-white" style="font-size: 0.7rem;">TERBIT RESMI</span>
                        </div>
                        <div class="fw-bold text-dark" id="modalDocTypeName" style="font-size: 0.95rem;">-</div>
                        <div class="text-secondary mt-1" id="modalLandName" style="font-size: 0.8rem;">
                            <i class="mdi mdi-map-marker text-primary"></i> -
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label mb-1 text-dark fw-bold" style="font-size: 0.82rem;">
                            Nomor Dokumen / Sertifikat Final <span class="text-muted fw-normal">(Opsional)</span>
                        </label>
                        <input type="text" class="form-control" id="uploadDocNumber" name="document_number" placeholder="Contoh: 503/IMB/2026 atau No. SHM 12345" style="border-radius: 8px; font-size: 0.86rem; border-color: #e2e8f0;">
                    </div>

                    <div class="mb-3">
                        <label class="form-label mb-1 text-dark fw-bold" style="font-size: 0.82rem;">
                            Upload Berkas Fisik Dokumen <span class="text-danger">*</span>
                        </label>
                        <div class="pratanah-file-upload-modern">
                            <input type="file" id="uploadDocFile" name="file" accept=".pdf,.jpg,.jpeg,.png" required onchange="handleModalFileChange(this)">
                            <div class="pratanah-file-label-modern py-2 px-3">
                                <i class="mdi mdi-cloud-upload text-primary" style="font-size: 1.3rem;"></i>
                                <div class="pratanah-file-info-modern">
                                    <span class="file-label-text fw-bold text-primary" id="modalUploadFileLabelText" style="font-size: 0.82rem;">Pilih Berkas Dokumen Fisik</span>
                                    <small style="font-size: 0.72rem; color: #8c98a4;">Format PDF, JPG, PNG (Maks 20MB)</small>
                                </div>
                                <span class="pratanah-file-size d-none" id="modalUploadFileSize">0 KB</span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-1">
                        <label class="form-label mb-1 text-dark fw-bold" style="font-size: 0.82rem;">
                            Catatan Serah Terima / Keterangan
                        </label>
                        <textarea class="form-control" id="uploadDocNotes" name="process_notes" rows="2" placeholder="Contoh: Berkas asli fisik telah diterima dan disimpan di brankas legal." style="border-radius: 8px; font-size: 0.85rem; border-color: #e2e8f0;"></textarea>
                    </div>
                </div>

                <div class="modal-footer border-0 p-4 pt-0 d-flex justify-content-end gap-2" style="background: transparent;">
                    <button type="button" class="btn btn-light px-3 py-1.5 rounded-pill fw-semibold text-muted" data-bs-dismiss="modal" style="font-size: 0.84rem; border: 1px solid #e2e8f0;">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-gradient-primary px-4 py-2 rounded-pill shadow-sm fw-bold" id="btnSubmitUploadDoc" style="font-size: 0.84rem;">
                        Simpan & Lengkapi Dokumen
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function applyLiveSearch(keyword) {
            keyword = (keyword || '').toLowerCase().trim();
            const rows = document.querySelectorAll('.pra-table-row');
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

        document.addEventListener('DOMContentLoaded', function() {
            const pendingMsg = sessionStorage.getItem('success_message');
            if (pendingMsg) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: pendingMsg,
                    timer: 2000,
                    showConfirmButton: false
                });
                sessionStorage.removeItem('success_message');
            }

            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const form = this.closest('form');
                    const url = form.getAttribute('action');
                    const token = form.querySelector('input[name="_token"]').value;
                    
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Data Pra Land Bank yang dihapus tidak dapat dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#dc3545',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: 'Menghapus...',
                                text: 'Mohon tunggu sebentar',
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });

                            fetch(url, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': token
                                },
                                body: JSON.stringify({
                                    _method: 'DELETE'
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    sessionStorage.setItem('success_message', data.message || 'Data berhasil dihapus');
                                    location.reload();
                                } else {
                                    Swal.fire('Gagal', data.message || 'Gagal menghapus data', 'error');
                                }
                            })
                            .catch(err => {
                                Swal.fire('Error', 'Terjadi kesalahan sistem saat menghapus data', 'error');
                            });
                        }
                    });
                });
            });
        });

        function alertFase2Locked(landId = null) {
            Swal.fire({
                icon: 'warning',
                title: 'Fase 2 Terkunci!',
                html: `
                    <p class="text-muted mb-3" style="font-size: 0.92rem;">
                        Tahap <b>Fase 2 (Survey Kelayakan Teknis & Spasial)</b> belum dapat dibuka untuk lahan ini.
                    </p>
                    <div class="p-3 rounded-3 text-start mb-2" style="background: #fffbeb; border: 1.5px solid #fde68a;">
                        <div class="d-flex align-items-center gap-2 mb-2 text-warning fw-bold" style="font-size: 0.85rem;">
                            <i class="mdi mdi-shield-alert" style="font-size: 1.1rem;"></i>
                            <span>Syarat Pembukaan Akses Fase 2:</span>
                        </div>
                        <ul class="mb-0 ps-3 text-secondary" style="font-size: 0.82rem; line-height: 1.6;">
                            <li>Berkas dokumen legalitas di <b>Fase 1</b> wajib diunggah lengkap.</li>
                            <li>Seluruh dokumen wajib telah <b>Divalidasi Sah</b> oleh Kepala Legal.</li>
                        </ul>
                    </div>
                `,
                showCancelButton: !!landId,
                confirmButtonColor: '#7e22ce',
                confirmButtonText: landId ? '<i class="mdi mdi-arrow-right-circle me-1"></i> Buka Fase 1' : '<i class="mdi mdi-check me-1"></i> Mengerti',
                cancelButtonColor: '#6c757d',
                cancelButtonText: 'Tutup'
            }).then((result) => {
                if (result.isConfirmed && landId) {
                    window.location.href = "<?php echo e(url('/properti/pra-landbank/proses')); ?>/" + landId + "?step=1";
                }
            });
        }

        function alertFase3Locked(landId = null, isLegalSah = false, isFase2Done = false) {
            let infoHtml = '';
            let btnText = '<i class="mdi mdi-check me-1"></i> Mengerti';
            let targetStep = 1;

            if (!isLegalSah) {
                targetStep = 1;
                btnText = '<i class="mdi mdi-arrow-right-circle me-1"></i> Buka Fase 1';
                infoHtml = `
                    <p class="text-muted mb-3" style="font-size: 0.92rem;">
                        Tahap <b>Fase 3 (Sidang Keputusan Akhir)</b> belum dapat dibuka untuk lahan ini.
                    </p>
                    <div class="p-3 rounded-3 text-start mb-2" style="background: #fffbeb; border: 1.5px solid #fde68a;">
                        <div class="d-flex align-items-center gap-2 mb-2 text-warning fw-bold" style="font-size: 0.85rem;">
                            <i class="mdi mdi-shield-alert" style="font-size: 1.1rem;"></i>
                            <span>Syarat Pembukaan Akses Fase 3:</span>
                        </div>
                        <ul class="mb-0 ps-3 text-secondary" style="font-size: 0.82rem; line-height: 1.6;">
                            <li class="fw-semibold text-danger">Dokumen legalitas di <b>Fase 1</b> wajib diunggah dan <b>Divalidasi Sah</b> oleh Kepala Legal terlebih dahulu.</li>
                            <li>Hasil survey fisik, zonasi & titik spasial di <b>Fase 2</b> wajib diselesaikan.</li>
                        </ul>
                    </div>
                `;
            } else if (!isFase2Done) {
                targetStep = 2;
                btnText = '<i class="mdi mdi-arrow-right-circle me-1"></i> Selesaikan Fase 2';
                infoHtml = `
                    <p class="text-muted mb-3" style="font-size: 0.92rem;">
                        Tahap <b>Fase 3 (Sidang Keputusan Akhir)</b> belum dapat dibuka karena tahap <b>Fase 2</b> belum diselesaikan.
                    </p>
                    <div class="p-3 rounded-3 text-start mb-2" style="background: #fffbeb; border: 1.5px solid #fde68a;">
                        <div class="d-flex align-items-center gap-2 mb-2 text-warning fw-bold" style="font-size: 0.85rem;">
                            <i class="mdi mdi-alert-circle-outline" style="font-size: 1.1rem;"></i>
                            <span>Harap Selesaikan Fase 2 Terlebih Dahulu:</span>
                        </div>
                        <ul class="mb-0 ps-3 text-secondary" style="font-size: 0.82rem; line-height: 1.6;">
                            <li class="text-success"><i class="mdi mdi-check-circle me-1"></i>Dokumen legalitas di <b>Fase 1</b> telah Divalidasi Sah.</li>
                            <li class="fw-semibold text-danger"><i class="mdi mdi-close-circle me-1"></i>Data survey kelayakan fisik & spasial map di <b>Fase 2</b> belum diisi / disimpan.</li>
                        </ul>
                    </div>
                `;
            } else {
                infoHtml = `
                    <p class="text-muted mb-3" style="font-size: 0.92rem;">
                        Tahap <b>Fase 3 (Sidang Keputusan Akhir)</b> belum dapat dibuka untuk lahan ini.
                    </p>
                `;
            }

            Swal.fire({
                icon: 'warning',
                title: 'Fase 3 Terkunci!',
                html: infoHtml,
                showCancelButton: !!landId,
                confirmButtonColor: '#059669',
                confirmButtonText: landId ? btnText : '<i class="mdi mdi-check me-1"></i> Mengerti',
                cancelButtonColor: '#6c757d',
                cancelButtonText: 'Tutup'
            }).then((result) => {
                if (result.isConfirmed && landId) {
                    window.location.href = "<?php echo e(url('/properti/pra-landbank/proses')); ?>/" + landId + "?step=" + targetStep;
                }
            });
        }

        function openUploadDocModal(docId, docName, landName, docNumber = '') {
            document.getElementById('uploadDocId').value = docId;
            document.getElementById('modalDocTypeName').innerText = docName;
            document.getElementById('modalLandName').innerHTML = '<i class="mdi mdi-map-marker text-primary"></i> ' + landName;
            document.getElementById('uploadDocNumber').value = docNumber;
            document.getElementById('uploadDocFile').value = '';
            document.getElementById('modalUploadFileLabelText').innerText = 'Pilih Berkas Dokumen Fisik';
            document.getElementById('modalUploadFileSize').classList.add('d-none');
            document.getElementById('uploadDocNotes').value = '';
            document.getElementById('formUploadCompletedDoc').action = "<?php echo e(url('/pra-landbank/dokumen')); ?>/" + docId + "/upload-completed";

            const modal = new bootstrap.Modal(document.getElementById('modalUploadCompletedDoc'));
            modal.show();
        }

        function handleModalFileChange(input) {
            if (input.files && input.files[0]) {
                const file = input.files[0];
                document.getElementById('modalUploadFileLabelText').innerText = file.name;
                const sizeKb = Math.round(file.size / 1024);
                const sizeText = sizeKb > 1024 ? (sizeKb / 1024).toFixed(1) + ' MB' : sizeKb + ' KB';
                const sizeBadge = document.getElementById('modalUploadFileSize');
                sizeBadge.innerText = sizeText;
                sizeBadge.classList.remove('d-none');
            }
        }
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.partial.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Property-Management-Web-App\resources\views/land_bank/all_pra_land_bank.blade.php ENDPATH**/ ?>