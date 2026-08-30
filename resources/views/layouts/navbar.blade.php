@php
    $navUserName = auth()->user()->name ?? 'User';
    $navWords = explode(' ', trim($navUserName));
    $navInitials = count($navWords) >= 2 
        ? strtoupper(substr($navWords[0], 0, 1) . substr($navWords[1], 0, 1))
        : strtoupper(substr($navUserName, 0, 2));

    // Ambil Judul Halaman Otomatis dari @section('title')
    $rawTitle = trim(View::yieldContent('title'));
    $pageTitle = 'Dashboard';
    if (!empty($rawTitle)) {
        $parts = explode(' - ', $rawTitle);
        $pageTitle = trim($parts[0]);
    }
@endphp

<!-- CUSTOM TOP NAVBAR -->
<nav class="custom-navbar">
    <!-- Brand Logo & Page Title Section -->
    <div class="d-flex align-items-center overflow-hidden">
        <a class="navbar-brand-box" href="{{ route('dashboard') }}">
            <span class="brand-text-full">Property <span>Management</span></span>
            <span class="brand-text-mini">PM</span>
        </a>

        <!-- Toggle Button (Desktop: Minimize, Mobile/Tablet: Offcanvas) -->
        <button class="btn-nav-toggle ms-2" type="button" id="sidebarToggleBtn" title="Toggle Sidebar">
            <i class="mdi mdi-menu"></i>
        </button>

        <!-- Dynamic Page Title Text (Clean & Bold) -->
        <div class="navbar-page-title ms-2 ms-sm-3">
            <span class="page-title-text">{{ $pageTitle }}</span>
        </div>
    </div>

    <!-- Right Action Items -->
    <ul class="navbar-nav-right">
        <!-- Fullscreen Button (Desktop only) -->
        <li class="nav-action-item d-none d-lg-block">
            <button class="nav-action-btn" id="customFullscreenBtn" type="button" title="Layar Penuh">
                <i class="mdi mdi-fullscreen"></i>
            </button>
        </li>

        <!-- Notification Bell Dropdown -->
        <li class="nav-action-item">
            <button class="nav-action-btn" type="button" data-custom-toggle="dropdown" data-custom-target="dropdownNotification" title="Notifikasi">
                <i class="mdi mdi-bell-outline"></i>
                @if ($countNotif > 0)
                    <span class="badge-pulse-danger"></span>
                @endif
            </button>

            <!-- Custom Notification Dropdown Menu -->
            <div class="custom-dropdown-menu" id="dropdownNotification" style="width: 320px;">
                <div class="custom-dropdown-header">
                    <span>Notifikasi</span>
                    @if ($countNotif > 0)
                        <span class="badge bg-danger rounded-pill" style="font-size: 0.75rem;">{{ $countNotif }} Baru</span>
                    @endif
                </div>

                <div style="max-height: 300px; overflow-y: auto;">
                    @forelse($notifications as $notif)
                        <a class="custom-dropdown-item d-flex align-items-start {{ $notif->read_at == null ? 'bg-light' : 'opacity-75' }}"
                           href="{{ route('notifications.read', $notif->id) }}">
                            <div class="me-2 mt-1">
                                <i class="mdi {{ $notif->type === 'App\Notifications\NewTaskNotification' ? 'mdi-clipboard-text text-warning' : 'mdi-bell text-info' }}" style="font-size: 1.3rem;"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <strong style="font-size: 0.85rem; color: #2c2e3f;">
                                        {{ $notif->type === 'App\Notifications\NewTaskNotification' ? 'Tugas Baru' : $notif->data['title'] ?? 'Notifikasi' }}
                                    </strong>
                                    @if ($notif->read_at == null)
                                        <span class="badge bg-danger" style="font-size: 0.65rem;">NEW</span>
                                    @endif
                                </div>
                                <p class="mb-0 text-muted" style="font-size: 0.78rem; line-height: 1.3;">
                                    {{ $notif->data['message'] ?? '-' }}
                                </p>
                            </div>
                        </a>
                    @empty
                        <div class="p-3 text-center text-muted" style="font-size: 0.85rem;">
                            <i class="mdi mdi-bell-off-outline me-1"></i> Tidak ada notifikasi
                        </div>
                    @endforelse
                </div>
            </div>
        </li>

        <!-- User Profile Dropdown (Initial Avatar & Email) -->
        <li class="nav-action-item">
            <button class="user-profile-btn" type="button" data-custom-toggle="dropdown" data-custom-target="dropdownUserProfile">
                <div class="user-avatar-initial">
                    {{ $navInitials }}
                </div>
                <div class="user-meta-name">
                    {{ auth()->user()->name ?? 'User' }}
                </div>
                <i class="mdi mdi-chevron-down text-muted" style="font-size: 0.85rem;"></i>
            </button>

            <!-- Custom Profile Dropdown Menu -->
            <div class="custom-dropdown-menu" id="dropdownUserProfile" style="min-width: 220px;">
                <div class="px-3 py-2 border-bottom d-flex align-items-center gap-2">
                    <div class="user-avatar-initial" style="width: 32px; height: 32px; font-size: 0.75rem;">
                        {{ $navInitials }}
                    </div>
                    <div class="overflow-hidden">
                        <div class="fw-bold text-truncate" style="font-size: 0.86rem; color: #2c2e3f;">{{ auth()->user()->name ?? 'User' }}</div>
                        <div class="text-muted text-truncate" style="font-size: 0.72rem;">{{ auth()->user()->email ?? '' }}</div>
                    </div>
                </div>

                <form action="{{ route('logout') }}" method="POST" class="m-0 p-0">
                    @csrf
                    <button type="submit" class="custom-dropdown-item text-danger">
                        <i class="mdi mdi-logout text-danger"></i> Keluar (Sign Out)
                    </button>
                </form>
            </div>
        </li>
    </ul>
</nav>

<!-- Audio Notifikasi -->
<audio id="notifSound">
    <source src="{{ asset('sound/notif.wav') }}" type="audio/mpeg">
</audio>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let notifCount = {{ $countNotif ?? 0 }};
        let lastNotifCount = localStorage.getItem("last_notif_count");
        let sound = document.getElementById("notifSound");

        if (lastNotifCount === null) {
            localStorage.setItem("last_notif_count", notifCount);
            return;
        }

        if (notifCount > parseInt(lastNotifCount)) {
            if (sound) {
                sound.play().catch(function() {
                    console.log("Autoplay audio diblokir browser");
                });
            }
        }

        localStorage.setItem("last_notif_count", notifCount);
    });
</script>
