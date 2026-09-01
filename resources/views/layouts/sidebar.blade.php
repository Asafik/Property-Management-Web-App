<!-- CUSTOM SIDEBAR (FLAT CATEGORY LABEL SYSTEM) -->
<aside class="custom-sidebar" id="customSidebar">
    <!-- Header Mobile: Judul & Tombol Close (X) -->
    <div class="d-flex justify-content-between align-items-center d-lg-none px-3 pt-3 pb-2 border-bottom mb-2">
        <span class="fw-bold" style="font-size: 15px; color: #9a55ff;">Property Management</span>
        <button type="button" class="btn btn-sm btn-link text-muted p-0 border-0" id="sidebarCloseBtn" style="font-size: 1.4rem; text-decoration: none; line-height: 1;">
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
            'master.bahan.index' => 'mdi-package-variant-closed',
            'promo.index' => 'mdi-tag-outline',
            'company-profile.index' => 'mdi-city-variant-outline',
            'servis' => 'mdi-face-agent',
            'bank.index' => 'mdi-bank-outline',
            'rab.deadline.index' => 'mdi-calendar-clock',
            'master.data.division.index' => 'mdi-domain-plus',
            'master.data.posisi' => 'mdi-badge-account-outline',
            // Keuangan
            'keuangan.project-accounting.index' => 'mdi-finance',
            'keuangan.master-invoice.index' => 'mdi-receipt-text-outline',
            'marketing.commission-rules.index' => 'mdi-cash-cog',
            // Pengaturan
            'setting.index' => 'mdi-cog-outline',
        ];

        // 5. Mapping Pola Route Aktif (agar saat buka sub-halaman/action, menu terkait tetap AKTIF / HIGHLIGHT)
        $routeActivePatterns = [
            'dashboard' => ['dashboard', 'dashboard.*'],
            'keuangan.project-accounting.index' => ['keuangan.project-accounting.*'],
            'keuangan.master-invoice.index' => ['keuangan.master-invoice.*'],
            'pralandbank.all' => ['pralandbank.all', 'pra-landbank*', 'properti.pra-landbank*'],
            'properti-all' => ['properti-all', 'properti', 'properti.tambah', 'properti.store', 'properti.edit', 'properti.update', 'properti.verifikasi', 'properti.revisi', 'properti.updateCompany', 'properti.pengolahanLahan*', 'properti.pengolahan-lahan*'],
            'kavling.index' => ['kavling.index', 'properti.buatKavling*', 'properti.storeKavling', 'kavling.*', 'properti.kavling.*'],
            'lokasi.index' => ['lokasi.index', 'lokasi.*'],
            'marketing.jual-unit' => ['marketing.jual-unit*', 'unit.save.position', 'marketing.setAgency', 'set.customer'],
            'marketing.list_pengajuan' => ['marketing.list_pengajuan*', 'marketing.cash*', 'pengajuan.*', 'bookings.*', 'cetak.*', 'dashboard.cetak.*'],
            'marketing.commission-rules.index' => ['marketing.commission-rules.*'],
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
            'master.bahan.index' => ['master.bahan.index*', 'master.data.bahan*'],
            'promo.index' => ['promo.index*', 'promo.*'],
            'company-profile.index' => ['company-profile.index*', 'company-profile.*'],
            'servis' => ['servis*'],
            'bank.index' => ['bank.index*', 'bank.*'],
            'rab.deadline.index' => ['rab.deadline.index*', 'rab.*'],
            'master.data.division.index' => ['master.data.division.*'],
            'master.data.posisi' => ['master.data.posisi*'],
            'setting.index' => ['setting.index*', 'setting.*'],
        ];
    @endphp

    <!-- Menu List -->
    <ul class="sidebar-menu">
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
            @endphp

            @if ($subMenus->isEmpty())
                {{-- Single Top-Level Menu (e.g. Dashboard) --}}
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-link {{ $isMainActive ? 'active' : '' }}"
                       href="{{ $main->route ? route($main->route) : '#' }}"
                       title="{{ $main->name }}">
                        @if($main->icon)
                            <span class="menu-icon-wrap">
                                <i class="mdi {{ $main->icon }}"></i>
                            </span>
                        @endif
                        <span class="menu-title-text">{{ $main->name }}</span>
                    </a>
                </li>
            @else
                {{-- Category / Section Header (e.g. MARKETING, TANAH INDUK) --}}
                <li class="sidebar-section-header">
                    @if($main->icon)
                        <i class="mdi {{ $main->icon }} section-icon"></i>
                    @endif
                    <span class="section-title">{{ $main->name }}</span>
                </li>

                {{-- All Child Menus: Dot saat terbuka, Ikon saat diminimize --}}
                @foreach ($subMenus as $sub)
                    @php
                        $subIcon = $sub->icon ?: ($iconMap[$sub->route] ?? 'mdi-checkbox-blank-circle-outline');
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
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-link sidebar-child-link {{ $isSubActive ? 'active' : '' }}"
                           href="{{ $sub->route ? route($sub->route) : '#' }}"
                           title="{{ $sub->name }}">
                            <span class="menu-icon-wrap">
                                <span class="menu-dot-open"></span>
                                <i class="mdi {{ $subIcon }} menu-icon-minimized"></i>
                            </span>
                            <span class="menu-title-text">{{ $sub->name }}</span>
                        </a>
                    </li>
                @endforeach
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
