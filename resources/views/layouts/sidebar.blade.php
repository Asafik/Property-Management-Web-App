<!-- CUSTOM SIDEBAR (FLAT CATEGORY LABEL SYSTEM) -->
<aside class="custom-sidebar" id="customSidebar">
    <!-- Sidebar Brand Header (Top of Sidebar - Desktop & Mobile) -->
    <div class="sidebar-brand-header">
        <a class="sidebar-brand-box" href="{{ route('dashboard') }}">
            <div class="brand-badge-icon">
                <img src="{{ asset('images/logo.jpeg') }}" alt="GCS Logo" class="brand-logo-img">
            </div>
            <span class="brand-text-full">Graha <span>Cipta Sejahtera</span></span>
        </a>
        <!-- Close Button (Mobile Only) -->
        <button type="button" class="btn btn-sm btn-link text-white-50 p-0 border-0 d-lg-none" id="sidebarCloseBtn" style="font-size: 1.4rem; text-decoration: none; line-height: 1;" title="Close Sidebar">
            <i class="mdi mdi-close"></i>
        </button>
    </div>

    @php
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
            // Pra Land Bank
            'pralandbank.all' => 'mdi-format-list-bulleted',
            'pralandbank.fase1' => 'mdi-file-document-check-outline',
            'pralandbank.fase2' => 'mdi-map-marker-radius-outline',
            'pralandbank.fase3' => 'mdi-gavel',
            // Pasca Land Bank
            'properti-all' => 'mdi-home-analytics',
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
            'keuangan.master-invoice.index' => 'mdi-receipt-text-outline',
            'marketing.commission-rules.index' => 'mdi-cash-cog',
            // Perizinan & Tugas Staf
            'perizinan.tugas.index' => 'mdi-clipboard-account-outline',
            'perizinan.index' => 'mdi-file-certificate-outline',
            // Legal Unit
            'legal.unit.index' => 'mdi-home-city-outline',
            // Proyek
            'proyek.index' => 'mdi-city-variant-outline',
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
            'proyek.index' => ['proyek.index', 'properti.edit', 'properti.tambah', 'properti.store', 'properti.update'],
            'proyek.pengolahan-lahan.index' => ['proyek.pengolahan-lahan.*'],
            'proyek.unit.index' => ['proyek.unit.*'],
            'master.biaya-legalitas.index' => ['master.biaya-legalitas.*'],
            'keuangan.project-accounting.index' => ['keuangan.project-accounting.*'],
            'finance.kpr-disbursement.index' => ['finance.kpr-disbursement.*'],
            'keuangan.master-invoice.index' => ['keuangan.master-invoice.*'],
            'marketing.commission-rules.index' => ['marketing.commission-rules.*'],
            'pralandbank.all' => ['pralandbank.all'],
            'pralandbank.fase1' => ['pralandbank.fase1'],
            'pralandbank.fase2' => ['pralandbank.fase2'],
            'pralandbank.fase3' => ['pralandbank.fase3'],
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
            
            // Kelompok Legal
            'Pra Land Bank'           => 2,
            'Pasca Land Bank'         => 2.5,
            'Tanah Induk (Land Bank)' => 2,
            'Tanah Induk'             => 2,
            'Document'                => 3,
            'Dokumen'                 => 3,
            'Unit'                    => 4,

            // Kelompok Perizinan (Di Bawah Legal)
            'Tugas Perizinan'          => 5,
            'Pembagian Tugas'          => 5,
            'Perizinan'                => 6,
            'Master Dokumen Perizinan' => 6.5,

            // Kelompok Proyek
            'Proyek'                  => 7,
            'Pengolahan Lahan'        => 8,

            // Kelompok Marketing & Transaksi
            'Marketing'               => 10,
            'User'                    => 11,

            // Kelompok KPR
            'Transaksi'               => 12,

            // Kelompok Keuangan
            'Keuangan'                => 13,

            // Kelompok Master Data & Sistem
            'Master Data'             => 14,
            'Pengguna'                => 15,
            'Pengaturan'              => 16,
            'Setting'                 => 16,
            'Laporan'                 => 17,
        ];

        $categoryMap = [
            'Dashboard'               => 'Menu Utama',

            // Legal
            'Pra Land Bank'           => 'Legal',
            'Pasca Land Bank'         => 'Legal',
            'Tanah Induk (Land Bank)' => 'Legal',
            'Tanah Induk'             => 'Legal',
            'Document'                => 'Legal',
            'Dokumen'                 => 'Legal',
            'Unit'                    => 'Legal',

            // Perizinan (Label Sendiri di Bawah Legal)
            'Tugas Perizinan'          => 'Perizinan',
            'Pembagian Tugas'          => 'Perizinan',
            'Perizinan'                => 'Perizinan',
            'Master Dokumen Perizinan' => 'Perizinan',

            // Proyek
            'Proyek'                  => 'Proyek',
            'Pengolahan Lahan'        => 'Proyek',

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
            if ($m->route === 'legal.unit.index') {
                return 4;
            }
            if ($m->route === 'perizinan.tugas.index') {
                return 5;
            }
            if ($m->route === 'perizinan.index') {
                return 6;
            }
            if ($m->route === 'master.dokumen-perizinan.index') {
                return 6.5;
            }
            if ($m->route === 'proyek.index') {
                return 7;
            }
            if ($m->route === 'proyek.pengolahan-lahan.index') {
                return 8;
            }
            if ($m->route === 'proyek.unit.index') {
                return 9;
            }
            return $menuSortWeight[$m->name] ?? $m->order ?? 99;
        });

        $currentSection = null;
    @endphp

    <!-- Menu List -->
    <ul class="sidebar-menu" id="sidebarMenuAccordion">
        @foreach ($mainMenus as $main)
            @php
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
                if ($main->route === 'perizinan.tugas.index' || $main->route === 'perizinan.index' || $main->route === 'master.dokumen-perizinan.index') {
                    $sectionName = 'Perizinan';
                } elseif ($main->route === 'legal.unit.index') {
                    $sectionName = 'Legal';
                } elseif ($main->route === 'proyek.index' || $main->route === 'proyek.pengolahan-lahan.index' || $main->route === 'proyek.unit.index') {
                    $sectionName = 'Proyek';
                } else {
                    $sectionName = $categoryMap[$main->name] ?? ($categoryMap[$mainDisplayName] ?? $mainDisplayName);
                }
            @endphp

            {{-- Label Kategori / Header Section per Kelompok Menu Role --}}
            @if ($currentSection !== $sectionName)
                @php $currentSection = $sectionName; @endphp
                <li class="sidebar-section-header">
                    <span class="section-title">{{ $sectionName }}</span>
                </li>
            @endif

            @if ($subMenus->isEmpty())
                {{-- Single Top-Level Menu (e.g. Dashboard, Laporan, Pengaturan) --}}
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-link {{ $isMainActive ? 'active' : '' }}"
                       href="{{ ($main->route && Route::has($main->route)) ? route($main->route) : '#' }}"
                       title="{{ $mainDisplayName }}">
                        @if($mainIcon)
                            <span class="menu-icon-wrap">
                                <i class="mdi {{ $mainIcon }}"></i>
                            </span>
                        @endif
                        <span class="menu-title-text">{{ $mainDisplayName }}</span>
                    </a>
                </li>
            @else
                {{-- Collapsible Dropdown Parent Menu (Buka Tutup Accordion) --}}
                <li class="sidebar-menu-item has-submenu {{ $isAnyChildActive ? 'open' : '' }}">
                    <a class="sidebar-menu-link sidebar-dropdown-toggle {{ $isAnyChildActive ? 'parent-active' : '' }}"
                       href="#submenu-{{ $main->id }}"
                       role="button"
                       aria-expanded="{{ $isAnyChildActive ? 'true' : 'false' }}"
                       aria-controls="submenu-{{ $main->id }}"
                       title="{{ $mainDisplayName }}">
                        <span class="menu-icon-wrap">
                            <i class="mdi {{ $mainIcon }}"></i>
                        </span>
                        <span class="menu-title-text">{{ $mainDisplayName }}</span>
                        <i class="mdi mdi-chevron-down submenu-arrow"></i>
                    </a>

                    {{-- Collapsible Sub-Menu List --}}
                    <div class="sidebar-submenu {{ $isAnyChildActive ? 'show' : '' }}" id="submenu-{{ $main->id }}" style="{{ $isAnyChildActive ? 'display: block;' : 'display: none;' }}">
                        <ul class="sidebar-submenu-list">
                            @foreach ($subMenus as $sub)
                                @php
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
                                @endphp
                                <li class="sidebar-submenu-item">
                                    <a class="sidebar-submenu-link {{ $isSubActive ? 'active' : '' }}"
                                       href="{{ ($sub->route && Route::has($sub->route)) ? route($sub->route) : '#' }}"
                                       title="{{ $sub->name }}">
                                        <span class="submenu-bullet"></span>
                                        <span class="submenu-title-text">{{ $sub->name }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
            @endif
        @endforeach
    </ul>

    <!-- Sidebar Bottom User Profile (Inisial & Email) -->
    <div class="sidebar-footer">
        <div class="sidebar-user-bottom">
            <div class="sidebar-bottom-initial">
                {{ $initials }}
            </div>
            <div class="sidebar-bottom-details">
                <h6 class="sidebar-bottom-name" title="{{ auth()->user()->name }}">{{ auth()->user()->name }}</h6>
                <span class="sidebar-bottom-email" title="{{ auth()->user()->email }}">{{ auth()->user()->email }}</span>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="m-0 p-0">
                @csrf
                <button type="submit" class="sidebar-bottom-logout" title="Sign Out">
                    <i class="mdi mdi-logout"></i>
                </button>
            </form>
        </div>
    </div>
</aside>
