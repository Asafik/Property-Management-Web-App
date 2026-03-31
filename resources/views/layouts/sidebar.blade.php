<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    <img src="{{ asset('admin/assets/images/faces/face1.jpg') }}" alt="profile" />
                    <span class="login-status online"></span>
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-1">{{ auth()->user()->name }}</span>
                    <span class="text-muted small">{{ auth()->user()->position->name ?? '-' }}</span>
                </div>
            </a>
        </li>

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
                    ->orderBy('order', 'asc') // Urutkan berdasarkan kolom order
                    ->get();
            }
        @endphp

        @foreach ($mainMenus as $main)
            @php
                // 3. Cari tahu apakah Menu Utama ini punya Sub-Menu yang juga boleh diakses
                $subMenus = \App\Models\Menu::where('parent_id', $main->id)
                    ->whereHas('positions', function($query) use ($positionId) {
                        $query->where('position_id', $positionId);
                    })
                    ->orderBy('order', 'asc')
                    ->get();

                // Generate ID unik untuk dropdown collapse Bootstrap
                $collapseId = 'menu-' . $main->id;

                // Logika untuk mendeteksi apakah salah satu sub-menu sedang dibuka (agar dropdown tetap terbuka)
                $hasActiveSub = false;
                if($subMenus->isNotEmpty()) {
                    foreach($subMenus as $sub) {
                        if($sub->route && request()->routeIs($sub->route)) {
                            $hasActiveSub = true;
                            break;
                        }
                    }
                }
            @endphp

            @if ($subMenus->isEmpty())
                <li class="nav-item">
                    <a class="nav-link {{ $main->route && request()->routeIs($main->route) ? 'active' : '' }}" 
                       href="{{ $main->route ? route($main->route) : '#' }}">
                        <span class="menu-title">{{ $main->name }}</span>
                        @if($main->icon)
                            <i class="mdi {{ $main->icon }} menu-icon"></i>
                        @endif
                    </a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link {{ $hasActiveSub ? 'active' : '' }}" 
                       data-bs-toggle="collapse" 
                       href="#{{ $collapseId }}" 
                       aria-expanded="{{ $hasActiveSub ? 'true' : 'false' }}" 
                       aria-controls="{{ $collapseId }}">
                        
                        <span class="menu-title">{{ $main->name }}</span>
                        <i class="menu-arrow"></i>
                        
                        @if($main->icon)
                            <i class="mdi {{ $main->icon }} menu-icon"></i>
                        @endif
                    </a>
                    s
                    <div class="collapse {{ $hasActiveSub ? 'show' : '' }}" id="{{ $collapseId }}">
                        <ul class="nav flex-column sub-menu">
                            @foreach ($subMenus as $sub)
                                <li class="nav-item">
                                    <a class="nav-link {{ $sub->route && request()->routeIs($sub->route) ? 'active' : '' }}" 
                                       href="{{ $sub->route ? route($sub->route) : '#' }}">
                                        {{ $sub->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
            @endif
        @endforeach
        
    </ul>
</nav>