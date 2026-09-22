<!-- CUSTOM SIDEBAR (FLAT CATEGORY LABEL SYSTEM) -->
<aside class="custom-sidebar" id="customSidebar">
    <!-- Sidebar Brand Header (Top of Sidebar - Desktop & Mobile) -->
    <div class="sidebar-brand-header">
        <a class="sidebar-brand-box" href="<?php echo e(route('dashboard')); ?>">
            <div class="brand-badge-icon">
                <img src="<?php echo e(asset('images/logo.jpeg')); ?>" alt="GCS Logo" class="brand-logo-img">
            </div>
            <span class="brand-text-full">Graha <span>Cipta Sejahtera</span></span>
        </a>
        <!-- Close Button (Mobile Only) -->
        <button type="button" class="btn btn-sm btn-link text-white-50 p-0 border-0 d-lg-none" id="sidebarCloseBtn" style="font-size: 1.4rem; text-decoration: none; line-height: 1;" title="Close Sidebar">
            <i class="mdi mdi-close"></i>
        </button>
    </div>

    <?php
        // 1. Ambil ID Posisi user yang sedang login
        $positionId = auth()->user()->position_id ?? null;

        // 2. Ambil Menu Utama (yang parent_id nya kosong/NULL) dan boleh diakses posisi ini (baik langsung maupun via sub-menu)
        $mainMenus = collect();
        if ($positionId) {
            $mainMenus = \App\Models\Menu::whereNull('parent_id')
                ->where(function($q) use ($positionId) {
                    $q->whereHas('positions', function($query) use ($positionId) {
                        $query->where('position_id', $positionId);
                    })
                    ->orWhereHas('children', function($cq) use ($positionId) {
                        $cq->whereHas('positions', function($query) use ($positionId) {
                            $query->where('position_id', $positionId);
                        });
                    });
                })
                ->orderBy('order', 'asc')
                ->get();
        }

        // 3. Inisial Nama User
        $userName = auth()->user()->name ?? 'User';
        $words = explode(' ', trim($userName));
        $initials = count($words) >= 2 
            ? strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1))
            : strtoupper(substr($userName, 0, 2));

        // 4. Mapping Ikon Deskriptif untuk Sub-Menu (Tampil saat sidebar ditutup/minimized)
        $iconMap = [
            // Marketing
            'marketing.jual-unit' => 'mdi-view-grid-outline',
            'marketing.list_pengajuan' => 'mdi-book-check-outline',
            // Tanah Induk / Land Bank
            'pralandbank.all' => 'mdi-map-clock-outline',
            'properti-all' => 'mdi-domain',
            'kavling.index' => 'mdi-plus-box-multiple-outline',
            'lokasi.index' => 'mdi-map-marker-outline',
            // User
            'customer.data' => 'mdi-account-multiple-outline',
            'customer.tamu' => 'mdi-account-clock-outline',
            // Transaksi
            'customer.kpr' => 'mdi-cash-clock',
            'kpr.customer-verified' => 'mdi-checkbox-marked-circle-outline',
            'customer.kpr.survey' => 'mdi-account-check-outline',
            'customer.kpr.rijected' => 'mdi-account-cancel-outline',
            'cash-tempo.timeline' => 'mdi-timeline-clock-outline',
            'analisa.kpr.komersil' => 'mdi-chart-timeline-variant',
            // Document
            'dokument.index' => 'mdi-file-document-outline',
            'dokument.persiapan' => 'mdi-file-tree-outline',
            'document.user.persiapan-legal' => 'mdi-file-certificate-outline',
            'spk.index' => 'mdi-file-sign',
            // Pengguna
            'agency.create' => 'mdi-account-plus-outline',
            'agency.index' => 'mdi-account-group-outline',
            // Master Data
            'master.data.menu' => 'mdi-shield-account-outline',
            'master.dokumen-perizinan.index' => 'mdi-file-certificate-outline',
            'master.biaya-legalitas.index' => 'mdi-cash-multiple',
            'master.bahan.index' => 'mdi-package-variant-closed',
            'master.progress.index' => 'mdi-progress-check',
            'promo.index' => 'mdi-tag-outline',
            'company-profile.index' => 'mdi-city-variant-outline',
            'servis' => 'mdi-face-agent',
            'bank.index' => 'mdi-bank-outline',
            'notaris.index' => 'mdi-scale-balance',
            'rab.deadline.index' => 'mdi-calendar-clock',
            'master.data.division.index' => 'mdi-domain-plus',
            'master.data.posisi' => 'mdi-badge-account-outline',
            'master.biaya-legalitas.index' => 'mdi-cash-multiple',
            // Keuangan
            'keuangan.project-accounting.index' => 'mdi-finance',
            'keuangan.pembayaran.index' => 'mdi-cash-multiple',
            'keuangan.master-invoice.index' => 'mdi-receipt-text-outline',
            'marketing.commission-rules.index' => 'mdi-cash-cog',
            // Perizinan & Tugas Staf
            'perizinan.tugas.index' => 'mdi-clipboard-account-outline',
            'perizinan.index' => 'mdi-file-certificate-outline',
            // Legal Unit
            'legal.unit.index' => 'mdi-home-city-outline',
            // Proyek
            'proyek.pengolahan-lahan.index' => 'mdi-hard-hat',
            'proyek.unit.index' => 'mdi-home-city-outline',
            // Pengaturan
            'setting.index' => 'mdi-cog-outline',
        ];

        // 5. Mapping Pola Route Aktif (agar saat buka sub-halaman/action, menu terkait tetap AKTIF / HIGHLIGHT)
        $routeActivePatterns = [
            'dashboard' => ['dashboard', 'dashboard.*'],
            'perizinan.tugas.index' => ['perizinan.tugas.*', 'perizinan-tugas*'],
            'perizinan.index' => ['perizinan.index', 'perizinan.show', 'perizinan.cards', 'perizinan.project'],
            'legal.unit.index' => ['legal.unit.*', 'legal-unit*'],
            'proyek.pengolahan-lahan.index' => ['proyek.pengolahan-lahan.*'],
            'proyek.unit.index' => ['proyek.unit.*'],
            'master.biaya-legalitas.index' => ['master.biaya-legalitas.*'],
            'keuangan.project-accounting.index' => ['keuangan.project-accounting.*'],
            'keuangan.pembayaran.index' => ['keuangan.pembayaran.*'],
            'finance.kpr-disbursement.index' => ['finance.kpr-disbursement.*'],
            'keuangan.master-invoice.index' => ['keuangan.master-invoice.*'],
            'marketing.commission-rules.index' => ['marketing.commission-rules.*'],
            'pralandbank.all' => ['pralandbank.all', 'pra-landbank*', 'properti.pra-landbank*'],
            'properti-all' => ['properti-all', 'properti', 'properti.tambah', 'properti.store', 'properti.edit', 'properti.update', 'properti.verifikasi', 'properti.revisi', 'properti.updateCompany', 'properti.pengolahanLahan*', 'properti.pengolahan-lahan*'],
            'kavling.index' => ['kavling.index', 'properti.buatKavling*', 'properti.storeKavling', 'kavling.*', 'properti.kavling.*'],
            'lokasi.index' => ['lokasi.index', 'lokasi.*'],
            'marketing.jual-unit' => ['marketing.jual-unit*', 'unit.save.position', 'marketing.setAgency', 'set.customer'],
            'marketing.list_pengajuan' => ['marketing.list_pengajuan*', 'marketing.cash*', 'pengajuan.*', 'bookings.*', 'cetak.*', 'dashboard.cetak.*'],
            'master.data.tugas-staff-marketing' => ['master.data.tugas-staff-marketing*'],
            'customer.data' => ['customer.data*'],
            'customer.tamu' => ['customer.tamu*'],
            'customer.kpr' => ['customer.kpr'],
            'kpr.customer-verified' => ['kpr.customer-verified*', 'kpr.approve*', 'kpr.survey*'],
            'customer.kpr.survey' => ['customer.kpr.survey*', 'kpr.pecahlegal*'],
            'customer.kpr.rijected' => ['customer.kpr.rijected*'],
            'cash-tempo.timeline' => ['cash-tempo.timeline*', 'cash-tempo.*'],
            'analisa.kpr.komersil' => ['analisa.kpr.komersil*'],
            'dokument.index' => ['dokument.index*', 'dokument.*'],
            'dokument.persiapan' => ['dokument.persiapan*'],
            'document.user.persiapan-legal' => ['document.user.persiapan-legal*'],
            'spk.index' => ['spk.index*', 'spk.*'],
            'agency.create' => ['agency.create*'],
            'agency.index' => ['agency.index*', 'agency.edit*'],
            'master.data.menu' => ['master.data.menu*'],
            'master.dokumen-perizinan.index' => ['master.dokumen-perizinan.*', 'master-dokumen-perizinan*'],
            'master.biaya-legalitas.index' => ['master.biaya-legalitas.*', 'master-biaya-legalitas*'],
            'master.bahan.index' => ['master.bahan.index*', 'master.data.bahan*'],
            'master.progress.index' => ['master.progress.*', 'master-progress-kategori*'],
            'promo.index' => ['promo.index*', 'promo.*'],
            'company-profile.index' => ['company-profile.index*', 'company-profile.*'],
            'servis' => ['servis*'],
            'bank.index' => ['bank.index*', 'bank.*'],
            'notaris.index' => ['notaris.index*', 'notaris.*', 'master-data-notaris*'],
            'rab.deadline.index' => ['rab.deadline.index*', 'rab.*'],
            'master.data.division.index' => ['master.data.division.*'],
            'master.data.posisi' => ['master.data.posisi*'],
            'setting.index' => ['setting.index*', 'setting.*'],
        ];

        // 6. Pengurutan & Mapping Label Kategori / Section per Menu untuk Pengelompokan Role
        $menuSortWeight = [
            'Dashboard'               => 1,
            
            // Kelompok Legalitas & Perizinan
            'Tugas Perizinan'         => 1.8,
            'Pembagian Tugas'         => 1.8,
            'Perizinan'               => 2,
            'Tanah Induk (Land Bank)' => 3,
            'Tanah Induk'             => 3,
            'Document'                => 4,
            'Dokumen'                 => 4,

            // Kelompok Proyek
            'Pengolahan Lahan'        => 5,
            'Unit'                    => 6,

            // Kelompok Marketing & Transaksi
            'Marketing'               => 7,
            'User'                    => 8,

            // Kelompok KPR
            'Transaksi'               => 9,

            // Kelompok Keuangan
            'Keuangan'                => 10,

            // Kelompok Master Data & Sistem
            'Master Data'             => 11,
            'Pengguna'                => 12,
            'Pengaturan'              => 13,
            'Setting'                 => 13,
            'Laporan'                 => 14,
        ];

        $categoryMap = [
            'Dashboard'               => 'Menu Utama',

            // Legal
            'Tugas Perizinan'         => 'Legal',
            'Pembagian Tugas'         => 'Legal',
            'Perizinan'               => 'Legal',
            'Tanah Induk (Land Bank)' => 'Legal',
            'Tanah Induk'             => 'Legal',
            'Document'                => 'Legal',
            'Dokumen'                 => 'Legal',

            // Proyek
            'Pengolahan Lahan'        => 'Proyek',
            'Unit'                    => 'Proyek',

            // Marketing
            'Marketing'               => 'Marketing',
            'User'                    => 'Marketing',

            // KPR
            'Transaksi'               => 'KPR',

            // Keuangan
            'Keuangan'                => 'Keuangan',

            // Admin
            'Master Data'             => 'Admin',
            'Pengguna'                => 'Admin',
            'Pengaturan'              => 'Admin',
            'Setting'                 => 'Admin',
            'Laporan'                 => 'Admin',
        ];

        // Pastikan urutan menu selalu rapi sesuai kelompok domain
        $mainMenus = $mainMenus->sortBy(function($m) use ($menuSortWeight) {
            if ($m->route === 'perizinan.tugas.index') {
                return 1.8;
            }
            if ($m->route === 'legal.unit.index') {
                return 4.5;
            }
            return $menuSortWeight[$m->name] ?? $m->order ?? 99;
        });

        $currentSection = null;
    ?>

    <!-- Menu List -->
    <ul class="sidebar-menu" id="sidebarMenuAccordion">
        <?php $__currentLoopData = $mainMenus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $main): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                // Ambil Sub-Menu yang boleh diakses
                $subMenus = \App\Models\Menu::where('parent_id', $main->id)
                    ->whereHas('positions', function($query) use ($positionId) {
                        $query->where('position_id', $positionId);
                    })
                    ->orderBy('order', 'asc')
                    ->get();

                // Cek status aktif untuk Single Menu
                $isMainActive = false;
                if ($main->route) {
                    $patterns = $routeActivePatterns[$main->route] ?? [$main->route];
                    foreach ($patterns as $pattern) {
                        if (request()->routeIs($pattern)) {
                            $isMainActive = true;
                            break;
                        }
                    }
                }

                // Cek apakah ada Sub-Menu yang sedang aktif (untuk auto-expand accordion & highlight parent)
                $isAnyChildActive = false;
                foreach ($subMenus as $sub) {
                    if ($sub->route) {
                        $patterns = $routeActivePatterns[$sub->route] ?? [$sub->route];
                        foreach ($patterns as $p) {
                            if (request()->routeIs($p)) {
                                $isAnyChildActive = true;
                                break 2;
                            }
                        }
                    }
                }

                // Nama & Ikon Tampilan (dengan penyesuaian Bahasa Indonesia & validasi icon)
                $mainDisplayName = ($main->name === 'Document') ? 'Dokumen' : $main->name;
                if ($mainDisplayName === 'Tanah Induk (Land Bank)') {
                    $mainDisplayName = 'Tanah Induk';
                }
                $mainIcon = $iconMap[$main->route] ?? $main->icon;
                if ($mainIcon === 'mdi-file-document-box-multiple-outline' || empty($mainIcon)) {
                    $mainIcon = ($mainDisplayName === 'Dokumen') ? 'mdi-file-document-multiple-outline' : ($main->icon ?: 'mdi-folder-outline');
                }

                // Label Kategori / Section Header
                if ($main->route === 'perizinan.tugas.index') {
                    $sectionName = 'Legal';
                } elseif ($main->route === 'legal.unit.index') {
                    $sectionName = 'Legal';
                } elseif ($main->route === 'proyek.unit.index') {
                    $sectionName = 'Proyek';
                } else {
                    $sectionName = $categoryMap[$main->name] ?? ($categoryMap[$mainDisplayName] ?? $mainDisplayName);
                }
            ?>

            
            <?php if($currentSection !== $sectionName): ?>
                <?php $currentSection = $sectionName; ?>
                <li class="sidebar-section-header">
                    <span class="section-title"><?php echo e($sectionName); ?></span>
                </li>
            <?php endif; ?>

            <?php if($subMenus->isEmpty()): ?>
                
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-link <?php echo e($isMainActive ? 'active' : ''); ?>"
                       href="<?php echo e(($main->route && Route::has($main->route)) ? route($main->route) : '#'); ?>"
                       title="<?php echo e($mainDisplayName); ?>">
                        <?php if($mainIcon): ?>
                            <span class="menu-icon-wrap">
                                <i class="mdi <?php echo e($mainIcon); ?>"></i>
                            </span>
                        <?php endif; ?>
                        <span class="menu-title-text"><?php echo e($mainDisplayName); ?></span>
                    </a>
                </li>
            <?php else: ?>
                
                <li class="sidebar-menu-item has-submenu <?php echo e($isAnyChildActive ? 'open' : ''); ?>">
                    <a class="sidebar-menu-link sidebar-dropdown-toggle <?php echo e($isAnyChildActive ? 'parent-active' : ''); ?>"
                       href="#submenu-<?php echo e($main->id); ?>"
                       role="button"
                       aria-expanded="<?php echo e($isAnyChildActive ? 'true' : 'false'); ?>"
                       aria-controls="submenu-<?php echo e($main->id); ?>"
                       title="<?php echo e($mainDisplayName); ?>">
                        <span class="menu-icon-wrap">
                            <i class="mdi <?php echo e($mainIcon); ?>"></i>
                        </span>
                        <span class="menu-title-text"><?php echo e($mainDisplayName); ?></span>
                        <i class="mdi mdi-chevron-down submenu-arrow"></i>
                    </a>

                    
                    <div class="sidebar-submenu <?php echo e($isAnyChildActive ? 'show' : ''); ?>" id="submenu-<?php echo e($main->id); ?>" style="<?php echo e($isAnyChildActive ? 'display: block;' : 'display: none;'); ?>">
                        <ul class="sidebar-submenu-list">
                            <?php $__currentLoopData = $subMenus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $isSubActive = false;
                                    if ($sub->route) {
                                        $patterns = $routeActivePatterns[$sub->route] ?? [$sub->route];
                                        foreach ($patterns as $p) {
                                            if (request()->routeIs($p)) {
                                                $isSubActive = true;
                                                break;
                                            }
                                        }
                                    }
                                ?>
                                <li class="sidebar-submenu-item">
                                    <a class="sidebar-submenu-link <?php echo e($isSubActive ? 'active' : ''); ?>"
                                       href="<?php echo e(($sub->route && Route::has($sub->route)) ? route($sub->route) : '#'); ?>"
                                       title="<?php echo e($sub->name); ?>">
                                        <span class="submenu-bullet"></span>
                                        <span class="submenu-title-text"><?php echo e($sub->name); ?></span>
                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </li>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>

    <!-- Sidebar Bottom User Profile (Inisial & Email) -->
    <div class="sidebar-footer">
        <div class="sidebar-user-bottom">
            <div class="sidebar-bottom-initial">
                <?php echo e($initials); ?>

            </div>
            <div class="sidebar-bottom-details">
                <h6 class="sidebar-bottom-name" title="<?php echo e(auth()->user()->name); ?>"><?php echo e(auth()->user()->name); ?></h6>
                <span class="sidebar-bottom-email" title="<?php echo e(auth()->user()->email); ?>"><?php echo e(auth()->user()->email); ?></span>
            </div>
            <form action="<?php echo e(route('logout')); ?>" method="POST" class="m-0 p-0">
                <?php echo csrf_field(); ?>
                <button type="submit" class="sidebar-bottom-logout" title="Sign Out">
                    <i class="mdi mdi-logout"></i>
                </button>
            </form>
        </div>
    </div>
</aside>
<?php /**PATH F:\Property-Management-Web-App\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>