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

        // 2. Ambil Menu Utama (yang parent_id nya kosong/NULL) dan boleh diakses posisi ini
        $mainMenus = collect();
        if ($positionId) {
            $mainMenus = \App\Models\Menu::whereNull('parent_id')
                ->whereHas('positions', function($query) use ($positionId) {
                    $query->where('position_id', $positionId);
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
            // Pengguna
            'agency.create' => 'mdi-account-plus-outline',
            'agency.index' => 'mdi-account-group-outline',
            // Master Data
            'master.data.menu' => 'mdi-shield-account-outline',
            'promo.index' => 'mdi-tag-outline',
            'company-profile.index' => 'mdi-city-variant-outline',
            'servis' => 'mdi-face-agent',
            'bank.index' => 'mdi-bank-outline',
            'rab.deadline.index' => 'mdi-calendar-clock',
            'master.data.division.index' => 'mdi-domain-plus',
            'master.data.posisi' => 'mdi-badge-account-outline',
            // Pengaturan
            'setting.index' => 'mdi-cog-outline',
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
            @endphp

            @if ($subMenus->isEmpty())
                {{-- Single Top-Level Menu (e.g. Dashboard) --}}
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-link {{ $main->route && request()->routeIs($main->route) ? 'active' : '' }}"
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
                    @endphp
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-link sidebar-child-link {{ $sub->route && request()->routeIs($sub->route) ? 'active' : '' }}"
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
