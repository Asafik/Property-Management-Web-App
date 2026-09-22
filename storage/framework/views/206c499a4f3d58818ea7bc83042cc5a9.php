<?php $__env->startSection('title', 'Semua Properti Proyek'); ?>

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
        .table-lahan .col-dokumen {
            width: 75px;
            text-align: center;
            white-space: nowrap !important;
        }
        .table-lahan .col-aksi {
            width: 90px;
            text-align: center;
            white-space: nowrap !important;
        }

        /* Compact Table Card persis Perizinan */
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

        /* Category badge */
        .badge-category {
            display: inline-flex;
            align-items: center;
            padding: 0.3rem 0.65rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            background: rgba(154, 85, 255, 0.1);
            color: #9a55ff;
            border: 1px solid rgba(154, 85, 255, 0.2);
            text-transform: capitalize;
        }

        .btn-modal-continue-dev {
            background: #fff8eb !important;
            color: #b45309 !important;
            border: 1.5px solid #fde68a !important;
            box-shadow: 0 2px 6px rgba(245, 158, 11, 0.12) !important;
            transition: all 0.2s ease !important;
            font-weight: 700 !important;
            text-decoration: none !important;
        }
        .btn-modal-continue-dev:hover {
            background: #fef3c7 !important;
            color: #92400e !important;
            border-color: #f59e0b !important;
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.22) !important;
            transform: translateY(-1px);
        }
        .btn-modal-cancel {
            background: #f8fafc !important;
            color: #475569 !important;
            border: 1.5px solid #cbd5e1 !important;
            transition: all 0.2s ease !important;
            font-weight: 600 !important;
        }
        .btn-modal-cancel:hover {
            background: #e2e8f0 !important;
            color: #1e293b !important;
            border-color: #94a3b8 !important;
        }

        .sort-th {
            cursor: pointer;
            user-select: none;
        }
        .sort-th:hover {
            background: #f1f5f9 !important;
        }
        .hover-primary:hover {
            color: #9a55ff !important;
        }
        .nav-tabs .nav-link {
            color: #64748b;
            font-size: 0.85rem;
            border-bottom: 2px solid transparent !important;
            transition: all 0.2s ease;
        }
        .nav-tabs .nav-link:hover {
            color: #9a55ff;
        }
        .nav-tabs .nav-link.active {
            color: #9a55ff !important;
            border-bottom: 2px solid #9a55ff !important;
            background: transparent !important;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <?php
        if (!function_exists('sortIcon')) {
            function sortIcon($column)
            {
                if (request('sort_by') !== $column) {
                    return 'mdi-swap-vertical text-muted';
                }
                return request('sort_order', 'asc') === 'desc'
                    ? 'mdi-arrow-down text-primary fw-bold'
                    : 'mdi-arrow-up text-primary fw-bold';
            }
        }
    ?>

    <div class="container-fluid px-2 px-md-4 py-3">

        <!-- Page Title & Subtitle (Persis Perizinan) -->
        <div class="row align-items-center mb-4">
            <div class="col">
                <h2 class="text-dark mb-1 fw-bold" style="font-size: 1.55rem; letter-spacing: -0.02em;">
                    Tanah Pasca Land Bank
                </h2>
                <p class="text-muted mb-0" style="font-size: 0.88rem;">
                    Daftar seluruh properti proyek yang terdaftar dalam sistem
                </p>
            </div>
        </div>

        <!-- 4 KPI Metrics Card Grid (Persis Perizinan / Pra Tanah) -->
        <div class="dash-kpi-grid mb-4">
            
            <!-- Card 1: Total Properti Pasca (Ungu) -->
            <div class="dash-kpi-card">
                <div class="dash-kpi-left">
                    <div class="dash-kpi-icon purple">
                        <i class="mdi mdi-office-building"></i>
                    </div>
                    <div class="dash-kpi-info">
                        <div class="dash-kpi-label">Total Properti Pasca</div>
                        <div class="dash-kpi-val"><?php echo e($totalLandBank ?? $landBanks->total()); ?></div>
                        <div class="dash-kpi-sub">Seluruh Properti Terdaftar</div>
                    </div>
                </div>
                <div class="dash-kpi-action purple">
                    <i class="mdi mdi-arrow-right"></i>
                </div>
            </div>

            <!-- Card 2: Legalitas Terverifikasi (Hijau) -->
            <div class="dash-kpi-card">
                <div class="dash-kpi-left">
                    <div class="dash-kpi-icon green">
                        <i class="mdi mdi-check-decagram-outline"></i>
                    </div>
                    <div class="dash-kpi-info">
                        <div class="dash-kpi-label">Legalitas Terverifikasi</div>
                        <div class="dash-kpi-val"><?php echo e($legalVerified ?? 0); ?></div>
                        <div class="dash-kpi-sub">Dokumen Sah & Lengkap</div>
                    </div>
                </div>
                <div class="dash-kpi-action green">
                    <i class="mdi mdi-arrow-right"></i>
                </div>
            </div>

            <!-- Card 3: Pembangunan Selesai (Biru) -->
            <div class="dash-kpi-card">
                <div class="dash-kpi-left">
                    <div class="dash-kpi-icon blue">
                        <i class="mdi mdi-progress-check"></i>
                    </div>
                    <div class="dash-kpi-info">
                        <div class="dash-kpi-label">Pembangunan Selesai</div>
                        <div class="dash-kpi-val"><?php echo e($devSelesai ?? 0); ?></div>
                        <div class="dash-kpi-sub">Fisik 100% Rampung</div>
                    </div>
                </div>
                <div class="dash-kpi-action blue">
                    <i class="mdi mdi-arrow-right"></i>
                </div>
            </div>

            <!-- Card 4: Dalam Pengerjaan (Kuning / Amber) -->
            <div class="dash-kpi-card">
                <div class="dash-kpi-left">
                    <div class="dash-kpi-icon amber">
                        <i class="mdi mdi-progress-wrench"></i>
                    </div>
                    <div class="dash-kpi-info">
                        <div class="dash-kpi-label">Dalam Pengerjaan</div>
                        <div class="dash-kpi-val"><?php echo e($devProses ?? 0); ?></div>
                        <div class="dash-kpi-sub">Proses Infrastruktur Lahan</div>
                    </div>
                </div>
                <div class="dash-kpi-action amber">
                    <i class="mdi mdi-arrow-right"></i>
                </div>
            </div>

        </div>

        <!-- Main Container: Table Card -->
        <div class="row">
            <div class="col-12">
                <div class="card compact-table-card shadow-sm border-0">
                    
                    <!-- Card Header -->
                    <div class="card-header bg-white d-flex flex-wrap justify-content-between align-items-center gap-2 py-3 border-bottom">
                        <div>
                            <h5 class="card-title mb-0" style="font-weight: 700; color: #1e293b; font-size: 1.05rem;">
                                <i class="mdi mdi-office-building-marker-outline me-2" style="color: #9a55ff;"></i>Daftar Tanah Pasca Land Bank
                            </h5>
                        </div>
                        <a href="<?php echo e(route('properti')); ?>" class="btn btn-sm btn-gradient-primary d-inline-flex align-items-center gap-1.5 px-3 py-2 shadow-sm fw-semibold" style="border-radius: 6px; font-size: 0.84rem;">
                            <i class="mdi mdi-plus"></i> Tambah Pasca Landbank
                        </a>
                    </div>

                    <div class="card-body p-0">
                        
                        <!-- Search & Filter Toolbar -->
                        <div class="card-toolbar-box p-3 border-bottom bg-white">
                            <form id="filterForm" method="GET" action="<?php echo e(route('properti-all')); ?>">
                                <input type="hidden" name="sort_by" id="sort_by" value="<?php echo e(request('sort_by')); ?>">
                                <input type="hidden" name="sort_order" id="sort_order" value="<?php echo e(request('sort_order', 'asc')); ?>">

                                <!-- DESKTOP VERSION -->
                                <div class="d-none d-md-block">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 w-100">
                                        <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1">
                                            <!-- Search Input -->
                                            <div style="min-width: 180px; max-width: 240px; flex: 1;">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="search" id="liveSearchInput"
                                                        placeholder="Nama Properti..." value="<?php echo e(request('search')); ?>"
                                                        onkeyup="applyLiveSearch(this.value)"
                                                        style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none; height: 38px;">
                                                    <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                        type="submit" title="Cari"
                                                        style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                        <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Perusahaan -->
                                            <div style="min-width: 170px;">
                                                <select name="company_profile_id" id="filterCompany" class="form-control select2" onchange="document.getElementById('filterForm').submit()" style="width: 100%;">
                                                    <option value="">Semua Perusahaan</option>
                                                    <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($company->id); ?>"
                                                            <?php echo e(request('company_profile_id') == $company->id ? 'selected' : ''); ?>>
                                                            <?php echo e($company->name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>

                                            <!-- Legalitas -->
                                            <div style="min-width: 165px;">
                                                <select name="legalitas" class="form-select" onchange="document.getElementById('filterForm').submit()" style="height: 38px; font-size: 0.84rem;">
                                                    <option value="">Semua Legalitas</option>
                                                    <option value="verified" <?php echo e(request('legalitas') == 'verified' ? 'selected' : ''); ?>>Terverifikasi</option>
                                                    <option value="pending" <?php echo e(request('legalitas') == 'pending' ? 'selected' : ''); ?>>Pending</option>
                                                    <option value="rejected" <?php echo e(request('legalitas') == 'rejected' ? 'selected' : ''); ?>>Rejected</option>
                                                </select>
                                            </div>

                                            <!-- Pembangunan -->
                                            <div style="min-width: 150px;">
                                                <select name="pembangunan" class="form-select" onchange="document.getElementById('filterForm').submit()" style="height: 38px; font-size: 0.84rem;">
                                                    <option value="">Semua Status</option>
                                                    <option value="Selesai" <?php echo e(request('pembangunan') == 'Selesai' ? 'selected' : ''); ?>>Selesai</option>
                                                    <option value="progress" <?php echo e(request('pembangunan') == 'progress' ? 'selected' : ''); ?>>Progress</option>
                                                    <option value="Belum" <?php echo e(request('pembangunan') == 'Belum' ? 'selected' : ''); ?>>Belum</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Right: Limit + Action Buttons -->
                                        <div class="d-flex align-items-center gap-2 ms-auto">
                                            <div style="width: 85px;">
                                                <select name="show" id="showSelect" class="form-select" onchange="document.getElementById('filterForm').submit()" style="height: 38px;">
                                                    <option value="10" <?php echo e(request('show', 10) == 10 ? 'selected' : ''); ?>>10</option>
                                                    <option value="25" <?php echo e(request('show', 10) == 25 ? 'selected' : ''); ?>>25</option>
                                                    <option value="50" <?php echo e(request('show', 10) == 50 ? 'selected' : ''); ?>>50</option>
                                                    <option value="100" <?php echo e(request('show', 10) == 100 ? 'selected' : ''); ?>>100</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-gradient-primary d-inline-flex align-items-center justify-content-center" style="width: 38px; height: 38px; padding: 0;" title="Filter">
                                                <i class="mdi mdi-filter"></i>
                                            </button>
                                            <a href="<?php echo e(route('properti-all')); ?>" class="btn btn-gradient-secondary d-inline-flex align-items-center justify-content-center" style="width: 38px; height: 38px; padding: 0;" title="Reset">
                                                <i class="mdi mdi-refresh"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- MOBILE VERSION -->
                                <div class="d-block d-md-none">
                                    <div class="row g-2">
                                        <div class="col-12 mb-2">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="searchInputMobile" name="search"
                                                    placeholder="Nama Properti..." value="<?php echo e(request('search')); ?>"
                                                    onkeyup="applyLiveSearch(this.value)"
                                                    style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important; border-right: none; height: 38px;">
                                                <button class="btn btn-gradient-primary d-flex align-items-center justify-content-center px-3" 
                                                    type="submit" title="Cari"
                                                    style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important; border-top-right-radius: 4px !important; border-bottom-right-radius: 4px !important; height: 38px; box-shadow: none;">
                                                    <i class="mdi mdi-magnify" style="font-size: 1.15rem; color: #ffffff;"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <select name="company_profile_id" id="filterCompanyMobile" class="form-control select2" onchange="document.getElementById('filterForm').submit()" style="width: 100%;">
                                                <option value="">Semua Perusahaan</option>
                                                <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($company->id); ?>"
                                                        <?php echo e(request('company_profile_id') == $company->id ? 'selected' : ''); ?>>
                                                        <?php echo e($company->name); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <select name="legalitas" class="form-select" onchange="document.getElementById('filterForm').submit()" style="height: 38px;">
                                                <option value="">Semua Legalitas</option>
                                                <option value="verified" <?php echo e(request('legalitas') == 'verified' ? 'selected' : ''); ?>>Terverifikasi</option>
                                                <option value="pending" <?php echo e(request('legalitas') == 'pending' ? 'selected' : ''); ?>>Pending</option>
                                                <option value="rejected" <?php echo e(request('legalitas') == 'rejected' ? 'selected' : ''); ?>>Rejected</option>
                                            </select>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <select name="pembangunan" class="form-select" onchange="document.getElementById('filterForm').submit()" style="height: 38px;">
                                                <option value="">Semua Status</option>
                                                <option value="Selesai" <?php echo e(request('pembangunan') == 'Selesai' ? 'selected' : ''); ?>>Selesai</option>
                                                <option value="progress" <?php echo e(request('pembangunan') == 'progress' ? 'selected' : ''); ?>>Progress</option>
                                                <option value="Belum" <?php echo e(request('pembangunan') == 'Belum' ? 'selected' : ''); ?>>Belum</option>
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <select name="show" class="form-select" onchange="document.getElementById('filterForm').submit()" style="height: 38px;">
                                                <option value="10" <?php echo e(request('show', 10) == 10 ? 'selected' : ''); ?>>10</option>
                                                <option value="25" <?php echo e(request('show', 10) == 25 ? 'selected' : ''); ?>>25</option>
                                                <option value="50" <?php echo e(request('show', 10) == 50 ? 'selected' : ''); ?>>50</option>
                                                <option value="100" <?php echo e(request('show', 10) == 100 ? 'selected' : ''); ?>>100</option>
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <button type="submit" class="btn btn-gradient-primary w-100" style="height: 38px;" title="Filter">
                                                <i class="mdi mdi-filter"></i>
                                            </button>
                                        </div>
                                        <div class="col-4">
                                            <a href="<?php echo e(route('properti-all')); ?>" class="btn btn-gradient-secondary w-100 d-inline-flex align-items-center justify-content-center" style="height: 38px;" title="Reset">
                                                <i class="mdi mdi-refresh"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Table Responsive -->
                        <div class="table-responsive">
                            <table class="table table-lahan table-hover align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th class="col-no text-center">NO</th>
                                        <th class="sort-th" onclick="handleSort('name')">NAMA PROPERTI <i class="mdi <?php echo e(sortIcon('name')); ?>"></i></th>
                                        <th class="sort-th" onclick="handleSort('company_profile_id')">NAMA PERUSAHAAN <i class="mdi <?php echo e(sortIcon('company_profile_id')); ?>"></i></th>
                                        <th class="sort-th" onclick="handleSort('zoning')">KATEGORI <i class="mdi <?php echo e(sortIcon('zoning')); ?>"></i></th>
                                        <th class="d-none d-md-table-cell sort-th" onclick="handleSort('address')">LOKASI <i class="mdi <?php echo e(sortIcon('address')); ?>"></i></th>
                                        <th class="sort-th" onclick="handleSort('acquisition_price')">HARGA BELI <i class="mdi <?php echo e(sortIcon('acquisition_price')); ?>"></i></th>
                                        <th class="sort-th" onclick="handleSort('legal_status')">LEGALITAS <i class="mdi <?php echo e(sortIcon('legal_status')); ?>"></i></th>
                                        <th class="sort-th" onclick="handleSort('development_status')">PEMBANGUNAN <i class="mdi <?php echo e(sortIcon('development_status')); ?>"></i></th>
                                        <th class="text-center col-dokumen">DOKUMEN</th>
                                        <th class="text-center col-aksi">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $landBanks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <?php
                                            $searchKeywords = strtolower($item->name . ' ' . ($item->companyProfile->name ?? '') . ' ' . ($item->address ?? '') . ' ' . ($item->zoning ?? ''));
                                        ?>
                                        <tr class="project-table-row" data-search="<?php echo e($searchKeywords); ?>">
                                            <td class="col-no text-center fw-bold text-muted"><?php echo e($landBanks->firstItem() + $index); ?></td>
                                            <td>
                                                <a href="javascript:void(0)" 
                                                   class="fw-bold text-dark text-decoration-none hover-primary d-inline-block" 
                                                   data-bs-toggle="modal" 
                                                   data-bs-target="#modalDetail<?php echo e($item->id); ?>" 
                                                   title="Klik untuk melihat detail lengkap"
                                                   style="font-size: 0.88rem; transition: color 0.15s ease;">
                                                    <?php echo e($item->name); ?>

                                                </a>
                                                <small class="text-muted d-block d-md-none mt-1">
                                                    <?php echo e(Str::limit($item->address ?? '-', 15)); ?>

                                                </small>
                                            </td>
                                            <td>
                                                <div class="fw-semibold text-dark">
                                                    <?php echo e($item->companyProfile->name ?? '-'); ?>

                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge-category"><?php echo e($item->zoning ?? 'Tanah'); ?></span>
                                            </td>
                                            <td class="d-none d-md-table-cell">
                                                <span class="text-muted" title="<?php echo e($item->address ?? '-'); ?>">
                                                    <?php echo e(Str::limit($item->address ?? '-', 22)); ?>

                                                </span>
                                            </td>
                                            <td class="fw-bold text-success">
                                                Rp <?php echo e(number_format($item->grand_total_acquisition_price, 0, ',', '.')); ?>

                                            </td>
                                            <td>
                                                <?php
                                                    $docs = $item->merged_documents;
                                                    $totalDocs = $docs->count();
                                                    $verifiedDocs = $docs->where('status', 'verified')->count();
                                                    $rejectedDocs = $docs->where('status', 'rejected')->count();

                                                    if ($item->isFromPraLandbank() || $item->legal_status === 'verified') {
                                                        $legalPercent = 100;
                                                        $legalBarColor = 'background: linear-gradient(90deg, #10b981, #059669);';
                                                        $legalTextClass = 'text-success';
                                                        $legalIcon = 'mdi-check-circle';
                                                        $legalLabel = 'Terverifikasi';
                                                    } elseif ($totalDocs > 0) {
                                                        $legalPercent = round(($verifiedDocs / $totalDocs) * 100);
                                                        if ($legalPercent == 100) {
                                                            $legalBarColor = 'background: linear-gradient(90deg, #10b981, #059669);';
                                                            $legalTextClass = 'text-success';
                                                            $legalIcon = 'mdi-check-circle';
                                                            $legalLabel = 'Terverifikasi';
                                                        } elseif ($rejectedDocs > 0) {
                                                            $legalBarColor = 'background: linear-gradient(90deg, #ef4444, #dc2626);';
                                                            $legalTextClass = 'text-danger';
                                                            $legalIcon = 'mdi-alert-circle';
                                                            $legalLabel = 'Revisi';
                                                        } else {
                                                            $legalBarColor = 'background: linear-gradient(90deg, #f59e0b, #d97706);';
                                                            $legalTextClass = 'text-warning';
                                                            $legalIcon = 'mdi-clock-outline';
                                                            $legalLabel = 'Proses';
                                                        }
                                                    } else {
                                                        $legalPercent = 0;
                                                        $legalBarColor = 'background: #cbd5e1;';
                                                        $legalTextClass = 'text-muted';
                                                        $legalIcon = 'mdi-close-circle';
                                                        $legalLabel = 'Belum';
                                                    }
                                                ?>
                                                <div style="min-width: 110px;">
                                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                                        <small class="fw-bold <?php echo e($legalTextClass); ?>" style="font-size: 0.75rem;">
                                                            <i class="mdi <?php echo e($legalIcon); ?> me-0.5"></i> <?php echo e($legalLabel); ?>

                                                        </small>
                                                        <span class="fw-bold" style="font-size: 0.75rem; color: #374151;"><?php echo e($legalPercent); ?>%</span>
                                                    </div>
                                                    <div class="progress" style="height: 6px; background-color: #e5e7eb; border-radius: 4px; overflow: hidden;">
                                                        <div class="progress-bar" role="progressbar" style="width: <?php echo e($legalPercent); ?>%; <?php echo e($legalBarColor); ?> border-radius: 4px;" aria-valuenow="<?php echo e($legalPercent); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            <td>
                                                <?php
                                                    $devPercent = (float) $item->overall_infrastructure_progress;
                                                    if (in_array(strtolower($item->development_status), ['selesai', 'done'])) {
                                                        $devPercent = 100;
                                                    }
                                                    if ($devPercent >= 100) {
                                                        $devBarColor = 'background: linear-gradient(90deg, #10b981, #059669);';
                                                        $devTextClass = 'text-success';
                                                        $devIcon = 'mdi-check-circle';
                                                        $devLabel = 'Selesai';
                                                    } elseif ($devPercent > 0) {
                                                        $devBarColor = 'background: linear-gradient(90deg, #da8cff, #9a55ff);';
                                                        $devTextClass = 'text-primary';
                                                        $devIcon = 'mdi-progress-wrench';
                                                        $devLabel = 'Proses';
                                                    } else {
                                                        $devBarColor = 'background: #cbd5e1;';
                                                        $devTextClass = 'text-muted';
                                                        $devIcon = 'mdi-close-circle';
                                                        $devLabel = 'Belum';
                                                    }
                                                ?>
                                                <div style="min-width: 110px;">
                                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                                        <small class="fw-bold <?php echo e($devTextClass); ?>" style="font-size: 0.75rem;">
                                                            <i class="mdi <?php echo e($devIcon); ?> me-0.5"></i> <?php echo e($devLabel); ?>

                                                        </small>
                                                        <span class="fw-bold" style="font-size: 0.75rem; color: #374151;"><?php echo e($devPercent); ?>%</span>
                                                    </div>
                                                    <div class="progress" style="height: 6px; background-color: #e5e7eb; border-radius: 4px; overflow: hidden;">
                                                        <div class="progress-bar" role="progressbar" style="width: <?php echo e($devPercent); ?>%; <?php echo e($devBarColor); ?> border-radius: 4px;" aria-valuenow="<?php echo e($devPercent); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="document-trigger" data-bs-toggle="modal"
                                                    data-bs-target="#modalDokumen<?php echo e($item->id); ?>" title="Lihat Dokumen">
                                                    <i class="mdi mdi-file-document-multiple-outline"></i><?php echo e($item->merged_documents->count()); ?>

                                                </button>
                                            </td>
                                            <td class="text-center" style="white-space: nowrap;">
                                                <button type="button" 
                                                    class="btn btn-sm btn-outline-primary d-inline-flex align-items-center gap-1 px-2.5 py-1.5 shadow-none" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#modalDetail<?php echo e($item->id); ?>" 
                                                    title="Lihat Detail Properti"
                                                    style="border-radius: 6px; font-size: 0.78rem; font-weight: 600;">
                                                    <i class="mdi mdi-eye"></i> Detail
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="10" class="text-center text-muted py-4">
                                                <i class="mdi mdi-information-outline me-2"></i> Belum ada data properti
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- PAGINATION FOOTER -->
                        <?php if($landBanks instanceof \Illuminate\Pagination\LengthAwarePaginator && $landBanks->total() > 0): ?>
                            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center p-3 border-top bg-white">
                                <div class="pagination-info mb-2 mb-sm-0 text-muted" style="font-size: 0.84rem;">
                                    Menampilkan <?php echo e($landBanks->firstItem()); ?> - <?php echo e($landBanks->lastItem()); ?> dari
                                    <?php echo e($landBanks->total()); ?> data
                                </div>
                                <div>
                                    <?php echo e($landBanks->appends(request()->query())->links('pagination::bootstrap-5')); ?>

                                </div>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $__currentLoopData = $landBanks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="modal fade" id="modalDokumen<?php echo e($item->id); ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="mdi mdi-file-document-multiple-outline me-2"></i>Detail Dokumen
                            Properti</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php if($item->fee_document_verification): ?>
                            <!-- FEE VERIFIKASI DOKUMEN -->
                            <div class="alert alert-success border-0 p-3 mb-4 d-flex align-items-center" 
                                 style="background-color: #ebfbee; border-radius: 12px; border-left: 4px solid #2e7d32 !important; margin: 0 4px 20px 4px;">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-circle bg-white d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; box-shadow: 0 2px 4px rgba(46, 125, 50, 0.1);">
                                        <i class="mdi mdi-cash-multiple text-success" style="font-size: 1.4rem; color: #2e7d32 !important;"></i>
                                    </div>
                                    <div>
                                        <div class="text-muted small fw-semibold" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px;">Fee Dokumen Verifikasi Pasca</div>
                                        <div class="text-success fw-bold" style="font-size: 1.25rem; color: #2e7d32 !important; font-weight: 800;">
                                            Rp <?php echo e(number_format($item->fee_document_verification, 0, ',', '.')); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- DAFTAR DOKUMEN -->
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-light fw-bold">
                                <i class="mdi mdi-file-document-outline me-2 text-primary"></i>
                                Daftar Dokumen
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive" style="max-height: unset;">
                                    <?php if($item->merged_documents->count() > 0): ?>
                                        <table class="table table-hover mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th width="5%" class="text-center">No</th>
                                                    <th width="25%">Nomor Dokumen</th>
                                                    <th>Nama Dokumen</th>
                                                    <th width="15%" class="text-center">Status</th>
                                                    <th width="12%" class="text-center">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__currentLoopData = $item->merged_documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo e($idx + 1); ?></td>
                                                        <td class="fw-bold"><?php echo e($doc->document_number ?? '-'); ?></td>
                                                        <td>
                                                            <div class="d-flex align-items-center gap-2">
                                                                <i class="mdi mdi-file-<?php echo e($doc->type == 'sertifikat' ? 'certificate' : 'document'); ?>-outline text-primary"
                                                                    style="font-size: 1.2rem;"></i>
                                                                <span class="fw-semibold text-dark"><?php echo e($doc->documentType->name ?? '-'); ?></span>
                                                            </div>
                                                            <?php if($doc->status === 'rejected'): ?>
                                                                <div class="alert alert-danger border-0 p-2 mt-2 mb-0 d-flex align-items-start gap-2 text-danger small" style="background-color: #fff5f5; border-radius: 8px; font-weight: 500;">
                                                                    <i class="mdi mdi-alert-circle text-danger mt-0.5" style="font-size: 1.1rem; line-height: 1;"></i>
                                                                    <div>
                                                                        <strong class="text-danger">Alasan Penolakan:</strong> 
                                                                        <span class="text-muted d-block mt-0.5" style="font-weight: normal; line-height: 1.4;"><?php echo e($doc->admin_notes ?? 'Tidak ada catatan khusus.'); ?></span>
                                                                    </div>
                                                                </div>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php if($item->isFromPraLandbank()): ?>
                                                                <span class="badge rounded-pill bg-success px-3 py-2"><i
                                                                        class="mdi mdi-check-circle me-1"></i>Terverifikasi</span>
                                                            <?php elseif($doc->status == 'pending'): ?>
                                                                <span
                                                                    class="badge rounded-pill bg-warning text-dark px-3 py-2"><i
                                                                        class="mdi mdi-clock-outline me-1"></i>Pending</span>
                                                            <?php elseif($doc->status == 'rejected'): ?>
                                                                <span class="badge rounded-pill bg-danger px-3 py-2"><i
                                                                        class="mdi mdi-close-circle me-1"></i>Ditolak</span>
                                                            <?php elseif($doc->status == 'verified'): ?>
                                                                <span class="badge rounded-pill bg-success px-3 py-2"><i
                                                                        class="mdi mdi-check-circle me-1"></i>Terverifikasi</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <a href="<?php echo e(asset(str_starts_with($doc->file_path, 'uploads/') ? $doc->file_path : 'uploads/' . $doc->file_path)); ?>"
                                                                target="_blank" class="btn-outline-purple px-2 py-1" title="Lihat">
                                                                <i class="mdi mdi-eye m-0"></i>
                                                            </a>
                                                             <?php
                                                                 $ext = pathinfo($doc->file_path, PATHINFO_EXTENSION);
                                                                 $cleanDocName = str_replace(' ', '_', $doc->documentType->name ?? 'Dokumen');
                                                                 $cleanPropName = str_replace(' ', '_', $item->name);
                                                                 $downloadName = $cleanDocName . '_' . $cleanPropName . '.' . $ext;
                                                                 $filePathUrl = asset(str_starts_with($doc->file_path, 'uploads/') ? $doc->file_path : 'uploads/' . $doc->file_path);
                                                             ?>
                                                             <?php if($item->isFromPraLandbank() || $doc->status != 'rejected'): ?>
                                                                 <a href="<?php echo e($filePathUrl); ?>"
                                                                     download="<?php echo e($downloadName); ?>" class="btn-outline-green px-2 py-1 ms-1" title="Download">
                                                                     <i class="mdi mdi-download m-0"></i>
                                                                 </a>
                                                             <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                    <?php else: ?>
                                        <div class="text-center text-muted py-5">
                                            <i class="mdi mdi-file-document-outline"
                                                style="font-size: 3rem; opacity: 0.3;"></i>
                                            <p class="mt-2 mb-0">Tidak ada dokumen.</p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                            <i class="mdi mdi-close me-1"></i>Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL DETAIL TANAH PASCA LAND BANK -->
        <div class="modal fade" id="modalDetail<?php echo e($item->id); ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
                    <!-- Modal Header -->
                    <div class="modal-header bg-white border-bottom py-3 px-4 d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center" 
                                 style="width: 44px; height: 44px; background: rgba(154, 85, 255, 0.12); color: #9a55ff;">
                                <i class="mdi mdi-domain" style="font-size: 1.5rem;"></i>
                            </div>
                            <div>
                                <div class="d-flex align-items-center gap-2">
                                    <h5 class="modal-title fw-bold text-dark mb-0" style="font-size: 1.15rem;">
                                        <?php echo e($item->name); ?>

                                    </h5>
                                    <span class="badge-category"><?php echo e($item->zoning ?? 'Tanah'); ?></span>
                                    <?php if($item->isFromPraLandbank()): ?>
                                        <span class="badge bg-soft-info text-info border border-info px-2 py-0.5" style="font-size: 0.7rem; border-radius: 4px;">Dari Pra-Landbank</span>
                                    <?php endif; ?>
                                </div>
                                <small class="text-muted">
                                    <i class="mdi mdi-office-building me-1"></i><?php echo e($item->companyProfile->name ?? 'Perusahaan Mitra Tidak Terdaftar'); ?>

                                </small>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body p-4" style="background: #f8fafc;">

                        <!-- Top Quick Stats (4 Cards) -->
                        <div class="row g-3 mb-4">
                            <!-- Luas Lahan -->
                            <div class="col-sm-6 col-lg-3">
                                <div class="bg-white p-3 rounded-3 border h-100 shadow-sm">
                                    <div class="d-flex align-items-center justify-content-between text-muted small mb-1">
                                        <span class="fw-semibold">Luas Lahan</span>
                                        <i class="mdi mdi-texture-box text-primary" style="font-size: 1.2rem;"></i>
                                    </div>
                                    <div class="fw-bold text-dark fs-5">
                                        <?php echo e(number_format($item->area ?? 0, 0, ',', '.')); ?> <span class="fs-6 text-muted font-normal">m²</span>
                                    </div>
                                    <small class="text-muted" style="font-size: 0.75rem;">
                                        Sisa: <?php echo e(number_format($item->remaining_area ?? 0, 0, ',', '.')); ?> m²
                                    </small>
                                </div>
                            </div>

                            <!-- Total Harga Beli -->
                            <div class="col-sm-6 col-lg-3">
                                <div class="bg-white p-3 rounded-3 border h-100 shadow-sm">
                                    <div class="d-flex align-items-center justify-content-between text-muted small mb-1">
                                        <span class="fw-semibold">Harga Akuisisi</span>
                                        <i class="mdi mdi-cash-multiple text-success" style="font-size: 1.2rem;"></i>
                                    </div>
                                    <div class="fw-bold text-success fs-5">
                                        Rp <?php echo e(number_format($item->grand_total_acquisition_price, 0, ',', '.')); ?>

                                    </div>
                                    <small class="text-muted" style="font-size: 0.75rem;">
                                        Tgl: <?php echo e($item->acquisition_date ? \Carbon\Carbon::parse($item->acquisition_date)->locale('id')->translatedFormat('d M Y') : '-'); ?>

                                    </small>
                                </div>
                            </div>

                            <!-- Status Legalitas -->
                            <div class="col-sm-6 col-lg-3">
                                <div class="bg-white p-3 rounded-3 border h-100 shadow-sm">
                                    <div class="d-flex align-items-center justify-content-between text-muted small mb-1">
                                        <span class="fw-semibold">Legalitas</span>
                                        <i class="mdi mdi-shield-check text-info" style="font-size: 1.2rem;"></i>
                                    </div>
                                    <div class="fw-bold text-dark fs-5">
                                        <?php if($item->isFromPraLandbank() || $item->legal_status === 'verified'): ?>
                                            <span class="text-success"><i class="mdi mdi-check-circle me-1"></i>Terverifikasi</span>
                                        <?php elseif($item->legal_status === 'rejected'): ?>
                                            <span class="text-danger"><i class="mdi mdi-close-circle me-1"></i>Ditolak</span>
                                        <?php else: ?>
                                            <span class="text-warning"><i class="mdi mdi-clock-outline me-1"></i><?php echo e(ucfirst($item->legal_status ?? 'Pending')); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <small class="text-muted" style="font-size: 0.75rem;">
                                        <?php echo e($item->merged_documents->count()); ?> Dokumen Terlampir
                                    </small>
                                </div>
                            </div>

                            <!-- Status Pembangunan -->
                            <div class="col-sm-6 col-lg-3">
                                <div class="bg-white p-3 rounded-3 border h-100 shadow-sm">
                                    <div class="d-flex align-items-center justify-content-between text-muted small mb-1">
                                        <span class="fw-semibold">Pembangunan Fisik</span>
                                        <i class="mdi mdi-progress-wrench text-warning" style="font-size: 1.2rem;"></i>
                                    </div>
                                    <div class="fw-bold text-dark fs-5">
                                        <?php echo e((float) $item->overall_infrastructure_progress); ?>%
                                    </div>
                                    <small class="text-muted" style="font-size: 0.75rem;">
                                        Status: <?php echo e(ucfirst($item->development_status ?? 'Belum Mulai')); ?>

                                    </small>
                                </div>
                            </div>
                        </div>

                        <!-- Detail Navigation Tabs -->
                        <div class="card border-0 shadow-sm mb-0" style="border-radius: 10px; overflow: hidden;">
                            <div class="card-header bg-white border-bottom p-0">
                                <ul class="nav nav-tabs border-0 px-3 pt-2" id="detailTab<?php echo e($item->id); ?>" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active fw-semibold py-2.5 px-3 border-0" 
                                            id="info-tab-<?php echo e($item->id); ?>" data-bs-toggle="tab" 
                                            data-bs-target="#info-pane-<?php echo e($item->id); ?>" type="button" role="tab">
                                            <i class="mdi mdi-information-outline me-1 text-primary"></i> Data Tanah & Lokasi
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link fw-semibold py-2.5 px-3 border-0" 
                                            id="legal-tab-<?php echo e($item->id); ?>" data-bs-toggle="tab" 
                                            data-bs-target="#legal-pane-<?php echo e($item->id); ?>" type="button" role="tab">
                                            <i class="mdi mdi-certificate-outline me-1 text-success"></i> Legalitas & Perizinan
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link fw-semibold py-2.5 px-3 border-0" 
                                            id="docs-tab-<?php echo e($item->id); ?>" data-bs-toggle="tab" 
                                            data-bs-target="#docs-pane-<?php echo e($item->id); ?>" type="button" role="tab">
                                            <i class="mdi mdi-file-document-multiple-outline me-1 text-info"></i> Berkas Dokumen (<?php echo e($item->merged_documents->count()); ?>)
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link fw-semibold py-2.5 px-3 border-0" 
                                            id="infra-tab-<?php echo e($item->id); ?>" data-bs-toggle="tab" 
                                            data-bs-target="#infra-pane-<?php echo e($item->id); ?>" type="button" role="tab">
                                            <i class="mdi mdi-road-variant me-1 text-warning"></i> Lahan & Akses
                                        </button>
                                    </li>
                                </ul>
                            </div>

                            <div class="card-body p-4 bg-white">
                                <div class="tab-content" id="detailTabContent<?php echo e($item->id); ?>">
                                    
                                    <!-- TAB 1: DATA TANAH & LOKASI -->
                                    <div class="tab-pane fade show active" id="info-pane-<?php echo e($item->id); ?>" role="tabpanel">
                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <h6 class="fw-bold text-dark border-bottom pb-2 mb-3">
                                                    <i class="mdi mdi-map-marker-radius me-1 text-primary"></i> Alamat & Lokasi
                                                </h6>
                                                <table class="table table-sm table-borderless mb-0">
                                                    <tr>
                                                        <td class="text-muted" width="40%">Alamat Lengkap</td>
                                                        <td class="fw-semibold text-dark">: <?php echo e($item->address ?? '-'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">Desa / Kelurahan</td>
                                                        <td class="fw-semibold text-dark">: <?php echo e($item->village ?? '-'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">Kecamatan</td>
                                                        <td class="fw-semibold text-dark">: <?php echo e($item->district ?? '-'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">Kota / Kabupaten</td>
                                                        <td class="fw-semibold text-dark">: <?php echo e($item->city ?? '-'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">Provinsi</td>
                                                        <td class="fw-semibold text-dark">: <?php echo e($item->province ?? '-'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">Kode Pos</td>
                                                        <td class="fw-semibold text-dark">: <?php echo e($item->postal_code ?? '-'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">Koordinat Peta</td>
                                                        <td class="fw-semibold text-dark">
                                                            : <?php if(!empty($item->lat) && !empty($item->lng)): ?>
                                                                <span><?php echo e($item->lat); ?>, <?php echo e($item->lng); ?></span>
                                                                <a href="https://www.google.com/maps?q=<?php echo e($item->lat); ?>,<?php echo e($item->lng); ?>" target="_blank" class="btn btn-xs btn-outline-primary ms-2 py-0 px-2" style="font-size: 0.75rem;">
                                                                    <i class="mdi mdi-open-in-new me-1"></i>Maps
                                                                </a>
                                                              <?php else: ?>
                                                                <span class="text-muted">Belum diset</span>
                                                              <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>

                                            <div class="col-md-6">
                                                <h6 class="fw-bold text-dark border-bottom pb-2 mb-3">
                                                    <i class="mdi mdi-card-account-details-outline me-1 text-primary"></i> Identitas Kepemilikan & Fisik
                                                </h6>
                                                <table class="table table-sm table-borderless mb-0">
                                                    <tr>
                                                        <td class="text-muted" width="40%">Perusahaan Pengembang</td>
                                                        <td class="fw-semibold text-dark">: <?php echo e($item->companyProfile->name ?? '-'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">Status Kepemilikan</td>
                                                        <td class="fw-semibold text-dark">: <?php echo e($item->ownership_status ?? '-'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">Kategori Peruntukan</td>
                                                        <td class="fw-semibold text-dark">: <?php echo e($item->zoning ?? 'Tanah Properti'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">Luas Total Lahan</td>
                                                        <td class="fw-semibold text-dark">: <?php echo e(number_format($item->area ?? 0, 0, ',', '.')); ?> m²</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">Sisa Luas Belum Terpakai</td>
                                                        <td class="fw-semibold text-dark">: <?php echo e(number_format($item->remaining_area ?? 0, 0, ',', '.')); ?> m²</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">Nilai / Harga Perolehan</td>
                                                        <td class="fw-bold text-success">: Rp <?php echo e(number_format($item->grand_total_acquisition_price, 0, ',', '.')); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">Tanggal Akuisisi</td>
                                                        <td class="fw-semibold text-dark">: <?php echo e($item->acquisition_date ? \Carbon\Carbon::parse($item->acquisition_date)->locale('id')->translatedFormat('d F Y') : '-'); ?></td>
                                                    </tr>
                                                </table>
                                            </div>

                                            <?php if($item->description): ?>
                                                <div class="col-12 mt-3">
                                                    <div class="p-3 rounded-2 bg-light border">
                                                        <small class="fw-bold text-muted d-block mb-1">Catatan / Deskripsi Tambahan:</small>
                                                        <p class="mb-0 text-dark small" style="white-space: pre-line;"><?php echo e($item->description); ?></p>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- TAB 2: LEGALITAS & PERIZINAN -->
                                    <div class="tab-pane fade" id="legal-pane-<?php echo e($item->id); ?>" role="tabpanel">
                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <h6 class="fw-bold text-dark border-bottom pb-2 mb-3">
                                                    <i class="mdi mdi-certificate me-1 text-success"></i> Sertifikat & Pajak
                                                </h6>
                                                <table class="table table-sm table-borderless mb-0">
                                                    <tr>
                                                        <td class="text-muted" width="40%">Nomor Sertifikat</td>
                                                        <td class="fw-bold text-dark">: <?php echo e($item->certificate_no ?? '-'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">Atas Nama Pemilik</td>
                                                        <td class="fw-semibold text-dark">: <?php echo e($item->certificate_owner ?? '-'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">Nomor IMB / PBG</td>
                                                        <td class="fw-semibold text-dark">: <?php echo e($item->imb_no ?? '-'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">Nomor Objek Pajak (PBB)</td>
                                                        <td class="fw-semibold text-dark">: <?php echo e($item->pbb_no ?? '-'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">Status Verifikasi Legal</td>
                                                        <td>
                                                            : <?php if($item->isFromPraLandbank() || $item->legal_status === 'verified'): ?>
                                                                <span class="badge bg-success">Terverifikasi Sah</span>
                                                              <?php elseif($item->legal_status === 'rejected'): ?>
                                                                <span class="badge bg-danger">Revisi / Ditolak</span>
                                                              <?php else: ?>
                                                                <span class="badge bg-warning text-dark">Dalam Proses</span>
                                                             <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>

                                            <div class="col-md-6">
                                                <h6 class="fw-bold text-dark border-bottom pb-2 mb-3">
                                                    <i class="mdi mdi-file-check-outline me-1 text-success"></i> Perizinan & Tahapan Pasca
                                                </h6>
                                                <table class="table table-sm table-borderless mb-0">
                                                    <tr>
                                                        <td class="text-muted" width="40%">Registrasi Desa</td>
                                                        <td class="fw-semibold text-dark">: <?php echo e($item->desa_reg_no ?? '-'); ?> <?php echo e($item->desa_reg_date ? '(' . $item->desa_reg_date->format('d/m/Y') . ')' : ''); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">Pertimbangan Teknis (Pertek)</td>
                                                        <td class="fw-semibold text-dark">: <?php echo e($item->pertek_no ?? '-'); ?> <?php echo e($item->pertek_date ? '(' . $item->pertek_date->format('d/m/Y') . ')' : ''); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">Peta Bidang BPN</td>
                                                        <td class="fw-semibold text-dark">: <?php echo e($item->peta_bidang_no ?? '-'); ?> <?php echo e($item->peta_bidang_area ? '(' . number_format($item->peta_bidang_area, 0, ',', '.') . ' m²)' : ''); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">Kesesuaian Tata Ruang (PKKPR)</td>
                                                        <td class="fw-semibold text-dark">: <?php echo e($item->pkkpr_no ?? '-'); ?> <?php echo e($item->pkkpr_status ? '[' . $item->pkkpr_status . ']' : ''); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">SK Pemberian HGB</td>
                                                        <td class="fw-semibold text-dark">: <?php echo e($item->sk_hgb_no ?? '-'); ?> <?php echo e($item->sk_hgb_date ? '(' . $item->sk_hgb_date->format('d/m/Y') . ')' : ''); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">SHGB Induk Kawasan</td>
                                                        <td class="fw-semibold text-dark">: <?php echo e($item->shgb_induk_no ?? '-'); ?> <?php echo e($item->shgb_induk_area ? '(' . number_format($item->shgb_induk_area, 0, ',', '.') . ' m²)' : ''); ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- TAB 3: BERKAS DOKUMEN TERLAMPIR -->
                                    <div class="tab-pane fade" id="docs-pane-<?php echo e($item->id); ?>" role="tabpanel">
                                        <?php if($item->merged_documents->count() > 0): ?>
                                            <div class="table-responsive">
                                                <table class="table table-hover align-middle mb-0">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th width="5%" class="text-center">No</th>
                                                            <th width="30%">Nomor Dokumen</th>
                                                            <th>Jenis / Nama Dokumen</th>
                                                            <th width="15%" class="text-center">Status</th>
                                                            <th width="12%" class="text-center">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $__currentLoopData = $item->merged_documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr>
                                                                <td class="text-center text-muted small"><?php echo e($idx + 1); ?></td>
                                                                <td class="fw-bold text-dark" style="font-size: 0.85rem;"><?php echo e($doc->document_number ?? '-'); ?></td>
                                                                <td>
                                                                    <div class="d-flex align-items-center gap-2">
                                                                        <i class="mdi mdi-file-<?php echo e($doc->type == 'sertifikat' ? 'certificate' : 'document'); ?>-outline text-primary fs-5"></i>
                                                                        <span class="fw-semibold text-dark" style="font-size: 0.85rem;"><?php echo e($doc->documentType->name ?? '-'); ?></span>
                                                                    </div>
                                                                </td>
                                                                <td class="text-center">
                                                                    <?php if($item->isFromPraLandbank() || $doc->status == 'verified'): ?>
                                                                        <span class="badge rounded-pill bg-success px-2.5 py-1" style="font-size: 0.72rem;">
                                                                            <i class="mdi mdi-check-circle me-1"></i>Terverifikasi
                                                                        </span>
                                                                    <?php elseif($doc->status == 'pending'): ?>
                                                                        <span class="badge rounded-pill bg-warning text-dark px-2.5 py-1" style="font-size: 0.72rem;">
                                                                            <i class="mdi mdi-clock-outline me-1"></i>Pending
                                                                        </span>
                                                                    <?php elseif($doc->status == 'rejected'): ?>
                                                                        <span class="badge rounded-pill bg-danger px-2.5 py-1" style="font-size: 0.72rem;">
                                                                            <i class="mdi mdi-close-circle me-1"></i>Ditolak
                                                                        </span>
                                                                    <?php endif; ?>
                                                                </td>
                                                                <td class="text-center" style="white-space: nowrap;">
                                                                    <?php if($doc->file_path): ?>
                                                                        <?php
                                                                            $docUrl = asset(str_starts_with($doc->file_path, 'uploads/') ? $doc->file_path : 'uploads/' . $doc->file_path);
                                                                            $ext = pathinfo($doc->file_path, PATHINFO_EXTENSION);
                                                                            $cleanDocName = str_replace(' ', '_', $doc->documentType->name ?? 'Dokumen');
                                                                            $cleanPropName = str_replace(' ', '_', $item->name);
                                                                            $dlName = $cleanDocName . '_' . $cleanPropName . '.' . $ext;
                                                                        ?>
                                                                        <a href="<?php echo e($docUrl); ?>" target="_blank" class="btn btn-xs btn-outline-primary px-2 py-1" title="Lihat Berkas">
                                                                            <i class="mdi mdi-eye"></i>
                                                                        </a>
                                                                        <a href="<?php echo e($docUrl); ?>" download="<?php echo e($dlName); ?>" class="btn btn-xs btn-outline-success px-2 py-1 ms-1" title="Download Berkas">
                                                                            <i class="mdi mdi-download"></i>
                                                                        </a>
                                                                    <?php else: ?>
                                                                        <span class="text-muted small">-</span>
                                                                    <?php endif; ?>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php else: ?>
                                            <div class="text-center text-muted py-5">
                                                <i class="mdi mdi-file-document-outline" style="font-size: 2.8rem; opacity: 0.3;"></i>
                                                <p class="mt-2 mb-0 small">Belum ada dokumen yang diunggah untuk properti ini.</p>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- TAB 4: LAHAN & AKSES / FASILITAS -->
                                    <div class="tab-pane fade" id="infra-pane-<?php echo e($item->id); ?>" role="tabpanel">
                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <h6 class="fw-bold text-dark border-bottom pb-2 mb-3">
                                                    <i class="mdi mdi-road me-1 text-warning"></i> Akses Jalan & Kontur Tanah
                                                </h6>
                                                <table class="table table-sm table-borderless mb-0">
                                                    <tr>
                                                        <td class="text-muted" width="40%">Lebar Akses Jalan</td>
                                                        <td class="fw-semibold text-dark">: <?php echo e($item->road_width ? $item->road_width . ' Meter' : '-'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">Tipe Perkerasan Jalan</td>
                                                        <td class="fw-semibold text-dark">: <?php echo e($item->road_type ?? '-'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">Elevasi Awal</td>
                                                        <td class="fw-semibold text-dark">: <?php echo e($item->elevasi_awal ? $item->elevasi_awal . ' m' : '-'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">Elevasi Rencana</td>
                                                        <td class="fw-semibold text-dark">: <?php echo e($item->elevasi_rencana ? $item->elevasi_rencana . ' m' : '-'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">Volume Cut (Galian)</td>
                                                        <td class="fw-semibold text-dark">: <?php echo e($item->volume_cut ? number_format($item->volume_cut, 0, ',', '.') . ' m³' : '-'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted">Volume Fill (Timbunan)</td>
                                                        <td class="fw-semibold text-dark">: <?php echo e($item->volume_fill ? number_format($item->volume_fill, 0, ',', '.') . ' m³' : '-'); ?></td>
                                                    </tr>
                                                </table>
                                            </div>

                                            <div class="col-md-6">
                                                <h6 class="fw-bold text-dark border-bottom pb-2 mb-3">
                                                    <i class="mdi mdi-storefront-outline me-1 text-warning"></i> Fasilitas Sekitar Lahan
                                                </h6>
                                                <table class="table table-sm table-borderless mb-0">
                                                    <tr>
                                                        <td class="text-muted" width="40%"><i class="mdi mdi-school-outline me-1 text-primary"></i> Sekolah / Pendidikan</td>
                                                        <td class="fw-semibold text-dark">: <?php echo e($item->facility_school ?? '-'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted"><i class="mdi mdi-hospital-building me-1 text-danger"></i> Rumah Sakit / Faskes</td>
                                                        <td class="fw-semibold text-dark">: <?php echo e($item->facility_hospital ?? '-'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted"><i class="mdi mdi-cart-outline me-1 text-success"></i> Mall / Pasar / Swalayan</td>
                                                        <td class="fw-semibold text-dark">: <?php echo e($item->facility_mall ?? '-'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-muted"><i class="mdi mdi-bus me-1 text-info"></i> Akses Transportasi</td>
                                                        <td class="fw-semibold text-dark">: <?php echo e($item->facility_transport ?? '-'); ?></td>
                                                    </tr>
                                                </table>

                                                <?php if($item->denah): ?>
                                                    <div class="mt-4 pt-2 border-top">
                                                        <span class="text-muted small d-block mb-1">Berkas Denah / Siteplan:</span>
                                                        <a href="<?php echo e(asset(str_starts_with($item->denah, 'uploads/') ? $item->denah : 'uploads/' . $item->denah)); ?>" target="_blank" class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center gap-1">
                                                            <i class="mdi mdi-floor-plan"></i> Buka Berkas Denah
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer bg-white border-top py-2.5 px-4 d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary btn-sm px-4" data-bs-dismiss="modal" style="border-radius: 6px;">
                            <i class="mdi mdi-close me-1"></i>Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>

        function showLoading(message = 'Memproses data...') {
            Swal.fire({
                title: message,
                text: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        }

        function handleSort(column) {
            let currentSort = $('#sort_by').val();
            let currentOrder = $('#sort_order').val();
            let newOrder = 'asc';

            if (currentSort === column) {
                newOrder = currentOrder === 'asc' ? 'desc' : 'asc';
            }

            $('#sort_by').val(column);
            $('#sort_order').val(newOrder);

            showLoading('Mengurutkan data...');
            $('#filterForm').submit();
        }

        function applyLiveSearch(query) {
            var filter = (query || '').toLowerCase().trim();
            var rows = document.querySelectorAll('.project-table-row');
            rows.forEach(function(row) {
                var text = row.getAttribute('data-search') || row.innerText.toLowerCase();
                if (!filter || text.indexOf(filter) > -1) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        $(document).ready(function() {
            // Handle pagination clicks
            $('.page-click, .prev-next-btn').on('click', function(e) {
                e.preventDefault();
                let url = $(this).attr('href');
                if (url) {
                    showLoading('Memindahkan halaman...');
                    window.location.href = url;
                }
            });

            // Handle reset button
            $('.btn-reset').on('click', function(e) {
                e.preventDefault();
                showLoading('Mereset data...');
                window.location.href = $(this).attr('href');
            });

            // Handle show per page changes
            $('#showSelect, #showSelectMobile').on('change', function() {
                showLoading('Mengubah jumlah data...');
                $('#filterForm').submit();
            });

            // Handle form submission for filter and search
            $('#filterForm').on('submit', function(e) {
                // Get search values from both inputs
                let searchDesktop = $('#liveSearchInput').val() || $('#searchInput').val();
                let searchMobile = $('#searchInputMobile').val();

                // Use the non-empty search value
                let searchValue = searchDesktop || searchMobile;

                // Set the search input value to the combined value
                if (searchValue) {
                    $('#liveSearchInput').val(searchValue);
                    $('#searchInputMobile').val(searchValue);
                } else {
                    $('#liveSearchInput').val('');
                    $('#searchInputMobile').val('');
                }

                // Show loading based on action
                let searchTerm = searchValue ? searchValue.trim() : '';
                if (searchTerm !== '') {
                    showLoading('Mencari data...');
                } else {
                    showLoading('Menyaring data...');
                }

                // Let the form submit normally
                return true;
            });

            // Sync search inputs between desktop and mobile
            $('#liveSearchInput, #searchInput').on('input', function() {
                $('#searchInputMobile').val($(this).val());
            });

            $('#searchInputMobile').on('input', function() {
                $('#liveSearchInput, #searchInput').val($(this).val());
            });

            // Initialize Select2 for desktop
            $('#filterCompany').select2({
                theme: 'bootstrap-5',
                width: '100%',
                placeholder: 'Semua Perusahaan',
                allowClear: true,
                minimumResultsForSearch: 0,
                dropdownCssClass: 'select2-limited-items',
                language: {
                    noResults: function() {
                        return "Perusahaan tidak ditemukan";
                    },
                    searching: function() {
                        return "Mencari...";
                    }
                }
            });

            // Initialize Select2 for mobile
            $('#filterCompanyMobile').select2({
                theme: 'bootstrap-5',
                width: '100%',
                placeholder: 'Semua Perusahaan',
                allowClear: true,
                minimumResultsForSearch: 0,
                dropdownCssClass: 'select2-limited-items',
                dropdownParent: $('#filterCompanyMobile').parent(),
                language: {
                    noResults: function() {
                        return "Perusahaan tidak ditemukan";
                    },
                    searching: function() {
                        return "Mencari...";
                    }
                }
            });

            // Sync Select2 between desktop and mobile
            $('#filterCompany').on('change', function() {
                $('#filterCompanyMobile').val($(this).val()).trigger('change');
            });

            $('#filterCompanyMobile').on('change', function() {
                $('#filterCompany').val($(this).val()).trigger('change');
            });

            // Handle verification button (shows loader instantly upon click)
            $('.btn-verifikasi').on('click', function(e) {
                showLoading('Memverifikasi properti...');
            });

            // Handle session flash messages with beautiful SweetAlert
            <?php if(session('success')): ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "<?php echo e(session('success')); ?>",
                    confirmButtonColor: '#9a55ff'
                });
            <?php endif; ?>

            <?php if(session('error')): ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: "<?php echo e(session('error')); ?>",
                    confirmButtonColor: '#dc3545'
                });
            <?php endif; ?>
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.partial.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Property-Management-Web-App\resources\views/properti/index.blade.php ENDPATH**/ ?>